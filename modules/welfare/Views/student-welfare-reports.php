<!-- Student Welfare Reports Management (MarSU OSAS Standard - Export Ready) -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll */
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

        /* Status Badges */
        .status-badge-approved {
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

        .status-badge-submitted {
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

        .status-badge-draft {
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

        /* Buttons */
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

        .btn-export-maroon {
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

        .btn-export-maroon:hover {
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
            Generate, compile, export, and archive institutional summaries on student socio-economic profiles, financial assistance distributions, case resolutions, and student support metrics[cite: 1].
        </p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Reports</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalReports">4</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Compiled Summaries</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-file-earmark-bar-graph-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Approved Reports</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricApproved">2</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Executive Audited</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-patch-check-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricPending">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Awaiting Clearance</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Term Analytics</div>
                    <div class="fs-2 fw-bold text-primary lh-1">1st Sem</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">AY 2026–2027</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-pie-chart-fill fs-4"></i>
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
                <input type="search" id="reportSearch" class="search-pill-input" placeholder="Search title or personnel..." oninput="applyReportFilters()" autocomplete="off">
            </div>

            <!-- 2. Report Scope Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Scope:</label>
                <select class="form-select form-select-sm filter-select" id="reportScopeFilter" onchange="applyReportFilters()">
                    <option value="">All Scopes</option>
                    <option value="Socio-economic Summary">Socio-economic Summary</option>
                    <option value="Financial Aid Disbursement">Financial Aid Disbursement</option>
                    <option value="Case Resolution Metrics">Case Resolution Metrics</option>
                    <option value="Guidance Counseling Log">Guidance Counseling Log</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="reportStatusFilter" onchange="applyReportFilters()">
                    <option value="">All Statuses</option>
                    <option value="Approved">Approved</option>
                    <option value="Pending Review">Pending Review</option>
                    <option value="Submitted">Submitted</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>

            <!-- 4. Primary Action Buttons (Generate & Export All) -->
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold d-inline-flex align-items-center gap-1" onclick="exportAllReportsCSV()">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export All (CSV)
                </button>
                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="openGenerateReportModal()">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Generate Report
                </button>
            </div>

        </div>
    </div>

    <!-- Student Welfare Reports Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="reportTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 11%;">Report ID</th>
                    <th class="py-3" style="width: 22%;">Report Title</th>
                    <th class="py-3" style="width: 17%;">Report Scope</th>
                    <th class="py-3" style="width: 13%;">Academic Term</th>
                    <th class="py-3" style="width: 15%;">Prepared By (Personnel)</th>
                    <th class="py-3 text-center" style="width: 10%;">Date Created</th>
                    <th class="py-3 text-center" style="width: 11%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 8%;">Export</th>
                </tr>
            </thead>
            <tbody class="small" id="reportTableBody">
                <tr class="report-row" id="row-swr-2026-012" data-id="swr-2026-012" data-title="q3 student financial aid & stipend summary" data-scope="Financial Aid Disbursement" data-status="Approved">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SWR-2026-012</td>
                    <td class="fw-semibold text-dark truncate-cell">Q3 Student Financial Aid & Stipend Summary</td>
                    <td><span class="badge-category">Financial Aid Disbursement</span></td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted truncate-cell">Ms. E. Rodelas (Scholarship Lead)</td>
                    <td class="text-center text-muted text-nowrap">Oct 14, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-approved">Approved</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-export-maroon btn-sm" onclick="exportSingleReport('SWR-2026-012', 'Q3 Student Financial Aid & Stipend Summary', 'Financial Aid Disbursement', 'AY 2026–2027 (1st Sem)', 'Ms. E. Rodelas (Scholarship Lead)', 'Oct 14, 2026', 'Approved')">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </td>
                </tr>
                <tr class="report-row" id="row-swr-2026-011" data-id="swr-2026-011" data-title="mid-term student grievance & case resolution audit" data-scope="Case Resolution Metrics" data-status="Pending Review">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SWR-2026-011</td>
                    <td class="fw-semibold text-dark truncate-cell">Mid-Term Student Grievance & Case Resolution Audit</td>
                    <td><span class="badge-category">Case Resolution Metrics</span></td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted truncate-cell">Atty. Santos (Student Rights Unit)</td>
                    <td class="text-center text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-review">Pending Review</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-export-maroon btn-sm" onclick="exportSingleReport('SWR-2026-011', 'Mid-Term Student Grievance & Case Resolution Audit', 'Case Resolution Metrics', 'AY 2026–2027 (1st Sem)', 'Atty. Santos (Student Rights Unit)', 'Oct 10, 2026', 'Pending Review')">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </td>
                </tr>
                <tr class="report-row" id="row-swr-2026-010" data-id="swr-2026-010" data-title="institutional socio-economic profile assessment" data-scope="Socio-economic Summary" data-status="Approved">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SWR-2026-010</td>
                    <td class="fw-semibold text-dark truncate-cell">Institutional Socio-economic Profile Assessment</td>
                    <td><span class="badge-category">Socio-economic Summary</span></td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted truncate-cell">G. Panganiban (Guidance Counselor)</td>
                    <td class="text-center text-muted text-nowrap">Oct 05, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-approved">Approved</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-export-maroon btn-sm" onclick="exportSingleReport('SWR-2026-010', 'Institutional Socio-economic Profile Assessment', 'Socio-economic Summary', 'AY 2026–2027 (1st Sem)', 'G. Panganiban (Guidance Counselor)', 'Oct 05, 2026', 'Approved')">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </td>
                </tr>
                <tr class="report-row" id="row-swr-2026-009" data-id="swr-2026-009" data-title="monthly guidance counseling & mental health log" data-scope="Guidance Counseling Log" data-status="Draft">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">SWR-2026-009</td>
                    <td class="fw-semibold text-dark truncate-cell">Monthly Guidance Counseling & Mental Health Log</td>
                    <td><span class="badge-category">Guidance Counseling Log</span></td>
                    <td class="text-muted text-nowrap">AY 2026–2027 (1st Sem)</td>
                    <td class="text-muted truncate-cell">J. Marasigan (Student Welfare Officer)</td>
                    <td class="text-center text-muted text-nowrap">Sep 28, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-draft">Draft</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-export-maroon btn-sm" onclick="exportSingleReport('SWR-2026-009', 'Monthly Guidance Counseling & Mental Health Log', 'Guidance Counseling Log', 'AY 2026–2027 (1st Sem)', 'J. Marasigan (Student Welfare Officer)', 'Sep 28, 2026', 'Draft')">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noReportRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No report records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 welfare report entries</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Reporting Governance Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-shield-lock-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Governance & Confidentiality Protocol</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    All generated welfare reports synthesize aggregate student demographic, financial, and case data[cite: 1]. Personally identifiable information (PII) is anonymized in executive exports in full compliance with the Data Privacy Act and MarSU governance policies[cite: 1]. Raw dataset access is restricted to authorized OSAS personnel[cite: 1].
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL: GENERATE NEW REPORT ENTRY                                      -->
<!-- ===================================================================== -->
<div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="generateReportModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Generate Student Welfare Report
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="generateReportForm" onsubmit="saveNewReport(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Report ID</label>
                            <input type="text" class="form-control form-control-sm" id="newReportId" placeholder="e.g. SWR-2026-013" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Report Scope</label>
                            <select class="form-select form-select-sm" id="newScope" required>
                                <option value="Socio-economic Summary">Socio-economic Summary</option>
                                <option value="Financial Aid Disbursement">Financial Aid Disbursement</option>
                                <option value="Case Resolution Metrics">Case Resolution Metrics</option>
                                <option value="Guidance Counseling Log">Guidance Counseling Log</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Report Title</label>
                        <input type="text" class="form-control form-control-sm" id="newTitle" placeholder="e.g. End-of-Semester Student Welfare Audit" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Academic Term</label>
                            <input type="text" class="form-control form-control-sm" id="newTerm" placeholder="e.g. AY 2026–2027 (1st Sem)" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Prepared By (Assigned Personnel)</label>
                            <input type="text" class="form-control form-control-sm" id="newPreparedBy" placeholder="e.g. Ms. E. Rodelas (Scholarship Lead)" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Date Created</label>
                            <input type="date" class="form-control form-control-sm" id="newCreatedDate" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Initial Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Draft">Draft</option>
                                <option value="Submitted">Submitted</option>
                                <option value="Pending Review">Pending Review</option>
                                <option value="Approved">Approved</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Executive Summary Notes</label>
                        <textarea class="form-control form-control-sm" id="newSummaryNotes" rows="3" placeholder="Overview of methodology, findings, and metrics synthesized..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Generate Report</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC & EXPORT FUNCTIONALITY                               -->
<!-- ===================================================================== -->
<script>
    function applyReportFilters() {
        const searchInput = document.getElementById('reportSearch').value.toLowerCase().trim();
        const scopeFilter = document.getElementById('reportScopeFilter').value;
        const statusFilter = document.getElementById('reportStatusFilter').value;

        const rows = document.querySelectorAll('.report-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const title = row.getAttribute('data-title');
            const scope = row.getAttribute('data-scope');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || title.includes(searchInput);
            const matchesScope = !scopeFilter || scope.toLowerCase() === scopeFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesScope && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noReportRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} welfare report entries`;
        }
    }

    // Export Single Report File (CSV Download)
    function exportSingleReport(id, title, scope, term, preparedBy, dateCreated, status) {
        const csvContent = "data:text/csv;charset=utf-8," 
            + "Report ID,Report Title,Report Scope,Academic Term,Prepared By,Date Created,Status\n"
            + `"${id}","${title}","${scope}","${term}","${preparedBy}","${dateCreated}","${status}"\n`;

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `${id}_Welfare_Report.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Export All Visible Reports (CSV Download)
    function exportAllReportsCSV() {
        const rows = document.querySelectorAll('.report-row');
        let csvContent = "data:text/csv;charset=utf-8,Report ID,Report Title,Report Scope,Academic Term,Prepared By,Date Created,Status\n";

        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const cells = row.querySelectorAll('td');
                const id = cells[0].innerText.trim();
                const title = cells[1].innerText.trim();
                const scope = cells[2].innerText.trim();
                const term = cells[3].innerText.trim();
                const preparedBy = cells[4].innerText.trim();
                const dateCreated = cells[5].innerText.trim();
                const status = cells[6].innerText.trim();

                csvContent += `"${id}","${title}","${scope}","${term}","${preparedBy}","${dateCreated}","${status}"\n`;
            }
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "MarSU_OSAS_Welfare_Reports_Summary.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function openGenerateReportModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('generateReportModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Generate Report Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.report-row');
        let totalReports = rows.length;
        let approvedCount = 0;
        let pendingCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();

            if (status === 'approved') {
                approvedCount++;
            } else if (status === 'pending review') {
                pendingCount++;
            }
        });

        document.getElementById('metricTotalReports').innerText = totalReports;
        document.getElementById('metricApproved').innerText = approvedCount;
        document.getElementById('metricPending').innerText = pendingCount;
    }

    function saveNewReport(e) {
        e.preventDefault();

        const reportId = document.getElementById('newReportId').value.trim();
        const scope = document.getElementById('newScope').value;
        const title = document.getElementById('newTitle').value.trim();
        const term = document.getElementById('newTerm').value.trim();
        const preparedBy = document.getElementById('newPreparedBy').value.trim();
        const rawDate = document.getElementById('newCreatedDate').value;
        const status = document.getElementById('newStatus').value;

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-draft';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'approved') badgeClass = 'status-badge-approved';
        else if (lowerStatus === 'pending review') badgeClass = 'status-badge-review';
        else if (lowerStatus === 'submitted') badgeClass = 'status-badge-submitted';

        const rowId = 'row-' + reportId.toLowerCase();
        const tbody = document.getElementById('reportTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'report-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', reportId.toLowerCase());
        newTr.setAttribute('data-title', title.toLowerCase());
        newTr.setAttribute('data-scope', scope);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${reportId}</td>
            <td class="fw-semibold text-dark truncate-cell">${title}</td>
            <td><span class="badge-category">${scope}</span></td>
            <td class="text-muted text-nowrap">${term}</td>
            <td class="text-muted truncate-cell">${preparedBy}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-export-maroon btn-sm" onclick="exportSingleReport('${reportId}', '${title}', '${scope}', '${term}', '${preparedBy}', '${formattedDate}', '${status}')">
                    <i class="bi bi-download me-1"></i> Export
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('generateReportModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('generateReportForm').reset();

        recalculateMetrics();
        applyReportFilters();
    }
</script>