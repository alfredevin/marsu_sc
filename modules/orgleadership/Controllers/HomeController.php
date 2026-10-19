<?php
namespace Modules\Orgleadership\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Leadership Accreditation & Officer Evaluation
 */
class HomeController {
    private const ORGANIZATION_STATUSES = [
        'Active',
        'Probationary',
        'Inactive',
        'Pending Accreditation',
    ];
    private const MEMBER_STATUSES = ['Active', 'Inactive', 'Suspended'];

    private static function ensureOrganizationTables(): void {
        $db = Database::pdo();
        $db->exec("CREATE TABLE IF NOT EXISTS `sld_organizations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(191) NOT NULL,
            `acronym` VARCHAR(50) NOT NULL,
            `category` VARCHAR(100) NOT NULL,
            `description` TEXT NULL,
            `adviser` VARCHAR(191) NOT NULL,
            `status` VARCHAR(50) NOT NULL DEFAULT 'Pending Accreditation',
            `accreditation_date` DATE NULL,
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            UNIQUE KEY `uq_sld_organizations_acronym` (`acronym`),
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $db->exec("CREATE TABLE IF NOT EXISTS `sld_members` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `organization_id` INT NOT NULL,
            `member_name` VARCHAR(191) NOT NULL,
            `student_number` VARCHAR(50) NULL,
            `role` VARCHAR(100) NOT NULL DEFAULT 'Member',
            `joined_at` DATE NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'Active',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            INDEX `idx_sld_members_organization` (`organization_id`),
            FOREIGN KEY (`organization_id`) REFERENCES `sld_organizations` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    private static function redirectWithError(string $message, string $path): void {
        Session::flash('error', $message);
        redirect(url($path));
    }

    private static function organizationInput(string $key): string {
        return trim((string)($_POST[$key] ?? ''));
    }

    public function storeOrganization(): void {
        self::ensureOrganizationTables();
        $name = self::organizationInput('name');
        $acronym = strtoupper(self::organizationInput('acronym'));
        $category = self::organizationInput('category');
        $description = self::organizationInput('description');
        $adviser = self::organizationInput('adviser');

        if ($name === '' || $acronym === '' || $category === '' || $adviser === '') {
            self::redirectWithError('Name, acronym, category, and adviser are required.', 'orgleadership/organization-profile');
        }

        try {
            Database::insert('sld_organizations', [
                'name' => $name,
                'acronym' => $acronym,
                'category' => $category,
                'description' => $description !== '' ? $description : null,
                'adviser' => $adviser,
                'status' => 'Pending Accreditation',
                'created_by' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Session::flash('success', 'Organization registered and queued for accreditation.');
        } catch (\PDOException $e) {
            Session::flash('error', $e->getCode() === '23000'
                ? 'That acronym is already registered.'
                : 'The organization could not be registered.');
        }
        redirect(url('orgleadership/organization-profile'));
    }

    public function updateOrganization(): void {
        self::ensureOrganizationTables();
        $id = (int)($_POST['organization_id'] ?? 0);
        $name = self::organizationInput('name');
        $acronym = strtoupper(self::organizationInput('acronym'));
        $category = self::organizationInput('category');
        $description = self::organizationInput('description');
        $adviser = self::organizationInput('adviser');
        $status = self::organizationInput('status');

        if ($id < 1 || $name === '' || $acronym === '' || $category === '' || $adviser === '' || !in_array($status, self::ORGANIZATION_STATUSES, true)) {
            self::redirectWithError('Please provide a valid organization and complete all required fields.', 'orgleadership/organization-profile');
        }

        try {
            Database::update('sld_organizations', [
                'name' => $name,
                'acronym' => $acronym,
                'category' => $category,
                'description' => $description !== '' ? $description : null,
                'adviser' => $adviser,
                'status' => $status,
                'accreditation_date' => $status === 'Active' ? date('Y-m-d') : null,
                'updated_at' => date('Y-m-d H:i:s'),
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Organization profile updated.');
        } catch (\PDOException $e) {
            Session::flash('error', $e->getCode() === '23000'
                ? 'That acronym is already registered.'
                : 'The organization profile could not be updated.');
        }
        redirect(url('orgleadership/organization-profile?id=' . $id));
    }

    public function updateOrganizationStatus(): void {
        self::ensureOrganizationTables();
        $id = (int)($_POST['organization_id'] ?? 0);
        $status = self::organizationInput('status');
        $accreditationDate = self::organizationInput('accreditation_date');

        if ($id < 1 || !in_array($status, self::ORGANIZATION_STATUSES, true)) {
            self::redirectWithError('Please select a valid organization status.', 'orgleadership/organization-profile');
        }
        if ($accreditationDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $accreditationDate)) {
            self::redirectWithError('Please provide a valid accreditation date.', 'orgleadership/organization-profile');
        }

        Database::update('sld_organizations', [
            'status' => $status,
            'accreditation_date' => $accreditationDate !== '' ? $accreditationDate : null,
            'updated_at' => date('Y-m-d H:i:s'),
        ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
        Session::flash('success', 'Organization classification, status, and accreditation date updated.');
        redirect(url('orgleadership/organization-profile'));
    }

    public function storeMember(): void {
        self::ensureOrganizationTables();
        $organizationId = (int)($_POST['organization_id'] ?? 0);
        $memberName = self::organizationInput('member_name');
        $studentNumber = self::organizationInput('student_number');
        $role = self::organizationInput('role') ?: 'Member';
        $joinedAt = self::organizationInput('joined_at');

        if ($organizationId < 1 || $memberName === '') {
            self::redirectWithError('Select an organization and provide the member name.', 'orgleadership/membership-records');
        }

        $organizationExists = Database::fetchColumn(
            'SELECT COUNT(*) FROM `sld_organizations` WHERE id = :id AND deleted_at IS NULL',
            ['id' => $organizationId]
        );
        if (!(int)$organizationExists) {
            self::redirectWithError('The selected organization does not exist.', 'orgleadership/membership-records');
        }

        Database::insert('sld_members', [
            'organization_id' => $organizationId,
            'member_name' => $memberName,
            'student_number' => $studentNumber !== '' ? $studentNumber : null,
            'role' => $role,
            'joined_at' => $joinedAt !== '' ? $joinedAt : null,
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        Session::flash('success', 'Membership record added.');
        redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
    }

    public function updateMemberStatus(): void {
        self::ensureOrganizationTables();
        $memberId = (int)($_POST['member_id'] ?? 0);
        $status = self::organizationInput('status');
        $organizationId = (int)($_POST['organization_id'] ?? 0);

        if ($memberId < 1 || $organizationId < 1 || !in_array($status, self::MEMBER_STATUSES, true)) {
            self::redirectWithError('Please select a valid membership status.', 'orgleadership/membership-records');
        }

        Database::update('sld_members', [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ], 'id = :member_id AND organization_id = :organization_id AND deleted_at IS NULL', [
            'member_id' => $memberId,
            'organization_id' => $organizationId,
        ]);
        Session::flash('success', 'Membership status updated.');
        redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
    }

    private const SUBMENUS = [
        'organizationRegistration' => ['organization-registration', 'Organization Registration and Accreditation'],
        'organizationProfile' => ['organization-profile', 'Organization Profile Management'],
        'membershipRecords' => ['membership-records', 'Membership Records'],
        'officerProfiles' => ['officer-profiles', 'Officer Profiles'],
        'leadershipPositions' => ['leadership-positions', 'Leadership Positions'],
        'termManagement' => ['term-management', 'Term Management'],
        'leadershipHistory' => ['leadership-history', 'Leadership History Records'],
        'trainingDevelopment' => ['training-development', 'Training and Development Tracking'],
        'activityProposals' => ['activity-proposals', 'Activity Proposal Submission'],
        'eventApprovals' => ['event-approvals', 'Event Approval Workflow'],
        'activityCalendar' => ['activity-calendar', 'Activity Calendar'],
        'venueSchedules' => ['venue-schedules', 'Venue and Schedule Management'],
        'eventDocumentation' => ['event-documentation', 'Event Documentation'],
        'attendanceMonitoring' => ['attendance-monitoring', 'Attendance Monitoring'],
        'participationTracking' => ['participation-tracking', 'Participation Tracking'],
        'involvementHistory' => ['involvement-history', 'Student Involvement History'],
        'engagementPoints' => ['engagement-points', 'Engagement Points and Credits'],
        'recognitionRecords' => ['recognition-records', 'Recognition Records'],
        'announcements' => ['announcements', 'Announcements'],
        'organizationUpdates' => ['organization-updates', 'Organization Updates'],
        'activityReminders' => ['activity-reminders', 'Activity Reminders'],
        'approvalNotifications' => ['approval-notifications', 'Approval Notifications'],
        'organizationPerformance' => ['organization-performance', 'Organization Performance Reports'],
        'participationStatistics' => ['participation-statistics', 'Student Participation Statistics'],
        'leadershipReports' => ['leadership-reports', 'Leadership Involvement Reports'],
        'activityReports' => ['activity-reports', 'Activity Accomplishment Reports'],
    ];

    private function renderSubmenu(string $action): void {
        [$view, $title] = self::SUBMENUS[$action];
        View::render('orgleadership/Views/' . $view, [
            'title' => $title,
            'moduleName' => 'Student Organization and Leadership Management',
            'slug' => 'orgleadership',
            'user' => Auth::user(),
            'crumbs' => [
                'Student Affairs (OSAS)' => '',
                'Student Organization and Leadership Management' => url('orgleadership'),
                $title => ''
            ],
        ]);
    }

    public function organizationRegistration(): void {
        self::ensureOrganizationTables();
        View::render('orgleadership/Views/organization-registration', [
            'title' => 'Organization Registration and Accreditation',
            'moduleName' => 'Student Organization and Leadership Management',
            'slug' => 'orgleadership',
            'user' => Auth::user(),
            'organizations' => Database::fetchAll(
                'SELECT * FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY created_at DESC'
            ),
            'crumbs' => ['Student Affairs (OSAS)' => '', 'Student Organization and Leadership Management' => url('orgleadership'), 'Organization Registration and Accreditation' => ''],
        ]);
    }

    public function organizationProfile(): void {
        self::ensureOrganizationTables();
        $organizations = Database::fetchAll(
            'SELECT * FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC'
        );
        $id = (int)($_GET['id'] ?? ($organizations[0]['id'] ?? 0));
        $organization = $id > 0 ? Database::fetchOne(
            'SELECT * FROM `sld_organizations` WHERE id = :id AND deleted_at IS NULL',
            ['id' => $id]
        ) : null;
        View::render('orgleadership/Views/organization-profile', [
            'title' => 'Organization Profile Management',
            'moduleName' => 'Student Organization and Leadership Management',
            'slug' => 'orgleadership',
            'user' => Auth::user(),
            'organizations' => $organizations,
            'organization' => $organization,
            'statuses' => self::ORGANIZATION_STATUSES,
            'crumbs' => ['Student Affairs (OSAS)' => '', 'Student Organization and Leadership Management' => url('orgleadership'), 'Organization Profile Management' => ''],
        ]);
    }

    public function membershipRecords(): void {
        self::ensureOrganizationTables();
        $organizations = Database::fetchAll(
            'SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC'
        );
        $organizationId = (int)($_GET['organization_id'] ?? ($organizations[0]['id'] ?? 0));
        $selectedOrganization = null;
        foreach ($organizations as $organization) {
            if ((int)$organization['id'] === $organizationId) {
                $selectedOrganization = $organization;
                break;
            }
        }
        $members = $organizationId > 0 ? Database::fetchAll(
            'SELECT * FROM `sld_members` WHERE organization_id = :organization_id AND deleted_at IS NULL ORDER BY member_name ASC',
            ['organization_id' => $organizationId]
        ) : [];
        View::render('orgleadership/Views/membership-records', [
            'title' => 'Membership Records',
            'moduleName' => 'Student Organization and Leadership Management',
            'slug' => 'orgleadership',
            'user' => Auth::user(),
            'organizations' => $organizations,
            'organizationId' => $organizationId,
            'selectedOrganization' => $selectedOrganization,
            'memberStatuses' => self::MEMBER_STATUSES,
            'members' => $members,
            'crumbs' => ['Student Affairs (OSAS)' => '', 'Student Organization and Leadership Management' => url('orgleadership'), 'Membership Records' => ''],
        ]);
    }

    public function officerProfiles(): void { $this->renderSubmenu(__FUNCTION__); }
    public function leadershipPositions(): void { $this->renderSubmenu(__FUNCTION__); }
    public function termManagement(): void { $this->renderSubmenu(__FUNCTION__); }
    public function leadershipHistory(): void { $this->renderSubmenu(__FUNCTION__); }
    public function trainingDevelopment(): void { $this->renderSubmenu(__FUNCTION__); }
    public function activityProposals(): void { $this->renderSubmenu(__FUNCTION__); }
    public function eventApprovals(): void { $this->renderSubmenu(__FUNCTION__); }
    public function activityCalendar(): void { $this->renderSubmenu(__FUNCTION__); }
    public function venueSchedules(): void { $this->renderSubmenu(__FUNCTION__); }
    public function eventDocumentation(): void { $this->renderSubmenu(__FUNCTION__); }
    public function attendanceMonitoring(): void { $this->renderSubmenu(__FUNCTION__); }
    public function participationTracking(): void { $this->renderSubmenu(__FUNCTION__); }
    public function involvementHistory(): void { $this->renderSubmenu(__FUNCTION__); }
    public function engagementPoints(): void { $this->renderSubmenu(__FUNCTION__); }
    public function recognitionRecords(): void { $this->renderSubmenu(__FUNCTION__); }
    public function announcements(): void { $this->renderSubmenu(__FUNCTION__); }
    public function organizationUpdates(): void { $this->renderSubmenu(__FUNCTION__); }
    public function activityReminders(): void { $this->renderSubmenu(__FUNCTION__); }
    public function approvalNotifications(): void { $this->renderSubmenu(__FUNCTION__); }
    public function organizationPerformance(): void { $this->renderSubmenu(__FUNCTION__); }
    public function participationStatistics(): void { $this->renderSubmenu(__FUNCTION__); }
    public function leadershipReports(): void { $this->renderSubmenu(__FUNCTION__); }
    public function activityReports(): void { $this->renderSubmenu(__FUNCTION__); }

    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `sld_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('orgleadership/Views/index', [
            'title'       => 'Student Leadership Accreditation & Officer Evaluation',
            'moduleName'  => 'Student Leadership Accreditation & Officer Evaluation',
            'slug'        => 'orgleadership',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Leadership Accreditation & Officer Evaluation' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `sld_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('orgleadership'));
        }

        View::render('orgleadership/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Student Leadership Accreditation & Officer Evaluation',
            'slug'        => 'orgleadership',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Student Leadership Accreditation & Officer Evaluation' => url('orgleadership'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('orgleadership'));
        }

        try {
            Database::insert('sld_records', [
                'title'       => $title,
                'description' => $description,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('orgleadership'));
    }
}
