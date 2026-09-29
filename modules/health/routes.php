<?php
/**
 * Route declarations for module: University Health & Medical Consultation Clinic
 * Slug: health
 */

use Modules\Health\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/health', [HomeController::class, 'index'], ['auth', 'permission:health.view']);
$router->get('/health/show', [HomeController::class, 'show'], ['auth', 'permission:health.view']);
$router->post('/health/create', [HomeController::class, 'store'], ['auth', 'permission:health.create', 'csrf']);
