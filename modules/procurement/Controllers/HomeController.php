<?php
namespace Modules\Procurement\Controllers;

use Core\View;
use Core\Auth;

/**
 * Controller for Procurement Management Information System (PMIS)
 * Student Module 1 — Connected with Campus Operations
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();

        View::render('procurement/Views/index', [
            'title'      => 'Procurement Management Information System',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => $user,
            'crumbs'     => [
                'Campus Operations' => '',
                'Procurement Management Information System' => ''
            ]
        ]);
    }
}
