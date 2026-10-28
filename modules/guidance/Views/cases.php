<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: CASE PROGRESS & MONITORING     -->
<!--   Module: Guidance & Counseling Services                             -->
<!--   File: modules/guidance/Views/case_progress.php                     -->
<!--   PURE FRONT-END DIRECT BOOTSTRAP 5.3 / NO STYLE OR SCRIPT TAGS      -->
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
                    Guidance &amp; Counseling Services
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Case Progress
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Case Progress &amp; Counseling Monitoring Log
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Centralized clinical monitoring, counseling goal indicators, session chronologies, intervention
                tracking, and case dispositions.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <button type="button"
                class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                onclick="window.print()"
                style="font-size: 14px; font-weight: 500; height: 38px; border-radius: 6px; padding: 0 16px; background-color: #fff; border: 1px solid #ced4da;">
                <i class="bi bi-printer me-2"></i>Print Case Log
            </button>
            <button type="button"
                class="btn text-white shadow-none d-inline-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-create-case"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14px; font-weight: 500; border-radius: 6px; height: 38px; padding: 0 16px;">
                <i class="bi bi-folder-plus me-2"></i>Open New Case
            </button>
        </div>
    </div>
</div>



<!-- SEARCH & MULTI-FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4"
    style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                <label class="form-label small text-muted fw-semibold mb-1">Search Cases</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white"
                        style="border-color: #ced4da; font-size: 14px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none"
                        placeholder="Search by case #, student name, ID..."
                        style="font-size: 14px; height: 38px; border-color: #ced4da;">
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                <label class="form-label small text-muted fw-semibold mb-1">Status</label>
                <select class="form-select shadow-none" style="font-size: 13.5px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Statuses</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Under Review">Under Review</option>
                    <option value="Resolved">Resolved / Closed</option>
                    <option value="Reopened">Reopened</option>
                </select>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                <label class="form-label small text-muted fw-semibold mb-1">Assigned Counselor</label>
                <select class="form-select shadow-none" style="font-size: 13.5px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Counselors</option>
                    <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC</option>
                    <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm</option>
                    <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos</option>
                </select>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                <label class="form-label small text-muted fw-semibold mb-1">Concern Category</label>
                <select class="form-select shadow-none" style="font-size: 13.5px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Categories</option>
                    <option value="Emotional / Personal Wellbeing">Emotional / Personal Wellbeing</option>
                    <option value="Academic Adjustment">Academic Adjustment &amp; Stress</option>
                    <option value="Career &amp; Pathway">Career &amp; Pathway Guidance</option>
                    <option value="Attendance &amp; Absenteeism">Attendance &amp; Absenteeism</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- CASE MONITORING DIRECTORY TABLE -->
<div class="card shadow-sm border-0 mb-4"
    style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
        style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <h6 class="m-0 fw-bold" style="font-size: 16px; color: #800020;">
            <i class="bi bi-kanban me-2" style="color: #D4AF37;"></i>Case Monitoring Registry &amp; Goal Progress
            Indicators
        </h6>
        <span class="badge text-dark bg-light border px-2.5 py-1.5" style="font-size: 13px; font-weight: 500;">
            Showing 4 Case Records &bull; Official Clinical Registry
        </span>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-4"
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; min-width: 220px; color: #2D3748; vertical-align: middle;">
                            Full Name
                        </th>
                        <th class="text-center"
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; width: 100px; color: #2D3748; vertical-align: middle;">
                            Program
                        </th>
                        <th
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; min-width: 240px; color: #2D3748; vertical-align: middle;">
                            Initial Concern
                        </th>
                        <th
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; min-width: 200px; color: #2D3748; vertical-align: middle;">
                            Assigned Counselor
                        </th>
                        <th class="text-center"
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; width: 130px; color: #2D3748; vertical-align: middle;">
                            Case Status
                        </th>
                        <th
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; min-width: 170px; color: #2D3748; vertical-align: middle;">
                            Counseling Goals Progress
                        </th>
                        <th class="text-center"
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; width: 130px; color: #2D3748; vertical-align: middle;">
                            Next Review
                        </th>
                        <th class="text-center pe-4"
                            style="font-size: 15px; font-weight: 600; padding: 15px 18px; width: 200px; min-width: 200px; color: #2D3748; vertical-align: middle;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Row 1: SANTOS, MARIA C. -->
                    <tr>
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">SANTOS, MARIA C.</div>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BaPOS</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14.5px;">Emotional / Stress Management</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; font-size: 14.5px;">
                            <span class="text-dark fw-medium">Dr. Elena Santos, RGC</span>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">In
                                Progress</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-semibold text-dark mb-1" style="font-size: 13.5px;">2 of 3 Met</div>
                            <div class="progress" style="height: 6px; border-radius: 4px; background-color: #edf2f7;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: 67%; background-color: #d4a017;" aria-valuenow="67" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td class="text-center text-dark fw-semibold"
                            style="padding: 16px 18px; vertical-align: middle; font-size: 14px;">
                            2026-10-28
                        </td>
                        <td class="text-center pe-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-case-001"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Case Progress & Chronology">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-update-case-001"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Update Status, Notes & Goals">
                                    <i class="bi bi-pencil-square me-1"></i>Update
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: RAMOS, CARLOS M. -->
                    <tr>
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">RAMOS, CARLOS M.</div>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BSIS</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14.5px;">Career Exploration Advisory</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; font-size: 14.5px;">
                            <span class="text-dark fw-medium">Prof. Mark Bautista, RPm</span>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">In
                                Progress</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-semibold text-dark mb-1" style="font-size: 13.5px;">1 of 2 Met</div>
                            <div class="progress" style="height: 6px; border-radius: 4px; background-color: #edf2f7;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: 50%; background-color: #3182ce;" aria-valuenow="50" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td class="text-center text-dark fw-semibold"
                            style="padding: 16px 18px; vertical-align: middle; font-size: 14px;">
                            2026-10-29
                        </td>
                        <td class="text-center pe-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-case-002"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Case Progress & Chronology">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-update-case-002"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Update Status, Notes & Goals">
                                    <i class="bi bi-pencil-square me-1"></i>Update
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: DELA CRUZ, JUAN L. -->
                    <tr>
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">DELA CRUZ, JUAN L.</div>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BSIS</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14.5px;">Chronic Absenteeism &amp; Attendance</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; font-size: 14.5px;">
                            <span class="text-dark fw-medium">Dr. Elena Santos, RGC</span>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #dc3545; background-color: #fff5f5; color: #721c24; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Under
                                Review</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-semibold text-dark mb-1" style="font-size: 13.5px;">1 of 3 Met</div>
                            <div class="progress" style="height: 6px; border-radius: 4px; background-color: #edf2f7;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: 33%; background-color: #e53e3e;" aria-valuenow="33" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td class="text-center text-dark fw-semibold"
                            style="padding: 16px 18px; vertical-align: middle; font-size: 14px;">
                            2026-10-31
                        </td>
                        <td class="text-center pe-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-case-003"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-update-case-003"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil-square me-1"></i>Update
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: ALVAREZ, BEA P. -->
                    <tr>
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">ALVAREZ, BEA P.</div>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BEED</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14.5px;">Academic Probation Transition</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; font-size: 14.5px;">
                            <span class="text-dark fw-medium">Ms. Clarisse Ramos</span>
                        </td>
                        <td class="text-center" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 105px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Resolved</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-semibold text-dark mb-1" style="font-size: 13.5px;">3 of 3 Met</div>
                            <div class="progress" style="height: 6px; border-radius: 4px; background-color: #edf2f7;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: 100%; background-color: #28a745;" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td class="text-center text-muted"
                            style="padding: 16px 18px; vertical-align: middle; font-size: 14px;">
                            Closed
                        </td>
                        <td class="text-center pe-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-case-004"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-reopen-case-004"
                                    style="border: 1px solid #4a5568; color: #2d3748; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Reopen Case with Documented Rationale">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reopen
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- CLINICAL CASE MODALS (STATIC HTML) -->
    <!-- ==================================================================== -->
    <!--   MODAL: VIEW CASE DETAILS & CLINICAL CHRONOLOGY (CAS-2026-001)       -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-view-case-001" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-folder-symlink-fill text-warning fs-5"></i>
                        <div>
                            <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                                Case Progress File &bull; CAS-2026-001
                            </h5>
                            <span class="text-white-50" style="font-size: 13px;">Comprehensive Clinical Progress, Goals &amp; Audit Log</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">

                    <!-- Header Summary Card -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <span class="badge mb-1" style="font-size: 12px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC;">
                                        CAS-2026-001
                                    </span>
                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">SANTOS, MARIA C.</h4>
                                    <div class="text-muted" style="font-size: 13.5px;">
                                        <span class="me-3"><strong>Student ID:</strong> 2023-01042</span>
                                        <span class="me-3"><strong>College:</strong> College of Arts and Sciences</span>
                                        <span><strong>Program:</strong> BaPOS (2nd Year)</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge mb-1" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 110px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                        In Progress
                                    </span>
                                    <div class="text-muted small">Counselor: <strong>Dr. Elena Santos, RGC</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1: Initial Concern & Case Summary -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-medical-fill" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Initial Concern &amp; Clinical Case Summary</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="mb-2">
                                <span class="text-muted d-block small">Primary Intake Category</span>
                                <strong class="text-dark" style="font-size: 14px;">Academic Burnout &amp; Capstone Anxiety</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block small">Case Summary</span>
                                <p class="text-dark mb-0" style="line-height: 1.6;">Student reported intense somatic stress, sleep disturbances, and performance anxiety linked to academic deadlines. A personalized counseling intervention was initiated to manage cognitive distortions and re-establish structured sleep schedules.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Counseling Goals -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-bullseye" style="color: #800020;"></i>
                                <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Counseling Goals &amp; Counselor-Assessed Indicators</span>
                            </div>
                            <span class="text-muted small">Based on Documented Clinical Observations</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2">
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Anxiety Regulation &amp; Cognitive Reframing</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Student demonstrated mastery of 4-7-8 breathing and thought replacement in Session 2.</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Sleep Hygiene Protocol Adherence</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Sleep log shows regular 7-hour resting window without screen exposure.</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Academic Workload Delegation &amp; Time Blocking</strong>
                                            <span class="badge bg-warning text-dark" style="font-size: 11px;">In Progress</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Under active trial in current thesis group sprint; weekly check-in required.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Session History & Related Referrals -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar2-check" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Session History</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">SES-2026-001 &bull; Initial Intake &amp; Assessment</strong>
                                            <span class="badge bg-light text-muted border">2026-10-14</span>
                                        </div>
                                        <div class="text-muted small">Intake questionnaire completed. Somatic anxiety documented; baseline vitals normal.</div>
                                    </div>
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">SES-2026-005 &bull; CBT Strategy Session</strong>
                                            <span class="badge bg-light text-muted border">2026-10-21</span>
                                        </div>
                                        <div class="text-muted small">Introduced progressive muscle relaxation and thought journal techniques.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-arrow-left-right" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Related Referrals &amp; Cross-Links</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">REF-INT-2026-042</strong>
                                            <span class="badge bg-light text-secondary border">Urgent</span>
                                        </div>
                                        <div class="text-muted small"><strong>Source:</strong> Faculty Referral (Prof. Jonathan Mendoza)</div>
                                        <div class="text-muted small"><strong>Outcome:</strong> Intake Accepted; Joint Monitoring Ongoing</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Completed & Pending Actions -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-check2-circle text-success"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Completed Clinical Actions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Conducted clinical intake interview on Oct 14, 2026.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Administered Beck Anxiety Inventory (BAI) — Score indicated moderate situational distress.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Coordinated with academic advisor for flexible midterm task submission schedule.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Pending Actions &amp; Interventions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-dash-circle text-warning mt-0.5"></i>
                                            <span>Follow-up evaluation on capstone team division of labor.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-dash-circle text-warning mt-0.5"></i>
                                            <span>Post-intervention anxiety inventory administration on Oct 28, 2026.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Progress Notes & Follow-up Schedule -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Professional Progress Notes &amp; Follow-up Schedule</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="row g-3">
                                <div class="col-md-8 col-12">
                                    <span class="text-muted d-block small">Counselor Progress Notes</span>
                                    <p class="text-dark mb-0" style="line-height: 1.5;">Patient expresses noticeable relief after adopting breathing exercises before examination sessions. Cooperative and punctual across all scheduled meetings.</p>
                                </div>
                                <div class="col-md-4 col-12 border-start">
                                    <span class="text-muted d-block small">Follow-up Schedule</span>
                                    <strong class="text-dark">2026-10-28 at 02:00 PM (In-Person Consultation Room 2)</strong>
                                    <span class="text-muted d-block small mt-2">Closure / Disposition Reason</span>
                                    <span class="text-dark">N/A — Active case under continuing care.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Chronological Timeline -->
                    <div class="card border shadow-sm mb-0" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Case Action History &amp; Chronology</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="position-relative ps-3" style="border-left: 2px solid #E2E8F0;">
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Faculty Referral Received</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-12</span>
                                    </div>
                                    <div class="text-muted small">Endorsed by CAS department chair for academic fatigue.</div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Case Formally Opened</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-14</span>
                                    </div>
                                    <div class="text-muted small">Intake completed by Dr. Elena Santos, RGC.</div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Progress Review Conducted</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-21</span>
                                    </div>
                                    <div class="text-muted small">2 of 3 clinical goals marked as satisfied based on documented sleep logs.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                        Close
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" onclick="window.print()" style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                            <i class="bi bi-printer me-1.5"></i>Print Case Slip
                        </button>
                        <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-update-case-001" style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                            <i class="bi bi-pencil-square me-1.5"></i>Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!--   MODAL: UPDATE CASE STATUS, NOTES, GOALS (CAS-2026-001)             -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-update-case-001" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square text-warning fs-5"></i>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Update Clinical Case &bull; CAS-2026-001</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body p-4" style="background-color: #f8f9fa;">
                        <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <strong class="text-dark d-block" style="font-size: 14.5px;">SANTOS, MARIA C. (BaPOS)</strong>
                                    <span class="text-muted small">Assigned Counselor: Dr. Elena Santos, RGC</span>
                                </div>
                                <span class="badge" style="border: 1px solid #d4a017; color: #856404; background-color: #fdfbe8; border-radius: 50rem; padding: 6px 12px; font-size: 12px;">
                                    In Progress
                                </span>
                            </div>
                        </div>

                        <div class="row g-3" style="font-size: 14px;">
                            <div class="col-md-6 col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">Update Case Status</label>
                                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                    <option value="In Progress" selected>In Progress</option>
                                    <option value="Under Review">Under Review</option>
                                    <option value="Resolved">Resolved / Closed</option>
                                    <option value="Reopened">Reopened</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">Schedule Review / Follow-up Date</label>
                                <input type="date" class="form-control shadow-none" value="2026-10-28" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-journal-text me-1 text-primary"></i>Counselor Progress Notes &amp; Professional Observations
                                </label>
                                <textarea class="form-control shadow-none" rows="3" placeholder="Record documented observations, student disclosures, and clinical assessments..." style="font-size: 14px; border-color: #ced4da;">Patient expresses noticeable relief after adopting breathing exercises before examination sessions. Cooperative and punctual across all scheduled meetings.</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-check2-circle me-1 text-success"></i>Document Completed Interventions &amp; Goal Updates
                                </label>
                                <input type="text" class="form-control shadow-none" placeholder="e.g. Completed sleep hygiene review, verified study schedules..." value="Verified student adherence to counseling goals and schedule agreements." style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-arrow-left-right me-1 text-info"></i>Referral Outcomes &amp; Linkages (If Applicable)
                                </label>
                                <input type="text" class="form-control shadow-none" placeholder="Record status of linked internal or external referrals..." value="Academic coaching referral active and verified with department chair." style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                            Cancel
                        </button>
                        <button type="submit" class="btn text-white shadow-none" data-bs-dismiss="modal" style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; min-width: 110px; border-radius: 4px;">
                            <i class="bi bi-check-lg me-1"></i>Save Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!--   MODAL: VIEW CASE DETAILS & CLINICAL CHRONOLOGY (CAS-2026-002)       -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-view-case-002" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-folder-symlink-fill text-warning fs-5"></i>
                        <div>
                            <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                                Case Progress File &bull; CAS-2026-002
                            </h5>
                            <span class="text-white-50" style="font-size: 13px;">Comprehensive Clinical Progress, Goals &amp; Audit Log</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">

                    <!-- Header Summary Card -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <span class="badge mb-1" style="font-size: 12px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC;">
                                        CAS-2026-002
                                    </span>
                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">RAMOS, CARLOS M.</h4>
                                    <div class="text-muted" style="font-size: 13.5px;">
                                        <span class="me-3"><strong>Student ID:</strong> 2022-00812</span>
                                        <span class="me-3"><strong>College:</strong> College of Information and Computing Sciences</span>
                                        <span><strong>Program:</strong> BSIS (3rd Year)</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge mb-1" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 110px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                        In Progress
                                    </span>
                                    <div class="text-muted small">Counselor: <strong>Prof. Mark Bautista, RPm</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1: Initial Concern & Case Summary -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-medical-fill" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Initial Concern &amp; Clinical Case Summary</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="mb-2">
                                <span class="text-muted d-block small">Primary Intake Category</span>
                                <strong class="text-dark" style="font-size: 14px;">Course Alignment &amp; Practicum Path</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block small">Case Summary</span>
                                <p class="text-dark mb-0" style="line-height: 1.6;">Student requested career guidance regarding transition to industry internship tracks and doubts concerning programming vs. business analytics specializations.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Counseling Goals -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-bullseye" style="color: #800020;"></i>
                                <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Counseling Goals &amp; Counselor-Assessed Indicators</span>
                            </div>
                            <span class="text-muted small">Based on Documented Clinical Observations</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">RIASEC Vocational Interest Profiling</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Strong Investigative &amp; Conventional traits identified on Oct 18.</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Industry Partner Matching</strong>
                                            <span class="badge bg-warning text-dark" style="font-size: 11px;">In Progress</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Reviewing corporate software internship requirements with OJT coordinator.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Session History & Related Referrals -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar2-check" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Session History</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">SES-2026-003 &bull; Career Assessment Debrief</strong>
                                            <span class="badge bg-light text-muted border">2026-10-18</span>
                                        </div>
                                        <div class="text-muted small">Interpreted assessment results; clarified analytics vs. software tracks.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-arrow-left-right" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Related Referrals &amp; Cross-Links</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">REF-SLF-2026-003</strong>
                                            <span class="badge bg-light text-secondary border">Routine</span>
                                        </div>
                                        <div class="text-muted small"><strong>Source:</strong> Student Self-Referral</div>
                                        <div class="text-muted small"><strong>Outcome:</strong> Enrolled into Career Counseling Pathway</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Completed & Pending Actions -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-check2-circle text-success"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Completed Clinical Actions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Conducted RIASEC assessment and skills inventory.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Created resume draft tailored for corporate IT internships.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Pending Actions &amp; Interventions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-dash-circle text-warning mt-0.5"></i>
                                            <span>Finalize 3 target placement agencies with student.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Progress Notes & Follow-up Schedule -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Professional Progress Notes &amp; Follow-up Schedule</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="row g-3">
                                <div class="col-md-8 col-12">
                                    <span class="text-muted d-block small">Counselor Progress Notes</span>
                                    <p class="text-dark mb-0" style="line-height: 1.5;">Student demonstrates clear self-awareness and improved confidence in career decision-making.</p>
                                </div>
                                <div class="col-md-4 col-12 border-start">
                                    <span class="text-muted d-block small">Follow-up Schedule</span>
                                    <strong class="text-dark">2026-10-29 at 10:30 AM (Guidance Office Station 1)</strong>
                                    <span class="text-muted d-block small mt-2">Closure / Disposition Reason</span>
                                    <span class="text-dark">N/A — Active case under continuing care.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Chronological Timeline -->
                    <div class="card border shadow-sm mb-0" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Case Action History &amp; Chronology</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="position-relative ps-3" style="border-left: 2px solid #E2E8F0;">
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Self-Referral Submitted</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-15</span>
                                    </div>
                                    <div class="text-muted small">Filed request via online student guidance portal.</div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Intake &amp; Assessment Debrief</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-18</span>
                                    </div>
                                    <div class="text-muted small">Completed vocational interest survey and mapped goals.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                        Close
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" onclick="window.print()" style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                            <i class="bi bi-printer me-1.5"></i>Print Case Slip
                        </button>
                        <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-update-case-002" style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                            <i class="bi bi-pencil-square me-1.5"></i>Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!--   MODAL: UPDATE CASE STATUS, NOTES, GOALS (CAS-2026-002)             -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-update-case-002" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square text-warning fs-5"></i>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Update Clinical Case &bull; CAS-2026-002</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body p-4" style="background-color: #f8f9fa;">
                        <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <strong class="text-dark d-block" style="font-size: 14.5px;">RAMOS, CARLOS M. (BSIS)</strong>
                                    <span class="text-muted small">Assigned Counselor: Prof. Mark Bautista, RPm</span>
                                </div>
                                <span class="badge" style="border: 1px solid #d4a017; color: #856404; background-color: #fdfbe8; border-radius: 50rem; padding: 6px 12px; font-size: 12px;">
                                    In Progress
                                </span>
                            </div>
                        </div>

                        <div class="row g-3" style="font-size: 14px;">
                            <div class="col-md-6 col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">Update Case Status</label>
                                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                    <option value="In Progress" selected>In Progress</option>
                                    <option value="Under Review">Under Review</option>
                                    <option value="Resolved">Resolved / Closed</option>
                                    <option value="Reopened">Reopened</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">Schedule Review / Follow-up Date</label>
                                <input type="date" class="form-control shadow-none" value="2026-10-29" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-journal-text me-1 text-primary"></i>Counselor Progress Notes &amp; Professional Observations
                                </label>
                                <textarea class="form-control shadow-none" rows="3" placeholder="Record documented observations, student disclosures, and clinical assessments..." style="font-size: 14px; border-color: #ced4da;">Student demonstrates clear self-awareness and improved confidence in career decision-making.</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-check2-circle me-1 text-success"></i>Document Completed Interventions &amp; Goal Updates
                                </label>
                                <input type="text" class="form-control shadow-none" placeholder="e.g. Completed sleep hygiene review, verified study schedules..." value="Verified student adherence to counseling goals and schedule agreements." style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-arrow-left-right me-1 text-info"></i>Referral Outcomes &amp; Linkages (If Applicable)
                                </label>
                                <input type="text" class="form-control shadow-none" placeholder="Record status of linked internal or external referrals..." value="Career counseling pathway active with department chair." style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                            Cancel
                        </button>
                        <button type="submit" class="btn text-white shadow-none" data-bs-dismiss="modal" style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; min-width: 110px; border-radius: 4px;">
                            <i class="bi bi-check-lg me-1"></i>Save Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!--   MODAL: VIEW CASE DETAILS & CLINICAL CHRONOLOGY (CAS-2026-003)       -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-view-case-003" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-folder-symlink-fill text-warning fs-5"></i>
                        <div>
                            <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                                Case Progress File &bull; CAS-2026-003
                            </h5>
                            <span class="text-white-50" style="font-size: 13px;">Comprehensive Clinical Progress, Goals &amp; Audit Log</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">

                    <!-- Header Summary Card -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <span class="badge mb-1" style="font-size: 12px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC;">
                                        CAS-2026-003
                                    </span>
                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">DELA CRUZ, JUAN L.</h4>
                                    <div class="text-muted" style="font-size: 13.5px;">
                                        <span class="me-3"><strong>Student ID:</strong> 2023-01089</span>
                                        <span class="me-3"><strong>College:</strong> College of Information and Computing Sciences</span>
                                        <span><strong>Program:</strong> BSIS (2nd Year)</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge mb-1" style="border: 1.5px solid #dc3545; background-color: #fff5f5; color: #721c24; border-radius: 50rem; min-width: 110px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                        Under Review
                                    </span>
                                    <div class="text-muted small">Counselor: <strong>Dr. Elena Santos, RGC</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1: Initial Concern & Case Summary -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-medical-fill" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Initial Concern &amp; Clinical Case Summary</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="mb-2">
                                <span class="text-muted d-block small">Primary Intake Category</span>
                                <strong class="text-dark" style="font-size: 14px;">Chronic Absenteeism &amp; Habit Coaching</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block small">Case Summary</span>
                                <p class="text-dark mb-0" style="line-height: 1.6;">Student accumulated 6 consecutive unexcused absences in major IT courses. Faculty reported disengagement. Counselor established contact and drew up an academic commitment contract.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Counseling Goals -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-bullseye" style="color: #800020;"></i>
                                <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Counseling Goals &amp; Counselor-Assessed Indicators</span>
                            </div>
                            <span class="text-muted small">Based on Documented Clinical Observations</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2">
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Attendance Commitment Contract Formulation</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Signed attendance pledge witnessed by college dean on Oct 19.</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Daily Attendance Logging &amp; Faculty Sign-off</strong>
                                            <span class="badge bg-warning text-dark" style="font-size: 11px;">In Progress</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Week 1 logs submitted with 100% attendance recorded.</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Family Consultation &amp; Support Sync</strong>
                                            <span class="badge bg-secondary" style="font-size: 11px;">Pending</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Parent notification letter delivered; conference pending schedule.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Session History & Related Referrals -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar2-check" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Session History</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">SES-2026-004 &bull; Intervention &amp; Contract Signing</strong>
                                            <span class="badge bg-light text-muted border">2026-10-19</span>
                                        </div>
                                        <div class="text-muted small">Explored transportation barriers and dormitory transition challenges.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-arrow-left-right" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Related Referrals &amp; Cross-Links</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">REF-INT-2026-039</strong>
                                            <span class="badge bg-light text-secondary border">Urgent</span>
                                        </div>
                                        <div class="text-muted small"><strong>Source:</strong> Faculty Referral (Inst. Clarissa Ramos)</div>
                                        <div class="text-muted small"><strong>Outcome:</strong> Intervention Case Opened</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Completed & Pending Actions -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-check2-circle text-success"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Completed Clinical Actions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Conducted crisis intake conference with student.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Drafted and executed academic attendance agreement.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Pending Actions &amp; Interventions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-dash-circle text-warning mt-0.5"></i>
                                            <span>Host parent-counselor alignment conference.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-dash-circle text-warning mt-0.5"></i>
                                            <span>Weekly attendance verification with instructors.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Progress Notes & Follow-up Schedule -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Professional Progress Notes &amp; Follow-up Schedule</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="row g-3">
                                <div class="col-md-8 col-12">
                                    <span class="text-muted d-block small">Counselor Progress Notes</span>
                                    <p class="text-dark mb-0" style="line-height: 1.5;">Student acknowledges tardiness habits and showed earnest commitment to the structured morning schedule.</p>
                                </div>
                                <div class="col-md-4 col-12 border-start">
                                    <span class="text-muted d-block small">Follow-up Schedule</span>
                                    <strong class="text-dark">2026-10-31 at 09:00 AM (Room 2)</strong>
                                    <span class="text-muted d-block small mt-2">Closure / Disposition Reason</span>
                                    <span class="text-dark">N/A — Case under formal behavioral review.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Chronological Timeline -->
                    <div class="card border shadow-sm mb-0" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Case Action History &amp; Chronology</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="position-relative ps-3" style="border-left: 2px solid #E2E8F0;">
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Faculty Referral Logged</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-15</span>
                                    </div>
                                    <div class="text-muted small">Flagged for consecutive unexcused course absences.</div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Contract Execution</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-19</span>
                                    </div>
                                    <div class="text-muted small">Signed academic restoration pledge.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                        Close
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" onclick="window.print()" style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                            <i class="bi bi-printer me-1.5"></i>Print Case Slip
                        </button>
                        <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-update-case-003" style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                            <i class="bi bi-pencil-square me-1.5"></i>Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!--   MODAL: UPDATE CASE STATUS, NOTES, GOALS (CAS-2026-003)             -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-update-case-003" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square text-warning fs-5"></i>
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Update Clinical Case &bull; CAS-2026-003</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body p-4" style="background-color: #f8f9fa;">
                        <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <strong class="text-dark d-block" style="font-size: 14.5px;">DELA CRUZ, JUAN L. (BSIS)</strong>
                                    <span class="text-muted small">Assigned Counselor: Dr. Elena Santos, RGC</span>
                                </div>
                                <span class="badge" style="border: 1px solid #dc3545; color: #721c24; background-color: #fff5f5; border-radius: 50rem; padding: 6px 12px; font-size: 12px;">
                                    Under Review
                                </span>
                            </div>
                        </div>

                        <div class="row g-3" style="font-size: 14px;">
                            <div class="col-md-6 col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">Update Case Status</label>
                                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                    <option value="In Progress">In Progress</option>
                                    <option value="Under Review" selected>Under Review</option>
                                    <option value="Resolved">Resolved / Closed</option>
                                    <option value="Reopened">Reopened</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">Schedule Review / Follow-up Date</label>
                                <input type="date" class="form-control shadow-none" value="2026-10-31" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-journal-text me-1 text-primary"></i>Counselor Progress Notes &amp; Professional Observations
                                </label>
                                <textarea class="form-control shadow-none" rows="3" placeholder="Record documented observations, student disclosures, and clinical assessments..." style="font-size: 14px; border-color: #ced4da;">Student acknowledges tardiness habits and showed earnest commitment to the structured morning schedule.</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-check2-circle me-1 text-success"></i>Document Completed Interventions &amp; Goal Updates
                                </label>
                                <input type="text" class="form-control shadow-none" placeholder="e.g. Completed sleep hygiene review, verified study schedules..." value="Verified student adherence to counseling goals and schedule agreements." style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fw-semibold small mb-1">
                                    <i class="bi bi-arrow-left-right me-1 text-info"></i>Referral Outcomes &amp; Linkages (If Applicable)
                                </label>
                                <input type="text" class="form-control shadow-none" placeholder="Record status of linked internal or external referrals..." value="Academic behavioral contract active with department review." style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                            Cancel
                        </button>
                        <button type="submit" class="btn text-white shadow-none" data-bs-dismiss="modal" style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; min-width: 110px; border-radius: 4px;">
                            <i class="bi bi-check-lg me-1"></i>Save Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!--   MODAL: VIEW CASE DETAILS & CLINICAL CHRONOLOGY (CAS-2026-004)       -->
    <!-- ==================================================================== -->
    <div class="modal fade" id="modal-view-case-004" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-folder-symlink-fill text-warning fs-5"></i>
                        <div>
                            <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                                Case Progress File &bull; CAS-2026-004
                            </h5>
                            <span class="text-white-50" style="font-size: 13px;">Comprehensive Clinical Progress, Goals &amp; Audit Log</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">

                    <!-- Header Summary Card -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <span class="badge mb-1" style="font-size: 12px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC;">
                                        CAS-2026-004
                                    </span>
                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">ALVAREZ, BEA P.</h4>
                                    <div class="text-muted" style="font-size: 13.5px;">
                                        <span class="me-3"><strong>Student ID:</strong> 2022-00512</span>
                                        <span class="me-3"><strong>College:</strong> College of Education</span>
                                        <span><strong>Program:</strong> BEED (4th Year)</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge mb-1" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 110px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                        Resolved
                                    </span>
                                    <div class="text-muted small">Counselor: <strong>Ms. Clarisse Ramos</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1: Initial Concern & Case Summary -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-medical-fill" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Initial Concern &amp; Clinical Case Summary</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="mb-2">
                                <span class="text-muted d-block small">Primary Intake Category</span>
                                <strong class="text-dark" style="font-size: 14px;">Academic Probation Transition</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block small">Case Summary</span>
                                <p class="text-dark mb-0" style="line-height: 1.6;">Student referred due to academic probation; completed structured peer tutoring and clinical coaching. Probation lifted and cleared for 4th year practicum.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Counseling Goals -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-bullseye" style="color: #800020;"></i>
                                <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Counseling Goals &amp; Counselor-Assessed Indicators</span>
                            </div>
                            <span class="text-muted small">Based on Documented Clinical Observations</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2">
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Remediation Coursework Clearance</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Cleared all back-subject deficiencies with passing grades on Oct 01.</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Study Skills &amp; Time Management Mastery</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Completed 6-week module on cognitive study heuristics.</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="p-3 border rounded h-100 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">Practicum Clearance Approval</strong>
                                            <span class="badge bg-success" style="font-size: 11px;">Met</span>
                                        </div>
                                        <div class="text-muted small" style="line-height: 1.4;">Dean of Education certified eligibility for teaching internship.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Session History & Related Referrals -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar2-check" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Session History</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">SES-2026-002 &bull; Academic Clearance Interview</strong>
                                            <span class="badge bg-light text-muted border">2026-10-08</span>
                                        </div>
                                        <div class="text-muted small">Final debrief; student demonstrated consistent high academic performance.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-arrow-left-right" style="color: #800020;"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Related Referrals &amp; Cross-Links</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark" style="font-size: 13px;">REF-INT-2026-018</strong>
                                            <span class="badge bg-light text-secondary border">Routine</span>
                                        </div>
                                        <div class="text-muted small"><strong>Source:</strong> Dean of Education Endorsement</div>
                                        <div class="text-muted small"><strong>Outcome:</strong> Successfully Completed; Student Cleared for Practicum</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Completed & Pending Actions -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-check2-circle text-success"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Completed Clinical Actions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>All prerequisite removal examinations passed and verified by Registrar.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Final exit interview conducted with guidance counselor on Oct 08, 2026.</span>
                                        </li>
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-check-circle-fill text-success mt-0.5"></i>
                                            <span>Case closure disposition signed and transmitted to Dean of Education.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card border shadow-sm h-100" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                                <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Pending Actions &amp; Interventions</span>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-1.5 d-flex align-items-start gap-2">
                                            <i class="bi bi-dash-circle text-warning mt-0.5"></i>
                                            <span>None — Case is officially concluded and archived in active records.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Progress Notes & Follow-up Schedule -->
                    <div class="card border shadow-sm mb-3" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Professional Progress Notes &amp; Follow-up Schedule</span>
                        </div>
                        <div class="card-body p-3" style="font-size: 13.5px;">
                            <div class="row g-3">
                                <div class="col-md-8 col-12">
                                    <span class="text-muted d-block small">Counselor Progress Notes</span>
                                    <p class="text-dark mb-0" style="line-height: 1.5;">Student demonstrated exemplary discipline, emotional resilience, and academic recovery. No further clinical or behavioral intervention required.</p>
                                </div>
                                <div class="col-md-4 col-12 border-start">
                                    <span class="text-muted d-block small">Follow-up Schedule</span>
                                    <strong class="text-dark">Discharged / Completed (Optional mid-practicum wellness check scheduled for next semester).</strong>
                                    <span class="text-muted d-block small mt-2">Closure / Disposition Reason</span>
                                    <span class="text-dark">All counseling goals fully achieved. Academic probation status formally lifted by university academic council.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Chronological Timeline -->
                    <div class="card border shadow-sm mb-0" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Case Action History &amp; Chronology</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="position-relative ps-3" style="border-left: 2px solid #E2E8F0;">
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Probation Intake Opened</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-08-20</span>
                                    </div>
                                    <div class="text-muted small">Referred by College Dean for academic rehabilitation.</div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Exit Requirements Verified</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-09-10</span>
                                    </div>
                                    <div class="text-muted small">Passed all prerequisite coursework.</div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <div style="position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark" style="font-size: 13px;">Case Formally Resolved &amp; Closed</strong>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">2026-10-08</span>
                                    </div>
                                    <div class="text-muted small">Issued Certificate of Guidance Clearance.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" data-bs-dismiss="modal" style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                        Close
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center" onclick="window.print()" style="height: 34px; min-width: 130px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                            <i class="bi bi-printer me-1.5"></i>Print Case Slip
                        </button>
                        <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-reopen-case-004" style="border: 1px solid #4a5568; color: #2d3748; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                            <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reopen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ==================================================================== -->
<!--   MODAL: REOPEN CASE WITH DOCUMENTED RATIONALE (CAS-004)            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-reopen-case-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-counterclockwise text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Reopen Case &bull; CAS-2026-004
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">
                    <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                        <strong class="text-dark d-block">ALVAREZ, BEA P. (BEED)</strong>
                        <span class="text-muted small">Previous Disposition: Resolved on Oct 08, 2026</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Documented Rationale for Reopening
                            <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-none" rows="3" required
                            placeholder="State the professional rationale, new presenting symptoms, or academic triggers requiring case reopening..."
                            style="font-size: 14px; border-color: #ced4da;">Student requested supplemental follow-up regarding senior internship adjustment and transition support.</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none"
                            style="font-size: 14px; height: 38px; border-color: #ced4da;">
                            <option value="Ms. Clarisse Ramos" selected>Ms. Clarisse Ramos</option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC</option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn text-white shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; min-width: 120px; border-radius: 4px;">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Reopen Case
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: OPEN NEW GUIDANCE CASE                                      -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-create-case" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-folder-plus text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Initiate Guidance Case Tracking
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Student Record</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                <option value="" selected disabled>Select student...</option>
                                <option value="SANTOS, MARIA C.">SANTOS, MARIA C. (2023-01042 - BaPOS)</option>
                                <option value="RAMOS, CARLOS M.">RAMOS, CARLOS M. (2022-00812 - BSIS)</option>
                                <option value="DELA CRUZ, JUAN L.">DELA CRUZ, JUAN L. (2023-01089 - BSIS)</option>
                                <option value="ALVAREZ, BEA P.">ALVAREZ, BEA P. (2022-00512 - BEED)</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Assigned Case Counselor</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC</option>
                                <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm</option>
                                <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Initial Concern Category</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                <option value="Emotional / Personal Wellbeing" selected>Emotional / Personal Wellbeing
                                </option>
                                <option value="Academic Difficulty">Academic Difficulty &amp; Attendance</option>
                                <option value="Career &amp; Pathway">Career &amp; Pathway Guidance</option>
                                <option value="Interpersonal &amp; Family">Interpersonal &amp; Family Relations</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Initial Status</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 14px; height: 38px; border-color: #ced4da;">
                                <option value="In Progress" selected>In Progress</option>
                                <option value="Under Review">Under Review</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Clinical Intake Case
                                Summary</label>
                            <textarea class="form-control shadow-none" rows="3" required
                                placeholder="Document the student's presenting concern, initial counselor observations, and established goals..."
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="height: 34px; width: 88px; min-width: 88px; font-size: 13.5px; font-weight: 500; border-radius: 4px; padding: 0 12px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn text-white shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; min-width: 120px; border-radius: 4px;">
                        <i class="bi bi-folder-check me-1"></i>Open Case
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>