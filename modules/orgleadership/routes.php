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
$router->post('/orgleadership/organizations/store', [HomeController::class, 'storeOrganization'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/organizations/update', [HomeController::class, 'updateOrganization'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/organizations/status', [HomeController::class, 'updateOrganizationStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/members/store', [HomeController::class, 'storeMember'], ['auth', 'permission:orgleadership.view', 'csrf']);
$router->post('/orgleadership/members/status', [HomeController::class, 'updateMemberStatus'], ['auth', 'permission:orgleadership.view', 'csrf']);

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
