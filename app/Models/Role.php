<?php
namespace App\Models;

use Core\Database;

class Role {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT r.*, COUNT(ur.user_id) as users_count 
             FROM roles r 
             LEFT JOIN user_roles ur ON r.id = ur.role_id 
             GROUP BY r.id 
             ORDER BY r.id ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM roles WHERE id = :id LIMIT 1", ['id' => $id]);
    }

    public static function findBySlug(string $slug): ?array {
        return Database::fetchOne("SELECT * FROM roles WHERE slug = :slug LIMIT 1", ['slug' => $slug]);
    }

    public static function getPermissions(int $roleId): array {
        $rows = Database::fetchAll(
            "SELECT p.id, p.name 
             FROM permissions p 
             INNER JOIN role_permissions rp ON p.id = rp.permission_id 
             WHERE rp.role_id = :role_id",
            ['role_id' => $roleId]
        );
        return array_column($rows, 'id');
    }

    public static function syncPermissions(int $roleId, array $permissionIds): void {
        Database::delete('role_permissions', 'role_id = :rid', ['rid' => $roleId]);

        foreach ($permissionIds as $pId) {
            $pId = (int)$pId;
            if ($pId > 0) {
                Database::query("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [
                    $roleId, $pId
                ]);
            }
        }
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('roles', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('roles', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): void {
        // Prevent deleting super_admin
        $role = self::find($id);
        if ($role && $role['slug'] === 'super_admin') {
            throw new \Exception("The Super Administrator role cannot be deleted.");
        }
        Database::delete('roles', 'id = :id', ['id' => $id]);
    }
}
