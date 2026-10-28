<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 3 - Attendance and Engagement Monitoring
 * View: Student Conduct & Behavioral Incident Roster (behaviorrecords.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
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

            <?php if (can('retention.faculty.behavior')): ?>
            <button type="button" class="btn btn-sm btn-warning fw-semibold text-dark" data-bs-toggle="modal" data-bs-target="#newIncidentModal">
                <i class="bi bi-exclamation-octagon me-1"></i> Log Behavior Incident
            </button>
            <?php endif; ?>
        </div>
    </div>


    <!-- Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-file-earmark-person me-1"></i> Behavioral Incident & Conduct Roster
            </h6>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="behaviorSearchInput" class="form-control form-control-sm" placeholder="Search ID, Name, or Incident..." style="width: 250px;">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="behaviorTable" style="font-size: 13px;">
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
                            <tr class="behavior-row">
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
                                    <div class="d-flex justify-content-end align-items-center gap-1">
                                        <a href="profile?student_id=<?= urlencode($row['student_id'] ?? '') ?>" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 11.5px;">
                                            Profile
                                        </a>
                                        <?php if (can('retention.admin.conduct')): ?>
                                            <button type="button" class="btn btn-sm btn-outline-dark py-0 px-2" style="font-size: 11.5px;" 
                                                    onclick="openConductStatusModal(<?= (int) $row['id'] ?>, '<?= e(addslashes($row['full_name'] ?? 'Student')) ?>', '<?= e($row['status'] ?? 'Reported') ?>')">
                                                Status
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-warning py-0 px-2 text-dark" style="font-size: 11.5px;" 
                                                    onclick="openConductSeverityModal(<?= (int) $row['id'] ?>, '<?= e(addslashes($row['full_name'] ?? 'Student')) ?>', '<?= e($row['severity'] ?? 'Minor') ?>')">
                                                Severity
                                            </button>
                                        <?php endif; ?>
                                    </div>
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
        <!-- Server-Side Table Pagination -->
        <?= $pagination['html'] ?? '' ?>
    </div>
</div>

<?php if (can('retention.faculty.behavior')): ?>
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
<?php endif; ?>

<!-- Modal: Update Conduct Case Status (Part E9) -->
<div class="modal fade" id="conductStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form id="conductStatusForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-dark text-white">
                    <h6 class="modal-title fw-bold mb-0">
                        <i class="bi bi-arrow-repeat me-1"></i> Update Case Status
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <p class="small text-secondary mb-3">
                        Updating status for student incident: <strong class="text-dark" id="statusStudentName"></strong>
                    </p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Case Status <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" name="status" id="conductStatusSelect" required>
                            <option value="Reported">Reported</option>
                            <option value="Under Investigation">Under Investigation</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Dismissed">Dismissed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Resolution / Investigation Notes</label>
                        <textarea class="form-control form-control-sm" name="resolution_notes" rows="3" placeholder="Document counseling outcome, disciplinary action, or dismissal grounds..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-dark px-3">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Reclassify Incident Severity (Part E9) -->
<div class="modal fade" id="conductSeverityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form id="conductSeverityForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-warning text-dark">
                    <h6 class="modal-title fw-bold mb-0">
                        <i class="bi bi-shield-exclamation me-1"></i> Reclassify Incident Severity
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <p class="small text-secondary mb-3">
                        Reclassifying incident severity for student: <strong class="text-dark" id="severityStudentName"></strong>
                    </p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">New Severity Level <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" name="severity" id="conductSeveritySelect" required>
                            <option value="Minor">Minor (First Warning)</option>
                            <option value="Moderate">Moderate (Repeated Disruption)</option>
                            <option value="Severe">Severe (Major Misconduct)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Administrative Justification <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" name="reason" rows="3" required minlength="10" placeholder="Provide institutional basis for reclassifying severity (min 10 characters)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark px-3 fw-semibold">Confirm Reclassification</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
window.openConductStatusModal = function(id, studentName, currentStatus) {
    document.getElementById('statusStudentName').textContent = studentName;
    document.getElementById('conductStatusSelect').value = currentStatus;
    document.getElementById('conductStatusForm').action = '<?= url('retention/admin/conduct') ?>/' + id + '/status';
    new bootstrap.Modal(document.getElementById('conductStatusModal')).show();
};

window.openConductSeverityModal = function(id, studentName, currentSeverity) {
    document.getElementById('severityStudentName').textContent = studentName;
    document.getElementById('conductSeveritySelect').value = currentSeverity;
    document.getElementById('conductSeverityForm').action = '<?= url('retention/admin/conduct') ?>/' + id + '/severity';
    new bootstrap.Modal(document.getElementById('conductSeverityModal')).show();
};
</script>

