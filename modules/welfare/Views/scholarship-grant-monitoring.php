<!-- Financial Assistance & Scholarship Grants Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container */
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
        }

        /* Flexible Uncompressed Table Layout */
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
            max-width: 200px;
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

        /* Search Pill Input */
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

        /* Compact Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        /* Program / Scholarship Badges */
        .badge-program {
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
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1px solid #198754 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-approved {
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

        .status-badge-processing {
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

        .status-badge-review {
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
            <span class="small fw-bold text-secondary">SCHOLARSHIP & FINANCIAL AID</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">SCHOLARSHIP GRANT RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Scholarship & Financial Grant Records</h4>
        <p class="text-muted small mb-0">Manage institutional scholarship distributions, TDP-TES grants, emergency financial aid disbursements, and beneficiary payroll processing.</p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Disbursed -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Disbursed</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalDisbursed">₱5,000</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Grant Total</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Under Review / Proc.</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricPending">2</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Pending Audit</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Approved / For Release -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Approved for Release</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricApproved">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Payroll Approved</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Disbursed Grants -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Disbursed Grants</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricDisbursed">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Completed Release</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle fs-4"></i>
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
                <input type="search" id="financialSearch" class="search-pill-input" placeholder="Search student or ref no..." oninput="applyFinancialFilters()" autocomplete="off">
            </div>

            <!-- 2. Program Type Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Grant Program:</label>
                <select class="form-select form-select-sm filter-select" id="programFilter" onchange="applyFinancialFilters()">
                    <option value="">All Grants</option>
                    <option value="Emergency Aid">Emergency Aid</option>
                    <option value="CHED Tulong Dunong">CHED Tulong Dunong</option>
                    <option value="Student Assistantship">Student Assistantship</option>
                    <option value="TDP-TES Grant">TDP-TES Grant</option>
                </select>
            </div>

            <!-- 3. Disbursement Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Disbursement Status:</label>
                <select class="form-select form-select-sm filter-select" id="financialStatusFilter" onchange="applyFinancialFilters()">
                    <option value="">All Statuses</option>
                    <option value="Under Review">Under Review</option>
                    <option value="Processing">Processing</option>
                    <option value="Approved for Release">Approved for Release</option>
                    <option value="Disbursed">Disbursed</option>
                </select>
            </div>

            <!-- 4. Record Financial Grant Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openNewFinancialModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Record Scholarship Grant
            </button>

        </div>
    </div>

    <!-- Financial Assistance Records Table -->
    <div class="table-responsive-custom bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="financialTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 11%;">Grant Ref No.</th>
                    <th class="py-3" style="width: 16%;">Student Name</th>
                    <th class="py-3" style="width: 15%;">Assistance Type</th>
                    <th class="py-3" style="width: 12%;">Amount Grant</th>
                    <th class="py-3" style="width: 14%;">Fund Source</th>
                    <th class="py-3 text-center" style="width: 11%;">Release Date</th>
                    <th class="py-3 text-center" style="width: 12%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="financialTableBody">
                <tr class="financial-row" id="row-fa-2026-0104" data-ref="fa-2026-0104" data-student="adamos, mariedhen l." data-program="Emergency Aid" data-status="Disbursed" data-amount="5000">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0104</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td><span class="badge-program">Emergency Aid</span></td>
                    <td class="fw-bold text-dark text-nowrap">₱5,000.00</td>
                    <td class="text-muted truncate-cell">OSAS Welfare Fund</td>
                    <td class="text-center text-muted text-nowrap">Oct 14, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-disbursed">Disbursed</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('FA-2026-0104', 'Adamos, Mariedhen L.', 'Emergency Aid', '₱5,000.00', 'OSAS Welfare Fund', 'Oct 14, 2026', 'Disbursed', 'Direct ATM credit verified')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="financial-row" id="row-fa-2026-0103" data-ref="fa-2026-0103" data-student="ali, kyla diane m." data-program="CHED Tulong Dunong" data-status="Approved for Release" data-amount="15000">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0103</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td><span class="badge-program">CHED Tulong Dunong</span></td>
                    <td class="fw-bold text-dark text-nowrap">₱15,000.00</td>
                    <td class="text-muted truncate-cell">CHED Grant Allotment</td>
                    <td class="text-center text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-approved">Approved for Release</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('FA-2026-0103', 'Ali, Kyla Diane M.', 'CHED Tulong Dunong', '₱15,000.00', 'CHED Grant Allotment', 'Oct 12, 2026', 'Approved for Release', 'Payroll signed; scheduled release')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="financial-row" id="row-fa-2026-0102" data-ref="fa-2026-0102" data-student="almonte, hanz andrei r." data-program="Student Assistantship" data-status="Processing" data-amount="8000">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0102</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td><span class="badge-program">Student Assistantship</span></td>
                    <td class="fw-bold text-dark text-nowrap">₱8,000.00</td>
                    <td class="text-muted truncate-cell">University Payroll</td>
                    <td class="text-center text-muted text-nowrap">—</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-processing">Processing</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('FA-2026-0102', 'Almonte, Hanz Andrei R.', 'Student Assistantship', '₱8,000.00', 'University Payroll', '—', 'Processing', 'Daily Time Record verification')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="financial-row" id="row-fa-2026-0101" data-ref="fa-2026-0101" data-student="andaya, patricia m." data-program="TDP-TES Grant" data-status="Under Review" data-amount="20000">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0101</td>
                    <td class="fw-semibold text-dark truncate-cell">Andaya, Patricia M.</td>
                    <td><span class="badge-program">TDP-TES Grant</span></td>
                    <td class="fw-bold text-dark text-nowrap">₱20,000.00</td>
                    <td class="text-muted truncate-cell">UniFAST Budget</td>
                    <td class="text-center text-muted text-nowrap">—</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-review">Under Review</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('FA-2026-0101', 'Andaya, Patricia M.', 'TDP-TES Grant', '₱20,000.00', 'UniFAST Budget', '—', 'Under Review', 'Evaluating documentary requirements')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noFinancialRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No scholarship grant records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 scholarship records</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Scholarship Audit & Disbursement Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-bank2 marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Scholarship Audit & Grant Disbursement Protocol</h6>
                <p class="text-muted small mb-0">
                    All scholarship grant distributions are reconciled against institutional budget allocations and CHED/UniFAST liquidation guidelines. Direct disbursements require verified student identification and signed acknowledgement receipts for Commission on Audit (COA) compliance.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (SCHOLARSHIP GRANT FOCUS)        -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialViewModal" tabindex="-1" aria-labelledby="essentialViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">SCHOLARSHIP GRANT OVERVIEW</span>
                    <h5 class="modal-title fw-bold mb-0" id="vRefNo">FA-2026-0104</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeRefNo" value="">

                <!-- 1. Student Beneficiary Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Scholar Beneficiary</span>
                        <span class="status-badge-disbursed" id="vStatusBadge">Disbursed</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Adamos, Mariedhen L.</h5>
                </div>

                <!-- 2. Grant Key Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Grant Program</div>
                            <div class="essential-value marsu-maroon-text" id="vProgram">Emergency Aid</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Grant Amount</div>
                            <div class="essential-value text-success" id="vAmount">₱5,000.00</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Fund Source</div>
                            <div class="essential-value text-dark" id="vFundSource">OSAS Welfare Fund</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Release Date</div>
                            <div class="essential-value" id="vReleaseDate">Oct 14, 2026</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Disbursement Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="st1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Review</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="st2"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Processing</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="st3"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Approved</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="st4">4</div>
                            <span class="compact-step-label text-dark fw-bold">Disbursed</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Remarks Text -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Remarks & Details</div>
                    <div class="small text-dark fw-semibold" id="vRemarksText">Direct ATM credit verified</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Status Stage</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Under Review">Under Review</option>
                            <option value="Processing">Processing</option>
                            <option value="Approved for Release">Approved for Release</option>
                            <option value="Disbursed">Disbursed</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialStatus()">Save Status</button>
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
<!-- MODAL 2: RECORD NEW SCHOLARSHIP GRANT ENTRY                           -->
<!-- ===================================================================== -->
<div class="modal fade" id="newFinancialModal" tabindex="-1" aria-labelledby="newFinancialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newFinancialModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Record Scholarship Grant
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newFinancialForm" onsubmit="saveNewFinancialGrant(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Grant Ref No.</label>
                            <input type="text" class="form-control form-control-sm" id="newRefNo" placeholder="e.g. FA-2026-0105" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Release Date</label>
                            <input type="date" class="form-control form-control-sm" id="newReleaseDate">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Scholar Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Dela Cruz, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Grant Program</label>
                            <select class="form-select form-select-sm" id="newProgram" required>
                                <option value="Emergency Aid">Emergency Aid</option>
                                <option value="CHED Tulong Dunong">CHED Tulong Dunong</option>
                                <option value="Student Assistantship">Student Assistantship</option>
                                <option value="TDP-TES Grant">TDP-TES Grant</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Grant Amount (₱)</label>
                            <input type="number" step="0.01" class="form-control form-control-sm" id="newAmount" placeholder="e.g. 5000" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Fund Source</label>
                        <input type="text" class="form-control form-control-sm" id="newFundSource" placeholder="e.g. OSAS Welfare Fund" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Disbursement Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Under Review">Under Review</option>
                            <option value="Processing">Processing</option>
                            <option value="Approved for Release">Approved for Release</option>
                            <option value="Disbursed">Disbursed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Remarks / Details</label>
                        <input type="text" class="form-control form-control-sm" id="newRemarks" placeholder="Brief note or verification details...">
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
    function applyFinancialFilters() {
        const searchInput = document.getElementById('financialSearch').value.toLowerCase().trim();
        const programFilter = document.getElementById('programFilter').value;
        const statusFilter = document.getElementById('financialStatusFilter').value;

        const rows = document.querySelectorAll('.financial-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const ref = row.getAttribute('data-ref');
            const student = row.getAttribute('data-student');
            const program = row.getAttribute('data-program');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || ref.includes(searchInput) || student.includes(searchInput);
            const matchesProgram = !programFilter || program.toLowerCase() === programFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesProgram && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noFinancialRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} scholarship records`;
        }
    }

    function openEssentialViewModal(refNo, student, program, amount, fundSource, releaseDate, status, remarks) {
        document.getElementById('activeRefNo').value = refNo.toLowerCase();
        document.getElementById('vRefNo').innerText = refNo;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vProgram').innerText = program;
        document.getElementById('vAmount').innerText = amount;
        document.getElementById('vFundSource').innerText = fundSource;
        document.getElementById('vReleaseDate').innerText = releaseDate;
        document.getElementById('vRemarksText').innerText = remarks || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        badgeElem.className = '';

        const lower = status.toLowerCase();
        if (lower === 'disbursed') badgeElem.className = 'status-badge-disbursed';
        else if (lower === 'approved for release') badgeElem.className = 'status-badge-approved';
        else if (lower === 'processing') badgeElem.className = 'status-badge-processing';
        else badgeElem.className = 'status-badge-review';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
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
        } else if (lower === 'approved for release') {
            st3.className = 'compact-step-circle active';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else if (lower === 'processing') {
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
            const modalElem = document.getElementById('essentialViewModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Scholarship Details: ' + refNo);
        }
    }

    function saveEssentialStatus() {
        const activeRefNo = document.getElementById('activeRefNo').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeRefNo);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-review';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'disbursed') newBadgeClass = 'status-badge-disbursed';
            else if (lowerStatus === 'approved for release') newBadgeClass = 'status-badge-approved';
            else if (lowerStatus === 'processing') newBadgeClass = 'status-badge-processing';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const refText = targetRow.cells[0].innerText;
                const studentText = targetRow.cells[1].innerText;
                const programText = targetRow.cells[2].innerText.trim();
                const amountText = targetRow.cells[3].innerText;
                const fundText = targetRow.cells[4].innerText;
                const releaseText = targetRow.cells[5].innerText;
                const remarksText = document.getElementById('vRemarksText').innerText;

                viewBtn.setAttribute('onclick', `openEssentialViewModal('${refText}', '${studentText}', '${programText}', '${amountText}', '${fundText}', '${releaseText}', '${newStatus}', '${remarksText}')`);
            }
        }

        const modalElem = document.getElementById('essentialViewModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyFinancialFilters();

        alert('Scholarship record status successfully updated!');
    }

    function openNewFinancialModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newFinancialModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Record Scholarship Grant Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.financial-row');
        let totalDisbursedSum = 0;
        let pendingCount = 0;
        let approvedCount = 0;
        let disbursedCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();
            const amount = parseFloat(row.getAttribute('data-amount')) || 0;

            if (status === 'disbursed') {
                disbursedCount++;
                totalDisbursedSum += amount;
            } else if (status === 'approved for release') {
                approvedCount++;
            } else if (status === 'under review' || status === 'processing') {
                pendingCount++;
            }
        });

        document.getElementById('metricTotalDisbursed').innerText = '₱' + totalDisbursedSum.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2});
        document.getElementById('metricPending').innerText = pendingCount;
        document.getElementById('metricApproved').innerText = approvedCount;
        document.getElementById('metricDisbursed').innerText = disbursedCount;
    }

    function saveNewFinancialGrant(e) {
        e.preventDefault();

        const refNo = document.getElementById('newRefNo').value.trim();
        const rawDate = document.getElementById('newReleaseDate').value;
        const student = document.getElementById('newStudentName').value.trim();
        const program = document.getElementById('newProgram').value;
        const amountNum = parseFloat(document.getElementById('newAmount').value) || 0;
        const fundSource = document.getElementById('newFundSource').value.trim();
        const status = document.getElementById('newStatus').value;
        const remarks = document.getElementById('newRemarks').value.trim() || '—';

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        const formattedAmount = '₱' + amountNum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});

        let badgeClass = 'status-badge-review';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'disbursed') badgeClass = 'status-badge-disbursed';
        else if (lowerStatus === 'approved for release') badgeClass = 'status-badge-approved';
        else if (lowerStatus === 'processing') badgeClass = 'status-badge-processing';

        const rowId = 'row-' + refNo.toLowerCase();
        const tbody = document.getElementById('financialTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'financial-row';
        newTr.id = rowId;
        newTr.setAttribute('data-ref', refNo.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-program', program);
        newTr.setAttribute('data-status', status);
        newTr.setAttribute('data-amount', amountNum);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${refNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="badge-program">${program}</span></td>
            <td class="fw-bold text-dark text-nowrap">${formattedAmount}</td>
            <td class="text-muted truncate-cell">${fundSource}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialViewModal('${refNo}', '${student}', '${program}', '${formattedAmount}', '${fundSource}', '${formattedDate}', '${status}', '${remarks}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newFinancialModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newFinancialForm').reset();

        recalculateMetrics();
        applyFinancialFilters();
    }
</script>