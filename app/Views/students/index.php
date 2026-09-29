<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Student Master Registry</h1>
        <p class="text-muted small mb-0">Centralized directory of all enrolled and registered university students.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= url('students/template') ?>" class="btn btn-outline-secondary btn-sm" title="Download Template">
            <i class="bi bi-download me-1"></i>Template
        </a>
        <a href="<?= url('students/import') ?>" class="btn btn-outline-marsu btn-sm">
            <i class="bi bi-file-earmark-arrow-up me-1"></i>Bulk CSV Import
        </a>
        <a href="<?= url('students/export') ?>" class="btn btn-outline-success btn-sm">
            <i class="bi bi-file-earmark-excel me-1"></i>Export CSV
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newStudentModal">
            <i class="bi bi-plus-lg me-1"></i>Register Student
        </button>
    </div>
</div>

<!-- Search & Filtering Toolbar -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('students') ?>" class="row g-2 align-items-center">
            <?php if (isset($_GET['r'])): ?>
                <input type="hidden" name="r" value="students">
            <?php endif; ?>
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Search student #, name, email..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="program" class="form-select form-select-sm">
                    <option value="">All Academic Programs</option>
                    <?php foreach ($programs as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= ($programFilter == $p['id']) ? 'selected' : '' ?>>
                            <?= e($p['code']) ?> - <?= e($p['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="year" class="form-select form-select-sm">
                    <option value="">All Year Levels</option>
                    <option value="1" <?= ($yearFilter === '1') ? 'selected' : '' ?>>1st Year</option>
                    <option value="2" <?= ($yearFilter === '2') ? 'selected' : '' ?>>2nd Year</option>
                    <option value="3" <?= ($yearFilter === '3') ? 'selected' : '' ?>>3rd Year</option>
                    <option value="4" <?= ($yearFilter === '4') ? 'selected' : '' ?>>4th Year</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="enrolled" <?= ($statusFilter === 'enrolled') ? 'selected' : '' ?>>Enrolled</option>
                    <option value="regular" <?= ($statusFilter === 'regular') ? 'selected' : '' ?>>Regular</option>
                    <option value="irregular" <?= ($statusFilter === 'irregular') ? 'selected' : '' ?>>Irregular</option>
                    <option value="graduated" <?= ($statusFilter === 'graduated') ? 'selected' : '' ?>>Graduated</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter"></i></button>
                <a href="<?= url('students') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Students Table Card -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-mortarboard-fill me-2"></i>Enrolled Students Master Roster</h6>
        <span class="badge badge-burgundy"><?= number_format($pagination['total']) ?> Records</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 45px;">#</th>
                        <th>Student Number</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Program & Year</th>
                        <th>Assigned Section</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($students)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No students found matching your criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($students as $index => $s): ?>
                            <tr>
                                <td><?= ($pagination['current_page'] - 1) * $pagination['per_page'] + $index + 1 ?></td>
                                <td><code><?= e($s['student_number']) ?></code></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($s['last_name'] . ', ' . $s['first_name'] . ' ' . $s['middle_name']) ?></strong>
                                    <div class="text-muted" style="font-size: 0.75rem;"><?= e($s['email']) ?></div>
                                </td>
                                <td><?= ucfirst(e($s['gender'])) ?></td>
                                <td>
                                    <span class="badge badge-burgundy"><?= e($s['program_code']) ?></span>
                                    <span class="text-muted ms-1">Year <?= e($s['year_level']) ?></span>
                                </td>
                                <td><?= e($s['section_name'] ?: 'Unassigned') ?></td>
                                <td>
                                    <span class="badge badge-soft-success"><?= ucfirst(e($s['enrollment_status'])) ?></span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-marsu me-1" onclick='editStudent(<?= json_encode($s) ?>)' title="Edit Record">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="<?= url('students/delete') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete="Archive student record for <?= e($s['student_number']) ?>?" title="Archive">
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

    <!-- Pagination Footer -->
    <?php if ($pagination['last_page'] > 1): ?>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2">
            <span class="small text-muted">Showing page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?> (<?= number_format($pagination['total']) ?> total)</span>
            <ul class="pagination pagination-sm mb-0">
                <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
                    <li class="page-item <?= ($i == $pagination['current_page']) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= url('students', array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: New Student -->
<div class="modal fade" id="newStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Register New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('students/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Student Number</label>
                            <input type="text" name="student_number" class="form-control form-control-sm" placeholder="e.g. 23-01452" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Institutional Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="e.g. student@marsu.edu.ph" required>
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
                            <input type="text" name="suffix" class="form-control form-control-sm" placeholder="Jr.">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Gender</label>
                            <select name="gender" class="form-select form-select-sm" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Date of Birth</label>
                            <input type="date" name="birthdate" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Enrollment Status</label>
                            <select name="enrollment_status" class="form-select form-select-sm">
                                <option value="enrolled">Enrolled</option>
                                <option value="regular">Regular</option>
                                <option value="irregular">Irregular</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Degree Program</label>
                            <select name="program_id" class="form-select form-select-sm" required>
                                <?php foreach ($programs as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= e($p['code']) ?> - <?= e($p['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Year Level</label>
                            <select name="year_level" class="form-select form-select-sm" required>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Section (Optional)</label>
                            <select name="section_id" class="form-select form-select-sm">
                                <option value="">Unassigned</option>
                                <?php foreach ($sections as $sec): ?>
                                    <option value="<?= $sec['id'] ?>"><?= e($sec['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Residential Address</label>
                        <input type="text" name="address" class="form-control form-control-sm" placeholder="Barangay, Municipality, Province">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Enroll Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Student -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Edit Student Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('students/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_s_id">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Student Number</label>
                            <input type="text" name="student_number" id="edit_s_number" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Institutional Email</label>
                            <input type="email" name="email" id="edit_s_email" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Contact Number</label>
                            <input type="text" name="contact_number" id="edit_s_contact" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">First Name</label>
                            <input type="text" name="first_name" id="edit_s_fn" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Middle Name</label>
                            <input type="text" name="middle_name" id="edit_s_mn" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Last Name</label>
                            <input type="text" name="last_name" id="edit_s_ln" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small font-weight-bold">Suffix</label>
                            <input type="text" name="suffix" id="edit_s_suffix" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Degree Program</label>
                            <select name="program_id" id="edit_s_program" class="form-select form-select-sm" required>
                                <?php foreach ($programs as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= e($p['code']) ?> - <?= e($p['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Year Level</label>
                            <select name="year_level" id="edit_s_year" class="form-select form-select-sm" required>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Section</label>
                            <select name="section_id" id="edit_s_section" class="form-select form-select-sm">
                                <option value="">Unassigned</option>
                                <?php foreach ($sections as $sec): ?>
                                    <option value="<?= $sec['id'] ?>"><?= e($sec['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="enrollment_status" id="edit_s_status" class="form-select form-select-sm">
                                <option value="enrolled">Enrolled</option>
                                <option value="regular">Regular</option>
                                <option value="irregular">Irregular</option>
                                <option value="graduated">Graduated</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small font-weight-bold">Address</label>
                            <input type="text" name="address" id="edit_s_address" class="form-control form-control-sm">
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
function editStudent(s) {
    document.getElementById('edit_s_id').value = s.id;
    document.getElementById('edit_s_number').value = s.student_number;
    document.getElementById('edit_s_fn').value = s.first_name;
    document.getElementById('edit_s_mn').value = s.middle_name || '';
    document.getElementById('edit_s_ln').value = s.last_name;
    document.getElementById('edit_s_suffix').value = s.suffix || '';
    document.getElementById('edit_s_email').value = s.email;
    document.getElementById('edit_s_contact').value = s.contact_number || '';
    document.getElementById('edit_s_program').value = s.program_id;
    document.getElementById('edit_s_year').value = s.year_level;
    document.getElementById('edit_s_section').value = s.section_id || '';
    document.getElementById('edit_s_status').value = s.enrollment_status;
    document.getElementById('edit_s_address').value = s.address || '';
    new bootstrap.Modal(document.getElementById('editStudentModal')).show();
}
</script>
