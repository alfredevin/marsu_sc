<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Student Academic Profile - Faculty Scoped View (student_view.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Header & Breadcrumbs -->
    <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 mb-4 border-bottom gap-2">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= url('retention/faculty/students') ?>" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Students
            </a>
            <div>
                <h4 class="fw-bold mb-0 text-dark">
                    <?= e($student['last_name'] . ', ' . $student['first_name'] . ' ' . ($student['middle_name'] ? substr($student['middle_name'], 0, 1) . '.' : '')) ?>
                </h4>
                <div class="text-muted small">
                    Student ID: <code class="fw-bold text-dark"><?= e($student['student_number']) ?></code> • 
                    Program: <strong><?= e($student['program_code'] ?? 'BSIS') ?> (Year <?= (int) $student['year_level'] ?>)</strong> • 
                    Section: <strong><?= e($student['section_name'] ?? 'Section') ?></strong>
                </div>
            </div>
        </div>
        <div>
            <span class="badge bg-success-subtle text-success border border-success px-3 py-2">
                <i class="bi bi-person-check-fill me-1"></i> <?= e($student['enrollment_status'] ?? 'Enrolled') ?>
            </span>
        </div>
    </div>

    <!-- Statutory RA 10173 Privacy Notice Banner -->
    <div class="alert alert-light border shadow-sm d-flex align-items-center gap-3 mb-4 py-2 px-3 small">
        <div class="rounded-circle p-2 text-primary" style="background-color: rgba(13, 110, 253, 0.1);">
            <i class="bi bi-shield-lock-fill fs-5"></i>
        </div>
        <div>
            <strong class="text-dark">Data Privacy Act Compliance (RA 10173):</strong>
            <span class="text-muted">
                This academic profile displays records strictly for classes taught by your faculty account. Contact numbers, residential addresses, and guardian information are protected and redacted from faculty workspace views.
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- 1. Enrolled Classes with You -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0" style="color: #800020;">
                        <i class="bi bi-journal-bookmark-fill me-2"></i>Classes Enrolled with You & Academic Evaluations
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($classes)): ?>
                        <div class="p-4 text-center text-muted small">
                            No class enrollments found with your faculty account.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Subject</th>
                                        <th>Section</th>
                                        <th class="text-center">Units</th>
                                        <th class="text-center">Class Status</th>
                                        <th class="text-center">Computed Grade</th>
                                        <th class="text-center">Official Grade</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-end pe-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($classes as $c): ?>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="fw-bold text-dark"><?= e($c['subject_code']) ?></div>
                                                <small class="text-muted"><?= e($c['subject_title']) ?></small>
                                            </td>
                                            <td><?= e($c['section_name']) ?></td>
                                            <td class="text-center"><?= e($c['units']) ?></td>
                                            <td class="text-center">
                                                <?php if ($c['grade_status'] === 'posted'): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success">Posted</span>
                                                <?php elseif ($c['grade_status'] === 'locked'): ?>
                                                    <span class="badge bg-dark-subtle text-dark border border-secondary">Locked</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning-subtle text-warning border border-warning">Draft</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center fw-bold text-primary">
                                                <?= !empty($c['computed_grade']) ? number_format((float) $c['computed_grade'], 2) : '—' ?>
                                            </td>
                                            <td class="text-center fw-bold fs-6">
                                                <?= !empty($c['final_grade']) ? e($c['final_grade']) : '—' ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (!empty($c['remarks'])): ?>
                                                    <span class="badge <?= $c['remarks'] === 'Passed' ? 'bg-success' : ($c['remarks'] === 'Incomplete' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                                        <?= e($c['remarks']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted">—</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-end pe-3">
                                                <a href="<?= url('retention/faculty/classes/' . (int) $c['class_id']) ?>" class="btn btn-sm btn-outline-dark" style="font-size: 11.5px;">
                                                    Open Matrix →
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

        <!-- 2. Recorded Assessment Scores & Task Exceptions -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-file-earmark-check me-2 text-primary"></i>Assessment Scores & Task Exceptions
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($scores)): ?>
                        <div class="p-4 text-center text-muted small">
                            No assessment item scores recorded for this student yet.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Subject & Item</th>
                                        <th class="text-center">Score</th>
                                        <th class="text-center">Submission Status</th>
                                        <th class="pe-3">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($scores as $sc): ?>
                                        <tr>
                                            <td class="ps-3">
                                                <strong><?= e($sc['subject_code']) ?></strong> • <code><?= e($sc['item_code']) ?></code>
                                            </td>
                                            <td class="text-center fw-bold text-dark">
                                                <?= number_format((float) $sc['score'], 2) ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($sc['submission_status'] === 'late'): ?>
                                                    <span class="badge bg-warning-subtle text-warning border border-warning">Late</span>
                                                <?php elseif ($sc['submission_status'] === 'missing'): ?>
                                                    <span class="badge bg-danger-subtle text-danger border border-danger">Missing</span>
                                                <?php elseif ($sc['submission_status'] === 'excused'): ?>
                                                    <span class="badge bg-info-subtle text-info border border-info">Excused</span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-secondary border">Regular</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="pe-3 text-muted small">
                                                <?= e($sc['notes'] ?: '—') ?>
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

        <!-- 3. Attendance Sessions & Conduct Reports -->
        <div class="col-lg-6">
            <!-- Attendance History -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-calendar-check me-2 text-success"></i>Roll-Call Attendance Logs
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($attendance)): ?>
                        <div class="p-4 text-center text-muted small">
                            No roll-call attendance logs recorded for this student.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive" style="max-height: 250px;">
                            <table class="table table-hover align-middle mb-0" style="font-size: 12px;">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th class="ps-3">Date</th>
                                        <th>Subject</th>
                                        <th class="text-center">Status</th>
                                        <th class="pe-3">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attendance as $att): ?>
                                        <tr>
                                            <td class="ps-3"><?= e($att['session_date']) ?></td>
                                            <td><?= e($att['subject_code']) ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $att['status'] === 'Present' ? 'bg-success' : ($att['status'] === 'Absent' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                                                    <?= e($att['status']) ?>
                                                </span>
                                            </td>
                                            <td class="pe-3 text-muted small"><?= e($att['remarks'] ?: '—') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Conduct Reports Filed by this Faculty -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-shield-exclamation me-2 text-danger"></i>Conduct Incident Reports Filed by You
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($conductReports)): ?>
                        <div class="p-3 text-center text-muted small">
                            No conduct incident reports filed for this student.
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush small">
                            <?php foreach ($conductReports as $cr): ?>
                                <div class="list-group-item px-3 py-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="text-dark"><?= e($cr['incident_type']) ?></strong>
                                        <span class="badge <?= $cr['severity'] === 'Severe' ? 'bg-danger' : ($cr['severity'] === 'Moderate' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                            <?= e($cr['severity']) ?>
                                        </span>
                                    </div>
                                    <p class="text-muted mb-1"><?= e($cr['description']) ?></p>
                                    <div class="d-flex justify-content-between text-secondary" style="font-size: 11px;">
                                        <span>Date: <?= e($cr['incident_date']) ?></span>
                                        <span>Status: <strong class="text-dark"><?= e($cr['status']) ?></strong></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
