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
$router->get('/guidance/student_profile', [HomeController::class, 'studentprofile'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/student_history', [HomeController::class, 'studenthistory'], ['auth', 'permission:guidance.view']);

// Appointments
$router->get('/guidance/appointment_requests', [HomeController::class, 'appointmentrequests'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/session_calendar', [HomeController::class, 'sessioncalendar'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/appointment_status', [HomeController::class, 'appointmentstatus'], ['auth', 'permission:guidance.view']);

// Case Management
$router->get('/guidance/student_concerns', [HomeController::class, 'studentconcerns'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/counseling_session', [HomeController::class, 'counselingsession'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/case_progress', [HomeController::class, 'caseprogress'], ['auth', 'permission:guidance.view']);

// Assessment & Evaluation
$router->get('/guidance/guidance_assessment', [HomeController::class, 'guidanceassessment'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/career_assessment', [HomeController::class, 'careerassessment'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/student_evaluation_records', [HomeController::class, 'studentevaluationrecords'], ['auth', 'permission:guidance.view']);

// Intervention Management
$router->get('/guidance/counseling_plans', [HomeController::class, 'counselingplans'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/referrals', [HomeController::class, 'referrals'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/follow_up', [HomeController::class, 'followup'], ['auth', 'permission:guidance.view']);

// Reports
$router->get('/guidance/counseling_service_utilization', [HomeController::class, 'counselingserviceutilization'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/student_concerns_summarry', [HomeController::class, 'studentconcernssummary'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/guidance_program_reports', [HomeController::class, 'guidanceprogramreports'], ['auth', 'permission:guidance.view']);

// Maintenance 
$router->get('/guidance/student_concern_types', [HomeController::class, 'studentconcerntypes'], ['auth', 'permission:guidance.view']);

// User Management
$router->get('/guidance/user_account_management', [HomeController::class, 'useraccountmanagement'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/role_based_access_control', [HomeController::class, 'rolebasedaccesscontrol'], ['auth', 'permission:guidance.view']);
$router->get('/guidance/activity_logs', [HomeController::class, 'activitylogs'], ['auth', 'permission:guidance.view']);
