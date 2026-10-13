<!-- Tenant Profiles & Directory View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-people me-2 text-gold"></i>Student Tenant Profiles & Directory
        </h1>
        <p class="text-muted small mb-0">Active student occupants, dormitory residents, contact details, and bed space assignments across accredited houses.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Directory
        </button>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newTenantModal">
            <i class="bi bi-person-plus-fill me-1"></i>Register New Tenant
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
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-person-lines-fill me-1 text-gold"></i>Active Tenants
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/residencyhistory') ?>">
                <i class="bi bi-clock-history me-1"></i>Residency History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-grid-3x3-gap me-1"></i>Bed Allocation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/roomassignment') ?>">
                <i class="bi bi-door-closed me-1"></i>Room Assignments
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Active Tenants</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                <?= count(array_filter($tenants ?? [], fn($t) => ($t['status'] ?? '') === 'Active')) ?>
            </div>
            <div class="small text-muted mt-1">Enrolled MarSU student residents</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Accredited Houses</div>
            <div class="h3 font-weight-bold mb-0 text-gold"><?= count($boardingHouses ?? []) ?> Facilities</div>
            <div class="small text-muted mt-1">Boac campus certified</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">CICS Residents</div>
            <div class="h3 font-weight-bold mb-0 text-primary">
                <?= count(array_filter($tenants ?? [], fn($t) => ($t['college'] ?? '') === 'CICS' || strpos($t['program'] ?? '', 'IT') !== false || strpos($t['program'] ?? '', 'Computer') !== false)) ?>
            </div>
            <div class="small text-muted mt-1">IT, CS & IS student majors</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Compliance Status</div>
            <div class="h3 font-weight-bold mb-0 text-success">100%</div>
            <div class="small text-muted mt-1">Emergency contact verified</div>
        </div>
    </div>
</div>

<!-- Tenants Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-card-checklist me-2 text-gold"></i>Registered Boarders & Residents
        </h5>
        <div class="d-flex gap-2">
            <input type="text" id="tenantSearchInput" class="form-control form-control-sm" placeholder="Live search student, room, house..." style="width: 250px;">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="tenantTable">
            <thead class="table-light text-uppercase fs-7 text-muted">
                <tr>
                    <th class="ps-3">Student Info</th>
                    <th>Course & Year</th>
                    <th>Boarding Facility</th>
                    <th>Room & Bed</th>
                    <th>Monthly Rent</th>
                    <th>Move-in Date</th>
                    <th>Status</th>
                    <th class="text-end pe-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tenants)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No tenant records found. Click "Register New Tenant" above to add your first resident!
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tenants as $t): ?>
                        <?php 
                            $displayName = !empty($t['first_name']) ? ($t['first_name'] . ' ' . $t['last_name']) : ($t['name'] ?? 'Student');
                            $studentId   = $t['student_no'] ?? ($t['student_id'] ?? 'N/A');
                            $houseName   = $t['house_name'] ?? ($t['house'] ?? 'Villa Marinduque Dorm');
                            $roomName    = $t['room_number'] ? ('Room ' . $t['room_number'] . ' - ' . ($t['bed_number'] ?? 'Bed A')) : ($t['room'] ?? 'Standard Room');
                            $rent        = is_numeric($t['monthly_rent'] ?? null) ? ('₱' . number_format($t['monthly_rent'], 2)) : ($t['monthly_rent'] ?? '₱1,500.00');
                            $moveIn      = !empty($t['move_in_date']) ? date('M d, Y', strtotime($t['move_in_date'])) : ($t['move_in'] ?? 'Aug 15, 2026');
                        ?>
                        <tr>
                            <td class="ps-3">
                                <div class="fw-bold text-dark"><?= e($displayName) ?></div>
                                <small class="text-muted"><i class="bi bi-person-badge me-1"></i><?= e($studentId) ?></small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border"><?= e($t['program'] ?? 'BSIT') ?></span>
                                <div class="small text-muted"><?= e($t['year_level'] ?? '3rd Year') ?></div>
                            </td>
                            <td>
                                <div class="fw-semibold text-secondary">
                                    <i class="bi bi-building me-1 text-gold"></i><?= e($houseName) ?>
                                </div>
                                <small class="text-muted"><?= e($t['contact_number'] ?? ($t['contact'] ?? '')) ?></small>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                    <i class="bi bi-door-open me-1"></i><?= e($roomName) ?>
                                </span>
                            </td>
                            <td class="fw-bold text-marsu-burgundy">
                                <?= e($rent) ?>
                            </td>
                            <td class="small text-muted">
                                <?= e($moveIn) ?>
                            </td>
                            <td>
                                <?php if (($t['status'] ?? '') === 'Active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        <i class="bi bi-check-circle me-1"></i>Active Tenant
                                    </span>
                                <?php elseif (($t['status'] ?? '') === 'Checked Out'): ?>
                                    <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                        <i class="bi bi-box-arrow-right me-1"></i>Checked Out
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                                        <i class="bi bi-clock-history me-1"></i><?= e($t['status'] ?? 'Pending') ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-3">
                                <?php if (($t['status'] ?? '') === 'Active'): ?>
                                    <form action="<?= url('housing/tenants/delete') ?>" method="POST" class="d-inline" onsubmit="return confirm('Check out this tenant and free up their bed space?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= (int)($t['id'] ?? 0) ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2" title="Check-out Tenant">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Register New Tenant -->
<div class="modal fade" id="newTenantModal" tabindex="-1" aria-labelledby="newTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newTenantModalLabel">
                    <i class="bi bi-person-plus-fill me-2 text-gold"></i>Register New Student Tenant
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/tenants/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Student ID No. <span class="text-danger">*</span></label>
                            <input type="text" name="student_no" class="form-control form-control-sm" required placeholder="e.g. 23-0145">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control form-control-sm" required placeholder="e.g. Juan">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control form-control-sm" required placeholder="e.g. Dela Cruz">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Gender</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">College</label>
                            <input type="text" name="college" class="form-control form-control-sm" value="CICS" placeholder="e.g. CICS">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Degree Program</label>
                            <input type="text" name="program" class="form-control form-control-sm" value="BS Information Technology" placeholder="e.g. BSIT">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Year Level</label>
                            <select name="year_level" class="form-select form-select-sm">
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year" selected>3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Phone Number</label>
                            <input type="text" name="contact_number" class="form-control form-control-sm" placeholder="0917-xxx-xxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">MarSU Email Address</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="student@marsu.edu.ph">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                            <select name="boarding_house_id" class="form-select form-select-sm" required>
                                <option value="">-- Select Boarding House --</option>
                                <?php foreach ($boardingHouses ?? [] as $bh): ?>
                                    <option value="<?= (int)$bh['id'] ?>"><?= e($bh['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Room Unit</label>
                            <select name="room_id" class="form-select form-select-sm">
                                <option value="">-- Select Room --</option>
                                <?php foreach ($rooms ?? [] as $rm): ?>
                                    <option value="<?= (int)$rm['id'] ?>"><?= e($rm['room_number']) ?> (₱<?= number_format($rm['monthly_rate'], 2) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Bed Space</label>
                            <input type="text" name="bed_number" class="form-control form-control-sm" value="Bed A" placeholder="e.g. Bed A">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Move-in Date</label>
                            <input type="date" name="move_in_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Agreed Monthly Rent (₱)</label>
                            <input type="number" step="0.01" name="monthly_rent" class="form-control form-control-sm" value="1500.00" placeholder="1500.00">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Emergency Contact Person</label>
                            <input type="text" name="emergency_contact_name" class="form-control form-control-sm" placeholder="Parent or Guardian Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Emergency Contact Phone</label>
                            <input type="text" name="emergency_contact_phone" class="form-control form-control-sm" placeholder="0918-xxx-xxxx">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-save me-1"></i>Save Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tenantSearchInput');
    const table = document.getElementById('tenantTable');
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
