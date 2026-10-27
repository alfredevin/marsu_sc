<?php
namespace Modules\Retention\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;
use Modules\Retention\Support\RetentionAccess;

/**
 * Controller for Student Self-Service Academic Portal
 * Strictly restricted to authenticated students viewing their own records,
 * or module administrators in diagnostic preview mode.
 */
class StudentPortalController
{
    /**
     * Helper to resolve the authenticated student with program and section master details
     */
    private function getStudentContext(): ?array
    {
        $baseStudent = RetentionAccess::currentStudent();
        if (!$baseStudent) {
            return null;
        }

        try {
            return Database::fetchOne("
                SELECT s.*, 
                       p.name AS program_name, 
                       p.code AS program_code, 
                       p.years AS program_years,
                       sec.name AS section_name
                FROM `students` s
                LEFT JOIN `programs` p ON s.program_id = p.id
                LEFT JOIN `sections` sec ON s.section_id = sec.id
                WHERE s.id = :id AND s.deleted_at IS NULL LIMIT 1
            ", ['id' => (int) $baseStudent['id']]);
        } catch (\Throwable $e) {
            return $baseStudent;
        }
    }

    /**
     * 1. Student Academic Snapshot / Dashboard (Part F6)
     */
    public function dashboard(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/dashboard', [
                'student' => null,
                'title'   => 'My Academic Snapshot - MarSU Retention Portal',
                'crumbs'  => ['My Academic Record' => url('retention/my'), 'Snapshot' => ''],
            ]);
            return;
        }

        $sid = (int) $student['id'];
        $snum = (string) $student['student_number'];

        // Enrolled classes in active/current offerings
        $classes = Database::fetchAll("
            SELECT c.*, cs.status AS enrollment_status,
                   g.final_grade, g.computed_grade, g.remarks, g.inc_deadline, g.inc_resolved_at, g.posted_at,
                   CONCAT(u.first_name, ' ', u.last_name) AS instructor_name, u.email AS instructor_email,
                   sem.name AS semester_name, ay.label AS academic_year_label
            FROM `ret_class_students` cs
            JOIN `ret_classes` c ON cs.class_id = c.id
            LEFT JOIN `ret_class_grades` g ON (g.class_id = c.id AND g.student_id = cs.student_id)
            LEFT JOIN `users` u ON c.faculty_user_id = u.id
            LEFT JOIN `semesters` sem ON c.semester_id = sem.id
            LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
            WHERE cs.student_id = :sid AND cs.status = 'enrolled' AND c.deleted_at IS NULL
            ORDER BY (c.grade_status = 'posted' OR c.grade_status = 'locked') DESC, c.subject_code ASC
        ", ['sid' => $sid]);

        // Real Academic Metrics
        $enrolledCount = count($classes);
        $passedUnits = 0.0;
        $totalGradedUnits = 0.0;
        $weightedGradeSum = 0.0;
        $hasInc = false;
        $hasFailed = false;

        foreach ($classes as $cl) {
            $isPosted = in_array($cl['grade_status'], ['posted', 'locked'], true);
            $rem = strtoupper($cl['remarks'] ?? '');

            if ($isPosted && $rem === 'INC') {
                $hasInc = true;
            }
            if ($isPosted && $rem === 'FAILED') {
                $hasFailed = true;
            }

            if ($isPosted && $rem === 'PASSED') {
                $passedUnits += (float) ($cl['units'] ?? 3.0);
            }

            if ($isPosted && !empty($cl['computed_grade'])) {
                $u = (float) ($cl['units'] ?? 3.0);
                $totalGradedUnits += $u;
                $weightedGradeSum += ((float) $cl['computed_grade'] * $u);
            } elseif ($isPosted && is_numeric($cl['final_grade'])) {
                $u = (float) ($cl['units'] ?? 3.0);
                $totalGradedUnits += $u;
                $weightedGradeSum += ((float) $cl['final_grade'] * $u);
            }
        }

        $termGpa = ($totalGradedUnits > 0) ? round($weightedGradeSum / $totalGradedUnits, 2) : null;

        // Real Attendance Telemetry Summary
        $attSummary = Database::fetchOne("
            SELECT COUNT(*) AS total_sessions,
                   SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_count,
                   SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) AS absent_count,
                   SUM(CASE WHEN status = 'Excused' THEN 1 ELSE 0 END) AS excused_count,
                   SUM(CASE WHEN status = 'Late' THEN 1 ELSE 0 END) AS late_count
            FROM `ret_attendance_records`
            WHERE student_id = :snum AND deleted_at IS NULL
        ", ['snum' => $snum]) ?: [
            'total_sessions' => 0, 'present_count' => 0, 'absent_count' => 0, 'excused_count' => 0, 'late_count' => 0
        ];

        View::render('retention/Views/student/dashboard', [
            'student'           => $student,
            'classes'           => $classes,
            'enrolledCount'     => $enrolledCount,
            'passedUnits'       => $passedUnits,
            'termGpa'           => $termGpa,
            'hasInc'            => $hasInc,
            'hasFailed'         => $hasFailed,
            'attSummary'        => $attSummary,
            'title'             => 'My Academic Snapshot - MarSU Retention Portal',
            'crumbs'            => ['My Academic Record' => url('retention/my'), 'Snapshot' => ''],
        ]);
    }

    /**
     * 2. Student Master Record & Demographic Profile (Part F6)
     */
    public function profile(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/profile', [
                'student' => null,
                'profile' => null,
                'title'   => 'My Profile - MarSU Retention Portal',
                'crumbs'  => ['My Academic Record' => url('retention/my'), 'Profile' => ''],
            ]);
            return;
        }

        $sid = (int) $student['id'];
        $suppProfile = Database::fetchOne("SELECT * FROM `ret_student_profiles` WHERE student_id = :sid LIMIT 1", ['sid' => $sid]);

        View::render('retention/Views/student/profile', [
            'student' => $student,
            'profile' => $suppProfile,
            'title'   => 'My Profile - MarSU Retention Portal',
            'crumbs'  => ['My Academic Record' => url('retention/my'), 'Profile' => ''],
        ]);
    }

    /**
     * 3. Student Grades & Official Mark Sheets (Part F6)
     */
    public function grades(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/grades', [
                'student' => null,
                'classes' => [],
                'title'   => 'My Grades - MarSU Retention Portal',
                'crumbs'  => ['My Academic Record' => url('retention/my'), 'Grades' => ''],
            ]);
            return;
        }

        $sid = (int) $student['id'];

        // Fetch enrolled classes with grades
        $classes = Database::fetchAll("
            SELECT c.*, cs.status AS enrollment_status,
                   g.final_grade, g.computed_grade, g.remarks, g.inc_deadline, g.inc_resolved_at, g.posted_at,
                   CONCAT(u.first_name, ' ', u.last_name) AS instructor_name,
                   sem.name AS semester_name, ay.label AS academic_year_label
            FROM `ret_class_students` cs
            JOIN `ret_classes` c ON cs.class_id = c.id
            LEFT JOIN `ret_class_grades` g ON (g.class_id = c.id AND g.student_id = cs.student_id)
            LEFT JOIN `users` u ON c.faculty_user_id = u.id
            LEFT JOIN `semesters` sem ON c.semester_id = sem.id
            LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
            WHERE cs.student_id = :sid AND c.deleted_at IS NULL
            ORDER BY c.academic_year_id DESC, c.semester_id DESC, c.subject_code ASC
        ", ['sid' => $sid]);

        // Calculate summary
        $totalEnrolledUnits = 0.0;
        $totalPassedUnits = 0.0;
        $gradedUnits = 0.0;
        $weightedPoints = 0.0;

        foreach ($classes as $cl) {
            $u = (float) ($cl['units'] ?? 3.0);
            $totalEnrolledUnits += $u;

            $isPosted = in_array($cl['grade_status'], ['posted', 'locked'], true);
            if ($isPosted && ($cl['remarks'] ?? '') === 'PASSED') {
                $totalPassedUnits += $u;
            }

            if ($isPosted && !empty($cl['computed_grade'])) {
                $gradedUnits += $u;
                $weightedPoints += ((float) $cl['computed_grade'] * $u);
            } elseif ($isPosted && is_numeric($cl['final_grade'])) {
                $gradedUnits += $u;
                $weightedPoints += ((float) $cl['final_grade'] * $u);
            }
        }

        $cumGpa = ($gradedUnits > 0) ? round($weightedPoints / $gradedUnits, 2) : null;

        View::render('retention/Views/student/grades', [
            'student'            => $student,
            'classes'            => $classes,
            'totalEnrolledUnits' => $totalEnrolledUnits,
            'totalPassedUnits'   => $totalPassedUnits,
            'cumGpa'             => $cumGpa,
            'title'              => 'My Grades & Academic Evaluation - MarSU Retention Portal',
            'crumbs'             => ['My Academic Record' => url('retention/my'), 'Grades' => ''],
        ]);
    }

    /**
     * 4. Student Attendance Telemetry & Cut Allowance (Part F6)
     */
    public function attendance(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/attendance', [
                'student'     => null,
                'sessions'    => [],
                'courseStats' => [],
                'title'       => 'My Attendance Record - MarSU Retention Portal',
                'crumbs'      => ['My Academic Record' => url('retention/my'), 'Attendance' => ''],
            ]);
            return;
        }

        $snum = (string) $student['student_number'];

        // Raw session records
        $sessions = Database::fetchAll("
            SELECT att.*, 
                   COALESCE(c.subject_code, att.subject_code) AS display_subject_code,
                   COALESCE(c.subject_title, 'Course Session') AS display_subject_title,
                   COALESCE(c.section_name, '-') AS section_name
            FROM `ret_attendance_records` att
            LEFT JOIN `ret_classes` c ON att.class_id = c.id
            WHERE att.student_id = :snum AND att.deleted_at IS NULL
            ORDER BY att.session_date DESC, att.id DESC
        ", ['snum' => $snum]);

        // Aggregate per-course stats
        $courseStats = [];
        foreach ($sessions as $s) {
            $code = $s['display_subject_code'];
            if (!isset($courseStats[$code])) {
                $courseStats[$code] = [
                    'code'     => $code,
                    'title'    => $s['display_subject_title'],
                    'section'  => $s['section_name'],
                    'total'    => 0,
                    'present'  => 0,
                    'absent'   => 0,
                    'excused'  => 0,
                    'late'     => 0,
                ];
            }
            $courseStats[$code]['total']++;
            $st = $s['status'];
            if ($st === 'Present') $courseStats[$code]['present']++;
            elseif ($st === 'Absent') $courseStats[$code]['absent']++;
            elseif ($st === 'Excused') $courseStats[$code]['excused']++;
            elseif ($st === 'Late') $courseStats[$code]['late']++;
        }

        foreach ($courseStats as &$cs) {
            $effectiveAttended = $cs['present'] + $cs['excused'] + ($cs['late'] * 0.5);
            $cs['rate'] = ($cs['total'] > 0) ? round(($effectiveAttended / $cs['total']) * 100, 1) : 100.0;
        }
        unset($cs);

        View::render('retention/Views/student/attendance', [
            'student'     => $student,
            'sessions'    => $sessions,
            'courseStats' => $courseStats,
            'title'       => 'My Attendance & Roll-Call Ledger - MarSU Retention Portal',
            'crumbs'      => ['My Academic Record' => url('retention/my'), 'Attendance' => ''],
        ]);
    }

    /**
     * 5. Incomplete (INC) & Academic Deficiencies (Part F6)
     */
    public function deficiencies(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/deficiencies', [
                'student'      => null,
                'deficiencies' => [],
                'title'        => 'Academic Deficiencies & INCs - MarSU Retention Portal',
                'crumbs'       => ['My Academic Record' => url('retention/my'), 'Deficiencies' => ''],
            ]);
            return;
        }

        $sid = (int) $student['id'];

        // Only query real posted grades with INC, FAILED, or DRP remarks
        $deficiencies = Database::fetchAll("
            SELECT g.*, c.subject_code, c.subject_title, c.units, c.section_name,
                   CONCAT(u.first_name, ' ', u.last_name) AS instructor_name, u.email AS instructor_email,
                   sem.name AS semester_name, ay.label AS academic_year_label
            FROM `ret_class_grades` g
            JOIN `ret_classes` c ON g.class_id = c.id
            LEFT JOIN `users` u ON c.faculty_user_id = u.id
            LEFT JOIN `semesters` sem ON c.semester_id = sem.id
            LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
            WHERE g.student_id = :sid AND g.remarks IN ('INC', 'FAILED', 'DRP')
              AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
            ORDER BY g.id DESC
        ", ['sid' => $sid]);

        View::render('retention/Views/student/deficiencies', [
            'student'      => $student,
            'deficiencies' => $deficiencies,
            'title'        => 'My Academic Deficiencies & Incomplete Requirements - MarSU Retention Portal',
            'crumbs'       => ['My Academic Record' => url('retention/my'), 'Deficiencies' => ''],
        ]);
    }

    /**
     * 6. Student Curriculum Progress (Earned Units Only - Part B7)
     */
    public function progress(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/progress', [
                'student'       => null,
                'passedCourses' => [],
                'totalUnits'    => 0,
                'title'         => 'Curriculum Progress - MarSU Retention Portal',
                'crumbs'        => ['My Academic Record' => url('retention/my'), 'Progress' => ''],
            ]);
            return;
        }

        $sid = (int) $student['id'];

        // Passed courses from posted class records
        $passedCourses = Database::fetchAll("
            SELECT g.*, c.subject_code, c.subject_title, c.units,
                   sem.name AS semester_name, ay.label AS academic_year_label
            FROM `ret_class_grades` g
            JOIN `ret_classes` c ON g.class_id = c.id
            LEFT JOIN `semesters` sem ON c.semester_id = sem.id
            LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
            WHERE g.student_id = :sid AND g.remarks = 'PASSED'
              AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
            ORDER BY c.academic_year_id ASC, c.semester_id ASC, c.subject_code ASC
        ", ['sid' => $sid]);

        $totalUnits = 0.0;
        foreach ($passedCourses as $pc) {
            $totalUnits += (float) ($pc['units'] ?? 3.0);
        }

        View::render('retention/Views/student/progress', [
            'student'       => $student,
            'passedCourses' => $passedCourses,
            'totalUnits'    => $totalUnits,
            'title'         => 'Completed Academic Credits & Progress - MarSU Retention Portal',
            'crumbs'        => ['My Academic Record' => url('retention/my'), 'Progress' => ''],
        ]);
    }

    /**
     * 7. Student Conduct & Disciplinary Notices (Part F6 / Part H Q6: date, type, severity, status only)
     */
    public function conduct(): void
    {
        $student = $this->getStudentContext();
        if (!$student) {
            View::render('retention/Views/student/conduct', [
                'student'  => null,
                'notices'  => [],
                'title'    => 'My Conduct Notices - MarSU Retention Portal',
                'crumbs'   => ['My Academic Record' => url('retention/my'), 'Conduct' => ''],
            ]);
            return;
        }

        $snum = (string) $student['student_number'];

        // Confidential internal faculty/admin narratives are deliberately omitted per Rule F6 / Part H Q6
        $notices = Database::fetchAll("
            SELECT id, incident_date, incident_type, severity, status
            FROM `ret_behavior_records`
            WHERE student_id = :snum AND deleted_at IS NULL
            ORDER BY incident_date DESC, id DESC
        ", ['snum' => $snum]);

        View::render('retention/Views/student/conduct', [
            'student' => $student,
            'notices' => $notices,
            'title'   => 'My Conduct & Disciplinary Record Notices - MarSU Retention Portal',
            'crumbs'  => ['My Academic Record' => url('retention/my'), 'Conduct' => ''],
        ]);
    }
}
