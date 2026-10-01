<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-person-badge-fill me-2 text-gold"></i>Student Resident Accommodations
        </h1>
        <p class="text-muted small mb-0">Official residency bookings and dorm records linking enrolled MarSU students to accredited residences.</p>
    </div>
    <div>
        <?php if (can('housing.book')): ?>
            <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newBookingModal">
                <i class="bi bi-person-plus-fill me-1"></i>Book New Accommodation
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Filters Bar -->
<div class="card shadow-sm border-0 mb-4 bg-light">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('housing/accommodations') ?>" class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control border-start-0" placeholder="Search by student number, student name, residence..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Residency Statuses</option>
                    <option value="active" <?= ($status === 'active') ? 'selected' : '' ?>>Active Resident</option>
                    <option value="reserved" <?= ($status === 'reserved') ? 'selected' : '' ?>>Reserved Space</option>
                    <option value="completed" <?= ($status === 'completed') ? 'selected' : '' ?>>Completed / Moved Out</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter"></i></button>
                <a href="<?= url('housing/accommodations') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Accommodations Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-mortarboard-fill me-2 text-gold"></i>Student Resident Roster (<?= count($accommodations) ?> Records)
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th>Student Number</th>
                        <th>Student Full Name</th>
                        <th>Boarding House Residence</th>
                        <th>Room Assigned</th>
                        <th>Monthly Rent</th>
                        <th>Emergency Contact</th>
                        <th>Move-in Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($accommodations)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No student accommodations found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($accommodations as $acc): ?>
                            <tr>
                                <td><code><?= e($acc['student_number']) ?></code></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($acc['last_name'] . ', ' . $acc['first_name']) ?></strong>
                                    <div class="text-muted" style="font-size: 0.73rem;"><?= e($acc['email']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-body"><?= e($acc['house_name']) ?></div>
                                    <span class="badge badge-gold font-monospace"><?= e($acc['house_code']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= e($acc['room_number']) ?></span>
                                    <span class="text-muted ms-1" style="font-size: 0.7rem;"><?= ucfirst(str_replace('_', ' ', $acc['room_type'])) ?></span>
                                </td>
                                <td>
                                    <strong>₱<?= number_format($acc['agreed_rate'], 2) ?></strong>
                                    <?php if ($acc['payment_status'] === 'paid'): ?>
                                        <span class="badge bg-success-subtle text-success ms-1" style="font-size: 0.68rem;">Paid</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning ms-1" style="font-size: 0.68rem;">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted">
                                    <i class="bi bi-telephone me-1"></i><?= e($acc['guardian_contact'] ?: 'N/A') ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($acc['start_date'])) ?></td>
                                <td>
                                    <?php if ($acc['status'] === 'active'): ?>
                                        <span class="badge bg-success">Active Resident</span>
                                    <?php elseif ($acc['status'] === 'reserved'): ?>
                                        <span class="badge bg-info">Reserved</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= ucfirst($acc['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Book Accommodation -->
<?php if (can('housing.book')): ?>
<div class="modal fade" id="newBookingModal" tabindex="-1" aria-labelledby="newBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="<?= url('housing/accommodations/book') ?>" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header bg-marsu text-white py-2.5">
                <h6 class="modal-title font-weight-bold" id="newBookingModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Book Student Accommodation (ISHAMIS)
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Select Enrolled Student <span class="text-danger">*</span></label>
                        <select name="student_id" class="form-select form-select-sm" required>
                            <option value="">Search Student...</option>
                            <?php foreach ($students as $st): ?>
                                <option value="<?= $st['id'] ?>"><?= e($st['last_name'] . ', ' . $st['first_name']) ?> (<?= e($st['student_number']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Select Available Room Space <span class="text-danger">*</span></label>
                        <select name="room_id" class="form-select form-select-sm" required>
                            <option value="">Select Room...</option>
                            <?php foreach ($availableRooms as $rm): ?>
                                <option value="<?= $rm['id'] ?>">
                                    <?= e($rm['house_name']) ?> - <?= e($rm['room_number']) ?> (<?= $rm['vacant_beds'] ?> vacant • ₱<?= number_format($rm['rate_per_month'], 0) ?>/mo)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Move-in Date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Emergency / Parent Contact Number</label>
                        <input type="text" name="guardian_contact" class="form-control form-control-sm" placeholder="e.g. 0917-555-1234">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-check2-circle me-1"></i>Confirm Accommodation</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
