<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT CONCERNS               -->
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
                    <a href="<?= url('guidance/concerns') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Case Management
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Concerns
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Concern Management
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Manage, monitor and review submitted student concerns and statements.
                </p>
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

    .kpi-filter-card[data-filter="all"] {
        border-left: 4px solid #800020 !important;
    }

    .kpi-filter-card[data-filter="Pending Review"] {
        border-left: 4px solid #d97706 !important;
    }

    .kpi-filter-card[data-filter="High Priority"] {
        border-left: 4px solid #dc2626 !important;
    }

    .kpi-filter-card[data-filter="Active Case"] {
        border-left: 4px solid #0d9488 !important;
    }

    .kpi-filter-card.active[data-filter="all"] {
        border: 1px solid #800020 !important;
        border-left: 4px solid #800020 !important;
        box-shadow: 0 0 0 2px rgba(128, 0, 32, 0.22), 0 4px 12px rgba(128, 0, 32, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="Pending Review"] {
        border: 1px solid #d97706 !important;
        border-left: 4px solid #d97706 !important;
        box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.25), 0 4px 12px rgba(217, 119, 6, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="High Priority"] {
        border: 1px solid #dc2626 !important;
        border-left: 4px solid #dc2626 !important;
        box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.25), 0 4px 12px rgba(220, 38, 38, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="Active Case"] {
        border: 1px solid #0d9488 !important;
        border-left: 4px solid #0d9488 !important;
        box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.25), 0 4px 12px rgba(13, 148, 136, 0.10) !important;
    }
</style>

<!-- 2. CLICKABLE KPI CARDS (PENDING REVIEW, HIGH PRIORITY, ACTIVE CASES, TOTAL RECORDS) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Records -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card active"
            id="kpi-card-all" data-filter="all" onclick="applyStatusFilter('all', this)" role="button" tabindex="0"
            title="Click to view all concern records">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL RECORDS
                    </div>
                    <div class="mt-1" id="count-all"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        12
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da;">
                    <i class="bi bi-folder2-open"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>All submitted concerns</span>
                <span class="badge kpi-indicator"
                    style="background-color: #800020; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Pending Review -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-pending" data-filter="Pending Review" onclick="applyStatusFilter('Pending Review', this)"
            role="button" tabindex="0" title="Click to filter pending review concerns">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PENDING REVIEW
                    </div>
                    <div class="mt-1" id="count-pending"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        6
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Awaiting counselor review</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #d97706; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 3: High Priority -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-high" data-filter="High Priority" onclick="applyStatusFilter('High Priority', this)"
            role="button" tabindex="0" title="Click to filter high priority concerns">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        HIGH PRIORITY
                    </div>
                    <div class="mt-1" id="count-high"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        5
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Urgent attention required</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #dc2626; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Active Cases -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-active" data-filter="Active Case" onclick="applyStatusFilter('Active Case', this)"
            role="button" tabindex="0" title="Click to filter active cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ACTIVE CASES
                    </div>
                    <div class="mt-1" id="count-active"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        6
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1;">
                    <i class="bi bi-person-check-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Ongoing counseling</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #0d9488; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
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
                    <input type="text" id="concernSearchInput"
                        class="form-control border-start-0 shadow-none ps-2 bg-white"
                        placeholder="Search by Student ID, Student Name, Concern Type, Statement, Priority, Status..."
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
                    All Records
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

<!-- 4. STUDENT CONCERNS LIST TABLE (INCLUDES CONCERN STATEMENT) -->
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
                            Concern Type
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; min-width: 220px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Concern Statement
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Priority
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Submission Date
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Time
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Status
                        </th>
                        <th class="text-center pe-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; width: 135px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">

                    <!-- Row 1: RAMOS, CARLOS M. -->
                    <tr class="concern-row align-middle" data-status="Active Case" data-priority="Medium Priority">
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
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Difficulty adjusting to workload and study habits</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">09:30 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Active Case
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2: SANTOS, MARIA C. -->
                    <tr class="concern-row align-middle" data-status="Pending Review" data-priority="High Priority">
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
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Severe examination anxiety and restlessness</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">01:30 PM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Pending Review
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3: MENDOZA, JUAN B. -->
                    <tr class="concern-row align-middle" data-status="Active Case" data-priority="Low Priority">
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
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Career path and teacher licensure uncertainty</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-arrow-down-circle-fill"></i>Low Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 28, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">11:00 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Active Case
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 4: DELA CRUZ, BEA L. -->
                    <tr class="concern-row align-middle" data-status="Pending Review" data-priority="High Priority">
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
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Social isolation and peer adjustment</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 30, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">03:00 PM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Pending Review
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 5: REYES, MARK ANTHONY -->
                    <tr class="concern-row align-middle" data-status="Active Case" data-priority="Medium Priority">
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
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Academic probation and prerequisite failures</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 31, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">10:00 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Active Case
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 6: GONZALES, ALYSSA P. -->
                    <tr class="concern-row align-middle" data-status="Pending Review" data-priority="High Priority">
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
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Chronic stress and sleep disturbance</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Oct 31, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">02:00 PM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Pending Review
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 7: BAUTISTA, KEVIN R. -->
                    <tr class="concern-row align-middle" data-status="Active Case" data-priority="High Priority">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-03481
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">BAUTISTA, KEVIN R.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Family / Personal
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Domestic conflict and personal financial hardship</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 01, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">08:30 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Active Case
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 8: VILLANUEVA, PATRICIA M. -->
                    <tr class="concern-row align-middle" data-status="Pending Review" data-priority="Low Priority">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-04129
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">VILLANUEVA, PATRICIA M.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Career Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Program shifting evaluation and counseling</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-arrow-down-circle-fill"></i>Low Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 01, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">11:30 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Pending Review
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 9: AQUINO, CHRISTIAN J. -->
                    <tr class="concern-row align-middle" data-status="Active Case" data-priority="Medium Priority">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-00871
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">AQUINO, CHRISTIAN J.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Thesis research pacing and capstone defense</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 02, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">01:30 PM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Active Case
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 10: CASTRO, DIANA MAE -->
                    <tr class="concern-row align-middle" data-status="Pending Review" data-priority="High Priority">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-01934
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">CASTRO, DIANA MAE</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Persistent depressive mood and fatigue</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 02, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">03:30 PM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Pending Review
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 11: FLORES, GABRIEL S. -->
                    <tr class="concern-row align-middle" data-status="Active Case" data-priority="Medium Priority">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-03712
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">FLORES, GABRIEL S.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Behavioral Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Unexcused absences and peer conflicts</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 03, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">09:00 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Active Case
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Row 12: TAN, JUSTINE CHLOE -->
                    <tr class="concern-row align-middle" data-status="Pending Review" data-priority="Low Priority">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-02205
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">TAN, JUSTINE CHLOE</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; line-height: 1.5; min-width: 220px;">
                            <span class="text-dark">Burnout during laboratory practical exams</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-arrow-down-circle-fill"></i>Low Priority
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">Nov 03, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark">10:30 AM</span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 105px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Pending Review
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 16px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/cases') ?>"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Empty State / No Match Found Row -->
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="9" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px; background-color: #F8FAFC; border: 1px solid #CBD5E1; color: #64748B; font-size: 24px;">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">No matching student concerns found</h6>
                                <p class="text-muted mb-3" style="font-size: 14px;">Try adjusting your keyword search or
                                    active status filter.</p>
                                <button type="button"
                                    class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none"
                                    onclick="resetAllFilters()"
                                    style="font-size: 13.5px; border-radius: 6px; padding: 6px 16px;">
                                    Reset Filters
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer: Count & Pagination Info -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 px-4 py-3 bg-white"
            style="border-top: 1px solid #E2E8F0; font-size: 13.5px; color: #64748B;">
            <div id="showingCountText">
                Showing 12 of 12 student concerns
            </div>
            <div>
                <nav aria-label="Concerns pagination">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><span class="page-link shadow-none border-0">&laquo;</span></li>
                        <li class="page-item active"><span class="page-link shadow-none"
                                style="background-color: #800020; border-color: #800020;">1</span></li>
                        <li class="page-item disabled"><span class="page-link shadow-none border-0">&raquo;</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    window.currentStatusFilter = 'all';
    window.currentSearchText = '';

    window.applyStatusFilter = function (filterKey, element) {
        window.currentStatusFilter = filterKey || 'all';

        // Update active class on KPI cards
        const cards = document.querySelectorAll('.kpi-filter-card');
        cards.forEach(card => {
            const ind = card.querySelector('.kpi-indicator');
            if (card.getAttribute('data-filter') === filterKey) {
                card.classList.add('active');
                if (ind) ind.classList.remove('d-none');
            } else {
                card.classList.remove('active');
                if (ind) ind.classList.add('d-none');
            }
        });

        // Update active filter badge text
        const badge = document.getElementById('activeFilterBadge');
        const resetBtn = document.getElementById('resetFilterBtn');

        if (badge) {
            badge.style.backgroundColor = '';
            badge.style.color = '';
            badge.style.borderColor = '';

            if (filterKey === 'all') {
                badge.textContent = 'All Records';
                badge.className = 'badge text-dark bg-light border d-inline-flex align-items-center py-2 px-3';
            } else if (filterKey === 'Pending Review') {
                badge.textContent = 'Pending Review';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#fffbeb';
                badge.style.color = '#92400e';
                badge.style.border = '1px solid #d97706';
            } else if (filterKey === 'High Priority') {
                badge.textContent = 'High Priority';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#fef2f2';
                badge.style.color = '#991b1b';
                badge.style.border = '1px solid #dc2626';
            } else if (filterKey === 'Active Case') {
                badge.textContent = 'Active Cases';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f0fdfa';
                badge.style.color = '#0f766e';
                badge.style.border = '1px solid #0d9488';
            }
        }

        if (resetBtn) {
            if (filterKey === 'all' && !window.currentSearchText) {
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
        const searchInput = document.getElementById('concernSearchInput');
        if (searchInput) searchInput.value = '';
        window.currentSearchText = '';
        window.applyStatusFilter('all');
    };

    window.filterTable = function () {
        const rows = document.querySelectorAll('.concern-row');
        let visible = 0;

        rows.forEach(row => {
            const rowStatus = (row.getAttribute('data-status') || '').trim();
            const rowPriority = (row.getAttribute('data-priority') || '').trim();
            const rowText = (row.textContent || '').toLowerCase();

            let matchesFilter = false;
            if (window.currentStatusFilter === 'all') {
                matchesFilter = true;
            } else if (window.currentStatusFilter === 'High Priority') {
                matchesFilter = (rowPriority === 'High Priority');
            } else {
                matchesFilter = (rowStatus === window.currentStatusFilter);
            }

            const matchesSearch = (!window.currentSearchText || rowText.includes(window.currentSearchText));

            if (matchesFilter && matchesSearch) {
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
            countText.textContent = 'Showing ' + visible + ' of ' + rows.length + ' student concerns' + filterSuffix;
        }
    };

    function initKPIFiltering() {
        const rows = document.querySelectorAll('.concern-row');
        let total = rows.length;
        let pending = 0;
        let highPriority = 0;
        let activeCases = 0;

        rows.forEach(r => {
            const status = (r.getAttribute('data-status') || '').trim();
            const priority = (r.getAttribute('data-priority') || '').trim();

            if (status === 'Pending Review') pending++;
            if (priority === 'High Priority') highPriority++;
            if (status === 'Active Case') activeCases++;
        });

        const cAll = document.getElementById('count-all');
        const cPending = document.getElementById('count-pending');
        const cHigh = document.getElementById('count-high');
        const cActive = document.getElementById('count-active');

        if (cAll) cAll.textContent = total;
        if (cPending) cPending.textContent = pending;
        if (cHigh) cHigh.textContent = highPriority;
        if (cActive) cActive.textContent = activeCases;

        // Attach event listeners to all KPI cards
        const cards = document.querySelectorAll('.kpi-filter-card');
        cards.forEach(card => {
            card.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');
                window.applyStatusFilter(filter, this);
            });
            card.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const filter = this.getAttribute('data-filter');
                    window.applyStatusFilter(filter, this);
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