<div class="container-fluid px-0">
    <!-- Executive Hero Command Deck -->
    <div class="card shadow-sm border-0 mb-4 bg-light p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                    <i class="bi bi-warehouse text-warning me-1"></i>Supply &amp; Property Management Unit &bull; Sta. Cruz Campus
                </div>
                <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="invSubmoduleHeading">
                    <?= e($moduleName ?? 'Supply &amp; Equipment Inventory') ?>
                </h1>
                <p class="text-muted small mb-0" id="invSubmoduleSubtext">
                    Requisition and Issue Slip (RIS) logging, temporary equipment borrow vouchers, return verifications, and custodian clearance tracking.
                </p>
            </div>
            <div>
                <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm" id="invSubmoduleBadge">
                    <i class="bi bi-award-fill text-dark me-1"></i>Issuance &amp; Log
                </span>
            </div>
        </div>
    </div>

    <!-- Standalone module content -->
    <div id="moduleContent" data-module="issuance">
        
        <!-- Issuance Overview Stats -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-success p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Total RIS Dispatches</div>
                            <div class="h3 fw-bold font-monospace text-dark my-1"><?= e($risDispatchesCount ?? '48 Slips') ?></div>
                        </div>
                        <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-success mt-2">
                        <i class="bi bi-check-circle-fill me-1"></i>100% Signed &amp; Acknowledged
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Units Issued This Month</div>
                            <div class="h3 fw-bold text-warning font-monospace my-1"><?= e($unitsIssuedMonth ?? '186 Units') ?></div>
                        </div>
                        <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        Across 7 Academic &amp; Admin Units
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-info p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Active Custodial Borrows</div>
                            <div class="h3 fw-bold font-monospace text-info my-1"><?= e($activeCustodialBorrows ?? '4 Checkouts') ?></div>
                        </div>
                        <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                            <i class="bi bi-tools fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-info mt-2">
                        <i class="bi bi-info-circle me-1"></i>Field equipment &amp; testing tools
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Total Dispatched Value</div>
                            <div class="h3 fw-bold font-monospace text-marsu-burgundy my-1"><?= e($totalDispatchedValue ?? '₱184,500.00') ?></div>
                        </div>
                        <div class="p-2 rounded bg-marsu-burgundy bg-opacity-10 text-marsu-burgundy">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        Charged to GAA SUC Allocations
                    </div>
                </div>
            </div>
        </div>

        <!-- Requisitions Log Table (Appendix 63) -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom">
                <div>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        <i class="bi bi-file-earmark-text text-warning me-2"></i>Requisition &amp; Issue Slips (RIS - GAM Appendix 63) Dispatch Log
                    </h6>
                    <div class="small text-muted mt-1">Official registry of supplies released to accountable academic and administrative departments</div>
                </div>
                <a href="forms-ris.php" target="_blank" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" title="Open RIS Dispatch Form in New Tab">
                    <i class="bi bi-plus-circle me-1"></i>New RIS Dispatch
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">RIS Slip Number</th>
                                <th class="py-3">Requisitioning Officer</th>
                                <th class="py-3">College / Unit</th>
                                <th class="py-3">Purpose of Requisition</th>
                                <th class="py-3">Items Dispatched</th>
                                <th class="py-3">Date Issued</th>
                                <th class="py-3">Issuing Officer</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="risLogTableBody">
                            <?php if (!empty($risLogs)): ?>
                                <?php foreach ($risLogs as $ris): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($ris['slip_number']) ?></td>
                                        <td class="fw-semibold text-dark"><?= e($ris['requester_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($ris['college_unit']) ?></span></td>
                                        <td class="small text-muted"><?= e($ris['purpose']) ?></td>
                                        <td class="font-monospace"><?= e($ris['items_dispatched']) ?></td>
                                        <td class="small text-muted"><?= e(date('M d, Y', strtotime($ris['date_issued']))) ?></td>
                                        <td class="small"><?= e($ris['issuing_officer']) ?></td>
                                        <td>
                                            <?php if (($ris['status'] ?? '') === 'Completed'): ?>
                                                <span class="badge bg-success">Completed</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><?= e($ris['status'] ?? 'Pending') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing RIS #<?= e($ris['id']) ?>')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No RIS dispatches recorded. Click "New RIS Dispatch" to issue stock supplies.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Returnable Equipment / Tools Tracking Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom">
                <div>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        <i class="bi bi-arrow-left-right text-warning me-2"></i>Temporary Equipment Checkout &amp; Return Custody Tracker
                    </h6>
                    <div class="small text-muted mt-1">Custodial monitoring of borrowable testing tools, wireless presenter remotes, and field equipment</div>
                </div>
                <button class="btn btn-sm btn-outline-success fw-bold" onclick="window.showToast('All checkout slips are synced with the Security Guard Console.', 'emerald')">
                    <i class="bi bi-shield-check text-success me-1"></i>Guard Console Sync
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Borrow Ref No.</th>
                                <th class="py-3">Borrower Name</th>
                                <th class="py-3">Department / Office</th>
                                <th class="py-3">Equipment &amp; Tool Description</th>
                                <th class="py-3">Checkout Date</th>
                                <th class="py-3">Expected Return</th>
                                <th class="py-3">Return Status</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="returnsTableBody">
                            <?php if (!empty($returnableItems)): ?>
                                <?php foreach ($returnableItems as $item): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($item['borrow_ref']) ?></td>
                                        <td class="fw-semibold text-dark"><?= e($item['borrower_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($item['department']) ?></span></td>
                                        <td class="small text-muted"><?= e($item['equipment_desc']) ?></td>
                                        <td class="small text-muted"><?= e(date('M d, Y', strtotime($item['checkout_date']))) ?></td>
                                        <td class="small font-monospace text-warning"><?= e(date('M d, Y', strtotime($item['expected_return']))) ?></td>
                                        <td>
                                            <?php if (($item['return_status'] ?? '') === 'Returned'): ?>
                                                <span class="badge bg-success">Returned</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Active Checkout</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing checkout #<?= e($item['id']) ?>')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No active borrowable checkouts found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- End Sub-modules Tab Content -->
</div>