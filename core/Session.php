<?php
namespace Core;

/**
 * MarSU Centralized ERP - Hardened Session Manager
 */
class Session {
    private static bool $started = false;

    public static function start(): void {
        if (self::$started || session_status() === PHP_SESSION_ACTIVE) {
            self::$started = true;
            return;
        }

        // Session hardening parameters
        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');

        $isSecure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');

        session_set_cookie_params([
            'lifetime' => 86400 * 2, // 2 days
            'path'     => '/',
            'domain'   => '',
            'secure'   => $isSecure,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        session_name('MARSU_ERP_SESSID');
        session_start();
        self::$started = true;

        // Initialize flash storage
        if (!isset($_SESSION['_flash'])) {
            $_SESSION['_flash'] = [];
        }
        if (!isset($_SESSION['_old_input'])) {
            $_SESSION['_old_input'] = [];
        }
    }

    public static function set(string $key, $value): void {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function regenerate(bool $deleteOld = true): void {
        self::start();
        session_regenerate_id($deleteOld);
    }

    public static function destroy(): void {
        self::start();
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        self::$started = false;
    }

    // Flash messaging
    public static function flash(string $key, $value): void {
        self::start();
        $_SESSION['_flash'][$key] = $value;
    }

    public static function getFlash(string $key, $default = null) {
        self::start();
        if (isset($_SESSION['_flash'][$key])) {
            $val = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $val;
        }
        return $default;
    }

    public static function hasFlash(string $key): bool {
        self::start();
        return isset($_SESSION['_flash'][$key]);
    }

    // Old input
    public static function setOldInput(array $data): void {
        self::start();
        // Exclude passwords
        unset($data['password'], $data['password_confirmation'], $data['current_password'], $data['_token']);
        $_SESSION['_old_input'] = $data;
    }

    public static function getOldInput(string $field, $default = '') {
        self::start();
        return $_SESSION['_old_input'][$field] ?? $default;
    }

    public static function clearOldInput(): void {
        self::start();
        $_SESSION['_old_input'] = [];
    }
}
