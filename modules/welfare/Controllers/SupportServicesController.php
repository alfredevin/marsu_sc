<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Support Services Management
 * Handles Counseling Referrals, Financial Assistance Records, Scholarship/Grant Monitoring, and Support Programs
 */
class SupportServicesController
{
    /**
     * Counseling Referrals Management
     */
    public function counselingreferrals(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_counseling_referrals', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Counseling referral archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive referral: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/counseling-referrals'));
            return;
        }

        // 2. STORE / INSERT NEW COUNSELING REFERRAL
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code    = trim($_POST['referral_code'] ?? ('REF-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $student = trim($_POST['student_name'] ?? '');
            $by      = trim($_POST['referred_by'] ?? 'Faculty Adviser');
            $date    = trim($_POST['referral_date'] ?? date('Y-m-d'));
            $reason  = trim($_POST['concern_reason'] ?? $_POST['reason'] ?? '');
            $status  = trim($_POST['status'] ?? 'Pending');

            if ($student !== '' && $reason !== '') {
                try {
                    Database::insert('wlf_counseling_referrals', [
                        'referral_code'  => $code,
                        'student_name'   => $student,
                        'referred_by'    => $by,
                        'referral_date'  => !empty($date) ? $date : date('Y-m-d'),
                        'concern_reason' => $reason,
                        'status'         => in_array($status, ['Pending', 'Assessed', 'In Counseling', 'Completed', 'archived'], true) ? $status : 'Pending',
                        'created_by'     => Auth::id(),
                        'created_at'     => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Counseling referral logged successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not log referral: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student name and referral reason are required.');
            }

            redirect(url('welfare/counseling-referrals'));
            return;
        }

        // 3. FETCH ALL ACTIVE REFERRALS
        $referrals = [];
        try {
            $referrals = Database::fetchAll("SELECT * FROM `wlf_counseling_referrals` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $referrals = [];
        }

        View::render('welfare/Views/counseling-referrals', [
            'title'      => 'Counseling referrals',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'referrals'  => $referrals,
            'records'    => $referrals,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Support Services Management' => '',
                'Counseling Referrals' => ''
            ]
        ]);
    }

    /**
     * Financial Assistance Records
     */
    public function financialassistancerecords(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_financial_grants', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Financial assistance grant record archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive record: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/financial-assistance-records'));
            return;
        }

        // 2. STORE / INSERT NEW GRANT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $grantId     = trim($_POST['grant_id'] ?? ('GNT-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $date        = trim($_POST['disbursement_date'] ?? $_POST['date'] ?? date('Y-m-d'));
            $student     = trim($_POST['student_name'] ?? '');
            $progType    = trim($_POST['program_type'] ?? 'TDP-TES Grant');
            $amount      = (float)($_POST['amount'] ?? 0.00);
            $officer     = trim($_POST['disbursing_officer'] ?? $_POST['officer'] ?? 'OSAS Aid Officer');
            $status      = trim($_POST['status'] ?? 'Disbursed');

            if ($student !== '' && $amount > 0) {
                try {
                    Database::insert('wlf_financial_grants', [
                        'grant_id'           => $grantId,
                        'student_name'       => $student,
                        'program_type'       => $progType,
                        'amount'             => $amount,
                        'fund_source'        => 'OSAS Welfare Fund',
                        'disbursing_officer' => $officer,
                        'disbursement_date'  => !empty($date) ? $date : date('Y-m-d'),
                        'status'             => in_array($status, ['Disbursed', 'Processing', 'Pending Clearance', 'Under Review', 'archived'], true) ? $status : 'Disbursed',
                        'remarks'            => 'Recorded via Financial Assistance portal.',
                        'created_by'         => Auth::id(),
                        'created_at'         => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Financial grant record saved successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save grant record: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student name and valid amount are required.');
            }

            redirect(url('welfare/financial-assistance-records'));
            return;
        }

        // 3. FETCH ALL ACTIVE GRANTS
        $grants = [];
        try {
            $grants = Database::fetchAll("SELECT * FROM `wlf_financial_grants` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $grants = [];
        }

        View::render('welfare/Views/financial-assistance-records', [
            'title'      => 'Financial assistance records',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'grants'     => $grants,
            'records'    => $grants,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Support Services Management' => '',
                'Financial Assistance Records' => ''
            ]
        ]);
    }

    /**
     * Scholarship and Grant Monitoring
     */
    public function scholarshipgrantmonitoring(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_financial_grants', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Scholarship record archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive scholarship: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/scholarship-grant-monitoring'));
            return;
        }

        // 2. STORE / INSERT NEW SCHOLARSHIP RECORD
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $refNo       = trim($_POST['ref_no'] ?? ('FA-' . date('Y') . '-' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT)));
            $releaseDate = trim($_POST['release_date'] ?? date('Y-m-d'));
            $student     = trim($_POST['student_name'] ?? '');
            $program     = trim($_POST['program'] ?? 'CHED Tulong Dunong');
            $amount      = (float)($_POST['amount'] ?? 0.00);
            $fundSource  = trim($_POST['fund_source'] ?? 'CHED UniFAST');
            $status      = trim($_POST['status'] ?? 'Under Review');

            if ($student !== '' && $amount > 0) {
                try {
                    Database::insert('wlf_financial_grants', [
                        'grant_id'           => $refNo,
                        'student_name'       => $student,
                        'program_type'       => $program,
                        'amount'             => $amount,
                        'fund_source'        => $fundSource,
                        'disbursing_officer' => 'OSAS Scholarship Lead',
                        'disbursement_date'  => !empty($releaseDate) ? $releaseDate : date('Y-m-d'),
                        'status'             => in_array($status, ['Under Review', 'Processing', 'Approved for Release', 'Disbursed', 'archived'], true) ? $status : 'Under Review',
                        'remarks'            => 'Logged via Scholarship Monitoring portal.',
                        'created_by'         => Auth::id(),
                        'created_at'         => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Scholarship grant entry saved successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save scholarship: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Scholar full name and valid amount are required.');
            }

            redirect(url('welfare/scholarship-grant-monitoring'));
            return;
        }

        // 3. FETCH ALL ACTIVE SCHOLARSHIPS
        $grants = [];
        try {
            $grants = Database::fetchAll("SELECT * FROM `wlf_financial_grants` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $grants = [];
        }

        View::render('welfare/Views/scholarship-grant-monitoring', [
            'title'      => 'Scholarship grant monitoring',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'grants'     => $grants,
            'records'    => $grants,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Support Services Management' => '',
                'Scholarship/Grant Monitoring' => ''
            ]
        ]);
    }

    /**
     * Student Support Programs Directory
     */
    public function studentsupportprograms(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_support_programs', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Support program archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive program: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/student-support-programs'));
            return;
        }

        // 2. STORE / INSERT NEW SUPPORT PROGRAM
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code        = trim($_POST['code'] ?? ('SP-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $title       = trim($_POST['title'] ?? '');
            $category    = trim($_POST['category'] ?? 'Financial & Grants');
            $coordinator = trim($_POST['coordinator'] ?? 'OSAS Welfare Office');
            $count       = (int)($_POST['count'] ?? 0);
            $status      = trim($_POST['status'] ?? 'Active Services');
            $scope       = trim($_POST['scope'] ?? '');

            if ($title !== '') {
                try {
                    Database::insert('wlf_support_programs', [
                        'program_code'      => $code,
                        'title'             => $title,
                        'category'          => $category,
                        'coordinator'       => $coordinator,
                        'beneficiary_count' => $count >= 0 ? $count : 0,
                        'scope_objectives'  => $scope,
                        'status'            => in_array($status, ['Accepting Applications', 'Active Services', 'Under Review', 'Inactive', 'archived'], true) ? $status : 'Active Services',
                        'created_by'        => Auth::id(),
                        'created_at'        => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New student support program registered successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not register program: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Program title is required.');
            }

            redirect(url('welfare/student-support-programs'));
            return;
        }

        // 3. FETCH ALL ACTIVE PROGRAMS
        $programs = [];
        try {
            $programs = Database::fetchAll("SELECT * FROM `wlf_support_programs` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $programs = [];
        }

        View::render('welfare/Views/student-support-programs', [
            'title'      => 'Student support programs',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'programs'   => $programs,
            'records'    => $programs,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Support Services Management' => '',
                'Student Support Programs' => ''
            ]
        ]);
    }
}

