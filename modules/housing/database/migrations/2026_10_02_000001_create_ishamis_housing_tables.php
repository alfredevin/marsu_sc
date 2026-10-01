<?php
/**
 * ISHAMIS - Integrated Student Housing and Accommodation Management Information System
 * Tables: hsg_boarding_houses, hsg_rooms, hsg_accommodations, hsg_inspections
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Boarding Houses Table
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_boarding_houses` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `code` VARCHAR(32) NOT NULL UNIQUE,
            `name` VARCHAR(150) NOT NULL,
            `landlord_name` VARCHAR(120) NOT NULL,
            `landlord_contact` VARCHAR(32) NOT NULL,
            `landlord_email` VARCHAR(100) NULL,
            `address` VARCHAR(255) NOT NULL,
            `barangay` VARCHAR(100) NOT NULL DEFAULT 'Santa Cruz',
            `distance_campus` VARCHAR(50) NULL,
            `gender_type` ENUM('coed', 'male_only', 'female_only') NOT NULL DEFAULT 'coed',
            `total_rooms` INT NOT NULL DEFAULT 1,
            `total_bed_capacity` INT NOT NULL DEFAULT 4,
            `monthly_rate_min` DECIMAL(10,2) NOT NULL DEFAULT 1500.00,
            `monthly_rate_max` DECIMAL(10,2) NOT NULL DEFAULT 3500.00,
            `curfew_time` VARCHAR(32) NULL DEFAULT '10:00 PM',
            `amenities` TEXT NULL,
            `accreditation_status` ENUM('accredited', 'pending', 'probationary', 'expired') NOT NULL DEFAULT 'accredited',
            `safety_rating` DECIMAL(2,1) NOT NULL DEFAULT 4.5,
            `latitude` DECIMAL(10,8) NULL,
            `longitude` DECIMAL(11,8) NULL,
            `remarks` TEXT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Rooms Table
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_rooms` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `boarding_house_id` INT NOT NULL,
            `room_number` VARCHAR(32) NOT NULL,
            `room_type` ENUM('solo', 'shared_2', 'shared_4', 'bedspace') NOT NULL DEFAULT 'shared_2',
            `capacity_beds` INT NOT NULL DEFAULT 2,
            `occupied_beds` INT NOT NULL DEFAULT 0,
            `vacant_beds` INT NOT NULL DEFAULT 2,
            `rate_per_month` DECIMAL(10,2) NOT NULL DEFAULT 2000.00,
            `has_aircon` TINYINT(1) NOT NULL DEFAULT 0,
            `has_private_cr` TINYINT(1) NOT NULL DEFAULT 0,
            `has_study_desk` TINYINT(1) NOT NULL DEFAULT 1,
            `status` ENUM('available', 'full', 'maintenance') NOT NULL DEFAULT 'available',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`boarding_house_id`) REFERENCES `hsg_boarding_houses` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Student Accommodations / Bookings Table (Linked to core students)
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_accommodations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `boarding_house_id` INT NOT NULL,
            `room_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `start_date` DATE NOT NULL,
            `end_date` DATE NULL,
            `agreed_rate` DECIMAL(10,2) NOT NULL,
            `payment_status` ENUM('paid', 'pending', 'overdue') NOT NULL DEFAULT 'paid',
            `guardian_contact` VARCHAR(32) NULL,
            `status` ENUM('active', 'reserved', 'completed', 'cancelled') NOT NULL DEFAULT 'active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`boarding_house_id`) REFERENCES `hsg_boarding_houses` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`room_id`) REFERENCES `hsg_rooms` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Housing Safety & Sanitation Inspections Table
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_inspections` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `boarding_house_id` INT NOT NULL,
            `inspector_id` INT NULL,
            `inspector_name` VARCHAR(120) NOT NULL DEFAULT 'Campus Housing Officer',
            `inspection_date` DATE NOT NULL,
            `fire_safety_passed` TINYINT(1) NOT NULL DEFAULT 1,
            `sanitary_permit_valid` TINYINT(1) NOT NULL DEFAULT 1,
            `building_permit_valid` TINYINT(1) NOT NULL DEFAULT 1,
            `cctv_functioning` TINYINT(1) NOT NULL DEFAULT 1,
            `compliance_score` INT NOT NULL DEFAULT 95,
            `rating_grade` VARCHAR(10) NOT NULL DEFAULT 'A',
            `findings` TEXT NULL,
            `recommendations` TEXT NULL,
            `next_inspection_date` DATE NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`boarding_house_id`) REFERENCES `hsg_boarding_houses` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`inspector_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `hsg_inspections`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_accommodations`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_rooms`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_boarding_houses`;");
    }
};
