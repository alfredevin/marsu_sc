<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Profile Management
 * Handles Profile Information, Socio-Economic Background, Support Assessment, and Welfare History
 */
class ProfileController
{
    /**
     * Student Profile Information Directory & Detail View
     */
    public function studentprofileinformation(): void
    {
        $user = Auth::user();

        $studentIdParam = trim($_GET['student_id'] ?? '');
        $program        = trim($_GET['program'] ?? '');
        $yearLevel      = trim($_GET['year_level'] ?? '');
        $status         = trim($_GET['status'] ?? '');
        $search         = trim($_GET['q'] ?? '');

        // Dynamic Programs Dropdown
        $programsList = [];
        try {
            $programsList = Database::fetchAll("SELECT DISTINCT `code`, `name` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
        } catch (\Throwable $e) {
            $programsList = [];
        }

        $selectedStudent = null;
        $studentList     = [];

        // 1. DETAIL PROFILE VIEW
        if (!empty($studentIdParam)) {
            try {
                $sql = "SELECT 
                            s.*,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program,
                            COALESCE(p.name, 'N/A') AS program_full,
                            s.student_number AS student_id,
                            COALESCE(sec.name, '-') AS section_name,
                            COALESCE(s.enrollment_status, 'N/A') AS status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE (s.student_number = ? OR s.id = ?)
                        LIMIT 1";

                $selectedStudent = Database::fetchOne($sql, [
                    $studentIdParam,
                    is_numeric($studentIdParam) ? (int)$studentIdParam : 0
                ]);
            } catch (\Throwable $e) {
                $selectedStudent = null;
            }
        }

        // 2. MASTER DIRECTORY ROSTER
        if (!$selectedStudent) {
            try {
                $sql = "SELECT 
                            s.id,
                            s.student_number AS student_id,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            s.email,
                            COALESCE(p.code, 'N/A') AS program,
                            s.year_level,
                            COALESCE(sec.name, '-') AS section_name,
                            COALESCE(s.enrollment_status, 'N/A') AS status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE s.deleted_at IS NULL";

                $params = [];

                if (!empty($search)) {
                    $sql .= " AND (s.student_number LIKE ? 
                               OR s.first_name LIKE ? 
                               OR s.last_name LIKE ? 
                               OR CONCAT(s.first_name, ' ', s.last_name) LIKE ? 
                               OR CONCAT(s.last_name, ', ', s.first_name) LIKE ? 
                               OR s.email LIKE ?)";
                    $qTerm = '%' . $search . '%';
                    $params = array_merge($params, [$qTerm, $qTerm, $qTerm, $qTerm, $qTerm, $qTerm]);
                }

                if (!empty($program)) {
                    $sql .= " AND p.code = ?";
                    $params[] = $program;
                }

                if (!empty($yearLevel)) {
                    $sql .= " AND (s.year_level = ? OR s.year_level LIKE ?)";
                    $cleanYr = (int) preg_replace('/[^0-9]/', '', $yearLevel);
                    $params[] = $cleanYr > 0 ? $cleanYr : $yearLevel;
                    $params[] = '%' . $yearLevel . '%';
                }

                if (!empty($status)) {
                    $sql .= " AND s.enrollment_status = ?";
                    $params[] = $status;
                }

                $sql .= " ORDER BY s.id ASC LIMIT 100";

                $studentList = Database::fetchAll($sql, $params);
            } catch (\Throwable $e) {
                $studentList = [];
            }
        }

        View::render('welfare/Views/student-profile-information', [
            'title'           => !empty($selectedStudent) ? 'Student Profile: ' . htmlspecialchars($selectedStudent['full_name']) : 'Student Profiles',
            'moduleName'      => 'Student Welfare Services & Financial Grants Management',
            'slug'            => 'welfare',
            'user'            => $user,
            'selectedStudent' => $selectedStudent,
            'studentList'     => $studentList,
            'programsList'    => $programsList,
            'program'         => $program,
            'yearLevel'       => $yearLevel,
            'status'          => $status,
            'search'          => $search,
            'crumbs'          => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Profile Management' => '',
                'Student Profile Information' => ''
            ]
        ]);
    }

    /**
     * Socio-Economic Background Records
     */
    public function socioeconomicbackground(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER (No Hard Deletes Allowed)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_socio_economic_profiles', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Socio-economic profile archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive profile: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/socio-economic-background'));
            return;
        }

        // 2. STORE / INSERT NEW SOCIO-ECONOMIC RECORD
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentNo   = trim($_POST['student_number'] ?? $_POST['student_id'] ?? '');
            $fullName    = trim($_POST['full_name'] ?? $_POST['student_name'] ?? '');
            $size        = (int)($_POST['household_size'] ?? 4);
            $category    = trim($_POST['financial_category'] ?? $_POST['category'] ?? 'Low income');
            $incomeSrc   = trim($_POST['primary_income_source'] ?? $_POST['income_source'] ?? '');
            $incomeAmt   = (float)($_POST['monthly_household_income'] ?? 0.00);
            $living      = trim($_POST['living_arrangement'] ?? 'With family');
            $notes       = trim($_POST['notes'] ?? '');

            if ($studentNo !== '' && $fullName !== '') {
                try {
                    Database::insert('wlf_socio_economic_profiles', [
                        'student_number'           => $studentNo,
                        'full_name'                => $fullName,
                        'household_size'           => $size > 0 ? $size : 4,
                        'financial_category'       => in_array($category, ['Low income', 'Moderate income', 'High income'], true) ? $category : 'Low income',
                        'primary_income_source'    => $incomeSrc,
                        'monthly_household_income' => $incomeAmt,
                        'living_arrangement'       => $living,
                        'status'                   => 'For review',
                        'notes'                    => $notes,
                        'created_by'               => Auth::id(),
                        'created_at'               => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New socio-economic background record added successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save record: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student number and full name are required.');
            }

            redirect(url('welfare/socio-economic-background'));
            return;
        }

        // 3. FETCH ALL ACTIVE (NON-DELETED) RECORDS
        $profiles = [];
        try {
            $profiles = Database::fetchAll("SELECT * FROM `wlf_socio_economic_profiles` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $profiles = [];
        }

        View::render('welfare/Views/socio-economic-background', [
            'title'      => 'Socio-economic background',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'profiles'   => $profiles,
            'records'    => $profiles,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Profile Management' => '',
                'Socio-Economic Background' => ''
            ]
        ]);
    }

    /**
     * Support Assessment Management
     */
    public function supportassessment(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_support_assessments', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Support assessment archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive assessment: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/support-assessment'));
            return;
        }

        // 2. STORE / INSERT NEW SUPPORT ASSESSMENT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assessmentId = trim($_POST['assessment_id'] ?? ('SA-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $studentName  = trim($_POST['student_name'] ?? '');
            $need         = trim($_POST['support_need'] ?? '');
            $priority     = trim($_POST['priority'] ?? 'Medium');
            $action       = trim($_POST['recommended_action'] ?? '');
            $date         = trim($_POST['assessment_date'] ?? date('Y-m-d'));
            $status       = trim($_POST['status'] ?? 'Under review');

            if ($studentName !== '' && $need !== '') {
                try {
                    Database::insert('wlf_support_assessments', [
                        'assessment_id'      => $assessmentId,
                        'student_name'       => $studentName,
                        'support_need'       => $need,
                        'priority'           => in_array($priority, ['Low', 'Medium', 'High', 'Urgent'], true) ? $priority : 'Medium',
                        'recommended_action' => $action,
                        'assessment_date'    => !empty($date) ? $date : date('Y-m-d'),
                        'status'             => in_array($status, ['For referral', 'In progress', 'Under review', 'Completed', 'archived'], true) ? $status : 'Under review',
                        'assessed_by'        => Auth::id(),
                        'created_at'         => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Support assessment logged successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save assessment: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student name and support need description are required.');
            }

            redirect(url('welfare/support-assessment'));
            return;
        }

        // 3. FETCH ALL ACTIVE RECORDS
        $assessments = [];
        try {
            $assessments = Database::fetchAll("SELECT * FROM `wlf_support_assessments` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $assessments = [];
        }

        View::render('welfare/Views/support-assessment', [
            'title'       => 'Support Assessment',
            'moduleName'  => 'Student Welfare Services & Financial Grants Management',
            'slug'        => 'welfare',
            'user'        => $user,
            'assessments' => $assessments,
            'records'     => $assessments,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Profile Management' => '',
                'Support Assessment' => ''
            ]
        ]);
    }

    /**
     * Welfare History Records
     */
    public function welfarehistoryrecords(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_welfare_history', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Welfare history record archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive record: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/welfare-history-records'));
            return;
        }

        // 2. STORE / INSERT NEW HISTORY ENTRY
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recordId    = trim($_POST['record_id'] ?? ('WH-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $studentName = trim($_POST['student_name'] ?? '');
            $recordDate  = trim($_POST['record_date'] ?? date('Y-m-d'));
            $recordType  = trim($_POST['record_type'] ?? 'Support assessment');
            $summary     = trim($_POST['summary'] ?? '');
            $status      = trim($_POST['status'] ?? 'Completed');

            if ($studentName !== '' && $summary !== '') {
                try {
                    Database::insert('wlf_welfare_history', [
                        'record_id'    => $recordId,
                        'student_name' => $studentName,
                        'record_date'  => !empty($recordDate) ? $recordDate : date('Y-m-d'),
                        'record_type'  => $recordType,
                        'summary'      => $summary,
                        'status'       => in_array($status, ['Pending', 'Scheduled', 'In progress', 'Completed', 'archived'], true) ? $status : 'Completed',
                        'created_by'   => Auth::id(),
                        'created_at'   => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New welfare history record logged successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save history record: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student name and summary are required.');
            }

            redirect(url('welfare/welfare-history-records'));
            return;
        }

        // 3. FETCH ALL ACTIVE RECORDS
        $history = [];
        try {
            $history = Database::fetchAll("SELECT * FROM `wlf_welfare_history` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $history = [];
        }

        View::render('welfare/Views/welfare-history-records', [
            'title'      => 'Welfare history records',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'history'    => $history,
            'records'    => $history,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Student Profile Management' => '',
                'Welfare History Records' => ''
            ]
        ]);
    }
}

