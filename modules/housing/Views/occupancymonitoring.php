<!-- Occupancy Monitoring View -->
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

<!-- Occupancy Metric Progress Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Overall University Occupancy</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">78.0%</div>
            <div class="small text-muted mt-1">64 of 82 beds occupied</div>
            <div class="progress mt-2" style="height: 6px;">
                <div class="progress-bar bg-marsu" style="width: 78%;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Female Residents</div>
            <div class="h3 font-weight-bold mb-0 text-success">38 Students</div>
            <div class="small text-muted mt-1">59.4% of total population</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Male Residents</div>
            <div class="h3 font-weight-bold mb-0 text-primary">26 Students</div>
            <div class="small text-muted mt-1">40.6% of total population</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Critical Thresholds</div>
            <div class="h3 font-weight-bold mb-0 text-danger">0 Overcrowded</div>
            <div class="small text-muted mt-1">100% within fire code limits</div>
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
