<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-pie-chart-fill me-1"></i> Executive Risk Analytics & Institutional Overview
            </h6>
            <small class="text-muted">High-level institutional telemetry on student risk distribution, retention rates, and intervention coverage.</small>
        </div>

        <form method="GET" action="" class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <select name="department" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="">All Programs</option>
                <?php foreach (($departments ?? ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSIT', 'BSCS']) as $dept): ?>
                    <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print
            </button>
        </form>
    </div>

    <!-- 4 KPI Metrics -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Cohort Retention Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($retentionRate ?? '94.2')) ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">+1.8% vs Target</span>
                </div>
                <small class="text-muted mt-2 d-block">Overall institutional retention</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">High-Risk Students</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($highRiskCount ?? '7')) ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger"><?= htmlspecialchars((string) ($highRiskPercent ?? '4.8')) ?>% of Cohort</span>
                </div>
                <small class="text-muted mt-2 d-block">Immediate intervention required</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Intervention Coverage</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($coverageRate ?? '88.5')) ?>%</h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">Active Care</span>
                </div>
                <small class="text-muted mt-2 d-block">At-risk students receiving help</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Moderate / Monitored</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= htmlspecialchars((string) ($moderateRiskCount ?? 18)) ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Watchlist</span>
                </div>
                <small class="text-muted mt-2 d-block">Monitored for early grade decline</small>
            </div>
        </div>
    </div>

    <!-- Departmental Breakdown Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-building me-1"></i> Program-Level Risk Distribution Breakdown
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Degree Program</th>
                        <th class="py-3 text-center">Total Enrolled</th>
                        <th class="py-3 text-center">Low Risk</th>
                        <th class="py-3 text-center">Moderate Risk</th>
                        <th class="py-3 text-center">High Risk</th>
                        <th class="py-3 text-center pe-3">Retention Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $deptOverview = $programBreakdown ?? [
                        ['code' => 'BSIS', 'name' => 'BS Information Systems', 'total' => 320, 'low' => 295, 'mod' => 18, 'high' => 7, 'rate' => 95.3],
                        ['code' => 'BSTM', 'name' => 'BS Tourism Management', 'total' => 280, 'low' => 258, 'mod' => 16, 'high' => 6, 'rate' => 94.8],
                        ['code' => 'BEED', 'name' => 'Bachelor of Elementary Education', 'total' => 310, 'low' => 292, 'mod' => 13, 'high' => 5, 'rate' => 96.1],
                        ['code' => 'BAPoS', 'name' => 'BA Political Science', 'total' => 190, 'low' => 174, 'mod' => 11, 'high' => 5, 'rate' => 93.7],
                    ];
                    foreach ($deptOverview as $row):
                    ?>
                        <tr>
                            <td class="ps-3 fw-bold text-dark">
                                <?= htmlspecialchars($row['code']) ?> <span class="text-muted fw-normal"> - <?= htmlspecialchars($row['name']) ?></span>
                            </td>
                            <td class="text-center fw-bold text-dark font-monospace"><?= number_format($row['total']) ?></td>
                            <td class="text-center text-success font-monospace"><?= number_format($row['low']) ?></td>
                            <td class="text-center text-warning font-monospace"><?= number_format($row['mod']) ?></td>
                            <td class="text-center text-danger font-monospace fw-bold"><?= number_format($row['high']) ?></td>
                            <td class="text-center fw-bold text-primary pe-3 font-monospace"><?= number_format($row['rate'], 1) ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
