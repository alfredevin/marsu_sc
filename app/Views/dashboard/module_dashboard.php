<!-- MODULE LEAD WORKSPACE DASHBOARD -->

<!-- Palatandaan / Distinct Active Module Banner -->
<div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #800020 0%, #4D0013 100%); color: #fff; border-radius: 14px;">
    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow" style="background: rgba(212, 175, 55, 0.25); border: 2px solid #D4AF37; width: 68px; height: 68px; min-width: 68px;">
                <i class="bi <?= e($moduleMeta['menu']['icon'] ?? 'bi-app-indicator') ?> text-gold fs-2"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <span class="badge bg-warning text-dark fw-bold px-2 py-1" style="font-size: 0.75rem;">
                        <i class="bi bi-shield-lock-fill me-1"></i> DESIGNATED MODULE WORKSPACE
                    </span>
                    <span class="badge bg-dark bg-opacity-50 text-white-50 px-2 py-1" style="font-size: 0.75rem;">
                        Prefix: <code><?= e($prefix) ?></code>
                    </span>
                </div>
                <h2 class="h4 mb-1 fw-bold text-white"><?= e($moduleName) ?></h2>
                <p class="small text-white-50 mb-0">
                    Logged in as: <strong class="text-white"><?= e($user['first_name'] . ' ' . $user['last_name']) ?></strong> 
                    (<code><?= e($user['username']) ?></code>) • Role: <span class="badge bg-secondary"><?= e($user['role_name'] ?? 'Module Developer') ?></span>
                </p>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= url($moduleSlug) ?>" class="btn btn-warning fw-bold px-3 py-2 shadow-sm text-dark d-flex align-items-center gap-2">
                <i class="bi bi-folder2-open fs-5"></i>
                <span>Open Module Directory</span>
            </a>
            <a href="<?= url('STUDENT_CHEATSHEET.md') ?>" target="_blank" class="btn btn-outline-light px-3 py-2 d-flex align-items-center gap-2">
                <i class="bi bi-book"></i>
                <span>Cheatsheet</span>
            </a>
        </div>
    </div>
</div>

<!-- MODULE SPECIFIC KPI CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi border-burgundy p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Entries</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($totalCount) ?></div>
                    <div class="small text-muted mt-1">In <code><?= e($tableName) ?></code></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi <?= e($moduleMeta['menu']['icon'] ?? 'bi-folder2') ?>"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi border-gold p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Active Status</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($activeCount) ?></div>
                    <div class="small text-muted mt-1">Operational records</div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending Review</div>
                    <div class="h3 font-weight-bold mb-0 text-secondary"><?= number_format($pendingCount) ?></div>
                    <div class="small text-muted mt-1">Needs verification</div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Module Security</div>
                    <div class="h5 font-weight-bold mb-0 text-success">
                        <i class="bi bi-shield-check me-1"></i> Isolated
                    </div>
                    <div class="small text-muted mt-1">RBAC Protected</div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-lock-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QUICK WORKSPACE ACTIONS & MODULE DETAILS -->
<div class="row g-4 mb-4">
    <!-- Quick Developer Actions -->
    <div class="col-lg-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-tools me-2 text-gold"></i>Developer Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Direct actions for your assigned module development:</p>
                <div class="d-grid gap-2">
                    <a href="<?= url($moduleSlug) ?>" class="btn btn-marsu text-start d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="fw-bold"><i class="bi bi-table me-2"></i>View Module Records</div>
                            <div class="small opacity-75">Browse and search all logged entries</div>
                        </div>
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="<?= url($moduleSlug) ?>#newRecordModal" class="btn btn-outline-secondary text-start d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="fw-bold text-dark"><i class="bi bi-plus-circle me-2 text-gold"></i>Create New Entry</div>
                            <div class="small text-muted">Test your module input form</div>
                        </div>
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </div>

                <div class="alert alert-info border-0 mt-3 p-3 mb-0 small">
                    <strong class="d-block mb-1"><i class="bi bi-info-circle me-1"></i>Where to customize your UI?</strong>
                    Edit your page template and forms at: <br>
                    <code>modules/<?= e($moduleSlug) ?>/Views/index.php</code>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Module Records Table -->
    <div class="col-lg-8">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-clock-history me-2 text-gold"></i>Recent Records in <?= e($moduleName) ?>
                </h6>
                <a href="<?= url($moduleSlug) ?>" class="btn btn-sm btn-outline-secondary">View All &rarr;</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Subject / Title</th>
                                <th>Description / Remarks</th>
                                <th>Status</th>
                                <th class="text-end">Date Logged</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2 text-gold opacity-50"></i>
                                        No entries found in <code><?= e($tableName) ?></code>.<br>
                                        <a href="<?= url($moduleSlug) ?>" class="btn btn-marsu btn-sm mt-2">
                                            <i class="bi bi-plus-lg me-1"></i>Create First Entry
                                        </a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($records as $i => $rec): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td class="fw-bold text-marsu-burgundy"><?= e($rec['title']) ?></td>
                                        <td class="small text-muted text-truncate" style="max-width: 250px;"><?= e($rec['description'] ?? 'No remarks') ?></td>
                                        <td>
                                            <?php if (($rec['status'] ?? '') === 'active'): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?= e(ucfirst($rec['status'] ?? 'pending')) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="small text-muted text-end"><?= e(date('M d, Y', strtotime($rec['created_at']))) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
