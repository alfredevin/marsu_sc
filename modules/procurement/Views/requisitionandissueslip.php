<!-- Requisition and Issue Slip — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-receipt me-2 text-gold"></i>Requisition and Issue Slip (RIS)
        </h1>
        <p class="text-muted small mb-0">Manage internal requisition and issue slips linked to approved purchase requests.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewRIS">
            <i class="bi bi-plus-circle me-1"></i>New RIS
        </button>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total RIS</div>
                    <div class="h3 fw-bold mb-0 text-marsu-burgundy">0</div>
                </div>
                <div class="p-3 bg-burgundy-subtle text-marsu-burgundy rounded-circle">
                    <i class="bi bi-receipt fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending</div>
                    <div class="h3 fw-bold mb-0 text-warning">0</div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Issued</div>
                    <div class="h3 fw-bold mb-0 text-success">0</div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-check2-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Cancelled</div>
                    <div class="h3 fw-bold mb-0 text-danger">0</div>
                </div>
                <div class="p-3 bg-danger-subtle text-danger rounded-circle">
                    <i class="bi bi-x-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RIS Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-receipt me-2 text-gold"></i>Requisition and Issue Slips
        </h5>
        <input type="text" id="risSearchInput" class="form-control form-control-sm w-auto" placeholder="Search RIS...">
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">RIS No.</th>
                        <th>Linked PR</th>
                        <th>Requested By</th>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-receipt fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No requisition and issue slips found. Click <strong>New RIS</strong> to create one.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New RIS -->
<div class="modal fade" id="modalNewRIS" tabindex="-1" aria-labelledby="modalNewRISLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewRISLabel">
                    <i class="bi bi-receipt me-2 text-gold"></i>New Requisition and Issue Slip
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/requisition-and-issue-slip/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="risNumber" class="form-label fw-semibold">RIS Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="risNumber" name="ris_number" placeholder="e.g. RIS-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="risDate" class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="risDate" name="ris_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="risLinkedPR" class="form-label fw-semibold">Linked PR Number</label>
                            <input type="text" class="form-control" id="risLinkedPR" name="linked_pr" placeholder="e.g. PR-2026-001">
                        </div>
                        <div class="col-md-6">
                            <label for="risRequestedBy" class="form-label fw-semibold">Requested By <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="risRequestedBy" name="requested_by" placeholder="Name of requestor" required>
                        </div>
                        <div class="col-12">
                            <label for="risItemDesc" class="form-label fw-semibold">Item Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="risItemDesc" name="item_description" rows="3" placeholder="Describe the items being requisitioned..." required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="risQuantity" class="form-label fw-semibold">Quantity <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control" id="risQuantity" name="quantity" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label for="risUnit" class="form-label fw-semibold">Unit</label>
                            <input type="text" class="form-control" id="risUnit" name="unit" placeholder="e.g. pcs, reams">
                        </div>
                        <div class="col-md-4">
                            <label for="risUnitCost" class="form-label fw-semibold">Unit Cost (&#8369;)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="risUnitCost" name="unit_cost" placeholder="0.00">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save RIS</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var risDate = document.getElementById('risDate');
    if (risDate) risDate.value = new Date().toISOString().split('T')[0];
});
</script>
