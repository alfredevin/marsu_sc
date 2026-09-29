<?php
namespace App\Models;

use Core\Database;

class Organization {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT o.*, 
                    CONCAT(e.first_name, ' ', e.last_name) as adviser_name,
                    CONCAT(s.first_name, ' ', s.last_name) as president_name 
             FROM organizations o 
             LEFT JOIN employees e ON o.adviser_id = e.id 
             LEFT JOIN students s ON o.president_id = s.id 
             WHERE o.deleted_at IS NULL 
             ORDER BY o.name ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT o.*, 
                    CONCAT(e.first_name, ' ', e.last_name) as adviser_name,
                    CONCAT(s.first_name, ' ', s.last_name) as president_name 
             FROM organizations o 
             LEFT JOIN employees e ON o.adviser_id = e.id 
             LEFT JOIN students s ON o.president_id = s.id 
             WHERE o.id = :id AND o.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('organizations', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('organizations', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('organizations', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
