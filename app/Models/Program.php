<?php
namespace App\Models;

use Core\Database;

class Program {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT p.*, d.name as department_name, d.code as department_code,
                    (SELECT COUNT(*) FROM students s WHERE s.program_id = p.id AND s.deleted_at IS NULL) as students_count
             FROM programs p 
             INNER JOIN departments d ON p.department_id = d.id 
             WHERE p.deleted_at IS NULL AND d.deleted_at IS NULL 
             ORDER BY p.code ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT p.*, d.name as department_name 
             FROM programs p 
             INNER JOIN departments d ON p.department_id = d.id 
             WHERE p.id = :id AND p.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('programs', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('programs', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('programs', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
