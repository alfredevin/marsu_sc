<?php
/**
 * Module Migration: Retention Governance Tables
 * Tables for policies, grading templates, correction workflows, supplementary profiles, and audit log.
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Settings Table
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_settings` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `key` VARCHAR(64) NOT NULL UNIQUE,
            `value` TEXT NOT NULL,
            `type` ENUM('int', 'decimal', 'bool', 'string') NOT NULL DEFAULT 'string',
            `label` VARCHAR(191) NOT NULL,
            `description` TEXT NULL,
            `min_value` DECIMAL(10,2) NULL,
            `max_value` DECIMAL(10,2) NULL,
            `updated_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Grading Templates Table
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_grading_templates` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(191) NOT NULL,
            `scheme` LONGTEXT NOT NULL,
            `passing_cutoff` DECIMAL(4,2) NOT NULL DEFAULT 3.04,
            `is_default` TINYINT(1) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Grade Change / Correction Requests
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_grade_change_requests` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `requested_by` INT NOT NULL,
            `reason` TEXT NOT NULL,
            `status` ENUM('pending', 'approved', 'rejected', 'completed') NOT NULL DEFAULT 'pending',
            `reviewed_by` INT NULL,
            `review_note` TEXT NULL,
            `reviewed_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            INDEX `idx_class_id` (`class_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ret_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Supplementary Retention Student Profiles
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_student_profiles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` INT NOT NULL UNIQUE,
            `living_arrangement` ENUM('with_family', 'boarding', 'dormitory', 'relatives', 'other') NOT NULL DEFAULT 'with_family',
            `commute_category` ENUM('local', 'moderate', 'distant') NOT NULL DEFAULT 'local',
            `is_working_student` TINYINT(1) NOT NULL DEFAULT 0,
            `is_scholar` TINYINT(1) NOT NULL DEFAULT 0,
            `scholarship_name` VARCHAR(191) NULL,
            `is_first_generation` TINYINT(1) NOT NULL DEFAULT 0,
            `notes` TEXT NULL,
            `updated_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Change Log (Audit History)
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_change_log` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `entity` VARCHAR(64) NOT NULL,
            `entity_id` INT NOT NULL,
            `action` VARCHAR(64) NOT NULL,
            `field` VARCHAR(64) NULL,
            `old_value` TEXT NULL,
            `new_value` TEXT NULL,
            `reason` TEXT NULL,
            `changed_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            INDEX `idx_entity_lookup` (`entity`, `entity_id`),
            FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Alter Legacy Records table to track system vs manual entries
        $db->exec("ALTER TABLE `ret_records` 
            ADD COLUMN IF NOT EXISTS `source` ENUM('system', 'manual') NOT NULL DEFAULT 'system' AFTER `status`;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ret_change_log`;");
        $db->exec("DROP TABLE IF EXISTS `ret_student_profiles`;");
        $db->exec("DROP TABLE IF EXISTS `ret_grade_change_requests`;");
        $db->exec("DROP TABLE IF EXISTS `ret_grading_templates`;");
        $db->exec("DROP TABLE IF EXISTS `ret_settings`;");
    }
};
