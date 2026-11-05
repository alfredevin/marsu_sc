<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: CENTRAL DASHBOARD              -->
<!-- ==================================================================== -->

<style>
    /* 1. EXACT KPI CARD DESIGN MATCHING APPOINTMENT LISTS */
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

    .kpi-filter-card[data-kpi="students"] {
        border-left: 4px solid #800020 !important;
    }

    .kpi-filter-card[data-kpi="cases"] {
        border-left: 4px solid #2563EB !important;
    }

    .kpi-filter-card[data-kpi="completed"] {
        border-left: 4px solid #28a745 !important;
    }

    .kpi-filter-card[data-kpi="satisfaction"] {
        border-left: 4px solid #d97706 !important;
    }

    /* 2. CHART CARDS WITH CLEAN FOOTERS */
    .chart-card {
        border: 1px solid #E2E8F0 !important;
        border-radius: 10px;
        background-color: #ffffff;
        overflow: hidden;
        transition: box-shadow 0.18s ease-in-out;
    }

    .chart-card:hover {
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
    }

    .chart-container {
        position: relative;
        height: 260px;
        width: 100%;
    }

    .chart-view-link {
        color: #800020;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: color 0.15s ease, transform 0.15s ease;
    }

    .chart-view-link:hover {
        color: #550015;
        text-decoration: underline;
    }

    .chart-view-link i {
        transition: transform 0.15s ease;
    }

    .chart-view-link:hover i {
        transform: translateX(3px);
    }
</style>

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
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Guidance &amp; Counseling Central Dashboard
                </h4>
                <p class="text-muted mb-0" style="font-size: 14.5px; line-height: 1.5;">
                    Centralized telemetry monitoring of registered students, counseling cases, priority distributions,
                    and department metrics.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge"
                    style="background-color: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; font-size: 12.5px; padding: 9px 14px; font-weight: 600; border-radius: 6px;">
                    <i class="bi bi-calendar3 me-1.5 text-primary"></i>A.Y. 2026-2027 &bull; 1st Semester
                </span>
            </div>
        </div>
    </div>
</div>

<!-- 2. MINIMALISTIC & ORGANIZED FILTERING TOOLBAR -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <!-- Filter 1: Department / College -->
            <div class="col-lg-4 col-md-4 col-12">
                <label class="form-label text-muted fw-semibold small mb-1">
                    <i class="bi bi-building me-1 text-primary"></i>Department / College:
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-2.5 pe-2"
                        style="border-color: #CBD5E1;">
                        <i class="bi bi-building"></i>
                    </span>
                    <select id="departmentFilter" class="form-select border-start-0 shadow-none ps-1"
                        onchange="handleDepartmentChange()"
                        style="height: 38px; font-size: 13.5px; border-color: #CBD5E1; font-weight: 500;">
                        <option value="all" selected>All Colleges (MarSU Campus)</option>
                        <option value="CAS">CAS - College of Arts and Sciences</option>
                        <option value="CICT">CICT - College of Information and Computing Sciences</option>
                        <option value="CBA">CBA - College of Business and Accountancy</option>
                        <option value="CEA">CEA - College of Engineering and Architecture</option>
                        <option value="CED">CED - College of Education</option>
                        <option value="CNHS">CNHS - College of Nursing and Health Sciences</option>
                        <option value="CAFES">CAFES - College of Agriculture, Forestry and Environmental Sciences
                        </option>
                    </select>
                </div>
            </div>

            <!-- Filter 2: Academic Program (Dynamically Populated) -->
            <div class="col-lg-4 col-md-4 col-12">
                <label class="form-label text-muted fw-semibold small mb-1">
                    <i class="bi bi-mortarboard me-1 text-success"></i>Academic Program:
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-2.5 pe-2"
                        style="border-color: #CBD5E1;">
                        <i class="bi bi-mortarboard"></i>
                    </span>
                    <select id="programFilter" class="form-select border-start-0 shadow-none ps-1"
                        onchange="applyAllFilters()"
                        style="height: 38px; font-size: 13.5px; border-color: #CBD5E1; font-weight: 500;">
                        <option value="all" selected>All Academic Programs</option>
                    </select>
                </div>
            </div>

            <!-- Filter 3: Year Level -->
            <div class="col-lg-3 col-md-3 col-sm-8 col-12">
                <label class="form-label text-muted fw-semibold small mb-1">
                    <i class="bi bi-calendar-event me-1 text-warning"></i>Year Level:
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-2.5 pe-2"
                        style="border-color: #CBD5E1;">
                        <i class="bi bi-calendar2-week"></i>
                    </span>
                    <select id="yearLevelFilter" class="form-select border-start-0 shadow-none ps-1"
                        onchange="applyAllFilters()"
                        style="height: 38px; font-size: 13.5px; border-color: #CBD5E1; font-weight: 500;">
                        <option value="all" selected>All Year Levels</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>
            </div>

            <!-- Filter Reset Action -->
            <div class="col-lg-1 col-md-1 col-sm-4 col-12 text-md-end text-start pt-md-4 pt-1">
                <button type="button"
                    class="btn btn-outline-secondary w-100 shadow-none d-inline-flex align-items-center justify-content-center"
                    onclick="resetDashboardFilters()" title="Reset all filters to campus-wide view"
                    style="height: 38px; font-size: 13px; border-radius: 6px; font-weight: 500; border-color: #CBD5E1;">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 3. KPI CARDS (MATCHING APPOINTMENT LISTS DESIGN & CLEAN SPACING) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Students Registered -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            data-kpi="students" onclick="window.location.href='<?= url('guidance/student_directory') ?>'" role="button"
            tabindex="0" title="Click to view student directory records">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL STUDENTS REGISTERED
                    </div>
                    <div class="mt-1" id="kpiTotalStudents"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        1,450
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span id="kpiStudentsSubtitle">Enrolled directory profiles</span>
                <span class="badge"
                    style="background-color: #800020; color: #fff; font-size: 11px; font-weight: 500;">Directory</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Cases -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            data-kpi="cases" onclick="window.location.href='<?= url('guidance/cases') ?>'" role="button" tabindex="0"
            title="Click to view all counseling cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL CASES
                    </div>
                    <div class="mt-1" id="kpiTotalCases"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        342
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #EFF6FF; color: #2563EB; border: 1px solid #BFDBFE;">
                    <i class="bi bi-journal-medical"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span id="kpiCasesSubtitle">Active &amp; resolved cases</span>
                <span class="badge"
                    style="background-color: #2563EB; color: #fff; font-size: 11px; font-weight: 500;">Cases</span>
            </div>
        </div>
    </div>

    <!-- Card 3: Completed Cases -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            data-kpi="completed" onclick="window.location.href='<?= url('guidance/cases') ?>'" role="button"
            tabindex="0" title="Click to filter resolved and completed cases">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        COMPLETED CASES
                    </div>
                    <div class="mt-1" id="kpiCompletedCases"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        286
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span id="kpiCompletedSubtitle">83.6% resolution rate</span>
                <span class="badge"
                    style="background-color: #28a745; color: #fff; font-size: 11px; font-weight: 500;">Resolved</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Satisfaction Score -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            data-kpi="satisfaction" onclick="window.location.href='<?= url('guidance/feedbacks') ?>'" role="button"
            tabindex="0" title="Click to view student evaluation feedbacks">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        SATISFACTION SCORE
                    </div>
                    <div class="mt-1" id="kpiSatisfactionScore"
                        style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        4.8 / 5.0
                    </div>
                </div>
                <div
                    style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FFFDF0; color: #d97706; border: 1px solid #FDE68A;">
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
            <div class="mt-2 text-muted d-flex align-items-center justify-content-between" style="font-size: 13px;">
                <span id="kpiSatisfactionSubtitle">96.4% student rating</span>
                <span class="badge"
                    style="background-color: #d97706; color: #fff; font-size: 11px; font-weight: 500;">Feedback</span>
            </div>
        </div>
    </div>
</div>

<!-- 4. CONNECTED GRAPHS & CHARTS SECTION (WITH "VIEW ALL DETAILS" LINK PER GRAPH) -->
<div class="row g-4 mb-4">
    <!-- Chart 1: Donut Graph for Cases by Department -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm chart-card h-100 d-flex flex-column justify-content-between">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
                style="border-bottom: 1px solid #E2E8F0;">
                <div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
                        <i class="bi bi-pie-chart-fill me-2" style="color: #800020;"></i>Cases by Department / College
                    </h6>
                    <small class="text-muted">Donut visualization showing departments with the highest case
                        volume</small>
                </div>
                <span class="badge" id="deptTopBadge"
                    style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 11.5px;">
                    Highest: CAS (84 Cases)
                </span>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center flex-grow-1">
                <div class="chart-container">
                    <canvas id="chartDepartmentCases"></canvas>
                </div>
            </div>
            <!-- View All Details Footer Link -->
            <div class="card-footer bg-white py-2.5 px-4 d-flex justify-content-between align-items-center"
                style="border-top: 1px solid #E2E8F0;">
                <span class="text-muted small">Comprehensive college distribution metrics</span>
                <a href="<?= url('guidance/analytics_reports') ?>"
                    class="chart-view-link d-inline-flex align-items-center"
                    title="View analytical case progress report">
                    View All Details <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Chart 2: Gender Distribution (Donut Graph with Prefer not to say) -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm chart-card h-100 d-flex flex-column justify-content-between">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
                style="border-bottom: 1px solid #E2E8F0;">
                <div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
                        <i class="bi bi-gender-ambiguous me-2" style="color: #2563EB;"></i>Client Gender Distribution
                    </h6>
                    <small class="text-muted">Proportion of Female, Male, and Prefer not to say students</small>
                </div>
                <span class="badge bg-light text-secondary border" id="genderRatioBadge" style="font-size: 11.5px;">
                    57.9% F &bull; 38.6% M &bull; 3.5% Other
                </span>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center flex-grow-1">
                <div class="chart-container">
                    <canvas id="chartGenderDistribution"></canvas>
                </div>
            </div>
            <!-- View All Details Footer Link -->
            <div class="card-footer bg-white py-2.5 px-4 d-flex justify-content-between align-items-center"
                style="border-top: 1px solid #E2E8F0;">
                <span class="text-muted small">Demographic client rosters &amp; profiles</span>
                <a href="<?= url('guidance/student_directory') ?>"
                    class="chart-view-link d-inline-flex align-items-center" title="View student directory records">
                    View All Details <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Chart 3: Case Priority Levels Breakdown (Vertical Bar Chart) -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm chart-card h-100 d-flex flex-column justify-content-between">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
                style="border-bottom: 1px solid #E2E8F0;">
                <div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
                        <i class="bi bi-bar-chart-fill me-2 text-warning"></i>Case Priority Level Breakdown
                    </h6>
                    <small class="text-muted">Urgent, High, Medium, and Low clinical triage classifications</small>
                </div>
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle" id="urgentCasesBadge"
                    style="font-size: 11.5px;">
                    28 Urgent Cases
                </span>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center flex-grow-1">
                <div class="chart-container">
                    <canvas id="chartPriorityBreakdown"></canvas>
                </div>
            </div>
            <!-- View All Details Footer Link -->
            <div class="card-footer bg-white py-2.5 px-4 d-flex justify-content-between align-items-center"
                style="border-top: 1px solid #E2E8F0;">
                <span class="text-muted small">Active cases and triage management</span>
                <a href="<?= url('guidance/cases') ?>" class="chart-view-link d-inline-flex align-items-center"
                    title="View case records & priority queue">
                    View All Details <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Chart 4: Concern Categories Breakdown (Horizontal Bar Chart) -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm chart-card h-100 d-flex flex-column justify-content-between">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
                style="border-bottom: 1px solid #E2E8F0;">
                <div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
                        <i class="bi bi-tags-fill me-2 text-success"></i>Concern Categories Distribution
                    </h6>
                    <small class="text-muted">Volume of student cases categorized by standardized concern types</small>
                </div>
                <span class="badge"
                    style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; font-size: 11.5px;"
                    id="concernTopBadge">
                    Top: Academic (112)
                </span>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center flex-grow-1">
                <div class="chart-container">
                    <canvas id="chartConcernCategories"></canvas>
                </div>
            </div>
            <!-- View All Details Footer Link -->
            <div class="card-footer bg-white py-2.5 px-4 d-flex justify-content-between align-items-center"
                style="border-top: 1px solid #E2E8F0;">
                <span class="text-muted small">Standardized concern records and reports</span>
                <a href="<?= url('guidance/analytics_reports') ?>"
                    class="chart-view-link d-inline-flex align-items-center" title="View student concern report">
                    View All Details <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   VANILLA JAVASCRIPT: CONNECTED TELEMETRY & MULTI-FILTER ENGINE      -->
<!-- ==================================================================== -->
<script>
    // 1. Academic Programs Directory by College
    const programsByCollege = {
        all: [
            { code: "all", name: "All Academic Programs" },
            { code: "BaPOS", name: "BA Political Science" },
            { code: "BAComm", name: "BA Communication" },
            { code: "BSBio", name: "BS Biology" },
            { code: "BSMath", name: "BS Mathematics" },
            { code: "BSIT", name: "BS Information Technology" },
            { code: "BSIS", name: "BS Information Systems" },
            { code: "BSCS", name: "BS Computer Science" },
            { code: "BSBA", name: "BS Business Administration" },
            { code: "BSA", name: "BS Accountancy" },
            { code: "BSTM", name: "BS Tourism Management" },
            { code: "BSHM", name: "BS Hospitality Management" },
            { code: "BSCE", name: "BS Civil Engineering" },
            { code: "BSEE", name: "BS Electrical Engineering" },
            { code: "BSME", name: "BS Mechanical Engineering" },
            { code: "BSArch", name: "BS Architecture" },
            { code: "BEED", name: "Bachelor of Elementary Education (BEED)" },
            { code: "BSED", name: "Bachelor of Secondary Education (BSED)" },
            { code: "BPED", name: "Bachelor of Physical Education (BPED)" },
            { code: "BSN", name: "BS Nursing" },
            { code: "BSMid", name: "BS Midwifery" },
            { code: "BSAgri", name: "BS Agriculture" },
            { code: "BSForestry", name: "BS Forestry" },
            { code: "BSEnvSci", name: "BS Environmental Science" }
        ],
        CAS: [
            { code: "all", name: "All CAS Programs" },
            { code: "BaPOS", name: "BA Political Science" },
            { code: "BAComm", name: "BA Communication" },
            { code: "BSBio", name: "BS Biology" },
            { code: "BSMath", name: "BS Mathematics" }
        ],
        CICT: [
            { code: "all", name: "All CICT Programs" },
            { code: "BSIT", name: "BS Information Technology" },
            { code: "BSIS", name: "BS Information Systems" },
            { code: "BSCS", name: "BS Computer Science" }
        ],
        CBA: [
            { code: "all", name: "All CBA Programs" },
            { code: "BSBA", name: "BS Business Administration" },
            { code: "BSA", name: "BS Accountancy" },
            { code: "BSTM", name: "BS Tourism Management" },
            { code: "BSHM", name: "BS Hospitality Management" }
        ],
        CEA: [
            { code: "all", name: "All CEA Programs" },
            { code: "BSCE", name: "BS Civil Engineering" },
            { code: "BSEE", name: "BS Electrical Engineering" },
            { code: "BSME", name: "BS Mechanical Engineering" },
            { code: "BSArch", name: "BS Architecture" }
        ],
        CED: [
            { code: "all", name: "All CED Programs" },
            { code: "BEED", name: "Bachelor of Elementary Education (BEED)" },
            { code: "BSED", name: "Bachelor of Secondary Education (BSED)" },
            { code: "BPED", name: "Bachelor of Physical Education (BPED)" }
        ],
        CNHS: [
            { code: "all", name: "All CNHS Programs" },
            { code: "BSN", name: "BS Nursing" },
            { code: "BSMid", name: "BS Midwifery" }
        ],
        CAFES: [
            { code: "all", name: "All CAFES Programs" },
            { code: "BSAgri", name: "BS Agriculture" },
            { code: "BSForestry", name: "BS Forestry" },
            { code: "BSEnvSci", name: "BS Environmental Science" }
        ]
    };

    // 2. Base College Telemetry Dataset (Front-End Data)
    const collegeTelemetryData = {
        all: {
            students: 1450,
            totalCases: 342,
            completedCases: 286,
            satisfactionScore: "4.8 / 5.0",
            satisfactionPercent: "96.4%",
            deptCases: {
                labels: ['CAS', 'CICT', 'CBA', 'CEA', 'CED', 'CNHS', 'CAFES'],
                data: [84, 68, 56, 48, 42, 26, 18],
                topLabel: 'Highest: CAS (84 Cases)'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [198, 132, 12],
                ratioText: '57.9% F • 38.6% M • 3.5% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [28, 86, 144, 84],
                urgentText: '28 Urgent Cases'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [112, 94, 52, 38, 24, 14, 8],
                topConcern: 'Top: Academic (112)'
            }
        },
        CAS: {
            students: 390,
            totalCases: 84,
            completedCases: 71,
            satisfactionScore: "4.8 / 5.0",
            satisfactionPercent: "96.0%",
            deptCases: {
                labels: ['CAS (Selected)'],
                data: [84],
                topLabel: 'CAS Cases: 84'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [50, 31, 3],
                ratioText: '59.5% F • 36.9% M • 3.6% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [8, 22, 36, 18],
                urgentText: '8 Urgent Cases'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [26, 30, 12, 8, 4, 2, 2],
                topConcern: 'Top: Mental Health (30)'
            }
        },
        CICT: {
            students: 320,
            totalCases: 68,
            completedCases: 57,
            satisfactionScore: "4.8 / 5.0",
            satisfactionPercent: "96.2%",
            deptCases: {
                labels: ['CICT (Selected)'],
                data: [68],
                topLabel: 'CICT Cases: 68'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [28, 38, 2],
                ratioText: '41.2% F • 55.9% M • 2.9% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [6, 18, 28, 16],
                urgentText: '6 Urgent Cases'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [24, 20, 10, 6, 4, 2, 2],
                topConcern: 'Top: Academic (24)'
            }
        },
        CBA: {
            students: 260,
            totalCases: 56,
            completedCases: 47,
            satisfactionScore: "4.9 / 5.0",
            satisfactionPercent: "98.0%",
            deptCases: {
                labels: ['CBA (Selected)'],
                data: [56],
                topLabel: 'CBA Cases: 56'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [36, 18, 2],
                ratioText: '64.3% F • 32.1% M • 3.6% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [4, 14, 24, 14],
                urgentText: '4 Urgent Cases'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [18, 14, 12, 6, 4, 1, 1],
                topConcern: 'Top: Academic (18)'
            }
        },
        CEA: {
            students: 210,
            totalCases: 48,
            completedCases: 40,
            satisfactionScore: "4.7 / 5.0",
            satisfactionPercent: "94.0%",
            deptCases: {
                labels: ['CEA (Selected)'],
                data: [48],
                topLabel: 'CEA Cases: 48'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [17, 29, 2],
                ratioText: '35.4% F • 60.4% M • 4.2% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [5, 13, 19, 11],
                urgentText: '5 Urgent Cases'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [18, 12, 8, 5, 3, 1, 1],
                topConcern: 'Top: Academic (18)'
            }
        },
        CED: {
            students: 150,
            totalCases: 42,
            completedCases: 35,
            satisfactionScore: "4.8 / 5.0",
            satisfactionPercent: "96.0%",
            deptCases: {
                labels: ['CED (Selected)'],
                data: [42],
                topLabel: 'CED Cases: 42'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [31, 10, 1],
                ratioText: '73.8% F • 23.8% M • 2.4% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [3, 10, 18, 11],
                urgentText: '3 Urgent Cases'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [14, 10, 6, 6, 3, 2, 1],
                topConcern: 'Top: Academic (14)'
            }
        },
        CNHS: {
            students: 80,
            totalCases: 26,
            completedCases: 22,
            satisfactionScore: "4.9 / 5.0",
            satisfactionPercent: "98.0%",
            deptCases: {
                labels: ['CNHS (Selected)'],
                data: [26],
                topLabel: 'CNHS Cases: 26'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [20, 5, 1],
                ratioText: '76.9% F • 19.2% M • 3.9% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [1, 6, 12, 7],
                urgentText: '1 Urgent Case'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [7, 6, 3, 4, 3, 2, 1],
                topConcern: 'Top: Academic (7)'
            }
        },
        CAFES: {
            students: 40,
            totalCases: 18,
            completedCases: 14,
            satisfactionScore: "4.8 / 5.0",
            satisfactionPercent: "96.0%",
            deptCases: {
                labels: ['CAFES (Selected)'],
                data: [18],
                topLabel: 'CAFES Cases: 18'
            },
            gender: {
                labels: ['Female', 'Male', 'Prefer not to say'],
                data: [10, 7, 1],
                ratioText: '55.6% F • 38.9% M • 5.5% Other'
            },
            priority: {
                labels: ['Urgent', 'High', 'Medium', 'Low'],
                data: [1, 3, 7, 7],
                urgentText: '1 Urgent Case'
            },
            concerns: {
                labels: [
                    'Academic Performance',
                    'Mental Health & Well-being',
                    'Career Guidance',
                    'Peer Relationships',
                    'Financial Distress',
                    'Behavioral Concerns',
                    'Family & Domestic'
                ],
                data: [5, 2, 1, 3, 3, 4, 0],
                topConcern: 'Top: Academic (5)'
            }
        }
    };

    // Chart.js Instances
    let chartDept = null;
    let chartGender = null;
    let chartPriority = null;
    let chartConcerns = null;

    document.addEventListener('DOMContentLoaded', function () {
        populateProgramOptions('all');
        initAllDashboardCharts();
        applyAllFilters();
    });

    /**
     * Handle Department Change: update program dropdown & apply filters
     */
    function handleDepartmentChange() {
        const dept = document.getElementById('departmentFilter').value;
        populateProgramOptions(dept);
        applyAllFilters();
    }

    /**
     * Populate Program Dropdown based on Selected College
     */
    function populateProgramOptions(collegeKey) {
        const programSelect = document.getElementById('programFilter');
        programSelect.innerHTML = '';
        const list = programsByCollege[collegeKey] || programsByCollege.all;

        list.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.code;
            opt.textContent = p.name;
            programSelect.appendChild(opt);
        });
    }

    /**
     * Reset all filters to default
     */
    function resetDashboardFilters() {
        document.getElementById('departmentFilter').value = 'all';
        populateProgramOptions('all');
        document.getElementById('yearLevelFilter').value = 'all';
        applyAllFilters();
    }

    /**
     * Initialize Chart.js with MarSU Theme
     */
    function initAllDashboardCharts() {
        // 1. Department Cases Donut Chart
        const ctxDept = document.getElementById('chartDepartmentCases').getContext('2d');
        chartDept = new Chart(ctxDept, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        '#800020', // Burgundy (CAS)
                        '#2563EB', // Blue (CICT)
                        '#D4AF37', // Gold (CBA)
                        '#059669', // Emerald (CEA)
                        '#D97706', // Amber (CED)
                        '#7C3AED', // Purple (CNHS)
                        '#64748B'  // Slate (CAFES)
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 12,
                            font: { size: 12, family: 'Inter, system-ui, sans-serif' }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const val = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                return ` ${context.label}: ${val} cases (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });

        // 2. Gender Distribution Donut Chart (Female, Male, Prefer not to say)
        const ctxGender = document.getElementById('chartGenderDistribution').getContext('2d');
        chartGender = new Chart(ctxGender, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        '#E11D48', // Rose / Pink for Female
                        '#0284C7', // Sky / Blue for Male
                        '#8B5CF6'  // Purple / Lavender for Prefer not to say
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 14,
                            font: { size: 12.5, family: 'Inter, system-ui, sans-serif' }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const val = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                return ` ${context.label}: ${val} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });

        // 3. Priority Levels Vertical Bar Chart
        const ctxPriority = document.getElementById('chartPriorityBreakdown').getContext('2d');
        chartPriority = new Chart(ctxPriority, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Cases Count',
                    data: [],
                    backgroundColor: [
                        '#DC2626', // Urgent
                        '#D97706', // High
                        '#2563EB', // Medium
                        '#64748B'  // Low
                    ],
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ` ${context.label}: ${context.parsed.y} cases`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 12 } }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { font: { size: 11.5 } },
                        grid: { color: '#F1F5F9' }
                    }
                }
            }
        });

        // 4. Concern Categories Horizontal Bar Chart
        const ctxConcerns = document.getElementById('chartConcernCategories').getContext('2d');
        chartConcerns = new Chart(ctxConcerns, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Cases',
                    data: [],
                    backgroundColor: '#800020',
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ` Cases: ${context.parsed.x}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: '#F1F5F9' },
                        ticks: { font: { size: 11 } }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { size: 11.5 } }
                    }
                }
            }
        });
    }

    /**
     * Compute and Apply All Connected Filters (Department, Program, Year Level)
     */
    function applyAllFilters() {
        const deptKey = document.getElementById('departmentFilter').value;
        const progKey = document.getElementById('programFilter').value;
        const yearKey = document.getElementById('yearLevelFilter').value;

        // Base College Data
        const base = collegeTelemetryData[deptKey] || collegeTelemetryData.all;

        // Year Level Factor
        let yearFactor = 1.0;
        let yearLabel = "";
        if (yearKey === "1st Year") { yearFactor = 0.30; yearLabel = "1st Year"; }
        else if (yearKey === "2nd Year") { yearFactor = 0.28; yearLabel = "2nd Year"; }
        else if (yearKey === "3rd Year") { yearFactor = 0.24; yearLabel = "3rd Year"; }
        else if (yearKey === "4th Year") { yearFactor = 0.18; yearLabel = "4th Year"; }

        // Program Factor
        let progFactor = 1.0;
        let progLabel = "";
        if (progKey !== "all") {
            progFactor = 0.45; // Focused share of specific program within department
            const progOpt = document.getElementById('programFilter').selectedOptions[0];
            progLabel = progOpt ? progOpt.textContent : progKey;
        }

        const combinedFactor = yearFactor * progFactor;

        // Check if there are newly registered cases in localStorage to dynamically add
        let localCaseCount = 0;
        try {
            const registered = JSON.parse(localStorage.getItem('marsu_registered_cases') || '[]');
            localCaseCount = registered.length;
        } catch (e) { }

        // Scaled Metrics
        const studentsCount = Math.round(base.students * yearFactor * (progKey !== 'all' ? 0.35 : 1.0));
        const totalCasesCount = Math.max(1, Math.round((base.totalCases + (deptKey === 'all' ? localCaseCount : 0)) * combinedFactor));
        const completedCasesCount = Math.max(1, Math.round(totalCasesCount * 0.836));

        // Subtitle labels
        let subText = "All enrolled campus students";
        if (deptKey !== 'all') subText = `Enrolled in ${deptKey}`;
        if (progLabel) subText = `${progLabel} students`;
        if (yearLabel) subText += ` • ${yearLabel}`;

        // 1. Update KPI Card Values & Labels
        document.getElementById('kpiTotalStudents').textContent = studentsCount.toLocaleString();
        document.getElementById('kpiTotalCases').textContent = totalCasesCount.toLocaleString();
        document.getElementById('kpiCompletedCases').textContent = completedCasesCount.toLocaleString();
        document.getElementById('kpiSatisfactionScore').textContent = base.satisfactionScore;

        document.getElementById('kpiStudentsSubtitle').textContent = subText;
        document.getElementById('kpiCasesSubtitle').textContent = `${totalCasesCount} active & resolved cases`;
        document.getElementById('kpiCompletedSubtitle').textContent = `${((completedCasesCount / totalCasesCount) * 100).toFixed(1)}% resolution rate`;
        document.getElementById('kpiSatisfactionSubtitle').textContent = `${base.satisfactionPercent} student rating`;

        // 2. Gender Data with Prefer not to say
        const gFemale = Math.max(1, Math.round(base.gender.data[0] * combinedFactor));
        const gMale = Math.max(1, Math.round(base.gender.data[1] * combinedFactor));
        const gPreferNot = Math.max(0, Math.round(base.gender.data[2] * combinedFactor));
        const gTotal = gFemale + gMale + gPreferNot;
        const pFemale = gTotal > 0 ? ((gFemale / gTotal) * 100).toFixed(1) : 0;
        const pMale = gTotal > 0 ? ((gMale / gTotal) * 100).toFixed(1) : 0;
        const pOther = gTotal > 0 ? ((gPreferNot / gTotal) * 100).toFixed(1) : 0;

        document.getElementById('genderRatioBadge').textContent = `${pFemale}% F • ${pMale}% M • ${pOther}% Other`;

        // 3. Department Cases Data
        let deptLabels = base.deptCases.labels;
        let deptValues = base.deptCases.data.map(v => Math.max(1, Math.round(v * yearFactor * progFactor)));
        if (deptKey !== 'all') {
            document.getElementById('deptTopBadge').textContent = `${deptKey} Cases: ${totalCasesCount}`;
        } else {
            document.getElementById('deptTopBadge').textContent = `Highest: CAS (${deptValues[0]} Cases)`;
        }

        // 4. Priority Data
        const pUrgent = Math.max(1, Math.round(base.priority.data[0] * combinedFactor));
        const pHigh = Math.max(1, Math.round(base.priority.data[1] * combinedFactor));
        const pMed = Math.max(1, Math.round(base.priority.data[2] * combinedFactor));
        const pLow = Math.max(1, Math.round(base.priority.data[3] * combinedFactor));
        document.getElementById('urgentCasesBadge').textContent = `${pUrgent} Urgent Cases`;

        // 5. Concern Categories Data
        const cValues = base.concerns.data.map(v => Math.max(0, Math.round(v * combinedFactor)));
        const topConcernVal = Math.max(...cValues);
        const topConcernIdx = cValues.indexOf(topConcernVal);
        const topConcernName = base.concerns.labels[topConcernIdx] || 'Academic';
        document.getElementById('concernTopBadge').textContent = `Top: ${topConcernName.split(' ')[0]} (${topConcernVal})`;

        // 6. Update Chart 1: Department Donut
        if (chartDept) {
            chartDept.data.labels = deptLabels;
            chartDept.data.datasets[0].data = deptValues;
            chartDept.update();
        }

        // 7. Update Chart 2: Gender Donut (Female, Male, Prefer not to say)
        if (chartGender) {
            chartGender.data.labels = ['Female', 'Male', 'Prefer not to say'];
            chartGender.data.datasets[0].data = [gFemale, gMale, gPreferNot];
            chartGender.update();
        }

        // 8. Update Chart 3: Priority Bar Chart
        if (chartPriority) {
            chartPriority.data.labels = base.priority.labels;
            chartPriority.data.datasets[0].data = [pUrgent, pHigh, pMed, pLow];
            chartPriority.update();
        }

        // 9. Update Chart 4: Concern Categories Horizontal Bar Chart
        if (chartConcerns) {
            chartConcerns.data.labels = base.concerns.labels;
            chartConcerns.data.datasets[0].data = cValues;
            chartConcerns.update();
        }
    }
</script>