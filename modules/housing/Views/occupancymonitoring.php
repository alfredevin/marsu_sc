<!-- Occupancy Monitoring View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-pie-chart-fill me-2 text-gold"></i>Occupancy Monitoring & Demographics
        </h1>
        <p class="text-muted small mb-0">Campus-wide occupancy rates, capacity thresholds, male/female distribution, and compliance monitoring across boarding houses.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/occupancyreports') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-file-earmark-bar-graph me-1"></i>Occupancy Reports
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Summary
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-box-seam me-1"></i>Room & Inventory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/availabilitytracking') ?>">
                <i class="bi bi-calendar-check me-1"></i>Availability Tracking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/roomassignment') ?>">
                <i class="bi bi-door-open me-1"></i>Room Assignments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/occupancymonitoring') ?>">
                <i class="bi bi-pie-chart me-1"></i>Occupancy Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-grid-3x3 me-1"></i>Bed Allocation
            </a>
        </li>
    </ul>
</div>

<!-- Occupancy Metric Progress Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">University Occupancy</div>
                    <div class="kpi-value text-marsu-burgundy">
                        78.0%
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Overall Occupancy">
                    <i class="bi bi-pie-chart-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-people-fill text-marsu-burgundy"></i>
                <span>64 of 82 beds occupied</span>
            </div>
            <div class="progress mt-2" style="height: 6px;">
                <div class="progress-bar bg-marsu" style="width: 78%;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Female Residents</div>
                    <div class="kpi-value text-success">
                        38
                        <span class="kpi-unit">Students</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Female Residents">
                    <i class="bi bi-gender-female"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-pie-chart text-success"></i>
                <span>59.4% of total population</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Male Residents</div>
                    <div class="kpi-value text-gold">
                        26
                        <span class="kpi-unit">Students</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Male Residents">
                    <i class="bi bi-gender-male"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-pie-chart text-gold-dark"></i>
                <span>40.6% of total population</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Critical Thresholds</div>
                    <div class="kpi-value text-success">
                        0
                        <span class="kpi-unit">Overcrowded</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Critical Safety Thresholds">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-patch-check-fill text-success"></i>
                <span>100% within fire code limits</span>
            </div>
        </div>
    </div>
</div>

<!-- Occupancy by Boarding House Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-building me-2 text-gold"></i>Accredited Facility Occupancy Breakdown
        </h6>
        <span class="badge bg-light text-dark border">Academic Year 2026-2027</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Boarding House Facility</th>
                        <th>Owner / Landlord</th>
                        <th>Total Rooms</th>
                        <th>Capacity (Beds)</th>
                        <th>Current Residents</th>
                        <th>Occupancy Level</th>
                        <th class="text-end pe-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Villa Marinduque Student Dorm</div>
                            <div class="small text-muted">Brgy. Santol, Boac • Female Dorm</div>
                        </td>
                        <td>Engr. Roberto M. Santos</td>
                        <td>8 Rooms</td>
                        <td>24 Beds</td>
                        <td><span class="fw-bold text-dark">20 Residents</span></td>
                        <td style="min-width: 150px;">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>83.3%</span>
                                <span class="text-muted">4 Free</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 83.3%;"></div>
                            </div>
                        </td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success">High Demand</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Greenview Boarding House</div>
                            <div class="small text-muted">Brgy. Mansalay, Boac • Co-ed</div>
                        </td>
                        <td>Mrs. Corazon V. Reyes</td>
                        <td>10 Rooms</td>
                        <td>32 Beds</td>
                        <td><span class="fw-bold text-dark">24 Residents</span></td>
                        <td style="min-width: 150px;">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>75.0%</span>
                                <span class="text-muted">8 Free</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-info" style="width: 75%;"></div>
                            </div>
                        </td>
                        <td class="text-end pe-3"><span class="badge bg-info-subtle text-info border border-info">Normal</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Sunrise Ladies Dormitory</div>
                            <div class="small text-muted">Brgy. Balimbing, Boac • Female</div>
                        </td>
                        <td>Mr. Arturo C. Ramos</td>
                        <td>6 Rooms</td>
                        <td>26 Beds</td>
                        <td><span class="fw-bold text-dark">20 Residents</span></td>
                        <td style="min-width: 150px;">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>76.9%</span>
                                <span class="text-muted">6 Free</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-info" style="width: 76.9%;"></div>
                            </div>
                        </td>
                        <td class="text-end pe-3"><span class="badge bg-info-subtle text-info border border-info">Normal</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
