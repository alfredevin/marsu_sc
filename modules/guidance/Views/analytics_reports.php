<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: REPORTS MANAGEMENT             -->
<!-- ==================================================================== -->

<style>
    /* Clean Minimalist Report Tab Navigation */
    .report-tab-btn {
        font-size: 14px;
        font-weight: 600;
        color: #4A5568;
        border: 1px solid #CBD5E1;
        background-color: #F8FAFC;
        padding: 9px 18px;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .report-tab-btn:hover {
        background-color: #EDF2F7;
        color: #1A202C;
    }

    .report-tab-btn.active {
        background-color: #800020 !important;
        border-color: #800020 !important;
        color: #FFFFFF !important;
        box-shadow: 0 2px 6px rgba(128, 0, 32, 0.20);
    }

    .report-filter-bar {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 16px;
    }

    .report-summary-strip {
        background-color: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        padding: 12px 18px;
        margin-bottom: 16px;
        font-size: 14px;
    }

    /* Print Formatting Rules */
    @media print {
        body {
            background-color: #ffffff !important;
            color: #000000 !important;
            font-size: 11pt !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Hide Screen-Only UI Elements */
        .no-print,
        nav,
        .breadcrumb,
        .report-tab-navigation,
        .report-filter-bar,
        .btn,
        header,
        sidebar,
        aside,
        .navbar {
            display: none !important;
        }

        /* Show Print-Only Official Letterhead & Signatures */
        .print-only {
            display: block !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .card-body {
            padding: 0 !important;
        }

        /* Ensure only active report pane prints */
        .report-pane {
            display: none !important;
        }

        .report-pane.active {
            display: block !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 10pt !important;
        }

        th,
        td {
            border: 1px solid #333333 !important;
            padding: 6px 8px !important;
            color: #000000 !important;
            background-color: #ffffff !important;
        }

        th {
            background-color: #f2f2f2 !important;
            font-weight: bold !important;
        }

        .badge {
            border: 1px solid #555555 !important;
            color: #000000 !important;
            background: transparent !important;
            font-weight: normal !important;
            padding: 2px 6px !important;
        }
    }
</style>

<!-- 1. PAGE HEADER (Screen Only) -->
<!-- Replaced View Cases and New Case Intake with Export CSV and Print Report buttons -->
<div class="card shadow-sm border-0 mb-4 bg-white no-print"
    style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
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
                    Guidance Reports
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Guidance &amp; Counseling Reports
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Official reporting module for student concerns, case progress monitoring, and individual counseling
                    histories.
                </p>
            </div>
            <!-- Header Action Buttons: Export CSV & Print Report -->
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    onclick="exportActiveReportCSV()"
                    style="height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 16px;">
                    <i class="bi bi-file-earmark-spreadsheet me-2 text-success"></i>Export CSV
                </button>
                <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center"
                    onclick="window.print()"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 14px; height: 38px; border-radius: 6px; padding: 0 16px; font-weight: 500;">
                    <i class="bi bi-printer me-2"></i>Print Report
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 2. REPORT NAVIGATION TABS (Screen Only) -->
<div class="d-flex gap-2 mb-4 flex-wrap report-tab-navigation no-print">
    <button type="button" class="report-tab-btn active" id="tabBtnConcern" onclick="switchReportTab('concern')">
        <i class="bi bi-card-checklist me-2"></i>1. Student Concern Report
    </button>
    <button type="button" class="report-tab-btn" id="tabBtnProgress" onclick="switchReportTab('progress')">
        <i class="bi bi-bar-chart-steps me-2"></i>2. Case Progress Report
    </button>
    <button type="button" class="report-tab-btn" id="tabBtnHistory" onclick="switchReportTab('history')">
        <i class="bi bi-clock-history me-2"></i>3. Student Counseling History
    </button>
</div>

<!-- ==================================================================== -->
<!-- OFFICIAL MARSU PRINT HEADER (PRINT ONLY - APPLIES TO ALL REPORTS)    -->
<!-- ==================================================================== -->
<div class="print-only text-center mb-4" style="display: none;">
    <div
        style="font-size: 11pt; text-transform: uppercase; font-family: 'Times New Roman', serif; letter-spacing: 0.5px;">
        Republic of the Philippines</div>
    <div
        style="font-size: 15pt; font-weight: bold; color: #800020; font-family: 'Times New Roman', serif; margin-top: 2px;">
        MARINDUQUE STATE UNIVERSITY</div>
    <div style="font-size: 11pt; font-weight: bold; font-family: 'Times New Roman', serif;">OFFICE OF STUDENT AFFAIRS
        &amp; SERVICES</div>
    <div style="font-size: 10.5pt; font-style: italic; font-family: 'Times New Roman', serif;">Guidance and Counseling
        Services Center</div>
    <div style="font-size: 9.5pt; color: #333; font-family: 'Times New Roman', serif;">Panfilo Manguera Sr. Rd., Boac,
        Marinduque</div>
    <hr style="border-top: 2px solid #800020; margin-top: 10px; margin-bottom: 14px;">
</div>

<!-- ==================================================================== -->
<!-- REPORT 1: STUDENT CONCERN REPORT                                     -->
<!-- ==================================================================== -->
<div class="report-pane active" id="pane-concern">
    <!-- Minimal Filter Toolbar (No Search Bar, No Duplicate Print Button) -->
    <div class="report-filter-bar no-print shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-md-7 col-12">
                <label class="form-label text-dark fw-bold mb-1" style="font-size: 13.5px;">
                    <i class="bi bi-funnel-fill me-1 text-danger" style="color: #800020 !important;"></i>Filter by
                    Concern Category
                </label>
                <select id="concernFilterSelect" class="form-select shadow-none" onchange="filterConcernReport()"
                    style="height: 38px; font-size: 14px;">
                    <option value="all">All Concern Categories</option>
                    <option value="Mental Health">Mental Health &amp; Well-Being</option>
                    <option value="Academic">Academic &amp; Study Habits</option>
                    <option value="Family">Family &amp; Personal Relationships</option>
                    <option value="Career">Career &amp; Future Direction</option>
                    <option value="Financial">Financial Assistance</option>
                    <option value="Behavioral">Behavioral &amp; Conduct</option>
                    <option value="Diverse Learning">Diverse Learning &amp; PWD Support</option>
                    <option value="Other Inquiries">Other Inquiries</option>
                </select>
            </div>

            <div class="col-md-5 col-12">
                <label class="form-label text-dark fw-bold mb-1" style="font-size: 13.5px;">
                    <i class="bi bi-calendar3 me-1 text-secondary"></i>Academic Year
                </label>
                <select id="concernYearSelect" class="form-select shadow-none" onchange="filterConcernReport()"
                    style="height: 38px; font-size: 14px;">
                    <option value="AY 2026-2027" selected>AY 2026-2027</option>
                    <option value="AY 2025-2026">AY 2025-2026</option>
                    <option value="AY 2024-2025">AY 2024-2025</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Minimal Total Records Summary Banner -->
    <div class="report-summary-strip d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <i class="bi bi-people-fill me-2" style="color: #800020;"></i>
            <strong>Total Records:</strong> <span id="concernTotalCountText" class="fw-bold text-dark fs-6">0
                Students</span>
        </div>
        <div class="text-muted small">
            Category: <strong id="concernActiveFilterText" class="text-dark">All Categories</strong> &bull; Term:
            <strong id="concernActiveYearText" class="text-dark">AY 2026-2027</strong>
        </div>
    </div>

    <!-- Concern Report Table Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2"
            style="border-bottom: 1px solid #E2E8F0;">
            <div>
                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 16px;">
                    STUDENT CONCERN REPORT
                </h5>
                <div class="text-muted" style="font-size: 12.5px;">
                    Report Date: <strong><?= date('F d, Y') ?></strong> &bull; Total Filtered: <strong
                        id="concernHeaderTotalBadge" class="text-dark">0</strong>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="concernReportTable" style="font-size: 13.5px;">
                    <thead class="bg-light" style="border-bottom: 1px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4 text-nowrap" style="padding: 12px 14px; font-weight: 600; width: 50px;">#
                            </th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Date</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Student ID</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Student Full Name</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">College &amp; Program
                            </th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Year Level</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Concern Category</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Priority</th>
                            <th class="text-nowrap pe-4" style="padding: 12px 14px; font-weight: 600;">Counselor
                                In-Charge</th>
                        </tr>
                    </thead>
                    <tbody id="concernReportTbody">
                        <!-- Populated dynamically via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Official Signatory Block (Print Only) -->
    <div class="print-only mt-5 pt-4" style="display: none;">
        <div class="row" style="font-size: 11pt;">
            <div class="col-6">
                <div>Prepared and Certified by:</div>
                <div style="margin-top: 48px; font-weight: bold; text-decoration: underline;">DR. ELENA M. SANTOS, RGC
                </div>
                <div>Registered Guidance Counselor</div>
                <div>PRC License No.: 004821</div>
            </div>
            <div class="col-6 text-end">
                <div>Noted and Approved by:</div>
                <div style="margin-top: 48px; font-weight: bold; text-decoration: underline;">DR. DANILO G. NAVARRO
                </div>
                <div>Director, Office of Student Affairs &amp; Services</div>
                <div>Marinduque State University</div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- REPORT 2: CASE PROGRESS REPORT                                       -->
<!-- ==================================================================== -->
<div class="report-pane" id="pane-progress" style="display: none;">
    <!-- Minimal Filter Toolbar (No Search Bar, No Duplicate Print Button) -->
    <div class="report-filter-bar no-print shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-md-7 col-12">
                <label class="form-label text-dark fw-bold mb-1" style="font-size: 13.5px;">
                    <i class="bi bi-funnel-fill me-1 text-danger" style="color: #800020 !important;"></i>Filter by
                    Progress Status
                </label>
                <select id="progressStatusFilterSelect" class="form-select shadow-none"
                    onchange="filterProgressReport()" style="height: 38px; font-size: 14px;">
                    <option value="all">All Progress Statuses</option>
                    <option value="In Progress">On-going (In Progress)</option>
                    <option value="Under Observation">For Follow-Up / Under Observation</option>
                    <option value="Resolved">Resolved / Closed</option>
                </select>
            </div>

            <div class="col-md-5 col-12">
                <label class="form-label text-dark fw-bold mb-1" style="font-size: 13.5px;">
                    <i class="bi bi-calendar3 me-1 text-secondary"></i>Academic Year
                </label>
                <select id="progressYearSelect" class="form-select shadow-none" onchange="filterProgressReport()"
                    style="height: 38px; font-size: 14px;">
                    <option value="AY 2026-2027" selected>AY 2026-2027</option>
                    <option value="AY 2025-2026">AY 2025-2026</option>
                    <option value="AY 2024-2025">AY 2024-2025</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Minimal Case Progress Total & Status Breakdown Strip (NO KPI CARDS) -->
    <div class="report-summary-strip d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <i class="bi bi-folder-check me-2" style="color: #800020;"></i>
            <strong>Total Records:</strong> <span id="progTotalCount" class="fw-bold text-dark fs-6">0 Cases</span>
        </div>
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <span>On-going (In Progress): <strong id="progOngoingCount" class="text-primary">0</strong></span>
            <span>&bull;</span>
            <span>For Follow-Up: <strong id="progFollowupCount" class="text-warning text-dark">0</strong></span>
            <span>&bull;</span>
            <span>Resolved / Closed: <strong id="progResolvedCount" class="text-success">0</strong></span>
        </div>
    </div>

    <!-- Progress Report Table Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2"
            style="border-bottom: 1px solid #E2E8F0;">
            <div>
                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 16px;">
                    CASE PROGRESS REPORT
                </h5>
                <div class="text-muted" style="font-size: 12.5px;">
                    Report Date: <strong><?= date('F d, Y') ?></strong> &bull; Total Filtered: <strong
                        id="progressHeaderTotalBadge" class="text-dark">0</strong>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="progressReportTable" style="font-size: 13.5px;">
                    <thead class="bg-light" style="border-bottom: 1px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4 text-nowrap" style="padding: 12px 14px; font-weight: 600; width: 50px;">#
                            </th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Case ID</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Date Opened</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Student ID</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Student Full Name</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Concern Category</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Case Plan / Current
                                Action</th>
                            <th class="text-center text-nowrap" style="padding: 12px 14px; font-weight: 600;">Progress
                                Status</th>
                            <th class="text-nowrap pe-4" style="padding: 12px 14px; font-weight: 600;">Return Schedule /
                                Follow-Up</th>
                        </tr>
                    </thead>
                    <tbody id="progressReportTbody">
                        <!-- Populated dynamically via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Official Signatory Block (Print Only) -->
    <div class="print-only mt-5 pt-4" style="display: none;">
        <div class="row" style="font-size: 11pt;">
            <div class="col-6">
                <div>Prepared and Certified by:</div>
                <div style="margin-top: 48px; font-weight: bold; text-decoration: underline;">DR. ELENA M. SANTOS, RGC
                </div>
                <div>Registered Guidance Counselor</div>
                <div>PRC License No.: 004821</div>
            </div>
            <div class="col-6 text-end">
                <div>Noted and Approved by:</div>
                <div style="margin-top: 48px; font-weight: bold; text-decoration: underline;">DR. DANILO G. NAVARRO
                </div>
                <div>Director, Office of Student Affairs &amp; Services</div>
                <div>Marinduque State University</div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- REPORT 3: STUDENT COUNSELING HISTORY REPORT (ALL STUDENTS' HISTORY)   -->
<!-- ==================================================================== -->
<div class="report-pane" id="pane-history" style="display: none;">
    <!-- Minimal Filter Toolbar: Filter by Milestone / Category (No Search Bar) -->
    <div class="report-filter-bar no-print shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-md-7 col-12">
                <label class="form-label text-dark fw-bold mb-1" style="font-size: 13.5px;">
                    <i class="bi bi-funnel-fill me-1 text-danger" style="color: #800020 !important;"></i>Filter by
                    Milestone / Session Activity
                </label>
                <select id="historyMilestoneFilterSelect" class="form-select shadow-none"
                    onchange="filterAllStudentHistory()" style="height: 38px; font-size: 14px;">
                    <option value="all">All Milestones &amp; Sessions</option>
                    <option value="Intake">Case Intake &amp; Initial Consultation</option>
                    <option value="Assessment">Case Assessment</option>
                    <option value="Intervention">Intervention &amp; Case Plan</option>
                    <option value="Follow-Up">Follow-Up Counseling Session</option>
                    <option value="Resolution">Case Resolution &amp; Closure</option>
                </select>
            </div>

            <div class="col-md-5 col-12">
                <label class="form-label text-dark fw-bold mb-1" style="font-size: 13.5px;">
                    <i class="bi bi-building me-1 text-secondary"></i>Filter by College / Department
                </label>
                <select id="historyCollegeFilterSelect" class="form-select shadow-none"
                    onchange="filterAllStudentHistory()" style="height: 38px; font-size: 14px;">
                    <option value="all">All Colleges / Academic Units</option>
                    <option value="CICT">CICT</option>
                    <option value="CAS">CAS</option>
                    <option value="CED">CED</option>
                    <option value="CBA">CBA</option>
                    <option value="CEA">CEA</option>
                    <option value="CNHS">CNHS</option>
                    <option value="CAFES">CAFES</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Total Records Display Banner for All Student History -->
    <div class="report-summary-strip d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <i class="bi bi-clock-history me-2" style="color: #800020;"></i>
            <strong>Total Records:</strong> <span id="historyTotalCountText" class="fw-bold text-dark fs-6">0 Session
                Records</span>
        </div>
        <div class="text-muted small">
            Master Counseling History Ledger across all enrolled students
        </div>
    </div>

    <!-- Student Counseling History Table Card (All Students) -->
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2"
            style="border-bottom: 1px solid #E2E8F0;">
            <div>
                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 16px;">
                    MASTER STUDENT COUNSELING HISTORY LEDGER
                </h5>
                <div class="text-muted" style="font-size: 12.5px;">
                    Report Date: <strong><?= date('F d, Y') ?></strong> &bull; Total History Logs: <strong
                        id="historyHeaderTotalBadge" class="text-dark">0</strong>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="historyReportTable" style="font-size: 13.5px;">
                    <thead class="bg-light" style="border-bottom: 1px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4 text-nowrap" style="padding: 12px 14px; font-weight: 600; width: 50px;">#
                            </th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Date</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Student ID</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Student Full Name</th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">College &amp; Program
                            </th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Activity / Milestone
                            </th>
                            <th class="text-nowrap" style="padding: 12px 14px; font-weight: 600;">Counselor In-Charge
                            </th>
                            <th style="padding: 12px 14px; font-weight: 600; min-width: 220px;">Observations &amp;
                                Discussion Notes</th>
                            <th style="padding: 12px 14px; font-weight: 600; min-width: 200px;">Action Taken / Outcome
                            </th>
                            <th class="text-center text-nowrap pe-4"
                                style="padding: 12px 14px; font-weight: 600; width: 100px;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="allHistoryTbody">
                        <!-- Populated dynamically via JS for all students -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Official Signatory Block (Print Only) -->
    <div class="print-only mt-5 pt-4" style="display: none;">
        <div class="row" style="font-size: 11pt;">
            <div class="col-6">
                <div>Attested by Attending Counselor:</div>
                <div style="margin-top: 48px; font-weight: bold; text-decoration: underline;">DR. ELENA M. SANTOS, RGC
                </div>
                <div>Registered Guidance Counselor</div>
                <div>PRC License No.: 004821</div>
            </div>
            <div class="col-6 text-end">
                <div>Noted by:</div>
                <div style="margin-top: 48px; font-weight: bold; text-decoration: underline;">DR. DANILO G. NAVARRO
                </div>
                <div>Director, Office of Student Affairs &amp; Services</div>
                <div>Marinduque State University</div>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING TOAST NOTIFICATION BOX -->
<div id="toastBox" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>

<!-- ==================================================================== -->
<!-- VANILLA JAVASCRIPT REPORTING & CSV EXPORT ENGINE                     -->
<!-- ==================================================================== -->
<script>
    // Master List of Cases for Concern and Progress Reports
    const baseCasesData = [
        {
            case_id: "CAS-2026-001",
            date: "2026-10-28",
            ay: "AY 2026-2027",
            student_id: "2023-01042",
            student_name: "SANTOS, MARIA C.",
            college: "CAS",
            program: "BA Political Science",
            year: "2nd Year",
            concern_category: "Mental Health & Well-Being",
            priority: "High Priority",
            status: "In Progress",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Deep breathing exercises, cognitive reframing, study scheduling",
            follow_up: "2026-11-06 (Face-to-Face)"
        },
        {
            case_id: "CAS-2026-002",
            date: "2026-10-25",
            ay: "AY 2026-2027",
            student_id: "2023-01089",
            student_name: "RAMOS, CARLOS M.",
            college: "CICT",
            program: "BS Information Technology",
            year: "3rd Year",
            concern_category: "Academic & Study Habits",
            priority: "Medium Priority",
            status: "Under Observation",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Laboratory catch-up schedule, peer mentoring arrangement",
            follow_up: "2026-11-08 (Face-to-Face)"
        },
        {
            case_id: "CAS-2026-003",
            date: "2026-10-22",
            ay: "AY 2026-2027",
            student_id: "2023-02194",
            student_name: "REYES, MARK ANTHONY",
            college: "CEA",
            program: "BS Civil Engineering",
            year: "2nd Year",
            concern_category: "Mental Health & Well-Being",
            priority: "High Priority",
            status: "In Progress",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Individual counseling therapy, wellness routine, weekly mood check-in",
            follow_up: "2026-11-05 (Face-to-Face)"
        },
        {
            case_id: "CAS-2026-004",
            date: "2026-10-18",
            ay: "AY 2026-2027",
            student_id: "2022-00512",
            student_name: "MENDOZA, JUAN B.",
            college: "CED",
            program: "BEED",
            year: "3rd Year",
            concern_category: "Academic & Study Habits",
            priority: "Medium Priority",
            status: "Under Observation",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Action plan for midterm review, consultation with education department",
            follow_up: "2026-11-10 (Face-to-Face)"
        },
        {
            case_id: "CAS-2026-005",
            date: "2026-10-15",
            ay: "AY 2026-2027",
            student_id: "2024-03115",
            student_name: "DELA CRUZ, BEA L.",
            college: "CBA",
            program: "BS Tourism Management",
            year: "1st Year",
            concern_category: "Family & Personal Relationships",
            priority: "Low Priority",
            status: "Resolved",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Budget counseling, boarding house coordinator referral, peer circle",
            follow_up: "Case Resolved"
        },
        {
            case_id: "CAS-2026-006",
            date: "2026-10-12",
            ay: "AY 2026-2027",
            student_id: "2024-01582",
            student_name: "GONZALES, ALYSSA P.",
            college: "CNHS",
            program: "BS Nursing",
            year: "1st Year",
            concern_category: "Mental Health & Well-Being",
            priority: "High Priority",
            status: "In Progress",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Desensitization exercises, clinical simulation coping strategy",
            follow_up: "2026-11-07 (Face-to-Face)"
        },
        {
            case_id: "CAS-2026-007",
            date: "2026-10-08",
            ay: "AY 2026-2027",
            student_id: "2022-03481",
            student_name: "BAUTISTA, KEVIN R.",
            college: "CAFES",
            program: "BS Agriculture",
            year: "4th Year",
            concern_category: "Career & Future Direction",
            priority: "Low Priority",
            status: "Resolved",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "RIASEC profiling, resume review, career guidance mapping",
            follow_up: "Case Resolved"
        },
        {
            case_id: "CAS-2026-008",
            date: "2026-10-05",
            ay: "AY 2026-2027",
            student_id: "2023-04129",
            student_name: "VILLANUEVA, PATRICIA M.",
            college: "CBA",
            program: "BS Accountancy",
            year: "2nd Year",
            concern_category: "Behavioral & Conduct",
            priority: "Medium Priority",
            status: "Resolved",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Conflict resolution mediation session, communication contract",
            follow_up: "Case Resolved"
        },
        {
            case_id: "CAS-2026-009",
            date: "2026-09-29",
            ay: "AY 2026-2027",
            student_id: "2024-02205",
            student_name: "TAN, JUSTINE CHLOE",
            college: "CAS",
            program: "BS Biology",
            year: "1st Year",
            concern_category: "Mental Health & Well-Being",
            priority: "High Priority",
            status: "Under Observation",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Weekly check-ins, campus peer facilitator buddy assignment",
            follow_up: "2026-11-12 (Face-to-Face)"
        },
        {
            case_id: "CAS-2026-010",
            date: "2026-09-20",
            ay: "AY 2026-2027",
            student_id: "2024-00871",
            student_name: "AQUINO, CHRISTIAN J.",
            college: "CED",
            program: "BSEd English",
            year: "1st Year",
            concern_category: "Financial Assistance",
            priority: "Low Priority",
            status: "Resolved",
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Student welfare scholarship endorsement, library textbook reserve",
            follow_up: "Case Resolved"
        }
    ];

    // Master Ledger of ALL Students' Counseling History Records
    const masterAllStudentHistory = [
        {
            date: "2026-10-28",
            student_id: "2023-01042",
            student_name: "SANTOS, MARIA C.",
            college: "CAS",
            program: "BA Political Science",
            milestone: "Case Intake & Initial Consultation",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Client presented with severe test anxiety, hyperventilation prior to oral recitations, and difficulty speaking in class.",
            action: "Administered GAD-7 anxiety inventory; scheduled comprehensive assessment session.",
            status: "In Progress"
        },
        {
            date: "2026-10-30",
            student_id: "2023-01042",
            student_name: "SANTOS, MARIA C.",
            college: "CAS",
            program: "BA Political Science",
            milestone: "Case Assessment",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Tool used: Anxiety Rating Checklist & Mind Mapping. High somatic tension observed regarding academic performance.",
            action: "Taught 4-7-8 breathing technique, sensory grounding, and scheduled individual counseling.",
            status: "In Progress"
        },
        {
            date: "2026-11-02",
            student_id: "2023-01042",
            student_name: "SANTOS, MARIA C.",
            college: "CAS",
            program: "BA Political Science",
            milestone: "Intervention & Case Plan Session",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Client reported practicing grounding during study hours with slight improvement in sleep regularity.",
            action: "Agreed on incremental speech practice and established weekly monitoring check-in.",
            status: "In Progress"
        },
        {
            date: "2026-10-25",
            student_id: "2023-01089",
            student_name: "RAMOS, CARLOS M.",
            college: "CICT",
            program: "BS Information Technology",
            milestone: "Case Intake (Faculty Referral)",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Referred by Prof. Danilo Navarro (CICT). Drop in academic performance, missed 4 laboratory sessions.",
            action: "Conducted initial intake interview; client cited balancing evening job with academic deadlines.",
            status: "Under Observation"
        },
        {
            date: "2026-10-29",
            student_id: "2023-01089",
            student_name: "RAMOS, CARLOS M.",
            college: "CICT",
            program: "BS Information Technology",
            milestone: "Intervention & Time Management Plan",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Client developed weekly study timetable allocating dedicated hours for coding exercises.",
            action: "Coordinated with department chair for lab makeup assignment; scheduled follow-up on Nov 8.",
            status: "Under Observation"
        },
        {
            date: "2026-10-22",
            student_id: "2023-02194",
            student_name: "REYES, MARK ANTHONY",
            college: "CEA",
            program: "BS Civil Engineering",
            milestone: "Case Intake & Wellness Assessment",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Referred by Engr. Ronald Flores (CEA). Sits isolated during drafting classes, prolonged social withdrawal.",
            action: "Conducted supportive counseling intake, administered PHQ-9 screen, formulated wellness goals.",
            status: "In Progress"
        },
        {
            date: "2026-10-27",
            student_id: "2023-02194",
            student_name: "REYES, MARK ANTHONY",
            college: "CEA",
            program: "BS Civil Engineering",
            milestone: "Follow-Up Counseling Session",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Discussed social avoidance triggers and reconnecting with former study group members.",
            action: "Assigned behavioral activation step (one social lunch interaction per day); set return date.",
            status: "In Progress"
        },
        {
            date: "2026-10-18",
            student_id: "2022-00512",
            student_name: "MENDOZA, JUAN B.",
            college: "CED",
            program: "BEED",
            milestone: "Case Intake & Academic Advising",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Referred by Dr. Corazon Villalobos. Retention warning in professional education subjects.",
            action: "Formulated midterm review targets; scheduled study routine session.",
            status: "Under Observation"
        },
        {
            date: "2026-10-23",
            student_id: "2022-00512",
            student_name: "MENDOZA, JUAN B.",
            college: "CED",
            program: "BEED",
            milestone: "Case Assessment & Study Plan",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Client reviewed time log and identified high procrastination triggers during evening hours.",
            action: "Established study partner accountability agreement; follow-up set for Nov 10.",
            status: "Under Observation"
        },
        {
            date: "2026-10-15",
            student_id: "2024-03115",
            student_name: "DELA CRUZ, BEA L.",
            college: "CBA",
            program: "BS Tourism Management",
            milestone: "Case Intake & Personal Adjustment",
            counselor: "Dr. Elena Santos, RGC",
            notes: "First-year student struggling with boarding house loneliness, homesickness, and tight allowance.",
            action: "Provided active listening, psychoeducation on freshman adjustment, connected with campus student welfare.",
            status: "Under Observation"
        },
        {
            date: "2026-10-26",
            student_id: "2024-03115",
            student_name: "DELA CRUZ, BEA L.",
            college: "CBA",
            program: "BS Tourism Management",
            milestone: "Case Resolution & Closure",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Student successfully settled into student dormitory community, joined tourism club, reports improved mood.",
            action: "Goals achieved; case officially closed with positive prognosis.",
            status: "Resolved"
        },
        {
            date: "2026-10-12",
            student_id: "2024-01582",
            student_name: "GONZALES, ALYSSA P.",
            college: "CNHS",
            program: "BS Nursing",
            milestone: "Case Intake & Anxiety Assessment",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Acute clinical duty panic symptoms, fear of clinical procedure error during patient rotation.",
            action: "Administered stress appraisal; scheduled desensitization exercises.",
            status: "In Progress"
        },
        {
            date: "2026-10-17",
            student_id: "2024-01582",
            student_name: "GONZALES, ALYSSA P.",
            college: "CNHS",
            program: "BS Nursing",
            milestone: "Follow-Up Counseling Session",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Practiced clinical simulation breathing; reported lower heart rate during practical lab.",
            action: "Briefed clinical instructor; continuation of positive visualization exercises.",
            status: "In Progress"
        },
        {
            date: "2026-10-08",
            student_id: "2022-03481",
            student_name: "BAUTISTA, KEVIN R.",
            college: "CAFES",
            program: "BS Agriculture",
            milestone: "Career Guidance & Profiling Intake",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Graduating senior anxious over career paths and agriculture board examination readiness.",
            action: "Administered RIASEC vocational inventory and set resume workshop session.",
            status: "Under Observation"
        },
        {
            date: "2026-10-19",
            student_id: "2022-03481",
            student_name: "BAUTISTA, KEVIN R.",
            college: "CAFES",
            program: "BS Agriculture",
            milestone: "Case Resolution & Closure",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Completed career mapping and registered for regional review center cohort.",
            action: "Career goals finalized; case closed successfully.",
            status: "Resolved"
        },
        {
            date: "2026-10-05",
            student_id: "2023-04129",
            student_name: "VILLANUEVA, PATRICIA M.",
            college: "CBA",
            program: "BS Accountancy",
            milestone: "Conflict Resolution Intake",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Interpersonal conflict with group project partner causing study distractions.",
            action: "Conducted individual conflict intake; scheduled joint mediation.",
            status: "Under Observation"
        },
        {
            date: "2026-10-14",
            student_id: "2023-04129",
            student_name: "VILLANUEVA, PATRICIA M.",
            college: "CBA",
            program: "BS Accountancy",
            milestone: "Case Resolution & Closure",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Mediation successfully executed; students established clear project boundaries.",
            action: "Signed mutual communication contract; case resolved.",
            status: "Resolved"
        },
        {
            date: "2026-09-29",
            student_id: "2024-02205",
            student_name: "TAN, JUSTINE CHLOE",
            college: "CAS",
            program: "BS Biology",
            milestone: "Case Intake & Adjustment Support",
            counselor: "Dr. Elena Santos, RGC",
            notes: "First-year biology major experiencing severe homesickness and academic adjustment distress.",
            action: "Psychoeducation provided; assigned peer facilitator buddy.",
            status: "Under Observation"
        },
        {
            date: "2026-09-20",
            student_id: "2024-00871",
            student_name: "AQUINO, CHRISTIAN J.",
            college: "CED",
            program: "BSEd English",
            milestone: "Student Welfare Assistance Intake",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Financial constraints regarding textbook purchases and required English instructional materials.",
            action: "Endorsed to University Student Welfare book-loan reserve.",
            status: "Under Observation"
        },
        {
            date: "2026-09-28",
            student_id: "2024-00871",
            student_name: "AQUINO, CHRISTIAN J.",
            college: "CED",
            program: "BSEd English",
            milestone: "Case Resolution & Closure",
            counselor: "Dr. Elena Santos, RGC",
            notes: "Textbook scholarship grant confirmed by library; student actively attending lectures.",
            action: "Financial aid confirmed; case closed successfully.",
            status: "Resolved"
        }
    ];

    let currentActiveTab = 'concern';
    let allCasesData = [];
    let currentConcernFiltered = [];
    let currentProgressFiltered = [];
    let currentHistoryFiltered = [];

    document.addEventListener('DOMContentLoaded', function () {
        initReports();
    });

    /**
     * Initialize Reporting Data
     */
    function initReports() {
        // Load custom registered cases from localStorage (if any) and merge
        let localCases = [];
        try {
            localCases = JSON.parse(localStorage.getItem('marsu_registered_cases') || '[]');
        } catch (e) {
            console.error('Storage parse error:', e);
        }

        const formattedLocalCases = localCases.map((c, index) => ({
            case_id: c.case_id || ("CAS-2026-" + String(100 + index)),
            date: c.opened_date || "<?= date('Y-m-d') ?>",
            ay: "AY 2026-2027",
            student_id: c.student_id || "2023-01089",
            student_name: c.student_name || "Enrolled Student",
            college: "CICT",
            program: "Undergraduate",
            year: "3rd Year",
            concern_category: c.concern_type || "General Counseling",
            priority: c.priority || "Medium Priority",
            status: (c.status === 'Closed' || c.status === 'Resolved') ? 'Resolved' :
                (c.status === 'Under Observation' ? 'Under Observation' : 'In Progress'),
            counselor: "Dr. Elena Santos, RGC",
            case_plan: "Individual counseling & case plan",
            follow_up: "Scheduled Follow-Up"
        }));

        const combined = [...formattedLocalCases];
        baseCasesData.forEach(seed => {
            if (!combined.some(c => c.case_id === seed.case_id || (c.student_id === seed.student_id && c.date === seed.date))) {
                combined.push(seed);
            }
        });

        allCasesData = combined;

        // Render Reports
        filterConcernReport();
        filterProgressReport();
        filterAllStudentHistory();
    }

    /**
     * Switch Between Report Tabs
     */
    function switchReportTab(tabKey) {
        currentActiveTab = tabKey;
        document.querySelectorAll('.report-tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.report-pane').forEach(pane => {
            pane.style.display = 'none';
            pane.classList.remove('active');
        });

        if (tabKey === 'concern') {
            document.getElementById('tabBtnConcern').classList.add('active');
            const pane = document.getElementById('pane-concern');
            pane.style.display = 'block';
            pane.classList.add('active');
            filterConcernReport();
        } else if (tabKey === 'progress') {
            document.getElementById('tabBtnProgress').classList.add('active');
            const pane = document.getElementById('pane-progress');
            pane.style.display = 'block';
            pane.classList.add('active');
            filterProgressReport();
        } else if (tabKey === 'history') {
            document.getElementById('tabBtnHistory').classList.add('active');
            const pane = document.getElementById('pane-history');
            pane.style.display = 'block';
            pane.classList.add('active');
            filterAllStudentHistory();
        }
    }

    /**
     * ====================================================================
     * REPORT 1: STUDENT CONCERN REPORT FILTER & RENDER
     * ====================================================================
     */
    function filterConcernReport() {
        const concernFilter = document.getElementById('concernFilterSelect').value;
        const yearFilter = document.getElementById('concernYearSelect').value;

        const categoryLabel = concernFilter === 'all' ? 'All Categories' : document.getElementById('concernFilterSelect').options[document.getElementById('concernFilterSelect').selectedIndex].text;
        document.getElementById('concernActiveFilterText').textContent = categoryLabel;
        document.getElementById('concernActiveYearText').textContent = yearFilter;

        const filtered = allCasesData.filter(item => {
            const matchesCategory = (concernFilter === 'all') || item.concern_category.toLowerCase().includes(concernFilter.toLowerCase());
            const matchesYear = (yearFilter === 'all') || (item.ay === yearFilter);
            return matchesCategory && matchesYear;
        });

        currentConcernFiltered = filtered;
        const total = filtered.length;
        document.getElementById('concernTotalCountText').textContent = total + (total === 1 ? ' Student' : ' Students');
        document.getElementById('concernHeaderTotalBadge').textContent = total + (total === 1 ? ' Record' : ' Records');

        renderConcernTable(filtered);
    }

    function renderConcernTable(list) {
        const tbody = document.getElementById('concernReportTbody');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted">No student records found matching selected concern category.</td></tr>`;
            return;
        }

        list.forEach((item, index) => {
            const tr = document.createElement('tr');

            let priorityBadge = `<span class="badge bg-light text-secondary border">Medium Priority</span>`;
            if (item.priority.includes('High')) {
                priorityBadge = `<span class="badge" style="background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-weight: 600;">High Priority</span>`;
            } else if (item.priority.includes('Low')) {
                priorityBadge = `<span class="badge bg-light text-secondary border">Low Priority</span>`;
            }

            tr.innerHTML = `
                <td class="ps-4 text-muted fw-semibold">${index + 1}</td>
                <td class="text-nowrap">${item.date}</td>
                <td class="text-nowrap fw-bold text-dark font-monospace">${item.student_id}</td>
                <td class="text-nowrap fw-semibold text-dark">${item.student_name}</td>
                <td class="text-nowrap"><span class="badge bg-light text-secondary border">${item.college} - ${item.program}</span></td>
                <td class="text-nowrap">${item.year}</td>
                <td class="text-nowrap">
                    <span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 600; padding: 4px 8px;">
                        ${item.concern_category}
                    </span>
                </td>
                <td class="text-nowrap">${priorityBadge}</td>
                <td class="text-nowrap pe-4 text-secondary">${item.counselor}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    /**
     * ====================================================================
     * REPORT 2: CASE PROGRESS REPORT FILTER & RENDER (NO KPI CARDS)
     * ====================================================================
     */
    function filterProgressReport() {
        const statusFilter = document.getElementById('progressStatusFilterSelect').value;
        const yearFilter = document.getElementById('progressYearSelect').value;

        let ongoingCount = 0, followupCount = 0, resolvedCount = 0;
        allCasesData.forEach(item => {
            if (yearFilter === 'all' || item.ay === yearFilter) {
                if (item.status === 'In Progress') ongoingCount++;
                else if (item.status === 'Under Observation') followupCount++;
                else if (item.status === 'Resolved' || item.status === 'Closed') resolvedCount++;
            }
        });

        const totalAll = (ongoingCount + followupCount + resolvedCount);
        document.getElementById('progOngoingCount').textContent = ongoingCount;
        document.getElementById('progFollowupCount').textContent = followupCount;
        document.getElementById('progResolvedCount').textContent = resolvedCount;
        document.getElementById('progTotalCount').textContent = totalAll + (totalAll === 1 ? ' Case' : ' Cases');

        const filtered = allCasesData.filter(item => {
            const matchesStatus = (statusFilter === 'all') || (item.status === statusFilter);
            const matchesYear = (yearFilter === 'all') || (item.ay === yearFilter);
            return matchesStatus && matchesYear;
        });

        currentProgressFiltered = filtered;
        document.getElementById('progressHeaderTotalBadge').textContent = filtered.length + (filtered.length === 1 ? ' Record' : ' Records');

        renderProgressTable(filtered);
    }

    function renderProgressTable(list) {
        const tbody = document.getElementById('progressReportTbody');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted">No cases found matching progress status criteria.</td></tr>`;
            return;
        }

        list.forEach((item, index) => {
            const tr = document.createElement('tr');

            let statusBadge = `<span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 12px; padding: 4px 10px; border-radius: 50rem;">On-going</span>`;
            if (item.status === 'Under Observation') {
                statusBadge = `<span class="badge" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 12px; padding: 4px 10px; border-radius: 50rem;">For Follow-up</span>`;
            } else if (item.status === 'Resolved' || item.status === 'Closed') {
                statusBadge = `<span class="badge" style="background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px; padding: 4px 10px; border-radius: 50rem;">Resolved</span>`;
            }

            tr.innerHTML = `
                <td class="ps-4 text-muted fw-semibold">${index + 1}</td>
                <td class="text-nowrap fw-bold" style="color: #800020;">${item.case_id}</td>
                <td class="text-nowrap">${item.date}</td>
                <td class="text-nowrap fw-bold text-dark font-monospace">${item.student_id}</td>
                <td class="text-nowrap fw-semibold text-dark">${item.student_name}</td>
                <td class="text-nowrap"><span class="badge bg-light text-dark border">${item.concern_category}</span></td>
                <td style="min-width: 200px;">
                    <div class="text-dark small fw-medium">${item.case_plan}</div>
                </td>
                <td class="text-center text-nowrap">${statusBadge}</td>
                <td class="text-nowrap pe-4 text-secondary">${item.follow_up}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    /**
     * ====================================================================
     * REPORT 3: STUDENT COUNSELING HISTORY (ALL STUDENTS' HISTORY)
     * ====================================================================
     */
    function filterAllStudentHistory() {
        const milestoneFilter = document.getElementById('historyMilestoneFilterSelect').value;
        const collegeFilter = document.getElementById('historyCollegeFilterSelect').value;

        const filtered = masterAllStudentHistory.filter(item => {
            const matchesMilestone = (milestoneFilter === 'all') || item.milestone.toLowerCase().includes(milestoneFilter.toLowerCase());
            const matchesCollege = (collegeFilter === 'all') || (item.college === collegeFilter);
            return matchesMilestone && matchesCollege;
        });

        currentHistoryFiltered = filtered;
        const total = filtered.length;
        document.getElementById('historyTotalCountText').textContent = total + (total === 1 ? ' Session Record' : ' Session Records');
        document.getElementById('historyHeaderTotalBadge').textContent = total + (total === 1 ? ' Record' : ' Records');

        renderAllStudentHistoryTable(filtered);
    }

    function renderAllStudentHistoryTable(list) {
        const tbody = document.getElementById('allHistoryTbody');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            tbody.innerHTML = `<tr><td colspan="10" class="text-center py-5 text-muted">No counseling history records found matching criteria.</td></tr>`;
            return;
        }

        list.forEach((item, index) => {
            const tr = document.createElement('tr');

            let statusBadge = `<span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11.5px;">In Progress</span>`;
            if (item.status === 'Under Observation') {
                statusBadge = `<span class="badge" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px;">Follow-up</span>`;
            } else if (item.status === 'Resolved' || item.status === 'Closed') {
                statusBadge = `<span class="badge" style="background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px;">Resolved</span>`;
            }

            tr.innerHTML = `
                <td class="ps-4 text-muted fw-semibold">${index + 1}</td>
                <td class="text-nowrap fw-medium text-dark">${item.date}</td>
                <td class="text-nowrap fw-bold text-dark font-monospace">${item.student_id}</td>
                <td class="text-nowrap fw-semibold text-dark">${item.student_name}</td>
                <td class="text-nowrap"><span class="badge bg-light text-secondary border">${item.college} - ${item.program}</span></td>
                <td class="text-nowrap fw-bold text-dark">${item.milestone}</td>
                <td class="text-nowrap text-secondary">${item.counselor}</td>
                <td style="line-height: 1.5; color: #334155; min-width: 200px;">${item.notes}</td>
                <td style="line-height: 1.5; color: #334155; min-width: 180px;">${item.action}</td>
                <td class="text-center text-nowrap pe-4">${statusBadge}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    /**
     * ====================================================================
     * EXPORT ACTIVE REPORT TO CSV
     * ====================================================================
     */
    function exportActiveReportCSV() {
        let tableId = '';
        let filename = '';

        if (currentActiveTab === 'concern') {
            tableId = 'concernReportTable';
            filename = 'marsu_student_concern_report_' + getTodayDateStr() + '.csv';
        } else if (currentActiveTab === 'progress') {
            tableId = 'progressReportTable';
            filename = 'marsu_case_progress_report_' + getTodayDateStr() + '.csv';
        } else if (currentActiveTab === 'history') {
            tableId = 'historyReportTable';
            filename = 'marsu_student_counseling_history_' + getTodayDateStr() + '.csv';
        }

        const table = document.getElementById(tableId);
        if (!table) return;

        const rows = table.querySelectorAll('tr');
        const csvContent = [];

        rows.forEach(row => {
            const rowData = [];
            const cols = row.querySelectorAll('th, td');
            cols.forEach(col => {
                let text = col.innerText.replace(/"/g, '""').trim();
                text = text.replace(/(\r\n|\n|\r)/gm, ' ');
                rowData.push('"' + text + '"');
            });
            csvContent.push(rowData.join(','));
        });

        const csvString = csvContent.join('\n');
        const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');

        if (navigator.msSaveBlob) {
            navigator.msSaveBlob(blob, filename);
        } else {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        showToast('Exported report to CSV successfully: ' + filename, 'success');
    }

    function getTodayDateStr() {
        const d = new Date();
        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const day = String(d.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    /**
     * Toast Helper
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
        }, 3500);
    }
</script>