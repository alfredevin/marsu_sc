<?php
use Modules\Analytics\Support\Ui;

$exportUrl = url('analytics/export/engagement', Ui::queryParams(['program', 'term']));
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Student Engagement', 'Combines attendance rate and task submission compliance per student and class.', 'bi-activity') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>
    <div class="alert alert-light border small py-2">
        <strong>Formula:</strong> Engagement = average of the available components among
        attendance rate ((P + L × late weight + E) ÷ entries) and submission compliance ((submitted + late) ÷ (recorded − excused)).
        A component with no data is left out rather than assumed.
    </div>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No engagement data yet', 'Engagement needs roll-call attendance or task submissions for classes in this term.', 'bi-activity') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm table-hover align-middle mb-0 small">
                <thead class="table-light"><tr><th>Student</th><th>Class</th><th>Attendance</th><th>Compliance</th><th>Engagement</th></tr></thead>
                <tbody><?php foreach ($rows as $r): $eng = $r['engagement']; ?>
                    <tr>
                        <td><a class="text-decoration-none fw-semibold" href="<?= url('analytics/students/' . (int) $r['student_id']) ?>"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></a> <span class="text-secondary"><?= e($r['student_number']) ?></span></td>
                        <td><?= e($r['subject_code']) ?> <span class="text-secondary"><?= e($r['section_name']) ?></span></td>
                        <td><?= Ui::pct($r['attendance']) ?></td>
                        <td><?= Ui::pct($r['compliance']) ?></td>
                        <td class="fw-semibold <?= $eng !== null && $eng < 0.75 ? 'text-danger' : '' ?>"><?= Ui::pct($eng) ?></td>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
