<?php
/**
 * Route declarations for module: Student Organizations Collection & Financial Management
 * Slug: orgfinance
 */

use Modules\Orgfinance\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/orgfinance/index', [HomeController::class, 'index'], ['auth', 'permission:orgfinance.view']);

$router->get('/orgfinance/accreditationtracking', [HomeController::class, 'accreditationtracking'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/orgprofile', [HomeController::class, 'studentorganizationprofile'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/loanapplication', [HomeController::class, 'loanapplicationsubmission'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/loanaprovalworkflow', [HomeController::class, 'loanaprovalworkflow'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/loanamountandpurposetracking', [HomeController::class, 'loanamountandpurposetracking'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/loanhistory', [HomeController::class, 'loanhistory'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/incomeandexpensemonitoring', [HomeController::class, 'incomeandexpensemonitoring'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/budgetplanning', [HomeController::class, 'budgetplanning'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/recieptsandpaymentrecords', [HomeController::class, 'recieptsandpaymentrecords'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/audittrail', [HomeController::class, 'audittrail'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/orgfinancialreport', [HomeController::class, 'orgfinancialreport'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/loanstatusreport', [HomeController::class, 'loanstatusreport'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/studentorgofficer', [HomeController::class, 'studentorgofficer'], ['auth', 'permission:orgfinance.view']);
$router->get('/orgfinance/studentaffairs', [HomeController::class, 'studentaffairs'], ['auth', 'permission:orgfinance.view']);


$router->get('/orgfinance/show', [HomeController::class, 'show'], ['auth', 'permission:orgfinance.view']);
$router->post('/orgfinance/create', [HomeController::class, 'store'], ['auth', 'permission:orgfinance.create', 'csrf']);
$router->get('/orgfinance/index', [HomeController::class, 'index'], ['auth', 'permission:orgfinance.view']);
