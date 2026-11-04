<!-- Fund Source Verification — Procurement Management Information System (SPMS Fund Allocation) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bank me-2 text-gold"></i>Fund Source Verification & College Allocations
        </h1>
        <p class="text-muted small mb-0">Verify allocated funds per department, track budget utilization in PPMPs, and adjust annual college ceilings.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalAllocateFund">
            <i class="bi bi-plus-circle me-1"></i>Allocate College Fund
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

<!-- Summary Totals -->
<?php
$totalAllocated = 0.00;
$totalCommitted = 0.00;
foreach ($funds ?? [] as $f) {
    $totalAllocated += (float)$f['amount'];
    $totalCommitted += (float)($f['committed_amount'] ?? 0);
}
$remainingTotal = $totalAllocated - $totalCommitted;
$overallUtil = $totalAllocated > 0 ? round(($totalCommitted / $totalAllocated) * 100, 1) : 0;
?>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="fw-bold text-muted small text-uppercase mb-2">Total University Allocated Funds</div>
            <div class="h4 fw-bold text-primary mb-1">&#8369;<?= number_format($totalAllocated, 2) ?></div>
            <div class="small text-muted">All active colleges & departments</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="fw-bold text-muted small text-uppercase mb-2">Total PPMP Committed Budget</div>
            <div class="h4 fw-bold text-warning mb-1">&#8369;<?= number_format($totalCommitted, 2) ?></div>
            <div class="progress mt-2" style="height:6px;">
                <div class="progress-bar bg-warning" style="width: <?= min(100, $overallUtil) ?>%"></div>
            </div>
            <div class="small text-muted mt-1"><?= $overallUtil ?>% committed in approved plans</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="fw-bold text-muted small text-uppercase mb-2">Available Budget Balance</div>
            <div class="h4 fw-bold text-success mb-1">&#8369;<?= number_format($remainingTotal, 2) ?></div>
            <div class="small text-muted">Remaining uncommitted appropriation</div>
        </div>
    </div>
</div>

<!-- Fund Allocation Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-shield-check me-2 text-gold"></i>College & Department Fund Verification Ledger
        </h5>
        <span class="badge bg-light text-dark border">FY 2026 Appropriation</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">College / Department</th>
                        <th>Fiscal Year</th>
                        <th class="text-end">Allocated Ceiling</th>
                        <th class="text-end">PPMP Committed</th>
                        <th class="text-end">Remaining Balance</th>
                        <th class="text-center" style="width: 180px;">Utilization</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($funds)): ?>
                        <?php foreach ($funds as $f): ?>
                            <?php
                            $alloc = (float)$f['amount'];
                            $commit = (float)($f['committed_amount'] ?? 0);
                            $rem = $alloc - $commit;
                            $pct = $alloc > 0 ? round(($commit / $alloc) * 100, 1) : 0;
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark"><?= e($f['department_name']) ?></td>
                                <td><span class="badge bg-light text-dark border">FY <?= e((string)$f['year']) ?></span></td>
                                <td class="text-end fw-bold text-primary">&#8369;<?= number_format($alloc, 2) ?></td>
                                <td class="text-end fw-semibold text-warning">&#8369;<?= number_format($commit, 2) ?></td>
                                <td class="text-end fw-bold text-success">&#8369;<?= number_format($rem, 2) ?></td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px;">
                                            <div class="progress-bar <?= $pct > 80 ? 'bg-danger' : ($pct > 50 ? 'bg-warning' : 'bg-success') ?>" style="width: <?= min(100, $pct) ?>%"></div>
                                        </div>
                                        <span class="small fw-semibold"><?= $pct ?>%</span>
                                    </div>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="editFund('<?= e($f['department_name']) ?>', <?= $alloc ?>, <?= (int)$f['year'] ?>)">
                                        <i class="bi bi-pencil-square me-1"></i>Adjust
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">No allocated fund records found. Click <strong>Allocate College Fund</strong> to create one.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Allocate Fund -->
<div class="modal fade" id="modalAllocateFund" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy">
                    <i class="bi bi-bank me-2 text-gold"></i>Allocate Department Fund Ceiling
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/fund-source-verification/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">College / Department <span class="text-danger">*</span></label>
                        <select class="form-select" name="department_name" id="allocDept" required>
                            <option value="">— Select College / Office —</option>
                            <option value="College of Information and Computing Sciences (CICS)">College of Information and Computing Sciences (CICS)</option>
                            <option value="College of Engineering and Technology (CET)">College of Engineering and Technology (CET)</option>
                            <option value="College of Arts and Sciences (CAS)">College of Arts and Sciences (CAS)</option>
                            <option value="College of Business and Accountancy (CBA)">College of Business and Accountancy (CBA)</option>
                            <option value="College of Teacher Education (CTE)">College of Teacher Education (CTE)</option>
                            <option value="Office of Student Affairs and Services (OSAS)">Office of Student Affairs and Services (OSAS)</option>
                            <option value="University Library System">University Library System</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fiscal Year <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="year" id="allocYear" value="<?= date('Y') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fund Allocation Amount (&#8369;) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="1" class="form-control" name="amount" id="allocAmount" placeholder="e.g. 500000.00" required>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Allocation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editFund(dept, amount, year) {
    document.getElementById('allocDept').value = dept;
    document.getElementById('allocAmount').value = amount;
    document.getElementById('allocYear').value = year;
    const modal = new bootstrap.Modal(document.getElementById('modalAllocateFund'));
    modal.show();
}
</script>
