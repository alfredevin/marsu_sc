<!-- Room Inventory & Capacity View -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-door-open-fill me-2 text-gold"></i>Room Inventory & Bed Space Capacity
        </h1>
        <p class="text-muted small mb-0">Track available room units, bed space vacancies, rates, and amenities across accredited facilities.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Directory
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newRoomModal">
            <i class="bi bi-plus-lg me-1"></i>Add Room Unit
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing') ?>">
                <i class="bi bi-building me-1"></i>Boarding Houses
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/rooms') ?>">
                <i class="bi bi-door-open me-1 text-gold"></i>Room Inventory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-people me-1"></i>Tenant Profiles
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/reports') ?>">
                <i class="bi bi-file-earmark-bar-graph me-1"></i>Reports
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Rooms</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">24 Units</div>
            <div class="small text-muted mt-1">Across 3 boarding houses</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Available Beds</div>
            <div class="h3 font-weight-bold mb-0 text-success">8 Vacant</div>
            <div class="small text-muted mt-1">Ready for occupancy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Occupied Beds</div>
            <div class="h3 font-weight-bold mb-0 text-secondary">32 Beds</div>
            <div class="small text-muted mt-1">80% occupancy rate</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Average Rate</div>
            <div class="h3 font-weight-bold mb-0 text-dark">₱1,650</div>
            <div class="small text-muted mt-1">Per head / monthly</div>
        </div>
    </div>
</div>

<!-- Rooms Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-marsu-burgundy font-weight-bold">
            <i class="bi bi-grid-3x3-gap-fill me-2 text-gold"></i>Room Units Directory
        </h5>
        <input type="text" class="form-control form-control-sm" placeholder="Filter by room or house..." style="width: 240px;">
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7 text-muted">
                <tr>
                    <th class="ps-3">Room Code</th>
                    <th>Boarding House</th>
                    <th>Capacity & Vacancy</th>
                    <th>Rate / Person</th>
                    <th>Amenities</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ps-3 fw-bold text-dark">Room 101</td>
                    <td><i class="bi bi-building me-1 text-gold"></i>Villa Marinduque</td>
                    <td><span class="badge bg-danger-subtle text-danger">4 / 4 Occupied</span></td>
                    <td class="fw-bold text-marsu-burgundy">₱1,500.00</td>
                    <td class="small text-muted">Ceiling fan, study desk, shared CR</td>
                    <td><span class="badge bg-secondary">Full</span></td>
                </tr>
                <tr>
                    <td class="ps-3 fw-bold text-dark">Room 102</td>
                    <td><i class="bi bi-building me-1 text-gold"></i>Villa Marinduque</td>
                    <td><span class="badge bg-success-subtle text-success">2 / 4 (2 Vacant)</span></td>
                    <td class="fw-bold text-marsu-burgundy">₱1,500.00</td>
                    <td class="small text-muted">Aircon, own CR, cabinet, WiFi</td>
                    <td><span class="badge bg-success">Available</span></td>
                </tr>
                <tr>
                    <td class="ps-3 fw-bold text-dark">Room 204</td>
                    <td><i class="bi bi-building me-1 text-gold"></i>Greenview Boarding House</td>
                    <td><span class="badge bg-success-subtle text-success">3 / 4 (1 Vacant)</span></td>
                    <td class="fw-bold text-marsu-burgundy">₱1,800.00</td>
                    <td class="small text-muted">Wall fan, balcony, hot shower</td>
                    <td><span class="badge bg-success">Available</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Add Room Unit -->
<div class="modal fade" id="newRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="bi bi-door-open-fill me-2 text-gold"></i>Add Room Unit
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= url('housing/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Boarding Facility <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" required>
                            <option value="">-- Choose Boarding House --</option>
                            <option value="1">Villa Marinduque Student Dorm</option>
                            <option value="2">Greenview Boarding House</option>
                            <option value="3">Sunrise Ladies Dormitory</option>
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room Name / No. <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Room 201">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Bed Capacity</label>
                            <input type="number" min="1" max="10" class="form-control form-control-sm" value="4">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Monthly Rate per Student (₱)</label>
                        <input type="text" class="form-control form-control-sm" placeholder="1,500.00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Amenities & Features</label>
                        <textarea name="description" class="form-control form-control-sm" rows="2" placeholder="e.g. WiFi, own bathroom, double-deck bed..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
