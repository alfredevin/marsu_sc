<!-- Delivery Tracker — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-truck me-2 text-gold"></i>Delivery Tracker
        </h1>
        <p class="text-muted small mb-0">Monitor delivery status of all issued purchase orders in real time.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Delivery Status Summary -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-hourglass-split fs-2 text-warning mb-2"></i>
            <div class="h3 fw-bold text-warning mb-0">0</div>
            <div class="small text-muted">Awaiting Delivery</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-truck fs-2 text-primary mb-2"></i>
            <div class="h3 fw-bold text-primary mb-0">0</div>
            <div class="small text-muted">In Transit</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-box-seam fs-2 text-success mb-2"></i>
            <div class="h3 fw-bold text-success mb-0">0</div>
            <div class="small text-muted">Delivered</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-exclamation-triangle fs-2 text-danger mb-2"></i>
            <div class="h3 fw-bold text-danger mb-0">0</div>
            <div class="small text-muted">Overdue</div>
        </div>
    </div>
</div>

<!-- Delivery Tracking Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-truck me-2 text-gold"></i>Delivery Records
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm w-auto">
                <option value="">All Statuses</option>
                <option>Awaiting Delivery</option>
                <option>In Transit</option>
                <option>Delivered</option>
                <option>Overdue</option>
            </select>
            <input type="text" class="form-control form-control-sm" placeholder="Search PO number..." style="width:180px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PO No.</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>PO Date</th>
                        <th>Expected Delivery</th>
                        <th>Actual Delivery</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Update</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-truck fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No delivery records found. Deliveries will appear here once POs are issued.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
