<?php
namespace Modules\Analytics\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\AnalyticsSettings;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\Classroom;
use Modules\Analytics\Support\Notifier;

/**
 * Controller for Analytics Administration and Governance Actions
 * Implements Part E admin capabilities (policies, offerings, correction approval, conduct workflow, audit log).
 */
class AdminController
{
    // ========================================================================
    // 1. Class Offerings & Teaching Assignments (Part E3)
    // ========================================================================

    /**
     * Admin Class Offerings Management
     */
    public function classes(): void
    {
        $classes = [];
        try {
            $classes = Database::fetchAll("
                SELECT c.*, 
                       sub.title as subject_title_meta, 
                       sec.name as section_name_meta, 
                       CONCAT(u.first_name, ' ', u.last_name) as faculty_name,
                       u.email as faculty_email,
                       sem.name as semester_name,
                       ay.label as academic_year_label,
                       (SELECT COUNT(*) FROM `ana_class_students` cs WHERE cs.class_id = c.id AND cs.status = 'enrolled') as student_count,
                       (SELECT COUNT(*) FROM `ana_class_scores` sc WHERE sc.class_id = c.id) as score_count
                FROM `ana_classes` c
                LEFT JOIN `subjects` sub ON c.subject_id = sub.id
                LEFT JOIN `sections` sec ON c.section_id = sec.id
                LEFT JOIN `users` u ON c.faculty_user_id = u.id
                LEFT JOIN `semesters` sem ON c.semester_id = sem.id
                LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
                WHERE c.deleted_at IS NULL
                ORDER BY c.id DESC
            ");
        } catch (\Throwable $e) {
            $classes = [];
        }

        $facultyList = $this->loadFacultyUsers();

        // Active Semester & unposted count for term closure
        $activeSemester = null;
        $unpostedCount = 0;
        try {
            $term = AnalyticsAccess::activeTerm();
            $activeSemester = $term ? ['id' => (int) $term['semester_id'], 'name' => $term['label']] : null;
            if ($activeSemester) {
                $unpostedCount = (int) Database::fetchColumn(
                    "SELECT COUNT(*) FROM `ana_classes` WHERE `semester_id` = :sem_id AND `grade_status` = 'draft' AND `deleted_at` IS NULL",
                    ['sem_id' => (int) $activeSemester['id']]
                );
            }
        } catch (\Throwable $e) {}

        View::render('analytics/Views/admin/classes', [
            'classes'        => $classes,
            'facultyList'    => $facultyList,
            'activeSemester' => $activeSemester,
            'unpostedCount'  => $unpostedCount,
            'title'          => 'Class Offerings & Assignments - Analytics Admin',
            'crumbs'         => ['Analytics Admin' => url('analytics/admin/classes'), 'Class Offerings' => ''],
        ]);
    }

    /**
     * Create Class Offering Form
     */
    public function createClass(): void
    {
        $subjects = Database::fetchAll("SELECT id, code, title, units FROM `subjects` WHERE `deleted_at` IS NULL ORDER BY code ASC");
        $sections = Database::fetchAll("SELECT id, name, year_level FROM `sections` WHERE `deleted_at` IS NULL ORDER BY year_level ASC, name ASC");
        $academicYears = Database::fetchAll("SELECT id, label, is_active FROM `academic_years` ORDER BY is_active DESC, id DESC");
        $semesters = Database::fetchAll("SELECT id, name, academic_year_id, is_active FROM `semesters` ORDER BY is_active DESC, id DESC");
        $templates = Database::fetchAll("SELECT id, name, passing_cutoff, is_default FROM `ana_grading_templates` WHERE `is_active` = 1 AND `deleted_at` IS NULL ORDER BY is_default DESC, id DESC");
        $facultyList = $this->loadFacultyUsers();

        View::render('analytics/Views/admin/class_form', [
            'subjects'      => $subjects,
            'sections'      => $sections,
            'academicYears' => $academicYears,
            'semesters'     => $semesters,
            'templates'     => $templates,
            'facultyList'   => $facultyList,
            'title'         => 'Create Class Offering - Analytics Admin',
            'crumbs'        => ['Analytics Admin' => url('analytics/admin/classes'), 'Create' => ''],
        ]);
    }

    /**
     * Store New Class Offering (Snapshots Grading Template Scheme & Cutoff)
     */
    public function storeClass(): void
    {
        $subjectId = (int) ($_POST['subject_id'] ?? 0);
        $sectionId = (int) ($_POST['section_id'] ?? 0);
        $facultyUserId = (int) ($_POST['faculty_user_id'] ?? 0);
        $templateId = (int) ($_POST['template_id'] ?? 0);
        $ayId = (int) ($_POST['academic_year_id'] ?? 0);
        $semId = (int) ($_POST['semester_id'] ?? 0);

        if (!$subjectId || !$sectionId || !$facultyUserId || !$templateId) {
            Session::flash('error', 'Please complete all required fields.');
            redirect(url('analytics/admin/classes/create'));
            return;
        }

        $subject = Database::fetchOne("SELECT * FROM `subjects` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $subjectId]);
        $section = Database::fetchOne("SELECT * FROM `sections` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $sectionId]);
        $template = Database::fetchOne("SELECT * FROM `ana_grading_templates` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $templateId]);
        $faculty = Database::fetchOne("SELECT id, first_name, last_name FROM `users` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $facultyUserId]);

        $isFaculty = in_array($facultyUserId, array_map('intval', array_column($this->loadFacultyUsers(), 'id')), true);
        if (!$subject || !$section || !$template || !$faculty || !$isFaculty) {
            Session::flash('error', 'Invalid subject, section, faculty owner, or grading template selected.');
            redirect(url('analytics/admin/classes/create'));
            return;
        }
        $term = $semId ? AnalyticsAccess::findTerm($semId) : AnalyticsAccess::activeTerm();
        if (!$term) {
            Session::flash('error', 'Choose a valid term; no term is active.');
            redirect(url('analytics/admin/classes/create'));
            return;
        }
        $ayId = (int) $term['academic_year_id'];
        $semId = (int) $term['semester_id'];

        // Admin fallback: the class is owned by the chosen faculty; the admin never encodes grades.
        $classId = Database::insert('ana_classes', [
            'class_code'       => Classroom::generateCode(),
            'scores_visible'   => 0,
            'faculty_user_id'  => $facultyUserId,
            'subject_id'       => $subjectId,
            'subject_code'     => $subject['code'],
            'subject_title'    => $subject['title'],
            'units'            => (float) ($subject['units'] ?? 3.0),
            'section_id'       => $sectionId,
            'section_name'     => $section['name'],
            'academic_year_id' => $ayId ?: null,
            'semester_id'      => $semId ?: null,
            'template_id'      => $templateId,
            'grading_scheme'   => $template['scheme'],
            'passing_cutoff'   => (float) $template['passing_cutoff'],
            'grade_status'     => 'draft',
            'created_by'       => (int) Auth::id(),
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        ChangeLog::record(
            'class',
            (int) $classId,
            'create',
            null,
            null,
            "{$subject['code']} - {$section['name']}",
            "Class offering created and assigned to {$faculty['first_name']} {$faculty['last_name']}"
        );

        Session::flash('success', "Class offering {$subject['code']} - {$section['name']} created successfully.");
        redirect(url('analytics/admin/classes'));
    }

    /**
     * Reassign Class Teaching Faculty with Mandatory Justification
     */
    public function reassignClassFaculty(string $id): void
    {
        $classId = (int) $id;
        $newFacultyId = (int) ($_POST['faculty_user_id'] ?? 0);
        $reason = trim($_POST['reason'] ?? '');

        if (!$reason) {
            Session::flash('error', 'A mandatory justification / reason is required to reassign class faculty.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $class = Database::fetchOne("SELECT * FROM `ana_classes` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $classId]);
        if (!$class) {
            Session::flash('error', 'Class offering not found.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $newFaculty = Database::fetchOne("SELECT id, first_name, last_name FROM `users` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $newFacultyId]);
        if (!$newFaculty) {
            Session::flash('error', 'Selected instructor not found.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $oldFacultyId = (int) ($class['faculty_user_id'] ?? 0);

        Database::update(
            'ana_classes',
            [
                'faculty_user_id' => $newFacultyId,
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            'id = :id',
            ['id' => $classId]
        );

        ChangeLog::record(
            'class',
            $classId,
            'reassign_faculty',
            'faculty_user_id',
            (string) $oldFacultyId,
            (string) $newFacultyId,
            $reason
        );

        Session::flash('success', "Teaching faculty successfully reassigned to {$newFaculty['first_name']} {$newFaculty['last_name']}.");
        redirect(url('analytics/admin/classes'));
    }

    /**
     * Archive Class (Allowed only if zero scores exist)
     */
    public function archiveClass(string $id): void
    {
        $classId = (int) $id;
        $reason = trim($_POST['reason'] ?? '');

        $class = Database::fetchOne("SELECT * FROM `ana_classes` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $classId]);
        if (!$class) {
            Session::flash('error', 'Class offering not found.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $scoreCount = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_class_scores` WHERE `class_id` = :id", ['id' => $classId]);
        if ($scoreCount > 0) {
            Session::flash('error', 'Cannot archive a class offering that already contains student scores.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        Database::update(
            'ana_classes',
            [
                'deleted_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            'id = :id',
            ['id' => $classId]
        );

        ChangeLog::record(
            'class',
            $classId,
            'archive',
            'deleted_at',
            null,
            date('Y-m-d H:i:s'),
            $reason ?: 'Class offering archived by administrator'
        );

        Session::flash('success', "Class offering {$class['subject_code']} - {$class['section_name']} archived.");
        redirect(url('analytics/admin/classes'));
    }

    /**
     * Close Term: Locks all posted classes for the semester
     */
    public function closeTerm(string $semesterId): void
    {
        $semId = (int) $semesterId;
        $reason = trim($_POST['reason'] ?? '');

        if (!$reason) {
            Session::flash('error', 'A mandatory administrative memorandum or reason is required to close a term.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $sem = Database::fetchOne("SELECT * FROM `semesters` WHERE `id` = :id LIMIT 1", ['id' => $semId]);
        if (!$sem) {
            Session::flash('error', 'Academic semester not found.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $db = Database::pdo();
        $stmt = $db->prepare("UPDATE `ana_classes` SET `grade_status` = 'locked', `updated_at` = NOW() WHERE `semester_id` = ? AND `grade_status` = 'posted' AND `deleted_at` IS NULL");
        $stmt->execute([$semId]);
        $lockedCount = $stmt->rowCount();

        ChangeLog::record(
            'term',
            $semId,
            'close_term',
            'grade_status',
            'posted',
            'locked',
            $reason
        );

        Session::flash('success', "Academic term closed: {$lockedCount} posted class(es) have been permanently locked.");
        redirect(url('analytics/admin/classes'));
    }

    // ========================================================================
    // 2. Policy Settings (Part E1)
    // ========================================================================

    public function settings(): void
    {
        $settings = AnalyticsSettings::all();
        View::render('analytics/Views/admin/settings', [
            'settings' => $settings,
            'title'    => 'Policy Settings - Analytics Admin',
            'crumbs'   => ['Analytics Admin' => url('analytics/admin/settings'), 'Policy Settings' => ''],
        ]);
    }

    public function updateSettings(): void
    {
        $submitted = $_POST['settings'] ?? [];
        $reason = trim($_POST['reason'] ?? '');

        if (!$reason) {
            Session::flash('error', 'A mandatory administrative justification is required to update policy parameters.');
            redirect(url('analytics/admin/settings'));
            return;
        }

        $allSettings = Database::fetchAll("SELECT * FROM `ana_settings`");
        $settingsByKey = [];
        foreach ($allSettings as $s) {
            $settingsByKey[$s['key']] = $s;
        }

        // Server-Side Range Validation across all submitted keys
        foreach ($submitted as $key => $val) {
            if (!isset($settingsByKey[$key])) {
                continue;
            }
            $meta = $settingsByKey[$key];
            if (is_numeric($val)) {
                $numVal = (float) $val;
                if ($meta['min_value'] !== null && $numVal < (float) $meta['min_value']) {
                    Session::flash('error', "Value for '{$meta['label']}' ({$numVal}) is below the allowable minimum ({$meta['min_value']}).");
                    redirect(url('analytics/admin/settings'));
                    return;
                }
                if ($meta['max_value'] !== null && $numVal > (float) $meta['max_value']) {
                    Session::flash('error', "Value for '{$meta['label']}' ({$numVal}) exceeds the allowable maximum ({$meta['max_value']}).");
                    redirect(url('analytics/admin/settings'));
                    return;
                }
            }
        }

        // Apply validated changes
        $updatedCount = 0;
        foreach ($submitted as $key => $val) {
            if (!isset($settingsByKey[$key])) {
                continue;
            }
            $meta = $settingsByKey[$key];
            $oldVal = (string) $meta['value'];
            $newVal = (string) $val;

            if ($oldVal !== $newVal) {
                AnalyticsSettings::set($key, $val, (int) Auth::id());
                ChangeLog::record(
                    'setting',
                    (int) $meta['id'],
                    'update',
                    $key,
                    $oldVal,
                    $newVal,
                    $reason
                );
                $updatedCount++;
            }
        }

        Session::flash('success', "Institutional retention settings updated successfully ({$updatedCount} parameter(s) modified).");
        redirect(url('analytics/admin/settings'));
    }

    // ========================================================================
    // 3. Grading Templates (Part E2)
    // ========================================================================

    public function templates(): void
    {
        $templates = Database::fetchAll("SELECT * FROM `ana_grading_templates` WHERE `deleted_at` IS NULL ORDER BY is_default DESC, id DESC");
        View::render('analytics/Views/admin/templates', [
            'templates' => $templates,
            'title'     => 'Grading Templates - Analytics Admin',
            'crumbs'    => ['Analytics Admin' => url('analytics/admin/settings'), 'Grading Templates' => ''],
        ]);
    }

    public function createTemplate(): void
    {
        View::render('analytics/Views/admin/template_form', [
            'template' => null,
            'title'    => 'Create Grading Template - Analytics Admin',
            'crumbs'   => ['Analytics Admin' => url('analytics/admin/templates'), 'Create' => ''],
        ]);
    }

    public function storeTemplate(): void
    {
        $name = trim($_POST['name'] ?? '');
        $cutoff = (float) ($_POST['passing_cutoff'] ?? 3.04);
        $schemeJson = trim($_POST['scheme_json'] ?? '');

        if (!$name || !$schemeJson) {
            Session::flash('error', 'Template name and assessment structure are required.');
            redirect(url('analytics/admin/templates/create'));
            return;
        }

        $scheme = json_decode($schemeJson, true);
        if (!$scheme || empty($scheme['groups'])) {
            Session::flash('error', 'Invalid grading scheme JSON definition.');
            redirect(url('analytics/admin/templates/create'));
            return;
        }

        // Validate that category weights total exactly 100%
        $totalWeight = 0;
        $itemCodes = [];
        foreach ($scheme['groups'] as $g) {
            $totalWeight += (float) ($g['weight'] ?? 0);
            foreach ($g['items'] ?? [] as $it) {
                $code = strtoupper(trim($it['code'] ?? ''));
                if (in_array($code, $itemCodes, true)) {
                    Session::flash('error', "Duplicate assessment item code detected: '{$code}'. Item codes must be unique.");
                    redirect(url('analytics/admin/templates/create'));
                    return;
                }
                $itemCodes[] = $code;
            }
        }

        if (round($totalWeight, 1) != 100.0) {
            Session::flash('error', "Assessment category weights total {$totalWeight}%. Must equal exactly 100%.");
            redirect(url('analytics/admin/templates/create'));
            return;
        }

        $scheme['name'] = $name;
        $scheme['passingCutoff'] = $cutoff;

        $tplId = Database::insert('ana_grading_templates', [
            'name'           => $name,
            'scheme'         => json_encode($scheme, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'passing_cutoff' => $cutoff,
            'is_default'     => 0,
            'is_active'      => 1,
            'created_by'     => (int) Auth::id(),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        ChangeLog::record(
            'grading_template',
            (int) $tplId,
            'create',
            null,
            null,
            $name,
            'New grading template registered'
        );

        Session::flash('success', "Grading template '{$name}' created successfully.");
        redirect(url('analytics/admin/templates'));
    }

    public function editTemplate(string $id): void
    {
        $tplId = (int) $id;
        $template = Database::fetchOne("SELECT * FROM `ana_grading_templates` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $tplId]);
        if (!$template) {
            Session::flash('error', 'Grading template not found.');
            redirect(url('analytics/admin/templates'));
            return;
        }

        View::render('analytics/Views/admin/template_form', [
            'template' => $template,
            'title'    => "Edit Grading Template: {$template['name']}",
            'crumbs'   => ['Analytics Admin' => url('analytics/admin/templates'), 'Edit' => ''],
        ]);
    }

    public function updateTemplate(string $id): void
    {
        $tplId = (int) $id;
        $name = trim($_POST['name'] ?? '');
        $cutoff = (float) ($_POST['passing_cutoff'] ?? 3.04);
        $schemeJson = trim($_POST['scheme_json'] ?? '');
        $reason = trim($_POST['reason'] ?? '');

        if (!$reason) {
            Session::flash('error', 'A mandatory justification / reason is required to update a grading template.');
            redirect(url("analytics/admin/templates/{$tplId}/edit"));
            return;
        }

        $scheme = json_decode($schemeJson, true);
        if (!$scheme || empty($scheme['groups'])) {
            Session::flash('error', 'Invalid grading scheme definition.');
            redirect(url("analytics/admin/templates/{$tplId}/edit"));
            return;
        }

        // Validate weight sum
        $totalWeight = 0;
        foreach ($scheme['groups'] as $g) {
            $totalWeight += (float) ($g['weight'] ?? 0);
        }
        if (round($totalWeight, 1) != 100.0) {
            Session::flash('error', "Category weights total {$totalWeight}%. Must equal exactly 100%.");
            redirect(url("analytics/admin/templates/{$tplId}/edit"));
            return;
        }

        $scheme['name'] = $name;
        $scheme['passingCutoff'] = $cutoff;

        Database::update(
            'ana_grading_templates',
            [
                'name'           => $name,
                'scheme'         => json_encode($scheme, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'passing_cutoff' => $cutoff,
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            'id = :id',
            ['id' => $tplId]
        );

        ChangeLog::record(
            'grading_template',
            $tplId,
            'update',
            'scheme',
            null,
            $name,
            $reason
        );

        Session::flash('success', "Grading template '{$name}' updated successfully. Existing class offerings remain unaffected.");
        redirect(url('analytics/admin/templates'));
    }

    public function toggleTemplateActive(string $id): void
    {
        $tplId = (int) $id;
        $tpl = Database::fetchOne("SELECT * FROM `ana_grading_templates` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $tplId]);
        if (!$tpl) {
            Session::flash('error', 'Template not found.');
            redirect(url('analytics/admin/templates'));
            return;
        }

        if (!empty($tpl['is_default'])) {
            Session::flash('error', 'Cannot deactivate the institutional default grading template.');
            redirect(url('analytics/admin/templates'));
            return;
        }

        $newActive = $tpl['is_active'] ? 0 : 1;
        Database::update(
            'ana_grading_templates',
            ['is_active' => $newActive, 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $tplId]
        );

        ChangeLog::record(
            'grading_template',
            $tplId,
            'toggle_active',
            'is_active',
            (string) $tpl['is_active'],
            (string) $newActive,
            'Template status toggled'
        );

        Session::flash('success', "Template status updated.");
        redirect(url('analytics/admin/templates'));
    }

    public function setTemplateDefault(string $id): void
    {
        $tplId = (int) $id;
        $tpl = Database::fetchOne("SELECT * FROM `ana_grading_templates` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $tplId]);
        if (!$tpl) {
            Session::flash('error', 'Template not found.');
            redirect(url('analytics/admin/templates'));
            return;
        }

        $db = Database::pdo();
        $db->exec("UPDATE `ana_grading_templates` SET `is_default` = 0 WHERE `deleted_at` IS NULL");
        Database::update(
            'ana_grading_templates',
            ['is_default' => 1, 'is_active' => 1, 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $tplId]
        );

        ChangeLog::record(
            'grading_template',
            $tplId,
            'set_default',
            'is_default',
            '0',
            '1',
            "Set '{$tpl['name']}' as institutional default template"
        );

        Session::flash('success', "Template '{$tpl['name']}' set as institutional default.");
        redirect(url('analytics/admin/templates'));
    }

    // ========================================================================
    // 4. Governance Audit Change Log (Part E)
    // ========================================================================

    public function changeLog(): void
    {
        if (AnalyticsAccess::isFacultyScope()) {
            // Faculty: only their own actions and entries about their own classes
            $uid = (int) Auth::id();
            $logs = Database::fetchAll(
                "SELECT cl.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name, u.email AS user_email
                 FROM `ana_change_log` cl
                 LEFT JOIN `users` u ON cl.changed_by = u.id
                 WHERE cl.changed_by = :uid
                    OR (cl.entity IN ('class', 'class_roster') AND cl.entity_id IN (SELECT id FROM `ana_classes` WHERE faculty_user_id = :fid))
                 ORDER BY cl.id DESC LIMIT 100",
                ['uid' => $uid, 'fid' => $uid]
            );
        } else {
            $logs = ChangeLog::recent(100);
        }
        View::render('analytics/Views/admin/change_log', [
            'logs'   => $logs,
            'title'  => 'Governance Change Log - Analytics Admin',
            'crumbs' => ['Analytics Admin' => url('analytics/admin/change-log'), 'Audit History' => ''],
        ]);
    }

    // ========================================================================
    // 5. Dashboard Notes (Part E10)
    // ========================================================================

    public function storeNote(): void
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Note title is required.');
            redirect(url('analytics'));
            return;
        }

        $noteId = Database::insert('ana_records', [
            'title'       => mb_substr($title, 0, 191),
            'description' => $description,
            'status'      => 'active',
            'created_by'  => (int) Auth::id(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        ChangeLog::record(
            'note',
            (int) $noteId,
            'create',
            'title',
            null,
            $title,
            'Manual dashboard note created'
        );

        Session::flash('success', 'Dashboard note added successfully.');
        redirect(url('analytics'));
    }

    public function archiveNote(string $id): void
    {
        $noteId = (int) $id;
        $userId = (int) Auth::id();

        // Admins can only archive manual notes created by themselves (E10)
        $note = Database::fetchOne(
            "SELECT * FROM `ana_records` WHERE `id` = :id AND `created_by` = :uid AND `deleted_at` IS NULL LIMIT 1",
            ['id' => $noteId, 'uid' => $userId]
        );

        if (!$note) {
            Session::flash('error', 'Note not found or system-generated entries cannot be archived.');
            redirect(url('analytics'));
            return;
        }

        Database::update(
            'ana_records',
            ['status' => 'archived', 'deleted_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $noteId]
        );

        ChangeLog::record(
            'note',
            $noteId,
            'archive',
            'status',
            'active',
            'archived',
            'Manual dashboard note archived'
        );

        Session::flash('success', 'Note archived successfully.');
        redirect(url('analytics'));
    }

    // ========================================================================
    // 6. Admin Class Record Oversight (Part E4: Read-Only Matrix)
    // ========================================================================

    public function classRecordView(string $id): void
    {
        $classId = (int) $id;
        if (!AnalyticsAccess::canSeeClass($classId)) {
            AnalyticsAccess::notFound();
        }
        $class = Database::fetchOne("
            SELECT c.*,
                   COALESCE(c.subject_code, s.code) AS subject_code,
                   COALESCE(c.subject_title, s.title) AS subject_title,
                   COALESCE(c.units, s.units) AS subject_units,
                   COALESCE(c.section_name, sec.name) AS section_name,
                   sec.year_level,
                   CONCAT(u.first_name, ' ', u.last_name) AS faculty_name,
                   u.email AS faculty_email,
                   sem.name AS semester_name,
                   ay.label AS academic_year_label
            FROM `ana_classes` c
            LEFT JOIN `subjects` s ON c.subject_id = s.id
            LEFT JOIN `sections` sec ON c.section_id = sec.id
            LEFT JOIN `users` u ON c.faculty_user_id = u.id
            LEFT JOIN `semesters` sem ON c.semester_id = sem.id
            LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
            WHERE c.id = :id AND c.deleted_at IS NULL LIMIT 1
        ", ['id' => $classId]);

        if (!$class) {
            Session::flash('error', 'Class offering not found.');
            redirect(url('analytics/admin/classes'));
            return;
        }

        $scheme = ClassRecord::scheme($class);

        $students = Database::fetchAll("
            SELECT cs.student_id, st.student_number, st.first_name, st.last_name, p.code AS program_code
            FROM `ana_class_students` cs
            JOIN `students` st ON cs.student_id = st.id
            LEFT JOIN `programs` p ON st.program_id = p.id
            WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND st.deleted_at IS NULL
            ORDER BY st.last_name ASC, st.first_name ASC
        ", ['cid' => $classId]);

        $rawScores = Database::fetchAll("SELECT student_id, item_code, score, submission_status FROM `ana_class_scores` WHERE class_id = :cid", ['cid' => $classId]);
        $scoresMap = [];
        foreach ($rawScores as $rs) {
            $scoresMap[(int) $rs['student_id']][$rs['item_code']] = (float) $rs['score'];
        }

        // Grade rows of a class returned to draft (approved correction) are not official until re-posted
        $postedMap = [];
        if (ClassRecord::isPublished($class)) {
            foreach (Database::fetchAll("SELECT * FROM `ana_class_grades` WHERE class_id = :cid", ['cid' => $classId]) as $pg) {
                $postedMap[(int) $pg['student_id']] = $pg;
            }
        }

        View::render('analytics/Views/admin/class_record_view', [
            'class'     => $class,
            'scheme'    => $scheme,
            'students'  => $students,
            'scoresMap' => $scoresMap,
            'postedMap' => $postedMap,
            'title'     => "Oversight: {$class['subject_code']} - {$class['section_name']} (Read-Only)",
            'crumbs'    => ['Analytics Admin' => url('analytics/admin/classes'), 'Class Record Oversight' => ''],
        ]);
    }
    // ========================================================================
    // 7. Grade Correction Requests (Part E5)
    // ========================================================================

    public function correctionRequests(): void
    {
        $pendingRequests = Database::fetchAll("
            SELECT cr.*, 
                   COALESCE(c.subject_code, s.code) AS subject_code,
                   COALESCE(c.subject_title, s.title) AS subject_title,
                   COALESCE(c.section_name, sec.name) AS section_name,
                   c.grade_status AS class_grade_status,
                   CONCAT(req.first_name, ' ', req.last_name) AS requester_name,
                   req.email AS requester_email
            FROM `ana_grade_change_requests` cr
            JOIN `ana_classes` c ON cr.class_id = c.id
            LEFT JOIN `subjects` s ON c.subject_id = s.id
            LEFT JOIN `sections` sec ON c.section_id = sec.id
            JOIN `users` req ON cr.requested_by = req.id
            WHERE cr.status = 'pending'
            ORDER BY cr.created_at ASC
        ");

        $historyRequests = Database::fetchAll("
            SELECT cr.*, 
                   COALESCE(c.subject_code, s.code) AS subject_code,
                   COALESCE(c.subject_title, s.title) AS subject_title,
                   COALESCE(c.section_name, sec.name) AS section_name,
                   CONCAT(req.first_name, ' ', req.last_name) AS requester_name,
                   CONCAT(rev.first_name, ' ', rev.last_name) AS reviewer_name
            FROM `ana_grade_change_requests` cr
            JOIN `ana_classes` c ON cr.class_id = c.id
            LEFT JOIN `subjects` s ON c.subject_id = s.id
            LEFT JOIN `sections` sec ON c.section_id = sec.id
            JOIN `users` req ON cr.requested_by = req.id
            LEFT JOIN `users` rev ON cr.reviewed_by = rev.id
            WHERE cr.status != 'pending'
            ORDER BY cr.updated_at DESC
            LIMIT 50
        ");

        View::render('analytics/Views/admin/correction_requests', [
            'pendingRequests' => $pendingRequests,
            'historyRequests' => $historyRequests,
            'title'           => 'Grade Correction Requests - Analytics Admin',
            'crumbs'          => ['Analytics Admin' => url('analytics/admin/classes'), 'Correction Requests' => ''],
        ]);
    }

    public function approveCorrection(string $id): void
    {
        $reqId = (int) $id;
        $req = Database::fetchOne(
            "SELECT * FROM `ana_grade_change_requests` WHERE `id` = :id AND `status` = 'pending' LIMIT 1",
            ['id' => $reqId]
        );

        if (!$req) {
            Session::flash('error', 'Pending correction request not found.');
            redirect(url('analytics/admin/corrections'));
            return;
        }

        $reviewNote = trim($_POST['review_note'] ?? '');
        $reviewerId = (int) Auth::id();

        Database::update(
            'ana_grade_change_requests',
            [
                'status'      => 'approved',
                'review_note' => $reviewNote ?: 'Approved by module administrator',
                'reviewed_by' => $reviewerId,
                'reviewed_at' => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            '`id` = :id',
            ['id' => $reqId]
        );

        // Unlock class back to draft so faculty can edit scores and re-post
        Database::update(
            'ana_classes',
            [
                'grade_status' => 'draft',
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            '`id` = :cid',
            ['cid' => (int) $req['class_id']]
        );

        ChangeLog::record(
            'grade_correction',
            $reqId,
            'approve',
            'grade_status',
            'posted',
            'draft',
            $reviewNote ?: "Admin approved correction request #{$reqId}; unlocked class #{$req['class_id']}"
        );

        Notifier::user((int) $req['requested_by'], "Correction approved for class #{$req['class_id']}",
            'The class record is unlocked for your edits. Post the grades again when you are done.', 'analytics/faculty/classes/' . (int) $req['class_id']);

        Session::flash('success', "Correction request #{$reqId} approved. The class is back in draft for the faculty to edit; administrators still cannot change grades.");
        redirect(url('analytics/admin/corrections'));
    }

    public function rejectCorrection(string $id): void
    {
        $reqId = (int) $id;
        $req = Database::fetchOne(
            "SELECT * FROM `ana_grade_change_requests` WHERE `id` = :id AND `status` = 'pending' LIMIT 1",
            ['id' => $reqId]
        );

        if (!$req) {
            Session::flash('error', 'Pending correction request not found.');
            redirect(url('analytics/admin/corrections'));
            return;
        }

        $reviewNote = trim($_POST['review_note'] ?? '');
        if (strlen($reviewNote) < 5) {
            Session::flash('error', 'A review note explaining the rejection reason is required.');
            redirect(url('analytics/admin/corrections'));
            return;
        }

        $reviewerId = (int) Auth::id();

        Database::update(
            'ana_grade_change_requests',
            [
                'status'      => 'rejected',
                'review_note' => $reviewNote,
                'reviewed_by' => $reviewerId,
                'reviewed_at' => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            '`id` = :id',
            ['id' => $reqId]
        );

        ChangeLog::record(
            'grade_correction',
            $reqId,
            'reject',
            'status',
            'pending',
            'rejected',
            $reviewNote
        );

        Notifier::user((int) $req['requested_by'], "Correction request declined for class #{$req['class_id']}", $reviewNote, 'analytics/faculty/classes/' . (int) $req['class_id']);

        Session::flash('info', "Correction request #{$reqId} rejected.");
        redirect(url('analytics/admin/corrections'));
    }

    // ========================================================================
    // 8. Incomplete (INC) Deadline Extensions (Part E6)
    // ========================================================================

    public function extendInc(string $id): void
    {
        $gradeId = (int) $id;
        $grade = Database::fetchOne("
            SELECT g.*, st.student_number, CONCAT(st.first_name, ' ', st.last_name) AS student_name,
                   COALESCE(c.subject_code, 'Subject') AS subject_code
            FROM `ana_class_grades` g
            JOIN `students` st ON g.student_id = st.id
            JOIN `ana_classes` c ON g.class_id = c.id
            WHERE g.id = :id LIMIT 1
        ", ['id' => $gradeId]);

        if (!$grade) {
            Session::flash('error', 'Grade record not found.');
            redirect(url('analytics/failedincompletemonitoring'));
            return;
        }

        $newDeadline = $_POST['new_deadline'] ?? '';
        $reason = trim($_POST['reason'] ?? '');

        $parsed = \DateTime::createFromFormat('Y-m-d', (string) $newDeadline);
        if ($grade['remarks'] !== 'INC' || $grade['inc_resolved_at']) {
            Session::flash('error', 'Only unresolved INC grades can be extended.');
            redirect(url('analytics/failedincompletemonitoring'));
            return;
        }
        if (!$parsed || $parsed->format('Y-m-d') !== $newDeadline || $newDeadline <= date('Y-m-d') || strlen($reason) < 10) {
            Session::flash('error', 'A valid future deadline date and comprehensive reason (min 10 characters) are required.');
            redirect(url('analytics/failedincompletemonitoring'));
            return;
        }

        if (!empty($grade['inc_deadline']) && $newDeadline <= $grade['inc_deadline']) {
            Session::flash('error', "Extended deadline must be later than the existing deadline ({$grade['inc_deadline']}).");
            redirect(url('analytics/failedincompletemonitoring'));
            return;
        }

        Database::update(
            'ana_class_grades',
            ['inc_deadline' => $newDeadline, 'updated_at' => date('Y-m-d H:i:s')],
            '`id` = :id',
            ['id' => $gradeId]
        );

        ChangeLog::record(
            'inc_deadline',
            $gradeId,
            'extend',
            'inc_deadline',
            $grade['inc_deadline'] ?? 'None',
            $newDeadline,
            $reason
        );

        Notifier::student((int) $grade['student_id'], "INC deadline extended: {$grade['subject_code']}", "New deadline: {$newDeadline}.", 'analytics/my/deficiencies');

        Session::flash('success', "Incomplete requirement deadline for {$grade['student_name']} extended to {$newDeadline}.");
        redirect(url('analytics/failedincompletemonitoring'));
    }

    // ========================================================================
    // 9. Attendance Voiding (Part E7)
    // ========================================================================

    public function voidAttendance(string $id): void
    {
        $attId = (int) $id;
        $rec = Database::fetchOne("SELECT * FROM `ana_attendance_records` WHERE `id` = :id AND `voided_at` IS NULL LIMIT 1", ['id' => $attId]);

        if (!$rec) {
            Session::flash('error', 'Attendance record not found or already voided.');
            redirect(url('analytics/attendancerecords'));
            return;
        }

        $reason = trim($_POST['reason'] ?? '');
        if (strlen($reason) < 10) {
            Session::flash('error', 'A mandatory administrative justification (min 10 characters) is required to void an attendance record.');
            redirect(url('analytics/attendancerecords'));
            return;
        }

        Database::update(
            'ana_attendance_records',
            [
                'voided_at'   => date('Y-m-d H:i:s'),
                'voided_by'   => (int) Auth::id(),
                'void_reason' => mb_substr($reason, 0, 255),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            '`id` = :id',
            ['id' => $attId]
        );

        ChangeLog::record(
            'attendance',
            $attId,
            'void',
            'voided_at',
            null,
            date('Y-m-d H:i:s'),
            $reason
        );

        Session::flash('success', "Attendance record #{$attId} has been successfully voided.");
        redirect(url('analytics/attendancerecords'));
    }

    // ========================================================================
    // 10. Conduct Case Workflow & Reclassification (Part E9)
    // ========================================================================

    public function updateConductStatus(string $id): void
    {
        $conductId = (int) $id;
        $rec = Database::fetchOne("SELECT * FROM `ana_behavior_records` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $conductId]);

        if (!$rec) {
            Session::flash('error', 'Conduct incident record not found.');
            redirect(url('analytics/behaviorrecords'));
            return;
        }

        $status = $_POST['status'] ?? '';
        if ($status === 'Under Investigation') {
            $status = 'Investigating';
        }
        if (!in_array($status, ['Reported', 'Investigating', 'Resolved', 'Dismissed'], true)) {
            Session::flash('error', 'Invalid conduct case status.');
            redirect(url('analytics/behaviorrecords'));
            return;
        }

        $notes = trim($_POST['resolution_notes'] ?? '');
        $adminId = (int) Auth::id();

        Database::update(
            'ana_behavior_records',
            [
                'status'           => $status,
                'resolution_notes' => $notes,
                'resolved_by'      => in_array($status, ['Resolved', 'Dismissed'], true) ? $adminId : null,
                'resolved_at'      => in_array($status, ['Resolved', 'Dismissed'], true) ? date('Y-m-d H:i:s') : null,
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            '`id` = :id',
            ['id' => $conductId]
        );

        ChangeLog::record(
            'conduct',
            $conductId,
            'update_status',
            'status',
            $rec['status'],
            $status,
            $notes ?: "Admin moved conduct incident status to {$status}"
        );

        Session::flash('success', "Conduct incident #{$conductId} status updated to {$status}.");
        redirect(url('analytics/behaviorrecords'));
    }

    public function updateConductSeverity(string $id): void
    {
        $conductId = (int) $id;
        $rec = Database::fetchOne("SELECT * FROM `ana_behavior_records` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $conductId]);

        if (!$rec) {
            Session::flash('error', 'Conduct incident record not found.');
            redirect(url('analytics/behaviorrecords'));
            return;
        }

        $severity = $_POST['severity'] ?? '';
        if (!in_array($severity, ['Minor', 'Moderate', 'Severe'], true)) {
            Session::flash('error', 'Invalid severity level.');
            redirect(url('analytics/behaviorrecords'));
            return;
        }

        $reason = trim($_POST['reason'] ?? '');
        if (strlen($reason) < 10) {
            Session::flash('error', 'A mandatory administrative justification (min 10 characters) is required to reclassify incident severity.');
            redirect(url('analytics/behaviorrecords'));
            return;
        }

        Database::update(
            'ana_behavior_records',
            ['severity' => $severity, 'updated_at' => date('Y-m-d H:i:s')],
            '`id` = :id',
            ['id' => $conductId]
        );

        ChangeLog::record(
            'conduct',
            $conductId,
            'reclassify_severity',
            'severity',
            $rec['severity'],
            $severity,
            $reason
        );

        Session::flash('success', "Conduct incident #{$conductId} reclassified from {$rec['severity']} to {$severity}.");
        redirect(url('analytics/behaviorrecords'));
    }

    // ========================================================================
    // 11. Supplementary Student Retention Profiles (Part E8)
    // ========================================================================

    public function editStudentProfile(string $studentId): void
    {
        $sid = (int) $studentId;
        $student = Database::fetchOne("
            SELECT s.*, p.name AS program_name, p.code AS program_code, sec.name AS section_name
            FROM `students` s
            LEFT JOIN `programs` p ON s.program_id = p.id
            LEFT JOIN `sections` sec ON s.section_id = sec.id
            WHERE s.id = :id AND s.deleted_at IS NULL LIMIT 1
        ", ['id' => $sid]);

        if (!$student) {
            Session::flash('error', 'Student record not found.');
            redirect(url('analytics/profile'));
            return;
        }

        $profile = Database::fetchOne("SELECT * FROM `ana_student_profiles` WHERE `student_id` = :sid LIMIT 1", ['sid' => $sid]);

        View::render('analytics/Views/admin/student_profile_form', [
            'student' => $student,
            'profile' => $profile,
            'title'   => "Supplementary Profile: {$student['first_name']} {$student['last_name']}",
            'crumbs'  => ['Academic Analytics' => url('analytics/profile'), 'Supplementary Profile' => ''],
        ]);
    }

    public function updateStudentProfile(string $studentId): void
    {
        $sid = (int) $studentId;
        $student = Database::fetchOne("SELECT id FROM `students` WHERE `id` = :id AND `deleted_at` IS NULL LIMIT 1", ['id' => $sid]);
        if (!$student) {
            Session::flash('error', 'Student not found.');
            redirect(url('analytics/profile'));
            return;
        }

        $livingArrangement = $_POST['living_arrangement'] ?? 'with_family';
        $commuteCategory = $_POST['commute_category'] ?? 'local';
        $isWorkingStudent = !empty($_POST['is_working_student']) ? 1 : 0;
        $isScholar = !empty($_POST['is_scholar']) ? 1 : 0;
        $scholarshipName = trim($_POST['scholarship_name'] ?? '');
        $isFirstGen = !empty($_POST['is_first_generation']) ? 1 : 0;
        $notes = trim($_POST['notes'] ?? '');
        $adminId = (int) Auth::id();

        $pdo = Database::pdo();
        $stmt = $pdo->prepare("
            INSERT INTO `ana_student_profiles` 
                (`student_id`, `living_arrangement`, `commute_category`, `is_working_student`, `is_scholar`, `scholarship_name`, `is_first_generation`, `notes`, `updated_by`, `created_at`, `updated_at`)
            VALUES 
                (:sid, :la, :cc, :ws, :sc, :sn, :fg, :notes, :uid, NOW(), NOW())
            ON DUPLICATE KEY UPDATE 
                `living_arrangement`  = VALUES(`living_arrangement`),
                `commute_category`    = VALUES(`commute_category`),
                `is_working_student`  = VALUES(`is_working_student`),
                `is_scholar`          = VALUES(`is_scholar`),
                `scholarship_name`    = VALUES(`scholarship_name`),
                `is_first_generation` = VALUES(`is_first_generation`),
                `notes`               = VALUES(`notes`),
                `updated_by`          = VALUES(`updated_by`),
                `updated_at`          = NOW()
        ");

        $stmt->execute([
            'sid'   => $sid,
            'la'    => $livingArrangement,
            'cc'    => $commuteCategory,
            'ws'    => $isWorkingStudent,
            'sc'    => $isScholar,
            'sn'    => $scholarshipName,
            'fg'    => $isFirstGen,
            'notes' => $notes,
            'uid'   => $adminId,
        ]);

        ChangeLog::record(
            'student_profile',
            $sid,
            'update_profile',
            'supplementary_data',
            null,
            $livingArrangement,
            'Admin updated supplementary retention demographic profile'
        );

        Session::flash('success', 'Supplementary retention profile updated successfully.');
        redirect(url('analytics/profile?student_id=' . $sid));
    }

    // ========================================================================
    // 12. Program Head Mapping
    // ========================================================================

    public function programHeads(): void
    {
        $mappings = Database::fetchAll(
            "SELECT ph.id, ph.created_at, u.username, CONCAT(u.first_name, ' ', u.last_name) AS full_name, p.code, p.name AS program_name
             FROM `ana_program_heads` ph JOIN `users` u ON u.id = ph.user_id JOIN `programs` p ON p.id = ph.program_id
             ORDER BY u.last_name, p.code"
        );
        $heads = Database::fetchAll(
            "SELECT DISTINCT u.id, u.username, CONCAT(u.first_name, ' ', u.last_name) AS full_name
             FROM `users` u JOIN `user_roles` ur ON ur.user_id = u.id JOIN `roles` r ON r.id = ur.role_id
             WHERE r.slug = 'program_head' AND u.deleted_at IS NULL ORDER BY full_name"
        );
        View::render('analytics/Views/admin/program_heads', [
            'mappings' => $mappings,
            'heads'    => $heads,
            'programs' => Database::fetchAll("SELECT id, code, name FROM `programs` WHERE deleted_at IS NULL ORDER BY code"),
            'title'    => 'Program Heads',
            'crumbs'   => ['Analytics Admin' => url('analytics/admin/classes'), 'Program Heads' => ''],
        ]);
    }

    public function storeProgramHead(): void
    {
        $userId = (int) ($_POST['user_id'] ?? 0);
        $programId = (int) ($_POST['program_id'] ?? 0);
        $isHead = Database::fetchOne(
            "SELECT u.id FROM `users` u JOIN `user_roles` ur ON ur.user_id = u.id JOIN `roles` r ON r.id = ur.role_id
             WHERE u.id = :u AND r.slug = 'program_head' AND u.deleted_at IS NULL",
            ['u' => $userId]
        );
        $program = Database::fetchOne("SELECT id, code FROM `programs` WHERE id = :p AND deleted_at IS NULL", ['p' => $programId]);
        if (!$isHead || !$program) {
            redirect(url('analytics/admin/program-heads'), 'error', 'Choose a user with the Program Head role and a valid program.');
        }
        Database::query("INSERT IGNORE INTO `ana_program_heads` (`user_id`, `program_id`, `created_by`, `created_at`) VALUES (?, ?, ?, ?)",
            [$userId, $programId, (int) Auth::id(), date('Y-m-d H:i:s')]);
        ChangeLog::record('program_head', $userId, 'map', 'program_id', null, (string) $programId, "Mapped to {$program['code']}");
        redirect(url('analytics/admin/program-heads'), 'success', "Program {$program['code']} mapped.");
    }

    public function deleteProgramHead(string $id): void
    {
        $row = Database::fetchOne("SELECT * FROM `ana_program_heads` WHERE id = :id", ['id' => (int) $id]);
        if (!$row) {
            redirect(url('analytics/admin/program-heads'), 'error', 'Mapping not found.');
        }
        Database::delete('ana_program_heads', 'id = :id', ['id' => (int) $row['id']]);
        ChangeLog::record('program_head', (int) $row['user_id'], 'unmap', 'program_id', (string) $row['program_id'], null, 'Program mapping removed');
        redirect(url('analytics/admin/program-heads'), 'success', 'Mapping removed.');
    }

    /**
     * Helper to load active faculty users with name, email and position
     */
    private function loadFacultyUsers(): array
    {
        try {
            return Database::fetchAll("
                SELECT u.id, 
                       CONCAT(u.first_name, ' ', u.last_name) as full_name, 
                       u.email, 
                       e.position,
                       e.employee_number 
                FROM `users` u 
                JOIN `user_roles` ur ON u.id = ur.user_id 
                JOIN `roles` r ON ur.role_id = r.id 
                LEFT JOIN `employees` e ON u.id = e.user_id 
                WHERE r.slug IN ('faculty', 'lead_analytics')
                  AND u.deleted_at IS NULL 
                GROUP BY u.id 
                ORDER BY u.first_name ASC, u.last_name ASC
            ");
        } catch (\Throwable $e) {
            return [];
        }
    }
}
