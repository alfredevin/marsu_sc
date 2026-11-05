<?php
/**
 * Route declarations for module: Student Retention & Academic Risk Early Warning System
 * Slug: retention
 */

use Modules\Retention\Controllers\HomeController;
use Modules\Retention\Controllers\AdminController;
use Modules\Retention\Controllers\FacultyController;
use Modules\Retention\Controllers\StudentPortalController;

// ============================================================================
// 1. Landing Route (Role-Based Smart Router)
// ============================================================================
$router->get('/retention', [HomeController::class, 'index'], ['auth']);

// ============================================================================
// 2. Student Self-Service Portal (Read-Only)
// ============================================================================
$router->get('/retention/my', [StudentPortalController::class, 'dashboard'], ['auth', 'permission:retention.student.portal']);
$router->get('/retention/my/profile', [StudentPortalController::class, 'profile'], ['auth', 'permission:retention.student.portal']);
$router->get('/retention/my/grades', [StudentPortalController::class, 'grades'], ['auth', 'permission:retention.student.portal']);
$router->get('/retention/my/attendance', [StudentPortalController::class, 'attendance'], ['auth', 'permission:retention.student.portal']);
$router->get('/retention/my/deficiencies', [StudentPortalController::class, 'deficiencies'], ['auth', 'permission:retention.student.portal']);
$router->get('/retention/my/progress', [StudentPortalController::class, 'progress'], ['auth', 'permission:retention.student.portal']);
$router->get('/retention/my/conduct', [StudentPortalController::class, 'conduct'], ['auth', 'permission:retention.student.portal']);

// ============================================================================
// 3. Faculty Workspace (Assigned Classes, Matrix Encoding & Roll-Call)
// ============================================================================
$router->get('/retention/faculty', [FacultyController::class, 'dashboard'], ['auth', 'permission:retention.faculty.classes']);
$router->get('/retention/faculty/classes', [FacultyController::class, 'classes'], ['auth', 'permission:retention.faculty.classes']);
$router->get('/retention/faculty/students', [FacultyController::class, 'students'], ['auth', 'permission:retention.faculty.classes']);
$router->get('/retention/faculty/students/{id}', [FacultyController::class, 'studentView'], ['auth', 'permission:retention.faculty.classes']);

// Faculty Class Record Actions (Static paths registered before generic {id})
$router->post('/retention/faculty/classes/{id}/scheme', [FacultyController::class, 'saveScheme'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/roster/pull-section', [FacultyController::class, 'pullSection'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/roster/add', [FacultyController::class, 'addStudent'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/roster/remove', [FacultyController::class, 'removeStudent'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/scores', [FacultyController::class, 'saveScores'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/post', [FacultyController::class, 'postGrades'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/inc/resolve', [FacultyController::class, 'resolveInc'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/task-exception', [FacultyController::class, 'saveTaskException'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->post('/retention/faculty/classes/{id}/correction-request', [FacultyController::class, 'requestCorrection'], ['auth', 'permission:retention.faculty.classes', 'csrf']);
$router->get('/retention/faculty/classes/{id}', [FacultyController::class, 'classRecord'], ['auth', 'permission:retention.faculty.classes']);

// Faculty Roll-Call Attendance
$router->get('/retention/faculty/attendance', [FacultyController::class, 'attendance'], ['auth', 'permission:retention.faculty.attendance']);
$router->post('/retention/faculty/attendance/store', [FacultyController::class, 'storeAttendance'], ['auth', 'permission:retention.faculty.attendance', 'csrf']);

// Faculty Conduct Incident Reporting
$router->get('/retention/faculty/conduct', [FacultyController::class, 'conduct'], ['auth', 'permission:retention.faculty.behavior']);
$router->post('/retention/faculty/conduct/store', [FacultyController::class, 'storeConduct'], ['auth', 'permission:retention.faculty.behavior', 'csrf']);

// ============================================================================
// 4. Admin Governance & Oversight Actions (Part E)
// ============================================================================
// Class Offerings (Static create before generic {id})
$router->get('/retention/admin/classes/create', [AdminController::class, 'createClass'], ['auth', 'permission:retention.admin.classes']);
$router->post('/retention/admin/classes/store', [AdminController::class, 'storeClass'], ['auth', 'permission:retention.admin.classes', 'csrf']);
$router->post('/retention/admin/classes/{id}/assign', [AdminController::class, 'reassignClassFaculty'], ['auth', 'permission:retention.admin.classes', 'csrf']);
$router->post('/retention/admin/classes/{id}/update', [AdminController::class, 'updateClass'], ['auth', 'permission:retention.admin.classes', 'csrf']);
$router->post('/retention/admin/classes/{id}/archive', [AdminController::class, 'archiveClass'], ['auth', 'permission:retention.admin.classes', 'csrf']);
$router->post('/retention/admin/terms/{semesterId}/close', [AdminController::class, 'closeTerm'], ['auth', 'permission:retention.admin.classes', 'csrf']);
$router->get('/retention/admin/classes', [AdminController::class, 'classes'], ['auth', 'permission:retention.admin.classes']);
$router->get('/retention/admin/classes/{id}', [AdminController::class, 'classRecordView'], ['auth', 'permission:retention.view']);

// Policy Settings & Grading Templates
$router->get('/retention/admin/settings', [AdminController::class, 'settings'], ['auth', 'permission:retention.admin.settings']);
$router->post('/retention/admin/settings/update', [AdminController::class, 'updateSettings'], ['auth', 'permission:retention.admin.settings', 'csrf']);
$router->get('/retention/admin/templates/create', [AdminController::class, 'createTemplate'], ['auth', 'permission:retention.admin.settings']);
$router->post('/retention/admin/templates/store', [AdminController::class, 'storeTemplate'], ['auth', 'permission:retention.admin.settings', 'csrf']);
$router->get('/retention/admin/templates/{id}/edit', [AdminController::class, 'editTemplate'], ['auth', 'permission:retention.admin.settings']);
$router->post('/retention/admin/templates/{id}/update', [AdminController::class, 'updateTemplate'], ['auth', 'permission:retention.admin.settings', 'csrf']);
$router->post('/retention/admin/templates/{id}/toggle-active', [AdminController::class, 'toggleTemplateActive'], ['auth', 'permission:retention.admin.settings', 'csrf']);
$router->post('/retention/admin/templates/{id}/set-default', [AdminController::class, 'setTemplateDefault'], ['auth', 'permission:retention.admin.settings', 'csrf']);
$router->get('/retention/admin/templates', [AdminController::class, 'templates'], ['auth', 'permission:retention.admin.settings']);

// Correction Requests & INC Deadlines
$router->get('/retention/admin/corrections', [AdminController::class, 'correctionRequests'], ['auth', 'permission:retention.admin.grades']);
$router->post('/retention/admin/corrections/{id}/approve', [AdminController::class, 'approveCorrection'], ['auth', 'permission:retention.admin.grades', 'csrf']);
$router->post('/retention/admin/corrections/{id}/reject', [AdminController::class, 'rejectCorrection'], ['auth', 'permission:retention.admin.grades', 'csrf']);
$router->post('/retention/admin/grades/{id}/extend-inc', [AdminController::class, 'extendInc'], ['auth', 'permission:retention.admin.grades', 'csrf']);

// Attendance Voiding
$router->post('/retention/admin/attendance/{id}/void', [AdminController::class, 'voidAttendance'], ['auth', 'permission:retention.admin.attendance', 'csrf']);

// Conduct Case Workflow
$router->post('/retention/admin/conduct/{id}/status', [AdminController::class, 'updateConductStatus'], ['auth', 'permission:retention.admin.conduct', 'csrf']);
$router->post('/retention/admin/conduct/{id}/severity', [AdminController::class, 'updateConductSeverity'], ['auth', 'permission:retention.admin.conduct', 'csrf']);

// Supplementary Profiles
$router->get('/retention/admin/profiles/{studentId}', [AdminController::class, 'editStudentProfile'], ['auth', 'permission:retention.admin.profiles']);
$router->post('/retention/admin/profiles/{studentId}', [AdminController::class, 'updateStudentProfile'], ['auth', 'permission:retention.admin.profiles', 'csrf']);

// Diagnostic Preview & Audit History
$router->get('/retention/admin/preview-student/{studentId}', [AdminController::class, 'previewStudent'], ['auth', 'permission:retention.view']);
$router->get('/retention/admin/change-log', [AdminController::class, 'changeLog'], ['auth', 'permission:retention.view']);

// Dashboard Manual Notes
$router->post('/retention/admin/notes', [AdminController::class, 'storeNote'], ['auth', 'permission:retention.admin.settings', 'csrf']);
$router->post('/retention/admin/notes/{id}/archive', [AdminController::class, 'archiveNote'], ['auth', 'permission:retention.admin.settings', 'csrf']);

// ============================================================================
// 5. Early Warning System, Intervention & Analytics Reports (Group 8B)
// ============================================================================
$router->get('/retention/show', [HomeController::class, 'show'], ['auth', 'permission:retention.view']);

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

// ============================================================================
// 6. Legacy Redirections to Dedicated Academic Analytics Module (Group 8A)
// ============================================================================
$router->get('/retention/profile', [HomeController::class, 'profile'], ['auth', 'permission:retention.view']);
$router->get('/retention/academichistory', [HomeController::class, 'academichistory'], ['auth', 'permission:retention.view']);
$router->get('/retention/enrollmentrecords', [HomeController::class, 'enrollmentrecords'], ['auth', 'permission:retention.view']);
$router->get('/retention/demographicinfo', [HomeController::class, 'demographicinfo'], ['auth', 'permission:retention.view']);
$router->get('/retention/gradestracking', [HomeController::class, 'gradestracking'], ['auth', 'permission:retention.view']);
$router->get('/retention/subjectperformance', [HomeController::class, 'subjectperformance'], ['auth', 'permission:retention.view']);
$router->get('/retention/progressreports', [HomeController::class, 'progressreports'], ['auth', 'permission:retention.view']);
$router->get('/retention/failedincompletemonitoring', [HomeController::class, 'failedincompletemonitoring'], ['auth', 'permission:retention.view']);
$router->get('/retention/attendancerecords', [HomeController::class, 'attendancerecords'], ['auth', 'permission:retention.view']);
$router->get('/retention/participationtracking', [HomeController::class, 'participationtracking'], ['auth', 'permission:retention.view']);
$router->get('/retention/studentengagement', [HomeController::class, 'studentengagement'], ['auth', 'permission:retention.view']);
$router->get('/retention/behaviorrecords', [HomeController::class, 'behaviorrecords'], ['auth', 'permission:retention.view']);

// Legacy POST endpoint for activity log creation
$router->post('/retention/create', [HomeController::class, 'store'], ['auth', 'permission:retention.admin.settings', 'csrf']);
