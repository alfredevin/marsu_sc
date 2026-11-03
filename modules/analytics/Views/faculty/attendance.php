<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Roll-Call Attendance', 'Record one session per date. Saving again on the same date updates that session.', 'bi-calendar-check') ?>
    <?= Ui::privacyNotice() ?>
    <?php if (empty($classes)): ?>
        <div class="card border-0 shadow-sm"><?= Ui::emptyState('No classes', 'Create a class first.', 'bi-collection', url('analytics/faculty/classes/create'), 'Create class') ?></div>
    <?php else: ?>
        <form method="GET" class="card border-0 shadow-sm mb-3">
            <div class="card-body py-2 row g-2 align-items-end small">
                <div class="col-sm-6 col-lg-4"><label class="form-label mb-1">Class</label>
                    <select name="class_id" class="form-select form-select-sm">
                        <?php foreach ($classes as $c): ?><option value="<?= (int) $c['id'] ?>" <?= (int) $c['id'] === $classId ? 'selected' : '' ?>><?= e($c['subject_code'] . ' — ' . $c['section_name']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="col-sm-4 col-lg-2"><label class="form-label mb-1">Session date</label><input type="date" name="date" value="<?= e($date) ?>" max="<?= e(date('Y-m-d')) ?>" class="form-control form-control-sm"></div>
                <div class="col-auto"><button class="btn btn-sm btn-outline-secondary" type="submit">Load</button></div>
            </div>
        </form>

        <div class="row g-3">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent fw-semibold"><?= e(($selected['subject_code'] ?? '') . ' · ' . ($selected['section_name'] ?? '')) ?> — <?= e($date) ?></div>
                    <?php if (empty($roster)): ?>
                        <?= Ui::emptyState('No students on the roster', 'Add enrolled students to this class first.', 'bi-people', url('analytics/faculty/classes/' . $classId, ['tab' => 'roster']), 'Open roster') ?>
                    <?php else: ?>
                        <form method="POST" action="<?= url('analytics/faculty/attendance/store') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="class_id" value="<?= $classId ?>">
                            <input type="hidden" name="session_date" value="<?= e($date) ?>">
                            <div class="p-2 d-flex gap-2 small">
                                <span class="text-secondary">Mark all:</span>
                                <?php foreach (['Present', 'Late', 'Absent', 'Excused'] as $s): ?><button type="button" class="btn btn-sm btn-outline-secondary mark-all" data-status="<?= $s ?>"><?= $s ?></button><?php endforeach; ?>
                            </div>
                            <div class="table-responsive"><table class="table table-sm align-middle mb-0 small">
                                <thead class="table-light"><tr><th>Student</th><th>Status</th><th>Remarks</th></tr></thead>
                                <tbody>
                                    <?php foreach ($roster as $r): $sid = (int) $r['student_id']; $cur = $existing[$sid]['status'] ?? 'Present'; ?>
                                        <tr>
                                            <td><?= e(Ui::fullName($r)) ?> <span class="text-secondary"><?= e($r['student_number']) ?></span></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Status">
                                                    <?php foreach (['Present' => 'P', 'Late' => 'L', 'Absent' => 'A', 'Excused' => 'E'] as $s => $abbr): $idn = 'st' . $sid . $abbr; ?>
                                                        <input type="radio" class="btn-check" name="status[<?= $sid ?>]" id="<?= $idn ?>" value="<?= $s ?>" <?= $cur === $s ? 'checked' : '' ?>>
                                                        <label class="btn btn-outline-secondary" for="<?= $idn ?>" title="<?= $s ?>"><?= $abbr ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>
                                            <td><input type="text" name="remarks[<?= $sid ?>]" maxlength="255" value="<?= e($existing[$sid]['remarks'] ?? '') ?>" class="form-control form-control-sm" aria-label="Remarks"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table></div>
                            <div class="card-footer bg-transparent"><button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-save me-1"></i>Save session</button></div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent fw-semibold">Recorded sessions</div>
                    <?php if (empty($history)): ?>
                        <div class="card-body small text-secondary">No sessions recorded yet.</div>
                    <?php else: ?>
                        <ul class="list-group list-group-flush small">
                            <?php foreach ($history as $h): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <a href="<?= url('analytics/faculty/attendance', ['class_id' => $classId, 'date' => $h['session_date']]) ?>"><?= e($h['session_date']) ?></a>
                                    <span>P <?= (int) $h['present'] ?> · L <?= (int) $h['late'] ?> · A <?= (int) $h['absent'] ?> · E <?= (int) $h['excused'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.mark-all').forEach(function (b) {
        b.addEventListener('click', function () {
            document.querySelectorAll('input.btn-check[value="' + b.dataset.status + '"]').forEach(function (r) { r.checked = true; });
        });
    });
});
</script>
