<!-- Housing Application View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-file-earmark-person me-2 text-gold"></i>Student Housing & Dormitory Application
        </h1>
        <p class="text-muted small mb-0">Official intake portal for incoming freshmen and continuing student housing reservations.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/approvalworkflow') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-check2-circle me-1"></i>Approval Workflow
        </a>
        <a href="<?= url('housing/waitinglist') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-hourglass-split me-1"></i>Waiting List
        </a>
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

<div class="row g-4 mb-4">
    <!-- Application Form Card -->
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-pencil-square me-2 text-gold"></i>Submit Housing Application Form
                </h5>
                <span class="badge bg-gold-subtle text-dark border">A.Y. 2026-2027</span>
            </div>
            <div class="card-body p-4">
                <form action="<?= url('housing/applications/create') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Student ID Number <span class="text-danger">*</span></label>
                            <input type="text" name="student_no" class="form-control form-control-sm" required placeholder="e.g. 24-0891">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control form-control-sm" required placeholder="e.g. Mary Grace Manalo">
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
                            <input type="text" name="college" value="CICS" class="form-control form-control-sm" placeholder="e.g. CICS">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Degree Program</label>
                            <input type="text" name="program" value="BS Information Technology" class="form-control form-control-sm" placeholder="e.g. BSIT">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Year Level</label>
                            <select name="year_level" class="form-select form-select-sm">
                                <option value="1st Year" selected>1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Preferred Accredited Facility <span class="text-danger">*</span></label>
                            <select name="preferred_house" class="form-select form-select-sm" required>
                                <option value="">-- Choose Boarding House --</option>
                                <?php foreach ($houses ?? [] as $h): ?>
                                    <option value="<?= e($h['name']) ?>"><?= e($h['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Preferred Room Type</label>
                            <select name="preferred_room_type" class="form-select form-select-sm">
                                <option value="Single">Single (Private)</option>
                                <option value="Double" selected>Double (2 Occupants)</option>
                                <option value="Triple">Triple (3 Occupants)</option>
                                <option value="Quad">Quad (4 Occupants)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Monthly Budget (₱)</label>
                            <input type="number" step="0.01" name="monthly_budget" value="1500.00" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Target Move-in Date</label>
                            <input type="date" name="target_move_in" class="form-control form-control-sm" value="<?= date('Y-m-d', strtotime('+7 days')) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Guardian / Parent Name</label>
                            <input type="text" name="guardian_name" class="form-control form-control-sm" placeholder="e.g. Evelyn Manalo">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Guardian Contact No.</label>
                            <input type="text" name="guardian_contact" class="form-control form-control-sm" placeholder="0918-xxx-xxxx">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Special Accommodations / Remarks</label>
                        <textarea name="remarks" class="form-control form-control-sm" rows="2" placeholder="Dietary, ground floor preference, study desk requirements..."></textarea>
                    </div>

                    <!-- Statutory Data Privacy Act Notice (Rule #6) -->
                    <div class="p-3 bg-light rounded border mb-3 small text-muted">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="privacyConsent" required checked>
                            <label class="form-check-label" for="privacyConsent">
                                <strong>Data Privacy Consent (RA 10173):</strong> I hereby authorize Marinduque State University (MarSU) ISHAMIS to collect and process my personal information solely for student accommodation verification and emergency contact protocols.
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-marsu btn-sm shadow-sm">
                        <i class="bi bi-send-fill me-1"></i>Submit Housing Application
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Application Checklist & Instructions -->
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-info-circle me-2 text-gold"></i>Application Guidelines
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 small text-muted">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Applications are evaluated on first-come, first-served slot availability.</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Priority allocation is given to non-resident students from outer municipalities (Torrijos, Buenavista, Gasan, Santa Cruz, Mogpog).</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Approved applicants will receive room assignment confirmation in the Approval Workflow.</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Security deposit and first month rental are settled upon check-in.</li>
                </ul>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-clock-history me-2 text-gold"></i>Pending Intake Pipeline
                </h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush small">
                    <?php if (empty($applications)): ?>
                        <li class="list-group-item text-muted text-center py-3">No active applications currently submitted.</li>
                    <?php else: ?>
                        <?php foreach (array_slice($applications, 0, 4) as $app): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold text-dark"><?= e($app['full_name']) ?></div>
                                    <div class="text-muted"><?= e($app['student_no']) ?> • <?= e($app['preferred_house'] ?? 'Dorm') ?></div>
                                </div>
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                    <?= e($app['status']) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Applications Registry Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-text me-2 text-gold"></i>Submitted Applications Registry
        </h5>
        <div class="d-flex gap-2">
            <input type="text" id="appSearchInput" class="form-control form-control-sm" style="width: 250px;" placeholder="Search applicant, ID, house...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="appTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Applicant Info</th>
                        <th>Program</th>
                        <th>Preferred Facility</th>
                        <th>Room Type</th>
                        <th>Move-in Date</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($applications)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No applications filed yet. Fill out the application form above!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($applications as $app): ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark"><?= e($app['full_name']) ?></div>
                                    <small class="text-muted"><?= e($app['student_no']) ?> • <?= e($app['gender']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= e($app['program']) ?></span>
                                    <small class="text-muted d-block"><?= e($app['year_level']) ?></small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e($app['preferred_house']) ?></div>
                                    <small class="text-muted">Budget: ₱<?= number_format((float)$app['monthly_budget'], 2) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis"><?= e($app['preferred_room_type']) ?></span>
                                </td>
                                <td>
                                    <?= date('M d, Y', strtotime($app['target_move_in'])) ?>
                                </td>
                                <td>
                                    <?php if ($app['status'] === 'Approved'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                    <?php elseif ($app['status'] === 'Waitlisted'): ?>
                                        <span class="badge bg-info-subtle text-info border border-info"><i class="bi bi-hourglass me-1"></i>Waitlisted</span>
                                    <?php elseif ($app['status'] === 'Rejected'): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger"><i class="bi bi-x-circle me-1"></i>Rejected</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"><i class="bi bi-clock me-1"></i>Pending Review</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('housing/approvalworkflow') ?>" class="btn btn-sm btn-outline-secondary py-0 px-2" title="Manage Status in Workflow">
                                        <i class="bi bi-arrow-right-circle"></i>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('appSearchInput');
    const table = document.getElementById('appTable');
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