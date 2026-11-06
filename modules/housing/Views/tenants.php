<!-- Tenant Profiles & Directory View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>

<style>
/* ==========================================================================
   TENANT PROFILES & DIRECTORY - ENHANCED VISUALS & INTERACTIVE TOKENS
   ========================================================================== */
.bg-marsu {
    background-color: #800020 !important;
    color: #ffffff !important;
}
.bg-marsu-gradient {
    background: linear-gradient(135deg, #800020 0%, #4a0011 100%) !important;
    color: #ffffff !important;
}
.text-marsu-burgundy {
    color: #800020 !important;
}

/* Modal Header - High Contrast Burgundy & Gold */
.modal-header-marsu {
    background: linear-gradient(135deg, #800020 0%, #4e0013 100%) !important;
    color: #ffffff !important;
    border-bottom: 3.5px solid #D4AF37 !important;
    padding: 1.15rem 1.5rem !important;
}
.modal-header-marsu .modal-title {
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 1.15rem;
    letter-spacing: -0.01em;
}
.modal-header-marsu .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: 0.85;
}
.modal-header-marsu .btn-close:hover {
    opacity: 1;
}

/* Resident Profile Banner Card */
.resident-banner-card {
    background: linear-gradient(135deg, #fffcf5 0%, #fbf3e4 100%);
    border: 1.5px solid #e8d7b0;
    border-left: 5px solid #800020;
    border-radius: 12px;
    padding: 1.1rem 1.25rem;
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.05);
}
[data-bs-theme="dark"] .resident-banner-card {
    background: linear-gradient(135deg, #24050c 0%, #1a0308 100%);
    border-color: #5c1825;
    border-left-color: #D4AF37;
}

.resident-avatar-circle {
    width: 56px;
    height: 56px;
    min-width: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #800020 0%, #a31538 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    box-shadow: 0 4px 10px rgba(128, 0, 32, 0.28);
    border: 2px solid #D4AF37;
}

/* Interactive Navigation Tabs inside Modal */
.custom-modal-tabs {
    border-bottom: 1.5px solid #e9ecef;
    padding-bottom: 0.5rem;
}
.custom-modal-tabs .nav-link {
    color: #495057;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
}
.custom-modal-tabs .nav-link:hover {
    color: #800020;
    background: #fdf2f4;
    border-color: #e8b3bd;
    transform: translateY(-1px);
}
.custom-modal-tabs .nav-link.active {
    color: #ffffff !important;
    background: linear-gradient(135deg, #800020 0%, #610018 100%) !important;
    border-color: #800020 !important;
    box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
}
[data-bs-theme="dark"] .custom-modal-tabs {
    border-color: #3b141d;
}
[data-bs-theme="dark"] .custom-modal-tabs .nav-link {
    color: #e2d9dc;
    background: #23080e;
    border-color: #4a1420;
}
[data-bs-theme="dark"] .custom-modal-tabs .nav-link.active {
    color: #240008 !important;
    background: linear-gradient(135deg, #e8c65d 0%, #D4AF37 100%) !important;
    border-color: #D4AF37 !important;
}

/* Interactive Room Transfer Card */
.room-transfer-card {
    background: #ffffff;
    border: 1.5px solid #edd9af;
    border-radius: 12px;
    padding: 1.25rem;
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.08);
}
[data-bs-theme="dark"] .room-transfer-card {
    background: #1e070c;
    border-color: #5c3810;
}

/* Live Room Preview Badge Box */
.room-live-preview {
    background: #fdfaf2;
    border: 1px dashed #D4AF37;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.22s ease;
}
[data-bs-theme="dark"] .room-live-preview {
    background: #291807;
    border-color: #8c6b1a;
}

/* Action button in table */
.btn-view-tenant-action {
    background: #ffffff;
    color: #800020;
    border: 1.5px solid #800020;
    font-weight: 600;
    font-size: 0.78rem;
    padding: 0.25rem 0.65rem;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    transition: all 0.18s ease;
    cursor: pointer;
    text-decoration: none;
}
.btn-view-tenant-action:hover {
    background: #800020;
    color: #ffffff !important;
    border-color: #800020;
    box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
    transform: translateY(-1px);
}
.btn-view-tenant-action:hover i {
    color: #ffffff !important;
}

/* Copy Student ID button */
.btn-copy-id {
    cursor: pointer;
    transition: all 0.15s ease;
}
.btn-copy-id:hover {
    background-color: #e9ecef !important;
    color: #800020 !important;
}

/* Input icons styling */
.input-icon-group .input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #800020;
}
[data-bs-theme="dark"] .input-icon-group .input-group-text {
    background-color: #24080e;
    border-color: #4a1420;
    color: #D4AF37;
}

/* Animated status pulse */
.pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}
.pulse-dot-active {
    background-color: #198754;
    box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.25);
}
.pulse-dot-checkedout {
    background-color: #6c757d;
}
.pulse-dot-pending {
    background-color: #fd7e14;
    box-shadow: 0 0 0 2px rgba(253, 126, 20, 0.25);
}
</style>
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
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-person-lines-fill me-1"></i>Active Tenants
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/residencyhistory') ?>">
                <i class="bi bi-clock-history me-1"></i>Residency History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-grid-3x3-gap me-1"></i>Bed Allocation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/roomassignment') ?>">
                <i class="bi bi-door-closed me-1"></i>Room Assignments
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards (Modern, High-Contrast & User-Friendly) -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Total Active Tenants</div>
                    <div class="kpi-value text-marsu-burgundy">
                        <?= count(array_filter($tenants ?? [], fn($t) => ($t['status'] ?? '') === 'Active')) ?>
                        <span class="kpi-unit">Residents</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Active Tenants">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-person-check-fill text-marsu-burgundy"></i>
                <span>Enrolled MarSU student residents</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Accredited Houses</div>
                    <div class="kpi-value text-gold">
                        <?= count($boardingHouses ?? []) ?>
                        <span class="kpi-unit">Facilities</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Accredited Houses">
                    <i class="bi bi-buildings-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-patch-check-fill text-gold-dark"></i>
                <span>Boac campus certified</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">CICS Residents</div>
                    <div class="kpi-value text-gold">
                        <?= count(array_filter($tenants ?? [], fn($t) => ($t['college'] ?? '') === 'CICS' || strpos($t['program'] ?? '', 'IT') !== false || strpos($t['program'] ?? '', 'Computer') !== false)) ?>
                        <span class="kpi-unit">Majors</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="CICS Enrollees">
                    <i class="bi bi-laptop-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-code-slash text-gold-dark"></i>
                <span>IT, CS & IS student majors</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Compliance Status</div>
                    <div class="kpi-value text-success">
                        100%
                        <span class="badge bg-success-subtle text-success border border-success-subtle fs-7 fw-semibold ms-1">Passed</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Verified Compliance">
                    <i class="bi bi-shield-fill-check"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-check-circle-fill text-success"></i>
                <span>Emergency contact verified</span>
            </div>
        </div>
    </div>
</div>

<!-- Tenants Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-card-checklist me-2 text-gold"></i>Registered Boarders & Residents
        </h5>
        <div class="d-flex align-items-center gap-2">
            <span id="tenantSearchCount" class="badge bg-light text-muted border small" style="display: none;"></span>
            <div class="input-group input-group-sm" style="width: 270px;">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-search"></i></span>
                <input type="text" id="tenantSearchInput" class="form-control form-control-sm" placeholder="Live search student, room, house...">
            </div>
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
                            $roomName    = $t['room_number'] ? ((stripos($t['room_number'], 'room') === 0 ? '' : 'Room ') . $t['room_number'] . ' - ' . ($t['bed_number'] ?? 'Bed A')) : ($t['room'] ?? 'Standard Room');
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
                                </div>                            </td>
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
                                <div class="d-inline-flex gap-1 justify-content-end align-items-center">
                                    <button type="button" 
                                            class="btn-view-tenant-action btn-view-tenant" 
                                            title="View & Edit Resident Information"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewEditTenantModal"
                                            data-tenant="<?= htmlspecialchars(json_encode($t), ENT_QUOTES, 'UTF-8') ?>">
                                        <i class="bi bi-pencil-square text-gold"></i><span>View / Edit</span>
                                    </button>
                                <?php if (($t['status'] ?? '') === 'Active'): ?>
                                    <form action="<?= url('housing/tenants/delete') ?>" method="POST" class="d-inline m-0" onsubmit="return confirm('Check out this tenant and free up their bed space?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= (int)($t['id'] ?? 0) ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2" title="Check-out Tenant">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                </div>
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
            <div class="modal-header modal-header-marsu">
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
                                    <option value="<?= (int)$rm['id'] ?>" data-house-id="<?= (int)($rm['boarding_house_id'] ?? 0) ?>" data-rate="<?= (float)($rm['monthly_rate'] ?? 0) ?>">Room <?= e($rm['room_number']) ?> (₱<?= number_format($rm['monthly_rate'], 2) ?>)</option>
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

<!-- Modal: View & Modify Resident Information -->
<div class="modal fade" id="viewEditTenantModal" tabindex="-1" aria-labelledby="viewEditTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <!-- High-Contrast MarSU Burgundy & Gold Header -->
            <div class="modal-header modal-header-marsu">
                <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-gold text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px; font-size: 1.05rem;">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="viewEditTenantModalLabel">
                                Resident Information & Room Assignment
                            </h5>
                            <small class="text-white-50" style="font-size: 0.78rem;">ISHAMIS Student Accommodation Management</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-gold text-dark px-2 py-1 fw-bold fs-8 border border-warning shadow-sm">
                            <i class="bi bi-shield-check me-1"></i>Admin Verified
                        </span>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <form action="<?= url('housing/tenants/update') ?>" method="POST" id="editTenantForm">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_tenant_id">

                <div class="modal-body p-4">
                    <!-- Resident Profile Summary Banner Card -->
                    <div class="resident-banner-card mb-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="resident-avatar-circle" id="view_avatar_box">
                                    <i class="bi bi-person-fill" id="view_avatar_icon"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h4 class="mb-0 fw-bold text-dark" id="view_resident_name">Resident Name</h4>
                                        <span id="view_status_badge" class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <span class="pulse-dot pulse-dot-active" id="view_status_dot"></span>
                                            <span id="view_status_text">Active Tenant</span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mt-1 flex-wrap">
                                        <button type="button" class="btn btn-sm btn-white bg-white border py-0 px-2 text-dark font-monospace btn-copy-id shadow-none" id="btnCopyStudentNo" title="Click to copy Student ID">
                                            <i class="bi bi-person-badge text-gold me-1"></i><span id="view_student_no_badge">23-0000</span>
                                            <i class="bi bi-clipboard ms-1 text-muted" id="copyIcon"></i>
                                            <span id="copyFeedback" class="text-success small fw-bold ms-1" style="display: none;">Copied!</span>
                                        </button>
                                        <span class="badge bg-light text-secondary border" id="view_academic_pill">
                                            <i class="bi bi-mortarboard me-1 text-gold"></i><span id="view_course_text">BSIT • 3rd Year</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Current Placement Overview -->
                            <div class="text-md-end text-start">
                                <span class="text-muted small fw-semibold text-uppercase d-block" style="letter-spacing: 0.05em; font-size: 0.72rem;">Current Placement</span>
                                <div class="fw-bold text-marsu-burgundy fs-6" id="view_house_text">Boac Pines Boarding House</div>
                                <div class="small text-muted" id="view_room_bed_text">
                                    <i class="bi bi-door-open me-1 text-gold"></i><span id="view_room_bed_val">Room 201 - Bed A</span>
                                    <span class="mx-1">•</span>
                                    <span class="fw-semibold text-dark" id="view_rent_text">₱1,500.00/mo</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Nav Tabs inside Modal -->
                    <ul class="nav nav-pills custom-modal-tabs mb-3 gap-2" id="tenantModalTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-transfer-btn" data-bs-toggle="pill" data-bs-target="#tab-transfer" type="button" role="tab">
                                <i class="bi bi-door-open-fill me-1 text-gold"></i>Room Transfer & Placement
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-profile-btn" data-bs-toggle="pill" data-bs-target="#tab-profile" type="button" role="tab">
                                <i class="bi bi-person-vcard me-1 text-gold"></i>Student Academic Profile
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-emergency-btn" data-bs-toggle="pill" data-bs-target="#tab-emergency" type="button" role="tab">
                                <i class="bi bi-shield-lock-fill me-1 text-gold"></i>Emergency & Contacts
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="tenantModalTabsContent">
                        <!-- TAB 1: Room Transfer & Placement -->
                        <div class="tab-pane fade show active" id="tab-transfer" role="tabpanel">
                            <div class="room-transfer-card mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
                                    <div>
                                        <span class="fw-bold text-marsu-burgundy fs-6">
                                            <i class="bi bi-arrow-left-right me-1 text-gold"></i>Room Placement & Facility Transfer
                                        </span>
                                        <p class="small text-muted mb-0">Reassign or transfer resident to a new facility or room unit. Bed space occupancy automatically syncs.</p>
                                    </div>
                                    <span class="badge bg-gold-subtle text-gold-dark border border-gold-subtle">
                                        <i class="bi bi-lightning-charge-fill me-1"></i>Live Occupancy Sync
                                    </span>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                                            <select name="boarding_house_id" id="edit_boarding_house_id" class="form-select form-select-sm" required>
                                                <option value="">-- Select Boarding House --</option>
                                                <?php foreach ($boardingHouses ?? [] as $bh): ?>
                                                    <option value="<?= (int)$bh['id'] ?>"><?= e($bh['name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Room Unit <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-door-closed"></i></span>
                                            <select name="room_id" id="edit_room_id" class="form-select form-select-sm">
                                                <option value="">-- Select Room --</option>
                                                <?php foreach ($rooms ?? [] as $rm): ?>
                                                    <option value="<?= (int)$rm['id'] ?>" 
                                                            data-house-id="<?= (int)($rm['boarding_house_id'] ?? 0) ?>" 
                                                            data-rate="<?= (float)($rm['monthly_rate'] ?? 0) ?>"
                                                            data-type="<?= e($rm['room_type'] ?? 'Double') ?>"
                                                            data-capacity="<?= (int)($rm['capacity'] ?? 2) ?>"
                                                            data-occupied="<?= (int)($rm['occupied_beds'] ?? 0) ?>">
                                                        Room <?= e($rm['room_number']) ?> (₱<?= number_format($rm['monthly_rate'], 2) ?><?= !empty($rm['room_type']) ? ' - ' . e($rm['room_type']) : '' ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Bed Space</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-grid-3x3"></i></span>
                                            <input type="text" name="bed_number" id="edit_bed_number" class="form-control form-control-sm" placeholder="e.g. Bed A">
                                        </div>
                                    </div>
                                </div>

                                <!-- Interactive Live Room Preview Indicator -->
                                <div class="room-live-preview mb-3" id="roomLivePreviewBox" style="display: none;">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-gold text-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.9rem;">
                                                <i class="bi bi-check2"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold small text-dark" id="previewRoomTitle">Selected Room Details</div>
                                                <small class="text-muted" id="previewRoomDesc">Type: Double • 1 of 2 beds vacant</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-white text-marsu-burgundy border fw-bold fs-7 shadow-sm" id="previewRoomRateBadge">₱1,500.00 / mo</span>
                                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 small" id="btnApplySelectedRate" title="Apply this standard rate to agreed rent">
                                                <i class="bi bi-arrow-down-circle me-1 text-gold"></i>Apply Rate
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Agreed Monthly Rent (₱)</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text fw-bold text-marsu-burgundy">₱</span>
                                            <input type="number" step="0.01" name="monthly_rent" id="edit_monthly_rent" class="form-control form-control-sm" placeholder="1500.00">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Move-in Date</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                            <input type="date" name="move_in_date" id="edit_move_in_date" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Move-out Date</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-calendar-x"></i></span>
                                            <input type="date" name="move_out_date" id="edit_move_out_date" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Residency Status</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                            <select name="status" id="edit_status" class="form-select form-select-sm">
                                                <option value="Active">Active Tenant</option>
                                                <option value="Checked Out">Checked Out</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Evicted">Evicted</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 pt-md-3">
                                        <div class="alert alert-light border small text-muted py-2 px-3 mb-0 w-100 d-flex align-items-center" id="statusChangeNotice">
                                            <i class="bi bi-check-circle-fill text-success me-2 fs-6" id="statusNoticeIcon"></i>
                                            <span id="statusNoticeText">Resident is actively occupying this bed space.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: Academic & Personal Info -->
                        <div class="tab-pane fade" id="tab-profile" role="tabpanel">
                            <div class="card border p-3 rounded-3 mb-3 bg-white">
                                <h6 class="fw-bold text-marsu-burgundy border-bottom pb-2 mb-3">
                                    <i class="bi bi-mortarboard-fill me-2 text-gold"></i>Student Enrollment & Identification
                                </h6>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Student ID No. <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                            <input type="text" name="student_no" id="edit_student_no" class="form-control form-control-sm" required placeholder="e.g. 23-0145">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" id="edit_first_name" class="form-control form-control-sm" required placeholder="e.g. Juan">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" id="edit_last_name" class="form-control form-control-sm" required placeholder="e.g. Dela Cruz">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Gender</label>
                                        <select name="gender" id="edit_gender" class="form-select form-select-sm">
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">College</label>
                                        <input type="text" name="college" id="edit_college" class="form-control form-control-sm" placeholder="e.g. CICS">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Degree Program</label>
                                        <input type="text" name="program" id="edit_program" class="form-control form-control-sm" placeholder="e.g. BS Information Technology">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Year Level</label>
                                        <select name="year_level" id="edit_year_level" class="form-select form-select-sm">
                                            <option value="1st Year">1st Year</option>
                                            <option value="2nd Year">2nd Year</option>
                                            <option value="3rd Year">3rd Year</option>
                                            <option value="4th Year">4th Year</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Contact Phone Number</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                            <input type="text" name="contact_number" id="edit_contact_number" class="form-control form-control-sm" placeholder="0917-xxx-xxxx">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">MarSU Email Address</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" name="email" id="edit_email" class="form-control form-control-sm" placeholder="student@marsu.edu.ph">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: Emergency Contacts & Compliance -->
                        <div class="tab-pane fade" id="tab-emergency" role="tabpanel">
                            <div class="card border p-3 rounded-3 mb-3 bg-white">
                                <h6 class="fw-bold text-marsu-burgundy border-bottom pb-2 mb-3">
                                    <i class="bi bi-shield-check me-2 text-gold"></i>Emergency Contact & Guardian (RA 10173)
                                </h6>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Emergency Contact Person / Guardian</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" name="emergency_contact_name" id="edit_emergency_contact_name" class="form-control form-control-sm" placeholder="Parent or Guardian Full Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Emergency Contact Phone</label>
                                        <div class="input-group input-group-sm input-icon-group">
                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                            <input type="text" name="emergency_contact_phone" id="edit_emergency_contact_phone" class="form-control form-control-sm" placeholder="0918-xxx-xxxx">
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info py-2 px-3 small d-flex align-items-center mb-0" role="alert">
                                    <i class="bi bi-shield-lock-fill me-2 fs-5 text-primary"></i>
                                    <div>
                                        <strong>Statutory Data Privacy Act Notice (RA 10173):</strong> Emergency contact information is strictly handled for student safety, medical emergencies, and housing protocol verification only.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer with High-Contrast Action Buttons -->
                <div class="modal-footer bg-light py-2 px-4 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-marsu btn-sm px-4 shadow-sm">
                        <i class="bi bi-check2-circle me-1"></i>Save Changes & Update Resident
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Live search in table with live counter
    const searchInput = document.getElementById('tenantSearchInput');
    const searchCountBadge = document.getElementById('tenantSearchCount');
    const table = document.getElementById('tenantTable');

    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            let visibleCount = 0;
            let totalCount = 0;

            rows.forEach(row => {
                // Ignore empty-state row if present
                if (row.querySelector('td[colspan]')) return;
                totalCount++;
                const text = row.textContent.toLowerCase();
                const matches = text.includes(term);
                row.style.display = matches ? '' : 'none';
                if (matches) visibleCount++;
            });

            if (searchCountBadge) {
                if (term) {
                    searchCountBadge.style.display = '';
                    searchCountBadge.textContent = visibleCount + ' of ' + totalCount + ' residents';
                    searchCountBadge.className = 'badge ' + (visibleCount > 0 ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle') + ' small';
                } else {
                    searchCountBadge.style.display = 'none';
                }
            }
        });
    }

    // 2. Room dropdown filtering & Live Room Preview
    const editHouseSelect = document.getElementById('edit_boarding_house_id');
    const editRoomSelect = document.getElementById('edit_room_id');
    const livePreviewBox = document.getElementById('roomLivePreviewBox');
    const previewRoomTitle = document.getElementById('previewRoomTitle');
    const previewRoomDesc = document.getElementById('previewRoomDesc');
    const previewRoomRateBadge = document.getElementById('previewRoomRateBadge');
    const btnApplySelectedRate = document.getElementById('btnApplySelectedRate');
    const rentInput = document.getElementById('edit_monthly_rent');

    function updateRoomPreview() {
        if (!editRoomSelect || !livePreviewBox) return;
        const opt = editRoomSelect.options[editRoomSelect.selectedIndex];
        if (!opt || !opt.value) {
            livePreviewBox.style.display = 'none';
            return;
        }

        const rate = opt.getAttribute('data-rate') || '1500.00';
        const type = opt.getAttribute('data-type') || 'Room Unit';
        const cap = parseInt(opt.getAttribute('data-capacity') || '2', 10);
        const occ = parseInt(opt.getAttribute('data-occupied') || '0', 10);
        const vacant = Math.max(0, cap - occ);

        livePreviewBox.style.display = '';
        previewRoomTitle.textContent = opt.textContent.trim().split('(')[0] + ' (' + type + ')';
        previewRoomDesc.textContent = 'Capacity: ' + cap + ' beds • Occupied: ' + occ + ' • ' + (vacant > 0 ? (vacant + ' Bed(s) Available') : 'Full / No vacancy');
        previewRoomRateBadge.textContent = '₱' + parseFloat(rate).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' / mo';
    }

    function filterEditRooms(selectedHouseId, currentRoomId) {
        if (!editRoomSelect) return;
        const options = editRoomSelect.querySelectorAll('option');
        options.forEach(opt => {
            if (!opt.value) {
                opt.style.display = '';
                return;
            }
            const houseId = opt.getAttribute('data-house-id');
            if (!selectedHouseId || houseId === String(selectedHouseId) || opt.value === String(currentRoomId)) {
                opt.style.display = '';
            } else {
                opt.style.display = 'none';
            }
        });
        updateRoomPreview();
    }

    if (editHouseSelect) {
        editHouseSelect.addEventListener('change', function() {
            filterEditRooms(this.value, editRoomSelect ? editRoomSelect.value : null);
        });
    }

    if (editRoomSelect) {
        editRoomSelect.addEventListener('change', function() {
            updateRoomPreview();
            const opt = this.options[this.selectedIndex];
            const rate = opt ? opt.getAttribute('data-rate') : null;
            if (rate && rentInput && (!rentInput.value || parseFloat(rentInput.value) === 0)) {
                rentInput.value = parseFloat(rate).toFixed(2);
            }
        });
    }

    if (btnApplySelectedRate) {
        btnApplySelectedRate.addEventListener('click', function() {
            if (!editRoomSelect || !rentInput) return;
            const opt = editRoomSelect.options[editRoomSelect.selectedIndex];
            if (opt && opt.getAttribute('data-rate')) {
                rentInput.value = parseFloat(opt.getAttribute('data-rate')).toFixed(2);
                rentInput.classList.add('border-success');
                setTimeout(() => rentInput.classList.remove('border-success'), 1200);
            }
        });
    }

    // 3. Status Change Interactivity & Notice
    const statusSelect = document.getElementById('edit_status');
    const moveOutInput = document.getElementById('edit_move_out_date');
    const statusNoticeBox = document.getElementById('statusChangeNotice');
    const statusNoticeText = document.getElementById('statusNoticeText');
    const statusNoticeIcon = document.getElementById('statusNoticeIcon');

    function handleStatusFeedback(status) {
        if (!statusNoticeBox || !statusNoticeText) return;
        if (status === 'Checked Out') {
            statusNoticeBox.className = 'alert alert-secondary border small text-dark py-2 px-3 mb-0 w-100 d-flex align-items-center';
            statusNoticeIcon.className = 'bi bi-box-arrow-right text-secondary me-2 fs-6';
            statusNoticeText.textContent = 'Resident marked as Checked Out. Room bed space will be released upon saving.';
            if (moveOutInput && !moveOutInput.value) {
                const today = new Date().toISOString().split('T')[0];
                moveOutInput.value = today;
            }
        } else if (status === 'Active') {
            statusNoticeBox.className = 'alert alert-success-subtle border border-success-subtle small text-success py-2 px-3 mb-0 w-100 d-flex align-items-center';
            statusNoticeIcon.className = 'bi bi-check-circle-fill text-success me-2 fs-6';
            statusNoticeText.textContent = 'Resident actively occupies this bed space.';
        } else if (status === 'Evicted') {
            statusNoticeBox.className = 'alert alert-danger-subtle border border-danger-subtle small text-danger py-2 px-3 mb-0 w-100 d-flex align-items-center';
            statusNoticeIcon.className = 'bi bi-exclamation-triangle-fill text-danger me-2 fs-6';
            statusNoticeText.textContent = 'Resident is marked as Evicted. Disciplinary logs apply.';
        } else {
            statusNoticeBox.className = 'alert alert-warning-subtle border border-warning-subtle small text-warning-emphasis py-2 px-3 mb-0 w-100 d-flex align-items-center';
            statusNoticeIcon.className = 'bi bi-clock-history text-warning me-2 fs-6';
            statusNoticeText.textContent = 'Status is pending review or assignment verification.';
        }
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            handleStatusFeedback(this.value);
        });
    }

    // 4. Copy Student ID to clipboard
    const btnCopyStudentNo = document.getElementById('btnCopyStudentNo');
    if (btnCopyStudentNo) {
        btnCopyStudentNo.addEventListener('click', function() {
            const studentNo = document.getElementById('view_student_no_badge').textContent.trim();
            if (studentNo && navigator.clipboard) {
                navigator.clipboard.writeText(studentNo).then(() => {
                    const feedback = document.getElementById('copyFeedback');
                    const icon = document.getElementById('copyIcon');
                    if (feedback && icon) {
                        feedback.style.display = 'inline';
                        icon.style.display = 'none';
                        setTimeout(() => {
                            feedback.style.display = 'none';
                            icon.style.display = 'inline';
                        }, 1800);
                    }
                }).catch(err => console.error('Copy failed:', err));
            }
        });
    }

    // 5. New Tenant modal room filter helper
    const newHouseSelect = document.querySelector('#newTenantModal select[name="boarding_house_id"]');
    const newRoomSelect = document.querySelector('#newTenantModal select[name="room_id"]');
    if (newHouseSelect && newRoomSelect) {
        newHouseSelect.addEventListener('change', function() {
            const hid = this.value;
            newRoomSelect.querySelectorAll('option').forEach(opt => {
                if (!opt.value) {
                    opt.style.display = '';
                    return;
                }
                const hId = opt.getAttribute('data-house-id');
                opt.style.display = (!hid || hId === hid) ? '' : 'none';
            });
        });
    }

    // 6. View & Edit Resident Modal Populator
    document.querySelectorAll('.btn-view-tenant').forEach(btn => {
        btn.addEventListener('click', function() {
            const rawData = this.getAttribute('data-tenant');
            if (!rawData) return;
            try {
                const t = JSON.parse(rawData);

                // Reset Tab to Tab 1 (Room Transfer)
                const transferTabBtn = document.getElementById('tab-transfer-btn');
                if (transferTabBtn && window.bootstrap && window.bootstrap.Tab) {
                    const tab = new window.bootstrap.Tab(transferTabBtn);
                    tab.show();
                }

                // Hidden Record ID
                document.getElementById('edit_tenant_id').value = t.id || '';

                // Summary Profile Card
                const fullName = (t.first_name ? (t.first_name + ' ' + t.last_name) : (t.name || 'Resident'));
                document.getElementById('view_resident_name').textContent = fullName;
                document.getElementById('view_student_no_badge').textContent = t.student_no || (t.student_id || 'N/A');

                // Avatar Icon based on gender
                const avatarIcon = document.getElementById('view_avatar_icon');
                if (avatarIcon) {
                    avatarIcon.className = (t.gender === 'Male') ? 'bi bi-person-fill' : 'bi bi-person-heart';
                }

                // Status Badge & Pulse
                const st = t.status || 'Active';
                const statusBadge = document.getElementById('view_status_badge');
                const statusDot = document.getElementById('view_status_dot');
                const statusText = document.getElementById('view_status_text');
                if (statusBadge && statusDot && statusText) {
                    statusText.textContent = st;
                    if (st === 'Active') {
                        statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-2 py-1';
                        statusDot.className = 'pulse-dot pulse-dot-active';
                    } else if (st === 'Checked Out') {
                        statusBadge.className = 'badge bg-secondary-subtle text-secondary border px-2 py-1';
                        statusDot.className = 'pulse-dot pulse-dot-checkedout';
                    } else {
                        statusBadge.className = 'badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1';
                        statusDot.className = 'pulse-dot pulse-dot-pending';
                    }
                }

                // Course & Year pill
                const courseText = document.getElementById('view_course_text');
                if (courseText) {
                    courseText.textContent = (t.program || 'BSIT') + ' • ' + (t.year_level || '1st Year');
                }

                // Current placement header
                const houseText = document.getElementById('view_house_text');
                const roomBedVal = document.getElementById('view_room_bed_val');
                const rentText = document.getElementById('view_rent_text');
                if (houseText) {
                    houseText.textContent = t.house_name || (t.house || 'Accredited Facility');
                }
                if (roomBedVal) {
                    const rNum = t.room_number ? (/^room/i.test(t.room_number) ? t.room_number : 'Room ' + t.room_number) : (t.room || 'Room');
                    const bNum = t.bed_number ? (' - ' + t.bed_number) : '';
                    roomBedVal.textContent = rNum + bNum;
                }
                if (rentText) {
                    const r = isFinite(t.monthly_rent) ? parseFloat(t.monthly_rent) : 1500;
                    rentText.textContent = '₱' + r.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '/mo';
                }

                // Accommodation & Room Transfer form fields
                const houseId = t.boarding_house_id || '';
                const roomId = t.room_id || '';
                if (editHouseSelect) {
                    editHouseSelect.value = houseId;
                }
                filterEditRooms(houseId, roomId);
                if (editRoomSelect) {
                    editRoomSelect.value = roomId;
                }
                updateRoomPreview();

                document.getElementById('edit_bed_number').value = t.bed_number || 'Bed A';
                document.getElementById('edit_monthly_rent').value = t.monthly_rent || '1500.00';
                document.getElementById('edit_move_in_date').value = t.move_in_date || '';
                document.getElementById('edit_move_out_date').value = t.move_out_date || '';
                document.getElementById('edit_status').value = st;
                handleStatusFeedback(st);

                // Personal / Academic fields
                document.getElementById('edit_student_no').value = t.student_no || (t.student_id || '');
                document.getElementById('edit_first_name').value = t.first_name || '';
                document.getElementById('edit_last_name').value = t.last_name || '';
                document.getElementById('edit_gender').value = t.gender || 'Female';
                document.getElementById('edit_college').value = t.college || 'CICS';
                document.getElementById('edit_program').value = t.program || 'BS Information Technology';
                document.getElementById('edit_year_level').value = t.year_level || '3rd Year';
                document.getElementById('edit_contact_number').value = t.contact_number || (t.contact || '');
                document.getElementById('edit_email').value = t.email || '';

                // Emergency Contacts
                document.getElementById('edit_emergency_contact_name').value = t.emergency_contact_name || '';
                document.getElementById('edit_emergency_contact_phone').value = t.emergency_contact_phone || '';

            } catch (err) {
                console.error('Failed to parse resident data:', err);
            }
        });
    });
});
</script>
