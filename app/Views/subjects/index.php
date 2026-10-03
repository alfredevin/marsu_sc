<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Curriculum Subjects Registry</h1>
        <p class="text-muted small mb-0">Master catalog of instructional subjects, credit units, lecture, and laboratory hours.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= url('subjects/template') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-download me-1"></i>Template</a>
        <a href="<?= url('subjects/import') ?>" class="btn btn-outline-marsu btn-sm"><i class="bi bi-file-earmark-arrow-up me-1"></i>Bulk Import</a>
        <a href="<?= url('subjects/export') ?>" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-excel me-1"></i>Export CSV</a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newSubjectModal">
            <i class="bi bi-plus-lg me-1"></i>Add Subject
        </button>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('subjects') ?>" class="row g-2 align-items-center">
            <?php if (isset($_GET['r'])): ?>
                <input type="hidden" name="r" value="subjects">
            <?php endif; ?>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Search subject code or descriptive title..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-4">
                <select name="program" class="form-select form-select-sm">
                    <option value="">All Academic Programs</option>
                    <?php foreach ($programs as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= ($programFilter == $p['id']) ? 'selected' : '' ?>>
                            <?= e($p['code']) ?> - <?= e($p['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter me-1"></i>Filter</button>
                <a href="<?= url('subjects') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Subjects Table Card -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-book-fill me-2"></i>Subject Curriculum Master List</h6>
        <span class="badge badge-burgundy"><?= number_format($pagination['total']) ?> Subjects</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Subject Code</th>
                        <th>Descriptive Title</th>
                        <th>Program</th>
                        <th class="text-center">Units</th>
                        <th class="text-center">Hours (Lec / Lab)</th>
                        <th>Prerequisites</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($subjects)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No subjects found matching your query.</td></tr>
                    <?php else: ?>
                        <?php foreach ($subjects as $index => $sub): ?>
                            <tr>
                                <td><?= ($pagination['current_page'] - 1) * $pagination['per_page'] + $index + 1 ?></td>
                                <td><span class="badge badge-gold font-monospace"><?= e($sub['code']) ?></span></td>
                                <td><strong class="text-marsu-burgundy"><?= e($sub['title']) ?></strong></td>
                                <td><?= e($sub['program_code'] ?: 'General Education') ?></td>
                                <td class="text-center fw-bold"><?= number_format($sub['units'], 1) ?></td>
                                <td class="text-center text-muted"><?= number_format($sub['lecture_hours'], 1) ?> / <?= number_format($sub['lab_hours'], 1) ?> hrs</td>
                                <td><?= e($sub['prerequisites'] ?: 'None') ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-marsu me-1" onclick='editSubject(<?= json_encode($sub) ?>)' title="Edit Subject">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="<?= url('subjects/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Archive subject '<?= e($sub['code']) ?>'?" title="Archive">
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

    <!-- Pagination -->
    <?php if ($pagination['last_page'] > 1): ?>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 flex-wrap gap-2">
            <span class="small text-muted">Page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?></span>
            <?= render_pagination($pagination, 'subjects', $_GET) ?>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: New Subject -->
<div class="modal fade" id="newSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Curriculum Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('subjects/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Subject Code</label>
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. IS 311" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small font-weight-bold">Descriptive Title</label>
                            <input type="text" name="title" class="form-control form-control-sm" placeholder="e.g. Enterprise Architecture" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Academic Program</label>
                            <select name="program_id" class="form-select form-select-sm">
                                <option value="">General Education / Non-Major</option>
                                <?php foreach ($programs as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= e($p['code']) ?> - <?= e($p['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small font-weight-bold">Units</label>
                            <input type="number" step="0.5" name="units" class="form-control form-control-sm" value="3.0" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small font-weight-bold">Lec Hours</label>
                            <input type="number" step="0.5" name="lecture_hours" class="form-control form-control-sm" value="3.0" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small font-weight-bold">Lab Hours</label>
                            <input type="number" step="0.5" name="lab_hours" class="form-control form-control-sm" value="0.0">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Prerequisites</label>
                        <input type="text" name="prerequisites" class="form-control form-control-sm" placeholder="e.g. CC 102 or None">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Subject -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Edit Subject Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('subjects/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_sub_id">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Subject Code</label>
                            <input type="text" name="code" id="edit_sub_code" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small font-weight-bold">Descriptive Title</label>
                            <input type="text" name="title" id="edit_sub_title" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Academic Program</label>
                            <select name="program_id" id="edit_sub_prog" class="form-select form-select-sm">
                                <option value="">General Education / Non-Major</option>
                                <?php foreach ($programs as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= e($p['code']) ?> - <?= e($p['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small font-weight-bold">Units</label>
                            <input type="number" step="0.5" name="units" id="edit_sub_units" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small font-weight-bold">Lec Hours</label>
                            <input type="number" step="0.5" name="lecture_hours" id="edit_sub_lec" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small font-weight-bold">Lab Hours</label>
                            <input type="number" step="0.5" name="lab_hours" id="edit_sub_lab" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Prerequisites</label>
                        <input type="text" name="prerequisites" id="edit_sub_prereq" class="form-control form-control-sm">
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
function editSubject(s) {
    document.getElementById('edit_sub_id').value = s.id;
    document.getElementById('edit_sub_code').value = s.code;
    document.getElementById('edit_sub_title').value = s.title;
    document.getElementById('edit_sub_prog').value = s.program_id || '';
    document.getElementById('edit_sub_units').value = s.units;
    document.getElementById('edit_sub_lec').value = s.lecture_hours;
    document.getElementById('edit_sub_lab').value = s.lab_hours;
    document.getElementById('edit_sub_prereq').value = s.prerequisites || '';
    new bootstrap.Modal(document.getElementById('editSubjectModal')).show();
}
</script>
