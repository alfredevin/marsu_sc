<!-- Approval Workflow — Procurement Management Information System (SPMS Multi-Tier Approvals) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-check2-circle me-2 text-gold"></i>Multi-Tier Approval Workflow
        </h1>
        <p class="text-muted small mb-0">Review, endorse, and approve departmental PPMPs and purchase requests across university executive hierarchy.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
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

<!-- Pipeline Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <div class="p-3 bg-warning-subtle text-warning rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-hourglass-split fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-warning"><?= count($pendingPpmps ?? []) ?></div>
            <div class="text-muted small">Pending PPMPs for Review</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <div class="p-3 bg-primary-subtle text-primary rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-file-earmark-text fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-primary"><?= count($pendingPrs ?? []) ?></div>
            <div class="text-muted small">Pending PRs for Endorsement</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 bg-white text-center">
            <div class="p-3 bg-success-subtle text-success rounded-circle mx-auto mb-2" style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-check2-all fs-4"></i>
            </div>
            <div class="h3 fw-bold mb-0 text-success">Active</div>
            <div class="text-muted small">BAC & Campus Executive Hierarchy</div>
        </div>
    </div>
</div>

<!-- Section 1: Pending PPMPs -->
<div class="card shadow-sm border-0 mb-4 border-top border-warning border-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-diagram-3 me-2 text-warning"></i>PPMP Approval Pipeline
        </h5>
        <span class="badge bg-warning text-dark">College Endorsement</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PPMP Code</th>
                        <th>College / Office</th>
                        <th>Dean / Submitter</th>
                        <th>Reason / Project Description</th>
                        <th class="text-end">Budget Amount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendingPpmps)): ?>
                        <?php foreach ($pendingPpmps as $p): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($p['ppmp_code']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($p['department_name']) ?></td>
                                <td><?= e($p['requested_by']) ?></td>
                                <td><?= e($p['reason'] ?? 'Annual departmental procurement') ?></td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$p['grand_total'], 2) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success me-1" onclick="openApprovalModal('ppmp', <?= (int)$p['id'] ?>, 'approve', '<?= e($p['ppmp_code']) ?>')">
                                        <i class="bi bi-check-lg me-1"></i>Approve
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="openApprovalModal('ppmp', <?= (int)$p['id'] ?>, 'reject', '<?= e($p['ppmp_code']) ?>')">
                                        <i class="bi bi-x-lg me-1"></i>Reject
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No pending PPMPs awaiting review.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section 2: Pending PRs -->
<div class="card shadow-sm border-0 border-top border-primary border-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-file-earmark-plus me-2 text-primary"></i>Purchase Request (PR) Approvals
        </h5>
        <span class="badge bg-primary">BAC Clearance</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PR Number</th>
                        <th>Requesting Office</th>
                        <th>Purpose</th>
                        <th>Date Needed</th>
                        <th class="text-end">Estimated Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendingPrs)): ?>
                        <?php foreach ($pendingPrs as $pr): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($pr['pr_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($pr['requesting_office']) ?></td>
                                <td><?= e($pr['purpose']) ?></td>
                                <td><?= $pr['date_needed'] ? date("M d, Y", strtotime($pr['date_needed'])) : '—' ?></td>
                                <td class="text-end fw-bold text-dark">&#8369;<?= number_format((float)$pr['estimated_total'], 2) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success me-1" onclick="openApprovalModal('pr', <?= (int)$pr['id'] ?>, 'approve', '<?= e($pr['pr_number']) ?>')">
                                        <i class="bi bi-check-lg me-1"></i>Approve
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="openApprovalModal('pr', <?= (int)$pr['id'] ?>, 'reject', '<?= e($pr['pr_number']) ?>')">
                                        <i class="bi bi-x-lg me-1"></i>Reject
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No pending Purchase Requests in the approval queue.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Approval Decision -->
<div class="modal fade" id="modalWorkflowDecision" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" id="wfTitle">Workflow Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/approval-workflow/decide') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" id="wfType">
                <input type="hidden" name="id" id="wfId">
                <input type="hidden" name="action" id="wfAction">
                <div class="modal-body">
                    <p class="text-muted small" id="wfPrompt"></p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Executive Decision Notes / Remarks</label>
                        <textarea class="form-control" name="remarks" rows="3" placeholder="Endorsement or revision notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" id="wfSubmitBtn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openApprovalModal(type, id, action, ref) {
    document.getElementById('wfType').value = type;
    document.getElementById('wfId').value = id;
    document.getElementById('wfAction').value = action;
    const title = document.getElementById('wfTitle');
    const prompt = document.getElementById('wfPrompt');
    const submitBtn = document.getElementById('wfSubmitBtn');

    if (action === 'approve') {
        title.innerText = 'Approve: ' + ref;
        prompt.innerText = 'Confirm approval of this procurement record and advance to the next pipeline stage.';
        submitBtn.className = 'btn btn-success';
        submitBtn.innerText = 'Confirm Approval';
    } else {
        title.innerText = 'Reject: ' + ref;
        prompt.innerText = 'Confirm return of this procurement record with your remarks.';
        submitBtn.className = 'btn btn-danger';
        submitBtn.innerText = 'Reject Record';
    }

    const modal = new bootstrap.Modal(document.getElementById('modalWorkflowDecision'));
    modal.show();
}
</script>
