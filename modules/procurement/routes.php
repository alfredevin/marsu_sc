<?php
/**
 * Route declarations for module: Procurement Management Information System
 * Slug: procurement
 */

use Modules\Procurement\Controllers\HomeController;

$router->get('/procurement', [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/index', [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);
