<!-- Condition Reports View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clipboard2-check-fill me-2 text-gold"></i>Facility & Room Condition Reports
        </h1>
        <p class="text-muted small mb-0">Pre-occupancy and post-checkout room condition checklists, inventory handover inspections, and safety audits.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/servicehistory') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-clock-history me-1"></i>Service History
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newConditionModal">
            <i class="bi bi-plus-lg me-1"></i>New Inspection Checklist
        </button>
    </div>
</div>

<!-- Inspections Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-card-checklist me-2 text-gold"></i>Recorded Room Condition Audits
        </h6>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Search audits..." style="width: 200px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Audit Reference</th>
                        <th>Facility & Room</th>
                        <th>Inspection Stage</th>
                        <th>Inspector</th>
                        <th>Score / Rating</th>
                        <th>Date Conducted</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">AUD-2026-081</td>
                        <td>Villa Marinduque Dorm (Rm 102)</td>
                        <td><span class="badge bg-primary">Pre-Move-in Intake</span></td>
                        <td>Engr. R. Santos (Landlord)</td>
                        <td><span class="badge bg-success-subtle text-success border border-success">98% Pristine</span></td>
                        <td>Aug 15, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-earmark-pdf"></i> View Checklist</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">AUD-2026-082</td>
                        <td>Greenview Boarding House (Rm 204)</td>
                        <td><span class="badge bg-info text-dark">Midterm Safety Audit</span></td>
                        <td>MarSU OSAS Safety Inspector</td>
                        <td><span class="badge bg-success-subtle text-success border border-success">92% Satisfactory</span></td>
                        <td>Sep 20, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-earmark-pdf"></i> View Checklist</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">AUD-2026-083</td>
                        <td>Sunrise Ladies Dorm (Rm 104)</td>
                        <td><span class="badge bg-secondary">Checkout Clearance</span></td>
                        <td>Mrs. A. Ramos</td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning">Minor Window Screen Tear</span></td>
                        <td>Sep 30, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-earmark-pdf"></i> View Checklist</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Condition Report -->
<div class="modal fade" id="newConditionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Log Room Condition Checklist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility & Room Unit</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque - Room 102</option>
                            <option>Greenview - Room 204</option>
                            <option>Sunrise Dorm - Room 105</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Inspection Type</label>
                        <select class="form-select">
                            <option value="pre_intake">Pre-Move-In Initial Handover</option>
                            <option value="midterm">Periodic Semestral Sanitation & Safety</option>
                            <option value="checkout">Checkout / Post-Tenancy Clearance</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Electrical, Walls & Fixtures Rating</label>
                        <select class="form-select">
                            <option value="passed">Passed (No damage, clean)</option>
                            <option value="minor">Minor Wear (Wear and tear acceptable)</option>
                            <option value="failed">Failed / Liability for Repair</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Inspector Notes</label>
                        <textarea class="form-control" rows="2" placeholder="Keys issued, meter initial reading, furniture status..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Save Checklist</button>
                </div>
            </form>
        </div>
    </div>
</div>
