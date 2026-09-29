<?php
namespace App\Models;

use Core\Database;

class Building {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT b.*, 
                    (SELECT COUNT(*) FROM rooms r WHERE r.building_id = b.id AND r.deleted_at IS NULL) as rooms_count
             FROM buildings b 
             WHERE b.deleted_at IS NULL 
             ORDER BY b.code ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM buildings WHERE id = :id AND deleted_at IS NULL LIMIT 1", ['id' => $id]);
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('buildings', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('buildings', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('buildings', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
