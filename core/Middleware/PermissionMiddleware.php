<?php
namespace Core\Middleware;

use Core\Permission;
use Core\View;

class PermissionMiddleware {
    public function handle(?string $permissionKey = null): bool {
        if ($permissionKey && !Permission::can($permissionKey)) {
            http_response_code(403);
            View::render('errors/403', [
                'title'         => 'Access Forbidden (403)',
                'permissionKey' => $permissionKey
            ]);
            return false;
        }
        return true;
    }
}
