<!-- PO Generation — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bag-check me-2 text-gold"></i>PO Generation
        </h1>
        <p class="text-muted small mb-0">Generate and manage Purchase Orders from approved purchase requests.</p>
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

<!-- PO Status Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total POs</div>
                    <div class="h3 fw-bold mb-0 text-marsu-burgundy">0</div>
                </div>
                <div class="p-3 bg-burgundy-subtle text-marsu-burgundy rounded-circle">
                    <i class="bi bi-bag-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending Delivery</div>
                    <div class="h3 fw-bold mb-0 text-warning">0</div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-truck fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Delivered</div>
                    <div class="h3 fw-bold mb-0 text-success">0</div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-box-seam fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Amount</div>
                    <div class="h3 fw-bold mb-0 text-primary">&#8369;0</div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PO Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Purchase Orders
        </h5>
        <input type="text" class="form-control form-control-sm w-auto" placeholder="Search PO number...">
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PO No.</th>
                        <th>Linked PR</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>Total Amount (&#8369;)</th>
                        <th>Date Issued</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-bag-check fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No purchase orders yet. Click <strong>Generate PO</strong> to create one from an approved PR.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Generate PO -->
<div class="modal fade" id="modalNewPO" tabindex="-1" aria-labelledby="modalNewPOLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewPOLabel">
                    <i class="bi bi-bag-check me-2 text-gold"></i>Generate Purchase Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/po-generation/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="poNumber" class="form-label fw-semibold">PO Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="poNumber" name="po_number" placeholder="e.g. PO-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="poLinkedPR" class="form-label fw-semibold">Linked PR Number</label>
                            <input type="text" class="form-control" id="poLinkedPR" name="linked_pr" placeholder="e.g. PR-2026-001">
                        </div>
                        <div class="col-md-6">
                            <label for="poSupplier" class="form-label fw-semibold">Supplier / Contractor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="poSupplier" name="supplier" placeholder="Supplier name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="poDeliveryDate" class="form-label fw-semibold">Expected Delivery Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="poDeliveryDate" name="delivery_date" required>
                        </div>
                        <div class="col-12">
                            <label for="poItems" class="form-label fw-semibold">Items / Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="poItems" name="items_description" rows="3" placeholder="List the items to be delivered..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="poTotalAmount" class="form-label fw-semibold">Total Amount (&#8369;) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control" id="poTotalAmount" name="total_amount" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label for="poPaymentTerms" class="form-label fw-semibold">Payment Terms</label>
                            <select class="form-select" id="poPaymentTerms" name="payment_terms">
                                <option value="30 days">30 days after delivery</option>
                                <option value="COD">Cash on Delivery</option>
                                <option value="Advance">Full Advance Payment</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Generate PO</button>
                </div>
            </form>
        </div>
    </div>
</div>
