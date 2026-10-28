<?php
/**
 * Route declarations for module: Academic Analytics & Student Monitoring System
 * Slug: analytics
 */

use Modules\Analytics\Controllers\HomeController;
use Modules\Analytics\Controllers\AdminController;
use Modules\Analytics\Controllers\FacultyController;

// ============================================================================
// 1. Landing Route (Role-Based Smart Router)
// ============================================================================
$router->get('/analytics', [HomeController::class, 'index'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/index', [HomeController::class, 'index'], ['auth', 'permission:analytics.view']);
$router->get('/analytics/show', [HomeController::class, 'show'], ['auth', 'permission:analytics.view']);
$router->post('/analytics/create', [HomeController::class, 'store'], ['auth', 'permission:analytics.create', 'csrf']);

// ============================================================================
// 2. Faculty Workspace (Assigned Classes, Matrix Encoding & Roll-Call)
// ============================================================================
$router->get('/analytics/faculty', [FacultyController::class, 'dashboard'], ['auth', 'permission:analytics.faculty.classes']);
$router->get('/analytics/faculty/classes', [FacultyController::class, 'classes'], ['auth', 'permission:analytics.faculty.classes']);
$router->get('/analytics/faculty/students', [FacultyController::class, 'students'], ['auth', 'permission:analytics.faculty.classes']);
$router->get('/analytics/faculty/students/{id}', [FacultyController::class, 'studentView'], ['auth', 'permission:analytics.faculty.classes']);

// Faculty Class Record Actions (Static paths registered before generic {id})
$router->post('/analytics/faculty/classes/{id}/scheme', [FacultyController::class, 'saveScheme'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/roster/pull-section', [FacultyController::class, 'pullSection'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/roster/add', [FacultyController::class, 'addStudent'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/roster/remove', [FacultyController::class, 'removeStudent'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/scores', [FacultyController::class, 'saveScores'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/post', [FacultyController::class, 'postGrades'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/inc/resolve', [FacultyController::class, 'resolveInc'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/task-exception', [FacultyController::class, 'saveTaskException'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->post('/analytics/faculty/classes/{id}/correction-request', [FacultyController::class, 'requestCorrection'], ['auth', 'permission:analytics.faculty.classes', 'csrf']);
$router->get('/analytics/faculty/classes/{id}', [FacultyController::class, 'classRecord'], ['auth', 'permission:analytics.faculty.classes']);

// Faculty Roll-Call Attendance
$router->get('/analytics/faculty/attendance', [FacultyController::class, 'attendance'], ['auth', 'permission:analytics.faculty.attendance']);
$router->post('/analytics/faculty/attendance/store', [FacultyController::class, 'storeAttendance'], ['auth', 'permission:analytics.faculty.attendance', 'csrf']);

// Faculty Conduct Incident Reporting
$router->get('/analytics/faculty/conduct', [FacultyController::class, 'conduct'], ['auth', 'permission:analytics.faculty.behavior']);
$router->post('/analytics/faculty/conduct/store', [FacultyController::class, 'storeConduct'], ['auth', 'permission:analytics.faculty.behavior', 'csrf']);

// ============================================================================
// 3. Admin Governance & Oversight Actions
// ============================================================================
// Class Offerings (Static create before generic {id})
$router->get('/analytics/admin/classes/create', [AdminController::class, 'createClass'], ['auth', 'permission:analytics.admin.classes']);
$router->post('/analytics/admin/classes/store', [AdminController::class, 'storeClass'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/classes/{id}/assign', [AdminController::class, 'reassignClassFaculty'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/classes/{id}/update', [AdminController::class, 'updateClass'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/classes/{id}/archive', [AdminController::class, 'archiveClass'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/terms/{semesterId}/close', [AdminController::class, 'closeTerm'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->get('/analytics/admin/classes', [AdminController::class, 'classes'], ['auth', 'permission:analytics.admin.classes']);
$router->get('/analytics/admin/classes/{id}', [AdminController::class, 'classRecordView'], ['auth', 'permission:analytics.view']);

// Policy Settings & Grading Templates
$router->get('/analytics/admin/settings', [AdminController::class, 'settings'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/settings/update', [AdminController::class, 'updateSettings'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->get('/analytics/admin/templates/create', [AdminController::class, 'createTemplate'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/templates/store', [AdminController::class, 'storeTemplate'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->get('/analytics/admin/templates/{id}/edit', [AdminController::class, 'editTemplate'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/templates/{id}/update', [AdminController::class, 'updateTemplate'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/templates/{id}/toggle-active', [AdminController::class, 'toggleTemplateActive'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/templates/{id}/set-default', [AdminController::class, 'setTemplateDefault'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->get('/analytics/admin/templates', [AdminController::class, 'templates'], ['auth', 'permission:analytics.admin.settings']);

// Correction Requests & INC Deadlines
$router->get('/analytics/admin/corrections', [AdminController::class, 'correctionRequests'], ['auth', 'permission:analytics.admin.grades']);
$router->post('/analytics/admin/corrections/{id}/approve', [AdminController::class, 'approveCorrection'], ['auth', 'permission:analytics.admin.grades', 'csrf']);
$router->post('/analytics/admin/corrections/{id}/reject', [AdminController::class, 'rejectCorrection'], ['auth', 'permission:analytics.admin.grades', 'csrf']);
$router->post('/analytics/admin/grades/{id}/extend-inc', [AdminController::class, 'extendInc'], ['auth', 'permission:analytics.admin.grades', 'csrf']);

// Attendance Voiding
$router->post('/analytics/admin/attendance/{id}/void', [AdminController::class, 'voidAttendance'], ['auth', 'permission:analytics.admin.attendance', 'csrf']);

// Conduct Case Workflow
$router->post('/analytics/admin/conduct/{id}/status', [AdminController::class, 'updateConductStatus'], ['auth', 'permission:analytics.admin.conduct', 'csrf']);
$router->post('/analytics/admin/conduct/{id}/severity', [AdminController::class, 'updateConductSeverity'], ['auth', 'permission:analytics.admin.conduct', 'csrf']);

// Supplementary Profiles
$router->get('/analytics/admin/profiles/{studentId}', [AdminController::class, 'editStudentProfile'], ['auth', 'permission:analytics.admin.profiles']);
$router->post('/analytics/admin/profiles/{studentId}', [AdminController::class, 'updateStudentProfile'], ['auth', 'permission:analytics.admin.profiles', 'csrf']);

// Audit History
$router->get('/analytics/admin/change-log', [AdminController::class, 'changeLog'], ['auth', 'permission:analytics.view']);

// Dashboard Manual Notes
$router->post('/analytics/admin/notes', [AdminController::class, 'storeNote'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/notes/{id}/archive', [AdminController::class, 'archiveNote'], ['auth', 'permission:analytics.admin.settings', 'csrf']);

// ============================================================================
// 4. Core Oversight Monitoring Views (Group 8A - Modules 1 to 3)
// ============================================================================
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
