<?php
use Modules\Analytics\Support\Ui;

$exportUrl = url('analytics/export/subject-performance', Ui::queryParams(['program', 'term']));
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Subject Performance', 'Posted and locked class grades only, grouped by subject.', 'bi-bar-chart-line') ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>

    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No posted grades for this term', 'Subject results appear once faculty post their class grades.', 'bi-bar-chart') ?>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 small">
                    <thead class="table-light">
                        <tr><th>Subject</th><th class="text-center">Classes</th><th class="text-center">Graded</th><th class="text-center">Passed</th><th class="text-center">Failed</th><th class="text-center">INC</th><th class="text-center">DRP</th><th>Pass rate</th><th class="text-center">Mean grade</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r):
                            $low = $threshold !== null && $r['pass_rate'] !== null && ($r['pass_rate'] * 100) < (float) $threshold;
                        ?>
                            <tr>
                                <td><span class="fw-semibold"><?= e($r['subject_code']) ?></span><div class="text-secondary"><?= e($r['subject_title']) ?></div></td>
                                <td class="text-center"><?= (int) $r['classes'] ?></td>
                                <td class="text-center"><?= (int) $r['graded'] ?></td>
                                <td class="text-center text-success"><?= (int) $r['passed'] ?></td>
                                <td class="text-center text-danger"><?= (int) $r['failed'] ?></td>
                                <td class="text-center"><?= (int) $r['inc'] ?></td>
                                <td class="text-center"><?= (int) $r['drp'] ?></td>
                                <td style="min-width:140px">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height:6px" role="progressbar" aria-valuenow="<?= $r['pass_rate'] === null ? 0 : round($r['pass_rate'] * 100) ?>" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar <?= $low ? 'bg-danger' : 'bg-success' ?>" style="width: <?= $r['pass_rate'] === null ? 0 : round($r['pass_rate'] * 100, 1) ?>%"></div>
                                        </div>
                                        <span class="fw-semibold"><?= Ui::pct($r['pass_rate']) ?></span>
                                    </div>
                                    <?php if ($low): ?><span class="badge bg-danger-subtle text-danger-emphasis">Below <?= e((string) $threshold) ?>% threshold</span><?php endif; ?>
                                </td>
                                <td class="text-center"><?= $r['mean_grade'] === null ? '—' : number_format($r['mean_grade'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <p class="small text-secondary mt-2 mb-0">Pass rate = PASSED ÷ graded. Mean grade averages numeric final grades only (INC and DRP excluded). Bottleneck threshold: <?= $threshold === null ? 'Not configured' : e((string) $threshold) . '%' ?>.</p>
</div>
