<?php
/**
 * MarSU Centralized ERP - Single Front Controller
 * College of Information and Computing Sciences, Marinduque State University
 */

declare(strict_types=1);

// Error reporting for local development
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set('Asia/Manila');

// 1. Bootstrap Autoloader & Helpers
require_once dirname(__DIR__) . '/core/Autoloader.php';
require_once dirname(__DIR__) . '/core/helpers.php';

use Core\Router;
use Core\Database;
use Core\Session;
use Core\Auth;
use Core\ModuleLoader;

// 2. Load Environment Variables
Database::loadEnv(dirname(__DIR__) . '/.env');

// 3. Initialize Secure Session
Session::start();

// 4. Initialize Router
$router = new Router();

// ============================================================================
// CORE ROUTE REGISTRATIONS
// ============================================================================

// Gateway Root
$router->get('/', function () {
    if (Auth::check()) {
        redirect(url('dashboard'));
    } else {
        redirect(url('login'));
    }
});

// Authentication Routes
$router->get('/login', [\App\Controllers\AuthController::class, 'showLogin'], ['guest']);
$router->post('/login', [\App\Controllers\AuthController::class, 'login'], ['guest', 'csrf']);
$router->get('/logout', [\App\Controllers\AuthController::class, 'logout'], ['auth']);
$router->post('/logout', [\App\Controllers\AuthController::class, 'logout'], ['auth', 'csrf']);
$router->get('/forgot-password', [\App\Controllers\AuthController::class, 'showForgotPassword'], ['guest']);
$router->post('/forgot-password', [\App\Controllers\AuthController::class, 'sendResetLink'], ['guest', 'csrf']);
$router->get('/reset-password', [\App\Controllers\AuthController::class, 'showResetPassword'], ['guest']);
$router->post('/reset-password', [\App\Controllers\AuthController::class, 'resetPassword'], ['guest', 'csrf']);

// User Profile
$router->get('/profile', [\App\Controllers\AuthController::class, 'profile'], ['auth']);
$router->post('/profile', [\App\Controllers\AuthController::class, 'updateProfile'], ['auth', 'csrf']);
$router->post('/profile/password', [\App\Controllers\AuthController::class, 'changePassword'], ['auth', 'csrf']);

// Executive Dashboard
$router->get('/dashboard', [\App\Controllers\DashboardController::class, 'index'], ['auth', 'permission:core.dashboard.view']);

// Student Portal & Mobile App Interface
$router->get('/student-portal', [\App\Controllers\DashboardController::class, 'studentPortal'], ['auth']);

// Roles & RBAC Matrix
$router->get('/roles', [\App\Controllers\RoleController::class, 'index'], ['auth', 'permission:core.roles.view']);
$router->get('/roles/matrix', [\App\Controllers\RoleController::class, 'matrix'], ['auth', 'permission:core.roles.view']);
$router->post('/roles/create', [\App\Controllers\RoleController::class, 'store'], ['auth', 'permission:core.roles.create', 'csrf']);
$router->post('/roles/sync', [\App\Controllers\RoleController::class, 'sync'], ['auth', 'permission:core.roles.edit', 'csrf']);
$router->post('/roles/delete', [\App\Controllers\RoleController::class, 'delete'], ['auth', 'permission:core.roles.delete', 'csrf']);

// User Accounts Directory
$router->get('/users', [\App\Controllers\UserController::class, 'index'], ['auth', 'permission:core.users.view']);
$router->post('/users/create', [\App\Controllers\UserController::class, 'store'], ['auth', 'permission:core.users.create', 'csrf']);
$router->post('/users/update', [\App\Controllers\UserController::class, 'update'], ['auth', 'permission:core.users.edit', 'csrf']);
$router->post('/users/delete', [\App\Controllers\UserController::class, 'delete'], ['auth', 'permission:core.users.delete', 'csrf']);

// Students Master Registry
$router->get('/students', [\App\Controllers\StudentController::class, 'index'], ['auth', 'permission:core.students.view']);
$router->post('/students/create', [\App\Controllers\StudentController::class, 'store'], ['auth', 'permission:core.students.create', 'csrf']);
$router->post('/students/update', [\App\Controllers\StudentController::class, 'update'], ['auth', 'permission:core.students.edit', 'csrf']);
$router->post('/students/delete', [\App\Controllers\StudentController::class, 'delete'], ['auth', 'permission:core.students.delete', 'csrf']);
$router->get('/students/import', [\App\Controllers\StudentController::class, 'showImport'], ['auth', 'permission:core.students.import']);
$router->post('/students/import', [\App\Controllers\StudentController::class, 'processImport'], ['auth', 'permission:core.students.import', 'csrf']);
$router->get('/students/template', [\App\Controllers\StudentController::class, 'downloadTemplate'], ['auth', 'permission:core.students.import']);
$router->get('/students/export', [\App\Controllers\StudentController::class, 'exportCsv'], ['auth', 'permission:core.students.export']);

// Faculty & Staff Employees Directory
$router->get('/employees', [\App\Controllers\EmployeeController::class, 'index'], ['auth', 'permission:core.employees.view']);
$router->post('/employees/create', [\App\Controllers\EmployeeController::class, 'store'], ['auth', 'permission:core.employees.create', 'csrf']);
$router->post('/employees/update', [\App\Controllers\EmployeeController::class, 'update'], ['auth', 'permission:core.employees.edit', 'csrf']);
$router->post('/employees/delete', [\App\Controllers\EmployeeController::class, 'delete'], ['auth', 'permission:core.employees.delete', 'csrf']);
$router->get('/employees/import', [\App\Controllers\EmployeeController::class, 'showImport'], ['auth', 'permission:core.employees.import']);
$router->post('/employees/import', [\App\Controllers\EmployeeController::class, 'processImport'], ['auth', 'permission:core.employees.import', 'csrf']);
$router->get('/employees/template', [\App\Controllers\EmployeeController::class, 'downloadTemplate'], ['auth', 'permission:core.employees.import']);
$router->get('/employees/export', [\App\Controllers\EmployeeController::class, 'exportCsv'], ['auth', 'permission:core.employees.export']);

// Colleges & Academic Departments
$router->get('/departments', [\App\Controllers\DepartmentController::class, 'index'], ['auth', 'permission:core.departments.view']);
$router->post('/departments/create', [\App\Controllers\DepartmentController::class, 'store'], ['auth', 'permission:core.departments.create', 'csrf']);
$router->post('/departments/update', [\App\Controllers\DepartmentController::class, 'update'], ['auth', 'permission:core.departments.edit', 'csrf']);
$router->post('/departments/delete', [\App\Controllers\DepartmentController::class, 'delete'], ['auth', 'permission:core.departments.delete', 'csrf']);

// Academic Degree Programs
$router->get('/programs', [\App\Controllers\ProgramController::class, 'index'], ['auth', 'permission:core.programs.view']);
$router->post('/programs/create', [\App\Controllers\ProgramController::class, 'store'], ['auth', 'permission:core.programs.create', 'csrf']);
$router->post('/programs/update', [\App\Controllers\ProgramController::class, 'update'], ['auth', 'permission:core.programs.edit', 'csrf']);
$router->post('/programs/delete', [\App\Controllers\ProgramController::class, 'delete'], ['auth', 'permission:core.programs.delete', 'csrf']);

// Curriculum Course Subjects
$router->get('/subjects', [\App\Controllers\SubjectController::class, 'index'], ['auth', 'permission:core.subjects.view']);
$router->post('/subjects/create', [\App\Controllers\SubjectController::class, 'store'], ['auth', 'permission:core.subjects.create', 'csrf']);
$router->post('/subjects/update', [\App\Controllers\SubjectController::class, 'update'], ['auth', 'permission:core.subjects.edit', 'csrf']);
$router->post('/subjects/delete', [\App\Controllers\SubjectController::class, 'delete'], ['auth', 'permission:core.subjects.delete', 'csrf']);
$router->get('/subjects/import', [\App\Controllers\SubjectController::class, 'showImport'], ['auth', 'permission:core.subjects.import']);
$router->post('/subjects/import', [\App\Controllers\SubjectController::class, 'processImport'], ['auth', 'permission:core.subjects.import', 'csrf']);
$router->get('/subjects/template', [\App\Controllers\SubjectController::class, 'downloadTemplate'], ['auth', 'permission:core.subjects.import']);
$router->get('/subjects/export', [\App\Controllers\SubjectController::class, 'exportCsv'], ['auth', 'permission:core.subjects.export']);

// Academic Calendar & Class Sections
$router->get('/academics', [\App\Controllers\AcademicController::class, 'index'], ['auth', 'permission:core.academics.view']);
$router->post('/academics/create-year', [\App\Controllers\AcademicController::class, 'storeYear'], ['auth', 'permission:core.academics.manage', 'csrf']);
$router->post('/academics/activate-year', [\App\Controllers\AcademicController::class, 'activateYear'], ['auth', 'permission:core.academics.manage', 'csrf']);
$router->post('/academics/activate-semester', [\App\Controllers\AcademicController::class, 'activateSemester'], ['auth', 'permission:core.academics.manage', 'csrf']);
$router->post('/academics/create-section', [\App\Controllers\AcademicController::class, 'storeSection'], ['auth', 'permission:core.academics.manage', 'csrf']);
$router->post('/academics/delete-section', [\App\Controllers\AcademicController::class, 'deleteSection'], ['auth', 'permission:core.academics.manage', 'csrf']);

// Campus Facilities (Buildings & Rooms)
$router->get('/facilities', [\App\Controllers\FacilityController::class, 'index'], ['auth', 'permission:core.facilities.view']);
$router->post('/facilities/create-building', [\App\Controllers\FacilityController::class, 'storeBuilding'], ['auth', 'permission:core.facilities.manage', 'csrf']);
$router->post('/facilities/create-room', [\App\Controllers\FacilityController::class, 'storeRoom'], ['auth', 'permission:core.facilities.manage', 'csrf']);
$router->post('/facilities/delete-room', [\App\Controllers\FacilityController::class, 'deleteRoom'], ['auth', 'permission:core.facilities.manage', 'csrf']);

// Student Organizations Registry
$router->get('/organizations', [\App\Controllers\OrganizationController::class, 'index'], ['auth', 'permission:core.organizations.view']);
$router->post('/organizations/create', [\App\Controllers\OrganizationController::class, 'store'], ['auth', 'permission:core.organizations.manage', 'csrf']);
$router->post('/organizations/delete', [\App\Controllers\OrganizationController::class, 'delete'], ['auth', 'permission:core.organizations.manage', 'csrf']);

// System Audit Logs
$router->get('/audit', [\App\Controllers\AuditController::class, 'index'], ['auth', 'permission:core.audit.view']);

// Institutional System Settings
$router->get('/settings', [\App\Controllers\SettingController::class, 'index'], ['auth', 'permission:core.settings.view']);
$router->post('/settings/update', [\App\Controllers\SettingController::class, 'update'], ['auth', 'permission:core.settings.edit', 'csrf']);

// Module Manager
$router->get('/modules', [\App\Controllers\ModuleManagerController::class, 'index'], ['auth', 'permission:core.modules.view']);
$router->post('/modules/toggle', [\App\Controllers\ModuleManagerController::class, 'toggle'], ['auth', 'permission:core.modules.manage', 'csrf']);

// UI Kit Styleguide
$router->get('/ui-kit', [\App\Controllers\UiKitController::class, 'index'], ['auth']);

// ============================================================================
// DYNAMIC STUDENT GROUP MODULE REGISTRATIONS
// ============================================================================
ModuleLoader::registerRoutes($router);

// Dispatch incoming HTTP Request
$router->dispatch();
