<!-- Page Content -->
<div class="container-fluid fade-in-up">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Coursework Submission Compliance</h1>
            <p class="text-xs text-gray-600 mb-0">Audit of student assignment and activity submissions
                derived directly from faculty class records and grade sheets.</p>
        </div>
        <div class="mt-3 mt-sm-0">
            <a href="grade-management.html" class="btn btn-sm btn-outline-primary shadow-sm">
                <i class="fas fa-file-excel fa-sm mr-1"></i> Open Class Record Grid
            </a>
            <button class="btn btn-sm btn-primary shadow-sm ml-1" onclick="window.print()">
                <i class="fas fa-print fa-sm mr-1"></i> Print Submission Audit
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-success h-100 shadow-sm">
                <div class="kpi-label text-success">Cohort Submission Compliance</div>
                <div class="kpi-number text-gray-900" id="kpiSubmitRate">88.5%</div>
                <div class="text-xs text-muted mt-1">Average coursework submission rate</div>
                <i class="fas fa-file-signature kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-primary h-100 shadow-sm">
                <div class="kpi-label text-primary">100% Complete Submissions</div>
                <div class="kpi-number text-gray-900" id="kpiHighCompliance">0</div>
                <div class="text-xs text-muted mt-1">Turned in all class record tasks</div>
                <i class="fas fa-check-double kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-danger h-100 shadow-sm">
                <div class="kpi-label text-danger">Submission Deficit Flag</div>
                <div class="kpi-number text-gray-900" id="kpiDisengaged">0</div>
                <div class="text-xs text-muted mt-1">Contains unsubmitted / 0 marks</div>
                <i class="fas fa-exclamation-triangle kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-info h-100 shadow-sm">
                <div class="kpi-label text-info">Monitored Cohort Roster</div>
                <div class="kpi-number text-gray-900" id="kpiTotalStudents">0</div>
                <div class="text-xs text-muted mt-1">Filtered students matching criteria</div>
                <i class="fas fa-users kpi-icon"></i>
            </div>
        </div>
    </div>

    <!-- Longitudinal Submission Trend Chart Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="color: #6B1D2F !important;">
                <i class="fas fa-chart-line mr-1"></i> Class Record Task Submission & Turnaround Trend
            </h6>
        </div>
        <div class="card-body">
            <div class="chart-area" style="height: 230px;">
                <canvas id="engagementTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Submission Indicators Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
                <div>
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #6B1D2F !important;">
                        <i class="fas fa-tasks mr-1"></i> Student Coursework Submission Ledger
                    </h6>
                    <div class="text-xs text-muted">Audited based on recorded submissions in the
                        official class record (Quizzes, Activities, and Projects)</div>
                </div>
                <!-- Search Input by Student ID or Name -->
                <div class="mt-2 mt-lg-0" style="min-width: 260px;">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i
                                    class="fas fa-search text-gray-500"></i></span>
                        </div>
                        <input type="text" id="customSearchInput" class="form-control form-control-sm border-left-0"
                            placeholder="Search Student ID or Name..." style="border-radius: 0 8px 8px 0;">
                    </div>
                </div>
            </div>

            <!-- Dedicated Filters: Program, Year Level, Section -->
            <div class="d-flex align-items-center flex-wrap pt-2 border-top gap-2">
                <div class="mr-3 mb-2 mb-md-0">
                    <label class="text-xs font-weight-bold text-gray-700 text-uppercase mr-1 mb-0">DEPARTMENT
                        / PROGRAM:</label>
                    <select class="custom-select custom-select-sm font-weight-bold" id="filterProgram"
                        style="min-width: 190px; border-radius: 8px;">
                        <option value="all">All Programs</option>
                        <option value="BSIS">BSIS (Information Systems)</option>
                        <option value="BSIT">BSIT (Information Technology)</option>
                        <option value="POLSCI">POLSCI (Political Science)</option>
                        <option value="BEED">BEED (Elementary Education)</option>
                        <option value="BSTM">BSTM (Tourism Management)</option>
                        <option value="BSCS">BSCS (Computer Science)</option>
                        <option value="BSCE">BSCE (Civil Engineering)</option>
                        <option value="BSA">BSA (Accountancy)</option>
                        <option value="BSBA">BSBA (Business Administration)</option>
                        <option value="BSED">BSED (Secondary Education)</option>
                        <option value="BSNS">BSNS (Natural Sciences)</option>
                        <option value="BSAG">BSAG (Agriculture)</option>
                    </select>
                </div>

                <div class="mr-3 mb-2 mb-md-0">
                    <label class="text-xs font-weight-bold text-gray-700 text-uppercase mr-1 mb-0">YEAR
                        LEVEL:</label>
                    <select class="custom-select custom-select-sm font-weight-bold" id="filterYear"
                        style="min-width: 140px; border-radius: 8px;">
                        <option value="all">All Years</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>

                <div class="mb-2 mb-md-0">
                    <label class="text-xs font-weight-bold text-gray-700 text-uppercase mr-1 mb-0">SECTION:</label>
                    <select class="custom-select custom-select-sm font-weight-bold" id="filterSection"
                        style="min-width: 130px; border-radius: 8px;">
                        <option value="all">All Sections</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="engagementTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 140px;">STUDENT ID</th>
                            <th>STUDENT NAME</th>
                            <th class="text-center" style="width: 230px;">CLASS RECORD SUBMISSIONS</th>
                            <th class="text-center" style="width: 170px;">COMPLIANCE RATE</th>
                            <th class="text-center" style="width: 160px;">SUBMISSION STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="engagementTableBody">
                        <!-- Loaded dynamically via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>