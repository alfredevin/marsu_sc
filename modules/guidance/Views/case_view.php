<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: CASE VIEW DOSSIER              -->
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
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/cases') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student Counseling Cases
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page" id="breadcrumbCaseNum">
                    CAS-2026-001
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Counseling Case Dossier
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Confidential case history, clinical observation notes, intervention timeline, and monitoring
                    records.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" onclick="window.print()"
                    class="btn btn-sm btn-outline-secondary shadow-none d-inline-flex align-items-center gap-2"
                    style="height: 38px; padding: 0 14px; border-radius: 6px; font-weight: 500; font-size: 14px;">
                    <i class="bi bi-printer"></i>Print Dossier
                </button>
                <a href="<?= url('guidance/cases') ?>"
                    class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center gap-2"
                    style="font-weight: 500; font-size: 14px; height: 38px; padding: 0 14px; border-radius: 6px; text-decoration: none;">
                    <i class="bi bi-arrow-left"></i>Back to Cases
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-marsu {
        color: #800020 !important;
        border-color: #800020 !important;
    }

    .btn-outline-marsu:hover {
        background-color: #800020 !important;
        color: #ffffff !important;
    }

    @media print {

        nav,
        .breadcrumb,
        .btn,
        header,
        sidebar,
        aside,
        .navbar,
        .card-header button,
        a.btn {
            display: none !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>

<!-- 2. ORGANIZED CASE IDENTITY BANNER -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-body p-4">
        <div class="d-flex align-items-start gap-4 flex-wrap flex-sm-nowrap">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm flex-shrink-0"
                style="width: 68px; height: 68px; background-color: #800020; font-size: 28px; margin-top: 2px;">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                    <h4 class="fw-bold text-dark mb-0" id="dossierStudentName"
                        style="font-size: 22px; letter-spacing: -0.3px;">
                        RAMOS, CARLOS M.
                    </h4>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge" id="dossierPriorityBadge"
                            style="border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309; border-radius: 50rem; padding: 4px 14px; font-size: 12.5px; font-weight: 600;">
                            Medium Priority
                        </span>
                        <span class="badge" id="dossierStatusBadge"
                            style="border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8; border-radius: 50rem; padding: 4px 14px; font-size: 12.5px; font-weight: 600;">
                            In Progress
                        </span>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2" style="font-size: 14.5px; line-height: 2.0;">
                    <!-- Line 1: Case Number, Student ID & Concern Type -->
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div>
                            <span class="text-muted">Case Number:</span>
                            <strong class="ms-1.5" id="dossierCaseNumber"
                                style="color: #800020 !important; font-weight: 700;">CAS-2026-001</strong>
                        </div>
                        <div>
                            <span class="text-muted">Student ID:</span>
                            <strong class="ms-1.5" id="dossierStudentId"
                                style="color: #1A202C !important; font-weight: 700;">2023-01089</strong>
                        </div>
                        <div>
                            <span class="text-muted">Concern Type:</span>
                            <strong class="text-dark ms-1.5" id="dossierConcernType">Academic Concern</strong>
                        </div>
                    </div>

                    <!-- Line 2: College/Department & Degree Program -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Degree Program &amp; Year:</span>
                            <strong class="text-dark ms-1.5" id="dossierProgram">3rd Year - Bachelor of Science in
                                Information Systems (BSIS)</strong>
                        </div>
                        <div>
                            <span class="text-muted">College:</span>
                            <strong class="text-dark ms-1.5" id="dossierDepartment">College of Information and Computing
                                Sciences (CICS)</strong>
                        </div>
                    </div>

                    <!-- Line 3: Opened Date, Time & Assigned Counselor -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-1">
                        <div>
                            <span class="text-muted">Opened Date:</span>
                            <strong class="text-dark ms-1.5" id="dossierOpenedDate">Oct 29, 2026</strong>
                        </div>
                        <div>
                            <span class="text-muted">Opened Time:</span>
                            <strong class="text-dark ms-1.5" id="dossierOpenedTime">09:30 AM</strong>
                        </div>
                        <div>
                            <span class="text-muted">Assigned Counselor:</span>
                            <strong class="text-dark ms-1.5" id="dossierCounselor">Dr. Maria Elena Santos, RGC</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   FULL-WIDTH STACKED SECTIONS                                        -->
<!-- ==================================================================== -->

<!-- 3. INTAKE & CONCERN ASSESSMENT -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Intake &amp; Concern Assessment
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Concern Classification
                </label>
                <div class="d-flex align-items-center fw-semibold text-dark" id="dossierConcernClass"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Academic Concern
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Referral Intake Source
                </label>
                <div class="d-flex align-items-center fw-semibold text-dark" id="dossierReferralSource"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Student Concern Submission (Online Intake)
                </div>
            </div>
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Student Concern Statement
                </label>
                <div class="d-flex align-items-center fw-medium text-dark" id="dossierConcernStatement"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 14px 18px; min-height: 54px; font-size: 14.5px; line-height: 1.8;">
                    "Struggling with midterm exam pressure and course project deadlines."
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. CLINICAL OBSERVATION & MONITORING -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2"
        style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Clinical Observation &amp; Monitoring Notes
        </h5>
        <span class="badge"
            style="background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-size: 12px; font-weight: 600;">
            Guidance Certified Record
        </span>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Counselor's Behavioral &amp; Psychological Observation
                </label>
                <div class="fw-normal text-dark p-3" id="dossierObservation"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 14.5px; line-height: 2.0;">
                    Student demonstrates awareness of academic backlog but manifests mild test-taking anxiety. Receptive
                    to structured weekly study scheduling and study habits tracking.
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Deployed Counseling Intervention
                </label>
                <div class="d-flex align-items-center fw-semibold text-dark" id="dossierIntervention"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    Academic Time Management &amp; Study Skills Coaching
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Next Scheduled Follow-up &amp; Venue
                </label>
                <div class="d-flex align-items-center fw-semibold text-dark" id="dossierNextScheduleVenue"
                    style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 11px 16px; min-height: 48px; font-size: 14.5px; line-height: 2.0;">
                    2026-11-05 &bull; 09:30 AM - 10:30 AM (Room 101 (Guidance Consultation Room))
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 5. CASE MANAGEMENT & STATUS UPDATE -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 12px;">
    <div class="card-header bg-white" style="padding: 18px 24px; border-bottom: 1px solid #E2E8F0;">
        <h5 class="fw-bold mb-0" style="color: #800020; font-size: 18px; letter-spacing: -0.2px;">
            Case Management &amp; Status Update
        </h5>
    </div>
    <div class="card-body p-4">
        <form id="caseUpdateForm" onsubmit="handleCaseViewSave(event)">
            <div class="row g-4 mb-4">
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                        Case Status
                    </label>
                    <select class="form-select bg-white shadow-none" id="caseViewStatus"
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                        <option value="In Progress">In Progress</option>
                        <option value="Under Observation">Under Observation</option>
                        <option value="On-going Intervention">On-going Intervention</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                        Priority Level
                    </label>
                    <select class="form-select bg-white shadow-none" id="caseViewPriority"
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                        <option value="High Priority">High Priority</option>
                        <option value="Medium Priority">Medium Priority</option>
                        <option value="Low Priority">Low Priority</option>
                    </select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                        Assigned Counselor
                    </label>
                    <input type="text" class="form-control bg-white shadow-none" id="caseViewCounselor"
                        value="Dr. Maria Elena Santos, RGC" readonly
                        style="height: 48px; border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px;">
                </div>
            </div>

            <div class="mb-4">
                <label class="fw-semibold text-muted d-block mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
                    Confidential Progress Notes &amp; Recommendations
                </label>
                <textarea class="form-control bg-white shadow-none" id="caseViewNotes" rows="3"
                    placeholder="Enter counselor observation remarks, action progress, and next steps..."
                    style="border-color: #CBD5E1; font-size: 14.5px; border-radius: 8px; line-height: 1.8;">Student demonstrates awareness of academic backlog but manifests mild test-taking anxiety. Receptive to structured weekly study scheduling and study habits tracking.</textarea>
            </div>

            <div class="d-flex justify-content-end align-items-center pt-2">
                <button type="submit" class="btn text-white shadow-none"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; height: 46px; border-radius: 8px; padding: 0 24px; font-weight: 500;">
                    <i class="bi bi-check2-circle me-1"></i>Save Case Updates
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================================================================== -->
<!--   CASE DATASET STORE & DYNAMIC LOOKUP CONTAINER (FRONTEND ONLY)       -->
<!-- ==================================================================== -->
<div id="caseDatasetStore" class="d-none" aria-hidden="true">
    <!-- Case 1 -->
    <div id="case-CAS-2026-001" data-case-number="CAS-2026-001" data-student-id="2023-01089"
        data-student-name="RAMOS, CARLOS M." data-program="3rd Year - Bachelor of Science in Information Systems (BSIS)"
        data-department="College of Information and Computing Sciences (CICS)" data-concern-type="Academic Concern"
        data-priority="Medium Priority" data-status="In Progress" data-opened-date="Oct 29, 2026"
        data-opened-time="09:30 AM"
        data-concern-statement="Struggling with midterm exam pressure and course project deadlines."
        data-referral-source="Student Concern Submission (Online Intake)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Academic Time Management &amp; Study Skills Coaching"
        data-observation="Student demonstrates awareness of academic backlog but manifests mild test-taking anxiety. Receptive to structured weekly study scheduling and study habits tracking."
        data-next-schedule="2026-11-05" data-next-time="09:30 AM - 10:30 AM"
        data-venue="Room 101 (Guidance Consultation Room)">
    </div>

    <!-- Case 2 -->
    <div id="case-CAS-2026-002" data-case-number="CAS-2026-002" data-student-id="2023-01042"
        data-student-name="SANTOS, MARIA C."
        data-program="3rd Year - Bachelor of Science in Information Technology (BSIT)"
        data-department="College of Information and Computing Sciences (CICS)"
        data-concern-type="Emotional / Psychological" data-priority="High Priority" data-status="On-going Intervention"
        data-opened-date="Oct 29, 2026" data-opened-time="01:30 PM"
        data-concern-statement="Severe anxiety attacks and difficulty coping during classroom presentations."
        data-referral-source="Faculty Referral (Prof. D. Navarro)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Cognitive Anxiety De-escalation &amp; Exposure Coaching"
        data-observation="Client expressed significant panic and physiological distress during graded oral presentations. Requires safe-space simulation and breathing techniques training."
        data-next-schedule="2026-11-06" data-next-time="01:30 PM - 02:30 PM" data-venue="Room 103 (Counseling Room)">
    </div>

    <!-- Case 3 -->
    <div id="case-CAS-2026-003" data-case-number="CAS-2026-003" data-student-id="2022-00512"
        data-student-name="MENDOZA, JUAN B." data-program="4th Year - Bachelor of Secondary Education (BSEd)"
        data-department="College of Education (CED)" data-concern-type="Career Concern" data-priority="Low Priority"
        data-status="Under Observation" data-opened-date="Oct 28, 2026" data-opened-time="11:00 AM"
        data-concern-statement="Seeking career coaching and internship placement advice."
        data-referral-source="Student Concern Submission (Career Intake)"
        data-counselor="Guidance Specialist J. Bautista, RGC"
        data-intervention="Career Pathway Exploration &amp; Licensure Readiness"
        data-observation="Student shows high motivation for teacher licensure. Needs clarity on specialized major subject alignments and teaching internship school allocations."
        data-next-schedule="2026-11-10" data-next-time="11:00 AM - 12:00 PM" data-venue="Room 102 (Guidance Office)">
    </div>

    <!-- Case 4 -->
    <div id="case-CAS-2026-004" data-case-number="CAS-2026-004" data-student-id="2024-03115"
        data-student-name="DELA CRUZ, BEA L."
        data-program="2nd Year - Bachelor of Science in Business Administration (BSBA)"
        data-department="College of Business and Accountancy (CBA)" data-concern-type="Behavioral Concern"
        data-priority="High Priority" data-status="In Progress" data-opened-date="Oct 28, 2026"
        data-opened-time="03:00 PM"
        data-concern-statement="Frequent unexcused absences and difficulty focusing during lectures."
        data-referral-source="Faculty Referral (Department Chair Endorsement)"
        data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Attendance Accountability &amp; Behavioral Conditioning"
        data-observation="Client reported sleep dysregulation due to night-shift family responsibilities. Agreed on daily wake-up protocol and weekly check-in with guidance staff."
        data-next-schedule="2026-11-04" data-next-time="03:00 PM - 04:00 PM"
        data-venue="Room 101 (Guidance Consultation Room)">
    </div>

    <!-- Case 5 -->
    <div id="case-CAS-2026-005" data-case-number="CAS-2026-005" data-student-id="2023-02194"
        data-student-name="REYES, MARK ANTHONY" data-program="3rd Year - Bachelor of Science in Computer Science (BSCS)"
        data-department="College of Information and Computing Sciences (CICS)" data-concern-type="Academic Concern"
        data-priority="Medium Priority" data-status="On-going Intervention" data-opened-date="Oct 27, 2026"
        data-opened-time="10:00 AM"
        data-concern-statement="Failed prerequisite subjects; seeking an academic recovery study plan."
        data-referral-source="Academic Referral (Retention Warning Log)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Prerequisite Subject Catch-up &amp; Peer Mentoring"
        data-observation="Student responded constructively to retake schedule and credit mapping. Partnered with student tutor for programming logic review."
        data-next-schedule="2026-11-07" data-next-time="10:00 AM - 11:00 AM" data-venue="Room 104 (Interview Room)">
    </div>

    <!-- Case 6 -->
    <div id="case-CAS-2026-006" data-case-number="CAS-2026-006" data-student-id="2024-01582"
        data-student-name="GONZALES, ALYSSA P."
        data-program="2nd Year - Bachelor of Science in Hospitality Management (BSHM)"
        data-department="College of Hospitality Management" data-concern-type="Emotional / Psychological"
        data-priority="High Priority" data-status="Under Observation" data-opened-date="Oct 27, 2026"
        data-opened-time="02:00 PM"
        data-concern-statement="Overwhelmed by personal problems and exhibiting low self-esteem."
        data-referral-source="Student Concern Submission (Confidential)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Self-Worth Affirmation &amp; Emotional Grounding"
        data-observation="Marked emotional exhaustion noted during consultation. Recommended journaling exercise and assigned safe contact counselor."
        data-next-schedule="2026-11-03" data-next-time="02:00 PM - 03:00 PM" data-venue="Room 103 (Counseling Room)">
    </div>

    <!-- Case 7 -->
    <div id="case-CAS-2026-007" data-case-number="CAS-2026-007" data-student-id="2022-03481"
        data-student-name="BAUTISTA, KEVIN R." data-program="4th Year - Bachelor of Science in Civil Engineering (BSCE)"
        data-department="College of Engineering (COE)" data-concern-type="Family / Personal"
        data-priority="High Priority" data-status="In Progress" data-opened-date="Oct 26, 2026"
        data-opened-time="08:30 AM"
        data-concern-statement="Financial hardships and family distress impacting thesis concentration."
        data-referral-source="Faculty Referral (Engr. R. Flores)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Student Welfare Aid Referral &amp; Stress Coping"
        data-observation="Client expressed heavy concern regarding laboratory fee expenses. Endorsed to Student Welfare Unit for student assistantship evaluation."
        data-next-schedule="2026-11-04" data-next-time="08:30 AM - 09:30 AM"
        data-venue="Room 101 (Guidance Consultation Room)">
    </div>

    <!-- Case 8 -->
    <div id="case-CAS-2026-008" data-case-number="CAS-2026-008" data-student-id="2023-04129"
        data-student-name="VILLANUEVA, PATRICIA M."
        data-program="3rd Year - Bachelor of Arts in Communication (BA Comm)"
        data-department="College of Arts and Social Sciences (CASS)" data-concern-type="Career Concern"
        data-priority="Low Priority" data-status="Resolved" data-opened-date="Oct 25, 2026" data-opened-time="11:30 AM"
        data-concern-statement="Inquired about shifting to another major; completed counseling assessment."
        data-referral-source="Case Registration (Walk-in Direct)" data-counselor="Guidance Specialist J. Bautista, RGC"
        data-intervention="Academic Shifting Assessment &amp; Exit Clearance"
        data-observation="Career interest inventory completed. Student decided to remain in Communication program with renewed interest in corporate PR."
        data-next-schedule="N/A (Case Resolved)" data-next-time="N/A" data-venue="Completed">
    </div>

    <!-- Case 9 -->
    <div id="case-CAS-2026-009" data-case-number="CAS-2026-009" data-student-id="2024-00871"
        data-student-name="AQUINO, CHRISTIAN J." data-program="2nd Year - Bachelor of Science in Criminology (BSCrim)"
        data-department="College of Criminal Justice Education" data-concern-type="Academic Concern"
        data-priority="Medium Priority" data-status="On-going Intervention" data-opened-date="Oct 24, 2026"
        data-opened-time="01:30 PM"
        data-concern-statement="Time management conflict between part-time work and morning classes."
        data-referral-source="Case Registration (Intake Form)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Work-Study Scheduling &amp; Stress Alleviation"
        data-observation="Student agreed to adjust part-time shift hours to prevent missing morning formation and lectures. Showing positive disposition."
        data-next-schedule="2026-11-09" data-next-time="01:30 PM - 02:30 PM"
        data-venue="Room 105 (Consultation Office)">
    </div>

    <!-- Case 10 -->
    <div id="case-CAS-2026-010" data-case-number="CAS-2026-010" data-student-id="2022-01934"
        data-student-name="CASTRO, DIANA MAE" data-program="4th Year - Bachelor of Science in Nursing (BSN)"
        data-department="College of Allied Health Sciences (CAHS)" data-concern-type="Emotional / Psychological"
        data-priority="High Priority" data-status="Under Observation" data-opened-date="Oct 23, 2026"
        data-opened-time="03:30 PM"
        data-concern-statement="Experiencing burnout from clinical hospital duty and lack of sleep."
        data-referral-source="Faculty Referral (Clinical Instructor)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Burnout Recovery Protocol &amp; Wellness Monitoring"
        data-observation="Physical fatigue evident with emotional reactivity. Scheduled for weekly mental health check-ins during hospital rotation break."
        data-next-schedule="2026-11-02" data-next-time="03:30 PM - 04:30 PM"
        data-venue="Room 101 (Guidance Consultation Room)">
    </div>

    <!-- Case 11 -->
    <div id="case-CAS-2026-011" data-case-number="CAS-2026-011" data-student-id="2023-03712"
        data-student-name="FLORES, GABRIEL S." data-program="3rd Year - Bachelor of Elementary Education (BEEd)"
        data-department="College of Education (CED)" data-concern-type="Behavioral Concern"
        data-priority="Medium Priority" data-status="Closed" data-opened-date="Oct 22, 2026" data-opened-time="09:00 AM"
        data-concern-statement="Conflict resolution with classmates during group projects successfully addressed."
        data-referral-source="Faculty Referral (Peer Mediation)" data-counselor="Guidance Specialist J. Bautista, RGC"
        data-intervention="Peer Mediation &amp; Communication Coaching"
        data-observation="Mediation session successfully concluded. Both parties signed mutual understanding agreement. No further behavioral incidents."
        data-next-schedule="N/A (Case Closed)" data-next-time="N/A" data-venue="Completed">
    </div>

    <!-- Case 12 -->
    <div id="case-CAS-2026-012" data-case-number="CAS-2026-012" data-student-id="2024-02205"
        data-student-name="TAN, JUSTINE CHLOE" data-program="2nd Year - Bachelor of Science in Accountancy (BSA)"
        data-department="College of Business and Accountancy (CBA)" data-concern-type="Academic Concern"
        data-priority="Low Priority" data-status="Resolved" data-opened-date="Oct 21, 2026" data-opened-time="10:30 AM"
        data-concern-statement="Adjustment to fast-paced accounting curriculum; completed peer tutoring program."
        data-referral-source="Case Registration (Walk-in Direct)" data-counselor="Dr. Maria Elena Santos, RGC"
        data-intervention="Academic Peer Mentorship &amp; Exam Preparation"
        data-observation="Student successfully completed peer tutoring cycle with marked improvement in qualifying exam scores. Case officially resolved."
        data-next-schedule="N/A (Case Resolved)" data-next-time="N/A" data-venue="Completed">
    </div>
</div>


<script>
    const statusStyles = {
        'In Progress': 'border: 1px solid #3b82f6; background-color: #eff6ff; color: #1d4ed8;',
        'Under Observation': 'border: 1px solid #d97706; background-color: #fffbeb; color: #92400e;',
        'On-going Intervention': 'border: 1px solid #8b5cf6; background-color: #f5f3ff; color: #6d28d9;',
        'Resolved': 'border: 1px solid #10b981; background-color: #ecfdf5; color: #047857;',
        'Closed': 'border: 1px solid #64748b; background-color: #f8fafc; color: #334155;'
    };

    const priorityStyles = {
        'High Priority': 'border: 1px solid #ef4444; background-color: #fef2f2; color: #b91c1c;',
        'Medium Priority': 'border: 1px solid #f59e0b; background-color: #fffbeb; color: #b45309;',
        'Low Priority': 'border: 1px solid #94a3b8; background-color: #f8fafc; color: #475569;'
    };


    function initDynamicCaseLookup() {
        const urlParams = new URLSearchParams(window.location.search);
        let caseId = (urlParams.get('case') || 'CAS-2026-001').trim();

        let caseEl = document.getElementById('case-' + caseId);
        if (!caseEl) {
            caseEl = document.getElementById('case-CAS-2026-001');
            caseId = 'CAS-2026-001';
        }

        if (!caseEl) return;

        const d = caseEl.dataset;

        // 1. Breadcrumbs & Header
        const breadcrumbCase = document.getElementById('breadcrumbCaseNum');
        if (breadcrumbCase) breadcrumbCase.textContent = d.caseNumber;

        // 2. Identity Banner
        const nameEl = document.getElementById('dossierStudentName');
        if (nameEl) nameEl.textContent = d.studentName;

        const priorityBadge = document.getElementById('dossierPriorityBadge');
        if (priorityBadge) {
            priorityBadge.textContent = d.priority;
            priorityBadge.style.cssText = (priorityStyles[d.priority] || priorityStyles['Medium Priority']) + ' border-radius: 50rem; padding: 4px 14px; font-size: 12.5px; font-weight: 600;';
        }

        const statusBadge = document.getElementById('dossierStatusBadge');
        if (statusBadge) {
            statusBadge.textContent = d.status;
            statusBadge.style.cssText = (statusStyles[d.status] || statusStyles['In Progress']) + ' border-radius: 50rem; padding: 4px 14px; font-size: 12.5px; font-weight: 600;';
        }

        const caseNumEl = document.getElementById('dossierCaseNumber');
        if (caseNumEl) caseNumEl.textContent = d.caseNumber;

        const studentIdEl = document.getElementById('dossierStudentId');
        if (studentIdEl) studentIdEl.textContent = d.studentId;

        const concernTypeEl = document.getElementById('dossierConcernType');
        if (concernTypeEl) concernTypeEl.textContent = d.concernType;

        const programEl = document.getElementById('dossierProgram');
        if (programEl) programEl.textContent = d.program;

        const deptEl = document.getElementById('dossierDepartment');
        if (deptEl) deptEl.textContent = d.department;

        const dateEl = document.getElementById('dossierOpenedDate');
        if (dateEl) dateEl.textContent = d.openedDate;

        const timeEl = document.getElementById('dossierOpenedTime');
        if (timeEl) timeEl.textContent = d.openedTime;

        const counselorEl = document.getElementById('dossierCounselor');
        if (counselorEl) counselorEl.textContent = d.counselor;

        // 3. Intake Assessment
        const concernClassEl = document.getElementById('dossierConcernClass');
        if (concernClassEl) concernClassEl.textContent = d.concernType;

        const referralEl = document.getElementById('dossierReferralSource');
        if (referralEl) referralEl.textContent = d.referralSource;

        const statementEl = document.getElementById('dossierConcernStatement');
        if (statementEl) statementEl.textContent = '"' + d.concernStatement + '"';

        // 4. Clinical Observation
        const obsEl = document.getElementById('dossierObservation');
        if (obsEl) obsEl.textContent = d.observation;

        const intervEl = document.getElementById('dossierIntervention');
        if (intervEl) intervEl.textContent = d.intervention;

        const schedVenueEl = document.getElementById('dossierNextScheduleVenue');
        if (schedVenueEl) {
            if (d.nextSchedule && d.nextSchedule !== 'N/A' && !d.nextSchedule.includes('Resolved') && !d.nextSchedule.includes('Closed')) {
                schedVenueEl.textContent = d.nextSchedule + ' • ' + d.nextTime + ' (' + d.venue + ')';
            } else {
                schedVenueEl.textContent = d.nextSchedule + (d.venue && d.venue !== 'Completed' ? ' (' + d.venue + ')' : '');
            }
        }

        // 5. Form Fields
        const statusSelect = document.getElementById('caseViewStatus');
        if (statusSelect) statusSelect.value = d.status;

        const prioritySelect = document.getElementById('caseViewPriority');
        if (prioritySelect) prioritySelect.value = d.priority;

        const counselorInput = document.getElementById('caseViewCounselor');
        if (counselorInput) counselorInput.value = d.counselor;

        const notesTextarea = document.getElementById('caseViewNotes');
        if (notesTextarea) notesTextarea.value = d.observation;
    }

    function handleCaseViewSave(e) {
        e.preventDefault();
        const status = document.getElementById('caseViewStatus').value;
        const priority = document.getElementById('caseViewPriority').value;
        const caseNumEl = document.getElementById('dossierCaseNumber');
        const caseNum = caseNumEl ? caseNumEl.textContent.trim() : 'Case';

        alert('Case ' + caseNum + ' successfully updated to ' + status + ' (' + priority + ')!');
    }

    // Execute immediately and on DOMContentLoaded for complete reliability
    initDynamicCaseLookup();
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDynamicCaseLookup);
    }
</script>