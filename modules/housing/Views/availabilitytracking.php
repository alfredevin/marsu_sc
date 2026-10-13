<!-- Availability Tracking View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-calendar2-check me-2 text-gold"></i>Real-time Bed & Room Vacancy Tracking
        </h1>
        <p class="text-muted small mb-0">Live availability monitor for student bed spaces, pending reservations, and upcoming vacancy slots across off-campus facilities.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/rooms') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-door-open me-1"></i>All Rooms
        </a>
        <a href="<?= url('housing/housingapplication') ?>" class="btn btn-marsu btn-sm shadow-sm">
            <i class="bi bi-person-plus me-1"></i>Process Application
        </a>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/rooms') ?>">
                <i class="bi bi-door-open me-1"></i>Rooms
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/availabilitytracking') ?>">
                <i class="bi bi-calendar2-check me-1 text-gold"></i>Availability Tracking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-layout-split me-1"></i>Bed Allocation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/occupancymonitoring') ?>">
                <i class="bi bi-pie-chart me-1"></i>Occupancy Rate
            </a>
        </li>
    </ul>
</div>

<!-- Availability KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-success p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Vacant Bed Spaces</div>
            <div class="h3 font-weight-bold mb-0 text-success">18 Available</div>
            <div class="small text-muted mt-1">Ready for immediate intake</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Reserved / On-Hold</div>
            <div class="h3 font-weight-bold mb-0 text-warning">5 Slots</div>
            <div class="small text-muted mt-1">Pending payment validation</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Occupied Beds</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">64 Beds</div>
            <div class="small text-muted mt-1">73.5% current capacity</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Upcoming Vacancies</div>
            <div class="h3 font-weight-bold mb-0 text-primary">7 Beds</div>
            <div class="small text-muted mt-1">End of month graduating checkout</div>
        </div>
    </div>
</div>

<!-- Grid Cards by Facility -->
<div class="row g-3 mb-4">
    <!-- Facility 1 -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold text-marsu-burgundy">Villa Marinduque Dorm</h6>
                    <small class="text-muted">Brgy. Santol, Boac</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success">6 Beds Free</span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>Occupancy Rate</span>
                    <span class="fw-bold">80%</span>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-marsu" role="progressbar" style="width: 80%;"></div>
                </div>

                <div class="list-group list-group-flush small">
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 101 (2-Pax Female)</span>
                        <span class="badge bg-danger-subtle text-danger">Full (2/2)</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 102 (4-Pax Female)</span>
                        <span class="badge bg-success-subtle text-success">2 Vacant</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 103 (4-Pax Male)</span>
                        <span class="badge bg-success-subtle text-success">3 Vacant</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 104 (2-Pax Male)</span>
                        <span class="badge bg-success-subtle text-success">1 Vacant</span>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light border-0 py-2 text-center">
                <a href="<?= url('housing/rooms') ?>" class="small text-marsu text-decoration-none fw-semibold">View Facility Rooms <i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Facility 2 -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold text-marsu-burgundy">Greenview Boarding House</h6>
                    <small class="text-muted">Brgy. Mansalay, Boac</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success">8 Beds Free</span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>Occupancy Rate</span>
                    <span class="fw-bold">66.6%</span>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-marsu" role="progressbar" style="width: 66.6%;"></div>
                </div>

                <div class="list-group list-group-flush small">
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 201 (4-Pax Male)</span>
                        <span class="badge bg-success-subtle text-success">2 Vacant</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 202 (4-Pax Male)</span>
                        <span class="badge bg-danger-subtle text-danger">Full (4/4)</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 203 (4-Pax Coed Studio)</span>
                        <span class="badge bg-success-subtle text-success">4 Vacant</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 204 (4-Pax Male)</span>
                        <span class="badge bg-success-subtle text-success">2 Vacant</span>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light border-0 py-2 text-center">
                <a href="<?= url('housing/rooms') ?>" class="small text-marsu text-decoration-none fw-semibold">View Facility Rooms <i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Facility 3 -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold text-marsu-burgundy">Sunrise Ladies Dormitory</h6>
                    <small class="text-muted">Brgy. Balimbing, Boac</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success">4 Beds Free</span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>Occupancy Rate</span>
                    <span class="fw-bold">85%</span>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-marsu" role="progressbar" style="width: 85%;"></div>
                </div>

                <div class="list-group list-group-flush small">
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 101 (2-Pax Single Room)</span>
                        <span class="badge bg-danger-subtle text-danger">Full (2/2)</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 102 (2-Pax Double)</span>
                        <span class="badge bg-danger-subtle text-danger">Full (2/2)</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 104 (4-Pax Suite)</span>
                        <span class="badge bg-success-subtle text-success">3 Vacant</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span>Room 105 (2-Pax Single)</span>
                        <span class="badge bg-success-subtle text-success">1 Vacant</span>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light border-0 py-2 text-center">
                <a href="<?= url('housing/rooms') ?>" class="small text-marsu text-decoration-none fw-semibold">View Facility Rooms <i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>
