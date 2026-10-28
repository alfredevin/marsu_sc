<?php
/**
 * Facilities Management - Sub-Module 2: Facility Condition Monitoring & Scorecards
 * @var string $moduleName
 * @var array  $kpis             Summary metrics array
 * @var array  $campusSummary    Overall health grades and structural breakdowns
 * @var array  $scorecards       Array of building condition scorecards
 * @var array  $attentionAssets  Array of equipment/fixtures requiring attention
 */
?>
<main class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;" id="fmEyebrow">
                <i class="bi bi-heart-pulse-fill me-1"></i>FACILITIES MANAGEMENT &bull; SUB-MODULE 2
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="fmSubmoduleHeading">
                <?= e($moduleName ?? 'Facility Condition Monitoring & Scorecards') ?>
            </h1>
            <p class="text-muted small mb-0" id="fmSubmoduleSubtext">
                Inspection-based health scorecards per building with structural, electrical, and plumbing ratings.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-warning text-dark btn-sm fw-bold" id="btnHeaderNewRequest" onclick="window.switchMaintenanceSubmodule('repairs'); setTimeout(() => document.getElementById('reqScope').focus(), 150);">
                <i class="bi bi-wrench text-warning me-1"></i>New Repair Request
            </button>
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" id="btnHeaderCreateJob" onclick="window.openJobOrderModal()">
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
                        <div class="h3 fw-bold text-dark font-monospace my-1" id="kpiBuildings">
                            <?= e($kpis['inspected_buildings'] ?? 0) ?> / <?= e($kpis['total_rooms'] ?? 0) ?>
                        </div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-city fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Complete campus coverage</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Facility Health Index</div>
                        <div class="h3 fw-bold text-success font-monospace my-1" id="kpiHealth"><?= e($kpis['health_index'] ?? '0') ?>%</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Optimized structural integrity</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Open Job Orders</div>
                        <div class="h3 fw-bold text-info font-monospace my-1" id="kpiJobs"><?= e($kpis['open_jobs'] ?? 0) ?></div>
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
                        <div class="h3 fw-bold text-danger font-monospace my-1" id="kpiRequests"><?= e($kpis['repair_queue'] ?? 0) ?></div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Requires technical review</div>
            </div>
        </div>
    </section>

    <!-- Module Content -->
    <div id="moduleContent" data-module="condition">
        <!-- Campus summary -->
        <div class="card shadow-sm p-4 mb-4 border-0">
            <div class="row align-items-center g-3">
                <div class="col-lg-4 d-flex align-items-center">
                    <div class="p-4 rounded-circle bg-success bg-opacity-10 text-success fw-bold font-monospace display-6 text-center me-3" style="width: 90px; height: 90px; display: flex; align-items: center; justify-content: center;">
                        <?= e($campusSummary['overall_score'] ?? '0') ?>%
                    </div>
                    <div>
                        <div class="small text-muted text-uppercase fw-bold">Campus Facility Health Index</div>
                        <div class="h5 fw-bold mb-1 text-dark">Grade: <?= e($campusSummary['grade'] ?? 'Satisfactory') ?></div>
                        <div class="small text-muted">70% inspection scores &bull; 30% asset serviceability &bull; open urgent requests deduct points</div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <div class="small text-muted fw-bold">Structural Rating</div>
                                <div class="h6 fw-bold text-success font-monospace mb-0"><?= e($campusSummary['structural'] ?? '0%') ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <div class="small text-muted fw-bold">Electrical Systems</div>
                                <div class="h6 fw-bold text-warning font-monospace mb-0"><?= e($campusSummary['electrical'] ?? '0%') ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <div class="small text-muted fw-bold">Plumbing &amp; Water</div>
                                <div class="h6 fw-bold text-success font-monospace mb-0"><?= e($campusSummary['plumbing'] ?? '0%') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <h2 class="h5 fw-bold text-marsu-burgundy m-0">
                <i class="bi bi-clipboard-data-fill text-warning me-2"></i>Building Condition Scorecards
            </h2>
            <div class="d-flex flex-wrap gap-2">
                <select id="condRatingFilter" class="form-select form-select-sm">
                    <option value="ALL">All Ratings</option>
                    <option value="good">Good (85+)</option>
                    <option value="fair">Fair (70–84)</option>
                    <option value="poor">Poor (55–69)</option>
                    <option value="critical">Critical (&lt;55)</option>
                </select>
                <select id="condSort" class="form-select form-select-sm">
                    <option value="score-asc">Sort: Lowest score first</option>
                    <option value="score-desc">Sort: Highest score first</option>
                    <option value="next">Sort: Next inspection due</option>
                </select>
            </div>
        </div>

        <!-- Building Condition Cards Grid -->
        <div class="row g-3 mb-4" id="facilityConditionGrid">
            <?php if (empty($scorecards)): ?>
                <div class="col-12">
                    <div class="card shadow-sm p-4 border-0 text-center text-muted">
                        <i class="bi bi-journal-x fs-2 d-block mb-2 text-warning"></i>
                        No condition scorecards recorded at this time.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($scorecards as $card): ?>
                    <?php 
                        $score = $card['overall_score'] ?? 0;
                        $status = strtoupper($card['rating_status'] ?? 'FAIR');
                        $badgeClass = ($status === 'GOOD') ? 'bg-success' : (($status === 'POOR' || $status === 'CRITICAL') ? 'bg-danger' : 'bg-warning text-dark');
                        $borderClass = ($score < 60) ? 'border-danger' : (($score < 75) ? 'border-warning' : 'border-success');
                    ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 border-0 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle border border-3 <?= $borderClass ?> d-flex align-items-center justify-content-center fw-bold font-monospace text-dark me-3" style="width: 55px; height: 55px; font-size: 1.1rem; flex-shrink: 0;">
                                    <?= e($score) ?>
                                </div>
                                <div>
                                    <div class="font-monospace text-warning fw-bold small"><?= e($card['building_code']) ?></div>
                                    <h6 class="fw-bold text-marsu-burgundy mb-1"><?= e($card['building_name']) ?></h6>
                                    <span class="badge <?= $badgeClass ?> bg-opacity-10 text-<?= $status === 'GOOD' ? 'success' : ($status === 'POOR' ? 'danger' : 'dark') ?> border small px-2"><?= e($status) ?></span>
                                </div>
                            </div>

                            <!-- Breakdown Progress Bars -->
                            <div class="small mb-3">
                                <?php 
                                    $breakdowns = [
                                        'Structural' => $card['structural'] ?? 0,
                                        'Electrical' => $card['electrical'] ?? 0,
                                        'Plumbing' => $card['plumbing'] ?? 0,
                                        'HVAC' => $card['hvac'] ?? 0,
                                        'Fire Safety' => $card['fire_safety'] ?? 0,
                                        'Sanitation' => $card['sanitation'] ?? 0
                                    ];
                                    foreach ($breakdowns as $label => $val):
                                        $barColor = ($val < 70) ? 'bg-danger' : (($val < 85) ? 'bg-warning' : 'bg-success');
                                ?>
                                    <div class="d-flex justify-content-between mb-1 text-muted">
                                        <span><?= e($label) ?></span>
                                        <span class="fw-bold font-monospace text-dark"><?= e($val) ?></span>
                                    </div>
                                    <div class="progress mb-2" style="height: 6px;"><div class="progress-bar <?= $barColor ?>" style="width: <?= e($val) ?>%;"></div></div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Details & Metadata -->
                            <div class="small text-muted border-top pt-2 mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Assets serviceable</span>
                                    <span class="fw-bold font-monospace text-dark"><?= e($card['serviceable_assets'] ?? '&mdash; (0)') ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Open requests</span>
                                    <span class="fw-bold font-monospace text-danger"><?= e($card['open_requests'] ?? 0) ?></span>
                                </div>
                                <div class="text-dark mb-1"><i class="bi bi-person-fill me-1 text-secondary"></i><?= e($card['inspector_name']) ?> &bull; <?= e($card['inspection_date']) ?></div>
                                <div class="text-dark mb-2"><i class="bi bi-calendar-event me-1 text-secondary"></i>Next inspection: <?= e($card['next_inspection']) ?></div>
                                <div class="p-2 bg-light rounded text-dark small fst-italic border">
                                    <?= e($card['remarks'] ?? 'No inspector notes provided.') ?>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-auto d-flex gap-2 pt-2">
                                <button class="btn btn-warning text-dark btn-sm fw-bold flex-grow-1 shadow-sm py-2" onclick="window.logInspection('<?= e($card['building_code']) ?>')">
                                    <i class="bi bi-journal-check me-1"></i>Log Inspection
                                </button>
                                <button class="btn btn-outline-secondary btn-sm px-3" title="Building Records" onclick="window.viewBuilding('<?= e($card['building_code']) ?>')">
                                    <i class="bi bi-building-fill text-warning"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Assets requiring attention -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h3 class="m-0 fw-bold fs-6 text-marsu-burgundy">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Equipment &amp; Fixtures Requiring Attention
                </h3>
                <span class="badge bg-danger font-monospace" id="attentionCount"><?= count($attentionAssets ?? []) ?> items</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Property No.</th>
                                <th class="py-3">Description</th>
                                <th class="py-3">Location</th>
                                <th class="py-3">Condition</th>
                                <th class="py-3">Book Value</th>
                                <th class="py-3">Last Inspected</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="attentionAssetsBody">
                            <?php if (empty($attentionAssets)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle fs-2 d-block mb-1 text-success"></i>
                                        All equipment and fixtures are fully operational.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($attentionAssets as $item): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($item['property_no']) ?></td>
                                        <td class="fw-semibold text-dark"><?= e($item['description']) ?></td>
                                        <td class="small text-muted"><?= e($item['location']) ?></td>
                                        <td>
                                            <?php 
                                                $cond = $item['condition'] ?? 'Needs Repair';
                                                $badgeBg = (str_contains(strtolower($cond), 'critical')) ? 'bg-danger' : 'bg-warning text-dark';
                                            ?>
                                            <span class="badge <?= $badgeBg ?>"><?= e($cond) ?></span>
                                        </td>
                                        <td class="font-monospace">₱<?= number_format($item['book_value'] ?? 0, 2) ?></td>
                                        <td class="small text-muted"><?= e($item['last_inspected']) ?></td>
                                        <td class="text-center">
                                            <span class="badge text-white font-monospace px-3 py-2 shadow-sm" style="background-color: #17a2b8; border-radius: 8px; cursor: pointer;" onclick="alert('Viewing maintenance <?= e($item['maintenance_ref']) ?>')">
                                                <?= e($item['maintenance_ref']) ?>
                                            </span> 
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
    <!-- /.module-content -->
</main>