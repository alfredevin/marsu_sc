<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Official Grades & Academic Mark Sheets (grades.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'grades'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record.</p>
        </div>
    <?php else: ?>

        <!-- Key Metrics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-4">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #0d6efd !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Total Enrolled Units</span>
                    <h3 class="fw-bold text-dark mb-0 mt-2"><?= number_format((float) ($totalEnrolledUnits ?? 0), 1) ?></h3>
                    <small class="text-muted mt-1 d-block">Credits across registered courses</small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #198754 !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Completed / Passed Units</span>
                    <h3 class="fw-bold text-success mb-0 mt-2"><?= number_format((float) ($totalPassedUnits ?? 0), 1) ?></h3>
                    <small class="text-muted mt-1 d-block">Official credits earned</small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #800020 !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Cumulative Grade Point Average</span>
                    <h3 class="fw-bold text-dark mb-0 mt-2">
                        <?= $cumGpa !== null ? number_format($cumGpa, 2) : '<span class="fs-6 text-muted">Awaiting Marks</span>' ?>
                    </h3>
                    <small class="text-muted mt-1 d-block">
                        <?= $cumGpa !== null ? 'Weighted on official 1.00 - 3.00 scale' : 'Grades pending official posting' ?>
                    </small>
                </div>
            </div>
        </div>

        <!-- Grade Report Table Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h6 class="fw-bold text-dark mb-0">Official Term Grade Report</h6>
                    <small class="text-muted" style="font-size: 11.5px;">Grades are finalized and posted by assigned faculty instructors</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-secondary border"><?= count($classes ?? []) ?> Enrolled Course(s)</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($classes)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-card-checklist fs-1 d-block mb-2 text-secondary"></i>
                        <h6 class="fw-bold text-dark mb-1">No Course Records Found</h6>
                        <p class="text-secondary small mb-0">You do not currently have course enrollments recorded in the system.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th class="ps-3" style="width: 140px;">Course Code</th>
                                    <th>Course Title &amp; Term</th>
                                    <th class="text-center" style="width: 80px;">Units</th>
                                    <th style="width: 130px;">Section</th>
                                    <th>Instructor</th>
                                    <th class="text-center" style="width: 150px;">Evaluation Status</th>
                                    <th class="text-center" style="width: 120px;">Final Mark</th>
                                    <th class="text-end pe-3" style="width: 130px;">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($classes as $cl): ?>
                                    <?php
                                    $isPosted = in_array($cl['grade_status'], ['posted', 'locked'], true);
                                    $rem = strtoupper($cl['remarks'] ?? '');
                                    ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($cl['subject_code']) ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($cl['subject_title']) ?></div>
                                            <small class="text-muted">
                                                <?= e($cl['semester_name'] ?? 'Semester') ?> • <?= e($cl['academic_year_label'] ?? 'Academic Year') ?>
                                            </small>
                                        </td>
                                        <td class="text-center"><?= number_format((float) ($cl['units'] ?? 3.0), 1) ?></td>
                                        <td>
                                            <span class="badge bg-light text-secondary border"><?= e($cl['section_name']) ?></span>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-semibold"><?= e($cl['instructor_name'] ?? 'Faculty Member') ?></div>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($isPosted): ?>
                                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                                    <i class="bi bi-check-circle-fill me-1"></i> Posted
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                                    <i class="bi bi-hourglass-split me-1"></i> In Progress
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($isPosted && !empty($cl['final_grade'])): ?>
                                                <span class="fw-bold fs-6 text-dark"><?= e($cl['final_grade']) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <?php if ($isPosted && !empty($rem)): ?>
                                                <?php if ($rem === 'PASSED'): ?>
                                                    <span class="badge bg-success px-2 py-1 text-white">
                                                        <i class="bi bi-check me-1"></i> PASSED
                                                    </span>
                                                <?php elseif ($rem === 'INC'): ?>
                                                    <span class="badge bg-warning text-dark px-2 py-1">
                                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> INC
                                                    </span>
                                                    <?php if (!empty($cl['inc_deadline'])): ?>
                                                        <div class="text-danger mt-1" style="font-size: 10px;">
                                                            Due: <?= date('M d, Y', strtotime($cl['inc_deadline'])) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php elseif ($rem === 'FAILED'): ?>
                                                    <span class="badge bg-danger px-2 py-1 text-white">FAILED</span>
                                                <?php elseif ($rem === 'DRP'): ?>
                                                    <span class="badge bg-secondary px-2 py-1 text-white">DROPPED</span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-dark border"><?= e($rem) ?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-size: 11.5px;">Awaiting Posting</span>
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

        <!-- MarSU Grading Scale Reference Card -->
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-3">
                <h6 class="fw-bold text-dark small mb-2">
                    <i class="bi bi-info-circle text-primary me-1"></i> Official MarSU Academic Grading System Reference
                </h6>
                <div class="row g-2 small text-secondary" style="font-size: 11px;">
                    <div class="col-6 col-md-3"><strong>1.00</strong>: Excellent (98–100%)</div>
                    <div class="col-6 col-md-3"><strong>1.25 – 1.50</strong>: Very Good (92–97%)</div>
                    <div class="col-6 col-md-3"><strong>1.75 – 2.50</strong>: Good / Satisfactory (80–91%)</div>
                    <div class="col-6 col-md-3"><strong>2.75 – 3.00</strong>: Fair / Passing (75–79%)</div>
                    <div class="col-6 col-md-3"><strong>4.00</strong>: Conditional Mark</div>
                    <div class="col-6 col-md-3"><strong>5.00</strong>: Failure (&lt; 75%)</div>
                    <div class="col-6 col-md-3"><strong>INC</strong>: Incomplete Requirements</div>
                    <div class="col-6 col-md-3"><strong>DRP</strong>: Officially Dropped Course</div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>
