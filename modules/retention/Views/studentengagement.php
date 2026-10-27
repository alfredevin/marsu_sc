<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-activity me-1"></i> Coursework Submission Compliance & Engagement Audit
            </h6>
            <small class="text-muted">Audit of student assignment and lab submissions derived directly from faculty class records and grade sheets.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print Engagement Audit
            </button>
            <a href="<?= url('retention/gradestracking') ?>" class="btn btn-sm marsu-maroon-bg text-white fw-semibold">
                <i class="bi bi-journal-text me-1"></i> Open Faculty Class Records
            </a>
        </div>
    </div>

    <!-- Active Filters Form -->
    <div class="card border rounded-3 bg-light shadow-sm p-3 mb-4">
        <form method="GET" action="" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-secondary mb-1">SEARCH STUDENT</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="q" class="form-control" placeholder="Search ID or Name..." value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-secondary mb-1">PROGRAM / DEGREE</label>
                <select name="department" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach (($departments ?? ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSIT', 'BSCS']) as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">YEAR LEVEL</label>
                <select name="year_level" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Years</option>
                    <option value="1" <?= (isset($yearLevel) && $yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                    <option value="2" <?= (isset($yearLevel) && $yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                    <option value="3" <?= (isset($yearLevel) && $yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                    <option value="4" <?= (isset($yearLevel) && $yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">SECTION</label>
                <select name="section" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Sections</option>
                    <?php foreach (($sections ?? ['Section A', 'Section B', 'Section C']) as $sec): ?>
                        <option value="<?= htmlspecialchars($sec) ?>" <?= (isset($section) && $section === $sec) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sec) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-dark flex-grow-1"><i class="bi bi-funnel me-1"></i> Filter</button>
                <a href="<?= url('retention/studentengagement') ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filters"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>

    <!-- 4 KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Cohort Submission Compliance</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($submitRate ?? '88.5')) ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">Good Standing</span>
                </div>
                <small class="text-muted mt-2 d-block">Average coursework turn-in rate</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">100% Complete Submissions</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($highComplianceCount ?? 0)) ?></h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">High Achievers</span>
                </div>
                <small class="text-muted mt-2 d-block">Turned in all class record tasks</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Submission Deficit Flag</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($deficitCount ?? 0)) ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Risk Breached</span>
                </div>
                <small class="text-muted mt-2 d-block">Has multiple unsubmitted tasks</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Monitored Cohort Roster</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= htmlspecialchars((string) ($totalStudents ?? count($engagementList ?? []))) ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Enrolled</span>
                </div>
                <small class="text-muted mt-2 d-block">Filtered students matching criteria</small>
            </div>
        </div>
    </div>

    <!-- Engagement Ledger Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-check2-circle me-1"></i> Student Coursework Submission Ledger
            </h6>
            <span class="badge bg-light text-dark border">Showing <?= count($engagementList ?? []) ?> students</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3" style="width: 140px;">Student Number</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3">Program & Section</th>
                        <th class="py-3 text-center" style="width: 160px;">Submission Velocity</th>
                        <th class="py-3" style="width: 180px;">Completion Score</th>
                        <th class="py-3 text-center" style="width: 140px;">Engagement Tier</th>
                        <th class="py-3 text-center" style="width: 140px;">Last Activity</th>
                        <th class="py-3 text-end pe-3" style="width: 110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($engagementList)): ?>
                        <?php foreach ($engagementList as $row): ?>
                            <?php
                            $score = (float) ($row['engagement_score'] ?? 85.0);
                            $velocity = $row['turnaround_speed'] ?? 'On-Time';
                            $tierText = 'High';
                            $tierBadge = 'bg-success-subtle text-success border border-success';
                            $barClass = 'bg-success';
                            if ($score < 75.0) {
                                $tierText = 'At-Risk';
                                $tierBadge = 'bg-danger-subtle text-danger border border-danger';
                                $barClass = 'bg-danger';
                            } elseif ($score < 88.0) {
                                $tierText = 'Moderate';
                                $tierBadge = 'bg-warning-subtle text-dark border border-warning';
                                $barClass = 'bg-warning text-dark';
                            }
                            ?>
                            <tr>
                                <td class="ps-3 font-monospace fw-semibold text-secondary">
                                    <?= htmlspecialchars($row['student_number'] ?? '') ?>
                                </td>
                                <td class="fw-bold text-dark">
                                    <?= htmlspecialchars($row['full_name'] ?? 'N/A') ?>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border">
                                        <?= htmlspecialchars($row['program_code'] ?? 'BSIS') ?> <?= htmlspecialchars((string)($row['year_level'] ?? '1')) ?>-<?= htmlspecialchars($row['section_name'] ?? 'A') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-clock-history me-1 text-muted"></i> <?= htmlspecialchars($velocity) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px;">
                                            <div class="progress-bar <?= $barClass ?>" role="progressbar" style="width: <?= min(100, $score) ?>%;"></div>
                                        </div>
                                        <span class="small font-monospace fw-semibold"><?= number_format($score, 1) ?>%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $tierBadge ?>"><?= $tierText ?></span>
                                </td>
                                <td class="text-center small text-muted font-monospace">
                                    <?= htmlspecialchars($row['last_activity_date'] ?? date('Y-m-d')) ?>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($row['student_number'] ?? $row['id'] ?? '') ?>" class="btn btn-xs btn-outline-primary" title="View Student Profile">
                                        Profile
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-clipboard-x fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No coursework engagement logs found</p>
                                <small>Adjust filters or refresh to view student submission ledger.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>