<?php
/**
 * Module Migration for Institutional Repository & Knowledge Management (IRIMKMS)
 * Table prefix: kmp_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $db->exec("CREATE TABLE IF NOT EXISTS `kmp_records` (
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

        $db->exec("CREATE TABLE IF NOT EXISTS `kmp_proposals` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `code` VARCHAR(50) NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `research_type` VARCHAR(100) NULL,
            `agenda_thrust` VARCHAR(100) NULL,
            `college` VARCHAR(100) NULL,
            `start_date` VARCHAR(20) NULL,
            `end_date` VARCHAR(20) NULL,
            `duration` VARCHAR(50) NULL,
            `pi_name` VARCHAR(191) NOT NULL,
            `pi_id` VARCHAR(100) NULL,
            `pi_rank` VARCHAR(100) NULL,
            `pi_email` VARCHAR(191) NULL,
            `pi_phone` VARCHAR(50) NULL,
            `co_investigators` TEXT NULL,
            `abstract` TEXT NULL,
            `objectives` TEXT NULL,
            `funding_source` VARCHAR(100) NULL,
            `budget_total` DECIMAL(15,2) DEFAULT 0.00,
            `budget_ps` DECIMAL(15,2) DEFAULT 0.00,
            `budget_mooe` DECIMAL(15,2) DEFAULT 0.00,
            `budget_co` DECIMAL(15,2) DEFAULT 0.00,
            `status` ENUM('Under Review', 'Approved', 'Revision Needed', 'Rejected') DEFAULT 'Under Review',
            `reviewer_feedback` TEXT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `kmp_projects` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `project_code` VARCHAR(50) NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `lead_pi` VARCHAR(191) NOT NULL,
            `college` VARCHAR(100) NULL,
            `research_thrust` VARCHAR(100) NULL,
            `funding_source` VARCHAR(100) NULL,
            `total_budget` DECIMAL(15,2) DEFAULT 0.00,
            `progress_percent` INT DEFAULT 0,
            `status` ENUM('Ongoing', 'Completed', 'Suspended', 'Planned') DEFAULT 'Ongoing',
            `start_date` DATE NULL,
            `end_date` DATE NULL,
            `description` TEXT NULL,
            `proposal_id` INT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `kmp_researchers` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `full_name` VARCHAR(191) NOT NULL,
            `title_rank` VARCHAR(100) NULL,
            `department` VARCHAR(191) NULL,
            `college` VARCHAR(100) NULL,
            `academic_rank` VARCHAR(50) NULL,
            `research_domain` VARCHAR(100) NULL,
            `badge_label` VARCHAR(100) NULL,
            `badge_color` VARCHAR(50) NULL,
            `orcid` VARCHAR(50) NULL,
            `email` VARCHAR(191) NULL,
            `specializations` TEXT NULL,
            `active_projects` INT DEFAULT 0,
            `publications_count` INT DEFAULT 0,
            `h_index` INT DEFAULT 0,
            `citations_count` INT DEFAULT 0,
            `bio` TEXT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `kmp_researchers`;");
        $db->exec("DROP TABLE IF EXISTS `kmp_projects`;");
        $db->exec("DROP TABLE IF EXISTS `kmp_proposals`;");
        $db->exec("DROP TABLE IF EXISTS `kmp_records`;");
    }
};
