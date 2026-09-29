<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Academic Degree Programs</h1>
        <p class="text-muted small mb-0">Undergraduate and graduate degree programs offered across colleges.</p>
    </div>
    <div>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newProgModal">
            <i class="bi bi-plus-lg me-1"></i>Add Degree Program
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-journal-bookmark-fill me-2"></i>Curriculum Programs Directory</h6>
        <span class="badge badge-burgundy"><?= count($programs) ?> Programs</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Program Code</th>
                        <th>Degree Title</th>
                        <th>Parent College</th>
                        <th>Duration</th>
                        <th class="text-center">Enrolled</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($programs)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No academic programs registered.</td></tr>
                    <?php else: ?>
                        <?php foreach ($programs as $index => $p): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><span class="badge badge-gold font-monospace"><?= e($p['code']) ?></span></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($p['name']) ?></strong>
                                    <?php if (!empty($p['major'])): ?>
                                        <div class="text-muted" style="font-size: 0.75rem;">Major in <?= e($p['major']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><?= e($p['department_name']) ?></td>
                                <td><?= e($p['years']) ?> Years</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= number_format($p['students_count']) ?></span>
                                </td>
                                <td><span class="badge badge-soft-success"><?= ucfirst(e($p['status'])) ?></span></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-marsu me-1" onclick='editProg(<?= json_encode($p) ?>)' title="Edit Program">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="<?= url('programs/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Archive program '<?= e($p['code']) ?>'?" title="Archive">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Program -->
<div class="modal fade" id="newProgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Academic Degree Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('programs/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Program Acronym</label>
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. BSIS" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Parent Department</label>
                            <select name="department_id" class="form-select form-select-sm" required>
                                <?php foreach ($departments as $d): ?>
                                    <option value="<?= $d['id'] ?>"><?= e($d['code']) ?> - <?= e($d['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Full Degree Title</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Bachelor of Science in Information Systems" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Major / Specialization</label>
                            <input type="text" name="major" class="form-control form-control-sm" placeholder="Optional">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Duration</label>
                            <input type="number" name="years" class="form-control form-control-sm" value="4" min="1" max="6" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Program -->
<div class="modal fade" id="editProgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Edit Degree Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('programs/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_p_id">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Program Acronym</label>
                            <input type="text" name="code" id="edit_p_code" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Parent Department</label>
                            <select name="department_id" id="edit_p_dept" class="form-select form-select-sm" required>
                                <?php foreach ($departments as $d): ?>
                                    <option value="<?= $d['id'] ?>"><?= e($d['code']) ?> - <?= e($d['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Full Degree Title</label>
                        <input type="text" name="name" id="edit_p_name" class="form-control form-control-sm" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Major</label>
                            <input type="text" name="major" id="edit_p_major" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Duration</label>
                            <input type="number" name="years" id="edit_p_years" class="form-control form-control-sm" min="1" max="6" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="status" id="edit_p_status" class="form-select form-select-sm">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editProg(p) {
    document.getElementById('edit_p_id').value = p.id;
    document.getElementById('edit_p_code').value = p.code;
    document.getElementById('edit_p_dept').value = p.department_id;
    document.getElementById('edit_p_name').value = p.name;
    document.getElementById('edit_p_major').value = p.major || '';
    document.getElementById('edit_p_years').value = p.years;
    document.getElementById('edit_p_status').value = p.status;
    new bootstrap.Modal(document.getElementById('editProgModal')).show();
}
</script>
