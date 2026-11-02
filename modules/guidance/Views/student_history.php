<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT COUNSELING HISTORY     -->
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
                    <a href="<?= url('guidance/student_directory') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student Information Management
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Student Counseling History
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Counseling History
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Manage student counseling history, case trajectories, and longitudinal guidance records.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    onclick="exportStudentHistoryCSV()"
                    style="height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 16px;">
                    <i class="bi bi-file-earmark-spreadsheet me-1.5 text-success"></i>Export CSV
                </button>
                <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center"
                    onclick="window.print()"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 14px; height: 38px; border-radius: 6px; padding: 0 16px; font-weight: 500;">
                    <i class="bi bi-printer me-1.5"></i>Print Ledger
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-marsu {
        background-color: #800020;
        border-color: #800020;
        color: #ffffff;
    }

    .btn-marsu:hover {
        background-color: #660019;
        border-color: #660019;
        color: #ffffff;
    }

    .btn-outline-marsu {
        color: #800020 !important;
        border-color: #800020 !important;
    }

    .btn-outline-marsu:hover {
        background-color: #800020 !important;
        color: #ffffff !important;
    }

    @media print {

        nav,
        .breadcrumb,
        .btn,
        #historyFilterToolbar,
        header,
        sidebar,
        aside,
        .navbar,
        .card-footer {
            display: none !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }

        .print-only {
            display: block !important;
        }
    }
</style>

<!-- ==================================================================== -->
<!-- PRINT HEADER (PRINT ONLY)                                            -->
<!-- ==================================================================== -->
<div class="print-only text-center mb-4" style="display: none;">
    <div style="font-size: 11pt; text-transform: uppercase; font-family: 'Times New Roman', serif;">Republic of the
        Philippines</div>
    <div style="font-size: 15pt; font-weight: bold; color: #800020; font-family: 'Times New Roman', serif;">MARINDUQUE
        STATE UNIVERSITY</div>
    <div style="font-size: 11pt; font-weight: bold; font-family: 'Times New Roman', serif;">OFFICE OF STUDENT AFFAIRS
        &amp; SERVICES</div>
    <div style="font-size: 10.5pt; font-style: italic; font-family: 'Times New Roman', serif;">Guidance and Counseling
        Services Center</div>
    <div style="font-size: 13pt; font-weight: bold; margin-top: 10px; text-transform: uppercase;">STUDENT COUNSELING
        HISTORY LEDGER</div>
    <hr style="border-top: 2px solid #800020; margin-top: 8px; margin-bottom: 14px;">
</div>

<!-- 2. SEARCH & FILTER TOOLBAR (MATCHING APPOINTMENT_LISTS & STUDENT DIRECTORY) -->
<div class="card shadow-sm border-0 mb-4 bg-white" id="historyFilterToolbar"
    style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <!-- Search Bar -->
            <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white ps-3"
                        style="border-color: #ced4da; font-size: 15px; height: 42px; border-radius: 8px 0 0 8px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-start-0 shadow-none ps-2 bg-white"
                        placeholder="Search Student ID, Name..." oninput="filterHistoryTable()"
                        style="border-color: #ced4da; font-size: 14.5px; height: 42px; border-radius: 0 8px 8px 0;">
                </div>
            </div>

            <!-- Program Filter (Strictly BSIS, BSTM, BEED, BaPOS) -->
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                <select id="programFilter" class="form-select shadow-none bg-white" onchange="filterHistoryTable()"
                    style="height: 42px; font-size: 14.5px; border-color: #ced4da; border-radius: 8px; padding: 0 14px; font-weight: 500;">
                    <option value="all" selected>All Programs</option>
                    <option value="BSIS">BSIS</option>
                    <option value="BSTM">BSTM</option>
                    <option value="BEED">BEED</option>
                    <option value="BaPOS">BaPOS</option>
                </select>
            </div>

            <!-- Year Level Filter (Strictly 1st Year, 2nd Year, 3rd Year, 4th Year) -->
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                <select id="yearFilter" class="form-select shadow-none bg-white" onchange="filterHistoryTable()"
                    style="height: 42px; font-size: 14.5px; border-color: #ced4da; border-radius: 8px; padding: 0 14px; font-weight: 500;">
                    <option value="all" selected>All Year Levels</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>

            <!-- Department Filter (Exact 4 Colleges) -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                <select id="departmentFilter" class="form-select shadow-none bg-white" onchange="filterHistoryTable()"
                    style="height: 42px; font-size: 14.5px; border-color: #ced4da; border-radius: 8px; padding: 0 14px; font-weight: 500;">
                    <option value="all" selected>All Departments</option>
                    <option value="College of Information and Computing Sciences">College of Information and Computing
                        Sciences</option>
                    <option value="College of Arts and Sciences">College of Arts and Sciences</option>
                    <option value="College of Education">College of Education</option>
                    <option value="College of Business and Accountancy">College of Business and Accountancy</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                <select id="statusFilter" class="form-select shadow-none bg-white" onchange="filterHistoryTable()"
                    style="height: 42px; font-size: 14.5px; border-color: #ced4da; border-radius: 8px; padding: 0 14px; font-weight: 500;">
                    <option value="all" selected>All Statuses</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Under Monitoring">Under Monitoring</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- 3. STUDENT HISTORY TABLE (DIRECT DIV / DOM RENDERING LIKE APPOINTMENT_LISTS) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white" id="historyMasterTable">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Student ID
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Full Name
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Program
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Year Level
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Department
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Presenting Concern
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
                <tbody id="studentHistoryTableBody" style="font-size: 14.5px;">

                    <!-- Row 1: RAMOS, CARLOS M. -->
                    <tr class="student-history-row align-middle" data-student-id="2023-01089"
                        data-student-name="RAMOS, CARLOS M." data-program="BSIS" data-year="3rd Year"
                        data-college="College of Information and Computing Sciences"
                        data-concern="Academic Performance &amp; Retention Risk" data-status="Under Monitoring">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2023-01089
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">RAMOS, CARLOS M.</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BSIS
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                3rd Year
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Information and Computing Sciences</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; font-size: 12px; font-weight: 500; padding: 6px 12px; border-radius: 6px;">
                                Academic Performance &amp; Retention Risk
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 95px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Under Monitoring
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_history_view') ?>?id=2023-01089"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Complete Case Timeline" aria-label="View Complete Case Timeline"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2: SANTOS, MARIA C. -->
                    <tr class="student-history-row align-middle" data-student-id="2023-01042"
                        data-student-name="SANTOS, MARIA C." data-program="BaPOS" data-year="2nd Year"
                        data-college="College of Arts and Sciences"
                        data-concern="Mental Health &amp; Emotional Well-being" data-status="Resolved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2023-01042
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">SANTOS, MARIA C.</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BaPOS
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                2nd Year
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Arts and Sciences</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 12px; font-weight: 500; padding: 6px 12px; border-radius: 6px;">
                                Mental Health &amp; Emotional Well-being
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Resolved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_history_view') ?>?id=2023-01042"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Complete Case Timeline" aria-label="View Complete Case Timeline"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3: MENDOZA, JUAN B. -->
                    <tr class="student-history-row align-middle" data-student-id="2022-00512"
                        data-student-name="MENDOZA, JUAN B." data-program="BEED" data-year="3rd Year"
                        data-college="College of Education" data-concern="Academic Retention &amp; Exam Anxiety"
                        data-status="Resolved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2022-00512
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">MENDOZA, JUAN B.</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BEED
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                3rd Year
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Education</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; font-size: 12px; font-weight: 500; padding: 6px 12px; border-radius: 6px;">
                                Academic Retention &amp; Exam Anxiety
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Resolved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_history_view') ?>?id=2022-00512"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Complete Case Timeline" aria-label="View Complete Case Timeline"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 4: DELA CRUZ, BEA L. -->
                    <tr class="student-history-row align-middle" data-student-id="2024-03115"
                        data-student-name="DELA CRUZ, BEA L." data-program="BSTM" data-year="1st Year"
                        data-college="College of Business and Accountancy"
                        data-concern="Career Guidance &amp; Course Alignment" data-status="Resolved">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2024-03115
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">DELA CRUZ, BEA L.</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BSTM
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                1st Year
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Business and Accountancy</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="background-color: #F5F3FF; color: #6D28D9; border: 1px solid #DDD6FE; font-size: 12px; font-weight: 500; padding: 6px 12px; border-radius: 6px;">
                                Career Guidance &amp; Course Alignment
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Resolved
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_history_view') ?>?id=2024-03115"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Complete Case Timeline" aria-label="View Complete Case Timeline"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- No Results Row -->
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="8" class="text-center py-5 text-muted" style="padding: 30px;">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                            No student counseling history records match your search or filters.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer Matching Appointment Lists & Student Directory -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-4"
            style="border-top: 1px solid #E2E8F0 !important;">
            <div class="text-muted" style="font-size: 14px;" id="tableFooterCount">
                Showing 1 to 4 of 4 records
            </div>
            <nav aria-label="Student history pagination">
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
<!--   STUDENT HISTORY DATASET STORE (FRONTEND DIV CONTAINER)             -->
<!-- ==================================================================== -->
<div id="studentHistoryDatasetStore" class="d-none" aria-hidden="true">
    <div id="hist-data-2023-01089" data-student-id="2023-01089" data-student-name="RAMOS, CARLOS M." data-program="BSIS"
        data-year="3rd Year" data-college="College of Information and Computing Sciences"
        data-concern="Academic Performance &amp; Retention Risk" data-status="Under Monitoring">
    </div>
    <div id="hist-data-2023-01042" data-student-id="2023-01042" data-student-name="SANTOS, MARIA C."
        data-program="BaPOS" data-year="2nd Year" data-college="College of Arts and Sciences"
        data-concern="Mental Health &amp; Emotional Well-being" data-status="Resolved">
    </div>
    <div id="hist-data-2022-00512" data-student-id="2022-00512" data-student-name="MENDOZA, JUAN B." data-program="BEED"
        data-year="3rd Year" data-college="College of Education" data-concern="Academic Retention &amp; Exam Anxiety"
        data-status="Resolved">
    </div>
    <div id="hist-data-2024-03115" data-student-id="2024-03115" data-student-name="DELA CRUZ, BEA L."
        data-program="BSTM" data-year="1st Year" data-college="College of Business and Accountancy"
        data-concern="Career Guidance &amp; Course Alignment" data-status="Resolved">
    </div>
</div>

<!-- ==================================================================== -->
<!--   NATIVE FRONTEND FILTER & EXPORT SCRIPT                             -->
<!-- ==================================================================== -->
<script>
    // Normalization helper strictly restricting programs to BSIS, BSTM, BEED, BaPOS
    function normalizeProgram(val) {
        if (!val) return 'BSIS';
        const s = String(val).toUpperCase();
        if (s.includes('IS') || s.includes('INFO') || s.includes('COMP') || s.includes('IT')) return 'BSIS';
        if (s.includes('TOUR') || s.includes('BSTM') || s.includes('TM')) return 'BSTM';
        if (s.includes('EDUC') || s.includes('BEED') || s.includes('ELED') || s.includes('TEACH')) return 'BEED';
        if (s.includes('POL') || s.includes('BAPOS') || s.includes('POS') || s.includes('ARTS')) return 'BaPOS';
        return 'BSIS';
    }

    // Normalization helper strictly restricting year level to 1st Year, 2nd Year, 3rd Year, 4th Year
    function normalizeYear(val) {
        if (!val) return '1st Year';
        const s = String(val).toLowerCase();
        if (s.includes('4') || s.includes('fourth')) return '4th Year';
        if (s.includes('3') || s.includes('third')) return '3rd Year';
        if (s.includes('2') || s.includes('second')) return '2nd Year';
        if (s.includes('1') || s.includes('first')) return '1st Year';
        return '1st Year';
    }

    // Real-time Multi-Filter Engine operating directly on DOM rows
    function filterHistoryTable() {
        const query = (document.getElementById('searchInput').value || '').toLowerCase().trim();
        const prog = document.getElementById('programFilter').value;
        const yr = document.getElementById('yearFilter').value;
        const dept = document.getElementById('departmentFilter').value;
        const status = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('.student-history-row');
        let visible = 0;

        rows.forEach(row => {
            const rowId = (row.getAttribute('data-student-id') || '').toLowerCase();
            const rowName = (row.getAttribute('data-student-name') || '').toLowerCase();
            const rowProg = (row.getAttribute('data-program') || '');
            const rowYr = (row.getAttribute('data-year') || '');
            const rowDept = (row.getAttribute('data-college') || '');
            const rowConcern = (row.getAttribute('data-concern') || '').toLowerCase();
            const rowStatus = (row.getAttribute('data-status') || '');
            const rowText = (row.textContent || '').toLowerCase();

            const matchesQuery = !query ||
                rowId.includes(query) ||
                rowName.includes(query) ||
                rowProg.toLowerCase().includes(query) ||
                rowYr.toLowerCase().includes(query) ||
                rowDept.toLowerCase().includes(query) ||
                rowConcern.includes(query) ||
                rowText.includes(query);

            const matchesProg = (prog === 'all') || (rowProg === prog);
            const matchesYr = (yr === 'all') || (rowYr === yr);
            const matchesDept = (dept === 'all') || (rowDept === dept);
            const matchesStatus = (status === 'all') || rowStatus.toLowerCase().includes(status.toLowerCase());

            if (matchesQuery && matchesProg && matchesYr && matchesDept && matchesStatus) {
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

        const footerCount = document.getElementById('tableFooterCount');
        if (footerCount) {
            footerCount.textContent = `Showing 1 to ${visible} of ${rows.length} records`;
        }
    }

    // Export Student Counseling History to CSV
    function exportStudentHistoryCSV() {
        const rows = document.querySelectorAll('.student-history-row');
        if (!rows.length) return;

        let csv = "Student ID,Student Name,Program,Year Level,Department,Presenting Concern,Case Status\n";

        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const sid = row.getAttribute('data-student-id') || '';
                const sname = row.getAttribute('data-student-name') || '';
                const sprog = row.getAttribute('data-program') || '';
                const syr = row.getAttribute('data-year') || '';
                const scol = row.getAttribute('data-college') || '';
                const scon = row.getAttribute('data-concern') || '';
                const sstat = row.getAttribute('data-status') || '';
                csv += `"${sid}","${sname}","${sprog}","${syr}","${scol}","${scon}","${sstat}"\n`;
            }
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        const url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", `MarSU_Student_Counseling_History_${new Date().toISOString().split('T')[0]}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Sync newly registered cases from localStorage dynamically
    document.addEventListener('DOMContentLoaded', function () {
        try {
            const registeredCases = JSON.parse(localStorage.getItem('marsu_registered_cases') || '[]');
            const tbody = document.getElementById('studentHistoryTableBody');
            const noResults = document.getElementById('noResultsRow');

            if (tbody && Array.isArray(registeredCases)) {
                registeredCases.forEach(rc => {
                    if (rc.student_id && !document.querySelector(`.student-history-row[data-student-id="${rc.student_id}"]`)) {
                        const cleanProg = normalizeProgram(rc.program);
                        const cleanYr = normalizeYear(rc.year);
                        const cleanCol = rc.college || "College of Information and Computing Sciences";
                        const cleanConcern = rc.concern_type || rc.concern || "Guidance Consultation";
                        const cleanStatus = rc.status || "Under Monitoring";

                        const tr = document.createElement('tr');
                        tr.className = 'student-history-row align-middle';
                        tr.setAttribute('data-student-id', rc.student_id);
                        tr.setAttribute('data-student-name', rc.student_name || "Enrolled Client");
                        tr.setAttribute('data-program', cleanProg);
                        tr.setAttribute('data-year', cleanYr);
                        tr.setAttribute('data-college', cleanCol);
                        tr.setAttribute('data-concern', cleanConcern);
                        tr.setAttribute('data-status', cleanStatus);

                        tr.innerHTML = `
                            <td class="ps-4 fw-bold text-nowrap" style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                                ${rc.student_id}
                            </td>
                            <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <span class="fw-bold text-dark">${rc.student_name || "Enrolled Client"}</span>
                            </td>
                            <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <span style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                    ${cleanProg}
                                </span>
                            </td>
                            <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <span style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                    ${cleanYr}
                                </span>
                            </td>
                            <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <span class="text-dark">${cleanCol}</span>
                            </td>
                            <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 12px; font-weight: 500; padding: 6px 12px; border-radius: 6px;">
                                    ${cleanConcern}
                                </span>
                            </td>
                            <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <span style="border: 1px solid #d97706; background-color: #fffbeb; color: #92400e; border-radius: 50rem; min-width: 95px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                    ${cleanStatus}
                                </span>
                            </td>
                            <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                                <a href="<?= url('guidance/student_history_view') ?>?id=${encodeURIComponent(rc.student_id)}"
                                   class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                   title="View Complete Case Timeline" aria-label="View Complete Case Timeline"
                                   style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        `;
                        if (noResults) {
                            tbody.insertBefore(tr, noResults);
                        } else {
                            tbody.appendChild(tr);
                        }
                    }
                });
            }
        } catch (e) {
            console.error('Storage sync error:', e);
        }

        filterHistoryTable();
    });
</script>