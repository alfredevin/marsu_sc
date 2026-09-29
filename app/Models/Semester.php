<?php
namespace App\Models;

use Core\Database;

class Semester {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT s.*, ay.label as academic_year_label 
             FROM semesters s 
             INNER JOIN academic_years ay ON s.academic_year_id = ay.id 
             ORDER BY ay.start_date DESC, s.code ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM semesters WHERE id = :id LIMIT 1", ['id' => $id]);
    }

    public static function getActive(): ?array {
        return Database::fetchOne("SELECT * FROM semesters WHERE is_active = 1 LIMIT 1");
    }

    public static function setActive(int $id): void {
        Database::query("UPDATE semesters SET is_active = 0");
        Database::update('semesters', ['is_active' => 1], 'id = :id', ['id' => $id]);
        
        $sem = self::find($id);
        if ($sem) {
            Setting::set('active_semester', $sem['code'], 'academic');
        }
    }
}
