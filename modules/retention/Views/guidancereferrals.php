<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
    </style>

    <!-- STATUTORY DATA PRIVACY ACT WARNING BANNER (RA 10173) -->
    <div class="alert alert-warning border-warning d-flex align-items-center mb-3 p-3 shadow-sm rounded-3">
        <i class="bi bi-shield-lock-fill fs-3 text-warning me-3"></i>
        <div>
            <h6 class="fw-bold text-dark mb-1">
                <i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> CONFIDENTIAL LEVEL RECORD — DATA PRIVACY ACT OF 2012 (RA 10173)
            </h6>
            <small class="text-dark d-block">
                All guidance referral records, counselor notes, and student intake evaluations contained herein are strictly protected. Unauthorized disclosure, copying, or dissemination of student mental health and behavioral referral data is strictly prohibited and subject to institutional disciplinary action and legal penalties.
            </small>
        </div>
    </div>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-person-exclamation me-1"></i> Guidance & Counseling Referral Management
            </h6>
            <small class="text-muted">Inter-departmental student referral, mental health intake, and counseling case logs.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="search" name="q" class="form-control form-control-sm" placeholder="Search referral or ID..." value="<?= htmlspecialchars($search ?? '') ?>" style="width: 180px;">
                <select name="severity" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Severities</option>
                    <option value="Critical" <?= (isset($severity) && $severity === 'Critical') ? 'selected' : '' ?>>Critical</option>
                    <option value="High" <?= (isset($severity) && $severity === 'High') ? 'selected' : '' ?>>High</option>
                    <option value="Medium" <?= (isset($severity) && $severity === 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="Low" <?= (isset($severity) && $severity === 'Low') ? 'selected' : '' ?>>Low</option>
                </select>
            </form>

            <button type="button" class="btn btn-sm btn-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#newReferralModal">
                <i class="bi bi-plus-lg me-1"></i> Create Guidance Referral
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Critical Referrals</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $criticalCount ?? 0 ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Immediate Action</span>
                </div>
                <small class="text-muted mt-2 d-block">Urgent counselor intake required</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Pending Intake</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $pendingCount ?? 0 ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Awaiting Counselor</span>
                </div>
                <small class="text-muted mt-2 d-block">Referrals awaiting initial session</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">In Counseling</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= $activeCounselingCount ?? 0 ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Active Support</span>
                </div>
                <small class="text-muted mt-2 d-block">Ongoing counseling sessions</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Resolved Cases</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $resolvedCount ?? 0 ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">Closed</span>
                </div>
                <small class="text-muted mt-2 d-block">Successfully completed interventions</small>
            </div>
        </div>
    </div>

    <!-- Ledger Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-shield-exclamation me-1"></i> Confidential Guidance Referral Case Directory
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student Details</th>
                        <th class="py-3">Program & Section</th>
                        <th class="py-3">Referral Reason</th>
                        <th class="py-3 text-center">Severity Level</th>
                        <th class="py-3">Referred By</th>
                        <th class="py-3 text-center">Case Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($referralsList)): ?>
                        <?php foreach ($referralsList as $row): ?>
                            <tr>
                                <td class="ps-3 fw-semibold text-dark">
                                    <div><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['student_id'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['department'] ?? 'BSIS') ?></span>
                                    <small class="text-muted d-block">Year <?= htmlspecialchars((string)($row['year_level'] ?? 1)) ?></small>
                                </td>
                                <td class="fw-medium text-dark">
                                    <?= htmlspecialchars($row['referral_reason'] ?? 'Academic stress & attendance drop') ?>
                                    <small class="text-muted d-block">Referred: <?= htmlspecialchars($row['referred_at'] ?? date('Y-m-d')) ?></small>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $sev = $row['severity_level'] ?? 'Medium';
                                    $sevBadge = ($sev === 'Critical' || $sev === 'High') ? 'bg-danger text-white' : (($sev === 'Medium') ? 'bg-warning text-dark' : 'bg-info text-dark');
                                    ?>
                                    <span class="badge <?= $sevBadge ?>"><?= htmlspecialchars($sev) ?></span>
                                </td>
                                <td>
                                    <i class="bi bi-person-badge me-1 text-primary"></i>
                                    <?= htmlspecialchars($row['referred_by_name'] ?? 'Faculty Member') ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $st = $row['status'] ?? 'Pending Intake';
                                    $stBadge = ($st === 'Resolved') ? 'bg-success-subtle text-success border border-success' : (($st === 'In Counseling') ? 'bg-info-subtle text-info border border-info' : 'bg-warning-subtle text-dark border border-warning');
                                    ?>
                                    <span class="badge <?= $stBadge ?>"><?= htmlspecialchars($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($row['student_id'] ?? '') ?>" class="btn btn-sm btn-outline-primary" title="View Confidential Dossier">
                                        Dossier
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-shield-check fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No active guidance referral cases</p>
                                <small>All student cases are handled or no referrals have been submitted.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Guidance Referral -->
<div class="modal fade" id="newReferralModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-person-plus-fill me-1"></i> Submit Guidance & Counseling Referral
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="guidance">
                <div class="modal-body p-4 bg-light">
                    <!-- Warning Notice in Modal -->
                    <div class="alert alert-danger border-danger small mb-3">
                        <i class="bi bi-shield-exclamation me-1"></i>
                        <strong>Confidentiality Notice:</strong> Information submitted in this referral form will be directly routed to the Guidance & Counseling Office. Please ensure factual accuracy.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT ID / NUMBER</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">SEVERITY LEVEL</label>
                            <select name="severity_level" class="form-select form-select-sm" required>
                                <option value="Low">Low (Routine Check-in)</option>
                                <option value="Medium" selected>Medium (Noticeable Grade / Attendance Drop)</option>
                                <option value="High">High (Behavioral Distress / Emotional Crisis)</option>
                                <option value="Critical">Critical (Immediate Harm / Severe Crisis)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">PRIMARY REASON FOR REFERRAL</label>
                        <textarea name="referral_reason" class="form-control form-control-sm" rows="3" placeholder="Describe specific observed indicators (e.g. 4 consecutive unexcused absences, sudden drop in academic performance, emotional distress)..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">INITIAL OBSERVATIONS & RECOMMENDATIONS</label>
                        <textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="e.g. Student appeared unmotivated during recitation, requested one-on-one session with guidance counselor"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger px-4 fw-semibold">Submit Confidential Referral</button>
                </div>
            </form>
        </div>
    </div>
</div>
