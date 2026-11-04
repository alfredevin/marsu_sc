<?php
/**
 * Module Migration for Student Leadership Accreditation & Officer Evaluation
 * Table prefix: sld_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $importedSchema = $db->prepare(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table_name'
        );
        $importedSchema->execute(['table_name' => 'organization_tbl']);
        if ((int)$importedSchema->fetchColumn() > 0) {
            return;
        }

        $db->exec("CREATE TABLE IF NOT EXISTS `sld_records` (
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
        $db->exec("DROP TABLE IF EXISTS `sld_records`;");
    }
};
