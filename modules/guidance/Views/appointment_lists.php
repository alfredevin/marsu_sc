<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: APPOINTMENT REQUESTS           -->
<!--   Module: Guidance & Counseling Services                             -->
<!--   File: modules/guidance/Views/appointment_requests.php              -->
<!--   STANDARDIZED BOOTSTRAP 5 TABLE STRUCTURE / RESPONSIVE MASTER TABLE  -->
<!--   MASTERLIST OF APPOINTMENTS (CLEAR AND MINIMALIST)                  -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 15px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 500;">
                    Guidance &amp; Counseling Services
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Masterlist of Appointments
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Masterlist of Appointments
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Centralized appointment intake queue, schedule management, and consultation status tracking.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <button type="button"
                class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                onclick="window.print()"
                style="font-size: 15px; font-weight: 500; height: 38px; border-radius: 6px; padding: 0 16px; background-color: #fff; border: 1px solid #ced4da;">
                <i class="bi bi-printer me-2"></i>Print Registry
            </button>
            <button type="button"
                class="btn text-white shadow-none d-inline-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-request-appointment"
                style="background-color: #800020; border: 1px solid #800020; font-size: 15px; font-weight: 500; border-radius: 6px; height: 38px; padding: 0 16px;">
                <i class="bi bi-calendar-plus me-2"></i>Request Appointment
            </button>
        </div>
    </div>
</div>

<!-- 4 KPI SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL APPOINTMENTS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">8
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">All recorded appointment requests</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #d4a017 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PENDING &amp; APPROVED
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">2
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FEFCF0; color: #B7791F; border: 1px solid #F6E05E;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">Pending triage &amp; approved slots</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        CONFIRMED &amp; COMPLETED
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">2
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">Confirmed sessions &amp; completed</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #6c757d !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        OTHER OUTCOMES
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">4
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f8f9fa; color: #495057; border: 1px solid #e2e8f0;">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">Rescheduled, cancelled, rejected, no-show</div>
        </div>
    </div>
</div>

<!-- SEARCH & FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4"
    style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <!-- Search Field -->
            <div class="col-xl-8 col-lg-8 col-md-7 col-12">
                <label class="form-label small text-muted fw-semibold mb-1">Search Requests</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white"
                        style="border-color: #ced4da; font-size: 15px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="appointmentSearchInput" class="form-control border-start-0 shadow-none"
                        placeholder="Search by student ID, full name, or counselor..."
                        style="font-size: 14.5px; height: 40px; border-color: #ced4da;">
                </div>
            </div>

            <!-- Appointment Type Filter -->
            <div class="col-xl-4 col-lg-4 col-md-5 col-12">
                <label class="form-label small text-muted fw-semibold mb-1">Appointment Type</label>
                <select id="filterAppointmentType" class="form-select shadow-none" style="font-size: 14px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>All Appointment Types</option>
                    <option value="Walk-in">Walk-in</option>
                    <option value="Online Appointment">Online Appointment</option>
                </select>
            </div>
        </div>

        <!-- Footer Summary & Reset Button -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3 pt-2 border-top">
            <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 13.5px;">
                <span class="fw-semibold text-dark" id="toolbarSummaryCount">Showing 8 appointment records</span>
                <span class="badge bg-light text-dark border px-2.5 py-1.5"
                    style="font-size: 12.5px; font-weight: 500;">
                    Official Appointment Queue
                </span>
            </div>
            <button type="button" id="btnResetAppointmentFilters"
                class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                style="height: 32px; font-size: 13px; border-color: #ced4da; background-color: #fff; border-radius: 4px; padding: 0 12px;">
                <i class="bi bi-x-circle me-1.5"></i>Reset Filters
            </button>
        </div>
    </div>
</div>

<!-- STUDENT PROFILE DIRECTORY MASTER TABLE STYLE FOR MASTERLIST OF APPOINTMENTS -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
        style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="m-0 fw-bold" style="font-size: 16px; color: #800020;">
            <i class="bi bi-calendar-event me-2" style="color: #D4AF37;"></i>Masterlist of Appointments
        </h6>
        <span class="badge text-dark bg-light border px-2.5 py-1.5" style="font-size: 13.5px; font-weight: 500;" id="tableBadgeCount">
            Showing 8 Records &bull; Official Directory
        </span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="appointmentsMasterTable">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-4"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 120px; color: #2D3748; vertical-align: middle;">
                            Student ID
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 190px; color: #2D3748; vertical-align: middle;">
                            Full Name
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 130px; color: #2D3748; vertical-align: middle;">
                            Request Date
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 145px; color: #2D3748; vertical-align: middle;">
                            Appointment Date
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 130px; color: #2D3748; vertical-align: middle;">
                            Time Slot
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 185px; color: #2D3748; vertical-align: middle;">
                            Counselor
                        </th>
                        <th class="text-center"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 140px; color: #2D3748; vertical-align: middle;">
                            Appointment Type
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 200px; color: #2D3748; vertical-align: middle;">
                            Next Scheduled Action
                        </th>
                        <th class="text-center pe-4"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 210px; color: #2D3748; vertical-align: middle;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px;" id="appointmentsTableBody">
                    <!-- Record 1: RAMOS, CARLOS M. -->
                    <tr class="appointment-row" data-student-id="2022-00812" data-name="RAMOS, CARLOS M."
                        data-type="Walk-in" data-counselor="Prof. Mark Bautista, RPm">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2022-00812
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">RAMOS, CARLOS M.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-20</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-25</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">10:00 AM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Walk-in</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Counselor Slot &amp; Intake Review</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-1"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-1"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 2: SANTOS, MARIA C. -->
                    <tr class="appointment-row" data-student-id="2023-01042" data-name="SANTOS, MARIA C."
                        data-type="Online Appointment" data-counselor="Dr. Elena Santos, RGC">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2023-01042
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">SANTOS, MARIA C.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-21</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-26</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">01:30 PM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Dr. Elena Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #c7d2fe; background-color: #eef2ff; color: #3730a3; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;"><i class="bi bi-camera-video me-1"></i>Online</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Student Confirmation Notice</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-2"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-2"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 3: DELA CRUZ, JUAN L. -->
                    <tr class="appointment-row" data-student-id="2023-01089" data-name="DELA CRUZ, JUAN L."
                        data-type="Walk-in" data-counselor="Dr. Elena Santos, RGC">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2023-01089
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">DELA CRUZ, JUAN L.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-22</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-27</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">09:00 AM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Dr. Elena Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Walk-in</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Conduct Consultation Session</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-3"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-3"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 4: REYES, BEA ANGELA D. -->
                    <tr class="appointment-row" data-student-id="2024-00155" data-name="REYES, BEA ANGELA D."
                        data-type="Online Appointment" data-counselor="Ms. Clarisse Ramos">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2024-00155
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">REYES, BEA ANGELA D.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-18</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-22</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">11:00 AM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Ms. Clarisse Ramos
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #c7d2fe; background-color: #eef2ff; color: #3730a3; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;"><i class="bi bi-camera-video me-1"></i>Online</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Case Concluded / Filed in Registry</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-4"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-4"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 5: TAN, JOSHUA DAVID K. -->
                    <tr class="appointment-row" data-student-id="2021-00341" data-name="TAN, JOSHUA DAVID K."
                        data-type="Walk-in" data-counselor="Prof. Mark Bautista, RPm">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2021-00341
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">TAN, JOSHUA DAVID K.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-16</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-28</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">02:00 PM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Walk-in</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Attend Rescheduled Session</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-5"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-5"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 6: LIM, PATRICIA ANNE S. -->
                    <tr class="appointment-row" data-student-id="2023-00492" data-name="LIM, PATRICIA ANNE S."
                        data-type="Online Appointment" data-counselor="Dr. Elena Santos, RGC">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2023-00492
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">LIM, PATRICIA ANNE S.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-15</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-24</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">10:30 AM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Dr. Elena Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #c7d2fe; background-color: #eef2ff; color: #3730a3; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;"><i class="bi bi-camera-video me-1"></i>Online</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Follow-up with Student Welfare Office</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-6"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-6"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 7: GARCIA, MIGUEL R. -->
                    <tr class="appointment-row" data-student-id="2022-00419" data-name="GARCIA, MIGUEL R."
                        data-type="Walk-in" data-counselor="Prof. Mark Bautista, RPm">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2022-00419
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">GARCIA, MIGUEL R.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-14</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-16</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">08:30 AM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Walk-in</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Advised to Re-file for Weekday Office Hours</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-7"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-7"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Record 8: VILLANUEVA, CHLOE T. -->
                    <tr class="appointment-row" data-student-id="2024-00210" data-name="VILLANUEVA, CHLOE T."
                        data-type="Online Appointment" data-counselor="Ms. Clarisse Ramos">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2024-00210
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">VILLANUEVA, CHLOE T.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-semibold" style="font-size: 14px;">2026-10-12</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-bold" style="font-size: 14px;">2026-10-15</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">03:00 PM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            Ms. Clarisse Ramos
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #c7d2fe; background-color: #eef2ff; color: #3730a3; border-radius: 4px; width: 100px; min-width: 100px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;"><i class="bi bi-camera-video me-1"></i>Online</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-secondary fw-medium" style="font-size: 13.5px;">Send Reschedule Invitation Notice</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 210px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-apt-8"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-review-apt-8"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Review Appointment">
                                    <i class="bi bi-pencil-square me-1"></i>Review
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION CONTROLS -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-4 border-top"
            style="border-top: 1px solid #E2E8F0 !important; background-color: #ffffff;">
            <div class="text-muted" style="font-size: 13.5px;" id="tableFooterCount">
                Showing <strong class="text-dark">1</strong> to <strong class="text-dark">8</strong> of <strong
                    class="text-dark">8</strong> records &bull; Page 1 of 1
            </div>
            <nav aria-label="Appointment requests pagination">
                <ul class="pagination pagination-sm mb-0 gap-1" id="appointmentPaginationControls">
                    <li class="page-item disabled">
                        <button class="page-link shadow-none" aria-label="Previous">&laquo;</button>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <button class="page-link shadow-none"
                            style="background-color: #800020; border-color: #800020; color: #fff;">1</button>
                    </li>
                    <li class="page-item disabled">
                        <button class="page-link shadow-none" aria-label="Next">&raquo;</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   STATIC HTML DIV MODALS: VIEW APPOINTMENT (PURE DIVS, NO PHP LOOP)  -->
<!-- ==================================================================== -->

<!-- Modal View 1: Carlos Ramos -->
<div class="modal fade" id="modal-view-apt-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; RAMOS, CARLOS M.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">RAMOS, CARLOS M.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2022-00812</span>
                                    <span class="me-3"><strong>College:</strong> College of Education</span>
                                    <span><strong>Program:</strong> BEED (3rd Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Pending
                                </span>
                                <div class="text-muted small">Type: <strong>Walk-in</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-20 &bull; 02:15 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-25 &bull; 10:00 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Face-to-face (GCO Room 1)</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Prof. Mark Bautista, RPm</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Counselor Slot &amp; Intake Review</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Student scheduled career counseling appointment regarding teacher licensure readiness and
                            career alternative exploration.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Standard consultation room &bull; No special accommodations
                            needed.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-1"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 2: Maria Santos -->
<div class="modal fade" id="modal-view-apt-2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; SANTOS, MARIA C.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">SANTOS, MARIA C.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2023-01042</span>
                                    <span class="me-3"><strong>College:</strong> College of Arts and Sciences</span>
                                    <span><strong>Program:</strong> BaPOS (2nd Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #3182ce; background-color: #ebf8ff; color: #2b6cb0; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Approved
                                </span>
                                <div class="text-muted small">Type: <strong>Online Appointment</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-21 &bull; 10:00 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-26 &bull; 01:30 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Online Virtual Consultation</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Dr. Elena Santos, RGC</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Student Confirmation Notice</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Follow-up consultation regarding academic anxiety management and stress reduction
                            techniques.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Ground floor quiet room requested.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-2"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 3: Juan Dela Cruz -->
<div class="modal fade" id="modal-view-apt-3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; DELA CRUZ, JUAN L.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">DELA CRUZ, JUAN L.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2023-01089</span>
                                    <span class="me-3"><strong>College:</strong> College of Information and Computing
                                        Sciences</span>
                                    <span><strong>Program:</strong> BSIS (2nd Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Confirmed
                                </span>
                                <div class="text-muted small">Type: <strong>Walk-in</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-22 &bull; 08:30 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-27 &bull; 09:00 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Face-to-face (GCO Room 1)</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Dr. Elena Santos, RGC</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Conduct Consultation Session</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Student seeking assistance regarding major laboratory programming load and study habits
                            scheduling.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Standard consultation room.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-3"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 4: Bea Angela Reyes -->
<div class="modal fade" id="modal-view-apt-4" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; REYES, BEA ANGELA D.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">REYES, BEA ANGELA D.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2024-00155</span>
                                    <span class="me-3"><strong>College:</strong> College of Business and
                                        Accountancy</span>
                                    <span><strong>Program:</strong> BSTM (1st Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #4a5568; background-color: #edf2f7; color: #2d3748; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Completed
                                </span>
                                <div class="text-muted small">Type: <strong>Online Appointment</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-18 &bull; 09:00 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-22 &bull; 11:00 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Online Virtual Consultation</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Ms. Clarisse Ramos</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Case Concluded / Filed in Registry</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Freshman orientation adjustment follow-up regarding homesickness and peer networking
                            support.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Standard room.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-4"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 5: Joshua David Tan -->
<div class="modal fade" id="modal-view-apt-5" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; TAN, JOSHUA DAVID K.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">TAN, JOSHUA DAVID K.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2021-00341</span>
                                    <span class="me-3"><strong>College:</strong> College of Engineering</span>
                                    <span><strong>Program:</strong> BSCE (4th Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #6c757d; background-color: #f8f9fa; color: #495057; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Rescheduled
                                </span>
                                <div class="text-muted small">Type: <strong>Walk-in</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-16 &bull; 01:30 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-28 &bull; 02:00 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Face-to-face (GCO Room 1)</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Prof. Mark Bautista, RPm</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Attend Rescheduled Session</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Attendance recovery discussion following dean referral for missed capstone lecture hours.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Standard consultation room.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-5"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 6: Patricia Anne Lim -->
<div class="modal fade" id="modal-view-apt-6" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; LIM, PATRICIA ANNE S.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">LIM, PATRICIA ANNE S.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2023-00492</span>
                                    <span class="me-3"><strong>College:</strong> College of Agriculture</span>
                                    <span><strong>Program:</strong> BSA (2nd Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #e53e3e; background-color: #fff5f5; color: #c53030; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Cancelled
                                </span>
                                <div class="text-muted small">Type: <strong>Online Appointment</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-15 &bull; 11:30 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-24 &bull; 10:30 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Online Google Meet</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Dr. Elena Santos, RGC</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Follow-up with Student Welfare Office</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Student requested emergency transportation subsidy and campus food program coordination.
                            Handled directly via MarSU Scholarship Office.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Virtual session via Google Meet.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-6"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 7: Miguel Garcia -->
<div class="modal fade" id="modal-view-apt-7" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; GARCIA, MIGUEL R.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">GARCIA, MIGUEL R.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2022-00419</span>
                                    <span class="me-3"><strong>College:</strong> College of Engineering</span>
                                    <span><strong>Program:</strong> BSCE (3rd Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #dc3545; background-color: #fdf2f2; color: #721c24; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Rejected
                                </span>
                                <div class="text-muted small">Type: <strong>Walk-in</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-14 &bull; 04:45 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-16 &bull; 08:30 AM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Face-to-face (GCO Room 1)</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Prof. Mark Bautista, RPm</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Advised to Re-file for Weekday Office Hours</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Requested consultation regarding academic overload waiver signature. Requested slot fell on
                            an institutional academic holiday.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Standard consultation room.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-7"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 8: Chloe Villanueva -->
<div class="modal fade" id="modal-view-apt-8" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar2-check-fill text-warning fs-5"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            Appointment Record &bull; VILLANUEVA, CHLOE T.
                        </h5>
                        <span class="text-white-50" style="font-size: 13px;">Guidance Consultation Details</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">VILLANUEVA, CHLOE T.</h4>
                                <div class="text-muted" style="font-size: 13.5px;">
                                    <span class="me-3"><strong>Student ID:</strong> 2024-00210</span>
                                    <span class="me-3"><strong>College:</strong> College of Arts and Sciences</span>
                                    <span><strong>Program:</strong> BaPOS (1st Year)</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge mb-1"
                                    style="border: 1.5px solid #4a5568; background-color: #f7fafc; color: #1a202c; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    No-Show
                                </span>
                                <div class="text-muted small">Type: <strong>Online Appointment</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Appointment Parameters &amp;
                            Scheduling</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-2">
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Request Date &amp; Time</span>
                                <strong class="text-dark">2026-10-12 &bull; 01:15 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Appointment Date &amp; Time</span>
                                <strong class="text-dark">2026-10-15 &bull; 03:00 PM</strong>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-muted d-block small">Consultation Mode</span>
                                <strong class="text-dark">Online Virtual Consultation</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Assigned Counselor</span>
                                <strong class="text-dark">Ms. Clarisse Ramos</strong>
                            </div>
                            <div class="col-sm-6 col-12 pt-2 border-top">
                                <span class="text-muted d-block small">Next Scheduled Action</span>
                                <strong class="text-dark">Send Reschedule Invitation Notice</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-3"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill" style="color: #800020;"></i>
                        <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Reason for Consultation</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <p class="text-dark mb-2" style="line-height: 1.6;">
                            Requested consultation on student club participation and peer adaptation. Marked as No-Show
                            after 30-minute grace period without notice.
                        </p>
                        <div class="text-muted small">
                            <strong>Accommodations:</strong> Standard room.
                        </div>
                    </div>
                </div>

                <div class="card border shadow-sm mb-0"
                    style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-body p-3" style="font-size: 13px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-shield-lock-fill text-danger"></i>
                            <span class="fw-bold text-dark">Republic Act No. 10173 &amp; RA 9258 Statutory
                                Confidentiality</span>
                        </div>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                            All consultation records, intake statements, and appointment parameters are protected under
                            the Data Privacy Act of 2012. Unauthorized access, alteration, or disclosure is strictly
                            punishable by law.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal"
                    style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                    Close
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="window.print()"
                        style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                        <i class="bi bi-printer me-1.5"></i>Print Slip
                    </button>
                    <button type="button"
                        class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#modal-review-apt-8"
                        style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-pencil-square me-1.5"></i>Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   STATIC HTML DIV MODALS: REVIEW & STATUS (PURE DIVS, NO PHP LOOP)   -->
<!-- ==================================================================== -->

<!-- Review Modal 1: Carlos Ramos -->
<div class="modal fade" id="modal-review-apt-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; RAMOS, CARLOS M.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>RAMOS, CARLOS M.</strong> (2022-00812)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Pending
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending" selected>Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Prof. Mark Bautista, RPm" selected>Prof. Mark Bautista, RPm (Psychometrician)
                            </option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC (Head Counselor)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-25"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="10:00 AM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none" value="Counselor Slot &amp; Intake Review"
                            style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Student scheduled career counseling appointment regarding teacher licensure readiness and career alternative exploration.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 2: Maria Santos -->
<div class="modal fade" id="modal-review-apt-2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; SANTOS, MARIA C.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>SANTOS, MARIA C.</strong> (2023-01042)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #3182ce; background-color: #ebf8ff; color: #2b6cb0; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Approved
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved" selected>Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC (Head Counselor)
                            </option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm (Psychometrician)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-26"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="01:30 PM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none" value="Student Confirmation Notice"
                            style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Follow-up consultation regarding academic anxiety management and stress reduction techniques.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 3: Juan Dela Cruz -->
<div class="modal fade" id="modal-review-apt-3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; DELA CRUZ, JUAN L.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>DELA CRUZ, JUAN L.</strong> (2023-01089)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Confirmed
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed" selected>Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC (Head Counselor)
                            </option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm (Psychometrician)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-27"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="09:00 AM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none" value="Conduct Consultation Session"
                            style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Student seeking assistance regarding major laboratory programming load and study habits scheduling.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 4: Bea Angela Reyes -->
<div class="modal fade" id="modal-review-apt-4" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; REYES, BEA ANGELA D.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>REYES, BEA ANGELA D.</strong> (2024-00155)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #4a5568; background-color: #edf2f7; color: #2d3748; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Completed
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed" selected>Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Ms. Clarisse Ramos" selected>Ms. Clarisse Ramos (Academic Counselor)</option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC (Head Counselor)</option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm (Psychometrician)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-22"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="11:00 AM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none" value="Case Concluded / Filed in Registry"
                            style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Freshman orientation adjustment follow-up regarding homesickness and peer networking support. Session concluded successfully.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 5: Joshua David Tan -->
<div class="modal fade" id="modal-review-apt-5" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; TAN, JOSHUA DAVID K.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>TAN, JOSHUA DAVID K.</strong> (2021-00341)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #6c757d; background-color: #f8f9fa; color: #495057; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Rescheduled
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled" selected>Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Prof. Mark Bautista, RPm" selected>Prof. Mark Bautista, RPm (Psychometrician)
                            </option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC (Head Counselor)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-28"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="02:00 PM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none" value="Attend Rescheduled Session"
                            style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Rescheduled on Oct 19, 2026 to Oct 28, 2026 (02:00 PM) due to conflict with student laboratory exam.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 6: Patricia Anne Lim -->
<div class="modal fade" id="modal-review-apt-6" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; LIM, PATRICIA ANNE S.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>LIM, PATRICIA ANNE S.</strong> (2023-00492)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #e53e3e; background-color: #fff5f5; color: #c53030; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Cancelled
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled" selected>Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC (Head Counselor)
                            </option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm (Psychometrician)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-24"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="10:30 AM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none"
                            value="Follow-up with Student Welfare Office" style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Cancelled: Emergency assistance request was expedited directly through the MarSU Scholarship Office.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 7: Miguel Garcia -->
<div class="modal fade" id="modal-review-apt-7" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; GARCIA, MIGUEL R.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>GARCIA, MIGUEL R.</strong> (2022-00419)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #dc3545; background-color: #fdf2f2; color: #721c24; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                Rejected
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected" selected>Rejected</option>
                            <option value="No-Show">No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Prof. Mark Bautista, RPm" selected>Prof. Mark Bautista, RPm (Psychometrician)
                            </option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC (Head Counselor)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-16"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="08:30 AM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none"
                            value="Advised to Re-file for Weekday Office Hours" style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Rejected: Requested date falls on a declared institutional academic holiday. Advised to re-file for normal office hours.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal 8: Chloe Villanueva -->
<div class="modal fade" id="modal-review-apt-8" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Review Appointment &bull; VILLANUEVA, CHLOE T.
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Processing request for <strong>VILLANUEVA, CHLOE T.</strong> (2024-00210)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Current Status</label>
                        <div>
                            <span class="badge"
                                style="border: 1.5px solid #4a5568; background-color: #f7fafc; color: #1a202c; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">
                                No-Show
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Select New Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="No-Show" selected>No-Show</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="Ms. Clarisse Ramos" selected>Ms. Clarisse Ramos (Academic Counselor)</option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC (Head Counselor)</option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm (Psychometrician)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-10-15"
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold small mb-1">Appointment Time</label>
                            <input type="text" class="form-control shadow-none" value="03:00 PM"
                                style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Next Scheduled Action</label>
                        <input type="text" class="form-control shadow-none" value="Send Reschedule Invitation Notice"
                            style="font-size: 13px;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Counselor Remarks / Decision Notes
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="Enter intake decision remarks, room assignment, or reasons for status change..."
                            style="font-size: 13px; border-color: #ced4da;">Student did not attend scheduled consultation slot; reschedule invitation queued.</textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Save Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   QUICK REQUEST APPOINTMENT MODAL (PURE DIV, NO SCRIPT/STYLE)        -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-request-appointment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-bold">
                    <i class="bi bi-calendar-plus me-2"></i>Quick File Guidance Appointment
                </h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="font-size: 14.5px;">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Student Selector <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required style="font-size: 13.5px;">
                            <option value="2022-00812" selected>RAMOS, CARLOS M. (2022-00812 - BEED)</option>
                            <option value="2023-01042">SANTOS, MARIA C. (2023-01042 - BaPOS)</option>
                            <option value="2023-01089">DELA CRUZ, JUAN L. (2023-01089 - BSIS)</option>
                            <option value="2024-00155">REYES, BEA ANGELA D. (2024-00155 - BSTM)</option>
                            <option value="2021-00341">TAN, JOSHUA DAVID K. (2021-00341 - BSCE)</option>
                            <option value="2023-00492">LIM, PATRICIA ANNE S. (2023-00492 - BSA)</option>
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Preferred Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" value="2026-11-04" required
                                style="font-size: 13px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Time Slot <span
                                    class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 13px;">
                                <option value="08:30 AM - 09:30 AM">08:30 AM - 09:30 AM</option>
                                <option value="10:00 AM - 11:00 AM" selected>10:00 AM - 11:00 AM</option>
                                <option value="01:30 PM - 02:30 PM">01:30 PM - 02:30 PM</option>
                                <option value="03:00 PM - 04:00 PM">03:00 PM - 04:00 PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Appointment Type <span
                                class="text-danger">*</span></label>
                        <select class="form-select shadow-none" required style="font-size: 13.5px;">
                            <option value="Walk-in" selected>Walk-in (Guidance Office Consultation Room)</option>
                            <option value="Online Appointment">Online Appointment (Secure Virtual Session)</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted mb-1">Reason for Consultation <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required style="font-size: 13px;"
                            placeholder="State purpose for consultation..."></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Cancel
                    </button>
                    <button type="submit"
                        class="btn text-white shadow-none d-inline-flex align-items-center justify-content-center"
                        data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px; min-width: 140px; font-size: 13px; font-weight: 500; border-radius: 4px;">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CLIENT-SIDE APPOINTMENT SEARCH & FILTER SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('appointmentSearchInput');
        var typeFilter = document.getElementById('filterAppointmentType');
        var resetBtn = document.getElementById('btnResetAppointmentFilters');
        var rows = document.querySelectorAll('#appointmentsTableBody .appointment-row');
        var badgeCount = document.getElementById('tableBadgeCount');
        var summaryCount = document.getElementById('toolbarSummaryCount');
        var footerCount = document.getElementById('tableFooterCount');

        function filterAppointments() {
            var query = searchInput ? searchInput.value.trim().toLowerCase() : '';
            var selectedType = typeFilter ? typeFilter.value.trim() : '';
            var matchCount = 0;

            rows.forEach(function (row) {
                var studentId = (row.getAttribute('data-student-id') || '').toLowerCase();
                var name = (row.getAttribute('data-name') || '').toLowerCase();
                var counselor = (row.getAttribute('data-counselor') || '').toLowerCase();
                var type = row.getAttribute('data-type') || '';

                var matchesText = !query || studentId.indexOf(query) !== -1 || name.indexOf(query) !== -1 || counselor.indexOf(query) !== -1;
                var matchesType = !selectedType || type === selectedType;

                if (matchesText && matchesType) {
                    row.style.display = '';
                    matchCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (badgeCount) {
                badgeCount.innerHTML = 'Showing ' + matchCount + ' Records &bull; Official Directory';
            }
            if (summaryCount) {
                summaryCount.textContent = 'Showing ' + matchCount + ' appointment records';
            }
            if (footerCount) {
                footerCount.innerHTML = 'Showing <strong class="text-dark">' + (matchCount > 0 ? 1 : 0) + '</strong> to <strong class="text-dark">' + matchCount + '</strong> of <strong class="text-dark">' + matchCount + '</strong> records &bull; Page 1 of 1';
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterAppointments);
        }
        if (typeFilter) {
            typeFilter.addEventListener('change', filterAppointments);
        }
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (typeFilter) typeFilter.value = '';
                filterAppointments();
            });
        }
    });
</script>