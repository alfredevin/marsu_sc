<?php

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Organization Profiles (Table 1: Organization_tbl)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organizations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(191) NOT NULL,
            `organization_name` VARCHAR(150) NULL,
            `acronym` VARCHAR(50) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `description` TEXT NULL,
            `email` VARCHAR(150) NULL,
            `contact_number` VARCHAR(20) NULL,
            `adviser` VARCHAR(191) NOT NULL,
            `school_year` VARCHAR(20) NULL,
            `status` VARCHAR(50) NOT NULL DEFAULT 'Pending Accreditation',
            `accreditation_date` DATE NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            UNIQUE KEY `uq_sld_organizations_acronym` (`acronym`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Organization Accreditations (Table 2: Organization_accreditation)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organization_accreditations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `school_year` VARCHAR(20) NOT NULL,
            `submitted_at` DATETIME NOT NULL,
            `decision_date` DATE NULL,
            `decision_status` ENUM('Pending', 'Approved', 'Rejected', 'Returned') NOT NULL DEFAULT 'Pending',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_org_accred_org` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Organization Members (Table 3: Organization_memberships & member directory)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_members` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `member_name` VARCHAR(191) NOT NULL,
            `student_number` VARCHAR(50) NULL,
            `role` VARCHAR(100) NOT NULL DEFAULT 'Member',
            `joined_at` DATE NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'Active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_members_organization` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organization_memberships` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `student_id` VARCHAR(50) NOT NULL,
            `joined_date` DATE NOT NULL,
            `membership_status` ENUM('Pending', 'Active', 'Inactive', 'Removed') NOT NULL DEFAULT 'Active',
            `school_year` VARCHAR(20) NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_org_memberships_org` (`organization_id`),
            INDEX `idx_sld_org_memberships_student` (`student_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Organization Classification (Table 4: Organization_classification)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organization_classifications` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `classification_name` VARCHAR(80) NOT NULL,
            `description` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            UNIQUE KEY `uq_sld_classification_name` (`classification_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Officers (Table 5: Officers Table)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_officers` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(50) NOT NULL,
            `organization_id` INT NOT NULL,
            `profile_summary` TEXT NULL,
            `officers_status` ENUM('Active', 'Inactive', 'Graduated', 'Removed') NOT NULL DEFAULT 'Active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_officers_org` (`organization_id`),
            INDEX `idx_sld_officers_student` (`student_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Leadership Positions (Table 6: Leadership_position)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_leadership_positions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `position_name` VARCHAR(80) NOT NULL,
            `description` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            UNIQUE KEY `uq_sld_position_name` (`position_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Leadership Terms (Table 8: Leadership_terms - before appointments for FK)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_leadership_terms` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `term_name` VARCHAR(50) NOT NULL,
            `start_date` DATE NOT NULL,
            `end_date` DATE NOT NULL,
            `term_status` ENUM('Upcoming', 'Current', 'Completed') NOT NULL DEFAULT 'Upcoming',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_terms_org` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 8. Officer Appointments (Table 7: Officer_appointment)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_officer_appointments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `officer_id` INT NOT NULL,
            `position_id` INT NOT NULL,
            `organization_id` INT NOT NULL,
            `term_id` INT NOT NULL,
            `start_date` DATE NOT NULL,
            `end_date` DATE NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_app_officer` (`officer_id`),
            INDEX `idx_sld_app_pos` (`position_id`),
            INDEX `idx_sld_app_org` (`organization_id`),
            INDEX `idx_sld_app_term` (`term_id`),
            FOREIGN KEY (`officer_id`) REFERENCES `sld_officers` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`position_id`) REFERENCES `sld_leadership_positions` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`term_id`) REFERENCES `sld_leadership_terms` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 9. Leadership Training (Table 9: Leadership_training)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_leadership_trainings` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `officer_id` INT NOT NULL,
            `training_title` VARCHAR(150) NOT NULL,
            `training_date` DATE NOT NULL,
            `provider` VARCHAR(150) NULL,
            `completion_status` ENUM('Registered', 'Attended', 'Completed', 'Not Completed') NOT NULL DEFAULT 'Registered',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_training_officer` (`officer_id`),
            FOREIGN KEY (`officer_id`) REFERENCES `sld_officers` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 10. Activity Proposals (Table 10: Activity_proposal)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_activity_proposals` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `submitted_by_student_id` VARCHAR(50) NOT NULL,
            `activity_title` VARCHAR(180) NOT NULL,
            `objectives` TEXT NOT NULL,
            `proposed_date` DATE NOT NULL,
            `proposed_budget` DECIMAL(10,2) NULL DEFAULT 0.00,
            `submitted_at` DATETIME NOT NULL,
            `proposal_status` ENUM('Draft', 'Submitted', 'Under Review', 'Approved', 'Rejected', 'Revision Required') NOT NULL DEFAULT 'Draft',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_prop_org` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 11. Event Approvals (Table 11: Event_approval)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_event_approvals` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `proposal_id` INT NOT NULL,
            `approver_student_id` VARCHAR(50) NULL,
            `approval_step` TINYINT NOT NULL DEFAULT 1,
            `decision` ENUM('Pending', 'Approved', 'Rejected', 'Revision Required') NOT NULL DEFAULT 'Pending',
            `decision_at` DATETIME NULL,
            `comments` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_apprv_proposal` (`proposal_id`),
            FOREIGN KEY (`proposal_id`) REFERENCES `sld_activity_proposals` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 12. Venues (Table 12: Venues)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_venues` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `venue_name` VARCHAR(120) NOT NULL,
            `venue_status` ENUM('Available', 'Unavailable', 'Maintenance') NOT NULL DEFAULT 'Available',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 13. Activity Calendar
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_activity_calendar` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `proposal_id` INT NULL,
            `organization_id` INT NOT NULL,
            `venue_id` INT NULL,
            `activity_title` VARCHAR(180) NOT NULL,
            `start_datetime` DATETIME NOT NULL,
            `end_datetime` DATETIME NULL,
            `status` VARCHAR(50) NOT NULL DEFAULT 'Scheduled',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_cal_org` (`organization_id`),
            INDEX `idx_sld_cal_prop` (`proposal_id`),
            INDEX `idx_sld_cal_venue` (`venue_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`proposal_id`) REFERENCES `sld_activity_proposals` (`id`) ON DELETE SET NULL,
            FOREIGN KEY (`venue_id`) REFERENCES `sld_venues` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 14. Event Documentation (Table 13: Event_documentation)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_event_documentations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `calendar_id` INT NOT NULL,
            `document_type` VARCHAR(50) NOT NULL,
            `file_name` VARCHAR(255) NOT NULL,
            `file_path` VARCHAR(500) NOT NULL,
            `uploaded_at` DATETIME NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_doc_cal` (`calendar_id`),
            FOREIGN KEY (`calendar_id`) REFERENCES `sld_activity_calendar` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 15. Activity Attendance (Table 14: Activity_attendance)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_activity_attendances` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `calendar_id` INT NOT NULL,
            `student_id` VARCHAR(50) NOT NULL,
            `attendance_status` ENUM('Present', 'Late', 'Excused', 'Absent') NOT NULL DEFAULT 'Present',
            `time_in` TIME NULL,
            `time_out` TIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_att_cal` (`calendar_id`),
            INDEX `idx_sld_att_student` (`student_id`),
            FOREIGN KEY (`calendar_id`) REFERENCES `sld_activity_calendar` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 16. Student Participation (Table 15: Student_Participation)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_student_participations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `calendar_id` INT NOT NULL,
            `student_id` VARCHAR(50) NOT NULL,
            `participation_role` VARCHAR(100) NULL,
            `contribution_details` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_part_cal` (`calendar_id`),
            INDEX `idx_sld_part_student` (`student_id`),
            FOREIGN KEY (`calendar_id`) REFERENCES `sld_activity_calendar` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 17. Engagement Credits (Table 16: Engagement_credits)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_engagement_credits` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(50) NOT NULL,
            `calendar_id` INT NULL,
            `points` DECIMAL(7,2) NOT NULL DEFAULT 0.00,
            `reason` VARCHAR(180) NOT NULL,
            `awarded_at` DATETIME NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_cred_student` (`student_id`),
            INDEX `idx_sld_cred_cal` (`calendar_id`),
            FOREIGN KEY (`calendar_id`) REFERENCES `sld_activity_calendar` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 18. Student Recognition (Table 17: Student_Recognition)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_student_recognitions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` VARCHAR(50) NOT NULL,
            `recognition_title` VARCHAR(150) NOT NULL,
            `recognition_date` DATE NOT NULL,
            `description` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_recog_student` (`student_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 19. Announcements (Table 18: Announcements)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_announcements` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NULL,
            `title` VARCHAR(180) NOT NULL,
            `message` TEXT NOT NULL,
            `published_by_student_id` VARCHAR(50) NOT NULL,
            `published_at` DATETIME NOT NULL,
            `announcement_status` ENUM('Draft', 'Published', 'Archived') NOT NULL DEFAULT 'Draft',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_ann_org` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 20. Organization Performance Snapshots (Table 19: Organization_performance_snapshot)
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organization_performance_snapshots` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `reporting_period` VARCHAR(20) NOT NULL,
            `activities_count` INT NOT NULL DEFAULT 0,
            `active_members_count` INT NOT NULL DEFAULT 0,
            `accomplishments_summary` TEXT NULL,
            `generated_at` DATETIME NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_snap_org` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $tables = [
            'sld_organization_performance_snapshots',
            'sld_announcements',
            'sld_student_recognitions',
            'sld_engagement_credits',
            'sld_student_participations',
            'sld_activity_attendances',
            'sld_event_documentations',
            'sld_activity_calendar',
            'sld_venues',
            'sld_event_approvals',
            'sld_activity_proposals',
            'sld_leadership_trainings',
            'sld_officer_appointments',
            'sld_leadership_terms',
            'sld_leadership_positions',
            'sld_officers',
            'sld_organization_classifications',
            'sld_organization_memberships',
            'sld_members',
            'sld_organization_accreditations',
            'sld_organizations'
        ];

        foreach ($tables as $tbl) {
            $db->exec("DROP TABLE IF EXISTS `{$tbl}`;");
        }
    }
};
