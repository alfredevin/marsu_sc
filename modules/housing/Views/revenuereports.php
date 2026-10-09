<!-- Revenue Reports View -->
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

<!-- Revenue Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-success p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Gross Monthly Rental Value</div>
            <div class="h3 font-weight-bold mb-0 text-success">₱107,200.00</div>
            <div class="small text-muted mt-1">Total projected monthly collections</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Actual Collected (MTD)</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">₱92,400.00</div>
            <div class="small text-muted mt-1">86.2% collection achievement</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Average Monthly Rent</div>
            <div class="h3 font-weight-bold mb-0 text-dark">₱1,675.00</div>
            <div class="small text-muted mt-1">Per student resident rate</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Semester Economic Circulation</div>
            <div class="h3 font-weight-bold mb-0 text-primary">₱536,000.00</div>
            <div class="small text-muted mt-1">Estimated 5-month term total</div>
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
