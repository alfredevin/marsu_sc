<?php
/**
 * Route declarations for module: Institutional Repository & Knowledge Management (IRIMKMS)
 * Slug: irimkms
 */

use Modules\Irimkms\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/irimkms', [HomeController::class, 'index'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/show', [HomeController::class, 'show'], ['auth', 'permission:irimkms.view']);
$router->post('/irimkms/create', [HomeController::class, 'store'], ['auth', 'permission:irimkms.create', 'csrf']);
