<?php
/**
 * Migration for Housing Rooms table
 * Prefix: hsg_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_rooms` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `room_number` VARCHAR(50) NOT NULL,
            `capacity` INT NOT NULL DEFAULT 1,
            `monthly_rate` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
            `status` ENUM('available', 'occupied', 'maintenance') NOT NULL DEFAULT 'available',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `hsg_rooms`;");
    }
};
