<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-graph-up-arrow me-1"></i> Multi-Year Longitudinal Trends & Predictive Analytics
            </h6>
            <small class="text-muted">Comparative historical analysis of student retention, GPA trajectories, and intervention outcomes across academic years.</small>
        </div>

        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> Print Report
        </button>
    </div>

    <!-- 4 KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">3-Year Average Retention</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($threeYearAvgRetention ?? '95.2')) ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">+2.1% Net Gain</span>
                </div>
                <small class="text-muted mt-2 d-block">Sustained institutional benchmark</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Current Cohort Retention</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($currentCohortRetention ?? '96.2')) ?>%</h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">AY 2026-2027</span>
                </div>
                <small class="text-muted mt-2 d-block">Highest retention in 5 years</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">3-Year Mean GPA</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= htmlspecialchars((string) ($threeYearAvgGpa ?? '2.18')) ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Scale: 1.00 – 5.00</span>
                </div>
                <small class="text-muted mt-2 d-block">Positive scholastic progress</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Intervention Success Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= htmlspecialchars((string) ($interventionSuccessRate ?? '88.5')) ?>%</h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">+4.8% vs 2024</span>
                </div>
                <small class="text-muted mt-2 d-block">EWS resolved intervention cases</small>
            </div>
        </div>
    </div>

    <!-- Historical Trends Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-clock-history me-1"></i> Multi-Year Comparative Retention & Performance Ledger
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Academic Year</th>
                        <th class="py-3 text-center">Total Enrolled</th>
                        <th class="py-3 text-center">Institutional GWA</th>
                        <th class="py-3 text-center">Retention Rate</th>
                        <th class="py-3 text-center">Dropout Rate</th>
                        <th class="py-3 text-center pe-3">Intervention Success</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $trends = $trendRows ?? [
                        ['year' => 'AY 2026-2027 (Current)', 'enrolled' => 866, 'gwa' => 2.14, 'retention' => 96.2, 'dropout' => 3.8, 'success' => 88.5],
                        ['year' => 'AY 2025-2026', 'enrolled' => 834, 'gwa' => 2.18, 'retention' => 95.4, 'dropout' => 4.6, 'success' => 86.2],
                        ['year' => 'AY 2024-2025', 'enrolled' => 798, 'gwa' => 2.23, 'retention' => 94.1, 'dropout' => 5.9, 'success' => 83.7],
                    ];
                    foreach ($trends as $row):
                    ?>
                        <tr>
                            <td class="ps-3 fw-bold text-dark"><?= htmlspecialchars($row['year']) ?></td>
                            <td class="text-center font-monospace"><?= number_format($row['enrolled']) ?></td>
                            <td class="text-center font-monospace"><?= number_format($row['gwa'], 2) ?></td>
                            <td class="text-center fw-bold text-success font-monospace"><?= number_format($row['retention'], 1) ?>%</td>
                            <td class="text-center font-monospace text-danger"><?= number_format($row['dropout'], 1) ?>%</td>
                            <td class="text-center fw-bold text-primary pe-3 font-monospace"><?= number_format($row['success'], 1) ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
