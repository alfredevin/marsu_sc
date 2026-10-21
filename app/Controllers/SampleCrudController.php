<?php

namespace App\Controllers;

use Core\View;
use Core\Database;
use Core\Session;

class SampleCrudController
{
    public function index(): void
    {
        $items = Database::fetchAll(
            "SELECT * FROM sample_items "
        );
        View::render('sample_crud/index', [
            'title' => 'CRUD Demo & Reference Guide',
            'items' => $items,
            'crumbs' => ['Administration' => '', 'CRUD Demo (2 Fields)' => '']
        ]);
    }
    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $gender = trim($_POST['gender'] ?? '');



        // Database::insert() helper
        Database::insert('sample_items', [
            'title'      => $title,
            'category'   => $category,
            'location'  => $location,
            'gender' => $gender,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        Session::flash('success', "Tagumpay na na-insert ang item: \"{$title}\"!");
        redirect(url('sample-crud'));
    }
    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? '');

        // Validation
        if ($id <= 0 || empty($title) || empty($category)) {
            Session::flash('error', 'May kulang na impormasyon para sa pag-update.');
            redirect(url('sample-crud'));
            return;
        }

        // Database::update() helper na may prepared statement
        Database::update('sample_items', [
            'title' => $title,
            'category' => $category,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $id]);
        Session::flash('success', "Na-update na ang Item #{$id} (\"{$title}\")!");
        redirect(url('sample-crud'));
    }
    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {
            Database::update('sample_items', [
                'deleted_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            Session::flash('success', "Na-archive / na-delete ang Item #{$id}.");
        }
        redirect(url('sample-crud'));
    }
}
