<?php
use Modules\Analytics\Support\Ui;

$actions = '';
if ($term) {
    $actions = '<a href="' . e(url('analytics/my/grades/print', ['term' => (int) $term['semester_id']])) . '" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer me-1"></i>Print grade slip</a>';
}
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Grades', 'Only grades your instructors have posted are shown.', 'bi-journal-check', $actions) ?>
    <?= Ui::privacyNotice() ?>
    <?php if ($terms): ?>
        <form method="GET" class="mb-3" style="max-width:320px">
            <label class="form-label small text-secondary mb-1">Term</label>
            <?= Ui::termSelect($terms, $term['semester_id'] ?? null) ?>
        </form>
    <?php endif; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No classes for this term', 'Grades appear here after you are added to a class and your instructor posts grades.', 'bi-journal') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table align-middle mb-0 small">
                <thead class="table-light"><tr><th>Subject</th><th>Instructor</th><th class="text-center">Units</th><th class="text-center">Final grade</th><th>Remarks</th></tr></thead>
                <tbody><?php foreach ($rows as $r): $c = $r['class']; ?>
                    <tr>
                        <td><span class="fw-semibold"><?= e($c['subject_code']) ?></span> <?= e($c['subject_title']) ?></td>
                        <td><?= e($c['faculty_name'] ?? '') ?></td>
                        <td class="text-center"><?= e((string) $r['units']) ?></td>
                        <?php if ($r['published']): ?>
                            <td class="text-center fw-bold"><?= e($r['grade']['final_grade']) ?></td>
                            <td><?= Ui::remarksBadge($r['grade']['remarks']) ?><?php if ($r['grade']['remarks'] === 'INC' && !$r['grade']['inc_resolved_at']): ?> <span class="text-secondary">due <?= e($r['grade']['inc_deadline'] ?? 'not configured') ?></span><?php endif; ?></td>
                        <?php else: ?>
                            <td class="text-center"><span class="badge bg-light text-dark border">In progress</span></td><td class="text-secondary">Not yet posted</td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?></tbody>
                <tfoot><tr><th colspan="3" class="text-end">Term GWA</th><th class="text-center"><?= $gwa === null ? '—' : number_format($gwa, 2) ?></th><th class="small text-secondary fw-normal">Σ(grade × units) ÷ Σ units, numeric grades only</th></tr></tfoot>
            </table></div>
        <?php endif; ?>
    </div>
</div>
