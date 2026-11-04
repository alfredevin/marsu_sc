<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-geo-alt me-2 text-gold"></i>Venue and Schedule Management
            </h1>
            <p class="text-muted small mb-0">Manage venue listings, availability status, and booking schedules for organization activities.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createVenueModal">
                <i class="bi bi-plus-circle me-1"></i>New Venue
            </button>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>
        </div>
    </div>

    <?php
        $totalVenues      = count($venues);
        $availableCount   = count(array_filter($venues, fn($v) => $v['venue_status'] === 'Available'));
        $unavailableCount = count(array_filter($venues, fn($v) => in_array($v['venue_status'], ['Unavailable', 'Maintenance'])));
    ?>

    <!-- KPI Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Venues</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= $totalVenues ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Available</div>
                        <div class="h3 font-weight-bold mb-0 text-success"><?= $availableCount ?></div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Unavailable / Maintenance</div>
                        <div class="h3 font-weight-bold mb-0 text-danger"><?= $unavailableCount ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="fw-bold text-marsu-burgundy"><i class="bi bi-table me-2"></i>Registered Venues</span>
            <div class="d-flex align-items-center gap-2">
                <div class="input-group input-group-sm" style="max-width: 260px;">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="venueSearchInput" class="form-control form-control-sm" placeholder="Search venues...">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="venuesTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Venue Name</th>
                        <th>Status</th>
                        <th>Active Bookings</th>
                        <th>Date Added</th>
                        <th class="text-end" style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($venues)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold"></i>
                                No venues found. Click "New Venue" to add one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($venues as $i => $venue): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <strong><i class="bi bi-geo-alt me-1 text-gold"></i><?= e($venue['venue_name']) ?></strong>
                                </td>
                                <td>
                                    <?php if ($venue['venue_status'] === 'Available'): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Available</span>
                                    <?php elseif ($venue['venue_status'] === 'Unavailable'): ?>
                                        <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Unavailable</span>
                                    <?php elseif ($venue['venue_status'] === 'Maintenance'): ?>
                                        <span class="badge bg-warning text-dark"><i class="bi bi-tools me-1"></i>Maintenance</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= (int)$venue['bookings_count'] ?> booking<?= (int)$venue['bookings_count'] !== 1 ? 's' : '' ?>
                                    </span>
                                </td>
                                <td><?= e(date('M d, Y', strtotime($venue['created_at']))) ?></td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editVenueModal<?= (int)$venue['id'] ?>" title="Edit venue">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#statusVenueModal<?= (int)$venue['id'] ?>" title="Change status">
                                        <i class="bi bi-shield-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteVenueModal<?= (int)$venue['id'] ?>" title="Delete venue">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Create Venue -->
<div class="modal fade" id="createVenueModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Add New Venue</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/venues/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Venue Name <span class="text-danger">*</span></label>
                        <input type="text" name="venue_name" class="form-control form-control-sm" required placeholder="e.g. Student Center Auditorium">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Initial Status</label>
                        <select name="venue_status" class="form-select form-select-sm">
                            <?php foreach ($venueStatuses as $status): ?>
                                <option value="<?= e($status) ?>" <?= $status === 'Available' ? 'selected' : '' ?>><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-check-lg me-1"></i>Save Venue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals: Edit, Status, and Delete per Venue -->
<?php foreach ($venues as $venue): ?>
<div class="modal fade" id="editVenueModal<?= (int)$venue['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Venue #<?= (int)$venue['id'] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/venues/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="venue_id" value="<?= (int)$venue['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Venue Name <span class="text-danger">*</span></label>
                        <input type="text" name="venue_name" class="form-control form-control-sm" required value="<?= e($venue['venue_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Venue Status</label>
                        <select name="venue_status" class="form-select form-select-sm">
                            <?php foreach ($venueStatuses as $status): ?>
                                <option value="<?= e($status) ?>" <?= $venue['venue_status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Update Venue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="statusVenueModal<?= (int)$venue['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fs-6"><i class="bi bi-shield-check me-2"></i>Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/venues/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="venue_id" value="<?= (int)$venue['id'] ?>">
                <input type="hidden" name="venue_name" value="<?= e($venue['venue_name']) ?>">
                <div class="modal-body py-3">
                    <p class="small text-muted mb-2">Change status for <strong><?= e($venue['venue_name']) ?></strong>:</p>
                    <select name="venue_status" class="form-select form-select-sm" required>
                        <?php foreach ($venueStatuses as $status): ?>
                            <option value="<?= e($status) ?>" <?= $venue['venue_status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-check2 me-1"></i>Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteVenueModal<?= (int)$venue['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Delete Venue</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/venues/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="venue_id" value="<?= (int)$venue['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to delete this venue?</p>
                    <strong class="text-danger"><?= e($venue['venue_name']) ?></strong>
                    <?php if ((int)$venue['bookings_count'] > 0): ?>
                        <div class="alert alert-warning small mt-2 mb-0 py-1 px-2">
                            <i class="bi bi-info-circle me-1"></i>This venue has <?= (int)$venue['bookings_count'] ?> active booking<?= (int)$venue['bookings_count'] !== 1 ? 's' : '' ?>.
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Table Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('venueSearchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#venuesTable tbody tr');
            rows.forEach(function (row) {
                if (row.querySelector('td[colspan]')) return;
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
});
</script>
