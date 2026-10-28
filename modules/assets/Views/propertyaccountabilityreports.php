<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-file-earmark-contract-fill text-warning me-1"></i>REPORTS &amp; ANALYTICS &bull; SUB-MODULE 2
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                Property Accountability &amp; Custodianship Reports
            </h1>
            <p class="text-muted small mb-0">Official summary of Property Acknowledgement Receipts (PAR) and Inventory Custodian Slips (ICS) per faculty, staff, and office unit.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-success btn-sm fw-bold shadow-sm px-3" onclick="window.exportAccountabilityCSV()">
                <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i>Export to CSV
            </button>
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm px-3" onclick="window.printAccountabilityReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028; border-radius: 6px;">
                <i class="bi bi-printer-fill me-1"></i>Print Official Report
            </button>
        </div>
    </div>

    <!-- Accountability Summary KPI Cards -->
    <section class="row g-3 mb-4" aria-label="Accountability Summary Indicators">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Accountable Officers</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1" id="totalCustodians">9</div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2"><span id="custodianMeta">100% Sta. Cruz Campus Active</span></div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-secondary p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Active PAR Items (&ge; &#8369;50k)</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1" id="totalParItems">84</div>
                    </div>
                    <div class="p-2 rounded bg-secondary bg-opacity-10 text-secondary">
                        <i class="bi bi-building-check fs-4"></i>
                    </div>
                </div>
                <div class="small text-warning mt-2"><span id="parValueMeta">Valued at &#8369;9.82M</span></div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Active ICS Items (&lt; &#8369;50k)</div>
                        <div class="h3 fw-bold text-info font-monospace my-1" id="totalIcsItems">46</div>
                    </div>
                    <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                        <i class="bi bi-boxes fs-4"></i>
                    </div>
                </div>
                <div class="small text-info mt-2"><span id="icsValueMeta">Valued at &#8369;917.4K</span></div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold text-marsu-burgundy">Overall Accountable Value</div>
                        <div class="h3 fw-bold text-marsu-burgundy font-monospace my-1" id="totalAccountableValue">&#8369;10,742,000.00</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                </div>
                <div class="small text-success mt-2"><i class="bi bi-check-circle-fill me-1"></i>All Clearances Current</div>
            </div>
        </div>
    </section>

    <!-- Printable Sheet Card -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom gap-2" style="background-color: #7B1E2B;">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-workspace text-warning me-3 fs-4"></i>
                <div>
                    <h6 class="fw-bold mb-0 text-white">Summary of Property Accountability by Custodian</h6>
                    <small class="text-warning">Sta. Cruz Campus Property &amp; Supply Management Unit &bull; Official Register</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-light fw-bold shadow-sm" onclick="window.exportAccountabilityCSV()">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i>Export CSV
                </button>
                <button type="button" class="btn btn-sm btn-outline-light fw-bold shadow-sm" onclick="window.togglePaperFit('accountabilityPaperViewport')" title="Toggle between standard A4 scale and responsive fit">
                    <i class="bi bi-arrows-fullscreen me-1"></i>Fit / 100%
                </button>
                <button type="button" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" onclick="window.printAccountabilityReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028;">
                    <i class="bi bi-printer-fill me-1"></i>Print Report / Save PDF
                </button>
            </div>
        </div>

        <!-- Report Preview Content Area (Static Paper Preview) -->
        <div class="card-body p-3 p-md-4 bg-light" id="accountabilityReportArea" style="min-height: 500px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            
            <!-- A4 Simulated Paper Container -->
            <div class="bg-white p-4 p-md-5 shadow-sm mx-auto position-relative text-dark" id="accountabilityPaperViewport" style="max-width: 1000px; border-radius: 4px; border: 1px solid #dee2e6;">
                
                <!-- Report Header Inside Paper -->
                <div class="text-end text-muted small fw-bold mb-2">Form Ref: MARSU-STC-PA-2026</div>
                <div class="text-center mb-4">
                    <div class="small fw-bold text-uppercase text-secondary mb-1">Republic of the Philippines</div>
                    <h4 class="fw-bold mb-1" style="color: #7B1E2B; letter-spacing: 0.5px;">MARINDUQUE STATE UNIVERSITY</h4>
                    <div class="small fw-semibold text-dark mb-2">STA. CRUZ CAMPUS &bull; SUPPLY AND PROPERTY MANAGEMENT UNIT</div>
                    <h5 class="fw-bold text-dark text-uppercase mt-2" style="font-size: 1.05rem;">
                        SUMMARY OF PROPERTY ACCOUNTABILITY BY CUSTODIAN
                    </h5>
                    <div class="small text-muted font-monospace mt-1">As of October 25, 2026 &bull; Official Campus Roster</div>
                </div>

                <!-- Accountability Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-sm align-middle mb-0 text-dark" style="font-size: 0.82rem; background-color: #ffffff;">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th style="width: 22%;">Accountable Officer / Custodian</th>
                                <th style="width: 18%;">Designation / Office</th>
                                <th style="width: 12%;">PAR Count (&ge;&#8369;50k)</th>
                                <th style="width: 12%;">ICS Count (&lt;&#8369;50k)</th>
                                <th style="width: 18%;">Total Accountable Value</th>
                                <th style="width: 18%;">Clearance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Sanver Andrew H. Mapacpac</strong></td>
                                <td class="small">Property Custodian / SPMU</td>
                                <td class="text-center font-monospace">18</td>
                                <td class="text-center font-monospace">12</td>
                                <td class="text-end font-monospace fw-bold">&#8369;2,450,000.00</td>
                                <td class="text-center"><span class="badge bg-success">Cleared &bull; On Active Duty</span></td>
                            </tr>
                            <tr>
                                <td><strong>Lourdes Garcia</strong></td>
                                <td class="small">Head Librarian / Campus Library</td>
                                <td class="text-center font-monospace">14</td>
                                <td class="text-center font-monospace">8</td>
                                <td class="text-end font-monospace fw-bold">&#8369;1,820,500.00</td>
                                <td class="text-center"><span class="badge bg-success">Cleared &bull; On Active Duty</span></td>
                            </tr>
                            <tr>
                                <td><strong>Dr. L. Ramos</strong></td>
                                <td class="small">Department Chair / Science Lab</td>
                                <td class="text-center font-monospace">22</td>
                                <td class="text-center font-monospace">15</td>
                                <td class="text-end font-monospace fw-bold">&#8369;3,120,000.00</td>
                                <td class="text-center"><span class="badge bg-success">Cleared &bull; On Active Duty</span></td>
                            </tr>
                            <tr>
                                <td><strong>Randall R. Reginio, D.Tech</strong></td>
                                <td class="small">Campus Director / Admin Office</td>
                                <td class="text-center font-monospace">30</td>
                                <td class="text-center font-monospace">11</td>
                                <td class="text-end font-monospace fw-bold">&#8369;3,351,500.00</td>
                                <td class="text-center"><span class="badge bg-success">Cleared &bull; On Active Duty</span></td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light fw-bold text-dark">
                            <tr>
                                <td colspan="2" class="text-end text-uppercase">TOTAL CAMPUS ACCOUNTABILITY:</td>
                                <td class="text-center font-monospace">84</td>
                                <td class="text-center font-monospace">46</td>
                                <td class="text-end font-monospace text-marsu-burgundy">&#8369;10,742,000.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Signatories Section -->
                <div class="row g-3 mt-4 pt-3 border-top">
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Prepared &amp; Verified by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">Sanver Andrew H. Mapacpac</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Supply &amp; Property Officer &bull; Sta. Cruz Campus</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Noted &amp; Approved by:</div>
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