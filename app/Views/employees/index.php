<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Faculty & Staff Directory</h1>
        <p class="text-muted small mb-0">Official institutional registry of faculty members, administrative staff, and officers.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= url('employees/template') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-download me-1"></i>Template</a>
        <a href="<?= url('employees/import') ?>" class="btn btn-outline-marsu btn-sm"><i class="bi bi-file-earmark-arrow-up me-1"></i>Bulk Import</a>
        <a href="<?= url('employees/export') ?>" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-excel me-1"></i>Export CSV</a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newEmployeeModal">
            <i class="bi bi-plus-lg me-1"></i>Add Employee
        </button>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('employees') ?>" class="row g-2 align-items-center">
            <?php if (isset($_GET['r'])): ?>
                <input type="hidden" name="r" value="employees">
            <?php endif; ?>
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Search employee #, name, email..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="department" class="form-select form-select-sm">
                    <option value="">All Departments & Colleges</option>
                    <?php foreach ($departments as $d): ?>
                        <option value="<?= $d['id'] ?>" <?= ($deptFilter == $d['id']) ? 'selected' : '' ?>>
                            <?= e($d['code']) ?> - <?= e($d['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select form-select-sm">
                    <option value="">All Types</option>
                    <option value="faculty" <?= ($typeFilter === 'faculty') ? 'selected' : '' ?>>Faculty</option>
                    <option value="staff" <?= ($typeFilter === 'staff') ? 'selected' : '' ?>>Staff</option>
                    <option value="admin" <?= ($typeFilter === 'admin') ? 'selected' : '' ?>>Administrative</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="active" <?= ($statusFilter === 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="on_leave" <?= ($statusFilter === 'on_leave') ? 'selected' : '' ?>>On Leave</option>
                    <option value="retired" <?= ($statusFilter === 'retired') ? 'selected' : '' ?>>Retired</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter"></i></button>
                <a href="<?= url('employees') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Employees Table Card -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-person-workspace me-2"></i>Institutional Personnel Master List</h6>
        <span class="badge badge-burgundy"><?= number_format($pagination['total']) ?> Records</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 45px;">#</th>
                        <th>Employee ID</th>
                        <th>Name & Profile</th>
                        <th>Type</th>
                        <th>Academic Department</th>
                        <th>Position & Rank</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($employees)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No employee records match the filter criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($employees as $index => $e): ?>
                            <tr>
                                <td><?= ($pagination['current_page'] - 1) * $pagination['per_page'] + $index + 1 ?></td>
                                <td><code><?= e($e['employee_number']) ?></code></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($e['last_name'] . ', ' . $e['first_name'] . ' ' . $e['middle_name']) ?></strong>
                                    <div class="text-muted" style="font-size: 0.75rem;"><?= e($e['email']) ?></div>
                                </td>
                                <td><span class="badge badge-gold"><?= ucfirst(e($e['type'])) ?></span></td>
                                <td>
                                    <strong><?= e($e['department_code'] ?? '') ?></strong>
                                    <span class="text-muted d-block" style="font-size: 0.75rem;"><?= e($e['department_name'] ?? '') ?></span>
                                </td>
                                <td>
                                    <?= e($e['position']) ?>
                                    <?php if (!empty($e['rank'])): ?>
                                        <div class="text-muted" style="font-size: 0.75rem;"><?= e($e['rank']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($e['status'] === 'active'): ?>
                                        <span class="badge badge-soft-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-warning"><?= ucfirst(str_replace('_', ' ', $e['status'])) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-marsu me-1" onclick='editEmployee(<?= json_encode($e) ?>)' title="Edit Profile">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="<?= url('employees/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Archive record for <?= e($e['employee_number']) ?>?" title="Archive">
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
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2">
            <span class="small text-muted">Showing page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?></span>
            <ul class="pagination pagination-sm mb-0">
                <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
                    <li class="page-item <?= ($i == $pagination['current_page']) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= url('employees', array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: New Employee -->
<div class="modal fade" id="newEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Faculty or Staff Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('employees/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Employee ID Number</label>
                            <input type="text" name="employee_number" class="form-control form-control-sm" placeholder="e.g. EMP-2026-042" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Institutional Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="e.g. jdelacruz@marsu.edu.ph" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control form-control-sm" placeholder="09181234567">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">First Name</label>
                            <input type="text" name="first_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Last Name</label>
                            <input type="text" name="last_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small font-weight-bold">Suffix</label>
                            <input type="text" name="suffix" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Personnel Type</label>
                            <select name="type" class="form-select form-select-sm" required>
                                <option value="faculty">Faculty</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Administrative</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Academic Department / College</label>
                            <select name="department_id" class="form-select form-select-sm" required>
                                <?php foreach ($departments as $d): ?>
                                    <option value="<?= $d['id'] ?>"><?= e($d['code']) ?> - <?= e($d['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="active">Active</option>
                                <option value="on_leave">On Leave</option>
                                <option value="retired">Retired</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Position Title</label>
                            <input type="text" name="position" class="form-control form-control-sm" placeholder="e.g. Assistant Professor II" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Employment Rank / Classification</label>
                            <input type="text" name="rank" class="form-control form-control-sm" placeholder="e.g. Permanent, Contractual">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Add Personnel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Employee -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Edit Personnel Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('employees/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_e_id">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Employee ID Number</label>
                            <input type="text" name="employee_number" id="edit_e_number" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Email Address</label>
                            <input type="email" name="email" id="edit_e_email" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Contact Number</label>
                            <input type="text" name="contact_number" id="edit_e_contact" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">First Name</label>
                            <input type="text" name="first_name" id="edit_e_fn" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Middle Name</label>
                            <input type="text" name="middle_name" id="edit_e_mn" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Last Name</label>
                            <input type="text" name="last_name" id="edit_e_ln" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small font-weight-bold">Suffix</label>
                            <input type="text" name="suffix" id="edit_e_suffix" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Type</label>
                            <select name="type" id="edit_e_type" class="form-select form-select-sm" required>
                                <option value="faculty">Faculty</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Administrative</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Department</label>
                            <select name="department_id" id="edit_e_dept" class="form-select form-select-sm" required>
                                <?php foreach ($departments as $d): ?>
                                    <option value="<?= $d['id'] ?>"><?= e($d['code']) ?> - <?= e($d['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="status" id="edit_e_status" class="form-select form-select-sm">
                                <option value="active">Active</option>
                                <option value="on_leave">On Leave</option>
                                <option value="retired">Retired</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Position</label>
                            <input type="text" name="position" id="edit_e_position" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Rank</label>
                            <input type="text" name="rank" id="edit_e_rank" class="form-control form-control-sm">
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
function editEmployee(e) {
    document.getElementById('edit_e_id').value = e.id;
    document.getElementById('edit_e_number').value = e.employee_number;
    document.getElementById('edit_e_fn').value = e.first_name;
    document.getElementById('edit_e_mn').value = e.middle_name || '';
    document.getElementById('edit_e_ln').value = e.last_name;
    document.getElementById('edit_e_suffix').value = e.suffix || '';
    document.getElementById('edit_e_email').value = e.email;
    document.getElementById('edit_e_contact').value = e.contact_number || '';
    document.getElementById('edit_e_type').value = e.type;
    document.getElementById('edit_e_dept').value = e.department_id;
    document.getElementById('edit_e_position').value = e.position;
    document.getElementById('edit_e_rank').value = e.rank || '';
    document.getElementById('edit_e_status').value = e.status;
    new bootstrap.Modal(document.getElementById('editEmployeeModal')).show();
}
</script>
