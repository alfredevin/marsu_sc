<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: SESSION CALENDAR                     -->
<!--   FRONT-END TEMPLATE SHELL (DYNAMIC REALISTIC CALENDAR GRID)         -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <!-- Breadcrumb Trail -->
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
                Session Calendar
            </li>
        </ol>
    </nav>

    <!-- Page Title & Subtitle -->
    <div class="pt-1">
        <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 20px; letter-spacing: -0.2px;">
            Counseling Sessions & Appointment Calendar
        </h4>
        <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.5;">
            View scheduled counseling sessions, monitor daily counselor appointments, and review past completed guidance
            history.
        </p>
    </div>
</div>

<!-- 4 KPI CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TODAY'S SESSIONS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">2
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-calendar-event"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Scheduled for today</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D4A017 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        THIS WEEK
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">8
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FEFCF0; color: #B7791F; border: 1px solid #F6E05E;">
                    <i class="bi bi-calendar-week"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Upcoming this week</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PENDING CONFIRMATION
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">3
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Awaiting slot review</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PAST / COMPLETED SESSIONS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">14
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Concluded guidance sessions</div>
        </div>
    </div>
</div>

<!-- CALENDAR & SIDE AGENDA CONTAINER -->
<div class="row g-3 mb-4">
    <!-- MAIN CALENDAR CARD -->
    <div class="col-xl-8 col-lg-8 col-12">
        <div class="card shadow-sm border-0 h-100" style="border: 1px solid #EBE4E4 !important; border-radius: 10px;">
            <!-- CALENDAR HEADER TOOLBAR -->
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-3 px-md-4"
                style="border-bottom: 1px solid #EBE4E4;">
                <div class="d-flex align-items-center gap-2">
                    <h6 class="m-0 fw-bold" style="font-size: 16px; color: #800020;">
                        <i class="bi bi-calendar3 me-2" style="color: #D4A017;"></i>
                        <span id="calendarHeaderMonth">October</span> <span id="calendarHeaderYear">2026</span>
                    </h6>
                </div>

                <div class="d-flex align-items-center flex-wrap gap-2">
                    <!-- Previous / Today / Next Navigation Controls -->
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-secondary shadow-none" id="prevMonthBtn"
                            title="Previous Month" style="font-size: 12.5px; padding: 4px 10px;">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary shadow-none" id="todayMonthBtn"
                            style="font-size: 12.5px; padding: 4px 12px;">
                            Today
                        </button>
                        <button type="button" class="btn btn-outline-secondary shadow-none" id="nextMonthBtn"
                            title="Next Month" style="font-size: 12.5px; padding: 4px 10px;">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>

                    <!-- Month Select Dropdown -->
                    <div class="dropdown">
                        <button
                            class="btn btn-sm bg-white d-flex align-items-center justify-content-between shadow-none"
                            type="button" id="monthDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false"
                            style="min-width: 120px; height: 34px; border: 1px solid #ced4da; border-radius: 6px; font-size: 13px; color: #2D3748; padding: 4px 8px;">
                            <span id="currentMonthLabel">October</span>
                            <i class="bi bi-chevron-down ms-1 dropdown-chevron"
                                style="font-size: 11px; color: #6c757d; transition: transform 0.2s ease;"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm py-1" id="monthDropdownMenu"
                            aria-labelledby="monthDropdownBtn"
                            style="min-width: 120px; max-height: 220px; overflow-y: auto; font-size: 13px; border: 1px solid #EBE4E4;">
                        </ul>
                    </div>

                    <!-- Year Select Dropdown -->
                    <div class="dropdown">
                        <button
                            class="btn btn-sm bg-white d-flex align-items-center justify-content-between shadow-none"
                            type="button" id="yearDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false"
                            style="min-width: 95px; height: 34px; border: 1px solid #ced4da; border-radius: 6px; font-size: 13px; color: #2D3748; padding: 4px 8px;">
                            <span id="currentYearLabel">2026</span>
                            <i class="bi bi-chevron-down ms-1 dropdown-chevron"
                                style="font-size: 11px; color: #6c757d; transition: transform 0.2s ease;"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm py-1" id="yearDropdownMenu" aria-labelledby="yearDropdownBtn"
                            style="min-width: 95px; max-height: 220px; overflow-y: auto; font-size: 13px; border: 1px solid #EBE4E4;">
                        </ul>
                    </div>
                </div>
            </div>

            <!-- DYNAMIC CALENDAR GRID BODY -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 text-center"
                        style="border-color: #EBE4E4; min-width: 650px;">
                        <thead style="background-color: #f8f9fa;">
                            <tr style="font-size: 13px; font-weight: 600; color: #4A5568;">
                                <th style="width: 14.28%; padding: 8px 0;">Sun</th>
                                <th style="width: 14.28%; padding: 8px 0;">Mon</th>
                                <th style="width: 14.28%; padding: 8px 0;">Tue</th>
                                <th style="width: 14.28%; padding: 8px 0;">Wed</th>
                                <th style="width: 14.28%; padding: 8px 0;">Thu</th>
                                <th style="width: 14.28%; padding: 8px 0;">Fri</th>
                                <th style="width: 14.28%; padding: 8px 0;">Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendarGridBody" style="font-size: 12.5px;">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CALENDAR FOOTER LEGEND -->
            <div class="card-footer bg-white border-top py-2 px-3 d-flex align-items-center justify-content-between flex-wrap gap-2"
                style="font-size: 12px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-1">
                        <span
                            style="width: 12px; height: 12px; background-color: #800020; border-radius: 3px; display: inline-block;"></span>
                        <span>Confirmed Session</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span
                            style="width: 12px; height: 12px; background-color: #FEFCF0; border: 1px solid #F6E05E; border-radius: 3px; display: inline-block;"></span>
                        <span>Pending Request</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span
                            style="width: 12px; height: 12px; background-color: #f0f0f0; border: 1px solid #dcdcdc; border-radius: 3px; display: inline-block;"></span>
                        <span>Past / Completed</span>
                    </div>
                </div>
                <span class="text-muted">Click any session block to view details</span>
            </div>
        </div>
    </div>

    <!-- SIDE PANEL: TODAY'S AGENDA & RECENT SESSION -->
    <div class="col-xl-4 col-lg-4 col-12">
        <div class="card shadow-sm border-0 h-100" style="border: 1px solid #EBE4E4 !important; border-radius: 10px;">
            <div class="card-header bg-white py-3 px-3 px-md-4" style="border-bottom: 1px solid #EBE4E4;">
                <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
                    <i class="bi bi-clock-history me-2" style="color: #D4A017;"></i>Today's Agenda (Oct 21)
                </h6>
            </div>
            <div class="card-body p-3">
                <!-- Today Item 1 -->
                <div class="p-3 mb-2 rounded border"
                    style="background-color: #ffffff; border-left: 4px solid #800020 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge mb-1"
                                style="background-color: #FDF2F4; color: #800020; font-size: 11px;">10:00 AM - 11:00
                                AM</span>
                            <h6 class="fw-bold mb-0 text-dark" style="font-size: 14px;">DELA CRUZ, JUAN L.</h6>
                            <div class="text-muted mt-1" style="font-size: 12px;">
                                <i class="bi bi-mortarboard me-1"></i>BSIS • Academic / Performance
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#modal-calendar-session-detail"
                            style="width: 60px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 12px; font-weight: 500;">
                            View
                        </button>
                    </div>
                </div>

                <!-- Today Item 2 -->
                <div class="p-3 mb-3 rounded border"
                    style="background-color: #ffffff; border-left: 4px solid #D4A017 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge mb-1"
                                style="background-color: #FEFCF0; color: #B7791F; border: 1px solid #F6E05E; font-size: 11px;">02:00
                                PM - 03:00 PM</span>
                            <h6 class="fw-bold mb-0 text-dark" style="font-size: 14px;">SANTOS, MARIA C.</h6>
                            <div class="text-muted mt-1" style="font-size: 12px;">
                                <i class="bi bi-heart-pulse me-1"></i>BSIT • Stress Management
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#modal-calendar-session-detail"
                            style="width: 60px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 12px; font-weight: 500;">
                            View
                        </button>
                    </div>
                </div>

                <!-- RECENT SESSION SIDE LIST -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-2">
                    <span class="fw-bold text-uppercase text-muted"
                        style="font-size: 12px; letter-spacing: 0.5px;">Recent Session</span>
                    <span class="badge bg-light text-secondary border" style="font-size: 11px;">Past Logs</span>
                </div>

                <!-- Past Item 1 -->
                <div class="d-flex align-items-center justify-content-between py-2 border-bottom"
                    style="font-size: 13px;">
                    <div>
                        <strong class="text-dark d-block" style="font-size: 13px;">Oct 16, 2026 • 10:00 AM</strong>
                        <span class="text-muted" style="font-size: 12px;">RAMOS, CARLOS M. (BSTM)</span>
                    </div>
                    <span class="badge"
                        style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; font-size: 11px;">Completed</span>
                </div>

                <!-- Past Item 2 -->
                <div class="d-flex align-items-center justify-content-between py-2 border-bottom"
                    style="font-size: 13px;">
                    <div>
                        <strong class="text-dark d-block" style="font-size: 13px;">Oct 07, 2026 • 01:30 PM</strong>
                        <span class="text-muted" style="font-size: 12px;">SANTOS, MARIA C. (BSIT)</span>
                    </div>
                    <span class="badge"
                        style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; font-size: 11px;">Completed</span>
                </div>

                <!-- Past Item 3 -->
                <div class="d-flex align-items-center justify-content-between py-2" style="font-size: 13px;">
                    <div>
                        <strong class="text-dark d-block" style="font-size: 13px;">Oct 02, 2026 • 09:00 AM</strong>
                        <span class="text-muted" style="font-size: 12px;">DELA CRUZ, JUAN L. (BSIS)</span>
                    </div>
                    <span class="badge"
                        style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; font-size: 11px;">Completed</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   DEDICATED SECTION: PAST SESSION SCHEDULES & HISTORY ARCHIVE        -->
<!-- ==================================================================== -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #EBE4E4 !important; border-radius: 10px;">
    <!-- HEADER -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #EBE4E4;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-archive-fill me-2" style="color: #D4A017;"></i>Past Session Schedules & Consultation History
        </h6>
        <div class="d-flex align-items-center gap-2">
            <div class="input-group input-group-sm" style="width: 230px;">
                <span class="input-group-text border-end-0 text-muted"
                    style="background-color: #ffffff; border-color: #ced4da; font-size: 13px;">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 shadow-none" placeholder="Search past session..."
                    style="font-size: 13px; height: 34px; border-color: #ced4da;">
            </div>
        </div>
    </div>

    <!-- PAST SESSIONS TABLE -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 130px; color: #2D3748;">
                            Appointment ID</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 140px; color: #2D3748;">
                            Session Date & Time</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 180px; color: #2D3748;">
                            Student Name</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 100px; color: #2D3748;">
                            Program</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 170px; color: #2D3748;">
                            Primary Concern</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 120px; color: #2D3748;">
                            Session Status</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 90px; color: #2D3748;">
                            Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13.5px;">
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-003
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Oct 16, 2026 • 10:00 AM</td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 75px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Career / Program Selection</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">
                                Concluded
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-calendar-session-detail"
                                style="width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                View
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-002
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Oct 07, 2026 • 01:30 PM</td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">SANTOS, MARIA C.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 75px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIT</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Emotional / Stress Mgt.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">
                                Concluded
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-calendar-session-detail"
                                style="width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                View
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">APT-2026-001
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Oct 02, 2026 • 09:00 AM</td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">DELA CRUZ, JUAN L.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 75px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIS</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Academic / Performance</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">
                                Concluded
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                data-bs-target="#modal-calendar-session-detail"
                                style="width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 2px 0; font-size: 13px; font-weight: 500;">
                                View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: CALENDAR SESSION DETAILS & COUNSELING SLIP                  -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-calendar-session-detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Counseling Session Details & Record Slip
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                                    <span class="me-3"><strong>Appointment ID:</strong> APT-2026-001</span>
                                    <span class="me-3"><strong>Program:</strong> BSIS</span>
                                    <span><strong>Year Level:</strong> 1st Year</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge"
                                style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12.5px;">
                                Session Completed
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-clock-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">
                            Time & Venue Schedule
                        </span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-4 col-12"><span class="text-muted d-block" style="font-size: 12px;">Session
                                Date:</span><strong>October 21, 2026 (Wednesday)</strong></div>
                        <div class="col-md-4 col-6"><span class="text-muted d-block" style="font-size: 12px;">Assigned
                                Time:</span><strong>10:00 AM - 11:00 AM</strong></div>
                        <div class="col-md-4 col-6"><span class="text-muted d-block" style="font-size: 12px;">Room /
                                Location:</span><strong>Guidance Counseling Room 1</strong></div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-journal-text" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">
                            Consultation Concern & Notes
                        </span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12"><span class="text-muted d-block" style="font-size: 12px;">Nature of
                                Concern:</span><strong>Academic / Performance Concerns</strong></div>
                        <div class="col-md-6 col-12"><span class="text-muted d-block" style="font-size: 12px;">Source of
                                Referral:</span><strong>Self-Referral</strong></div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Counselor Post-Session Remarks &
                                Action Plan:</span>
                            <div class="p-2 border rounded bg-light mt-1" style="font-size: 13px; color: #4A5568;">
                                Routine student academic consultation concluded. Provided study habit framework,
                                scheduled a follow-up development check next month.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Session Slip
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">
                        Close
                    </button>
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        Update Session Notes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   CALENDAR SCRIPT ENGINE                                             -->
<!-- ==================================================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        const today = new Date();
        let currentMonth = 9; // October (0 = Jan, 9 = Oct)
        let currentYear = 2026;

        const sampleSessions = {
            "2026-10-02": [{ type: "completed", time: "09:00 AM", name: "Dela Cruz" }],
            "2026-10-07": [{ type: "completed", time: "01:30 PM", name: "Santos" }],
            "2026-10-16": [{ type: "completed", time: "10:00 AM", name: "Ramos" }],
            "2026-10-21": [
                { type: "confirmed", time: "10:00 AM", name: "Dela Cruz" },
                { type: "pending", time: "02:00 PM", name: "Santos" }
            ],
            "2026-10-23": [{ type: "confirmed", time: "01:00 PM", name: "Ramos" }],
            "2026-10-26": [{ type: "pending", time: "10:30 AM", name: "Garcia" }]
        };

        // DOM Elements
        const gridBody = document.getElementById("calendarGridBody");
        const headerMonth = document.getElementById("calendarHeaderMonth");
        const headerYear = document.getElementById("calendarHeaderYear");
        const monthLabel = document.getElementById("currentMonthLabel");
        const yearLabel = document.getElementById("currentYearLabel");
        const monthBtn = document.getElementById("monthDropdownBtn");
        const yearBtn = document.getElementById("yearDropdownBtn");
        const monthDropdownMenu = document.getElementById("monthDropdownMenu");
        const yearDropdownMenu = document.getElementById("yearDropdownMenu");

        // Function para awtomatikong mag-rotate / tumaas ang chevron arrow ng dropdown button
        function setupDropdownArrowToggle(button) {
            const parent = button.closest(".dropdown");
            const icon = button.querySelector(".dropdown-chevron");
            if (!parent || !icon) return;

            // Kapag binuksan ang dropdown, iikot/tataas ang arrow
            parent.addEventListener("show.bs.dropdown", function () {
                icon.style.transform = "rotate(180deg)";
            });

            // Kapag sumara o pumili ng item, babalik ito sa dating posisyon
            parent.addEventListener("hidden.bs.dropdown", function () {
                icon.style.transform = "rotate(0deg)";
            });
        }

        setupDropdownArrowToggle(monthBtn);
        setupDropdownArrowToggle(yearBtn);

        // Populate Months sa Dropdown
        monthDropdownMenu.innerHTML = monthNames.map((name, index) => {
            return `<li><a class="dropdown-item ${index === currentMonth ? 'active' : ''}" href="#" data-month="${index}">${name}</a></li>`;
        }).join("");

        // Populate Years sa Dropdown (2020 hanggang 2035)
        let yearItems = "";
        for (let y = 2020; y <= 2035; y++) {
            yearItems += `<li><a class="dropdown-item ${y === currentYear ? 'active' : ''}" href="#" data-year="${y}">${y}</a></li>`;
        }
        yearDropdownMenu.innerHTML = yearItems;

        function formatDateKey(year, monthIndex, day) {
            const m = String(monthIndex + 1).padStart(2, '0');
            const d = String(day).padStart(2, '0');
            return `${year}-${m}-${d}`;
        }

        // Dynamic Calendar Grid Computation
        function renderCalendar(year, month) {
            headerMonth.textContent = monthNames[month];
            headerYear.textContent = year;
            monthLabel.textContent = monthNames[month];
            yearLabel.textContent = year;

            monthDropdownMenu.querySelectorAll('.dropdown-item').forEach(el => {
                el.classList.toggle('active', parseInt(el.dataset.month, 10) === month);
            });
            yearDropdownMenu.querySelectorAll('.dropdown-item').forEach(el => {
                el.classList.toggle('active', parseInt(el.dataset.year, 10) === year);
            });

            // Tamang araw ng linggo kung saan magsisimula ang buwan (0 = Sun, 1 = Mon, ..., 6 = Sat)
            const firstDayIndex = new Date(year, month, 1).getDay();
            // Tamang bilang ng araw sa buwan
            const totalDays = new Date(year, month + 1, 0).getDate();
            // Huling araw ng nakaraang buwan para sa overflow
            const prevMonthLastDate = new Date(year, month, 0).getDate();

            let cells = [];

            // Overflow days ng nakaraang buwan
            for (let i = firstDayIndex - 1; i >= 0; i--) {
                cells.push({
                    day: prevMonthLastDate - i,
                    isCurrentMonth: false,
                    isToday: false,
                    dateKey: null
                });
            }

            // Mga araw sa kasalukuyang buwan
            for (let day = 1; day <= totalDays; day++) {
                const isToday = (
                    day === today.getDate() &&
                    month === today.getMonth() &&
                    year === today.getFullYear()
                );
                cells.push({
                    day: day,
                    isCurrentMonth: true,
                    isToday: isToday,
                    dateKey: formatDateKey(year, month, day)
                });
            }

            // Overflow days ng susunod na buwan
            const totalSlots = Math.ceil(cells.length / 7) * 7;
            const nextDaysCount = totalSlots - cells.length;
            for (let day = 1; day <= nextDaysCount; day++) {
                cells.push({
                    day: day,
                    isCurrentMonth: false,
                    isToday: false,
                    dateKey: null
                });
            }

            // Pag-render sa table body
            let html = "";
            for (let r = 0; r < cells.length; r += 7) {
                html += `<tr style="height: 85px;">`;
                for (let c = 0; c < 7; c++) {
                    const item = cells[r + c];

                    if (!item.isCurrentMonth) {
                        html += `
                        <td class="text-muted p-1 bg-light opacity-50 text-end pe-2 align-top" style="height: 85px;">
                            ${item.day}
                        </td>
                    `;
                    } else {
                        let todayStyle = "";
                        let todayBadge = `<span>${item.day}</span>`;

                        if (item.isToday) {
                            todayStyle = `background-color: #FDF2F4; border: 2px solid #800020 !important;`;
                            todayBadge = `<span class="badge" style="background-color: #800020; font-size: 11px;">${item.day} Today</span>`;
                        }

                        let sessionsHtml = "";
                        const sessions = sampleSessions[item.dateKey] || [];
                        sessions.forEach(sess => {
                            if (sess.type === "completed") {
                                sessionsHtml += `
                                <div class="p-1 mt-1 text-start rounded text-truncate border"
                                    style="background-color: #f0f0f0; color: #555; font-size: 11px; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#modal-calendar-session-detail">
                                    <i class="bi bi-check-circle-fill text-success me-1"></i>${sess.time} • ${sess.name}
                                </div>
                            `;
                            } else if (sess.type === "confirmed") {
                                sessionsHtml += `
                                <div class="p-1 mt-1 text-start rounded text-truncate text-white"
                                    style="background-color: #800020; font-size: 11px; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#modal-calendar-session-detail">
                                    <i class="bi bi-clock me-1"></i>${sess.time} • ${sess.name}
                                </div>
                            `;
                            } else if (sess.type === "pending") {
                                sessionsHtml += `
                                <div class="p-1 mt-1 text-start rounded text-truncate"
                                    style="background-color: #FEFCF0; border: 1px solid #F6E05E; color: #B7791F; font-size: 11px; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#modal-calendar-session-detail">
                                    <i class="bi bi-clock me-1"></i>${sess.time} • ${sess.name}
                                </div>
                            `;
                            }
                        });

                        html += `
                        <td class="p-1 text-end pe-2 align-top" style="height: 85px; ${todayStyle}">
                            ${todayBadge}
                            ${sessionsHtml}
                        </td>
                    `;
                    }
                }
                html += `</tr>`;
            }
            gridBody.innerHTML = html;
        }

        // Pagpili ng Buwan mula sa Dropdown
        monthDropdownMenu.addEventListener("click", function (e) {
            e.preventDefault();
            const target = e.target.closest(".dropdown-item");
            if (target) {
                currentMonth = parseInt(target.dataset.month, 10);
                renderCalendar(currentYear, currentMonth);
            }
        });

        // Pagpili ng Taon mula sa Dropdown
        yearDropdownMenu.addEventListener("click", function (e) {
            e.preventDefault();
            const target = e.target.closest(".dropdown-item");
            if (target) {
                currentYear = parseInt(target.dataset.year, 10);
                renderCalendar(currentYear, currentMonth);
            }
        });

        // Previous, Next, at Today Buttons
        document.getElementById("prevMonthBtn").addEventListener("click", function () {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentYear, currentMonth);
        });

        document.getElementById("nextMonthBtn").addEventListener("click", function () {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentYear, currentMonth);
        });

        document.getElementById("todayMonthBtn").addEventListener("click", function () {
            currentMonth = today.getMonth();
            currentYear = today.getFullYear();
            renderCalendar(currentYear, currentMonth);
        });

        // Unang pag-load
        renderCalendar(currentYear, currentMonth);
    });
</script>