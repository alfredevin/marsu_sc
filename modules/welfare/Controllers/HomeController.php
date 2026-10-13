<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Welfare Services & Financial Grants Management
 */
class HomeController
{
    public function index(): void
    {
        $user = Auth::user();

        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `wlf_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('welfare/Views/index', [
            'title'       => 'Student Welfare Services & Financial Grants Management',
            'moduleName'  => 'Student Welfare Services & Financial Grants Management',
            'slug'        => 'welfare',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => ''
            ]
        ]);
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `wlf_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('welfare'));
        }

        View::render('welfare/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Student Welfare Services & Financial Grants Management',
            'slug'        => 'welfare',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Student Welfare Services & Financial Grants Management' => url('welfare'), 'View' => '']
        ]);
    }

    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('welfare'));
        }

        try {
            Database::insert('wlf_records', [
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

        redirect(url('welfare'));
    }

       public function studentprofileinformation(): void
    {
        $user = Auth::user();

        $studentIdParam = trim($_GET['student_id'] ?? '');
        $program        = trim($_GET['program'] ?? '');
        $yearLevel      = trim($_GET['year_level'] ?? '');
        $status         = trim($_GET['status'] ?? '');
        $search         = trim($_GET['q'] ?? '');

        // Dynamic Programs Dropdown
        $programsList = [];
        try {
            $programsList = Database::fetchAll("SELECT DISTINCT `code`, `name` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
        } catch (\Throwable $e) {$programsList = [];
        }

        $selectedStudent = null;
        $studentList     = [];

        // 1. DETAIL PROFILE VIEW 
        if (!empty($studentIdParam)) {
            try {
                $sql = "SELECT 
                            s.*,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program,
                            COALESCE(p.name, 'N/A') AS program_full,
                            s.student_number AS student_id,
                            COALESCE(sec.name, '-') AS section_name,
                            COALESCE(s.enrollment_status, 'N/A') AS status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE (s.student_number = ? OR s.id = ?)
                        LIMIT 1";

                $selectedStudent = Database::fetchOne($sql, [$studentIdParam,
                    is_numeric($studentIdParam) ? (int)$studentIdParam : 0
                ]);
            } catch (\Throwable $e) {$selectedStudent = null;
            }
        }

        // 2. MASTER DIRECTORY ROSTER 
        if (!$selectedStudent) {
            try {
                $sql = "SELECT 
                            s.id,
                            s.student_number AS student_id,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            s.email,
                            COALESCE(p.code, 'N/A') AS program,
                            s.year_level,
                            COALESCE(sec.name, '-') AS section_name,
                            COALESCE(s.enrollment_status, 'N/A') AS status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE s.deleted_at IS NULL";

                $params = [];

                if (!empty($search)) {$sql .= " AND (s.student_number LIKE ? 
                               OR s.first_name LIKE ? 
                               OR s.last_name LIKE ? 
                               OR CONCAT(s.first_name, ' ', s.last_name) LIKE ? 
                               OR CONCAT(s.last_name, ', ', s.first_name) LIKE ? 
                               OR s.email LIKE ?)";
                    $qTerm = '\%' .$search . '%';
                    $params = array_merge($params, [$qTerm,$qTerm, $qTerm,$qTerm, $qTerm,$qTerm]);
                }

                if (!empty($program)) {$sql .= " AND p.code = ?";
                    $params[] =$program;
                }

                if (!empty($yearLevel)) {$sql .= " AND (s.year_level = ? OR s.year_level LIKE ?)";
                    $cleanYr = (int) preg_replace('/[^0-9]/', '',$yearLevel);
                    $params[] =$cleanYr > 0 ? $cleanYr :$yearLevel;
                    $params[] = '\%' .$yearLevel . '%';
                }

                if (!empty($status)) {$sql .= " AND s.enrollment_status = ?";
                    $params[] =$status;
                }

                $sql .= " ORDER BY s.id ASC LIMIT 100";

                $studentList = Database::fetchAll($sql,$params);
            } catch (\Throwable $e) {$studentList = [];
            }
        }

        View::render('welfare/Views/student-profile-information', [
            'title'           => !empty($selectedStudent) ? 'Student profile information: ' . htmlspecialchars($selectedStudent['full_name']) : 'Student Profiles',
            'moduleName'      => 'Student Welfare Services & Financial Grants Management',
            'slug'            => 'welfare',
            'user'            => $user,
            'selectedStudent' => $selectedStudent,
            'studentList'     => $studentList,
            'programsList'    => $programsList,
            'program'         => $program,
            'yearLevel'       => $yearLevel,
            'status'          => $status,
            'search'          => $search,
            'crumbs'          => [
                'Guidance Center' => url('guidance'),
                'Student profile information ' => '',
                'Student Profile' => ''
            ]
        ]);
    }
    public function supportassessment(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/support-assessment', [
            'title' => 'Support Assessment',
            'slug'  => 'welfare'
        ]);
    }
    public function socioeconomicbackground(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/socio-economic-background', [
            'title' => 'Socio-economic background',
            'slug'  => 'welfare'
        ]);
    }  
    public function welfarehistoryrecords(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/welfare-history-records', [
            'title' => 'Welfare history records',
            'slug'  => 'welfare'
        ]);
    }
    public function studentconcern(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/student-concern', [
            'title' => 'Student concern',
            'slug'  => 'welfare'
        ]);
    }
    public function casemanagement(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/case-management', [
            'title' => 'Case management',
            'slug'  => 'welfare'
        ]);
    }
    public function followupmonitoring(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/follow-up-monitoring', [
            'title' => 'Follow-up monitoring',
            'slug'  => 'welfare'
        ]);
    }
    public function caseresolutiontracking(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/case-resolution-tracking', [
            'title' => 'Case resolution tracking',
            'slug'  => 'welfare'
        ]);
    }
    public function counselingreferrals(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/counseling-referrals', [
            'title' => 'Counseling referrals',
            'slug'  => 'welfare'
        ]);
    }
    public function financialassistancerecords(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/financial-assistance-records', [
            'title' => 'Financial assistance records',
            'slug'  => 'welfare'
        ]);
    }
    public function scholarshipgrantmonitoring(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/scholrship-grant-monitoring', [
            'title' => 'Scholarship grant monitoring',
            'slug'  => 'welfare'
        ]);
    }
    public function studentsupportprograms(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/student-support-programs', [
            'title' => 'Student support programs',
            'slug'  => 'welfare'
        ]);
    }
    public function interventionplans(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/intervention-plans', [
            'title' => 'Intervention plans',
            'slug'  => 'welfare'
        ]);
    }
    public function assignedpersonnel(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/assigned-personnel', [
            'title' => 'Asigned personnel',
            'slug'  => 'welfare'
        ]);
    }
    public function progresstracking(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/progress-tracking', [
            'title' => 'Progress tracking',
            'slug'  => 'welfare'
        ]);
    }
    public function outcomeevaluation(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/outcome-evaluation', [
            'title' => 'Outcome evaluation',
            'slug'  => 'welfare'
        ]);
    }
    public function appointments(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/appointments', [
            'title' => 'Appointments',
            'slug'  => 'welfare'
        ]);
    }
    public function advisories(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/advisories', [
            'title' => 'Advisories',
            'slug'  => 'welfare'
        ]);
    }
    public function studentwelfarereports(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/student-welfare-reports', [
            'title' => 'Student welfare reports',
            'slug'  => 'welfare'
        ]);
    }
    public function studentconcerns(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/student-concerns', [
            'title' => 'Student concerns',
            'slug'  => 'welfare'
        ]);
    }
    public function servicereports(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/service-reports', [
            'title' => 'Service reports',
            'slug'  => 'welfare'
        ]);
    }
    public function interventionreports(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/intervention-reports', [
            'title' => 'Intervention reports',
            'slug'  => 'welfare'
        ]);
    }
}
