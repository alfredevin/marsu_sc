<!-- ========================================================================================= -->
<!-- MARSU OSAS INTEGRATED WELFARE & ANALYTICS COMMAND CENTER (ENTERPRISE EDITION)            -->
<!-- ========================================================================================= -->
<div class="p-3 p-md-4 bg-light-subtle" style="font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; min-height: 100vh;">

    <style>
        /* Modern Design System & MarSU Color Palette */
        :root {
            --marsu-maroon: #58111a;
            --marsu-maroon-hover: #3c0b12;
            --marsu-maroon-soft: rgba(88, 17, 26, 0.08);
            --border-radius-card: 14px;
            --transition-standard: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .marsu-maroon-bg { background-color: var(--marsu-maroon) !important; color: #ffffff !important; }
        .marsu-maroon-text { color: var(--marsu-maroon) !important; }

        /* Navigation Header & Breadcrumb */
        .breadcrumb-link {
            text-decoration: none;
            color: #6c757d;
            font-size: 0.825rem;
            font-weight: 600;
            transition: var(--transition-standard);
        }
        .breadcrumb-link:hover { color: var(--marsu-maroon); }

        /* Navigation Tabs */
        .nav-tabs-marsu {
            border-bottom: 2px solid #e9ecef;
            gap: 8px;
        }

        .nav-tabs-marsu .nav-link {
            color: #6c757d;
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 12px 20px;
            font-size: 0.875rem;
            border-radius: 8px 8px 0 0;
            transition: var(--transition-standard);
        }

        .nav-tabs-marsu .nav-link:hover {
            color: var(--marsu-maroon);
            background-color: var(--marsu-maroon-soft);
        }

        .nav-tabs-marsu .nav-link.active {
            color: var(--marsu-maroon) !important;
            border-bottom: 3px solid var(--marsu-maroon) !important;
            background: #ffffff !important;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.02);
        }

        /* Metric Cards */
        .metric-card-enhanced {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius-card);
            padding: 1.25rem 1.35rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            transition: var(--transition-standard);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .metric-card-enhanced:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);
            border-color: #dee2e6;
        }

        .metric-card-enhanced::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
        }

        .accent-maroon::before { background-color: var(--marsu-maroon); }
        .accent-warning::before { background-color: #ffc107; }
        .accent-primary::before { background-color: #0d6efd; }
        .accent-success::before { background-color: #198754; }

        .icon-wrapper-soft {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .bg-soft-maroon { background-color: var(--marsu-maroon-soft); color: var(--marsu-maroon); }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

        .metric-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #6c757d;
        }

        /* Responsive Tables & Cards Container */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: var(--border-radius-card);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
            background-color: #ffffff;
        }

        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px;
            border-collapse: collapse !important;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle !important;
            padding: 14px 18px !important;
            border-bottom: 1px solid #f1f3f5 !important;
            white-space: nowrap;
        }

        .uncompressed-table tbody tr {
            transition: var(--transition-standard);
        }

        .uncompressed-table tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        .truncate-cell {
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Control Toolbar */
        .toolbar-card {
            background-color: #ffffff !important;
            border: 1px solid #e9ecef !important;
            border-radius: var(--border-radius-card) !important;
            padding: 1rem 1.25rem !important;
        }

        .search-pill-wrapper-short {
            background-color: #f8f9fa;
            border: 1.5px solid #dee2e6;
            border-radius: 50rem !important;
            padding: 7px 16px;
            display: flex; align-items: center;
            transition: var(--transition-standard);
            width: 280px !important;
            flex-shrink: 0;
        }

        .search-pill-wrapper-short:focus-within {
            border-color: var(--marsu-maroon);
            background-color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(88, 17, 26, 0.12);
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            outline: none !important;
            font-size: 0.85rem;
            color: #495057; width: 100%;
        }

        .filter-select {
            width: auto !important;
            min-width: 160px;
            padding: 7px 12px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
            border-color: #dee2e6;
        }

        /* Status & Category Badges */
        .badge-category { font-size: 0.78rem; font-weight: 600; padding: 5px 12px; border-radius: 6px; background: #f8f9fa; color: #495057; border: 1px solid #dcdcdc; }
        .badge-category-mental { font-size: 0.78rem; font-weight: 600; padding: 5px 12px; border-radius: 6px; background: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb; }
        .badge-category-physical { font-size: 0.78rem; font-weight: 600; padding: 5px 12px; border-radius: 6px; background: #e8f5e9; color: #1b5e20; border: 1px solid #c8e6c9; }
        .badge-category-injury { font-size: 0.78rem; font-weight: 600; padding: 5px 12px; border-radius: 6px; background: #fff3e0; color: #e65100; border: 1px solid #ffe0b2; }
        .badge-category-stress { font-size: 0.78rem; font-weight: 600; padding: 5px 12px; border-radius: 6px; background: #f3e5f5; color: #4a148c; border: 1px solid #e1bee7; }

        .status-badge-scheduled, .status-badge-progress, .status-badge-high { font-size: 0.78rem; font-weight: 600; padding: 5px 14px; border-radius: 50rem; background: #cff4fc; color: #055160; border: 1px solid #b6effb; }
        .status-badge-monitoring, .status-badge-review { font-size: 0.78rem; font-weight: 600; padding: 5px 14px; border-radius: 50rem; background: #fff3cd; color: #664d03; border: 1px solid #ffecb5; }
        .status-badge-cleared, .status-badge-effective, .status-badge-active { font-size: 0.78rem; font-weight: 600; padding: 5px 14px; border-radius: 50rem; background: #d4edda; color: #0f5132; border: 1px solid #198754; }
        .status-badge-none, .status-badge-referred { font-size: 0.78rem; font-weight: 600; padding: 5px 14px; border-radius: 50rem; background: #e2e3e5; color: #41464b; border: 1px solid #ced4da; }

        /* Buttons */
        .btn-maroon-primary {
            background-color: var(--marsu-maroon) !important;
            color: #ffffff !important;
            border: 1.5px solid var(--marsu-maroon-hover) !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 18px;
            border-radius: 8px;
            transition: var(--transition-standard);
        }
        .btn-maroon-primary:hover {
            background-color: var(--marsu-maroon-hover) !important;
            box-shadow: 0 4px 12px rgba(88, 17, 26, 0.25);
        }

        .btn-view-maroon {
            color: var(--marsu-maroon) !important;
            border: 1.5px solid var(--marsu-maroon) !important;
            background: #ffffff !important;
            font-weight: 600;
            padding: 5px 16px;
            border-radius: 6px;
            font-size: 0.825rem;
            transition: var(--transition-standard);
        }
        .btn-view-maroon:hover {
            color: #ffffff !important;
            background-color: var(--marsu-maroon) !important;
            box-shadow: 0 2px 8px rgba(88, 17, 26, 0.2);
        }

        /* Modal Card & Stepper */
        .essential-info-card {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 14px 16px;
        }
        .essential-label {
            font-size: 0.7rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        .essential-value { font-size: 0.9rem; color: #0f172a; font-weight: 600; }

        .compact-stepper { display: flex; align-items: center; justify-content: space-between; position: relative; padding: 12px 0 6px 0; }
        .compact-step-item { display: flex; flex-direction: column; align-items: center; z-index: 2; }
        .compact-step-circle { width: 32px; height: 32px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.825rem; margin-bottom: 4px; transition: var(--transition-standard); }
        .compact-step-circle.completed { background: #10b981; color: #fff; }
        .compact-step-circle.active { background: var(--marsu-maroon); color: #fff; box-shadow: 0 0 0 4px rgba(88, 17, 26, 0.15); }
        .compact-step-label { font-size: 0.725rem; font-weight: 600; color: #64748b; }
        .compact-step-line { position: absolute; top: 28px; left: 10%; right: 10%; height: 2px; background: #e2e8f0; z-index: 1; }
    </style>

    <!-- Header Breadcrumb & Global Actions -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-3 py-1.5 rounded-3">
                <i class="bi bi-house me-1.5"></i> Home
            </a>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">COMMAND CENTER & INTEGRATED ANALYTICS</span>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 rounded-3 fw-semibold" onclick="window.print()">
                <i class="bi bi-printer"></i> Export / Print Master Report
            </button>
            <div class="dropdown">
                <button class="btn btn-sm btn-maroon-primary dropdown-toggle d-inline-flex align-items-center gap-1.5" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-plus-circle"></i> Log New Entry
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="border-radius: 10px;">
                    <li><a class="dropdown-item small fw-semibold py-2 rounded-2" href="#" onclick="openAddHealthModal()"><i class="bi bi-heart-pulse me-2 marsu-maroon-text"></i>Health & Clinic Visit Log</a></li>
                    <li><a class="dropdown-item small fw-semibold py-2 rounded-2" href="#" onclick="openAddInterventionModal()"><i class="bi bi-journal-check me-2 text-primary"></i>Intervention Case Record</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Title & Subtitle Banner -->
    <div class="mb-4">
        <h3 class="fw-bold marsu-maroon-text mb-1">MarSU OSAS Integrated Welfare & Analytics Command Center</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
            Unified management system integrating student health consultations, crisis interventions, financial scholarship distributions, and division quality benchmarks[cite: 1].
        </p>
    </div>

    <!-- KPI Dashboard Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Active Cases</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="kpiTotalCases">259</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Across all OSAS Divisions</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2"><i class="bi bi-diagram-3-fill fs-4"></i></div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Under Active Observation</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="kpiActiveMonitoring">14</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Health & Guidance Intake</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2"><i class="bi bi-activity fs-4"></i></div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Interventions in Progress</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="kpiInterventions">19</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Case Handling</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2"><i class="bi bi-arrow-repeat fs-4"></i></div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Resolution Efficiency</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="kpiResolutionRate">90.9%</div>
                    <div class="small text-success fw-semibold mt-1" style="font-size: 0.75rem;"><i class="bi bi-arrow-up-short"></i> +3.2% vs target</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2"><i class="bi bi-check2-circle fs-4"></i></div>
            </div>
        </div>
    </div>

    <!-- Tabbed Navigation System -->
    <ul class="nav nav-tabs nav-tabs-marsu mb-4" id="commandCenterTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="tab-overview" data-bs-toggle="tab" data-bs-target="#pane-overview" type="button" role="tab"><i class="bi bi-grid-fill me-2"></i>Executive Overview</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="tab-health" data-bs-toggle="tab" data-bs-target="#pane-health" type="button" role="tab"><i class="bi bi-hospital-fill me-2"></i>Health Records (4)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="tab-analytics" data-bs-toggle="tab" data-bs-target="#pane-analytics" type="button" role="tab"><i class="bi bi-graph-up-arrow me-2"></i>Services Analytics (4)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="tab-interventions" data-bs-toggle="tab" data-bs-target="#pane-interventions" type="button" role="tab"><i class="bi bi-journal-check me-2"></i>Intervention Logs (5)</button>
        </li>
    </ul>

    <!-- Integrated Toolbar & Filter Control Bar -->
    <div class="card toolbar-card shadow-sm mb-4">
        <div class="d-flex flex-nowrap gap-3 align-items-center justify-content-between overflow-x-auto">
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="globalMasterSearch" class="search-pill-input" placeholder="Search record, ID, or student..." oninput="applyGlobalMasterSearch()" autocomplete="off">
            </div>
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Filter Status:</label>
                <select class="form-select form-select-sm filter-select" id="globalStatusFilter" onchange="applyGlobalMasterSearch()">
                    <option value="">All Statuses</option>
                    <option value="Scheduled">Scheduled / Active</option>
                    <option value="Monitoring">Monitoring / In Progress</option>
                    <option value="Cleared">Cleared / Effective</option>
                </select>
            </div>
            <div class="small text-muted flex-shrink-0 d-none d-md-block">
                <i class="bi bi-funnel-fill me-1 marsu-maroon-text"></i> Interactive Live Filter Active
            </div>
        </div>
    </div>

    <!-- Tab Panels Container -->
    <div class="tab-content" id="commandCenterTabContent">

        <!-- TAB 1: EXECUTIVE OVERVIEW -->
        <div class="tab-pane fade show active" id="pane-overview" role="tabpanel">
            <div class="row g-3 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: var(--border-radius-card);">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pie-chart-fill marsu-maroon-text me-2"></i> Student Concerns by Division</h6>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>Financial Assistance & Scholarship Grants</span><span class="marsu-maroon-text">51% (128 cases)</span>
                            </div>
                            <div class="progress" style="height: 8px;"><div class="progress-bar" style="width: 51%; background-color: var(--marsu-maroon) !important;"></div></div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>University Health & Wellness Clinic</span><span class="text-primary">26% (64 cases)</span>
                            </div>
                            <div class="progress" style="height: 8px;"><div class="progress-bar bg-primary" style="width: 26%;"></div></div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>Student Support & Mentorship Programs</span><span class="text-warning">16% (40 cases)</span>
                            </div>
                            <div class="progress" style="height: 8px;"><div class="progress-bar bg-warning" style="width: 16%;"></div></div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>Case Handling & Grievances</span><span class="text-danger">7% (18 cases)</span>
                            </div>
                            <div class="progress" style="height: 8px;"><div class="progress-bar bg-danger" style="width: 7%;"></div></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: var(--border-radius-card);">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-shield-check marsu-maroon-text me-2"></i> Intervention Effectiveness Benchmark</h6>
                        <div class="row text-center g-2 mb-3">
                            <div class="col-4"><div class="p-2.5 border rounded-3 bg-light"><div class="fs-4 fw-bold text-success">68%</div><div class="text-muted small">Fully Effective</div></div></div>
                            <div class="col-4"><div class="p-2.5 border rounded-3 bg-light"><div class="fs-4 fw-bold text-warning">24%</div><div class="text-muted small">Partially Effective</div></div></div>
                            <div class="col-4"><div class="p-2.5 border rounded-3 bg-light"><div class="fs-4 fw-bold text-danger">8%</div><div class="text-muted small">Needs Support</div></div></div>
                        </div>
                        <div class="p-3 border rounded-3 bg-light d-flex align-items-center gap-3">
                            <i class="bi bi-info-circle-fill marsu-maroon-text fs-4 flex-shrink-0"></i>
                            <p class="text-muted small mb-0 lh-sm">
                                82% of students receiving academic mentorship or emergency grants successfully achieved baseline stability within 30 days[cite: 1].
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: HEALTH RECORDS -->
        <div class="tab-pane fade" id="pane-health" role="tabpanel">
            <div class="table-responsive-spaced">
                <table class="table table-hover align-middle mb-0 uncompressed-table">
                    <thead class="table-light text-uppercase small text-muted">
                        <tr>
                            <th class="ps-3 py-3" style="width: 10%;">Health No.</th>
                            <th class="py-3" style="width: 17%;">Student Name</th>
                            <th class="py-3" style="width: 15%;">Concern Category</th>
                            <th class="py-3" style="width: 17%;">Diagnosis</th>
                            <th class="py-3" style="width: 17%;">Service Provided</th>
                            <th class="py-3 text-center" style="width: 10%;">Visit Date</th>
                            <th class="py-3" style="width: 13%;">Attending Staff</th>
                            <th class="py-3 text-center" style="width: 11%;">Follow-up</th>
                            <th class="py-3 text-center pe-3" style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="masterHealthTbody">
                        <tr class="master-row" data-search="hs-0364 villanueva, kim d. mental health anxiety episode scheduled">
                            <td class="ps-3 fw-semibold text-secondary">HS-0364</td>
                            <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                            <td><span class="badge-category-mental">Mental Health</span></td>
                            <td class="text-muted truncate-cell">Anxiety episode</td>
                            <td class="text-muted truncate-cell">First aid, psych referral</td>
                            <td class="text-center text-muted">Sep 12, 2026</td>
                            <td class="text-muted">Nurse D. Ilagan</td>
                            <td class="text-center"><span class="status-badge-scheduled">Scheduled</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('HS-0364', 'Villanueva, Kim D.', 'Mental Health Clinic', 'Anxiety episode', 'First aid, psych referral', 'Sep 12, 2026', 'Nurse D. Ilagan', 'Scheduled', 'Referred to Guidance Office for follow-up cognitive stress evaluation.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="hs-0363 torres, miguel a. physical illness mild fever none needed">
                            <td class="ps-3 fw-semibold text-secondary">HS-0363</td>
                            <td class="fw-semibold text-dark truncate-cell">Torres, Miguel A.</td>
                            <td><span class="badge-category-physical">Physical Illness</span></td>
                            <td class="text-muted truncate-cell">Mild fever, flu symptoms</td>
                            <td class="text-muted truncate-cell">Consultation, medication</td>
                            <td class="text-center text-muted">Sep 10, 2026</td>
                            <td class="text-muted">Dr. R. Salcedo</td>
                            <td class="text-center"><span class="status-badge-none">None needed</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('HS-0363', 'Torres, Miguel A.', 'Physical Illness Clinic', 'Mild fever, flu symptoms', 'Consultation, medication', 'Sep 10, 2026', 'Dr. R. Salcedo', 'None needed', 'Prescribed antipyretics and advised rest. Case resolved.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="hs-0362 aquino, ronald p. injury trauma sprain cleared">
                            <td class="ps-3 fw-semibold text-secondary">HS-0362</td>
                            <td class="fw-semibold text-dark truncate-cell">Aquino, Ronald P.</td>
                            <td><span class="badge-category-injury">Injury / Trauma</span></td>
                            <td class="text-muted truncate-cell">Sports-related sprain</td>
                            <td class="text-muted truncate-cell">First aid, rest advisory</td>
                            <td class="text-center text-muted">Sep 04, 2026</td>
                            <td class="text-muted">Nurse D. Ilagan</td>
                            <td class="text-center"><span class="status-badge-cleared">Cleared</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('HS-0362', 'Aquino, Ronald P.', 'Physical Injury Unit', 'Sports-related sprain', 'First aid, rest advisory', 'Sep 04, 2026', 'Nurse D. Ilagan', 'Cleared', 'Ankle inflammation fully resolved. Medical clearance issued.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="hs-0361 bautista, hazel m. stress wellness migraine monitoring">
                            <td class="ps-3 fw-semibold text-secondary">HS-0361</td>
                            <td class="fw-semibold text-dark truncate-cell">Bautista, Hazel M.</td>
                            <td><span class="badge-category-stress">Stress & Wellness</span></td>
                            <td class="text-muted truncate-cell">Migraine, stress-related</td>
                            <td class="text-muted truncate-cell">Medication, guidance referral</td>
                            <td class="text-center text-muted">Aug 27, 2026</td>
                            <td class="text-muted">Dr. R. Salcedo</td>
                            <td class="text-center"><span class="status-badge-monitoring">Monitoring</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('HS-0361', 'Bautista, Hazel M.', 'Stress & Wellness', 'Migraine, stress-related', 'Medication, guidance referral', 'Aug 27, 2026', 'Dr. R. Salcedo', 'Monitoring', 'Scheduled for weekly blood pressure monitoring and guidance sessions.')">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 3: SERVICES ANALYTICS -->
        <div class="tab-pane fade" id="pane-analytics" role="tabpanel">
            <div class="table-responsive-spaced">
                <table class="table table-hover align-middle mb-0 uncompressed-table">
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
                    <tbody class="small" id="masterAnalyticsTbody">
                        <tr class="master-row" data-search="srv-2026-001 university health services dr. r. salcedo active / on track">
                            <td class="ps-3 fw-semibold text-secondary">SRV-2026-001</td>
                            <td class="fw-semibold text-dark truncate-cell">University Health Services</td>
                            <td><span class="badge-category">Clinic & Mental Health</span></td>
                            <td class="text-center fw-bold text-dark">64 Cases</td>
                            <td class="text-center fw-bold text-success">92.1%</td>
                            <td class="text-muted truncate-cell">Dr. R. Salcedo</td>
                            <td class="text-center"><span class="status-badge-active">Active / On Track</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('SRV-2026-001', 'University Health Services', 'Clinic & Mental Health', '64 Consultations', '92.1% Resolution', 'AY 2026-2027', 'Dr. R. Salcedo', 'Active / On Track', 'Clinical consultations and psychological intake executing with high efficiency.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="srv-2026-002 financial assistance grants ms. e. rodelas high volume">
                            <td class="ps-3 fw-semibold text-secondary">SRV-2026-002</td>
                            <td class="fw-semibold text-dark truncate-cell">Financial Assistance & Grants</td>
                            <td><span class="badge-category">TDP-TES & Emergency Aid</span></td>
                            <td class="text-center fw-bold text-dark">128 Grants</td>
                            <td class="text-center fw-bold text-success">88.5%</td>
                            <td class="text-muted truncate-cell">Ms. E. Rodelas</td>
                            <td class="text-center"><span class="status-badge-high">High Volume</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('SRV-2026-002', 'Financial Assistance & Grants', 'TDP-TES & Emergency Aid', '128 Grants', '88.5% Resolution', 'AY 2026-2027', 'Ms. E. Rodelas', 'High Volume', 'Peak intake for TDP-TES 1st semester allowances. Disbursement on schedule.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="srv-2026-003 case grievance management atty. santos pending review">
                            <td class="ps-3 fw-semibold text-secondary">SRV-2026-003</td>
                            <td class="fw-semibold text-dark truncate-cell">Case & Grievance Management</td>
                            <td><span class="badge-category">Disciplinary & Grievance</span></td>
                            <td class="text-center fw-bold text-dark">18 Cases</td>
                            <td class="text-center fw-bold text-warning">78.0%</td>
                            <td class="text-muted truncate-cell">Atty. Santos</td>
                            <td class="text-center"><span class="status-badge-review">Pending Review</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('SRV-2026-003', 'Case & Grievance Management', 'Disciplinary & Grievance', '18 Cases', '78.0% Resolution', 'AY 2026-2027', 'Atty. Santos', 'Pending Review', 'Formal grievance proceedings underway with student tribunal committee.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="srv-2026-004 student support programs j. marasigan active / on track">
                            <td class="ps-3 fw-semibold text-secondary">SRV-2026-004</td>
                            <td class="fw-semibold text-dark truncate-cell">Student Support Programs</td>
                            <td><span class="badge-category">Mentorship & Commuter Aid</span></td>
                            <td class="text-center fw-bold text-dark">40 Cases</td>
                            <td class="text-center fw-bold text-success">95.0%</td>
                            <td class="text-muted truncate-cell">J. Marasigan</td>
                            <td class="text-center"><span class="status-badge-active">Active / On Track</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('SRV-2026-004', 'Student Support Programs', 'Mentorship & Commuter Aid', '40 Cases', '95.0% Resolution', 'AY 2026-2027', 'J. Marasigan', 'Active / On Track', 'High student engagement across campus mentorship and commuter support networks.')">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 4: INTERVENTION LOGS -->
        <div class="tab-pane fade" id="pane-interventions" role="tabpanel">
            <div class="table-responsive-spaced">
                <table class="table table-hover align-middle mb-0 uncompressed-table">
                    <thead class="table-light text-uppercase small text-muted">
                        <tr>
                            <th class="ps-3 py-3" style="width: 12%;">Intervention No.</th>
                            <th class="py-3" style="width: 13%;">Case No.</th>
                            <th class="py-3" style="width: 18%;">Student Name</th>
                            <th class="py-3" style="width: 20%;">Intervention Type</th>
                            <th class="py-3 text-center" style="width: 11%;">Date Logged</th>
                            <th class="py-3" style="width: 13%;">Provided By</th>
                            <th class="py-3 text-center" style="width: 11%;">Outcome</th>
                            <th class="py-3 text-center pe-3" style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="masterInterventionTbody">
                        <tr class="master-row" data-search="iv-0731 cm-2026-0246 villanueva, kim d. crisis intervention monitoring">
                            <td class="ps-3 fw-semibold text-secondary">IV-0731</td>
                            <td class="fw-semibold text-dark">CM-2026-0246</td>
                            <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                            <td><span class="badge-category">Crisis Intervention</span></td>
                            <td class="text-center text-muted">Sep 12, 2026</td>
                            <td class="text-muted truncate-cell">J. Marasigan</td>
                            <td class="text-center"><span class="status-badge-monitoring">Monitoring</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('IV-0731', 'Villanueva, Kim D.', 'Crisis Intervention Unit', 'CM-2026-0246', 'Panic Episode De-escalation', 'Sep 12, 2026', 'J. Marasigan', 'Monitoring', 'De-escalation protocol applied during panic episode. Weekly counselor check-ins scheduled.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="iv-0730 cm-2026-0248 dela cruz, angelo m. academic coaching in progress">
                            <td class="ps-3 fw-semibold text-secondary">IV-0730</td>
                            <td class="fw-semibold text-dark">CM-2026-0248</td>
                            <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Angelo M.</td>
                            <td><span class="badge-category">Academic Coaching</span></td>
                            <td class="text-center text-muted">Sep 10, 2026</td>
                            <td class="text-muted truncate-cell">G. Panganiban</td>
                            <td class="text-center"><span class="status-badge-progress">In progress</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('IV-0730', 'Dela Cruz, Angelo M.', 'Academic Guidance', 'CM-2026-0248', 'Academic Coaching Plan', 'Sep 10, 2026', 'G. Panganiban', 'In progress', 'Structured study plan created for midterm recovery. Faculty coordination underway.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="iv-0729 cm-2026-0247 reyes, maricel s. financial assistance referred out">
                            <td class="ps-3 fw-semibold text-secondary">IV-0729</td>
                            <td class="fw-semibold text-dark">CM-2026-0247</td>
                            <td class="fw-semibold text-dark truncate-cell">Reyes, Maricel S.</td>
                            <td><span class="badge-category">Financial Assistance</span></td>
                            <td class="text-center text-muted">Sep 08, 2026</td>
                            <td class="text-muted truncate-cell">E. Rodelas</td>
                            <td class="text-center"><span class="status-badge-referred">Referred out</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('IV-0729', 'Reyes, Maricel S.', 'Financial Aid Office', 'CM-2026-0247', 'Emergency Cash Grant', 'Sep 08, 2026', 'E. Rodelas', 'Referred out', 'Forwarded emergency cash grant application to OSAS Scholarship Office for approval.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="iv-0728 cm-2026-0245 santos, paolo r. family consultation effective">
                            <td class="ps-3 fw-semibold text-secondary">IV-0728</td>
                            <td class="fw-semibold text-dark">CM-2026-0245</td>
                            <td class="fw-semibold text-dark truncate-cell">Santos, Paolo R.</td>
                            <td><span class="badge-category">Family Consultation</span></td>
                            <td class="text-center text-muted">Aug 30, 2026</td>
                            <td class="text-muted truncate-cell">E. Rodelas</td>
                            <td class="text-center"><span class="status-badge-effective">Effective</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('IV-0728', 'Santos, Paolo R.', 'Family Guidance Unit', 'CM-2026-0245', 'Parent-Guardian Conference', 'Aug 30, 2026', 'E. Rodelas', 'Effective', 'Parent-guardian conference conducted. Academic commitment agreement signed successfully.')">View</button>
                            </td>
                        </tr>
                        <tr class="master-row" data-search="iv-0727 cm-2026-0244 ramos, bea j. behavioral contract effective">
                            <td class="ps-3 fw-semibold text-secondary">IV-0727</td>
                            <td class="fw-semibold text-dark">CM-2026-0244</td>
                            <td class="fw-semibold text-dark truncate-cell">Ramos, Bea J.</td>
                            <td><span class="badge-category">Behavioral Contract</span></td>
                            <td class="text-center text-muted">Aug 27, 2026</td>
                            <td class="text-muted truncate-cell">G. Panganiban</td>
                            <td class="text-center"><span class="status-badge-effective">Effective</span></td>
                            <td class="text-center pe-3">
                                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openMasterViewModal('IV-0727', 'Ramos, Bea J.', 'Student Discipline Unit', 'CM-2026-0244', 'Behavioral Contract Plan', 'Aug 27, 2026', 'G. Panganiban', 'Effective', 'Behavioral modification plan completed without further attendance policy breaches.')">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Governance Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm mt-4">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm flex-shrink-0">
                <i class="bi bi-shield-lock-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1">MarSU OSAS Data Protection & Governance Protocol</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Integrates Health Services, Guidance Case Handling, and Scholarship units[cite: 1]. Student records are strictly protected under the Data Privacy Act[cite: 1].
                </p>
            </div>
        </div>
    </div>

</div>

<!-- UNIFIED MASTER VIEW MODAL -->
<div class="modal fade" id="masterViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">RECORD DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="mvRecordId">HS-0364</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light-subtle">
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Primary Subject / Student</span>
                        <span class="status-badge-scheduled" id="mvBadge">Active</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="mvSubject">Villanueva, Kim D.</h5>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Department / Unit</div>
                            <div class="essential-value marsu-maroon-text" id="mvUnit">Health Services</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Logged Date</div>
                            <div class="essential-value text-dark" id="mvDate">Sep 12, 2026</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Primary Focus / Diagnosis</div>
                            <div class="essential-value text-dark" id="mvFocus">Anxiety episode</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Service / Action Taken</div>
                            <div class="essential-value text-dark" id="mvAction">First aid, psych referral</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Responsible Staff</div>
                            <div class="essential-value text-dark" id="mvStaff">Nurse D. Ilagan</div>
                        </div>
                    </div>
                </div>
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Lifecycle Progress Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item"><div class="compact-step-circle completed"><i class="bi bi-check"></i></div><span class="compact-step-label">Intake</span></div>
                        <div class="compact-step-item"><div class="compact-step-circle active">2</div><span class="compact-step-label text-dark fw-bold">Active Care</span></div>
                        <div class="compact-step-item"><div class="compact-step-circle">3</div><span class="compact-step-label">Resolved</span></div>
                    </div>
                </div>
                <div class="essential-info-card">
                    <div class="essential-label mb-1">Evaluated Notes & Referrals</div>
                    <div class="small text-dark fw-semibold" id="mvNotes">Case undergoing weekly review.</div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2 px-4">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function applyGlobalMasterSearch() {
        const query = document.getElementById('globalMasterSearch').value.toLowerCase().trim();
        const statusVal = document.getElementById('globalStatusFilter').value.toLowerCase();
        
        const rows = document.querySelectorAll('.master-row');
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search').toLowerCase();
            const matchesQuery = !query || searchData.includes(query);
            const matchesStatus = !statusVal || searchData.includes(statusVal);
            
            if (matchesQuery && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function openMasterViewModal(id, subject, unit, focus, action, date, staff, status, notes) {
        document.getElementById('mvRecordId').innerText = id;
        document.getElementById('mvSubject').innerText = subject;
        document.getElementById('mvUnit').innerText = unit;
        document.getElementById('mvFocus').innerText = focus;
        document.getElementById('mvAction').innerText = action;
        document.getElementById('mvDate').innerText = date;
        document.getElementById('mvStaff').innerText = staff;
        document.getElementById('mvNotes').innerText = notes;
        
        const badge = document.getElementById('mvBadge');
        badge.innerText = status;
        
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('masterViewModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Record Details: ' + id + ' - ' + subject);
        }
    }

    function openAddHealthModal() {
        alert('Opening Add Health Consultation Form...');
    }

    function openAddInterventionModal() {
        alert('Opening Add Intervention Case Form...');
    }
</script>