<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Roles & Access Control</h1>
        <p class="text-muted small mb-0">Define system security roles and manage granular permissions across modules.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('roles/matrix') ?>" class="btn btn-accent btn-sm">
            <i class="bi bi-grid-3x3-gap-fill me-1"></i>Open Permission Matrix
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRoleModal">
            <i class="bi bi-plus-lg me-1"></i>Add New Role
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-shield-lock-fill me-2"></i>System Defined Roles</h6>
        <span class="badge badge-burgundy"><?= count($roles) ?> Roles</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Role Title</th>
                        <th>Identifier Slug</th>
                        <th>Description</th>
                        <th class="text-center">Active Users</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $index => $r): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <strong class="text-marsu-burgundy"><?= e($r['name']) ?></strong>
                                <?php if ($r['slug'] === 'super_admin'): ?>
                                    <span class="badge badge-gold ms-1">System Master</span>
                                <?php endif; ?>
                            </td>
                            <td><code><?= e($r['slug']) ?></code></td>
                            <td class="text-muted small"><?= e($r['description'] ?: 'No description provided') ?></td>
                            <td class="text-center">
                                <span class="badge badge-soft-info rounded-pill px-3"><?= number_format($r['users_count']) ?> users</span>
                            </td>
                            <td class="text-end">
                                <a href="<?= url('roles/matrix', ['role_id' => $r['id']]) ?>" class="btn btn-sm btn-outline-marsu me-1" title="Configure Permissions">
                                    <i class="bi bi-toggles me-1"></i>Privileges
                                </a>
                                <?php if ($r['slug'] !== 'super_admin'): ?>
                                    <form method="POST" action="<?= url('roles/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Delete role '<?= e($r['name']) ?>'?" title="Delete Role">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Role -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Create System Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('roles/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Role Display Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Guidance Counselor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Unique Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="e.g. guidance_counselor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Role Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief scope of responsibilities..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Create Role & Configure</button>
                </div>
            </form>
        </div>
    </div>
</div>
