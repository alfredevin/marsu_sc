<!-- APCPI Tracker — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-graph-up-arrow me-2 text-gold"></i>APCPI Tracker
        </h1>
        <p class="text-muted small mb-0">Annual Procurement Compliance and Performance Indicators — track compliance metrics and ratings.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Performance Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="fs-1 fw-bold text-marsu-burgundy mb-1">N/A</div>
            <div class="small text-muted fw-semibold">Overall APCPI Rating</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="fs-1 fw-bold text-primary mb-1">0%</div>
            <div class="small text-muted fw-semibold">Plan vs. Actual (%)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="fs-1 fw-bold text-success mb-1">0</div>
            <div class="small text-muted fw-semibold">Completed Procurements</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <div class="fs-1 fw-bold text-warning mb-1">0</div>
            <div class="small text-muted fw-semibold">Compliance Issues</div>
        </div>
    </div>
</div>

<!-- APCPI Indicators Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-bar-chart-line me-2 text-gold"></i>APCPI Performance Indicators
        </h5>
        <div class="d-flex gap-2">
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
                        <th class="ps-3">Indicator</th>
                        <th>Description</th>
                        <th>Target</th>
                        <th>Actual</th>
                        <th>Rating</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3"><span class="badge bg-marsu-burgundy">APP</span></td>
                        <td>Annual Procurement Plan submitted on time</td>
                        <td>Jan 31</td>
                        <td class="text-muted">—</td>
                        <td><span class="badge bg-secondary">Pending</span></td>
                        <td class="text-muted small">—</td>
                    </tr>
                    <tr>
                        <td class="ps-3"><span class="badge bg-primary">PR</span></td>
                        <td>Purchase Requests processed within 5 days</td>
                        <td>100%</td>
                        <td class="text-muted">0%</td>
                        <td><span class="badge bg-secondary">Pending</span></td>
                        <td class="text-muted small">—</td>
                    </tr>
                    <tr>
                        <td class="ps-3"><span class="badge bg-warning text-dark">PO</span></td>
                        <td>Purchase Orders issued within 30 days of PR approval</td>
                        <td>90%</td>
                        <td class="text-muted">0%</td>
                        <td><span class="badge bg-secondary">Pending</span></td>
                        <td class="text-muted small">—</td>
                    </tr>
                    <tr>
                        <td class="ps-3"><span class="badge bg-success">IAR</span></td>
                        <td>IAR completed within 5 days of delivery</td>
                        <td>100%</td>
                        <td class="text-muted">0%</td>
                        <td><span class="badge bg-secondary">Pending</span></td>
                        <td class="text-muted small">—</td>
                    </tr>
                    <tr>
                        <td class="ps-3"><span class="badge bg-info">COA</span></td>
                        <td>Audit findings resolved within prescribed period</td>
                        <td>100%</td>
                        <td class="text-muted">0%</td>
                        <td><span class="badge bg-secondary">Pending</span></td>
                        <td class="text-muted small">—</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
