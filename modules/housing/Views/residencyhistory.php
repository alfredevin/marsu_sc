<!-- Residency History View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clock-history me-2 text-gold"></i>Tenant Residency History & Clearance
        </h1>
        <p class="text-muted small mb-0">Historical registry of student stay records, checkout clearance, and past boarding house tenancies across academic years.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/tenants') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-people me-1"></i>Active Tenants
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newHistoryModal">
            <i class="bi bi-plus-lg me-1"></i>Log Clearance / Checkout
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-people-fill me-1"></i>Current Tenants
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/residencyhistory') ?>">
                <i class="bi bi-clock-history me-1 text-gold"></i>Residency History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-door-open me-1"></i>Room & Inventory
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Past Stays</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">148</div>
            <div class="small text-muted mt-1">Archived tenancy records</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Cleared Residents</div>
            <div class="h3 font-weight-bold mb-0 text-success">142</div>
            <div class="small text-muted mt-1">Complete clearance signed</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Pending Clearance</div>
            <div class="h3 font-weight-bold mb-0 text-warning">6</div>
            <div class="small text-muted mt-1">Unsettled damages/dues</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Avg. Stay Duration</div>
            <div class="h3 font-weight-bold mb-0 text-dark">9.4 Mos</div>
            <div class="small text-muted mt-1">Standard academic tenure</div>
        </div>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="Search by student ID, name, or boarding house...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select form-select-sm">
                    <option selected>All Academic Years</option>
                    <option>A.Y. 2025-2026 (2nd Sem)</option>
                    <option>A.Y. 2025-2026 (1st Sem)</option>
                    <option>A.Y. 2024-2025</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select form-select-sm">
                    <option selected>All Clearance Status</option>
                    <option>Cleared</option>
                    <option>Pending</option>
                    <option>With Liabilities</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-outline-secondary btn-sm w-100"><i class="bi bi-funnel me-1"></i>Filter</button>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-bookmark me-2 text-gold"></i>Historical Tenancy Registry
        </h6>
        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i>Export History</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Student Resident</th>
                        <th>Boarding House & Room</th>
                        <th>Academic Term</th>
                        <th>Period of Stay</th>
                        <th>Clearance Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Christian Paul Mercene</div>
                            <div class="small text-muted">ID: 22-0189 • BSIT 4A</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Villa Marinduque Student Dorm</div>
                            <div class="small text-muted">Room 201 • Bed B</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">A.Y. 2025-2026 2nd Sem</span></td>
                        <td>
                            <div class="small">Jan 15, 2026 — Jun 20, 2026</div>
                            <div class="small text-muted">5 Months Stay</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Cleared</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Kyla Mae De Luna</div>
                            <div class="small text-muted">ID: 23-0412 • BSCS 3B</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Greenview Boarding House</div>
                            <div class="small text-muted">Room 104 • Bed A</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">A.Y. 2025-2026 1st Sem</span></td>
                        <td>
                            <div class="small">Aug 10, 2025 — Dec 22, 2025</div>
                            <div class="small text-muted">4.5 Months Stay</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Cleared</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Joshua Emmanuel Tan</div>
                            <div class="small text-muted">ID: 21-0984 • BSIS 4B</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Sunrise Ladies & Mens Dorm</div>
                            <div class="small text-muted">Room 302 • Bed C</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">A.Y. 2025-2026 2nd Sem</span></td>
                        <td>
                            <div class="small">Feb 01, 2026 — Jun 15, 2026</div>
                            <div class="small text-muted">4.5 Months Stay</div>
                        </td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning"><i class="bi bi-hourglass-split me-1"></i>Key Returned / Dues Pending</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Log Clearance -->
<div class="modal fade" id="newHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Log Tenant Checkout / Clearance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Resident Student</label>
                        <select class="form-select" required>
                            <option selected disabled value="">Choose student resident...</option>
                            <option>Maria Santos (Villa Marinduque - Rm 102)</option>
                            <option>John Rey Reyes (Greenview - Rm 204)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Checkout Date</label>
                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Clearance Status</label>
                        <select class="form-select">
                            <option value="cleared">Fully Cleared (No Damages, Dues Paid)</option>
                            <option value="pending">Pending Inspection</option>
                            <option value="with_dues">With Outstanding Balance</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Remarks / Condition Notes</label>
                        <textarea class="form-control" rows="2" placeholder="Keys surrendered, room cleanliness inspected..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
