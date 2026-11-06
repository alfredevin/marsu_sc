<?php
namespace Modules\Analytics\Controllers;

use Core\Database;
use Core\View;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\AnalyticsSettings;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Classroom;
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\Notifier;

/**
 * Student portal. Every query is filtered by the signed-in student's own id;
 * classes the student is not rostered in return 404.
 */
class StudentPortalController
{
    private function student(): array
    {
        $student = AnalyticsAccess::currentStudent();
        if (!$student) {
            View::render('analytics/Views/student/not_linked', [
                'title'  => 'Account Not Linked',
                'crumbs' => ['My Academics' => ''],
            ]);
            exit;
        }
        return $student;
    }

    private function render(string $view, string $title, array $data): void
    {
        View::render('analytics/Views/student/' . $view, array_merge($data, [
            'title'  => $title,
            'crumbs' => ['My Academics' => url('analytics/my'), $title => ''],
        ]));
    }

    /**
     * Classes the student is rostered in, newest term first.
     */
    private function myClasses(int $sid, ?int $semesterId = null): array
    {
        $params = ['sid' => $sid];
        $termSql = '';
        if ($semesterId) {
            $termSql = ' AND c.semester_id = :sem';
            $params['sem'] = $semesterId;
        }
        return Database::fetchAll(
            "SELECT c.id, c.class_code, sub.code AS subject_code, sub.title AS subject_title, sub.units, sec.name AS section_name, c.schedule, rm.room_number AS room,
                    c.grade_status, c.scores_visible, c.semester_id,
                    sem.name AS semester_name, ay.label AS academic_year_label,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name
             FROM `ana_class_students` cs
             JOIN `ana_classes` c ON c.id = cs.class_id AND c.deleted_at IS NULL
             LEFT JOIN `subjects` sub ON sub.id = c.subject_id
             LEFT JOIN `sections` sec ON sec.id = c.section_id
             LEFT JOIN `rooms` rm ON rm.id = c.room_id
             LEFT JOIN `semesters` sem ON sem.id = c.semester_id
             LEFT JOIN `academic_years` ay ON ay.id = sem.academic_year_id
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             WHERE cs.student_id = :sid AND cs.status = 'enrolled'{$termSql}
             ORDER BY c.semester_id DESC, sub.code",
            $params
        );
    }

    private function enrollment(int $sid, ?array $term): ?array
    {
        if (!$term) {
            return null;
        }
        $e = Database::fetchOne(
            "SELECT e.*, p.code AS program_code, sec.name AS section_name
             FROM `ana_enrollments` e JOIN `students` st ON st.id = e.student_id
             LEFT JOIN `programs` p ON p.id = st.program_id LEFT JOIN `sections` sec ON sec.id = e.section_id
             WHERE e.student_id = :sid AND e.semester_id = :sem",
            ['sid' => $sid, 'sem' => (int) $term['semester_id']]
        );
        if ($e) {
            $e['subjects'] = Database::fetchAll(
                "SELECT sub.code, sub.title, sub.units, es.status FROM `ana_enrollment_subjects` es JOIN `subjects` sub ON sub.id = es.subject_id
                 WHERE es.enrollment_id = :eid ORDER BY sub.code",
                ['eid' => (int) $e['id']]
            );
        }
        return $e;
    }

    private function attendanceSummary(int $sid, array $classes): array
    {
        $out = [];
        foreach ($classes as $c) {
            $att = ClassRecord::attendance((int) $c['id'], $sid);
            $mine = $att['students'][$sid] ?? ClassRecord::emptyAttendance();
            $sessions = count(ClassRecord::attendance((int) $c['id'])['dates']);
            $allowed = AnalyticsSettings::allowedAbsences($sessions);
            $out[] = [
                'class'    => $c,
                'att'      => $mine,
                'rate'     => GradeCalculator::attendanceRate($mine),
                'sessions' => $sessions,
                'allowed'  => $allowed,
            ];
        }
        return $out;
    }

    private function openIncs(int $sid): array
    {
        return Database::fetchAll(
            "SELECT g.inc_deadline, DATEDIFF(g.inc_deadline, CURDATE()) AS days_left, g.posted_at,
                    c.id AS class_id, sub.code AS subject_code, sub.title AS subject_title, sec.name AS section_name, CONCAT(u.first_name, ' ', u.last_name) AS faculty_name
             FROM `ana_class_grades` g
             JOIN `ana_classes` c ON c.id = g.class_id AND c.deleted_at IS NULL
             LEFT JOIN `subjects` sub ON sub.id = c.subject_id
             LEFT JOIN `sections` sec ON sec.id = c.section_id
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             WHERE g.student_id = :sid AND g.remarks = 'INC' AND g.inc_resolved_at IS NULL AND c.grade_status IN ('posted', 'locked')
             ORDER BY g.inc_deadline IS NULL, g.inc_deadline",
            ['sid' => $sid]
        );
    }

    public function dashboard(): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $term = AnalyticsAccess::activeTerm();
        $classes = $term ? $this->myClasses($sid, (int) $term['semester_id']) : [];

        $classIds = array_map(fn($c) => (int) $c['id'], $this->myClasses($sid));
        $posts = [];
        if ($classIds) {
            $posts = Database::fetchAll(
                "SELECT p.id, p.class_id, p.type, p.title, p.created_at, sub.code AS subject_code
                 FROM `ana_class_posts` p JOIN `ana_classes` c ON c.id = p.class_id
                 LEFT JOIN `subjects` sub ON sub.id = c.subject_id
                 WHERE p.deleted_at IS NULL AND p.class_id IN (" . implode(',', $classIds) . ")
                 ORDER BY p.created_at DESC LIMIT 6"
            );
        }

        $this->render('dashboard', 'My Academics', [
            'student'    => $student,
            'term'       => $term,
            'enrollment' => $this->enrollment($sid, $term),
            'classes'    => $classes,
            'posts'      => $posts,
            'attendance' => $this->attendanceSummary($sid, $classes),
            'incs'       => $this->openIncs($sid),
            'ratio'      => AnalyticsSettings::get('attendance.max_absence_ratio'),
        ]);
    }

    public function classes(): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $requests = Database::fetchAll(
            "SELECT j.status, j.created_at, sub.code AS subject_code, sec.name AS section_name
             FROM `ana_class_join_requests` j JOIN `ana_classes` c ON c.id = j.class_id
             LEFT JOIN `subjects` sub ON sub.id = c.subject_id
             LEFT JOIN `sections` sec ON sec.id = c.section_id
             WHERE j.student_id = :sid AND j.status <> 'approved' ORDER BY j.created_at DESC",
            ['sid' => $sid]
        );
        $this->render('classes', 'My Classes', ['classes' => $this->myClasses($sid), 'requests' => $requests]);
    }

    public function classView(string $id): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $classId = (int) $id;
        if (!Classroom::isRostered($classId, $sid)) {
            AnalyticsAccess::notFound();
        }
        $class = ClassRecord::details($classId);
        if (!$class) {
            AnalyticsAccess::notFound();
        }
        $published = ClassRecord::isPublished($class);
        $record = ClassRecord::load($class, $sid);

        $posts = Database::fetchAll(
            "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS author
             FROM `ana_class_posts` p LEFT JOIN `users` u ON u.id = p.author_user_id
             WHERE p.class_id = :cid AND p.deleted_at IS NULL
             ORDER BY p.is_pinned DESC, p.created_at DESC",
            ['cid' => $classId]
        );

        $this->render('class_view', $class['subject_code'], [
            'class'      => $class,
            'posts'      => $posts,
            'published'  => $published,
            'posted'     => $published ? ($record['posted'][$sid] ?? null) : null,
            'showScores' => (bool) $class['scores_visible'],
            'scheme'     => $record['scheme'],
            'scores'     => $record['scores'][$sid] ?? [],
            'statuses'   => $record['statuses'][$sid] ?? [],
            'attendance' => $record['attendance'][$sid] ?? ClassRecord::emptyAttendance(),
            'dates'      => $record['dates'],
        ]);
    }

    /**
     * Grade rows per term: posted/locked grades only; draft classes show "In progress".
     */
    private function gradeRows(int $sid, ?int $semesterId): array
    {
        $rows = [];
        foreach ($this->myClasses($sid, $semesterId) as $c) {
            $published = in_array($c['grade_status'], ['posted', 'locked'], true);
            $g = $published ? Database::fetchOne(
                "SELECT final_grade, remarks, inc_deadline, inc_resolved_at FROM `ana_class_grades` WHERE class_id = :cid AND student_id = :sid",
                ['cid' => (int) $c['id'], 'sid' => $sid]
            ) : null;
            $rows[] = ['class' => $c, 'published' => $published && $g !== null, 'grade' => $g, 'units' => (float) $c['units'],
                       'final_grade' => $g['final_grade'] ?? null];
        }
        return $rows;
    }

    private function selectedTerm(int $sid): ?array
    {
        $requested = (int) ($_GET['term'] ?? 0);
        if ($requested > 0) {
            return AnalyticsAccess::findTerm($requested);
        }
        return AnalyticsAccess::activeTerm();
    }

    private function myTerms(int $sid): array
    {
        $ids = array_unique(array_filter(array_map(fn($c) => (int) $c['semester_id'], $this->myClasses($sid))));
        $terms = [];
        foreach ($ids as $id) {
            if ($t = AnalyticsAccess::findTerm($id)) {
                $terms[] = $t;
            }
        }
        return $terms;
    }

    public function grades(): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $term = $this->selectedTerm($sid);
        $rows = $term ? $this->gradeRows($sid, (int) $term['semester_id']) : [];
        $this->render('grades', 'My Grades', [
            'student' => $student,
            'term'    => $term,
            'terms'   => $this->myTerms($sid),
            'rows'    => $rows,
            'gwa'     => GradeCalculator::gwa(array_filter($rows, fn($r) => $r['published'])),
        ]);
    }

    public function gradesPrint(): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $term = $this->selectedTerm($sid);
        $rows = $term ? array_values(array_filter($this->gradeRows($sid, (int) $term['semester_id']), fn($r) => $r['published'])) : [];
        View::render('analytics/Views/student/grades_print', [
            'student' => $student,
            'term'    => $term,
            'rows'    => $rows,
            'gwa'     => GradeCalculator::gwa($rows),
            'title'   => 'Grade Slip',
        ], null);
    }

    public function attendance(): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $term = $this->selectedTerm($sid);
        $classes = $term ? $this->myClasses($sid, (int) $term['semester_id']) : [];
        $this->render('attendance', 'My Attendance', [
            'term'    => $term,
            'terms'   => $this->myTerms($sid),
            'summary' => $this->attendanceSummary($sid, $classes),
            'ratio'   => AnalyticsSettings::get('attendance.max_absence_ratio'),
        ]);
    }

    public function deficiencies(): void
    {
        $student = $this->student();
        $this->render('deficiencies', 'INC Deficiencies', [
            'incs'      => $this->openIncs((int) $student['id']),
            'incWindow' => AnalyticsSettings::get('grading.inc_removal_days'),
        ]);
    }

    public function profile(): void
    {
        $student = $this->student();
        $term = AnalyticsAccess::activeTerm();
        $this->render('profile', 'My Profile', [
            'student'    => $student,
            'term'       => $term,
            'enrollment' => $this->enrollment((int) $student['id'], $term),
        ]);
    }

    public function conduct(): void
    {
        $student = $this->student();
        $rows = Database::fetchAll(
            "SELECT b.incident_date, b.incident_type, b.severity, b.status
             FROM `ana_behavior_records` b
             WHERE b.student_id = :sid AND b.deleted_at IS NULL
             ORDER BY b.incident_date DESC",
            ['sid' => (int) $student['id']]
        );
        $this->render('conduct', 'My Conduct Records', ['rows' => $rows]);
    }

    public function join(): void
    {
        $student = $this->student();
        $sid = (int) $student['id'];
        $code = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string) ($_POST['class_code'] ?? '')));
        $back = url('analytics/my/classes');
        if ($code === '' || strlen($code) > 8) {
            redirect($back, 'error', 'Enter the class code your instructor shared.');
        }
        $class = Database::fetchOne("SELECT " . ClassRecord::CLASS_COLUMNS . " FROM `ana_classes` c" . ClassRecord::CLASS_JOINS . " WHERE c.class_code = :c AND c.deleted_at IS NULL", ['c' => $code]);
        if (!$class) {
            redirect($back, 'error', 'No class uses that code.');
        }
        if ($class['grade_status'] === 'locked') {
            redirect($back, 'error', 'That class is closed for the term.');
        }
        if (Classroom::isRostered((int) $class['id'], $sid)) {
            redirect(url('analytics/my/classes/' . (int) $class['id']), 'info', 'You are already in this class.');
        }
        if (!Classroom::isOfficiallyEnrolled($sid, $class)) {
            redirect($back, 'error', "You are not officially enrolled in {$class['subject_code']} for this term. Please see the Registrar.");
        }

        $existing = Database::fetchOne("SELECT * FROM `ana_class_join_requests` WHERE class_id = :cid AND student_id = :sid", ['cid' => (int) $class['id'], 'sid' => $sid]);
        if ($existing && $existing['status'] === 'pending') {
            redirect($back, 'info', 'Your request to join is already waiting for the instructor.');
        }
        if ($existing) {
            Database::update('ana_class_join_requests', ['status' => 'pending', 'decided_by' => null, 'decided_at' => null, 'updated_at' => date('Y-m-d H:i:s')],
                'id = :id', ['id' => (int) $existing['id']]);
            $reqId = (int) $existing['id'];
        } else {
            $reqId = Database::insert('ana_class_join_requests', [
                'class_id' => (int) $class['id'], 'student_id' => $sid, 'status' => 'pending', 'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        ChangeLog::record('class_join', $reqId, 'request', 'class_id', null, (string) $class['id'], 'Student requested to join with class code');
        Notifier::user((int) $class['faculty_user_id'], "Join request: {$class['subject_code']} ({$class['section_name']})",
            $student['last_name'] . ', ' . $student['first_name'] . ' asked to join with the class code.', 'analytics/faculty/join-requests');
        redirect($back, 'success', "Request sent. Your instructor for {$class['subject_code']} will review it.");
    }
}
