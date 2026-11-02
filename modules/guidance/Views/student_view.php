<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STUDENT PROFILE DETAILS              -->
<!--   DIV-BASED LAYOUT • NATIVE BOOTSTRAP 5.3 • RA 10173 COMPLIANT       -->
<!-- ==================================================================== -->

<!-- 1. PAGE BREADCRUMB & HEADER -->
<div class="card shadow-sm border-0 mb-4 bg-white no-print" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <!-- Breadcrumb Trail -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb mb-0" style="font-size: 14.5px; background: transparent; padding: 0; line-height: 1.5;">
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
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/student_directory') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student Directory
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Student View
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Profile
                </h4>
                <p class="text-muted mb-0" style="font-size: 14.5px;">
                    Verified student record and guidance profile dossier.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?= url('guidance/student_directory') ?>"
                    class="btn btn-sm btn-outline-secondary shadow-none d-inline-flex align-items-center gap-2"
                    style="font-weight: 500; font-size: 13.5px; height: 38px; padding: 0 16px; border-radius: 6px; text-decoration: none;">
                    <i class="bi bi-arrow-left"></i>Back to Directory
                </a>
                <a id="sv_history_btn" href="<?= url('guidance/student_history_view') ?>?id=2023-01089"
                    class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center gap-2"
                    style="font-weight: 500; font-size: 13.5px; height: 38px; padding: 0 16px; border-radius: 6px; text-decoration: none;">
                    <i class="bi bi-clock-history"></i>Counseling History
                </a>
                <button type="button" onclick="window.print()"
                    class="btn btn-sm text-white shadow-none d-inline-flex align-items-center gap-2"
                    style="background-color: #800020; border: 1px solid #800020; font-weight: 500; font-size: 13.5px; height: 38px; padding: 0 16px; border-radius: 6px;">
                    <i class="bi bi-printer"></i>Print Profile
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 2. CUSTOM STYLES & PRINT RULES -->
<style>
    .btn-outline-marsu {
        color: #800020;
        border-color: #800020;
        background-color: transparent;
    }
    .btn-outline-marsu:hover {
        background-color: #800020;
        color: #ffffff;
        border-color: #800020;
    }
    .field-display-box {
        background-color: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 11px 16px;
        min-height: 48px;
        font-size: 14.5px;
        line-height: 1.5;
    }
    @media print {
        .no-print, nav, .breadcrumb, .btn, header, sidebar, aside, .navbar {
            display: none !important;
        }
        body {
            background-color: #ffffff !important;
            color: #000000 !important;
            font-size: 10pt !important;
        }
        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            margin-bottom: 12px !important;
        }
        .field-display-box {
            background-color: #ffffff !important;
            border: 1px solid #ccc !important;
        }
    }
</style>

<!-- 3. STUDENT PROFILE DATASET STORE (DIV-BASED STORAGE ENGINE) -->
<div id="studentDatasetStore" class="d-none" aria-hidden="true">
    <!-- Record 1: Carlos Ramos -->
    <div class="student-record" id="student-2023-01089"
        data-id="2023-01089"
        data-name="RAMOS, CARLOS M."
        data-first-name="Carlos"
        data-middle-name="Mendoza"
        data-last-name="Ramos"
        data-suffix="None (N/A)"
        data-gender="Male"
        data-dob="October 14, 2004"
        data-age="22 years old"
        data-phone="0917-482-9102"
        data-email="carlos.ramos@gmail.com"
        data-emergency="0928-314-9011"
        data-address="Barangay Murallon, Boac, Marinduque"
        data-guardian="Juan Ramos"
        data-relationship="Father"
        data-program="BS Information Systems"
        data-dept="College of Information and Computing Sciences (CICS)"
        data-year="3rd Year"
        data-section="Section A"
        data-sy="2026 - 2027"
        data-status="Enrolled (Regular)"
        data-allergies="None reported"
        data-medical="Occasional tension headaches during midterm examination periods"
        data-medications="None prescribed / Paracetamol taken as needed"
        data-assistance="Prefers well-lit front desk for note-taking">
    </div>

    <!-- Record 2: Maria Santos -->
    <div class="student-record" id="student-2023-01042"
        data-id="2023-01042"
        data-name="SANTOS, MARIA C."
        data-first-name="Maria"
        data-middle-name="Cruz"
        data-last-name="Santos"
        data-suffix="None (N/A)"
        data-gender="Female"
        data-dob="May 18, 2005"
        data-age="21 years old"
        data-phone="0919-876-5432"
        data-email="maria.santos@gmail.com"
        data-emergency="0918-234-5678"
        data-address="Barangay Santol, Boac, Marinduque"
        data-guardian="Teresa Santos"
        data-relationship="Mother"
        data-program="BA Political Science"
        data-dept="College of Arts and Sciences (CAS)"
        data-year="2nd Year"
        data-section="Section B"
        data-sy="2026 - 2027"
        data-status="Enrolled (Regular)"
        data-allergies="Dust, Seafood"
        data-medical="Mild social anxiety during group presentations"
        data-medications="None prescribed"
        data-assistance="Requires calm testing environment when experiencing panic">
    </div>

    <!-- Record 3: Juan Mendoza -->
    <div class="student-record" id="student-2022-00512"
        data-id="2022-00512"
        data-name="MENDOZA, JUAN B."
        data-first-name="Juan"
        data-middle-name="Bautista"
        data-last-name="Mendoza"
        data-suffix="None (N/A)"
        data-gender="Male"
        data-dob="January 12, 2004"
        data-age="22 years old"
        data-phone="0921-555-8901"
        data-email="juan.mendoza@gmail.com"
        data-emergency="0920-888-1234"
        data-address="Barangay Bunganay, Boac, Marinduque"
        data-guardian="Pedro Mendoza"
        data-relationship="Father"
        data-program="Bachelor of Elementary Education"
        data-dept="College of Education (CED)"
        data-year="3rd Year"
        data-section="Section A"
        data-sy="2026 - 2027"
        data-status="Enrolled (Regular)"
        data-allergies="None reported"
        data-medical="Asthma triggered by intense physical exertion"
        data-medications="Salbutamol inhaler as needed"
        data-assistance="Pacing support during extended physical drills">
    </div>

    <!-- Record 4: Bea Dela Cruz -->
    <div class="student-record" id="student-2024-03115"
        data-id="2024-03115"
        data-name="DELA CRUZ, BEA L."
        data-first-name="Bea"
        data-middle-name="Lopez"
        data-last-name="Dela Cruz"
        data-suffix="None (N/A)"
        data-gender="Female"
        data-dob="November 24, 2006"
        data-age="19 years old"
        data-phone="0927-444-1234"
        data-email="bea.delacruz@gmail.com"
        data-emergency="0917-999-5678"
        data-address="Barangay Mercado, Boac, Marinduque"
        data-guardian="Corazon Dela Cruz"
        data-relationship="Mother"
        data-program="BS Tourism Management"
        data-dept="College of Business and Accountancy (CBA)"
        data-year="1st Year"
        data-section="Section C"
        data-sy="2026 - 2027"
        data-status="Enrolled (Regular)"
        data-allergies="Peanuts"
        data-medical="None reported"
        data-medications="None prescribed"
        data-assistance="None requested">
    </div>
</div>

<!-- 4. ORGANIZED PROFILE IDENTITY BANNER (MULTI-LINE STRUCTURED METADATA) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-body p-4">
        <div class="d-flex align-items-start gap-4 flex-wrap flex-sm-nowrap">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm flex-shrink-0"
                style="width: 68px; height: 68px; background-color: #800020; font-size: 28px; margin-top: 2px;">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="flex-grow-1">
                <h4 class="fw-bold text-dark mb-3" id="sv_name" style="font-size: 22px; letter-spacing: -0.3px;">
                    RAMOS, CARLOS M.
                </h4>

                <div class="d-flex flex-column gap-2" style="font-size: 14.5px;">
                    <!-- Line 1: Student ID & Gender with appropriate spacing -->
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div>
                            <span class="text-muted">Student ID:</span>
                            <strong class="ms-1.5" id="sv_id"
                                style="color: #1A202C !important; font-weight: 700;">2023-01089</strong>
                        </div>
                        <div>
                            <span class="text-muted">Gender:</span>
                            <strong class="text-dark ms-1.5" id="sv_gender">Male</strong>
                        </div>
                    </div>

                    <!-- Line 2: Program (below Student ID), Department, Section -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Program:</span>
                            <strong class="text-dark ms-1.5" id="sv_program">BS Information Systems</strong>
                        </div>
                        <div>
                            <span class="text-muted">Department:</span>
                            <strong class="text-dark ms-1.5" id="sv_dept">College of Information and Computing Sciences</strong>
                        </div>
                        <div>
                            <span class="text-muted">Section:</span>
                            <strong class="text-dark ms-1.5" id="sv_section">3rd Year - Section A</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 5. PERSONAL BACKGROUND (FULL-WIDTH, NO ICON, TITLE FONT-SIZE: 18px, SPACED FIELDS) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Personal Background
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Student Number / ID</label>
                <div class="d-flex align-items-center field-display-box" id="sv_pb_id"
                    style="color: #1A202C !important; font-weight: 700;">
                    2023-01089
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">First Name</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_first_name">
                    Carlos
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Middle Name</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_middle_name">
                    Mendoza
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Last Name</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_last_name">
                    Ramos
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Suffix</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_suffix">
                    None (N/A)
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Gender</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_gender">
                    Male
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Date of Birth</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_dob">
                    October 14, 2004
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Age</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_age">
                    22 years old
                </div>
            </div>
            <div class="col-md-4 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Contact Phone Number</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_phone">
                    0917-482-9102
                </div>
            </div>
            <div class="col-md-4 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Email Address</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_email">
                    carlos.ramos@gmail.com
                </div>
            </div>
            <div class="col-md-4 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Emergency Contact Number</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_emergency">
                    0928-314-9011
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Permanent Home Address</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_address">
                    Barangay Murallon, Boac, Marinduque
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Parent / Legal Guardian</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_guardian">
                    Juan Ramos
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Guardian Relationship</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_pb_relationship">
                    Father
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 6. ACADEMIC INFORMATION (FULL-WIDTH, NO ICON, TITLE FONT-SIZE: 18px, SPACED FIELDS) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Academic Information
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Degree Program / Course</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_ai_program">
                    BS Information Systems
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Collegiate Department</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_ai_dept">
                    College of Information and Computing Sciences (CICS)
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Year Level</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_ai_year">
                    3rd Year
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Section</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_ai_section">
                    Section A
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Current School Year</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_ai_sy">
                    2026 - 2027
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Enrollment Status</label>
                <div class="d-flex align-items-center field-display-box">
                    <span class="badge" id="sv_ai_status"
                        style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 5px 14px; font-size: 13px; font-weight: 600;">
                        Enrolled (Regular)
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 7. HEALTH INFORMATION (FULL-WIDTH, NO ICON, TITLE FONT-SIZE: 18px, SPACED FIELDS) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Health Information
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Allergies</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_hi_allergies">
                    None reported
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Medical Conditions</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_hi_medical">
                    Occasional tension headaches during midterm examination periods
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Current Medications</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_hi_medications">
                    None prescribed / Paracetamol taken as needed
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Special Assistance Needs</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="sv_hi_assistance">
                    Prefers well-lit front desk for note-taking
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 8. DYNAMIC LOOKUP & POPULATION SCRIPT (DIV-BASED DATASET PARSER) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const queryId = new URLSearchParams(window.location.search).get('id') || '2023-01089';
    const store = document.getElementById('studentDatasetStore');
    if (!store) return;

    let targetRecord = document.getElementById('student-' + queryId);

    // Fallback: Check dynamically registered students in localStorage if created via intake
    if (!targetRecord) {
        try {
            const rawRegistered = localStorage.getItem('marsu_registered_cases');
            if (rawRegistered) {
                const list = JSON.parse(rawRegistered);
                const match = list.find(item => item.studentId === queryId);
                if (match) {
                    // Create transient div record
                    const tempDiv = document.createElement('div');
                    tempDiv.className = 'student-record';
                    tempDiv.id = 'student-' + match.studentId;
                    tempDiv.setAttribute('data-id', match.studentId || queryId);
                    tempDiv.setAttribute('data-name', (match.studentName || 'Student Profile').toUpperCase());
                    tempDiv.setAttribute('data-first-name', (match.studentName || '').split(' ')[0] || 'Carlos');
                    tempDiv.setAttribute('data-middle-name', 'M.');
                    tempDiv.setAttribute('data-last-name', (match.studentName || '').split(' ').slice(1).join(' ') || 'Ramos');
                    tempDiv.setAttribute('data-suffix', 'None (N/A)');
                    tempDiv.setAttribute('data-gender', 'Not Specified');
                    tempDiv.setAttribute('data-dob', 'October 14, 2004');
                    tempDiv.setAttribute('data-age', '21 years old');
                    tempDiv.setAttribute('data-phone', '0917-000-0000');
                    tempDiv.setAttribute('data-email', (match.studentId || 'student') + '@marsu.edu.ph');
                    tempDiv.setAttribute('data-emergency', '0918-000-0000');
                    tempDiv.setAttribute('data-address', 'Marinduque, Philippines');
                    tempDiv.setAttribute('data-guardian', 'Parent / Guardian');
                    tempDiv.setAttribute('data-relationship', 'Guardian');
                    tempDiv.setAttribute('data-program', match.program || 'General Program');
                    tempDiv.setAttribute('data-dept', match.college || 'MarSU Collegiate Department');
                    tempDiv.setAttribute('data-year', match.yearLevel || '2nd Year');
                    tempDiv.setAttribute('data-section', 'Section A');
                    tempDiv.setAttribute('data-sy', '2026 - 2027');
                    tempDiv.setAttribute('data-status', 'Enrolled (Regular)');
                    tempDiv.setAttribute('data-allergies', 'None reported');
                    tempDiv.setAttribute('data-medical', 'Under guidance assessment');
                    tempDiv.setAttribute('data-medications', 'None');
                    tempDiv.setAttribute('data-assistance', 'Counseling follow-up scheduled');
                    store.appendChild(tempDiv);
                    targetRecord = tempDiv;
                }
            }
        } catch (e) {
            console.warn('LocalStorage student lookup warning:', e);
        }
    }

    // Default to the first record in store if still not found
    if (!targetRecord) {
        targetRecord = store.querySelector('.student-record');
    }

    if (!targetRecord) return;

    // Extract attributes from dataset div
    const sid = targetRecord.getAttribute('data-id') || '2023-01089';
    const sname = targetRecord.getAttribute('data-name') || '';
    const sfirstName = targetRecord.getAttribute('data-first-name') || '';
    const smiddleName = targetRecord.getAttribute('data-middle-name') || '';
    const slastName = targetRecord.getAttribute('data-last-name') || '';
    const ssuffix = targetRecord.getAttribute('data-suffix') || 'None (N/A)';
    const sgender = targetRecord.getAttribute('data-gender') || '';
    const sdob = targetRecord.getAttribute('data-dob') || '';
    const sage = targetRecord.getAttribute('data-age') || '';
    const sphone = targetRecord.getAttribute('data-phone') || '';
    const semail = targetRecord.getAttribute('data-email') || '';
    const semergency = targetRecord.getAttribute('data-emergency') || '';
    const saddress = targetRecord.getAttribute('data-address') || '';
    const sguardian = targetRecord.getAttribute('data-guardian') || '';
    const srelationship = targetRecord.getAttribute('data-relationship') || '';
    const sprogram = targetRecord.getAttribute('data-program') || '';
    const sdept = targetRecord.getAttribute('data-dept') || '';
    const syear = targetRecord.getAttribute('data-year') || '';
    const ssection = targetRecord.getAttribute('data-section') || '';
    const ssy = targetRecord.getAttribute('data-sy') || '2026 - 2027';
    const sstatus = targetRecord.getAttribute('data-status') || 'Enrolled (Regular)';
    const sallergies = targetRecord.getAttribute('data-allergies') || 'None reported';
    const smedical = targetRecord.getAttribute('data-medical') || 'None reported';
    const smedications = targetRecord.getAttribute('data-medications') || 'None';
    const sassistance = targetRecord.getAttribute('data-assistance') || 'None';

    // Populate Banner
    const elName = document.getElementById('sv_name');
    if (elName) elName.textContent = sname;

    const elId = document.getElementById('sv_id');
    if (elId) elId.textContent = sid;

    const elGender = document.getElementById('sv_gender');
    if (elGender) elGender.textContent = sgender;

    const elProgram = document.getElementById('sv_program');
    if (elProgram) elProgram.textContent = sprogram;

    const elDept = document.getElementById('sv_dept');
    if (elDept) elDept.textContent = sdept;

    const elSection = document.getElementById('sv_section');
    if (elSection) elSection.textContent = (syear ? syear + ' - ' : '') + ssection;

    // Update History Button Link
    const elHistoryBtn = document.getElementById('sv_history_btn');
    if (elHistoryBtn) {
        elHistoryBtn.href = '<?= url("guidance/student_history_view") ?>?id=' + encodeURIComponent(sid);
    }

    // Populate Personal Background
    const elPbId = document.getElementById('sv_pb_id');
    if (elPbId) elPbId.textContent = sid;

    const elPbFirst = document.getElementById('sv_pb_first_name');
    if (elPbFirst) elPbFirst.textContent = sfirstName;

    const elPbMiddle = document.getElementById('sv_pb_middle_name');
    if (elPbMiddle) elPbMiddle.textContent = smiddleName;

    const elPbLast = document.getElementById('sv_pb_last_name');
    if (elPbLast) elPbLast.textContent = slastName;

    const elPbSuffix = document.getElementById('sv_pb_suffix');
    if (elPbSuffix) elPbSuffix.textContent = ssuffix;

    const elPbGender = document.getElementById('sv_pb_gender');
    if (elPbGender) elPbGender.textContent = sgender;

    const elPbDob = document.getElementById('sv_pb_dob');
    if (elPbDob) elPbDob.textContent = sdob;

    const elPbAge = document.getElementById('sv_pb_age');
    if (elPbAge) elPbAge.textContent = sage;

    const elPbPhone = document.getElementById('sv_pb_phone');
    if (elPbPhone) elPbPhone.textContent = sphone;

    const elPbEmail = document.getElementById('sv_pb_email');
    if (elPbEmail) elPbEmail.textContent = semail;

    const elPbEmergency = document.getElementById('sv_pb_emergency');
    if (elPbEmergency) elPbEmergency.textContent = semergency;

    const elPbAddress = document.getElementById('sv_pb_address');
    if (elPbAddress) elPbAddress.textContent = saddress;

    const elPbGuardian = document.getElementById('sv_pb_guardian');
    if (elPbGuardian) elPbGuardian.textContent = sguardian;

    const elPbRelationship = document.getElementById('sv_pb_relationship');
    if (elPbRelationship) elPbRelationship.textContent = srelationship;

    // Populate Academic Information
    const elAiProgram = document.getElementById('sv_ai_program');
    if (elAiProgram) elAiProgram.textContent = sprogram;

    const elAiDept = document.getElementById('sv_ai_dept');
    if (elAiDept) elAiDept.textContent = sdept;

    const elAiYear = document.getElementById('sv_ai_year');
    if (elAiYear) elAiYear.textContent = syear;

    const elAiSection = document.getElementById('sv_ai_section');
    if (elAiSection) elAiSection.textContent = ssection;

    const elAiSy = document.getElementById('sv_ai_sy');
    if (elAiSy) elAiSy.textContent = ssy;

    const elAiStatus = document.getElementById('sv_ai_status');
    if (elAiStatus) elAiStatus.textContent = sstatus;

    // Populate Health Information
    const elHiAllergies = document.getElementById('sv_hi_allergies');
    if (elHiAllergies) elHiAllergies.textContent = sallergies;

    const elHiMedical = document.getElementById('sv_hi_medical');
    if (elHiMedical) elHiMedical.textContent = smedical;

    const elHiMedications = document.getElementById('sv_hi_medications');
    if (elHiMedications) elHiMedications.textContent = smedications;

    const elHiAssistance = document.getElementById('sv_hi_assistance');
    if (elHiAssistance) elHiAssistance.textContent = sassistance;
});
</script>