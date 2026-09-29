<?php
namespace Core;

/**
 * MarSU Centralized ERP - RBAC Permission Engine
 * Deny-by-default architecture. Hierarchical keys: module.resource.action
 */
class Permission {
    private static array $permissionCache = [];

    /**
     * Check if a user possesses a specific permission
     */
    public static function can(string $permissionKey, ?int $userId = null): bool {
        $user = $userId ? Database::fetchOne("SELECT * FROM users WHERE id = :id", ['id' => $userId]) : Auth::user();
        
        if (!$user) {
            return false; // Deny by default for unauthenticated guests
        }

        // Super Admin bypass: users with role_slug 'super_admin' or role 'super_admin' have universal access
        if (($user['role_slug'] ?? '') === 'super_admin' || ($user['role'] ?? '') === 'super_admin') {
            return true;
        }

        $userId = (int)$user['id'];
        $userPerms = self::getUserPermissions($userId);

        // Check exact match
        if (in_array($permissionKey, $userPerms, true)) {
            return true;
        }

        // Check wildcard match (e.g. core.students.* or housing.*)
        $parts = explode('.', $permissionKey);
        if (count($parts) >= 2) {
            $wildcardModuleResource = $parts[0] . '.' . $parts[1] . '.*';
            if (in_array($wildcardModuleResource, $userPerms, true)) {
                return true;
            }
        }
        $wildcardModule = $parts[0] . '.*';
        if (in_array($wildcardModule, $userPerms, true)) {
            return true;
        }

        return false;
    }

    /**
     * Retrieve all active permission keys assigned to a user via roles
     */
    public static function getUserPermissions(int $userId): array {
        if (isset(self::$permissionCache[$userId])) {
            return self::$permissionCache[$userId];
        }

        $sql = "SELECT DISTINCT p.name 
                FROM permissions p
                INNER JOIN role_permissions rp ON p.id = rp.permission_id
                INNER JOIN user_roles ur ON rp.role_id = ur.role_id
                WHERE ur.user_id = :user_id";

        $rows = Database::fetchAll($sql, ['user_id' => $userId]);
        $keys = array_column($rows, 'name');

        self::$permissionCache[$userId] = $keys;
        return $keys;
    }

    /**
     * Register a new permission into the database if not present
     */
    public static function register(string $name, string $module, string $description = ''): int {
        $existing = Database::fetchOne("SELECT id FROM permissions WHERE name = :name", ['name' => $name]);
        if ($existing) {
            return (int)$existing['id'];
        }

        return Database::insert('permissions', [
            'name'        => $name,
            'module'      => $module,
            'description' => $description,
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Clear permission cache
     */
    public static function flushCache(): void {
        self::$permissionCache = [];
    }
}
