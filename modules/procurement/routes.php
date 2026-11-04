<?php
/**
 * Route declarations for module: Procurement Management Information System (SPMS)
 * Slug: procurement
 */

use Modules\Procurement\Controllers\HomeController;

// Dashboard
$router->get('/procurement',       [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/index', [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);

// 1. Purchase Requests & Requisitions (PR & RIS)
$router->get('/procurement/pr-filling',                  [HomeController::class, 'prfilling'],               ['auth', 'permission:procurement.view']);
$router->post('/procurement/pr-filling/store',           [HomeController::class, 'storePR'],                 ['auth', 'csrf']);
$router->get('/procurement/resquisition-and-issue-slip', [HomeController::class, 'requisitionandissueslip'], ['auth', 'permission:procurement.view']);
$router->post('/procurement/resquisition-and-issue-slip/store', [HomeController::class, 'storeRIS'],        ['auth', 'csrf']);
$router->get('/procurement/approval-worlkflow',          [HomeController::class, 'approvalworkflow'],        ['auth', 'permission:procurement.view']);
$router->post('/procurement/approval-workflow/decide',   [HomeController::class, 'decideApproval'],          ['auth', 'csrf']);
$router->get('/procurement/requisition-status',          [HomeController::class, 'requisitionstatus'],       ['auth', 'permission:procurement.view']);

// 2. Annual Procurement Planning & Budgeting
$router->get('/procurement/project-procurement-management-plan', [HomeController::class, 'projectprocurementmanagementplan'], ['auth', 'permission:procurement.view']);
$router->post('/procurement/project-procurement-management-plan/store', [HomeController::class, 'storePPMP'],                 ['auth', 'csrf']);
$router->get('/procurement/consolidated-app',            [HomeController::class, 'consolidatedapp'],         ['auth', 'permission:procurement.view']);
$router->post('/procurement/consolidated-app/decide',     [HomeController::class, 'decidePPMP'],              ['auth', 'csrf']);
$router->post('/procurement/consolidated-app/finalize-rfq', [HomeController::class, 'finalizeRFQ'],          ['auth', 'csrf']);
$router->get('/procurement/fund-source-verification',    [HomeController::class, 'fundsourceverification'],  ['auth', 'permission:procurement.view']);
$router->post('/procurement/fund-source-verification/store', [HomeController::class, 'storeAllocatedFund'],   ['auth', 'csrf']);

// 3. Purchase Orders
$router->get('/procurement/po-generation',               [HomeController::class, 'pogeneration'],            ['auth', 'permission:procurement.view']);
$router->post('/procurement/po-generation/store',        [HomeController::class, 'storePO'],                 ['auth', 'csrf']);
$router->get('/procurement/delivery-tracker',            [HomeController::class, 'deliverytracker'],         ['auth', 'permission:procurement.view']);
$router->post('/procurement/delivery-tracker/receive',    [HomeController::class, 'receiveDelivery'],         ['auth', 'csrf']);

// 4. Inspection, Acceptance & Turn-over
$router->get('/procurement/iar-processing',              [HomeController::class, 'iarprocessing'],           ['auth', 'permission:procurement.view']);
$router->post('/procurement/iar-processing/inspect',     [HomeController::class, 'inspectDelivery'],         ['auth', 'csrf']);
$router->get('/procurement/discrepancy-management',      [HomeController::class, 'discrepancymanagement'],   ['auth', 'permission:procurement.view']);
$router->get('/procurement/property-turn-over',          [HomeController::class, 'propertyturnover'],        ['auth', 'permission:procurement.view']);
$router->post('/procurement/property-turn-over/issue',   [HomeController::class, 'issueProperty'],           ['auth', 'csrf']);

// 5. Compliance, Auditing & Reports
$router->get('/procurement/apcpi-tracker',               [HomeController::class, 'apcpitracker'],            ['auth', 'permission:procurement.view']);
$router->post('/procurement/apcpi-tracker/supplier-store', [HomeController::class, 'storeSupplier'],         ['auth', 'csrf']);
$router->post('/procurement/apcpi-tracker/catalog-store',  [HomeController::class, 'storeCatalogItem'],      ['auth', 'csrf']);
$router->get('/procurement/periodic-summaries',          [HomeController::class, 'periodicsummaries'],       ['auth', 'permission:procurement.view']);
$router->post('/procurement/periodicsummaries/reconcile', [HomeController::class, 'reconcileInventory'],    ['auth', 'csrf']);
$router->get('/procurement/coa-audit-trail',             [HomeController::class, 'coaaudittrail'],           ['auth', 'permission:procurement.view']);
$router->post('/procurement/coaaudittrail/report-issue', [HomeController::class, 'reportPropertyIssue'],     ['auth', 'csrf']);
