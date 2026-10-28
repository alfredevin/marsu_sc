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
                    Complete immutable ledger of all receipts, issuances, balance adjustments, COA audit trails, and stock reconciliations.
                </p>
            </div>
            <div>
                <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm" id="invSubmoduleBadge">
                    <i class="bi bi-award-fill text-dark me-1"></i>Audit Ledger
                </span>
            </div>
        </div>
    </div>

    <!-- Standalone module content -->
    <div id="moduleContent" data-module="history">
        
        <!-- History Search Toolbar -->
        <div class="card shadow-sm p-3 mb-4 border-0">
            <div class="row align-items-center g-2">
                <div class="col-lg-5 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-warning"></i></span>
                        <input type="search" id="historySearchInput" class="form-control border-start-0 ps-0" placeholder="Search reference doc no, stock no, item..." aria-label="Search inventory history">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <select id="historyFilterType" class="form-select">
                        <option value="ALL">All Transaction Types</option>
                        <option value="RECEIPT">Stock Delivery Receipts (IN)</option>
                        <option value="ISSUANCE">RIS Requisition Dispatches (OUT)</option>
                        <option value="AUDIT">Physical Inventory Audits</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-12 text-lg-end">
                    <button class="btn btn-outline-success btn-sm w-100 fw-bold" onclick="window.exportHistoryCSV()">
                        <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i>Export Audit Ledger
                    </button>
                </div>
            </div>
        </div>

        <!-- History Ledger Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock-history text-warning fs-5"></i>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        Electronic Stock Card Audit Trail (GAM Appendix 58)
                    </h6>
                </div>
                <span class="badge bg-warning text-dark font-monospace" style="font-size: 0.7rem;">COA Circular 2020-006 Audited</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Date &amp; Time</th>
                                <th class="py-3">Stock No. &amp; Item</th>
                                <th class="py-3">Reference Doc No.</th>
                                <th class="py-3">Transaction Type</th>
                                <th class="py-3">Qty Received (IN)</th>
                                <th class="py-3">Qty Issued (OUT)</th>
                                <th class="py-3">Ending Balance</th>
                                <th class="py-3">Unit Price</th>
                                <th class="py-3">Encoding Custodian</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryHistoryTableBody">
                            <?php if (!empty($inventoryHistory)): ?>
                                <?php foreach ($inventoryHistory as $hist): ?>
                                    <tr>
                                        <td class="small text-muted"><?= e(date('M d, Y h:i A', strtotime($hist['created_at']))) ?></td>
                                        <td>
                                            <div class="font-monospace fw-bold text-marsu-burgundy"><?= e($hist['stock_number']) ?></div>
                                            <div class="small text-dark fw-semibold"><?= e($hist['item_name']) ?></div>
                                        </td>
                                        <td class="font-monospace"><?= e($hist['ref_doc_no']) ?></td>
                                        <td>
                                            <?php if (($hist['transaction_type'] ?? '') === 'RECEIPT'): ?>
                                                <span class="badge bg-success">Delivery (IN)</span>
                                            <?php elseif (($hist['transaction_type'] ?? '') === 'ISSUANCE'): ?>
                                                <span class="badge bg-warning text-dark">RIS Issue (OUT)</span>
                                            <?php else: ?>
                                                <span class="badge bg-info text-dark"><?= e($hist['transaction_type']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="font-monospace text-success fw-bold"><?= e($hist['qty_in'] > 0 ? '+' . $hist['qty_in'] : '-') ?></td>
                                        <td class="font-monospace text-danger fw-bold"><?= e($hist['qty_out'] > 0 ? '-' . $hist['qty_out'] : '-') ?></td>
                                        <td class="font-monospace fw-bold text-dark"><?= e($hist['ending_balance']) ?></td>
                                        <td class="font-monospace">₱<?= number_format($hist['unit_price'], 2) ?></td>
                                        <td class="small text-muted"><?= e($hist['custodian_name']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No audit trail records found. Transactions will automatically register here.
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