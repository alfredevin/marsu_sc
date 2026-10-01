<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Accredited Boarding House Management & Directory
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `hsg_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('housing/Views/index', [
            'title'       => 'Accredited Boarding House Management & Directory',
            'moduleName'  => 'Accredited Boarding House Management & Directory',
            'slug'        => 'housing',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Services' => '',
                'Accredited Boarding House Management & Directory' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `hsg_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('housing'));
        }

        View::render('housing/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Accredited Boarding House Management & Directory',
            'slug'        => 'housing',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Accredited Boarding House Management & Directory' => url('housing'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('housing'));
        }

        try {
            Database::insert('hsg_records', [
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

        redirect(url('housing'));
    }
}
