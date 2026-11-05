<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-shield-lock-fill me-1"></i>Guaranteed Off-Campus Asset Tracking &amp; Reconciled Return
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Gate Pass (Permit to Bring OUT) Management') ?>
            </h1>
            <p class="text-muted small mb-0">
                Three-tier sequential approval, legal undertaking enforcement, gate security STAMP OUT/IN, and overdue return escalation.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#createGatePassModal">
                <i class="bi bi-plus-circle me-1"></i>File New Gate Pass
            </button>
            <a href="guard-console.php" class="btn btn-outline-warning text-dark btn-sm fw-bold">
                <i class="bi bi-qr-code text-warning me-1"></i>Guard Station Scan
            </a>
        </div>
    </div>

    <!-- Overdue Returns Critical Widget -->
    <div id="overdueListWidget" class="card shadow-sm mb-4 border-0 border-start border-5 border-danger bg-danger bg-opacity-10" style="display: none;">
        <div class="card-header bg-danger bg-opacity-25 py-3 d-flex justify-content-between align-items-center border-bottom border-danger">
            <h6 class="m-0 fw-bold text-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>OVERDUE ASSET RETURNS &bull; IMMEDIATE ACTION REQUIRED
            </h6>
            <span class="badge bg-danger font-monospace" id="overdueCountTag">0 Overdue</span>
        </div>
        <div class="card-body p-3" id="overdueItemsContainer">
            <!-- Rendered dynamically -->
        </div>
    </div>

    <!-- Gate Passes Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom">
            <h6 class="m-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-clipboard-check-fill text-warning me-2"></i>Sta. Cruz Campus Gate Pass Manifests
            </h6>
            <span class="badge bg-light text-dark border font-monospace" style="font-size: 0.7rem;">Accomplished in Triplicate (Requester / Security / SPMU)</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu bg-marsu-burgundy text-white">
                        <tr>
                            <th class="py-3">Gate Pass No.</th>
                            <th class="py-3">Date Issued</th>
                            <th class="py-3">Accountable Bearer</th>
                            <th class="py-3">Purpose &amp; Station</th>
                            <th class="py-3">Authorized Property Items</th>
                            <th class="py-3">Expected Return</th>
                            <th class="py-3">Security Stamps</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="gatePassTableBody">
                        <?php if (!empty($gatePassRecords)): ?>
                            <?php foreach ($gatePassRecords as $gp): ?>
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($gp['gate_pass_no']) ?></td>
                                    <td class="small text-muted"><?= e(date('M d, Y', strtotime($gp['date_issued']))) ?></td>
                                    <td class="fw-semibold text-dark"><?= e($gp['accountable_bearer']) ?></td>
                                    <td class="small text-muted"><?= e($gp['purpose']) ?></td>
                                    <td class="font-monospace"><?= e($gp['authorized_items']) ?></td>
                                    <td class="small font-monospace text-warning"><?= e(date('M d, Y', strtotime($gp['expected_return']))) ?></td>
                                    <td>
                                        <?php if (($gp['security_stamps'] ?? '') === 'Stamped OUT'): ?>
                                            <span class="badge bg-info text-dark">Stamped OUT</span>
                                        <?php elseif (($gp['security_stamps'] ?? '') === 'Returned / In'): ?>
                                            <span class="badge bg-success">Returned / In</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><?= e($gp['security_stamps'] ?? 'Pending') ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (($gp['status'] ?? '') === 'Closed'): ?>
                                            <span class="badge bg-success">Closed</span>
                                        <?php elseif (($gp['status'] ?? '') === 'Overdue'): ?>
                                            <span class="badge bg-danger">Overdue</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Active Off-Campus</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary" title="View Gate Pass" onclick="alert('Viewing Gate Pass #<?= e($gp['id']) ?>')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                    No gate pass manifests recorded. Click "File New Gate Pass" to initiate an off-campus permit.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>