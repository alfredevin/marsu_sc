<?php

/**
 * Route declarations for module: Smart Student Health Monitoring and Clinic Management System
 * Slug: health
 */

use Modules\Health\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/health', [HomeController::class, 'index'], ['auth', 'permission:health.view']);
$router->get('/health/index', [HomeController::class, 'index'], ['auth', 'permission:health.view']);
$router->get('/health/index.php', [HomeController::class, 'index'], ['auth', 'permission:health.view']);
$router->get('/health/show', [HomeController::class, 'show'], ['auth', 'permission:health.view']);
$router->post('/health/create', [HomeController::class, 'store'], ['auth', 'permission:health.create', 'csrf']);

// 1. Student Health Profile
$router->get('/health/patient-registration', [HomeController::class, 'patientRegistration'], ['auth', 'permission:health.view']);
$router->get('/health/student-info-hub', [HomeController::class, 'studentInfoHub'], ['auth', 'permission:health.view']);
$router->get('/health/health-statistics', [HomeController::class, 'healthStatistics'], ['auth', 'permission:health.view']);

// 2. Consultation Mgmt
$router->get('/health/medical-assessment', [HomeController::class, 'medicalAssessment'], ['auth', 'permission:health.view']);
$router->get('/health/treatment-records', [HomeController::class, 'treatmentRecords'], ['auth', 'permission:health.view']);

// 3. Appointment & Schedule
$router->get('/health/consultation-requests', [HomeController::class, 'consultationRequests'], ['auth', 'permission:health.view']);
$router->get('/health/appointments-list', [HomeController::class, 'appointmentsList'], ['auth', 'permission:health.view']);
$router->get('/health/queue-management', [HomeController::class, 'queueManagement'], ['auth', 'permission:health.view']);
$router->get('/health/reminders', [HomeController::class, 'reminders'], ['auth', 'permission:health.view']);

// 4. Health Monitoring
$router->get('/health/vital-signs', [HomeController::class, 'vitalSigns'], ['auth', 'permission:health.view']);
$router->get('/health/screening-results', [HomeController::class, 'screeningResults'], ['auth', 'permission:health.view']);
$router->get('/health/immunization-tracking', [HomeController::class, 'immunizationTracking'], ['auth', 'permission:health.view']);
$router->get('/health/health-risk-monitoring', [HomeController::class, 'healthRiskMonitoring'], ['auth', 'permission:health.view']);

// 5. Reports & Analytics
$router->get('/health/common-health-concerns', [HomeController::class, 'commonHealthConcerns'], ['auth', 'permission:health.view']);
$router->get('/health/clinic-utilization', [HomeController::class, 'clinicUtilization'], ['auth', 'permission:health.view']);
$router->get('/health/program-evaluation', [HomeController::class, 'programEvaluation'], ['auth', 'permission:health.view']);

// 6. Health Services Mgmt
$router->get('/health/inventory-supplies', [HomeController::class, 'inventorySupplies'], ['auth', 'permission:health.view']);
$router->get('/health/medicine-dispensing', [HomeController::class, 'medicineDispensing'], ['auth', 'permission:health.view']);
$router->get('/health/staff-schedule', [HomeController::class, 'staffSchedule'], ['auth', 'permission:health.view']);
