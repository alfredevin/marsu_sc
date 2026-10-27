<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-bar-chart-line-fill me-1"></i> Retention Rate Reports & Institutional Attrition Analytics
            </h6>
            <small class="text-muted">Macro reporting on cohort persistence, year-to-year progression rates, and dropout prevention telemetry.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center">
                <select name="school_year" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="2026-2027" <?= ($schoolYear ?? '2026-2027') === '2026-2027' ? 'selected' : '' ?>>A.Y. 2026-2027</option>
                    <option value="2025-2026" <?= ($schoolYear ?? '') === '2025-2026' ? 'selected' : '' ?>>A.Y. 2025-2026</option>
                </select>
                <select name="department" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Degree Programs</option>
                    <?php foreach (($departments ?? ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSIT', 'BSCS']) as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print Report
            </button>
        </div>
    </div>

    <!-- 4 KPI Metrics -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Institutional Retention Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($overallRetentionRate ?? '96.2')) ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">+1.5% YoY</span>
                </div>
                <small class="text-muted mt-2 d-block">CHED Benchmark standard: &ge; 85%</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">First-Year Retention</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($firstYearRetention ?? '94.8')) ?>%</h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">Freshman Persistence</span>
                </div>
                <small class="text-muted mt-2 d-block">Transition from 1st Year to 2nd Year</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Annual Attrition Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= htmlspecialchars((string) ($attritionRate ?? '3.8')) ?>%</h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">-0.4% Improvement</span>
                </div>
                <small class="text-muted mt-2 d-block">Dropouts, LOA, and unrenewed enrollments</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Prevented Dropouts</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($preventedCount ?? '34')) ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Intervention Impact</span>
                </div>
                <small class="text-muted mt-2 d-block">Students rescued via EWS interventions</small>
            </div>
        </div>
    </div>

    <!-- Analytics Breakdown Matrix -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-table me-1"></i> Program-Wise Cohort Retention Matrix (<?= htmlspecialchars($schoolYear ?? 'A.Y. 2026-2027') ?>)
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Degree Program</th>
                        <th class="py-3 text-center">1st Year Retention</th>
                        <th class="py-3 text-center">2nd Year Retention</th>
                        <th class="py-3 text-center">3rd Year Retention</th>
                        <th class="py-3 text-center">4th Year Retention</th>
                        <th class="py-3 text-center pe-3">Overall Retention</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $matrix = $cohortMatrix ?? [
                        ['name' => 'BS Information Systems (BSIS)', 'y1' => 94.5, 'y2' => 95.2, 'y3' => 96.8, 'y4' => 98.5, 'overall' => 96.25],
                        ['name' => 'BS Tourism Management (BSTM)', 'y1' => 93.8, 'y2' => 94.6, 'y3' => 95.9, 'y4' => 98.1, 'overall' => 95.60],
                        ['name' => 'Bachelor of Elementary Education (BEED)', 'y1' => 95.1, 'y2' => 96.0, 'y3' => 97.4, 'y4' => 99.0, 'overall' => 96.87],
                        ['name' => 'BA Political Science (BAPoS)', 'y1' => 92.4, 'y2' => 93.9, 'y3' => 95.1, 'y4' => 97.8, 'overall' => 94.80],
                    ];
                    foreach ($matrix as $row):
                    ?>
                        <tr>
                            <td class="ps-3 fw-bold text-dark"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="text-center font-monospace"><?= number_format($row['y1'], 1) ?>%</td>
                            <td class="text-center font-monospace"><?= number_format($row['y2'], 1) ?>%</td>
                            <td class="text-center font-monospace"><?= number_format($row['y3'], 1) ?>%</td>
                            <td class="text-center font-monospace"><?= number_format($row['y4'], 1) ?>%</td>
                            <td class="text-center fw-bold text-success pe-3 font-monospace"><?= number_format($row['overall'], 2) ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
