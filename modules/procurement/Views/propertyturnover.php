<!-- Property Turn-Over — Procurement Management Information System (SPMS PAR & Issuance) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-box-arrow-right me-2 text-gold"></i>Property Turn-Over & Issuance (PAR)
        </h1>
        <p class="text-muted small mb-0">Assign accepted equipment to custodians, generate Property Acknowledgement Receipts (PAR), and track property inventory numbers.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalIssueProperty">
            <i class="bi bi-plus-circle me-1"></i>Issue Equipment (PAR)
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

<!-- Tabs Navigation -->
<ul class="nav nav-tabs nav-tabs-bordered mb-4" id="turnoverTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active fw-semibold" data-bs-toggle="tab" data-bs-target="#tabMonitoring" type="button">
            <i class="bi bi-upc-scan me-1 text-primary"></i>Property Monitoring List (<?= count($issuedItems ?? []) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tabPars" type="button">
            <i class="bi bi-file-earmark-person me-1 text-marsu-burgundy"></i>Issued PAR Receipts (<?= count($issuances ?? []) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tabAvailable" type="button">
            <i class="bi bi-box-seam me-1 text-success"></i>Available Inventory for Issuance (<?= count($inventory ?? []) ?>)
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- Tab 1: Property Monitoring List -->
    <div class="tab-pane fade show active" id="tabMonitoring">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-upc-scan me-2 text-primary"></i>Active Property Monitoring & Status List
                </h5>
                <button class="btn btn-sm btn-outline-danger" onclick="window.print();">
                    <i class="bi bi-printer me-1"></i>Print Monitoring Sheet
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Property Tag No.</th>
                                <th>Item Description</th>
                                <th>PAR Reference</th>
                                <th>Custodian / Accountable</th>
                                <th>College / Office</th>
                                <th>Date Assigned</th>
                                <th class="text-center">Condition Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($issuedItems)): ?>
                                <?php foreach ($issuedItems as $item): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-primary"><?= e($item['property_number']) ?></td>
                                        <td class="fw-semibold text-dark"><?= e($item['item_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($item['tracking_no']) ?></span></td>
                                        <td><?= e($item['issued_to_name']) ?></td>
                                        <td><small class="text-muted"><?= e($item['department_name']) ?></small></td>
                                        <td><?= date("M d, Y", strtotime($item['issue_date'])) ?></td>
                                        <td class="text-center">
                                            <?php
                                            $st = $item['status'];
                                            $badge = 'bg-success';
                                            if ($st === 'Missing')      $badge = 'bg-danger';
                                            if ($st === 'For Condemn')  $badge = 'bg-warning text-dark';
                                            if ($st === 'Condemned')    $badge = 'bg-secondary';
                                            ?>
                                            <span class="badge <?= $badge ?>"><?= e($st) ?></span>
                                            <?php if (!empty($item['remarks'])): ?>
                                                <small class="d-block text-muted"><?= e($item['remarks']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">No equipment currently assigned. Click <strong>Issue Equipment (PAR)</strong> to assign.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Issued PARs -->
    <div class="tab-pane fade" id="tabPars">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-file-earmark-text me-2 text-gold"></i>Property Acknowledgement Receipts (PAR) Master List
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">PAR Number</th>
                                <th>Accountable Faculty / Officer</th>
                                <th>Department / College</th>
                                <th>Turn-Over Date</th>
                                <th>Purpose</th>
                                <th>Supply Officer</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($issuances)): ?>
                                <?php foreach ($issuances as $iss): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-primary"><?= e($iss['tracking_no']) ?></td>
                                        <td class="fw-semibold text-dark"><?= e($iss['issued_to_name']) ?></td>
                                        <td><?= e($iss['department_name']) ?></td>
                                        <td><?= date("M d, Y", strtotime($iss['issue_date'])) ?></td>
                                        <td><small class="text-muted"><?= e($iss['purpose'] ?? 'Official Assignment') ?></small></td>
                                        <td><small class="text-muted"><?= e($iss['issued_by']) ?></small></td>
                                        <td class="text-end pe-3">
                                            <button class="btn btn-sm btn-outline-danger" onclick="window.print();" title="Print PAR Slip">
                                                <i class="bi bi-printer me-1"></i>Print PAR
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">No PAR slips generated yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 3: Available Inventory Stock -->
    <div class="tab-pane fade" id="tabAvailable">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="bi bi-box-seam me-2"></i>Stock on Hand Ready for Handover
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Item Name</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th class="text-center">Available Stock</th>
                                <th class="text-end">Unit Cost</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($inventory)): ?>
                                <?php foreach ($inventory as $inv): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($inv['item_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($inv['category']) ?></span></td>
                                        <td><?= e($inv['unit']) ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-success-subtle text-success fs-6 px-3"><?= (int)$inv['qty_on_hand'] ?></span>
                                        </td>
                                        <td class="text-end fw-bold">&#8369;<?= number_format((float)$inv['unit_cost'], 2) ?></td>
                                        <td class="text-end pe-3">
                                            <button class="btn btn-sm btn-marsu" onclick="quickAssign(<?= (int)$inv['id'] ?>)">
                                                <i class="bi bi-arrow-right-circle me-1"></i>Assign to Custodian
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">No stock available in inventory for handover.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Issue Property -->
<div class="modal fade" id="modalIssueProperty" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy">
                    <i class="bi bi-box-arrow-right me-2 text-gold"></i>Issue Equipment under PAR Receipt
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/property-turn-over/issue') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Inventory Item to Hand Over <span class="text-danger">*</span></label>
                            <select class="form-select" name="inventory_id" id="issueInvSelect" required>
                                <option value="">— Select Available Item —</option>
                                <?php foreach ($inventory ?? [] as $inv): ?>
                                    <option value="<?= (int)$inv['id'] ?>"><?= e($inv['item_name']) ?> (Stock: <?= (int)$inv['qty_on_hand'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Property Tag Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="property_number" value="PRC-<?= date('Y') ?>-<?= str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Custodian / Accountable Officer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="issued_to_name" placeholder="e.g. Engr. Roberto Tan / Prof. Angela Gutierrez" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">College / Assigned Department <span class="text-danger">*</span></label>
                            <select class="form-select" name="department_name" required>
                                <option value="College of Information and Computing Sciences (CICS)">College of Information and Computing Sciences (CICS)</option>
                                <option value="College of Engineering and Technology (CET)">College of Engineering and Technology (CET)</option>
                                <option value="College of Arts and Sciences (CAS)">College of Arts and Sciences (CAS)</option>
                                <option value="College of Business and Accountancy (CBA)">College of Business and Accountancy (CBA)</option>
                                <option value="College of Teacher Education (CTE)">College of Teacher Education (CTE)</option>
                                <option value="Administration & General Services">Administration & General Services</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Turn-Over Purpose & Location Details</label>
                            <textarea class="form-control" name="purpose" rows="2" placeholder="e.g. Assigned to CICS Computer Laboratory 3 for instructional computing use."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-file-earmark-check me-1"></i>Issue PAR & Update Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function quickAssign(invId) {
    document.getElementById('issueInvSelect').value = invId;
    const modal = new bootstrap.Modal(document.getElementById('modalIssueProperty'));
    modal.show();
}
</script>
