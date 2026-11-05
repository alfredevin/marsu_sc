<?php
/**
 * Module Migration: Registrar term enrollment and program-head mapping tables
 * Table prefix: ana_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_enrollments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` INT NOT NULL,
            `academic_year_id` INT NOT NULL,
            `semester_id` INT NOT NULL,
            `program_id` INT NOT NULL,
            `year_level` TINYINT NOT NULL DEFAULT 1,
            `section_id` INT NULL,
            `status` ENUM('pending', 'enrolled', 'withdrawn', 'cancelled') NOT NULL DEFAULT 'pending',
            `remarks` VARCHAR(255) NULL,
            `enrolled_by` INT NULL,
            `enrolled_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_enr_student_sem` (`student_id`, `semester_id`),
            INDEX `idx_ana_enr_sem_status` (`semester_id`, `status`),
            INDEX `idx_ana_enr_program` (`program_id`),
            INDEX `idx_ana_enr_section` (`section_id`),
            CONSTRAINT `fk_ana_enr_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_enr_ay` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_enr_sem` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_enr_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_enr_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
            CONSTRAINT `fk_ana_enr_by` FOREIGN KEY (`enrolled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_enrollment_subjects` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `enrollment_id` INT NOT NULL,
            `subject_id` INT NOT NULL,
            `section_id` INT NULL,
            `status` ENUM('enrolled', 'dropped') NOT NULL DEFAULT 'enrolled',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_enrsub` (`enrollment_id`, `subject_id`),
            INDEX `idx_ana_enrsub_subject` (`subject_id`, `status`),
            CONSTRAINT `fk_ana_enrsub_enr` FOREIGN KEY (`enrollment_id`) REFERENCES `ana_enrollments` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_enrsub_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_enrsub_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_program_heads` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `program_id` INT NOT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_ph` (`user_id`, `program_id`),
            CONSTRAINT `fk_ana_ph_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_ph_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_ph_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ana_program_heads`;");
        $db->exec("DROP TABLE IF EXISTS `ana_enrollment_subjects`;");
        $db->exec("DROP TABLE IF EXISTS `ana_enrollments`;");
    }
};
