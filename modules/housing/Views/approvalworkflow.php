<!-- Approval Workflow View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-diagram-3-fill me-2 text-gold"></i>Housing Application Approval Workflow
        </h1>
        <p class="text-muted small mb-0">Multi-stage review and endorsements: Landlord intake approval, OSAS student affairs clearance, and parent consent verification.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/housingapplication') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-file-earmark-text me-1"></i>All Applications
        </a>
    </div>
</div>

<!-- Workflow Steps Visual Banner -->
<div class="card border-0 shadow-sm mb-4 bg-light">
    <div class="card-body p-3">
        <div class="row text-center g-2">
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm">
                    <span class="badge bg-secondary mb-1">Step 1</span>
                    <div class="fw-bold small text-dark">Intake Submission</div>
                    <div class="text-muted" style="font-size: 11px;">Parent consent & Form</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm border-warning">
                    <span class="badge bg-warning text-dark mb-1">Step 2</span>
                    <div class="fw-bold small text-dark">Landlord Acceptance</div>
                    <div class="text-muted" style="font-size: 11px;">Room & bed confirmation</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm">
                    <span class="badge bg-primary mb-1">Step 3</span>
                    <div class="fw-bold small text-dark">OSAS / Student Affairs</div>
                    <div class="text-muted" style="font-size: 11px;">University accreditation</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-2 border rounded bg-white shadow-sm border-success">
                    <span class="badge bg-success mb-1">Step 4</span>
                    <div class="fw-bold small text-dark">Official Move-in</div>
                    <div class="text-muted" style="font-size: 11px;">Contract finalized</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Approvals Queue Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-hourglass-split me-2 text-gold"></i>Applications Pending Review
        </h6>
        <span class="badge bg-warning-subtle text-dark border border-warning">3 Pending Endorsement</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">App Reference</th>
                        <th>Applicant Student</th>
                        <th>Applied Facility & Room</th>
                        <th>Parent Consent</th>
                        <th>Current Stage</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">APP-2026-089</td>
                        <td>
                            <div class="fw-bold">Renz Michael Morong</div>
                            <div class="small text-muted">ID: 24-0551 • 1st Year BSBA</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Villa Marinduque Dorm</div>
                            <div class="small text-muted">Room 103 (Bed A)</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Verified Form</span></td>
                        <td><span class="badge bg-warning text-dark">Awaiting Landlord Signature</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-success me-1" title="Approve"><i class="bi bi-check-lg"></i> Approve</button>
                            <button class="btn btn-sm btn-outline-danger" title="Reject"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">APP-2026-090</td>
                        <td>
                            <div class="fw-bold">Sarah Maye Hernandez</div>
                            <div class="small text-muted">ID: 23-1120 • 2nd Year BSED</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Sunrise Ladies Dormitory</div>
                            <div class="small text-muted">Room 105 (Bed B)</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Verified Form</span></td>
                        <td><span class="badge bg-primary text-white">OSAS Review Pending</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-success me-1" title="Approve"><i class="bi bi-check-lg"></i> Approve</button>
                            <button class="btn btn-sm btn-outline-danger" title="Reject"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">APP-2026-091</td>
                        <td>
                            <div class="fw-bold">Dave Justin Pastoral</div>
                            <div class="small text-muted">ID: 22-0334 • 3rd Year BSCE</div>
                        </td>
                        <td>
                            <div class="fw-semibold">Greenview Boarding House</div>
                            <div class="small text-muted">Room 201 (Bed C)</div>
                        </td>
                        <td><span class="badge bg-danger-subtle text-danger border border-danger"><i class="bi bi-exclamation-circle me-1"></i>Waiver Missing</span></td>
                        <td><span class="badge bg-secondary text-white">Incomplete Documents</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary me-1" title="Follow-up"><i class="bi bi-bell"></i> Remind</button>
                            <button class="btn btn-sm btn-outline-danger" title="Reject"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
