<?php
namespace App\Controllers;

use Core\View;

class UiKitController {
    public function index(): void {
        View::render('uikit/index', [
            'title'  => 'UI Kit & Component Styleguide',
            'crumbs' => ['Design System' => '', 'UI Kit' => '']
        ]);
    }
}
