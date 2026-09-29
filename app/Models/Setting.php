<?php
namespace App\Models;

use Core\Database;

class Setting {
    private static array $cache = [];

    public static function get(string $key, $default = null) {
        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        try {
            $row = Database::fetchOne("SELECT `value` FROM settings WHERE `key` = :key LIMIT 1", ['key' => $key]);
            if ($row) {
                self::$cache[$key] = $row['value'];
                return $row['value'];
            }
        } catch (\Exception $e) {
            // DB not ready
        }

        return $default;
    }

    public static function set(string $key, $value, string $group = 'general'): void {
        $now = date('Y-m-d H:i:s');
        Database::query(
            "INSERT INTO settings (`key`, `value`, `group`, created_at, updated_at) 
             VALUES (?, ?, ?, ?, ?) 
             ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`)",
            [$key, (string)$value, $group, $now, $now]
        );
        self::$cache[$key] = (string)$value;
    }

    public static function getAll(): array {
        return Database::fetchAll("SELECT * FROM settings ORDER BY `group`, `key`");
    }
}
