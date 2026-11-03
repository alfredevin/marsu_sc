<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header(Ui::fullName($student), $student['student_number'] . ' · ' . ($student['program_code'] ?? '') . ' · Year ' . (int) $student['year_level'] . ' · ' . ($student['section_name'] ?? ''), 'bi-person',
        '<a href="' . e(url('analytics/faculty/students')) . '" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>My Students</a>') ?>
    <?= Ui::privacyNotice() ?>
    <?php foreach ($classes as $c): $cl = $c['class']; ?>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-transparent d-flex flex-wrap justify-content-between gap-2">
                <span><a class="fw-semibold text-decoration-none" href="<?= url('analytics/faculty/classes/' . (int) $cl['id']) ?>"><?= e($cl['subject_code']) ?></a> <?= e($cl['section_name']) ?></span>
                <span><?= Ui::gradeStatusBadge($cl['grade_status']) ?>
                    <?php if ($c['posted'] && $cl['grade_status'] !== 'draft'): ?><strong class="ms-2"><?= e($c['posted']['final_grade']) ?></strong> <?= Ui::remarksBadge($c['posted']['remarks']) ?>
                    <?php elseif ($c['computed']): ?><strong class="ms-2"><?= e($c['computed']['final_grade']) ?></strong> <span class="text-secondary small">(draft)</span><?php endif; ?></span>
            </div>
            <div class="card-body small">
                <div class="mb-2">Attendance <?= Ui::pct($c['attRate']) ?> (P <?= (int) $c['attendance']['present'] ?> · L <?= (int) $c['attendance']['late'] ?> · E <?= (int) $c['attendance']['excused'] ?> · A <?= (int) $c['attendance']['absent'] ?>)</div>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($c['scheme']['groups'] as $g): foreach ($g['items'] as $it): $code = $it['code']; ?>
                        <span class="badge bg-light text-dark border"><?= e($code) ?>: <?= isset($c['scores'][$code]) ? e((string) $c['scores'][$code]) : '—' ?>/<?= e((string) $it['maxScore']) ?><?= !empty($c['statuses'][$code]) && $c['statuses'][$code] !== 'submitted' ? ' · ' . e($c['statuses'][$code]) : '' ?></span>
                    <?php endforeach; endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent fw-semibold">Conduct reports I filed</div>
        <?php if (empty($conduct)): ?>
            <div class="card-body small text-secondary">None.</div>
        <?php else: ?>
            <ul class="list-group list-group-flush small">
                <?php foreach ($conduct as $b): ?><li class="list-group-item"><?= e($b['incident_date']) ?> · <?= e($b['incident_type']) ?> · <?= e($b['severity']) ?> · <?= e($b['status']) ?></li><?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
