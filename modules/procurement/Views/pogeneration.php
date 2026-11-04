<!-- PO Generation — Procurement Management Information System (SPMS Purchase Orders) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bag-check me-2 text-gold"></i>Purchase Order (PO Generation)
        </h1>
        <p class="text-muted small mb-0">Award contracts, dispatch formal Purchase Orders to accredited suppliers, and monitor procurement terms.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewPO">
            <i class="bi bi-plus-circle me-1"></i>Generate PO
        </button>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- PO Status Overview KPIs -->
<?php
$cntTotal = count($orders ?? []);
$cntPending = 0;
$cntInspection = 0;
$cntCompleted = 0;
foreach ($orders ?? [] as $o) {
    if ($o['status'] === 'Pending Delivery')       $cntPending++;
    if ($o['status'] === 'Ready for Inspection')  $cntInspection++;
    if ($o['status'] === 'Completed')             $cntCompleted++;
}
?>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total POs Issued</div>
                    <div class="h3 fw-bold mb-0 text-dark"><?= $cntTotal ?></div>
                </div>
                <div class="p-3 bg-secondary-subtle text-secondary rounded-circle">
                    <i class="bi bi-receipt-cutoff fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending Delivery</div>
                    <div class="h3 fw-bold mb-0 text-warning"><?= $cntPending ?></div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-truck fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">For Inspection</div>
                    <div class="h3 fw-bold mb-0 text-info"><?= $cntInspection ?></div>
                </div>
                <div class="p-3 bg-info-subtle text-info rounded-circle">
                    <i class="bi bi-clipboard2-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Completed Orders</div>
                    <div class="h3 fw-bold mb-0 text-success"><?= $cntCompleted ?></div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-box-seam fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PO Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-receipt me-2 text-gold"></i>Purchase Orders & Awarded Contracts
        </h5>
        <span class="badge bg-light text-dark border">SPMS Order Tracking</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PO Number</th>
                        <th>Awarded Supplier</th>
                        <th>PO Date</th>
                        <th>Procurement Mode</th>
                        <th class="text-end">Contract Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $po): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($po['po_number']) ?></td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e($po['company_name'] ?? 'Accredited Supplier') ?></div>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i><?= e($po['contact_phone'] ?? '—') ?></small>
                                </td>
                                <td><?= date("M d, Y", strtotime($po['po_date'])) ?></td>
                                <td><span class="badge bg-light text-dark border"><?= e($po['mode_of_procurement']) ?></span></td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$po['total_amount'], 2) ?></td>
                                <td class="text-center">
                                    <?php
                                    $st = $po['status'];
                                    $badge = 'bg-secondary';
                                    if ($st === 'Completed')              $badge = 'bg-success';
                                    if ($st === 'Pending Delivery')        $badge = 'bg-warning text-dark';
                                    if ($st === 'Ready for Inspection')   $badge = 'bg-info text-dark';
                                    if ($st === 'Partially Completed')    $badge = 'bg-primary';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= e($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-outline-danger" onclick="window.print();" title="Print Purchase Order">
                                        <i class="bi bi-printer me-1"></i>Print PO
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">No Purchase Orders found. Click <strong>Generate PO</strong> to award a supplier.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New PO -->
<div class="modal fade" id="modalNewPO" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy">
                    <i class="bi bi-bag-plus me-2 text-gold"></i>Generate New Purchase Order (PO)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/po-generation/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">PO Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="po_number" value="PO-<?= date('Y-m') ?>-<?= str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Awarded Supplier <span class="text-danger">*</span></label>
                            <select class="form-select" name="supplier_id" required>
                                <option value="">— Select Accredited Supplier —</option>
                                <?php foreach ($suppliers ?? [] as $s): ?>
                                    <option value="<?= (int)$s['id'] ?>"><?= e($s['company_name']) ?> (<?= e($s['classification']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Contract Amount (&#8369;) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="1" class="form-control" name="total_amount" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mode of Procurement</label>
                            <select class="form-select" name="mode_of_procurement">
                                <option value="Small Value Procurement (Sec. 53.9)">Small Value Procurement (Sec. 53.9)</option>
                                <option value="Public Bidding">Competitive Public Bidding</option>
                                <option value="Direct Contracting (Sec. 50)">Direct Contracting (Sec. 50)</option>
                                <option value="Shopping (Sec. 52)">Shopping (Sec. 52)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Delivery Term</label>
                            <input type="text" class="form-control" name="delivery_term" value="15 Calendar Days upon receipt of Notice to Proceed">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Payment Term</label>
                            <input type="text" class="form-control" value="Government Terms (LDDAP-ADA / Check upon Acceptance)" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-send me-1"></i>Issue Purchase Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
