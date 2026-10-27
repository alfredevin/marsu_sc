<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Governance
 * View: Reason Modal Partial (reason_modal.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="reasonModalForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-marsu text-white">
                    <h5 class="modal-title fs-6" id="reasonModalLabel">
                        <i class="bi bi-shield-check me-2"></i>Action Authorization Reason
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="reasonModalDescription" class="text-secondary small mb-3">
                        Please provide an official justification for this administrative governance action. This will be recorded permanently in the system change log.
                    </p>
                    <div id="reasonModalExtraFields"></div>
                    <div class="mb-3">
                        <label for="reasonModalInput" class="form-label fw-bold small text-dark">
                            Mandatory Justification / Reason <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="reasonModalInput" name="reason" rows="3" required 
                            placeholder="Enter the official basis or justification for this change..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm" id="reasonModalSubmitBtn">
                        <i class="bi bi-check-circle me-1"></i>Confirm & Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
