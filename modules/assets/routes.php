<?php
/**
 * Route declarations for module: University Equipment & IT Asset Management
 * Slug: assets
 */

use Modules\Assets\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/assets/assetprofilecreation', [HomeController::class, 'assetprofilecreation'], ['auth', 'permission:assets.view']);
$router->get('/assets/propertyidentificationnumbers', [HomeController::class, 'propertyidentificationnumbers'], ['auth', 'permission:assets.view']);

