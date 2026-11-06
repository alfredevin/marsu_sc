<?php

/**
 * Route declarations for module: Student Welfare Services & Financial Grants Management
 * Slug: welfare
 */

use Modules\Welfare\Controllers\HomeController;
use Modules\Welfare\Controllers\ProfileController;
use Modules\Welfare\Controllers\CaseManagementController;
use Modules\Welfare\Controllers\SupportServicesController;
use Modules\Welfare\Controllers\InterventionController;
use Modules\Welfare\Controllers\WelfareServicesController;
use Modules\Welfare\Controllers\ReportController;
use Modules\Welfare\Controllers\MaintenanceController;

// 1. Module Dashboard & Core Records
$router->get('/welfare', [HomeController::class, 'index'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/show', [HomeController::class, 'show'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/create', [HomeController::class, 'store'], ['auth', 'permission:welfare.create', 'csrf']);
$router->get('/welfare/dashboard', [HomeController::class, 'dashboard'], ['auth', 'permission:welfare.view']);

// 2. Student Profile Management
$router->get('/welfare/student-profile-information', [ProfileController::class, 'studentprofileinformation'], ['auth', 'permission:welfare.view']);

$router->get('/welfare/socio-economic-background', [ProfileController::class, 'socioeconomicbackground'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/socio-economic-background', [ProfileController::class, 'socioeconomicbackground'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/support-assessment', [ProfileController::class, 'supportassessment'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/support-assessment', [ProfileController::class, 'supportassessment'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/welfare-history-records', [ProfileController::class, 'welfarehistoryrecords'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/welfare-history-records', [ProfileController::class, 'welfarehistoryrecords'], ['auth', 'permission:welfare.view', 'csrf']);

// 3. Student Concern and Case Management
$router->get('/welfare/case-logging', [CaseManagementController::class, 'caselogging'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/case-logging', [CaseManagementController::class, 'caselogging'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/case-management', [CaseManagementController::class, 'casemanagement'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/case-management', [CaseManagementController::class, 'casemanagement'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/follow-up-monitoring', [CaseManagementController::class, 'followupmonitoring'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/follow-up-monitoring', [CaseManagementController::class, 'followupmonitoring'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/case-resolution-tracking', [CaseManagementController::class, 'caseresolutiontracking'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/case-resolution-tracking', [CaseManagementController::class, 'caseresolutiontracking'], ['auth', 'permission:welfare.view', 'csrf']);

// 4. Welfare & Support Services
$router->get('/welfare/counseling-referrals', [SupportServicesController::class, 'counselingreferrals'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/counseling-referrals', [SupportServicesController::class, 'counselingreferrals'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/financial-assistance-records', [SupportServicesController::class, 'financialassistancerecords'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/financial-assistance-records', [SupportServicesController::class, 'financialassistancerecords'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/scholarship-grant-monitoring', [SupportServicesController::class, 'scholarshipgrantmonitoring'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/scholarship-grant-monitoring', [SupportServicesController::class, 'scholarshipgrantmonitoring'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/student-support-programs', [SupportServicesController::class, 'studentsupportprograms'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/student-support-programs', [SupportServicesController::class, 'studentsupportprograms'], ['auth', 'permission:welfare.view', 'csrf']);

// 5. Intervention and Monitoring
$router->get('/welfare/intervention-plans', [InterventionController::class, 'interventionplans'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/intervention-plans', [InterventionController::class, 'interventionplans'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/assigned-personnel', [InterventionController::class, 'assignedpersonnel'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/assigned-personnel', [InterventionController::class, 'assignedpersonnel'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/progress-tracking', [InterventionController::class, 'progresstracking'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/progress-tracking', [InterventionController::class, 'progresstracking'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/outcome-evaluation', [InterventionController::class, 'outcomeevaluation'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/outcome-evaluation', [InterventionController::class, 'outcomeevaluation'], ['auth', 'permission:welfare.view', 'csrf']);

// 6. Welfare Services: Appointments & Advisories
$router->get('/welfare/appointments', [WelfareServicesController::class, 'appointments'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/appointments', [WelfareServicesController::class, 'appointments'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/advisories', [WelfareServicesController::class, 'advisories'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/advisories', [WelfareServicesController::class, 'advisories'], ['auth', 'permission:welfare.view', 'csrf']);

// 7. Reports & Analytics
$router->get('/welfare/student-welfare-reports', [ReportController::class, 'studentwelfarereports'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/student-welfare-reports', [ReportController::class, 'studentwelfarereports'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/student-concerns', [ReportController::class, 'studentconcerns'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/student-concerns', [ReportController::class, 'studentconcerns'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/service-reports', [ReportController::class, 'servicereports'], ['auth', 'permission:welfare.view']);

$router->get('/welfare/intervention-reports', [ReportController::class, 'interventionreports'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/intervention-reports', [ReportController::class, 'interventionreports'], ['auth', 'permission:welfare.view', 'csrf']);

// 8. Maintenance: Concern Types
$router->get('/welfare/concern-types', [MaintenanceController::class, 'concerntypes'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/concern-types', [MaintenanceController::class, 'concerntypes'], ['auth', 'permission:welfare.view', 'csrf']);

$router->get('/welfare/maintenance', [MaintenanceController::class, 'maintenance'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/maintenance', [MaintenanceController::class, 'maintenance'], ['auth', 'permission:welfare.view', 'csrf']);

// Backward-compatibility alias
$router->get('/guidance/concern-types', [MaintenanceController::class, 'concerntypes'], ['auth', 'permission:welfare.view']);
$router->post('/guidance/concern-types', [MaintenanceController::class, 'concerntypes'], ['auth', 'permission:welfare.view', 'csrf']);
