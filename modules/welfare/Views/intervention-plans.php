<!-- Intervention Plans Management (Modular & Responsive Template) -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll & Spacing */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
            border: 1px solid #dee2e6;
        }

        /* Flexible Table Columns - Ample Horizontal Breathing Room */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1280px;
            border-collapse: collapse !important;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle !important;
            padding: 12px 16px !important;
            border-bottom: 1px solid #dee2e6 !important;
            white-space: nowrap;
        }

        .uncompressed-table td.truncate-cell {
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Enhanced Metric Cards Styling */
        .metric-card-enhanced {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem 1.25rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .metric-card-enhanced:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
        }

        /* Status Accent Left Bars */
        .metric-card-enhanced::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .accent-maroon::before { background-color: #58111a; }
        .accent-warning::before { background-color: #ffc107; }
        .accent-primary::before { background-color: #0d6efd; }
        .accent-success::before { background-color: #198754; }

        /* Soft Background Badges for Metric Icons */
        .icon-wrapper-soft {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bg-soft-maroon { background-color: rgba(88, 17, 26, 0.08); color: #58111a; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

        .metric-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        /* Search Pill Input Styling */
        .search-pill-wrapper-short {
            background-color: #ffffff;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            width: 220px !important;
            max-width: 240px !important;
            flex-shrink: 0;
        }

        .search-pill-wrapper-short:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.15rem rgba(88, 17, 26, 0.15);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.85rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        /* Categorized Concern Badges */
        .badge-concern-academic {
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e3f2fd !important;
            color: #0d47a1 !important;
            border: 1px solid #bbdefb !important;
            display: inline-block !important;
        }

        .badge-concern-financial {
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e8f5e9 !important;
            color: #1b5e20 !important;
            border: 1px solid #c8e6c9 !important;
            display: inline-block !important;
        }

        .badge-concern-behavioral {
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #fff3e0 !important;
            color: #e65100 !important;
            border: 1px solid #ffe0b2 !important;
            display: inline-block !important;
        }

        .badge-concern-mental {
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f3e5f5 !important;
            color: #4a148c !important;
            border: 1px solid #e1bee7 !important;
            display: inline-block !important;
        }

        .badge-concern-physical {
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e0f7fa !important;
            color: #006064 !important;
            border: 1px solid #b2ebf2 !important;
            display: inline-block !important;
        }

        /* Status Badges */
        .status-badge-active {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-review {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-completed {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1px solid #198754 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-draft {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        /* Action Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 7px 16px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .btn-view-maroon {
            color: #58111a !important;
            border: 1.5px solid #58111a !important;
            background-color: #ffffff !important;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 6px;
            font-size: 0.825rem;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-view-maroon:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fafbfc;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }

        /* Essential Details View Modal Styling */
        .essential-info-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .essential-label {
            font-size: 0.72rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .essential-value {
            font-size: 0.9rem;
            color: #0f172a;
            font-weight: 600;
        }

        /* Compact Stepper UI */
        .compact-stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 10px 0 4px 0;
        }

        .compact-step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        .compact-step-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.78rem;
            margin-bottom: 4px;
        }

        .compact-step-circle.completed {
            background-color: #10b981;
            color: #fff;
        }

        .compact-step-circle.active {
            background-color: #58111a;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(88, 17, 26, 0.15);
        }

        .compact-step-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #64748b;
        }

        .compact-step-line {
            position: absolute;
            top: 24px;
            left: 10%;
            right: 10%;
            height: 2px;
            background-color: #e2e8f0;
            z-index: 1;
        }
    </style>

    <!-- Breadcrumb Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-3 py-1.5">
                <i class="bi bi-house me-1.5 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT CONCERN & CASE MANAGEMENT</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">INTERVENTION PLANS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Intervention Plans</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 850px;">
            Formulate, monitor, and evaluate tailored intervention strategies across categorized academic, financial, behavioral, mental health, and physical health concerns.
        </p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Active Plans</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalPlans">5</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Records</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-diagram-3-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">In Progress</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricInProgress">2</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Execution</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-play-circle-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Due for Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricDueReview">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Pending Audit</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Completed Plans</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricCompleted">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Closed Cases</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="interventionSearch" class="search-pill-input" placeholder="Search plan ID or student..." oninput="applyInterventionFilters()" autocomplete="off">
            </div>

            <!-- 2. Concern Category Dropdown -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                <select class="form-select form-select-sm filter-select" id="planTypeFilter" onchange="applyInterventionFilters()">
                    <option value="">All Categories</option>
                    <option value="Academic Support">Academic Support</option>
                    <option value="Financial Assistance">Financial Assistance</option>
                    <option value="Behavioral Guidance">Behavioral Guidance</option>
                    <option value="Mental Health & Guidance">Mental Health & Guidance</option>
                    <option value="Physical Health & Medical">Physical Health & Medical</option>
                </select>
            </div>

            <!-- 3. Plan Status Dropdown -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="interventionStatusFilter" onchange="applyInterventionFilters()">
                    <option value="">All Statuses</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Due for Review">Due for Review</option>
                    <option value="Completed">Completed</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>

            <!-- 4. Create Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openNewInterventionModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Create Intervention Plan
            </button>

        </div>
    </div>

    <!-- Categorized Intervention Plans Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="interventionTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 10%;">Plan ID</th>
                    <th class="py-3" style="width: 16%;">Student Name</th>
                    <th class="py-3" style="width: 15%;">Concern Category</th>
                    <th class="py-3" style="width: 22%;">Target Objectives & Action Plan</th>
                    <th class="py-3" style="width: 13%;">Assigned Lead</th>
                    <th class="py-3 text-center" style="width: 11%;">Next Review</th>
                    <th class="py-3 text-center" style="width: 12%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="interventionTableBody">
                <tr class="intervention-row" id="row-ip-2026-0081" data-id="ip-2026-0081" data-student="adamos, mariedhen l." data-category="Financial Assistance" data-status="In Progress">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IP-2026-0081</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td><span class="badge-concern-financial">Financial Assistance</span></td>
                    <td class="text-muted truncate-cell">Emergency grant processing, food voucher allocation, and TDP-TES eligibility review.</td>
                    <td class="text-muted truncate-cell">OSAS Welfare Officer</td>
                    <td class="text-center text-muted text-nowrap">Oct 24, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">In Progress</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IP-2026-0081', 'Adamos, Mariedhen L.', 'Financial Assistance', 'OSAS Welfare Officer', 'Oct 24, 2026', 'In Progress', 'Emergency grant processing, food voucher allocation, and TDP-TES eligibility review.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-ip-2026-0080" data-id="ip-2026-0080" data-student="ali, kyla diane m." data-category="Academic Support" data-status="Due for Review">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IP-2026-0080</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td><span class="badge-concern-academic">Academic Support</span></td>
                    <td class="text-muted truncate-cell">Peer tutoring enrollment, subject remedial sessions, and bi-weekly GPA monitoring check-ins.</td>
                    <td class="text-muted truncate-cell">Academic Coordinator</td>
                    <td class="text-center text-muted text-nowrap">Oct 18, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-review">Due for Review</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IP-2026-0080', 'Ali, Kyla Diane M.', 'Academic Support', 'Academic Coordinator', 'Oct 18, 2026', 'Due for Review', 'Peer tutoring enrollment, subject remedial sessions, and bi-weekly GPA monitoring check-ins.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-ip-2026-0079" data-id="ip-2026-0079" data-student="almonte, hanz andrei r." data-category="Behavioral Guidance" data-status="Completed">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IP-2026-0079</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td><span class="badge-concern-behavioral">Behavioral Guidance</span></td>
                    <td class="text-muted truncate-cell">Attendance agreement contract and structured counseling session program.</td>
                    <td class="text-muted truncate-cell">Case Officer</td>
                    <td class="text-center text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IP-2026-0079', 'Almonte, Hanz Andrei R.', 'Behavioral Guidance', 'Case Officer', 'Oct 12, 2026', 'Completed', 'Attendance agreement contract and structured counseling session program.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-ip-2026-0078" data-id="ip-2026-0078" data-student="villanueva, kim d." data-category="Mental Health & Guidance" data-status="In Progress">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IP-2026-0078</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                    <td><span class="badge-concern-mental">Mental Health & Guidance</span></td>
                    <td class="text-muted truncate-cell">Bi-weekly psychological counseling check-ins, anxiety coping strategies, and academic workload adjustment.</td>
                    <td class="text-muted truncate-cell">Guidance Counselor</td>
                    <td class="text-center text-muted text-nowrap">Oct 28, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">In Progress</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IP-2026-0078', 'Villanueva, Kim D.', 'Mental Health & Guidance', 'Guidance Counselor', 'Oct 28, 2026', 'In Progress', 'Bi-weekly psychological counseling check-ins, anxiety coping strategies, and academic workload adjustment.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-ip-2026-0077" data-id="ip-2026-0077" data-student="aquino, ronald p." data-category="Physical Health & Medical" data-status="Draft">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IP-2026-0077</td>
                    <td class="fw-semibold text-dark truncate-cell">Aquino, Ronald P.</td>
                    <td><span class="badge-concern-physical">Physical Health & Medical</span></td>
                    <td class="text-muted truncate-cell">Post-injury physical therapy follow-ups, physical education activity waiver, and clinic recovery monitoring.</td>
                    <td class="text-muted truncate-cell">Clinic Nurse D. Ilagan</td>
                    <td class="text-center text-muted text-nowrap">Nov 02, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-draft">Draft</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IP-2026-0077', 'Aquino, Ronald P.', 'Physical Health & Medical', 'Clinic Nurse D. Ilagan', 'Nov 02, 2026', 'Draft', 'Post-injury physical therapy follow-ups, physical education activity waiver, and clinic recovery monitoring.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noInterventionRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No intervention plans found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 5 of 5 active intervention plans</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Guidelines Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-shield-check marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Categorized Intervention Protocol</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Intervention plans must be formulated collaboratively across academic, guidance, and medical units. Ensure tailored action metrics, target review timelines, and cross-departmental coordination while upholding strict confidentiality under data privacy policies.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (INTERVENTION PLAN FOCUS)        -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialInterventionModal" tabindex="-1" aria-labelledby="essentialInterventionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">INTERVENTION PLAN DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vPlanId">IP-2026-0081</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activePlanId" value="">

                <!-- 1. Student Beneficiary Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student Name</span>
                        <span class="status-badge-active" id="vStatusBadge">In Progress</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Adamos, Mariedhen L.</h5>
                </div>

                <!-- 2. Plan Key Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Concern Category</div>
                            <div class="essential-value marsu-maroon-text" id="vCategory">Financial Assistance</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Next Review Date</div>
                            <div class="essential-value text-dark" id="vNextReview">Oct 24, 2026</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Assigned Case Lead</div>
                            <div class="essential-value text-dark" id="vAssignedLead">OSAS Welfare Officer</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Intervention Lifecycle Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="ipst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Draft</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="ipst2">2</div>
                            <span class="compact-step-label text-dark fw-bold">In Progress</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="ipst3">3</div>
                            <span class="compact-step-label">Review</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="ipst4">4</div>
                            <span class="compact-step-label">Completed</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Target Objectives & Action Plan -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Target Objectives & Action Plan</div>
                    <div class="small text-dark fw-semibold" id="vActionPlanText">Emergency grant processing, food voucher allocation, and TDP-TES eligibility review.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Intervention Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Draft">Draft</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Due for Review">Due for Review</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialInterventionStatus()">Save Status</button>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2 px-4 justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL 2: CREATE NEW INTERVENTION PLAN                                 -->
<!-- ===================================================================== -->
<div class="modal fade" id="newInterventionModal" tabindex="-1" aria-labelledby="newInterventionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newInterventionModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Create Intervention Plan
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newInterventionForm" onsubmit="saveNewInterventionPlan(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Plan ID</label>
                            <input type="text" class="form-control form-control-sm" id="newPlanId" placeholder="e.g. IP-2026-0082" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Next Review Date</label>
                            <input type="date" class="form-control form-control-sm" id="newNextReview" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Santos, Maria A." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Concern Category</label>
                            <select class="form-select form-select-sm" id="newCategory" required>
                                <option value="Academic Support">Academic Support</option>
                                <option value="Financial Assistance">Financial Assistance</option>
                                <option value="Behavioral Guidance">Behavioral Guidance</option>
                                <option value="Mental Health & Guidance">Mental Health & Guidance</option>
                                <option value="Physical Health & Medical">Physical Health & Medical</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Case Lead</label>
                            <input type="text" class="form-control form-control-sm" id="newAssignedLead" placeholder="e.g. OSAS Welfare Officer" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Plan Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Draft">Draft</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Due for Review">Due for Review</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Target Objectives & Action Plan</label>
                        <textarea class="form-control form-control-sm" id="newActionPlan" rows="3" placeholder="Detail action steps, accommodations, or counseling schedules..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Create Plan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyInterventionFilters() {
        const searchInput = document.getElementById('interventionSearch').value.toLowerCase().trim();
        const categoryFilter = document.getElementById('planTypeFilter').value;
        const statusFilter = document.getElementById('interventionStatusFilter').value;

        const rows = document.querySelectorAll('.intervention-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const student = row.getAttribute('data-student');
            const category = row.getAttribute('data-category');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || student.includes(searchInput);
            const matchesCategory = !categoryFilter || category.toLowerCase() === categoryFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noInterventionRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} active intervention plans`;
        }
    }

    function openEssentialInterventionModal(planId, student, category, assignedLead, nextReview, status, actionPlan) {
        document.getElementById('activePlanId').value = planId.toLowerCase();
        document.getElementById('vPlanId').innerText = planId;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vCategory').innerText = category;
        document.getElementById('vAssignedLead').innerText = assignedLead;
        document.getElementById('vNextReview').innerText = nextReview;
        document.getElementById('vActionPlanText').innerText = actionPlan || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        badgeElem.className = '';

        const lower = status.toLowerCase();
        if (lower === 'in progress') badgeElem.className = 'status-badge-active';
        else if (lower === 'due for review') badgeElem.className = 'status-badge-review';
        else if (lower === 'completed') badgeElem.className = 'status-badge-completed';
        else badgeElem.className = 'status-badge-draft';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('ipst1');
        const st2 = document.getElementById('ipst2');
        const st3 = document.getElementById('ipst3');
        const st4 = document.getElementById('ipst4');

        st1.className = 'compact-step-circle completed';

        if (lower === 'completed') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st4.className = 'compact-step-circle completed';
            st4.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'due for review') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle active';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else if (lower === 'in progress') {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else {
            st1.className = 'compact-step-circle active';
            st1.innerText = '1';
            st2.className = 'compact-step-circle';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialInterventionModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Intervention Plan: ' + planId);
        }
    }

    function saveEssentialInterventionStatus() {
        const activePlanId = document.getElementById('activePlanId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activePlanId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-draft';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'in progress') newBadgeClass = 'status-badge-active';
            else if (lowerStatus === 'due for review') newBadgeClass = 'status-badge-review';
            else if (lowerStatus === 'completed') newBadgeClass = 'status-badge-completed';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const planIdText = targetRow.cells[0].innerText;
                const studentText = targetRow.cells[1].innerText;
                const categoryText = targetRow.cells[2].innerText.trim();
                const actionPlanText = targetRow.cells[3].innerText;
                const leadText = targetRow.cells[4].innerText;
                const reviewText = targetRow.cells[5].innerText;

                viewBtn.setAttribute('onclick', `openEssentialInterventionModal('${planIdText}', '${studentText}', '${categoryText}', '${leadText}', '${reviewText}', '${newStatus}', '${actionPlanText}')`);
            }
        }

        const modalElem = document.getElementById('essentialInterventionModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyInterventionFilters();

        alert('Intervention plan status successfully updated!');
    }

    function openNewInterventionModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newInterventionModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Create Intervention Plan Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.intervention-row');
        let totalPlans = rows.length;
        let inProgressCount = 0;
        let dueReviewCount = 0;
        let completedCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();

            if (status === 'in progress') {
                inProgressCount++;
            } else if (status === 'due for review') {
                dueReviewCount++;
            } else if (status === 'completed') {
                completedCount++;
            }
        });

        document.getElementById('metricTotalPlans').innerText = totalPlans;
        document.getElementById('metricInProgress').innerText = inProgressCount;
        document.getElementById('metricDueReview').innerText = dueReviewCount;
        document.getElementById('metricCompleted').innerText = completedCount;
    }

    function saveNewInterventionPlan(e) {
        e.preventDefault();

        const planId = document.getElementById('newPlanId').value.trim();
        const rawDate = document.getElementById('newNextReview').value;
        const student = document.getElementById('newStudentName').value.trim();
        const category = document.getElementById('newCategory').value;
        const assignedLead = document.getElementById('newAssignedLead').value.trim();
        const status = document.getElementById('newStatus').value;
        const actionPlan = document.getElementById('newActionPlan').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-draft';
        let categoryBadgeClass = 'badge-concern-academic';

        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'in progress') badgeClass = 'status-badge-active';
        else if (lowerStatus === 'due for review') badgeClass = 'status-badge-review';
        else if (lowerStatus === 'completed') badgeClass = 'status-badge-completed';

        const lowerCat = category.toLowerCase();
        if (lowerCat.includes('financial')) categoryBadgeClass = 'badge-concern-financial';
        else if (lowerCat.includes('behavioral')) categoryBadgeClass = 'badge-concern-behavioral';
        else if (lowerCat.includes('mental')) categoryBadgeClass = 'badge-concern-mental';
        else if (lowerCat.includes('physical')) categoryBadgeClass = 'badge-concern-physical';

        const rowId = 'row-' + planId.toLowerCase();
        const tbody = document.getElementById('interventionTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'intervention-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', planId.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-category', category);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${planId}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="${categoryBadgeClass}">${category}</span></td>
            <td class="text-muted truncate-cell">${actionPlan}</td>
            <td class="text-muted truncate-cell">${assignedLead}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('${planId}', '${student}', '${category}', '${assignedLead}', '${formattedDate}', '${status}', '${actionPlan}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newInterventionModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newInterventionForm').reset();

        recalculateMetrics();
        applyInterventionFilters();
    }
</script>