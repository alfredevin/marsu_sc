<?php
namespace Modules\Retention\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;
use Modules\Retention\Support\RetentionAccess;
use Modules\Retention\Support\RetentionSettings;
use Modules\Retention\Support\GradeCalculator;
use Modules\Retention\Support\ChangeLog;

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
        $facultyId = RetentionAccess::facultyUserId();
        if (!$facultyId) {
            Session::flash('error', 'Faculty credentials required to access this workspace.');
            redirect(url('retention'));
            return;
        }

        // Summary counts
        $totalClasses = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ret_classes` WHERE `faculty_user_id` = :fid AND `deleted_at` IS NULL",
            ['fid' => $facultyId]
        );

        $enrolledStudentsCount = (int) Database::fetchColumn(
            "SELECT COUNT(DISTINCT cs.student_id) 
             FROM `ret_class_students` cs 
             JOIN `ret_classes` c ON cs.class_id = c.id 
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND cs.status = 'enrolled'",
            ['fid' => $facultyId]
        );

        $pendingClasses = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ret_classes` WHERE `faculty_user_id` = :fid AND `grade_status` = 'draft' AND `deleted_at` IS NULL",
            ['fid' => $facultyId]
        );

        $postedClasses = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ret_classes` WHERE `faculty_user_id` = :fid AND `grade_status` IN ('posted', 'locked') AND `deleted_at` IS NULL",
            ['fid' => $facultyId]
        );

        $pendingIncCount = (int) Database::fetchColumn(
            "SELECT COUNT(*) 
             FROM `ret_class_grades` g 
             JOIN `ret_classes` c ON g.class_id = c.id 
             WHERE c.faculty_user_id = :fid 
               AND (g.final_grade = 'INC' OR g.remarks = 'INC') 
               AND g.inc_resolved_at IS NULL 
               AND c.deleted_at IS NULL",
            ['fid' => $facultyId]
        );

        $pendingCorrectionRequests = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ret_grade_change_requests` WHERE `requested_by` = :fid AND `status` = 'pending'",
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
                    (SELECT COUNT(*) FROM `ret_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS student_count
             FROM `ret_classes` c
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
             FROM `ret_attendance_records` a
             JOIN `ret_classes` c ON a.class_id = c.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `students` st ON a.student_id = st.student_number
             WHERE a.logged_by = :fid AND a.deleted_at IS NULL
             ORDER BY a.session_date DESC, a.id DESC
             LIMIT 5",
            ['fid' => $facultyId]
        );

        // Pending INC records for quick resolution
        $pendingIncs = Database::fetchAll(
            "SELECT g.*, st.student_number, st.first_name, st.last_name,
                    c.subject_code, c.section_name
             FROM `ret_class_grades` g
             JOIN `ret_classes` c ON g.class_id = c.id
             JOIN `students` st ON g.student_id = st.id
             WHERE c.faculty_user_id = :fid 
               AND (g.final_grade = 'INC' OR g.remarks = 'INC')
               AND g.inc_resolved_at IS NULL
               AND c.deleted_at IS NULL
             ORDER BY g.inc_deadline ASC, g.id ASC
             LIMIT 5",
            ['fid' => $facultyId]
        );

        View::render('retention/Views/faculty/dashboard', [
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
            'crumbs'                    => ['Faculty Workspace' => url('retention/faculty'), 'Dashboard' => ''],
        ]);
    }

    /**
     * List all classes assigned to this faculty member
     */
    public function classes(): void
    {
        $facultyId = RetentionAccess::facultyUserId();
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
                        (SELECT COUNT(*) FROM `ret_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS student_count
                 FROM `ret_classes` c
                 LEFT JOIN `subjects` s ON c.subject_id = s.id
                 LEFT JOIN `sections` sec ON c.section_id = sec.id
                 LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
                 LEFT JOIN `semesters` sem ON c.semester_id = sem.id
                 WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
                 ORDER BY c.id DESC",
                ['fid' => $facultyId]
            );
        }

        View::render('retention/Views/faculty/classes', [
            'classes' => $classes,
            'title'   => 'My Teaching Classes & Subject Sections - MarSU ERP',
            'crumbs'  => ['Faculty Workspace' => url('retention/faculty'), 'My Classes' => ''],
        ]);
    }

    /**
     * Class Record Matrix (Interactive Matrix, Roster, Score Persistence, Grade Posting)
     */
    public function classRecord(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

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
             FROM `ret_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
             LEFT JOIN `semesters` sem ON c.semester_id = sem.id
             WHERE c.id = :id AND c.deleted_at IS NULL LIMIT 1",
            ['id' => $classId]
        );

        if (!$classDetails) {
            Session::flash('error', 'Class offering could not be loaded.');
            redirect(url('retention/faculty/classes'));
            return;
        }

        // Parse grading scheme JSON
        $scheme = json_decode($classDetails['grading_scheme'] ?? '', true);
        if (!$scheme || !isset($scheme['groups'])) {
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
             FROM `ret_class_students` cs
             JOIN `students` st ON cs.student_id = st.id
             LEFT JOIN `programs` p ON st.program_id = p.id
             WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND st.deleted_at IS NULL
             ORDER BY st.last_name ASC, st.first_name ASC",
            ['cid' => $classId]
        );

        // Fetch recorded scores
        $rawScores = Database::fetchAll(
            "SELECT student_id, item_code, score, submission_status 
             FROM `ret_class_scores` 
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
             FROM `ret_attendance_records` 
             WHERE class_id = :cid AND deleted_at IS NULL 
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
            $attendanceMap[$sid] = $attendanceByStudentNum[$snum] ?? [
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
            "SELECT * FROM `ret_class_grades` WHERE class_id = :cid",
            ['cid' => $classId]
        );
        $postedGradesMap = [];
        foreach ($postedGrades as $pg) {
            $postedGradesMap[(int) $pg['student_id']] = $pg;
        }

        // Fetch pending correction request if any
        $pendingCorrection = Database::fetchOne(
            "SELECT * FROM `ret_grade_change_requests` WHERE class_id = :cid AND status = 'pending' ORDER BY id DESC LIMIT 1",
            ['cid' => $classId]
        );

        $correctionHistory = Database::fetchAll(
            "SELECT * FROM `ret_grade_change_requests` WHERE class_id = :cid ORDER BY id DESC LIMIT 5",
            ['cid' => $classId]
        );

        // Check if custom weights are permitted by university policy
        $allowCustomWeights = (bool) RetentionSettings::get('grading.allow_faculty_custom_weights', 1);

        View::render('retention/Views/faculty/class_record', [
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
                'Faculty Workspace' => url('retention/faculty'),
                'My Classes'        => url('retention/faculty/classes'),
                'Class Record'      => ''
            ],
        ]);
    }

    /**
     * AJAX endpoint: Debounced score autosave
     */
    public function saveScores(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked' || $class['grade_status'] === 'posted') {
            json_response([
                'status'  => 'error',
                'message' => 'Class is currently posted or locked. Please submit a grade correction request if modifications are required.'
            ], 403);
            return;
        }

        $rawInput = file_get_contents('php://input');
        $payload = json_decode($rawInput, true);

        $scores = $payload['scores'] ?? $_POST['scores'] ?? [];
        if (is_string($scores)) {
            $scores = json_decode($scores, true) ?: [];
        }

        if (!is_array($scores)) {
            json_response(['status' => 'error', 'message' => 'Invalid scores payload.'], 400);
            return;
        }

        // Get list of valid enrolled student IDs for this class
        $enrolledRows = Database::fetchAll(
            "SELECT student_id FROM `ret_class_students` WHERE class_id = :cid AND status = 'enrolled'",
            ['cid' => $classId]
        );
        $enrolledIds = array_map(fn($r) => (int) $r['student_id'], $enrolledRows);

        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            INSERT INTO `ret_class_scores` (`class_id`, `student_id`, `item_code`, `score`, `submission_status`, `updated_by`, `created_at`, `updated_at`)
            VALUES (:cid, :sid, :code, :score, :st, :uid, NOW(), NOW())
            ON DUPLICATE KEY UPDATE 
                `score` = VALUES(`score`),
                `submission_status` = VALUES(`submission_status`),
                `updated_by` = VALUES(`updated_by`),
                `updated_at` = NOW()
        ");

        $uid = (int) Auth::id();
        $savedCount = 0;
        foreach ($scores as $item) {
            $sid = (int) ($item['student_id'] ?? 0);
            $code = trim($item['item_code'] ?? '');
            $score = isset($item['score']) ? (float) $item['score'] : 0.0;
            $rawStatus = $item['submission_status'] ?? 'submitted';
            $st = in_array($rawStatus, ['submitted', 'late', 'missing', 'excused'], true)
                ? $rawStatus
                : 'submitted';

            if (in_array($sid, $enrolledIds, true) && $code !== '') {
                $stmt->execute([
                    'cid'   => $classId,
                    'sid'   => $sid,
                    'code'  => $code,
                    'score' => max(0.0, $score),
                    'st'    => $st,
                    'uid'   => $uid,
                ]);
                $savedCount++;
            }
        }

        json_response([
            'status'      => 'success',
            'message'     => 'Scores saved to class record.',
            'saved_count' => $savedCount
        ], 200);
    }

    /**
     * Roster Intake: Pull students from section masterlist
     */
    public function pullSection(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot modify roster of a locked class.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $sectionId = (int) $class['section_id'];
        $students = Database::fetchAll(
            "SELECT id FROM `students` WHERE section_id = :sec_id AND deleted_at IS NULL",
            ['sec_id' => $sectionId]
        );

        if (empty($students)) {
            Session::flash('warning', 'No registered students found in central records under this section.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            INSERT INTO `ret_class_students` (`class_id`, `student_id`, `status`, `created_at`, `updated_at`)
            VALUES (:cid, :sid, 'enrolled', NOW(), NOW())
            ON DUPLICATE KEY UPDATE `status` = 'enrolled', `updated_at` = NOW()
        ");

        $added = 0;
        foreach ($students as $s) {
            $stmt->execute(['cid' => $classId, 'sid' => (int) $s['id']]);
            $added++;
        }

        Session::flash('success', "Roster updated: Synchronized {$added} students from section masterlist.");
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Quick Add student to roster
     */
    public function addStudent(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot modify roster of a locked class.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $search = trim($_POST['student_search'] ?? '');
        if ($search === '') {
            Session::flash('error', 'Please enter a student number or name.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $student = Database::fetchOne(
            "SELECT id, student_number, first_name, last_name 
             FROM `students` 
             WHERE (`student_number` = :sn OR CONCAT(first_name, ' ', last_name) LIKE :nm) 
               AND `deleted_at` IS NULL 
             LIMIT 1",
            ['sn' => $search, 'nm' => '%' . $search . '%']
        );

        if (!$student) {
            Session::flash('error', "No student record found matching '{$search}'.");
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $sid = (int) $student['id'];
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            INSERT INTO `ret_class_students` (`class_id`, `student_id`, `status`, `created_at`, `updated_at`)
            VALUES (:cid, :sid, 'enrolled', NOW(), NOW())
            ON DUPLICATE KEY UPDATE `status` = 'enrolled', `updated_at` = NOW()
        ");
        $stmt->execute(['cid' => $classId, 'sid' => $sid]);

        Session::flash('success', "Student {$student['first_name']} {$student['last_name']} ({$student['student_number']}) added to class roster.");
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Remove or drop student from roster
     */
    public function removeStudent(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot modify roster of a locked class.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $studentId = (int) ($_POST['student_id'] ?? 0);
        if ($studentId <= 0) {
            Session::flash('error', 'Invalid student identifier.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        // Check if student has recorded scores
        $scoreCount = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ret_class_scores` WHERE class_id = :cid AND student_id = :sid",
            ['cid' => $classId, 'sid' => $studentId]
        );

        if ($scoreCount > 0) {
            // Soft drop on roster
            Database::update(
                'ret_class_students',
                ['status' => 'dropped', 'updated_at' => date('Y-m-d H:i:s')],
                '`class_id` = :cid AND `student_id` = :sid',
                ['cid' => $classId, 'sid' => $studentId]
            );
            Session::flash('info', 'Student has recorded scores and has been marked as Dropped on the roster.');
        } else {
            // Delete clean un-scored roster entry
            Database::delete(
                'ret_class_students',
                '`class_id` = :cid AND `student_id` = :sid',
                ['cid' => $classId, 'sid' => $studentId]
            );
            Session::flash('success', 'Student removed from class roster.');
        }

        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Save customized grading scheme for this class
     */
    public function saveScheme(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] !== 'draft') {
            Session::flash('error', 'Grading scheme cannot be altered after grades have been posted or locked.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        if (!RetentionSettings::get('grading.allow_faculty_custom_weights', 1)) {
            Session::flash('error', 'Customizing assessment weights per class is disabled by university policy.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $schemeJson = $_POST['scheme_json'] ?? '';
        $schemeData = json_decode($schemeJson, true);

        if (!$schemeData || !isset($schemeData['groups']) || !is_array($schemeData['groups'])) {
            Session::flash('error', 'Invalid grading scheme structure.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        // Validate weights sum to 100
        $totalWeight = 0;
        foreach ($schemeData['groups'] as $grp) {
            $totalWeight += (float) ($grp['weight'] ?? 0);
        }

        if (abs($totalWeight - 100.0) > 0.01) {
            Session::flash('error', "Component weights must total exactly 100%. Current total: {$totalWeight}%.");
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $passingCutoff = isset($_POST['passing_cutoff']) ? (float) $_POST['passing_cutoff'] : (float) ($schemeData['passingCutoff'] ?? 3.04);
        $passingCutoff = max(1.00, min(5.00, $passingCutoff));
        $schemeData['passingCutoff'] = $passingCutoff;

        Database::update(
            'ret_classes',
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
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Compute and officially post final class grades
     */
    public function postGrades(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'This class is term-closed and locked by administration.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        // Parse grading scheme
        $scheme = json_decode($class['grading_scheme'] ?? '', true);
        if (!$scheme || !isset($scheme['groups'])) {
            Session::flash('error', 'Grading scheme is not configured for this class.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        // Load enrolled students
        $students = Database::fetchAll(
            "SELECT cs.student_id, st.student_number 
             FROM `ret_class_students` cs 
             JOIN `students` st ON cs.student_id = st.id 
             WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND st.deleted_at IS NULL",
            ['cid' => $classId]
        );

        if (empty($students)) {
            Session::flash('error', 'No enrolled students on class roster to post grades for.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        // Load raw scores
        $rawScores = Database::fetchAll(
            "SELECT student_id, item_code, score FROM `ret_class_scores` WHERE class_id = :cid",
            ['cid' => $classId]
        );
        $scoresByStudent = [];
        foreach ($students as $std) {
            $scoresByStudent[(int) $std['student_id']] = [];
        }
        foreach ($rawScores as $rs) {
            $scoresByStudent[(int) $rs['student_id']][$rs['item_code']] = (float) $rs['score'];
        }

        // Load attendance summary
        $attendanceRows = Database::fetchAll(
            "SELECT student_id, status FROM `ret_attendance_records` WHERE class_id = :cid AND deleted_at IS NULL",
            ['cid' => $classId]
        );
        $attByStudentNum = [];
        foreach ($attendanceRows as $ar) {
            $snum = $ar['student_id'];
            if (!isset($attByStudentNum[$snum])) {
                $attByStudentNum[$snum] = ['present' => 0, 'late' => 0, 'excused' => 0, 'total' => 0];
            }
            $attByStudentNum[$snum]['total']++;
            $st = $ar['status'];
            if ($st === 'Present') {
                $attByStudentNum[$snum]['present']++;
            } elseif ($st === 'Late') {
                $attByStudentNum[$snum]['late']++;
            } elseif ($st === 'Excused') {
                $attByStudentNum[$snum]['excused']++;
            }
        }

        $attByStudentId = [];
        foreach ($students as $std) {
            $attByStudentId[(int) $std['student_id']] = $attByStudentNum[$std['student_number']] ?? [
                'present' => 0, 'late' => 0, 'excused' => 0, 'total' => 0
            ];
        }

        // Compute grades via GradeCalculator
        $computations = GradeCalculator::computeClassGrades($scheme, $scoresByStudent, $attByStudentId);

        // Check policy for INC removal deadline days
        $incRemovalDays = RetentionSettings::get('grading.inc_removal_days');
        $incDeadline = null;
        if ($incRemovalDays !== null && (int) $incRemovalDays > 0) {
            $incDeadline = date('Y-m-d', strtotime('+' . (int) $incRemovalDays . ' days'));
        }

        // Save into ret_class_grades
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            INSERT INTO `ret_class_grades` 
                (`class_id`, `student_id`, `computed_grade`, `final_grade`, `remarks`, `inc_deadline`, `posted_at`, `created_at`, `updated_at`)
            VALUES 
                (:cid, :sid, :computed, :final, :remarks, :deadline, NOW(), NOW(), NOW())
            ON DUPLICATE KEY UPDATE 
                `computed_grade` = VALUES(`computed_grade`),
                `final_grade`    = VALUES(`final_grade`),
                `remarks`        = VALUES(`remarks`),
                `inc_deadline`   = VALUES(`inc_deadline`),
                `posted_at`      = NOW(),
                `updated_at`     = NOW()
        ");

        $uid = (int) Auth::id();
        foreach ($computations as $studentId => $res) {
            $finalGrade = $res['final_grade'];
            $isPassed = ($res['remarks'] === 'PASSED' || $res['remarks'] === 'Passed');
            $remarksEnum = ($finalGrade === 'INC' || $res['remarks'] === 'INC' || $res['remarks'] === 'Incomplete')
                ? 'INC'
                : ($isPassed ? 'PASSED' : 'FAILED');
            $deadline = ($remarksEnum === 'INC') ? $incDeadline : null;

            $stmt->execute([
                'cid'      => $classId,
                'sid'      => $studentId,
                'computed' => $res['computed_grade'],
                'final'    => $finalGrade,
                'remarks'  => $remarksEnum,
                'deadline' => $deadline,
            ]);
        }

        // Update class status to posted
        Database::update(
            'ret_classes',
            [
                'grade_status' => 'posted',
                'posted_at'    => date('Y-m-d H:i:s'),
                'posted_by'    => $uid,
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            '`id` = :id',
            ['id' => $classId]
        );

        // Complete any pending/approved correction requests for this class
        Database::update(
            'ret_grade_change_requests',
            [
                'status'     => 'completed',
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            '`class_id` = :cid AND `status` IN (\'approved\', \'pending\')',
            ['cid' => $classId]
        );

        ChangeLog::record(
            'class',
            $classId,
            'post_grades',
            'grade_status',
            $class['grade_status'],
            'posted',
            'Faculty computed and posted final grades for class'
        );

        Session::flash('success', 'Final class grades have been computed and officially posted.');
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Resolve an Incomplete (INC) mark
     */
    public function resolveInc(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        $studentId = (int) ($_POST['student_id'] ?? 0);
        $resolvedGrade = (float) ($_POST['resolved_grade'] ?? 0);
        $rawRemarks = strtoupper(trim($_POST['remarks'] ?? 'PASSED'));
        $remarksEnum = in_array($rawRemarks, ['PASSED', 'FAILED'], true) ? $rawRemarks : 'PASSED';
        $notes = trim($_POST['notes'] ?? 'Requirement completed');

        if ($resolvedGrade < 1.00 || $resolvedGrade > 5.00) {
            Session::flash('error', 'Resolved grade must be between 1.00 and 5.00.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $existingGrade = Database::fetchOne(
            "SELECT * FROM `ret_class_grades` WHERE class_id = :cid AND student_id = :sid",
            ['cid' => $classId, 'sid' => $studentId]
        );

        if (!$existingGrade) {
            Session::flash('error', 'Student grade record not found.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        Database::update(
            'ret_class_grades',
            [
                'final_grade'     => number_format($resolvedGrade, 2, '.', ''),
                'computed_grade'  => $resolvedGrade,
                'remarks'         => $remarksEnum,
                'inc_resolved_at' => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            '`class_id` = :cid AND `student_id` = :sid',
            ['cid' => $classId, 'sid' => $studentId]
        );

        ChangeLog::record(
            'class_grade',
            $classId,
            'resolve_inc',
            'final_grade',
            $existingGrade['final_grade'],
            number_format($resolvedGrade, 2, '.', ''),
            $notes
        );

        Session::flash('success', "Incomplete requirement resolved with grade {$resolvedGrade} ({$remarksEnum}).");
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Log a task exception (submitted, late, missing, excused)
     */
    public function saveTaskException(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] === 'locked') {
            Session::flash('error', 'Cannot log task exceptions for locked classes.');
            redirect(url('retention/faculty/classes/' . $classId));
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
            INSERT INTO `ret_class_scores` (`class_id`, `student_id`, `item_code`, `score`, `submission_status`, `updated_by`, `created_at`, `updated_at`)
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
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Submit grade correction request to admin
     */
    public function requestCorrection(string $id): void
    {
        $classId = (int) $id;
        $class = RetentionAccess::findOwnClassOr404($classId);

        if ($class['grade_status'] !== 'posted') {
            Session::flash('error', 'Correction requests can only be filed for classes in Posted status.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        $reason = trim($_POST['reason'] ?? '');
        if (strlen($reason) < 10) {
            Session::flash('error', 'A comprehensive justification (at least 10 characters) is required.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        // Check if pending request already exists
        $pending = Database::fetchOne(
            "SELECT id FROM `ret_grade_change_requests` WHERE class_id = :cid AND status = 'pending'",
            ['cid' => $classId]
        );

        if ($pending) {
            Session::flash('warning', 'A correction request for this class is already pending administrative review.');
            redirect(url('retention/faculty/classes/' . $classId));
            return;
        }

        Database::insert('ret_grade_change_requests', [
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
        redirect(url('retention/faculty/classes/' . $classId));
    }

    /**
     * Roster-limited student directory
     */
    public function students(): void
    {
        $facultyId = RetentionAccess::facultyUserId();
        $studentIds = RetentionAccess::facultyStudentIds($facultyId);

        $students = [];
        if (!empty($studentIds)) {
            $inClause = implode(',', array_map('intval', $studentIds));
            $students = Database::fetchAll(
                "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, s.enrollment_status,
                        p.code AS program_code, p.name AS program_name,
                        sec.name AS section_name,
                        GROUP_CONCAT(DISTINCT CONCAT(COALESCE(c.subject_code, sub.code), ' (', COALESCE(c.section_name, sec2.name), ')') SEPARATOR ', ') AS enrolled_classes
                 FROM `students` s
                 JOIN `ret_class_students` cs ON s.id = cs.student_id AND cs.status = 'enrolled'
                 JOIN `ret_classes` c ON cs.class_id = c.id AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
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

        View::render('retention/Views/faculty/students', [
            'students' => $students,
            'title'    => 'My Enrolled Students Directory - MarSU ERP',
            'crumbs'   => ['Faculty Workspace' => url('retention/faculty'), 'My Students' => ''],
        ]);
    }

    /**
     * Roster-limited student academic profile view
     */
    public function studentView(string $id): void
    {
        $studentId = (int) $id;
        $facultyId = RetentionAccess::facultyUserId();

        if (!RetentionAccess::canSeeStudent($studentId)) {
            Session::flash('error', 'Record not found.');
            redirect(url('retention/faculty/students'));
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
            redirect(url('retention/faculty/students'));
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
             FROM `ret_class_students` cs
             JOIN `ret_classes` c ON cs.class_id = c.id
             LEFT JOIN `subjects` sub ON c.subject_id = sub.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             LEFT JOIN `ret_class_grades` g ON g.class_id = c.id AND g.student_id = cs.student_id
             WHERE cs.student_id = :sid AND c.faculty_user_id = :fid AND c.deleted_at IS NULL AND cs.status = 'enrolled'
             ORDER BY c.id DESC",
            ['sid' => $studentId, 'fid' => $facultyId]
        );

        // Load scores and task exceptions in this faculty's classes
        $scores = Database::fetchAll(
            "SELECT sc.*, COALESCE(c.subject_code, sub.code) AS subject_code, c.id AS class_id
             FROM `ret_class_scores` sc
             JOIN `ret_classes` c ON sc.class_id = c.id
             LEFT JOIN `subjects` sub ON c.subject_id = sub.id
             WHERE sc.student_id = :sid AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY subject_code ASC, sc.item_code ASC",
            ['sid' => $studentId, 'fid' => $facultyId]
        );

        // Load attendance logs in this faculty's classes
        $attendance = Database::fetchAll(
            "SELECT a.*, COALESCE(a.subject_code, c.subject_code) AS subject_code 
             FROM `ret_attendance_records` a
             JOIN `ret_classes` c ON a.class_id = c.id
             WHERE a.student_id = :snum AND c.faculty_user_id = :fid AND a.deleted_at IS NULL
             ORDER BY a.session_date DESC",
            ['snum' => $student['student_number'], 'fid' => $facultyId]
        );

        // Load conduct reports filed by this faculty member for this student
        $conductReports = Database::fetchAll(
            "SELECT * FROM `ret_behavior_records`
             WHERE student_id = :snum AND reported_by = :fid AND deleted_at IS NULL
             ORDER BY incident_date DESC",
            ['snum' => $student['student_number'], 'fid' => $facultyId]
        );

        View::render('retention/Views/faculty/student_view', [
            'student'        => $student,
            'classes'        => $classes,
            'scores'         => $scores,
            'attendance'     => $attendance,
            'conductReports' => $conductReports,
            'title'          => "Student Profile: {$student['first_name']} {$student['last_name']} ({$student['student_number']})",
            'crumbs'         => [
                'Faculty Workspace' => url('retention/faculty'),
                'My Students'        => url('retention/faculty/students'),
                'Academic View'     => ''
            ],
        ]);
    }

    /**
     * Faculty Roll-Call Attendance
     */
    public function attendance(): void
    {
        $facultyId = RetentionAccess::facultyUserId();
        if (!$facultyId) {
            Session::flash('error', 'Faculty credentials required.');
            redirect(url('retention'));
            return;
        }

        // List faculty classes for selection
        $classes = Database::fetchAll(
            "SELECT c.id, 
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.section_name, sec.name) AS section_name
             FROM `ret_classes` c
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

        if ($selectedClassId > 0 && RetentionAccess::ownsClass($selectedClassId)) {
            // Load enrolled roster
            $roster = Database::fetchAll(
                "SELECT cs.student_id, st.student_number, st.first_name, st.last_name, p.code AS program_code
                 FROM `ret_class_students` cs
                 JOIN `students` st ON cs.student_id = st.id
                 LEFT JOIN `programs` p ON st.program_id = p.id
                 WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND st.deleted_at IS NULL
                 ORDER BY st.last_name ASC, st.first_name ASC",
                ['cid' => $selectedClassId]
            );

            // Load existing attendance on this date
            $records = Database::fetchAll(
                "SELECT student_id, status, remarks 
                 FROM `ret_attendance_records` 
                 WHERE class_id = :cid AND session_date = :sdate AND deleted_at IS NULL",
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
                 FROM `ret_attendance_records`
                 WHERE class_id = :cid AND deleted_at IS NULL
                 GROUP BY session_date
                 ORDER BY session_date DESC
                 LIMIT 15",
                ['cid' => $selectedClassId]
            );
        }

        View::render('retention/Views/faculty/attendance', [
            'classes'            => $classes,
            'selectedClassId'    => $selectedClassId,
            'sessionDate'        => $sessionDate,
            'roster'             => $roster,
            'existingAttendance' => $existingAttendance,
            'sessionHistory'     => $sessionHistory,
            'title'              => 'Roll-Call Attendance - Faculty Workspace',
            'crumbs'             => ['Faculty Workspace' => url('retention/faculty'), 'Roll-Call' => ''],
        ]);
    }

    /**
     * Store roll-call attendance
     */
    public function storeAttendance(): void
    {
        $classId = (int) ($_POST['class_id'] ?? 0);
        $class = RetentionAccess::findOwnClassOr404($classId);

        $sessionDate = $_POST['session_date'] ?? date('Y-m-d');
        if ($sessionDate > date('Y-m-d')) {
            Session::flash('error', 'Cannot record attendance for future dates.');
            redirect(url('retention/faculty/attendance?class_id=' . $classId . '&date=' . $sessionDate));
            return;
        }

        $classInfo = Database::fetchOne(
            "SELECT c.*, COALESCE(c.subject_code, s.code) AS subject_code 
             FROM `ret_classes` c 
             LEFT JOIN `subjects` s ON c.subject_id = s.id 
             WHERE c.id = :cid",
            ['cid' => $classId]
        );

        // Load enrolled student numbers
        $roster = Database::fetchAll(
            "SELECT st.student_number, st.id 
             FROM `ret_class_students` cs 
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
            SELECT id FROM `ret_attendance_records` 
            WHERE class_id = :cid AND student_id = :snum AND session_date = :sdate AND deleted_at IS NULL LIMIT 1
        ");

        $insertStmt = $pdo->prepare("
            INSERT INTO `ret_attendance_records` 
                (`class_id`, `student_id`, `subject_id`, `subject_code`, `academic_year_id`, `semester_id`, `session_date`, `status`, `remarks`, `logged_by`, `created_at`, `updated_at`)
            VALUES 
                (:cid, :snum, :sub_id, :code, :ay_id, :sem_id, :sdate, :st, :rem, :uid, NOW(), NOW())
        ");

        $updateStmt = $pdo->prepare("
            UPDATE `ret_attendance_records` 
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

            $selectStmt->execute(['cid' => $classId, 'snum' => $snum, 'sdate' => $sessionDate]);
            $existing = $selectStmt->fetch();

            if ($existing) {
                $updateStmt->execute(['st' => $st, 'rem' => $rem, 'id' => $existing['id']]);
            } else {
                $insertStmt->execute([
                    'cid'    => $classId,
                    'snum'   => $snum,
                    'sub_id' => $classInfo['subject_id'],
                    'code'   => $classInfo['subject_code'],
                    'ay_id'  => $classInfo['academic_year_id'],
                    'sem_id' => $classInfo['semester_id'],
                    'sdate'  => $sessionDate,
                    'st'     => $st,
                    'rem'    => $rem,
                    'uid'    => $uid,
                ]);
            }
            $savedCount++;
        }

        // Check absence warning count policy
        $warningCount = (int) RetentionSettings::get('attendance.absence_warning_count', 4);
        foreach ($statuses as $snum => $st) {
            if ($st === 'Absent') {
                $totalAbsences = (int) Database::fetchColumn(
                    "SELECT COUNT(*) FROM `ret_attendance_records` 
                     WHERE class_id = :cid AND student_id = :snum AND status = 'Absent' AND deleted_at IS NULL",
                    ['cid' => $classId, 'snum' => $snum]
                );
                if ($totalAbsences >= $warningCount) {
                    // Check if warning already logged in ret_records
                    $existingWarning = Database::fetchOne(
                        "SELECT id FROM `ret_records` 
                         WHERE title = :title AND source = 'system' AND deleted_at IS NULL LIMIT 1",
                        ['title' => "Absence Warning: {$snum} in {$classInfo['subject_code']}"]
                    );
                    if (!$existingWarning) {
                        Database::insert('ret_records', [
                            'title'       => "Absence Warning: {$snum} in {$classInfo['subject_code']}",
                            'description' => "Student {$snum} has reached {$totalAbsences} unexcused absences in {$classInfo['subject_code']}.",
                            'status'      => 'pending',
                            'source'      => 'system',
                            'created_by'  => $uid,
                            'created_at'  => date('Y-m-d H:i:s'),
                            'updated_at'  => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }
        }

        Session::flash('success', "Roll-call attendance recorded for {$savedCount} students on {$sessionDate}.");
        redirect(url('retention/faculty/attendance?class_id=' . $classId . '&date=' . $sessionDate));
    }

    /**
     * Faculty Incident Reporting
     */
    public function conduct(): void
    {
        $facultyId = RetentionAccess::facultyUserId();
        if (!$facultyId) {
            Session::flash('error', 'Faculty credentials required.');
            redirect(url('retention'));
            return;
        }

        // List faculty classes for selection
        $classes = Database::fetchAll(
            "SELECT c.id, 
                    COALESCE(c.subject_code, s.code) AS subject_code,
                    COALESCE(c.subject_title, s.title) AS subject_title,
                    COALESCE(c.section_name, sec.name) AS section_name
             FROM `ret_classes` c
             LEFT JOIN `subjects` s ON c.subject_id = s.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY c.id DESC",
            ['fid' => $facultyId]
        );

        // List enrolled students across all assigned classes
        $studentIds = RetentionAccess::facultyStudentIds($facultyId);
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
            "SELECT b.*, st.first_name, st.last_name, 
                    COALESCE(c.subject_code, sub.code) AS subject_code,
                    COALESCE(c.section_name, sec.name) AS section_name
             FROM `ret_behavior_records` b
             JOIN `students` st ON b.student_id = st.student_number
             LEFT JOIN `ret_classes` c ON b.class_id = c.id
             LEFT JOIN `subjects` sub ON c.subject_id = sub.id
             LEFT JOIN `sections` sec ON c.section_id = sec.id
             WHERE b.reported_by = :fid AND b.deleted_at IS NULL
             ORDER BY b.incident_date DESC, b.id DESC",
            ['fid' => $facultyId]
        );

        View::render('retention/Views/faculty/conduct', [
            'classes'  => $classes,
            'students' => $students,
            'reports'  => $reports,
            'title'    => 'Student Conduct Incident Reports - Faculty Workspace',
            'crumbs'   => ['Faculty Workspace' => url('retention/faculty'), 'Conduct Reports' => ''],
        ]);
    }

    /**
     * Store conduct incident report
     */
    public function storeConduct(): void
    {
        $classId = (int) ($_POST['class_id'] ?? 0);
        $class = RetentionAccess::findOwnClassOr404($classId);

        $studentNumber = trim($_POST['student_number'] ?? '');
        $incidentType = trim($_POST['incident_type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $severity = $_POST['severity'] ?? 'Minor';
        $incidentDate = $_POST['incident_date'] ?? date('Y-m-d');

        if ($incidentDate > date('Y-m-d')) {
            Session::flash('error', 'Incident date cannot be in the future.');
            redirect(url('retention/faculty/conduct'));
            return;
        }

        if (!in_array($severity, ['Minor', 'Moderate', 'Severe'], true)) {
            $severity = 'Minor';
        }

        if ($studentNumber === '' || $incidentType === '' || strlen($description) < 10) {
            Session::flash('error', 'Please provide student, incident type, and a descriptive narrative (min 10 characters).');
            redirect(url('retention/faculty/conduct'));
            return;
        }

        // Verify student is on the roster for this class
        $enrolled = Database::fetchOne(
            "SELECT cs.id FROM `ret_class_students` cs 
             JOIN `students` st ON cs.student_id = st.id 
             WHERE cs.class_id = :cid AND st.student_number = :snum AND cs.status = 'enrolled' LIMIT 1",
            ['cid' => $classId, 'snum' => $studentNumber]
        );

        if (!$enrolled) {
            Session::flash('error', 'The student selected is not enrolled on this class roster.');
            redirect(url('retention/faculty/conduct'));
            return;
        }

        $id = Database::insert('ret_behavior_records', [
            'class_id'      => $classId,
            'student_id'    => $studentNumber,
            'incident_type' => $incidentType,
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
        redirect(url('retention/faculty/conduct'));
    }
}
