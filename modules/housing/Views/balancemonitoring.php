<!-- Balance Monitoring View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-exclamation-diamond-fill me-2 text-gold"></i>Student Account Balance & Arrears Monitoring
        </h1>
        <p class="text-muted small mb-0">Track outstanding rental balances, overdue accounts, utility surcharges, and send payment demand notifications.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/paymentrecords') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-wallet2 me-1"></i>Payments
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" onclick="alert('Notification sent to 6 overdue residents via SMS/Email!')">
            <i class="bi bi-bell-fill me-1"></i>Send Due Reminders
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
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/paymentrecords') ?>">
                <i class="bi bi-wallet2 me-1"></i>Payment Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/balancemonitoring') ?>">
                <i class="bi bi-exclamation-diamond me-1 text-gold"></i>Balance Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/receiptgeneration') ?>">
                <i class="bi bi-printer me-1"></i>Receipt Generation
            </a>
        </li>
    </ul>
</div>

<!-- Balance Aging Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">1 — 15 Days Overdue</div>
            <div class="h3 font-weight-bold mb-0 text-warning">₱6,000.00</div>
            <div class="small text-muted mt-1">4 residents (Grace period)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-danger p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">16 — 30 Days Overdue</div>
            <div class="h3 font-weight-bold mb-0 text-danger">₱5,400.00</div>
            <div class="small text-muted mt-1">2 residents (First warning)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">> 30 Days Critical</div>
            <div class="h3 font-weight-bold mb-0 text-dark">₱3,400.00</div>
            <div class="small text-muted mt-1">1 resident (Refer to OSAS)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Fully Settled</div>
            <div class="h3 font-weight-bold mb-0 text-success">56 Students</div>
            <div class="small text-muted mt-1">Zero balance accounts</div>
        </div>
    </div>
</div>

<!-- Arrears Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-clock-history me-2 text-gold"></i>Students with Outstanding Balances
        </h6>
        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-earmark-spreadsheet me-1"></i>Export Arrears</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Student Resident</th>
                        <th>Boarding House & Room</th>
                        <th>Monthly Rate</th>
                        <th>Unsettled Balance</th>
                        <th>Days Overdue</th>
                        <th>Follow-up Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Angelica Ramos</div>
                            <div class="small text-muted">ID: 21-0322 • BSCE 4A</div>
                        </td>
                        <td>Sunrise Ladies Dorm • Rm 105</td>
                        <td>₱2,000.00</td>
                        <td><span class="fw-bold text-danger fs-6">₱2,000.00</span></td>
                        <td><span class="badge bg-warning text-dark">12 Days</span></td>
                        <td><span class="badge bg-warning-subtle text-warning border">SMS Reminder Sent</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-primary" title="Post Payment"><i class="bi bi-credit-card"></i> Pay</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Rodel Macatangay</div>
                            <div class="small text-muted">ID: 23-0112 • BSIT 2C</div>
                        </td>
                        <td>Greenview House • Rm 202</td>
                        <td>₱1,800.00</td>
                        <td><span class="fw-bold text-danger fs-6">₱3,600.00</span></td>
                        <td><span class="badge bg-danger">34 Days</span></td>
                        <td><span class="badge bg-danger-subtle text-danger border">Parent Contacted</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-primary" title="Post Payment"><i class="bi bi-credit-card"></i> Pay</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
