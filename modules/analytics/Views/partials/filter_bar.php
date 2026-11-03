<?php
/**
 * Shared GET filter bar: term + program (+ optional extra fields).
 * Expects $terms, $programs, $term, $programId; optional $filterExtra (trusted HTML built with e()),
 * $hideTerm (bool), $exportUrl (string).
 */
$selectedTerm = $term['semester_id'] ?? null;
?>
<form method="GET" class="card border-0 shadow-sm mb-3">
    <div class="card-body py-2 row g-2 align-items-end">
        <?php if (empty($hideTerm)): ?>
            <div class="col-12 col-sm-6 col-lg-3">
                <label class="form-label small text-secondary mb-1">Term</label>
                <select name="term" class="form-select form-select-sm">
                    <?php foreach ($terms as $t): ?>
                        <option value="<?= (int) $t['semester_id'] ?>" <?= (int) $t['semester_id'] === (int) $selectedTerm ? 'selected' : '' ?>><?= e($t['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <?php if (count($programs) > 1): ?>
            <div class="col-12 col-sm-6 col-lg-3">
                <label class="form-label small text-secondary mb-1">Program</label>
                <select name="program" class="form-select form-select-sm">
                    <option value="">All programs in scope</option>
                    <?php foreach ($programs as $p): ?>
                        <option value="<?= (int) $p['id'] ?>" <?= (int) ($programId ?? 0) === (int) $p['id'] ? 'selected' : '' ?>><?= e($p['code']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <?= $filterExtra ?? '' ?>
        <div class="col-auto">
            <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-funnel me-1"></i>Apply</button>
        </div>
        <?php if (!empty($exportUrl) && can('analytics.export')): ?>
            <div class="col-auto ms-auto">
                <a href="<?= e($exportUrl) ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i>Export CSV</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-footer bg-transparent border-0 pt-0 small text-secondary">
        <i class="bi bi-funnel me-1"></i>Scope: <?= e($scopeNote) ?>
        <?php if (!$term && empty($hideTerm)): ?>
            <span class="text-danger ms-2"><i class="bi bi-exclamation-circle"></i> No active term is set in the Academic Calendar.</span>
        <?php endif; ?>
    </div>
</form>
