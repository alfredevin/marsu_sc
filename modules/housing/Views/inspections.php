<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-shield-check me-2 text-gold"></i>Safety, Fire & Sanitation Inspections
        </h1>
        <p class="text-muted small mb-0">Official compliance audits and accreditation checks for student boarding houses in Santa Cruz.</p>
    </div>
    <div>
        <?php if (can('housing.inspect')): ?>
            <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newInspectionModal">
                <i class="bi bi-clipboard2-plus-fill me-1"></i>Conduct Inspection Audit
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Inspections Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-card-checklist me-2 text-gold"></i>Accreditation Audit Logs (<?= count($inspections) ?> Audits)
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th>Date</th>
                        <th>Boarding House Residence</th>
                        <th>Inspector / Audit Committee</th>
                        <th>Checklist Passed</th>
                        <th>Score & Grade</th>
                        <th>Findings & Recommendations</th>
                        <th>Next Due Date</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($inspections)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No safety inspection audits recorded yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($inspections as $ins): ?>
                            <tr>
                                <td>
                                    <strong><?= date('M d, Y', strtotime($ins['inspection_date'])) ?></strong>
                                </td>
                                <td>
                                    <div class="fw-semibold text-marsu-burgundy"><?= e($ins['house_name']) ?></div>
                                    <span class="badge badge-gold font-monospace"><?= e($ins['house_code']) ?></span>
                                    <span class="text-muted" style="font-size: 0.72rem;">Brgy. <?= e($ins['barangay']) ?></span>
                                </td>
                                <td>
                                    <div class="text-body"><?= e($ins['inspector_name']) ?></div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1" style="font-size: 0.73rem;">
                                        <span><i class="bi bi-check-circle-fill text-success me-1"></i>Fire Safety</span>
                                        <span><i class="bi bi-check-circle-fill text-success me-1"></i>Sanitary Permit</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= $ins['compliance_score'] ?> <span class="fs-7 text-muted">/100</span></div>
                                    <span class="badge <?= ($ins['rating_grade'] === 'A') ? 'bg-success' : 'bg-warning text-dark' ?>">
                                        Grade <?= e($ins['rating_grade']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="text-body fw-semibold"><?= e($ins['findings'] ?: 'Compliant with safety rules.') ?></div>
                                    <div class="text-muted" style="font-size: 0.72rem;"><?= e($ins['recommendations'] ?: 'None.') ?></div>
                                </td>
                                <td>
                                    <span class="text-muted"><i class="bi bi-calendar-event me-1"></i><?= date('M d, Y', strtotime($ins['next_inspection_date'])) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Inspection -->
<?php if (can('housing.inspect')): ?>
<div class="modal fade" id="newInspectionModal" tabindex="-1" aria-labelledby="newInspectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="<?= url('housing/inspections/create') ?>" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header bg-marsu text-white py-2.5">
                <h6 class="modal-title font-weight-bold" id="newInspectionModalLabel">
                    <i class="bi bi-clipboard2-check-fill me-2"></i>Log Housing Safety & Sanitation Inspection Audit
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label small fw-bold">Select Boarding House to Audit <span class="text-danger">*</span></label>
                        <select name="boarding_house_id" class="form-select form-select-sm" required>
                            <option value="">Select Property...</option>
                            <?php foreach ($houses as $h): ?>
                                <option value="<?= $h['id'] ?>"><?= e($h['name']) ?> (<?= e($h['code']) ?> - Landlord: <?= e($h['landlord_name']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Inspection Date <span class="text-danger">*</span></label>
                        <input type="date" name="inspection_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    
                    <div class="col-12">
                        <span class="small fw-bold text-muted d-block mb-2">Statutory Accreditation Checklist:</span>
                        <div class="row g-2 p-3 bg-light rounded border">
                            <div class="col-md-6">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" name="fire_safety_passed" value="1" id="chkFire" checked>
                                    <label class="form-check-label fw-semibold" for="chkFire">BFP Fire Safety Inspection Certificate</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" name="sanitary_permit_valid" value="1" id="chkSanitary" checked>
                                    <label class="form-check-label fw-semibold" for="chkSanitary">LGU Sanitary Permit & Drinking Water Test</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" name="building_permit_valid" value="1" id="chkBuilding" checked>
                                    <label class="form-check-label fw-semibold" for="chkBuilding">Building Occupancy Permit & Structural Integrity</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" name="cctv_functioning" value="1" id="chkCCTV" checked>
                                    <label class="form-check-label fw-semibold" for="chkCCTV">Perimeter Lighting & CCTV Surveillance</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Audit Compliance Score (0 - 100) <span class="text-danger">*</span></label>
                        <input type="number" name="compliance_score" class="form-control form-control-sm" value="95" min="0" max="100" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Inspector Notes / Findings</label>
                        <input type="text" name="findings" class="form-control form-control-sm" placeholder="e.g. Clean hallways, functional smoke detectors">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Accreditation Recommendations</label>
                        <textarea name="recommendations" class="form-control form-control-sm" rows="2" placeholder="e.g. Maintain weekly testing of emergency lighting in exit corridors."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-save me-1"></i>Save Inspection Audit</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
