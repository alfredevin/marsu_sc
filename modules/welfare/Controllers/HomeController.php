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
        View::render('welfare/Views/student-profile-information', [
            'title' => 'Student Profile Information',
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
    public function socioeconomicbackground(): void
    {
        $user = Auth::user();
        View::render('welfare/Views/socio-economic-background', [
            'title' => 'Socio Economic Background',
            'slug'  => 'welfare'
        ]);
    }
}
