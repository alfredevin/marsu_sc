<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
    </style>

    <!-- 1. CONCISE HEADER & SINGLE-LINE FILTER BAR -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">Academic Progress & Curricular Milestone Audit</h6>
            <small class="text-muted">Degree completion pacing, units earned audit, and Maximum Residency Rule (MRR) projection.</small>
        </div>

        <form method="GET" action="" class="d-flex align-items-center gap-2 flex-wrap ms-auto">
            <!-- Program -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap">PROGRAM:</label>
            <select name="department" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="">All Programs</option>
                <?php foreach ($departments as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= $department === $dept ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                <?php endforeach; ?>
            </select>

            <!-- Year Level -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">YEAR LEVEL:</label>
            <select name="year_level" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="">All Years</option>
                <option value="1" <?= $yearLevel === '1' ? 'selected' : '' ?>>1st Year</option>
                <option value="2" <?= $yearLevel === '2' ? 'selected' : '' ?>>2nd Year</option>
                <option value="3" <?= $yearLevel === '3' ? 'selected' : '' ?>>3rd Year</option>
                <option value="4" <?= $yearLevel === '4' ? 'selected' : '' ?>>4th Year</option>
            </select>

            <!-- Section -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SECTION:</label>
            <select name="section" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="">All Sections</option>
                <?php foreach ($sections as $sec): ?>
                        <option value="<?= htmlspecialchars($sec) ?>" <?= $section === $sec ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sec) ?>
                        </option>
                <?php endforeach; ?>
            </select>

            <!-- Milestone Status -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">STATUS:</label>
            <select name="status" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <?php foreach ($statusOptions as $st): ?>
                        <option value="<?= htmlspecialchars($st) ?>" <?= $status === $st ? 'selected' : '' ?>>
                            <?= htmlspecialchars($st) ?>
                        </option>
                <?php endforeach; ?>
            </select>

            <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print
            </button>
        </form>
    </div>

    <!-- 2. STRATEGIC KPI SUMMARY CARDS -->
    <div class="row g-3 mb-4">
        <!-- On-Track Ratio -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Cohort On-Track Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $onTrackRate ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">Target: ≥ 80%</span>
                </div>
                <small class="text-muted mt-2 d-block">Students meeting standard curriculum pacing</small>
            </div>
        </div>

        <!-- Average Curriculum Completion -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Average Degree Progress</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= $avgProgress ?>%</h3>
                    <span class="badge bg-light text-secondary border">Total: 146 Units</span>
                </div>
                <small class="text-muted mt-2 d-block">Overall curricular completion across cohort</small>
            </div>
        </div>

        <!-- Delayed / MRR Risk -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Unit Backlog / Delayed</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $delayedCount ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Requires Advising</span>
                </div>
                <small class="text-muted mt-2 d-block">Students flagged with academic delay or MRR risk</small>
            </div>
        </div>

        <!-- Graduating Candidates -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Graduating Candidates</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $graduatingCount ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Senior Cohort</span>
                </div>
                <small class="text-muted mt-2 d-block">Senior students reaching degree completion</small>
            </div>
        </div>
    </div>

    <!-- 3. PER-STUDENT DEGREE COMPLETION & MILESTONE AUDIT TABLE -->
    <div class="card border rounded-3 shadow-sm bg-white mb-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-person-check-fill me-1"></i> Per-Student Degree Completion & Milestone Audit
            </h6>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="studentSearchInput" class="form-control form-control-sm" placeholder="Search ID or Name..." style="width: 220px;" onkeyup="filterProgressTable()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="progressTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3">Degree Program</th>
                        <th class="py-3 text-center">Year & Section</th>
                        <th class="py-3" style="min-width: 200px;">Curriculum Progress</th>
                        <th class="py-3 text-center">Units Earned / Total</th>
                        <th class="py-3 text-center">Milestone Status</th>
                        <th class="py-3 text-center">Projected Grad</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($progressList)): ?>
                            <?php foreach ($progressList as $row): ?>
                                    <?php
                                    $statusBadgeClass = 'bg-success-subtle text-success border border-success-subtle';
                                    if ($row['milestone_status'] === 'Delayed') {
                                        $statusBadgeClass = 'bg-warning-subtle text-dark border border-warning-subtle';
                                    } elseif ($row['milestone_status'] === 'Critical / MRR Risk') {
                                        $statusBadgeClass = 'bg-danger-subtle text-danger border border-danger-subtle';
                                    } elseif ($row['milestone_status'] === 'Graduating Candidate') {
                                        $statusBadgeClass = 'bg-info-subtle text-info border border-info-subtle';
                                    }

                                    $barColor = 'bg-success';
                                    if ($row['percent_progress'] < 50)
                                        $barColor = 'bg-warning';
                                    if ($row['milestone_status'] === 'Critical / MRR Risk')
                                        $barColor = 'bg-danger';
                                    ?>
                                    <tr class="progress-row">
                                        <td class="ps-3 fw-bold text-secondary id-cell">
                                            <?= htmlspecialchars($row['student_id']) ?>
                                        </td>
                                        <td class="name-cell fw-semibold text-dark">
                                            <?= htmlspecialchars($row['full_name']) ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['department']) ?></span>
                                        </td>
                                        <td class="text-center text-muted">
                                            Year <?= htmlspecialchars($row['year_level']) ?> - <?= htmlspecialchars($row['section']) ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-1 small">
                                                <span class="fw-semibold"><?= $row['percent_progress'] ?>%</span>
                                                <span class="text-muted" style="font-size: 11px;">Completed</span>
                                            </div>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar <?= $barColor ?>" role="progressbar" style="width: <?= $row['percent_progress'] ?>%;"></div>
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold">
                                            <?= $row['units_earned'] ?> <span class="text-muted fw-normal">/ <?= $row['total_units'] ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $statusBadgeClass ?>">
                                                <?= htmlspecialchars($row['milestone_status']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center fw-bold text-dark">
                                            <?= $row['target_grad_year'] ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                    <li>
                                                        <a class="dropdown-item small" href="academichistory?student_id=<?= urlencode($row['student_id']) ?>">
                                                            <i class="bi bi-clock-history me-2 text-primary"></i> Academic History
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item small" href="advisingrecords?student_id=<?= urlencode($row['student_id']) ?>">
                                                            <i class="bi bi-card-checklist me-2 text-warning"></i> Study Plan / Advising
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item small text-danger" href="guidancereferrals?student_id=<?= urlencode($row['student_id']) ?>">
                                                            <i class="bi bi-person-exclamation me-2"></i> Refer to Guidance
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            <?php endforeach; ?>
                    <?php else: ?>
                            <!-- Standard MarSU Empty State Box -->
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    <p class="mb-0 fw-semibold">No academic progress records found</p>
                                    <small>No student enrollment records matched the selected filters, or registrar data has not yet synced.</small>
                                </td>
                            </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Instant Search Filter -->
<script>
function filterProgressTable() {
    const input = document.getElementById('studentSearchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.progress-row');

    rows.forEach(row => {
        const idText = row.querySelector('.id-cell')?.innerText.toLowerCase() || '';
        const nameText = row.querySelector('.name-cell')?.innerText.toLowerCase() || '';
        if (idText.includes(input) || nameText.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>