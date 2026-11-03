<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Academic Progress Reports', 'Per-student summary of posted grades for the selected term.', 'bi-card-checklist') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No posted grades for this term', 'Progress reports are built from grades that faculty have posted.', 'bi-card-checklist') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-hover align-middle mb-0 small">
                <thead class="table-light"><tr><th>Student</th><th>Program</th><th class="text-center">Subjects</th><th class="text-center">Units</th><th class="text-center">Passed</th><th class="text-center">Failed</th><th class="text-center">Open INC</th><th class="text-center">DRP</th><th class="text-center">Term GWA</th><th></th></tr></thead>
                <tbody><?php foreach ($rows as $r): ?>
                    <tr>
                        <td><span class="fw-semibold"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></span><div class="text-secondary"><?= e($r['student_number']) ?></div></td>
                        <td><?= e($r['program_code']) ?> <?= (int) $r['year_level'] ?></td>
                        <td class="text-center"><?= (int) $r['subjects'] ?></td>
                        <td class="text-center"><?= e((string) $r['units']) ?></td>
                        <td class="text-center text-success"><?= (int) $r['passed'] ?></td>
                        <td class="text-center <?= (int) $r['failed'] > 0 ? 'text-danger fw-semibold' : '' ?>"><?= (int) $r['failed'] ?></td>
                        <td class="text-center"><?= (int) $r['open_inc'] ?></td>
                        <td class="text-center"><?= (int) $r['drp'] ?></td>
                        <td class="text-center fw-semibold"><?= $r['gwa'] === null ? '—' : number_format((float) $r['gwa'], 2) ?></td>
                        <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/students/' . (int) $r['student_id']) ?>">Dossier</a></td>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
    <p class="small text-secondary mt-2 mb-0">Term GWA = Σ(grade × units) ÷ Σ(units) over numeric grades only (INC and DRP excluded).</p>
</div>
