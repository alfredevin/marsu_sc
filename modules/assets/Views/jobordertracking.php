<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;" id="fmEyebrow">
                <i class="bi bi-tools me-1"></i>GENERAL SERVICES &bull; SUB-MODULE 2
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="fmSubmoduleHeading">
                Job Order Tracking &amp; Dispatch
            </h1>
            <p class="text-muted small mb-0" id="fmSubmoduleSubtext">
                Track one-time corrective work orders from dispatch through verified completion, milestones, and labor hours.
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
    <div id="moduleContent" data-module="scheduling">
        <div class="fm-job-order-tracking mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <h2 class="h5 fw-bold text-marsu-burgundy m-0">
                    <i class="bi bi-kanban-fill text-warning me-2"></i>General Services Job Order Pipeline
                </h2>
                <div class="d-flex flex-wrap gap-2">
                    <input type="search" id="jobSearch" class="form-control form-control-sm" placeholder="Search ref, asset, task, tech...">
                    <select id="jobStatusFilter" class="form-select form-select-sm">
                        <option value="ALL">All Statuses</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Due">Due / Overdue</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <select id="jobCategoryFilter" class="form-select form-select-sm">
                        <option value="ALL">All Categories</option>
                    </select>
                </div>
            </div>

            <!-- Kanban Pipeline Columns -->
            <div class="row g-3 mb-4">
                
                <!-- Column 1: Scheduled -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 border-top border-4 border-warning p-3 h-100 bg-light" style="min-height: 380px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small fw-bold text-dark text-uppercase">1. Scheduled</span>
                            <span class="badge bg-secondary font-monospace" id="countScheduled">0</span>
                        </div>
                        <div class="card border-0 shadow-sm p-3 bg-white text-center justify-content-center align-items-center fst-italic text-muted small py-5" style="border-radius: 8px;">
                            <i class="bi bi-inbox fs-3 mb-1 text-secondary"></i>
                            No jobs in this stage
                        </div>
                    </div>
                </div>

                <!-- Column 2: Due / Overdue -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 border-top border-4 border-danger p-3 h-100 bg-light" style="min-height: 380px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small fw-bold text-danger text-uppercase">2. Due / Overdue</span>
                            <span class="badge bg-danger font-monospace" id="countDue">1</span>
                        </div>
                        
                        <div class="card border-0 shadow-sm p-3 bg-white mb-2" style="border-radius: 8px;">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <span class="font-monospace fw-bold text-marsu-burgundy small">MNT-012</span>
                                <span class="badge bg-warning text-dark small px-2" style="font-size: 0.7rem;">High</span>
                            </div>
                            <div class="fw-bold text-dark small mb-2">Second-Floor Comfort Room Pipe and Faucet Repair</div>
                            <div class="small text-muted mb-2">
                                <div class="mb-1"><i class="bi bi-geo-alt-fill text-secondary me-1"></i>Teacher Education &amp; Arts Building</div>
                                <div><i class="bi bi-person-fill text-secondary me-1"></i>Jonathan D. Reyes (Plumbing)</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-auto small">
                                <span class="font-monospace text-danger fw-bold" style="font-size: 0.78rem;">2026-10-05</span>
                                <span class="font-monospace fw-bold text-dark">&#8369;1,450.00</span>
                            </div>
                            <div class="d-flex justify-content-end gap-1 mt-2 pt-2 border-top">
                                <button class="btn btn-sm btn-dark text-white fw-bold px-2 py-1 shadow-sm" style="font-size: 0.72rem; border-radius: 6px;" onclick="alert('Starting MNT-012')">
                                    <i class="bi bi-play-fill me-1"></i>Start
                                </button>
                                <button class="btn btn-sm btn-outline-success fw-bold px-2 py-1 shadow-sm" style="font-size: 0.72rem; border-radius: 6px;" onclick="alert('Completing MNT-012')">
                                    <i class="bi bi-check-lg me-1"></i>Complete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: In Progress -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 border-top border-4 border-info p-3 h-100 bg-light" style="min-height: 380px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small fw-bold text-info text-uppercase">3. In Progress</span>
                            <span class="badge bg-info text-dark font-monospace" id="countInProgress">2</span>
                        </div>
                        
                        <div style="max-height: 400px; overflow-y: auto; padding-right: 2px;">
                            <div class="card border-0 shadow-sm p-3 bg-white mb-2" style="border-radius: 8px;">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <span class="font-monospace fw-bold text-marsu-burgundy small">MNT-007</span>
                                    <span class="badge bg-warning text-dark small px-2" style="font-size: 0.7rem;">Medium</span>
                                </div>
                                <div class="fw-bold text-dark small mb-2">Speaker Driver Replacement &amp; Wireless Mic Re-pairing</div>
                                <div class="small text-muted mb-2">
                                    <div class="mb-1"><i class="bi bi-geo-alt-fill text-secondary me-1"></i>University Gymnasium</div>
                                    <div><i class="bi bi-person-fill text-secondary me-1"></i>Roberto C. Malabanan (Electrical)</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-auto small">
                                    <span class="font-monospace text-muted" style="font-size: 0.78rem;">2026-09-29</span>
                                    <span class="font-monospace fw-bold text-dark">&#8369;4,200.00</span>
                                </div>
                                <div class="d-flex justify-content-end gap-1 mt-2 pt-2 border-top">
                                    <button class="btn btn-sm btn-outline-success fw-bold px-2 py-1 shadow-sm" style="font-size: 0.72rem; border-radius: 6px;" onclick="alert('Completing MNT-007')">
                                        <i class="bi bi-check-lg me-1"></i>Complete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 4: Completed & Verified -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 border-top border-4 border-success p-3 h-100 bg-light" style="min-height: 380px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small fw-bold text-success text-uppercase">4. Completed &bull; Verified</span>
                            <span class="badge bg-success font-monospace" id="countCompleted">1</span>
                        </div>
                        
                        <div class="card border-0 shadow-sm p-3 bg-white mb-2" style="border-radius: 8px;">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <span class="font-monospace fw-bold text-marsu-burgundy small">MNT-013</span>
                                <span class="badge bg-warning text-dark small px-2" style="font-size: 0.7rem;">Medium</span>
                            </div>
                            <div class="fw-bold text-dark small mb-2">Classroom Door Closer Adjustment and Safety Check</div>
                            <div class="small text-muted mb-2">
                                <div class="mb-1"><i class="bi bi-geo-alt-fill text-secondary me-1"></i>Teacher Education &amp; Arts Building</div>
                                <div><i class="bi bi-person-fill text-secondary me-1"></i>Mariano L. Gutierrez</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-auto small">
                                <span class="font-monospace text-muted" style="font-size: 0.78rem;">2026-10-02</span>
                                <span class="font-monospace fw-bold text-dark">&#8369;980.00</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sta. Cruz Campus General Services Job Orders Table -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h3 class="m-0 fw-bold fs-6 text-marsu-burgundy">
                        <i class="bi bi-list-task text-warning me-2"></i>Sta. Cruz Campus General Services Job Orders
                    </h3>
                    <span class="badge bg-warning text-dark font-monospace" id="jobTableCount">3 records</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-marsu bg-marsu-burgundy text-white">
                                <tr>
                                    <th class="py-3 px-3">Job Ref</th>
                                    <th class="py-3 px-3">Target Asset / Facility</th>
                                    <th class="py-3 px-3">Maintenance Task</th>
                                    <th class="py-3 px-3">Category</th>
                                    <th class="py-3 px-3">Frequency</th>
                                    <th class="py-3 px-3">Assigned Personnel</th>
                                    <th class="py-3 px-3">Due Date</th>
                                    <th class="py-3 px-3">Est. Cost</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="maintenanceTableBody">
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy px-3">JO-GS-001</td>
                                    <td class="fw-semibold text-dark px-3">BLD-ADM &bull; Auditorium</td>
                                    <td class="px-3">Stage Carpentry Repair &amp; Reinforcement</td>
                                    <td class="px-3"><span class="badge bg-light text-dark border">Carpentry</span></td>
                                    <td class="small text-muted px-3">Corrective</td>
                                    <td class="small px-3">Crew Leader P. Ramos</td>
                                    <td class="font-monospace small text-muted px-3">Nov 03, 2026</td>
                                    <td class="font-monospace px-3">&#8369;3,500.00</td>
                                    <td class="px-3"><span class="badge bg-info text-dark">In Progress</span></td>
                                    <td class="text-center px-3">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <button class="btn btn-sm p-1 text-info border rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-color: #d4af37 !important;" title="Start / Play" onclick="alert('Starting JO-GS-001')">
                                                <i class="bi bi-play-fill fs-6"></i>
                                            </button>
                                            <button class="btn btn-sm p-1 text-success border rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-color: #d4af37 !important;" title="Verify / Complete" onclick="alert('Completing JO-GS-001')">
                                                <i class="bi bi-check-lg fs-6"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy px-3">JO-GS-002</td>
                                    <td class="fw-semibold text-dark px-3">BLD-SCI &bull; Restroom Wing</td>
                                    <td class="px-3">Main Plumbing Line Leak Repair</td>
                                    <td class="px-3"><span class="badge bg-light text-dark border">Plumbing</span></td>
                                    <td class="small text-muted px-3">Corrective</td>
                                    <td class="small px-3">Plumber T. Alcantara</td>
                                    <td class="font-monospace small text-muted px-3">Oct 24, 2026</td>
                                    <td class="font-monospace px-3">&#8369;2,100.00</td>
                                    <td class="px-3"><span class="badge bg-danger">Due / Overdue</span></td>
                                    <td class="text-center px-3">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <button class="btn btn-sm p-1 text-success border rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-color: #d4af37 !important;" title="Verify / Complete" onclick="alert('Resolving JO-GS-002')">
                                                <i class="bi bi-check-lg fs-6"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-monospace fw-bold text-marsu-burgundy px-3">JO-GS-003</td>
                                    <td class="fw-semibold text-dark px-3">Campus Grounds &bull; Quadrangle</td>
                                    <td class="px-3">Landscape Trimming &amp; Clearing</td>
                                    <td class="px-3"><span class="badge bg-light text-dark border">Groundskeeping</span></td>
                                    <td class="small text-muted px-3">Monthly</td>
                                    <td class="small px-3">Maintenance Team B</td>
                                    <td class="font-monospace small text-muted px-3">Nov 10, 2026</td>
                                    <td class="font-monospace px-3">&#8369;1,500.00</td>
                                    <td class="px-3"><span class="badge bg-secondary">Scheduled</span></td>
                                    <td class="text-center px-3">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <button class="btn btn-sm p-1 text-info border rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-color: #d4af37 !important;" title="Start / Play" onclick="alert('Starting JO-GS-003')">
                                                <i class="bi bi-play-fill fs-6"></i>
                                            </button>
                                            <button class="btn btn-sm p-1 text-success border rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-color: #d4af37 !important;" title="Verify / Complete" onclick="alert('Completing JO-GS-003')">
                                                <i class="bi bi-check-lg fs-6"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.module-content -->
</div>