<?php
use Modules\Analytics\Support\Ui;

$canEdit = can('analytics.registrar.enrollment');
$enrolledSubjects = array_map(fn($s) => (int) $s['subject_id'], array_filter($e['subjects'], fn($s) => $s['status'] === 'enrolled'));
$actions = '<a target="_blank" class="btn btn-sm btn-outline-secondary" href="' . e(url('analytics/registrar/cor/' . (int) $e['id'])) . '"><i class="bi bi-printer me-1"></i>Print COR</a>';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header(Ui::fullName($e), $e['student_number'] . ' · ' . $e['term_label'], 'bi-card-list', $actions) ?>
    <?= Ui::privacyNotice() ?>
    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body small">
                    <dl class="row mb-0">
                        <dt class="col-4">Status</dt><dd class="col-8"><?= Ui::enrollmentBadge($e['status']) ?> <?= e($e['remarks'] ?? '') ?></dd>
                        <dt class="col-4">Program / year</dt><dd class="col-8"><?= e($e['program_code']) ?> · <?= (int) $e['year_level'] ?></dd>
                        <dt class="col-4">Section</dt><dd class="col-8"><?= e($e['section_name'] ?? '—') ?></dd>
                        <dt class="col-4">Enrolled</dt><dd class="col-8"><?= e($e['enrolled_at'] ?? '—') ?> <?= $e['enrolled_by_name'] ? 'by ' . e($e['enrolled_by_name']) : '' ?></dd>
                        <dt class="col-4">Login account</dt><dd class="col-8"><?= $e['user_id'] ? 'Linked' : '<span class="text-danger">Not linked — create it in core User Accounts</span>' ?></dd>
                    </dl>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">Subject load</div>
                <table class="table table-sm mb-0 small"><thead class="table-light"><tr><th>Code</th><th>Title</th><th class="text-center">Units</th><th>Status</th></tr></thead>
                    <tbody><?php foreach ($e['subjects'] as $s): ?><tr class="<?= $s['status'] === 'dropped' ? 'text-secondary' : '' ?>"><td><?= e($s['code']) ?></td><td><?= e($s['title']) ?></td><td class="text-center"><?= e((string) $s['units']) ?></td><td><?= e($s['status']) ?></td></tr><?php endforeach; ?></tbody></table>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">History</div>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($history as $h): ?><li class="list-group-item"><?= e(date('M j, Y g:i A', strtotime($h['created_at']))) ?> · <?= e($h['action']) ?> <?= e(($h['old_value'] ?? '') . ' → ' . ($h['new_value'] ?? '')) ?> <span class="text-secondary"><?= e($h['reason'] ?? '') ?> — <?= e($h['user_name'] ?? '') ?></span></li><?php endforeach; ?>
                    <?php if (!$history): ?><li class="list-group-item text-secondary">No history.</li><?php endif; ?>
                </ul>
            </div>
        </div>
        <?php if ($canEdit): ?>
            <div class="col-lg-5">
                <form method="POST" action="<?= url('analytics/registrar/enrollments/' . (int) $e['id'] . '/status') ?>" class="card border-0 shadow-sm mb-3">
                    <?= csrf_field() ?>
                    <div class="card-header bg-transparent fw-semibold">Change status</div>
                    <div class="card-body small">
                        <select name="status" class="form-select form-select-sm mb-2">
                            <?php foreach (['pending', 'enrolled', 'withdrawn', 'cancelled'] as $s): if ($s === $e['status']) { continue; } ?><option value="<?= $s ?>"><?= ucfirst($s) ?></option><?php endforeach; ?>
                        </select>
                        <input name="reason" minlength="5" maxlength="255" required class="form-control form-control-sm mb-2" placeholder="Reason (logged)">
                        <button class="btn btn-sm btn-marsu" type="submit">Update status</button>
                    </div>
                </form>
                <form method="POST" action="<?= url('analytics/registrar/enrollments/' . (int) $e['id'] . '/subjects') ?>" class="card border-0 shadow-sm">
                    <?= csrf_field() ?>
                    <div class="card-header bg-transparent fw-semibold">Edit subject load</div>
                    <div class="card-body small">
                        <?php $pickerId = 'editSubj'; $checked = $enrolledSubjects; include __DIR__ . '/subject_picker.php'; ?>
                        <input name="reason" minlength="5" maxlength="255" required class="form-control form-control-sm my-2" placeholder="Reason (logged)">
                        <button class="btn btn-sm btn-marsu" type="submit">Save subject load</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
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
