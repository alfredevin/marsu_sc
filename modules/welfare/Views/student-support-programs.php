<!-- Student Support Programs Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Flexible Table Columns - No Hard Compression */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1200px; /* Guarantees comfortable breathing room for all columns */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important; /* Allows long descriptions to wrap naturally */
            word-break: break-word;
            padding: 12px 14px !important;
            line-height: 1.45;
        }

        /* Metric Cards Styling */
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
        .accent-success::before { background-color: #198754; }
        .accent-primary::before { background-color: #0d6efd; }
        .accent-warning::before { background-color: #ffc107; }

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
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }

        .metric-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        /* Search Pill Input Styling */
        .search-pill-wrapper {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 6px 18px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            min-width: 280px;
            flex-grow: 1;
            max-width: 380px;
        }

        .search-pill-wrapper:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.15rem rgba(88, 17, 26, 0.15);
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

        /* Filter Selects */
        .filter-select {
            width: auto !important;
            min-width: 150px;
        }

        /* Category Badges */
        .badge-category {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8f9fa !important;
            color: #495057 !important;
            border: 1px solid #dcdcdc !important;
            display: inline-block !important;
        }

        /* Program Status Badges */
        .status-badge-active {
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

        .status-badge-accepting {
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

        .status-badge-inactive {
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
            font-size: 0.875rem;
            padding: 7px 18px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fcfcfd;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }
    </style>

    <!-- Breadcrumb Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center">
                <i class="bi bi-house me-1 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT WELFARE & SERVICES</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">STUDENT SUPPORT PROGRAMS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Student Support Programs</h4>
        <p class="text-muted small mb-0">Manage institutional support initiatives, eligibility criteria, student enrollment, and active welfare services.</p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Active Programs -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Programs</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">8</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-grid-1x2-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Total Enrolled Beneficiaries -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Beneficiaries</div>
                    <div class="fs-2 fw-bold text-success lh-1">1,240</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Open Applications -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Open for Application</div>
                    <div class="fs-2 fw-bold text-primary lh-1">3</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-folder-plus fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Pending Evaluation -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Under Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1">2</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="programSearch" class="search-pill-input" placeholder="Search program title, category, or coordinator..." oninput="filterTable('programSearch','programTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                    <select class="form-select form-select-sm filter-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Financial & Grants">Financial & Grants</option>
                        <option value="Academic Support">Academic Support</option>
                        <option value="Health & Wellness">Health & Wellness</option>
                        <option value="Transportation & Housing">Transportation & Housing</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="programStatus" onchange="filterStatus('programStatus','programTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Active">Active Services</option>
                        <option value="Accepting Applications">Accepting Applications</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="openModal('modalNewSupportProgram')">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add New Program
                </button>
            </div>
        </div>
    </div>

    <!-- Student Support Programs Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="programTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 10%;">Code</th>
                    <th class="py-3" style="width: 18%;">Program Title</th>
                    <th class="py-3" style="width: 14%;">Category</th>
                    <th class="py-3" style="width: 22%;">Scope & Objectives</th>
                    <th class="py-3 text-center" style="width: 14%;">Beneficiaries</th>
                    <th class="py-3" style="width: 15%;">Coordinator</th>
                    <th class="py-3 text-center" style="width: 13%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-001</td>
                    <td class="fw-semibold text-dark">Student Emergency Relief Fund</td>
                    <td>
                        <span class="badge-category">Financial & Grants</span>
                    </td>
                    <td class="text-muted">Provides micro-grants and emergency stipends for sudden financial hardship or disasters.</td>
                    <td class="text-center fw-bold text-dark">342</td>
                    <td class="text-muted">OSAS Financial Services</td>
                    <td class="text-center">
                        <span class="status-badge-accepting">Accepting Applications</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-002</td>
                    <td class="fw-semibold text-dark">Peer-to-Peer Academic Mentorship</td>
                    <td>
                        <span class="badge-category">Academic Support</span>
                    </td>
                    <td class="text-muted">Pairs at-risk students with upperclassmen tutors for course adjustments and study habits.</td>
                    <td class="text-center fw-bold text-dark">185</td>
                    <td class="text-muted">Guidance Counseling Unit</td>
                    <td class="text-center">
                        <span class="status-badge-active">Active Services</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-003</td>
                    <td class="fw-semibold text-dark">Campus Shuttle & Commuter Aid</td>
                    <td>
                        <span class="badge-category">Transportation & Housing</span>
                    </td>
                    <td class="text-muted">Subsidizes local transport costs for low-income commuters living in remote barangays.</td>
                    <td class="text-center fw-bold text-dark">520</td>
                    <td class="text-muted">Student Affairs Staff</td>
                    <td class="text-center">
                        <span class="status-badge-review">Under Review</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-004</td>
                    <td class="fw-semibold text-dark">Mental Health & Wellness Check-in</td>
                    <td>
                        <span class="badge-category">Health & Wellness</span>
                    </td>
                    <td class="text-muted">Conducts routine mental wellness assessments, stress management workshops, and group counseling.</td>
                    <td class="text-center fw-bold text-dark">193</td>
                    <td class="text-muted">Guidance Office</td>
                    <td class="text-center">
                        <span class="status-badge-active">Active Services</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 8 active support programs</span>
        <span>Page 1 of 2</span>
    </div>

    <!-- Program Management Guidelines Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-heart-pulse-fill marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Support Program Governance Framework</h6>
                <p class="text-muted small mb-0">
                    All support programs must align with OSAS student welfare standards. Coordinators are required to log beneficiary eligibility, maintain data confidentiality, update active rosters monthly, and submit semester-end impact evaluation reports.
                </p>
            </div>
        </div>
    </div>

</div>