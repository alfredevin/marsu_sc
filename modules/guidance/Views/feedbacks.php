<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STUDENT EVALUATION RECORDS           -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 15px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 500;">
                    Guidance & Counseling Services
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Student Evaluation Records
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Student Evaluation Records
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Maintain comprehensive evaluation records associated with guidance activities, counseling interventions, career guidance, workshops, assessments, and counseling plans.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-generate-eval-report"
                style="border: 1px solid #ced4da; background-color: #fff; color: #2D3748; font-size: 13.5px; height: 34px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                <i class="bi bi-file-earmark-bar-graph me-1.5 text-primary"></i>Generate Report
            </button>
            <button type="button" class="btn text-white shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-add-evaluation-record"
                style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; height: 34px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                <i class="bi bi-plus-lg me-1.5"></i>New Evaluation
            </button>
        </div>
    </div>
</div>

<!-- STATUTORY DATA PRIVACY & ACCESS RESTRICTION NOTICE -->
<div class="alert mb-4 d-flex align-items-center gap-3 p-3"
    style="background-color: #F8FAFC; border: 1px solid #CBD5E1; border-left: 4px solid #1E3A8A; border-radius: 8px;">
    <i class="bi bi-shield-lock-fill fs-4" style="color: #1E3A8A;"></i>
    <div style="font-size: 13.5px; color: #334155; line-height: 1.5;">
        <span class="fw-bold" style="color: #0F172A;">Confidentiality & Data Privacy Act Notice (RA 10173):</span>
        Evaluation records and individual clinical outcome metrics are strictly restricted to authorized guidance personnel and verified students. Sensitive assessment results are protected against unauthorized inspection or export.
    </div>
</div>

<!-- 4 KPI SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL EVALUATIONS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        6
                    </div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-journal-check"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Across all guidance services</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #0D9488 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        INTERVENTIONS & PLANS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        2
                    </div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #F0FDFA; color: #0D9488; border: 1px solid #CCFBF1;">
                    <i class="bi bi-heart-pulse"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Clinical cases & counseling plans</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #2563EB !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ACTIVITIES & WORKSHOPS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        2
                    </div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #EFF6FF; color: #2563EB; border: 1px solid #DBEAFE;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Group sessions & career events</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D97706 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        FOLLOW-UP REQUIRED
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        2
                    </div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FFFBEB; color: #D97706; border: 1px solid #FDE68A;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Action items awaiting follow-up</div>
        </div>
    </div>
</div>

<!-- SEARCH & COMPREHENSIVE FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-3" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5 col-12">
                <div class="input-group input-group-sm">
                    <span class="input-group-text border-end-0 text-muted bg-white" style="border-color: #ced4da; font-size: 14px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none"
                        placeholder="Search by Reference, Student/Program, Evaluator, or Service..."
                        style="font-size: 14px; height: 38px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-3 col-6">
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Evaluation Types</option>
                    <option value="Guidance Activities">Guidance Activities</option>
                    <option value="Counseling Interventions">Counseling Interventions</option>
                    <option value="Career Guidance">Career Guidance</option>
                    <option value="Workshops">Workshops</option>
                    <option value="Assessments">Assessments</option>
                    <option value="Counseling Plans">Counseling Plans</option>
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Outcomes</option>
                    <option value="Satisfactory">Satisfactory / High</option>
                    <option value="Moderate">Moderate / Ongoing</option>
                    <option value="Needs Follow-up">Needs Follow-up</option>
                </select>
            </div>
            <div class="col-md-2 col-12 text-end">
                <button type="button" class="btn w-100 shadow-none d-flex align-items-center justify-content-center"
                    style="border: 1px solid #ced4da; background-color: #f8f9fa; color: #495057; font-size: 13.5px; height: 38px; font-weight: 500; border-radius: 4px;">
                    <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reset Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- STUDENT EVALUATION RECORDS MASTER TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <div class="d-flex align-items-center gap-2">
            <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
                <i class="bi bi-ui-checks-grid me-2" style="color: #D4AF37;"></i>Evaluation Master Registry
            </h6>
            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600;">
                6 Records
            </span>
        </div>
        <span class="text-muted" style="font-size: 13px;">
            <i class="bi bi-info-circle me-1"></i>Showing active student and activity evaluations
        </span>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 130px; color: #2D3748;">
                            Evaluation Ref
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 200px; color: #2D3748;">
                            Student / Program Reference
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 170px; color: #2D3748;">
                            Evaluation Type
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 170px; color: #2D3748;">
                            Evaluator
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; width: 110px; color: #2D3748;">
                            Date
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 150px; color: #2D3748;">
                            Results / Outcome
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 190px; color: #2D3748;">
                            Recommendations & Follow-up
                        </th>
                        <th class="text-center pe-3 pe-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 200px; color: #2D3748;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Row 1: Guidance Activities -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">
                            EVR-2026-001
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="fw-bold text-dark">Freshman Orientation & Guidance Activity</div>
                            <span class="text-muted small">Program Ref: PROG-ACT-2026-Q1</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 12.5px; font-weight: 600; border-radius: 4px; padding: 4px 8px;">
                                <i class="bi bi-flag me-1"></i>Guidance Activity
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-secondary">
                            Dr. Elena M. Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle; color: #4A5568;">
                            2026-03-10
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12.5px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                4.9 / 5.0 (Excellent)
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="text-dark small fw-medium">Continue annual format</div>
                            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; font-size: 11px;">No follow-up needed</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-eval-001"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-compare-eval-001"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-bar-chart me-1.5"></i>Compare
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Counseling Interventions -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">
                            EVR-2026-002
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="fw-bold text-dark">RAMOS, CARLOS M.</div>
                            <span class="text-muted small">Student ID: 2026-01201 &bull; BSIS 3A</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #FDF2F4; color: #800020; border: 1px solid #FBCFE8; font-size: 12.5px; font-weight: 600; border-radius: 4px; padding: 4px 8px;">
                                <i class="bi bi-shield-heart me-1"></i>Counseling Intervention
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-secondary">
                            Dr. Elena M. Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle; color: #4A5568;">
                            2026-03-18
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12.5px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                Significant Progress
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="text-dark small fw-medium">Weekly stress diary check</div>
                            <span class="badge" style="background-color: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; font-size: 11px;">Follow-up due Apr 02</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-eval-002"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-compare-eval-002"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-bar-chart me-1.5"></i>Compare
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Career Guidance -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">
                            EVR-2026-003
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="fw-bold text-dark">SANTOS, MARIA C.</div>
                            <span class="text-muted small">Student ID: 2026-01202 &bull; BaPOS 2B</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #F0FDF4; color: #166534; border: 1px solid #BBF7D0; font-size: 12.5px; font-weight: 600; border-radius: 4px; padding: 4px 8px;">
                                <i class="bi bi-compass me-1"></i>Career Guidance
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-secondary">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle; color: #4A5568;">
                            2026-03-20
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12.5px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                4.8 / 5.0 (Very Good)
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="text-dark small fw-medium">Internship pathway aligned</div>
                            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; font-size: 11px;">Completed</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-eval-003"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-compare-eval-003"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-bar-chart me-1.5"></i>Compare
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Workshops -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">
                            EVR-2026-004
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="fw-bold text-dark">Stress Coping & Academic Wellness Workshop</div>
                            <span class="text-muted small">Program Ref: WRK-WELL-2026-01</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #FAF5FF; color: #6B21A8; border: 1px solid #E9D5FF; font-size: 12.5px; font-weight: 600; border-radius: 4px; padding: 4px 8px;">
                                <i class="bi bi-mortarboard me-1"></i>Workshop
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-secondary">
                            Dr. Elena M. Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle; color: #4A5568;">
                            2026-03-22
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12.5px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                4.7 / 5.0 (High)
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="text-dark small fw-medium">Offer mid-term booster</div>
                            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; font-size: 11px;">Scheduled Q2</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-eval-004"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-compare-eval-004"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-bar-chart me-1.5"></i>Compare
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 5: Assessments -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">
                            EVR-2026-005
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="fw-bold text-dark">DELA CRUZ, JUAN L.</div>
                            <span class="text-muted small">Student ID: 2026-01203 &bull; BSCE 1C</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; font-size: 12.5px; font-weight: 600; border-radius: 4px; padding: 4px 8px;">
                                <i class="bi bi-clipboard-pulse me-1"></i>Assessment
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-secondary">
                            Dr. Elena M. Santos, RGC
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle; color: #4A5568;">
                            2026-03-23
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; font-size: 12.5px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                Moderate Anxiety (Score: 16)
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="text-dark small fw-medium">Individual follow-up session</div>
                            <span class="badge" style="background-color: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; font-size: 11px;">Follow-up due Apr 05</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-eval-005"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-compare-eval-005"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-bar-chart me-1.5"></i>Compare
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 6: Counseling Plans -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">
                            EVR-2026-006
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="fw-bold text-dark">ALVAREZ, BEA P.</div>
                            <span class="text-muted small">Student ID: 2026-01204 &bull; BEED 2A</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #F0FDFA; color: #0F766E; border: 1px solid #99F6E4; font-size: 12.5px; font-weight: 600; border-radius: 4px; padding: 4px 8px;">
                                <i class="bi bi-card-checklist me-1"></i>Counseling Plan
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-secondary">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle; color: #4A5568;">
                            2026-03-24
                        </td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12.5px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                Plan Goals Attained (85%)
                            </span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <div class="text-dark small fw-medium">Monthly progress check</div>
                            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; font-size: 11px;">Active Plan</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-eval-006"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-compare-eval-006"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-bar-chart me-1.5"></i>Compare
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: VIEW EVALUATION DETAILS (EVR-2026-002: COUNSELING)         -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-eval-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-medical text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Evaluation Record: EVR-2026-002
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <span class="badge" style="background-color: #FDF2F4; color: #800020; border: 1px solid #FBCFE8; font-size: 12px;">
                                Counseling Intervention
                            </span>
                            <h5 class="fw-bold text-dark mt-2 mb-0">RAMOS, CARLOS M. (2026-01201)</h5>
                            <span class="text-muted small">Program: BS Information Systems &bull; Year: 3rd Year</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small d-block">Evaluation Date:</span>
                            <span class="fw-bold text-dark">March 18, 2026</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 border bg-white" style="border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom fw-bold text-dark" style="font-size: 14.5px; background-color: #ffffff;">
                        <i class="bi bi-info-circle me-1.5 text-primary"></i>Particulars & Evaluator
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 14px;">
                            <div class="col-md-6 col-12">
                                <span class="text-muted small d-block">Evaluator:</span>
                                <span class="fw-bold text-dark">Dr. Elena M. Santos, RGC</span>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="text-muted small d-block">Associated Service:</span>
                                <span class="fw-semibold text-dark">Case CAS-2026-001 (Academic Stress Counseling)</span>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="text-muted small d-block">Outcome / Result:</span>
                                <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12.5px;">
                                    Significant Progress &bull; Stress Reduction Demonstrated
                                </span>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="text-muted small d-block">Student Client Feedback:</span>
                                <span class="fw-semibold text-dark">Rating 4.9/5.0 &bull; "Counselor helped me organize my study routine without panic."</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 border bg-white" style="border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom fw-bold text-dark" style="font-size: 14.5px; background-color: #ffffff;">
                        <i class="bi bi-lightbulb me-1.5 text-warning"></i>Recommendations & Follow-up Requirements
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 14px;">
                            <div class="col-12">
                                <span class="text-muted small d-block fw-semibold">Counselor Recommendations:</span>
                                <div class="p-2.5 rounded bg-light border text-dark mt-1" style="line-height: 1.5;">
                                    Continue bi-weekly time-management check-ins. Practice guided breathing exercises before examinations.
                                </div>
                            </div>
                            <div class="col-12">
                                <span class="text-muted small d-block fw-semibold">Follow-up Requirements:</span>
                                <div class="p-2.5 rounded bg-light border text-dark mt-1" style="line-height: 1.5;">
                                    <span class="badge bg-warning text-dark me-1">Due Apr 02, 2026</span> Follow-up Session #3 scheduled at 10:00 AM (Counseling Room 2).
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-secondary mb-0 p-2.5 d-flex align-items-center gap-2" style="font-size: 12.5px;">
                    <i class="bi bi-lock-fill text-muted"></i>
                    <span>This evaluation record is strictly protected under institutional guidance policy and RA 10173.</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal"
                    style="font-size: 13.5px; height: 34px; border-radius: 4px;">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: VIEW EVALUATION DETAILS (GENERIC FOR OTHER ROWS)            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-eval-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Evaluation Record: EVR-2026-001</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">Freshman Orientation & Guidance Activity Evaluation</h6>
                <p class="text-muted small">Program Reference: PROG-ACT-2026-Q1 &bull; Evaluated on 2026-03-10 by Dr. Elena Santos</p>
                <div class="p-3 bg-white border rounded mb-3">
                    <strong>Results:</strong> 4.9 / 5.0 Average Satisfaction across 320 freshman respondents.<br>
                    <strong>Feedback:</strong> Students requested longer Q&A time during campus life transition session.<br>
                    <strong>Recommendations:</strong> Allocate 30 additional minutes for peer-counselor sharing.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-eval-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Evaluation Record: EVR-2026-003</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">SANTOS, MARIA C. (2026-01202) &bull; Career Guidance</h6>
                <div class="p-3 bg-white border rounded">
                    <strong>Evaluator:</strong> Prof. Mark Bautista, RPm &bull; Date: 2026-03-20<br>
                    <strong>Result:</strong> 4.8 / 5.0 Rating. Career pathway successfully clarified.<br>
                    <strong>Follow-up:</strong> No further mandatory action. Optional resume critique before practicum.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-eval-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Evaluation Record: EVR-2026-004</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">Stress Coping & Academic Wellness Workshop</h6>
                <div class="p-3 bg-white border rounded">
                    <strong>Evaluator:</strong> Dr. Elena M. Santos, RGC &bull; Date: 2026-03-22<br>
                    <strong>Result:</strong> 4.7 / 5.0 Rating. Participants showed strong comprehension of coping methods.<br>
                    <strong>Follow-up:</strong> Schedule mid-term booster in Q2.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-eval-005" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Evaluation Record: EVR-2026-005</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">DELA CRUZ, JUAN L. (2026-01203) &bull; Assessment Evaluation</h6>
                <div class="p-3 bg-white border rounded">
                    <strong>Evaluator:</strong> Dr. Elena M. Santos, RGC &bull; Date: 2026-03-23<br>
                    <strong>Result:</strong> Standardized Assessment Score: 16 (Moderate Anxiety).<br>
                    <strong>Follow-up Requirements:</strong> Individual counseling follow-up due Apr 05, 2026.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-eval-006" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Evaluation Record: EVR-2026-006</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">ALVAREZ, BEA P. (2026-01204) &bull; Counseling Plan Evaluation</h6>
                <div class="p-3 bg-white border rounded">
                    <strong>Evaluator:</strong> Prof. Mark Bautista, RPm &bull; Date: 2026-03-24<br>
                    <strong>Result:</strong> 85% Counseling plan goals attained. Improvement in peer socialization.<br>
                    <strong>Follow-up:</strong> Active plan maintained for monthly check-in.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: HISTORICAL COMPARISON MODAL                                -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-compare-eval-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-bar-chart-line-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Historical Program Comparison & Trend
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark mb-3">Freshman Orientation Evaluation Comparison (AY 2024 to 2026)</h6>
                <div class="table-responsive bg-white rounded border">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px; background-color: #ffffff;">
                        <thead class="table-light">
                            <tr>
                                <th>Academic Year</th>
                                <th>Participant Count</th>
                                <th>Average Rating</th>
                                <th>Action Taken</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>AY 2024-2025</td>
                                <td>290 students</td>
                                <td>4.5 / 5.0</td>
                                <td>Added breakout counseling booths</td>
                            </tr>
                            <tr>
                                <td>AY 2025-2026</td>
                                <td>320 students</td>
                                <td>4.9 / 5.0</td>
                                <td>Standardized session materials</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-compare-eval-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-bar-chart-line-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Client Longitudinal Progress Comparison
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark mb-1">RAMOS, CARLOS M. (2026-01201)</h6>
                <p class="text-muted small mb-3">Comparison across sequential counseling sessions and interventions.</p>
                <div class="table-responsive bg-white rounded border">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px; background-color: #ffffff;">
                        <thead class="table-light">
                            <tr>
                                <th>Session Stage / Checkpoint</th>
                                <th>Date</th>
                                <th>Stress Indicator</th>
                                <th>Outcome Assessment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Intake & Session 1</td>
                                <td>2026-03-01</td>
                                <td>High (8/10)</td>
                                <td>Initial academic panic identified</td>
                            </tr>
                            <tr>
                                <td>Intervention Session 2</td>
                                <td>2026-03-18</td>
                                <td>Moderate (4/10)</td>
                                <td>Coping routine established</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: AUTHORIZED REPORT GENERATION                               -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-generate-eval-report" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-pdf-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Generate Evaluation Report</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Report Scope <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px; border-color: #ced4da;">
                                <option value="all">Comprehensive Evaluation Summary</option>
                                <option value="counseling">Counseling Interventions & Plans Only</option>
                                <option value="activities">Guidance Activities & Workshops Only</option>
                                <option value="assessments">Standardized Assessments (Authorized Personnel Only)</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Start Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-03-01" style="font-size: 14px; border-color: #ced4da;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">End Date</label>
                            <input type="date" class="form-control shadow-none" value="2026-03-31" style="font-size: 14px; border-color: #ced4da;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Export Format</label>
                            <select class="form-select shadow-none" style="font-size: 14px; border-color: #ced4da;">
                                <option value="pdf">Official PDF Document (Institutional Template)</option>
                                <option value="excel">CSV / Excel Spreadsheet Format</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="p-2.5 rounded bg-white border text-muted small" style="line-height: 1.4;">
                                <i class="bi bi-shield-check text-success me-1"></i>
                                Notice: General reports automatically redact individual psychological testing metrics in compliance with student privacy safeguards.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 13.5px; height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; height: 34px;">
                        <i class="bi bi-download me-1.5"></i>Generate Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: RECORD NEW EVALUATION ENTRY                                -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-add-evaluation-record" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Record New Evaluation</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Evaluation Reference</label>
                            <input type="text" class="form-control shadow-none bg-light" value="EVR-2026-007" readonly
                                style="font-size: 14px; font-weight: 600; color: #800020; border-color: #ced4da;">
                        </div>
                        <div class="col-md-8 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Student or Program Reference <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. RAMOS, CARLOS M. (2026-01201) or Freshman Seminar" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Evaluation Type <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px; border-color: #ced4da;">
                                <option value="" selected disabled>Select evaluation type...</option>
                                <option value="Guidance Activities">Guidance Activities</option>
                                <option value="Counseling Interventions">Counseling Interventions</option>
                                <option value="Career Guidance">Career Guidance</option>
                                <option value="Workshops">Workshops</option>
                                <option value="Assessments">Assessments</option>
                                <option value="Counseling Plans">Counseling Plans</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Evaluator <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. Dr. Elena Santos, RGC" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Evaluation Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" value="2026-03-24" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Results or Outcome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. 4.9/5.0 Rating or Goals Attained" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>

                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Feedback</label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Record student comments or participant responses..."
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Recommendations</label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Recommended next steps or program adjustments..."
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Follow-up Requirements</label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Actionable tasks, responsible staff, and due dates..."
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 13.5px; height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; height: 34px;">
                        <i class="bi bi-save me-1.5"></i>Save Evaluation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>