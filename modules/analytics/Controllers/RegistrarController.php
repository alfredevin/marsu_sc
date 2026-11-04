<?php
namespace Modules\Analytics\Controllers;

use Core\Auth;
use Core\Database;
use Core\View;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Csv;
use Modules\Analytics\Support\Ui;

/**
 * Registrar workspace. SPAMS is not an enrollment system: the Registrar imports the official
 * enrollment records from the school's enrollment system, and those records build class rosters.
 * Students are never created here, and records are never encoded or edited by hand.
 */
class RegistrarController
{
    private const STATUSES = ['pending', 'enrolled', 'withdrawn', 'cancelled'];
    private const IMPORT_STATUSES = ['enrolled', 'withdrawn'];

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
    // Import official enrollment records (CSV from the school's enrollment system)
    // ------------------------------------------------------------------

    public function importForm(): void
    {
        View::render('analytics/Views/registrar/import', [
            'terms' => AnalyticsAccess::terms(), 'activeTerm' => AnalyticsAccess::activeTerm(),
            'title' => 'Import Enrollment Records', 'crumbs' => $this->crumbs('Import'),
        ]);
    }

    /**
     * CSV: student_number, subject codes separated by ; or |, optional status (enrolled / withdrawn).
     * Enrollment itself happens in the school's enrollment system; this only copies its records.
     * Unknown numbers are reported, never created. Re-importing a record only syncs its status.
     */
    public function import(): void
    {
        $term = $this->postedTerm();
        $back = url('analytics/registrar/import');
        if (!$term) {
            redirect($back, 'error', 'Choose a valid term.');
        }
        try {
            $rows = Csv::parseUpload($_FILES['csv'] ?? []);
        } catch (\RuntimeException $e) {
            redirect($back, 'error', $e->getMessage());
        }

        $subjectByCode = [];
        foreach (Database::fetchAll("SELECT id, code FROM `subjects` WHERE deleted_at IS NULL") as $s) {
            $subjectByCode[strtoupper($s['code'])] = (int) $s['id'];
        }

        $created = [];
        $updated = [];
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
                $status = strtolower(trim((string) ($cols[2] ?? '')));
                $status = in_array($status, self::IMPORT_STATUSES, true) ? $status : 'enrolled';
                $existing = Database::fetchOne(
                    "SELECT id, status FROM `ana_enrollments` WHERE student_id = :s AND semester_id = :t",
                    ['s' => (int) $student['id'], 't' => (int) $term['semester_id']]
                );
                if ($existing) {
                    if ($existing['status'] !== $status) {
                        Database::update('ana_enrollments', ['status' => $status, 'remarks' => 'CSV import sync', 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $existing['id']]);
                        ChangeLog::record('enrollment', (int) $existing['id'], 'status_change', 'status', $existing['status'], $status, 'Synced from official enrollment records');
                        $updated[] = "{$number}: {$existing['status']} → {$status}";
                    }
                    continue;
                }
                $subjects = [];
                foreach (preg_split('/[;|]/', (string) ($cols[1] ?? '')) as $code) {
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
                if (!$subjects) {
                    $errors[] = "Line {$line}: no subject codes given for {$number}.";
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
            'term' => $term, 'created' => $created, 'updated' => $updated, 'errors' => $errors,
            'title' => 'CSV Import Result', 'crumbs' => $this->crumbs('CSV import'),
        ]);
    }

    // ------------------------------------------------------------------
    // Masterlist, posted grades, discrepancies
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
