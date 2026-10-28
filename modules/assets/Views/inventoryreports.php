<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-file-earmark-text-fill text-warning me-1"></i>Commission on Audit Regulatory Compliance
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                COA &amp; Campus Property Intelligence Reports
            </h1>
            <p class="text-muted small mb-0">Official Philippine government reports generated directly from verified Sta. Cruz Campus live asset records.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm px-3" onclick="printOfficialReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028; border-radius: 6px;">
                <i class="bi bi-printer-fill me-1"></i>Print Report / PDF
            </button>
        </div>
    </div>

    <!-- Report Tabs Navigation Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body p-3">
            <ul class="nav nav-pills gap-2" id="reportTabs">
                <li class="nav-item">
                    <a class="nav-link active fw-bold px-3 py-2 text-dark shadow-sm" href="javascript:void(0)" onclick="switchReport('RPCPPE', this)" style="border-radius: 8px; background-color: #f3e08a !important; border: 1px solid #c5a028;">
                        <i class="bi bi-building me-1"></i>RPCPPE (Capitalized PPE &ge; &#8369;50k)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3 py-2 text-dark bg-light border" href="javascript:void(0)" onclick="switchReport('RPCSP', this)" style="border-radius: 8px;">
                        <i class="bi bi-box-seam me-1"></i>RPCSP (Semi-Expendable &lt; &#8369;50k)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3 py-2 text-dark bg-light border" href="javascript:void(0)" onclick="switchReport('RSMI', this)" style="border-radius: 8px;">
                        <i class="bi bi-file-text me-1"></i>RSMI (Supplies Issued)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3 py-2 text-dark bg-light border" href="javascript:void(0)" onclick="switchReport('DEPR', this)" style="border-radius: 8px;">
                        <i class="bi bi-calculator me-1"></i>Depreciation Schedule
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Printable Report Container Card -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom gap-2" style="background-color: #7B1E2B;">
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-contract-fill text-warning me-3 fs-4"></i>
                <div>
                    <h6 class="fw-bold mb-0 text-white">COA Prescribed Official Report Preview</h6>
                    <small class="text-warning">Republic of the Philippines &bull; Commission on Audit Standard</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-light fw-bold shadow-sm" onclick="window.togglePaperFit('reportPaperViewport')" title="Toggle between standard A4 scale and responsive fit">
                    <i class="bi bi-arrows-fullscreen me-1"></i>Fit / 100%
                </button>
                <button type="button" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" onclick="printOfficialReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028;">
                    <i class="bi bi-printer-fill me-1"></i>Print Report / Save PDF
                </button>
            </div>
        </div>
        
        <!-- Report Preview Content Area (Static Paper Preview) -->
        <div class="card-body p-3 p-md-4 bg-light" id="reportContentArea" style="min-height: 500px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            
            <!-- A4 Simulated Paper Container (Static Print Layout) -->
            <div class="bg-white p-4 p-md-5 shadow-sm mx-auto position-relative text-dark" style="max-width: 1000px; border-radius: 4px; border: 1px solid #dee2e6;">
                
                <!-- Report Header Inside Paper -->
                <div class="text-end text-muted small fw-bold mb-2">Appendix 73</div>
                <div class="text-center mb-4">
                    <div class="small fw-bold text-uppercase text-secondary mb-1">Republic of the Philippines</div>
                    <h4 class="fw-bold mb-1" style="color: #7B1E2B; letter-spacing: 0.5px;">MARINDUQUE STATE UNIVERSITY</h4>
                    <div class="small fw-semibold text-dark mb-2">STA. CRUZ CAMPUS &bull; SUPPLY AND PROPERTY MANAGEMENT UNIT</div>
                    <h5 class="fw-bold text-dark text-uppercase mt-2" style="font-size: 1.05rem;">
                        REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT (RPCPPE)
                    </h5>
                    <div class="small text-muted font-monospace mt-1">As of October 25, 2026 &bull; Fund Cluster 01 / 05</div>
                </div>

                <!-- Report Table (Clean & Printable) -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-sm align-middle mb-0 text-dark" style="font-size: 0.82rem; background-color: #ffffff;">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th style="width: 16%;">Article / Description</th>
                                <th style="width: 12%;">Property No.</th>
                                <th style="width: 6%;">Unit</th>
                                <th style="width: 11%;">Unit Cost</th>
                                <th style="width: 11%;">Total Cost</th>
                                <th style="width: 11%;">Carrying Value</th>
                                <th style="width: 11%;">Accountable Officer</th>
                                <th style="width: 12%;">Location</th>
                                <th style="width: 10%;">Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item 1 -->
                            <tr>
                                <td>
                                    <strong>Apple iMac 24-inch M3 8-Core CPU 10-Core GPU 512GB Blue Edition</strong><br>
                                    <span class="text-muted" style="font-size: 0.73rem;">SN: SN-MSU-698819 &bull; Apple</span>
                                </td>
                                <td class="font-monospace small">MarSU-STC-2024-PPE-0023</td>
                                <td class="text-center">unit</td>
                                <td class="text-end font-monospace">&#8369;98,990.00</td>
                                <td class="text-end font-monospace fw-bold">&#8369;98,990.00</td>
                                <td class="text-end font-monospace text-danger fw-bold">&#8369;61,373.80</td>
                                <td class="small">Librarian<br>Lourdes Garcia</td>
                                <td class="small">BLD-06<br>(RM-602)</td>
                                <td class="text-center">Serviceable</td>
                            </tr>
                            <!-- Item 2 -->
                            <tr>
                                <td>
                                    <strong>Lenovo ThinkPad T14 Gen 5</strong><br>
                                    <span class="text-muted" style="font-size: 0.73rem;">SN: TP-554102 &bull; Intel Ultra 7</span>
                                </td>
                                <td class="font-monospace small">MarSU-STC-2025-PPE-0104</td>
                                <td class="text-center">unit</td>
                                <td class="text-end font-monospace">&#8369;78,500.00</td>
                                <td class="text-end font-monospace fw-bold">&#8369;78,500.00</td>
                                <td class="text-end font-monospace text-success fw-bold">&#8369;62,800.00</td>
                                <td class="small">Faculty Lead<br>Randall R. Reginio</td>
                                <td class="small">BLD-ADM<br>(Dean Office)</td>
                                <td class="text-center">Serviceable</td>
                            </tr>
                            <!-- Item 3 -->
                            <tr>
                                <td>
                                    <strong>Daikin Floor Standing Aircon 3.0 HP</strong><br>
                                    <span class="text-muted" style="font-size: 0.73rem;">SN: DK-AC-9901 &bull; Inverter Type</span>
                                </td>
                                <td class="font-monospace small">MarSU-STC-2023-PPE-0089</td>
                                <td class="text-center">unit</td>
                                <td class="text-end font-monospace">&#8369;85,000.00</td>
                                <td class="text-end font-monospace fw-bold">&#8369;85,000.00</td>
                                <td class="text-end font-monospace text-danger fw-bold">&#8369;51,000.00</td>
                                <td class="small">Property Custodian<br>Sanver Andrew Mapacpac</td>
                                <td class="small">BLD-GYM<br>(Main Hall)</td>
                                <td class="text-center">Serviceable</td>
                            </tr>
                        </tbody>
                        <!-- Total Capitalized PPE Summary Row -->
                        <tfoot class="table-light fw-bold text-dark">
                            <tr>
                                <td colspan="4" class="text-end text-uppercase">TOTAL CAPITALIZED PPE (82 items):</td>
                                <td class="text-end font-monospace">&#8369;21,156,791.00</td>
                                <td class="text-end font-monospace text-danger">&#8369;14,947,757.51</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Signatories Boxes (Certified Correct, Approved, Verified) -->
                <div class="row g-3 mt-4 pt-3 border-top">
                    <!-- Box 1 -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Certified Correct by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">Sanver Andrew H. Mapacpac</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Property Custodian &bull; Sta. Cruz</div>
                            </div>
                        </div>
                    </div>
                    <!-- Box 2 -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Approved by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">Randell R. Reginio, D.Tech</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Campus Director &bull; Sta. Cruz</div>
                            </div>
                        </div>
                    </div>
                    <!-- Box 3 -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Verified by:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">COA Resident Auditor</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Audit Team Leader &bull; SUC Sector</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>