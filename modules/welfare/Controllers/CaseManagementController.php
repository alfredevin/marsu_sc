<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Concern and Case Management
 * Handles Case Logging, Case Management, Follow-up Monitoring, and Case Resolution Tracking
 */
class CaseManagementController
{
    /**
     * Case Logging / Student Complaints
     */
    public function caselogging(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_cases', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Complaint / case archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive case: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/case-logging'));
            return;
        }

        // 2. STORE / INSERT NEW COMPLAINT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caseNo   = trim($_POST['case_number'] ?? $_POST['complaint_no'] ?? ('CP-' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT)));
            $name     = trim($_POST['complainant_name'] ?? $_POST['student_name'] ?? '');
            $office   = trim($_POST['office_concerned'] ?? 'Guidance Office');
            $date     = trim($_POST['date_filed'] ?? date('Y-m-d'));
            $nature   = trim($_POST['nature'] ?? $_POST['description'] ?? '');
            $status   = trim($_POST['status'] ?? 'Open');

            if ($name !== '' && $nature !== '') {
                try {
                    Database::insert('wlf_cases', [
                        'case_number'      => $caseNo,
                        'student_name'     => $name,
                        'case_type'        => 'Grievance',
                        'office_concerned' => $office,
                        'priority'         => ($status === 'Urgent') ? 'Urgent' : 'Moderate',
                        'subject'          => mb_strimwidth($nature, 0, 100, '...'),
                        'description'      => $nature,
                        'status'           => in_array($status, ['Open', 'Ongoing', 'Urgent', 'Resolved', 'Closed', 'archived'], true) ? $status : 'Open',
                        'date_filed'       => !empty($date) ? $date : date('Y-m-d'),
                        'logged_by'        => Auth::id(),
                        'created_at'       => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New student complaint filed successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not file complaint: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Complainant name and nature of grievance are required.');
            }

            redirect(url('welfare/case-logging'));
            return;
        }

        // 3. FETCH ALL ACTIVE COMPLAINTS
        $cases = [];
        try {
            $cases = Database::fetchAll("SELECT * FROM `wlf_cases` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $cases = [];
        }

        View::render('welfare/Views/case-logging', [
            'title'      => 'Case logging',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'cases'      => $cases,
            'records'    => $cases,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Concern and Case Management' => '',
                'Case Logging' => ''
            ]
        ]);
    }

    /**
     * Formal Case Management Directory
     */
    public function casemanagement(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_cases', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Case file archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive case: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/case-management'));
            return;
        }

        // 2. STORE / INSERT NEW CASE FILE
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caseNo   = trim($_POST['case_number'] ?? $_POST['case_no'] ?? ('CS-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $student  = trim($_POST['student_involved'] ?? $_POST['student_name'] ?? '');
            $caseType = trim($_POST['case_type'] ?? 'Disciplinary');
            $priority = trim($_POST['priority'] ?? 'Moderate');
            $subject  = trim($_POST['subject'] ?? '');
            $status   = trim($_POST['status'] ?? 'Initial Intake');

            if ($student !== '' && $subject !== '') {
                try {
                    Database::insert('wlf_cases', [
                        'case_number'      => $caseNo,
                        'student_name'     => $student,
                        'case_type'        => $caseType,
                        'office_concerned' => 'OSAS Welfare Committee',
                        'priority'         => in_array($priority, ['Low', 'Moderate', 'Urgent'], true) ? $priority : 'Moderate',
                        'subject'          => $subject,
                        'description'      => $subject,
                        'status'           => in_array($status, ['Initial Intake', 'Under Investigation', 'Ongoing', 'Resolved', 'Closed', 'archived'], true) ? $status : 'Initial Intake',
                        'date_filed'       => date('Y-m-d'),
                        'logged_by'        => Auth::id(),
                        'created_at'       => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New formal case created successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not create case: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student name and subject statement are required.');
            }

            redirect(url('welfare/case-management'));
            return;
        }

        // 3. FETCH ALL ACTIVE CASES
        $cases = [];
        try {
            $cases = Database::fetchAll("SELECT * FROM `wlf_cases` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $cases = [];
        }

        View::render('welfare/Views/case-management', [
            'title'      => 'Case management',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'cases'      => $cases,
            'records'    => $cases,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Concern and Case Management' => '',
                'Case Management' => ''
            ]
        ]);
    }

    /**
     * Follow-up Monitoring Management
     */
    public function followupmonitoring(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_case_followups', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Follow-up log archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive follow-up: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/follow-up-monitoring'));
            return;
        }

        // 2. STORE / INSERT NEW FOLLOW-UP
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $followupId = trim($_POST['followup_id'] ?? ('FU-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $caseNo     = trim($_POST['case_number'] ?? $_POST['case_no'] ?? '');
            $student    = trim($_POST['student_name'] ?? '');
            $date       = trim($_POST['followup_date'] ?? $_POST['date'] ?? date('Y-m-d'));
            $personnel  = trim($_POST['assigned_personnel'] ?? $_POST['personnel'] ?? 'Guidance Counselor');
            $notes      = trim($_POST['notes'] ?? '');
            $status     = trim($_POST['status'] ?? 'Scheduled');

            if ($caseNo !== '' && $student !== '' && $notes !== '') {
                try {
                    Database::insert('wlf_case_followups', [
                        'followup_id'        => $followupId,
                        'case_number'        => $caseNo,
                        'student_name'       => $student,
                        'followup_date'      => !empty($date) ? $date : date('Y-m-d'),
                        'assigned_personnel' => $personnel,
                        'notes'              => $notes,
                        'status'             => in_array($status, ['Scheduled', 'Due', 'Completed', 'Cancelled', 'archived'], true) ? $status : 'Scheduled',
                        'created_by'         => Auth::id(),
                        'created_at'         => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Follow-up scheduled successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not schedule follow-up: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Case number, student name, and follow-up notes are required.');
            }

            redirect(url('welfare/follow-up-monitoring'));
            return;
        }

        // 3. FETCH ALL ACTIVE FOLLOW-UPS
        $followups = [];
        try {
            $followups = Database::fetchAll("SELECT * FROM `wlf_case_followups` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $followups = [];
        }

        View::render('welfare/Views/follow-up-monitoring', [
            'title'      => 'Follow-up monitoring',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'followups'  => $followups,
            'records'    => $followups,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Concern and Case Management' => '',
                'Follow-up Monitoring' => ''
            ]
        ]);
    }

    /**
     * Case Resolution Tracking
     */
    public function caseresolutiontracking(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_case_resolutions', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Case resolution archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive resolution: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/case-resolution-tracking'));
            return;
        }

        // 2. STORE / INSERT NEW CASE RESOLUTION
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caseNo     = trim($_POST['case_number'] ?? $_POST['case_no'] ?? '');
            $date       = trim($_POST['resolution_date'] ?? $_POST['date'] ?? date('Y-m-d'));
            $student    = trim($_POST['student_name'] ?? '');
            $category   = trim($_POST['category'] ?? 'Financial assistance');
            $verifiedBy = trim($_POST['verified_by'] ?? 'Guidance Counselor');
            $action     = trim($_POST['action_taken'] ?? $_POST['action'] ?? '');
            $status     = trim($_POST['status'] ?? 'Resolved');

            if ($caseNo !== '' && $student !== '' && $action !== '') {
                try {
                    Database::insert('wlf_case_resolutions', [
                        'case_number'     => $caseNo,
                        'student_name'    => $student,
                        'category'        => $category,
                        'resolution_date' => !empty($date) ? $date : date('Y-m-d'),
                        'verified_by'     => $verifiedBy,
                        'action_taken'    => $action,
                        'status'          => in_array($status, ['Pending Review', 'Action in Progress', 'Resolved', 'Closed', 'archived'], true) ? $status : 'Resolved',
                        'created_by'      => Auth::id(),
                        'created_at'      => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Case resolution recorded successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not record resolution: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Case number, student name, and resolution action taken are required.');
            }

            redirect(url('welfare/case-resolution-tracking'));
            return;
        }

        // 3. FETCH ALL ACTIVE RESOLUTIONS
        $resolutions = [];
        try {
            $resolutions = Database::fetchAll("SELECT * FROM `wlf_case_resolutions` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $resolutions = [];
        }

        View::render('welfare/Views/case-resolution-tracking', [
            'title'       => 'Case resolution tracking',
            'moduleName'  => 'Student Welfare Services & Financial Grants Management',
            'slug'        => 'welfare',
            'user'        => $user,
            'resolutions' => $resolutions,
            'records'     => $resolutions,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Concern and Case Management' => '',
                'Case Resolution Tracking' => ''
            ]
        ]);
    }
}

