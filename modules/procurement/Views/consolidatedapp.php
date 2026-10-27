<!-- Consolidated APP — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-layers me-2 text-gold"></i>Consolidated Annual Procurement Plan (APP)
        </h1>
        <p class="text-muted small mb-0">Consolidated view of all procurement plans across offices and departments for the fiscal year.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Summary KPIs -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Budget (APP)</div>
                    <div class="h3 fw-bold mb-0 text-marsu-burgundy">&#8369;0.00</div>
                </div>
                <div class="p-3 bg-burgundy-subtle text-marsu-burgundy rounded-circle">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Items</div>
                    <div class="h3 fw-bold mb-0 text-primary">0</div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-list-ul fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Offices Covered</div>
                    <div class="h3 fw-bold mb-0 text-gold">0</div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-building fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- APP Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-layers me-2 text-gold"></i>Consolidated APP Entries
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm w-auto">
                <option value="">Fiscal Year</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
            </select>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-download me-1"></i>Export
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Office / Dept</th>
                        <th>Item / Description</th>
                        <th>Quantity</th>
                        <th>Unit Cost (&#8369;)</th>
                        <th>Total (&#8369;)</th>
                        <th>Quarter</th>
                        <th>Mode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-layers fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No consolidated APP entries yet. Entries are consolidated from submitted PPMPs.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
