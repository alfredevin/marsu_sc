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
    /* =========================================================================
     * 9. Activity Proposals CRUD & Workspace
     * ========================================================================= */
    private const PROPOSAL_STATUSES = ['Draft', 'Submitted', 'Under Review', 'Approved', 'Rejected', 'Revision Required'];
    private const ATTENDANCE_STATUSES = ['Present', 'Late', 'Excused', 'Absent'];
    private const CALENDAR_STATUSES = ['Scheduled', 'Ongoing', 'Completed', 'Cancelled'];
    private const VENUE_STATUSES = ['Available', 'Unavailable', 'Maintenance'];

    public function activityProposals(): void
    {
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $students = Database::fetchAll("SELECT student_number, first_name, last_name FROM `students` ORDER BY last_name ASC LIMIT 200");

        $orgFilter = (int)($_GET['organization_id'] ?? 0);
        $statusFilter = trim($_GET['status'] ?? '');

        $sql = "
            SELECT p.*,
                   org.name as organization_name, org.acronym as organization_acronym,
                   s.first_name, s.last_name
            FROM `sld_activity_proposals` p
            LEFT JOIN `sld_organizations` org ON p.organization_id = org.id
            LEFT JOIN `students` s ON p.submitted_by_student_id = s.student_number
            WHERE p.deleted_at IS NULL
        ";
        $params = [];
        if ($orgFilter > 0) {
            $sql .= " AND p.organization_id = :org_id";
            $params['org_id'] = $orgFilter;
        }
        if ($statusFilter !== '' && in_array($statusFilter, self::PROPOSAL_STATUSES, true)) {
            $sql .= " AND p.proposal_status = :status";
            $params['status'] = $statusFilter;
        }
        $sql .= " ORDER BY p.submitted_at DESC, p.id DESC";

        $proposals = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/activity-proposals', [
            'title'            => 'Activity Proposal Submission',
            'moduleName'       => 'Student Organization and Leadership Management',
            'slug'             => 'orgleadership',
            'user'             => Auth::user(),
            'proposals'        => $proposals,
            'organizations'    => $organizations,
            'students'         => $students,
            'proposalStatuses' => self::PROPOSAL_STATUSES,
            'orgFilter'        => $orgFilter,
            'statusFilter'     => $statusFilter,
            'crumbs'           => [
                'Student Affairs (OSAS)' => '',
                'Student Activities Management' => url('orgleadership'),
                'Activity Proposal Submission' => ''
            ]
        ]);
    }

    public function storeProposal(): void
    {
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $studentId = trim($_POST['submitted_by_student_id'] ?? '');
        $title = trim($_POST['activity_title'] ?? '');
        $objectives = trim($_POST['objectives'] ?? '');
        $proposedDate = trim($_POST['proposed_date'] ?? '') ?: date('Y-m-d');
        $budget = (float)($_POST['proposed_budget'] ?? 0);

        if ($orgId < 1 || $studentId === '' || $title === '' || $objectives === '') {
            Session::flash('error', 'Organization, student, activity title, and objectives are required.');
            redirect(url('orgleadership/activity-proposals'));
            return;
        }

        try {
            Database::insert('sld_activity_proposals', [
                'organization_id'          => $orgId,
                'submitted_by_student_id'  => $studentId,
                'activity_title'           => $title,
                'objectives'               => $objectives,
                'proposed_date'            => $proposedDate,
                'proposed_budget'          => $budget,
                'submitted_at'             => date('Y-m-d H:i:s'),
                'proposal_status'          => 'Draft',
                'created_at'               => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Activity proposal \"{$title}\" submitted successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save proposal: ' . $e->getMessage());
        }

        redirect(url('orgleadership/activity-proposals'));
    }

    public function updateProposal(): void
    {
        $id = (int)($_POST['proposal_id'] ?? $_POST['id'] ?? 0);
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $studentId = trim($_POST['submitted_by_student_id'] ?? '');
        $title = trim($_POST['activity_title'] ?? '');
        $objectives = trim($_POST['objectives'] ?? '');
        $proposedDate = trim($_POST['proposed_date'] ?? '');
        $budget = (float)($_POST['proposed_budget'] ?? 0);
        $status = trim($_POST['proposal_status'] ?? '');

        if ($id < 1 || $title === '') {
            Session::flash('error', 'Valid proposal ID and activity title are required.');
            redirect(url('orgleadership/activity-proposals'));
            return;
        }

        try {
            $data = [
                'activity_title'  => $title,
                'objectives'      => $objectives,
                'proposed_date'   => $proposedDate,
                'proposed_budget' => $budget,
                'updated_at'      => date('Y-m-d H:i:s')
            ];
            if ($orgId > 0) $data['organization_id'] = $orgId;
            if ($studentId !== '') $data['submitted_by_student_id'] = $studentId;
            if ($status !== '' && in_array($status, self::PROPOSAL_STATUSES, true)) {
                $data['proposal_status'] = $status;
            }

            Database::update('sld_activity_proposals', $data, 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Proposal \"{$title}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update proposal: ' . $e->getMessage());
        }

        redirect(url('orgleadership/activity-proposals'));
    }

    public function deleteProposal(): void
    {
        $id = (int)($_POST['proposal_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_activity_proposals', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Proposal #{$id} archived successfully.");
        }
        redirect(url('orgleadership/activity-proposals'));
    }

    /* =========================================================================
     * 10. Event Approvals CRUD & Workspace
     * ========================================================================= */
    public function eventApprovals(): void
    {
        $proposals = Database::fetchAll("
            SELECT p.id, p.activity_title, org.name as organization_name
            FROM `sld_activity_proposals` p
            LEFT JOIN `sld_organizations` org ON p.organization_id = org.id
            WHERE p.deleted_at IS NULL
            ORDER BY p.submitted_at DESC
        ");
        $students = Database::fetchAll("SELECT student_number, first_name, last_name FROM `students` ORDER BY last_name ASC LIMIT 200");

        $decisionFilter = trim($_GET['decision'] ?? '');

        $sql = "
            SELECT ea.*,
                   p.activity_title, org.name as organization_name, org.acronym as organization_acronym,
                   s.first_name as proposer_first_name, s.last_name as proposer_last_name,
                   a.first_name as approver_first_name, a.last_name as approver_last_name
            FROM `sld_event_approvals` ea
            LEFT JOIN `sld_activity_proposals` p ON ea.proposal_id = p.id
            LEFT JOIN `sld_organizations` org ON p.organization_id = org.id
            LEFT JOIN `students` s ON p.submitted_by_student_id = s.student_number
            LEFT JOIN `students` a ON ea.approver_student_id = a.student_number
            WHERE ea.deleted_at IS NULL
        ";
        $params = [];
        if ($decisionFilter !== '') {
            $sql .= " AND ea.decision = :decision";
            $params['decision'] = $decisionFilter;
        }
        $sql .= " ORDER BY ea.created_at DESC";

        $approvals = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/event-approvals', [
            'title'          => 'Event Approval Workflow',
            'moduleName'     => 'Student Organization and Leadership Management',
            'slug'           => 'orgleadership',
            'user'           => Auth::user(),
            'approvals'      => $approvals,
            'proposals'      => $proposals,
            'students'       => $students,
            'decisionFilter' => $decisionFilter,
            'crumbs'         => [
                'Student Affairs (OSAS)' => '',
                'Student Activities Management' => url('orgleadership'),
                'Event Approval Workflow' => ''
            ]
        ]);
    }

    public function storeApproval(): void
    {
        $proposalId = (int)($_POST['proposal_id'] ?? 0);
        $approverStudentId = trim($_POST['approver_student_id'] ?? '');
        $step = (int)($_POST['approval_step'] ?? 1);
        $decision = trim($_POST['decision'] ?? 'Pending');
        $comments = trim($_POST['comments'] ?? '');

        if ($proposalId < 1) {
            Session::flash('error', 'A valid proposal is required.');
            redirect(url('orgleadership/event-approvals'));
            return;
        }

        try {
            Database::insert('sld_event_approvals', [
                'proposal_id'        => $proposalId,
                'approver_student_id' => $approverStudentId !== '' ? $approverStudentId : null,
                'approval_step'      => $step,
                'decision'           => $decision,
                'decision_at'        => $decision !== 'Pending' ? date('Y-m-d H:i:s') : null,
                'comments'           => $comments !== '' ? $comments : null,
                'created_at'         => date('Y-m-d H:i:s')
            ]);

            // Update proposal status based on decision
            if ($decision === 'Approved') {
                Database::update('sld_activity_proposals', [
                    'proposal_status' => 'Approved',
                    'updated_at' => date('Y-m-d H:i:s')
                ], 'id = :id', ['id' => $proposalId]);
            } elseif ($decision === 'Rejected') {
                Database::update('sld_activity_proposals', [
                    'proposal_status' => 'Rejected',
                    'updated_at' => date('Y-m-d H:i:s')
                ], 'id = :id', ['id' => $proposalId]);
            }

            Session::flash('success', 'Approval record created successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not create approval: ' . $e->getMessage());
        }

        redirect(url('orgleadership/event-approvals'));
    }

    public function updateApproval(): void
    {
        $id = (int)($_POST['approval_id'] ?? $_POST['id'] ?? 0);
        $decision = trim($_POST['decision'] ?? '');
        $comments = trim($_POST['comments'] ?? '');
        $step = (int)($_POST['approval_step'] ?? 1);

        if ($id < 1) {
            Session::flash('error', 'Valid approval ID is required.');
            redirect(url('orgleadership/event-approvals'));
            return;
        }

        try {
            Database::update('sld_event_approvals', [
                'decision'      => $decision,
                'decision_at'   => $decision !== 'Pending' ? date('Y-m-d H:i:s') : null,
                'approval_step' => $step,
                'comments'      => $comments !== '' ? $comments : null,
                'updated_at'    => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Approval record updated successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update approval: ' . $e->getMessage());
        }

        redirect(url('orgleadership/event-approvals'));
    }

    public function deleteApproval(): void
    {
        $id = (int)($_POST['approval_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_event_approvals', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Approval #{$id} archived.");
        }
        redirect(url('orgleadership/event-approvals'));
    }

    /* =========================================================================
     * 11. Activity Calendar CRUD & Workspace
     * ========================================================================= */
    public function activityCalendar(): void
    {
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $venues = Database::fetchAll("SELECT id, venue_name, venue_status FROM `sld_venues` WHERE deleted_at IS NULL ORDER BY venue_name ASC");
        $proposals = Database::fetchAll("SELECT id, activity_title FROM `sld_activity_proposals` WHERE proposal_status = 'Approved' AND deleted_at IS NULL ORDER BY activity_title ASC");

        $orgFilter = (int)($_GET['organization_id'] ?? 0);
        $monthFilter = trim($_GET['month'] ?? '');

        $sql = "
            SELECT ac.*,
                   org.name as organization_name, org.acronym as organization_acronym,
                   v.venue_name
            FROM `sld_activity_calendar` ac
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            LEFT JOIN `sld_venues` v ON ac.venue_id = v.id
            WHERE ac.deleted_at IS NULL
        ";
        $params = [];
        if ($orgFilter > 0) {
            $sql .= " AND ac.organization_id = :org_id";
            $params['org_id'] = $orgFilter;
        }
        if ($monthFilter !== '' && preg_match('/^\d{4}-\d{2}$/', $monthFilter)) {
            $sql .= " AND DATE_FORMAT(ac.start_datetime, '%Y-%m') = :month";
            $params['month'] = $monthFilter;
        }
        $sql .= " ORDER BY ac.start_datetime DESC";

        $events = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/activity-calendar', [
            'title'         => 'Activity Calendar',
            'moduleName'    => 'Student Organization and Leadership Management',
            'slug'          => 'orgleadership',
            'user'          => Auth::user(),
            'events'        => $events,
            'organizations' => $organizations,
            'venues'        => $venues,
            'proposals'     => $proposals,
            'orgFilter'     => $orgFilter,
            'monthFilter'   => $monthFilter,
            'crumbs'        => [
                'Student Affairs (OSAS)' => '',
                'Student Activities Management' => url('orgleadership'),
                'Activity Calendar' => ''
            ]
        ]);
    }

    public function storeCalendarEvent(): void
    {
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $proposalId = (int)($_POST['proposal_id'] ?? 0);
        $venueId = (int)($_POST['venue_id'] ?? 0);
        $title = trim($_POST['activity_title'] ?? '');
        $startDatetime = trim($_POST['start_datetime'] ?? '');
        $endDatetime = trim($_POST['end_datetime'] ?? '');
        $status = trim($_POST['status'] ?? 'Scheduled');

        if ($orgId < 1 || $title === '' || $startDatetime === '') {
            Session::flash('error', 'Organization, activity title, and start date/time are required.');
            redirect(url('orgleadership/activity-calendar'));
            return;
        }

        try {
            Database::insert('sld_activity_calendar', [
                'organization_id' => $orgId,
                'proposal_id'     => $proposalId > 0 ? $proposalId : null,
                'venue_id'        => $venueId > 0 ? $venueId : null,
                'activity_title'  => $title,
                'start_datetime'  => $startDatetime,
                'end_datetime'    => $endDatetime !== '' ? $endDatetime : null,
                'status'          => in_array($status, self::CALENDAR_STATUSES, true) ? $status : 'Scheduled',
                'created_at'      => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Calendar event \"{$title}\" created successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not create event: ' . $e->getMessage());
        }

        redirect(url('orgleadership/activity-calendar'));
    }

    public function updateCalendarEvent(): void
    {
        $id = (int)($_POST['calendar_id'] ?? $_POST['id'] ?? 0);
        $orgId = (int)($_POST['organization_id'] ?? 0);
        $venueId = (int)($_POST['venue_id'] ?? 0);
        $title = trim($_POST['activity_title'] ?? '');
        $startDatetime = trim($_POST['start_datetime'] ?? '');
        $endDatetime = trim($_POST['end_datetime'] ?? '');
        $status = trim($_POST['status'] ?? '');

        if ($id < 1 || $title === '') {
            Session::flash('error', 'Valid event ID and activity title are required.');
            redirect(url('orgleadership/activity-calendar'));
            return;
        }

        try {
            $data = [
                'activity_title'  => $title,
                'start_datetime'  => $startDatetime,
                'end_datetime'    => $endDatetime !== '' ? $endDatetime : null,
                'updated_at'      => date('Y-m-d H:i:s')
            ];
            if ($orgId > 0) $data['organization_id'] = $orgId;
            if ($venueId > 0) $data['venue_id'] = $venueId;
            if ($status !== '' && in_array($status, self::CALENDAR_STATUSES, true)) {
                $data['status'] = $status;
            }

            Database::update('sld_activity_calendar', $data, 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Calendar event \"{$title}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update event: ' . $e->getMessage());
        }

        redirect(url('orgleadership/activity-calendar'));
    }

    public function deleteCalendarEvent(): void
    {
        $id = (int)($_POST['calendar_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_activity_calendar', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Calendar event #{$id} archived.");
        }
        redirect(url('orgleadership/activity-calendar'));
    }

    /* =========================================================================
     * 12. Venue & Schedule Management CRUD
     * ========================================================================= */
    public function venueSchedules(): void
    {
        $sql = "
            SELECT v.*,
                   (SELECT COUNT(*) FROM `sld_activity_calendar` ac WHERE ac.venue_id = v.id AND ac.deleted_at IS NULL AND (ac.status = 'Scheduled' OR ac.status = 'Ongoing')) as bookings_count
            FROM `sld_venues` v
            WHERE v.deleted_at IS NULL
            ORDER BY v.venue_name ASC
        ";
        $venues = Database::fetchAll($sql);

        View::render('orgleadership/Views/venue-schedules', [
            'title'         => 'Venue and Schedule Management',
            'moduleName'    => 'Student Organization and Leadership Management',
            'slug'          => 'orgleadership',
            'user'          => Auth::user(),
            'venues'        => $venues,
            'venueStatuses' => self::VENUE_STATUSES,
            'crumbs'        => [
                'Student Affairs (OSAS)' => '',
                'Student Activities Management' => url('orgleadership'),
                'Venue and Schedule Management' => ''
            ]
        ]);
    }

    public function storeVenue(): void
    {
        $name = trim($_POST['venue_name'] ?? '');
        $status = trim($_POST['venue_status'] ?? 'Available');

        if ($name === '') {
            Session::flash('error', 'Venue name is required.');
            redirect(url('orgleadership/venue-schedules'));
            return;
        }

        try {
            Database::insert('sld_venues', [
                'venue_name'   => $name,
                'venue_status' => in_array($status, self::VENUE_STATUSES, true) ? $status : 'Available',
                'created_at'   => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Venue \"{$name}\" added successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not add venue: ' . $e->getMessage());
        }

        redirect(url('orgleadership/venue-schedules'));
    }

    public function updateVenue(): void
    {
        $id = (int)($_POST['venue_id'] ?? $_POST['id'] ?? 0);
        $name = trim($_POST['venue_name'] ?? '');
        $status = trim($_POST['venue_status'] ?? '');

        if ($id < 1 || $name === '') {
            Session::flash('error', 'Valid venue ID and name are required.');
            redirect(url('orgleadership/venue-schedules'));
            return;
        }

        try {
            Database::update('sld_venues', [
                'venue_name'   => $name,
                'venue_status' => in_array($status, self::VENUE_STATUSES, true) ? $status : 'Available',
                'updated_at'   => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Venue \"{$name}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update venue: ' . $e->getMessage());
        }

        redirect(url('orgleadership/venue-schedules'));
    }

    public function deleteVenue(): void
    {
        $id = (int)($_POST['venue_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_venues', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Venue #{$id} archived.");
        }
        redirect(url('orgleadership/venue-schedules'));
    }

    /* =========================================================================
     * 13. Event Documentation CRUD
     * ========================================================================= */
    public function eventDocumentation(): void
    {
        $events = Database::fetchAll("
            SELECT ac.id, ac.activity_title, org.name as organization_name
            FROM `sld_activity_calendar` ac
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            WHERE ac.deleted_at IS NULL
            ORDER BY ac.start_datetime DESC
        ");

        $calendarFilter = (int)($_GET['calendar_id'] ?? 0);

        $sql = "
            SELECT ed.*,
                   ac.activity_title, org.name as organization_name
            FROM `sld_event_documentations` ed
            LEFT JOIN `sld_activity_calendar` ac ON ed.calendar_id = ac.id
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            WHERE ed.deleted_at IS NULL
        ";
        $params = [];
        if ($calendarFilter > 0) {
            $sql .= " AND ed.calendar_id = :cal_id";
            $params['cal_id'] = $calendarFilter;
        }
        $sql .= " ORDER BY ed.uploaded_at DESC";

        $documents = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/event-documentation', [
            'title'          => 'Event Documentation',
            'moduleName'     => 'Student Organization and Leadership Management',
            'slug'           => 'orgleadership',
            'user'           => Auth::user(),
            'documents'      => $documents,
            'events'         => $events,
            'calendarFilter' => $calendarFilter,
            'crumbs'         => [
                'Student Affairs (OSAS)' => '',
                'Student Activities Management' => url('orgleadership'),
                'Event Documentation' => ''
            ]
        ]);
    }

    public function storeDocument(): void
    {
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        $documentType = trim((string)($_POST['document_type'] ?? ''));
        $upload = $_FILES['document_file'] ?? null;
        $allowedTypes = ['Minutes', 'Photos', 'Report', 'Certificate', 'Other'];

        if ($calendarId < 1 || !in_array($documentType, $allowedTypes, true) || !is_array($upload) || (int)($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Choose an event, document type, and file to upload.');
            redirect(url('orgleadership/event-documentation'));
            return;
        }

        if ((int)($upload['size'] ?? 0) < 1 || (int)$upload['size'] > 10 * 1024 * 1024 || !is_uploaded_file((string)($upload['tmp_name'] ?? ''))) {
            Session::flash('error', 'The document must be a valid upload smaller than 10 MB.');
            redirect(url('orgleadership/event-documentation'));
            return;
        }

        $originalName = basename(str_replace('\\', '/', (string)($upload['name'] ?? '')));
        $originalName = preg_replace('/[\x00-\x1F\x7F]/u', '', $originalName) ?? '';
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $mimeByExtension = [
            'pdf' => ['application/pdf'],
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'doc' => ['application/msword', 'application/octet-stream'],
            'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/octet-stream'],
            'xls' => ['application/vnd.ms-excel', 'application/octet-stream'],
            'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/octet-stream'],
        ];
        if ($originalName === '' || strlen($originalName) > 255 || !isset($mimeByExtension[$extension]) || !function_exists('finfo_open')) {
            Session::flash('error', 'Upload a PDF, Word, Excel, JPG, or PNG file with a valid file name.');
            redirect(url('orgleadership/event-documentation'));
            return;
        }

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo ? finfo_file($fileInfo, (string)$upload['tmp_name']) : false;
        if ($fileInfo) {
            finfo_close($fileInfo);
        }
        if (!is_string($mimeType) || !in_array($mimeType, $mimeByExtension[$extension], true)) {
            Session::flash('error', 'The uploaded file type does not match its file extension.');
            redirect(url('orgleadership/event-documentation'));
            return;
        }

        $uploadDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'events';
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0750, true) && !is_dir($uploadDirectory)) {
            Session::flash('error', 'The document upload folder is not available.');
            redirect(url('orgleadership/event-documentation'));
            return;
        }
        $storedName = bin2hex(random_bytes(16)) . '.' . $extension;
        $targetPath = $uploadDirectory . DIRECTORY_SEPARATOR . $storedName;
        if (!move_uploaded_file((string)$upload['tmp_name'], $targetPath)) {
            Session::flash('error', 'Could not store the uploaded document.');
            redirect(url('orgleadership/event-documentation'));
            return;
        }

        try {
            Database::insert('sld_event_documentations', [
                'calendar_id'   => $calendarId,
                'document_type' => $documentType,
                'file_name'     => $originalName,
                'file_path'     => 'modules/orgleadership/uploads/events/' . $storedName,
                'uploaded_at'   => date('Y-m-d H:i:s'),
                'created_at'    => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Document \"{$originalName}\" uploaded successfully.");
        } catch (\Exception $e) {
            @unlink($targetPath);
            Session::flash('error', 'Could not save the document record.');
        }

        redirect(url('orgleadership/event-documentation'));
    }

    public function downloadDocument(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $document = $id > 0 ? Database::fetchOne(
            'SELECT file_name, file_path FROM `sld_event_documentations` WHERE id = :id AND deleted_at IS NULL',
            ['id' => $id]
        ) : null;
        $uploadDirectory = realpath(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'events');
        $storedName = $document ? basename(str_replace('\\', '/', (string)$document['file_path'])) : '';
        $path = $uploadDirectory && $storedName !== ''
            ? realpath($uploadDirectory . DIRECTORY_SEPARATOR . $storedName)
            : false;

        if (!$document || !$uploadDirectory || !$path || !str_starts_with($path, $uploadDirectory . DIRECTORY_SEPARATOR) || !is_file($path)) {
            http_response_code(404);
            echo 'Document not found.';
            return;
        }

        $safeFileName = preg_replace('/[^A-Za-z0-9._-]/', '_', (string)$document['file_name']) ?: 'document';
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $safeFileName . '"; filename*=UTF-8\'\'' . rawurlencode($document['file_name']));
        header('Content-Length: ' . filesize($path));
        header('X-Content-Type-Options: nosniff');
        readfile($path);
        exit;
    }

    public function deleteDocument(): void
    {
        $id = (int)($_POST['document_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_event_documentations', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Document #{$id} archived.");
        }
        redirect(url('orgleadership/event-documentation'));
    }

    /* =========================================================================
     * 14. Attendance Monitoring CRUD
     * ========================================================================= */
    public function attendanceMonitoring(): void
    {
        $events = Database::fetchAll("
            SELECT ac.id, ac.activity_title, org.name as organization_name
            FROM `sld_activity_calendar` ac
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            WHERE ac.deleted_at IS NULL
            ORDER BY ac.start_datetime DESC
        ");

        $calendarFilter = (int)($_GET['calendar_id'] ?? 0);

        $sql = "
            SELECT att.*,
                   ac.activity_title, org.name as organization_name,
                   s.first_name, s.last_name
            FROM `sld_activity_attendances` att
            LEFT JOIN `sld_activity_calendar` ac ON att.calendar_id = ac.id
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            LEFT JOIN `students` s ON att.student_id = s.student_number
            WHERE att.deleted_at IS NULL
        ";
        $params = [];
        if ($calendarFilter > 0) {
            $sql .= " AND att.calendar_id = :cal_id";
            $params['cal_id'] = $calendarFilter;
        }
        $sql .= " ORDER BY att.created_at DESC";

        $attendances = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/attendance-monitoring', [
            'title'              => 'Attendance Monitoring',
            'moduleName'         => 'Student Organization and Leadership Management',
            'slug'               => 'orgleadership',
            'user'               => Auth::user(),
            'attendances'        => $attendances,
            'events'             => $events,
            'calendarFilter'     => $calendarFilter,
            'attendanceStatuses' => self::ATTENDANCE_STATUSES,
            'crumbs'             => [
                'Student Affairs (OSAS)' => '',
                'Student Engagement Monitoring' => url('orgleadership'),
                'Attendance Monitoring' => ''
            ]
        ]);
    }

    public function storeAttendance(): void
    {
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        $studentId = trim($_POST['student_id'] ?? '');
        $status = trim($_POST['attendance_status'] ?? 'Present');
        $timeIn = trim($_POST['time_in'] ?? '');
        $timeOut = trim($_POST['time_out'] ?? '');

        if ($calendarId < 1 || $studentId === '') {
            Session::flash('error', 'Event and student ID are required.');
            redirect(url('orgleadership/attendance-monitoring'));
            return;
        }

        try {
            Database::insert('sld_activity_attendances', [
                'calendar_id'       => $calendarId,
                'student_id'        => $studentId,
                'attendance_status' => in_array($status, self::ATTENDANCE_STATUSES, true) ? $status : 'Present',
                'time_in'           => $timeIn !== '' ? $timeIn : null,
                'time_out'          => $timeOut !== '' ? $timeOut : null,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'Attendance record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save attendance: ' . $e->getMessage());
        }

        redirect(url('orgleadership/attendance-monitoring' . ($calendarFilter = $calendarId > 0 ? '?calendar_id=' . $calendarId : '')));
    }

    public function updateAttendance(): void
    {
        $id = (int)($_POST['attendance_id'] ?? $_POST['id'] ?? 0);
        $status = trim($_POST['attendance_status'] ?? '');
        $timeIn = trim($_POST['time_in'] ?? '');
        $timeOut = trim($_POST['time_out'] ?? '');
        $calendarId = (int)($_POST['calendar_id'] ?? 0);

        if ($id < 1) {
            Session::flash('error', 'Valid attendance ID is required.');
            redirect(url('orgleadership/attendance-monitoring'));
            return;
        }

        try {
            Database::update('sld_activity_attendances', [
                'attendance_status' => in_array($status, self::ATTENDANCE_STATUSES, true) ? $status : 'Present',
                'time_in'           => $timeIn !== '' ? $timeIn : null,
                'time_out'          => $timeOut !== '' ? $timeOut : null,
                'updated_at'        => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Attendance record updated.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update attendance: ' . $e->getMessage());
        }

        redirect(url('orgleadership/attendance-monitoring' . ($calendarId > 0 ? '?calendar_id=' . $calendarId : '')));
    }

    public function deleteAttendance(): void
    {
        $id = (int)($_POST['attendance_id'] ?? $_POST['id'] ?? 0);
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_activity_attendances', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Attendance #{$id} archived.");
        }
        redirect(url('orgleadership/attendance-monitoring' . ($calendarId > 0 ? '?calendar_id=' . $calendarId : '')));
    }

    /* =========================================================================
     * 15. Participation Tracking CRUD
     * ========================================================================= */
    public function participationTracking(): void
    {
        $events = Database::fetchAll("
            SELECT ac.id, ac.activity_title, org.name as organization_name
            FROM `sld_activity_calendar` ac
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            WHERE ac.deleted_at IS NULL
            ORDER BY ac.start_datetime DESC
        ");

        $calendarFilter = (int)($_GET['calendar_id'] ?? 0);

        $sql = "
            SELECT sp.*,
                   ac.activity_title, org.name as organization_name,
                   s.first_name, s.last_name
            FROM `sld_student_participations` sp
            LEFT JOIN `sld_activity_calendar` ac ON sp.calendar_id = ac.id
            LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
            LEFT JOIN `students` s ON sp.student_id = s.student_number
            WHERE sp.deleted_at IS NULL
        ";
        $params = [];
        if ($calendarFilter > 0) {
            $sql .= " AND sp.calendar_id = :cal_id";
            $params['cal_id'] = $calendarFilter;
        }
        $sql .= " ORDER BY sp.created_at DESC";

        $participations = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/participation-tracking', [
            'title'          => 'Participation Tracking',
            'moduleName'     => 'Student Organization and Leadership Management',
            'slug'           => 'orgleadership',
            'user'           => Auth::user(),
            'participations' => $participations,
            'events'         => $events,
            'calendarFilter' => $calendarFilter,
            'crumbs'         => [
                'Student Affairs (OSAS)' => '',
                'Student Engagement Monitoring' => url('orgleadership'),
                'Participation Tracking' => ''
            ]
        ]);
    }

    public function storeParticipation(): void
    {
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        $studentId = trim($_POST['student_id'] ?? '');
        $role = trim($_POST['participation_role'] ?? '');
        $details = trim($_POST['contribution_details'] ?? '');

        if ($calendarId < 1 || $studentId === '') {
            Session::flash('error', 'Event and student ID are required.');
            redirect(url('orgleadership/participation-tracking'));
            return;
        }

        try {
            Database::insert('sld_student_participations', [
                'calendar_id'          => $calendarId,
                'student_id'           => $studentId,
                'participation_role'   => $role !== '' ? $role : null,
                'contribution_details' => $details !== '' ? $details : null,
                'created_at'           => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'Participation record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save participation: ' . $e->getMessage());
        }

        redirect(url('orgleadership/participation-tracking' . ($calendarId > 0 ? '?calendar_id=' . $calendarId : '')));
    }

    public function updateParticipation(): void
    {
        $id = (int)($_POST['participation_id'] ?? $_POST['id'] ?? 0);
        $role = trim($_POST['participation_role'] ?? '');
        $details = trim($_POST['contribution_details'] ?? '');
        $calendarId = (int)($_POST['calendar_id'] ?? 0);

        if ($id < 1) {
            Session::flash('error', 'Valid participation ID is required.');
            redirect(url('orgleadership/participation-tracking'));
            return;
        }

        try {
            Database::update('sld_student_participations', [
                'participation_role'   => $role !== '' ? $role : null,
                'contribution_details' => $details !== '' ? $details : null,
                'updated_at'           => date('Y-m-d H:i:s')
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Participation record updated.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update participation: ' . $e->getMessage());
        }

        redirect(url('orgleadership/participation-tracking' . ($calendarId > 0 ? '?calendar_id=' . $calendarId : '')));
    }

    public function deleteParticipation(): void
    {
        $id = (int)($_POST['participation_id'] ?? $_POST['id'] ?? 0);
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_student_participations', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Participation #{$id} archived.");
        }
        redirect(url('orgleadership/participation-tracking' . ($calendarId > 0 ? '?calendar_id=' . $calendarId : '')));
    }

    /* =========================================================================
     * 16. Student Involvement History (Read-Only Aggregate)
     * ========================================================================= */
    public function involvementHistory(): void
    {
        $searchQuery = trim($_GET['q'] ?? '');

        $sql = "
            SELECT
                s.student_number as student_id,
                s.first_name, s.last_name,
                (SELECT COUNT(DISTINCT att.calendar_id) FROM `sld_activity_attendances` att WHERE att.student_id = s.student_number AND att.deleted_at IS NULL) as total_activities,
                (SELECT COUNT(*) FROM `sld_student_participations` sp WHERE sp.student_id = s.student_number AND sp.deleted_at IS NULL) as total_participations,
                (SELECT COUNT(*) FROM `sld_activity_attendances` att2 WHERE att2.student_id = s.student_number AND att2.attendance_status = 'Present' AND att2.deleted_at IS NULL) as total_attendance,
                (SELECT COALESCE(SUM(ec.points), 0) FROM `sld_engagement_credits` ec WHERE ec.student_id = s.student_number AND ec.deleted_at IS NULL) as total_credits,
                (SELECT GROUP_CONCAT(DISTINCT org.acronym SEPARATOR ', ') FROM `sld_members` m LEFT JOIN `sld_organizations` org ON m.organization_id = org.id WHERE m.student_number = s.student_number AND m.deleted_at IS NULL) as organizations_list
            FROM `students` s
            WHERE 1=1
        ";
        $params = [];
        if ($searchQuery !== '') {
            $sql .= " AND (s.student_number LIKE :q OR s.first_name LIKE :q2 OR s.last_name LIKE :q3)";
            $params['q'] = "%{$searchQuery}%";
            $params['q2'] = "%{$searchQuery}%";
            $params['q3'] = "%{$searchQuery}%";
        }
        $sql .= " HAVING (total_activities > 0 OR total_participations > 0 OR total_credits > 0)";
        $sql .= " ORDER BY total_credits DESC, total_activities DESC LIMIT 200";

        $involvements = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/involvement-history', [
            'title'        => 'Student Involvement History',
            'moduleName'   => 'Student Organization and Leadership Management',
            'slug'         => 'orgleadership',
            'user'         => Auth::user(),
            'involvements' => $involvements,
            'searchQuery'  => $searchQuery,
            'crumbs'       => [
                'Student Affairs (OSAS)' => '',
                'Student Engagement Monitoring' => url('orgleadership'),
                'Student Involvement History' => ''
            ]
        ]);
    }

    /* =========================================================================
     * 17. Engagement Points & Credits CRUD
     * ========================================================================= */
    public function engagementPoints(): void
    {
        $events = Database::fetchAll("SELECT id, activity_title FROM `sld_activity_calendar` WHERE deleted_at IS NULL ORDER BY start_datetime DESC");
        $searchQuery = trim($_GET['q'] ?? '');

        $sql = "
            SELECT ec.*,
                   s.first_name, s.last_name,
                   ac.activity_title
            FROM `sld_engagement_credits` ec
            LEFT JOIN `students` s ON ec.student_id = s.student_number
            LEFT JOIN `sld_activity_calendar` ac ON ec.calendar_id = ac.id
            WHERE ec.deleted_at IS NULL
        ";
        $params = [];
        if ($searchQuery !== '') {
            $sql .= " AND (ec.student_id LIKE :q OR s.first_name LIKE :q2 OR s.last_name LIKE :q3)";
            $params['q'] = "%{$searchQuery}%";
            $params['q2'] = "%{$searchQuery}%";
            $params['q3'] = "%{$searchQuery}%";
        }
        $sql .= " ORDER BY ec.awarded_at DESC";

        $credits = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/engagement-points', [
            'title'       => 'Engagement Points and Credits',
            'moduleName'  => 'Student Organization and Leadership Management',
            'slug'        => 'orgleadership',
            'user'        => Auth::user(),
            'credits'     => $credits,
            'events'      => $events,
            'searchQuery' => $searchQuery,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Engagement Monitoring' => url('orgleadership'),
                'Engagement Points and Credits' => ''
            ]
        ]);
    }

    public function storeCredit(): void
    {
        $studentId = trim($_POST['student_id'] ?? '');
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        $points = (float)($_POST['points'] ?? 0);
        $reason = trim($_POST['reason'] ?? '');
        $awardedAt = trim($_POST['awarded_at'] ?? '') ?: date('Y-m-d H:i:s');

        if ($studentId === '' || $points <= 0 || $reason === '') {
            Session::flash('error', 'Student ID, points (> 0), and reason are required.');
            redirect(url('orgleadership/engagement-points'));
            return;
        }

        try {
            Database::insert('sld_engagement_credits', [
                'student_id'  => $studentId,
                'calendar_id' => $calendarId > 0 ? $calendarId : null,
                'points'      => $points,
                'reason'      => $reason,
                'awarded_at'  => $awardedAt,
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Engagement credit of {$points} pts awarded successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save credit: ' . $e->getMessage());
        }

        redirect(url('orgleadership/engagement-points'));
    }

    public function updateCredit(): void
    {
        $id = (int)($_POST['credit_id'] ?? $_POST['id'] ?? 0);
        $studentId = trim($_POST['student_id'] ?? '');
        $calendarId = (int)($_POST['calendar_id'] ?? 0);
        $points = (float)($_POST['points'] ?? 0);
        $reason = trim($_POST['reason'] ?? '');
        $awardedAt = trim($_POST['awarded_at'] ?? '');

        if ($id < 1 || $points <= 0 || $reason === '') {
            Session::flash('error', 'Valid credit ID, points (> 0), and reason are required.');
            redirect(url('orgleadership/engagement-points'));
            return;
        }

        try {
            $data = [
                'points'     => $points,
                'reason'     => $reason,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if ($studentId !== '') $data['student_id'] = $studentId;
            if ($calendarId > 0) $data['calendar_id'] = $calendarId;
            if ($awardedAt !== '') $data['awarded_at'] = $awardedAt;

            Database::update('sld_engagement_credits', $data, 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Engagement credit updated successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update credit: ' . $e->getMessage());
        }

        redirect(url('orgleadership/engagement-points'));
    }

    public function deleteCredit(): void
    {
        $id = (int)($_POST['credit_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_engagement_credits', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Credit #{$id} archived.");
        }
        redirect(url('orgleadership/engagement-points'));
    }

    /* =========================================================================
     * 18. Recognition Records CRUD
     * ========================================================================= */
    public function recognitionRecords(): void
    {
        $searchQuery = trim($_GET['q'] ?? '');

        $sql = "
            SELECT sr.*,
                   s.first_name, s.last_name
            FROM `sld_student_recognitions` sr
            LEFT JOIN `students` s ON sr.student_id = s.student_number
            WHERE sr.deleted_at IS NULL
        ";
        $params = [];
        if ($searchQuery !== '') {
            $sql .= " AND (sr.student_id LIKE :q OR s.first_name LIKE :q2 OR s.last_name LIKE :q3 OR sr.recognition_title LIKE :q4)";
            $params['q'] = "%{$searchQuery}%";
            $params['q2'] = "%{$searchQuery}%";
            $params['q3'] = "%{$searchQuery}%";
            $params['q4'] = "%{$searchQuery}%";
        }
        $sql .= " ORDER BY sr.recognition_date DESC";

        $recognitions = Database::fetchAll($sql, $params);

        View::render('orgleadership/Views/recognition-records', [
            'title'        => 'Recognition Records',
            'moduleName'   => 'Student Organization and Leadership Management',
            'slug'         => 'orgleadership',
            'user'         => Auth::user(),
            'recognitions' => $recognitions,
            'searchQuery'  => $searchQuery,
            'crumbs'       => [
                'Student Affairs (OSAS)' => '',
                'Student Engagement Monitoring' => url('orgleadership'),
                'Recognition Records' => ''
            ]
        ]);
    }

    public function storeRecognition(): void
    {
        $studentId = trim($_POST['student_id'] ?? '');
        $title = trim($_POST['recognition_title'] ?? '');
        $date = trim($_POST['recognition_date'] ?? '') ?: date('Y-m-d');
        $description = trim($_POST['description'] ?? '');

        if ($studentId === '' || $title === '') {
            Session::flash('error', 'Student ID and recognition title are required.');
            redirect(url('orgleadership/recognition-records'));
            return;
        }

        try {
            Database::insert('sld_student_recognitions', [
                'student_id'        => $studentId,
                'recognition_title' => $title,
                'recognition_date'  => $date,
                'description'       => $description !== '' ? $description : null,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', "Recognition \"{$title}\" recorded successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save recognition: ' . $e->getMessage());
        }

        redirect(url('orgleadership/recognition-records'));
    }

    public function updateRecognition(): void
    {
        $id = (int)($_POST['recognition_id'] ?? $_POST['id'] ?? 0);
        $studentId = trim($_POST['student_id'] ?? '');
        $title = trim($_POST['recognition_title'] ?? '');
        $date = trim($_POST['recognition_date'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($id < 1 || $title === '') {
            Session::flash('error', 'Valid recognition ID and title are required.');
            redirect(url('orgleadership/recognition-records'));
            return;
        }

        try {
            $data = [
                'recognition_title' => $title,
                'recognition_date'  => $date,
                'description'       => $description !== '' ? $description : null,
                'updated_at'        => date('Y-m-d H:i:s')
            ];
            if ($studentId !== '') $data['student_id'] = $studentId;

            Database::update('sld_student_recognitions', $data, 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', "Recognition \"{$title}\" updated successfully.");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update recognition: ' . $e->getMessage());
        }

        redirect(url('orgleadership/recognition-records'));
    }

    public function deleteRecognition(): void
    {
        $id = (int)($_POST['recognition_id'] ?? $_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_student_recognitions', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Recognition #{$id} archived.");
        }
        redirect(url('orgleadership/recognition-records'));
    }

    /* =========================================================================
     * 19. Communication, Notifications, and Reports
     * ========================================================================= */
    private function renderOperationalView(string $view, string $title, string $section, array $data = []): void
    {
        View::render('orgleadership/Views/' . $view, array_merge([
            'title'      => $title,
            'moduleName' => 'Student Organization and Leadership Management',
            'slug'       => 'orgleadership',
            'user'       => Auth::user(),
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Organization and Leadership Management' => url('orgleadership'),
                $section => '',
                $title => '',
            ],
        ], $data));
    }

    private function normalizeDateTimeInput(string $value): ?string
    {
        $value = trim(str_replace('T', ' ', $value));
        if ($value === '') {
            return date('Y-m-d H:i:s');
        }
        if (strlen($value) === 16) {
            $value .= ':00';
        }

        $date = \DateTime::createFromFormat('!Y-m-d H:i:s', $value);
        $errors = \DateTime::getLastErrors();
        if (!$date || ($errors && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))) {
            return null;
        }
        return $date->format('Y-m-d H:i:s');
    }

    private function normalizeDateFilter(string $value): ?string
    {
        $value = trim($value);
        if ($value === '') {
            return null;
        }
        $date = \DateTime::createFromFormat('!Y-m-d', $value);
        $errors = \DateTime::getLastErrors();
        if (!$date || ($errors && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))) {
            return null;
        }
        return $date->format('Y-m-d');
    }

    private function sendReportCsv(string $filename, array $columns, array $rows): void
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
        $output = fopen('php://output', 'wb');
        if ($output === false) {
            return;
        }

        fwrite($output, "\xEF\xBB\xBF");
        fputcsv($output, array_values($columns));
        foreach ($rows as $row) {
            $values = [];
            foreach ($columns as $key => $_label) {
                $value = (string)($row[$key] ?? '');
                if ($value !== '' && preg_match('/^[=+@\-\t\r]/', $value)) {
                    $value = "'" . $value;
                }
                $values[] = $value;
            }
            fputcsv($output, $values);
        }
        fclose($output);
        exit;
    }

    public function announcements(): void
    {
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $students = Database::fetchAll("SELECT student_number, first_name, last_name FROM `students` ORDER BY last_name ASC LIMIT 500");
        $organizationFilter = (int)($_GET['organization_id'] ?? 0);
        $statusFilter = trim((string)($_GET['status'] ?? ''));
        $statuses = ['Draft', 'Published', 'Archived'];

        $sql = "SELECT a.*, org.name AS organization_name, org.acronym AS organization_acronym,
                       s.first_name AS publisher_first_name, s.last_name AS publisher_last_name
                FROM `sld_announcements` a
                LEFT JOIN `sld_organizations` org ON a.organization_id = org.id
                LEFT JOIN `students` s ON a.published_by_student_id = s.student_number
                WHERE a.deleted_at IS NULL";
        $params = [];
        if ($organizationFilter > 0) {
            $sql .= " AND a.organization_id = :organization_id";
            $params['organization_id'] = $organizationFilter;
        }
        if (in_array($statusFilter, $statuses, true)) {
            $sql .= " AND a.announcement_status = :announcement_status";
            $params['announcement_status'] = $statusFilter;
        } else {
            $statusFilter = '';
        }
        $sql .= " ORDER BY a.published_at DESC, a.id DESC";

        $this->renderOperationalView('announcements', 'Announcements', 'Communication and Notification', [
            'announcements' => Database::fetchAll($sql, $params),
            'organizations' => $organizations,
            'students' => $students,
            'announcementStatuses' => $statuses,
            'organizationFilter' => $organizationFilter,
            'statusFilter' => $statusFilter,
        ]);
    }

    public function storeAnnouncement(): void
    {
        $title = trim((string)($_POST['title'] ?? ''));
        $message = trim((string)($_POST['message'] ?? ''));
        $publisherId = trim((string)($_POST['published_by_student_id'] ?? ''));
        $organizationId = (int)($_POST['organization_id'] ?? 0);
        $status = trim((string)($_POST['announcement_status'] ?? 'Draft'));
        $publishedAt = $this->normalizeDateTimeInput((string)($_POST['published_at'] ?? ''));

        if ($title === '' || $message === '' || $publisherId === '' || $publishedAt === null || !in_array($status, ['Draft', 'Published', 'Archived'], true)) {
            Session::flash('error', 'Enter a title, message, publisher, valid publication date, and status.');
            redirect(url('orgleadership/announcements'));
            return;
        }

        try {
            Database::insert('sld_announcements', [
                'organization_id' => $organizationId > 0 ? $organizationId : null,
                'title' => $title,
                'message' => $message,
                'published_by_student_id' => $publisherId,
                'published_at' => $publishedAt,
                'announcement_status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Session::flash('success', 'Announcement saved successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save announcement. Check the selected organization and publisher.');
        }
        redirect(url('orgleadership/announcements'));
    }

    public function updateAnnouncement(): void
    {
        $id = (int)($_POST['announcement_id'] ?? 0);
        $title = trim((string)($_POST['title'] ?? ''));
        $message = trim((string)($_POST['message'] ?? ''));
        $publisherId = trim((string)($_POST['published_by_student_id'] ?? ''));
        $organizationId = (int)($_POST['organization_id'] ?? 0);
        $status = trim((string)($_POST['announcement_status'] ?? 'Draft'));
        $publishedAt = $this->normalizeDateTimeInput((string)($_POST['published_at'] ?? ''));

        if ($id < 1 || $title === '' || $message === '' || $publisherId === '' || $publishedAt === null || !in_array($status, ['Draft', 'Published', 'Archived'], true)) {
            Session::flash('error', 'Enter a valid announcement, publisher, publication date, and status.');
            redirect(url('orgleadership/announcements'));
            return;
        }

        try {
            Database::update('sld_announcements', [
                'organization_id' => $organizationId > 0 ? $organizationId : null,
                'title' => $title,
                'message' => $message,
                'published_by_student_id' => $publisherId,
                'published_at' => $publishedAt,
                'announcement_status' => $status,
                'updated_at' => date('Y-m-d H:i:s'),
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Announcement updated successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not update announcement. Check the selected organization and publisher.');
        }
        redirect(url('orgleadership/announcements'));
    }

    public function deleteAnnouncement(): void
    {
        $id = (int)($_POST['announcement_id'] ?? 0);
        if ($id > 0) {
            Database::update('sld_announcements', [
                'deleted_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], 'id = :id AND deleted_at IS NULL', ['id' => $id]);
            Session::flash('success', 'Announcement archived.');
        }
        redirect(url('orgleadership/announcements'));
    }

    public function organizationUpdates(): void
    {
        $updates = Database::fetchAll("SELECT a.id, a.title, a.message, a.published_at, org.name AS organization_name,
                                              org.acronym AS organization_acronym,
                                              s.first_name AS publisher_first_name, s.last_name AS publisher_last_name
                                       FROM `sld_announcements` a
                                       LEFT JOIN `sld_organizations` org ON a.organization_id = org.id
                                       LEFT JOIN `students` s ON a.published_by_student_id = s.student_number
                                       WHERE a.deleted_at IS NULL AND a.announcement_status = 'Published'
                                         AND a.published_at <= NOW()
                                       ORDER BY a.published_at DESC, a.id DESC LIMIT 100");
        $this->renderOperationalView('organization-updates', 'Organization Updates', 'Communication and Notification', [
            'updates' => $updates,
        ]);
    }

    public function activityReminders(): void
    {
        $reminders = Database::fetchAll("SELECT ac.id, ac.activity_title, ac.start_datetime, ac.end_datetime, ac.status,
                                                org.name AS organization_name, org.acronym AS organization_acronym,
                                                v.venue_name
                                         FROM `sld_activity_calendar` ac
                                         LEFT JOIN `sld_organizations` org ON ac.organization_id = org.id
                                         LEFT JOIN `sld_venues` v ON ac.venue_id = v.id
                                         WHERE ac.deleted_at IS NULL
                                           AND ac.status IN ('Scheduled', 'Ongoing')
                                           AND ((ac.start_datetime >= NOW() AND ac.start_datetime < DATE_ADD(NOW(), INTERVAL 31 DAY))
                                                OR (ac.status = 'Ongoing' AND (ac.end_datetime IS NULL OR ac.end_datetime >= NOW())))
                                         ORDER BY ac.start_datetime ASC");
        $this->renderOperationalView('activity-reminders', 'Activity Reminders', 'Communication and Notification', [
            'reminders' => $reminders,
        ]);
    }

    public function approvalNotifications(): void
    {
        $notifications = Database::fetchAll("SELECT ea.id, ea.decision, ea.approval_step, ea.decision_at, ea.created_at,
                                                    ea.comments, p.id AS proposal_id, p.activity_title, p.proposal_status,
                                                    org.name AS organization_name, org.acronym AS organization_acronym
                                             FROM `sld_event_approvals` ea
                                             INNER JOIN `sld_activity_proposals` p ON ea.proposal_id = p.id
                                             LEFT JOIN `sld_organizations` org ON p.organization_id = org.id
                                             WHERE ea.deleted_at IS NULL AND p.deleted_at IS NULL
                                               AND (ea.decision = 'Pending' OR COALESCE(ea.decision_at, ea.created_at) >= DATE_SUB(NOW(), INTERVAL 30 DAY))
                                             ORDER BY (ea.decision = 'Pending') DESC, ea.created_at DESC");
        $this->renderOperationalView('approval-notifications', 'Approval Notifications', 'Communication and Notification', [
            'notifications' => $notifications,
        ]);
    }

    public function organizationPerformance(): void
    {
        $organizationFilter = (int)($_GET['organization_id'] ?? 0);
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $sql = "SELECT o.id, o.name, o.acronym, o.category, o.status,
                       (SELECT COUNT(*) FROM `sld_members` m WHERE m.organization_id = o.id AND m.deleted_at IS NULL AND m.status = 'Active') AS active_members,
                       (SELECT COUNT(*) FROM `sld_activity_calendar` ac WHERE ac.organization_id = o.id AND ac.deleted_at IS NULL) AS activities,
                       (SELECT COUNT(*) FROM `sld_activity_calendar` ac WHERE ac.organization_id = o.id AND ac.deleted_at IS NULL AND ac.status = 'Completed') AS completed_activities,
                       (SELECT COUNT(*) FROM `sld_organization_accreditations` oa WHERE oa.organization_id = o.id AND oa.deleted_at IS NULL) AS accreditations
                FROM `sld_organizations` o WHERE o.deleted_at IS NULL";
        $params = [];
        if ($organizationFilter > 0) {
            $sql .= " AND o.id = :organization_id";
            $params['organization_id'] = $organizationFilter;
        }
        $sql .= " ORDER BY o.name ASC";
        $rows = Database::fetchAll($sql, $params);
        $columns = [
            'name' => 'Organization', 'acronym' => 'Acronym', 'category' => 'Category', 'status' => 'Status',
            'active_members' => 'Active members', 'activities' => 'Activities',
            'completed_activities' => 'Completed activities', 'accreditations' => 'Accreditations',
        ];
        if (($_GET['export'] ?? '') === 'csv') {
            $this->sendReportCsv('organization-performance', $columns, $rows);
        }
        $this->renderOperationalView('organization-performance', 'Organization Performance Reports', 'Reports and Analytics', [
            'reportColumns' => $columns,
            'reportRows' => $rows,
            'reportRoute' => 'orgleadership/organization-performance',
            'organizations' => $organizations,
            'organizationFilter' => $organizationFilter,
            'showOrganizationFilter' => true,
            'showDateFilters' => false,
            'reportMetrics' => [
                ['label' => 'Organizations', 'value' => count($rows), 'icon' => 'bi-building'],
                ['label' => 'Active members', 'value' => array_sum(array_map(static fn($row) => (int)$row['active_members'], $rows)), 'icon' => 'bi-people'],
                ['label' => 'Activities', 'value' => array_sum(array_map(static fn($row) => (int)$row['activities'], $rows)), 'icon' => 'bi-calendar-event'],
                ['label' => 'Completed', 'value' => array_sum(array_map(static fn($row) => (int)$row['completed_activities'], $rows)), 'icon' => 'bi-check-circle'],
            ],
        ]);
    }

    public function participationStatistics(): void
    {
        $organizationFilter = (int)($_GET['organization_id'] ?? 0);
        $from = $this->normalizeDateFilter((string)($_GET['from'] ?? ''));
        $to = $this->normalizeDateFilter((string)($_GET['to'] ?? ''));
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $sql = "SELECT ac.id, ac.activity_title, ac.start_datetime, ac.status,
                       org.name AS organization_name, org.acronym AS organization_acronym,
                       COUNT(DISTINCT aa.student_id) AS attendees,
                       COUNT(DISTINCT CASE WHEN aa.attendance_status = 'Present' THEN aa.student_id END) AS present,
                       COUNT(DISTINCT sp.id) AS participation_records
                FROM `sld_activity_calendar` ac
                INNER JOIN `sld_organizations` org ON ac.organization_id = org.id
                LEFT JOIN `sld_activity_attendances` aa ON aa.calendar_id = ac.id AND aa.deleted_at IS NULL
                LEFT JOIN `sld_student_participations` sp ON sp.calendar_id = ac.id AND sp.deleted_at IS NULL
                WHERE ac.deleted_at IS NULL";
        $params = [];
        if ($organizationFilter > 0) {
            $sql .= " AND ac.organization_id = :organization_id";
            $params['organization_id'] = $organizationFilter;
        }
        if ($from !== null) {
            $sql .= " AND ac.start_datetime >= :from_date";
            $params['from_date'] = $from . ' 00:00:00';
        }
        if ($to !== null) {
            $sql .= " AND ac.start_datetime < DATE_ADD(:to_date, INTERVAL 1 DAY)";
            $params['to_date'] = $to;
        }
        $sql .= " GROUP BY ac.id, ac.activity_title, ac.start_datetime, ac.status, org.name, org.acronym ORDER BY ac.start_datetime DESC";
        $rows = Database::fetchAll($sql, $params);
        $columns = [
            'activity_title' => 'Activity', 'organization_name' => 'Organization', 'start_datetime' => 'Date and time',
            'status' => 'Status', 'attendees' => 'Students recorded', 'present' => 'Present',
            'participation_records' => 'Participation records',
        ];
        if (($_GET['export'] ?? '') === 'csv') {
            $this->sendReportCsv('student-participation-statistics', $columns, $rows);
        }
        $totalAttendees = array_sum(array_map(static fn($row) => (int)$row['attendees'], $rows));
        $totalPresent = array_sum(array_map(static fn($row) => (int)$row['present'], $rows));
        $this->renderOperationalView('participation-statistics', 'Student Participation Statistics', 'Reports and Analytics', [
            'reportColumns' => $columns,
            'reportRows' => $rows,
            'reportRoute' => 'orgleadership/participation-statistics',
            'organizations' => $organizations,
            'organizationFilter' => $organizationFilter,
            'fromFilter' => $from ?? '',
            'toFilter' => $to ?? '',
            'showOrganizationFilter' => true,
            'showDateFilters' => true,
            'reportMetrics' => [
                ['label' => 'Activities', 'value' => count($rows), 'icon' => 'bi-calendar-event'],
                ['label' => 'Attendance records', 'value' => $totalAttendees, 'icon' => 'bi-person-check'],
                ['label' => 'Present', 'value' => $totalPresent, 'icon' => 'bi-check-circle'],
                ['label' => 'Participation records', 'value' => array_sum(array_map(static fn($row) => (int)$row['participation_records'], $rows)), 'icon' => 'bi-graph-up'],
            ],
        ]);
    }

    public function leadershipReports(): void
    {
        $organizationFilter = (int)($_GET['organization_id'] ?? 0);
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $sql = "SELECT o.id, o.name, o.acronym, o.status,
                       (SELECT COUNT(*) FROM `sld_officers` so WHERE so.organization_id = o.id AND so.deleted_at IS NULL AND so.officers_status = 'Active') AS active_officers,
                       (SELECT COUNT(*) FROM `sld_officer_appointments` ap WHERE ap.organization_id = o.id AND ap.deleted_at IS NULL AND ap.start_date <= CURDATE() AND (ap.end_date IS NULL OR ap.end_date >= CURDATE())) AS current_appointments,
                       (SELECT COUNT(*) FROM `sld_leadership_trainings` lt INNER JOIN `sld_officers` so ON so.id = lt.officer_id WHERE so.organization_id = o.id AND so.deleted_at IS NULL AND lt.deleted_at IS NULL AND lt.completion_status = 'Completed') AS completed_trainings,
                       (SELECT COUNT(*) FROM `sld_student_recognitions` sr INNER JOIN `sld_officers` so ON so.student_id = sr.student_id AND so.organization_id = o.id WHERE so.deleted_at IS NULL AND sr.deleted_at IS NULL) AS officer_recognitions
                FROM `sld_organizations` o WHERE o.deleted_at IS NULL";
        $params = [];
        if ($organizationFilter > 0) {
            $sql .= " AND o.id = :organization_id";
            $params['organization_id'] = $organizationFilter;
        }
        $sql .= " ORDER BY o.name ASC";
        $rows = Database::fetchAll($sql, $params);
        $columns = [
            'name' => 'Organization', 'acronym' => 'Acronym', 'status' => 'Status',
            'active_officers' => 'Active officers', 'current_appointments' => 'Current appointments',
            'completed_trainings' => 'Completed trainings', 'officer_recognitions' => 'Officer recognitions',
        ];
        if (($_GET['export'] ?? '') === 'csv') {
            $this->sendReportCsv('leadership-involvement-reports', $columns, $rows);
        }
        $this->renderOperationalView('leadership-reports', 'Leadership Involvement Reports', 'Reports and Analytics', [
            'reportColumns' => $columns,
            'reportRows' => $rows,
            'reportRoute' => 'orgleadership/leadership-reports',
            'organizations' => $organizations,
            'organizationFilter' => $organizationFilter,
            'showOrganizationFilter' => true,
            'showDateFilters' => false,
            'reportMetrics' => [
                ['label' => 'Organizations', 'value' => count($rows), 'icon' => 'bi-building'],
                ['label' => 'Active officers', 'value' => array_sum(array_map(static fn($row) => (int)$row['active_officers'], $rows)), 'icon' => 'bi-person-badge'],
                ['label' => 'Current appointments', 'value' => array_sum(array_map(static fn($row) => (int)$row['current_appointments'], $rows)), 'icon' => 'bi-person-up'],
                ['label' => 'Completed trainings', 'value' => array_sum(array_map(static fn($row) => (int)$row['completed_trainings'], $rows)), 'icon' => 'bi-mortarboard'],
            ],
        ]);
    }

    public function activityReports(): void
    {
        $organizationFilter = (int)($_GET['organization_id'] ?? 0);
        $from = $this->normalizeDateFilter((string)($_GET['from'] ?? ''));
        $to = $this->normalizeDateFilter((string)($_GET['to'] ?? ''));
        $organizations = Database::fetchAll("SELECT id, name, acronym FROM `sld_organizations` WHERE deleted_at IS NULL ORDER BY name ASC");
        $sql = "SELECT ac.id, ac.activity_title, ac.start_datetime, ac.status,
                       org.name AS organization_name, org.acronym AS organization_acronym,
                       COUNT(DISTINCT aa.student_id) AS attendance_records,
                       COUNT(DISTINCT sp.id) AS participation_records,
                       COUNT(DISTINCT ed.id) AS documents
                FROM `sld_activity_calendar` ac
                INNER JOIN `sld_organizations` org ON ac.organization_id = org.id
                LEFT JOIN `sld_activity_attendances` aa ON aa.calendar_id = ac.id AND aa.deleted_at IS NULL
                LEFT JOIN `sld_student_participations` sp ON sp.calendar_id = ac.id AND sp.deleted_at IS NULL
                LEFT JOIN `sld_event_documentations` ed ON ed.calendar_id = ac.id AND ed.deleted_at IS NULL
                WHERE ac.deleted_at IS NULL";
        $params = [];
        if ($organizationFilter > 0) {
            $sql .= " AND ac.organization_id = :organization_id";
            $params['organization_id'] = $organizationFilter;
        }
        if ($from !== null) {
            $sql .= " AND ac.start_datetime >= :from_date";
            $params['from_date'] = $from . ' 00:00:00';
        }
        if ($to !== null) {
            $sql .= " AND ac.start_datetime < DATE_ADD(:to_date, INTERVAL 1 DAY)";
            $params['to_date'] = $to;
        }
        $sql .= " GROUP BY ac.id, ac.activity_title, ac.start_datetime, ac.status, org.name, org.acronym ORDER BY ac.start_datetime DESC";
        $rows = Database::fetchAll($sql, $params);
        $columns = [
            'activity_title' => 'Activity', 'organization_name' => 'Organization', 'start_datetime' => 'Date and time',
            'status' => 'Status', 'attendance_records' => 'Students recorded',
            'participation_records' => 'Participation records', 'documents' => 'Documents',
        ];
        if (($_GET['export'] ?? '') === 'csv') {
            $this->sendReportCsv('activity-accomplishment-reports', $columns, $rows);
        }
        $this->renderOperationalView('activity-reports', 'Activity Accomplishment Reports', 'Reports and Analytics', [
            'reportColumns' => $columns,
            'reportRows' => $rows,
            'reportRoute' => 'orgleadership/activity-reports',
            'organizations' => $organizations,
            'organizationFilter' => $organizationFilter,
            'fromFilter' => $from ?? '',
            'toFilter' => $to ?? '',
            'showOrganizationFilter' => true,
            'showDateFilters' => true,
            'reportMetrics' => [
                ['label' => 'Activities', 'value' => count($rows), 'icon' => 'bi-calendar-event'],
                ['label' => 'Attendance records', 'value' => array_sum(array_map(static fn($row) => (int)$row['attendance_records'], $rows)), 'icon' => 'bi-person-check'],
                ['label' => 'Participation records', 'value' => array_sum(array_map(static fn($row) => (int)$row['participation_records'], $rows)), 'icon' => 'bi-graph-up'],
                ['label' => 'Documents', 'value' => array_sum(array_map(static fn($row) => (int)$row['documents'], $rows)), 'icon' => 'bi-file-earmark-text'],
            ],
        ]);
    }
}
