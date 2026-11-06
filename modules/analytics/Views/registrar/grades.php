<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Posted Grades', 'Grade sheets of posted and locked classes, read-only for records keeping.', 'bi-journal-text') ?>
    <?php include __DIR__ . '/filters.php'; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No posted grade sheets', 'Faculty have not posted grades for this term.', 'bi-journal') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-hover align-middle mb-0 small">
                <thead class="table-light"><tr><th>Subject</th><th>Section</th><th>Faculty</th><th class="text-center">Grades</th><th>Status</th><th>Posted</th><th></th></tr></thead>
                <tbody><?php foreach ($rows as $r): ?>
                    <tr><td><span class="fw-semibold"><?= e($r['subject_code']) ?></span> <?= e($r['subject_title']) ?></td><td><?= e($r['section_name']) ?></td><td><?= e($r['faculty_name'] ?? '') ?></td>
                        <td class="text-center"><?= (int) $r['graded'] ?></td><td><?= Ui::gradeStatusBadge($r['grade_status']) ?></td><td><?= e($r['posted_at'] ? date('M j, Y', strtotime($r['posted_at'])) : '') ?></td>
                        <td class="text-end text-nowrap"><a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/registrar/grades/' . (int) $r['id']) ?>">Open</a>
                            <a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/registrar/export/grades', ['class_id' => (int) $r['id']]) ?>" title="Export CSV"><i class="bi bi-download"></i></a></td></tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
