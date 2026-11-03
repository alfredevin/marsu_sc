<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT FEEDBACKS REPORT       -->
<!-- ==================================================================== -->

<style>
    .btn-outline-marsu {
        color: #800020;
        border-color: #800020;
    }

    .btn-outline-marsu:hover {
        background-color: #800020;
        color: #ffffff;
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
        font-size: 13.5px;
    }

    /* Print Formatting Rules */
    @media print {
        body {
            background-color: #ffffff !important;
            color: #000000 !important;
            font-size: 9.5pt !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Hide Screen-Only UI Elements */
        .no-print,
        nav,
        .breadcrumb,
        .btn,
        .report-filter-bar,
        header,
        sidebar,
        aside,
        .navbar,
        .col-action,
        th.col-action,
        td.col-action {
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

        .report-summary-strip {
            background: #ffffff !important;
            border: 1px solid #999999 !important;
            padding: 8px 12px !important;
            margin-bottom: 12px !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 9pt !important;
        }

        th,
        td {
            border: 1px solid #333333 !important;
            padding: 5px 7px !important;
            color: #000000 !important;
            background-color: #ffffff !important;
        }

        th {
            background-color: #f2f2f2 !important;
            font-weight: bold !important;
        }

        .badge {
            border: none !important;
            color: #000000 !important;
            background: transparent !important;
            font-weight: normal !important;
            padding: 0 !important;
        }
    }
</style>

<!-- 1. PAGE HEADER (Screen Only) with Print Report & Export CSV -->
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
                    <a href="<?= url('guidance/analytics_reports') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Guidance Reports
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Student Feedbacks Report
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Feedbacks Report
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Official reporting log for student evaluations, satisfaction ratings, and service feedback across
                    university guidance services.
                </p>
            </div>
            <!-- Header Action Buttons: Export CSV & Print Report -->
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    onclick="exportFeedbacksCSV()"
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

<!-- ==================================================================== -->
<!-- OFFICIAL MARSU PRINT HEADER (PRINT ONLY)                             -->
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
    <div
        style="font-size: 13pt; font-weight: bold; margin-top: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
        STUDENT FEEDBACK &amp; SERVICE EVALUATION REPORT</div>
    <div style="font-size: 9.5pt; color: #555;">Official Guidance Service Quality &amp; Student Satisfaction Assessment
        Registry</div>
    <hr style="border-top: 2px solid #800020; margin-top: 8px; margin-bottom: 14px;">
</div>

<!-- 2. REPORT SUMMARY STRIP (Screen & Print) -->
<div class="report-summary-strip d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <span class="fw-bold text-dark">Report Scope:</span> Student Feedback Log &amp; Service Evaluations
        <span class="mx-2 text-muted">|</span>
        <span class="fw-bold text-dark">Academic Year:</span> 2026-2027
        <span class="mx-2 text-muted">|</span>
        <span class="text-muted">Generated Date:</span> <?= date('F d, Y') ?>
    </div>
    <div>
        <span class="badge" id="totalFeedbacksBadge"
            style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 13px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
            Showing 8 of 8 Records
        </span>
    </div>
</div>

<!-- 3. SEARCH & FILTER TOOLBAR (Screen Only - Minimal & Simple) -->
<div class="card shadow-sm border-0 mb-4 bg-white no-print"
    style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <!-- Search by Student ID or Name -->
            <div class="col-lg-5 col-md-5 col-12">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="feedbackSearchInput" class="form-control border-start-0 shadow-none ps-2"
                        placeholder="Search by Student ID or Student Name..." oninput="filterFeedbacksTable()"
                        style="height: 38px; font-size: 13.5px;">
                </div>
            </div>

            <!-- Filter by Type of Service (Separated Filter) -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                <select id="typeOfServiceFilterSelect" class="form-select shadow-none" onchange="filterFeedbacksTable()"
                    style="height: 38px; font-size: 13.5px;">
                    <option value="all">All Types of Service</option>
                    <option value="Individual Counseling">Individual Counseling</option>
                    <option value="Routine Intake Consultation">Routine Intake Consultation</option>
                    <option value="Mental Health Consultation">Mental Health Consultation</option>
                    <option value="Academic Guidance & Retention">Academic Guidance &amp; Retention</option>
                    <option value="Career Guidance & Profiling">Career Guidance &amp; Profiling</option>
                    <option value="Conflict Resolution & Mediation">Conflict Resolution &amp; Mediation</option>
                    <option value="Anxiety Desensitization">Anxiety Desensitization</option>
                </select>
            </div>

            <!-- Filter by College / Department -->
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                <select id="collegeFilterSelect" class="form-select shadow-none" onchange="filterFeedbacksTable()"
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

            <!-- Reset Button -->
            <div class="col-lg-2 col-md-2 col-12 text-end">
                <button type="button" onclick="resetFeedbackFilters()"
                    class="btn w-100 shadow-none d-flex align-items-center justify-content-center"
                    style="border: 1px solid #ced4da; background-color: #f8f9fa; color: #495057; font-size: 13.5px; height: 38px; font-weight: 500; border-radius: 6px;">
                    <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 4. STUDENT FEEDBACKS MASTER REGISTRY TABLE -->
<!-- Service Availed is fixed to Guidance Services, Type of Service is separated -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white" id="feedbacksMasterTable"
                style="font-size: 14px;">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Date
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Student ID
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Student
                            Name</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">College
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Program
                            &amp; Year</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Service
                            Availed</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Type of
                            Service</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Attending
                            Counselor</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Rating
                        </th>
                        <th class="text-center pe-4 text-nowrap col-action no-print"
                            style="padding: 14px 16px; color: #2D3748; font-weight: 600; width: 70px;">Action</th>
                    </tr>
                </thead>
                <tbody id="feedbacksTableBody">
                    <!-- Populated dynamically via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 5. OFFICIAL PRINT SIGNATURE BLOCK (PRINT ONLY) -->
<div class="print-only mt-5" style="display: none;">
    <div class="row pt-4" style="display: flex; justify-content: space-between;">
        <div style="width: 45%;">
            <p style="font-size: 10pt; margin-bottom: 45px;">Prepared by:</p>
            <p style="font-size: 11pt; font-weight: bold; text-decoration: underline; margin-bottom: 2px;">DR. ELENA M.
                SANTOS, RGC</p>
            <p style="font-size: 9.5pt; color: #555; margin-bottom: 0;">Head, Guidance and Counseling Services Center
            </p>
        </div>
        <div style="width: 45%; text-align: right;">
            <p style="font-size: 10pt; margin-bottom: 45px;">Noted by:</p>
            <p style="font-size: 11pt; font-weight: bold; text-decoration: underline; margin-bottom: 2px;">DIRECTOR,
                OSAS</p>
            <p style="font-size: 9.5pt; color: #555; margin-bottom: 0;">Office of Student Affairs &amp; Services</p>
        </div>
    </div>
</div>


<script>
    const feedbacksData = [
        {
            date: "2026-10-30",
            student_id: "2023-01042",
            student_name: "SANTOS, MARIA C.",
            college: "CAS",
            program: "BA Political Science",
            year: "2nd Year",
            service_availed: "Guidance Services",
            type_of_service: "Individual Counseling",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.9 / 5.0 (Very Satisfied)",
            result: "Significant reduction in oral debate anxiety; client successfully applied sensory grounding exercises during recitations.",
            outcome: "Counseling objectives met; transitioned to independent self-monitoring with scheduled voluntary check-in.",
            feedback_text: "I felt truly understood and safe during the counseling session. The breathing exercises helped calm me down before oral recitations."
        },
        {
            date: "2026-10-29",
            student_id: "2023-01089",
            student_name: "RAMOS, CARLOS M.",
            college: "CICT",
            program: "BS Information Technology",
            year: "3rd Year",
            service_availed: "Guidance Services",
            type_of_service: "Routine Intake Consultation",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.8 / 5.0 (Satisfied)",
            result: "Structured weekly timetable formulated; laboratory catch-up schedule coordinated with department chair.",
            outcome: "Student committed to revised timetable; academic engagement and laboratory attendance noticeably improved.",
            feedback_text: "The counselor helped me organize my work and study time. The advice on handling lab projects was very practical."
        },
        {
            date: "2026-10-27",
            student_id: "2023-02194",
            student_name: "REYES, MARK ANTHONY",
            college: "CEA",
            program: "BS Civil Engineering",
            year: "2nd Year",
            service_availed: "Guidance Services",
            type_of_service: "Mental Health Consultation",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.7 / 5.0 (Satisfied)",
            result: "Identified social avoidance triggers; established weekly behavioral activation and peer communication goals.",
            outcome: "Client expressed willingness to reconnect with drafting study group members; mood stabilized.",
            feedback_text: "I appreciated the non-judgmental environment. Talking through my stress made me realize I was not alone."
        },
        {
            date: "2026-10-23",
            student_id: "2022-00512",
            student_name: "MENDOZA, JUAN B.",
            college: "CED",
            program: "BEED",
            year: "3rd Year",
            service_availed: "Guidance Services",
            type_of_service: "Academic Guidance & Retention",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.6 / 5.0 (Satisfied)",
            result: "Subject review roadmap established; study partner accountability contract formulated for midterm review.",
            outcome: "Retention deficiency risk alleviated; mid-term study routine stabilized.",
            feedback_text: "Clear guidance on how to prioritize professional education subjects. Felt much less overwhelmed after the session."
        },
        {
            date: "2026-10-26",
            student_id: "2024-03115",
            student_name: "DELA CRUZ, BEA L.",
            college: "CBA",
            program: "BS Tourism Management",
            year: "1st Year",
            service_availed: "Guidance Services",
            type_of_service: "Routine Intake Consultation",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "5.0 / 5.0 (Very Satisfied)",
            result: "Homesickness and dormitory isolation addressed; engaged with campus tourism student association.",
            outcome: "Successful freshman university adjustment; positive peer connection established.",
            feedback_text: "The guidance office was very welcoming. I felt comfortable sharing my struggles living away from home."
        },
        {
            date: "2026-10-17",
            student_id: "2024-01582",
            student_name: "GONZALES, ALYSSA P.",
            college: "CNHS",
            program: "BS Nursing",
            year: "1st Year",
            service_availed: "Guidance Services",
            type_of_service: "Anxiety Desensitization",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.9 / 5.0 (Very Satisfied)",
            result: "Mastery of clinical simulation grounding techniques; controlled heart rate and reduced somatic tremors during mock trials.",
            outcome: "Prepared and confident for upcoming hospital ward duty rotations.",
            feedback_text: "The relaxation techniques really worked during our hospital duty simulation. Thank you Ma'am Elena for the patience."
        },
        {
            date: "2026-10-19",
            student_id: "2022-03481",
            student_name: "BAUTISTA, KEVIN R.",
            college: "CAFES",
            program: "BS Agriculture",
            year: "4th Year",
            service_availed: "Guidance Services",
            type_of_service: "Career Guidance & Profiling",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.8 / 5.0 (Satisfied)",
            result: "RIASEC profiling completed; resume reviewed; registered for regional licensure review cohort.",
            outcome: "Definite post-graduation transition plan formulated; career anxiety resolved.",
            feedback_text: "The career assessment helped clarify what direction to take after graduation. Very helpful and encouraging."
        },
        {
            date: "2026-10-14",
            student_id: "2023-04129",
            student_name: "VILLANUEVA, PATRICIA M.",
            college: "CBA",
            program: "BS Accountancy",
            year: "2nd Year",
            service_availed: "Guidance Services",
            type_of_service: "Conflict Resolution & Mediation",
            counselor: "Dr. Elena M. Santos, RGC",
            rating: "4.7 / 5.0 (Satisfied)",
            result: "Mediation concluded successfully; mutual respect and project division contract signed by both students.",
            outcome: "Interpersonal conflict de-escalated; coursework collaboration restored.",
            feedback_text: "The mediation was fair to both sides. We were able to finish our accounting project without friction."
        }
    ];

    let currentFilteredFeedbacks = [...feedbacksData];

    document.addEventListener('DOMContentLoaded', function () {
        // Persist feedbacks data to localStorage so feedback_view can access it seamlessly
        try {
            localStorage.setItem('marsu_student_feedbacks', JSON.stringify(feedbacksData));
        } catch (e) {
            console.error('Storage error:', e);
        }

        renderFeedbacksTable(feedbacksData);
    });

    /**
     * Filter Feedbacks Table
     */
    function filterFeedbacksTable() {
        const q = (document.getElementById('feedbackSearchInput').value || '').toLowerCase().trim();
        const typeFilter = document.getElementById('typeOfServiceFilterSelect').value;
        const collegeFilter = document.getElementById('collegeFilterSelect').value;

        currentFilteredFeedbacks = feedbacksData.filter(item => {
            const matchesQuery = !q ||
                item.student_id.toLowerCase().includes(q) ||
                item.student_name.toLowerCase().includes(q);

            const matchesType = (typeFilter === 'all') || item.type_of_service.toLowerCase().includes(typeFilter.toLowerCase());
            const matchesCollege = (collegeFilter === 'all') || (item.college === collegeFilter);

            return matchesQuery && matchesType && matchesCollege;
        });

        renderFeedbacksTable(currentFilteredFeedbacks);
    }

    /**
     * Reset Filters
     */
    function resetFeedbackFilters() {
        document.getElementById('feedbackSearchInput').value = '';
        document.getElementById('typeOfServiceFilterSelect').value = 'all';
        document.getElementById('collegeFilterSelect').value = 'all';
        currentFilteredFeedbacks = [...feedbacksData];
        renderFeedbacksTable(currentFilteredFeedbacks);
    }

    /**
     * Render Feedbacks Table Rows
     * Action column has eye icon ONLY without text, like in student directory.
     */
    function renderFeedbacksTable(list) {
        const tbody = document.getElementById('feedbacksTableBody');
        const badge = document.getElementById('totalFeedbacksBadge');
        if (badge) badge.textContent = `Showing ${list.length} of ${feedbacksData.length} Records`;

        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            tbody.innerHTML = `<tr><td colspan="10" class="text-center py-5 text-muted">No student feedback records found matching the filters.</td></tr>`;
            return;
        }

        list.forEach(item => {
            const tr = document.createElement('tr');
            tr.className = 'align-middle';

            tr.innerHTML = `
                <td class="ps-4 text-nowrap" style="padding: 13px 16px;">
                    <span class="text-dark fw-medium">${item.date}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="fw-bold text-dark font-monospace">${item.student_id}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="fw-bold text-dark">${item.student_name}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="text-dark">${item.college}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="badge bg-light text-secondary border" style="font-size: 12px;">${item.program} - ${item.year}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="badge" style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">
                        ${item.service_availed}
                    </span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">
                        ${item.type_of_service}
                    </span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="text-secondary">${item.counselor}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="fw-semibold text-dark" style="font-size: 13px;">${item.rating}</span>
                </td>
                <td class="text-center pe-4 text-nowrap col-action no-print" style="padding: 13px 16px;">
                    <a href="<?= url('guidance/feedback_view') ?>?id=${item.student_id}"
                       class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                       title="View Student Feedback" aria-label="View Student Feedback"
                       style="width: 34px; height: 34px; border-radius: 6px; font-size: 15px; padding: 0;">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }


    function exportFeedbacksCSV() {
        const list = currentFilteredFeedbacks || feedbacksData;
        if (!list || !list.length) {
            alert('No feedback records to export.');
            return;
        }

        const headers = [
            "Date",
            "Student ID",
            "Student Name",
            "College",
            "Program & Year",
            "Service Availed",
            "Type of Service",
            "Attending Counselor",
            "Satisfaction Rating",
            "Student Feedback Statement",
            "Session Result",
            "Guidance Outcome"
        ];

        const rows = list.map(item => [
            `"${item.date}"`,
            `"${item.student_id}"`,
            `"${item.student_name}"`,
            `"${item.college}"`,
            `"${item.program} - ${item.year}"`,
            `"${item.service_availed}"`,
            `"${item.type_of_service}"`,
            `"${item.counselor}"`,
            `"${item.rating}"`,
            `"${(item.feedback_text || '').replace(/"/g, '""')}"`,
            `"${(item.result || '').replace(/"/g, '""')}"`,
            `"${(item.outcome || '').replace(/"/g, '""')}"`
        ]);

        const csvContent = "data:text/csv;charset=utf-8," + [headers.join(','), ...rows.map(r => r.join(','))].join('\n');
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        const today = new Date().toISOString().split('T')[0];
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `MarSU_Guidance_Student_Feedbacks_Report_${today}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>