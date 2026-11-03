<?php
use Modules\Analytics\Support\Ui;

$draft = count(array_filter($termClasses, fn($c) => $c['grade_status'] === 'draft'));
$actions = '<a href="' . e(url('analytics/faculty/classes/create')) . '" class="btn btn-sm btn-marsu"><i class="bi bi-plus-lg me-1"></i>Create class</a>';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Faculty Workspace', $term ? 'Active term: ' . $term['label'] : 'No active term is set in the Academic Calendar.', 'bi-person-workspace', $actions) ?>

    <div class="row g-3 mb-3">
        <?php foreach ([
            ['Classes this term', count($termClasses), 'bi-collection'],
            ['Not yet posted', $draft, 'bi-pencil-square'],
            ['Pending join requests', count($joinRequests), 'bi-person-plus'],
            ['Open INC', count($openIncs), 'bi-hourglass-split'],
        ] as [$label, $value, $icon]): ?>
            <div class="col-6 col-lg-3"><div class="card border-0 shadow-sm"><div class="card-body py-3">
                <div class="small text-secondary"><i class="bi <?= e($icon) ?> me-1"></i><?= e($label) ?></div>
                <div class="fs-4 fw-bold"><?= (int) $value ?></div>
            </div></div></div>
        <?php endforeach; ?>
    </div>

    <div class="row g-3">
        <div class="col-xl-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">My classes this term</div>
                <?php if (empty($termClasses)): ?>
                    <?= Ui::emptyState('No classes this term', 'Create a class, then add the students the Registrar enrolled in that subject.', 'bi-collection', url('analytics/faculty/classes/create'), 'Create class') ?>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($termClasses as $c): ?>
                            <a href="<?= url('analytics/faculty/classes/' . (int) $c['id']) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center small">
                                <div><span class="fw-semibold"><?= e($c['subject_code']) ?></span> <?= e($c['subject_title']) ?><div class="text-secondary"><?= e($c['section_name']) ?> · <?= (int) $c['student_count'] ?> student(s) · code <?= e($c['class_code']) ?></div></div>
                                <div class="text-end"><?= Ui::gradeStatusBadge($c['grade_status']) ?><?php if ((int) $c['pending_joins'] > 0): ?><div><span class="badge bg-danger"><?= (int) $c['pending_joins'] ?> join request(s)</span></div><?php endif; ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">Pending join requests</div>
                <?php if (empty($joinRequests)): ?>
                    <div class="card-body small text-secondary">No pending requests.</div>
                <?php else: ?>
                    <ul class="list-group list-group-flush small">
                        <?php foreach ($joinRequests as $j): ?>
                            <li class="list-group-item d-flex justify-content-between"><span><?= e($j['last_name'] . ', ' . $j['first_name']) ?> → <?= e($j['subject_code']) ?></span>
                                <a href="<?= url('analytics/faculty/classes/' . (int) $j['class_id'], ['tab' => 'roster']) ?>">Review</a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">Open INC</div>
                <?php if (empty($openIncs)): ?>
                    <div class="card-body small text-secondary">No unresolved INC grades.</div>
                <?php else: ?>
                    <ul class="list-group list-group-flush small">
                        <?php foreach ($openIncs as $i): ?>
                            <li class="list-group-item d-flex justify-content-between"><span><?= e($i['last_name'] . ', ' . $i['first_name']) ?> · <?= e($i['subject_code']) ?></span>
                                <span class="<?= $i['days_left'] !== null && (int) $i['days_left'] < 0 ? 'text-danger' : 'text-secondary' ?>"><?= $i['inc_deadline'] ? e($i['inc_deadline']) : 'No deadline' ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">Correction requests</div>
                <?php if (empty($corrections)): ?>
                    <div class="card-body small text-secondary">None filed.</div>
                <?php else: ?>
                    <ul class="list-group list-group-flush small">
                        <?php foreach ($corrections as $c): ?>
                            <li class="list-group-item d-flex justify-content-between"><span><?= e($c['subject_code']) ?> <?= e($c['section_name']) ?></span><span class="badge bg-light text-dark border"><?= e($c['status']) ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
