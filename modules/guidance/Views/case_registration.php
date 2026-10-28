<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STRUCTURED COUNSELING PLANS          -->
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
                Counseling Plans
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Structured Counseling Plans
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Create and manage structured counseling plans linked to students and cases, with goal progress indicators, intervention tracking, review schedules, and closure summaries.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn text-white shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-create-counseling-plan"
                style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; height: 34px; font-weight: 500; border-radius: 4px; padding: 0 14px;">
                <i class="bi bi-plus-lg me-1.5"></i>Create Plan
            </button>
        </div>
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
                        TOTAL PLANS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">4</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-journal-text"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Total structured counseling plans</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #0D9488 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ACTIVE PLANS
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">2</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #F0FDFA; color: #0D9488; border: 1px solid #CCFBF1;">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Ongoing interventions and goals</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D97706 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        UNDER REVIEW
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FFFBEB; color: #D97706; border: 1px solid #FDE68A;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Scheduled for review & revision</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #16A34A !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        GOALS ATTAINED / CLOSED
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #F0FDF4; color: #16A34A; border: 1px solid #BBF7D0;">
                    <i class="bi bi-check2-all"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Plans with closure summary</div>
        </div>
    </div>
</div>

<!-- SEARCH & FILTERS -->
<div class="card shadow-sm border-0 mb-3" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5 col-12">
                <div class="input-group input-group-sm">
                    <span class="input-group-text border-end-0 text-muted bg-white" style="border-color: #ced4da; font-size: 14px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none"
                        placeholder="Search by Plan #, Student, Case, Counselor, or Concern..."
                        style="font-size: 14px; height: 38px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-3 col-6">
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Plan Statuses</option>
                    <option value="Active">Active</option>
                    <option value="Under Review">Under Review</option>
                    <option value="Revised">Revised</option>
                    <option value="Closed">Closed / Completed</option>
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>All Counselors</option>
                    <option value="Dr. Elena Santos">Dr. Elena Santos, RGC</option>
                    <option value="Prof. Mark Bautista">Prof. Mark Bautista, RPm</option>
                </select>
            </div>
            <div class="col-md-2 col-12 text-end">
                <button type="button" class="btn w-100 shadow-none d-flex align-items-center justify-content-center"
                    style="border: 1px solid #ced4da; background-color: #f8f9fa; color: #495057; font-size: 13.5px; height: 38px; font-weight: 500; border-radius: 4px;">
                    <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- COUNSELING PLANS MASTER LOG TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-3 px-md-4"
        style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-card-checklist me-2" style="color: #D4AF37;"></i>Counseling Plan Registry
        </h6>
        <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600;">
            Showing 4 plans
        </span>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 120px; color: #2D3748;">
                            Plan #
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 190px; color: #2D3748;">
                            Student & Case
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 170px; color: #2D3748;">
                            Assigned Counselor
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 180px; color: #2D3748;">
                            Presenting Concern
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 170px; color: #2D3748;">
                            Counseling Goals
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 120px; color: #2D3748;">
                            Target Date
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 120px; color: #2D3748;">
                            Status
                        </th>
                        <th class="text-center pe-3 pe-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 200px; color: #2D3748;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Row 1: Ramos (CPL-2026-001) -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">
                            CPL-2026-001
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">RAMOS, CARLOS M.</div>
                            <span class="text-muted small">ID: 2026-01201 &bull; Case: CAS-2026-001</span>
                        </td>
                        <td style="padding: 14px 16px;" class="text-secondary">
                            Dr. Elena M. Santos, RGC
                        </td>
                        <td style="padding: 14px 16px;" class="text-dark">
                            <span class="badge" style="background-color: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; font-size: 12px;">Academic Anxiety</span>
                            <div class="small text-muted mt-1">Difficulty passing mid-term exams</div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Goal 1: Stress Coping Routine</div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"></div>
                            </div>
                            <span class="text-muted" style="font-size: 11px;">75% Progress Indicator</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">
                            2026-05-15
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="border: 1px solid #0D9488; background-color: #F0FDFA; color: #0F766E; border-radius: 4px; font-weight: 600; font-size: 12.5px; padding: 4px 8px;">
                                Active
                            </span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-plan-001"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-revise-plan-001"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Revise
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Santos (CPL-2026-002) -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">
                            CPL-2026-002
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">SANTOS, MARIA C.</div>
                            <span class="text-muted small">ID: 2026-01202 &bull; Case: CAS-2026-002</span>
                        </td>
                        <td style="padding: 14px 16px;" class="text-secondary">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td style="padding: 14px 16px;" class="text-dark">
                            <span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 12px;">Career Indecision</span>
                            <div class="small text-muted mt-1">Specialization track conflict</div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Goal 1: Career Pathway Selection</div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 60%;"></div>
                            </div>
                            <span class="text-muted" style="font-size: 11px;">60% Progress Indicator</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">
                            2026-04-30
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="border: 1px solid #0D9488; background-color: #F0FDFA; color: #0F766E; border-radius: 4px; font-weight: 600; font-size: 12.5px; padding: 4px 8px;">
                                Active
                            </span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-plan-002"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-revise-plan-002"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Revise
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Dela Cruz (CPL-2026-003) -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">
                            CPL-2026-003
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">DELA CRUZ, JUAN L.</div>
                            <span class="text-muted small">ID: 2026-01203 &bull; Case: CAS-2026-003</span>
                        </td>
                        <td style="padding: 14px 16px;" class="text-secondary">
                            Dr. Elena M. Santos, RGC
                        </td>
                        <td style="padding: 14px 16px;" class="text-dark">
                            <span class="badge" style="background-color: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; font-size: 12px;">Attendance / Truancy</span>
                            <div class="small text-muted mt-1">Repeated unexcused morning absences</div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Goal 1: Attendance Agreement (95%)</div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;"></div>
                            </div>
                            <span class="text-muted" style="font-size: 11px;">40% Progress Indicator</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">
                            2026-04-10
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="border: 1px solid #D97706; background-color: #FFFBEB; color: #B45309; border-radius: 4px; font-weight: 600; font-size: 12.5px; padding: 4px 8px;">
                                Under Review
                            </span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-plan-003"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-revise-plan-003"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Revise
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Alvarez (CPL-2026-004) -->
                    <tr>
                        <td class="ps-4 fw-semibold" style="padding: 14px 16px; color: #800020;">
                            CPL-2026-004
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="fw-bold text-dark">ALVAREZ, BEA P.</div>
                            <span class="text-muted small">ID: 2026-01204 &bull; Case: CAS-2026-004</span>
                        </td>
                        <td style="padding: 14px 16px;" class="text-secondary">
                            Prof. Mark Bautista, RPm
                        </td>
                        <td style="padding: 14px 16px;" class="text-dark">
                            <span class="badge" style="background-color: #FAF5FF; color: #6B21A8; border: 1px solid #E9D5FF; font-size: 12px;">Peer Relationship</span>
                            <div class="small text-muted mt-1">Interpersonal classroom dispute</div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div class="text-dark small fw-medium">Goal 1: Restorative Dialogue Completed</div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"></div>
                            </div>
                            <span class="text-muted" style="font-size: 11px;">100% Progress Indicator</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px; color: #4A5568;">
                            2026-03-20
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="border: 1px solid #16A34A; background-color: #F0FDF4; color: #15803D; border-radius: 4px; font-weight: 600; font-size: 12.5px; padding: 4px 8px;">
                                Closed / Completed
                            </span>
                        </td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-plan-004"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-closure-summary-004"
                                    style="border: 1px solid #16A34A; color: #15803D; background-color: #F0FDF4; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-file-check me-1.5"></i>Closure
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
<!--   MODAL: VIEW STRUCTURED COUNSELING PLAN (CPL-2026-001)              -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-plan-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-check text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Structured Counseling Plan: CPL-2026-001
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <!-- 1. HEADER PROFILE & PARTICULARS -->
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="row g-3" style="font-size: 13.5px;">
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Plan Number:</span>
                            <span class="fw-bold" style="color: #800020;">CPL-2026-001</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Student:</span>
                            <span class="fw-bold text-dark">RAMOS, CARLOS M. (2026-01201)</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Linked Case:</span>
                            <span class="fw-semibold text-dark">CAS-2026-001 (Academic Anxiety)</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Assigned Counselor:</span>
                            <span class="fw-semibold text-dark">Dr. Elena M. Santos, RGC</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Date Created:</span>
                            <span class="fw-semibold text-dark">2026-02-15</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Target Date:</span>
                            <span class="fw-semibold text-dark">2026-05-15</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Review Schedule:</span>
                            <span class="fw-semibold text-dark">Bi-weekly (Tuesdays, 10:00 AM)</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="text-muted small d-block">Plan Status:</span>
                            <span class="badge" style="background-color: #F0FDFA; color: #0F766E; border: 1px solid #99F6E4; font-size: 12px;">Active (Rev 1)</span>
                        </div>
                    </div>
                </div>

                <!-- 2. PRESENTING CONCERN, INTERVENTIONS & OUTCOMES -->
                <div class="card mb-3 border bg-white" style="border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom fw-bold text-dark" style="font-size: 14.5px; background-color: #ffffff;">
                        <i class="bi bi-clipboard-pulse me-1.5 text-primary"></i>Presenting Concern, Planned Interventions & Expected Outcomes
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="row g-3">
                            <div class="col-12">
                                <span class="text-muted small d-block fw-semibold">Presenting Concern:</span>
                                <div class="p-2.5 rounded bg-light border text-dark mt-1">
                                    Student experiences debilitating performance anxiety during computer laboratory examinations, resulting in unsubmitted assessments and risk of subject deficiency.
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="text-muted small d-block fw-semibold">Planned Interventions:</span>
                                <div class="p-2.5 rounded bg-light border text-dark mt-1">
                                    &bull; Cognitive restructuring on exam performance fears.<br>
                                    &bull; Daily time-blocked study schedule with 2-hour lab practice.<br>
                                    &bull; Relaxation training and guided breathing prior to lab sessions.
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="text-muted small d-block fw-semibold">Expected Outcomes:</span>
                                <div class="p-2.5 rounded bg-light border text-dark mt-1">
                                    &bull; Student completes 100% of laboratory activities on time.<br>
                                    &bull; Self-reported exam stress drops from 8/10 to below 4/10.<br>
                                    &bull; Attainment of minimum passing grade in BSIS major subjects.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. DETAILED COUNSELING GOALS BREAKDOWN -->
                <div class="card mb-3 border bg-white" style="border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark" style="font-size: 14.5px;">
                            <i class="bi bi-bullseye me-1.5 text-danger"></i>Structured Counseling Goals
                        </span>
                        <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px;">Goal 1: 75% Completed</span>
                    </div>
                    <div class="card-body p-3" style="font-size: 13.5px;">
                        <div class="table-responsive" style="background-color: #ffffff;">
                            <table class="table table-bordered align-middle mb-0" style="font-size: 13px; background-color: #ffffff;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Goal Description</th>
                                        <th>Planned Action</th>
                                        <th>Progress Indicator</th>
                                        <th>Responsible Person</th>
                                        <th>Target Date</th>
                                        <th>Completion Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark">1. Exam Stress Reduction</td>
                                        <td>Practice 10-minute progressive muscle relaxation before exams</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 80%;"></div>
                                            </div>
                                            <span class="small text-muted">80% Achieved</span>
                                        </td>
                                        <td>Student</td>
                                        <td>2026-04-15</td>
                                        <td><span class="badge bg-success">In Progress</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">2. Study Discipline Contract</td>
                                        <td>Weekly time-tracking log submitted every Monday</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 70%;"></div>
                                            </div>
                                            <span class="small text-muted">70% Achieved</span>
                                        </td>
                                        <td>Student & Counselor</td>
                                        <td>2026-05-01</td>
                                        <td><span class="badge bg-success">In Progress</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 p-2.5 bg-light rounded border">
                            <span class="fw-bold text-dark small d-block mb-1">Progress Notes:</span>
                            <span class="small text-muted">Session #2 conducted on March 18: Student demonstrated proper breathing cadence and confirmed submitting 2 out of 2 lab projects on time.</span>
                        </div>
                    </div>
                </div>

                <!-- 4. PLAN REVISIONS & REVIEW HISTORY -->
                <div class="card border bg-white" style="border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom fw-bold text-dark" style="font-size: 14.5px; background-color: #ffffff;">
                        <i class="bi bi-clock-history me-1.5 text-warning"></i>Plan Revisions & Review History
                    </div>
                    <div class="card-body p-3" style="font-size: 13px;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold text-dark">Revision 1 (2026-03-05):</span>
                                    <span class="text-muted ms-2">Added relaxation exercises after mid-term schedule adjustment.</span>
                                </div>
                                <span class="badge bg-secondary">Reviewed by Counselor</span>
                            </li>
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold text-dark">Original Plan Formulated (2026-02-15):</span>
                                    <span class="text-muted ms-2">Initial baseline plan created following student referral.</span>
                                </div>
                                <span class="badge bg-secondary">Formulation</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: VIEW PLAN 002, 003, 004                                     -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-plan-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Plan: CPL-2026-002 (SANTOS, MARIA C.)</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">Career Guidance & Specialization Track Plan</h6>
                <p class="text-muted small">Case: CAS-2026-002 &bull; Assigned Counselor: Prof. Mark Bautista, RPm &bull; Target: 2026-04-30</p>
                <div class="p-3 bg-white border rounded">
                    <strong>Presenting Concern:</strong> Uncertainty in career track specialization.<br>
                    <strong>Goal:</strong> Complete career assessment and map internship pathway (60% attained).<br>
                    <strong>Planned Intervention:</strong> RIASEC interest alignment and alumni interview.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-plan-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Plan: CPL-2026-003 (DELA CRUZ, JUAN L.)</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">Attendance Accountability Contract</h6>
                <p class="text-muted small">Case: CAS-2026-003 &bull; Assigned Counselor: Dr. Elena Santos &bull; Target: 2026-04-10</p>
                <div class="p-3 bg-white border rounded">
                    <strong>Presenting Concern:</strong> Habitual tardiness and unexcused absences.<br>
                    <strong>Goal:</strong> Achieve 95% attendance across all subjects (40% attained).<br>
                    <strong>Planned Intervention:</strong> Daily check-in log and parent conference.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-plan-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Plan: CPL-2026-004 (ALVAREZ, BEA P.)</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <h6 class="fw-bold text-dark">Restorative Peer Mediation Plan (Completed)</h6>
                <p class="text-muted small">Case: CAS-2026-004 &bull; Assigned Counselor: Prof. Mark Bautista &bull; Concluded: 2026-03-20</p>
                <div class="p-3 bg-white border rounded">
                    <strong>Presenting Concern:</strong> Classroom interpersonal conflict.<br>
                    <strong>Goal:</strong> Conduct restorative dialogue and re-establish productive group work (100% Achieved).
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: CLOSURE SUMMARY MODAL (CPL-2026-004)                        -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-closure-summary-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #16A34A;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-check-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Plan Closure Summary: CPL-2026-004
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold text-dark mb-0">ALVAREZ, BEA P. (2026-01204)</h6>
                            <span class="text-muted small">Plan Number: CPL-2026-004 &bull; Case: CAS-2026-004</span>
                        </div>
                        <span class="badge bg-success">Status: Successfully Closed</span>
                    </div>
                </div>

                <div class="card p-3 bg-white border mb-3" style="border-radius: 8px; font-size: 13.5px;">
                    <span class="fw-bold text-dark d-block mb-1">Closure Rationale & Outcome Summary:</span>
                    <p class="text-muted mb-2">
                        All counseling goals formulated under CPL-2026-004 have been fully accomplished. Restorative peer mediation resolved the conflict with classmates. Both parties signed a mutual respect agreement and resumed active collaboration in classroom projects.
                    </p>
                    <div class="row g-2 mt-1">
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Closing Counselor:</span>
                            <span class="fw-semibold text-dark">Prof. Mark Bautista, RPm</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Closure Date:</span>
                            <span class="fw-semibold text-dark">March 20, 2026</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: REVISE PLAN MODAL (CPL-2026-001)                            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-revise-plan-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Plan Revision & Review: CPL-2026-001
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Plan Reference</label>
                            <input type="text" class="form-control bg-light shadow-none" value="CPL-2026-001" readonly
                                style="border-color: #ced4da; font-weight: 600; color: #800020;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Plan Status <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="border-color: #ced4da; font-size: 14px;">
                                <option value="Active" selected>Active</option>
                                <option value="Under Review">Under Review</option>
                                <option value="Revised">Revised (Create New Revision)</option>
                                <option value="Closed">Closed / Completed</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Goal Progress Indicator <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="border-color: #ced4da; font-size: 14px;">
                                <option value="25%">25% - Initial commitments started</option>
                                <option value="50%">50% - Halfway progress confirmed</option>
                                <option value="75%" selected>75% - Substantial goal attainment</option>
                                <option value="100%">100% - Fully completed</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Next Review Schedule <span class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" value="2026-04-07" required style="border-color: #ced4da; font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Revision Rationale & Progress Notes <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="3" required placeholder="Describe adjustments to interventions, goals, or scheduling..."
                                style="border-color: #ced4da; font-size: 14px;">Progress review indicates student successfully managed laboratory practical examinations. Maintaining bi-weekly schedule for ongoing support.</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                        <i class="bi bi-save me-1.5"></i>Save Revision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-revise-plan-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Update Plan: CPL-2026-002</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted">Update progress for Maria Santos career guidance plan.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-revise-plan-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Update Plan: CPL-2026-003</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted">Update attendance contract progress for Juan Dela Cruz.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: CREATE NEW COUNSELING PLAN                                  -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-create-counseling-plan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Create Structured Counseling Plan</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Plan Number</label>
                            <input type="text" class="form-control bg-light shadow-none" value="CPL-2026-005" readonly
                                style="font-size: 14px; font-weight: 600; color: #800020; border-color: #ced4da;">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Student <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. RAMOS, CARLOS M. (2026-01201)" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Linked Case <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. CAS-2026-001" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Assigned Counselor <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px; border-color: #ced4da;">
                                <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC</option>
                                <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Date Created <span class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" value="2026-03-24" required
                                style="font-size: 14px; border-color: #ced4da;">
                        </div>

                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Presenting Concern <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Describe the presenting emotional, academic, or behavioral concern..." required
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Planned Interventions <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Specific counseling techniques, contracts, or modalities..." required
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Expected Outcomes <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Measurable outcomes and behavior changes expected..." required
                                style="font-size: 14px; border-color: #ced4da;"></textarea>
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Target Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" required style="font-size: 14px; border-color: #ced4da;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Review Schedule <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px; border-color: #ced4da;">
                                <option value="Weekly">Weekly Review</option>
                                <option value="Bi-weekly" selected>Bi-weekly Review</option>
                                <option value="Monthly">Monthly Review</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                        <i class="bi bi-save me-1.5"></i>Save Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>