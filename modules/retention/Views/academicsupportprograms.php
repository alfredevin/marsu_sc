<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-mortarboard-fill me-1"></i> Academic Support & Peer Tutoring Programs
            </h6>
            <small class="text-muted">Institutional peer mentoring, subject remediation clinics, and academic recovery groups.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="search" name="q" class="form-control form-control-sm" placeholder="Search student or course..." value="<?= htmlspecialchars($search ?? '') ?>" style="width: 180px;">
                <select name="department" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <button type="button" class="btn btn-sm btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#newSupportModal">
                <i class="bi bi-plus-lg me-1"></i> Enroll in Support Program
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Active Enrollees</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $activeTutees ?? count($supportList ?? []) ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">Enrolled</span>
                </div>
                <small class="text-muted mt-2 d-block">Students receiving peer tutoring</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Remediation Subjects</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= $subjectCount ?? 0 ?></h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">Active Clinics</span>
                </div>
                <small class="text-muted mt-2 d-block">Courses with active tutoring groups</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Assigned Peer Mentors</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= $mentorCount ?? 0 ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Honor Students</span>
                </div>
                <small class="text-muted mt-2 d-block">Student tutors conducting sessions</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Completed Batches</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $completedBatches ?? 0 ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Graduated</span>
                </div>
                <small class="text-muted mt-2 d-block">Successfully completed remediation</small>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-people-fill me-1"></i> Peer Mentoring & Academic Remediation Roster
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student Details</th>
                        <th class="py-3">Program</th>
                        <th class="py-3">Target Subject</th>
                        <th class="py-3">Support Program / Clinic</th>
                        <th class="py-3">Assigned Mentor</th>
                        <th class="py-3 text-center">Enrollment Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($supportList)): ?>
                        <?php foreach ($supportList as $row): ?>
                            <tr>
                                <td class="ps-3 fw-semibold text-dark">
                                    <div><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['student_id'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['department'] ?? 'BSIS') ?></span>
                                </td>
                                <td class="fw-bold text-dark">
                                    <?= htmlspecialchars($row['subject_code'] ?? 'IT211') ?>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark"><?= htmlspecialchars($row['program_name'] ?? 'CICS Peer Tutoring Clinic') ?></span>
                                    <small class="text-muted d-block">Enrolled: <?= htmlspecialchars($row['enrolled_at'] ?? date('Y-m-d')) ?></small>
                                </td>
                                <td>
                                    <i class="bi bi-person-badge me-1 text-success"></i>
                                    <?= htmlspecialchars($row['mentor_name'] ?? 'Honor Mentor') ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $st = $row['status'] ?? 'Active';
                                    $stBadge = ($st === 'Completed') ? 'bg-success-subtle text-success border border-success' : (($st === 'Active' || $st === 'Enrolled') ? 'bg-info-subtle text-info border border-info' : 'bg-light text-secondary border');
                                    ?>
                                    <span class="badge <?= $stBadge ?>"><?= htmlspecialchars($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($row['student_id'] ?? '') ?>" class="btn btn-sm btn-outline-primary">
                                        Profile
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-mortarboard fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No active peer tutoring enrollments</p>
                                <small>Click "Enroll in Support Program" to assign a student to peer tutoring.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Enroll Support -->
<div class="modal fade" id="newSupportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-person-plus-fill me-1"></i> Enroll Student in Academic Support Program
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="support">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT ID / NUMBER</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">TARGET COURSE / SUBJECT CODE</label>
                            <input type="text" name="subject_code" class="form-control form-control-sm" placeholder="e.g. IT211" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">SUPPORT PROGRAM TITLE</label>
                        <select name="program_name" class="form-select form-select-sm" required>
                            <option value="CICS Peer Mentoring Clinic">CICS Peer Mentoring Clinic</option>
                            <option value="Math & Algorithms Remediation Group">Math & Algorithms Remediation Group</option>
                            <option value="General Academic Support & Study Habits">General Academic Support & Study Habits</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">ASSIGNED PEER MENTOR</label>
                            <input type="text" name="mentor_name" class="form-control form-control-sm" placeholder="e.g. Juan Cruz (Dean's Lister)">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">ENROLLMENT DATE</label>
                            <input type="date" name="enrolled_at" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success px-4 fw-semibold">Enroll Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
