<?php
namespace Core\Middleware;

use Core\Auth;
use Core\Session;

class AuthMiddleware {
    public function handle(?string $param = null): bool {
        if (!Auth::check()) {
            Session::flash('error', 'Please log in to access this page.');
            redirect(url('login'));
            return false;
        }
        return true;
    }
}
