<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Incomplete (INC) & Academic Deficiencies Monitoring (deficiencies.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'deficiencies'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record.</p>
        </div>
    <?php else: ?>

        <?php if (empty($deficiencies)): ?>
            <!-- Clean / Good Academic Standing Celebration State -->
            <div class="card border-0 shadow-sm p-5 text-center bg-white mb-4">
                <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width: 80px; height: 80px; font-size: 38px;">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <h4 class="fw-bold text-success mb-2">Good Academic Standing</h4>
                <h6 class="fw-semibold text-dark mb-2">No Active Deficiencies or Incomplete Marks Found</h6>
                <p class="text-secondary small mb-0" style="max-width: 580px; margin: 0 auto; line-height: 1.5;">
                    Congratulations! You have zero Incomplete (INC), Failed (5.00), or Dropped marks recorded on your official evaluated transcript. All evaluated courses have met graduation credit requirements.
                </p>
                <div class="mt-4">
                    <a href="<?= url('retention/my/grades') ?>" class="btn btn-sm btn-outline-success px-3">
                        <i class="bi bi-card-checklist me-1"></i> View Full Grade Report
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Supportive Advisory Notice -->
            <div class="alert alert-warning border border-warning shadow-sm d-flex align-items-start gap-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-4 text-warning flex-shrink-0"></i>
                <div class="small">
                    <strong class="text-dark">Academic Resolution Advisory:</strong>
                    You have active course deficiency records that require attention. Under MarSU Academic Regulations, an <strong>Incomplete (INC)</strong> mark must be satisfied within <strong>one (1) calendar year</strong> from the end of the term it was incurred. Failure to satisfy the requirement within the prescribed window causes the INC mark to automatically lapse into a failing grade of 5.00.
                </div>
            </div>

            <!-- Active Deficiencies List -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Active Course Deficiencies</h6>
                        <small class="text-muted" style="font-size: 11.5px;">Pending requirements requiring formal resolution</small>
                    </div>
                    <span class="badge bg-danger text-white"><?= count($deficiencies) ?> Subject(s) Requiring Action</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th class="ps-3" style="width: 140px;">Course Code</th>
                                    <th>Course Title &amp; Term</th>
                                    <th>Units</th>
                                    <th>Instructor</th>
                                    <th class="text-center" style="width: 110px;">Status</th>
                                    <th style="width: 180px;">Removal Deadline</th>
                                    <th class="text-end pe-3" style="width: 140px;">Guidance</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($deficiencies as $d): ?>
                                    <?php
                                    $rem = strtoupper($d['remarks'] ?? '');
                                    $badgeCls = ($rem === 'INC') ? 'bg-warning text-dark' : (($rem === 'FAILED') ? 'bg-danger text-white' : 'bg-secondary text-white');
                                    ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($d['subject_code']) ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($d['subject_title']) ?></div>
                                            <small class="text-muted"><?= e($d['semester_name'] ?? 'Term') ?> • <?= e($d['academic_year_label'] ?? 'AY') ?></small>
                                        </td>
                                        <td><?= number_format((float) ($d['units'] ?? 3.0), 1) ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($d['instructor_name'] ?? 'Faculty Member') ?></div>
                                            <?php if (!empty($d['instructor_email'])): ?>
                                                <a href="mailto:<?= e($d['instructor_email']) ?>" class="text-primary text-decoration-none small">
                                                    <i class="bi bi-envelope me-1"></i> <?= e($d['instructor_email']) ?>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $badgeCls ?> px-2 py-1"><?= e($rem) ?></span>
                                        </td>
                                        <td>
                                            <?php if ($rem === 'INC' && !empty($d['inc_deadline'])): ?>
                                                <?php
                                                $deadlineTs = strtotime($d['inc_deadline']);
                                                $daysLeft = ceil(($deadlineTs - time()) / 86400);
                                                $isUrgent = ($daysLeft <= 30 && $daysLeft >= 0);
                                                $isExpired = ($daysLeft < 0);
                                                ?>
                                                <div class="fw-semibold <?= $isExpired ? 'text-danger' : ($isUrgent ? 'text-warning text-dark' : 'text-dark') ?>">
                                                    <?= date('F d, Y', $deadlineTs) ?>
                                                </div>
                                                <small class="<?= $isExpired ? 'text-danger fw-bold' : ($isUrgent ? 'text-warning text-dark fw-bold' : 'text-muted') ?>">
                                                    <?php if ($isExpired): ?>
                                                        <i class="bi bi-x-circle me-1"></i> Expired (Lapsed)
                                                    <?php elseif ($daysLeft == 0): ?>
                                                        <i class="bi bi-clock-history me-1"></i> Due Today!
                                                    <?php else: ?>
                                                        <i class="bi bi-clock me-1"></i> <?= $daysLeft ?> day(s) remaining
                                                    <?php endif; ?>
                                                </small>
                                            <?php elseif ($rem === 'FAILED'): ?>
                                                <span class="text-muted" style="font-size: 11px;">Re-enrollment Required</span>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-size: 11px;">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <?php if ($rem === 'INC'): ?>
                                                <button type="button" class="btn btn-xs btn-outline-primary py-1 px-2" style="font-size: 11px;"
                                                        data-bs-toggle="modal" data-bs-target="#modalRemovalGuide">
                                                    <i class="bi bi-journal-check me-1"></i> Removal Steps
                                                </button>
                                            <?php else: ?>
                                                <span class="text-muted small">Consult Adviser</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- INC Removal Steps Guide Modal -->
            <div class="modal fade" id="modalRemovalGuide" tabindex="-1" aria-labelledby="modalRemovalGuideLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header border-bottom py-3" style="background-color: #800020; color: #fff;">
                            <h6 class="modal-title fw-bold" id="modalRemovalGuideLabel">
                                <i class="bi bi-file-earmark-medical me-2"></i>Incomplete (INC) Removal Procedure
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 small">
                            <p class="text-secondary mb-3">
                                Follow these standardized university steps to satisfy an Incomplete grade:
                            </p>
                            <ol class="ps-3 mb-3 text-secondary" style="line-height: 1.6;">
                                <li class="mb-2"><strong>Secure Form:</strong> Obtain an official <em>Completion / Removal of Incomplete Grade Form</em> from your College Registrar or Student Services counter.</li>
                                <li class="mb-2"><strong>Coordinate with Faculty:</strong> Contact your course instructor to determine the specific lacking academic requirement (e.g. final project, missed exam, laboratory reports).</li>
                                <li class="mb-2"><strong>Submit Requirement:</strong> Submit the completed work or take the designated special removal examination before your official deadline.</li>
                                <li class="mb-2"><strong>Faculty Encoding:</strong> Your instructor encodes the resolved completion mark directly into their ERP Faculty Workspace and signs the official form.</li>
                                <li><strong>Dean Approval:</strong> The College Dean endorses the resolution to the University Registrar for permanent transcript update.</li>
                            </ol>
                            <div class="alert alert-light border small text-muted mb-0">
                                <i class="bi bi-exclamation-circle text-primary me-1"></i> If you require an official extension due to illness or institutional delay, coordinate immediately with your College Dean.
                            </div>
                        </div>
                        <div class="modal-footer border-top py-2">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close Guide</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Advising & Student Guidance Callout Card -->
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-chat-heart text-danger fs-3"></i>
                    <div>
                        <h6 class="fw-bold text-dark small mb-0">MarSU Academic Guidance &amp; Retention Counseling</h6>
                        <small class="text-secondary" style="font-size: 11px;">Our guidance counselors and academic advisers are available to help you plan your schedule and overcome academic challenges.</small>
                    </div>
                </div>
                <div>
                    <a href="mailto:guidance@marsu.edu.ph" class="btn btn-sm btn-outline-dark fw-semibold" style="font-size: 11.5px;">
                        <i class="bi bi-envelope me-1"></i> Contact Academic Guidance
                    </a>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>
