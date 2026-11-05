<style>
@media print {
    body, .main, #main {
        background: #fff !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .sidebar, .navbar, .pagetitle, .btn, .breadcrumb, footer, .card-header .btn, .card-body .row, .alert, .no-print {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .table-responsive {
        overflow: visible !important;
    }
    table {
        width: 100% !important;
        font-size: 8.5pt !important;
    }
}
</style>

<!-- Discrepancy Management — Procurement Management Information System (SPMS Return Orders) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-exclamation-triangle me-2 text-gold"></i>Discrepancy Management &amp; Supplier Returns
        </h1>
        <p class="text-muted small mb-0">Record and resolve defective or incomplete deliveries flagged during inspection, and issue supplier return slips.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <a href="<?= url('procurement/print/return-slip') ?>" target="_blank" class="btn btn-marsu btn-sm">
            <i class="bi bi-printer me-1"></i>Print Return Slips
        </a>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Discrepancy Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <i class="bi bi-flag-fill fs-2 text-danger mb-2"></i>
            <div class="h3 fw-bold text-danger mb-0"><?= count($rejects ?? []) ?></div>
            <div class="small text-muted">Active Rejection Slips</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <i class="bi bi-arrow-clockwise fs-2 text-warning mb-2"></i>
            <div class="h3 fw-bold text-warning mb-0">Supplier Replacement</div>
            <div class="small text-muted">Warranty Resolution Policy</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <i class="bi bi-shield-check fs-2 text-success mb-2"></i>
            <div class="h3 fw-bold text-success mb-0">Protected</div>
            <div class="small text-muted">Government Quality Standards</div>
        </div>
    </div>
</div>

<!-- Discrepancy Table -->
<div class="card shadow-sm border-0 border-top border-danger border-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-arrow-return-left me-2 text-danger"></i>Supplier Rejection &amp; Return Notice Queue
        </h5>
        <span class="badge bg-danger">Pending Replacement</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PO Reference</th>
                        <th>Supplier</th>
                        <th>Delivered Item</th>
                        <th class="text-center">Rejected Qty</th>
                        <th>Inspection Date</th>
                        <th>Defect / Non-Compliance Reason</th>
                        <th class="text-center">Return Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rejects)): ?>
                        <?php foreach ($rejects as $rej): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($rej['po_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($rej['supplier_name']) ?></td>
                                <td><?= e($rej['item_description']) ?></td>
                                <td class="text-center fw-bold text-danger fs-6"><?= (int)$rej['rejected_qty'] ?></td>
                                <td><?= date("M d, Y", strtotime($rej['inspection_date'])) ?></td>
                                <td><span class="text-danger small"><?= e($rej['remarks'] ?? 'Defective on arrival') ?></span></td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-dark">For Supplier Replacement</span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('procurement/print/return-slip?id=' . (int)$rej['id']) ?>" target="_blank" class="btn btn-sm btn-outline-danger" title="Print Return Slip">
                                        <i class="bi bi-printer me-1"></i>Print Slip
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-check-circle fs-2 text-success d-block mb-2"></i>
                                No item discrepancies recorded. All delivered goods were compliant and accepted.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
