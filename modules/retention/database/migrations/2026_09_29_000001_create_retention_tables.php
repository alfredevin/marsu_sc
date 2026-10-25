<?php
/**
 * Module Migration for Student Retention & Academic Risk Early Warning System (ISREMS)
 * Table prefix: ret_
 * Scope: Modules 1 to 3 (Student Demographics, Academic Performance, Attendance & Engagement)
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. General Retention Records & Audit Trail Logs
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

        // 2. Behavioral & Conduct Incident Records (Module 3: Attendance, Engagement & Behavior Monitoring)
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

        // 3. Roll-Call Attendance & Engagement Telemetry (Module 3)
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_attendance_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(32) NOT NULL,
            `subject_id` INT NULL,
            `subject_code` VARCHAR(32) NOT NULL,
            `academic_year_id` INT NULL,
            `semester_id` INT NULL,
            `session_date` DATE NOT NULL,
            `status` ENUM('Present', 'Absent', 'Excused', 'Late') NOT NULL DEFAULT 'Present',
            `remarks` TEXT NULL,
            `logged_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_student_id` (`student_id`),
            INDEX `idx_subject_code` (`subject_code`),
            INDEX `idx_session_date` (`session_date`),
            INDEX `idx_status` (`status`),
            FOREIGN KEY (`logged_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ret_attendance_records`;");
        $db->exec("DROP TABLE IF EXISTS `ret_behavior_records`;");
        $db->exec("DROP TABLE IF EXISTS `ret_records`;");
    }
};
