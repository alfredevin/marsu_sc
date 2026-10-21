<?php
namespace Modules\Guidance\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Guidance & Counseling Intake Records System
 */
class HomeController
{
    public function index(): void
    {
        $user = Auth::user();

        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `gdc_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('guidance/Views/index', [
            'title' => 'Guidance & Counseling Intake Records System',
            'moduleName' => 'Guidance & Counseling Intake Records System',
            'slug' => 'guidance',
            'records' => $records,
            'user' => $user,
            'crumbs' => [
                'Guidance Center' => '',
                'Guidance & Counseling Intake Records System' => ''
            ]
        ]);
    }

    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `gdc_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('guidance'));
        }

        View::render('guidance/Views/index', [
            'title' => 'View Record #{$id}',
            'moduleName' => 'Guidance & Counseling Intake Records System',
            'slug' => 'guidance',
            'record' => $record,
            'records' => [],
            'crumbs' => ['Guidance & Counseling Intake Records System' => url('guidance'), 'View' => '']
        ]);
    }

    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('guidance'));
        }

        try {
            Database::insert('gdc_records', [
                'title' => $title,
                'description' => $description,
                'status' => 'active',
                'created_by' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s')
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
        View::render('guidance/Views/student_profile', [
            'title' => 'Student Profile',
            'slug' => 'guidance'
        ]);
    }


    public function studenthistory(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student_history', [
            'title' => 'Student History',
            'slug' => 'guidance'
        ]);
    }

    public function appointmentrequests(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/appointment_requests', [
            'title' => 'Appointment Requests',
            'slug' => 'guidance'
        ]);
    }

    public function sessioncalendar(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/session_calendar', [
            'title' => 'Session Calendar',
            'slug' => 'guidance'
        ]);
    }


    public function appointmentstatus(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/appointment_status', [
            'title' => 'Appointment Status',
            'slug' => 'guidance'
        ]);
    }


    public function studentconcerns(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student_concerns', [
            'title' => 'Student Concerns',
            'slug' => 'guidance'
        ]);
    }


    public function counselingsession(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/counseling_session', [
            'title' => 'Counseling Session',
            'slug' => 'guidance'
        ]);
    }


    public function caseprogress(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/case_progress', [
            'title' => 'Case Progress',
            'slug' => 'guidance'
        ]);
    }

    public function guidanceassessment(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/guidance_assessment', [
            'title' => 'Guidance Assessment',
            'slug' => 'guidance'
        ]);
    }

    public function careerassessment(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/career_assessment', [
            'title' => 'Career Assessment',
            'slug' => 'guidance'
        ]);
    }

    public function studentevaluationrecords(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student_evaluation_records', [
            'title' => 'Student Evaluation Records',
            'slug' => 'guidance'
        ]);
    }


    public function counselingplans(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/counseling_plans', [
            'title' => 'Counseling Plans',
            'slug' => 'guidance'
        ]);
    }


    public function referrals(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/referrals', [
            'title' => 'Referrals',
            'slug' => 'guidance'
        ]);
    }


    public function followup(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/follow_up', [
            'title' => 'Follow Up',
            'slug' => 'guidance'
        ]);
    }


    public function counselingserviceutilization(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/counseling_service_utilization', [
            'title' => 'Counseling Service Utilization',
            'slug' => 'guidance'
        ]);
    }


    public function studentconcernssummary(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student_concerns_summary', [
            'title' => 'Student Concerns Summary',
            'slug' => 'guidance'
        ]);
    }


    public function guidanceprogramreports(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/guidance_program_reports', [
            'title' => 'Guidance Program Reports',
            'slug' => 'guidance'
        ]);
    }

    public function studentconcerntypes(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/student_concern_types', [
            'title' => 'Student Concern Types',
            'slug' => 'guidance'
        ]);
    }



    public function useraccountmanagement(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/user_account_management', [
            'title' => 'User Account Management',
            'slug' => 'guidance'
        ]);
    }


    public function rolebasedaccesscontrol(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/role_based_access_control', [
            'title' => 'Role Based Access Control',
            'slug' => 'guidance'
        ]);
    }


    public function activitylogs(): void
    {
        $user = Auth::user();
        View::render('guidance/Views/activity_logs', [
            'title' => 'Activity Logs',
            'slug' => 'guidance'
        ]);
    }
}
