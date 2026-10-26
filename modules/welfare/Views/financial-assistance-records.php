<!-- OSAS Financial Aid & Scholarship Grant Management (Single-Row Aligned Controls) -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Smooth Touch Scroll */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
        }

        /* Uncompressed Table with Generous Cell Padding */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1220px;
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

        /* Analytics Visual Card Styling */
        .analytics-card {
            background: #ffffff;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            height: 100%;
        }

        .progress-bar-maroon {
            background-color: #58111a !important;
        }

        /* Spacious Toolbar Controls Card */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1rem 1.25rem !important;
            margin-bottom: 1.75rem !important;
        }

        /* Shorter Search Pill Input - Fixed Width for Single Line */
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

        /* Action Buttons */
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
        <!-- Total Active Beneficiaries -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Beneficiaries</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">1,240</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> Current Semester</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Total Disbursed -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Disbursed</div>
                    <div class="fs-2 fw-bold text-success lh-1">₱1.28M</div>
                    <div class="small text-success fw-semibold mt-1" style="font-size: 0.75rem;"><i class="bi bi-check-circle me-1"></i> 88.5% Release Rate</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Processing Payroll -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">In Processing</div>
                    <div class="fs-2 fw-bold text-primary lh-1">₱185K</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> 145 Pending Payees</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Emergency Aid Fund -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Emergency Fund</div>
                    <div class="fs-2 fw-bold text-dark lh-1">₱50K</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> Ready Allocation</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-shield-plus fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar (Single Line: Search Bar, Program Type, Disbursement Status, Record Financial Grant) -->
    <div class="card toolbar-card shadow-sm">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="grantSearch" class="search-pill-input" placeholder="Search student or grant ID..." oninput="filterTable('grantSearch','grantTable')" autocomplete="off">
            </div>

            <!-- 2. Program Type Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Program Type:</label>
                <select class="form-select form-select-sm filter-select" id="programTypeFilter">
                    <option value="">All Programs</option>
                    <option value="TDP-TES">TDP-TES Grant</option>
                    <option value="CHED StuFAP">CHED StuFAP</option>
                    <option value="Institutional Scholarship">Institutional Scholarship</option>
                    <option value="Emergency Financial Assistance">Emergency Assistance</option>
                </select>
            </div>

            <!-- 3. Disbursement Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Disbursement Status:</label>
                <select class="form-select form-select-sm filter-select" id="disbursementStatusFilter" onchange="filterStatus('disbursementStatusFilter','grantTable',6)">
                    <option value="">All Statuses</option>
                    <option value="Disbursed">Disbursed</option>
                    <option value="Processing">Processing</option>
                    <option value="Pending Clearance">Pending Clearance</option>
                </select>
            </div>

            <!-- 4. Record Financial Grant Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2 flex-shrink-0" onclick="openModal('modalGrant')">
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
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-089</td>
                    <td class="fw-semibold text-dark">Reyes, Janine C.</td>
                    <td>
                        <span class="badge-category">TDP-TES Grant</span>
                    </td>
                    <td class="text-center fw-bold text-dark">₱15,000.00</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-muted">OSAS Aid Officer</td>
                    <td class="text-center">
                        <span class="status-badge-disbursed">Disbursed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-088</td>
                    <td class="fw-semibold text-dark">Mendoza, Carlos P.</td>
                    <td>
                        <span class="badge-category">Emergency Assistance</span>
                    </td>
                    <td class="text-center fw-bold text-dark">₱5,000.00</td>
                    <td class="text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-muted">OSAS Finance Lead</td>
                    <td class="text-center">
                        <span class="status-badge-processing">Processing</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-087</td>
                    <td class="fw-semibold text-dark">Dizon, Maria S.</td>
                    <td>
                        <span class="badge-category">Institutional Scholarship</span>
                    </td>
                    <td class="text-center fw-bold text-dark">₱8,000.00</td>
                    <td class="text-muted text-nowrap">Oct 05, 2026</td>
                    <td class="text-muted">OSAS Aid Officer</td>
                    <td class="text-center">
                        <span class="status-badge-disbursed">Disbursed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">GNT-2026-086</td>
                    <td class="fw-semibold text-dark">Gonzales, Mark L.</td>
                    <td>
                        <span class="badge-category">CHED StuFAP</span>
                    </td>
                    <td class="text-center fw-bold text-dark">₱10,000.00</td>
                    <td class="text-muted text-nowrap">Sep 28, 2026</td>
                    <td class="text-muted">OSAS Finance Lead</td>
                    <td class="text-center">
                        <span class="status-badge-pending">Pending Clearance</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 1,240 financial grant entries</span>
        <span>Page 1 of 310</span>
    </div>

    <!-- Financial Governance Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-shield-check marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Financial Assistance Audit & Accountability Governance</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    All financial grant distributions are reconciled against institutional budget allocations and Commission on Higher Education (CHED) liquidation guidelines. Direct disbursements require verified student identification and signed acknowledgement receipts.
                </p>
            </div>
        </div>
    </div>

</div>