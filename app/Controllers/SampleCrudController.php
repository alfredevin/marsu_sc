<?php

namespace App\Controllers;

use Core\View;
use Core\Database;
use Core\Session;

/**
 * ==============================================================================
 * MarSU ERP - Sample CRUD Controller (Demo / Reference for Students)
 * ==============================================================================
 * Pakay: Ipakita ang basic na 2-field CRUD (Insert, View, Update, Delete)
 * Gamit ang native PHP 8 at handwritten Core\Database helper.
 *
 * Dalawang (2) Fields lamang:
 *   1. title    - Pamagat / Pangalan ng Item
 *   2. category - Kategorya / Uri ng Item
 * ==============================================================================
 */
class SampleCrudController
{

    /**
     * 1. VIEW / DISPLAY (Fetch All Records)
     * Kunin lahat ng records mula sa database at i-display sa HTML view.
     */
    public function index(): void
    {
        // Kunin ang lahat ng active records (hindi deleted)
        $items = Database::fetchAll(
            "SELECT * FROM sample_items "
        );

        // I-render ang view at ipasa ang $items
        View::render('sample_crud/index', [
            'title'  => 'CRUD Demo & Reference Guide',
            'items'  => $items,
            'crumbs' => ['Administration' => '', 'CRUD Demo (2 Fields)' => '']
        ]);
    }

    /**
     * 2. INSERT / CREATE (Save New Record)
     * Kapag nag-submit ang form ng "Add Item", dito papasok ang POST request.
     */
    public function store(): void
    {
        $title    = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $location = trim($_POST['location'] ?? '');


        // Database::insert() helper
        Database::insert('sample_items', [
            'title'      => $title,
            'category'   => $category,
            'location'  => $location,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', "Tagumpay na na-insert ang item: \"{$title}\"!");
        redirect(url('sample-crud'));
    }

    /**
     * 3. UPDATE / EDIT (Modify Existing Record)
     * Kapag nag-submit ang edit modal, i-update ang record gamit ang ID nito.
     */
    public function update(): void
    {
        $id       = (int)($_POST['id'] ?? 0);
        $title    = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? '');


        // Validation
        if ($id <= 0 || empty($title) || empty($category)) {
            Session::flash('error', 'May kulang na impormasyon para sa pag-update.');
            redirect(url('sample-crud'));
            return;
        }

        // Database::update() helper na may prepared statement
        Database::update('sample_items', [
            'title'      => $title,
            'category'   => $category,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $id]);

        Session::flash('success', "Na-update na ang Item #{$id} (\"{$title}\")!");
        redirect(url('sample-crud'));
    }

    /**
     * 4. DELETE / ARCHIVE (Soft Delete)
     * Sa halip na burahin nang tuluyan, i-set lang ang deleted_at timestamp.
     */
    public function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            Database::update('sample_items', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);

            Session::flash('success', "Na-archive / na-delete ang Item #{$id}.");
        }

        redirect(url('sample-crud'));
    }
}
