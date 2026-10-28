<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;" id="fmEyebrow">
                <i class="bi bi-buildings-fill me-1"></i>FACILITIES MANAGEMENT &bull; SUB-MODULE 4
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="fmSubmoduleHeading">
                Facility &amp; Equipment Repair Requests
            </h1>
            <p class="text-muted small mb-0" id="fmSubmoduleSubtext">
                Submit, triage, and track facility work requests, repair priority, personnel assignment, and resolution.
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
                <div class="small text-muted mt-2">
                    <span id="kpiBuildingsMeta">Complete campus coverage</span>
                </div>
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
                <div class="small text-muted mt-2">
                    <span id="kpiHealthMeta">Optimized operational state</span>
                </div>
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
                <div class="small text-muted mt-2">
                    <span id="kpiJobsMeta">In progress by maintenance unit</span>
                </div>
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
                <div class="small text-muted mt-2">
                    <span id="kpiRequestsMeta">Requires technical review</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Module Content -->
    <div id="moduleContent" data-module="repairs">
        <!-- Submit Work Request Form Section -->
        <div class="card shadow-sm border-0 p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2 border-bottom pb-2">
                <h2 class="h5 fw-bold text-marsu-burgundy m-0">
                    <i class="bi bi-plus-circle-fill text-warning me-2"></i>Submit Work / Service Repair Request
                </h2>
                <span class="small text-muted">Dispatches directly to the General Services Unit queue</span>
            </div>
            <form id="repairRequestForm" autocomplete="off">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="reqFacility">Facility / Room</label>
                        <select id="reqFacility" class="form-select form-select-sm" required>
                            <option value="">Select Facility / Room...</option>
                            <option value="BLD-IS • Room 202 (Computer Lab)">BLD-IS &bull; Room 202 (Computer Lab)</option>
                            <option value="BLD-SCI • Chem Lab 1">BLD-SCI &bull; Chem Lab 1</option>
                            <option value="BLD-ADM • Room 101">BLD-ADM &bull; Room 101</option>
                            <option value="BLD-ENG • Electrical Room">BLD-ENG &bull; Electrical Room</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="reqCategory">Service Category</label>
                        <select id="reqCategory" class="form-select form-select-sm" required>
                            <option value="Air Conditioning / HVAC">Air Conditioning / HVAC</option>
                            <option value="Electrical & Power">Electrical &amp; Power</option>
                            <option value="IT Hardware & Cabling">IT Hardware &amp; Cabling</option>
                            <option value="Plumbing & Sanitation">Plumbing &amp; Sanitation</option>
                            <option value="Carpentry & Masonry">Carpentry &amp; Masonry</option>
                            <option value="Laboratory Instruments">Laboratory Instruments</option>
                            <option value="Audio-Visual">Audio-Visual</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="reqUrgency">Urgency Level</label>
                        <select id="reqUrgency" class="form-select form-select-sm" required>
                            <option value="Medium">Medium (Standard 3–5 days)</option>
                            <option value="High">High (Within 24 hours)</option>
                            <option value="Emergency">Emergency / Safety Critical</option>
                            <option value="Low">Low (Routine)</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="reqFiledBy">Requested By</label>
                        <input type="text" id="reqFiledBy" class="form-control form-control-sm" placeholder="Name / Unit" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="reqScope">Problem Description &amp; Scope</label>
                    <textarea id="reqScope" class="form-control form-control-sm" rows="2" placeholder="e.g. AC unit is producing rattling noise and leaking water near workstation 4..." required></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-sm btn-outline-secondary px-3">Clear</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold px-4 shadow-sm" id="btnSubmitRepair">
                        <i class="bi bi-send-fill me-1"></i>Transmit Repair Request
                    </button>
                </div>
            </form>
        </div>

        <!-- Repair Requests Queue Controls -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div class="d-flex flex-wrap gap-2" id="reqStatusChips">
                <span class="badge bg-marsu-burgundy text-white px-3 py-2 border shadow-sm" style="cursor: pointer;">All (4)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Pending (1)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Assigned (1)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">In Progress (1)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Resolved (1)</span>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <input type="search" id="reqSearch" class="form-control form-control-sm" placeholder="Search ref, room, description...">
                <select id="reqUrgencyFilter" class="form-select form-select-sm">
                    <option value="ALL">All Priorities</option>
                    <option value="Emergency">Emergency</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>

        <!-- Repair Requests Queue Table -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h3 class="m-0 fw-bold fs-6 text-marsu-burgundy">
                    <i class="bi bi-wrench text-warning me-2"></i>Repair Requests Queue
                </h3>
                <span class="badge bg-warning text-dark font-monospace">4 items</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Request Ref</th>
                                <th class="py-3">Facility / Room</th>
                                <th class="py-3">Category</th>
                                <th class="py-3">Problem Description</th>
                                <th class="py-3">Priority</th>
                                <th class="py-3">Filed By</th>
                                <th class="py-3">Assigned To</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="repairRequestsTableBody">
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">REQ-2026-041</td>
                                <td class="fw-semibold text-dark">BLD-IS &bull; Room 202</td>
                                <td><span class="badge bg-light text-dark border">HVAC / Cooling</span></td>
                                <td class="small">AC unit producing rattling noise and leaking water</td>
                                <td><span class="badge bg-danger">Emergency</span></td>
                                <td class="small text-muted">Prof. A. Cruz</td>
                                <td class="small text-dark font-monospace">Engr. M. Santos</td>
                                <td><span class="badge bg-info text-dark">In Progress</span></td>
                                <td class="text-center">
                                    <span class="badge text-white font-monospace px-3 py-2 shadow-sm" style="background-color: #17a2b8; border-radius: 8px; cursor: pointer;" onclick="alert('Viewing MNT-007')">
                                        MNT-007
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">REQ-2026-042</td>
                                <td class="fw-semibold text-dark">BLD-SCI &bull; Chem Lab 1</td>
                                <td><span class="badge bg-light text-dark border">Laboratory</span></td>
                                <td class="small">Fume hood exhaust duct suction power low</td>
                                <td><span class="badge bg-warning text-dark">High</span></td>
                                <td class="small text-muted">Dr. L. Ramos</td>
                                <td class="small text-dark font-monospace">Tech. J. Dela Cruz</td>
                                <td><span class="badge bg-warning text-dark">Assigned</span></td>
                                <td class="text-center">
                                    <span class="badge text-white font-monospace px-3 py-2 shadow-sm" style="background-color: #17a2b8; border-radius: 8px; cursor: pointer;" onclick="alert('Viewing MNT-009')">
                                        MNT-009
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">REQ-2026-043</td>
                                <td class="fw-semibold text-dark">BLD-ADM &bull; Room 101</td>
                                <td><span class="badge bg-light text-dark border">Carpentry</span></td>
                                <td class="small">Executive chair height adjustment mechanism broken</td>
                                <td><span class="badge bg-secondary">Low</span></td>
                                <td class="small text-muted">Sec. M. Reyes</td>
                                <td class="small text-muted">&mdash;</td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border-warning text-dark fw-bold px-3 py-1 shadow-sm" style="border-radius: 8px;" onclick="alert('Processing Disposal')">
                                        <i class="bi bi-recycle me-1"></i>Disposal
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">REQ-2026-044</td>
                                <td class="fw-semibold text-dark">BLD-ENG &bull; Electrical Room</td>
                                <td><span class="badge bg-light text-dark border">Electrical</span></td>
                                <td class="small">Main breaker panel circuit 4 tripped repeatedly</td>
                                <td><span class="badge bg-danger">Emergency</span></td>
                                <td class="small text-muted">Engr. R. Gomez</td>
                                <td class="small text-dark font-monospace">Engr. R. Gomez</td>
                                <td><span class="badge bg-success">Resolved</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm text-dark fw-bold px-3 py-1 shadow-sm" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028; border-radius: 8px;" onclick="alert('Scheduling Repair')">
                                        <i class="bi bi-calendar-plus-fill me-1"></i>Schedule Repair
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.module-content -->
</div>