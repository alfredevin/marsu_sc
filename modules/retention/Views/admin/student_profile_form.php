<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Supplementary Retention Student Profile Form (student_profile_form.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Header & Action Row -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div class="d-flex align-items-center gap-2">
            <a href="<?= url('retention/profile?student_id=' . (int) $student['id']) ?>" class="btn btn-sm btn-outline-secondary me-1">
                <i class="bi bi-arrow-left me-1"></i> Student Profile
            </a>
            <div class="rounded p-2 text-white d-flex align-items-center justify-content-center" style="background-color: #800020; width: 42px; height: 42px;">
                <i class="bi bi-person-lines-fill fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 text-dark">Supplementary Retention Profile</h5>
                <small class="text-muted" style="font-size: 12px;">Manage contextual non-academic retention risk indicators (Part E8)</small>
            </div>
        </div>

        <div>
            <a href="<?= url('retention/admin/preview-student/' . (int) $student['id']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-eye me-1"></i> Preview as Student
            </a>
        </div>
    </div>

    <!-- Statutory Privacy Notice -->
    <div class="alert alert-light border border-secondary-subtle shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-shield-check text-success fs-5 flex-shrink-0"></i>
            <div class="small">
                <strong>Data Privacy Act of 2012 (RA 10173) Compliance Notice:</strong>
                Supplementary demographic indicators are collected exclusively for institutional retention research, academic guidance interventions, and risk modeling. Information entered here is restricted to authorized university administrators and guidance counselors.
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Student Master Data Card (Read-Only) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="fw-bold text-dark mb-0">Student Master Record</h6>
                </div>
                <div class="card-body">
                    <div class="text-center pb-3 border-bottom mb-3">
                        <div class="rounded-circle bg-light text-secondary d-inline-flex align-items-center justify-content-center border mb-2" style="width: 64px; height: 64px;">
                            <i class="bi bi-person-badge fs-2 text-dark"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0"><?= e($student['first_name'] . ' ' . $student['last_name']) ?></h6>
                        <small class="badge bg-secondary-subtle text-secondary border px-2 py-1 mt-1"><?= e($student['student_number']) ?></small>
                    </div>

                    <div class="small">
                        <div class="mb-2">
                            <span class="text-muted d-block" style="font-size: 11px;">ACADEMIC PROGRAM</span>
                            <span class="fw-semibold text-dark"><?= e($student['program_code'] ?? 'N/A') ?> - <?= e($student['program_name'] ?? 'Unassigned Program') ?></span>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted d-block" style="font-size: 11px;">SECTION & LEVEL</span>
                            <span class="fw-semibold text-dark"><?= e($student['section_name'] ?? 'Unassigned') ?></span>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted d-block" style="font-size: 11px;">CAMPUS EMAIL</span>
                            <span class="fw-semibold text-dark"><?= e($student['email'] ?? 'No email on file') ?></span>
                        </div>
                        <div>
                            <span class="text-muted d-block" style="font-size: 11px;">ENROLLMENT STATUS</span>
                            <span class="badge bg-success-subtle text-success border border-success"><?= e(ucfirst($student['status'] ?? 'Enrolled')) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Retention Form Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="fw-bold text-dark mb-0">Retention Risk & Demographic Indicators</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= url('retention/admin/profiles/' . (int) $student['id']) ?>">
                        <?= csrf_field() ?>

                        <div class="row g-3 mb-4">
                            <!-- Living Arrangement -->
                            <div class="col-md-6">
                                <label for="living_arrangement" class="form-label small fw-bold text-dark">
                                    Living Arrangement <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" id="living_arrangement" name="living_arrangement" required>
                                    <?php 
                                    $la = $profile['living_arrangement'] ?? 'with_family';
                                    ?>
                                    <option value="with_family" <?= $la === 'with_family' ? 'selected' : '' ?>>With Family / Immediate Household</option>
                                    <option value="boarding" <?= $la === 'boarding' ? 'selected' : '' ?>>Off-Campus Boarding House</option>
                                    <option value="dormitory" <?= $la === 'dormitory' ? 'selected' : '' ?>>On-Campus Student Dormitory</option>
                                    <option value="relatives" <?= $la === 'relatives' ? 'selected' : '' ?>>Living with Relatives / Guardians</option>
                                    <option value="other" <?= $la === 'other' ? 'selected' : '' ?>>Other Living Accommodation</option>
                                </select>
                                <small class="text-muted" style="font-size: 11px;">Primary residence while attending university classes.</small>
                            </div>

                            <!-- Commute Category -->
                            <div class="col-md-6">
                                <label for="commute_category" class="form-label small fw-bold text-dark">
                                    Commute Distance Category <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" id="commute_category" name="commute_category" required>
                                    <?php 
                                    $cc = $profile['commute_category'] ?? 'local';
                                    ?>
                                    <option value="local" <?= $cc === 'local' ? 'selected' : '' ?>>Local (Walking distance or &lt; 15 mins)</option>
                                    <option value="moderate" <?= $cc === 'moderate' ? 'selected' : '' ?>>Moderate Commute (15 - 45 mins)</option>
                                    <option value="distant" <?= $cc === 'distant' ? 'selected' : '' ?>>Distant Commute (&gt; 45 mins / Inter-Municipality)</option>
                                </select>
                                <small class="text-muted" style="font-size: 11px;">Transit duration between accommodation and campus.</small>
                            </div>
                        </div>

                        <!-- Socio-Demographic Checkboxes -->
                        <div class="card bg-light border-0 p-3 mb-4">
                            <h6 class="fw-bold text-dark small mb-3">Contextual Risk Factors</h6>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_working_student" name="is_working_student" value="1" <?= !empty($profile['is_working_student']) ? 'checked' : '' ?>>
                                <label class="form-check-label small fw-semibold text-dark" for="is_working_student">
                                    Working Student / Self-Supporting
                                </label>
                                <div class="text-muted" style="font-size: 11.5px;">Engaged in formal or informal employment outside academic hours.</div>
                            </div>

                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_scholar" name="is_scholar" value="1" <?= !empty($profile['is_scholar']) ? 'checked' : '' ?> onchange="toggleScholarInput()">
                                <label class="form-check-label small fw-semibold text-dark" for="is_scholar">
                                    Scholarship / Academic Grant Recipient
                                </label>
                                <div class="text-muted" style="font-size: 11.5px;">Receiving university, government, or private scholarship aid.</div>
                            </div>

                            <div class="ms-4 mb-3" id="scholarship_name_wrapper" style="<?= !empty($profile['is_scholar']) ? '' : 'display: none;' ?>">
                                <label for="scholarship_name" class="form-label small fw-bold text-dark">Scholarship / Grant Provider Name</label>
                                <input type="text" class="form-control form-control-sm" id="scholarship_name" name="scholarship_name" value="<?= e($profile['scholarship_name'] ?? '') ?>" placeholder="e.g. CHED Tulong Dunong, DOST-SEI, LGU Marinduque">
                            </div>

                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="is_first_generation" name="is_first_generation" value="1" <?= !empty($profile['is_first_generation']) ? 'checked' : '' ?>>
                                <label class="form-check-label small fw-semibold text-dark" for="is_first_generation">
                                    First-Generation College Student
                                </label>
                                <div class="text-muted" style="font-size: 11.5px;">First member in immediate family to pursue tertiary higher education.</div>
                            </div>
                        </div>

                        <!-- Retention Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label small fw-bold text-dark">
                                Administrative Retention & Guidance Notes
                            </label>
                            <textarea class="form-control form-control-sm" id="notes" name="notes" rows="4" placeholder="Record internal advisor observations, academic coaching notes, or retention support history..."><?= e($profile['notes'] ?? '') ?></textarea>
                            <small class="text-muted" style="font-size: 11px;">Internal administrative record. Confidential under university retention policy.</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="<?= url('retention/profile?student_id=' . (int) $student['id']) ?>" class="btn btn-sm btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary px-4" style="background-color: #800020; border-color: #800020;">
                                <i class="bi bi-save me-1"></i> Save Supplementary Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function toggleScholarInput() {
    const isScholar = document.getElementById('is_scholar').checked;
    const wrapper = document.getElementById('scholarship_name_wrapper');
    wrapper.style.display = isScholar ? 'block' : 'none';
}
</script>
