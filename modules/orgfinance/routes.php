<?php
/**
 * Route declarations for module: Student Organizations Collection & Financial Management
 * Slug: orgfinance
 */

use Modules\Orgfinance\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/orgfinance', [HomeController::class, 'index'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/show', [HomeController::class, 'show'], ['auth', 'permission:orgfinance.view']);
$router->post('/orgfinance/create', [HomeController::class, 'store'], ['auth', 'permission:orgfinance.create', 'csrf']);
