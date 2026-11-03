<?php
use Modules\Analytics\Support\Ui;

$statusSel = (string) ($_GET['status'] ?? '');
ob_start(); ?>
<div class="col-12 col-sm-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Search</label>
    <input type="search" name="q" value="<?= e($_GET['q'] ?? '') ?>" class="form-control form-control-sm" placeholder="Subject, section, faculty">
</div>
<div class="col-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Grade status</label>
    <select name="status" class="form-select form-select-sm">
        <option value="">Any</option>
        <?php foreach (['draft' => 'Draft', 'posted' => 'Posted', 'locked' => 'Locked'] as $k => $v): ?>
            <option value="<?= $k ?>" <?= $statusSel === $k ? 'selected' : '' ?>><?= $v ?></option>
        <?php endforeach; ?>
    </select>
</div>
<?php $filterExtra = ob_get_clean(); ?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($heading,'Every class in your scope. Grades are owned by the faculty; this view is read-only.', 'bi-table') ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No classes found', 'Faculty have not created classes matching these filters.', 'bi-collection') ?>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 small">
                    <thead class="table-light"><tr><th>Subject</th><th>Section</th><th>Faculty</th><th>Term</th><th class="text-center">Enrolled</th><th>Grades</th><th></th></tr></thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><span class="fw-semibold"><?= e($r['subject_code']) ?></span><div class="text-secondary"><?= e($r['subject_title']) ?></div></td>
                                <td><?= e($r['section_name']) ?></td>
                                <td><?= e($r['faculty_name'] ?? 'Unassigned') ?></td>
                                <td><?= e(trim(($r['semester_name'] ?? '') . ' ' . ($r['academic_year_label'] ?? ''))) ?: '—' ?></td>
                                <td class="text-center"><?= (int) $r['enrolled_count'] ?></td>
                                <td><?= Ui::gradeStatusBadge($r['grade_status']) ?></td>
                                <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/class-records/' . (int) $r['id']) ?>"><i class="bi bi-eye me-1"></i>Open</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
