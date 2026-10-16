<?php

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organizations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(191) NOT NULL,
            `acronym` VARCHAR(50) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `description` TEXT NULL,
            `adviser` VARCHAR(191) NOT NULL,
            `status` VARCHAR(50) NOT NULL DEFAULT 'Pending Accreditation',
            `accreditation_date` DATE NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            UNIQUE KEY `uq_sld_organizations_acronym` (`acronym`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_members` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `member_name` VARCHAR(191) NOT NULL,
            `student_number` VARCHAR(50) NULL,
            `role` VARCHAR(100) NOT NULL DEFAULT 'Member',
            `joined_at` DATE NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'Active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_members_organization` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec('DROP TABLE IF EXISTS `sld_members`;');
        $db->exec('DROP TABLE IF EXISTS `sld_organizations`;');
    }
};
