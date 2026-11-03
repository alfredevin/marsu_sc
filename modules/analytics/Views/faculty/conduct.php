<?php
use Modules\Analytics\Support\Ui;

$byClass = [];
foreach ($rosterRows as $r) {
    $byClass[(int) $r['class_id']][] = $r;
}
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Conduct Reports', 'Report incidents for students on your own class rosters.', 'bi-flag') ?>
    <?= Ui::privacyNotice() ?>
    <div class="row g-3">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">New report</div>
                <?php if (empty($rosterRows)): ?>
                    <?= Ui::emptyState('No rostered students', 'You can only report students on your class rosters.', 'bi-people') ?>
                <?php else: ?>
                    <form method="POST" action="<?= url('analytics/faculty/conduct/store') ?>" class="card-body small">
                        <?= csrf_field() ?>
                        <div class="mb-2"><label class="form-label mb-1">Class</label>
                            <select name="class_id" id="conductClass" class="form-select form-select-sm" required>
                                <?php foreach ($classes as $c): if (empty($byClass[(int) $c['id']])) { continue; } ?>
                                    <option value="<?= (int) $c['id'] ?>"><?= e($c['subject_code'] . ' — ' . $c['section_name']) ?></option>
                                <?php endforeach; ?>
                            </select></div>
                        <div class="mb-2"><label class="form-label mb-1">Student</label>
                            <select name="student_id" id="conductStudent" class="form-select form-select-sm" required></select></div>
                        <div class="row g-2 mb-2">
                            <div class="col-6"><label class="form-label mb-1">Date</label><input type="date" name="incident_date" max="<?= e(date('Y-m-d')) ?>" value="<?= e(date('Y-m-d')) ?>" class="form-control form-control-sm" required></div>
                            <div class="col-6"><label class="form-label mb-1">Severity</label><select name="severity" class="form-select form-select-sm"><option>Minor</option><option>Moderate</option><option>Severe</option></select></div>
                        </div>
                        <div class="mb-2"><label class="form-label mb-1">Incident type</label><input name="incident_type" maxlength="100" required class="form-control form-control-sm" placeholder="e.g. Academic dishonesty"></div>
                        <div class="mb-2"><label class="form-label mb-1">Narrative (min 10 characters)</label><textarea name="description" rows="4" minlength="10" required class="form-control form-control-sm"></textarea></div>
                        <button class="btn btn-sm btn-marsu" type="submit">File report</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">My reports</div>
                <?php if (empty($reports)): ?>
                    <?= Ui::emptyState('No reports filed', 'Reports you file appear here with their review status.', 'bi-clipboard') ?>
                <?php else: ?>
                    <div class="table-responsive"><table class="table table-sm mb-0 small">
                        <thead class="table-light"><tr><th>Date</th><th>Student</th><th>Type</th><th>Severity</th><th>Status</th></tr></thead>
                        <tbody><?php foreach ($reports as $r): ?>
                            <tr><td><?= e($r['incident_date']) ?></td><td><?= e($r['last_name'] . ', ' . $r['first_name']) ?><div class="text-secondary"><?= e($r['subject_code'] ?? '') ?></div></td>
                                <td><?= e($r['incident_type']) ?></td><td><?= e($r['severity']) ?></td><td><?= e($r['status']) ?></td></tr>
                        <?php endforeach; ?></tbody>
                    </table></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var roster = <?= json_encode(array_map(fn($list) => array_map(fn($r) => ['id' => (int) $r['student_id'], 'label' => $r['last_name'] . ', ' . $r['first_name'] . ' (' . $r['student_number'] . ')'], $list), $byClass), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    var cls = document.getElementById('conductClass');
    var stu = document.getElementById('conductStudent');
    if (!cls || !stu) { return; }
    function fill() {
        stu.innerHTML = '';
        (roster[cls.value] || []).forEach(function (s) {
            var o = document.createElement('option');
            o.value = s.id; o.textContent = s.label;
            stu.appendChild(o);
        });
    }
    cls.addEventListener('change', fill);
    fill();
});
</script>
