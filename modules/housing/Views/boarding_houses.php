<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-buildings-fill me-2 text-gold"></i>Accredited Boarding Houses Directory
        </h1>
        <p class="text-muted small mb-0">Official registry of accredited student boarding houses and residences in Santa Cruz, Marinduque.</p>
    </div>
    <div>
        <?php if (can('housing.register')): ?>
            <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newHouseModal">
                <i class="bi bi-plus-lg me-1"></i>Register Boarding House
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Filters Bar -->
<div class="card shadow-sm border-0 mb-4 bg-light">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('housing/boarding-houses') ?>" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control border-start-0" placeholder="Search by house name, code, landlord..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="barangay" class="form-select form-select-sm">
                    <option value="">All Barangays (Santa Cruz)</option>
                    <?php foreach ($barangays as $bg): ?>
                        <option value="<?= e($bg) ?>" <?= ($barangay === $bg) ? 'selected' : '' ?>>Brgy. <?= e($bg) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="gender" class="form-select form-select-sm">
                    <option value="">All Gender Types</option>
                    <option value="coed" <?= ($gender === 'coed') ? 'selected' : '' ?>>Co-ed</option>
                    <option value="male_only" <?= ($gender === 'male_only') ? 'selected' : '' ?>>Male Only</option>
                    <option value="female_only" <?= ($gender === 'female_only') ? 'selected' : '' ?>>Female Only</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Accreditation</option>
                    <option value="accredited" <?= ($status === 'accredited') ? 'selected' : '' ?>>Accredited</option>
                    <option value="probationary" <?= ($status === 'probationary') ? 'selected' : '' ?>>Probationary</option>
                    <option value="pending" <?= ($status === 'pending') ? 'selected' : '' ?>>Pending</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter"></i></button>
                <a href="<?= url('housing/boarding-houses') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Boarding Houses Grid -->
<div class="row g-4 mb-4">
    <?php if (empty($houses)): ?>
        <div class="col-12">
            <div class="alert alert-light text-center py-5 border">
                <i class="bi bi-house-x fs-1 text-muted d-block mb-2"></i>
                <h5 class="text-muted">No boarding houses found</h5>
                <p class="small text-muted mb-0">Try adjusting your filters or search keywords.</p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($houses as $h): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-top border-4 border-burgundy">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-gold font-monospace"><?= e($h['code']) ?></span>
                            <?php if ($h['accreditation_status'] === 'accredited'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    <i class="bi bi-patch-check-fill me-1"></i>Accredited
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                    <?= ucfirst($h['accreditation_status']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h5 class="card-title font-weight-bold text-marsu-burgundy mb-1"><?= e($h['name']) ?></h5>
                        <p class="text-muted small mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i><?= e($h['address']) ?></p>

                        <div class="bg-light p-2.5 rounded small text-muted mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Landlord / Contact:</span>
                                <strong class="text-body"><?= e($h['landlord_name']) ?> (<?= e($h['landlord_contact']) ?>)</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Gender Category:</span>
                                <span class="badge bg-secondary-subtle text-body"><?= ucfirst(str_replace('_', ' ', $h['gender_type'])) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Distance to Campus:</span>
                                <span class="text-body fw-semibold"><?= e($h['distance_campus'] ?: 'Walking distance') ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Curfew:</span>
                                <span class="text-body fw-semibold"><i class="bi bi-clock me-1"></i><?= e($h['curfew_time'] ?: '10:00 PM') ?></span>
                            </div>
                        </div>

                        <?php if (!empty($h['amenities'])): ?>
                            <div class="mb-3">
                                <span class="small fw-semibold text-muted d-block mb-1">Amenities:</span>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php foreach (explode(',', $h['amenities']) as $am): ?>
                                        <span class="badge bg-light text-dark border" style="font-size: 0.68rem;"><?= trim(e($am)) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted" style="font-size: 0.72rem;">Monthly Rate</span>
                                <div class="fw-bold text-marsu-burgundy">₱<?= number_format($h['monthly_rate_min'], 0) ?> - ₱<?= number_format($h['monthly_rate_max'], 0) ?></div>
                            </div>
                            <a href="<?= url('housing/boarding-houses/view', ['id' => $h['id']]) ?>" class="btn btn-sm btn-outline-marsu">
                                View Profile <i class="bi bi-arrow-right small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal: Register New Boarding House -->
<?php if (can('housing.register')): ?>
<div class="modal fade" id="newHouseModal" tabindex="-1" aria-labelledby="newHouseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="<?= url('housing/boarding-houses/create') ?>" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header bg-marsu text-white py-2.5">
                <h6 class="modal-title font-weight-bold" id="newHouseModalLabel">
                    <i class="bi bi-building-add me-2"></i>Register New Student Boarding House (ISHAMIS)
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label small fw-bold">Boarding House / Residence Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Villa Marinduque Student Lodge" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Gender Category</label>
                        <select name="gender_type" class="form-select form-select-sm">
                            <option value="coed">Co-ed (Male & Female)</option>
                            <option value="female_only">Female Only</option>
                            <option value="male_only">Male Only</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Landlord / Caretaker Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="landlord_name" class="form-control form-control-sm" placeholder="e.g. Maria Santos" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Landlord Contact Number <span class="text-danger">*</span></label>
                        <input type="text" name="landlord_contact" class="form-control form-control-sm" placeholder="e.g. 0917-123-4567" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Street / Sitio Address <span class="text-danger">*</span></label>
                        <input type="text" name="address" class="form-control form-control-sm" placeholder="e.g. Panfilo Manguera Sr. Rd." required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Barangay (Santa Cruz) <span class="text-danger">*</span></label>
                        <input type="text" name="barangay" class="form-control form-control-sm" placeholder="e.g. Maharlika" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Distance to Campus</label>
                        <input type="text" name="distance_campus" class="form-control form-control-sm" placeholder="e.g. 200m from Gate 1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Monthly Rate Min (₱)</label>
                        <input type="number" name="monthly_rate_min" class="form-control form-control-sm" value="1500" step="50">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Monthly Rate Max (₱)</label>
                        <input type="number" name="monthly_rate_max" class="form-control form-control-sm" value="3000" step="50">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Total Rooms</label>
                        <input type="number" name="total_rooms" class="form-control form-control-sm" value="4" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Total Bed Capacity</label>
                        <input type="number" name="total_bed_capacity" class="form-control form-control-sm" value="12" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Curfew Time</label>
                        <input type="text" name="curfew_time" class="form-control form-control-sm" value="10:00 PM">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Amenities Included (comma separated)</label>
                        <input type="text" name="amenities" class="form-control form-control-sm" placeholder="e.g. High-Speed Wi-Fi, 24/7 CCTV, Filtered Water, Study Desks, Common Kitchen">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Initial Accreditation Status</label>
                        <select name="accreditation_status" class="form-select form-select-sm">
                            <option value="accredited">Accredited (Complete Permits)</option>
                            <option value="pending">Pending Safety Inspection</option>
                            <option value="probationary">Probationary</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Special Remarks / Inspector Notes</label>
                        <input type="text" name="remarks" class="form-control form-control-sm" placeholder="e.g. Undergoing semester renewal">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-save me-1"></i>Save Boarding House</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
