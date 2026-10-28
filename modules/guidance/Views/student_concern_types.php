<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STUDENT CONCERN TYPES MAINTENANCE    -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 15px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <span style="color: #800020; text-decoration: none; font-weight: 500;">Maintenance</span>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Student Concern Types
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Student Concern Types Maintenance
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Manage and maintain the standardized categories used to classify student concerns for guidance and counseling services.
            </p>
        </div>
        <div>
            <button type="button" class="btn text-white px-3 shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-add-concern-type"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14px; font-weight: 500; border-radius: 4px; height: 38px;">
                <i class="bi bi-plus-lg me-1.5"></i>+ Add Concern Type
            </button>
        </div>
    </div>
</div>

<!-- 3. EXACTLY FOUR KPI CARDS -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Concern Types -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #800020 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        TOTAL CONCERN TYPES
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">6</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-tags-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Active and inactive types</div>
        </div>
    </div>

    <!-- Card 2: Active Types -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #16A34A !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        ACTIVE TYPES
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">5</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #F0FDF4; color: #16A34A; border: 1px solid #BBF7D0;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Available for selection</div>
        </div>
    </div>

    <!-- Card 3: Inactive Types -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #6C757D !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        INACTIVE TYPES
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">1</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #F8F9FA; color: #6C757D; border: 1px solid #E2E8F0;">
                    <i class="bi bi-pause-circle-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Deactivated categories</div>
        </div>
    </div>

    <!-- Card 4: Recently Updated -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #EBE4E4; border-left: 4px solid #D97706 !important; border-radius: 10px; background-color: #ffffff; min-height: 105px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        RECENTLY UPDATED
                    </div>
                    <div class="mt-1" style="font-size: 24px; font-weight: 700; color: #1A202C; line-height: 1.1;">3</div>
                </div>
                <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; background-color: #FFFBEB; color: #D97706; border: 1px solid #FDE68A;">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 13px; color: #718096;">Updated within 30 days</div>
        </div>
    </div>
</div>

<!-- 4. SEARCH AND FILTER SECTION -->
<div class="card shadow-sm border-0 mb-3" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5 col-12">
                <div class="input-group input-group-sm">
                    <span class="input-group-text border-end-0 text-muted bg-white" style="border-color: #ced4da; font-size: 14px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none"
                        placeholder="Search by concern type name, code, or description..."
                        style="font-size: 14px; height: 38px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-3 col-6">
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>Filter by status: All</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select class="form-select shadow-none" style="font-size: 14px; height: 38px; border-color: #ced4da;">
                    <option value="" selected>Priority: All</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                    <option value="Urgent">Urgent</option>
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

<!-- 5. CONCERN TYPES TABLE (EXACT 8 COLUMNS IN EXACT ORDER) -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-3 px-md-4" style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-card-checklist me-2" style="color: #D4AF37;"></i>Standardized Concern Types Registry
        </h6>
        <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600;">
            6 Categories
        </span>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 150px; color: #2D3748;">
                            Concern Type Code
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 200px; color: #2D3748;">
                            Concern Type Name
                        </th>
                        <th style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 240px; color: #2D3748;">
                            Description
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 130px; color: #2D3748;">
                            Default Priority
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 120px; color: #2D3748;">
                            Status
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 120px; color: #2D3748;">
                            Date Created
                        </th>
                        <th class="text-center" style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 120px; color: #2D3748;">
                            Last Updated
                        </th>
                        <th class="text-center pe-3 pe-md-4" style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 280px; color: #2D3748;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    <!-- Row 1: Academic Performance & Probation -->
                    <tr>
                        <td class="ps-4 fw-bold" style="padding: 14px 16px; color: #800020;">CNC-ACAD-01</td>
                        <td class="fw-semibold text-dark" style="padding: 14px 16px;">Academic Performance & Probation</td>
                        <td style="padding: 14px 16px;" class="text-muted">
                            Failing grades, study habit deficiencies, retention risks, and prerequisite hurdles...
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; font-size: 12px; padding: 4px 8px;">High</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">Active</span>
                        </td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-01-15</td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-03-20</td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-concern-001"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-concern-001"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-deactivate-concern-001"
                                    style="border: 1px solid #DC2626; color: #991B1B; background-color: #FEF2F2; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pause-fill me-1"></i>Deactivate
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Mental Health & Emotional Well-being -->
                    <tr>
                        <td class="ps-4 fw-bold" style="padding: 14px 16px; color: #800020;">CNC-MNTL-02</td>
                        <td class="fw-semibold text-dark" style="padding: 14px 16px;">Mental Health & Emotional Well-being</td>
                        <td style="padding: 14px 16px;" class="text-muted">
                            Severe test anxiety, panic, depression signs, emotional burnout, or traumatic stress...
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; font-size: 12px; padding: 4px 8px;">Urgent</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">Active</span>
                        </td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-01-15</td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-03-22</td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-concern-002"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-concern-002"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-deactivate-concern-002"
                                    style="border: 1px solid #DC2626; color: #991B1B; background-color: #FEF2F2; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pause-fill me-1"></i>Deactivate
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Career Guidance & Placement -->
                    <tr>
                        <td class="ps-4 fw-bold" style="padding: 14px 16px; color: #800020;">CNC-CARE-03</td>
                        <td class="fw-semibold text-dark" style="padding: 14px 16px;">Career Guidance & Placement</td>
                        <td style="padding: 14px 16px;" class="text-muted">
                            Specialization track indecision, shifting dilemmas, resume writing, and job placement...
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 12px; padding: 4px 8px;">Medium</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">Active</span>
                        </td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-01-15</td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-02-18</td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-concern-003"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-concern-003"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-deactivate-concern-003"
                                    style="border: 1px solid #DC2626; color: #991B1B; background-color: #FEF2F2; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pause-fill me-1"></i>Deactivate
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Interpersonal & Peer Relationship -->
                    <tr>
                        <td class="ps-4 fw-bold" style="padding: 14px 16px; color: #800020;">CNC-PEER-04</td>
                        <td class="fw-semibold text-dark" style="padding: 14px 16px;">Interpersonal & Peer Relationship</td>
                        <td style="padding: 14px 16px;" class="text-muted">
                            Classroom disputes, group project conflicts, bullying, and roommate dynamics...
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 12px; padding: 4px 8px;">Medium</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">Active</span>
                        </td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-01-15</td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-03-24</td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-concern-004"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-concern-004"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-deactivate-concern-004"
                                    style="border: 1px solid #DC2626; color: #991B1B; background-color: #FEF2F2; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pause-fill me-1"></i>Deactivate
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 5: Financial Distress & Socio-Economic -->
                    <tr>
                        <td class="ps-4 fw-bold" style="padding: 14px 16px; color: #800020;">CNC-FINA-05</td>
                        <td class="fw-semibold text-dark" style="padding: 14px 16px;">Financial Distress & Socio-Economic</td>
                        <td style="padding: 14px 16px;" class="text-muted">
                            Allowance shortages, food insecurity, and boarding house living difficulty...
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; padding: 4px 8px;">Low</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; padding: 4px 8px;">Active</span>
                        </td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-01-15</td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-02-10</td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-concern-005"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-concern-005"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-deactivate-concern-005"
                                    style="border: 1px solid #DC2626; color: #991B1B; background-color: #FEF2F2; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pause-fill me-1"></i>Deactivate
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 6: Legacy Routine General Inquiry (Inactive) -->
                    <tr>
                        <td class="ps-4 fw-bold" style="padding: 14px 16px; color: #6C757D;">CNC-LEGC-06</td>
                        <td class="fw-semibold text-muted" style="padding: 14px 16px;">Legacy Routine General Inquiry</td>
                        <td style="padding: 14px 16px;" class="text-muted">
                            Historical general inquiry code deprecated in favor of structured academic and career tracks...
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; padding: 4px 8px;">Low</span>
                        </td>
                        <td class="text-center" style="padding: 14px 16px;">
                            <span class="badge" style="background-color: #F8F9FA; color: #6C757D; border: 1px solid #E2E8F0; font-size: 12px; padding: 4px 8px;">Inactive</span>
                        </td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2025-08-01</td>
                        <td class="text-center text-muted" style="padding: 14px 16px;">2026-01-10</td>
                        <td class="text-center pe-4" style="padding: 14px 16px;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-concern-006"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-eye me-1.5"></i>View
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-concern-006"
                                    style="border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-pencil me-1.5"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-activate-concern-006"
                                    style="border: 1px solid #16A34A; color: #15803D; background-color: #F0FDF4; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                    <i class="bi bi-play-fill me-1"></i>Activate
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
<!--   6. ADD CONCERN TYPE DIALOG                                         -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-add-concern-type" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Add Concern Type</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3" style="font-size: 14.5px;">Basic Information</h6>
                    <div class="row g-3 mb-4" style="font-size: 14px;">
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Concern Type Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none bg-light" value="CNC-NEW-07" readonly
                                style="font-size: 14px; font-weight: 600; color: #800020; border-color: #ced4da;">
                            <span class="small text-muted" style="font-size: 11px;">Automatically suggested code</span>
                        </div>
                        <div class="col-md-8 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Concern Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. Grief and Loss Counseling" required style="font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Full operational definition for guidance intake categorization..." required style="font-size: 14px;"></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Default Priority <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px;">
                                <option value="Low">Low</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="High">High</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Status <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px;">
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3" style="font-size: 14.5px;">Optional Configuration</h6>
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Requires Follow-up</label>
                            <select class="form-select shadow-none" style="font-size: 14px;">
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Requires Referral Review</label>
                            <select class="form-select shadow-none" style="font-size: 14px;">
                                <option value="Yes">Yes</option>
                                <option value="No" selected>No</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Display Order</label>
                            <input type="number" class="form-control shadow-none" placeholder="e.g. 7" min="1" style="font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Internal Administrative Notes</label>
                            <textarea class="form-control shadow-none" rows="2" placeholder="Administrative usage rules, clinical reminders, or routing instructions..." style="font-size: 14px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="reset" class="btn btn-sm btn-light border px-3" style="height: 34px;">Clear Form</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                        <i class="bi bi-save me-1.5"></i>Save Concern Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   7. VIEW CONCERN TYPE DIALOG                                        -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-concern-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">View Concern Type: CNC-ACAD-01</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F8FAFC; font-size: 14px;">
                <div class="card p-3 mb-3 bg-white border" style="border-radius: 8px;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Concern Type Code:</span>
                            <span class="fw-bold" style="color: #800020;">CNC-ACAD-01</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Concern Type Name:</span>
                            <span class="fw-bold text-dark">Academic Performance & Probation</span>
                        </div>
                        <div class="col-12">
                            <span class="text-muted small d-block">Full Description:</span>
                            <div class="p-2.5 rounded bg-light border text-dark mt-1">
                                Failing grades, study habit deficiencies, retention risks, prerequisite hurdles, and laboratory performance anxieties affecting university students.
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <span class="text-muted small d-block">Default Priority:</span>
                            <span class="badge" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D;">High</span>
                        </div>
                        <div class="col-md-4 col-6">
                            <span class="text-muted small d-block">Status:</span>
                            <span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0;">Active</span>
                        </div>
                        <div class="col-md-4 col-6">
                            <span class="text-muted small d-block">Display Order:</span>
                            <span class="fw-bold text-dark">1</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Requires Follow-up:</span>
                            <span class="fw-bold text-dark">Yes</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Requires Referral Review:</span>
                            <span class="fw-bold text-dark">Yes (Deans & Program Chairs)</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Date Created:</span>
                            <span class="text-dark">January 15, 2026</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small d-block">Last Updated:</span>
                            <span class="text-dark">March 20, 2026</span>
                        </div>
                        <div class="col-12">
                            <span class="text-muted small d-block">Internal Administrative Notes:</span>
                            <div class="p-2.5 rounded bg-light border text-muted mt-1 small">
                                Automatically routes follow-up tasks to the designated College Guidance Counselor. Prompts study contract template generation upon intake confirmation.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Close</button>
                <button type="button" class="btn btn-sm text-white px-3" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal-edit-concern-001"
                    style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                    <i class="bi bi-pencil me-1"></i>Edit
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-concern-002" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">View Concern Type: CNC-MNTL-02</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6>Mental Health & Emotional Well-being</h6>
                <p class="text-muted">Urgent default priority with automatic Psychological First Aid triage routing.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-concern-003" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">View Concern Type: CNC-CARE-03</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6>Career Guidance & Placement</h6>
                <p class="text-muted">Career pathway counseling and RIASEC testing battery alignment.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-concern-004" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">View Concern Type: CNC-PEER-04</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6>Interpersonal & Peer Relationship</h6>
                <p class="text-muted">Classroom mediation, peer disputes, and restorative dialogue support.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-concern-005" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">View Concern Type: CNC-FINA-05</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6>Financial Distress & Socio-Economic</h6>
                <p class="text-muted">Cross-referrals to Student Welfare allowances and food assistance.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-concern-006" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-semibold">View Concern Type: CNC-LEGC-06</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6>Legacy Routine General Inquiry</h6>
                <p class="text-muted">Deprecated historical category preserved for historical record audit.</p>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   8. EDIT CONCERN TYPE DIALOG (CODE IS READ-ONLY)                    -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-edit-concern-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Edit Concern Type: CNC-ACAD-01</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="row g-3" style="font-size: 14px;">
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Concern Type Code (Read-Only)</label>
                            <input type="text" class="form-control bg-light shadow-none" value="CNC-ACAD-01" readonly
                                style="font-size: 14px; font-weight: 600; color: #800020; border-color: #ced4da;">
                        </div>
                        <div class="col-md-8 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Concern Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" value="Academic Performance & Probation" required style="font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control shadow-none" rows="2" required style="font-size: 14px;">Failing grades, study habit deficiencies, retention risks, prerequisite hurdles, and laboratory performance anxieties.</textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Default Priority <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px;">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High" selected>High</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Status <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required style="font-size: 14px;">
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Requires Follow-up</label>
                            <select class="form-select shadow-none" style="font-size: 14px;">
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Requires Referral Review</label>
                            <select class="form-select shadow-none" style="font-size: 14px;">
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Display Order</label>
                            <input type="number" class="form-control shadow-none" value="1" min="1" style="font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1">Administrative Notes</label>
                            <textarea class="form-control shadow-none" rows="2" style="font-size: 14px;">Automatically routes follow-up tasks to the designated College Guidance Counselor.</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; height: 34px;">
                        <i class="bi bi-save me-1.5"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-concern-002" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #800020;"><h5 class="modal-title fs-6 fw-semibold">Edit CNC-MNTL-02</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4"><p class="text-muted">Edit configuration for Mental Health & Emotional Well-being.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button></div></div></div></div>
<div class="modal fade" id="modal-edit-concern-003" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #800020;"><h5 class="modal-title fs-6 fw-semibold">Edit CNC-CARE-03</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4"><p class="text-muted">Edit configuration for Career Guidance.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button></div></div></div></div>
<div class="modal fade" id="modal-edit-concern-004" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #800020;"><h5 class="modal-title fs-6 fw-semibold">Edit CNC-PEER-04</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4"><p class="text-muted">Edit configuration for Peer Relationship.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button></div></div></div></div>
<div class="modal fade" id="modal-edit-concern-005" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #800020;"><h5 class="modal-title fs-6 fw-semibold">Edit CNC-FINA-05</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4"><p class="text-muted">Edit configuration for Financial Distress.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button></div></div></div></div>
<div class="modal fade" id="modal-edit-concern-006" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #800020;"><h5 class="modal-title fs-6 fw-semibold">Edit CNC-LEGC-06</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4"><p class="text-muted">Edit configuration for Legacy General Inquiry.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="height: 34px;">Close</button></div></div></div></div>

<!-- ==================================================================== -->
<!--   9. DEACTIVATE / ACTIVATE CONFIRMATION DIALOGS                      -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-deactivate-concern-001" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #DC2626;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Deactivate Concern Type</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4 text-center" style="background-color: #F8FAFC;">
                    <i class="bi bi-pause-circle text-danger fs-1 mb-2"></i>
                    <h6 class="fw-bold text-dark">Confirm Deactivation of CNC-ACAD-01?</h6>
                    <p class="text-muted small mt-2 mb-0" style="line-height: 1.5;">
                        This category will no longer be available when creating new student concern records. Existing historical student concern records referencing this category will remain completely intact.
                    </p>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #DC2626; border: 1px solid #DC2626; height: 34px;">
                        Confirm Deactivation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-deactivate-concern-002" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-md modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #DC2626;"><h5 class="modal-title fs-6 fw-semibold">Deactivate CNC-MNTL-02</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4 text-center"><p class="text-muted small">Category will no longer be selectable in new forms.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button></div></div></div></div>
<div class="modal fade" id="modal-deactivate-concern-003" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-md modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #DC2626;"><h5 class="modal-title fs-6 fw-semibold">Deactivate CNC-CARE-03</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4 text-center"><p class="text-muted small">Category will no longer be selectable in new forms.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button></div></div></div></div>
<div class="modal fade" id="modal-deactivate-concern-004" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-md modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #DC2626;"><h5 class="modal-title fs-6 fw-semibold">Deactivate CNC-PEER-04</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4 text-center"><p class="text-muted small">Category will no longer be selectable in new forms.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button></div></div></div></div>
<div class="modal fade" id="modal-deactivate-concern-005" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-md modal-dialog-centered"><div class="modal-content shadow border-0" style="border-radius: 10px;"><div class="modal-header text-white px-4 py-3" style="background-color: #DC2626;"><h5 class="modal-title fs-6 fw-semibold">Deactivate CNC-FINA-05</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body p-4 text-center"><p class="text-muted small">Category will no longer be selectable in new forms.</p></div><div class="modal-footer px-4 py-2.5 bg-white border-top"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button></div></div></div></div>

<div class="modal fade" id="modal-activate-concern-006" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #16A34A;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-play-circle-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">Reactivate Concern Type</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4 text-center" style="background-color: #F8FAFC;">
                    <i class="bi bi-play-circle text-success fs-1 mb-2"></i>
                    <h6 class="fw-bold text-dark">Reactivate CNC-LEGC-06?</h6>
                    <p class="text-muted small mt-2 mb-0" style="line-height: 1.5;">
                        This category will immediately become available again for selection in the Add New Student Concern form.
                    </p>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 34px;">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white px-3 shadow-none"
                        style="background-color: #16A34A; border: 1px solid #16A34A; height: 34px;">
                        Confirm Reactivation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
