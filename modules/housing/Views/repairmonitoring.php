<!-- Repair Monitoring View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-speedometer2 me-2 text-gold"></i>Repair Progress & Resolution Metrics
        </h1>
        <p class="text-muted small mb-0">Monitor average resolution time, technician dispatch tracking, and SLA turnaround for reported boarding house damages.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/maintenancerequest') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-tools me-1"></i>New Request
        </a>
    </div>
</div>

<!-- SLA Metrics KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-success p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Avg. Resolution Speed</div>
            <div class="h3 font-weight-bold mb-0 text-success">18.4 Hours</div>
            <div class="small text-muted mt-1">Faster than 48-hr university SLA</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Resolved This Month</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">23 Repairs</div>
            <div class="small text-muted mt-1">Inspected & cleared by residents</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Pending Contractor Work</div>
            <div class="h3 font-weight-bold mb-0 text-warning">2 Tickets</div>
            <div class="small text-muted mt-1">Awaiting replacement parts</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Resident Satisfaction</div>
            <div class="h3 font-weight-bold mb-0 text-primary">94.8%</div>
            <div class="small text-muted mt-1">Positive repair feedback rating</div>
        </div>
    </div>
</div>

<!-- Active Repairs Timeline Cards -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-clock-history me-2 text-gold"></i>Live Repair Work Status Timeline
        </h6>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <span class="badge bg-danger me-2">Urgent Safety</span>
                    <strong class="text-dark">Electric Outlet Rewiring — Greenview (Rm 204)</strong>
                    <div class="small text-muted mt-1">Technician: Boac Electrical Services (Mr. N. Mendoza) • Dispatched 8:30 AM today</div>
                </div>
                <div class="text-end">
                    <span class="badge bg-warning text-dark"><i class="bi bi-wrench me-1"></i>Currently on Site</span>
                    <div class="small text-muted">Est. Complete: 12:00 PM</div>
                </div>
            </div>
            <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <span class="badge bg-warning text-dark me-2">Plumbing</span>
                    <strong class="text-dark">Bathroom Faucet Replacement — Villa Marinduque (Rm 102)</strong>
                    <div class="small text-muted mt-1">Assigned Caretaker: Mang Carding • New heavy duty brass faucet procured</div>
                </div>
                <div class="text-end">
                    <span class="badge bg-info-subtle text-info border"><i class="bi bi-box-seam me-1"></i>Parts Acquired</span>
                    <div class="small text-muted">Installation: 2:00 PM</div>
                </div>
            </div>
        </div>
    </div>
</div>
