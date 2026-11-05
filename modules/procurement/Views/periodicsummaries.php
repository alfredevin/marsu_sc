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

<!-- Periodic Summaries — Procurement Management Information System (SPMS Inventory & Stock Management) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-box-seam me-2 text-gold"></i>Periodic Summaries &amp; Inventory Stock Ledger
        </h1>
        <p class="text-muted small mb-0">Monitor current stock on hand, track low-stock thresholds, and conduct physical inventory counts and reconciliation.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" onclick="window.print();">
            <i class="bi bi-printer me-1"></i>Print Stock Ledger
        </button>
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
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Inventory KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Inventory Stock Value</div>
                    <div class="h3 fw-bold mb-0 text-success">&#8369;<?= number_format($totalValue ?? 0, 2) ?></div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Low Stock Warning Items</div>
                    <div class="h3 fw-bold mb-0 text-warning"><?= (int)($lowStock ?? 0) ?></div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Managed Stock Lines</div>
                    <div class="h3 fw-bold mb-0 text-primary"><?= count($inventory ?? []) ?></div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-boxes fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Ledger Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-boxes me-2 text-gold"></i>Master Inventory Stock Ledger
        </h5>
        <span class="badge bg-light text-dark border">Real-Time SPMS Warehouse Stock</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Item Description</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th class="text-center">Stock on Hand</th>
                        <th class="text-center">Reorder Threshold</th>
                        <th class="text-end">Unit Cost</th>
                        <th class="text-end">Total Valuation</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3">Reconcile</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($inventory)): ?>
                        <?php foreach ($inventory as $i): ?>
                            <?php
                            $qty = (int)$i['qty_on_hand'];
                            $threshold = (int)$i['reorder_point'];
                            $cost = (float)$i['unit_cost'];
                            $val = $qty * $cost;
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark"><?= e($i['item_name']) ?></td>
                                <td><span class="badge bg-light text-dark border"><?= e($i['category']) ?></span></td>
                                <td><?= e($i['unit']) ?></td>
                                <td class="text-center fw-bold fs-6 <?= $qty <= $threshold ? 'text-danger' : 'text-dark' ?>"><?= $qty ?></td>
                                <td class="text-center text-muted"><?= $threshold ?></td>
                                <td class="text-end">&#8369;<?= number_format($cost, 2) ?></td>
                                <td class="text-end fw-bold text-success">&#8369;<?= number_format($val, 2) ?></td>
                                <td class="text-center">
                                    <?php if ($qty === 0): ?>
                                        <span class="badge bg-danger">Out of Stock</span>
                                    <?php elseif ($qty <= $threshold): ?>
                                        <span class="badge bg-warning text-dark">Low Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">In Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="openReconcileModal(<?= (int)$i['id'] ?>, '<?= e($i['item_name']) ?>', <?= $qty ?>)">
                                        <i class="bi bi-pencil me-1"></i>Audit
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">No inventory stock records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Reconcile Physical Inventory -->
<div class="modal fade" id="modalReconcile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-clipboard-check me-2 text-primary"></i>Conduct Physical Inventory Reconciliation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/periodicsummaries/reconcile') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="inventory_id" id="reconcileInvId">
                <div class="modal-body">
                    <p class="small text-muted mb-2">Adjust recorded stock based on actual warehouse physical count:</p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item</label>
                        <input type="text" class="form-control" id="reconcileItemName" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Actual Count (Physical Audit) <span class="text-danger">*</span></label>
                        <input type="number" min="0" class="form-control" name="actual_count" id="reconcileActualCount" required>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i>Save Actual Count</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openReconcileModal(id, name, qty) {
    document.getElementById('reconcileInvId').value = id;
    document.getElementById('reconcileItemName').value = name;
    document.getElementById('reconcileActualCount').value = qty;
    const modal = new bootstrap.Modal(document.getElementById('modalReconcile'));
    modal.show();
}
</script>
