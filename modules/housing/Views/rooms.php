<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-door-open-fill me-2 text-gold"></i>Room & Bedspace Vacancies
        </h1>
        <p class="text-muted small mb-0">Search and monitor available student bedspaces across Santa Cruz accredited boarding residences.</p>
    </div>
    <div>
        <?php if (can('housing.register')): ?>
            <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRoomModal">
                <i class="bi bi-plus-lg me-1"></i>Add Room Space
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Filters -->
<div class="card shadow-sm border-0 mb-4 bg-light">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('housing/rooms') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <select name="house_id" class="form-select form-select-sm">
                    <option value="0">All Boarding Houses</option>
                    <?php foreach ($houses as $h): ?>
                        <option value="<?= $h['id'] ?>" <?= ($houseFilter == $h['id']) ? 'selected' : '' ?>><?= e($h['name']) ?> (<?= e($h['code']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="room_type" class="form-select form-select-sm">
                    <option value="">All Room Types</option>
                    <option value="solo" <?= ($typeFilter === 'solo') ? 'selected' : '' ?>>Solo Room</option>
                    <option value="shared_2" <?= ($typeFilter === 'shared_2') ? 'selected' : '' ?>>Shared (2 Beds)</option>
                    <option value="shared_4" <?= ($typeFilter === 'shared_4') ? 'selected' : '' ?>>Shared (4 Beds)</option>
                    <option value="bedspace" <?= ($typeFilter === 'bedspace') ? 'selected' : '' ?>>Bedspace Only</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="available" <?= ($statusFilter === 'available') ? 'selected' : '' ?>>Available Vacancies</option>
                    <option value="full" <?= ($statusFilter === 'full') ? 'selected' : '' ?>>Full / Occupied</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter"></i></button>
                <a href="<?= url('housing/rooms') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Rooms Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-grid-3x3-gap-fill me-2 text-gold"></i>Room Vacancy Master List (<?= count($rooms) ?> Rooms)
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th>Room Number</th>
                        <th>Boarding House & Barangay</th>
                        <th>Room Type</th>
                        <th>Bed Capacity</th>
                        <th>Vacant Beds</th>
                        <th>Monthly Rent</th>
                        <th>Features</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($rooms)): ?>
                        <tr><td colspan="8" class="text-center py-4 text-muted">No rooms found matching your filter criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($rooms as $r): ?>
                            <tr>
                                <td>
                                    <strong class="text-marsu-burgundy fs-6"><?= e($r['room_number']) ?></strong>
                                </td>
                                <td>
                                    <div class="fw-semibold text-body"><?= e($r['house_name']) ?></div>
                                    <span class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-geo-alt me-1"></i>Brgy. <?= e($r['barangay']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-body border"><?= ucfirst(str_replace('_', ' ', $r['room_type'])) ?></span>
                                </td>
                                <td>
                                    <span><?= $r['capacity_beds'] ?> beds</span>
                                    <span class="text-muted" style="font-size: 0.72rem;">(<?= $r['occupied_beds'] ?> taken)</span>
                                </td>
                                <td>
                                    <?php if ($r['vacant_beds'] > 0): ?>
                                        <span class="badge bg-success-subtle text-success fs-7 fw-bold px-2.5 py-1">
                                            <?= $r['vacant_beds'] ?> Vacancy
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger px-2.5 py-1">Full</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong class="text-dark">₱<?= number_format($r['rate_per_month'], 2) ?></strong>
                                    <span class="text-muted" style="font-size: 0.7rem;">/mo</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <?php if ($r['has_aircon']): ?>
                                            <span class="badge bg-info-subtle text-info border border-info-subtle" title="Airconditioned"><i class="bi bi-snow"></i> Aircon</span>
                                        <?php endif; ?>
                                        <?php if ($r['has_private_cr']): ?>
                                            <span class="badge bg-light text-dark border" title="Private Bathroom"><i class="bi bi-droplet"></i> Private CR</span>
                                        <?php endif; ?>
                                        <?php if ($r['has_study_desk']): ?>
                                            <span class="badge bg-light text-dark border" title="Study Desk"><i class="bi bi-laptop"></i> Desk</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($r['status'] === 'available'): ?>
                                        <span class="badge bg-success">Available</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Occupied</span>
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

<!-- Modal: Add Room -->
<?php if (can('housing.register')): ?>
<div class="modal fade" id="newRoomModal" tabindex="-1" aria-labelledby="newRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?= url('housing/rooms/create') ?>" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header bg-marsu text-white py-2.5">
                <h6 class="modal-title font-weight-bold" id="newRoomModalLabel">
                    <i class="bi bi-door-open-fill me-2"></i>Add New Room Space
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Boarding House Residence <span class="text-danger">*</span></label>
                    <select name="boarding_house_id" class="form-select form-select-sm" required>
                        <option value="">Select Boarding House...</option>
                        <?php foreach ($houses as $h): ?>
                            <option value="<?= $h['id'] ?>"><?= e($h['name']) ?> (<?= e($h['code']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Room Name / Number <span class="text-danger">*</span></label>
                    <input type="text" name="room_number" class="form-control form-control-sm" placeholder="e.g. Room 105, 2nd Floor Room B" required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small fw-bold">Room Type</label>
                        <select name="room_type" class="form-select form-select-sm">
                            <option value="solo">Solo Room (1 Bed)</option>
                            <option value="shared_2" selected>Shared (2 Beds)</option>
                            <option value="shared_4">Shared (4 Beds)</option>
                            <option value="bedspace">Bedspace Only</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-bold">Bed Capacity <span class="text-danger">*</span></label>
                        <input type="number" name="capacity_beds" class="form-control form-control-sm" value="2" min="1" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Monthly Rental Fee per Bed (₱) <span class="text-danger">*</span></label>
                    <input type="number" name="rate_per_month" class="form-control form-control-sm" value="2000" step="50" required>
                </div>
                <div class="d-flex gap-4 mb-2">
                    <div class="form-check form-switch small">
                        <input class="form-check-input" type="checkbox" name="has_aircon" value="1" id="switchAircon">
                        <label class="form-check-label" for="switchAircon">Airconditioned</label>
                    </div>
                    <div class="form-check form-switch small">
                        <input class="form-check-input" type="checkbox" name="has_private_cr" value="1" id="switchCR">
                        <label class="form-check-label" for="switchCR">Private CR</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-save me-1"></i>Save Room Space</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
