<?php
/**
 * Event Approval Workflow View
 * Module: Organization Leadership (orgleadership)
 *
 * Variables from controller:
 *   $title, $moduleName, $slug, $user
 *   $approvals, $proposals, $students, $decisionFilter
 */

// KPI calculations
$totalApprovals = count($approvals);
$approvedCount  = 0;
$pendingCount   = 0;
$rejectedCount  = 0;

foreach ($approvals as $a) {
    $dec = strtolower(trim($a['decision'] ?? ''));
    if ($dec === 'approved') {
        $approvedCount++;
    } elseif ($dec === 'pending') {
        $pendingCount++;
    } elseif ($dec === 'rejected') {
        $rejectedCount++;
    }
}
?>

<!-- Page Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1 text-marsu-burgundy fw-bold">
            <i class="bi bi-clipboard-check me-2"></i><?= e($title ?? 'Event Approval Workflow') ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= url('orgleadership') ?>"><?= e($moduleName ?? 'Organization Leadership') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Event Approvals</li>
            </ol>
        </nav>
    </div>
    <button type="button" class="btn btn-marsu mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#createApprovalModal">
        <i class="bi bi-plus-lg me-1"></i> New Approval
    </button>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <!-- Total Approvals -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-marsu-burgundy bg-opacity-10 me-3">
                    <i class="bi bi-clipboard-check fs-4 text-marsu-burgundy"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Total Approvals</div>
                    <div class="fs-4 fw-bold text-marsu-burgundy"><?= (int) $totalApprovals ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Approved -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-success bg-opacity-10 me-3">
                    <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Approved</div>
                    <div class="fs-4 fw-bold text-success"><?= (int) $approvedCount ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-warning bg-opacity-10 me-3">
                    <i class="bi bi-hourglass-split fs-4 text-warning"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Pending</div>
                    <div class="fs-4 fw-bold text-warning"><?= (int) $pendingCount ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rejected -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-danger bg-opacity-10 me-3">
                    <i class="bi bi-x-circle-fill fs-4 text-danger"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Rejected</div>
                    <div class="fs-4 fw-bold text-danger"><?= (int) $rejectedCount ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search Row -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <div class="row g-2 align-items-end">
            <!-- Decision Filter -->
            <div class="col-12 col-md-4 col-lg-3">
                <label for="filterDecision" class="form-label small fw-semibold mb-1">Filter by Decision</label>
                <select id="filterDecision" class="form-select form-select-sm" onchange="applyDecisionFilter(this.value)">
                    <option value="">All Decisions</option>
                    <option value="Pending" <?= ($decisionFilter ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= ($decisionFilter ?? '') === 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Rejected" <?= ($decisionFilter ?? '') === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                    <option value="Revision Required" <?= ($decisionFilter ?? '') === 'Revision Required' ? 'selected' : '' ?>>Revision Required</option>
                </select>
            </div>
            <!-- Table Search -->
            <div class="col-12 col-md-5 col-lg-4 ms-auto">
                <label for="tableSearch" class="form-label small fw-semibold mb-1">Search</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search approvals...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0" id="approvalsTable">
                <thead>
                    <tr>
                        <th class="ps-3" style="width:50px">#</th>
                        <th>Activity / Proposal</th>
                        <th>Organization</th>
                        <th>Approver</th>
                        <th class="text-center" style="width:80px">Step</th>
                        <th class="text-center">Decision</th>
                        <th>Decision Date</th>
                        <th>Comments</th>
                        <th class="text-center" style="width:100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($approvals)): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No approval records found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($approvals as $idx => $approval): ?>
                            <?php
                                $decisionRaw   = trim($approval['decision'] ?? 'Pending');
                                $decisionLower = strtolower($decisionRaw);

                                $badgeClass = 'bg-secondary';
                                if ($decisionLower === 'approved') {
                                    $badgeClass = 'bg-success';
                                } elseif ($decisionLower === 'rejected') {
                                    $badgeClass = 'bg-danger';
                                } elseif ($decisionLower === 'pending') {
                                    $badgeClass = 'bg-warning text-dark';
                                } elseif ($decisionLower === 'revision required') {
                                    $badgeClass = 'bg-info';
                                }

                                $decisionDate = !empty($approval['decision_at'])
                                    ? date('M d, Y h:i A', strtotime($approval['decision_at']))
                                    : '—';

                                $approverName = trim(
                                    e($approval['proposer_first_name'] ?? '') . ' ' . e($approval['proposer_last_name'] ?? '')
                                );
                            ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $idx + 1 ?></td>
                                <td class="fw-semibold"><?= e($approval['activity_title'] ?? '—') ?></td>
                                <td>
                                    <?= e($approval['organization_name'] ?? '—') ?>
                                    <?php if (!empty($approval['organization_acronym'])): ?>
                                        <span class="badge badge-gold ms-1"><?= e($approval['organization_acronym']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $approverName ?: '—' ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary bg-opacity-25 text-body"><?= (int) ($approval['approval_step'] ?? 0) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $badgeClass ?>"><?= e($decisionRaw) ?></span>
                                </td>
                                <td class="small"><?= $decisionDate ?></td>
                                <td class="small text-muted" style="max-width:180px;">
                                    <span class="d-inline-block text-truncate" style="max-width:170px;" title="<?= e($approval['comments'] ?? '') ?>">
                                        <?= e($approval['comments'] ?? '—') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary btn-edit-approval"
                                            title="Edit Approval"
                                            data-id="<?= (int) $approval['id'] ?>"
                                            data-proposal-id="<?= (int) ($approval['proposal_id'] ?? 0) ?>"
                                            data-approver="<?= e($approval['approver_student_id'] ?? '') ?>"
                                            data-step="<?= (int) ($approval['approval_step'] ?? 1) ?>"
                                            data-decision="<?= e($decisionRaw) ?>"
                                            data-comments="<?= e($approval['comments'] ?? '') ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editApprovalModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Table footer with count -->
    <div class="card-footer bg-transparent border-top-0 py-2">
        <small class="text-muted" id="rowCount">Showing <?= count($approvals) ?> record(s)</small>
    </div>
</div>

<!-- ==================== CREATE APPROVAL MODAL ==================== -->
<div class="modal fade" id="createApprovalModal" tabindex="-1" aria-labelledby="createApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= url('orgleadership/approvals/store') ?>" method="POST" id="createApprovalForm">
                <?= csrf_field() ?>
                <div class="modal-header bg-marsu-burgundy text-white">
                    <h5 class="modal-title" id="createApprovalModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>New Approval Record
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Proposal -->
                        <div class="col-md-6">
                            <label for="createProposalId" class="form-label fw-semibold">Activity / Proposal <span class="text-danger">*</span></label>
                            <select id="createProposalId" name="proposal_id" class="form-select" required>
                                <option value="" disabled selected>Select a proposal</option>
                                <?php foreach ($proposals as $proposal): ?>
                                    <option value="<?= (int) $proposal['id'] ?>">
                                        <?= e($proposal['activity_title']) ?> — <?= e($proposal['organization_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Approver -->
                        <div class="col-md-6">
                            <label for="createApprover" class="form-label fw-semibold">Approver <span class="text-danger">*</span></label>
                            <select id="createApprover" name="approver_student_id" class="form-select" required>
                                <option value="" disabled selected>Select approver</option>
                                <?php foreach ($students as $student): ?>
                                    <option value="<?= e($student['student_number']) ?>">
                                        <?= e($student['first_name'] . ' ' . $student['last_name']) ?> (<?= e($student['student_number']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Step -->
                        <div class="col-md-4">
                            <label for="createStep" class="form-label fw-semibold">Approval Step <span class="text-danger">*</span></label>
                            <input type="number" id="createStep" name="approval_step" class="form-control" min="1" value="1" required>
                        </div>
                        <!-- Decision -->
                        <div class="col-md-8">
                            <label for="createDecision" class="form-label fw-semibold">Decision <span class="text-danger">*</span></label>
                            <select id="createDecision" name="decision" class="form-select" required>
                                <option value="Pending" selected>Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Revision Required">Revision Required</option>
                            </select>
                        </div>
                        <!-- Comments -->
                        <div class="col-12">
                            <label for="createComments" class="form-label fw-semibold">Comments</label>
                            <textarea id="createComments" name="comments" class="form-control" rows="3" placeholder="Optional remarks or notes..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i> Save Approval
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================== EDIT APPROVAL MODAL ==================== -->
<div class="modal fade" id="editApprovalModal" tabindex="-1" aria-labelledby="editApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= url('orgleadership/approvals/update') ?>" method="POST" id="editApprovalForm">
                <?= csrf_field() ?>
                <input type="hidden" name="approval_id" id="editApprovalId">
                <div class="modal-header bg-marsu-burgundy text-white">
                    <h5 class="modal-title" id="editApprovalModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Approval Record
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Proposal -->
                        <div class="col-md-6">
                            <label for="editProposalId" class="form-label fw-semibold">Activity / Proposal <span class="text-danger">*</span></label>
                            <select id="editProposalId" name="proposal_id" class="form-select" required>
                                <option value="" disabled>Select a proposal</option>
                                <?php foreach ($proposals as $proposal): ?>
                                    <option value="<?= (int) $proposal['id'] ?>">
                                        <?= e($proposal['activity_title']) ?> — <?= e($proposal['organization_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Approver -->
                        <div class="col-md-6">
                            <label for="editApprover" class="form-label fw-semibold">Approver <span class="text-danger">*</span></label>
                            <select id="editApprover" name="approver_student_id" class="form-select" required>
                                <option value="" disabled>Select approver</option>
                                <?php foreach ($students as $student): ?>
                                    <option value="<?= e($student['student_number']) ?>">
                                        <?= e($student['first_name'] . ' ' . $student['last_name']) ?> (<?= e($student['student_number']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Step -->
                        <div class="col-md-4">
                            <label for="editStep" class="form-label fw-semibold">Approval Step <span class="text-danger">*</span></label>
                            <input type="number" id="editStep" name="approval_step" class="form-control" min="1" required>
                        </div>
                        <!-- Decision -->
                        <div class="col-md-8">
                            <label for="editDecision" class="form-label fw-semibold">Decision <span class="text-danger">*</span></label>
                            <select id="editDecision" name="decision" class="form-select" required>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Revision Required">Revision Required</option>
                            </select>
                        </div>
                        <!-- Comments -->
                        <div class="col-12">
                            <label for="editComments" class="form-label fw-semibold">Comments</label>
                            <textarea id="editComments" name="comments" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i> Update Approval
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================== SCRIPTS ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Table Search Filter ──
    const searchInput = document.querySelector('#tableSearch');
    const tableBody   = document.querySelector('#approvalsTable tbody');
    const rowCountEl  = document.querySelector('#rowCount');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows  = tableBody.querySelectorAll('tr');
            let visible = 0;

            rows.forEach(function (row) {
                if (row.querySelector('td[colspan]')) return; // skip empty-state row
                const text = row.textContent.toLowerCase();
                const match = text.includes(query);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            if (rowCountEl) {
                rowCountEl.textContent = 'Showing ' + visible + ' record(s)';
            }
        });
    }

    // ── Edit Modal: populate fields from data attributes ──
    const editModal = document.querySelector('#editApprovalModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            if (!btn) return;

            document.querySelector('#editApprovalId').value    = btn.dataset.id          || '';
            document.querySelector('#editProposalId').value    = btn.dataset.proposalId  || '';
            document.querySelector('#editApprover').value      = btn.dataset.approver    || '';
            document.querySelector('#editStep').value          = btn.dataset.step        || '1';
            document.querySelector('#editDecision').value      = btn.dataset.decision    || 'Pending';
            document.querySelector('#editComments').value      = btn.dataset.comments    || '';
        });
    }

});

/**
 * Redirect with decision filter query parameter
 */
function applyDecisionFilter(value) {
    const base = window.location.pathname;
    if (value) {
        window.location.href = base + '?decision=' + encodeURIComponent(value);
    } else {
        window.location.href = base;
    }
}
</script>
