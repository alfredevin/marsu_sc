<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Student Organizations Registry</h1>
        <p class="text-muted small mb-0">Master registry of accredited campus student bodies, councils, and academic societies.</p>
    </div>
    <div>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newOrgModal">
            <i class="bi bi-plus-lg me-1"></i>Register Organization
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-people-fill me-2"></i>Accredited Organizations Master List</h6>
        <span class="badge badge-burgundy"><?= count($organizations) ?> Orgs</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Org Code</th>
                        <th>Organization Name</th>
                        <th>Classification</th>
                        <th>Faculty Adviser</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($organizations)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No student organizations registered yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($organizations as $index => $org): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><span class="badge badge-gold font-monospace"><?= e($org['code']) ?></span></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($org['name']) ?></strong>
                                    <?php if (!empty($org['description'])): ?>
                                        <div class="text-muted" style="font-size:0.75rem;"><?= e($org['description']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-burgundy"><?= ucfirst(str_replace('_', ' ', e($org['type']))) ?></span></td>
                                <td><?= e($org['adviser_name'] ?: 'Not assigned') ?></td>
                                <td><span class="badge badge-soft-success"><?= ucfirst(e($org['status'])) ?></span></td>
                                <td class="text-end">
                                    <form method="POST" action="<?= url('organizations/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $org['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" data-confirm-delete="Archive organization '<?= e($org['name']) ?>'?" title="Archive">
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

<!-- Modal: New Organization -->
<div class="modal fade" id="newOrgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Register Student Organization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('organizations/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Acronym / Code</label>
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. ACIS" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Classification</label>
                            <select name="type" class="form-select form-select-sm" required>
                                <option value="academic">Academic Society</option>
                                <option value="socio_civic">Socio-Civic / Council</option>
                                <option value="sports">Athletic / Sports Guild</option>
                                <option value="non_academic">Special Interest</option>
                                <option value="religious">Religious</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Full Organization Title</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Association of Computing and Information Students" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Faculty Adviser</label>
                        <select name="adviser_id" class="form-select form-select-sm">
                            <option value="">Select Faculty Adviser (Optional)</option>
                            <?php foreach ($employees as $emp): ?>
                                <option value="<?= $emp['id'] ?>"><?= e($emp['last_name'] . ', ' . $emp['first_name']) ?> (<?= e($emp['department_code'] ?? '') ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Brief Description / Purpose</label>
                        <textarea name="description" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Accredit Organization</button>
                </div>
            </form>
        </div>
    </div>
</div>
