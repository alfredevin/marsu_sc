<?php
namespace Modules\Analytics\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\AnalyticsSettings;
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Classroom;
use Modules\Analytics\Support\Notifier;

/**
 * Controller for Faculty Academic Workspace
 * Faculty own academic data encoding for their own assigned classes only.
 */
class FacultyController
{
    /**
     * Faculty Workspace Dashboard
     */
    public function dashboard(): void
    {
        $facultyId = AnalyticsAccess::facultyUserId();
        if (!$facultyId) {
            Session::flash('error', 'Faculty credentials required to access this workspace.');
            redirect(url('analytics'));
            return;
        }

        // Summary counts
        $totalClasses = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_classes` WHERE `faculty_user_id` = :fid AND `deleted_at` IS NULL",
            ['fid' => $facultyId]
        );

        $enrolledStudentsCount = (int) Database::fetchColumn(
            "SELECT COUNT(DISTINCT cs.student_id) 
             FROM `ana_class_students` cs 
             JOIN `ana_classes` c ON cs.class_id = c.id 
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND cs.status = 'enrolled'",
            ['fid' => $facultyId]
        );

        $pendingClasses = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_classes` WHERE `faculty_user_id` = :fid AND `grade_status` = 'draft' AND `deleted_at` IS NULL",
            ['fid' => $facultyId]
        );

        $postedClasses = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_classes` WHERE `faculty_user_id` = :fid AND `grade_status` IN ('posted', 'locked') AND `deleted_at` IS NULL",
            ['fid' => $facultyId]
        );

        $pendingIncCount = (int) Database::fetchColumn(
            "SELECT COUNT(*) 
             FROM `ana_class_grades` g 
             JOIN `ana_classes` c ON g.class_id = c.id 
             WHERE c.faculty_user_id = :fid 
               AND (g.final_grade = 'INC' OR g.remarks = 'INC') 
               AND g.inc_resolved_at IS NULL 
               AND c.deleted_at IS NULL",
            ['fid' => $facultyId]
        );

        $pendingCorrectionRequests = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_grade_change_requests` WHERE `requested_by` = :fid AND `status` = 'pending'",
            ['fid' => $facultyId]
        );

        // Recent teaching classes
        $recentClasses = Database::fetchAll(
            "SELECT c.*, 
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.units, s.units) AS subject_units,
                    COALESCE(c.section_name, sec.name) AS section_name,
                    sec.year_level,
                    ay.label AS academic_year_label,
                    sem.name AS semester_name,
                    (SELECT COUNT(*) FROM `ana_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS student_count
             FROM `ana_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
             LEFT JOIN `semesters` sem ON c.semester_id = sem.id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY c.id DESC
             LIMIT 6",
            ['fid' => $facultyId]
        );

        // Recent attendance entries logged by this faculty member
        $recentAttendance = Database::fetchAll(
            "SELECT a.session_date, a.status, a.student_id, a.subject_code,
                    COALESCE(c.section_name, sec.name) AS section_name,
                    st.first_name, st.last_name
             FROM `ana_attendance_records` a
             JOIN `ana_classes` c ON a.class_id = c.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `students` st ON a.student_id = st.id
             WHERE (a.recorded_by = :fid1 OR c.faculty_user_id = :fid2) AND a.voided_at IS NULL
             ORDER BY a.session_date DESC, a.id DESC
             LIMIT 5",
            ['fid1' => $facultyId, 'fid2' => $facultyId]
        );

        // Pending INC records for quick resolution
        $pendingIncs = Database::fetchAll(
            "SELECT g.*, st.student_number, st.first_name, st.last_name,
                    c.subject_code, c.section_name
             FROM `ana_class_grades` g
             JOIN `ana_classes` c ON g.class_id = c.id
             JOIN `students` st ON g.student_id = st.id
             WHERE c.faculty_user_id = :fid 
               AND (g.final_grade = 'INC' OR g.remarks = 'INC')
               AND g.inc_resolved_at IS NULL
               AND c.deleted_at IS NULL
             ORDER BY g.inc_deadline ASC, g.id ASC
             LIMIT 5",
            ['fid' => $facultyId]
        );

        View::render('analytics/Views/faculty/dashboard', [
            'facultyId'                 => $facultyId,
            'totalClasses'              => $totalClasses,
            'enrolledStudentsCount'     => $enrolledStudentsCount,
            'pendingClasses'            => $pendingClasses,
            'postedClasses'             => $postedClasses,
            'pendingIncCount'           => $pendingIncCount,
            'pendingCorrectionRequests' => $pendingCorrectionRequests,
            'recentClasses'             => $recentClasses,
            'recentAttendance'          => $recentAttendance,
            'pendingIncs'               => $pendingIncs,
            'title'                     => 'Faculty Academic Workspace - MarSU ERP',
            'crumbs'                    => ['Faculty Workspace' => url('analytics/faculty'), 'Dashboard' => ''],
        ]);
    }

    /**
     * List all classes assigned to this faculty member
     */
    public function classes(): void
    {
        $facultyId = AnalyticsAccess::facultyUserId();
        $classes = [];
        if ($facultyId) {
            $classes = Database::fetchAll(
                "SELECT c.*, 
                        COALESCE(c.subject_code, s.code) AS subject_code,
                        COALESCE(c.subject_title, s.title) AS subject_title,
                        COALESCE(c.units, s.units) AS subject_units,
                        COALESCE(c.section_name, sec.name) AS section_name,
                        sec.year_level,
                        ay.label AS academic_year_label,
                        sem.name AS semester_name,
                        (SELECT COUNT(*) FROM `ana_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS student_count
                 FROM `ana_classes` c
                 LEFT JOIN `subjects` s ON c.subject_id = s.id
                 LEFT JOIN `sections` sec ON c.section_id = sec.id
                 LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
                 LEFT JOIN `semesters` sem ON c.semester_id = sem.id
                 WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
                 ORDER BY c.id DESC",
                ['fid' => $facultyId]
            );
        }

        View::render('analytics/Views/faculty/classes', [
            'classes' => $classes,
            'title'   => 'My Teaching Classes & Subject Sections - MarSU ERP',
            'crumbs'  => ['Faculty Workspace' => url('analytics/faculty'), 'My Classes' => ''],
        ]);
    }

    /**
     * Class Record Matrix (Interactive Matrix, Roster, Score Persistence, Grade Posting)
     */
    public function classRecord(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        // Fetch detailed offering information
        $classDetails = Database::fetchOne(
            "SELECT c.*, 
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.units, s.units) AS subject_units,
                    COALESCE(c.section_name, sec.name) AS section_name,
                    sec.year_level, sec.id AS sec_id,
                    ay.label AS academic_year_label,
                    sem.name AS semester_name
             FROM `ana_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
             LEFT JOIN `semesters` sem ON c.semester_id = sem.id
             WHERE c.id = :id AND c.deleted_at IS NULL LIMIT 1",
            ['id' => $classId]
        );

        if (!$classDetails) {
            Session::flash('error', 'Class offering could not be loaded.');
            redirect(url('analytics/faculty/classes'));
            return;
        }

        // Parse grading scheme JSON
        $scheme = ClassRecord::scheme($classDetails);
        if (empty($scheme['groups'])) {
            $scheme = [
                'name' => 'Default Grading System (30-30-40)',
                'passingCutoff' => (float) ($classDetails['passing_cutoff'] ?? 3.04),
                'groups' => [
                    [
                        'id' => 'grp_att_quiz',
                        'title' => 'ATTENDANCE AND QUIZZES',
                        'weight' => 30,
                        'hasAttendance' => true,
                        'attendanceDates' => [],
                        'items' => [
                            ['code' => 'Q1', 'title' => 'Quiz 1', 'type' => 'Quiz (Raw)', 'maxScore' => 20],
                            ['code' => 'Q2', 'title' => 'Quiz 2', 'type' => 'Quiz (Raw)', 'maxScore' => 20]
                        ]
                    ],
                    [
                        'id' => 'grp_act_perf',
                        'title' => 'ACTIVITIES AND EXERCISES',
                        'weight' => 30,
                        'hasAttendance' => false,
                        'attendanceDates' => [],
                        'items' => [
                            ['code' => 'A1', 'title' => 'Activity 1', 'type' => 'Activity', 'maxScore' => 100],
                            ['code' => 'G1', 'title' => 'Group 1', 'type' => 'Group', 'maxScore' => 100]
                        ]
                    ],
                    [
                        'id' => 'grp_exams',
                        'title' => 'MAJOR EXAMS',
                        'weight' => 40,
                        'hasAttendance' => false,
                        'attendanceDates' => [],
                        'items' => [
                            ['code' => 'Midterm', 'title' => 'Midterm Exam', 'type' => 'Exam', 'maxScore' => 100],
                            ['code' => 'Finals', 'title' => 'Final Exam', 'type' => 'Exam', 'maxScore' => 100]
                        ]
                    ]
                ]
            ];
        }

        // Fetch enrolled roster
        $students = Database::fetchAll(
            "SELECT cs.id AS enrollment_id, cs.student_id, cs.status AS enrollment_status,
                    st.student_number, st.first_name, st.middle_name, st.last_name, st.year_level,
                    p.code AS program_code, p.name AS program_name
             FROM `ana_class_students` cs
             JOIN `students` st ON cs.student_id = st.id
             LEFT JOIN `programs` p ON st.program_id = p.id
             WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND st.deleted_at IS NULL
             ORDER BY st.last_name ASC, st.first_name ASC",
            ['cid' => $classId]
        );

        // Fetch recorded scores
        $rawScores = Database::fetchAll(
            "SELECT student_id, item_code, score, submission_status 
             FROM `ana_class_scores` 
             WHERE class_id = :cid",
            ['cid' => $classId]
        );

        $scoresMap = [];
        foreach ($rawScores as $rs) {
            $scoresMap[(int) $rs['student_id']][$rs['item_code']] = [
                'score'             => (float) $rs['score'],
                'submission_status' => $rs['submission_status'],
            ];
        }

        // Fetch roll-call attendance summary for this class
        $attendanceRows = Database::fetchAll(
            "SELECT student_id, session_date, status 
             FROM `ana_attendance_records` 
             WHERE class_id = :cid AND voided_at IS NULL AND student_id IS NOT NULL
             ORDER BY session_date ASC",
            ['cid' => $classId]
        );

        $attendanceByStudentNum = [];
        $recordedDates = [];
        foreach ($attendanceRows as $ar) {
            $sNum = $ar['student_id'];
            $d = $ar['session_date'];
            if (!in_array($d, $recordedDates, true)) {
                $recordedDates[] = $d;
            }
            if (!isset($attendanceByStudentNum[$sNum])) {
                $attendanceByStudentNum[$sNum] = [
                    'present' => 0,
                    'late'    => 0,
                    'excused' => 0,
                    'absent'  => 0,
                    'total'   => 0,
                    'dates'   => [],
                ];
            }
            $st = $ar['status'];
            $attendanceByStudentNum[$sNum]['dates'][$d] = $st;
            $attendanceByStudentNum[$sNum]['total']++;
            if ($st === 'Present') {
                $attendanceByStudentNum[$sNum]['present']++;
            } elseif ($st === 'Late') {
                $attendanceByStudentNum[$sNum]['late']++;
            } elseif ($st === 'Excused') {
                $attendanceByStudentNum[$sNum]['excused']++;
            } else {
                $attendanceByStudentNum[$sNum]['absent']++;
            }
        }

        // Map attendance to student ID
        $attendanceMap = [];
        foreach ($students as $std) {
            $sid = (int) $std['student_id'];
            $snum = $std['student_number'];
            $attendanceMap[$sid] = $attendanceByStudentNum[$sid] ?? [
                'present' => 0,
                'late'    => 0,
                'excused' => 0,
                'absent'  => 0,
                'total'   => 0,
                'dates'   => [],
            ];
        }

        // Fetch posted grades if posted/locked
        $postedGrades = Database::fetchAll(
            "SELECT * FROM `ana_class_grades` WHERE class_id = :cid",
            ['cid' => $classId]
        );
        $postedGradesMap = [];
        foreach ($postedGrades as $pg) {
            $postedGradesMap[(int) $pg['student_id']] = $pg;
        }

        // Fetch pending correction request if any
        $pendingCorrection = Database::fetchOne(
            "SELECT * FROM `ana_grade_change_requests` WHERE class_id = :cid AND status = 'pending' ORDER BY id DESC LIMIT 1",
            ['cid' => $classId]
        );

        $correctionHistory = Database::fetchAll(
            "SELECT * FROM `ana_grade_change_requests` WHERE class_id = :cid ORDER BY id DESC LIMIT 5",
            ['cid' => $classId]
        );

        // Check if custom weights are permitted by university policy
        $allowCustomWeights = (bool) AnalyticsSettings::get('grading.allow_faculty_custom_weights');

        View::render('analytics/Views/faculty/class_record', [
            'class'              => $classDetails,
            'scheme'             => $scheme,
            'students'           => $students,
            'scoresMap'          => $scoresMap,
            'attendanceMap'      => $attendanceMap,
            'recordedDates'      => $recordedDates,
            'postedGradesMap'    => $postedGradesMap,
            'pendingCorrection'  => $pendingCorrection,
            'correctionHistory'  => $correctionHistory,
            'allowCustomWeights' => $allowCustomWeights,
            'title'              => "Class Record: {$classDetails['subject_code']} ({$classDetails['section_name']})",
            'crumbs'             => [
                'Faculty Workspace' => url('analytics/faculty'),
                'My Classes'        => url('analytics/faculty/classes'),
                'Class Record'      => ''
            ],
        ]);
    }

    /**
     * JSON autosave. Returns each touched student's grade recomputed by GradeCalculator.
     */
    public function saveScores(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'draft') {
            json_response(['status' => 'error', 'message' => 'Grades are posted or locked. File a correction request to edit scores.'], 403);
        }

        $payload = json_decode((string) file_get_contents('php://input'), true);
        $scores = $payload['scores'] ?? null;
        if (!is_array($scores) || count($scores) > 2000) {
            json_response(['status' => 'error', 'message' => 'Invalid scores payload.'], 400);
        }

        $items = GradeCalculator::items(ClassRecord::scheme($own));
        $rostered = array_map('intval', array_column(ClassRecord::roster($classId), 'student_id'));

        $stmt = Database::pdo()->prepare(
            "INSERT INTO `ana_class_scores` (`class_id`, `student_id`, `item_code`, `score`, `submission_status`, `updated_by`, `created_at`, `updated_at`)
             VALUES (:cid, :sid, :code, :score, 'submitted', :uid, NOW(), NOW())
             ON DUPLICATE KEY UPDATE `score` = VALUES(`score`), `updated_by` = VALUES(`updated_by`), `updated_at` = NOW()"
        );
        $touched = [];
        $errors = [];
        foreach ($scores as $s) {
            $sid = (int) ($s['student_id'] ?? 0);
            $code = (string) ($s['item_code'] ?? '');
            if (!in_array($sid, $rostered, true) || !isset($items[$code])) {
                continue;
            }
            $raw = $s['score'] ?? null;
            $score = ($raw === null || $raw === '') ? null : (is_numeric($raw) ? (float) $raw : false);
            if ($score === false || ($score !== null && ($score < 0 || $score > $items[$code]['maxScore']))) {
                $errors[] = "{$code}: score must be between 0 and {$items[$code]['maxScore']}";
                continue;
            }
            $stmt->execute(['cid' => $classId, 'sid' => $sid, 'code' => $code, 'score' => $score, 'uid' => (int) Auth::id()]);
            $touched[$sid] = true;
        }

        $rows = [];
        if ($touched) {
            $record = ClassRecord::load($own);
            foreach (array_keys($touched) as $sid) {
                $rows[$sid] = $record['computed'][$sid] ?? null;
            }
        }
        json_response(['status' => $errors ? 'partial' : 'success', 'errors' => $errors, 'rows' => $rows]);
    }

    public function pullSection(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot modify roster of a locked class.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $students = array_filter(Classroom::enrolledCandidates($class), fn($c) => (int) $c['same_section'] === 1);

        if (empty($students)) {
            Session::flash('error', 'No students in this section are officially enrolled by the Registrar in this subject for the term.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $added = 0;
        foreach ($students as $s) {
            Classroom::addToRoster($classId, (int) $s['student_id']);
            $added++;
        }
        ChangeLog::record('class', $classId, 'roster_pull_section', null, null, (string) $added, 'Pulled registrar-enrolled section students');

        Session::flash('success', "Roster updated: added {$added} officially enrolled student(s) from this section.");
        redirect(url('analytics/faculty/classes/' . $classId));
    }

    public function addStudent(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot modify roster of a locked class.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $search = trim($_POST['student_search'] ?? '');
        if ($search === '') {
            Session::flash('error', 'Please enter a student number or name.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $matches = Classroom::enrolledCandidates($class, $search);
        if (count($matches) !== 1) {
            Session::flash('error', count($matches) === 0
                ? "No student matching '{$search}' is officially enrolled in this subject for the term."
                : "'{$search}' matches " . count($matches) . " enrolled students. Enter the exact student number.");
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $student = $matches[0];
        Classroom::addToRoster($classId, (int) $student['student_id']);
        ChangeLog::record('class', $classId, 'roster_add', 'student_id', null, (string) $student['student_id'], 'Quick add of registrar-enrolled student');

        Session::flash('success', "Student {$student['first_name']} {$student['last_name']} ({$student['student_number']}) added to class roster.");
        redirect(url('analytics/faculty/classes/' . $classId));
    }

    /**
     * Remove or drop student from roster
     */
    public function removeStudent(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot modify roster of a locked class.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $studentId = (int) ($_POST['student_id'] ?? 0);
        if ($studentId <= 0) {
            Session::flash('error', 'Invalid student identifier.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        // Check if student has recorded scores
        $scoreCount = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_class_scores` WHERE class_id = :cid AND student_id = :sid",
            ['cid' => $classId, 'sid' => $studentId]
        );

        if ($scoreCount > 0) {
            // Soft drop on roster
            Database::update(
                'ana_class_students',
                ['status' => 'dropped', 'updated_at' => date('Y-m-d H:i:s')],
                '`class_id` = :cid AND `student_id` = :sid',
                ['cid' => $classId, 'sid' => $studentId]
            );
            Session::flash('info', 'Student has recorded scores and has been marked as Dropped on the roster.');
        } else {
            // Delete clean un-scored roster entry
            Database::delete(
                'ana_class_students',
                '`class_id` = :cid AND `student_id` = :sid',
                ['cid' => $classId, 'sid' => $studentId]
            );
            Session::flash('success', 'Student removed from class roster.');
        }

        redirect(url('analytics/faculty/classes/' . $classId));
    }

    /**
     * Save customized grading scheme for this class
     */
    public function saveScheme(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] !== 'draft') {
            Session::flash('error', 'Grading scheme cannot be altered after grades have been posted or locked.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        if (!AnalyticsSettings::get('grading.allow_faculty_custom_weights')) {
            Session::flash('error', 'Customizing assessment weights per class is disabled by university policy.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $schemeJson = $_POST['scheme_json'] ?? '';
        $schemeData = json_decode($schemeJson, true);

        if (!$schemeData || !isset($schemeData['groups']) || !is_array($schemeData['groups'])) {
            Session::flash('error', 'Invalid grading scheme structure.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        // Validate weights sum to 100
        $totalWeight = 0;
        foreach ($schemeData['groups'] as $grp) {
            $totalWeight += (float) ($grp['weight'] ?? 0);
        }

        if (abs($totalWeight - 100.0) > 0.01) {
            Session::flash('error', "Component weights must total exactly 100%. Current total: {$totalWeight}%.");
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $passingCutoff = isset($_POST['passing_cutoff']) ? (float) $_POST['passing_cutoff'] : (float) ($schemeData['passingCutoff'] ?? 3.04);
        $passingCutoff = max(1.00, min(5.00, $passingCutoff));
        $schemeData['passingCutoff'] = $passingCutoff;

        Database::update(
            'ana_classes',
            [
                'grading_scheme' => json_encode($schemeData),
                'passing_cutoff' => $passingCutoff,
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            '`id` = :id',
            ['id' => $classId]
        );

        ChangeLog::record(
            'class',
            $classId,
            'update_scheme',
            'grading_scheme',
            null,
            null,
            'Faculty updated class assessment scheme weights'
        );

        Session::flash('success', 'Grading scheme and component weights updated successfully.');
        redirect(url('analytics/faculty/classes/' . $classId));
    }

    public function postGrades(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'draft') {
            redirect($this->back($classId), 'error', 'Only a draft class record can be posted.');
        }
        $record = ClassRecord::load($own);
        if (empty($record['roster'])) {
            redirect($this->back($classId), 'error', 'There are no students on the roster to post grades for.');
        }

        $incDays = AnalyticsSettings::get('grading.inc_removal_days');
        $incDeadline = $incDays !== null && (int) $incDays > 0 ? date('Y-m-d', strtotime('+' . (int) $incDays . ' days')) : null;
        $now = date('Y-m-d H:i:s');
        $rosterIds = array_map('intval', array_column($record['roster'], 'student_id'));

        Database::beginTransaction();
        try {
            $stmt = Database::pdo()->prepare(
                "INSERT INTO `ana_class_grades` (`class_id`, `student_id`, `computed_grade`, `final_grade`, `remarks`, `inc_deadline`, `inc_resolved_at`, `posted_at`, `created_at`, `updated_at`)
                 VALUES (:cid, :sid, :computed, :final, :remarks, :deadline, NULL, :posted, :created, :updated)
                 ON DUPLICATE KEY UPDATE `computed_grade` = VALUES(`computed_grade`), `final_grade` = VALUES(`final_grade`), `remarks` = VALUES(`remarks`),
                    `inc_deadline` = VALUES(`inc_deadline`), `inc_resolved_at` = NULL, `posted_at` = VALUES(`posted_at`), `updated_at` = VALUES(`updated_at`)"
            );
            foreach ($record['computed'] as $sid => $res) {
                $existing = $record['posted'][$sid] ?? null;
                $deadline = null;
                if ($res['remarks'] === 'INC') {
                    $deadline = ($existing && $existing['remarks'] === 'INC' && $existing['inc_deadline']) ? $existing['inc_deadline'] : $incDeadline;
                }
                $stmt->execute([
                    'cid' => $classId, 'sid' => $sid, 'computed' => $res['computed_grade'], 'final' => $res['final_grade'],
                    'remarks' => $res['remarks'], 'deadline' => $deadline, 'posted' => $now, 'created' => $now, 'updated' => $now,
                ]);
            }
            Database::query(
                "DELETE FROM `ana_class_grades` WHERE class_id = :cid AND student_id NOT IN (" . implode(',', $rosterIds) . ")",
                ['cid' => $classId]
            );
            Database::update('ana_classes', ['grade_status' => 'posted', 'posted_at' => $now, 'posted_by' => (int) Auth::id(), 'updated_at' => $now],
                'id = :id', ['id' => $classId]);
            Database::update('ana_grade_change_requests', ['status' => 'completed', 'updated_at' => $now],
                "class_id = :cid AND status = 'approved'", ['cid' => $classId]);
            ChangeLog::record('class', $classId, 'post_grades', 'grade_status', 'draft', 'posted', 'Posted ' . count($record['computed']) . ' grade(s)');
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }

        Notifier::classStudents($classId, "Grades posted: {$own['subject_code']}", "Your final grade for {$own['subject_code']} ({$own['section_name']}) is now available.", 'analytics/my/grades');
        redirect($this->back($classId), 'success', 'Grades posted. Students can now see their final grades.');
    }

    public function resolveInc(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if (!ClassRecord::isPublished($own)) {
            redirect($this->back($classId), 'error', 'INC can only be resolved on posted grades.');
        }
        $sid = (int) ($_POST['student_id'] ?? 0);
        $grade = (float) ($_POST['resolved_grade'] ?? 0);
        $notes = trim((string) ($_POST['notes'] ?? ''));
        if ($grade < 1.0 || $grade > 5.0) {
            redirect($this->back($classId), 'error', 'The completed grade must be between 1.00 and 5.00.');
        }
        $existing = Database::fetchOne("SELECT * FROM `ana_class_grades` WHERE class_id = :cid AND student_id = :sid AND remarks = 'INC' AND inc_resolved_at IS NULL",
            ['cid' => $classId, 'sid' => $sid]);
        if (!$existing) {
            redirect($this->back($classId), 'error', 'No open INC was found for that student.');
        }
        $cutoff = ClassRecord::scheme($own)['passingCutoff'];
        $final = number_format($grade, 2, '.', '');
        $remarks = $grade <= $cutoff ? 'PASSED' : 'FAILED';

        Database::beginTransaction();
        try {
            Database::update('ana_class_grades', ['final_grade' => $final, 'computed_grade' => $grade, 'remarks' => $remarks, 'inc_resolved_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                'id = :id', ['id' => (int) $existing['id']]);
            Database::update('ana_class_students', ['grade_mark' => null], 'class_id = :cid AND student_id = :sid', ['cid' => $classId, 'sid' => $sid]);
            ChangeLog::record('class_grade', (int) $existing['id'], 'resolve_inc', 'final_grade', 'INC', $final, $notes ?: 'INC requirement completed');
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }
        Notifier::student($sid, "INC resolved: {$own['subject_code']}", "Your completed grade is {$final} ({$remarks}).", 'analytics/my/grades');
        redirect($this->back($classId), 'success', "INC resolved with {$final} ({$remarks}).");
    }

    /**
     * Log a task exception (submitted, late, missing, excused)
     */
    public function saveTaskException(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot log task exceptions for locked classes.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $studentId = (int) ($_POST['student_id'] ?? 0);
        $itemCode = trim($_POST['item_code'] ?? '');
        $status = $_POST['submission_status'] ?? 'submitted';

        if (!in_array($status, ['submitted', 'late', 'missing', 'excused'], true)) {
            $status = 'submitted';
        }

        $uid = (int) Auth::id();
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            INSERT INTO `ana_class_scores` (`class_id`, `student_id`, `item_code`, `score`, `submission_status`, `updated_by`, `created_at`, `updated_at`)
            VALUES (:cid, :sid, :code, 0.0, :st, :uid, NOW(), NOW())
            ON DUPLICATE KEY UPDATE 
                `submission_status` = VALUES(`submission_status`),
                `updated_by` = VALUES(`updated_by`),
                `updated_at` = NOW()
        ");
        $stmt->execute([
            'cid'  => $classId,
            'sid'  => $studentId,
            'code' => $itemCode,
            'st'   => $status,
            'uid'  => $uid,
        ]);

        Session::flash('success', "Task exception for {$itemCode} updated to " . ucfirst($status) . ".");
        redirect(url('analytics/faculty/classes/' . $classId));
    }

    /**
     * Submit grade correction request to admin
     */
    public function requestCorrection(string $id): void
    {
        $classId = (int) $id;
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] !== 'posted') {
            Session::flash('error', 'Correction requests can only be filed for classes in Posted status.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        $reason = trim($_POST['reason'] ?? '');
        if (strlen($reason) < 10) {
            Session::flash('error', 'A comprehensive justification (at least 10 characters) is required.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        // Check if pending request already exists
        $pending = Database::fetchOne(
            "SELECT id FROM `ana_grade_change_requests` WHERE class_id = :cid AND status = 'pending'",
            ['cid' => $classId]
        );

        if ($pending) {
            Session::flash('warning', 'A correction request for this class is already pending administrative review.');
            redirect(url('analytics/faculty/classes/' . $classId));
            return;
        }

        Database::insert('ana_grade_change_requests', [
            'class_id'     => $classId,
            'requested_by' => Auth::id(),
            'reason'       => $reason,
            'status'       => 'pending',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        ChangeLog::record(
            'class',
            $classId,
            'request_correction',
            'grade_status',
            'posted',
            'pending_review',
            $reason
        );

        Session::flash('success', 'Grade correction request submitted to administrator.');
        redirect(url('analytics/faculty/classes/' . $classId));
    }

    /**
     * Roster-limited student directory
     */
    public function students(): void
    {
        $facultyId = AnalyticsAccess::facultyUserId();
        $studentIds = AnalyticsAccess::facultyStudentIds($facultyId);

        $students = [];
        if (!empty($studentIds)) {
            $inClause = implode(',', array_map('intval', $studentIds));
            $students = Database::fetchAll(
                "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, s.enrollment_status,
                        p.code AS program_code, p.name AS program_name,
                        sec.name AS section_name,
                        GROUP_CONCAT(DISTINCT CONCAT(COALESCE(c.subject_code, sub.code), ' (', COALESCE(c.section_name, sec2.name), ')') SEPARATOR ', ') AS enrolled_classes
                 FROM `students` s
                 JOIN `ana_class_students` cs ON s.id = cs.student_id AND cs.status = 'enrolled'
                 JOIN `ana_classes` c ON cs.class_id = c.id AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
                 LEFT JOIN `subjects` sub ON c.subject_id = sub.id
                 LEFT JOIN `sections` sec2 ON c.section_id = sec2.id
                 LEFT JOIN `programs` p ON s.program_id = p.id
                 LEFT JOIN `sections` sec ON s.section_id = sec.id
                 WHERE s.id IN ({$inClause}) AND s.deleted_at IS NULL
                 GROUP BY s.id
                 ORDER BY s.last_name ASC, s.first_name ASC",
                ['fid' => $facultyId]
            );
        }

        View::render('analytics/Views/faculty/students', [
            'students' => $students,
            'title'    => 'My Enrolled Students Directory - MarSU ERP',
            'crumbs'   => ['Faculty Workspace' => url('analytics/faculty'), 'My Students' => ''],
        ]);
    }

    /**
     * Roster-limited student academic profile view
     */
    public function studentView(string $id): void
    {
        $studentId = (int) $id;
        $facultyId = AnalyticsAccess::facultyUserId();

        if (!AnalyticsAccess::canSeeStudent($studentId)) {
            Session::flash('error', 'Record not found.');
            redirect(url('analytics/faculty/students'));
            return;
        }

        // Load student master record (strictly redacting contact, address, guardian info)
        $student = Database::fetchOne(
            "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, s.enrollment_status,
                    p.code AS program_code, p.name AS program_name,
                    sec.name AS section_name
             FROM `students` s
             LEFT JOIN `programs` p ON s.program_id = p.id
             LEFT JOIN `sections` sec ON s.section_id = sec.id
             WHERE s.id = :id AND s.deleted_at IS NULL LIMIT 1",
            ['id' => $studentId]
        );

        if (!$student) {
            Session::flash('error', 'Record not found.');
            redirect(url('analytics/faculty/students'));
            return;
        }

        // Load student enrollments and grades strictly from this faculty's classes
        $classes = Database::fetchAll(
            "SELECT c.id AS class_id, c.grade_status, c.passing_cutoff,
                    COALESCE(c.subject_code, sub.code) AS subject_code,
                    COALESCE(c.subject_title, sub.title) AS subject_title,
                    COALESCE(c.units, sub.units) AS units,
                    COALESCE(c.section_name, sec.name) AS section_name,
                    g.computed_grade, g.final_grade, g.remarks, g.inc_deadline, g.inc_resolved_at, g.posted_at
             FROM `ana_class_students` cs
             JOIN `ana_classes` c ON cs.class_id = c.id
             LEFT JOIN `subjects` sub ON c.subject_id = sub.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `ana_class_grades` g ON g.class_id = c.id AND g.student_id = cs.student_id
             WHERE cs.student_id = :sid AND c.faculty_user_id = :fid AND c.deleted_at IS NULL AND cs.status = 'enrolled'
             ORDER BY c.id DESC",
            ['sid' => $studentId, 'fid' => $facultyId]
        );

        // Load scores and task exceptions in this faculty's classes
        $scores = Database::fetchAll(
            "SELECT sc.*, NULL AS notes, COALESCE(c.subject_code, sub.code) AS subject_code, c.id AS class_id
             FROM `ana_class_scores` sc
             JOIN `ana_classes` c ON sc.class_id = c.id
             LEFT JOIN `subjects` sub ON c.subject_id = sub.id
             WHERE sc.student_id = :sid AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY subject_code ASC, sc.item_code ASC",
            ['sid' => $studentId, 'fid' => $facultyId]
        );

        // Load attendance logs in this faculty's classes
        $attendance = Database::fetchAll(
            "SELECT a.*, COALESCE(a.subject_code, c.subject_code) AS subject_code 
             FROM `ana_attendance_records` a
             JOIN `ana_classes` c ON a.class_id = c.id
             WHERE a.student_id = :snum AND c.faculty_user_id = :fid AND a.voided_at IS NULL
             ORDER BY a.session_date DESC",
            ['snum' => $studentId, 'fid' => $facultyId]
        );

        // Load conduct reports filed by this faculty member for this student
        $conductReports = Database::fetchAll(
            "SELECT * FROM `ana_behavior_records`
             WHERE student_id = :snum AND reported_by = :fid AND deleted_at IS NULL
             ORDER BY incident_date DESC",
            ['snum' => $studentId, 'fid' => $facultyId]
        );

        View::render('analytics/Views/faculty/student_view', [
            'student'        => $student,
            'classes'        => $classes,
            'scores'         => $scores,
            'attendance'     => $attendance,
            'conductReports' => $conductReports,
            'title'          => "Student Profile: {$student['first_name']} {$student['last_name']} ({$student['student_number']})",
            'crumbs'         => [
                'Faculty Workspace' => url('analytics/faculty'),
                'My Students'        => url('analytics/faculty/students'),
                'Academic View'     => ''
            ],
        ]);
    }

    /**
     * Faculty Roll-Call Attendance
     */
    public function attendance(): void
    {
        $facultyId = AnalyticsAccess::facultyUserId();
        if (!$facultyId) {
            Session::flash('error', 'Faculty credentials required.');
            redirect(url('analytics'));
            return;
        }

        // List faculty classes for selection
        $classes = Database::fetchAll(
            "SELECT c.id, 
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.section_name, sec.name) AS section_name
             FROM `ana_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY c.id DESC",
            ['fid' => $facultyId]
        );

        $selectedClassId = (int) ($_GET['class_id'] ?? ($classes[0]['id'] ?? 0));
        $sessionDate = $_GET['date'] ?? date('Y-m-d');

        $roster = [];
        $existingAttendance = [];
        $sessionHistory = [];

        if ($selectedClassId > 0 && AnalyticsAccess::ownsClass($selectedClassId)) {
            // Load enrolled roster
            $roster = Database::fetchAll(
                "SELECT cs.student_id, st.student_number, st.first_name, st.last_name, p.code AS program_code
                 FROM `ana_class_students` cs
                 JOIN `students` st ON cs.student_id = st.id
                 LEFT JOIN `programs` p ON st.program_id = p.id
                 WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND st.deleted_at IS NULL
                 ORDER BY st.last_name ASC, st.first_name ASC",
                ['cid' => $selectedClassId]
            );

            // Load existing attendance on this date
            $records = Database::fetchAll(
                "SELECT st.student_number AS student_id, a.status, a.remarks 
                 FROM `ana_attendance_records` a 
                 JOIN `students` st ON st.id = a.student_id
                 WHERE a.class_id = :cid AND a.session_date = :sdate AND a.voided_at IS NULL",
                ['cid' => $selectedClassId, 'sdate' => $sessionDate]
            );
            foreach ($records as $r) {
                $existingAttendance[$r['student_id']] = $r;
            }

            // Load session history for this class
            $sessionHistory = Database::fetchAll(
                "SELECT session_date, COUNT(*) AS total_logged,
                        SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) AS present_count,
                        SUM(CASE WHEN status='Absent' THEN 1 ELSE 0 END) AS absent_count,
                        SUM(CASE WHEN status='Late' THEN 1 ELSE 0 END) AS late_count,
                        SUM(CASE WHEN status='Excused' THEN 1 ELSE 0 END) AS excused_count
                 FROM `ana_attendance_records`
                 WHERE class_id = :cid AND voided_at IS NULL
                 GROUP BY session_date
                 ORDER BY session_date DESC
                 LIMIT 15",
                ['cid' => $selectedClassId]
            );
        }

        View::render('analytics/Views/faculty/attendance', [
            'classes'            => $classes,
            'selectedClassId'    => $selectedClassId,
            'sessionDate'        => $sessionDate,
            'roster'             => $roster,
            'existingAttendance' => $existingAttendance,
            'sessionHistory'     => $sessionHistory,
            'title'              => 'Roll-Call Attendance - Faculty Workspace',
            'crumbs'             => ['Faculty Workspace' => url('analytics/faculty'), 'Roll-Call' => ''],
        ]);
    }

    /**
     * Store roll-call attendance
     */
    public function storeAttendance(): void
    {
        $classId = (int) ($_POST['class_id'] ?? 0);
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        $sessionDate = $_POST['session_date'] ?? date('Y-m-d');
        $validDate = \DateTime::createFromFormat('Y-m-d', (string) $sessionDate);
        if (!$validDate || $validDate->format('Y-m-d') !== $sessionDate || $sessionDate > date('Y-m-d')) {
            Session::flash('error', 'Cannot record attendance for future dates.');
            redirect(url('analytics/faculty/attendance?class_id=' . $classId . '&date=' . $sessionDate));
            return;
        }

        $classInfo = Database::fetchOne(
            "SELECT c.*, COALESCE(c.subject_code, s.code) AS subject_code 
             FROM `ana_classes` c 
             LEFT JOIN `subjects` s ON c.subject_id = s.id 
             WHERE c.id = :cid",
            ['cid' => $classId]
        );

        // Load enrolled student numbers
        $roster = Database::fetchAll(
            "SELECT st.student_number, st.id 
             FROM `ana_class_students` cs 
             JOIN `students` st ON cs.student_id = st.id 
             WHERE cs.class_id = :cid AND cs.status = 'enrolled'",
            ['cid' => $classId]
        );
        $rosterMap = array_column($roster, 'id', 'student_number');

        $statuses = $_POST['status'] ?? [];
        $remarks = $_POST['remarks'] ?? [];
        $savedCount = 0;

        $pdo = Database::pdo();
        $selectStmt = $pdo->prepare("
            SELECT id FROM `ana_attendance_records` 
            WHERE class_id = :cid AND student_id = :snum AND session_date = :sdate AND voided_at IS NULL LIMIT 1
        ");

        $insertStmt = $pdo->prepare("
            INSERT INTO `ana_attendance_records` 
                (`class_id`, `student_id`, `subject_code`, `session_date`, `status`, `remarks`, `recorded_by`, `created_at`, `updated_at`)
            VALUES 
                (:cid, :snum, :code, :sdate, :st, :rem, :uid, NOW(), NOW())
        ");

        $updateStmt = $pdo->prepare("
            UPDATE `ana_attendance_records` 
            SET `status` = :st, `remarks` = :rem, `updated_at` = NOW() 
            WHERE `id` = :id
        ");

        $uid = (int) Auth::id();
        foreach ($statuses as $snum => $st) {
            if (!isset($rosterMap[$snum])) {
                continue;
            }
            if (!in_array($st, ['Present', 'Absent', 'Excused', 'Late'], true)) {
                $st = 'Present';
            }
            $rem = trim($remarks[$snum] ?? '');

            $selectStmt->execute(['cid' => $classId, 'snum' => (int) $rosterMap[$snum], 'sdate' => $sessionDate]);
            $existing = $selectStmt->fetch();

            if ($existing) {
                $updateStmt->execute(['st' => $st, 'rem' => $rem, 'id' => $existing['id']]);
            } else {
                $insertStmt->execute([
                    'cid'    => $classId,
                    'snum'   => (int) $rosterMap[$snum],
                    'code'   => $classInfo['subject_code'],
                    'sdate'  => $sessionDate,
                    'st'     => $st,
                    'rem'    => $rem,
                    'uid'    => $uid,
                ]);
            }
            $savedCount++;
        }

        // Check absence warning count policy
        $warningCount = AnalyticsSettings::get('attendance.absence_warning_count');
        foreach ($statuses as $snum => $st) {
            if ($st === 'Absent' && $warningCount !== null && isset($rosterMap[$snum])) {
                $totalAbsences = (int) Database::fetchColumn(
                    "SELECT COUNT(*) FROM `ana_attendance_records`
                     WHERE class_id = :cid AND student_id = :snum AND status = 'Absent' AND voided_at IS NULL",
                    ['cid' => $classId, 'snum' => (int) $rosterMap[$snum]]
                );
                if ($totalAbsences >= $warningCount) {
                    // Log the warning once in the module logbook (ana_records)
                    $existingWarning = Database::fetchOne(
                        "SELECT id FROM `ana_records`
                         WHERE title = :title AND deleted_at IS NULL LIMIT 1",
                        ['title' => "Absence Warning: {$snum} in {$classInfo['subject_code']}"]
                    );
                    if (!$existingWarning) {
                        Database::insert('ana_records', [
                            'title'       => "Absence Warning: {$snum} in {$classInfo['subject_code']}",
                            'description' => "Student {$snum} has reached {$totalAbsences} unexcused absences in {$classInfo['subject_code']}.",
                            'status'      => 'pending',
                            'created_by'  => $uid,
                            'created_at'  => date('Y-m-d H:i:s'),
                            'updated_at'  => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }
        }

        Session::flash('success', "Roll-call attendance recorded for {$savedCount} students on {$sessionDate}.");
        redirect(url('analytics/faculty/attendance?class_id=' . $classId . '&date=' . $sessionDate));
    }

    /**
     * Faculty Incident Reporting
     */
    public function conduct(): void
    {
        $facultyId = AnalyticsAccess::facultyUserId();
        if (!$facultyId) {
            Session::flash('error', 'Faculty credentials required.');
            redirect(url('analytics'));
            return;
        }

        // List faculty classes for selection
        $classes = Database::fetchAll(
            "SELECT c.id, 
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.section_name, sec.name) AS section_name
             FROM `ana_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY c.id DESC",
            ['fid' => $facultyId]
        );

        // List enrolled students across all assigned classes
        $studentIds = AnalyticsAccess::facultyStudentIds($facultyId);
        $students = [];
        if (!empty($studentIds)) {
            $inClause = implode(',', array_map('intval', $studentIds));
            $students = Database::fetchAll(
                "SELECT s.id, s.student_number, s.first_name, s.last_name, sec.name AS section_name
                 FROM `students` s
                 LEFT JOIN `sections` sec ON s.section_id = sec.id
                 WHERE s.id IN ({$inClause}) AND s.deleted_at IS NULL
                 ORDER BY s.last_name ASC, s.first_name ASC"
            );
        }

        // List incidents filed by this faculty member
        $reports = Database::fetchAll(
            "SELECT b.*, st.first_name, st.last_name, st.student_number AS student_id,
                    IF(b.status = 'Investigating', 'Under Investigation', b.status) AS status,
                    COALESCE(c.subject_code, sub.code) AS subject_code,
                    COALESCE(c.section_name, sec.name) AS section_name
             FROM `ana_behavior_records` b
             JOIN `students` st ON b.student_id = st.id
             LEFT JOIN `ana_classes` c ON b.class_id = c.id
             LEFT JOIN `subjects` sub ON c.subject_id = sub.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             WHERE b.reported_by = :fid AND b.deleted_at IS NULL
             ORDER BY b.incident_date DESC, b.id DESC",
            ['fid' => $facultyId]
        );

        View::render('analytics/Views/faculty/conduct', [
            'classes'  => $classes,
            'students' => $students,
            'reports'  => $reports,
            'title'    => 'Student Conduct Incident Reports - Faculty Workspace',
            'crumbs'   => ['Faculty Workspace' => url('analytics/faculty'), 'Conduct Reports' => ''],
        ]);
    }

    /**
     * Store conduct incident report
     */
    public function storeConduct(): void
    {
        $classId = (int) ($_POST['class_id'] ?? 0);
        $class = AnalyticsAccess::findOwnClassOr404($classId);

        $studentNumber = trim($_POST['student_number'] ?? '');
        $incidentType = trim($_POST['incident_type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $severity = $_POST['severity'] ?? 'Minor';
        $incidentDate = $_POST['incident_date'] ?? date('Y-m-d');

        if ($incidentDate > date('Y-m-d')) {
            Session::flash('error', 'Incident date cannot be in the future.');
            redirect(url('analytics/faculty/conduct'));
            return;
        }

        if (!in_array($severity, ['Minor', 'Moderate', 'Severe'], true)) {
            $severity = 'Minor';
        }

        if ($studentNumber === '' || $incidentType === '' || strlen($description) < 10) {
            Session::flash('error', 'Please provide student, incident type, and a descriptive narrative (min 10 characters).');
            redirect(url('analytics/faculty/conduct'));
            return;
        }

        // Verify student is on the roster for this class
        $enrolled = Database::fetchOne(
            "SELECT cs.id, st.id AS student_pk FROM `ana_class_students` cs 
             JOIN `students` st ON cs.student_id = st.id 
             WHERE cs.class_id = :cid AND st.student_number = :snum AND cs.status = 'enrolled' LIMIT 1",
            ['cid' => $classId, 'snum' => $studentNumber]
        );

        if (!$enrolled) {
            Session::flash('error', 'The student selected is not enrolled on this class roster.');
            redirect(url('analytics/faculty/conduct'));
            return;
        }

        $id = Database::insert('ana_behavior_records', [
            'class_id'      => $classId,
            'student_id'    => (int) $enrolled['student_pk'],
            'incident_type' => mb_substr($incidentType, 0, 100),
            'description'   => $description,
            'severity'      => $severity,
            'reported_by'   => Auth::id(),
            'incident_date' => $incidentDate,
            'status'        => 'Reported',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        ChangeLog::record(
            'conduct',
            $id,
            'report_incident',
            'status',
            null,
            'Reported',
            "Faculty reported {$severity} incident ({$incidentType}) for student {$studentNumber}"
        );

        Session::flash('success', "Conduct incident report filed successfully for {$studentNumber}.");
        redirect(url('analytics/faculty/conduct'));
    }

    // ------------------------------------------------------------------
    // Classroom features: create class, class code, enrollment roster, join requests, stream
    // ------------------------------------------------------------------

    /**
     * Original class record page for 'record'; the classroom page for stream / roster / settings.
     */
    private function back(int $classId, string $tab = 'record'): string
    {
        if ($tab === 'record') {
            return url('analytics/faculty/classes/' . $classId);
        }
        return url('analytics/faculty/classes/' . $classId . '/classroom', ['tab' => $tab]);
    }

    public function classroom(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $class = ClassRecord::details((int) $own['id']);
        $classId = (int) $class['id'];
        $tab = in_array($_GET['tab'] ?? '', ['roster', 'stream', 'settings'], true) ? $_GET['tab'] : 'stream';
        $search = trim((string) ($_GET['q'] ?? ''));

        $joinRequests = Database::fetchAll(
            "SELECT j.*, s.student_number, s.first_name, s.last_name, p.code AS program_code
             FROM `ana_class_join_requests` j JOIN `students` s ON s.id = j.student_id LEFT JOIN `programs` p ON p.id = s.program_id
             WHERE j.class_id = :cid AND j.status = 'pending' ORDER BY j.created_at",
            ['cid' => $classId]
        );
        foreach ($joinRequests as &$jr) {
            $jr['officially_enrolled'] = Classroom::isOfficiallyEnrolled((int) $jr['student_id'], $class);
        }
        unset($jr);

        View::render('analytics/Views/faculty/classroom', [
            'class'              => $class,
            'record'             => ClassRecord::load($class),
            'droppedRoster'      => array_values(array_filter(ClassRecord::roster($classId, true), fn($r) => $r['roster_status'] === 'dropped')),
            'tab'                => $tab,
            'search'             => $search,
            'candidates'         => Classroom::enrolledCandidates($class, $search !== '' ? $search : null),
            'joinRequests'       => $joinRequests,
            'posts'              => Database::fetchAll(
                "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS author
                 FROM `ana_class_posts` p LEFT JOIN `users` u ON u.id = p.author_user_id
                 WHERE p.class_id = :cid AND p.deleted_at IS NULL
                 ORDER BY p.is_pinned DESC, p.created_at DESC",
                ['cid' => $classId]
            ),
            'correctionHistory'  => Database::fetchAll("SELECT * FROM `ana_grade_change_requests` WHERE class_id = :cid ORDER BY id DESC LIMIT 5", ['cid' => $classId]),
            'allowCustomWeights' => (bool) AnalyticsSettings::get('grading.allow_faculty_custom_weights'),
            'incWindowDays'      => AnalyticsSettings::get('grading.inc_removal_days'),
            'title'              => "Classroom: {$class['subject_code']} ({$class['section_name']})",
            'crumbs'             => ['Faculty Workspace' => url('analytics/faculty'), 'My Classes' => url('analytics/faculty/classes'), $class['subject_code'] => ''],
        ]);
    }
    public function createClass(): void
    {
        View::render('analytics/Views/faculty/class_create', [
            'term'      => AnalyticsAccess::activeTerm(),
            'subjects'  => Database::fetchAll("SELECT s.id, s.code, s.title, s.units, p.code AS program_code FROM `subjects` s LEFT JOIN `programs` p ON p.id = s.program_id WHERE s.deleted_at IS NULL AND s.status = 'active' ORDER BY s.code"),
            'sections'  => Database::fetchAll("SELECT sec.id, sec.name, sec.year_level, p.code AS program_code FROM `sections` sec JOIN `programs` p ON p.id = sec.program_id WHERE sec.deleted_at IS NULL ORDER BY p.code, sec.year_level, sec.name"),
            'templates' => Database::fetchAll("SELECT id, name, passing_cutoff, is_default FROM `ana_grading_templates` WHERE is_active = 1 AND deleted_at IS NULL ORDER BY is_default DESC, name"),
            'title'     => 'Create Class',
            'crumbs'    => ['Faculty Workspace' => url('analytics/faculty'), 'Create Class' => ''],
        ]);
    }

    public function storeClass(): void
    {
        $result = Classroom::create($_POST, (int) Auth::id());
        if (isset($result['error'])) {
            Session::setOldInput($_POST);
            redirect(url('analytics/faculty/classes/create'), 'error', $result['error']);
        }
        redirect($this->back($result['id'], 'roster'), 'success', "Class created. Share class code {$result['code']} with your enrolled students, or add them from the registrar list.");
    }

    public function updateClass(string $id): void
    {
        $class = AnalyticsAccess::findOwnClassOr404($id);
        Database::update('ana_classes', [
            'description' => Classroom::nullable($_POST['description'] ?? null, 2000),
            'schedule'    => Classroom::nullable($_POST['schedule'] ?? null, 128),
            'room'        => Classroom::nullable($_POST['room'] ?? null, 64),
            'updated_at'  => date('Y-m-d H:i:s'),
        ], 'id = :id', ['id' => (int) $class['id']]);
        redirect($this->back((int) $class['id'], 'settings'), 'success', 'Class details updated.');
    }

    public function addEnrolled(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] === 'locked') {
            redirect($this->back($classId, 'roster'), 'error', 'The roster of a locked class cannot change.');
        }
        $ids = array_unique(array_map('intval', (array) ($_POST['student_ids'] ?? [])));
        if (!$ids) {
            redirect($this->back($classId, 'roster'), 'error', 'Select at least one enrolled student.');
        }
        $eligible = array_map('intval', array_column(Classroom::enrolledCandidates($own), 'student_id'));
        $added = 0;
        foreach ($ids as $sid) {
            if (in_array($sid, $eligible, true)) {
                Classroom::addToRoster($classId, $sid);
                $added++;
            }
        }
        if ($added > 0) {
            ChangeLog::record('class', $classId, 'roster_add', 'student_ids', null, implode(',', $ids), "Added {$added} registrar-enrolled student(s)");
        }
        $skipped = count($ids) - $added;
        redirect($this->back($classId, 'roster'), $added ? 'success' : 'error',
            "Added {$added} student(s) to the roster." . ($skipped ? " {$skipped} were skipped because they are not officially enrolled in this subject for the term." : ''));
    }

    public function setGradeMark(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'draft') {
            redirect($this->back($classId, 'roster'), 'error', 'INC / DRP marks can only change while the class record is in draft.');
        }
        $sid = (int) ($_POST['student_id'] ?? 0);
        $mark = (string) ($_POST['mark'] ?? '');
        $mark = in_array($mark, GradeCalculator::MARKS, true) ? $mark : null;
        if (!Classroom::isRostered($classId, $sid)) {
            redirect($this->back($classId, 'roster'), 'error', 'That student is not on this roster.');
        }
        Database::update('ana_class_students', ['grade_mark' => $mark, 'updated_at' => date('Y-m-d H:i:s')],
            'class_id = :cid AND student_id = :sid', ['cid' => $classId, 'sid' => $sid]);
        ChangeLog::record('class_roster', $classId, 'grade_mark', 'student_id:' . $sid, null, $mark ?? 'none', 'Faculty set grade mark');
        redirect($this->back($classId, 'roster'), 'success', $mark ? "Student marked {$mark}; it applies when grades are posted." : 'Mark cleared.');
    }

    public function approveJoin(string $id, string $reqId): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        $req = Database::fetchOne("SELECT * FROM `ana_class_join_requests` WHERE id = :id AND class_id = :cid AND status = 'pending'", ['id' => (int) $reqId, 'cid' => $classId]);
        if (!$req) {
            redirect($this->back($classId, 'roster'), 'error', 'Join request not found.');
        }
        if (!Classroom::isOfficiallyEnrolled((int) $req['student_id'], $own)) {
            redirect($this->back($classId, 'roster'), 'error', 'This student is not officially enrolled in the subject for this term, so the request cannot be approved.');
        }
        Database::beginTransaction();
        try {
            Classroom::addToRoster($classId, (int) $req['student_id']);
            Database::update('ana_class_join_requests', ['status' => 'approved', 'decided_by' => (int) Auth::id(), 'decided_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                'id = :id', ['id' => (int) $req['id']]);
            ChangeLog::record('class_join', (int) $req['id'], 'approve', 'student_id', null, (string) $req['student_id'], 'Join request approved');
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }
        Notifier::student((int) $req['student_id'], "Join request approved: {$own['subject_code']}", "You are now on the roster of {$own['subject_code']} ({$own['section_name']}).", 'analytics/my/classes/' . $classId);
        redirect($this->back($classId, 'roster'), 'success', 'Join request approved.');
    }

    public function rejectJoin(string $id, string $reqId): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        $req = Database::fetchOne("SELECT * FROM `ana_class_join_requests` WHERE id = :id AND class_id = :cid AND status = 'pending'", ['id' => (int) $reqId, 'cid' => $classId]);
        if (!$req) {
            redirect($this->back($classId, 'roster'), 'error', 'Join request not found.');
        }
        Database::update('ana_class_join_requests', ['status' => 'rejected', 'decided_by' => (int) Auth::id(), 'decided_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id', ['id' => (int) $req['id']]);
        ChangeLog::record('class_join', (int) $req['id'], 'reject', 'student_id', null, (string) $req['student_id'], 'Join request rejected');
        Notifier::student((int) $req['student_id'], "Join request declined: {$own['subject_code']}", 'Contact your instructor or the Registrar if you believe this is a mistake.', 'analytics/my/classes');
        redirect($this->back($classId, 'roster'), 'success', 'Join request rejected.');
    }

    public function storePost(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        $type = ($_POST['type'] ?? '') === 'material' ? 'material' : 'announcement';
        $title = trim((string) ($_POST['title'] ?? ''));
        $body = trim((string) ($_POST['body'] ?? ''));
        if ($title === '' || mb_strlen($title) > 191) {
            redirect($this->back($classId, 'stream'), 'error', 'A title of up to 191 characters is required.');
        }
        if (mb_strlen($body) > 10000) {
            redirect($this->back($classId, 'stream'), 'error', 'The post body is limited to 10,000 characters.');
        }

        $path = $name = $size = null;
        if (!empty($_FILES['attachment']) && ($_FILES['attachment']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            try {
                [$path, $name, $size] = Classroom::storeUpload($_FILES['attachment']);
            } catch (\RuntimeException $e) {
                redirect($this->back($classId, 'stream'), 'error', $e->getMessage());
            }
        }

        Database::insert('ana_class_posts', [
            'class_id'        => $classId,
            'author_user_id'  => (int) Auth::id(),
            'type'            => $type,
            'title'           => $title,
            'body'            => $body === '' ? null : $body,
            'attachment_path' => $path,
            'attachment_name' => $name,
            'attachment_size' => $size,
            'is_pinned'       => !empty($_POST['is_pinned']) ? 1 : 0,
            'created_at'      => date('Y-m-d H:i:s'),
        ]);
        Notifier::classStudents($classId, "New " . ($type === 'material' ? 'material' : 'announcement') . " in {$own['subject_code']}", $title, 'analytics/my/classes/' . $classId);
        redirect($this->back($classId, 'stream'), 'success', 'Posted to the class stream.');
    }

    private function findPost(int $classId, string $postId): array
    {
        $post = Database::fetchOne("SELECT * FROM `ana_class_posts` WHERE id = :id AND class_id = :cid AND deleted_at IS NULL", ['id' => (int) $postId, 'cid' => $classId]);
        if (!$post) {
            AnalyticsAccess::notFound();
        }
        return $post;
    }

    public function deletePost(string $id, string $postId): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $post = $this->findPost((int) $own['id'], $postId);
        Database::update('ana_class_posts', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $post['id']]);
        redirect($this->back((int) $own['id'], 'stream'), 'success', 'Post removed.');
    }

    public function togglePin(string $id, string $postId): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $post = $this->findPost((int) $own['id'], $postId);
        Database::update('ana_class_posts', ['is_pinned' => $post['is_pinned'] ? 0 : 1, 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $post['id']]);
        redirect($this->back((int) $own['id'], 'stream'));
    }

    public function toggleScoresVisibility(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $new = $own['scores_visible'] ? 0 : 1;
        Database::update('ana_classes', ['scores_visible' => $new, 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $own['id']]);
        ChangeLog::record('class', (int) $own['id'], 'scores_visibility', 'scores_visible', (string) $own['scores_visible'], (string) $new, 'Faculty changed task score visibility');
        redirect($this->back((int) $own['id'], 'settings'), 'success', $new ? 'Students can now see their own task scores.' : 'Task scores are now hidden from students.');
    }

    /**
     * Serves a stream attachment to the owning faculty, rostered students, or scoped monitoring users.
     */
    public function downloadAttachment(string $id, string $postId): void
    {
        $classId = (int) $id;
        $allowed = AnalyticsAccess::ownsClass($classId) || AnalyticsAccess::canSeeClass($classId);
        if (!$allowed && can('analytics.student.portal')) {
            $sid = AnalyticsAccess::currentStudentId();
            $allowed = $sid !== null && Classroom::isRostered($classId, $sid);
        }
        if (!$allowed) {
            AnalyticsAccess::notFound();
        }
        $post = $this->findPost($classId, $postId);
        $file = Classroom::uploadDir() . '/' . basename((string) $post['attachment_path']);
        if (empty($post['attachment_path']) || !is_file($file)) {
            AnalyticsAccess::notFound();
        }
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $mime = Classroom::UPLOAD_EXTENSIONS[$ext][0] ?? 'application/octet-stream';
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($file));
        header('X-Content-Type-Options: nosniff');
        header('Content-Disposition: attachment; filename="' . str_replace('"', '', (string) $post['attachment_name']) . '"');
        readfile($file);
        exit;
    }

    public function streamOverview(): void
    {
        $posts = Database::fetchAll(
            "SELECT p.*, c.subject_code, c.section_name
             FROM `ana_class_posts` p JOIN `ana_classes` c ON c.id = p.class_id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND p.deleted_at IS NULL
             ORDER BY p.created_at DESC LIMIT 50",
            ['fid' => (int) Auth::id()]
        );
        View::render('analytics/Views/faculty/stream', [
            'posts'   => $posts,
            'classes' => $this->ownClassOptions(),
            'title'   => 'Class Stream',
            'crumbs'  => ['Faculty Workspace' => url('analytics/faculty'), 'Class Stream' => ''],
        ]);
    }

    public function joinRequests(): void
    {
        $rows = Database::fetchAll(
            "SELECT j.*, s.student_number, s.first_name, s.last_name, p.code AS program_code,
                    c.id AS class_id, c.subject_code, c.section_name, c.subject_id, c.semester_id
             FROM `ana_class_join_requests` j
             JOIN `ana_classes` c ON c.id = j.class_id AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
             JOIN `students` s ON s.id = j.student_id
             LEFT JOIN `programs` p ON p.id = s.program_id
             ORDER BY j.status = 'pending' DESC, j.created_at DESC
             LIMIT 100",
            ['fid' => (int) Auth::id()]
        );
        foreach ($rows as &$r) {
            $r['officially_enrolled'] = Classroom::isOfficiallyEnrolled((int) $r['student_id'], ['subject_id' => $r['subject_id'], 'semester_id' => $r['semester_id']]);
        }
        unset($r);
        View::render('analytics/Views/faculty/join_requests', [
            'rows'   => $rows,
            'title'  => 'Join Requests',
            'crumbs' => ['Faculty Workspace' => url('analytics/faculty'), 'Join Requests' => ''],
        ]);
    }

    private function ownClassOptions(): array
    {
        return Database::fetchAll(
            "SELECT c.id, c.subject_code, c.subject_title, c.section_name, c.semester_id
             FROM `ana_classes` c WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL ORDER BY c.semester_id DESC, c.subject_code",
            ['fid' => (int) Auth::id()]
        );
    }

    // ------------------------------------------------------------------
    // Grades Tracking (Academic Monitoring) editing for the owning faculty
    // ------------------------------------------------------------------

    private function matrixReply(array $class, string $message, int $code = 200, string $status = 'success'): void
    {
        json_response(['status' => $status, 'message' => $message, 'class' => ClassRecord::matrixPayload(ClassRecord::details((int) $class['id']))], $code);
    }

    /**
     * JSON actions from the Grades Tracking matrix. Rosters only accept students the
     * Registrar enrolled in this subject; pull-section is limited to the class section.
     */
    public function matrixAction(string $id): void
    {
        $class = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $class['id'];
        $in = json_decode((string) file_get_contents('php://input'), true);
        $action = is_array($in) ? (string) ($in['action'] ?? '') : '';

        if ($class['grade_status'] !== 'draft') {
            $this->matrixReply($class, 'This class record is posted or locked. File a correction request to change it.', 403, 'error');
        }

        $candidates = Classroom::enrolledCandidates($class);
        $byNumber = [];
        foreach ($candidates as $c) {
            $byNumber[$c['student_number']] = $c;
        }
        $rosterIds = [];
        foreach (ClassRecord::roster($classId) as $r) {
            $rosterIds[$r['student_number']] = (int) $r['student_id'];
        }

        switch ($action) {
            case 'pull_section':
                $added = 0;
                foreach ($candidates as $c) {
                    if ((int) $c['same_section'] === 1) {
                        Classroom::addToRoster($classId, (int) $c['student_id']);
                        $added++;
                    }
                }
                ChangeLog::record('class', $classId, 'roster_pull_section', null, null, (string) $added, 'Pulled registrar-enrolled section students');
                $this->matrixReply($class, $added > 0
                    ? "Added {$added} officially enrolled student(s) from {$class['section_name']}."
                    : "No other student in {$class['section_name']} is officially enrolled in {$class['subject_code']} for this term.");

            case 'add':
            case 'csv':
                $numbers = $action === 'add' ? [trim((string) ($in['student_number'] ?? ''))] : array_map('trim', (array) ($in['student_numbers'] ?? []));
                $numbers = array_values(array_unique(array_filter($numbers)));
                $added = [];
                $skipped = [];
                foreach (array_slice($numbers, 0, 500) as $num) {
                    if (isset($byNumber[$num])) {
                        Classroom::addToRoster($classId, (int) $byNumber[$num]['student_id']);
                        $added[] = $num;
                    } elseif (!isset($rosterIds[$num])) {
                        $skipped[] = $num;
                    }
                }
                if ($added) {
                    ChangeLog::record('class', $classId, 'roster_add', 'student_number', null, implode(',', $added), 'Added registrar-enrolled students from Grades Tracking');
                }
                $msg = count($added) . ' student(s) added.';
                if ($skipped) {
                    $msg .= ' Not added (not officially enrolled in ' . $class['subject_code'] . ' this term, or not found): ' . implode(', ', array_slice($skipped, 0, 20)) . (count($skipped) > 20 ? '…' : '');
                }
                $this->matrixReply($class, $msg, 200, $skipped && !$added ? 'error' : 'success');

            case 'remove':
                $num = (string) ($in['student_number'] ?? '');
                if (!isset($rosterIds[$num])) {
                    $this->matrixReply($class, 'That student is not on this roster.', 404, 'error');
                }
                $sid = $rosterIds[$num];
                $hasScores = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_class_scores` WHERE class_id = :cid AND student_id = :sid", ['cid' => $classId, 'sid' => $sid]) > 0;
                if ($hasScores) {
                    Database::update('ana_class_students', ['status' => 'dropped', 'drop_reason' => 'Removed in Grades Tracking', 'updated_at' => date('Y-m-d H:i:s')],
                        'class_id = :cid AND student_id = :sid', ['cid' => $classId, 'sid' => $sid]);
                } else {
                    Database::delete('ana_class_students', 'class_id = :cid AND student_id = :sid', ['cid' => $classId, 'sid' => $sid]);
                }
                ChangeLog::record('class_roster', $classId, 'drop_student', 'student_id', (string) $sid, $hasScores ? 'dropped' : 'removed', 'Removed in Grades Tracking');
                $this->matrixReply($class, $hasScores ? 'Student marked as dropped (recorded scores are kept).' : 'Student removed from the roster.');

            case 'scores':
                $items = GradeCalculator::items(ClassRecord::scheme($class));
                $errors = [];
                foreach ((array) ($in['scores'] ?? []) as $sc) {
                    $num = (string) ($sc['student_number'] ?? '');
                    $code = (string) ($sc['item_code'] ?? '');
                    if (!isset($rosterIds[$num], $items[$code])) {
                        continue;
                    }
                    $raw = $sc['score'] ?? null;
                    $score = ($raw === null || $raw === '') ? null : (is_numeric($raw) ? (float) $raw : false);
                    if ($score === false || ($score !== null && ($score < 0 || $score > $items[$code]['maxScore']))) {
                        $errors[] = "{$code}: score must be between 0 and {$items[$code]['maxScore']}";
                        continue;
                    }
                    Database::query(
                        "INSERT INTO `ana_class_scores` (`class_id`, `student_id`, `item_code`, `score`, `submission_status`, `updated_by`, `created_at`, `updated_at`)
                         VALUES (:cid, :sid, :code, :score, 'submitted', :uid, NOW(), NOW())
                         ON DUPLICATE KEY UPDATE `score` = VALUES(`score`), `updated_by` = VALUES(`updated_by`), `updated_at` = NOW()",
                        ['cid' => $classId, 'sid' => $rosterIds[$num], 'code' => $code, 'score' => $score, 'uid' => (int) Auth::id()]
                    );
                }
                $this->matrixReply($class, $errors ? implode('; ', $errors) : 'Scores saved.', 200, $errors ? 'error' : 'success');

            case 'attendance':
                $num = (string) ($in['student_number'] ?? '');
                $date = (string) ($in['date'] ?? '');
                $status = ['A' => 'Absent', 'E' => 'Excused', 'L' => 'Late'][$in['status'] ?? ''] ?? 'Present';
                $known = ClassRecord::attendance($classId)['dates'];
                if (!isset($rosterIds[$num]) || !in_array($date, $known, true)) {
                    $this->matrixReply($class, 'Attendance can only be changed for recorded sessions of students on this roster.', 422, 'error');
                }
                $row = Database::fetchOne(
                    "SELECT id FROM `ana_attendance_records` WHERE class_id = :cid AND student_id = :sid AND session_date = :d AND voided_at IS NULL LIMIT 1",
                    ['cid' => $classId, 'sid' => $rosterIds[$num], 'd' => $date]
                );
                if ($row) {
                    Database::update('ana_attendance_records', ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $row['id']]);
                } else {
                    Database::insert('ana_attendance_records', [
                        'class_id' => $classId, 'student_id' => $rosterIds[$num], 'subject_code' => $class['subject_code'], 'session_date' => $date,
                        'status' => $status, 'recorded_by' => (int) Auth::id(), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                $this->matrixReply($class, "Attendance on {$date} set to {$status}.");

            case 'add_session':
            case 'remove_session':
                $date = (string) ($in['date'] ?? '');
                $parsed = \DateTime::createFromFormat('!Y-m-d', $date);
                if (!$parsed || $parsed->format('Y-m-d') !== $date) {
                    $this->matrixReply($class, 'Choose a valid date.', 422, 'error');
                }
                $label = ClassRecord::dateLabel($date);
                $known = ClassRecord::attendance($classId)['dates'];
                if ($action === 'remove_session') {
                    if (!in_array($date, $known, true)) {
                        $this->matrixReply($class, "There is no attendance on {$label}.", 404, 'error');
                    }
                    $voided = Database::query(
                        "UPDATE `ana_attendance_records` SET `voided_at` = NOW(), `voided_by` = :uid, `void_reason` = 'Session removed by faculty', `updated_at` = NOW()
                         WHERE class_id = :cid AND session_date = :d AND voided_at IS NULL",
                        ['uid' => (int) Auth::id(), 'cid' => $classId, 'd' => $date]
                    )->rowCount();
                    ChangeLog::record('class', $classId, 'remove_attendance_session', 'session_date', $date, null, "Voided {$voided} attendance mark(s)");
                    $this->matrixReply($class, "Attendance date {$label} removed. The attendance share now uses the remaining dates.");
                }
                if ($date > date('Y-m-d')) {
                    $this->matrixReply($class, 'Attendance cannot be recorded for a future date.', 422, 'error');
                }
                if (in_array($date, $known, true)) {
                    $this->matrixReply($class, "{$label} is already one of the attendance dates.", 422, 'error');
                }
                if (!array_filter(ClassRecord::scheme($class)['groups'], fn($g) => $g['hasAttendance'])) {
                    $this->matrixReply($class, 'Turn on "Attendance" for a component in Customize Scheme first.', 422, 'error');
                }
                if (!$rosterIds) {
                    $this->matrixReply($class, 'Add students to the roster before recording attendance.', 422, 'error');
                }
                $status = ($in['status'] ?? 'P') === 'A' ? 'Absent' : 'Present';
                $now = date('Y-m-d H:i:s');
                foreach ($rosterIds as $sid) {
                    Database::insert('ana_attendance_records', [
                        'class_id' => $classId, 'student_id' => $sid, 'subject_code' => $class['subject_code'], 'session_date' => $date,
                        'status' => $status, 'recorded_by' => (int) Auth::id(), 'created_at' => $now, 'updated_at' => $now,
                    ]);
                }
                ChangeLog::record('class', $classId, 'add_attendance_session', 'session_date', null, $date, count($rosterIds) . " student(s) marked {$status}");
                $this->matrixReply($class, "Attendance date {$label} added with everyone marked {$status}. Click a mark to change it.");

            case 'add_item':
            case 'edit_item':
            case 'remove_item':
                $scheme = ClassRecord::scheme($class);
                $gi = null;
                foreach ($scheme['groups'] as $i => $g) {
                    if ($g['id'] === (string) ($in['group_id'] ?? '')) {
                        $gi = $i;
                        break;
                    }
                }
                if ($gi === null) {
                    $this->matrixReply($class, 'That grading component no longer exists. Reload the page.', 404, 'error');
                }
                $group = $scheme['groups'][$gi];
                if ($group['isExam']) {
                    $this->matrixReply($class, "The columns of {$group['title']} (Midterm and Finals) are fixed.", 422, 'error');
                }
                $title = mb_substr(trim((string) ($in['title'] ?? '')), 0, 100);
                $max = $in['max_score'] ?? null;
                if ($action !== 'remove_item' && (!is_numeric($max) || (float) $max <= 0 || (float) $max > 1000)) {
                    $this->matrixReply($class, 'Max score must be more than 0 and at most 1000.', 422, 'error');
                }

                if ($action === 'add_item') {
                    $used = ClassRecord::usedItemCodes($classId, $scheme);
                    $code = trim((string) ($in['code'] ?? '')) ?: ClassRecord::nextItemCode($group, $used);
                    if (!preg_match('/^[A-Za-z0-9_\-]{1,32}$/', $code)) {
                        $this->matrixReply($class, 'A column code may only use letters, numbers, - and _ (up to 32 characters).', 422, 'error');
                    }
                    if (in_array(strtoupper($code), $used, true)) {
                        $this->matrixReply($class, "The code {$code} is already used in this class record. Choose another code.", 422, 'error');
                    }
                    $scheme['groups'][$gi]['items'][] = ['code' => $code, 'title' => $title !== '' ? $title : $code, 'maxScore' => (float) $max, 'dueDate' => null];
                    $this->saveMatrixScheme($classId, $scheme);
                    ChangeLog::record('class', $classId, 'add_scheme_item', $code, null, (string) (float) $max, "Column added to {$group['title']}");
                    $this->matrixReply($class, "Column {$code} added to {$group['title']}.");
                }

                $code = (string) ($in['code'] ?? '');
                $ii = null;
                foreach ($group['items'] as $i => $it) {
                    if ($it['code'] === $code) {
                        $ii = $i;
                        break;
                    }
                }
                if ($ii === null) {
                    $this->matrixReply($class, "Column {$code} is not part of {$group['title']}.", 404, 'error');
                }

                if ($action === 'edit_item') {
                    $highest = Database::fetchColumn("SELECT MAX(score) FROM `ana_class_scores` WHERE class_id = :cid AND item_code = :code", ['cid' => $classId, 'code' => $code]);
                    if ($highest !== null && $highest !== false && (float) $highest > (float) $max) {
                        $this->matrixReply($class, "A student already has " . (float) $highest . " in {$code}, so its max score cannot be lower than that.", 422, 'error');
                    }
                    $oldMax = $group['items'][$ii]['maxScore'];
                    $scheme['groups'][$gi]['items'][$ii]['title'] = $title !== '' ? $title : $code;
                    $scheme['groups'][$gi]['items'][$ii]['maxScore'] = (float) $max;
                    $this->saveMatrixScheme($classId, $scheme);
                    ChangeLog::record('class', $classId, 'edit_scheme_item', $code, (string) $oldMax, (string) (float) $max, "Column edited in {$group['title']}");
                    $this->matrixReply($class, "Column {$code} updated.");
                }

                if (count($group['items']) === 1 && !$group['hasAttendance']) {
                    $this->matrixReply($class, "{$group['title']} needs at least one column. Remove the whole component in Customize Scheme instead.", 422, 'error');
                }
                $deleted = Database::delete('ana_class_scores', 'class_id = :cid AND item_code = :code', ['cid' => $classId, 'code' => $code]);
                array_splice($scheme['groups'][$gi]['items'], $ii, 1);
                $this->saveMatrixScheme($classId, $scheme);
                ChangeLog::record('class', $classId, 'remove_scheme_item', $code, (string) $group['items'][$ii]['maxScore'], null, "Column removed from {$group['title']}; {$deleted} score(s) deleted");
                $this->matrixReply($class, "Column {$code} removed from {$group['title']}.");

            case 'scheme':
                $current = ClassRecord::scheme($class);
                $scheme = GradeCalculator::normalizeScheme(is_array($in['scheme'] ?? null) ? $in['scheme'] : [], $current['passingCutoff']);
                if (!$scheme['groups']) {
                    $this->matrixReply($class, 'Add at least one assessment component.', 422, 'error');
                }
                if (!AnalyticsSettings::get('grading.allow_faculty_custom_weights')) {
                    $this->matrixReply($class, 'Customizing assessment weights per class is disabled by university policy.', 403, 'error');
                }
                $total = array_sum(array_column($scheme['groups'], 'weight'));
                if (abs($total - 100.0) > 0.01) {
                    $this->matrixReply($class, "Component weights must total 100%. Current total: {$total}%.", 422, 'error');
                }
                $attGroups = array_filter($scheme['groups'], fn($g) => $g['hasAttendance']);
                if (count($attGroups) > 1) {
                    $this->matrixReply($class, 'Attendance can count toward one component only.', 422, 'error');
                }
                if (array_filter($attGroups, fn($g) => $g['isExam'])) {
                    $this->matrixReply($class, 'Attendance cannot count toward an exam component.', 422, 'error');
                }
                $codes = [];
                foreach ($scheme['groups'] as $g) {
                    foreach ($g['items'] as $it) {
                        $key = strtoupper($it['code']);
                        if (!preg_match('/^[A-Za-z0-9_\-]{1,32}$/', $it['code']) || isset($codes[$key])) {
                            $this->matrixReply($class, "Task code '{$it['code']}' is invalid or used twice.", 422, 'error');
                        }
                        $codes[$key] = true;
                    }
                }
                $cutoff = isset($in['passing_cutoff']) && is_numeric($in['passing_cutoff']) ? max(1.0, min(5.0, (float) $in['passing_cutoff'])) : $current['passingCutoff'];
                $scheme['name'] = $current['name'];
                $scheme['passingCutoff'] = $cutoff;
                Database::update('ana_classes', ['grading_scheme' => json_encode($scheme, JSON_UNESCAPED_UNICODE), 'passing_cutoff' => $cutoff, 'updated_at' => date('Y-m-d H:i:s')],
                    'id = :id', ['id' => $classId]);
                ChangeLog::record('class', $classId, 'update_scheme', 'grading_scheme', null, null, 'Scheme updated in Grades Tracking');
                $this->matrixReply($class, 'Grading scheme saved.');

            default:
                $this->matrixReply($class, 'Unknown action.', 400, 'error');
        }
    }

    private function saveMatrixScheme(int $classId, array $scheme): void
    {
        Database::update('ana_classes', ['grading_scheme' => json_encode($scheme, JSON_UNESCAPED_UNICODE), 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id', ['id' => $classId]);
    }

    /**
     * Create Class modal of Grades Tracking: the subject is looked up by code and the
     * class is created in the active term for the signed-in faculty.
     */
    public function matrixCreateClass(): void
    {
        $in = json_decode((string) file_get_contents('php://input'), true) ?: [];
        $subject = Database::fetchOne("SELECT id FROM `subjects` WHERE code = :c AND deleted_at IS NULL", ['c' => strtoupper(trim((string) ($in['subject_code'] ?? '')))]);
        if (!$subject) {
            json_response(['status' => 'error', 'message' => 'No subject with that course code exists in the curriculum.'], 422);
        }
        $result = Classroom::create([
            'subject_id'  => (int) $subject['id'],
            'section_id'  => (int) ($in['section_id'] ?? 0),
            'template_id' => (int) ($in['template_id'] ?? 0),
        ], (int) Auth::id());
        if (isset($result['error'])) {
            json_response(['status' => 'error', 'message' => $result['error']], 422);
        }
        json_response(['status' => 'success', 'message' => "Class created with code {$result['code']}.", 'class' => ClassRecord::matrixPayload(ClassRecord::details($result['id']))]);
    }
}
