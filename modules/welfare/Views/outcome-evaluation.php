<!-- Outcome Evaluation Management (Enhanced Spacing & Layout) -->
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
            margin-bottom: 1.75rem; /* Spacious bottom gap before banners */
        }

        /* Uncompressed Table with Generous Cell Padding */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px; /* Guarantees horizontal breathing room */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important;
            word-break: break-word;
            padding: 14px 18px !important; /* Expanded padding for comfortable cell reading */
            line-height: 1.5;
        }

        /* Spacious Toolbar Controls */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1.25rem !important; /* Increased inner container padding */
            margin-bottom: 1.75rem !important;
        }

        /* Pill Search Input with Generous Internal Cushioning */
        .search-pill-wrapper {
            background-color: #ffffff;
            border: 1.5px solid #e2d8d8;
            border-radius: 50rem !important;
            padding: 8px 20px; /* Enhanced vertical & horizontal cushion */
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

        /* Filter Select Dropdowns with Ample Height & Spacing */
        .filter-select {
            width: auto !important;
            min-width: 170px;
            padding: 6px 12px !important;
            font-size: 0.875rem !important;
            border-radius: 8px !important;
        }

        /* Status Badges with Roomy Padding */
        .status-badge-effective {
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

        .status-badge-partial {
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

        .status-badge-pending {
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

        /* Primary Action Button with Spacious Dimensions */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 8px 20px; /* Spacious button target */
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fafbfc;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }
    </style>

    <!-- Breadcrumb Navigation Header with Generous Margins -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-3 py-1.5">
                <i class="bi bi-house me-1.5 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">INTERVENTION MONITORING</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">OUTCOME EVALUATION</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Outcome Evaluation</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Assess whether interventions addressed the original student concern, review empirical feedback, and identify any continuing support needs for ongoing student welfare cases.
        </p>
    </div>

    <!-- Filter and Search Toolbar with Expanded Gaps -->
    <div class="card toolbar-card shadow-sm">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="outcomeSearch" class="search-pill-input" placeholder="Search case, student, or outcome..." oninput="filterTable('outcomeSearch','outcomeTable')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Primary Action Button -->
            <div class="d-flex flex-wrap gap-3 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Result:</label>
                    <select class="form-select form-select-sm filter-select" id="outcomeStatus" onchange="filterStatus('outcomeStatus','outcomeTable',5)">
                        <option value="">All Results</option>
                        <option value="Effective">Effective</option>
                        <option value="Partially Effective">Partially Effective</option>
                        <option value="Needs Further Support">Needs Further Support</option>
                        <option value="Pending Evaluation">Pending Evaluation</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="addInterventionOutcome()">
                    <i class="bi bi-plus-circle icon-shrink-0"></i> Add Evaluation
                </button>
            </div>
        </div>
    </div>

    <!-- Outcome Evaluation Table with Increased Internal & External Breathing Room -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="outcomeTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 14%;">Evaluation ID</th>
                    <th class="py-3.5" style="width: 14%;">Case No.</th>
                    <th class="py-3.5" style="width: 18%;">Student</th>
                    <th class="py-3.5" style="width: 18%;">Intervention</th>
                    <th class="py-3.5" style="width: 20%;">Evaluation Date</th>
                    <th class="py-3.5 pe-4" style="width: 18%;">Recommendations</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">OE-2026-010</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0245</td>
                    <td class="fw-semibold text-dark">Santos, Paolo R.</td>
                    <td class="text-muted">Family Consultation</td>
                    <td class="text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-muted pe-4">Monitoring</td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">OE-2026-009</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0247</td>
                    <td class="fw-semibold text-dark">Reyes, Maricel S.</td>
                    <td class="text-muted">Financial Assistance Facilitation</td>
                    <td class="text-muted text-nowrap">Oct 08, 2026</td>
                    <td class="text-muted pe-4">Verifying</td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">OE-2026-008</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark">Dela Cruz, Angelo M.</td>
                    <td class="text-muted">Academic Coaching</td>
                    <td class="text-muted text-nowrap">—</td>
                    <td class="text-muted pe-4">Pending</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Evaluation Checklist Notice Banner with Roomy Internal Grid & Icon Gap -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-clipboard-data-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Evaluation Checklist & Guidelines</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Compare the outcome with the initial support goal, consider student feedback and available evidence, record remaining needs, and document whether to continue, adjust, refer, or close the intervention. Use factual, objective, and respectful notes across all evaluation records.
                </p>
            </div>
        </div>
    </div>

</div>