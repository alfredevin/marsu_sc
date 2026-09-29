<?php
namespace Modules\Orgfinance\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Organizations Collection & Financial Management
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `orf_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('orgfinance/Views/index', [
            'title'       => 'Student Organizations Collection & Financial Management',
            'moduleName'  => 'Student Organizations Collection & Financial Management',
            'slug'        => 'orgfinance',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Organizations Collection & Financial Management' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `orf_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('orgfinance'));
        }

        View::render('orgfinance/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Student Organizations Collection & Financial Management',
            'slug'        => 'orgfinance',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Student Organizations Collection & Financial Management' => url('orgfinance'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('orgfinance'));
        }

        try {
            Database::insert('orf_records', [
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

        redirect(url('orgfinance'));
    }
}
