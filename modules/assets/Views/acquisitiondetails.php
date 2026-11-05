<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-boxes me-1"></i>PROPERTY & ASSET REGISTRATION &bull; SUB-MODULE 4
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Acquisition Records, Inspection &amp; Acceptance (IAR)') ?>
            </h1>
            <p class="text-muted small mb-0">
                Procurement audit trails, PO/IAR linking, delivery acceptance, warranty monitoring, and funding cluster attribution.
            </p>
        </div>
        <div class="mt-3 mt-md-0">
            <span class="badge bg-gold text-dark px-3 py-2 fw-bold shadow-sm">
                <i class="bi bi-university me-1"></i>Sta. Cruz Campus Certified
            </span>
        </div>
    </div>

    <!-- Asset module content -->
    <div id="assetModuleContent" data-asset-module="acquisition">
        
        <!-- Acquisition KPI Metrics -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Total Acquisition Outlay</div>
                    <div class="h3 font-weight-bold font-monospace my-1 text-marsu-burgundy" id="acqTotalOutlay">
                        <?= e($acqTotalOutlay ?? '₱10,740,170.00') ?>
                    </div>
                    <div class="small text-warning fw-semibold"><i class="bi bi-check-circle-fill me-1"></i><?= e($certifiedAssetsCount ?? '130') ?> Certified Assets</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-success p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Fund Cluster 01 (RAF)</div>
                    <div class="h3 font-weight-bold text-success font-monospace my-1" id="acqRafAmount">
                        <?= e($acqRafAmount ?? '₱8,450,000.00') ?>
                    </div>
                    <div class="small text-muted"><?= e($acqRafPercentage ?? '78.7%') ?> Regular Agency Allotment</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-info p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Fund Cluster 05 (IGF)</div>
                    <div class="h3 font-weight-bold text-info font-monospace my-1" id="acqIgfAmount">
                        <?= e($acqIgfAmount ?? '₱2,290,170.00') ?>
                    </div>
                    <div class="small text-muted"><?= e($acqIgfPercentage ?? '21.3%') ?> Internally Generated Funds</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Active Warranties</div>
                    <div class="h3 font-weight-bold text-warning font-monospace my-1">
                        <?= e($activeWarrantiesCount ?? '42 Units') ?>
                    </div>
                    <div class="small text-muted">Covered under Service Level SLA</div>
                </div>
            </div>
        </div>

        <!-- Fund Cluster Progress Visual Bar -->
        <div class="card shadow-sm p-3 mb-4 border-0 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small fw-bold text-uppercase text-dark">
                    <i class="bi bi-pie-chart-fill text-warning me-1"></i>Campus Capital Fund Cluster Allocation (RA 9184 Compliant)
                </span>
                <span class="badge bg-warning text-dark px-2 py-1 fw-bold">COA Audited</span>
            </div>
            <div class="progress mb-2" style="height: 10px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 78.7%;" aria-valuenow="78.7" aria-valuemin="0" aria-valuemax="100" title="Fund 01 (RAF): ₱8,450,000.00 (78.7%)"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 21.3%;" aria-valuenow="21.3" aria-valuemin="0" aria-valuemax="100" title="Fund 05 (IGF): ₱2,290,170.00 (21.3%)"></div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between small text-muted gap-1">
                <span><i class="bi bi-square-fill text-success me-1"></i>Fund 01 - Regular Agency Fund: <strong>78.7%</strong> (₱8.45M)</span>
                <span><i class="bi bi-square-fill text-info me-1"></i>Fund 05 - Internally Generated Fund: <strong>21.3%</strong> (₱2.29M)</span>
            </div>
        </div>

        <!-- Acquisition Search & Filter -->
        <div class="card shadow-sm p-3 mb-4 border-0">
            <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center justify-content-between gap-3">
                <div class="input-group flex-grow-1" style="min-width: 240px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" id="acqSearchInput" class="form-control border-start-0 ps-0" aria-label="Search acquisitions by purchase order number, supplier, or invoice reference" placeholder="Search by PO number, supplier, invoice, or IAR ref...">
                    <button type="button" id="acqSearchClear" class="btn btn-outline-secondary border-start-0 bg-white" aria-label="Clear acquisition search" title="Clear search" hidden>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="d-flex gap-2 flex-shrink-0 justify-content-start justify-content-lg-end">
                    <button class="btn btn-sm btn-outline-success fw-bold" onclick="window.exportAcquisitionCSV()" title="Export Acquisition CSV">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i>Export CSV
                    </button>
                    <button class="btn btn-sm btn-outline-warning text-dark fw-bold" onclick="window.printAcquisitionSummarySheet()" title="Print Acquisition Ledger">
                        <i class="bi bi-printer text-warning me-1"></i>Print GAM 58
                    </button>
                </div>
            </div>
        </div>

        <!-- Acquisition Data Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="acquisitionMasterTable">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Property Number</th>
                                <th class="py-3">Asset Description</th>
                                <th class="py-3">Purchase Order (PO)</th>
                                <th class="py-3">Supplier / Vendor</th>
                                <th class="py-3">Sales Invoice / DR</th>
                                <th class="py-3">Fund Cluster</th>
                                <th class="py-3">Acquisition Date</th>
                                <th class="py-3">Acquisition Cost</th>
                                <th class="py-3">Net Book Value</th>
                                <th class="py-3">Warranty Status</th>
                                <th class="py-3">IAR Ref</th>
                            </tr>
                        </thead>
                        <tbody id="acqTableBody">
                            <?php if (!empty($acquisitions)): ?>
                                <?php foreach ($acquisitions as $acq): ?>
                                    <tr>
                                        <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($acq['property_number']) ?></td>
                                        <td><?= e($acq['description']) ?></td>
                                        <td class="font-monospace"><?= e($acq['po_number']) ?></td>
                                        <td><?= e($acq['supplier']) ?></td>
                                        <td class="font-monospace"><?= e($acq['invoice_number']) ?></td>
                                        <td>
                                            <?php if (($acq['fund_cluster'] ?? '') === 'Fund 01'): ?>
                                                <span class="badge bg-success">Fund 01 (RAF)</span>
                                            <?php else: ?>
                                                <span class="badge bg-info text-dark">Fund 05 (IGF)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= e(date('M d, Y', strtotime($acq['acquisition_date']))) ?></td>
                                        <td class="font-monospace fw-bold text-dark">₱<?= number_format($acq['acquisition_cost'], 2) ?></td>
                                        <td class="font-monospace text-muted">₱<?= number_format($acq['net_book_value'], 2) ?></td>
                                        <td>
                                            <?php if (($acq['warranty_status'] ?? '') === 'Active'): ?>
                                                <span class="badge bg-warning text-dark">Active SLA</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Expired</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="font-monospace text-warning fw-bold"><?= e($acq['iar_ref']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No acquisition records loaded. Data populated dynamically via SPMU acquisition engine.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2 px-3 d-flex justify-content-between align-items-center bg-white border-top">
                <span class="small text-muted">All procurement records include Inspection and Acceptance Reports (IAR) on file at SPMU Boac / Sta. Cruz.</span>
                <span class="small font-monospace text-warning fw-bold" id="acqTableCount">Showing <?= count($acquisitions ?? []) ?> records</span>
            </div>
        </div>

    </div>
    <!-- /.asset-module-content -->
</div>