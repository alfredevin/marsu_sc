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
                    Official institutional supplies registry, live stock-on-hand monitoring, reorder threshold alerts, and electronic Stock Card ledgers (GAM Appendix 58).
                </p>
            </div>
            <div>
                <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm" id="invSubmoduleBadge">
                    <i class="bi bi-award-fill text-dark me-1"></i>Master Catalog
                </span>
            </div>
        </div>
    </div>

    <!-- Standalone module content -->
    <div id="moduleContent" data-module="inventory">
        
        <!-- Quick Metrics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Registered SKUs</div>
                            <div class="h3 fw-bold text-dark font-monospace my-1" id="catTotalSkus">
                                <?= e($totalSkus ?? '18 SKUs') ?>
                            </div>
                        </div>
                        <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-boxes fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        <i class="bi bi-layers-fill text-warning me-1"></i><?= e($campusCategoriesCount ?? '5 Functional Campus Categories') ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-success p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Stockroom Valuation</div>
                            <div class="h3 fw-bold font-monospace text-success my-1" id="catTotalValue">
                                <?= e($stockroomValuation ?? '₱486,240.00') ?>
                            </div>
                        </div>
                        <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        <i class="bi bi-check-circle-fill text-success me-1"></i>GAM Historical Acquisition Cost
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-primary p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Stock Sufficiency Rate</div>
                            <div class="h3 fw-bold font-monospace text-primary my-1" id="catAdequateCount">
                                <?= e($adequateCount ?? '16 SKUs') ?>
                            </div>
                        </div>
                        <div class="p-2 rounded bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-shield-fill-check fs-4"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-bold text-dark">88.9% Safe Buffer</span>
                            <span class="text-warning font-monospace">16/18</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 88.9%;" aria-valuenow="88.9" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-danger p-3 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold text-danger">Reorder Required</div>
                            <div class="h3 fw-bold font-monospace text-danger my-1" id="catReorderCount">
                                <?= e($reorderCount ?? '2 Items') ?>
                            </div>
                        </div>
                        <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="small mt-2">
                        <a href="#alerts" onclick="window.switchInventorySubmodule('alerts'); return false;" class="text-danger fw-bold text-decoration-none">
                            <i class="bi bi-arrow-right me-1"></i>Review Restock List &bull; 1 Stockout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Category Filter Chips -->
        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-sm btn-warning text-dark fw-bold active" onclick="window.filterCatalogByChip('ALL', this)">
                <i class="bi bi-grid-fill me-1"></i>All Categories (18)
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary fw-semibold" onclick="window.filterCatalogByChip('Office Supplies', this)">
                <i class="bi bi-paperclip me-1"></i>Office Supplies (5)
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary fw-semibold" onclick="window.filterCatalogByChip('IT Consumables', this)">
                <i class="bi bi-laptop me-1"></i>IT Consumables (5)
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary fw-semibold" onclick="window.filterCatalogByChip('Science Consumables', this)">
                <i class="bi bi-eyedropper me-1"></i>Science &amp; Lab (2)
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary fw-semibold" onclick="window.filterCatalogByChip('Janitorial & Health', this)">
                <i class="bi bi-heart-pulse me-1"></i>Janitorial &amp; Health (2)
            </button>
        </div>

        <!-- Filter Toolbar Card -->
        <div class="card shadow-sm p-3 mb-4 border-0">
            <div class="row align-items-center g-2">
                <div class="col-lg-5 col-md-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-warning"></i></span>
                        <input type="search" id="catalogSearchInput" class="form-control border-start-0 ps-0" placeholder="Search by stock number, item name, specification..." aria-label="Search catalog">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <select id="filterCatalogCategory" class="form-select">
                        <option value="ALL">All Categories</option>
                        <option value="Office Supplies">Office Supplies</option>
                        <option value="IT Consumables">IT Consumables</option>
                        <option value="Science Consumables">Science &amp; Laboratory</option>
                        <option value="Janitorial & Health">Janitorial &amp; Health</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4">
                    <select id="filterCatalogStatus" class="form-select">
                        <option value="ALL">All Stock Levels</option>
                        <option value="Available">Available (Normal)</option>
                        <option value="Reorder Needed">Reorder Needed (Low)</option>
                        <option value="Out of Stock">Out of Stock (Zero)</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <button class="btn btn-outline-success btn-sm w-100 fw-bold" onclick="window.exportCatalogCSV()">
                        <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i>Export CSV
                    </button>
                </div>
            </div>
        </div>

        <!-- Master Catalog Table Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-boxes text-warning fs-5"></i>
                    <h6 class="m-0 fw-bold text-marsu-burgundy">
                        Campus Stockroom Master Inventory Records
                    </h6>
                    <span class="badge bg-warning text-dark ms-2 font-monospace" style="font-size: 0.7rem;">GAM Appendix 58 Compliant</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addStockModal">
                        <i class="bi bi-plus-circle me-1"></i>Delivery Intake
                    </button>
                    <span class="small text-muted font-monospace" id="catalogCountDisplay">Showing <?= count($inventoryItems ?? []) ?> items</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Stock No.</th>
                                <th class="py-3">Category</th>
                                <th class="py-3">Item Description &amp; Specifications</th>
                                <th class="py-3">Unit</th>
                                <th class="py-3">Stock On Hand &amp; Buffer Meter</th>
                                <th class="py-3">Reorder Pt</th>
                                <th class="py-3">Unit Cost</th>
                                <th class="py-3">Total Valuation</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Quick Actions</th>
                            </tr>
                        </thead>
                        <tbody id="catalogTableBody">
                            <?php if (!empty($inventoryItems)): ?>
                                <?php foreach ($inventoryItems as $item): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($item['stock_number']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($item['category']) ?></span></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($item['item_name']) ?></div>
                                            <div class="small text-muted"><?= e($item['specifications']) ?></div>
                                        </td>
                                        <td><?= e($item['unit']) ?></td>
                                        <td>
                                            <div class="font-monospace fw-bold text-dark"><?= e($item['stock_on_hand']) ?></div>
                                            <div class="progress mt-1" style="height: 4px; width: 80px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="font-monospace"><?= e($item['reorder_point']) ?></td>
                                        <td class="font-monospace">₱<?= number_format($item['unit_cost'], 2) ?></td>
                                        <td class="font-monospace fw-bold text-warning">₱<?= number_format($item['total_valuation'], 2) ?></td>
                                        <td>
                                            <?php if (($item['status'] ?? '') === 'Available'): ?>
                                                <span class="badge bg-success">Available</span>
                                            <?php elseif (($item['status'] ?? '') === 'Reorder Needed'): ?>
                                                <span class="badge bg-warning text-dark">Low Stock</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Out of Stock</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing stock card for #<?= e($item['id']) ?>')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No inventory records found. Click "Delivery Intake" to add stock supplies.
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