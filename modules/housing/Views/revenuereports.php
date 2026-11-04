<!-- Revenue Reports View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-currency-dollar me-2 text-gold"></i>Student Housing Rental Revenue & Economic Telemetry
        </h1>
        <p class="text-muted small mb-0">Total gross rental circulation, economic impact of student boarders in Boac community, and collection velocity.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Statement
        </button>
        <button class="btn btn-marsu btn-sm shadow-sm" onclick="alert('Exporting Revenue Ledger...')">
            <i class="bi bi-download me-1"></i>Export Financials
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/occupancyreports') ?>">
                <i class="bi bi-bar-chart me-1"></i>Occupancy Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/revenuereports') ?>">
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

<!-- Revenue Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Gross Monthly Value</div>
                    <div class="kpi-value text-success">
                        ₱107,200
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Gross Monthly Value">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-cash-coin text-success"></i>
                <span>Projected monthly collections</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Actual Collected (MTD)</div>
                    <div class="kpi-value text-marsu-burgundy">
                        ₱92,400
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Actual Collected">
                    <i class="bi bi-wallet-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-check2-circle text-marsu-burgundy"></i>
                <span>86.2% collection achievement</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Average Monthly Rent</div>
                    <div class="kpi-value text-gold">
                        ₱1,675
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Average Rent">
                    <i class="bi bi-tag-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-person text-gold-dark"></i>
                <span>Per student resident rate</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Term Circulation</div>
                    <div class="kpi-value text-gold">
                        ₱536,000
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Term Economic Circulation">
                    <i class="bi bi-bank2"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-pie-chart-fill text-gold-dark"></i>
                <span>Estimated 5-month term total</span>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-cash-stack me-2 text-gold"></i>Revenue Collection Breakdown by Accredited Entity
        </h6>
        <span class="badge bg-light text-dark border">October 2026 Billing Cycle</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Facility</th>
                        <th>Active Residents</th>
                        <th>Gross Expected (₱)</th>
                        <th>Collected to Date (₱)</th>
                        <th>Outstanding (₱)</th>
                        <th class="text-end pe-3">Collection Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Villa Marinduque Dorm</td>
                        <td>20 Residents</td>
                        <td>₱33,600.00</td>
                        <td><span class="text-success fw-bold">₱30,600.00</span></td>
                        <td><span class="text-danger fw-semibold">₱3,000.00</span></td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success">91.1%</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Greenview Boarding House</td>
                        <td>24 Residents</td>
                        <td>₱43,200.00</td>
                        <td><span class="text-success fw-bold">₱36,000.00</span></td>
                        <td><span class="text-danger fw-semibold">₱7,200.00</span></td>
                        <td class="text-end pe-3"><span class="badge bg-info-subtle text-info border border-info">83.3%</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Sunrise Ladies Dormitory</td>
                        <td>20 Residents</td>
                        <td>₱30,400.00</td>
                        <td><span class="text-success fw-bold">₱25,800.00</span></td>
                        <td><span class="text-danger fw-semibold">₱4,600.00</span></td>
                        <td class="text-end pe-3"><span class="badge bg-info-subtle text-info border border-info">84.9%</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
