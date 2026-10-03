<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">User Account Directory</h1>
        <p class="text-muted small mb-0">System authentication accounts, role delegations, and security status.</p>
    </div>
    <div>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newUserModal">
            <i class="bi bi-person-plus-fill me-1"></i>Create New User
        </button>
    </div>
</div>

<!-- Filters & Search Toolbar -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('users') ?>" class="row g-2 align-items-center">
            <?php if (isset($_GET['r'])): ?>
                <input type="hidden" name="r" value="users">
            <?php endif; ?>
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Search by name, username, email..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-4">
                <select name="role" class="form-select form-select-sm">
                    <option value="">All Security Roles</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= e($r['slug']) ?>" <?= ($roleFilter === $r['slug']) ? 'selected' : '' ?>>
                            <?= e($r['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter me-1"></i>Filter</button>
                <a href="<?= url('users') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Users Table Card -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-people-fill me-2"></i>Accounts Master List</h6>
        <span class="badge badge-burgundy"><?= number_format($pagination['total']) ?> Registered Users</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>User Profile</th>
                        <th>Username</th>
                        <th>Email Address</th>
                        <th>Assigned Role</th>
                        <th>Status</th>
                        <th>Last Active</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($users)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No user accounts matched the filter criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($users as $index => $u): ?>
                            <tr>
                                <td><?= ($pagination['current_page'] - 1) * $pagination['per_page'] + $index + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= asset('assets/img/undraw_profile.svg') ?>" class="rounded-circle" width="32" height="32" alt="Avatar">
                                        <div>
                                            <strong class="text-marsu-burgundy"><?= e($u['first_name'] . ' ' . $u['last_name']) ?></strong>
                                        </div>
                                    </div>
                                </td>
                                <td><code><?= e($u['username']) ?></code></td>
                                <td class="text-muted"><?= e($u['email']) ?></td>
                                <td>
                                    <span class="badge badge-gold"><?= e($u['role_name'] ?? 'User') ?></span>
                                </td>
                                <td>
                                    <?php if ($u['status'] === 'active'): ?>
                                        <span class="badge badge-soft-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger"><?= ucfirst($u['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted"><?= $u['last_login_at'] ? date('M j, Y', strtotime($u['last_login_at'])) : 'Never' ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-marsu me-1" 
                                            onclick='editUser(<?= json_encode($u) ?>)' title="Edit Account">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <?php if ($u['id'] != 1): ?>
                                        <form method="POST" action="<?= url('users/delete') ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Deactivate account for <?= e($u['username']) ?>?" title="Deactivate">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination Footer -->
    <?php if ($pagination['last_page'] > 1): ?>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 flex-wrap gap-2">
            <span class="small text-muted">Page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?></span>
            <?= render_pagination($pagination, 'users', $_GET) ?>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: New User -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Create User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('users/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">First Name</label>
                            <input type="text" name="first_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Last Name</label>
                            <input type="text" name="last_name" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Institutional Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Temporary Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Min. 6 chars" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Security Role</label>
                            <select name="role_id" class="form-select form-select-sm" required>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r['id'] ?>"><?= e($r['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
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
                    <button type="submit" class="btn btn-marsu btn-sm">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Edit User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('users/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_user_id">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">First Name</label>
                            <input type="text" name="first_name" id="edit_first_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Last Name</label>
                            <input type="text" name="last_name" id="edit_last_name" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Institutional Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Reset Password (leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Leave empty to retain existing">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Security Role</label>
                            <select name="role_id" id="edit_role_id" class="form-select form-select-sm" required>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r['id'] ?>"><?= e($r['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="status" id="edit_status" class="form-select form-select-sm">
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
function editUser(user) {
    document.getElementById('edit_user_id').value = user.id;
    document.getElementById('edit_first_name').value = user.first_name;
    document.getElementById('edit_last_name').value = user.last_name;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('edit_role_id').value = user.role_id || 1;
    document.getElementById('edit_status').value = user.status;
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
}
</script>
