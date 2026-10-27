<!-- PR Filling — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-file-earmark-text me-2 text-gold"></i>PR Filling
        </h1>
        <p class="text-muted small mb-0">File and manage Purchase Requests for goods and services.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewPR">
            <i class="bi bi-plus-circle me-1"></i>New PR
        </button>
    </div>
</div>

<!-- Filter Row -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" id="prSearchInput" class="form-control form-control-sm" placeholder="Search PR number, description...">
            </div>
            <div class="col-md-3">
                <select id="prStatusFilter" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="Draft">Draft</option>
                    <option value="Submitted">Submitted</option>
                    <option value="For Canvassing">For Canvassing</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="prOfficeFilter" class="form-select form-select-sm">
                    <option value="">All Offices</option>
                    <option value="CICS">CICS</option>
                    <option value="OSAS">OSAS</option>
                    <option value="Admin">Admin</option>
                    <option value="Finance">Finance</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- PR Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-ul me-2 text-gold"></i>Purchase Requests
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="prTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PR No.</th>
                        <th>Description</th>
                        <th>Requesting Office</th>
                        <th>Date Filed</th>
                        <th>Est. Amount</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No purchase requests found. Click <strong>New PR</strong> to file one.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New PR -->
<div class="modal fade" id="modalNewPR" tabindex="-1" aria-labelledby="modalNewPRLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewPRLabel">
                    <i class="bi bi-file-earmark-plus me-2 text-gold"></i>New Purchase Request
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formNewPR" method="POST" action="<?= url('procurement/pr-filling/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="prNumber" class="form-label fw-semibold">PR Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="prNumber" name="pr_number" placeholder="e.g. PR-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prDateFiled" class="form-label fw-semibold">Date Filed <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="prDateFiled" name="date_filed" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prRequestingOffice" class="form-label fw-semibold">Requesting Office <span class="text-danger">*</span></label>
                            <select class="form-select" id="prRequestingOffice" name="requesting_office" required>
                                <option value="">— Select Office —</option>
                                <option value="CICS">CICS</option>
                                <option value="OSAS">OSAS</option>
                                <option value="Admin">Admin</option>
                                <option value="Finance">Finance</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prEstAmount" class="form-label fw-semibold">Estimated Amount (&#8369;)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="prEstAmount" name="estimated_amount" placeholder="0.00">
                        </div>
                        <div class="col-12">
                            <label for="prDescription" class="form-label fw-semibold">Item / Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="prDescription" name="description" rows="3" placeholder="Describe the goods or services being requested..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="prPurpose" class="form-label fw-semibold">Purpose / Justification</label>
                            <textarea class="form-control" id="prPurpose" name="purpose" rows="2" placeholder="State the purpose of this purchase request..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save PR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var dateInput = document.getElementById('prDateFiled');
    if (dateInput) dateInput.value = new Date().toISOString().split('T')[0];
});
</script>
