<!-- Periodic Summaries — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-file-bar-graph me-2 text-gold"></i>Periodic Summaries
        </h1>
        <p class="text-muted small mb-0">Generate quarterly and annual procurement summaries and statistical reports.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Report
        </button>
    </div>
</div>

<!-- Period Selector -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <label class="form-label small fw-semibold mb-1">Report Period</label>
                <select id="reportPeriod" class="form-select form-select-sm">
                    <option value="Q1">Q1 (January – March)</option>
                    <option value="Q2">Q2 (April – June)</option>
                    <option value="Q3">Q3 (July – September)</option>
                    <option value="Q4" selected>Q4 (October – December)</option>
                    <option value="annual">Annual</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold mb-1">Year</label>
                <select id="reportYear" class="form-select form-select-sm">
                    <option value="2026" selected>2026</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-marsu btn-sm w-100">
                    <i class="bi bi-funnel me-1"></i>Generate
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="text-muted small text-uppercase fw-bold">Total PRs Filed</div>
            <div class="h3 fw-bold text-marsu-burgundy mb-0">0</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="text-muted small text-uppercase fw-bold">Total POs Issued</div>
            <div class="h3 fw-bold text-primary mb-0">0</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="text-muted small text-uppercase fw-bold">Total Amount Spent</div>
            <div class="h3 fw-bold text-gold mb-0">&#8369;0.00</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="text-muted small text-uppercase fw-bold">IAR Processed</div>
            <div class="h3 fw-bold text-success mb-0">0</div>
        </div>
    </div>
</div>

<!-- Detailed Summary Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Detailed Summary — Q4 2026
        </h5>
        <button class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-download me-1"></i>Export CSV
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Month</th>
                        <th>PRs Filed</th>
                        <th>PRs Approved</th>
                        <th>POs Issued</th>
                        <th>Items Delivered</th>
                        <th>Total Amount (&#8369;)</th>
                        <th>Compliance Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">October</td>
                        <td>0</td><td>0</td><td>0</td><td>0</td>
                        <td>0.00</td><td><span class="badge bg-secondary">—</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3">November</td>
                        <td>0</td><td>0</td><td>0</td><td>0</td>
                        <td>0.00</td><td><span class="badge bg-secondary">—</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3">December</td>
                        <td>0</td><td>0</td><td>0</td><td>0</td>
                        <td>0.00</td><td><span class="badge bg-secondary">—</span></td>
                    </tr>
                    <tr class="table-light fw-bold">
                        <td class="ps-3">Total</td>
                        <td>0</td><td>0</td><td>0</td><td>0</td>
                        <td>&#8369;0.00</td><td><span class="badge bg-secondary">—</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
