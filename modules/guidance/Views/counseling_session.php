<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: COUNSELING SESSION MANAGEMENT        -->
<!--   FILE LOCATION: views/guidance/counseling_session.php               -->
<!--   NO CUSTOM JAVASCRIPT / PURE BOOTSTRAP 5 DATA-ATTRIBUTES (ENGLISH)  -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 13.5px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="#" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="#" style="color: #800020; text-decoration: none; font-weight: 500;">
                    Guidance & Counseling Services
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Counseling Sessions
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 20px; letter-spacing: -0.2px;">
                Counseling Session Management & Case Notes
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.5;">
                Conduct counseling sessions, document confidential session summaries, and manage post-consultation
                resolutions.
            </p>
        </div>
        <button type="button" class="btn text-white px-3 shadow-none d-flex align-items-center" data-bs-toggle="modal"
            data-bs-target="#modal-start-session"
            style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; border-radius: 6px; height: 38px;">
            <i class="bi bi-play-circle me-1.5"></i>Start Session
        </button>
    </div>
</div>

<!-- 4 KPI SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL SESSIONS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">4
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">All conducted sessions</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D4A017 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        IN PROGRESS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FEFCF0; color: #B7791F; border: 1px solid #F6E05E;">
                    <i class="bi bi-soundwave"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Ongoing active consultation</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #3182ce !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        UPCOMING SLOTS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #ebf8ff; color: #3182ce; border: 1px solid #bee3f8;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Scheduled for today / week</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #2e7d32 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        COMPLETED SESSIONS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">2
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9;">
                    <i class="bi bi-check2-all"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Concluded session logs signed</div>
        </div>
    </div>
</div>

<!-- SESSIONS MASTER LOG TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #EBE4E4 !important; border-radius: 10px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #EBE4E4;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-journal-medical me-2" style="color: #D4A017;"></i>Counseling Consultation Log
        </h6>

        <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="input-group input-group-sm" style="width: 250px;">
                <span class="input-group-text border-end-0 text-muted"
                    style="background-color: #ffffff; border-color: #ced4da; font-size: 13.5px;">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 shadow-none"
                    placeholder="Search student, session ID..."
                    style="font-size: 13.5px; height: 38px; border-color: #ced4da;">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 125px; color: #2D3748;">
                            Session ID</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 170px; color: #2D3748;">
                            Student Name</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 90px; color: #2D3748;">
                            Program</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 165px; color: #2D3748;">
                            Schedule & Room</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 160px; color: #2D3748;">
                            Assigned Counselor</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 120px; color: #2D3748;">
                            Session State</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 170px; color: #2D3748;">
                            Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13.5px;">
                    <!-- Row 1: Ongoing Session -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">SES-2026-001
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">SANTOS, MARIA C.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIT</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Today, Oct 21</strong><br>
                            <span class="text-muted small">02:00 PM • Room 1</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">Dr. Elena Santos, RGC</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 5px 0; font-size: 11.5px; font-weight: 500;">
                                In Progress
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <!-- ADDED PROPER SPACING (gap-2) AND DEFINED WIDTHS -->
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-view-session-001"
                                    style="min-width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button" class="btn btn-sm text-white shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-add-notes-001"
                                    style="min-width: 74px; background-color: #800020; border: 1px solid #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-journal-text me-1"></i>Notes
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Upcoming Slot -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">SES-2026-002
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Oct 23, 2026</strong><br>
                            <span class="text-muted small">01:00 PM • Peer Room</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">Prof. Mark Bautista, RPm</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #3182ce; color: #2b6cb0; background-color: #ebf8ff; border-radius: 50rem; padding: 5px 0; font-size: 11.5px; font-weight: 500;">
                                Scheduled
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-view-session-002"
                                    style="min-width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button" class="btn btn-sm text-white shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-conduct-session-002"
                                    style="min-width: 74px; background-color: #800020; border: 1px solid #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-play-fill me-1"></i>Start
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Concluded Session -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">SES-2026-003
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">
                            Oct 16, 2026<br>
                            <span class="small">10:00 AM • Room 2</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Ms. Clarisse Ramos</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 11.5px; font-weight: 500;">
                                Completed
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-view-session-003"
                                    style="min-width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button" class="btn btn-sm text-secondary shadow-none border" disabled
                                    style="min-width: 74px; background-color: #f8f9fa; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    Closed
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Concluded Session -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">SES-2026-004
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">DELA CRUZ, JUAN L.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIS</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">
                            Oct 09, 2026<br>
                            <span class="small">09:00 AM • Room 1</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-muted">Dr. Elena Santos, RGC</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 100px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 11.5px; font-weight: 500;">
                                Completed
                            </span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-view-session-004"
                                    style="min-width: 68px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button" class="btn btn-sm text-secondary shadow-none border" disabled
                                    style="min-width: 74px; background-color: #f8f9fa; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    Closed
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
<!--   MODAL: START NEW COUNSELING SESSION                                -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-start-session" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-play-circle-fill" style="color: #D4A017; font-size: 18px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Initiate Counseling Consultation
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="row g-3" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Select Scheduled Appointment /
                                Student</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="" selected disabled>Select student...</option>
                                <option value="APT-2026-002">SANTOS, MARIA C. (BSIT) — Stress Management</option>
                                <option value="APT-2026-004">RAMOS, CARLOS M. (BSTM) — Career Exploration</option>
                                <option value="WALK-IN">Walk-In Intake / Emergency Session</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC</option>
                                <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm</option>
                                <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Consultation Venue /
                                Room</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="Guidance Counseling Room 1" selected>Guidance Counseling Room 1</option>
                                <option value="Guidance Counseling Room 2">Guidance Counseling Room 2</option>
                                <option value="Peer Facilitation Room">Peer Facilitation Room</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Counseling Type /
                                Modality</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="Individual" selected>Individual One-on-One Session</option>
                                <option value="Crisis">Crisis Intervention / De-escalation</option>
                                <option value="Academic">Academic Intervention Coaching</option>
                                <option value="Career">Career & Placement Advisory</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Pre-Session Context & Student
                                Presenting Concern</label>
                            <textarea class="form-control shadow-none" rows="3"
                                placeholder="Enter session objectives or review points..."
                                style="font-size: 13.5px; border-color: #ced4da;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        Begin Session
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: COUNSELOR SESSION NOTES & REMARKS (CLEAN STRUCTURE)        -->
<!-- ==================================================================== -->

<!-- NOTES MODAL: SES-2026-001 (IN PROGRESS) -->
<div class="modal fade" id="modal-add-notes-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-text" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Session Consultation Notes —
                        SES-2026-001</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <strong class="text-dark d-block">SANTOS, MARIA C. (BSIT)</strong>
                                <span class="text-muted small">Assigned Counselor: Dr. Elena Santos, RGC • Room 1</span>
                            </div>
                            <span class="badge"
                                style="border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 5px 12px; font-size: 12px;">
                                Active Consultation
                            </span>
                        </div>
                    </div>

                    <!-- CLEAN SESSION NOTES STRUCTURE INSTEAD OF SOAP -->
                    <div class="row g-3" style="font-size: 13.5px;">
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">
                                <i class="bi bi-chat-left-text me-1 text-primary"></i>Key Discussion Points & Concerns
                                Raised
                            </label>
                            <textarea class="form-control shadow-none" rows="3"
                                placeholder="Document the student's primary thoughts, stress sources, and recent challenges..."
                                style="font-size: 13px; border-color: #ced4da;">Student reports difficulty sleeping due to impending capstone prototype deadlines and collaborative pressure within her group.</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">
                                <i class="bi bi-eye me-1 text-primary"></i>Observed Student Behavior & Affect
                            </label>
                            <textarea class="form-control shadow-none" rows="2"
                                placeholder="Note demeanor, emotional receptiveness, non-verbal cues..."
                                style="font-size: 13px; border-color: #ced4da;">Appeared nervous and fatigued initially; became receptive and visibly relaxed after discussing task-delegation methods.</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">
                                <i class="bi bi-check2-circle me-1 text-success"></i>Agreed Action Plan & Next Steps
                            </label>
                            <textarea class="form-control shadow-none" rows="3"
                                placeholder="Outline specific action items, commitments, or follow-up milestones..."
                                style="font-size: 13px; border-color: #ced4da;">1. Establish clear division of responsibilities with capstone team.
2. Practice designated sleep schedule and study breaks.
3. Schedule brief follow-up session next week if workload persists.</textarea>
                        </div>
                        <div class="col-12 pt-2 border-top">
                            <label class="form-label text-muted fw-semibold small mb-1">Session Status Update</label>
                            <select class="form-select shadow-none" style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="Ongoing" selected>Keep In Progress (Draft Notes)</option>
                                <option value="Completed">Conclude Session & Finalize Case Record</option>
                                <option value="Follow-Up">Conclude & Flag for Follow-Up Consultation</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        Save Session Notes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: VIEW COMPLETED SESSION SUMMARY & CASE DETAILS              -->
<!-- ==================================================================== -->

<!-- VIEW MODAL 1: SES-2026-001 (ACTIVE) -->
<div class="modal fade" id="modal-view-session-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-medical" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Session Overview — SES-2026-001
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 48px; height: 48px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 17.5px;">SANTOS, MARIA C.
                                </h5>
                                <div class="text-muted" style="font-size: 13px;">
                                    <span class="me-3"><strong>Program:</strong> BSIT</span>
                                    <span><strong>Appointment Ref:</strong> APT-2026-002</span>
                                </div>
                            </div>
                        </div>
                        <span class="badge"
                            style="border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                            In Progress
                        </span>
                    </div>
                </div>

                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Counselor:</span>
                            <strong class="text-dark">Dr. Elena Santos, RGC</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Consultation Room:</span>
                            <strong class="text-dark">Guidance Counseling Room 1</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Schedule & Duration:</span>
                            <strong class="text-dark">October 21, 2026 (02:00 PM - 03:00 PM)</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Concern Category:</span>
                            <span class="badge bg-danger text-white">Emotional / Stress Management</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                    style="font-size: 13px;">Close</button>
                <button type="button" class="btn btn-sm text-white px-3 shadow-none" data-bs-toggle="modal"
                    data-bs-target="#modal-add-notes-001"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                    <i class="bi bi-journal-text me-1"></i>Open Session Notes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- VIEW MODAL 2: SES-2026-002 (UPCOMING) -->
<div class="modal fade" id="modal-view-session-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-medical" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Session Overview — SES-2026-002
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 48px; height: 48px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 17.5px;">RAMOS, CARLOS M.
                                </h5>
                                <div class="text-muted" style="font-size: 13px;">
                                    <span class="me-3"><strong>Program:</strong> BSTM</span>
                                    <span><strong>Appointment Ref:</strong> APT-2026-004</span>
                                </div>
                            </div>
                        </div>
                        <span class="badge"
                            style="border: 1px solid #3182ce; color: #2b6cb0; background-color: #ebf8ff; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                            Upcoming Slot
                        </span>
                    </div>
                </div>

                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Counselor:</span>
                            <strong class="text-dark">Prof. Mark Bautista, RPm</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Consultation Room:</span>
                            <strong class="text-dark">Peer Facilitation Room</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Schedule & Duration:</span>
                            <strong class="text-dark">October 23, 2026 (01:00 PM - 02:00 PM)</strong>
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <span class="text-muted d-block" style="font-size: 12px;">Concern Category:</span>
                            <span class="badge bg-primary text-white">Career Exploration</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                    style="font-size: 13px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- VIEW MODAL 3: SES-2026-003 (COMPLETED) -->
<div class="modal fade" id="modal-view-session-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Concluded Session Record —
                        SES-2026-003</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 48px; height: 48px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 17.5px;">RAMOS, CARLOS M.
                                </h5>
                                <div class="text-muted" style="font-size: 13px;">
                                    <span class="me-3"><strong>Program:</strong> BSTM</span>
                                    <span><strong>Counselor:</strong> Ms. Clarisse Ramos</span>
                                </div>
                            </div>
                        </div>
                        <span class="badge"
                            style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                            Concluded & Signed
                        </span>
                    </div>
                </div>

                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 13.5px;">Session Consultation Summary</h6>
                    <div class="p-3 rounded bg-light border mb-2" style="font-size: 13px; line-height: 1.6;">
                        <p class="mb-2"><strong>Discussion:</strong> Student clarified required prerequisite units and
                            elective course equivalents for hospitality program adjustments.</p>
                        <p class="mb-2"><strong>Observations:</strong> Student arrived prepared with complete academic
                            evaluation forms and exhibited proactive interest.</p>
                        <p class="mb-0"><strong>Agreed Next Steps:</strong> Submitted formal curriculum endorsement slip
                            to College Dean. No further guidance sessions required at this time.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Consultation Slip
                </button>
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                    style="font-size: 13px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- VIEW MODAL 4: SES-2026-004 (COMPLETED) -->
<div class="modal fade" id="modal-view-session-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-check" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Concluded Session Record —
                        SES-2026-004</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width: 48px; height: 48px; border-radius: 50%; background: #FDF2F4; color: #800020; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #800020; font-size: 17.5px;">DELA CRUZ, JUAN L.
                                </h5>
                                <div class="text-muted" style="font-size: 13px;">
                                    <span class="me-3"><strong>Program:</strong> BSIS</span>
                                    <span><strong>Counselor:</strong> Dr. Elena Santos, RGC</span>
                                </div>
                            </div>
                        </div>
                        <span class="badge"
                            style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                            Concluded & Signed
                        </span>
                    </div>
                </div>

                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 13.5px;">Session Consultation Summary</h6>
                    <div class="p-3 rounded bg-light border mb-2" style="font-size: 13px; line-height: 1.6;">
                        <p class="mb-2"><strong>Discussion:</strong> Student shared academic fatigue and test anxiety
                            concerns during laboratory assessments.</p>
                        <p class="mb-2"><strong>Observations:</strong> Calm and receptive demeanor. Responsive to
                            positive study habit recommendations.</p>
                        <p class="mb-0"><strong>Agreed Next Steps:</strong> Coached on time management and connected
                            with academic student mentors for study groups.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Consultation Slip
                </button>
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                    style="font-size: 13px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: QUICK START SESSION (FROM TABLE ACTION)                     -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-conduct-session-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-play-circle-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Begin Consultation</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <p class="text-dark small mb-3">
                        Are you ready to initiate the counseling session for <strong>RAMOS, CARLOS M. (BSTM)</strong>?
                    </p>
                    <div class="p-2.5 rounded bg-light border" style="font-size: 13px;">
                        <div><strong>Counselor:</strong> Prof. Mark Bautista, RPm</div>
                        <div><strong>Venue:</strong> Peer Facilitation Room</div>
                        <div><strong>Topic:</strong> Career Exploration</div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        Confirm & Open Session
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>