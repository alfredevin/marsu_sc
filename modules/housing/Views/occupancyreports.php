<!-- Occupancy Reports View -->
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
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/occupancyreports') ?>">
                <i class="bi bi-bar-chart me-1 text-gold"></i>Occupancy Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/revenuereports') ?>">
                <i class="bi bi-currency-dollar me-1"></i>Revenue Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/residentstatistics') ?>">
                <i class="bi bi-pie-chart me-1"></i>Resident Demographics
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/facilityutilization') ?>">
                <i class="bi bi-building-check me-1"></i>Facility Utilization
            </a>
        </li>
    </ul>
</div>

<!-- Analytical Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Peak Intake Rate</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">91.4%</div>
            <div class="small text-muted mt-1">Recorded August 2026 (Sem Start)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Current Midterm Rate</div>
            <div class="h3 font-weight-bold mb-0 text-success">78.0%</div>
            <div class="small text-muted mt-1">Stabilized student tenancy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Bed Turnover Period</div>
            <div class="h3 font-weight-bold mb-0 text-dark">4.2 Days</div>
            <div class="small text-muted mt-1">Average vacancy replenishment</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total University Beds</div>
            <div class="h3 font-weight-bold mb-0 text-primary">82 Beds</div>
            <div class="small text-muted mt-1">Across 3 accredited facilities</div>
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
