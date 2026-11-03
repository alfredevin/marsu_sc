<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT COUNSELING CASES       -->
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
                    <a href="<?= url('guidance/cases') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Case Management
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Student Counseling Cases
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Counseling Cases
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Monitor and manage student counseling records, clinical observation, and case progress.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <!-- Active Cases Notification Button -->
                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center gap-2"
                    id="top-notif-active"
                    onclick="applyStatusFilter('Active Cases', document.getElementById('kpi-card-active'))"
                    title="Click to filter active counseling cases"
                    style="height: 32px; padding: 0 12px; border-radius: 6px; font-size: 13px; font-weight: 500; background-color: #f0fdfa; color: #0d9488; border: 1px solid #99f6e4; white-space: nowrap;">
                    <i class="bi bi-activity"></i>
                    <span>Active Cases</span>
                    <span id="notif-active-count" class="badge text-white ms-1"
                        style="background-color: #0d9488; font-size: 11px; padding: 2px 7px; border-radius: 50rem;">
                        9
                    </span>
                </button>

                <!-- Under Observation Notification Button -->
                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center gap-2"
                    id="top-notif-observation"
                    onclick="applyStatusFilter('Under Observation', document.getElementById('kpi-card-observation'))"
                    title="Click to filter cases under observation"
                    style="height: 32px; padding: 0 12px; border-radius: 6px; font-size: 13px; font-weight: 500; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; white-space: nowrap;">
                    <i class="bi bi-eye-fill"></i>
                    <span>Under Observation</span>
                    <span id="notif-observation-count" class="badge text-white ms-1"
                        style="background-color: #d97706; font-size: 11px; padding: 2px 7px; border-radius: 50rem;">
                        3
                    </span>
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

    /* Left Border Indicators */
    .kpi-filter-card[data-filter="Active Cases"] {
        border-left: 4px solid #0d9488 !important;
    }

    .kpi-filter-card[data-filter="Priority Cases"] {
        border-left: 4px solid #dc2626 !important;
    }

    .kpi-filter-card[data-filter="In Progress"] {
        border-left: 4px solid #2563eb !important;
    }

    .kpi-filter-card[data-filter="Under Observation"] {
        border-left: 4px solid #d97706 !important;
    }

    .kpi-filter-card[data-filter="On-going Intervention"] {
        border-left: 4px solid #7c3aed !important;
    }

    .kpi-filter-card[data-filter="Closed Cases"] {
        border-left: 4px solid #475569 !important;
    }

    .kpi-filter-card[data-filter="all"] {
        border-left: 4px solid #800020 !important;
    }

    /* Active Highlight States */
    .kpi-filter-card.active[data-filter="Active Cases"] {
        border: 1px solid #0d9488 !important;
        border-left: 4px solid #0d9488 !important;
        box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.25), 0 4px 12px rgba(13, 148, 136, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="Priority Cases"] {
        border: 1px solid #dc2626 !important;
        border-left: 4px solid #dc2626 !important;
        box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.25), 0 4px 12px rgba(220, 38, 38, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="In Progress"] {
        border: 1px solid #2563eb !important;
        border-left: 4px solid #2563eb !important;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.25), 0 4px 12px rgba(37, 99, 235, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="Under Observation"] {
        border: 1px solid #d97706 !important;
        border-left: 4px solid #d97706 !important;
        box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.25), 0 4px 12px rgba(217, 119, 6, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="On-going Intervention"] {
        border: 1px solid #7c3aed !important;
        border-left: 4px solid #7c3aed !important;
        box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.25), 0 4px 12px rgba(124, 58, 237, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="Closed Cases"] {
        border: 1px solid #475569 !important;
        border-left: 4px solid #475569 !important;
        box-shadow: 0 0 0 2px rgba(71, 85, 105, 0.25), 0 4px 12px rgba(71, 85, 105, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="all"] {
        border: 1px solid #800020 !important;
        border-left: 4px solid #800020 !important;
        box-shadow: 0 0 0 2px rgba(128, 0, 32, 0.22), 0 4px 12px rgba(128, 0, 32, 0.10) !important;
    }
</style>

<!-- 2. REVISED CLICKABLE KPI CARDS (ACTIVE CASES, PRIORITY CASES, IN PROGRESS, UNDER OBSERVATION, ON-GOING INTERVENTION, CLOSED CASES, TOTAL CASES) -->
<!-- Row 1: Active Cases, Priority Cases, In Progress, Under Observation -->
<div class="row g-3 mb-3">
    <!-- Card 1: Active Cases -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-active" data-filter="Active Cases" onclick="applyStatusFilter('Active Cases', this)"
            role="button" tabindex="0" title="Click to filter active cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ACTIVE CASES
                    </div>
                    <div class="mt-1" id="count-active"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        9
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1;">
                    <i class="bi bi-person-check-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Ongoing counseling cases</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #0d9488; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Priority Cases -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-priority" data-filter="Priority Cases" onclick="applyStatusFilter('Priority Cases', this)"
            role="button" tabindex="0" title="Click to filter high priority cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PRIORITY CASES
                    </div>
                    <div class="mt-1" id="count-priority"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        5
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fef2f2; color: #dc2626; border: 1px solid #fee2e2;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>High severity cases</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #dc2626; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 3: In Progress -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-inprogress" data-filter="In Progress" onclick="applyStatusFilter('In Progress', this)"
            role="button" tabindex="0" title="Click to filter cases in progress">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        IN PROGRESS
                    </div>
                    <div class="mt-1" id="count-in-progress"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #eff6ff; color: #2563eb; border: 1px solid #dbeafe;">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Active counseling sessions</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #2563eb; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Under Observation -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-observation" data-filter="Under Observation"
            onclick="applyStatusFilter('Under Observation', this)" role="button" tabindex="0"
            title="Click to filter cases under observation">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        UNDER OBSERVATION
                    </div>
                    <div class="mt-1" id="count-observation"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a;">
                    <i class="bi bi-eye-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Post-session monitoring</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #d97706; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>
</div>

<!-- Row 2: On-going Intervention, Closed Cases, Total Cases -->
<div class="row g-3 mb-4">
    <!-- Card 5: On-going Intervention -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-intervention" data-filter="On-going Intervention"
            onclick="applyStatusFilter('On-going Intervention', this)" role="button" tabindex="0"
            title="Click to filter cases with ongoing intervention">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ON-GOING INTERVENTION
                    </div>
                    <div class="mt-1" id="count-intervention"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe;">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Structured intervention plan</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #7c3aed; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 6: Closed Cases -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-closed" data-filter="Closed Cases" onclick="applyStatusFilter('Closed Cases', this)"
            role="button" tabindex="0" title="Click to filter closed or resolved cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        CLOSED CASES
                    </div>
                    <div class="mt-1" id="count-closed"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                    <i class="bi bi-check-all"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span>Resolved &amp; closed records</span>
                <span class="badge kpi-indicator d-none"
                    style="background-color: #475569; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
            </div>
        </div>
    </div>

    <!-- Card 7: Total Cases -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card active"
            id="kpi-card-all" data-filter="all" onclick="applyStatusFilter('all', this)" role="button" tabindex="0"
            title="Click to view all cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL CASES
                    </div>
                    <div class="mt-1" id="count-total"
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
                <span>All registered case dossiers</span>
                <span class="badge kpi-indicator"
                    style="background-color: #800020; color: #fff; font-size: 11px; font-weight: 500;">Active</span>
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
                    <input type="text" id="caseSearchInput"
                        class="form-control border-start-0 shadow-none ps-2 bg-white"
                        placeholder="Search by Case Number, Student ID, Student Name, Concern Type, Priority, Status..."
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
                    All Cases
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

<!-- 4. STUDENT COUNSELING CASES LIST TABLE -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Case Number
                        </th>
                        <th class="text-nowrap bg-white"
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
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Priority
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Status
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Opened Date
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Opened Time
                        </th>
                        <th class="text-center pe-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; width: 135px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="casesTableBody" style="font-size: 14.5px;">

                    <!-- Case 1: RAMOS, CARLOS M. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-001" data-status="In Progress"
                        data-priority="Medium Priority" data-active="true" data-source="Concern">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-001
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Concern
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-01089
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">RAMOS, CARLOS M.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                In Progress
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">09:30 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-001"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 2: SANTOS, MARIA C. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-002" data-status="On-going Intervention"
                        data-priority="High Priority" data-active="true" data-source="Referral">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-002
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Referral
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-01042
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">SANTOS, MARIA C.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #8b5cf6; background-color: #f5f3ff; color: #6d28d9; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                On-going Intervention
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">01:30 PM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-002"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 3: MENDOZA, JUAN B. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-003" data-status="Under Observation"
                        data-priority="Low Priority" data-active="true" data-source="Concern">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-003
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Concern
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-00512
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">MENDOZA, JUAN B.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Career Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-arrow-down-circle-fill"></i>Low Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Under Observation
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 28, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">11:00 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-003"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 4: DELA CRUZ, BEA L. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-004" data-status="In Progress"
                        data-priority="High Priority" data-active="true" data-source="Referral">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-004
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Referral
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-03115
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">DELA CRUZ, BEA L.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Behavioral Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                In Progress
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 28, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">03:00 PM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-004"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 5: REYES, MARK ANTHONY -->
                    <tr class="case-row align-middle" data-case="CAS-2026-005" data-status="On-going Intervention"
                        data-priority="Medium Priority" data-active="true" data-source="Referral">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-005
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Referral
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-02194
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">REYES, MARK ANTHONY</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #8b5cf6; background-color: #f5f3ff; color: #6d28d9; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                On-going Intervention
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 27, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">10:00 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-005"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 6: GONZALES, ALYSSA P. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-006" data-status="Under Observation"
                        data-priority="High Priority" data-active="true" data-source="Concern">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-006
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Concern
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-01582
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">GONZALES, ALYSSA P.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Under Observation
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 27, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">02:00 PM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-006"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 7: BAUTISTA, KEVIN R. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-007" data-status="In Progress"
                        data-priority="High Priority" data-active="true" data-source="Referral">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-007
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Referral
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-03481
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">BAUTISTA, KEVIN R.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Family / Personal
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                In Progress
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 26, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">08:30 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-007"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 8: VILLANUEVA, PATRICIA M. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-008" data-status="Resolved"
                        data-priority="Low Priority" data-active="false" data-source="Case Registration">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-008
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Case Registration
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-04129
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">VILLANUEVA, PATRICIA M.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Career Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-arrow-down-circle-fill"></i>Low Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #10b981; background-color: #ecfdf5; color: #047857; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Resolved
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 25, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">11:30 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-008"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 9: AQUINO, CHRISTIAN J. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-009" data-status="On-going Intervention"
                        data-priority="Medium Priority" data-active="true" data-source="Case Registration">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-009
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Case Registration
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-00871
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">AQUINO, CHRISTIAN J.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #8b5cf6; background-color: #f5f3ff; color: #6d28d9; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                On-going Intervention
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 24, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">01:30 PM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-009"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 10: CASTRO, DIANA MAE -->
                    <tr class="case-row align-middle" data-case="CAS-2026-010" data-status="Under Observation"
                        data-priority="High Priority" data-active="true" data-source="Referral">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-010
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Referral
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2022-01934
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">CASTRO, DIANA MAE</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Emotional / Psychological
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-exclamation-circle-fill"></i>High Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Under Observation
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 23, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">03:30 PM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-010"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 11: FLORES, GABRIEL S. -->
                    <tr class="case-row align-middle" data-case="CAS-2026-011" data-status="Closed"
                        data-priority="Medium Priority" data-active="false" data-source="Referral">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-011
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Referral
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2023-03712
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">FLORES, GABRIEL S.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Behavioral Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-dash-circle-fill"></i>Medium Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #64748b; background-color: #f8fafc; color: #334155; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Closed
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 22, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">09:00 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-011"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="Manage Case" aria-label="Manage Case"
                                style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                                Manage Case
                            </a>
                        </td>
                    </tr>

                    <!-- Case 12: TAN, JUSTINE CHLOE -->
                    <tr class="case-row align-middle" data-case="CAS-2026-012" data-status="Resolved"
                        data-priority="Low Priority" data-active="false" data-source="Case Registration">
                        <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                            <div class="fw-bold"
                                style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                                CAS-2026-012
                            </div>
                            <div class="mt-1">
                                <span class="badge"
                                    style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">
                                    From Case Registration
                                </span>
                            </div>
                        </td>
                        <td class="fw-bold text-nowrap"
                            style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                            2024-02205
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="fw-bold text-dark">TAN, JUSTINE CHLOE</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                                Academic Concern
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span
                                style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-arrow-down-circle-fill"></i>Low Priority
                            </span>
                        </td>
                        <td class="text-center text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="case-status-badge"
                                style="border: 1px solid #10b981; background-color: #ecfdf5; color: #047857; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">
                                Resolved
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-dark fw-medium">Oct 21, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <span class="text-secondary fw-medium">10:30 AM</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap"
                            style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                            <a href="<?= url('guidance/case_view') ?>?case=CAS-2026-012"
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
                                <h6 class="fw-bold text-dark mb-1">No matching student counseling cases found</h6>
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
                Showing 12 of 12 student counseling cases
            </div>
            <div>
                <nav aria-label="Cases pagination">
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

<!-- 5. MANAGE CASE MODAL -->
<div class="modal fade" id="manageCaseModal" tabindex="-1" aria-labelledby="manageCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white" style="background-color: #800020; padding: 18px 24px;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-folder-check fs-5"></i>
                    <h5 class="modal-title fw-bold mb-0" id="manageCaseModalLabel" style="font-size: 18px;">
                        Manage Counseling Case &bull; <span id="modalCaseNumber">CAS-2026-001</span>
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <!-- Student Summary Banner -->
                <div class="card border-0 shadow-sm p-3 mb-4 bg-white"
                    style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
                    <div class="row g-2" style="font-size: 14px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted">Student Name:</span>
                            <strong class="text-dark ms-1" id="modalStudentName">RAMOS, CARLOS M.</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted">Student ID:</span>
                            <strong class="text-dark ms-1" id="modalStudentId">2023-01089</strong>
                        </div>
                        <div class="col-md-6 col-12 pt-1">
                            <span class="text-muted">Concern Type:</span>
                            <span class="badge bg-light text-dark border ms-1" id="modalConcernType">Academic
                                Concern</span>
                        </div>
                        <div class="col-md-6 col-12 pt-1">
                            <span class="text-muted">Opened Date:</span>
                            <strong class="text-dark ms-1" id="modalOpenedDateTime">Oct 29, 2026 • 09:30 AM</strong>
                        </div>
                    </div>
                </div>

                <form id="manageCaseForm" onsubmit="handleSaveCase(event);">
                    <!-- Row 1: Case Status & Priority Level -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                                Case Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select bg-white shadow-none" id="modalCaseStatusSelect" required
                                style="height: 44px; border-color: #CBD5E1; font-size: 14px; border-radius: 8px;">
                                <option value="In Progress">In Progress (Active Sessions)</option>
                                <option value="Under Observation">Under Observation (Post-Consultation)</option>
                                <option value="On-going Intervention">On-going Intervention (Therapy / Plan)</option>
                                <option value="Resolved">Resolved (Goals Accomplished)</option>
                                <option value="Closed">Closed (Concluded / Inactive)</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                                Priority Level <span class="text-danger">*</span>
                            </label>
                            <select class="form-select bg-white shadow-none" id="modalCasePrioritySelect" required
                                style="height: 44px; border-color: #CBD5E1; font-size: 14px; border-radius: 8px;">
                                <option value="High Priority">High Priority (Urgent)</option>
                                <option value="Medium Priority">Medium Priority (Standard)</option>
                                <option value="Low Priority">Low Priority (Routine)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 2: Assigned Counselor -->
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                                Assigned Guidance Counselor
                            </label>
                            <input type="text" class="form-control bg-white shadow-none" id="modalAssignedCounselor"
                                value="Dr. Elena Santos, RGC" readonly
                                style="height: 44px; border-color: #CBD5E1; font-size: 14px; border-radius: 8px;">
                        </div>
                    </div>

                    <!-- Row 3: Progress & Clinical Notes -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                            Case Clinical Assessment &amp; Action Notes
                        </label>
                        <textarea class="form-control bg-white shadow-none" id="modalCaseNotes" rows="3"
                            style="border-color: #CBD5E1; font-size: 14px; border-radius: 8px;"
                            placeholder="Enter case progress updates, counseling interventions conducted, or referral recommendations..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top"
                        style="border-color: #E2E8F0 !important;">
                        <a href="<?= url('guidance/case_registration') ?>" class="text-decoration-none fw-semibold"
                            style="color: #800020; font-size: 13.5px;">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Go to Case Registration
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-secondary shadow-none" data-bs-dismiss="modal"
                                style="height: 40px; padding: 0 18px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                Cancel
                            </button>
                            <button type="submit"
                                class="btn text-white shadow-none d-inline-flex align-items-center gap-2"
                                style="background-color: #800020; border: 1px solid #800020; height: 40px; padding: 0 20px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                <i class="bi bi-check2-circle"></i>Save &amp; Update Case
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    window.currentStatusFilter = 'all';
    window.currentSearchText = '';
    window.activeModalRow = null;

    window.applyStatusFilter = function (filterKey, element) {
        window.currentStatusFilter = filterKey;

        // Reset visual active class on KPI cards
        const allCards = document.querySelectorAll('.kpi-filter-card');
        allCards.forEach(c => {
            c.classList.remove('active');
            const indicator = c.querySelector('.kpi-indicator');
            if (indicator) indicator.classList.add('d-none');
        });

        // Set active on matching card
        if (element) {
            element.classList.add('active');
            const ind = element.querySelector('.kpi-indicator');
            if (ind) ind.classList.remove('d-none');
        } else {
            const matchCard = document.querySelector('.kpi-filter-card[data-filter="' + filterKey + '"]');
            if (matchCard) {
                matchCard.classList.add('active');
                const ind = matchCard.querySelector('.kpi-indicator');
                if (ind) ind.classList.remove('d-none');
            }
        }

        // Update badge and reset button
        const badge = document.getElementById('activeFilterBadge');
        const resetBtn = document.getElementById('resetFilterBtn');

        if (badge) {
            badge.style = '';
            if (filterKey === 'all') {
                badge.textContent = 'All Cases';
                badge.className = 'badge text-dark bg-light border d-inline-flex align-items-center py-2 px-3';
            } else if (filterKey === 'Active Cases') {
                badge.textContent = 'Active Cases';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f0fdfa';
                badge.style.color = '#0f766e';
                badge.style.border = '1px solid #0d9488';
            } else if (filterKey === 'Priority Cases') {
                badge.textContent = 'Priority Cases';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#fef2f2';
                badge.style.color = '#991b1b';
                badge.style.border = '1px solid #dc2626';
            } else if (filterKey === 'In Progress') {
                badge.textContent = 'In Progress';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#eff6ff';
                badge.style.color = '#1d4ed8';
                badge.style.border = '1px solid #2563eb';
            } else if (filterKey === 'Under Observation') {
                badge.textContent = 'Under Observation';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#fffbeb';
                badge.style.color = '#92400e';
                badge.style.border = '1px solid #d97706';
            } else if (filterKey === 'On-going Intervention') {
                badge.textContent = 'On-going Intervention';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f5f3ff';
                badge.style.color = '#6d28d9';
                badge.style.border = '1px solid #7c3aed';
            } else if (filterKey === 'Closed Cases') {
                badge.textContent = 'Closed Cases';
                badge.className = 'badge d-inline-flex align-items-center py-2 px-3';
                badge.style.backgroundColor = '#f8fafc';
                badge.style.color = '#334155';
                badge.style.border = '1px solid #475569';
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
        const searchInput = document.getElementById('caseSearchInput');
        if (searchInput) searchInput.value = '';
        window.currentSearchText = '';
        window.applyStatusFilter('all');
    };

    window.filterTable = function () {
        const rows = document.querySelectorAll('.case-row');
        let visible = 0;

        rows.forEach(row => {
            const rowStatus = (row.getAttribute('data-status') || '').trim();
            const rowPriority = (row.getAttribute('data-priority') || '').trim();
            const rowActive = (row.getAttribute('data-active') || '').trim();
            const rowText = (row.textContent || '').toLowerCase();

            let matchesFilter = false;
            if (window.currentStatusFilter === 'all') {
                matchesFilter = true;
            } else if (window.currentStatusFilter === 'Active Cases') {
                matchesFilter = (rowActive === 'true');
            } else if (window.currentStatusFilter === 'Priority Cases') {
                matchesFilter = (rowPriority === 'High Priority');
            } else if (window.currentStatusFilter === 'Closed Cases') {
                matchesFilter = (rowStatus === 'Closed' || rowStatus === 'Resolved');
            } else {
                matchesFilter = (rowStatus.toLowerCase() === window.currentStatusFilter.toLowerCase());
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
            countText.textContent = 'Showing ' + visible + ' of ' + rows.length + ' student counseling cases' + filterSuffix;
        }
    };

    window.openManageCaseModal = function (caseNum, studentName, studentId, concernType, priority, status, openedDateTime) {
        document.getElementById('modalCaseNumber').textContent = caseNum;
        document.getElementById('modalStudentName').textContent = studentName;
        document.getElementById('modalStudentId').textContent = studentId;
        document.getElementById('modalConcernType').textContent = concernType;
        document.getElementById('modalOpenedDateTime').textContent = openedDateTime;

        const statusSel = document.getElementById('modalCaseStatusSelect');
        if (statusSel) statusSel.value = status;

        const priorSel = document.getElementById('modalCasePrioritySelect');
        if (priorSel) priorSel.value = priority;

        // Remember clicked row
        const rows = document.querySelectorAll('.case-row');
        rows.forEach(r => {
            if (r.getAttribute('data-case') === caseNum) {
                window.activeModalRow = r;
            }
        });

        const modalEl = document.getElementById('manageCaseModal');
        if (modalEl) {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    };

    window.handleSaveCase = function (e) {
        e.preventDefault();
        const newStatus = document.getElementById('modalCaseStatusSelect').value;
        const newPriority = document.getElementById('modalCasePrioritySelect').value;
        const caseNum = document.getElementById('modalCaseNumber').textContent;

        if (window.activeModalRow) {
            window.activeModalRow.setAttribute('data-status', newStatus);
            window.activeModalRow.setAttribute('data-priority', newPriority);

            const isActive = (newStatus === 'In Progress' || newStatus === 'Under Observation' || newStatus === 'On-going Intervention');
            window.activeModalRow.setAttribute('data-active', isActive ? 'true' : 'false');

            // Update badge in table row
            const badge = window.activeModalRow.querySelector('.case-status-badge');
            if (badge) {
                badge.textContent = newStatus;
                badge.style = '';
                if (newStatus === 'In Progress') {
                    badge.style = 'border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;';
                } else if (newStatus === 'Under Observation') {
                    badge.style = 'border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;';
                } else if (newStatus === 'On-going Intervention') {
                    badge.style = 'border: 1px solid #8b5cf6; background-color: #f5f3ff; color: #6d28d9; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;';
                } else if (newStatus === 'Resolved') {
                    badge.style = 'border: 1px solid #10b981; background-color: #ecfdf5; color: #047857; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;';
                } else if (newStatus === 'Closed') {
                    badge.style = 'border: 1px solid #64748b; background-color: #f8fafc; color: #334155; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;';
                }
            }
        }

        // Recalculate KPIs
        initKPIFiltering();
        window.filterTable();

        const modalEl = document.getElementById('manageCaseModal');
        if (modalEl) {
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }

        alert('Case ' + caseNum + ' updated successfully to ' + newStatus + ' (' + newPriority + ')!');
    };

    function loadRegisteredCasesFromStorage() {
        try {
            const stored = JSON.parse(localStorage.getItem('marsu_registered_cases') || '[]');
            if (!stored || !stored.length) return;

            const tbody = document.getElementById('casesTableBody');
            if (!tbody) return;

            // Render each registered case in reverse so newest is at the very top
            stored.slice().reverse().forEach(c => {
                if (document.querySelector(`tr[data-case="${c.case_id}"]`)) return;

                let priorityBadge = '';
                if ((c.priority || '').includes('High')) {
                    priorityBadge = '<span style="border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;"><i class="bi bi-exclamation-circle-fill"></i>High Priority</span>';
                } else if ((c.priority || '').includes('Low')) {
                    priorityBadge = '<span style="border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;"><i class="bi bi-arrow-down-circle-fill"></i>Low Priority</span>';
                } else {
                    priorityBadge = '<span style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; font-weight: 600; font-size: 12.5px; padding: 3px 12px; display: inline-flex; align-items: center; gap: 5px;"><i class="bi bi-dash-circle-fill"></i>Medium Priority</span>';
                }

                let statusBadge = '';
                let isActive = 'true';
                if (c.status === 'In Progress') {
                    statusBadge = '<span class="case-status-badge" style="border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">In Progress</span>';
                } else if (c.status === 'Under Observation') {
                    statusBadge = '<span class="case-status-badge" style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">Under Observation</span>';
                } else if (c.status === 'On-going Intervention') {
                    statusBadge = '<span class="case-status-badge" style="border: 1px solid #8b5cf6; background-color: #f5f3ff; color: #6d28d9; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">On-going Intervention</span>';
                } else if (c.status === 'Closed') {
                    isActive = 'false';
                    statusBadge = '<span class="case-status-badge" style="border: 1px solid #64748b; background-color: #f8fafc; color: #334155; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">Closed</span>';
                } else if (c.status === 'Resolved') {
                    isActive = 'false';
                    statusBadge = '<span class="case-status-badge" style="border: 1px solid #22c55e; background-color: #f0fdf4; color: #15803d; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">Resolved</span>';
                } else {
                    isActive = 'false';
                    statusBadge = '<span class="case-status-badge" style="border: 1px solid #0d9488; background-color: #f0fdfa; color: #0f766e; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px; padding: 2px 14px;">Referred to Other Office</span>';
                }

                let sourceBadge = '';
                let dataSource = 'Case Registration';
                if (c.source === 'Referral') {
                    dataSource = 'Referral';
                    sourceBadge = '<span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">From Referral</span>';
                } else {
                    sourceBadge = '<span class="badge" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.2px;">From Case Registration</span>';
                }

                const tr = document.createElement('tr');
                tr.className = 'case-row align-middle';
                tr.setAttribute('data-case', c.case_id);
                tr.setAttribute('data-status', c.status);
                tr.setAttribute('data-priority', c.priority);
                tr.setAttribute('data-active', isActive);
                tr.setAttribute('data-source', dataSource);

                tr.innerHTML = `
                    <td class="ps-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle;">
                        <div class="fw-bold" style="color: #800020 !important; font-size: 14.5px; line-height: 1.2;">
                            ${c.case_id}
                        </div>
                        <div class="mt-1">
                            ${sourceBadge}
                        </div>
                    </td>
                    <td class="fw-bold text-nowrap" style="padding: 14px 18px; color: #1A202C !important; vertical-align: middle; line-height: 2.0;">
                        ${c.student_id}
                    </td>
                    <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        <span class="fw-bold text-dark">${c.student_name}</span>
                    </td>
                    <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        <span style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; font-weight: 600; font-size: 13px; padding: 3px 10px; display: inline-block; line-height: 1.5;">
                            ${c.concern_type}
                        </span>
                    </td>
                    <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        ${priorityBadge}
                    </td>
                    <td class="text-center text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        ${statusBadge}
                    </td>
                    <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        <span class="text-dark fw-medium">${c.opened_date}</span>
                    </td>
                    <td class="text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        <span class="text-secondary fw-medium">${c.opened_time}</span>
                    </td>
                    <td class="text-center pe-4 text-nowrap" style="padding: 14px 18px; vertical-align: middle; line-height: 2.0;">
                        <a href="<?= url('guidance/case_view') ?>?case=${encodeURIComponent(c.case_id)}"
                            class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                            title="Manage Case" aria-label="Manage Case"
                            style="height: 32px; padding: 0 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; white-space: nowrap;">
                            Manage Case
                        </a>
                    </td>
                `;

                tbody.insertBefore(tr, tbody.firstChild);
            });
        } catch (e) {
            console.error('Error loading registered cases:', e);
        }
    }

    function initKPIFiltering() {
        loadRegisteredCasesFromStorage();

        const rows = document.querySelectorAll('.case-row');
        let total = rows.length;
        let active = 0, priority = 0, inProgress = 0, observation = 0, intervention = 0, closed = 0;

        rows.forEach(r => {
            const status = (r.getAttribute('data-status') || '').trim();
            const prio = (r.getAttribute('data-priority') || '').trim();
            const isActive = (r.getAttribute('data-active') || '').trim();

            if (isActive === 'true') active++;
            if (prio === 'High Priority') priority++;
            if (status === 'In Progress') inProgress++;
            if (status === 'Under Observation') observation++;
            if (status === 'On-going Intervention') intervention++;
            if (status === 'Closed' || status === 'Resolved') closed++;
        });

        const cActive = document.getElementById('count-active');
        const cPriority = document.getElementById('count-priority');
        const cInProgress = document.getElementById('count-in-progress');
        const cObservation = document.getElementById('count-observation');
        const cIntervention = document.getElementById('count-intervention');
        const cClosed = document.getElementById('count-closed');
        const cTotal = document.getElementById('count-total');

        if (cActive) cActive.textContent = active;
        if (cPriority) cPriority.textContent = priority;
        if (cInProgress) cInProgress.textContent = inProgress;
        if (cObservation) cObservation.textContent = observation;
        if (cIntervention) cIntervention.textContent = intervention;
        if (cClosed) cClosed.textContent = closed;
        if (cTotal) cTotal.textContent = total;

        const notifObs = document.getElementById('notif-observation-count');
        const notifAct = document.getElementById('notif-active-count');
        if (notifObs) notifObs.textContent = observation;
        if (notifAct) notifAct.textContent = active;

        // Attach event listeners to all KPI cards
        const cards = document.querySelectorAll('.kpi-filter-card');
        cards.forEach(card => {
            card.onclick = function () {
                const filter = this.getAttribute('data-filter');
                window.applyStatusFilter(filter, this);
            };
            card.onkeydown = function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const filter = this.getAttribute('data-filter');
                    window.applyStatusFilter(filter, this);
                }
            };
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