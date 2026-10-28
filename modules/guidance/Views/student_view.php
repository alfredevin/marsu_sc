<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STUDENT PROFILE DETAILS              -->
<!--   FRONTEND ONLY • DIV-BASED LAYOUT • NO STYLE/SCRIPT TAGS           -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & HEADER -->
<div class="mb-4">
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
        <div>
            <a href="<?= url('guidance/student_directory') ?>"
                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center gap-2"
                style="font-weight: 500; font-size: 13.5px; height: 36px; padding: 0 14px; border-radius: 6px; text-decoration: none;">
                <i class="bi bi-arrow-left"></i>Back to Directory
            </a>
        </div>
    </div>
</div>

<!-- 1. ORGANIZED PROFILE IDENTITY BANNER (MULTI-LINE STRUCTURED METADATA) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-body p-4">
        <div class="d-flex align-items-start gap-4 flex-wrap flex-sm-nowrap">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm flex-shrink-0"
                style="width: 68px; height: 68px; background-color: #800020; font-size: 28px; margin-top: 2px;">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="flex-grow-1">
                <h4 class="fw-bold text-dark mb-3" style="font-size: 22px; letter-spacing: -0.3px;">
                    RAMOS, CARLOS M.
                </h4>

                <div class="d-flex flex-column gap-2" style="font-size: 14.5px;">
                    <!-- Line 1: Student ID & Gender with appropriate spacing -->
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div>
                            <span class="text-muted">Student ID:</span>
                            <strong class="ms-1.5"
                                style="color: #1A202C !important; font-weight: 700;">2023-01089</strong>
                        </div>
                        <div>
                            <span class="text-muted">Gender:</span>
                            <strong class="text-dark ms-1.5">Male</strong>
                        </div>
                    </div>

                    <!-- Line 2: Program (below Student ID), Department, Section -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Program:</span>
                            <strong class="text-dark ms-1.5">BS Information Systems</strong>
                        </div>
                        <div>
                            <span class="text-muted">Department:</span>
                            <strong class="text-dark ms-1.5">College of Information and Computing Sciences
                                (CICS)</strong>
                        </div>
                        <div>
                            <span class="text-muted">Section:</span>
                            <strong class="text-dark ms-1.5">2nd Year - Section A</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. PERSONAL BACKGROUND (FULL-WIDTH, NO ICON, TITLE FONT-SIZE: 18px, SPACED FIELDS) -->
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
                <div class="d-flex align-items-center"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; color: #1A202C !important; font-weight: 700; line-height: 1.5;">
                    2023-01089
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">First
                    Name</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Carlos
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Middle Name</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Mendoza
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Last
                    Name</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Ramos
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Suffix</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    None (N/A)
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Gender</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Male
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Date
                    of Birth</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    October 14, 2004
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Age</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    22 years old
                </div>
            </div>
            <div class="col-md-4 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Contact Phone Number</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    0917-482-9102
                </div>
            </div>
            <div class="col-md-4 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Email</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    carlos.ramos@gmail.com
                </div>
            </div>
            <div class="col-md-4 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Emergency Contact Number</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    0928-314-9011
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Permanent Home Address</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Barangay Murallon, Boac, Marinduque
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Parent / Legal Guardian</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Juan Ramos
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Guardian Relationship</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Father
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. ACADEMIC INFORMATION (FULL-WIDTH, FIRST LOWER CARD, NO ICON, TITLE FONT-SIZE: 18px, SPACED FIELDS) -->
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
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    BS Information Systems
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Collegiate Department</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    College of Information and Computing Sciences (CICS)
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Year
                    Level</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    2nd Year
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Section</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Section A
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Current School Year</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    2026 - 2027
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Enrollment Status</label>
                <div class="d-flex align-items-center"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    <span class="badge"
                        style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 5px 14px; font-size: 13px; font-weight: 600;">
                        Enrolled (Regular)
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. HEALTH INFORMATION (FULL-WIDTH, NEXT LOWER CARD, NO ICON, TITLE FONT-SIZE: 18px, SPACED FIELDS) -->
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
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    None reported
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Medical Conditions</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Occasional tension headaches during midterm examination periods
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Current Medications</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    None prescribed / Paracetamol taken as needed
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Special Assistance Needs</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 1.5;">
                    Prefers well-lit front desk for note-taking
                </div>
            </div>
        </div>
    </div>
</div>