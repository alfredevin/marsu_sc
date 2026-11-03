<?php
namespace Modules\Analytics\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;
use Core\View;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\AnalyticsSettings;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Classroom;
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\Notifier;

/**
 * Faculty workspace: each faculty member creates and owns their classes.
 * Every class action goes through AnalyticsAccess::findOwnClassOr404().
 */
class FacultyController
{
    private function back(int $classId, string $tab = 'record'): string
    {
        return url('analytics/faculty/classes/' . $classId, ['tab' => $tab]);
    }

    // ------------------------------------------------------------------
    // Dashboard & class list
    // ------------------------------------------------------------------

    public function dashboard(): void
    {
        $fid = (int) Auth::id();
        $term = AnalyticsAccess::activeTerm();

        $termClasses = [];
        if ($term) {
            $termClasses = Database::fetchAll(
                "SELECT c.*, (SELECT COUNT(*) FROM `ana_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS student_count,
                        (SELECT COUNT(*) FROM `ana_class_join_requests` j WHERE j.class_id = c.id AND j.status = 'pending') AS pending_joins
                 FROM `ana_classes` c
                 WHERE c.faculty_user_id = :fid AND c.semester_id = :sem AND c.deleted_at IS NULL
                 ORDER BY c.subject_code, c.section_name",
                ['fid' => $fid, 'sem' => (int) $term['semester_id']]
            );
        }

        $joinRequests = Database::fetchAll(
            "SELECT j.id, j.class_id, j.created_at, s.student_number, s.first_name, s.last_name, c.subject_code, c.section_name
             FROM `ana_class_join_requests` j
             JOIN `ana_classes` c ON c.id = j.class_id
             JOIN `students` s ON s.id = j.student_id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND j.status = 'pending'
             ORDER BY j.created_at ASC LIMIT 20",
            ['fid' => $fid]
        );

        $openIncs = Database::fetchAll(
            "SELECT g.inc_deadline, DATEDIFF(g.inc_deadline, CURDATE()) AS days_left, c.id AS class_id, c.subject_code, c.section_name,
                    s.student_number, s.first_name, s.last_name
             FROM `ana_class_grades` g
             JOIN `ana_classes` c ON c.id = g.class_id
             JOIN `students` s ON s.id = g.student_id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND g.remarks = 'INC' AND g.inc_resolved_at IS NULL
             ORDER BY g.inc_deadline IS NULL, g.inc_deadline LIMIT 20",
            ['fid' => $fid]
        );

        $corrections = Database::fetchAll(
            "SELECT r.*, c.subject_code, c.section_name
             FROM `ana_grade_change_requests` r JOIN `ana_classes` c ON c.id = r.class_id
             WHERE c.faculty_user_id = :fid ORDER BY r.id DESC LIMIT 10",
            ['fid' => $fid]
        );

        View::render('analytics/Views/faculty/dashboard', [
            'term'         => $term,
            'termClasses'  => $termClasses,
            'joinRequests' => $joinRequests,
            'openIncs'     => $openIncs,
            'corrections'  => $corrections,
            'title'        => 'Faculty Workspace',
            'crumbs'       => ['Faculty Workspace' => url('analytics/faculty'), 'Dashboard' => ''],
        ]);
    }

    public function classes(): void
    {
        $classes = Database::fetchAll(
            "SELECT c.*, sem.name AS semester_name, ay.label AS academic_year_label,
                    (SELECT COUNT(*) FROM `ana_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS student_count,
                    (SELECT COUNT(*) FROM `ana_class_join_requests` j WHERE j.class_id = c.id AND j.status = 'pending') AS pending_joins
             FROM `ana_classes` c
             LEFT JOIN `semesters` sem ON sem.id = c.semester_id
             LEFT JOIN `academic_years` ay ON ay.id = c.academic_year_id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL
             ORDER BY c.semester_id DESC, c.subject_code, c.section_name",
            ['fid' => (int) Auth::id()]
        );
        View::render('analytics/Views/faculty/classes', [
            'classes'    => $classes,
            'activeTerm' => AnalyticsAccess::activeTerm(),
            'title'      => 'My Classes',
            'crumbs'     => ['Faculty Workspace' => url('analytics/faculty'), 'My Classes' => ''],
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

    // ------------------------------------------------------------------
    // Class page (record / roster / stream / settings tabs)
    // ------------------------------------------------------------------

    public function classRecord(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $class = ClassRecord::details((int) $own['id']);
        $classId = (int) $class['id'];
        $tab = in_array($_GET['tab'] ?? '', ['record', 'roster', 'stream', 'settings'], true) ? $_GET['tab'] : 'record';
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

        $posts = Database::fetchAll(
            "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS author
             FROM `ana_class_posts` p LEFT JOIN `users` u ON u.id = p.author_user_id
             WHERE p.class_id = :cid AND p.deleted_at IS NULL
             ORDER BY p.is_pinned DESC, p.created_at DESC",
            ['cid' => $classId]
        );

        View::render('analytics/Views/faculty/class_record', [
            'class'              => $class,
            'record'             => ClassRecord::load($class),
            'droppedRoster'      => array_values(array_filter(ClassRecord::roster($classId, true), fn($r) => $r['roster_status'] === 'dropped')),
            'tab'                => $tab,
            'search'             => $search,
            'candidates'         => Classroom::enrolledCandidates($class, $search !== '' ? $search : null),
            'joinRequests'       => $joinRequests,
            'posts'              => $posts,
            'pendingCorrection'  => Database::fetchOne("SELECT * FROM `ana_grade_change_requests` WHERE class_id = :cid AND status = 'pending' ORDER BY id DESC LIMIT 1", ['cid' => $classId]),
            'correctionHistory'  => Database::fetchAll("SELECT * FROM `ana_grade_change_requests` WHERE class_id = :cid ORDER BY id DESC LIMIT 5", ['cid' => $classId]),
            'allowCustomWeights' => (bool) AnalyticsSettings::get('grading.allow_faculty_custom_weights'),
            'incWindowDays'      => AnalyticsSettings::get('grading.inc_removal_days'),
            'title'              => "Class: {$class['subject_code']} ({$class['section_name']})",
            'crumbs'             => ['Faculty Workspace' => url('analytics/faculty'), 'My Classes' => url('analytics/faculty/classes'), $class['subject_code'] => ''],
        ]);
    }

    public function stream(string $id): void
    {
        $class = AnalyticsAccess::findOwnClassOr404($id);
        redirect($this->back((int) $class['id'], 'stream'));
    }

    public function rosterCandidates(string $id): void
    {
        $class = AnalyticsAccess::findOwnClassOr404($id);
        redirect($this->back((int) $class['id'], 'roster'));
    }

    // ------------------------------------------------------------------
    // Grading scheme
    // ------------------------------------------------------------------

    public function saveScheme(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'draft') {
            redirect($this->back($classId, 'settings'), 'error', 'The grading scheme cannot change after grades are posted.');
        }

        $current = ClassRecord::scheme($own);
        $submitted = json_decode((string) ($_POST['scheme_json'] ?? ''), true);
        if (!is_array($submitted) || empty($submitted['groups']) || !is_array($submitted['groups'])) {
            redirect($this->back($classId, 'settings'), 'error', 'Invalid grading scheme.');
        }
        $scheme = GradeCalculator::normalizeScheme($submitted, $current['passingCutoff']);
        $scheme['name'] = $current['name'];
        $scheme['passingCutoff'] = $current['passingCutoff'];

        $allowWeights = (bool) AnalyticsSettings::get('grading.allow_faculty_custom_weights');
        if (!$allowWeights) {
            $templateWeights = array_column($current['groups'], 'weight', 'id');
            foreach ($scheme['groups'] as &$g) {
                if (!array_key_exists($g['id'], $templateWeights)) {
                    redirect($this->back($classId, 'settings'), 'error', 'Adding or removing components is disabled by policy; only tasks can change.');
                }
                $g['weight'] = (float) $templateWeights[$g['id']];
            }
            unset($g);
        }

        $total = array_sum(array_column($scheme['groups'], 'weight'));
        if (abs($total - 100.0) > 0.01) {
            redirect($this->back($classId, 'settings'), 'error', "Component weights must total 100%. Current total: {$total}%.");
        }
        $codes = [];
        foreach ($scheme['groups'] as $g) {
            foreach ($g['items'] as $it) {
                if (!preg_match('/^[A-Za-z0-9_\-]{1,32}$/', $it['code'])) {
                    redirect($this->back($classId, 'settings'), 'error', "Task code '{$it['code']}' may only use letters, numbers, dash or underscore (max 32).");
                }
                $key = strtoupper($it['code']);
                if (isset($codes[$key])) {
                    redirect($this->back($classId, 'settings'), 'error', "Task code '{$it['code']}' is used twice.");
                }
                $codes[$key] = true;
            }
        }

        Database::update('ana_classes', [
            'grading_scheme' => json_encode($scheme, JSON_UNESCAPED_UNICODE),
            'updated_at'     => date('Y-m-d H:i:s'),
        ], 'id = :id', ['id' => $classId]);
        ChangeLog::record('class', $classId, 'update_scheme', 'grading_scheme', null, null, 'Faculty updated components and tasks');
        redirect($this->back($classId, 'settings'), 'success', 'Grading scheme saved.');
    }

    // ------------------------------------------------------------------
    // Roster
    // ------------------------------------------------------------------

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

    public function removeStudent(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] === 'locked') {
            redirect($this->back($classId, 'roster'), 'error', 'The roster of a locked class cannot change.');
        }
        $sid = (int) ($_POST['student_id'] ?? 0);
        $reason = trim((string) ($_POST['reason'] ?? ''));
        if (mb_strlen($reason) < 5) {
            redirect($this->back($classId, 'roster'), 'error', 'Please give a reason (at least 5 characters) for dropping the student.');
        }
        if (!Classroom::isRostered($classId, $sid)) {
            redirect($this->back($classId, 'roster'), 'error', 'That student is not on this roster.');
        }
        Database::update('ana_class_students', [
            'status' => 'dropped', 'drop_reason' => mb_substr($reason, 0, 255), 'updated_at' => date('Y-m-d H:i:s'),
        ], 'class_id = :cid AND student_id = :sid', ['cid' => $classId, 'sid' => $sid]);
        ChangeLog::record('class_roster', $classId, 'drop_student', 'student_id', (string) $sid, 'dropped', $reason);
        redirect($this->back($classId, 'roster'), 'success', 'Student dropped from the roster. Their recorded scores are kept.');
    }

    public function setGradeMark(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'draft') {
            redirect($this->back($classId), 'error', 'INC / DRP marks can only change while the class record is in draft.');
        }
        $sid = (int) ($_POST['student_id'] ?? 0);
        $mark = (string) ($_POST['mark'] ?? '');
        $mark = in_array($mark, GradeCalculator::MARKS, true) ? $mark : null;
        if (!Classroom::isRostered($classId, $sid)) {
            redirect($this->back($classId), 'error', 'That student is not on this roster.');
        }
        Database::update('ana_class_students', ['grade_mark' => $mark, 'updated_at' => date('Y-m-d H:i:s')],
            'class_id = :cid AND student_id = :sid', ['cid' => $classId, 'sid' => $sid]);
        ChangeLog::record('class_roster', $classId, 'grade_mark', 'student_id:' . $sid, null, $mark ?? 'none', 'Faculty set grade mark');
        redirect($this->back($classId), 'success', $mark ? "Student marked {$mark}; it applies when grades are posted." : 'Mark cleared.');
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

    // ------------------------------------------------------------------
    // Stream
    // ------------------------------------------------------------------

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

    // ------------------------------------------------------------------
    // Scores and grades
    // ------------------------------------------------------------------

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

    public function saveTaskException(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'draft') {
            redirect($this->back($classId), 'error', 'Submission statuses can only change while the class record is in draft.');
        }
        $sid = (int) ($_POST['student_id'] ?? 0);
        $code = (string) ($_POST['item_code'] ?? '');
        $status = (string) ($_POST['submission_status'] ?? '');
        $items = GradeCalculator::items(ClassRecord::scheme($own));
        if (!Classroom::isRostered($classId, $sid) || !isset($items[$code]) || !in_array($status, ['submitted', 'late', 'missing', 'excused'], true)) {
            redirect($this->back($classId), 'error', 'Invalid student, task or status.');
        }
        Database::query(
            "INSERT INTO `ana_class_scores` (`class_id`, `student_id`, `item_code`, `score`, `submission_status`, `updated_by`, `created_at`, `updated_at`)
             VALUES (:cid, :sid, :code, NULL, :st, :uid, NOW(), NOW())
             ON DUPLICATE KEY UPDATE `submission_status` = VALUES(`submission_status`), `updated_by` = VALUES(`updated_by`), `updated_at` = NOW()",
            ['cid' => $classId, 'sid' => $sid, 'code' => $code, 'st' => $status, 'uid' => (int) Auth::id()]
        );
        redirect($this->back($classId), 'success', "{$code} marked as {$status}.");
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

    public function requestCorrection(string $id): void
    {
        $own = AnalyticsAccess::findOwnClassOr404($id);
        $classId = (int) $own['id'];
        if ($own['grade_status'] !== 'posted') {
            redirect($this->back($classId), 'error', 'Correction requests can only be filed for posted classes.');
        }
        $reason = trim((string) ($_POST['reason'] ?? ''));
        if (mb_strlen($reason) < 10) {
            redirect($this->back($classId), 'error', 'Please explain the correction in at least 10 characters.');
        }
        if (Database::fetchOne("SELECT id FROM `ana_grade_change_requests` WHERE class_id = :cid AND status = 'pending'", ['cid' => $classId])) {
            redirect($this->back($classId), 'error', 'A correction request for this class is already pending.');
        }
        $reqId = Database::insert('ana_grade_change_requests', [
            'class_id' => $classId, 'requested_by' => (int) Auth::id(), 'reason' => $reason, 'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
        ]);
        ChangeLog::record('grade_correction', $reqId, 'request', 'class_id', null, (string) $classId, $reason);
        redirect($this->back($classId), 'success', 'Correction request sent to the administrator.');
    }

    // ------------------------------------------------------------------
    // Cross-class stream and join requests
    // ------------------------------------------------------------------

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

    // ------------------------------------------------------------------
    // My students
    // ------------------------------------------------------------------

    public function students(): void
    {
        $students = Database::fetchAll(
            "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, p.code AS program_code,
                    GROUP_CONCAT(DISTINCT CONCAT(c.subject_code, ' (', c.section_name, ')') ORDER BY c.subject_code SEPARATOR ', ') AS classes
             FROM `ana_class_students` cs
             JOIN `ana_classes` c ON c.id = cs.class_id AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
             JOIN `students` s ON s.id = cs.student_id AND s.deleted_at IS NULL
             LEFT JOIN `programs` p ON p.id = s.program_id
             WHERE cs.status = 'enrolled'
             GROUP BY s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, p.code
             ORDER BY s.last_name, s.first_name",
            ['fid' => (int) Auth::id()]
        );
        View::render('analytics/Views/faculty/students', [
            'students' => $students,
            'title'    => 'My Students',
            'crumbs'   => ['Faculty Workspace' => url('analytics/faculty'), 'My Students' => ''],
        ]);
    }

    public function studentView(string $id): void
    {
        $sid = (int) $id;
        if (!AnalyticsAccess::facultyHasStudent($sid)) {
            AnalyticsAccess::notFound();
        }
        $student = Database::fetchOne(
            "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, p.code AS program_code, p.name AS program_name, sec.name AS section_name
             FROM `students` s LEFT JOIN `programs` p ON p.id = s.program_id LEFT JOIN `sections` sec ON sec.id = s.section_id
             WHERE s.id = :id",
            ['id' => $sid]
        );
        $classes = [];
        foreach (Database::fetchAll(
            "SELECT c.id FROM `ana_class_students` cs JOIN `ana_classes` c ON c.id = cs.class_id
             WHERE cs.student_id = :sid AND cs.status = 'enrolled' AND c.faculty_user_id = :fid AND c.deleted_at IS NULL ORDER BY c.semester_id DESC",
            ['sid' => $sid, 'fid' => (int) Auth::id()]
        ) as $row) {
            $details = ClassRecord::details((int) $row['id']);
            $rec = ClassRecord::load($details, $sid);
            $att = $rec['attendance'][$sid] ?? ClassRecord::emptyAttendance();
            $classes[] = [
                'class' => $details, 'scheme' => $rec['scheme'], 'scores' => $rec['scores'][$sid] ?? [], 'statuses' => $rec['statuses'][$sid] ?? [],
                'computed' => $rec['computed'][$sid] ?? null, 'posted' => $rec['posted'][$sid] ?? null, 'attendance' => $att,
                'attRate' => GradeCalculator::attendanceRate($att),
            ];
        }
        $conduct = Database::fetchAll(
            "SELECT b.*, c.subject_code FROM `ana_behavior_records` b LEFT JOIN `ana_classes` c ON c.id = b.class_id
             WHERE b.student_id = :sid AND b.reported_by = :fid AND b.deleted_at IS NULL ORDER BY b.incident_date DESC",
            ['sid' => $sid, 'fid' => (int) Auth::id()]
        );
        View::render('analytics/Views/faculty/student_view', [
            'student' => $student,
            'classes' => $classes,
            'conduct' => $conduct,
            'title'   => 'Student: ' . $student['last_name'] . ', ' . $student['first_name'],
            'crumbs'  => ['Faculty Workspace' => url('analytics/faculty'), 'My Students' => url('analytics/faculty/students'), $student['student_number'] => ''],
        ]);
    }

    // ------------------------------------------------------------------
    // Roll-call attendance
    // ------------------------------------------------------------------

    private function ownClassOptions(): array
    {
        return Database::fetchAll(
            "SELECT c.id, c.subject_code, c.subject_title, c.section_name, c.semester_id
             FROM `ana_classes` c WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL ORDER BY c.semester_id DESC, c.subject_code",
            ['fid' => (int) Auth::id()]
        );
    }

    private function validDate(string $value): ?string
    {
        $d = \DateTime::createFromFormat('Y-m-d', $value);
        return ($d && $d->format('Y-m-d') === $value) ? $value : null;
    }

    public function attendance(): void
    {
        $classes = $this->ownClassOptions();
        $classId = (int) ($_GET['class_id'] ?? ($classes[0]['id'] ?? 0));
        $date = $this->validDate((string) ($_GET['date'] ?? '')) ?? date('Y-m-d');

        $roster = $existing = $history = [];
        $selected = null;
        if ($classId > 0) {
            $selected = AnalyticsAccess::findOwnClassOr404($classId);
            $roster = ClassRecord::roster($classId);
            foreach (Database::fetchAll(
                "SELECT student_id, status, remarks FROM `ana_attendance_records` WHERE class_id = :cid AND session_date = :d AND voided_at IS NULL",
                ['cid' => $classId, 'd' => $date]
            ) as $r) {
                $existing[(int) $r['student_id']] = $r;
            }
            $history = Database::fetchAll(
                "SELECT session_date, COUNT(*) AS total,
                        SUM(status = 'Present') AS present, SUM(status = 'Late') AS late, SUM(status = 'Excused') AS excused, SUM(status = 'Absent') AS absent
                 FROM `ana_attendance_records` WHERE class_id = :cid AND voided_at IS NULL
                 GROUP BY session_date ORDER BY session_date DESC LIMIT 20",
                ['cid' => $classId]
            );
        }
        View::render('analytics/Views/faculty/attendance', [
            'classes' => $classes, 'classId' => $classId, 'selected' => $selected, 'date' => $date,
            'roster' => $roster, 'existing' => $existing, 'history' => $history,
            'title' => 'Roll-Call Attendance',
            'crumbs' => ['Faculty Workspace' => url('analytics/faculty'), 'Roll-Call' => ''],
        ]);
    }

    public function storeAttendance(): void
    {
        $own = AnalyticsAccess::findOwnClassOr404((int) ($_POST['class_id'] ?? 0));
        $classId = (int) $own['id'];
        $date = $this->validDate((string) ($_POST['session_date'] ?? ''));
        $backUrl = url('analytics/faculty/attendance', ['class_id' => $classId, 'date' => $date ?? date('Y-m-d')]);
        if ($date === null || $date > date('Y-m-d')) {
            redirect($backUrl, 'error', 'Choose a valid session date that is not in the future.');
        }
        if ($own['grade_status'] === 'locked') {
            redirect($backUrl, 'error', 'Attendance cannot change after the term is closed.');
        }

        $rostered = array_map('intval', array_column(ClassRecord::roster($classId), 'student_id'));
        $statuses = (array) ($_POST['status'] ?? []);
        $remarks = (array) ($_POST['remarks'] ?? []);
        $saved = 0;

        Database::beginTransaction();
        try {
            foreach ($statuses as $sidRaw => $status) {
                $sid = (int) $sidRaw;
                if (!in_array($sid, $rostered, true) || !in_array($status, ['Present', 'Late', 'Absent', 'Excused'], true)) {
                    continue;
                }
                $rem = Classroom::nullable((string) ($remarks[$sidRaw] ?? ''), 255);
                $row = Database::fetchOne(
                    "SELECT id FROM `ana_attendance_records` WHERE class_id = :cid AND student_id = :sid AND session_date = :d AND voided_at IS NULL LIMIT 1",
                    ['cid' => $classId, 'sid' => $sid, 'd' => $date]
                );
                if ($row) {
                    Database::update('ana_attendance_records', ['status' => $status, 'remarks' => $rem, 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $row['id']]);
                } else {
                    Database::insert('ana_attendance_records', [
                        'class_id' => $classId, 'student_id' => $sid, 'subject_code' => $own['subject_code'], 'session_date' => $date,
                        'status' => $status, 'remarks' => $rem, 'recorded_by' => (int) Auth::id(), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                $saved++;
            }
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }
        redirect($backUrl, 'success', "Attendance saved for {$saved} student(s) on {$date}.");
    }

    // ------------------------------------------------------------------
    // Conduct
    // ------------------------------------------------------------------

    public function conduct(): void
    {
        $fid = (int) Auth::id();
        $rosterRows = Database::fetchAll(
            "SELECT cs.class_id, s.id AS student_id, s.student_number, s.first_name, s.last_name
             FROM `ana_class_students` cs
             JOIN `ana_classes` c ON c.id = cs.class_id AND c.faculty_user_id = :fid AND c.deleted_at IS NULL
             JOIN `students` s ON s.id = cs.student_id
             WHERE cs.status = 'enrolled' ORDER BY s.last_name, s.first_name",
            ['fid' => $fid]
        );
        $reports = Database::fetchAll(
            "SELECT b.*, s.student_number, s.first_name, s.last_name, c.subject_code, c.section_name
             FROM `ana_behavior_records` b
             JOIN `students` s ON s.id = b.student_id
             LEFT JOIN `ana_classes` c ON c.id = b.class_id
             WHERE b.reported_by = :fid AND b.deleted_at IS NULL
             ORDER BY b.incident_date DESC, b.id DESC",
            ['fid' => $fid]
        );
        View::render('analytics/Views/faculty/conduct', [
            'classes' => $this->ownClassOptions(), 'rosterRows' => $rosterRows, 'reports' => $reports,
            'title' => 'Conduct Reports',
            'crumbs' => ['Faculty Workspace' => url('analytics/faculty'), 'Conduct Reports' => ''],
        ]);
    }

    public function storeConduct(): void
    {
        $own = AnalyticsAccess::findOwnClassOr404((int) ($_POST['class_id'] ?? 0));
        $classId = (int) $own['id'];
        $sid = (int) ($_POST['student_id'] ?? 0);
        $type = trim((string) ($_POST['incident_type'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $severity = in_array($_POST['severity'] ?? '', ['Minor', 'Moderate', 'Severe'], true) ? $_POST['severity'] : 'Minor';
        $date = $this->validDate((string) ($_POST['incident_date'] ?? ''));

        if (!Classroom::isRostered($classId, $sid)) {
            redirect(url('analytics/faculty/conduct'), 'error', 'The student is not on the roster of the selected class.');
        }
        if ($date === null || $date > date('Y-m-d') || $type === '' || mb_strlen($type) > 100 || mb_strlen($description) < 10) {
            redirect(url('analytics/faculty/conduct'), 'error', 'Provide a past or current date, an incident type and a narrative of at least 10 characters.');
        }
        $id = Database::insert('ana_behavior_records', [
            'class_id' => $classId, 'student_id' => $sid, 'reported_by' => (int) Auth::id(), 'incident_date' => $date,
            'incident_type' => $type, 'severity' => $severity, 'description' => $description, 'status' => 'Reported',
            'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
        ]);
        ChangeLog::record('conduct', $id, 'report_incident', 'status', null, 'Reported', "{$severity} incident reported");
        redirect(url('analytics/faculty/conduct'), 'success', 'Conduct report filed.');
    }
}
