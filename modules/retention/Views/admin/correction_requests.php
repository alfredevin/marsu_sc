<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Grade Correction Requests Oversight (correction_requests.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Header & Action Row -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div class="d-flex align-items-center gap-2">
            <a href="<?= url('retention/admin/classes') ?>" class="btn btn-sm btn-outline-secondary me-1">
                <i class="bi bi-arrow-left me-1"></i> Offerings
            </a>
            <div class="rounded p-2 text-white d-flex align-items-center justify-content-center" style="background-color: #800020; width: 42px; height: 42px;">
                <i class="bi bi-patch-check-fill fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 text-dark">Grade Correction Requests</h5>
                <small class="text-muted" style="font-size: 12px;">Review and govern faculty post-submission grade change appeals</small>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="<?= url('retention/admin/change-log') ?>" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-clock-history me-1"></i> Audit Log
            </a>
        </div>
    </div>

    <!-- Governance Banner -->
    <div class="alert alert-info border-0 shadow-sm d-flex align-items-start gap-3 mb-4" role="alert">
        <i class="bi bi-shield-lock-fill fs-4 text-primary flex-shrink-0"></i>
        <div class="small">
            <strong>Part E5 Institutional Protocol:</strong>
            Faculty cannot unilaterally alter marks once a class grade sheet has been officially posted. 
            Approving an appeal unlocks the class offering back to <strong>Draft</strong> status, permitting the assigned faculty member to revise scores and re-post. Rejections require a clear administrative explanation.
        </div>
    </div>

    <!-- Pending Requests Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger rounded-pill px-2 py-1"><?= count($pendingRequests) ?></span>
                <h6 class="fw-bold text-dark mb-0">Pending Grade Correction Appeals</h6>
            </div>
            <small class="text-muted">Awaiting Module Administrator Action</small>
        </div>
        <div class="card-body p-0">
            <?php if (empty($pendingRequests)): ?>
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-check2-circle fs-1 text-success mb-2 d-block"></i>
                    <p class="mb-0 fw-semibold">No pending grade correction requests.</p>
                    <small>All faculty grade change appeals have been reviewed.</small>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-uppercase text-secondary">
                            <tr>
                                <th style="width: 80px;" class="ps-3">Req #</th>
                                <th>Class Offering</th>
                                <th>Faculty Requester</th>
                                <th>Reason Narrative</th>
                                <th>Date Filed</th>
                                <th class="text-end pe-3" style="width: 200px;">Governance Action</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php foreach ($pendingRequests as $req): ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-secondary">#<?= (int) $req['id'] ?></td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= e($req['subject_code']) ?> - <?= e($req['section_name']) ?></div>
                                        <small class="text-muted d-block text-truncate" style="max-width: 250px;"><?= e($req['subject_title']) ?></small>
                                        <a href="<?= url('retention/admin/classes/' . (int) $req['class_id']) ?>" target="_blank" class="text-decoration-none small text-primary">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>Inspect Class Record
                                        </a>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= e($req['requester_name']) ?></div>
                                        <small class="text-muted"><?= e($req['requester_email']) ?></small>
                                    </td>
                                    <td>
                                        <div class="p-2 rounded bg-light border text-dark" style="max-width: 380px; font-size: 11.5px; white-space: pre-wrap;"><?= e($req['reason']) ?></div>
                                    </td>
                                    <td class="text-muted">
                                        <?= date('M d, Y h:i A', strtotime($req['created_at'])) ?>
                                    </td>
                                    <td class="text-end pe-3">
                                        <button type="button" 
                                                class="btn btn-sm btn-success px-2 py-1 me-1"
                                                onclick="openApproveModal(<?= (int) $req['id'] ?>, '<?= e(addslashes($req['subject_code'] . ' - ' . $req['section_name'])) ?>', '<?= e(addslashes($req['requester_name'])) ?>')">
                                            <i class="bi bi-unlock-fill me-1"></i> Approve
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger px-2 py-1"
                                                onclick="openRejectModal(<?= (int) $req['id'] ?>, '<?= e(addslashes($req['subject_code'] . ' - ' . $req['section_name'])) ?>')">
                                            <i class="bi bi-x-circle me-1"></i> Reject
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Review History Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold text-dark mb-0">Correction Appeal History (Recent 50)</h6>
            <small class="text-muted">Historical Record of Approved & Rejected Appeals</small>
        </div>
        <div class="card-body p-0">
            <?php if (empty($historyRequests)): ?>
                <div class="p-4 text-center text-muted">
                    <small>No historical correction records logged yet.</small>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-uppercase text-secondary">
                            <tr>
                                <th style="width: 80px;" class="ps-3">Req #</th>
                                <th>Class Offering</th>
                                <th>Requester</th>
                                <th>Reviewer</th>
                                <th>Status</th>
                                <th>Reviewer Remarks</th>
                                <th class="text-end pe-3">Resolved Date</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php foreach ($historyRequests as $hist): ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-secondary">#<?= (int) $hist['id'] ?></td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= e($hist['subject_code']) ?> - <?= e($hist['section_name']) ?></div>
                                        <a href="<?= url('retention/admin/classes/' . (int) $hist['class_id']) ?>" target="_blank" class="text-decoration-none small text-muted">
                                            View Class Matrix
                                        </a>
                                    </td>
                                    <td><?= e($hist['requester_name']) ?></td>
                                    <td><?= e($hist['reviewer_name'] ?? 'System') ?></td>
                                    <td>
                                        <?php if ($hist['status'] === 'approved'): ?>
                                            <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                                <i class="bi bi-check-circle me-1"></i> Approved
                                            </span>
                                        <?php elseif ($hist['status'] === 'rejected'): ?>
                                            <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1">
                                                <i class="bi bi-x-circle me-1"></i> Rejected
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary px-2 py-1"><?= e($hist['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-dark d-block text-truncate" style="max-width: 320px;" title="<?= e($hist['review_note'] ?? '') ?>">
                                            <?= e($hist['review_note'] ?: 'No remarks recorded') ?>
                                        </small>
                                    </td>
                                    <td class="text-end pe-3 text-muted">
                                        <?= !empty($hist['reviewed_at']) ? date('M d, Y h:i A', strtotime($hist['reviewed_at'])) : date('M d, Y', strtotime($hist['updated_at'])) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Approve Correction Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form id="approveForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-success text-white">
                    <h6 class="modal-title fw-bold" id="approveModalLabel">
                        <i class="bi bi-unlock-fill me-1"></i> Approve Grade Correction Request
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-secondary small mb-3">
                        You are unlocking the class <strong class="text-dark" id="approveClassLabel"></strong> back to <strong>Draft</strong> status for faculty member <strong class="text-dark" id="approveFacultyLabel"></strong>.
                    </p>
                    <div class="mb-3">
                        <label for="approveReviewNote" class="form-label small fw-semibold text-dark">Administrative Note / Instructions (Optional)</label>
                        <textarea class="form-control form-control-sm" id="approveReviewNote" name="review_note" rows="3" placeholder="e.g. Approved. Faculty authorized to correct Prelim Quiz 2 and re-post within 48 hours."></textarea>
                    </div>
                    <div class="alert alert-warning border-0 p-2 small mb-0">
                        <i class="bi bi-info-circle me-1"></i> Once approved, this decision will be permanently committed to the governance change log.
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success px-3">
                        <i class="bi bi-check2-circle me-1"></i> Confirm & Unlock Class
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Correction Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form id="rejectForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-danger text-white">
                    <h6 class="modal-title fw-bold" id="rejectModalLabel">
                        <i class="bi bi-x-circle-fill me-1"></i> Reject Grade Correction Request
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-secondary small mb-3">
                        Please specify the formal institutional reason for declining the appeal for <strong class="text-dark" id="rejectClassLabel"></strong>.
                    </p>
                    <div class="mb-3">
                        <label for="rejectReviewNote" class="form-label small fw-semibold text-dark">Administrative Rejection Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" id="rejectReviewNote" name="review_note" rows="3" required placeholder="State justification for declining appeal (min 5 characters)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger px-3">
                        <i class="bi bi-x-lg me-1"></i> Confirm Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    window.openApproveModal = function(id, classLabel, facultyLabel) {
        document.getElementById('approveClassLabel').textContent = classLabel;
        document.getElementById('approveFacultyLabel').textContent = facultyLabel;
        document.getElementById('approveForm').action = '<?= url('retention/admin/corrections') ?>/' + id + '/approve';
        new bootstrap.Modal(document.getElementById('approveModal')).show();
    };

    window.openRejectModal = function(id, classLabel) {
        document.getElementById('rejectClassLabel').textContent = classLabel;
        document.getElementById('rejectForm').action = '<?= url('retention/admin/corrections') ?>/' + id + '/reject';
        new bootstrap.Modal(document.getElementById('rejectModal')).show();
    };
});
</script>
