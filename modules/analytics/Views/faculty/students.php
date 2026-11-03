<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Students', 'Only students on your class rosters.', 'bi-people') ?>
    <?= Ui::privacyNotice() ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($students)): ?>
            <?= Ui::emptyState('No students yet', 'Students appear here once they are on one of your class rosters.', 'bi-people') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-hover align-middle mb-0 small">
                <thead class="table-light"><tr><th>Student No.</th><th>Name</th><th>Program</th><th>Year</th><th>My classes</th><th></th></tr></thead>
                <tbody><?php foreach ($students as $s): ?>
                    <tr><td class="fw-semibold"><?= e($s['student_number']) ?></td><td><?= e(Ui::fullName($s)) ?></td><td><?= e($s['program_code']) ?></td><td><?= (int) $s['year_level'] ?></td>
                        <td><?= e($s['classes']) ?></td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/faculty/students/' . (int) $s['id']) ?>">View</a></td></tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
