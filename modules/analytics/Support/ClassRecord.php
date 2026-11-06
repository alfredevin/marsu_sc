<?php
namespace Modules\Analytics\Support;

use Core\Database;

/**
 * Loads a class record (roster, scores, attendance, posted grades) and computes
 * every student's grade through GradeCalculator. Read-only: never writes.
 */
class ClassRecord
{
    /**
     * `ana_classes` keeps only ids for subject, section, term and room; their names come
     * live from the core tables. Use as "SELECT " . CLASS_COLUMNS . " FROM `ana_classes` c" . CLASS_JOINS
     * (aliases sub, sec, sem and rm are taken by these joins).
     */
    public const CLASS_COLUMNS = "c.*, sub.code AS subject_code, sub.title AS subject_title, sub.units AS units,
        sec.name AS section_name, sem.academic_year_id, rm.room_number AS room, rm.name AS room_name";
    public const CLASS_JOINS = " LEFT JOIN `subjects` sub ON sub.id = c.subject_id
        LEFT JOIN `sections` sec ON sec.id = c.section_id
        LEFT JOIN `semesters` sem ON sem.id = c.semester_id
        LEFT JOIN `rooms` rm ON rm.id = c.room_id";

    public static function details(int $classId): ?array
    {
        return Database::fetchOne(
            "SELECT " . self::CLASS_COLUMNS . ",
                    sub.units AS subject_units, sub.units AS units,
                    sec.year_level, sec.program_id AS section_program_id,
                    p.code AS program_code,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name,
                    ay.label AS academic_year_label,
                    sem.name AS semester_name
             FROM `ana_classes` c" . self::CLASS_JOINS . "
             LEFT JOIN `programs` p ON p.id = COALESCE(sec.program_id, sub.program_id)
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             LEFT JOIN `academic_years` ay ON sem.academic_year_id = ay.id
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

    /**
     * Data for the Grades Tracking matrix (students keyed by student number, as the page expects).
     * `can_edit` is true only for the owning faculty while the record is in draft.
     */
    public static function matrixPayload(array $class): array
    {
        $rec = self::load($class);
        $published = self::isPublished($class);
        $dateMap = [];
        foreach ($rec['dates'] as $d) {
            $dateMap[self::dateLabel($d)] = $d;
        }
        $scheme = $rec['scheme'];
        $used = self::usedItemCodes((int) $class['id'], $scheme);
        foreach ($scheme['groups'] as &$g) {
            $g['attendanceDates'] = $g['hasAttendance'] ? array_keys($dateMap) : [];
            $g['nextCode'] = $g['isExam'] ? null : self::nextItemCode($g, $used);
        }
        unset($g);

        $students = [];
        $scores = [];
        foreach ($rec['roster'] as $r) {
            $sid = (int) $r['student_id'];
            $num = $r['student_number'];
            $students[] = [
                'student_id' => $num,
                'pk' => $sid,
                'full_name' => trim($r['last_name'] . ', ' . $r['first_name'] . (!empty($r['middle_name']) ? ' ' . mb_substr($r['middle_name'], 0, 1) . '.' : '')),
                'department' => $r['program_code'] ?? '',
            ];
            $att = [];
            foreach (($rec['attendance'][$sid]['dates'] ?? []) as $d => $status) {
                $att[self::dateLabel($d)] = ['Absent' => 'A', 'Excused' => 'E', 'Late' => 'L'][$status] ?? 'P';
            }
            $posted = $published ? ($rec['posted'][$sid] ?? null) : null;
            $scores[$num] = [
                'rawScores' => $rec['scores'][$sid] ?? (object) [],
                'attendance' => $att ?: (object) [],
                'posted' => $posted ? ['final_grade' => $posted['final_grade'], 'remarks' => $posted['remarks']] : null,
            ];
        }

        return [
            'id' => (string) $class['id'],
            'course_code' => $class['subject_code'],
            'course_title' => $class['subject_title'],
            'section' => $class['section_name'],
            'school_year' => $class['academic_year_label'] ?? '',
            'semester' => $class['semester_name'] ?? '',
            'faculty_name' => $class['faculty_name'] ?? '',
            'grade_status' => $class['grade_status'],
            'can_edit' => $class['grade_status'] === 'draft' && AnalyticsAccess::ownsClass((int) $class['id']),
            'is_owner' => AnalyticsAccess::ownsClass((int) $class['id']),
            'student_count' => count($students),
            'late_weight' => GradeCalculator::lateWeight(),
            'passing_cutoff' => $scheme['passingCutoff'],
            'scheme_name' => $scheme['name'],
            'scheme' => $scheme,
            'date_map' => $dateMap ?: (object) [],
            'students' => $students,
            'scores' => $scores ?: (object) [],
        ];
    }

    public static function isPublished(array $class): bool
    {
        return in_array($class['grade_status'] ?? '', ['posted', 'locked'], true);
    }

    /** Column label of an attendance session, e.g. 2026-09-09 -> 9-Sep. */
    public static function dateLabel(string $date): string
    {
        return date('j-M', strtotime($date));
    }

    /**
     * Upper-cased item codes in the scheme plus codes that still have stored scores,
     * so a new column never picks up scores of a column that was removed earlier.
     */
    public static function usedItemCodes(int $classId, array $scheme): array
    {
        $used = array_map('strtoupper', array_keys(GradeCalculator::items($scheme)));
        foreach (Database::fetchAll("SELECT DISTINCT item_code FROM `ana_class_scores` WHERE class_id = :cid", ['cid' => $classId]) as $r) {
            $used[] = strtoupper($r['item_code']);
        }
        return array_values(array_unique($used));
    }

    /** Next column code of a group: Q2 -> Q3, ACT6 -> ACT7, P -> P2, empty group -> first letter of its title + 1. */
    public static function nextItemCode(array $group, array $usedUpper): string
    {
        $last = $group['items'] ? (string) end($group['items'])['code'] : '';
        if (preg_match('/^(.*?)(\d+)$/', $last, $m)) {
            [$prefix, $n] = [$m[1], (int) $m[2] + 1];
        } elseif ($last !== '') {
            [$prefix, $n] = [$last, 2];
        } else {
            [$prefix, $n] = [strtoupper(substr((string) preg_replace('/[^A-Za-z]/', '', $group['title']), 0, 1)) ?: 'T', 1];
        }
        while (in_array(strtoupper($prefix . $n), $usedUpper, true)) {
            $n++;
        }
        return $prefix . $n;
    }
}
