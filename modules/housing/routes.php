<?php
/**
 * Route declarations for module: Accredited Boarding House Management & Directory
 * Slug: housing
 */

use Modules\Housing\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/housing/announcements', [HomeController::class, 'announcements'], ['auth', 'permission:housing.view']);
$router->get('/housing/approvalworkflow', [HomeController::class, 'approvalworkflow'], ['auth', 'permission:housing.view']);
$router->get('/housing/availabilitytracking', [HomeController::class, 'availabilitytracking'], ['auth', 'permission:housing.view']);
$router->get('/housing/balancemonitoring', [HomeController::class, 'balancemonitoring'], ['auth', 'permission:housing.view']);
$router->get('/housing/bedallocation', [HomeController::class, 'bedallocation'], ['auth', 'permission:housing.view']);
$router->get('/housing/boardingfees', [HomeController::class, 'boardingfees'], ['auth', 'permission:housing.view']);
$router->get('/housing/conditionreports', [HomeController::class, 'conditionreports'], ['auth', 'permission:housing.view']);
$router->get('/housing/facilityutilization', [HomeController::class, 'facilityutilization'], ['auth', 'permission:housing.view']);
$router->get('/housing/housingapplication', [HomeController::class, 'housingapplication'], ['auth', 'permission:housing.view']);
$router->get('/housing/incidentreporting', [HomeController::class, 'incidentreporting'], ['auth', 'permission:housing.view']);
$router->get('/housing/index', [HomeController::class, 'index'], ['auth', 'permission:housing.view']);
$router->get('/housing/maintenancerequests', [HomeController::class, 'maintenancerequests'], ['auth', 'permission:housing.view']);
$router->get('/housing/occupancyreports', [HomeController::class, 'occupancyreports'], ['auth', 'permission:housing.view']);
$router->get('/housing/occupancymonitoring', [HomeController::class, 'occupancymonitoring'], ['auth', 'permission:housing.view']);
$router->get('/housing/paymentrecords', [HomeController::class, 'paymentrecords'], ['auth', 'permission:housing.view']);
$router->get('/housing/recieptgeneration', [HomeController::class, 'recieptgeneration'], ['auth', 'permission:housing.view']);
$router->get('/housing/repairmonitoring', [HomeController::class, 'repairmonitoring'], ['auth', 'permission:housing.view']);
$router->get('/housing/reports', [HomeController::class, 'reports'], ['auth', 'permission:housing.view']);
$router->get('/housing/reservationmanagement', [HomeController::class, 'reservationmanagement'], ['auth', 'permission:housing.view']);
$router->get('/housing/residencyhistory', [HomeController::class, 'residencyhistory'], ['auth', 'permission:housing.view']);
$router->get('/housing/residentstatistics', [HomeController::class, 'residentstatistics'], ['auth', 'permission:housing.view']);
$router->get('/housing/revenuereports', [HomeController::class, 'revenuereports'], ['auth', 'permission:housing.view']);
$router->get('/housing/roomandinventory', [HomeController::class, 'roomandinventory'], ['auth', 'permission:housing.view']);
$router->get('/housing/rooms', [HomeController::class, 'rooms'], ['auth', 'permission:housing.view']);
$router->get('/housing/roomassignment', [HomeController::class, 'roomassignment'], ['auth', 'permission:housing.view']);
$router->get('/housing/rulesandpolicies', [HomeController::class, 'rulesandpolicies'], ['auth', 'permission:housing.view']);
$router->get('/housing/servicehistory', [HomeController::class, 'servicehistory'], ['auth', 'permission:housing.view']);
$router->get('/housing/tenants', [HomeController::class, 'tenants'], ['auth', 'permission:housing.view']);
$router->get('/housing/waitinglist', [HomeController::class, 'waitinglist'], ['auth', 'permission:housing.view']);

