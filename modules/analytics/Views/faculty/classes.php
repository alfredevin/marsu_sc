<?php
use Modules\Analytics\Support\Ui;

$actions = '<a href="' . e(url('analytics/faculty/classes/create')) . '" class="btn btn-sm btn-marsu"><i class="bi bi-plus-lg me-1"></i>Create class</a>';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Classes', 'Classes you created or were assigned. Only you can edit their records.', 'bi-collection', $actions) ?>
    <?php if (empty($classes)): ?>
        <div class="card border-0 shadow-sm"><?= Ui::emptyState('No classes yet', 'Create a class for a subject and section in the active term.', 'bi-collection', url('analytics/faculty/classes/create'), 'Create class') ?></div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($classes as $c): ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column small">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="badge bg-marsu text-white" style="background:#800020"><?= e($c['subject_code']) ?></span>
                                <?= Ui::gradeStatusBadge($c['grade_status']) ?>
                            </div>
                            <div class="fw-semibold mb-1"><?= e($c['subject_title']) ?></div>
                            <div class="text-secondary"><?= e($c['section_name']) ?> · <?= e(trim(($c['semester_name'] ?? '') . ' ' . ($c['academic_year_label'] ?? ''))) ?></div>
                            <div class="text-secondary">Code <code><?= e($c['class_code']) ?></code> · <?= (int) $c['student_count'] ?> student(s)</div>
                            <?php if ((int) $c['pending_joins'] > 0): ?><div class="mt-1"><span class="badge bg-danger"><?= (int) $c['pending_joins'] ?> join request(s)</span></div><?php endif; ?>
                            <div class="mt-auto pt-2 d-flex gap-2">
                                <a class="btn btn-sm btn-marsu" href="<?= url('analytics/faculty/classes/' . (int) $c['id']) ?>">Open</a>
                                <a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/faculty/attendance', ['class_id' => (int) $c['id']]) ?>"><i class="bi bi-calendar-check"></i> Roll-call</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
