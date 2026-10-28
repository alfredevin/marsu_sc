<!-- OSAS Services Analytics & Comprehensive Welfare Dashboard -->
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

        /* Spacious Toolbar Controls */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1.25rem !important;
            margin-bottom: 1.75rem !important;
        }

        /* Pill Search Input with Generous Cushioning */
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
        .status-badge-active {
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

        .status-badge-high {
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

        /* Action Buttons */
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
            <span class="small fw-bold marsu-maroon-text">SERVICES ANALYTICS REPORTS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Service Performance & Welfare Analytics</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 850px;">
            Cross-functional analytics synthesizing student concerns, health clinic visits, financial aid distributions, case resolution rates, and support intervention outcomes across campus departments.
        </p>
    </div>

    <!-- Executive KPI Metrics Summary Grid -->
    <div class="row g-3 mb-4">
        <!-- Total Active Cases & Concerns -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Active Cases</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">142</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> Across all OSAS divisions</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-diagram-3-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Case Resolution Rate -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Resolution Rate</div>
                    <div class="fs-2 fw-bold text-success lh-1">87.4%</div>
                    <div class="small text-success fw-semibold mt-1" style="font-size: 0.75rem;"><i class="bi bi-arrow-up-short"></i> +3.2% vs last term</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check2-circle fs-4"></i>
                </div>
            </div>
        </div>

        <!-- YTD Aid Disbursed -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Aid Released</div>
                    <div class="fs-2 fw-bold text-primary lh-1">₱1.28M</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> 1,240 Beneficiaries</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Avg. Response Time -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Avg. Intake Time</div>
                    <div class="fs-2 fw-bold text-dark lh-1">1.8 Days</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> Target: &lt; 2.0 Days</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-lightning-charge-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Analytics & Distribution Breakdowns Section -->
    <div class="row g-3 mb-4">
        <!-- Breakdown by Concern Category -->
        <div class="col-12 col-lg-6">
            <div class="analytics-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-pie-chart-fill marsu-maroon-text me-2"></i> Student Concerns by Division</h6>
                    <span class="badge bg-light text-muted border">AY 2026–2027</span>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Financial & Scholarship Grants</span>
                        <span class="marsu-maroon-text">42% (60 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar progress-bar-maroon" role="progressbar" style="width: 42%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Health & Mental Wellness Clinic</span>
                        <span class="text-primary">28% (40 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 28%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Academic Adjustment & Guidance</span>
                        <span class="text-warning">18% (25 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 18%;"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Student Grievances & Complaints</span>
                        <span class="text-danger">12% (17 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 12%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Intervention Effectiveness Metrics -->
        <div class="col-12 col-lg-6">
            <div class="analytics-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-bar-chart-line-fill marsu-maroon-text me-2"></i> Intervention Plan Effectiveness</h6>
                    <span class="badge bg-light text-muted border">Evaluated Outcomes</span>
                </div>
                <div class="row text-center g-2 pt-2 mb-3">
                    <div class="col-4">
                        <div class="p-2 border rounded bg-light">
                            <div class="fs-4 fw-bold text-success">68%</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Fully Effective</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-light">
                            <div class="fs-4 fw-bold text-warning">24%</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Partially Effective</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-light">
                            <div class="fs-4 fw-bold text-danger">8%</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Needs Support</div>
                        </div>
                    </div>
                </div>
                <div class="p-3 border rounded bg-light d-flex align-items-center gap-3">
                    <i class="bi bi-info-circle-fill marsu-maroon-text fs-4 flex-shrink-0"></i>
                    <p class="text-muted small mb-0 lh-sm">
                        82% of students receiving academic mentorship or emergency grants successfully achieved baseline stability within 30 days of intervention intake.
                    </p>
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
                <input type="search" id="analyticsSearch" class="search-pill-input" placeholder="Search service unit, module ID, or lead staff..." oninput="filterTable('analyticsSearch','serviceTable')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Export Action Button -->
            <div class="d-flex flex-wrap gap-3 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Service Module:</label>
                    <select class="form-select form-select-sm filter-select" id="moduleFilter">
                        <option value="">All Services</option>
                        <option value="Health Services">Health Services</option>
                        <option value="Financial Assistance">Financial Assistance</option>
                        <option value="Case Management">Case Management</option>
                        <option value="Support Programs">Support Programs</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Performance Status:</label>
                    <select class="form-select form-select-sm filter-select" id="performanceStatus" onchange="filterStatus('performanceStatus','serviceTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Active / On Track">Active / On Track</option>
                        <option value="High Volume">High Volume</option>
                        <option value="Pending Review">Pending Review</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="window.print()">
                    <i class="bi bi-file-earmark-pdf icon-shrink-0"></i> Export Comprehensive Report
                </button>
            </div>
        </div>
    </div>

    <!-- Service Reports & Department Performance Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="serviceTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 12%;">Report ID</th>
                    <th class="py-3.5" style="width: 20%;">Service Module</th>
                    <th class="py-3.5" style="width: 16%;">Primary Concern Area</th>
                    <th class="py-3.5 text-center" style="width: 11%;">Total Volume</th>
                    <th class="py-3.5 text-center" style="width: 12%;">Resolution Rate</th>
                    <th class="py-3.5" style="width: 14%;">Responsible Lead</th>
                    <th class="py-3.5 text-center" style="width: 10%;">Performance</th>
                    <th class="py-3.5 text-center pe-4" style="width: 5%;">Action</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SRV-2026-001</td>
                    <td class="fw-semibold text-dark">University Health Services</td>
                    <td>
                        <span class="badge-category">Clinic & Mental Health</span>
                    </td>
                    <td class="text-center fw-bold text-dark">64 Cases</td>
                    <td class="text-center fw-bold text-success">92.1%</td>
                    <td class="text-muted">Dr. R. Salcedo</td>
                    <td class="text-center">
                        <span class="status-badge-active">Active / On Track</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SRV-2026-002</td>
                    <td class="fw-semibold text-dark">Financial Assistance & Grants</td>
                    <td>
                        <span class="badge-category">TDP-TES & Emergency Aid</span>
                    </td>
                    <td class="text-center fw-bold text-dark">128 Grants</td>
                    <td class="text-center fw-bold text-success">88.5%</td>
                    <td class="text-muted">OSAS Aid Officer</td>
                    <td class="text-center">
                        <span class="status-badge-high">High Volume</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-maroon btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SRV-2026-003</td>
                    <td class="fw-semibold text-dark">Case & Grievance Management</td>
                    <td>
                        <span class="badge-category">Disciplinary & Grievance</span>
                    </td>
                    <td class="text-center fw-bold text-dark">18 Cases</td>
                    <td class="text-center fw-bold text-warning">78.0%</td>
                    <td class="text-muted">Atty. Santos</td>
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
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">SRV-2026-004</td>
                    <td class="fw-semibold text-dark">Student Support Programs</td>
                    <td>
                        <span class="badge-category">Mentorship & Commuter Aid</span>
                    </td>
                    <td class="text-center fw-bold text-dark">1,240 Beneficiaries</td>
                    <td class="text-center fw-bold text-success">95.0%</td>
                    <td class="text-muted">Student Affairs Staff</td>
                    <td class="text-center">
                        <span class="status-badge-active">Active / On Track</span>
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
        <span>Showing 4 of 12 service analytics reports</span>
        <span>Page 1 of 3</span>
    </div>

    <!-- Executive Analytics Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-graph-up-arrow marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Service Analytics & Quality Assurance Framework</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    This consolidated analytics dashboard compiles data across all Office of Student Affairs and Services (OSAS) sub-units. Performance metrics evaluate intake efficiency, intervention outcomes, financial distribution accuracy, and health service quality to ensure institutional support standards meet student welfare needs.
                </p>
            </div>
        </div>
    </div>

</div>