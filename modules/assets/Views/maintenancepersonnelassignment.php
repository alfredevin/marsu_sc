<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;" id="fmEyebrow">
                <i class="bi bi-tools me-1"></i>GENERAL SERVICES &bull; SUB-MODULE 3
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="fmSubmoduleHeading">
                Maintenance Personnel Assignment &amp; Workload
            </h1>
            <p class="text-muted small mb-0" id="fmSubmoduleSubtext">
                Technician roster, trade specializations, live workload distribution, and on-duty availability for job dispatching.
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
    <div id="moduleContent" data-module="personnel">
        
        <!-- Toolbar & Status Filter Chips -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div class="d-flex flex-wrap gap-2" id="personnelChips">
                <span class="badge bg-marsu-burgundy text-white px-3 py-2 border shadow-sm" style="cursor: pointer;">All Personnel (4)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">Available / On-Duty (3)</span>
                <span class="badge bg-light text-dark px-3 py-2 border shadow-sm" style="cursor: pointer;">In Field / Dispatched (1)</span>
            </div>
            <div class="fm-toolbar">
                <input type="search" id="techSearch" class="form-control form-control-sm" placeholder="Search name, specialization, unit...">
            </div>
        </div>

        <!-- Personnel Cards Grid (Simple & Clean Style) -->
        <div class="row g-3" id="personnelCards">
            
            <!-- Personnel Card 1 -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border p-3 h-100 position-relative bg-white" style="border-radius: 8px;">
                    <!-- Top Section: Avatar & Details -->
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 45px; height: 45px; border-radius: 8px; background-color: #7B1E2B; font-size: 1rem;">
                            DS
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Danilo B. Santos</h6>
                            <p class="small text-muted mb-1" style="line-height: 1.2;">Facilities Supervisor / General Maintenance</p>
                            <p class="small text-muted mb-0" style="font-size: 0.78rem;">General Services &amp; Facilities...</p>
                        </div>
                    </div>

                    <!-- Status & Workload Progress -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="badge bg-info text-dark px-2 py-1 fw-bold" style="font-size: 0.72rem;">On Assignment</span>
                            <span class="small fw-bold text-dark font-monospace" style="font-size: 0.8rem;">3/5 jobs</span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: #e9ecef; border-radius: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%; border-radius: 4px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Active Assignments -->
                    <div class="mb-3">
                        <div class="small fw-bold text-uppercase text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.05em;">Active Assignments</div>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-white font-monospace px-2 py-1" style="background-color: #17a2b8; font-size: 0.72rem;">MNT-8466</span>
                            <span class="badge text-white font-monospace px-2 py-1" style="background-color: #17a2b8; font-size: 0.72rem;">MNT-2363</span>
                            <span class="badge text-white font-monospace px-2 py-1" style="background-color: #17a2b8; font-size: 0.72rem;">MNT-001</span>
                        </div>
                    </div>

                    <!-- Contact & Verified Records -->
                    <div class="small text-muted mb-3 d-flex flex-column gap-1">
                        <div><i class="bi bi-telephone-fill text-secondary me-2"></i>0917-555-0142</div>
                        <div><i class="bi bi-envelope-fill text-secondary me-2"></i>dsantos@marsu.edu.ph</div>
                        <div><i class="bi bi-award-fill text-secondary me-2"></i>1 verified service record(s)</div>
                    </div>

                    <!-- Bottom Action Buttons -->
                    <div class="mt-auto pt-2 d-flex align-items-center gap-2">
                        <button class="btn btn-warning text-dark fw-bold shadow-sm flex-grow-1 py-2" style="background-color: #d4af37; border-color: #c5a028; border-radius: 6px; font-size: 0.85rem;" onclick="alert('Assigning Job to Danilo')">
                            <i class="bi bi-card-list me-1"></i>Assign Job
                        </button>
                        <button class="btn btn-outline-secondary py-2 px-3 bg-white" style="border-radius: 6px;" title="More options" onclick="alert('Viewing profile')">
                            <i class="bi bi-three-dots text-dark"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Personnel Card 2 -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border p-3 h-100 position-relative bg-white" style="border-radius: 8px;">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 45px; height: 45px; border-radius: 8px; background-color: #7B1E2B; font-size: 1rem;">
                            MS
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Engr. Mario Santos</h6>
                            <p class="small text-muted mb-1" style="line-height: 1.2;">Senior Aircon Technician &amp; HVAC Lead</p>
                            <p class="small text-muted mb-0" style="font-size: 0.78rem;">Facilities Management Unit...</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="badge bg-success text-white px-2 py-1 fw-bold" style="font-size: 0.72rem;">Available / On-Duty</span>
                            <span class="small fw-bold text-dark font-monospace" style="font-size: 0.8rem;">1/4 jobs</span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: #e9ecef; border-radius: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%; border-radius: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="small fw-bold text-uppercase text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.05em;">Active Assignments</div>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-white font-monospace px-2 py-1" style="background-color: #17a2b8; font-size: 0.72rem;">MNT-007</span>
                        </div>
                    </div>

                    <div class="small text-muted mb-3 d-flex flex-column gap-1">
                        <div><i class="bi bi-telephone-fill text-secondary me-2"></i>0918-444-9911</div>
                        <div><i class="bi bi-envelope-fill text-secondary me-2"></i>msantos@marsu.edu.ph</div>
                        <div><i class="bi bi-award-fill text-secondary me-2"></i>14 verified service record(s)</div>
                    </div>

                    <div class="mt-auto pt-2 d-flex align-items-center gap-2">
                        <button class="btn btn-warning text-dark fw-bold shadow-sm flex-grow-1 py-2" style="background-color: #d4af37; border-color: #c5a028; border-radius: 6px; font-size: 0.85rem;" onclick="alert('Assigning Job to Mario')">
                            <i class="bi bi-card-list me-1"></i>Assign Job
                        </button>
                        <button class="btn btn-outline-secondary py-2 px-3 bg-white" style="border-radius: 6px;" title="More options" onclick="alert('Viewing profile')">
                            <i class="bi bi-three-dots text-dark"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Personnel Card 3 -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border p-3 h-100 position-relative bg-white" style="border-radius: 8px;">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 45px; height: 45px; border-radius: 8px; background-color: #7B1E2B; font-size: 1rem;">
                            RG
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Engr. Roberto Gomez</h6>
                            <p class="small text-muted mb-1" style="line-height: 1.2;">Electrical Infrastructure Specialist</p>
                            <p class="small text-muted mb-0" style="font-size: 0.78rem;">General Services Unit...</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="badge bg-success text-white px-2 py-1 fw-bold" style="font-size: 0.72rem;">Available / On-Duty</span>
                            <span class="small fw-bold text-dark font-monospace" style="font-size: 0.8rem;">2/4 jobs</span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: #e9ecef; border-radius: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%; border-radius: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="small fw-bold text-uppercase text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.05em;">Active Assignments</div>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-white font-monospace px-2 py-1" style="background-color: #17a2b8; font-size: 0.72rem;">MNT-044</span>
                            <span class="badge text-white font-monospace px-2 py-1" style="background-color: #17a2b8; font-size: 0.72rem;">JO-GS-010</span>
                        </div>
                    </div>

                    <div class="small text-muted mb-3 d-flex flex-column gap-1">
                        <div><i class="bi bi-telephone-fill text-secondary me-2"></i>0919-222-3344</div>
                        <div><i class="bi bi-envelope-fill text-secondary me-2"></i>rgomez@marsu.edu.ph</div>
                        <div><i class="bi bi-award-fill text-secondary me-2"></i>9 verified service record(s)</div>
                    </div>

                    <div class="mt-auto pt-2 d-flex align-items-center gap-2">
                        <button class="btn btn-warning text-dark fw-bold shadow-sm flex-grow-1 py-2" style="background-color: #d4af37; border-color: #c5a028; border-radius: 6px; font-size: 0.85rem;" onclick="alert('Assigning Job to Roberto')">
                            <i class="bi bi-card-list me-1"></i>Assign Job
                        </button>
                        <button class="btn btn-outline-secondary py-2 px-3 bg-white" style="border-radius: 6px;" title="More options" onclick="alert('Viewing profile')">
                            <i class="bi bi-three-dots text-dark"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.module-content -->
</div>