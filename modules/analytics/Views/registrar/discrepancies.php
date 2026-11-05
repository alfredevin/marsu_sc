<?php
use Modules\Analytics\Support\Ui;

$exportType = 'discrepancies';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Roster Discrepancies', 'Compares official subject enrollment with faculty class rosters for the term.', 'bi-exclamation-diamond') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/filters.php'; ?>
    <div class="row g-3">
        <div class="col-xl-6"><div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold">Enrolled in a subject but on no class roster (<?= count($noRoster) ?>)</div>
            <?php if (empty($noRoster)): ?><?= Ui::emptyState('None', 'Every enrolled subject has a roster entry.', 'bi-check2-circle') ?><?php else: ?>
                <div class="table-responsive"><table class="table table-sm mb-0 small"><thead class="table-light"><tr><th>Student</th><th>Subject</th><th>Section</th></tr></thead>
                    <tbody><?php foreach ($noRoster as $r): ?><tr><td><?= e($r['last_name'] . ', ' . $r['first_name']) ?> <span class="text-secondary"><?= e($r['student_number']) ?></span></td><td><?= e($r['subject_code']) ?></td><td><?= e($r['section_name'] ?? '—') ?></td></tr><?php endforeach; ?></tbody></table></div>
            <?php endif; ?>
        </div></div>
        <div class="col-xl-6"><div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold">On a class roster but not officially enrolled (<?= count($notEnrolled) ?>)</div>
            <?php if (empty($notEnrolled)): ?><?= Ui::emptyState('None', 'Every rostered student is officially enrolled in that subject.', 'bi-check2-circle') ?><?php else: ?>
                <div class="table-responsive"><table class="table table-sm mb-0 small"><thead class="table-light"><tr><th>Student</th><th>Class</th><th>Faculty</th></tr></thead>
                    <tbody><?php foreach ($notEnrolled as $r): ?><tr><td><?= e($r['last_name'] . ', ' . $r['first_name']) ?> <span class="text-secondary"><?= e($r['student_number']) ?></span></td><td><?= e($r['subject_code'] . ' ' . $r['section_name']) ?></td><td><?= e($r['faculty_name'] ?? '') ?></td></tr><?php endforeach; ?></tbody></table></div>
            <?php endif; ?>
        </div></div>
    </div>
</div>
