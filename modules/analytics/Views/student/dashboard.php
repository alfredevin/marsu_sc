<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Hello, ' . $student['first_name'], $student['student_number'] . ' · ' . ($student['program_code'] ?? '') . ' · ' . ($term ? $term['label'] : 'No active term'), 'bi-mortarboard') ?>
    <?= Ui::privacyNotice() ?>

    <div class="row g-3 mb-3">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Enrollment this term</div>
                <div class="card-body small">
                    <?php if (!$term): ?>
                        <p class="text-secondary mb-0">No term is active.</p>
                    <?php elseif (!$enrollment): ?>
                        <p class="mb-0"><?= Ui::enrollmentBadge(null) ?> You are not enrolled for <?= e($term['label']) ?>. Please see the Registrar.</p>
                    <?php else: ?>
                        <p class="mb-2"><?= Ui::enrollmentBadge($enrollment['status']) ?> <?= e($enrollment['program_code']) ?> · Year <?= (int) $enrollment['year_level'] ?> · <?= e($enrollment['section_name'] ?? '') ?></p>
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($enrollment['subjects'] as $s): ?><li><?= e($s['code']) ?> <span class="text-secondary"><?= e($s['title']) ?></span><?= $s['status'] === 'dropped' ? ' <span class="badge bg-secondary">dropped</span>' : '' ?></li><?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold d-flex flex-wrap justify-content-between gap-2 align-items-center">
                    <span>My classes this term</span>
                    <?php include __DIR__ . '/partials_join.php'; ?>
                </div>
                <?php if (empty($classes)): ?>
                    <?= Ui::emptyState('No classes yet', 'Your instructors add you to their class, or you can join with a class code.', 'bi-collection') ?>
                <?php else: ?>
                    <div class="list-group list-group-flush small">
                        <?php foreach ($classes as $c): ?>
                            <a class="list-group-item list-group-item-action" href="<?= url('analytics/my/classes/' . (int) $c['id']) ?>">
                                <span class="fw-semibold"><?= e($c['subject_code']) ?></span> <?= e($c['subject_title']) ?>
                                <div class="text-secondary"><?= e($c['section_name']) ?> · <?= e($c['faculty_name'] ?? '') ?><?= $c['schedule'] ? ' · ' . e($c['schedule']) : '' ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Latest announcements</div>
                <?php if (empty($posts)): ?>
                    <div class="card-body small text-secondary">Nothing posted yet.</div>
                <?php else: ?>
                    <div class="list-group list-group-flush small">
                        <?php foreach ($posts as $p): ?>
                            <a class="list-group-item list-group-item-action" href="<?= url('analytics/my/classes/' . (int) $p['class_id']) ?>"><span class="badge bg-light text-dark border"><?= e($p['subject_code']) ?></span> <?= e($p['title']) ?>
                                <div class="text-secondary"><?= e(date('M j, g:i A', strtotime($p['created_at']))) ?></div></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Attendance health</div>
                <div class="card-body small">
                    <?php if ($ratio === null): ?><p class="text-secondary">Absence allowance: Not configured.</p><?php endif; ?>
                    <?php if (empty($attendance)): ?><p class="text-secondary mb-0">No classes this term.</p><?php endif; ?>
                    <?php foreach ($attendance as $a): $abs = (int) $a['att']['absent']; ?>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between"><span><?= e($a['class']['subject_code']) ?></span>
                                <span><?= $a['allowed'] === null ? $abs . ' absence(s)' : $abs . ' / ' . (int) $a['allowed'] . ' allowed' ?></span></div>
                            <?php if ($a['allowed'] !== null): $pct = $a['allowed'] > 0 ? min(100, $abs / $a['allowed'] * 100) : ($abs > 0 ? 100 : 0); ?>
                                <div class="progress" style="height:6px" role="progressbar" aria-valuenow="<?= (int) $pct ?>" aria-valuemin="0" aria-valuemax="100"><div class="progress-bar <?= $abs > $a['allowed'] ? 'bg-danger' : ($pct >= 75 ? 'bg-warning' : 'bg-success') ?>" style="width:<?= (int) $pct ?>%"></div></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Open INC deadlines</div>
                <?php if (empty($incs)): ?>
                    <div class="card-body small text-secondary">No incomplete grades.</div>
                <?php else: ?>
                    <ul class="list-group list-group-flush small">
                        <?php foreach ($incs as $i): ?>
                            <li class="list-group-item d-flex justify-content-between"><span><?= e($i['subject_code']) ?></span>
                                <span class="<?= $i['days_left'] !== null && (int) $i['days_left'] < 30 ? 'text-danger' : '' ?>"><?= $i['inc_deadline'] ? e($i['inc_deadline']) . ' (' . (int) $i['days_left'] . ' days)' : 'Deadline not configured' ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
