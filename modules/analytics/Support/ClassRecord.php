<?php
namespace Modules\Analytics\Support;

use Core\Database;

/**
 * Loads a class record (roster, scores, attendance, posted grades) and computes
 * every student's grade through GradeCalculator. Read-only: never writes.
 */
class ClassRecord
{
    public static function details(int $classId): ?array
    {
        return Database::fetchOne(
            "SELECT c.*,
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.units, s.units) AS subject_units,
                    COALESCE(c.section_name, sec.name) AS section_name,
                    sec.year_level, sec.program_id AS section_program_id,
                    p.code AS program_code,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name,
                    ay.label AS academic_year_label,
                    sem.name AS semester_name
             FROM `ana_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `programs` p ON p.id = COALESCE(sec.program_id, s.program_id)
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
             LEFT JOIN `semesters` sem ON c.semester_id = sem.id
             WHERE c.id = :id AND c.deleted_at IS NULL
             LIMIT 1",
            ['id' => $classId]
        );
    }

    public static function scheme(array $class): array
    {
        $fallback = (float) ($class['passing_cutoff'] ?? AnalyticsSettings::get('grading.default_passing_cutoff') ?? 0);
        return GradeCalculator::normalizeScheme(json_decode((string) ($class['grading_scheme'] ?? ''), true), $fallback);
    }

    public static function roster(int $classId, bool $includeDropped = false): array
    {
        $statusSql = $includeDropped ? '' : " AND cs.status = 'enrolled'";
        return Database::fetchAll(
            "SELECT cs.student_id, cs.status AS roster_status, cs.grade_mark, cs.drop_reason,
                    st.student_number, st.first_name, st.middle_name, st.last_name, st.year_level, st.user_id,
                    p.code AS program_code, sec.name AS student_section
             FROM `ana_class_students` cs
             JOIN `students` st ON cs.student_id = st.id
             LEFT JOIN `programs` p ON st.program_id = p.id
             LEFT JOIN `sections` sec ON st.section_id = sec.id
             WHERE cs.class_id = :cid AND st.deleted_at IS NULL{$statusSql}
             ORDER BY st.last_name ASC, st.first_name ASC",
            ['cid' => $classId]
        );
    }

    /**
     * Attendance per student (voided rows excluded) plus the list of session dates.
     */
    public static function attendance(int $classId, ?int $studentId = null): array
    {
        $params = ['cid' => $classId];
        $extra = '';
        if ($studentId !== null) {
            $extra = ' AND student_id = :sid';
            $params['sid'] = $studentId;
        }
        $rows = Database::fetchAll(
            "SELECT student_id, session_date, status
             FROM `ana_attendance_records`
             WHERE class_id = :cid AND voided_at IS NULL AND student_id IS NOT NULL{$extra}
             ORDER BY session_date ASC",
            $params
        );
        $dates = [];
        $byStudent = [];
        foreach ($rows as $r) {
            $sid = (int) $r['student_id'];
            $dates[$r['session_date']] = true;
            $byStudent[$sid] ??= ['present' => 0, 'late' => 0, 'excused' => 0, 'absent' => 0, 'total' => 0, 'dates' => []];
            $byStudent[$sid]['dates'][$r['session_date']] = $r['status'];
            $byStudent[$sid]['total']++;
            $key = strtolower($r['status']);
            if (isset($byStudent[$sid][$key])) {
                $byStudent[$sid][$key]++;
            }
        }
        $dates = array_keys($dates);
        sort($dates);
        return ['dates' => $dates, 'students' => $byStudent];
    }

    public static function emptyAttendance(): array
    {
        return ['present' => 0, 'late' => 0, 'excused' => 0, 'absent' => 0, 'total' => 0, 'dates' => []];
    }

    /**
     * Full class record: roster, scores, statuses, attendance, computed and posted grades.
     */
    public static function load(array $class, ?int $onlyStudentId = null): array
    {
        $classId = (int) $class['id'];
        $scheme = self::scheme($class);
        $roster = self::roster($classId);
        if ($onlyStudentId !== null) {
            $roster = array_values(array_filter($roster, fn($r) => (int) $r['student_id'] === $onlyStudentId));
        }

        $scores = [];
        $statuses = [];
        $params = ['cid' => $classId];
        $extra = '';
        if ($onlyStudentId !== null) {
            $extra = ' AND student_id = :sid';
            $params['sid'] = $onlyStudentId;
        }
        foreach (Database::fetchAll("SELECT student_id, item_code, score, submission_status FROM `ana_class_scores` WHERE class_id = :cid{$extra}", $params) as $r) {
            $sid = (int) $r['student_id'];
            if ($r['score'] !== null) {
                $scores[$sid][$r['item_code']] = (float) $r['score'];
            }
            $statuses[$sid][$r['item_code']] = $r['submission_status'];
        }

        $att = self::attendance($classId, $onlyStudentId);

        $posted = [];
        foreach (Database::fetchAll("SELECT * FROM `ana_class_grades` WHERE class_id = :cid{$extra}", $params) as $g) {
            $posted[(int) $g['student_id']] = $g;
        }

        $computed = [];
        foreach ($roster as $r) {
            $sid = (int) $r['student_id'];
            $result = GradeCalculator::computeStudent($scheme, $scores[$sid] ?? [], $statuses[$sid] ?? [], $att['students'][$sid] ?? self::emptyAttendance());
            $computed[$sid] = GradeCalculator::applyMark($result, $r['grade_mark']);
        }

        return [
            'scheme'     => $scheme,
            'roster'     => $roster,
            'scores'     => $scores,
            'statuses'   => $statuses,
            'attendance' => $att['students'],
            'dates'      => $att['dates'],
            'computed'   => $computed,
            'posted'     => $posted,
        ];
    }

    public static function isPublished(array $class): bool
    {
        return in_array($class['grade_status'] ?? '', ['posted', 'locked'], true);
    }
}
