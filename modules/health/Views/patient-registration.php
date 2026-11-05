<div class="container-fluid">

    <!-- Page Heading & Actions -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-file-medical text-danger mr-2"
                    style="color: var(--maroon-primary) !important;"></i>
                Patient Registration & Medical Record (HSSO FORM - 01)
            </h1>
            <p class="text-muted small mb-0 mt-1">
                Complete clinical intake with <strong>Health Inspection</strong>, <strong>Dental
                    Examination</strong>, and <strong>Medical Consultation</strong> options.
            </p>
        </div>
        <div class="mt-3 mt-sm-0">
            <button class="btn btn-sm text-white shadow font-weight-bold mr-2"
                style="background-color: var(--maroon-primary);" data-toggle="modal"
                data-target="#newHssoModal">
                <i class="fas fa-plus-circle fa-sm text-white mr-1"></i> Register New Patient / Form-01
            </button>
            <button class="btn btn-sm btn-outline-secondary shadow-sm font-weight-bold mr-2"
                onclick="printBlankHssoForm()">
                <i class="fas fa-print fa-sm mr-1"></i> Print Blank Form-01
            </button>
            <button class="btn btn-sm btn-outline-success shadow-sm font-weight-bold"
                onclick="exportHssoData()">
                <i class="fas fa-file-excel fa-sm mr-1"></i> Export Masterlist
            </button>
        </div>
    </div>

    <!-- KPI Statistics Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-patient-reg border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total
                                HSSO Records</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="kpiTotalRecords">
                                1,452</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-users mr-1"></i>
                                Students & University Personnel</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-patient-reg border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Health Inspections Completed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"
                                id="kpiHealthInspections">1,398</div>
                            <div class="text-xs text-muted mt-1"><i
                                    class="fas fa-heartbeat text-success mr-1"></i> Vitals, BMI, BP &
                                Vision Recorded</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-patient-reg border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dental
                                Consultations / Exams</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="kpiDentalRecords">
                                426</div>
                            <div class="text-xs text-muted mt-1"><i
                                    class="fas fa-tooth text-info mr-1"></i> Oral Exams, Caries &
                                Cleanings</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tooth fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card card-patient-reg border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Medical Consultations Logged</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="kpiConsultRecords">
                                815</div>
                            <div class="text-xs text-muted mt-1"><i
                                    class="fas fa-user-md text-warning mr-1"></i> Clinical Encounters &
                                Prescriptions</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search, Filter & Service Option Selector Card -->
    <div class="card card-patient-reg mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 position-relative">
                    <i class="fas fa-search search-icon-pos"></i>
                    <input type="text" id="searchInput"
                        class="form-control search-box-custom bg-light border-0"
                        placeholder="Search by Student #, Name, Course/Position..."
                        onkeyup="filterHssoTable()">
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                    <select id="typeFilter"
                        class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                        onchange="filterHssoTable()">
                        <option value="">All Patient Types</option>
                        <option value="Student">Students Only</option>
                        <option value="Faculty/Personnel">Faculty / Personnel</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-3 mb-lg-0">
                    <select id="serviceFilter"
                        class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                        onchange="filterHssoTable()">
                        <option value="">All Services Below Inspection</option>
                        <option value="Dental Examination">Dental Consultation / Exam</option>
                        <option value="Medical Consultation">Medical Consultation</option>
                        <option value="Both (Dental & Medical)">Both (Dental & Medical)</option>
                        <option value="Health Inspection Only">Health Inspection Only</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-12 text-lg-right text-left">
                    <button class="btn btn-sm btn-outline-danger font-weight-bold"
                        onclick="resetFilters()">
                        <i class="fas fa-undo fa-sm mr-1"></i> Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Master Patient Registration Records Table Card -->
    <div class="card card-patient-reg mb-4 shadow-sm">
        <div class="card-header py-3 d-flex align-items-center justify-content-between bg-white">
            <div>
                <h6 class="m-0 font-weight-bold text-gray-800">
                    <i class="fas fa-notes-medical text-danger mr-2"
                        style="color: var(--maroon-primary) !important;"></i>
                    Master Medical Records & Patient Registration Directory
                </h6>
                <small class="text-muted">MSU Health Services Unit &bull; Form HSSO-01 Official
                    Log</small>
            </div>
            <span class="badge badge-light border text-muted px-3 py-2 font-weight-bold"
                id="recordsCountBadge">
                Showing 6 records
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="hssoMasterTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="pl-4">Form #</th>
                            <th>Student / Emp #</th>
                            <th>Patient Full Name</th>
                            <th>Type / Course / Position</th>
                            <th>Health Inspection (Vitals / BMI)</th>
                            <th>Past Medical History</th>
                            <th>Services Selected</th>
                            <th>Attending Officer</th>
                            <th>Date Registered</th>
                            <th class="text-center pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="hssoTableBody">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- ========================================================================= -->
<!-- MODAL: REGISTER NEW PATIENT / HSSO FORM-01 WITH DENTAL & CONSULTATION      -->
<!-- ========================================================================= -->
<div class="modal fade" id="newHssoModal" tabindex="-1" role="dialog" aria-labelledby="newHssoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header text-white" id="newHssoModalHeader"
                style="background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%); transition: background 0.3s ease;">
                <div class="d-flex align-items-center">
                    <img src="img/logo.png" alt="MSU Logo" class="mr-3 bg-white rounded-circle p-1"
                        style="width: 48px; height: 48px; object-fit: contain;">
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="newHssoModalLabel">
                            MARINDUQUE STATE UNIVERSITY &bull; HEALTH SERVICES UNIT
                        </h5>
                        <span class="badge badge-light text-dark font-weight-bold mt-1" id="modalHeaderBadge">HSSO FORM - 01 : MEDICAL
                            RECORD & PATIENT REGISTRATION</span>
                    </div>
                </div>
                <button class="close text-white opacity-75" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="hssoRegistrationForm" onsubmit="saveHssoRecord(event)" style="display: flex; flex-direction: column; flex: 1 1 auto; min-height: 0; margin-bottom: 0;">
                <div class="modal-body p-4" style="background-color: #ffffff; max-height: 72vh; overflow-y: auto;">

                    <!-- STEP 1: INITIAL SERVICE SELECTION GATE FORM -->
                    <div id="initialServiceGate" class="py-3 px-2">
                        <div class="text-center mb-4">
                            <div class="badge badge-pill badge-danger px-3 py-2 text-uppercase mb-2 font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                <i class="fas fa-list-check mr-1"></i> Step 1 of 2 : Select Required Service / Pumili ng Serbisyo
                            </div>
                            <h4 class="font-weight-bold text-dark mb-1" style="color: var(--maroon-primary) !important;">
                                Choose Service Needed / Pumili ng Serbisyong Kinakailangan
                            </h4>
                            <p class="text-muted small mx-auto mb-0" style="max-width: 580px;">
                                Bago magpatuloy sa pag-fill up ng Patient Registration Form (HSSO Form-01), mangyaring piliin muna ang uri ng serbisyong kinakailangan ng pasyente.
                            </p>
                        </div>

                        <!-- 3 Choices Grid -->
                        <div class="row justify-content-center mb-4">
                            <!-- Choice 1: Dental Service Only -->
                            <div class="col-md-4 mb-3">
                                <div class="gate-service-card text-center p-4 h-100 rounded border bg-white shadow-sm"
                                    id="gateCardDental" onclick="selectGateService('dental')"
                                    style="cursor: pointer; transition: all 0.25s ease; border-top: 5px solid var(--dental-teal) !important;">
                                    <div class="icon-box rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 68px; height: 68px; background: #ccfbf1; color: var(--dental-teal);">
                                        <i class="fas fa-tooth fa-2x"></i>
                                    </div>
                                    <h5 class="font-weight-bold text-dark mb-1">Dental Service Only</h5>
                                    <span class="badge badge-light border text-teal font-weight-bold mb-2" style="color: #0d9488;">Serbisyong Dental Lamang</span>
                                    <p class="small text-muted mb-0">
                                        Para sa oral health examination, prophylaxis, tooth extraction, o dental clearance.
                                    </p>
                                    <div class="check-indicator mt-3" style="font-size: 1.1rem; color: #0d9488; opacity: 0; transition: opacity 0.2s;">
                                        <i class="fas fa-check-circle"></i> <span class="small font-weight-bold">Dental Selected</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Choice 2: Consultation Service Only -->
                            <div class="col-md-4 mb-3">
                                <div class="gate-service-card text-center p-4 h-100 rounded border bg-white shadow-sm"
                                    id="gateCardConsult" onclick="selectGateService('consult')"
                                    style="cursor: pointer; transition: all 0.25s ease; border-top: 5px solid var(--consult-blue) !important;">
                                    <div class="icon-box rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 68px; height: 68px; background: #dbeafe; color: var(--consult-blue);">
                                        <i class="fas fa-user-md fa-2x"></i>
                                    </div>
                                    <h5 class="font-weight-bold text-dark mb-1">Consultation Service Only</h5>
                                    <span class="badge badge-light border text-primary font-weight-bold mb-2">Konsultasyon sa Mediko</span>
                                    <p class="small text-muted mb-0">
                                        Para sa medikal na konsultasyon, checkup sa sakit, reseta, at pagkuha ng gamot.
                                    </p>
                                    <div class="check-indicator mt-3" style="font-size: 1.1rem; color: var(--consult-blue); opacity: 0; transition: opacity 0.2s;">
                                        <i class="fas fa-check-circle"></i> <span class="small font-weight-bold">Consultation Selected</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Choice 3: Both Dental and Consultation -->
                            <div class="col-md-4 mb-3">
                                <div class="gate-service-card text-center p-4 h-100 rounded border bg-white shadow-sm"
                                    id="gateCardBoth" onclick="selectGateService('both')"
                                    style="cursor: pointer; transition: all 0.25s ease; border-top: 5px solid var(--maroon-primary) !important;">
                                    <div class="icon-box rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 68px; height: 68px; background: #fce7f3; color: var(--maroon-primary);">
                                        <i class="fas fa-notes-medical fa-2x"></i>
                                    </div>
                                    <h5 class="font-weight-bold text-dark mb-1">Both Dental & Consultation</h5>
                                    <span class="badge badge-light border text-danger font-weight-bold mb-2">Parehong Dental at Consultation</span>
                                    <p class="small text-muted mb-0">
                                        Kumpletong intake na naglalaman ng parehong dental clearance at medical consultation.
                                    </p>
                                    <div class="check-indicator mt-3" style="font-size: 1.1rem; color: var(--maroon-primary); opacity: 0; transition: opacity 0.2s;">
                                        <i class="fas fa-check-circle"></i> <span class="small font-weight-bold">Both Services Selected</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Continue Button Container -->
                        <div class="text-center pt-2">
                            <button type="button" id="btnContinueRegistration" class="btn btn-lg px-5 text-white font-weight-bold shadow-sm"
                                disabled onclick="proceedToRegistrationForm()"
                                style="background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%); border: none; border-radius: 30px;">
                                Magpatuloy sa Form / Continue <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                            <div class="mt-2 text-muted small" id="gateSelectionHint">
                                <i class="fas fa-info-circle mr-1"></i> Mangyaring pumili muna ng isa sa mga serbisyo sa taas para magpatuloy.
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: REGISTRATION FORM BODY -->
                    <div id="registrationFormBody" style="display: none;">
                        <!-- Selected Service Active Notice Bar -->
                        <div class="alert alert-secondary d-flex align-items-center justify-content-between p-2 mb-3 rounded shadow-sm border" id="selectedServiceNoticeBar" style="background: #f8fafc;">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-dark px-2 py-1 mr-2 font-weight-bold text-uppercase" style="font-size: 0.75rem;">Selected Service</span>
                                <strong id="selectedServiceTitleText" class="text-dark small">Dental Service Only</strong>
                            </div>
                            <button type="button" class="btn btn-xs btn-outline-secondary font-weight-bold" onclick="backToServiceGate()">
                                <i class="fas fa-sync-alt mr-1"></i> Palitan ang Serbisyong Napili / Change Selection
                            </button>
                        </div>

                        <!-- Institutional Subheader -->
                        <div class="text-center mb-3 pb-2 border-bottom">
                            <h6 class="font-weight-bold text-uppercase text-dark mb-0">Sta. Cruz Campus &bull; Matalaba,
                                Sta. Cruz, Marinduque</h6>
                            <p class="small text-muted font-italic mb-0">"Caring for you and your health with a humble
                                and compassionate heart."</p>
                        </div>

                        <!-- SECTION 1: IDENTIFICATION & DEMOGRAPHICS -->
                        <div class="form-section-title d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="fas fa-id-card text-danger"></i> 1. Patient Demographic & University Classification</span>
                            <div class="d-flex align-items-center mt-1 mt-sm-0">
                                <div class="btn-group btn-group-toggle btn-group-sm mr-2" data-toggle="buttons">
                                    <label class="btn btn-outline-primary active btn-sm font-weight-bold"
                                        onclick="togglePatientType('Student')">
                                        <input type="radio" name="patTypeRadio" id="patTypeStudent" checked> Student
                                    </label>
                                    <label class="btn btn-outline-primary btn-sm font-weight-bold"
                                        onclick="togglePatientType('Faculty/Personnel')">
                                        <input type="radio" name="patTypeRadio" id="patTypeFaculty"> Faculty / Personnel
                                    </label>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary font-weight-bold" onclick="clearRegistrationForm()" title="Reset Form">
                                    <i class="fas fa-redo mr-1"></i> Reset Form
                                </button>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark" id="lblIdNumber">Student Number *</label>
                                <input type="text" id="regIdNumber" class="form-control form-control-sm font-weight-bold" required
                                    placeholder="Enter Student ID (e.g. 21S0011, 24B0126)">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark" id="lblCourseOrPosition">Course & Year Level *</label>
                                <input type="text" id="regCoursePos" class="form-control form-control-sm font-weight-semibold" required
                                    list="courseYearList"
                                    placeholder="e.g. BS Information System - 1st Year">
                                <datalist id="courseYearList">
                                    <option value="BS Information System - 1st Year">
                                    <option value="BS Information System - 2nd Year">
                                    <option value="BS Information System - 3rd Year">
                                    <option value="BS Information System - 4th Year">
                                    <option value="BS Tourism Management - 1st Year">
                                    <option value="BS Tourism Management - 2nd Year">
                                    <option value="BS Tourism Management - 3rd Year">
                                    <option value="BS Tourism Management - 4th Year">
                                    <option value="BS Education - 1st Year">
                                    <option value="BS Education - 2nd Year">
                                    <option value="BS Education - 3rd Year">
                                    <option value="BS Education - 4th Year">
                                    <option value="BS Political Science - 1st Year">
                                    <option value="BS Political Science - 2nd Year">
                                    <option value="BS Political Science - 3rd Year">
                                    <option value="BS Political Science - 4th Year">
                                </datalist>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Date of Registration *</label>
                                <input type="date" id="regDate" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Surname / Last Name *</label>
                                <input type="text" id="regLastName" class="form-control form-control-sm" required
                                    placeholder="e.g. Santos">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">First Name *</label>
                                <input type="text" id="regFirstName" class="form-control form-control-sm" required
                                    placeholder="e.g. Maria Clara">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Middle Name</label>
                                <input type="text" id="regMiddleName" class="form-control form-control-sm"
                                    placeholder="e.g. Dela Cruz">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2 col-6">
                                <label class="small font-weight-bold text-dark">Sex *</label>
                                <select id="regSex" class="form-control form-control-sm" required onchange="handleSexChange(this.value)">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 col-6">
                                <label class="small font-weight-bold text-dark">Age *</label>
                                <input type="number" id="regAge" class="form-control form-control-sm" required min="10"
                                    max="100" placeholder="18">
                            </div>
                            <div class="form-group col-md-3 col-6">
                                <label class="small font-weight-bold text-dark">Date of Birth *</label>
                                <input type="date" id="regDob" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group col-md-2 col-6">
                                <label class="small font-weight-bold text-dark">Civil Status</label>
                                <select id="regCivilStatus" class="form-control form-control-sm">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-12">
                                <label class="small font-weight-bold text-dark">Nationality</label>
                                <input type="text" id="regNationality" class="form-control form-control-sm"
                                    value="Filipino">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small font-weight-bold text-dark">Present Address *</label>
                                <input type="text" id="regPresentAddress" class="form-control form-control-sm" required
                                    placeholder="e.g. Brgy. Matalaba, Sta. Cruz, Marinduque">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="small font-weight-bold text-dark">Permanent Address</label>
                                <input type="text" id="regPermanentAddress" class="form-control form-control-sm"
                                    placeholder="e.g. Brgy. Poblacion, Sta. Cruz, Marinduque">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Name of Guardian / Emergency Contact
                                    *</label>
                                <input type="text" id="regGuardianName" class="form-control form-control-sm" required
                                    placeholder="e.g. Elena Santos">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="small font-weight-bold text-dark">Relationship *</label>
                                <input type="text" id="regGuardianRelation" class="form-control form-control-sm"
                                    required placeholder="e.g. Mother / Spouse">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="small font-weight-bold text-dark">Contact # *</label>
                                <input type="tel" id="regGuardianContact" class="form-control form-control-sm" required
                                    placeholder="09XX-XXX-XXXX">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="small font-weight-bold text-dark">Guardian Address</label>
                                <input type="text" id="regGuardianAddress" class="form-control form-control-sm"
                                    placeholder="e.g. Sta. Cruz, Marinduque">
                            </div>
                        </div>

                        <!-- SECTION 2: HEALTH INSPECTION (FROM HSSO FORM-01) -->
                        <div class="form-section-title">
                            <span><i class="fas fa-heartbeat text-danger"></i> 2. Health Inspection (Physical &
                                Biometric Screening)</span>
                            <span class="badge badge-light border text-muted">HSSO Form-01 Section II</span>
                        </div>

                        <div class="p-3 bg-light rounded mb-3 border">
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-2 col-6">
                                    <label class="small font-weight-bold text-dark">Height (cm) *</label>
                                    <input type="number" step="0.1" id="regHeight"
                                        class="form-control form-control-sm font-weight-bold" required
                                        placeholder="e.g. 165" oninput="calculateBmi()">
                                </div>
                                <div class="form-group col-md-2 col-6">
                                    <label class="small font-weight-bold text-dark">Weight (kg) *</label>
                                    <input type="number" step="0.1" id="regWeight"
                                        class="form-control form-control-sm font-weight-bold" required
                                        placeholder="e.g. 58" oninput="calculateBmi()">
                                </div>
                                <div class="form-group col-md-2 col-6">
                                    <label class="small font-weight-bold text-dark">BMI</label>
                                    <input type="text" id="regBmi"
                                        class="form-control form-control-sm bg-white font-weight-bold text-primary"
                                        readonly placeholder="0.0">
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label class="small font-weight-bold text-dark">Weight Category</label>
                                    <select id="regWeightCat" class="form-control form-control-sm font-weight-bold">
                                        <option value="Normal">Normal</option>
                                        <option value="Undwt.">Undwt. (Underweight)</option>
                                        <option value="Overwt">Overwt (Overweight)</option>
                                        <option value="Obese">Obese</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                    <label class="small font-weight-bold text-dark">Blood Type</label>
                                    <select id="regBloodType" class="form-control form-control-sm font-weight-bold">
                                        <option value="O+">O+</option>
                                        <option value="A+">A+</option>
                                        <option value="B+">B+</option>
                                        <option value="AB+">AB+</option>
                                        <option value="O-">O-</option>
                                        <option value="A-">A-</option>
                                        <option value="B-">B-</option>
                                        <option value="AB-">AB-</option>
                                        <option value="Unknown">Unknown / Pending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3 col-6">
                                    <label class="small font-weight-bold text-dark">Blood Pressure (BP) *</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" id="regBp" class="form-control font-weight-bold"
                                            required placeholder="e.g. 120/80" oninput="classifyBp(this.value)">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-white px-2" id="bpIndicator" title="BP Status Indicator"><i class="fas fa-heartbeat text-primary"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label class="small font-weight-bold text-dark">BP Category / Status *</label>
                                    <select id="regBpCategory" class="form-control form-control-sm font-weight-bold" onchange="updateBpCategoryBadge(this.value)">
                                        <option value="Normal">Normal (90/60 - 120/80)</option>
                                        <option value="Low Blood">Low Blood (Hypotension &lt; 90/60)</option>
                                        <option value="Pre-Hypertension">Pre-High Blood / Elevated (121-139 / 81-89)</option>
                                        <option value="High Blood (Stage 1)">High Blood (Stage 1 HTN 140-159 / 90-99)</option>
                                        <option value="High Blood (Stage 2)">High Blood (Stage 2 HTN ≥ 160 / ≥ 100)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 col-4">
                                    <label class="small font-weight-bold text-dark">Pulse Rate (bpm) *</label>
                                    <input type="number" id="regPulse" class="form-control form-control-sm" required
                                        placeholder="76">
                                </div>
                                <div class="form-group col-md-2 col-4">
                                    <label class="small font-weight-bold text-dark">O2Sat / SpO2 (%) *</label>
                                    <input type="number" id="regO2" class="form-control form-control-sm" required
                                        placeholder="98">
                                </div>
                                <div class="form-group col-md-2 col-4">
                                    <label class="small font-weight-bold text-dark">Temp (°C) *</label>
                                    <input type="number" step="0.1" id="regTemp" class="form-control form-control-sm"
                                        required placeholder="36.5">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3 col-6">
                                    <label class="small font-weight-bold text-dark">Vision *</label>
                                    <select id="regVision" class="form-control form-control-sm"
                                        onchange="toggleVisionGrade(this.value)">
                                        <option value="Normal">Normal (20/20)</option>
                                        <option value="Defective">Defective (Requires Grade/Correction)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-6" id="visionGradeGroup">
                                    <label class="small font-weight-bold text-dark">Vision Grade / Findings</label>
                                    <input type="text" id="regVisionGrade" class="form-control form-control-sm"
                                        placeholder="e.g. OD: 20/40, OS: 20/50, with corrective lenses">
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label class="small font-weight-bold text-dark">Hand Dominance *</label>
                                    <select id="regHand" class="form-control form-control-sm">
                                        <option value="Right-handed">Right-handed</option>
                                        <option value="Left-handed">Left-handed</option>
                                        <option value="Ambidextrous">Ambidextrous</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-6" id="lmpFormGroup">
                                    <label class="small font-weight-bold text-dark">LMP (Last Menstrual Period - for Female)</label>
                                    <input type="date" id="regLmp" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>




                        <!-- SECTION 3: PAST MEDICAL HISTORY (FROM HSSO FORM-01) -->
                        <div class="form-section-title">
                            <span><i class="fas fa-history text-danger"></i> 3. Past Medical History</span>
                            <span class="badge badge-light border text-muted">HSSO Form-01 Checkboxes</span>
                        </div>

                        <div class="checkbox-pill-grid mb-3" id="pastMedicalGrid">
                            <!-- Populated with all exact conditions from form -->
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Congenital Heart Defect (specify if
                                    checked)</label>
                                <input type="text" id="regHeartDefectSpec" class="form-control form-control-sm"
                                    placeholder="Specify condition">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Cancer / Malignancy (specify if
                                    checked)</label>
                                <input type="text" id="regCancerSpec" class="form-control form-control-sm"
                                    placeholder="Specify cancer type & year">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="small font-weight-bold text-dark">Allergy (specify allergen/s)</label>
                                <input type="text" id="regAllergySpec" class="form-control form-control-sm"
                                    placeholder="e.g. Seafood, Penicillin, Dust">
                            </div>
                        </div>

                        <!-- SECTION 4: SURGERY & FAMILY HISTORY -->
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-section-title d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-procedures text-danger"></i> 4. Prior Surgical History</span>
                                    <button type="button" class="btn btn-xs btn-outline-danger font-weight-bold" onclick="addSurgeryRow()">
                                        <i class="fas fa-plus mr-1"></i> Add Another Surgery
                                    </button>
                                </div>
                                <div id="surgRowsContainer" class="mb-2">
                                    <!-- Dynamic Surgery Rows -->
                                </div>
                                <small class="text-muted font-italic d-block mb-3">Record all past surgical procedures, operations, or hospitalizations.</small>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-section-title">
                                    <span><i class="fas fa-dna text-danger"></i> 5. Family Medical History</span>
                                </div>
                                <div class="checkbox-pill-grid mb-3" id="familyHistoryGrid"
                                    style="grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));">
                                    <!-- Family history checkboxes -->
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 6: REVIEW OF SYSTEMS (PAGE 2 OF HSSO FORM-01) -->
                        <div class="form-section-title">
                            <span><i class="fas fa-clipboard-check text-danger"></i> 6. Review of Systems (ROS)</span>
                            <span class="badge badge-light border text-muted">HSSO Form-01 Page 2</span>
                        </div>

                        <div class="checkbox-pill-grid mb-3" id="rosGrid">
                            <!-- All Review of systems checkboxes -->
                        </div>

                        <!-- SECTION 7: TREATMENT PLAN & LABORATORY REMARKS -->
                        <div class="form-section-title">
                            <span><i class="fas fa-file-medical-alt text-danger"></i> 7. Initial Treatment Plan &
                                Laboratory Examinations</span>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small font-weight-bold text-dark">Overall Clinical Remarks / Medical
                                    Assessment</label>
                                <textarea id="regFinalRemarks" class="form-control form-control-sm" rows="2"
                                    placeholder="Overall clinic assessment, disposition, or clearance status..."></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="small font-weight-bold text-dark">Laboratory Examination/s if any (please
                                    attach copy)</label>
                                <textarea id="regLabExam" class="form-control form-control-sm" rows="2"
                                    placeholder="e.g. CBC Normal, Chest X-Ray Cleared, Urinalysis unremarkable..."></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer bg-light" id="modalFooterActions" style="display: none;">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm text-white font-weight-bold"
                            style="background-color: var(--maroon-primary);" type="submit">
                            <i class="fas fa-save mr-1"></i> Save HSSO Form-01 Record
                        </button>
                    </div>
            </form>

        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: VIEW COMPLETE HSSO FORM - 01 RECORD & OFFICIAL PRINT VIEW          -->
<!-- ========================================================================= -->
<div class="modal fade" id="viewHssoModal" tabindex="-1" role="dialog" aria-labelledby="viewHssoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-dark text-white d-print-none">
                <h5 class="modal-title font-weight-bold" id="viewHssoModalLabel">
                    <i class="fas fa-file-invoice text-warning mr-2"></i>Official Medical Record (HSSO FORM - 01)
                </h5>
                <div>
                    <button class="btn btn-sm btn-info mr-2" onclick="printHssoModal()"><i
                            class="fas fa-print mr-1"></i> Print Form</button>
                    <button class="close text-white" type="button" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body p-4" id="hssoPrintableArea" style="max-height: 72vh; overflow-y: auto;">
                <!-- Form 01 Card Replica -->
                <div class="hsso-print-card">

                    <!-- Header Banner -->
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-center">
                            <img src="img/logo.png" alt="MSU Logo" class="msu-header-seal">
                        </div>
                        <div class="col-8 text-center">
                            <div style="font-size: 0.85rem; font-weight: bold; text-transform: uppercase;">Republic
                                of the Philippines</div>
                            <div
                                style="font-size: 1.15rem; font-weight: 900; color: #800020; text-transform: uppercase; letter-spacing: 0.5px;">
                                MARINDUQUE STATE UNIVERSITY</div>
                            <div style="font-size: 0.9rem; font-weight: bold;">Sta. Cruz Campus</div>
                            <div style="font-size: 0.8rem; color: #4a5568;">Matalaba, Sta. Cruz, Marinduque</div>
                            <div style="font-size: 0.95rem; font-weight: 800; color: #800020; margin-top: 2px;">
                                HEALTH SERVICES UNIT</div>
                        </div>
                        <div class="col-2 text-right">
                            <div
                                style="border: 2px solid #000; padding: 4px 8px; display: inline-block; font-size: 0.75rem; font-weight: bold;">
                                HSSO FORM - 01
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <h4
                            style="font-weight: 900; text-decoration: underline; letter-spacing: 1px; color: #1a202c;">
                            MEDICAL RECORD</h4>
                        <small class="font-italic" style="font-size: 0.75rem;">"Caring for you and your health with
                            a humble and compassionate heart."</small>
                    </div>

                    <!-- Top Info Fields Table -->
                    <table class="table hsso-table-bordered mb-3 w-100">
                        <tr>
                            <td style="width: 20%; font-weight: bold;">Student / Emp Number:</td>
                            <td style="width: 30%;" id="vIdNumber" class="font-weight-bold text-primary">-</td>
                            <td style="width: 20%; font-weight: bold;">Course & Year / Position:</td>
                            <td style="width: 30%;" id="vCoursePos" class="font-weight-bold">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Full Name:</td>
                            <td colspan="3" id="vFullName" class="font-weight-bold text-dark"
                                style="font-size: 1.05rem;">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Sex / Age:</td>
                            <td id="vSexAge">-</td>
                            <td style="font-weight: bold;">Date of Birth / Civil Status:</td>
                            <td id="vDobCivil">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Present Address:</td>
                            <td id="vPresentAddress">-</td>
                            <td style="font-weight: bold;">Permanent Address:</td>
                            <td id="vPermanentAddress">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Guardian / Contact:</td>
                            <td id="vGuardian">-</td>
                            <td style="font-weight: bold;">Guardian Address / Phone:</td>
                            <td id="vGuardianContact">-</td>
                        </tr>
                    </table>

                    <!-- Health Inspection Section -->
                    <div
                        style="background-color: #800020; color: #fff; padding: 4px 8px; font-weight: bold; font-size: 0.9rem; margin-bottom: 4px;">
                        HEALTH INSPECTION
                    </div>
                    <table class="table hsso-table-bordered mb-3 w-100">
                        <tr>
                            <td style="font-weight: bold; width: 16%;">Height:</td>
                            <td style="width: 17%;" id="vHeight">-</td>
                            <td style="font-weight: bold; width: 16%;">Weight & BMI:</td>
                            <td style="width: 17%;" id="vWeightBmi">-</td>
                            <td style="font-weight: bold; width: 16%;">Blood Type:</td>
                            <td style="width: 18%;" id="vBloodType">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Blood Pressure (BP):</td>
                            <td id="vBp">-</td>
                            <td style="font-weight: bold;">Pulse Rate:</td>
                            <td id="vPulse">-</td>
                            <td style="font-weight: bold;">O2Sat / SpO2:</td>
                            <td id="vO2">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Body Temp:</td>
                            <td id="vTemp">-</td>
                            <td style="font-weight: bold;">Vision:</td>
                            <td id="vVision">-</td>
                            <td style="font-weight: bold;">Hand / LMP:</td>
                            <td id="vHandLmp">-</td>
                        </tr>
                    </table>

                    <!-- Clinical Services Section: Dental & Consultation -->
                    <div
                        style="background-color: #2d3748; color: #fff; padding: 4px 8px; font-weight: bold; font-size: 0.9rem; margin-bottom: 4px;">
                        CLINICAL SERVICE OPTION: DENTAL & MEDICAL CONSULTATION
                    </div>
                    <table class="table hsso-table-bordered mb-3 w-100">
                        <tr style="background-color: #f8f9fa;">
                            <td style="width: 50%; font-weight: bold; color: #0d9488;"><i
                                    class="fas fa-tooth mr-1"></i> DENTAL EXAMINATION & CONSULTATION</td>
                            <td style="width: 50%; font-weight: bold; color: #2563eb;"><i
                                    class="fas fa-stethoscope mr-1"></i> MEDICAL CONSULTATION</td>
                        </tr>
                        <tr>
                            <td id="vDentalSection" style="vertical-align: top;">
                                <!-- Dental view data -->
                            </td>
                            <td id="vConsultSection" style="vertical-align: top;">
                                <!-- Consult view data -->
                            </td>
                        </tr>
                    </table>

                    <!-- Medicine Dispensed & Stock Deduction Summary (if issued) -->
                    <div id="vDispensedSection" class="mb-3" style="display: none;"></div>

                    <!-- Past Medical & Surgery Table -->
                    <div
                        style="background-color: #800020; color: #fff; padding: 4px 8px; font-weight: bold; font-size: 0.9rem; margin-bottom: 4px;">
                        PAST MEDICAL HISTORY & PRIOR SURGERIES
                    </div>
                    <table class="table hsso-table-bordered mb-3 w-100">
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <div style="font-weight: bold; margin-bottom: 4px;"><i class="fas fa-history text-danger mr-1"></i> Diagnosed Past Medical Conditions:</div>
                                <div id="vPastMedList" style="font-size: 0.8rem;">-</div>
                            </td>
                            <td style="width: 50%; vertical-align: top;">
                                <div style="font-weight: bold; margin-bottom: 4px;"><i class="fas fa-procedures text-danger mr-1"></i> All Prior Surgical History:</div>
                                <div id="vSurgeryList" style="font-size: 0.8rem;" class="mb-2">-</div>
                                <div style="font-weight: bold; margin-top: 6px; margin-bottom: 4px;"><i class="fas fa-dna text-purple mr-1"></i> Family Hereditary History:</div>
                                <div id="vFamilyList" style="font-size: 0.8rem;">-</div>
                            </td>
                        </tr>
                    </table>

                    <!-- Review of Systems & Treatment Plan -->
                    <div
                        style="background-color: #800020; color: #fff; padding: 4px 8px; font-weight: bold; font-size: 0.9rem; margin-bottom: 4px;">
                        REVIEW OF SYSTEMS & CLINICAL TREATMENT PLAN
                    </div>
                    <table class="table hsso-table-bordered mb-2 w-100">
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <div style="font-weight: bold; margin-bottom: 4px;">Review of Systems Flagged:</div>
                                <div id="vRosList" style="font-size: 0.8rem;">-</div>
                            </td>
                            <td style="width: 50%; vertical-align: top;">
                                <div style="font-weight: bold; margin-bottom: 4px;">Treatment Plan & Remarks:</div>
                                <div id="vTreatmentRemarks" style="font-size: 0.8rem;">-</div>
                                <div class="mt-3 pt-3 border-top text-right" style="font-size: 0.8rem;">
                                    <strong>Attending Officer:</strong> <span id="vAttendingClinician">Dr. Maria
                                        Santos, MD</span><br>
                                    <small class="text-muted">Signature over Printed Name</small>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="text-muted text-right font-italic" style="font-size: 0.72rem;">
                        Laboratory Examination/s if there is any (please attach a copy) &bull; MSU HSSO Form-01
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-light d-print-none">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                <a id="btnModalGoToAssessment" href="medicalassessmentdocumentation.html" class="btn btn-sm btn-success font-weight-bold">
                    <i class="fas fa-stethoscope mr-1"></i> Open in Medical Assessment
                </a>
                <button class="btn btn-primary btn-sm font-weight-bold" onclick="printHssoModal()">
                    <i class="fas fa-print mr-1"></i> Print HSSO Form-01
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: REGISTRATION SUCCESS & DIRECT TO MEDICAL ASSESSMENT                -->
<!-- ========================================================================= -->
<div class="modal fade" id="assessmentRedirectModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-check-circle mr-2"></i>Patient Form Successfully Saved!
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" onclick="cancelAutoRedirect()">&times;</button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <div class="spinner-grow text-success" role="status" style="width: 3.2rem; height: 3.2rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-1" id="redirectPatientName">-</h5>
                <p class="text-xs text-muted mb-3" id="redirectPatientInfo">-</p>
                <p class="text-dark small mb-3">
                    Ang impormasyon ng pasyente at clinical assessment ay <strong>awtomatikong nai-record sa Medical Assessment Documentation</strong> (SOAP Notes, Vitals, at Medical History).
                </p>
                <div class="alert alert-info py-2 px-3 small font-weight-bold text-left mb-3">
                    <i class="fas fa-clock mr-1"></i> Awtomatikong lilipat sa Medical Assessment sa loob ng <span id="redirectCountdown" class="badge badge-primary px-2 py-1">3</span> segundo...
                </div>
                <div class="d-flex justify-content-center flex-wrap" style="gap: 8px;">
                    <button class="btn btn-secondary btn-sm" onclick="cancelAutoRedirect()">
                        <i class="fas fa-eye mr-1"></i> Tingnan ang HSSO Form Dito
                    </button>
                    <a id="btnProceedToAssessment" href="#" class="btn btn-success btn-sm font-weight-bold shadow-sm">
                        <i class="fas fa-notes-medical mr-1"></i> Pumunta sa Medical Assessment Ngayon &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // List of all medical conditions from physical Form-01
    const pastMedicalList = [
        "Vertigo", "Anemia", "Astigmatism", "Near/Far Sightedness", "Asthma",
        "Primary Tuberculosis", "Congenital Heart Defect", "Hypertension", "Diabetes",
        "Hypo/Hyperthyroidism", "Cancer", "Gallbladder Stone", "Appendicitis",
        "Recurrent UTI", "PCOS", "Benign Prostatic Hyperplasia", "Migraine", "Leukemia",
        "Cataract", "Hearing Impairment", "COPD", "Allergy", "Stroke", "Polycythemia",
        "Glaucoma", "Sinusitis", "Emphysema", "Pancreatitis", "GERD",
        "Chronic Kidney Disease", "Endometriosis", "Seizures/Convulsions"
    ];

    const familyHistoryList = [
        "Vertigo", "Anemia", "Astigmatism", "Near/Far Sightedness", "Asthma",
        "Migraine", "Leukemia", "Cataract", "Hearing Impairment", "Allergy",
        "Stroke", "Polycythemia", "Glaucoma", "Sinusitis"
    ];

    const rosList = [
        "Fever", "Headache", "Hearing problem", "Sinus problem", "Colds", "Chest Pain",
        "Nausea", "Abdominal pain", "Blood in stool", "Muscle pain", "Swelling of hands/feet",
        "Heat Intolerance", "Excessive thirst", "Rash", "Dizziness", "Sore throat",
        "Neck pain", "Cough", "Palpitation", "Vomiting", "Diarrhea", "Pain in Urination",
        "Arthritis", "Numbness/tingling sensation", "Cold Intolerance", "Excessive urination",
        "Lumps", "Blurring of Vision", "Dentures", "Neck enlargement",
        "Difficulty of breathing", "Tremor", "Loss of Appetite", "Constipation",
        "Incontinence", "Weakness", "Excessive sweating"
    ];

    // Master Dataset of Registered Patients (Rex Mark Ricafranca & Mica Santos)
    let hssoRecords = [{
            id: 1,
            formNo: "HSSO-2026-001",
            idNumber: "22B0023",
            patType: "Student",
            lastName: "Ricafranca",
            firstName: "Rex Mark",
            middleName: "Alvarez",
            fullName: "Rex Mark Alvarez Ricafranca",
            courseOrPos: "BS Political Science - 3rd Year",
            sex: "Male",
            age: 20,
            dob: "2006-03-14",
            civilStatus: "Single",
            nationality: "Filipino",
            presentAddress: "Brgy. Poblacion, Sta. Cruz, Marinduque",
            permanentAddress: "Brgy. Poblacion, Sta. Cruz, Marinduque",
            guardianName: "Rosa Ricafranca",
            guardianRelation: "Mother",
            guardianContact: "0919-445-8812",
            guardianAddress: "Sta. Cruz, Marinduque",
            regDate: "2026-10-08",
            height: 170,
            weight: 65,
            bmi: "22.5",
            weightCat: "Normal",
            bp: "130/85",
            bpCategory: "Pre-Hypertension",
            pulse: 82,
            o2: 98,
            temp: 36.7,
            lmp: "",
            bloodType: "O+",
            vision: "Normal",
            visionGrade: "20/20",
            handDominance: "Right-handed",
            serviceOption: "Medical Consultation",
            consultComplaint: "Frontal headache and slight dizziness after morning review exam",
            consultType: "Walk-in Clinic Visit",
            consultPhysician: "Dr. Maria Santos, MD",
            consultDiagnosis: "Tension-type Headache secondary to academic fatigue",
            consultTreatment: "Paracetamol 500mg tab; Rest in Clinic Bay 1 for 30 minutes",
            dentalComplaint: "Routine oral check",
            dentalService: "Oral Examination & Dental Clearance",
            dentalDentist: "Dr. Josefa Garcia, DMD",
            dentalCaries: "None",
            dentalGums: "Healthy",
            dentalDentures: "None",
            dentalHygiene: "Good",
            dentalNotes: "Normal teeth condition.",
            pastMedical: ["Sinusitis"],
            heartDefectSpec: "",
            cancerSpec: "",
            allergySpec: "None",
            surgYear: "",
            surgProc: "None",
            surgStatus: "-",
            familyHistory: ["Hypertension"],
            ros: ["Headache", "Dizziness"],
            remarks: "Now Serving in Clinic Consultation Bay 1.",
            labExam: "CBC Normal"
        },
        {
            id: 2,
            formNo: "HSSO-2026-002",
            idNumber: "21S0011",
            patType: "Student",
            lastName: "Santos",
            firstName: "Mica",
            middleName: "Dela Cruz",
            fullName: "Mica Dela Cruz Santos",
            courseOrPos: "BS Information System - 4th Year",
            sex: "Female",
            age: 21,
            dob: "2005-08-14",
            civilStatus: "Single",
            nationality: "Filipino",
            presentAddress: "Brgy. Matalaba, Sta. Cruz, Marinduque",
            permanentAddress: "Brgy. Matalaba, Sta. Cruz, Marinduque",
            guardianName: "Elena Santos",
            guardianRelation: "Mother",
            guardianContact: "0918-554-3210",
            guardianAddress: "Brgy. Matalaba, Sta. Cruz, Marinduque",
            regDate: "2026-10-01",
            height: 162,
            weight: 54,
            bmi: "20.6",
            weightCat: "Normal",
            bp: "110/70",
            bpCategory: "Normal",
            pulse: 74,
            o2: 99,
            temp: 36.6,
            lmp: "2026-09-20",
            bloodType: "O+",
            vision: "Normal",
            visionGrade: "20/20 both eyes",
            handDominance: "Right-handed",
            serviceOption: "Medical Consultation",
            consultComplaint: "Mild frontal headache & seasonal allergic rhinitis",
            consultType: "Walk-in Clinic Visit",
            consultPhysician: "Dr. Maria Santos, MD",
            consultDiagnosis: "Allergic Rhinitis; Tension Headache secondary to eye fatigue",
            consultTreatment: "Cetirizine 10mg tab once daily at bedtime; Paracetamol 500mg tab PRN",
            dentalComplaint: "Routine oral checkup and dental prophylaxis request",
            dentalService: "Oral Examination & Dental Clearance",
            dentalDentist: "Dr. Josefa Garcia, DMD",
            dentalCaries: "None Detected",
            dentalGums: "Healthy / Normal Gums",
            dentalDentures: "No Dentures",
            dentalHygiene: "Good",
            dentalNotes: "Oral cavity in good condition. Advised brushing 3x daily.",
            pastMedical: ["Asthma", "Allergy", "Sinusitis"],
            heartDefectSpec: "",
            cancerSpec: "",
            allergySpec: "Dust mites, pollen",
            surgYear: "2021",
            surgProc: "Appendectomy",
            surgStatus: "Fully healed",
            familyHistory: ["Asthma", "Allergy"],
            ros: ["Headache", "Sinus problem", "Colds"],
            remarks: "Fit for academic activities and standard physical education.",
            labExam: "CBC & Routine Urinalysis Normal (Marinduque Provincial Hospital)"
        }
    ];

    // =========================================================================
    // UNIVERSITY DIRECTORY FOR INSTANT AUTOMATIC DATA AUTO-FILL
    // =========================================================================
    const universityDirectory = [{
            idNumber: "22B0023",
            lrn: "22B0023",
            patType: "Student",
            lastName: "Ricafranca",
            firstName: "Rex Mark",
            middleName: "Alvarez",
            courseOrPos: "BS Political Science - 3rd Year",
            sex: "Male",
            age: 20,
            dob: "2006-03-14",
            civilStatus: "Single",
            nationality: "Filipino",
            presentAddress: "Brgy. Poblacion, Sta. Cruz, Marinduque",
            permanentAddress: "Brgy. Poblacion, Sta. Cruz, Marinduque",
            guardianName: "Rosa Ricafranca",
            guardianRelation: "Mother",
            guardianContact: "0919-445-8812",
            guardianAddress: "Sta. Cruz, Marinduque",
            height: 170,
            weight: 65,
            bmi: "22.5",
            weightCat: "Normal",
            bp: "130/85",
            bpCategory: "Pre-Hypertension",
            pulse: 82,
            o2: 98,
            temp: 36.7,
            lmp: "",
            bloodType: "O+",
            vision: "Normal",
            visionGrade: "20/20",
            handDominance: "Right-handed",
            pastMedical: ["Sinusitis"],
            heartDefectSpec: "",
            cancerSpec: "",
            allergySpec: "None",
            surgYear: "",
            surgProc: "None",
            surgStatus: "-",
            familyHistory: ["Hypertension"],
            ros: ["Headache", "Dizziness"],
            consultComplaint: "Frontal headache and slight dizziness after morning review exam",
            consultType: "Walk-in Clinic Visit",
            consultPhysician: "Dr. Maria Santos, MD",
            consultDiagnosis: "Tension-type Headache",
            consultTreatment: "Paracetamol 500mg tab; Rest in Clinic Bay 1",
            dentalComplaint: "Routine checkup",
            dentalService: "Oral Examination",
            dentalNotes: "Normal teeth condition."
        },
        {
            idNumber: "21S0011",
            lrn: "21S0011",
            patType: "Student",
            lastName: "Santos",
            firstName: "Mica",
            middleName: "Dela Cruz",
            courseOrPos: "BS Information System - 4th Year",
            sex: "Female",
            age: 21,
            dob: "2005-08-14",
            civilStatus: "Single",
            nationality: "Filipino",
            presentAddress: "Blk 12 Lot 4, Sunrise Village, Brgy. San Jose, Sta. Cruz, Marinduque",
            permanentAddress: "Brgy. San Jose, Sta. Cruz, Marinduque",
            guardianName: "Elena Clara Santos",
            guardianRelation: "Mother",
            guardianContact: "0918-554-3210",
            guardianAddress: "Sta. Cruz, Marinduque",
            height: 162,
            weight: 54,
            bmi: "20.6",
            weightCat: "Normal",
            bp: "110/70",
            bpCategory: "Normal",
            pulse: 74,
            o2: 99,
            temp: 36.6,
            lmp: "2026-09-20",
            bloodType: "O+",
            vision: "Normal",
            visionGrade: "20/20 both eyes",
            handDominance: "Right-handed",
            pastMedical: ["Asthma", "Allergy", "Sinusitis"],
            heartDefectSpec: "",
            cancerSpec: "",
            allergySpec: "Dust mites, pollen",
            surgYear: "2021",
            surgProc: "Appendectomy",
            surgStatus: "Healed",
            familyHistory: ["Asthma", "Allergy"],
            ros: ["Headache", "Sinus problem", "Colds"],
            consultComplaint: "Mild frontal headache & seasonal allergic rhinitis",
            consultType: "Walk-in Clinic Visit",
            consultPhysician: "Dr. Maria Santos, MD",
            consultDiagnosis: "Allergic Rhinitis",
            consultTreatment: "Cetirizine 10mg tab OD; Paracetamol 500mg PRN",
            dentalComplaint: "Routine oral checkup",
            dentalService: "Oral Prophylaxis",
            dentalNotes: "Good oral hygiene."
        }
    ];

    // Active Service Option State in New Record Modal
    let activeServiceOption = "Medical Consultation";

    // Initialize Form UI
    $(document).ready(function() {
        // Set today's date in registration modal
        const todayStr = new Date().toISOString().split('T')[0];
        $('#regDate').val(todayStr);

        // Populate Medicine Dropdown for Clinical Services
        populateRegistrationMedicineDropdown();

        // Populate Initial Surgery Row
        if ($('#surgRowsContainer').children().length === 0) {
            addSurgeryRow();
        }

        // Reactive update listener
        window.addEventListener('smart-clinic-updated', function() {
            populateRegistrationMedicineDropdown();
            if (window.SmartClinicDB && typeof SmartClinicDB.getRegisteredPatients === 'function') {
                hssoRecords = SmartClinicDB.getRegisteredPatients();
                renderHssoTable(hssoRecords);
                updateKpis();
            }
        });

        window.addEventListener('smart-clinic-med-dispensed', function() {
            populateRegistrationMedicineDropdown();
        });

        // Populate Past Medical Checkboxes
        let pmHtml = '';
        pastMedicalList.forEach(item => {
            pmHtml += `
                    <label class="checkbox-pill-item">
                        <input type="checkbox" name="pastMedCheck" value="${item}">
                        <span>${item}</span>
                    </label>
                `;
        });
        $('#pastMedicalGrid').html(pmHtml);

        // Populate Family History Checkboxes
        let fhHtml = '';
        familyHistoryList.forEach(item => {
            fhHtml += `
                    <label class="checkbox-pill-item">
                        <input type="checkbox" name="famHistCheck" value="${item}">
                        <span>${item}</span>
                    </label>
                `;
        });
        $('#familyHistoryGrid').html(fhHtml);

        // Populate Review of Systems Checkboxes
        let rosHtml = '';
        rosList.forEach(item => {
            rosHtml += `
                    <label class="checkbox-pill-item">
                        <input type="checkbox" name="rosCheck" value="${item}">
                        <span>${item}</span>
                    </label>
                `;
        });
        $('#rosGrid').html(rosHtml);

        // Render Master Table
        renderHssoTable(hssoRecords);
        updateKpis();

        // Check if opened via URL parameters (?service=dental or ?service=consult)
        const urlParams = new URLSearchParams(window.location.search);
        const serviceParam = urlParams.get('service');
        if (serviceParam === 'dental') {
            setTimeout(function() {
                openServiceForm('dental');
            }, 300);
        } else if (serviceParam === 'consult' || serviceParam === 'consultation') {
            setTimeout(function() {
                openServiceForm('consult');
            }, 300);
        }

        // Initialize LMP field based on default sex
        handleSexChange($('#regSex').val());
    });

    // =========================================================================
    // PRIOR SURGICAL HISTORY DYNAMIC ROWS
    // =========================================================================
    function addSurgeryRow(surgData) {
        const container = $('#surgRowsContainer');
        const rowIdx = container.children().length + 1;
        const yearVal = surgData?.year || '';
        const procVal = surgData?.proc || surgData?.title || '';
        const hospVal = surgData?.hospital || '';
        const statVal = surgData?.status || surgData?.details || '';

        const rowHtml = `
                <div class="surg-entry-row p-2 border rounded bg-light mb-2">
                    <div class="form-row align-items-center">
                        <div class="col-md-2 col-4 mb-1 mb-md-0">
                            <input type="text" class="form-control form-control-sm font-weight-bold surg-year"
                                placeholder="Year (e.g. 2022)" value="${yearVal}">
                        </div>
                        <div class="col-md-4 col-8 mb-1 mb-md-0">
                            <input type="text" class="form-control form-control-sm font-weight-bold surg-proc"
                                placeholder="Procedure / Operation (e.g. Appendectomy)" value="${procVal}">
                        </div>
                        <div class="col-md-3 col-6 mb-1 mb-md-0">
                            <input type="text" class="form-control form-control-sm surg-hosp"
                                placeholder="Hospital / Clinic (e.g. MPH)" value="${hospVal}">
                        </div>
                        <div class="col-md-2 col-4 mb-1 mb-md-0">
                            <input type="text" class="form-control form-control-sm surg-status"
                                placeholder="Status (e.g. Healed)" value="${statVal}">
                        </div>
                        <div class="col-md-1 col-2 text-right">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-circle" onclick="removeSurgeryRow(this)" title="Delete this surgery row">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        container.append(rowHtml);
    }

    function removeSurgeryRow(btn) {
        const container = $('#surgRowsContainer');
        if (container.children().length > 1) {
            $(btn).closest('.surg-entry-row').remove();
        } else {
            // Clear fields if last row
            const row = $(btn).closest('.surg-entry-row');
            row.find('input').val('');
        }
    }

    function getSurgeryDataFromForm() {
        const list = [];
        $('#surgRowsContainer .surg-entry-row').each(function() {
            const year = $(this).find('.surg-year').val().trim();
            const proc = $(this).find('.surg-proc').val().trim();
            const hospital = $(this).find('.surg-hosp').val().trim() || 'Medical Facility';
            const status = $(this).find('.surg-status').val().trim() || 'Healed';

            if (proc) {
                list.push({
                    year: year || 'Past',
                    proc: proc,
                    title: proc,
                    hospital: hospital,
                    status: status,
                    details: status
                });
            }
        });
        return list;
    }

    // Toggle LMP visibility based on Sex (Hide for Male, Show for Female)
    function handleSexChange(sexVal) {
        if (sexVal === 'Male') {
            $('#lmpFormGroup').hide();
            $('#regLmp').val('');
        } else {
            $('#lmpFormGroup').show();
        }
    }

    // =========================================================================
    // INITIAL SERVICE SELECTION GATE STEP LOGIC
    // =========================================================================
    let gateSelectedService = null;

    function selectGateService(opt) {
        gateSelectedService = opt;
        $('.gate-service-card').removeClass('selected');

        if (opt === 'dental') {
            $('#gateCardDental').addClass('selected');
            $('#gateSelectionHint').html('<i class="fas fa-check-circle text-teal mr-1" style="color: #0d9488;"></i> <strong>Dental Service Only</strong> ang iyong pinili. I-click ang Magpatuloy.');
        } else if (opt === 'consult') {
            $('#gateCardConsult').addClass('selected');
            $('#gateSelectionHint').html('<i class="fas fa-check-circle text-primary mr-1"></i> <strong>Consultation Service Only</strong> ang iyong pinili. I-click ang Magpatuloy.');
        } else if (opt === 'both') {
            $('#gateCardBoth').addClass('selected');
            $('#gateSelectionHint').html('<i class="fas fa-check-circle text-danger mr-1"></i> <strong>Both Dental & Consultation</strong> ang iyong pinili. I-click ang Magpatuloy.');
        }

        $('#btnContinueRegistration').prop('disabled', false).addClass('shadow-lg');
    }

    function proceedToRegistrationForm() {
        if (!gateSelectedService) return;

        $('#initialServiceGate').slideUp(200);
        $('#registrationFormBody').slideDown(250);
        $('#modalFooterActions').slideDown(200);

        selectServiceOption(gateSelectedService);

        let titleText = '';
        if (gateSelectedService === 'dental') {
            titleText = '<i class="fas fa-tooth text-teal mr-1" style="color: #0d9488;"></i> Dental Service Only (Pang-Dentista Lamang)';
            $('#newHssoModalHeader').css('background', 'linear-gradient(135deg, #0d9488 0%, #115e59 100%)');
            $('#modalHeaderBadge').html('<i class="fas fa-tooth mr-1"></i> DENTAL EXAMINATION INTAKE - HSSO FORM-01');
        } else if (gateSelectedService === 'consult') {
            titleText = '<i class="fas fa-user-md text-primary mr-1"></i> Medical Consultation Only (Konsultasyon Lamang)';
            $('#newHssoModalHeader').css('background', 'linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%)');
            $('#modalHeaderBadge').html('<i class="fas fa-user-md mr-1"></i> MEDICAL CONSULTATION INTAKE - HSSO FORM-01');
        } else {
            titleText = '<i class="fas fa-notes-medical text-danger mr-1"></i> Both Dental & Consultation Services (Mediko at Dentista)';
            $('#newHssoModalHeader').css('background', 'linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%)');
            $('#modalHeaderBadge').html('<i class="fas fa-notes-medical mr-1"></i> COMPLETE INTAKE (DENTAL & MEDICAL) - HSSO FORM-01');
        }
        $('#selectedServiceTitleText').html(titleText);
    }

    function backToServiceGate() {
        $('#registrationFormBody').slideUp(200);
        $('#modalFooterActions').slideUp(200);
        $('#initialServiceGate').slideDown(250);
        $('#newHssoModalHeader').css('background', 'linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%)');
        $('#modalHeaderBadge').html('HSSO FORM - 01 : MEDICAL RECORD & PATIENT REGISTRATION');
    }

    function resetServiceGate() {
        gateSelectedService = null;
        $('.gate-service-card').removeClass('selected');
        $('#btnContinueRegistration').prop('disabled', true).removeClass('shadow-lg');
        $('#gateSelectionHint').html('<i class="fas fa-info-circle mr-1"></i> Mangyaring pumili muna ng isa sa mga serbisyo sa taas para magpatuloy.');
        $('#registrationFormBody').hide();
        $('#modalFooterActions').hide();
        $('#initialServiceGate').show();
        $('#newHssoModalHeader').css('background', 'linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%)');
        $('#modalHeaderBadge').html('HSSO FORM - 01 : MEDICAL RECORD & PATIENT REGISTRATION');
    }

    // Open Modal and display Dental or Consultation Service Form
    function openServiceForm(serviceType) {
        if (!$('#newHssoModal').hasClass('show')) {
            $('#newHssoModal').modal('show');
        }

        const opt = (serviceType === 'dental') ? 'dental' : ((serviceType === 'consult' || serviceType === 'consultation') ? 'consult' : 'both');
        selectGateService(opt);
        proceedToRegistrationForm();

        // Smooth scroll inside modal directly to the service section
        setTimeout(function() {
            const modalBody = $('#newHssoModal .modal-body');
            const targetElement = (serviceType === 'dental') ? $('#panelDental') : $('#panelConsultation');
            if (modalBody.length && targetElement.length) {
                const currentScroll = modalBody.scrollTop();
                const elementTop = targetElement.position().top;
                modalBody.animate({
                    scrollTop: currentScroll + elementTop - 30
                }, 350);

                // Focus primary input
                if (serviceType === 'dental') {
                    $('#regDentalComplaint').focus();
                } else {
                    $('#regConsultComplaint').focus();
                }
            }
        }, 300);
    }

    // Reset modal header & gate step on general modal open
    $('#newHssoModal').on('show.bs.modal', function(e) {
        handleSexChange($('#regSex').val());
        populateRegistrationMedicineDropdown();
        if (!gateSelectedService) {
            resetServiceGate();
        }
    });

    // Populate Medicine Dropdown from SmartClinicDB Inventory
    function populateRegistrationMedicineDropdown() {
        const sel = $('#regDispenseMedicine');
        if (!sel.length) return;
        sel.empty();

        let inventory = [];
        if (window.SmartClinicDB && typeof SmartClinicDB.getMedicineInventory === 'function') {
            inventory = SmartClinicDB.getMedicineInventory();
        }

        if (!inventory || inventory.length === 0) {
            sel.append('<option value="">No medicines available in inventory</option>');
            return;
        }

        inventory.forEach(med => {
            const isLow = med.currentStock <= med.minStock;
            const statusText = med.currentStock === 0 ? ' [OUT OF STOCK]' : (isLow ? ` [LOW: ${med.currentStock} ${med.unit}]` : ` [Stock: ${med.currentStock} ${med.unit}]`);
            const opt = `<option value="${med.code}" data-name="${med.genericName} ${med.dosage}" data-stock="${med.currentStock}" data-unit="${med.unit}" data-min="${med.minStock}">${med.genericName} (${med.brandName || med.dosage}) - ${med.dosage}${statusText}</option>`;
            sel.append(opt);
        });

        updateDispenseStockIndicator();
    }

    // Live Stock Deduction & Recipient Indicator
    function updateDispenseStockIndicator() {
        const medSel = $('#regDispenseMedicine option:selected');
        if (!medSel.length || !medSel.val()) {
            $('#dispenseStockBadge').html('<i class="fas fa-boxes mr-1"></i> Select medicine to check stock');
            return;
        }

        const currentStock = parseInt(medSel.data('stock')) || 0;
        const unit = medSel.data('unit') || 'units';
        const minStock = parseInt(medSel.data('min')) || 50;
        const qtyToIssue = parseInt($('#regDispenseQty').val()) || 1;
        const remaining = Math.max(0, currentStock - qtyToIssue);

        let badgeClass = 'badge-success';
        let icon = '<i class="fas fa-check-circle mr-1"></i>';

        if (currentStock === 0) {
            badgeClass = 'badge-danger';
            icon = '<i class="fas fa-exclamation-triangle mr-1"></i> OUT OF STOCK: ';
        } else if (remaining <= minStock) {
            badgeClass = 'badge-warning text-dark';
            icon = '<i class="fas fa-exclamation-circle mr-1"></i> Low Stock Alert: ';
        }

        $('#dispenseStockBadge')
            .removeClass('badge-success badge-warning badge-danger badge-info text-dark')
            .addClass(badgeClass)
            .html(`${icon} Current Stock: <strong>${currentStock} ${unit}</strong> &rarr; After Issuance: <strong>${remaining} ${unit}</strong>`);

        // Recipient & Real-Time Timestamp Preview
        const fName = $('#regFirstName').val() || '';
        const lName = $('#regLastName').val() || '';
        const idNum = $('#regIdNumber').val() || '';
        const studentTitle = fName || lName ? `${fName} ${lName} (${idNum || 'Student'})` : 'Auto-linked to registered patient';
        $('#dispenseRecipientName').text(studentTitle);

        const now = new Date();
        const timeStr = now.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        });
        const dateStr = now.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
        $('#dispenseTimeDisplay').text(`${dateStr} · ${timeStr}`);
    }

    // Toggle Dispense Fields
    function toggleDispenseFields() {
        const isChecked = $('#regEnableDispense').is(':checked');
        if (isChecked) {
            $('#dispenseFieldsContainer').slideDown(200);
            updateDispenseStockIndicator();
        } else {
            $('#dispenseFieldsContainer').slideUp(200);
            $('#dispenseStockBadge').removeClass('badge-success badge-warning badge-danger text-dark').addClass('badge-secondary').html('<i class="fas fa-ban mr-1"></i> Dispensing Disabled');
        }
    }

    // Clean Reset of Registration Form
    function clearRegistrationForm(keepDefaults) {
        $('#hssoRegistrationForm')[0].reset();
        const todayStr = new Date().toISOString().split('T')[0];
        $('#regDate').val(todayStr);
        $('#regSex').val('Female');
        handleSexChange('Female');
        $('#regNationality').val('Filipino');
        $('#regCivilStatus').val('Single');
        $('#regVision').val('Normal');
        toggleVisionGrade('Normal');
        $('#regHand').val('Right-handed');
        $('#regWeightCat').val('');
        $('#regBpCategory').val('');
        $('#bpCategoryBadge').html('');
        $('input[name="pastMedCheck"]').prop('checked', false);
        $('input[name="famHistCheck"]').prop('checked', false);
        $('input[name="rosCheck"]').prop('checked', false);
        $('#surgRowsContainer').empty();
        addSurgeryRow();
        $('#patTypeStudent').prop('checked', true).parent().addClass('active');
        $('#patTypeFaculty').prop('checked', false).parent().removeClass('active');
        togglePatientType('Student');
        resetServiceGate();
    }

    // Toggle Patient Type: Student vs Faculty
    function togglePatientType(type) {
        if (type === 'Student') {
            $('#lblIdNumber').text('Student Number *');
            $('#regIdNumber').attr('placeholder', 'e.g. 21S0011, 24B0126');
            $('#lblCourseOrPosition').text('Course & Year (if student) *');
            $('#regCoursePos').attr('placeholder', 'e.g. BS Information System - 1st Year');
        } else {
            $('#lblIdNumber').text('Employee / Faculty ID *');
            $('#regIdNumber').attr('placeholder', 'e.g. EMP-2022-091');
            $('#lblCourseOrPosition').text('Position / Designation (Faculty/Personnel) *');
            $('#regCoursePos').attr('placeholder', 'e.g. Administrative Aide / Instructor I');
        }
    }

    // Live BMI calculation
    function calculateBmi() {
        const hCm = parseFloat($('#regHeight').val());
        const wKg = parseFloat($('#regWeight').val());

        if (hCm > 0 && wKg > 0) {
            const hM = hCm / 100;
            const bmi = (wKg / (hM * hM)).toFixed(1);
            $('#regBmi').val(bmi);

            // Auto classify
            if (bmi < 18.5) {
                $('#regWeightCat').val('Undwt.');
            } else if (bmi < 25.0) {
                $('#regWeightCat').val('Normal');
            } else if (bmi < 30.0) {
                $('#regWeightCat').val('Overwt');
            } else {
                $('#regWeightCat').val('Obese');
            }
        } else {
            $('#regBmi').val('');
        }
    }

    // Auto-classify BP & Update Select Dropdown
    function classifyBp(bpVal) {
        if (!bpVal) return;
        const parts = bpVal.trim().split('/');
        let cat = 'Normal';
        if (parts.length === 2) {
            const sys = parseInt(parts[0].trim());
            const dia = parseInt(parts[1].trim());
            if (!isNaN(sys) && !isNaN(dia)) {
                if (sys >= 160 || dia >= 100) {
                    cat = 'High Blood (Stage 2)';
                } else if (sys >= 140 || dia >= 90) {
                    cat = 'High Blood (Stage 1)';
                } else if (sys > 120 || dia > 80) {
                    cat = 'Pre-Hypertension';
                } else if (sys < 90 || dia < 60) {
                    cat = 'Low Blood';
                } else {
                    cat = 'Normal';
                }
                $('#regBpCategory').val(cat);
                updateBpCategoryBadge(cat);
            }
        }
    }

    // Update Visual Indicator for BP Category
    function updateBpCategoryBadge(catVal) {
        const ind = $('#bpIndicator');
        if (!ind.length) return;
        if (catVal.includes('High Blood') || catVal.includes('Stage 2') || catVal.includes('Stage 1')) {
            ind.html('<i class="fas fa-arrow-up text-danger font-weight-bold" title="High Blood / Hypertension"></i>');
            ind.css('background-color', '#fee2e2');
        } else if (catVal.includes('Low Blood')) {
            ind.html('<i class="fas fa-arrow-down text-info font-weight-bold" title="Low Blood / Hypotension"></i>');
            ind.css('background-color', '#e0f2fe');
        } else if (catVal.includes('Pre-Hypertension')) {
            ind.html('<i class="fas fa-exclamation text-warning font-weight-bold" title="Pre-High Blood / Elevated"></i>');
            ind.css('background-color', '#fef3c7');
        } else {
            ind.html('<i class="fas fa-check text-success font-weight-bold" title="Normal BP"></i>');
            ind.css('background-color', '#dcfce7');
        }
    }

    // Helper to generate BP status badges across tables and modals
    function getBpBadgeHtml(bpVal, bpCategory) {
        let cat = bpCategory;
        if (!cat && bpVal) {
            const parts = String(bpVal).trim().split('/');
            if (parts.length === 2) {
                const sys = parseInt(parts[0].trim());
                const dia = parseInt(parts[1].trim());
                if (!isNaN(sys) && !isNaN(dia)) {
                    if (sys >= 160 || dia >= 100) cat = 'High Blood (Stage 2)';
                    else if (sys >= 140 || dia >= 90) cat = 'High Blood (Stage 1)';
                    else if (sys > 120 || dia > 80) cat = 'Pre-Hypertension';
                    else if (sys < 90 || dia < 60) cat = 'Low Blood';
                    else cat = 'Normal';
                }
            }
        }
        cat = cat || 'Normal';

        if (cat.includes('High Blood') || cat.includes('HTN') || cat.includes('Stage 2') || cat.includes('Stage 1')) {
            return `<span class="badge badge-danger text-white ml-1 px-2 py-1 font-weight-bold"><i class="fas fa-arrow-up mr-1"></i>${cat}</span>`;
        } else if (cat.includes('Low Blood') || cat.includes('Hypotension')) {
            return `<span class="badge badge-info text-white ml-1 px-2 py-1 font-weight-bold" style="background-color: #0284c7;"><i class="fas fa-arrow-down mr-1"></i>${cat}</span>`;
        } else if (cat.includes('Pre-Hypertension') || cat.includes('Elevated')) {
            return `<span class="badge badge-warning text-dark ml-1 px-2 py-1 font-weight-bold"><i class="fas fa-exclamation mr-1"></i>${cat}</span>`;
        } else {
            return `<span class="badge badge-success text-white ml-1 px-2 py-1 font-weight-bold"><i class="fas fa-check-circle mr-1"></i>Normal</span>`;
        }
    }

    // Toggle Vision Grade field
    function toggleVisionGrade(val) {
        if (val === 'Defective') {
            $('#visionGradeGroup').show();
        } else {
            $('#visionGradeGroup').hide();
        }
    }

    // Service Selection under Health Inspection
    function selectServiceOption(opt) {
        $('.service-select-card').removeClass('active active-dental active-consult');

        if (opt === 'consult') {
            $('#cardOptConsult').addClass('active active-consult');
            $('#panelConsultation').slideDown(200);
            $('#panelDental').slideUp(200);
            activeServiceOption = "Medical Consultation";
        } else if (opt === 'dental') {
            $('#cardOptDental').addClass('active active-dental');
            $('#panelConsultation').slideUp(200);
            $('#panelDental').slideDown(200);
            activeServiceOption = "Dental Examination";
        } else if (opt === 'both') {
            $('#cardOptBoth').addClass('active');
            $('#panelConsultation').slideDown(200);
            $('#panelDental').slideDown(200);
            activeServiceOption = "Both (Dental & Medical)";
        }
    }

    // Render Table Data
    function renderHssoTable(data) {
        const tbody = $('#hssoTableBody');
        tbody.empty();

        if (!data || data.length === 0) {
            tbody.html(`
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            <i class="fas fa-folder-open fa-2x mb-2 d-block text-gray-300"></i>
                            No patient medical records match the selected criteria.
                        </td>
                    </tr>
                `);
            $('#recordsCountBadge').text('Showing 0 records');
            return;
        }

        data.forEach((item, idx) => {
            // Service badge
            let serviceBadge = '';
            if (item.serviceOption === 'Dental Examination') {
                serviceBadge = `<span class="badge-service-dental"><i class="fas fa-tooth mr-1"></i>Dental Exam</span>`;
            } else if (item.serviceOption === 'Medical Consultation') {
                serviceBadge = `<span class="badge-service-consult"><i class="fas fa-stethoscope mr-1"></i>Medical Consult</span>`;
            } else if (item.serviceOption === 'Both (Dental & Medical)') {
                serviceBadge = `<span class="badge-service-both"><i class="fas fa-notes-medical mr-1"></i>Dental & Consult</span>`;
            } else {
                serviceBadge = `<span class="badge-service-inspection"><i class="fas fa-heartbeat mr-1"></i>Inspection Only</span>`;
            }

            // Patient type tag
            const patTag = item.patType === 'Student' ?
                `<span class="pill-tag pill-tag-student"><i class="fas fa-user-graduate mr-1"></i>Student</span>` :
                `<span class="pill-tag pill-tag-faculty"><i class="fas fa-user-tie mr-1"></i>Personnel</span>`;

            const bpStatusBadge = getBpBadgeHtml(item.bp, item.bpCategory);

            // Format past medical history list for display in table
            let pastMedDisplay = '';
            if (item.pastMedical && item.pastMedical.length > 0) {
                pastMedDisplay = item.pastMedical.map(m => `<span class="badge badge-light border text-danger font-weight-bold mr-1 mb-1 small"><i class="fas fa-notes-medical mr-1"></i>${m}</span>`).join(' ');
                if (item.allergySpec && item.allergySpec !== 'None') {
                    pastMedDisplay += `<div class="small text-muted mt-1"><i class="fas fa-allergies text-warning mr-1"></i>Allergy: <strong class="text-dark">${item.allergySpec}</strong></div>`;
                }
            } else {
                pastMedDisplay = `<span class="text-muted small font-italic"><i class="fas fa-check-circle text-success mr-1"></i>Unremarkable</span>`;
            }

            const row = `
                    <tr>
                        <td class="pl-4 font-weight-bold text-dark">${item.formNo}</td>
                        <td><span class="badge badge-light border text-primary font-weight-bold">${item.idNumber}</span></td>
                        <td>
                            <div class="font-weight-bold text-dark">${item.fullName}</div>
                            <small class="text-muted">${item.sex}, ${item.age} yrs &bull; Blood: ${item.bloodType}</small>
                        </td>
                        <td>
                            <div>${patTag}</div>
                            <div class="small font-weight-bold text-gray-700 mt-1">${item.courseOrPos}</div>
                        </td>
                        <td>
                            <div class="small font-weight-bold text-dark d-flex align-items-center flex-wrap">
                                <span>BP: ${item.bp}</span>
                                ${bpStatusBadge}
                            </div>
                            <div class="small text-muted mt-1">HR: ${item.pulse} bpm &bull; BMI: ${item.bmi} (${item.weightCat}) &bull; ${item.temp}°C</div>
                        </td>
                        <td>
                            <div>${pastMedDisplay}</div>
                        </td>
                        <td>${serviceBadge}</td>
                        <td>
                            <div class="small font-weight-bold text-dark">
                                ${item.serviceOption === 'Dental Examination' ? item.dentalDentist : item.consultPhysician}
                            </div>
                        </td>
                        <td><small class="text-muted font-weight-bold">${item.regDate}</small></td>
                        <td class="text-center pr-4">
                            <button class="btn btn-sm btn-circle btn-outline-danger mr-1" title="Tingnan ang Impormasyon / View Patient Medical Record (Form-01)" onclick="viewHssoRecord(${item.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-circle btn-outline-info mr-1" title="Quick Print Form-01" onclick="quickPrint(${item.id})">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="btn btn-sm btn-circle btn-outline-secondary" title="Delete Record" onclick="deleteHssoRecord(${item.id})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            tbody.append(row);
        });

        $('#recordsCountBadge').text(`Showing ${data.length} records`);
    }

    // Filter Table
    function filterHssoTable() {
        const query = $('#searchInput').val().toLowerCase().trim();
        const patType = $('#typeFilter').val();
        const serviceOpt = $('#serviceFilter').val();

        const filtered = hssoRecords.filter(item => {
            const matchesQuery = !query ||
                item.fullName.toLowerCase().includes(query) ||
                item.idNumber.toLowerCase().includes(query) ||
                item.formNo.toLowerCase().includes(query) ||
                item.courseOrPos.toLowerCase().includes(query);

            const matchesType = !patType || item.patType === patType;
            const matchesService = !serviceOpt || item.serviceOption === serviceOpt;

            return matchesQuery && matchesType && matchesService;
        });

        renderHssoTable(filtered);
    }

    function resetFilters() {
        $('#searchInput').val('');
        $('#typeFilter').val('');
        $('#serviceFilter').val('');
        renderHssoTable(hssoRecords);
    }

    // View Official Form-01 Record in Modal
    function viewHssoRecord(id) {
        const rec = hssoRecords.find(r => r.id === id);
        if (!rec) return;

        $('#vIdNumber').text(rec.idNumber + " (" + rec.formNo + ")");
        $('#vCoursePos').text(rec.courseOrPos + " [" + rec.patType + "]");
        $('#vFullName').text(rec.fullName);
        $('#vSexAge').text(`${rec.sex}, ${rec.age} years old`);
        $('#vDobCivil').text(`${rec.dob} | ${rec.civilStatus} | Nationality: ${rec.nationality}`);
        $('#vPresentAddress').text(rec.presentAddress);
        $('#vPermanentAddress').text(rec.permanentAddress || rec.presentAddress);
        $('#vGuardian').text(`${rec.guardianName} (${rec.guardianRelation})`);
        $('#vGuardianContact').text(`${rec.guardianAddress} | Tel: ${rec.guardianContact}`);

        // Health Inspection
        $('#vHeight').text(`${rec.height} cm`);
        $('#vWeightBmi').text(`${rec.weight} kg (BMI: ${rec.bmi} - ${rec.weightCat})`);
        $('#vBloodType').text(rec.bloodType);
        $('#vBp').html(`${rec.bp} mmHg ${getBpBadgeHtml(rec.bp, rec.bpCategory)}`);
        $('#vPulse').text(`${rec.pulse} bpm`);
        $('#vO2').text(`${rec.o2} %`);
        $('#vTemp').text(`${rec.temp} °C`);
        $('#vVision').text(`${rec.vision} (${rec.visionGrade || 'N/A'})`);
        $('#vHandLmp').text(`${rec.handDominance} ${rec.lmp ? '| LMP: ' + rec.lmp : ''}`);

        // Services View
        // Dental Section
        if (rec.dentalComplaint || rec.dentalNotes || rec.serviceOption.includes('Dental')) {
            $('#vDentalSection').html(`
                    <div class="font-weight-bold text-dark">Complaint: <span class="text-danger font-weight-normal">${rec.dentalComplaint || 'Routine examination'}</span></div>
                    <div class="small"><strong>Procedure:</strong> ${rec.dentalService}</div>
                    <div class="small"><strong>Caries:</strong> ${rec.dentalCaries} | <strong>Gums:</strong> ${rec.dentalGums}</div>
                    <div class="small"><strong>Dentures:</strong> ${rec.dentalDentures} | <strong>Hygiene:</strong> ${rec.dentalHygiene}</div>
                    <div class="small mt-1 p-1 bg-light rounded"><strong>Dentist Notes:</strong> ${rec.dentalNotes || 'Clearance noted.'}</div>
                    <div class="small text-right text-muted mt-1"><em>Dentist: ${rec.dentalDentist}</em></div>
                `);
        } else {
            $('#vDentalSection').html(`<div class="text-muted font-italic small">No specific dental complaints recorded during this visit.</div>`);
        }

        // Consult Section
        if (rec.consultComplaint || rec.consultDiagnosis || rec.serviceOption.includes('Medical') || rec.serviceOption.includes('Consult')) {
            $('#vConsultSection').html(`
                    <div class="font-weight-bold text-dark">Complaint: <span class="text-primary font-weight-normal">${rec.consultComplaint || 'Routine Medical Checkup'}</span></div>
                    <div class="small"><strong>Type:</strong> ${rec.consultType}</div>
                    <div class="small"><strong>Clinical Diagnosis:</strong> <span class="text-dark font-weight-bold">${rec.consultDiagnosis || 'Clear'}</span></div>
                    <div class="small mt-1 p-1 bg-light rounded"><strong>Treatment Plan:</strong> ${rec.consultTreatment || 'Routine health clearance.'}</div>
                    <div class="small text-right text-muted mt-1"><em>Physician: ${rec.consultPhysician}</em></div>
                `);
        } else {
            $('#vConsultSection').html(`<div class="text-muted font-italic small">No additional acute medical complaints logged.</div>`);
        }

        // Medicine Dispensed Section
        if (rec.dispensedMed) {
            $('#vDispensedSection').html(`
                    <div class="alert alert-success py-2 px-3 mb-0 rounded shadow-sm border" style="background-color: #f0fdf4; border-left: 4px solid #16a34a !important; color: #14532d;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-success"><i class="fas fa-pills mr-1"></i> Clinic Medicine Issued & Stock Deducted:</span>
                            <span class="badge badge-success font-weight-bold px-2 py-1">${rec.dispensedMed.qty} ${rec.dispensedMed.unit || 'units'}</span>
                        </div>
                        <div class="font-weight-bold text-dark">${rec.dispensedMed.medicineName} <span class="text-muted">(${rec.dispensedMed.medicineCode})</span></div>
                        <div class="small text-muted mt-1"><i class="fas fa-clock mr-1"></i> When Dispensed: <strong>${rec.dispensedMed.timestamp}</strong> &bull; Attending Staff: <strong>${rec.dispensedMed.dispensedBy}</strong></div>
                        <div class="small text-muted"><i class="fas fa-user-tag mr-1"></i> Given To: <strong>${rec.dispensedMed.studentName}</strong> (${rec.dispensedMed.studentId} - ${rec.dispensedMed.courseYear})</div>
                        <div class="small text-dark mt-1"><strong>Dosage & Reason:</strong> ${rec.dispensedMed.reason}</div>
                        <div class="small text-primary font-weight-bold mt-1"><i class="fas fa-cubes mr-1"></i> Updated Inventory Stock: <strong>${rec.dispensedMed.remainingStock} ${rec.dispensedMed.unit || 'units'}</strong> remaining in clinic inventory</div>
                    </div>
                `).show();
        } else {
            $('#vDispensedSection').hide();
        }

        // Past Med
        if (rec.pastMedical && rec.pastMedical.length > 0) {
            const badges = rec.pastMedical.map(m => `<span class="badge badge-light border text-danger font-weight-bold mr-1 mb-1"><i class="fas fa-notes-medical mr-1"></i>${m}</span>`).join(' ');
            let specDetails = '';
            if (rec.allergySpec) specDetails += `<div class="mt-1 small"><strong>Allergies:</strong> <span class="text-danger font-weight-bold">${rec.allergySpec}</span></div>`;
            if (rec.heartDefectSpec) specDetails += `<div class="mt-1 small"><strong>Heart Defect Notes:</strong> ${rec.heartDefectSpec}</div>`;
            if (rec.cancerSpec) specDetails += `<div class="mt-1 small"><strong>Cancer/Malignancy:</strong> ${rec.cancerSpec}</div>`;
            $('#vPastMedList').html(`${badges}${specDetails}`);
        } else {
            $('#vPastMedList').html('<span class="text-muted font-italic"><i class="fas fa-check-circle text-success mr-1"></i> No chronic past medical conditions recorded (Unremarkable)</span>');
        }

        // All Prior Surgeries List
        const surgList = [];
        if (Array.isArray(rec.surgeries) && rec.surgeries.length > 0) {
            rec.surgeries.forEach(s => {
                if (s.proc || s.title) {
                    surgList.push({
                        year: s.year || 'Past',
                        proc: s.proc || s.title,
                        hospital: s.hospital || 'Medical Facility',
                        status: s.status || s.details || 'Healed'
                    });
                }
            });
        }
        if (surgList.length === 0 && rec.surgProc && rec.surgProc !== 'None' && rec.surgProc !== '-') {
            surgList.push({
                year: rec.surgYear || 'Past',
                proc: rec.surgProc,
                hospital: rec.surgHospital || 'Medical Facility',
                status: rec.surgStatus || 'Healed'
            });
        }

        if (surgList.length > 0) {
            let surgHtml = '<div class="list-group list-group-flush">';
            surgList.forEach(s => {
                surgHtml += `
                        <div class="p-2 bg-light rounded border mb-1" style="font-size: 0.78rem;">
                            <div class="d-flex justify-content-between font-weight-bold text-dark">
                                <span><i class="fas fa-procedures text-danger mr-1"></i> ${s.proc}</span>
                                <span class="badge badge-light border font-weight-bold">${s.year}</span>
                            </div>
                            <div class="text-muted mt-1 small">Facility: <strong>${s.hospital}</strong> &bull; Status: <span class="text-success font-weight-bold">${s.status}</span></div>
                        </div>
                    `;
            });
            surgHtml += '</div>';
            $('#vSurgeryList').html(surgHtml);
        } else {
            $('#vSurgeryList').html('<span class="text-muted font-italic"><i class="fas fa-check-circle text-success mr-1"></i> No prior surgeries or surgical hospitalizations recorded</span>');
        }

        // Family History
        if (rec.familyHistory && rec.familyHistory.length > 0) {
            const famBadges = rec.familyHistory.map(f => `<span class="badge badge-light border text-purple font-weight-bold mr-1 mb-1"><i class="fas fa-dna mr-1"></i>${f}</span>`).join(' ');
            $('#vFamilyList').html(famBadges);
        } else {
            $('#vFamilyList').html('<span class="text-muted font-italic">Non-contributory / Unremarkable</span>');
        }

        // ROS
        const rosText = rec.ros && rec.ros.length > 0 ? rec.ros.join(", ") : "Negative for acute review of systems symptoms.";
        $('#vRosList').text(rosText);

        // Remarks
        $('#vTreatmentRemarks').html(`
                <div><strong>Assessment:</strong> ${rec.remarks || 'Clinically evaluated.'}</div>
                <div class="mt-1"><strong>Lab Results:</strong> ${rec.labExam || 'None attached.'}</div>
            `);
        $('#vAttendingClinician').text(rec.consultPhysician || rec.dentalDentist);
        $('#btnModalGoToAssessment').attr('href', `medicalassessmentdocumentation.html?lrn=${encodeURIComponent(rec.idNumber)}`);

        $('#viewHssoModal').modal('show');
    }

    // Load records from storage
    function loadHssoRecordsFromStorage() {
        try {
            const stored = localStorage.getItem('shsms_registered_patients');
            if (stored) {
                const parsed = JSON.parse(stored);
                if (Array.isArray(parsed) && parsed.length > 0) {
                    return parsed;
                }
            }
        } catch (e) {
            console.warn('LocalStorage load error on registered patients:', e);
        }
        saveHssoRecordsToStorage(hssoRecords);
        return hssoRecords;
    }

    function saveHssoRecordsToStorage(data) {
        try {
            localStorage.setItem('shsms_registered_patients', JSON.stringify(data));
        } catch (e) {
            console.warn('LocalStorage save error:', e);
        }
    }

    // Automatic distribution of registered patient to all respective system modules
    function distributePatientToSystemModules(rec) {
        try {
            // Helper to extract course & year
            let strand = 'BS Information System';
            const cp = (rec.courseOrPos || '').toUpperCase();
            if (cp.includes('TOURISM') || cp.includes('BSTM') || cp.includes('TM')) strand = 'BS Tourism Management';
            else if (cp.includes('EDUCATION') || cp.includes('BSED') || cp.includes('EDUC')) strand = 'BS Education';
            else if (cp.includes('POLITICAL') || cp.includes('POLSCI') || cp.includes('POL SCI')) strand = 'BS Political Science';
            else if (cp.includes('INFORMATION SYSTEM') || cp.includes('BSIS') || cp.includes('SYSTEM')) strand = 'BS Information System';
            else if (rec.courseOrPos && rec.courseOrPos.includes(' - ')) strand = rec.courseOrPos.split(' - ')[0].trim();

            let grade = '1st Year';
            if (cp.includes('4TH YEAR') || cp.includes('FOURTH YEAR') || rec.idNumber.startsWith('21')) grade = '4th Year';
            else if (cp.includes('3RD YEAR') || cp.includes('THIRD YEAR') || rec.idNumber.startsWith('22')) grade = '3rd Year';
            else if (cp.includes('2ND YEAR') || cp.includes('SECOND YEAR') || rec.idNumber.startsWith('23') || rec.idNumber.startsWith('25')) grade = '2nd Year';
            else if (cp.includes('1ST YEAR') || cp.includes('FIRST YEAR') || rec.idNumber.startsWith('24') || rec.idNumber.startsWith('26')) grade = '1st Year';
            else if (rec.patType === 'Faculty/Personnel') grade = 'Faculty / Personnel';

            const avatar = rec.sex === 'Female' ? 'img/undraw_profile_1.svg' : 'img/undraw_profile_2.svg';
            const nowTime = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });

            // 1. DISTRIBUTE TO STUDENT HUB (shsms_students)
            let students = [];
            try {
                const s = localStorage.getItem('shsms_students');
                if (s) students = JSON.parse(s);
            } catch (err) {}

            const existingStuIndex = students.findIndex(s => s.idNumber === rec.idNumber || s.lrn === rec.idNumber);
            const stuObj = {
                id: rec.id,
                lrn: rec.idNumber,
                idNumber: rec.idNumber,
                fullName: rec.fullName,
                firstName: rec.firstName,
                lastName: rec.lastName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                section: rec.courseOrPos,
                adviser: "Assigned Adviser",
                sex: rec.sex,
                dob: rec.dob,
                age: rec.age,
                civilStatus: rec.civilStatus,
                nationality: rec.nationality,
                bloodType: rec.bloodType,
                religion: "Roman Catholic",
                philhealth: "12-09823" + rec.id + "-0",
                address: rec.presentAddress,
                studentPhone: rec.guardianContact,
                studentEmail: `${rec.firstName.toLowerCase().replace(/\s+/g, '')}.${rec.lastName.toLowerCase().replace(/\s+/g, '')}@student.msu.edu.ph`,
                guardianName: rec.guardianName,
                guardianRelation: rec.guardianRelation,
                guardianPhone: rec.guardianContact,
                guardianOccupation: "Employed",
                fatherName: "N/A",
                motherName: rec.guardianName,
                income: "₱25,000 - ₱45,000 / month",
                is4ps: false,
                distance: "2.5 km",
                transport: "Commute",
                caregiver: rec.guardianRelation,
                status: "Active Enrolled"
            };

            if (existingStuIndex >= 0) {
                students[existingStuIndex] = stuObj;
            } else {
                students.unshift(stuObj);
            }
            localStorage.setItem('shsms_students', JSON.stringify(students));

            // 2. DISTRIBUTE TO MEDICAL HISTORY (shsms_medical_records)
            let medRecords = [];
            try {
                const m = localStorage.getItem('shsms_medical_records');
                if (m) medRecords = JSON.parse(m);
            } catch (err) {}

            const medObj = {
                id: rec.id,
                lrn: rec.idNumber,
                fullName: rec.fullName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                sex: rec.sex,
                age: rec.age,
                diagnoses: rec.consultDiagnosis || (rec.pastMedical && rec.pastMedical.length > 0 ? rec.pastMedical.join(', ') : 'Routine Health Profile Cleared'),
                category: rec.pastMedical && rec.pastMedical.includes('Asthma') ? 'Respiratory' : (rec.bpCategory && rec.bpCategory.includes('High') ? 'Cardiovascular' : 'General Medicine'),
                onsetAge: 'Reported',
                physician: rec.consultPhysician || 'Dr. Maria Santos, MD',
                conditionStatus: 'Monitored in Clinic',
                clinicalNotes: rec.remarks || rec.consultComplaint || 'Routine health evaluation.',
                surgeries: (Array.isArray(rec.surgeries) && rec.surgeries.length > 0) ?
                    rec.surgeries.map(s => ({
                        year: s.year || '2023',
                        title: s.proc || s.title || 'Surgical Procedure',
                        hospital: s.hospital || 'Medical Center',
                        details: s.status || s.details || 'Healed'
                    })) : (rec.surgProc && rec.surgProc !== 'None' ? [{
                        year: rec.surgYear || '2023',
                        title: rec.surgProc,
                        hospital: 'Medical Center',
                        details: rec.surgStatus || 'Healed'
                    }] : []),
                hospitalizations: (Array.isArray(rec.surgeries) && rec.surgeries.length > 0) ?
                    rec.surgeries.map(s => `${s.proc || s.title} (${s.year})`).join(', ') : (rec.surgProc && rec.surgProc !== 'None' ? `${rec.surgProc} (${rec.surgYear})` : 'None'),
                maternalFamily: rec.familyHistory && rec.familyHistory.length > 0 ? rec.familyHistory.join(', ') : 'None reported',
                paternalFamily: 'N/A',
                familySummary: rec.familyHistory && rec.familyHistory.length > 0 ? rec.familyHistory.join(', ') : 'Unremarkable',
                dailyMeds: rec.consultTreatment || 'As needed',
                rescueMeds: rec.pastMedical && rec.pastMedical.includes('Asthma') ? 'Salbutamol Inhaler' : 'Paracetamol PRN',
                riskLevel: (rec.bpCategory && rec.bpCategory.includes('High')) || (rec.pastMedical && rec.pastMedical.includes('Asthma')) ? 'Moderate Risk' : 'Routine / Low Risk',
                peClearance: 'Cleared for PE',
                clearanceExpiry: 'June 30, 2027',
                peNotes: rec.remarks || 'Cleared for academic PE.'
            };

            const existingMedIdx = medRecords.findIndex(m => m.lrn === rec.idNumber);
            if (existingMedIdx >= 0) medRecords[existingMedIdx] = medObj;
            else medRecords.unshift(medObj);
            localStorage.setItem('shsms_medical_records', JSON.stringify(medRecords));

            // 3. DISTRIBUTE TO ALLERGIES & CONDITIONS (shsms_allergy_records)
            let allergyRecords = [];
            try {
                const a = localStorage.getItem('shsms_allergy_records');
                if (a) allergyRecords = JSON.parse(a);
            } catch (err) {}

            if (rec.allergySpec || (rec.pastMedical && rec.pastMedical.includes('Allergy'))) {
                const algObj = {
                    id: rec.id,
                    lrn: rec.idNumber,
                    fullName: rec.fullName,
                    avatar: avatar,
                    grade: grade,
                    strand: strand,
                    sex: rec.sex,
                    age: rec.age,
                    allergen: rec.allergySpec || 'Seasonal Pollen & Dust',
                    category: 'Environmental / Drug',
                    severity: (rec.allergySpec && rec.allergySpec.toLowerCase().includes('penicillin')) ? 'Anaphylactic / Severe' : 'Moderate',
                    symptoms: 'Sneezing, skin rash, or airway reactivity.',
                    protocol: 'Antihistamine Tablet (Cetirizine 10mg) PRN',
                    epiDevice: 'In Clinic Cabinet',
                    storageLocation: 'Clinic Cabinet #1',
                    secondaryMed: 'Cetirizine 10mg',
                    expDate: '2027',
                    canteenFlag: 'Flagged',
                    canteenNotes: 'Avoid known allergens.',
                    classPrecautions: 'Homeroom advised.',
                    guardianContact: `${rec.guardianName} (${rec.guardianContact})`,
                    physicianContact: rec.consultPhysician || 'Dr. Maria Santos, MD',
                    hospital: 'MSU Clinic Station'
                };
                const existingAlgIdx = allergyRecords.findIndex(a => a.lrn === rec.idNumber);
                if (existingAlgIdx >= 0) allergyRecords[existingAlgIdx] = algObj;
                else allergyRecords.unshift(algObj);
                localStorage.setItem('shsms_allergy_records', JSON.stringify(allergyRecords));
            }

            // 4. DISTRIBUTE TO EMERGENCY CONTACTS (shsms_emergency_contacts)
            let emergencyContacts = [];
            try {
                const e = localStorage.getItem('shsms_emergency_contacts');
                if (e) emergencyContacts = JSON.parse(e);
            } catch (err) {}

            const emgObj = {
                id: rec.id,
                lrn: rec.idNumber,
                fullName: rec.fullName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                sex: rec.sex,
                primaryGuardian: rec.guardianName,
                relationship: rec.guardianRelation,
                primaryPhone: rec.guardianContact,
                primaryLandline: '(02) 8900-1122',
                primaryOccupation: 'Employed',
                primaryEmail: `${rec.guardianName.toLowerCase().replace(/\s+/g, '.')}@gmail.com`,
                secondaryGuardian: 'Clinic Emergency Line',
                secondaryRelation: 'School Station',
                secondaryPhone: '(042) 332-1000',
                secondaryOccupation: 'Health Staff',
                address: rec.presentAddress,
                city: 'Sta. Cruz',
                landmark: 'Near Barangay Center',
                hospital: 'Marinduque Provincial Hospital',
                hospitalPhone: '(042) 332-2111',
                doctor: rec.consultPhysician || 'Dr. Maria Santos, MD',
                insurance: 'PhilHealth',
                status: 'Verified',
                callProtocol: `1. Call Primary (${rec.guardianName}) at ${rec.guardianContact}.`
            };
            const existingEmgIdx = emergencyContacts.findIndex(e => e.lrn === rec.idNumber);
            if (existingEmgIdx >= 0) emergencyContacts[existingEmgIdx] = emgObj;
            else emergencyContacts.unshift(emgObj);
            localStorage.setItem('shsms_emergency_contacts', JSON.stringify(emergencyContacts));

            // 5. DISTRIBUTE TO QUEUE MANAGEMENT (shsms_queue_dataset)
            let queue = [];
            try {
                const q = localStorage.getItem('shsms_queue_dataset');
                if (q) queue = JSON.parse(q);
            } catch (err) {}

            const queueItem = {
                id: Date.now(),
                studentId: rec.idNumber,
                fullName: rec.fullName,
                timeIn: nowTime,
                timeOut: '—',
                status: 'Next'
            };
            queue.push(queueItem);
            localStorage.setItem('shsms_queue_dataset', JSON.stringify(queue));

            // 6. DISTRIBUTE TO DAILY ATTENDANCE LOG (shsms_daily_attendance_dataset)
            let dailyAtt = {};
            try {
                const d = localStorage.getItem('shsms_daily_attendance_dataset');
                if (d) dailyAtt = JSON.parse(d);
            } catch (err) {}

            const todayKey = '2026-10-08';
            if (!dailyAtt[todayKey]) dailyAtt[todayKey] = [];

            const ticketNum = '#' + String(dailyAtt[todayKey].length + 1).padStart(2, '0');
            const attItem = {
                id: `REC-${Date.now()}`,
                ticket: ticketNum,
                studentId: rec.idNumber,
                fullName: rec.fullName,
                grade: grade,
                strand: strand,
                timeIn: nowTime,
                timeOut: '—',
                complaint: rec.consultComplaint || rec.dentalComplaint || 'Health Inspection & Registration',
                station: rec.serviceOption.includes('Dental') ? 'Dental Clinic - Dr. Garcia' : 'Bay 1 - Nurse Santos',
                status: 'Waiting'
            };
            dailyAtt[todayKey].unshift(attItem);
            localStorage.setItem('shsms_daily_attendance_dataset', JSON.stringify(dailyAtt));

            // 7. DISTRIBUTE TO VITAL SIGNS (shsms_vitals_records)
            let vitalsList = [];
            try {
                const v = localStorage.getItem('shsms_vitals_records');
                if (v) vitalsList = JSON.parse(v);
            } catch (err) {}

            const vitalsItem = {
                id: Date.now(),
                date: rec.regDate || '2026-10-08',
                time: nowTime,
                studentId: rec.idNumber,
                fullName: rec.fullName,
                bp: rec.bp,
                bpCategory: rec.bpCategory,
                pulse: rec.pulse,
                temp: rec.temp,
                o2: rec.o2,
                bmi: rec.bmi,
                weightCat: rec.weightCat,
                nurse: rec.consultPhysician || 'Nurse Santos, RN'
            };
            vitalsList.unshift(vitalsItem);
            localStorage.setItem('shsms_vitals_records', JSON.stringify(vitalsList));

            // 8. DISTRIBUTE TO MEDICAL ASSESSMENT (shsms_assessment_records)
            let assessments = [];
            try {
                const a = localStorage.getItem('shsms_assessment_records');
                if (a) assessments = JSON.parse(a);
            } catch (err) {}

            const nextAssessNum = assessments.length + 1;
            const assessCode = `#MA-2026-${String(nextAssessNum).padStart(3, '0')}`;
            const diagText = rec.consultDiagnosis || (rec.pastMedical && rec.pastMedical.length > 0 ? rec.pastMedical.join(', ') : 'Routine Health Clearance / Physical Exam');
            const hasAllergyAst = rec.allergySpec || (rec.pastMedical && rec.pastMedical.includes('Allergy'));
            const allergyStr = rec.allergySpec ? rec.allergySpec : (hasAllergyAst ? 'Known Allergen' : 'No Known Allergies (NKDA)');
            const bpVal = rec.bp || '120/80';
            const tempVal = rec.temp ? `${rec.temp} °C` : '36.6 °C';
            const pulseVal = rec.pulse ? `${rec.pulse} bpm` : '78 bpm';
            const o2Val = rec.o2 ? `${rec.o2}%` : '98%';
            const bmiVal = rec.bmi || '21.3';
            const weightCatVal = rec.weightCat || 'Normal';
            const chiefComplaint = rec.consultComplaint || rec.dentalComplaint || 'Routine Medical Checkup & Registration';
            const rosStr = (rec.ros && rec.ros.length > 0) ? rec.ros.join(', ') : (rec.consultComplaint || 'Negative for acute systemic symptoms');

            const astObj = {
                id: rec.id || Date.now(),
                assessId: assessCode,
                date: 'Oct 08, 2026',
                lrn: rec.idNumber,
                studentId: rec.idNumber,
                fullName: rec.fullName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                sex: rec.sex || 'Male',
                age: rec.age || 20,
                assessType: rec.serviceOption || 'Walk-in Consultation',
                diagnosis: diagText,
                icd10: "ICD-10: R69",
                complaint: chiefComplaint,
                hpi: `${rec.age || 20}-year-old ${rec.sex ? rec.sex.toLowerCase() : 'patient'} registered at health services unit for ${rec.serviceOption || 'medical checkup'}. ${chiefComplaint ? 'Chief concern: ' + chiefComplaint : 'No acute distress noted.'}`,
                symptoms: rosStr,
                allergies: allergyStr,
                temp: tempVal,
                bp: `${bpVal} mmHg`,
                pulse: pulseVal,
                spO2: o2Val,
                findings: `Alert, conscious, oriented. Vital signs recorded (BP: ${bpVal}, HR: ${pulseVal}, Temp: ${tempVal}, SpO2: ${o2Val}, BMI: ${bmiVal} - ${weightCatVal}). ${rec.remarks || 'Physical exam unremarkable.'}`,
                orders: rec.consultTreatment ? `1. ${rec.consultTreatment}\n2. Routine health monitoring.` : '1. Routine clinic monitoring.\n2. Maintain proper hydration and rest.',
                patientEdu: 'Maintain balanced diet, adequate hydration, and take proper rest. Return to clinic PRN for symptom recurrence.',
                status: (rec.bpCategory && rec.bpCategory.includes('High')) || (rec.pastMedical && rec.pastMedical.includes('Asthma')) ? 'Monitored' : 'Completed',
                clearanceStatus: 'Fit for All Activities',
                renewal: 'Annual Review (2027)',
                physician: rec.consultPhysician || 'Dr. Maria Santos, MD'
            };

            const existingAstIdx = assessments.findIndex(a => a.lrn === rec.idNumber || a.studentId === rec.idNumber);
            if (existingAstIdx >= 0) assessments[existingAstIdx] = astObj;
            else assessments.unshift(astObj);
            localStorage.setItem('shsms_assessment_records', JSON.stringify(assessments));

            // 9. DISTRIBUTE TO SCREENING RESULTS (shsms_screenings_records)
            let screenings = [];
            try {
                const s = localStorage.getItem('shsms_screenings_records');
                if (s) screenings = JSON.parse(s);
            } catch (err) {}
            const scrObj = {
                id: `SCR-${Date.now()}`,
                studentId: rec.idNumber,
                lrn: rec.idNumber,
                studentName: rec.fullName,
                fullName: rec.fullName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                sex: rec.sex,
                age: rec.age,
                date: 'Oct 08, 2026',
                height: rec.height,
                weight: rec.weight,
                bmi: rec.bmi,
                bmiCategory: rec.weightCat || 'Normal',
                bp: rec.bp || '120/80',
                vision: rec.vision || '20/20',
                hearing: 'Normal',
                oralHealth: rec.dentalComplaint ? 'Needs Dental Follow-up' : 'Normal / Cleared',
                posture: 'Normal Alignment',
                skin: 'Clear',
                clearance: 'Cleared for School',
                physician: rec.consultPhysician || 'Dr. Maria Santos, MD'
            };
            const scrIdx = screenings.findIndex(s => s.lrn === rec.idNumber || s.studentId === rec.idNumber);
            if (scrIdx >= 0) screenings[scrIdx] = scrObj;
            else screenings.unshift(scrObj);
            localStorage.setItem('shsms_screenings_records', JSON.stringify(screenings));

            // 10. DISTRIBUTE TO IMMUNIZATION TRACKING (shsms_immunization_records)
            let immunizations = [];
            try {
                const imm = localStorage.getItem('shsms_immunization_records');
                if (imm) immunizations = JSON.parse(imm);
            } catch (err) {}
            const immObj = {
                id: `IMM-${Date.now()}`,
                studentId: rec.idNumber,
                lrn: rec.idNumber,
                studentName: rec.fullName,
                fullName: rec.fullName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                sex: rec.sex,
                age: rec.age,
                vaccineName: 'Tetanus Toxoid & Influenza',
                doseNumber: 'Updated Booster',
                dateAdministered: 'Oct 08, 2026',
                status: 'Fully Immunized',
                vaccinator: rec.consultPhysician || 'Nurse Maria Santos, RN'
            };
            const immIdx = immunizations.findIndex(i => i.lrn === rec.idNumber || i.studentId === rec.idNumber);
            if (immIdx >= 0) immunizations[immIdx] = immObj;
            else immunizations.unshift(immObj);
            localStorage.setItem('shsms_immunization_records', JSON.stringify(immunizations));

            // 11. DISTRIBUTE TO TREATMENT & MEDICATION (shsms_treatment_records)
            let treatments = [];
            try {
                const t = localStorage.getItem('shsms_treatment_records');
                if (t) treatments = JSON.parse(t);
            } catch (err) {}
            const treatObj = {
                id: Date.now(),
                rxId: `#MED-2026-${String(treatments.length + 1).padStart(3, '0')}`,
                lrn: rec.idNumber,
                studentId: rec.idNumber,
                fullName: rec.fullName,
                studentName: rec.fullName,
                avatar: avatar,
                grade: grade,
                strand: strand,
                sex: rec.sex,
                age: rec.age,
                date: 'Oct 08, 2026',
                timestamp: `October 08, 2026 - ${nowTime}`,
                medName: rec.dispensedMed ? rec.dispensedMed.medicineName : (rec.consultTreatment || 'Health Clearance Consultation'),
                dosage: rec.dispensedMed ? `${rec.dispensedMed.qty} ${rec.dispensedMed.unit || 'units'}` : 'PRN',
                category: 'Analgesics / General',
                indication: rec.consultComplaint || rec.dentalComplaint || 'Routine Medical Checkup',
                prescriber: rec.consultPhysician || 'Dr. Maria Santos, MD',
                administering: rec.consultPhysician || 'Nurse Maria Santos, RN',
                status: 'Administered'
            };
            const treatIdx = treatments.findIndex(t => t.lrn === rec.idNumber || t.studentId === rec.idNumber);
            if (treatIdx >= 0) treatments[treatIdx] = treatObj;
            else treatments.unshift(treatObj);
            localStorage.setItem('shsms_treatment_records', JSON.stringify(treatments));

            // 12. DISTRIBUTE TO ONLINE CONSULTATIONS (shsms_consultation_records)
            let consultations = [];
            try {
                const c = localStorage.getItem('shsms_consultation_records');
                if (c) consultations = JSON.parse(c);
            } catch (err) {}
            const consultObj = {
                id: `REQ-${Date.now()}`,
                lrn: rec.idNumber,
                studentId: rec.idNumber,
                studentName: rec.fullName,
                fullName: rec.fullName,
                grade: grade,
                strand: strand,
                requestedDate: 'Oct 08, 2026',
                slot: '10:00 AM - 10:30 AM',
                concern: rec.consultComplaint || 'Health Record Profile & Baseline Checkup',
                type: 'In-Clinic Physical Assessment',
                status: 'Completed',
                assignedDoctor: rec.consultPhysician || 'Dr. Maria Santos, MD'
            };
            const consultIdx = consultations.findIndex(c => c.lrn === rec.idNumber || c.studentId === rec.idNumber);
            if (consultIdx >= 0) consultations[consultIdx] = consultObj;
            else consultations.unshift(consultObj);
            localStorage.setItem('shsms_consultation_records', JSON.stringify(consultations));

            // 13. DISTRIBUTE TO HEALTH RISK MONITORING (shsms_risk_students_records)
            let riskRecords = [];
            try {
                const r = localStorage.getItem('shsms_risk_students_records');
                if (r) riskRecords = JSON.parse(r);
            } catch (err) {}
            const isRisk = (rec.pastMedical && rec.pastMedical.includes('Asthma')) || (rec.bpCategory && rec.bpCategory.includes('High'));
            const riskObj = {
                id: `RSK-${Date.now()}`,
                lrn: rec.idNumber,
                studentId: rec.idNumber,
                fullName: rec.fullName,
                studentName: rec.fullName,
                courseYear: `${grade} - ${strand}`,
                riskCondition: (rec.pastMedical && rec.pastMedical.includes('Asthma')) ? 'Bronchial Asthma Flare Watch' : ((rec.bpCategory && rec.bpCategory.includes('High')) ? 'Stage 1 Hypertension Watch' : 'Low Risk / Monitored'),
                severity: isRisk ? 'Moderate / Monitored' : 'Low Risk',
                emergencyProtocol: `Call ${rec.guardianName} (${rec.guardianContact})`,
                lastMonitored: `Oct 08, 2026 ${nowTime}`
            };
            const rIdx = riskRecords.findIndex(r => r.lrn === rec.idNumber || r.studentId === rec.idNumber);
            if (rIdx >= 0) riskRecords[rIdx] = riskObj;
            else riskRecords.unshift(riskObj);
            localStorage.setItem('shsms_risk_students_records', JSON.stringify(riskRecords));

            // 14. DISTRIBUTE TO CLINIC UTILIZATION ENCOUNTERS (shsms_utilization_encounters)
            let encounters = [];
            try {
                const u = localStorage.getItem('shsms_utilization_encounters');
                if (u) encounters = JSON.parse(u);
            } catch (err) {}
            const encObj = {
                id: `ENC-${Date.now()}`,
                encounterCode: `#ENC-${3500 + encounters.length}`,
                date: 'Oct 08, 2026',
                time: nowTime,
                lrn: rec.idNumber,
                studentId: rec.idNumber,
                patientName: rec.fullName,
                courseYear: `${grade} - ${strand}`,
                serviceType: rec.serviceOption || 'Medical Consultation',
                chiefReason: rec.consultComplaint || rec.dentalComplaint || 'New Patient Medical Registration & Baseline Vitals',
                medicationUsed: rec.consultTreatment || 'Baseline Examination',
                bedUsed: 'Outpatient Bay',
                duration: '20 mins',
                attendingStaff: rec.consultPhysician || 'Dr. Maria Santos, MD'
            };
            encounters.unshift(encObj);
            localStorage.setItem('shsms_utilization_encounters', JSON.stringify(encounters));

        } catch (distErr) {
            console.warn('Multi-module distribution error:', distErr);
        }
    }

    // Save New Record from Form
    function saveHssoRecord(e) {
        e.preventDefault();

        // Collect checkboxes
        const pmSelected = [];
        $('input[name="pastMedCheck"]:checked').each(function() {
            pmSelected.push($(this).val());
        });

        const famSelected = [];
        $('input[name="famHistCheck"]:checked').each(function() {
            famSelected.push($(this).val());
        });

        const rosSelected = [];
        $('input[name="rosCheck"]:checked').each(function() {
            rosSelected.push($(this).val());
        });

        const patType = $('#patTypeStudent').is(':checked') ? 'Student' : 'Faculty/Personnel';
        const fName = $('#regFirstName').val().trim();
        const lName = $('#regLastName').val().trim();
        const mName = $('#regMiddleName').val().trim();
        const fullName = mName ? `${fName} ${mName} ${lName}` : `${fName} ${lName}`;

        const newId = hssoRecords.length > 0 ? Math.max(...hssoRecords.map(r => r.id)) + 1 : 1;
        const formNo = `HSSO-2026-${String(newId).padStart(3, '0')}`;

        const newRecord = {
            id: newId,
            formNo: formNo,
            idNumber: $('#regIdNumber').val().trim(),
            patType: patType,
            lastName: lName,
            firstName: fName,
            middleName: mName,
            fullName: fullName,
            courseOrPos: $('#regCoursePos').val().trim(),
            sex: $('#regSex').val(),
            age: parseInt($('#regAge').val()),
            dob: $('#regDob').val(),
            civilStatus: $('#regCivilStatus').val(),
            nationality: $('#regNationality').val(),
            presentAddress: $('#regPresentAddress').val(),
            permanentAddress: $('#regPermanentAddress').val(),
            guardianName: $('#regGuardianName').val(),
            guardianRelation: $('#regGuardianRelation').val(),
            guardianContact: $('#regGuardianContact').val(),
            guardianAddress: $('#regGuardianAddress').val(),
            regDate: $('#regDate').val(),
            // Health Inspection
            height: parseFloat($('#regHeight').val()),
            weight: parseFloat($('#regWeight').val()),
            bmi: $('#regBmi').val() || "21.0",
            weightCat: $('#regWeightCat').val(),
            bp: $('#regBp').val(),
            bpCategory: $('#regBpCategory').val() || 'Normal',
            pulse: parseInt($('#regPulse').val()),
            o2: parseInt($('#regO2').val()),
            temp: parseFloat($('#regTemp').val()),
            lmp: $('#regLmp').val(),
            bloodType: $('#regBloodType').val(),
            vision: $('#regVision').val(),
            visionGrade: $('#regVisionGrade').val(),
            handDominance: $('#regHand').val(),
            // Service chosen
            serviceOption: activeServiceOption,
            // Consult specifics
            consultComplaint: $('#regConsultComplaint').val(),
            consultType: $('#regConsultType').val(),
            consultPhysician: $('#regConsultPhysician').val(),
            consultDiagnosis: $('#regConsultDiagnosis').val(),
            consultTreatment: $('#regConsultTreatment').val(),
            // Dental specifics
            dentalComplaint: $('#regDentalComplaint').val(),
            dentalService: $('#regDentalService').val(),
            dentalDentist: $('#regDentalDentist').val(),
            dentalCaries: $('#regDentalCaries').val(),
            dentalGums: $('#regDentalGums').val(),
            dentalDentures: $('#regDentalDentures').val(),
            dentalHygiene: $('#regDentalHygiene').val(),
            dentalNotes: $('#regDentalNotes').val(),
            // Medical history & All Surgeries
            pastMedical: pmSelected,
            heartDefectSpec: $('#regHeartDefectSpec').val(),
            cancerSpec: $('#regCancerSpec').val(),
            allergySpec: $('#regAllergySpec').val(),
            surgeries: getSurgeryDataFromForm(),
            surgYear: getSurgeryDataFromForm().length > 0 ? getSurgeryDataFromForm()[0].year : '',
            surgProc: getSurgeryDataFromForm().length > 0 ? getSurgeryDataFromForm()[0].proc : 'None',
            surgStatus: getSurgeryDataFromForm().length > 0 ? getSurgeryDataFromForm()[0].status : '',
            familyHistory: famSelected,
            ros: rosSelected,
            remarks: $('#regFinalRemarks').val(),
            labExam: $('#regLabExam').val(),
            dispensedMed: null
        };

        // Automatic Medicine Dispensing & Inventory Deduction
        if ($('#regEnableDispense').is(':checked') && $('#regDispenseMedicine').val()) {
            const selectedOpt = $('#regDispenseMedicine option:selected');
            const medCode = selectedOpt.val();
            const medName = selectedOpt.data('name') || selectedOpt.text();
            const qty = parseInt($('#regDispenseQty').val()) || 1;
            const reason = $('#regDispenseReason').val().trim() || $('#regConsultComplaint').val().trim() || 'Clinical Intake & Treatment';
            const dispensedBy = $('#regConsultPhysician').val() || 'Nurse Maria Santos, RN';

            if (window.SmartClinicDB && typeof SmartClinicDB.dispenseMedicine === 'function') {
                const dispLog = SmartClinicDB.dispenseMedicine({
                    medicineCode: medCode,
                    medicineName: medName,
                    qty: qty,
                    studentId: newRecord.idNumber,
                    studentName: newRecord.fullName,
                    courseYear: newRecord.courseOrPos,
                    reason: reason,
                    dispensedBy: dispensedBy
                });
                newRecord.dispensedMed = dispLog;
            }
        }

        hssoRecords.unshift(newRecord);
        saveHssoRecordsToStorage(hssoRecords);
        distributePatientToSystemModules(newRecord);
        if (window.SmartClinicDB && typeof window.SmartClinicDB.registerPatient === 'function') {
            window.SmartClinicDB.registerPatient(newRecord);
        }

        renderHssoTable(hssoRecords);
        updateKpis();

        $('#newHssoModal').modal('hide');
        $('#hssoRegistrationForm')[0].reset();

        // Set up Redirect to Medical Assessment Modal
        $('#redirectPatientName').text(newRecord.fullName);
        $('#redirectPatientInfo').text(`ID / LRN: ${newRecord.idNumber} • ${newRecord.courseOrPos} • ${newRecord.serviceOption}`);
        $('#btnProceedToAssessment').attr('href', `medicalassessmentdocumentation.html?lrn=${encodeURIComponent(newRecord.idNumber)}&new=1`);

        // Start 3-second auto-redirect countdown
        let countdown = 3;
        $('#redirectCountdown').text(countdown);
        $('#assessmentRedirectModal').modal('show');

        if (window.redirectTimer) clearInterval(window.redirectTimer);
        window.redirectTimer = setInterval(function() {
            countdown--;
            $('#redirectCountdown').text(countdown);
            if (countdown <= 0) {
                clearInterval(window.redirectTimer);
                window.location.href = `medicalassessmentdocumentation.html?lrn=${encodeURIComponent(newRecord.idNumber)}&new=1`;
            }
        }, 1000);
    }

    function cancelAutoRedirect() {
        if (window.redirectTimer) {
            clearInterval(window.redirectTimer);
            window.redirectTimer = null;
        }
        $('#assessmentRedirectModal').modal('hide');
        if (hssoRecords.length > 0) {
            viewHssoRecord(hssoRecords[0].id);
        }
    }

    // Delete record
    function deleteHssoRecord(id) {
        if (confirm("Are you sure you want to delete this Medical Record entry from the masterlist?")) {
            hssoRecords = hssoRecords.filter(r => r.id !== id);
            saveHssoRecordsToStorage(hssoRecords);
            renderHssoTable(hssoRecords);
            updateKpis();
        }
    }

    // Update KPIs
    function updateKpis() {
        $('#kpiTotalRecords').text(hssoRecords.length + 1448);
        const dentalCount = hssoRecords.filter(r => r.serviceOption.includes('Dental')).length + 424;
        const consultCount = hssoRecords.filter(r => r.serviceOption.includes('Consult') || r.serviceOption.includes('Medical')).length + 812;
        $('#kpiDentalRecords').text(dentalCount);
        $('#kpiConsultRecords').text(consultCount);
    }

    // Quick Print
    function quickPrint(id) {
        viewHssoRecord(id);
        setTimeout(() => {
            printHssoModal();
        }, 300);
    }

    // Print modal content
    function printHssoModal() {
        window.print();
    }

    // Print blank Form-01
    function printBlankHssoForm() {
        const blankRec = {
            id: 9999,
            formNo: "HSSO-FORM-01",
            idNumber: "____________________",
            patType: "Student",
            fullName: "____________________________________________________________",
            courseOrPos: "____________________",
            sex: "_______",
            age: "____",
            dob: "________________",
            civilStatus: "____________",
            nationality: "Filipino",
            presentAddress: "____________________________________________________________",
            permanentAddress: "____________________________________________________________",
            guardianName: "________________________________",
            guardianRelation: "____________",
            guardianContact: "____________________",
            guardianAddress: "________________________________",
            regDate: "________________",
            height: "______",
            weight: "______",
            bmi: "______",
            weightCat: "Normal / Undwt / Overwt",
            bp: "__________",
            bpCategory: "Normal / Low / High Blood",
            pulse: "____",
            o2: "____",
            temp: "____",
            lmp: "____________",
            bloodType: "______",
            vision: "Normal / Defective",
            visionGrade: "________________",
            handDominance: "Right / Left",
            serviceOption: "Both (Dental & Medical)",
            consultComplaint: "____________________________________________________________",
            consultType: "Routine Physical Examination",
            consultPhysician: "________________________________",
            consultDiagnosis: "____________________________________________________________",
            consultTreatment: "____________________________________________________________",
            dentalComplaint: "____________________________________________________________",
            dentalService: "Oral Examination & Prophylaxis",
            dentalDentist: "________________________________",
            dentalCaries: "None / Mild / Mod / Severe",
            dentalGums: "Healthy / Gingivitis",
            dentalDentures: "None / Upper / Lower",
            dentalHygiene: "Good / Fair / Poor",
            dentalNotes: "____________________________________________________________",
            pastMedical: [],
            surgProc: "None",
            surgYear: "",
            surgStatus: "",
            familyHistory: [],
            ros: [],
            remarks: "____________________________________________________________",
            labExam: "____________________________________________________________"
        };

        const orig = hssoRecords;
        hssoRecords = [blankRec, ...orig];
        viewHssoRecord(9999);
        hssoRecords = orig;
    }

    function exportHssoData() {
        alert("Exporting MSU Health Services Unit Medical Record Masterlist (HSSO FORM - 01) to CSV/Excel...");
    }

    // Initialize on DOM Ready
    $(document).ready(function() {
        hssoRecords = loadHssoRecordsFromStorage();
        renderHssoTable(hssoRecords);
        updateKpis();
    });
</script>