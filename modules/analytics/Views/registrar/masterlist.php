<?php
use Modules\Analytics\Support\Ui;

$showFilters = true;
$exportType = 'masterlist';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Masterlist', 'Officially enrolled students for the term. Filter by program, section or subject.', 'bi-list-ol',
        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/filters.php'; ?>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent small text-secondary"><?= count($rows) ?> enrolled student(s)</div>
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No enrolled students', 'Nobody matches these filters for the term.', 'bi-list-ol') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm align-middle mb-0 small">
                <thead class="table-light"><tr><th>#</th><th>Student No.</th><th>Name</th><th>Program</th><th>Year</th><th>Section</th><th class="text-center">Units</th></tr></thead>
                <tbody><?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i + 1 ?></td><td><?= e($r['student_number']) ?></td><td><a class="text-decoration-none" href="<?= url('analytics/registrar/enrollments/' . (int) $r['id']) ?>"><?= e(Ui::fullName($r)) ?></a></td>
                        <td><?= e($r['program_code']) ?></td><td><?= (int) $r['year_level'] ?></td><td><?= e($r['section_name'] ?? '—') ?></td><td class="text-center"><?= e((string) $r['units']) ?></td></tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
