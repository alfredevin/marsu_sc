<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge badge-gold font-monospace"><?= e($house['code']) ?></span>
            <?php if ($house['accreditation_status'] === 'accredited'): ?>
                <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="bi bi-patch-check-fill me-1"></i>Accredited Residence</span>
            <?php else: ?>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle"><?= ucfirst($house['accreditation_status']) ?></span>
            <?php endif; ?>
        </div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1"><?= e($house['name']) ?></h1>
        <p class="text-muted small mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i><?= e($house['address']) ?> • Brgy. <?= e($house['barangay']) ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/boarding-houses') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Directory
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: House Overview & Quick Specs -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-marsu text-white py-2.5">
                <h6 class="m-0 font-weight-bold"><i class="bi bi-info-circle-fill me-2"></i>Property Accreditation Overview</h6>
            </div>
            <div class="card-body p-3">
                <div class="mb-3 text-center p-3 bg-light rounded border">
                    <div class="text-muted small text-uppercase">Safety Index Rating</div>
                    <div class="display-6 font-weight-bold text-marsu-burgundy">★ <?= number_format($house['safety_rating'], 1) ?></div>
                    <span class="badge bg-success-subtle text-success mt-1">Verified Safe & Compliant</span>
                </div>

                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Landlord / Caretaker:</span>
                        <strong class="text-body"><?= e($house['landlord_name']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Contact Phone:</span>
                        <strong class="text-body"><?= e($house['landlord_contact']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Email:</span>
                        <span class="text-body"><?= e($house['landlord_email'] ?: 'None provided') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Gender Policy:</span>
                        <span class="badge bg-secondary-subtle text-body"><?= ucfirst(str_replace('_', ' ', $house['gender_type'])) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Distance to MarSU:</span>
                        <span class="text-body fw-semibold"><?= e($house['distance_campus'] ?: 'Walking distance') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Curfew Hours:</span>
                        <strong class="text-body"><i class="bi bi-clock me-1"></i><?= e($house['curfew_time']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Total Rooms / Beds:</span>
                        <span class="text-body fw-bold"><?= $house['total_rooms'] ?> Rooms (<?= $house['total_bed_capacity'] ?> Beds)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Price Range:</span>
                        <strong class="text-marsu-burgundy">₱<?= number_format($house['monthly_rate_min'], 0) ?> - ₱<?= number_format($house['monthly_rate_max'], 0) ?>/mo</strong>
                    </li>
                </ul>

                <?php if (!empty($house['amenities'])): ?>
                    <div class="mt-3 pt-3 border-top">
                        <span class="small fw-bold text-muted d-block mb-2">Amenities Included:</span>
                        <div class="d-flex flex-wrap gap-1">
                            <?php foreach (explode(',', $house['amenities']) as $am): ?>
                                <span class="badge bg-light text-dark border p-1.5"><?= trim(e($am)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Right Column: Rooms & Occupancy List -->
    <div class="col-lg-8">
        <!-- Rooms Registry Table -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-door-open-fill me-2 text-gold"></i>Room Inventory & Bedspace Vacancies (<?= count($rooms) ?>)
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu">
                            <tr>
                                <th>Room #</th>
                                <th>Type</th>
                                <th>Total Beds</th>
                                <th>Occupied</th>
                                <th>Vacant Beds</th>
                                <th>Rate/Mo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (empty($rooms)): ?>
                                <tr><td colspan="7" class="text-center py-4 text-muted">No rooms mapped for this house yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($rooms as $r): ?>
                                    <tr>
                                        <td class="fw-bold text-marsu-burgundy"><?= e($r['room_number']) ?></td>
                                        <td><span class="badge bg-secondary-subtle text-body"><?= ucfirst(str_replace('_', ' ', $r['room_type'])) ?></span></td>
                                        <td><?= $r['capacity_beds'] ?> beds</td>
                                        <td><?= $r['occupied_beds'] ?> beds</td>
                                        <td>
                                            <?php if ($r['vacant_beds'] > 0): ?>
                                                <span class="badge bg-success-subtle text-success fw-bold"><?= $r['vacant_beds'] ?> vacant</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger">Full</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong>₱<?= number_format($r['rate_per_month'], 2) ?></strong></td>
                                        <td>
                                            <?php if ($r['status'] === 'available'): ?>
                                                <span class="badge bg-success">Available</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Full</span>
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

        <!-- Student Occupants Table -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-mortarboard-fill me-2 text-gold"></i>Currently Accommodated Student Residents (<?= count($occupants) ?>)
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student #</th>
                                <th>Full Name</th>
                                <th>Room Assigned</th>
                                <th>Move-in Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (empty($occupants)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">No student residents currently booked.</td></tr>
                            <?php else: ?>
                                <?php foreach ($occupants as $occ): ?>
                                    <tr>
                                        <td><code><?= e($occ['student_number']) ?></code></td>
                                        <td class="fw-semibold text-marsu-burgundy"><?= e($occ['last_name'] . ', ' . $occ['first_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($occ['room_number']) ?></span></td>
                                        <td><?= date('M d, Y', strtotime($occ['start_date'])) ?></td>
                                        <td><span class="badge bg-success-subtle text-success">Active Resident</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Inspection History -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-shield-check me-2 text-gold"></i>Official Safety & Sanitation Inspection Audits
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Auditor / Inspector</th>
                                <th>Compliance Score</th>
                                <th>Grade</th>
                                <th>Findings & Recommendations</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (empty($inspections)): ?>
                                <tr><td colspan="5" class="text-center py-3 text-muted">No inspections on file.</td></tr>
                            <?php else: ?>
                                <?php foreach ($inspections as $ins): ?>
                                    <tr>
                                        <td><?= date('M d, Y', strtotime($ins['inspection_date'])) ?></td>
                                        <td><?= e($ins['inspector_name']) ?></td>
                                        <td><strong><?= $ins['compliance_score'] ?>/100</strong></td>
                                        <td><span class="badge <?= ($ins['rating_grade'] === 'A') ? 'bg-success' : 'bg-warning text-dark' ?>">Grade <?= e($ins['rating_grade']) ?></span></td>
                                        <td class="text-muted"><?= e($ins['findings'] ?: 'Standard compliance passed.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
