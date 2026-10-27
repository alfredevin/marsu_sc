<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Completed Academic Credits & Curriculum Progress (progress.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'progress'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record.</p>
        </div>
    <?php else: ?>

        <!-- Key Summary Overview Card -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #198754 !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Cumulative Earned Credits</span>
                    <h3 class="fw-bold text-success mb-0 mt-2"><?= number_format((float) ($totalUnits ?? 0), 1) ?></h3>
                    <small class="text-muted mt-1 d-block">Total academic units completed</small>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #800020 !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Completed Subjects</span>
                    <h3 class="fw-bold text-dark mb-0 mt-2"><?= count($passedCourses ?? []) ?></h3>
                    <small class="text-muted mt-1 d-block">Passed courses with official marks</small>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="card border-0 shadow-sm p-3 h-100 bg-white" style="border-left: 4px solid #0d6efd !important;">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Degree Program Curriculum</span>
                    <h5 class="fw-bold text-dark mb-0 mt-2 text-truncate" title="<?= e($student['program_name'] ?? '') ?>">
                        <?= e($student['program_code'] ?? 'Degree Program') ?>
                    </h5>
                    <small class="text-muted mt-1 d-block">
                        <?= !empty($student['program_years']) ? e($student['program_years']) . '-Year Degree Program' : 'Undergraduate Curriculum' ?>
                    </small>
                </div>
            </div>
        </div>

        <!-- Completed Courses Ledger Table -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold text-dark mb-0">Completed Academic Courses</h6>
                    <small class="text-muted" style="font-size: 11.5px;">Accredited subjects satisfying curricular degree requirements</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success"><?= count($passedCourses ?? []) ?> Passed Course(s)</span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($passedCourses)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-mortarboard fs-1 d-block mb-2 text-secondary"></i>
                        <h6 class="fw-bold text-dark mb-1">No Completed Course Credits Recorded Yet</h6>
                        <p class="text-secondary small mb-0">Official academic credits will appear here once faculty instructors submit and post your passing course marks.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th class="ps-3" style="width: 140px;">Course Code</th>
                                    <th>Course Title</th>
                                    <th>Academic Term</th>
                                    <th class="text-center" style="width: 90px;">Units</th>
                                    <th class="text-center" style="width: 120px;">Earned Mark</th>
                                    <th class="text-end pe-3" style="width: 120px;">Accreditation</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($passedCourses as $pc): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($pc['subject_code']) ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($pc['subject_title']) ?></div>
                                        </td>
                                        <td class="text-secondary">
                                            <?= e($pc['semester_name'] ?? 'Term') ?> • <?= e($pc['academic_year_label'] ?? 'AY') ?>
                                        </td>
                                        <td class="text-center fw-semibold"><?= number_format((float) ($pc['units'] ?? 3.0), 1) ?></td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark fs-6"><?= e($pc['final_grade']) ?></span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <span class="badge bg-success px-2 py-1 text-white">
                                                <i class="bi bi-check-circle me-1"></i> Credited
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light small fw-bold">
                                <tr>
                                    <td colspan="3" class="ps-3 text-uppercase">Total Earned Academic Credits:</td>
                                    <td class="text-center text-success fs-6"><?= number_format((float) ($totalUnits ?? 0), 1) ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Academic Advising Checklist Notice -->
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-3">
                <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-info-circle text-primary fs-5 flex-shrink-0"></i>
                    <div class="small text-secondary" style="font-size: 11.5px; line-height: 1.45;">
                        <strong class="text-dark">Curricular Evaluation Note:</strong>
                        Official degree audits and graduation clearance are verified by your College Curriculum Committee and the University Registrar based on your approved program prospectus. To request an official prospectus evaluation or credit transfer verification, please visit your Department Chairperson's office.
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>
