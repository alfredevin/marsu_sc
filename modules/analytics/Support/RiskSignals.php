<?php
namespace Modules\Analytics\Support;

use Core\Database;

/**
 * Academic risk tiers derived from recorded data only (posted grades and roll-call).
 *
 * High:     a posted FAILED grade, an overdue unresolved INC, or attendance below
 *           `attendance.critical_rate`.
 * Moderate: an unresolved INC, or attendance below `attendance.monitored_rate`.
 * Low:      has posted grades or attendance and none of the above.
 * Students with no recorded data are not classified. Unset thresholds are skipped.
 */
class RiskSignals
{
    public static function classify(?int $semesterId): array
    {
        $params = [];
        $termSql = '';
        if ($semesterId) {
            $termSql = ' AND c.semester_id = :sem';
            $params['sem'] = $semesterId;
        }
        $scope = AnalyticsAccess::classScopeSql('c');

        $students = [];
        $touch = function (array $r) use (&$students) {
            $sid = (int) $r['student_id'];
            $students[$sid] ??= ['program' => $r['program_code'] ?? 'N/A', 'failed' => 0, 'inc' => 0, 'inc_overdue' => 0, 'att' => null];
            return $sid;
        };

        foreach (Database::fetchAll(
            "SELECT g.student_id, p.code AS program_code,
                    SUM(g.remarks = 'FAILED') AS failed,
                    SUM(g.remarks = 'INC' AND g.inc_resolved_at IS NULL) AS inc,
                    SUM(g.remarks = 'INC' AND g.inc_resolved_at IS NULL AND g.inc_deadline IS NOT NULL AND g.inc_deadline < CURDATE()) AS inc_overdue
             FROM `ana_class_grades` g
             JOIN `ana_classes` c ON c.id = g.class_id AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
             JOIN `students` s ON s.id = g.student_id AND s.deleted_at IS NULL
             LEFT JOIN `programs` p ON p.id = s.program_id
             WHERE 1 = 1{$termSql}{$scope}
             GROUP BY g.student_id, p.code",
            $params
        ) as $r) {
            $sid = $touch($r);
            $students[$sid]['failed'] = (int) $r['failed'];
            $students[$sid]['inc'] = (int) $r['inc'];
            $students[$sid]['inc_overdue'] = (int) $r['inc_overdue'];
        }

        foreach (Database::fetchAll(
            "SELECT a.student_id, p.code AS program_code,
                    SUM(a.status = 'Present') AS present, SUM(a.status = 'Late') AS late,
                    SUM(a.status = 'Excused') AS excused, COUNT(*) AS total
             FROM `ana_attendance_records` a
             JOIN `ana_classes` c ON c.id = a.class_id AND c.deleted_at IS NULL
             JOIN `students` s ON s.id = a.student_id AND s.deleted_at IS NULL
             LEFT JOIN `programs` p ON p.id = s.program_id
             WHERE a.voided_at IS NULL{$termSql}{$scope}
             GROUP BY a.student_id, p.code",
            $params
        ) as $r) {
            $sid = $touch($r);
            $rate = GradeCalculator::attendanceRate($r);
            $students[$sid]['att'] = $rate === null ? null : $rate * 100;
        }

        $critical = AnalyticsSettings::get('attendance.critical_rate');
        $monitored = AnalyticsSettings::get('attendance.monitored_rate');

        $counts = ['High' => 0, 'Moderate' => 0, 'Low' => 0];
        $byProgram = [];
        foreach ($students as $sid => $s) {
            $att = $s['att'];
            if ($s['failed'] > 0 || $s['inc_overdue'] > 0 || ($critical !== null && $att !== null && $att < (float) $critical)) {
                $level = 'High';
            } elseif ($s['inc'] > 0 || ($monitored !== null && $att !== null && $att < (float) $monitored)) {
                $level = 'Moderate';
            } else {
                $level = 'Low';
            }
            $students[$sid]['level'] = $level;
            $counts[$level]++;
            $byProgram[$s['program']] ??= ['High' => 0, 'Moderate' => 0, 'Low' => 0];
            $byProgram[$s['program']][$level]++;
        }
        ksort($byProgram);

        return ['students' => $students, 'counts' => $counts, 'byProgram' => $byProgram];
    }

    /**
     * Year-over-year retention from official enrollment: share of students enrolled in an
     * academic year who are enrolled again in the following one. Only years with a
     * previous year of enrollment data are returned.
     */
    public static function retentionTrend(): array
    {
        // Program comes from the student record, the academic year from the enrollment's semester
        $scope = AnalyticsAccess::programScopeSql('(SELECT rs.program_id FROM `students` rs WHERE rs.id = e.student_id)');
        $years = Database::fetchAll(
            "SELECT DISTINCT ay.id, ay.label, ay.start_date
             FROM `ana_enrollments` e JOIN `semesters` sem ON sem.id = e.semester_id JOIN `academic_years` ay ON ay.id = sem.academic_year_id
             WHERE e.status = 'enrolled'{$scope}
             ORDER BY ay.start_date, ay.id"
        );
        $sets = [];
        foreach ($years as $y) {
            $sets[(int) $y['id']] = array_map('intval', array_column(Database::fetchAll(
                "SELECT DISTINCT e.student_id FROM `ana_enrollments` e JOIN `semesters` sem ON sem.id = e.semester_id
                 WHERE sem.academic_year_id = :ay AND e.status = 'enrolled'{$scope}",
                ['ay' => (int) $y['id']]
            ), 'student_id'));
        }

        $out = ['years' => [], 'retention' => [], 'attrition' => [], 'gwa' => []];
        $prev = null;
        foreach ($years as $y) {
            $id = (int) $y['id'];
            if ($prev !== null && count($sets[$prev]) > 0) {
                $kept = count(array_intersect($sets[$prev], $sets[$id]));
                $rate = round($kept / count($sets[$prev]) * 100, 1);
                $gwa = Database::fetchColumn(
                    "SELECT AVG(CAST(g.final_grade AS DECIMAL(5,2))) FROM `ana_class_grades` g
                     JOIN `ana_classes` c ON c.id = g.class_id AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
                     JOIN `semesters` sem ON sem.id = c.semester_id
                     WHERE sem.academic_year_id = :ay AND g.remarks IN ('PASSED', 'FAILED')" . AnalyticsAccess::classScopeSql('c'),
                    ['ay' => $id]
                );
                $out['years'][] = $y['label'];
                $out['retention'][] = $rate;
                $out['attrition'][] = round(100 - $rate, 1);
                $out['gwa'][] = $gwa !== null && $gwa !== false ? round((float) $gwa, 2) : null;
            }
            $prev = $id;
        }
        return $out;
    }
}
