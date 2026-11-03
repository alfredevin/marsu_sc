<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT FEEDBACK VIEW          -->
<!--   DIV-BASED LAYOUT • NATIVE BOOTSTRAP 5.3 • RA 10173 COMPLIANT       -->
<!-- ==================================================================== -->

<!-- 1. PAGE BREADCRUMB & HEADER -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <!-- Breadcrumb Trail -->
        <nav aria-label="breadcrumb" class="mb-2 no-print">
            <ol class="breadcrumb mb-0"
                style="font-size: 14.5px; background: transparent; padding: 0; line-height: 1.5;">
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/feedbacks') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student Feedbacks
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Feedback Details
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Feedback Details
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Detailed student evaluation, feedback statement, session result, and guidance outcome.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2 no-print">
                <a href="<?= url('guidance/feedbacks') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    style="height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 16px;">
                    <i class="bi bi-arrow-left me-2"></i>Back to Feedbacks
                </a>
                <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center"
                    onclick="window.print()"
                    style="background-color: #800020; border: 1px solid #800020; height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 16px;">
                    <i class="bi bi-printer me-2"></i>Print Feedback
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 2. CUSTOM STYLES & PRINT RULES -->
<style>
    .feedback-detail-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .feedback-detail-title {
        font-size: 14px;
        font-weight: 700;
        color: #1E293B;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 8px;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .btn-outline-marsu {
        color: #800020;
        border-color: #800020;
    }

    .btn-outline-marsu:hover {
        background-color: #800020;
        color: #fff;
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
            background-color: #fff !important;
            font-size: 11pt !important;
        }

        .card {
            border: 1px solid #dee2e6 !important;
            box-shadow: none !important;
            margin-bottom: 14px !important;
        }
    }
</style>

<!-- 3. FEEDBACK DATASET STORE (DIV-BASED REPOSITORY ENGINE) -->
<div id="feedbackDatasetStore" class="d-none" aria-hidden="true">
    <!-- Feedback 1: Maria Santos -->
    <div class="feedback-record" id="feedback-2023-01042"
        data-date="2026-10-30"
        data-student-id="2023-01042"
        data-student-name="SANTOS, MARIA C."
        data-college="College of Arts and Sciences (CAS)"
        data-program="BA Political Science"
        data-year="2nd Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Individual Counseling"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.9 / 5.0 (Very Satisfied)"
        data-result="Significant reduction in oral debate anxiety; client successfully applied sensory grounding exercises during recitations."
        data-outcome="Counseling objectives met; transitioned to independent self-monitoring with scheduled voluntary check-in."
        data-feedback-text="I felt truly understood and safe during the counseling session. The breathing exercises helped calm me down before oral recitations.">
    </div>

    <!-- Feedback 2: Carlos Ramos -->
    <div class="feedback-record" id="feedback-2023-01089"
        data-date="2026-10-29"
        data-student-id="2023-01089"
        data-student-name="RAMOS, CARLOS M."
        data-college="College of Information and Computing Sciences (CICS)"
        data-program="BS Information Technology"
        data-year="3rd Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Routine Intake &amp; Academic Counseling"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.8 / 5.0 (Satisfied)"
        data-result="Structured weekly timetable formulated; laboratory catch-up schedule coordinated with department chair."
        data-outcome="Student committed to revised timetable; academic engagement and laboratory attendance noticeably improved."
        data-feedback-text="The counselor helped me organize my work and study time. The advice on handling lab projects was very practical.">
    </div>

    <!-- Feedback 3: Mark Anthony Reyes -->
    <div class="feedback-record" id="feedback-2023-02194"
        data-date="2026-10-27"
        data-student-id="2023-02194"
        data-student-name="REYES, MARK ANTHONY"
        data-college="College of Engineering and Architecture (CEA)"
        data-program="BS Civil Engineering"
        data-year="2nd Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Mental Health Consultation"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.7 / 5.0 (Satisfied)"
        data-result="Identified social avoidance triggers; established weekly behavioral activation and peer communication goals."
        data-outcome="Client expressed willingness to reconnect with drafting study group members; mood stabilized."
        data-feedback-text="I appreciated the non-judgmental environment. Talking through my stress made me realize I was not alone.">
    </div>

    <!-- Feedback 4: Juan Mendoza -->
    <div class="feedback-record" id="feedback-2022-00512"
        data-date="2026-10-23"
        data-student-id="2022-00512"
        data-student-name="MENDOZA, JUAN B."
        data-college="College of Education (CED)"
        data-program="BEED"
        data-year="3rd Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Academic Guidance &amp; Retention Advising"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.6 / 5.0 (Satisfied)"
        data-result="Subject review roadmap established; study partner accountability contract formulated for midterm review."
        data-outcome="Retention deficiency risk alleviated; mid-term study routine stabilized."
        data-feedback-text="Clear guidance on how to prioritize professional education subjects. Felt much less overwhelmed after the session.">
    </div>

    <!-- Feedback 5: Bea Dela Cruz -->
    <div class="feedback-record" id="feedback-2024-03115"
        data-date="2026-10-26"
        data-student-id="2024-03115"
        data-student-name="DELA CRUZ, BEA L."
        data-college="College of Business and Accountancy (CBA)"
        data-program="BS Tourism Management"
        data-year="1st Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Routine Intake &amp; Personal Adjustment"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="5.0 / 5.0 (Very Satisfied)"
        data-result="Homesickness and dormitory isolation addressed; engaged with campus tourism student association."
        data-outcome="Successful freshman university adjustment; positive peer connection established."
        data-feedback-text="The guidance office was very welcoming. I felt comfortable sharing my struggles living away from home.">
    </div>

    <!-- Feedback 6: Alyssa Gonzales -->
    <div class="feedback-record" id="feedback-2024-01582"
        data-date="2026-10-17"
        data-student-id="2024-01582"
        data-student-name="GONZALES, ALYSSA P."
        data-college="College of Nursing and Health Sciences (CNHS)"
        data-program="BS Nursing"
        data-year="1st Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Clinical Anxiety Desensitization"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.9 / 5.0 (Very Satisfied)"
        data-result="Mastery of clinical simulation grounding techniques; controlled heart rate and reduced somatic tremors during mock trials."
        data-outcome="Prepared and confident for upcoming hospital ward duty rotations."
        data-feedback-text="The relaxation techniques really worked during our hospital duty simulation. Thank you Ma'am Elena for the patience.">
    </div>

    <!-- Feedback 7: Kevin Bautista -->
    <div class="feedback-record" id="feedback-2022-03481"
        data-date="2026-10-19"
        data-student-id="2022-03481"
        data-student-name="BAUTISTA, KEVIN R."
        data-college="College of Agriculture, Fisheries and Environmental Studies (CAFES)"
        data-program="BS Agriculture"
        data-year="4th Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Career Guidance &amp; Vocational Profiling"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.8 / 5.0 (Satisfied)"
        data-result="RIASEC profiling completed; resume reviewed; registered for regional licensure review cohort."
        data-outcome="Definite post-graduation transition plan formulated; career anxiety resolved."
        data-feedback-text="The career assessment helped clarify what direction to take after graduation. Very helpful and encouraging.">
    </div>

    <!-- Feedback 8: Patricia Villanueva -->
    <div class="feedback-record" id="feedback-2023-04129"
        data-date="2026-10-14"
        data-student-id="2023-04129"
        data-student-name="VILLANUEVA, PATRICIA M."
        data-college="College of Business and Accountancy (CBA)"
        data-program="BS Accountancy"
        data-year="2nd Year"
        data-service-availed="Guidance Services"
        data-type-of-service="Conflict Resolution &amp; Peer Mediation"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-rating="4.7 / 5.0 (Satisfied)"
        data-result="Mediation concluded successfully; mutual respect and project division contract signed by both students."
        data-outcome="Interpersonal conflict de-escalated; coursework collaboration restored."
        data-feedback-text="The mediation was fair to both sides. We were able to finish our accounting project without friction.">
    </div>
</div>

<!-- 4. STUDENT INFORMATION CARD (Only Student ID as ID) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
        style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
            Student Client Profile
        </h6>
        <span class="badge"
            style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 12.5px; padding: 6px 12px;">
            Student ID: <span id="viewStudentID" class="font-monospace fw-bold">2023-01042</span>
        </span>
    </div>

    <div class="card-body p-4">
        <div class="row g-4" style="font-size: 14px;">
            <div class="col-md-4 col-sm-6 col-12">
                <span class="text-muted d-block small mb-1">Student Full Name:</span>
                <strong class="text-dark fs-6" id="viewStudentName">SANTOS, MARIA C.</strong>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <span class="text-muted d-block small mb-1">Student ID Number:</span>
                <span class="fw-bold text-dark font-monospace fs-6" id="viewStudentIDDisplay">2023-01042</span>
            </div>
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">College / Department:</span>
                <span class="text-dark fw-medium" id="viewCollege">College of Arts and Sciences (CAS)</span>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <span class="text-muted d-block small mb-1">Degree Program &amp; Year:</span>
                <span class="text-dark fw-medium" id="viewProgramYear">BA Political Science - 2nd Year</span>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <span class="text-muted d-block small mb-1">Date of Feedback / Service:</span>
                <span class="text-dark fw-medium" id="viewDate">2026-10-30</span>
            </div>
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">Attending Counselor:</span>
                <span class="text-dark fw-medium" id="viewCounselor">Dr. Elena M. Santos, RGC</span>
            </div>
        </div>
    </div>
</div>

<!-- 5. SERVICE AVAILED & EVALUATION RATING (NO ICONS) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-header bg-white py-3 px-4" style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
            Service Availed, Type of Service &amp; Student Rating
        </h6>
    </div>

    <div class="card-body p-4">
        <div class="row g-4" style="font-size: 14px;">
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">Service Availed:</span>
                <div class="p-3 bg-light rounded border">
                    <strong class="text-dark fs-6" id="viewServiceAvailed">Guidance Services</strong>
                    <div class="text-muted small mt-1">MarSU Guidance &amp; Counseling Services Center</div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">Type of Service:</span>
                <div class="p-3 bg-light rounded border">
                    <strong class="text-dark fs-6" id="viewTypeOfService">Individual Counseling</strong>
                    <div class="text-muted small mt-1">Specific Guidance Modality</div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <!-- Evaluation Rating: Strictly Plain Text, NO ICON as requested -->
                <span class="text-muted d-block small mb-1">Student Satisfaction Rating:</span>
                <div class="p-3 bg-light rounded border">
                    <strong class="text-dark fs-6" id="viewRating">4.9 / 5.0 (Very Satisfied)</strong>
                    <div class="text-muted small mt-1">Evaluated across counselor helpfulness, privacy, and service delivery</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 6. RESULT & OUTCOME (STRICTLY NO ICONS AS REQUESTED) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-header bg-white py-3 px-4" style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
            Session Result &amp; Guidance Outcome
        </h6>
    </div>

    <div class="card-body p-4">
        <div class="row g-4" style="font-size: 14px;">
            <!-- Result: Strictly plain text, NO ICON -->
            <div class="col-md-6 col-12">
                <span class="text-muted d-block small mb-1">Session Result:</span>
                <div class="p-3 bg-light rounded border" style="line-height: 1.6; color: #1E293B;" id="viewResult">
                    Significant reduction in oral debate anxiety; client successfully applied sensory grounding exercises during recitations.
                </div>
            </div>

            <!-- Outcome: Strictly plain text, NO ICON -->
            <div class="col-md-6 col-12">
                <span class="text-muted d-block small mb-1">Guidance Outcome:</span>
                <div class="p-3 bg-light rounded border" style="line-height: 1.6; color: #1E293B;" id="viewOutcome">
                    Counseling objectives met; transitioned to independent self-monitoring with scheduled voluntary check-in.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 7. STUDENT FEEDBACK & EVALUATION STATEMENT -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-header bg-white py-3 px-4" style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
            Student Feedback Statement
        </h6>
    </div>

    <div class="card-body p-4">
        <div class="p-3 bg-light rounded border" style="border-left: 4px solid #800020 !important;">
            <p class="mb-0 text-dark" id="viewFeedbackText"
                style="font-size: 14.5px; line-height: 1.6; font-style: italic;">
                "I felt truly understood and safe during the counseling session. The breathing exercises helped calm me
                down before oral recitations."
            </p>
        </div>
    </div>
</div>

<!-- 8. TOAST NOTIFICATION BOX -->
<div id="toastBox" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>

<!-- ==================================================================== -->
<!-- 9. DYNAMIC LOOKUP & POPULATION SCRIPT (DIV-BASED DATASET PARSER)     -->
<!-- ==================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    loadFeedbackDetails();
});

/**
 * Load Feedback Details based on ?id= Student ID Query Param
 * Parses from #feedbackDatasetStore div container with localStorage sync fallback
 */
function loadFeedbackDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = (urlParams.get('id') || urlParams.get('student_id') || '2023-01042').trim();

    const store = document.getElementById('feedbackDatasetStore');
    if (!store) return;

    // Check if dynamically registered feedback in localStorage exists and not in store yet
    try {
        const stored = JSON.parse(localStorage.getItem('marsu_student_feedbacks') || '[]');
        if (Array.isArray(stored) && stored.length) {
            stored.forEach(item => {
                if (item.student_id && !document.getElementById('feedback-' + item.student_id)) {
                    const tempDiv = document.createElement('div');
                    tempDiv.className = 'feedback-record';
                    tempDiv.id = 'feedback-' + item.student_id;
                    tempDiv.setAttribute('data-date', item.date || "<?= date('Y-m-d') ?>");
                    tempDiv.setAttribute('data-student-id', item.student_id);
                    tempDiv.setAttribute('data-student-name', item.student_name || 'Enrolled Student');
                    tempDiv.setAttribute('data-college', item.college || 'MarSU College');
                    tempDiv.setAttribute('data-program', item.program || 'Undergraduate');
                    tempDiv.setAttribute('data-year', item.year || '1st Year');
                    tempDiv.setAttribute('data-service-availed', item.service_availed || 'Guidance Services');
                    tempDiv.setAttribute('data-type-of-service', item.type_of_service || item.service_availed || 'Individual Counseling');
                    tempDiv.setAttribute('data-counselor', item.counselor || 'Dr. Elena M. Santos, RGC');
                    tempDiv.setAttribute('data-rating', item.rating || '5.0 / 5.0 (Very Satisfied)');
                    tempDiv.setAttribute('data-result', item.result || 'Session objectives accomplished.');
                    tempDiv.setAttribute('data-outcome', item.outcome || 'Progress monitored.');
                    tempDiv.setAttribute('data-feedback-text', item.feedback_text || 'The counseling session was helpful.');
                    store.appendChild(tempDiv);
                }
            });
        }
    } catch (e) {
        console.warn('Storage sync warning:', e);
    }

    // Lookup record in div store
    let targetRecord = document.getElementById('feedback-' + studentId);
    if (!targetRecord) {
        targetRecord = store.querySelector('.feedback-record');
    }

    if (!targetRecord) return;

    // Extract attributes
    const sId = targetRecord.getAttribute('data-student-id') || '2023-01042';
    const sName = targetRecord.getAttribute('data-student-name') || 'SANTOS, MARIA C.';
    const sCollege = targetRecord.getAttribute('data-college') || 'College of Arts and Sciences (CAS)';
    const sProgram = targetRecord.getAttribute('data-program') || 'BA Political Science';
    const sYear = targetRecord.getAttribute('data-year') || '2nd Year';
    const sDate = targetRecord.getAttribute('data-date') || '2026-10-30';
    const sCounselor = targetRecord.getAttribute('data-counselor') || 'Dr. Elena M. Santos, RGC';
    const sServiceAvailed = targetRecord.getAttribute('data-service-availed') || 'Guidance Services';
    const sTypeOfService = targetRecord.getAttribute('data-type-of-service') || 'Individual Counseling';
    const sRating = targetRecord.getAttribute('data-rating') || '4.9 / 5.0 (Very Satisfied)';
    const sResult = targetRecord.getAttribute('data-result') || '—';
    const sOutcome = targetRecord.getAttribute('data-outcome') || '—';
    const sFeedbackText = targetRecord.getAttribute('data-feedback-text') || '—';

    // Populate DOM Elements
    const elIdHeader = document.getElementById('viewStudentID');
    if (elIdHeader) elIdHeader.textContent = sId;

    const elIdDisplay = document.getElementById('viewStudentIDDisplay');
    if (elIdDisplay) elIdDisplay.textContent = sId;

    const elName = document.getElementById('viewStudentName');
    if (elName) elName.textContent = sName;

    const elCollege = document.getElementById('viewCollege');
    if (elCollege) elCollege.textContent = sCollege;

    const elProgramYear = document.getElementById('viewProgramYear');
    if (elProgramYear) elProgramYear.textContent = `${sProgram} - ${sYear}`;

    const elDate = document.getElementById('viewDate');
    if (elDate) elDate.textContent = sDate;

    const elCounselor = document.getElementById('viewCounselor');
    if (elCounselor) elCounselor.textContent = sCounselor;

    const elService = document.getElementById('viewServiceAvailed');
    if (elService) elService.textContent = sServiceAvailed;

    const elType = document.getElementById('viewTypeOfService');
    if (elType) elType.textContent = sTypeOfService;

    const elRating = document.getElementById('viewRating');
    if (elRating) elRating.textContent = sRating;

    const elResult = document.getElementById('viewResult');
    if (elResult) elResult.textContent = sResult;

    const elOutcome = document.getElementById('viewOutcome');
    if (elOutcome) elOutcome.textContent = sOutcome;

    const elFeedback = document.getElementById('viewFeedbackText');
    if (elFeedback) elFeedback.textContent = `"${sFeedbackText.replace(/^"|"$/g, '')}"`;
}
</script>