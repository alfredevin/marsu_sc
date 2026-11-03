<?php
namespace Modules\Analytics\Controllers;

use Core\Auth;
use Core\Database;
use Core\View;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Csv;
use Modules\Analytics\Support\Notifier;
use Modules\Analytics\Support\Ui;

/**
 * Registrar workspace: official term enrollment is the source of truth for class rosters.
 * Students are never created here; only existing `students` rows are enrolled.
 */
class RegistrarController
{
    private const STATUSES = ['pending', 'enrolled', 'withdrawn', 'cancelled'];

    private function crumbs(string $label): array
    {
        return ['Registrar' => url('analytics/registrar'), $label => ''];
    }

    private function lookups(): array
    {
        return [
            'terms'    => AnalyticsAccess::terms(),
            'programs' => Database::fetchAll("SELECT id, code, name FROM `programs` WHERE deleted_at IS NULL ORDER BY code"),
            'sections' => Database::fetchAll("SELECT sec.id, sec.name, sec.year_level, sec.program_id, p.code AS program_code FROM `sections` sec JOIN `programs` p ON p.id = sec.program_id WHERE sec.deleted_at IS NULL ORDER BY p.code, sec.year_level, sec.name"),
            'subjects' => Database::fetchAll("SELECT s.id, s.code, s.title, s.units, s.program_id, p.code AS program_code FROM `subjects` s LEFT JOIN `programs` p ON p.id = s.program_id WHERE s.deleted_at IS NULL AND s.status = 'active' ORDER BY s.code"),
        ];
    }

    /**
     * Term chosen in a POST form (must exist), defaulting to the active term.
     */
    private function postedTerm(): ?array
    {
        $id = (int) ($_POST['semester_id'] ?? 0);
        return $id > 0 ? AnalyticsAccess::findTerm($id) : AnalyticsAccess::activeTerm();
    }

    private function validSubjectIds(array $ids): array
    {
        $ids = array_values(array_unique(array_filter(array_map('intval', $ids))));
        if (!$ids) {
            return [];
        }
        $rows = Database::fetchAll("SELECT id FROM `subjects` WHERE deleted_at IS NULL AND id IN (" . implode(',', $ids) . ")");
        return array_map('intval', array_column($rows, 'id'));
    }

    /**
     * Create one enrollment + subject load inside the caller's transaction.
     */
    private function createEnrollment(array $student, array $term, int $programId, int $yearLevel, ?int $sectionId, array $subjectIds, string $status, ?string $remarks): int
    {
        $now = date('Y-m-d H:i:s');
        $id = Database::insert('ana_enrollments', [
            'student_id'       => (int) $student['id'],
            'academic_year_id' => (int) $term['academic_year_id'],
            'semester_id'      => (int) $term['semester_id'],
            'program_id'       => $programId,
            'year_level'       => max(1, min(6, $yearLevel)),
            'section_id'       => $sectionId ?: null,
            'status'           => $status,
            'remarks'          => $remarks,
            'enrolled_by'      => (int) Auth::id(),
            'enrolled_at'      => $status === 'enrolled' ? $now : null,
            'created_at'       => $now,
        ]);
        foreach ($subjectIds as $subId) {
            Database::insert('ana_enrollment_subjects', [
                'enrollment_id' => $id, 'subject_id' => $subId, 'section_id' => $sectionId ?: null, 'status' => 'enrolled', 'created_at' => $now,
            ]);
        }
        ChangeLog::record('enrollment', $id, 'create', 'status', null, $status, "Enrolled {$student['student_number']} for {$term['label']} with " . count($subjectIds) . ' subject(s)');
        return $id;
    }

    private function enrollmentExists(int $studentId, int $semesterId): bool
    {
        return Database::fetchOne("SELECT id FROM `ana_enrollments` WHERE student_id = :s AND semester_id = :t", ['s' => $studentId, 't' => $semesterId]) !== null;
    }

    // ------------------------------------------------------------------
    // Dashboard
    // ------------------------------------------------------------------

    public function dashboard(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $counts = array_fill_keys(self::STATUSES, 0);
        $byProgram = $bySection = $noAccount = [];
        if ($term) {
            $p = ['sem' => (int) $term['semester_id']];
            foreach (Database::fetchAll("SELECT status, COUNT(*) AS n FROM `ana_enrollments` WHERE semester_id = :sem GROUP BY status", $p) as $r) {
                $counts[$r['status']] = (int) $r['n'];
            }
            $byProgram = Database::fetchAll(
                "SELECT p.code, SUM(e.status = 'enrolled') AS enrolled, SUM(e.status = 'pending') AS pending, SUM(e.status IN ('withdrawn', 'cancelled')) AS withdrawn
                 FROM `ana_enrollments` e JOIN `programs` p ON p.id = e.program_id WHERE e.semester_id = :sem GROUP BY p.code ORDER BY p.code", $p);
            $bySection = Database::fetchAll(
                "SELECT COALESCE(sec.name, 'No section') AS section_name, p.code AS program_code, SUM(e.status = 'enrolled') AS enrolled, SUM(e.status = 'pending') AS pending
                 FROM `ana_enrollments` e JOIN `programs` p ON p.id = e.program_id LEFT JOIN `sections` sec ON sec.id = e.section_id
                 WHERE e.semester_id = :sem GROUP BY sec.name, p.code ORDER BY p.code, sec.name", $p);
            $noAccount = Database::fetchAll(
                "SELECT s.id, s.student_number, s.first_name, s.last_name, p.code AS program_code
                 FROM `ana_enrollments` e JOIN `students` s ON s.id = e.student_id LEFT JOIN `programs` p ON p.id = s.program_id
                 WHERE e.semester_id = :sem AND e.status = 'enrolled' AND s.user_id IS NULL ORDER BY s.last_name LIMIT 100", $p);
        }
        View::render('analytics/Views/registrar/dashboard', array_merge($this->lookups(), [
            'term' => $term, 'counts' => $counts, 'byProgram' => $byProgram, 'bySection' => $bySection, 'noAccount' => $noAccount,
            'title' => 'Enrollment Dashboard', 'crumbs' => $this->crumbs('Dashboard'),
        ]));
    }

    // ------------------------------------------------------------------
    // Enrollment list / detail
    // ------------------------------------------------------------------

    private function enrollmentQuery(?array $term, ?array $page = null, bool $count = false): array|int
    {
        $params = ['sem' => $term ? (int) $term['semester_id'] : 0];
        $where = 'e.semester_id = :sem';
        $status = (string) ($_GET['status'] ?? '');
        if (in_array($status, self::STATUSES, true)) {
            $where .= ' AND e.status = :st';
            $params['st'] = $status;
        }
        if (($prog = (int) ($_GET['program'] ?? 0)) > 0) {
            $where .= ' AND e.program_id = :prog';
            $params['prog'] = $prog;
        }
        if (($sec = (int) ($_GET['section'] ?? 0)) > 0) {
            $where .= ' AND e.section_id = :sec';
            $params['sec'] = $sec;
        }
        if (($subj = (int) ($_GET['subject'] ?? 0)) > 0) {
            $where .= " AND EXISTS (SELECT 1 FROM `ana_enrollment_subjects` es WHERE es.enrollment_id = e.id AND es.subject_id = :subj AND es.status = 'enrolled')";
            $params['subj'] = $subj;
        }
        $q = trim((string) ($_GET['q'] ?? ''));
        if ($q !== '') {
            $where .= " AND (s.student_number LIKE :q1 OR CONCAT(s.first_name, ' ', s.last_name) LIKE :q2 OR CONCAT(s.last_name, ', ', s.first_name) LIKE :q3)";
            $params['q1'] = $params['q2'] = $params['q3'] = '%' . $q . '%';
        }
        $from = "FROM `ana_enrollments` e JOIN `students` s ON s.id = e.student_id
                 LEFT JOIN `programs` p ON p.id = e.program_id LEFT JOIN `sections` sec ON sec.id = e.section_id
                 WHERE {$where}";
        if ($count) {
            return (int) Database::fetchColumn("SELECT COUNT(*) {$from}", $params);
        }
        $limit = $page ? " LIMIT {$page['per_page']} OFFSET {$page['offset']}" : '';
        return Database::fetchAll(
            "SELECT e.*, s.student_number, s.first_name, s.middle_name, s.last_name, s.user_id, p.code AS program_code, sec.name AS section_name,
                    (SELECT COUNT(*) FROM `ana_enrollment_subjects` es WHERE es.enrollment_id = e.id AND es.status = 'enrolled') AS subject_count,
                    (SELECT COALESCE(SUM(sub.units), 0) FROM `ana_enrollment_subjects` es JOIN `subjects` sub ON sub.id = es.subject_id WHERE es.enrollment_id = e.id AND es.status = 'enrolled') AS units
             {$from} ORDER BY p.code, sec.name, s.last_name, s.first_name{$limit}",
            $params
        );
    }

    public function enrollments(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $page = Ui::paginate($term ? $this->enrollmentQuery($term, null, true) : 0, 30);
        View::render('analytics/Views/registrar/enrollments', array_merge($this->lookups(), [
            'term' => $term, 'rows' => $term ? $this->enrollmentQuery($term, $page) : [], 'pagination' => $page,
            'filters' => Ui::queryParams(['term', 'status', 'program', 'section', 'subject', 'q']),
            'title' => 'Term Enrollments', 'crumbs' => $this->crumbs('Enrollments'),
        ]));
    }

    private function findEnrollment(string $id): array
    {
        $e = Database::fetchOne(
            "SELECT e.*, s.student_number, s.first_name, s.middle_name, s.last_name, s.user_id, s.gender, s.email,
                    p.code AS program_code, p.name AS program_name, sec.name AS section_name,
                    sem.name AS semester_name, ay.label AS academic_year_label,
                    CONCAT(u.first_name, ' ', u.last_name) AS enrolled_by_name
             FROM `ana_enrollments` e
             JOIN `students` s ON s.id = e.student_id
             LEFT JOIN `programs` p ON p.id = e.program_id
             LEFT JOIN `sections` sec ON sec.id = e.section_id
             JOIN `semesters` sem ON sem.id = e.semester_id
             JOIN `academic_years` ay ON ay.id = e.academic_year_id
             LEFT JOIN `users` u ON u.id = e.enrolled_by
             WHERE e.id = :id",
            ['id' => (int) $id]
        );
        if (!$e) {
            AnalyticsAccess::notFound();
        }
        $e['term_label'] = $e['semester_name'] . ', ' . $e['academic_year_label'];
        $e['subjects'] = Database::fetchAll(
            "SELECT es.*, sub.code, sub.title, sub.units, sub.lecture_hours, sub.lab_hours, sec.name AS section_name
             FROM `ana_enrollment_subjects` es JOIN `subjects` sub ON sub.id = es.subject_id LEFT JOIN `sections` sec ON sec.id = es.section_id
             WHERE es.enrollment_id = :eid ORDER BY es.status, sub.code",
            ['eid' => (int) $e['id']]
        );
        return $e;
    }

    public function show(string $id): void
    {
        $e = $this->findEnrollment($id);
        View::render('analytics/Views/registrar/show', array_merge($this->lookups(), [
            'e' => $e, 'history' => ChangeLog::forEntity('enrollment', (int) $e['id']),
            'title' => 'Enrollment: ' . $e['student_number'], 'crumbs' => ['Registrar' => url('analytics/registrar'), 'Enrollments' => url('analytics/registrar/enrollments'), $e['student_number'] => ''],
        ]));
    }

    // ------------------------------------------------------------------
    // Enroll (single, bulk, CSV)
    // ------------------------------------------------------------------

    public function create(): void
    {
        $q = trim((string) ($_GET['q'] ?? ''));
        $results = [];
        if ($q !== '') {
            $results = Database::fetchAll(
                "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, s.program_id, s.section_id, p.code AS program_code, sec.name AS section_name
                 FROM `students` s LEFT JOIN `programs` p ON p.id = s.program_id LEFT JOIN `sections` sec ON sec.id = s.section_id
                 WHERE s.deleted_at IS NULL AND (s.student_number LIKE :q1 OR CONCAT(s.first_name, ' ', s.last_name) LIKE :q2 OR CONCAT(s.last_name, ', ', s.first_name) LIKE :q3)
                 ORDER BY s.last_name, s.first_name LIMIT 25",
                ['q1' => '%' . $q . '%', 'q2' => '%' . $q . '%', 'q3' => '%' . $q . '%']
            );
        }
        $selected = null;
        if (($sid = (int) ($_GET['student_id'] ?? 0)) > 0) {
            $selected = Database::fetchOne(
                "SELECT s.*, p.code AS program_code, sec.name AS section_name FROM `students` s LEFT JOIN `programs` p ON p.id = s.program_id LEFT JOIN `sections` sec ON sec.id = s.section_id
                 WHERE s.id = :id AND s.deleted_at IS NULL", ['id' => $sid]);
        }
        View::render('analytics/Views/registrar/create', array_merge($this->lookups(), [
            'activeTerm' => AnalyticsAccess::activeTerm(), 'q' => $q, 'results' => $results, 'selected' => $selected,
            'title' => 'Enroll Students', 'crumbs' => $this->crumbs('Enroll'),
        ]));
    }

    public function store(): void
    {
        $term = $this->postedTerm();
        $back = url('analytics/registrar/enrollments/create', ['student_id' => (int) ($_POST['student_id'] ?? 0)]);
        if (!$term) {
            redirect($back, 'error', 'Choose a valid term. No term is active.');
        }
        $student = Database::fetchOne("SELECT * FROM `students` WHERE id = :id AND deleted_at IS NULL", ['id' => (int) ($_POST['student_id'] ?? 0)]);
        $programId = (int) ($_POST['program_id'] ?? 0);
        $program = Database::fetchOne("SELECT id FROM `programs` WHERE id = :id AND deleted_at IS NULL", ['id' => $programId]);
        $sectionId = (int) ($_POST['section_id'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['pending', 'enrolled'], true) ? $_POST['status'] : 'pending';
        $subjects = $this->validSubjectIds((array) ($_POST['subjects'] ?? []));

        if (!$student || !$program) {
            redirect($back, 'error', 'Choose an existing student and program.');
        }
        if ($sectionId && !Database::fetchOne("SELECT id FROM `sections` WHERE id = :id AND deleted_at IS NULL", ['id' => $sectionId])) {
            redirect($back, 'error', 'The selected section does not exist.');
        }
        if (!$subjects) {
            redirect($back, 'error', 'Select at least one subject for the subject load.');
        }
        if ($this->enrollmentExists((int) $student['id'], (int) $term['semester_id'])) {
            redirect($back, 'error', "{$student['student_number']} already has an enrollment for {$term['label']}. Edit it instead.");
        }

        Database::beginTransaction();
        try {
            $id = $this->createEnrollment($student, $term, $programId, (int) ($_POST['year_level'] ?? $student['year_level']), $sectionId ?: null, $subjects, $status, trim((string) ($_POST['remarks'] ?? '')) ?: null);
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }
        Notifier::student((int) $student['id'], "Enrollment {$status}: {$term['label']}", count($subjects) . ' subject(s) in your load.', 'analytics/my');
        redirect(url('analytics/registrar/enrollments/' . $id), 'success', "{$student['student_number']} recorded as {$status} for {$term['label']}.");
    }

    public function bulk(): void
    {
        $term = $this->postedTerm();
        $back = url('analytics/registrar/enrollments/create');
        $sectionId = (int) ($_POST['section_id'] ?? 0);
        $section = Database::fetchOne("SELECT * FROM `sections` WHERE id = :id AND deleted_at IS NULL", ['id' => $sectionId]);
        $subjects = $this->validSubjectIds((array) ($_POST['subjects'] ?? []));
        $status = in_array($_POST['status'] ?? '', ['pending', 'enrolled'], true) ? $_POST['status'] : 'pending';
        if (!$term || !$section || !$subjects) {
            redirect($back, 'error', 'Choose a term, a section and at least one subject.');
        }
        $students = Database::fetchAll("SELECT * FROM `students` WHERE section_id = :sec AND deleted_at IS NULL ORDER BY last_name", ['sec' => $sectionId]);
        if (!$students) {
            redirect($back, 'error', "No student master records are assigned to {$section['name']}.");
        }
        $created = $skipped = 0;
        Database::beginTransaction();
        try {
            foreach ($students as $st) {
                if ($this->enrollmentExists((int) $st['id'], (int) $term['semester_id'])) {
                    $skipped++;
                    continue;
                }
                $this->createEnrollment($st, $term, (int) $section['program_id'], (int) $section['year_level'], $sectionId, $subjects, $status, 'Bulk section enrollment');
                $created++;
            }
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }
        redirect(url('analytics/registrar/enrollments', ['term' => (int) $term['semester_id'], 'section' => $sectionId]), 'success',
            "Bulk enrollment for {$section['name']}: {$created} created, {$skipped} skipped (already enrolled this term).");
    }

    /**
     * CSV: student_number[, subject codes separated by ; or |][, status]. Unknown numbers are reported, never created.
     */
    public function import(): void
    {
        $term = $this->postedTerm();
        $back = url('analytics/registrar/enrollments/create');
        if (!$term) {
            redirect($back, 'error', 'Choose a valid term.');
        }
        try {
            $rows = Csv::parseUpload($_FILES['csv'] ?? []);
        } catch (\RuntimeException $e) {
            redirect($back, 'error', $e->getMessage());
        }
        $defaultSubjects = $this->validSubjectIds((array) ($_POST['subjects'] ?? []));
        $defaultStatus = in_array($_POST['status'] ?? '', ['pending', 'enrolled'], true) ? $_POST['status'] : 'pending';

        $subjectByCode = [];
        foreach (Database::fetchAll("SELECT id, code FROM `subjects` WHERE deleted_at IS NULL") as $s) {
            $subjectByCode[strtoupper($s['code'])] = (int) $s['id'];
        }

        $created = [];
        $errors = [];
        $line = 0;
        Database::beginTransaction();
        try {
            foreach ($rows as $cols) {
                $line++;
                $number = $cols[0] ?? '';
                if ($line === 1 && preg_match('/student/i', $number)) {
                    continue;
                }
                $student = Database::fetchOne("SELECT * FROM `students` WHERE student_number = :n AND deleted_at IS NULL", ['n' => $number]);
                if (!$student) {
                    $errors[] = "Line {$line}: student number '{$number}' does not exist in the student registry.";
                    continue;
                }
                $subjects = $defaultSubjects;
                if (!empty($cols[1])) {
                    $subjects = [];
                    foreach (preg_split('/[;|]/', $cols[1]) as $code) {
                        $code = strtoupper(trim($code));
                        if ($code === '') {
                            continue;
                        }
                        if (!isset($subjectByCode[$code])) {
                            $errors[] = "Line {$line}: subject code '{$code}' does not exist.";
                            continue 2;
                        }
                        $subjects[] = $subjectByCode[$code];
                    }
                }
                if (!$subjects) {
                    $errors[] = "Line {$line}: no subjects given for {$number}.";
                    continue;
                }
                $status = in_array(strtolower($cols[2] ?? ''), ['pending', 'enrolled'], true) ? strtolower($cols[2]) : $defaultStatus;
                if ($this->enrollmentExists((int) $student['id'], (int) $term['semester_id'])) {
                    $errors[] = "Line {$line}: {$number} is already enrolled for {$term['label']}.";
                    continue;
                }
                $this->createEnrollment($student, $term, (int) $student['program_id'], (int) $student['year_level'], $student['section_id'] ? (int) $student['section_id'] : null, array_unique($subjects), $status, 'CSV import');
                $created[] = $number;
            }
            Database::commit();
        } catch (\Throwable $e) {
            Database::rollBack();
            throw $e;
        }
        View::render('analytics/Views/registrar/import_result', [
            'term' => $term, 'created' => $created, 'errors' => $errors,
            'title' => 'CSV Import Result', 'crumbs' => $this->crumbs('CSV import'),
        ]);
    }

    // ------------------------------------------------------------------
    // Status and subject load changes
    // ------------------------------------------------------------------

    public function updateStatus(string $id): void
    {
        $e = $this->findEnrollment($id);
        $back = url('analytics/registrar/enrollments/' . (int) $e['id']);
        $status = (string) ($_POST['status'] ?? '');
        $reason = trim((string) ($_POST['reason'] ?? ''));
        if (!in_array($status, self::STATUSES, true) || $status === $e['status']) {
            redirect($back, 'error', 'Choose a different, valid status.');
        }
        if (mb_strlen($reason) < 5) {
            redirect($back, 'error', 'A reason of at least 5 characters is required.');
        }
        $data = ['status' => $status, 'remarks' => mb_substr($reason, 0, 255), 'updated_at' => date('Y-m-d H:i:s')];
        if ($status === 'enrolled' && !$e['enrolled_at']) {
            $data['enrolled_at'] = date('Y-m-d H:i:s');
            $data['enrolled_by'] = (int) Auth::id();
        }
        Database::update('ana_enrollments', $data, 'id = :id', ['id' => (int) $e['id']]);
        ChangeLog::record('enrollment', (int) $e['id'], 'status_change', 'status', $e['status'], $status, $reason);
        Notifier::student((int) $e['student_id'], "Enrollment status: " . ucfirst($status), "{$e['term_label']} — {$reason}", 'analytics/my');
        redirect($back, 'success', 'Enrollment status updated to ' . $status . '.');
    }

    public function updateSubjects(string $id): void
    {
        $e = $this->findEnrollment($id);
        $back = url('analytics/registrar/enrollments/' . (int) $e['id']);
        $wanted = $this->validSubjectIds((array) ($_POST['subjects'] ?? []));
        $reason = trim((string) ($_POST['reason'] ?? ''));
        if (!$wanted) {
            redirect($back, 'error', 'Keep at least one subject; withdraw the enrollment instead to remove all.');
        }
        if (mb_strlen($reason) < 5) {
            redirect($back, 'error', 'A reason of at least 5 characters is required.');
        }
        $current = [];
        foreach ($e['subjects'] as $s) {
            $current[(int) $s['subject_id']] = $s['status'];
        }
        $added = $dropped = [];
        $now = date('Y-m-d H:i:s');
        Database::beginTransaction();
        try {
            foreach ($wanted as $subId) {
                if (!isset($current[$subId])) {
                    Database::insert('ana_enrollment_subjects', ['enrollment_id' => (int) $e['id'], 'subject_id' => $subId, 'section_id' => $e['section_id'], 'status' => 'enrolled', 'created_at' => $now]);
                    $added[] = $subId;
                } elseif ($current[$subId] === 'dropped') {
                    Database::update('ana_enrollment_subjects', ['status' => 'enrolled', 'updated_at' => $now], 'enrollment_id = :e AND subject_id = :s', ['e' => (int) $e['id'], 's' => $subId]);
                    $added[] = $subId;
                }
            }
            foreach ($current as $subId => $st) {
                if ($st === 'enrolled' && !in_array($subId, $wanted, true)) {
                    Database::update('ana_enrollment_subjects', ['status' => 'dropped', 'updated_at' => $now], 'enrollment_id = :e AND subject_id = :s', ['e' => (int) $e['id'], 's' => $subId]);
                    $dropped[] = $subId;
                }
            }
            ChangeLog::record('enrollment', (int) $e['id'], 'subject_load', 'subjects', 'dropped:' . implode(',', $dropped), 'added:' . implode(',', $added), $reason);
            Database::commit();
        } catch (\Throwable $ex) {
            Database::rollBack();
            throw $ex;
        }
        redirect($back, 'success', count($added) . ' subject(s) added, ' . count($dropped) . ' dropped.');
    }

    // ------------------------------------------------------------------
    // Masterlist, COR, posted grades, discrepancies
    // ------------------------------------------------------------------

    public function masterlist(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $_GET['status'] = 'enrolled';
        View::render('analytics/Views/registrar/masterlist', array_merge($this->lookups(), [
            'term' => $term, 'rows' => $term ? $this->enrollmentQuery($term) : [],
            'filters' => Ui::queryParams(['term', 'program', 'section', 'subject', 'q']),
            'title' => 'Masterlist', 'crumbs' => $this->crumbs('Masterlist'),
        ]));
    }

    public function cor(string $id): void
    {
        $e = $this->findEnrollment($id);
        View::render('analytics/Views/registrar/cor', ['e' => $e, 'title' => 'Certificate of Registration'], null);
    }

    private function postedClasses(?array $term): array
    {
        if (!$term) {
            return [];
        }
        return Database::fetchAll(
            "SELECT c.id, c.subject_code, c.subject_title, c.section_name, c.units, c.grade_status, c.posted_at,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name,
                    (SELECT COUNT(*) FROM `ana_class_grades` g WHERE g.class_id = c.id) AS graded
             FROM `ana_classes` c LEFT JOIN `users` u ON u.id = c.faculty_user_id
             WHERE c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked') AND c.semester_id = :sem
             ORDER BY c.subject_code, c.section_name",
            ['sem' => (int) $term['semester_id']]
        );
    }

    public function grades(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        View::render('analytics/Views/registrar/grades', array_merge($this->lookups(), [
            'term' => $term, 'rows' => $this->postedClasses($term),
            'title' => 'Posted Grades', 'crumbs' => $this->crumbs('Posted grades'),
        ]));
    }

    private function gradeSheetRows(int $classId): array
    {
        return Database::fetchAll(
            "SELECT s.student_number, s.last_name, s.first_name, s.middle_name, p.code AS program_code, g.final_grade, g.remarks, g.inc_deadline, g.inc_resolved_at
             FROM `ana_class_grades` g JOIN `students` s ON s.id = g.student_id LEFT JOIN `programs` p ON p.id = s.program_id
             WHERE g.class_id = :cid ORDER BY s.last_name, s.first_name",
            ['cid' => $classId]
        );
    }

    private function publishedClassOr404(string $id): array
    {
        $class = ClassRecord::details((int) $id);
        if (!$class || !ClassRecord::isPublished($class)) {
            AnalyticsAccess::notFound();
        }
        return $class;
    }

    public function gradeSheet(string $id): void
    {
        $class = $this->publishedClassOr404($id);
        View::render('analytics/Views/registrar/grade_sheet', [
            'class' => $class, 'rows' => $this->gradeSheetRows((int) $class['id']),
            'title' => 'Grade Sheet: ' . $class['subject_code'], 'crumbs' => ['Registrar' => url('analytics/registrar'), 'Posted grades' => url('analytics/registrar/grades'), $class['subject_code'] => ''],
        ]);
    }

    private function discrepancyRows(?array $term): array
    {
        if (!$term) {
            return [[], []];
        }
        $sem = (int) $term['semester_id'];
        $noRoster = Database::fetchAll(
            "SELECT s.id AS student_id, s.student_number, s.first_name, s.last_name, sub.code AS subject_code, sub.title AS subject_title, sec.name AS section_name
             FROM `ana_enrollment_subjects` es
             JOIN `ana_enrollments` e ON e.id = es.enrollment_id AND e.status = 'enrolled' AND e.semester_id = :sem1
             JOIN `students` s ON s.id = e.student_id
             JOIN `subjects` sub ON sub.id = es.subject_id
             LEFT JOIN `sections` sec ON sec.id = COALESCE(es.section_id, e.section_id)
             WHERE es.status = 'enrolled'
               AND NOT EXISTS (SELECT 1 FROM `ana_class_students` cs JOIN `ana_classes` c ON c.id = cs.class_id
                               WHERE cs.student_id = e.student_id AND cs.status = 'enrolled' AND c.subject_id = es.subject_id
                                 AND c.semester_id = e.semester_id AND c.deleted_at IS NULL)
             ORDER BY sub.code, s.last_name",
            ['sem1' => $sem]
        );
        $notEnrolled = Database::fetchAll(
            "SELECT s.id AS student_id, s.student_number, s.first_name, s.last_name, c.id AS class_id, c.subject_code, c.section_name,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name
             FROM `ana_class_students` cs
             JOIN `ana_classes` c ON c.id = cs.class_id AND c.deleted_at IS NULL AND c.semester_id = :sem2
             JOIN `students` s ON s.id = cs.student_id
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             WHERE cs.status = 'enrolled'
               AND NOT EXISTS (SELECT 1 FROM `ana_enrollment_subjects` es JOIN `ana_enrollments` e ON e.id = es.enrollment_id
                               WHERE e.student_id = cs.student_id AND e.semester_id = c.semester_id AND e.status = 'enrolled'
                                 AND es.subject_id = c.subject_id AND es.status = 'enrolled')
             ORDER BY c.subject_code, s.last_name",
            ['sem2' => $sem]
        );
        return [$noRoster, $notEnrolled];
    }

    public function discrepancies(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        [$noRoster, $notEnrolled] = $this->discrepancyRows($term);
        View::render('analytics/Views/registrar/discrepancies', array_merge($this->lookups(), [
            'term' => $term, 'noRoster' => $noRoster, 'notEnrolled' => $notEnrolled,
            'title' => 'Roster Discrepancies', 'crumbs' => $this->crumbs('Discrepancies'),
        ]));
    }

    public function export(string $type): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $stamp = date('Ymd');
        switch ($type) {
            case 'enrollments':
            case 'masterlist':
                if ($type === 'masterlist') {
                    $_GET['status'] = 'enrolled';
                }
                Csv::download("{$type}_{$stamp}.csv",
                    ['Student No.', 'Last Name', 'First Name', 'Middle Name', 'Program', 'Year', 'Section', 'Status', 'Subjects', 'Units', 'Has Login'],
                    array_map(fn($r) => [$r['student_number'], $r['last_name'], $r['first_name'], $r['middle_name'], $r['program_code'], $r['year_level'], $r['section_name'],
                        $r['status'], $r['subject_count'], $r['units'], $r['user_id'] ? 'yes' : 'no'], $term ? $this->enrollmentQuery($term) : []));
            case 'grades':
                $class = $this->publishedClassOr404((string) ($_GET['class_id'] ?? '0'));
                Csv::download("grades_{$class['subject_code']}_{$stamp}.csv",
                    ['Student No.', 'Last Name', 'First Name', 'Middle Name', 'Program', 'Final Grade', 'Remarks', 'INC Deadline', 'INC Resolved'],
                    array_map(fn($r) => [$r['student_number'], $r['last_name'], $r['first_name'], $r['middle_name'], $r['program_code'], $r['final_grade'], $r['remarks'],
                        $r['inc_deadline'], $r['inc_resolved_at']], $this->gradeSheetRows((int) $class['id'])));
            case 'discrepancies':
                [$noRoster, $notEnrolled] = $this->discrepancyRows($term);
                $rows = [];
                foreach ($noRoster as $r) {
                    $rows[] = ['Enrolled but not on any class roster', $r['student_number'], $r['last_name'], $r['first_name'], $r['subject_code'], $r['section_name'], ''];
                }
                foreach ($notEnrolled as $r) {
                    $rows[] = ['On a roster but not officially enrolled', $r['student_number'], $r['last_name'], $r['first_name'], $r['subject_code'], $r['section_name'], $r['faculty_name']];
                }
                Csv::download("roster_discrepancies_{$stamp}.csv", ['Issue', 'Student No.', 'Last Name', 'First Name', 'Subject', 'Section', 'Faculty'], $rows);
            default:
                AnalyticsAccess::notFound();
        }
    }
}
