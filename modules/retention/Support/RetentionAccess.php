<?php
namespace Modules\Retention\Support;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Access and Persona Scoping Helper for MarSU Retention Module
 * Resolves student identity, faculty class ownership, and student-level privacy boundaries.
 */
class RetentionAccess
{
    private static ?array $cachedStudent = null;
    private static bool $studentLoaded = false;
    private static ?array $cachedFacultyStudentIds = null;

    /**
     * Resolve the student record associated with current logged-in user.
     * Caches per request.
     */
    public static function currentStudent(): ?array
    {
        if (self::$studentLoaded) {
            return self::$cachedStudent;
        }

        $userId = Auth::id();
        if (!$userId) {
            self::$cachedStudent = null;
            self::$studentLoaded = true;
            return null;
        }

        try {
            $student = Database::fetchOne(
                "SELECT * FROM `students` WHERE `user_id` = :uid AND `deleted_at` IS NULL LIMIT 1",
                ['uid' => (int) $userId]
            );
            self::$cachedStudent = $student ?: null;
        } catch (\Throwable $e) {
            self::$cachedStudent = null;
        }

        self::$studentLoaded = true;
        return self::$cachedStudent;
    }

    /**
     * Resolve current user ID if user possesses faculty permissions.
     */
    public static function facultyUserId(): ?int
    {
        if (can('retention.faculty.classes')) {
            $id = Auth::id();
            return $id ? (int) $id : null;
        }
        return null;
    }

    /**
     * Check if current user strictly owns the specified class.
     * Note: Even lead_retention must own the class to edit scores/grades.
     */
    public static function ownsClass(int $classId): bool
    {
        $userId = Auth::id();
        if (!$userId || $classId <= 0) {
            return false;
        }

        try {
            $row = Database::fetchOne(
                "SELECT `id` FROM `ret_classes` WHERE `id` = :id AND `faculty_user_id` = :uid AND `deleted_at` IS NULL LIMIT 1",
                ['id' => $classId, 'uid' => (int) $userId]
            );
            return !empty($row);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Get array of student IDs currently enrolled on any of this faculty's classes.
     */
    public static function facultyStudentIds(?int $facultyUserId = null): array
    {
        $fid = $facultyUserId ?? self::facultyUserId();
        if (!$fid) {
            return [];
        }

        if (self::$cachedFacultyStudentIds !== null && $facultyUserId === null) {
            return self::$cachedFacultyStudentIds;
        }

        try {
            $rows = Database::fetchAll(
                "SELECT DISTINCT cs.student_id 
                 FROM `ret_class_students` cs 
                 JOIN `ret_classes` c ON cs.class_id = c.id 
                 WHERE c.faculty_user_id = :fid 
                   AND c.deleted_at IS NULL 
                   AND cs.status = 'enrolled'",
                ['fid' => $fid]
            );
            $ids = array_map(fn($r) => (int) $r['student_id'], $rows);
            if ($facultyUserId === null) {
                self::$cachedFacultyStudentIds = $ids;
            }
            return $ids;
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Check if current user has authorization to view the specified student's academic record.
     */
    public static function canSeeStudent(int $studentId): bool
    {
        if ($studentId <= 0) {
            return false;
        }

        // 1. Institution-wide oversight / admin
        if (can('retention.view')) {
            return true;
        }

        // 2. Faculty viewing enrolled student
        if (can('retention.faculty.classes')) {
            $rosterStudentIds = self::facultyStudentIds();
            return in_array($studentId, $rosterStudentIds, true);
        }

        // 3. Student viewing own record
        if (can('retention.student.portal')) {
            $std = self::currentStudent();
            return $std && (int) $std['id'] === $studentId;
        }

        return false;
    }

    /**
     * Find class by ID and verify that the current user owns it.
     * On failure, flashes an error message, redirects to faculty classes list, and halts.
     */
    public static function findOwnClassOr404(string|int $id): array
    {
        $classId = (int) $id;
        if ($classId <= 0) {
            Session::flash('error', 'Record not found.');
            redirect(url('retention/faculty/classes'));
            exit;
        }

        try {
            $class = Database::fetchOne(
                "SELECT * FROM `ret_classes` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1",
                ['id' => $classId]
            );
        } catch (\Throwable $e) {
            $class = null;
        }

        if (!$class || (int) $class['faculty_user_id'] !== (int) Auth::id()) {
            Session::flash('error', 'Record not found.');
            redirect(url('retention/faculty/classes'));
            exit;
        }

        return $class;
    }

    /**
     * Determine whether the current user is an oversight-only persona (e.g. Dean, VPAA).
     */
    public static function isOversightOnly(): bool
    {
        if (!can('retention.view')) {
            return false;
        }

        return !can('retention.admin.settings')
            && !can('retention.admin.classes')
            && !can('retention.admin.grades')
            && !can('retention.admin.attendance')
            && !can('retention.admin.conduct')
            && !can('retention.admin.profiles');
    }
}
