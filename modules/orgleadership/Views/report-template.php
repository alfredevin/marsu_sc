<?php
$reportQuery = $_GET;
$reportQuery['export'] = 'csv';
$reportExportUrl = url($reportRoute . '?' . http_build_query($reportQuery));
?>
<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
        <div>
            <h1 class="h4 mb-1"><i class="bi bi-bar-chart-line-fill text-marsu-burgundy me-2"></i><?= e($title) ?></h1>
            <p class="text-muted mb-0">Live summary from organization, activity, and engagement records.</p>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="<?= e($reportExportUrl) ?>"><i class="bi bi-download me-1"></i>Download CSV</a>
            <button type="button" class="btn btn-outline-secondary" id="printReport"><i class="bi bi-printer me-1"></i>Print</button>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <?php foreach ($reportMetrics as $metric): ?>
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100"><div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-circle bg-light text-marsu-burgundy d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px"><i class="bi <?= e($metric['icon']) ?> fs-5"></i></span>
                    <div><div class="small text-muted"><?= e($metric['label']) ?></div><div class="h4 mb-0"><?= e(number_format((float)$metric['value'])) ?></div></div>
                </div></div>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="get" action="<?= e(url($reportRoute)) ?>" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <?php if ($showOrganizationFilter): ?>
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label" for="report-organization">Organization</label>
                    <select class="form-select" id="report-organization" name="organization_id">
                        <option value="0">All organizations</option>
                        <?php foreach ($organizations as $organization): ?>
                            <option value="<?= (int)$organization['id'] ?>" <?= (int)$organizationFilter === (int)$organization['id'] ? 'selected' : '' ?>><?= e($organization['name']) ?> (<?= e($organization['acronym']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <?php if ($showDateFilters): ?>
                <div class="col-sm-6 col-lg-3"><label class="form-label" for="report-from">From</label><input class="form-control" type="date" id="report-from" name="from" value="<?= e($fromFilter) ?>"></div>
                <div class="col-sm-6 col-lg-3"><label class="form-label" for="report-to">To</label><input class="form-control" type="date" id="report-to" name="to" value="<?= e($toFilter) ?>"></div>
            <?php endif; ?>
            <div class="col-auto"><button class="btn btn-outline-secondary" type="submit"><i class="bi bi-funnel me-1"></i>Apply filters</button></div>
            <div class="col-auto"><a class="btn btn-link" href="<?= e(url($reportRoute)) ?>">Clear</a></div>
        </div>
    </form>

    <div class="card border-0 shadow-sm" id="reportTable">
        <div class="card-header bg-body d-flex justify-content-between align-items-center"><h2 class="h6 mb-0">Report details</h2><span class="small text-muted"><?= count($reportRows) ?> record<?= count($reportRows) === 1 ? '' : 's' ?></span></div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><?php foreach ($reportColumns as $label): ?><th><?= e($label) ?></th><?php endforeach; ?></tr></thead>
                <tbody>
                <?php if (!$reportRows): ?>
                    <tr><td colspan="<?= max(1, count($reportColumns)) ?>" class="text-center text-muted py-5"><i class="bi bi-clipboard2-data d-block fs-3 mb-2"></i>No report data matches these filters.</td></tr>
                <?php endif; ?>
                <?php foreach ($reportRows as $row): ?>
                    <tr><?php foreach ($reportColumns as $key => $_label): ?><td><?= e((string)($row[$key] ?? '—')) ?></td><?php endforeach; ?></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
document.getElementById('printReport')?.addEventListener('click', function () {
    window.print();
});
</script>
