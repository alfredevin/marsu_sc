<!-- Incident Reporting View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-shield-exclamation me-2 text-gold"></i>Student Incident & Grievance Reporting Desk
        </h1>
        <p class="text-muted small mb-0">Confidential intake for dormitory security infractions, noise complaints, curfew violations, and landlord disputes.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newIncidentModal">
            <i class="bi bi-plus-lg me-1"></i>File Incident Report
        </button>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/announcements') ?>">
                <i class="bi bi-megaphone me-1"></i>Announcements
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/residentsnotifications') ?>">
                <i class="bi bi-bell me-1"></i>Notifications
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/rulesandpolicies') ?>">
                <i class="bi bi-shield-check me-1"></i>Rules & Policies
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/incidentreporting') ?>">
                <i class="bi bi-exclamation-triangle me-1 text-gold"></i>Incident Reporting
            </a>
        </li>
    </ul>
</div>

<!-- Notice on RA 10173 Privacy (Rule #6) -->
<div class="alert alert-info border-info-subtle shadow-sm mb-4 small">
    <i class="bi bi-shield-lock-fill me-2 fs-6"></i>
    <strong>Data Privacy Act of 2012 (RA 10173) Warning:</strong> All incident logs, student statements, and disciplinary reports are classified as strictly confidential. Access is restricted exclusively to authorized MarSU OSAS student affairs officers, the Prefect of Discipline, and housing administrators.
</div>

<!-- Incidents Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-x me-2 text-gold"></i>Incident Logs & Action Taken
        </h6>
        <div class="d-flex gap-2">
            <input type="text" id="incSearchInput" class="form-control form-control-sm" placeholder="Search incident, location..." style="width: 250px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="incTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Case ID</th>
                        <th>Facility & Location</th>
                        <th>Incident Classification</th>
                        <th>Date & Time</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Action Taken</th>
                        <th class="text-end pe-3">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($incidents)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-shield-check fs-2 text-success d-block mb-2"></i>
                                No incident reports logged. Peace and order maintained!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($incidents as $inc): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark">
                                    <i class="bi bi-file-earmark-text text-gold me-1"></i><?= e($inc['incident_no']) ?>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= e($inc['location']) ?></div>
                                    <small class="text-muted">Involved: <?= e($inc['parties_involved']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis"><?= e($inc['incident_type']) ?></span>
                                    <div class="small text-muted text-truncate" style="max-width: 200px;"><?= e($inc['narrative']) ?></div>
                                </td>
                                <td>
                                    <div><?= date('M d, Y', strtotime($inc['incident_date'])) ?></div>
                                    <small class="text-muted"><?= date('h:i A', strtotime($inc['incident_time'])) ?></small>
                                </td>
                                <td>
                                    <?php if ($inc['severity'] === 'Major'): ?>
                                        <span class="badge bg-danger">Major</span>
                                    <?php elseif ($inc['severity'] === 'Moderate'): ?>
                                        <span class="badge bg-warning text-dark">Moderate</span>
                                    <?php else: ?>
                                        <span class="badge bg-info-subtle text-info border">Minor</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($inc['status'] === 'Resolved'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Resolved</span>
                                    <?php elseif ($inc['status'] === 'Referred to OSAS'): ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary"><i class="bi bi-box-arrow-up-right me-1"></i>OSAS Case</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"><i class="bi bi-hourglass me-1"></i><?= e($inc['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-secondary">
                                    <?= e($inc['action_taken'] ?? 'Under review') ?>
                                </td>
                                <td class="text-end pe-3">
                                    <?php if ($inc['status'] !== 'Resolved'): ?>
                                        <form action="<?= url('housing/incidents/status') ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= (int)$inc['id'] ?>">
                                            <input type="hidden" name="status" value="Resolved">
                                            <input type="hidden" name="action_taken" value="Case mediated and resolved amicably.">
                                            <button type="submit" class="btn btn-sm btn-outline-success py-0 px-2" title="Mark Case Resolved">
                                                <i class="bi bi-check-lg"></i> Resolve
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-success small fw-semibold"><i class="bi bi-check-all"></i> Closed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal File Incident -->
<div class="modal fade" id="newIncidentModal" tabindex="-1" aria-labelledby="newIncidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newIncidentModalLabel">
                    <i class="bi bi-shield-lock-fill me-2 text-gold"></i>File Confidential Incident Report
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/incidents/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Incident Classification <span class="text-danger">*</span></label>
                        <select name="incident_type" class="form-select form-select-sm" required>
                            <option value="Curfew Violation">Curfew Violation</option>
                            <option value="Noise Disturbance">Noise Disturbance / Late Night Gathering</option>
                            <option value="Unauthorized Guest">Unauthorized Guest / Visitor Policy Infraction</option>
                            <option value="Facility Misuse">Facility Misuse / Appliance Violation</option>
                            <option value="Sanitation Issue">Sanitation / Cleanliness Dispute</option>
                            <option value="Dispute/Altercation">Roommate Altercation / Conflict</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Facility Location / Room <span class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control form-control-sm" required placeholder="e.g. Villa Marinduque Dorm - Room 202">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Date of Incident</label>
                            <input type="date" name="incident_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Time of Incident</label>
                            <input type="time" name="incident_time" class="form-control form-control-sm" value="<?= date('H:i') ?>" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Severity Level</label>
                            <select name="severity" class="form-select form-select-sm">
                                <option value="Minor" selected>Minor (1st Warning)</option>
                                <option value="Moderate">Moderate (Mediation needed)</option>
                                <option value="Major">Major (Direct OSAS referral)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Parties Involved</label>
                            <input type="text" name="parties_involved" class="form-control form-control-sm" placeholder="Student names / room occupants">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Narrative Statement of Facts <span class="text-danger">*</span></label>
                        <textarea name="narrative" class="form-control form-control-sm" rows="3" placeholder="Factual description of the events that transpired..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Reported By</label>
                        <input type="text" name="reported_by" class="form-control form-control-sm" value="Matron / Desk Officer">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-shield-check me-1"></i>Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('incSearchInput');
    const table = document.getElementById('incTable');
    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }
});
</script>
