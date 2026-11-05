<style>
@media print {
    body, .main, #main {
        background: #fff !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .sidebar, .navbar, .pagetitle, .btn, .breadcrumb, footer, .card-header .btn, .card-body .row, .alert, .no-print {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .table-responsive {
        overflow: visible !important;
    }
    table {
        width: 100% !important;
        font-size: 8.5pt !important;
    }
}
</style>

<!-- Project Procurement Management Plan — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-diagram-3 me-2 text-gold"></i>Project Procurement Management Plan (PPMP)
        </h1>
        <p class="text-muted small mb-0">Dean & Department Head procurement planning module — define items, quantities, and budget allocations for the fiscal year.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewPPMP">
            <i class="bi bi-plus-circle me-1"></i>New PPMP Entry
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

<!-- Filter Bar -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" id="ppmpSearchInput" class="form-control form-control-sm" placeholder="Search by PPMP code, department, or reason...">
            </div>
            <div class="col-md-3">
                <select id="ppmpYearFilter" class="form-select form-select-sm">
                    <option value="">All Fiscal Years</option>
                    <option value="2026">FY 2026</option>
                    <option value="2025">FY 2025</option>
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="text-muted small">Total Plans: <strong class="text-dark"><?= count($ppmps ?? []) ?></strong></span>
            </div>
        </div>
    </div>
</div>

<!-- PPMP Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Departmental PPMP Master Registry
        </h5>
        <span class="badge bg-light text-dark border">SPMS Consolidation Source</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="ppmpTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PPMP Code</th>
                        <th>Fiscal Year</th>
                        <th>College / Department</th>
                        <th>Submitted By</th>
                        <th>Project Justification / Reason</th>
                        <th class="text-end">Grand Total</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ppmps)): ?>
                        <?php foreach ($ppmps as $p): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($p['ppmp_code']) ?></td>
                                <td><span class="badge bg-light text-dark border">FY <?= e((string)$p['year']) ?></span></td>
                                <td class="fw-semibold text-dark"><?= e($p['department_name']) ?></td>
                                <td><?= e($p['requested_by']) ?></td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;" title="<?= e($p['reason'] ?? '') ?>">
                                        <?= e($p['reason'] ?? 'Annual procurement allocation') ?>
                                    </div>
                                    <?php if (!empty($p['remarks'])): ?>
                                        <small class="text-muted d-block"><i class="bi bi-chat-quote me-1"></i><?= e($p['remarks']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$p['grand_total'], 2) ?></td>
                                <td class="text-center">
                                    <?php
                                    $st = $p['status'];
                                    $badge = 'bg-secondary';
                                    if ($st === 'Approved')        $badge = 'bg-success';
                                    if ($st === 'Ready for RFQ')   $badge = 'bg-info text-dark';
                                    if ($st === 'Pending Approval') $badge = 'bg-warning text-dark';
                                    if ($st === 'Rejected')        $badge = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= e($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('procurement/print/app') ?>" target="_blank" class="btn btn-sm btn-outline-danger" title="Print PPMP / APP Masterplan">
                                        <i class="bi bi-printer me-1"></i>Print
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-diagram-3 fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                                No PPMP entries found. Click <strong>New PPMP Entry</strong> to begin planning.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New PPMP -->
<div class="modal fade" id="modalNewPPMP" tabindex="-1" aria-labelledby="modalNewPPMPLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewPPMPLabel">
                    <i class="bi bi-diagram-3 me-2 text-gold"></i>Create Project Procurement Management Plan (PPMP)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/project-procurement-management-plan/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fiscal Year <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="year" value="<?= date('Y') ?>" min="2024" max="2030" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Department / College <span class="text-danger">*</span></label>
                            <select class="form-select" name="department_name" required>
                                <option value="">— Select College / Department —</option>
                                <option value="College of Information and Computing Sciences (CICS)">College of Information and Computing Sciences (CICS)</option>
                                <option value="College of Engineering and Technology (CET)">College of Engineering and Technology (CET)</option>
                                <option value="College of Arts and Sciences (CAS)">College of Arts and Sciences (CAS)</option>
                                <option value="College of Business and Accountancy (CBA)">College of Business and Accountancy (CBA)</option>
                                <option value="College of Teacher Education (CTE)">College of Teacher Education (CTE)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dean / Department Head Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="requested_by" placeholder="e.g. Dean Alfred Flores" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">General Project Purpose / Activity <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="reason" placeholder="e.g. IT Equipment Upgrades & Lab Expansion" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                        <i class="bi bi-list-check me-1 text-primary"></i>PPMP Planned Item
                    </h6>

                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Equipment / Item Description</label>
                            <input type="text" class="form-control form-control-sm" name="items[0][name]" placeholder="e.g. Desktop Computer Core i7 / Lab Apparatus" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Quantity</label>
                            <input type="number" class="form-control form-control-sm" id="ppmpItemQty" name="items[0][quantity]" value="1" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Est. Unit Price (&#8369;)</label>
                            <input type="number" step="0.01" class="form-control form-control-sm" id="ppmpItemPrice" name="items[0][price]" value="25000.00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-send me-1"></i>Submit PPMP for Approval</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('ppmpSearchInput');
    const yearFilter = document.getElementById('ppmpYearFilter');
    const table = document.getElementById('ppmpTable');
    if (!table) return;
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const query = (searchInput ? searchInput.value : '').toLowerCase();
        const year = (yearFilter ? yearFilter.value : '').toLowerCase();

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const matchesQuery = !query || text.includes(query);
            const matchesYear = !year || text.includes(year);
            row.style.display = (matchesQuery && matchesYear) ? '' : 'none';
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (yearFilter) yearFilter.addEventListener('change', filterTable);
});
</script>
