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
        }

        /* Flexible Table Columns - Ample Horizontal Breathing Room */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1280px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important;
            word-break: break-word;
            padding: 14px 18px !important;
            line-height: 1.5;
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

        /* Spacious Toolbar Controls Card */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1.25rem !important;
            margin-bottom: 1.75rem !important;
        }

        /* Search Pill Input - Fully Aligned */
        .search-pill-wrapper {
            background-color: #ffffff;
            border: 1.5px solid #e2d8d8;
            border-radius: 50rem !important;
            padding: 7px 18px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            min-width: 240px;
            flex-grow: 1;
        }

        .search-pill-wrapper:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.2rem rgba(88, 17, 26, 0.12);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.875rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 170px;
            padding: 7px 12px !important;
            font-size: 0.875rem !important;
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
            padding: 6px 14px !important;
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
            padding: 6px 14px !important;
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
            padding: 6px 14px !important;
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
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        /* Primary Action Button */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fafbfc;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
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
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">12</div>
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
                    <div class="fs-2 fw-bold text-primary lh-1">7</div>
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
                    <div class="fs-2 fw-bold text-dark lh-1">3</div>
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
                    <div class="fs-2 fw-bold text-success lh-1">15</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Single-Row Aligned Toolbar (Search, Filters, Button) -->
    <div class="card toolbar-card shadow-sm">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Search Bar -->
            <div class="search-pill-wrapper me-2">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="interventionSearch" class="search-pill-input" placeholder="Search plan ID, student, concern, or officer..." oninput="filterTable('interventionSearch','interventionTable')" autocomplete="off">
            </div>

            <!-- Concern Category Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                <select class="form-select form-select-sm filter-select" id="planTypeFilter">
                    <option value="">All Categories</option>
                    <option value="Academic Support">Academic Support</option>
                    <option value="Financial Assistance">Financial Assistance</option>
                    <option value="Behavioral Guidance">Behavioral Guidance</option>
                    <option value="Mental Health">Mental Health & Guidance</option>
                    <option value="Physical Health">Physical Health & Medical</option>
                </select>
            </div>

            <!-- Plan Status Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="interventionStatus" onchange="filterStatus('interventionStatus','interventionTable',6)">
                    <option value="">All Statuses</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Due for Review">Due for Review</option>
                    <option value="Completed">Completed</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>

            <!-- Create Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="openModal('modalNewInterventionPlan')">
                <i class="bi bi-plus-circle icon-shrink-0"></i> Create Intervention Plan
            </button>

        </div>
    </div>

    <!-- Categorized Intervention Plans Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="interventionTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 10%;">Plan ID</th>
                    <th class="py-3.5" style="width: 16%;">Student Name</th>
                    <th class="py-3.5" style="width: 15%;">Concern Category</th>
                    <th class="py-3.5" style="width: 23%;">Target Objectives & Action Plan</th>
                    <th class="py-3.5" style="width: 13%;">Assigned Lead</th>
                    <th class="py-3.5" style="width: 11%;">Next Review</th>
                    <th class="py-3.5 text-center pe-4" style="width: 12%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">IP-2026-0081</td>
                    <td class="fw-semibold text-dark">Adamos, Mariedhen L.</td>
                    <td>
                        <span class="badge-concern-financial">Financial Assistance</span>
                    </td>
                    <td class="text-muted">Emergency grant processing, food voucher allocation, and TDP-TES eligibility review.</td>
                    <td class="text-muted">OSAS Welfare Officer</td>
                    <td class="text-muted text-nowrap">Oct 24, 2026</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-active">In Progress</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">IP-2026-0080</td>
                    <td class="fw-semibold text-dark">Ali, Kyla Diane M.</td>
                    <td>
                        <span class="badge-concern-academic">Academic Support</span>
                    </td>
                    <td class="text-muted">Peer tutoring enrollment, subject remedial sessions, and bi-weekly GPA monitoring check-ins.</td>
                    <td class="text-muted">Academic Coordinator</td>
                    <td class="text-muted text-nowrap">Oct 18, 2026</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-review">Due for Review</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">IP-2026-0079</td>
                    <td class="fw-semibold text-dark">Almonte, Hanz Andrei R.</td>
                    <td>
                        <span class="badge-concern-behavioral">Behavioral Guidance</span>
                    </td>
                    <td class="text-muted">Attendance agreement contract and structured counseling session program.</td>
                    <td class="text-muted">Case Officer</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">IP-2026-0078</td>
                    <td class="fw-semibold text-dark">Villanueva, Kim D.</td>
                    <td>
                        <span class="badge-concern-mental">Mental Health & Guidance</span>
                    </td>
                    <td class="text-muted">Bi-weekly psychological counseling check-ins, anxiety coping strategies, and academic workload adjustment.</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-muted text-nowrap">Oct 28, 2026</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-active">In Progress</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">IP-2026-0077</td>
                    <td class="fw-semibold text-dark">Aquino, Ronald P.</td>
                    <td>
                        <span class="badge-concern-physical">Physical Health & Medical</span>
                    </td>
                    <td class="text-muted">Post-injury physical therapy follow-ups, physical education activity waiver, and clinic recovery monitoring.</td>
                    <td class="text-muted">Clinic Nurse D. Ilagan</td>
                    <td class="text-muted text-nowrap">Nov 02, 2026</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-draft">Draft</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 5 of 12 active intervention plans</span>
        <span>Page 1 of 3</span>
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