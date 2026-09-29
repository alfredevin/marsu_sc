<?php
namespace Modules\Expense4ps\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for 4Ps Beneficiary Expenses Monitoring
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `exp_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('expense4ps/Views/index', [
            'title'       => '4Ps Beneficiary Expenses Monitoring',
            'moduleName'  => '4Ps Beneficiary Expenses Monitoring',
            'slug'        => 'expense4ps',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Services' => '',
                '4Ps Beneficiary Expenses Monitoring' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `exp_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('expense4ps'));
        }

        View::render('expense4ps/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => '4Ps Beneficiary Expenses Monitoring',
            'slug'        => 'expense4ps',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['4Ps Beneficiary Expenses Monitoring' => url('expense4ps'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('expense4ps'));
        }

        try {
            Database::insert('exp_records', [
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

        redirect(url('expense4ps'));
    }
}
