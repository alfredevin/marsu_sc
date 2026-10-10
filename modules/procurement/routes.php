<?php
/**
 * Route declarations for module: Procurement Management Information System
 * Slug: procurement
 */

use Modules\Procurement\Controllers\HomeController;

// Module Dashboard & Base CRUD
$router->get('/procurement', [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/index', [HomeController::class, 'index'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/show', [HomeController::class, 'show'], ['auth', 'permission:procurement.view']);
$router->post('/procurement/create', [HomeController::class, 'store'], ['auth', 'permission:procurement.view', 'csrf']);

// 1. Purchase Request Management
$router->get('/procurement/purchase-request-initiation', [HomeController::class, 'purchaseRequestInitiation'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/department-pr-verification', [HomeController::class, 'departmentPrVerification'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/fund-allocation', [HomeController::class, 'fundAllocation'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/pr-tracking', [HomeController::class, 'prTracking'], ['auth', 'permission:procurement.view']);

// 2. Canvass & Quotation Management
$router->get('/procurement/request-for-quotations', [HomeController::class, 'requestForQuotations'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/price-canvass', [HomeController::class, 'priceCanvass'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/abstract-of-bids', [HomeController::class, 'abstractOfBids'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/bac-resolution', [HomeController::class, 'bacResolution'], ['auth', 'permission:procurement.view']);

// 3. Purchase Order Management
$router->get('/procurement/purchase-order-generation', [HomeController::class, 'purchaseOrderGeneration'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/notice-to-proceed', [HomeController::class, 'noticeToProceed'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/delivery-tracking', [HomeController::class, 'deliveryTracking'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/contract-monitoring', [HomeController::class, 'contractMonitoring'], ['auth', 'permission:procurement.view']);

// 4. Inspection & Asset Handover
$router->get('/procurement/delivery-inspection', [HomeController::class, 'deliveryInspection'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/specification-check', [HomeController::class, 'specificationCheck'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/inspection-acceptance-report', [HomeController::class, 'inspectionAcceptanceReport'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/asset-transfer', [HomeController::class, 'assetTransfer'], ['auth', 'permission:procurement.view']);

// 5. Suppliers & Vendor Management
$router->get('/procurement/suppliers-registry', [HomeController::class, 'suppliersRegistry'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/philgeps-tracking', [HomeController::class, 'philgepsTracking'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/supplier-evaluation', [HomeController::class, 'supplierEvaluation'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/vendor-blacklist', [HomeController::class, 'vendorBlacklist'], ['auth', 'permission:procurement.view']);

// 6. Procurement Audit & Reports
$router->get('/procurement/annual-procurement-plan', [HomeController::class, 'annualProcurementPlan'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/bac-reports', [HomeController::class, 'bacReports'], ['auth', 'permission:procurement.view']);
$router->get('/procurement/audit-trail', [HomeController::class, 'auditTrail'], ['auth', 'permission:procurement.view']);
