<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Governance
 * View: Create Class Offering Form (admin/class_form.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <i class="bi bi-mortarboard me-2 text-marsu-burgundy"></i>Create Class Offering
            </h4>
            <p class="text-secondary small mb-0">Establish a new curriculum offering, bind student section, and designate teaching faculty.</p>
        </div>
        <a href="<?= url('retention/admin/classes') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Classes
        </a>
    </div>

    <!-- Alert -->
    <div class="alert alert-light border border-secondary-subtle d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
        <i class="bi bi-info-circle-fill fs-5 me-3 text-marsu-burgundy"></i>
        <div class="small">
            <strong class="d-block text-dark">Snapshot Behavior (Part E3)</strong>
            <span class="text-secondary">
                Assigning a grading template copies its assessment weights and passing cutoff directly onto this class. 
                The assigned instructor will manage roster intake, task scores, and roll-call.
            </span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <span class="fw-bold text-dark fs-6">Course Offering Details</span>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= url('retention/admin/classes/store') ?>">
                        <?= csrf_field() ?>

                        <div class="row g-3">
                            <!-- Subject -->
                            <div class="col-md-8">
                                <label for="subjectSelect" class="form-label fw-bold small text-dark">Subject / Course <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="subjectSelect" name="subject_id" required>
                                    <option value="">Select subject from catalog...</option>
                                    <?php foreach ($subjects as $s): ?>
                                        <option value="<?= (int) $s['id'] ?>">
                                            <?= e($s['code']) ?> — <?= e($s['title']) ?> (<?= e($s['units']) ?> units)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Section -->
                            <div class="col-md-4">
                                <label for="sectionSelect" class="form-label fw-bold small text-dark">Section <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="sectionSelect" name="section_id" required>
                                    <option value="">Select section...</option>
                                    <?php foreach ($sections as $sec): ?>
                                        <option value="<?= (int) $sec['id'] ?>">
                                            <?= e($sec['name']) ?> (Year <?= e($sec['year_level']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Term / AY -->
                            <div class="col-md-6">
                                <label for="aySelect" class="form-label fw-bold small text-dark">Academic Year <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="aySelect" name="academic_year_id" required>
                                    <?php foreach ($academicYears as $ay): ?>
                                        <option value="<?= (int) $ay['id'] ?>" <?= !empty($ay['is_active']) ? 'selected' : '' ?>>
                                            <?= e($ay['label']) ?> <?= !empty($ay['is_active']) ? '(Active)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Semester -->
                            <div class="col-md-6">
                                <label for="semSelect" class="form-label fw-bold small text-dark">Semester / Term <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="semSelect" name="semester_id" required>
                                    <?php foreach ($semesters as $sem): ?>
                                        <option value="<?= (int) $sem['id'] ?>" <?= !empty($sem['is_active']) ? 'selected' : '' ?>>
                                            <?= e($sem['name']) ?> <?= !empty($sem['is_active']) ? '(Active)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Assigned Faculty -->
                            <div class="col-md-12">
                                <label for="facultySelect" class="form-label fw-bold small text-dark">Assigned Faculty Instructor <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="facultySelect" name="faculty_user_id" required>
                                    <option value="">Designate teaching instructor...</option>
                                    <?php foreach ($facultyList as $fac): ?>
                                        <option value="<?= (int) $fac['id'] ?>">
                                            <?= e($fac['full_name']) ?> (<?= e($fac['email']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted" style="font-size: 11px;">
                                    Faculty instructors own all student matrix scores and roll-call records for this class.
                                </small>
                            </div>

                            <!-- Grading Template -->
                            <div class="col-md-12">
                                <label for="templateSelect" class="form-label fw-bold small text-dark">Grading Scheme Template <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="templateSelect" name="template_id" required>
                                    <?php foreach ($templates as $tpl): ?>
                                        <option value="<?= (int) $tpl['id'] ?>" <?= !empty($tpl['is_default']) ? 'selected' : '' ?>>
                                            <?= e($tpl['name']) ?> (Passing Cutoff: ≤ <?= number_format((float) $tpl['passing_cutoff'], 2) ?>) <?= !empty($tpl['is_default']) ? '— Default' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted" style="font-size: 11px;">
                                    The selected template structure will be snapshotted onto this class offering.
                                </small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="<?= url('retention/admin/classes') ?>" class="btn btn-secondary btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-marsu btn-sm">
                                <i class="bi bi-check-circle me-1"></i>Create & Assign Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
