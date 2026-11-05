<?php

namespace App\Controllers;

use Core\View;
use Core\Database;
use Core\Session;

/**
 * Controller for 2-Field CRUD Demo & Reference Guide
 * Fields: title, category
 */
class SampleCrudController
{
    /**
     * 1. READ / VIEW: Kunin ang lahat ng active records
     */
    public function index(): void
    {
        $items = Database::fetchAll(
            "SELECT * FROM sample_items WHERE deleted_at IS NULL ORDER BY id DESC"
        );

        View::render('sample_crud/index', [
            'title'  => 'CRUD Demo & Reference Guide',
            'items'  => $items,
            'crumbs' => ['Administration' => '', 'CRUD Demo (2 Fields)' => '']
        ]);
    }

    /**
     * 2. CREATE / INSERT: Mag-save ng bagong item
     *  gamit ang Database::insert()
     */
    public function store(): void
    {
        $title    = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $purpose = trim($_POST['purpose'] ?? '');


        // Database::insert() Core Helper
        Database::insert('sample_items', [
            'title'      => $title,
            'category'   => $category,
            'purpose'   => $purpose,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', "Tagumpay na na-insert ang bagong item: \"{$title}\"!");
        redirect(url('sample-crud'));
    }

    /**
     * 3. UPDATE: Baguhin ang existing item gamit ang Database::update()
     */
    public function update(): void
    {
        $id       = (int) ($_POST['id'] ?? 0);
        $title    = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? '');

        // Validation
        if ($id <= 0 || empty($title) || empty($category)) {
            Session::flash('error', 'May kulang na impormasyon para sa pag-update.');
            redirect(url('sample-crud'));
            return;
        }

        // Database::update() Core Helper na may Prepared Statement
        Database::update('sample_items', [
            'title'      => $title,
            'category'   => $category,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $id]);

        Session::flash('success', "Na-update na ang Item #{$id} (\"{$title}\")!");
        redirect(url('sample-crud'));
    }

    /**
     * 4. DELETE / ARCHIVE: Soft-delete gamit ang Database::update() at deleted_at
     */
    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {
            Database::update('sample_items', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);

            Session::flash('success', "Na-archive / na-delete na ang Item #{$id}.");
        } else {
            Session::flash('error', 'Hindi wastong Item ID.');
        }

        redirect(url('sample-crud'));
    }
}
