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
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
        }

        /* Flexible Table Columns - No Hard Compression */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1200px;
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

        /* Filter Selects */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
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
            background-color: #fcfcfd;
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
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalPrograms">4</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Initiatives</div>
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
                    <div class="fs-2 fw-bold text-success lh-1" id="metricBeneficiaries">1,240</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Total Enrolled</div>
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
                    <div class="metric-label mb-1">Open Applications</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricOpen">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Accepting Intake</div>
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
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricReview">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Evaluating Scope</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
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
                <input type="search" id="programSearch" class="search-pill-input" placeholder="Search program or code..." oninput="applyProgramFilters()" autocomplete="off">
            </div>

            <!-- 2. Category Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                <select class="form-select form-select-sm filter-select" id="categoryFilter" onchange="applyProgramFilters()">
                    <option value="">All Categories</option>
                    <option value="Financial & Grants">Financial & Grants</option>
                    <option value="Academic Support">Academic Support</option>
                    <option value="Transportation & Housing">Transportation & Housing</option>
                    <option value="Health & Wellness">Health & Wellness</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="programStatusFilter" onchange="applyProgramFilters()">
                    <option value="">All Statuses</option>
                    <option value="Accepting Applications">Accepting Applications</option>
                    <option value="Active Services">Active Services</option>
                    <option value="Under Review">Under Review</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <!-- 4. Add New Program Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openNewProgramModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add New Program
            </button>

        </div>
    </div>

    <!-- Student Support Programs Table -->
    <div class="table-responsive-custom bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="programTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 10%;">Code</th>
                    <th class="py-3" style="width: 18%;">Program Title</th>
                    <th class="py-3" style="width: 14%;">Category</th>
                    <th class="py-3" style="width: 22%;">Scope & Objectives</th>
                    <th class="py-3 text-center" style="width: 11%;">Beneficiaries</th>
                    <th class="py-3" style="width: 13%;">Coordinator</th>
                    <th class="py-3 text-center" style="width: 13%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="programTableBody">
                <tr class="program-row" id="row-sp-2026-001" data-code="sp-2026-001" data-title="student emergency relief fund" data-category="Financial & Grants" data-status="Accepting Applications" data-count="342">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-001</td>
                    <td class="fw-semibold text-dark truncate-cell">Student Emergency Relief Fund</td>
                    <td><span class="badge-category">Financial & Grants</span></td>
                    <td class="text-muted truncate-cell">Provides micro-grants and emergency stipends for sudden financial hardship or disasters.</td>
                    <td class="text-center fw-bold text-dark">342</td>
                    <td class="text-muted truncate-cell">OSAS Financial Services</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-accepting">Accepting Applications</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgramModal('SP-2026-001', 'Student Emergency Relief Fund', 'Financial & Grants', '342', 'OSAS Financial Services', 'Accepting Applications', 'Provides micro-grants and emergency stipends for sudden financial hardship or disasters.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="program-row" id="row-sp-2026-002" data-code="sp-2026-002" data-title="peer-to-peer academic mentorship" data-category="Academic Support" data-status="Active Services" data-count="185">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-002</td>
                    <td class="fw-semibold text-dark truncate-cell">Peer-to-Peer Academic Mentorship</td>
                    <td><span class="badge-category">Academic Support</span></td>
                    <td class="text-muted truncate-cell">Pairs at-risk students with upperclassmen tutors for course adjustments and study habits.</td>
                    <td class="text-center fw-bold text-dark">185</td>
                    <td class="text-muted truncate-cell">Guidance Counseling Unit</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">Active Services</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgramModal('SP-2026-002', 'Peer-to-Peer Academic Mentorship', 'Academic Support', '185', 'Guidance Counseling Unit', 'Active Services', 'Pairs at-risk students with upperclassmen tutors for course adjustments and study habits.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="program-row" id="row-sp-2026-003" data-code="sp-2026-003" data-title="campus shuttle & commuter aid" data-category="Transportation & Housing" data-status="Under Review" data-count="520">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-003</td>
                    <td class="fw-semibold text-dark truncate-cell">Campus Shuttle & Commuter Aid</td>
                    <td><span class="badge-category">Transportation & Housing</span></td>
                    <td class="text-muted truncate-cell">Subsidizes local transport costs for low-income commuters living in remote barangays.</td>
                    <td class="text-center fw-bold text-dark">520</td>
                    <td class="text-muted truncate-cell">Student Affairs Staff</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-review">Under Review</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgramModal('SP-2026-003', 'Campus Shuttle & Commuter Aid', 'Transportation & Housing', '520', 'Student Affairs Staff', 'Under Review', 'Subsidizes local transport costs for low-income commuters living in remote barangays.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="program-row" id="row-sp-2026-004" data-code="sp-2026-004" data-title="mental health & wellness check-in" data-category="Health & Wellness" data-status="Active Services" data-count="193">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SP-2026-004</td>
                    <td class="fw-semibold text-dark truncate-cell">Mental Health & Wellness Check-in</td>
                    <td><span class="badge-category">Health & Wellness</span></td>
                    <td class="text-muted truncate-cell">Conducts routine mental wellness assessments, stress management workshops, and group counseling.</td>
                    <td class="text-center fw-bold text-dark">193</td>
                    <td class="text-muted truncate-cell">Guidance Office</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">Active Services</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgramModal('SP-2026-004', 'Mental Health & Wellness Check-in', 'Health & Wellness', '193', 'Guidance Office', 'Active Services', 'Conducts routine mental wellness assessments, stress management workshops, and group counseling.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noProgramRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No student support programs found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 active support programs</span>
        <span>Page 1 of 1</span>
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

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (PROGRAM FOCUS)                   -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialProgramModal" tabindex="-1" aria-labelledby="essentialProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">SUPPORT PROGRAM OVERVIEW</span>
                    <h5 class="modal-title fw-bold mb-0" id="vProgramCode">SP-2026-001</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeProgramCode" value="">

                <!-- 1. Program Header Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Program Title</span>
                        <span class="status-badge-accepting" id="vStatusBadge">Accepting Applications</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vProgramTitle">Student Emergency Relief Fund</h5>
                </div>

                <!-- 2. Program Details Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Category</div>
                            <div class="essential-value marsu-maroon-text" id="vCategory">Financial & Grants</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Active Beneficiaries</div>
                            <div class="essential-value text-success" id="vBeneficiaries">342</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Assigned Coordinator</div>
                            <div class="essential-value text-dark" id="vCoordinator">OSAS Financial Services</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Program Lifecycle Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="pst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Draft</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="pst2"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Review</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="pst3">3</div>
                            <span class="compact-step-label text-dark fw-bold">Active / Intake</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="pst4">4</div>
                            <span class="compact-step-label">Evaluation</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Scope & Objectives -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Scope & Objectives</div>
                    <div class="small text-dark" id="vScopeText">Provides micro-grants and emergency stipends for sudden financial hardship or disasters.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Service Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Accepting Applications">Accepting Applications</option>
                            <option value="Active Services">Active Services</option>
                            <option value="Under Review">Under Review</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialProgramStatus()">Save Status</button>
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
<!-- MODAL 2: ADD NEW STUDENT SUPPORT PROGRAM                              -->
<!-- ===================================================================== -->
<div class="modal fade" id="newProgramModal" tabindex="-1" aria-labelledby="newProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newProgramModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Add New Support Program
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newProgramForm" onsubmit="saveNewProgram(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Program Code</label>
                            <input type="text" class="form-control form-control-sm" id="newCode" placeholder="e.g. SP-2026-005" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Category</label>
                            <select class="form-select form-select-sm" id="newCategory" required>
                                <option value="Financial & Grants">Financial & Grants</option>
                                <option value="Academic Support">Academic Support</option>
                                <option value="Transportation & Housing">Transportation & Housing</option>
                                <option value="Health & Wellness">Health & Wellness</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Program Title</label>
                        <input type="text" class="form-control form-control-sm" id="newTitle" placeholder="e.g. Student Laptop & Connectivity Assistance" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Coordinator</label>
                            <input type="text" class="form-control form-control-sm" id="newCoordinator" placeholder="e.g. OSAS Welfare Office" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Initial Beneficiaries</label>
                            <input type="number" class="form-control form-control-sm" id="newCount" placeholder="e.g. 50" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Program Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Accepting Applications">Accepting Applications</option>
                            <option value="Active Services">Active Services</option>
                            <option value="Under Review">Under Review</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Scope & Objectives</label>
                        <textarea class="form-control form-control-sm" id="newScope" rows="3" placeholder="Brief explanation of goals and scope..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Program</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyProgramFilters() {
        const searchInput = document.getElementById('programSearch').value.toLowerCase().trim();
        const categoryFilter = document.getElementById('categoryFilter').value;
        const statusFilter = document.getElementById('programStatusFilter').value;

        const rows = document.querySelectorAll('.program-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const code = row.getAttribute('data-code');
            const title = row.getAttribute('data-title');
            const category = row.getAttribute('data-category');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || code.includes(searchInput) || title.includes(searchInput);
            const matchesCategory = !categoryFilter || category.toLowerCase() === categoryFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noProgramRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} active support programs`;
        }
    }

    function openEssentialProgramModal(code, title, category, count, coordinator, status, scope) {
        document.getElementById('activeProgramCode').value = code.toLowerCase();
        document.getElementById('vProgramCode').innerText = code;
        document.getElementById('vProgramTitle').innerText = title;
        document.getElementById('vCategory').innerText = category;
        document.getElementById('vBeneficiaries').innerText = Number(count).toLocaleString();
        document.getElementById('vCoordinator').innerText = coordinator;
        document.getElementById('vScopeText').innerText = scope || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        badgeElem.className = '';

        const lower = status.toLowerCase();
        if (lower === 'accepting applications') badgeElem.className = 'status-badge-accepting';
        else if (lower === 'active services') badgeElem.className = 'status-badge-active';
        else if (lower === 'under review') badgeElem.className = 'status-badge-review';
        else badgeElem.className = 'status-badge-inactive';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('pst1');
        const st2 = document.getElementById('pst2');
        const st3 = document.getElementById('pst3');
        const st4 = document.getElementById('pst4');

        st1.className = 'compact-step-circle completed';
        st2.className = 'compact-step-circle completed';

        if (lower === 'active services' || lower === 'accepting applications') {
            st3.className = 'compact-step-circle active';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else if (lower === 'under review') {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else {
            st4.className = 'compact-step-circle active';
            st4.innerText = '4';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialProgramModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Program Details: ' + code);
        }
    }

    function saveEssentialProgramStatus() {
        const activeCode = document.getElementById('activeProgramCode').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeCode);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-inactive';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'accepting applications') newBadgeClass = 'status-badge-accepting';
            else if (lowerStatus === 'active services') newBadgeClass = 'status-badge-active';
            else if (lowerStatus === 'under review') newBadgeClass = 'status-badge-review';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const codeText = targetRow.cells[0].innerText;
                const titleText = targetRow.cells[1].innerText;
                const categoryText = targetRow.cells[2].innerText.trim();
                const scopeText = targetRow.cells[3].innerText;
                const countText = targetRow.cells[4].innerText.replace(/,/g, '');
                const coordinatorText = targetRow.cells[5].innerText;

                viewBtn.setAttribute('onclick', `openEssentialProgramModal('${codeText}', '${titleText}', '${categoryText}', '${countText}', '${coordinatorText}', '${newStatus}', '${scopeText}')`);
            }
        }

        const modalElem = document.getElementById('essentialProgramModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyProgramFilters();

        alert('Program status successfully updated!');
    }

    function openNewProgramModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newProgramModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add New Support Program Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.program-row');
        let totalPrograms = rows.length;
        let totalBeneficiaries = 0;
        let openCount = 0;
        let reviewCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();
            const count = parseInt(row.getAttribute('data-count'), 10) || 0;

            totalBeneficiaries += count;

            if (status === 'accepting applications') {
                openCount++;
            } else if (status === 'under review') {
                reviewCount++;
            }
        });

        document.getElementById('metricTotalPrograms').innerText = totalPrograms;
        document.getElementById('metricBeneficiaries').innerText = totalBeneficiaries.toLocaleString();
        document.getElementById('metricOpen').innerText = openCount;
        document.getElementById('metricReview').innerText = reviewCount;
    }

    function saveNewProgram(e) {
        e.preventDefault();

        const code = document.getElementById('newCode').value.trim();
        const category = document.getElementById('newCategory').value;
        const title = document.getElementById('newTitle').value.trim();
        const coordinator = document.getElementById('newCoordinator').value.trim();
        const count = parseInt(document.getElementById('newCount').value, 10) || 0;
        const status = document.getElementById('newStatus').value;
        const scope = document.getElementById('newScope').value.trim();

        let badgeClass = 'status-badge-inactive';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'accepting applications') badgeClass = 'status-badge-accepting';
        else if (lowerStatus === 'active services') badgeClass = 'status-badge-active';
        else if (lowerStatus === 'under review') badgeClass = 'status-badge-review';

        const rowId = 'row-' + code.toLowerCase();
        const tbody = document.getElementById('programTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'program-row';
        newTr.id = rowId;
        newTr.setAttribute('data-code', code.toLowerCase());
        newTr.setAttribute('data-title', title.toLowerCase());
        newTr.setAttribute('data-category', category);
        newTr.setAttribute('data-status', status);
        newTr.setAttribute('data-count', count);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${code}</td>
            <td class="fw-semibold text-dark truncate-cell">${title}</td>
            <td><span class="badge-category">${category}</span></td>
            <td class="text-muted truncate-cell">${scope}</td>
            <td class="text-center fw-bold text-dark">${count.toLocaleString()}</td>
            <td class="text-muted truncate-cell">${coordinator}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgramModal('${code}', '${title}', '${category}', '${count}', '${coordinator}', '${status}', '${scope}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newProgramModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newProgramForm').reset();

        recalculateMetrics();
        applyProgramFilters();
    }
</script>