<?php
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\Ui;

$rate = GradeCalculator::attendanceRate($attendance);
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($class['subject_code'] . ' · ' . $class['subject_title'], $class['section_name'] . ' · ' . ($class['faculty_name'] ?? '') . ($class['schedule'] ? ' · ' . $class['schedule'] : '') . ($class['room'] ? ' · ' . $class['room'] : ''), 'bi-journal-text',
        '<a href="' . e(url('analytics/my/classes')) . '" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>My Classes</a>') ?>
    <?= Ui::privacyNotice() ?>
    <div class="row g-3">
        <div class="col-lg-8">
            <?php if ($class['description']): ?><div class="card border-0 shadow-sm mb-3"><div class="card-body small" style="white-space:pre-wrap"><?= e($class['description']) ?></div></div><?php endif; ?>
            <?php if (empty($posts)): ?>
                <div class="card border-0 shadow-sm"><?= Ui::emptyState('No announcements yet', 'Your instructor has not posted anything in this class.', 'bi-megaphone') ?></div>
            <?php endif; ?>
            <?php foreach ($posts as $p): ?>
                <div class="card border-0 shadow-sm mb-2"><div class="card-body small">
                    <?php if ($p['is_pinned']): ?><i class="bi bi-pin-angle-fill me-1" title="Pinned"></i><?php endif; ?>
                    <span class="badge <?= $p['type'] === 'material' ? 'bg-info text-dark' : 'bg-secondary' ?>"><?= e(ucfirst($p['type'])) ?></span>
                    <span class="fw-semibold"><?= e($p['title']) ?></span>
                    <div class="text-secondary"><?= e($p['author'] ?? '') ?> · <?= e(date('M j, Y g:i A', strtotime($p['created_at']))) ?></div>
                    <?php if ($p['body']): ?><div class="mt-2" style="white-space:pre-wrap"><?= e($p['body']) ?></div><?php endif; ?>
                    <?php if ($p['attachment_path']): ?><a class="d-inline-block mt-2" href="<?= url('analytics/classes/' . (int) $class['id'] . '/posts/' . (int) $p['id'] . '/file') ?>"><i class="bi bi-paperclip me-1"></i><?= e($p['attachment_name']) ?></a><?php endif; ?>
                </div></div>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">My grade</div>
                <div class="card-body">
                    <?php if ($posted): ?>
                        <div class="fs-3 fw-bold"><?= e($posted['final_grade']) ?></div>
                        <?= Ui::remarksBadge($posted['remarks']) ?>
                        <?php if ($posted['remarks'] === 'INC' && !$posted['inc_resolved_at']): ?><div class="small mt-1">Complete by <?= e($posted['inc_deadline'] ?? 'deadline not configured') ?></div><?php endif; ?>
                    <?php else: ?>
                        <span class="badge bg-light text-dark border">In progress</span>
                        <div class="small text-secondary mt-1">Your final grade appears once your instructor posts it.</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">My attendance</div>
                <div class="card-body small">
                    <div class="fs-5 fw-bold"><?= Ui::pct($rate) ?></div>
                    P <?= (int) $attendance['present'] ?> · L <?= (int) $attendance['late'] ?> · E <?= (int) $attendance['excused'] ?> · A <?= (int) $attendance['absent'] ?> of <?= count($dates) ?> session(s)
                </div>
            </div>
            <?php if ($showScores): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent fw-semibold">My task scores</div>
                    <ul class="list-group list-group-flush small">
                        <?php foreach ($scheme['groups'] as $g): foreach ($g['items'] as $it): $code = $it['code']; ?>
                            <li class="list-group-item d-flex justify-content-between"><span><?= e($it['title']) ?> <span class="text-secondary"><?= e($code) ?></span></span>
                                <span><?= isset($scores[$code]) ? e((string) $scores[$code]) : '—' ?> / <?= e((string) $it['maxScore']) ?><?= !empty($statuses[$code]) && $statuses[$code] !== 'submitted' ? ' · ' . e($statuses[$code]) : '' ?></span></li>
                        <?php endforeach; endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
