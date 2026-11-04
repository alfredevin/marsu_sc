<!-- COA Audit Trail — Procurement Management Information System (SPMS Equipment Incident & Condemnation Reports) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-shield-check me-2 text-gold"></i>COA Audit Trail &amp; Equipment Issue Reports
        </h1>
        <p class="text-muted small mb-0">Track reported missing, damaged, and condemned university equipment in compliance with Commission on Audit (COA) standards.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalReportIssue">
            <i class="bi bi-exclamation-triangle me-1"></i>Report Equipment Issue
        </button>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Issue Reports Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-text me-2 text-gold"></i>Equipment Incident & Condemnation Log
        </h5>
        <button class="btn btn-sm btn-outline-danger" onclick="window.print();">
            <i class="bi bi-printer me-1"></i>Print Audit Log
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Property Tag No.</th>
                        <th>Equipment Description</th>
                        <th>Reported By</th>
                        <th>Incident Type</th>
                        <th>Report Date</th>
                        <th>Investigation Notes / Reason</th>
                        <th class="text-center">Audit Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($issues)): ?>
                        <?php foreach ($issues as $iss): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-primary"><?= e($iss['property_number']) ?></td>
                                <td class="fw-semibold text-dark"><?= e($iss['item_name']) ?></td>
                                <td><?= e($iss['reported_by']) ?></td>
                                <td>
                                    <?php
                                    $t = $iss['issue_type'];
                                    $b = 'bg-warning text-dark';
                                    if ($t === 'Missing')      $b = 'bg-danger text-white';
                                    if ($t === 'For Condemn')  $b = 'bg-secondary text-white';
                                    ?>
                                    <span class="badge <?= $b ?>"><?= e($t) ?></span>
                                </td>
                                <td><?= date("M d, Y", strtotime($iss['report_date'])) ?></td>
                                <td><small class="text-muted"><?= e($iss['remarks'] ?? 'Reported for verification') ?></small></td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= e($iss['status']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">No incident reports recorded.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Report Equipment Issue -->
<div class="modal fade" id="modalReportIssue" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Report Equipment Incident / Loss / Damage
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/coaaudittrail/report-issue') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Issued Equipment <span class="text-danger">*</span></label>
                        <select class="form-select" name="issuance_item_id" required>
                            <option value="">— Select Issued Property Tag —</option>
                            <?php foreach ($issuedItems ?? [] as $it): ?>
                                <option value="<?= (int)$it['id'] ?>">Tag: <?= e($it['property_number']) ?> — <?= e($it['item_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reporter Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="reported_by" placeholder="e.g. Dean Alfred Flores / Custodian J. Ramos" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Incident / Issue Classification <span class="text-danger">*</span></label>
                        <select class="form-select" name="issue_type" required>
                            <option value="Missing">Missing / Unlocated Equipment</option>
                            <option value="Damaged">Damaged / Needs Repair</option>
                            <option value="For Condemn">Beyond Economic Repair (For Condemn)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Incident Details / Investigation Remarks <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="remarks" rows="3" placeholder="Provide circumstances, location, and condition notes..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-send me-1"></i>File Incident Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
