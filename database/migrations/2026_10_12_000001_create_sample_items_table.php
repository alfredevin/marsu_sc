<?php
use Core\Database;

/**
 * Migration: Create sample_items table for 2-Field CRUD Demo
 */
return new class {
    public function up(): void {
        $db = Database::pdo();
        $db->exec("CREATE TABLE IF NOT EXISTS `sample_items` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(100) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `sample_items`;");
    }
};
