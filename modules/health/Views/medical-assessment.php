<div class="container-fluid">

    <!-- Page Heading Bar -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold" style="color: var(--maroon-primary) !important;">
                <i class="fas fa-clipboard-list text-maroon mr-2"></i>Medical Assessment Documentation
            </h1>
            <p class="text-muted small mb-0">Clinical SOAP Notes, Physical Examination Documentation, Diagnostic Impressions & Medical Clearances</p>
        </div>
        <div class="mt-3 mt-sm-0">
            <button class="btn btn-sm btn-outline-secondary shadow-sm font-weight-bold mr-2" onclick="exportAssessmentData()">
                <i class="fas fa-file-export fa-sm mr-1"></i> Export Records
            </button>
            <button class="btn btn-sm btn-outline-info shadow-sm font-weight-bold" onclick="printAssessmentSummary()">
                <i class="fas fa-print fa-sm mr-1"></i> Print Summary Report
            </button>
        </div>
    </div>

    <!-- Medical Assessment KPI Metric Cards -->
    <div class="row mb-4">

        <!-- Card 1: Total Assessments Completed -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-assessment border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Assessments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statTotalAssessments">1,180</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-file-medical-alt mr-1"></i> Documented SOAP Files</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-notes-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Annual Physical Exams -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-assessment border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Annual Physical Exams</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">892 Screened</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-stethoscope text-success mr-1"></i> Routine Student Evaluations</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Assessments Requiring Follow-Up -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-assessment border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Follow-Up Required</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">46 Cases</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-clock mr-1"></i> Active Clinical Monitoring</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Sports & PE Clearances -->
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-assessment border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PE Sports Clearances</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">98.2% Cleared</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-running text-info mr-1"></i> Certified Fit for Athletics</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Interactive Search & Filtering Controls Card -->
    <div class="card card-assessment mb-4">
        <div class="card-body">
            <div class="row align-items-center">

                <!-- Search Input -->
                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 position-relative">
                    <i class="fas fa-search search-icon-pos"></i>
                    <input type="text" id="searchInput" class="form-control search-box-custom bg-light border-0" placeholder="Search diagnosis, ICD-10, student ID number, or student..." onkeyup="filterAssessments()">
                </div>

                <!-- Filter by Assessment Type -->
                <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                    <select id="typeFilter" class="form-control custom-select bg-light border-0 text-dark font-weight-semibold" onchange="filterAssessments()">
                        <option value="">All Assessment Types</option>
                        <option value="Annual Physical Exam">Annual Physical Exam</option>
                        <option value="Acute Illness Assessment">Acute Illness Assessment</option>
                        <option value="Sports / PE Clearance">Sports / PE Clearance</option>
                        <option value="Special Care Follow-up">Special Care Follow-up</option>
                    </select>
                </div>

                <!-- Filter by Finding Status -->
                <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                    <select id="statusFilter" class="form-control custom-select bg-light border-0 text-dark font-weight-semibold" onchange="filterAssessments()">
                        <option value="">All Findings Status</option>
                        <option value="Cleared / Normal">Cleared / Normal</option>
                        <option value="Monitored">Monitored / Controlled</option>
                        <option value="Follow-up Required">Follow-up Required</option>
                        <option value="Restricted">Restricted / Medical Excuse</option>
                    </select>
                </div>

                <!-- Filter by Year Level -->
                <div class="col-lg-2 col-md-4 col-6 mb-3 mb-lg-0">
                    <select id="gradeFilter" class="form-control custom-select bg-light border-0 text-dark font-weight-semibold" onchange="filterAssessments()">
                        <option value="">All Year Levels</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
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

    <!-- MAIN CONTENT: ASSESSMENT RECORDS TABLE VIEW -->
    <div id="tableViewContainer" class="card card-assessment mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between bg-white border-0">
            <h6 class="m-0 font-weight-bold text-gray-800">
                <i class="fas fa-clipboard-check text-primary mr-2"></i>Medical Assessment Documentation Roster
            </h6>
            <span class="badge badge-light border text-muted px-3 py-2" id="recordCountBadge">Showing 6 records</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-assessment mb-0" id="assessmentTable">
                    <thead>
                        <tr>
                            <th class="pl-4">Assessment ID / Date</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Course & Year Level</th>
                            <th>Assessment Type</th>
                            <th>Diagnostic Impression (ICD-10)</th>
                            <th>Clinical Findings Status</th>
                            <th>Examining Practitioner</th>
                            <th class="text-center pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="assessmentTableBody">
                        <!-- Injected via JS -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 d-flex align-items-center justify-content-between">
            <div class="text-xs text-muted font-weight-semibold">
                Showing <span id="showingCount">1 to 6</span> of <span id="totalCount">1,180</span> medical assessment entries
            </div>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" style="background-color: var(--maroon-primary); border-color: var(--maroon-primary);" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>

    <!-- ALTERNATIVE CONTENT: GRID CARDS VIEW -->
    <div id="gridViewContainer" class="row d-none" id="assessmentGridBody">
        <!-- Injected via JS -->
    </div>

</div>

<div class="modal fade" id="viewAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Profile Banner Header -->
            <div class="assessment-banner d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img id="aViewAvatar" src="img/undraw_profile.svg" alt="Student Photo" class="avatar-circle-lg mr-3 bg-white">
                    <div>
                        <h4 id="aViewFullName" class="font-weight-bold mb-1 text-white">Maria Clara Santos</h4>
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <span class="badge badge-light text-dark font-weight-bold mr-2" id="aViewID"><i class="fas fa-clipboard-list mr-1"></i>Assessment: #MA-2026-114</span>
                            <span class="badge badge-light mr-2" id="aViewStrand">BS Information System | 4th Year</span>
                            <span class="badge badge-find-monitored" id="aViewStatusBadge">Monitored</span>
                        </div>
                    </div>
                </div>
                <button class="close text-white opacity-75" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Navigation Tabs -->
            <div class="bg-light px-4 pt-3 border-bottom">
                <ul class="nav nav-pills nav-pills-custom" id="astTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="soap-s-tab" data-toggle="tab" href="#soapSTab" role="tab"><span class="soap-badge soap-s">S</span> Subjective History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="soap-o-tab" data-toggle="tab" href="#soapOTab" role="tab"><span class="soap-badge soap-o">O</span> Objective Exam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="soap-a-tab" data-toggle="tab" href="#soapATab" role="tab"><span class="soap-badge soap-a">A</span> Assessment & Dx</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="soap-p-tab" data-toggle="tab" href="#soapPTab" role="tab"><span class="soap-badge soap-p">P</span> Plan & Treatment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="clearance-tab" data-toggle="tab" href="#clearanceTab" role="tab"><i class="fas fa-certificate mr-1"></i> Medical Clearance</a>
                    </li>
                </ul>
            </div>

            <div class="modal-body p-4">
                <div class="tab-content" id="astTabsContent">

                    <!-- TAB 1: SUBJECTIVE (S) -->
                    <div class="tab-pane fade show active" id="soapSTab" role="tabpanel">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="ast-label">Chief Complaint & Reason for Assessment</div>
                                <div class="ast-value font-weight-bold text-dark h6" id="aComplaint">Shortness of breath, audible wheezing, and chest tightness following PE aerobic workout.</div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="ast-label">History of Present Illness (HPI)</div>
                                <p class="small text-muted bg-light p-3 rounded" id="aHPI">
                                    Patient is a 17-year-old female with known history of Bronchial Asthma who developed sudden dyspnea and cough 15 minutes after high-intensity interval running. Patient forgot pre-exercise Salbutamol inhaler dose. No fever, no chest pain radiating to back.
                                </p>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Reported Symptoms</div>
                                <div class="ast-value text-dark" id="aSymptoms">Dyspnea, chest tightness, non-productive cough</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Known Allergies / Triggers</div>
                                <div class="ast-value text-danger" id="aAllergies">Dust Mites, Cold Air, Strenuous Aerobic Exercise</div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: OBJECTIVE (O) -->
                    <div class="tab-pane fade" id="soapOTab" role="tabpanel">
                        <div class="row text-center mb-3">
                            <div class="col-md-3 col-6 mb-2">
                                <div class="card bg-light border-0 py-2">
                                    <div class="ast-label">Temp</div>
                                    <div class="font-weight-bold text-primary" id="aTemp">37.2 °C</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <div class="card bg-light border-0 py-2">
                                    <div class="ast-label">Blood Pressure</div>
                                    <div class="font-weight-bold text-dark" id="aBP">120/80 mmHg</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <div class="card bg-light border-0 py-2">
                                    <div class="ast-label">Pulse</div>
                                    <div class="font-weight-bold text-danger" id="aPulse">105 bpm</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <div class="card bg-light border-0 py-2">
                                    <div class="ast-label">SpO2 Oxygen</div>
                                    <div class="font-weight-bold text-warning" id="aSpO2">94% &rarr; 98%</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="ast-label">Systematic Physical Examination Findings</div>
                                <div class="bg-light p-3 rounded small text-dark" id="aPhysicalExam">
                                    <strong>HEENT:</strong> Anicteric sclerae, pink palpebral conjunctivae. Supple neck, no lymphadenopathy.<br>
                                    <strong>Chest / Lungs:</strong> Bilateral diffuse expiratory wheezes on auscultation prior to nebulizer. Symmetrical chest expansion.<br>
                                    <strong>Cardiovascular:</strong> Tachycardia, regular rhythm, normal S1/S2, no murmurs.<br>
                                    <strong>Abdomen:</strong> Soft, non-tender, no organomegaly.<br>
                                    <strong>Extremities:</strong> Warm extremities, brisk capillary refill (&lt;2s), no peripheral cyanosis or clubbing.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: ASSESSMENT (A) -->
                    <div class="tab-pane fade" id="soapATab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8 col-12 mb-3">
                                <div class="ast-label">Primary Diagnostic Impression</div>
                                <div class="ast-value font-weight-bold text-danger h5" id="aDiagnosis">Exercise-Induced Bronchospasm in Known Bronchial Asthma</div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <div class="ast-label">ICD-10 Clinical Diagnostic Code</div>
                                <div class="ast-value text-dark font-weight-bold" id="aICD10"><span class="badge badge-dark px-3 py-2">ICD-10: J45.901</span></div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Severity & Clinical Staging</div>
                                <div class="ast-value text-warning" id="aSeverity">Moderate Acute Exacerbation (Resolved Post-Nebulizer)</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Clinical Risk Staging</div>
                                <div class="ast-value text-primary" id="aRiskStage">Controlled Chronic Respiratory Risk</div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: PLAN (P) -->
                    <div class="tab-pane fade" id="soapPTab" role="tabpanel">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="ast-label">Pharmacological & Treatment Orders</div>
                                <div class="bg-light p-3 rounded small text-dark font-weight-bold" id="aOrders">
                                    1. Nebulized Salbutamol 2.5mg in 2.5ml sterile normal saline over 10 minutes (Completed in Clinic).<br>
                                    2. Continue daily maintenance Fluticasone 125mcg inhaler 1 puff BID.<br>
                                    3. Re-screen vital signs 30 minutes post-treatment.
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="ast-label">Patient Education & Preventative Advice</div>
                                <p class="small text-muted mb-0" id="aPatientEdu">
                                    Advised student on mandatory 15-minute warm-up before any PE class and pre-medication with 2 puffs of Salbutamol 15 minutes before aerobic running.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: MEDICAL CLEARANCE -->
                    <div class="tab-pane fade" id="clearanceTab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="ast-label">PE / Sports Clearance Certification</div>
                                <div class="ast-value" id="aClearanceStatus"><span class="badge badge-success px-3 py-2">Cleared with Warm-up Protocol</span></div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Clearance Renewal Schedule</div>
                                <div class="ast-value text-dark" id="aRenewal">Annual Evaluation (June 2027)</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Examining Medical Officer</div>
                                <div class="ast-value font-weight-bold text-dark" id="aPhysician">Dr. Fernando Bautista, MD (Lic. #098124)</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="ast-label">Clinical Facility</div>
                                <div class="ast-value" id="aFacility">SHS Health Services Clinic</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-light">
                <button class="btn btn-outline-primary btn-sm" onclick="printIndividualAssessment()"><i class="fas fa-print mr-1"></i> Print Clinical SOAP Form</button>
                <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="addAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: var(--maroon-primary);">
                <h5 class="modal-title font-weight-bold" id="addAssessmentModalLabel"><i class="fas fa-plus-circle mr-2"></i>New Medical Assessment Documentation</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addAssessmentForm" onsubmit="saveNewAssessment(event)">
                <div class="modal-body p-4">

                    <!-- Section 1: Patient Information & Assessment Type -->
                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-user-check mr-1"></i> 1. Patient Identification & Assessment Category</h6>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="small font-weight-bold">Student ID / Number *</label>
                            <input type="text" class="form-control form-control-sm" required placeholder="e.g. 21S0011">
                        </div>
                        <div class="form-group col-md-5">
                            <label class="small font-weight-bold">Student Full Name *</label>
                            <input type="text" class="form-control form-control-sm" required placeholder="e.g. Maria Clara Santos">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="small font-weight-bold">Course & Year Level *</label>
                            <select class="form-control form-control-sm" required>
                                <option value="4th Year - BS Information System">4th Year - BS Information System</option>
                                <option value="3rd Year - BS Tourism Management">3rd Year - BS Tourism Management</option>
                                <option value="2nd Year - BS Education">2nd Year - BS Education</option>
                                <option value="1st Year - BS Political Science">1st Year - BS Political Science</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold">Assessment Type *</label>
                            <select class="form-control form-control-sm" required>
                                <option value="Annual Physical Exam">Annual Physical Exam</option>
                                <option value="Acute Illness Assessment">Acute Illness Assessment</option>
                                <option value="Sports / PE Clearance">Sports / PE Clearance Exam</option>
                                <option value="Special Care Follow-up">Special Care Follow-up</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold">Clinical Findings Status *</label>
                            <select class="form-control form-control-sm" required>
                                <option value="Cleared / Normal">Cleared / Normal Findings</option>
                                <option value="Monitored">Monitored / Controlled</option>
                                <option value="Follow-up Required">Follow-up Required</option>
                                <option value="Restricted">Restricted / Medical Excuse</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Section 2: Clinical SOAP Note Fields -->
                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-stethoscope mr-1"></i> 2. Clinical SOAP Summary</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold">Diagnostic Impression (ICD-10) *</label>
                            <input type="text" class="form-control form-control-sm" required placeholder="e.g. Bronchial Asthma (J45.9), Type 1 Diabetes (E10.9)">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold">Examining Health Practitioner *</label>
                            <input type="text" class="form-control form-control-sm" required placeholder="e.g. Dr. Fernando Bautista, MD / Nurse Officer">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small font-weight-bold">Treatment Plan & Medical Advice *</label>
                        <textarea class="form-control form-control-sm" rows="2" required placeholder="Enter pharmacological orders, PE advice, and recommendations..."></textarea>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: var(--maroon-primary);" type="submit">
                        <i class="fas fa-save mr-1"></i> Save Medical Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<div id="toastNotification" class="toast toast-notification bg-success text-white p-3 rounded shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle fa-2x mr-3"></i>
        <div>
            <strong class="d-block" id="toastTitle">Success!</strong>
            <span class="small" id="toastMessage">Medical assessment documentation saved successfully.</span>
        </div>
    </div>
</div>

<script>
    function loadAssessmentDatasetFromStorage() {
        let records = [];
        try {
            if (window.SmartClinicDB && typeof SmartClinicDB.getAssessments === 'function') {
                const data = SmartClinicDB.getAssessments();
                if (Array.isArray(data) && data.length > 0) {
                    records = data;
                }
            }
            if (records.length === 0) {
                const stored = localStorage.getItem('shsms_assessment_records');
                if (stored) {
                    const parsed = JSON.parse(stored);
                    if (Array.isArray(parsed) && parsed.length > 0) records = parsed;
                }
            }
        } catch (e) {
            console.warn('Storage read error for assessments:', e);
        }

        if (!records || records.length === 0) {
            records = JSON.parse(JSON.stringify(seedAssessmentDataset));
        } else {
            // Ensure seed records exist if not deleted
            seedAssessmentDataset.forEach(seed => {
                if (!records.some(r => r.lrn === seed.lrn || r.assessId === seed.assessId)) {
                    records.push(seed);
                }
            });
        }

        try {
            localStorage.setItem('shsms_assessment_records', JSON.stringify(records));
        } catch (e) {}
        return records;
    }

    function saveAssessmentDatasetToStorage(data) {
        try {
            localStorage.setItem('shsms_assessment_records', JSON.stringify(data));
            if (window.SmartClinicDB && SmartClinicDB.broadcastUpdate) {
                SmartClinicDB.broadcastUpdate('assessment_updated');
            }
        } catch (e) {}
    }

    // Mock Medical Assessment Dataset Seed
    const seedAssessmentDataset = [{
            id: 1,
            assessId: "#MA-2026-001",
            date: "Oct 08, 2026",
            lrn: "22B0023",
            fullName: "Rex Mark Ricafranca",
            avatar: "img/undraw_profile_2.svg",
            grade: "3rd Year",
            strand: "BS Political Science",
            sex: "Male",
            age: 20,
            assessType: "Walk-in Consultation",
            diagnosis: "Tension-type Headache & Pre-Hypertension (G44.2)",
            icd10: "ICD-10: G44.2",
            complaint: "Frontal throbbing headache and slight fatigue after review",
            hpi: "20-year-old male presenting with occipital-frontal ache after 4 hours continuous study.",
            symptoms: "Headache, mild dizziness, eye strain",
            allergies: "None reported",
            temp: "36.7 Â°C",
            bp: "130/85 mmHg",
            pulse: "82 bpm",
            spO2: "98%",
            findings: "Alert, fully oriented. Normal S1/S2 heart sounds. No neurological deficits.",
            orders: "1. Paracetamol 500mg tab PO STAT.\n2. Rest in Clinic Bay 1 for 30 minutes.\n3. Lifestyle advice for BP monitoring.",
            patientEdu: "Take periodic screen breaks and maintain adequate hydration.",
            status: "Completed",
            clearanceStatus: "Fit for All Activities",
            renewal: "Annual Physical (August 2027)",
            physician: "Dr. Maria Santos, MD (Lic. #098124)"
        },
        {
            id: 2,
            assessId: "#MA-2026-002",
            date: "Oct 08, 2026",
            lrn: "21S0011",
            fullName: "Mica Santos",
            avatar: "img/undraw_profile_1.svg",
            grade: "4th Year",
            strand: "BS Information System",
            sex: "Female",
            age: 21,
            assessType: "Allergy / Respiratory Assessment",
            diagnosis: "Allergic Rhinitis & Bronchial Asthma (J30.9)",
            icd10: "ICD-10: J30.9",
            complaint: "Sneezing, itchy eyes, and mild allergic rhinitis from dust",
            hpi: "21-year-old female with known bronchial asthma presenting with allergic rhinitis symptoms.",
            symptoms: "Paroxysmal sneezing, watery eyes, clear rhinorrhea",
            allergies: "Dust Mites, Pollen",
            temp: "36.6 Â°C",
            bp: "110/70 mmHg",
            pulse: "74 bpm",
            spO2: "99%",
            findings: "Clear bilateral breath sounds without wheezing. S1/S2 normal.",
            orders: "1. Cetirizine HCl 10mg tab PO once daily.\n2. Continue Fluticasone inhaler twice daily.",
            patientEdu: "Keep computer laboratories well ventilated. Carry Salbutamol rescue inhaler.",
            status: "Monitored",
            clearanceStatus: "Fit with Warm-up Protocol",
            renewal: "Annual Review (June 2027)",
            physician: "Dr. Fernando Bautista, MD (Lic. #098125)"
        }
    ];

    let assessmentDataset = loadAssessmentDatasetFromStorage();

    // Helpers
    function getFindingBadgeClass(status) {
        if (status.includes('Cleared') || status.includes('Normal')) return 'badge-find-cleared';
        if (status.includes('Monitored')) return 'badge-find-monitored';
        if (status.includes('Follow-up')) return 'badge-find-followup';
        return 'badge-find-restricted';
    }

    // Render Table View
    function renderAssessmentTable(data) {
        const tbody = document.getElementById('assessmentTableBody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="fas fa-file-medical fa-3x mb-3 text-gray-300"></i>
                            <p class="mb-0 font-weight-bold">No medical assessment records found matching your filters.</p>
                            <span class="small">Try adjusting search keywords or resetting dropdown filters.</span>
                        </td>
                    </tr>`;
            return;
        }

        data.forEach(a => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                    <td class="pl-4">
                        <span class="assess-pill">${a.assessId}</span>
                        <div class="text-xs text-muted mt-1"><i class="fas fa-calendar-day mr-1"></i>${a.date}</div>
                    </td>
                    <td class="font-weight-bold text-dark">${a.lrn}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${a.avatar}" alt="Avatar" class="avatar-circle mr-2">
                            <div>
                                <div class="font-weight-bold text-dark">${a.fullName}</div>
                                <div class="text-xs text-muted">${a.sex}, ${a.age} yrs</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="font-weight-bold text-dark">${a.grade}</span>
                        <div class="text-xs text-muted">${a.strand}</div>
                    </td>
                    <td>
                        <span class="badge badge-light border text-dark font-weight-bold">${a.assessType}</span>
                    </td>
                    <td>
                        <div class="font-weight-bold text-danger">${a.diagnosis}</div>
                        <div class="text-xs text-muted font-weight-bold">${a.icd10}</div>
                    </td>
                    <td>
                        <span class="${getFindingBadgeClass(a.status)}">${a.status}</span>
                    </td>
                    <td>
                        <div class="text-xs font-weight-bold text-dark"><i class="fas fa-user-md text-primary mr-1"></i>${a.physician}</div>
                    </td>
                    <td class="text-center pr-4">
                        <button class="btn btn-sm btn-circle btn-primary" onclick="viewAssessmentDetails(${a.id})" title="View Complete SOAP Note">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-circle btn-info" onclick="printAssessmentForm(${a.id})" title="Print Clinical Assessment">
                            <i class="fas fa-print"></i>
                        </button>
                    </td>
                `;
            tbody.appendChild(tr);
        });

        document.getElementById('recordCountBadge').innerText = `Showing ${data.length} records`;
        document.getElementById('showingCount').innerText = data.length > 0 ? `1 to ${data.length}` : '0';
    }

    // Render Grid View Cards
    function renderAssessmentGrid(data) {
        const gridContainer = document.getElementById('gridViewContainer');
        gridContainer.innerHTML = '';

        if (data.length === 0) {
            gridContainer.innerHTML = `<div class="col-12 text-center py-5 text-muted"><p class="font-weight-bold">No assessment records found.</p></div>`;
            return;
        }

        data.forEach(a => {
            const col = document.createElement('div');
            col.className = 'col-xl-4 col-md-6 mb-4';
            col.innerHTML = `
                    <div class="card ast-grid-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="assess-pill">${a.assessId}</span>
                                <span class="${getFindingBadgeClass(a.status)}">${a.status}</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="${a.avatar}" alt="Photo" class="avatar-circle-lg mr-3">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">${a.fullName}</h6>
                                    <div class="text-xs text-muted mb-1">LRN: ${a.lrn} | ${a.grade} - ${a.strand}</div>
                                    <span class="badge badge-light border text-dark font-weight-bold">${a.assessType}</span>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="mb-2">
                                <span class="text-xs text-muted d-block">Diagnostic Impression:</span>
                                <strong class="text-danger font-weight-bold">${a.diagnosis}</strong>
                                <div class="text-xs text-muted mt-1 font-weight-bold">${a.icd10}</div>
                            </div>
                            <div class="row text-xs mb-3">
                                <div class="col-12 mb-1">
                                    <span class="text-muted">Clearance Status:</span>
                                    <strong class="text-success d-block"><i class="fas fa-certificate mr-1"></i>${a.clearanceStatus}</strong>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted">Examining Physician:</span>
                                    <strong class="text-dark d-block">${a.physician}</strong>
                                </div>
                            </div>
                            <button class="btn btn-block btn-sm text-white font-weight-bold" style="background-color: var(--maroon-primary);" onclick="viewAssessmentDetails(${a.id})">
                                <i class="fas fa-clipboard-list mr-1"></i> View Clinical SOAP Note
                            </button>
                        </div>
                    </div>`;
            gridContainer.appendChild(col);
        });
    }

    // Live Search & Filter Action
    function filterAssessments() {
        const query = document.getElementById('searchInput').value.toLowerCase().trim();
        const type = document.getElementById('typeFilter').value;
        const status = document.getElementById('statusFilter').value;
        const grade = document.getElementById('gradeFilter').value;

        const filtered = assessmentDataset.filter(a => {
            const matchesQuery = !query ||
                a.fullName.toLowerCase().includes(query) ||
                a.lrn.includes(query) ||
                a.diagnosis.toLowerCase().includes(query) ||
                a.icd10.toLowerCase().includes(query) ||
                a.assessId.toLowerCase().includes(query) ||
                a.physician.toLowerCase().includes(query);

            const matchesType = !type || a.assessType === type;
            const matchesStatus = !status || a.status === status;
            const matchesGrade = !grade || a.grade === grade;

            return matchesQuery && matchesType && matchesStatus && matchesGrade;
        });

        renderAssessmentTable(filtered);
        renderAssessmentGrid(filtered);
    }

    // Search bridge
    function globalSearch(val) {
        document.getElementById('searchInput').value = val;
        filterAssessments();
    }

    // View Switcher (Table vs Grid)
    function switchView(type) {
        const tableCont = document.getElementById('tableViewContainer');
        const gridCont = document.getElementById('gridViewContainer');
        const btnTable = document.getElementById('btnTableView');
        const btnGrid = document.getElementById('btnGridView');

        if (type === 'table') {
            tableCont.classList.remove('d-none');
            gridCont.classList.add('d-none');
            btnTable.classList.add('active');
            btnGrid.classList.remove('active');
        } else {
            tableCont.classList.add('d-none');
            gridCont.classList.remove('d-none');
            btnGrid.classList.add('active');
            btnTable.classList.remove('active');
        }
    }

    // View Assessment Details Modal
    function viewAssessmentDetails(id) {
        const ast = assessmentDataset.find(a => a.id === id);
        if (!ast) return;

        // Header Banner
        document.getElementById('aViewAvatar').src = ast.avatar;
        document.getElementById('aViewFullName').innerText = ast.fullName;
        document.getElementById('aViewID').innerHTML = `<i class="fas fa-clipboard-list mr-1"></i>Assessment: ${ast.assessId}`;
        document.getElementById('aViewStrand').innerText = `${ast.strand} | ${ast.grade}`;

        const stBadge = document.getElementById('aViewStatusBadge');
        stBadge.innerText = ast.status;
        stBadge.className = getFindingBadgeClass(ast.status);

        // Tab 1: Subjective
        document.getElementById('aComplaint').innerText = ast.complaint;
        document.getElementById('aHPI').innerText = ast.hpi;
        document.getElementById('aSymptoms').innerText = ast.symptoms;
        document.getElementById('aAllergies').innerText = ast.allergies;

        // Tab 2: Objective
        document.getElementById('aTemp').innerText = ast.temp;
        document.getElementById('aBP').innerText = ast.bp;
        document.getElementById('aPulse').innerText = ast.pulse;
        document.getElementById('aSpO2').innerText = ast.spO2;
        document.getElementById('aPhysicalExam').innerHTML = ast.findings;

        // Tab 3: Assessment
        document.getElementById('aDiagnosis').innerText = ast.diagnosis;
        document.getElementById('aICD10').innerHTML = `<span class="badge badge-dark px-3 py-2">${ast.icd10}</span>`;
        document.getElementById('aSeverity').innerText = `${ast.status} - Controlled Clinical Risk`;
        document.getElementById('aRiskStage').innerText = ast.assessType;

        // Tab 4: Plan
        document.getElementById('aOrders').innerText = ast.orders;
        document.getElementById('aPatientEdu').innerText = ast.patientEdu;

        // Tab 5: Clearance
        document.getElementById('aClearanceStatus').innerHTML = `<span class="badge badge-success px-3 py-2">${ast.clearanceStatus}</span>`;
        document.getElementById('aRenewal').innerText = ast.renewal;
        document.getElementById('aPhysician').innerText = ast.physician;

        // Show Modal
        $('#viewAssessmentModal').modal('show');
    }

    // Print Form Trigger
    function printAssessmentForm(id) {
        viewAssessmentDetails(id);
    }

    // Save New Assessment Handler
    function saveNewAssessment(e) {
        e.preventDefault();
        const inputs = e.target.querySelectorAll('input, select, textarea');

        const lrn = inputs[0].value;
        const fullName = inputs[1].value;
        const gradeStrand = inputs[2].value.split(' - ');
        const assessType = inputs[3].value;
        const status = inputs[4].value;
        const diagnosis = inputs[5].value;
        const physician = inputs[6].value;
        const orders = inputs[7].value;

        const newAssessNum = `#MA-2026-1${15 + assessmentDataset.length - 6}`;
        const todayStr = "Oct 01, 2026";

        const newAssessment = {
            id: assessmentDataset.length + 1,
            assessId: newAssessNum,
            date: todayStr,
            lrn: lrn,
            fullName: fullName,
            avatar: 'img/undraw_profile_3.svg',
            grade: gradeStrand[0],
            strand: gradeStrand[1] || 'STEM',
            sex: 'Female',
            age: 17,
            assessType: assessType,
            diagnosis: diagnosis,
            icd10: "ICD-10: R69",
            complaint: "Medical evaluation for " + assessType,
            hpi: "Patient evaluated at school health clinic for " + assessType,
            symptoms: "Clinical evaluation documented",
            allergies: "Standard screening performed",
            temp: "36.8 °C",
            bp: "120/80 mmHg",
            pulse: "78 bpm",
            spO2: "99%",
            findings: "Physical examination documented by examining officer.",
            orders: orders,
            patientEdu: "Follow clinical orders and maintain hydration.",
            status: status,
            clearanceStatus: "Fit for School Activities",
            renewal: "Annual Review",
            physician: physician
        };

        assessmentDataset.unshift(newAssessment);
        saveAssessmentDatasetToStorage(assessmentDataset);
        filterAssessments();
        document.getElementById('statTotalAssessments').innerText = (1180 + assessmentDataset.length - 6).toLocaleString();

        $('#addAssessmentModal').modal('hide');
        e.target.reset();

        showToast('Assessment Saved!', `Medical assessment file ${newAssessment.assessId} for ${newAssessment.fullName} saved successfully.`);
    }

    // Toast display
    function showToast(title, msg) {
        document.getElementById('toastTitle').innerText = title;
        document.getElementById('toastMessage').innerText = msg;
        $('#toastNotification').fadeIn().delay(3500).fadeOut();
    }

    // Export & Print actions
    function exportAssessmentData() {
        showToast('Export Started', 'Exporting medical assessment roster (CSV format)...');
    }

    function printAssessmentSummary() {
        window.print();
    }

    function printIndividualAssessment() {
        window.print();
    }

    function reloadAssessments() {
        assessmentDataset = loadAssessmentDatasetFromStorage();
        filterAssessments();
        if (document.getElementById('statTotalAssessments')) {
            document.getElementById('statTotalAssessments').innerText = (1180 + assessmentDataset.length - 6).toLocaleString();
        }
    }

    window.addEventListener('storage', function(e) {
        if (['shsms_assessment_records', 'shsms_students', 'shsms_registered_patients'].includes(e.key)) {
            reloadAssessments();
        }
    });
    window.addEventListener('smart-clinic-updated', function() {
        reloadAssessments();
    });

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        reloadAssessments();

        // Check URL parameters for direct patient assessment view (e.g. redirected from registration form)
        const urlParams = new URLSearchParams(window.location.search);
        const lrnParam = urlParams.get('lrn') || urlParams.get('studentId') || urlParams.get('id');
        const assessIdParam = urlParams.get('assessId');
        const isNewParam = urlParams.get('new');

        if (lrnParam || assessIdParam) {
            const target = assessmentDataset.find(a =>
                (lrnParam && (String(a.lrn).toLowerCase() === lrnParam.toLowerCase() || String(a.studentId).toLowerCase() === lrnParam.toLowerCase() || String(a.id) === lrnParam)) ||
                (assessIdParam && String(a.assessId).toLowerCase() === assessIdParam.toLowerCase())
            );
            if (target) {
                // Pre-fill search filter to isolate the record
                if (document.getElementById('searchInput')) {
                    document.getElementById('searchInput').value = target.lrn || target.fullName;
                    filterAssessments();
                }

                if (isNewParam) {
                    showToast('Patient Assessment Loaded', `Successfully loaded newly registered patient assessment for ${target.fullName} (${target.lrn || target.assessId}).`);
                }

                setTimeout(() => {
                    viewAssessmentDetails(target.id);
                }, 400);
                s
            }
        }
    });
</script>