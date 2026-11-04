<!-- PR Filling — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-file-earmark-text me-2 text-gold"></i>Purchase Requests (PR Filling)
        </h1>
        <p class="text-muted small mb-0">File, track and manage Purchase Requests for goods, equipment, and departmental supplies.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewPR">
            <i class="bi bi-plus-circle me-1"></i>New PR
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

<!-- Filter Row -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" id="prSearchInput" class="form-control form-control-sm" placeholder="Search PR number, purpose, or requesting office...">
            </div>
            <div class="col-md-3">
                <select id="prStatusFilter" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="Submitted">Submitted</option>
                    <option value="Canvassing">Canvassing</option>
                    <option value="Approved">Approved</option>
                    <option value="PO Issued">PO Issued</option>
                    <option value="Completed">Completed</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="text-muted small">Total Records: <strong class="text-dark"><?= count($purchaseRequests ?? []) ?></strong></span>
            </div>
        </div>
    </div>
</div>

<!-- PR Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-ul me-2 text-gold"></i>Purchase Request Records
        </h5>
        <span class="badge bg-light text-dark border">MarSU PMIS / SPMS</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="prTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PR No.</th>
                        <th>Requesting Office</th>
                        <th>Purpose / Description</th>
                        <th>Fund Source</th>
                        <th>Date Needed</th>
                        <th class="text-end">Est. Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($purchaseRequests)): ?>
                        <?php foreach ($purchaseRequests as $pr): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary">
                                    <?= e($pr['pr_number']) ?>
                                    <?php if ($pr['priority'] === 'High' || $pr['priority'] === 'Urgent'): ?>
                                        <span class="badge bg-danger ms-1"><?= e($pr['priority']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e($pr['requesting_office']) ?></div>
                                    <small class="text-muted">By: <?= e($pr['requested_by']) ?></small>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 260px;" title="<?= e($pr['purpose']) ?>">
                                        <?= e($pr['purpose']) ?>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary border"><?= e($pr['fund_source']) ?></span></td>
                                <td><?= $pr['date_needed'] ? date("M d, Y", strtotime($pr['date_needed'])) : '—' ?></td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$pr['estimated_total'], 2) ?></td>
                                <td class="text-center">
                                    <?php
                                    $st = $pr['status'];
                                    $badge = 'bg-secondary';
                                    if ($st === 'Approved')   $badge = 'bg-success';
                                    if ($st === 'PO Issued')  $badge = 'bg-info text-dark';
                                    if ($st === 'Canvassing') $badge = 'bg-warning text-dark';
                                    if ($st === 'Submitted')  $badge = 'bg-primary';
                                    if ($st === 'Rejected')   $badge = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= e($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-outline-danger" onclick="window.print();" title="Print PR Form">
                                        <i class="bi bi-printer me-1"></i>Print
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                                No purchase requests found. Click <strong>New PR</strong> to file one.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New PR -->
<div class="modal fade" id="modalNewPR" tabindex="-1" aria-labelledby="modalNewPRLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewPRLabel">
                    <i class="bi bi-file-earmark-plus me-2 text-gold"></i>New Purchase Request
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formNewPR" method="POST" action="<?= url('procurement/pr-filling/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="prNumber" class="form-label fw-semibold">PR Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="prNumber" name="pr_number" value="PR-<?= date('Y-m') ?>-<?= str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prDateFiled" class="form-label fw-semibold">Date Needed</label>
                            <input type="date" class="form-control" id="prDateFiled" name="date_needed" value="<?= date('Y-m-d', strtotime('+14 days')) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="prRequestingOffice" class="form-label fw-semibold">Requesting Office / College <span class="text-danger">*</span></label>
                            <select class="form-select" id="prRequestingOffice" name="requesting_office" required>
                                <option value="">— Select Office —</option>
                                <option value="College of Information and Computing Sciences (CICS)">College of Information and Computing Sciences (CICS)</option>
                                <option value="College of Engineering and Technology (CET)">College of Engineering and Technology (CET)</option>
                                <option value="College of Arts and Sciences (CAS)">College of Arts and Sciences (CAS)</option>
                                <option value="College of Business and Accountancy (CBA)">College of Business and Accountancy (CBA)</option>
                                <option value="College of Teacher Education (CTE)">College of Teacher Education (CTE)</option>
                                <option value="Office of Student Affairs and Services (OSAS)">Office of Student Affairs and Services (OSAS)</option>
                                <option value="University Library System">University Library System</option>
                                <option value="Administration & General Services">Administration & General Services</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="prFundSource" class="form-label fw-semibold">Fund Source</label>
                            <select class="form-select" id="prFundSource" name="fund_source">
                                <option value="General Fund (GAA)">General Fund (GAA)</option>
                                <option value="Special Trust Fund (STF)">Special Trust Fund (STF)</option>
                                <option value="Fiduciary Fund">Fiduciary Fund</option>
                                <option value="Income Generating Project (IGP)">IGP Fund</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="prPriority" class="form-label fw-semibold">Priority</label>
                            <select class="form-select" id="prPriority" name="priority">
                                <option value="Regular">Regular</option>
                                <option value="High">High</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="prEstAmount" class="form-label fw-semibold">Estimated Total Amount (&#8369;) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control" id="prEstAmount" name="estimated_amount" placeholder="0.00" required>
                        </div>
                        <div class="col-12">
                            <label for="prDescription" class="form-label fw-semibold">Item Specification & Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="prDescription" name="description" rows="3" placeholder="Specify items, specifications, quantity, and unit..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="prPurpose" class="form-label fw-semibold">Purpose / Justification <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="prPurpose" name="purpose" rows="2" placeholder="State official purpose or justification..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Submit Purchase Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('prSearchInput');
    const statusFilter = document.getElementById('prStatusFilter');
    const table = document.getElementById('prTable');
    if (!table) return;
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const query = (searchInput ? searchInput.value : '').toLowerCase();
        const status = (statusFilter ? statusFilter.value : '').toLowerCase();

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const matchesQuery = !query || text.includes(query);
            const matchesStatus = !status || text.includes(status);
            row.style.display = (matchesQuery && matchesStatus) ? '' : 'none';
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (statusFilter) statusFilter.addEventListener('change', filterTable);
});
</script>
