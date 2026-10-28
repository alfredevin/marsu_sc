<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Governance
 * View: Governance Audit Trail & Change Log (admin/change_log.php)
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
                <i class="bi bi-clock-history me-2 text-marsu-burgundy"></i>Governance Audit Trail & Change Log
            </h4>
            <p class="text-secondary small mb-0">Immutable system change log documenting policy adjustments, faculty reassignments, and administrative exceptions.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/admin/settings') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-gear me-1"></i>Policy Settings
            </a>
            <a href="<?= url('retention/admin/classes') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-mortarboard me-1"></i>Class Offerings
            </a>
        </div>
    </div>

    <!-- Audit Compliance Banner -->
    <div class="alert alert-light border border-secondary-subtle d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
        <i class="bi bi-shield-lock-fill fs-5 me-3 text-marsu-burgundy"></i>
        <div class="small">
            <strong class="d-block text-dark">Data Privacy & Academic Audit Compliance (RA 10173 & Institutional Policy)</strong>
            <span class="text-secondary">
                Every administrative modification records the previous state, new state, operating user account, and official justification. 
                Change log entries cannot be modified or purged.
            </span>
        </div>
    </div>

    <!-- Change Log Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold text-dark fs-6">
                <i class="bi bi-journal-text me-2 text-marsu-burgundy"></i>Recent Governance Audit Entries
            </span>
            <span class="badge bg-secondary-subtle text-secondary small"><?= count($logs) ?> Entries Logged</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-3" style="width: 150px;">Timestamp</th>
                            <th>Entity & ID</th>
                            <th>Action</th>
                            <th>Field</th>
                            <th>Change Details (Old → New)</th>
                            <th>Justification / Reason</th>
                            <th class="pe-3">Author</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($logs)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-clock-history fs-1 d-block mb-2 text-secondary"></i>
                                    <p class="mb-0 fw-semibold">No administrative changes recorded yet</p>
                                    <small>Audit log entries will appear here whenever policies, templates, or class assignments are updated.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td class="ps-3 text-muted" style="font-size: 11.5px;">
                                        <div class="fw-bold text-dark"><?= date('M d, Y', strtotime($log['created_at'])) ?></div>
                                        <div><?= date('h:i:s A', strtotime($log['created_at'])) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border font-monospace">
                                            <?= e(strtoupper($log['entity'])) ?> #<?= (int) $log['entity_id'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            <?= e($log['action']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <code class="text-secondary"><?= e($log['field'] ?? '—') ?></code>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <?php if ($log['old_value'] !== null || $log['new_value'] !== null): ?>
                                                <span class="text-muted text-decoration-line-through me-1"><?= e(mb_strimwidth($log['old_value'] ?? 'null', 0, 40, '...')) ?></span>
                                                <i class="bi bi-arrow-right text-secondary me-1"></i>
                                                <strong class="text-dark"><?= e(mb_strimwidth($log['new_value'] ?? 'null', 0, 40, '...')) ?></strong>
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-dark" style="max-width: 300px;">
                                            <i class="bi bi-chat-left-quote text-secondary me-1"></i>
                                            <?= e($log['reason'] ?? 'No reason provided') ?>
                                        </div>
                                    </td>
                                    <td class="pe-3">
                                        <div class="small">
                                            <span class="fw-semibold text-dark d-block"><?= e($log['user_name'] ?? 'System') ?></span>
                                            <small class="text-muted" style="font-size: 11px;"><?= e($log['user_email'] ?? '') ?></small>
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
