<!-- OSAS Financial Aid & Scholarship Grant Management -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
            border: 1px solid #dee2e6;
        }

        /* Uncompressed Table */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1220px;
            border-collapse: collapse !important;
        }

        .uncompressed-table th, 
        .uncompressed-table td {
            vertical-align: middle !important;
            padding: 14px 18px !important;
            border-bottom: 1px solid #dee2e6 !important;
            white-space: nowrap;
        }

        .uncompressed-table td.truncate-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Metric Cards */
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

        /* Toolbar Controls Card */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1rem 1.25rem !important;
            margin-bottom: 1.75rem !important;
        }

        /* Search Pill Input */
        .search-pill-wrapper-short {
            background-color: #ffffff;
            border: 1.5px solid #e2d8d8;
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
            box-shadow: 0 0 0 0.2rem rgba(88, 17, 26, 0.12);
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

        /* Compact Filter Select Dropdowns */
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

        /* Status Badges */
        .status-badge-disbursed {
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

        .status-badge-processing {
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

        .status-badge-pending {
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

        /* Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 7px 16px;
            border-radius: 8px;
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

        /* ================================================================= */
        /* ESSENTIAL DETAILS VIEW MODAL STYLES                               */
        /* ================================================================= */
        .essential-info-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
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
            padding: 10px 0;
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
            <span class="small fw-bold text-secondary">SCHOLARSHIP & FINANCIAL AID</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">DISBURSEMENT RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Financial Assistance & Grant Management</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 850px;">
            Manage and track institutional scholarship distributions, TDP-TES grants, emergency financial aid disbursements, and beneficiary payroll processing.
        </p>
    </div>

    <!-- Executive KPI Metrics Summary Grid -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Beneficiaries</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricBeneficiaries">1,240</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Current Semester</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Disbursed</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricDisbursed">₱23,000</div>
                    <div class="small text-success fw-semibold mt-1" style="font-size: 0.75rem;"><i class="bi bi-check-circle me-1"></i> Release Active</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">In Processing</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricProcessing">₱5,000</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Payroll Pending</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Clearance</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricPending">₱10,000</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Awaiting Review</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-shield-plus fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="card toolbar-card shadow-sm">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="grantSearch" class="search-pill-input" placeholder="Search student or grant ID..." oninput="applyGrantFilters()" autocomplete="off">
            </div>

            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Program Type:</label>
                <select class="form-select form-select-sm filter-select" id="programTypeFilter" onchange="applyGrantFilters()">
                    <option value="">All Programs</option>
                    <option value="TDP-TES Grant">TDP-TES Grant</option>
                    <option value="CHED StuFAP">CHED StuFAP</option>
                    <option value="Institutional Scholarship">Institutional Scholarship</option>
                    <option value="Emergency Assistance">Emergency Assistance</option>
                </select>
            </div>

            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Disbursement Status:</label>
                <select class="form-select form-select-sm filter-select" id="disbursementStatusFilter" onchange="applyGrantFilters()">
                    <option value="">All Statuses</option>
                    <option value="Disbursed">Disbursed</option>
                    <option value="Processing">Processing</option>
                    <option value="Pending Clearance">Pending Clearance</option>
                </select>
            </div>

            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2 flex-shrink-0" onclick="openAddGrantModal()">
                <i class="bi bi-plus-circle icon-shrink-0"></i> Record Financial Grant
            </button>

        </div>
    </div>

    <!-- Financial Grants & Disbursement Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="grantTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 12%;">Grant ID</th>
                    <th class="py-3.5" style="width: 18%;">Student Name</th>
                    <th class="py-3.5" style="width: 18%;">Program Type</th>
                    <th class="py-3.5 text-center" style="width: 12%;">Amount</th>
                    <th class="py-3.5" style="width: 14%;">Disbursement Date</th>
                    <th class="py-3.5" style="width: 14%;">Disbursing Officer</th>
                    <th class="py-3.5 text-center" style="width: 12%;">Status</th>
                    <th class="py-3.5 text-center pe-4" style="width: 8%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="grantTableBody">
                <tr class="grant-row" id="row-gnt-2026-089" data-id="gnt-2026-089" data-student="reyes, janine c." data-program="TDP-TES Grant" data-status="Disbursed" data-amount="15000">
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-089</td>
                    <td class="fw-semibold text-dark truncate-cell">Reyes, Janine C.</td>
                    <td><span class="badge-category">TDP-TES Grant</span></td>
                    <td class="text-center fw-bold text-dark">₱15,000.00</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-muted">OSAS Aid Officer</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-disbursed">Disbursed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('GNT-2026-089', 'Reyes, Janine C.', 'TDP-TES Grant', '₱15,000.00', 'Oct 12, 2026', 'OSAS Aid Officer', 'Disbursed', 'BS Information Systems', 'College of Info & Comm Tech')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="grant-row" id="row-gnt-2026-088" data-id="gnt-2026-088" data-student="mendoza, carlos p." data-program="Emergency Assistance" data-status="Processing" data-amount="5000">
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-088</td>
                    <td class="fw-semibold text-dark truncate-cell">Mendoza, Carlos P.</td>
                    <td><span class="badge-category">Emergency Assistance</span></td>
                    <td class="text-center fw-bold text-dark">₱5,000.00</td>
                    <td class="text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-muted">OSAS Finance Lead</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-processing">Processing</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('GNT-2026-088', 'Mendoza, Carlos P.', 'Emergency Assistance', '₱5,000.00', 'Oct 10, 2026', 'OSAS Finance Lead', 'Processing', 'BS Civil Engineering', 'College of Engineering & Tech')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="grant-row" id="row-gnt-2026-087" data-id="gnt-2026-087" data-student="dizon, maria s." data-program="Institutional Scholarship" data-status="Disbursed" data-amount="8000">
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-087</td>
                    <td class="fw-semibold text-dark truncate-cell">Dizon, Maria S.</td>
                    <td><span class="badge-category">Institutional Scholarship</span></td>
                    <td class="text-center fw-bold text-dark">₱8,000.00</td>
                    <td class="text-muted text-nowrap">Oct 05, 2026</td>
                    <td class="text-muted">OSAS Aid Officer</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-disbursed">Disbursed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('GNT-2026-087', 'Dizon, Maria S.', 'Institutional Scholarship', '₱8,000.00', 'Oct 05, 2026', 'OSAS Aid Officer', 'Disbursed', 'BS Accountancy', 'College of Business & Accountancy')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="grant-row" id="row-gnt-2026-086" data-id="gnt-2026-086" data-student="gonzales, mark l." data-program="CHED StuFAP" data-status="Pending Clearance" data-amount="10000">
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-086</td>
                    <td class="fw-semibold text-dark truncate-cell">Gonzales, Mark L.</td>
                    <td><span class="badge-category">CHED StuFAP</span></td>
                    <td class="text-center fw-bold text-dark">₱10,000.00</td>
                    <td class="text-muted text-nowrap">Sep 28, 2026</td>
                    <td class="text-muted">OSAS Finance Lead</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-pending">Pending Clearance</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('GNT-2026-086', 'Gonzales, Mark L.', 'CHED StuFAP', '₱10,000.00', 'Sep 28, 2026', 'OSAS Finance Lead', 'Pending Clearance', 'BSED English', 'College of Education')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noGrantRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No financial grant records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 1,240 financial grant entries</span>
        <span>Page 1 of 310</span>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL: ESSENTIAL DETAILS ONLY VIEW (STREAMLINED & CLEAN)              -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialViewModal" tabindex="-1" aria-labelledby="essentialViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <!-- Modal Header -->
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">GRANT DETAILS & OVERVIEW</span>
                    <h5 class="modal-title fw-bold mb-0" id="vGrantId">GNT-2026-089</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body (Important Details Only) -->
            <div class="modal-body p-4 bg-light-subtle">
                
                <!-- 1. Student Summary Box -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="essential-label">Student Beneficiary</span>
                        <span class="status-badge-disbursed" id="vStatusBadge">Disbursed</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-1" id="vStudentName">Reyes, Janine C.</h5>
                    <div class="text-muted small" id="vCourseCollege">BS Information Systems &bull; College of Info & Comm Tech</div>
                </div>

                <!-- 2. Grant Key Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Program Type</div>
                            <div class="essential-value marsu-maroon-text" id="vProgramType">TDP-TES Grant</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Grant Amount</div>
                            <div class="essential-value text-success" id="vAmount">₱15,000.00</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Disbursement Date</div>
                            <div class="essential-value" id="vDate">Oct 12, 2026</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Disbursing Officer</div>
                            <div class="essential-value" id="vOfficer">OSAS Aid Officer</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Disbursement Process Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="st1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Eligibility</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="st2"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Verification</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="st3"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Approval</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="st4">4</div>
                            <span class="compact-step-label text-dark fw-bold">Disbursement</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Status Stage</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Disbursed">Disbursed (Completed Release)</option>
                            <option value="Processing">Processing Payroll</option>
                            <option value="Pending Clearance">Pending Clearance</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialStatus()">Save</button>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light py-2 px-4 justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL 2: RECORD FINANCIAL GRANT ENTRY                                 -->
<!-- ===================================================================== -->
<div class="modal fade" id="addGrantModal" tabindex="-1" aria-labelledby="addGrantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addGrantModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Record Financial Grant
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addGrantForm" onsubmit="saveNewGrant(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Grant ID</label>
                            <input type="text" class="form-control form-control-sm" id="newGrantId" placeholder="e.g. GNT-2026-090" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Disbursement Date</label>
                            <input type="date" class="form-control form-control-sm" id="newDate" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Santos, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Program Type</label>
                            <select class="form-select form-select-sm" id="newProgramType" required>
                                <option value="TDP-TES Grant">TDP-TES Grant</option>
                                <option value="CHED StuFAP">CHED StuFAP</option>
                                <option value="Institutional Scholarship">Institutional Scholarship</option>
                                <option value="Emergency Assistance">Emergency Assistance</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Grant Amount (₱)</label>
                            <input type="number" step="0.01" class="form-control form-control-sm" id="newAmount" placeholder="e.g. 10000" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Disbursing Officer</label>
                        <input type="text" class="form-control form-control-sm" id="newOfficer" placeholder="e.g. OSAS Aid Officer" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Disbursement Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Disbursed">Disbursed</option>
                            <option value="Processing">Processing</option>
                            <option value="Pending Clearance">Pending Clearance</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Record Grant</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    let activeGrantIdGlobal = '';

    function applyGrantFilters() {
        const searchInput = document.getElementById('grantSearch').value.toLowerCase().trim();
        const programFilter = document.getElementById('programTypeFilter').value;
        const statusFilter = document.getElementById('disbursementStatusFilter').value;

        const rows = document.querySelectorAll('.grant-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const student = row.getAttribute('data-student');
            const program = row.getAttribute('data-program');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || student.includes(searchInput);
            const matchesProgram = !programFilter || program.toLowerCase() === programFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesProgram && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noGrantRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} financial grant entries`;
        }
    }

    function openEssentialViewModal(grantId, student, program, amount, date, officer, status, course, college) {
        activeGrantIdGlobal = grantId.toLowerCase();

        document.getElementById('vGrantId').innerText = grantId;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vCourseCollege').innerText = `${course || 'BS Information Systems'} • ${college || 'College of Info & Comm Tech'}`;
        document.getElementById('vProgramType').innerText = program;
        document.getElementById('vAmount').innerText = amount;
        document.getElementById('vDate').innerText = date;
        document.getElementById('vOfficer').innerText = officer;

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        badgeElem.className = '';
        
        const lower = status.toLowerCase();
        if (lower === 'disbursed') badgeElem.className = 'status-badge-disbursed';
        else if (lower === 'processing') badgeElem.className = 'status-badge-processing';
        else badgeElem.className = 'status-badge-pending';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper UI
        const st1 = document.getElementById('st1');
        const st2 = document.getElementById('st2');
        const st3 = document.getElementById('st3');
        const st4 = document.getElementById('st4');

        st1.className = 'compact-step-circle completed';
        st2.className = 'compact-step-circle completed';
        st3.className = 'compact-step-circle completed';

        if (lower === 'disbursed') {
            st4.className = 'compact-step-circle completed';
            st4.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'processing') {
            st4.className = 'compact-step-circle active';
            st4.innerText = '4';
        } else {
            st3.className = 'compact-step-circle active';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialViewModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Essential Details: ' + grantId);
        }
    }

    function saveEssentialStatus() {
        const newStatus = document.getElementById('vStatusSelect').value;
        const targetRow = document.getElementById('row-' + activeGrantIdGlobal);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-disbursed';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'processing') newBadgeClass = 'status-badge-processing';
            else if (lowerStatus === 'pending clearance') newBadgeClass = 'status-badge-pending';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }
        }

        const modalElem = document.getElementById('essentialViewModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyGrantFilters();

        alert('Grant status successfully updated!');
    }

    function openAddGrantModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addGrantModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Record Financial Grant Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.grant-row');
        let totalBeneficiaries = rows.length;
        let totalDisbursedSum = 0;
        let totalProcessingSum = 0;
        let totalPendingSum = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();
            const amount = parseFloat(row.getAttribute('data-amount')) || 0;

            if (status === 'disbursed') {
                totalDisbursedSum += amount;
            } else if (status === 'processing') {
                totalProcessingSum += amount;
            } else if (status === 'pending clearance') {
                totalPendingSum += amount;
            }
        });

        document.getElementById('metricBeneficiaries').innerText = totalBeneficiaries.toLocaleString();
        document.getElementById('metricDisbursed').innerText = '₱' + totalDisbursedSum.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2});
        document.getElementById('metricProcessing').innerText = '₱' + totalProcessingSum.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2});
        document.getElementById('metricPending').innerText = '₱' + totalPendingSum.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2});
    }

    function saveNewGrant(e) {
        e.preventDefault();

        const grantId = document.getElementById('newGrantId').value.trim();
        const rawDate = document.getElementById('newDate').value;
        const student = document.getElementById('newStudentName').value.trim();
        const program = document.getElementById('newProgramType').value;
        const amountNum = parseFloat(document.getElementById('newAmount').value) || 0;
        const officer = document.getElementById('newOfficer').value.trim();
        const status = document.getElementById('newStatus').value;

        const dateObj = new Date(rawDate);
        const formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        const formattedAmount = '₱' + amountNum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});

        let badgeClass = 'status-badge-disbursed';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'processing') badgeClass = 'status-badge-processing';
        else if (lowerStatus === 'pending clearance') badgeClass = 'status-badge-pending';

        const rowId = 'row-' + grantId.toLowerCase();
        const tbody = document.getElementById('grantTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'grant-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', grantId.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-program', program);
        newTr.setAttribute('data-status', status);
        newTr.setAttribute('data-amount', amountNum);

        newTr.innerHTML = `
            <td class="ps-4 fw-semibold text-secondary text-nowrap">${grantId}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="badge-category">${program}</span></td>
            <td class="text-center fw-bold text-dark">${formattedAmount}</td>
            <td class="text-muted text-nowrap">${formattedDate}</td>
            <td class="text-muted">${officer}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-4">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('${grantId}', '${student}', '${program}', '${formattedAmount}', '${formattedDate}', '${officer}', '${status}', 'General Course', 'MarSU Main Campus')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('addGrantModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('addGrantForm').reset();

        recalculateMetrics();
        applyGrantFilters();
    }
</script>