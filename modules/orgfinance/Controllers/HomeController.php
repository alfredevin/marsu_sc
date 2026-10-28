<?php
namespace Modules\Orgfinance\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Organizations Collection & Financial Management
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `orf_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('orgfinance/Views/index', [
            'title'       => 'Student Organizations Collection & Financial Management',
            'moduleName'  => 'Student Organizations Collection & Financial Management',
            'slug'        => 'orgfinance',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Organizations Collection & Financial Management' => ''
            ]
        ]);
    }



     public function accreditationtracking(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/accreditationtracking', [
            'title'       => 'Accreditation Tracking',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Organization'  => '',
                'AccreditationTracking'  => ''
            ]
        ]);
    }

    public function studentorganizationprofile(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/studentorganizationprofile', [
            'title'       => 'Student Organization Profile',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Organization'  => '',
                'Student Organization Profile'  => ''
            ]
        ]);
    }

    public function loanapplicationsubmission(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/loanapplicationsubmission', [
            'title'       => 'Loan Application Submission',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Loan Management'  => '',
                'Loan Application Submission'  => ''
            ]
        ]);
    }

    public function loanaprovalworkflow(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/loanaprovalworkflow', [
            'title'       => 'Loan Approval Workflow',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Loan Management'  => '',
                'Loan Approval Workflow'  => ''
            ]
        ]);
    }
    public function loanamountandpurposetracking(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/loanamountandpurposetracking', [
            'title'       => 'Loan Amount and Purpose Tracking',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Loan Management'  => '',
                'Loan Amount and Purpose Tracking'  => ''
            ]
        ]);
    }

    public function loanhistory(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/loanhistory', [
            'title'       => 'Loan History',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Loan Management'  => '',
                'Loan History'  => ''
            ]
        ]);
    }

    public function incomeandexpensemonitoring(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/incomeandexpensemonitoring', [
            'title'       => 'Income and Expense Monitoring',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Fund Management'  => '',
                'Income and Expense Monitoring'  => ''
            ]
        ]);
    }

    public function budgetplanning(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/budgetplanning', [
            'title'       => 'Budget Planning',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Fund Management'  => '',
                'Budget Planning'  => ''
            ]
        ]);
    }

    public function recieptsandpaymentrecords(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/recieptsandpaymentrecords', [
            'title'       => 'Reciepts and Payment Records',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Financial Transaction'  => '',
                'Reciepts and Payment Records'  => ''
            ]
        ]);
    }

    public function audittrail(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/audittrail', [
            'title'       => 'Audit Trail',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Financial Transaction'  => '',
                'Audit Trail'  => ''
            ]
        ]);
    }

    public function orgfinancialreport(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/orgfinancialreport', [
            'title'       => 'Organization Financial Report',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Reports and Analytics'  => '',
                'Organization Financial Report'  => ''
            ]
        ]);
    }

    public function loanstatusreport(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/loanstatusreport', [
            'title'       => 'Loan Status Report',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'Reports and Analytics'  => '',
                'Loan Status Report'  => ''
            ]
        ]);
    }

    public function studentorgofficer(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/studentorgofficer', [
            'title'       => 'Student Organization Officers',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'User Access'  => '',
                'Student Organization Officers'  => ''
            ]
        ]);
    }

    public function studentaffairs(): void {
        $user = Auth::user();
        View::render('orgfinance/Views/studentaffairs', [
            'title'       => 'Student Affairs / Admin',
            'moduleName'  => 'Financial Management System',
            'slug'        => 'orgfinance',
            'user'        => $user,
            'crumbs'      => [
                'Financial Management System' => url('orgfinance'),
                'User Access'  => '',
                'Student Affairs / Admin'  => ''
            ]
        ]);
    }
}
