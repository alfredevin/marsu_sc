<!-- Approval Workflow View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-diagram-3-fill me-2 text-gold"></i>Housing Application Approval Workflow
        </h1>
        <p class="text-muted small mb-0">Multi-stage review and endorsements: Landlord intake approval, OSAS student affairs clearance, and room allocation.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/housingapplication') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-file-earmark-text me-1"></i>New Application
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

<!-- Workflow Steps Visual Banner -->
<div class="card border-0 shadow-sm mb-4 bg-light">
    <div class="card-body p-3">
        <div class="row text-center g-2">
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm">
                    <span class="badge bg-secondary mb-1">Stage 1</span>
                    <div class="fw-bold small text-dark">Intake Submission</div>
                    <div class="text-muted" style="font-size: 11px;">Parent consent & Form</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm border-warning">
                    <span class="badge bg-warning text-dark mb-1">Stage 2</span>
                    <div class="fw-bold small text-dark">Landlord Acceptance</div>
                    <div class="text-muted" style="font-size: 11px;">Room & bed confirmation</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm">
                    <span class="badge bg-primary mb-1">Stage 3</span>
                    <div class="fw-bold small text-dark">OSAS / Housing Unit</div>
                    <div class="text-muted" style="font-size: 11px;">University accreditation</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm border-success">
                    <span class="badge bg-success mb-1">Stage 4</span>
                    <div class="fw-bold small text-dark">Official Move-in</div>
                    <div class="text-muted" style="font-size: 11px;">Slot allocated</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Approvals Queue Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-hourglass-split me-2 text-gold"></i>Applications Pending Review & Endorsement
        </h6>
        <span class="badge bg-warning-subtle text-dark border border-warning">
            <?= count($pending ?? []) ?> Applications Pending Action
        </span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Applicant Student</th>
                        <th>Program & College</th>
                        <th>Requested Facility</th>
                        <th>Target Move-In</th>
                        <th>Guardian Details</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Decision Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pending)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-check-circle fs-2 text-success d-block mb-2"></i>
                                All clear! No pending applications requiring action at this moment.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pending as $app): ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark"><?= e($app['full_name']) ?></div>
                                    <div class="small text-muted"><i class="bi bi-person-badge me-1"></i><?= e($app['student_no']) ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= e($app['program']) ?></span>
                                    <div class="small text-muted"><?= e($app['year_level']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e($app['preferred_house']) ?></div>
                                    <small class="text-muted"><?= e($app['preferred_room_type']) ?> Room • Budget: ₱<?= number_format((float)$app['monthly_budget'], 2) ?></small>
                                </td>
                                <td>
                                    <?= date('M d, Y', strtotime($app['target_move_in'])) ?>
                                </td>
                                <td>
                                    <div class="small fw-semibold"><?= e($app['guardian_name'] ?? 'Not specified') ?></div>
                                    <div class="small text-muted"><?= e($app['guardian_contact'] ?? 'No contact') ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                        <i class="bi bi-clock me-1"></i><?= e($app['status']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <!-- Approve Button Form -->
                                        <form action="<?= url('housing/applications/status') ?>" method="POST" class="d-inline" onsubmit="return confirm('Approve this application and allocate dormitory slot?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= (int)$app['id'] ?>">
                                            <input type="hidden" name="status" value="Approved">
                                            <button type="submit" class="btn btn-success btn-sm" title="Approve Application">
                                                <i class="bi bi-check-lg me-1"></i>Approve
                                            </button>
                                        </form>

                                        <!-- Waitlist Button Form -->
                                        <form action="<?= url('housing/applications/status') ?>" method="POST" class="d-inline ms-1">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= (int)$app['id'] ?>">
                                            <input type="hidden" name="status" value="Waitlisted">
                                            <button type="submit" class="btn btn-outline-info btn-sm" title="Move to Priority Waitlist">
                                                <i class="bi bi-hourglass me-1"></i>Waitlist
                                            </button>
                                        </form>

                                        <!-- Reject Button Form -->
                                        <form action="<?= url('housing/applications/status') ?>" method="POST" class="d-inline ms-1" onsubmit="return confirm('Reject this application?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= (int)$app['id'] ?>">
                                            <input type="hidden" name="status" value="Rejected">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Reject Application">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Processed Applications History -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-check2-all me-2 text-gold"></i>Recently Endorsed & Decided Applications
        </h6>
        <span class="badge bg-secondary-subtle text-secondary"><?= count($processed ?? []) ?> Completed</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Applicant Name</th>
                        <th>Student ID</th>
                        <th>Facility</th>
                        <th>Decision Status</th>
                        <th>Date Processed</th>
                        <th class="text-end pe-3">Re-evaluate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($processed)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No recently processed applications yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($processed as $p): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark"><?= e($p['full_name']) ?></td>
                                <td><?= e($p['student_no']) ?></td>
                                <td><?= e($p['preferred_house']) ?></td>
                                <td>
                                    <?php if ($p['status'] === 'Approved'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                    <?php elseif ($p['status'] === 'Waitlisted'): ?>
                                        <span class="badge bg-info-subtle text-info border border-info"><i class="bi bi-hourglass me-1"></i>Waitlisted</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger"><i class="bi bi-x-circle me-1"></i><?= e($p['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted">
                                    <?= !empty($p['updated_at']) ? date('M d, Y h:i A', strtotime($p['updated_at'])) : date('M d, Y') ?>
                                </td>
                                <td class="text-end pe-3">
                                    <form action="<?= url('housing/applications/status') ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                                        <input type="hidden" name="status" value="Pending Review">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm py-0 px-2" title="Return to Pending Review">
                                            <i class="bi bi-arrow-counterclockwise"></i> Re-open
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
