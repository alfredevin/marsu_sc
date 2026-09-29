<?php
/**
 * Route declarations for module: Guidance & Counseling Intake Records System
 * Slug: guidance
 */

use Modules\Guidance\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/guidance', [HomeController::class, 'index'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/show', [HomeController::class, 'show'], ['auth', 'permission:guidance.view']);
$router->post('/guidance/create', [HomeController::class, 'store'], ['auth', 'permission:guidance.create', 'csrf']);
