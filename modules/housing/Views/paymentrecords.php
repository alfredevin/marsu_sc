<!-- Payment Records View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-wallet2 me-2 text-gold"></i>Student Payment Records & Transactions
        </h1>
        <p class="text-muted small mb-0">Registry of monthly rent collections, security deposit payments, and official receipt transactions.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/receiptgeneration') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-printer me-1"></i>Issue Receipt
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newPaymentModal">
            <i class="bi bi-plus-lg me-1"></i>Record Payment
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/boardingfees') ?>">
                <i class="bi bi-cash-coin me-1"></i>Fee Schedule
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/paymentrecords') ?>">
                <i class="bi bi-wallet2 me-1 text-gold"></i>Payment Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/balancemonitoring') ?>">
                <i class="bi bi-exclamation-diamond me-1"></i>Balance Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/receiptgeneration') ?>">
                <i class="bi bi-printer me-1"></i>Receipt Generation
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-success p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Current Month Collections</div>
            <div class="h3 font-weight-bold mb-0 text-success">₱92,400.00</div>
            <div class="small text-muted mt-1">October 2026 rent collected</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Transactions</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">58 Receipts</div>
            <div class="small text-muted mt-1">Logged this month</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Unsettled Dues</div>
            <div class="h3 font-weight-bold mb-0 text-warning">₱14,800.00</div>
            <div class="small text-muted mt-1">Across 8 delayed accounts</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Collection Efficiency</div>
            <div class="h3 font-weight-bold mb-0 text-primary">86.2%</div>
            <div class="small text-muted mt-1">On-time payment compliance</div>
        </div>
    </div>
</div>

<!-- Payment History Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-receipt me-2 text-gold"></i>Payment Transaction Registry
        </h6>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Search receipt / student..." style="width: 220px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Receipt / OR #</th>
                        <th>Student Resident</th>
                        <th>Boarding House</th>
                        <th>Coverage Period</th>
                        <th>Payment Mode</th>
                        <th>Amount Paid</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">OR-2026-1001</td>
                        <td>
                            <div class="fw-bold">Maria Santos</div>
                            <div class="small text-muted">22-0145 • Rm 102</div>
                        </td>
                        <td>Villa Marinduque Dorm</td>
                        <td>October 2026 Monthly Rent</td>
                        <td><span class="badge bg-info-subtle text-info border">GCash E-Wallet</span></td>
                        <td><span class="fw-bold text-success fs-6">₱1,500.00</span></td>
                        <td class="text-end pe-3">
                            <a href="<?= url('housing/receiptgeneration') ?>?id=1001" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">OR-2026-1002</td>
                        <td>
                            <div class="fw-bold">John Rey Reyes</div>
                            <div class="small text-muted">23-0891 • Rm 204</div>
                        </td>
                        <td>Greenview Boarding House</td>
                        <td>October 2026 Rent + Electricity</td>
                        <td><span class="badge bg-success-subtle text-success border">Cash on Hand</span></td>
                        <td><span class="fw-bold text-success fs-6">₱2,100.00</span></td>
                        <td class="text-end pe-3">
                            <a href="<?= url('housing/receiptgeneration') ?>?id=1002" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">OR-2026-1003</td>
                        <td>
                            <div class="fw-bold">Mark Joseph Alcantara</div>
                            <div class="small text-muted">24-1102 • Rm 204</div>
                        </td>
                        <td>Greenview Boarding House</td>
                        <td>October 2026 Rent</td>
                        <td><span class="badge bg-info-subtle text-info border">Bank Transfer (Landbank)</span></td>
                        <td><span class="fw-bold text-success fs-6">₱1,800.00</span></td>
                        <td class="text-end pe-3">
                            <a href="<?= url('housing/receiptgeneration') ?>?id=1003" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Record Payment -->
<div class="modal fade" id="newPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Log Student Rent Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Resident Student</label>
                        <select class="form-select" required>
                            <option>Maria Santos (Villa Marinduque - ₱1,500/mo)</option>
                            <option>John Rey Reyes (Greenview - ₱1,800/mo)</option>
                            <option>Mark Joseph Alcantara (Greenview - ₱1,800/mo)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Amount (₱)</label>
                        <input type="number" step="0.01" class="form-control" placeholder="1500.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Method</label>
                        <select class="form-select">
                            <option value="cash">Cash on Hand</option>
                            <option value="gcash">GCash E-Wallet</option>
                            <option value="bank">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Billing Coverage</label>
                        <input type="text" class="form-control" value="October 2026 Monthly Rent" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Post Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
