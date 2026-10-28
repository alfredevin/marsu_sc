<!-- Occupancy Reports View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-file-earmark-bar-graph-fill me-2 text-gold"></i>Boarding House Occupancy & Capacity Analytics
        </h1>
        <p class="text-muted small mb-0">Semestral trends, peak move-in intake periods, vacancy velocity, and capacity saturation across accredited facilities.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Report
        </button>
        <button class="btn btn-marsu btn-sm shadow-sm" onclick="alert('Exporting Occupancy Summary to CSV...')">
            <i class="bi bi-file-earmark-excel me-1"></i>Export CSV
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/occupancyreports') ?>">
                <i class="bi bi-bar-chart me-1"></i>Occupancy Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/revenuereports') ?>">
                <i class="bi bi-currency-dollar me-1"></i>Revenue Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/residentstatistics') ?>">
                <i class="bi bi-pie-chart me-1"></i>Resident Demographics
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/facilityutilization') ?>">
                <i class="bi bi-building-check me-1"></i>Facility Utilization
            </a>
        </li>
    </ul>
</div>

<!-- Analytical Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Peak Intake Rate</div>
                    <div class="kpi-value text-marsu-burgundy">
                        91.4%
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Peak Intake Rate">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-calendar2-check text-marsu-burgundy"></i>
                <span>Recorded Aug 2026 (Sem Start)</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Current Midterm Rate</div>
                    <div class="kpi-value text-success">
                        78.0%
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Current Midterm Rate">
                    <i class="bi bi-pie-chart-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-check-circle text-success"></i>
                <span>Stabilized student tenancy</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Bed Turnover Period</div>
                    <div class="kpi-value text-gold">
                        4.2
                        <span class="kpi-unit">Days</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Turnover Period">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-clock-history text-gold-dark"></i>
                <span>Average vacancy replenishment</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Total University Beds</div>
                    <div class="kpi-value text-gold">
                        82
                        <span class="kpi-unit">Beds</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Total Beds">
                    <i class="bi bi-door-closed-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-buildings text-gold-dark"></i>
                <span>Across 3 accredited facilities</span>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Occupancy Report Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Accredited Facility Occupancy Audit (A.Y. 2026-2027)
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Boarding House Facility</th>
                        <th>Barangay Location</th>
                        <th>Accredited Beds</th>
                        <th>Occupied</th>
                        <th>Vacant</th>
                        <th>Occupancy %</th>
                        <th class="text-end pe-3">Compliance Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Villa Marinduque Student Dorm</td>
                        <td>Santol, Boac</td>
                        <td>24 Beds</td>
                        <td>20 Beds</td>
                        <td>4 Beds</td>
                        <td>
                            <div class="fw-bold text-success">83.3%</div>
                        </td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success">A-Grade (98%)</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Greenview Boarding House</td>
                        <td>Mansalay, Boac</td>
                        <td>32 Beds</td>
                        <td>24 Beds</td>
                        <td>8 Beds</td>
                        <td>
                            <div class="fw-bold text-info">75.0%</div>
                        </td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success">A-Grade (95%)</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Sunrise Ladies Dormitory</td>
                        <td>Balimbing, Boac</td>
                        <td>26 Beds</td>
                        <td>20 Beds</td>
                        <td>6 Beds</td>
                        <td>
                            <div class="fw-bold text-info">76.9%</div>
                        </td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success">A-Grade (96%)</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
