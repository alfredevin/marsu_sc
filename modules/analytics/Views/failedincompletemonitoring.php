<?php
use Modules\Analytics\Support\Ui;

$typeSel = (string) ($_GET['type'] ?? '');
ob_start(); ?>
<div class="col-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Type</label>
    <select name="type" class="form-select form-select-sm">
        <option value="">Failed and INC</option>
        <option value="FAILED" <?= $typeSel === 'FAILED' ? 'selected' : '' ?>>Failed only</option>
        <option value="INC" <?= $typeSel === 'INC' ? 'selected' : '' ?>>INC only</option>
    </select>
</div>
<div class="col-6 col-lg-2 form-check ms-2 mb-1">
    <input class="form-check-input" type="checkbox" name="open" value="1" id="openOnly" <?= ($_GET['open'] ?? '') === '1' ? 'checked' : '' ?>>
    <label class="form-check-label small" for="openOnly">Unresolved only</label>
</div>
<?php $filterExtra = ob_get_clean();
$exportUrl = url('analytics/export/failed-inc', $filters);
$canExtend = can('analytics.admin.grades');
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Failed / INC Monitoring', 'Posted FAILED and INC grades. INC deadlines come from the posting date plus the configured removal window.', 'bi-exclamation-triangle') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>
    <?php if ($incWindowDays === null): ?>
        <div class="alert alert-warning small py-2"><i class="bi bi-exclamation-circle me-1"></i>INC removal window: <strong>Not configured</strong>. New INC grades are posted without a deadline until it is set in Policy Settings.</div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No failed or incomplete grades', 'Nothing matches these filters among posted grades.', 'bi-check2-circle') ?>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 small">
                    <thead class="table-light"><tr><th>Student</th><th>Subject</th><th>Faculty</th><th>Grade</th><th>INC deadline</th><?php if ($canExtend): ?><th>Extend</th><?php endif; ?></tr></thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><a href="<?= url('analytics/students/' . (int) $r['student_id']) ?>" class="fw-semibold text-decoration-none"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></a><div class="text-secondary"><?= e($r['student_number']) ?> · <?= e($r['program_code']) ?></div></td>
                                <td><?= e($r['subject_code']) ?><div class="text-secondary"><?= e($r['section_name']) ?></div></td>
                                <td><?= e($r['faculty_name'] ?? '—') ?></td>
                                <td><?= e($r['final_grade']) ?> <?= Ui::remarksBadge($r['remarks']) ?></td>
                                <td>
                                    <?php if ($r['remarks'] !== 'INC'): ?>—
                                    <?php elseif ($r['inc_resolved_at']): ?><span class="text-success">Resolved <?= e(date('M j, Y', strtotime($r['inc_resolved_at']))) ?></span>
                                    <?php elseif (!$r['inc_deadline']): ?><span class="text-secondary">Not configured</span>
                                    <?php else: $days = (int) $r['days_left']; ?>
                                        <?= e($r['inc_deadline']) ?>
                                        <div class="<?= $days < 0 ? 'text-danger' : ($days <= 30 ? 'text-warning-emphasis' : 'text-secondary') ?>"><?= $days < 0 ? abs($days) . ' day(s) overdue' : $days . ' day(s) left' ?></div>
                                    <?php endif; ?>
                                </td>
                                <?php if ($canExtend): ?>
                                    <td>
                                        <?php if ($r['remarks'] === 'INC' && !$r['inc_resolved_at']): ?>
                                            <form method="POST" action="<?= url('analytics/admin/grades/' . (int) $r['grade_id'] . '/extend-inc') ?>" class="d-flex flex-wrap gap-1">
                                                <?= csrf_field() ?>
                                                <input type="date" name="new_deadline" class="form-control form-control-sm" style="width:140px" required min="<?= e(date('Y-m-d', strtotime('+1 day'))) ?>">
                                                <input type="text" name="reason" class="form-control form-control-sm" style="width:160px" minlength="10" placeholder="Reason (min 10 chars)" required>
                                                <button class="btn btn-sm btn-outline-secondary" type="submit">Extend</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
