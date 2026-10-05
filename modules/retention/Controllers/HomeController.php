<?php
namespace Modules\Retention\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Retention & Academic Risk Early Warning System
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `ret_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('retention/Views/index', [
            'title'       => 'Student Retention & Academic Risk Early Warning System',
            'moduleName'  => 'Student Retention & Academic Risk Early Warning System',
            'slug'        => 'retention',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Academic Analytics' => '',
                'Student Retention & Academic Risk Early Warning System' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `ret_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('retention'));
        }

        View::render('retention/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Student Retention & Academic Risk Early Warning System',
            'slug'        => 'retention',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Student Retention & Academic Risk Early Warning System' => url('retention'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('retention'));
        }

        try {
            Database::insert('ret_records', [
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

        redirect(url('retention'));
    }
     public function profile(): void {
        $user = Auth::user();
        View::render('retention/Views/profile', [
            'title'       => 'Student Profile',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management'           => '',
                'Occupancy Report'  => ''
            ]
        ]);
    }
}
