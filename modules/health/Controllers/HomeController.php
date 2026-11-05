<?php

namespace Modules\Health\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Smart Student Health Monitoring and Clinic Management System
 */
class HomeController
{

    private function getRecords(): array
    {
        try {
            return Database::fetchAll("SELECT * FROM `hth_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            return [];
        }
    }

    public function index(): void
    {
        $user = Auth::user();
        $records = $this->getRecords();

        View::render('health/Views/index', [
            'title'          => 'Student Health Profile',
            'moduleName'     => 'Student Health Profile',
            'slug'           => 'health',
            'records'        => $records,
            'user'           => $user,
            'activeSection'  => 'dashboard',
            'sectionTitle'   => 'Student Health Profile',
            'crumbs'         => [
                'Student Welfare & Clinic' => '',
                'Student Health Profile' => ''
            ]
        ]);
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $record = null;
        try {
            $record = Database::fetchOne("SELECT * FROM `hth_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        } catch (\Exception $e) {
        }

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('health'));
        }

        View::render('health/Views/index', [
            'title'          => "View Record #{$id}",
            'moduleName'     => 'Smart Student Health Monitoring and Clinic Management System',
            'slug'           => 'health',
            'record'         => $record,
            'records'        => [],
            'activeSection'  => 'records',
            'sectionTitle'   => "Record Details #{$id}",
            'crumbs'         => ['Clinic Management' => url('health'), 'View' => '']
        ]);
    }

    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('health'));
        }

        try {
            Database::insert('hth_records', [
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

        redirect(url('health'));
    }


    public function patientRegistration(): void
    {
        $user = Auth::user();
        View::render('health/Views/patient-registration', [
            'title'       => 'Patient Registration',
            'moduleName'  => 'Smart Student Health Monitoring and Clinic Management System',
            'slug'        => 'health',
            'user'        => $user,
            'crumbs'      => [
                'Clinic Management'      => url('health'),
                'Student Health Profile' => '',
                'Patient Registration'   => ''
            ]
        ]);
    }

    public function studentInfoHub(): void
    {
        $user = Auth::user();
        View::render('health/Views/student-info-hub', [
            'title'       => 'Student Information & Health Hub',
            'moduleName'  => 'Smart Student Health Monitoring and Clinic Management System',
            'slug'        => 'health',
            'user'        => $user,
            'crumbs'      => [
                'Clinic Management'      => url('health'),
                'Student Health Profile' => '',
                'Student Info Hub'       => ''
            ]
        ]);
    }

    public function HealthStatistics(): void
    {
        $user = Auth::user();
        View::render('health/Views/student-health-statistics', [
            'title'       => 'Student Health Statistics',
            'moduleName'  => 'Smart Student Health Monitoring and Clinic Management System',
            'slug'        => 'health',
            'user'        => $user,
            'crumbs'      => [
                'Clinic Management'         => url('health'),
                'Student Health Profile'    => '',
                'Student Health Statistics' => ''
            ]
        ]);
    }

    public function MedicalAssessment(): void
    {
        $user = Auth::user();
        View::render('health/Views/medical-assessment', [
            'title'       => 'Medical Assessment',
            'moduleName'  => 'Smart Student Health Monitoring and Clinic Management System',
            'slug'        => 'health',
            'user'        => $user,
            'crumbs'      => [
                'Clinic Management'   => url('health'),
                'Consultation Mgmt'   => '',
                'Medical Assessment'  => ''
            ]
        ]);
    }
}
