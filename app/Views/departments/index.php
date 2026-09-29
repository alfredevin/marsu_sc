<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Colleges & Departments</h1>
        <p class="text-muted small mb-0">Manage university colleges, administrative units, and academic divisions.</p>
    </div>
    <div>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newDeptModal">
            <i class="bi bi-plus-lg me-1"></i>Add College / Department
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-diagram-3-fill me-2"></i>Institutional Units Directory</h6>
        <span class="badge badge-burgundy"><?= count($departments) ?> Units</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Code</th>
                        <th>College / Unit Name</th>
                        <th>Classification</th>
                        <th>Dean / Unit Head</th>
                        <th class="text-center">Programs</th>
                        <th class="text-center">Personnel</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($departments)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No academic departments registered yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($departments as $index => $d): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><span class="badge badge-gold font-monospace"><?= e($d['code']) ?></span></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($d['name']) ?></strong>
                                    <?php if (!empty($d['description'])): ?>
                                        <div class="text-muted" style="font-size: 0.75rem;"><?= e($d['description']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-burgundy"><?= ucfirst(e($d['type'])) ?></span></td>
                                <td><?= e($d['head_name'] ?: 'Not designated') ?></td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= $d['programs_count'] ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= $d['employees_count'] ?></span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-marsu me-1" onclick='editDept(<?= json_encode($d) ?>)' title="Edit Unit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="<?= url('departments/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Archive department '<?= e($d['name']) ?>'?" title="Archive">
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

<!-- Modal: New Department -->
<div class="modal fade" id="newDeptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Academic / Administrative Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('departments/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Unit Code</label>
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. CICS" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Classification</label>
                            <select name="type" class="form-select form-select-sm" required>
                                <option value="college">Academic College</option>
                                <option value="department">Academic Department</option>
                                <option value="office">Administrative Office</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Full Unit Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. College of Information and Computing Sciences" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Dean / Unit Head Name</label>
                        <input type="text" name="head_name" class="form-control form-control-sm" placeholder="e.g. Dr. Arnel Lacierda">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Description / Mission</label>
                        <textarea name="description" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Unit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Department -->
<div class="modal fade" id="editDeptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Edit Unit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('departments/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_d_id">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Unit Code</label>
                            <input type="text" name="code" id="edit_d_code" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Classification</label>
                            <select name="type" id="edit_d_type" class="form-select form-select-sm" required>
                                <option value="college">Academic College</option>
                                <option value="department">Academic Department</option>
                                <option value="office">Administrative Office</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Full Unit Name</label>
                        <input type="text" name="name" id="edit_d_name" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Dean / Unit Head Name</label>
                        <input type="text" name="head_name" id="edit_d_head" class="form-control form-control-sm">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Description</label>
                        <textarea name="description" id="edit_d_desc" class="form-control form-control-sm" rows="2"></textarea>
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
function editDept(d) {
    document.getElementById('edit_d_id').value = d.id;
    document.getElementById('edit_d_code').value = d.code;
    document.getElementById('edit_d_type').value = d.type;
    document.getElementById('edit_d_name').value = d.name;
    document.getElementById('edit_d_head').value = d.head_name || '';
    document.getElementById('edit_d_desc').value = d.description || '';
    new bootstrap.Modal(document.getElementById('editDeptModal')).show();
}
</script>
