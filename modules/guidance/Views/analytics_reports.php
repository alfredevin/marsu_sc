<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: PROGRAM & REFERRAL REPORTS           -->
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
            <li class="breadcrumb-item">
                <span style="color: #800020; text-decoration: none; font-weight: 500;">Reports</span>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Guidance Program Reports
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Guidance Program Accomplishment & Referral Reports
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Annual and semesterly documentation of guidance schedules, student participation, evaluation outcomes, future programming recommendations, and referral workflows.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-generate-authorized-report"
                style="border: 1px solid #ced4da; background-color: #fff; color: #2D3748; font-size: 13.5px; height: 34px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                <i class="bi bi-file-earmark-pdf me-1.5 text-danger"></i>Export PDF
            </button>
            <button type="button" class="btn text-white shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-add-program-report"
                style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; height: 34px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                <i class="bi bi-plus-lg me-1.5"></i>New Activity
            </button>
        </div>
    </div>
</div>

<!-- STATUTORY PRIVACY & EXCLUSION NOTICE -->
<div class="alert mb-4 d-flex align-items-center gap-3 p-3"
    style="background-color: #F8FAFC; border: 1px solid #CBD5E1; border-left: 4px solid #1E3A8A; border-radius: 8px;">
    <i class="bi bi-shield-lock-fill fs-4" style="color: #1E3A8A;"></i>
    <div style="font-size: 13.5px; color: #334155; line-height: 1.5;">
        <span class="fw-bold" style="color: #0F172A;">Confidentiality & Reporting Standards:</span>
        General-purpose reports exclude private counseling notes and unnecessary student identifiers in accordance with RA 10173 and institutional guidelines. Authorized credentials are required before exporting datasets.
    </div>
</div>

<!-- 4 EXECUTIVE KPI SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PROGRAMS & WORKSHOPS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">18</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-award-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Academic Year 2026-2027</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #2563EB !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        STUDENT PARTICIPATION
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">3,420</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #EFF6FF; color: #2563EB; border: 1px solid #DBEAFE;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Total attendees across cohorts</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #16A34A !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        EVALUATION SATISFACTION
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">96.8%</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #F0FDF4; color: #16A34A; border: 1px solid #BBF7D0;">
                    <i class="bi bi-star-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">4.88 / 5.0 Average rating</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D97706 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL REFERRALS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">34</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FFFBEB; color: #D97706; border: 1px solid #FDE68A;">
                    <i class="bi bi-box-arrow-up-right"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">22 internal &bull; 12 external</div>
        </div>
    </div>
</div>

<!-- SCHOOL-YEAR & DATE-RANGE FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-3" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-3 col-6">
                <label class="form-label text-muted small fw-semibold mb-1">School Year</label>
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="AY 2026-2027" selected>AY 2026-2027</option>
                    <option value="AY 2025-2026">AY 2025-2026</option>
                    <option value="AY 2024-2025">AY 2024-2025</option>
                </select>
            </div>
            <div class="col-md-3 col-6">
                <label class="form-label text-muted small fw-semibold mb-1">Term / Semester</label>
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="1st Semester" selected>1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                    <option value="Full Year">Full Academic Year</option>
                </select>
            </div>
            <div class="col-md-4 col-12">
                <label class="form-label text-muted small fw-semibold mb-1">Search Activity or Topic</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text border-end-0 text-muted bg-white" style="border-color: #ced4da; font-size: 14px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none"
                        placeholder="Search by Title, Pillar, Venue, or Counselor..."
                        style="font-size: 14px; height: 38px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-2 col-12 text-end pt-md-4">
                <button type="button" class="btn w-100 shadow-none d-flex align-items-center justify-content-center"
                    style="border: 1px solid #ced4da; background-color: #f8f9fa; color: #495057; font-size: 13.5px; height: 38px; font-weight: 500; border-radius: 4px;">
                    <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reset Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 1: GUIDANCE PROGRAMS & WORKSHOPS SCHEDULE TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-calendar-event me-2" style="color: #D4AF37;"></i>Guidance Program Schedules & Completed Activities
        </h6>
        <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600;">
            4 Monitored Activities
        </span>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 130px; color: #2D3748;">
                            Program Code
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 220px; color: #2D3748;">
                            Activity Title & Type
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 130px; color: #2D3748;">
                            Date / Schedule
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 130px; color: #2D3748;">
                            Participation
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 140px; color: #2D3748;">
                            Evaluation Rating
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 220px; color: #2D3748;">
                            Outcomes & Future Recommendations
                        </th>
                        <th class="text-center pe-3 pe-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 120px; color: #2D3748;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Row 1 -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">PRG-2026-001</td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">Freshmen Psychological & Adjustment Orientation</div>
                            <span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 11.5px;">Orientation Seminar</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">2026-08-28</td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark">1,150 Students</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">
                                <i class="bi bi-star-fill text-warning me-1"></i>4.92 / 5.0
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Successfully completed routine intake questionnaires</div>
                            <span class="text-muted" style="font-size: 11.5px;">Rec: Expand breakout peer discussions for AY 2027</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-program-001"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1.5"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">PRG-2026-002</td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">National Mental Health Month: Campus Wellness Summit</div>
                            <span class="badge" style="background-color: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; font-size: 11.5px;">Mental Health Workshop</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">2026-10-10</td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark">840 Students</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">
                                <i class="bi bi-star-fill text-warning me-1"></i>4.88 / 5.0
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Grounding and stress inoculation techniques adopted</div>
                            <span class="text-muted" style="font-size: 11.5px;">Rec: Offer college-specific wellness follow-ups</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-program-002"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1.5"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">PRG-2026-003</td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">Standardized Psychological Testing & Career Profiling</div>
                            <span class="badge" style="background-color: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; font-size: 11.5px;">Assessment & Career</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">2026-09-22</td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark">910 Students</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">
                                <i class="bi bi-star-fill text-warning me-1"></i>4.75 / 5.0
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">RIASEC & personality profiling completed for 2nd years</div>
                            <span class="text-muted" style="font-size: 11.5px;">Rec: Integrate electronic assessment portal submission</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-program-003"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1.5"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">PRG-2026-004</td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">Peer Facilitators Leadership Training & Mental Health First Aid</div>
                            <span class="badge" style="background-color: #F0FDFA; color: #0F766E; border: 1px solid #99F6E4; font-size: 11.5px;">Peer Support Workshop</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">2026-10-19</td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="fw-bold text-dark">65 Student Leaders</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">
                                <i class="bi bi-star-fill text-warning me-1"></i>4.95 / 5.0
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Trained student leaders as designated crisis first-responders</div>
                            <span class="text-muted" style="font-size: 11.5px;">Rec: Schedule semesterly refresher simulation</span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-program-004"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1.5"></i>View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   SECTION 6.4: DEDICATED REFERRAL REPORTS SECTION                    -->
<!-- ==================================================================== -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white py-3 px-3 px-md-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h6 class="m-0 fw-bold" style="font-size: 16px; color: #800020;">
                <i class="bi bi-arrow-left-right me-2" style="color: #D4AF37;"></i>Section 6.4: Institutional Referral Reports
            </h6>
            <div class="text-muted small mt-0.5">
                Detailed reporting section for internal academic endorsements and external medical/psychiatric referrals.
            </div>
        </div>
        <span class="badge text-dark bg-light border px-2.5 py-1" style="font-size: 12px;">
            Audited Referral Ledger
        </span>
    </div>

    <!-- REFERRAL PROCESS DISTINCTION NOTICE -->
    <div class="px-4 pt-3">
        <div class="p-2.5 rounded bg-light border text-muted small" style="line-height: 1.4;">
            <i class="bi bi-info-circle text-primary me-1"></i>
            <strong>Referral Lifecycle Distinction:</strong> This report strictly distinguishes between a <em>Referral Prepared</em>, a <em>Referral Formally Issued</em>, and a <em>Referral Acknowledged</em> by the receiving entity. Referral completion signifies verified administrative handover and does not imply that the student has achieved a final medical or counseling outcome.
        </div>
    </div>

    <div class="card-body p-4">
        <!-- 4 Referral Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6">
                <div class="p-3 rounded border bg-white">
                    <span class="text-muted small d-block">Internal Referrals</span>
                    <div class="h4 fw-bold text-dark mt-1 mb-0">22 Cases</div>
                    <span class="small text-muted">Faculties & Academic Units</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded border bg-white">
                    <span class="text-muted small d-block">External Referrals</span>
                    <div class="h4 fw-bold text-dark mt-1 mb-0">12 Cases</div>
                    <span class="small text-muted">Hospitals & Social Welfare</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded border bg-white">
                    <span class="text-muted small d-block">Acknowledged & Completed</span>
                    <div class="h4 fw-bold text-success mt-1 mb-0">26 (76.5%)</div>
                    <span class="small text-muted">Handover verified</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded border bg-white">
                    <span class="text-muted small d-block">Avg. Processing Time</span>
                    <div class="h4 fw-bold text-primary mt-1 mb-0">2.4 Days</div>
                    <span class="small text-muted">Preparation to issuance</span>
                </div>
            </div>
        </div>

        <!-- Referral Destination & Workflow Breakdown Table -->
        <div class="table-responsive border rounded">
            <table class="table table-hover align-middle mb-0" style="font-size: 13.5px; background-color: #ffffff;">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Destination / Entity</th>
                        <th class="text-center">Primary Concern</th>
                        <th class="text-center">Urgency</th>
                        <th class="text-center">Prepared</th>
                        <th class="text-center">Issued</th>
                        <th class="text-center">Acknowledged</th>
                        <th class="text-center">Requiring Follow-up</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-semibold text-dark">College Deans & Program Chairs</td>
                        <td class="text-center">Academic Probation & Shifting</td>
                        <td class="text-center"><span class="badge bg-light text-dark border">Routine</span></td>
                        <td class="text-center">14</td>
                        <td class="text-center">14</td>
                        <td class="text-center text-success fw-bold">14</td>
                        <td class="text-center"><span class="badge bg-light text-muted border">0</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-semibold text-dark">University Health Clinic</td>
                        <td class="text-center">Physical Somatization & Exhaustion</td>
                        <td class="text-center"><span class="badge bg-warning-subtle text-dark border">Urgent</span></td>
                        <td class="text-center">8</td>
                        <td class="text-center">8</td>
                        <td class="text-center text-success fw-bold">7</td>
                        <td class="text-center"><span class="badge bg-warning-subtle text-dark border">1 Active</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-semibold text-dark">Provincial Health Office / Hospital</td>
                        <td class="text-center">Clinical Psychological Evaluation</td>
                        <td class="text-center"><span class="badge bg-danger-subtle text-danger border">Emergency</span></td>
                        <td class="text-center">7</td>
                        <td class="text-center">7</td>
                        <td class="text-center text-success fw-bold">5</td>
                        <td class="text-center"><span class="badge bg-danger-subtle text-danger border">2 Pending</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-semibold text-dark">Student Welfare & Financial Assistance</td>
                        <td class="text-center">Allowance Shortage & Dorm Aid</td>
                        <td class="text-center"><span class="badge bg-light text-dark border">Routine</span></td>
                        <td class="text-center">5</td>
                        <td class="text-center">5</td>
                        <td class="text-center text-success fw-bold">5</td>
                        <td class="text-center"><span class="badge bg-light text-muted border">0</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: VIEW PROGRAM DETAILS                                       -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-program-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">PRG-2026-001: Freshmen Orientation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <p class="text-dark">Freshmen Psychological & Adjustment Orientation completed with 1,150 attendees.</p>
                <div class="p-3 bg-white border rounded">
                    <strong>Lead Counselor:</strong> Dr. Elena M. Santos, RGC<br>
                    <strong>Evaluation:</strong> 4.92 / 5.0 Rating<br>
                    <strong>Outcome:</strong> 100% of incoming freshmen introduced to the MarSU guidance booking system.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-program-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">PRG-2026-002: Campus Wellness Summit</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <p class="text-muted">840 participants logged during National Mental Health Month summit.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-program-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">PRG-2026-003: Psychological Testing</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <p class="text-muted">910 students completed psychological testing batteries.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-program-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">PRG-2026-004: Peer Facilitators Training</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <p class="text-muted">65 peer facilitators certified in Psychological First Aid.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   SECTION 6.5: REPORT GENERATION & EXPORT MODAL                      -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-generate-authorized-report" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-lock-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Authorized Report Generation</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="alert alert-secondary p-2.5 mb-3" style="font-size: 12.5px;">
                        <i class="bi bi-shield-check text-success me-1"></i>
                        Authorization Verified &bull; Report Generation Date: <strong><?= date('F d, Y') ?></strong>
                    </div>
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Report Type <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px;">
                                <option value="program-accomplishment" selected>Program Accomplishment Summary Report</option>
                                <option value="referral-report">Section 6.4 Institutional Referral Report</option>
                                <option value="comprehensive-annual">Comprehensive Annual Guidance Dossier</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Academic Year</label>
                            <input type="text" class="form-control shadow-none bg-light" value="AY 2026-2027" readonly style="font-size: 14px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Export Format</label>
                            <select class="form-select shadow-none" style="font-size: 14px;">
                                <option value="pdf" selected>Printable PDF (Official Seal)</option>
                                <option value="excel">Excel / CSV Spreadsheet</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <span class="text-muted small" style="font-size: 12px;">
                                Notice: Unnecessary student personal identifiers and clinical case notes are automatically omitted from generated reports.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                        <i class="bi bi-download me-1.5"></i>Generate Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: ADD NEW PROGRAM REPORT                                      -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-add-program-report" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">File Program Accomplishment Report</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-8 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Program Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. World Mental Health Day Seminar" required style="font-size: 14px;">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Program Code</label>
                            <input type="text" class="form-control bg-light shadow-none" value="PRG-2026-005" readonly style="font-size: 14px; font-weight: 600; color: #800020;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Activity Type <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px;">
                                <option value="Workshop">Workshop</option>
                                <option value="Seminar">Seminar / Orientation</option>
                                <option value="Career Guidance">Career Guidance Activity</option>
                                <option value="Assessment">Standardized Psychological Testing</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Implementation Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" value="2026-10-24" required style="font-size: 14px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Actual Student Attendees <span class="text-danger">*</span></label>
                            <input type="number" class="form-control shadow-none" placeholder="e.g. 250" required style="font-size: 14px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Evaluation Rating (1.0 to 5.0)</label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. 4.90" style="font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Program Outcomes & Future Recommendations <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Describe participant engagement and recommendations for future iterations..." required style="font-size: 14px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                        <i class="bi bi-save me-1.5"></i>Save Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>