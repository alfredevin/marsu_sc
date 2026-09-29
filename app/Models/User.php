<?php
namespace App\Models;

use Core\Database;

class User {
    public static function paginate(int $page = 1, int $perPage = 15, string $search = '', string $roleFilter = ''): array {
        $offset = ($page - 1) * perPage;
        $where = ["u.deleted_at IS NULL"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(u.username LIKE :q OR u.email LIKE :q OR u.first_name LIKE :q OR u.last_name LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        if (!empty($roleFilter)) {
            $where[] = "r.slug = :role";
            $params['role'] = $roleFilter;
        }

        $whereClause = implode(' AND ', $where);

        $total = (int)Database::fetchColumn(
            "SELECT COUNT(DISTINCT u.id) 
             FROM users u 
             LEFT JOIN user_roles ur ON u.id = ur.user_id 
             LEFT JOIN roles r ON ur.role_id = r.id 
             WHERE {$whereClause}",
            $params
        );

        $sql = "SELECT u.*, r.name as role_name, r.slug as role_slug 
                FROM users u 
                LEFT JOIN user_roles ur ON u.id = ur.user_id 
                LEFT JOIN roles r ON ur.role_id = r.id 
                WHERE {$whereClause} 
                ORDER BY u.id DESC 
                LIMIT {$perPage} OFFSET {$offset}";

        $data = Database::fetchAll($sql, $params);

        return [
            'data'         => $data,
            'total'        => $total,
            'per_page'     => $perPage,
            'current_page' => $page,
            'last_page'    => (int)ceil($total / $perPage)
        ];
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT u.*, r.name as role_name, r.id as role_id, r.slug as role_slug 
             FROM users u 
             LEFT JOIN user_roles ur ON u.id = ur.user_id 
             LEFT JOIN roles r ON ur.role_id = r.id 
             WHERE u.id = :id AND u.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data, int $roleId): int {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $data['created_at'] = date('Y-m-d H:i:s');
        
        $userId = Database::insert('users', $data);

        // Assign role
        Database::insert('user_roles', [
            'user_id' => $userId,
            'role_id' => $roleId
        ]);

        return $userId;
    }

    public static function update(int $id, array $data, ?int $roleId = null): void {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        } else {
            unset($data['password']);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('users', $data, 'id = :id', ['id' => $id]);

        if ($roleId !== null) {
            Database::delete('user_roles', 'user_id = :uid', ['uid' => $id]);
            Database::insert('user_roles', [
                'user_id' => $id,
                'role_id' => $roleId
            ]);
        }
    }

    public static function softDelete(int $id): void {
        Database::update('users', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
