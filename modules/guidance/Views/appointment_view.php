<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: APPOINTMENT VIEW DETAILS       -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <!-- Breadcrumb Trail -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb mb-0" style="font-size: 14.5px; background: transparent; padding: 0; line-height: 1.5;">
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
                <a href="<?= url('guidance/appointment_lists') ?>"
                    style="color: #800020; text-decoration: none; font-weight: 500;">
                    Appointment Lists
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Appointment Views
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Appointment Details
            </h4>
            <p class="text-muted mb-0" style="font-size: 14.5px; line-height: 1.5;">
                Confidential appointment record, consultation concerns assessment, and scheduling dossier.
            </p>
        </div>
        <div>
            <a href="<?= url('guidance/appointment_lists') ?>"
                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center gap-2"
                style="font-weight: 500; font-size: 13.5px; height: 36px; padding: 0 14px; border-radius: 6px; text-decoration: none;">
                <i class="bi bi-arrow-left"></i>Back to Appointment Lists
            </a>
        </div>
    </div>
</div>

<!-- 1. ORGANIZED APPOINTMENT IDENTITY BANNER (MATCHES STUDENT_VIEW.PHP STRUCTURE) -->
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
                    <!-- Line 1: Student ID & Status Badge -->
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div>
                            <span class="text-muted">Student ID:</span>
                            <strong class="ms-1.5"
                                style="color: #1A202C !important; font-weight: 700;">2023-01089</strong>
                        </div>
                        <div>
                            <span class="text-muted">Status:</span>
                            <span class="badge ms-1.5"
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 4px 14px; font-size: 12.5px; font-weight: 600;">
                                Approved
                            </span>
                        </div>
                    </div>

                    <!-- Line 2: Reference & Year Level and Program -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Reference:</span>
                            <strong class="text-dark ms-1.5">APT-2026-001</strong>
                        </div>
                        <div>
                            <span class="text-muted">Year Level &amp; Program:</span>
                            <strong class="text-dark ms-1.5">3rd Year - Bachelor of Science in Information Systems
                                (BSIS)</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   FULL-WIDTH STACKED SECTIONS (ISA-ISA, NO CHECKLIST, SPACING 2.0)   -->
<!-- ==================================================================== -->

<!-- 2. COUNSELING CONCERNS (FULL-WIDTH, FIRST CARD, NO ICONS, TITLE FONT-SIZE: 18px) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Counseling Concerns
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Concern Category</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Academic Concern
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Primary Counseling Concern</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Study habits and time management
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Academic Problem / Concern</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Difficulty adjusting to academic demands, test anxiety, and heavy subject load
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Emotional or Psychological Concerns</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Stress management, situational anxiety regarding academic deadlines
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Career Related Concerns</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Course or program selection and career alignment with industry credentials
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Urgency &amp; Intake Priority</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Regular Consultation (Standard Assessment)
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. CONSULTATION SCHEDULE & GUIDANCE ACTIONS (FULL-WIDTH, NEXT LOWER CARD, NO ICONS, TITLE FONT-SIZE: 18px) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Consultation Schedule &amp; Guidance Actions
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Appointment Date</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    October 29, 2026
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Appointment Time</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    09:30 AM - 10:30 AM
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Session Type</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Face-to-Face
                </div>
            </div>
            <div class="col-md-3 col-6">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Location</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Room 101
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Assigned Guidance Counselor</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Dr. Elena Santos, RGC
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Actions Taken (if any)</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Initial intake interview conducted; recommended structured time-blocking and stress-relief
                    exercises.
                </div>
            </div>
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Additional Comments or Concerns</label>
                <div class="d-flex align-items-center fw-semibold text-dark"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Student demonstrated high receptivity to organizational tools. Follow-up consultation scheduled in
                    two weeks.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. APPOINTMENT MANAGEMENT (FULL-WIDTH, NO ICONS, TITLE FONT-SIZE: 18px) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Appointment Management
        </h5>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="">
            <?= csrf_field() ?>
            <div class="row g-4 align-items-end">
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2"
                        style="font-size: 13px; letter-spacing: 0.3px;">Appointment Status</label>
                    <select class="form-select bg-white shadow-none"
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                        <option value="Approved" selected>Approved</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Rescheduling">Rescheduling</option>
                    </select>
                </div>
                <div class="col-md-5 col-12">
                    <label class="fw-semibold text-muted d-block mb-2"
                        style="font-size: 13px; letter-spacing: 0.3px;">Assigned Counselor</label>
                    <input type="text" class="form-control bg-white shadow-none" value="Dr. Elena Santos, RGC" readonly
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                </div>
                <div class="col-md-3 col-12">
                    <button type="button"
                        class="btn text-white shadow-none w-100 d-inline-flex align-items-center justify-content-center"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 48px; border-radius: 8px; font-weight: 500;">
                        Update Status
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>