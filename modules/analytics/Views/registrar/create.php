<?php
use Modules\Analytics\Support\Ui;

$termOptions = function () use ($terms, $activeTerm) {
    $html = '';
    foreach ($terms as $t) {
        $sel = (int) $t['semester_id'] === (int) ($activeTerm['semester_id'] ?? 0) ? ' selected' : '';
        $html .= '<option value="' . (int) $t['semester_id'] . '"' . $sel . '>' . e($t['label']) . '</option>';
    }
    return $html;
};
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Enroll Students', 'Enroll existing student records. New student master records are created in the core Students page.', 'bi-person-plus') ?>
    <?= Ui::privacyNotice() ?>
    <?php if (!$activeTerm): ?><div class="alert alert-warning small">No term is active. Choose the term explicitly in each form.</div><?php endif; ?>

    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#single" type="button">Single student</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#bulk" type="button">Whole section</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#csv" type="button">CSV import</button></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="single">
            <div class="row g-3">
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm">
                        <form method="GET" class="card-body small d-flex gap-2">
                            <input type="search" name="q" value="<?= e($q) ?>" class="form-control form-control-sm" placeholder="Search student number or name" required>
                            <button class="btn btn-sm btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                        <?php if ($q !== '' && empty($results)): ?><div class="card-body pt-0 small text-secondary">No existing student matches. Create the master record in core Students first.</div><?php endif; ?>
                        <div class="list-group list-group-flush small">
                            <?php foreach ($results as $r): ?>
                                <a class="list-group-item list-group-item-action <?= $selected && (int) $selected['id'] === (int) $r['id'] ? 'active' : '' ?>" href="<?= url('analytics/registrar/enrollments/create', ['q' => $q, 'student_id' => (int) $r['id']]) ?>">
                                    <?= e(Ui::fullName($r)) ?> <span class="opacity-75"><?= e($r['student_number']) ?> · <?= e($r['program_code']) ?> <?= (int) $r['year_level'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <?php if (!$selected): ?>
                        <div class="card border-0 shadow-sm"><?= Ui::emptyState('Pick a student', 'Search on the left and choose the student to enroll.', 'bi-search') ?></div>
                    <?php else: ?>
                        <form method="POST" action="<?= url('analytics/registrar/enrollments/store') ?>" class="card border-0 shadow-sm">
                            <?= csrf_field() ?>
                            <input type="hidden" name="student_id" value="<?= (int) $selected['id'] ?>">
                            <div class="card-header bg-transparent fw-semibold"><?= e(Ui::fullName($selected)) ?> · <?= e($selected['student_number']) ?></div>
                            <div class="card-body row g-2 small">
                                <div class="col-md-6"><label class="form-label mb-1">Term</label><select name="semester_id" class="form-select form-select-sm" required><?= $termOptions() ?></select></div>
                                <div class="col-md-6"><label class="form-label mb-1">Status</label><select name="status" class="form-select form-select-sm"><option value="enrolled">Enrolled</option><option value="pending">Pending</option></select></div>
                                <div class="col-md-5"><label class="form-label mb-1">Program</label><select name="program_id" class="form-select form-select-sm" required>
                                    <?php foreach ($programs as $p): ?><option value="<?= (int) $p['id'] ?>" <?= (int) $p['id'] === (int) $selected['program_id'] ? 'selected' : '' ?>><?= e($p['code']) ?></option><?php endforeach; ?></select></div>
                                <div class="col-md-2"><label class="form-label mb-1">Year</label><input type="number" name="year_level" min="1" max="6" value="<?= (int) $selected['year_level'] ?>" class="form-control form-control-sm"></div>
                                <div class="col-md-5"><label class="form-label mb-1">Section</label><select name="section_id" class="form-select form-select-sm"><option value="">None</option>
                                    <?php foreach ($sections as $s): ?><option value="<?= (int) $s['id'] ?>" <?= (int) $s['id'] === (int) ($selected['section_id'] ?? 0) ? 'selected' : '' ?>><?= e($s['name'] . ' (' . $s['program_code'] . ')') ?></option><?php endforeach; ?></select></div>
                                <div class="col-12"><label class="form-label mb-1">Subject load</label><?php $pickerId = 'singleSubj'; $checked = []; include __DIR__ . '/subject_picker.php'; ?></div>
                                <div class="col-12"><label class="form-label mb-1">Remarks</label><input name="remarks" maxlength="255" class="form-control form-control-sm"></div>
                            </div>
                            <div class="card-footer bg-transparent"><button class="btn btn-sm btn-marsu" type="submit">Save enrollment</button></div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="bulk">
            <form method="POST" action="<?= url('analytics/registrar/enrollments/bulk') ?>" class="card border-0 shadow-sm" style="max-width:760px">
                <?= csrf_field() ?>
                <div class="card-body row g-2 small">
                    <p class="text-secondary mb-1">Enrolls every student whose master record belongs to the section. Students already enrolled for the term are skipped.</p>
                    <div class="col-md-4"><label class="form-label mb-1">Term</label><select name="semester_id" class="form-select form-select-sm" required><?= $termOptions() ?></select></div>
                    <div class="col-md-5"><label class="form-label mb-1">Section</label><select name="section_id" class="form-select form-select-sm" required>
                        <?php foreach ($sections as $s): ?><option value="<?= (int) $s['id'] ?>"><?= e($s['name'] . ' (' . $s['program_code'] . ')') ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-3"><label class="form-label mb-1">Status</label><select name="status" class="form-select form-select-sm"><option value="enrolled">Enrolled</option><option value="pending">Pending</option></select></div>
                    <div class="col-12"><label class="form-label mb-1">Subject load</label><?php $pickerId = 'bulkSubj'; $checked = []; include __DIR__ . '/subject_picker.php'; ?></div>
                </div>
                <div class="card-footer bg-transparent"><button class="btn btn-sm btn-marsu" type="submit">Enroll section</button></div>
            </form>
        </div>

        <div class="tab-pane fade" id="csv">
            <form method="POST" action="<?= url('analytics/registrar/enrollments/import') ?>" enctype="multipart/form-data" class="card border-0 shadow-sm" style="max-width:760px">
                <?= csrf_field() ?>
                <div class="card-body row g-2 small">
                    <p class="text-secondary mb-1">Columns: <code>student_number</code>, optional <code>subject codes</code> separated by <code>;</code>, optional <code>status</code> (pending / enrolled). Unknown student numbers are listed as errors and never created. Program, year and section come from each student's master record.</p>
                    <div class="col-md-4"><label class="form-label mb-1">Term</label><select name="semester_id" class="form-select form-select-sm" required><?= $termOptions() ?></select></div>
                    <div class="col-md-3"><label class="form-label mb-1">Default status</label><select name="status" class="form-select form-select-sm"><option value="enrolled">Enrolled</option><option value="pending">Pending</option></select></div>
                    <div class="col-md-5"><label class="form-label mb-1">CSV file</label><input type="file" name="csv" accept=".csv" required class="form-control form-control-sm"></div>
                    <div class="col-12"><label class="form-label mb-1">Default subject load (used when a row has no subject codes)</label><?php $pickerId = 'csvSubj'; $checked = []; include __DIR__ . '/subject_picker.php'; ?></div>
                </div>
                <div class="card-footer bg-transparent"><button class="btn btn-sm btn-marsu" type="submit">Import</button></div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.subject-filter').forEach(function (input) {
        input.addEventListener('input', function () {
            var q = input.value.trim().toLowerCase();
            document.querySelectorAll('#' + input.dataset.target + ' .subject-option').forEach(function (o) {
                o.style.display = !q || o.dataset.text.indexOf(q) !== -1 || o.querySelector('input').checked ? '' : 'none';
            });
        });
    });
});
</script>
