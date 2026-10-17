<!-- Case Resolution Tracking Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Smooth Scrolling */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Flexible Table Columns - No Hard Compression */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1180px; /* Guarantees comfortable breathing room for all 8 columns */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important; /* Allows long notes/actions to wrap naturally without text cutting */
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
        .accent-info::before { background-color: #0dcaf0; }
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
        .bg-soft-info { background-color: rgba(13, 202, 240, 0.12); color: #055160; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

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
            min-width: 160px;
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

        /* Status Badges - Uncompressed & Wrap-Protected */
        .status-badge-pending {
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

        .status-badge-resolved {
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

        .status-badge-closed {
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
            <span class="small fw-bold text-secondary">STUDENT CONCERN & CASE MANAGEMENT</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">CASE RESOLUTION TRACKING</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Case Resolution Tracking</h4>
        <p class="text-muted small mb-0">Monitor resolution decisions, actions completed, verification, and closure status for student welfare cases.</p>
    </div>

    <!-- Modern Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Cases Tracked -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Cases Tracked</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">4</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-folder-check fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1">1</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-info d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">In Progress</div>
                    <div class="fs-2 fw-bold text-info lh-1">1</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-info ms-2">
                    <i class="bi bi-gear-wide-connected fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Resolved / Closed -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Resolved / Closed</div>
                    <div class="fs-2 fw-bold text-success lh-1">2</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check2-all fs-4"></i>
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
                <input type="search" id="resolutionSearch" class="search-pill-input" placeholder="Search case number, student, or outcome..." oninput="filterTable('resolutionSearch','resolutionTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Resolution status:</label>
                    <select class="form-select form-select-sm filter-select" id="resolutionStatus" onchange="filterStatus('resolutionStatus','resolutionTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Pending Review">Pending Review</option>
                        <option value="Action in Progress">Action in Progress</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="addResolutionRecord()">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Record Resolution
                </button>
            </div>
        </div>
    </div>

    <!-- Case Resolution Table (Uncompressed & Spaced Out) -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="resolutionTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 11%;">Case No.</th>
                    <th class="py-3" style="width: 15%;">Student</th>
                    <th class="py-3" style="width: 14%;">Concern Category</th>
                    <th class="py-3" style="width: 18%;">Resolution Action</th>
                    <th class="py-3" style="width: 10%;">Resolution Date</th>
                    <th class="py-3" style="width: 12%;">Verified By</th>
                    <th class="py-3 text-center" style="width: 10%;">Status</th>
                    <th class="py-3 pe-3" style="width: 10%;">Outcome / Notes</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark">Adamos, Mariedhen L.</td>
                    <td>
                        <span class="badge-category">Financial assistance</span>
                    </td>
                    <td class="text-muted">Referred to financial aid office</td>
                    <td class="text-muted text-nowrap">—</td>
                    <td class="text-muted">Pending</td>
                    <td class="text-center">
                        <span class="status-badge-pending">Pending Review</span>
                    </td>
                    <td class="text-muted">Awaiting eligibility review</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">CM-2026-0241</td>
                    <td class="fw-semibold text-dark">Ali, Kyla Diane M.</td>
                    <td>
                        <span class="badge-category">Academic adjustment</span>
                    </td>
                    <td class="text-muted">Guidance consultation and action plan</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-center">
                        <span class="status-badge-progress">Action in Progress</span>
                    </td>
                    <td class="text-muted">Check progress at next follow-up</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">CM-2026-0239</td>
                    <td class="fw-semibold text-dark">Almonte, Hanz Andrei R.</td>
                    <td>
                        <span class="badge-category">Transportation support</span>
                    </td>
                    <td class="text-muted">Connected with student support program</td>
                    <td class="text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-muted">Student Affairs Staff</td>
                    <td class="text-center">
                        <span class="status-badge-resolved">Resolved</span>
                    </td>
                    <td class="text-muted">Support received; student confirmed</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">CM-2026-0227</td>
                    <td class="fw-semibold text-dark">Andaya, Patricia M.</td>
                    <td>
                        <span class="badge-category">Personal welfare concern</span>
                    </td>
                    <td class="text-muted">Referral and agreed support plan completed</td>
                    <td class="text-muted text-nowrap">Oct 07, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-center">
                        <span class="status-badge-closed">Closed</span>
                    </td>
                    <td class="text-muted">Outcome documented and closure reviewed</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Resolution Checklist Notice Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-file-earmark-check-fill marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Resolution Checklist</h6>
                <p class="text-muted small mb-0">
                    Document the action taken, outcome against the original concern, student confirmation where appropriate, any remaining risks or support needs, verification by authorized personnel, closure date, and whether a later check-in is required. Keep confidential case details limited to authorized staff.
                </p>
            </div>
        </div>
    </div>

</div>