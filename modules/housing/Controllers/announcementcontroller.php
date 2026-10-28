<?php

namespace App\Controllers;

use Core\View;
use Core\Database;
use Core\Session;


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