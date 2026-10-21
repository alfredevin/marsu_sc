<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STUDENT CONCERNS INTAKE & LOGS       -->
<!--   FILE LOCATION: views/guidance/student_concerns.php                 -->
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
                Student Concerns
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 20px; letter-spacing: -0.2px;">
                Student Concern Submissions & Case Log
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.5;">
                Log student inquiries, review intake notes, evaluate urgency, and assign cases directly to counselors.
            </p>
        </div>
        <button type="button" class="btn text-white px-3 shadow-none d-flex align-items-center" data-bs-toggle="modal"
            data-bs-target="#modal-log-concern"
            style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; border-radius: 6px; height: 38px;">
            <i class="bi bi-plus-circle me-1.5"></i>Log New Concern
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
                        TOTAL CONCERNS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">4
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-chat-square-text-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Documented intake records</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #c53030 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        HIGH URGENCY
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #fff5f5; color: #c53030; border: 1px solid #feb2b2;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Immediate attention needed</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D4A017 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        PENDING EVALUATION
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FEFCF0; color: #B7791F; border: 1px solid #F6E05E;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Awaiting counselor assignment</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #2e7d32 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ASSIGNED CASES
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">2
                    </div>
                </div>
                <div
                    style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9;">
                    <i class="bi bi-person-check-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Assigned to counselors</div>
        </div>
    </div>
</div>

<!-- STUDENT CONCERNS INTAKE DIRECTORY TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #EBE4E4 !important; border-radius: 10px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #EBE4E4;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-card-checklist me-2" style="color: #D4A017;"></i>Student Intake Records & Concern Directory
        </h6>

        <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="input-group input-group-sm" style="width: 250px;">
                <span class="input-group-text border-end-0 text-muted"
                    style="background-color: #ffffff; border-color: #ced4da; font-size: 13.5px;">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 shadow-none"
                    placeholder="Search case, student, or topic..."
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
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 120px; color: #2D3748;">
                            Case ID</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 170px; color: #2D3748;">
                            Student Name</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 90px; color: #2D3748;">
                            Program</th>
                        <th
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 200px; color: #2D3748;">
                            Concern Description</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 110px; color: #2D3748;">
                            Priority</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; width: 130px; color: #2D3748;">
                            Intake Status</th>
                        <th class="text-center"
                            style="font-size: 13.5px; font-weight: 600; padding: 10px 12px; min-width: 175px; color: #2D3748;">
                            Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13.5px;">
                    <!-- Row 1: Academic Concern -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">CON-2026-001
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">DELA CRUZ, JUAN L.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIS</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Academic Performance</strong><br>
                            <span class="text-muted small">C Programming Coursework Overload</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 85px; border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 4px 0; font-size: 11.5px; font-weight: 500;">Medium</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 115px; border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Under
                                Review</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <!-- GAP-2 AT BALANSENG PADDING PARA HINDI MAGDIKIT ANG BUTTONS -->
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-review-con-001"
                                    style="min-width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>Review
                                </button>
                                <button type="button" class="btn btn-sm text-white shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-assign-con-001"
                                    style="min-width: 74px; background-color: #800020; border: 1px solid #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-person-plus me-1"></i>Assign
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Stress Management -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">CON-2026-002
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">SANTOS, MARIA C.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSIT</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Emotional / Stress</strong><br>
                            <span class="text-muted small">Capstone Milestone Anxiety</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 85px; border: 1px solid #e53e3e; color: #9b2c2c; background-color: #fff5f5; border-radius: 50rem; padding: 4px 0; font-size: 11.5px; font-weight: 500;">High</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 115px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Assigned</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-review-con-002"
                                    style="min-width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>Review
                                </button>
                                <button type="button" class="btn btn-sm text-secondary shadow-none border" disabled
                                    style="min-width: 74px; background-color: #f8f9fa; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    Assigned
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Career Guidance -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">CON-2026-003
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Career Exploration</strong><br>
                            <span class="text-muted small">Internship & Industry Placement</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 85px; border: 1px solid #3182ce; color: #2b6cb0; background-color: #ebf8ff; border-radius: 50rem; padding: 4px 0; font-size: 11.5px; font-weight: 500;">Normal</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 115px; border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Assigned</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-review-con-003"
                                    style="min-width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>Review
                                </button>
                                <button type="button" class="btn btn-sm text-secondary shadow-none border" disabled
                                    style="min-width: 74px; background-color: #f8f9fa; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    Assigned
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Program Evaluation -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 10px 12px; color: #800020;">CON-2026-004
                        </td>
                        <td class="fw-semibold" style="padding: 10px 12px; color: #2D3748;">RAMOS, CARLOS M.</td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center"
                                style="width: 70px; border: 1px solid #dcdcdc; border-radius: 4px; padding: 2px 0; background: #fafafa; font-size: 12.5px; color: #333; font-weight: 500;">BSTM</span>
                        </td>
                        <td style="padding: 10px 12px;" class="text-dark">
                            <strong>Program Selection</strong><br>
                            <span class="text-muted small">Course Shifting Assessment</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 85px; border: 1px solid #718096; color: #4A5568; background-color: #f7fafc; border-radius: 50rem; padding: 4px 0; font-size: 11.5px; font-weight: 500;">Low</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <span class="d-inline-block text-center badge"
                                style="width: 115px; border: 1px solid #718096; color: #4A5568; background-color: #f8f9fa; border-radius: 50rem; padding: 5px 0; font-size: 12px; font-weight: 500;">Resolved</span>
                        </td>
                        <td class="text-center" style="padding: 10px 12px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="modal"
                                    data-bs-target="#modal-review-con-004"
                                    style="min-width: 72px; border: 1px solid #800020; color: #800020; border-radius: 4px; padding: 3px 8px; font-size: 12.5px; font-weight: 500;">
                                    <i class="bi bi-eye me-1"></i>Review
                                </button>
                                <button type="button" class="btn btn-sm text-muted shadow-none border" disabled
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
<!--   MODAL: LOG NEW STUDENT CONCERN                                     -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-log-concern" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Log New Student Concern</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="row g-3" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Student Full Name</label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. DELA CRUZ, JUAN L."
                                required style="font-size: 13.5px; border-color: #ced4da;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Academic Program</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="" selected disabled>Select program...</option>
                                <option value="BSIS">BSIS (Information Systems)</option>
                                <option value="BSIT">BSIT (Information Technology)</option>
                                <option value="BSEMC">BSEMC (Entertainment & Multimedia)</option>
                                <option value="BSTM">BSTM (Tourism Management)</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Concern Category</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="" selected disabled>Choose classification...</option>
                                <option value="Academic">Academic / Performance</option>
                                <option value="Emotional">Emotional / Stress Management</option>
                                <option value="Career">Career & Placement</option>
                                <option value="Personal">Personal / Family Guidance</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Urgency Priority</label>
                            <select class="form-select shadow-none" required
                                style="font-size: 13.5px; border-color: #ced4da;">
                                <option value="Low">Low - Informational inquiry</option>
                                <option value="Normal" selected>Normal - Within this academic week</option>
                                <option value="Medium">Medium - Prompt response (24-48 hours)</option>
                                <option value="High">High - Critical intervention required</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold small mb-1">Intake Narrative & Observation
                                Summary</label>
                            <textarea class="form-control shadow-none" rows="4"
                                placeholder="Detail the student's initial report, relevant academic constraints, emotional cues, or specific guidance requests..."
                                required style="font-size: 13.5px; border-color: #ced4da;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">Save Concern
                        Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: REVIEW INTAKE DETAILS                                      -->
<!-- ==================================================================== -->

<!-- REVIEW MODAL 1: CON-2026-001 -->
<div class="modal fade" id="modal-review-con-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Student Intake Review —
                        CON-2026-001</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
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
                                    <span class="me-3"><strong>Program:</strong> BSIS (Year 2)</span>
                                    <span><strong>Date Filed:</strong> October 20, 2026</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="badge"
                                style="border: 1px solid #d4a017; color: #975a16; background-color: #fefcbf; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                                Under Review
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-clipboard2-pulse-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Intake Evaluation
                            & Categorization</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Concern Type:</span>
                            <strong class="text-dark">Academic / Performance Concerns</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Priority:</span>
                            <span class="badge bg-warning text-dark border">Medium Priority</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Student Statement /
                                Narrative:</span>
                            <p class="text-dark mb-0 mt-1" style="line-height: 1.5;">
                                "I have been experiencing extreme difficulty keeping up with introductory programming
                                assignments, particularly recursive algorithms and array trace logic. It has begun
                                causing severe anxiety during laboratory exams and affecting my other major subjects."
                            </p>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Intake Counselor
                                Assessment:</span>
                            <p class="text-muted mb-0 mt-1" style="line-height: 1.5;">
                                Student shows clear signs of academic fatigue. Recommended for habit coaching and
                                counselor session assignment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm shadow-none"
                    style="border: 1px solid #ced4da; font-size: 13px; color: #4A5568;">
                    <i class="bi bi-printer me-1"></i>Print Slip
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Close</button>
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none" data-bs-toggle="modal"
                        data-bs-target="#modal-assign-con-001"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        <i class="bi bi-person-plus me-1"></i>Assign to Counselor
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- REVIEW MODAL 2: CON-2026-002 -->
<div class="modal fade" id="modal-review-con-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Student Intake Review —
                        CON-2026-002</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
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
                                    <span class="me-3"><strong>Program:</strong> BSIT (Year 4)</span>
                                    <span><strong>Date Filed:</strong> October 19, 2026</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="badge"
                                style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                                Assigned
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-clipboard2-pulse-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Intake Evaluation
                            & Categorization</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Concern Type:</span>
                            <strong class="text-dark">Emotional / Stress Management</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Priority:</span>
                            <span class="badge bg-danger text-white border">High Priority</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Student Statement /
                                Narrative:</span>
                            <p class="text-dark mb-0 mt-1" style="line-height: 1.5;">
                                "Experiencing chronic burnout and panic episodes ahead of our Capstone 2 prototype
                                defense. Struggling to balance project deadlines with sleep and personal health."
                            </p>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Intake Counselor
                                Assessment:</span>
                            <p class="text-muted mb-0 mt-1" style="line-height: 1.5;">
                                Assigned directly to Dr. Elena Santos, RGC. Appointment slot confirmed on October 21,
                                2026.
                            </p>
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

<!-- REVIEW MODAL 3: CON-2026-003 -->
<div class="modal fade" id="modal-review-con-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Student Intake Review —
                        CON-2026-003</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
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
                                    <span class="me-3"><strong>Program:</strong> BSTM (Year 3)</span>
                                    <span><strong>Date Filed:</strong> October 18, 2026</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="badge"
                                style="border: 1px solid #2e7d32; color: #1b5e20; background-color: #e8f5e9; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                                Assigned
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-clipboard2-pulse-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Intake Evaluation
                            & Categorization</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Concern Type:</span>
                            <strong class="text-dark">Career Exploration</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Priority:</span>
                            <span class="badge bg-primary text-white border">Normal Priority</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Student Statement /
                                Narrative:</span>
                            <p class="text-dark mb-0 mt-1" style="line-height: 1.5;">
                                "Seeking advice on required certifications and practicum placements in airline vs. hotel
                                hospitality sectors within the MIMAROPA region."
                            </p>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Intake Counselor
                                Assessment:</span>
                            <p class="text-muted mb-0 mt-1" style="line-height: 1.5;">
                                Routine career coaching requested. Assigned to Prof. Mark Bautista, RPm for appointment
                                schedule.
                            </p>
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

<!-- REVIEW MODAL 4: CON-2026-004 -->
<div class="modal fade" id="modal-review-con-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person" style="color: #D4A017; font-size: 17px;"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Student Intake Review —
                        CON-2026-004</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                <div class="card p-3 mb-3 shadow-none"
                    style="background-color: #ffffff; border: 1px solid #EBE4E4 !important; border-radius: 8px;">
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
                                    <span class="me-3"><strong>Program:</strong> BSTM (Year 3)</span>
                                    <span><strong>Date Filed:</strong> October 12, 2026</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="badge"
                                style="border: 1px solid #718096; color: #4A5568; background-color: #f8f9fa; border-radius: 50rem; padding: 6px 14px; font-weight: 500; font-size: 12px;">
                                Resolved & Closed
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3 shadow-none"
                    style="border-radius: 8px; border: 1px solid #EBE4E4 !important; background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="bi bi-clipboard2-pulse-fill" style="color: #800020; font-size: 15px;"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 13px; color: #2D3748;">Intake Evaluation
                            & Categorization</span>
                    </div>
                    <div class="row g-2" style="font-size: 13.5px;">
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Concern Type:</span>
                            <strong class="text-dark">Program Selection / Shifting</strong>
                        </div>
                        <div class="col-md-6 col-12">
                            <span class="text-muted d-block" style="font-size: 12px;">Assigned Priority:</span>
                            <span class="badge bg-secondary text-white border">Low Priority</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Student Statement /
                                Narrative:</span>
                            <p class="text-dark mb-0 mt-1" style="line-height: 1.5;">
                                "Requesting clarification on prerequisite credits if applying to transfer elective
                                units."
                            </p>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-muted d-block" style="font-size: 12px;">Intake Counselor
                                Assessment:</span>
                            <p class="text-muted mb-0 mt-1" style="line-height: 1.5;">
                                Guidance session concluded on October 16, 2026 with Ms. Clarisse Ramos. Record finalized
                                and closed.
                            </p>
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

<!-- ==================================================================== -->
<!--   MODAL: ASSIGN CONCERN TO COUNSELOR                                 -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-assign-con-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-2.5" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-plus text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Assign Case to Counselor</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <div class="alert alert-light border p-2.5 mb-3 d-flex align-items-center gap-2"
                        style="font-size: 13px;">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <span>Assigning <strong>CON-2026-001</strong> will route this case for direct appointment
                            slotting.</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Student</label>
                        <input type="text" class="form-control bg-light shadow-none" value="DELA CRUZ, JUAN L. (BSIS)"
                            readonly style="font-size: 13.5px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold small mb-1">Assigned Counselor</label>
                        <select class="form-select shadow-none" required
                            style="font-size: 13.5px; border-color: #ced4da;">
                            <option value="" selected disabled>Select counselor...</option>
                            <option value="Dr. Elena Santos, RGC">Dr. Elena Santos, RGC (Head Counselor)</option>
                            <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm (Psychometrician)</option>
                            <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos (Academic Counselor)</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold small mb-1">Assignment Remarks / Notes</label>
                        <textarea class="form-control shadow-none" rows="3"
                            placeholder="Add specific guidance goals, session preferences, or urgent remarks..."
                            style="font-size: 13px; border-color: #ced4da;"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13px;">
                        Confirm Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>