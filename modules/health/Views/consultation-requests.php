<div class="container-fluid">

    <!-- Page Heading & Quick Actions -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Online Consultation Requests</h1>
            <p class="text-muted small mb-0">Manage telehealth booking requests, triage virtual queues, launch video teleconsultations & issue digital prescriptions.</p>
        </div>
        <div class="d-flex mt-3 mt-sm-0">
            <button class="btn btn-sm btn-outline-secondary shadow-sm mr-2" onclick="exportTelehealthData()">
                <i class="fas fa-download fa-sm text-gray-600 mr-1"></i> Export Telehealth Log
            </button>
            <button class="btn btn-sm text-white shadow-sm font-weight-bold" style="background-color: #800020;" data-toggle="modal" data-target="#requestConsultationModal">
                <i class="fas fa-plus-circle fa-sm text-white-50 mr-1"></i> Online Appointment
            </button>
        </div>
    </div>

    <!-- KPI Metric Summary Row (4 Cards) -->
    <div class="row mb-4">

        <!-- Pending Review Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-telehealth border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Review & Triage
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statPendingRequests">18 Requests</div>
                            <div class="mt-1 small text-muted">
                                <i class="fas fa-clock text-warning mr-1"></i> Avg queue time: <strong>14 mins</strong>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(246, 194, 62, 0.15);">
                                <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmed / Scheduled Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-telehealth border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Confirmed / Scheduled
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statConfirmedRequests">34 Sessions</div>
                            <div class="mt-1 small text-success font-weight-bold">
                                <i class="fas fa-video mr-1"></i> 8 Scheduled for today
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(78, 115, 223, 0.15);">
                                <i class="fas fa-calendar-check fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Consultations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-telehealth border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Today
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statCompletedRequests">12 Sessions</div>
                            <div class="mt-1 small text-muted">
                                <i class="fas fa-check-circle text-success mr-1"></i> 100% digital Rx released
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(28, 200, 138, 0.15);">
                                <i class="fas fa-laptop-medical fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- In-Clinic Escalations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-telehealth border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Urgent In-Clinic Referrals
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statEscalatedRequests">3 Referrals</div>
                            <div class="mt-1 small text-danger font-weight-bold">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Physical clinic triage required
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(231, 74, 59, 0.15);">
                                <i class="fas fa-ambulance fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Telehealth Management Hub Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fas fa-headset text-maroon mr-2 fa-lg" style="color: #800020;"></i>
                <h6 class="m-0 font-weight-bold text-gray-800">Telehealth Queue & Online Consultation Records</h6>
            </div>

            <!-- View Toggle & Quick Action -->
            <div class="d-flex align-items-center mt-2 mt-sm-0">
                <div class="btn-group btn-group-sm mr-2" role="group">
                    <button type="button" class="btn btn-outline-secondary active" id="btnTableView" onclick="switchView('table')">
                        <i class="fas fa-list mr-1"></i> Table View
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="btnGridView" onclick="switchView('grid')">
                        <i class="fas fa-th-large mr-1"></i> Card Grid
                    </button>
                </div>
                <button class="btn btn-sm btn-outline-primary" onclick="printTelehealthSchedule()">
                    <i class="fas fa-print mr-1"></i> Print Schedule
                </button>
            </div>
        </div>

        <div class="card-body">

            <!-- Multi-Filter & Search Toolbar -->
            <div class="row mb-3 align-items-center">

                <!-- Search Input -->
                <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                    <div class="position-relative">
                        <i class="fas fa-search search-icon-pos"></i>
                        <input type="text" id="teleSearchInput" class="form-control form-control-sm search-box-custom" placeholder="Search by Student, Student ID number, Request ID, or Chief Complaint..." onkeyup="filterTelehealth()">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                    <select id="teleStatusFilter" class="form-control form-control-sm" onchange="filterTelehealth()">
                        <option value="ALL">All Statuses</option>
                        <option value="Pending Review">Pending Review</option>
                        <option value="Confirmed">Confirmed / Scheduled</option>
                        <option value="In-Progress">In-Progress (Active)</option>
                        <option value="Completed">Completed</option>
                        <option value="Urgent In-Clinic">Urgent In-Clinic Referral</option>
                    </select>
                </div>

                <!-- Course Filter -->
                <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                    <select id="teleStrandFilter" class="form-control form-control-sm" onchange="filterTelehealth()">
                        <option value="ALL">All Courses</option>
                        <option value="BS Information System">BS Information System</option>
                        <option value="BS Tourism Management">BS Tourism Management</option>
                        <option value="BS Education">BS Education</option>
                        <option value="BS Political Science">BS Political Science</option>
                    </select>
                </div>

                <!-- Category / Specialty Filter -->
                <div class="col-lg-2 col-md-6 col-6 mb-2 mb-lg-0">
                    <select id="teleCategoryFilter" class="form-control form-control-sm" onchange="filterTelehealth()">
                        <option value="ALL">All Categories</option>
                        <option value="General Medical">General Medical</option>
                        <option value="Mental Health & Guidance">Mental Health & Guidance</option>
                        <option value="Dermatology / Skin">Dermatology / Skin</option>
                        <option value="Follow-Up & Rx Refill">Follow-Up & Rx Refill</option>
                        <option value="Nutritional Counseling">Nutritional Counseling</option>
                    </select>
                </div>

                <!-- Urgency Filter -->
                <div class="col-lg-2 col-md-6 col-6 mb-2 mb-lg-0">
                    <select id="teleUrgencyFilter" class="form-control form-control-sm" onchange="filterTelehealth()">
                        <option value="ALL">All Urgency</option>
                        <option value="High">High Urgency</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Routine">Routine</option>
                    </select>
                </div>

            </div>

            <!-- Filter Result Counter & Active Tags -->
            <div class="d-flex align-items-center justify-content-between mb-3 pt-2 border-top">
                <div class="small text-muted">
                    Showing <span id="recordCount" class="font-weight-bold text-dark">8</span> consultation requests matching criteria
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge badge-light border mr-1 text-muted"><i class="fas fa-filter mr-1"></i> Smart Triage Active</span>
                    <button class="btn btn-link btn-sm text-secondary p-0 ml-2" onclick="resetFilters()">Reset</button>
                </div>
            </div>

            <!-- Table View -->
            <div id="tableViewContainer" class="table-responsive">
                <table class="table table-hover table-telehealth align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Request ID & Date</th>
                            <th>Student Patient</th>
                            <th>Specialty / Category</th>
                            <th>Chief Complaint & Symptoms</th>
                            <th>Platform & Room</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="telehealthTableBody">
                        <!-- Rendered via JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Card Grid View (Hidden by default) -->
            <div id="gridViewContainer" class="row" style="display: none;">
                <!-- Rendered via JavaScript -->
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="consultationDetailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center">
                    <div class="mr-3 bg-white text-maroon rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fas fa-laptop-medical fa-lg" style="color: #800020;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="detailModalTitle">Telehealth Consultation File</h5>
                        <span class="small text-white-50" id="modalReqIdDisplay">#TELE-2026-001 | Requested on Oct 01, 2026</span>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4 bg-light">

                <!-- Patient & Consultation Quick Header -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-md-auto text-center mb-3 mb-md-0">
                                <img id="mAvatar" src="img/undraw_profile_1.svg" class="rounded-circle border" width="70" height="70" alt="Student Avatar">
                            </div>
                            <div class="col-md">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div>
                                        <h5 class="font-weight-bold text-gray-900 mb-1" id="mStudentName">Maria Clara Santos</h5>
                                        <div class="text-muted small">
                                            <span>Student ID: <strong id="mStudentLrn">21S0011</strong></span> |
                                            <span>Course & Year: <span id="mStudentGradeStrand" class="badge badge-primary">BS Information System - 4th Year</span></span> |
                                            <span>Age/Sex: <strong id="mStudentAgeSex">21 / Female</strong></span>
                                        </div>
                                    </div>
                                    <div class="mt-2 mt-md-0 text-right">
                                        <span id="mStatusBadge" class="badge badge-tele-confirmed">Confirmed</span>
                                        <div class="mt-1">
                                            <span id="mUrgencyBadge" class="badge badge-urgency-high">High Urgency</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5-Tab Navigation -->
                <ul class="nav nav-pills nav-pills-custom mb-3 bg-white p-2 rounded shadow-sm" id="teleDetailTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-overview-link" data-toggle="pill" href="#tab-overview" role="tab">
                            <i class="fas fa-info-circle mr-1"></i> 1. Overview & Virtual Room
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-complaint-link" data-toggle="pill" href="#tab-complaint" role="tab">
                            <i class="fas fa-stethoscope mr-1"></i> 2. Chief Complaint & Symptoms
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-triage-link" data-toggle="pill" href="#tab-triage" role="tab">
                            <i class="fas fa-clipboard-check mr-1"></i> 3. Nurse Triage Assessment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-soap-link" data-toggle="pill" href="#tab-soap" role="tab">
                            <i class="fas fa-user-md mr-1"></i> 4. Telehealth SOAP Notes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-rx-link" data-toggle="pill" href="#tab-rx" role="tab">
                            <i class="fas fa-file-prescription mr-1"></i> 5. Digital Rx & E-Clearance
                        </a>
                    </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content bg-white p-4 rounded shadow-sm" id="teleDetailTabsContent">

                    <!-- Tab 1: Overview & Virtual Room -->
                    <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-video mr-2"></i> Telehealth Session Booking & Access
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="tele-label">Specialty / Category</div>
                                <div class="tele-value" id="mCategory">General Medical</div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Preferred Date & Slot</div>
                                <div class="tele-value" id="mSlot">Oct 01, 2026 - 10:30 AM</div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Assigned Medical Personnel</div>
                                <div class="tele-value" id="mClinician">Dr. Alejandro Gomez, MD</div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Telehealth Platform</div>
                                <div class="tele-value" id="mPlatformDisplay">
                                    <span class="badge badge-platform-google"><i class="fab fa-google mr-1"></i> Google Meet</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Virtual Room Link / ID</div>
                                <div class="tele-value">
                                    <a href="#" id="mMeetingLink" class="text-primary font-weight-bold" target="_blank">
                                        <i class="fas fa-link mr-1"></i> meet.google.com/shs-clinic-001
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Guardian Consent Verification</div>
                                <div class="tele-value text-success" id="mConsentStatus">
                                    <i class="fas fa-check-circle mr-1"></i> Verified (Parent: Elena Ramirez)
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded mt-3 border d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="font-weight-bold text-gray-800 mb-1">Telehealth Ready</h6>
                                <p class="small text-muted mb-0">Audio/video encryption active. Encrypted compliant teleconsultation environment.</p>
                            </div>
                            <button class="btn btn-sm btn-primary font-weight-bold shadow-sm" onclick="launchVideoCallModal()">
                                <i class="fas fa-video mr-1"></i> Launch Virtual Session
                            </button>
                        </div>
                    </div>

                    <!-- Tab 2: Chief Complaint & Symptoms -->
                    <div class="tab-pane fade" id="tab-complaint" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-notes-medical mr-2"></i> Student Self-Reported Symptoms & History
                        </h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="tele-label">Chief Complaint (Student's Statement)</div>
                                <div class="p-3 bg-light rounded border text-dark font-weight-500" id="mComplaintNarrative">
                                    "Severe throbbing headache on the right side of my head since yesterday evening, accompanied by blurry vision and sensitivity to bright lights. Unable to focus during my online research classes."
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="tele-label">Onset Duration</div>
                                <div class="tele-value" id="mOnset">24 - 36 Hours</div>
                            </div>
                            <div class="col-md-3">
                                <div class="tele-label">Self-Reported Pain Score (1-10)</div>
                                <div class="tele-value text-danger" id="mPainScore">
                                    <i class="fas fa-fire mr-1"></i> 7 / 10 (Severe)
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="tele-label">Home Temperature (Self)</div>
                                <div class="tele-value" id="mHomeTemp">37.2 °C (Afebrile)</div>
                            </div>
                            <div class="col-md-3">
                                <div class="tele-label">Attached Symptom Photos/Files</div>
                                <div class="tele-value" id="mAttachedFiles">
                                    <span class="badge badge-secondary"><i class="fas fa-paperclip mr-1"></i> 1 Photo Attached</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Nurse Triage Assessment -->
                    <div class="tab-pane fade" id="tab-triage" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-stethoscope mr-2"></i> Clinic Nurse Triage & Pre-Evaluation
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="tele-label">Triage Officer</div>
                                <div class="tele-value" id="mTriageNurse">Clarissa D., RN</div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Triage Acuity Category</div>
                                <div class="tele-value" id="mTriageCategory">Category 3 - Urgent Online Consult</div>
                            </div>
                            <div class="col-md-4">
                                <div class="tele-label">Known Chronic Condition / Allergy</div>
                                <div class="tele-value text-danger" id="mKnownAllergy">Known History of Migraines / No Drug Allergies</div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="tele-label">Triage Nurse Evaluation Notes</div>
                                <div class="p-3 bg-light rounded border text-dark" id="mTriageNotes">
                                    Patient exhibits classic unilateral migraine presentation with photophobia. No loss of consciousness, motor deficits, or neck stiffness noted during intake chat. Cleared for online physician consultation.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Telehealth SOAP Notes -->
                    <div class="tab-pane fade" id="tab-soap" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-user-md mr-2"></i> Attending Clinician SOAP Documentation
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-left-info shadow-sm">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-info"><i class="fas fa-comment-medical mr-1"></i> Subjective (S)</h6>
                                        <p class="small text-dark mb-0" id="mSoapSubjective">Student reports recurrent pulsatile hemicranial headache aggravated by screen time. Nausea without vomiting. Last pain relief attempt with Paracetamol 500mg provided minimal relief.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-left-primary shadow-sm">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-primary"><i class="fas fa-eye mr-1"></i> Objective (O) - Virtual Exam</h6>
                                        <p class="small text-dark mb-0" id="mSoapObjective">Alert, coherent, mild photophobia observed on video camera. Speech fluent and clear. Eye movements intact. No facial asymmetry.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-left-warning shadow-sm">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-warning"><i class="fas fa-diagnoses mr-1"></i> Assessment (A)</h6>
                                        <p class="small text-dark mb-0" id="mSoapAssessment"><strong>Acute Migraine Headache without Aura (ICD-10: G43.0)</strong> precipitated by prolonged visual strain and dehydration.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-left-success shadow-sm">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-success"><i class="fas fa-clipboard-check mr-1"></i> Plan & Recommendations (P)</h6>
                                        <p class="small text-dark mb-0" id="mSoapPlan">Prescribed Mefenamic Acid 500mg TID PRN PC for 2 days. Instructed dark-room rest, hydration (>2.5L/day), screen time limitation. Clinic follow-up if symptoms persist beyond 48 hours.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5: Digital Rx & E-Clearance -->
                    <div class="tab-pane fade" id="tab-rx" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-prescription-bottle-alt mr-2"></i> Issued Electronic Prescription & Medical Excuse Slip
                        </h6>
                        <div class="border p-4 rounded bg-white" style="border: 2px dashed #4e73df !important;">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="img/logo.png" width="40" height="40" class="mr-2" alt="Logo">
                                    <div>
                                        <h6 class="font-weight-bold text-gray-900 mb-0">SHSMS TELEHEALTH DIGITAL PRESCRIPTION</h6>
                                        <span class="small text-muted">Authorized Senior High School Clinic E-Health Unit</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-success px-3 py-2"><i class="fas fa-shield-alt mr-1"></i> Digitally Signed</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <small class="text-muted text-uppercase">Patient Name:</small>
                                    <div class="font-weight-bold text-dark" id="mRxPatient">Maria Clara Santos (BS Information System - 4th Year)</div>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted text-uppercase">Rx Slip No:</small>
                                    <div class="font-weight-bold text-dark" id="mRxSlipId">#E-RX-2026-081</div>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted text-uppercase">Date Issued:</small>
                                    <div class="font-weight-bold text-dark" id="mRxDate">Oct 01, 2026</div>
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded mb-3">
                                <h6 class="font-weight-bold text-primary mb-2"><i class="fas fa-pills mr-1"></i> Rx Details:</h6>
                                <ul class="mb-0 small text-dark pl-3" id="mRxItemsList">
                                    <li><strong>Mefenamic Acid 500mg Tablet</strong> - Take 1 tablet every 8 hours after meals as needed for severe headache (Max 3 days). #6 Tablets</li>
                                    <li><strong>Oral Electrolyte Solution</strong> - Drink 1 sachet dissolved in 500ml water once daily for rehydration.</li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <div class="small text-muted">
                                    <i class="fas fa-qrcode fa-2x mr-2 align-middle text-dark"></i>
                                    <span class="align-middle">Verification Code: <strong>SHS-TELE-VERIF-9821</strong></span>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary mr-2" onclick="printPrescriptionSlip()">
                                        <i class="fas fa-print mr-1"></i> Print E-Rx
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="downloadExcuseSlip()">
                                        <i class="fas fa-file-pdf mr-1"></i> Download Excuse Slip
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-sm font-weight-bold" id="btnApproveModal" onclick="approveCurrentRequest()">
                    <i class="fas fa-check mr-1"></i> Confirm & Send Meeting Link
                </button>
                <button type="button" class="btn btn-danger btn-sm font-weight-bold" id="btnEscalateModal" onclick="escalateCurrentRequest()">
                    <i class="fas fa-ambulance mr-1"></i> Escalate to Physical Clinic
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="videoCallModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white py-2">
                <div class="d-flex align-items-center">
                    <span class="badge badge-danger mr-2"><i class="fas fa-circle mr-1 fa-xs"></i> LIVE TELEHEALTH</span>
                    <h6 class="modal-title font-weight-bold mb-0" id="videoCallTitle">Virtual Consultation Session</h6>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 bg-dark">
                <div class="video-call-box">
                    <div class="video-avatar-holder">
                        <img id="vPatientAvatar" src="img/undraw_profile_1.svg" class="rounded-circle border border-light p-1 mb-3" width="100" height="100" alt="Patient Video Avatar">
                        <h5 class="font-weight-bold text-white mb-1" id="vPatientName">Maria Clara Santos</h5>
                        <span class="badge badge-info" id="vPatientGrade">BS Information System - 4th Year</span>
                        <div class="mt-2 text-white-50 small">
                            <i class="fas fa-wifi text-success mr-1"></i> Connection: Excellent (HD 1080p Encrypted)
                        </div>
                    </div>

                    <!-- Floating In-Call Controls -->
                    <div class="video-controls-bar">
                        <button class="video-btn video-btn-primary" title="Toggle Microphone" onclick="toggleCallFeature(this, 'Mic')"><i class="fas fa-microphone"></i></button>
                        <button class="video-btn video-btn-primary" title="Toggle Camera" onclick="toggleCallFeature(this, 'Camera')"><i class="fas fa-video"></i></button>
                        <button class="video-btn video-btn-muted" title="Share Screen" onclick="toggleCallFeature(this, 'Screen Share')"><i class="fas fa-desktop"></i></button>
                        <button class="video-btn video-btn-muted" title="Digital Prescription Pad" onclick="openRxInCall()"><i class="fas fa-file-prescription"></i></button>
                        <button class="video-btn video-btn-danger" title="End Session" data-dismiss="modal" onclick="showToast('Session Ended', 'Telehealth consultation ended and saved to student file.')"><i class="fas fa-phone-slash"></i></button>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark text-white-50 py-2 justify-content-between">
                <small><i class="fas fa-shield-alt text-success mr-1"></i> End-to-End HIPAA/Health Data Privacy Compliant</small>
                <small>Elapsed: <strong id="callTimer" class="text-white">04:32</strong></small>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="requestConsultationModal" tabindex="-1" role="dialog" aria-labelledby="reqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form id="formNewConsultation" onsubmit="saveNewConsultation(event)">

                <div class="modal-header text-white" style="background-color: #800020;">
                    <div class="d-flex align-items-center">
                        <div class="mr-3 bg-white text-maroon rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-calendar-plus" style="color: #800020;"></i>
                        </div>
                        <div>
                            <h5 class="modal-title font-weight-bold mb-0">Online Appointment / Telehealth</h5>
                            <span class="small text-white-50">Schedule a virtual consultation with school medical officers</span>
                        </div>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <div class="row">

                        <!-- Student Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Select Student / ID Number <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formStudentSelect" onchange="autoFillStudentDetails(this.value)">
                                <option value="">-- Choose Student --</option>
                                <option value="Rex Mark Ricafranca|22B0023|3rd Year - BS Political Science|Male|20">Rex Mark Ricafranca (22B0023 - BS Political Science 3rd Year)</option>
                                <option value="Mica Santos|21S0011|4th Year - BS Information System|Female|21">Mica Santos (21S0011 - BS Information System 4th Year)</option>
                            </select>
                        </div>

                        <!-- Specialty / Category -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Consultation Category <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formCategory">
                                <option value="General Medical">General Medical Consultation</option>
                                <option value="Mental Health & Guidance">Mental Health & Guidance Counseling</option>
                                <option value="Dermatology / Skin">Dermatology / Skin Concern</option>
                                <option value="Follow-Up & Rx Refill">Follow-Up & Prescription Refill</option>
                                <option value="Nutritional Counseling">Nutritional & Lifestyle Counseling</option>
                            </select>
                        </div>

                        <!-- Preferred Date -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Preferred Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" required id="formDate" value="2026-10-02">
                        </div>

                        <!-- Preferred Time Slot -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Preferred Time Slot <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formTime">
                                <option value="09:00 AM - 09:30 AM">09:00 AM - 09:30 AM</option>
                                <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                                <option value="01:30 PM - 02:00 PM">01:30 PM - 02:00 PM</option>
                                <option value="03:00 PM - 03:30 PM">03:00 PM - 03:30 PM</option>
                                <option value="04:00 PM - 04:30 PM">04:00 PM - 04:30 PM</option>
                            </select>
                        </div>

                        <!-- Chief Complaint Narrative -->
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Chief Complaint / Reasons for Consultation <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" rows="3" required id="formComplaint" placeholder="Describe your symptoms, onset time, and any medicine taken..."></textarea>
                        </div>

                        <!-- Pain Scale & Urgency -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Self-Reported Pain Score (1 - 10)</label>
                            <select class="form-control form-control-sm" id="formPain">
                                <option value="1 - 3 / 10 (Mild)">1 - 3 / 10 (Mild Discomfort)</option>
                                <option value="4 - 6 / 10 (Moderate)">4 - 6 / 10 (Moderate Pain)</option>
                                <option value="7 - 8 / 10 (Severe)">7 - 8 / 10 (Severe Pain)</option>
                                <option value="9 - 10 / 10 (Very Severe)">9 - 10 / 10 (Very Severe - Immediate Alert)</option>
                            </select>
                        </div>

                        <!-- Urgency Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Initial Urgency Flag <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formUrgency">
                                <option value="Routine">Routine (Non-Urgent Booking)</option>
                                <option value="Moderate">Moderate (Review within 2 hours)</option>
                                <option value="High">High Urgency (Immediate Nurse Triage)</option>
                            </select>
                        </div>

                        <!-- Guardian Consent -->
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox bg-white p-3 border rounded">
                                <input type="checkbox" class="custom-control-input" id="consentCheck" required checked>
                                <label class="custom-control-label small text-muted" for="consentCheck">
                                    I certify that the student / legal guardian consents to this virtual health consultation and tele-prescribing under DepEd School Health policies.
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white font-weight-bold" style="background-color: #800020;">
                        <i class="fas fa-paper-plane mr-1"></i> Submit Telehealth Request
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function loadTelehealthDatasetFromStorage() {
        try {
            if (window.SmartClinicDB && SmartClinicDB.getConsultations) {
                const data = SmartClinicDB.getConsultations();
                if (Array.isArray(data) && data.length > 0) return data;
            }
            const stored = localStorage.getItem('shsms_consultation_records');
            if (stored) {
                const parsed = JSON.parse(stored);
                if (Array.isArray(parsed) && parsed.length > 0) return parsed;
            }
        } catch (e) {
            console.warn('Storage read error for consultations:', e);
        }
        try {
            localStorage.setItem('shsms_consultation_records', JSON.stringify(seedTelehealthDataset));
        } catch (e) {}
        return JSON.parse(JSON.stringify(seedTelehealthDataset));
    }

    function saveTelehealthDatasetToStorage(data) {
        try {
            localStorage.setItem('shsms_consultation_records', JSON.stringify(data));
            if (window.SmartClinicDB && SmartClinicDB.broadcastUpdate) {
                SmartClinicDB.broadcastUpdate('consultation_updated');
            }
        } catch (e) {}
    }

    // Mock Comprehensive Telehealth Dataset Seed
    const seedTelehealthDataset = [{
            id: 1,
            reqId: '#TELE-2026-001',
            reqDate: 'Oct 08, 2026',
            slot: 'Oct 08, 2026 - 10:30 AM',
            lrn: '22B0023',
            fullName: 'Rex Mark Ricafranca',
            avatar: 'img/undraw_profile_2.svg',
            grade: '3rd Year',
            strand: 'BS Political Science',
            sex: 'Male',
            age: 20,
            category: 'General Medical',
            complaint: 'Tension-type frontal headache and neck stiffness following exam review.',
            onset: '24 - 36 Hours',
            painScore: '4 / 10 (Moderate)',
            homeTemp: '36.7 Â°C (Normal)',
            attached: 'None',
            platform: 'Google Meet',
            platformType: 'google',
            roomLink: 'meet.google.com/shs-tele-001',
            clinician: 'Dr. Maria Santos, MD',
            triageNurse: 'Nurse Santos, RN',
            triageCat: 'Category 3 - Routine Consult',
            knownAllergy: 'No Known Drug Allergies',
            triageNotes: 'Student reports episodic tension headache. Vital signs stable.',
            soapS: 'Patient reports frontal headache secondary to prolonged screen reading.',
            soapO: 'Alert, vital signs within baseline (BP 130/85).',
            soapA: 'Tension Cephalea (ICD-10: G44.2)',
            soapP: 'Paracetamol 500mg tab PRN. Advised 20-20-20 screen break protocol.',
            rxSlipId: '#E-RX-2026-001',
            rxDate: 'Oct 08, 2026',
            rxItems: ['Paracetamol 500mg Tablet - Take 1 tab q6h PRN for headache'],
            urgency: 'Medium',
            status: 'Confirmed',
            consent: 'Verified (Parent: Rosa Ricafranca)'
        },
        {
            id: 2,
            reqId: '#TELE-2026-002',
            reqDate: 'Oct 08, 2026',
            slot: 'Oct 08, 2026 - 02:00 PM',
            lrn: '21S0011',
            fullName: 'Mica Santos',
            avatar: 'img/undraw_profile_1.svg',
            grade: '4th Year',
            strand: 'BS Information System',
            sex: 'Female',
            age: 21,
            category: 'Respiratory / Allergy',
            complaint: 'Nasal congestion, watery eyes, and mild seasonal rhinitis.',
            onset: '2 Days',
            painScore: '2 / 10 (Mild)',
            homeTemp: '36.6 Â°C (Normal)',
            attached: 'None',
            platform: 'Zoom',
            platformType: 'zoom',
            roomLink: 'zoom.us/j/shs-tele-002',
            clinician: 'Dr. Maria Santos, MD',
            triageNurse: 'Nurse Santos, RN',
            triageCat: 'Category 3 - Routine Consult',
            knownAllergy: 'Dust Mites & Pollen',
            triageNotes: 'Student carries Salbutamol inhaler. Experiencing allergic rhinitis flare.',
            soapS: 'Sneezing and rhinitis triggered by dust in computer room.',
            soapO: 'Bilateral lung fields clear. No acute bronchospasm.',
            soapA: 'Allergic Rhinitis (ICD-10: J30.9)',
            soapP: 'Cetirizine 10mg tab once daily at bedtime.',
            rxSlipId: '#E-RX-2026-002',
            rxDate: 'Oct 08, 2026',
            rxItems: ['Cetirizine HCl 10mg Tablet - Take 1 tab OD at bedtime'],
            urgency: 'Medium',
            status: 'Confirmed',
            consent: 'Verified (Parent: Elena Santos)'
        }
    ];

    let telehealthDataset = loadTelehealthDatasetFromStorage();
    let currentActiveRecord = null;

    // Render Table View
    function renderTelehealthTable(dataset) {
        const tbody = document.getElementById('telehealthTableBody');
        tbody.innerHTML = '';

        if (dataset.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="text-center py-4 text-muted"><i class="fas fa-search fa-2x mb-2 d-block"></i>No online consultation requests found matching criteria.</td></tr>`;
            return;
        }

        dataset.forEach(item => {
            const tr = document.createElement('tr');

            // Course Badge
            let strandClass = 'badge-bsis';
            if (item.strand.includes('Information System') || item.strand === 'BSIS') strandClass = 'badge-bsis';
            else if (item.strand.includes('Tourism') || item.strand === 'BSTM') strandClass = 'badge-bstm';
            else if (item.strand.includes('Education') || item.strand === 'BSED') strandClass = 'badge-bsed';
            else if (item.strand.includes('Political') || item.strand === 'BSPOL') strandClass = 'badge-bspol';

            // Status Badge
            let statusBadge = '<span class="badge badge-tele-confirmed">Confirmed</span>';
            if (item.status === 'Pending Review') statusBadge = '<span class="badge badge-tele-pending">Pending Review</span>';
            else if (item.status === 'In-Progress') statusBadge = '<span class="badge badge-tele-inprogress"><i class="fas fa-video mr-1"></i> In-Progress</span>';
            else if (item.status === 'Completed') statusBadge = '<span class="badge badge-tele-completed"><i class="fas fa-check-circle mr-1"></i> Completed</span>';
            else if (item.status === 'Urgent In-Clinic') statusBadge = '<span class="badge badge-tele-escalated"><i class="fas fa-ambulance mr-1"></i> In-Clinic Referral</span>';

            // Urgency Badge
            let urgencyBadge = '<span class="badge badge-urgency-routine">Routine</span>';
            if (item.urgency === 'High') urgencyBadge = '<span class="badge badge-urgency-high"><i class="fas fa-exclamation-circle mr-1"></i> High</span>';
            else if (item.urgency === 'Moderate') urgencyBadge = '<span class="badge badge-urgency-moderate">Moderate</span>';

            // Platform Badge
            let platformBadge = `<span class="badge badge-platform-google"><i class="fab fa-google mr-1"></i> Meet</span>`;
            if (item.platformType === 'zoom') platformBadge = `<span class="badge badge-platform-zoom"><i class="fas fa-video mr-1"></i> Zoom</span>`;
            else if (item.platformType === 'teams') platformBadge = `<span class="badge badge-platform-teams"><i class="fab fa-microsoft mr-1"></i> Teams</span>`;
            else if (item.platformType === 'portal') platformBadge = `<span class="badge badge-platform-portal"><i class="fas fa-hospital mr-1"></i> Portal</span>`;

            tr.innerHTML = `
                    <td>
                        <strong class="text-maroon font-weight-bold" style="color: #800020;">${item.reqId}</strong>
                        <div class="small text-muted"><i class="far fa-calendar-alt mr-1"></i>${item.slot}</div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${item.avatar}" class="rounded-circle mr-2 border" width="38" height="38" alt="Avatar">
                            <div>
                                <div class="font-weight-bold text-dark">${item.fullName}</div>
                                <div class="small text-muted">
                                    <span class="badge ${strandClass} mr-1">${item.strand}</span> ${item.grade} | LRN: ${item.lrn}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="font-weight-600 text-gray-800">${item.category}</div>
                        <div class="small text-muted"><i class="fas fa-user-md mr-1"></i>${item.clinician}</div>
                    </td>
                    <td style="max-width: 260px;">
                        <div class="text-truncate text-dark font-weight-500" title="${item.complaint}">
                            ${item.complaint}
                        </div>
                        <div class="small text-muted">
                            <i class="fas fa-fire text-danger mr-1"></i>Pain: ${item.painScore}
                        </div>
                    </td>
                    <td>
                        ${platformBadge}
                        <div class="small mt-1"><a href="#" onclick="launchVideoCallModalDirect('${item.fullName}', '${item.grade} - ${item.strand}', '${item.avatar}'); return false;" class="text-primary font-weight-bold"><i class="fas fa-external-link-alt mr-1"></i>Join Room</a></div>
                    </td>
                    <td>${urgencyBadge}</td>
                    <td>${statusBadge}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" title="View Full Consultation File" onclick="openConsultationDetailModal(${item.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-outline-success" title="Launch Video Call" onclick="launchVideoCallModalDirect('${item.fullName}', '${item.grade} - ${item.strand}', '${item.avatar}')">
                                <i class="fas fa-video"></i>
                            </button>
                            <button class="btn btn-outline-secondary" title="Quick Approve / Send Link" onclick="quickApprove(${item.id})">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </td>
                `;
            tbody.appendChild(tr);
        });
    }

    // Render Card Grid View
    function renderTelehealthGrid(dataset) {
        const gridContainer = document.getElementById('gridViewContainer');
        gridContainer.innerHTML = '';

        if (dataset.length === 0) {
            gridContainer.innerHTML = `<div class="col-12 text-center py-5 text-muted"><i class="fas fa-search fa-2x mb-2 d-block"></i>No online consultation requests match your filter criteria.</div>`;
            return;
        }

        dataset.forEach(item => {
            const col = document.createElement('div');
            col.className = 'col-xl-4 col-md-6 mb-4';

            let strandClass = 'badge-bsis';
            if (item.strand.includes('Information System') || item.strand === 'BSIS') strandClass = 'badge-bsis';
            else if (item.strand.includes('Tourism') || item.strand === 'BSTM') strandClass = 'badge-bstm';
            else if (item.strand.includes('Education') || item.strand === 'BSED') strandClass = 'badge-bsed';
            else if (item.strand.includes('Political') || item.strand === 'BSPOL') strandClass = 'badge-bspol';

            let statusBadge = '<span class="badge badge-tele-confirmed">Confirmed</span>';
            if (item.status === 'Pending Review') statusBadge = '<span class="badge badge-tele-pending">Pending Review</span>';
            else if (item.status === 'In-Progress') statusBadge = '<span class="badge badge-tele-inprogress"><i class="fas fa-video mr-1"></i> In-Progress</span>';
            else if (item.status === 'Completed') statusBadge = '<span class="badge badge-tele-completed"><i class="fas fa-check-circle mr-1"></i> Completed</span>';
            else if (item.status === 'Urgent In-Clinic') statusBadge = '<span class="badge badge-tele-escalated"><i class="fas fa-ambulance mr-1"></i> In-Clinic Referral</span>';

            let urgencyBadge = '<span class="badge badge-urgency-routine">Routine</span>';
            if (item.urgency === 'High') urgencyBadge = '<span class="badge badge-urgency-high">High Urgency</span>';
            else if (item.urgency === 'Moderate') urgencyBadge = '<span class="badge badge-urgency-moderate">Moderate</span>';

            col.innerHTML = `
                    <div class="card tele-grid-card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                            <span class="badge badge-light border font-weight-bold text-maroon" style="color: #800020;">${item.reqId}</span>
                            <div>
                                ${urgencyBadge}
                                ${statusBadge}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="${item.avatar}" class="rounded-circle mr-3 border" width="48" height="48" alt="Avatar">
                                <div>
                                    <h6 class="font-weight-bold text-gray-900 mb-0">${item.fullName}</h6>
                                    <div class="small text-muted">
                                        <span class="badge ${strandClass}">${item.strand}</span> ${item.grade} | LRN: ${item.lrn}
                                    </div>
                                </div>
                            </div>

                            <div class="p-2 bg-light rounded mb-2">
                                <div class="small font-weight-bold text-primary mb-1"><i class="fas fa-stethoscope mr-1"></i>${item.category}</div>
                                <div class="small text-dark text-truncate" title="${item.complaint}">${item.complaint}</div>
                            </div>

                            <div class="row small mb-3">
                                <div class="col-6">
                                    <span class="text-muted"><i class="far fa-clock mr-1"></i>Slot:</span>
                                    <div class="font-weight-bold text-dark">${item.slot.split(' - ')[1] || item.slot}</div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted"><i class="fas fa-desktop mr-1"></i>Platform:</span>
                                    <div class="font-weight-bold text-dark">${item.platform}</div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <button class="btn btn-sm btn-outline-primary" onclick="openConsultationDetailModal(${item.id})">
                                    <i class="fas fa-file-medical mr-1"></i> Details
                                </button>
                                <button class="btn btn-sm text-white font-weight-bold" style="background-color: #800020;" onclick="launchVideoCallModalDirect('${item.fullName}', '${item.grade} - ${item.strand}', '${item.avatar}')">
                                    <i class="fas fa-video mr-1"></i> Join Call
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            gridContainer.appendChild(col);
        });
    }

    // Switch Table/Grid View
    function switchView(viewMode) {
        if (viewMode === 'table') {
            document.getElementById('tableViewContainer').style.display = 'block';
            document.getElementById('gridViewContainer').style.display = 'none';
            document.getElementById('btnTableView').classList.add('active');
            document.getElementById('btnGridView').classList.remove('active');
        } else {
            document.getElementById('tableViewContainer').style.display = 'none';
            document.getElementById('gridViewContainer').style.display = 'flex';
            document.getElementById('btnGridView').classList.add('active');
            document.getElementById('btnTableView').classList.remove('active');
        }
    }

    // Multi-Filter & Instant Search
    function filterTelehealth() {
        const searchVal = document.getElementById('teleSearchInput').value.toLowerCase().trim();
        const statusVal = document.getElementById('teleStatusFilter').value;
        const strandVal = document.getElementById('teleStrandFilter').value;
        const catVal = document.getElementById('teleCategoryFilter').value;
        const urgencyVal = document.getElementById('teleUrgencyFilter').value;

        const filtered = telehealthDataset.filter(item => {
            const matchSearch = !searchVal ||
                item.fullName.toLowerCase().includes(searchVal) ||
                item.lrn.includes(searchVal) ||
                item.reqId.toLowerCase().includes(searchVal) ||
                item.complaint.toLowerCase().includes(searchVal);

            const matchStatus = (statusVal === 'ALL') || (item.status === statusVal);
            const matchStrand = (strandVal === 'ALL') || (item.strand === strandVal);
            const matchCategory = (catVal === 'ALL') || (item.category === catVal);
            const matchUrgency = (urgencyVal === 'ALL') || (item.urgency === urgencyVal);

            return matchSearch && matchStatus && matchStrand && matchCategory && matchUrgency;
        });

        document.getElementById('recordCount').innerText = filtered.length;
        renderTelehealthTable(filtered);
        renderTelehealthGrid(filtered);
    }

    // Reset Filters
    function resetFilters() {
        document.getElementById('teleSearchInput').value = '';
        document.getElementById('teleStatusFilter').value = 'ALL';
        document.getElementById('teleStrandFilter').value = 'ALL';
        document.getElementById('teleCategoryFilter').value = 'ALL';
        document.getElementById('teleUrgencyFilter').value = 'ALL';
        filterTelehealth();
        showToast('Filters Cleared', 'Displaying all consultation requests.');
    }

    // Open 5-Tab Detail Modal
    function openConsultationDetailModal(id) {
        const item = telehealthDataset.find(r => r.id === id);
        if (!item) return;

        currentActiveRecord = item;

        document.getElementById('modalReqIdDisplay').innerText = `${item.reqId} | Requested on ${item.reqDate}`;
        document.getElementById('mStudentName').innerText = item.fullName;
        document.getElementById('mStudentLrn').innerText = item.lrn;
        document.getElementById('mStudentGradeStrand').innerText = `${item.grade} - ${item.strand}`;
        document.getElementById('mStudentAgeSex').innerText = `${item.age} / ${item.sex}`;
        document.getElementById('mAvatar').src = item.avatar;

        // Status & Urgency Badges
        document.getElementById('mStatusBadge').className = item.status === 'Confirmed' ? 'badge badge-tele-confirmed' :
            (item.status === 'Pending Review' ? 'badge badge-tele-pending' :
                (item.status === 'In-Progress' ? 'badge badge-tele-inprogress' :
                    (item.status === 'Completed' ? 'badge badge-tele-completed' : 'badge badge-tele-escalated')));
        document.getElementById('mStatusBadge').innerText = item.status;

        document.getElementById('mUrgencyBadge').className = item.urgency === 'High' ? 'badge badge-urgency-high' :
            (item.urgency === 'Moderate' ? 'badge badge-urgency-moderate' : 'badge badge-urgency-routine');
        document.getElementById('mUrgencyBadge').innerText = `${item.urgency} Urgency`;

        // Tab 1
        document.getElementById('mCategory').innerText = item.category;
        document.getElementById('mSlot').innerText = item.slot;
        document.getElementById('mClinician').innerText = item.clinician;
        document.getElementById('mMeetingLink').innerText = item.roomLink;
        document.getElementById('mConsentStatus').innerHTML = `<i class="fas fa-check-circle mr-1"></i> ${item.consent}`;

        // Tab 2
        document.getElementById('mComplaintNarrative').innerText = `"${item.complaint}"`;
        document.getElementById('mOnset').innerText = item.onset;
        document.getElementById('mPainScore').innerText = item.painScore;
        document.getElementById('mHomeTemp').innerText = item.homeTemp;
        document.getElementById('mAttachedFiles').innerHTML = `<span class="badge badge-secondary"><i class="fas fa-paperclip mr-1"></i> ${item.attached}</span>`;

        // Tab 3
        document.getElementById('mTriageNurse').innerText = item.triageNurse;
        document.getElementById('mTriageCategory').innerText = item.triageCat;
        document.getElementById('mKnownAllergy').innerText = item.knownAllergy;
        document.getElementById('mTriageNotes').innerText = item.triageNotes;

        // Tab 4
        document.getElementById('mSoapSubjective').innerText = item.soapS;
        document.getElementById('mSoapObjective').innerText = item.soapO;
        document.getElementById('mSoapAssessment').innerText = item.soapA;
        document.getElementById('mSoapPlan').innerText = item.soapP;

        // Tab 5
        document.getElementById('mRxPatient').innerText = `${item.fullName} (${item.grade} - ${item.strand})`;
        document.getElementById('mRxSlipId').innerText = item.rxSlipId;
        document.getElementById('mRxDate').innerText = item.rxDate;

        const rxUl = document.getElementById('mRxItemsList');
        rxUl.innerHTML = '';
        item.rxItems.forEach(rx => {
            const li = document.createElement('li');
            li.innerHTML = `<strong>${rx.split(' - ')[0]}</strong> - ${rx.split(' - ')[1] || ''}`;
            rxUl.appendChild(li);
        });

        // Switch to first tab
        $('#teleDetailTabs a[href="#tab-overview"]').tab('show');
        $('#consultationDetailModal').modal('show');
    }

    // Quick Approve Request
    function quickApprove(id) {
        const item = telehealthDataset.find(r => r.id === id);
        if (item) {
            item.status = 'Confirmed';
            saveTelehealthDatasetToStorage(telehealthDataset);
            filterTelehealth();
            showToast('Consultation Confirmed', `Meeting link generated & notification sent to ${item.fullName}.`);
        }
    }

    // Approve from Detail Modal
    function approveCurrentRequest() {
        if (currentActiveRecord) {
            currentActiveRecord.status = 'Confirmed';
            saveTelehealthDatasetToStorage(telehealthDataset);
            filterTelehealth();
            $('#consultationDetailModal').modal('hide');
            showToast('Consultation Confirmed', `Telehealth session #${currentActiveRecord.reqId} confirmed.`);
        }
    }

    // Escalate to Physical Clinic
    function escalateCurrentRequest() {
        if (currentActiveRecord) {
            currentActiveRecord.status = 'Urgent In-Clinic';
            currentActiveRecord.urgency = 'High';
            saveTelehealthDatasetToStorage(telehealthDataset);
            filterTelehealth();
            $('#consultationDetailModal').modal('hide');
            showToast('Escalated to Physical Clinic', `Student ${currentActiveRecord.fullName} flagged for emergency physical evaluation.`);
        }
    }

    // Launch Video Call Modal
    function launchVideoCallModal() {
        if (currentActiveRecord) {
            launchVideoCallModalDirect(currentActiveRecord.fullName, `${currentActiveRecord.grade} - ${currentActiveRecord.strand}`, currentActiveRecord.avatar);
        }
    }

    function launchVideoCallModalDirect(name, gradeStrand, avatar) {
        document.getElementById('vPatientName').innerText = name;
        document.getElementById('vPatientGrade').innerText = gradeStrand;
        document.getElementById('vPatientAvatar').src = avatar;
        $('#videoCallModal').modal('show');
    }

    // Toggle Video/Audio in Call
    function toggleCallFeature(btn, feature) {
        btn.classList.toggle('video-btn-primary');
        btn.classList.toggle('video-btn-danger');
        showToast(`${feature} Toggled`, `${feature} state updated.`);
    }

    function openRxInCall() {
        $('#videoCallModal').modal('hide');
        if (currentActiveRecord) {
            openConsultationDetailModal(currentActiveRecord.id);
            $('#teleDetailTabs a[href="#tab-rx"]').tab('show');
        }
    }

    // Auto Fill in Booking Form
    function autoFillStudentDetails(val) {
        if (!val) return;
        const parts = val.split('|');
        // Auto values handled on submit
    }

    // Save New Consultation Request
    function saveNewConsultation(e) {
        e.preventDefault();
        const studentVal = document.getElementById('formStudentSelect').value;
        if (!studentVal) return;

        const [fullName, lrn, gradeStrand, sex, age] = studentVal.split('|');
        const category = document.getElementById('formCategory').value;
        const date = document.getElementById('formDate').value;
        const time = document.getElementById('formTime').value;
        const platform = document.getElementById('formPlatform').value;
        const complaint = document.getElementById('formComplaint').value;
        const pain = document.getElementById('formPain').value;
        const urgency = document.getElementById('formUrgency').value;

        let strand = 'BS Information System';
        if (gradeStrand.includes('Tourism') || gradeStrand.includes('BSTM')) strand = 'BS Tourism Management';
        else if (gradeStrand.includes('Education') || gradeStrand.includes('BSED')) strand = 'BS Education';
        else if (gradeStrand.includes('Political') || gradeStrand.includes('BSPOL')) strand = 'BS Political Science';
        else if (gradeStrand.includes('STEM')) strand = 'STEM';
        else if (gradeStrand.includes('ABM')) strand = 'ABM';
        else if (gradeStrand.includes('HUMSS')) strand = 'HUMSS';
        else if (gradeStrand.includes('TVL')) strand = 'TVL';
        else if (gradeStrand.includes('GAS')) strand = 'GAS';

        const newId = `#TELE-2026-0${10 + telehealthDataset.length}`;
        const newRecord = {
            id: telehealthDataset.length + 1,
            reqId: newId,
            reqDate: 'Oct 01, 2026',
            slot: `${date} - ${time.split(' - ')[0]}`,
            lrn: lrn,
            fullName: fullName,
            avatar: 'img/undraw_profile_2.svg',
            grade: gradeStrand.split(' - ')[0],
            strand: strand,
            sex: sex,
            age: parseInt(age),
            category: category,
            complaint: complaint,
            onset: 'Acute (Under 24h)',
            painScore: pain,
            homeTemp: '36.8 °C',
            attached: 'None',
            platform: platform,
            platformType: platform.toLowerCase().includes('google') ? 'google' : (platform.toLowerCase().includes('zoom') ? 'zoom' : 'teams'),
            roomLink: `telehealth.shsms.edu.ph/room-${telehealthDataset.length + 1}`,
            clinician: 'Dr. Alejandro Gomez, MD',
            triageNurse: 'Clarissa D., RN',
            triageCat: 'Category 2 - Scheduled Consult',
            knownAllergy: 'No recorded anaphylactic allergies',
            triageNotes: 'Student submitted online consultation booking request.',
            soapS: complaint,
            soapO: 'Pending video clinical examination.',
            soapA: `${category} Initial Assessment`,
            soapP: 'Schedule virtual consultation and prepare diagnostic plan.',
            rxSlipId: `#E-RX-2026-0${10 + telehealthDataset.length}`,
            rxDate: 'Oct 01, 2026',
            rxItems: ['Consultation in progress - E-Prescription will be generated post-consultation.'],
            urgency: urgency,
            status: 'Pending Review',
            consent: 'Verified (Parent / Legal Guardian)'
        };

        telehealthDataset.unshift(newRecord);
        saveTelehealthDatasetToStorage(telehealthDataset);
        filterTelehealth();
        document.getElementById('statPendingRequests').innerText = `${18 + telehealthDataset.length - 8} Requests`;

        $('#requestConsultationModal').modal('hide');
        e.target.reset();

        showToast('Consultation Booked!', `Request ${newRecord.reqId} for ${newRecord.fullName} queued for nurse triage.`);
    }

    // Toast Feedback
    function showToast(title, msg) {
        document.getElementById('toastTitle').innerText = title;
        document.getElementById('toastMessage').innerText = msg;
        $('#toastNotification').fadeIn().delay(3500).fadeOut();
    }

    // Export / Print Utilities
    function exportTelehealthData() {
        showToast('Export Initiated', 'Exporting telehealth consultation log (CSV format)...');
    }

    function printTelehealthSchedule() {
        window.print();
    }

    function printPrescriptionSlip() {
        window.print();
    }

    function downloadExcuseSlip() {
        showToast('Generating PDF', 'Medical excuse & attendance excuse slip downloading...');
    }

    function syncStudentDropdown() {
        try {
            if (window.SmartClinicDB && SmartClinicDB.getStudents) {
                const students = SmartClinicDB.getStudents();
                const sel = document.getElementById('formStudentSelect');
                if (sel) {
                    const curVal = sel.value;
                    sel.innerHTML = '<option value="">-- Choose Registered Student Profile --</option>';
                    students.forEach(st => {
                        const lrn = st.lrn || st.idNumber || st.id;
                        const name = st.fullName || `${st.firstName || ''} ${st.lastName || ''}`.trim();
                        const gr = st.grade || '1st Year';
                        const str = st.strand || 'General';
                        const sex = st.sex || 'Female';
                        const age = st.age || 18;
                        const optVal = `${name}|${lrn}|${gr} - ${str}|${sex}|${age}`;
                        const opt = document.createElement('option');
                        opt.value = optVal;
                        opt.textContent = `${name} (${lrn} - ${str} ${gr})`;
                        sel.appendChild(opt);
                    });
                    if (curVal) sel.value = curVal;
                }
            }
        } catch (e) {}
    }

    function reloadTelehealth() {
        telehealthDataset = loadTelehealthDatasetFromStorage();
        syncStudentDropdown();
        filterTelehealth();
        if (document.getElementById('statPendingRequests')) {
            document.getElementById('statPendingRequests').innerText = `${18 + telehealthDataset.length - 8} Requests`;
        }
    }

    window.addEventListener('storage', function(e) {
        if (['shsms_consultation_records', 'shsms_students', 'shsms_registered_patients'].includes(e.key)) {
            reloadTelehealth();
        }
    });
    window.addEventListener('smart-clinic-updated', function() {
        reloadTelehealth();
    });

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        syncStudentDropdown();
        reloadTelehealth();
    });
</script>