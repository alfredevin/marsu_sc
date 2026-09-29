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
}
