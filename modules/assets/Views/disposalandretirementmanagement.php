<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-hammer me-1"></i>Unserviceable Property Decommissioning &bull; COA Circular 2020-006
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Property Disposal &amp; Condemnation Pipeline') ?>
            </h1>
            <p class="text-muted small mb-0">
                From unserviceable tagging, inspection and appraisal, university authorization, to condemnation certificate and book adjustment.
            </p>
        </div>
        <div class="mt-3 mt-md-0">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#flagDisposalModal">
                <i class="bi bi-plus-circle me-1"></i>Flag Asset for Disposal
            </button>
        </div>
    </div>

    <!-- Pipeline Stages Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-top border-4 border-warning p-3 text-center h-100">
                <div class="small text-muted text-uppercase fw-bold mb-1">1. Appraisal &amp; Inspection</div>
                <div class="h4 fw-bold text-warning font-monospace mb-1"><?= e($stage1Count ?? '1 Item') ?></div>
                <div class="small text-muted">Technical evaluation</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-top border-4 border-burgundy p-3 text-center h-100">
                <div class="small text-muted text-uppercase fw-bold mb-1">2. Awaiting VP Authorization</div>
                <div class="h4 fw-bold text-marsu-burgundy font-monospace mb-1"><?= e($stage2Count ?? '1 Item') ?></div>
                <div class="small text-muted">Remote sign-off queue</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-top border-4 border-info p-3 text-center h-100">
                <div class="small text-muted text-uppercase fw-bold mb-1">3. Mode of Disposal</div>
                <div class="h4 fw-bold text-info font-monospace mb-1"><?= e($stage3Count ?? '1 Item') ?></div>
                <div class="small text-muted">Auction / Condemnation</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-top border-4 border-success p-3 text-center h-100">
                <div class="small text-muted text-uppercase fw-bold mb-1">4. Certified &amp; Books Adjusted</div>
                <div class="h4 fw-bold text-success font-monospace mb-1"><?= e($stage4Count ?? '0 Items') ?></div>
                <div class="small text-muted">COA Witnessed</div>
            </div>
        </div>
    </div>

    <!-- Disposal Registry Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h6 class="m-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-file-earmark-text text-warning me-2"></i>Inventory &amp; Inspection Reports (IIRUP)
            </h6>
            <span class="small text-muted">Sta. Cruz Campus Property Unit</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu bg-marsu-burgundy text-white">
                        <tr>
                            <th class="py-3">Disposal Ref</th>
                            <th class="py-3">Target Property No.</th>
                            <th class="py-3">Unserviceable Item Description</th>
                            <th class="py-3">Acquisition Cost</th>
                            <th class="py-3">Book Value</th>
                            <th class="py-3">Appraised Value</th>
                            <th class="py-3">Mode of Disposal</th>
                            <th class="py-3">Pipeline Stage</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="disposalTableBody">
                        <?php if (!empty($disposalRecords)): ?>
                            <?php foreach ($disposalRecords as$disp): ?>
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($disp['disposal_ref']) ?></td>
                                    <td class="font-monospace"><?= e($disp['property_no']) ?></td>
                                    <td class="fw-semibold text-dark"><?= e($disp['item_description']) ?></td>
                                    <td class="font-monospace">₱<?= number_format($disp['acquisition_cost'], 2) ?></td>
                                    <td class="font-monospace text-muted">₱<?= number_format($disp['book_value'], 2) ?></td>
                                    <td class="font-monospace text-success fw-bold">₱<?= number_format($disp['appraised_value'], 2) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= e($disp['mode_of_disposal']) ?></span></td>
                                    <td>
                                        <span class="badge bg-warning text-dark"><?= e($disp['pipeline_stage']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing disposal record #<?= e($disp['id']) ?>')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                    No unserviceable property disposal records found. Click "Flag Asset for Disposal" to initiate an IIRUP.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>