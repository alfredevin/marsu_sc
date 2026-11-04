<!-- IAR Processing — Procurement Management Information System (SPMS Inspection & Acceptance) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clipboard2-check me-2 text-gold"></i>IAR Processing (Inspection &amp; Acceptance Report)
        </h1>
        <p class="text-muted small mb-0">Inspect deliveries against PO specifications, record accepted quantities directly into Inventory, and flag defective items.</p>
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

<!-- IAR Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Ready for Inspection</div>
                    <div class="h3 fw-bold mb-0 text-warning"><?= count($forInspection ?? []) ?></div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-search fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Completed IAR Reports</div>
                    <div class="h3 fw-bold mb-0 text-success"><?= count($completedIars ?? []) ?></div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-check2-all fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Inventory Sync Status</div>
                    <div class="h3 fw-bold mb-0 text-primary">Active</div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-arrow-repeat fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 1: Orders Ready for Inspection -->
<div class="card shadow-sm border-0 mb-4 border-top border-primary border-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-hourglass-top me-2 text-primary"></i>Deliveries Awaiting Inspection & Acceptance
        </h5>
        <span class="badge bg-primary">Inspection Committee Queue</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PO Number</th>
                        <th>Supplier</th>
                        <th>Delivery Receipt No.</th>
                        <th>Date Received</th>
                        <th>Received By</th>
                        <th class="text-end">Contract Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($forInspection)): ?>
                        <?php foreach ($forInspection as $po): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($po['po_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($po['company_name'] ?? 'Accredited Supplier') ?></td>
                                <td><span class="badge bg-light text-dark border"><?= e($po['delivery_receipt_no'] ?? 'DR-Pending') ?></span></td>
                                <td><?= date("M d, Y", strtotime($po['date_received'] ?? $po['po_date'])) ?></td>
                                <td><small class="text-muted"><?= e($po['received_by'] ?? 'Supply Officer') ?></small></td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$po['total_amount'], 2) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" onclick="openInspectionModal(<?= (int)$po['id'] ?>, '<?= e($po['po_number']) ?>', '<?= e($po['delivery_receipt_no'] ?? '') ?>')">
                                        <i class="bi bi-clipboard2-check me-1"></i>Conduct Inspection
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No deliveries currently waiting for inspection.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section 2: Completed IARs -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-check me-2 text-gold"></i>Completed Inspection & Acceptance Reports (IAR)
        </h5>
        <span class="badge bg-light text-dark border">COA Audit Compliant</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">IAR Number</th>
                        <th>PO Number</th>
                        <th>Supplier</th>
                        <th>Inspection Date</th>
                        <th>Inspection Officer</th>
                        <th>Supply Officer</th>
                        <th class="text-center">Inspection Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($completedIars)): ?>
                        <?php foreach ($completedIars as $iar): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($iar['iar_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($iar['po_number']) ?></td>
                                <td><?= e($iar['company_name']) ?></td>
                                <td><?= date("M d, Y", strtotime($iar['inspection_date'])) ?></td>
                                <td><small class="text-muted"><?= e($iar['inspection_officer']) ?></small></td>
                                <td><small class="text-muted"><?= e($iar['supply_officer']) ?></small></td>
                                <td class="text-center">
                                    <span class="badge <?= $iar['inspection_status'] === 'Inspected & Accepted' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                        <?= e($iar['inspection_status']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-outline-danger" onclick="window.print();" title="Print IAR Form">
                                        <i class="bi bi-printer me-1"></i>Print IAR
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">No completed inspection reports logged yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Conduct Inspection -->
<div class="modal fade" id="modalInspect" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-primary" id="inspectModalTitle">
                    <i class="bi bi-clipboard2-check me-2"></i>Conduct Inspection & Acceptance (IAR)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/iar-processing/inspect') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="po_id" id="inspectPoId">
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sales Invoice / DR No.</label>
                            <input type="text" class="form-control" name="invoice_number" id="inspectInvoiceNo" placeholder="e.g. SI-88210 / DR-77401">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Item Name / Delivered Goods <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item_name" placeholder="e.g. Core i7 Desktop Computer Set" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Accepted Quantity <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" name="accepted_qty" value="1" required>
                            <small class="text-muted">Will be added directly to Inventory.</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Rejected / Defective Qty</label>
                            <input type="number" min="0" class="form-control" name="rejected_qty" value="0">
                            <small class="text-muted">Will be sent to Discrepancy / Returns.</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Unit Cost (&#8369;) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control" name="unit_cost" value="25000.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Inspection Officer / Committee Chair <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="inspection_officer" value="Engr. Kenneth P. Lim (Inspection Chair)" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Property & Supply Officer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="supply_officer" value="Maria Luisa D. Cruz (Supply Officer III)" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Inspection Remarks / Observations</label>
                            <textarea class="form-control" name="remarks" rows="2" placeholder="All components tested and certified complete in accordance with technical specifications."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i>Save IAR & Sync to Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openInspectionModal(id, poNumber, drNo) {
    document.getElementById('inspectPoId').value = id;
    document.getElementById('inspectModalTitle').innerHTML = '<i class="bi bi-clipboard2-check me-2"></i>IAR Inspection: ' + poNumber;
    document.getElementById('inspectInvoiceNo').value = drNo || '';
    const modal = new bootstrap.Modal(document.getElementById('modalInspect'));
    modal.show();
}
</script>
