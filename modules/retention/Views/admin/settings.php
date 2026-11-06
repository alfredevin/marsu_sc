<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Retention Policies
 * View: Retention Policy Settings (admin/settings.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-3">
    <!-- Breadcrumb & Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <i class="bi bi-gear-fill me-2 text-marsu-burgundy"></i>Institutional Retention Policy Settings
            </h4>
            <p class="text-secondary small mb-0">Configure system parameters, risk thresholds, and grading tolerances.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/admin/templates') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-file-earmark-ruled me-1"></i>Grading Templates
            </a>
            <a href="<?= url('retention/admin/change-log') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-clock-history me-1"></i>View Change Log
            </a>
        </div>
    </div>

    <!-- Governance Principle Banner -->
    <div class="alert alert-light border border-secondary-subtle d-flex align-items-start py-2 px-3 mb-4 shadow-sm" role="alert">
        <i class="bi bi-info-circle-fill fs-5 me-3 text-marsu-burgundy mt-1"></i>
        <div class="small">
            <strong class="d-block text-dark">Administrative Governance Principle (Part E1)</strong>
            <span class="text-secondary">
                Policy settings govern telemetry computations, attendance risk alerts, and course evaluation formulas going forward. 
                Already-posted classes retain their frozen grade snapshot. All policy modifications require an official reason and are immutably logged in the system audit trail.
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Settings Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-dark fs-6">
                        <i class="bi bi-sliders me-2 text-marsu-burgundy"></i>Active Policy Parameters
                    </span>
                    <span class="badge bg-secondary-subtle text-secondary small">MariaDB 10.4 Persistent</span>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= url('retention/admin/settings/update') ?>" id="settingsForm">
                        <?= csrf_field() ?>
                        
                        <div class="list-group list-group-flush">
                            <?php foreach ($settings as $setting): ?>
                                <div class="list-group-item px-0 py-3 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <label for="setting_<?= e($setting['key']) ?>" class="form-label fw-bold text-dark mb-1">
                                                <?= e($setting['label']) ?>
                                            </label>
                                            <p class="text-secondary small mb-1"><?= e($setting['description']) ?></p>
                                            <span class="badge bg-light text-muted border font-monospace" style="font-size: 11px;">
                                                Key: <?= e($setting['key']) ?>
                                            </span>
                                            <?php if ($setting['min_value'] !== null || $setting['max_value'] !== null): ?>
                                                <span class="badge bg-light text-muted border ms-1" style="font-size: 11px;">
                                                    Allowed Range: <?= e($setting['min_value'] ?? '0') ?> – <?= e($setting['max_value'] ?? '∞') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-5 mt-2 mt-md-0">
                                            <?php if ($setting['type'] === 'bool'): ?>
                                                <select class="form-select form-select-sm" 
                                                        id="setting_<?= e($setting['key']) ?>" 
                                                        name="settings[<?= e($setting['key']) ?>]">
                                                    <option value="1" <?= $setting['value'] == '1' ? 'selected' : '' ?>>Enabled (Yes)</option>
                                                    <option value="0" <?= $setting['value'] == '0' ? 'selected' : '' ?>>Disabled (No)</option>
                                                </select>
                                            <?php else: ?>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" 
                                                           step="<?= $setting['type'] === 'decimal' ? '0.01' : '1' ?>" 
                                                           min="<?= e($setting['min_value'] ?? '') ?>" 
                                                           max="<?= e($setting['max_value'] ?? '') ?>" 
                                                           class="form-control" 
                                                           id="setting_<?= e($setting['key']) ?>" 
                                                           name="settings[<?= e($setting['key']) ?>]" 
                                                           value="<?= e($setting['value']) ?>" 
                                                           required>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Mandatory Reason Field -->
                        <div class="mt-4 pt-3 border-top">
                            <label for="settingsReason" class="form-label fw-bold text-dark">
                                Mandatory Administrative Justification <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="settingsReason" 
                                      name="reason" 
                                      rows="3" 
                                      required 
                                      placeholder="Provide the institutional basis, academic council resolution, or policy memorandum justifying this change..."></textarea>
                            <small class="text-secondary d-block mt-1">
                                <i class="bi bi-shield-lock me-1"></i>This justification will be permanently attributed to your account in the change log audit trail.
                            </small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="<?= url('retention/admin/settings') ?>" class="btn btn-secondary btn-sm">Reset Changes</a>
                            <button type="submit" class="btn btn-marsu btn-sm">
                                <i class="bi bi-save me-1"></i>Save Policy Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help & Admin "Cannot" Summary Panel (Part E11) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <span class="fw-bold text-dark fs-6">
                        <i class="bi bi-shield-x me-2 text-danger"></i>Governance Limits (Part E11)
                    </span>
                </div>
                <div class="card-body p-3">
                    <p class="small text-secondary mb-3">
                        To preserve academic integrity and RA 10173 compliance, <strong>Retention Administrators govern rules and assignments only</strong>. Administrators cannot perform faculty work:
                    </p>
                    <ul class="list-unstyled small text-secondary mb-0">
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Encode or modify student task scores</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Compute or publish class grades</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Edit an active class's grading scheme or student roster</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Resolve Incomplete (INC) marks on behalf of a faculty member</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Take daily roll-call or alter student attendance status</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Log task exceptions (late/missing/excused)</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>File or rewrite faculty conduct incident narratives</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Edit core student demographic records (handled in core)</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="bi bi-x-circle-fill text-danger me-2 mt-1"></i>
                            <span>Hard-delete academic telemetry or audit logs</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Policy Key Descriptions Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <span class="fw-bold text-dark fs-6">
                        <i class="bi bi-question-circle me-2 text-info"></i>Policy Key Reference
                    </span>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <strong class="d-block text-dark small fw-bold">Allowable Cuts</strong>
                        <p class="text-secondary small mb-0">Computed via <code>max(min_allowable_cuts, round(sessions × max_absence_ratio))</code>.</p>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block text-dark small fw-bold">Attendance Critical Risk</strong>
                        <p class="text-secondary small mb-0">Flagged when unexcused absences ≥ allowable cuts, or attendance rate &lt; critical rate.</p>
                    </div>
                    <div>
                        <strong class="d-block text-dark small fw-bold">INC Expiration</strong>
                        <p class="text-secondary small mb-0">Automated deadline calculated as <code>posted_at + inc_removal_days</code> (default: 365 days).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
