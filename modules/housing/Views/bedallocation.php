<!-- Bed Allocation View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-layout-split me-2 text-gold"></i>Bed Space Allocation & Plotting
        </h1>
        <p class="text-muted small mb-0">Visual bed space assignment map per room unit, roommate compatibility grouping, and upper/lower bunk allocation.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/roomassignment') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-person-check me-1"></i>Room Assignments
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newBedModal">
            <i class="bi bi-plus-lg me-1"></i>Allocate Bed Space
        </button>
    </div>
</div>

<!-- Bed Space Cards Layout -->
<div class="row g-4 mb-4">
    <!-- Room Unit Card 1 -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-marsu-burgundy">Room 102 — Villa Marinduque</h5>
                    <small class="text-muted">Capacity: 4 Beds • Ground Floor • Female Wing</small>
                </div>
                <span class="badge bg-warning-subtle text-dark border border-warning">2 / 4 Occupied</span>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    <!-- Bed A -->
                    <div class="col-6">
                        <div class="border rounded p-3 bg-light text-center position-relative h-100">
                            <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">OCCUPIED</span>
                            <div class="text-secondary mt-2 mb-1"><i class="bi bi-circle-fill text-danger fs-6"></i> <strong>Bed A</strong> (Lower Bunk)</div>
                            <div class="fw-bold text-dark">Maria Santos</div>
                            <div class="small text-muted">22-0145 • BSIT 3A</div>
                            <div class="small text-success mt-1">₱1,500/mo • Active</div>
                        </div>
                    </div>
                    <!-- Bed B -->
                    <div class="col-6">
                        <div class="border rounded p-3 bg-light text-center position-relative h-100">
                            <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">OCCUPIED</span>
                            <div class="text-secondary mt-2 mb-1"><i class="bi bi-circle-fill text-danger fs-6"></i> <strong>Bed B</strong> (Upper Bunk)</div>
                            <div class="fw-bold text-dark">Lara Jane Reyes</div>
                            <div class="small text-muted">23-0912 • BSA 2A</div>
                            <div class="small text-success mt-1">₱1,500/mo • Active</div>
                        </div>
                    </div>
                    <!-- Bed C -->
                    <div class="col-6">
                        <div class="border border-success rounded p-3 bg-white text-center position-relative h-100 shadow-sm">
                            <span class="badge bg-success position-absolute top-0 start-50 translate-middle">VACANT</span>
                            <div class="text-success mt-2 mb-1"><i class="bi bi-circle-fill text-success fs-6"></i> <strong>Bed C</strong> (Lower Bunk)</div>
                            <div class="text-muted small py-2">Available for student intake</div>
                            <button class="btn btn-sm btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#newBedModal">Assign Student</button>
                        </div>
                    </div>
                    <!-- Bed D -->
                    <div class="col-6">
                        <div class="border border-success rounded p-3 bg-white text-center position-relative h-100 shadow-sm">
                            <span class="badge bg-success position-absolute top-0 start-50 translate-middle">VACANT</span>
                            <div class="text-success mt-2 mb-1"><i class="bi bi-circle-fill text-success fs-6"></i> <strong>Bed D</strong> (Upper Bunk)</div>
                            <div class="text-muted small py-2">Available for student intake</div>
                            <button class="btn btn-sm btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#newBedModal">Assign Student</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Unit Card 2 -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-marsu-burgundy">Room 204 — Greenview House</h5>
                    <small class="text-muted">Capacity: 2 Beds • 2nd Floor • Male Wing</small>
                </div>
                <span class="badge bg-danger-subtle text-danger border border-danger">2 / 2 Full</span>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    <!-- Bed A -->
                    <div class="col-6">
                        <div class="border rounded p-3 bg-light text-center position-relative h-100">
                            <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">OCCUPIED</span>
                            <div class="text-secondary mt-2 mb-1"><i class="bi bi-circle-fill text-danger fs-6"></i> <strong>Bed A</strong> (Single Bed)</div>
                            <div class="fw-bold text-dark">John Rey Reyes</div>
                            <div class="small text-muted">23-0891 • BSCS 2B</div>
                            <div class="small text-success mt-1">₱1,800/mo • Active</div>
                        </div>
                    </div>
                    <!-- Bed B -->
                    <div class="col-6">
                        <div class="border rounded p-3 bg-light text-center position-relative h-100">
                            <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">OCCUPIED</span>
                            <div class="text-secondary mt-2 mb-1"><i class="bi bi-circle-fill text-danger fs-6"></i> <strong>Bed B</strong> (Single Bed)</div>
                            <div class="fw-bold text-dark">Mark Joseph Alcantara</div>
                            <div class="small text-muted">24-1102 • BSHM 1C</div>
                            <div class="small text-success mt-1">₱1,800/mo • Active</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bed Assignment -->
<div class="modal fade" id="newBedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Allocate Bed Space to Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Room & Facility</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque - Room 102</option>
                            <option>Greenview - Room 204</option>
                            <option>Sunrise Dorm - Room 105</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Bed Space Slot</label>
                        <select class="form-select" required>
                            <option>Bed C (Lower Bunk) - Vacant</option>
                            <option>Bed D (Upper Bunk) - Vacant</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Student Name / ID</label>
                        <input type="text" class="form-control" placeholder="Search MarSU Student (ID or Name)..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Effective Occupancy Start Date</label>
                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Confirm Allocation</button>
                </div>
            </form>
        </div>
    </div>
</div>
