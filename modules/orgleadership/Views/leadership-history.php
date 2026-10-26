<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-clock-history me-2 text-gold"></i>Leadership History & Tenure Records
            </h1>
            <p class="text-muted small mb-0">Chronological archive of student officer appointments, leadership positions, and terms served.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createAppointmentModal">
                <i class="bi bi-journal-plus me-1"></i>Record Appointment
            </button>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>
        </div>
    </div>

    <!-- KPI Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Appointments</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($appointments) ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Active Ongoing Tenures</div>
                        <div class="h3 font-weight-bold mb-0 text-success">
                            <?= count(array_filter($appointments, fn($a) => empty($a['end_date']) || strtotime($a['end_date']) >= time())) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Concluded Historical</div>
                        <div class="h3 font-weight-bold mb-0 text-secondary">
                            <?= count(array_filter($appointments, fn($a) => !empty($a['end_date']) && strtotime($a['end_date']) < time())) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card with Filters -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="fw-bold text-marsu-burgundy"><i class="bi bi-hourglass-split me-2"></i>Tenure History Directory</span>
            <form method="GET" action="<?= e(url('orgleadership/leadership-history')) ?>" class="d-flex flex-wrap align-items-center gap-2">
                <select name="organization_id" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Organizations</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= (int)$org['id'] ?>" <?= $orgFilter === (int)$org['id'] ? 'selected' : '' ?>>
                            <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="term_id" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Terms</option>
                    <?php foreach ($terms as $t): ?>
                        <option value="<?= (int)$t['id'] ?>" <?= $termFilter === (int)$t['id'] ? 'selected' : '' ?>>
                            <?= e($t['term_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group input-group-sm w-auto">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="appointmentSearchInput" placeholder="Quick search...">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="appointmentsTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Student Leader</th>
                        <th>Organization</th>
                        <th>Position Held</th>
                        <th>Academic Term</th>
                        <th>Tenure Period</th>
                        <th>Tenure Status</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($appointments)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold"></i>
                                No leadership tenure records found. Click "Record Appointment" to log one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($appointments as $i => $app): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <?php $displayName = trim(($app['first_name'] ?? '') . ' ' . ($app['last_name'] ?? '')); ?>
                                    <strong><?= e($displayName !== '' ? $displayName : 'Student ' . ($app['student_id'] ?? 'N/A')) ?></strong>
                                    <small class="d-block text-muted"><i class="bi bi-upc-scan me-1"></i><?= e($app['student_id'] ?? 'N/A') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= e($app['organization_acronym'] ?? 'Org') ?></span>
                                    <small class="d-block text-muted text-truncate" style="max-width: 150px;"><?= e($app['organization_name'] ?? '') ?></small>
                                </td>
                                <td class="fw-bold text-marsu-burgundy">
                                    <i class="bi bi-award-fill me-1 text-gold"></i><?= e($app['position_name'] ?? 'Position') ?>
                                </td>
                                <td><?= e($app['term_name'] ?? 'Term') ?></td>
                                <td class="small">
                                    <span><?= e(date('M d, Y', strtotime($app['start_date']))) ?></span> &rarr;
                                    <span><?= !empty($app['end_date']) ? e(date('M d, Y', strtotime($app['end_date']))) : '<strong class="text-success">Present</strong>' ?></span>
                                </td>
                                <td>
                                    <?php $isActive = empty($app['end_date']) || strtotime($app['end_date']) >= time(); ?>
                                    <?php if ($isActive): ?>
                                        <span class="badge bg-success"><i class="bi bi-activity me-1"></i>Active Serving</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><i class="bi bi-check-all me-1"></i>Concluded</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editAppModal<?= (int)$app['id'] ?>" title="Edit appointment">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAppModal<?= (int)$app['id'] ?>" title="Archive appointment">
                                        <i class="bi bi-trash"></i>
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

<!-- Modal: Record Appointment -->
<div class="modal fade" id="createAppointmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-journal-plus me-2"></i>Record Leadership Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/appointments/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Officer <span class="text-danger">*</span></label>
                        <select name="officer_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Officer --</option>
                            <?php foreach ($officers as $off): ?>
                                <?php $name = trim(($off['first_name'] ?? '') . ' ' . ($off['last_name'] ?? '')); ?>
                                <option value="<?= (int)$off['id'] ?>">
                                    <?= e($name !== '' ? $name : 'Student ' . $off['student_id']) ?> (<?= e($off['student_id']) ?> - <?= e($off['org_acronym'] ?? '') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Organization <span class="text-danger">*</span></label>
                        <select name="organization_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Organization --</option>
                            <?php foreach ($organizations as $org): ?>
                                <option value="<?= (int)$org['id'] ?>" <?= $orgFilter === (int)$org['id'] ? 'selected' : '' ?>>
                                    <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Position Held <span class="text-danger">*</span></label>
                        <select name="position_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Position --</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?= (int)$pos['id'] ?>"><?= e($pos['position_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Academic Term <span class="text-danger">*</span></label>
                        <select name="term_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Term --</option>
                            <?php foreach ($terms as $t): ?>
                                <option value="<?= (int)$t['id'] ?>"><?= e($t['term_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">End Date (optional)</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" placeholder="Leave empty if active">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-check-lg me-1"></i>Save Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals: Edit & Delete -->
<?php foreach ($appointments as $app): ?>
<div class="modal fade" id="editAppModal<?= (int)$app['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Tenure Record #<?= (int)$app['id'] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/appointments/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="appointment_id" value="<?= (int)$app['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Position</label>
                        <select name="position_id" class="form-select form-select-sm" required>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?= (int)$pos['id'] ?>" <?= (int)$app['position_id'] === (int)$pos['id'] ? 'selected' : '' ?>>
                                    <?= e($pos['position_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Academic Term</label>
                        <select name="term_id" class="form-select form-select-sm" required>
                            <?php foreach ($terms as $t): ?>
                                <option value="<?= (int)$t['id'] ?>" <?= (int)$app['term_id'] === (int)$t['id'] ? 'selected' : '' ?>>
                                    <?= e($t['term_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required value="<?= e($app['start_date']) ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" value="<?= e($app['end_date'] ?? '') ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAppModal<?= (int)$app['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Archive Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/appointments/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="appointment_id" value="<?= (int)$app['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to archive this tenure record?</p>
                    <strong class="text-danger"><?= e($app['position_name'] ?? 'Position') ?> (<?= e($app['term_name'] ?? 'Term') ?>)</strong>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i>Archive</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('appointmentSearchInput');
    const table = document.getElementById('appointmentsTable');
    if (input && table) {
        input.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            table.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });
    }
});
</script>
