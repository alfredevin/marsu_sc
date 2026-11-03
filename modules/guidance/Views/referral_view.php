<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: FACULTY REFERRAL VIEW DETAILS   -->
<!-- ==================================================================== -->

<!-- 1. PAGE BREADCRUMB & HEADER -->
<div class="card shadow-sm border-0 mb-4 bg-white no-print"
    style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
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
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/referrals') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Faculty Referrals
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Referral Details
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Faculty Referral Details
                </h4>
                <p class="text-muted mb-0" style="font-size: 14.5px; line-height: 1.5;">
                    Confidential student endorsement record, presenting observations, and case intake disposition.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?= url('guidance/referrals') ?>"
                    class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center gap-2"
                    style="font-weight: 500; font-size: 13.5px; height: 38px; padding: 0 16px; border-radius: 6px; text-decoration: none;">
                    <i class="bi bi-arrow-left"></i>Back to Referrals
                </a>
                <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center gap-2"
                    onclick="window.print()"
                    style="background-color: #800020; border: 1px solid #800020; font-weight: 500; font-size: 13.5px; height: 38px; padding: 0 16px; border-radius: 6px;">
                    <i class="bi bi-printer"></i>Print Referral Slip
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

        .no-print,
        nav,
        .breadcrumb,
        .btn,
        header,
        sidebar,
        aside,
        .navbar {
            display: none !important;
        }

        body {
            background-color: #ffffff !important;
            color: #000000 !important;
            font-size: 10pt !important;
        }

        .card {
            border: 1px solid #ccc !important;
            box-shadow: none !important;
            margin-bottom: 14px !important;
        }

        .field-display-box {
            background-color: #ffffff !important;
            border: 1px solid #ddd !important;
        }
    }
</style>

<!-- 3. REFERRALS DATASET STORE (FRONTEND DIV CONTAINER) -->
<div id="referralDatasetStore" class="d-none" aria-hidden="true">
    <!-- Referral Record 1: Carlos Ramos -->
    <div class="referral-view-record" id="ref-2023-01089" data-date="Oct 28, 2026" data-student-id="2023-01089"
        data-student-name="RAMOS, CARLOS M." data-program="BS Information Technology" data-year="3rd Year"
        data-college="College of Information and Computing Sciences (CICT)" data-dept-code="CICT"
        data-referred-by="Prof. Danilo Navarro (CICT)" data-contact="danilo.navarro@marsu.edu.ph"
        data-reason="Noticeable drop in academic performance"
        data-observations="Student has missed 4 consecutive laboratory sessions and failed mid-term code evaluations."
        data-actions="Discussion with student, Academic deficiency warning issued"
        data-comments="Student appears tired and distracted during afternoon lectures. Mentioned excessive gaming or personal commitments affecting sleep."
        data-urgency="Urgent (within 24–72 hours)" data-status="Scheduled for Intake"
        data-counselor="Dr. Elena M. Santos, RGC" data-target-date="2026-10-29"
        data-location="Room 101 (Guidance Consultation Room)">
    </div>

    <!-- Referral Record 2: Maria Santos -->
    <div class="referral-view-record" id="ref-2023-01042" data-date="Oct 29, 2026" data-student-id="2023-01042"
        data-student-name="SANTOS, MARIA C." data-program="BA Political Science" data-year="2nd Year"
        data-college="College of Arts and Sciences (CAS)" data-dept-code="CAS"
        data-referred-by="Dr. Roberto Gomez (CAS)" data-contact="roberto.gomez@marsu.edu.ph"
        data-reason="Stress management or excessive anxiety"
        data-observations="Exhibiting severe test anxiety, hyperventilation prior to oral debates, and difficulty speaking in class."
        data-actions="Discussion with student"
        data-comments="Student mentioned balancing heavy course load and household responsibilities."
        data-urgency="Urgent (within 24–72 hours)" data-status="Pending Review"
        data-counselor="Dr. Elena M. Santos, RGC" data-target-date="2026-10-31"
        data-location="Room 101 (Guidance Consultation Room)">
    </div>

    <!-- Referral Record 3: Juan Mendoza -->
    <div class="referral-view-record" id="ref-2022-00512" data-date="Oct 30, 2026" data-student-id="2022-00512"
        data-student-name="MENDOZA, JUAN B." data-program="Bachelor of Elementary Education (BEED)" data-year="3rd Year"
        data-college="College of Education (CED)" data-dept-code="CED" data-referred-by="Dr. Corazon Villalobos (CED)"
        data-contact="corazon.villalobos@marsu.edu.ph" data-reason="Academic probation or retention concerns"
        data-observations="Risk of failing required professional education subjects; struggles with study habits and time management."
        data-actions="Discussion with student, Discussion with parents / guardian"
        data-comments="Needs guidance on peer study groups and scheduling." data-urgency="Routine"
        data-status="Pending Review" data-counselor="Dr. Elena M. Santos, RGC" data-target-date="2026-11-04"
        data-location="Room 102 (Guidance Office)">
    </div>

    <!-- Referral Record 4: Mark Anthony Reyes -->
    <div class="referral-view-record" id="ref-2023-02194" data-date="Oct 31, 2026" data-student-id="2023-02194"
        data-student-name="REYES, MARK ANTHONY" data-program="BS Civil Engineering" data-year="2nd Year"
        data-college="College of Engineering and Architecture (CEA)" data-dept-code="CEA"
        data-referred-by="Engr. Ronald Flores (CEA)" data-contact="ronald.flores@marsu.edu.ph"
        data-reason="Sudden withdrawal from social interactions"
        data-observations="Noticeable behavioral withdrawal, sits isolated during engineering drafting, decline in personal interaction."
        data-actions="Consulted Department Chairperson"
        data-comments="Previously an active student leader; sudden demeanor shift observed in the last 3 weeks."
        data-urgency="Urgent (within 24–72 hours)" data-status="Pending Review"
        data-counselor="Dr. Elena M. Santos, RGC" data-target-date="2026-11-02"
        data-location="Room 103 (Counseling Room)">
    </div>

    <!-- Referral Record 5: Bea Dela Cruz -->
    <div class="referral-view-record" id="ref-2024-03115" data-date="Nov 01, 2026" data-student-id="2024-03115"
        data-student-name="DELA CRUZ, BEA L." data-program="BS Tourism Management" data-year="1st Year"
        data-college="College of Business and Accountancy (CBA)" data-dept-code="CBA"
        data-referred-by="Prof. Melinda Ramos (CBA)" data-contact="melinda.ramos@marsu.edu.ph"
        data-reason="Frequent absences or tardiness"
        data-observations="Frequent Friday morning absences due to long commute from remote municipality."
        data-actions="Discussion with student" data-comments="Exploring university boarding or student welfare options."
        data-urgency="Routine" data-status="Completed" data-counselor="Dr. Elena M. Santos, RGC"
        data-target-date="2026-11-03" data-location="Room 101 (Guidance Consultation Room)">
    </div>
</div>

<!-- 4. ORGANIZED REFERRAL IDENTITY BANNER (MATCHES APPOINTMENT_VIEW.PHP STRUCTURE) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-body p-4">
        <div class="d-flex align-items-start gap-4 flex-wrap flex-sm-nowrap">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm flex-shrink-0"
                style="width: 68px; height: 68px; background-color: #800020; font-size: 28px; margin-top: 2px;">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="flex-grow-1">
                <h4 class="fw-bold text-dark mb-3" id="ref_student_name"
                    style="font-size: 22px; letter-spacing: -0.3px;">
                    RAMOS, CARLOS M.
                </h4>

                <div class="d-flex flex-column gap-2" style="font-size: 14.5px;">
                    <!-- Line 1: Student ID & Status Badge -->
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div>
                            <span class="text-muted">Student ID:</span>
                            <strong class="ms-1.5 font-monospace" id="ref_student_id"
                                style="color: #1A202C !important; font-weight: 700;">2023-01089</strong>
                        </div>
                        <div>
                            <span class="text-muted">Referral Status:</span>
                            <span class="badge ms-1.5" id="ref_status_badge"
                                style="border: 1px solid #bbf7d0; background-color: #f0fdf4; color: #15803d; border-radius: 50rem; padding: 4px 14px; font-size: 12.5px; font-weight: 600;">
                                Scheduled for Intake
                            </span>
                        </div>
                    </div>

                    <!-- Line 2: Referred By & Academic Unit -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Referred by:</span>
                            <strong class="text-dark ms-1.5" id="ref_referred_by">Prof. Danilo Navarro (CICT)</strong>
                        </div>
                        <div>
                            <span class="text-muted">Program &amp; Academic Unit:</span>
                            <strong class="text-dark ms-1.5" id="ref_program_college">BS Information Technology - 3rd
                                Year (CICT)</strong>
                        </div>
                    </div>

                    <!-- Line 3: Date & Urgency Level -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Date of Referral:</span>
                            <strong class="text-dark ms-1.5" id="ref_date">Oct 28, 2026</strong>
                        </div>
                        <div>
                            <span class="text-muted">Urgency Level:</span>
                            <span class="badge ms-1.5" id="ref_urgency_badge"
                                style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px; font-weight: 600;">
                                Urgent (24–72h)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   FULL-WIDTH STACKED SECTIONS (ISA-ISA, NO ICONS, TITLE: 18px)       -->
<!-- ==================================================================== -->

<!-- 5. REFERRING FACULTY & ENDORSEMENT DETAILS (FULL-WIDTH, FIRST CARD) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Referring Faculty &amp; Endorsement Details
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">Date
                    of Referral Endorsement</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_date">
                    Oct 28, 2026
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Referring Faculty (Teacher's Name)</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_teacher">
                    Prof. Danilo Navarro
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Collegiate Department / Academic Unit</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_dept">
                    College of Information and Computing Sciences (CICT)
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Teacher's Contact Information</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_contact">
                    danilo.navarro@marsu.edu.ph
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Referral Classification</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box">
                    Official Faculty Endorsement (Pre-Intake Referral)
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Initial Urgency &amp; Priority Level</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_urgency">
                    Urgent (Attention requested within 24–72 hours)
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 6. REASON FOR REFERRAL & OBSERVATIONS (FULL-WIDTH, SECOND CARD) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Reason for Referral &amp; Observable Behaviors
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Primary Reason for Referral</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_reason">
                    Noticeable drop in academic performance
                </div>
            </div>
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Observable Behaviors &amp; Symptoms in Class</label>
                <div class="field-display-box" id="ref_field_observations"
                    style="min-height: 80px; padding: 14px 16px;">
                    Student has missed 4 consecutive laboratory sessions and failed mid-term code evaluations.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 7. ACTIONS TAKEN PRIOR TO REFERRAL & CONCERNS (FULL-WIDTH, THIRD CARD) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Actions Taken Prior to Referral &amp; Additional Context
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Actions Taken by Teacher Prior to
                    Endorsement</label>
                <div class="d-flex align-items-center fw-semibold text-dark field-display-box" id="ref_field_actions">
                    Discussion with student, Academic deficiency warning issued
                </div>
            </div>
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2"
                    style="font-size: 13px; letter-spacing: 0.3px;">Additional Teacher Comments &amp;
                    Recommendations</label>
                <div class="field-display-box" id="ref_field_comments" style="min-height: 80px; padding: 14px 16px;">
                    Student appears tired and distracted during afternoon lectures. Mentioned excessive gaming or
                    personal commitments affecting sleep.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 8. REFERRAL MANAGEMENT & INTAKE DISPOSITION (MATCHES APPOINTMENT MANAGEMENT CARD) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Referral Processing &amp; Case Intake Management
        </h5>
    </div>
    <div class="card-body p-4">
        <form action="#" onsubmit="event.preventDefault(); updateReferralManagementStatus();">
            <!-- Row 1: Target Intake Date, Location & Status -->
            <div class="row g-4 mb-4">
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2"
                        style="font-size: 13px; letter-spacing: 0.3px;">Scheduled Intake Date</label>
                    <input type="date" class="form-control bg-white shadow-none" id="manage_intake_date"
                        value="2026-10-29"
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2"
                        style="font-size: 13px; letter-spacing: 0.3px;">Counseling Consultation Room</label>
                    <select class="form-select bg-white shadow-none" id="manage_location"
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                        <option value="Room 101 (Guidance Consultation Room)" selected>Room 101 (Guidance Consultation
                            Room)</option>
                        <option value="Room 102 (Guidance Office)">Room 102 (Guidance Office)</option>
                        <option value="Room 103 (Counseling Room)">Room 103 (Counseling Room)</option>
                        <option value="Room 104 (Interview Room)">Room 104 (Interview Room)</option>
                    </select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2"
                        style="font-size: 13px; letter-spacing: 0.3px;">Referral Status</label>
                    <select class="form-select bg-white shadow-none" id="manage_status"
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                        <option value="Pending Review">Pending Review</option>
                        <option value="Scheduled for Intake" selected>Scheduled for Intake</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>

            <!-- Row 2: Assigned Counselor & Action Buttons -->
            <div class="row g-4 align-items-end">
                <div class="col-md-6 col-12">
                    <label class="fw-semibold text-muted d-block mb-2"
                        style="font-size: 13px; letter-spacing: 0.3px;">Assigned Guidance Counselor</label>
                    <input type="text" class="form-control bg-white shadow-none" id="manage_counselor"
                        value="Dr. Elena M. Santos, RGC" readonly
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                </div>
                <div class="col-md-3 col-6">
                    <button type="submit"
                        class="btn text-white shadow-none w-100 d-inline-flex align-items-center justify-content-center"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 48px; border-radius: 8px; font-weight: 500;">
                        <i class="bi bi-check2-circle me-2"></i>Update Referral
                    </button>
                </div>
                <div class="col-md-3 col-6">
                    <button type="button" onclick="transferReferralToCaseIntake()"
                        class="btn btn-outline-primary btn-outline-marsu shadow-none w-100 d-inline-flex align-items-center justify-content-center"
                        style="font-size: 14.5px; height: 48px; border-radius: 8px; font-weight: 500;">
                        <i class="bi bi-arrow-right-circle me-2"></i>Proceed to Case Intake
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 9. TOAST NOTIFICATION CONTAINER -->
<div id="toastBox" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>

<!-- ==================================================================== -->
<!-- 10. DYNAMIC REFERRAL LOOKUP & SYNC SCRIPT                           -->
<!-- ==================================================================== -->
<script>
    let currentStudentId = '2023-01089';

    document.addEventListener('DOMContentLoaded', function () {
        loadReferralDetails();
    });

    /**
     * Load Referral Details from URL Query Parameter (?id=...)
     */
    function loadReferralDetails() {
        const urlParams = new URLSearchParams(window.location.search);
        const queryId = (urlParams.get('id') || urlParams.get('student_id') || '2023-01089').trim();
        currentStudentId = queryId;

        const store = document.getElementById('referralDatasetStore');
        if (!store) return;

        // Check newly registered referrals in localStorage
        try {
            const stored = JSON.parse(localStorage.getItem('marsu_registered_referrals') || '[]');
            if (Array.isArray(stored) && stored.length) {
                stored.forEach(item => {
                    if (item.student_id && !document.getElementById('ref-' + item.student_id)) {
                        const tempDiv = document.createElement('div');
                        tempDiv.className = 'referral-view-record';
                        tempDiv.id = 'ref-' + item.student_id;
                        tempDiv.setAttribute('data-date', item.date || "<?= date('M d, Y') ?>");
                        tempDiv.setAttribute('data-student-id', item.student_id);
                        tempDiv.setAttribute('data-student-name', (item.student_name || 'Enrolled Student').toUpperCase());
                        tempDiv.setAttribute('data-program', item.program_year ? item.program_year.split('-')[0].trim() : 'Undergraduate');
                        tempDiv.setAttribute('data-year', item.program_year && item.program_year.includes('-') ? item.program_year.split('-')[1].trim() : '1st Year');
                        tempDiv.setAttribute('data-college', item.college || 'Collegiate Unit');
                        tempDiv.setAttribute('data-dept-code', item.college || 'CICT');
                        tempDiv.setAttribute('data-referred-by', item.referred_by || 'Faculty Staff');
                        tempDiv.setAttribute('data-contact', item.contact || 'contact@marsu.edu.ph');
                        tempDiv.setAttribute('data-reason', item.reason || 'Academic concern');
                        tempDiv.setAttribute('data-observations', item.observations || 'Referred for counseling assessment.');
                        tempDiv.setAttribute('data-actions', item.actions || 'Initial discussion conducted');
                        tempDiv.setAttribute('data-comments', item.comments || 'Endorsed for intake evaluation.');
                        tempDiv.setAttribute('data-urgency', item.urgency || 'Routine');
                        tempDiv.setAttribute('data-status', item.status || 'Pending Review');
                        tempDiv.setAttribute('data-counselor', 'Dr. Elena M. Santos, RGC');
                        tempDiv.setAttribute('data-target-date', "<?= date('Y-m-d') ?>");
                        tempDiv.setAttribute('data-location', 'Room 101 (Guidance Consultation Room)');
                        store.appendChild(tempDiv);
                    }
                });
            }
        } catch (e) {
            console.warn('Storage sync warning:', e);
        }

        // Lookup element in store
        let target = document.getElementById('ref-' + queryId);
        if (!target) {
            target = store.querySelector('.referral-view-record');
        }

        if (!target) return;

        // Read attributes
        const date = target.getAttribute('data-date') || '—';
        const sid = target.getAttribute('data-student-id') || '2023-01089';
        const sname = target.getAttribute('data-student-name') || 'RAMOS, CARLOS M.';
        const prog = target.getAttribute('data-program') || '';
        const yr = target.getAttribute('data-year') || '';
        const college = target.getAttribute('data-college') || '';
        const deptCode = target.getAttribute('data-dept-code') || '';
        const refBy = target.getAttribute('data-referred-by') || '—';
        const contact = target.getAttribute('data-contact') || '—';
        const reason = target.getAttribute('data-reason') || '—';
        const observations = target.getAttribute('data-observations') || '—';
        const actions = target.getAttribute('data-actions') || '—';
        const comments = target.getAttribute('data-comments') || '—';
        const urgency = target.getAttribute('data-urgency') || 'Routine';
        const status = target.getAttribute('data-status') || 'Pending Review';
        const counselor = target.getAttribute('data-counselor') || 'Dr. Elena M. Santos, RGC';
        const targetDate = target.getAttribute('data-target-date') || '2026-10-29';
        const location = target.getAttribute('data-location') || 'Room 101 (Guidance Consultation Room)';

        currentStudentId = sid;

        // Populate Identity Banner
        const elName = document.getElementById('ref_student_name');
        if (elName) elName.textContent = sname;

        const elId = document.getElementById('ref_student_id');
        if (elId) elId.textContent = sid;

        const elRefBy = document.getElementById('ref_referred_by');
        if (elRefBy) elRefBy.textContent = refBy;

        const elProgCol = document.getElementById('ref_program_college');
        if (elProgCol) elProgCol.textContent = `${prog} ${yr ? '- ' + yr : ''} (${deptCode || college})`;

        const elDate = document.getElementById('ref_date');
        if (elDate) elDate.textContent = date;

        // Status Badge
        const elStatusBadge = document.getElementById('ref_status_badge');
        if (elStatusBadge) {
            elStatusBadge.textContent = status;
            if (status === 'Scheduled for Intake' || status === 'Accepted') {
                elStatusBadge.style.backgroundColor = '#f0fdf4';
                elStatusBadge.style.color = '#15803d';
                elStatusBadge.style.borderColor = '#bbf7d0';
            } else if (status === 'Completed') {
                elStatusBadge.style.backgroundColor = '#ecfdf5';
                elStatusBadge.style.color = '#047857';
                elStatusBadge.style.borderColor = '#a7f3d0';
            } else {
                elStatusBadge.style.backgroundColor = '#fffbeb';
                elStatusBadge.style.color = '#b45309';
                elStatusBadge.style.borderColor = '#fde68a';
            }
        }

        // Urgency Badge
        const elUrgBadge = document.getElementById('ref_urgency_badge');
        if (elUrgBadge) {
            elUrgBadge.textContent = urgency;
            if (urgency.includes('Urgent')) {
                elUrgBadge.style.backgroundColor = '#fffbeb';
                elUrgBadge.style.color = '#b45309';
                elUrgBadge.style.borderColor = '#fde68a';
            } else if (urgency.includes('Emergency')) {
                elUrgBadge.style.backgroundColor = '#fef2f2';
                elUrgBadge.style.color = '#b91c1c';
                elUrgBadge.style.borderColor = '#fecaca';
            } else {
                elUrgBadge.style.backgroundColor = '#f8fafc';
                elUrgBadge.style.color = '#475569';
                elUrgBadge.style.borderColor = '#e2e8f0';
            }
        }

        // Populate Stacked Field Display Boxes
        const fDate = document.getElementById('ref_field_date');
        if (fDate) fDate.textContent = date;

        const fTeacher = document.getElementById('ref_field_teacher');
        if (fTeacher) fTeacher.textContent = refBy.replace(/\s*\(.*?\)/, '');

        const fDept = document.getElementById('ref_field_dept');
        if (fDept) fDept.textContent = college;

        const fContact = document.getElementById('ref_field_contact');
        if (fContact) fContact.textContent = contact;

        const fUrg = document.getElementById('ref_field_urgency');
        if (fUrg) fUrg.textContent = urgency;

        const fReason = document.getElementById('ref_field_reason');
        if (fReason) fReason.textContent = reason;

        const fObs = document.getElementById('ref_field_observations');
        if (fObs) fObs.textContent = observations;

        const fActions = document.getElementById('ref_field_actions');
        if (fActions) fActions.textContent = actions;

        const fComments = document.getElementById('ref_field_comments');
        if (fComments) fComments.textContent = comments;

        // Populate Management Form Controls
        const mDate = document.getElementById('manage_intake_date');
        if (mDate) mDate.value = targetDate;

        const mLoc = document.getElementById('manage_location');
        if (mLoc) mLoc.value = location;

        const mStat = document.getElementById('manage_status');
        if (mStat) mStat.value = status;

        const mCounselor = document.getElementById('manage_counselor');
        if (mCounselor) mCounselor.value = counselor;
    }

    /**
     * Handle Update Referral Form Submission
     */
    function updateReferralManagementStatus() {
        const newStatus = document.getElementById('manage_status')?.value || 'Pending Review';
        const newDate = document.getElementById('manage_intake_date')?.value || '';
        const newLoc = document.getElementById('manage_location')?.value || '';

        // Update target record in hidden store
        const target = document.getElementById('ref-' + currentStudentId);
        if (target) {
            target.setAttribute('data-status', newStatus);
            target.setAttribute('data-target-date', newDate);
            target.setAttribute('data-location', newLoc);
        }

        // Update Banner Badge
        const elStatusBadge = document.getElementById('ref_status_badge');
        if (elStatusBadge) {
            elStatusBadge.textContent = newStatus;
            if (newStatus === 'Scheduled for Intake' || newStatus === 'Accepted') {
                elStatusBadge.style.backgroundColor = '#f0fdf4';
                elStatusBadge.style.color = '#15803d';
                elStatusBadge.style.borderColor = '#bbf7d0';
            } else if (newStatus === 'Completed') {
                elStatusBadge.style.backgroundColor = '#ecfdf5';
                elStatusBadge.style.color = '#047857';
                elStatusBadge.style.borderColor = '#a7f3d0';
            } else {
                elStatusBadge.style.backgroundColor = '#fffbeb';
                elStatusBadge.style.color = '#b45309';
                elStatusBadge.style.borderColor = '#fde68a';
            }
        }

        showToast('Referral schedule and processing status updated successfully!', 'success');
    }

    /**
     * Transfer Referral Directly to Case Intake
     */
    function transferReferralToCaseIntake() {
        if (!currentStudentId) return;

        localStorage.setItem('marsu_selected_client_id', currentStudentId);
        showToast('Transferring student endorsement to Case Registration...', 'success');

        setTimeout(() => {
            window.location.href = "<?= url('guidance/case_registration') ?>";
        }, 500);
    }

    /**
     * Toast Notification Helper
     */
    function showToast(message, type) {
        const toastBox = document.getElementById('toastBox');
        if (!toastBox) return;

        let bgStyle = 'background-color: #166534; color: #fff;';
        let icon = 'bi-check-circle-fill';

        if (type === 'warning') {
            bgStyle = 'background-color: #b45309; color: #fff;';
            icon = 'bi-exclamation-triangle-fill';
        } else if (type === 'danger') {
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
            if (toastEl && toastEl.parentElement) toastEl.remove();
        }, 4000);
    }
</script>