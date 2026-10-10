<?php
namespace Modules\Procurement\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Procurement Management Information System (PMIS)
 * Student Module 1 — Connected with Campus Operations & University Assets (ast_)
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `prc_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Pending migration fallback
        }

        View::render('procurement/Views/index', [
            'title'       => 'Procurement Management Information System',
            'moduleName'  => 'Procurement Management Information System',
            'slug'        => 'procurement',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Campus Operations' => '',
                'Procurement Management Information System' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `prc_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('procurement'));
        }

        View::render('procurement/Views/index', [
            'title'       => "View Record #{$id}",
            'moduleName'  => 'Procurement Management Information System',
            'slug'        => 'procurement',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Procurement Management Information System' => url('procurement'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('procurement'));
        }

        try {
            Database::insert('prc_records', [
                'title'       => $title,
                'description' => $description,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New procurement entry added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('procurement'));
    }

    // --- Sub-View Action Handlers (Empty / Starter Views for Students to Implement) ---

    public function purchaseRequestInitiation(): void {
        View::render('procurement/Views/purchaserequestinitiation', [
            'title'      => 'Purchase Request Initiation',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Purchase Request Initiation' => '']
        ]);
    }

    public function departmentPrVerification(): void {
        View::render('procurement/Views/departmentprverification', [
            'title'      => 'Department PR Verification',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Department PR Verification' => '']
        ]);
    }

    public function fundAllocation(): void {
        View::render('procurement/Views/fundallocation', [
            'title'      => 'Fund Allocation & Certification',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Fund Allocation & Certification' => '']
        ]);
    }

    public function prTracking(): void {
        View::render('procurement/Views/prtracking', [
            'title'      => 'PR Status Tracking',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'PR Status Tracking' => '']
        ]);
    }

    public function requestForQuotations(): void {
        View::render('procurement/Views/requestforquotations', [
            'title'      => 'Request for Quotations (RFQ)',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Request for Quotations (RFQ)' => '']
        ]);
    }

    public function priceCanvass(): void {
        View::render('procurement/Views/pricecanvass', [
            'title'      => 'Price Canvass Quotations',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Price Canvass Quotations' => '']
        ]);
    }

    public function abstractOfBids(): void {
        View::render('procurement/Views/abstractofbids', [
            'title'      => 'Abstract of Bids & Quotations',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Abstract of Bids & Quotations' => '']
        ]);
    }

    public function bacResolution(): void {
        View::render('procurement/Views/bacresolution', [
            'title'      => 'BAC Award Resolution',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'BAC Award Resolution' => '']
        ]);
    }

    public function purchaseOrderGeneration(): void {
        View::render('procurement/Views/purchaseordergeneration', [
            'title'      => 'Purchase Order Generation',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Purchase Order Generation' => '']
        ]);
    }

    public function noticeToProceed(): void {
        View::render('procurement/Views/noticetoproceed', [
            'title'      => 'Notice to Proceed (NTP)',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Notice to Proceed (NTP)' => '']
        ]);
    }

    public function deliveryTracking(): void {
        View::render('procurement/Views/deliverytracking', [
            'title'      => 'Delivery Schedule Tracking',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Delivery Schedule Tracking' => '']
        ]);
    }

    public function contractMonitoring(): void {
        View::render('procurement/Views/contractmonitoring', [
            'title'      => 'Contract Monitoring',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Contract Monitoring' => '']
        ]);
    }

    public function deliveryInspection(): void {
        View::render('procurement/Views/deliveryinspection', [
            'title'      => 'Delivery Inspection Logging',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Delivery Inspection Logging' => '']
        ]);
    }

    public function specificationCheck(): void {
        View::render('procurement/Views/specificationcheck', [
            'title'      => 'Quality & Specification Check',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Quality & Specification Check' => '']
        ]);
    }

    public function inspectionAcceptanceReport(): void {
        View::render('procurement/Views/inspectionacceptancereport', [
            'title'      => 'Inspection & Acceptance Report (IAR)',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Inspection & Acceptance Report (IAR)' => '']
        ]);
    }

    public function assetTransfer(): void {
        View::render('procurement/Views/assettransfer', [
            'title'      => 'Property Tagging & Asset Transfer',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Property Tagging & Asset Transfer' => '']
        ]);
    }

    public function suppliersRegistry(): void {
        View::render('procurement/Views/suppliersregistry', [
            'title'      => 'Accredited Suppliers Registry',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Accredited Suppliers Registry' => '']
        ]);
    }

    public function philgepsTracking(): void {
        View::render('procurement/Views/philgepstracking', [
            'title'      => 'PhilGEPS Compliance Tracking',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'PhilGEPS Compliance Tracking' => '']
        ]);
    }

    public function supplierEvaluation(): void {
        View::render('procurement/Views/supplierevaluation', [
            'title'      => 'Supplier Performance Evaluation',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Supplier Performance Evaluation' => '']
        ]);
    }

    public function vendorBlacklist(): void {
        View::render('procurement/Views/vendorblacklist', [
            'title'      => 'Vendor Blacklist & Sanctions',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Vendor Blacklist & Sanctions' => '']
        ]);
    }

    public function annualProcurementPlan(): void {
        View::render('procurement/Views/annualprocurementplan', [
            'title'      => 'Annual Procurement Plan (APP)',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Annual Procurement Plan (APP)' => '']
        ]);
    }

    public function bacReports(): void {
        View::render('procurement/Views/bacreports', [
            'title'      => 'BAC Monitoring Reports',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'BAC Monitoring Reports' => '']
        ]);
    }

    public function auditTrail(): void {
        View::render('procurement/Views/audittrail', [
            'title'      => 'Procurement Audit Trail',
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => Auth::user(),
            'crumbs'     => ['Procurement' => url('procurement'), 'Procurement Audit Trail' => '']
        ]);
    }
}
