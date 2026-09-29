<?php
namespace Modules\Health\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for University Health & Medical Consultation Clinic
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `hth_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('health/Views/index', [
            'title'       => 'University Health & Medical Consultation Clinic',
            'moduleName'  => 'University Health & Medical Consultation Clinic',
            'slug'        => 'health',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Welfare & Clinic' => '',
                'University Health & Medical Consultation Clinic' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `hth_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('health'));
        }

        View::render('health/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'University Health & Medical Consultation Clinic',
            'slug'        => 'health',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['University Health & Medical Consultation Clinic' => url('health'), 'View' => '']
        ]);
    }

    public function store(): void {
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
}
