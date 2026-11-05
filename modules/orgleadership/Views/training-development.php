<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-mortarboard me-2 text-gold"></i>Training & Development Tracking
            </h1>
            <p class="text-muted small mb-0">Record and verify officer participation in leadership seminars, compliance bootcamps, and skills workshops.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createTrainingModal">
                <i class="bi bi-patch-plus me-1"></i>Log Training Session
            </button>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>
        </div>
    </div>

    <!-- KPI Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Trainings</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($trainings) ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Completed / Certified</div>
                        <div class="h3 font-weight-bold mb-0 text-success">
                            <?= count(array_filter($trainings, fn($t) => $t['completion_status'] === 'Completed')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Attended Sessions</div>
                        <div class="h3 font-weight-bold mb-0 text-info">
                            <?= count(array_filter($trainings, fn($t) => $t['completion_status'] === 'Attended')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Registered / Pending</div>
                        <div class="h3 font-weight-bold mb-0 text-secondary">
                            <?= count(array_filter($trainings, fn($t) => $t['completion_status'] === 'Registered')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card with Filter -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="fw-bold text-marsu-burgundy"><i class="bi bi-journal-check me-2"></i>Leadership Training Log</span>
            <form method="GET" action="<?= e(url('orgleadership/training-development')) ?>" class="d-flex align-items-center gap-2">
                <label class="small text-muted mb-0 fw-bold">Status:</label>
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Completion Statuses</option>
                    <?php foreach ($trainingStatuses as $st): ?>
                        <option value="<?= e($st) ?>" <?= $statusFilter === $st ? 'selected' : '' ?>><?= e($st) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group input-group-sm w-auto">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="trainingSearchInput" placeholder="Quick search...">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="trainingsTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Student Leader</th>
                        <th>Training Program Title</th>
                        <th>Organizer / Provider</th>
                        <th>Date Completed</th>
                        <th>Completion Status</th>
                        <th class="text-end" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($trainings)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold"></i>
                                No training records found. Click "Log Training Session" to add a new record.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($trainings as $i => $tr): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <?php $displayName = trim(($tr['first_name'] ?? '') . ' ' . ($tr['last_name'] ?? '')); ?>
                                    <strong><?= e($displayName !== '' ? $displayName : 'Student ' . ($tr['student_id'] ?? '')) ?></strong>
                                    <small class="d-block text-muted">
                                        <?= e($tr['position_name'] ?? 'Officer') ?> &bull; <span class="badge bg-light text-dark border"><?= e($tr['organization_acronym'] ?? 'Org') ?></span>
                                    </small>
                                </td>
                                <td>
                                    <span class="fw-bold text-marsu-burgundy d-block">
                                        <i class="bi bi-mortarboard me-1 text-gold"></i><?= e($tr['training_title']) ?>
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    <i class="bi bi-building me-1"></i><?= e($tr['provider'] ?? 'OSAS') ?>
                                </td>
                                <td><?= e(date('M d, Y', strtotime($tr['training_date']))) ?></td>
                                <td>
                                    <?php if ($tr['completion_status'] === 'Completed'): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Completed</span>
                                    <?php elseif ($tr['completion_status'] === 'Attended'): ?>
                                        <span class="badge bg-info text-dark"><i class="bi bi-check2 me-1"></i>Attended</span>
                                    <?php elseif ($tr['completion_status'] === 'Registered'): ?>
                                        <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i>Registered</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= e($tr['completion_status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editTrainingModal<?= (int)$tr['id'] ?>" title="Edit training">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#statusTrainingModal<?= (int)$tr['id'] ?>" title="Update status">
                                        <i class="bi bi-shield-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal<?= (int)$tr['id'] ?>" title="Archive training">
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

<!-- Modal: Log Training Session -->
<div class="modal fade" id="createTrainingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-patch-plus me-2"></i>Log Leadership Training</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/trainings/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Participating Officer <span class="text-danger">*</span></label>
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
                        <label class="form-label small fw-bold">Training Program Title <span class="text-danger">*</span></label>
                        <input type="text" name="training_title" class="form-control form-control-sm" required placeholder="e.g. Student Leadership Summit 2026">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Organizer / Provider</label>
                        <input type="text" name="provider" class="form-control form-control-sm" placeholder="e.g. Office of Student Affairs and Services (OSAS)">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Date Conducted <span class="text-danger">*</span></label>
                            <input type="date" name="training_date" class="form-control form-control-sm" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Completion Status</label>
                            <select name="completion_status" class="form-select form-select-sm">
                                <option value="Completed" selected>Completed</option>
                                <option value="Attended">Attended</option>
                                <option value="Registered">Registered</option>
                                <option value="Not Completed">Not Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-check-lg me-1"></i>Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals: Edit, Status, and Delete -->
<?php foreach ($trainings as $tr): ?>
<div class="modal fade" id="editTrainingModal<?= (int)$tr['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Training Record #<?= (int)$tr['id'] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/trainings/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="training_id" value="<?= (int)$tr['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Participating Officer</label>
                        <select name="officer_id" class="form-select form-select-sm" required>
                            <?php foreach ($officers as $off): ?>
                                <?php $name = trim(($off['first_name'] ?? '') . ' ' . ($off['last_name'] ?? '')); ?>
                                <option value="<?= (int)$off['id'] ?>" <?= (int)$tr['officer_id'] === (int)$off['id'] ? 'selected' : '' ?>>
                                    <?= e($name !== '' ? $name : 'Student ' . $off['student_id']) ?> (<?= e($off['student_id']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Training Program Title <span class="text-danger">*</span></label>
                        <input type="text" name="training_title" class="form-control form-control-sm" required value="<?= e($tr['training_title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Organizer / Provider</label>
                        <input type="text" name="provider" class="form-control form-control-sm" value="<?= e($tr['provider'] ?? '') ?>">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Date Conducted</label>
                            <input type="date" name="training_date" class="form-control form-control-sm" required value="<?= e($tr['training_date']) ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Status</label>
                            <select name="completion_status" class="form-select form-select-sm">
                                <?php foreach ($trainingStatuses as $st): ?>
                                    <option value="<?= e($st) ?>" <?= $tr['completion_status'] === $st ? 'selected' : '' ?>><?= e($st) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Update Training</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="statusTrainingModal<?= (int)$tr['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fs-6"><i class="bi bi-shield-check me-2"></i>Update Completion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/trainings/status')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="training_id" value="<?= (int)$tr['id'] ?>">
                <div class="modal-body py-3">
                    <p class="small text-muted mb-2">Update status for <strong><?= e($tr['training_title']) ?></strong>:</p>
                    <select name="completion_status" class="form-select form-select-sm" required>
                        <?php foreach ($trainingStatuses as $st): ?>
                            <option value="<?= e($st) ?>" <?= $tr['completion_status'] === $st ? 'selected' : '' ?>><?= e($st) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-check2 me-1"></i>Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteTrainingModal<?= (int)$tr['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Archive Training</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/trainings/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="training_id" value="<?= (int)$tr['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to archive this training log?</p>
                    <strong class="text-danger"><?= e($tr['training_title']) ?></strong>
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
    const input = document.getElementById('trainingSearchInput');
    const table = document.getElementById('trainingsTable');
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
