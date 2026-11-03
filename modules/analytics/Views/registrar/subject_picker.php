<?php
/**
 * Subject multi-select grouped by program. Expects $subjects; optional $checked (int[]), $pickerId.
 */
$checked = $checked ?? [];
$pickerId = $pickerId ?? 'subj';
$groups = [];
foreach ($subjects as $s) {
    $groups[$s['program_code'] ?? 'General'][] = $s;
}
ksort($groups);
?>
<input type="search" class="form-control form-control-sm mb-1 subject-filter" data-target="<?= e($pickerId) ?>" placeholder="Filter subjects by code or title" aria-label="Filter subjects">
<div class="border rounded p-2" id="<?= e($pickerId) ?>" style="max-height:260px;overflow:auto">
    <?php foreach ($groups as $prog => $list): ?>
        <div class="fw-semibold text-secondary small mt-1 subject-group"><?= e($prog) ?></div>
        <?php foreach ($list as $s): $cid = $pickerId . '_' . (int) $s['id']; ?>
            <div class="form-check subject-option" data-text="<?= e(strtolower($s['code'] . ' ' . $s['title'])) ?>">
                <input class="form-check-input" type="checkbox" name="subjects[]" value="<?= (int) $s['id'] ?>" id="<?= e($cid) ?>" <?= in_array((int) $s['id'], $checked, true) ? 'checked' : '' ?>>
                <label class="form-check-label small" for="<?= e($cid) ?>"><?= e($s['code']) ?> — <?= e($s['title']) ?> <span class="text-secondary">(<?= e((string) $s['units']) ?> u)</span></label>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
