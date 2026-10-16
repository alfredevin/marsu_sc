<!-- Room & Inventory Management View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-box-seam me-2 text-gold"></i>Room Inventory & Furniture Assets
        </h1>
        <p class="text-muted small mb-0">Track fixtures, beds, room capacity, electric meters, and safety equipment assigned per room unit across boarding houses.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Inventory
        </button>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newRoomModal">
            <i class="bi bi-plus-lg me-1"></i>Add Room Unit
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
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-box-seam me-1 text-gold"></i>Room & Inventory
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
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/occupancymonitoring') ?>">
                <i class="bi bi-pie-chart me-1"></i>Occupancy Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-grid-3x3 me-1"></i>Bed Allocation
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Room Units</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($rooms ?? []) ?></div>
            <div class="small text-muted mt-1">Across accredited facilities</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Bed Capacity</div>
            <div class="h3 font-weight-bold mb-0 text-gold">
                <?= array_sum(array_column($rooms ?? [], 'capacity')) ?> Beds
            </div>
            <div class="small text-muted mt-1">Maximum student occupancy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Occupied Beds</div>
            <div class="h3 font-weight-bold mb-0 text-primary">
                <?= array_sum(array_column($rooms ?? [], 'occupied_beds')) ?> Beds
            </div>
            <div class="small text-muted mt-1">Currently residing students</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Vacant Beds Available</div>
            <div class="h3 font-weight-bold mb-0 text-success">
                <?= max(0, array_sum(array_column($rooms ?? [], 'capacity')) - array_sum(array_column($rooms ?? [], 'occupied_beds'))) ?> Vacancies
            </div>
            <div class="small text-muted mt-1">Ready for student occupancy</div>
        </div>
    </div>
</div>

<!-- Inventory Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-check me-2 text-gold"></i>Room Units & Inventory Directory
        </h6>
        <div class="d-flex gap-2">
            <input type="text" id="roomSearchInput" class="form-control form-control-sm" style="width: 250px;" placeholder="Search room, house, floor...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="roomTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Room Unit</th>
                        <th>Boarding Facility</th>
                        <th>Room Type & Floor</th>
                        <th>Capacity / Occupied</th>
                        <th>Monthly Rate</th>
                        <th>Status</th>
                        <th>Amenities & Equipment</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rooms)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No rooms recorded in inventory. Click "Add Room Unit" to register a room.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($rooms as $r): ?>
                            <?php 
                                $vacant = max(0, (int)$r['capacity'] - (int)$r['occupied_beds']);
                                $statusBadge = ($vacant === 0) 
                                    ? '<span class="badge bg-danger-subtle text-danger border border-danger">Full</span>'
                                    : '<span class="badge bg-success-subtle text-success border border-success">Available (' . $vacant . ' vacant)</span>';
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark">
                                    <i class="bi bi-door-closed text-gold me-1"></i><?= e($r['room_number']) ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?></div>
                                    <div class="small text-muted"><?= e($r['house_address'] ?? 'Boac, Marinduque') ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis me-1"><?= e($r['room_type']) ?></span>
                                    <small class="text-muted d-block"><?= e($r['floor'] ?? '1st Floor') ?></small>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= (int)$r['occupied_beds'] ?> / <?= (int)$r['capacity'] ?> Beds</div>
                                    <div class="progress mt-1" style="height: 6px; width: 100px;">
                                        <?php $pct = $r['capacity'] > 0 ? round(($r['occupied_beds'] / $r['capacity']) * 100) : 0; ?>
                                        <div class="progress-bar <?= $pct >= 100 ? 'bg-danger' : 'bg-primary' ?>" style="width: <?= $pct ?>%"></div>
                                    </div>
                                </td>
                                <td class="fw-bold text-marsu-burgundy">
                                    ₱<?= number_format((float)$r['monthly_rate'], 2) ?>
                                </td>
                                <td>
                                    <?= $statusBadge ?>
                                </td>
                                <td>
                                    <small class="text-muted"><?= e($r['amenities'] ?? 'Wi-Fi, Study Desk, Locker') ?></small>
                                </td>
                                <td class="text-end pe-3">
                                    <form action="<?= url('housing/rooms/delete') ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this room unit from inventory?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" title="Delete Room">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Add Room Unit to Inventory -->
<div class="modal fade" id="newRoomModal" tabindex="-1" aria-labelledby="newRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newRoomModalLabel">
                    <i class="bi bi-door-open-fill me-2 text-gold"></i>Add Room Unit to Inventory
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/rooms/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                        <select name="boarding_house_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Boarding House --</option>
                            <?php foreach ($boardingHouses ?? [] as $bh): ?>
                                <option value="<?= (int)$bh['id'] ?>"><?= e($bh['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room Number / Tag <span class="text-danger">*</span></label>
                            <input type="text" name="room_number" class="form-control form-control-sm" required placeholder="e.g. Room 205">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room Classification</label>
                            <select name="room_type" class="form-select form-select-sm">
                                <option value="Single">Single (1 Bed)</option>
                                <option value="Double" selected>Double (2 Beds)</option>
                                <option value="Triple">Triple (3 Beds)</option>
                                <option value="Quad">Quad (4 Beds)</option>
                                <option value="Dormitory">Dormitory (6+ Beds)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Bed Capacity</label>
                            <input type="number" name="capacity" min="1" max="10" value="2" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Floor Level</label>
                            <input type="text" name="floor" value="1st Floor" class="form-control form-control-sm" placeholder="e.g. 2nd Floor">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Monthly Rate (₱)</label>
                            <input type="number" step="0.01" name="monthly_rate" value="1500.00" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Amenities & Room Inclusions</label>
                        <input type="text" name="amenities" class="form-control form-control-sm" value="Wall Fan, Study Desk, Locker, Foam Mattress" placeholder="e.g. Aircon, Fan, Balcony">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-save me-1"></i>Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('roomSearchInput');
    const table = document.getElementById('roomTable');
    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }
});
</script>
