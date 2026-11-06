<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-pie-chart-fill text-warning me-1"></i>REPORTS &amp; ANALYTICS &bull; SUB-MODULE 3
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                Asset Utilization &amp; Depreciation Analysis
            </h1>
            <p class="text-muted small mb-0">Operational efficiency ratios, active asset deployment, straight-line depreciation schedule, and net carrying value metrics.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm px-3" onclick="window.print();" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028; border-radius: 6px;">
                <i class="bi bi-printer-fill me-1"></i>Print Report
            </button>
        </div>
    </div>

    <!-- Utilization Statistics KPI Cards -->
    <section class="row g-3 mb-4" aria-label="Utilization Statistics Indicators">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Operational Readiness</div>
                        <div class="h3 fw-bold text-success font-monospace my-1">96.9%</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">126 of 130 Serviceable</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Historical Cost Outlay</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1">&#8369;10.74M</div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Original Capitalized Basis</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-secondary p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Accumulated Depreciation</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1">&#8369;3.89M</div>
                    </div>
                    <div class="p-2 rounded bg-secondary bg-opacity-10 text-secondary">
                        <i class="bi bi-graph-down-arrow fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">36.2% Amortized to Date</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-danger p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold text-marsu-burgundy">Net Carrying Book Value</div>
                        <div class="h3 fw-bold text-marsu-burgundy font-monospace my-1">&#8369;6.85M</div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                </div>
                <div class="small text-info mt-2"><i class="bi bi-info-circle-fill me-1"></i>Current Balance Sheet Value</div>
            </div>
        </div>
    </section>

    <!-- Printable Sheet Card -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom gap-2" style="background-color: #7B1E2B;">
            <div class="d-flex align-items-center">
                <i class="bi bi-pie-chart-fill text-warning me-3 fs-4"></i>
                <div>
                    <h6 class="fw-bold mb-0 text-white">Asset Utilization &amp; Depreciation Schedule Preview</h6>
                    <small class="text-warning">Republic of the Philippines &bull; Commission on Audit (COA) Circular 2022-004</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-light fw-bold shadow-sm" onclick="window.togglePaperFit('utilizationPaperViewport')" title="Toggle between standard A4 scale and responsive fit">
                    <i class="bi bi-arrows-fullscreen me-1"></i>Fit / 100%
                </button>
                <button type="button" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" onclick="printUtilizationReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028;">
                    <i class="bi bi-printer-fill me-1"></i>Print Report / Save PDF
                </button>
            </div>
        </div>

        <!-- Report Preview Content Area (Static Paper Preview) -->
        <div class="card-body p-3 p-md-4 bg-light" id="utilizationReportArea" style="min-height: 500px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            
            <!-- A4 Simulated Paper Container -->
            <div class="bg-white p-4 p-md-5 shadow-sm mx-auto position-relative text-dark" id="utilizationPaperViewport" style="max-width: 1000px; border-radius: 4px; border: 1px solid #dee2e6;">
                
                <!-- Report Header Inside Paper -->
                <div class="text-end text-muted small fw-bold mb-2">Form Ref: MARSU-STC-DEP-2026</div>
                <div class="text-center mb-4">
                    <div class="small fw-bold text-uppercase text-secondary mb-1">Republic of the Philippines</div>
                    <h4 class="fw-bold mb-1" style="color: #7B1E2B; letter-spacing: 0.5px;">MARINDUQUE STATE UNIVERSITY</h4>
                    <div class="small fw-semibold text-dark mb-2">STA. CRUZ CAMPUS &bull; SUPPLY AND PROPERTY MANAGEMENT UNIT</div>
                    <h5 class="fw-bold text-dark text-uppercase mt-2" style="font-size: 1.05rem;">
                        ASSET UTILIZATION &amp; DEPRECIATION SCHEDULE ANALYSIS
                    </h5>
                    <div class="small text-muted font-monospace mt-1">As of October 25, 2026 &bull; Straight-Line Method (5% Salvage Value)</div>
                </div>

                <!-- Depreciation Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-sm align-middle mb-0 text-dark" style="font-size: 0.82rem; background-color: #ffffff;">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th style="width: 15%;">Asset Category / Item</th>
                                <th style="width: 12%;">Property No.</th>
                                <th style="width: 10%;">Acquisition Date</th>
                                <th style="width: 12%;">Acquisition Cost</th>
                                <th style="width: 10%;">Useful Life</th>
                                <th style="width: 13%;">Accumulated Depreciation</th>
                                <th style="width: 13%;">Net Carrying Value</th>
                                <th style="width: 15%;">Utilization Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Apple iMac 24-inch M3</strong><br><span class="text-muted" style="font-size: 0.73rem;">ICT Equipment</span></td>
                                <td class="font-monospace small">MarSU-STC-2024-PPE-0023</td>
                                <td class="text-center font-monospace">2024-03-15</td>
                                <td class="text-end font-monospace">&#8369;98,990.00</td>
                                <td class="text-center">5 Years</td>
                                <td class="text-end font-monospace text-danger">&#8369;37,616.20</td>
                                <td class="text-end font-monospace fw-bold">&#8369;61,373.80</td>
                                <td class="text-center"><span class="badge bg-success">Active &bull; Library</span></td>
                            </tr>
                            <tr>
                                <td><strong>Lenovo ThinkPad T14</strong><br><span class="text-muted" style="font-size: 0.73rem;">ICT Equipment</span></td>
                                <td class="font-monospace small">MarSU-STC-2025-PPE-0104</td>
                                <td class="text-center font-monospace">2025-01-20</td>
                                <td class="text-end font-monospace">&#8369;78,500.00</td>
                                <td class="text-center">5 Years</td>
                                <td class="text-end font-monospace text-danger">&#8369;15,700.00</td>
                                <td class="text-end font-monospace fw-bold">&#8369;62,800.00</td>
                                <td class="text-center"><span class="badge bg-success">Active &bull; Dean's Office</span></td>
                            </tr>
                            <tr>
                                <td><strong>Daikin 3.0HP Floor Aircon</strong><br><span class="text-muted" style="font-size: 0.73rem;">Machinery &amp; Equipment</span></td>
                                <td class="font-monospace small">MarSU-STC-2023-PPE-0089</td>
                                <td class="text-center font-monospace">2023-08-10</td>
                                <td class="text-end font-monospace">&#8369;85,000.00</td>
                                <td class="text-center">7 Years</td>
                                <td class="text-end font-monospace text-danger">&#8369;34,000.00</td>
                                <td class="text-end font-monospace fw-bold">&#8369;51,000.00</td>
                                <td class="text-center"><span class="badge bg-success">Active &bull; Gym Hall</span></td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light fw-bold text-dark">
                            <tr>
                                <td colspan="3" class="text-end text-uppercase">TOTAL ASSET DEPRECIATION:</td>
                                <td class="text-end font-monospace">&#8369;10,742,000.00</td>
                                <td></td>
                                <td class="text-end font-monospace text-danger">&#8369;3,892,000.00</td>
                                <td class="text-end font-monospace text-marsu-burgundy">&#8369;6,850,000.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Signatories Section -->
                <div class="row g-3 mt-4 pt-3 border-top">
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Prepared by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">Sanver Andrew H. Mapacpac</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Supply &amp; Property Officer &bull; Sta. Cruz Campus</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Approved by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">Randell R. Reginio, D.Tech</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Campus Director &bull; Sta. Cruz Campus</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>