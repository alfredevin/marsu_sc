<?php
/**
 * Route declarations for module: Guidance & Counseling Intake Records System
 * Slug: guidance
 */

use Modules\Guidance\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/guidance', [HomeController::class, 'index'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/show', [HomeController::class, 'show'], ['auth', 'permission:guidance.view']);
$router->post('/guidance/create', [HomeController::class, 'store'], ['auth', 'permission:guidance.create', 'csrf']);


// Student Information Management
$router->get('/guidance/student-profile', [HomeController::class, 'studentprofile'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/student-history', [HomeController::class, 'studenthistory'], ['auth', 'permission:guidance.view']);


// Guidance Services 
$router->get('/guidance/appointments', [HomeController::class, 'appointments'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/session-calendar', [HomeController::class, 'sessioncalendar'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/case-monitoring', [HomeController::class, 'casemonitoring'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/counseling', [HomeController::class, 'counseling'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/career-counseling', [HomeController::class, 'careercounseling'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/psychological-support', [HomeController::class, 'psychologicalsupport'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/exit-interviews', [HomeController::class, 'exitinterviews'], ['auth', 'permission:guidance.view']);


// Records Management
$router->get('/guidance/counseling-records', [HomeController::class, 'counselingrecords'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/career-assessments', [HomeController::class, 'careerassessments'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/service-records', [HomeController::class, 'servicerecords'], ['auth', 'permission:guidance.view']);


// Reports
$router->get('/guidance/counseling-utilization', [HomeController::class, 'counselingutilization'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/student-concerns', [HomeController::class, 'studentconcerns'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/career-readiness', [HomeController::class, 'careerreadiness'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/exit-interview-summary', [HomeController::class, 'exitinterviewsummary'], ['auth', 'permission:guidance.view']);


// Maintenance 
$router->get('/guidance/student-concern-types', [HomeController::class, 'studentconcerntypes'], ['auth', 'permission:guidance.view']);


// System Management
$router->get('/guidance/user-accounts', [HomeController::class, 'useraccounts'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/settings', [HomeController::class, 'settings'], ['auth', 'permission:guidance.view']);

