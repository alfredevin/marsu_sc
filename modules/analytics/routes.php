<?php
/**
 * Route declarations for module: Academic Analytics & Student Monitoring System
 * Slug: analytics
 *
 * Static paths are registered before {id} paths.
 */

use Modules\Analytics\Controllers\HomeController;
use Modules\Analytics\Controllers\AdminController;
use Modules\Analytics\Controllers\FacultyController;
use Modules\Analytics\Controllers\RegistrarController;
use Modules\Analytics\Controllers\StudentPortalController;
use Modules\Analytics\Controllers\NotificationController;
use Modules\Analytics\Support\DemoAccountsBootstrapper;

// Auto-heal / ensure demo users from modules/analytics/env are ready across all team laptops
DemoAccountsBootstrapper::ensure();

$view   = ['auth', 'permission:analytics.view'];
$fac    = ['auth', 'permission:analytics.faculty.classes'];
$facW   = ['auth', 'permission:analytics.faculty.classes', 'csrf'];
$me     = ['auth', 'permission:analytics.student.portal'];
$regV   = ['auth', 'permission:analytics.registrar.view'];
$regE   = ['auth', 'permission:analytics.registrar.enrollment'];
$regW   = ['auth', 'permission:analytics.registrar.enrollment', 'csrf'];

// ============================================================================
// 1. Landing dispatcher, persona switcher, notifications, attachments
// ============================================================================
$router->get('/analytics', [HomeController::class, 'index'], ['auth']);
$router->get('/analytics/index', [HomeController::class, 'index'], ['auth']);
$router->get('/analytics/overview', [HomeController::class, 'index'], ['auth']);
$router->post('/analytics/create', [HomeController::class, 'store'], ['auth', 'permission:analytics.view', 'csrf']);
$router->post('/analytics/persona', [HomeController::class, 'switchPersona'], ['auth', 'csrf']);

$router->get('/analytics/notifications', [NotificationController::class, 'index'], ['auth']);
$router->post('/analytics/notifications/read-all', [NotificationController::class, 'readAll'], ['auth', 'csrf']);
$router->post('/analytics/notifications/{id}/read', [NotificationController::class, 'read'], ['auth', 'csrf']);

$router->get('/analytics/classes/{id}/posts/{postId}/file', [FacultyController::class, 'downloadAttachment'], ['auth']);

// ============================================================================
// 2. Monitoring & Oversight (read-only, program-scoped)
// ============================================================================
// 1. Student Information Management
$router->get('/analytics/profile', [HomeController::class, 'profile'], $view);
$router->get('/analytics/academichistory', [HomeController::class, 'academichistory'], $view);
$router->get('/analytics/enrollmentrecords', [HomeController::class, 'enrollmentrecords'], $view);
$router->get('/analytics/demographicinfo', [HomeController::class, 'demographicinfo'], $view);

// 2. Academic Monitoring
$router->get('/analytics/gradestracking', [HomeController::class, 'gradestracking'], $view);
$router->get('/analytics/subjectperformance', [HomeController::class, 'subjectperformance'], $view);
$router->get('/analytics/progressreports', [HomeController::class, 'progressreports'], $view);
$router->get('/analytics/failedincompletemonitoring', [HomeController::class, 'failedincompletemonitoring'], $view);

// 3. Attendance and Engagement Monitoring
$router->get('/analytics/attendancerecords', [HomeController::class, 'attendancerecords'], $view);
$router->get('/analytics/participationtracking', [HomeController::class, 'participationtracking'], $view);
$router->get('/analytics/studentengagement', [HomeController::class, 'studentengagement'], $view);
$router->get('/analytics/behaviorrecords', [HomeController::class, 'behaviorrecords'], $view);

// ============================================================================
// 3. Student Portal (own record only)
// ============================================================================
$router->get('/analytics/my', [StudentPortalController::class, 'dashboard'], $me);
$router->get('/analytics/my/classes', [StudentPortalController::class, 'classes'], $me);
$router->get('/analytics/my/classes/{id}', [StudentPortalController::class, 'classView'], $me);
$router->get('/analytics/my/grades/print', [StudentPortalController::class, 'gradesPrint'], $me);
$router->get('/analytics/my/grades', [StudentPortalController::class, 'grades'], $me);
$router->get('/analytics/my/attendance', [StudentPortalController::class, 'attendance'], $me);
$router->get('/analytics/my/deficiencies', [StudentPortalController::class, 'deficiencies'], $me);
$router->get('/analytics/my/profile', [StudentPortalController::class, 'profile'], $me);
$router->get('/analytics/my/conduct', [StudentPortalController::class, 'conduct'], $me);
$router->post('/analytics/my/join', [StudentPortalController::class, 'join'], ['auth', 'permission:analytics.student.portal', 'csrf']);

// ============================================================================
// 4. Registrar Workspace
// ============================================================================
$router->get('/analytics/registrar', [RegistrarController::class, 'dashboard'], $regV);
$router->get('/analytics/registrar/enrollments', [RegistrarController::class, 'enrollments'], $regV);
$router->get('/analytics/registrar/import', [RegistrarController::class, 'importForm'], $regE);
$router->post('/analytics/registrar/import', [RegistrarController::class, 'import'], $regW);
$router->get('/analytics/registrar/enrollments/{id}', [RegistrarController::class, 'show'], $regV);
$router->get('/analytics/registrar/masterlist', [RegistrarController::class, 'masterlist'], $regV);
$router->get('/analytics/registrar/grades', [RegistrarController::class, 'grades'], $regV);
$router->get('/analytics/registrar/grades/{id}', [RegistrarController::class, 'gradeSheet'], $regV);
$router->get('/analytics/registrar/discrepancies', [RegistrarController::class, 'discrepancies'], $regV);
$router->get('/analytics/registrar/export/{type}', [RegistrarController::class, 'export'], $regV);

// ============================================================================
// 5. Faculty Workspace (own classes only)
// ============================================================================
$router->get('/analytics/faculty', [FacultyController::class, 'dashboard'], $fac);
$router->get('/analytics/faculty/classes', [FacultyController::class, 'classes'], $fac);
$router->get('/analytics/faculty/classes/create', [FacultyController::class, 'createClass'], $fac);
$router->post('/analytics/faculty/classes/store', [FacultyController::class, 'storeClass'], $facW);
$router->get('/analytics/faculty/stream', [FacultyController::class, 'streamOverview'], $fac);
$router->get('/analytics/faculty/join-requests', [FacultyController::class, 'joinRequests'], $fac);
$router->get('/analytics/faculty/students', [FacultyController::class, 'students'], $fac);
$router->get('/analytics/faculty/students/{id}', [FacultyController::class, 'studentView'], $fac);

$router->post('/analytics/faculty/classes/{id}/update', [FacultyController::class, 'updateClass'], $facW);
$router->post('/analytics/faculty/classes/{id}/scheme', [FacultyController::class, 'saveScheme'], $facW);
$router->post('/analytics/faculty/gradestracking/create', [FacultyController::class, 'matrixCreateClass'], $facW);
$router->post('/analytics/faculty/classes/{id}/matrix', [FacultyController::class, 'matrixAction'], $facW);
$router->post('/analytics/faculty/classes/{id}/roster/pull-section', [FacultyController::class, 'pullSection'], $facW);
$router->post('/analytics/faculty/classes/{id}/roster/add', [FacultyController::class, 'addStudent'], $facW);
$router->post('/analytics/faculty/classes/{id}/roster/add-enrolled', [FacultyController::class, 'addEnrolled'], $facW);
$router->post('/analytics/faculty/classes/{id}/roster/remove', [FacultyController::class, 'removeStudent'], $facW);
$router->post('/analytics/faculty/classes/{id}/roster/mark', [FacultyController::class, 'setGradeMark'], $facW);
$router->post('/analytics/faculty/classes/{id}/join-requests/{reqId}/approve', [FacultyController::class, 'approveJoin'], $facW);
$router->post('/analytics/faculty/classes/{id}/join-requests/{reqId}/reject', [FacultyController::class, 'rejectJoin'], $facW);
$router->post('/analytics/faculty/classes/{id}/posts', [FacultyController::class, 'storePost'], $facW);
$router->post('/analytics/faculty/classes/{id}/posts/{postId}/delete', [FacultyController::class, 'deletePost'], $facW);
$router->post('/analytics/faculty/classes/{id}/posts/{postId}/pin', [FacultyController::class, 'togglePin'], $facW);
$router->post('/analytics/faculty/classes/{id}/scores-visibility', [FacultyController::class, 'toggleScoresVisibility'], $facW);
$router->post('/analytics/faculty/classes/{id}/scores', [FacultyController::class, 'saveScores'], $facW);
$router->post('/analytics/faculty/classes/{id}/post', [FacultyController::class, 'postGrades'], $facW);
$router->post('/analytics/faculty/classes/{id}/inc/resolve', [FacultyController::class, 'resolveInc'], $facW);
$router->post('/analytics/faculty/classes/{id}/task-exception', [FacultyController::class, 'saveTaskException'], $facW);
$router->post('/analytics/faculty/classes/{id}/correction-request', [FacultyController::class, 'requestCorrection'], $facW);
$router->get('/analytics/faculty/classes/{id}/classroom', [FacultyController::class, 'classroom'], $fac);
$router->get('/analytics/faculty/classes/{id}', [FacultyController::class, 'classRecord'], $fac);

$router->get('/analytics/faculty/attendance', [FacultyController::class, 'attendance'], ['auth', 'permission:analytics.faculty.attendance']);
$router->post('/analytics/faculty/attendance/store', [FacultyController::class, 'storeAttendance'], ['auth', 'permission:analytics.faculty.attendance', 'csrf']);
$router->get('/analytics/faculty/conduct', [FacultyController::class, 'conduct'], ['auth', 'permission:analytics.faculty.behavior']);
$router->post('/analytics/faculty/conduct/store', [FacultyController::class, 'storeConduct'], ['auth', 'permission:analytics.faculty.behavior', 'csrf']);

// ============================================================================
// 6. Governance (admin only; no score or grade write paths)
// ============================================================================
$router->get('/analytics/admin/classes/create', [AdminController::class, 'createClass'], ['auth', 'permission:analytics.admin.classes']);
$router->post('/analytics/admin/classes/store', [AdminController::class, 'storeClass'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/classes/{id}/assign', [AdminController::class, 'reassignClassFaculty'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/classes/{id}/archive', [AdminController::class, 'archiveClass'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->post('/analytics/admin/terms/{semesterId}/close', [AdminController::class, 'closeTerm'], ['auth', 'permission:analytics.admin.classes', 'csrf']);
$router->get('/analytics/admin/classes', [AdminController::class, 'classes'], ['auth', 'permission:analytics.admin.classes']);
$router->get('/analytics/admin/classes/{id}', [AdminController::class, 'classRecordView'], $view);

$router->get('/analytics/admin/program-heads', [AdminController::class, 'programHeads'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/program-heads/store', [AdminController::class, 'storeProgramHead'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/program-heads/{id}/delete', [AdminController::class, 'deleteProgramHead'], ['auth', 'permission:analytics.admin.settings', 'csrf']);

$router->get('/analytics/admin/settings', [AdminController::class, 'settings'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/settings/update', [AdminController::class, 'updateSettings'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->get('/analytics/admin/templates/create', [AdminController::class, 'createTemplate'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/templates/store', [AdminController::class, 'storeTemplate'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->get('/analytics/admin/templates/{id}/edit', [AdminController::class, 'editTemplate'], ['auth', 'permission:analytics.admin.settings']);
$router->post('/analytics/admin/templates/{id}/update', [AdminController::class, 'updateTemplate'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/templates/{id}/toggle-active', [AdminController::class, 'toggleTemplateActive'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/templates/{id}/set-default', [AdminController::class, 'setTemplateDefault'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->get('/analytics/admin/templates', [AdminController::class, 'templates'], ['auth', 'permission:analytics.admin.settings']);

$router->get('/analytics/admin/corrections', [AdminController::class, 'correctionRequests'], ['auth', 'permission:analytics.admin.grades']);
$router->post('/analytics/admin/corrections/{id}/approve', [AdminController::class, 'approveCorrection'], ['auth', 'permission:analytics.admin.grades', 'csrf']);
$router->post('/analytics/admin/corrections/{id}/reject', [AdminController::class, 'rejectCorrection'], ['auth', 'permission:analytics.admin.grades', 'csrf']);
$router->post('/analytics/admin/grades/{id}/extend-inc', [AdminController::class, 'extendInc'], ['auth', 'permission:analytics.admin.grades', 'csrf']);

$router->post('/analytics/admin/attendance/{id}/void', [AdminController::class, 'voidAttendance'], ['auth', 'permission:analytics.admin.attendance', 'csrf']);
$router->post('/analytics/admin/conduct/{id}/status', [AdminController::class, 'updateConductStatus'], ['auth', 'permission:analytics.admin.conduct', 'csrf']);
$router->post('/analytics/admin/conduct/{id}/severity', [AdminController::class, 'updateConductSeverity'], ['auth', 'permission:analytics.admin.conduct', 'csrf']);


$router->get('/analytics/admin/change-log', [AdminController::class, 'changeLog'], $view);
$router->post('/analytics/admin/notes', [AdminController::class, 'storeNote'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
$router->post('/analytics/admin/notes/{id}/archive', [AdminController::class, 'archiveNote'], ['auth', 'permission:analytics.admin.settings', 'csrf']);
