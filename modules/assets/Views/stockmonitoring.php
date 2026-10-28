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
                    Real-time bin locations, warehouse turnover metrics, shelf capacity monitoring, and supply burn rates across all campus storage hubs.
                </p>
            </div>
            <div>
                <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm" id="invSubmoduleBadge">
                    <i class="bi bi-award-fill text-dark me-1"></i>Stock Monitoring
                </span>
            </div>
        </div>
    </div>

    <!-- Standalone module content -->
    <div id="moduleContent" data-module="stock">
        
        <!-- Stock Velocity & Health KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Monthly Consumption Velocity</div>
                            <div class="h3 fw-bold font-monospace text-dark my-1"><?= e($monthlyVelocity ?? '340 Units/mo') ?></div>
                        </div>
                        <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-speedometer2 fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-success mt-2">
                        <i class="bi bi-arrow-up-right me-1"></i><?= e($velocityChange ?? '12% increase vs prior academic term') ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-success p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Stock Reconciliation Rate</div>
                            <div class="h3 fw-bold text-success font-monospace my-1">100.0%</div>
                        </div>
                        <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                            <i class="bi bi-check-all fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        <i class="bi bi-check-circle-fill text-success me-1"></i>Zero variance on Q3 physical count
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-info p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Average Days of Inventory</div>
                            <div class="h3 fw-bold font-monospace text-dark my-1"><?= e($avgDaysInventory ?? '28.4 Days') ?></div>
                        </div>
                        <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-info mt-2">
                        <i class="bi bi-info-circle me-1"></i>Healthy turnover benchmark
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-primary p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Active Storage Locations</div>
                            <div class="h3 fw-bold font-monospace text-dark my-1"><?= e($activeLocations ?? '14 Bins') ?></div>
                        </div>
                        <div class="p-2 rounded bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-geo-alt-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-warning fw-semibold mt-2">
                        <i class="bi bi-building me-1"></i>Across 4 Campus Facilities
                    </div>
                </div>
            </div>
        </div>

        <!-- Storage Facility Bays Interactive Grid -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold m-0 text-dark" style="font-size: 0.92rem;">
                    <i class="bi bi-warehouse text-warning me-1"></i>Campus Physical Storage Bays &amp; Facility Allocations
                </h6>
                <span class="small text-muted">Click a bay to filter shelf items below</span>
            </div>
            <div class="row g-3">
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 border-2 border-warning shadow-sm cursor-pointer active" id="bay-all" onclick="window.filterStockByBay('ALL', this)">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-warning small"><i class="bi bi-grid-3x3-gap-fill me-1"></i>All Storage Areas</span>
                            <span class="badge bg-warning text-dark font-monospace">14 Bins</span>
                        </div>
                        <div class="small text-muted">Complete stockroom coverage</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 shadow-sm cursor-pointer border" id="bay-a" onclick="window.filterStockByBay('Stockroom', this)">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark small"><i class="bi bi-archive-fill text-warning me-1"></i>Stockroom Bay A &amp; B</span>
                            <span class="badge bg-secondary font-monospace">5 Bins</span>
                        </div>
                        <div class="small text-muted">Paper, writing &amp; office supplies</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 shadow-sm cursor-pointer border" id="bay-it" onclick="window.filterStockByBay('Tech Cage', this)">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark small"><i class="bi bi-hdd-rack-fill text-info me-1"></i>Tech Cage IT-01</span>
                            <span class="badge bg-secondary font-monospace">4 Bins</span>
                        </div>
                        <div class="small text-muted">Ink bottles, toners, peripherals</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 shadow-sm cursor-pointer border" id="bay-lab" onclick="window.filterStockByBay('Lab', this)">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark small"><i class="bi bi-eyedropper text-success me-1"></i>Science Lab Lock C</span>
                            <span class="badge bg-secondary font-monospace">3 Bins</span>
                        </div>
                        <div class="small text-muted">Reagents, glassware, gloves</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Monitoring Matrix Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        <i class="bi bi-pie-chart-fill text-warning me-2"></i>Stock Movement Velocity &amp; Shelf Location Monitoring
                    </h6>
                    <div class="small text-muted mt-1">Live tracking of monthly consumption velocity, days of stock remaining, and bin allocations</div>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-secondary fw-bold" onclick="window.renderStockMonitoringTable()">
                        <i class="bi bi-arrow-clockwise text-warning me-1"></i>Refresh
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Stock No. &amp; Item Details</th>
                                <th class="py-3">Storage Shelf / Bin</th>
                                <th class="py-3">Avg. Monthly Consumption</th>
                                <th class="py-3">Safety Buffer</th>
                                <th class="py-3">Days of Stock Left</th>
                                <th class="py-3">Demand Velocity</th>
                                <th class="py-3">Audit Status</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="stockMonitoringTableBody">
                            <?php if (!empty($stockMonitoringItems)): ?>
                                <?php foreach ($stockMonitoringItems as $row): ?>
                                    <tr>
                                        <td>
                                            <div class="font-monospace fw-bold text-marsu-burgundy"><?= e($row['stock_number']) ?></div>
                                            <div class="small text-dark fw-semibold"><?= e($row['item_name']) ?></div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= e($row['shelf_bin']) ?></span>
                                        </td>
                                        <td class="font-monospace"><?= e($row['monthly_consumption']) ?></td>
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success"><?= e($row['safety_buffer']) ?></span>
                                        </td>
                                        <td class="font-monospace fw-bold text-warning"><?= e($row['days_left']) ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= e($row['demand_velocity']) ?></span>
                                        </td>
                                        <td>
                                            <?php if (($row['audit_status'] ?? '') === 'Verified'): ?>
                                                <span class="badge bg-success">Verified</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><?= e($row['audit_status'] ?? 'Pending') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing stock log for #<?= e($row['id']) ?>')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No stock monitoring records available. Data populated dynamically via warehouse inventory engine.
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