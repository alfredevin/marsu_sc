<?php
/**
 * Route declarations for module: Procurement Management Information System
 * Slug: procurement
 */

use Modules\Procurement\Controllers\HomeController;

// Dashboard
$router->get('/procurement',       [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/index', [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);

// Purchase Requests & Requisitions (PR & RIS)
$router->get('/procurement/pr-filling',                    [HomeController::class, 'prfilling'],                  ['auth', 'permission:procurement.view']);
$router->get('/procurement/resquisition-and-issue-slip',   [HomeController::class, 'requisitionandissueslip'],    ['auth', 'permission:procurement.view']);
$router->get('/procurement/approval-worlkflow',            [HomeController::class, 'approvalworkflow'],           ['auth', 'permission:procurement.view']);
$router->get('/procurement/requisition-status',            [HomeController::class, 'requisitionstatus'],          ['auth', 'permission:procurement.view']);

// Annual Procurement Planning & Budgeting
$router->get('/procurement/project-procurement-management-plan', [HomeController::class, 'projectprocurementmanagementplan'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/consolidated-app',              [HomeController::class, 'consolidatedapp'],            ['auth', 'permission:procurement.view']);
$router->get('/procurement/fund-source-verification',      [HomeController::class, 'fundsourceverification'],     ['auth', 'permission:procurement.view']);

// Purchase Orders
$router->get('/procurement/po-generation',                 [HomeController::class, 'pogeneration'],               ['auth', 'permission:procurement.view']);
$router->get('/procurement/delivery-tracker',              [HomeController::class, 'deliverytracker'],            ['auth', 'permission:procurement.view']);

// Inspection, Acceptance & Turn-over
$router->get('/procurement/iar-processing',                [HomeController::class, 'iarprocessing'],              ['auth', 'permission:procurement.view']);
$router->get('/procurement/discrepancy-management',        [HomeController::class, 'discrepancymanagement'],      ['auth', 'permission:procurement.view']);
$router->get('/procurement/property-turn-over',            [HomeController::class, 'propertyturnover'],           ['auth', 'permission:procurement.view']);

// Compliance, Auditing & Reports
$router->get('/procurement/apcpi-tracker',                 [HomeController::class, 'apcpitracker'],               ['auth', 'permission:procurement.view']);
$router->get('/procurement/periodic-summaries',            [HomeController::class, 'periodicsummaries'],          ['auth', 'permission:procurement.view']);
$router->get('/procurement/coa-audit-trail',               [HomeController::class, 'coaaudittrail'],              ['auth', 'permission:procurement.view']);
