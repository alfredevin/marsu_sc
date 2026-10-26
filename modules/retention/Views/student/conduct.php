<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Student Conduct & Disciplinary Record Notices (conduct.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'conduct'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record.</p>
        </div>
    <?php else: ?>

        <?php if (empty($notices)): ?>
            <!-- Clean Conduct Record Celebration Card -->
            <div class="card border-0 shadow-sm p-5 text-center bg-white mb-4">
                <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width: 80px; height: 80px; font-size: 38px;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4 class="fw-bold text-success mb-2">Clean Disciplinary Standing</h4>
                <h6 class="fw-semibold text-dark mb-2">No Conduct or Disciplinary Notices on File</h6>
                <p class="text-secondary small mb-0" style="max-width: 580px; margin: 0 auto; line-height: 1.5;">
                    You have zero recorded disciplinary infractions or behavioral notices on file with the university. Your conduct record satisfies all institutional standards for good moral character.
                </p>
            </div>
        <?php else: ?>
            <!-- Official Notices Ledger Table (Rule F6 / Part H Q6: date, type, severity, status only) -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Official Conduct Notices</h6>
                        <small class="text-muted" style="font-size: 11.5px;">Notices registered with University Student Affairs &amp; Disciplinary Board</small>
                    </div>
                    <span class="badge bg-warning text-dark border"><?= count($notices) ?> Active Notice(s)</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th class="ps-3" style="width: 140px;">Notice Date</th>
                                    <th>Incident Classification</th>
                                    <th class="text-center" style="width: 130px;">Severity Level</th>
                                    <th class="text-center" style="width: 140px;">Review Status</th>
                                    <th class="text-end pe-3" style="width: 150px;">Advising Action</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($notices as $n): ?>
                                    <?php
                                    $sev = ucfirst($n['severity'] ?? 'Minor');
                                    $sevBadge = 'bg-secondary text-white';
                                    if ($sev === 'Minor') $sevBadge = 'bg-info-subtle text-info-emphasis border border-info';
                                    elseif ($sev === 'Moderate') $sevBadge = 'bg-warning-subtle text-warning-emphasis border border-warning';
                                    elseif ($sev === 'Major') $sevBadge = 'bg-danger text-white';

                                    $st = ucfirst($n['status'] ?? 'Reported');
                                    $stBadge = 'bg-secondary text-white';
                                    if ($st === 'Reported') $stBadge = 'bg-secondary-subtle text-secondary border';
                                    elseif ($st === 'Under Review' || $st === 'Under_review') $stBadge = 'bg-primary-subtle text-primary border border-primary';
                                    elseif ($st === 'Resolved') $stBadge = 'bg-success-subtle text-success border border-success';
                                    elseif ($st === 'Dismissed') $stBadge = 'bg-light text-muted border';
                                    ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold text-dark">
                                            <?= date('M d, Y', strtotime($n['incident_date'])) ?>
                                        </td>
                                        <td class="fw-bold text-dark">
                                            <?= e($n['incident_type'] ?? 'General Infraction') ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $sevBadge ?> px-2 py-1"><?= e($sev) ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $stBadge ?> px-2 py-1"><?= e(str_replace('_', ' ', $st)) ?></span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <span class="text-muted small">
                                                <i class="bi bi-person-lines-fill me-1"></i> Student Affairs
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Confidentiality & Due Process Advisory Card -->
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-3">
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-shield-lock-fill text-primary fs-3 flex-shrink-0"></i>
                    <div class="small text-secondary" style="font-size: 11.5px; line-height: 1.45;">
                        <strong class="text-dark">Student Rights &amp; Due Process Policy:</strong>
                        In accordance with the MarSU Student Handbook and Republic Act No. 10173 (Data Privacy Act), detailed disciplinary investigative narratives and hearing deliberations are treated as confidential administrative records. Students facing disciplinary review are entitled to formal notice, counsel, and due process through the Office of Student Affairs and Services (OSAS). To inquire about an open notice or schedule an advisory conference, please visit the OSAS Disciplinary Board.
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>
