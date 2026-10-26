<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Read-Only Oversight Banner Partial (readonly_banner.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="alert alert-info border-start border-4 border-info d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
    <i class="bi bi-eye-fill fs-4 me-3 text-info"></i>
    <div class="small">
        <strong class="d-block fw-bold text-dark">Read-Only Oversight View</strong>
        <span class="text-secondary">
            <?= e($message ?? 'This record is governed by institutional faculty ownership. You are viewing this dataset in supervisory read-only mode.') ?>
        </span>
    </div>
</div>
