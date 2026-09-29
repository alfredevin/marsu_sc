<?php
/**
 * Route declarations for module: Student Retention & Academic Risk Early Warning System
 * Slug: retention
 */

use Modules\Retention\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/retention', [HomeController::class, 'index'], ['auth', 'permission:retention.view']);
$router->get('/retention/show', [HomeController::class, 'show'], ['auth', 'permission:retention.view']);
$router->post('/retention/create', [HomeController::class, 'store'], ['auth', 'permission:retention.create', 'csrf']);
