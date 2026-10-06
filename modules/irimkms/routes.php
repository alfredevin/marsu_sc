<?php
/**
 * Route declarations for module: Institutional Repository & Knowledge Management (IRIMKMS)
 * Slug: irimkms
 */

use Modules\Irimkms\Controllers\HomeController;

// Module Dashboard & Records
$router->get('/irimkms/completionreporting', [HomeController::class,'completionreporting'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/evaluationforms', [HomeController::class, 'evaluationforms'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/filemanagement', [HomeController::class, 'filemanagement'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/fundingandresources', [HomeController::class, 'fundingandresources'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/performanceindicators', [HomeController::class, 'performanceindicators'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/projectmilestone', [HomeController::class, 'projectmilestone'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/proposalsandapprovals', [HomeController::class, 'proposalsandapprovals'], ['auth', 'permission:irimkms.view', 'csrf']);
$router->get('/irimkms/researchprofiles', [HomeController::class, 'researchprofiles'], ['auth', 'permission:irimkms.view', 'csrf']);
$router->get('/irimkms/researchprojects', [HomeController::class, 'researchprojects'], ['auth', 'permission:irimkms.view', 'csrf']);
$router->get('/irimkms/researchstorage', [HomeController::class, 'researchstorage'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/searchableresearch', [HomeController::class, 'searchableresearch'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/knowledgemanagement', [HomeController::class, 'knowledgemanagement'], ['auth', 'permission:irimkms.view']);
$router->get('/irimkms/implementationprogress', [HomeController::class, 'implementationprogress'], ['auth', 'permission:irimkms.view']);
