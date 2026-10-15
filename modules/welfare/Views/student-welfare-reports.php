<!-- Student Welfare Reports Management -->
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

        /* Uncompressed Table with Generous Cell Padding */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1200px; /* Guarantees horizontal breathing room for report details */
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
        .accent-warning::before { background-color: #ffc107; }
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
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }

        .metric-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        /* Spacious Toolbar Controls */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1.25rem !important;
            margin-bottom: 1.75rem !important;
        }

        /* Pill Search Input with Generous Internal Cushioning */
        .search-pill-wrapper {
            background-color: #ffffff;
            border: 1.5px solid #e2d8d8;
            border-radius: 50rem !important;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            min-width: 300px;
            flex-grow: 1;
            max-width: 420px;
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
            font-size: 0.9rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 170px;
            padding: 6px 12px !important;
            font-size: 0.875rem !important;
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

        /* Status Badges with Roomy Padding */
        .status-badge-approved {
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

        .status-badge-submitted {
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

        /* Primary Action Buttons */
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
            <span class="small fw-bold text-secondary">MONITORING & EVALUATION</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">STUDENT WELFARE REPORTS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Student Welfare Reports & Analytics</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Generate, compile, and archive institutional summaries on student socio-economic profiles, financial assistance distributions, case resolutions, and student support metrics.
        </p>
    </div>

    <!-- Modern Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Reports Generated -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Reports</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">18</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-file-earmark-bar-graph-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Approved & Published -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Approved Reports</div>
                    <div class="fs-2 fw-bold text-success lh-1">12</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-patch-check-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Pending OSAS Review -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1">4</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Active Semester Analytics -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Term Analytics</div>
                    <div class="fs-2 fw-bold text-primary lh-1">1st Sem</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-pie-chart-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card toolbar-card shadow-sm">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="reportSearch" class="search-pill-input" placeholder="Search report title, ref ID, or prepared by..." oninput="filterTable('reportSearch','reportTable')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Primary Action Button -->
            <div class="d-flex flex-wrap gap-3 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Report Scope:</label>
                    <select class="form-select form-select-sm filter-select" id="scopeFilter">
                        <option value="">All Scopes</option>
                        <option value="Socio-economic Summary">Socio-economic Summary</option>
                        <option value="Financial Aid Disbursement">Financial Aid Disbursement</option>
                        <option value="Case Resolution Metrics">Case Resolution Metrics</option>
                        <option value="Guidance Counseling Log">Guidance Counseling Log</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="reportStatus" onchange="filterStatus('reportStatus','reportTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Approved">Approved</option>
                        <option value="Pending Review">Pending Review</option>
                        <option value="Submitted">Submitted</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="openModal('modalGenerateReport')">
                    <i class="bi bi-plus-circle icon-shrink-0"></i> Generate New Report
                </button>
            </div>
        </div>
    </div>

    <!-- Student Welfare Reports Table with Increased Spacing -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="reportTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 12%;">Report ID</th>
                    <th class="py-3.5" style="width: 22%;">Report Title</th>
                    <th class="py-3.5" style="width: 16%;">Report Scope</th>
                    <th class="py-3.5" style="width: 12%;">Academic Term</th>
                    <th class="py-3.5" style="width: 14%;">Prepared By</th>
                    <th class="py-3.5" style="width: 12%;">Date Created</th>
                    <th class="py-3.5 text-center" style="width: 12%;">Status</th>
                    <th class="py-3.5 text-center pe-4" style="width: 8%;">Action</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SWR-2026-012</td>
                    <td class="fw-semibold text-dark">Q3 Student Financial Aid & Stipend Summary</td>
                    <td>
                        <span class="badge-category">Financial Aid Disbursement</span>
                    </td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted">OSAS Financial Officer</td>
                    <td class="text-muted text-nowrap">Oct 14, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-approved">Approved</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SWR-2026-011</td>
                    <td class="fw-semibold text-dark">Mid-Term Student Grievance & Case Resolution Audit</td>
                    <td>
                        <span class="badge-category">Case Resolution Metrics</span>
                    </td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted">Atty. Santos</td>
                    <td class="text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-review">Pending Review</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SWR-2026-010</td>
                    <td class="fw-semibold text-dark">Institutional Socio-economic Profile Assessment</td>
                    <td>
                        <span class="badge-category">Socio-economic Summary</span>
                    </td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted">Guidance Office</td>
                    <td class="text-muted text-nowrap">Oct 05, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-approved">Approved</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SWR-2026-009</td>
                    <td class="fw-semibold text-dark">Monthly Guidance Counseling & Mental Health Log</td>
                    <td>
                        <span class="badge-category">Guidance Counseling Log</span>
                    </td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted">G. Panganiban</td>
                    <td class="text-muted text-nowrap">Sep 28, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-draft">Draft</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 18 welfare report entries</span>
        <span>Page 1 of 5</span>
    </div>

    <!-- Reporting Governance & Data Privacy Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-shield-lock-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Reporting & Confidentiality Governance</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    All generated welfare reports synthesize aggregate student demographic, financial, and case data. Personally identifiable information (PII) is anonymized in executive exports in full compliance with the Data Privacy Act and institutional governance policies. Limit raw dataset downloads to authorized OSAS personnel.
                </p>
            </div>
        </div>
    </div>

</div>