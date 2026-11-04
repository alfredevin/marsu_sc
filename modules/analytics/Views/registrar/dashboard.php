<?php
use Modules\Analytics\Support\Ui;

$actions = can('analytics.registrar.enrollment') ? '<a href="' . e(url('analytics/registrar/import')) . '" class="btn btn-sm btn-marsu"><i class="bi bi-file-earmark-arrow-up me-1"></i>Import records</a>' : '';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Enrollment Records', ($term ? $term['label'] : 'No active term') . ' · imported from the official enrollment system', 'bi-person-badge', $actions) ?>
    <?php include __DIR__ . '/filters.php'; ?>
    <div class="row g-3 mb-3">
        <?php foreach ($counts as $status => $n): ?>
            <div class="col-6 col-lg-3"><a class="card border-0 shadow-sm text-decoration-none" href="<?= url('analytics/registrar/enrollments', ['term' => (int) ($term['semester_id'] ?? 0), 'status' => $status]) ?>"><div class="card-body py-3">
                <div class="small text-secondary"><?= Ui::enrollmentBadge($status) ?></div><div class="fs-4 fw-bold text-body"><?= (int) $n ?></div>
            </div></a></div>
        <?php endforeach; ?>
    </div>
    <div class="row g-3">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">By program</div>
                <?php if (empty($byProgram)): ?><?= Ui::emptyState('No enrollments yet', 'Enroll students for this term to see totals.', 'bi-person-plus') ?><?php else: ?>
                    <table class="table table-sm mb-0 small"><thead class="table-light"><tr><th>Program</th><th class="text-center">Enrolled</th><th class="text-center">Pending</th><th class="text-center">Withdrawn / cancelled</th></tr></thead>
                        <tbody><?php foreach ($byProgram as $r): ?><tr><td><?= e($r['code']) ?></td><td class="text-center"><?= (int) $r['enrolled'] ?></td><td class="text-center"><?= (int) $r['pending'] ?></td><td class="text-center"><?= (int) $r['withdrawn'] ?></td></tr><?php endforeach; ?></tbody></table>
                <?php endif; ?>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">Enrolled students without a login account</div>
                <?php if (empty($noAccount)): ?><div class="card-body small text-secondary">Every enrolled student has a linked account.</div><?php else: ?>
                    <div class="card-body small text-secondary pb-0">Accounts are created in core User Accounts; these students cannot use the student portal yet.</div>
                    <ul class="list-group list-group-flush small"><?php foreach ($noAccount as $s): ?><li class="list-group-item"><?= e($s['last_name'] . ', ' . $s['first_name']) ?> <span class="text-secondary"><?= e($s['student_number']) ?> · <?= e($s['program_code']) ?></span></li><?php endforeach; ?></ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">By section</div>
                <?php if (empty($bySection)): ?><?= Ui::emptyState('No enrollments yet', 'Section totals appear after enrollment.', 'bi-diagram-3') ?><?php else: ?>
                    <table class="table table-sm mb-0 small"><thead class="table-light"><tr><th>Section</th><th>Program</th><th class="text-center">Enrolled</th><th class="text-center">Pending</th></tr></thead>
                        <tbody><?php foreach ($bySection as $r): ?><tr><td><?= e($r['section_name']) ?></td><td><?= e($r['program_code']) ?></td><td class="text-center"><?= (int) $r['enrolled'] ?></td><td class="text-center"><?= (int) $r['pending'] ?></td></tr><?php endforeach; ?></tbody></table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
