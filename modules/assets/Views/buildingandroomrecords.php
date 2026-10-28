<?php
/**
 * Facilities Management - Sub-Module 1: Building & Room Registry
 * @var string $moduleName
 * @var array  $kpis      Array containing summary metrics
 * @var array  $buildings Array of building records
 * @var array  $rooms     Array of room/asset occupancy records
 */
?>
<main class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                Building & Room Registry
            </h1>
            <p class="text-muted small mb-0">
                Master registry of campus buildings, rooms, floor areas, and tagged asset occupancy per room.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-warning text-dark btn-sm fw-bold" onclick="window.switchMaintenanceSubmodule('repairs');">
                <i class="bi bi-wrench text-warning me-1"></i>New Repair Request
            </button>
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" onclick="window.openJobOrderModal()">
                <i class="bi bi-plus-circle me-1"></i>Create Job Order
            </button>
        </div>
    </div>

    <!-- Facilities KPI Row -->
    <section class="row g-3 mb-4" aria-label="Facilities key indicators">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Buildings &amp; Rooms</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1">
                            <?= e($kpis['active_buildings'] ?? 0) ?> / <?= e($kpis['total_rooms'] ?? 0) ?>
                        </div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-city fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">
                    <?= e($kpis['building_count'] ?? 0) ?> buildings &bull; <?= e($kpis['total_rooms'] ?? 0) ?> rooms &bull; <?= e($kpis['total_area'] ?? '0') ?> m²
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Facility Health Index</div>
                        <div class="h3 fw-bold text-success font-monospace my-1"><?= e($kpis['health_index'] ?? '0') ?>%</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2 d-flex align-items-center gap-1">
                    <span class="badge bg-warning text-dark" style="font-size: 0.65rem;">FAIR</span> 
                    <?= e($kpis['fair_buildings_count'] ?? 0) ?> building(s) below 70
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Open Job Orders</div>
                        <div class="h3 fw-bold text-info font-monospace my-1"><?= e($kpis['open_jobs'] ?? 0) ?></div>
                    </div>
                    <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                        <i class="bi bi-clipboard-check-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">In progress by maintenance unit</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-danger p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold text-danger">Open Repair Queue</div>
                        <div class="h3 fw-bold text-danger font-monospace my-1"><?= e($kpis['repair_queue'] ?? 0) ?></div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Requires technical review</div>
            </div>
        </div>
    </section>

    <!-- Search Toolbar -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h2 class="h5 fw-bold text-marsu-burgundy m-0">
            <i class="bi bi-building-fill text-warning me-2"></i>Campus Building Registry
        </h2>
        <div class="w-auto">
            <input type="search" id="bldSearch" class="form-control form-control-sm" placeholder="Search building, code, or room...">
        </div>
    </div>

    <!-- Building Registry Cards Grid -->
    <div class="row g-3 mb-4" id="buildingsListCards">
        <?php if (empty($buildings)): ?>
            <div class="col-12">
                <div class="card shadow-sm border-0 p-4 text-center text-muted">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-warning"></i>
                    No campus buildings found in the registry.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($buildings as $bld): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 overflow-hidden">
                        <div class="p-3 text-white" style="background: linear-gradient(135deg, var(--marsu-burgundy, #7B1E2B) 0%, #4A121A 100%);">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="font-weight-bold font-monospace text-warning small" style="letter-spacing: 0.05em;"><?= e($bld['code']) ?></span>
                                <span class="badge bg-<?= ($bld['rating_status'] ?? 'GOOD') === 'GOOD' ? 'success' : 'warning' ?> bg-opacity-75 text-white" style="font-size: 0.65rem;">
                                    <?= e($bld['health_score'] ?? '85') ?> &bull; <?= e($bld['rating_status'] ?? 'GOOD') ?>
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1 text-white"><?= e($bld['name']) ?></h5>
                            <p class="small text-light opacity-75 mb-0"><?= e($bld['category'] ?? 'General Offices') ?></p>
                        </div>
                        <div class="card-body bg-white p-3">
                            <div class="row g-2 small text-muted mb-3 border-bottom pb-3">
                                <div class="col-6">
                                    <span class="d-block text-uppercase" style="font-size: 0.65rem;">Year Built</span>
                                    <span class="fw-bold text-dark font-monospace"><?= e($bld['year_built']) ?></span>
                                </div>
                                <div class="col-6">
                                    <span class="d-block text-uppercase" style="font-size: 0.65rem;">Floors</span>
                                    <span class="fw-bold text-dark font-monospace"><?= e($bld['floors']) ?></span>
                                </div>
                                <div class="col-6 mt-2">
                                    <span class="d-block text-uppercase" style="font-size: 0.65rem;">Gross Area</span>
                                    <span class="fw-bold text-dark font-monospace"><?= number_format($bld['gross_area'] ?? 0) ?> m²</span>
                                </div>
                                <div class="col-6 mt-2">
                                    <span class="d-block text-uppercase" style="font-size: 0.65rem;">In-Charge</span>
                                    <span class="fw-bold text-dark text-truncate d-block"><?= e($bld['in_charge']) ?></span>
                                </div>
                                <div class="col-12 mt-2">
                                    <span class="d-block text-uppercase" style="font-size: 0.65rem;">Structure</span>
                                    <span class="fw-bold text-dark"><?= e($bld['structure']) ?></span>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="row g-2 text-center mb-3">
                                <div class="col-3">
                                    <div class="p-2 border rounded bg-light">
                                        <div class="fw-bold text-dark font-monospace"><?= e($bld['room_count'] ?? 0) ?></div>
                                        <div class="text-muted" style="font-size: 0.6rem;">ROOMS</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="p-2 border rounded bg-light">
                                        <div class="fw-bold text-dark font-monospace"><?= e($bld['asset_count'] ?? 0) ?></div>
                                        <div class="text-muted" style="font-size: 0.6rem;">ASSETS</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="p-2 border rounded bg-light">
                                        <div class="fw-bold text-dark font-monospace" style="font-size: 0.8rem;">₱<?= number_format(($bld['total_asset_value'] ?? 0) / 1000000, 2) ?>M</div>
                                        <div class="text-muted" style="font-size: 0.6rem;">VALUE</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="p-2 border rounded bg-light">
                                        <div class="fw-bold text-danger font-monospace"><?= e($bld['open_requests_count'] ?? 0) ?></div>
                                        <div class="text-muted" style="font-size: 0.6rem;">OPEN REQ.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Pills -->
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                <?php if (!empty($bld['rooms_list'])): ?>
                                    <?php foreach ($bld['rooms_list'] as $roomCode): ?>
                                        <span class="badge bg-light text-dark border font-monospace px-2 py-1"><?= e($roomCode) ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button class="btn btn-warning text-dark btn-sm fw-bold flex-grow-1 py-2 shadow-sm" onclick="window.viewBuildingRooms('<?= e($bld['code']) ?>')">
                                    <i class="bi bi-door-open-fill me-1"></i>Room Records
                                </button>
                                <button class="btn btn-outline-secondary btn-sm px-3" title="Settings / Wrench" onclick="window.editBuilding('<?= e($bld['code']) ?>')">
                                    <i class="bi bi-wrench"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm px-3" title="Clipboard" onclick="window.viewBuildingLogs('<?= e($bld['code']) ?>')">
                                    <i class="bi bi-clipboard-check"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Room Directory & Asset Occupancy Table -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center border-bottom gap-2">
            <h3 class="m-0 fw-bold fs-6 text-marsu-burgundy">
                <i class="bi bi-door-closed-fill text-warning me-2"></i>Room Directory &amp; Asset Occupancy
            </h3>
            <div class="d-flex flex-wrap gap-2">
                <select id="roomBldFilter" class="form-select form-select-sm">
                    <option value="ALL">All Buildings</option>
                    <?php foreach ($buildings as $bld): ?>
                        <option value="<?= e($bld['code']) ?>"><?= e($bld['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="search" id="roomSearch" class="form-control form-control-sm" placeholder="Filter rooms...">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="roomDirectoryTable">
                    <thead class="table-marsu bg-marsu-burgundy text-white">
                        <tr>
                            <th class="py-3">Building</th>
                            <th class="py-3">Room Code</th>
                            <th class="py-3">Room / Function</th>
                            <th class="py-3 text-center">Tagged Assets</th>
                            <th class="py-3">Asset Value</th>
                            <th class="py-3 text-center">Needs Attention</th>
                            <th class="py-3 text-center">Open Requests</th>
                            <th class="py-3">Room Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rooms)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                    No rooms found in the registry.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rooms as $room): ?>
                                <tr>
                                    <td class="text-dark"><?= e($room['building_name']) ?></td>
                                    <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($room['room_code']) ?></td>
                                    <td class="fw-semibold text-dark"><?= e($room['room_function']) ?></td>
                                    <td class="text-center font-monospace"><?= e($room['tagged_assets_count'] ?? 0) ?></td>
                                    <td class="font-monospace">₱<?= number_format($room['asset_value'] ?? 0, 2) ?></td>
                                    <td class="text-center">
                                        <?php if (($room['needs_attention'] ?? 0) > 0): ?>
                                            <span class="badge bg-danger"><?= e($room['needs_attention']) ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-success">0</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center font-monospace"><?= e($room['open_requests_count'] ?? 0) ?></td>
                                    <td>
                                        <?php 
                                            $status = $room['status'] ?? 'Operational';
                                            $badgeClass = ($status === 'Operational') ? 'bg-success' : 'bg-warning text-dark';
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= e($status) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>