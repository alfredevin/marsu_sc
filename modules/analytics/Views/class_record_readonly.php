<?php
use Modules\Analytics\Support\Ui;

$scheme = $record['scheme'];
$dates = $record['dates'];
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($class['subject_code'] . ' · ' . $class['subject_title'],
        $class['section_name'] . ' · ' . trim(($class['semester_name'] ?? '') . ' ' . ($class['academic_year_label'] ?? '')) . ' · Faculty: ' . ($class['faculty_name'] ?? 'Unassigned'),
        'bi-table',
        '<a href="' . e(url('analytics/class-records')) . '" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Class Records</a>') ?>
    <?= Ui::readonlyBanner('Read-only — grades are owned by the faculty. Monitoring accounts cannot edit scores, post grades or change the roster.') ?>
    <?= Ui::privacyNotice() ?>

    <div class="d-flex flex-wrap gap-2 mb-3 small">
        <?= Ui::gradeStatusBadge($class['grade_status']) ?>
        <span class="badge bg-light text-dark border">Scheme: <?= e($scheme['name']) ?></span>
        <span class="badge bg-light text-dark border">Passing ≤ <?= number_format($scheme['passingCutoff'], 2) ?></span>
        <span class="badge bg-light text-dark border">Sessions recorded: <?= count($dates) ?></span>
        <span class="badge bg-light text-dark border">Enrolled: <?= count($record['roster']) ?></span>
        <?php if (!$published): ?><span class="badge bg-warning text-dark">Draft — not yet posted by faculty</span><?php endif; ?>
    </div>

    <div class="card border-0 shadow-sm">
        <?php if (empty($record['roster'])): ?>
            <?= Ui::emptyState('No students on this roster', 'The faculty has not added enrolled students to this class yet.', 'bi-people') ?>
        <?php else: ?>
            <div class="table-responsive" style="max-height:70vh">
                <table class="table table-sm table-bordered align-middle mb-0 small text-center">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th rowspan="2" class="text-start">Student</th>
                            <?php foreach ($scheme['groups'] as $g): ?>
                                <th colspan="<?= count($g['items']) + 1 ?>"><?= e($g['title']) ?> (<?= e((string) $g['weight']) ?>%)</th>
                            <?php endforeach; ?>
                            <th rowspan="2">Grade</th><th rowspan="2">Remarks</th>
                        </tr>
                        <tr>
                            <?php foreach ($scheme['groups'] as $g): ?>
                                <?php foreach ($g['items'] as $it): ?><th title="<?= e($it['title']) ?>"><?= e($it['code']) ?><div class="fw-normal text-secondary">/<?= e((string) $it['maxScore']) ?></div></th><?php endforeach; ?>
                                <th>Share</th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($record['roster'] as $r):
                            $sid = (int) $r['student_id'];
                            $comp = $record['computed'][$sid] ?? null;
                            $posted = $published ? ($record['posted'][$sid] ?? null) : null;
                        ?>
                            <tr>
                                <td class="text-start"><span class="fw-semibold"><?= e(Ui::fullName($r)) ?></span><div class="text-secondary"><?= e($r['student_number']) ?></div></td>
                                <?php foreach ($scheme['groups'] as $g): ?>
                                    <?php foreach ($g['items'] as $it): $code = $it['code']; $st = $record['statuses'][$sid][$code] ?? null; ?>
                                        <td><?= isset($record['scores'][$sid][$code]) ? e((string) $record['scores'][$sid][$code]) : '—' ?><?php if ($st && $st !== 'submitted'): ?><div class="text-secondary"><?= e($st) ?></div><?php endif; ?></td>
                                    <?php endforeach; ?>
                                    <td class="fw-semibold"><?= $comp ? number_format($comp['groups'][$g['id']]['share'] ?? 0, 2) : '—' ?></td>
                                <?php endforeach; ?>
                                <?php if ($posted): ?>
                                    <td class="fw-bold"><?= e($posted['final_grade']) ?></td>
                                    <td><?= Ui::remarksBadge($posted['remarks']) ?></td>
                                <?php else: ?>
                                    <td class="fw-semibold"><?= e($comp['final_grade'] ?? '—') ?><div class="text-warning-emphasis">Draft</div></td>
                                    <td><?= Ui::remarksBadge($comp['remarks'] ?? null) ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
