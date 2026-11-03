<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT COUNSELING HISTORY     -->
<!--   DIV-BASED LAYOUT • NATIVE BOOTSTRAP 5.3 • RA 10173 COMPLIANT       -->
<!-- ==================================================================== -->

<!-- 1. PAGE BREADCRUMB & HEADER (Screen Only) -->
<div class="card shadow-sm border-0 mb-4 bg-white no-print"
    style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
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
                    <a href="<?= url('guidance/student_history') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student Information Management
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/student_history') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student History
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Trajectory View
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Counseling Trajectory &amp; Case History
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Comprehensive chronological case trajectory from initial intake, assessment, and intervention,
                    through monitoring and final case closure.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?= url('guidance/student_history') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    style="height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 16px;">
                    <i class="bi bi-arrow-left me-1.5"></i>Back to History
                </a>
                <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center"
                    onclick="window.print()"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 14px; height: 38px; border-radius: 6px; padding: 0 16px; font-weight: 500;">
                    <i class="bi bi-printer me-2"></i>Print History
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-marsu {
        background-color: #800020;
        border-color: #800020;
        color: #ffffff;
    }

    .btn-marsu:hover {
        background-color: #660019;
        border-color: #660019;
        color: #ffffff;
    }

    /* Overall Timeline Milestone Styles */
    .timeline-container {
        position: relative;
    }

    .timeline-milestone {
        position: relative;
        padding-left: 54px;
        padding-bottom: 28px;
    }

    .timeline-milestone:last-child {
        padding-bottom: 0;
    }

    .timeline-milestone::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 40px;
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        color: #ffffff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
        z-index: 2;
    }

    .timeline-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: box-shadow 0.2s ease;
    }

    .timeline-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    /* Print Formatting Rules */
    @media print {
        body {
            background-color: #ffffff !important;
            color: #000000 !important;
            font-size: 10pt !important;
        }

        .no-print,
        nav,
        .breadcrumb,
        .btn,
        #studentSearchToolbar,
        header,
        sidebar,
        aside,
        .navbar {
            display: none !important;
        }

        .print-only {
            display: block !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .timeline-card {
            border: 1px solid #333333 !important;
            box-shadow: none !important;
            margin-bottom: 14px !important;
        }

        .timeline-milestone::before {
            background-color: #333333 !important;
        }
    }
</style>

<!-- ==================================================================== -->
<!-- OFFICIAL MARSU PRINT HEADER (PRINT ONLY)                             -->
<!-- ==================================================================== -->
<div class="print-only text-center mb-4" style="display: none;">
    <div
        style="font-size: 11pt; text-transform: uppercase; font-family: 'Times New Roman', serif; letter-spacing: 0.5px;">
        Republic of the Philippines</div>
    <div
        style="font-size: 15pt; font-weight: bold; color: #800020; font-family: 'Times New Roman', serif; margin-top: 2px;">
        MARINDUQUE STATE UNIVERSITY</div>
    <div style="font-size: 11pt; font-weight: bold; font-family: 'Times New Roman', serif;">OFFICE OF STUDENT AFFAIRS
        &amp; SERVICES</div>
    <div style="font-size: 10.5pt; font-style: italic; font-family: 'Times New Roman', serif;">Guidance and Counseling
        Services Center</div>
    <div style="font-size: 9.5pt; color: #333; font-family: 'Times New Roman', serif;">Panfilo Manguera Sr. Rd., Boac,
        Marinduque</div>
    <div
        style="font-size: 13pt; font-weight: bold; margin-top: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
        STUDENT COUNSELING TRAJECTORY &amp; CASE HISTORY LEDGER</div>
    <div style="font-size: 9.5pt; color: #555;">Official Clinical History: Assessment, Intervention, Monitoring &amp;
        Case Closure</div>
    <hr style="border-top: 2px solid #800020; margin-top: 8px; margin-bottom: 14px;">
</div>

<!-- 2. SELECTED STUDENT PROFILE BANNER (Screen & Print) -->
<div class="card shadow-sm border-0 mb-4 bg-white"
    style="border: 1px solid #E2E8F0 !important; border-left: 4px solid #800020 !important; border-radius: 8px;">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <h5 class="fw-bold mb-0 text-dark" id="displayStudentName" style="font-size: 19px;">
                        SANTOS, MARIA C.
                    </h5>
                    <span class="badge font-monospace" id="displayStudentID"
                        style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 12.5px;">
                        2023-01042
                    </span>
                    <span class="badge" id="caseStatusBadge"
                        style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                        Case Status: Resolved / Closed
                    </span>
                </div>
                <div class="text-muted" style="font-size: 13.5px;">
                    <span id="displayProgramYear" class="fw-medium text-dark">BaPOS - 2nd Year</span>
                    <span class="mx-2">&bull;</span>
                    <span id="displayCollege">College of Arts and Sciences</span>
                </div>
            </div>
            <div class="col-md-4 col-12 text-md-end text-start">
                <div class="small text-muted" id="displayCounselor">
                    Assigned: Dr. Elena M. Santos, RGC
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. COMPLETE WORKFLOW TIMELINE CONTAINER -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
        style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="fw-bold mb-0 text-dark" style="font-size: 15.5px;">
            <i class="bi bi-clock-history me-2" style="color: #800020;"></i>Chronological Case Trajectory
        </h6>
        <span class="text-muted small" id="timelineRangeBadge">Intake to Final Case Closure</span>
    </div>

    <div class="card-body p-4" style="background-color: #F8FAFC;">
        <div class="timeline-container px-lg-2">

            <!-- STEP 1: CASE INTAKE & REGISTRATION -->
            <div class="timeline-milestone">
                <div class="timeline-milestone-icon" style="background-color: #800020;">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div class="timeline-card">
                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold text-dark fs-6">Step 1: Case Intake &amp; Registration</span>
                            <span class="badge ms-2"
                                style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 11px;">Phase
                                1</span>
                        </div>
                        <span class="badge bg-light text-secondary border font-monospace" id="tl_intake_date"
                            style="font-size: 12px;">2026-09-15</span>
                    </div>

                    <div class="row g-2 mb-3" style="font-size: 13.5px;">
                        <div class="col-md-4 col-12">
                            <span class="text-muted d-block small">Intake Mode:</span>
                            <strong class="text-dark" id="tl_intake_mode">Faculty Referral</strong>
                        </div>
                        <div class="col-md-4 col-12">
                            <span class="text-muted d-block small">Presenting Classification:</span>
                            <span class="badge"
                                style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D;"
                                id="tl_intake_concern">Mental Health &amp; Emotional Well-being</span>
                        </div>
                        <div class="col-md-4 col-12">
                            <span class="text-muted d-block small">Initial Urgency / Priority:</span>
                            <span class="badge"
                                style="background-color: #FEF2F2; color: #991B1B; border: 1px solid #FECACA;"
                                id="tl_intake_priority">High Priority</span>
                        </div>
                    </div>

                    <!-- Faculty Referral Details Box -->
                    <div id="tl_referral_box" class="p-2.5 rounded bg-light border mb-2" style="font-size: 13px;">
                        <span class="badge bg-primary text-white me-1">Faculty Endorsement:</span>
                        <strong class="text-dark" id="tl_referring_faculty">Prof. Elena Bautista (College Dean /
                            Instructor)</strong>
                        <div class="text-secondary mt-1 small" id="tl_referral_reason">
                            Student exhibits intense trembling, panic responses, and inability to speak during class
                            debate recitations.
                        </div>
                    </div>

                    <div class="p-2.5 rounded bg-light"
                        style="font-size: 13px; color: #334155; border-left: 3px solid #800020;">
                        <span class="fw-semibold text-dark d-block mb-1">Student Intake Statement &amp; Presenting
                            Concern:</span>
                        <span id="tl_intake_statement">"I experience overwhelming test and speech anxiety during oral
                            examinations, causing dizziness, palpitations, and mental block."</span>
                    </div>
                </div>
            </div>

            <!-- STEP 2: CASE ASSESSMENT -->
            <div class="timeline-milestone">
                <div class="timeline-milestone-icon" style="background-color: #0284C7;">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                </div>
                <div class="timeline-card">
                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold text-dark fs-6">Step 2: Clinical Assessment</span>
                            <span class="badge ms-2"
                                style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 11px;">Phase
                                2</span>
                        </div>
                        <span class="badge bg-light text-secondary border font-monospace" id="tl_assessment_date"
                            style="font-size: 12px;">2026-09-22</span>
                    </div>

                    <div class="row g-2 mb-3" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Assessment Activity Administered:</span>
                            <strong class="text-dark" id="tl_assessment_activity">Diagnostic Counseling Intake &amp;
                                Somatic Symptom Mapping</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Standardized Tool / Inventory Used:</span>
                            <strong class="text-dark" id="tl_assessment_tool">DASS-21 Anxiety Scale &amp; Performance
                                Anxiety Inventory</strong>
                        </div>
                    </div>

                    <div class="p-2.5 rounded bg-light mb-2" style="font-size: 13px; color: #334155;">
                        <strong class="text-dark d-block mb-1">Clinical Observation:</strong>
                        <span id="tl_counselor_observation">Client was cooperative yet visibly tense when discussing
                            public recitations. Autonomic indicators including shallow respiration and muscle tremors
                            observed upon recalling debate triggers.</span>
                    </div>

                    <div class="p-2.5 rounded bg-light"
                        style="font-size: 13px; color: #334155; border-left: 3px solid #0284C7;">
                        <strong class="text-dark d-block mb-1">Assessment Findings:</strong>
                        <span id="tl_assessment_findings">Significant acute evaluation anxiety with sympathetic nervous
                            system hyperarousal; no generalized impairment in academic aptitude or cognitive
                            reasoning.</span>
                    </div>
                </div>
            </div>

            <!-- STEP 3: INTERVENTION & CASE PLAN -->
            <div class="timeline-milestone">
                <div class="timeline-milestone-icon" style="background-color: #7C3AED;">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div class="timeline-card">
                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold text-dark fs-6">Step 3: Intervention &amp; Case Plan</span>
                            <span class="badge ms-2"
                                style="background-color: #F5F3FF; color: #6D28D9; border: 1px solid #DDD6FE; font-size: 11px;">Phase
                                3</span>
                        </div>
                        <span class="badge bg-light text-secondary border font-monospace"
                            id="tl_assigned_counselor_badge" style="font-size: 12px;">Dr. Elena M. Santos, RGC</span>
                    </div>

                    <div class="row g-2 mb-3" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Intervention Modality:</span>
                            <strong class="text-dark" id="tl_intervention_modality">Cognitive Behavioral Psychoeducation
                                &amp; Sensory Grounding</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Target Planned Timeline:</span>
                            <strong class="text-dark" id="tl_intervention_timeline">4 Structured Bi-Weekly Sessions (6
                                Weeks)</strong>
                        </div>
                    </div>

                    <div class="p-2.5 rounded bg-light mb-2" style="font-size: 13px; color: #334155;">
                        <strong class="text-dark d-block mb-1">Action Taken &amp; Immediate Intervention:</strong>
                        <span id="tl_actions_taken">Conducted guided 4-7-8 diaphragmatic breathing exercises; formulated
                            pocket-sized cognitive reframing cards for pre-recitation panic regulation.</span>
                    </div>

                    <div class="p-2.5 rounded bg-light mb-2" style="font-size: 13px; color: #334155;">
                        <strong class="text-dark d-block mb-1">Target Goals:</strong>
                        <span id="tl_target_goals">1. Reduce somatic tremor and heart racing before recitations. 2.
                            Successfully deliver 3 oral class presentations without avoidance.</span>
                    </div>

                    <div class="p-2.5 rounded bg-light mb-2"
                        style="font-size: 13px; color: #334155; border-left: 3px solid #7C3AED;">
                        <strong class="text-dark d-block mb-1">Action Steps &amp; Homework:</strong>
                        <span id="tl_action_steps">Daily five-minute mindfulness practice; visualization drills before
                            recitation; maintain anxiety trigger journal.</span>
                    </div>

                    <div class="p-2.5 rounded bg-light text-muted small" id="tl_additional_comments_box">
                        <strong>Additional Counselor Notes:</strong> <span id="tl_additional_comments">Coordinated
                            confidential accommodation notification with department faculty chair.</span>
                    </div>
                </div>
            </div>

            <!-- STEP 4: MONITORING & FOLLOW-UP -->
            <div class="timeline-milestone">
                <div class="timeline-milestone-icon" style="background-color: #D97706;">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div class="timeline-card">
                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold text-dark fs-6">Step 4: Monitoring &amp; Follow-Up</span>
                            <span class="badge ms-2"
                                style="background-color: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; font-size: 11px;">Phase
                                4</span>
                        </div>
                        <span class="badge"
                            style="background-color: #FFFDF0; color: #856404; border: 1px solid #FDE68A; font-size: 12px;"
                            id="tl_monitoring_badge">Session 3 of 4</span>
                    </div>

                    <div class="row g-2 mb-3" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Scheduled Return Date:</span>
                            <strong class="text-dark font-monospace" id="tl_return_date">2026-10-15 &bull; 02:30
                                PM</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Session Format:</span>
                            <span class="badge bg-light text-dark border">Face-to-Face (GCO Room 102)</span>
                        </div>
                    </div>

                    <div class="p-2.5 rounded bg-light"
                        style="font-size: 13px; color: #334155; border-left: 3px solid #D97706;">
                        <strong class="text-dark d-block mb-1">Counselor Progress Note &amp; Follow-up
                            Observations:</strong>
                        <span id="tl_progress_note">Client returned with visible improvement. Client successfully
                            delivered debate arguments in BA Political Science coursework without dissociation or flight
                            response. Anxiety rating decreased by 45%.</span>
                    </div>
                </div>
            </div>

            <!-- STEP 5: CASE CLOSURE & DISPOSITION -->
            <div class="timeline-milestone">
                <div class="timeline-milestone-icon" style="background-color: #166534;">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div class="timeline-card">
                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold text-dark fs-6">Step 5: Case Closure &amp; Final Disposition</span>
                            <span class="badge ms-2"
                                style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 11px;">Phase
                                5</span>
                        </div>
                        <span class="badge bg-light text-secondary border font-monospace" id="tl_closure_date"
                            style="font-size: 12px;">2026-10-30</span>
                    </div>

                    <div class="row g-2 mb-3" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Case Resolution Status:</span>
                            <span class="badge"
                                style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 13px; font-weight: 600;"
                                id="tl_case_disposition">
                                Goals Met / Case Resolved
                            </span>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block small">Case Outcome:</span>
                            <strong class="text-dark" id="tl_case_outcome">Independent Self-Regulation Achieved</strong>
                        </div>
                    </div>

                    <div class="p-2.5 rounded bg-light mb-2" style="font-size: 13px; color: #334155;">
                        <strong class="text-dark d-block mb-1">Final Counseling Evaluation &amp; Closing
                            Summary:</strong>
                        <span id="tl_closing_summary">All clinical targets accomplished. Student now participates
                            voluntarily in oral recitations and academic symposium discussions. Grounding exercises
                            effectively adopted as sustained self-care routine.</span>
                    </div>

                    <div class="p-2.5 rounded bg-light"
                        style="font-size: 13px; color: #334155; border-left: 3px solid #166534;">
                        <strong class="text-dark d-block mb-1">Post-Closure Guidance Recommendations:</strong>
                        <span id="tl_closing_recommendations">Annual voluntary check-in at the Guidance Office; maintain
                            active membership in university public speaking peer circles.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 4. PRINT-ONLY SIGNATURE BLOCK -->
<div class="print-only mt-5" style="display: none;">
    <div class="row pt-4" style="display: flex; justify-content: space-between;">
        <div style="width: 45%;">
            <p style="font-size: 10pt; margin-bottom: 45px;">Certified Correct by Attending Counselor:</p>
            <p style="font-size: 11pt; font-weight: bold; text-decoration: underline; margin-bottom: 2px;">DR. ELENA M.
                SANTOS, RGC</p>
            <p style="font-size: 9.5pt; color: #555; margin-bottom: 0;">Registered Guidance Counselor &bull; PRC Lic.
                001248</p>
        </div>
        <div style="width: 45%; text-align: right;">
            <p style="font-size: 10pt; margin-bottom: 45px;">Noted by:</p>
            <p style="font-size: 11pt; font-weight: bold; text-decoration: underline; margin-bottom: 2px;">DIRECTOR,
                OSAS</p>
            <p style="font-size: 9.5pt; color: #555; margin-bottom: 0;">Office of Student Affairs &amp; Services</p>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   STUDENT HISTORIES DATASET STORE (FRONTEND DIV CONTAINER)            -->
<!-- ==================================================================== -->
<div id="studentHistoryDatasetStore" class="d-none" aria-hidden="true">
    <!-- Student 1 -->
    <div id="hist-2023-01089"
        data-student-id="2023-01089"
        data-student-name="RAMOS, CARLOS M."
        data-program-year="BSIS - 3rd Year"
        data-college="College of Information and Computing Sciences"
        data-case-ref="CS-2026-002"
        data-counselor="Dr. Maria Ramos, RGC"
        data-status-text="Case Status: Under Monitoring"
        data-status-class="bg-warning-subtle text-warning border border-warning-subtle"
        data-intake-date="2026-09-28"
        data-intake-mode="Self-Initiated Intake"
        data-intake-concern="Academic Performance &amp; Retention Risk"
        data-intake-priority="Medium Priority"
        data-referring-faculty="None (Direct Student Walk-in)"
        data-referral-reason="Student self-reported falling behind in multiple major programming laboratory submissions and capstone deadlines."
        data-intake-statement='"I have been feeling overwhelmed trying to balance programming deliverables with part-time work, leading to severe procrastination."'
        data-assessment-date="2026-10-05"
        data-assessment-activity="Study Habits &amp; Academic Time Allocation Audit"
        data-assessment-tool="Study Habits and Attitude Inventory (SHAI)"
        data-counselor-observation="Student showed good motivation and self-awareness but lacks structured daily time-blocking tools, resulting in deadline panic."
        data-assessment-findings="Deficits in academic time-management and prioritization; clear technical aptitude verified by previous semester transcript."
        data-intervention-modality="Academic Retention Counseling &amp; Structured Time-Blocking"
        data-intervention-timeline="3 Bi-Weekly Counseling Sessions"
        data-actions-taken="Constructed structured weekly study timetable; drafted laboratory milestone catch-up plan in coordination with course instructor."
        data-target-goals="1. Complete backlog of 4 laboratory machine problems. 2. Establish fixed daily 2-hour uninterrupted coding blocks."
        data-action-steps="Utilize digital calendar reminders; submit weekly progress report to guidance counselor; attend peer tutoring review sessions."
        data-additional-comments="Student showed commitment to academic recovery roadmap."
        data-return-date="2026-10-29 • 10:00 AM"
        data-monitoring-badge="Session 2 of 3"
        data-progress-note="Student successfully submitted 3 out of 4 backlog laboratory projects. Midterm examination scores improved to passing marks across all courses."
        data-closure-date="In Progress (Scheduled for Nov 20, 2026)"
        data-case-disposition="Active Retention Monitoring"
        data-case-outcome="Academic Progress on Track"
        data-closing-summary="Student demonstrated sustained discipline in time management. Final case evaluation scheduled upon semester capstone presentation."
        data-closing-recommendations="Continue weekly time-blocking schedule; maintain bi-weekly peer accountability check-in.">
    </div>

    <!-- Student 2 -->
    <div id="hist-2023-01042"
        data-student-id="2023-01042"
        data-student-name="SANTOS, MARIA C."
        data-program-year="BaPOS - 2nd Year"
        data-college="College of Arts and Sciences"
        data-case-ref="CS-2026-001"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-status-text="Case Status: Resolved / Closed"
        data-status-class="bg-success-subtle text-success border border-success-subtle"
        data-intake-date="2026-09-15"
        data-intake-mode="Faculty Referral"
        data-intake-concern="Mental Health &amp; Emotional Well-being"
        data-intake-priority="High Priority"
        data-referring-faculty="Prof. Elena Bautista (Department Chair)"
        data-referral-reason="Student exhibits intense trembling, panic responses, and inability to speak during class debate recitations."
        data-intake-statement='"I experience overwhelming test and speech anxiety during oral examinations, causing dizziness, palpitations, and mental block."'
        data-assessment-date="2026-09-22"
        data-assessment-activity="Diagnostic Counseling Intake &amp; Somatic Symptom Mapping"
        data-assessment-tool="DASS-21 Anxiety Scale &amp; Performance Anxiety Inventory"
        data-counselor-observation="Client was cooperative yet visibly tense when discussing public recitations. Autonomic indicators including shallow respiration and muscle tremors observed upon recalling debate triggers."
        data-assessment-findings="Significant acute evaluation anxiety with sympathetic nervous system hyperarousal; no generalized impairment in academic aptitude or cognitive reasoning."
        data-intervention-modality="Cognitive Behavioral Psychoeducation &amp; Sensory Grounding"
        data-intervention-timeline="4 Structured Bi-Weekly Sessions (6 Weeks)"
        data-actions-taken="Conducted guided 4-7-8 diaphragmatic breathing exercises; formulated pocket-sized cognitive reframing cards for pre-recitation panic regulation."
        data-target-goals="1. Reduce somatic tremor and heart racing before recitations. 2. Successfully deliver 3 oral class presentations without avoidance."
        data-action-steps="Daily five-minute mindfulness practice; visualization drills before recitation; maintain anxiety trigger journal."
        data-additional-comments="Coordinated confidential accommodation notification with department faculty chair."
        data-return-date="2026-10-15 • 02:30 PM"
        data-monitoring-badge="Session 3 of 4"
        data-progress-note="Client returned with visible improvement. Client successfully delivered debate arguments in BA Political Science coursework without dissociation or flight response. Anxiety rating decreased by 45%."
        data-closure-date="2026-10-30"
        data-case-disposition="Goals Met / Case Resolved"
        data-case-outcome="Independent Self-Regulation Achieved"
        data-closing-summary="All clinical targets accomplished. Student now participates voluntarily in oral recitations and academic symposium discussions. Grounding exercises effectively adopted as sustained self-care routine."
        data-closing-recommendations="Annual voluntary check-in at the Guidance Office; maintain active membership in university public speaking peer circles.">
    </div>

    <!-- Student 3 -->
    <div id="hist-2022-00512"
        data-student-id="2022-00512"
        data-student-name="MENDOZA, JUAN B."
        data-program-year="BEED - 3rd Year"
        data-college="College of Education"
        data-case-ref="CS-2026-004"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-status-text="Case Status: Resolved / Closed"
        data-status-class="bg-success-subtle text-success border border-success-subtle"
        data-intake-date="2026-09-05"
        data-intake-mode="Faculty Referral"
        data-intake-concern="Academic Retention &amp; Exam Anxiety"
        data-intake-priority="High Priority"
        data-referring-faculty="Dr. Maria Ramos (Faculty Chair)"
        data-referral-reason="Student accumulated multiple failing grades in professional education prerequisites."
        data-intake-statement='"I have difficulty retaining voluminous pedagogy concepts and panic during timed diagnostic exams."'
        data-assessment-date="2026-09-12"
        data-assessment-activity="Learning Style Assessment &amp; Test Taking Evaluation"
        data-assessment-tool="VARK Learning Styles Model &amp; Test Anxiety Scale"
        data-counselor-observation="Student is a visual and kinesthetic learner struggling with purely auditory lecture delivery methods."
        data-assessment-findings="Mismatch between instructional delivery and learning modality; retention deficits mitigated by structured visual mapping."
        data-intervention-modality="Multisensory Study Strategies &amp; Concept Mapping Coaching"
        data-intervention-timeline="3 Counseling &amp; Coaching Sessions"
        data-actions-taken="Introduced visual concept mapping techniques and flashcard active recall protocols for licensure exam prep."
        data-target-goals="1. Attain passing marks on all diagnostic pedagogy exams. 2. Formulate visual study summaries for all professional ed subjects."
        data-action-steps="Formed study pair with peer honor student; completed weekly practice exams."
        data-additional-comments="Student showed remarkable enthusiasm when using active recall flashcards."
        data-return-date="2026-10-12 • 09:00 AM"
        data-monitoring-badge="Session 2 of 3"
        data-progress-note="Student achieved an 88% passing score on the mid-term pedagogy mock examination."
        data-closure-date="2026-10-23"
        data-case-disposition="Goals Met / Retention Risk Cleared"
        data-case-outcome="Academic Standing Restored"
        data-closing-summary="Student cleared academic probation deficiency and regained regular standing in the Bachelor of Elementary Education program."
        data-closing-recommendations="Continue utilizing concept mapping for upcoming board exam licensure review.">
    </div>

    <!-- Student 4 -->
    <div id="hist-2024-03115"
        data-student-id="2024-03115"
        data-student-name="DELA CRUZ, BEA L."
        data-program-year="BSTM - 1st Year"
        data-college="College of Business and Accountancy"
        data-case-ref="CS-2026-005"
        data-counselor="Dr. Elena M. Santos, RGC"
        data-status-text="Case Status: Resolved / Closed"
        data-status-class="bg-success-subtle text-success border border-success-subtle"
        data-intake-date="2026-09-14"
        data-intake-mode="Self-Initiated Intake"
        data-intake-concern="Career Guidance &amp; Course Alignment"
        data-intake-priority="Low Priority"
        data-referring-faculty="None (Direct Walk-in)"
        data-referral-reason="Student questioned whether tourism management matches her creative career strengths."
        data-intake-statement='"I enrolled because of family preference but feel unsure if this career path matches my personal goals."'
        data-assessment-date="2026-09-20"
        data-assessment-activity="Career Interest Profiling &amp; Vocational Trait Exploration"
        data-assessment-tool="Holland RIASEC Occupational Codes Assessment"
        data-counselor-observation="Student demonstrated high Enterprising and Artistic traits compatible with hospitality events and international travel management."
        data-assessment-findings="Good aptitude and career compatibility with tourism industry specialization in events management."
        data-intervention-modality="Career Exploration &amp; Strategic Curriculum Mapping"
        data-intervention-timeline="2 Individual Vocational Counseling Sessions"
        data-actions-taken="Reviewed curriculum pathways; introduced alumni mentorship connections in tourism operations."
        data-target-goals="1. Clarify long-term career aspirations. 2. Formulate 4-year academic development plan."
        data-action-steps="Attend hospitality career seminar; participate in campus tourism association."
        data-additional-comments="Student expressed renewed motivation."
        data-return-date="2026-10-08 • 01:30 PM"
        data-monitoring-badge="Session 2 of 2"
        data-progress-note="Student joined the OSAS student ambassador team and confirmed satisfaction with course selection."
        data-closure-date="2026-10-18"
        data-case-disposition="Goals Met / Case Resolved"
        data-case-outcome="Career Confidence Established"
        data-closing-summary="Student has fully settled into first-year coursework with enthusiasm."
        data-closing-recommendations="Maintain semester career portfolio.">
    </div>
</div>

<!-- ==================================================================== -->
<!--   DYNAMIC HISTORY LOOKUP ENGINE (FRONTEND JAVASCRIPT)                -->
<!-- ==================================================================== -->
<script>
    // Normalization helper strictly restricting programs to BSIS, BSTM, BEED, BaPOS
    function normalizeProgram(val) {
        if (!val) return 'BSIS';
        const s = String(val).toUpperCase();
        if (s.includes('IS') || s.includes('INFO') || s.includes('COMP') || s.includes('IT')) return 'BSIS';
        if (s.includes('TOUR') || s.includes('BSTM') || s.includes('TM')) return 'BSTM';
        if (s.includes('EDUC') || s.includes('BEED') || s.includes('ELED') || s.includes('TEACH')) return 'BEED';
        if (s.includes('POL') || s.includes('BAPOS') || s.includes('POS') || s.includes('ARTS')) return 'BaPOS';
        return 'BSIS';
    }

    // Normalization helper strictly restricting year level to 1st Year, 2nd Year, 3rd Year, 4th Year
    function normalizeYear(val) {
        if (!val) return '1st Year';
        const s = String(val).toLowerCase();
        if (s.includes('4') || s.includes('fourth')) return '4th Year';
        if (s.includes('3') || s.includes('third')) return '3rd Year';
        if (s.includes('2') || s.includes('second')) return '2nd Year';
        if (s.includes('1') || s.includes('first')) return '1st Year';
        return '1st Year';
    }

    // Dynamic lookup and render function reading directly from div dataset store
    function renderStudentHistory() {
        // Integrate any newly registered case from case_registration.php in localStorage into the div store
        try {
            const registeredCases = JSON.parse(localStorage.getItem('marsu_registered_cases') || '[]');
            const store = document.getElementById('studentHistoryDatasetStore');
            if (store && Array.isArray(registeredCases)) {
                registeredCases.forEach(rc => {
                    if (rc.student_id && !document.getElementById('hist-' + rc.student_id)) {
                        const cleanProg = normalizeProgram(rc.program);
                        const cleanYr = normalizeYear(rc.year);
                        const newEl = document.createElement('div');
                        newEl.id = 'hist-' + rc.student_id;
                        newEl.dataset.studentId = rc.student_id;
                        newEl.dataset.studentName = rc.student_name || "Enrolled Client";
                        newEl.dataset.programYear = cleanProg + " - " + cleanYr;
                        newEl.dataset.college = rc.college || "College of Information and Computing Sciences";
                        newEl.dataset.caseRef = rc.case_ref || "CS-2026-NEW";
                        newEl.dataset.counselor = rc.counselor || "Dr. Elena M. Santos, RGC";
                        newEl.dataset.statusText = "Case Status: Case Registered";
                        newEl.dataset.statusClass = "bg-primary-subtle text-primary border border-primary-subtle";
                        newEl.dataset.intakeDate = rc.intake_date || new Date().toISOString().split('T')[0];
                        newEl.dataset.intakeMode = rc.client_type || "Enrolled Student";
                        newEl.dataset.intakeConcern = rc.concern || "Guidance Consultation";
                        newEl.dataset.intakePriority = rc.priority || "Medium Priority";
                        newEl.dataset.referringFaculty = rc.referring_faculty || "Faculty Referral";
                        newEl.dataset.referralReason = rc.referral_reason || "Referred for guidance support.";
                        newEl.dataset.intakeStatement = rc.intake_statement || "Student registered for guidance consultation.";
                        newEl.dataset.assessmentDate = rc.assessment_date || new Date().toISOString().split('T')[0];
                        newEl.dataset.assessmentActivity = rc.assessment_activity || "Intake Diagnostic Evaluation";
                        newEl.dataset.assessmentTool = rc.assessment_tool || "Diagnostic Interview";
                        newEl.dataset.counselorObservation = rc.counselor_observation || "Cooperative student engagement observed.";
                        newEl.dataset.assessmentFindings = rc.assessment_findings || "Appropriate for guidance intervention.";
                        newEl.dataset.interventionModality = rc.intervention_type || "Individual Counseling";
                        newEl.dataset.interventionTimeline = rc.target_timeline || "3 Scheduled Sessions";
                        newEl.dataset.actionsTaken = rc.actions_taken || "Initial counseling intake completed.";
                        newEl.dataset.targetGoals = rc.case_goals || "Supportive guidance and outcome monitoring.";
                        newEl.dataset.actionSteps = rc.case_plan || "Scheduled follow-up counseling sessions.";
                        newEl.dataset.additionalComments = rc.additional_comments || "None";
                        newEl.dataset.returnDate = rc.return_schedule || "Next scheduled session";
                        newEl.dataset.monitoringBadge = "Session 1";
                        newEl.dataset.progressNote = rc.progress_note || "Intake confirmed.";
                        newEl.dataset.closureDate = "Active Case";
                        newEl.dataset.caseDisposition = "Active Monitoring";
                        newEl.dataset.caseOutcome = "In Progress";
                        newEl.dataset.closingSummary = "Case currently in progress.";
                        newEl.dataset.closingRecommendations = "Attend scheduled counseling sessions.";
                        store.appendChild(newEl);
                    }
                });
            }
        } catch (e) {
            console.error('Storage sync error:', e);
        }

        // Support dynamic lookup based on ?id= or ?student_id= query parameter
        const urlParams = new URLSearchParams(window.location.search);
        let selectedId = (urlParams.get('id') || urlParams.get('student_id') || '2023-01042').trim();

        let histEl = document.getElementById('hist-' + selectedId);
        if (!histEl) {
            histEl = document.getElementById('hist-2023-01042') || document.querySelector('#studentHistoryDatasetStore > div');
        }

        if (!histEl) return;

        const d = histEl.dataset;

        // Profile Banner
        const nameEl = document.getElementById('displayStudentName');
        if (nameEl) nameEl.textContent = d.studentName;

        const idEl = document.getElementById('displayStudentID');
        if (idEl) idEl.textContent = d.studentId;

        const progEl = document.getElementById('displayProgramYear');
        if (progEl) progEl.textContent = d.programYear;

        const colEl = document.getElementById('displayCollege');
        if (colEl) colEl.textContent = d.college;

        const refEl = document.getElementById('displayCaseRef');
        if (refEl) refEl.textContent = d.caseRef;

        const counsEl = document.getElementById('displayCounselor');
        if (counsEl) counsEl.textContent = 'Assigned: ' + d.counselor;

        const statusBadge = document.getElementById('caseStatusBadge');
        if (statusBadge) {
            statusBadge.textContent = d.statusText;
            if (d.statusClass) {
                statusBadge.className = 'badge ' + d.statusClass;
            }
        }

        // Milestone 1: Intake
        const inDate = document.getElementById('tl_intake_date');
        if (inDate) inDate.textContent = d.intakeDate;

        const inMode = document.getElementById('tl_intake_mode');
        if (inMode) inMode.textContent = d.intakeMode;

        const inConcern = document.getElementById('tl_intake_concern');
        if (inConcern) inConcern.textContent = d.intakeConcern;

        const inPriority = document.getElementById('tl_intake_priority');
        if (inPriority) inPriority.textContent = d.intakePriority;

        const inFaculty = document.getElementById('tl_referring_faculty');
        if (inFaculty) inFaculty.textContent = d.referringFaculty;

        const inReason = document.getElementById('tl_referral_reason');
        if (inReason) inReason.textContent = d.referralReason;

        const inStmt = document.getElementById('tl_intake_statement');
        if (inStmt) inStmt.textContent = d.intakeStatement;

        // Milestone 2: Assessment
        const assDate = document.getElementById('tl_assessment_date');
        if (assDate) assDate.textContent = d.assessmentDate;

        const assAct = document.getElementById('tl_assessment_activity');
        if (assAct) assAct.textContent = d.assessmentActivity;

        const assTool = document.getElementById('tl_assessment_tool');
        if (assTool) assTool.textContent = d.assessmentTool;

        const assObs = document.getElementById('tl_counselor_observation');
        if (assObs) assObs.textContent = d.counselorObservation;

        const assFind = document.getElementById('tl_assessment_findings');
        if (assFind) assFind.textContent = d.assessmentFindings;

        // Milestone 3: Intervention
        const badgeCounselor = document.getElementById('tl_assigned_counselor_badge');
        if (badgeCounselor) badgeCounselor.textContent = d.counselor;

        const intMod = document.getElementById('tl_intervention_modality');
        if (intMod) intMod.textContent = d.interventionModality;

        const intTime = document.getElementById('tl_intervention_timeline');
        if (intTime) intTime.textContent = d.interventionTimeline;

        const intActions = document.getElementById('tl_actions_taken');
        if (intActions) intActions.textContent = d.actionsTaken;

        const intGoals = document.getElementById('tl_target_goals');
        if (intGoals) intGoals.textContent = d.targetGoals;

        const intSteps = document.getElementById('tl_action_steps');
        if (intSteps) intSteps.textContent = d.actionSteps;

        const intComments = document.getElementById('tl_additional_comments');
        if (intComments) intComments.textContent = d.additionalComments;

        // Milestone 4: Monitoring & Follow-Up
        const retDate = document.getElementById('tl_return_date');
        if (retDate) retDate.textContent = d.returnDate;

        const monBadge = document.getElementById('tl_monitoring_badge');
        if (monBadge) monBadge.textContent = d.monitoringBadge;

        const progNote = document.getElementById('tl_progress_note');
        if (progNote) progNote.textContent = d.progressNote;

        // Milestone 5: Case Closure
        const cloDate = document.getElementById('tl_closure_date');
        if (cloDate) cloDate.textContent = d.closureDate;

        const cloDisp = document.getElementById('tl_case_disposition');
        if (cloDisp) cloDisp.textContent = d.caseDisposition;

        const cloOut = document.getElementById('tl_case_outcome');
        if (cloOut) cloOut.textContent = d.caseOutcome;

        const cloSum = document.getElementById('tl_closing_summary');
        if (cloSum) cloSum.textContent = d.closingSummary;

        const cloRec = document.getElementById('tl_closing_recommendations');
        if (cloRec) cloRec.textContent = d.closingRecommendations;
    }

    // Execute immediately and on DOMContentLoaded for complete reliability
    renderStudentHistory();
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderStudentHistory);
    }
</script>