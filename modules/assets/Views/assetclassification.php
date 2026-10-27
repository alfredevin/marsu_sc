<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-boxes me-1"></i>PROPERTY & ASSET REGISTRATION &bull; SUB-MODULE 3
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Asset Classification Schedule &amp; COA Depreciation Engine') ?>
            </h1>
            <p class="text-muted small mb-0">
                Straight-line depreciation calculator with residual value (5%), useful life schedules (COA Cir. 2022-004), and classification criteria.
            </p>
        </div>
        <div class="mt-3 mt-md-0">
            <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm">
                <i class="bi bi-university me-1"></i>Sta. Cruz Campus Certified
            </span>
        </div>
    </div>

    <!-- Asset module content wrapper -->
    <div id="assetModuleContent" data-asset-module="classification">

        <!-- 2 COA GAM Classification Tier Cards (Capitalized PPE vs Semi-Expendable) -->
        <div class="row g-3 mb-4">
            <!-- Capitalized PPE Card -->
            <div class="col-xl-6">
                <div class="card h-100 border-start border-4 border-warning shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="small text-warning text-uppercase fw-bold">Threshold: &ge; ₱50,000.00 (COA Circular 2022-004)</div>
                                    <h5 class="fw-bold mb-0 text-dark">Capitalized PPE</h5>
                                </div>
                                <span class="badge bg-primary px-2.5 py-1 fw-bold">PAR Form (App 71)</span>
                            </div>
                            <div class="h3 fw-bold font-monospace my-2 text-warning" id="ppeTotalValue">
                                <?= e($ppeTotalValue ?? '₱9,860,170.00') ?>
                            </div>
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 91.8%;" aria-valuenow="91.8" aria-valuemin="0" aria-valuemax="100" title="91.8% of Total Campus Valuation"></div>
                            </div>
                            <div class="small text-muted mb-2">
                                <strong class="text-warning" id="ppeTotalCount"><?= e($ppeTotalCount ?? '78 Units') ?></strong> &bull; Straight-line depreciation with 5% residual salvage value.
                            </div>
                            <div class="small text-muted pt-2 border-top">
                                Accountable via <strong>Property Acknowledgment Receipt (Appendix 71)</strong>.
                            </div>
                        </div>
                        <div class="pt-3">
                            <button class="btn btn-sm btn-outline-warning text-dark w-100 fw-bold" onclick="window.filterByClassificationTier('PPE')">
                                <i class="bi bi-filter me-1"></i>Filter PPE Records (<?= e($ppeTotalCountNum ?? '78') ?>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semi-Expendable Property Card -->
            <div class="col-xl-6">
                <div class="card h-100 border-start border-4 border-success shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="small text-success text-uppercase fw-bold">Threshold: &lt; ₱50,000.00 (COA Circular 2022-004)</div>
                                    <h5 class="fw-bold mb-0 text-dark">Semi-Expendable Property</h5>
                                </div>
                                <span class="badge bg-success px-2.5 py-1 fw-bold">ICS Form (App 59)</span>
                            </div>
                            <div class="h3 fw-bold font-monospace my-2 text-success" id="semiTotalValue">
                                <?= e($semiTotalValue ?? '₱880,000.00') ?>
                            </div>
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 8.2%;" aria-valuenow="8.2" aria-valuemin="0" aria-valuemax="100" title="8.2% of Total Campus Valuation"></div>
                            </div>
                            <div class="small text-muted mb-2">
                                <strong class="text-success" id="semiTotalCount"><?= e($semiTotalCount ?? '52 Units') ?></strong> &bull; Tangible items below ₱50,000.00 threshold. Expensed upon purchase but strictly tracked via ICS.
                            </div>
                            <div class="small text-muted pt-2 border-top">
                                Accountable via <strong>Inventory Custodian Slip (Appendix 59)</strong> and Semi-RPCPPE.
                            </div>
                        </div>
                        <div class="pt-3">
                            <button class="btn btn-sm btn-outline-success w-100 fw-bold" onclick="window.filterByClassificationTier('SEMI')">
                                <i class="bi bi-filter me-1"></i>Filter Semi-Expendable Records (<?= e($semiTotalCountNum ?? '52') ?>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive COA Institutional Depreciation & Salvage Value Calculator -->
        <div class="card shadow-sm mb-4 border-0 bg-light">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 pb-2 border-bottom">
                    <div>
                        <div class="fw-bold text-dark fs-5">
                            <i class="bi bi-calculator text-warning me-2"></i>Institutional Straight-Line Depreciation &amp; Salvage Calculator
                        </div>
                        <div class="small text-muted">
                            COA GAM Appendix 71 compliant: Straight-line method with mandatory 5% residual salvage value.
                        </div>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary mt-2 mt-md-0 fw-bold" onclick="window.printDepreciationScheduleSheet()">
                        <i class="bi bi-printer text-warning me-1"></i>Print Depreciation Schedule (PDF)
                    </button>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <label class="small text-muted fw-bold text-uppercase mb-1">Asset Acquisition Cost (PHP)</label>
                        <div class="input-group">
                            <span class="input-group-text font-monospace fw-bold bg-white">₱</span>
                            <input type="number" id="deprecCostInput" class="form-control font-monospace fw-bold" value="85000" min="1000" step="500" oninput="window.calculateDepreciation()">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="small text-muted fw-bold text-uppercase mb-1">Useful Life Category</label>
                        <select id="deprecLifeSelect" class="form-select fw-semibold" onchange="window.calculateDepreciation()">
                            <option value="5">5 Years (19.00%/yr) - ICT &amp; Office Machines</option>
                            <option value="3">3 Years (31.67%/yr) - Semi-Expendable Equipment</option>
                            <option value="7">7 Years (13.57%/yr) - Communication &amp; AV Equip</option>
                            <option value="10">10 Years (9.50%/yr) - Laboratory &amp; Heavy Machinery</option>
                            <option value="15">15 Years (6.33%/yr) - Motor Vehicles</option>
                            <option value="30">30 Years (3.17%/yr) - Buildings &amp; Structures</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted fw-bold text-uppercase mb-1">COA Residual Salvage Rate</label>
                        <div class="form-control font-monospace text-center fw-bold text-warning bg-warning bg-opacity-10 border-warning border-opacity-25">
                            5.0% Residual Base
                        </div>
                    </div>
                </div>

                <!-- Live Calculated Breakdown Stat Pills -->
                <div class="row g-2 text-center">
                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                        <div class="p-3 bg-white rounded shadow-sm border h-100">
                            <div class="small text-muted text-uppercase fw-bold">5% Salvage Value</div>
                            <div class="h5 fw-bold font-monospace text-warning mb-0" id="calcSalvageVal">₱4,250.00</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                        <div class="p-3 bg-white rounded shadow-sm border h-100">
                            <div class="small text-muted text-uppercase fw-bold">Depreciable Base (95%)</div>
                            <div class="h5 fw-bold font-monospace text-primary mb-0" id="calcBaseVal">₱80,750.00</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white rounded shadow-sm border h-100">
                            <div class="small text-muted text-uppercase fw-bold">Annual Depreciation</div>
                            <div class="h5 fw-bold font-monospace text-success mb-0" id="calcAnnualVal">₱16,150.00 / yr</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white rounded shadow-sm border h-100">
                            <div class="small text-muted text-uppercase fw-bold">Monthly Expense</div>
                            <div class="h5 fw-bold font-monospace text-danger mb-0" id="calcMonthlyVal">₱1,345.83 / mo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COA GAM Classification Matrix Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                <div>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        <i class="bi bi-tags text-warning me-2"></i>COA GAM Asset Classification Schedule &amp; Useful Life Standards
                    </h6>
                    <div class="small text-muted mt-1">Based on COA Circular 2020-006 &amp; Government Accounting Manual for SUCs</div>
                </div>
                <span class="badge bg-warning text-dark px-3 py-1 fw-bold">Sta. Cruz Campus Certified</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="classificationScheduleTable">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">COA GAM Account Code</th>
                                <th class="py-3">Classification Category</th>
                                <th class="py-3">Type</th>
                                <th class="py-3">Useful Life</th>
                                <th class="py-3">Depreciation Rate</th>
                                <th class="py-3">Salvage Value</th>
                                <th class="py-3">Total Assets</th>
                                <th class="py-3">Recorded Value</th>
                                <th class="py-3">Accountability Doc</th>
                                <th class="py-3 text-center">Filter</th>
                            </tr>
                        </thead>
                        <tbody id="classificationTableBody">
                            <?php if (!empty($classificationSchedules)): ?>
                                <?php foreach ($classificationSchedules as $sched): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($sched['account_code']) ?></td>
                                        <td class="fw-semibold"><?= e($sched['category_name']) ?></td>
                                        <td>
                                            <?php if (($sched['type'] ?? '') === 'Capitalized'): ?>
                                                <span class="badge bg-primary">Capitalized PPE</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Semi-Expendable</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= e($sched['useful_life']) ?> Years</td>
                                        <td><?= e($sched['depreciation_rate']) ?>%</td>
                                        <td><?= e($sched['salvage_value_rate'] ?? '5%') ?></td>
                                        <td><strong class="text-dark"><?= e($sched['total_assets']) ?> Units</strong></td>
                                        <td class="font-monospace text-warning fw-bold">₱<?= number_format($sched['recorded_value'] ?? 0, 2) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($sched['accountability_doc']) ?></span></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-warning text-dark" onclick="window.filterByClassificationTier('<?= e($sched['filter_key'] ?? 'ALL') ?>')">
                                                <i class="bi bi-filter"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Populated dynamically by frontend JS or controller array -->
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        Matrix table initialized. Data dynamically populated via asset management engine.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.assetModuleContent -->
</div>