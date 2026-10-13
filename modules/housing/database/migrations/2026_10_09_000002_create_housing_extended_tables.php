<?php
/**
 * Module Migration: ISHAMIS Extended Tables
 * Table prefix: hsg_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Accredited Boarding Houses Directory
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_boarding_houses` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(191) NOT NULL,
            `owner_name` VARCHAR(191) NOT NULL,
            `contact_number` VARCHAR(50) NOT NULL,
            `address` VARCHAR(255) NOT NULL,
            `barangay` VARCHAR(100) NOT NULL DEFAULT 'Brgy. Santol, Boac',
            `accreditation_status` ENUM('Accredited', 'Pending Accreditation', 'Under Inspection', 'Expired', 'Revoked') DEFAULT 'Accredited',
            `safety_rating` VARCHAR(10) DEFAULT 'A',
            `total_rooms` INT DEFAULT 10,
            `total_capacity` INT DEFAULT 30,
            `current_occupancy` INT DEFAULT 0,
            `monthly_rate_min` DECIMAL(10,2) DEFAULT 1200.00,
            `monthly_rate_max` DECIMAL(10,2) DEFAULT 2500.00,
            `amenities` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Room & Bed Inventory
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_rooms` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `boarding_house_id` INT NULL,
            `room_number` VARCHAR(50) NOT NULL,
            `room_type` ENUM('Single', 'Double', 'Triple', 'Quad', 'Dormitory') DEFAULT 'Double',
            `capacity` INT DEFAULT 2,
            `occupied_beds` INT DEFAULT 0,
            `monthly_rate` DECIMAL(10,2) NOT NULL DEFAULT 1500.00,
            `floor` VARCHAR(20) DEFAULT '1st Floor',
            `status` ENUM('Available', 'Partially Occupied', 'Full', 'Under Maintenance') DEFAULT 'Available',
            `amenities` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`boarding_house_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Resident Tenants
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_tenants` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_no` VARCHAR(64) NOT NULL,
            `first_name` VARCHAR(100) NOT NULL,
            `last_name` VARCHAR(100) NOT NULL,
            `gender` ENUM('Male', 'Female') DEFAULT 'Female',
            `email` VARCHAR(128) NULL,
            `contact_number` VARCHAR(50) NOT NULL,
            `college` VARCHAR(100) NOT NULL DEFAULT 'CICS',
            `program` VARCHAR(100) NOT NULL DEFAULT 'BSIT',
            `year_level` VARCHAR(20) NOT NULL DEFAULT '3rd Year',
            `boarding_house_id` INT NULL,
            `room_id` INT NULL,
            `bed_number` VARCHAR(20) DEFAULT 'Bed A',
            `move_in_date` DATE NOT NULL,
            `move_out_date` DATE NULL,
            `monthly_rent` DECIMAL(10,2) NOT NULL DEFAULT 1500.00,
            `balance` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `emergency_contact_name` VARCHAR(191) NULL,
            `emergency_contact_phone` VARCHAR(50) NULL,
            `status` ENUM('Active', 'Pending', 'Checked Out', 'Evicted') DEFAULT 'Active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`student_no`),
            INDEX (`boarding_house_id`),
            INDEX (`room_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Housing Applications & Reservations & Waiting List
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_applications` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_no` VARCHAR(64) NOT NULL,
            `full_name` VARCHAR(191) NOT NULL,
            `gender` ENUM('Male', 'Female') DEFAULT 'Female',
            `college` VARCHAR(100) NOT NULL DEFAULT 'CICS',
            `program` VARCHAR(100) NOT NULL DEFAULT 'BS Information Technology',
            `year_level` VARCHAR(20) NOT NULL DEFAULT '1st Year',
            `preferred_house` VARCHAR(191) NULL,
            `preferred_room_type` VARCHAR(50) DEFAULT 'Double',
            `target_move_in` DATE NOT NULL,
            `monthly_budget` DECIMAL(10,2) DEFAULT 1500.00,
            `guardian_name` VARCHAR(191) NULL,
            `guardian_contact` VARCHAR(50) NULL,
            `status` ENUM('Pending Review', 'Approved', 'Rejected', 'Waitlisted', 'Allocated') DEFAULT 'Pending Review',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`student_no`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Payment & Billing Records
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_payments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `tenant_id` INT NULL,
            `student_no` VARCHAR(64) NOT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `boarding_house_id` INT NULL,
            `or_number` VARCHAR(64) NOT NULL,
            `payment_type` ENUM('Monthly Rent', 'Security Deposit', 'Advance Payment', 'Utility Fee', 'Key Deposit') DEFAULT 'Monthly Rent',
            `amount` DECIMAL(10,2) NOT NULL,
            `payment_method` ENUM('Cash', 'GCash', 'Bank Transfer', 'Maya') DEFAULT 'Cash',
            `payment_date` DATE NOT NULL,
            `period_covered` VARCHAR(100) NOT NULL,
            `status` ENUM('Verified', 'Pending Verification', 'Rejected', 'Overdue') DEFAULT 'Verified',
            `remarks` VARCHAR(255) NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            INDEX (`tenant_id`),
            INDEX (`or_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Maintenance & Repairs
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_maintenance` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `ticket_number` VARCHAR(64) NOT NULL,
            `boarding_house_id` INT NULL,
            `room_number` VARCHAR(50) NOT NULL,
            `reported_by` VARCHAR(191) NOT NULL,
            `issue_category` ENUM('Plumbing', 'Electrical', 'Carpentry', 'Sanitation', 'Appliance', 'Security') DEFAULT 'Plumbing',
            `issue_title` VARCHAR(191) NOT NULL,
            `description` TEXT NOT NULL,
            `priority` ENUM('Low', 'Medium', 'High', 'Emergency') DEFAULT 'Medium',
            `status` ENUM('Open', 'In Progress', 'Under Review', 'Resolved', 'Cancelled') DEFAULT 'Open',
            `assigned_staff` VARCHAR(191) NULL,
            `estimated_cost` DECIMAL(10,2) DEFAULT 0.00,
            `resolution_notes` TEXT NULL,
            `reported_at` DATETIME NOT NULL,
            `resolved_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            INDEX (`ticket_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Housing Announcements
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_announcements` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(191) NOT NULL,
            `category` ENUM('General Notice', 'Safety Advisory', 'Curfew Reminder', 'Water/Power Interruption', 'Inspection Schedule') DEFAULT 'General Notice',
            `priority` ENUM('Normal', 'Important', 'Urgent') DEFAULT 'Normal',
            `content` TEXT NOT NULL,
            `target_audience` VARCHAR(100) DEFAULT 'All Residents',
            `published_by` VARCHAR(100) DEFAULT 'Housing Admin',
            `status` ENUM('Published', 'Draft', 'Archived') DEFAULT 'Published',
            `pinned` TINYINT(1) DEFAULT 0,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 8. Incident Reporting
        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_incidents` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `incident_no` VARCHAR(64) NOT NULL,
            `incident_type` ENUM('Curfew Violation', 'Noise Disturbance', 'Unauthorized Guest', 'Facility Misuse', 'Sanitation Issue', 'Dispute/Altercation') DEFAULT 'Curfew Violation',
            `location` VARCHAR(191) NOT NULL,
            `incident_date` DATE NOT NULL,
            `incident_time` TIME NOT NULL,
            `parties_involved` TEXT NOT NULL,
            `narrative` TEXT NOT NULL,
            `severity` ENUM('Minor', 'Moderate', 'Major') DEFAULT 'Minor',
            `status` ENUM('Under Investigation', 'Resolved', 'Referred to OSAS', 'Warning Issued') DEFAULT 'Under Investigation',
            `reported_by` VARCHAR(100) NOT NULL,
            `action_taken` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            INDEX (`incident_no`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `hsg_incidents`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_announcements`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_maintenance`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_payments`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_applications`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_tenants`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_rooms`;");
        $db->exec("DROP TABLE IF EXISTS `hsg_boarding_houses`;");
    }
};
