<?php
use Modules\Analytics\Support\Ui;

$showFilters = true;
$showStatus = true;
$exportType = 'enrollments';
$actions = can('analytics.registrar.enrollment') ? '<a href="' . e(url('analytics/registrar/enrollments/create')) . '" class="btn btn-sm btn-marsu"><i class="bi bi-person-plus me-1"></i>Enroll students</a>' : '';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Term Enrollments', 'Official enrollment records. Faculty rosters are built from enrolled students only.', 'bi-card-list', $actions) ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/filters.php'; ?>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent small text-secondary"><?= number_format($pagination['total']) ?> record(s)</div>
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No enrollments match', 'Change the filters or enroll students for this term.', 'bi-card-list') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-hover align-middle mb-0 small">
                <thead class="table-light"><tr><th>Student</th><th>Program</th><th>Year</th><th>Section</th><th class="text-center">Subjects</th><th class="text-center">Units</th><th>Status</th><th></th></tr></thead>
                <tbody><?php foreach ($rows as $r): ?>
                    <tr>
                        <td><span class="fw-semibold"><?= e(Ui::fullName($r)) ?></span><div class="text-secondary"><?= e($r['student_number']) ?><?= $r['user_id'] ? '' : ' · no login' ?></div></td>
                        <td><?= e($r['program_code']) ?></td><td><?= (int) $r['year_level'] ?></td><td><?= e($r['section_name'] ?? '—') ?></td>
                        <td class="text-center"><?= (int) $r['subject_count'] ?></td><td class="text-center"><?= e((string) $r['units']) ?></td>
                        <td><?= Ui::enrollmentBadge($r['status']) ?></td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/registrar/enrollments/' . (int) $r['id']) ?>">Open</a>
                            <a class="btn btn-sm btn-outline-secondary" target="_blank" href="<?= url('analytics/registrar/cor/' . (int) $r['id']) ?>" title="Certificate of Registration"><i class="bi bi-printer"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
            <div class="card-footer bg-transparent"><?= render_pagination($pagination, 'analytics/registrar/enrollments', $filters) ?></div>
        <?php endif; ?>
    </div>
</div>
