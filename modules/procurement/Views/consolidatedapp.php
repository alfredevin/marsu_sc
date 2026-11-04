<!-- Consolidated APP — Procurement Management Information System (SPMS Consolidation) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-layers me-2 text-gold"></i>Consolidated Annual Procurement Plan (APP)
        </h1>
        <p class="text-muted small mb-0">Admin consolidation module — review departmental PPMPs, approve plans, and finalize the university APP for BAC RFQ.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <form method="POST" action="<?= url('procurement/consolidated-app/finalize-rfq') ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to finalize all approved PPMPs for RFQ Canvassing?');">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-success btn-sm">
                <i class="bi bi-check2-all me-1"></i>Finalize APP for RFQ
            </button>
        </form>
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

<!-- Summary KPIs -->
<?php
$approvedTotal = 0.00;
foreach ($approved ?? [] as $a) {
    $approvedTotal += (float)$a['grand_total'];
}
?>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Consolidated APP Budget</div>
                    <div class="h3 fw-bold mb-0 text-success">&#8369;<?= number_format($approvedTotal, 2) ?></div>
                </div>
                <div class="p-3 bg-success-subtle text-success rounded-circle">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending Review Plans</div>
                    <div class="h3 fw-bold mb-0 text-warning"><?= count($pending ?? []) ?></div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Approved Department Plans</div>
                    <div class="h3 fw-bold mb-0 text-primary"><?= count($approved ?? []) ?></div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs nav-tabs-bordered mb-4" id="appTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active fw-semibold" data-bs-toggle="tab" data-bs-target="#tabPending" type="button">
            <i class="bi bi-clock-history me-1 text-warning"></i>Pending Requests (<?= count($pending ?? []) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tabApproved" type="button">
            <i class="bi bi-grid-3x3-gap-fill me-1 text-success"></i>APP Master List (<?= count($approved ?? []) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tabRejected" type="button">
            <i class="bi bi-x-circle me-1 text-danger"></i>Rejected Plans (<?= count($rejected ?? []) ?>)
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- 1. Pending Tab -->
    <div class="tab-pane fade show active" id="tabPending">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-inbox me-2 text-warning"></i>PPMPs Awaiting Consolidation Approval</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">PPMP Code</th>
                                <th>Department / College</th>
                                <th>Submitted By</th>
                                <th>Reason / Project</th>
                                <th class="text-end">Budget Requested</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pending)): ?>
                                <?php foreach ($pending as $p): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-primary"><?= e($p['ppmp_code']) ?></td>
                                        <td class="fw-semibold"><?= e($p['department_name']) ?></td>
                                        <td><?= e($p['requested_by']) ?></td>
                                        <td><?= e($p['reason'] ?? 'Annual procurement items') ?></td>
                                        <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$p['grand_total'], 2) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success me-1" onclick="openDecisionModal(<?= (int)$p['id'] ?>, 'approve', '<?= e($p['ppmp_code']) ?>')">
                                                <i class="bi bi-check-lg me-1"></i>Approve
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="openDecisionModal(<?= (int)$p['id'] ?>, 'reject', '<?= e($p['ppmp_code']) ?>')">
                                                <i class="bi bi-x-lg me-1"></i>Reject
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="bi bi-check-all fs-2 text-success d-block mb-2"></i>
                                        All submitted PPMPs have been reviewed and consolidated.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Approved / APP Master List Tab -->
    <div class="tab-pane fade" id="tabApproved">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-success"><i class="bi bi-check-circle me-2"></i>Consolidated APP Approved Plans</h6>
                <button class="btn btn-sm btn-outline-danger" onclick="window.print();">
                    <i class="bi bi-printer me-1"></i>Print APP Report
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">PPMP Code</th>
                                <th>College / Office</th>
                                <th>Year</th>
                                <th>Date Consolidated</th>
                                <th class="text-end">Approved Amount</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($approved)): ?>
                                <?php foreach ($approved as $a): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-primary"><?= e($a['ppmp_code']) ?></td>
                                        <td class="fw-semibold"><?= e($a['department_name']) ?></td>
                                        <td>FY <?= e((string)$a['year']) ?></td>
                                        <td><?= date("M d, Y", strtotime($a['created_at'])) ?></td>
                                        <td class="text-end fw-bold text-success">&#8369;<?= number_format((float)$a['grand_total'], 2) ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $a['status'] === 'Ready for RFQ' ? 'bg-info text-dark' : 'bg-success' ?>">
                                                <?= e($a['status']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">No approved PPMPs found in the consolidated APP.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Rejected Tab -->
    <div class="tab-pane fade" id="tabRejected">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-danger"><i class="bi bi-x-circle me-2"></i>Rejected PPMP Submissions</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">PPMP Code</th>
                                <th>Department</th>
                                <th>Requested Amount</th>
                                <th>Reviewer Remarks</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rejected)): ?>
                                <?php foreach ($rejected as $r): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($r['ppmp_code']) ?></td>
                                        <td><?= e($r['department_name']) ?></td>
                                        <td class="text-end fw-bold text-muted">&#8369;<?= number_format((float)$r['grand_total'], 2) ?></td>
                                        <td class="text-danger small"><?= e($r['remarks'] ?? 'Needs budget realignment') ?></td>
                                        <td class="text-center"><span class="badge bg-danger">Rejected</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">No rejected PPMPs on record.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Approve / Reject Decision -->
<div class="modal fade" id="modalDecision" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" id="decisionTitle">PPMP Decision</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/consolidated-app/decide') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="ppmp_id" id="decisionPpmpId">
                <input type="hidden" name="action" id="decisionAction">
                <div class="modal-body">
                    <p class="text-muted small" id="decisionPrompt"></p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reviewer Remarks / Notes</label>
                        <textarea class="form-control" name="remarks" rows="3" placeholder="Enter reason or instructions for the requesting college..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" id="decisionSubmitBtn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openDecisionModal(id, action, code) {
    document.getElementById('decisionPpmpId').value = id;
    document.getElementById('decisionAction').value = action;
    const title = document.getElementById('decisionTitle');
    const prompt = document.getElementById('decisionPrompt');
    const submitBtn = document.getElementById('decisionSubmitBtn');

    if (action === 'approve') {
        title.innerText = 'Approve PPMP (' + code + ')';
        prompt.innerText = 'This will approve the PPMP and include it into the Consolidated APP Master List.';
        submitBtn.className = 'btn btn-success';
        submitBtn.innerText = 'Approve Plan';
    } else {
        title.innerText = 'Reject PPMP (' + code + ')';
        prompt.innerText = 'This will return the PPMP to the Dean/Department Head with your remarks.';
        submitBtn.className = 'btn btn-danger';
        submitBtn.innerText = 'Reject Plan';
    }

    const modal = new bootstrap.Modal(document.getElementById('modalDecision'));
    modal.show();
}
</script>
