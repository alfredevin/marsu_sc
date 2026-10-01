<?php
/**
 * Route declarations for ISHAMIS
 * Integrated Student Housing and Accommodation Management Information System
 * Slug: housing
 */

use Modules\Housing\Controllers\HomeController;
use Modules\Housing\Controllers\BoardingHouseController;
use Modules\Housing\Controllers\RoomController;
use Modules\Housing\Controllers\AccommodationController;
use Modules\Housing\Controllers\InspectionController;

// 1. ISHAMIS Executive Dashboard
$router->get('/housing', [HomeController::class, 'index'], ['auth', 'permission:housing.view']);

// 2. Accredited Boarding Houses Directory
$router->get('/housing/boarding-houses', [BoardingHouseController::class, 'index'], ['auth', 'permission:housing.view']);
$router->get('/housing/boarding-houses/view', [BoardingHouseController::class, 'show'], ['auth', 'permission:housing.view']);
$router->post('/housing/boarding-houses/create', [BoardingHouseController::class, 'store'], ['auth', 'permission:housing.register', 'csrf']);

// 3. Room & Bed Vacancies
$router->get('/housing/rooms', [RoomController::class, 'index'], ['auth', 'permission:housing.view']);
$router->post('/housing/rooms/create', [RoomController::class, 'store'], ['auth', 'permission:housing.register', 'csrf']);

// 4. Student Resident Accommodations & Bookings
$router->get('/housing/accommodations', [AccommodationController::class, 'index'], ['auth', 'permission:housing.view']);
$router->post('/housing/accommodations/book', [AccommodationController::class, 'store'], ['auth', 'permission:housing.book', 'csrf']);

// 5. Safety, Fire & Sanitation Inspections
$router->get('/housing/inspections', [InspectionController::class, 'index'], ['auth', 'permission:housing.view']);
$router->post('/housing/inspections/create', [InspectionController::class, 'store'], ['auth', 'permission:housing.inspect', 'csrf']);
