<?php
namespace Modules\Analytics\Controllers;

use Core\Database;
use Core\Session;
use Core\View;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\AnalyticsSettings;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Csv;
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\Ui;

/**
 * Landing dispatcher and read-only Monitoring & Oversight pages.
 * Every query applies AnalyticsAccess program scope.
 */
class HomeController
{
    // ------------------------------------------------------------------
    // Dispatcher
    // ------------------------------------------------------------------

    public function index(): void
    {
        $persona = AnalyticsAccess::persona();
        $personas = AnalyticsAccess::personas();
        if ($persona === null || !isset($personas[$persona])) {
            AnalyticsAccess::forbidden('analytics.*');
        }
        redirect(url($personas[$persona]['url']));
    }

    public function switchPersona(): void
    {
        $key = (string) ($_POST['persona'] ?? '');
        if (!AnalyticsAccess::setPersona($key)) {
            redirect(url('analytics'), 'error', 'That workspace is not available to your account.');
        }
        redirect(url(AnalyticsAccess::personas()[$key]['url']));
    }

    public function legacyStudents(): void
    {
        redirect(url('analytics/students'));
    }

    public function legacyClassRecords(): void
    {
        redirect(url('analytics/class-records'));
    }

    // ------------------------------------------------------------------
    // Shared filters
    // ------------------------------------------------------------------

    private function programFilter(): ?int
    {
        $id = (int) ($_GET['program'] ?? 0);
        if ($id <= 0) {
            return null;
        }
        $scope = AnalyticsAccess::scopedProgramIds();
        if ($scope !== null && !in_array($id, $scope, true)) {
            return null;
        }
        return $id;
    }

    /**
     * Term filter for class-based queries. Returns [sql, params].
     */
    private function classFilters(?array $term, ?int $programId, string $alias = 'c'): array
    {
        $sql = " AND {$alias}.deleted_at IS NULL" . AnalyticsAccess::classScopeSql($alias);
        $params = [];
        if ($term) {
            $sql .= " AND {$alias}.semester_id = :f_sem";
            $params['f_sem'] = (int) $term['semester_id'];
        }
        if ($programId) {
            $sql .= ' AND ' . AnalyticsAccess::classProgramExpr($alias) . ' = :f_prog';
            $params['f_prog'] = $programId;
        }
        return [$sql, $params];
    }

    private function baseData(string $title, array $crumbs): array
    {
        return [
            'title'      => $title,
            'crumbs'     => array_merge(['Academic Analytics' => url('analytics/overview')], $crumbs),
            'terms'      => AnalyticsAccess::terms(),
            'programs'   => AnalyticsAccess::scopedPrograms(),
            'activeTerm' => AnalyticsAccess::activeTerm(),
            'scopeNote'  => $this->scopeNote(),
        ];
    }

    private function scopeNote(): string
    {
        $ids = AnalyticsAccess::scopedProgramIds();
        if ($ids === null) {
            return 'All programs';
        }
        if (empty($ids)) {
            return 'No programs are mapped to your account. Ask the administrator to map your programs.';
        }
        $codes = array_column(AnalyticsAccess::scopedPrograms(), 'code');
        return 'Programs: ' . implode(', ', $codes);
    }

    // ------------------------------------------------------------------
    // Overview
    // ------------------------------------------------------------------

    public function overview(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        [$cf, $cp] = $this->classFilters($term, $programId);

        $studentScope = AnalyticsAccess::studentScopeSql('s');
        $studentParams = [];
        $studentProgSql = '';
        if ($programId) {
            $studentProgSql = ' AND s.program_id = :sprog';
            $studentParams['sprog'] = $programId;
        }
        $totalStudents = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `students` s WHERE s.deleted_at IS NULL{$studentScope}{$studentProgSql}",
            $studentParams
        );

        $enrollment = ['enrolled' => 0, 'pending' => 0, 'withdrawn' => 0, 'cancelled' => 0];
        if ($term) {
            $ep = ['sem' => (int) $term['semester_id']];
            $eps = '';
            if ($programId) {
                $eps = ' AND e.program_id = :eprog';
                $ep['eprog'] = $programId;
            }
            foreach (Database::fetchAll(
                "SELECT e.status, COUNT(*) AS n FROM `ana_enrollments` e
                 WHERE e.semester_id = :sem" . AnalyticsAccess::programScopeSql('e.program_id') . "{$eps}
                 GROUP BY e.status",
                $ep
            ) as $r) {
                $enrollment[$r['status']] = (int) $r['n'];
            }
        }

        $classStats = Database::fetchOne(
            "SELECT COUNT(*) AS total,
                    COALESCE(SUM(c.grade_status IN ('posted', 'locked')), 0) AS published,
                    COALESCE(SUM(c.grade_status = 'draft'), 0) AS draft
             FROM `ana_classes` c WHERE 1 = 1{$cf}",
            $cp
        );

        $grades = ['PASSED' => 0, 'FAILED' => 0, 'INC' => 0, 'DRP' => 0];
        foreach (Database::fetchAll(
            "SELECT g.remarks, COUNT(*) AS n FROM `ana_class_grades` g
             JOIN `ana_classes` c ON c.id = g.class_id
             WHERE c.grade_status IN ('posted', 'locked'){$cf}
             GROUP BY g.remarks",
            $cp
        ) as $r) {
            $grades[$r['remarks']] = (int) $r['n'];
        }
        $gradedTotal = array_sum($grades);

        $att = Database::fetchOne(
            "SELECT COALESCE(SUM(a.status = 'Present'), 0) AS present, COALESCE(SUM(a.status = 'Late'), 0) AS late,
                    COALESCE(SUM(a.status = 'Excused'), 0) AS excused, COALESCE(SUM(a.status = 'Absent'), 0) AS absent,
                    COUNT(*) AS total
             FROM `ana_attendance_records` a JOIN `ana_classes` c ON c.id = a.class_id
             WHERE a.voided_at IS NULL{$cf}",
            $cp
        );

        [$cfAll, $cpAll] = $this->classFilters(null, $programId);
        $openInc = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_class_grades` g JOIN `ana_classes` c ON c.id = g.class_id
             WHERE g.remarks = 'INC' AND g.inc_resolved_at IS NULL AND c.grade_status IN ('posted', 'locked'){$cfAll}",
            $cpAll
        );
        $pendingCorrections = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_grade_change_requests` r JOIN `ana_classes` c ON c.id = r.class_id
             WHERE r.status = 'pending'{$cfAll}",
            $cpAll
        );

        $subjectRows = $this->subjectPerformanceRows($term, $programId);
        usort($subjectRows, fn($a, $b) => $b['graded'] <=> $a['graded']);
        $subjectRows = array_slice($subjectRows, 0, 12);

        $enrollByProgram = [];
        if ($term) {
            $ep = ['sem' => (int) $term['semester_id']];
            $enrollByProgram = Database::fetchAll(
                "SELECT p.code, COUNT(*) AS n FROM `ana_enrollments` e JOIN `programs` p ON p.id = e.program_id
                 WHERE e.semester_id = :sem AND e.status = 'enrolled'" . AnalyticsAccess::programScopeSql('e.program_id') . "
                 GROUP BY p.code ORDER BY p.code",
                $ep
            );
        }

        $notes = [];
        if (can('analytics.admin.settings')) {
            $notes = Database::fetchAll(
                "SELECT n.*, CONCAT(u.first_name, ' ', u.last_name) AS author
                 FROM `ana_dashboard_notes` n LEFT JOIN `users` u ON u.id = n.created_by
                 WHERE n.status = 'active' ORDER BY n.id DESC LIMIT 10"
            );
        }

        View::render('analytics/Views/overview', array_merge($this->baseData('Academic Monitoring Overview', ['Overview' => '']), [
            'term'               => $term,
            'programId'          => $programId,
            'totalStudents'      => $totalStudents,
            'enrollment'         => $enrollment,
            'classStats'         => $classStats,
            'grades'             => $grades,
            'gradedTotal'        => $gradedTotal,
            'attendance'         => $att,
            'attendanceRate'     => GradeCalculator::attendanceRate($att ?: []),
            'openInc'            => $openInc,
            'pendingCorrections' => $pendingCorrections,
            'subjectRows'        => $subjectRows,
            'enrollByProgram'    => $enrollByProgram,
            'notes'              => $notes,
        ]));
    }

    // ------------------------------------------------------------------
    // Students
    // ------------------------------------------------------------------

    private function studentQuery(?array $term, bool $countOnly, ?array $page = null): array
    {
        $params = ['esem' => $term ? (int) $term['semester_id'] : 0];
        $where = 's.deleted_at IS NULL' . AnalyticsAccess::studentScopeSql('s');

        $q = trim((string) ($_GET['q'] ?? ''));
        if ($q !== '') {
            $where .= " AND (s.student_number LIKE :q1 OR CONCAT(s.first_name, ' ', s.last_name) LIKE :q2 OR CONCAT(s.last_name, ', ', s.first_name) LIKE :q3)";
            $params['q1'] = $params['q2'] = $params['q3'] = '%' . $q . '%';
        }
        if ($programId = $this->programFilter()) {
            $where .= ' AND s.program_id = :prog';
            $params['prog'] = $programId;
        }
        $year = (int) ($_GET['year'] ?? 0);
        if ($year > 0) {
            $where .= ' AND s.year_level = :yr';
            $params['yr'] = $year;
        }
        $section = (int) ($_GET['section'] ?? 0);
        if ($section > 0) {
            $where .= ' AND s.section_id = :sec';
            $params['sec'] = $section;
        }
        $status = (string) ($_GET['status'] ?? '');
        if (in_array($status, ['pending', 'enrolled', 'withdrawn', 'cancelled'], true)) {
            $where .= ' AND e.status = :est';
            $params['est'] = $status;
        } elseif ($status === 'none') {
            $where .= ' AND e.id IS NULL';
        }

        $from = "FROM `students` s
                 LEFT JOIN `ana_enrollments` e ON e.student_id = s.id AND e.semester_id = :esem
                 LEFT JOIN `programs` p ON p.id = s.program_id
                 LEFT JOIN `sections` sec ON sec.id = s.section_id
                 WHERE {$where}";

        if ($countOnly) {
            return [(int) Database::fetchColumn("SELECT COUNT(*) {$from}", $params)];
        }
        $limit = $page ? (' LIMIT ' . (int) $page['per_page'] . ' OFFSET ' . (int) $page['offset']) : '';
        return Database::fetchAll(
            "SELECT s.id, s.student_number, s.first_name, s.middle_name, s.last_name, s.year_level, s.gender, s.user_id,
                    p.code AS program_code, sec.name AS section_name, e.status AS term_status, e.id AS enrollment_id
             {$from}
             ORDER BY s.last_name, s.first_name{$limit}",
            $params
        );
    }

    public function students(): void
    {
        $this->renderStudents('analytics/students', 'Students');
    }

    public function studentProfiles(): void
    {
        $this->renderStudents('analytics/profile', 'Student Profiles');
    }

    private function renderStudents(string $listRoute, string $heading): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $total = $this->studentQuery($term, true)[0];
        $page = Ui::paginate($total, 25);
        $rows = $this->studentQuery($term, false, $page);

        $sectionParams = [];
        $sections = Database::fetchAll(
            "SELECT sec.id, sec.name, p.code AS program_code FROM `sections` sec JOIN `programs` p ON p.id = sec.program_id
             WHERE sec.deleted_at IS NULL" . AnalyticsAccess::programScopeSql('sec.program_id') . " ORDER BY p.code, sec.year_level, sec.name",
            $sectionParams
        );

        View::render('analytics/Views/students', array_merge($this->baseData($heading, [$heading => '']), [
            'listRoute'  => $listRoute,
            'heading'    => $heading,
            'term'       => $term,
            'rows'       => $rows,
            'pagination' => $page,
            'sections'   => $sections,
            'filters'    => Ui::queryParams(['q', 'program', 'year', 'section', 'status', 'term']),
        ]));
    }

    public function exportStudents(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $rows = $this->studentQuery($term, false);
        Csv::download('students_' . date('Ymd') . '.csv',
            ['Student No.', 'Last Name', 'First Name', 'Middle Name', 'Program', 'Year', 'Section', 'Term Status'],
            array_map(fn($r) => [$r['student_number'], $r['last_name'], $r['first_name'], $r['middle_name'], $r['program_code'], $r['year_level'], $r['section_name'], $r['term_status'] ?? 'not enrolled'], $rows)
        );
    }

    public function studentDossier(string $id): void
    {
        $studentId = (int) $id;
        if (!AnalyticsAccess::canMonitorStudent($studentId)) {
            AnalyticsAccess::notFound();
        }

        $student = Database::fetchOne(
            "SELECT s.*, p.code AS program_code, p.name AS program_name, sec.name AS section_name
             FROM `students` s
             LEFT JOIN `programs` p ON p.id = s.program_id
             LEFT JOIN `sections` sec ON sec.id = s.section_id
             WHERE s.id = :id",
            ['id' => $studentId]
        );

        $enrollments = Database::fetchAll(
            "SELECT e.*, sem.name AS semester_name, ay.label AS academic_year_label, p.code AS program_code, sec.name AS section_name,
                    (SELECT COUNT(*) FROM `ana_enrollment_subjects` es WHERE es.enrollment_id = e.id AND es.status = 'enrolled') AS subject_count,
                    (SELECT COALESCE(SUM(sub.units), 0) FROM `ana_enrollment_subjects` es JOIN `subjects` sub ON sub.id = es.subject_id
                      WHERE es.enrollment_id = e.id AND es.status = 'enrolled') AS total_units
             FROM `ana_enrollments` e
             JOIN `semesters` sem ON sem.id = e.semester_id
             JOIN `academic_years` ay ON ay.id = e.academic_year_id
             LEFT JOIN `programs` p ON p.id = e.program_id
             LEFT JOIN `sections` sec ON sec.id = e.section_id
             WHERE e.student_id = :sid
             ORDER BY ay.start_date DESC, sem.code DESC",
            ['sid' => $studentId]
        );

        $classRows = Database::fetchAll(
            "SELECT c.* FROM `ana_class_students` cs JOIN `ana_classes` c ON c.id = cs.class_id
             WHERE cs.student_id = :sid AND cs.status = 'enrolled' AND c.deleted_at IS NULL
             ORDER BY c.semester_id DESC, c.subject_code",
            ['sid' => $studentId]
        );
        $classes = [];
        $gwaByTerm = [];
        foreach ($classRows as $c) {
            $details = ClassRecord::details((int) $c['id']);
            if (!$details) {
                continue;
            }
            $rec = ClassRecord::load($details, $studentId);
            $published = ClassRecord::isPublished($details);
            $posted = $rec['posted'][$studentId] ?? null;
            $computed = $rec['computed'][$studentId] ?? null;
            $att = $rec['attendance'][$studentId] ?? ClassRecord::emptyAttendance();
            $classes[] = [
                'class'      => $details,
                'published'  => $published,
                'posted'     => $published ? $posted : null,
                'computed'   => $computed,
                'scheme'     => $rec['scheme'],
                'scores'     => $rec['scores'][$studentId] ?? [],
                'statuses'   => $rec['statuses'][$studentId] ?? [],
                'attendance' => $att,
                'attRate'    => GradeCalculator::attendanceRate($att),
            ];
            if ($published && $posted) {
                $termKey = $details['semester_name'] . ', ' . $details['academic_year_label'];
                $gwaByTerm[$termKey][] = ['final_grade' => $posted['final_grade'], 'units' => $details['subject_units']];
            }
        }
        $gwa = [];
        foreach ($gwaByTerm as $label => $rows) {
            $gwa[$label] = GradeCalculator::gwa($rows);
        }

        $conduct = Database::fetchAll(
            "SELECT b.*, c.subject_code, CONCAT(u.first_name, ' ', u.last_name) AS reporter
             FROM `ana_behavior_records` b
             LEFT JOIN `ana_classes` c ON c.id = b.class_id
             LEFT JOIN `users` u ON u.id = b.reported_by
             WHERE b.student_id = :sid AND b.deleted_at IS NULL
             ORDER BY b.incident_date DESC",
            ['sid' => $studentId]
        );
        $profile = Database::fetchOne("SELECT * FROM `ana_student_profiles` WHERE student_id = :sid", ['sid' => $studentId]);

        View::render('analytics/Views/student_dossier', array_merge($this->baseData('Student Dossier', ['Students' => url('analytics/students'), 'Dossier' => '']), [
            'student'     => $student,
            'enrollments' => $enrollments,
            'classes'     => $classes,
            'gwa'         => $gwa,
            'conduct'     => $conduct,
            'profile'     => $profile,
        ]));
    }

    // ------------------------------------------------------------------
    // Class records (read-only)
    // ------------------------------------------------------------------

    public function classRecords(): void
    {
        $this->renderClassRecords('Class Records');
    }

    public function gradesTracking(): void
    {
        $this->renderClassRecords('Class Records (Read-only)');
    }

    public function progressReports(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        [$cf, $cp] = $this->classFilters($term, $programId);
        $rows = Database::fetchAll(
            "SELECT s.id AS student_id, s.student_number, s.first_name, s.last_name, s.year_level, p.code AS program_code,
                    COUNT(g.id) AS subjects,
                    COALESCE(SUM(c.units), 0) AS units,
                    COALESCE(SUM(g.remarks = 'PASSED'), 0) AS passed,
                    COALESCE(SUM(g.remarks = 'FAILED'), 0) AS failed,
                    COALESCE(SUM(g.remarks = 'INC' AND g.inc_resolved_at IS NULL), 0) AS open_inc,
                    COALESCE(SUM(g.remarks = 'DRP'), 0) AS drp,
                    SUM(CASE WHEN g.remarks IN ('PASSED', 'FAILED') THEN CAST(g.final_grade AS DECIMAL(5,2)) * c.units END)
                      / NULLIF(SUM(CASE WHEN g.remarks IN ('PASSED', 'FAILED') THEN c.units END), 0) AS gwa
             FROM `ana_class_grades` g
             JOIN `ana_classes` c ON c.id = g.class_id
             JOIN `students` s ON s.id = g.student_id
             LEFT JOIN `programs` p ON p.id = s.program_id
             WHERE c.grade_status IN ('posted', 'locked') AND s.deleted_at IS NULL{$cf}
             GROUP BY s.id, s.student_number, s.first_name, s.last_name, s.year_level, p.code
             ORDER BY failed DESC, open_inc DESC, s.last_name",
            $cp
        );
        View::render('analytics/Views/progressreports', array_merge($this->baseData('Academic Progress Reports', ['Progress Reports' => '']), [
            'term'      => $term,
            'programId' => $programId,
            'rows'      => $rows,
        ]));
    }

    private function renderClassRecords(string $heading): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        [$cf, $cp] = $this->classFilters($term, $programId);

        $status = (string) ($_GET['status'] ?? '');
        if (in_array($status, ['draft', 'posted', 'locked'], true)) {
            $cf .= ' AND c.grade_status = :gst';
            $cp['gst'] = $status;
        }
        $q = trim((string) ($_GET['q'] ?? ''));
        if ($q !== '') {
            $cf .= " AND (c.subject_code LIKE :q1 OR c.subject_title LIKE :q2 OR c.section_name LIKE :q3 OR CONCAT(u.first_name, ' ', u.last_name) LIKE :q4)";
            $cp['q1'] = $cp['q2'] = $cp['q3'] = $cp['q4'] = '%' . $q . '%';
        }

        $rows = Database::fetchAll(
            "SELECT c.id, c.class_code, c.subject_code, c.subject_title, c.units, c.section_name, c.grade_status, c.posted_at,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name,
                    sem.name AS semester_name, ay.label AS academic_year_label,
                    (SELECT COUNT(*) FROM `ana_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') AS enrolled_count
             FROM `ana_classes` c
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             LEFT JOIN `semesters` sem ON sem.id = c.semester_id
             LEFT JOIN `academic_years` ay ON ay.id = c.academic_year_id
             WHERE 1 = 1{$cf}
             ORDER BY c.subject_code, c.section_name",
            $cp
        );

        View::render('analytics/Views/class_records', array_merge($this->baseData($heading, [$heading => '']), [
            'heading'   => $heading,
            'term'      => $term,
            'programId' => $programId,
            'rows'      => $rows,
            'filters'   => Ui::queryParams(['q', 'program', 'status', 'term']),
        ]));
    }

    public function classRecordView(string $id): void
    {
        $classId = (int) $id;
        if (!AnalyticsAccess::canSeeClass($classId)) {
            AnalyticsAccess::notFound();
        }
        $class = ClassRecord::details($classId);
        if (!$class) {
            AnalyticsAccess::notFound();
        }
        $record = ClassRecord::load($class);

        View::render('analytics/Views/class_record_readonly', array_merge($this->baseData('Class Record (Read-only)', ['Class Records' => url('analytics/class-records'), $class['subject_code'] => '']), [
            'class'     => $class,
            'record'    => $record,
            'published' => ClassRecord::isPublished($class),
        ]));
    }

    // ------------------------------------------------------------------
    // Subject performance
    // ------------------------------------------------------------------

    private function subjectPerformanceRows(?array $term, ?int $programId): array
    {
        [$cf, $cp] = $this->classFilters($term, $programId);
        $rows = Database::fetchAll(
            "SELECT c.subject_code, MAX(c.subject_title) AS subject_title,
                    COUNT(DISTINCT c.id) AS classes, COUNT(g.id) AS graded,
                    COALESCE(SUM(g.remarks = 'PASSED'), 0) AS passed, COALESCE(SUM(g.remarks = 'FAILED'), 0) AS failed,
                    COALESCE(SUM(g.remarks = 'INC'), 0) AS inc, COALESCE(SUM(g.remarks = 'DRP'), 0) AS drp,
                    AVG(CASE WHEN g.remarks IN ('PASSED', 'FAILED') THEN CAST(g.final_grade AS DECIMAL(5,2)) END) AS mean_grade
             FROM `ana_classes` c
             JOIN `ana_class_grades` g ON g.class_id = c.id
             WHERE c.grade_status IN ('posted', 'locked'){$cf}
             GROUP BY c.subject_code
             ORDER BY c.subject_code",
            $cp
        );
        foreach ($rows as &$r) {
            $r['graded'] = (int) $r['graded'];
            $r['pass_rate'] = $r['graded'] > 0 ? (int) $r['passed'] / $r['graded'] : null;
            $r['mean_grade'] = $r['mean_grade'] !== null ? round((float) $r['mean_grade'], 2) : null;
        }
        return $rows;
    }

    public function subjectPerformance(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        View::render('analytics/Views/subjectperformance', array_merge($this->baseData('Subject Performance', ['Subject Performance' => '']), [
            'term'      => $term,
            'programId' => $programId,
            'rows'      => $this->subjectPerformanceRows($term, $programId),
            'threshold' => AnalyticsSettings::get('analytics.bottleneck_passing_rate'),
        ]));
    }

    // ------------------------------------------------------------------
    // Failed / INC
    // ------------------------------------------------------------------

    private function failedIncRows(?array $term, ?int $programId): array
    {
        [$cf, $cp] = $this->classFilters($term, $programId);
        $type = (string) ($_GET['type'] ?? '');
        $remarksSql = "g.remarks IN ('FAILED', 'INC')";
        if ($type === 'FAILED' || $type === 'INC') {
            $remarksSql = 'g.remarks = :rtype';
            $cp['rtype'] = $type;
        }
        if (($_GET['open'] ?? '') === '1') {
            $remarksSql .= ' AND g.inc_resolved_at IS NULL';
        }
        return Database::fetchAll(
            "SELECT g.id AS grade_id, g.final_grade, g.remarks, g.inc_deadline, g.inc_resolved_at, g.posted_at,
                    DATEDIFF(g.inc_deadline, CURDATE()) AS days_left,
                    s.id AS student_id, s.student_number, s.first_name, s.last_name, p.code AS program_code,
                    c.id AS class_id, c.subject_code, c.subject_title, c.section_name,
                    CONCAT(u.first_name, ' ', u.last_name) AS faculty_name
             FROM `ana_class_grades` g
             JOIN `ana_classes` c ON c.id = g.class_id
             JOIN `students` s ON s.id = g.student_id
             LEFT JOIN `programs` p ON p.id = s.program_id
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             WHERE {$remarksSql} AND c.grade_status IN ('posted', 'locked'){$cf}
             ORDER BY g.remarks DESC, g.inc_deadline IS NULL, g.inc_deadline, s.last_name",
            $cp
        );
    }

    public function failedIncomplete(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        View::render('analytics/Views/failedincompletemonitoring', array_merge($this->baseData('Failed / INC Monitoring', ['Failed / INC' => '']), [
            'term'           => $term,
            'programId'      => $programId,
            'rows'           => $this->failedIncRows($term, $programId),
            'incWindowDays'  => AnalyticsSettings::get('grading.inc_removal_days'),
            'filters'        => Ui::queryParams(['program', 'term', 'type', 'open']),
        ]));
    }

    // ------------------------------------------------------------------
    // Attendance
    // ------------------------------------------------------------------

    private function attendanceClassRows(?array $term, ?int $programId): array
    {
        [$cf, $cp] = $this->classFilters($term, $programId);
        $rows = Database::fetchAll(
            "SELECT c.id, c.subject_code, c.section_name, CONCAT(u.first_name, ' ', u.last_name) AS faculty_name,
                    COUNT(DISTINCT a.session_date) AS sessions, COUNT(a.id) AS total,
                    COALESCE(SUM(a.status = 'Present'), 0) AS present, COALESCE(SUM(a.status = 'Late'), 0) AS late,
                    COALESCE(SUM(a.status = 'Excused'), 0) AS excused, COALESCE(SUM(a.status = 'Absent'), 0) AS absent
             FROM `ana_classes` c
             JOIN `ana_attendance_records` a ON a.class_id = c.id AND a.voided_at IS NULL
             LEFT JOIN `users` u ON u.id = c.faculty_user_id
             WHERE 1 = 1{$cf}
             GROUP BY c.id, c.subject_code, c.section_name, u.first_name, u.last_name
             ORDER BY c.subject_code, c.section_name",
            $cp
        );
        foreach ($rows as &$r) {
            $r['rate'] = GradeCalculator::attendanceRate($r);
        }
        return $rows;
    }

    private function attendanceStudentRows(?array $term, ?int $programId): array
    {
        [$cf, $cp] = $this->classFilters($term, $programId);
        $rows = Database::fetchAll(
            "SELECT s.id AS student_id, s.student_number, s.first_name, s.last_name, c.id AS class_id, c.subject_code, c.section_name,
                    (SELECT COUNT(DISTINCT a2.session_date) FROM `ana_attendance_records` a2 WHERE a2.class_id = c.id AND a2.voided_at IS NULL) AS sessions,
                    COUNT(a.id) AS total,
                    COALESCE(SUM(a.status = 'Present'), 0) AS present, COALESCE(SUM(a.status = 'Late'), 0) AS late,
                    COALESCE(SUM(a.status = 'Excused'), 0) AS excused, COALESCE(SUM(a.status = 'Absent'), 0) AS absent
             FROM `ana_attendance_records` a
             JOIN `ana_classes` c ON c.id = a.class_id
             JOIN `students` s ON s.id = a.student_id
             WHERE a.voided_at IS NULL{$cf}
             GROUP BY s.id, s.student_number, s.first_name, s.last_name, c.id, c.subject_code, c.section_name
             ORDER BY absent DESC, s.last_name",
            $cp
        );
        foreach ($rows as &$r) {
            $r['rate'] = GradeCalculator::attendanceRate($r);
            $r['allowed'] = AnalyticsSettings::allowedAbsences((int) $r['sessions']);
            $r['over_limit'] = $r['allowed'] !== null && (int) $r['absent'] > $r['allowed'];
        }
        return $rows;
    }

    public function attendanceRecords(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        [$cf, $cp] = $this->classFilters($term, $programId);

        $classFilter = (int) ($_GET['class_id'] ?? 0);
        $recentWhere = "a.voided_at IS NULL{$cf}";
        if ($classFilter > 0) {
            $recentWhere .= ' AND c.id = :fcid';
            $cp['fcid'] = $classFilter;
        }
        $total = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_attendance_records` a JOIN `ana_classes` c ON c.id = a.class_id WHERE {$recentWhere}",
            $cp
        );
        $page = Ui::paginate($total, 30);
        $recent = Database::fetchAll(
            "SELECT a.id, a.session_date, a.status, a.remarks, s.student_number, s.first_name, s.last_name,
                    c.subject_code, c.section_name, CONCAT(u.first_name, ' ', u.last_name) AS recorded_by_name
             FROM `ana_attendance_records` a
             JOIN `ana_classes` c ON c.id = a.class_id
             LEFT JOIN `students` s ON s.id = a.student_id
             LEFT JOIN `users` u ON u.id = a.recorded_by
             WHERE {$recentWhere}
             ORDER BY a.session_date DESC, a.id DESC
             LIMIT {$page['per_page']} OFFSET {$page['offset']}",
            $cp
        );

        View::render('analytics/Views/attendancerecords', array_merge($this->baseData('Attendance Records', ['Attendance' => '']), [
            'term'        => $term,
            'programId'   => $programId,
            'classRows'   => $this->attendanceClassRows($term, $programId),
            'studentRows' => array_values(array_filter($this->attendanceStudentRows($term, $programId), fn($r) => $r['over_limit'])),
            'recent'      => $recent,
            'pagination'  => $page,
            'classFilter' => $classFilter,
            'ratio'       => AnalyticsSettings::get('attendance.max_absence_ratio'),
            'lateWeight'  => AnalyticsSettings::get('attendance.late_weight'),
            'filters'     => Ui::queryParams(['program', 'term', 'class_id']),
        ]));
    }

    // ------------------------------------------------------------------
    // Participation & engagement
    // ------------------------------------------------------------------

    private function participationRows(?array $term, ?int $programId): array
    {
        [$cf, $cp] = $this->classFilters($term, $programId);
        $rows = Database::fetchAll(
            "SELECT s.id AS student_id, s.student_number, s.first_name, s.last_name, c.id AS class_id, c.subject_code, c.section_name,
                    COUNT(sc.id) AS recorded,
                    COALESCE(SUM(sc.submission_status = 'submitted'), 0) AS submitted,
                    COALESCE(SUM(sc.submission_status = 'late'), 0) AS late,
                    COALESCE(SUM(sc.submission_status = 'missing'), 0) AS missing,
                    COALESCE(SUM(sc.submission_status = 'excused'), 0) AS excused
             FROM `ana_class_scores` sc
             JOIN `ana_classes` c ON c.id = sc.class_id
             JOIN `ana_class_students` cs ON cs.class_id = c.id AND cs.student_id = sc.student_id AND cs.status = 'enrolled'
             JOIN `students` s ON s.id = sc.student_id
             WHERE 1 = 1{$cf}
             GROUP BY s.id, s.student_number, s.first_name, s.last_name, c.id, c.subject_code, c.section_name
             ORDER BY missing DESC, s.last_name",
            $cp
        );
        foreach ($rows as &$r) {
            $denom = (int) $r['recorded'] - (int) $r['excused'];
            $r['compliance'] = $denom > 0 ? ((int) $r['submitted'] + (int) $r['late']) / $denom : null;
        }
        return $rows;
    }

    public function participation(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        View::render('analytics/Views/participationtracking', array_merge($this->baseData('Participation Tracking', ['Participation' => '']), [
            'term'      => $term,
            'programId' => $programId,
            'rows'      => $this->participationRows($term, $programId),
        ]));
    }

    private function engagementRows(?array $term, ?int $programId): array
    {
        $byKey = [];
        foreach ($this->attendanceStudentRows($term, $programId) as $r) {
            $k = $r['student_id'] . ':' . $r['class_id'];
            $byKey[$k] = ['student_id' => $r['student_id'], 'student_number' => $r['student_number'], 'first_name' => $r['first_name'],
                          'last_name' => $r['last_name'], 'subject_code' => $r['subject_code'], 'section_name' => $r['section_name'],
                          'attendance' => $r['rate'], 'compliance' => null];
        }
        foreach ($this->participationRows($term, $programId) as $r) {
            $k = $r['student_id'] . ':' . $r['class_id'];
            $byKey[$k] ??= ['student_id' => $r['student_id'], 'student_number' => $r['student_number'], 'first_name' => $r['first_name'],
                            'last_name' => $r['last_name'], 'subject_code' => $r['subject_code'], 'section_name' => $r['section_name'],
                            'attendance' => null, 'compliance' => null];
            $byKey[$k]['compliance'] = $r['compliance'];
        }
        $rows = array_values($byKey);
        foreach ($rows as &$r) {
            $parts = array_filter([$r['attendance'], $r['compliance']], fn($v) => $v !== null);
            $r['engagement'] = $parts ? array_sum($parts) / count($parts) : null;
        }
        usort($rows, fn($a, $b) => ($a['engagement'] ?? 2) <=> ($b['engagement'] ?? 2));
        return $rows;
    }

    public function engagement(): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        View::render('analytics/Views/studentengagement', array_merge($this->baseData('Student Engagement', ['Engagement' => '']), [
            'term'      => $term,
            'programId' => $programId,
            'rows'      => $this->engagementRows($term, $programId),
        ]));
    }

    // ------------------------------------------------------------------
    // Behavior
    // ------------------------------------------------------------------

    private function behaviorRows(?int $programId): array
    {
        $params = [];
        $where = 'b.deleted_at IS NULL' . AnalyticsAccess::studentScopeSql('s');
        if ($programId) {
            $where .= ' AND s.program_id = :prog';
            $params['prog'] = $programId;
        }
        $status = (string) ($_GET['status'] ?? '');
        if (in_array($status, ['Reported', 'Investigating', 'Resolved', 'Dismissed'], true)) {
            $where .= ' AND b.status = :st';
            $params['st'] = $status;
        }
        $severity = (string) ($_GET['severity'] ?? '');
        if (in_array($severity, ['Minor', 'Moderate', 'Severe'], true)) {
            $where .= ' AND b.severity = :sv';
            $params['sv'] = $severity;
        }
        return Database::fetchAll(
            "SELECT b.*, s.student_number, s.first_name, s.last_name, p.code AS program_code, c.subject_code, c.section_name,
                    CONCAT(u.first_name, ' ', u.last_name) AS reporter
             FROM `ana_behavior_records` b
             JOIN `students` s ON s.id = b.student_id
             LEFT JOIN `programs` p ON p.id = s.program_id
             LEFT JOIN `ana_classes` c ON c.id = b.class_id
             LEFT JOIN `users` u ON u.id = b.reported_by
             WHERE {$where}
             ORDER BY b.incident_date DESC, b.id DESC",
            $params
        );
    }

    public function behaviorRecords(): void
    {
        $programId = $this->programFilter();
        View::render('analytics/Views/behaviorrecords', array_merge($this->baseData('Behavior Records', ['Behavior' => '']), [
            'programId' => $programId,
            'rows'      => $this->behaviorRows($programId),
            'filters'   => Ui::queryParams(['program', 'status', 'severity']),
        ]));
    }

    // ------------------------------------------------------------------
    // CSV exports (scoped exactly like the pages)
    // ------------------------------------------------------------------

    public function export(string $type): void
    {
        $term = AnalyticsAccess::requestedTerm();
        $programId = $this->programFilter();
        $stamp = date('Ymd');

        switch ($type) {
            case 'subject-performance':
                Csv::download("subject_performance_{$stamp}.csv",
                    ['Subject', 'Title', 'Classes', 'Graded', 'Passed', 'Failed', 'INC', 'DRP', 'Pass Rate %', 'Mean Grade'],
                    array_map(fn($r) => [$r['subject_code'], $r['subject_title'], $r['classes'], $r['graded'], $r['passed'], $r['failed'], $r['inc'], $r['drp'],
                        $r['pass_rate'] === null ? '' : round($r['pass_rate'] * 100, 1), $r['mean_grade']], $this->subjectPerformanceRows($term, $programId)));
            case 'failed-inc':
                Csv::download("failed_inc_{$stamp}.csv",
                    ['Student No.', 'Last Name', 'First Name', 'Program', 'Subject', 'Section', 'Faculty', 'Grade', 'Remarks', 'INC Deadline', 'Resolved At'],
                    array_map(fn($r) => [$r['student_number'], $r['last_name'], $r['first_name'], $r['program_code'], $r['subject_code'], $r['section_name'], $r['faculty_name'],
                        $r['final_grade'], $r['remarks'], $r['inc_deadline'], $r['inc_resolved_at']], $this->failedIncRows($term, $programId)));
            case 'attendance':
                Csv::download("attendance_by_class_{$stamp}.csv",
                    ['Subject', 'Section', 'Faculty', 'Sessions', 'Present', 'Late', 'Excused', 'Absent', 'Rate %'],
                    array_map(fn($r) => [$r['subject_code'], $r['section_name'], $r['faculty_name'], $r['sessions'], $r['present'], $r['late'], $r['excused'], $r['absent'],
                        $r['rate'] === null ? '' : round($r['rate'] * 100, 1)], $this->attendanceClassRows($term, $programId)));
            case 'participation':
                Csv::download("participation_{$stamp}.csv",
                    ['Student No.', 'Last Name', 'First Name', 'Subject', 'Section', 'Submitted', 'Late', 'Missing', 'Excused', 'Compliance %'],
                    array_map(fn($r) => [$r['student_number'], $r['last_name'], $r['first_name'], $r['subject_code'], $r['section_name'], $r['submitted'], $r['late'], $r['missing'], $r['excused'],
                        $r['compliance'] === null ? '' : round($r['compliance'] * 100, 1)], $this->participationRows($term, $programId)));
            case 'engagement':
                Csv::download("engagement_{$stamp}.csv",
                    ['Student No.', 'Last Name', 'First Name', 'Subject', 'Section', 'Attendance %', 'Compliance %', 'Engagement %'],
                    array_map(fn($r) => [$r['student_number'], $r['last_name'], $r['first_name'], $r['subject_code'], $r['section_name'],
                        $r['attendance'] === null ? '' : round($r['attendance'] * 100, 1),
                        $r['compliance'] === null ? '' : round($r['compliance'] * 100, 1),
                        $r['engagement'] === null ? '' : round($r['engagement'] * 100, 1)], $this->engagementRows($term, $programId)));
            case 'behavior':
                Csv::download("behavior_{$stamp}.csv",
                    ['Date', 'Student No.', 'Last Name', 'First Name', 'Program', 'Type', 'Severity', 'Status', 'Subject', 'Reported By'],
                    array_map(fn($r) => [$r['incident_date'], $r['student_number'], $r['last_name'], $r['first_name'], $r['program_code'], $r['incident_type'], $r['severity'], $r['status'],
                        $r['subject_code'], $r['reporter']], $this->behaviorRows($programId)));
            default:
                AnalyticsAccess::notFound();
        }
    }
}
