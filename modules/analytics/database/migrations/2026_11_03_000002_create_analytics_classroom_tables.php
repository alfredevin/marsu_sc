<?php
/**
 * Module Migration: Classroom features (class codes, join requests, stream posts, notifications)
 * Table prefix: ana_
 */

use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $columns = [
            'class_code'     => "ADD COLUMN `class_code` VARCHAR(8) NULL AFTER `id`",
            'description'    => "ADD COLUMN `description` TEXT NULL AFTER `section_name`",
            'schedule'       => "ADD COLUMN `schedule` VARCHAR(128) NULL AFTER `description`",
            'room'           => "ADD COLUMN `room` VARCHAR(64) NULL AFTER `schedule`",
            'scores_visible' => "ADD COLUMN `scores_visible` TINYINT(1) NOT NULL DEFAULT 0 AFTER `grade_status`",
        ];
        foreach ($columns as $col => $ddl) {
            if (!$this->columnExists('ana_classes', $col)) {
                $db->exec("ALTER TABLE `ana_classes` {$ddl}");
            }
        }

        // Backfill a unique class code for every existing class
        $rows = Database::fetchAll("SELECT `id` FROM `ana_classes` WHERE `class_code` IS NULL OR `class_code` = ''");
        foreach ($rows as $row) {
            do {
                $code = $this->randomCode();
                $taken = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_classes` WHERE `class_code` = :c", ['c' => $code]);
            } while ($taken > 0);
            Database::query("UPDATE `ana_classes` SET `class_code` = :c WHERE `id` = :id", ['c' => $code, 'id' => (int) $row['id']]);
        }

        if (!$this->indexExists('ana_classes', 'uq_ana_class_code')) {
            $db->exec("ALTER TABLE `ana_classes` ADD UNIQUE KEY `uq_ana_class_code` (`class_code`)");
        }

        // Faculty-assigned INC / DRP mark applied when grades are posted, and roster drop reason
        if (!$this->columnExists('ana_class_students', 'grade_mark')) {
            $db->exec("ALTER TABLE `ana_class_students` ADD COLUMN `grade_mark` ENUM('INC', 'DRP') NULL AFTER `status`");
        }
        if (!$this->columnExists('ana_class_students', 'drop_reason')) {
            $db->exec("ALTER TABLE `ana_class_students` ADD COLUMN `drop_reason` VARCHAR(255) NULL AFTER `grade_mark`");
        }

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_class_join_requests` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `status` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
            `decided_by` INT NULL,
            `decided_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            UNIQUE KEY `uq_ana_join` (`class_id`, `student_id`),
            INDEX `idx_ana_join_status` (`class_id`, `status`),
            CONSTRAINT `fk_ana_join_class` FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_join_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_join_decider` FOREIGN KEY (`decided_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_class_posts` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `class_id` INT NOT NULL,
            `author_user_id` INT NULL,
            `type` ENUM('announcement', 'material') NOT NULL DEFAULT 'announcement',
            `title` VARCHAR(191) NOT NULL,
            `body` TEXT NULL,
            `attachment_path` VARCHAR(255) NULL,
            `attachment_name` VARCHAR(191) NULL,
            `attachment_size` INT NULL,
            `is_pinned` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_ana_posts_class` (`class_id`, `deleted_at`),
            CONSTRAINT `fk_ana_posts_class` FOREIGN KEY (`class_id`) REFERENCES `ana_classes` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ana_posts_author` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `ana_notifications` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `title` VARCHAR(191) NOT NULL,
            `body` TEXT NULL,
            `link` VARCHAR(255) NULL,
            `read_at` DATETIME NULL,
            `created_at` DATETIME NOT NULL,
            INDEX `idx_ana_notif_user` (`user_id`, `read_at`),
            CONSTRAINT `fk_ana_notif_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `ana_notifications`;");
        $db->exec("DROP TABLE IF EXISTS `ana_class_posts`;");
        $db->exec("DROP TABLE IF EXISTS `ana_class_join_requests`;");
        foreach (['drop_reason', 'grade_mark'] as $col) {
            if ($this->columnExists('ana_class_students', $col)) {
                $db->exec("ALTER TABLE `ana_class_students` DROP COLUMN `{$col}`");
            }
        }
        if ($this->indexExists('ana_classes', 'uq_ana_class_code')) {
            $db->exec("ALTER TABLE `ana_classes` DROP INDEX `uq_ana_class_code`");
        }
        foreach (['scores_visible', 'room', 'schedule', 'description', 'class_code'] as $col) {
            if ($this->columnExists('ana_classes', $col)) {
                $db->exec("ALTER TABLE `ana_classes` DROP COLUMN `{$col}`");
            }
        }
    }

    private function randomCode(): string {
        $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        return $code;
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
};
