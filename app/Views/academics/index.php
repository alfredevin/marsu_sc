<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Academic Calendar & Sections</h1>
        <p class="text-muted small mb-0">Manage university academic years, active semesters, and instructional class sections.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newYearModal">
            <i class="bi bi-calendar-plus me-1"></i>New Academic Year
        </button>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newSectionModal">
            <i class="bi bi-plus-lg me-1"></i>New Section
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Academic Years & Active Terms -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-calendar3 me-2"></i>Academic Years</h6>
                <span class="badge badge-burgundy"><?= count($academicYears) ?> Years</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 small">
                        <thead class="bg-light">
                            <tr>
                                <th>Code / Label</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($academicYears as $ay): ?>
                                <tr>
                                    <td>
                                        <strong><?= e($ay['label']) ?></strong>
                                        <div class="text-muted" style="font-size:0.75rem;">Code: <?= e($ay['code']) ?></div>
                                    </td>
                                    <td><?= date('M Y', strtotime($ay['start_date'])) ?> – <?= date('M Y', strtotime($ay['end_date'])) ?></td>
                                    <td>
                                        <?php if ($ay['is_active']): ?>
                                            <span class="badge badge-gold"><i class="bi bi-check-circle-fill me-1"></i>Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if (!$ay['is_active']): ?>
                                            <form method="POST" action="<?= url('academics/activate-year') ?>" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $ay['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-marsu py-0 px-2" style="font-size:0.75rem;">
                                                    Set Active
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
    </div>

    <!-- Semesters Configuration -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-clock-history me-2"></i>Active Term / Semesters</h6>
                <span class="badge badge-gold">Official Term</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 small">
                        <thead class="bg-light">
                            <tr>
                                <th>Semester Name</th>
                                <th>Academic Year</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($semesters as $s): ?>
                                <tr>
                                    <td><strong><?= e($s['name']) ?></strong></td>
                                    <td><?= e($s['academic_year_label']) ?></td>
                                    <td>
                                        <?php if ($s['is_active']): ?>
                                            <span class="badge badge-gold"><i class="bi bi-check-circle-fill me-1"></i>Active Term</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if (!$s['is_active']): ?>
                                            <form method="POST" action="<?= url('academics/activate-semester') ?>" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-marsu py-0 px-2" style="font-size:0.75rem;">
                                                    Set Active
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
    </div>
</div>

<!-- Class Sections Table -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-collection-fill me-2"></i>Class Sections Registry</h6>
        <span class="badge badge-burgundy"><?= count($sections) ?> Sections</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Section Name</th>
                        <th>Program</th>
                        <th>Year Level</th>
                        <th>Academic Year</th>
                        <th class="text-center">Enrolled Students</th>
                        <th class="text-end" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($sections)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No sections registered yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($sections as $index => $sec): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><strong class="text-marsu-burgundy"><?= e($sec['name']) ?></strong></td>
                                <td><?= e($sec['program_code']) ?></td>
                                <td>Year <?= e($sec['year_level']) ?></td>
                                <td><?= e($sec['academic_year_label']) ?></td>
                                <td class="text-center"><span class="badge bg-light text-dark border"><?= $sec['students_count'] ?></span></td>
                                <td class="text-end">
                                    <form method="POST" action="<?= url('academics/delete-section') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $sec['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" data-confirm-delete="Archive section '<?= e($sec['name']) ?>'?" title="Archive">
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

<!-- Modal: New Academic Year -->
<div class="modal fade" id="newYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Academic Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('academics/create-year') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Academic Year Code</label>
                        <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. 2027-2028" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Descriptive Label</label>
                        <input type="text" name="label" class="form-control form-control-sm" placeholder="e.g. A.Y. 2027-2028" required>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Academic Year</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: New Section -->
<div class="modal fade" id="newSectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Create Class Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('academics/create-section') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Section Designation</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. BSIS 3B" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Academic Degree Program</label>
                        <select name="program_id" class="form-select form-select-sm" required>
                            <?php foreach ($programs as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= e($p['code']) ?> - <?= e($p['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Year Level</label>
                            <select name="year_level" class="form-select form-select-sm" required>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Academic Year</label>
                            <select name="academic_year_id" class="form-select form-select-sm" required>
                                <?php foreach ($academicYears as $ay): ?>
                                    <option value="<?= $ay['id'] ?>" <?= $ay['is_active'] ? 'selected' : '' ?>><?= e($ay['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Create Section</button>
                </div>
            </form>
        </div>
    </div>
</div>
