<!-- Requisition Status — Procurement Management Information System (SPMS Document Tracking) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-activity me-2 text-gold"></i>Requisition &amp; APP Document Lifecycle Tracking
        </h1>
        <p class="text-muted small mb-0">Monitor the end-to-end lifecycle of procurement documents from PPMP creation to delivery and inventory turnover.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Status Summary Cards -->
<?php
$cntSubmitted = 0;
$cntCanvassing = 0;
$cntApproved = 0;
$cntPoIssued = 0;
$cntCompleted = 0;
$cntRejected = 0;

foreach ($prs ?? [] as $pr) {
    $st = $pr['status'];
    if ($st === 'Submitted')  $cntSubmitted++;
    if ($st === 'Canvassing') $cntCanvassing++;
    if ($st === 'Approved')   $cntApproved++;
    if ($st === 'PO Issued')  $cntPoIssued++;
    if ($st === 'Completed')  $cntCompleted++;
    if ($st === 'Rejected')   $cntRejected++;
}
?>
<div class="row g-3 mb-4">
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white">
            <i class="bi bi-send fs-3 text-primary mb-2"></i>
            <div class="h4 fw-bold mb-0 text-primary"><?= $cntSubmitted ?></div>
            <div class="small text-muted">Submitted</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white">
            <i class="bi bi-search fs-3 text-info mb-2"></i>
            <div class="h4 fw-bold mb-0 text-info"><?= $cntCanvassing ?></div>
            <div class="small text-muted">Canvassing / RFQ</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white">
            <i class="bi bi-check-circle-fill fs-3 text-success mb-2"></i>
            <div class="h4 fw-bold mb-0 text-success"><?= $cntApproved ?></div>
            <div class="small text-muted">Approved</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white">
            <i class="bi bi-bag-check-fill fs-3 text-warning mb-2"></i>
            <div class="h4 fw-bold mb-0 text-warning"><?= $cntPoIssued ?></div>
            <div class="small text-muted">PO Issued</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white">
            <i class="bi bi-box-seam fs-3 text-success mb-2"></i>
            <div class="h4 fw-bold mb-0 text-success"><?= $cntCompleted ?></div>
            <div class="small text-muted">Completed</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white">
            <i class="bi bi-x-circle-fill fs-3 text-danger mb-2"></i>
            <div class="h4 fw-bold mb-0 text-danger"><?= $cntRejected ?></div>
            <div class="small text-muted">Rejected</div>
        </div>
    </div>
</div>

<!-- Tracking Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-signpost-split me-2 text-gold"></i>Procurement Document Tracking Stepper
        </h5>
        <span class="badge bg-light text-dark border">Live Stepper Progress</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Document Reference</th>
                        <th>Office / College</th>
                        <th>Requisitioner</th>
                        <th>Est. Amount</th>
                        <th style="min-width: 280px;">Lifecycle Stage</th>
                        <th class="text-center">Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($prs)): ?>
                        <?php foreach ($prs as $pr): ?>
                            <?php
                            $st = $pr['status'];
                            $step = 1;
                            if ($st === 'Submitted')   $step = 1;
                            if ($st === 'Canvassing')  $step = 2;
                            if ($st === 'Approved')    $step = 3;
                            if ($st === 'PO Issued')   $step = 4;
                            if ($st === 'Completed')   $step = 5;
                            $pct = ($step / 5) * 100;
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($pr['pr_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($pr['requesting_office']) ?></td>
                                <td><?= e($pr['requested_by']) ?></td>
                                <td class="fw-bold text-dark">&#8369;<?= number_format((float)$pr['estimated_total'], 2) ?></td>
                                <td>
                                    <div class="d-flex justify-content-between small text-muted mb-1">
                                        <span>PR Filed</span>
                                        <span>Canvass</span>
                                        <span>Approved</span>
                                        <span>PO</span>
                                        <span>Delivered</span>
                                    </div>
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar <?= $st === 'Rejected' ? 'bg-danger' : 'bg-success' ?>" style="width: <?= $pct ?>%"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $st === 'Rejected' ? 'bg-danger' : ($st === 'Completed' ? 'bg-success' : 'bg-primary') ?>">
                                        <?= e($st) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($ppmps)): ?>
                        <?php foreach ($ppmps as $p): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($p['ppmp_code']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($p['department_name']) ?></td>
                                <td><?= e($p['requested_by']) ?></td>
                                <td class="fw-bold text-dark">&#8369;<?= number_format((float)$p['grand_total'], 2) ?></td>
                                <td>
                                    <div class="d-flex justify-content-between small text-muted mb-1">
                                        <span>PPMP Draft</span>
                                        <span>Endorsed</span>
                                        <span>APP Consolidated</span>
                                        <span>Ready RFQ</span>
                                    </div>
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-info" style="width: <?= $p['status'] === 'Ready for RFQ' ? 100 : ($p['status'] === 'Approved' ? 75 : 40) ?>%"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= e($p['status']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (empty($prs) && empty($ppmps)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">No documents currently tracked.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
