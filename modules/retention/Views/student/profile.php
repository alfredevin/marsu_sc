<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Student Profile & Master Record Dossier (profile.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'profile'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record.</p>
        </div>
    <?php else: ?>

        <div class="row g-4">
            <!-- Left Column: Official Student Identity Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="avatar-wrapper mx-auto mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm mx-auto"
                             style="width: 88px; height: 88px; font-size: 32px; background: linear-gradient(135deg, #800020 0%, #4a0013 100%);">
                            <?= strtoupper(substr($student['first_name'] ?? 'S', 0, 1) . substr($student['last_name'] ?? 'M', 0, 1)) ?>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-1"><?= e($student['first_name'] . ' ' . $student['last_name']) ?></h5>
                    <div class="text-muted small mb-2"><?= e($student['student_number']) ?></div>
                    <div>
                        <span class="badge bg-success-subtle text-success border border-success px-2 py-1 small">
                            <i class="bi bi-check-circle-fill me-1"></i> <?= e(ucfirst($student['status'] ?? 'Enrolled')) ?>
                        </span>
                    </div>

                    <hr class="my-3 text-secondary-subtle">

                    <div class="text-start small">
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Degree Program:</span>
                            <span class="fw-semibold text-dark text-end"><?= e($student['program_code'] ?? 'N/A') ?></span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Assigned Section:</span>
                            <span class="fw-semibold text-dark"><?= e($student['section_name'] ?? 'Section') ?></span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Current Year Level:</span>
                            <span class="fw-semibold text-dark"><?= e($student['year_level'] ?? '1') ?> Year</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Campus Email:</span>
                            <span class="fw-semibold text-dark text-truncate ms-2" style="max-width: 170px;" title="<?= e($student['email'] ?? '') ?>">
                                <?= e($student['email'] ?? 'Not set') ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Registrar Assistance Card -->
                <div class="card border-0 shadow-sm mt-3 bg-light">
                    <div class="card-body p-3">
                        <h6 class="fw-bold text-dark small mb-1">
                            <i class="bi bi-info-circle text-primary me-1"></i> Need to Update Information?
                        </h6>
                        <p class="text-secondary small mb-0" style="font-size: 11.5px; line-height: 1.45;">
                            Official demographic records and registration details are maintained by the University Registrar. If your program, section, or contact information contains errors, submit a request through the Registrar's Office.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Official Master Information & Supplementary Retention Profile -->
            <div class="col-lg-8">
                <!-- Official University Registration Master Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-building me-2 text-marsu-burgundy" style="color: #800020;"></i>Official University Master Record
                        </h6>
                        <span class="badge bg-light text-secondary border">Registrar Verified</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Full Name</label>
                                <div class="fw-semibold text-dark"><?= e($student['first_name'] . ' ' . ($student['middle_name'] ? $student['middle_name'] . ' ' : '') . $student['last_name']) ?></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Student Identification Number</label>
                                <div class="fw-semibold text-dark"><?= e($student['student_number']) ?></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Degree Program / Curriculum</label>
                                <div class="fw-semibold text-dark"><?= e($student['program_name'] ?? 'Not Specified') ?> (<?= e($student['program_code'] ?? 'N/A') ?>)</div>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Section / Block</label>
                                <div class="fw-semibold text-dark"><?= e($student['section_name'] ?? 'Unassigned') ?></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Academic Standing</label>
                                <div>
                                    <span class="badge bg-success-subtle text-success border border-success px-2 py-1 fw-semibold">
                                        <?= e(strtoupper($student['status'] ?? 'ACTIVE')) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Date Registered</label>
                                <div class="text-secondary small">
                                    <?= !empty($student['created_at']) ? date('F d, Y', strtotime($student['created_at'])) : 'Archived record' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplementary Retention Demographic Profile -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-bold text-dark mb-0">
                                <i class="bi bi-person-vcard me-2" style="color: #800020;"></i>Supplementary Socio-Academic Profile
                            </h6>
                            <small class="text-muted" style="font-size: 11.5px;">Advising attributes utilized by the Academic Retention & Support Office</small>
                        </div>
                        <?php if (!empty($profile)): ?>
                            <span class="badge bg-light text-secondary border">Recorded</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-4">
                        <?php if (empty($profile)): ?>
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-clipboard2-x fs-1 d-block mb-2 text-secondary"></i>
                                <h6 class="fw-bold text-dark mb-1">No Supplementary Profile on File</h6>
                                <p class="text-secondary small mb-0" style="max-width: 500px; margin: 0 auto;">
                                    Supplementary socio-academic attributes (such as living arrangements, scholarship grants, and commute profiles) have not yet been logged by your academic adviser.
                                </p>
                            </div>
                        <?php else: ?>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Living Arrangement</label>
                                    <div class="fw-semibold text-dark">
                                        <?= !empty($profile['living_arrangement']) ? e(ucwords(str_replace('_', ' ', $profile['living_arrangement']))) : '<span class="text-muted fst-italic">Not specified</span>' ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Commute Category</label>
                                    <div class="fw-semibold text-dark">
                                        <?= !empty($profile['commute_category']) ? e(ucwords(str_replace('_', ' ', $profile['commute_category']))) : '<span class="text-muted fst-italic">Not specified</span>' ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Working Student</label>
                                    <div>
                                        <?php if (!empty($profile['working_student'])): ?>
                                            <span class="badge bg-info-subtle text-info-emphasis border border-info px-2 py-1">
                                                <i class="bi bi-briefcase-fill me-1"></i> Yes, Working
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border px-2 py-1">No</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">Scholarship Grantee</label>
                                    <div>
                                        <?php if (!empty($profile['scholarship_grantee'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                                <i class="bi bi-award-fill me-1"></i> Active Grantee
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border px-2 py-1">Non-Grantee</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="text-muted small text-uppercase fw-semibold" style="font-size: 11px;">First-Generation Student</label>
                                    <div>
                                        <?php if (!empty($profile['first_generation'])): ?>
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning px-2 py-1">
                                                <i class="bi bi-star-fill me-1"></i> First Generation
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border px-2 py-1">No</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if (!empty($profile['updated_at'])): ?>
                                    <div class="col-12 mt-3 pt-3 border-top">
                                        <small class="text-muted">
                                            <i class="bi bi-clock-history me-1"></i> Profile last reviewed by Retention Office on: <?= date('F d, Y h:i A', strtotime($profile['updated_at'])) ?>
                                        </small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>
