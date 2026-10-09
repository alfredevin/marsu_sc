<!-- Reservation Management View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bookmark-check-fill me-2 text-gold"></i>Student Reservation Management
        </h1>
        <p class="text-muted small mb-0">Manage bed space advance reservations, deposit payment confirmations, and reservation hold expiration windows.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/waitinglist') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-list-ol me-1"></i>Waiting List
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newReservationModal">
            <i class="bi bi-plus-lg me-1"></i>New Reservation
        </button>
    </div>
</div>

<!-- Reservation Status Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-bookmarks me-2 text-gold"></i>Active Bed Space Reservations
        </h6>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Search reservation..." style="width: 220px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Reservation ID</th>
                        <th>Student Name</th>
                        <th>Reserved Facility & Bed</th>
                        <th>Deposit Status</th>
                        <th>Hold Expiration</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">RES-2026-041</td>
                        <td>
                            <div class="fw-bold">Alyssa Mae Madrigal</div>
                            <div class="small text-muted">ID: 24-0012 • 1st Year BSN</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Villa Marinduque Dorm</div>
                            <div class="small text-muted">Room 102 • Bed C</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success">₱500 Paid (OR #9021)</span></td>
                        <td><span class="text-danger small fw-bold">Oct 15, 2026 (In 6 days)</span></td>
                        <td><span class="badge bg-success">Confirmed</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-primary me-1" title="Convert to Check-in"><i class="bi bi-box-arrow-in-right"></i> Move In</button>
                            <button class="btn btn-sm btn-outline-danger" title="Cancel"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">RES-2026-042</td>
                        <td>
                            <div class="fw-bold">Gabriel Luis Cruz</div>
                            <div class="small text-muted">ID: 24-0842 • 1st Year BSIT</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Greenview Boarding House</div>
                            <div class="small text-muted">Room 203 • Bed A</div>
                        </td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning">Pending Deposit</span></td>
                        <td><span class="text-danger small fw-bold">Oct 11, 2026 (In 2 days)</span></td>
                        <td><span class="badge bg-warning text-dark">Hold Period</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-success me-1" title="Validate Payment"><i class="bi bi-cash-coin"></i> Verify</button>
                            <button class="btn btn-sm btn-outline-danger" title="Cancel"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Reservation -->
<div class="modal fade" id="newReservationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Create Bed Space Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Student Name / ID</label>
                        <input type="text" class="form-control" placeholder="Search student..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Boarding House & Bed</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque - Rm 102 Bed C (₱1,500/mo)</option>
                            <option>Villa Marinduque - Rm 102 Bed D (₱1,500/mo)</option>
                            <option>Greenview - Rm 203 Bed B (₱1,800/mo)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reservation Fee / Deposit (₱)</label>
                        <input type="number" step="0.01" class="form-control" value="500.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Target Move-in Date</label>
                        <input type="date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Confirm Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>
