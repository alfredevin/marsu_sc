<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-shield-slash-fill me-1"></i> Behavioral Records & Student Conduct Logs
            </h6>
            <small class="text-muted">Documentation of student disciplinary logs, classroom conduct notices, and behavioral risk flags.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="search" name="q" class="form-control form-control-sm" placeholder="Search incident or ID..." value="<?= htmlspecialchars($search ?? '') ?>" style="width: 180px;">
                <select name="severity" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Severities</option>
                    <option value="Minor" <?= (isset($severity) && $severity === 'Minor') ? 'selected' : '' ?>>Minor</option>
                    <option value="Moderate" <?= (isset($severity) && $severity === 'Moderate') ? 'selected' : '' ?>>Moderate</option>
                    <option value="Severe" <?= (isset($severity) && $severity === 'Severe') ? 'selected' : '' ?>>Severe</option>
                </select>
            </form>

            <button type="button" class="btn btn-sm btn-warning fw-semibold text-dark" data-bs-toggle="modal" data-bs-target="#newIncidentModal">
                <i class="bi bi-exclamation-octagon me-1"></i> Log Behavior Incident
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Total Behavior Logs</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $totalIncidents ?? count($behaviorList ?? []) ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Recorded</span>
                </div>
                <small class="text-muted mt-2 d-block">Reported conduct incidents</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Severe Violations</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $severeCount ?? 0 ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">OSA Escalation</span>
                </div>
                <small class="text-muted mt-2 d-block">Requires Student Affairs review</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Under Investigation</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= $investigationCount ?? 0 ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">In Review</span>
                </div>
                <small class="text-muted mt-2 d-block">Pending fact-finding session</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Resolved / Counseling</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $resolvedCount ?? 0 ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">Closed</span>
                </div>
                <small class="text-muted mt-2 d-block">Rehabilitation plan completed</small>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-file-earmark-person me-1"></i> Behavioral Incident & Conduct Roster
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student Details</th>
                        <th class="py-3">Incident Type</th>
                        <th class="py-3">Description</th>
                        <th class="py-3 text-center">Severity</th>
                        <th class="py-3">Incident Date</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($behaviorList)): ?>
                        <?php foreach ($behaviorList as $row): ?>
                            <tr>
                                <td class="ps-3 fw-semibold text-dark">
                                    <div><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['student_id'] ?? '') ?></small>
                                </td>
                                <td class="fw-bold text-dark">
                                    <?= htmlspecialchars($row['incident_type'] ?? 'Classroom Disruption') ?>
                                </td>
                                <td>
                                    <small class="text-dark d-block text-truncate" style="max-width: 300px;"><?= htmlspecialchars($row['description'] ?? 'No additional details provided.') ?></small>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $sev = $row['severity'] ?? 'Minor';
                                    $badge = ($sev === 'Severe') ? 'bg-danger text-white' : (($sev === 'Moderate') ? 'bg-warning text-dark' : 'bg-secondary text-white');
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= htmlspecialchars($sev) ?></span>
                                </td>
                                <td>
                                    <i class="bi bi-calendar-event me-1 text-secondary"></i>
                                    <?= htmlspecialchars($row['incident_date'] ?? date('Y-m-d')) ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $st = $row['status'] ?? 'Reported';
                                    $stBadge = ($st === 'Resolved') ? 'bg-success-subtle text-success border border-success' : (($st === 'Under Investigation') ? 'bg-info-subtle text-info border border-info' : 'bg-warning-subtle text-dark border border-warning');
                                    ?>
                                    <span class="badge <?= $stBadge ?>"><?= htmlspecialchars($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($row['student_id'] ?? '') ?>" class="btn btn-sm btn-outline-primary">
                                        Profile
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-shield-check fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No behavioral incident logs recorded</p>
                                <small>All students have clean conduct records.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Incident Log -->
<div class="modal fade" id="newIncidentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Log Student Behavior Incident
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="behavior">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT ID / NUMBER</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">INCIDENT DATE</label>
                            <input type="date" name="incident_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">INCIDENT TYPE</label>
                            <input type="text" name="incident_type" class="form-control form-control-sm" placeholder="e.g. Chronic Tardiness / Classroom Disruption" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">SEVERITY LEVEL</label>
                            <select name="severity" class="form-select form-select-sm" required>
                                <option value="Minor">Minor (First Warning)</option>
                                <option value="Moderate">Moderate (Repeated Disruption)</option>
                                <option value="Severe">Severe (Major Misconduct)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">INCIDENT DESCRIPTION & OBSERVATIONS</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Provide factual description of the incident..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark px-4 fw-semibold">Save Conduct Log</button>
                </div>
            </form>
        </div>
    </div>
</div>
