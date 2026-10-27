<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-patch-check-fill me-1"></i>Official Property Turnover &amp; Clearance Verification
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Property Accountability Ledger &amp; Clearance') ?>
            </h1>
            <p class="text-muted small mb-0">
                Live per-employee asset ledger. Automatically checks for overdue gate passes or missing property before issuing retirement/transfer clearance.
            </p>
        </div>
    </div>

    <!-- Employee Selector Card -->
    <div class="card shadow-sm p-4 mb-4 border-0">
        <div class="row align-items-center g-3">
            <div class="col-md-7">
                <label for="clearanceEmployeeSelect" class="form-label small fw-bold text-uppercase text-muted">Select Faculty / Staff Member to Audit:</label>
                <select id="clearanceEmployeeSelect" class="form-select form-select-lg fw-semibold" onchange="loadEmployeeClearance(this.value)">
                    <option value="">-- Choose Employee Accountable Officer --</option>
                    <?php if (!empty($employeeList)): ?>
                        <?php foreach ($employeeList as$emp): ?>
                            <option value="<?= e($emp['id']) ?>"><?= e($emp['full_name']) ?> (<?= e($emp['department']) ?>)</option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-5 text-md-end">
                <button class="btn btn-warning text-dark fw-bold shadow-sm px-4 py-2" id="generateClearanceBtn" onclick="generateClearanceCert()">
                    <i class="bi bi-file-earmark-richtext-fill me-1"></i>Generate Clearance Certificate
                </button>
            </div>
        </div>
    </div>

    <!-- Accountability Summary Banner -->
    <div id="clearanceAuditStatus" class="mb-4">
        <!-- Default or Dynamic Status Banner -->
        <div class="card shadow-sm border-0 border-start border-5 border-success p-3 bg-success bg-opacity-10">
            <div class="d-flex align-items-center">
                <div class="p-2 rounded bg-success bg-opacity-25 text-success me-3">
                    <i class="bi bi-shield-fill-check fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-dark">Clearance Status: Ready for Audit Review</h6>
                    <p class="small text-muted mb-0">Select an employee above to inspect assigned Property Acknowledgement Receipts (PAR) and Semi-Expendable Property (ICS) items.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Assigned Assets Grid -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h6 class="m-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-boxes text-warning me-2"></i>Active Property &amp; Equipment Assigned to Employee
            </h6>
            <span class="badge bg-warning text-dark font-monospace" id="assignedItemsCount"><?= count($assignedItems ?? []) ?> Items</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu bg-marsu-burgundy text-white">
                        <tr>
                            <th class="py-3">Property No.</th>
                            <th class="py-3">Accountability Doc (PAR/ICS)</th>
                            <th class="py-3">Asset Description</th>
                            <th class="py-3">Acquisition Cost</th>
                            <th class="py-3">Net Book Value</th>
                            <th class="py-3">Station / Location</th>
                            <th class="py-3">Condition</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="clearanceItemsBody">
                        <?php if (!empty($assignedItems)): ?>
                            <?php foreach ($assignedItems as$item): ?>
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($item['property_no']) ?></td>
                                    <td><span class="badge bg-light text-dark border font-monospace"><?= e($item['accountability_doc']) ?></span></td>
                                    <td class="fw-semibold text-dark"><?= e($item['asset_description']) ?></td>
                                    <td class="font-monospace">₱<?= number_format($item['acquisition_cost'], 2) ?></td>
                                    <td class="font-monospace text-success fw-bold">₱<?= number_format($item['net_book_value'], 2) ?></td>
                                    <td class="small text-muted"><?= e($item['station']) ?></td>
                                    <td>
                                        <?php if (($item['condition'] ?? '') === 'Serviceable'): ?>
                                            <span class="badge bg-success">Serviceable</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><?= e($item['condition'] ?? 'Fair') ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary" title="View Property Details" onclick="alert('Viewing asset #<?= e($item['id']) ?>')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                    No faculty or staff member selected, or no active property accountabilities found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
