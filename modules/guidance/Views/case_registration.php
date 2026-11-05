<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: CASE REGISTRATION WORKFLOW     -->
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
                    <a href="<?= url('guidance/cases') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Case Management
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Case Registration
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Case Registration
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Follow the sequential counseling workflow: Case Intake, Assessment, Intervention Plan, Monitoring,
                    and Case Closure.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge"
                    style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 13px; font-weight: 600; padding: 8px 14px; border-radius: 6px;">
                    <i class="bi bi-folder-plus me-1"></i>New Case ID: <span id="displayCaseId">CAS-2026-013</span>
                </span>
                <a href="<?= url('guidance/referrals') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    style="font-size: 14px; height: 38px; border-radius: 6px; padding: 0 14px; font-weight: 500;">
                    <i class="bi bi-arrow-left-right me-1"></i>View Referrals
                </a>
                <a href="<?= url('guidance/cases') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    style="font-size: 14px; height: 38px; border-radius: 6px; padding: 0 14px; font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>Back to Cases
                </a>
            </div>
        </div>
    </div>
</div>

<!-- STYLES FOR WORKFLOW & STEPPER -->
<style>
    /* Stepper Container */
    .workflow-stepper-container {
        position: relative;
        background-color: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 22px 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        margin-bottom: 20px;
    }

    .stepper-progress-bar-bg {
        position: absolute;
        top: 46px;
        left: 8%;
        right: 8%;
        height: 3px;
        background-color: #E2E8F0;
        z-index: 1;
    }

    .stepper-progress-bar-fill {
        height: 100%;
        background-color: #800020;
        width: 0%;
        transition: width 0.35s ease-in-out;
    }

    .stepper-items-wrapper {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        z-index: 2;
    }

    .step-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        cursor: pointer;
        user-select: none;
        padding: 0 6px;
        background: transparent;
        border: none;
    }

    .step-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 8px;
        transition: all 0.25s ease-in-out;
        background-color: #F8FAFC;
        border: 2px solid #CBD5E1;
        color: #64748B;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    /* Active Step */
    .step-item.active .step-circle {
        background-color: #800020 !important;
        border-color: #800020 !important;
        color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(128, 0, 32, 0.18), 0 4px 10px rgba(128, 0, 32, 0.25) !important;
    }

    .step-item.active .step-label {
        color: #800020 !important;
        font-weight: 700 !important;
    }

    /* Completed Step */
    .step-item.completed .step-circle {
        background-color: #166534 !important;
        border-color: #166534 !important;
        color: #ffffff !important;
    }

    .step-item.completed .step-label {
        color: #166534 !important;
        font-weight: 600 !important;
    }

    .step-label {
        font-size: 13.5px;
        font-weight: 600;
        color: #64748B;
        line-height: 1.25;
        margin-bottom: 2px;
    }

    .step-subtext {
        font-size: 11.5px;
        color: #94A3B8;
        display: block;
        line-height: 1.2;
    }

    /* Step Card Panels */
    .step-panel {
        display: none;
        animation: fadeIn 0.25s ease-in-out;
    }

    .step-panel.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Client Type Selector */
    .client-type-btn {
        border: 2px solid #E2E8F0;
        background-color: #F8FAFC;
        border-radius: 8px;
        padding: 10px 22px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        color: #475569;
        transition: all 0.18s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        user-select: none;
    }

    .client-type-btn:hover {
        border-color: #800020;
        color: #800020;
    }

    .client-type-btn.active {
        border-color: #800020 !important;
        background-color: #FDF2F4 !important;
        color: #800020 !important;
        box-shadow: 0 2px 8px rgba(128, 0, 32, 0.12) !important;
    }

    /* Section Sub-Cards */
    .referral-subcard {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 14px;
    }

    .referral-subcard-title {
        font-size: 13.5px;
        font-weight: 700;
        color: #1E293B;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 6px;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Overall Timeline in Case Closure */
    .timeline-milestone {
        position: relative;
        padding-left: 48px;
        padding-bottom: 26px;
    }

    .timeline-milestone:last-child {
        padding-bottom: 0;
    }

    .timeline-milestone::before {
        content: '';
        position: absolute;
        left: 17px;
        top: 36px;
        bottom: 0;
        width: 2px;
        background-color: #CBD5E1;
    }

    .timeline-milestone:last-child::before {
        display: none;
    }

    .timeline-milestone-icon {
        position: absolute;
        left: 0;
        top: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        color: #ffffff;
        z-index: 2;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #800020 !important;
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.15) !important;
    }

    @media print {

        .workflow-stepper-container,
        .btn,
        .breadcrumb,
        #toastBox {
            display: none !important;
        }

        .step-panel {
            display: block !important;
        }
    }
</style>

<!-- 2. HORIZONTAL STEPPER WORKFLOW -->
<div class="workflow-stepper-container">
    <div class="stepper-progress-bar-bg">
        <div class="stepper-progress-bar-fill" id="stepperProgressFill"></div>
    </div>
    <div class="stepper-items-wrapper">
        <!-- Step 1: Case Intake -->
        <div class="step-item active" id="step-nav-1" onclick="navigateToStep(1)">
            <div class="step-circle" id="circle-1">
                <span class="step-num">1</span>
            </div>
            <div class="step-label">Case Intake</div>
            <span class="step-subtext">Client Profile &amp; Referral</span>
        </div>

        <!-- Step 2: Case Assessment -->
        <div class="step-item" id="step-nav-2" onclick="navigateToStep(2)">
            <div class="step-circle" id="circle-2">
                <span class="step-num">2</span>
            </div>
            <div class="step-label">Case Assessment</div>
            <span class="step-subtext">Activity &amp; Tools</span>
        </div>

        <!-- Step 3: Intervention & Case Plan -->
        <div class="step-item" id="step-nav-3" onclick="navigateToStep(3)">
            <div class="step-circle" id="circle-3">
                <span class="step-num">3</span>
            </div>
            <div class="step-label">Intervention &amp; Plan</div>
            <span class="step-subtext">Assigned Counselor &amp; Actions</span>
        </div>

        <!-- Step 4: Monitoring & Follow-Up -->
        <div class="step-item" id="step-nav-4" onclick="navigateToStep(4)">
            <div class="step-circle" id="circle-4">
                <span class="step-num">4</span>
            </div>
            <div class="step-label">Monitoring &amp; Follow-Up</div>
            <span class="step-subtext">Schedule of Return</span>
        </div>

        <!-- Step 5: Case Closure -->
        <div class="step-item" id="step-nav-5" onclick="navigateToStep(5)">
            <div class="step-circle" id="circle-5">
                <span class="step-num">5</span>
            </div>
            <div class="step-label">Case Closure</div>
            <span class="step-subtext">Overall Timeline</span>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- TOP STUDENT INFORMATION SUMMARY CARD (SHOWN ON STEPS 2, 3, 4, 5)     -->
<!-- ==================================================================== -->
<div id="studentSummaryCard" class="card shadow-sm border-0 mb-4 bg-white"
    style="display: none; border: 1px solid #E2E8F0 !important; border-left: 4px solid #800020 !important; border-radius: 8px;">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2 pb-2"
            style="border-bottom: 1px solid #F1F5F9;">
            <div class="d-flex align-items-center gap-2">
                <span class="badge"
                    style="background-color: #FDF2F4; color: #800020; font-size: 11.5px; font-weight: 700; padding: 4px 8px; border-radius: 4px;">
                    Client Profile
                </span>
                <span class="fw-bold text-dark" style="font-size: 15px;" id="topStudentName">—</span>
                <span class="text-muted" style="font-size: 13.5px;" id="topStudentID"></span>
                <span id="topReferralBadge" class="badge"
                    style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; display: none;">
                    Faculty/Staff Referral
                </span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark border" id="topClientType"
                    style="font-size: 12px; font-weight: 600;">Enrolled Student</span>
                <button type="button" class="btn btn-sm btn-outline-secondary shadow-none py-0 px-2"
                    onclick="navigateToStep(1)" style="font-size: 12px; height: 26px;">
                    <i class="bi bi-pencil-square me-1"></i>Edit Intake
                </button>
            </div>
        </div>
        <div class="row g-2 text-dark" style="font-size: 13px;">
            <div class="col-md-3 col-sm-6 col-12">
                <span class="text-muted d-block" style="font-size: 11.5px;">College / Department:</span>
                <span class="fw-semibold" id="topCollege">—</span>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <span class="text-muted d-block" style="font-size: 11.5px;">Program &amp; Year:</span>
                <span class="fw-semibold" id="topProgramYear">—</span>
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                <span class="text-muted d-block" style="font-size: 11.5px;">Gender:</span>
                <span class="fw-semibold" id="topGender">—</span>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <span class="text-muted d-block" style="font-size: 11.5px;">Consultation Reason:</span>
                <span class="badge"
                    style="background-color: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; font-size: 12px;"
                    id="topReason">—</span>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- STEP 1: CASE INTAKE (CLIENT IDENTIFICATION & REASON)                 -->
<!-- ==================================================================== -->
<div class="step-panel active" id="panel-step-1">
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-bottom: 1px solid #E2E8F0;">
            <div class="d-flex align-items-center gap-2">
                <span
                    style="width: 32px; height: 32px; border-radius: 6px; background-color: #FDF2F4; color: #800020; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="bi bi-person-vcard-fill"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 17px;">Step 1: Case Intake</h5>
                    <small class="text-muted">Select client classification: Enrolled Student or Faculty/Staff</small>
                </div>
            </div>
            <span class="badge"
                style="background-color: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                Intake Stage
            </span>
        </div>

        <div class="card-body p-4">
            <!-- Client Classification Selection: Enrolled Student and Faculty/Staff ONLY -->
            <div class="mb-4">
                <label class="form-label fw-bold text-dark mb-2" style="font-size: 14px;">
                    Client Classification <span class="text-danger">*</span>
                </label>
                <div class="d-flex flex-wrap gap-2">
                    <div class="client-type-btn active" id="typeBtnStudent" onclick="setIntakeType('student')">
                        <i class="bi bi-mortarboard-fill fs-5"></i>
                        <span>Enrolled Student</span>
                    </div>
                    <div class="client-type-btn" id="typeBtnFaculty" onclick="setIntakeType('faculty')">
                        <i class="bi bi-person-lines-fill fs-5"></i>
                        <span>Faculty/Staff</span>
                    </div>
                </div>
                <input type="hidden" id="client_type" value="Enrolled Student">
                <input type="hidden" id="intake_mode" value="student">
            </div>

            <!-- ================================================================ -->
            <!-- FACULTY / STAFF REFERRAL SECTION (ORGANIZED & DIRECT)            -->
            <!-- ================================================================ -->
            <div id="facultyReferralSection" class="p-3 mb-4 rounded-3 bg-light border"
                style="display: none; border-left: 4px solid #800020 !important;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 14.5px;">
                        <i class="bi bi-person-lines-fill me-2" style="color: #800020;"></i>
                        Referring Faculty / Staff Information
                    </h6>
                    <span class="badge"
                        style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11.5px;">
                        Internal Referral Form
                    </span>
                </div>
                <p class="text-muted mb-3" style="font-size: 13px;">
                    Enter referring teacher details, primary reason for referral, and other observations before looking
                    up the student client.
                </p>

                <!-- Basic Faculty Details -->
                <div class="row g-3 mb-3">
                    <div class="col-md-3 col-sm-6 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13px;">
                            Date of Referral <span class="text-danger">*</span>
                        </label>
                        <input type="date" id="faculty_ref_date" class="form-control" value="<?= date('Y-m-d') ?>"
                            style="height: 40px; font-size: 14px; border-color: #CBD5E1;">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13px;">
                            Referred by (Teacher's Name) <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="faculty_name" class="form-control"
                            placeholder="Enter Teacher's Name (e.g. Prof. Danilo Navarro)" value=""
                            style="height: 40px; font-size: 14px; border-color: #CBD5E1;">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13px;">
                            Department/College <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="faculty_dept" class="form-control"
                            placeholder="Enter Department/College (e.g. CICT)" value=""
                            style="height: 40px; font-size: 14px; border-color: #CBD5E1;">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13px;">
                            Teacher's Contact Information <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="faculty_contact" class="form-control"
                            placeholder="Phone or Email (e.g. 0912-345-6789)" value=""
                            style="height: 40px; font-size: 14px; border-color: #CBD5E1;">
                    </div>
                </div>

                <!-- Reason for Referral & Other Observations -->
                <div class="row g-3">
                    <div class="col-md-5 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13px;">
                            Reason for Referral <span class="text-danger">*</span>
                        </label>
                        <select id="faculty_reason_referral" class="form-select"
                            style="height: 40px; font-size: 14px; border-color: #CBD5E1;">
                            <option value="" selected disabled>Select Reason for Referral...</option>
                            <option value="Academic Problem / Concern">Academic Problem / Concern</option>
                            <option value="Career Related Concerns">Career Related Concerns</option>
                            <option value="Emotional or Psychological Concerns">Emotional or Psychological Concerns
                            </option>
                            <option value="Behavioral Changes">Behavioral Changes</option>
                            <option value="Emotional Distress">Emotional Distress</option>
                            <option value="Physical Symptoms">Physical Symptoms</option>
                            <option value="Social and Relationship Issues">Social and Relationship Issues</option>
                            <option value="Substance Use">Substance Use</option>
                            <option value="Other Concerns">Other Concerns</option>
                        </select>
                    </div>
                    <div class="col-md-7 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13px;">
                            Other Observations
                        </label>
                        <textarea id="faculty_other_observations" class="form-control" rows="2"
                            placeholder="Please specify symptoms or observed behaviors in the student (e.g. withdrawal, drop in grades, frequent absences)..."
                            style="font-size: 13.5px; border-color: #CBD5E1; line-height: 1.5;"></textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION HEADER FOR CLIENT / STUDENT DETAILS -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                <div>
                    <h6 class="fw-bold text-dark mb-0" id="clientSectionTitle" style="font-size: 15px;">
                        Student Client Information
                    </h6>
                    <small class="text-muted" id="clientSectionSubtitle">
                        Enter Student ID to automatically pull information from the Student Directory list
                    </small>
                </div>
                <!-- Button to Open Student Directory List Modal -->
                <button type="button"
                    class="btn btn-sm btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    data-bs-toggle="modal" data-bs-target="#studentDirectoryModal" id="btnOpenDirectoryModal"
                    style="height: 34px; font-size: 13px; font-weight: 500; border-radius: 6px;">
                    <i class="bi bi-person-lines-fill me-1 text-primary"></i>Browse Student Directory List
                </button>
            </div>

            <!-- Client Identification Inputs Grid with Student Directory Auto-Fill -->
            <div class="row g-3 mb-4">
                <!-- Student ID with Live Directory Auto-Lookup -->
                <div class="col-md-4 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" id="lblClientId" style="font-size: 13.5px;">
                        Student ID <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" id="client_id" class="form-control"
                            placeholder="Enter Student ID (e.g. 2023-01089)" list="studentDirectoryDatalist"
                            oninput="lookupStudentById(this.value)" value=""
                            style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <button class="btn btn-outline-secondary shadow-none" type="button"
                            onclick="lookupStudentById(document.getElementById('client_id').value)"
                            title="Look up in directory">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- Autocomplete Datalist for Fast ID Selection -->
                    <datalist id="studentDirectoryDatalist">
                        <option value="2023-01089">RAMOS, CARLOS M. - CICT (BSIT)</option>
                        <option value="2023-01042">SANTOS, MARIA C. - CAS (BaPOS)</option>
                        <option value="2022-00512">MENDOZA, JUAN B. - CED (BEED)</option>
                        <option value="2024-03115">DELA CRUZ, BEA L. - CBA (BSTM)</option>
                        <option value="2023-02194">REYES, MARK ANTHONY - CEA (BSCE)</option>
                        <option value="2024-01582">GONZALES, ALYSSA P. - CNHS (BSN)</option>
                        <option value="2022-03481">BAUTISTA, KEVIN R. - CAFES (BSA)</option>
                        <option value="2023-04129">VILLANUEVA, PATRICIA M. - CBA (BSA)</option>
                        <option value="2024-00871">AQUINO, CHRISTIAN J. - CED (BSEd)</option>
                        <option value="2022-01934">CASTRO, DIANA MAE - CNHS (BSN)</option>
                        <option value="2023-03712">FLORES, GABRIEL S. - CEA (BSEE)</option>
                        <option value="2024-02205">TAN, JUSTINE CHLOE - CAS (BS Bio)</option>
                    </datalist>

                    <!-- Live Lookup Indicator Badge -->
                    <div id="directoryLookupBadge" class="mt-2" style="font-size: 12px; display: none;"></div>
                </div>

                <!-- Full Name -->
                <div class="col-md-5 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Full Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="client_name" class="form-control" placeholder="Enter Full Name" value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>

                <!-- Gender -->
                <div class="col-md-3 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Gender <span class="text-danger">*</span>
                    </label>
                    <select id="client_gender" class="form-select"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select Gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Prefer not to say">Prefer not to say</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- College / Department -->
                <div class="col-md-5 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        College / Department <span class="text-danger">*</span>
                    </label>
                    <select id="client_college" class="form-select"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select College / Department...</option>
                        <option value="College of Education (CED)">College of Education (CED)</option>
                        <option value="College of Arts and Sciences (CAS)">College of Arts and Sciences (CAS)</option>
                        <option value="College of Business and Accountancy (CBA)">College of Business and Accountancy
                            (CBA)</option>
                        <option value="College of Engineering and Architecture (CEA)">College of Engineering and
                            Architecture (CEA)</option>
                        <option value="College of Information and Communications Technology (CICT)">College of
                            Information and Communications Technology (CICT)</option>
                        <option value="College of Nursing and Health Sciences (CNHS)">College of Nursing and Health
                            Sciences (CNHS)</option>
                        <option value="College of Agriculture, Forestry and Environmental Sciences (CAFES)">College of
                            Agriculture, Forestry and Environmental Sciences (CAFES)</option>
                        <option value="College of Fisheries and Aquatic Sciences (CFAS)">College of Fisheries and
                            Aquatic Sciences (CFAS)</option>
                        <option value="College of Governance and Public Policy (CGPP)">College of Governance and Public
                            Policy (CGPP)</option>
                        <option value="Administrative Office">Administrative Office</option>
                    </select>
                </div>

                <!-- Program / Course -->
                <div class="col-md-4 col-sm-7 col-12" id="programCol">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Program / Course <span class="text-danger">*</span>
                    </label>
                    <select id="client_program" class="form-select"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select Program...</option>
                        <option value="BSIS">BSIS</option>
                        <option value="BSTM">BSTM</option>
                        <option value="BEED">BEED</option>
                        <option value="BaPOS">BaPOS</option>
                    </select>
                </div>

                <!-- Year Level -->
                <div class="col-md-3 col-sm-5 col-12" id="yearLevelCol">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Year Level <span class="text-danger">*</span>
                    </label>
                    <select id="client_year" class="form-select"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select Year Level...</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>
            </div>

            <hr class="my-4" style="border-color: #E2E8F0;">

            <!-- Consultation Reason Selection & Other Inquiries Input -->
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Consultation Reason <span class="text-danger">*</span>
                    </label>
                    <select id="consultation_reason" class="form-select" onchange="handleReasonChange(this.value)"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select Consultation Reason...</option>
                        <option value="Academic &amp; Study Habits">Academic &amp; Study Habits</option>
                        <option value="Mental Health &amp; Well-Being">Mental Health &amp; Well-Being</option>
                        <option value="Family &amp; Personal Relationships">Family &amp; Personal Relationships</option>
                        <option value="Career &amp; Future Direction">Career &amp; Future Direction</option>
                        <option value="Diverse Learning &amp; PWD Support">Diverse Learning &amp; PWD Support</option>
                        <option value="Financial Assistance">Financial Assistance</option>
                        <option value="Behavioral &amp; Conduct">Behavioral &amp; Conduct</option>
                        <option value="Other Inquiries">Other Inquiries</option>
                    </select>
                </div>

                <div class="col-md-6 col-12" id="otherInquiryBox" style="display: none;">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Specify Other Inquiry <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="other_inquiry_text" class="form-control"
                        placeholder="Type specific inquiry or concern here..." value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>
            </div>

            <!-- Client Concern Statement / Intake Notes -->
            <div class="mb-2">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Initial Intake Statement &amp; Notes
                </label>
                <textarea id="intake_statement" class="form-control" rows="3"
                    placeholder="Enter client's statement or intake notes..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>
        </div>

        <!-- Step 1 Footer Buttons: Cancel and Open Case Files -->
        <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-top: 1px solid #E2E8F0;">
            <button type="button" class="btn btn-outline-secondary shadow-none px-4" onclick="cancelCaseIntake()"
                style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500;">
                <i class="bi bi-x-circle me-1"></i>Cancel
            </button>

            <button type="button" class="btn text-white shadow-none px-4" onclick="submitStep1AndOpenCase()"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 40px; border-radius: 6px; font-weight: 600;">
                <i class="bi bi-folder-check me-2"></i>Open Case Files &amp; Proceed to Assessment
            </button>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- STEP 2: CASE ASSESSMENT (ACTIVITY, FINDINGS, OBSERVATION, TOOLS)     -->
<!-- ==================================================================== -->
<div class="step-panel" id="panel-step-2">
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-bottom: 1px solid #E2E8F0;">
            <div class="d-flex align-items-center gap-2">
                <span
                    style="width: 32px; height: 32px; border-radius: 6px; background-color: #FDF2F4; color: #800020; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 17px;">Step 2: Case Assessment</h5>
                    <small class="text-muted">Enter assessment activity, tools used, counselor observations, and
                        findings</small>
                </div>
            </div>
            <span class="badge"
                style="background-color: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                Assessment Stage
            </span>
        </div>

        <div class="card-body p-4">
            <div class="row g-3 mb-4">
                <!-- Assessment Date -->
                <div class="col-md-4 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Assessment Date <span class="text-danger">*</span>
                    </label>
                    <input type="date" id="assessment_date" class="form-control" value="<?= date('Y-m-d') ?>"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>

                <!-- Activity Given (e.g. Drawing) -->
                <div class="col-md-4 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Activity Given <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="assessment_activity" class="form-control"
                        placeholder="Enter activity (e.g. Drawing activity, self-reflection exercise)" value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>

                <!-- Assessment Tool (e.g. Ballpen, Paper) -->
                <div class="col-md-4 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Assessment Tool Used <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="assessment_tool" class="form-control"
                        placeholder="Enter tool used (e.g. Ballpen, bond paper, assessment sheet)" value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>
            </div>

            <!-- Counselor Observation -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Counselor Observation <span class="text-danger">*</span>
                </label>
                <textarea id="counselor_observation" class="form-control" rows="3"
                    placeholder="Describe counselor observations, student behavior, posture, and reactions during activity..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>

            <!-- Assessment Findings -->
            <div class="mb-2">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Findings <span class="text-danger">*</span>
                </label>
                <textarea id="assessment_findings" class="form-control" rows="3"
                    placeholder="Enter assessment findings, evaluated difficulties, and impressions..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>
        </div>

        <!-- Step 2 Footer Buttons -->
        <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-top: 1px solid #E2E8F0;">
            <button type="button" class="btn btn-outline-secondary shadow-none px-4" onclick="navigateToStep(1)"
                style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500;">
                <i class="bi bi-arrow-left me-1"></i>Back to Case Intake
            </button>

            <button type="button" class="btn text-white shadow-none px-4" onclick="saveAssessmentAndContinue()"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 40px; border-radius: 6px; font-weight: 600;">
                <i class="bi bi-check2-circle me-2"></i>Save Assessment &amp; Proceed to Plan
            </button>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- STEP 3: INTERVENTION & CASE PLAN (WITH ACTIONS TAKEN & COMMENTS)     -->
<!-- ==================================================================== -->
<div class="step-panel" id="panel-step-3">
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-bottom: 1px solid #E2E8F0;">
            <div class="d-flex align-items-center gap-2">
                <span
                    style="width: 32px; height: 32px; border-radius: 6px; background-color: #FDF2F4; color: #800020; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="bi bi-diagram-3-fill"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 17px;">Step 3: Intervention &amp; Case Plan
                    </h5>
                    <small class="text-muted">Enter modality, assigned counselor, actions taken, target goals, and
                        additional comments</small>
                </div>
            </div>
            <span class="badge"
                style="background-color: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                Plan Stage
            </span>
        </div>

        <div class="card-body p-4">
            <div class="row g-3 mb-4">
                <!-- Intervention Type -->
                <div class="col-md-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Intervention Type / Modality <span class="text-danger">*</span>
                    </label>
                    <select id="intervention_type" class="form-select"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select Intervention Modality...</option>
                        <option value="Individual Cognitive-Behavioral Counseling">Individual Cognitive-Behavioral
                            Counseling</option>
                        <option value="Academic Coaching &amp; Study Skills Plan">Academic Coaching &amp; Study Skills
                            Plan</option>
                        <option value="Stress Management &amp; Relaxation Techniques">Stress Management &amp; Relaxation
                            Techniques</option>
                        <option value="Solution-Focused Brief Counseling">Solution-Focused Brief Counseling</option>
                        <option value="Peer Mediation Support">Peer Mediation Support</option>
                        <option value="Other Custom Intervention">Other Custom Intervention</option>
                    </select>
                </div>

                <!-- Assigned Counselor (Single Fixed Counselor) -->
                <div class="col-md-3 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Assigned Counselor <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="assigned_counselor" class="form-control bg-light text-dark fw-semibold"
                        value="Dr. Elena Santos, RGC" readonly
                        style="height: 42px; font-size: 14px; border-color: #CBD5E1; cursor: not-allowed;">
                    <small class="text-muted" style="font-size: 11px;">Designated Guidance Counselor</small>
                </div>

                <!-- Planned Sessions -->
                <div class="col-md-3 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Target Timeline / Sessions <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="target_timeline" class="form-control"
                        placeholder="e.g. 3 to 4 Weekly Sessions" value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>
            </div>

            <!-- ACTIONS TAKEN (IF ANY) - PLACED IN INTERVENTION AS REQUESTED -->
            <div class="p-3 mb-4 rounded-3 border" id="interventionActionsBox"
                style="background-color: #F8FAFC; border-color: #CBD5E1 !important;">
                <label class="form-label fw-bold text-dark mb-2" style="font-size: 14px;">
                    <i class="bi bi-check2-square me-1 text-primary"></i>Actions Taken (if any)
                </label>
                <div class="row g-2 mb-2">
                    <div class="col-md-4 col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="act_student"
                                value="Discussion with student">
                            <label class="form-check-label text-dark" for="act_student"
                                style="font-size: 13.5px;">Discussion with student</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="act_parents"
                                value="Discussion with parents/guardian">
                            <label class="form-check-label text-dark" for="act_parents"
                                style="font-size: 13.5px;">Discussion with parents/guardian</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="act_guidance"
                                value="Suggested the student seek help from the Guidance Office">
                            <label class="form-check-label text-dark" for="act_guidance"
                                style="font-size: 13.5px;">Suggested Guidance Office</label>
                        </div>
                    </div>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white">Other (Please specify):</span>
                    <input type="text" id="act_other" class="form-control" placeholder="Specify other actions taken...">
                </div>
            </div>

            <!-- Target Objectives / Goals -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Target Goals &amp; Objectives <span class="text-danger">*</span>
                </label>
                <textarea id="case_goals" class="form-control" rows="3"
                    placeholder="Enter specific goals (e.g. reduce exam anxiety, build weekly study timetable)..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>

            <!-- Case Plan & Action Steps -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Case Plan &amp; Action Steps <span class="text-danger">*</span>
                </label>
                <textarea id="case_plan_details" class="form-control" rows="3"
                    placeholder="Enter action steps, homework, and intervention activities..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>

            <!-- ADDITIONAL COMMENTS OR CONCERNS - PLACED IN INTERVENTION AS REQUESTED -->
            <div class="mb-2">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Additional Comments or Concerns
                </label>
                <textarea id="case_additional_comments" class="form-control" rows="3"
                    placeholder="Provide any additional comments, referral context, or counseling concerns..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>
        </div>

        <!-- Step 3 Footer Buttons -->
        <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-top: 1px solid #E2E8F0;">
            <button type="button" class="btn btn-outline-secondary shadow-none px-4" onclick="navigateToStep(2)"
                style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500;">
                <i class="bi bi-arrow-left me-1"></i>Back to Case Assessment
            </button>

            <button type="button" class="btn text-white shadow-none px-4" onclick="saveCasePlanAndContinue()"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 40px; border-radius: 6px; font-weight: 600;">
                <i class="bi bi-arrow-right-circle me-2"></i>Save Plan &amp; Proceed to Monitoring
            </button>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- STEP 4: MONITORING & FOLLOW-UP (CLASSIFICATION, RETURN, NOTES)       -->
<!-- ==================================================================== -->
<div class="step-panel" id="panel-step-4">
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-bottom: 1px solid #E2E8F0;">
            <div class="d-flex align-items-center gap-2">
                <span
                    style="width: 32px; height: 32px; border-radius: 6px; background-color: #FDF2F4; color: #800020; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="bi bi-arrow-repeat"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 17px;">Step 4: Monitoring &amp; Follow-Up</h5>
                    <small class="text-muted">Select or input monitoring classification, set schedule of return, and
                        write progress notes</small>
                </div>
            </div>
            <span class="badge"
                style="background-color: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                Monitoring Stage
            </span>
        </div>

        <div class="card-body p-4">
            <!-- Monitoring Classification: Select or Type/Input -->
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Select Monitoring Classification <span class="text-danger">*</span>
                    </label>
                    <select id="monitoring_select" class="form-select" onchange="handleMonitoringSelect(this.value)"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                        <option value="" selected disabled>Select Classification...</option>
                        <option value="Under Observation">Under Observation</option>
                        <option value="High Priority">High Priority</option>
                        <option value="On-going Intervention">On-going Intervention</option>
                        <option value="Stable Follow-Up">Stable Follow-Up</option>
                        <option value="Low Risk">Low Risk</option>
                        <option value="custom">Type Custom Classification...</option>
                    </select>
                </div>

                <div class="col-md-6 col-12" id="customClassificationBox" style="display: none;">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Type Classification <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="monitoring_classification" class="form-control" value=""
                        placeholder="Type custom classification..." oninput="syncStudentData()"
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>
            </div>

            <!-- Schedule of Return & Session Format (All Face-to-Face) -->
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Schedule of Return (Date) <span class="text-danger">*</span>
                    </label>
                    <input type="date" id="return_date" class="form-control" value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>

                <div class="col-md-4 col-sm-6 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Schedule of Return (Time) <span class="text-danger">*</span>
                    </label>
                    <input type="time" id="return_time" class="form-control" value=""
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                </div>

                <div class="col-md-4 col-12">
                    <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                        Session Format
                    </label>
                    <input type="text" id="return_format" class="form-control bg-light text-dark fw-medium"
                        value="Face-to-Face" readonly
                        style="height: 42px; font-size: 14.5px; border-color: #CBD5E1; cursor: not-allowed;">
                    <small class="text-muted" style="font-size: 11.5px;">All counseling sessions are conducted
                        Face-to-Face.</small>
                </div>
            </div>

            <!-- Progress Note -->
            <div class="mb-2">
                <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                    Progress Note <span class="text-danger">*</span>
                </label>
                <textarea id="progress_note" class="form-control" rows="3"
                    placeholder="Enter notes on student progress, behavior, and scheduled return..."
                    style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
            </div>
        </div>

        <!-- Step 4 Footer Buttons: Schedule Return Button -->
        <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-top: 1px solid #E2E8F0;">
            <button type="button" class="btn btn-outline-secondary shadow-none px-4" onclick="navigateToStep(3)"
                style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500;">
                <i class="bi bi-arrow-left me-1"></i>Back to Intervention
            </button>

            <button type="button" class="btn text-white shadow-none px-4" onclick="scheduleReturnAndContinue()"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 40px; border-radius: 6px; font-weight: 600;">
                <i class="bi bi-calendar-check me-2"></i>Schedule Return &amp; Proceed to Case Closure
            </button>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- STEP 5: CASE CLOSURE (OVERALL TIMELINE & FINAL DISPOSITION)          -->
<!-- ==================================================================== -->
<div class="step-panel" id="panel-step-5">
    <div class="card shadow-sm border-0 mb-4 bg-white"
        style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
            style="border-bottom: 1px solid #E2E8F0;">
            <div class="d-flex align-items-center gap-2">
                <span
                    style="width: 32px; height: 32px; border-radius: 6px; background-color: #FDF2F4; color: #800020; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="bi bi-check2-circle"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 17px;">Step 5: Case Closure &amp; Overall
                        Timeline</h5>
                    <small class="text-muted">Review the complete case workflow timeline from intake to intervention,
                        and set case disposition</small>
                </div>
            </div>
            <span class="badge"
                style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                Final Stage
            </span>
        </div>

        <div class="card-body p-4">
            <!-- OVERALL TIMELINE DISPLAY (Case Intake -> Assessment -> Intervention -> Monitoring) -->
            <div class="bg-light p-4 rounded-3 mb-4" style="border: 1px solid #E2E8F0;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
                        <i class="bi bi-clock-history me-1 text-danger" style="color: #800020 !important;"></i>
                        Overall Case Workflow Timeline
                    </h6>
                    <span class="text-muted" style="font-size: 12.5px;">Summary from Intake to Intervention</span>
                </div>

                <div class="timeline-container px-2 pt-2">
                    <!-- Step 1: Case Intake -->
                    <div class="timeline-milestone">
                        <div class="timeline-milestone-icon" style="background-color: #800020;">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <div class="bg-white p-3 rounded-2 shadow-xs border" style="border-color: #E2E8F0 !important;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                                <span class="fw-bold text-dark" style="font-size: 14.5px;">Step 1: Case Intake</span>
                                <span class="badge bg-light text-secondary border"
                                    style="font-size: 11.5px;"><?= date('M d, Y') ?></span>
                            </div>
                            <div class="row g-2 mb-2" style="font-size: 13.5px;">
                                <div class="col-md-4 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Client:</span>
                                    <span class="fw-bold text-dark" id="tl_client_name">—</span>
                                    <span class="text-muted" id="tl_client_id"></span>
                                </div>
                                <div class="col-md-4 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">College &amp;
                                        Program:</span>
                                    <span class="text-dark fw-medium" id="tl_client_college">—</span>
                                </div>
                                <div class="col-md-4 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Consultation
                                        Reason:</span>
                                    <span class="badge"
                                        style="background-color: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; font-size: 12px;"
                                        id="tl_consultation_reason">—</span>
                                </div>
                            </div>

                            <!-- Referral Information Tag (Faculty Referral) -->
                            <div id="tl_referral_info" class="p-2 mb-2 rounded bg-light border"
                                style="font-size: 12.5px; display: none;">
                                <span class="badge bg-primary text-white me-1">Faculty/Staff Referral</span>
                                <span class="text-dark fw-semibold" id="tl_referring_faculty_text">—</span>
                                <div class="text-muted small mt-1" id="tl_referral_sub_summary"></div>
                            </div>

                            <div class="p-2 rounded bg-light"
                                style="font-size: 13px; color: #475569; border-left: 3px solid #800020;"
                                id="tl_intake_statement">
                                "—"
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Case Assessment -->
                    <div class="timeline-milestone">
                        <div class="timeline-milestone-icon" style="background-color: #0284c7;">
                            <i class="bi bi-clipboard2-pulse-fill"></i>
                        </div>
                        <div class="bg-white p-3 rounded-2 shadow-xs border" style="border-color: #E2E8F0 !important;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                                <span class="fw-bold text-dark" style="font-size: 14.5px;">Step 2: Case
                                    Assessment</span>
                                <span class="badge bg-light text-secondary border" style="font-size: 11.5px;"
                                    id="tl_assessment_date"><?= date('M d, Y') ?></span>
                            </div>
                            <div class="row g-2 mb-2" style="font-size: 13.5px;">
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Activity Given:</span>
                                    <span class="fw-semibold text-dark" id="tl_assessment_activity">—</span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Tool Used:</span>
                                    <span class="fw-semibold text-dark" id="tl_assessment_tool">—</span>
                                </div>
                            </div>
                            <div class="p-2 rounded bg-light mb-2" style="font-size: 13px; color: #475569;">
                                <strong>Observation:</strong> <span id="tl_counselor_observation">—</span>
                            </div>
                            <div class="p-2 rounded bg-light"
                                style="font-size: 13px; color: #475569; border-left: 3px solid #0284c7;">
                                <strong>Findings:</strong> <span id="tl_assessment_findings">—</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Intervention & Case Plan -->
                    <div class="timeline-milestone">
                        <div class="timeline-milestone-icon" style="background-color: #7c3aed;">
                            <i class="bi bi-diagram-3-fill"></i>
                        </div>
                        <div class="bg-white p-3 rounded-2 shadow-xs border" style="border-color: #E2E8F0 !important;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                                <span class="fw-bold text-dark" style="font-size: 14.5px;">Step 3: Intervention &amp;
                                    Case Plan</span>
                                <span class="badge bg-light text-secondary border" style="font-size: 11.5px;"
                                    id="tl_assigned_counselor">Dr. Elena Santos, RGC</span>
                            </div>
                            <div class="row g-2 mb-2" style="font-size: 13.5px;">
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Modality:</span>
                                    <span class="fw-semibold text-dark" id="tl_intervention_type">—</span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Planned Timeline:</span>
                                    <span class="fw-semibold text-dark" id="tl_target_timeline">—</span>
                                </div>
                            </div>
                            <div class="p-2 rounded bg-light mb-2" style="font-size: 13px; color: #475569;"
                                id="tl_actions_box" style="display: none;">
                                <strong>Actions Taken:</strong> <span id="tl_actions_taken">—</span>
                            </div>
                            <div class="p-2 rounded bg-light mb-2" style="font-size: 13px; color: #475569;">
                                <strong>Target Goals:</strong> <span id="tl_case_goals">—</span>
                            </div>
                            <div class="p-2 rounded bg-light mb-2"
                                style="font-size: 13px; color: #475569; border-left: 3px solid #7c3aed;">
                                <strong>Action Steps:</strong> <span id="tl_case_plan_details">—</span>
                            </div>
                            <div class="p-2 rounded bg-light" style="font-size: 13px; color: #475569;"
                                id="tl_comments_box" style="display: none;">
                                <strong>Additional Comments:</strong> <span id="tl_additional_comments">—</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Monitoring & Follow-Up -->
                    <div class="timeline-milestone">
                        <div class="timeline-milestone-icon" style="background-color: #d97706;">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div class="bg-white p-3 rounded-2 shadow-xs border" style="border-color: #E2E8F0 !important;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                                <span class="fw-bold text-dark" style="font-size: 14.5px;">Step 4: Monitoring &amp;
                                    Follow-Up</span>
                                <span class="badge"
                                    style="background-color: #fffbeb; color: #92400e; border: 1px solid #fde68a; font-size: 12px;"
                                    id="tl_monitoring_classification">—</span>
                            </div>
                            <div class="row g-2 mb-2" style="font-size: 13.5px;">
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Scheduled Return:</span>
                                    <span class="fw-bold text-dark" id="tl_return_schedule">—</span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 12px;">Format:</span>
                                    <span class="fw-medium text-dark" id="tl_return_format">Face-to-Face</span>
                                </div>
                            </div>
                            <div class="p-2 rounded bg-light"
                                style="font-size: 13px; color: #475569; border-left: 3px solid #d97706;">
                                <strong>Progress Note:</strong> <span id="tl_progress_note">—</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Final Disposition & Closure Fields -->
            <div class="card p-3 border-0 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
                <h6 class="fw-bold text-dark mb-3" style="font-size: 15px;">
                    <i class="bi bi-clipboard2-check me-1 text-success"></i>Case Disposition
                </h6>

                <div class="row g-3 mb-3">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                            Case Disposition Status <span class="text-danger">*</span>
                        </label>
                        <select id="closure_disposition" class="form-select"
                            style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                            <option value="" selected disabled>Select Case Disposition...</option>
                            <option value="In Progress">Case Active - In Progress</option>
                            <option value="Under Observation">Under Observation</option>
                            <option value="On-going Intervention">On-going Intervention</option>
                            <option value="Closed">Case Closed</option>
                            <option value="Resolved">Case Resolved</option>
                            <option value="Referred to Other Office">Referred to Other Office</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                            Review Date <span class="text-danger">*</span>
                        </label>
                        <input type="date" id="closure_date" class="form-control" value="<?= date('Y-m-d') ?>"
                            style="height: 42px; font-size: 14.5px; border-color: #CBD5E1;">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-dark" style="font-size: 13.5px;">
                            Remarks &amp; Summary
                        </label>
                        <textarea id="closure_remarks" class="form-control" rows="2"
                            placeholder="Enter final remarks or case notes..."
                            style="font-size: 14.5px; border-color: #CBD5E1; line-height: 1.6;"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5 Footer Buttons: Finalize and Add to Cases -->
        <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2"
            style="border-top: 1px solid #E2E8F0;">
            <button type="button" class="btn btn-outline-secondary shadow-none px-4" onclick="navigateToStep(4)"
                style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500;">
                <i class="bi bi-arrow-left me-1"></i>Back to Monitoring
            </button>

            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary shadow-none px-3" onclick="window.print()"
                    style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500;">
                    <i class="bi bi-printer me-1"></i>Print Summary
                </button>

                <a href="<?= url('guidance/cases') ?>"
                    class="btn btn-outline-primary btn-outline-marsu shadow-none px-3"
                    style="font-size: 14px; height: 40px; border-radius: 6px; font-weight: 500; border-color: #800020; color: #800020;">
                    <i class="bi bi-list-check me-1"></i>View in Cases List
                </a>

                <button type="button" class="btn text-white shadow-none px-4" onclick="finalizeAndAddCase()"
                    style="background-color: #166534; border: 1px solid #166534; font-size: 14.5px; height: 40px; border-radius: 6px; font-weight: 600;">
                    <i class="bi bi-person-plus-fill me-2"></i>Finalize &amp; Add to Cases
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!-- STUDENT DIRECTORY LOOKUP MODAL (FRONT-END POPUP)                     -->
<!-- ==================================================================== -->
<div class="modal fade" id="studentDirectoryModal" tabindex="-1" aria-labelledby="studentDirectoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-3 px-4 text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-lines-fill fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="studentDirectoryModalLabel"
                            style="font-size: 16px;">
                            Student Directory Lists
                        </h6>
                        <small class="text-white-50" style="font-size: 12px;">Select a student from the directory to
                            auto-fill client information</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <!-- Search within Directory Modal -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="directoryModalSearch"
                            class="form-control border-start-0 shadow-none ps-2"
                            placeholder="Search directory by Student ID, Name, College, or Program..."
                            oninput="filterDirectoryModalList(this.value)">
                    </div>
                </div>

                <!-- Directory Table Container -->
                <div class="table-responsive" style="max-height: 380px;">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13.5px;">
                        <thead class="bg-light sticky-top">
                            <tr>
                                <th class="ps-3 py-2 text-dark">Student ID</th>
                                <th class="py-2 text-dark">Full Name</th>
                                <th class="py-2 text-dark">Program &amp; Year</th>
                                <th class="py-2 text-dark">College</th>
                                <th class="text-center pe-3 py-2 text-dark" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="directoryModalTableBody">
                            <!-- Populated dynamically via JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-light py-2 px-4 justify-content-between">
                <small class="text-muted">Showing enrolled students in MarSU directory</small>
                <button type="button" class="btn btn-secondary btn-sm shadow-none px-3" data-bs-dismiss="modal"
                    style="font-size: 13px;">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING TOAST NOTIFICATION BOX -->
<div id="toastBox" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>

<!-- VANILLA JAVASCRIPT WORKFLOW & SYNC ENGINE -->
<script>
    let currentStep = 1;
    const totalSteps = 5;

    // Student Directory Database (From MarSU Student Directory Lists)
    const studentDirectory = [
        { id: "2023-01089", name: "RAMOS, CARLOS M.", gender: "Male", college: "College of Information and Computing Sciences", program: "BSIS", year: "3rd Year", email: "carlos.ramos@gmail.com" },
        { id: "2023-01042", name: "SANTOS, MARIA C.", gender: "Female", college: "College of Arts and Sciences", program: "BaPOS", year: "2nd Year", email: "maria.santos@gmail.com" },
        { id: "2022-00512", name: "MENDOZA, JUAN B.", gender: "Male", college: "College of Education", program: "BEED", year: "3rd Year", email: "juan.mendoza@gmail.com" },
        { id: "2024-03115", name: "DELA CRUZ, BEA L.", gender: "Female", college: "College of Business and Accountancy", program: "BSTM", year: "1st Year", email: "bea.delacruz@gmail.com" },
        { id: "2023-02194", name: "REYES, MARK ANTHONY", gender: "Male", college: "College of Engineering and Architecture (CEA)", program: "BS Civil Engineering", year: "2nd Year", email: "mark.reyes@gmail.com" },
        { id: "2024-01582", name: "GONZALES, ALYSSA P.", gender: "Female", college: "College of Nursing and Health Sciences (CNHS)", program: "BS Nursing", year: "1st Year", email: "alyssa.gonzales@gmail.com" },
        { id: "2022-03481", name: "BAUTISTA, KEVIN R.", gender: "Male", college: "College of Agriculture, Forestry and Environmental Sciences (CAFES)", program: "BS Agriculture", year: "4th Year", email: "kevin.bautista@gmail.com" },
        { id: "2023-04129", name: "VILLANUEVA, PATRICIA M.", gender: "Female", college: "College of Business and Accountancy (CBA)", program: "BS Accountancy", year: "2nd Year", email: "patricia.villanueva@gmail.com" },
        { id: "2024-00871", name: "AQUINO, CHRISTIAN J.", gender: "Male", college: "College of Education (CED)", program: "BSEd English", year: "1st Year", email: "christian.aquino@gmail.com" },
        { id: "2022-01934", name: "CASTRO, DIANA MAE", gender: "Female", college: "College of Nursing and Health Sciences (CNHS)", program: "BS Nursing", year: "3rd Year", email: "diana.castro@gmail.com" },
        { id: "2023-03712", name: "FLORES, GABRIEL S.", gender: "Male", college: "College of Engineering and Architecture (CEA)", program: "BS Electrical Engineering", year: "2nd Year", email: "gabriel.flores@gmail.com" },
        { id: "2024-02205", name: "TAN, JUSTINE CHLOE", gender: "Female", college: "College of Arts and Sciences (CAS)", program: "BS Biology", year: "1st Year", email: "justine.tan@gmail.com" }
    ];

    document.addEventListener('DOMContentLoaded', function () {
        updateStepperUI();
        populateDirectoryModal(studentDirectory);
        syncStudentData();

        // Check if redirected from Faculty Referrals with a preselected student
        const incomingClientId = localStorage.getItem('marsu_selected_client_id');
        if (incomingClientId) {
            document.getElementById('client_id').value = incomingClientId;
            lookupStudentById(incomingClientId);
            setIntakeType('faculty');
            localStorage.removeItem('marsu_selected_client_id');
            showToast('Loaded referred student from Faculty Referrals!', 'success');
        }
    });

    /**
     * Populate Student Directory Modal Table
     */
    function populateDirectoryModal(list) {
        const tbody = document.getElementById('directoryModalTableBody');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No students matching search criteria.</td></tr>';
            return;
        }

        list.forEach(student => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="ps-3 fw-bold text-dark">${student.id}</td>
                <td>
                    <span class="fw-semibold text-dark">${student.name}</span>
                    <div class="text-muted" style="font-size: 11.5px;">${student.email}</div>
                </td>
                <td><span class="badge bg-light text-dark border">${student.program} - ${student.year}</span></td>
                <td><small class="text-secondary">${student.college}</small></td>
                <td class="text-center pe-3">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none"
                            onclick="selectStudentFromDirectory('${student.id}')"
                            style="font-size: 12px; padding: 2px 10px; border-radius: 4px;">
                        Select
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    /**
     * Filter Directory Modal Search
     */
    function filterDirectoryModalList(query) {
        const q = (query || '').toLowerCase().trim();
        if (!q) {
            populateDirectoryModal(studentDirectory);
            return;
        }

        const filtered = studentDirectory.filter(s =>
            s.id.toLowerCase().includes(q) ||
            s.name.toLowerCase().includes(q) ||
            s.program.toLowerCase().includes(q) ||
            s.college.toLowerCase().includes(q) ||
            s.email.toLowerCase().includes(q)
        );
        populateDirectoryModal(filtered);
    }

    /**
     * Select Student from Directory Modal
     */
    function selectStudentFromDirectory(studentId) {
        const student = studentDirectory.find(s => s.id === studentId);
        if (!student) return;

        document.getElementById('client_id').value = student.id;
        lookupStudentById(student.id);

        const modalEl = document.getElementById('studentDirectoryModal');
        if (modalEl) {
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
                modalInstance.hide();
            }
        }
        showToast('Loaded ' + student.name + ' from Student Directory!', 'success');
    }

    /**
     * Live Directory Lookup by Student ID
     */
    function lookupStudentById(inputVal) {
        const val = (inputVal || '').trim().toLowerCase();
        const badge = document.getElementById('directoryLookupBadge');
        if (!val) {
            if (badge) badge.style.display = 'none';
            syncStudentData();
            return;
        }

        const student = studentDirectory.find(s =>
            s.id.toLowerCase() === val ||
            s.id.toLowerCase().replace(/[^0-9]/g, '') === val.replace(/[^0-9]/g, '')
        );

        if (student) {
            document.getElementById('client_name').value = student.name;
            document.getElementById('client_gender').value = student.gender;
            document.getElementById('client_college').value = student.college;
            document.getElementById('client_program').value = student.program;
            document.getElementById('client_year').value = student.year;

            if (badge) {
                badge.style.display = 'block';
                badge.innerHTML = `
                    <div class="alert alert-success py-1 px-2 d-flex align-items-center justify-content-between mb-0" style="font-size: 12px; border-radius: 4px;">
                        <span><i class="bi bi-check-circle-fill me-1 text-success"></i>Directory: <strong>${student.name}</strong></span>
                        <span class="badge bg-success" style="font-size: 10px;">Auto-filled</span>
                    </div>
                `;
            }
        } else {
            if (badge) {
                badge.style.display = 'block';
                badge.innerHTML = `
                    <div class="alert alert-light border py-1 px-2 text-muted mb-0" style="font-size: 11.5px; border-radius: 4px;">
                        <i class="bi bi-info-circle me-1"></i>Custom ID. You may freely type client details.
                    </div>
                `;
            }
        }
        syncStudentData();
    }

    /**
     * Intake / Referral Type Handler (Enrolled Student and Faculty/Staff)
     */
    function setIntakeType(mode) {
        const btnStudent = document.getElementById('typeBtnStudent');
        const btnFaculty = document.getElementById('typeBtnFaculty');
        const facultySection = document.getElementById('facultyReferralSection');
        const clientTypeInput = document.getElementById('client_type');
        const intakeModeInput = document.getElementById('intake_mode');
        const clientSectionTitle = document.getElementById('clientSectionTitle');
        const clientSectionSubtitle = document.getElementById('clientSectionSubtitle');
        const lblClientId = document.getElementById('lblClientId');
        const clientIdInput = document.getElementById('client_id');

        btnStudent.classList.remove('active');
        btnFaculty.classList.remove('active');

        if (mode === 'faculty') {
            btnFaculty.classList.add('active');
            facultySection.style.display = 'block';
            clientTypeInput.value = 'Faculty/Staff';
            intakeModeInput.value = 'faculty';
            clientSectionTitle.innerHTML = '<i class="bi bi-person-check-fill me-1 text-primary"></i>Referred Student Client Information';
            clientSectionSubtitle.innerText = 'Enter or select the referred student\'s ID to auto-fill their profile from Student Directory';
            lblClientId.innerHTML = 'Referred Student ID <span class="text-danger">*</span>';
            clientIdInput.placeholder = 'Enter Student ID (e.g. 2023-01089)';
        } else {
            // Enrolled Student
            btnStudent.classList.add('active');
            facultySection.style.display = 'none';
            clientTypeInput.value = 'Enrolled Student';
            intakeModeInput.value = 'student';
            clientSectionTitle.innerHTML = 'Student Client Information';
            clientSectionSubtitle.innerText = 'Enter Student ID to automatically pull information from the Student Directory list';
            lblClientId.innerHTML = 'Student ID <span class="text-danger">*</span>';
            clientIdInput.placeholder = 'Enter Student ID (e.g. 2023-01089)';
        }
        syncStudentData();
    }

    /**
     * Navigate between workflow steps
     */
    function navigateToStep(stepNumber) {
        if (stepNumber < 1 || stepNumber > totalSteps) return;

        for (let i = 1; i <= totalSteps; i++) {
            const panel = document.getElementById('panel-step-' + i);
            if (panel) panel.classList.remove('active');
        }

        const targetPanel = document.getElementById('panel-step-' + stepNumber);
        if (targetPanel) {
            targetPanel.classList.add('active');
        }

        currentStep = stepNumber;

        const summaryCard = document.getElementById('studentSummaryCard');
        if (summaryCard) {
            if (currentStep >= 2) {
                summaryCard.style.display = 'block';
            } else {
                summaryCard.style.display = 'none';
            }
        }

        updateStepperUI();
        syncStudentData();
        window.scrollTo({ top: 120, behavior: 'smooth' });
    }

    /**
     * Update Stepper Circles, Colors, and Fill Bar
     */
    function updateStepperUI() {
        const progressFill = document.getElementById('stepperProgressFill');
        if (progressFill) {
            const percentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
            progressFill.style.width = percentage + '%';
        }

        for (let i = 1; i <= totalSteps; i++) {
            const stepItem = document.getElementById('step-nav-' + i);
            const circle = document.getElementById('circle-' + i);

            if (!stepItem || !circle) continue;

            stepItem.classList.remove('active', 'completed');

            if (i === currentStep) {
                stepItem.classList.add('active');
                circle.innerHTML = '<span class="step-num">' + i + '</span>';
            } else if (i < currentStep) {
                stepItem.classList.add('completed');
                circle.innerHTML = '<i class="bi bi-check-lg" style="font-size: 20px;"></i>';
            } else {
                circle.innerHTML = '<span class="step-num">' + i + '</span>';
            }
        }
    }

    /**
     * Consultation Reason Selection & Other Inquiries Handler
     */
    function handleReasonChange(value) {
        const otherBox = document.getElementById('otherInquiryBox');
        if (value === 'Other Inquiries') {
            if (otherBox) otherBox.style.display = 'block';
        } else {
            if (otherBox) otherBox.style.display = 'none';
        }
        syncStudentData();
    }

    /**
     * Monitoring Classification Select Handler
     */
    function handleMonitoringSelect(value) {
        const customBox = document.getElementById('customClassificationBox');
        const inputField = document.getElementById('monitoring_classification');
        if (!inputField) return;

        if (value === 'custom') {
            if (customBox) customBox.style.display = 'block';
            inputField.value = '';
            inputField.focus();
        } else {
            if (customBox) customBox.style.display = 'none';
            inputField.value = value;
        }
        syncStudentData();
    }

    /**
     * Step 1 Submit & Proceed to Step 2 Case Assessment
     */
    function submitStep1AndOpenCase() {
        const clientName = document.getElementById('client_name').value.trim();
        const clientId = document.getElementById('client_id').value.trim();

        if (!clientName || !clientId) {
            showToast('Please enter Student ID and Full Name to proceed.', 'warning');
            return;
        }

        const intakeMode = document.getElementById('intake_mode').value;
        if (intakeMode === 'faculty') {
            const fName = document.getElementById('faculty_name').value.trim();
            const fDept = document.getElementById('faculty_dept').value.trim();
            const fContact = document.getElementById('faculty_contact').value.trim();
            const fReason = document.getElementById('faculty_reason_referral').value;
            if (!fName || !fDept || !fContact || !fReason) {
                showToast('Please provide referring teacher\'s name, department, contact, and reason for referral.', 'warning');
                return;
            }
        }

        const reasonSelect = document.getElementById('consultation_reason').value;
        if (reasonSelect === 'Other Inquiries') {
            const otherText = document.getElementById('other_inquiry_text').value.trim();
            if (!otherText) {
                showToast('Please specify the other inquiry.', 'warning');
                return;
            }
        }

        syncStudentData();
        showToast('Client intake saved! Proceeding to Case Assessment.', 'success');
        navigateToStep(2);
    }

    /**
     * Step 2 Save Assessment & Continue
     */
    function saveAssessmentAndContinue() {
        const activity = document.getElementById('assessment_activity').value.trim();
        const tool = document.getElementById('assessment_tool').value.trim();
        const obs = document.getElementById('counselor_observation').value.trim();

        if (!activity || !tool || !obs) {
            showToast('Please complete assessment activity, tool, and observations.', 'warning');
            return;
        }

        syncStudentData();
        showToast('Assessment saved! Proceeding to Intervention & Case Plan.', 'success');
        navigateToStep(3);
    }

    /**
     * Step 3 Save Case Plan & Continue
     */
    function saveCasePlanAndContinue() {
        const goals = document.getElementById('case_goals').value.trim();
        const plan = document.getElementById('case_plan_details').value.trim();

        if (!goals || !plan) {
            showToast('Please enter target goals and action steps.', 'warning');
            return;
        }

        syncStudentData();
        showToast('Case plan saved! Proceeding to Monitoring & Follow-Up.', 'success');
        navigateToStep(4);
    }

    /**
     * Step 4 Schedule Return & Continue
     */
    function scheduleReturnAndContinue() {
        const returnDate = document.getElementById('return_date').value;
        const progressNote = document.getElementById('progress_note').value.trim();
        const selectVal = document.getElementById('monitoring_select').value;
        const inputVal = document.getElementById('monitoring_classification').value.trim();

        const classification = (selectVal === 'custom') ? inputVal : (selectVal || inputVal);

        if (!returnDate || !progressNote || !classification) {
            showToast('Please provide monitoring classification, return date, and progress note.', 'warning');
            return;
        }

        syncStudentData();
        showToast('Return scheduled! Proceeding to Case Closure.', 'success');
        navigateToStep(5);
    }

    /**
     * Helper to get checked actions taken in Step 3
     */
    function getActionsTakenSummary() {
        const checked = [];
        if (document.getElementById('act_student') && document.getElementById('act_student').checked) checked.push('Discussion with student');
        if (document.getElementById('act_parents') && document.getElementById('act_parents').checked) checked.push('Discussion with parents/guardian');
        if (document.getElementById('act_guidance') && document.getElementById('act_guidance').checked) checked.push('Suggested Guidance Office');

        const otherVal = document.getElementById('act_other') ? document.getElementById('act_other').value.trim() : '';
        if (otherVal) checked.push(otherVal);

        return checked.join(', ');
    }

    /**
     * Synchronize Form Data to Top Summary and Step 5 Timeline
     */
    function syncStudentData() {
        const cName = document.getElementById('client_name') ? document.getElementById('client_name').value.trim() : '';
        const cId = document.getElementById('client_id') ? document.getElementById('client_id').value.trim() : '';
        const cType = document.getElementById('client_type') ? document.getElementById('client_type').value : 'Enrolled Student';
        const intakeMode = document.getElementById('intake_mode') ? document.getElementById('intake_mode').value : 'student';
        const cCollege = document.getElementById('client_college') ? document.getElementById('client_college').value : '';
        const cProg = document.getElementById('client_program') ? document.getElementById('client_program').value.trim() : '';
        const cYear = document.getElementById('client_year') ? document.getElementById('client_year').value : '';
        const cGender = document.getElementById('client_gender') ? document.getElementById('client_gender').value : '';

        let cReason = document.getElementById('consultation_reason') ? document.getElementById('consultation_reason').value : '';
        if (cReason === 'Other Inquiries') {
            const otherVal = document.getElementById('other_inquiry_text') ? document.getElementById('other_inquiry_text').value.trim() : '';
            if (otherVal) cReason = otherVal;
        }
        const cStatement = document.getElementById('intake_statement') ? document.getElementById('intake_statement').value.trim() : '';

        // 1. Update Top Summary Card
        if (document.getElementById('topStudentName')) document.getElementById('topStudentName').textContent = cName || '—';
        if (document.getElementById('topStudentID')) document.getElementById('topStudentID').textContent = cId ? '(' + cId + ')' : '';
        if (document.getElementById('topClientType')) document.getElementById('topClientType').textContent = cType;
        if (document.getElementById('topCollege')) document.getElementById('topCollege').textContent = cCollege || '—';
        if (document.getElementById('topProgramYear')) document.getElementById('topProgramYear').textContent = (cProg || cYear) ? (cProg + (cYear ? ' - ' + cYear : '')) : '—';
        if (document.getElementById('topGender')) document.getElementById('topGender').textContent = cGender || '—';
        if (document.getElementById('topReason')) document.getElementById('topReason').textContent = cReason || '—';

        const refBadge = document.getElementById('topReferralBadge');
        if (refBadge) {
            if (intakeMode === 'faculty') {
                const fName = document.getElementById('faculty_name') ? document.getElementById('faculty_name').value.trim() : '';
                refBadge.style.display = 'inline-block';
                refBadge.textContent = fName ? 'Referred by ' + fName : 'Faculty/Staff Referral';
            } else {
                refBadge.style.display = 'none';
            }
        }

        // 2. Update Timeline Milestone 1
        if (document.getElementById('tl_client_name')) document.getElementById('tl_client_name').textContent = cName || '—';
        if (document.getElementById('tl_client_id')) document.getElementById('tl_client_id').textContent = cId ? '(' + cId + ')' : '';
        if (document.getElementById('tl_client_college')) document.getElementById('tl_client_college').textContent = (cProg || cCollege) ? (cProg + (cCollege ? ' (' + cCollege + ')' : '')) : '—';
        if (document.getElementById('tl_consultation_reason')) document.getElementById('tl_consultation_reason').textContent = cReason || '—';
        if (document.getElementById('tl_intake_statement')) document.getElementById('tl_intake_statement').textContent = cStatement ? '"' + cStatement + '"' : '—';

        const tlRefInfo = document.getElementById('tl_referral_info');
        const tlRefText = document.getElementById('tl_referring_faculty_text');
        const tlSubSummary = document.getElementById('tl_referral_sub_summary');

        if (tlRefInfo && tlRefText) {
            if (intakeMode === 'faculty') {
                const fName = document.getElementById('faculty_name') ? document.getElementById('faculty_name').value.trim() : '';
                const fDept = document.getElementById('faculty_dept') ? document.getElementById('faculty_dept').value.trim() : '';
                const fReason = document.getElementById('faculty_reason_referral') ? document.getElementById('faculty_reason_referral').value : '';
                const fObs = document.getElementById('faculty_other_observations') ? document.getElementById('faculty_other_observations').value.trim() : '';

                tlRefInfo.style.display = 'block';
                tlRefText.textContent = 'Teacher: ' + (fName || 'Faculty') + (fDept ? ' (' + fDept + ')' : '');
                if (tlSubSummary) {
                    let subText = fReason ? 'Reason: ' + fReason : '';
                    if (fObs) subText += (subText ? ' • Observations: ' : 'Observations: ') + fObs;
                    tlSubSummary.textContent = subText;
                }
            } else {
                tlRefInfo.style.display = 'none';
            }
        }

        // 3. Update Timeline Milestone 2
        const aDate = document.getElementById('assessment_date') ? document.getElementById('assessment_date').value : '';
        const aAct = document.getElementById('assessment_activity') ? document.getElementById('assessment_activity').value.trim() : '';
        const aTool = document.getElementById('assessment_tool') ? document.getElementById('assessment_tool').value.trim() : '';
        const aObs = document.getElementById('counselor_observation') ? document.getElementById('counselor_observation').value.trim() : '';
        const aFind = document.getElementById('assessment_findings') ? document.getElementById('assessment_findings').value.trim() : '';

        if (document.getElementById('tl_assessment_date')) document.getElementById('tl_assessment_date').textContent = aDate || '—';
        if (document.getElementById('tl_assessment_activity')) document.getElementById('tl_assessment_activity').textContent = aAct || '—';
        if (document.getElementById('tl_assessment_tool')) document.getElementById('tl_assessment_tool').textContent = aTool || '—';
        if (document.getElementById('tl_counselor_observation')) document.getElementById('tl_counselor_observation').textContent = aObs || '—';
        if (document.getElementById('tl_assessment_findings')) document.getElementById('tl_assessment_findings').textContent = aFind || '—';

        // 4. Update Timeline Milestone 3
        const iType = document.getElementById('intervention_type') ? document.getElementById('intervention_type').value : '';
        const iTimeline = document.getElementById('target_timeline') ? document.getElementById('target_timeline').value.trim() : '';
        const iGoals = document.getElementById('case_goals') ? document.getElementById('case_goals').value.trim() : '';
        const iPlan = document.getElementById('case_plan_details') ? document.getElementById('case_plan_details').value.trim() : '';
        const actionsSummary = getActionsTakenSummary();
        const addComments = document.getElementById('case_additional_comments') ? document.getElementById('case_additional_comments').value.trim() : '';

        if (document.getElementById('tl_intervention_type')) document.getElementById('tl_intervention_type').textContent = iType || '—';
        if (document.getElementById('tl_target_timeline')) document.getElementById('tl_target_timeline').textContent = iTimeline || '—';
        if (document.getElementById('tl_case_goals')) document.getElementById('tl_case_goals').textContent = iGoals || '—';
        if (document.getElementById('tl_case_plan_details')) document.getElementById('tl_case_plan_details').textContent = iPlan || '—';

        const tlActionsBox = document.getElementById('tl_actions_box');
        if (tlActionsBox) {
            if (actionsSummary) {
                tlActionsBox.style.display = 'block';
                document.getElementById('tl_actions_taken').textContent = actionsSummary;
            } else {
                tlActionsBox.style.display = 'none';
            }
        }

        const tlCommentsBox = document.getElementById('tl_comments_box');
        if (tlCommentsBox) {
            if (addComments) {
                tlCommentsBox.style.display = 'block';
                document.getElementById('tl_additional_comments').textContent = addComments;
            } else {
                tlCommentsBox.style.display = 'none';
            }
        }

        // 5. Update Timeline Milestone 4
        const selectVal = document.getElementById('monitoring_select') ? document.getElementById('monitoring_select').value : '';
        const inputVal = document.getElementById('monitoring_classification') ? document.getElementById('monitoring_classification').value.trim() : '';
        const mClass = (selectVal === 'custom') ? inputVal : (selectVal || inputVal);
        const rDate = document.getElementById('return_date') ? document.getElementById('return_date').value : '';
        const rTime = document.getElementById('return_time') ? document.getElementById('return_time').value : '';
        const pNote = document.getElementById('progress_note') ? document.getElementById('progress_note').value.trim() : '';

        if (document.getElementById('tl_monitoring_classification')) document.getElementById('tl_monitoring_classification').textContent = mClass || '—';
        if (document.getElementById('tl_return_schedule')) document.getElementById('tl_return_schedule').textContent = (rDate || rTime) ? (rDate + (rTime ? ' at ' + rTime : '')) : '—';
        if (document.getElementById('tl_progress_note')) document.getElementById('tl_progress_note').textContent = pNote || '—';
    }

    /**
     * Cancel Intake Action
     */
    function cancelCaseIntake() {
        if (confirm('Cancel case registration? Any unsaved inputs will be cleared.')) {
            window.location.href = "<?= url('guidance/cases') ?>";
        }
    }

    /**
     * Finalize & Add Student to Cases List AND Referrals List (Front-End LocalStorage)
     */
    function finalizeAndAddCase() {
        const caseId = (document.getElementById('displayCaseId') ? document.getElementById('displayCaseId').textContent.trim() : '') || 'CAS-2026-013';
        const studentId = document.getElementById('client_id').value.trim() || '2023-01089';
        const studentName = document.getElementById('client_name').value.trim() || 'New Registered Client';
        const intakeMode = document.getElementById('intake_mode') ? document.getElementById('intake_mode').value : 'student';
        const studentProgram = document.getElementById('client_program').value.trim() || 'Undergraduate';
        const studentCollege = document.getElementById('client_college').value || 'MarSU';
        const studentYear = document.getElementById('client_year').value || '1st Year';

        let reason = document.getElementById('consultation_reason').value;
        if (reason === 'Other Inquiries' && document.getElementById('other_inquiry_text').value.trim()) {
            reason = document.getElementById('other_inquiry_text').value.trim();
        }
        if (!reason) reason = 'General Guidance Consultation';

        const disposition = document.getElementById('closure_disposition').value || 'In Progress';

        let priority = 'Medium Priority';
        if (disposition === 'Under Observation' || disposition === 'High Priority' || reason.includes('Mental Health') || reason.includes('Behavioral')) {
            priority = 'High Priority';
        } else if (disposition === 'Closed' || disposition === 'Resolved' || disposition === 'Referred to Other Office') {
            priority = 'Low Priority';
        }

        const now = new Date();
        const openedDate = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        const openedTime = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });

        const sourceLabel = (intakeMode === 'faculty') ? 'Referral' : 'Case Registration';

        // 1. Save to Cases List LocalStorage
        const caseData = {
            case_id: caseId,
            student_id: studentId,
            student_name: studentName,
            program: studentProgram || 'BSIS',
            year: studentYear || '1st Year',
            college: studentCollege || 'College of Information and Computing Sciences',
            concern_type: reason,
            priority: priority,
            status: disposition,
            source: sourceLabel,
            opened_date: openedDate,
            opened_time: openedTime
        };

        try {
            const existingCases = JSON.parse(localStorage.getItem('marsu_registered_cases') || '[]');
            const filteredCases = existingCases.filter(c => c.case_id !== caseId);
            filteredCases.unshift(caseData);
            localStorage.setItem('marsu_registered_cases', JSON.stringify(filteredCases));
        } catch (e) {
            console.error('Case storage error:', e);
        }

        // 2. If Faculty/Staff Referral, ALSO save to Referrals List LocalStorage!
        if (intakeMode === 'faculty') {
            const refDate = document.getElementById('faculty_ref_date').value || openedDate;
            const fName = document.getElementById('faculty_name').value.trim() || 'Teacher / Faculty';
            const fDept = document.getElementById('faculty_dept').value.trim();
            const fContact = document.getElementById('faculty_contact').value.trim();
            const fReason = document.getElementById('faculty_reason_referral').value || reason;
            const fObs = document.getElementById('faculty_other_observations').value.trim();
            const actionsTaken = getActionsTakenSummary();
            const addComments = document.getElementById('case_additional_comments') ? document.getElementById('case_additional_comments').value.trim() : '';

            const referralData = {
                date: refDate,
                student_id: studentId,
                student_name: studentName,
                program_year: studentProgram + (studentYear ? ' - ' + studentYear : ''),
                college: studentCollege,
                referred_by: fName + (fDept ? ' (' + fDept + ')' : ''),
                contact: fContact,
                reason: fReason,
                observations: fObs || '—',
                actions: actionsTaken || 'Endorsed for Guidance Assessment & Plan',
                comments: addComments || (document.getElementById('intake_statement').value.trim()),
                urgency: (fReason.includes('Emotional') || fReason.includes('Distress') || fReason.includes('Behavioral')) ? 'Urgent (within 24–72 hours)' : 'Routine',
                status: 'Scheduled for Intake'
            };

            try {
                const existingRefs = JSON.parse(localStorage.getItem('marsu_registered_referrals') || '[]');
                const filteredRefs = existingRefs.filter(r => !(r.student_id === studentId && r.date === refDate));
                filteredRefs.unshift(referralData);
                localStorage.setItem('marsu_registered_referrals', JSON.stringify(filteredRefs));
            } catch (e) {
                console.error('Referral storage error:', e);
            }
        }

        showToast('Case successfully registered! Adding to Cases and Referrals...', 'success');

        setTimeout(function () {
            window.location.href = "<?= url('guidance/cases') ?>";
        }, 1200);
    }

    /**
     * Toast Feedback Helper
     */
    function showToast(message, type) {
        const toastBox = document.getElementById('toastBox');
        if (!toastBox) return;

        const isSuccess = type === 'success';
        const isWarning = type === 'warning';
        let bgStyle = 'background-color: #166534; color: #fff;';
        let icon = 'bi-check-circle-fill';

        if (isWarning) {
            bgStyle = 'background-color: #b45309; color: #fff;';
            icon = 'bi-exclamation-triangle-fill';
        } else if (!isSuccess) {
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
            if (toastEl && toastEl.parentElement) {
                toastEl.remove();
            }
        }, 4000);
    }
</script>