<?php
/**
 * Route declarations for module: Student Retention & Academic Risk Early Warning System
 * Slug: retention
 */

use Modules\Retention\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/retention', [HomeController::class, 'index'], ['auth', 'permission:retention.view']);
$router->get('/retention/show', [HomeController::class, 'show'], ['auth', 'permission:retention.view']);
$router->post('/retention/create', [HomeController::class, 'store'], ['auth', 'permission:retention.create', 'csrf']);

// Student Information Management
$router->get('/retention/profile', [HomeController::class, 'profile'], ['auth', 'permission:retention.view']);
$router->get('/retention/academichistory', [HomeController::class, 'academichistory'], ['auth', 'permission:retention.view']);
$router->get('/retention/enrollmentrecords', [HomeController::class, 'enrollmentrecords'], ['auth', 'permission:retention.view']);
$router->get('/retention/demographicinfo', [HomeController::class, 'demographicinfo'], ['auth', 'permission:retention.view']);

// Academic Monitoring
$router->get('/retention/gradestracking', [HomeController::class, 'gradestracking'], ['auth', 'permission:retention.view']);
$router->get('/retention/subjectperformance', [HomeController::class, 'subjectperformance'], ['auth', 'permission:retention.view']);
$router->get('/retention/progressreports', [HomeController::class, 'progressreports'], ['auth', 'permission:retention.view']);
$router->get('/retention/failedincompletemonitoring', [HomeController::class, 'failedincompletemonitoring'], ['auth', 'permission:retention.view']);

// Attendance and Engagement Monitoring
$router->get('/retention/attendancerecords', [HomeController::class, 'attendancerecords'], ['auth', 'permission:retention.view']);
$router->get('/retention/participationtracking', [HomeController::class, 'participationtracking'], ['auth', 'permission:retention.view']);
$router->get('/retention/studentengagement', [HomeController::class, 'studentengagement'], ['auth', 'permission:retention.view']);
$router->get('/retention/behaviorrecords', [HomeController::class, 'behaviorrecords'], ['auth', 'permission:retention.view']);

// Early Warning System
$router->get('/retention/atriskstudents', [HomeController::class, 'atriskstudents'], ['auth', 'permission:retention.view']);
$router->get('/retention/risklevelclassification', [HomeController::class, 'risklevelclassification'], ['auth', 'permission:retention.view']);
$router->get('/retention/systemalerts', [HomeController::class, 'systemalerts'], ['auth', 'permission:retention.view']);
$router->get('/retention/riskoverview', [HomeController::class, 'riskoverview'], ['auth', 'permission:retention.view']);

// Intervention Management
$router->get('/retention/advisingrecords', [HomeController::class, 'advisingrecords'], ['auth', 'permission:retention.view']);
$router->get('/retention/guidancereferrals', [HomeController::class, 'guidancereferrals'], ['auth', 'permission:retention.view']);
$router->get('/retention/academicsupportprograms', [HomeController::class, 'academicsupportprograms'], ['auth', 'permission:retention.view']);
$router->get('/retention/interventionresults', [HomeController::class, 'interventionresults'], ['auth', 'permission:retention.view']);

// Reports and Analytics
$router->get('/retention/retentionratereports', [HomeController::class, 'retentionratereports'], ['auth', 'permission:retention.view']);
$router->get('/retention/atriskstudentreports', [HomeController::class, 'atriskstudentreports'], ['auth', 'permission:retention.view']);
$router->get('/retention/studentsuccessreports', [HomeController::class, 'studentsuccessreports'], ['auth', 'permission:retention.view']);
$router->get('/retention/trendsovertime', [HomeController::class, 'trendsovertime'], ['auth', 'permission:retention.view']);

