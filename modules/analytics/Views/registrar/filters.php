<?php
/**
 * Registrar GET filters. Expects $terms, $programs, $sections, $subjects, $term; optional $showStatus, $showSubject, $exportType.
 */
$g = fn(string $k) => (string) ($_GET[$k] ?? '');
?>
<form method="GET" class="card border-0 shadow-sm mb-3">
    <div class="card-body py-2 row g-2 align-items-end small">
        <div class="col-12 col-sm-6 col-lg-3"><label class="form-label mb-1 text-secondary">Term</label>
            <select name="term" class="form-select form-select-sm">
                <?php foreach ($terms as $t): ?><option value="<?= (int) $t['semester_id'] ?>" <?= (int) $t['semester_id'] === (int) ($term['semester_id'] ?? 0) ? 'selected' : '' ?>><?= e($t['label']) ?></option><?php endforeach; ?>
            </select></div>
        <?php if (!empty($showFilters)): ?>
            <div class="col-6 col-lg-2"><label class="form-label mb-1 text-secondary">Program</label>
                <select name="program" class="form-select form-select-sm"><option value="">All</option>
                    <?php foreach ($programs as $p): ?><option value="<?= (int) $p['id'] ?>" <?= $g('program') === (string) $p['id'] ? 'selected' : '' ?>><?= e($p['code']) ?></option><?php endforeach; ?>
                </select></div>
            <div class="col-6 col-lg-2"><label class="form-label mb-1 text-secondary">Section</label>
                <select name="section" class="form-select form-select-sm"><option value="">All</option>
                    <?php foreach ($sections as $s): ?><option value="<?= (int) $s['id'] ?>" <?= $g('section') === (string) $s['id'] ? 'selected' : '' ?>><?= e($s['name']) ?></option><?php endforeach; ?>
                </select></div>
            <div class="col-6 col-lg-2"><label class="form-label mb-1 text-secondary">Subject</label>
                <select name="subject" class="form-select form-select-sm"><option value="">All</option>
                    <?php foreach ($subjects as $s): ?><option value="<?= (int) $s['id'] ?>" <?= $g('subject') === (string) $s['id'] ? 'selected' : '' ?>><?= e($s['code']) ?></option><?php endforeach; ?>
                </select></div>
            <?php if (!empty($showStatus)): ?>
                <div class="col-6 col-lg-1"><label class="form-label mb-1 text-secondary">Status</label>
                    <select name="status" class="form-select form-select-sm"><option value="">All</option>
                        <?php foreach (['pending', 'enrolled', 'withdrawn', 'cancelled'] as $s): ?><option value="<?= $s ?>" <?= $g('status') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option><?php endforeach; ?>
                    </select></div>
            <?php endif; ?>
            <div class="col-12 col-lg-2"><label class="form-label mb-1 text-secondary">Search</label><input type="search" name="q" value="<?= e($g('q')) ?>" class="form-control form-control-sm" placeholder="Number or name"></div>
        <?php endif; ?>
        <div class="col-auto"><button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-funnel me-1"></i>Apply</button></div>
        <?php if (!empty($exportType)): ?>
            <div class="col-auto ms-auto"><a class="btn btn-sm btn-outline-secondary" href="<?= url('analytics/registrar/export/' . $exportType, $filters ?? \Modules\Analytics\Support\Ui::queryParams(['term'])) ?>"><i class="bi bi-download me-1"></i>Export CSV</a></div>
        <?php endif; ?>
    </div>
    <?php if (!$term): ?><div class="card-footer bg-transparent border-0 pt-0 small text-danger">No active term is set in the Academic Calendar.</div><?php endif; ?>
</form>
