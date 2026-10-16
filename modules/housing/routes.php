<?php
/**
 * Route declarations for module: Accredited Boarding House Management & Directory (ISHAMIS)
 * Slug: housing
 */

use Modules\Housing\Controllers\HomeController;
use Modules\Housing\Controllers\SampleRoomController;

// Student Demo & Sample CRUD Route
$router->get('/housing/sample-room', [SampleRoomController::class, 'index'], ['auth', 'permission:housing.view']);
$router->post('/housing/sample-room', [SampleRoomController::class, 'index'], ['auth', 'permission:housing.view', 'csrf']);

// Module Dashboard & Records
$router->get('/housing', [HomeController::class, 'index'], ['auth', 'permission:housing.view']);
$router->get('/housing/index', [HomeController::class, 'index'], ['auth', 'permission:housing.view']);
$router->get('/housing/show', [HomeController::class, 'show'], ['auth', 'permission:housing.view']);
$router->post('/housing/create', [HomeController::class, 'store'], ['auth', 'permission:housing.view', 'csrf']);

// 1. Tenant Management
$router->get('/housing/tenants', [HomeController::class, 'tenants'], ['auth', 'permission:housing.view']);
$router->post('/housing/tenants/create', [HomeController::class, 'storeTenant'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/tenants/delete', [HomeController::class, 'deleteTenant'], ['auth', 'permission:housing.view', 'csrf']);
$router->get('/housing/residencyhistory', [HomeController::class, 'residencyhistory'], ['auth', 'permission:housing.view']);
$router->get('/housing/history', [HomeController::class, 'history'], ['auth', 'permission:housing.view']);

// 2. Room & Accommodation
$router->get('/housing/roomandinventory', [HomeController::class, 'roomandinventory'], ['auth', 'permission:housing.view']);
$router->get('/housing/availabilitytracking', [HomeController::class, 'availabilitytracking'], ['auth', 'permission:housing.view']);
$router->get('/housing/roomassignment', [HomeController::class, 'roomassignment'], ['auth', 'permission:housing.view']);
$router->get('/housing/roomassignments', [HomeController::class, 'roomassignments'], ['auth', 'permission:housing.view']);
$router->get('/housing/rooms', [HomeController::class, 'rooms'], ['auth', 'permission:housing.view']);
$router->get('/housing/occupancymonitoring', [HomeController::class, 'occupancymonitoring'], ['auth', 'permission:housing.view']);
$router->get('/housing/bedallocation', [HomeController::class, 'bedallocation'], ['auth', 'permission:housing.view']);
$router->post('/housing/rooms/create', [HomeController::class, 'storeRoom'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/rooms/delete', [HomeController::class, 'deleteRoom'], ['auth', 'permission:housing.view', 'csrf']);

// 3. Reservation & Application
$router->get('/housing/housingapplication', [HomeController::class, 'housingapplication'], ['auth', 'permission:housing.view']);
$router->get('/housing/housingapplications', [HomeController::class, 'housingapplications'], ['auth', 'permission:housing.view']);
$router->get('/housing/approvalworkflow', [HomeController::class, 'approvalworkflow'], ['auth', 'permission:housing.view']);
$router->get('/housing/reservationmanagement', [HomeController::class, 'reservationmanagement'], ['auth', 'permission:housing.view']);
$router->get('/housing/waitinglist', [HomeController::class, 'waitinglist'], ['auth', 'permission:housing.view']);
$router->post('/housing/applications/create', [HomeController::class, 'storeApplication'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/applications/status', [HomeController::class, 'updateApplicationStatus'], ['auth', 'permission:housing.view', 'csrf']);

// 4. Payment & Billing
$router->get('/housing/boardingfees', [HomeController::class, 'boardingfees'], ['auth', 'permission:housing.view']);
$router->get('/housing/paymentrecords', [HomeController::class, 'paymentrecords'], ['auth', 'permission:housing.view']);
$router->get('/housing/balancemonitoring', [HomeController::class, 'balancemonitoring'], ['auth', 'permission:housing.view']);
$router->get('/housing/receiptgeneration', [HomeController::class, 'receiptgeneration'], ['auth', 'permission:housing.view']);
$router->post('/housing/payments/create', [HomeController::class, 'storePayment'], ['auth', 'permission:housing.view', 'csrf']);

// 5. Maintenance & Facilities
$router->get('/housing/maintenancerequest', [HomeController::class, 'maintenancerequest'], ['auth', 'permission:housing.view']);
$router->get('/housing/maintenancerequests', [HomeController::class, 'maintenancerequests'], ['auth', 'permission:housing.view']);
$router->get('/housing/repairmonitoring', [HomeController::class, 'repairmonitoring'], ['auth', 'permission:housing.view']);
$router->get('/housing/conditionreports', [HomeController::class, 'conditionreports'], ['auth', 'permission:housing.view']);
$router->get('/housing/servicehistory', [HomeController::class, 'servicehistory'], ['auth', 'permission:housing.view']);
$router->post('/housing/maintenance/create', [HomeController::class, 'storeMaintenance'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/maintenance/status', [HomeController::class, 'updateMaintenanceStatus'], ['auth', 'permission:housing.view', 'csrf']);

// 6. Communications & Incidents
$router->get('/housing/announcements', [HomeController::class, 'announcements'], ['auth', 'permission:housing.view']);
$router->get('/housing/residentsnotifications', [HomeController::class, 'residentsnotifications'], ['auth', 'permission:housing.view']);
$router->get('/housing/rulesandpolicies', [HomeController::class, 'rulesandpolicies'], ['auth', 'permission:housing.view']);
$router->get('/housing/incidentreporting', [HomeController::class, 'incidentreporting'], ['auth', 'permission:housing.view']);
$router->post('/housing/announcements/create', [HomeController::class, 'storeAnnouncement'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/announcements/delete', [HomeController::class, 'deleteAnnouncement'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/incidents/create', [HomeController::class, 'storeIncident'], ['auth', 'permission:housing.view', 'csrf']);
$router->post('/housing/incidents/status', [HomeController::class, 'updateIncidentStatus'], ['auth', 'permission:housing.view', 'csrf']);

// 7. Reports & Analytics
$router->get('/housing/reports', [HomeController::class, 'reports'], ['auth', 'permission:housing.view']);
$router->get('/housing/occupancyreports', [HomeController::class, 'occupancyreports'], ['auth', 'permission:housing.view']);
$router->get('/housing/revenuereports', [HomeController::class, 'revenuereports'], ['auth', 'permission:housing.view']);
$router->get('/housing/residentstatistics', [HomeController::class, 'residentstatistics'], ['auth', 'permission:housing.view']);
$router->get('/housing/facilityutilization', [HomeController::class, 'facilityutilization'], ['auth', 'permission:housing.view']);
$router->get('/housing/facilityutilizations', [HomeController::class, 'facilityutilizations'], ['auth', 'permission:housing.view']);
$router->get('/housing/accreditation', [HomeController::class, 'accreditation'], ['auth', 'permission:housing.view']);
