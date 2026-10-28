<!-- ==================================================================== -->
<!--   MARINDUQUE STATE UNIVERSITY - GUIDANCE & COUNSELING SERVICES       -->
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
                Student Referral Management
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 py-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Student Referral Management
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Manage student self-referrals, faculty endorsements, and external agency referrals in compliance with RA 10173 and RA 9258.
            </p>
        </div>
        <!-- QUICK ACTION DROPDOWN -->
        <div class="dropdown">
            <button class="btn text-white px-3 shadow-none dropdown-toggle d-flex align-items-center" type="button"
                data-bs-toggle="dropdown"
                style="background-color: #800020; border: 1px solid #800020; font-size: 15px; border-radius: 6px; height: 38px;">
                <i class="bi bi-plus-lg me-1.5"></i>Create Referral
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="font-size: 14.5px; border-radius: 8px; min-width: 285px;">
                <li>
                    <a class="dropdown-item py-2.5 px-3 rounded mb-1" href="#" data-bs-toggle="modal" data-bs-target="#modal-create-self-referral">
                        <i class="bi bi-person-heart me-2 text-success"></i>Student Self-Referral (Walk-In)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2.5 px-3 rounded mb-1" href="#" data-bs-toggle="modal" data-bs-target="#modal-create-internal-referral">
                        <i class="bi bi-person-up me-2 text-primary"></i>Faculty Internal Referral Form
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2.5 px-3 rounded mb-1" href="#" data-bs-toggle="modal" data-bs-target="#modal-create-external-referral">
                        <i class="bi bi-box-arrow-up-right me-2 text-danger"></i>External Agency Referral Form
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- 4 KPI SUMMARY CARDS -->
<div class="row g-3.5 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL REFERRALS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">5</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14.5px; color: #718096;">Total documented referral cases</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        SELF-REFERRALS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">1</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                    <i class="bi bi-person-check-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14.5px; color: #718096;">Student voluntary walk-ins</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #3182ce !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        FACULTY REFERRALS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">2</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #ebf8ff; color: #3182ce; border: 1px solid #bee3f8;">
                    <i class="bi bi-person-workspace"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14.5px; color: #718096;">Endorsed by faculty & advisers</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #c53030 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        EXTERNAL REFERRALS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">2</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fff5f5; color: #c53030; border: 1px solid #feb2b2;">
                    <i class="bi bi-box-arrow-up-right"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14.5px; color: #718096;">Specialized agency partnerships</div>
        </div>
    </div>
</div>

<!-- SEARCH & FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-3.5 px-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-5 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white" style="border-color: #ced4da; font-size: 15px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="referralSearchInput" class="form-control border-start-0 shadow-none"
                        placeholder="Search by Referral No., Full Name, Program, or Origin..."
                        style="font-size: 15px; height: 40px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-12">
                <select id="referralTypeFilter" class="form-select shadow-none" style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>All Referral Types</option>
                    <option value="Self-Referral">Self-Referral (Walk-In)</option>
                    <option value="Faculty Referral">Faculty Referral (Internal)</option>
                    <option value="External Referral">External Referral (Agency)</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-4 col-12">
                <select id="referralUrgencyFilter" class="form-select shadow-none" style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>All Urgency</option>
                    <option value="Emergency">Emergency</option>
                    <option value="Urgent">Urgent (24-72h)</option>
                    <option value="Routine">Routine</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-4 col-12">
                <select id="referralStatusFilter" class="form-select shadow-none" style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>All Statuses</option>
                    <option value="Pending Intake">Pending Intake</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Endorsed">Endorsed</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- REFERRALS TABBED MASTER TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <!-- CARD HEADER WITH MASTER TITLE AT TOP & TABS BELOW -->
    <div class="card-header bg-white pt-4 px-4 pb-3" style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h6 class="m-0 fw-bold d-flex align-items-center gap-2" style="font-size: 17px; color: #800020;">
                    <i class="bi bi-folder2-open" style="color: #D4AF37; font-size: 20px;"></i>
                    Master Referral Directory
                </h6>
                <div class="text-muted mt-1" style="font-size: 14px;">
                    Comprehensive master log of student referrals categorized by pathway and endorsement origin.
                </div>
            </div>
            <span class="badge text-dark bg-light border px-3 py-2" style="font-size: 13.5px; font-weight: 500;">
                Showing 5 Total Referral Cases
            </span>
        </div>
        <div class="nav nav-pills gap-3 flex-wrap" id="referralTabs" role="tablist">
            <button class="ref-nav-pill active" id="all-tab" data-bs-toggle="pill" data-bs-target="#tab-all" type="button" role="tab"
                style="border: 1px solid #800020; background-color: #800020; color: #ffffff; box-shadow: 0 2px 6px rgba(128, 0, 32, 0.25); border-radius: 6px; padding: 10px 20px; font-size: 14.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; text-decoration: none; cursor: pointer;">
                <i class="bi bi-collection"></i>
                <span>All Referrals</span>
                <span class="badge ms-1" style="background-color: rgba(255, 255, 255, 0.25); color: #ffffff; border: none; font-size: 13px;">5</span>
            </button>
            <button class="ref-nav-pill" id="self-tab" data-bs-toggle="pill" data-bs-target="#tab-self" type="button" role="tab"
                style="border: 1px solid #E2E8F0; background-color: #F8FAFC; color: #4A5568; border-radius: 6px; padding: 10px 20px; font-size: 14.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; text-decoration: none; cursor: pointer;">
                <i class="bi bi-person-walking text-success"></i>
                <span>Self-Referrals (Walk-In)</span>
                <span class="badge bg-success-subtle text-success ms-1" style="font-size: 13px;">1</span>
            </button>
            <button class="ref-nav-pill" id="internal-tab" data-bs-toggle="pill" data-bs-target="#tab-internal" type="button" role="tab"
                style="border: 1px solid #E2E8F0; background-color: #F8FAFC; color: #4A5568; border-radius: 6px; padding: 10px 20px; font-size: 14.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; text-decoration: none; cursor: pointer;">
                <i class="bi bi-person-workspace text-primary"></i>
                <span>Faculty Referrals (Internal)</span>
                <span class="badge bg-primary-subtle text-primary ms-1" style="font-size: 13px;">2</span>
            </button>
            <button class="ref-nav-pill" id="external-tab" data-bs-toggle="pill" data-bs-target="#tab-external" type="button" role="tab"
                style="border: 1px solid #E2E8F0; background-color: #F8FAFC; color: #4A5568; border-radius: 6px; padding: 10px 20px; font-size: 14.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; text-decoration: none; cursor: pointer;">
                <i class="bi bi-box-arrow-up-right text-danger"></i>
                <span>External Referrals (Agencies)</span>
                <span class="badge bg-danger-subtle text-danger ms-1" style="font-size: 13px;">2</span>
            </button>
        </div>
    </div>

    <!-- TAB CONTENTS -->
    <div class="tab-content" id="referralTabsContent">

        <!-- ==================== TAB 1: ALL REFERRALS ==================== -->
        <div class="tab-pane fade show active" id="tab-all" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center py-3.5 px-4 bg-light border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-list-check" style="color: #800020; font-size: 17px;"></i>
                    <span class="fw-semibold text-dark" style="font-size: 15px;">All Registered Student Referrals</span>
                </div>
                <span class="badge bg-white text-secondary border px-3 py-1.5" style="font-size: 13px; font-weight: 500;">
                    5 Total Cases
                </span>
            </div>
            
            <div class="table-responsive" style="background-color: #ffffff;">
                <table class="table table-hover align-middle mb-0 ref-table" id="referralsMasterTable" style="min-width: 1100px; background-color: #ffffff;">
                    <thead style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4" style="min-width: 155px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referral No.
                            </th>
                            <th style="min-width: 175px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referral Type
                            </th>
                            <th style="min-width: 195px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Full Name
                            </th>
                            <th class="text-center" style="min-width: 110px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Program
                            </th>
                            <th style="min-width: 230px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referred By / Agency
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Urgency
                            </th>
                            <th class="text-center" style="min-width: 140px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Status
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Date Filed
                            </th>
                            <th class="text-center pe-4" style="min-width: 220px; padding: 15px 20px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        <!-- Row 1: External Emergency -->
                        <tr data-ref-id="REF-EXT-2026-001" data-type="External Referral" data-urgency="Emergency" data-status="In Progress">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">
                                REF-EXT-2026-001
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge badge-ref-type" style="background-color: #fff8e1; color: #8c5d00; border: 1.5px solid #d4a017; font-weight: 700; font-size: 13.5px; min-width: 165px; height: 34px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-building" style="font-size: 14px;"></i>External Referral</span>
                            </td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">
                                RAMOS, CARLOS M.
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BSIS</span>
                            </td>
                            
                            <td style="padding: 15px 18px; vertical-align: middle;" class="text-dark">
                                Provincial Health Office (PHO)
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-danger text-white" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Emergency</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    In Progress
                                </span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 20, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-external-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-EXT-2026-001" data-student="RAMOS, CARLOS M." data-program="BSIS" data-type="External Referral" data-source="Provincial Health Office (PHO)" data-urgency="Emergency" data-status="In Progress" data-date="Oct 20, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>

                        <!-- Row 2: Self-Referral -->
                        <tr data-ref-id="REF-SLF-2026-001" data-type="Self-Referral" data-urgency="Routine" data-status="In Progress">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">
                                REF-SLF-2026-001
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge badge-ref-type" style="background-color: #e8f5e9; color: #1b5e20; border: 1.5px solid #2e7d32; font-weight: 700; font-size: 13.5px; min-width: 165px; height: 34px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-person-walking" style="font-size: 14px;"></i>Self-Referral</span>
                            </td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">
                                MENDOZA, JUAN B.
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BEED</span>
                            </td>
                            
                            <td style="padding: 15px 18px; vertical-align: middle;" class="text-dark">
                                Self (Student Walk-In)
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-light text-secondary border" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Routine</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    In Progress
                                </span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 16, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-self-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-SLF-2026-001" data-student="MENDOZA, JUAN B." data-program="BEED" data-type="Self-Referral" data-source="Self (Student Walk-In)" data-urgency="Routine" data-status="In Progress" data-date="Oct 16, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>

                        <!-- Row 3: Internal Urgent -->
                        <tr data-ref-id="REF-INT-2026-042" data-type="Faculty Referral" data-urgency="Urgent" data-status="In Progress">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">
                                REF-INT-2026-042
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge badge-ref-type" style="background-color: #e3f2fd; color: #0d47a1; border: 1.5px solid #1976d2; font-weight: 700; font-size: 13.5px; min-width: 165px; height: 34px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-person-workspace" style="font-size: 14px;"></i>Faculty Referral</span>
                            </td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">
                                SANTOS, MARIA C.
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BaPOS</span>
                            </td>
                            
                            <td style="padding: 15px 18px; vertical-align: middle;" class="text-dark">
                                Prof. Jonathan Mendoza
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-warning-subtle text-dark border border-warning" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Urgent (24-72h)</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    In Progress
                                </span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 18, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-internal-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-INT-2026-042" data-student="SANTOS, MARIA C." data-program="BaPOS" data-type="Faculty Referral" data-source="Prof. Jonathan Mendoza" data-urgency="Urgent" data-status="In Progress" data-date="Oct 18, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>

                        <!-- Row 4: Internal Routine -->
                        <tr data-ref-id="REF-INT-2026-039" data-type="Faculty Referral" data-urgency="Routine" data-status="Pending Intake">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">
                                REF-INT-2026-039
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge badge-ref-type" style="background-color: #e3f2fd; color: #0d47a1; border: 1.5px solid #1976d2; font-weight: 700; font-size: 13.5px; min-width: 165px; height: 34px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-person-workspace" style="font-size: 14px;"></i>Faculty Referral</span>
                            </td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">
                                DELA CRUZ, JUAN L.
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BSIS</span>
                            </td>
                            
                            <td style="padding: 15px 18px; vertical-align: middle;" class="text-dark">
                                Inst. Clarissa Ramos
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-light text-secondary border" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Routine</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #6c757d; background-color: #f8f9fa; color: #495057; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Pending Intake
                                </span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 15, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-internal-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-INT-2026-039" data-student="DELA CRUZ, JUAN L." data-program="BSIS" data-type="Faculty Referral" data-source="Inst. Clarissa Ramos" data-urgency="Routine" data-status="Pending Intake" data-date="Oct 15, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>

                        <!-- Row 5: External Routine -->
                        <tr data-ref-id="REF-EXT-2026-002" data-type="External Referral" data-urgency="Routine" data-status="Endorsed">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">
                                REF-EXT-2026-002
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge badge-ref-type" style="background-color: #fff8e1; color: #8c5d00; border: 1.5px solid #d4a017; font-weight: 700; font-size: 13.5px; min-width: 165px; height: 34px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-building" style="font-size: 14px;"></i>External Referral</span>
                            </td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">
                                ALVAREZ, BEA P.
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BEED</span>
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;" class="text-dark">
                                DSWD Provincial Branch
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-light text-secondary border" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Routine</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #0d6efd; background-color: #f0f7ff; color: #084298; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">
                                    Endorsed
                                </span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 11, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-external-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-EXT-2026-002" data-student="ALVAREZ, BEA P." data-program="BEED" data-type="External Referral" data-source="DSWD Provincial Branch" data-urgency="Routine" data-status="Endorsed" data-date="Oct 11, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==================== TAB 2: SELF-REFERRALS ==================== -->
        <div class="tab-pane fade" id="tab-self" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center py-3.5 px-4 bg-light border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-walking text-success" style="font-size: 17px;"></i>
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Student Self-Referral Directory (Walk-In)</span>
                </div>
                <span class="badge bg-white text-secondary border px-3 py-1.5" style="font-size: 13px; font-weight: 500;">Showing 1 Case</span>
            </div>
            <div class="table-responsive" style="background-color: #ffffff;">
                <table class="table table-hover align-middle mb-0 ref-table" id="referralsSelfTable" style="min-width: 1050px; background-color: #ffffff;">
                    <thead style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4" style="min-width: 155px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referral No.
                            </th>
                            <th style="min-width: 195px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Full Name
                            </th>
                            <th class="text-center" style="min-width: 110px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Program
                            </th>
                            <th style="min-width: 250px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Consultation Focus
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Urgency
                            </th>
                            <th class="text-center" style="min-width: 140px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Status
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Date Filed
                            </th>
                            <th class="text-center pe-4" style="min-width: 220px; padding: 15px 20px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        <tr data-ref-id="REF-SLF-2026-001" data-type="Self-Referral" data-urgency="Routine" data-status="In Progress">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">
                                REF-SLF-2026-001
                            </td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">
                                MENDOZA, JUAN B.
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BEED</span>
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;" class="text-dark">
                                Academic Stress & Time Management Consultation
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-light text-secondary border" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Routine</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">In Progress</span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 16, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-self-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-SLF-2026-001" data-student="MENDOZA, JUAN B." data-program="BEED" data-type="Self-Referral" data-source="Self (Student Walk-In)" data-urgency="Routine" data-status="In Progress" data-date="Oct 16, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==================== TAB 3: FACULTY REFERRALS ==================== -->
        <div class="tab-pane fade" id="tab-internal" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center py-3.5 px-4 bg-light border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-workspace text-primary" style="font-size: 17px;"></i>
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Faculty Internal Endorsement Directory</span>
                </div>
                <span class="badge bg-white text-secondary border px-3 py-1.5" style="font-size: 13px; font-weight: 500;">Showing 2 Cases</span>
            </div>
            <div class="table-responsive" style="background-color: #ffffff;">
                <table class="table table-hover align-middle mb-0 ref-table" id="referralsInternalTable" style="min-width: 1050px; background-color: #ffffff;">
                    <thead style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4" style="min-width: 155px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referral No.
                            </th>
                            <th style="min-width: 195px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Full Name
                            </th>
                            <th class="text-center" style="min-width: 110px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Program
                            </th>
                            <th style="min-width: 230px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referring Faculty
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Urgency
                            </th>
                            <th class="text-center" style="min-width: 140px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Status
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Date Filed
                            </th>
                            <th class="text-center pe-4" style="min-width: 220px; padding: 15px 20px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        <tr data-ref-id="REF-INT-2026-042" data-type="Faculty Referral" data-urgency="Urgent" data-status="In Progress">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">REF-INT-2026-042</td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">SANTOS, MARIA C.</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BaPOS</span>
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">Prof. Jonathan Mendoza</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-warning-subtle text-dark border border-warning" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Urgent (24-72h)</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">In Progress</span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 18, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-internal-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-INT-2026-042" data-student="SANTOS, MARIA C." data-program="BaPOS" data-type="Faculty Referral" data-source="Prof. Jonathan Mendoza" data-urgency="Urgent" data-status="In Progress" data-date="Oct 18, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>
                        <tr data-ref-id="REF-INT-2026-039" data-type="Faculty Referral" data-urgency="Routine" data-status="Pending Intake">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">REF-INT-2026-039</td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">DELA CRUZ, JUAN L.</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BSIS</span>
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">Inst. Clarissa Ramos</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-light text-secondary border" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Routine</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #6c757d; background-color: #f8f9fa; color: #495057; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Pending Intake</span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 15, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-internal-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-INT-2026-039" data-student="DELA CRUZ, JUAN L." data-program="BSIS" data-type="Faculty Referral" data-source="Inst. Clarissa Ramos" data-urgency="Routine" data-status="Pending Intake" data-date="Oct 15, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==================== TAB 4: EXTERNAL REFERRALS ==================== -->
        <div class="tab-pane fade" id="tab-external" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center py-3.5 px-4 bg-light border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-up-right text-danger" style="font-size: 17px;"></i>
                    <span class="fw-semibold text-dark" style="font-size: 15px;">External Agency Referral Directory</span>
                </div>
                <span class="badge bg-white text-secondary border px-3 py-1.5" style="font-size: 13px; font-weight: 500;">Showing 2 Cases</span>
            </div>
            <div class="table-responsive" style="background-color: #ffffff;">
                <table class="table table-hover align-middle mb-0 ref-table" id="referralsExternalTable" style="min-width: 1050px; background-color: #ffffff;">
                    <thead style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <tr>
                            <th class="ps-4" style="min-width: 155px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Referral No.
                            </th>
                            <th style="min-width: 195px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Full Name
                            </th>
                            <th class="text-center" style="min-width: 110px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Program
                            </th>
                            <th style="min-width: 230px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Partner Agency
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Urgency
                            </th>
                            <th class="text-center" style="min-width: 140px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Status
                            </th>
                            <th class="text-center" style="min-width: 130px; padding: 15px 18px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Date Filed
                            </th>
                            <th class="text-center pe-4" style="min-width: 220px; padding: 15px 20px; vertical-align: middle; font-size: 14.5px; font-weight: 700; color: #2D3748; letter-spacing: 0.3px; white-space: nowrap;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        <tr data-ref-id="REF-EXT-2026-001" data-type="External Referral" data-urgency="Emergency" data-status="In Progress">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">REF-EXT-2026-001</td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">RAMOS, CARLOS M.</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BSIS</span>
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">Provincial Health Office (PHO)</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-danger text-white" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Emergency</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">In Progress</span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 20, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-external-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-EXT-2026-001" data-student="RAMOS, CARLOS M." data-program="BSIS" data-type="External Referral" data-source="Provincial Health Office (PHO)" data-urgency="Emergency" data-status="In Progress" data-date="Oct 20, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>
                        <tr data-ref-id="REF-EXT-2026-002" data-type="External Referral" data-urgency="Routine" data-status="Endorsed">
                            <td class="ps-3 ps-md-4 fw-semibold" style="padding: 15px 18px; vertical-align: middle; color: #800020;">REF-EXT-2026-002</td>
                            <td class="fw-semibold text-dark" style="padding: 15px 18px; vertical-align: middle;">ALVAREZ, BEA P.</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge-program" style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 72px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13.5px;">BEED</span>
                            </td>
                            <td style="padding: 15px 18px; vertical-align: middle;">DSWD Provincial Branch</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge bg-light text-secondary border" style="min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; border-radius: 50rem;">Routine</span>
                            </td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <span class="badge" style="border: 1.5px solid #0d6efd; background-color: #f0f7ff; color: #084298; border-radius: 50rem; min-width: 125px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Endorsed</span>
                            </td>
                            <td class="text-center text-muted" style="padding: 15px 18px; vertical-align: middle;">Oct 11, 2026</td>
                            <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2.5">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modal-view-external-sample"
                        style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-eye me-1.5"></i>View
                    </button>
                    <button type="button" class="btn btn-sm text-white shadow-none d-inline-flex align-items-center justify-content-center btn-track-ref" data-bs-toggle="modal" data-bs-target="#modal-track-referral"
                                        data-ref-id="REF-EXT-2026-002" data-student="ALVAREZ, BEA P." data-program="BEED" data-type="External Referral" data-source="DSWD Provincial Branch" data-urgency="Routine" data-status="Endorsed" data-date="Oct 11, 2026"
                                        style="background-color: #800020; border: 1px solid #800020; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                        <i class="bi bi-geo-alt me-1.5"></i>Track
                    </button>
                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: CREATE SELF-REFERRAL (STUDENT WALK-IN FORM)                 -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-create-self-referral" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-heart text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Student Self-Referral Intake Form
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="#" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #f8f9fa;">
                    
                    <!-- SECTION 1: STUDENT IDENTIFICATION -->
                    <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                            <span class="badge me-2" style="background-color: #800020;">1</span>
                            <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Student Information</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-3" style="font-size: 15px;">
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none" placeholder="e.g. MENDOZA, JUAN B." required style="font-size: 15px; border-color: #ced4da;">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Academic Program <span class="text-danger">*</span></label>
                                    <select class="form-select shadow-none" required style="font-size: 15px; border-color: #ced4da;">
                                        <option value="" selected>Select Program...</option>
                                        <option value="BSIS">BS Information Systems (BSIS)</option>
                                        <option value="BaPOS">Bachelor of Arts in Political Science (BaPOS)</option>
                                        <option value="BEED">Bachelor of Elementary Education (BEED)</option>
                                        <option value="BSTM">BS Tourism Management (BSTM)</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none" placeholder="e.g. 0917-123-4567" required style="font-size: 15px; border-color: #ced4da;">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Institutional Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control shadow-none" placeholder="e.g. student@marsu.edu.ph" required style="font-size: 15px; border-color: #ced4da;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: CONCERN & REASON -->
                    <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                            <span class="badge me-2" style="background-color: #800020;">2</span>
                            <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Reason for Seeking Guidance</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-3" style="font-size: 15px;">
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Primary Area of Concern <span class="text-danger">*</span></label>
                                    <select class="form-select shadow-none" required style="font-size: 15px; border-color: #ced4da;">
                                        <option value="Academic Challenges">Academic Challenges / Study Habits</option>
                                        <option value="Emotional Support">Emotional / Stress Management</option>
                                        <option value="Career & Future Goals">Career & Course Path Clarification</option>
                                        <option value="Interpersonal & Family">Family / Relationship Conflict</option>
                                        <option value="Personal Well-being">General Well-being Consultation</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Urgency Preference <span class="text-danger">*</span></label>
                                    <select class="form-select shadow-none" required style="font-size: 15px; border-color: #ced4da;">
                                        <option value="Routine" selected>Routine (Next Available Session)</option>
                                        <option value="Urgent">Urgent (Within 2-3 Days)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted fw-semibold small mb-1">Brief Description of Concern</label>
                                    <textarea class="form-control shadow-none" rows="3" placeholder="Tell us briefly how the Guidance Office can best support you..." style="font-size: 15px; border-color: #ced4da;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: PRIVACY NOTICE -->
                    <div class="p-3 bg-white border rounded">
                        <div class="d-flex align-items-center gap-2 text-muted small">
                            <i class="bi bi-shield-lock-fill text-success fs-5"></i>
                            <span>All self-referrals are handled in strict confidentiality under Republic Act No. 10173 (Data Privacy Act of 2012).</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 15px; height: 34px;">Cancel</button>
                    <button type="button" class="btn btn-sm text-white px-3 shadow-none" data-bs-dismiss="modal" style="background-color: #800020; border: 1px solid #800020; font-size: 15px; height: 34px;">
                        <i class="bi bi-send me-1"></i>Submit Self-Referral
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: VIEW SELF-REFERRAL RECORD                                   -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-self-sample" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-heart text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Student Self-Referral Record &bull; REF-SLF-2026-001
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                
                <!-- 1. STUDENT INFORMATION -->
                <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="badge me-2" style="background-color: #800020;">1</span>
                            <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Student Information</h6>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle">Self-Referral</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Full Name</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">MENDOZA, JUAN B.</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Academic Program</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Bachelor of Elementary Education (BEED)</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Contact Number</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">0920-888-4321</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Institutional Email</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">j.mendoza@marsu.edu.ph</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. REASON FOR SEEKING GUIDANCE -->
                <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                        <span class="badge me-2" style="background-color: #800020;">2</span>
                        <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Reason for Seeking Guidance</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Primary Area of Concern</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Academic Stress & Study Workload</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Urgency Level</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Routine</div>
                            </div>
                            <div class="col-12">
                                <label class="text-muted d-block small mb-1">Student Narrative Notes</label>
                                <div class="p-2.5 rounded bg-light border text-dark">
                                    Student requested consultation regarding balancing third-year education practicum requirements and thesis deadlines. Expressed willingness to attend weekly coaching sessions.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. COUNSELOR ACTION -->
                <div class="card border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                        <span class="badge me-2" style="background-color: #800020;">3</span>
                        <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Counselor Intake & Response</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Assigned Counselor</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Dr. Elena Santos, RGC</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Current Status</label>
                                <div class="p-2 rounded bg-light border">
                                    <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; font-size: 13px;">In Progress</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 15px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: VIEW FACULTY INTERNAL REFERRAL RECORD                       -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-internal-sample" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Faculty Internal Referral Record &bull; REF-INT-2026-042
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                
                <!-- 1. STUDENT & FACULTY IDENTIFICATION -->
                <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="badge me-2" style="background-color: #800020;">1</span>
                            <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Student & Referring Faculty</h6>
                        </div>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Faculty Referral</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Student Full Name</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">SANTOS, MARIA C.</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Academic Program</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Bachelor of Arts in Political Science (BaPOS)</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Referring Faculty</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Prof. Jonathan Mendoza</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Urgency Priority</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Urgent (Within 24-72 Hours)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. REASON FOR REFERRAL -->
                <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                        <span class="badge me-2" style="background-color: #800020;">2</span>
                        <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Observed Academic & Behavioral Symptoms</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-12">
                                <div class="p-2.5 rounded bg-light border">
                                    <ul class="mb-0 ps-3">
                                        <li>Sudden drop in midterm lab outputs and capstone deliverables.</li>
                                        <li>Visible exhaustion and emotional stress during faculty consultations.</li>
                                        <li>Unexcused absences in morning laboratory lectures.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. COUNSELOR ACTION -->
                <div class="card border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                        <span class="badge me-2" style="background-color: #800020;">3</span>
                        <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Counselor Intake & Response</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Assigned Guidance Personnel</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Dr. Elena Santos, RGC</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Status</label>
                                <div class="p-2 rounded bg-light border">
                                    <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; font-size: 13px;">In Progress</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 15px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: VIEW EXTERNAL AGENCY REFERRAL RECORD                        -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-external-sample" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-up-right text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        External Agency Referral Record &bull; REF-EXT-2026-001
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                
                <!-- 1. STUDENT & AGENCY INFORMATION -->
                <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="badge me-2" style="background-color: #800020;">1</span>
                            <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Student & Receiving Agency</h6>
                        </div>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">External Referral</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Student Full Name</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">RAMOS, CARLOS M.</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Academic Program</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">BS Information Systems (BSIS)</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Receiving Partner Agency</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Provincial Health Office (PHO) - Psychiatric Unit</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Urgency Priority</label>
                                <div class="fw-semibold text-danger p-2 rounded bg-light border">Emergency (Immediate Transmittal)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. REASON FOR ENDORSEMENT -->
                <div class="card mb-3 border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                        <span class="badge me-2" style="background-color: #800020;">2</span>
                        <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Clinical Purpose of External Endorsement</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="p-2.5 rounded bg-light border text-dark">
                            Endorsed for comprehensive psychiatric consultation and specialized clinical assessment. Transmittal package includes statutory parent consent and verified medical release documents.
                        </div>
                    </div>
                </div>

                <!-- 3. ENDORSEMENT STATUS -->
                <div class="card border shadow-none" style="border-color: #E2E8F0 !important; border-radius: 8px;">
                    <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex align-items-center">
                        <span class="badge me-2" style="background-color: #800020;">3</span>
                        <h6 class="mb-0 fw-bold" style="color: #1A202C; font-size: 15px;">Endorsement Tracking Status</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Case Counselor</label>
                                <div class="fw-semibold text-dark p-2 rounded bg-light border">Dr. Elena Santos, RGC</div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted d-block small mb-1">Transmittal Status</label>
                                <div class="p-2 rounded bg-light border">
                                    <span class="badge" style="border: 1.5px solid #d4a017; background-color: #fdfbe8; color: #856404; font-size: 13px;">In Progress (PHO Intake Queued)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4 shadow-none" data-bs-dismiss="modal" style="font-size: 15px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: TRACK REFERRAL STATUS TIMELINE                              -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-track-referral" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock-history text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Referral Case Status Tracker &bull; <span id="trackRefIdHeader">REF-EXT-2026-001</span>
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                
                <!-- SUMMARY HEADER -->
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <span class="badge text-uppercase mb-1" id="trackTypeBadge" style="background-color: #FDF2F4; color: #800020; border: 1px solid #f5c2c7; font-size: 12px;">External Referral</span>
                            <h5 class="fw-bold mb-1 text-dark" id="trackStudentName" style="font-size: 18px;">RAMOS, CARLOS M.</h5>
                            <div class="text-muted" style="font-size: 14.5px;">
                                Program: <span id="trackProgram" class="fw-semibold text-dark">BSIS</span>
                            </div>
                            <div class="text-muted mt-1" style="font-size: 14.5px;">
                                <strong>Origin / Referring Entity:</strong> <span id="trackSource">Provincial Health Office (PHO)</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="mb-1">
                                <span class="badge" id="trackUrgencyBadge" style="font-size: 12.5px;">Emergency</span>
                            </div>
                            <div>
                                <span class="badge" id="trackStatusBadge" style="font-size: 12.5px;">In Progress</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4-STEP VISUAL PROGRESS BAR -->
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 15px;">
                        <i class="bi bi-diagram-3-fill me-1" style="color: #800020;"></i>Referral Lifecycle Progress
                    </h6>
                    <div class="row g-2 text-center" id="trackStepContainer">
                        <div class="col-3">
                            <div class="p-2 rounded border bg-light text-success border-success" style="font-size: 12px; font-weight: 600;">
                                <i class="bi bi-check-circle-fill d-block fs-5 mb-1 text-success"></i>
                                1. Submitted
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">Verified</small>
                        </div>
                        <div class="col-3">
                            <div class="p-2 rounded border bg-light text-success border-success" style="font-size: 12px; font-weight: 600;">
                                <i class="bi bi-check-circle-fill d-block fs-5 mb-1 text-success"></i>
                                2. Counselor Assigned
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">Active Case</small>
                        </div>
                        <div class="col-3">
                            <div class="p-2 rounded border text-warning border-warning" style="background-color: #fffdf5; font-size: 12px; font-weight: 600;">
                                <i class="bi bi-arrow-repeat d-block fs-5 mb-1 text-warning"></i>
                                3. In Progress
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">Intake / Transmittal</small>
                        </div>
                        <div class="col-3">
                            <div class="p-2 rounded border bg-light text-muted" style="font-size: 12px; font-weight: 600;">
                                <i class="bi bi-circle d-block fs-5 mb-1 text-muted"></i>
                                4. Resolved
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">Pending Close</small>
                        </div>
                    </div>
                </div>

                <!-- CHRONOLOGICAL TIMELINE / AUDIT LOG -->
                <div class="card p-3 bg-white border" style="border-radius: 8px;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 15px;">
                        <i class="bi bi-clock-history me-1" style="color: #800020;"></i>Referral Action History
                    </h6>
                    <div class="position-relative ps-3" style="border-left: 2px solid #E2E8F0;">
                        <div class="mb-3 position-relative">
                            <div style="position: absolute; left: -22px; top: 2px; width: 12px; height: 12px; border-radius: 50%; background-color: #800020; border: 2px solid #fff;"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong style="font-size: 14.5px; color: #1A202C;">Intake Session & Coordination Initiated</strong>
                                <span class="text-muted small" style="font-size: 12px;">Active Stage</span>
                            </div>
                            <p class="text-muted small mb-0 mt-1" style="font-size: 13.5px;">
                                Dr. Elena Santos, RGC initiated intervention and recorded transmittal documentation in compliance with university guidance policies.
                            </p>
                        </div>
                        <div class="position-relative">
                            <div style="position: absolute; left: -22px; top: 2px; width: 12px; height: 12px; border-radius: 50%; background-color: #D4AF37; border: 2px solid #fff;"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong style="font-size: 14.5px; color: #1A202C;">Referral Logged & Verified</strong>
                                <span class="text-muted small" style="font-size: 12px;">Logged</span>
                            </div>
                            <p class="text-muted small mb-0 mt-1" style="font-size: 13.5px;">
                                Case record received and verified into the centralized guidance management system.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="font-size: 15px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>