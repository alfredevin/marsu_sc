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

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-box-seam me-1"></i>Room & Inventory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/availabilitytracking') ?>">
                <i class="bi bi-calendar-check me-1"></i>Availability Tracking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/roomassignment') ?>">
                <i class="bi bi-door-open me-1"></i>Room Assignments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-layout-split me-1 text-gold"></i>Bed Allocation
            </a>
        </li>
    </ul>
</div>

<!-- Bed Space Cards Layout -->
<div class="row g-4 mb-4">
    <!-- Room Unit Card 1 -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-marsu-burgundy">Room 102 — Villa Marinduque</h5>
                    <small class="text-muted">Capacity: 2 Beds • 1st Floor • Double Room</small>
                </div>
                <span class="badge bg-warning-subtle text-dark border border-warning">1 / 2 Occupied</span>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    <!-- Bed A -->
                    <div class="col-6">
                        <div class="border rounded p-3 bg-light text-center position-relative h-100">
                            <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">OCCUPIED</span>
                            <div class="text-secondary mt-2 mb-1"><i class="bi bi-circle-fill text-danger fs-6"></i> <strong>Bed A</strong> (Lower Bunk)</div>
                            <div class="fw-bold text-dark">Maria Santos</div>
                            <div class="small text-muted">22-0145 • BSIT 3rd Year</div>
                            <div class="small text-success mt-1">₱1,600/mo • Active</div>
                        </div>
                    </div>
                    <!-- Bed B -->
                    <div class="col-6">
                        <div class="border border-success rounded p-3 bg-white text-center position-relative h-100 shadow-sm">
                            <span class="badge bg-success position-absolute top-0 start-50 translate-middle">VACANT</span>
                            <div class="text-success mt-2 mb-1"><i class="bi bi-circle-fill text-success fs-6"></i> <strong>Bed B</strong> (Upper Bunk)</div>
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
                    <h5 class="mb-0 fw-bold text-marsu-burgundy">Room A-1 — Greenview Residence</h5>
                    <small class="text-muted">Capacity: 2 Beds • Ground Floor</small>
                </div>
                <span class="badge bg-warning-subtle text-dark border border-warning">1 / 2 Occupied</span>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    <!-- Bed A -->
                    <div class="col-6">
                        <div class="border border-success rounded p-3 bg-white text-center position-relative h-100 shadow-sm">
                            <span class="badge bg-success position-absolute top-0 start-50 translate-middle">VACANT</span>
                            <div class="text-success mt-2 mb-1"><i class="bi bi-circle-fill text-success fs-6"></i> <strong>Bed A</strong></div>
                            <div class="text-muted small py-2">Ready for student occupancy</div>
                            <button class="btn btn-sm btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#newBedModal">Assign Student</button>
                        </div>
                    </div>
                    <!-- Bed B -->
                    <div class="col-6">
                        <div class="border rounded p-3 bg-light text-center position-relative h-100">
                            <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">OCCUPIED</span>
                            <div class="text-secondary mt-2 mb-1"><i class="bi bi-circle-fill text-danger fs-6"></i> <strong>Bed B</strong></div>
                            <div class="fw-bold text-dark">John Rey Reyes</div>
                            <div class="small text-muted">23-0891 • BSCS 2nd Year</div>
                            <div class="small text-success mt-1">₱1,300/mo • Active</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bed Assignment -->
<div class="modal fade" id="newBedModal" tabindex="-1" aria-labelledby="newBedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newBedModalLabel">
                    <i class="bi bi-layout-split me-2 text-gold"></i>Allocate Bed Space to Student
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= url('housing/tenants/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Student ID No. <span class="text-danger">*</span></label>
                            <input type="text" name="student_no" class="form-control form-control-sm" required placeholder="e.g. 24-0321">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Gender</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control form-control-sm" required placeholder="e.g. Lara Jane">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control form-control-sm" required placeholder="e.g. Reyes">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Degree Program</label>
                            <input type="text" name="program" class="form-control form-control-sm" value="BSIT" placeholder="BSIT">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control form-control-sm" placeholder="0919-xxx-xxxx">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Boarding Facility & Room <span class="text-danger">*</span></label>
                        <select name="room_id" class="form-select form-select-sm" required>
                            <option value="2">Villa Marinduque - Room 102 (₱1,600.00/mo)</option>
                            <option value="4">Villa Marinduque - Room 201 (₱1,500.00/mo)</option>
                            <option value="6">Greenview - Room A-1 (₱1,300.00/mo)</option>
                            <option value="7">Greenview - Room A-2 (₱1,200.00/mo)</option>
                        </select>
                        <input type="hidden" name="boarding_house_id" value="1">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Bed Space Slot</label>
                            <input type="text" name="bed_number" class="form-control form-control-sm" value="Bed B" placeholder="e.g. Bed B (Upper Bunk)">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Agreed Monthly Rent (₱)</label>
                            <input type="number" step="0.01" name="monthly_rent" class="form-control form-control-sm" value="1500.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Move-In Date</label>
                        <input type="date" name="move_in_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-check-circle me-1"></i>Confirm Allocation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>