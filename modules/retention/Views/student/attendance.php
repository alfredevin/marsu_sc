<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Student Attendance Telemetry & Roll-Call Ledger (attendance.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Statutory RA 10173 Privacy Notice -->
    <?php include __DIR__ . '/../partials/privacy_notice.php'; ?>

    <?php if (!empty($student)): ?>
        <?php $activeTab = 'attendance'; include __DIR__ . '/../partials/student_nav.php'; ?>
    <?php endif; ?>

    <?php if (empty($student)): ?>
        <div class="card border-0 shadow-sm p-5 text-center">
            <i class="bi bi-person-x fs-1 text-muted mb-2"></i>
            <h5 class="fw-bold text-dark">No Student Record Linked</h5>
            <p class="text-secondary small mb-0">Your university user account is not currently linked to an active student registration record.</p>
        </div>
    <?php else: ?>

        <!-- CHED 20% Attendance Rule Policy Card -->
        <div class="card border-0 shadow-sm mb-4 bg-light">
            <div class="card-body p-3 d-flex align-items-start gap-3">
                <i class="bi bi-shield-exclamation text-primary fs-3 flex-shrink-0"></i>
                <div class="small text-secondary" style="font-size: 11.5px; line-height: 1.45;">
                    <strong class="text-dark">CHED Attendance Retention Policy (20% Maximum Allowable Cuts):</strong>
                    Pursuant to Commission on Higher Education guidelines and university academic policy, students who accumulate unexcused absences exceeding twenty percent (20%) of the total prescribed contact hours for a course risk being dropped (DRP) or receiving a failing mark (5.00). Keep track of your absences and coordinate with your faculty member for excused absences.
                </div>
            </div>
        </div>

        <!-- Subject Attendance Telemetry Cards -->
        <h6 class="fw-bold text-dark mb-3">Course Attendance Telemetry</h6>

        <?php if (empty($courseStats)): ?>
            <div class="card border-0 shadow-sm p-4 text-center text-muted mb-4">
                <i class="bi bi-calendar-x fs-1 text-secondary mb-2"></i>
                <h6 class="fw-bold text-dark mb-1">No Attendance Sessions Logged</h6>
                <p class="text-secondary small mb-0">No roll-call records have been entered by your instructors for this term yet.</p>
            </div>
        <?php else: ?>
            <div class="row g-3 mb-4">
                <?php foreach ($courseStats as $cs): ?>
                    <?php
                    $rate = (float) ($cs['rate'] ?? 100.0);
                    $barCol = ($rate < 80.0) ? 'bg-danger' : (($rate < 85.0) ? 'bg-warning' : 'bg-success');
                    $borderCol = ($rate < 80.0) ? '#dc3545' : (($rate < 85.0) ? '#ffc107' : '#198754');
                    ?>
                    <div class="col-md-6 col-xl-4">
                        <div class="card border-0 shadow-sm h-100 p-3 bg-white" style="border-left: 4px solid <?= $borderCol ?> !important;">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <span class="badge bg-light text-dark border fw-bold"><?= e($cs['code']) ?></span>
                                    <h6 class="fw-bold text-dark mb-0 mt-1"><?= e($cs['title']) ?></h6>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold fs-5 <?= $rate < 80.0 ? 'text-danger' : 'text-dark' ?>">
                                        <?= number_format($rate, 1) ?>%
                                    </span>
                                </div>
                            </div>

                            <div class="progress mb-2" style="height: 6px;">
                                <div class="progress-bar <?= $barCol ?>" role="progressbar" style="width: <?= min(100, $rate) ?>%;" aria-valuenow="<?= $rate ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="d-flex justify-content-between text-muted small mt-2" style="font-size: 11px;">
                                <span><strong class="text-success"><?= $cs['present'] ?></strong> Present</span>
                                <span><strong class="text-danger"><?= $cs['absent'] ?></strong> Absent</span>
                                <span><strong class="text-warning text-dark"><?= $cs['late'] ?></strong> Late</span>
                                <span><strong class="text-info"><?= $cs['excused'] ?></strong> Excused</span>
                            </div>

                            <?php if ($rate < 80.0): ?>
                                <div class="mt-2 pt-2 border-top">
                                    <span class="badge bg-danger text-white w-100 py-1" style="font-size: 10px;">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Excessive Cuts Alert (&gt; 20%)
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Detailed Attendance Log Ledger -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold text-dark mb-0">Roll-Call Session Ledger</h6>
                    <small class="text-muted" style="font-size: 11.5px;">Chronological record of class session check-ins</small>
                </div>
                <span class="badge bg-light text-secondary border"><?= count($sessions ?? []) ?> Recorded Session(s)</span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($sessions)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-calendar4-week fs-1 d-block mb-2 text-secondary"></i>
                        <h6 class="fw-bold text-dark mb-1">No Roll-Call Sessions Found</h6>
                        <p class="text-secondary small mb-0">Your class session logs will appear here as roll calls are marked.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th class="ps-3" style="width: 130px;">Date</th>
                                    <th style="width: 140px;">Course Code</th>
                                    <th>Course Title</th>
                                    <th>Section</th>
                                    <th class="text-center" style="width: 130px;">Status</th>
                                    <th class="pe-3" style="width: 200px;">Session Notes</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($sessions as $s): ?>
                                    <?php
                                    $st = $s['status'];
                                    $badge = 'bg-secondary text-white';
                                    if ($st === 'Present') $badge = 'bg-success text-white';
                                    elseif ($st === 'Absent') $badge = 'bg-danger text-white';
                                    elseif ($st === 'Late') $badge = 'bg-warning text-dark';
                                    elseif ($st === 'Excused') $badge = 'bg-info text-dark';

                                    $isVoided = !empty($s['is_voided']);
                                    ?>
                                    <tr class="<?= $isVoided ? 'table-light text-muted' : '' ?>">
                                        <td class="ps-3 fw-semibold <?= $isVoided ? 'text-decoration-line-through' : 'text-dark' ?>">
                                            <?= date('M d, Y', strtotime($s['session_date'])) ?>
                                        </td>
                                        <td class="fw-bold <?= $isVoided ? 'text-decoration-line-through' : 'text-dark' ?>">
                                            <?= e($s['display_subject_code']) ?>
                                        </td>
                                        <td><?= e($s['display_subject_title']) ?></td>
                                        <td>
                                            <span class="badge bg-light text-secondary border"><?= e($s['section_name'] ?? '-') ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($isVoided): ?>
                                                <span class="badge bg-secondary text-white" title="Voided by Academic Administration">
                                                    <i class="bi bi-slash-circle me-1"></i> Voided
                                                </span>
                                            <?php else: ?>
                                                <span class="badge <?= $badge ?> px-2 py-1"><?= e($st) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="pe-3 text-secondary">
                                            <?php if ($isVoided && !empty($s['voided_reason'])): ?>
                                                <small class="text-muted fst-italic">Voided: <?= e($s['voided_reason']) ?></small>
                                            <?php elseif (!empty($s['remarks'])): ?>
                                                <small><?= e($s['remarks']) ?></small>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-size: 11px;">-</span>
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
