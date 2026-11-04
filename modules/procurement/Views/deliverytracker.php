<!-- Delivery Tracker — Procurement Management Information System (SPMS Receiving Module) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-truck me-2 text-gold"></i>Delivery Tracker & Supplier Receiving
        </h1>
        <p class="text-muted small mb-0">Track incoming shipments, record delivery receipts (DR), and route orders to the Inspection & Acceptance committee.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
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

<!-- Delivery Status Summary -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <i class="bi bi-hourglass-split fs-2 text-warning mb-2"></i>
            <div class="h3 fw-bold text-warning mb-0"><?= count($pendingDeliveries ?? []) ?></div>
            <div class="small text-muted">Awaiting Delivery / Arrival</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <i class="bi bi-truck fs-2 text-primary mb-2"></i>
            <div class="h3 fw-bold text-primary mb-0"><?= count($pendingDeliveries ?? []) ?></div>
            <div class="small text-muted">Active Supplier Purchase Orders</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <i class="bi bi-shield-check fs-2 text-success mb-2"></i>
            <div class="h3 fw-bold text-success mb-0">Ready</div>
            <div class="small text-muted">Inspection Queue Handshake</div>
        </div>
    </div>
</div>

<!-- Pending Delivery Table -->
<div class="card shadow-sm border-0 border-top border-warning border-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-box-seam me-2 text-warning"></i>Incoming Shipments & Pending Receiving
        </h5>
        <span class="badge bg-warning text-dark">Awaiting Delivery Receipt (DR)</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PO Number</th>
                        <th>Supplier Name</th>
                        <th>PO Date</th>
                        <th>Contact / Phone</th>
                        <th class="text-end">Total Contract Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendingDeliveries)): ?>
                        <?php foreach ($pendingDeliveries as $po): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($po['po_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($po['company_name'] ?? 'Accredited Supplier') ?></td>
                                <td><?= date("M d, Y", strtotime($po['po_date'])) ?></td>
                                <td><small class="text-muted"><?= e($po['contact_phone'] ?? '0917-555-8921') ?></small></td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$po['total_amount'], 2) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-dark"><?= e($po['status']) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-success" onclick="openReceiveModal(<?= (int)$po['id'] ?>, '<?= e($po['po_number']) ?>', '<?= e($po['company_name'] ?? '') ?>')">
                                        <i class="bi bi-box-seam me-1"></i>Receive Items
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-truck fs-2 text-success d-block mb-2"></i>
                                No shipments pending delivery. All issued Purchase Orders have been received!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Receive Delivery -->
<div class="modal fade" id="modalReceive" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-success" id="receiveModalTitle">Receive Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/delivery-tracker/receive') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="po_id" id="receivePoId">
                <div class="modal-body">
                    <div class="alert alert-warning py-2 mb-3 small d-flex align-items-center">
                        <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                        <div>Verify delivered physical packages before logging the Delivery Receipt.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Delivery Receipt (DR) No. / Invoice No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="dr_no" placeholder="e.g. DR-2026-9042 / SI-88120" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Date Received <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_received" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Received By (Supply Officer) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="received_by" value="Engr. Kenneth P. Lim (Supply Officer III)" required>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i>Confirm Delivery Receipt</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openReceiveModal(id, poNumber, supplierName) {
    document.getElementById('receivePoId').value = id;
    document.getElementById('receiveModalTitle').innerHTML = '<i class="bi bi-truck me-2"></i>Receive Order: ' + poNumber;
    const modal = new bootstrap.Modal(document.getElementById('modalReceive'));
    modal.show();
}
</script>
