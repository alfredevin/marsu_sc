<?php
use Modules\Analytics\Support\Ui;

$actions = '<a class="btn btn-sm btn-outline-secondary" href="' . e(url('analytics/registrar/export/grades', ['class_id' => (int) $class['id']])) . '"><i class="bi bi-download me-1"></i>Export CSV</a>'
    . '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($class['subject_code'] . ' · ' . $class['subject_title'], $class['section_name'] . ' · ' . trim(($class['semester_name'] ?? '') . ' ' . ($class['academic_year_label'] ?? '')) . ' · ' . ($class['faculty_name'] ?? ''), 'bi-journal-text', $actions) ?>
    <?= Ui::readonlyBanner('Read-only grade sheet. Grades are owned by the faculty and can only change through an approved correction request.') ?>
    <?= Ui::privacyNotice() ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No grades on this sheet', 'The class was posted without students.', 'bi-journal') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm align-middle mb-0 small">
                <thead class="table-light"><tr><th>#</th><th>Student No.</th><th>Name</th><th>Program</th><th class="text-center">Final grade</th><th>Remarks</th></tr></thead>
                <tbody><?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i + 1 ?></td><td><?= e($r['student_number']) ?></td><td><?= e(Ui::fullName($r)) ?></td><td><?= e($r['program_code']) ?></td>
                        <td class="text-center fw-bold"><?= e($r['final_grade']) ?></td><td><?= Ui::remarksBadge($r['remarks']) ?></td></tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
