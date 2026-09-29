<?php
namespace Modules\Assets\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for University Equipment & IT Asset Management
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `ast_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('assets/Views/index', [
            'title'       => 'University Equipment & IT Asset Management',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Campus Operations' => '',
                'University Equipment & IT Asset Management' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `ast_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('assets'));
        }

        View::render('assets/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['University Equipment & IT Asset Management' => url('assets'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('assets'));
        }

        try {
            Database::insert('ast_records', [
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

        redirect(url('assets'));
    }
}
