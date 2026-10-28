<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                Property Identification Number (PIN) Registry &amp; QR Tagging
            </h1>
            <p class="text-muted small mb-0">
                Every PIN is assigned automatically when an asset is registered. Find assets, copy their PINs, and print property tags here.
            </p>
        </div>
        <div class="mt-3 mt-md-0">
            <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm">
                <i class="bi bi-university me-1"></i>Sta. Cruz Campus Certified
            </span>
        </div>
    </div>

    <!-- Asset module content -->
    <div id="assetModuleContent" data-asset-module="property-id">

        <!-- PIN Standard Architecture & Overview Card -->
        <div class="card shadow-sm p-4 mb-4 border-0">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-3">
                <div>
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                        <span class="badge bg-warning text-dark px-2.5 py-1 fw-bold">COA Standard: GAM Appendix 71</span>
                        <span class="badge bg-warning bg-opacity-10 text-warning px-2.5 py-1 font-monospace fw-bold border border-warning border-opacity-25">Code 128 + 2D QR</span>
                        <span class="badge bg-success px-2.5 py-1"><i class="bi bi-check-circle-fill me-1"></i>Live Asset Registry</span>
                    </div>
                    <h4 class="fw-bold mb-1 text-dark">
                        Property Identification Number (PIN) Registry &amp; Tagging
                    </h4>
                    <p class="small text-muted mb-0">
                        Register an asset once; its permanent PIN is assigned automatically and managed from this registry.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3 mt-lg-0">
                    <a class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" href="assets-profile.php?action=new" title="Register an asset and automatically assign its PIN">
                        <i class="bi bi-plus-circle me-1"></i>Register Asset
                    </a>
                    <button class="btn btn-outline-warning text-dark btn-sm fw-bold" onclick="window.printAveryStickerSheet()" title="Print QR stickers for the current search results">
                        <i class="bi bi-printer text-warning me-1"></i>Print Filtered Stickers
                    </button>
                    <button class="btn btn-outline-success btn-sm fw-bold" onclick="window.exportPinCSV()" title="Export PIN CSV">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i>Export PIN CSV
                    </button>
                </div>
            </div>

            <!-- Visual PIN Schema Architecture Diagram -->
            <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 p-3 bg-light rounded mb-3 border text-center">
                <div class="p-2 bg-white rounded shadow-sm border min-w-100">
                    <span class="d-block small text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">SUC Code</span>
                    <span class="fs-5 fw-bold text-dark font-monospace">MarSU</span>
                    <span class="d-block small text-muted" style="font-size: 0.7rem;">Institution</span>
                </div>
                <span class="fs-4 fw-bold text-muted">-</span>
                <div class="p-2 bg-white rounded shadow-sm border min-w-100">
                    <span class="d-block small text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">Station</span>
                    <span class="fs-5 fw-bold text-dark font-monospace">STC</span>
                    <span class="d-block small text-muted" style="font-size: 0.7rem;">Sta. Cruz</span>
                </div>
                <span class="fs-4 fw-bold text-muted">-</span>
                <div class="p-2 bg-white rounded shadow-sm border min-w-100">
                    <span class="d-block small text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">Fiscal Year</span>
                    <span class="fs-5 fw-bold text-dark font-monospace" id="pinSchemaYear"><?= e($currentYear ?? '2026') ?></span>
                    <span class="d-block small text-muted" style="font-size: 0.7rem;">Intake Year</span>
                </div>
                <span class="fs-4 fw-bold text-muted">-</span>
                <div class="p-2 bg-white rounded shadow-sm border min-w-100">
                    <span class="d-block small text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">Asset Class</span>
                    <span class="fs-5 fw-bold text-dark font-monospace" id="schemaPreviewClass">PPE</span>
                    <span class="d-block small text-muted" style="font-size: 0.7rem;">Threshold</span>
                </div>
                <span class="fs-4 fw-bold text-muted">-</span>
                <div class="p-2 bg-warning bg-opacity-10 rounded shadow-sm border border-warning border-opacity-50 min-w-100">
                    <span class="d-block small text-warning text-uppercase fw-bold" style="font-size: 0.65rem;">Sequence</span>
                    <span class="fs-5 fw-bold text-warning font-monospace" id="schemaPreviewSeq"><?= e($nextSequence ?? '00131') ?></span>
                    <span class="d-block small text-muted" style="font-size: 0.7rem;">Sequential</span>
                </div>
            </div>

            <!-- Quick Metrics Row -->
            <div class="row pt-3 border-top g-2">
                <div class="col-6 col-md-3">
                    <div class="small text-muted text-uppercase fw-bold">Total Registered PINs</div>
                    <div class="h5 fw-bold text-warning font-monospace mb-0" id="pinCountSummary"><?= e($totalPinsCount ?? '130') ?></div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="small text-muted text-uppercase fw-bold">Next PIN (<span id="pinNextYear"><?= e($currentYear ?? '2026') ?></span>)</div>
                    <div class="h6 fw-bold font-monospace text-dark mb-0 text-truncate" id="pinNextSummary">
                        <?= e($nextPinSample ?? 'MarSU-STC-2026-PPE-0131') ?>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="small text-muted text-uppercase fw-bold">PIN Assignment</div>
                    <div class="h5 fw-bold text-success font-monospace mb-0">Automatic on save</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="small text-muted text-uppercase fw-bold">Available Tag Actions</div>
                    <div class="h6 fw-bold text-primary font-monospace mb-0"><i class="bi bi-copy me-1"></i>Copy PIN &bull; Print QR</div>
                </div>
            </div>
        </div>

        <!-- Live PIN Sequence Sandbox & Sticker Preview Card -->
        <div class="card shadow-sm p-3 mb-4 border-0">
            <div class="row align-items-center g-3">
                <div class="col-lg-7">
                    <div class="fw-bold mb-1 text-dark fs-6">
                        <i class="bi bi-magic text-warning me-2"></i>PIN Preview &amp; Sticker Test
                    </div>
                    <div class="small text-muted mb-3">
                        Preview a sample PIN and label layout. This preview is not reserved; the final unique PIN is assigned only when you save the asset registration.
                    </div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <label class="small text-muted fw-bold text-uppercase mb-1">Target Classification</label>
                            <select id="sandboxClassSelect" class="form-select form-select-sm fw-semibold" onchange="window.updateSandboxPreview()">
                                <option value="PPE">PPE (Capitalized &ge; ₱50,000.00)</option>
                                <option value="SEMI">Semi-Expendable (&lt; ₱50,000.00)</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted fw-bold text-uppercase mb-1">Sample Description</label>
                            <input type="text" id="sandboxDescInput" class="form-control form-control-sm" value="Apple iMac 24-inch M3 Retina 4.5K" oninput="window.updateSandboxPreview()" placeholder="Enter description...">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <button class="btn btn-sm btn-warning text-dark fw-bold" onclick="window.copySandboxPin()">
                            <i class="bi bi-copy me-1"></i>Copy Preview PIN: <span id="sandboxPinDisplay" class="font-monospace">MarSU-STC-2026-PPE-0131</span>
                        </button>
                        <button class="btn btn-sm btn-outline-warning text-dark fw-bold" onclick="window.useSandboxPinForIntake()">
                            <i class="bi bi-plus-circle text-warning me-1"></i>Register This Asset
                        </button>
                        <button class="btn btn-sm btn-outline-secondary fw-bold" onclick="window.printSandboxSticker()">
                            <i class="bi bi-printer me-1 text-warning"></i>Print Sample Sticker
                        </button>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Live Interactive Sticker Preview Card -->
                    <div class="p-3 bg-white rounded shadow-sm border border-2 border-warning" id="sandboxStickerCard">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-marsu-burgundy small">MarSU Sta. Cruz Campus</span>
                            <span class="badge bg-warning text-dark font-monospace" style="font-size: 0.65rem;">PREVIEW ONLY</span>
                        </div>
                        <div class="text-muted small border-bottom pb-1 mb-2" style="font-size: 0.72rem;">Supply &amp; Property Management Unit</div>
                        <div class="d-flex align-items-center justify-content-between my-2 gap-2">
                            <img id="sandboxQrImg" src="https://api.qrserver.com/v1/create-qr-code/?size=64x64&data=MarSU-STC-2026-PPE-0131" width="60" height="60" class="rounded border p-1 bg-white" alt="QR Tag" />
                            <div class="text-end flex-grow-1">
                                <div class="font-monospace fw-bold text-dark small" id="sandboxStickerPin">
                                    MarSU-STC-2026-PPE-0131
                                </div>
                                <div class="small text-muted text-truncate" style="max-width: 200px;" id="sandboxStickerDesc">Apple iMac 24-inch M3 Retina 4.5K</div>
                                <div class="small text-muted font-monospace" style="font-size: 0.65rem;">Code 128 &bull; Verified <?= e($currentYear ?? '2026') ?></div>
                            </div>
                        </div>
                        <div class="text-center text-uppercase fw-bold text-muted border-top pt-1 mt-1" style="font-size: 0.6rem; letter-spacing: 0.05em;">
                            PROPERTY OF MARINDUQUE STATE UNIVERSITY &bull; UNLAWFUL TO REMOVE
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PIN Search & Actions Toolbar -->
        <div class="card shadow-sm p-3 mb-4 border-0">
            <div class="row align-items-center g-2">
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-upc-scan text-muted"></i></span>
                        <input type="search" id="pinSearchInput" class="form-control border-start-0 ps-0" aria-label="Search PINs by property identification number, serial, brand, or model" placeholder="Search property number, manufacturer serial, or equipment description...">
                        <button type="button" id="pinSearchClear" class="btn btn-outline-secondary border-start-0 bg-white" aria-label="Clear PIN search" title="Clear search" hidden>
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-5 text-md-end">
                    <span class="small text-muted me-2">Audit Format:</span>
                    <span class="badge bg-warning text-dark px-2.5 py-1 fw-bold">GAM App 71 / RPCPPE</span>
                </div>
            </div>
        </div>

        <!-- PIN Master Data Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="pinMasterTable">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Property Number (PIN)</th>
                                <th class="py-3">Inventory Item No</th>
                                <th class="py-3">Asset Description</th>
                                <th class="py-3">Serial No (MFG)</th>
                                <th class="py-3">Barcode Preview</th>
                                <th class="py-3">QR Tag</th>
                                <th class="py-3">Tag Status</th>
                                <th class="py-3">Verified By</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="pinTableBody">
                            <?php if (!empty($pinRecords)): ?>
                                <?php foreach ($pinRecords as $pin): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($pin['pin_code']) ?></td>
                                        <td class="font-monospace"><?= e($pin['inventory_item_no']) ?></td>
                                        <td class="fw-semibold text-dark"><?= e($pin['asset_description']) ?></td>
                                        <td class="font-monospace text-muted"><?= e($pin['serial_number'] ?? 'N/A') ?></td>
                                        <td>
                                            <div class="font-monospace bg-light p-1 rounded border text-center small">|||| | ||||| ||</div>
                                        </td>
                                        <td>
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=32x32&data=<?= urlencode($pin['pin_code']) ?>" width="32" height="32" alt="QR Tag" class="border rounded p-0.5 bg-white" />
                                        </td>
                                        <td>
                                            <?php if (($pin['tag_status'] ?? '') === 'Tagged'): ?>
                                                <span class="badge bg-success">Tagged</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Pending Tag</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="small text-muted"><?= e($pin['verified_by'] ?? 'SPMU Officer') ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" title="Copy PIN" onclick="navigator.clipboard.writeText('<?= e($pin['pin_code']) ?>')">
                                                <i class="bi bi-copy"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No PIN records generated yet. Register an asset to automatically populate this PIN registry.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2 px-3 d-flex justify-content-between align-items-center bg-white border-top">
                <span class="small text-muted">All PINs are generated in sequential order with institutional cryptographic validation.</span>
                <span class="small font-monospace text-warning fw-bold" id="pinTableCount">Showing <?= count($pinRecords ?? []) ?> records</span>
            </div>
        </div>

    </div>
    <!-- /.asset-module-content -->
</div>