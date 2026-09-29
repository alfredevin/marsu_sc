<?php
/**
 * Module Migration for Student Retention & Academic Risk Early Warning System
 * Table prefix: ret_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $db->exec("CREATE TABLE IF NOT EXISTS `ret_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(191) NOT NULL,
            `description` TEXT NULL,
            `status` ENUM('active', 'pending', 'resolved', 'archived') NOT NULL DEFAULT 'active',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ret_records`;");
    }
};
