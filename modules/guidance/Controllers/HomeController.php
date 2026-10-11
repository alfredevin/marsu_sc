<?php
namespace Modules\Guidance\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Guidance & Counseling Intake Records System
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `gdc_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('guidance/Views/index', [
            'title'       => 'Guidance & Counseling Intake Records System',
            'moduleName'  => 'Guidance & Counseling Intake Records System',
            'slug'        => 'guidance',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Guidance Center' => '',
                'Guidance & Counseling Intake Records System' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `gdc_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('guidance'));
        }

        View::render('guidance/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Guidance & Counseling Intake Records System',
            'slug'        => 'guidance',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Guidance & Counseling Intake Records System' => url('guidance'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('guidance'));
        }

        try {
            Database::insert('gdc_records', [
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

        redirect(url('guidance'));
    }
    public function studentprofile(): void
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

        View::render('guidance/Views/student-profile', [
            'title'           => !empty($selectedStudent) ? 'Student Profile: ' . htmlspecialchars($selectedStudent['full_name']) : 'Student Profiles',
            'moduleName'      => 'Guidance & Counseling Intake Records System',
            'slug'            => 'guidance',
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
                'Student Information Management' => '',
                'Student Profile' => ''
            ]
        ]);
    }

    public function studenthistory(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student-history', [
            'title' => 'Student History',
            'slug'  => 'guidance'
        ]);
    }

    public function appointments(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/appointments', [
            'title' => 'Appointments',
            'slug'  => 'guidance'
        ]);
    }

    public function sessioncalendar(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/session-calendar', [
            'title' => 'Session Calendar',
            'slug'  => 'guidance'
        ]);
    }

    public function casemonitoring(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/case-monitoring', [
            'title' => 'Case Monitoring',
            'slug'  => 'guidance'
        ]);
    }

    public function counseling(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/counseling', [
            'title' => 'Counseling',
            'slug'  => 'guidance'
        ]);
    }

    public function careercounseling(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/career-counseling', [
            'title' => 'Career Counseling',
            'slug'  => 'guidance'
        ]);
    }

    public function psychologicalsupport(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/psychological-support', [
            'title' => 'Psychological Support',
            'slug'  => 'guidance'
        ]);
    }

    public function exitinterviews(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/exit-interviews', [
            'title' => 'Exit Interviews',
            'slug'  => 'guidance'
        ]);
    }

    public function counselingrecords(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/counseling-records', [
            'title' => 'Counseling Records',
            'slug'  => 'guidance'
        ]);
    }

    public function careerassessments(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/career-assessments', [
            'title' => 'Career Assessments',
            'slug'  => 'guidance'
        ]);
    }

    public function servicerecords(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/service-records', [
            'title' => 'Service Records',
            'slug'  => 'guidance'
        ]);
    }

    public function counselingutilization(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/counseling-utilization', [
            'title' => 'Counseling Utilization',
            'slug'  => 'guidance'
        ]);
    }

    public function studentconcerns(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student-concerns', [
            'title' => 'Student Concerns',
            'slug'  => 'guidance'
        ]);
    }

    public function careerreadiness(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/career-readiness', [
            'title' => 'Career Readiness',
            'slug'  => 'guidance'
        ]);
    }

    public function exitinterviewsummary(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/exit-interview-summary', [
            'title' => 'Exit Interview Summary',
            'slug'  => 'guidance'
        ]);
    }

    public function studentconcerntypes(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student-concern-types', [
            'title' => 'Student Concern Types',
            'slug'  => 'guidance'
        ]);
    }

    public function useraccounts(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/user-accounts', [
            'title' => 'User Accounts',
            'slug'  => 'guidance'
        ]);
    }

    public function settings(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/settings', [
            'title' => 'Settings',
            'slug'  => 'guidance'
        ]);
    }
}
