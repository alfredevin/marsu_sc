<?php
use Modules\Analytics\Support\Ui;

$exportUrl = null;
$publishedPct = (int) $classStats['total'] > 0 ? (int) $classStats['published'] / (int) $classStats['total'] : null;
$passRate = $gradedTotal > 0 ? $grades['PASSED'] / $gradedTotal : null;
$kpis = [
    ['Students in scope', number_format($totalStudents), 'bi-people', url('analytics/students')],
    ['Officially enrolled (term)', number_format($enrollment['enrolled']), 'bi-person-check', url('analytics/students', ['status' => 'enrolled'])],
    ['Pending enrollments', number_format($enrollment['pending']), 'bi-hourglass', url('analytics/students', ['status' => 'pending'])],
    ['Active classes (term)', number_format((int) $classStats['total']), 'bi-collection', url('analytics/class-records')],
    ['Grades posted / draft', (int) $classStats['published'] . ' / ' . (int) $classStats['draft'], 'bi-journal-check', url('analytics/class-records')],
    ['Pass rate (posted)', Ui::pct($passRate), 'bi-graph-up', url('analytics/subjectperformance')],
    ['Attendance rate', Ui::pct($attendanceRate), 'bi-calendar-check', url('analytics/attendancerecords')],
    ['Open INC', number_format($openInc), 'bi-exclamation-triangle', url('analytics/failedincompletemonitoring', ['type' => 'INC', 'open' => '1'])],
    ['Pending corrections', number_format($pendingCorrections), 'bi-arrow-counterclockwise', can('analytics.admin.grades') ? url('analytics/admin/corrections') : null],
];
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Academic Monitoring Overview', 'Every figure is computed live from enrollment, class record and attendance tables.', 'bi-speedometer2') ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>

    <div class="row g-3 mb-3">
        <?php foreach ($kpis as [$label, $value, $icon, $link]): ?>
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body py-3">
                        <div class="text-secondary small mb-1"><i class="bi <?= e($icon) ?> me-1"></i><?= e($label) ?></div>
                        <div class="fs-4 fw-bold"><?= e($value) ?></div>
                        <?php if ($link): ?><a href="<?= e($link) ?>" class="small stretched-link text-decoration-none">View</a><?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Posted grade distribution</div>
                <div class="card-body">
                    <?php if ($gradedTotal === 0): ?>
                        <?= Ui::emptyState('No posted grades yet', 'Grades appear here after faculty post a class record for this term.', 'bi-pie-chart') ?>
                    <?php else: ?>
                        <div style="height:240px"><canvas id="gradeDist" aria-label="Posted grade distribution"></canvas></div>
                        <table class="table table-sm small mt-2 mb-0">
                            <?php foreach ($grades as $k => $v): ?>
                                <tr><td><?= Ui::remarksBadge($k) ?></td><td class="text-end fw-semibold"><?= (int) $v ?></td></tr>
                            <?php endforeach; ?>
                        </table>
                        <?= Ui::chartScript('gradeDist', [
                            'type' => 'doughnut',
                            'data' => ['labels' => array_keys($grades), 'datasets' => [['data' => array_values($grades), 'backgroundColor' => ['#2e7d32', '#800020', '#D4AF37', '#6c757d']]]],
                            'options' => ['maintainAspectRatio' => false, 'plugins' => ['legend' => ['position' => 'bottom']]],
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Pass rate by subject (posted classes)</div>
                <div class="card-body">
                    <?php if (empty($subjectRows)): ?>
                        <?= Ui::emptyState('No subject results yet', 'Pass rates are computed from posted and locked class grades.', 'bi-bar-chart') ?>
                    <?php else: ?>
                        <div style="height:300px"><canvas id="subjectPass" aria-label="Pass rate by subject"></canvas></div>
                        <?= Ui::chartScript('subjectPass', [
                            'type' => 'bar',
                            'data' => ['labels' => array_column($subjectRows, 'subject_code'), 'datasets' => [[
                                'label' => 'Pass rate %',
                                'data' => array_map(fn($r) => $r['pass_rate'] === null ? 0 : round($r['pass_rate'] * 100, 1), $subjectRows),
                                'backgroundColor' => '#800020', 'borderRadius' => 4,
                            ]]],
                            'options' => ['maintainAspectRatio' => false, 'scales' => ['y' => ['min' => 0, 'max' => 100]], 'plugins' => ['legend' => ['display' => false]]],
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Officially enrolled by program (term)</div>
                <div class="card-body">
                    <?php if (empty($enrollByProgram)): ?>
                        <?= Ui::emptyState('No enrollments recorded', 'The Registrar has not enrolled students for this term yet.', 'bi-person-plus') ?>
                    <?php else: ?>
                        <div style="height:240px"><canvas id="enrollProg" aria-label="Enrollment by program"></canvas></div>
                        <?= Ui::chartScript('enrollProg', [
                            'type' => 'bar',
                            'data' => ['labels' => array_column($enrollByProgram, 'code'), 'datasets' => [[
                                'label' => 'Enrolled', 'data' => array_map('intval', array_column($enrollByProgram, 'n')), 'backgroundColor' => '#D4AF37', 'borderRadius' => 4,
                            ]]],
                            'options' => ['maintainAspectRatio' => false, 'plugins' => ['legend' => ['display' => false]]],
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold d-flex justify-content-between">
                    <span>Administrator notes</span>
                </div>
                <div class="card-body">
                    <?php if (!can('analytics.admin.settings')): ?>
                        <p class="small text-secondary mb-0">Notes are maintained by the module administrator.</p>
                    <?php else: ?>
                        <form method="POST" action="<?= url('analytics/admin/notes') ?>" class="d-flex gap-2 mb-3">
                            <?= csrf_field() ?>
                            <input type="text" name="note" class="form-control form-control-sm" maxlength="500" placeholder="Add a note for the monitoring team" required>
                            <button class="btn btn-sm btn-marsu" type="submit">Add</button>
                        </form>
                        <?php if (empty($notes)): ?>
                            <p class="small text-secondary mb-0">No notes yet.</p>
                        <?php else: ?>
                            <ul class="list-group list-group-flush small">
                                <?php foreach ($notes as $n): ?>
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-start gap-2">
                                        <div><?= e($n['note']) ?><div class="text-secondary"><?= e($n['author'] ?? '') ?> · <?= e(date('M j, Y', strtotime($n['created_at']))) ?></div></div>
                                        <form method="POST" action="<?= url('analytics/admin/notes/' . (int) $n['id'] . '/archive') ?>">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-sm btn-link text-secondary p-0" title="Archive"><i class="bi bi-archive"></i></button>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <p class="small text-secondary mt-3 mb-0">
        Pass rate = PASSED ÷ all posted grades (PASSED, FAILED, INC, DRP). Attendance rate = (Present + Late × late weight + Excused) ÷ recorded entries, voided entries excluded.
    </p>
</div>
