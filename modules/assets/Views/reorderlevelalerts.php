<div class="container-fluid px-0">
    <!-- Executive Hero Command Deck -->
    <div class="card shadow-sm border-0 mb-4 bg-light p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                    <i class="bi bi-warehouse text-warning me-1"></i>Supply &amp; Property Management Unit &bull; Sta. Cruz Campus
                </div>
                <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="invSubmoduleHeading">
                    <?= e($moduleName ?? 'Supply &amp; Equipment Inventory') ?>
                </h1>
                <p class="text-muted small mb-0" id="invSubmoduleSubtext">
                    Automated threshold triggers, safety buffer calculations, emergency shortage detection, and batch Purchase Request (PR) generator.
                </p>
            </div>
            <div>
                <span class="badge bg-warning text-dark px-3 py-2 fw-bold shadow-sm" id="invSubmoduleBadge">
                    <i class="bi bi-bell-fill text-dark me-1"></i>Reorder Alerts
                </span>
            </div>
        </div>
    </div>

    <!-- Standalone module content -->
    <div id="moduleContent" data-module="alerts">
        
        <!-- Urgent Low Stock Alert Banner -->
        <div class="card shadow-sm p-4 mb-4 border-0 border-start border-5 border-danger bg-danger bg-opacity-10">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3 d-flex align-items-center justify-content-center bg-danger bg-opacity-25 text-danger" style="width: 56px; height: 56px; flex-shrink: 0;">
                        <i class="bi bi-bell-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            <span class="text-danger">Urgent Stock Depletion Warning:</span>
                            <span id="lowStockAlertCount" class="font-monospace"><?= e($lowStockCount ?? '2') ?></span> Catalog Items Below Safety Buffer Point
                        </h5>
                        <p class="small text-muted mb-0">
                            Items below have breached designated buffer thresholds. System automatically computes recommended order quantities to restore a 90-day academic reserve.
                        </p>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <button class="btn btn-warning text-dark fw-bold shadow-sm" onclick="window.prepareBatchPurchaseRequest()">
                        <i class="bi bi-cart-plus me-1"></i>Generate Consolidated Batch PR
                    </button>
                </div>
            </div>
        </div>

        <!-- Reorder Recommendations Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-boxes text-warning fs-5"></i>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        Low-Stock Replenishment &amp; Purchase Recommendations
                    </h6>
                </div>
                <button class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" onclick="window.prepareBatchPurchaseRequest()">
                    <i class="bi bi-cart-plus me-1" aria-hidden="true"></i>Prepare Batch PR
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" aria-label="Low-stock items that need replenishment">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Item Details &amp; Stock No.</th>
                                <th class="py-3">Available Stock vs Reorder Pt</th>
                                <th class="py-3">Suggested Order Deficit</th>
                                <th class="py-3">Verified PhilGEPS Supplier</th>
                                <th class="py-3">Unit Price</th>
                                <th class="py-3">Estimated Cost</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="reorderAlertsTableBody">
                            <?php if (!empty($reorderAlerts)): ?>
                                <?php foreach ($reorderAlerts as $alert): ?>
                                    <tr>
                                        <td>
                                            <div class="font-monospace fw-bold text-marsu-burgundy"><?= e($alert['stock_number']) ?></div>
                                            <div class="small text-dark fw-semibold"><?= e($alert['item_name']) ?></div>
                                        </td>
                                        <td>
                                            <div class="font-monospace text-danger fw-bold"><?= e($alert['available_stock']) ?> <span class="text-muted fw-normal">(Reorder Pt: <?= e($alert['reorder_point']) ?>)</span></div>
                                        </td>
                                        <td class="font-monospace fw-bold text-warning"><?= e($alert['order_deficit']) ?> Units</td>
                                        <td class="small text-muted"><?= e($alert['philgeps_supplier']) ?></td>
                                        <td class="font-monospace">₱<?= number_format($alert['unit_price'], 2) ?></td>
                                        <td class="font-monospace fw-bold text-danger">₱<?= number_format($alert['estimated_cost'], 2) ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-danger">Critical Low</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-warning text-dark" title="Create PR for item" onclick="alert('Creating PR for stock #<?= e($alert['stock_number']) ?>')">
                                                <i class="bi bi-cart-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle fs-2 d-block mb-1 text-success"></i>
                                        All stock levels are optimal. No active replenishment alerts or deficits detected.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- End Sub-modules Tab Content -->
</div>