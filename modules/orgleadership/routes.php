<?php
/**
 * Route declarations for module: Student Leadership Accreditation & Officer Evaluation
 * Slug: orgleadership
 */

use Modules\Orgleadership\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/orgleadership', [HomeController::class, 'index'], ['auth', 'permission:orgleadership.view']);
$router->get('/orgleadership/show', [HomeController::class, 'show'], ['auth', 'permission:orgleadership.view']);
$router->post('/orgleadership/create', [HomeController::class, 'store'], ['auth', 'permission:orgleadership.create', 'csrf']);
$router->post('/orgleadership/update', [HomeController::class, 'update'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/delete', [HomeController::class, 'delete'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Organization Management
$router->post('/orgleadership/organizations/store', [HomeController::class, 'storeOrganization'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/organizations/update', [HomeController::class, 'updateOrganization'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/organizations/status', [HomeController::class, 'updateOrganizationStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/organizations/delete', [HomeController::class, 'deleteOrganization'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Membership Records
$router->post('/orgleadership/members/store', [HomeController::class, 'storeMember'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/members/update', [HomeController::class, 'updateMember'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/members/status', [HomeController::class, 'updateMemberStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/members/delete', [HomeController::class, 'deleteMember'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Leadership Positions
$router->post('/orgleadership/positions/store', [HomeController::class, 'storePosition'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/positions/update', [HomeController::class, 'updatePosition'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/positions/delete', [HomeController::class, 'deletePosition'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Term Management
$router->post('/orgleadership/terms/store', [HomeController::class, 'storeTerm'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/terms/update', [HomeController::class, 'updateTerm'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/terms/status', [HomeController::class, 'updateTermStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/terms/delete', [HomeController::class, 'deleteTerm'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Officer Profiles
$router->post('/orgleadership/officers/store', [HomeController::class, 'storeOfficer'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/officers/update', [HomeController::class, 'updateOfficer'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/officers/status', [HomeController::class, 'updateOfficerStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/officers/delete', [HomeController::class, 'deleteOfficer'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Leadership History (Appointments)
$router->post('/orgleadership/appointments/store', [HomeController::class, 'storeAppointment'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/appointments/update', [HomeController::class, 'updateAppointment'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/appointments/delete', [HomeController::class, 'deleteAppointment'], ['auth', 'permission:orgleadership.view', 'csrf']);

// Training and Development Tracking
$router->post('/orgleadership/trainings/store', [HomeController::class, 'storeTraining'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/trainings/update', [HomeController::class, 'updateTraining'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/trainings/status', [HomeController::class, 'updateTrainingStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/trainings/delete', [HomeController::class, 'deleteTraining'], ['auth', 'permission:orgleadership.view', 'csrf']);

$submenuRoutes = [
    'organization-profile' => 'organizationProfile',
    'membership-records' => 'membershipRecords',
    'officer-profiles' => 'officerProfiles',
    'leadership-positions' => 'leadershipPositions',
    'term-management' => 'termManagement',
    'leadership-history' => 'leadershipHistory',
    'training-development' => 'trainingDevelopment',
    'activity-proposals' => 'activityProposals',
    'event-approvals' => 'eventApprovals',
    'activity-calendar' => 'activityCalendar',
    'venue-schedules' => 'venueSchedules',
    'event-documentation' => 'eventDocumentation',
    'attendance-monitoring' => 'attendanceMonitoring',
    'participation-tracking' => 'participationTracking',
    'involvement-history' => 'involvementHistory',
    'engagement-points' => 'engagementPoints',
    'recognition-records' => 'recognitionRecords',
    'announcements' => 'announcements',
    'organization-updates' => 'organizationUpdates',
    'activity-reminders' => 'activityReminders',
    'approval-notifications' => 'approvalNotifications',
    'organization-performance' => 'organizationPerformance',
    'participation-statistics' => 'participationStatistics',
    'leadership-reports' => 'leadershipReports',
    'activity-reports' => 'activityReports',
];

foreach ($submenuRoutes as $path => $action) {
    $router->get('/orgleadership/' . $path, [HomeController::class, $action], ['auth', 'permission:orgleadership.view']);
}

// Backward-compatible spelling for existing links that used "registraion".
$router->get('/orgleadership/organization-registraion', [HomeController::class, 'organizationRegistration'], ['auth', 'permission:orgleadership.view']);
