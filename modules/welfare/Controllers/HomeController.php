<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Main Controller for Student Welfare Services & Financial Grants Management
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
            'title'       => 'View Record #' . $id,
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

    public function dashboard(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/dashboard', [
            'title' => 'Welfare Dashboard',
            'slug'  => 'welfare',
            'user'  => $user
        ]);
    }

    // Forwarding methods to specialized sub-controllers for full compatibility
    public function studentprofileinformation(): void
    {
        (new ProfileController())->studentprofileinformation();
    }

    public function socioeconomicbackground(): void
    {
        (new ProfileController())->socioeconomicbackground();
    }

    public function supportassessment(): void
    {
        (new ProfileController())->supportassessment();
    }

    public function welfarehistoryrecords(): void
    {
        (new ProfileController())->welfarehistoryrecords();
    }

    public function caselogging(): void
    {
        (new CaseManagementController())->caselogging();
    }

    public function casemanagement(): void
    {
        (new CaseManagementController())->casemanagement();
    }

    public function followupmonitoring(): void
    {
        (new CaseManagementController())->followupmonitoring();
    }

    public function caseresolutiontracking(): void
    {
        (new CaseManagementController())->caseresolutiontracking();
    }

    public function counselingreferrals(): void
    {
        (new SupportServicesController())->counselingreferrals();
    }

    public function financialassistancerecords(): void
    {
        (new SupportServicesController())->financialassistancerecords();
    }

    public function scholarshipgrantmonitoring(): void
    {
        (new SupportServicesController())->scholarshipgrantmonitoring();
    }

    public function studentsupportprograms(): void
    {
        (new SupportServicesController())->studentsupportprograms();
    }

    public function interventionplans(): void
    {
        (new InterventionController())->interventionplans();
    }

    public function assignedpersonnel(): void
    {
        (new InterventionController())->assignedpersonnel();
    }

    public function progresstracking(): void
    {
        (new InterventionController())->progresstracking();
    }

    public function outcomeevaluation(): void
    {
        (new InterventionController())->outcomeevaluation();
    }

    public function appointments(): void
    {
        (new WelfareServicesController())->appointments();
    }

    public function advisories(): void
    {
        (new WelfareServicesController())->advisories();
    }

    public function studentwelfarereports(): void
    {
        (new ReportController())->studentwelfarereports();
    }

    public function studentconcerns(): void
    {
        (new ReportController())->studentconcerns();
    }

    public function servicereports(): void
    {
        (new ReportController())->servicereports();
    }

    public function interventionreports(): void
    {
        (new ReportController())->interventionreports();
    }

    public function concerntypes(): void
    {
        (new MaintenanceController())->concerntypes();
    }

    public function maintenance(): void
    {
        (new MaintenanceController())->maintenance();
    }
}
