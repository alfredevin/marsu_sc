<!-- Maintenance Request View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-tools me-2 text-gold"></i>Student Facility Maintenance Requests
        </h1>
        <p class="text-muted small mb-0">Lodge and track repair work orders for plumbing, electrical wiring, carpentry, and facility repairs across boarding houses.</p>
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
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-wrench-adjustable me-2 text-gold"></i>Active Maintenance Work Orders
        </h6>
        <div class="d-flex gap-2">
            <input type="text" id="ticketSearchInput" class="form-control form-control-sm" placeholder="Search ticket, room, category..." style="width: 250px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="ticketTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Ticket ID</th>
                        <th>Facility & Room</th>
                        <th>Issue Category</th>
                        <th>Issue Summary & Reporter</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tickets)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No active maintenance tickets found. Click "File Repair Request" to report an issue!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tickets as $tk): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark">
                                    <i class="bi bi-ticket-detailed text-gold me-1"></i><?= e($tk['ticket_number']) ?>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= e($tk['house_name'] ?? 'Villa Marinduque Dorm') ?></div>
                                    <div class="small text-muted"><?= e($tk['room_number']) ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis"><?= e($tk['issue_category']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= e($tk['issue_title']) ?></div>
                                    <div class="small text-muted text-truncate" style="max-width: 280px;"><?= e($tk['description']) ?></div>
                                    <div class="small text-secondary">Reported by: <?= e($tk['reported_by']) ?></div>
                                </td>
                                <td>
                                    <?php if ($tk['priority'] === 'Emergency'): ?>
                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Emergency</span>
                                    <?php elseif ($tk['priority'] === 'High'): ?>
                                        <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i>High</span>
                                    <?php else: ?>
                                        <span class="badge bg-info-subtle text-info border"><i class="bi bi-info-circle me-1"></i><?= e($tk['priority']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($tk['status'] === 'Resolved'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Resolved</span>
                                    <?php elseif ($tk['status'] === 'In Progress'): ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"><i class="bi bi-gear-fill me-1"></i>In Progress</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle"><i class="bi bi-clock me-1"></i>Open</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-3">
                                    <?php if ($tk['status'] !== 'Resolved'): ?>
                                        <form action="<?= url('housing/maintenance/status') ?>" method="POST" class="d-inline" onsubmit="return confirm('Mark this maintenance ticket as Resolved?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= (int)$tk['id'] ?>">
                                            <input type="hidden" name="status" value="Resolved">
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Mark Done">
                                                <i class="bi bi-check-lg"></i> Mark Done
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-success small fw-semibold"><i class="bi bi-check-all me-1"></i>Completed</span>
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

<!-- Modal Add Maintenance -->
<div class="modal fade" id="newMaintenanceModal" tabindex="-1" aria-labelledby="newMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newMaintenanceModalLabel">
                    <i class="bi bi-tools me-2 text-gold"></i>File Maintenance / Repair Ticket
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/maintenance/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                        <select name="boarding_house_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Boarding House --</option>
                            <?php foreach ($houses ?? [] as $bh): ?>
                                <option value="<?= (int)$bh['id'] ?>"><?= e($bh['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room Unit / Location <span class="text-danger">*</span></label>
                            <input type="text" name="room_number" class="form-control form-control-sm" required placeholder="e.g. Room 102 / 2nd Floor Bath">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Reported By (Resident Name) <span class="text-danger">*</span></label>
                            <input type="text" name="reported_by" class="form-control form-control-sm" required placeholder="e.g. Maria Santos">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Issue Category</label>
                            <select name="issue_category" class="form-select form-select-sm">
                                <option value="Plumbing">Plumbing & Water Supply</option>
                                <option value="Electrical">Electrical & Lighting</option>
                                <option value="Carpentry">Carpentry, Locks & Windows</option>
                                <option value="Sanitation">Sanitation & Pest Control</option>
                                <option value="Appliance">Appliance / Wall Fan / Aircon</option>
                                <option value="Security">Security & Door Locks</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Priority Urgency</label>
                            <select name="priority" class="form-select form-select-sm">
                                <option value="Low">Low (General maintenance)</option>
                                <option value="Medium" selected>Medium (Within 48 hours)</option>
                                <option value="High">High (Within 24 hours)</option>
                                <option value="Emergency">Emergency (Immediate hazard)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Issue Title / Subject <span class="text-danger">*</span></label>
                        <input type="text" name="issue_title" class="form-control form-control-sm" required placeholder="e.g. Bathroom faucet leaking continuously">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Detailed Description</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Describe the defect, location, and condition..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Estimated Cost (₱) (Optional)</label>
                        <input type="number" step="0.01" name="estimated_cost" value="0.00" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-send me-1"></i>Submit Work Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('ticketSearchInput');
    const table = document.getElementById('ticketTable');
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
