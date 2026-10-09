<!-- Page Content -->
<div class="container-fluid fade-in-up">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Participation Tracking</h1>
            <p class="text-xs text-gray-600 mb-0">Class record task submission compliance, missed
                quizzes and activities audits, and formative engagement metrics.</p>
        </div>
        <div class="mt-3 mt-sm-0">
            <a href="grade-management.html" class="btn btn-sm btn-outline-primary shadow-sm">
                <i class="fas fa-file-excel fa-sm mr-1"></i> Open Class Record Grid
            </a>
            <button class="btn btn-sm btn-primary shadow-sm ml-1" data-toggle="modal"
                data-target="#logTaskExceptionModal">
                <i class="fas fa-plus fa-sm mr-1"></i> Log Task Exception
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-success h-100 shadow-sm">
                <div class="kpi-label text-success">100% Submission Compliance</div>
                <div class="kpi-number text-gray-900" id="kpiZeroMissed">0</div>
                <div class="text-xs text-muted mt-1">Students with zero missed tasks</div>
                <i class="fas fa-check-double kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-warning h-100 shadow-sm">
                <div class="kpi-label text-warning">Minor Deficit (1–2 Tasks)</div>
                <div class="kpi-number text-gray-900" id="kpiMinorMissed">0</div>
                <div class="text-xs text-muted mt-1">Missed 1 or 2 quizzes/activities</div>
                <i class="fas fa-exclamation-triangle kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-danger h-100 shadow-sm">
                <div class="kpi-label text-danger">Critical Inactivity (&ge;3 Tasks)</div>
                <div class="kpi-number text-gray-900" id="kpiCriticalMissed">0</div>
                <div class="text-xs text-muted mt-1">Severe formative assessment deficit</div>
                <i class="fas fa-times-circle kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-primary h-100 shadow-sm">
                <div class="kpi-label text-primary">Class Assessment Average</div>
                <div class="kpi-number text-gray-900" id="kpiAverageScore">82.4%</div>
                <div class="text-xs text-muted mt-1">Computed from active class record</div>
                <i class="fas fa-chart-line kpi-icon"></i>
            </div>
        </div>
    </div>

    <!-- Trend Chart Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="color: #6B1D2F !important;">
                <i class="fas fa-chart-area mr-1"></i> Assessment Submission & Activity Completion Trend
            </h6>
        </div>
        <div class="card-body">
            <div class="chart-area" style="height: 230px;">
                <canvas id="taskCompletionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Participation Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
                <div>
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #6B1D2F !important;">
                        <i class="fas fa-tasks mr-1"></i> Class Record Task Compliance & Missed
                        Assessments Ledger
                    </h6>
                    <div class="text-xs text-muted">Audited directly from faculty assessment schemes
                        (Quizzes, Activities, Assignments, and Recitations)</div>
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
                <table class="table table-hover align-middle" id="participationTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 140px;">STUDENT ID</th>
                            <th>STUDENT NAME</th>
                            <th style="width: 280px;">MISSED TASKS (CLASS RECORD)</th>
                            <th class="text-center" style="width: 160px;">ASSESSMENT AVERAGE</th>
                            <th class="text-center" style="width: 150px;">ENGAGEMENT STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="participationTableBody">
                        <!-- Rendered dynamically via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>