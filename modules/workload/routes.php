<?php
/**
 * Route declarations for module: Faculty Teaching Workload Management
 * Slug: workload
 */

use Modules\Workload\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/workload', [HomeController::class, 'index'], ['auth', 'permission:workload.view']);
$router->get('/workload/show', [HomeController::class, 'show'], ['auth', 'permission:workload.view']);
$router->post('/workload/create', [HomeController::class, 'store'], ['auth', 'permission:workload.create', 'csrf']);
