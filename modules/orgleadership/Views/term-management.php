<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-calendar-range me-2 text-gold"></i>Term Management
            </h1>
            <p class="text-muted small mb-0">Track academic governance terms, election cycles, and officer tenure periods.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createTermModal">
                <i class="bi bi-plus-circle me-1"></i>New Term
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
                        <div class="text-muted small text-uppercase fw-bold">Total Terms</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($terms) ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-calendar-range-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Current Active</div>
                        <div class="h3 font-weight-bold mb-0 text-success">
                            <?= count(array_filter($terms, fn($t) => $t['term_status'] === 'Current')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Upcoming Terms</div>
                        <div class="h3 font-weight-bold mb-0 text-primary">
                            <?= count(array_filter($terms, fn($t) => $t['term_status'] === 'Upcoming')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Completed Terms</div>
                        <div class="h3 font-weight-bold mb-0 text-secondary">
                            <?= count(array_filter($terms, fn($t) => $t['term_status'] === 'Completed')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="fw-bold text-marsu-burgundy"><i class="bi bi-table me-2"></i>Academic Governance Terms</span>
            <form method="GET" action="<?= e(url('orgleadership/term-management')) ?>" class="d-flex align-items-center gap-2">
                <label class="small text-muted mb-0 fw-bold">Organization:</label>
                <select name="organization_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Organizations</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= (int)$org['id'] ?>" <?= $orgFilter === (int)$org['id'] ? 'selected' : '' ?>>
                            <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="termsTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Organization</th>
                        <th>Term Label</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Appointed Officers</th>
                        <th class="text-end" style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($terms)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold"></i>
                                No leadership terms found for this filter. Click "New Term" to create one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($terms as $i => $term): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <strong><?= e($term['organization_name']) ?></strong>
                                    <small class="d-block text-muted"><?= e($term['organization_acronym']) ?></small>
                                </td>
                                <td class="fw-bold text-marsu-burgundy">
                                    <i class="bi bi-calendar-event me-1 text-gold"></i><?= e($term['term_name']) ?>
                                </td>
                                <td><?= e(date('M d, Y', strtotime($term['start_date']))) ?></td>
                                <td><?= e(date('M d, Y', strtotime($term['end_date']))) ?></td>
                                <td>
                                    <?php if ($term['term_status'] === 'Current'): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Current</span>
                                    <?php elseif ($term['term_status'] === 'Upcoming'): ?>
                                        <span class="badge bg-primary"><i class="bi bi-clock me-1"></i>Upcoming</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><i class="bi bi-archive me-1"></i>Completed</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= (int)$term['appointed_officers_count'] ?> appointed
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editTermModal<?= (int)$term['id'] ?>" title="Edit term">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#statusTermModal<?= (int)$term['id'] ?>" title="Change status">
                                        <i class="bi bi-shield-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTermModal<?= (int)$term['id'] ?>" title="Archive term">
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

<!-- Modal: Create Term -->
<div class="modal fade" id="createTermModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Create New Term</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/terms/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
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
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Term Label <span class="text-danger">*</span></label>
                        <input type="text" name="term_name" class="form-control form-control-sm" required placeholder="e.g. A.Y. 2026-2027 Term">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required value="<?= date('Y-08-01') ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control form-control-sm" required value="<?= date('Y-06-30', strtotime('+1 year')) ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Initial Status</label>
                        <select name="term_status" class="form-select form-select-sm">
                            <option value="Upcoming">Upcoming</option>
                            <option value="Current" selected>Current</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-check-lg me-1"></i>Save Term</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals: Edit, Status, and Delete -->
<?php foreach ($terms as $term): ?>
<div class="modal fade" id="editTermModal<?= (int)$term['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Term #<?= (int)$term['id'] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/terms/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="term_id" value="<?= (int)$term['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Organization <span class="text-danger">*</span></label>
                        <select name="organization_id" class="form-select form-select-sm" required>
                            <?php foreach ($organizations as $org): ?>
                                <option value="<?= (int)$org['id'] ?>" <?= (int)$term['organization_id'] === (int)$org['id'] ? 'selected' : '' ?>>
                                    <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Term Label <span class="text-danger">*</span></label>
                        <input type="text" name="term_name" class="form-control form-control-sm" required value="<?= e($term['term_name']) ?>">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required value="<?= e($term['start_date']) ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" required value="<?= e($term['end_date']) ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Term Status</label>
                        <select name="term_status" class="form-select form-select-sm">
                            <?php foreach ($termStatuses as $status): ?>
                                <option value="<?= e($status) ?>" <?= $term['term_status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Update Term</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="statusTermModal<?= (int)$term['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fs-6"><i class="bi bi-shield-check me-2"></i>Update Term Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/terms/status')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="term_id" value="<?= (int)$term['id'] ?>">
                <div class="modal-body py-3">
                    <p class="small text-muted mb-2">Changing cycle for <strong><?= e($term['term_name']) ?></strong>:</p>
                    <select name="term_status" class="form-select form-select-sm" required>
                        <?php foreach ($termStatuses as $status): ?>
                            <option value="<?= e($status) ?>" <?= $term['term_status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
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

<div class="modal fade" id="deleteTermModal<?= (int)$term['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Archive Term</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/terms/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="term_id" value="<?= (int)$term['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to archive this term?</p>
                    <strong class="text-danger"><?= e($term['term_name']) ?></strong>
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
