<?php

/**
 * View for Smart Student Health Monitoring and Clinic Management System
 */
$currentTitle = $sectionTitle ?? $moduleName;
$categoryTag = $sectionCategory ?? null;
$badgeTag = $headerTag ?? null;
?>

<!-- DATA PRIVACY ACT COMPLIANCE BANNER (RA 10173 MANDATORY) -->
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="bi bi-shield-lock-fill fs-3 text-warning"></i>
    <div>
        <strong class="d-block text-dark">Confidentiality Protected under Republic Act 10173 (Data Privacy Act of 2012)</strong>
        <span class="small text-muted">All health consultations, medical evaluations, and clinic records in this module are strictly confidential. Unauthorized disclosure or tampering is punishable under Philippine Law. Access is continuously logged.</span>
    </div>
</div>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <div class="d-flex align-items-center gap-2">
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-0">
                <i class="bi bi-heart-pulse-fill me-2 text-danger"></i><?= e($currentTitle) ?>
            </h1>
            <?php if (!empty($badgeTag)): ?>
                <span class="badge bg-warning text-dark font-monospace"><?= e($badgeTag) ?></span>
            <?php endif; ?>
        </div>
        <p class="text-muted small mb-0 mt-1">
            <?= !empty($categoryTag) ? e($categoryTag) . ' &bull; ' : '' ?>Student Health Profile & Clinic Records strictly compliant with RA 10173.
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('health') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-person-vcard me-1"></i>Health Profile
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRecordModal">
            <i class="bi bi-plus-lg me-1"></i>New Entry
        </button>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Clinic Entries</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($records) ?></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Active Cases</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                        <?= count(array_filter($records, fn($r) => ($r['status'] ?? '') === 'active')) ?>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Clinic Section</div>
                    <div class="h5 font-weight-bold mb-0 text-secondary"><?= e($categoryTag ?? 'Main Hub') ?></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-hospital"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Clinic Management Quick Modules Grid -->
<div class="row g-3 mb-4">
    <!-- 1. Student Health Profile -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-marsu-burgundy text-white py-2 d-flex align-items-center justify-content-between">
                <span class="fw-bold small"><i class="bi bi-person-vcard me-2"></i>Student Health Profile</span>
                <span class="badge bg-gold text-dark" style="font-size: 0.65rem;">PROFILE MANAGEMENT</span>
            </div>
            <div class="list-group list-group-flush small">
                <a href="<?= url('health/patient-registration') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'patient-registration-hsso' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-file-earmark-person me-2 text-danger"></i>Patient Registration (HSSO)</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/student-info-hub') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'student-info-hub' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-info-circle me-2 text-primary"></i>Student Info Hub</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/health-statistics') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'health-statistics' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-bar-chart me-2 text-success"></i>Health Statistics</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Consultation Mgmt -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-marsu-burgundy text-white py-2 d-flex align-items-center justify-content-between">
                <span class="fw-bold small"><i class="bi bi-clipboard2-pulse me-2"></i>Consultation Mgmt</span>
                <span class="badge bg-gold text-dark" style="font-size: 0.65rem;">CONSULTATIONS</span>
            </div>
            <div class="list-group list-group-flush small">
                <a href="<?= url('health/medical-assessment') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'medical-assessment' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-clipboard2-check me-2 text-info"></i>Medical Assessment</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/treatment-records') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'treatment-records' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-file-medical me-2 text-warning"></i>Treatment Records</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 3. Appointment & Schedule -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-marsu-burgundy text-white py-2 d-flex align-items-center justify-content-between">
                <span class="fw-bold small"><i class="bi bi-calendar-check me-2"></i>Appointment & Schedule</span>
                <span class="badge bg-gold text-dark" style="font-size: 0.65rem;">APPOINTMENTS</span>
            </div>
            <div class="list-group list-group-flush small">
                <a href="<?= url('health/consultation-requests') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'consultation-requests' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-calendar-plus me-2 text-primary"></i>Consultation Requests</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/appointments-list') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'list-of-appointments' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-calendar-week me-2 text-success"></i>List of Appointments</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/queue-management') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'queue-management' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-people me-2 text-danger"></i>Queue Management</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/reminders') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'reminders' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-bell me-2 text-warning"></i>Reminders</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 4. Health Monitoring -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-marsu-burgundy text-white py-2 d-flex align-items-center justify-content-between">
                <span class="fw-bold small"><i class="bi bi-heart-pulse me-2"></i>Health Monitoring</span>
                <span class="badge bg-gold text-dark" style="font-size: 0.65rem;">MONITORING</span>
            </div>
            <div class="list-group list-group-flush small">
                <a href="<?= url('health/vital-signs') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'vital-signs-recording' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-activity me-2 text-danger"></i>Vital Signs Recording</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/screening-results') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'screening-results' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-file-earmark-medical me-2 text-primary"></i>Screening Results</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/immunization-tracking') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'immunization-tracking' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-shield-plus me-2 text-success"></i>Immunization Tracking</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/health-risk-monitoring') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'health-risk-monitoring' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-exclamation-triangle me-2 text-warning"></i>Health Risk Monitoring</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 5. Reports & Analytics -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-marsu-burgundy text-white py-2 d-flex align-items-center justify-content-between">
                <span class="fw-bold small"><i class="bi bi-graph-up-arrow me-2"></i>Reports & Analytics</span>
                <span class="badge bg-gold text-dark" style="font-size: 0.65rem;">REPORTS &amp; ANALYTICS</span>
            </div>
            <div class="list-group list-group-flush small">
                <a href="<?= url('health/common-health-concerns') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'common-health-concerns' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-pie-chart me-2 text-info"></i>Common Health Concerns</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/clinic-utilization') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'clinic-utilization' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-bar-chart-line me-2 text-primary"></i>Clinic Utilization</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/program-evaluation') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'program-evaluation' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-clipboard-data me-2 text-success"></i>Program Evaluation</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 6. Health Services Mgmt -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-marsu-burgundy text-white py-2 d-flex align-items-center justify-content-between">
                <span class="fw-bold small"><i class="bi bi-boxes me-2"></i>Health Services Mgmt</span>
                <span class="badge bg-gold text-dark" style="font-size: 0.65rem;">SERVICES MGMT</span>
            </div>
            <div class="list-group list-group-flush small">
                <a href="<?= url('health/inventory-supplies') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'inventory-medical-supplies' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-box-seam me-2 text-secondary"></i>Inventory &amp; Medical Supplies</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/medicine-dispensing') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'medicine-dispensing' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-capsule me-2 text-danger"></i>Medicine Dispensing</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
                <a href="<?= url('health/staff-schedule') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between <?= ($activeSection ?? '') === 'clinic-staff-schedule' ? 'active text-white bg-marsu-burgundy' : '' ?>">
                    <span><i class="bi bi-person-badge me-2 text-info"></i>Clinic Staff Schedule</span>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Records Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-table me-2"></i><?= e($currentTitle) ?> Records Directory
        </h6>
        <div class="input-group input-group-sm w-auto">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" id="tableFilterInput" placeholder="Filter records...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="moduleDataTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Title / Subject</th>
                        <th>Description / Remarks</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-1 text-gold"></i>
                                No records logged yet in <code>hth_records</code>. Click "New Entry" to add one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-bold text-marsu-burgundy"><?= e($r['title']) ?></td>
                                <td class="small text-muted"><?= e($r['description'] ?? 'No description') ?></td>
                                <td>
                                    <?php if (($r['status'] ?? '') === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= e(ucfirst($r['status'] ?? 'pending')) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted"><?= e(date('M d, Y h:i A', strtotime($r['created_at']))) ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing entry #<?= $r['id'] ?>')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Entry -->
<div class="modal fade" id="newRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Log <?= e($currentTitle) ?> Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('health/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title / Subject <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Health Profile Intake / Medical Checkup">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description / Observations</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter clinical notes, observation remarks, or intake records..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-check-lg me-1"></i>Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterInput = document.getElementById('tableFilterInput');
        const table = document.getElementById('moduleDataTable');
        if (filterInput && table) {
            filterInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });
            });
        }
    });
</script>