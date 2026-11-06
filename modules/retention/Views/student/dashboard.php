<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Student Academic Snapshot & Dashboard (dashboard.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($isPreview) && !empty($student)): ?>
        <div class="alert alert-warning border border-warning shadow-xs mb-3 py-2 px-3 rounded-2 d-flex align-items-center justify-content-between" role="alert">
            <div>
                <i class="bi bi-eye-fill me-1"></i>
                <strong>Diagnostic Preview Mode:</strong> You are viewing the student portal as <strong><?= e($student['first_name'] . ' ' . $student['last_name']) ?></strong> (<?= e($student['student_number']) ?>).
            </div>
            <span class="badge bg-dark text-white">Administrator View</span>
        </div>
    <?php endif; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'dashboard'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record. If you are an administrator, use the <em>Preview as Student</em> feature from a student profile dossier.</p>
        </div>
    <?php else: ?>

        <!-- Student Hero Banner -->
        <div class="card border-0 shadow-sm mb-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #800020 0%, #4a0013 100%);">
            <div class="card-body p-4 position-relative">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white text-dark d-flex align-items-center justify-content-center fw-bold shadow" style="width: 64px; height: 64px; font-size: 24px; color: #800020 !important;">
                            <?= strtoupper(substr($student['first_name'] ?? 'S', 0, 1) . substr($student['last_name'] ?? 'M', 0, 1)) ?>
                        </div>
                        <div>
                            <div class="badge bg-warning text-dark px-2 py-1 mb-1 fw-bold" style="font-size: 11px;">
                                <i class="bi bi-mortarboard-fill me-1"></i> Student Self-Service Portal
                            </div>
                            <h4 class="fw-bold mb-0 text-white"><?= e($student['first_name'] . ' ' . $student['last_name']) ?></h4>
                            <div class="text-white-50 small mt-1">
                                Student ID: <strong class="text-white"><?= e($student['student_number']) ?></strong> • 
                                Program: <strong class="text-white"><?= e($student['program_code'] ?? 'N/A') ?></strong> (<?= e($student['section_name'] ?? 'Section') ?>)
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= url('retention/my/grades') ?>" class="btn btn-sm btn-light fw-semibold text-dark shadow-xs">
                            <i class="bi bi-file-earmark-text me-1"></i> Grade Report
                        </a>
                        <a href="<?= url('retention/my/attendance') ?>" class="btn btn-sm btn-outline-light shadow-xs">
                            <i class="bi bi-calendar-check me-1"></i> Attendance
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Retention Supportive Advisory if Deficiencies Exist -->
        <?php if (!empty($hasInc) || !empty($hasFailed)): ?>
            <div class="alert alert-warning border border-warning shadow-sm d-flex align-items-start gap-3 mb-4" role="alert">
                <i class="bi bi-info-circle-fill fs-4 text-warning flex-shrink-0"></i>
                <div class="small">
                    <strong>Academic Support Recommended:</strong>
                    You have active academic requirements (Incomplete or Failed mark) that require attention. 
                    Please reach out to your respective course instructor or visit your department academic adviser for guidance on removal procedures.
                    <div class="mt-2">
                        <a href="<?= url('retention/my/deficiencies') ?>" class="btn btn-xs btn-outline-dark fw-semibold py-1 px-2" style="font-size: 11.5px;">
                            <i class="bi bi-arrow-right-circle me-1"></i> Review Requirements & Removal Deadlines
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Real Key Academic Snapshot Metrics -->
        <div class="row g-3 mb-4">
            <!-- Enrolled Classes -->
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #0d6efd !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Active Course Offerings</span>
                    <h3 class="fw-bold text-dark mb-0 mt-2"><?= $enrolledCount ?></h3>
                    <small class="text-muted mt-1 d-block">Enrolled this term</small>
                </div>
            </div>

            <!-- Earned / Passed Units -->
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #198754 !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Completed Credits</span>
                    <h3 class="fw-bold text-success mb-0 mt-2"><?= number_format($passedUnits, 1) ?></h3>
                    <small class="text-muted mt-1 d-block">Units earned from posted marks</small>
                </div>
            </div>

            <!-- Term Grade Point Average (GPA) -->
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #800020 !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Evaluated Term GPA</span>
                    <h3 class="fw-bold text-dark mb-0 mt-2">
                        <?= $termGpa !== null ? number_format($termGpa, 2) : '<span class="fs-6 text-muted">Under Eval</span>' ?>
                    </h3>
                    <small class="text-muted mt-1 d-block">
                        <?= $termGpa !== null ? 'Weighted on scale: 1.00 - 3.00' : 'Awaiting instructor posting' ?>
                    </small>
                </div>
            </div>

            <!-- Attendance Telemetry Health -->
            <div class="col-sm-6 col-xl-3">
                <?php
                $tot = (int) ($attSummary['total_sessions'] ?? 0);
                $abs = (int) ($attSummary['absent_count'] ?? 0);
                $prs = (int) ($attSummary['present_count'] ?? 0);
                $attRate = ($tot > 0) ? round(($prs / $tot) * 100, 1) : null;
                $borderCol = ($attRate !== null && $attRate < 80.0) ? '#dc3545' : '#D4AF37';
                ?>
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid <?= $borderCol ?> !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Roll-Call Attendance</span>
                    <h3 class="fw-bold text-dark mb-0 mt-2">
                        <?= $attRate !== null ? "{$attRate}%" : '<span class="fs-6 text-muted">No Logs Yet</span>' ?>
                    </h3>
                    <small class="text-muted mt-1 d-block">
                        <?= $tot > 0 ? "{$abs} unexcused cut(s) in {$tot} session(s)" : 'Roll-call begins with class sessions' ?>
                    </small>
                </div>
            </div>
        </div>

        <!-- Enrolled Classes & Academic Standing Table -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold text-dark mb-0">Current Enrolled Courses</h6>
                    <small class="text-muted" style="font-size: 11.5px;">Evaluations and mark sheets recorded by assigned faculty members</small>
                </div>
                <span class="badge bg-light text-secondary border"><?= count($classes) ?> Course(s)</span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($classes)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">You are not enrolled in any active class offerings in the system.</p>
                        <small>Course enrollments will appear once class rosters are finalized by the administration.</small>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th class="ps-3" style="width: 140px;">Course Code</th>
                                    <th>Course Title</th>
                                    <th>Units</th>
                                    <th>Section</th>
                                    <th>Instructor</th>
                                    <th class="text-center" style="width: 150px;">Evaluation Status</th>
                                    <th class="text-end pe-3" style="width: 130px;">Official Grade</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($classes as $cl): ?>
                                    <?php
                                    $isPosted = in_array($cl['grade_status'], ['posted', 'locked'], true);
                                    ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($cl['subject_code']) ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($cl['subject_title']) ?></div>
                                            <small class="text-muted"><?= e($cl['semester_name'] ?? 'Current Term') ?></small>
                                        </td>
                                        <td><?= number_format((float) ($cl['units'] ?? 3.0), 1) ?></td>
                                        <td>
                                            <span class="badge bg-light text-secondary border"><?= e($cl['section_name']) ?></span>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-semibold"><?= e($cl['instructor_name'] ?? 'Unassigned') ?></div>
                                            <small class="text-muted"><?= e($cl['instructor_email'] ?? '') ?></small>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($isPosted): ?>
                                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                                    <i class="bi bi-check-circle-fill me-1"></i> Grade Posted
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                                    <i class="bi bi-hourglass-split me-1"></i> In Progress
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <?php if ($isPosted && !empty($cl['final_grade'])): ?>
                                                <?php
                                                $rem = strtoupper($cl['remarks'] ?? '');
                                                $badgeCls = ($rem === 'PASSED') ? 'bg-success text-white' : (($rem === 'INC') ? 'bg-warning text-dark' : 'bg-danger text-white');
                                                ?>
                                                <div class="fw-bold fs-6 text-dark"><?= e($cl['final_grade']) ?></div>
                                                <span class="badge <?= $badgeCls ?>" style="font-size: 10px;"><?= e($rem) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-size: 11px;">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>

</div>
