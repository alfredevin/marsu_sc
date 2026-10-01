<!-- ISHAMIS Executive Dashboard Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge badge-gold px-2.5 py-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.72rem;">Student Housing Sub-System</span>
            <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="bi bi-shield-check me-1"></i>University Accredited</span>
        </div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-house-check-fill me-2 text-gold"></i>Integrated Student Housing & Accommodation (ISHAMIS)
        </h1>
        <p class="text-muted small mb-0">Official MarSU Santa Cruz Campus Accredited Boarding House Directory, Bedspace Vacancy Tracker, Student Resident Registry, and Safety Audits.</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="<?= url('housing/boarding-houses') ?>" class="btn btn-outline-marsu btn-sm">
            <i class="bi bi-buildings me-1"></i>Browse Houses
        </a>
        <a href="<?= url('housing/rooms') ?>" class="btn btn-outline-marsu btn-sm">
            <i class="bi bi-door-open me-1"></i>Vacant Beds
        </a>
        <?php if (can('housing.book')): ?>
            <a href="<?= url('housing/accommodations') ?>" class="btn btn-marsu btn-sm">
                <i class="bi bi-person-plus-fill me-1"></i>Book Accommodation
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- ISHAMIS KPI Performance Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi border-burgundy p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Accredited Houses</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($accreditedHouses) ?> <span class="fs-6 text-muted font-normal">/ <?= $totalHouses ?></span></div>
                    <div class="text-success small mt-1"><i class="bi bi-check-circle-fill me-1"></i>Active Accreditation</div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-house-heart-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi border-gold p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Available Bedspaces</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($availableBeds) ?> <span class="fs-6 text-muted font-normal">/ <?= $totalCapacity ?></span></div>
                    <div class="text-primary small mt-1"><i class="bi bi-door-open-fill me-1"></i>Vacant & Ready</div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-person-workspace"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Student Residents</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($activeResidents) ?></div>
                    <div class="text-muted small mt-1"><i class="bi bi-people-fill me-1"></i>Enrolled Grantees</div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Safety Index</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($avgRating, 1) ?> <span class="fs-6 text-warning">★</span></div>
                    <div class="text-muted small mt-1"><i class="bi bi-fire me-1"></i>Fire & Health Audit</div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-shield-fill-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="row g-4 mb-4">
    <!-- Accredited Properties Showcase -->
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-buildings-fill me-2 text-gold"></i>Accredited Student Residences in Santa Cruz
                </h6>
                <a href="<?= url('housing/boarding-houses') ?>" class="small text-marsu-burgundy fw-semibold text-decoration-none">
                    View All Directory <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu">
                            <tr>
                                <th>Code & Property Name</th>
                                <th>Barangay & Proximity</th>
                                <th>Gender</th>
                                <th>Monthly Rate</th>
                                <th>Safety</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (empty($recentHouses)): ?>
                                <tr><td colspan="6" class="text-center py-4 text-muted">No accredited boarding houses registered yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($recentHouses as $h): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-marsu-burgundy"><?= e($h['name']) ?></div>
                                            <span class="badge badge-gold font-monospace"><?= e($h['code']) ?></span>
                                            <span class="text-muted ms-1" style="font-size: 0.73rem;">Landlord: <?= e($h['landlord_name']) ?></span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-body">Brgy. <?= e($h['barangay']) ?></div>
                                            <div class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-geo-alt me-1"></i><?= e($h['distance_campus'] ?: 'Near Campus') ?></div>
                                        </td>
                                        <td>
                                            <?php if ($h['gender_type'] === 'female_only'): ?>
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle"><i class="bi bi-gender-female me-1"></i>Female Only</span>
                                            <?php elseif ($h['gender_type'] === 'male_only'): ?>
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle"><i class="bi bi-gender-male me-1"></i>Male Only</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle">Co-ed</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong class="text-dark">₱<?= number_format($h['monthly_rate_min'], 0) ?> - ₱<?= number_format($h['monthly_rate_max'], 0) ?></strong>
                                            <div class="text-muted" style="font-size: 0.7rem;">/month per bed</div>
                                        </td>
                                        <td>
                                            <span class="text-warning fw-bold">★ <?= number_format($h['safety_rating'], 1) ?></span>
                                            <?php if ($h['accreditation_status'] === 'accredited'): ?>
                                                <div><span class="badge bg-success-subtle text-success" style="font-size: 0.68rem;">Accredited</span></div>
                                            <?php else: ?>
                                                <div><span class="badge bg-warning-subtle text-warning" style="font-size: 0.68rem;"><?= ucfirst($h['accreditation_status']) ?></span></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= url('housing/boarding-houses/view', ['id' => $h['id']]) ?>" class="btn btn-sm btn-outline-marsu py-1 px-2" title="View Property Profile">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Recent Safety Audits & Fast Actions -->
    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-clipboard2-check-fill me-2 text-gold"></i>Recent Safety Audits
                </h6>
                <a href="<?= url('housing/inspections') ?>" class="small text-marsu-burgundy fw-semibold text-decoration-none">All</a>
            </div>
            <div class="card-body p-3">
                <?php if (empty($recentInspections)): ?>
                    <p class="text-muted small text-center mb-0">No safety inspections logged.</p>
                <?php else: ?>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($recentInspections as $ins): ?>
                            <div class="p-2.5 rounded bg-light border">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div class="fw-semibold text-marsu-burgundy small"><?= e($ins['house_name']) ?></div>
                                    <span class="badge <?= ($ins['rating_grade'] === 'A') ? 'bg-success' : 'bg-warning text-dark' ?>">Grade <?= e($ins['rating_grade']) ?></span>
                                </div>
                                <div class="text-muted small d-flex justify-content-between align-items-center" style="font-size: 0.74rem;">
                                    <span><i class="bi bi-calendar3 me-1"></i><?= date('M d, Y', strtotime($ins['inspection_date'])) ?></span>
                                    <span>Score: <strong><?= e($ins['compliance_score']) ?>/100</strong></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card bg-burgundy-soft border-gold p-3">
            <h6 class="font-weight-bold text-marsu-burgundy mb-2">
                <i class="bi bi-info-circle-fill me-1"></i>About ISHAMIS
            </h6>
            <p class="text-muted small mb-3">The Integrated Student Housing and Accommodation Management Information System (ISHAMIS) provides centralized regulation, safety oversight, and verified off-campus dwelling reservations for Marinduque State University scholars.</p>
            <div class="d-grid gap-2">
                <a href="<?= url('housing/boarding-houses') ?>" class="btn btn-sm btn-marsu text-start d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-search me-2"></i>Find Housing Near Campus</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>