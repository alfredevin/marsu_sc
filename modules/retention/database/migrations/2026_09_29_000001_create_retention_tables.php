<?php
/**
 * Module Migration for Student Retention & Academic Risk Early Warning System (ISREMS)
 * Table prefix: ret_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. General Retention Records
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

        // 2. Risk Logs & Early Warning Flags
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_risk_logs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(64) NOT NULL,
            `risk_level` ENUM('High', 'Moderate', 'Low') NOT NULL DEFAULT 'Moderate',
            `risk_score` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
            `risk_factors` TEXT NULL,
            `status` ENUM('Active', 'Under Review', 'Mitigated', 'Resolved') NOT NULL DEFAULT 'Active',
            `detected_at` DATETIME NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Faculty Advising Records
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_advising_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(64) NOT NULL,
            `advisor_id` INT NULL,
            `advising_date` DATE NOT NULL,
            `topic` VARCHAR(191) NOT NULL,
            `notes` TEXT NULL,
            `recommendations` TEXT NULL,
            `follow_up_date` DATE NULL,
            `status` ENUM('Scheduled', 'Completed', 'Follow-up Required', 'Cancelled') NOT NULL DEFAULT 'Completed',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`advisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Guidance Referrals
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_guidance_referrals` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(64) NOT NULL,
            `referred_by` INT NULL,
            `referral_reason` TEXT NOT NULL,
            `severity_level` ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL DEFAULT 'Medium',
            `status` ENUM('Pending Intake', 'In Counseling', 'Resolved', 'Closed') NOT NULL DEFAULT 'Pending Intake',
            `resolution_notes` TEXT NULL,
            `referred_at` DATETIME NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Academic Support & Peer Tutoring Programs
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_academic_support` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(64) NOT NULL,
            `program_name` VARCHAR(191) NOT NULL,
            `subject_code` VARCHAR(64) NOT NULL,
            `mentor_name` VARCHAR(191) NULL,
            `status` ENUM('Enrolled', 'Active', 'Completed', 'Dropped') NOT NULL DEFAULT 'Enrolled',
            `enrolled_at` DATE NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Intervention Outcomes & Tracking
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_interventions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(64) NOT NULL,
            `intervention_type` VARCHAR(191) NOT NULL,
            `status` ENUM('Initiated', 'In Progress', 'Successful', 'Unsuccessful', 'Closed') NOT NULL DEFAULT 'Initiated',
            `outcome_notes` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Behavioral & Conduct Logs
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_behavior_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(64) NOT NULL,
            `incident_type` VARCHAR(191) NOT NULL,
            `description` TEXT NULL,
            `severity` ENUM('Minor', 'Moderate', 'Severe') NOT NULL DEFAULT 'Minor',
            `reported_by` INT NULL,
            `incident_date` DATE NOT NULL,
            `status` ENUM('Reported', 'Under Investigation', 'Resolved', 'Dismissed') NOT NULL DEFAULT 'Reported',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ret_behavior_records`;");
        $db->exec("DROP TABLE IF EXISTS `ret_interventions`;");
        $db->exec("DROP TABLE IF EXISTS `ret_academic_support`;");
        $db->exec("DROP TABLE IF EXISTS `ret_guidance_referrals`;");
        $db->exec("DROP TABLE IF EXISTS `ret_advising_records`;");
        $db->exec("DROP TABLE IF EXISTS `ret_risk_logs`;");
        $db->exec("DROP TABLE IF EXISTS `ret_records`;");
    }
};
