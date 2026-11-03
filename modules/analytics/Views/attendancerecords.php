<?php
use Modules\Analytics\Support\Ui;

$exportUrl = url('analytics/export/attendance', Ui::queryParams(['program', 'term']));
$canVoid = can('analytics.admin.attendance');
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Attendance Records', 'Roll-call entries recorded by faculty. Voided entries are excluded from every rate.', 'bi-person-check') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>

    <div class="row g-3 mb-3">
        <div class="col-xl-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Attendance by class</div>
                <?php if (empty($classRows)): ?>
                    <?= Ui::emptyState('No attendance recorded', 'Faculty have not taken roll-call for classes in this term.', 'bi-calendar-x') ?>
                <?php else: ?>
                    <div class="table-responsive"><table class="table table-sm table-hover align-middle mb-0 small">
                        <thead class="table-light"><tr><th>Class</th><th>Faculty</th><th class="text-center">Sessions</th><th class="text-center">P</th><th class="text-center">L</th><th class="text-center">E</th><th class="text-center">A</th><th>Rate</th></tr></thead>
                        <tbody><?php foreach ($classRows as $r): ?>
                            <tr>
                                <td><a href="<?= url('analytics/attendancerecords', array_merge($filters, ['class_id' => (int) $r['id']])) ?>" class="text-decoration-none fw-semibold"><?= e($r['subject_code']) ?></a> <span class="text-secondary"><?= e($r['section_name']) ?></span></td>
                                <td><?= e($r['faculty_name'] ?? '—') ?></td>
                                <td class="text-center"><?= (int) $r['sessions'] ?></td>
                                <td class="text-center"><?= (int) $r['present'] ?></td><td class="text-center"><?= (int) $r['late'] ?></td>
                                <td class="text-center"><?= (int) $r['excused'] ?></td><td class="text-center"><?= (int) $r['absent'] ?></td>
                                <td class="fw-semibold"><?= Ui::pct($r['rate']) ?></td>
                            </tr>
                        <?php endforeach; ?></tbody>
                    </table></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Over the absence allowance</div>
                <div class="card-body">
                    <?php if ($ratio === null): ?>
                        <p class="small text-secondary mb-0"><i class="bi bi-exclamation-circle me-1"></i>Maximum absence ratio is <strong>Not configured</strong> in Policy Settings, so no student is flagged.</p>
                    <?php elseif (empty($studentRows)): ?>
                        <?= Ui::emptyState('Nobody is over the allowance', 'Allowed absences = floor(sessions held × ' . ($ratio * 100) . '%).', 'bi-emoji-smile') ?>
                    <?php else: ?>
                        <p class="small text-secondary">Allowed absences = floor(sessions held × <?= e((string) ($ratio * 100)) ?>%).</p>
                        <ul class="list-group list-group-flush small">
                            <?php foreach ($studentRows as $r): ?>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span><a href="<?= url('analytics/students/' . (int) $r['student_id']) ?>" class="text-decoration-none"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></a> · <?= e($r['subject_code']) ?></span>
                                    <span class="text-danger fw-semibold"><?= (int) $r['absent'] ?> / <?= (int) $r['allowed'] ?> allowed</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent fw-semibold d-flex justify-content-between">
            <span>Entries<?= $classFilter ? ' for selected class' : '' ?></span>
            <?php if ($classFilter): ?><a class="small" href="<?= url('analytics/attendancerecords', array_diff_key($filters, ['class_id' => 1])) ?>">Show all classes</a><?php endif; ?>
        </div>
        <?php if (empty($recent)): ?>
            <?= Ui::emptyState('No entries', 'No roll-call entries match these filters.', 'bi-list') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm align-middle mb-0 small">
                <thead class="table-light"><tr><th>Date</th><th>Student</th><th>Class</th><th>Status</th><th>Remarks</th><th>Recorded by</th><?php if ($canVoid): ?><th>Void</th><?php endif; ?></tr></thead>
                <tbody><?php foreach ($recent as $r): ?>
                    <tr>
                        <td><?= e($r['session_date']) ?></td>
                        <td><?= e(($r['last_name'] ?? '?') . ', ' . ($r['first_name'] ?? '')) ?> <span class="text-secondary"><?= e($r['student_number'] ?? '') ?></span></td>
                        <td><?= e($r['subject_code']) ?> <span class="text-secondary"><?= e($r['section_name']) ?></span></td>
                        <td><?= Ui::attendanceBadge($r['status']) ?> <?= e($r['status']) ?></td>
                        <td><?= e($r['remarks'] ?? '') ?></td>
                        <td><?= e($r['recorded_by_name'] ?? '—') ?></td>
                        <?php if ($canVoid): ?>
                            <td>
                                <form method="POST" action="<?= url('analytics/admin/attendance/' . (int) $r['id'] . '/void') ?>" class="d-flex gap-1">
                                    <?= csrf_field() ?>
                                    <input type="text" name="reason" minlength="10" required class="form-control form-control-sm" style="width:150px" placeholder="Reason (min 10)">
                                    <button class="btn btn-sm btn-outline-danger" type="submit" title="Void entry"><i class="bi bi-x-circle"></i></button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
            <div class="card-footer bg-transparent"><?= render_pagination($pagination, 'analytics/attendancerecords', $filters) ?></div>
        <?php endif; ?>
    </div>
    <p class="small text-secondary mt-2 mb-0">Rate = (Present + Late × <?= $lateWeight === null ? '1 (late weight not configured)' : e((string) $lateWeight) ?> + Excused) ÷ recorded entries.</p>
</div>
