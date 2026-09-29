<?php
namespace Core\Middleware;

use Core\Csrf;
use Core\Session;

class CsrfMiddleware {
    public function handle(?string $param = null): bool {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array(strtoupper($method), ['POST', 'PUT', 'DELETE', 'PATCH'], true)) {
            if (!Csrf::validate()) {
                http_response_code(419);
                Session::flash('error', 'Page expired or invalid CSRF security token. Please try again.');
                if (isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    redirect(url('login'));
                }
                return false;
            }
        }
        return true;
    }
}
