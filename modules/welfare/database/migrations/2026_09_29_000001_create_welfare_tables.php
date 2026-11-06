<?php
/**
 * Module Migration for Student Welfare Services & Financial Grants Management
 * Table prefix: wlf_
 */

use Core\Database;

return new class {
    public function up(): void
    {
        $db = Database::pdo();

        // 1. General Welfare Baseline Records
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_records` (
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

        // 2. Concern Types Maintenance Directory
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_concern_types` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(191) NOT NULL,
            `code` VARCHAR(50) NULL,
            `category` VARCHAR(100) DEFAULT 'General',
            `description` TEXT NULL,
            `status` ENUM('active', 'inactive', 'archived') NOT NULL DEFAULT 'active',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Socio-Economic Background Records
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_socio_economic_profiles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` INT NULL,
            `student_number` VARCHAR(64) NOT NULL,
            `full_name` VARCHAR(191) NOT NULL,
            `household_size` INT DEFAULT 4,
            `financial_category` ENUM('Low income', 'Moderate income', 'High income') DEFAULT 'Low income',
            `primary_income_source` VARCHAR(191) NULL,
            `monthly_household_income` DECIMAL(12,2) DEFAULT 0.00,
            `living_arrangement` VARCHAR(100) DEFAULT 'With family',
            `status` ENUM('For review', 'Reviewed', 'Verified', 'archived') DEFAULT 'For review',
            `notes` TEXT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`student_number`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Support Assessment Management
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_support_assessments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `assessment_id` VARCHAR(64) NOT NULL UNIQUE,
            `student_id` INT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `support_need` VARCHAR(191) NOT NULL,
            `priority` ENUM('Low', 'Medium', 'High', 'Urgent') DEFAULT 'Medium',
            `recommended_action` TEXT NULL,
            `assessment_date` DATE NOT NULL,
            `status` ENUM('For referral', 'In progress', 'Under review', 'Completed', 'archived') DEFAULT 'Under review',
            `notes` TEXT NULL,
            `assessed_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`assessment_id`),
            FOREIGN KEY (`assessed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Welfare History Records
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_welfare_history` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `record_id` VARCHAR(64) NOT NULL UNIQUE,
            `student_name` VARCHAR(191) NOT NULL,
            `record_date` DATE NOT NULL,
            `record_type` VARCHAR(100) NOT NULL,
            `summary` TEXT NOT NULL,
            `status` ENUM('Pending', 'Scheduled', 'In progress', 'Completed', 'archived') DEFAULT 'Completed',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`record_id`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Student Complaints and Cases Management
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_cases` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `case_number` VARCHAR(64) NOT NULL UNIQUE,
            `student_id` INT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `case_type` VARCHAR(100) NOT NULL DEFAULT 'Grievance',
            `office_concerned` VARCHAR(100) NULL,
            `priority` ENUM('Low', 'Moderate', 'Urgent') DEFAULT 'Moderate',
            `subject` VARCHAR(255) NOT NULL,
            `description` TEXT NOT NULL,
            `status` ENUM('Open', 'Initial Intake', 'Under Investigation', 'Ongoing', 'Urgent', 'Resolved', 'Closed', 'archived') DEFAULT 'Open',
            `date_filed` DATE NOT NULL,
            `logged_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`case_number`),
            FOREIGN KEY (`logged_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Case Follow-up Monitoring
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_case_followups` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `followup_id` VARCHAR(64) NOT NULL UNIQUE,
            `case_number` VARCHAR(64) NOT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `followup_date` DATE NOT NULL,
            `assigned_personnel` VARCHAR(191) NOT NULL,
            `notes` TEXT NOT NULL,
            `status` ENUM('Scheduled', 'Due', 'Completed', 'Cancelled', 'archived') DEFAULT 'Scheduled',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`followup_id`),
            INDEX (`case_number`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 8. Case Resolution Tracking
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_case_resolutions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `case_number` VARCHAR(64) NOT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `resolution_date` DATE NOT NULL,
            `verified_by` VARCHAR(191) NOT NULL,
            `action_taken` TEXT NOT NULL,
            `status` ENUM('Pending Review', 'Action in Progress', 'Resolved', 'Closed', 'archived') DEFAULT 'Resolved',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`case_number`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 9. Financial Aid & Scholarship Grants Records
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_financial_grants` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `grant_id` VARCHAR(64) NOT NULL UNIQUE,
            `student_id` INT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `program_type` VARCHAR(100) NOT NULL,
            `amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `fund_source` VARCHAR(191) DEFAULT 'OSAS Welfare Fund',
            `disbursing_officer` VARCHAR(191) NULL,
            `disbursement_date` DATE NULL,
            `status` ENUM('Under Review', 'Processing', 'Approved for Release', 'Disbursed', 'Pending Clearance', 'archived') DEFAULT 'Under Review',
            `remarks` TEXT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`grant_id`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 10. Student Support Programs Directory
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_support_programs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `program_code` VARCHAR(64) NOT NULL UNIQUE,
            `title` VARCHAR(191) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `coordinator` VARCHAR(191) NOT NULL,
            `beneficiary_count` INT DEFAULT 0,
            `scope_objectives` TEXT NULL,
            `status` ENUM('Accepting Applications', 'Active Services', 'Under Review', 'Inactive', 'archived') DEFAULT 'Active Services',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`program_code`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 11. Counseling Referrals
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_counseling_referrals` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `referral_code` VARCHAR(64) NOT NULL UNIQUE,
            `student_name` VARCHAR(191) NOT NULL,
            `referred_by` VARCHAR(191) NOT NULL,
            `referral_date` DATE NOT NULL,
            `concern_reason` TEXT NOT NULL,
            `status` ENUM('Pending', 'Assessed', 'In Counseling', 'Completed', 'archived') DEFAULT 'Pending',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`referral_code`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 12. Intervention Plans
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_intervention_plans` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `plan_id` VARCHAR(64) NOT NULL UNIQUE,
            `case_number` VARCHAR(64) NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `assigned_lead` VARCHAR(191) NOT NULL,
            `action_plan` TEXT NOT NULL,
            `next_review_date` DATE NULL,
            `status` ENUM('Draft', 'In Progress', 'Due for Review', 'Completed', 'archived') DEFAULT 'In Progress',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`plan_id`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 13. Assigned Caseworkers & Personnel
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_assigned_personnel` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `assignment_id` VARCHAR(64) NOT NULL UNIQUE,
            `case_number` VARCHAR(64) NOT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `role` VARCHAR(100) NOT NULL,
            `personnel_name` VARCHAR(191) NOT NULL,
            `assigned_date` DATE NOT NULL,
            `status` ENUM('Active', 'Completed', 'archived') DEFAULT 'Active',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`assignment_id`),
            INDEX (`case_number`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 14. Intervention Progress Tracking
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_progress_tracking` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `progress_id` VARCHAR(64) NOT NULL UNIQUE,
            `case_number` VARCHAR(64) NOT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `milestone` VARCHAR(255) NOT NULL,
            `next_step` TEXT NULL,
            `update_date` DATE NOT NULL,
            `status` ENUM('Not Started', 'In Progress', 'On Track', 'Needs Attention', 'Completed', 'archived') DEFAULT 'In Progress',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`progress_id`),
            INDEX (`case_number`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 15. Outcome Evaluations
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_outcome_evaluations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `evaluation_id` VARCHAR(64) NOT NULL UNIQUE,
            `case_number` VARCHAR(64) NOT NULL,
            `student_name` VARCHAR(191) NOT NULL,
            `intervention_type` VARCHAR(191) NOT NULL,
            `evaluation_date` DATE NOT NULL,
            `status` ENUM('Effective', 'Monitoring', 'Verifying', 'Pending', 'archived') DEFAULT 'Effective',
            `summary_recommendations` TEXT NOT NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`evaluation_id`),
            INDEX (`case_number`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 16. Consultations & Appointments Booking
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_appointments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `appointment_id` VARCHAR(64) NOT NULL UNIQUE,
            `student_name` VARCHAR(191) NOT NULL,
            `service_requested` VARCHAR(100) NOT NULL,
            `assigned_staff` VARCHAR(191) NOT NULL,
            `venue` VARCHAR(191) NOT NULL DEFAULT 'OSAS Office (Room 102)',
            `schedule_datetime` DATETIME NOT NULL,
            `notes` TEXT NULL,
            `status` ENUM('Pending Approval', 'Confirmed', 'Completed', 'Cancelled', 'archived') DEFAULT 'Pending Approval',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`appointment_id`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 17. Advisories & Emergency Announcements
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_advisories` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `advisory_id` VARCHAR(64) NOT NULL UNIQUE,
            `headline` VARCHAR(255) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `issuing_officer` VARCHAR(191) NOT NULL,
            `target_audience` VARCHAR(191) NOT NULL DEFAULT 'All Students',
            `post_date` DATE NOT NULL,
            `priority` ENUM('Low', 'Normal', 'High', 'Urgent') DEFAULT 'Normal',
            `content` TEXT NULL,
            `status` ENUM('Published', 'Draft', 'archived') DEFAULT 'Published',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`advisory_id`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 18. Student Health & Welfare Concerns Registry
        $db->exec("CREATE TABLE IF NOT EXISTS `wlf_student_concerns` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `concern_id` VARCHAR(64) NOT NULL UNIQUE,
            `student_name` VARCHAR(191) NOT NULL,
            `concern_type` VARCHAR(100) NOT NULL,
            `consultation_date` DATE NOT NULL,
            `attending_staff` VARCHAR(191) NOT NULL,
            `action_plan` TEXT NULL,
            `status` ENUM('Active', 'Under Monitoring', 'Cleared', 'archived') DEFAULT 'Active',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`concern_id`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void
    {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `wlf_student_concerns`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_advisories`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_appointments`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_outcome_evaluations`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_progress_tracking`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_assigned_personnel`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_intervention_plans`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_counseling_referrals`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_support_programs`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_financial_grants`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_case_resolutions`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_case_followups`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_cases`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_welfare_history`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_support_assessments`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_socio_economic_profiles`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_concern_types`;");
        $db->exec("DROP TABLE IF EXISTS `wlf_records`;");
    }
};
