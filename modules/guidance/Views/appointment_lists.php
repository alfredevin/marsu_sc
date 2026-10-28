<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: APPOINTMENT LISTS              -->
<!-- ==================================================================== -->

<!-- 1. PAGE BREADCRUMB & HEADER -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <!-- Breadcrumb Trail -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb mb-0"
                style="font-size: 14.5px; background: transparent; padding: 0; line-height: 1.5;">
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/appointment_lists') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Appointments
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Appointment Lists
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Counseling Appointment Management
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Manage student appointments, intake consultations, scheduling requests, and session status tracking.
                </p>
            </div>
            <div>
                <!-- Request Appointment Button: Opens Modal Form with Responsive Color Feedback -->
                <button type="button"
                    class="btn text-white shadow-none d-inline-flex align-items-center btn-request-appointment"
                    data-bs-toggle="modal" data-bs-target="#requestAppointmentModal"
                    onmouseenter="this.style.backgroundColor='#9B1130'; this.style.borderColor='#9B1130'; this.style.boxShadow='0 4px 12px rgba(128, 0, 32, 0.25)';"
                    onmouseleave="this.style.backgroundColor='#800020'; this.style.borderColor='#800020'; this.style.boxShadow='none'; this.style.transform='none';"
                    onmousedown="this.style.backgroundColor='#4A0012'; this.style.borderColor='#33000C'; this.style.transform='scale(0.96)';"
                    onmouseup="this.style.backgroundColor='#9B1130'; this.style.borderColor='#9B1130'; this.style.transform='none';"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 38px; border-radius: 6px; padding: 0 16px; font-weight: 500; transition: all 0.18s ease-in-out; cursor: pointer; user-select: none;">
                    <i class="bi bi-calendar-plus" style="margin-right: 10px; font-size: 15.5px;"></i>Request
                    Appointment
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .kpi-filter-card {
        border: 1px solid #E2E8F0 !important;
        border-radius: 8px !important;
        min-height: 105px;
        cursor: pointer;
        transition: transform 0.18s ease-in-out, box-shadow 0.18s ease-in-out, border-color 0.18s ease-in-out;
        user-select: none;
    }

    .kpi-filter-card:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08) !important;
    }

    .kpi-filter-card:active {
        transform: scale(0.98) !important;
    }

    .kpi-filter-card[data-status="all"] {
        border-left: 4px solid #800020 !important;
    }

    .kpi-filter-card[data-status="Approved"] {
        border-left: 4px solid #28a745 !important;
    }

    .kpi-filter-card[data-status="Pending"] {
        border-left: 4px solid #d97706 !important;
    }

    .kpi-filter-card[data-status="Completed"] {
        border-left: 4px solid #0d9488 !important;
    }

    .kpi-filter-card[data-status="Rescheduling"] {
        border-left: 4px solid #6f42c1 !important;
    }

    .kpi-filter-card.active[data-status="all"] {
        border: 1px solid #800020 !important;
        border-left: 4px solid #800020 !important;
        box-shadow: 0 0 0 2px rgba(128, 0, 32, 0.22), 0 4px 12px rgba(128, 0, 32, 0.10) !important;
    }

    .kpi-filter-card.active[data-status="Approved"] {
        border: 1px solid #28a745 !important;
        border-left: 4px solid #28a745 !important;
        box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.25), 0 4px 12px rgba(40, 167, 69, 0.10) !important;
    }

    .kpi-filter-card.active[data-status="Pending"] {
        border: 1px solid #d97706 !important;
        border-left: 4px solid #d97706 !important;
        box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.25), 0 4px 12px rgba(217, 119, 6, 0.10) !important;
    }

    .kpi-filter-card.active[data-status="Completed"] {
        border: 1px solid #0d9488 !important;
        border-left: 4px solid #0d9488 !important;
        box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.25), 0 4px 12px rgba(13, 148, 136, 0.10) !important;
    }

    .kpi-filter-card.active[data-status="Rescheduling"] {
        border: 1px solid #6f42c1 !important;
        border-left: 4px solid #6f42c1 !important;
        box-shadow: 0 0 0 2px rgba(111, 66, 193, 0.25), 0 4px 12px rgba(111, 66, 193, 0.10) !important;
    }
</style>

<!-- 2. CLICKABLE KPI CARDS (INTERACTIVE STATUS FILTERING AT THE TOP) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Appointments -->
    <div class="col-xl col-lg-4 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card active"
            id="kpi-card-all" data-status="all" onclick="applyStatusFilter('all', this)" role="button" tabindex="0"
            title="Click to view all appointments">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL APPOINTMENTS
                    </div>
                    <div class="mt-1" id="count-all"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        12
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da;">
                    <i class="bi bi-calendar2-range-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>All intake records</span>
                <span class="badge kpi-indicator"
                    style="background-color: #800020; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Approved -->
    <div class="col-xl col-lg-4 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-approved" data-status="Approved" onclick="applyStatusFilter('Approved', this)" role="button"
            tabindex="0" title="Click to filter approved appointments">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        APPROVED
                    </div>
                    <div class="mt-1" id="count-approved"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        4
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Confirmed sessions</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #28a745; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 3: Pending -->
    <div class="col-xl col-lg-4 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-pending" data-status="Pending" onclick="applyStatusFilter('Pending', this)" role="button"
            tabindex="0" title="Click to filter pending appointments">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PENDING
                    </div>
                    <div class="mt-1" id="count-pending"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Awaiting confirmation</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #d97706; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Completed -->
    <div class="col-xl col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-completed" data-status="Completed" onclick="applyStatusFilter('Completed', this)" role="button"
            tabindex="0" title="Click to filter completed appointments">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        COMPLETED
                    </div>
                    <div class="mt-1" id="count-completed"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Concluded sessions</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #0d9488; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 5: Rescheduling -->
    <div class="col-xl col-lg-6 col-md-12 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-rescheduling" data-status="Rescheduling" onclick="applyStatusFilter('Rescheduling', this)"
            role="button" tabindex="0" title="Click to filter rescheduling appointments">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        RESCHEDULING
                    </div>
                    <div class="mt-1" id="count-rescheduling"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        2
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f3e8ff; color: #6f42c1; border: 1px solid #e9d5ff;">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Schedule adjustments</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #6f42c1; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>
</div>

<!-- 3. SEARCH & ACTIVE FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <!-- Search Bar -->
            <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white ps-3"
                        style="border-color: #ced4da; font-size: 15px; height: 42px; border-radius: 8px 0 0 8px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="appointmentSearchInput"
                        class="form-control border-start-0 shadow-none ps-2 bg-white"
                        placeholder="Search by Student ID, Student Name, Concern, Category, or Room..."
                        oninput="handleSearchInput(this.value);"
                        style="border-color: #ced4da; font-size: 14.5px; height: 42px; border-radius: 0 8px 8px 0;">
                </div>
            </div>

            <!-- Active Filter Status Indicator -->
            <div class="col-xl-4 col-lg-4 col-md-12 col-12 d-flex justify-content-xl-end align-items-center gap-2">
                <span class="text-muted" style="font-size: 14px;">Filtered by:</span>
                <span id="activeFilterBadge"
                    class="badge text-dark bg-light border d-inline-flex align-items-center py-2 px-3"
                    style="font-size: 13.5px; border-radius: 6px; font-weight: 600;">
                    All Appointments
                </span>
                <button type="button" id="resetFilterBtn" class="btn btn-sm btn-outline-secondary shadow-none d-none"
                    onclick="resetAllFilters()"
                    style="font-size: 13px; height: 34px; border-radius: 6px; padding: 0 12px;">
                    <i class="bi bi-x-circle me-1"></i>Reset Filter
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 4. APPOINTMENTS LIST TABLE -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Student ID
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Student Name
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Category Concern
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Counseling Concern
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Appointment Date
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Appointment Time
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Session Type
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Location
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Status
                        </th>
                        <th class="text-center pe-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; width: 90px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">

                    <!-- Row 1: Approved -->
                    <tr class="appointment-row align-middle" data-status="Approved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-01089
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">RAMOS, CARLOS M.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Study habits and time management</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">09:30 AM - 10:30 AM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 101</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Approved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-001"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2: Pending -->
                    <tr class="appointment-row align-middle" data-status="Pending">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-01042
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">SANTOS, MARIA C.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Anxiety or excessive worry</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">01:30 PM - 02:30 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 102</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Pending
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-002"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3: Completed -->
                    <tr class="appointment-row align-middle" data-status="Completed">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-00512
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">MENDOZA, JUAN B.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Career Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Course or program selection & career planning</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 28, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">11:00 AM - 12:00 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 101</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Completed
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-003"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 4: Rescheduling -->
                    <tr class="appointment-row align-middle" data-status="Rescheduling">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-03115
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">DELA CRUZ, BEA L.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Behavioral Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Sudden withdrawal from social interactions</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 30, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">03:00 PM - 04:00 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 103</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #6f42c1; background-color: #f3e8ff; color: #581c87; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Rescheduling
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-004"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 5: Approved -->
                    <tr class="appointment-row align-middle" data-status="Approved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-02194
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">REYES, MARK ANTHONY</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Test anxiety & academic probation review</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 31, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">10:00 AM - 11:00 AM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 101</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Approved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-005"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 6: Pending -->
                    <tr class="appointment-row align-middle" data-status="Pending">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-01582
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">GONZALES, ALYSSA P.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Stress management and coping strategies</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 03, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">08:30 AM - 09:30 AM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 102</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Pending
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-006"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 7: Completed -->
                    <tr class="appointment-row align-middle" data-status="Completed">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-04421
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">BAUTISTA, JOHN KEVIN</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Career Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Employment readiness and interview coaching</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 27, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">02:00 PM - 03:00 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 104</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Completed
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-007"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 8: Approved -->
                    <tr class="appointment-row align-middle" data-status="Approved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-03719
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">VILLANUEVA, CHLOE ANNE</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Behavioral Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Conflict resolution with classmates</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 04, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">01:00 PM - 02:00 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 103</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Approved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-008"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 9: Pending -->
                    <tr class="appointment-row align-middle" data-status="Pending">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-02844
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">AQUINO, JOSHUA D.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Difficulty adjusting to college curriculum</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 05, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">09:00 AM - 10:00 AM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 101</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Pending
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-009"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 10: Completed -->
                    <tr class="appointment-row align-middle" data-status="Completed">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2021-00983
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">CASTILLO, ELAINE JOY</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Personal adjustment and grief recovery</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 26, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">03:30 PM - 04:30 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 105</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Completed
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-010"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 11: Approved -->
                    <tr class="appointment-row align-middle" data-status="Approved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-01827
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">CORTEZ, RAFAEL G.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Career Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Resume review and internship placement guidance</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 06, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">10:30 AM - 11:30 AM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 104</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Approved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-011"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 12: Rescheduling -->
                    <tr class="appointment-row align-middle" data-status="Rescheduling">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-03190
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">NAVARRO, PATRICIA MAE</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 2.0; min-width: 240px;">
                            <span class="text-dark">Emotional regulation and peer relationships</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 06, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">02:00 PM - 03:00 PM</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Face-to-Face</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Room 102</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #6f42c1; background-color: #f3e8ff; color: #581c87; border-radius: 50rem; min-width: 90px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 14px;">
                                Rescheduling
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/appointment_view') ?>?id=APT-2026-012"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Appointment" aria-label="View Appointment"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Empty State Row (Hidden by default) -->
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="10" class="text-center py-5">
                            <div class="text-muted mb-2" style="font-size: 15px; line-height: 2.0;">
                                <i class="bi bi-search me-1 text-secondary" style="font-size: 18px;"></i>
                                No appointments found matching the selected filter or search term.
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none"
                                onclick="resetAllFilters()"
                                style="font-size: 13px; height: 32px; border-radius: 6px; padding: 0 12px;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset All Filters
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-4"
            style="border-top: 1px solid #E2E8F0 !important;">
            <div class="text-muted" id="showingCountText" style="font-size: 14px;">
                Showing 12 of 12 appointments
            </div>
            <nav aria-label="Appointment list pagination">
                <ul class="pagination pagination-sm mb-0 gap-1">
                    <li class="page-item disabled">
                        <span class="page-link shadow-none" style="border-radius: 4px;">&laquo;</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link shadow-none"
                            style="background-color: #800020; border-color: #800020; border-radius: 4px;">1</span>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link shadow-none" style="border-radius: 4px;">&raquo;</span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   5. REQUEST APPOINTMENT MODAL (ONLY VISIBLE ON BUTTON CLICK)        -->
<!-- ==================================================================== -->
<div class="modal fade" id="requestAppointmentModal" tabindex="-1" aria-labelledby="requestAppointmentModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">

            <!-- Modal Header -->
            <div class="modal-header px-4 py-3 bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="requestAppointmentModalLabel"
                        style="font-size: 18px; letter-spacing: -0.2px;">
                        Request Appointment
                    </h5>
                    <div class="text-muted" style="font-size: 13.5px;">
                        Guidance and Counseling Intake &amp; Referral Information
                    </div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body (Comprehensive Intake Form) -->
            <div class="modal-body p-4 bg-white" style="font-size: 14.5px;">
                <form id="requestAppointmentFormElement"
                    onsubmit="event.preventDefault(); alert('Appointment request submitted successfully!'); const m = bootstrap.Modal.getInstance(document.getElementById('requestAppointmentModal')); if(m) m.hide();">

                    <!-- STUDENT INFORMATION -->
                    <div class="p-3 mb-4 rounded" style="background-color: #F8FAFC; border: 1px solid #E2E8F0;">
                        <div class="fw-bold text-uppercase mb-3"
                            style="color: #800020; font-size: 14px; letter-spacing: 0.5px;">
                            Student Information
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold text-dark mb-1"
                                    style="font-size: 13.5px;">Student’s Name:</label>
                                <input type="text" class="form-control form-control-sm bg-white shadow-none" required
                                    placeholder="Enter Student's Full Name"
                                    style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 13.5px;">Student
                                    ID Number:</label>
                                <input type="text" class="form-control form-control-sm bg-white shadow-none" required
                                    placeholder="e.g. 2023-01089"
                                    style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 13.5px;">Year
                                    Level and Program:</label>
                                <input type="text" class="form-control form-control-sm bg-white shadow-none" required
                                    placeholder="e.g. 3rd Year - BSIS"
                                    style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 13.5px;">Date of
                                    Birth:</label>
                                <input type="date" class="form-control form-control-sm bg-white shadow-none"
                                    style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 13.5px;">Contact
                                    Number:</label>
                                <input type="text" class="form-control form-control-sm bg-white shadow-none"
                                    placeholder="e.g. 0912 345 6789"
                                    style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 13.5px;">Source
                                    of Referral:</label>
                                <select class="form-select form-select-sm bg-white shadow-none"
                                    style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                                    <option value="Self-Referral" selected>Self-Referral</option>
                                    <option value="Teacher/Faculty">Teacher / Faculty Member</option>
                                    <option value="Department Head / Dean">Department Head / Dean</option>
                                    <option value="Parent/Guardian">Parent / Guardian</option>
                                    <option value="Peer/Classmate">Peer / Classmate</option>
                                    <option value="Guidance Counselor">Guidance Counselor Outreach</option>
                                    <option value="Other">Other Referral Source</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ACADEMIC PROBLEM/CONCERN -->
                    <div class="mb-4">
                        <div class="fw-bold text-dark mb-2 pb-1 border-bottom"
                            style="font-size: 14.5px; color: #1E293B;">
                            ACADEMIC PROBLEM/CONCERN:
                        </div>
                        <div class="row g-2 pt-1">
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_poor_perf">
                                    <label class="form-check-label text-dark" for="acad_poor_perf"
                                        style="font-size: 14px;">Poor academic performance</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_study_habits">
                                    <label class="form-check-label text-dark" for="acad_study_habits"
                                        style="font-size: 14px;">Study habits and time management</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_test_anxiety">
                                    <label class="form-check-label text-dark" for="acad_test_anxiety"
                                        style="font-size: 14px;">Test anxiety</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_diff_adjust">
                                    <label class="form-check-label text-dark" for="acad_diff_adjust"
                                        style="font-size: 14px;">Difficulty adjusting to academic demands</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_learning_diff">
                                    <label class="form-check-label text-dark" for="acad_learning_diff"
                                        style="font-size: 14px;">Learning difficulties</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_class_attend">
                                    <label class="form-check-label text-dark" for="acad_class_attend"
                                        style="font-size: 14px;">Class attendance or motivation</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="acad_probation">
                                    <label class="form-check-label text-dark" for="acad_probation"
                                        style="font-size: 14px;">Academic probation or retention concerns</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox"
                                        id="acad_program_concern">
                                    <label class="form-check-label text-dark" for="acad_program_concern"
                                        style="font-size: 14px;">Course or program-related concerns</label>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input shadow-none" type="checkbox"
                                            id="acad_other_check">
                                        <label class="form-check-label text-dark fw-semibold" for="acad_other_check"
                                            style="font-size: 14px;">Other:</label>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm bg-white shadow-none flex-grow-1"
                                        placeholder="Specify other academic concerns..."
                                        style="min-width: 220px; height: 36px; border-color: #CBD5E1; font-size: 14px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CAREER RELATED CONCERNS -->
                    <div class="mb-4">
                        <div class="fw-bold text-dark mb-2 pb-1 border-bottom"
                            style="font-size: 14.5px; color: #1E293B;">
                            CAREER RELATED CONCERNS:
                        </div>
                        <div class="row g-2 pt-1">
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_explor">
                                    <label class="form-check-label text-dark" for="career_explor"
                                        style="font-size: 14px;">Career exploration</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_decision">
                                    <label class="form-check-label text-dark" for="career_decision"
                                        style="font-size: 14px;">Career decision-making</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_prog_select">
                                    <label class="form-check-label text-dark" for="career_prog_select"
                                        style="font-size: 14px;">Course or program selection</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_trans">
                                    <label class="form-check-label text-dark" for="career_trans"
                                        style="font-size: 14px;">Career change or transition</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_readiness">
                                    <label class="form-check-label text-dark" for="career_readiness"
                                        style="font-size: 14px;">Employment readiness</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_resume">
                                    <label class="form-check-label text-dark" for="career_resume"
                                        style="font-size: 14px;">Resume or curriculum vitae (CV) review</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_interview">
                                    <label class="form-check-label text-dark" for="career_interview"
                                        style="font-size: 14px;">Interview preparation</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="career_grad_plan">
                                    <label class="form-check-label text-dark" for="career_grad_plan"
                                        style="font-size: 14px;">Graduate studies planning</label>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input shadow-none" type="checkbox"
                                            id="career_other_check">
                                        <label class="form-check-label text-dark fw-semibold" for="career_other_check"
                                            style="font-size: 14px;">Other career-related concerns:</label>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm bg-white shadow-none flex-grow-1"
                                        placeholder="Specify other career-related concerns..."
                                        style="min-width: 220px; height: 36px; border-color: #CBD5E1; font-size: 14px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- EMOTIONAL OR PSYCHOLOGICAL CONCERNS * -->
                    <div class="mb-4">
                        <div class="fw-bold text-dark mb-2 pb-1 border-bottom"
                            style="font-size: 14.5px; color: #1E293B;">
                            EMOTIONAL OR PSYCHOLOGICAL CONCERNS <span class="text-danger">*</span>
                        </div>
                        <div class="row g-2 pt-1">
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_stress">
                                    <label class="form-check-label text-dark" for="emot_stress"
                                        style="font-size: 14px;">Stress Management</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_anxiety">
                                    <label class="form-check-label text-dark" for="emot_anxiety"
                                        style="font-size: 14px;">Anxiety or excessive worry</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_sadness">
                                    <label class="form-check-label text-dark" for="emot_sadness"
                                        style="font-size: 14px;">Sadness or depressive feelings</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_reg">
                                    <label class="form-check-label text-dark" for="emot_reg"
                                        style="font-size: 14px;">Emotional regulation</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_self_esteem">
                                    <label class="form-check-label text-dark" for="emot_self_esteem"
                                        style="font-size: 14px;">Self-esteem or self-confidence</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_relationship">
                                    <label class="form-check-label text-dark" for="emot_relationship"
                                        style="font-size: 14px;">Relationship concerns (family, peers, romantic)</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_grief">
                                    <label class="form-check-label text-dark" for="emot_grief"
                                        style="font-size: 14px;">Grief and loss</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_anger">
                                    <label class="form-check-label text-dark" for="emot_anger"
                                        style="font-size: 14px;">Anger management</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_loneliness">
                                    <label class="form-check-label text-dark" for="emot_loneliness"
                                        style="font-size: 14px;">Loneliness or social isolation</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_adjust">
                                    <label class="form-check-label text-dark" for="emot_adjust"
                                        style="font-size: 14px;">Personal adjustment issues</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" id="emot_crisis">
                                    <label class="form-check-label text-dark" for="emot_crisis"
                                        style="font-size: 14px;">Crisis or urgent emotional concerns</label>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input shadow-none" type="checkbox"
                                            id="emot_other_check">
                                        <label class="form-check-label text-dark fw-semibold" for="emot_other_check"
                                            style="font-size: 14px;">Other:</label>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm bg-white shadow-none flex-grow-1"
                                        placeholder="Specify other emotional or psychological concerns..."
                                        style="min-width: 220px; height: 36px; border-color: #CBD5E1; font-size: 14px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SOURCE OF REFERRAL & OBSERVATIONS -->
                    <div class="p-3 mb-4 rounded" style="background-color: #F8FAFC; border: 1px solid #E2E8F0;">
                        <!-- Behavioral Changes -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-2" style="font-size: 14px;">Behavioral Changes:</div>
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="beh_withdrawal">
                                        <label class="form-check-label text-dark" for="beh_withdrawal"
                                            style="font-size: 14px;">Sudden withdrawal from social interactions</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="beh_drop_perf">
                                        <label class="form-check-label text-dark" for="beh_drop_perf"
                                            style="font-size: 14px;">Noticeable drop in academic performance</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox"
                                            id="beh_irritability">
                                        <label class="form-check-label text-dark" for="beh_irritability"
                                            style="font-size: 14px;">Increased irritability or mood swings</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="beh_focus">
                                        <label class="form-check-label text-dark" for="beh_focus"
                                            style="font-size: 14px;">Lack of focus or attention during classes</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="beh_absences">
                                        <label class="form-check-label text-dark" for="beh_absences"
                                            style="font-size: 14px;">Frequent absences or tardiness</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="beh_hygiene">
                                        <label class="form-check-label text-dark" for="beh_hygiene"
                                            style="font-size: 14px;">Decline in personal hygiene or appearance</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="beh_weight">
                                        <label class="form-check-label text-dark" for="beh_weight"
                                            style="font-size: 14px;">Significant weight gain/loss without
                                            explanation</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Emotional Distress -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-2" style="font-size: 14px;">Emotional Distress:</div>
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="dist_sadness">
                                        <label class="form-check-label text-dark" for="dist_sadness"
                                            style="font-size: 14px;">Excessive sadness or tearfulness</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox"
                                            id="dist_hopelessness">
                                        <label class="form-check-label text-dark" for="dist_hopelessness"
                                            style="font-size: 14px;">Expressions of hopelessness or
                                            worthlessness</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="dist_worry">
                                        <label class="form-check-label text-dark" for="dist_worry"
                                            style="font-size: 14px;">Excessive worry or anxiety</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="dist_interest">
                                        <label class="form-check-label text-dark" for="dist_interest"
                                            style="font-size: 14px;">Loss of interest in activities they once
                                            enjoyed</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="dist_outbursts">
                                        <label class="form-check-label text-dark" for="dist_outbursts"
                                            style="font-size: 14px;">Frequent emotional outbursts (anger,
                                            frustration)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="dist_harm">
                                        <label class="form-check-label text-dark" for="dist_harm"
                                            style="font-size: 14px;">Expressions of self-harm or suicide (verbal or
                                            written)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Physical Symptoms -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-2" style="font-size: 14px;">Physical Symptoms:</div>
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="phys_headaches">
                                        <label class="form-check-label text-dark" for="phys_headaches"
                                            style="font-size: 14px;">Frequent headaches or complaints of physical pain
                                            without medical explanation</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="phys_harm">
                                        <label class="form-check-label text-dark" for="phys_harm"
                                            style="font-size: 14px;">Visible signs of self-harm (cuts, bruises)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="phys_fatigue">
                                        <label class="form-check-label text-dark" for="phys_fatigue"
                                            style="font-size: 14px;">Extreme fatigue or lethargy</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="phys_sleep">
                                        <label class="form-check-label text-dark" for="phys_sleep"
                                            style="font-size: 14px;">Trouble sleeping or excessive sleeping</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social and Relationship Issues -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-2" style="font-size: 14px;">Social and Relationship Issues:
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="soc_conflicts">
                                        <label class="form-check-label text-dark" for="soc_conflicts"
                                            style="font-size: 14px;">Conflicts with peers or faculty members</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="soc_bullying">
                                        <label class="form-check-label text-dark" for="soc_bullying"
                                            style="font-size: 14px;">Bullying or being bullied</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="soc_isolation">
                                        <label class="form-check-label text-dark" for="soc_isolation"
                                            style="font-size: 14px;">Isolation from friends or classmates</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox"
                                            id="soc_relationships">
                                        <label class="form-check-label text-dark" for="soc_relationships"
                                            style="font-size: 14px;">Difficulty in forming or maintaining
                                            relationships</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Substance Use -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-2" style="font-size: 14px;">Substance Use:</div>
                            <div class="form-check">
                                <input class="form-check-input shadow-none" type="checkbox" id="sub_abuse">
                                <label class="form-check-label text-dark" for="sub_abuse"
                                    style="font-size: 14px;">Suspected or confirmed substance abuse (alcohol,
                                    drugs)</label>
                            </div>
                        </div>

                        <!-- Other Observations -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-1" style="font-size: 14px;">Other Observations:</div>
                            <label class="form-label text-muted mb-1" style="font-size: 13.5px;">Please specify if there
                                are any other concerns not listed above:</label>
                            <input type="text" class="form-control form-control-sm bg-white shadow-none"
                                placeholder="Specify any additional observed behaviors or situational context..."
                                style="height: 40px; border-color: #CBD5E1; font-size: 14px;">
                        </div>

                        <!-- Actions Taken (if any) -->
                        <div class="mb-3">
                            <div class="fw-bold text-dark mb-2" style="font-size: 14px;">Actions Taken (if any):</div>
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="act_student">
                                        <label class="form-check-label text-dark" for="act_student"
                                            style="font-size: 14px;">Discussion with student</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="act_parents">
                                        <label class="form-check-label text-dark" for="act_parents"
                                            style="font-size: 14px;">Discussion with parents/guardian</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" id="act_guidance">
                                        <label class="form-check-label text-dark" for="act_guidance"
                                            style="font-size: 14px;">Suggested the student seek help from the Guidance
                                            Office</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input shadow-none" type="checkbox"
                                                id="act_other_check">
                                            <label class="form-check-label text-dark fw-semibold" for="act_other_check"
                                                style="font-size: 14px;">Other (Please specify):</label>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-white shadow-none flex-grow-1"
                                            placeholder="Specify actions taken..."
                                            style="min-width: 220px; height: 36px; border-color: #CBD5E1; font-size: 14px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Comments or Concerns -->
                        <div>
                            <div class="fw-bold text-dark mb-1" style="font-size: 14px;">Additional Comments or
                                Concerns:</div>
                            <textarea class="form-control form-control-sm bg-white shadow-none" rows="3"
                                placeholder="Provide any additional comments, referral context, or counseling concerns..."
                                style="border-color: #CBD5E1; font-size: 14px;"></textarea>
                        </div>

                    </div>

                    <!-- Modal Actions -->
                    <div class="d-flex justify-content-end align-items-center gap-2 pt-2 border-top">
                        <button type="button" class="btn btn-outline-secondary shadow-none px-3" data-bs-dismiss="modal"
                            style="font-size: 14px; height: 38px; border-radius: 6px;">
                            Cancel
                        </button>
                        <button type="submit" class="btn text-white shadow-none px-4"
                            onmouseenter="this.style.backgroundColor='#9B1130'; this.style.borderColor='#9B1130'; this.style.boxShadow='0 4px 12px rgba(128, 0, 32, 0.25)';"
                            onmouseleave="this.style.backgroundColor='#800020'; this.style.borderColor='#800020'; this.style.boxShadow='none'; this.style.transform='none';"
                            onmousedown="this.style.backgroundColor='#4A0012'; this.style.borderColor='#33000C'; this.style.transform='scale(0.96)';"
                            onmouseup="this.style.backgroundColor='#9B1130'; this.style.borderColor='#9B1130'; this.style.transform='none';"
                            style="background-color: #800020; border: 1px solid #800020; font-size: 14px; height: 38px; border-radius: 6px; font-weight: 500; transition: all 0.18s ease-in-out; cursor: pointer; user-select: none;">
                            <i class="bi bi-check2-circle" style="margin-right: 8px; font-size: 15px;"></i>Submit
                            Appointment Request
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   6. CLIENT-SIDE FILTERING & SEARCH CONTROLLER                       -->
<!-- ==================================================================== -->
<script>
    window.currentStatusFilter = 'all';
    window.currentSearchText = '';

    window.applyStatusFilter = function (status, cardEl) {
        if (!status) status = 'all';
        window.currentStatusFilter = status;

        // Toggle active classes on all KPI cards
        const cards = document.querySelectorAll('.kpi-filter-card');
        cards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            const ind = card.querySelector('.kpi-indicator');
            if (cardStatus === status) {
                card.classList.add('active');
                if (ind) ind.classList.remove('d-none');
            } else {
                card.classList.remove('active');
                if (ind) ind.classList.add('d-none');
            }
        });

        // Update the toolbar status pill indicator with theme colors
        const badge = document.getElementById('activeFilterBadge');
        const resetBtn = document.getElementById('resetFilterBtn');
        if (badge) {
            if (status === 'all') {
                badge.textContent = 'All Appointments';
                badge.className = 'badge text-dark bg-light border d-inline-flex align-items-center py-2 px-3';
                badge.style.borderColor = '#E2E8F0';
                badge.style.backgroundColor = '';
                badge.style.color = '';
            } else if (status === 'Approved') {
                badge.textContent = 'Approved';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f4fbf6';
                badge.style.color = '#155724';
                badge.style.border = '1px solid #28a745';
            } else if (status === 'Pending') {
                badge.textContent = 'Pending';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#fffbeb';
                badge.style.color = '#92400e';
                badge.style.border = '1px solid #d97706';
            } else if (status === 'Completed') {
                badge.textContent = 'Completed';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f0fdfa';
                badge.style.color = '#0f766e';
                badge.style.border = '1px solid #0d9488';
            } else if (status === 'Rescheduling') {
                badge.textContent = 'Rescheduling';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f3e8ff';
                badge.style.color = '#581c87';
                badge.style.border = '1px solid #6f42c1';
            }
        }

        if (resetBtn) {
            if (status === 'all' && !window.currentSearchText) {
                resetBtn.classList.add('d-none');
            } else {
                resetBtn.classList.remove('d-none');
            }
        }

        window.filterTable();
    };

    window.handleSearchInput = function (val) {
        window.currentSearchText = (val || '').trim().toLowerCase();
        const resetBtn = document.getElementById('resetFilterBtn');
        if (resetBtn) {
            if (window.currentStatusFilter === 'all' && !window.currentSearchText) {
                resetBtn.classList.add('d-none');
            } else {
                resetBtn.classList.remove('d-none');
            }
        }
        window.filterTable();
    };

    window.resetAllFilters = function () {
        const searchInput = document.getElementById('appointmentSearchInput');
        if (searchInput) searchInput.value = '';
        window.currentSearchText = '';
        window.applyStatusFilter('all');
    };

    window.filterTable = function () {
        const rows = document.querySelectorAll('.appointment-row');
        let visible = 0;

        rows.forEach(row => {
            const rowStatus = (row.getAttribute('data-status') || '').trim();
            const rowText = (row.textContent || '').toLowerCase();

            const matchesStatus = (window.currentStatusFilter === 'all' || rowStatus.toLowerCase() === window.currentStatusFilter.toLowerCase());
            const matchesSearch = (!window.currentSearchText || rowText.includes(window.currentSearchText));

            if (matchesStatus && matchesSearch) {
                row.style.setProperty('display', '', '');
                visible++;
            } else {
                row.style.setProperty('display', 'none', 'important');
            }
        });

        const noResults = document.getElementById('noResultsRow');
        if (noResults) {
            noResults.style.display = (visible === 0) ? '' : 'none';
        }

        const countText = document.getElementById('showingCountText');
        if (countText) {
            const filterSuffix = (window.currentStatusFilter !== 'all') ? ' (Filtered by ' + window.currentStatusFilter + ')' : '';
            countText.textContent = 'Showing ' + visible + ' of ' + rows.length + ' appointments' + filterSuffix;
        }
    };

    function initKPIFiltering() {
        const rows = document.querySelectorAll('.appointment-row');
        let total = rows.length;
        let approved = 0, pending = 0, completed = 0, rescheduling = 0;

        rows.forEach(r => {
            const s = (r.getAttribute('data-status') || '').trim();
            if (s === 'Approved') approved++;
            else if (s === 'Pending') pending++;
            else if (s === 'Completed') completed++;
            else if (s === 'Rescheduling') rescheduling++;
        });

        const cAll = document.getElementById('count-all');
        const cApp = document.getElementById('count-approved');
        const cPen = document.getElementById('count-pending');
        const cCom = document.getElementById('count-completed');
        const cRes = document.getElementById('count-rescheduling');

        if (cAll) cAll.textContent = total;
        if (cApp) cApp.textContent = approved;
        if (cPen) cPen.textContent = pending;
        if (cCom) cCom.textContent = completed;
        if (cRes) cRes.textContent = rescheduling;

        // Attach event listeners to all KPI cards
        const cards = document.querySelectorAll('.kpi-filter-card');
        cards.forEach(card => {
            card.addEventListener('click', function () {
                const status = this.getAttribute('data-status');
                window.applyStatusFilter(status, this);
            });
            card.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const status = this.getAttribute('data-status');
                    window.applyStatusFilter(status, this);
                }
            });
        });

        // Attach to reset button
        const resetBtn = document.getElementById('resetFilterBtn');
        if (resetBtn) {
            resetBtn.onclick = function () {
                window.resetAllFilters();
            };
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initKPIFiltering);
    } else {
        initKPIFiltering();
    }
</script>