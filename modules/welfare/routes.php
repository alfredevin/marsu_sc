<?php

/**
 * Route declarations for module: Student Welfare Services & Financial Grants Management
 * Slug: welfare
 */

use Modules\Welfare\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/welfare', [HomeController::class, 'index'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/show', [HomeController::class, 'show'], ['auth', 'permission:welfare.view']);
$router->post('/welfare/create', [HomeController::class, 'store'], ['auth', 'permission:welfare.create', 'csrf']);


$router->get('/welfare/student-profile-information', [HomeController::class, 'studentprofileinformation'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/support-assessment', [HomeController::class, 'supportassessment'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/socio-economic-background', [HomeController::class, 'socioeconomicbackground'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/welfare-history-records', [HomeController::class, 'welfarehistoryrecords'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/student-concerns ', [HomeController::class, 'studentconcerns'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/case-management', [HomeController::class, 'casemanagement'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/follow-up-monitoring', [HomeController::class, 'followupmonitoring'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/case-resolution-tracking', [HomeController::class, 'caseresolutiontracking'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/counseling-referrals', [HomeController::class, 'counselingreferrals'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/financial-assistance-records', [HomeController::class, 'financialassistancerecords'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/scholarship-grant-monitoring', [HomeController::class, 'scholarshipgrantmonitoring'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/student-support-programs', [HomeController::class, 'studentsupportprograms'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/intervention-plans', [HomeController::class, 'interventionplans'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/assigned-personnel', [HomeController::class, 'assignedpersonnel'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/progress-tracking', [HomeController::class, 'progresstracking'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/outcome-evaluation', [HomeController::class, 'outcomeevaluation'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/appointments', [HomeController::class, 'appointments'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/advisories', [HomeController::class, 'advisories'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/student-welfare-reports', [HomeController::class, 'studentwelfarereports'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/student-concerns', [HomeController::class, 'studentconcerns'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/service-reports', [HomeController::class, 'servicereports'], ['auth', 'permission:welfare.view']);
$router->get('/welfare/intervention-reports', [HomeController::class, 'interventionreports'], ['auth', 'permission:welfare.view']);