<?php
/**
 * Route declarations for module: Academic Analytics & Student Monitoring System
 * Slug: analytics
 */

use Modules\Analytics\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/analytics', [HomeController::class, 'index'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/index', [HomeController::class, 'index'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/show', [HomeController::class, 'show'], ['auth', 'permission:analytics.view']);
$router->post('/analytics/create', [HomeController::class, 'store'], ['auth', 'permission:analytics.create', 'csrf']);

// 1. Student Information Management
$router->get('/analytics/profile', [HomeController::class, 'profile'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/academichistory', [HomeController::class, 'academichistory'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/enrollmentrecords', [HomeController::class, 'enrollmentrecords'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/demographicinfo', [HomeController::class, 'demographicinfo'], ['auth', 'permission:analytics.view']);

// 2. Academic Monitoring
$router->get('/analytics/gradestracking', [HomeController::class, 'gradestracking'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/subjectperformance', [HomeController::class, 'subjectperformance'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/progressreports', [HomeController::class, 'progressreports'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/failedincompletemonitoring', [HomeController::class, 'failedincompletemonitoring'], ['auth', 'permission:analytics.view']);

// 3. Attendance and Engagement Monitoring
$router->get('/analytics/attendancerecords', [HomeController::class, 'attendancerecords'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/participationtracking', [HomeController::class, 'participationtracking'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/studentengagement', [HomeController::class, 'studentengagement'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/behaviorrecords', [HomeController::class, 'behaviorrecords'], ['auth', 'permission:analytics.view']);
