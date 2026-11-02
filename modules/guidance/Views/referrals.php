<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: FACULTY REFERRALS             -->
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
                    Faculty Referrals
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Faculty Referral Management
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Track and process student endorsements submitted by MarSU faculty and academic departments.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="<?= url('guidance/case_registration') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    style="height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 14px;">
                    <i class="bi bi-folder-plus me-1"></i>Register Case Intake
                </a>

                <!-- Create Referral Button -->
                <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center"
                    data-bs-toggle="modal" data-bs-target="#createReferralModal"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 14px; height: 38px; border-radius: 6px; padding: 0 16px; font-weight: 500;">
                    <i class="bi bi-plus-circle me-2"></i>New Faculty Referral Form
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 2. CUSTOM STYLES -->
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

    .kpi-filter-card[data-filter="pending"] {
        border-left: 4px solid #d97706 !important;
    }

    .kpi-filter-card[data-filter="urgent"] {
        border-left: 4px solid #dc2626 !important;
    }

    .kpi-filter-card[data-filter="scheduled"] {
        border-left: 4px solid #166534 !important;
    }

    .kpi-filter-card.active[data-filter="all"] {
        border: 1px solid #800020 !important;
        border-left: 4px solid #800020 !important;
        box-shadow: 0 0 0 2px rgba(128, 0, 32, 0.22), 0 4px 12px rgba(128, 0, 32, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="pending"] {
        border: 1px solid #d97706 !important;
        border-left: 4px solid #d97706 !important;
        box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.25), 0 4px 12px rgba(217, 119, 6, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="urgent"] {
        border: 1px solid #dc2626 !important;
        border-left: 4px solid #dc2626 !important;
        box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.25), 0 4px 12px rgba(220, 38, 38, 0.10) !important;
    }

    .kpi-filter-card.active[data-filter="scheduled"] {
        border: 1px solid #166534 !important;
        border-left: 4px solid #166534 !important;
        box-shadow: 0 0 0 2px rgba(22, 101, 52, 0.25), 0 4px 12px rgba(22, 101, 52, 0.10) !important;
    }

    .referral-subcard {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 12px;
    }

    .referral-subcard-title {
        font-size: 13px;
        font-weight: 700;
        color: #1E293B;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 6px;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .btn-outline-marsu {
        color: #800020;
        border-color: #800020;
    }

    .btn-outline-marsu:hover {
        background-color: #800020;
        color: #fff;
    }
</style>

<!-- 3. CLICKABLE KPI CARDS (INTERACTIVE STATUS FILTERING) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Faculty Referrals -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card active"
            id="kpi-card-all" data-filter="all" onclick="applyReferralFilter('all', this)" role="button">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fw-semibold" style="font-size: 13.5px;">Total Referrals</span>
                <div class="rounded-2 p-1 px-2 d-flex align-items-center justify-content-center"
                    style="background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h3 class="fw-bold mb-0 text-dark" id="count-all">5</h3>
                <span class="badge bg-light text-secondary border fw-normal" style="font-size: 11px;">All
                    Recorded</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Pending Review -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-pending" data-filter="pending" onclick="applyReferralFilter('pending', this)" role="button">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fw-semibold" style="font-size: 13.5px;">Pending Review</span>
                <div class="rounded-2 p-1 px-2 d-flex align-items-center justify-content-center"
                    style="background-color: #FFFBEB; color: #D97706;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h3 class="fw-bold mb-0 text-dark" id="count-pending">3</h3>
                <span class="badge fw-normal"
                    style="background-color: #FEF3C7; color: #92400E; font-size: 11px;">Awaiting Intake</span>
            </div>
        </div>
    </div>

    <!-- Card 3: Urgent Endorsements -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-urgent" data-filter="urgent" onclick="applyReferralFilter('urgent', this)" role="button">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fw-semibold" style="font-size: 13.5px;">Urgent Attention</span>
                <div class="rounded-2 p-1 px-2 d-flex align-items-center justify-content-center"
                    style="background-color: #FEF2F2; color: #DC2626;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h3 class="fw-bold mb-0 text-dark" id="count-urgent">3</h3>
                <span class="badge fw-normal" style="background-color: #FEE2E2; color: #991B1B; font-size: 11px;">Within
                    24–72h</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Scheduled / Processed -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between bg-white kpi-filter-card"
            id="kpi-card-scheduled" data-filter="scheduled" onclick="applyReferralFilter('scheduled', this)"
            role="button">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fw-semibold" style="font-size: 13.5px;">Intake Scheduled</span>
                <div class="rounded-2 p-1 px-2 d-flex align-items-center justify-content-center"
                    style="background-color: #F0FDF4; color: #166534;">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h3 class="fw-bold mb-0 text-dark" id="count-scheduled">2</h3>
                <span class="badge fw-normal" style="background-color: #DCFCE7; color: #15803D; font-size: 11px;">In
                    Session / Done</span>
            </div>
        </div>
    </div>
</div>

<!-- 4. FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <!-- Search Bar -->
            <div class="col-lg-4 col-md-5 col-12">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="searchReferralInput" class="form-control border-start-0 shadow-none ps-2"
                        placeholder="Search by Student ID, Student Name, or Teacher..." oninput="filterReferralsTable()"
                        style="height: 38px; font-size: 13.5px;">
                </div>
            </div>

            <!-- College/Department Filter -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                <select id="deptFilterSelect" class="form-select shadow-none" onchange="filterReferralsTable()"
                    style="height: 38px; font-size: 13.5px;">
                    <option value="all">All Colleges / Depts</option>
                    <option value="CICT">CICT</option>
                    <option value="CAS">CAS</option>
                    <option value="CED">CED</option>
                    <option value="CBA">CBA</option>
                    <option value="CEA">CEA</option>
                    <option value="CNHS">CNHS</option>
                    <option value="CAFES">CAFES</option>
                </select>
            </div>

            <!-- Urgency Filter -->
            <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                <select id="urgencyFilterSelect" class="form-select shadow-none" onchange="filterReferralsTable()"
                    style="height: 38px; font-size: 13.5px;">
                    <option value="all">All Urgency</option>
                    <option value="Routine">Routine</option>
                    <option value="Urgent">Urgent (24–72h)</option>
                    <option value="Emergency">Emergency</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                <select id="statusFilterSelect" class="form-select shadow-none" onchange="filterReferralsTable()"
                    style="height: 38px; font-size: 13.5px;">
                    <option value="all">All Statuses</option>
                    <option value="Pending Review">Pending Review</option>
                    <option value="Scheduled for Intake">Scheduled for Intake</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <!-- Reset Filter Button -->
            <div class="col-lg-1 col-md-12 col-12 text-end">
                <button type="button" id="resetReferralFilterBtn" class="btn btn-outline-secondary w-100 shadow-none"
                    onclick="resetAllReferralFilters()" title="Reset Filters"
                    style="height: 38px; font-size: 13px; padding: 0 6px;">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 5. REFERRALS DATASET STORE & STUDENT DIRECTORY STORE (DIV-BASED REPOSITORY) -->
<div id="referralsDatasetStore" class="d-none" aria-hidden="true">
    <!-- Referral Item 1: Carlos Ramos -->
    <div class="referral-data-item" id="ref-item-0" data-date="Oct 28, 2026" data-student-id="2023-01089"
        data-student-name="RAMOS, CARLOS M." data-program="BSIT - 3rd Year" data-college="CICT"
        data-referred-by="Prof. Danilo Navarro (CICT)" data-contact="danilo.navarro@marsu.edu.ph"
        data-reason="Noticeable drop in academic performance"
        data-observations="Student has missed 4 consecutive laboratory sessions and failed mid-term code evaluations."
        data-actions="Discussion with student, Academic deficiency warning issued"
        data-comments="Student appears tired and distracted during afternoon lectures."
        data-urgency="Urgent (within 24–72 hours)" data-status="Scheduled for Intake">
    </div>

    <!-- Referral Item 2: Maria Santos -->
    <div class="referral-data-item" id="ref-item-1" data-date="Oct 29, 2026" data-student-id="2023-01042"
        data-student-name="SANTOS, MARIA C." data-program="BA Political Science - 2nd Year" data-college="CAS"
        data-referred-by="Dr. Roberto Gomez (CAS)" data-contact="roberto.gomez@marsu.edu.ph"
        data-reason="Stress management or excessive anxiety"
        data-observations="Exhibiting severe test anxiety, hyperventilation prior to oral debates, and difficulty speaking in class."
        data-actions="Discussion with student"
        data-comments="Student mentioned balancing heavy course load and household responsibilities."
        data-urgency="Urgent (within 24–72 hours)" data-status="Pending Review">
    </div>

    <!-- Referral Item 3: Juan Mendoza -->
    <div class="referral-data-item" id="ref-item-2" data-date="Oct 30, 2026" data-student-id="2022-00512"
        data-student-name="MENDOZA, JUAN B." data-program="BEED - 3rd Year" data-college="CED"
        data-referred-by="Dr. Corazon Villalobos (CED)" data-contact="corazon.villalobos@marsu.edu.ph"
        data-reason="Academic probation or retention concerns"
        data-observations="Risk of failing required professional education subjects; struggles with study habits and time management."
        data-actions="Discussion with student, Discussion with parents / guardian"
        data-comments="Needs guidance on peer study groups and scheduling." data-urgency="Routine"
        data-status="Pending Review">
    </div>

    <!-- Referral Item 4: Mark Anthony Reyes -->
    <div class="referral-data-item" id="ref-item-3" data-date="Oct 31, 2026" data-student-id="2023-02194"
        data-student-name="REYES, MARK ANTHONY" data-program="BSCE - 2nd Year" data-college="CEA"
        data-referred-by="Engr. Ronald Flores (CEA)" data-contact="ronald.flores@marsu.edu.ph"
        data-reason="Sudden withdrawal from social interactions"
        data-observations="Noticeable behavioral withdrawal, sits isolated during engineering drafting, decline in personal interaction."
        data-actions="Consulted Department Chairperson"
        data-comments="Previously an active student leader; sudden demeanor shift observed in the last 3 weeks."
        data-urgency="Urgent (within 24–72 hours)" data-status="Pending Review">
    </div>

    <!-- Referral Item 5: Bea Dela Cruz -->
    <div class="referral-data-item" id="ref-item-4" data-date="Nov 01, 2026" data-student-id="2024-03115"
        data-student-name="DELA CRUZ, BEA L." data-program="BS Tourism Management - 1st Year" data-college="CBA"
        data-referred-by="Prof. Melinda Ramos (CBA)" data-contact="melinda.ramos@marsu.edu.ph"
        data-reason="Frequent absences or tardiness"
        data-observations="Frequent Friday morning absences due to long commute from remote municipality."
        data-actions="Discussion with student" data-comments="Exploring university boarding or student welfare options."
        data-urgency="Routine" data-status="Completed">
    </div>
</div>

<div id="studentDirectoryStore" class="d-none" aria-hidden="true">
    <div class="dir-student-item" data-id="2023-01089" data-name="RAMOS, CARLOS M." data-gender="Male"
        data-college="CICT" data-program="BS Information Technology" data-year="3rd Year"
        data-email="carlos.ramos@gmail.com"></div>
    <div class="dir-student-item" data-id="2023-01042" data-name="SANTOS, MARIA C." data-gender="Female"
        data-college="CAS" data-program="BA Political Science" data-year="2nd Year" data-email="maria.santos@gmail.com">
    </div>
    <div class="dir-student-item" data-id="2022-00512" data-name="MENDOZA, JUAN B." data-gender="Male"
        data-college="CED" data-program="BEED" data-year="3rd Year" data-email="juan.mendoza@gmail.com"></div>
    <div class="dir-student-item" data-id="2024-03115" data-name="DELA CRUZ, BEA L." data-gender="Female"
        data-college="CBA" data-program="BS Tourism Management" data-year="1st Year"
        data-email="bea.delacruz@gmail.com"></div>
    <div class="dir-student-item" data-id="2023-02194" data-name="REYES, MARK ANTHONY" data-gender="Male"
        data-college="CEA" data-program="BS Civil Engineering" data-year="2nd Year" data-email="mark.reyes@gmail.com">
    </div>
    <div class="dir-student-item" data-id="2024-01582" data-name="GONZALES, ALYSSA P." data-gender="Female"
        data-college="CNHS" data-program="BS Nursing" data-year="1st Year" data-email="alyssa.gonzales@gmail.com"></div>
    <div class="dir-student-item" data-id="2022-03481" data-name="BAUTISTA, KEVIN R." data-gender="Male"
        data-college="CAFES" data-program="BS Agriculture" data-year="4th Year" data-email="kevin.bautista@gmail.com">
    </div>
    <div class="dir-student-item" data-id="2023-04129" data-name="VILLANUEVA, PATRICIA M." data-gender="Female"
        data-college="CBA" data-program="BS Accountancy" data-year="2nd Year"
        data-email="patricia.villanueva@gmail.com"></div>
    <div class="dir-student-item" data-id="2024-00871" data-name="AQUINO, CHRISTIAN J." data-gender="Male"
        data-college="CED" data-program="BSEd English" data-year="1st Year" data-email="christian.aquino@gmail.com">
    </div>
    <div class="dir-student-item" data-id="2022-01934" data-name="CASTRO, DIANA MAE" data-gender="Female"
        data-college="CNHS" data-program="BS Nursing" data-year="3rd Year" data-email="diana.castro@gmail.com"></div>
    <div class="dir-student-item" data-id="2023-03712" data-name="FLORES, GABRIEL S." data-gender="Male"
        data-college="CEA" data-program="BS Electrical Engineering" data-year="2nd Year"
        data-email="gabriel.flores@gmail.com"></div>
    <div class="dir-student-item" data-id="2024-02205" data-name="TAN, JUSTINE CHLOE" data-gender="Female"
        data-college="CAS" data-program="BS Biology" data-year="1st Year" data-email="justine.tan@gmail.com"></div>
</div>

<!-- 6. REFERRALS DATA TABLE -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white" id="referralsTable" style="font-size: 14px;">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Date
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Student ID
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Student
                            Name</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Program
                            &amp; Year</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Referred
                            by (Teacher)</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Reason for
                            Referral</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Other
                            Observations</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Urgency
                        </th>
                        <th class="text-center text-nowrap"
                            style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Status</th>
                        <th class="text-center pe-4 text-nowrap"
                            style="padding: 14px 16px; color: #2D3748; font-weight: 600; width: 110px;">Action</th>
                    </tr>
                </thead>
                <tbody id="referralsTableBody">
                    <!-- Row 1: Carlos Ramos -->
                    <tr class="referral-row align-middle" data-date="Oct 28, 2026" data-student-id="2023-01089"
                        data-student-name="RAMOS, CARLOS M." data-program="BSIT - 3rd Year" data-college="CICT"
                        data-referred-by="Prof. Danilo Navarro (CICT)" data-contact="danilo.navarro@marsu.edu.ph"
                        data-reason="Noticeable drop in academic performance"
                        data-observations="Student has missed 4 consecutive laboratory sessions and failed mid-term code evaluations."
                        data-actions="Discussion with student, Academic deficiency warning issued"
                        data-comments="Student appears tired and distracted during afternoon lectures."
                        data-urgency="Urgent (within 24–72 hours)" data-status="Scheduled for Intake">
                        <td class="ps-4 text-nowrap" style="padding: 14px 16px;">
                            <span class="text-dark fw-medium">Oct 28, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark font-monospace">2023-01089</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-semibold text-dark">RAMOS, CARLOS M.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 12px;">BSIT - 3rd
                                Year</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 170px;">
                            <span class="fw-semibold text-dark">Prof. Danilo Navarro (CICT)</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 180px;">
                            <span class="text-dark text-truncate d-block" style="max-width: 220px;"
                                title="Noticeable drop in academic performance">
                                Noticeable drop in academic performance
                            </span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 200px;">
                            <span class="text-secondary text-truncate d-block" style="max-width: 240px;"
                                title="Student has missed 4 consecutive laboratory sessions and failed mid-term code evaluations.">
                                Student has missed 4 consecutive laboratory sessions and failed mid-term code
                                evaluations.
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 600;">Urgent
                                (24–72h)</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Scheduled
                                for Intake</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 14px 16px;">
                            <a href="<?= url('guidance/referral_view') ?>?id=2023-01089"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                style="font-size: 12.5px; height: 32px; padding: 0 12px; border-radius: 6px; font-weight: 500; text-decoration: none;">
                                View Details
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2: Maria Santos -->
                    <tr class="referral-row align-middle" data-date="Oct 29, 2026" data-student-id="2023-01042"
                        data-student-name="SANTOS, MARIA C." data-program="BA Political Science - 2nd Year"
                        data-college="CAS" data-referred-by="Dr. Roberto Gomez (CAS)"
                        data-contact="roberto.gomez@marsu.edu.ph" data-reason="Stress management or excessive anxiety"
                        data-observations="Exhibiting severe test anxiety, hyperventilation prior to oral debates, and difficulty speaking in class."
                        data-actions="Discussion with student"
                        data-comments="Student mentioned balancing heavy course load and household responsibilities."
                        data-urgency="Urgent (within 24–72 hours)" data-status="Pending Review">
                        <td class="ps-4 text-nowrap" style="padding: 14px 16px;">
                            <span class="text-dark fw-medium">Oct 29, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark font-monospace">2023-01042</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-semibold text-dark">SANTOS, MARIA C.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 12px;">BA Political
                                Science - 2nd Year</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 170px;">
                            <span class="fw-semibold text-dark">Dr. Roberto Gomez (CAS)</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 180px;">
                            <span class="text-dark text-truncate d-block" style="max-width: 220px;"
                                title="Stress management or excessive anxiety">
                                Stress management or excessive anxiety
                            </span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 200px;">
                            <span class="text-secondary text-truncate d-block" style="max-width: 240px;"
                                title="Exhibiting severe test anxiety, hyperventilation prior to oral debates, and difficulty speaking in class.">
                                Exhibiting severe test anxiety, hyperventilation prior to oral debates, and difficulty
                                speaking in class.
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 600;">Urgent
                                (24–72h)</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Pending
                                Review</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 14px 16px;">
                            <a href="<?= url('guidance/referral_view') ?>?id=2023-01042"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                style="font-size: 12.5px; height: 32px; padding: 0 12px; border-radius: 6px; font-weight: 500; text-decoration: none;">
                                View Details
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3: Juan Mendoza -->
                    <tr class="referral-row align-middle" data-date="Oct 30, 2026" data-student-id="2022-00512"
                        data-student-name="MENDOZA, JUAN B." data-program="BEED - 3rd Year" data-college="CED"
                        data-referred-by="Dr. Corazon Villalobos (CED)" data-contact="corazon.villalobos@marsu.edu.ph"
                        data-reason="Academic probation or retention concerns"
                        data-observations="Risk of failing required professional education subjects; struggles with study habits and time management."
                        data-actions="Discussion with student, Discussion with parents / guardian"
                        data-comments="Needs guidance on peer study groups and scheduling." data-urgency="Routine"
                        data-status="Pending Review">
                        <td class="ps-4 text-nowrap" style="padding: 14px 16px;">
                            <span class="text-dark fw-medium">Oct 30, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark font-monospace">2022-00512</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-semibold text-dark">MENDOZA, JUAN B.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 12px;">BEED - 3rd
                                Year</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 170px;">
                            <span class="fw-semibold text-dark">Dr. Corazon Villalobos (CED)</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 180px;">
                            <span class="text-dark text-truncate d-block" style="max-width: 220px;"
                                title="Academic probation or retention concerns">
                                Academic probation or retention concerns
                            </span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 200px;">
                            <span class="text-secondary text-truncate d-block" style="max-width: 240px;"
                                title="Risk of failing required professional education subjects; struggles with study habits and time management.">
                                Risk of failing required professional education subjects; struggles with study habits
                                and time management.
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 11.5px;">Routine</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Pending
                                Review</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 14px 16px;">
                            <a href="<?= url('guidance/referral_view') ?>?id=2022-00512"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                style="font-size: 12.5px; height: 32px; padding: 0 12px; border-radius: 6px; font-weight: 500; text-decoration: none;">
                                View Details
                            </a>
                        </td>
                    </tr>

                    <!-- Row 4: Mark Anthony Reyes -->
                    <tr class="referral-row align-middle" data-date="Oct 31, 2026" data-student-id="2023-02194"
                        data-student-name="REYES, MARK ANTHONY" data-program="BSCE - 2nd Year" data-college="CEA"
                        data-referred-by="Engr. Ronald Flores (CEA)" data-contact="ronald.flores@marsu.edu.ph"
                        data-reason="Sudden withdrawal from social interactions"
                        data-observations="Noticeable behavioral withdrawal, sits isolated during engineering drafting, decline in personal interaction."
                        data-actions="Consulted Department Chairperson"
                        data-comments="Previously an active student leader; sudden demeanor shift observed in the last 3 weeks."
                        data-urgency="Urgent (within 24–72 hours)" data-status="Pending Review">
                        <td class="ps-4 text-nowrap" style="padding: 14px 16px;">
                            <span class="text-dark fw-medium">Oct 31, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark font-monospace">2023-02194</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-semibold text-dark">REYES, MARK ANTHONY</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 12px;">BSCE - 2nd
                                Year</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 170px;">
                            <span class="fw-semibold text-dark">Engr. Ronald Flores (CEA)</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 180px;">
                            <span class="text-dark text-truncate d-block" style="max-width: 220px;"
                                title="Sudden withdrawal from social interactions">
                                Sudden withdrawal from social interactions
                            </span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 200px;">
                            <span class="text-secondary text-truncate d-block" style="max-width: 240px;"
                                title="Noticeable behavioral withdrawal, sits isolated during engineering drafting, decline in personal interaction.">
                                Noticeable behavioral withdrawal, sits isolated during engineering drafting, decline in
                                personal interaction.
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 600;">Urgent
                                (24–72h)</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Pending
                                Review</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 14px 16px;">
                            <a href="<?= url('guidance/referral_view') ?>?id=2023-02194"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                style="font-size: 12.5px; height: 32px; padding: 0 12px; border-radius: 6px; font-weight: 500; text-decoration: none;">
                                View Details
                            </a>
                        </td>
                    </tr>

                    <!-- Row 5: Bea Dela Cruz -->
                    <tr class="referral-row align-middle" data-date="Nov 01, 2026" data-student-id="2024-03115"
                        data-student-name="DELA CRUZ, BEA L." data-program="BS Tourism Management - 1st Year"
                        data-college="CBA" data-referred-by="Prof. Melinda Ramos (CBA)"
                        data-contact="melinda.ramos@marsu.edu.ph" data-reason="Frequent absences or tardiness"
                        data-observations="Frequent Friday morning absences due to long commute from remote municipality."
                        data-actions="Discussion with student"
                        data-comments="Exploring university boarding or student welfare options." data-urgency="Routine"
                        data-status="Completed">
                        <td class="ps-4 text-nowrap" style="padding: 14px 16px;">
                            <span class="text-dark fw-medium">Nov 01, 2026</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark font-monospace">2024-03115</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="fw-semibold text-dark">DELA CRUZ, BEA L.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 12px;">BS Tourism
                                Management - 1st Year</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 170px;">
                            <span class="fw-semibold text-dark">Prof. Melinda Ramos (CBA)</span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 180px;">
                            <span class="text-dark text-truncate d-block" style="max-width: 220px;"
                                title="Frequent absences or tardiness">
                                Frequent absences or tardiness
                            </span>
                        </td>
                        <td style="padding: 14px 16px; min-width: 200px;">
                            <span class="text-secondary text-truncate d-block" style="max-width: 240px;"
                                title="Frequent Friday morning absences due to long commute from remote municipality.">
                                Frequent Friday morning absences due to long commute from remote municipality.
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 14px 16px;">
                            <span class="badge bg-light text-secondary border" style="font-size: 11.5px;">Routine</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 14px 16px;">
                            <span class="badge"
                                style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Completed</span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 14px 16px;">
                            <a href="<?= url('guidance/referral_view') ?>?id=2024-03115"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                style="font-size: 12.5px; height: 32px; padding: 0 12px; border-radius: 6px; font-weight: 500; text-decoration: none;">
                                View Details
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Empty State Fallback -->
            <div id="noReferralsMatchNotice" class="text-center py-5 text-muted d-none">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                No faculty referrals matching criteria.
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- 7. CREATE FACULTY REFERRAL MODAL                                    -->
<!-- ==================================================================== -->
<div class="modal fade" id="createReferralModal" tabindex="-1" aria-labelledby="createReferralModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header px-4 py-3 text-white" style="background-color: #800020;">
                <div>
                    <h5 class="modal-title fw-bold text-white mb-0" id="createReferralModalLabel"
                        style="font-size: 18px;">
                        New Faculty Referral Form
                    </h5>
                    <div class="text-white-50" style="font-size: 13px;">
                        Endorse a student client to the Guidance &amp; Counseling Office
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 14px;">
                <form id="newReferralForm" onsubmit="event.preventDefault(); submitModalReferral();">

                    <!-- Section 1: Referring Faculty Information -->
                    <div class="referral-subcard">
                        <div class="referral-subcard-title text-primary">
                            <i class="bi bi-person-workspace me-1"></i>I. Referring Faculty Details
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Date of
                                    Referral <span class="text-danger">*</span></label>
                                <input type="date" id="m_fac_date" class="form-control" value="<?= date('Y-m-d') ?>"
                                    required>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Referred by
                                    (Teacher's Name) <span class="text-danger">*</span></label>
                                <input type="text" id="m_fac_name" class="form-control"
                                    placeholder="e.g. Prof. Danilo Navarro" required>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Department /
                                    College <span class="text-danger">*</span></label>
                                <input type="text" id="m_fac_dept" class="form-control" placeholder="e.g. CICT"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Teacher's
                                    Contact Information</label>
                                <input type="text" id="m_fac_contact" class="form-control"
                                    placeholder="Email address or phone number (e.g. danilo.navarro@marsu.edu.ph)">
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Student Identification -->
                    <div class="referral-subcard">
                        <div class="referral-subcard-title text-dark">
                            <i class="bi bi-person-badge me-1"></i>II. Student Client Information
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Student ID
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="m_student_id" class="form-control"
                                        placeholder="e.g. 2023-01089" required oninput="lookupModalStudent(this.value)">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="openStudentDirectoryList()" title="Select from directory">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                                <small class="text-muted" style="font-size: 11.5px;">Type ID or click search to
                                    autofill</small>
                            </div>
                            <div class="col-md-5 col-sm-6 col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Student Full
                                    Name <span class="text-danger">*</span></label>
                                <input type="text" id="m_student_name" class="form-control"
                                    placeholder="Enter Full Name" required>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Program &amp;
                                    Year</label>
                                <input type="text" id="m_student_program" class="form-control"
                                    placeholder="e.g. BSIT - 3rd Year">
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Reason for Referral -->
                    <div class="referral-subcard">
                        <div class="referral-subcard-title text-dark">
                            <i class="bi bi-question-circle me-1"></i>III. Reason for Referral &amp; Observations
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Reason for
                                    Referral <span class="text-danger">*</span></label>
                                <select id="m_referral_reason" class="form-select" required>
                                    <option value="" selected disabled>Select primary reason for referral...</option>
                                    <option value="Poor academic performance / study habits">Poor academic performance /
                                        study habits</option>
                                    <option value="Frequent absences or tardiness">Frequent absences or tardiness
                                    </option>
                                    <option value="Noticeable drop in academic performance">Noticeable drop in academic
                                        performance</option>
                                    <option value="Stress management or excessive anxiety">Stress management or
                                        excessive anxiety</option>
                                    <option value="Sudden withdrawal from social interactions">Sudden withdrawal from
                                        social interactions</option>
                                    <option value="Academic probation or retention concerns">Academic probation or
                                        retention concerns</option>
                                    <option value="Behavioral / conduct issues">Behavioral / conduct issues</option>
                                    <option value="Family or personal distress">Family or personal distress</option>
                                    <option value="Other Inquiries / Concerns">Other Inquiries / Concerns</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Other
                                    Observations</label>
                                <textarea id="m_other_observations" class="form-control" rows="2"
                                    placeholder="Describe symptoms, observable behaviors, or notable changes observed in the student..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Actions Taken by Teacher Prior to Referral -->
                    <div class="referral-subcard">
                        <div class="referral-subcard-title text-dark">
                            <i class="bi bi-check-square me-1"></i>IV. Actions Taken Prior to Referral
                        </div>
                        <p class="text-muted mb-2" style="font-size: 12.5px;">Indicate any steps already taken with the
                            student before endorsing to Guidance:</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="m_act_1"
                                        value="Discussion with student">
                                    <label class="form-check-label" for="m_act_1">Discussion with student</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="m_act_2"
                                        value="Discussion with parents / guardian">
                                    <label class="form-check-label" for="m_act_2">Discussion with parents /
                                        guardian</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="m_act_3"
                                        value="Consulted Department Chairperson">
                                    <label class="form-check-label" for="m_act_3">Consulted Department
                                        Chairperson</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="m_act_4"
                                        value="Academic deficiency warning issued">
                                    <label class="form-check-label" for="m_act_4">Academic deficiency warning
                                        issued</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="m_act_5"
                                        value="None / Immediate referral required">
                                    <label class="form-check-label" for="m_act_5">None / Immediate referral
                                        required</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-semibold text-dark" style="font-size: 13px;">Additional Comments
                                or Concerns</label>
                            <textarea id="m_additional_comments" class="form-control" rows="2"
                                placeholder="Any other helpful background or context for the Guidance Counselor..."></textarea>
                        </div>
                    </div>

                    <!-- Section 5: Urgency of Referral -->
                    <div class="referral-subcard">
                        <div class="referral-subcard-title text-dark">
                            <i class="bi bi-speedometer2 me-1"></i>V. Urgency Level
                        </div>
                        <div class="d-flex gap-4 flex-wrap">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="m_urgency" id="m_urg_1"
                                    value="Routine" checked>
                                <label class="form-check-label" for="m_urg_1">
                                    <strong>Routine</strong> <span class="text-muted">(Standard scheduling)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="m_urgency" id="m_urg_2"
                                    value="Urgent (within 24–72 hours)">
                                <label class="form-check-label" for="m_urg_2">
                                    <strong class="text-warning text-dark">Urgent</strong> <span
                                        class="text-muted">(Attention within 24–72 hours)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="m_urgency" id="m_urg_3"
                                    value="Emergency (Immediate attention required)">
                                <label class="form-check-label" for="m_urg_3">
                                    <strong class="text-danger">Emergency</strong> <span class="text-muted">(Immediate
                                        attention)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end align-items-center gap-2 pt-3 border-top">
                        <button type="button" class="btn btn-outline-secondary shadow-none px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-white shadow-none px-4"
                            style="background-color: #800020; border-color: #800020; font-weight: 600;">
                            <i class="bi bi-check-circle me-1"></i>Save &amp; Record Referral
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- 8. VIEW FACULTY REFERRAL DETAILS MODAL                              -->
<!-- ==================================================================== -->
<div class="modal fade" id="viewReferralDetailsModal" tabindex="-1" aria-labelledby="viewReferralDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-3 px-4 text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person-fill fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="viewReferralDetailsModalLabel">
                            Faculty Referral Record
                        </h6>
                        <small class="text-white-50">Guidance &amp; Counseling Student Endorsement Slip</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 14px;">
                <!-- Header Badges -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3 pb-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge"
                            style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 12px; padding: 4px 10px;">
                            <i class="bi bi-person-workspace me-1"></i>Faculty Referral
                        </span>
                        <span class="badge" id="viewRefUrgencyBadge"
                            style="font-size: 12px; padding: 4px 10px;">Routine</span>
                    </div>
                    <div>
                        <span class="text-muted small me-2">Date:</span>
                        <strong id="viewRefDate">—</strong>
                    </div>
                </div>

                <!-- Student Information -->
                <div class="referral-subcard">
                    <div class="referral-subcard-title text-dark">Student Client Information</div>
                    <div class="row g-2">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Student ID:</span>
                            <span class="fw-bold text-dark fs-6 font-monospace" id="viewStudentID">—</span>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Student Full Name:</span>
                            <span class="fw-bold text-dark fs-6" id="viewStudentName">—</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block small">Program &amp; Academic Unit:</span>
                            <span class="text-dark fw-medium" id="viewStudentProgram">—</span>
                        </div>
                    </div>
                </div>

                <!-- Referring Faculty Information -->
                <div class="referral-subcard">
                    <div class="referral-subcard-title text-primary">Referring Faculty Information</div>
                    <div class="row g-2">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Referred by (Teacher's Name):</span>
                            <span class="fw-bold text-dark" id="viewReferredBy">—</span>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Status:</span>
                            <span class="badge" id="viewStatusBadge" style="font-size: 12px;">Pending Review</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top" id="viewContactWrapper">
                            <span class="text-muted d-block small">Teacher Contact Information:</span>
                            <span class="text-dark" id="viewTeacherContact">—</span>
                        </div>
                    </div>
                </div>

                <!-- Reason for Referral & Other Observations -->
                <div class="referral-subcard">
                    <div class="referral-subcard-title text-dark">Reason for Referral &amp; Other Observations</div>
                    <div class="mb-2">
                        <span class="text-muted d-block small">Primary Reason:</span>
                        <div class="fw-semibold text-dark" id="viewRefReason">—</div>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Other Observations:</span>
                        <p class="mb-0 text-dark" id="viewRefObservations" style="line-height: 1.6;">—</p>
                    </div>
                </div>

                <!-- Actions Taken Prior to Referral & Comments -->
                <div class="referral-subcard mb-0">
                    <div class="referral-subcard-title text-dark">Actions Taken Prior to Referral &amp; Comments</div>
                    <div class="mb-2">
                        <span class="text-muted d-block small">Actions Taken:</span>
                        <div class="text-dark" id="viewRefActions">—</div>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Additional Comments:</span>
                        <p class="mb-0 text-dark" id="viewRefComments" style="line-height: 1.6;">—</p>
                    </div>
                </div>
            </div>

            <div
                class="modal-footer bg-light py-2 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm shadow-none" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print Slip
                </button>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn text-white btn-sm shadow-none" id="btnProceedToIntake"
                        onclick="proceedFromReferralToIntake()"
                        style="background-color: #800020; border-color: #800020;">
                        <i class="bi bi-arrow-right-circle me-1"></i>Proceed to Case Intake
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm shadow-none px-3" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- 9. STUDENT DIRECTORY QUICK LOOKUP MODAL                             -->
<!-- ==================================================================== -->
<div class="modal fade" id="quickDirectoryModal" tabindex="-1" aria-labelledby="quickDirectoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-3 px-4 text-white" style="background-color: #800020;">
                <h6 class="modal-title fw-bold text-white mb-0" id="quickDirectoryModalLabel">
                    <i class="bi bi-people-fill me-1"></i>Select Student from Directory
                </h6>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="dirQuickSearch"
                        placeholder="Search by student ID, name, or program..."
                        oninput="renderDirectoryQuickList(this.value)">
                </div>
                <div class="table-responsive" style="max-height: 320px;">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13.5px;">
                        <thead class="bg-light sticky-top">
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Program &amp; Year</th>
                                <th>College</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="quickDirectoryTbody">
                            <!-- Populated from #studentDirectoryStore -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 10. TOAST NOTIFICATION BOX -->
<div id="toastBox" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>

<!-- ==================================================================== -->
<!-- 11. REFERRALS ENGINE SCRIPT (MATCHING APPOINTMENT_LISTS ARCHITECTURE)-->
<!-- ==================================================================== -->
<script>
    let currentSelectedStudentId = null;

    document.addEventListener('DOMContentLoaded', function () {
        syncDynamicStoredReferrals();
        updateKPIStatistics();
        filterReferralsTable();
    });

    /**
     * Sync Referrals from LocalStorage and Prepend to DOM Table
     */
    function syncDynamicStoredReferrals() {
        let stored = [];
        try {
            stored = JSON.parse(localStorage.getItem('marsu_registered_referrals') || '[]');
        } catch (e) {
            console.warn('Storage parse warning:', e);
        }

        if (!Array.isArray(stored) || stored.length === 0) return;

        const tbody = document.getElementById('referralsTableBody');
        if (!tbody) return;

        // Check existing IDs to prevent duplicates
        const existingKeys = new Set();
        tbody.querySelectorAll('.referral-row').forEach(row => {
            const sid = row.getAttribute('data-student-id');
            const dt = row.getAttribute('data-date');
            if (sid && dt) existingKeys.add(sid + '::' + dt);
        });

        stored.forEach(item => {
            const sid = item.student_id || '';
            const dt = item.date || "<?= date('M d, Y') ?>";
            const key = sid + '::' + dt;
            if (existingKeys.has(key)) return;
            existingKeys.add(key);

            const tr = createReferralRowElement({
                date: dt,
                student_id: sid,
                student_name: item.student_name || 'Enrolled Student',
                program_year: item.program_year || '',
                college: item.college || '',
                referred_by: item.referred_by || item.referred_by_to || 'Faculty / Staff',
                contact: item.contact || '',
                reason: item.reason || 'Faculty Endorsement',
                observations: item.observations || '—',
                actions: item.actions || '—',
                comments: item.comments || item.notes || '—',
                urgency: item.urgency || 'Routine',
                status: item.status || 'Pending Review'
            });

            // Insert at beginning of table
            if (tbody.firstChild) {
                tbody.insertBefore(tr, tbody.firstChild);
            } else {
                tbody.appendChild(tr);
            }
        });
    }

    /**
     * Helper to build TR DOM Node
     */
    function createReferralRowElement(item) {
        const tr = document.createElement('tr');
        tr.className = 'referral-row align-middle';
        tr.setAttribute('data-date', item.date);
        tr.setAttribute('data-student-id', item.student_id);
        tr.setAttribute('data-student-name', item.student_name);
        tr.setAttribute('data-program', item.program_year);
        tr.setAttribute('data-college', item.college);
        tr.setAttribute('data-referred-by', item.referred_by);
        tr.setAttribute('data-contact', item.contact);
        tr.setAttribute('data-reason', item.reason);
        tr.setAttribute('data-observations', item.observations);
        tr.setAttribute('data-actions', item.actions);
        tr.setAttribute('data-comments', item.comments);
        tr.setAttribute('data-urgency', item.urgency);
        tr.setAttribute('data-status', item.status);

        // Urgency Badge
        let urgencyBadge = `<span class="badge bg-light text-secondary border" style="font-size: 11.5px;">Routine</span>`;
        if (item.urgency.includes('Urgent')) {
            urgencyBadge = `<span class="badge" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 600;">Urgent (24–72h)</span>`;
        } else if (item.urgency.includes('Emergency')) {
            urgencyBadge = `<span class="badge" style="background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-size: 11px; font-weight: 600;">Emergency</span>`;
        }

        // Status Badge
        let statusBadge = `<span class="badge" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Pending Review</span>`;
        if (item.status === 'Scheduled for Intake' || item.status === 'Accepted') {
            statusBadge = `<span class="badge" style="background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Scheduled for Intake</span>`;
        } else if (item.status === 'Completed' || item.status === 'Resolved') {
            statusBadge = `<span class="badge" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; font-size: 11.5px; border-radius: 50rem; padding: 4px 10px;">Completed</span>`;
        }

        tr.innerHTML = `
        <td class="ps-4 text-nowrap" style="padding: 14px 16px;">
            <span class="text-dark fw-medium">${item.date}</span>
        </td>
        <td class="text-nowrap" style="padding: 14px 16px;">
            <span class="fw-bold text-dark font-monospace">${item.student_id}</span>
        </td>
        <td class="text-nowrap" style="padding: 14px 16px;">
            <span class="fw-semibold text-dark">${item.student_name}</span>
        </td>
        <td class="text-nowrap" style="padding: 14px 16px;">
            <span class="badge bg-light text-secondary border" style="font-size: 12px;">${item.program_year || item.college || '—'}</span>
        </td>
        <td style="padding: 14px 16px; min-width: 170px;">
            <span class="fw-semibold text-dark">${item.referred_by}</span>
        </td>
        <td style="padding: 14px 16px; min-width: 180px;">
            <span class="text-dark text-truncate d-block" style="max-width: 220px;" title="${item.reason}">
                ${item.reason}
            </span>
        </td>
        <td style="padding: 14px 16px; min-width: 200px;">
            <span class="text-secondary text-truncate d-block" style="max-width: 240px;" title="${item.observations}">
                ${item.observations || '—'}
            </span>
        </td>
        <td class="text-nowrap" style="padding: 14px 16px;">
            ${urgencyBadge}
        </td>
        <td class="text-center text-nowrap" style="padding: 14px 16px;">
            ${statusBadge}
        </td>
        <td class="text-center pe-4 text-nowrap" style="padding: 14px 16px;">
            <a href="<?= url('guidance/referral_view') ?>?id=${encodeURIComponent(item.student_id)}"
                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                style="font-size: 12.5px; height: 32px; padding: 0 12px; border-radius: 6px; font-weight: 500; text-decoration: none;">
                View Details
            </a>
        </td>
    `;
        return tr;
    }

    /**
     * Filter DOM Table Rows directly (Matches appointment_lists mechanism)
     */
    function filterReferralsTable() {
        const q = (document.getElementById('searchReferralInput')?.value || '').toLowerCase().trim();
        const deptFilter = document.getElementById('deptFilterSelect')?.value || 'all';
        const urgencyFilter = document.getElementById('urgencyFilterSelect')?.value || 'all';
        const statusFilter = document.getElementById('statusFilterSelect')?.value || 'all';

        const rows = document.querySelectorAll('#referralsTableBody .referral-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const sid = (row.getAttribute('data-student-id') || '').toLowerCase();
            const sname = (row.getAttribute('data-student-name') || '').toLowerCase();
            const refBy = (row.getAttribute('data-referred-by') || '').toLowerCase();
            const rsn = (row.getAttribute('data-reason') || '').toLowerCase();
            const obs = (row.getAttribute('data-observations') || '').toLowerCase();
            const college = row.getAttribute('data-college') || '';
            const program = row.getAttribute('data-program') || '';
            const urgency = row.getAttribute('data-urgency') || '';
            const status = row.getAttribute('data-status') || '';

            const matchesQuery = !q || sid.includes(q) || sname.includes(q) || refBy.includes(q) || rsn.includes(q) || obs.includes(q);
            const matchesDept = (deptFilter === 'all') || college.includes(deptFilter) || program.includes(deptFilter) || refBy.includes(deptFilter);
            const matchesUrgency = (urgencyFilter === 'all') || urgency.includes(urgencyFilter);
            const matchesStatus = (statusFilter === 'all') || status.includes(statusFilter);

            if (matchesQuery && matchesDept && matchesUrgency && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const emptyNotice = document.getElementById('noReferralsMatchNotice');
        if (emptyNotice) {
            emptyNotice.classList.toggle('d-none', visibleCount > 0);
        }
    }

    /**
     * Apply KPI Card Filter
     */
    function applyReferralFilter(filterType, cardElement) {
        document.querySelectorAll('.kpi-filter-card').forEach(c => c.classList.remove('active'));
        if (cardElement) cardElement.classList.add('active');

        const urgSelect = document.getElementById('urgencyFilterSelect');
        const statSelect = document.getElementById('statusFilterSelect');

        if (filterType === 'all') {
            if (urgSelect) urgSelect.value = 'all';
            if (statSelect) statSelect.value = 'all';
        } else if (filterType === 'pending') {
            if (urgSelect) urgSelect.value = 'all';
            if (statSelect) statSelect.value = 'Pending Review';
        } else if (filterType === 'urgent') {
            if (urgSelect) urgSelect.value = 'Urgent';
            if (statSelect) statSelect.value = 'all';
        } else if (filterType === 'scheduled') {
            if (urgSelect) urgSelect.value = 'all';
            if (statSelect) statSelect.value = 'Scheduled for Intake';
        }

        filterReferralsTable();
    }

    /**
     * Reset All Filter Selections
     */
    function resetAllReferralFilters() {
        const searchInp = document.getElementById('searchReferralInput');
        if (searchInp) searchInp.value = '';

        const deptSelect = document.getElementById('deptFilterSelect');
        if (deptSelect) deptSelect.value = 'all';

        const urgSelect = document.getElementById('urgencyFilterSelect');
        if (urgSelect) urgSelect.value = 'all';

        const statSelect = document.getElementById('statusFilterSelect');
        if (statSelect) statSelect.value = 'all';

        document.querySelectorAll('.kpi-filter-card').forEach(c => c.classList.remove('active'));
        const allCard = document.getElementById('kpi-card-all');
        if (allCard) allCard.classList.add('active');

        filterReferralsTable();
    }

    /**
     * Update KPI Totals based on current rows
     */
    function updateKPIStatistics() {
        const rows = document.querySelectorAll('#referralsTableBody .referral-row');
        const total = rows.length;
        let pendingCount = 0, urgentCount = 0, scheduledCount = 0;

        rows.forEach(r => {
            const st = r.getAttribute('data-status') || '';
            const urg = r.getAttribute('data-urgency') || '';
            if (st === 'Pending Review') pendingCount++;
            if (urg.includes('Urgent') || urg.includes('Emergency')) urgentCount++;
            if (st === 'Scheduled for Intake' || st === 'Accepted' || st === 'Completed') scheduledCount++;
        });

        const elAll = document.getElementById('count-all');
        if (elAll) elAll.textContent = total;

        const elPen = document.getElementById('count-pending');
        if (elPen) elPen.textContent = pendingCount;

        const elUrg = document.getElementById('count-urgent');
        if (elUrg) elUrg.textContent = urgentCount;

        const elSch = document.getElementById('count-scheduled');
        if (elSch) elSch.textContent = scheduledCount;
    }

    /**
     * Open Referral Details Modal from Button Click
     */
    function openViewReferralFromRow(btn) {
        const row = btn.closest('.referral-row');
        if (!row) return;

        currentSelectedStudentId = row.getAttribute('data-student-id');

        const dt = row.getAttribute('data-date') || '—';
        const sid = row.getAttribute('data-student-id') || '—';
        const sname = row.getAttribute('data-student-name') || '—';
        const prog = row.getAttribute('data-program') || '';
        const col = row.getAttribute('data-college') || '';
        const refBy = row.getAttribute('data-referred-by') || '—';
        const contact = row.getAttribute('data-contact') || '';
        const reason = row.getAttribute('data-reason') || '—';
        const obs = row.getAttribute('data-observations') || '—';
        const actions = row.getAttribute('data-actions') || '—';
        const comments = row.getAttribute('data-comments') || '—';
        const urgency = row.getAttribute('data-urgency') || 'Routine';
        const status = row.getAttribute('data-status') || 'Pending Review';

        document.getElementById('viewRefDate').textContent = dt;
        document.getElementById('viewStudentID').textContent = sid;
        document.getElementById('viewStudentName').textContent = sname;
        document.getElementById('viewStudentProgram').textContent = prog + (col ? ' (' + col + ')' : '');
        document.getElementById('viewReferredBy').textContent = refBy;

        if (contact) {
            document.getElementById('viewContactWrapper').style.display = 'block';
            document.getElementById('viewTeacherContact').textContent = contact;
        } else {
            document.getElementById('viewContactWrapper').style.display = 'none';
        }

        document.getElementById('viewRefReason').textContent = reason;
        document.getElementById('viewRefObservations').textContent = obs;
        document.getElementById('viewRefActions').textContent = actions;
        document.getElementById('viewRefComments').textContent = comments;

        // Urgency Badge
        const urgBadge = document.getElementById('viewRefUrgencyBadge');
        if (urgBadge) {
            urgBadge.textContent = urgency;
            if (urgency.includes('Urgent')) {
                urgBadge.className = 'badge bg-warning text-dark';
            } else if (urgency.includes('Emergency')) {
                urgBadge.className = 'badge bg-danger text-white';
            } else {
                urgBadge.className = 'badge bg-secondary text-white';
            }
        }

        // Status Badge
        const statBadge = document.getElementById('viewStatusBadge');
        if (statBadge) {
            statBadge.textContent = status;
            statBadge.className = (status === 'Scheduled for Intake' || status === 'Accepted' || status === 'Completed')
                ? 'badge bg-success'
                : 'badge bg-warning text-dark';
        }

        const modalEl = document.getElementById('viewReferralDetailsModal');
        if (modalEl) {
            const modalInstance = new bootstrap.Modal(modalEl);
            modalInstance.show();
        }
    }

    /**
     * Transfer from Referral directly to Case Intake
     */
    function proceedFromReferralToIntake() {
        if (!currentSelectedStudentId) return;

        localStorage.setItem('marsu_selected_client_id', currentSelectedStudentId);

        const modalEl = document.getElementById('viewReferralDetailsModal');
        if (modalEl) {
            const m = bootstrap.Modal.getInstance(modalEl);
            if (m) m.hide();
        }

        showToast('Transferring student referral to Case Intake...', 'success');
        setTimeout(() => {
            window.location.href = "<?= url('guidance/case_registration') ?>";
        }, 600);
    }

    /**
     * Modal Student Autocomplete
     */
    function lookupModalStudent(val) {
        const clean = (val || '').trim().toLowerCase();
        if (!clean) return;

        const items = document.querySelectorAll('#studentDirectoryStore .dir-student-item');
        for (const item of items) {
            if ((item.getAttribute('data-id') || '').toLowerCase() === clean) {
                document.getElementById('m_student_name').value = item.getAttribute('data-name');
                document.getElementById('m_student_program').value = item.getAttribute('data-program') + ' - ' + item.getAttribute('data-year');
                break;
            }
        }
    }

    /**
     * Quick Directory Lookup
     */
    function openStudentDirectoryList() {
        renderDirectoryQuickList('');
        const modalEl = document.getElementById('quickDirectoryModal');
        if (modalEl) {
            const m = new bootstrap.Modal(modalEl);
            m.show();
        }
    }

    function renderDirectoryQuickList(query) {
        const q = (query || '').toLowerCase().trim();
        const tbody = document.getElementById('quickDirectoryTbody');
        if (!tbody) return;
        tbody.innerHTML = '';

        const items = document.querySelectorAll('#studentDirectoryStore .dir-student-item');
        let matched = 0;

        items.forEach(item => {
            const id = item.getAttribute('data-id') || '';
            const name = item.getAttribute('data-name') || '';
            const prog = item.getAttribute('data-program') || '';
            const yr = item.getAttribute('data-year') || '';
            const col = item.getAttribute('data-college') || '';

            if (!q || id.toLowerCase().includes(q) || name.toLowerCase().includes(q) || prog.toLowerCase().includes(q)) {
                matched++;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td class="fw-bold text-dark font-monospace">${id}</td>
                <td>${name}</td>
                <td>${prog} - ${yr}</td>
                <td><small class="text-muted">${col}</small></td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-outline-marsu"
                        onclick="selectDirectoryStudent('${id}')">Select</button>
                </td>
            `;
                tbody.appendChild(tr);
            }
        });

        if (matched === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center py-3 text-muted">No students found in directory store.</td></tr>`;
        }
    }

    function selectDirectoryStudent(id) {
        const items = document.querySelectorAll('#studentDirectoryStore .dir-student-item');
        for (const item of items) {
            if (item.getAttribute('data-id') === id) {
                document.getElementById('m_student_id').value = item.getAttribute('data-id');
                document.getElementById('m_student_name').value = item.getAttribute('data-name');
                document.getElementById('m_student_program').value = item.getAttribute('data-program') + ' - ' + item.getAttribute('data-year');
                break;
            }
        }
        const modalEl = document.getElementById('quickDirectoryModal');
        if (modalEl) {
            const m = bootstrap.Modal.getInstance(modalEl);
            if (m) m.hide();
        }
    }

    /**
     * Submit New Referral Form
     */
    function submitModalReferral() {
        const sId = document.getElementById('m_student_id')?.value.trim();
        const sName = document.getElementById('m_student_name')?.value.trim();
        const sProg = document.getElementById('m_student_program')?.value.trim();
        const fDate = document.getElementById('m_fac_date')?.value || "<?= date('Y-m-d') ?>";
        const fName = document.getElementById('m_fac_name')?.value.trim();
        const fDept = document.getElementById('m_fac_dept')?.value.trim();
        const fContact = document.getElementById('m_fac_contact')?.value.trim();
        const reason = document.getElementById('m_referral_reason')?.value;
        const observations = document.getElementById('m_other_observations')?.value.trim();

        if (!sId || !sName) {
            showToast('Please enter Student ID and Name.', 'warning');
            return;
        }
        if (!fName || !fDept) {
            showToast('Please specify referring teacher and department.', 'warning');
            return;
        }
        if (!reason) {
            showToast('Please select a reason for referral.', 'warning');
            return;
        }

        const actionsArr = [];
        document.querySelectorAll('#createReferralModal input[type="checkbox"]:checked').forEach(c => {
            actionsArr.push(c.value);
        });
        const comments = document.getElementById('m_additional_comments')?.value.trim() || '—';
        const urg = document.querySelector('input[name="m_urgency"]:checked')?.value || 'Routine';

        // Format date string
        const dateObj = new Date(fDate);
        const dateStr = dateObj.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

        const refObj = {
            date: dateStr,
            student_id: sId,
            student_name: sName,
            program_year: sProg,
            college: fDept,
            referred_by: fName + (fDept ? ' (' + fDept + ')' : ''),
            contact: fContact,
            reason: reason,
            observations: observations || '—',
            actions: actionsArr.join(', ') || 'Endorsed for counseling assessment',
            comments: comments,
            urgency: urg,
            status: 'Pending Review'
        };

        // Save to LocalStorage
        try {
            const existing = JSON.parse(localStorage.getItem('marsu_registered_referrals') || '[]');
            existing.unshift(refObj);
            localStorage.setItem('marsu_registered_referrals', JSON.stringify(existing));
        } catch (e) {
            console.warn('Storage error:', e);
        }

        // Prepend new row to table
        const tbody = document.getElementById('referralsTableBody');
        if (tbody) {
            const newTr = createReferralRowElement(refObj);
            if (tbody.firstChild) {
                tbody.insertBefore(newTr, tbody.firstChild);
            } else {
                tbody.appendChild(newTr);
            }
        }

        // Reset Form & Close Modal
        document.getElementById('newReferralForm')?.reset();
        const modalEl = document.getElementById('createReferralModal');
        if (modalEl) {
            const m = bootstrap.Modal.getInstance(modalEl);
            if (m) m.hide();
        }

        updateKPIStatistics();
        filterReferralsTable();
        showToast('Faculty referral record saved successfully!', 'success');
    }

    /**
     * Toast Notification Helper
     */
    function showToast(message, type) {
        const toastBox = document.getElementById('toastBox');
        if (!toastBox) return;

        let bgStyle = 'background-color: #166534; color: #fff;';
        let icon = 'bi-check-circle-fill';

        if (type === 'warning') {
            bgStyle = 'background-color: #b45309; color: #fff;';
            icon = 'bi-exclamation-triangle-fill';
        } else if (type === 'danger') {
            bgStyle = 'background-color: #991b1b; color: #fff;';
            icon = 'bi-x-circle-fill';
        }

        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center show shadow-lg mb-2';
        toastEl.style.cssText = bgStyle + ' border: none; border-radius: 8px; min-width: 280px; font-size: 14px;';
        toastEl.innerHTML = `
        <div class="d-flex p-3">
            <i class="bi ${icon} me-2 fs-5"></i>
            <div class="toast-body p-0 flex-grow-1">${message}</div>
            <button type="button" class="btn-close btn-close-white ms-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;
        toastBox.appendChild(toastEl);

        setTimeout(function () {
            if (toastEl && toastEl.parentElement) toastEl.remove();
        }, 4000);
    }
</script>