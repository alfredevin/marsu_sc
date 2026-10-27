<!-- Discrepancy Management — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-exclamation-triangle me-2 text-gold"></i>Discrepancy Management
        </h1>
        <p class="text-muted small mb-0">Record and resolve discrepancies found during inspection and acceptance of delivered goods.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewDisc">
            <i class="bi bi-plus-circle me-1"></i>Log Discrepancy
        </button>
    </div>
</div>

<!-- Discrepancy Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-flag-fill fs-2 text-danger mb-2"></i>
            <div class="h3 fw-bold text-danger mb-0">0</div>
            <div class="small text-muted">Open Discrepancies</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-arrow-clockwise fs-2 text-warning mb-2"></i>
            <div class="h3 fw-bold text-warning mb-0">0</div>
            <div class="small text-muted">In Resolution</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-check-circle-fill fs-2 text-success mb-2"></i>
            <div class="h3 fw-bold text-success mb-0">0</div>
            <div class="small text-muted">Resolved</div>
        </div>
    </div>
</div>

<!-- Discrepancy Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-exclamation-triangle me-2 text-gold"></i>Discrepancy Log
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm w-auto">
                <option value="">All Statuses</option>
                <option>Open</option>
                <option>In Resolution</option>
                <option>Resolved</option>
            </select>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Disc. No.</th>
                        <th>Linked IAR</th>
                        <th>Linked PO</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date Logged</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-exclamation-triangle fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No discrepancy records found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Log Discrepancy -->
<div class="modal fade" id="modalNewDisc" tabindex="-1" aria-labelledby="modalNewDiscLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewDiscLabel">
                    <i class="bi bi-exclamation-triangle me-2 text-gold"></i>Log Discrepancy
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/discrepancy-management/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="discLinkedIAR" class="form-label fw-semibold">Linked IAR No.</label>
                            <input type="text" class="form-control" id="discLinkedIAR" name="linked_iar" placeholder="IAR number">
                        </div>
                        <div class="col-md-6">
                            <label for="discLinkedPO" class="form-label fw-semibold">Linked PO No.</label>
                            <input type="text" class="form-control" id="discLinkedPO" name="linked_po" placeholder="PO number">
                        </div>
                        <div class="col-12">
                            <label for="discType" class="form-label fw-semibold">Discrepancy Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="discType" name="type" required>
                                <option value="">— Select —</option>
                                <option value="Quantity Shortage">Quantity Shortage</option>
                                <option value="Quality Issue">Quality Issue</option>
                                <option value="Damage">Damaged Item</option>
                                <option value="Wrong Item">Wrong Item Delivered</option>
                                <option value="Specification Mismatch">Specification Mismatch</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="discDescription" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="discDescription" name="description" rows="3" placeholder="Describe the discrepancy in detail..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="discResolution" class="form-label fw-semibold">Proposed Resolution</label>
                            <textarea class="form-control" id="discResolution" name="proposed_resolution" rows="2" placeholder="How will this be resolved?"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Log Discrepancy</button>
                </div>
            </form>
        </div>
    </div>
</div>
