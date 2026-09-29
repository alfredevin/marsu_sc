<?php
namespace Core;

/**
 * MarSU Centralized ERP - CSRF Protection Suite
 */
class Csrf {
    private const SESSION_KEY = '_csrf_token';

    public static function token(): string {
        Session::start();
        $token = Session::get(self::SESSION_KEY);
        if (!$token || strlen($token) !== 64) {
            $token = bin2hex(random_bytes(32));
            Session::set(self::SESSION_KEY, $token);
        }
        return $token;
    }

    public static function field(): string {
        $token = self::token();
        return '<input type="hidden" name="_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function validate(?string $submittedToken = null): bool {
        Session::start();
        $expectedToken = Session::get(self::SESSION_KEY);
        if (!$expectedToken) {
            return false;
        }

        if ($submittedToken === null) {
            // Check POST payload, then custom headers
            $submittedToken = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        }

        if (!$submittedToken || !is_string($submittedToken)) {
            return false;
        }

        return hash_equals($expectedToken, $submittedToken);
    }
}
