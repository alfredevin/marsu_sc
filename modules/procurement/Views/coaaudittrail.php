<!-- COA Audit Trail — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-journal-check me-2 text-gold"></i>COA Audit Trail
        </h1>
        <p class="text-muted small mb-0">Commission on Audit (COA) trail — log and track all procurement-related audit observations and responses.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewAudit">
            <i class="bi bi-plus-circle me-1"></i>Log Audit Observation
        </button>
    </div>
</div>

<!-- Audit Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-clipboard-x fs-2 text-danger mb-2"></i>
            <div class="h3 fw-bold text-danger mb-0">0</div>
            <div class="small text-muted">Open Observations</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-reply-all fs-2 text-warning mb-2"></i>
            <div class="h3 fw-bold text-warning mb-0">0</div>
            <div class="small text-muted">Awaiting Response</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-arrow-clockwise fs-2 text-primary mb-2"></i>
            <div class="h3 fw-bold text-primary mb-0">0</div>
            <div class="small text-muted">In Progress</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-patch-check-fill fs-2 text-success mb-2"></i>
            <div class="h3 fw-bold text-success mb-0">0</div>
            <div class="small text-muted">Fully Complied</div>
        </div>
    </div>
</div>

<!-- Audit Trail Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-text me-2 text-gold"></i>Audit Observations Log
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm w-auto">
                <option value="">All Statuses</option>
                <option>Open</option>
                <option>Awaiting Response</option>
                <option>In Progress</option>
                <option>Fully Complied</option>
            </select>
            <select class="form-select form-select-sm w-auto">
                <option>FY 2026</option>
                <option>FY 2025</option>
            </select>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Obs. No.</th>
                        <th>Audit Date</th>
                        <th>Subject / Finding</th>
                        <th>Linked Document</th>
                        <th>Auditor</th>
                        <th>Response Deadline</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-journal-check fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No audit observations recorded yet.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Log Audit Observation -->
<div class="modal fade" id="modalNewAudit" tabindex="-1" aria-labelledby="modalNewAuditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewAuditLabel">
                    <i class="bi bi-journal-plus me-2 text-gold"></i>Log Audit Observation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/coa-audit-trail/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="auditObsNo" class="form-label fw-semibold">Observation No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="auditObsNo" name="observation_number" placeholder="e.g. OBS-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="auditDate" class="form-label fw-semibold">Audit Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="auditDate" name="audit_date" required>
                        </div>
                        <div class="col-12">
                            <label for="auditFinding" class="form-label fw-semibold">Subject / Finding <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="auditFinding" name="finding" rows="3" placeholder="Describe the audit observation or finding..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="auditLinkedDoc" class="form-label fw-semibold">Linked Document</label>
                            <input type="text" class="form-control" id="auditLinkedDoc" name="linked_document" placeholder="PR/PO/IAR reference no.">
                        </div>
                        <div class="col-md-6">
                            <label for="auditAuditor" class="form-label fw-semibold">Auditor / COA Representative</label>
                            <input type="text" class="form-control" id="auditAuditor" name="auditor" placeholder="Name of auditor">
                        </div>
                        <div class="col-md-6">
                            <label for="auditDeadline" class="form-label fw-semibold">Response Deadline</label>
                            <input type="date" class="form-control" id="auditDeadline" name="response_deadline">
                        </div>
                        <div class="col-md-6">
                            <label for="auditStatus" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="auditStatus" name="status">
                                <option value="Open">Open</option>
                                <option value="Awaiting Response">Awaiting Response</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Fully Complied">Fully Complied</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="auditResponse" class="form-label fw-semibold">Management Response / Remarks</label>
                            <textarea class="form-control" id="auditResponse" name="management_response" rows="2" placeholder="Provide management's response to the audit observation..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Observation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var auditDate = document.getElementById('auditDate');
    if (auditDate) auditDate.value = new Date().toISOString().split('T')[0];
});
</script>
