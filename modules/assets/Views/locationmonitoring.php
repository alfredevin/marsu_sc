<div class="container-fluid px-0">
    <!-- Page Header & Action Buttons -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-map-fill me-1"></i>Sta. Cruz Campus Asset Tracking Sub-Module
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Location Monitoring &amp; Real-Time Campus Asset Tracking') ?>
            </h1>
            <p class="text-muted small mb-0">
                Live room-level telemetry, building asset occupancy breakdown, inter-facility transfer logs, and misplaced asset detection.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#relocateAssetModal">
                <i class="bi bi-people-fill me-1"></i>Relocate / Move Asset
            </button>
            <button class="btn btn-outline-warning text-dark btn-sm fw-bold" onclick="window.openGlobalQrScanner()">
                <i class="bi bi-qr-code text-warning me-1"></i>Scan Room QR
            </button>
            <button class="btn btn-outline-warning text-dark btn-sm fw-bold" onclick="openRoomPlacardModal()">
                <i class="bi bi-printer text-warning me-1"></i>Room Inventory Placard
            </button>
            <button class="btn btn-outline-success btn-sm fw-bold" onclick="exportLocationLedgerCSV()">
                <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i>Export CSV
            </button>
        </div>
    </div>

    <!-- Top Location KPI Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small fw-bold text-gold text-uppercase mb-1">Total Assets</div>
                        <div class="h4 mb-0 fw-bold font-monospace text-dark" id="kpiTotalAssets"><?= e($totalAssetsCount ?? '130') ?></div>
                        <div class="small text-muted fw-bold mt-1" style="font-size: 0.72rem;">7 Buildings &bull; 26 Rooms</div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-boxes fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl col-md-4 col-sm-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small fw-bold text-success text-uppercase mb-1">
                            <span class="spinner-grow spinner-grow-sm text-success me-1" role="status"></span>In Assigned Room
                        </div>
                        <div class="h4 mb-0 fw-bold text-success font-monospace" id="kpiInPlace"><?= e($inPlaceCount ?? '124') ?></div>
                        <div class="small text-muted fw-bold mt-1" style="font-size: 0.72rem;" id="kpiInPlacePct">95.4% Stationed Correctly</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl col-md-4 col-sm-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small fw-bold text-info text-uppercase mb-1">Off-Campus</div>
                        <div class="h4 mb-0 fw-bold text-info font-monospace" id="kpiOffCampus"><?= e($offCampusCount ?? '2') ?></div>
                        <div class="small text-muted fw-bold mt-1" style="font-size: 0.72rem;">Active Gate Pass</div>
                    </div>
                    <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                        <i class="bi bi-truck fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl col-md-4 col-sm-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small fw-bold text-warning text-uppercase mb-1">In-Transit</div>
                        <div class="h4 mb-0 fw-bold text-warning font-monospace" id="kpiInTransit"><?= e($inTransitCount ?? '1') ?></div>
                        <div class="small text-muted fw-bold mt-1" style="font-size: 0.72rem;">Transfer in Progress</div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-box-arrow-right fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl col-md-4 col-sm-6">
            <div class="card shadow-sm border-danger p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small fw-bold text-danger text-uppercase mb-1">
                            <span class="spinner-grow spinner-grow-sm text-danger me-1" role="status"></span>Misplaced Alerts
                        </div>
                        <div class="h4 mb-0 fw-bold text-danger font-monospace" id="kpiMisplaced"><?= e($misplacedCount ?? '1') ?></div>
                        <div class="small text-muted fw-bold mt-1" style="font-size: 0.72rem;">Verify location</div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Campus Building Facility Directory Cards -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center border-bottom">
            <div>
                <h6 class="m-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-buildings-fill text-warning me-2"></i>Sta. Cruz Campus Buildings Directory &amp; Occupancy Heatmap
                </h6>
                <div class="small text-muted mt-1">Click any building card to drill down into its individual rooms and stationed equipment.</div>
            </div>
            <div class="mt-2 mt-sm-0">
                <button class="btn btn-sm btn-outline-secondary fw-bold" onclick="selectAllBuildings()">
                    <i class="bi bi-grid-3x3-gap-fill text-warning me-1"></i>Show All Campus Facilities
                </button>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row g-3" id="buildingsGridContainer">
                <!-- Dynamically populated with 7 building cards -->
            </div>
        </div>
    </div>

    <!-- Room Density Drilldown Selector -->
    <div class="card shadow-sm mb-4 border-0" id="roomSelectorCard">
        <div class="card-header py-2 px-3 d-flex justify-content-between align-items-center bg-light border-bottom">
            <div class="d-flex align-items-center">
                <i class="bi bi-door-open-fill text-warning me-2"></i>
                <span class="fw-bold small text-uppercase text-dark" id="selectedBuildingLabel">All Facilities &bull; 26 Campus Rooms</span>
            </div>
            <span class="badge bg-warning text-dark px-2.5 py-1 font-monospace" id="selectedBuildingAssetCountBadge">130 Total Assets</span>
        </div>
        <div class="card-body p-3">
            <div class="d-flex flex-wrap gap-2" id="roomChipsContainer">
                <!-- Dynamically populated with room chips -->
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar Card -->
    <div class="card shadow-sm p-3 mb-4 border-0">
        <div class="row align-items-center g-2">
            <div class="col-lg-3 col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-warning"></i></span>
                    <input type="search" id="locSearchInput" class="form-control border-start-0 ps-0" placeholder="Search property no, SN, asset, room, custodian...">
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <select id="filterBuildingSelect" class="form-select" onchange="handleBuildingDropdownChange(this.value)">
                    <option value="ALL">All Campus Buildings</option>
                    <option value="BLD-IS">BLD-IS (Information Systems)</option>
                    <option value="BLD-ADM">BLD-ADM (Administration)</option>
                    <option value="BLD-EDU">BLD-EDU (Teacher Education)</option>
                    <option value="BLD-SCI">BLD-SCI (Science Research)</option>
                    <option value="BLD-LIB">BLD-LIB (Campus Library)</option>
                    <option value="BLD-GYM">BLD-GYM (Gymnasium Complex)</option>
                    <option value="BLD-GSD">BLD-GSD (General Services)</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4">
                <select id="filterRoomSelect" class="form-select">
                    <option value="ALL">All Rooms</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4">
                <select id="filterCategorySelect" class="form-select">
                    <option value="ALL">All Categories</option>
                    <option value="IT">IT &amp; Computing</option>
                    <option value="OFF">Office Equipment</option>
                    <option value="AC">Air Conditioning / HVAC</option>
                    <option value="Semi-Expendable">Semi-Expendable</option>
                    <option value="Heavy Equipment">Heavy Equipment</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4">
                <select id="filterStatusSelect" class="form-select">
                    <option value="ALL">All Location Statuses</option>
                    <option value="In-Place">In Assigned Room</option>
                    <option value="Off-Campus">Off-Campus (Gate Pass)</option>
                    <option value="In-Transit">In-Transit / Relocating</option>
                    <option value="Misplaced">Misplaced / Flagged Alert</option>
                </select>
            </div>

            <div class="col-lg-1 col-md-12">
                <button class="btn btn-outline-secondary w-100" title="Reset Filters" onclick="resetAllFilters()">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Master Asset Location Table Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center border-bottom">
            <h6 class="m-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-geo-fill text-warning me-2"></i>Live Asset Location Register &bull; Sta. Cruz Campus
            </h6>
            <div class="small text-muted mt-2 mt-sm-0 font-monospace">
                Showing <strong class="text-warning" id="showingCount">0</strong> of <strong class="text-dark" id="totalAssetsCount">0</strong> Assets
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu bg-marsu-burgundy text-white">
                        <tr>
                            <th class="py-3">Property No / QR</th>
                            <th class="py-3">Asset Description &amp; Serial</th>
                            <th class="py-3">Category</th>
                            <th class="py-3">Assigned Building &amp; Room</th>
                            <th class="py-3">Accountable Custodian</th>
                            <th class="py-3">Location Status</th>
                            <th class="py-3">Last Verified</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="locationTableBody">
                        <?php if (!empty($locationRecords)): ?>
                            <?php foreach ($locationRecords as$loc): ?>
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($loc['property_no']) ?></td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= e($loc['asset_description']) ?></div>
                                        <div class="small text-muted font-monospace">SN: <?= e($loc['serial_no'] ?? 'N/A') ?></div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?= e($loc['category']) ?></span></td>
                                    <td class="small fw-semibold text-dark"><?= e($loc['building_room']) ?></td>
                                    <td class="small text-muted"><?= e($loc['custodian']) ?></td>
                                    <td>
                                        <?php if (($loc['status'] ?? '') === 'In-Place'): ?>
                                            <span class="badge bg-success">In Assigned Room</span>
                                        <?php elseif (($loc['status'] ?? '') === 'Off-Campus'): ?>
                                            <span class="badge bg-info text-dark">Off-Campus</span>
                                        <?php elseif (($loc['status'] ?? '') === 'In-Transit'): ?>
                                            <span class="badge bg-warning text-dark">In-Transit</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Misplaced</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="small text-muted"><?= e($loc['last_verified']) ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing location record #<?= e($loc['id']) ?>')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                    No location telemetry records found. Data is populated dynamically from campus asset trackers.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-2 px-3 d-flex justify-content-between align-items-center bg-white border-top">
            <span class="small text-muted">All physical assets are catalogued and verified under Sta. Cruz Campus property repository.</span>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-secondary" id="prevPageBtn"><i class="bi bi-chevron-left me-1"></i>Prev</button>
                <button class="btn btn-outline-warning text-dark fw-bold active font-monospace" id="pageNumberDisplay">Page 1</button>
                <button class="btn btn-outline-secondary" id="nextPageBtn">Next<i class="bi bi-chevron-right ms-1"></i></button>
            </div>
        </div>
    </div>

    <!-- Location Transfer History / Movement Audit Log Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h6 class="m-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-clock-history text-warning me-2"></i>Recent Facility Reallocations &amp; Inter-Room Movement Trail
            </h6>
            <span class="badge bg-warning text-dark font-monospace" style="font-size: 0.7rem;">COA Audit Compliance Trail</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu bg-marsu-burgundy text-white">
                        <tr>
                            <th class="py-3">Timestamp</th>
                            <th class="py-3">Property Number</th>
                            <th class="py-3">Previous Station</th>
                            <th class="py-3">New Destination</th>
                            <th class="py-3">Reason / Justification</th>
                            <th class="py-3">Authorizing Officer</th>
                        </tr>
                    </thead>
                    <tbody id="transferLogsTableBody">
                        <?php if (!empty($transferLogs)): ?>
                            <?php foreach ($transferLogs as$log): ?>
                                <tr>
                                    <td class="small text-muted"><?= e($log['timestamp']) ?></td>
                                    <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($log['property_no']) ?></td>
                                    <td class="small text-muted"><?= e($log['previous_station']) ?></td>
                                    <td class="small fw-semibold text-dark"><?= e($log['new_destination']) ?></td>
                                    <td class="small text-muted"><?= e($log['reason']) ?></td>
                                    <td class="small"><?= e($log['authorizing_officer']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                    No facility transfer logs recorded.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
