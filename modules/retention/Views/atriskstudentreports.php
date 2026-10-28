<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-file-earmark-bar-graph-fill me-1"></i> At-Risk Student Demographics & Breakdown Report
            </h6>
            <small class="text-muted">Analytical report detailing risk factors across academic programs, year levels, and housing arrangements.</small>
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


    <!-- Summary Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-shield-exclamation me-1"></i> Program-Wise At-Risk Breakdown
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Program Code</th>
                        <th class="py-3">Program Name</th>
                        <th class="py-3 text-center">Total Enrolled</th>
                        <th class="py-3 text-center">Failing Grade Risk</th>
                        <th class="py-3 text-center">Absence Risk</th>
                        <th class="py-3 text-center">Geographic Risk</th>
                        <th class="py-3 text-center pe-3">High Risk Cohort</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $breakdown = $programRiskBreakdown ?? [
                        ['code' => 'BSIS', 'name' => 'BS Information Systems', 'enrolled' => 320, 'fail' => 12, 'absence' => 8, 'geo' => 15, 'high' => 7, 'pct' => 2.18],
                        ['code' => 'BSTM', 'name' => 'BS Tourism Management', 'enrolled' => 280, 'fail' => 10, 'absence' => 7, 'geo' => 18, 'high' => 6, 'pct' => 2.14],
                        ['code' => 'BEED', 'name' => 'Bachelor of Elementary Education', 'enrolled' => 310, 'fail' => 9, 'absence' => 5, 'geo' => 12, 'high' => 5, 'pct' => 1.61],
                        ['code' => 'BAPoS', 'name' => 'BA Political Science', 'enrolled' => 190, 'fail' => 7, 'absence' => 4, 'geo' => 9, 'high' => 4, 'pct' => 2.10],
                    ];
                    foreach ($breakdown as $row):
                    ?>
                        <tr>
                            <td class="ps-3 fw-bold text-dark font-monospace"><?= htmlspecialchars($row['code']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td class="text-center font-monospace"><?= number_format($row['enrolled']) ?></td>
                            <td class="text-center text-danger font-monospace"><?= number_format($row['fail']) ?></td>
                            <td class="text-center text-warning font-monospace"><?= number_format($row['absence']) ?></td>
                            <td class="text-center text-info font-monospace"><?= number_format($row['geo']) ?></td>
                            <td class="text-center fw-bold text-danger pe-3 font-monospace">
                                <?= number_format($row['high']) ?> <small class="text-muted">(<?= number_format($row['pct'], 2) ?>%)</small>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
