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

// Dashboard Route
$router->get('/guidance/dashboard', [HomeController::class, 'dashboard'], ['auth', 'permission:guidance.view']);

// Student Information Management
$router->get('/guidance/student_directory', [HomeController::class, 'studentdirectory'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/student_history', [HomeController::class, 'studenthistory'], ['auth', 'permission:guidance.view']);

// Appointments
$router->get('/guidance/appointment_lists', [HomeController::class, 'appointmentlists'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/session_calendar', [HomeController::class, 'sessioncalendar'], ['auth', 'permission:guidance.view']);

// Case Management
$router->get('/guidance/concerns', [HomeController::class, 'concerns'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/cases', [HomeController::class, 'cases'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/case_registration', [HomeController::class, 'caseregistration'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/referrals', [HomeController::class, 'referrals'], ['auth', 'permission:guidance.view']);

// Reports & Audits
$router->get('/guidance/analytics_reports', [HomeController::class, 'analyticsreports'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/feedbacks', [HomeController::class, 'feedbacks'], ['auth', 'permission:guidance.view']);

// Maintenance 
$router->get('/guidance/student_concern_types', [HomeController::class, 'studentconcerntypes'], ['auth', 'permission:guidance.view']);

// User Management
$router->get('/guidance/audit_security_logs', [HomeController::class, 'auditsecuritylogs'], ['auth', 'permission:guidance.view']);