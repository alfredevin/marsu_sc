<?php
/**
 * Route declarations for module: 4Ps Beneficiary Expenses Monitoring
 * Slug: expense4ps
 */

use Modules\Expense4ps\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/expense4ps', [HomeController::class, 'index'], ['auth', 'permission:expense4ps.view']);
$router->get('/expense4ps/show', [HomeController::class, 'show'], ['auth', 'permission:expense4ps.view']);
$router->post('/expense4ps/create', [HomeController::class, 'store'], ['auth', 'permission:expense4ps.create', 'csrf']);
