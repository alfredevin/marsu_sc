<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: APPOINTMENT STATUS MONITORING        -->
<!--   FILE LOCATION: views/guidance/appointment_status.php               -->
<!--   NO CUSTOM JAVASCRIPT / PURE BOOTSTRAP 5 DATA-ATTRIBUTES (ENGLISH)  -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 13.5px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="#" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="#" style="color: #800020; text-decoration: none; font-weight: 500;">
                    Guidance & Counseling Services
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Appointment Status
            </li>
        </ol>
    </nav>

    <div class="pt-1">
        <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 20px; letter-spacing: -0.2px;">
            Student Appointment Status Tracker
        </h4>
        <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.5;">
            Track appointment progress, verify assigned counselor schedules, and review confirmation slips in real-time.
        </p>
    </div>
</div>

<!-- 4 KPI SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL APPOINTMENTS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">4
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-calendar3"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">All filed appointment records</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D4A017 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PENDING INTAKE
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FEFCF0; color: #B7791F; border: 1px solid #F6E05E;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Awaiting slot review</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #2e7d32 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        CONFIRMED & SCHEDULED
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">2
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Ready on calendar</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #718096 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        CONCLUDED / PAST
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #f8f9fa; color: #4A5568; border: 1px solid #EBE4E4;">
                    <i class="bi bi-archive-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Finished consultations</div>
        </div>
    </div>
</div>

<!-- APPOINTMENT STATUS MONITORING TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #EBE4E4 !important; border-radius: 10px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #EBE4E4;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-clock-history me-2" style="color: #D4A017;"></i>Student Appointment Status Records
        </h6>

        <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="input-group input-group-sm" style="width: 240px;">
                <span class="input-group-text border-end-0 text-muted"
                    style="background-color: #ffffff; border-color: #ced4da; font-size: 13.5px;">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 shadow-none" placeholder="Search name or ID..."
                    style="font-size: 13.5px; height: 38px; border-color: #ced4da;">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 130px; color: #2D3748;">
                            Appointment ID</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 170px; color: #2D3748;">
                            Student Name</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 90px; color: #2D3748;">
                            Program</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 155px; color: #2D3748;">
                            Session Schedule</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 150px; color: #2D3748;">
                            Assigned Counselor</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 120px; color: #2D3748;">
                            Status</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 100px; color: #2D3748;">
                            Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13.5px;">
                    <!-- Row 1: Pending -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-001
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">DELA CRUZ, JUAN L.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIS</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">
                            <span class="text-danger small"><i class="bi bi-clock me-1"></i>Awaiting Slot</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">For Assignment</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Pending</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-apt-001"
                                style="width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                Track
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2: Confirmed -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-002
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">SANTOS, MARIA C.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIT</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Oct 21, 2026</strong><br>
                            <span class="text-muted small">02:00 PM - 03:00 PM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">Dr. Elena Santos, RGC</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Confirmed</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-apt-002"
                                style="width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                Track
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3: Confirmed -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-004
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Oct 23, 2026</strong><br>
                            <span class="text-muted small">01:00 PM - 02:00 PM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">Prof. Mark Bautista, RPm</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Confirmed</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-apt-004"
                                style="width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                Track
                            </button>
                        </td>
                    </tr>

                    <!-- Row 4: Concluded -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-003
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">
                            Oct 16, 2026<br>
                            <span class="small">10:00 AM - 11:00 AM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Ms. Clarisse Ramos</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #718096; color: #4A5568; background-color: #f8f9fa; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Concluded</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-apt-003"
                                style="width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                Track
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: TRACK MODALS (Appointment Status)                          -->
<!-- ==================================================================== -->

<!-- MODAL 1: APT-2026-001 (PENDING) -->
<div class="modal fade" id="modal-apt-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Appointment Progress & Schedule
                        Verification</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 50px; height: 50px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1" style="color: #800020; font-size: 18.5px;">DELA CRUZ, JUAN L.
                                </h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Appointment ID:</strong> <span
                                            class="text-dark fw-semibold">APT-2026-001</span></span>
                                    <span><strong>Program:</strong> BSIS</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge"
                                style="border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12.5px;">
                                Pending Review
                            </span>
                        </div>
                    </div>
                </div>

                <!-- APPOINTMENT STATUS TIMELINE -->
                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                        <i class="bi bi-diagram-3-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Appointment
                            Status</span>
                    </div>
                    <div class="d-flex justify-content-between text-center position-relative pt-2 pb-2">
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Filing Received</strong>
                            <span class="text-muted small" style="font-size: 11px;">Intake Submitted</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: #e2e8f0; color: #718096; font-size: 14px;">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Slot Scheduling</strong>
                            <span class="text-muted small" style="font-size: 11px;">Awaiting Review</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: #e2e8f0; color: #718096; font-size: 14px;">
                                <i class="bi bi-flag-fill"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Consultation Done</strong>
                            <span class="text-muted small" style="font-size: 11px;">Not Started</span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-info-circle-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Assigned Guidance
                            Slot Information</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Session Date:</span>
                            <span class="text-danger fw-semibold"><i class="bi bi-clock me-1"></i>Pending
                                Assignment</span>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Time:</span>
                            <span class="text-muted">Not scheduled yet</span>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Counselor:</span>
                            <span class="text-muted">Pending Counselor Assignment</span>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Consultation Venue / Room:</span>
                            <strong class="text-dark">Guidance Counseling Office</strong>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Counseling Concern:</span>
                            <span class="text-dark fw-medium">Academic / Performance Concerns</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Slip
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Close</button>
                    <!-- TRIGGERS CALENDAR INFO PREVIEW MODAL -->
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#cal-view-apt-001"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        <i class="bi bi-calendar3 me-1"></i>View in Calendar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: APT-2026-002 (CONFIRMED) -->
<div class="modal fade" id="modal-apt-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Appointment Progress & Schedule
                        Verification</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 50px; height: 50px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1" style="color: #800020; font-size: 18.5px;">SANTOS, MARIA C.
                                </h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Appointment ID:</strong> <span
                                            class="text-dark fw-semibold">APT-2026-002</span></span>
                                    <span><strong>Program:</strong> BSIT</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge"
                                style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12.5px;">
                                Confirmed Session
                            </span>
                        </div>
                    </div>
                </div>

                <!-- APPOINTMENT STATUS TIMELINE -->
                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                        <i class="bi bi-diagram-3-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Appointment
                            Status</span>
                    </div>
                    <div class="d-flex justify-content-between text-center position-relative pt-2 pb-2">
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Filing Received</strong>
                            <span class="text-muted small" style="font-size: 11px;">Intake Submitted</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Slot Scheduled</strong>
                            <span class="text-muted small" style="font-size: 11px;">Synced to Calendar</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: #e2e8f0; color: #718096; font-size: 14px;">
                                <i class="bi bi-flag-fill"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Consultation Done</strong>
                            <span class="text-muted small" style="font-size: 11px;">Upcoming Session</span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-info-circle-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Assigned Guidance
                            Slot Information</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Session Date:</span>
                            <strong class="text-dark">October 21, 2026</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Time:</span>
                            <strong class="text-dark">02:00 PM - 03:00 PM</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Counselor:</span>
                            <strong class="text-dark">Dr. Elena Santos, RGC</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Consultation Venue / Room:</span>
                            <strong class="text-dark">Guidance Counseling Room 1</strong>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Counseling Concern:</span>
                            <span class="text-dark fw-medium">Stress Management</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Slip
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Close</button>
                    <!-- TRIGGERS CALENDAR INFO PREVIEW MODAL -->
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#cal-view-apt-002"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        <i class="bi bi-calendar3 me-1"></i>View in Calendar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 3: APT-2026-004 (CONFIRMED) -->
<div class="modal fade" id="modal-apt-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Appointment Progress & Schedule
                        Verification</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 50px; height: 50px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1" style="color: #800020; font-size: 18.5px;">RAMOS, CARLOS M.
                                </h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Appointment ID:</strong> <span
                                            class="text-dark fw-semibold">APT-2026-004</span></span>
                                    <span><strong>Program:</strong> BSTM</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge"
                                style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12.5px;">
                                Confirmed Session
                            </span>
                        </div>
                    </div>
                </div>

                <!-- APPOINTMENT STATUS TIMELINE -->
                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                        <i class="bi bi-diagram-3-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Appointment
                            Status</span>
                    </div>
                    <div class="d-flex justify-content-between text-center position-relative pt-2 pb-2">
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Filing Received</strong>
                            <span class="text-muted small" style="font-size: 11px;">Intake Submitted</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Slot Scheduled</strong>
                            <span class="text-muted small" style="font-size: 11px;">Synced to Calendar</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: #e2e8f0; color: #718096; font-size: 14px;">
                                <i class="bi bi-flag-fill"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Consultation Done</strong>
                            <span class="text-muted small" style="font-size: 11px;">Upcoming Session</span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-info-circle-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Assigned Guidance
                            Slot Information</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Session Date:</span>
                            <strong class="text-dark">October 23, 2026</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Time:</span>
                            <strong class="text-dark">01:00 PM - 02:00 PM</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Counselor:</span>
                            <strong class="text-dark">Prof. Mark Bautista, RPm</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Consultation Venue / Room:</span>
                            <strong class="text-dark">Peer Facilitation Room</strong>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Counseling Concern:</span>
                            <span class="text-dark fw-medium">Career Exploration</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Slip
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Close</button>
                    <!-- TRIGGERS CALENDAR INFO PREVIEW MODAL -->
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#cal-view-apt-004"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        <i class="bi bi-calendar3 me-1"></i>View in Calendar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 4: APT-2026-003 (CONCLUDED) -->
<div class="modal fade" id="modal-apt-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Appointment Progress & Schedule
                        Verification</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 50px; height: 50px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1" style="color: #800020; font-size: 18.5px;">RAMOS, CARLOS M.
                                </h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Appointment ID:</strong> <span
                                            class="text-dark fw-semibold">APT-2026-003</span></span>
                                    <span><strong>Program:</strong> BSTM</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge"
                                style="border: 1px solid #718096; color: #4A5568; background-color: #f8f9fa; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12.5px;">
                                Concluded Consultation
                            </span>
                        </div>
                    </div>
                </div>

                <!-- APPOINTMENT STATUS TIMELINE -->
                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                        <i class="bi bi-diagram-3-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Appointment
                            Status</span>
                    </div>
                    <div class="d-flex justify-content-between text-center position-relative pt-2 pb-2">
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Filing Received</strong>
                            <span class="text-muted small" style="font-size: 11px;">Intake Submitted</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #800020; font-size: 14px;">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Slot Scheduled</strong>
                            <span class="text-muted small" style="font-size: 11px;">Completed Slot</span>
                        </div>
                        <div style="width: 32%; z-index: 2;">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white"
                                style="width: 36px; height: 36px; background-color: #2e7d32; font-size: 14px;">
                                <i class="bi bi-flag-fill"></i>
                            </div>
                            <strong class="d-block mt-2 text-dark" style="font-size: 12.5px;">Consultation Done</strong>
                            <span class="text-muted small" style="font-size: 11px;">Session Finished</span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-info-circle-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Assigned Guidance
                            Slot Information</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Session Date:</span>
                            <strong class="text-dark">October 16, 2026</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Time:</span>
                            <strong class="text-dark">10:00 AM - 11:00 AM</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Counselor:</span>
                            <strong class="text-dark">Ms. Clarisse Ramos</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Consultation Venue / Room:</span>
                            <strong class="text-dark">Guidance Counseling Room 2</strong>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Counseling Concern:</span>
                            <span class="text-dark fw-medium">Course or program selection</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Slip
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Close</button>
                    <!-- TRIGGERS CALENDAR INFO PREVIEW MODAL -->
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#cal-view-apt-003"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        <i class="bi bi-calendar3 me-1"></i>View in Calendar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   CALENDAR VIEW INFO MODALS (ALL ENGLISH PREVIEW)                    -->
<!-- ==================================================================== -->

<!-- CALENDAR MODAL 1: PENDING -->
<div class="modal fade" id="cal-view-apt-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-2.5 px-3 text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-event text-warning fs-5"></i>
                    <h6 class="modal-title fw-bold m-0" style="font-size: 15px;">Session Calendar Entry</h6>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%; background-color: #fefcbf; color: #b7791f; font-size: 24px;">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">No Active Calendar Slot Yet</h6>
                <p class="text-muted small mb-3">This appointment is currently under intake review and has not yet been
                    scheduled on the Session Calendar.</p>

                <div class="text-start bg-light p-3 rounded mb-2 border" style="font-size: 13px;">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Appointment Ref:</span>
                        <strong class="text-dark">APT-2026-001</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Student:</span>
                        <span class="fw-semibold">DELA CRUZ, JUAN L.</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-warning text-dark">Awaiting Counselor Slot</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#modal-apt-001">
                    <i class="bi bi-arrow-left me-1"></i>Back to Tracker
                </button>
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- CALENDAR MODAL 2: APT-2026-002 -->
<div class="modal fade" id="cal-view-apt-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-2.5 px-3 text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-check text-warning fs-5"></i>
                    <h6 class="modal-title fw-bold m-0" style="font-size: 15px;">Session Calendar Entry</h6>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="p-3 mb-3 text-white rounded d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #800020 0%, #a01a35 100%);">
                    <div>
                        <span class="badge bg-white text-dark small mb-1 fw-bold">Active Schedule</span>
                        <h5 class="fw-bold mb-0">October 21, 2026</h5>
                        <small class="opacity-75"><i class="bi bi-clock me-1"></i>02:00 PM - 03:00 PM</small>
                    </div>
                    <i class="bi bi-calendar3 display-6 opacity-50"></i>
                </div>

                <div class="border rounded p-3 bg-white" style="font-size: 13.5px;">
                    <div class="row g-2">
                        <div class="col-6">
                            <span class="text-muted d-block small">Student Name:</span>
                            <strong class="text-dark">SANTOS, MARIA C.</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block small">Program:</span>
                            <span class="badge bg-light text-dark border">BSIT</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Assigned Counselor:</span>
                            <strong class="text-dark"><i class="bi bi-person-badge me-1 text-primary"></i>Dr. Elena
                                Santos, RGC</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block small">Venue / Room:</span>
                            <span class="text-dark fw-medium"><i
                                    class="bi bi-geo-alt-fill me-1 text-danger"></i>Guidance Counseling Room 1</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Concern:</span>
                            <span class="text-dark">Stress Management</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#modal-apt-002">
                    <i class="bi bi-arrow-left me-1"></i>Back to Tracker
                </button>
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- CALENDAR MODAL 3: APT-2026-004 -->
<div class="modal fade" id="cal-view-apt-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-2.5 px-3 text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-check text-warning fs-5"></i>
                    <h6 class="modal-title fw-bold m-0" style="font-size: 15px;">Session Calendar Entry</h6>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="p-3 mb-3 text-white rounded d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #800020 0%, #a01a35 100%);">
                    <div>
                        <span class="badge bg-white text-dark small mb-1 fw-bold">Active Schedule</span>
                        <h5 class="fw-bold mb-0">October 23, 2026</h5>
                        <small class="opacity-75"><i class="bi bi-clock me-1"></i>01:00 PM - 02:00 PM</small>
                    </div>
                    <i class="bi bi-calendar3 display-6 opacity-50"></i>
                </div>

                <div class="border rounded p-3 bg-white" style="font-size: 13.5px;">
                    <div class="row g-2">
                        <div class="col-6">
                            <span class="text-muted d-block small">Student Name:</span>
                            <strong class="text-dark">RAMOS, CARLOS M.</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block small">Program:</span>
                            <span class="badge bg-light text-dark border">BSTM</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Assigned Counselor:</span>
                            <strong class="text-dark"><i class="bi bi-person-badge me-1 text-primary"></i>Prof. Mark
                                Bautista, RPm</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block small">Venue / Room:</span>
                            <span class="text-dark fw-medium"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>Peer
                                Facilitation Room</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Concern:</span>
                            <span class="text-dark">Career Exploration</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#modal-apt-004">
                    <i class="bi bi-arrow-left me-1"></i>Back to Tracker
                </button>
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- CALENDAR MODAL 4: APT-2026-003 -->
<div class="modal fade" id="cal-view-apt-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-2.5 px-3 text-white" style="background-color: #4A5568;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-check-fill text-warning fs-5"></i>
                    <h6 class="modal-title fw-bold m-0" style="font-size: 15px;">Concluded Calendar Slot</h6>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="p-3 mb-3 bg-secondary text-white rounded d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge bg-dark text-white small mb-1 fw-bold">Past Session</span>
                        <h5 class="fw-bold mb-0">October 16, 2026</h5>
                        <small class="opacity-75"><i class="bi bi-clock me-1"></i>10:00 AM - 11:00 AM</small>
                    </div>
                    <i class="bi bi-calendar3-check display-6 opacity-50"></i>
                </div>

                <div class="border rounded p-3 bg-white" style="font-size: 13.5px;">
                    <div class="row g-2">
                        <div class="col-6">
                            <span class="text-muted d-block small">Student Name:</span>
                            <strong class="text-dark">RAMOS, CARLOS M.</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block small">Program:</span>
                            <span class="badge bg-light text-dark border">BSTM</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Assigned Counselor:</span>
                            <strong class="text-dark"><i class="bi bi-person-badge me-1 text-primary"></i>Ms. Clarisse
                                Ramos</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block small">Venue / Room:</span>
                            <span class="text-dark fw-medium"><i
                                    class="bi bi-geo-alt-fill me-1 text-danger"></i>Guidance Counseling Room 2</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Counseling Concern:</span>
                            <span class="text-dark">Course or program selection</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#modal-apt-003">
                    <i class="bi bi-arrow-left me-1"></i>Back to Tracker
                </button>
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>