<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT CONCERNS MANAGEMENT    -->
<!--   Module: Guidance & Counseling Services                             -->
<!--   File: modules/guidance/Views/student_concerns.php                  -->
<!--   PURE FRONT-END DIRECT DIV STRUCTURE / NO STYLE OR SCRIPT TAGS     -->
<!--   Centralized Case Intake & Management / RA 10173 Compliant          -->
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
                    Case Management
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Student Concerns
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Student Concerns
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Centralized case intake and management interface for student concerns, assignments, tracking, and confidential guidance services.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2.5 flex-wrap">
            <button type="button"
                class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                style="font-size: 14px; font-weight: 500; height: 38px; border-radius: 6px; padding: 0 16px; background-color: #fff;"
                title="Reset demonstration records to original sample state">
                <i class="bi bi-arrow-clockwise me-1.5"></i>Reset Demo Data
            </button>
            <button type="button"
                class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                style="font-size: 14px; font-weight: 500; height: 38px; border-radius: 6px; padding: 0 16px; background-color: #fff;"
                title="Download currently displayed concerns table as CSV">
                <i class="bi bi-file-earmark-spreadsheet me-1.5"></i>Export CSV
            </button>
            <button type="button"
                class="btn text-white shadow-none d-inline-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-record-concern"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14px; font-weight: 500; height: 38px; border-radius: 6px; padding: 0 16px;"
                title="Document a new student guidance concern">
                <i class="bi bi-plus-circle me-1.5"></i>Record New Concern
            </button>
        </div>
    </div>
</div>

<!-- CLINICAL & ETHICAL SAFEGUARD NOTICE -->
<div class="alert shadow-sm border-0 mb-4 d-flex align-items-start gap-3 p-3.5"
    style="background-color: #f0f7f9; border-left: 4px solid #008080 !important; border-radius: 8px;">
    <i class="bi bi-shield-check fs-4" style="color: #008080; line-height: 1.2;"></i>
    <div>
        <div class="fw-bold mb-1" style="color: #1a365d; font-size: 14.5px;">
            Clinical &amp; Ethical Safeguard (Guidance Professional Standards)
        </div>
        <div class="text-secondary" style="font-size: 13.5px; line-height: 1.5;">
            Do not automatically create a diagnosis, determine a student's clinical risk, or assign a high-risk label
            based solely on referral checklist selections. All clinical and risk determinations require direct
            professional evaluation by a registered guidance counselor under Republic Act No. 10173 and PRC Guidance
            &amp; Counseling Code of Ethics.
        </div>
    </div>
</div>

<!-- 4 STUDENT CONCERNS SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Concerns -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL CASES
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        6
                    </div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-folder-check"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">All intake case records</div>
        </div>
    </div>

    <!-- Card 2: Active / In Review -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #3182ce !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ACTIVE &amp; REVIEW
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        2
                    </div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8;">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">Active counseling &amp; intake review</div>
        </div>
    </div>

    <!-- Card 3: Pending / On Hold -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #d4a017 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ON HOLD / PENDING
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        1
                    </div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e;">
                    <i class="bi bi-pause-circle"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">Awaiting verification documents</div>
        </div>
    </div>

    <!-- Card 4: Resolved & Concluded -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        RESOLVED / CLOSED
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">
                        3
                    </div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #155724; border: 1px solid #c8e6c9;">
                    <i class="bi bi-check2-all"></i>
                </div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 13.5px;">Resolved, closed, or referred</div>
        </div>
    </div>
</div>

<!-- SEARCH AND FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-3.5">
        <div class="row g-3 align-items-center">
            <!-- Search Field -->
            <div class="col-lg-8 col-md-7 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white"
                        style="border-color: #ced4da; font-size: 15px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none"
                        placeholder="Search by student name..."
                        style="font-size: 14.5px; height: 42px; border-color: #ced4da;">
                </div>
            </div>

            <!-- Program Filter -->
            <div class="col-lg-4 col-md-5 col-12">
                <select class="form-select shadow-none" style="font-size: 14px; height: 42px; border-color: #ced4da;">
                    <option value="" selected>All Programs / Academic Units</option>
                    <option value="CICS">CICS &bull; College of Information and Computing Sciences</option>
                    <option value="CAS">CAS &bull; College of Arts and Sciences</option>
                    <option value="CBA">CBA &bull; College of Business and Accountancy</option>
                    <option value="CED">CED &bull; College of Education</option>
                    <option value="COE">COE &bull; College of Engineering</option>
                    <option value="CAG">CAG &bull; College of Agriculture and Fisheries</option>
                    <option value="CCJE">CCJE &bull; College of Criminal Justice Education</option>
                    <option value="CIT">CIT &bull; College of Industrial Technology</option>
                </select>
            </div>
        </div>

        <!-- Toolbar Footer: Active Filter Info & Results Count -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3 pt-3 border-top">
            <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 13.5px;">
                <span class="fw-semibold text-dark">Showing 6 of 6 cases</span>
                <span class="badge bg-light text-dark border px-2.5 py-1.5"
                    style="font-size: 12.5px; font-weight: 500;">
                    Official Case Registry
                </span>
            </div>
            <div class="text-muted small">
                Case Management &bull; Guidance Intake Protocol
            </div>
        </div>
    </div>
</div>

<!-- MAIN STUDENT CONCERNS & CASE REGISTRY TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
        style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <h6 class="m-0 fw-bold" style="font-size: 16px; color: #800020;">
            <i class="bi bi-card-checklist me-2" style="color: #D4AF37;"></i>Centralized Case Registry &amp; Management Directory
        </h6>
        <div class="d-flex align-items-center gap-2">
            <span class="badge text-dark bg-light border px-2.5 py-1.5" style="font-size: 13px; font-weight: 500;">
                Showing 6 Records &bull; Official Directory
            </span>
        </div>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-4"
                            style="font-size: 14.5px; font-weight: 600; padding: 15px 18px; min-width: 250px; color: #2D3748; vertical-align: middle;">
                            Full Name
                        </th>
                        <th
                            style="font-size: 14.5px; font-weight: 600; padding: 15px 18px; min-width: 260px; color: #2D3748; vertical-align: middle;">
                            Concern Category
                        </th>
                        <th
                            style="font-size: 14.5px; font-weight: 600; padding: 15px 18px; min-width: 170px; color: #2D3748; vertical-align: middle;">
                            Date Received
                        </th>
                        <th class="text-center pe-4"
                            style="font-size: 14.5px; font-weight: 600; padding: 15px 18px; width: 140px; min-width: 140px; color: #2D3748; vertical-align: middle;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Row 1: DELA CRUZ, JUAN L. -->
                    <tr class="align-middle">
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold" style="font-size: 14.5px; color: #000000 !important;">DELA CRUZ, JUAN L.</div>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14px;">Academic Difficulties</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; color: #4A5568; font-size: 13.5px;">
                            2026-10-22
                        </td>
                        <td class="text-center pe-4" style="padding: 15px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-con-001"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: SANTOS, MARIA C. -->
                    <tr class="align-middle">
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold" style="font-size: 14.5px; color: #000000 !important;">SANTOS, MARIA C.</div>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14px;">Emotional Well-Being</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; color: #4A5568; font-size: 13.5px;">
                            2026-10-21
                        </td>
                        <td class="text-center pe-4" style="padding: 15px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-con-002"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: RAMOS, CARLOS M. -->
                    <tr class="align-middle">
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold" style="font-size: 14.5px; color: #000000 !important;">RAMOS, CARLOS M.</div>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14px;">Career Uncertainty</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; color: #4A5568; font-size: 13.5px;">
                            2026-10-19
                        </td>
                        <td class="text-center pe-4" style="padding: 15px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-con-003"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: REYES, BEA ANGELA D. -->
                    <tr class="align-middle">
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold" style="font-size: 14.5px; color: #000000 !important;">REYES, BEA ANGELA D.</div>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14px;">Personal Adjustment</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; color: #4A5568; font-size: 13.5px;">
                            2026-10-18
                        </td>
                        <td class="text-center pe-4" style="padding: 15px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-con-004"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 5: TAN, JOSHUA DAVID K. -->
                    <tr class="align-middle">
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold" style="font-size: 14.5px; color: #000000 !important;">TAN, JOSHUA DAVID K.</div>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14px;">Attendance Concerns</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; color: #4A5568; font-size: 13.5px;">
                            2026-10-16
                        </td>
                        <td class="text-center pe-4" style="padding: 15px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-con-005"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 6: LIM, PATRICIA ANNE S. -->
                    <tr class="align-middle">
                        <td class="ps-4" style="padding: 16px 18px; vertical-align: middle;">
                            <div class="fw-bold" style="font-size: 14.5px; color: #000000 !important;">LIM, PATRICIA ANNE S.</div>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark fw-medium" style="font-size: 14px;">Financial or Social Welfare Concerns</span>
                        </td>
                        <td style="padding: 16px 18px; vertical-align: middle; color: #4A5568; font-size: 13.5px;">
                            2026-10-15
                        </td>
                        <td class="text-center pe-4" style="padding: 15px 18px; vertical-align: middle;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-con-006"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3.5 bg-light border-top"
            style="font-size: 13.5px;">
            <div class="text-muted">
                Showing <span class="fw-semibold text-dark">1</span> to <span class="fw-semibold text-dark">6</span> of
                <span class="fw-semibold text-dark">6</span> cases recorded
            </div>
            <nav aria-label="Table Navigation">
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <button class="page-link shadow-none" aria-label="Previous">&laquo;</button>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"
                            style="background-color: #800020; border-color: #800020; color: #fff;">1</span>
                    </li>
                    <li class="page-item disabled">
                        <button class="page-link shadow-none" aria-label="Next">&raquo;</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: RECORD NEW CONCERN / CENTRALIZED CASE INTAKE                -->
<!--   Generous field spacing with ample breathing room above buttons     -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-record-concern" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div>
                    <h5 class="modal-title fw-bold m-0" style="font-size: 17px;">
                        <i class="bi bi-file-earmark-plus me-2 text-warning"></i>Centralized Case Intake &amp; Management Interface
                    </h5>
                    <p class="mb-0 text-white-50 small mt-1">
                        Document the case intake accurately, link appointments or referrals, and establish review protocols.
                    </p>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="alert alert-light border p-3.5 mb-4 d-flex align-items-start gap-2.5"
                    style="border-color: #bee3f8 !important; background-color: #f0f7f9; border-radius: 8px; font-size: 13px; color: #2d3748;">
                    <i class="bi bi-shield-check fs-5 me-2" style="color: #008080;"></i>
                    <div>
                        <strong class="text-dark d-block mb-1">Ethical Assessment Standard:</strong>
                        Do not automatically create a diagnosis, determine a student's clinical risk, or assign a high-risk label based solely on referral checklist selections. Factual intake data serves only as preliminary context for counselor review.
                    </div>
                </div>

                <form action="#" method="POST">
                    <!-- SECTION A: STUDENT REFERENCE -->
                    <div class="card border shadow-sm mb-4" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-person-bounding-box me-1" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Section A: Student Reference</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3.5">
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Student Selector <span class="text-danger">*</span></label>
                                    <select class="form-select shadow-none" style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                        <option value="2023-01089" selected>DELA CRUZ, JUAN L. (2023-01089 - BSIS)</option>
                                        <option value="2023-01042">SANTOS, MARIA C. (2023-01042 - BAPS)</option>
                                        <option value="2022-00812">RAMOS, CARLOS M. (2022-00812 - BEED)</option>
                                        <option value="2024-00155">REYES, BEA ANGELA D. (2024-00155 - BSTM)</option>
                                        <option value="2021-00341">TAN, JOSHUA DAVID K. (2021-00341 - BSCE)</option>
                                        <option value="2023-00492">LIM, PATRICIA ANNE S. (2023-00492 - BSA)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Student Reference ID</label>
                                    <input type="text" class="form-control bg-light shadow-none" value="2023-01089" readonly style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Full Student Name</label>
                                    <input type="text" class="form-control bg-light shadow-none" value="DELA CRUZ, JUAN L." readonly style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Academic Program</label>
                                    <input type="text" class="form-control bg-light shadow-none" value="BS Information Systems (CICS)" readonly style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION B: CONCERN CLASSIFICATION & INTAKE -->
                    <div class="card border shadow-sm mb-4" style="border-color: #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-tags-fill me-1" style="color: #800020;"></i>
                            <span class="fw-bold" style="font-size: 14px; color: #1A202C;">Section B: Concern Classification</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3.5">
                                <div class="col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Primary Concern Category <span class="text-danger">*</span></label>
                                    <select class="form-select shadow-none" style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                        <option value="Academic Difficulties" selected>Academic Difficulties</option>
                                        <option value="Emotional Well-Being">Emotional Well-Being</option>
                                        <option value="Career Uncertainty">Career Uncertainty</option>
                                        <option value="Personal Adjustment">Personal Adjustment</option>
                                        <option value="Attendance Concerns">Attendance Concerns</option>
                                        <option value="Financial or Social Welfare">Financial or Social Welfare</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Date Received</label>
                                    <input type="date" class="form-control shadow-none" value="2026-10-26" style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Scheduled Next Review Date</label>
                                    <input type="date" class="form-control shadow-none" value="2026-11-10" style="font-size: 13.5px; height: 42px; border-color: #ced4da;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-dark small fw-semibold mb-2">Presenting Concern Narrative</label>
                                    <textarea class="form-control shadow-none" rows="3" placeholder="Enter detailed description of the student concern..." style="font-size: 13.5px; border-color: #ced4da; line-height: 1.5;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL FOOTER WITH COMFORTABLE SEPARATION FROM FIELDS -->
                    <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-end gap-3 mt-4" style="border-radius: 0 0 12px 12px;">
                        <button type="button" class="btn btn-secondary px-3.5 shadow-none" data-bs-dismiss="modal" style="font-size: 13.5px; height: 38px; border-radius: 4px;">Cancel</button>
                        <button type="submit" class="btn text-white px-4 shadow-none" data-bs-dismiss="modal" style="background-color: #800020; border-color: #800020; font-size: 13.5px; height: 38px; border-radius: 4px; font-weight: 500;">Record Intake Concern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: VIEW CASE DETAILS (ORGANIZED, 15PX TEXT SIZE, NO UPDATE)   -->
<!--   Includes NEXT REVIEW DATE, orderly sequence, and proper spacing    -->
<!-- ==================================================================== -->

<!-- Modal View 1: DELA CRUZ, JUAN L. (CON-2026-0001) -->
<div class="modal fade" id="modal-view-con-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="bi bi-folder2-open text-warning fs-5 me-1"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-bold" style="font-size: 17px;">Case Record &bull; CON-2026-0001</h5>
                        <span class="text-white-50" style="font-size: 13px;">Official Guidance &amp; Counseling Case Intake Profile</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" style="font-size: 15px;">
                <!-- 1. Header Profile Banner -->
                <div class="p-3.5 mb-4 rounded border bg-light d-flex justify-content-between align-items-center flex-wrap gap-3"
                    style="border-color: #E2E8F0 !important;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                            <span class="badge" style="font-size: 13.5px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC; padding: 4px 10px;">
                                CON-2026-0001
                            </span>
                            <span class="fw-bold text-dark" style="font-size: 18px;">DELA CRUZ, JUAN L.</span>
                        </div>
                        <div class="text-muted" style="font-size: 15px; line-height: 1.5;">
                            Student ID: <strong class="text-dark">2023-01089</strong> &bull; Program: <strong class="text-dark">BS Information Systems</strong> (CICS) &bull; 2nd Year, Sec A
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="badge" style="border: 1px solid #cbd5e0; background-color: #f7fafc; color: #4a5568; border-radius: 6px; padding: 6px 14px; font-size: 13.5px; font-weight: 600;">
                            Routine
                        </span>
                        <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 100px; height: 32px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">
                            Resolved
                        </span>
                    </div>
                </div>

                <!-- 2. Case Particulars & Schedule Metrics Grid -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill me-1" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Case Particulars &amp; Timeline</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-tag text-muted me-2"></i>CONCERN CATEGORY
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Academic Difficulties
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-calendar-check text-muted me-2"></i>DATE RECEIVED
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        2026-10-22
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border h-100" style="border: 1.5px solid #d4a017 !important; background-color: #fffdf5 !important;">
                                    <div class="mb-1 fw-bold" style="font-size: 13.5px; color: #856404;">
                                        <i class="bi bi-calendar-event me-2 text-warning"></i>SCHEDULED NEXT REVIEW DATE
                                    </div>
                                    <div class="fw-bold" style="font-size: 15.5px; color: #856404; line-height: 1.4;">
                                        2026-11-10
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-person-check text-muted me-2"></i>ASSIGNED COUNSELOR
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Dr. Elena Santos, RGC
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Presenting Concern Narrative & Origin -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Presenting Concern Narrative &amp; Case Linkage</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded border mb-3 text-dark fw-semibold" style="font-size: 15px; border-color: #E2E8F0 !important; line-height: 1.5;">
                            Student requested assistance regarding difficulty adjusting to object-oriented programming coursework and semester deadlines.
                        </div>
                        <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.65;">
                            Student self-reported feeling overwhelmed by advanced laboratory exercises in programming and data structures. Expressed apprehension about falling behind in major subjects and requested academic coaching, time management guidance, and linkage to peer tutoring services.
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top text-muted" style="font-size: 15px;">
                            <span><strong>Intake Source:</strong> Student Seeking Assistance (Self-walk-in)</span>
                            <span class="mx-1">&bull;</span>
                            <span><strong>Linked Records:</strong> Appointment <code class="text-dark" style="font-size: 14.5px;">APT-2026-0004</code>, Session <code class="text-dark" style="font-size: 14.5px;">SES-2026-0004</code></span>
                        </div>
                    </div>
                </div>

                <!-- 4. Counselor Assessment & Action Targets -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Counselor Assessment &amp; Action Plan</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-dark mb-3.5" style="font-size: 15px; line-height: 1.65;">
                            Intake completed via self-walk-in consultation. Student showed high self-awareness and willingness to adopt structured study scheduling. Linked student with CICS peer mentor society and scheduled bi-weekly academic progress reviews.
                        </p>
                        <div class="row g-3 mb-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Weekly study schedule established</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 13.5px;">Completed</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Peer tutoring sessions attended (4x)</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 13.5px;">Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top text-muted flex-wrap gap-2" style="font-size: 15px;">
                            <span>Case Resolution: <strong class="text-dark">Resolved with Positive Outcome</strong></span>
                            <span>Scheduled Next Review: <strong class="text-warning-emphasis fw-bold" style="color: #856404 !important;"><i class="bi bi-calendar-event me-2"></i>2026-11-10</strong></span>
                        </div>
                    </div>
                </div>

                <!-- 5. Minimalist Statutory Notice -->
                <div class="p-3.5 mb-4 rounded border bg-light text-muted d-flex align-items-center gap-2.5" style="border-color: #E2E8F0 !important; font-size: 14px;">
                    <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                    <span>Confidential student counseling record protected under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    Close
                </button>
                <button type="button" class="btn btn-outline-secondary px-3.5 shadow-none" onclick="window.print()" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    <i class="bi bi-printer me-2"></i>Print Summary
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 2: SANTOS, MARIA C. (CON-2026-0002) -->
<div class="modal fade" id="modal-view-con-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="bi bi-folder2-open text-warning fs-5 me-1"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-bold" style="font-size: 17px;">Case Record &bull; CON-2026-0002</h5>
                        <span class="text-white-50" style="font-size: 13px;">Official Guidance &amp; Counseling Case Intake Profile</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" style="font-size: 15px;">
                <!-- 1. Header Profile Banner -->
                <div class="p-3.5 mb-4 rounded border bg-light d-flex justify-content-between align-items-center flex-wrap gap-3"
                    style="border-color: #E2E8F0 !important;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                            <span class="badge" style="font-size: 13.5px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC; padding: 4px 10px;">
                                CON-2026-0002
                            </span>
                            <span class="fw-bold text-dark" style="font-size: 18px;">SANTOS, MARIA C.</span>
                        </div>
                        <div class="text-muted" style="font-size: 15px; line-height: 1.5;">
                            Student ID: <strong class="text-dark">2023-01042</strong> &bull; Program: <strong class="text-dark">BA Political Science</strong> (CAS) &bull; 2nd Year, Sec B
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="badge" style="border: 1px solid #e53e3e; background-color: #fff5f5; color: #c53030; border-radius: 6px; padding: 6px 14px; font-size: 13.5px; font-weight: 600;">
                            Urgent Review
                        </span>
                        <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 100px; height: 32px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">
                            Active
                        </span>
                    </div>
                </div>

                <!-- 2. Case Particulars & Schedule Metrics Grid -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill me-1" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Case Particulars &amp; Timeline</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-tag text-muted me-2"></i>CONCERN CATEGORY
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Emotional Well-Being
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-calendar-check text-muted me-2"></i>DATE RECEIVED
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        2026-10-21
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border h-100" style="border: 1.5px solid #d4a017 !important; background-color: #fffdf5 !important;">
                                    <div class="mb-1 fw-bold" style="font-size: 13.5px; color: #856404;">
                                        <i class="bi bi-calendar-event me-2 text-warning"></i>SCHEDULED NEXT REVIEW DATE
                                    </div>
                                    <div class="fw-bold" style="font-size: 15.5px; color: #856404; line-height: 1.4;">
                                        2026-10-28
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-person-check text-muted me-2"></i>ASSIGNED COUNSELOR
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Dr. Elena Santos, RGC
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Presenting Concern Narrative & Origin -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Presenting Concern Narrative &amp; Case Linkage</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded border mb-3 text-dark fw-semibold" style="font-size: 15px; border-color: #E2E8F0 !important; line-height: 1.5;">
                            Experienced panic symptoms, shortness of breath, and heightened anxiety during comprehensive midterm examinations.
                        </div>
                        <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.65;">
                            Student presented to the guidance office following an acute exam anxiety episode during midterm week. Counselor conducted clinical intake, administered grounding techniques, and formulated an ongoing stress inoculation and academic coping plan.
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top text-muted" style="font-size: 15px;">
                            <span><strong>Intake Source:</strong> Faculty Referral (Department of Social Sciences)</span>
                            <span class="mx-1">&bull;</span>
                            <span><strong>Linked Records:</strong> Referral <code class="text-dark" style="font-size: 14.5px;">REF-2026-0002</code>, Appointment <code class="text-dark" style="font-size: 14.5px;">APT-2026-0001</code>, Session <code class="text-dark" style="font-size: 14.5px;">SES-2026-0001</code></span>
                        </div>
                    </div>
                </div>

                <!-- 4. Counselor Assessment & Action Targets -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Counselor Assessment &amp; Action Plan</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-dark mb-3.5" style="font-size: 15px; line-height: 1.65;">
                            Conducted clinical intake and breathing grounding exercises. Formulated immediate safety support plan and scheduled weekly counseling check-ins.
                        </p>
                        <div class="row g-3 mb-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Anxiety reduction breathing regimen</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 13.5px;">In Progress</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Bi-weekly stress management session</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 13.5px;">In Progress</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top text-muted flex-wrap gap-2" style="font-size: 15px;">
                            <span>Case Resolution: <strong class="text-dark">Active Monitoring &amp; Stabilization</strong></span>
                            <span>Scheduled Next Review: <strong class="text-warning-emphasis fw-bold" style="color: #856404 !important;"><i class="bi bi-calendar-event me-2"></i>2026-10-28</strong></span>
                        </div>
                    </div>
                </div>

                <!-- 5. Minimalist Statutory Notice -->
                <div class="p-3.5 mb-4 rounded border bg-light text-muted d-flex align-items-center gap-2.5" style="border-color: #E2E8F0 !important; font-size: 14px;">
                    <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                    <span>Confidential student counseling record protected under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    Close
                </button>
                <button type="button" class="btn btn-outline-secondary px-3.5 shadow-none" onclick="window.print()" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    <i class="bi bi-printer me-2"></i>Print Summary
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 3: RAMOS, CARLOS M. (CON-2026-0003) -->
<div class="modal fade" id="modal-view-con-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="bi bi-folder2-open text-warning fs-5 me-1"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-bold" style="font-size: 17px;">Case Record &bull; CON-2026-0003</h5>
                        <span class="text-white-50" style="font-size: 13px;">Official Guidance &amp; Counseling Case Intake Profile</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" style="font-size: 15px;">
                <!-- 1. Header Profile Banner -->
                <div class="p-3.5 mb-4 rounded border bg-light d-flex justify-content-between align-items-center flex-wrap gap-3"
                    style="border-color: #E2E8F0 !important;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                            <span class="badge" style="font-size: 13.5px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC; padding: 4px 10px;">
                                CON-2026-0003
                            </span>
                            <span class="fw-bold text-dark" style="font-size: 18px;">RAMOS, CARLOS M.</span>
                        </div>
                        <div class="text-muted" style="font-size: 15px; line-height: 1.5;">
                            Student ID: <strong class="text-dark">2022-00812</strong> &bull; Program: <strong class="text-dark">Bachelor of Elementary Education</strong> (CED) &bull; 3rd Year, Sec A
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="badge" style="border: 1px solid #cbd5e0; background-color: #f7fafc; color: #4a5568; border-radius: 6px; padding: 6px 14px; font-size: 13.5px; font-weight: 600;">
                            Routine
                        </span>
                        <span class="badge" style="border: 1.5px solid #17a2b8; background-color: #e8f7fa; color: #0c5460; border-radius: 50rem; min-width: 100px; height: 32px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">
                            Under Review
                        </span>
                    </div>
                </div>

                <!-- 2. Case Particulars & Schedule Metrics Grid -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill me-1" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Case Particulars &amp; Timeline</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-tag text-muted me-2"></i>CONCERN CATEGORY
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Career Uncertainty
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-calendar-check text-muted me-2"></i>DATE RECEIVED
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        2026-10-19
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border h-100" style="border: 1.5px solid #d4a017 !important; background-color: #fffdf5 !important;">
                                    <div class="mb-1 fw-bold" style="font-size: 13.5px; color: #856404;">
                                        <i class="bi bi-calendar-event me-2 text-warning"></i>SCHEDULED NEXT REVIEW DATE
                                    </div>
                                    <div class="fw-bold" style="font-size: 15.5px; color: #856404; line-height: 1.4;">
                                        2026-10-30
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-person-check text-muted me-2"></i>ASSIGNED COUNSELOR
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Prof. Mark Bautista, RPm
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Presenting Concern Narrative & Origin -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Presenting Concern Narrative &amp; Case Linkage</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded border mb-3 text-dark fw-semibold" style="font-size: 15px; border-color: #E2E8F0 !important; line-height: 1.5;">
                            Student contemplating shift of specialization or non-teaching career pathways prior to upcoming practicum semester.
                        </div>
                        <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.65;">
                            Student requested comprehensive career consultation to re-evaluate commitment to teaching profession. Expressed interest in educational technology and corporate human resource training roles.
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top text-muted" style="font-size: 15px;">
                            <span><strong>Intake Source:</strong> Student Seeking Assistance (Appointment)</span>
                            <span class="mx-1">&bull;</span>
                            <span><strong>Linked Records:</strong> Appointment <code class="text-dark" style="font-size: 14.5px;">APT-2026-0002</code>, Session <code class="text-dark" style="font-size: 14.5px;">SES-2026-0002</code></span>
                        </div>
                    </div>
                </div>

                <!-- 4. Counselor Assessment & Action Targets -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Counselor Assessment &amp; Action Plan</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-dark mb-3.5" style="font-size: 15px; line-height: 1.65;">
                            Administered RIASEC Career Interest Inventory. Student demonstrated strong Artistic and Social interest profiles. Scheduled vocational interpretation session.
                        </p>
                        <div class="row g-3 mb-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>RIASEC interest inventory assessment</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 13.5px;">Completed</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Practicum mentorship consultation</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 13.5px;">In Progress</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top text-muted flex-wrap gap-2" style="font-size: 15px;">
                            <span>Case Status: <strong class="text-dark">Case Under Vocational Review</strong></span>
                            <span>Scheduled Next Review: <strong class="text-warning-emphasis fw-bold" style="color: #856404 !important;"><i class="bi bi-calendar-event me-2"></i>2026-10-30</strong></span>
                        </div>
                    </div>
                </div>

                <!-- 5. Minimalist Statutory Notice -->
                <div class="p-3.5 mb-4 rounded border bg-light text-muted d-flex align-items-center gap-2.5" style="border-color: #E2E8F0 !important; font-size: 14px;">
                    <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                    <span>Confidential student counseling record protected under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    Close
                </button>
                <button type="button" class="btn btn-outline-secondary px-3.5 shadow-none" onclick="window.print()" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    <i class="bi bi-printer me-2"></i>Print Summary
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 4: REYES, BEA ANGELA D. (CON-2026-0004) -->
<div class="modal fade" id="modal-view-con-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="bi bi-folder2-open text-warning fs-5 me-1"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-bold" style="font-size: 17px;">Case Record &bull; CON-2026-0004</h5>
                        <span class="text-white-50" style="font-size: 13px;">Official Guidance &amp; Counseling Case Intake Profile</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" style="font-size: 15px;">
                <!-- 1. Header Profile Banner -->
                <div class="p-3.5 mb-4 rounded border bg-light d-flex justify-content-between align-items-center flex-wrap gap-3"
                    style="border-color: #E2E8F0 !important;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                            <span class="badge" style="font-size: 13.5px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC; padding: 4px 10px;">
                                CON-2026-0004
                            </span>
                            <span class="fw-bold text-dark" style="font-size: 18px;">REYES, BEA ANGELA D.</span>
                        </div>
                        <div class="text-muted" style="font-size: 15px; line-height: 1.5;">
                            Student ID: <strong class="text-dark">2024-00155</strong> &bull; Program: <strong class="text-dark">BS Tourism Management</strong> (CAS) &bull; 1st Year, Sec C
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="badge" style="border: 1px solid #cbd5e0; background-color: #f7fafc; color: #4a5568; border-radius: 6px; padding: 6px 14px; font-size: 13.5px; font-weight: 600;">
                            Routine
                        </span>
                        <span class="badge" style="border: 1.5px solid #6c757d; background-color: #f8f9fa; color: #495057; border-radius: 50rem; min-width: 100px; height: 32px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">
                            Closed
                        </span>
                    </div>
                </div>

                <!-- 2. Case Particulars & Schedule Metrics Grid -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill me-1" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Case Particulars &amp; Timeline</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-tag text-muted me-2"></i>CONCERN CATEGORY
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Personal Adjustment
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-calendar-check text-muted me-2"></i>DATE RECEIVED
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        2026-10-18
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border h-100" style="border: 1.5px solid #28a745 !important; background-color: #f6fcf8 !important;">
                                    <div class="mb-1 fw-bold" style="font-size: 13.5px; color: #155724;">
                                        <i class="bi bi-check2-circle me-2 text-success"></i>SCHEDULED NEXT REVIEW DATE
                                    </div>
                                    <div class="fw-bold" style="font-size: 15.5px; color: #155724; line-height: 1.4;">
                                        Concluded
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-person-check text-muted me-2"></i>ASSIGNED COUNSELOR
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Ms. Clarisse Ramos
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Presenting Concern Narrative & Origin -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Presenting Concern Narrative &amp; Case Linkage</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded border mb-3 text-dark fw-semibold" style="font-size: 15px; border-color: #E2E8F0 !important; line-height: 1.5;">
                            Freshman student adjusting to boarding house living away from provincial home in Torrijos, Marinduque.
                        </div>
                        <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.65;">
                            Student experienced homesickness and social isolation during first month on campus. Guidance Peer Facilitators encouraged student to visit the guidance office for freshmen adjustment support.
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top text-muted" style="font-size: 15px;">
                            <span><strong>Intake Source:</strong> Peer / Guidance Club Referral</span>
                            <span class="mx-1">&bull;</span>
                            <span><strong>Linked Records:</strong> Referral <code class="text-dark" style="font-size: 14.5px;">REF-2026-0001</code>, Appointment <code class="text-dark" style="font-size: 14.5px;">APT-2026-0003</code>, Session <code class="text-dark" style="font-size: 14.5px;">SES-2026-0003</code></span>
                        </div>
                    </div>
                </div>

                <!-- 4. Counselor Assessment & Action Targets -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Counselor Assessment &amp; Action Plan</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-dark mb-3.5" style="font-size: 15px; line-height: 1.65;">
                            Student participated in two adjustment counseling sessions and was introduced to MarSU campus student clubs and peer facilitators. Adjustment milestones successfully achieved.
                        </p>
                        <div class="row g-3 mb-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Campus social integration and club registration</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 13.5px;">Completed</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Independent living coping mechanisms</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 13.5px;">Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top text-muted flex-wrap gap-2" style="font-size: 15px;">
                            <span>Case Resolution: <strong class="text-dark">Closed with Satisfactory Adjustment</strong></span>
                            <span>Review Status: <strong class="text-dark">Concluded (2026-10-22)</strong></span>
                        </div>
                    </div>
                </div>

                <!-- 5. Minimalist Statutory Notice -->
                <div class="p-3.5 mb-4 rounded border bg-light text-muted d-flex align-items-center gap-2.5" style="border-color: #E2E8F0 !important; font-size: 14px;">
                    <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                    <span>Confidential student counseling record protected under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    Close
                </button>
                <button type="button" class="btn btn-outline-secondary px-3.5 shadow-none" onclick="window.print()" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    <i class="bi bi-printer me-2"></i>Print Summary
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 5: TAN, JOSHUA DAVID K. (CON-2026-0005) -->
<div class="modal fade" id="modal-view-con-005" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="bi bi-folder2-open text-warning fs-5 me-1"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-bold" style="font-size: 17px;">Case Record &bull; CON-2026-0005</h5>
                        <span class="text-white-50" style="font-size: 13px;">Official Guidance &amp; Counseling Case Intake Profile</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" style="font-size: 15px;">
                <!-- 1. Header Profile Banner -->
                <div class="p-3.5 mb-4 rounded border bg-light d-flex justify-content-between align-items-center flex-wrap gap-3"
                    style="border-color: #E2E8F0 !important;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                            <span class="badge" style="font-size: 13.5px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC; padding: 4px 10px;">
                                CON-2026-0005
                            </span>
                            <span class="fw-bold text-dark" style="font-size: 18px;">TAN, JOSHUA DAVID K.</span>
                        </div>
                        <div class="text-muted" style="font-size: 15px; line-height: 1.5;">
                            Student ID: <strong class="text-dark">2021-00341</strong> &bull; Program: <strong class="text-dark">BS Civil Engineering</strong> (COE) &bull; 4th Year, Sec A
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="badge" style="border: 1.5px solid #ffc107; background-color: #fffdf0; color: #856404; border-radius: 50rem; min-width: 100px; height: 32px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">
                            On Hold
                        </span>
                    </div>
                </div>

                <!-- 2. Case Particulars & Schedule Metrics Grid -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill me-1" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Case Particulars &amp; Timeline</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-tag text-muted me-2"></i>CONCERN CATEGORY
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Attendance Concerns
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-calendar-check text-muted me-2"></i>DATE RECEIVED
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        2026-10-16
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border h-100" style="border: 1.5px solid #d4a017 !important; background-color: #fffdf5 !important;">
                                    <div class="mb-1 fw-bold" style="font-size: 13.5px; color: #856404;">
                                        <i class="bi bi-calendar-event me-2 text-warning"></i>SCHEDULED NEXT REVIEW DATE
                                    </div>
                                    <div class="fw-bold" style="font-size: 15.5px; color: #856404; line-height: 1.4;">
                                        2026-10-27
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-person-check text-muted me-2"></i>ASSIGNED COUNSELOR
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Dr. Elena Santos, RGC
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Presenting Concern Narrative & Origin -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Presenting Concern Narrative &amp; Case Linkage</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded border mb-3 text-dark fw-semibold" style="font-size: 15px; border-color: #E2E8F0 !important; line-height: 1.5;">
                            Multiple consecutive absences in core structural analysis and engineering design subjects.
                        </div>
                        <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.65;">
                            COE College Secretary flagged consecutive unexcused absences exceeding allowable thresholds. Student was issued an official intake notice to ascertain underlying reasons (health, family, or employment conflicts).
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top text-muted" style="font-size: 15px;">
                            <span><strong>Intake Source:</strong> College Dean / Attendance Office</span>
                            <span class="mx-1">&bull;</span>
                            <span><strong>Linked Records:</strong> Referral <code class="text-dark" style="font-size: 14.5px;">REF-2026-0003</code>, Appointment <code class="text-dark" style="font-size: 14.5px;">APT-2026-0005</code></span>
                        </div>
                    </div>
                </div>

                <!-- 4. Counselor Assessment & Action Targets -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Counselor Assessment &amp; Action Plan</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-dark mb-3.5" style="font-size: 15px; line-height: 1.65;">
                            Preliminary interview revealed night shift employment conflicts. Awaiting submission of certificate of employment and academic load adjustment request.
                        </p>
                        <div class="row g-3 mb-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Employment proof &amp; schedule coordination</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 13.5px;">In Progress</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>COE load reduction consultation</span>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle" style="font-size: 13.5px;">Pending</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top text-muted flex-wrap gap-2" style="font-size: 15px;">
                            <span>Case Status: <strong class="text-dark">Pending Employer Verification</strong></span>
                            <span>Scheduled Next Review: <strong class="text-warning-emphasis fw-bold" style="color: #856404 !important;"><i class="bi bi-calendar-event me-2"></i>2026-10-27</strong></span>
                        </div>
                    </div>
                </div>

                <!-- 5. Minimalist Statutory Notice -->
                <div class="p-3.5 mb-4 rounded border bg-light text-muted d-flex align-items-center gap-2.5" style="border-color: #E2E8F0 !important; font-size: 14px;">
                    <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                    <span>Confidential student counseling record protected under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    Close
                </button>
                <button type="button" class="btn btn-outline-secondary px-3.5 shadow-none" onclick="window.print()" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    <i class="bi bi-printer me-2"></i>Print Summary
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View 6: LIM, PATRICIA ANNE S. (CON-2026-0006) -->
<div class="modal fade" id="modal-view-con-006" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="bi bi-folder2-open text-warning fs-5 me-1"></i>
                    <div>
                        <h5 class="modal-title m-0 fw-bold" style="font-size: 17px;">Case Record &bull; CON-2026-0006</h5>
                        <span class="text-white-50" style="font-size: 13px;">Official Guidance &amp; Counseling Case Intake Profile</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" style="font-size: 15px;">
                <!-- 1. Header Profile Banner -->
                <div class="p-3.5 mb-4 rounded border bg-light d-flex justify-content-between align-items-center flex-wrap gap-3"
                    style="border-color: #E2E8F0 !important;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                            <span class="badge" style="font-size: 13.5px; font-family: monospace; background-color: #FDF2F4; color: #800020; border: 1px solid #F3C4CC; padding: 4px 10px;">
                                CON-2026-0006
                            </span>
                            <span class="fw-bold text-dark" style="font-size: 18px;">LIM, PATRICIA ANNE S.</span>
                        </div>
                        <div class="text-muted" style="font-size: 15px; line-height: 1.5;">
                            Student ID: <strong class="text-dark">2023-00492</strong> &bull; Program: <strong class="text-dark">BS Accountancy</strong> (CBA) &bull; 2nd Year, Sec A
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="badge" style="border: 1px solid #cbd5e0; background-color: #f7fafc; color: #4a5568; border-radius: 6px; padding: 6px 14px; font-size: 13.5px; font-weight: 600;">
                            Routine
                        </span>
                        <span class="badge" style="border: 1.5px solid #17a2b8; background-color: #e8f7fa; color: #0c5460; border-radius: 50rem; min-width: 100px; height: 32px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">
                            Referred
                        </span>
                    </div>
                </div>

                <!-- 2. Case Particulars & Schedule Metrics Grid -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill me-1" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Case Particulars &amp; Timeline</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-tag text-muted me-2"></i>CONCERN CATEGORY
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Financial / Welfare
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-calendar-check text-muted me-2"></i>DATE RECEIVED
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        2026-10-15
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border h-100" style="border: 1.5px solid #d4a017 !important; background-color: #fffdf5 !important;">
                                    <div class="mb-1 fw-bold" style="font-size: 13.5px; color: #856404;">
                                        <i class="bi bi-calendar-event me-2 text-warning"></i>SCHEDULED NEXT REVIEW DATE
                                    </div>
                                    <div class="fw-bold" style="font-size: 15.5px; color: #856404; line-height: 1.4;">
                                        2026-10-31
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded border bg-light h-100" style="border-color: #E2E8F0 !important;">
                                    <div class="text-muted mb-1" style="font-size: 13.5px; font-weight: 600;">
                                        <i class="bi bi-person-check text-muted me-2"></i>ASSIGNED COUNSELOR
                                    </div>
                                    <div class="text-dark fw-bold" style="font-size: 15px; line-height: 1.4;">
                                        Dr. Elena Santos, RGC
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Presenting Concern Narrative & Origin -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text-fill me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Presenting Concern Narrative &amp; Case Linkage</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded border mb-3 text-dark fw-semibold" style="font-size: 15px; border-color: #E2E8F0 !important; line-height: 1.5;">
                            Student inquired regarding institutional scholarship options and emergency student welfare food subsidies.
                        </div>
                        <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.65;">
                            Student experienced sudden financial emergency due to primary breadwinner's medical illness. Inquired about financial assistance programs, textbook lending, and food subsidy grants.
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top text-muted" style="font-size: 15px;">
                            <span><strong>Intake Source:</strong> Student Seeking Assistance (Walk-in)</span>
                            <span class="mx-1">&bull;</span>
                            <span><strong>Linked Records:</strong> Appointment <code class="text-dark" style="font-size: 14.5px;">APT-2026-0006</code>, Session <code class="text-dark" style="font-size: 14.5px;">SES-2026-0006</code>, Welfare <code class="text-dark" style="font-size: 14.5px;">WLF-2026-0012</code></span>
                        </div>
                    </div>
                </div>

                <!-- 4. Counselor Assessment & Action Targets -->
                <div class="card border mb-4 shadow-sm" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle me-2" style="color: #800020;"></i>
                        <span class="fw-bold text-dark" style="font-size: 15px;">Counselor Assessment &amp; Action Plan</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-dark mb-3.5" style="font-size: 15px; line-height: 1.65;">
                            Verified student academic standing (GWA 1.35) and financial need. Processed inter-departmental endorsement to MarSU Student Welfare and Scholarship Office.
                        </p>
                        <div class="row g-3 mb-3.5">
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Emergency financial subsidy endorsement</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 13.5px;">Completed</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="p-3 rounded bg-light border d-flex justify-content-between align-items-center" style="font-size: 15px;">
                                    <span>Alumni book allowance scholarship grant</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 13.5px;">In Progress</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top text-muted flex-wrap gap-2" style="font-size: 15px;">
                            <span>Case Status: <strong class="text-dark">Endorsed to Student Welfare</strong></span>
                            <span>Scheduled Next Review: <strong class="text-warning-emphasis fw-bold" style="color: #856404 !important;"><i class="bi bi-calendar-event me-2"></i>2026-10-31</strong></span>
                        </div>
                    </div>
                </div>

                <!-- 5. Minimalist Statutory Notice -->
                <div class="p-3.5 mb-4 rounded border bg-light text-muted d-flex align-items-center gap-2.5" style="border-color: #E2E8F0 !important; font-size: 14px;">
                    <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                    <span>Confidential student counseling record protected under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                </div>
            </div>
            <div class="modal-footer px-4 py-3.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    Close
                </button>
                <button type="button" class="btn btn-outline-secondary px-3.5 shadow-none" onclick="window.print()" style="font-size: 14.5px; height: 38px; border-radius: 6px;">
                    <i class="bi bi-printer me-2"></i>Print Summary
                </button>
            </div>
        </div>
    </div>
</div>