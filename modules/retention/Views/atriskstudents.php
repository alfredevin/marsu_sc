<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-shield-exclamation me-1"></i> Early Warning System — At-Risk Students Roster
            </h6>
            <small class="text-muted">Algorithmic risk detection based on GPA drops, chronic absences, and deficiency logs.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="search" name="q" class="form-control form-control-sm" placeholder="Search ID or Name..." value="<?= htmlspecialchars($search ?? '') ?>" style="width: 180px;">
                <select name="risk_level" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Risk Levels</option>
                    <option value="High" <?= (isset($riskLevel) && $riskLevel === 'High') ? 'selected' : '' ?>>High Risk</option>
                    <option value="Moderate" <?= (isset($riskLevel) && $riskLevel === 'Moderate') ? 'selected' : '' ?>>Moderate Risk</option>
                    <option value="Low" <?= (isset($riskLevel) && $riskLevel === 'Low') ? 'selected' : '' ?>>Low Risk</option>
                </select>
                <select name="department" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <button type="button" class="btn btn-sm btn-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#flagRiskModal">
                <i class="bi bi-flag-fill me-1"></i> Flag At-Risk Student
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">High Risk (Critical)</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $highRiskCount ?? 0 ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Urgent Intervention</span>
                </div>
                <small class="text-muted mt-2 d-block">Retention danger / dropout risk</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Moderate Risk</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $moderateRiskCount ?? 0 ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Monitored</span>
                </div>
                <small class="text-muted mt-2 d-block">Academic performance decline</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Under Intervention</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= $underInterventionCount ?? 0 ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">In Progress</span>
                </div>
                <small class="text-muted mt-2 d-block">Assigned to guidance or tutoring</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Total Evaluated Cohort</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $totalRiskEvaluated ?? count($riskList ?? []) ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">Audited</span>
                </div>
                <small class="text-muted mt-2 d-block">Students screened for risk factors</small>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-shield-lock me-1"></i> Early Warning Watchlist & Risk Score Matrix
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student Details</th>
                        <th class="py-3">Program & Section</th>
                        <th class="py-3 text-center">Risk Level</th>
                        <th class="py-3 text-center">Risk Score</th>
                        <th class="py-3">Identified Risk Factors</th>
                        <th class="py-3 text-center">Intervention Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riskList)): ?>
                        <?php foreach ($riskList as $row): ?>
                            <tr>
                                <td class="ps-3 fw-semibold text-dark">
                                    <div><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['student_id'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['department'] ?? 'BSIS') ?></span>
                                    <small class="text-muted d-block">Year <?= htmlspecialchars((string)($row['year_level'] ?? 1)) ?></small>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $rl = $row['risk_level'] ?? 'Moderate';
                                    $rlBadge = ($rl === 'High') ? 'bg-danger text-white' : (($rl === 'Moderate') ? 'bg-warning text-dark' : 'bg-info text-dark');
                                    ?>
                                    <span class="badge <?= $rlBadge ?>"><?= htmlspecialchars($rl) ?> Risk</span>
                                </td>
                                <td class="text-center fw-bold fs-6 text-dark">
                                    <?= number_format((float)($row['risk_score'] ?? 75.0), 1) ?>%
                                </td>
                                <td>
                                    <small class="text-muted d-block"><?= htmlspecialchars($row['risk_factors'] ?? 'Multiple failing marks, attendance drop') ?></small>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $st = $row['status'] ?? 'Active';
                                    $stBadge = ($st === 'Mitigated' || $st === 'Resolved') ? 'bg-success-subtle text-success border border-success' : 'bg-danger-subtle text-danger border border-danger';
                                    ?>
                                    <span class="badge <?= $stBadge ?>"><?= htmlspecialchars($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item small" href="profile?student_id=<?= urlencode($row['student_id'] ?? '') ?>">
                                                    <i class="bi bi-person me-2 text-primary"></i> View Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item small" href="guidancereferrals?student_id=<?= urlencode($row['student_id'] ?? '') ?>">
                                                    <i class="bi bi-person-exclamation me-2 text-danger"></i> Refer to Guidance
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item small" href="academicsupportprograms?student_id=<?= urlencode($row['student_id'] ?? '') ?>">
                                                    <i class="bi bi-mortarboard me-2 text-success"></i> Endorse to Tutoring
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-shield-check fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No high risk students detected</p>
                                <small>All evaluated students are currently in good standing.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Flag At-Risk Student -->
<div class="modal fade" id="flagRiskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-flag-fill me-1"></i> Flag Student as At-Risk
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="risk">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT ID / NUMBER</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">ASSESSED RISK LEVEL</label>
                            <select name="risk_level" class="form-select form-select-sm" required>
                                <option value="High">High Risk (Immediate Drop Out / Failure Danger)</option>
                                <option value="Moderate" selected>Moderate Risk (Academic Decline / Unexcused Absences)</option>
                                <option value="Low">Low Risk (Monitored)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">IDENTIFIED RISK FACTORS & CONCERNS</label>
                        <textarea name="risk_factors" class="form-control form-control-sm" rows="3" placeholder="Specify indicators (e.g. Failed IT211 midterm, 5 absences, non-submission of projects)..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger px-4 fw-semibold">Flag & Save Risk Alert</button>
                </div>
            </form>
        </div>
    </div>
</div>
