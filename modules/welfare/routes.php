<?php

/**
 * Route declarations for module: Student Welfare Services & Financial Grants Management
 * Slug: welfare
 */

use Modules\Welfare\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/welfare', [HomeController::class, 'index'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/show', [HomeController::class, 'show'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/create', [HomeController::class, 'store'], ['auth', 'permission:welfare.create', 'csrf']);


$router->get('/welfare/student-profile-information', [HomeController::class, 'studentprofileinformation'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/advisories', [HomeController::class, 'advisories'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/socio-economic-background', [HomeController::class, 'socioeconomicbackground'], ['auth', 'permission:welfare.view']);
