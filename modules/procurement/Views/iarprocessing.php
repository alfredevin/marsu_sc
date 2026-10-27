<!-- IAR Processing — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clipboard2-check me-2 text-gold"></i>IAR Processing (Inspection &amp; Acceptance Report)
        </h1>
        <p class="text-muted small mb-0">Process and record inspection and acceptance of delivered goods and services.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewIAR">
            <i class="bi bi-plus-circle me-1"></i>New IAR
        </button>
    </div>
</div>

<!-- IAR Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">For Inspection</div>
                    <div class="h3 fw-bold mb-0 text-warning">0</div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-search fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Accepted</div>
                    <div class="h3 fw-bold mb-0 text-success">0</div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-check2-all fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">With Discrepancy</div>
                    <div class="h3 fw-bold mb-0 text-danger">0</div>
                </div>
                <div class="p-3 bg-danger-subtle text-danger rounded-circle">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Transferred</div>
                    <div class="h3 fw-bold mb-0 text-primary">0</div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-arrow-right-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- IAR Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-clipboard2-check me-2 text-gold"></i>Inspection &amp; Acceptance Reports
        </h5>
        <input type="text" class="form-control form-control-sm w-auto" placeholder="Search IAR number...">
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">IAR No.</th>
                        <th>Linked PO</th>
                        <th>Supplier</th>
                        <th>Item Description</th>
                        <th>Qty Delivered</th>
                        <th>Qty Accepted</th>
                        <th>Inspection Date</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-clipboard2-check fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No IAR records found. Click <strong>New IAR</strong> once items are delivered.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New IAR -->
<div class="modal fade" id="modalNewIAR" tabindex="-1" aria-labelledby="modalNewIARLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewIARLabel">
                    <i class="bi bi-clipboard2-check me-2 text-gold"></i>New IAR
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/iar-processing/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="iarNumber" class="form-label fw-semibold">IAR Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="iarNumber" name="iar_number" placeholder="e.g. IAR-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="iarLinkedPO" class="form-label fw-semibold">Linked PO Number</label>
                            <input type="text" class="form-control" id="iarLinkedPO" name="linked_po" placeholder="e.g. PO-2026-001">
                        </div>
                        <div class="col-md-6">
                            <label for="iarSupplier" class="form-label fw-semibold">Supplier <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="iarSupplier" name="supplier" placeholder="Supplier name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="iarInspectionDate" class="form-label fw-semibold">Inspection Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="iarInspectionDate" name="inspection_date" required>
                        </div>
                        <div class="col-12">
                            <label for="iarItemDesc" class="form-label fw-semibold">Item Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="iarItemDesc" name="item_description" rows="2" placeholder="Describe the items received..." required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="iarQtyDelivered" class="form-label fw-semibold">Qty Delivered <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" id="iarQtyDelivered" name="qty_delivered" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label for="iarQtyAccepted" class="form-label fw-semibold">Qty Accepted <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" id="iarQtyAccepted" name="qty_accepted" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label for="iarStatus" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="iarStatus" name="status">
                                <option value="Accepted">Accepted</option>
                                <option value="Partial">Partial Acceptance</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="iarRemarks" class="form-label fw-semibold">Remarks / Discrepancy Notes</label>
                            <textarea class="form-control" id="iarRemarks" name="remarks" rows="2" placeholder="Note any discrepancies or conditions..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save IAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var iarDate = document.getElementById('iarInspectionDate');
    if (iarDate) iarDate.value = new Date().toISOString().split('T')[0];
});
</script>
