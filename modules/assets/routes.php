<?php
/**
 * Route declarations for module: University Equipment & IT Asset Management
 * Slug: assets
 */

use Modules\Assets\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/assets/assetprofilecreation', [HomeController::class, 'assetprofilecreation'], ['auth', 'permission:assets.view']);
$router->get('/assets/propertyidentificationnumbers', [HomeController::class, 'propertyidentificationnumbers'], ['auth', 'permission:assets.view']);
$router->get('/assets/assetclassification', [HomeController::class, 'assetclassification'], ['auth', 'permission:assets.view']);
$router->get('/assets/acquisitiondetails', [HomeController::class, 'acquisitiondetails'], ['auth', 'permission:assets.view']);
$router->get('/assets/supplyandequipmentinventory', [HomeController::class, 'supplyandequipmentinventory'], ['auth', 'permission:assets.view']);
$router->get('/assets/stockmonitoring', [HomeController::class, 'stockmonitoring'], ['auth', 'permission:assets.view']);
$router->get('/assets/insuanceandreturntracking', [HomeController::class, 'insuanceandreturntracking'], ['auth', 'permission:assets.view']);
$router->get('/assets/reorderlevelalerts', [HomeController::class, 'reorderlevelalerts'], ['auth', 'permission:assets.view']);
$router->get('/assets/inventoryhistory', [HomeController::class, 'inventoryhistory'], ['auth', 'permission:assets.view']);
$router->get('/assets/locationmonitoring', [HomeController::class, 'locationmonitoring'], ['auth', 'permission:assets.view']);
$router->get('/assets/assignedpersonnelunitTracking', [HomeController::class, 'assignedpersonnelunitTracking'], ['auth', 'permission:assets.view']);
$router->get('/assets/transferrecords', [HomeController::class, 'transferrecords'], ['auth', 'permission:assets.view']);
$router->get('/assets/disposalandretirementmanagement', [HomeController::class, 'disposalandretirementmanagement'], ['auth', 'permission:assets.view']);
$router->get('/assets/buildingandroomrecords', [HomeController::class, 'buildingandroomrecords'], ['auth', 'permission:assets.view']);
$router->get('/assets/facilityconditionmonitoring', [HomeController::class, 'facilityconditionmonitoring'], ['auth', 'permission:assets.view']);
$router->get('/assets/maintenancescheduling', [HomeController::class, 'maintenancescheduling'], ['auth', 'permission:assets.view']);
$router->get('/assets/repairrequest', [HomeController::class, 'repairrequest'], ['auth', 'permission:assets.view']);
$router->get('/assets/servicehistory', [HomeController::class, 'servicehistory'], ['auth', 'permission:assets.view']);
$router->get('/assets/workservicerequests', [HomeController::class, 'workservicerequests'], ['auth', 'permission:assets.view']);
$router->get('/assets/jobordertracking', [HomeController::class, 'jobordertracking'], ['auth', 'permission:assets.view']);
$router->get('/assets/maintenancepersonnelassignment', [HomeController::class, 'maintenancepersonnelassignment'], ['auth', 'permission:assets.view']);
$router->get('/assets/completionmonitoring', [HomeController::class, 'completionmonitoring'], ['auth', 'permission:assets.view']);
$router->get('/assets/inventoryreports', [HomeController::class, 'inventoryreports'], ['auth', 'permission:assets.view']);
$router->get('/assets/propertyaccountabilityreports', [HomeController::class, 'propertyaccountabilityreports'], ['auth', 'permission:assets.view']);
$router->get('/assets/assetutilizationreports', [HomeController::class, 'assetutilizationreports'], ['auth', 'permission:assets.view']);
$router->get('/assets/maintenanceperformancereports', [HomeController::class, 'maintenanceperformancereports'], ['auth', 'permission:assets.view']);
$router->get('/assets/auditreadydocumentation', [HomeController::class, 'auditreadydocumentation'], ['auth', 'permission:assets.view']);



