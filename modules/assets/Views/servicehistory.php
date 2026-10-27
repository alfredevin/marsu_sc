<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;" id="fmEyebrow">
                <i class="bi bi-buildings-fill me-1"></i>FACILITIES MANAGEMENT &bull; SUB-MODULE 5
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="fmSubmoduleHeading">
                Service History &amp; Verified Completion Ledger
            </h1>
            <p class="text-muted small mb-0" id="fmSubmoduleSubtext">
                Verified completion ledger with actual vs estimated cost, timeliness, materials used, and next scheduled check.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-warning text-dark btn-sm fw-bold shadow-sm" id="btnHeaderNewRequest" onclick="window.switchMaintenanceSubmodule('repairs'); setTimeout(() => document.getElementById('reqScope').focus(), 150);">
                <i class="bi bi-wrench text-warning me-1"></i>New Repair Request
            </button>
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" id="btnHeaderCreateJob" onclick="window.openJobOrderModal()">
                <i class="bi bi-plus-circle me-1"></i>Create Job Order
            </button>
        </div>
    </div>

    <!-- Facilities KPI Row -->
    <section class="row g-3 mb-4" aria-label="Facilities key indicators">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Buildings &amp; Rooms</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1" id="kpiBuildings">7 / 26</div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-city fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Complete campus coverage</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Facility Health Index</div>
                        <div class="h3 fw-bold text-success font-monospace my-1" id="kpiHealth">92.8%</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Optimized operational state</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Open Job Orders</div>
                        <div class="h3 fw-bold text-info font-monospace my-1" id="kpiJobs">3</div>
                    </div>
                    <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                        <i class="bi bi-clipboard-check-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">In progress by maintenance unit</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-danger p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold text-danger">Open Repair Queue</div>
                        <div class="h3 fw-bold text-danger font-monospace my-1" id="kpiRequests">2</div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Requires technical review</div>
            </div>
        </div>
    </section>

    <!-- Module Content -->
    <div id="moduleContent" data-module="history">
        <!-- History KPI Summary Strip -->
        <div class="row g-3 mb-4" id="historyKpis">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 p-3 h-100 border-start border-4 border-success">
                    <div class="small text-muted fw-bold text-uppercase">Total Completed Services</div>
                    <div class="h4 fw-bold text-marsu-burgundy font-monospace mb-0 mt-1">128</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 p-3 h-100 border-start border-4 border-info">
                    <div class="small text-muted fw-bold text-uppercase">On-Time Completion Rate</div>
                    <div class="h4 fw-bold text-success font-monospace mb-0 mt-1">94.5%</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 p-3 h-100 border-start border-4 border-warning">
                    <div class="small text-muted fw-bold text-uppercase">Total Service Expenditure</div>
                    <div class="h4 fw-bold text-dark font-monospace mb-0 mt-1">&#8369;342,500</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 p-3 h-100 border-start border-4 border-secondary">
                    <div class="small text-muted fw-bold text-uppercase">Pending Scheduled Checks</div>
                    <div class="h4 fw-bold text-marsu-burgundy font-monospace mb-0 mt-1">14</div>
                </div>
            </div>
        </div>

        <!-- Service History Ledger Card -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center border-bottom gap-2">
                <h3 class="m-0 fw-bold fs-6 text-marsu-burgundy">
                    <i class="bi bi-check2-all text-warning me-2"></i>Verified Completion &amp; Service History Ledger
                </h3>
                <div class="d-flex flex-wrap gap-2">
                    <input type="search" id="histSearch" class="form-control form-control-sm" placeholder="Search ref, asset, task, technician...">
                    <select id="histCategoryFilter" class="form-select form-select-sm">
                        <option value="ALL">All Categories</option>
                        <option value="HVAC">HVAC / Cooling</option>
                        <option value="Laboratory">Laboratory Instruments</option>
                        <option value="Electrical">Electrical Infrastructure</option>
                    </select>
                    <button class="btn btn-sm btn-outline-success fw-bold px-3 shadow-sm" id="btnExportHistory" onclick="window.exportServiceHistoryCSV()">
                        <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i>Export CSV
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive fm-history-table">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Service Ref</th>
                                <th class="py-3">Asset / Facility</th>
                                <th class="py-3">Task Title</th>
                                <th class="py-3">Completed</th>
                                <th class="py-3">Performed / Verified By</th>
                                <th class="py-3">Est. vs Actual</th>
                                <th class="py-3">Timeliness</th>
                                <th class="py-3">Next Check</th>
                            </tr>
                        </thead>
                        <tbody id="serviceHistoryTableBody">
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-012</td>
                                <td class="fw-semibold text-dark">BLD-IS &bull; Room 101 (Server Room)</td>
                                <td>Quarterly Precision HVAC Preventive Maintenance</td>
                                <td class="small text-muted">Oct 15, 2026</td>
                                <td class="small">Engr. Mario Santos / Dir. J. Reyes</td>
                                <td class="font-monospace small">&#8369;4,500 / &#8369;4,300</td>
                                <td><span class="badge bg-success">On-Time</span></td>
                                <td class="small text-muted font-monospace">Jan 15, 2027</td>
                            </tr>
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-011</td>
                                <td class="fw-semibold text-dark">BLD-SCI &bull; Chem Lab 1</td>
                                <td>Fume Hood Exhaust Duct Cleaning & Calibration</td>
                                <td class="small text-muted">Oct 10, 2026</td>
                                <td class="small">Tech. Juan Dela Cruz / Dr. L. Ramos</td>
                                <td class="font-monospace small">&#8369;2,800 / &#8369;3,100</td>
                                <td><span class="badge bg-warning text-dark">Delayed (2d)</span></td>
                                <td class="small text-muted font-monospace">Apr 10, 2027</td>
                            </tr>
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-010</td>
                                <td class="fw-semibold text-dark">BLD-ADM &bull; Registrar Office</td>
                                <td>Main Distribution Panel Thermal Scanning</td>
                                <td class="small text-muted">Sep 28, 2026</td>
                                <td class="small">Engr. Roberto Gomez / Sec. M. Reyes</td>
                                <td class="font-monospace small">&#8369;5,000 / &#8369;5,000</td>
                                <td><span class="badge bg-success">On-Time</span></td>
                                <td class="small text-muted font-monospace">Sep 28, 2027</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="fm-history-cards p-3" id="serviceHistoryCards"></div>
            </div>
        </div>
    </div>
    <!-- /.module-content -->
</div>