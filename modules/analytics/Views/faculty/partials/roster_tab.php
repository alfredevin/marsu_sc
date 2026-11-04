<?php
use Modules\Analytics\Support\Ui;

$locked = $class['grade_status'] === 'locked';
$same = array_values(array_filter($candidates, fn($c) => (int) $c['same_section'] === 1));
$other = array_values(array_filter($candidates, fn($c) => (int) $c['same_section'] !== 1));
?>
<div class="row g-3">
    <div class="col-xl-6">
        <?php if ($joinRequests): ?>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">Join requests (class code)</div>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($joinRequests as $j): ?>
                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div>
                                <span class="fw-semibold"><?= e($j['last_name'] . ', ' . $j['first_name']) ?></span> <span class="text-secondary"><?= e($j['student_number']) ?> · <?= e($j['program_code']) ?></span>
                                <div><?= $j['officially_enrolled'] ? '<span class="text-success"><i class="bi bi-check-circle"></i> Officially enrolled in this subject</span>' : '<span class="text-danger"><i class="bi bi-x-circle"></i> Not enrolled in this subject for the term</span>' ?></div>
                            </div>
                            <div class="d-flex gap-1">
                                <?php if ($j['officially_enrolled'] && !$locked): ?>
                                    <form method="POST" action="<?= url($base . '/join-requests/' . (int) $j['id'] . '/approve') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-success" type="submit">Approve</button></form>
                                <?php endif; ?>
                                <form method="POST" action="<?= url($base . '/join-requests/' . (int) $j['id'] . '/reject') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" type="submit">Reject</button></form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-transparent fw-semibold">Add enrolled students</div>
            <div class="card-body small">
                <p class="text-secondary">Only students the Registrar officially enrolled in <strong><?= e($class['subject_code']) ?></strong> for this term are listed. Students in <?= e($class['section_name']) ?> come first; others are irregular enrollees from other sections.</p>
                <form method="GET" class="d-flex gap-2 mb-3">
                    <input type="hidden" name="tab" value="roster">
                    <input type="search" name="q" value="<?= e($search) ?>" class="form-control form-control-sm" placeholder="Search enrolled students by number or name">
                    <button class="btn btn-sm btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <?php if ($locked): ?>
                    <p class="text-secondary mb-0">This class is locked; the roster cannot change.</p>
                <?php elseif (empty($candidates)): ?>
                    <?= Ui::emptyState('No enrolled students to add', $search !== '' ? 'No officially enrolled student matches that search.' : 'Every registrar-enrolled student for this subject is already on the roster, or the Registrar has not enrolled anyone yet.', 'bi-person-check') ?>
                <?php else: ?>
                    <form method="POST" action="<?= url($base . '/roster/add-enrolled') ?>">
                        <?= csrf_field() ?>
                        <?php foreach ([['Same section', $same], ['Irregular (other sections)', $other]] as [$label, $list]): if (!$list) { continue; } ?>
                            <div class="d-flex justify-content-between align-items-center mt-2 mb-1">
                                <span class="fw-semibold"><?= e($label) ?> (<?= count($list) ?>)</span>
                                <button type="button" class="btn btn-link btn-sm p-0 select-all">Select all</button>
                            </div>
                            <div class="border rounded p-2 mb-2 candidate-group" style="max-height:260px;overflow:auto">
                                <?php foreach ($list as $c): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="student_ids[]" value="<?= (int) $c['student_id'] ?>" id="cand<?= (int) $c['student_id'] ?>">
                                        <label class="form-check-label" for="cand<?= (int) $c['student_id'] ?>"><?= e(Ui::fullName($c)) ?> <span class="text-secondary"><?= e($c['student_number']) ?> · <?= e($c['enrolled_section_name'] ?? 'no section') ?></span></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                        <button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-person-plus me-1"></i>Add selected</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-transparent fw-semibold">Current roster (<?= count($record['roster']) ?>)</div>
            <?php if (empty($record['roster'])): ?>
                <?= Ui::emptyState('Roster is empty', 'Add enrolled students or share the class code ' . ($class['class_code'] ?? '') . '.', 'bi-people') ?>
            <?php else: ?>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($record['roster'] as $r): ?>
                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div><span class="fw-semibold"><?= e(Ui::fullName($r)) ?></span> <span class="text-secondary"><?= e($r['student_number']) ?> · <?= e($r['student_section'] ?? '') ?></span></div>
                            <?php if ($class['grade_status'] === 'draft'): ?>
                                <form method="POST" action="<?= url($base . '/roster/mark') ?>" class="d-flex align-items-center gap-1" title="Applied when grades are posted">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="student_id" value="<?= (int) $r['student_id'] ?>">
                                    <span class="text-secondary">Mark</span>
                                    <select name="mark" class="form-select form-select-sm" style="width:80px" onchange="this.form.submit()" aria-label="Grade mark">
                                        <option value="">—</option>
                                        <option value="INC" <?= $r['grade_mark'] === 'INC' ? 'selected' : '' ?>>INC</option>
                                        <option value="DRP" <?= $r['grade_mark'] === 'DRP' ? 'selected' : '' ?>>DRP</option>
                                    </select>
                                </form>
                            <?php endif; ?>
                            <?php if (!$locked): ?>
                                <form method="POST" action="<?= url($base . '/roster/remove') ?>" class="d-flex gap-1" data-confirm="Drop <?= e($r['first_name'] . ' ' . $r['last_name']) ?> from this class? Recorded scores are kept.">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="student_id" value="<?= (int) $r['student_id'] ?>">
                                    <input type="text" name="reason" class="form-control form-control-sm" style="width:170px" minlength="5" required placeholder="Reason for dropping" aria-label="Reason for dropping">
                                    <button class="btn btn-sm btn-outline-danger" type="submit" title="Drop"><i class="bi bi-person-dash"></i></button>
                                </form>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php if ($droppedRoster): ?>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">Dropped (<?= count($droppedRoster) ?>)</div>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($droppedRoster as $r): ?>
                        <li class="list-group-item"><?= e(Ui::fullName($r)) ?> <span class="text-secondary"><?= e($r['student_number']) ?> — <?= e($r['drop_reason'] ?? '') ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.select-all').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var group = btn.parentElement.nextElementSibling;
            group.querySelectorAll('input[type=checkbox]').forEach(function (c) { c.checked = true; });
        });
    });
});
</script>
