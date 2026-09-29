<?php
namespace App\Models;

use Core\Database;

class Room {
    public static function all(): array {
        return Database::fetchAll(
            "SELECT r.*, b.name as building_name, b.code as building_code 
             FROM rooms r 
             INNER JOIN buildings b ON r.building_id = b.id 
             WHERE r.deleted_at IS NULL 
             ORDER BY b.code ASC, r.room_number ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT r.*, b.name as building_name 
             FROM rooms r 
             INNER JOIN buildings b ON r.building_id = b.id 
             WHERE r.id = :id AND r.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('rooms', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('rooms', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('rooms', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }
}
