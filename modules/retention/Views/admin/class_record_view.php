<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Admin Class Record Oversight - Read-Only (class_record_view.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Read-Only Banner Component -->
    <?php include __DIR__ . '/../partials/readonly_banner.php'; ?>

    <!-- Class Header & Meta -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="<?= url('retention/admin/classes') ?>" class="btn btn-sm btn-outline-secondary me-1">
                        <i class="bi bi-arrow-left me-1"></i> Back to Offerings
                    </a>
                    <div class="rounded p-2 text-white d-flex align-items-center justify-content-center" style="background-color: #800020; width: 38px; height: 38px;">
                        <i class="bi bi-eye-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">
                            <?= e($class['subject_code']) ?>: <?= e($class['subject_title']) ?>
                        </h6>
                        <small class="text-muted" style="font-size: 11.5px;">
                            Section: <strong class="text-dark"><?= e($class['section_name']) ?></strong> • 
                            Assigned Faculty: <strong class="text-dark"><?= e($class['faculty_name'] ?? 'Unassigned') ?></strong> • 
                            <?= e($class['semester_name'] ?? 'Current Term') ?>
                        </small>
                    </div>
                </div>

                <div>
                    <?php if ($class['grade_status'] === 'posted'): ?>
                        <span class="badge bg-success-subtle text-success border border-success px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i> Posted by Faculty
                        </span>
                    <?php elseif ($class['grade_status'] === 'locked'): ?>
                        <span class="badge bg-secondary-subtle text-secondary border border-secondary px-3 py-2">
                            <i class="bi bi-lock-fill me-1"></i> Term Closed & Locked
                        </span>
                    <?php else: ?>
                        <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-2">
                            <i class="bi bi-pencil-fill me-1"></i> Draft Scoring Matrix
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap small">
                    <span class="badge bg-light text-dark border px-2 py-1">
                        <i class="bi bi-diagram-3 me-1 text-primary"></i> Scheme: <strong><?= e($scheme['name'] ?? 'Class Scheme') ?></strong>
                    </span>
                    <span class="badge px-2 py-1" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171;">
                        Passing Threshold: ≤ <strong><?= number_format((float) ($class['passing_cutoff'] ?? 3.04), 2) ?></strong>
                    </span>
                    <span class="badge bg-light text-secondary border px-2 py-1">
                        Units: <strong><?= e($class['subject_units']) ?></strong>
                    </span>
                </div>
                <div class="text-muted small">
                    Enrolled Roster: <strong class="text-dark"><?= count($students) ?></strong> Students
                </div>
            </div>
        </div>
    </div>

    <!-- Read-Only Matrix Table -->
    <div class="table-responsive bg-white rounded border shadow-sm" style="max-height: 72vh;">
        <table class="table table-bordered table-hover align-middle mb-0 text-center" style="font-size: 11.5px;">
            <thead class="sticky-top">
                <tr>
                    <th rowspan="2" class="text-white align-middle" style="background-color: #58111a; width: 40px;">#</th>
                    <th rowspan="2" class="text-white text-start ps-3 align-middle" style="background-color: #58111a; min-width: 180px;">Student Name</th>
                    
                    <?php 
                    $groups = $scheme['groups'] ?? [];
                    foreach ($groups as $grp): 
                        $grpItems = $grp['items'] ?? [];
                        $colSpan = count($grpItems);
                    ?>
                        <th colspan="<?= max(1, $colSpan) ?>" class="text-white text-uppercase py-2 border-start border-end" style="background-color: #58111a;">
                            <?= e($grp['title'] ?? 'Group') ?> (<?= (float) ($grp['weight'] ?? 0) ?>%)
                        </th>
                    <?php endforeach; ?>

                    <th rowspan="2" class="text-white align-middle" style="background-color: #58111a; min-width: 90px;">FINAL GRADE</th>
                    <th rowspan="2" class="text-white align-middle" style="background-color: #58111a; min-width: 95px;">REMARKS</th>
                </tr>

                <tr>
                    <?php foreach ($groups as $grp): ?>
                        <?php foreach ($grp['items'] ?? [] as $it): ?>
                            <th class="text-white text-center py-1" style="background-color: #480c14; min-width: 60px;">
                                <div style="font-size: 10px; opacity: 0.85;"><?= (float) ($it['maxScore'] ?? 100) ?> pts</div>
                                <div class="fw-bold"><?= e($it['code']) ?></div>
                            </th>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="50" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <p class="mb-0 fw-semibold">No students enrolled in this class offering</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $idx => $std): 
                        $sid = (int) $std['student_id'];
                        $stdScores = $scoresMap[$sid] ?? [];
                        $posted = $postedMap[$sid] ?? null;
                    ?>
                        <tr>
                            <td class="text-muted fw-bold"><?= $idx + 1 ?></td>
                            <td class="text-start ps-3">
                                <div class="fw-bold text-dark"><?= e($std['last_name'] . ', ' . $std['first_name']) ?></div>
                                <small class="text-muted"><?= e($std['student_number']) ?> • <?= e($std['program_code'] ?? 'BSIS') ?></small>
                            </td>

                            <?php foreach ($groups as $grp): ?>
                                <?php foreach ($grp['items'] ?? [] as $it): 
                                    $val = $stdScores[$it['code']] ?? null;
                                ?>
                                    <td>
                                        <span class="fw-semibold <?= ($val !== null) ? 'text-primary' : 'text-muted' ?>">
                                            <?= ($val !== null) ? number_format((float) $val, 2) : '—' ?>
                                        </span>
                                    </td>
                                <?php endforeach; ?>
                            <?php endforeach; ?>

                            <td class="fw-bold fs-6 text-primary">
                                <?= $posted ? e($posted['final_grade']) : '—' ?>
                            </td>
                            <td>
                                <?php if ($posted): ?>
                                    <span class="badge <?= $posted['remarks'] === 'PASSED' ? 'bg-success' : ($posted['remarks'] === 'INC' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                        <?= e($posted['remarks']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border">Unposted</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
