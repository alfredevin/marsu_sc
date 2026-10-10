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
            <i class="bi bi-printer me-1"></i>e-Receipts
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newPaymentModal">
            <i class="bi bi-plus-lg me-1"></i>Record Payment
        </button>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

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
            <div class="text-muted small text-uppercase fw-bold">Total Collections</div>
            <div class="h3 font-weight-bold mb-0 text-success">
                ₱<?= number_format(array_sum(array_column($payments ?? [], 'amount')), 2) ?>
            </div>
            <div class="small text-muted mt-1">Verified rent & fee deposits</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Transactions</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($payments ?? []) ?> Receipts</div>
            <div class="small text-muted mt-1">Logged in payment ledger</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Average Transaction</div>
            <div class="h3 font-weight-bold mb-0 text-gold">
                ₱<?= count($payments ?? []) > 0 ? number_format(array_sum(array_column($payments, 'amount')) / count($payments), 2) : '0.00' ?>
            </div>
            <div class="small text-muted mt-1">Per official receipt</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Verification Rate</div>
            <div class="h3 font-weight-bold mb-0 text-primary">100%</div>
            <div class="small text-muted mt-1">Cashier/Dorm verified</div>
        </div>
    </div>
</div>

<!-- Payment History Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-receipt me-2 text-gold"></i>Payment Transaction Registry
        </h6>
        <div class="d-flex gap-2">
            <input type="text" id="paySearchInput" class="form-control form-control-sm" placeholder="Search receipt / student..." style="width: 250px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="payTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Receipt / OR #</th>
                        <th>Student Resident</th>
                        <th>Boarding House</th>
                        <th>Coverage Period</th>
                        <th>Payment Mode</th>
                        <th>Amount Paid</th>
                        <th>Date Paid</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($payments)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No payment records logged yet. Click "Record Payment" to log an entry!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($payments as $p): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark">
                                    <i class="bi bi-receipt-cutoff text-gold me-1"></i><?= e($p['or_number']) ?>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= e($p['student_name']) ?></div>
                                    <div class="small text-muted"><?= e($p['student_no']) ?></div>
                                </td>
                                <td><?= e($p['house_name'] ?? 'Accredited Facility') ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= e($p['period_covered']) ?></span>
                                    <small class="text-muted d-block"><?= e($p['payment_type']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border"><?= e($p['payment_method']) ?></span>
                                </td>
                                <td>
                                    <span class="fw-bold text-success fs-6">₱<?= number_format((float)$p['amount'], 2) ?></span>
                                </td>
                                <td class="small text-muted">
                                    <?= date('M d, Y', strtotime($p['payment_date'])) ?>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('housing/receiptgeneration') ?>?or=<?= urlencode($p['or_number']) ?>" class="btn btn-sm btn-outline-secondary" title="View e-Receipt">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Record Payment -->
<div class="modal fade" id="newPaymentModal" tabindex="-1" aria-labelledby="newPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newPaymentModalLabel">
                    <i class="bi bi-cash-stack me-2 text-gold"></i>Log Student Rent Payment
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/payments/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Resident Student <span class="text-danger">*</span></label>
                        <select name="tenant_id" id="tenantSelect" class="form-select form-select-sm" required onchange="handleTenantChange(this)">
                            <option value="">-- Choose Tenant --</option>
                            <?php foreach ($tenants ?? [] as $tn): ?>
                                <option value="<?= (int)$tn['id'] ?>" 
                                        data-no="<?= e($tn['student_no']) ?>" 
                                        data-name="<?= e($tn['first_name'] . ' ' . $tn['last_name']) ?>" 
                                        data-house="<?= (int)($tn['boarding_house_id'] ?? 1) ?>" 
                                        data-rent="<?= (float)$tn['monthly_rent'] ?>">
                                    <?= e($tn['first_name'] . ' ' . $tn['last_name']) ?> (<?= e($tn['student_no']) ?>) - ₱<?= number_format((float)$tn['monthly_rent'], 2) ?>/mo
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" name="student_no" id="inputStudentNo" value="">
                    <input type="hidden" name="student_name" id="inputStudentName" value="">
                    <input type="hidden" name="boarding_house_id" id="inputHouseId" value="">

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Payment Amount (₱) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="amount" id="inputAmount" class="form-control form-control-sm" required placeholder="1500.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Official Receipt / OR #</label>
                            <input type="text" name="or_number" class="form-control form-control-sm" placeholder="Auto-generated if empty">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Payment Classification</label>
                            <select name="payment_type" class="form-select form-select-sm">
                                <option value="Monthly Rent" selected>Monthly Rent</option>
                                <option value="Security Deposit">Security Deposit</option>
                                <option value="Advance Payment">Advance Payment</option>
                                <option value="Utility Fee">Utility Fee</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Payment Method</label>
                            <select name="payment_method" class="form-select form-select-sm">
                                <option value="Cash">Cash on Hand</option>
                                <option value="GCash" selected>GCash E-Wallet</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Maya">Maya</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Billing Coverage</label>
                            <input type="text" name="period_covered" class="form-control form-control-sm" value="<?= date('F Y') ?> Monthly Rent" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Date of Payment</label>
                            <input type="date" name="payment_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Reference / Transaction Remarks</label>
                        <input type="text" name="remarks" class="form-control form-control-sm" placeholder="e.g. GCash Ref# 102938475">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-check-circle me-1"></i>Post Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function handleTenantChange(select) {
    const opt = select.options[select.selectedIndex];
    if (opt && opt.value) {
        document.getElementById('inputStudentNo').value = opt.getAttribute('data-no') || '';
        document.getElementById('inputStudentName').value = opt.getAttribute('data-name') || '';
        document.getElementById('inputHouseId').value = opt.getAttribute('data-house') || '1';
        document.getElementById('inputAmount').value = opt.getAttribute('data-rent') || '1500.00';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('paySearchInput');
    const table = document.getElementById('payTable');
    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }
});
</script>
