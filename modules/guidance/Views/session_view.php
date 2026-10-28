<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: SESSION VIEW DETAILS           -->
<!-- ==================================================================== -->

<!-- 1. BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <!-- Breadcrumb Trail -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb mb-0" style="font-size: 14.5px; background: transparent; padding: 0; line-height: 2.0;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance/appointment_lists') ?>"
                    style="color: #800020; text-decoration: none; font-weight: 500;">
                    Appointments
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance/session_calendar') ?>"
                    style="color: #800020; text-decoration: none; font-weight: 500;">
                    Session Calendar
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Session Details
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Counseling Session Details
            </h4>
            <p class="text-muted mb-0" style="font-size: 14.5px; line-height: 2.0;">
                Confidential session consultation record, student profile, schedule, and venue details.
            </p>
        </div>
        <div>
            <a href="<?= url('guidance/session_calendar') ?>"
                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center gap-2"
                style="font-weight: 500; font-size: 13.5px; height: 36px; padding: 0 14px; border-radius: 6px; text-decoration: none;">
                <i class="bi bi-arrow-left"></i>Back to Session Calendar
            </a>
        </div>
    </div>
</div>

<!-- 2. ORGANIZED STUDENT PROFILE IDENTITY BANNER (MATCHES STUDENT_VIEW.PHP STRUCTURE) -->
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

                <div class="d-flex flex-column gap-2" style="font-size: 14.5px; line-height: 2.0;">
                    <!-- Line 1: Student ID, College/Department & Year Level -->
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div>
                            <span class="text-muted">Student ID:</span>
                            <strong class="ms-1.5"
                                style="color: #1A202C !important; font-weight: 700;">2023-01089</strong>
                        </div>
                        <div>
                            <span class="text-muted">College / Department:</span>
                            <strong class="text-dark ms-1.5">College of Information and Computing Sciences
                                (CICS)</strong>
                        </div>
                        <div>
                            <span class="text-muted">Year Level:</span>
                            <strong class="text-dark ms-1.5">3rd Year</strong>
                        </div>
                    </div>

                    <!-- Line 2: Academic Program, Counselor & Session Reference -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Degree Program:</span>
                            <strong class="text-dark ms-1.5">BS Information Systems (BSIS)</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   FULL-WIDTH STACKED SECTIONS (ISA-ISA, SPACING 2.0 • HEADER: 18PX)   -->
<!-- ==================================================================== -->

<!-- 3. DATE, TIME & VENUE HIGHLIGHT (MOST IMPORTANT INFORMATION) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Consultation Schedule &amp; Venue
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Scheduled Consultation Date</label>
                <div class="d-flex align-items-center fw-bold"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 15px; color: #800020; line-height: 2.0;">
                    <i class="bi bi-calendar-event me-2"></i>Thursday, October 29, 2026
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Scheduled Consultation Time</label>
                <div class="d-flex align-items-center fw-bold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 15px; line-height: 2.0;">
                    <i class="bi bi-clock me-2"></i>09:30 AM &ndash; 10:30 AM
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Consultation Venue</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    <i class="bi bi-geo-alt me-2 text-muted"></i>Room 101 (Guidance Consultation Room)
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Consultation Mode</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Face-to-Face Consultation
                </div>
            </div>
        </div>
    </div>
</div>