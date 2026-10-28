<!-- Intervention Documentation & Case Logs Management (MarSU OSAS Standard) -->
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
            border: 1px solid #dee2e6;
        }

        /* Flexible Uncompressed Table Layout */
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
        .accent-warning::before { background-color: #ffc107; }
        .accent-primary::before { background-color: #0d6efd; }
        .accent-success::before { background-color: #198754; }

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
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

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

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        /* Intervention Type Badges */
        .badge-type {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8f9fa !important;
            color: #495057 !important;
            border: 1px solid #dcdcdc !important;
            display: inline-block !important;
        }

        /* Outcome Status Badges */
        .status-badge-monitoring {
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

        .status-badge-progress {
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

        .status-badge-referred {
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

        .status-badge-effective {
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
            <span class="small fw-bold text-secondary">CASE HANDLING</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">INTERVENTION LOG</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Intervention Documentation</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 850px;">
            Comprehensive record of guidance, health clinic visits, crisis management, and student welfare interventions provided to students, along with their evaluated outcomes[cite: 1].
        </p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Interventions -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Interventions</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalInterventions">5</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Documented Logs</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-journal-bookmark-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Active / In Progress -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">In Progress</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricInProgress">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Interventions</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-arrow-repeat fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Under Active Monitoring -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Under Monitoring</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricMonitoring">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Observation Stage</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-eye-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Resolved / Effective -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Effective / Resolved</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricEffective">2</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Successful Outcomes</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle-fill fs-4"></i>
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
                <input type="search" id="searchInterventions" class="search-pill-input" placeholder="Search student or case no..." oninput="applyInterventionFilters()" autocomplete="off">
            </div>

            <!-- 2. Intervention Type Dropdown -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Type:</label>
                <select class="form-select form-select-sm filter-select" id="typeFilter" onchange="applyInterventionFilters()">
                    <option value="">All Types</option>
                    <option value="Crisis Intervention">Crisis Intervention</option>
                    <option value="Academic Coaching">Academic Coaching</option>
                    <option value="Financial Assistance Facilitation">Financial Assistance</option>
                    <option value="Family Consultation">Family Consultation</option>
                    <option value="Behavioral Contract">Behavioral Contract</option>
                </select>
            </div>

            <!-- 3. Outcome Dropdown -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Outcome:</label>
                <select class="form-select form-select-sm filter-select" id="outcomeFilter" onchange="applyInterventionFilters()">
                    <option value="">All Outcomes</option>
                    <option value="Monitoring">Monitoring</option>
                    <option value="In progress">In progress</option>
                    <option value="Referred out">Referred out</option>
                    <option value="Effective">Effective</option>
                </select>
            </div>

            <!-- 4. Log Intervention Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openAddInterventionModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Log Intervention
            </button>

        </div>
    </div>

    <!-- Intervention Documentation Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="tblInterventions">
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
            <tbody class="small" id="interventionTableBody">
                <tr class="intervention-row" id="row-iv-0731" data-id="iv-0731" data-case="cm-2026-0246" data-student="villanueva, kim d." data-type="Crisis Intervention" data-status="Monitoring">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IV-0731</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0246</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                    <td><span class="badge-type">Crisis Intervention</span></td>
                    <td class="text-center text-muted text-nowrap">Sep 12, 2026</td>
                    <td class="text-muted truncate-cell">J. Marasigan</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-monitoring">Monitoring</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IV-0731', 'CM-2026-0246', 'Villanueva, Kim D.', 'Crisis Intervention', 'Sep 12, 2026', 'J. Marasigan', 'Monitoring', 'De-escalation protocol applied during panic attack episode. Weekly counselor check-ins scheduled.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-iv-0730" data-id="iv-0730" data-case="cm-2026-0248" data-student="dela cruz, angelo m." data-type="Academic Coaching" data-status="In progress">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IV-0730</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Angelo M.</td>
                    <td><span class="badge-type">Academic Coaching</span></td>
                    <td class="text-center text-muted text-nowrap">Sep 10, 2026</td>
                    <td class="text-muted truncate-cell">G. Panganiban</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-progress">In progress</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IV-0730', 'CM-2026-0248', 'Dela Cruz, Angelo M.', 'Academic Coaching', 'Sep 10, 2026', 'G. Panganiban', 'In progress', 'Structured study plan created for midterm recovery. Faculty coordination underway.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-iv-0729" data-id="iv-0729" data-case="cm-2026-0247" data-student="reyes, maricel s." data-type="Financial Assistance Facilitation" data-status="Referred out">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IV-0729</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0247</td>
                    <td class="fw-semibold text-dark truncate-cell">Reyes, Maricel S.</td>
                    <td><span class="badge-type">Financial Assistance</span></td>
                    <td class="text-center text-muted text-nowrap">Sep 08, 2026</td>
                    <td class="text-muted truncate-cell">E. Rodelas</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-referred">Referred out</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IV-0729', 'CM-2026-0247', 'Reyes, Maricel S.', 'Financial Assistance Facilitation', 'Sep 08, 2026', 'E. Rodelas', 'Referred out', 'Forwarded emergency cash grant application to OSAS Scholarship Office for approval.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-iv-0728" data-id="iv-0728" data-case="cm-2026-0245" data-student="santos, paolo r." data-type="Family Consultation" data-status="Effective">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IV-0728</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0245</td>
                    <td class="fw-semibold text-dark truncate-cell">Santos, Paolo R.</td>
                    <td><span class="badge-type">Family Consultation</span></td>
                    <td class="text-center text-muted text-nowrap">Aug 30, 2026</td>
                    <td class="text-muted truncate-cell">E. Rodelas</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-effective">Effective</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IV-0728', 'CM-2026-0245', 'Santos, Paolo R.', 'Family Consultation', 'Aug 30, 2026', 'E. Rodelas', 'Effective', 'Parent-guardian conference conducted. Academic commitment agreement signed successfully.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="intervention-row" id="row-iv-0727" data-id="iv-0727" data-case="cm-2026-0244" data-student="ramos, bea j." data-type="Behavioral Contract" data-status="Effective">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">IV-0727</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0244</td>
                    <td class="fw-semibold text-dark truncate-cell">Ramos, Bea J.</td>
                    <td><span class="badge-type">Behavioral Contract</span></td>
                    <td class="text-center text-muted text-nowrap">Aug 27, 2026</td>
                    <td class="text-muted truncate-cell">G. Panganiban</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-effective">Effective</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('IV-0727', 'CM-2026-0244', 'Ramos, Bea J.', 'Behavioral Contract', 'Aug 27, 2026', 'G. Panganiban', 'Effective', 'Behavioral modification plan completed without further attendance policy breaches.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noInterventionRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No intervention records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 5 of 5 intervention records</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Intervention Protocol Notice Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-shield-check marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Intervention Case Logging Guidelines</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    All intervention logs must contain factual descriptions, designated staff accountability, specific dates, and evaluated progress outcomes[cite: 1]. Documented interventions form part of confidential student case records accessible only to authorized OSAS personnel and guidance officers under data privacy policies[cite: 1].
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (INTERVENTION FOCUS)             -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialInterventionModal" tabindex="-1" aria-labelledby="essentialInterventionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">INTERVENTION RECORD DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vInterventionNo">IV-0731</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeInterventionNo" value="">

                <!-- 1. Student Name Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student Name</span>
                        <span class="status-badge-monitoring" id="vStatusBadge">Monitoring</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Villanueva, Kim D.</h5>
                </div>

                <!-- 2. Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Case No.</div>
                            <div class="essential-value marsu-maroon-text" id="vCaseNo">CM-2026-0246</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Date Logged</div>
                            <div class="essential-value text-dark" id="vDateLogged">Sep 12, 2026</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Intervention Type</div>
                            <div class="essential-value text-dark" id="vType">Crisis Intervention</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Provided By</div>
                            <div class="essential-value text-dark" id="vProvidedBy">J. Marasigan</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Intervention Lifecycle Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="ivst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Initiated</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="ivst2">2</div>
                            <span class="compact-step-label text-dark fw-bold">Active Care</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="ivst3">3</div>
                            <span class="compact-step-label">Resolved</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Intervention Notes -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Evaluated Outcome & Progress Notes</div>
                    <div class="small text-dark fw-semibold" id="vNotes">De-escalation protocol applied during panic attack episode. Weekly counselor check-ins scheduled.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Outcome Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Monitoring">Monitoring</option>
                            <option value="In progress">In progress</option>
                            <option value="Referred out">Referred out</option>
                            <option value="Effective">Effective</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialInterventionStatus()">Save Status</button>
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
<!-- MODAL 2: LOG NEW INTERVENTION ENTRY                                   -->
<!-- ===================================================================== -->
<div class="modal fade" id="addInterventionModal" tabindex="-1" aria-labelledby="addInterventionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addInterventionModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Log Intervention Record
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addInterventionForm" onsubmit="saveNewInterventionRecord(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Intervention No.</label>
                            <input type="text" class="form-control form-control-sm" id="newInterventionNo" placeholder="e.g. IV-0732" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Case No.</label>
                            <input type="text" class="form-control form-control-sm" id="newCaseNo" placeholder="e.g. CM-2026-0249" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Garcia, Maria L." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Intervention Type</label>
                            <select class="form-select form-select-sm" id="newType" required>
                                <option value="Crisis Intervention">Crisis Intervention</option>
                                <option value="Academic Coaching">Academic Coaching</option>
                                <option value="Financial Assistance Facilitation">Financial Assistance Facilitation</option>
                                <option value="Family Consultation">Family Consultation</option>
                                <option value="Behavioral Contract">Behavioral Contract</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Outcome Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Monitoring">Monitoring</option>
                                <option value="In progress">In progress</option>
                                <option value="Referred out">Referred out</option>
                                <option value="Effective">Effective</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Date Logged</label>
                            <input type="date" class="form-control form-control-sm" id="newDateLogged" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Provided By (Staff)</label>
                            <input type="text" class="form-control form-control-sm" id="newProvidedBy" placeholder="e.g. J. Marasigan" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Evaluated Outcome & Intervention Notes</label>
                        <textarea class="form-control form-control-sm" id="newNotes" rows="3" placeholder="Detail the support actions taken and current progress..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Log</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyInterventionFilters() {
        const searchInput = document.getElementById('searchInterventions').value.toLowerCase().trim();
        const typeFilter = document.getElementById('typeFilter').value;
        const outcomeFilter = document.getElementById('outcomeFilter').value;

        const rows = document.querySelectorAll('.intervention-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const caseNo = row.getAttribute('data-case');
            const student = row.getAttribute('data-student');
            const type = row.getAttribute('data-type');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || caseNo.includes(searchInput) || student.includes(searchInput);
            const matchesType = !typeFilter || type.toLowerCase() === typeFilter.toLowerCase();
            const matchesOutcome = !outcomeFilter || status.toLowerCase() === outcomeFilter.toLowerCase();

            if (matchesSearch && matchesType && matchesOutcome) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noInterventionRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} intervention records`;
        }
    }

    function openEssentialInterventionModal(interventionNo, caseNo, student, type, date, staff, status, notes) {
        document.getElementById('activeInterventionNo').value = interventionNo.toLowerCase();
        document.getElementById('vInterventionNo').innerText = interventionNo;
        document.getElementById('vCaseNo').innerText = caseNo;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vType').innerText = type;
        document.getElementById('vDateLogged').innerText = date || '—';
        document.getElementById('vProvidedBy').innerText = staff;
        document.getElementById('vNotes').innerText = notes || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'monitoring') badgeElem.className = 'status-badge-monitoring';
        else if (lower === 'in progress') badgeElem.className = 'status-badge-progress';
        else if (lower === 'referred out') badgeElem.className = 'status-badge-referred';
        else badgeElem.className = 'status-badge-effective';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('ivst1');
        const st2 = document.getElementById('ivst2');
        const st3 = document.getElementById('ivst3');

        st1.className = 'compact-step-circle completed';

        if (lower === 'effective' || lower === 'referred out') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st3.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'in progress' || lower === 'monitoring') {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        } else {
            st1.className = 'compact-step-circle active';
            st1.innerText = '1';
            st2.className = 'compact-step-circle';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialInterventionModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Intervention Record Details: ' + interventionNo);
        }
    }

    function saveEssentialInterventionStatus() {
        const activeInterventionNo = document.getElementById('activeInterventionNo').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeInterventionNo);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-referred';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'monitoring') newBadgeClass = 'status-badge-monitoring';
            else if (lowerStatus === 'in progress') newBadgeClass = 'status-badge-progress';
            else if (lowerStatus === 'effective') newBadgeClass = 'status-badge-effective';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const caseText = targetRow.cells[1].innerText;
                const studentText = targetRow.cells[2].innerText;
                const typeText = targetRow.cells[3].innerText.trim();
                const dateText = targetRow.cells[4].innerText;
                const staffText = targetRow.cells[5].innerText;
                const notesText = document.getElementById('vNotes').innerText;

                viewBtn.setAttribute('onclick', `openEssentialInterventionModal('${idText}', '${caseText}', '${studentText}', '${typeText}', '${dateText}', '${staffText}', '${newStatus}', '${notesText}')`);
            }
        }

        const modalElem = document.getElementById('essentialInterventionModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyInterventionFilters();
        alert('Intervention outcome status successfully updated!');
    }

    function openAddInterventionModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addInterventionModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Log Intervention Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.intervention-row');
        let totalCount = rows.length;
        let inProgressCount = 0;
        let monitoringCount = 0;
        let effectiveCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();

            if (status === 'in progress') {
                inProgressCount++;
            } else if (status === 'monitoring') {
                monitoringCount++;
            } else if (status === 'effective' || status === 'referred out') {
                effectiveCount++;
            }
        });

        document.getElementById('metricTotalInterventions').innerText = totalCount;
        document.getElementById('metricInProgress').innerText = inProgressCount;
        document.getElementById('metricMonitoring').innerText = monitoringCount;
        document.getElementById('metricEffective').innerText = effectiveCount;
    }

    function saveNewInterventionRecord(e) {
        e.preventDefault();

        const interventionNo = document.getElementById('newInterventionNo').value.trim();
        const caseNo = document.getElementById('newCaseNo').value.trim();
        const student = document.getElementById('newStudentName').value.trim();
        const type = document.getElementById('newType').value;
        const status = document.getElementById('newStatus').value;
        const rawDate = document.getElementById('newDateLogged').value;
        const staff = document.getElementById('newProvidedBy').value.trim();
        const notes = document.getElementById('newNotes').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-referred';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'monitoring') badgeClass = 'status-badge-monitoring';
        else if (lowerStatus === 'in progress') badgeClass = 'status-badge-progress';
        else if (lowerStatus === 'effective') badgeClass = 'status-badge-effective';

        const rowId = 'row-' + interventionNo.toLowerCase();
        const tbody = document.getElementById('interventionTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'intervention-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', interventionNo.toLowerCase());
        newTr.setAttribute('data-case', caseNo.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-type', type);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${interventionNo}</td>
            <td class="fw-semibold text-dark text-nowrap">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="badge-type">${type}</span></td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-muted truncate-cell">${staff}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialInterventionModal('${interventionNo}', '${caseNo}', '${student}', '${type}', '${formattedDate}', '${staff}', '${status}', '${notes}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('addInterventionModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('addInterventionForm').reset();

        recalculateMetrics();
        applyInterventionFilters();
    }
</script>