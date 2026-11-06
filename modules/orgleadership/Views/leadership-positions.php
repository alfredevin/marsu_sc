<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-award me-2 text-gold"></i>Leadership Positions Directory
            </h1>
            <p class="text-muted small mb-0">Official student leadership titles, committee roles, and organizational responsibilities.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createPositionModal">
                <i class="bi bi-plus-circle me-1"></i>New Position
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
                        <div class="text-muted small text-uppercase fw-bold">Total Positions</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($positions) ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-award-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Active Appointed Leaders</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                            <?= array_sum(array_column($positions, 'active_officers_count')) ?>
                        </div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Standard Hierarchy</div>
                        <div class="h5 font-weight-bold mb-0 text-secondary">Executive & Operating</div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Positions Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="fw-bold text-marsu-burgundy"><i class="bi bi-list-ul me-2"></i>Recognized Positions</span>
            <div class="input-group input-group-sm w-auto">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" id="positionSearchInput" placeholder="Search position...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="positionsTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Position Title</th>
                        <th>Duties & Responsibilities</th>
                        <th>Active Officers</th>
                        <th>Registered Date</th>
                        <th class="text-end" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($positions)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold"></i>
                                No leadership positions registered yet. Click "New Position" to add one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($positions as $i => $pos): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-bold text-marsu-burgundy">
                                    <i class="bi bi-bookmark-star me-1 text-gold"></i><?= e($pos['position_name']) ?>
                                </td>
                                <td class="small text-muted" style="max-width: 400px;">
                                    <?= e($pos['description'] ?? 'No description provided.') ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-person-check me-1 text-success"></i><?= (int)$pos['active_officers_count'] ?> active
                                    </span>
                                </td>
                                <td class="small text-muted"><?= e(date('M d, Y', strtotime($pos['created_at']))) ?></td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editPositionModal<?= (int)$pos['id'] ?>" title="Edit position">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deletePositionModal<?= (int)$pos['id'] ?>" title="Archive position">
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

<!-- Modal: Create Position -->
<div class="modal fade" id="createPositionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Register Leadership Position</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/positions/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Position Title <span class="text-danger">*</span></label>
                        <input type="text" name="position_name" class="form-control form-control-sm" required placeholder="e.g. Vice President for Internal Affairs">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Duties & Responsibilities</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Describe the functions, scope of authority, and expectations..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-check-lg me-1"></i>Save Position</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals: Edit & Delete -->
<?php foreach ($positions as $pos): ?>
<div class="modal fade" id="editPositionModal<?= (int)$pos['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Position #<?= (int)$pos['id'] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/positions/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="position_id" value="<?= (int)$pos['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Position Title <span class="text-danger">*</span></label>
                        <input type="text" name="position_name" class="form-control form-control-sm" required value="<?= e($pos['position_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Duties & Responsibilities</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3"><?= e($pos['description'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Update Position</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePositionModal<?= (int)$pos['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Archive Position</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/positions/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="position_id" value="<?= (int)$pos['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to archive this position?</p>
                    <strong class="text-danger"><?= e($pos['position_name']) ?></strong>
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
    const input = document.getElementById('positionSearchInput');
    const table = document.getElementById('positionsTable');
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
