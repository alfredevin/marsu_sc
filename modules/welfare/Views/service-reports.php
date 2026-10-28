<!-- OSAS Services Analytics & Comprehensive Welfare Dashboard (MarSU OSAS Standard) -->
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
            border: 1px solid #dee2e6;
        }

        /* Uncompressed Table Layout */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1220px;
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

        .status-badge-high {
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

        /* Primary Action Buttons */
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
            <span class="small fw-bold text-secondary">MONITORING & EVALUATION</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">SERVICES ANALYTICS REPORTS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Service Performance & Welfare Analytics</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 850px;">
            Cross-functional analytics synthesizing student concerns, health clinic visits, financial aid distributions, case resolution rates, and support intervention outcomes across campus departments[cite: 1].
        </p>
    </div>

    <!-- Executive KPI Metrics Summary Grid -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Active Cases</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalCases">250</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;"> Across all OSAS divisions</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-diagram-3-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Resolution Rate</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricResolutionRate">90.9%</div>
                    <div class="small text-success fw-semibold mt-1" style="font-size: 0.75rem;"><i class="bi bi-arrow-up-short"></i> +3.2% vs last term</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check2-circle fs-4"></i>
                </div>
            </div>
        </div>

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
        <div class="col-12 col-lg-6">
            <div class="analytics-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-pie-chart-fill marsu-maroon-text me-2"></i> Student Concerns by Division</h6>
                    <span class="badge bg-light text-muted border">AY 2026–2027</span>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Financial Assistance & Grants</span>
                        <span class="marsu-maroon-text">51% (128 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar progress-bar-maroon" role="progressbar" style="width: 51%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>University Health Services</span>
                        <span class="text-primary">26% (64 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 26%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Student Support Programs</span>
                        <span class="text-warning">16% (40 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 16%;"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                        <span>Case & Grievance Management</span>
                        <span class="text-danger">7% (18 cases)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 7%;"></div>
                    </div>
                </div>
            </div>
        </div>

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
                        82% of students receiving academic mentorship or emergency grants successfully achieved baseline stability within 30 days of intervention intake[cite: 1].
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="analyticsSearch" class="search-pill-input" placeholder="Search module or lead..." oninput="applyAnalyticsFilters()" autocomplete="off">
            </div>

            <!-- 2. Service Module Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Service Module:</label>
                <select class="form-select form-select-sm filter-select" id="analyticsModuleFilter" onchange="applyAnalyticsFilters()">
                    <option value="">All Services</option>
                    <option value="Health Services">Health Services</option>
                    <option value="Financial Assistance">Financial Assistance</option>
                    <option value="Case Management">Case Management</option>
                    <option value="Support Programs">Support Programs</option>
                </select>
            </div>

            <!-- 3. Performance Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Performance:</label>
                <select class="form-select form-select-sm filter-select" id="analyticsPerformanceFilter" onchange="applyAnalyticsFilters()">
                    <option value="">All Statuses</option>
                    <option value="Active / On Track">Active / On Track</option>
                    <option value="High Volume">High Volume</option>
                    <option value="Pending Review">Pending Review</option>
                </select>
            </div>

            <!-- 4. Export Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="window.print()">
                <i class="bi bi-file-earmark-pdf me-1 icon-shrink-0"></i> Export Report
            </button>

        </div>
    </div>

    <!-- Service Reports & Department Performance Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="serviceTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Report ID</th>
                    <th class="py-3" style="width: 22%;">Service Module</th>
                    <th class="py-3" style="width: 18%;">Primary Concern Area</th>
                    <th class="py-3 text-center" style="width: 11%;">Total Volume</th>
                    <th class="py-3 text-center" style="width: 12%;">Resolution Rate</th>
                    <th class="py-3" style="width: 14%;">Responsible Lead</th>
                    <th class="py-3 text-center" style="width: 11%;">Performance</th>
                    <th class="py-3 text-center pe-3" style="width: 8%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="serviceTableBody">
                <tr class="service-row" id="row-srv-2026-001" data-id="srv-2026-001" data-module="University Health Services" data-lead="Dr. R. Salcedo" data-status="Active / On Track">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SRV-2026-001</td>
                    <td class="fw-semibold text-dark truncate-cell">University Health Services</td>
                    <td><span class="badge-category">Clinic & Mental Health</span></td>
                    <td class="text-center fw-bold text-dark">64 Cases</td>
                    <td class="text-center fw-bold text-success">92.1%</td>
                    <td class="text-muted truncate-cell">Dr. R. Salcedo</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">Active / On Track</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAnalyticsModal('SRV-2026-001', 'University Health Services', 'Clinic & Mental Health', '64 Cases', '92.1%', 'Dr. R. Salcedo', 'Active / On Track', 'Includes clinical consultations and psychological referrals with strong resolution speed.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="service-row" id="row-srv-2026-002" data-id="srv-2026-002" data-module="Financial Assistance & Grants" data-lead="Ms. E. Rodelas (Scholarship Lead)" data-status="High Volume">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SRV-2026-002</td>
                    <td class="fw-semibold text-dark truncate-cell">Financial Assistance & Grants</td>
                    <td><span class="badge-category">TDP-TES & Emergency Aid</span></td>
                    <td class="text-center fw-bold text-dark">128 Grants</td>
                    <td class="text-center fw-bold text-success">88.5%</td>
                    <td class="text-muted truncate-cell">Ms. E. Rodelas (Scholarship Lead)</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-high">High Volume</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAnalyticsModal('SRV-2026-002', 'Financial Assistance & Grants', 'TDP-TES & Emergency Aid', '128 Grants', '88.5%', 'Ms. E. Rodelas (Scholarship Lead)', 'High Volume', 'Peak intake for TDP-TES 1st semester allowances. Disbursement on schedule.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="service-row" id="row-srv-2026-003" data-id="srv-2026-003" data-module="Case & Grievance Management" data-lead="Atty. Santos (Student Rights Unit)" data-status="Pending Review">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SRV-2026-003</td>
                    <td class="fw-semibold text-dark truncate-cell">Case & Grievance Management</td>
                    <td><span class="badge-category">Disciplinary & Grievance</span></td>
                    <td class="text-center fw-bold text-dark">18 Cases</td>
                    <td class="text-center fw-bold text-warning">78.0%</td>
                    <td class="text-muted truncate-cell">Atty. Santos (Student Rights Unit)</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-review">Pending Review</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAnalyticsModal('SRV-2026-003', 'Case & Grievance Management', 'Disciplinary & Grievance', '18 Cases', '78.0%', 'Atty. Santos (Student Rights Unit)', 'Pending Review', 'Formal grievance proceedings underway with student tribunal committee.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="service-row" id="row-srv-2026-004" data-id="srv-2026-004" data-module="Student Support Programs" data-lead="J. Marasigan (Student Org Lead)" data-status="Active / On Track">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SRV-2026-004</td>
                    <td class="fw-semibold text-dark truncate-cell">Student Support Programs</td>
                    <td><span class="badge-category">Mentorship & Commuter Aid</span></td>
                    <td class="text-center fw-bold text-dark">40 Cases</td>
                    <td class="text-center fw-bold text-success">95.0%</td>
                    <td class="text-muted truncate-cell">J. Marasigan (Student Org Lead)</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">Active / On Track</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAnalyticsModal('SRV-2026-004', 'Student Support Programs', 'Mentorship & Commuter Aid', '40 Cases', '95.0%', 'J. Marasigan (Student Org Lead)', 'Active / On Track', 'High student engagement across campus mentorship and commuter support networks.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noAnalyticsRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No analytics reports found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 service analytics reports</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Executive Analytics Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-graph-up-arrow marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Quality Assurance & Analytics Framework</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    This consolidated analytics dashboard compiles performance data across all Office of Student Affairs and Services (OSAS) sub-units[cite: 1]. Key performance metrics evaluate intake efficiency, intervention outcomes, financial distribution accuracy, and health service quality to ensure institutional standards meet student welfare needs[cite: 1].
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL: ESSENTIAL DETAILS ONLY VIEW (ANALYTICS FOCUS)                 -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialAnalyticsModal" tabindex="-1" aria-labelledby="essentialAnalyticsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">SERVICE PERFORMANCE SUMMARY</span>
                    <h5 class="modal-title fw-bold mb-0" id="vReportId">SRV-2026-001</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeReportId" value="">

                <!-- 1. Service Module Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Service Module</span>
                        <span class="status-badge-active" id="vStatusBadge">Active / On Track</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vModule">University Health Services</h5>
                </div>

                <!-- 2. Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Primary Concern Area</div>
                            <div class="essential-value marsu-maroon-text" id="vConcernArea">Clinic & Mental Health</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Total Volume</div>
                            <div class="essential-value text-dark" id="vTotalVolume">64 Cases</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Resolution Rate</div>
                            <div class="essential-value text-success" id="vResolutionRate">92.1%</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Responsible Lead</div>
                            <div class="essential-value text-dark" id="vLead">Dr. R. Salcedo</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Service Quality Lifecycle Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="srvst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Data Logged</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="srvst2"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Audited</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="srvst3">3</div>
                            <span class="compact-step-label text-dark fw-bold">Published</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Executive Assessment Notes -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Executive Assessment Notes</div>
                    <div class="small text-dark fw-semibold" id="vAssessmentNotes">Includes clinical consultations and psychological referrals with strong resolution speed.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Performance Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Active / On Track">Active / On Track</option>
                            <option value="High Volume">High Volume</option>
                            <option value="Pending Review">Pending Review</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialAnalyticsStatus()">Save Status</button>
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
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyAnalyticsFilters() {
        const searchInput = document.getElementById('analyticsSearch').value.toLowerCase().trim();
        const moduleFilter = document.getElementById('analyticsModuleFilter').value;
        const performanceFilter = document.getElementById('analyticsPerformanceFilter').value;

        const rows = document.querySelectorAll('.service-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const moduleName = row.getAttribute('data-module');
            const lead = row.getAttribute('data-lead');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || moduleName.toLowerCase().includes(searchInput) || lead.toLowerCase().includes(searchInput);
            const matchesModule = !moduleFilter || moduleName.toLowerCase().includes(moduleFilter.toLowerCase());
            const matchesPerformance = !performanceFilter || status.toLowerCase() === performanceFilter.toLowerCase();

            if (matchesSearch && matchesModule && matchesPerformance) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noAnalyticsRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} service analytics reports`;
        }
    }

    function openEssentialAnalyticsModal(reportId, moduleName, concernArea, totalVolume, resolutionRate, lead, status, assessmentNotes) {
        document.getElementById('activeReportId').value = reportId.toLowerCase();
        document.getElementById('vReportId').innerText = reportId;
        document.getElementById('vModule').innerText = moduleName;
        document.getElementById('vConcernArea').innerText = concernArea;
        document.getElementById('vTotalVolume').innerText = totalVolume;
        document.getElementById('vResolutionRate').innerText = resolutionRate;
        document.getElementById('vLead').innerText = lead;
        document.getElementById('vAssessmentNotes').innerText = assessmentNotes || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'active / on track') badgeElem.className = 'status-badge-active';
        else if (lower === 'high volume') badgeElem.className = 'status-badge-high';
        else badgeElem.className = 'status-badge-review';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialAnalyticsModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Service Analytics Details: ' + reportId);
        }
    }

    function saveEssentialAnalyticsStatus() {
        const activeReportId = document.getElementById('activeReportId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeReportId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-review';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'active / on track') newBadgeClass = 'status-badge-active';
            else if (lowerStatus === 'high volume') newBadgeClass = 'status-badge-high';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const moduleText = targetRow.cells[1].innerText;
                const concernText = targetRow.cells[2].innerText.trim();
                const volumeText = targetRow.cells[3].innerText;
                const rateText = targetRow.cells[4].innerText;
                const leadText = targetRow.cells[5].innerText;
                const notesText = document.getElementById('vAssessmentNotes').innerText;

                viewBtn.setAttribute('onclick', `openEssentialAnalyticsModal('${idText}', '${moduleText}', '${concernText}', '${volumeText}', '${rateText}', '${leadText}', '${newStatus}', '${notesText}')`);
            }
        }

        const modalElem = document.getElementById('essentialAnalyticsModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        applyAnalyticsFilters();
        alert('Service performance status successfully updated!');
    }
</script>