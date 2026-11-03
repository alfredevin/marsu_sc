<?php
use Modules\Analytics\Support\Ui;

$q = (string) ($_GET['q'] ?? '');
$year = (int) ($_GET['year'] ?? 0);
$sectionSel = (int) ($_GET['section'] ?? 0);
$statusSel = (string) ($_GET['status'] ?? '');

ob_start(); ?>
<div class="col-12 col-sm-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Search</label>
    <input type="search" name="q" value="<?= e($q) ?>" class="form-control form-control-sm" placeholder="Number or name">
</div>
<div class="col-6 col-lg-1">
    <label class="form-label small text-secondary mb-1">Year</label>
    <select name="year" class="form-select form-select-sm">
        <option value="">All</option>
        <?php for ($y = 1; $y <= 5; $y++): ?><option value="<?= $y ?>" <?= $year === $y ? 'selected' : '' ?>><?= $y ?></option><?php endfor; ?>
    </select>
</div>
<div class="col-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Section</label>
    <select name="section" class="form-select form-select-sm">
        <option value="">All</option>
        <?php foreach ($sections as $s): ?>
            <option value="<?= (int) $s['id'] ?>" <?= $sectionSel === (int) $s['id'] ? 'selected' : '' ?>><?= e($s['name']) ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="col-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Term status</label>
    <select name="status" class="form-select form-select-sm">
        <option value="">Any</option>
        <?php foreach (['enrolled' => 'Enrolled', 'pending' => 'Pending', 'withdrawn' => 'Withdrawn', 'cancelled' => 'Cancelled', 'none' => 'Not enrolled'] as $k => $v): ?>
            <option value="<?= $k ?>" <?= $statusSel === $k ? 'selected' : '' ?>><?= $v ?></option>
        <?php endforeach; ?>
    </select>
</div>
<?php $filterExtra = ob_get_clean();
$programId = (int) ($_GET['program'] ?? 0);
$exportUrl = url('analytics/students/export', $filters);
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($heading, 'Master records in your scope with their official enrollment status for the selected term.', 'bi-people') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent small text-secondary"><?= number_format($pagination['total']) ?> student(s)</div>
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No students match these filters', 'Adjust the filters or search terms above.', 'bi-search') ?>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 small">
                    <thead class="table-light">
                        <tr><th>Student No.</th><th>Name</th><th>Program</th><th>Year</th><th>Section</th><th>Term status</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td class="fw-semibold"><?= e($r['student_number']) ?></td>
                                <td><?= e(Ui::fullName($r)) ?></td>
                                <td><?= e($r['program_code']) ?></td>
                                <td><?= (int) $r['year_level'] ?></td>
                                <td><?= e($r['section_name'] ?? '—') ?></td>
                                <td><?= Ui::enrollmentBadge($r['term_status']) ?></td>
                                <td class="text-end"><a href="<?= url('analytics/students/' . (int) $r['id']) ?>" class="btn btn-sm btn-outline-secondary">Dossier</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-transparent"><?= render_pagination($pagination, $listRoute, $filters) ?></div>
        <?php endif; ?>
    </div>
</div>
