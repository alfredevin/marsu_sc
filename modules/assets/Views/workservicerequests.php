<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;" id="fmEyebrow">
                <i class="bi bi-tools me-1"></i>GENERAL SERVICES
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="fmSubmoduleHeading">
                Work &amp; Service Requests
            </h1>
            <p class="text-muted small mb-0" id="fmSubmoduleSubtext">
                Intake, review, and dispatch for carpentry, electrical, plumbing, campus transport, and physical plant maintenance tasks.
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
    <section class="row g-3 mb-4" aria-label="General Services key indicators">
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
                <div class="small text-muted mt-2"><span id="kpiBuildingsMeta">Complete campus coverage</span></div>
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
                <div class="small text-muted mt-2"><span id="kpiHealthMeta">Optimized operational state</span></div>
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
                <div class="small text-muted mt-2"><span id="kpiJobsMeta">In progress by maintenance unit</span></div>
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
                <div class="small text-muted mt-2"><span id="kpiRequestsMeta">Requires technical review</span></div>
            </div>
        </div>
    </section>

    <!-- Module Content -->
    <div id="moduleContent" data-module="service-requests">
        <!-- Request Campus Support Form -->
        <div class="card shadow-sm border-0 p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2 border-bottom pb-2">
                <div>
                    <h2 class="h5 fw-bold text-marsu-burgundy m-0">
                        <i class="bi bi-bell-fill text-warning me-2"></i>Request Campus Support
                    </h2>
                    <p class="small text-muted mb-0">For room setup, event support, cleaning, groundskeeping, hauling, and other non-repair services.</p>
                </div>
                <span class="badge bg-secondary">Separate from repair requests</span>
            </div>
            <form id="serviceRequestForm" autocomplete="off">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceFacility">Facility / Room</label>
                        <select id="serviceFacility" class="form-select form-select-sm" required>
                            <option value="">Select Facility / Room...</option>
                            <option value="BLD-ADM • Auditorium">BLD-ADM &bull; Auditorium</option>
                            <option value="BLD-IS • Computer Lab 1">BLD-IS &bull; Computer Lab 1</option>
                            <option value="BLD-SCI • Lecture Hall">BLD-SCI &bull; Lecture Hall</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceCategory">Service Needed</label>
                        <select id="serviceCategory" class="form-select form-select-sm" required>
                            <option value="Room Setup">Room Setup</option>
                            <option value="Event Support">Event Support</option>
                            <option value="Cleaning &amp; Sanitation">Cleaning &amp; Sanitation</option>
                            <option value="Groundskeeping">Groundskeeping</option>
                            <option value="Hauling &amp; Transport">Hauling &amp; Transport</option>
                            <option value="General Assistance">General Assistance</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceUrgency">Priority</label>
                        <select id="serviceUrgency" class="form-select form-select-sm" required>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            <option value="Emergency">Emergency</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceDateNeeded">Service Date</label>
                        <input type="date" id="serviceDateNeeded" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceRequestedBy">Requested By</label>
                        <input type="text" id="serviceRequestedBy" class="form-control form-control-sm" placeholder="Full Name / Department" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceAssignedTo">Assigned Unit / Contact</label>
                        <input type="text" id="serviceAssignedTo" class="form-control form-control-sm" placeholder="e.g. General Services Unit">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small font-monospace text-uppercase fw-bold text-muted" for="serviceDetails">Service Details</label>
                    <textarea id="serviceDetails" class="form-control form-control-sm" rows="2" placeholder="Describe the support needed, including schedule, quantity, or access instructions." required></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-sm btn-outline-secondary px-3">Clear</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold px-4 shadow-sm">
                        <i class="bi bi-send-fill me-1"></i>Submit Service Request
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter and Queue Controls -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div class="d-flex flex-wrap gap-2" id="serviceStatusChips">
                <span class="badge bg-marsu-burgundy text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">All (4)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Pending (1)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Approved (1)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">In Progress (1)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Cancelled (1)</span>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <input type="search" id="serviceSearch" class="form-control form-control-sm" placeholder="Search ref, room, service, requester...">
                <select id="serviceUrgencyFilter" class="form-select form-select-sm" aria-label="Filter service requests by priority">
                    <option value="ALL">All Priorities</option>
                    <option value="Emergency">Emergency</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>

        <!-- Campus Work/Service Request Queue Table -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center border-bottom">
                <h3 class="m-0 fw-bold fs-6 text-white">
                    <i class="bi bi-list-task text-warning me-2"></i>Campus Work/Service Request Queue
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
                                <th class="py-3">Service</th>
                                <th class="py-3">Details</th>
                                <th class="py-3">Needed By</th>
                                <th class="py-3">Priority</th>
                                <th class="py-3">Requested By</th>
                                <th class="py-3">Assigned To</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center" style="min-width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="serviceRequestsTableBody">
                            
                            <!-- Scenario 1: Approved Request (Pwede nang i-Start Request o Cancel) -->
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-101</td>
                                <td class="fw-semibold text-dark">BLD-ADM &bull; Auditorium</td>
                                <td><span class="badge bg-light text-dark border">Room Setup</span></td>
                                <td class="small">Setup 150 chairs and audio system for orientation</td>
                                <td class="font-monospace small text-muted">Nov 02, 2026</td>
                                <td><span class="badge bg-warning text-dark">High</span></td>
                                <td class="small text-muted">Dean S. Perez</td>
                                <td class="small text-dark font-monospace">GSU Logistics</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-sm btn-success fw-bold px-2 py-1 shadow-sm" style="font-size: 0.75rem;" onclick="alert('Starting Request SRV-2026-101')">
                                            <i class="bi bi-play-circle-fill me-1"></i>Start
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.75rem;" title="Cancel Request" onclick="confirm('Cancel Request SRV-2026-101?')">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div> 
                                </td>
                            </tr>

                            <!-- Scenario 2: Pending Request (Kailangan ng Approval o Cancel) -->
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-102</td>
                                <td class="fw-semibold text-dark">BLD-IS &bull; Computer Lab 1</td>
                                <td><span class="badge bg-light text-dark border">Cleaning &amp; Sanitation</span></td>
                                <td class="small">Post-lab general disinfection and floor stripping</td>
                                <td class="font-monospace small text-muted">Nov 04, 2026</td>
                                <td><span class="badge bg-secondary">Low</span></td>
                                <td class="small text-muted">Prof. K. Tan</td>
                                <td class="small text-muted">&mdash;</td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-sm btn-warning text-dark fw-bold px-2 py-1 shadow-sm" style="font-size: 0.75rem;" onclick="alert('Approving Request SRV-2026-102')">
                                            <i class="bi bi-check-circle-fill me-1"></i>Approve
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.75rem;" title="Cancel Request" onclick="confirm('Cancel Request SRV-2026-102?')">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Scenario 3: In Progress Request (May option mag-Cancel kung kailangan) -->
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-103</td>
                                <td class="fw-semibold text-dark">BLD-SCI &bull; Lecture Hall</td>
                                <td><span class="badge bg-light text-dark border">Hauling &amp; Transport</span></td>
                                <td class="small">Transport heavy science equipment boxes to annex building</td>
                                <td class="font-monospace small text-muted">Oct 26, 2026</td>
                                <td><span class="badge bg-danger">Emergency</span></td>
                                <td class="small text-muted">Dr. E. Santos</td>
                                <td class="small text-dark font-monospace">Motorpool Unit</td>
                                <td><span class="badge bg-info text-dark">In Progress</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <span class="badge text-white font-monospace px-2 py-1 shadow-sm d-flex align-items-center" style="background-color: #17a2b8; border-radius: 6px; font-size: 0.72rem;">
                                            <i class="bi bi-gear-wide-connected me-1 fs-6"></i>Active
                                        </span>
                                        <button class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.75rem;" title="Cancel Request" onclick="confirm('Cancel Request SRV-2026-103?')">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Scenario 4: Cancelled Request -->
                            <tr>
                                <td class="font-monospace fw-bold text-marsu-burgundy">SRV-2026-104</td>
                                <td class="fw-semibold text-dark">BLD-EDU &bull; Room 201</td>
                                <td><span class="badge bg-light text-dark border">Event Support</span></td>
                                <td class="small">Sound system setup for department meeting (Cancelled event)</td>
                                <td class="font-monospace small text-muted">Oct 20, 2026</td>
                                <td><span class="badge bg-secondary">Low</span></td>
                                <td class="small text-muted">Prof. M. Lopez</td>
                                <td class="small text-muted">&mdash;</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td class="text-center">
                                    <span class="badge bg-light text-muted border px-2 py-1 font-monospace" style="font-size: 0.72rem;">
                                        No Action
                                    </span>
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