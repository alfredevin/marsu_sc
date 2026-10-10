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
        View::render('guidance/Views/student-profile', [
            'title' => 'Student Profile',
            'slug'  => 'guidance'
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
