<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-trophy-fill me-1"></i> Student Success & Honor Candidate Reports
            </h6>
            <small class="text-muted">Tracking Dean's Listers, academic achievers, and timely graduation candidate metrics.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center">
                <select name="department" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Programs</option>
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
                <span class="text-muted small fw-semibold text-uppercase">President's Listers</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($presidentsListers ?? 48)) ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">GWA 1.00 – 1.45</span>
                </div>
                <small class="text-muted mt-2 d-block">Highest academic honors achievers</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Dean's List Candidates</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($deansListers ?? 142)) ?></h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">GWA 1.46 – 1.75</span>
                </div>
                <small class="text-muted mt-2 d-block">College scholastic honor roll</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Graduating Candidates</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= htmlspecialchars((string) ($graduatingCount ?? 215)) ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">4th Year On-Track</span>
                </div>
                <small class="text-muted mt-2 d-block">Candidates completing degree in A.Y. 2026-2027</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Total Scholastic Honors</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= htmlspecialchars((string) ($honorCandidates ?? 190)) ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Excellence Ratio: 21.9%</span>
                </div>
                <small class="text-muted mt-2 d-block">Combined honor achievers cohort</small>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-award me-1"></i> Honor Roll & Scholastic Distinction Summary
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Program Code</th>
                        <th class="py-3">Program Name</th>
                        <th class="py-3 text-center">President's Lister (1.00 - 1.45)</th>
                        <th class="py-3 text-center">Dean's Lister (1.46 - 1.75)</th>
                        <th class="py-3 text-center pe-3">Total Honor Roll</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $honors = $honorList ?? [
                        ['code' => 'BSIS', 'name' => 'BS Information Systems', 'pres' => 14, 'dean' => 38, 'total' => 52],
                        ['code' => 'BSTM', 'name' => 'BS Tourism Management', 'pres' => 12, 'dean' => 32, 'total' => 44],
                        ['code' => 'BEED', 'name' => 'Bachelor of Elementary Education', 'pres' => 15, 'dean' => 42, 'total' => 57],
                        ['code' => 'BAPoS', 'name' => 'BA Political Science', 'pres' => 7, 'dean' => 30, 'total' => 37],
                    ];
                    foreach ($honors as $row):
                    ?>
                        <tr>
                            <td class="ps-3 fw-bold text-dark font-monospace"><?= htmlspecialchars($row['code']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td class="text-center font-monospace text-success fw-bold"><?= number_format($row['pres']) ?></td>
                            <td class="text-center font-monospace text-primary fw-bold"><?= number_format($row['dean']) ?></td>
                            <td class="text-center fw-bold text-success pe-3 font-monospace"><?= number_format($row['total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
