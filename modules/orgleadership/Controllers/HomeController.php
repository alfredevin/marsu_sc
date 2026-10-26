<?php

namespace Modules\Orgleadership\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Leadership Accreditation & Officer Evaluation (SSO-LIMS)
 * Implements standard MarSU ERP CRUD pattern following SampleCrudController.
 */
class HomeController
{
    private const ORGANIZATION_STATUSES = [
        'Active',
        'Probationary',
        'Inactive',
        'Pending Accreditation',
        'Pending',
        'Suspended'
    ];
    private const MEMBER_STATUSES = ['Active', 'Inactive', 'Suspended', 'Pending', 'Removed'];
    private const OFFICER_STATUSES = ['Active', 'Inactive', 'Graduated', 'Removed'];
    private const TERM_STATUSES = ['Upcoming', 'Current', 'Completed'];
    private const TRAINING_STATUSES = ['Registered', 'Attended', 'Completed', 'Not Completed'];
    private const SUBMENUS = [
        'organizationRegistration' => ['organization-registration', 'Organization Registration and Accreditation'],
        'organizationProfile'      => ['organization-profile', 'Organization Profile Management'],
        'membershipRecords'        => ['membership-records', 'Membership Records'],
        'officerProfiles'          => ['officer-profiles', 'Officer Profiles'],
        'leadershipPositions'      => ['leadership-positions', 'Leadership Positions'],
        'termManagement'           => ['term-management', 'Term Management'],
        'leadershipHistory'        => ['leadership-history', 'Leadership History Records'],
        'trainingDevelopment'      => ['training-development', 'Training and Development Tracking'],
        'activityProposals'        => ['activity-proposals', 'Activity Proposal Submission'],
        'eventApprovals'           => ['event-approvals', 'Event Approval Workflow'],
        'activityCalendar'         => ['activity-calendar', 'Activity Calendar'],
        'venueSchedules'           => ['venue-schedules', 'Venue and Schedule Management'],
        'eventDocumentation'       => ['event-documentation', 'Event Documentation'],
        'attendanceMonitoring'     => ['attendance-monitoring', 'Attendance Monitoring'],
        'participationTracking'    => ['participation-tracking', 'Participation Tracking'],
        'involvementHistory'       => ['involvement-history', 'Student Involvement History'],
        'engagementPoints'         => ['engagement-points', 'Engagement Points and Credits'],
        'recognitionRecords'       => ['recognition-records', 'Recognition Records'],
        'announcements'            => ['announcements', 'Announcements'],
        'organizationUpdates'      => ['organization-updates', 'Organization Updates'],
        'activityReminders'        => ['activity-reminders', 'Activity Reminders'],
        'approvalNotifications'    => ['approval-notifications', 'Approval Notifications'],
        'organizationPerformance'  => ['organization-performance', 'Organization Performance Reports'],
        'participationStatistics'  => ['participation-statistics', 'Student Participation Statistics'],
        'leadershipReports'        => ['leadership-reports', 'Leadership Involvement Reports'],
        'activityReports'          => ['activity-reports', 'Activity Accomplishment Reports'],
    ];

    /* =========================================================================
     * 1. Dashboard & Core Record CRUD (SampleCrud Pattern)
     * ========================================================================= */

    public function index(): void
    {
        $user = Auth::user();

        $records = [];
        try {
            $records = Database::fetchAll(
                "SELECT * FROM `sld_records` WHERE deleted_at IS NULL ORDER BY created_at DESC"
            );
        } catch (\Exception $e) {
            $records = [];
        }

        View::render('orgleadership/Views/index', [
            'title'      => 'Student Leadership Accreditation & Officer Evaluation',
            'moduleName' => 'Student Leadership Accreditation & Officer Evaluation',
            'slug'       => 'orgleadership',
            'records'    => $records,
            'user'       => $user,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Leadership Accreditation & Officer Evaluation' => ''
            ]
        ]);
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne(
            "SELECT * FROM `sld_records` WHERE id = :id AND deleted_at IS NULL",
            ['id' => $id]
        );

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('orgleadership'));
            return;
        }

        View::render('orgleadership/Views/index', [
            'title'      => "View Record #{$id}",
            'moduleName' => 'Student Leadership Accreditation & Officer Evaluation',
            'slug'       => 'orgleadership',
            'record'     => $record,
            'records'    => [],
            'crumbs'     => [
                'Student Leadership Accreditation & Officer Evaluation' => url('orgleadership'),
                'View' => ''
            ]
        ]);
    }

    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($title === '') {
            Session::flash('error', 'Title is required.');
            redirect(url('orgleadership'));
            return;
        }

        try {
            Database::insert('sld_records', [
                'title'       => $title,
                'description' => $description !== '' ? $description : null,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "New entry \"{$title}\" added successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('orgleadership'));
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = trim($_POST['status'] ?? 'active');

        if ($id <= 0 || $title === '') {
            Session::flash('error', 'Valid record ID and Title are required.');
            redirect(url('orgleadership'));
            return;
        }

        try {
            Database::update('sld_records', [
                'title'       => $title,
                'description' => $description !== '' ? $description : null,
                'status'      => $status,
                'updated_at'  => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);

            Session::flash('success', "Entry #{$id} updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update record: ' . $e->getMessage());
        }

        redirect(url('orgleadership'));
    }

    public function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            Database::update('sld_records', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);

            Session::flash('success', "Record #{$id} archived successfully.");
        }

        redirect(url('orgleadership'));
    }

    /* =========================================================================
     * 2. Organization Management CRUD
     * ========================================================================= */

    public function storeOrganization(): void
    {
        $name = trim($_POST['name'] ?? '');
        $acronym = strtoupper(trim($_POST['acronym'] ?? ''));
        $category = trim($_POST['category'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $adviser = trim($_POST['adviser'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contactNumber = trim($_POST['contact_number'] ?? '');
        $schoolYear = trim($_POST['school_year'] ?? '');

        if ($name === '' || $acronym === '' || $category === '' || $adviser === '') {
            Session::flash('error', 'Name, acronym, category, and adviser are required.');
            redirect(url('orgleadership/organization-profile'));
            return;
        }

        try {
            Database::insert('sld_organizations', [
                'name'              => $name,
                'organization_name' => $name,
                'acronym'           => $acronym,
                'category'          => $category,
                'description'       => $description !== '' ? $description : null,
                'adviser'           => $adviser,
                'email'             => $email !== '' ? $email : null,
                'contact_number'    => $contactNumber !== '' ? $contactNumber : null,
                'school_year'       => $schoolYear !== '' ? $schoolYear : null,
                'status'            => 'Pending Accreditation',
                'created_by'        => Auth::id(),
                'created_at'        => date('Y-m-d H:i:s'),
            ]);
            Session::flash('success', "Organization \"{$name}\" registered and queued for accreditation.");
        } catch (\PDOException $e) {
            Session::flash('error', $e->getCode() === '23000'
                ? 'That acronym is already registered.'
                : 'The organization could not be registered: ' . $e->getMessage());
        }

        redirect(url('orgleadership/organization-profile'));
    }

    public function updateOrganization(): void
    {
        $id = (int)($_POST['organization_id'] ?? $_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $acronym = strtoupper(trim($_POST['acronym'] ?? ''));
        $category = trim($_POST['category'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $adviser = trim($_POST['adviser'] ?? '');
        $status = trim($_POST['status'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contactNumber = trim($_POST['contact_number'] ?? '');

        if ($id < 1 || $name === '' || $acronym === '' || $category === '' || $adviser === '') {
            Session::flash('error', 'Please provide a valid organization and complete all required fields.');
            redirect(url('orgleadership/organization-profile'));
            return;
        }

        try {
            $data = [
                'name'              => $name,
                'organization_name' => $name,
                'acronym'           => $acronym,
                'category'          => $category,
                'description'       => $description !== '' ? $description : null,
                'adviser'           => $adviser,
                'updated_at'        => date('Y-m-d H:i:s'),
            ];

            if ($email !== '') {
                $data['email'] = $email;
            }
            if ($contactNumber !== '') {
                $data['contact_number'] = $contactNumber;
            }
            if (in_array($status, self::ORGANIZATION_STATUSES, true)) {
                $data['status'] = $status;
                if ($status === 'Active') {
                    $data['accreditation_date'] = date('Y-m-d');
                }
            }

            Database::update('sld_organizations', $data, 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Organization profile for \"{$name}\" updated successfully.");
        } catch (\PDOException $e) {
            Session::flash('error', $e->getCode() === '23000'
                ? 'That acronym is already registered.'
                : 'The organization profile could not be updated.');
        }

        redirect(url('orgleadership/organization-profile?id=' . $id));
    }

    public function updateOrganizationStatus(): void
    {
        $id = (int)($_POST['organization_id'] ?? $_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $accreditationDate = trim($_POST['accreditation_date'] ?? '');

        if ($id < 1 || !in_array($status, self::ORGANIZATION_STATUSES, true)) {
            Session::flash('error', 'Please select a valid organization status.');
            redirect(url('orgleadership/organization-profile'));
            return;
        }

        if ($accreditationDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $accreditationDate)) {
            Session::flash('error', 'Please provide a valid accreditation date (YYYY-MM-DD).');
            redirect(url('orgleadership/organization-profile'));
            return;
        }

        try {
            Database::update('sld_organizations', [
                'status'             => $status,
                'accreditation_date' => $accreditationDate !== '' ? $accreditationDate : null,
                'updated_at'         => date('Y-m-d H:i:s'),
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);

            Session::flash('success', 'Organization classification, status, and accreditation date updated.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update organization status: ' . $e->getMessage());
        }

        redirect(url('orgleadership/organization-profile'));
    }

    public function deleteOrganization(): void
    {
        $id = (int)($_POST['organization_id'] ?? $_POST['id'] ?? 0);

        if ($id > 0) {
            Database::update('sld_organizations', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);

            Session::flash('success', "Organization #{$id} archived successfully.");
        }

        redirect(url('orgleadership/organization-profile'));
    }

    /* =========================================================================
     * 3. Membership Records CRUD
     * ========================================================================= */

    public function storeMember(): void
    {
        $organizationId = (int)($_POST['organization_id'] ?? 0);
        $memberName = trim($_POST['member_name'] ?? '');
        $studentNumber = trim($_POST['student_number'] ?? '');
        $role = trim($_POST['role'] ?? '') ?: 'Member';
        $joinedAt = trim($_POST['joined_at'] ?? '');
        $schoolYear = trim($_POST['school_year'] ?? '') ?: date('Y') . '-' . (date('Y') + 1);

        if ($organizationId < 1 || $memberName === '') {
            Session::flash('error', 'Select an organization and provide the member name.');
            redirect(url('orgleadership/membership-records'));
            return;
        }

        $organizationExists = (int)Database::fetchColumn(
            'SELECT COUNT(*) FROM `sld_organizations` WHERE id = :id AND deleted_at IS NULL',
            ['id' => $organizationId]
        );

        if (!$organizationExists) {
            Session::flash('error', 'The selected organization does not exist.');
            redirect(url('orgleadership/membership-records'));
            return;
        }

        try {
            // Insert into primary sld_members table
            Database::insert('sld_members', [
                'organization_id' => $organizationId,
                'member_name'     => $memberName,
                'student_number'  => $studentNumber !== '' ? $studentNumber : null,
                'role'            => $role,
                'joined_at'       => $joinedAt !== '' ? $joinedAt : date('Y-m-d'),
                'status'          => 'Active',
                'created_at'      => date('Y-m-d H:i:s'),
            ]);

            // Also keep sld_organization_memberships in sync if student number is provided
            if ($studentNumber !== '') {
                try {
                    Database::insert('sld_organization_memberships', [
                        'organization_id'   => $organizationId,
                        'student_id'        => $studentNumber,
                        'joined_date'       => $joinedAt !== '' ? $joinedAt : date('Y-m-d'),
                        'membership_status' => 'Active',
                        'school_year'       => $schoolYear,
                        'created_at'        => date('Y-m-d H:i:s'),
                    ]);
                } catch (\Exception $ignored) {
                    // Ignore duplicate or non-critical secondary log
                }
            }

            Session::flash('success', "Membership record for \"{$memberName}\" added successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save member record: ' . $e->getMessage());
        }

        redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
    }

    public function updateMember(): void
    {
        $memberId = (int)($_POST['member_id'] ?? $_POST['id'] ?? 0);
        $organizationId = (int)($_POST['organization_id'] ?? 0);
        $memberName = trim($_POST['member_name'] ?? '');
        $studentNumber = trim($_POST['student_number'] ?? '');
        $role = trim($_POST['role'] ?? 'Member');
        $status = trim($_POST['status'] ?? 'Active');

        if ($memberId < 1 || $memberName === '') {
            Session::flash('error', 'Member ID and Member Name are required.');
            redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
            return;
        }

        try {
            Database::update('sld_members', [
                'member_name'    => $memberName,
                'student_number' => $studentNumber !== '' ? $studentNumber : null,
                'role'           => $role,
                'status'         => in_array($status, self::MEMBER_STATUSES, true) ? $status : 'Active',
                'updated_at'     => date('Y-m-d H:i:s'),
            ], 'id = :id AND deleted_at IS NULL', ['id' => $memberId]);

            Session::flash('success', "Member \"{$memberName}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update member: ' . $e->getMessage());
        }

        redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
    }

    public function updateMemberStatus(): void
    {
        $memberId = (int)($_POST['member_id'] ?? $_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $organizationId = (int)($_POST['organization_id'] ?? 0);

        if ($memberId < 1 || !in_array($status, self::MEMBER_STATUSES, true)) {
            Session::flash('error', 'Please select a valid membership status.');
            redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
            return;
        }

        try {
            Database::update('sld_members', [
                'status'     => $status,
                'updated_at' => date('Y-m-d H:i:s'),
            ], 'id = :member_id AND deleted_at IS NULL', [
                'member_id' => $memberId,
            ]);

            Session::flash('success', 'Membership status updated successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update membership status: ' . $e->getMessage());
        }

        redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
    }

    public function deleteMember(): void
    {
        $memberId = (int)($_POST['member_id'] ?? $_POST['id'] ?? 0);
        $organizationId = (int)($_POST['organization_id'] ?? 0);

        if ($memberId > 0) {
            Database::update('sld_members', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $memberId]);

            Session::flash('success', "Member #{$memberId} archived successfully.");
        }

        redirect(url('orgleadership/membership-records?organization_id=' . $organizationId));
    }

    /* =========================================================================
     * 4. Views & Submenu Workspaces
     * ========================================================================= */

    private function renderSubmenu(string $action): void
    {
        [$view, $title] = self::SUBMENUS[$action] ?? ['submenu-template', 'Student Leadership'];
        View::render('orgleadership/Views/' . $view, [
            'title'      => $title,
            'moduleName' => 'Student Organization and Leadership Management',
            'slug'       => 'orgleadership',
            'user'       => Auth::user(),
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Organization and Leadership Management' => url('orgleadership'),
                $title => ''
            ],
        ]);
    }

    public function organizationRegistration(): void
    {
        $organizations = Database::fetchAll(
            'SELECT * FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY created_at DESC'
        );

        View::render('orgleadership/Views/organization-registration', [
            'title'         => 'Organization Registration and Accreditation',
            'moduleName'    => 'Student Organization and Leadership Management',
            'slug'          => 'orgleadership',
            'user'          => Auth::user(),
            'organizations' => $organizations,
            'crumbs'        => [
                'Student Affairs (OSAS)' => '',
                'Student Organization and Leadership Management' => url('orgleadership'),
                'Organization Registration and Accreditation' => ''
            ],
        ]);
    }

    public function organizationProfile(): void
    {
        $organizations = Database::fetchAll(
            'SELECT * FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC'
        );

        $id = (int)($_GET['id'] ?? ($organizations[0]['id'] ?? 0));
        $organization = $id > 0 ? Database::fetchOne(
            'SELECT * FROM `sld_organizations` WHERE id = :id AND deleted_at IS NULL',
            ['id' => $id]
        ) : null;

        View::render('orgleadership/Views/organization-profile', [
            'title'         => 'Organization Profile Management',
            'moduleName'    => 'Student Organization and Leadership Management',
            'slug'          => 'orgleadership',
            'user'          => Auth::user(),
            'organizations' => $organizations,
            'organization'  => $organization,
            'statuses'      => self::ORGANIZATION_STATUSES,
            'crumbs'        => [
                'Student Affairs (OSAS)' => '',
                'Student Organization and Leadership Management' => url('orgleadership'),
                'Organization Profile Management' => ''
            ],
        ]);
    }

    public function membershipRecords(): void
    {
        $organizations = Database::fetchAll(
            'SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC'
        );

        $organizationId = (int)($_GET['organization_id'] ?? ($organizations[0]['id'] ?? 0));
        $selectedOrganization = null;
        foreach ($organizations as $org) {
            if ((int)$org['id'] === $organizationId) {
                $selectedOrganization = $org;
                break;
            }
        }

        $members = $organizationId > 0 ? Database::fetchAll(
            'SELECT * FROM `sld_members` WHERE organization_id = :organization_id AND deleted_at IS NULL ORDER BY member_name ASC',
            ['organization_id' => $organizationId]
        ) : [];

        View::render('orgleadership/Views/membership-records', [
            'title'                => 'Membership Records',
            'moduleName'           => 'Student Organization and Leadership Management',
            'slug'                 => 'orgleadership',
            'user'                 => Auth::user(),
            'organizations'        => $organizations,
            'organizationId'       => $organizationId,
            'selectedOrganization' => $selectedOrganization,
            'memberStatuses'       => self::MEMBER_STATUSES,
            'members'              => $members,
            'crumbs'               => [
                'Student Affairs (OSAS)' => '',
                'Student Organization and Leadership Management' => url('orgleadership'),
                'Membership Records' => ''
            ],
        ]);
    }

    /* =========================================================================
     * 4. Leadership Positions CRUD & Workspace
     * ========================================================================= */
    public function leadershipPositions(): void
    {
        $positions = Database::fetchAll("
            SELECT lp.*, 
                   COUNT(oa.id) as active_officers_count
            FROM `sld_leadership_positions` lp
            LEFT JOIN `sld_officer_appointments` oa ON lp.id = oa.position_id AND (oa.end_date IS NULL OR oa.end_date >= CURDATE())
            WHERE lp.deleted_at IS NULL
            GROUP BY lp.id
            ORDER BY lp.position_name ASC
        ");

        View::render('orgleadership/Views/leadership-positions', [
            'title'      => 'Leadership Positions',
            'moduleName' => 'Student Organization and Leadership Management',
            'slug'       => 'orgleadership',
            'user'       => Auth::user(),
            'positions'  => $positions,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Leadership Management' => url('orgleadership'),
                'Leadership Positions' => ''
            ]
        ]);
    }

    public function storePosition(): void
    {
        $name = trim($_POST['position_name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '') {
            Session::flash('error', 'Position name is required.');
            redirect(url('orgleadership/leadership-positions'));
            return;
        }

        try {
            Database::insert('sld_leadership_positions', [
                'position_name' => $name,
                'description'   => $description !== '' ? $description : null,
                'created_at'    => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Position \"{$name}\" created successfully.");
        } catch (\PDOException $e) {
            Session::flash('error', $e->getCode() === '23000'
                ? 'That position title already exists.'
                : 'Could not create position: ' . $e->getMessage());
        }

        redirect(url('orgleadership/leadership-positions'));
    }

    public function updatePosition(): void
    {
        $id = (int)($_POST['position_id'] ?? $_POST['id'] ?? 0);
        $name = trim($_POST['position_name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($id < 1 || $name === '') {
            Session::flash('error', 'Valid position ID and name are required.');
            redirect(url('orgleadership/leadership-positions'));
            return;
        }

        try {
            Database::update('sld_leadership_positions', [
                'position_name' => $name,
                'description'   => $description !== '' ? $description : null,
                'updated_at'    => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Position \"{$name}\" updated successfully.");
        } catch (\PDOException $e) {
            Session::flash('error', $e->getCode() === '23000'
                ? 'That position title already exists.'
                : 'Could not update position: ' . $e->getMessage());
        }

        redirect(url('orgleadership/leadership-positions'));
    }

    public function deletePosition(): void
    {
        $id = (int)($_POST['position_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_leadership_positions', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Position #{$id} archived successfully.");
        }
        redirect(url('orgleadership/leadership-positions'));
    }

    /* =========================================================================
     * 5. Term Management CRUD & Workspace
     * ========================================================================= */
    public function termManagement(): void
    {
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $orgFilter = (int)($_GET['organization_id'] ?? 0);

        $sql = "
            SELECT lt.*, 
                   org.name as organization_name, org.acronym as organization_acronym,
                   COUNT(oa.id) as appointed_officers_count
            FROM `sld_leadership_terms` lt
            LEFT JOIN `sld_organizations` org ON lt.organization_id = org.id
            LEFT JOIN `sld_officer_appointments` oa ON lt.id = oa.term_id
            WHERE lt.deleted_at IS NULL
        ";
        $params = [];
        if ($orgFilter > 0) {
            $sql .= " AND lt.organization_id = :org_id";
            $params['org_id'] = $orgFilter;
        }
        $sql .= " GROUP BY lt.id ORDER BY lt.start_date DESC";

        $terms = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/term-management', [
            'title'         => 'Term Management',
            'moduleName'    => 'Student Organization and Leadership Management',
            'slug'          => 'orgleadership',
            'user'          => Auth::user(),
            'terms'         => $terms,
            'organizations' => $organizations,
            'orgFilter'     => $orgFilter,
            'termStatuses'  => self::TERM_STATUSES,
            'crumbs'        => [
                'Student Affairs (OSAS)' => '',
                'Leadership Management' => url('orgleadership'),
                'Term Management' => ''
            ]
        ]);
    }

    public function storeTerm(): void
    {
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $termName = trim($_POST['term_name'] ?? '');
        $startDate = trim($_POST['start_date'] ?? '');
        $endDate = trim($_POST['end_date'] ?? '');
        $status = trim($_POST['term_status'] ?? 'Upcoming');

        if ($orgId < 1 || $termName === '' || $startDate === '' || $endDate === '') {
            Session::flash('error', 'Organization, term label, start date, and end date are required.');
            redirect(url('orgleadership/term-management'));
            return;
        }

        try {
            Database::insert('sld_leadership_terms', [
                'organization_id' => $orgId,
                'term_name'       => $termName,
                'start_date'      => $startDate,
                'end_date'        => $endDate,
                'term_status'     => in_array($status, self::TERM_STATUSES, true) ? $status : 'Upcoming',
                'created_at'      => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Term \"{$termName}\" registered successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save term: ' . $e->getMessage());
        }

        redirect(url('orgleadership/term-management' . ($orgId > 0 ? '?organization_id=' . $orgId : '')));
    }

    public function updateTerm(): void
    {
        $id = (int)($_POST['term_id'] ?? $_POST['id'] ?? 0);
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $termName = trim($_POST['term_name'] ?? '');
        $startDate = trim($_POST['start_date'] ?? '');
        $endDate = trim($_POST['end_date'] ?? '');
        $status = trim($_POST['term_status'] ?? 'Upcoming');

        if ($id < 1 || $termName === '' || $startDate === '' || $endDate === '') {
            Session::flash('error', 'Valid term ID, label, start date, and end date are required.');
            redirect(url('orgleadership/term-management'));
            return;
        }

        try {
            Database::update('sld_leadership_terms', [
                'organization_id' => $orgId,
                'term_name'       => $termName,
                'start_date'      => $startDate,
                'end_date'        => $endDate,
                'term_status'     => in_array($status, self::TERM_STATUSES, true) ? $status : 'Upcoming',
                'updated_at'      => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Term \"{$termName}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update term: ' . $e->getMessage());
        }

        redirect(url('orgleadership/term-management'));
    }

    public function updateTermStatus(): void
    {
        $id = (int)($_POST['term_id'] ?? $_POST['id'] ?? 0);
        $status = trim($_POST['term_status'] ?? '');

        if ($id < 1 || !in_array($status, self::TERM_STATUSES, true)) {
            Session::flash('error', 'Please select a valid term status.');
            redirect(url('orgleadership/term-management'));
            return;
        }

        try {
            Database::update('sld_leadership_terms', [
                'term_status' => $status,
                'updated_at'  => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Term status changed to {$status}.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update term status: ' . $e->getMessage());
        }

        redirect(url('orgleadership/term-management'));
    }

    public function deleteTerm(): void
    {
        $id = (int)($_POST['term_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_leadership_terms', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Term #{$id} archived successfully.");
        }
        redirect(url('orgleadership/term-management'));
    }

    /* =========================================================================
     * 6. Officer Profiles CRUD & Workspace
     * ========================================================================= */
    public function officerProfiles(): void
    {
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $positions = Database::fetchAll("SELECT id, position_name FROM `sld_leadership_positions` WHERE deleted_at IS NULL ORDER BY position_name ASC");
        $terms = Database::fetchAll("SELECT id, organization_id, term_name, term_status FROM `sld_leadership_terms` WHERE deleted_at IS NULL ORDER BY start_date DESC");
        $students = Database::fetchAll("SELECT student_number, first_name, last_name, email FROM `students` ORDER BY last_name ASC LIMIT 50");

        $orgFilter = (int)($_GET['organization_id'] ?? 0);
        $statusFilter = trim($_GET['status'] ?? '');

        $sql = "
            SELECT o.*,
                   org.name as organization_name, org.acronym as organization_acronym,
                   s.first_name, s.last_name, s.email as student_email,
                   COALESCE(s.first_name, '') as fname,
                   COALESCE(s.last_name, '') as lname,
                   lp.position_name,
                   lt.term_name,
                   oa.id as appointment_id
            FROM `sld_officers` o
            LEFT JOIN `sld_organizations` org ON o.organization_id = org.id
            LEFT JOIN `students` s ON o.student_id = s.student_number
            LEFT JOIN `sld_officer_appointments` oa ON o.id = oa.officer_id AND (oa.end_date IS NULL OR oa.end_date >= CURDATE())
            LEFT JOIN `sld_leadership_positions` lp ON oa.position_id = lp.id
            LEFT JOIN `sld_leadership_terms` lt ON oa.term_id = lt.id
            WHERE o.deleted_at IS NULL
        ";
        $params = [];
        if ($orgFilter > 0) {
            $sql .= " AND o.organization_id = :org_id";
            $params['org_id'] = $orgFilter;
        }
        if ($statusFilter !== '' && in_array($statusFilter, self::OFFICER_STATUSES, true)) {
            $sql .= " AND o.officers_status = :status";
            $params['status'] = $statusFilter;
        }
        $sql .= " ORDER BY o.id DESC";

        $officers = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/officer-profiles', [
            'title'           => 'Officer Profiles',
            'moduleName'      => 'Student Organization and Leadership Management',
            'slug'            => 'orgleadership',
            'user'            => Auth::user(),
            'officers'        => $officers,
            'organizations'   => $organizations,
            'positions'       => $positions,
            'terms'           => $terms,
            'students'        => $students,
            'orgFilter'       => $orgFilter,
            'statusFilter'    => $statusFilter,
            'officerStatuses' => self::OFFICER_STATUSES,
            'crumbs'          => [
                'Student Affairs (OSAS)' => '',
                'Leadership Management' => url('orgleadership'),
                'Officer Profiles' => ''
            ]
        ]);
    }

    public function storeOfficer(): void
    {
        $studentId = trim($_POST['student_id'] ?? '');
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $positionId = (int)($_POST['position_id'] ?? 0);
        $termId = (int)($_POST['term_id'] ?? 0);
        $summary = trim($_POST['profile_summary'] ?? '');
        $status = trim($_POST['officers_status'] ?? 'Active');

        if ($studentId === '' || $orgId < 1) {
            Session::flash('error', 'Student number and organization are required.');
            redirect(url('orgleadership/officer-profiles'));
            return;
        }

        try {
            $officerId = Database::insert('sld_officers', [
                'student_id'      => $studentId,
                'organization_id' => $orgId,
                'profile_summary' => $summary !== '' ? $summary : null,
                'officers_status' => in_array($status, self::OFFICER_STATUSES, true) ? $status : 'Active',
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            if ($positionId > 0 && $termId > 0) {
                Database::insert('sld_officer_appointments', [
                    'officer_id'      => $officerId,
                    'position_id'     => $positionId,
                    'organization_id' => $orgId,
                    'term_id'         => $termId,
                    'start_date'      => date('Y-m-d'),
                    'end_date'        => null,
                    'created_at'      => date('Y-m-d H:i:s')
                ]);
            }

            Session::flash('success', "Officer profile for student {$studentId} created successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not create officer profile: ' . $e->getMessage());
        }

        redirect(url('orgleadership/officer-profiles'));
    }

    public function updateOfficer(): void
    {
        $id = (int)($_POST['officer_id'] ?? $_POST['id'] ?? 0);
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $studentId = trim($_POST['student_id'] ?? '');
        $summary = trim($_POST['profile_summary'] ?? '');
        $status = trim($_POST['officers_status'] ?? 'Active');
        $positionId = (int)($_POST['position_id'] ?? 0);
        $termId = (int)($_POST['term_id'] ?? 0);

        if ($id < 1 || $studentId === '' || $orgId < 1) {
            Session::flash('error', 'Valid officer ID, student number, and organization are required.');
            redirect(url('orgleadership/officer-profiles'));
            return;
        }

        try {
            Database::update('sld_officers', [
                'student_id'      => $studentId,
                'organization_id' => $orgId,
                'profile_summary' => $summary !== '' ? $summary : null,
                'officers_status' => in_array($status, self::OFFICER_STATUSES, true) ? $status : 'Active',
                'updated_at'      => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);

            if ($positionId > 0 && $termId > 0) {
                $existingApp = Database::fetchOne(
                    "SELECT id FROM `sld_officer_appointments` WHERE officer_id = :oid AND term_id = :tid AND deleted_at IS NULL LIMIT 1",
                    ['oid' => $id, 'tid' => $termId]
                );
                if ($existingApp) {
                    Database::update('sld_officer_appointments', [
                        'position_id' => $positionId,
                        'updated_at'  => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $existingApp['id']]);
                } else {
                    Database::insert('sld_officer_appointments', [
                        'officer_id'      => $id,
                        'position_id'     => $positionId,
                        'organization_id' => $orgId,
                        'term_id'         => $termId,
                        'start_date'      => date('Y-m-d'),
                        'created_at'      => date('Y-m-d H:i:s')
                    ]);
                }
            }

            Session::flash('success', "Officer profile updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update officer profile: ' . $e->getMessage());
        }

        redirect(url('orgleadership/officer-profiles'));
    }

    public function updateOfficerStatus(): void
    {
        $id = (int)($_POST['officer_id'] ?? $_POST['id'] ?? 0);
        $status = trim($_POST['officers_status'] ?? '');

        if ($id < 1 || !in_array($status, self::OFFICER_STATUSES, true)) {
            Session::flash('error', 'Please select a valid officer status.');
            redirect(url('orgleadership/officer-profiles'));
            return;
        }

        try {
            Database::update('sld_officers', [
                'officers_status' => $status,
                'updated_at'      => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Officer status changed to {$status}.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update officer status: ' . $e->getMessage());
        }

        redirect(url('orgleadership/officer-profiles'));
    }

    public function deleteOfficer(): void
    {
        $id = (int)($_POST['officer_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_officers', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Officer profile #{$id} archived successfully.");
        }
        redirect(url('orgleadership/officer-profiles'));
    }

    /* =========================================================================
     * 7. Leadership History (Appointments) CRUD & Workspace
     * ========================================================================= */
    public function leadershipHistory(): void
    {
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $positions = Database::fetchAll("SELECT id, position_name FROM `sld_leadership_positions` WHERE deleted_at IS NULL ORDER BY position_name ASC");
        $terms = Database::fetchAll("SELECT id, organization_id, term_name FROM `sld_leadership_terms` WHERE deleted_at IS NULL ORDER BY start_date DESC");
        $officers = Database::fetchAll("
            SELECT o.id, o.student_id, o.organization_id, s.first_name, s.last_name, org.acronym as org_acronym
            FROM `sld_officers` o
            LEFT JOIN `students` s ON o.student_id = s.student_number
            LEFT JOIN `sld_organizations` org ON o.organization_id = org.id
            WHERE o.deleted_at IS NULL
            ORDER BY s.last_name ASC, o.student_id ASC
        ");

        $orgFilter = (int)($_GET['organization_id'] ?? 0);
        $termFilter = (int)($_GET['term_id'] ?? 0);

        $sql = "
            SELECT oa.*,
                   o.student_id,
                   s.first_name, s.last_name,
                   COALESCE(s.first_name, '') as fname,
                   COALESCE(s.last_name, '') as lname,
                   lp.position_name,
                   org.name as organization_name, org.acronym as organization_acronym,
                   lt.term_name
            FROM `sld_officer_appointments` oa
            LEFT JOIN `sld_officers` o ON oa.officer_id = o.id
            LEFT JOIN `students` s ON o.student_id = s.student_number
            LEFT JOIN `sld_leadership_positions` lp ON oa.position_id = lp.id
            LEFT JOIN `sld_organizations` org ON oa.organization_id = org.id
            LEFT JOIN `sld_leadership_terms` lt ON oa.term_id = lt.id
            WHERE oa.deleted_at IS NULL
        ";
        $params = [];
        if ($orgFilter > 0) {
            $sql .= " AND oa.organization_id = :org_id";
            $params['org_id'] = $orgFilter;
        }
        if ($termFilter > 0) {
            $sql .= " AND oa.term_id = :term_id";
            $params['term_id'] = $termFilter;
        }
        $sql .= " ORDER BY oa.start_date DESC, oa.id DESC";

        $appointments = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/leadership-history', [
            'title'         => 'Leadership History Records',
            'moduleName'    => 'Student Organization and Leadership Management',
            'slug'          => 'orgleadership',
            'user'          => Auth::user(),
            'appointments'  => $appointments,
            'organizations' => $organizations,
            'positions'     => $positions,
            'terms'         => $terms,
            'officers'      => $officers,
            'orgFilter'     => $orgFilter,
            'termFilter'    => $termFilter,
            'crumbs'        => [
                'Student Affairs (OSAS)' => '',
                'Leadership Management' => url('orgleadership'),
                'Leadership History Records' => ''
            ]
        ]);
    }

    public function storeAppointment(): void
    {
        $officerId = (int)($_POST['officer_id'] ?? 0);
        $positionId = (int)($_POST['position_id'] ?? 0);
        $organizationId = (int)($_POST['organization_id'] ?? 0);
        $termId = (int)($_POST['term_id'] ?? 0);
        $startDate = trim($_POST['start_date'] ?? '') ?: date('Y-m-d');
        $endDate = trim($_POST['end_date'] ?? '');

        if ($officerId < 1 || $positionId < 1 || $organizationId < 1 || $termId < 1) {
            Session::flash('error', 'Officer, position, organization, and academic term are required.');
            redirect(url('orgleadership/leadership-history'));
            return;
        }

        try {
            Database::insert('sld_officer_appointments', [
                'officer_id'      => $officerId,
                'position_id'     => $positionId,
                'organization_id' => $organizationId,
                'term_id'         => $termId,
                'start_date'      => $startDate,
                'end_date'        => $endDate !== '' ? $endDate : null,
                'created_at'      => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'Leadership tenure record saved successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save tenure record: ' . $e->getMessage());
        }

        redirect(url('orgleadership/leadership-history'));
    }

    public function updateAppointment(): void
    {
        $id = (int)($_POST['appointment_id'] ?? $_POST['id'] ?? 0);
        $positionId = (int)($_POST['position_id'] ?? 0);
        $termId = (int)($_POST['term_id'] ?? 0);
        $startDate = trim($_POST['start_date'] ?? '');
        $endDate = trim($_POST['end_date'] ?? '');

        if ($id < 1 || $positionId < 1 || $termId < 1 || $startDate === '') {
            Session::flash('error', 'Appointment ID, position, term, and start date are required.');
            redirect(url('orgleadership/leadership-history'));
            return;
        }

        try {
            Database::update('sld_officer_appointments', [
                'position_id' => $positionId,
                'term_id'     => $termId,
                'start_date'  => $startDate,
                'end_date'    => $endDate !== '' ? $endDate : null,
                'updated_at'  => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Leadership tenure record updated successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update tenure record: ' . $e->getMessage());
        }

        redirect(url('orgleadership/leadership-history'));
    }

    public function deleteAppointment(): void
    {
        $id = (int)($_POST['appointment_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_officer_appointments', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Appointment record #{$id} archived successfully.");
        }
        redirect(url('orgleadership/leadership-history'));
    }

    /* =========================================================================
     * 8. Training and Development Tracking CRUD & Workspace
     * ========================================================================= */
    public function trainingDevelopment(): void
    {
        $officers = Database::fetchAll("
            SELECT o.id, o.student_id, o.organization_id, s.first_name, s.last_name, org.acronym as org_acronym, lp.position_name
            FROM `sld_officers` o
            LEFT JOIN `students` s ON o.student_id = s.student_number
            LEFT JOIN `sld_organizations` org ON o.organization_id = org.id
            LEFT JOIN `sld_officer_appointments` oa ON o.id = oa.officer_id AND (oa.end_date IS NULL OR oa.end_date >= CURDATE())
            LEFT JOIN `sld_leadership_positions` lp ON oa.position_id = lp.id
            WHERE o.deleted_at IS NULL
            ORDER BY s.last_name ASC, o.student_id ASC
        ");

        $statusFilter = trim($_GET['status'] ?? '');

        $sql = "
            SELECT lt.*,
                   o.student_id,
                   s.first_name, s.last_name,
                   COALESCE(s.first_name, '') as fname,
                   COALESCE(s.last_name, '') as lname,
                   org.acronym as organization_acronym,
                   lp.position_name
            FROM `sld_leadership_trainings` lt
            LEFT JOIN `sld_officers` o ON lt.officer_id = o.id
            LEFT JOIN `students` s ON o.student_id = s.student_number
            LEFT JOIN `sld_organizations` org ON o.organization_id = org.id
            LEFT JOIN `sld_officer_appointments` oa ON o.id = oa.officer_id AND (oa.end_date IS NULL OR oa.end_date >= CURDATE())
            LEFT JOIN `sld_leadership_positions` lp ON oa.position_id = lp.id
            WHERE lt.deleted_at IS NULL
        ";
        $params = [];
        if ($statusFilter !== '' && in_array($statusFilter, self::TRAINING_STATUSES, true)) {
            $sql .= " AND lt.completion_status = :status";
            $params['status'] = $statusFilter;
        }
        $sql .= " ORDER BY lt.training_date DESC, lt.id DESC";

        $trainings = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/training-development', [
            'title'            => 'Training and Development Tracking',
            'moduleName'       => 'Student Organization and Leadership Management',
            'slug'             => 'orgleadership',
            'user'             => Auth::user(),
            'trainings'        => $trainings,
            'officers'         => $officers,
            'statusFilter'     => $statusFilter,
            'trainingStatuses' => self::TRAINING_STATUSES,
            'crumbs'           => [
                'Student Affairs (OSAS)' => '',
                'Leadership Management' => url('orgleadership'),
                'Training and Development Tracking' => ''
            ]
        ]);
    }

    public function storeTraining(): void
    {
        $officerId = (int)($_POST['officer_id'] ?? 0);
        $title = trim($_POST['training_title'] ?? '');
        $date = trim($_POST['training_date'] ?? '') ?: date('Y-m-d');
        $provider = trim($_POST['provider'] ?? '');
        $status = trim($_POST['completion_status'] ?? 'Registered');

        if ($officerId < 1 || $title === '') {
            Session::flash('error', 'Select an officer and provide the training title.');
            redirect(url('orgleadership/training-development'));
            return;
        }

        try {
            Database::insert('sld_leadership_trainings', [
                'officer_id'        => $officerId,
                'training_title'    => $title,
                'training_date'     => $date,
                'provider'          => $provider !== '' ? $provider : null,
                'completion_status' => in_array($status, self::TRAINING_STATUSES, true) ? $status : 'Registered',
                'created_at'        => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Training session \"{$title}\" logged successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save training record: ' . $e->getMessage());
        }

        redirect(url('orgleadership/training-development'));
    }

    public function updateTraining(): void
    {
        $id = (int)($_POST['training_id'] ?? $_POST['id'] ?? 0);
        $officerId = (int)($_POST['officer_id'] ?? 0);
        $title = trim($_POST['training_title'] ?? '');
        $date = trim($_POST['training_date'] ?? '');
        $provider = trim($_POST['provider'] ?? '');
        $status = trim($_POST['completion_status'] ?? 'Registered');

        if ($id < 1 || $officerId < 1 || $title === '' || $date === '') {
            Session::flash('error', 'Valid training ID, officer, title, and date are required.');
            redirect(url('orgleadership/training-development'));
            return;
        }

        try {
            Database::update('sld_leadership_trainings', [
                'officer_id'        => $officerId,
                'training_title'    => $title,
                'training_date'     => $date,
                'provider'          => $provider !== '' ? $provider : null,
                'completion_status' => in_array($status, self::TRAINING_STATUSES, true) ? $status : 'Registered',
                'updated_at'        => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Training session \"{$title}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update training record: ' . $e->getMessage());
        }

        redirect(url('orgleadership/training-development'));
    }

    public function updateTrainingStatus(): void
    {
        $id = (int)($_POST['training_id'] ?? $_POST['id'] ?? 0);
        $status = trim($_POST['completion_status'] ?? '');

        if ($id < 1 || !in_array($status, self::TRAINING_STATUSES, true)) {
            Session::flash('error', 'Please select a valid completion status.');
            redirect(url('orgleadership/training-development'));
            return;
        }

        try {
            Database::update('sld_leadership_trainings', [
                'completion_status' => $status,
                'updated_at'        => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Training status updated to {$status}.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update training status: ' . $e->getMessage());
        }

        redirect(url('orgleadership/training-development'));
    }

    public function deleteTraining(): void
    {
        $id = (int)($_POST['training_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_leadership_trainings', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Training record #{$id} archived successfully.");
        }
        redirect(url('orgleadership/training-development'));
    }
    public function activityProposals(): void       { $this->renderSubmenu(__FUNCTION__); }
    public function eventApprovals(): void          { $this->renderSubmenu(__FUNCTION__); }
    public function activityCalendar(): void        { $this->renderSubmenu(__FUNCTION__); }
    public function venueSchedules(): void          { $this->renderSubmenu(__FUNCTION__); }
    public function eventDocumentation(): void      { $this->renderSubmenu(__FUNCTION__); }
    public function attendanceMonitoring(): void    { $this->renderSubmenu(__FUNCTION__); }
    public function participationTracking(): void   { $this->renderSubmenu(__FUNCTION__); }
    public function involvementHistory(): void      { $this->renderSubmenu(__FUNCTION__); }
    public function engagementPoints(): void        { $this->renderSubmenu(__FUNCTION__); }
    public function recognitionRecords(): void      { $this->renderSubmenu(__FUNCTION__); }
    public function announcements(): void           { $this->renderSubmenu(__FUNCTION__); }
    public function organizationUpdates(): void     { $this->renderSubmenu(__FUNCTION__); }
    public function activityReminders(): void       { $this->renderSubmenu(__FUNCTION__); }
    public function approvalNotifications(): void   { $this->renderSubmenu(__FUNCTION__); }
    public function organizationPerformance(): void { $this->renderSubmenu(__FUNCTION__); }
    public function participationStatistics(): void { $this->renderSubmenu(__FUNCTION__); }
    public function leadershipReports(): void       { $this->renderSubmenu(__FUNCTION__); }
    public function activityReports(): void         { $this->renderSubmenu(__FUNCTION__); }
}
