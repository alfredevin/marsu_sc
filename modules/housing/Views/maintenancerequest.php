<!-- Maintenance Request View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-tools me-2 text-gold"></i>Student Facility Maintenance Requests
        </h1>
        <p class="text-muted small mb-0">Lodge and track repair work orders for plumbing, electrical wiring, carpentry, and internet connectivity across boarding houses.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/repairmonitoring') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-speedometer2 me-1"></i>Repair Monitoring
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newMaintenanceModal">
            <i class="bi bi-plus-lg me-1"></i>File Repair Request
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/maintenancerequest') ?>">
                <i class="bi bi-tools me-1 text-gold"></i>Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/repairmonitoring') ?>">
                <i class="bi bi-speedometer2 me-1"></i>Repair Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/conditionreports') ?>">
                <i class="bi bi-clipboard2-check me-1"></i>Condition Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/servicehistory') ?>">
                <i class="bi bi-clock-history me-1"></i>Service History
            </a>
        </li>
    </ul>
</div>

<!-- Requests Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-wrench-adjustable me-2 text-gold"></i>Active Maintenance Work Orders
        </h6>
        <span class="badge bg-warning-subtle text-dark border border-warning">2 In Progress</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Ticket ID</th>
                        <th>Facility & Room</th>
                        <th>Category</th>
                        <th>Issue Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">TKT-2026-101</td>
                        <td>
                            <div class="fw-semibold">Villa Marinduque Dorm</div>
                            <div class="small text-muted">Room 102</div>
                        </td>
                        <td>Plumbing</td>
                        <td>Bathroom faucet leaking continuously; low water pressure in shower.</td>
                        <td><span class="badge bg-danger">Urgent</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="bi bi-gear-fill me-1"></i>In Progress</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i> Mark Done</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">TKT-2026-102</td>
                        <td>
                            <div class="fw-semibold">Greenview Boarding House</div>
                            <div class="small text-muted">Room 204</div>
                        </td>
                        <td>Electrical</td>
                        <td>Wall outlet sparking when plugging laptop charger.</td>
                        <td><span class="badge bg-danger">Safety Hazard</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="bi bi-gear-fill me-1"></i>Electrician Dispatched</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i> Mark Done</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">TKT-2026-103</td>
                        <td>
                            <div class="fw-semibold">Sunrise Ladies Dorm</div>
                            <div class="small text-muted">Room 105</div>
                        </td>
                        <td>Wi-Fi Internet</td>
                        <td>Router signal dropping during study hours (7PM-10PM).</td>
                        <td><span class="badge bg-info">Normal</span></td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Resolved</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i> View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Maintenance -->
<div class="modal fade" id="newMaintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">File Maintenance / Repair Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility & Room Location</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque - Room 102</option>
                            <option>Greenview - Room 204</option>
                            <option>Sunrise Ladies Dorm - Room 105</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Issue Classification</label>
                        <select class="form-select">
                            <option value="plumbing">Plumbing & Water Supply</option>
                            <option value="electrical">Electrical & Lighting</option>
                            <option value="carpentry">Carpentry, Locks & Windows</option>
                            <option value="wifi">Internet / Wi-Fi</option>
                            <option value="appliance">Appliance / Aircon</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Priority Urgency</label>
                        <select class="form-select">
                            <option value="normal">Normal (Within 48 hours)</option>
                            <option value="high">High (Within 24 hours)</option>
                            <option value="emergency">Emergency / Safety Hazard</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Detailed Description</label>
                        <textarea class="form-control" rows="3" placeholder="Describe the defect or repair needed..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Submit Work Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
