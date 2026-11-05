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

<!-- Requisition and Issue Slip — Procurement Management Information System (SPMS RIS Supplies Issuance) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-receipt me-2 text-gold"></i>Requisition and Issue Slip (RIS)
        </h1>
        <p class="text-muted small mb-0">Issue consumable supplies and office materials from warehouse inventory directly to departments and faculty.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewRIS">
            <i class="bi bi-plus-circle me-1"></i>New RIS
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

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total RIS Slips Issued</div>
                    <div class="h3 fw-bold mb-0 text-dark"><?= count($slips ?? []) ?></div>
                </div>
                <div class="p-3 bg-secondary-subtle text-secondary rounded-circle">
                    <i class="bi bi-receipt fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Available Supply Types</div>
                    <div class="h3 fw-bold mb-0 text-success"><?= count($supplies ?? []) ?></div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-boxes fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Issuance Status</div>
                    <div class="h3 fw-bold mb-0 text-primary">Active</div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-check2-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RIS Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-ul me-2 text-gold"></i>Requisition & Issue Slip Registry
        </h5>
        <span class="badge bg-light text-dark border">Consumables & Supplies</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">RIS Slip No.</th>
                        <th>Requisitioning Officer</th>
                        <th>Department / Unit</th>
                        <th>Date Issued</th>
                        <th>Purpose / Remarks</th>
                        <th>Issued By</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($slips)): ?>
                        <?php foreach ($slips as $s): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($s['tracking_no']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($s['issued_to_name']) ?></td>
                                <td><?= e($s['department_name']) ?></td>
                                <td><?= date("M d, Y", strtotime($s['issue_date'])) ?></td>
                                <td><small class="text-muted"><?= e($s['purpose'] ?? 'Classroom & Office Supplies') ?></small></td>
                                <td><small class="text-muted"><?= e($s['issued_by']) ?></small></td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('procurement/print/ris?id=' . (int)$s['id']) ?>" target="_blank" class="btn btn-sm btn-outline-danger" title="Print RIS Slip">
                                        <i class="bi bi-printer me-1"></i>Print RIS
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-receipt fs-2 text-muted d-block mb-2"></i>
                                No Requisition Slips found. Click <strong>New RIS</strong> to issue supplies.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New RIS -->
<div class="modal fade" id="modalNewRIS" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy">
                    <i class="bi bi-receipt me-2 text-gold"></i>Issue Supplies via Requisition & Issue Slip (RIS)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/resquisition-and-issue-slip/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Requisitioning Officer / Recipient <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="issued_to_name" placeholder="e.g. Prof. Angela Gutierrez" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department / College <span class="text-danger">*</span></label>
                            <select class="form-select" name="department_name" required>
                                <option value="College of Information and Computing Sciences (CICS)">College of Information and Computing Sciences (CICS)</option>
                                <option value="College of Engineering and Technology (CET)">College of Engineering and Technology (CET)</option>
                                <option value="College of Arts and Sciences (CAS)">College of Arts and Sciences (CAS)</option>
                                <option value="College of Business and Accountancy (CBA)">College of Business and Accountancy (CBA)</option>
                                <option value="College of Teacher Education (CTE)">College of Teacher Education (CTE)</option>
                                <option value="Office of Student Affairs and Services (OSAS)">Office of Student Affairs and Services (OSAS)</option>
                                <option value="University Library System">University Library System</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Select Supply Item on Hand <span class="text-danger">*</span></label>
                            <select class="form-select" name="inventory_id" required>
                                <option value="">— Select Available Item —</option>
                                <?php foreach ($supplies ?? [] as $sup): ?>
                                    <option value="<?= (int)$sup['id'] ?>">
                                        <?= e($sup['item_name']) ?> (Stock: <?= (int)$sup['qty_on_hand'] ?> <?= e($sup['unit']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Quantity to Issue <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control" name="quantity" value="1" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Purpose / Activity Justification</label>
                            <textarea class="form-control" name="purpose" rows="2" placeholder="e.g. Mid-term examination test paper printing and departmental administrative use."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-check2-circle me-1"></i>Process RIS & Release Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
