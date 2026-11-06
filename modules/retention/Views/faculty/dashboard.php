<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Faculty Academic Workspace Dashboard (dashboard.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Top Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 mb-4 border-bottom gap-2">
        <div>
            <h4 class="fw-bold mb-1" style="color: #800020;">
                <i class="bi bi-person-workspace me-2"></i>Faculty Academic Workspace
            </h4>
            <div class="text-muted small">
                Manage your assigned classes, live scoring matrices, roll-call attendance, and academic evaluations.
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/faculty/classes') ?>" class="btn btn-sm btn-outline-dark fw-semibold">
                <i class="bi bi-grid-3x3-gap me-1"></i> My Classes
            </a>
            <a href="<?= url('retention/faculty/attendance') ?>" class="btn btn-sm text-white fw-semibold" style="background-color: #800020;">
                <i class="bi bi-calendar-check me-1"></i> Roll-Call Attendance
            </a>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold text-uppercase">Assigned Classes</span>
                        <div class="rounded-circle p-2" style="background-color: rgba(128, 0, 32, 0.1); color: #800020;">
                            <i class="bi bi-journal-bookmark-fill fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?= (int) ($totalClasses ?? 0) ?></h3>
                    <div class="small text-muted mt-1">
                        Active teaching offerings
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold text-uppercase">Enrolled Students</span>
                        <div class="rounded-circle p-2 bg-primary-subtle text-primary">
                            <i class="bi bi-people-fill fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?= (int) ($enrolledStudentsCount ?? 0) ?></h3>
                    <div class="small text-muted mt-1">
                        Total students on rosters
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold text-uppercase">Pending Posting</span>
                        <div class="rounded-circle p-2 bg-warning-subtle text-warning">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?= (int) ($pendingClasses ?? 0) ?></h3>
                    <div class="small text-muted mt-1">
                        Draft scoring matrices
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold text-uppercase">Pending INC Marks</span>
                        <div class="rounded-circle p-2 bg-danger-subtle text-danger">
                            <i class="bi bi-exclamation-diamond-fill fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?= (int) ($pendingIncCount ?? 0) ?></h3>
                    <div class="small text-muted mt-1">
                        Awaiting requirement completion
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row g-4 mb-4">
        <!-- Assigned Classes Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0" style="color: #800020;">
                        <i class="bi bi-table me-2"></i>My Teaching Classes & Subject Sections
                    </h6>
                    <a href="<?= url('retention/faculty/classes') ?>" class="btn btn-sm btn-link text-decoration-none p-0 fw-semibold">
                        View All (<?= (int) ($totalClasses ?? 0) ?>) →
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($recentClasses)): ?>
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <h6 class="fw-semibold mb-1">No teaching classes assigned yet</h6>
                            <p class="small mb-0">Department administrators assign subject offerings to faculty.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Subject</th>
                                        <th>Section & Term</th>
                                        <th class="text-center">Enrolled</th>
                                        <th class="text-center">Grade Status</th>
                                        <th class="text-end pe-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentClasses as $c): ?>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="fw-bold text-dark"><?= e($c['subject_code']) ?></div>
                                                <small class="text-muted"><?= e($c['subject_title']) ?> (<?= e($c['subject_units']) ?>u)</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border"><?= e($c['section_name']) ?></span>
                                                <div class="small text-muted mt-1"><?= e($c['semester_name'] ?? 'Current Term') ?></div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1">
                                                    <?= (int) ($c['student_count'] ?? 0) ?> students
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($c['grade_status'] === 'posted'): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success">Posted</span>
                                                <?php elseif ($c['grade_status'] === 'locked'): ?>
                                                    <span class="badge bg-dark-subtle text-dark border border-secondary">Locked</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning-subtle text-warning border border-warning">Draft</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-end pe-3">
                                                <a href="<?= url('retention/faculty/classes/' . (int) $c['id']) ?>" class="btn btn-sm text-white fw-semibold px-2 py-1" style="background-color: #800020;">
                                                    Class Record <i class="bi bi-arrow-right ms-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar: Quick Links & Recent Roll-Call -->
        <div class="col-lg-4">
            <!-- Pending INC Requirements Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-clock-history me-2 text-danger"></i>Pending Incompletes (INC)
                    </h6>
                </div>
                <div class="card-body p-3">
                    <?php if (empty($pendingIncs)): ?>
                        <div class="text-center py-3 text-muted small">
                            <i class="bi bi-check2-circle fs-3 text-success d-block mb-1"></i>
                            No pending incomplete marks requiring resolution.
                        </div>
                    <?php else: ?>
                        <div class="d-flex flex-column gap-2">
                            <?php foreach ($pendingIncs as $inc): ?>
                                <div class="p-2 rounded bg-light border">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="text-dark small"><?= e($inc['last_name'] . ', ' . $inc['first_name']) ?></strong>
                                        <span class="badge bg-danger-subtle text-danger border border-danger">INC</span>
                                    </div>
                                    <div class="small text-muted d-flex justify-content-between">
                                        <span><?= e($inc['subject_code']) ?> (<?= e($inc['section_name']) ?>)</span>
                                        <span>Due: <?= !empty($inc['inc_deadline']) ? e($inc['inc_deadline']) : 'Not set' ?></span>
                                    </div>
                                    <div class="text-end mt-2">
                                        <a href="<?= url('retention/faculty/classes/' . (int) $inc['class_id']) ?>" class="btn btn-xs btn-outline-primary py-0 px-2" style="font-size: 11px;">
                                            Resolve in Record →
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Attendance Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-calendar2-check me-2 text-primary"></i>Recent Roll-Call Logs
                    </h6>
                    <a href="<?= url('retention/faculty/attendance') ?>" class="btn btn-sm btn-link text-decoration-none p-0 fw-semibold">
                        Roll-Call →
                    </a>
                </div>
                <div class="card-body p-3">
                    <?php if (empty($recentAttendance)): ?>
                        <div class="text-center py-3 text-muted small">
                            <i class="bi bi-calendar-x fs-3 d-block mb-1 text-secondary"></i>
                            No recent roll-call attendance logs found.
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush small">
                            <?php foreach ($recentAttendance as $ra): ?>
                                <div class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold text-dark"><?= e($ra['last_name'] ?? $ra['student_id']) ?></div>
                                        <span class="text-muted"><?= e($ra['subject_code']) ?> • <?= e($ra['session_date']) ?></span>
                                    </div>
                                    <span class="badge <?= $ra['status'] === 'Present' ? 'bg-success' : ($ra['status'] === 'Absent' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                                        <?= e($ra['status']) ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
