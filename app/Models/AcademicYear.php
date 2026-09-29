<?php
namespace App\Models;

use Core\Database;

class AcademicYear {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT ay.*, 
                    (SELECT COUNT(*) FROM sections sec WHERE sec.academic_year_id = ay.id AND sec.deleted_at IS NULL) as sections_count
             FROM academic_years ay 
             ORDER BY ay.start_date DESC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM academic_years WHERE id = :id LIMIT 1", ['id' => $id]);
    }

    public static function getActive(): ?array {
        return Database::fetchOne("SELECT * FROM academic_years WHERE is_active = 1 LIMIT 1");
    }

    public static function setActive(int $id): void {
        Database::query("UPDATE academic_years SET is_active = 0");
        Database::update('academic_years', ['is_active' => 1], 'id = :id', ['id' => $id]);
        
        $ay = self::find($id);
        if ($ay) {
            Setting::set('active_academic_year', $ay['code'], 'academic');
        }
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('academic_years', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('academic_years', $data, 'id = :id', ['id' => $id]);
    }
}
