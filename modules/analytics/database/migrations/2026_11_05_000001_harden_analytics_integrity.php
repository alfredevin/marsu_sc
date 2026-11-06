<?php
/**
 * Module Migration: data-integrity hardening for the analytics tables.
 *  - ana_classes term / template columns get real foreign keys (they were plain INTs)
 *  - rows pointing at a repeated semester row are moved to the first row of that term
 *  - blank subject / section snapshots and attendance subject codes are filled from their class
 *  - grades and scores of students who were never on the class roster are removed
 *  - attendance allows one live (non-voided) mark per student per class session
 *  - CHECK constraints keep scores, grades, cutoffs and year levels inside their valid ranges
 * Every repair prints what it changed. Table prefix: ana_
 */

use Core\Database;

return new class {
    private array $foreignKeys = [
        'fk_ana_classes_ay'       => ['academic_year_id', 'academic_years'],
        'fk_ana_classes_sem'      => ['semester_id', 'semesters'],
        'fk_ana_classes_template' => ['template_id', 'ana_grading_templates'],
    ];

    private array $checks = [
        'chk_ana_scores_score'    => ['ana_class_scores', '`score` IS NULL OR `score` >= 0'],
        'chk_ana_grades_computed' => ['ana_class_grades', '`computed_grade` IS NULL OR `computed_grade` BETWEEN 1 AND 5'],
        'chk_ana_classes_cutoff'  => ['ana_classes', '`passing_cutoff` BETWEEN 1 AND 5'],
        'chk_ana_classes_units'   => ['ana_classes', '`units` >= 0'],
        'chk_ana_tpl_cutoff'      => ['ana_grading_templates', '`passing_cutoff` BETWEEN 1 AND 5'],
        'chk_ana_enr_year_level'  => ['ana_enrollments', '`year_level` BETWEEN 1 AND 6'],
    ];

    public function up(): void {
        $db = Database::pdo();

        // 1. One semester_id per term: repoint rows that use a repeated semester row
        $canonical = "(SELECT MIN(s2.id) FROM `semesters` s2 WHERE s2.academic_year_id = s.academic_year_id AND s2.code = s.code)";
        $this->report('ana_classes moved to the first semester row of their term', $db->exec(
            "UPDATE `ana_classes` c JOIN `semesters` s ON s.id = c.semester_id
             SET c.semester_id = {$canonical}, c.academic_year_id = s.academic_year_id
             WHERE c.semester_id <> {$canonical}"
        ));
        // UPDATE IGNORE skips an enrollment that would collide with one already on the first row
        $this->report('ana_enrollments moved to the first semester row of their term', $db->exec(
            "UPDATE IGNORE `ana_enrollments` e JOIN `semesters` s ON s.id = e.semester_id
             SET e.semester_id = {$canonical}
             WHERE e.semester_id <> {$canonical}"
        ));

        // 2. Term / template references must exist before they become foreign keys
        $this->report('ana_classes academic years filled from their semester', $db->exec(
            "UPDATE `ana_classes` c JOIN `semesters` s ON s.id = c.semester_id
             SET c.academic_year_id = s.academic_year_id
             WHERE c.academic_year_id IS NULL OR c.academic_year_id <> s.academic_year_id"
        ));
        foreach ($this->foreignKeys as [$column, $parent]) {
            $this->report("ana_classes.{$column} cleared (pointed at a missing {$parent} row)", $db->exec(
                "UPDATE `ana_classes` c LEFT JOIN `{$parent}` p ON p.id = c.`{$column}`
                 SET c.`{$column}` = NULL WHERE c.`{$column}` IS NOT NULL AND p.id IS NULL"
            ));
        }
        foreach ($this->foreignKeys as $name => [$column, $parent]) {
            if (!$this->constraintExists('ana_classes', $name)) {
                if (!$this->indexExists('ana_classes', "idx_{$name}")) {
                    $db->exec("ALTER TABLE `ana_classes` ADD INDEX `idx_{$name}` (`{$column}`)");
                }
                $db->exec("ALTER TABLE `ana_classes` ADD CONSTRAINT `{$name}` FOREIGN KEY (`{$column}`) REFERENCES `{$parent}` (`id`) ON DELETE SET NULL");
            }
        }

        // 3. Snapshots: blank subject / section labels come from the linked master rows
        $this->report('ana_classes blank subject snapshots filled', $db->exec(
            "UPDATE `ana_classes` c JOIN `subjects` s ON s.id = c.subject_id
             SET c.subject_code = s.code, c.subject_title = s.title
             WHERE TRIM(c.subject_code) = '' OR TRIM(c.subject_title) = ''"
        ));
        $this->report('ana_classes blank section snapshots filled', $db->exec(
            "UPDATE `ana_classes` c JOIN `sections` s ON s.id = c.section_id
             SET c.section_name = s.name
             WHERE TRIM(c.section_name) = ''"
        ));
        $this->report('ana_attendance_records subject codes aligned with their class', $db->exec(
            "UPDATE `ana_attendance_records` a JOIN `ana_classes` c ON c.id = a.class_id
             SET a.subject_code = c.subject_code
             WHERE a.subject_code IS NULL OR a.subject_code <> c.subject_code"
        ));

        // 4. Grades and scores belong to roster rows (dropped students keep theirs)
        foreach (['ana_class_grades', 'ana_class_scores'] as $table) {
            $this->report("{$table} removed (student was never on the class roster)", $db->exec(
                "DELETE t FROM `{$table}` t
                 LEFT JOIN `ana_class_students` cs ON cs.class_id = t.class_id AND cs.student_id = t.student_id
                 WHERE cs.id IS NULL"
            ));
        }

        // 5. One live attendance mark per student per session; older duplicates are voided, not deleted
        $this->report('ana_attendance_records duplicate marks voided (newest kept)', $db->exec(
            "UPDATE `ana_attendance_records` a
             JOIN `ana_attendance_records` newer
               ON newer.class_id = a.class_id AND newer.student_id = a.student_id AND newer.session_date = a.session_date
              AND newer.voided_at IS NULL AND newer.id > a.id
             SET a.voided_at = NOW(), a.void_reason = 'Duplicate mark for the same session (integrity migration)'
             WHERE a.voided_at IS NULL"
        ));
        if (!$this->columnExists('ana_attendance_records', 'live_mark')) {
            $db->exec("ALTER TABLE `ana_attendance_records`
                       ADD COLUMN `live_mark` TINYINT AS (IF(`voided_at` IS NULL, 1, NULL)) STORED");
        }
        if (!$this->indexExists('ana_attendance_records', 'uq_ana_att_live_mark')) {
            $db->exec("ALTER TABLE `ana_attendance_records`
                       ADD UNIQUE KEY `uq_ana_att_live_mark` (`class_id`, `student_id`, `session_date`, `live_mark`)");
        }

        // 6. Range rules enforced by the database itself
        foreach ($this->checks as $name => [$table, $rule]) {
            if (!$this->constraintExists($table, $name)) {
                $db->exec("ALTER TABLE `{$table}` ADD CONSTRAINT `{$name}` CHECK ({$rule})");
            }
        }
    }

    public function down(): void {
        $db = Database::pdo();

        foreach ($this->checks as $name => [$table]) {
            if ($this->constraintExists($table, $name)) {
                $db->exec("ALTER TABLE `{$table}` DROP CONSTRAINT `{$name}`");
            }
        }
        if ($this->indexExists('ana_attendance_records', 'uq_ana_att_live_mark')) {
            $db->exec("ALTER TABLE `ana_attendance_records` DROP INDEX `uq_ana_att_live_mark`");
        }
        if ($this->columnExists('ana_attendance_records', 'live_mark')) {
            $db->exec("ALTER TABLE `ana_attendance_records` DROP COLUMN `live_mark`");
        }
        foreach ($this->foreignKeys as $name => $unused) {
            if ($this->constraintExists('ana_classes', $name)) {
                $db->exec("ALTER TABLE `ana_classes` DROP FOREIGN KEY `{$name}`");
            }
            if ($this->indexExists('ana_classes', "idx_{$name}")) {
                $db->exec("ALTER TABLE `ana_classes` DROP INDEX `idx_{$name}`");
            }
        }
    }

    private function report(string $label, int|false $count): void {
        if ($count) {
            echo "  - {$label}: {$count}\n";
        }
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
