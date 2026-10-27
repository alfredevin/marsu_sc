<!-- Project Procurement Management Plan — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-diagram-3 me-2 text-gold"></i>Project Procurement Management Plan (PPMP)
        </h1>
        <p class="text-muted small mb-0">Define and monitor procurement needs per project or department for the fiscal year.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewPPMP">
            <i class="bi bi-plus-circle me-1"></i>New PPMP Entry
        </button>
    </div>
</div>

<!-- Filter Bar -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm" placeholder="Search by project or department...">
            </div>
            <div class="col-md-3">
                <select class="form-select form-select-sm">
                    <option value="">Fiscal Year</option>
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select form-select-sm">
                    <option value="">All Quarters</option>
                    <option value="Q1">Q1 (Jan–Mar)</option>
                    <option value="Q2">Q2 (Apr–Jun)</option>
                    <option value="Q3">Q3 (Jul–Sep)</option>
                    <option value="Q4">Q4 (Oct–Dec)</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- PPMP Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>PPMP Entries
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Project / Activity</th>
                        <th>Department</th>
                        <th>Item Description</th>
                        <th>Est. Budget (&#8369;)</th>
                        <th>Quarter</th>
                        <th>Mode of Procurement</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-diagram-3 fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No PPMP entries found. Click <strong>New PPMP Entry</strong> to begin planning.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New PPMP -->
<div class="modal fade" id="modalNewPPMP" tabindex="-1" aria-labelledby="modalNewPPMPLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-marsu-burgundy" id="modalNewPPMPLabel">
                    <i class="bi bi-diagram-3 me-2 text-gold"></i>New PPMP Entry
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/project-procurement-management-plan/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ppmpProject" class="form-label fw-semibold">Project / Activity <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ppmpProject" name="project_activity" placeholder="e.g. CICS IT Infrastructure" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ppmpDept" class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ppmpDept" name="department" placeholder="e.g. CICS" required>
                        </div>
                        <div class="col-12">
                            <label for="ppmpItemDesc" class="form-label fw-semibold">Item Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="ppmpItemDesc" name="item_description" rows="2" placeholder="Describe the item or service to be procured..." required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="ppmpBudget" class="form-label fw-semibold">Estimated Budget (&#8369;) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control" id="ppmpBudget" name="estimated_budget" placeholder="0.00" required>
                        </div>
                        <div class="col-md-4">
                            <label for="ppmpQuarter" class="form-label fw-semibold">Quarter <span class="text-danger">*</span></label>
                            <select class="form-select" id="ppmpQuarter" name="quarter" required>
                                <option value="">— Select —</option>
                                <option value="Q1">Q1 (Jan–Mar)</option>
                                <option value="Q2">Q2 (Apr–Jun)</option>
                                <option value="Q3">Q3 (Jul–Sep)</option>
                                <option value="Q4">Q4 (Oct–Dec)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="ppmpMode" class="form-label fw-semibold">Mode of Procurement</label>
                            <select class="form-select" id="ppmpMode" name="mode_of_procurement">
                                <option value="Shopping">Shopping</option>
                                <option value="Public Bidding">Public Bidding</option>
                                <option value="Negotiated">Negotiated</option>
                                <option value="Direct Contracting">Direct Contracting</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>
