<!-- Follow-up Monitoring Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Flexible Table Columns - No Hard Truncation or Compression */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px; /* Guarantees enough horizontal room for columns to breathe */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important; /* Allows text to wrap naturally without line cutting */
            word-break: break-word;
            padding: 12px 14px !important;
            line-height: 1.45;
        }

        /* Metric Cards Styling */
        .metric-card {
            background: #ffffff;
            border: 1px solid #ebdede;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            height: 100%;
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
            min-width: 140px;
        }

        /* Status Badges - Flexible Widths with No Text Clipping */
        .status-badge-scheduled {
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

        .status-badge-due {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #ffe6d5 !important;
            color: #8a3b00 !important;
            border: 1px solid #ffd1b3 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-completed {
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

        .status-badge-overdue {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
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

        /* Prevents Icon Shrinking */
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
            <span class="small fw-bold marsu-maroon-text">FOLLOW-UP MONITORING</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Follow-up Monitoring</h4>
        <p class="text-muted small mb-0">Track scheduled check-ins, assigned personnel, next follow-up dates, and updates for open student concerns.</p>
    </div>

<!-- Enhanced Summary Metrics Dashboard Cards -->
<style>
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

    /* Status Accent Bars */
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
    .accent-danger::before { background-color: #dc3545; }
    .accent-success::before { background-color: #198754; }

    /* Custom Soft Icon Backgrounds */
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
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

    .metric-label {
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
</style>

<div class="row g-3 mb-4">
    <!-- Total Follow-ups -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
            <div>
                <div class="metric-label mb-1">Total Follow-ups</div>
                <div class="fs-2 fw-bold marsu-maroon-text lh-1">4</div>
            </div>
            <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                <i class="bi bi-list-check fs-4"></i>
            </div>
        </div>
    </div>

    <!-- Scheduled -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
            <div>
                <div class="metric-label mb-1">Scheduled</div>
                <div class="fs-2 fw-bold text-dark lh-1">1</div>
            </div>
            <div class="icon-wrapper-soft bg-soft-warning ms-2">
                <i class="bi bi-calendar-event fs-4"></i>
            </div>
        </div>
    </div>

    <!-- Due / Overdue -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="metric-card-enhanced accent-danger d-flex align-items-center justify-content-between">
            <div>
                <div class="metric-label mb-1">Due / Overdue</div>
                <div class="fs-2 fw-bold text-danger lh-1">2</div>
            </div>
            <div class="icon-wrapper-soft bg-soft-danger ms-2">
                <i class="bi bi-exclamation-triangle fs-4"></i>
            </div>
        </div>
    </div>

    <!-- Completed -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
            <div>
                <div class="metric-label mb-1">Completed</div>
                <div class="fs-2 fw-bold text-success lh-1">1</div>
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
                <input type="search" id="followupSearch" class="search-pill-input" placeholder="Search case, student, or assigned staff..." oninput="filterTable('followupSearch','followupTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="followupStatus" onchange="filterStatus('followupStatus','followupTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Due">Due</option>
                        <option value="Completed">Completed</option>
                        <option value="Overdue">Overdue</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="addFollowUpRecord()">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add Follow-up
                </button>
            </div>
        </div>
    </div>

    <!-- Follow-up Monitoring Table (Responsive & Uncompressed) -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="followupTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Follow-up ID</th>
                    <th class="py-3" style="width: 12%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 12%;">Follow-up Date</th>
                    <th class="py-3" style="width: 16%;">Assigned Personnel</th>
                    <th class="py-3" style="width: 22%;">Follow-up Notes</th>
                    <th class="py-3 text-center pe-3" style="width: 8%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FU-2026-018</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark">Adamos, Mariedhen L.</td>
                    <td class="text-muted text-nowrap">Oct 16, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-muted">Check status of financial assistance referral</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-scheduled">Scheduled</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FU-2026-017</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0241</td>
                    <td class="fw-semibold text-dark">Ali, Kyla Diane M.</td>
                    <td class="text-muted text-nowrap">Oct 13, 2026</td>
                    <td class="text-muted">Student Affairs Staff</td>
                    <td class="text-muted">Review academic adjustment plan</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-due">Due</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FU-2026-016</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0239</td>
                    <td class="fw-semibold text-dark">Almonte, Hanz Andrei R.</td>
                    <td class="text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-muted">Assigned Case Officer</td>
                    <td class="text-muted">Confirm whether transport support was received</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">FU-2026-015</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0235</td>
                    <td class="fw-semibold text-dark">Andaya, Patricia M.</td>
                    <td class="text-muted text-nowrap">Oct 09, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-muted">Student has not yet attended scheduled check-in</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-overdue">Overdue</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Follow-up Workflow Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-arrow-repeat marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Follow-up Workflow Protocol</h6>
                <p class="text-muted small mb-0">
                    Record the date, case number, assigned personnel, contact method, brief factual update, next action, and next follow-up date. Mark a follow-up completed only after the check-in has occurred.
                </p>
            </div>
        </div>
    </div>

</div>