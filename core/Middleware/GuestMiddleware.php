<?php
namespace Core\Middleware;

use Core\Auth;

class GuestMiddleware {
    public function handle(?string $param = null): bool {
        if (Auth::check()) {
            redirect(url('dashboard'));
            return false;
        }
        return true;
    }
}
