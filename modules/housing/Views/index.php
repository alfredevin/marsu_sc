<!-- MarSU ERP - Accredited Boarding House Management & Directory (ISHAMIS) Dashboard -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-house-check-fill me-2 text-gold"></i>Student Housing & Accommodation (ISHAMIS)
        </h1>
        <p class="text-muted small mb-0">Integrated Student Housing & Accommodation Management Information System — accredited boarding house directory, bed space occupancy, and student welfare monitoring.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/housingapplication') ?>" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="bi bi-file-earmark-plus me-1"></i>Apply for Housing
        </a>
        <a href="<?= url('housing/tenants') ?>" class="btn btn-marsu btn-sm shadow-sm">
            <i class="bi bi-people-fill me-1"></i>Manage Tenants
        </a>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Quick Navigation Categories -->
<div class="row g-2 mb-4">
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/tenants') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-people fs-2 text-marsu-burgundy mb-1"></i>
            <span class="fw-bold text-dark small">Tenants</span>
            <span class="text-muted" style="font-size: 11px;">Directory & Profiles</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/roomandinventory') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-box-seam fs-2 text-gold mb-1"></i>
            <span class="fw-bold text-dark small">Rooms & Inventory</span>
            <span class="text-muted" style="font-size: 11px;">Units & Bed Spaces</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/approvalworkflow') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-check2-circle fs-2 text-success mb-1"></i>
            <span class="fw-bold text-dark small">Approvals</span>
            <span class="text-muted" style="font-size: 11px;">Intake Workflow</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/paymentrecords') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-wallet2 fs-2 text-primary mb-1"></i>
            <span class="fw-bold text-dark small">Billing & Receipts</span>
            <span class="text-muted" style="font-size: 11px;">Rent Collections</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/maintenancerequest') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-tools fs-2 text-warning mb-1"></i>
            <span class="fw-bold text-dark small">Maintenance</span>
            <span class="text-muted" style="font-size: 11px;">Repair Orders</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/announcements') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-megaphone fs-2 text-danger mb-1"></i>
            <span class="fw-bold text-dark small">Bulletins</span>
            <span class="text-muted" style="font-size: 11px;">Curfew & Advisories</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <a href="<?= url('housing/occupancyreports') ?>" class="card text-decoration-none border-0 shadow-sm p-3 text-center h-100 hover-elevate">
            <i class="bi bi-bar-chart-line fs-2 text-info mb-1"></i>
            <span class="fw-bold text-dark small">Analytics</span>
            <span class="text-muted" style="font-size: 11px;">Occupancy Reports</span>
        </a>
    </div>
</div>

<!-- KPI Metrics Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Accredited Houses</div>
                    <div class="h2 font-weight-bold mb-0 text-marsu-burgundy"><?= $stats['total_houses'] ?? 4 ?></div>
                </div>
                <div class="p-3 bg-burgundy-subtle text-marsu-burgundy rounded-circle">
                    <i class="bi bi-building fs-4"></i>
                </div>
            </div>
            <div class="small text-muted mt-2"><i class="bi bi-check-circle-fill text-success me-1"></i>Certified Boac off-campus dorms</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Room Units</div>
                    <div class="h2 font-weight-bold mb-0 text-gold"><?= $stats['total_rooms'] ?? 9 ?></div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-door-open fs-4"></i>
                </div>
            </div>
            <div class="small text-muted mt-2"><i class="bi bi-grid me-1"></i>Single, double & dormitory spaces</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Active Residents</div>
                    <div class="h2 font-weight-bold mb-0 text-primary"><?= $stats['total_tenants'] ?? 4 ?></div>
                </div>
                <div class="p-3 bg-primary-subtle text-primary rounded-circle">
                    <i class="bi bi-person-check fs-4"></i>
                </div>
            </div>
            <div class="small text-muted mt-2"><i class="bi bi-shield-check text-primary me-1"></i>MarSU students on file</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending Applications</div>
                    <div class="h2 font-weight-bold mb-0 text-warning"><?= $stats['total_apps'] ?? 1 ?></div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning-emphasis rounded-circle">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
            <div class="small text-muted mt-2"><i class="bi bi-arrow-right-circle text-warning me-1"></i>Awaiting landlord / OSAS review</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Accredited Facilities Directory -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-patch-check-fill me-2 text-gold"></i>Accredited Boarding Houses Directory (Boac Campus)
                </h5>
                <a href="<?= url('housing/roomandinventory') ?>" class="btn btn-outline-secondary btn-sm">
                    View Inventory <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Boarding House</th>
                                <th>Landlord / Owner</th>
                                <th>Safety Rating</th>
                                <th>Rates Range</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">Villa Marinduque Student Dormitory</div>
                                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>Brgy. Santol, Boac (Walking distance to MarSU)</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Engr. Rogelio Maglacas</div>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i>0917-882-1402</small>
                                </td>
                                <td><span class="badge bg-success-subtle text-success border border-success">Grade A+ (BFP Verified)</span></td>
                                <td><span class="fw-semibold text-marsu-burgundy">₱1,400 - ₱2,200</span></td>
                                <td><span class="badge bg-success"><i class="bi bi-shield-check me-1"></i>Accredited</span></td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('housing/roomandinventory') ?>" class="btn btn-sm btn-outline-secondary py-0 px-2" title="View Rooms">
                                        <i class="bi bi-door-open"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">Greenview Residence & Bed Space</div>
                                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>Brgy. Tanza, Boac (Near MarSU East Gate)</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Mrs. Remedios Montemar</div>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i>0928-334-9011</small>
                                </td>
                                <td><span class="badge bg-success-subtle text-success border border-success">Grade A</span></td>
                                <td><span class="fw-semibold text-marsu-burgundy">₱1,200 - ₱1,800</span></td>
                                <td><span class="badge bg-success"><i class="bi bi-shield-check me-1"></i>Accredited</span></td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('housing/roomandinventory') ?>" class="btn btn-sm btn-outline-secondary py-0 px-2" title="View Rooms">
                                        <i class="bi bi-door-open"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">Sunrise Ladies Dormitory</div>
                                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>Brgy. Murallon, Boac (Town Center)</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Dr. Carmela Villaster</div>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i>0919-672-4455</small>
                                </td>
                                <td><span class="badge bg-success-subtle text-success border border-success">Grade A+ (Biometrics)</span></td>
                                <td><span class="fw-semibold text-marsu-burgundy">₱1,800 - ₱2,500</span></td>
                                <td><span class="badge bg-success"><i class="bi bi-shield-check me-1"></i>Accredited</span></td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('housing/roomandinventory') ?>" class="btn btn-sm btn-outline-secondary py-0 px-2" title="View Rooms">
                                        <i class="bi bi-door-open"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">Boac Pines Boarding House</div>
                                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>Brgy. San Miguel, Boac (Capitol Area)</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Mr. Danilo Larracas</div>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i>0939-112-9988</small>
                                </td>
                                <td><span class="badge bg-warning-subtle text-warning border border-warning">Grade B (Renewal Pending)</span></td>
                                <td><span class="fw-semibold text-marsu-burgundy">₱1,100 - ₱1,600</span></td>
                                <td><span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i>Inspection Scheduled</span></td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('housing/roomandinventory') ?>" class="btn btn-sm btn-outline-secondary py-0 px-2" title="View Rooms">
                                        <i class="bi bi-door-open"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Advisories & Maintenance Work Orders -->
    <div class="col-lg-4">
        <!-- Announcements Feed -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-megaphone me-2 text-gold"></i>Housing Advisories
                </h6>
                <a href="<?= url('housing/announcements') ?>" class="small text-decoration-none">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush small">
                    <?php if (empty($announcements)): ?>
                        <li class="list-group-item text-muted text-center py-3">No active announcements.</li>
                    <?php else: ?>
                        <?php foreach ($announcements as $anc): ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-marsu text-white"><?= e($anc['category']) ?></span>
                                    <span class="text-muted" style="font-size: 11px;"><?= date('M d', strtotime($anc['created_at'])) ?></span>
                                </div>
                                <div class="fw-bold text-dark"><?= e($anc['title']) ?></div>
                                <div class="text-muted text-truncate"><?= e($anc['content']) ?></div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Recent Maintenance Orders -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-tools me-2 text-gold"></i>Maintenance Work Orders
                </h6>
                <a href="<?= url('housing/maintenancerequest') ?>" class="small text-decoration-none">Tickets</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush small">
                    <?php if (empty($recentTickets)): ?>
                        <li class="list-group-item text-muted text-center py-3">No active maintenance work orders.</li>
                    <?php else: ?>
                        <?php foreach ($recentTickets as $rTick): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold text-dark"><?= e($rTick['ticket_number']) ?>: <?= e($rTick['issue_title']) ?></div>
                                    <div class="text-muted"><?= e($rTick['room_number']) ?> • <?= e($rTick['issue_category']) ?></div>
                                </div>
                                <span class="badge <?= $rTick['status'] === 'Resolved' ? 'bg-success' : ($rTick['status'] === 'In Progress' ? 'bg-warning text-dark' : 'bg-primary') ?>">
                                    <?= e($rTick['status']) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.hover-elevate {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-elevate:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.12) !important;
}
</style>