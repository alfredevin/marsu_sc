<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Faculty Classes List (classes.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 mb-4 border-bottom gap-2">
        <div>
            <h4 class="fw-bold mb-1" style="color: #800020;">
                <i class="bi bi-grid-fill me-2"></i>My Teaching Classes & Subject Sections
            </h4>
            <div class="text-muted small">
                Manage your assigned subject offerings, live evaluation matrices, student rosters, and grade posting.
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/faculty/attendance') ?>" class="btn btn-sm btn-outline-secondary fw-semibold">
                <i class="bi bi-calendar-check me-1"></i> Roll-Call Attendance
            </a>
            <a href="<?= url('retention/faculty/conduct') ?>" class="btn btn-sm btn-outline-danger fw-semibold">
                <i class="bi bi-shield-exclamation me-1"></i> Conduct Reports
            </a>
        </div>
    </div>

    <!-- Classes Grid -->
    <?php if (empty($classes)): ?>
        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body">
                <i class="bi bi-inbox fs-1 d-block mb-3 text-secondary"></i>
                <h5 class="fw-bold text-dark">No Teaching Classes Assigned</h5>
                <p class="text-muted small mb-0">
                    You do not currently have any class offerings assigned to your faculty account.<br>
                    Please contact your department chair or college administrator if you need teaching assignments.
                </p>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($classes as $c): ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge text-white px-2 py-1 mb-1" style="background-color: #800020; font-size: 11px;">
                                    <?= e($c['subject_code']) ?>
                                </span>
                                <span class="badge bg-light text-dark border ms-1" style="font-size: 11px;">
                                    <?= e($c['subject_units']) ?> Units
                                </span>
                            </div>
                            <?php if ($c['grade_status'] === 'posted'): ?>
                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                    <i class="bi bi-check-circle-fill me-1"></i>Posted
                                </span>
                            <?php elseif ($c['grade_status'] === 'locked'): ?>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary px-2 py-1">
                                    <i class="bi bi-lock-fill me-1"></i>Locked
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning-subtle text-warning border border-warning px-2 py-1">
                                    <i class="bi bi-pencil-fill me-1"></i>Draft Matrix
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="fw-bold text-dark mb-2"><?= e($c['subject_title']) ?></h6>
                            
                            <div class="small text-muted mb-3 d-flex flex-column gap-1">
                                <div>
                                    <i class="bi bi-people me-1 text-primary"></i> Section: 
                                    <strong class="text-dark"><?= e($c['section_name']) ?></strong> (Year <?= (int) $c['year_level'] ?>)
                                </div>
                                <div>
                                    <i class="bi bi-calendar3 me-1 text-primary"></i> Term: 
                                    <span><?= e($c['semester_name'] ?? 'Semester') ?></span> • <?= e($c['academic_year_label'] ?? 'A.Y.') ?>
                                </div>
                                <div>
                                    <i class="bi bi-sliders me-1 text-primary"></i> Passing Cutoff: 
                                    <span class="badge bg-danger-subtle text-danger border border-danger">≤ <?= number_format((float) ($c['passing_cutoff'] ?? 3.04), 2) ?></span>
                                </div>
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="bi bi-person-lines-fill me-1"></i>
                                    <strong class="text-dark"><?= (int) ($c['student_count'] ?? 0) ?></strong> Enrolled
                                </span>

                                <div class="d-flex gap-2">
                                    <a href="<?= url('retention/faculty/attendance?class_id=' . (int) $c['id']) ?>" 
                                       class="btn btn-sm btn-outline-secondary" title="Roll-Call Attendance">
                                        <i class="bi bi-calendar-check"></i>
                                    </a>
                                    <a href="<?= url('retention/faculty/classes/' . (int) $c['id']) ?>" 
                                       class="btn btn-sm text-white fw-semibold px-3" style="background-color: #800020;">
                                        Class Record →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
