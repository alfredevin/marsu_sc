<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-bar-chart-line-fill text-warning me-1"></i>REPORTS &amp; ANALYTICS &bull; SUB-MODULE 4
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                Maintenance Performance &amp; Job Order Metrics
            </h1>
            <p class="text-muted small mb-0">Mean Time to Repair (MTTR), SLA compliance rate, preventive vs corrective turnaround, and cumulative facility expenditures.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm px-3" onclick="window.print();" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028; border-radius: 6px;">
                <i class="bi bi-printer-fill me-1"></i>Print Report
            </button>
        </div>
    </div>

    <!-- KPIs Section -->
    <section class="row g-3 mb-4" aria-label="Maintenance Performance Key Indicators">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">SLA Turnaround Rate</div>
                        <div class="h3 fw-bold text-success font-monospace my-1">94.8%</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Within 48h Campus Standard</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Mean Time to Repair (MTTR)</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1">1.8 Days</div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-speedometer fs-4"></i>
                    </div>
                </div>
                <div class="small text-success mt-2"><i class="bi bi-arrow-down-right me-1"></i>-0.4 Days vs Q2 Benchmark</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Preventive Maintenance Rate</div>
                        <div class="h3 fw-bold text-info font-monospace my-1">98.2%</div>
                    </div>
                    <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">54 Scheduled Inspections Done</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-danger p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold text-marsu-burgundy">YTD Maintenance Expense</div>
                        <div class="h3 fw-bold text-marsu-burgundy font-monospace my-1">&#8369;284,500.00</div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-receipt fs-4"></i>
                    </div>
                </div>
                <div class="small text-success mt-2"><i class="bi bi-check-circle-fill me-1"></i>18% Below Allocated Budget</div>
            </div>
        </div>
    </section>

    <!-- Printable Preview Card -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom gap-2" style="background-color: #7B1E2B;">
            <div class="d-flex align-items-center">
                <i class="bi bi-tools text-warning me-3 fs-4"></i>
                <div>
                    <h6 class="fw-bold mb-0 text-white">Maintenance Performance &amp; Service Ledger Preview</h6>
                    <small class="text-warning">General Services Division &bull; Sta. Cruz Campus Operations</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-light fw-bold shadow-sm" onclick="window.togglePaperFit('maintenancePaperViewport')" title="Toggle between standard A4 scale and responsive fit">
                    <i class="bi bi-arrows-fullscreen me-1"></i>Fit / 100%
                </button>
                <button type="button" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" onclick="printMaintenanceReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028;">
                    <i class="bi bi-printer-fill me-1"></i>Print Report / Save PDF
                </button>
            </div>
        </div>

        <!-- Report Content Area -->
        <div class="card-body p-3 p-md-4 bg-light" style="min-height: 500px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            
            <!-- A4 Simulated Paper Container -->
            <div class="bg-white p-4 p-md-5 shadow-sm mx-auto position-relative text-dark" id="maintenancePaperViewport" style="max-width: 1000px; border-radius: 4px; border: 1px solid #dee2e6;">
                
                <!-- Report Header Inside Paper -->
                <div class="text-end text-muted small fw-bold mb-2">GSD-FM Form 12</div>
                <div class="text-center mb-4">
                    <div class="small fw-bold text-uppercase text-secondary mb-1">Republic of the Philippines</div>
                    <h4 class="fw-bold mb-1" style="color: #7B1E2B; letter-spacing: 0.5px;">MARINDUQUE STATE UNIVERSITY</h4>
                    <div class="small fw-semibold text-dark mb-2">STA. CRUZ CAMPUS &bull; GENERAL SERVICES &amp; MAINTENANCE UNIT</div>
                    <h5 class="fw-bold text-dark text-uppercase mt-2" style="font-size: 1.05rem;">
                        ANNUAL CAMPUS MAINTENANCE PERFORMANCE &amp; SERVICE LEDGER
                    </h5>
                    <div class="small text-muted font-monospace mt-1">Comprehensive Service Breakdown FY 2026 &bull; SUC Facility Standard</div>
                </div>

                <!-- Ledger Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-sm align-middle mb-0 text-dark" style="font-size: 0.82rem; background-color: #ffffff;">
                        <thead class="text-center align-middle" style="background-color: #2b040e; color: #d4af37;">
                            <tr>
                                <th style="width: 25%;">Service Category</th>
                                <th style="width: 11%;">Total Requests</th>
                                <th style="width: 11%;">Completed</th>
                                <th style="width: 14%;">Pending / In-Progress</th>
                                <th style="width: 13%;">Avg. Turnaround</th>
                                <th style="width: 14%;">Total Expenditure</th>
                                <th style="width: 12%;">SLA Compliance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Air Conditioning &amp; HVAC</strong></td>
                                <td class="text-center font-monospace">18</td>
                                <td class="text-center font-monospace">17</td>
                                <td class="text-center font-monospace">1</td>
                                <td class="text-center">2.1 Days</td>
                                <td class="text-end font-monospace">&#8369;85,400.00</td>
                                <td class="text-center"><span class="badge bg-success">94.4%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Electrical &amp; Power Generation</strong></td>
                                <td class="text-center font-monospace">24</td>
                                <td class="text-center font-monospace">23</td>
                                <td class="text-center font-monospace">1</td>
                                <td class="text-center">1.2 Days</td>
                                <td class="text-end font-monospace">&#8369;62,100.00</td>
                                <td class="text-center"><span class="badge bg-success">95.8%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Plumbing &amp; Water Systems</strong></td>
                                <td class="text-center font-monospace">14</td>
                                <td class="text-center font-monospace">14</td>
                                <td class="text-center font-monospace">0</td>
                                <td class="text-center">1.0 Day</td>
                                <td class="text-end font-monospace">&#8369;28,900.00</td>
                                <td class="text-center"><span class="badge bg-success">100.0%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Carpentry &amp; Facility Structure</strong></td>
                                <td class="text-center font-monospace">12</td>
                                <td class="text-center font-monospace">11</td>
                                <td class="text-center font-monospace">1</td>
                                <td class="text-center">2.8 Days</td>
                                <td class="text-end font-monospace">&#8369;49,200.00</td>
                                <td class="text-center"><span class="badge bg-success">91.6%</span></td>
                            </tr>
                            <tr>
                                <td><strong>IT Infrastructure &amp; Telecom</strong></td>
                                <td class="text-center font-monospace">31</td>
                                <td class="text-center font-monospace">30</td>
                                <td class="text-center font-monospace">1</td>
                                <td class="text-center">0.8 Days</td>
                                <td class="text-end font-monospace">&#8369;58,900.00</td>
                                <td class="text-center"><span class="badge bg-success">96.7%</span></td>
                            </tr>
                        </tbody>
                        <tfoot class="fw-bold text-dark" style="background-color: rgba(212,175,55,0.15);">
                            <tr>
                                <td class="text-uppercase">CONSOLIDATED TOTALS:</td>
                                <td class="text-center font-monospace">99</td>
                                <td class="text-center font-monospace">95</td>
                                <td class="text-center font-monospace">4</td>
                                <td class="text-center">1.8 Days</td>
                                <td class="text-end font-monospace text-marsu-burgundy">&#8369;284,500.00</td>
                                <td class="text-center"><span class="badge bg-warning text-dark">94.8% SLA</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Signatories Section -->
                <div class="row g-3 mt-4 pt-3 border-top">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Prepared by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">SANVER ANDREW H. MAPACPAC</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Property Custodian / SPMU Officer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Verified by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">ENGR. RAFAEL MENDOZA</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Campus Inspection Officer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Approved by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">DR. RANDELL REGINIO</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Campus Director, Sta. Cruz Campus</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>