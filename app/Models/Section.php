<?php
namespace App\Models;

use Core\Database;

class Section {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT sec.*, p.code as program_code, p.name as program_name, ay.label as academic_year_label,
                    (SELECT COUNT(*) FROM students s WHERE s.section_id = sec.id AND s.deleted_at IS NULL) as students_count
             FROM sections sec 
             INNER JOIN programs p ON sec.program_id = p.id 
             INNER JOIN academic_years ay ON sec.academic_year_id = ay.id 
             WHERE sec.deleted_at IS NULL 
             ORDER BY sec.year_level ASC, sec.name ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT sec.*, p.code as program_code, ay.label as academic_year_label 
             FROM sections sec 
             INNER JOIN programs p ON sec.program_id = p.id 
             INNER JOIN academic_years ay ON sec.academic_year_id = ay.id 
             WHERE sec.id = :id AND sec.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('sections', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('sections', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('sections', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
