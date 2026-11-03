<?php
use Modules\Analytics\Support\Ui;

$exportUrl = url('analytics/export/participation', Ui::queryParams(['program', 'term']));
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Participation Tracking', 'Submission status of class tasks as encoded by faculty (submitted, late, missing, excused).', 'bi-check2-square') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No task submissions recorded', 'Participation appears once faculty encode task scores or submission statuses.', 'bi-clipboard') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm table-hover align-middle mb-0 small">
                <thead class="table-light"><tr><th>Student</th><th>Class</th><th class="text-center">Submitted</th><th class="text-center">Late</th><th class="text-center">Missing</th><th class="text-center">Excused</th><th>Compliance</th></tr></thead>
                <tbody><?php foreach ($rows as $r): ?>
                    <tr>
                        <td><a class="text-decoration-none fw-semibold" href="<?= url('analytics/students/' . (int) $r['student_id']) ?>"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></a> <span class="text-secondary"><?= e($r['student_number']) ?></span></td>
                        <td><?= e($r['subject_code']) ?> <span class="text-secondary"><?= e($r['section_name']) ?></span></td>
                        <td class="text-center"><?= (int) $r['submitted'] ?></td>
                        <td class="text-center"><?= (int) $r['late'] ?></td>
                        <td class="text-center <?= (int) $r['missing'] > 0 ? 'text-danger fw-semibold' : '' ?>"><?= (int) $r['missing'] ?></td>
                        <td class="text-center"><?= (int) $r['excused'] ?></td>
                        <td class="fw-semibold"><?= Ui::pct($r['compliance']) ?></td>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
    <p class="small text-secondary mt-2 mb-0">Compliance = (submitted + late) ÷ (recorded tasks − excused).</p>
</div>
