<?php
namespace Modules\Workload\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Faculty Teaching Workload Management
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `wkl_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('workload/Views/index', [
            'title'       => 'Faculty Teaching Workload Management',
            'moduleName'  => 'Faculty Teaching Workload Management',
            'slug'        => 'workload',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Academic Affairs' => '',
                'Faculty Teaching Workload Management' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `wkl_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('workload'));
        }

        View::render('workload/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Faculty Teaching Workload Management',
            'slug'        => 'workload',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Faculty Teaching Workload Management' => url('workload'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('workload'));
        }

        try {
            Database::insert('wkl_records', [
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

        redirect(url('workload'));
    }
}
