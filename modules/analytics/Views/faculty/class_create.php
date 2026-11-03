<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Create Class', 'A unique class code is generated for students to join.', 'bi-plus-square') ?>
    <?php if (!$term): ?>
        <div class="card border-0 shadow-sm"><?= Ui::emptyState('No active term', 'Classes are created in the active term. Ask the administrator to activate an academic year and semester in the Academic Calendar.', 'bi-calendar-x') ?></div>
    <?php elseif (empty($templates)): ?>
        <div class="card border-0 shadow-sm"><?= Ui::emptyState('No grading templates', 'An administrator must create an active grading template first.', 'bi-file-earmark-ruled') ?></div>
    <?php else: ?>
        <form method="POST" action="<?= url('analytics/faculty/classes/store') ?>" class="card border-0 shadow-sm" style="max-width:760px">
            <?= csrf_field() ?>
            <div class="card-body row g-3 small">
                <div class="col-12"><span class="badge bg-light text-dark border">Term: <?= e($term['label']) ?></span></div>
                <div class="col-md-6">
                    <label class="form-label">Subject <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select form-select-sm" required>
                        <option value="">Choose a subject</option>
                        <?php foreach ($subjects as $s): ?>
                            <option value="<?= (int) $s['id'] ?>" <?= (int) old('subject_id') === (int) $s['id'] ? 'selected' : '' ?>><?= e($s['code'] . ' — ' . $s['title'] . ' (' . $s['units'] . ' u' . ($s['program_code'] ? ', ' . $s['program_code'] : '') . ')') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Section <span class="text-danger">*</span></label>
                    <select name="section_id" class="form-select form-select-sm" required>
                        <option value="">Choose a section</option>
                        <?php foreach ($sections as $s): ?>
                            <option value="<?= (int) $s['id'] ?>" <?= (int) old('section_id') === (int) $s['id'] ? 'selected' : '' ?>><?= e($s['name'] . ' (' . $s['program_code'] . ')') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Grading template <span class="text-danger">*</span></label>
                    <select name="template_id" class="form-select form-select-sm" required>
                        <?php foreach ($templates as $t): ?>
                            <option value="<?= (int) $t['id'] ?>"><?= e($t['name']) ?><?= $t['is_default'] ? ' (default)' : '' ?> — passing ≤ <?= e($t['passing_cutoff']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3"><label class="form-label">Schedule</label><input name="schedule" maxlength="128" value="<?= e(old('schedule')) ?>" class="form-control form-control-sm" placeholder="MWF 9–10 AM"></div>
                <div class="col-md-3"><label class="form-label">Room</label><input name="room" maxlength="64" value="<?= e(old('room')) ?>" class="form-control form-control-sm"></div>
                <div class="col-12"><label class="form-label">Description</label><textarea name="description" rows="3" maxlength="2000" class="form-control form-control-sm"><?= e(old('description')) ?></textarea></div>
            </div>
            <div class="card-footer bg-transparent d-flex gap-2">
                <button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-check2 me-1"></i>Create class</button>
                <a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/faculty/classes') ?>">Cancel</a>
            </div>
        </form>
    <?php endif; ?>
</div>
