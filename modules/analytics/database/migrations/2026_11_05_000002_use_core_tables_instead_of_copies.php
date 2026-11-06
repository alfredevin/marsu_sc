<?php
/**
 * Module Migration: stop keeping copies of data the core tables already hold.
 *
 *  Dropped tables (data moved first):
 *   - ana_settings         -> core `settings` (group `analytics`, keys `analytics.*`)
 *   - ana_change_log       -> core `audit_logs` (actions `analytics.*`; rows already mirrored there are not copied twice)
 *   - ana_records          -> admin notes move to ana_dashboard_notes; attendance / task log lines were copies of
 *                             ana_attendance_records and audit entries and are not kept
 *   - ana_student_profiles -> the core `students` record is the student profile
 *
 *  Dropped columns (read through joins instead):
 *   - ana_classes: subject_code, subject_title, units (subjects), section_name (sections),
 *                  academic_year_id (semesters), room text -> room_id foreign key to core `rooms`
 *   - ana_attendance_records: subject_code (the class's subject)
 *   - ana_enrollments: program_id (students), academic_year_id (semesters)
 *
 * Every step prints what it moved. Table prefix: ana_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Policy settings -> core settings
        if ($this->tableExists('ana_settings')) {
            $n = $db->exec(
                "INSERT INTO `settings` (`key`, `value`, `group`, `created_at`, `updated_at`)
                 SELECT IF(s.`key` LIKE 'analytics.%', s.`key`, CONCAT('analytics.', s.`key`)), s.`value`, 'analytics', s.`created_at`, s.`updated_at`
                 FROM `ana_settings` s
                 ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `group` = 'analytics', `updated_at` = VALUES(`updated_at`)"
            );
            $this->report('settings moved to core settings', $n);
            $db->exec("DROP TABLE `ana_settings`");
        }

        // 2. Change log -> core audit_logs (ChangeLog already mirrored most rows there)
        if ($this->tableExists('ana_change_log')) {
            $n = $db->exec(
                "INSERT INTO `audit_logs` (`user_id`, `action`, `entity`, `entity_id`, `ip_address`, `user_agent`, `details`, `created_at`)
                 SELECT cl.changed_by, CONCAT('analytics.', cl.action), cl.entity, cl.entity_id, '127.0.0.1', 'migration',
                        JSON_OBJECT('field', cl.field, 'old', cl.old_value, 'new', cl.new_value, 'reason', cl.reason), cl.created_at
                 FROM `ana_change_log` cl
                 WHERE NOT EXISTS (SELECT 1 FROM `audit_logs` a
                                   WHERE a.action = CONCAT('analytics.', cl.action) AND a.entity = cl.entity AND a.entity_id = cl.entity_id
                                     AND ABS(TIMESTAMPDIFF(SECOND, a.created_at, cl.created_at)) <= 2)"
            );
            $this->report('change-log rows copied to audit_logs (the rest were already there)', $n);
            $db->exec("DROP TABLE `ana_change_log`");
        }

        // 3. Logbook: admin notes -> ana_dashboard_notes, generated log lines are dropped
        if ($this->tableExists('ana_records')) {
            $n = $db->exec(
                "INSERT INTO `ana_dashboard_notes` (`note`, `created_by`, `status`, `created_at`, `updated_at`)
                 SELECT TRIM(CONCAT(r.title, IF(r.description IS NULL OR r.description = '', '', CONCAT(' — ', r.description)))),
                        r.created_by, IF(r.deleted_at IS NULL AND r.status <> 'archived', 'active', 'archived'), r.created_at, r.updated_at
                 FROM `ana_records` r
                 WHERE r.created_by IS NOT NULL
                   AND r.title NOT LIKE 'Attendance: %' AND r.title NOT LIKE 'Task Exception: %' AND r.title NOT LIKE 'Absence Warning: %'"
            );
            $this->report('admin notes moved to ana_dashboard_notes', $n);
            $db->exec("DROP TABLE `ana_records`");
        }

        // 4. Supplementary profiles: the core students record is the profile
        if ($this->tableExists('ana_student_profiles')) {
            $this->report('ana_student_profiles rows dropped', (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_student_profiles`"));
            $db->exec("DROP TABLE `ana_student_profiles`");
        }
        $db->exec("DELETE rp FROM `role_permissions` rp JOIN `permissions` p ON p.id = rp.permission_id WHERE p.name = 'analytics.admin.profiles'");
        $this->report('permission analytics.admin.profiles removed', $db->exec("DELETE FROM `permissions` WHERE `name` = 'analytics.admin.profiles'"));

        // 5. ana_classes keeps ids only
        if ($this->columnExists('ana_classes', 'subject_code')) {
            $this->report('ana_classes subject_id filled from its subject code', $db->exec(
                "UPDATE `ana_classes` c JOIN `subjects` s ON s.code = c.subject_code AND s.deleted_at IS NULL SET c.subject_id = s.id WHERE c.subject_id IS NULL"
            ));
            foreach (Database::fetchAll(
                "SELECT c.id, c.subject_code, s.code FROM `ana_classes` c JOIN `subjects` s ON s.id = c.subject_id
                 WHERE c.deleted_at IS NULL AND c.subject_code <> s.code"
            ) as $r) {
                echo "  ! class #{$r['id']} said {$r['subject_code']} but its subject is {$r['code']}; {$r['code']} is kept\n";
            }
        }
        if (!$this->columnExists('ana_classes', 'room_id')) {
            $db->exec("ALTER TABLE `ana_classes` ADD COLUMN `room_id` INT NULL AFTER `schedule`,
                       ADD INDEX `idx_ana_classes_room` (`room_id`),
                       ADD CONSTRAINT `fk_ana_classes_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL");
        }
        if ($this->columnExists('ana_classes', 'room')) {
            $this->report('ana_classes rooms matched to core rooms', $db->exec(
                "UPDATE `ana_classes` c JOIN `rooms` r ON r.deleted_at IS NULL AND (r.room_number = TRIM(c.room) OR r.name = TRIM(c.room))
                 SET c.room_id = r.id WHERE c.room_id IS NULL AND c.room IS NOT NULL AND TRIM(c.room) <> ''"
            ));
            foreach (Database::fetchAll("SELECT id, room FROM `ana_classes` WHERE room_id IS NULL AND room IS NOT NULL AND TRIM(room) <> ''") as $r) {
                echo "  ! class #{$r['id']} room '{$r['room']}' is not in the core rooms table; pick the room again in the class settings\n";
            }
        }
        // The units range rule goes with the units column (units now come from subjects)
        if ($this->constraintExists('ana_classes', 'chk_ana_classes_units')) {
            $db->exec("ALTER TABLE `ana_classes` DROP CONSTRAINT `chk_ana_classes_units`");
        }
        if ($this->constraintExists('ana_classes', 'fk_ana_classes_ay')) {
            $db->exec("ALTER TABLE `ana_classes` DROP FOREIGN KEY `fk_ana_classes_ay`");
        }
        if ($this->indexExists('ana_classes', 'idx_fk_ana_classes_ay')) {
            $db->exec("ALTER TABLE `ana_classes` DROP INDEX `idx_fk_ana_classes_ay`");
        }
        $this->dropColumns('ana_classes', ['subject_code', 'subject_title', 'units', 'section_name', 'academic_year_id', 'room']);

        // 6. Attendance subject comes from its class
        $this->dropColumns('ana_attendance_records', ['subject_code']);

        // 7. Enrollment program comes from the student, academic year from the semester
        if ($this->columnExists('ana_enrollments', 'program_id')) {
            foreach (Database::fetchAll(
                "SELECT e.id, e.program_id, s.program_id AS student_program FROM `ana_enrollments` e JOIN `students` s ON s.id = e.student_id
                 WHERE e.program_id <> s.program_id"
            ) as $r) {
                echo "  ! enrollment #{$r['id']} had program {$r['program_id']}; the student's program {$r['student_program']} is used\n";
            }
        }
        foreach (['fk_ana_enr_program', 'fk_ana_enr_ay'] as $fk) {
            if ($this->constraintExists('ana_enrollments', $fk)) {
                $db->exec("ALTER TABLE `ana_enrollments` DROP FOREIGN KEY `{$fk}`");
            }
        }
        foreach (['idx_ana_enr_program', 'fk_ana_enr_ay'] as $idx) {
            if ($this->indexExists('ana_enrollments', $idx)) {
                $db->exec("ALTER TABLE `ana_enrollments` DROP INDEX `{$idx}`");
            }
        }
        $this->dropColumns('ana_enrollments', ['program_id', 'academic_year_id']);
    }

    public function down(): void {
        $db = Database::pdo();

        // Columns come back filled from the core tables they were copied from
        if (!$this->columnExists('ana_enrollments', 'program_id')) {
            $db->exec("ALTER TABLE `ana_enrollments` ADD COLUMN `academic_year_id` INT NULL AFTER `student_id`, ADD COLUMN `program_id` INT NULL AFTER `semester_id`");
            $db->exec("UPDATE `ana_enrollments` e JOIN `students` s ON s.id = e.student_id JOIN `semesters` sem ON sem.id = e.semester_id
                       SET e.program_id = s.program_id, e.academic_year_id = sem.academic_year_id");
            $db->exec("ALTER TABLE `ana_enrollments`
                       ADD INDEX `idx_ana_enr_program` (`program_id`), ADD INDEX `fk_ana_enr_ay` (`academic_year_id`),
                       ADD CONSTRAINT `fk_ana_enr_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
                       ADD CONSTRAINT `fk_ana_enr_ay` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE");
        }
        if (!$this->columnExists('ana_attendance_records', 'subject_code')) {
            $db->exec("ALTER TABLE `ana_attendance_records` ADD COLUMN `subject_code` VARCHAR(32) NULL AFTER `student_id`");
            $db->exec("UPDATE `ana_attendance_records` a JOIN `ana_classes` c ON c.id = a.class_id JOIN `subjects` s ON s.id = c.subject_id SET a.subject_code = s.code");
        }
        if (!$this->columnExists('ana_classes', 'subject_code')) {
            $db->exec("ALTER TABLE `ana_classes`
                       ADD COLUMN `subject_code` VARCHAR(32) NOT NULL DEFAULT '' AFTER `subject_id`,
                       ADD COLUMN `subject_title` VARCHAR(191) NOT NULL DEFAULT '' AFTER `subject_code`,
                       ADD COLUMN `units` DECIMAL(4,1) NOT NULL DEFAULT 3.0 AFTER `subject_title`,
                       ADD COLUMN `section_name` VARCHAR(64) NOT NULL DEFAULT '' AFTER `section_id`,
                       ADD COLUMN `room` VARCHAR(64) NULL AFTER `schedule`,
                       ADD COLUMN `academic_year_id` INT NULL AFTER `room`");
            $db->exec("UPDATE `ana_classes` c
                       LEFT JOIN `subjects` s ON s.id = c.subject_id LEFT JOIN `sections` sec ON sec.id = c.section_id
                       LEFT JOIN `semesters` sem ON sem.id = c.semester_id LEFT JOIN `rooms` r ON r.id = c.room_id
                       SET c.subject_code = COALESCE(s.code, ''), c.subject_title = COALESCE(s.title, ''), c.units = COALESCE(s.units, 3.0),
                           c.section_name = COALESCE(sec.name, ''), c.room = r.room_number, c.academic_year_id = sem.academic_year_id");
            $db->exec("ALTER TABLE `ana_classes` ADD INDEX `idx_fk_ana_classes_ay` (`academic_year_id`),
                       ADD CONSTRAINT `fk_ana_classes_ay` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE SET NULL,
                       ADD CONSTRAINT `chk_ana_classes_units` CHECK (`units` >= 0)");
        }
        if ($this->columnExists('ana_classes', 'room_id')) {
            $db->exec("ALTER TABLE `ana_classes` DROP FOREIGN KEY `fk_ana_classes_room`");
            $db->exec("ALTER TABLE `ana_classes` DROP INDEX `idx_ana_classes_room`, DROP COLUMN `room_id`");
        }

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_settings` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `key` VARCHAR(64) NOT NULL UNIQUE,
            `value` TEXT NOT NULL,
            `type` ENUM('int','decimal','bool','string') NOT NULL DEFAULT 'string',
            `label` VARCHAR(191) NOT NULL,
            `description` TEXT NULL,
            `min_value` DECIMAL(10,2) NULL,
            `max_value` DECIMAL(10,2) NULL,
            `updated_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
        $db->exec("INSERT IGNORE INTO `ana_settings` (`key`, `value`, `label`, `created_at`, `updated_at`)
                   SELECT IF(`key` = 'analytics.bottleneck_passing_rate', `key`, SUBSTRING(`key`, 11)), COALESCE(`value`, ''), `key`, `created_at`, `updated_at`
                   FROM `settings` WHERE `group` = 'analytics'");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_change_log` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `entity` VARCHAR(64) NOT NULL,
            `entity_id` INT NOT NULL,
            `action` VARCHAR(64) NOT NULL,
            `field` VARCHAR(64) NULL,
            `old_value` TEXT NULL,
            `new_value` TEXT NULL,
            `reason` TEXT NULL,
            `changed_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            INDEX `idx_ana_cl_entity` (`entity`, `entity_id`),
            FOREIGN KEY (`changed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(191) NOT NULL,
            `description` TEXT NULL,
            `status` ENUM('active','pending','resolved','archived') NOT NULL DEFAULT 'active',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_student_profiles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `student_id` INT NOT NULL UNIQUE,
            `living_arrangement` ENUM('with_family','boarding','dormitory','relatives','other') NOT NULL DEFAULT 'with_family',
            `commute_category` ENUM('local','moderate','distant') NOT NULL DEFAULT 'local',
            `is_working_student` TINYINT(1) NOT NULL DEFAULT 0,
            `is_scholar` TINYINT(1) NOT NULL DEFAULT 0,
            `scholarship_name` VARCHAR(191) NULL,
            `is_first_generation` TINYINT(1) NOT NULL DEFAULT 0,
            `notes` TEXT NULL,
            `updated_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    private function dropColumns(string $table, array $columns): void {
        $present = array_values(array_filter($columns, fn($c) => $this->columnExists($table, $c)));
        if ($present) {
            Database::pdo()->exec("ALTER TABLE `{$table}` " . implode(', ', array_map(fn($c) => "DROP COLUMN `{$c}`", $present)));
            echo "  - {$table}: dropped " . implode(', ', $present) . "\n";
        }
    }

    private function report(string $label, int|false $count): void {
        if ($count) {
            echo "  - {$label}: {$count}\n";
        }
    }

    private function tableExists(string $table): bool {
        return (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t",
            ['t' => $table]
        ) > 0;
    }

    private function columnExists(string $table, string $column): bool {
        return (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND COLUMN_NAME = :c",
            ['t' => $table, 'c' => $column]
        ) > 0;
    }

    private function indexExists(string $table, string $index): bool {
        return (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND INDEX_NAME = :i",
            ['t' => $table, 'i' => $index]
        ) > 0;
    }

    private function constraintExists(string $table, string $name): bool {
        return (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM information_schema.TABLE_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = :t AND CONSTRAINT_NAME = :n",
            ['t' => $table, 'n' => $name]
        ) > 0;
    }
};
