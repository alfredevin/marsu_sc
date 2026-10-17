<!-- Financial Assistance Records Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Smooth Touch Scroll */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Flexible Table Columns - No Hard Compression */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1200px; /* Guarantees comfortable breathing room for financial columns */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important; /* Allows text to wrap naturally without text clipping */
            word-break: break-word;
            padding: 12px 14px !important;
            line-height: 1.45;
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
        .accent-success::before { background-color: #198754; }
        .accent-primary::before { background-color: #0d6efd; }

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
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }

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

        /* Program / Assistance Badges */
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

        /* Status Badges - Uncompressed & Wrap-Protected */
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

        /* Primary Action Button */
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
            <span class="small fw-bold text-secondary">STUDENT FINANCIAL SERVICES</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">FINANCIAL ASSISTANCE RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Financial Assistance Records</h4>
        <p class="text-muted small mb-0">Track student grant applications, emergency stipends, aid disbursements, and fund distribution status.</p>
    </div>

    <!-- Modern Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Disbursed -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Disbursed</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">₱48,000</div>
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
                    <div class="metric-label mb-1">Pending Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1">3</div>
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
                    <div class="metric-label mb-1">For Release</div>
                    <div class="fs-2 fw-bold text-primary lh-1">2</div>
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
                    <div class="metric-label mb-1">Completed Grants</div>
                    <div class="fs-2 fw-bold text-success lh-1">12</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle fs-4"></i>
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
                <input type="search" id="financialSearch" class="search-pill-input" placeholder="Search grant ID, student, program, or fund..." oninput="filterTable('financialSearch','financialTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Program Type:</label>
                    <select class="form-select form-select-sm filter-select" id="programFilter">
                        <option value="">All Programs</option>
                        <option value="TDP-TES">TDP-TES Grant</option>
                        <option value="Emergency Aid">Emergency Aid</option>
                        <option value="Student Assistantship">Student Assistantship</option>
                        <option value="CHED Tulong Dunong">CHED Tulong Dunong</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Disbursement Status:</label>
                    <select class="form-select form-select-sm filter-select" id="financialStatus" onchange="filterStatus('financialStatus','financialTable',7)">
                        <option value="">All Statuses</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Processing">Processing</option>
                        <option value="Approved">Approved for Release</option>
                        <option value="Disbursed">Disbursed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="openModal('modalNewFinancialGrant')">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Record Financial Grant
                </button>
            </div>
        </div>
    </div>

    <!-- Financial Assistance Records Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="financialTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 11%;">Grant Ref No.</th>
                    <th class="py-3" style="width: 15%;">Student Name</th>
                    <th class="py-3" style="width: 15%;">Assistance Type</th>
                    <th class="py-3 text-end" style="width: 11%;">Amount Grant</th>
                    <th class="py-3" style="width: 12%;">Fund Source</th>
                    <th class="py-3" style="width: 11%;">Disbursement Date</th>
                    <th class="py-3 text-center" style="width: 12%;">Status</th>
                    <th class="py-3 pe-3" style="width: 13%;">Remarks / Details</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0104</td>
                    <td class="fw-semibold text-dark">Adamos, Mariedhen L.</td>
                    <td>
                        <span class="badge-program">Emergency Aid</span>
                    </td>
                    <td class="text-end fw-bold text-dark text-nowrap">₱5,000.00</td>
                    <td class="text-muted">OSAS Welfare Fund</td>
                    <td class="text-muted text-nowrap">Oct 14, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-disbursed">Disbursed</span>
                    </td>
                    <td class="text-muted">Direct ATM credit verified</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0103</td>
                    <td class="fw-semibold text-dark">Ali, Kyla Diane M.</td>
                    <td>
                        <span class="badge-program">CHED Tulong Dunong</span>
                    </td>
                    <td class="text-end fw-bold text-dark text-nowrap">₱15,000.00</td>
                    <td class="text-muted">CHED Grant Allotment</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-approved">Approved for Release</span>
                    </td>
                    <td class="text-muted">Payroll signed; scheduled release</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0102</td>
                    <td class="fw-semibold text-dark">Almonte, Hanz Andrei R.</td>
                    <td>
                        <span class="badge-program">Student Assistantship</span>
                    </td>
                    <td class="text-end fw-bold text-dark text-nowrap">₱8,000.00</td>
                    <td class="text-muted">University Payroll</td>
                    <td class="text-muted text-nowrap">—</td>
                    <td class="text-center">
                        <span class="status-badge-processing">Processing</span>
                    </td>
                    <td class="text-muted">Daily Time Record verification</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FA-2026-0101</td>
                    <td class="fw-semibold text-dark">Andaya, Patricia M.</td>
                    <td>
                        <span class="badge-program">TDP-TES Grant</span>
                    </td>
                    <td class="text-end fw-bold text-dark text-nowrap">₱20,000.00</td>
                    <td class="text-muted">UniFAST Budget</td>
                    <td class="text-muted text-nowrap">—</td>
                    <td class="text-center">
                        <span class="status-badge-review">Under Review</span>
                    </td>
                    <td class="text-muted">Evaluating documentary requirements</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 18 financial records</span>
        <span>Page 1 of 5</span>
    </div>

    <!-- Financial Disbursement Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-bank2 marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Financial Audit & Disbursement Protocol</h6>
                <p class="text-muted small mb-0">
                    All financial assistance allocations require verified endorsement, complete documentary requirements, budget availability verification, and official receipt or payroll sign-off prior to disbursement. Keep financial ledgers updated for internal and Commission on Audit (COA) compliance reviews.
                </p>
            </div>
        </div>
    </div>

</div>