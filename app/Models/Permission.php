<?php
namespace App\Models;

use Core\Database;

class Permission {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM permissions ORDER BY module, name");
    }

    public static function allGroupedByModule(): array {
        $rows = self::all();
        $grouped = [];
        foreach ($rows as $r) {
            $module = $r['module'] ?: 'core';
            $grouped[$module][] = $r;
        }
        return $grouped;
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM permissions WHERE id = :id LIMIT 1", ['id' => $id]);
    }
}
