<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-ui-checks-grid me-1"></i> Class Record Participation & Task Submission Tracking
            </h6>
            <small class="text-muted">Formative task compliance, missed quizzes & lab activities audits, and recitation participation metrics.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <a href="<?= url('retention/gradestracking') ?>" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-table me-1"></i> Open Grades Matrix
            </a>
            <button type="button" class="btn btn-sm marsu-maroon-bg text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#logTaskExceptionModal">
                <i class="bi bi-plus-lg me-1"></i> Log Task Exception
            </button>
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
                <a href="<?= url('retention/participationtracking') ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filters"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>

    <!-- 4 KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">100% Submission Compliance</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($zeroMissedCount ?? 0)) ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">Complete</span>
                </div>
                <small class="text-muted mt-2 d-block">Zero missed activities or quizzes</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Minor Deficit (1–2 Tasks)</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= htmlspecialchars((string) ($minorMissedCount ?? 0)) ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Monitoring</span>
                </div>
                <small class="text-muted mt-2 d-block">Eligible for special make-up activity</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Critical Inactivity (&ge;3 Tasks)</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($criticalMissedCount ?? 0)) ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Academic Risk</span>
                </div>
                <small class="text-muted mt-2 d-block">Severe formative assessment deficit</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Class Assessment Average</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($avgAssessmentRate ?? '86.4')) ?>%</h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">Institutional Mean</span>
                </div>
                <small class="text-muted mt-2 d-block">Average submission rate across cohort</small>
            </div>
        </div>
    </div>

    <!-- Participation Ledger Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-list-check me-1"></i> Class Record Task Compliance & Missed Assessments Ledger
            </h6>
            <span class="badge bg-light text-dark border">Showing <?= count($participationList ?? []) ?> students</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3" style="width: 140px;">Student Number</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3">Program & Section</th>
                        <th class="py-3 text-center" style="width: 130px;">Quizzes Done</th>
                        <th class="py-3 text-center" style="width: 130px;">Activities & Labs</th>
                        <th class="py-3 text-center" style="width: 120px;">Missed Tasks</th>
                        <th class="py-3" style="width: 170px;">Submission Rate</th>
                        <th class="py-3 text-center" style="width: 130px;">Standing</th>
                        <th class="py-3 text-end pe-3" style="width: 110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($participationList)): ?>
                        <?php foreach ($participationList as $row): ?>
                            <?php
                            $rate = (float) ($row['compliance_rate'] ?? 90.0);
                            $missed = (int) ($row['missed_tasks'] ?? 0);
                            $badgeClass = 'bg-success-subtle text-success border border-success';
                            $statusText = 'On-Track';
                            $barClass = 'bg-success';
                            if ($missed >= 3 || $rate < 75.0) {
                                $badgeClass = 'bg-danger-subtle text-danger border border-danger';
                                $statusText = 'Critical Deficit';
                                $barClass = 'bg-danger';
                            } elseif ($missed > 0 || $rate < 88.0) {
                                $badgeClass = 'bg-warning-subtle text-dark border border-warning';
                                $statusText = 'Minor Deficit';
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
                                <td class="text-center font-monospace text-dark">
                                    <?= htmlspecialchars((string)($row['quizzes_done'] ?? 5)) ?> / <?= htmlspecialchars((string)($row['total_quizzes'] ?? 5)) ?>
                                </td>
                                <td class="text-center font-monospace text-dark">
                                    <?= htmlspecialchars((string)($row['activities_done'] ?? 4)) ?> / <?= htmlspecialchars((string)($row['total_activities'] ?? 4)) ?>
                                </td>
                                <td class="text-center font-monospace <?= $missed > 0 ? 'text-danger fw-bold' : 'text-success' ?>">
                                    <?= $missed ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px;">
                                            <div class="progress-bar <?= $barClass ?>" role="progressbar" style="width: <?= min(100, $rate) ?>%;"></div>
                                        </div>
                                        <span class="small font-monospace fw-semibold"><?= number_format($rate, 1) ?>%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
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
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-clipboard-x fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No participation records found matching criteria</p>
                                <small>Adjust your filter or query to view student submission logs.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Log Task Exception -->
<div class="modal fade" id="logTaskExceptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg text-white">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-clipboard-plus me-1"></i> Log Assessment Task Exception
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="task_exception">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT NUMBER / ID</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">COURSE / SUBJECT CODE</label>
                            <input type="text" name="subject_code" class="form-control form-control-sm" placeholder="e.g. IT211" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">ASSESSMENT CATEGORY</label>
                            <select name="assessment_type" class="form-select form-select-sm" required>
                                <option value="Quiz" selected>Major Quiz</option>
                                <option value="Lab Activity">Laboratory Activity</option>
                                <option value="Assignment">Assignment / Problem Set</option>
                                <option value="Term Project">Midterm / Final Project</option>
                                <option value="Recitation">Graded Recitation</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">EXCEPTION STATUS</label>
                            <select name="exception_status" class="form-select form-select-sm" required>
                                <option value="Unexcused Missed">Unexcused Missed Task (Score 0)</option>
                                <option value="Excused / Makeup Pending">Excused (Make-up Granted)</option>
                                <option value="Late Submission">Late Submission (Penalty Applied)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">REASON & REMEDIATION PLAN</label>
                        <textarea name="remediation_notes" class="form-control form-control-sm" rows="2" placeholder="Specify explanation provided by student and rescheduled submission date..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm marsu-maroon-bg text-white px-4 fw-semibold">Save Exception Log</button>
                </div>
            </form>
        </div>
    </div>
</div>