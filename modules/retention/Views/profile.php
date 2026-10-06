 <div class="container-fluid fade-in-up">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Student Profiles</h1>
                            <p class="text-xs text-gray-600 mb-0">Master institutional registry for undergraduate student identity, degree programs, year levels, and demographic profiles.</p>
                        </div>
                        <div class="mt-3 mt-sm-0">
                            <span class="badge badge-light border text-gray-700 py-2 px-3 mr-1">
                                <i class="fas fa-database text-info mr-1"></i> Central Registry Synced (Read-Only)
                            </span>
                            <a href="program-enrollment-records.html" class="btn btn-sm btn-outline-primary shadow-sm mr-1">
                                <i class="fas fa-clipboard-list fa-sm mr-1"></i> Enrollment Records
                            </a>
                            <a href="demographic-information.html" class="btn btn-sm btn-primary shadow-sm" style="background:#6B1D2F; border-color:#6B1D2F;">
                                <i class="fas fa-users-cog fa-sm mr-1"></i> Demographic Information (Module 1.4)
                            </a>
                        </div>
                    </div>

                    <!-- Institutional Student Registry KPI Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card border-left-primary h-100 shadow-sm">
                                <div class="kpi-label text-primary">Total Registered Students</div>
                                <div class="kpi-number text-gray-900" id="kpiTotalStudents">0</div>
                                <div class="text-xs text-muted mt-1">Active verified undergraduate records</div>
                                <i class="fas fa-user-graduate kpi-icon text-primary"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card border-left-info h-100 shadow-sm">
                                <div class="kpi-label text-info">Monitored Degree Programs</div>
                                <div class="kpi-number text-gray-900" id="kpiDegreePrograms">0</div>
                                <div class="text-xs text-muted mt-1">Undergraduate academic curricula</div>
                                <i class="fas fa-graduation-cap kpi-icon text-info"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card border-left-success h-100 shadow-sm">
                                <div class="kpi-label text-success">Class Cohort Distribution</div>
                                <div class="kpi-number text-gray-900" id="kpiCohortCount">4 Levels</div>
                                <div class="text-xs text-muted mt-1" id="kpiCohortBreakdown">1st to 4th Year Cohorts Monitored</div>
                                <i class="fas fa-layer-group kpi-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card border-left-warning h-100 shadow-sm">
                                <div class="kpi-label text-warning" style="color: #b45309 !important;">Profile Verification Rate</div>
                                <div class="kpi-number text-gray-900" id="kpiVerificationRate">100%</div>
                                <div class="text-xs text-muted mt-1">Central registrar database synced</div>
                                <i class="fas fa-id-badge kpi-icon text-warning"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Main Student Identity Registry Table Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-id-card mr-1"></i> Institutional Student Identity Roster
                            </h6>
                            <div class="d-flex align-items-center flex-wrap gap-2 mt-2 mt-md-0">
                                <!-- Program Filter Dropdown -->
                                <div class="mr-2 mb-2 mb-md-0 d-flex align-items-center">
                                    <label class="text-xs font-weight-bold text-gray-700 mr-2 text-uppercase mb-0">Program:</label>
                                    <select class="custom-select custom-select-sm" id="filterProgramSelect" style="border-radius: 8px; font-weight: 600; min-width: 220px;">
                                        <option value="all">All Degree Programs</option>
                                        <option value="BSIS">BS in Information Systems (BSIS)</option>
                                        <option value="BSIT">BS in Information Technology (BSIT)</option>
                                        <option value="BSCS">BS in Computer Science (BSCS)</option>
                                        <option value="BSTM">BS in Tourism Management (BSTM)</option>
                                        <option value="BEED">Bachelor of Elementary Education (BEED)</option>
                                        <option value="POLSCI">BA in Political Science (POLSCI)</option>
                                        <option value="BSBA">BS in Business Administration (BSBA)</option>
                                        <option value="BSCE">BS in Civil Engineering (BSCE)</option>
                                        <option value="BSA">BS in Accountancy (BSA)</option>
                                    </select>
                                </div>

                                <!-- Year Level Filter Dropdown -->
                                <div class="d-flex align-items-center">
                                    <label class="text-xs font-weight-bold text-gray-700 mr-2 text-uppercase mb-0">Year Level:</label>
                                    <select class="custom-select custom-select-sm" id="filterYearSelect" style="border-radius: 8px; font-weight: 600; min-width: 140px;">
                                        <option value="all">All Year Levels</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="studentProfileTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 130px;">Student ID</th>
                                            <th>Student Name & Identity</th>
                                            <th>Degree Program</th>
                                            <th class="text-center" style="width: 110px;">Year Level</th>
                                            <th class="text-center" style="width: 140px;">Enrollment Status</th>
                                            <th class="text-center" style="width: 190px;">Demographic Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentProfileTableBody">
                                        <!-- Loaded via MarSUDataStore -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>