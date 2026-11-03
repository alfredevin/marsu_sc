<?php
use Modules\Analytics\Support\Ui;

ob_start();
include __DIR__ . '/partials_join.php';
$join = ob_get_clean();
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Classes', 'Classes you are on the roster of. Join a class with the code your instructor shared.', 'bi-collection', $join) ?>
    <?php if ($requests): ?>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-transparent fw-semibold small">My join requests</div>
            <ul class="list-group list-group-flush small">
                <?php foreach ($requests as $r): ?>
                    <li class="list-group-item d-flex justify-content-between"><span><?= e($r['subject_code'] . ' — ' . $r['section_name']) ?></span><span class="badge <?= $r['status'] === 'pending' ? 'bg-warning text-dark' : 'bg-danger' ?>"><?= e($r['status']) ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (empty($classes)): ?>
        <div class="card border-0 shadow-sm"><?= Ui::emptyState('No classes yet', 'Your instructors add you once you are officially enrolled, or join with a class code.', 'bi-collection') ?></div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($classes as $c): ?>
                <div class="col-md-6 col-xl-4">
                    <a href="<?= url('analytics/my/classes/' . (int) $c['id']) ?>" class="card border-0 shadow-sm h-100 text-decoration-none">
                        <div class="card-body small">
                            <span class="badge text-white" style="background:#800020"><?= e($c['subject_code']) ?></span>
                            <div class="fw-semibold mt-1 text-body"><?= e($c['subject_title']) ?></div>
                            <div class="text-secondary"><?= e($c['section_name']) ?> · <?= e($c['faculty_name'] ?? '') ?></div>
                            <div class="text-secondary"><?= e(trim(($c['semester_name'] ?? '') . ' ' . ($c['academic_year_label'] ?? ''))) ?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
