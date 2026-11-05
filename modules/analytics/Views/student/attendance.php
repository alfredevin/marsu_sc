<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Attendance', 'Roll-call recorded by your instructors.', 'bi-calendar-check') ?>
    <?= Ui::privacyNotice() ?>
    <?php if ($terms): ?>
        <form method="GET" class="mb-3" style="max-width:320px"><label class="form-label small text-secondary mb-1">Term</label><?= Ui::termSelect($terms, $term['semester_id'] ?? null) ?></form>
    <?php endif; ?>
    <?php if ($ratio === null): ?>
        <div class="alert alert-light border small py-2">Absence allowance is <strong>Not configured</strong> by the administrator.</div>
    <?php else: ?>
        <div class="alert alert-light border small py-2">Allowed absences = <?= e((string) ($ratio * 100)) ?>% of sessions held so far (CHED rule).</div>
    <?php endif; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($summary)): ?>
            <?= Ui::emptyState('No classes for this term', 'Attendance appears once you are on a class roster.', 'bi-calendar') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table align-middle mb-0 small">
                <thead class="table-light"><tr><th>Subject</th><th class="text-center">Sessions</th><th class="text-center">P</th><th class="text-center">L</th><th class="text-center">E</th><th class="text-center">A</th><th>Rate</th><th>Allowance</th></tr></thead>
                <tbody><?php foreach ($summary as $s): $abs = (int) $s['att']['absent']; ?>
                    <tr>
                        <td><a href="<?= url('analytics/my/classes/' . (int) $s['class']['id']) ?>" class="fw-semibold text-decoration-none"><?= e($s['class']['subject_code']) ?></a></td>
                        <td class="text-center"><?= (int) $s['sessions'] ?></td>
                        <td class="text-center"><?= (int) $s['att']['present'] ?></td><td class="text-center"><?= (int) $s['att']['late'] ?></td>
                        <td class="text-center"><?= (int) $s['att']['excused'] ?></td><td class="text-center"><?= $abs ?></td>
                        <td class="fw-semibold"><?= Ui::pct($s['rate']) ?></td>
                        <td><?php if ($s['allowed'] === null): ?>Not configured<?php else: ?><span class="<?= $abs > $s['allowed'] ? 'text-danger fw-semibold' : '' ?>"><?= $abs ?> of <?= (int) $s['allowed'] ?> allowed</span><?php endif; ?></td>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
