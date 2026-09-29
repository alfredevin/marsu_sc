<?php
/**
 * MarSU Centralized ERP - Global Helper Functions
 */

use Core\Auth;
use Core\Csrf;
use Core\Session;
use Core\Permission;
use Core\Database;

/**
 * Escape HTML output securely
 */
if (!function_exists('e')) {
    function e($value): string {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Dump and die for debugging
 */
if (!function_exists('dd')) {
    function dd(...$vars) {
        echo '<pre style="background:#220008; color:#D4AF37; padding:1.5rem; font-family:monospace; border-radius:8px;">';
        foreach ($vars as $v) {
            var_dump($v);
        }
        echo '</pre>';
        exit(1);
    }
}

/**
 * Detect application base URL dynamically
 */
if (!function_exists('base_url')) {
    function base_url(string $path = ''): string {
        static $cachedBase = null;
        if ($cachedBase === null) {
            $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
            $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
            
            // Determine project subfolder if running on XAMPP (e.g. /marsu_sc/ or /marsu-erp/)
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
            // If scriptDir ends with /public, strip it
            $subfolder = preg_replace('#/public$#', '', $scriptDir);
            $subfolder = rtrim($subfolder, '/');
            
            $cachedBase = $scheme . '://' . $host . $subfolder;
        }

        $trimmedPath = ltrim($path, '/');
        return $trimmedPath ? $cachedBase . '/' . $trimmedPath : $cachedBase;
    }
}

/**
 * Generate asset URL
 */
if (!function_exists('asset')) {
    function asset(string $path = ''): string {
        return base_url('public/' . ltrim($path, '/'));
    }
}

/**
 * Generate route URL with pretty URL support and query fallback (?r=)
 */
if (!function_exists('url')) {
    function url(string $route = '', array $params = []): string {
        $cleanRoute = ltrim($route, '/');
        $usePretty  = true; // default enabled via .htaccess

        // Check if pretty URLs are disabled or not supported
        if (isset($_ENV['PRETTY_URLS']) && $_ENV['PRETTY_URLS'] === 'false') {
            $usePretty = false;
        }

        if ($usePretty) {
            $baseUrl = base_url($cleanRoute);
            if (!empty($params)) {
                $baseUrl .= '?' . http_build_query($params);
            }
            return $baseUrl;
        } else {
            $params = array_merge(['r' => $cleanRoute], $params);
            return base_url('index.php?' . http_build_query($params));
        }
    }
}

/**
 * Redirect to a URL with optional flash message
 */
if (!function_exists('redirect')) {
    function redirect(string $url, ?string $flashType = null, ?string $flashMessage = null) {
        if ($flashType && $flashMessage) {
            Session::flash($flashType, $flashMessage);
        }
        header('Location: ' . $url);
        exit;
    }
}

/**
 * Return JSON response and terminate
 */
if (!function_exists('json_response')) {
    function json_response($data, int $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}

/**
 * Get current authenticated user
 */
if (!function_exists('auth')) {
    function auth(): ?array {
        return Auth::user();
    }
}

/**
 * RBAC Permission Check
 */
if (!function_exists('can')) {
    function can(string $permissionKey): bool {
        return Permission::can($permissionKey);
    }
}

/**
 * CSRF helpers
 */
if (!function_exists('csrf_token')) {
    function csrf_token(): string {
        return Csrf::token();
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string {
        return Csrf::field();
    }
}

/**
 * Flash message helper
 */
if (!function_exists('flash')) {
    function flash(?string $key = null, ?string $message = null) {
        if ($key && $message) {
            Session::flash($key, $message);
            return;
        }
        if ($key) {
            return Session::getFlash($key);
        }
        return null;
    }
}

/**
 * Retrieve old input value
 */
if (!function_exists('old')) {
    function old(string $field, $default = '') {
        return Session::getOldInput($field, $default);
    }
}

/**
 * Read environment variable
 */
if (!function_exists('env')) {
    function env(string $key, $default = null) {
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }
        $val = getenv($key);
        return $val !== false ? $val : $default;
    }
}

/**
 * Retrieve system setting from DB
 */
if (!function_exists('setting')) {
    function setting(string $key, $default = null) {
        return \App\Models\Setting::get($key, $default);
    }
}
