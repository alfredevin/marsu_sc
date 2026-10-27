<!-- Approval Workflow — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-check2-circle me-2 text-gold"></i>Approval Workflow
        </h1>
        <p class="text-muted small mb-0">Track and manage approval workflows for purchase requests and procurement activities.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Pipeline Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="p-3 bg-primary-subtle text-primary rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-send fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-primary">0</div>
            <div class="text-muted small">Submitted</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="p-3 bg-warning-subtle text-warning rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-hourglass-split fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-warning">0</div>
            <div class="text-muted small">Pending Review</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="p-3 bg-success-subtle text-success rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-check-circle fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-success">0</div>
            <div class="text-muted small">Approved</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="p-3 bg-danger-subtle text-danger rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-x-circle fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-danger">0</div>
            <div class="text-muted small">Rejected</div>
        </div>
    </div>
</div>

<!-- Workflow Stages Diagram -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-diagram-3 me-2 text-gold"></i>Approval Pipeline Stages
        </h5>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-center py-2">
            <div class="text-center px-3">
                <div class="rounded-circle bg-marsu-burgundy text-white d-inline-flex align-items-center justify-content-center mb-2" style="width:48px;height:48px;">
                    <i class="bi bi-pencil-square fs-5"></i>
                </div>
                <div class="small fw-semibold">Filed</div>
                <div class="small text-muted">Requestor</div>
            </div>
            <i class="bi bi-chevron-right text-muted fs-4"></i>
            <div class="text-center px-3">
                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2" style="width:48px;height:48px;">
                    <i class="bi bi-person-check fs-5"></i>
                </div>
                <div class="small fw-semibold">Dept. Review</div>
                <div class="small text-muted">Dept. Head</div>
            </div>
            <i class="bi bi-chevron-right text-muted fs-4"></i>
            <div class="text-center px-3">
                <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mb-2" style="width:48px;height:48px;">
                    <i class="bi bi-building fs-5"></i>
                </div>
                <div class="small fw-semibold">BAC Review</div>
                <div class="small text-muted">BAC Officer</div>
            </div>
            <i class="bi bi-chevron-right text-muted fs-4"></i>
            <div class="text-center px-3">
                <div class="rounded-circle bg-info text-white d-inline-flex align-items-center justify-content-center mb-2" style="width:48px;height:48px;">
                    <i class="bi bi-bank fs-5"></i>
                </div>
                <div class="small fw-semibold">Finance</div>
                <div class="small text-muted">Budget Check</div>
            </div>
            <i class="bi bi-chevron-right text-muted fs-4"></i>
            <div class="text-center px-3">
                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2" style="width:48px;height:48px;">
                    <i class="bi bi-check2-all fs-5"></i>
                </div>
                <div class="small fw-semibold">Approved</div>
                <div class="small text-muted">President</div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Approvals Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-check me-2 text-gold"></i>Pending Approvals
        </h5>
        <div class="d-flex gap-2">
            <select id="approvalStageFilter" class="form-select form-select-sm w-auto">
                <option value="">All Stages</option>
                <option value="dept">Dept. Review</option>
                <option value="bac">BAC Review</option>
                <option value="finance">Finance</option>
                <option value="president">Final Approval</option>
            </select>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PR No.</th>
                        <th>Description</th>
                        <th>Filed By</th>
                        <th>Current Stage</th>
                        <th>Date Submitted</th>
                        <th>Amount</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-check2-circle fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No items pending approval at this time.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
