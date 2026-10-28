<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Clean Empty State Partial (empty_state.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="card border-0 shadow-sm text-center py-5 my-3">
    <div class="card-body">
        <div class="mb-3 text-secondary">
            <i class="bi <?= e($icon ?? 'bi-inbox') ?>" style="font-size: 3rem;"></i>
        </div>
        <h5 class="fw-bold text-dark"><?= e($title ?? 'No Records Found') ?></h5>
        <p class="text-secondary small mb-3 mx-auto" style="max-width: 480px;">
            <?= e($message ?? 'There are no items recorded in this view at this time.') ?>
        </p>
        <?php if (!empty($actionUrl) && !empty($actionText)): ?>
            <a href="<?= e($actionUrl) ?>" class="btn btn-marsu btn-sm">
                <i class="bi <?= e($actionIcon ?? 'bi-plus-circle') ?> me-1"></i><?= e($actionText) ?>
            </a>
        <?php endif; ?>
    </div>
</div>
