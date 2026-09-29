<?php
namespace App\Models;

use Core\Database;

class Department {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT d.*, 
                    (SELECT COUNT(*) FROM programs p WHERE p.department_id = d.id AND p.deleted_at IS NULL) as programs_count,
                    (SELECT COUNT(*) FROM employees e WHERE e.department_id = d.id AND e.deleted_at IS NULL) as employees_count
             FROM departments d 
             WHERE d.deleted_at IS NULL 
             ORDER BY d.type, d.code ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM departments WHERE id = :id AND deleted_at IS NULL LIMIT 1", ['id' => $id]);
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('departments', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('departments', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('departments', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
