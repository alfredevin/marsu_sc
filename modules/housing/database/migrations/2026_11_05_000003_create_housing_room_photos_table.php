<?php
/**
 * Module Migration: ISHAMIS Room Photo Gallery
 * Stores real photos uploaded by the housing administrator for each room unit.
 * Table prefix: hsg_
 */
use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_room_photos` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `room_id` INT NOT NULL,
            `category` VARCHAR(20) NOT NULL DEFAULT 'bed',
            `caption` VARCHAR(255) NULL,
            `file_path` VARCHAR(255) NOT NULL,
            `original_name` VARCHAR(191) NULL,
            `file_size` INT NULL,
            `uploaded_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`room_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `hsg_room_photos`;");
    }
};
