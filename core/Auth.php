<?php
namespace Core;

/**
 * MarSU Centralized ERP - Authentication Engine
 * Password hashing, login throttling, session regeneration, and security hardening.
 */
class Auth {
    private const THROTTLE_MAX_ATTEMPTS = 5;
    private const THROTTLE_LOCKOUT_TIME = 300; // 5 minutes

    public static function check(): bool {
        Session::start();
        return Session::has('user_id') && Session::get('user_id') > 0;
    }

    public static function id(): ?int {
        Session::start();
        return Session::get('user_id');
    }

    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }

        $userId = self::id();
        static $cachedUser = null;
        if ($cachedUser !== null && $cachedUser['id'] == $userId) {
            return $cachedUser;
        }

        $cachedUser = Database::fetchOne(
            "SELECT u.*, r.name as role_name, r.slug as role_slug 
             FROM users u 
             LEFT JOIN user_roles ur ON u.id = ur.user_id 
             LEFT JOIN roles r ON ur.role_id = r.id 
             WHERE u.id = :id AND u.deleted_at IS NULL LIMIT 1",
            ['id' => $userId]
        );

        return $cachedUser;
    }

    public static function attempt(string $usernameOrEmail, string $password, bool $remember = false): bool {
        Session::start();

        // 1. Check Login Throttling
        if (self::isThrottled($usernameOrEmail)) {
            Session::flash('error', 'Too many failed login attempts. Please wait 5 minutes before trying again.');
            return false;
        }

        // 2. Fetch User Record
        $user = Database::fetchOne(
            "SELECT * FROM users WHERE (username = :u OR email = :e) AND deleted_at IS NULL LIMIT 1",
            ['u' => $usernameOrEmail, 'e' => $usernameOrEmail]
        );

        if (!$user) {
            self::incrementThrottle($usernameOrEmail);
            return false;
        }

        // 3. Verify Password Hash
        if (!password_verify($password, $user['password'])) {
            self::incrementThrottle($usernameOrEmail);
            return false;
        }

        // 4. Verify Active Status
        if (isset($user['status']) && $user['status'] !== 'active') {
            Session::flash('error', 'Your account has been deactivated. Please contact the administrator.');
            return false;
        }

        // 5. Successful Login: Clear Throttles & Regenerate Session
        self::clearThrottle($usernameOrEmail);
        Session::regenerate(true);
        Session::set('user_id', (int)$user['id']);
        Session::set('user_role', $user['role'] ?? 'user');
        Session::set('logged_in_at', time());

        // Update last login timestamp and IP
        Database::update('users', [
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ], 'id = :id', ['id' => $user['id']]);

        // Audit Log
        Logger::audit('auth.login', 'users', $user['id'], [
            'username' => $user['username'],
            'ip'       => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ]);

        return true;
    }

    public static function logout(): void {
        $userId = self::id();
        if ($userId) {
            Logger::audit('auth.logout', 'users', $userId, []);
        }
        Session::destroy();
    }

    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    // Login Throttling Utilities
    private static function throttleKey(string $identifier): string {
        return 'login_attempts_' . md5(strtolower(trim($identifier)) . '_' . ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'));
    }

    private static function isThrottled(string $identifier): bool {
        $key = self::throttleKey($identifier);
        $attempts = Session::get($key, ['count' => 0, 'first_attempt' => time()]);

        if ($attempts['count'] >= self::THROTTLE_MAX_ATTEMPTS) {
            if (time() - $attempts['first_attempt'] < self::THROTTLE_LOCKOUT_TIME) {
                return true;
            } else {
                // Lockout expired, reset
                self::clearThrottle($identifier);
            }
        }
        return false;
    }

    private static function incrementThrottle(string $identifier): void {
        $key = self::throttleKey($identifier);
        $attempts = Session::get($key, ['count' => 0, 'first_attempt' => time()]);
        $attempts['count']++;
        Session::set($key, $attempts);
    }

    private static function clearThrottle(string $identifier): void {
        Session::remove(self::throttleKey($identifier));
    }
}
