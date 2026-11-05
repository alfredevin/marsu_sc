<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-person-vcard me-2 text-gold"></i>Officer Profiles Directory
            </h1>
            <p class="text-muted small mb-0">Roster of accredited student executives, committee leaders, and organizational officer profiles.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createOfficerModal">
                <i class="bi bi-person-plus me-1"></i>Appoint Officer
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
                        <div class="text-muted small text-uppercase fw-bold">Total Enrolled Officers</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($officers) ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Active in Service</div>
                        <div class="h3 font-weight-bold mb-0 text-success">
                            <?= count(array_filter($officers, fn($o) => ($o['officers_status'] ?? '') === 'Active')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Alumni & Graduated</div>
                        <div class="h3 font-weight-bold mb-0 text-secondary">
                            <?= count(array_filter($officers, fn($o) => ($o['officers_status'] ?? '') === 'Graduated')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card with Filters -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="fw-bold text-marsu-burgundy"><i class="bi bi-card-checklist me-2"></i>Accredited Student Officers</span>
            <form method="GET" action="<?= e(url('orgleadership/officer-profiles')) ?>" class="d-flex flex-wrap align-items-center gap-2">
                <select name="organization_id" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Organizations</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= (int)$org['id'] ?>" <?= $orgFilter === (int)$org['id'] ? 'selected' : '' ?>>
                            <?= e($org['acronym']) ?> - <?= e($org['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <?php foreach ($officerStatuses as $st): ?>
                        <option value="<?= e($st) ?>" <?= $statusFilter === $st ? 'selected' : '' ?>><?= e($st) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group input-group-sm w-auto">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="officerSearchInput" placeholder="Quick search...">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="officersTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Student Name & ID</th>
                        <th>Organization</th>
                        <th>Position & Term</th>
                        <th>Status</th>
                        <th>Leadership Bio / Summary</th>
                        <th class="text-end" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($officers)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold"></i>
                                No officer profiles found. Click "Appoint Officer" to create a new profile.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($officers as $i => $off): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <?php $displayName = trim(($off['first_name'] ?? '') . ' ' . ($off['last_name'] ?? '')); ?>
                                    <strong><?= e($displayName !== '' ? $displayName : 'Student ' . $off['student_id']) ?></strong>
                                    <small class="d-block text-muted">
                                        <i class="bi bi-upc-scan me-1"></i><?= e($off['student_id']) ?>
                                        <?php if (!empty($off['student_email'])): ?>
                                            &bull; <?= e($off['student_email']) ?>
                                        <?php endif; ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= e($off['organization_acronym'] ?? 'Org') ?></span>
                                    <small class="d-block text-muted text-truncate" style="max-width: 160px;"><?= e($off['organization_name'] ?? '') ?></small>
                                </td>
                                <td>
                                    <?php if (!empty($off['position_name'])): ?>
                                        <span class="fw-bold text-marsu-burgundy d-block">
                                            <i class="bi bi-award-fill me-1 text-gold"></i><?= e($off['position_name']) ?>
                                        </span>
                                        <small class="text-muted"><?= e($off['term_name'] ?? 'Current Term') ?></small>
                                    <?php else: ?>
                                        <span class="text-muted small fst-italic">No active appointment</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($off['officers_status'] === 'Active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php elseif ($off['officers_status'] === 'Graduated'): ?>
                                        <span class="badge bg-info text-dark">Graduated</span>
                                    <?php elseif ($off['officers_status'] === 'Suspended'): ?>
                                        <span class="badge bg-warning text-dark">Suspended</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= e($off['officers_status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted" style="max-width: 250px;">
                                    <?= e($off['profile_summary'] ?? 'No bio provided.') ?>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editOfficerModal<?= (int)$off['id'] ?>" title="Edit officer">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#statusOfficerModal<?= (int)$off['id'] ?>" title="Update status">
                                        <i class="bi bi-shield-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteOfficerModal<?= (int)$off['id'] ?>" title="Archive officer">
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

<!-- Modal: Create Officer -->
<div class="modal fade" id="createOfficerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-person-plus me-2"></i>Appoint New Student Officer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/officers/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Select Student (or enter Student Number) <span class="text-danger">*</span></label>
                            <input list="studentsList" name="student_id" class="form-control form-control-sm" required placeholder="e.g. 26S0041">
                            <datalist id="studentsList">
                                <?php foreach ($students as $stu): ?>
                                    <option value="<?= e($stu['student_number']) ?>">
                                        <?= e($stu['first_name'] . ' ' . $stu['last_name']) ?> (<?= e($stu['student_number']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Organization <span class="text-danger">*</span></label>
                            <select name="organization_id" class="form-select form-select-sm" required>
                                <option value="">Select Organization</option>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?= (int)$org['id'] ?>" <?= $orgFilter === (int)$org['id'] ? 'selected' : '' ?>>
                                        <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Position Title</label>
                            <select name="position_id" class="form-select form-select-sm">
                                <option value="0">-- Select Position --</option>
                                <?php foreach ($positions as $pos): ?>
                                    <option value="<?= (int)$pos['id'] ?>"><?= e($pos['position_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Term Cycle</label>
                            <select name="term_id" class="form-select form-select-sm">
                                <option value="0">-- Select Term --</option>
                                <?php foreach ($terms as $t): ?>
                                    <option value="<?= (int)$t['id'] ?>"><?= e($t['term_name']) ?> (<?= e($t['term_status']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Initial Status</label>
                            <select name="officers_status" class="form-select form-select-sm">
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Profile Summary / Bio</label>
                            <textarea name="profile_summary" class="form-control form-control-sm" rows="3" placeholder="Enter student achievements, leadership portfolio, background..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-check-lg me-1"></i>Appoint Officer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals: Edit, Status, and Delete -->
<?php foreach ($officers as $off): ?>
<div class="modal fade" id="editOfficerModal<?= (int)$off['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Officer Profile #<?= (int)$off['id'] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/officers/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="officer_id" value="<?= (int)$off['id'] ?>">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Student Number <span class="text-danger">*</span></label>
                            <input type="text" name="student_id" class="form-control form-control-sm" required value="<?= e($off['student_id']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Organization <span class="text-danger">*</span></label>
                            <select name="organization_id" class="form-select form-select-sm" required>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?= (int)$org['id'] ?>" <?= (int)$off['organization_id'] === (int)$org['id'] ? 'selected' : '' ?>>
                                        <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Position</label>
                            <select name="position_id" class="form-select form-select-sm">
                                <option value="0">-- Keep Existing Position --</option>
                                <?php foreach ($positions as $pos): ?>
                                    <option value="<?= (int)$pos['id'] ?>" <?= ($off['position_name'] ?? '') === $pos['position_name'] ? 'selected' : '' ?>>
                                        <?= e($pos['position_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Term</label>
                            <select name="term_id" class="form-select form-select-sm">
                                <option value="0">-- Keep Existing Term --</option>
                                <?php foreach ($terms as $t): ?>
                                    <option value="<?= (int)$t['id'] ?>" <?= ($off['term_name'] ?? '') === $t['term_name'] ? 'selected' : '' ?>>
                                        <?= e($t['term_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Status</label>
                            <select name="officers_status" class="form-select form-select-sm">
                                <?php foreach ($officerStatuses as $st): ?>
                                    <option value="<?= e($st) ?>" <?= $off['officers_status'] === $st ? 'selected' : '' ?>><?= e($st) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Profile Summary / Bio</label>
                            <textarea name="profile_summary" class="form-control form-control-sm" rows="3"><?= e($off['profile_summary'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="statusOfficerModal<?= (int)$off['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fs-6"><i class="bi bi-shield-check me-2"></i>Officer Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/officers/status')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="officer_id" value="<?= (int)$off['id'] ?>">
                <div class="modal-body py-3">
                    <p class="small text-muted mb-2">Change status for <strong>Student <?= e($off['student_id']) ?></strong>:</p>
                    <select name="officers_status" class="form-select form-select-sm" required>
                        <?php foreach ($officerStatuses as $st): ?>
                            <option value="<?= e($st) ?>" <?= $off['officers_status'] === $st ? 'selected' : '' ?>><?= e($st) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-check2 me-1"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteOfficerModal<?= (int)$off['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Archive Officer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/officers/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="officer_id" value="<?= (int)$off['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to archive officer record #<?= (int)$off['id'] ?>?</p>
                    <strong class="text-danger">Student <?= e($off['student_id']) ?> (<?= e($off['organization_acronym'] ?? 'Org') ?>)</strong>
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
    const input = document.getElementById('officerSearchInput');
    const table = document.getElementById('officersTable');
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
