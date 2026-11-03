<?php
/**
 * Module Migration: Convert ana_attendance_records / ana_behavior_records.student_id
 * from VARCHAR student numbers to INT foreign keys on students(id), and add
 * explicit void columns to attendance (the table never had deleted_at).
 * Rows whose student number cannot be matched are reported and kept with student_id NULL.
 * Table prefix: ana_
 */

use Core\Database;

return new class {
    private array $tables = [
        'ana_attendance_records' => ['index' => 'idx_ana_att_student_id', 'fk' => 'fk_ana_att_student'],
        'ana_behavior_records'   => ['index' => 'idx_ana_beh_student_id', 'fk' => 'fk_ana_beh_student'],
    ];

    public function up(): void {
        $db = Database::pdo();

        foreach ($this->tables as $table => $names) {
            if ($this->columnType($table, 'student_id') === 'int') {
                continue;
            }

            if (!$this->columnExists($table, 'student_ref')) {
                $db->exec("ALTER TABLE `{$table}` ADD COLUMN `student_ref` INT NULL AFTER `student_id`");
            }

            $db->exec("UPDATE `{$table}` t
                       JOIN `students` s ON s.student_number = t.student_id
                       SET t.student_ref = s.id
                       WHERE t.student_ref IS NULL");

            $unmapped = Database::fetchAll("SELECT `id`, `student_id` FROM `{$table}` WHERE `student_ref` IS NULL");
            if (!empty($unmapped)) {
                echo "  ! {$table}: " . count($unmapped) . " row(s) reference unknown student numbers and were kept with student_id NULL:\n";
                foreach ($unmapped as $row) {
                    echo "      row #{$row['id']} -> '{$row['student_id']}'\n";
                }
            }

            if ($this->indexExists($table, $names['index'])) {
                $db->exec("ALTER TABLE `{$table}` DROP INDEX `{$names['index']}`");
            }
            $db->exec("ALTER TABLE `{$table}` DROP COLUMN `student_id`");
            $db->exec("ALTER TABLE `{$table}` CHANGE `student_ref` `student_id` INT NULL");
            $db->exec("ALTER TABLE `{$table}` ADD INDEX `{$names['index']}` (`student_id`)");
            $db->exec("ALTER TABLE `{$table}` ADD CONSTRAINT `{$names['fk']}` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE");
        }

        if (!$this->columnExists('ana_attendance_records', 'voided_at')) {
            $db->exec("ALTER TABLE `ana_attendance_records` ADD COLUMN `voided_at` DATETIME NULL AFTER `void_reason`");
        }
        if (!$this->columnExists('ana_attendance_records', 'voided_by')) {
            $db->exec("ALTER TABLE `ana_attendance_records` ADD COLUMN `voided_by` INT NULL AFTER `voided_at`");
            $db->exec("ALTER TABLE `ana_attendance_records` ADD CONSTRAINT `fk_ana_att_voided_by` FOREIGN KEY (`voided_by`) REFERENCES `users` (`id`) ON DELETE SET NULL");
        }
        if (!$this->indexExists('ana_attendance_records', 'idx_ana_att_session')) {
            $db->exec("ALTER TABLE `ana_attendance_records` ADD INDEX `idx_ana_att_session` (`class_id`, `session_date`)");
        }
    }

    public function down(): void {
        $db = Database::pdo();

        if ($this->columnExists('ana_attendance_records', 'voided_by')) {
            $db->exec("ALTER TABLE `ana_attendance_records` DROP FOREIGN KEY `fk_ana_att_voided_by`");
            $db->exec("ALTER TABLE `ana_attendance_records` DROP COLUMN `voided_by`");
        }
        if ($this->columnExists('ana_attendance_records', 'voided_at')) {
            $db->exec("ALTER TABLE `ana_attendance_records` DROP COLUMN `voided_at`");
        }
        if ($this->indexExists('ana_attendance_records', 'idx_ana_att_session')) {
            $db->exec("ALTER TABLE `ana_attendance_records` DROP INDEX `idx_ana_att_session`");
        }

        foreach ($this->tables as $table => $names) {
            if ($this->columnType($table, 'student_id') !== 'int') {
                continue;
            }
            $db->exec("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$names['fk']}`");
            $db->exec("ALTER TABLE `{$table}` DROP INDEX `{$names['index']}`");
            $db->exec("ALTER TABLE `{$table}` ADD COLUMN `student_number_ref` VARCHAR(64) NULL AFTER `student_id`");
            $db->exec("UPDATE `{$table}` t JOIN `students` s ON s.id = t.student_id SET t.student_number_ref = s.student_number");
            $db->exec("ALTER TABLE `{$table}` DROP COLUMN `student_id`");
            $db->exec("UPDATE `{$table}` SET `student_number_ref` = '' WHERE `student_number_ref` IS NULL");
            $db->exec("ALTER TABLE `{$table}` CHANGE `student_number_ref` `student_id` VARCHAR(64) NOT NULL");
            $db->exec("ALTER TABLE `{$table}` ADD INDEX `{$names['index']}` (`student_id`)");
        }
    }

    private function columnType(string $table, string $column): ?string {
        $type = Database::fetchColumn(
            "SELECT DATA_TYPE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND COLUMN_NAME = :c",
            ['t' => $table, 'c' => $column]
        );
        return $type === false ? null : strtolower((string) $type);
    }

    private function columnExists(string $table, string $column): bool {
        return $this->columnType($table, $column) !== null;
    }

    private function indexExists(string $table, string $index): bool {
        return (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND INDEX_NAME = :i",
            ['t' => $table, 'i' => $index]
        ) > 0;
    }
};
