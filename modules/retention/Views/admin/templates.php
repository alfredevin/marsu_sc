<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Grading Schemes
 * View: Retention Grading Templates Management (admin/templates.php)
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
                <i class="bi bi-file-earmark-ruled-fill me-2 text-marsu-burgundy"></i>Institutional Grading Templates
            </h4>
            <p class="text-secondary small mb-0">Define reusable assessment structures, category weight distributions, and passing thresholds.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/admin/templates/create') ?>" class="btn btn-marsu btn-sm">
                <i class="bi bi-plus-circle me-1"></i>New Grading Template
            </a>
            <a href="<?= url('retention/admin/settings') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Back to Settings
            </a>
        </div>
    </div>

    <!-- Governance Rule Alert -->
    <div class="alert alert-light border border-secondary-subtle d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
        <i class="bi bi-shield-check fs-5 me-3 text-marsu-burgundy"></i>
        <div class="small">
            <strong class="d-block text-dark">Class Snapshot Rule (Part E2)</strong>
            <span class="text-secondary">
                When a class offering is created, its grading scheme is permanently snapshotted from the selected template. 
                Editing or deactivating a template <strong>never modifies existing classes</strong> or posted grade matrices.
            </span>
        </div>
    </div>

    <!-- Templates Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold text-dark fs-6">
                <i class="bi bi-table me-2 text-marsu-burgundy"></i>Registered Grading Templates
            </span>
            <span class="badge bg-secondary-subtle text-secondary small"><?= count($templates) ?> Total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 13.5px;">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-3" style="width: 50px;">#</th>
                            <th>Template Name</th>
                            <th>Passing Cutoff</th>
                            <th>Weight Distribution</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($templates)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    No grading templates registered. Click "New Grading Template" to create one.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($templates as $idx => $t): ?>
                                <?php 
                                    $scheme = json_decode($t['scheme'], true) ?: []; 
                                    $groups = $scheme['groups'] ?? [];
                                ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-muted"><?= $idx + 1 ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= e($t['name']) ?></div>
                                        <small class="text-muted"><?= count($groups) ?> Assessment Categories</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-bold">
                                            ≤ <?= number_format((float) $t['passing_cutoff'], 2) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <?php foreach ($groups as $g): ?>
                                                <span class="badge bg-light text-dark border" style="font-size: 11px;">
                                                    <?= e($g['title']) ?>: <strong><?= e($g['weight']) ?>%</strong>
                                                    <?php if (!empty($g['hasAttendance'])): ?>
                                                        <i class="bi bi-calendar-check text-primary ms-1" title="Includes roll-call attendance"></i>
                                                    <?php endif; ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($t['is_active']): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($t['is_default']): ?>
                                            <span class="badge bg-warning-subtle text-dark border border-warning-subtle">
                                                <i class="bi bi-star-fill text-warning me-1"></i>Institutional Default
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border">Alternative</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= url("retention/admin/templates/{$t['id']}/edit") ?>" 
                                               class="btn btn-outline-secondary" title="Edit Template Scheme">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php if (!$t['is_default']): ?>
                                                <form method="POST" action="<?= url("retention/admin/templates/{$t['id']}/set-default") ?>" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-outline-secondary" title="Set as System Default">
                                                        <i class="bi bi-star"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="<?= url("retention/admin/templates/{$t['id']}/toggle-active") ?>" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-outline-secondary" title="<?= $t['is_active'] ? 'Deactivate' : 'Activate' ?>">
                                                        <i class="bi <?= $t['is_active'] ? 'bi-toggle-on text-success' : 'bi-toggle-off text-muted' ?>"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
