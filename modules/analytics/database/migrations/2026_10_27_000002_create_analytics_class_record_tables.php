<?php
/**
 * Module Migration: Academic Analytics Class Record Tables
 * Table prefix: ana_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Classes Table
        $db->exec("CREATE TABLE IF NOT EXISTS `ana_classes` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `faculty_user_id` INT NULL,
            `subject_id` INT NULL,
            `subject_code` VARCHAR(32) NOT NULL,
            `subject_title` VARCHAR(191) NOT NULL,
            `units` DECIMAL(4,1) NOT NULL DEFAULT 3.0,
            `section_id` INT NULL,
            `section_name` VARCHAR(64) NOT NULL,
            `academic_year_id` INT NULL,
            `semester_id` INT NULL,
            `template_id` INT NULL,
            `grading_scheme` LONGTEXT NULL,
            `passing_cutoff` DECIMAL(4,2) NOT NULL DEFAULT 3.04,
            `grade_status` ENUM('draft', 'posted', 'locked') NOT NULL DEFAULT 'draft',
            `posted_at` DATETIME NULL,
            `posted_by` INT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_ana_faculty_user_id` (`faculty_user_id`),
            INDEX `idx_ana_section_id` (`section_id`),
            INDEX `idx_ana_semester_id` (`semester_id`),
            FOREIGN KEY (`faculty_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Class Students (Roster)
        $db->exec("CREATE TABLE IF NOT EXISTS `ana_class_students` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `status` ENUM('enrolled', 'dropped') NOT NULL DEFAULT 'enrolled',
            `added_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_class_student` (`class_id`, `student_id`),
            INDEX `idx_ana_class_id` (`class_id`),
            INDEX `idx_ana_student_id` (`student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Class Assessment Scores
        $db->exec("CREATE TABLE IF NOT EXISTS `ana_class_scores` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `item_code` VARCHAR(32) NOT NULL,
            `score` DECIMAL(6,2) NULL,
            `submission_status` ENUM('submitted', 'late', 'missing', 'excused') NOT NULL DEFAULT 'submitted',
            `updated_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_class_student_item` (`class_id`, `student_id`, `item_code`),
            INDEX `idx_ana_class_student` (`class_id`, `student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Class Computed / Posted Final Grades
        $db->exec("CREATE TABLE IF NOT EXISTS `ana_class_grades` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `computed_grade` DECIMAL(4,2) NULL,
            `final_grade` VARCHAR(8) NULL,
            `remarks` ENUM('PASSED', 'FAILED', 'INC', 'DRP') NOT NULL DEFAULT 'PASSED',
            `inc_deadline` DATE NULL,
            `inc_resolved_at` DATETIME NULL,
            `posted_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_class_student_grade` (`class_id`, `student_id`),
            INDEX `idx_ana_grade_class_id` (`class_id`),
            INDEX `idx_ana_grade_student_id` (`student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Attendance Records
        $db->exec("CREATE TABLE IF NOT EXISTS `ana_attendance_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NULL,
            `student_id` VARCHAR(64) NOT NULL,
            `subject_code` VARCHAR(32) NULL,
            `session_date` DATE NOT NULL,
            `status` ENUM('Present', 'Late', 'Absent', 'Excused') NOT NULL DEFAULT 'Present',
            `remarks` VARCHAR(255) NULL,
            `void_reason` VARCHAR(255) NULL,
            `recorded_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            INDEX `idx_ana_att_class_id` (`class_id`),
            INDEX `idx_ana_att_student_id` (`student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Behavior Records
        $db->exec("CREATE TABLE IF NOT EXISTS `ana_behavior_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NULL,
            `student_id` VARCHAR(64) NOT NULL,
            `reported_by` INT NULL,
            `incident_date` DATE NOT NULL,
            `incident_type` VARCHAR(100) NOT NULL,
            `severity` ENUM('Minor', 'Moderate', 'Severe') NOT NULL DEFAULT 'Minor',
            `description` TEXT NOT NULL,
            `resolution_notes` TEXT NULL,
            `status` ENUM('Reported', 'Investigating', 'Resolved', 'Dismissed') NOT NULL DEFAULT 'Reported',
            `resolved_by` INT NULL,
            `resolved_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_ana_beh_class_id` (`class_id`),
            INDEX `idx_ana_beh_student_id` (`student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`resolved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ana_behavior_records`;");
        $db->exec("DROP TABLE IF EXISTS `ana_attendance_records`;");
        $db->exec("DROP TABLE IF EXISTS `ana_class_grades`;");
        $db->exec("DROP TABLE IF EXISTS `ana_class_scores`;");
        $db->exec("DROP TABLE IF EXISTS `ana_class_students`;");
        $db->exec("DROP TABLE IF EXISTS `ana_classes`;");
    }
};
