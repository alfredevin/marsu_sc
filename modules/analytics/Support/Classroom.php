<?php
namespace Modules\Analytics\Support;

use Core\Auth;
use Core\Database;

/**
 * Class creation, class codes, enrollment-backed rosters and stream attachments.
 */
class Classroom
{
    public const UPLOAD_EXTENSIONS = [
        'pdf'  => ['application/pdf'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/octet-stream'],
        'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/zip', 'application/octet-stream'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/octet-stream'],
        'png'  => ['image/png'],
        'jpg'  => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
    ];
    public const UPLOAD_MAX_BYTES = 10485760;

    public static function uploadDir(): string
    {
        return dirname(__DIR__) . '/storage/uploads';
    }

    public static function generateCode(): string
    {
        $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        do {
            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code .= $alphabet[random_int(0, strlen($alphabet) - 1)];
            }
            $taken = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_classes` WHERE class_code = :c", ['c' => $code]);
        } while ($taken > 0);
        return $code;
    }

    /**
     * Create a class owned by $facultyUserId in the active term.
     * Returns ['id' => int] or ['error' => string].
     */
    public static function create(array $input, int $facultyUserId): array
    {
        $term = AnalyticsAccess::activeTerm();
        if (!$term) {
            return ['error' => 'There is no active academic year and semester. Ask the administrator to activate a term first.'];
        }

        $subjectId = (int) ($input['subject_id'] ?? 0);
        $sectionId = (int) ($input['section_id'] ?? 0);
        $templateId = (int) ($input['template_id'] ?? 0);

        $subject = Database::fetchOne("SELECT * FROM `subjects` WHERE id = :id AND deleted_at IS NULL", ['id' => $subjectId]);
        $section = Database::fetchOne("SELECT * FROM `sections` WHERE id = :id AND deleted_at IS NULL", ['id' => $sectionId]);
        $template = Database::fetchOne("SELECT * FROM `ana_grading_templates` WHERE id = :id AND is_active = 1 AND deleted_at IS NULL", ['id' => $templateId]);
        if (!$subject || !$section || !$template) {
            return ['error' => 'Please choose a valid subject, section and grading template.'];
        }

        $duplicate = Database::fetchOne(
            "SELECT id FROM `ana_classes` WHERE faculty_user_id = :f AND subject_id = :s AND section_id = :sec AND semester_id = :sem AND deleted_at IS NULL",
            ['f' => $facultyUserId, 's' => $subjectId, 'sec' => $sectionId, 'sem' => (int) $term['semester_id']]
        );
        if ($duplicate) {
            return ['error' => 'You already have a class for this subject and section this term.'];
        }

        $code = self::generateCode();
        $id = Database::insert('ana_classes', [
            'class_code'       => $code,
            'faculty_user_id'  => $facultyUserId,
            'subject_id'       => $subjectId,
            'subject_code'     => $subject['code'],
            'subject_title'    => $subject['title'],
            'units'            => (float) $subject['units'],
            'section_id'       => $sectionId,
            'section_name'     => $section['name'],
            'description'      => self::nullable($input['description'] ?? null, 2000),
            'schedule'         => self::nullable($input['schedule'] ?? null, 128),
            'room'             => self::nullable($input['room'] ?? null, 64),
            'academic_year_id' => (int) $term['academic_year_id'],
            'semester_id'      => (int) $term['semester_id'],
            'template_id'      => $templateId,
            'grading_scheme'   => $template['scheme'],
            'passing_cutoff'   => (float) $template['passing_cutoff'],
            'grade_status'     => 'draft',
            'scores_visible'   => 0,
            'created_by'       => (int) Auth::id(),
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        ChangeLog::record('class', $id, 'create', 'class_code', null, $code, "Class {$subject['code']} - {$section['name']} created");
        return ['id' => $id, 'code' => $code];
    }

    public static function nullable(?string $value, int $max): ?string
    {
        $value = trim((string) $value);
        return $value === '' ? null : mb_substr($value, 0, $max);
    }

    /**
     * Registrar-enrolled students for the class subject and term.
     * same_section = enrolled under the class section; others are irregular candidates.
     */
    public static function enrolledCandidates(array $class, ?string $search = null): array
    {
        if (empty($class['subject_id']) || empty($class['semester_id'])) {
            return [];
        }
        $params = ['subj' => (int) $class['subject_id'], 'sem' => (int) $class['semester_id'], 'cid' => (int) $class['id'], 'sec' => (int) ($class['section_id'] ?? 0)];
        $searchSql = '';
        if ($search !== null && $search !== '') {
            $searchSql = " AND (st.student_number LIKE :q1 OR CONCAT(st.first_name, ' ', st.last_name) LIKE :q2 OR CONCAT(st.last_name, ', ', st.first_name) LIKE :q3)";
            $params['q1'] = $params['q2'] = $params['q3'] = '%' . $search . '%';
        }
        return Database::fetchAll(
            "SELECT st.id AS student_id, st.student_number, st.first_name, st.middle_name, st.last_name,
                    p.code AS program_code, COALESCE(es.section_id, e.section_id) AS enrolled_section_id,
                    sec.name AS enrolled_section_name,
                    (COALESCE(es.section_id, e.section_id) = :sec) AS same_section
             FROM `ana_enrollment_subjects` es
             JOIN `ana_enrollments` e ON e.id = es.enrollment_id
             JOIN `students` st ON st.id = e.student_id
             LEFT JOIN `programs` p ON p.id = st.program_id
             LEFT JOIN `sections` sec ON sec.id = COALESCE(es.section_id, e.section_id)
             WHERE es.subject_id = :subj AND es.status = 'enrolled'
               AND e.semester_id = :sem AND e.status = 'enrolled'
               AND st.deleted_at IS NULL
               AND NOT EXISTS (SELECT 1 FROM `ana_class_students` cs WHERE cs.class_id = :cid AND cs.student_id = st.id AND cs.status = 'enrolled')
               {$searchSql}
             ORDER BY same_section DESC, st.last_name, st.first_name",
            $params
        );
    }

    public static function isOfficiallyEnrolled(int $studentId, array $class): bool
    {
        if (empty($class['subject_id']) || empty($class['semester_id'])) {
            return false;
        }
        return Database::fetchOne(
            "SELECT es.id FROM `ana_enrollment_subjects` es
             JOIN `ana_enrollments` e ON e.id = es.enrollment_id
             WHERE e.student_id = :sid AND e.semester_id = :sem AND e.status = 'enrolled'
               AND es.subject_id = :subj AND es.status = 'enrolled'",
            ['sid' => $studentId, 'sem' => (int) $class['semester_id'], 'subj' => (int) $class['subject_id']]
        ) !== null;
    }

    public static function addToRoster(int $classId, int $studentId): void
    {
        Database::query(
            "INSERT INTO `ana_class_students` (`class_id`, `student_id`, `status`, `added_by`, `created_at`, `updated_at`)
             VALUES (:cid, :sid, 'enrolled', :uid, NOW(), NOW())
             ON DUPLICATE KEY UPDATE `status` = 'enrolled', `drop_reason` = NULL, `updated_at` = NOW()",
            ['cid' => $classId, 'sid' => $studentId, 'uid' => (int) Auth::id()]
        );
    }

    public static function isRostered(int $classId, int $studentId): bool
    {
        return Database::fetchOne(
            "SELECT id FROM `ana_class_students` WHERE class_id = :cid AND student_id = :sid AND status = 'enrolled'",
            ['cid' => $classId, 'sid' => $studentId]
        ) !== null;
    }

    /**
     * Validate and store an uploaded attachment. Returns [path, originalName, size] or throws.
     */
    public static function storeUpload(array $file): array
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'] ?? '')) {
            throw new \RuntimeException('The attachment could not be uploaded.');
        }
        if ((int) $file['size'] <= 0 || (int) $file['size'] > self::UPLOAD_MAX_BYTES) {
            throw new \RuntimeException('Attachments must be smaller than 10 MB.');
        }
        $ext = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
        if (!isset(self::UPLOAD_EXTENSIONS[$ext])) {
            throw new \RuntimeException('Allowed attachment types: PDF, DOCX, PPTX, XLSX, PNG, JPG.');
        }
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!in_array($mime, self::UPLOAD_EXTENSIONS[$ext], true)) {
            throw new \RuntimeException('The attachment content does not match its file type.');
        }

        $dir = self::uploadDir();
        if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
            throw new \RuntimeException('Upload storage is not writable.');
        }
        $stored = bin2hex(random_bytes(16)) . '.' . $ext;
        if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $stored)) {
            throw new \RuntimeException('Upload storage is not writable.');
        }
        $original = preg_replace('/[^\pL\pN\.\-_ ()]/u', '_', basename((string) $file['name']));
        return [$stored, mb_substr($original, 0, 191), (int) $file['size']];
    }
}
