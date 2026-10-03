<!-- Tenant Profiles & Directory View -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-person-lines-fill me-2 text-gold"></i>Tenant Profiles & Directory
        </h1>
        <p class="text-muted small mb-0">Directory of university students currently residing in accredited off-campus boarding houses and dormitories.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Overview
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newTenantModal">
            <i class="bi bi-person-plus-fill me-1"></i>Register Tenant
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing') ?>">
                <i class="bi bi-house-check me-1"></i>Overview & Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-people-fill me-1 text-gold"></i>Tenant Profiles
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing') ?>">
                <i class="bi bi-building me-1"></i>Boarding Houses
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing') ?>">
                <i class="bi bi-file-earmark-bar-graph me-1"></i>Reports
            </a>
        </li>
    </ul>
</div>

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Active Tenants</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                        <?= count(array_filter($tenants, fn($t) => $t['status'] === 'Active')) ?>
                    </div>
                    <div class="small text-muted mt-1">Verified university residents</div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Pending Review</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                        <?= count(array_filter($tenants, fn($t) => $t['status'] === 'Pending')) ?>
                    </div>
                    <div class="small text-muted mt-1">Awaiting boarding contract confirmation</div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Accredited Houses</div>
                    <div class="h3 font-weight-bold mb-0 text-secondary">3 Facilities</div>
                    <div class="small text-muted mt-1">Santa Cruz campus vicinity</div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tenants Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-marsu-burgundy font-weight-bold">
            <i class="bi bi-table me-2 text-gold"></i>Student Tenant Masterlist
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Search tenant, ID, or room..." style="width: 250px;">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
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
                <?php foreach ($tenants as $t): ?>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark"><?= e($t['name']) ?></div>
                            <small class="text-muted"><i class="bi bi-person-badge me-1"></i><?= e($t['student_id']) ?></small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border"><?= e($t['program']) ?></span>
                        </td>
                        <td>
                            <div class="fw-semibold text-secondary">
                                <i class="bi bi-building me-1 text-gold"></i><?= e($t['house']) ?>
                            </div>
                            <small class="text-muted"><?= e($t['contact']) ?></small>
                        </td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                <i class="bi bi-door-open me-1"></i><?= e($t['room']) ?>
                            </span>
                        </td>
                        <td class="fw-bold text-marsu-burgundy">
                            <?= e($t['monthly_rent']) ?>
                        </td>
                        <td class="small text-muted">
                            <?= e($t['move_in']) ?>
                        </td>
                        <td>
                            <?php if ($t['status'] === 'Active'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                    <i class="bi bi-check-circle me-1"></i>Active Tenant
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                                    <i class="bi bi-clock-history me-1"></i>Pending
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm py-0 px-2" title="View Tenant Details">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Register New Tenant -->
<div class="modal fade" id="newTenantModal" tabindex="-1" aria-labelledby="newTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newTenantModalLabel">
                    <i class="bi bi-person-plus-fill me-2 text-gold"></i>Register New Student Tenant
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Student Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Juan P. Dela Cruz">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Student ID No.</label>
                            <input type="text" class="form-control form-control-sm" placeholder="e.g. 23-0145">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" class="form-control form-control-sm" placeholder="0917-xxx-xxxx">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" required>
                            <option value="">-- Select Boarding House --</option>
                            <option value="Villa Marinduque">Villa Marinduque Student Dorm</option>
                            <option value="Greenview">Greenview Boarding House</option>
                            <option value="Sunrise">Sunrise Ladies Dormitory</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room & Bed No.</label>
                            <input type="text" class="form-control form-control-sm" placeholder="e.g. Room 102 - Bed A">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Monthly Rent (₱)</label>
                            <input type="text" class="form-control form-control-sm" placeholder="1,500.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notes / Guardian Contact</label>
                        <textarea name="description" class="form-control form-control-sm" rows="2" placeholder="Guardian name, emergency contact details..."></textarea>
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
