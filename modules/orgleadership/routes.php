<?php
/**
 * Route declarations for module: Student Leadership Accreditation & Officer Evaluation
 * Slug: orgleadership
 */

use Modules\Orgleadership\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/orgleadership', [HomeController::class, 'index'], ['auth', 'permission:orgleadership.view']);
$router->get('/orgleadership/show', [HomeController::class, 'show'], ['auth', 'permission:orgleadership.view']);
$router->post('/orgleadership/create', [HomeController::class, 'store'], ['auth', 'permission:orgleadership.create', 'csrf']);
