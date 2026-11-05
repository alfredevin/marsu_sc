<?php
/**
 * Module Migration: Retention Class Record Tables & Schema Alterations
 * ID CONVENTION:
 * - New tables use `student_id INT` = `students.id` (Foreign Key to students table).
 * - Legacy tables `ret_attendance_records` and `ret_behavior_records` use `student_id VARCHAR` = `students.student_number`.
 * - Always write student number into legacy tables, and join them ONLY on `s.student_number`.
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Classes Table
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_classes` (
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
            INDEX `idx_faculty_user_id` (`faculty_user_id`),
            INDEX `idx_section_id` (`section_id`),
            INDEX `idx_semester_id` (`semester_id`),
            FOREIGN KEY (`faculty_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Class Students (Roster)
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_class_students` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `status` ENUM('enrolled', 'dropped') NOT NULL DEFAULT 'enrolled',
            `added_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_class_student` (`class_id`, `student_id`),
            INDEX `idx_class_id` (`class_id`),
            INDEX `idx_student_id` (`student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ret_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Class Assessment Scores
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_class_scores` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `item_code` VARCHAR(32) NOT NULL,
            `score` DECIMAL(6,2) NULL,
            `submission_status` ENUM('submitted', 'late', 'missing', 'excused') NOT NULL DEFAULT 'submitted',
            `updated_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_class_student_item` (`class_id`, `student_id`, `item_code`),
            INDEX `idx_class_student` (`class_id`, `student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ret_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Class Computed / Posted Final Grades
        $db->exec("CREATE TABLE IF NOT EXISTS `ret_class_grades` (
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
            UNIQUE KEY `uq_class_student_grade` (`class_id`, `student_id`),
            INDEX `idx_class_id` (`class_id`),
            INDEX `idx_student_id` (`student_id`),
            FOREIGN KEY (`class_id`) REFERENCES `ret_classes` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Alter Legacy Attendance Records
        $db->exec("ALTER TABLE `ret_attendance_records` 
            ADD COLUMN IF NOT EXISTS `class_id` INT NULL AFTER `id`,
            ADD COLUMN IF NOT EXISTS `void_reason` VARCHAR(255) NULL AFTER `remarks`;");
        
        try {
            $db->exec("ALTER TABLE `ret_attendance_records` ADD INDEX `idx_class_id` (`class_id`);");
        } catch (\Throwable $e) {}

        // 6. Alter Legacy Behavior Records
        $db->exec("ALTER TABLE `ret_behavior_records` 
            ADD COLUMN IF NOT EXISTS `class_id` INT NULL AFTER `id`,
            ADD COLUMN IF NOT EXISTS `resolution_notes` TEXT NULL AFTER `description`,
            ADD COLUMN IF NOT EXISTS `resolved_by` INT NULL AFTER `status`,
            ADD COLUMN IF NOT EXISTS `resolved_at` DATETIME NULL AFTER `resolved_by`,
            ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL AFTER `updated_at`;");

        try {
            $db->exec("ALTER TABLE `ret_behavior_records` ADD INDEX `idx_class_id` (`class_id`);");
        } catch (\Throwable $e) {}
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ret_class_grades`;");
        $db->exec("DROP TABLE IF EXISTS `ret_class_scores`;");
        $db->exec("DROP TABLE IF EXISTS `ret_class_students`;");
        $db->exec("DROP TABLE IF EXISTS `ret_classes`;");
    }
};
