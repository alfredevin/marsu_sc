<?php
/**
 * Route declarations for module: University Equipment & IT Asset Management
 * Slug: assets
 */

use Modules\Assets\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/assets', [HomeController::class, 'index'], ['auth', 'permission:assets.view']);
$router->get('/assets/show', [HomeController::class, 'show'], ['auth', 'permission:assets.view']);
$router->post('/assets/create', [HomeController::class, 'store'], ['auth', 'permission:assets.create', 'csrf']);
