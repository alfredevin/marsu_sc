<!-- Fund Source Verification — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bank me-2 text-gold"></i>Fund Source Verification
        </h1>
        <p class="text-muted small mb-0">Verify and validate the fund sources (MOOE, CO, PS) linked to procurement items.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Fund Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="fw-bold text-muted small text-uppercase mb-2">MOOE (Maintenance)</div>
            <div class="h4 fw-bold text-marsu-burgundy mb-1">&#8369;0.00</div>
            <div class="progress" style="height:6px;">
                <div class="progress-bar bg-marsu-burgundy" style="width:0%"></div>
            </div>
            <div class="small text-muted mt-1">0% utilized</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="fw-bold text-muted small text-uppercase mb-2">CO (Capital Outlay)</div>
            <div class="h4 fw-bold text-primary mb-1">&#8369;0.00</div>
            <div class="progress" style="height:6px;">
                <div class="progress-bar bg-primary" style="width:0%"></div>
            </div>
            <div class="small text-muted mt-1">0% utilized</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="fw-bold text-muted small text-uppercase mb-2">PS (Personnel Services)</div>
            <div class="h4 fw-bold text-gold mb-1">&#8369;0.00</div>
            <div class="progress" style="height:6px;">
                <div class="progress-bar bg-warning" style="width:0%"></div>
            </div>
            <div class="small text-muted mt-1">0% utilized</div>
        </div>
    </div>
</div>

<!-- Verification Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-shield-check me-2 text-gold"></i>Fund Source Records
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm w-auto">
                <option value="">All Fund Types</option>
                <option>MOOE</option>
                <option>CO</option>
                <option>PS</option>
            </select>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PR No.</th>
                        <th>Item</th>
                        <th>Fund Type</th>
                        <th>Allotment Class</th>
                        <th>Amount (&#8369;)</th>
                        <th>Obligation No.</th>
                        <th>Verified By</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-bank fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No fund source records found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
