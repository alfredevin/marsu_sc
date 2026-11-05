<div class="container-fluid">

    <!-- Page Heading Bar -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold" style="color: var(--maroon-primary) !important;">
                <i class="fas fa-stethoscope text-maroon mr-2"></i>Student Health Screening Results
            </h1>
            <p class="text-muted small mb-0">Annual Physical & Medical Examination, Vision/Snellen Acuity, Hearing, Dental & Oral Health, Postural Check & DepEd Health Clearance</p>
        </div>
        <div class="mt-3 mt-sm-0 d-flex flex-wrap gap-2">
            <button class="btn btn-sm btn-maroon shadow-sm font-weight-bold mr-2 mb-1" data-toggle="modal" data-target="#recordScreeningModal" onclick="prepareNewScreeningForm()">
                <i class="fas fa-plus-circle fa-sm text-white-50 mr-1"></i> Record Health Screening
            </button>
            <button class="btn btn-sm btn-outline-maroon shadow-sm font-weight-bold mr-2 mb-1" onclick="exportScreeningData()">
                <i class="fas fa-file-export fa-sm mr-1"></i> Export Registry (.CSV)
            </button>
            <button class="btn btn-sm btn-outline-secondary shadow-sm font-weight-bold mr-2 mb-1" onclick="toggleScreeningCharts()">
                <i class="fas fa-chart-pie fa-sm mr-1"></i> <span id="chartsToggleText">Show Analytics</span>
            </button>
            <button class="btn btn-sm btn-outline-info shadow-sm font-weight-bold mb-1" onclick="printAllScreenings()">
                <i class="fas fa-print fa-sm mr-1"></i> Print Summary Report
            </button>
        </div>
    </div>

    <!-- Health Screening KPI Metric Cards -->
    <div class="row mb-4">

        <!-- Card 1: Total Screened Students -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card metric-card metric-primary h-100 py-2" onclick="filterByPreset('all')">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Screened Students</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="statTotalScreened">8 Students</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-id-card-alt text-primary mr-1"></i> AY 2026-2027 Roster</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-primary text-white">
                                <i class="fas fa-users-cog fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Class A - Fit to Study -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card metric-card metric-success h-100 py-2" onclick="filterByPreset('classA')">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Class A: Fully Cleared (Fit)</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="statClassA">5 Students</div>
                            <div class="text-xs text-success mt-1"><i class="fas fa-check-circle mr-1"></i> 62.5% Complete Physical Clearance</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-success text-white">
                                <i class="fas fa-shield-alt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Class B - Fit with Minor Follow-Up -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card metric-card metric-warning h-100 py-2" onclick="filterByPreset('classB')">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Class B: Corrective / Minor Care</div>
                            <div class="h4 mb-0 font-weight-bold text-warning" id="statClassB">2 Students</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-glasses text-warning mr-1"></i> Lenses / Dental Prophylaxis</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-warning text-white">
                                <i class="fas fa-user-edit fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Class C & D - Specialist Referral Required -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card metric-card metric-danger h-100 py-2" onclick="filterByPreset('referral')">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Class C/D: Specialist Referral</div>
                            <div class="h4 mb-0 font-weight-bold text-danger" id="statReferrals">1 Case</div>
                            <div class="text-xs text-danger mt-1"><i class="fas fa-exclamation-triangle mr-1"></i> Action Letter Issued to Parents</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-danger text-white">
                                <i class="fas fa-file-medical-alt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- COLLAPSIBLE ANALYTICAL CHARTS SECTION -->
    <div id="screeningChartsSection" class="row mb-4 d-none">

        <!-- Chart 1: Clearance Distribution -->
        <div class="col-lg-4 mb-4">
            <div class="card card-screening h-100 shadow-sm">
                <div class="card-header py-3 bg-white border-0 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-certificate mr-1"></i> DepEd Health Clearance Classification
                    </h6>
                    <span class="badge badge-light border text-muted">DepEd Form 8</span>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-2 pb-2" style="height: 220px; position: relative;">
                        <canvas id="clearanceChart"></canvas>
                    </div>
                    <div class="mt-3 text-center small text-muted">
                        <span class="mr-2"><i class="fas fa-circle text-success"></i> Class A (Fit)</span>
                        <span class="mr-2"><i class="fas fa-circle text-info"></i> Class B (Minor)</span>
                        <span><i class="fas fa-circle text-danger"></i> Class C/D (Referral)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 2: Visual Acuity & Eye Health -->
        <div class="col-lg-4 mb-4">
            <div class="card card-screening h-100 shadow-sm">
                <div class="card-header py-3 bg-white border-0 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-eye mr-1"></i> Visual Acuity & Refraction Status
                    </h6>
                    <span class="badge badge-light border text-muted">Snellen Chart</span>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-2 pb-2" style="height: 220px; position: relative;">
                        <canvas id="visionChart"></canvas>
                    </div>
                    <div class="mt-3 text-center small text-muted">
                        <span class="mr-2"><i class="fas fa-circle text-success"></i> 20/20 Normal</span>
                        <span class="mr-2"><i class="fas fa-circle text-warning"></i> 20/30-20/40 Mild</span>
                        <span><i class="fas fa-circle text-danger"></i> ≥20/50 Needs Glasses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 3: Dental & Oral Health Index -->
        <div class="col-lg-4 mb-4">
            <div class="card card-screening h-100 shadow-sm">
                <div class="card-header py-3 bg-white border-0 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-tooth mr-1"></i> Dental & Oral Health Status
                    </h6>
                    <span class="badge badge-light border text-muted">DMF-T Index</span>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-2 pb-2" style="height: 220px; position: relative;">
                        <canvas id="dentalChart"></canvas>
                    </div>
                    <div class="mt-3 text-center small text-muted">
                        <span class="mr-2"><i class="fas fa-circle text-success"></i> Caries-Free</span>
                        <span class="mr-2"><i class="fas fa-circle text-warning"></i> Prophylaxis Needed</span>
                        <span><i class="fas fa-circle text-danger"></i> Active Caries</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Preset Filters & Search Card -->
    <div class="card card-screening mb-4">
        <div class="card-body">
            <!-- Preset Filter Badges -->
            <div class="d-flex align-items-center flex-wrap mb-3">
                <span class="text-xs font-weight-bold text-uppercase text-muted mr-3 mb-2"><i class="fas fa-filter mr-1"></i> Quick Filters:</span>
                <div class="filter-pill active" id="pillAll" onclick="filterByPreset('all')">
                    <i class="fas fa-list-ul mr-1"></i> All Screenings (<span id="countAll">8</span>)
                </div>
                <div class="filter-pill" id="pillClassA" onclick="filterByPreset('classA')">
                    <i class="fas fa-check-circle text-success mr-1"></i> Fully Cleared - Class A (<span id="countClassA">5</span>)
                </div>
                <div class="filter-pill" id="pillClassB" onclick="filterByPreset('classB')">
                    <i class="fas fa-glasses text-info mr-1"></i> Class B - Minor Follow-Up (<span id="countClassB">2</span>)
                </div>
                <div class="filter-pill" id="pillVision" onclick="filterByPreset('vision')">
                    <i class="fas fa-eye text-warning mr-1"></i> Vision Concerns (<span id="countVision">2</span>)
                </div>
                <div class="filter-pill" id="pillDental" onclick="filterByPreset('dental')">
                    <i class="fas fa-tooth text-danger mr-1"></i> Dental Caries (<span id="countDental">1</span>)
                </div>
                <div class="filter-pill" id="pillScoliosis" onclick="filterByPreset('scoliosis')">
                    <i class="fas fa-child text-primary mr-1"></i> Posture / Spine (<span id="countScoliosis">1</span>)
                </div>
                <div class="filter-pill" id="pillReferral" onclick="filterByPreset('referral')">
                    <i class="fas fa-exclamation-triangle text-danger mr-1"></i> Specialist Referral (<span id="countReferral">1</span>)
                </div>
            </div>

            <!-- Search & Dropdown Filters Bar -->
            <div class="row align-items-center">

                <!-- Search Input -->
                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 position-relative">
                    <i class="fas fa-search search-icon-pos"></i>
                    <input type="text" id="screeningSearchInput" class="form-control search-box-custom bg-light border-0 font-weight-semibold" placeholder="Search student name, student ID number, vision, dental, clinical remarks..." onkeyup="filterScreenings()">
                </div>

                <!-- Filter by Course -->
                <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                    <select id="filterStrand" class="form-control custom-select bg-light border-0 font-weight-semibold" onchange="filterScreenings()">
                        <option value="">All Courses</option>
                        <option value="BS Information System">BS Information System</option>
                        <option value="BS Tourism Management">BS Tourism Management</option>
                        <option value="BS Education">BS Education</option>
                        <option value="BS Political Science">BS Political Science</option>
                    </select>
                </div>

                <!-- Filter by Year Level -->
                <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                    <select id="filterGrade" class="form-control custom-select bg-light border-0 font-weight-semibold" onchange="filterScreenings()">
                        <option value="">All Year Levels</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>

                <!-- Filter by Screening Type -->
                <div class="col-lg-2 col-md-4 col-6 mb-3 mb-lg-0">
                    <select id="filterExamType" class="form-control custom-select bg-light border-0 font-weight-semibold" onchange="filterScreenings()">
                        <option value="">All Exam Types</option>
                        <option value="Annual Comprehensive Physical">Annual Comprehensive Physical</option>
                        <option value="Athletic Varsity Clearance">Athletic Varsity Clearance</option>
                        <option value="Special Diagnostic Screening">Special Diagnostic Screening</option>
                    </select>
                </div>

                <!-- View Switcher Toggle -->
                <div class="col-lg-2 col-md-8 col-6 text-right">
                    <div class="btn-group btn-group-toggle shadow-sm" data-toggle="buttons">
                        <label class="btn btn-light active font-weight-bold" id="btnTableView" onclick="switchView('table')">
                            <input type="radio" name="viewOptions" checked> <i class="fas fa-list"></i>
                        </label>
                        <label class="btn btn-light font-weight-bold" id="btnGridView" onclick="switchView('grid')">
                            <input type="radio" name="viewOptions"> <i class="fas fa-th-large"></i>
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MAIN CONTENT: SCREENING TABLE VIEW -->
    <div id="tableViewContainer" class="card card-screening mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between bg-white border-0">
            <h6 class="m-0 font-weight-bold text-gray-800">
                <i class="fas fa-clipboard-check text-primary mr-2"></i>Student Health Screening & Medical Clearance Registry
            </h6>
            <span class="badge badge-light border text-muted px-3 py-2 font-weight-bold" id="recordCountBadge">Showing 8 of 8 records</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-screening mb-0" id="screeningTable">
                    <thead>
                        <tr>
                            <th class="pl-4">Screening ID / Date</th>
                            <th>Student Information</th>
                            <th>Vision (OD / OS)</th>
                            <th>Hearing / Audiometry</th>
                            <th>Dental & Oral Health</th>
                            <th>Posture & Spine</th>
                            <th>Lab / Diagnostic</th>
                            <th>Overall Clearance</th>
                            <th class="text-center pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="screeningTableBody">
                        <!-- Injected via JS -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 d-flex align-items-center justify-content-between">
            <div class="text-xs text-muted font-weight-semibold">
                Showing <span id="showingCountText">1 to 8</span> of <span id="totalCountText">8</span> recorded health screenings
            </div>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" style="background-color: var(--maroon-primary); border-color: var(--maroon-primary);" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>

    <!-- ALTERNATIVE CONTENT: GRID CARDS VIEW -->
    <div id="gridViewContainer" class="row d-none">
        <!-- Injected via JS -->
    </div>

</div>

<div class="modal fade" id="recordScreeningModal" tabindex="-1" role="dialog" aria-labelledby="recordScreeningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Modal Banner -->
            <div class="screening-banner d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-maroon mr-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div>
                        <h4 class="font-weight-bold mb-0 text-white" id="modalFormTitle">Record Health Screening Assessment</h4>
                        <p class="mb-0 text-white-50 small">Standardized Physical Examination, Visual Acuity, Oral/Dental & DepEd Clearance Entry</p>
                    </div>
                </div>
                <button class="close text-white opacity-75" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="screeningEntryForm" onsubmit="handleScreeningFormSubmit(event)">
                <input type="hidden" id="editingScreeningId" value="">

                <div class="modal-body p-4">

                    <!-- SECTION 1: STUDENT IDENTIFICATION -->
                    <div class="card border-0 bg-light p-3 mb-4 rounded-lg">
                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-user-check text-primary mr-2"></i>1. Student Identification & Examination Context
                        </h6>
                        <div class="row">
                            <div class="col-md-5 col-12 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Select Student <span class="text-danger">*</span></label>
                                <select class="form-control custom-select" id="inpStudentSelect" onchange="autoFillStudentDetails(this.value)" required>
                                    <option value="">-- Choose Registered Student --</option>
                                    <option value="LRN-22B0023">Rex Mark Ricafranca (ID: 22B0023) - 3rd Year BS Political Science</option>
                                    <option value="LRN-21S0011">Mica Santos (ID: 21S0011) - 4th Year BS Information System</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Student ID / Number</label>
                                <input type="text" class="form-control" id="inpLRN" placeholder="Student ID" readonly required>
                            </div>

                            <div class="col-md-2 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Course & Year</label>
                                <input type="text" class="form-control" id="inpGradeStrand" placeholder="e.g. 4th Year - BSIS" readonly required>
                            </div>

                            <div class="col-md-2 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Sex & Age</label>
                                <input type="text" class="form-control" id="inpSexAge" placeholder="e.g. F, 17y" readonly>
                            </div>

                            <div class="col-md-4 col-6 mb-2">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Screening Type / Protocol <span class="text-danger">*</span></label>
                                <select class="form-control custom-select" id="inpExamType" required>
                                    <option value="Annual Comprehensive Physical">Annual Comprehensive Physical</option>
                                    <option value="Athletic Varsity Clearance">Athletic Varsity Clearance</option>
                                    <option value="Special Diagnostic Screening">Special Diagnostic Screening</option>
                                    <option value="Pre-Work Immersion Medical Check">Pre-Work Immersion Medical Check</option>
                                </select>
                            </div>

                            <div class="col-md-4 col-6 mb-2">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Screening Date & Academic Year</label>
                                <input type="date" class="form-control" id="inpExamDate" required>
                            </div>

                            <div class="col-md-4 col-12 mb-2">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Attending Examiner / Physician</label>
                                <input type="text" class="form-control" id="inpPhysician" value="Dr. Evelyn Santos, MD (School Physician)" required>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: SENSORY ORGANS (VISION & AUDITORY SCREENING) -->
                    <div class="card border-0 bg-light p-3 mb-4 rounded-lg">
                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-eye text-info mr-2"></i>2. Sensory Organs (Visual Acuity, Color Vision & Audiometry)
                        </h6>
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Right Eye (OD) Acuity</label>
                                <select class="form-control custom-select" id="inpVisionOD">
                                    <option value="20/20 (Normal)">20/20 (Normal)</option>
                                    <option value="20/25 (Mild Refraction)">20/25 (Mild Refraction)</option>
                                    <option value="20/30 (Mild Blur)">20/30 (Mild Blur)</option>
                                    <option value="20/40 (Borderline)">20/40 (Borderline)</option>
                                    <option value="20/50 (Myopia/Deficit)">20/50 (Myopia/Deficit)</option>
                                    <option value="20/70 (Significant Deficit)">20/70 (Significant Deficit)</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Left Eye (OS) Acuity</label>
                                <select class="form-control custom-select" id="inpVisionOS">
                                    <option value="20/20 (Normal)">20/20 (Normal)</option>
                                    <option value="20/25 (Mild Refraction)">20/25 (Mild Refraction)</option>
                                    <option value="20/30 (Mild Blur)">20/30 (Mild Blur)</option>
                                    <option value="20/40 (Borderline)">20/40 (Borderline)</option>
                                    <option value="20/50 (Myopia/Deficit)">20/50 (Myopia/Deficit)</option>
                                    <option value="20/70 (Significant Deficit)">20/70 (Significant Deficit)</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Ishihara Color Vision</label>
                                <select class="form-control custom-select" id="inpColorVision">
                                    <option value="Normal (14/14 Plates)">Normal (14/14 Plates)</option>
                                    <option value="Mild Red-Green Deficit">Mild Red-Green Deficit</option>
                                    <option value="Color Deficiency Identified">Color Deficiency Identified</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Hearing / Audiometry</label>
                                <select class="form-control custom-select" id="inpHearing">
                                    <option value="Normal Hearing Bilateral">Normal Hearing Bilateral</option>
                                    <option value="Mild Unilateral Deficit">Mild Unilateral Deficit</option>
                                    <option value="Cerumen Impaction (Needs Irrigation)">Cerumen Impaction (Needs Irrigation)</option>
                                    <option value="Referral to ENT Specialist">Referral to ENT Specialist</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: ORAL, DENTAL & POSTURAL ASSESSMENT -->
                    <div class="card border-0 bg-light p-3 mb-4 rounded-lg">
                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-tooth text-warning mr-2"></i>3. Dental & Oral Health, Spine & Musculoskeletal Check
                        </h6>
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Dental & Oral Health Status</label>
                                <select class="form-control custom-select" id="inpDentalStatus">
                                    <option value="Caries-Free (Optimal Oral Health)">Caries-Free (Optimal Oral Health)</option>
                                    <option value="Mild Gingivitis / Prophylaxis Needed">Mild Gingivitis / Prophylaxis Needed</option>
                                    <option value="1-2 Active Caries (Restoration Needed)">1-2 Active Caries (Restoration Needed)</option>
                                    <option value="Severe Dental Caries / Extraction Advised">Severe Dental Caries / Extraction Advised</option>
                                    <option value="Malocclusion / Orthodontic Care">Malocclusion / Orthodontic Care</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">DMF-T Cavity Score</label>
                                <input type="number" class="form-control" id="inpDmftScore" min="0" max="32" value="0">
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Postural & Spine (Adam's Test)</label>
                                <select class="form-control custom-select" id="inpPostureStatus">
                                    <option value="Normal Alignment (No Scoliosis)">Normal Alignment (No Scoliosis)</option>
                                    <option value="Mild Postural Asymmetry">Mild Postural Asymmetry</option>
                                    <option value="Suspected Scoliosis (Orthopedic Referral)">Suspected Scoliosis (Orthopedic Referral)</option>
                                    <option value="Kyphosis / Lordosis Observed">Kyphosis / Lordosis Observed</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Skin & Integumentary</label>
                                <select class="form-control custom-select" id="inpSkinStatus">
                                    <option value="Clean & Intact (Normal)">Clean & Intact (Normal)</option>
                                    <option value="Mild Dermatitis / Eczema">Mild Dermatitis / Eczema</option>
                                    <option value="Acne Vulgaris (Mild-Moderate)">Acne Vulgaris (Mild-Moderate)</option>
                                    <option value="Fungal Infection / Referral">Fungal Infection / Referral</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: LABORATORY & DIAGNOSTICS -->
                    <div class="card border-0 bg-light p-3 mb-4 rounded-lg">
                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-flask text-danger mr-2"></i>4. Diagnostic Tests & Laboratory Clearance
                        </h6>
                        <div class="row">
                            <div class="col-md-4 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Hemoglobin / CBC Check</label>
                                <select class="form-control custom-select" id="inpCbcStatus">
                                    <option value="Normal Hemoglobin & RBC">Normal Hemoglobin & RBC</option>
                                    <option value="Mild Anemia (Iron Supplementation)">Mild Anemia (Iron Supplementation)</option>
                                    <option value="Pending Laboratory Results">Pending Laboratory Results</option>
                                </select>
                            </div>

                            <div class="col-md-4 col-6 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Urinalysis Dipstick</label>
                                <select class="form-control custom-select" id="inpUrinalysisStatus">
                                    <option value="Negative for Protein & Glucose (Normal)">Negative for Protein & Glucose (Normal)</option>
                                    <option value="Trace Protein / Hydration Advised">Trace Protein / Hydration Advised</option>
                                    <option value="Microscopic Hematuria (Referral)">Microscopic Hematuria (Referral)</option>
                                </select>
                            </div>

                            <div class="col-md-4 col-12 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Chest X-Ray / Pulmonary Clearance</label>
                                <select class="form-control custom-select" id="inpXrayStatus">
                                    <option value="Clear / Normal Lung Fields">Clear / Normal Lung Fields</option>
                                    <option value="Prior Primary Complex (Resolved)">Prior Primary Complex (Resolved)</option>
                                    <option value="Pending Chest Radiograph">Pending Chest Radiograph</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 5: FINAL MEDICAL CLEARANCE CLASSIFICATION & REMARKS -->
                    <div class="card border-0 bg-light p-3 rounded-lg">
                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-certificate text-success mr-2"></i>5. Overall DepEd Health Clearance Classification & Action Plan
                        </h6>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Medical Clearance Class <span class="text-danger">*</span></label>
                                <select class="form-control custom-select font-weight-bold" id="inpClearanceClass" required>
                                    <option value="Class A - Fit for All Academic & Physical Activities">Class A - Fit for All Academic & Physical Activities</option>
                                    <option value="Class B - Fit with Minor Corrective Follow-Up">Class B - Fit with Minor Corrective Follow-Up</option>
                                    <option value="Class C - Conditional (Requires Specialist Clearance)">Class C - Conditional (Requires Specialist Clearance)</option>
                                    <option value="Class D - Temporarily Unfit (Active Medical Care)">Class D - Temporarily Unfit (Active Medical Care)</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Specialist Referral Recommendation</label>
                                <select class="form-control custom-select" id="inpReferralTarget">
                                    <option value="None (Fully Cleared)">None (Fully Cleared)</option>
                                    <option value="Optometry / Ophthalmology (Prescription Glasses)">Optometry / Ophthalmology (Prescription Glasses)</option>
                                    <option value="Dental Clinic (Restoration / Prophylaxis)">Dental Clinic (Restoration / Prophylaxis)</option>
                                    <option value="Orthopedic Spine Specialist">Orthopedic Spine Specialist</option>
                                    <option value="Pulmonology / Allergy Specialist">Pulmonology / Allergy Specialist</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="font-weight-bold text-xs text-uppercase text-muted">Physician Clinical Remarks & Student Guidance</label>
                                <textarea class="form-control" id="inpPhysicianRemarks" rows="2" placeholder="Document specific physical findings, lifestyle advice, or physical education accommodations..."></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light px-4 py-3 border-0">
                    <button class="btn btn-secondary font-weight-bold px-4" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-maroon font-weight-bold px-4 shadow-sm" type="submit">
                        <i class="fas fa-save mr-1"></i> Save Screening Assessment
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="viewScreeningModal" tabindex="-1" role="dialog" aria-labelledby="viewScreeningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Profile Banner Header -->
            <div class="screening-banner d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img id="sViewAvatar" src="img/undraw_profile.svg" alt="Student Photo" class="avatar-circle-lg mr-3 bg-white">
                    <div>
                        <h4 id="sViewFullName" class="font-weight-bold mb-1 text-white">Maria Clara Santos</h4>
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <span class="badge badge-light text-dark font-weight-bold mr-2" id="sViewRecordId"><i class="fas fa-id-badge mr-1"></i>ID: #HSR-2026-001</span>
                            <span class="badge badge-light mr-2" id="sViewStrand">BS Information System | 4th Year</span>
                            <span class="badge badge-clear-a" id="sViewClearanceBadge">Class A - Fit</span>
                        </div>
                    </div>
                </div>
                <button class="close text-white opacity-75" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Navigation Tabs -->
            <div class="bg-light px-4 pt-3 border-bottom">
                <ul class="nav nav-pills nav-pills-custom" id="screenTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="soverview-tab" data-toggle="tab" href="#soverviewTab" role="tab"><i class="fas fa-clipboard-check mr-1"></i> Assessment Matrix</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="scert-tab" data-toggle="tab" href="#scertTab" role="tab"><i class="fas fa-certificate mr-1"></i> DepEd Health Certificate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sreferral-tab" data-toggle="tab" href="#sreferralTab" role="tab"><i class="fas fa-paper-plane mr-1"></i> Specialist Referral</a>
                    </li>
                </ul>
            </div>

            <div class="modal-body p-4">
                <div class="tab-content" id="screenTabsContent">

                    <!-- TAB 1: ASSESSMENT MATRIX -->
                    <div class="tab-pane fade show active" id="soverviewTab" role="tabpanel">

                        <!-- 4 Key Systems Matrix -->
                        <div class="row mb-4">
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded border text-center h-100">
                                    <div class="text-xs font-weight-bold text-muted text-uppercase mb-1"><i class="fas fa-eye text-primary mr-1"></i> Visual Acuity</div>
                                    <div class="h5 font-weight-bold text-dark mb-0" id="sValVision">20/20 &bull; 20/20</div>
                                    <small class="text-muted" id="sValColorVision">Ishihara: Normal</small>
                                    <div class="mt-2"><span class="scr-pill scr-pass" id="sBadgeVision">Normal Acuity</span></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded border text-center h-100">
                                    <div class="text-xs font-weight-bold text-muted text-uppercase mb-1"><i class="fas fa-deaf text-info mr-1"></i> Audiometry</div>
                                    <div class="h6 font-weight-bold text-dark mb-0" id="sValHearing">Normal Bilateral</div>
                                    <small class="text-muted">Whisper Test: Pass</small>
                                    <div class="mt-2"><span class="scr-pill scr-pass" id="sBadgeHearing">Auditory Intact</span></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded border text-center h-100">
                                    <div class="text-xs font-weight-bold text-muted text-uppercase mb-1"><i class="fas fa-tooth text-warning mr-1"></i> Oral & Dental</div>
                                    <div class="h6 font-weight-bold text-dark mb-0" id="sValDental">Caries-Free</div>
                                    <small class="text-muted">DMF-T Score: <span id="sValDmft">0</span></small>
                                    <div class="mt-2"><span class="scr-pill scr-pass" id="sBadgeDental">Good Hygiene</span></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded border text-center h-100">
                                    <div class="text-xs font-weight-bold text-muted text-uppercase mb-1"><i class="fas fa-child text-success mr-1"></i> Spine / Posture</div>
                                    <div class="h6 font-weight-bold text-dark mb-0" id="sValPosture">Normal S-Curve</div>
                                    <small class="text-muted">Adam's Test: Neg</small>
                                    <div class="mt-2"><span class="scr-pill scr-pass" id="sBadgePosture">No Scoliosis</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Diagnostic Checks & Lab Findings -->
                        <div class="card bg-light border-0 p-3 mb-3 rounded">
                            <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-flask text-danger mr-1"></i> Laboratory & Diagnostic Overview</h6>
                            <div class="row">
                                <div class="col-md-4 col-12 mb-2">
                                    <small class="text-muted d-block">Hemoglobin / CBC</small>
                                    <strong class="text-dark font-weight-semibold" id="sValCbc">Normal Hemoglobin</strong>
                                </div>
                                <div class="col-md-4 col-12 mb-2">
                                    <small class="text-muted d-block">Urinalysis Dipstick</small>
                                    <strong class="text-dark font-weight-semibold" id="sValUrinalysis">Negative for Protein/Sugar</strong>
                                </div>
                                <div class="col-md-4 col-12 mb-2">
                                    <small class="text-muted d-block">Chest Radiograph (X-Ray)</small>
                                    <strong class="text-dark font-weight-semibold" id="sValXray">Clear Lung Fields</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Clearance & Physician Notes -->
                        <div class="card border-0 bg-light p-3 rounded">
                            <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-user-md text-primary mr-1"></i> Examiner Findings & Recommendations</h6>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Overall DepEd Clearance Status</small>
                                    <strong class="text-success h6 font-weight-bold" id="sValClearanceText">Class A - Fit for All Academic & Physical Activities</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">School Physician</small>
                                    <strong class="text-dark" id="sValPhysician">Dr. Evelyn Santos, MD</strong>
                                </div>
                                <div class="col-12 mt-2">
                                    <small class="text-muted d-block">Physician Clinical Remarks</small>
                                    <div class="bg-white p-2 rounded border small text-dark" id="sValRemarks">
                                        Student is in excellent physical condition. Passed all sensory and systemic screenings without limitations.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 2: PRINTABLE OFFICIAL HEALTH CERTIFICATE (DEPED FORM 8) -->
                    <div class="tab-pane fade" id="scertTab" role="tabpanel">
                        <div class="border rounded p-4 bg-white" id="printableCertificateArea">
                            <div class="text-center border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <img src="img/logo.png" alt="Logo" style="width: 44px; height: 44px; object-fit: contain;" class="mr-3">
                                    <div class="text-left">
                                        <h6 class="font-weight-bold text-uppercase mb-0" style="color: var(--maroon-primary);">Republic of the Philippines &bull; Department of Education</h6>
                                        <h5 class="font-weight-bold text-dark mb-0">Senior High School Student Health Certificate</h5>
                                        <small class="text-muted">Standard Physical Examination Record (DepEd Form 8 / School Health Card)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-xs mb-3">
                                <div class="col-6"><strong>Student Name:</strong> <span id="certStudentName">Maria Clara Santos</span></div>
                                <div class="col-6 text-right"><strong>Screening ID:</strong> <span id="certScreeningId">#HSR-2026-001</span></div>
                                <div class="col-6"><strong>Student ID:</strong> <span id="certLRN">21S0011</span></div>
                                <div class="col-6 text-right"><strong>Exam Date:</strong> <span id="certDate">October 02, 2026</span></div>
                                <div class="col-6"><strong>Course & Year:</strong> <span id="certGradeStrand">4th Year - BS Information System</span></div>
                                <div class="col-6 text-right"><strong>Exam Type:</strong> <span id="certExamType">Annual Comprehensive</span></div>
                            </div>

                            <table class="table table-bordered table-sm text-center mb-3">
                                <thead class="bg-light">
                                    <tr class="text-xs">
                                        <th>Vision (OD/OS)</th>
                                        <th>Color Vision</th>
                                        <th>Audiometry</th>
                                        <th>Oral & Dental</th>
                                        <th>Spine / Posture</th>
                                        <th>Chest X-Ray</th>
                                        <th>Medical Clearance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bold text-xs">
                                        <td id="certVision">20/20, 20/20</td>
                                        <td id="certColor">Normal</td>
                                        <td id="certHearing">Normal Bilateral</td>
                                        <td id="certDental">Caries-Free</td>
                                        <td id="certPosture">Normal</td>
                                        <td id="certXray">Clear</td>
                                        <td id="certClearance" class="text-success">Class A (Fit)</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="bg-light p-3 rounded text-xs mb-3">
                                <strong>Physician Remarks & Accommodations:</strong><br>
                                <span id="certRemarks">Student is certified physically fit for all university curriculum activities, laboratory workshops, and athletic sports programs.</span>
                            </div>

                            <div class="row pt-4 text-xs">
                                <div class="col-6 text-center">
                                    <div class="border-top pt-1 mt-3" style="width: 80%; margin: auto;">
                                        <strong id="certPhysician">Dr. Evelyn Santos, MD</strong><br>
                                        <span class="text-muted">Licensed School Medical Officer &bull; PRC Lic: 0098412</span>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="border-top pt-1 mt-3" style="width: 80%; margin: auto;">
                                        <strong>School Clinic Official Seal</strong><br>
                                        <span class="text-muted">Health Services Management Unit</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-3">
                            <button class="btn btn-sm btn-info font-weight-bold" onclick="printCertificate()">
                                <i class="fas fa-print mr-1"></i> Print DepEd Health Certificate
                            </button>
                        </div>
                    </div>

                    <!-- TAB 3: SPECIALIST REFERRAL LETTER -->
                    <div class="tab-pane fade" id="sreferralTab" role="tabpanel">
                        <div class="border rounded p-4 bg-white">
                            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                                <i class="fas fa-paper-plane text-primary mr-2"></i>School Medical Referral Slip
                            </h6>
                            <div class="text-xs mb-3">
                                <p><strong>To:</strong> <span id="refTargetSpecialist" class="text-primary font-weight-bold">Attending Specialist / Clinic</span></p>
                                <p><strong>Patient:</strong> <span id="refStudent">Maria Clara Santos</span> (ID: <span id="refLrn">21S0011</span>, <span id="refGrade">4th Year - BS Information System</span>)</p>
                                <p><strong>Reason for Referral:</strong></p>
                                <div class="bg-light p-3 rounded border text-dark font-weight-semibold" id="refReasonText">
                                    Routine annual health screening completed. No specialized intervention currently required.
                                </div>
                            </div>
                            <div class="text-xs text-muted">
                                Please furnish the Senior High School Clinic with a copy of the diagnostic findings and treatment plan for academic records.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-light px-4 py-2 border-0 d-flex justify-content-between">
                <button class="btn btn-outline-danger btn-sm font-weight-bold" onclick="deleteCurrentScreening()">
                    <i class="fas fa-trash-alt mr-1"></i> Delete Record
                </button>
                <div>
                    <button class="btn btn-outline-primary btn-sm font-weight-bold mr-2" onclick="editCurrentScreening()">
                        <i class="fas fa-edit mr-1"></i> Edit Assessment
                    </button>
                    <button class="btn btn-secondary btn-sm font-weight-bold" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="toast-notification bg-white border p-3 shadow-lg" id="toastBox">
    <div class="d-flex align-items-center">
        <div id="toastIcon" class="icon-circle bg-success text-white mr-3">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-grow-1 mr-3">
            <h6 class="font-weight-bold mb-0 text-dark" id="toastTitle">Notification</h6>
            <small class="text-muted" id="toastMessage">Action completed successfully.</small>
        </div>
        <button type="button" class="close" onclick="hideToast()">&times;</button>
    </div>
</div>

<script>
    // Preloaded Initial Health Screening Dataset for University Students
    let screeningRecords = [{
            id: "HSR-2026-001",
            studentName: "Rex Mark Ricafranca",
            lrn: "22B0023",
            grade: "3rd Year",
            strand: "BS Political Science",
            sex: "Male",
            age: 20,
            avatar: "img/undraw_profile_2.svg",
            examType: "Annual Comprehensive Physical",
            examDate: "2026-10-08",
            visionOD: "20/20 (Normal)",
            visionOS: "20/20 (Normal)",
            colorVision: "Normal (14/14 Plates)",
            hearing: "Normal Hearing Bilateral",
            dentalStatus: "Caries-Free (Normal teeth condition)",
            dmftScore: 0,
            postureStatus: "Normal Alignment",
            skinStatus: "Clean & Intact",
            cbcStatus: "Normal Hemoglobin & RBC",
            urinalysisStatus: "Negative for Protein & Glucose",
            xrayStatus: "Clear / Normal Lung Fields",
            clearanceClass: "Class A - Fit for All Academic & Physical Activities",
            referralTarget: "None (Fully Cleared)",
            physician: "Dr. Maria Santos, MD",
            remarks: "Blood pressure monitored at 130/85. Cleared for all campus sports and academic curricular."
        },
        {
            id: "HSR-2026-002",
            studentName: "Mica Santos",
            lrn: "21S0011",
            grade: "4th Year",
            strand: "BS Information System",
            sex: "Female",
            age: 21,
            avatar: "img/undraw_profile_1.svg",
            examType: "Annual Comprehensive Physical",
            examDate: "2026-10-01",
            visionOD: "20/20 (Normal)",
            visionOS: "20/20 (Normal)",
            colorVision: "Normal (14/14 Plates)",
            hearing: "Normal Hearing Bilateral",
            dentalStatus: "Caries-Free (Optimal Oral Health)",
            dmftScore: 0,
            postureStatus: "Normal Alignment",
            skinStatus: "Clean & Intact",
            cbcStatus: "Normal Hemoglobin & RBC",
            urinalysisStatus: "Negative for Protein & Glucose",
            xrayStatus: "Clear / Normal Lung Fields",
            clearanceClass: "Class A - Fit for PE (With Warm-up Protocol)",
            referralTarget: "None (Controlled Asthma)",
            physician: "Dr. Evelyn Santos, MD",
            remarks: "Student carries Salbutamol rescue inhaler. Cleared with warm-up protocol."
        }
    ];

    function loadScreeningRecordsFromStorage() {
        try {
            if (window.SmartClinicDB && SmartClinicDB.getScreenings) {
                const data = SmartClinicDB.getScreenings();
                if (Array.isArray(data) && data.length > 0) return data;
            }
            const stored = localStorage.getItem('shsms_screenings_records');
            if (stored) {
                const parsed = JSON.parse(stored);
                if (Array.isArray(parsed) && parsed.length > 0) return parsed;
            }
        } catch (e) {
            console.warn('Storage read error for screenings:', e);
        }
        try {
            localStorage.setItem('shsms_screenings_records', JSON.stringify(seedScreeningRecords));
        } catch (e) {}
        return JSON.parse(JSON.stringify(seedScreeningRecords));
    }

    function saveScreeningRecordsToStorage(data) {
        try {
            localStorage.setItem('shsms_screenings_records', JSON.stringify(data));
            if (window.SmartClinicDB && SmartClinicDB.broadcastUpdate) {
                SmartClinicDB.broadcastUpdate('screenings_updated');
            }
        } catch (e) {}
    }

    const seedScreeningRecords = screeningRecords;
    screeningRecords = loadScreeningRecordsFromStorage();

    let currentActiveView = 'table';
    let currentPresetFilter = 'all';
    let currentlySelectedScreening = null;
    let chartInstances = {};

    // Student Directory for Fast Auto-fill
    let studentDatabase = {
        "LRN-22B0023": {
            name: "Rex Mark Ricafranca",
            lrn: "22B0023",
            grade: "3rd Year",
            strand: "BS Political Science",
            sex: "Male",
            age: 20,
            avatar: "img/undraw_profile_2.svg"
        },
        "LRN-21S0011": {
            name: "Mica Santos",
            lrn: "21S0011",
            grade: "4th Year",
            strand: "BS Information System",
            sex: "Female",
            age: 21,
            avatar: "img/undraw_profile_1.svg"
        }
    };

    function syncStudentDatabase() {
        try {
            if (window.SmartClinicDB && SmartClinicDB.getStudents) {
                const students = SmartClinicDB.getStudents();
                students.forEach(st => {
                    const lrnVal = st.lrn || st.idNumber || st.id;
                    const key = 'LRN-' + lrnVal;
                    studentDatabase[key] = {
                        name: st.fullName || `${st.firstName || ''} ${st.lastName || ''}`.trim(),
                        lrn: lrnVal,
                        grade: st.grade || '1st Year',
                        strand: st.strand || 'General',
                        sex: st.sex || 'Female',
                        age: st.age || 18,
                        avatar: st.avatar || 'img/undraw_profile.svg'
                    };
                });
            }
        } catch (e) {}

        const sel = document.getElementById('inpStudentSelect');
        if (sel) {
            const currentVal = sel.value;
            sel.innerHTML = '<option value="">-- Choose Registered Student --</option>';
            Object.keys(studentDatabase).forEach(k => {
                const s = studentDatabase[k];
                const opt = document.createElement('option');
                opt.value = k;
                opt.textContent = `${s.name} (LRN: ${s.lrn}) - ${s.grade} ${s.strand}`;
                sel.appendChild(opt);
            });
            if (currentVal) sel.value = currentVal;
        }
    }

    function reloadScreenings() {
        screeningRecords = loadScreeningRecordsFromStorage();
        syncStudentDatabase();
        renderScreeningRecords();
        updateDashboardMetrics();
        updateCharts();
    }

    window.addEventListener('storage', function(e) {
        if (['shsms_screenings_records', 'shsms_students', 'shsms_registered_patients'].includes(e.key)) {
            reloadScreenings();
        }
    });
    window.addEventListener('smart-clinic-updated', function() {
        reloadScreenings();
    });

    // Initialize Page
    $(document).ready(function() {
        syncStudentDatabase();
        reloadScreenings();
        initCharts();

        // Set default date
        const today = new Date().toISOString().slice(0, 10);
        $('#inpExamDate').val(today);
    });

    // Auto-fill student details
    function autoFillStudentDetails(key) {
        if (!key || !studentDatabase[key]) {
            $('#inpLRN').val('');
            $('#inpGradeStrand').val('');
            $('#inpSexAge').val('');
            return;
        }
        const st = studentDatabase[key];
        $('#inpLRN').val(st.lrn);
        $('#inpGradeStrand').val(st.grade + ' - ' + st.strand);
        $('#inpSexAge').val(st.sex + ', ' + st.age + ' yrs');
    }

    // Prepare blank screening form
    function prepareNewScreeningForm() {
        $('#modalFormTitle').text('Record Health Screening Assessment');
        $('#editingScreeningId').val('');
        $('#screeningEntryForm')[0].reset();

        const today = new Date().toISOString().slice(0, 10);
        $('#inpExamDate').val(today);
        $('#inpPhysician').val('Dr. Evelyn Santos, MD (School Physician)');
        $('#inpDmftScore').val(0);
    }

    // Handle submission of new or edited screening record
    function handleScreeningFormSubmit(e) {
        e.preventDefault();
        const editId = $('#editingScreeningId').val();
        const studentKey = $('#inpStudentSelect').val();

        let studentName = "";
        let lrn = $('#inpLRN').val();
        let grade = "";
        let strand = "";
        let sex = "Female";
        let age = 17;
        let avatar = "img/undraw_profile.svg";

        if (studentDatabase[studentKey]) {
            const st = studentDatabase[studentKey];
            studentName = st.name;
            lrn = st.lrn;
            grade = st.grade;
            strand = st.strand;
            sex = st.sex;
            age = st.age;
            avatar = st.avatar;
        } else if (editId) {
            const existing = screeningRecords.find(r => r.id === editId);
            if (existing) {
                studentName = existing.studentName;
                lrn = existing.lrn;
                grade = existing.grade;
                strand = existing.strand;
                sex = existing.sex;
                age = existing.age;
                avatar = existing.avatar;
            }
        } else {
            showToast("Please choose a registered student.", "danger", "fas fa-exclamation-triangle");
            return;
        }

        const examType = $('#inpExamType').val();
        const examDate = $('#inpExamDate').val();
        const visionOD = $('#inpVisionOD').val();
        const visionOS = $('#inpVisionOS').val();
        const colorVision = $('#inpColorVision').val();
        const hearing = $('#inpHearing').val();
        const dentalStatus = $('#inpDentalStatus').val();
        const dmftScore = parseInt($('#inpDmftScore').val()) || 0;
        const postureStatus = $('#inpPostureStatus').val();
        const skinStatus = $('#inpSkinStatus').val();
        const cbcStatus = $('#inpCbcStatus').val();
        const urinalysisStatus = $('#inpUrinalysisStatus').val();
        const xrayStatus = $('#inpXrayStatus').val();
        const clearanceClass = $('#inpClearanceClass').val();
        const referralTarget = $('#inpReferralTarget').val();
        const physician = $('#inpPhysician').val();
        const remarks = $('#inpPhysicianRemarks').val() || "Health screening completed and verified under standard clinical protocol.";

        if (editId) {
            const idx = screeningRecords.findIndex(r => r.id === editId);
            if (idx !== -1) {
                screeningRecords[idx] = {
                    ...screeningRecords[idx],
                    examType,
                    examDate,
                    visionOD,
                    visionOS,
                    colorVision,
                    hearing,
                    dentalStatus,
                    dmftScore,
                    postureStatus,
                    skinStatus,
                    cbcStatus,
                    urinalysisStatus,
                    xrayStatus,
                    clearanceClass,
                    referralTarget,
                    physician,
                    remarks
                };
                showToast(`Screening record ${editId} updated!`, "success", "fas fa-check-circle");
            }
        } else {
            const newId = "HSR-2026-" + String(screeningRecords.length + 1).padStart(3, '0');
            const newRec = {
                id: newId,
                studentName,
                lrn,
                grade,
                strand,
                sex,
                age,
                avatar,
                examType,
                examDate,
                visionOD,
                visionOS,
                colorVision,
                hearing,
                dentalStatus,
                dmftScore,
                postureStatus,
                skinStatus,
                cbcStatus,
                urinalysisStatus,
                xrayStatus,
                clearanceClass,
                referralTarget,
                physician,
                remarks
            };
            screeningRecords.unshift(newRec);
            showToast(`Screening record created for ${studentName} (${newId})!`, "success", "fas fa-check-circle");
        }

        saveScreeningRecordsToStorage(screeningRecords);
        $('#recordScreeningModal').modal('hide');
        renderScreeningRecords();
        updateDashboardMetrics();
        updateCharts();
    }

    // Render Table & Grid views
    function renderScreeningRecords() {
        const searchVal = $('#screeningSearchInput').val().toLowerCase().trim();
        const strandVal = $('#filterStrand').val();
        const gradeVal = $('#filterGrade').val();
        const examTypeVal = $('#filterExamType').val();

        let filtered = screeningRecords.filter(item => {
            const matchSearch = !searchVal ||
                item.studentName.toLowerCase().includes(searchVal) ||
                item.lrn.includes(searchVal) ||
                item.id.toLowerCase().includes(searchVal) ||
                item.remarks.toLowerCase().includes(searchVal) ||
                item.dentalStatus.toLowerCase().includes(searchVal) ||
                item.visionOD.toLowerCase().includes(searchVal);

            const matchStrand = !strandVal || item.strand === strandVal;
            const matchGrade = !gradeVal || item.grade === gradeVal;
            const matchExam = !examTypeVal || item.examType === examTypeVal;

            let matchPreset = true;
            if (currentPresetFilter === 'classA') matchPreset = item.clearanceClass.includes('Class A');
            else if (currentPresetFilter === 'classB') matchPreset = item.clearanceClass.includes('Class B');
            else if (currentPresetFilter === 'vision') matchPreset = !item.visionOD.includes('20/20') || !item.visionOS.includes('20/20');
            else if (currentPresetFilter === 'dental') matchPreset = item.dmftScore > 0 || item.dentalStatus.includes('Caries');
            else if (currentPresetFilter === 'scoliosis') matchPreset = item.postureStatus.includes('Asymmetry') || item.postureStatus.includes('Scoliosis');
            else if (currentPresetFilter === 'referral') matchPreset = !item.referralTarget.includes('None');

            return matchSearch && matchStrand && matchGrade && matchExam && matchPreset;
        });

        $('#recordCountBadge').text(`Showing ${filtered.length} of ${screeningRecords.length} records`);
        $('#showingCountText').text(`1 to ${filtered.length}`);
        $('#totalCountText').text(screeningRecords.length);

        // Table HTML
        let tableHtml = "";
        if (filtered.length === 0) {
            tableHtml = `<tr><td colspan="9" class="text-center py-5 text-muted">
                    <i class="fas fa-stethoscope fa-3x mb-3 text-gray-300"></i>
                    <p class="font-weight-bold mb-1">No matching health screening records found.</p>
                    <small>Try clearing your search filters.</small>
                </td></tr>`;
        } else {
            filtered.forEach(rec => {
                // Clearance badge
                let clearBadge = "badge-clear-a";
                let clearShort = "Class A - Fit";
                if (rec.clearanceClass.includes('Class B')) {
                    clearBadge = "badge-clear-b";
                    clearShort = "Class B - Minor";
                } else if (rec.clearanceClass.includes('Class C')) {
                    clearBadge = "badge-clear-c";
                    clearShort = "Class C - Referral";
                } else if (rec.clearanceClass.includes('Class D')) {
                    clearBadge = "badge-clear-d";
                    clearShort = "Class D - Unfit";
                }

                // Vision status pill
                let isVisionNormal = rec.visionOD.includes('20/20') && rec.visionOS.includes('20/20');
                let visionBadge = isVisionNormal ? '<span class="scr-pill scr-pass">20/20 Normal</span>' : '<span class="scr-pill scr-flag">Deficit</span>';

                // Dental status pill
                let isDentalClean = rec.dmftScore === 0;
                let dentalBadge = isDentalClean ? '<span class="scr-pill scr-pass">Caries-Free</span>' : '<span class="scr-pill scr-flag">Caries (DMF:' + rec.dmftScore + ')</span>';

                // Posture pill
                let isPostureNormal = rec.postureStatus.includes('Normal');
                let postureBadge = isPostureNormal ? '<span class="scr-pill scr-pass">Normal Spine</span>' : '<span class="scr-pill scr-caution">Asymmetry</span>';

                // Strand badge
                let strandClass = "badge-strand-stem";
                if (rec.strand === 'ABM') strandClass = "badge-strand-abm";
                else if (rec.strand === 'HUMSS') strandClass = "badge-strand-humss";
                else if (rec.strand === 'TVL') strandClass = "badge-strand-tvl";
                else if (rec.strand === 'GAS') strandClass = "badge-strand-gas";

                tableHtml += `
                    <tr>
                        <td class="pl-4">
                            <span class="badge badge-light border text-dark font-weight-bold d-block mb-1">${rec.id}</span>
                            <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i>${rec.examDate}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="${rec.avatar}" class="avatar-circle mr-2" alt="Avatar">
                                <div>
                                    <div class="font-weight-bold text-dark">${rec.studentName}</div>
                                    <div class="small text-muted">LRN: ${rec.lrn}</div>
                                    <span class="badge ${strandClass} mr-1">${rec.strand}</span>
                                    <span class="badge badge-light border text-muted">${rec.grade}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bold text-dark text-xs">${rec.visionOD.split(' ')[0]} / ${rec.visionOS.split(' ')[0]}</div>
                            ${visionBadge}
                        </td>
                        <td>
                            <div class="small font-weight-bold text-dark">${rec.hearing.split(' ')[0]}</div>
                            <span class="scr-pill scr-pass">Whisper Pass</span>
                        </td>
                        <td>
                            <div class="small font-weight-bold text-dark">${dentalBadge}</div>
                        </td>
                        <td>
                            <div class="small font-weight-bold text-dark">${postureBadge}</div>
                        </td>
                        <td>
                            <span class="badge badge-light border text-xs text-muted"><i class="fas fa-check text-success mr-1"></i>CBC & X-Ray</span>
                        </td>
                        <td>
                            <span class="${clearBadge}">${clearShort}</span>
                        </td>
                        <td class="text-center pr-4">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="View Full Health Certificate" onclick="openViewScreeningModal('${rec.id}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Print DepEd Form 8" onclick="openPrintCertModal('${rec.id}')">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete Record" onclick="confirmDeleteScreening('${rec.id}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
            });
        }
        $('#screeningTableBody').html(tableHtml);

        // Grid View HTML
        let gridHtml = "";
        if (filtered.length === 0) {
            gridHtml = `<div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-stethoscope fa-3x mb-3 text-gray-300"></i>
                    <p class="font-weight-bold">No matching health screening records found.</p>
                </div>`;
        } else {
            filtered.forEach(rec => {
                let clearBadge = "badge-clear-a";
                if (rec.clearanceClass.includes('Class B')) clearBadge = "badge-clear-b";
                else if (rec.clearanceClass.includes('Class C')) clearBadge = "badge-clear-c";
                else if (rec.clearanceClass.includes('Class D')) clearBadge = "badge-clear-d";

                gridHtml += `
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card scr-grid-card h-100 shadow-sm">
                            <div class="card-header bg-white border-0 pb-0 pt-3 d-flex align-items-center justify-content-between">
                                <span class="badge badge-light border text-dark font-weight-bold">${rec.id}</span>
                                <small class="text-muted"><i class="far fa-calendar mr-1"></i>${rec.examDate}</small>
                            </div>
                            <div class="card-body pt-2 pb-3">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="${rec.avatar}" class="avatar-circle mr-3" alt="Avatar">
                                    <div>
                                        <h6 class="font-weight-bold text-dark mb-0">${rec.studentName}</h6>
                                        <small class="text-muted d-block">LRN: ${rec.lrn}</small>
                                        <span class="badge badge-light border mr-1">${rec.grade}</span>
                                        <span class="badge badge-strand-stem">${rec.strand}</span>
                                    </div>
                                </div>

                                <!-- Sensory & Physical Grid Matrix -->
                                <div class="row text-center no-gutters mb-3">
                                    <div class="col-3 p-1">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-xs font-weight-bold text-primary">Vision</div>
                                            <div class="font-weight-bold text-dark text-xs">${rec.visionOD.split(' ')[0]}</div>
                                        </div>
                                    </div>
                                    <div class="col-3 p-1">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-xs font-weight-bold text-info">Hearing</div>
                                            <div class="font-weight-bold text-dark text-xs">Pass</div>
                                        </div>
                                    </div>
                                    <div class="col-3 p-1">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-xs font-weight-bold text-warning">Dental</div>
                                            <div class="font-weight-bold text-dark text-xs">DMF:${rec.dmftScore}</div>
                                        </div>
                                    </div>
                                    <div class="col-3 p-1">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-xs font-weight-bold text-success">Spine</div>
                                            <div class="font-weight-bold text-dark text-xs">${rec.postureStatus.includes('Normal') ? 'Normal' : 'Check'}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="small text-muted mb-3">
                                    <i class="fas fa-user-md text-primary mr-1"></i><strong>Examiner:</strong> ${rec.physician}
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                    <span class="${clearBadge}">
                                        ${rec.clearanceClass.split(' - ')[0]}
                                    </span>
                                    <button class="btn btn-sm btn-outline-maroon font-weight-bold" onclick="openViewScreeningModal('${rec.id}')">
                                        View Certificate & Slip
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });
        }
        $('#gridViewContainer').html(gridHtml);
    }

    // View Switcher
    function switchView(view) {
        currentActiveView = view;
        if (view === 'table') {
            $('#tableViewContainer').removeClass('d-none');
            $('#gridViewContainer').addClass('d-none');
            $('#btnTableView').addClass('active');
            $('#btnGridView').removeClass('active');
        } else {
            $('#tableViewContainer').addClass('d-none');
            $('#gridViewContainer').removeClass('d-none');
            $('#btnTableView').removeClass('active');
            $('#btnGridView').addClass('active');
        }
    }

    // Filter by preset pills
    function filterByPreset(preset) {
        currentPresetFilter = preset;
        $('.filter-pill').removeClass('active');

        if (preset === 'all') $('#pillAll').addClass('active');
        else if (preset === 'classA') $('#pillClassA').addClass('active');
        else if (preset === 'classB') $('#pillClassB').addClass('active');
        else if (preset === 'vision') $('#pillVision').addClass('active');
        else if (preset === 'dental') $('#pillDental').addClass('active');
        else if (preset === 'scoliosis') $('#pillScoliosis').addClass('active');
        else if (preset === 'referral') $('#pillReferral').addClass('active');

        renderScreeningRecords();
    }

    function filterScreenings() {
        renderScreeningRecords();
    }

    function searchScreening(val) {
        $('#screeningSearchInput').val(val);
        renderScreeningRecords();
    }

    // Update KPI metrics and counts
    function updateDashboardMetrics() {
        const total = screeningRecords.length;
        const classA = screeningRecords.filter(r => r.clearanceClass.includes('Class A')).length;
        const classB = screeningRecords.filter(r => r.clearanceClass.includes('Class B')).length;
        const referrals = screeningRecords.filter(r => !r.referralTarget.includes('None')).length;

        const visionAlerts = screeningRecords.filter(r => !r.visionOD.includes('20/20') || !r.visionOS.includes('20/20')).length;
        const dentalAlerts = screeningRecords.filter(r => r.dmftScore > 0 || r.dentalStatus.includes('Caries')).length;
        const spineAlerts = screeningRecords.filter(r => r.postureStatus.includes('Asymmetry') || r.postureStatus.includes('Scoliosis')).length;

        $('#statTotalScreened').text(`${total} Students`);
        $('#statClassA').text(`${classA} Students`);
        $('#statClassB').text(`${classB} Students`);
        $('#statReferrals').text(`${referrals} Case${referrals > 1 ? 's' : ''}`);
        $('#referralCounter').text(referrals);

        $('#countAll').text(total);
        $('#countClassA').text(classA);
        $('#countClassB').text(classB);
        $('#countVision').text(visionAlerts);
        $('#countDental').text(dentalAlerts);
        $('#countScoliosis').text(spineAlerts);
        $('#countReferral').text(referrals);
    }

    // Open View Screening & DepEd Certificate Modal
    function openViewScreeningModal(id) {
        const rec = screeningRecords.find(r => r.id === id);
        if (!rec) return;
        currentlySelectedScreening = rec;

        $('#sViewAvatar').attr('src', rec.avatar);
        $('#sViewFullName').text(rec.studentName);
        $('#sViewRecordId').html(`<i class="fas fa-id-badge mr-1"></i>ID: #${rec.id}`);
        $('#sViewStrand').text(`${rec.strand} | ${rec.grade} &bull; LRN: ${rec.lrn}`);

        let clearBadge = "badge-clear-a";
        if (rec.clearanceClass.includes('Class B')) clearBadge = "badge-clear-b";
        else if (rec.clearanceClass.includes('Class C')) clearBadge = "badge-clear-c";
        else if (rec.clearanceClass.includes('Class D')) clearBadge = "badge-clear-d";
        $('#sViewClearanceBadge').attr('class', clearBadge).text(rec.clearanceClass.split(' - ')[0]);

        // Tab 1 Fields
        $('#sValVision').text(`${rec.visionOD.split(' ')[0]} &bull; ${rec.visionOS.split(' ')[0]}`);
        $('#sValColorVision').text(`Ishihara: ${rec.colorVision.split(' ')[0]}`);
        $('#sValHearing').text(rec.hearing);
        $('#sValDental').text(rec.dentalStatus.split(' (')[0]);
        $('#sValDmft').text(rec.dmftScore);
        $('#sValPosture').text(rec.postureStatus.split(' (')[0]);
        $('#sValCbc').text(rec.cbcStatus);
        $('#sValUrinalysis').text(rec.urinalysisStatus);
        $('#sValXray').text(rec.xrayStatus);
        $('#sValClearanceText').text(rec.clearanceClass);
        $('#sValPhysician').text(rec.physician);
        $('#sValRemarks').text(rec.remarks);

        // Tab 2 DepEd Certificate Fields
        $('#certStudentName').text(rec.studentName);
        $('#certScreeningId').text('#' + rec.id);
        $('#certLRN').text(rec.lrn);
        $('#certDate').text(rec.examDate);
        $('#certGradeStrand').text(`${rec.grade} - ${rec.strand}`);
        $('#certExamType').text(rec.examType);
        $('#certVision').text(`${rec.visionOD.split(' ')[0]} / ${rec.visionOS.split(' ')[0]}`);
        $('#certColor').text(rec.colorVision.split(' ')[0]);
        $('#certHearing').text(rec.hearing.split(' ')[0]);
        $('#certDental').text(rec.dentalStatus.split(' (')[0]);
        $('#certPosture').text(rec.postureStatus.split(' (')[0]);
        $('#certXray').text(rec.xrayStatus.split(' / ')[0]);
        $('#certClearance').text(rec.clearanceClass);
        $('#certRemarks').text(rec.remarks);
        $('#certPhysician').text(rec.physician);

        // Tab 3 Referral Slip Fields
        $('#refTargetSpecialist').text(rec.referralTarget);
        $('#refStudent').text(rec.studentName);
        $('#refLrn').text(rec.lrn);
        $('#refGrade').text(`${rec.grade} - ${rec.strand}`);
        $('#refReasonText').text(`Referral for ${rec.referralTarget}. Primary Clinical Findings: ${rec.remarks}`);

        $('#screenTabs a[href="#soverviewTab"]').tab('show');
        $('#viewScreeningModal').modal('show');
    }

    // Print certificate trigger
    function openPrintCertModal(id) {
        openViewScreeningModal(id);
        $('#screenTabs a[href="#scertTab"]').tab('show');
    }

    // Edit Current Screening
    function editCurrentScreening() {
        if (!currentlySelectedScreening) return;
        const rec = currentlySelectedScreening;
        $('#viewScreeningModal').modal('hide');

        $('#modalFormTitle').text('Edit Health Screening Record #' + rec.id);
        $('#editingScreeningId').val(rec.id);

        const foundKey = Object.keys(studentDatabase).find(k => studentDatabase[k].lrn === rec.lrn);
        if (foundKey) {
            $('#inpStudentSelect').val(foundKey);
        }
        $('#inpLRN').val(rec.lrn);
        $('#inpGradeStrand').val(rec.grade + ' - ' + rec.strand);
        $('#inpSexAge').val(rec.sex + ', ' + rec.age + ' yrs');
        $('#inpExamType').val(rec.examType);
        $('#inpExamDate').val(rec.examDate);
        $('#inpVisionOD').val(rec.visionOD);
        $('#inpVisionOS').val(rec.visionOS);
        $('#inpColorVision').val(rec.colorVision);
        $('#inpHearing').val(rec.hearing);
        $('#inpDentalStatus').val(rec.dentalStatus);
        $('#inpDmftScore').val(rec.dmftScore);
        $('#inpPostureStatus').val(rec.postureStatus);
        $('#inpSkinStatus').val(rec.skinStatus);
        $('#inpCbcStatus').val(rec.cbcStatus);
        $('#inpUrinalysisStatus').val(rec.urinalysisStatus);
        $('#inpXrayStatus').val(rec.xrayStatus);
        $('#inpClearanceClass').val(rec.clearanceClass);
        $('#inpReferralTarget').val(rec.referralTarget);
        $('#inpPhysician').val(rec.physician);
        $('#inpPhysicianRemarks').val(rec.remarks);

        $('#recordScreeningModal').modal('show');
    }

    // Delete Current Screening
    function deleteCurrentScreening() {
        if (!currentlySelectedScreening) return;
        confirmDeleteScreening(currentlySelectedScreening.id);
    }

    function confirmDeleteScreening(id) {
        if (confirm(`Are you sure you want to delete health screening record #${id}?`)) {
            screeningRecords = screeningRecords.filter(r => r.id !== id);
            saveScreeningRecordsToStorage(screeningRecords);
            $('#viewScreeningModal').modal('hide');
            renderScreeningRecords();
            updateDashboardMetrics();
            updateCharts();
            showToast(`Screening record #${id} deleted from registry.`, "info", "fas fa-trash-alt");
        }
    }

    // Toggle Charts Section
    function toggleScreeningCharts() {
        const sec = $('#screeningChartsSection');
        if (sec.hasClass('d-none')) {
            sec.removeClass('d-none');
            $('#chartsToggleText').text('Hide Analytics');
            updateCharts();
        } else {
            sec.addClass('d-none');
            $('#chartsToggleText').text('Show Analytics');
        }
    }

    // Initialize Charts
    function initCharts() {
        if (typeof Chart === 'undefined') return;

        // Clearance Chart
        const ctxClear = document.getElementById('clearanceChart');
        if (ctxClear) {
            chartInstances.clearance = new Chart(ctxClear, {
                type: 'doughnut',
                data: {
                    labels: ['Class A (Fit)', 'Class B (Minor)', 'Class C/D (Referral)'],
                    datasets: [{
                        data: [5, 2, 1],
                        backgroundColor: ['#1cc88a', '#36b9cc', '#e74a3b'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    }
                }
            });
        }

        // Vision Chart
        const ctxVision = document.getElementById('visionChart');
        if (ctxVision) {
            chartInstances.vision = new Chart(ctxVision, {
                type: 'doughnut',
                data: {
                    labels: ['20/20 Normal', '20/25-20/30 Mild', '≥20/50 Deficit'],
                    datasets: [{
                        data: [6, 1, 1],
                        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    }
                }
            });
        }

        // Dental Chart
        const ctxDental = document.getElementById('dentalChart');
        if (ctxDental) {
            chartInstances.dental = new Chart(ctxDental, {
                type: 'doughnut',
                data: {
                    labels: ['Caries-Free', 'Prophylaxis Needed', 'Active Caries'],
                    datasets: [{
                        data: [6, 1, 1],
                        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    }
                }
            });
        }
    }

    // Update Charts
    function updateCharts() {
        if (!chartInstances.clearance) return;

        let cA = 0,
            cB = 0,
            cC = 0;
        let vNorm = 0,
            vMild = 0,
            vDef = 0;
        let dClean = 0,
            dProph = 0,
            dCar = 0;

        screeningRecords.forEach(r => {
            if (r.clearanceClass.includes('Class A')) cA++;
            else if (r.clearanceClass.includes('Class B')) cB++;
            else cC++;

            if (r.visionOD.includes('20/20') && r.visionOS.includes('20/20')) vNorm++;
            else if (r.visionOD.includes('20/70') || r.visionOS.includes('20/70') || r.visionOD.includes('20/50')) vDef++;
            else vMild++;

            if (r.dmftScore === 0) dClean++;
            else if (r.dentalStatus.includes('Gingivitis')) dProph++;
            else dCar++;
        });

        chartInstances.clearance.data.datasets[0].data = [cA, cB, cC];
        chartInstances.clearance.update();

        chartInstances.vision.data.datasets[0].data = [vNorm, vMild, vDef];
        chartInstances.vision.update();

        chartInstances.dental.data.datasets[0].data = [dClean, dProph, dCar];
        chartInstances.dental.update();
    }

    // Export Data
    function exportScreeningData() {
        let csv = "Screening_ID,Student_Name,LRN,Grade,Strand,Exam_Date,Exam_Type,Vision_OD,Vision_OS,Hearing,Dental_Status,DMF_T,Posture,Clearance_Class,Referral_Target,Physician\n";
        screeningRecords.forEach(r => {
            csv += `"${r.id}","${r.studentName}","${r.lrn}","${r.grade}","${r.strand}","${r.examDate}","${r.examType}","${r.visionOD}","${r.visionOS}","${r.hearing}","${r.dentalStatus}",${r.dmftScore},"${r.postureStatus}","${r.clearanceClass}","${r.referralTarget}","${r.physician}"\n`;
        });

        const blob = new Blob([csv], {
            type: 'text/csv;charset=utf-8;'
        });
        const link = document.createElement("a");
        const url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", `SHSMS_Health_Screening_Registry_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showToast("Health screening registry exported to CSV!", "success", "fas fa-file-excel");
    }

    function printCertificate() {
        window.print();
    }

    function printAllScreenings() {
        window.print();
    }

    // Toast Notification Helper
    function showToast(msg, type = "success", icon = "fas fa-check") {
        $('#toastMessage').text(msg);
        $('#toastTitle').text(type === "success" ? "Success" : type === "danger" ? "Action Needed" : "Registry Updated");
        $('#toastIcon').attr('class', `icon-circle bg-${type} text-white mr-3`).html(`<i class="${icon}"></i>`);
        $('#toastBox').fadeIn(200);

        setTimeout(() => {
            hideToast();
        }, 4500);
    }

    function hideToast() {
        $('#toastBox').fadeOut(200);
    }
</script>