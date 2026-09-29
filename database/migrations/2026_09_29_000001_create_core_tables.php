<?php
use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Roles table
        $db->exec("CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `slug` VARCHAR(64) NOT NULL UNIQUE,
            `description` VARCHAR(255) NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Permissions table
        $db->exec("CREATE TABLE IF NOT EXISTS `permissions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(128) NOT NULL UNIQUE,
            `module` VARCHAR(64) NOT NULL DEFAULT 'core',
            `description` VARCHAR(255) NULL,
            `created_at` DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Role Permissions pivot
        $db->exec("CREATE TABLE IF NOT EXISTS `role_permissions` (
            `role_id` INT NOT NULL,
            `permission_id` INT NOT NULL,
            PRIMARY KEY (`role_id`, `permission_id`),
            FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Users table
        $db->exec("CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(64) NOT NULL UNIQUE,
            `email` VARCHAR(128) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `first_name` VARCHAR(100) NOT NULL,
            `last_name` VARCHAR(100) NOT NULL,
            `avatar` VARCHAR(255) NULL,
            `role` VARCHAR(64) NOT NULL DEFAULT 'user',
            `status` ENUM('active', 'inactive', 'suspended') NOT NULL DEFAULT 'active',
            `last_login_at` DATETIME NULL,
            `last_login_ip` VARCHAR(45) NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. User Roles pivot
        $db->exec("CREATE TABLE IF NOT EXISTS `user_roles` (
            `user_id` INT NOT NULL,
            `role_id` INT NOT NULL,
            PRIMARY KEY (`user_id`, `role_id`),
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Departments & Colleges
        $db->exec("CREATE TABLE IF NOT EXISTS `departments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `name` VARCHAR(191) NOT NULL,
            `type` ENUM('college', 'department', 'office') NOT NULL DEFAULT 'college',
            `description` TEXT NULL,
            `head_name` VARCHAR(150) NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Academic Programs
        $db->exec("CREATE TABLE IF NOT EXISTS `programs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `department_id` INT NOT NULL,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `name` VARCHAR(191) NOT NULL,
            `major` VARCHAR(100) NULL,
            `years` TINYINT NOT NULL DEFAULT 4,
            `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 8. Academic Years
        $db->exec("CREATE TABLE IF NOT EXISTS `academic_years` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `label` VARCHAR(64) NOT NULL,
            `start_date` DATE NOT NULL,
            `end_date` DATE NOT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 9. Semesters
        $db->exec("CREATE TABLE IF NOT EXISTS `semesters` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `academic_year_id` INT NOT NULL,
            `code` ENUM('1', '2', 'summer') NOT NULL,
            `name` VARCHAR(64) NOT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 10. Sections
        $db->exec("CREATE TABLE IF NOT EXISTS `sections` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `program_id` INT NOT NULL,
            `academic_year_id` INT NOT NULL,
            `year_level` TINYINT NOT NULL,
            `name` VARCHAR(64) NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT,
            FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 11. Subjects
        $db->exec("CREATE TABLE IF NOT EXISTS `subjects` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `program_id` INT NULL,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `title` VARCHAR(191) NOT NULL,
            `lecture_hours` DECIMAL(4,1) NOT NULL DEFAULT 3.0,
            `lab_hours` DECIMAL(4,1) NOT NULL DEFAULT 0.0,
            `units` DECIMAL(4,1) NOT NULL DEFAULT 3.0,
            `prerequisites` VARCHAR(191) NULL,
            `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 12. Buildings
        $db->exec("CREATE TABLE IF NOT EXISTS `buildings` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `name` VARCHAR(150) NOT NULL,
            `location` VARCHAR(191) NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 13. Rooms
        $db->exec("CREATE TABLE IF NOT EXISTS `rooms` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `building_id` INT NOT NULL,
            `room_number` VARCHAR(32) NOT NULL,
            `name` VARCHAR(150) NOT NULL,
            `type` ENUM('lecture', 'laboratory', 'office', 'auditorium', 'other') NOT NULL DEFAULT 'lecture',
            `capacity` INT NOT NULL DEFAULT 40,
            `status` ENUM('available', 'occupied', 'maintenance') NOT NULL DEFAULT 'available',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 14. Students
        $db->exec("CREATE TABLE IF NOT EXISTS `students` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NULL,
            `student_number` VARCHAR(32) NOT NULL UNIQUE,
            `first_name` VARCHAR(100) NOT NULL,
            `middle_name` VARCHAR(100) NULL,
            `last_name` VARCHAR(100) NOT NULL,
            `suffix` VARCHAR(20) NULL,
            `gender` ENUM('male', 'female') NOT NULL,
            `birthdate` DATE NULL,
            `email` VARCHAR(128) NOT NULL UNIQUE,
            `contact_number` VARCHAR(32) NULL,
            `address` TEXT NULL,
            `program_id` INT NOT NULL,
            `year_level` TINYINT NOT NULL DEFAULT 1,
            `section_id` INT NULL,
            `enrollment_status` ENUM('enrolled', 'regular', 'irregular', 'on_leave', 'dropped', 'graduated') NOT NULL DEFAULT 'enrolled',
            `guardian_name` VARCHAR(150) NULL,
            `guardian_contact` VARCHAR(32) NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT,
            FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 15. Employees (Faculty and Staff)
        $db->exec("CREATE TABLE IF NOT EXISTS `employees` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NULL,
            `employee_number` VARCHAR(32) NOT NULL UNIQUE,
            `first_name` VARCHAR(100) NOT NULL,
            `middle_name` VARCHAR(100) NULL,
            `last_name` VARCHAR(100) NOT NULL,
            `suffix` VARCHAR(20) NULL,
            `gender` ENUM('male', 'female') NOT NULL,
            `email` VARCHAR(128) NOT NULL UNIQUE,
            `contact_number` VARCHAR(32) NULL,
            `type` ENUM('faculty', 'staff', 'admin') NOT NULL DEFAULT 'faculty',
            `position` VARCHAR(100) NOT NULL,
            `rank` VARCHAR(100) NULL,
            `department_id` INT NOT NULL,
            `status` ENUM('active', 'on_leave', 'retired', 'resigned') NOT NULL DEFAULT 'active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 16. Organizations Registry (shared reference table)
        $db->exec("CREATE TABLE IF NOT EXISTS `organizations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `name` VARCHAR(191) NOT NULL,
            `type` ENUM('academic', 'non_academic', 'socio_civic', 'sports', 'religious') NOT NULL DEFAULT 'academic',
            `description` TEXT NULL,
            `adviser_id` INT NULL,
            `president_id` INT NULL,
            `status` ENUM('accredited', 'pending', 'inactive') NOT NULL DEFAULT 'accredited',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`adviser_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`president_id`) REFERENCES `students` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 17. Audit Logs table
        $db->exec("CREATE TABLE IF NOT EXISTS `audit_logs` (
            `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NULL,
            `action` VARCHAR(64) NOT NULL,
            `entity` VARCHAR(64) NOT NULL,
            `entity_id` INT NULL,
            `ip_address` VARCHAR(45) NOT NULL,
            `user_agent` VARCHAR(255) NULL,
            `details` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 18. Settings table
        $db->exec("CREATE TABLE IF NOT EXISTS `settings` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `key` VARCHAR(64) NOT NULL UNIQUE,
            `value` TEXT NULL,
            `group` VARCHAR(32) NOT NULL DEFAULT 'general',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 19. Modules registry table
        $db->exec("CREATE TABLE IF NOT EXISTS `modules` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `slug` VARCHAR(64) NOT NULL UNIQUE,
            `name` VARCHAR(150) NOT NULL,
            `is_enabled` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 20. Password Resets table
        $db->exec("CREATE TABLE IF NOT EXISTS `password_resets` (
            `email` VARCHAR(128) NOT NULL,
            `token` VARCHAR(128) NOT NULL,
            `created_at` DATETIME NOT NULL,
            INDEX (`email`),
            INDEX (`token`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }
};
