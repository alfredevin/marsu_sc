<?php
namespace Modules\Orgleadership\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Leadership Accreditation & Officer Evaluation
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `sld_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('orgleadership/Views/index', [
            'title'       => 'Student Leadership Accreditation & Officer Evaluation',
            'moduleName'  => 'Student Leadership Accreditation & Officer Evaluation',
            'slug'        => 'orgleadership',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Leadership Accreditation & Officer Evaluation' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `sld_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('orgleadership'));
        }

        View::render('orgleadership/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Student Leadership Accreditation & Officer Evaluation',
            'slug'        => 'orgleadership',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Student Leadership Accreditation & Officer Evaluation' => url('orgleadership'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('orgleadership'));
        }

        try {
            Database::insert('sld_records', [
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

        redirect(url('orgleadership'));
    }
}
