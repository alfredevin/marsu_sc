<?php
namespace App\Models;

use Core\Database;

class Module {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM modules ORDER BY name ASC");
    }

    public static function findBySlug(string $slug): ?array {
        return Database::fetchOne("SELECT * FROM modules WHERE slug = :slug LIMIT 1", ['slug' => $slug]);
    }

    public static function setStatus(string $slug, bool $isEnabled): void {
        $existing = self::findBySlug($slug);
        if ($existing) {
            Database::update('modules', ['is_enabled' => $isEnabled ? 1 : 0], 'slug = :slug', ['slug' => $slug]);
        } else {
            Database::insert('modules', [
                'slug'       => $slug,
                'name'       => ucfirst($slug),
                'is_enabled' => $isEnabled ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
