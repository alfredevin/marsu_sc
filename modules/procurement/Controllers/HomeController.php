<?php
namespace Modules\Procurement\Controllers;

use Core\View;
use Core\Auth;

/**
 * Controller for Procurement Management Information System (PMIS)
 * Student Module — Connected with Campus Operations
 */
class HomeController {

    private function render(string $view, string $title, string $crumbLabel): void {
        $user = Auth::user();
        View::render('procurement/Views/' . $view, [
            'title'      => $title,
            'moduleName' => 'Procurement Management Information System',
            'slug'       => 'procurement',
            'user'       => $user,
            'crumbs'     => [
                'Procurement Management Information System' => url('procurement'),
                $crumbLabel => ''
            ]
        ]);
    }

    // ─── Dashboard ─────────────────────────────────────────────────────────────
    public function index(): void {
        $user = Auth::user();

        // 1. Pending PPMPs
        $pendingPpmps = 0;
        try {
            $pendingPpmps = (int)\Core\Database::fetchColumn(
                "SELECT COUNT(*) FROM `prc_purchase_requests` WHERE status IN ('Draft', 'Submitted') AND deleted_at IS NULL"
            );
        } catch (\Throwable $e) {
            $pendingPpmps = 0;
        }

        // 2. Incoming Delivery (POs Sent)
        $incomingDelivery = 0;
        try {
            $incomingDelivery = (int)\Core\Database::fetchColumn(
                "SELECT COUNT(*) FROM `prc_purchase_orders` WHERE status = 'Issued' AND deleted_at IS NULL"
            );
        } catch (\Throwable $e) {
            $incomingDelivery = 0;
        }

        // 3. Low Stock Items (Need Reorder)
        $lowStockItems = 0;

        // 4. Total Asset Value (Current Inventory)
        $totalAssetValue = '₱0.0M';
        try {
            $totalVal = (float)\Core\Database::fetchColumn(
                "SELECT COALESCE(SUM(total_amount), 0) FROM `prc_purchase_orders` WHERE deleted_at IS NULL"
            );
            if ($totalVal >= 1000000) {
                $totalAssetValue = '₱' . number_format($totalVal / 1000000, 1) . 'M';
            } elseif ($totalVal > 0) {
                $totalAssetValue = '₱' . number_format($totalVal / 1000, 1) . 'K';
            } else {
                $totalAssetValue = '₱0.0M';
            }
        } catch (\Throwable $e) {
            $totalAssetValue = '₱0.0M';
        }

        // 5. Asset Condition Overview (Missing vs Serviceable)
        $missingCount = 38;
        $serviceableCount = 62;
        try {
            $accepted = (int)\Core\Database::fetchColumn("SELECT COUNT(*) FROM `prc_inspection_acceptance` WHERE inspection_status = 'Inspected & Accepted' AND deleted_at IS NULL");
            $rejected = (int)\Core\Database::fetchColumn("SELECT COUNT(*) FROM `prc_inspection_acceptance` WHERE inspection_status = 'Rejected' AND deleted_at IS NULL");
            if ($accepted > 0 || $rejected > 0) {
                $serviceableCount = $accepted;
                $missingCount = $rejected;
            }
        } catch (\Throwable $e) {}

        // 6. Top 5 Depts with Most Equipment (Issued Items)
        $deptLabels = ['CICS', 'CAS', 'CET', 'CBA', 'CTE'];
        $deptValues = [0, 0, 0, 0, 0];
        try {
            $rows = \Core\Database::fetchAll(
                "SELECT requesting_office, COUNT(*) as cnt FROM `prc_purchase_requests` WHERE deleted_at IS NULL GROUP BY requesting_office ORDER BY cnt DESC LIMIT 5"
            );
            if (!empty($rows)) {
                $deptLabels = [];
                $deptValues = [];
                foreach ($rows as $r) {
                    $label = $r['requesting_office'];
                    if (preg_match('/\((.*?)\)/', $label, $m)) {
                        $label = $m[1];
                    } elseif (strlen($label) > 15) {
                        $label = substr($label, 0, 15) . '...';
                    }
                    $deptLabels[] = $label;
                    $deptValues[] = (int)$r['cnt'];
                }
            }
        } catch (\Throwable $e) {}

        View::render('procurement/Views/index', [
            'title'            => 'Supply and Property Management System',
            'moduleName'       => 'Supply and Property Management System',
            'slug'             => 'procurement',
            'user'             => $user,
            'crumbs'           => [],
            'pendingPpmps'     => $pendingPpmps,
            'incomingDelivery' => $incomingDelivery,
            'lowStockItems'    => $lowStockItems,
            'totalAssetValue'  => $totalAssetValue,
            'missingCount'     => $missingCount,
            'serviceableCount' => $serviceableCount,
            'deptLabels'       => $deptLabels,
            'deptValues'       => $deptValues,
        ]);
    }

    // ─── Purchase Requests & Requisitions ──────────────────────────────────────
    public function prfilling(): void {
        $this->render('prfilling', 'PR Filling', 'PR Filling');
    }

    public function requisitionandissueslip(): void {
        $this->render('requisitionandissueslip', 'Requisition and Issue Slip', 'Requisition and Issue Slip');
    }

    public function approvalworkflow(): void {
        $this->render('approvalworkflow', 'Approval Workflow', 'Approval Workflow');
    }

    public function requisitionstatus(): void {
        $this->render('requisitionstatus', 'Requisition Status', 'Requisition Status');
    }

    // ─── Annual Procurement Planning & Budgeting ───────────────────────────────
    public function projectprocurementmanagementplan(): void {
        $this->render('projectprocurementmanagementplan', 'Project Procurement Management Plan', 'Project Procurement Management Plan');
    }

    public function consolidatedapp(): void {
        $this->render('consolidatedapp', 'Consolidated APP', 'Consolidated APP');
    }

    public function fundsourceverification(): void {
        $this->render('fundsourceverification', 'Fund Source Verification', 'Fund Source Verification');
    }

    // ─── Purchase Orders ───────────────────────────────────────────────────────
    public function pogeneration(): void {
        $this->render('pogeneration', 'PO Generation', 'PO Generation');
    }

    public function deliverytracker(): void {
        $this->render('deliverytracker', 'Delivery Tracker', 'Delivery Tracker');
    }

    // ─── Inspection, Acceptance & Turn-over ────────────────────────────────────
    public function iarprocessing(): void {
        $this->render('iarprocessing', 'IAR Processing', 'IAR Processing');
    }

    public function discrepancymanagement(): void {
        $this->render('discrepancymanagement', 'Discrepancy Management', 'Discrepancy Management');
    }

    public function propertyturnover(): void {
        $this->render('propertyturnover', 'Property Turn-Over', 'Property Turn-Over');
    }

    // ─── Compliance, Auditing & Reports ────────────────────────────────────────
    public function apcpitracker(): void {
        $this->render('apcpitracker', 'APCPI Tracker', 'APCPI Tracker');
    }

    public function periodicsummaries(): void {
        $this->render('periodicsummaries', 'Periodic Summaries', 'Periodic Summaries');
    }

    public function coaaudittrail(): void {
        $this->render('coaaudittrail', 'COA Audit Trail', 'COA Audit Trail');
    }
}
