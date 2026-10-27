<!-- Property Turn-Over — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-box-arrow-right me-2 text-gold"></i>Property Turn-Over
        </h1>
        <p class="text-muted small mb-0">Record and manage the formal handover of accepted goods to the requesting office or assets unit.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewTurnover">
            <i class="bi bi-plus-circle me-1"></i>Record Turn-Over
        </button>
    </div>
</div>

<!-- Turn-Over Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-hourglass-split fs-2 text-warning mb-2"></i>
            <div class="h3 fw-bold text-warning mb-0">0</div>
            <div class="small text-muted">Pending Turn-Over</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-box-arrow-right fs-2 text-marsu-burgundy mb-2"></i>
            <div class="h3 fw-bold text-marsu-burgundy mb-0">0</div>
            <div class="small text-muted">Handed Over</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-buildings fs-2 text-success mb-2"></i>
            <div class="h3 fw-bold text-success mb-0">0</div>
            <div class="small text-muted">Transferred to Assets</div>
        </div>
    </div>
</div>

<!-- Turn-Over Records Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Turn-Over Records
        </h5>
        <input type="text" class="form-control form-control-sm w-auto" placeholder="Search turn-over no...">
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">TO No.</th>
                        <th>Linked IAR</th>
                        <th>Item Description</th>
                        <th>Turned Over To</th>
                        <th>Received By</th>
                        <th>Date</th>
                        <th>Property No.</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-box-arrow-right fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No turn-over records found. Click <strong>Record Turn-Over</strong> to begin.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Turn-Over -->
<div class="modal fade" id="modalNewTurnover" tabindex="-1" aria-labelledby="modalNewTurnoverLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewTurnoverLabel">
                    <i class="bi bi-box-arrow-right me-2 text-gold"></i>Record Property Turn-Over
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/property-turn-over/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="toNumber" class="form-label fw-semibold">Turn-Over No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="toNumber" name="to_number" placeholder="e.g. TO-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="toLinkedIAR" class="form-label fw-semibold">Linked IAR No.</label>
                            <input type="text" class="form-control" id="toLinkedIAR" name="linked_iar" placeholder="e.g. IAR-2026-001">
                        </div>
                        <div class="col-12">
                            <label for="toItemDesc" class="form-label fw-semibold">Item Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="toItemDesc" name="item_description" rows="2" placeholder="Describe the items being turned over..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="toTurnedOverTo" class="form-label fw-semibold">Turned Over To <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="toTurnedOverTo" name="turned_over_to" placeholder="Office or unit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="toReceivedBy" class="form-label fw-semibold">Received By <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="toReceivedBy" name="received_by" placeholder="Name of recipient" required>
                        </div>
                        <div class="col-md-6">
                            <label for="toDate" class="form-label fw-semibold">Turn-Over Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="toDate" name="turnover_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="toPropertyNo" class="form-label fw-semibold">Property / Serial No.</label>
                            <input type="text" class="form-control" id="toPropertyNo" name="property_number" placeholder="Assigned property no.">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Turn-Over</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var toDate = document.getElementById('toDate');
    if (toDate) toDate.value = new Date().toISOString().split('T')[0];
});
</script>
