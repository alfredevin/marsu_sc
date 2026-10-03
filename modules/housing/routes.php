<?php
/**
 * Route declarations for module: Accredited Boarding House Management & Directory
 * Slug: housing
 */

use Modules\Housing\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/housing', [HomeController::class, 'index'], ['auth', 'permission:housing.view']);
$router->get('/housing/rooms', [HomeController::class, 'rooms'], ['auth', 'permission:housing.view']);
$router->get('/housing/tenants', [HomeController::class, 'tenants'], ['auth', 'permission:housing.view']);
$router->get('/housing/history', [HomeController::class, 'history'], ['auth', 'permission:housing.view']);
$router->get('/housing/reports', [HomeController::class, 'reports'], ['auth', 'permission:housing.view']);
$router->get('/housing/accreditation', [HomeController::class, 'accreditation'], ['auth', 'permission:housing.view']);
$router->get('/housing/show', [HomeController::class, 'show'], ['auth', 'permission:housing.view']);
$router->post('/housing/create', [HomeController::class, 'store'], ['auth', 'permission:housing.create', 'csrf']);
