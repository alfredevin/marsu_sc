<?php
namespace Modules\Analytics\Support;

use Core\Auth;
use Core\Database;
use Core\Session;
use Core\View;

/**
 * Single source of truth for "who am I and what may I touch" in the Analytics module.
 *
 * Personas come from role slugs (user_roles) combined with permission keys.
 * Data scopes are never merged: each workspace applies its own scope
 * (program scope for monitoring, class ownership for faculty, self for students).
 */
class AnalyticsAccess
{
    public const ADMIN_ROLES = ['super_admin', 'lead_analytics', 'admin'];

    private const PERSONA_SESSION_KEY = 'analytics.persona';

    private static ?array $roles = null;
    private static bool $studentLoaded = false;
    private static ?array $student = null;
    private static ?array $programScope = null;
    private static bool $programScopeLoaded = false;
    private static ?array $facultyStudentIds = null;
    private static ?bool $facultyScope = null;
    private static bool $termLoaded = false;
    private static ?array $term = null;

    // ------------------------------------------------------------------
    // Roles & personas
    // ------------------------------------------------------------------

    public static function roles(): array
    {
        if (self::$roles !== null) {
            return self::$roles;
        }
        $userId = Auth::id();
        if (!$userId) {
            return self::$roles = [];
        }
        $rows = Database::fetchAll(
            "SELECT r.slug FROM `user_roles` ur JOIN `roles` r ON r.id = ur.role_id WHERE ur.user_id = :uid",
            ['uid' => (int) $userId]
        );
        $roles = array_column($rows, 'slug');
        $user = Auth::user();
        if (!empty($user['role'])) {
            $roles[] = $user['role'];
        }
        return self::$roles = array_values(array_unique($roles));
    }

    public static function hasRole(string ...$slugs): bool
    {
        return (bool) array_intersect($slugs, self::roles());
    }

    public static function isAdmin(): bool
    {
        return self::hasRole(...self::ADMIN_ROLES);
    }

    public static function isProgramHead(): bool
    {
        return self::hasRole('program_head') && can('analytics.view');
    }

    public static function isRegistrar(): bool
    {
        return can('analytics.registrar.view') || can('analytics.registrar.enrollment');
    }

    public static function isFaculty(): bool
    {
        return can('analytics.faculty.classes');
    }

    public static function isStudentUser(): bool
    {
        return self::hasRole('student') && can('analytics.student.portal');
    }

    /**
     * Workspaces available to the current user, in landing priority order.
     */
    public static function personas(): array
    {
        $list = [];
        if (self::isStudentUser()) {
            $list['student'] = ['label' => 'Student', 'icon' => 'bi-mortarboard', 'url' => 'analytics/my'];
        }
        if (self::isFaculty()) {
            $list['faculty'] = ['label' => 'Faculty', 'icon' => 'bi-person-workspace', 'url' => 'analytics/faculty'];
        }
        if (self::isRegistrar()) {
            $list['registrar'] = ['label' => 'Registrar', 'icon' => 'bi-person-badge', 'url' => 'analytics/registrar'];
        }
        if (self::isAdmin()) {
            $list['admin'] = ['label' => 'Administrator', 'icon' => 'bi-shield-lock', 'url' => 'analytics'];
        } elseif (self::isProgramHead()) {
            $list['program_head'] = ['label' => 'Program Head', 'icon' => 'bi-diagram-3', 'url' => 'analytics'];
        }
        return $list;
    }

    /**
     * Default persona for landing: student -> faculty (unless admin) -> registrar -> monitoring.
     */
    public static function defaultPersona(): ?string
    {
        $p = self::personas();
        if (isset($p['student'])) {
            return 'student';
        }
        if (isset($p['faculty']) && !self::isAdmin()) {
            return 'faculty';
        }
        if (isset($p['registrar']) && !self::isAdmin()) {
            return 'registrar';
        }
        foreach (['admin', 'program_head', 'faculty', 'registrar'] as $key) {
            if (isset($p[$key])) {
                return $key;
            }
        }
        return null;
    }

    public static function persona(): ?string
    {
        $chosen = Session::get(self::PERSONA_SESSION_KEY);
        if ($chosen && isset(self::personas()[$chosen])) {
            return $chosen;
        }
        return self::defaultPersona();
    }

    public static function setPersona(string $key): bool
    {
        if (!isset(self::personas()[$key])) {
            return false;
        }
        Session::set(self::PERSONA_SESSION_KEY, $key);
        return true;
    }

    // ------------------------------------------------------------------
    // Student self-scope
    // ------------------------------------------------------------------

    public static function currentStudent(): ?array
    {
        if (self::$studentLoaded) {
            return self::$student;
        }
        self::$studentLoaded = true;
        $userId = Auth::id();
        if (!$userId) {
            return null;
        }
        self::$student = Database::fetchOne(
            "SELECT s.*, p.code AS program_code, p.name AS program_name, sec.name AS section_name
             FROM `students` s
             LEFT JOIN `programs` p ON p.id = s.program_id
             LEFT JOIN `sections` sec ON sec.id = s.section_id
             WHERE s.user_id = :uid AND s.deleted_at IS NULL
             LIMIT 1",
            ['uid' => (int) $userId]
        );
        return self::$student;
    }

    public static function currentStudentId(): ?int
    {
        $s = self::currentStudent();
        return $s ? (int) $s['id'] : null;
    }

    // ------------------------------------------------------------------
    // Program scope (monitoring / oversight)
    // ------------------------------------------------------------------

    /**
     * null = all programs, array = only these program ids, [] = nothing.
     */
    public static function scopedProgramIds(): ?array
    {
        if (self::$programScopeLoaded) {
            return self::$programScope;
        }
        self::$programScopeLoaded = true;

        if (self::isAdmin()) {
            return self::$programScope = null;
        }
        if (self::hasRole('program_head')) {
            $rows = Database::fetchAll(
                "SELECT program_id FROM `ana_program_heads` WHERE user_id = :uid",
                ['uid' => (int) Auth::id()]
            );
            return self::$programScope = array_map('intval', array_column($rows, 'program_id'));
        }
        return self::$programScope = [];
    }

    /**
     * SQL fragment restricting $column to the scoped programs. Program ids come
     * from the database and are cast to int, so the fragment carries no user input.
     */
    public static function programScopeSql(string $column): string
    {
        if (self::isFacultyScope()) {
            return ' AND ' . $column . ' IN (SELECT fps.program_id FROM `students` fps WHERE fps.id IN (' . self::facultyRosterSql() . '))';
        }
        $ids = self::scopedProgramIds();
        if ($ids === null) {
            return '';
        }
        if (empty($ids)) {
            return ' AND 1 = 0';
        }
        return ' AND ' . $column . ' IN (' . implode(',', array_map('intval', $ids)) . ')';
    }

    /**
     * Faculty viewing the monitoring pages: data is limited to their own classes,
     * and students to those on their class rosters (each class is one section).
     */
    public static function isFacultyScope(): bool
    {
        return self::$facultyScope ??= (self::persona() === 'faculty' && can('analytics.view'));
    }

    /**
     * Subquery of student ids on the current faculty member's rosters (user id cast to int).
     */
    private static function facultyRosterSql(): string
    {
        $uid = (int) Auth::id();
        return "SELECT fcs.student_id FROM `ana_class_students` fcs JOIN `ana_classes` fc ON fc.id = fcs.class_id"
             . " WHERE fc.faculty_user_id = {$uid} AND fc.deleted_at IS NULL AND fcs.status = 'enrolled'";
    }

    public static function studentScopeSql(string $alias = 's'): string
    {
        if (self::isFacultyScope()) {
            return " AND {$alias}.id IN (" . self::facultyRosterSql() . ')';
        }
        return self::programScopeSql("{$alias}.program_id");
    }

    /**
     * Student Profiles scope. Faculty see every student the Registrar enrolled in the
     * subjects of their classes (all sections) plus their rostered students.
     */
    public static function profileStudentScopeSql(string $alias = 's'): string
    {
        if (!self::isFacultyScope()) {
            return self::studentScopeSql($alias);
        }
        $uid = (int) Auth::id();
        return " AND ({$alias}.id IN (" . self::facultyRosterSql() . ")"
             . " OR {$alias}.id IN (SELECT pe.student_id FROM `ana_enrollments` pe"
             . " JOIN `ana_enrollment_subjects` pes ON pes.enrollment_id = pe.id AND pes.status = 'enrolled'"
             . " JOIN `ana_classes` pc ON pc.subject_id = pes.subject_id AND pc.semester_id = pe.semester_id"
             . " AND pc.faculty_user_id = {$uid} AND pc.deleted_at IS NULL"
             . " WHERE pe.status = 'enrolled'))";
    }

    /**
     * Section scope for filter dropdowns: faculty only get the sections of their own classes.
     */
    public static function sectionScopeSql(string $alias = 'sx'): string
    {
        if (self::isFacultyScope()) {
            return " AND {$alias}.id IN (SELECT fsc.section_id FROM `ana_classes` fsc WHERE fsc.faculty_user_id = " . (int) Auth::id() . " AND fsc.deleted_at IS NULL)";
        }
        return self::programScopeSql("{$alias}.program_id");
    }

    /**
     * Extra class restriction applied only for faculty scope (own classes).
     */
    public static function facultyClassSql(string $alias = 'c'): string
    {
        return self::isFacultyScope() ? " AND {$alias}.faculty_user_id = " . (int) Auth::id() : '';
    }

    /**
     * A class belongs to the program of its section, falling back to the subject's program.
     */
    public static function classProgramExpr(string $alias = 'c'): string
    {
        return "COALESCE((SELECT sx.program_id FROM `sections` sx WHERE sx.id = {$alias}.section_id), "
             . "(SELECT jx.program_id FROM `subjects` jx WHERE jx.id = {$alias}.subject_id))";
    }

    public static function classScopeSql(string $alias = 'c'): string
    {
        if (self::isFacultyScope()) {
            return " AND {$alias}.faculty_user_id = " . (int) Auth::id();
        }
        return self::programScopeSql(self::classProgramExpr($alias));
    }

    public static function scopedPrograms(): array
    {
        return Database::fetchAll(
            "SELECT p.id, p.code, p.name FROM `programs` p WHERE p.deleted_at IS NULL" . self::programScopeSql('p.id') . " ORDER BY p.code"
        );
    }

    public static function canMonitorStudent(int $studentId): bool
    {
        if ($studentId <= 0 || !can('analytics.view')) {
            return false;
        }
        $row = Database::fetchOne(
            "SELECT s.id FROM `students` s WHERE s.id = :id AND s.deleted_at IS NULL" . self::studentScopeSql('s'),
            ['id' => $studentId]
        );
        return $row !== null;
    }

    public static function canSeeClass(int $classId): bool
    {
        if ($classId <= 0 || !can('analytics.view')) {
            return false;
        }
        $row = Database::fetchOne(
            "SELECT c.id FROM `ana_classes` c WHERE c.id = :id AND c.deleted_at IS NULL" . self::classScopeSql('c'),
            ['id' => $classId]
        );
        return $row !== null;
    }

    // ------------------------------------------------------------------
    // Faculty ownership
    // ------------------------------------------------------------------

    public static function facultyUserId(): ?int
    {
        return self::isFaculty() && Auth::id() ? (int) Auth::id() : null;
    }

    public static function ownsClass(int $classId): bool
    {
        $userId = Auth::id();
        if (!$userId || $classId <= 0 || !self::isFaculty()) {
            return false;
        }
        return Database::fetchOne(
            "SELECT id FROM `ana_classes` WHERE id = :id AND faculty_user_id = :uid AND deleted_at IS NULL",
            ['id' => $classId, 'uid' => (int) $userId]
        ) !== null;
    }

    public static function findOwnClassOr404(string|int $id): array
    {
        $classId = (int) $id;
        $class = null;
        if ($classId > 0 && self::isFaculty()) {
            $class = Database::fetchOne(
                "SELECT * FROM `ana_classes` WHERE id = :id AND faculty_user_id = :uid AND deleted_at IS NULL",
                ['id' => $classId, 'uid' => (int) Auth::id()]
            );
        }
        if (!$class) {
            self::notFound();
        }
        return $class;
    }

    public static function facultyStudentIds(): array
    {
        if (self::$facultyStudentIds !== null) {
            return self::$facultyStudentIds;
        }
        $fid = self::facultyUserId();
        if (!$fid) {
            return self::$facultyStudentIds = [];
        }
        $rows = Database::fetchAll(
            "SELECT DISTINCT cs.student_id
             FROM `ana_class_students` cs
             JOIN `ana_classes` c ON cs.class_id = c.id
             WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND cs.status = 'enrolled'",
            ['fid' => $fid]
        );
        return self::$facultyStudentIds = array_map('intval', array_column($rows, 'student_id'));
    }

    public static function facultyHasStudent(int $studentId): bool
    {
        return in_array($studentId, self::facultyStudentIds(), true);
    }

    /**
     * Self, a faculty member's own roster, or program-scoped monitoring.
     */
    public static function canSeeStudent(int $studentId): bool
    {
        if ($studentId <= 0) {
            return false;
        }
        return self::currentStudentId() === $studentId
            || self::facultyHasStudent($studentId)
            || self::canMonitorStudent($studentId);
    }

    // ------------------------------------------------------------------
    // Terms
    // ------------------------------------------------------------------

    /**
     * Active term = active academic year + its active semester (lowest id when the
     * core calendar holds duplicates). Returns null when nothing is active.
     */
    public static function activeTerm(): ?array
    {
        if (self::$termLoaded) {
            return self::$term;
        }
        self::$termLoaded = true;
        self::$term = Database::fetchOne(
            "SELECT sem.id AS semester_id, sem.code AS semester_code, sem.name AS semester_name,
                    ay.id AS academic_year_id, ay.label AS academic_year_label
             FROM `academic_years` ay
             JOIN `semesters` sem ON sem.academic_year_id = ay.id AND sem.is_active = 1
             WHERE ay.is_active = 1
             ORDER BY ay.id DESC, sem.id ASC
             LIMIT 1"
        );
        if (self::$term) {
            self::$term['label'] = self::$term['semester_name'] . ', ' . self::$term['academic_year_label'];
        }
        return self::$term;
    }

    /**
     * Distinct terms (one semester row per academic year + semester code), newest first.
     */
    public static function terms(): array
    {
        $rows = Database::fetchAll(
            "SELECT MIN(sem.id) AS semester_id, sem.code AS semester_code, MIN(sem.name) AS semester_name,
                    ay.id AS academic_year_id, ay.label AS academic_year_label
             FROM `semesters` sem
             JOIN `academic_years` ay ON ay.id = sem.academic_year_id
             GROUP BY ay.id, ay.label, ay.start_date, sem.code
             ORDER BY ay.start_date DESC, ay.id DESC, FIELD(sem.code, 'summer', '2', '1')"
        );
        foreach ($rows as &$r) {
            $r['label'] = $r['semester_name'] . ', ' . $r['academic_year_label'];
        }
        return $rows;
    }

    public static function findTerm(int $semesterId): ?array
    {
        $row = Database::fetchOne(
            "SELECT sem.id AS semester_id, sem.code AS semester_code, sem.name AS semester_name,
                    ay.id AS academic_year_id, ay.label AS academic_year_label
             FROM `semesters` sem JOIN `academic_years` ay ON ay.id = sem.academic_year_id
             WHERE sem.id = :id",
            ['id' => $semesterId]
        );
        if ($row) {
            $row['label'] = $row['semester_name'] . ', ' . $row['academic_year_label'];
        }
        return $row;
    }

    /**
     * Term selected through ?term=, defaulting to the active term.
     */
    public static function requestedTerm(): ?array
    {
        $requested = (int) ($_GET['term'] ?? 0);
        if ($requested > 0) {
            return self::findTerm($requested);
        }
        return self::activeTerm();
    }

    // ------------------------------------------------------------------
    // Responses
    // ------------------------------------------------------------------

    public static function notFound(): never
    {
        http_response_code(404);
        View::render('errors/404', ['title' => 'Page Not Found', 'uri' => $_SERVER['REQUEST_URI'] ?? '']);
        exit;
    }

    public static function forbidden(string $permissionKey = ''): never
    {
        http_response_code(403);
        View::render('errors/403', ['title' => 'Access Forbidden (403)', 'permissionKey' => $permissionKey]);
        exit;
    }
}
