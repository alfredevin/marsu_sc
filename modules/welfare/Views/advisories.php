<!-- Advisories & Announcements Management -->
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
            min-width: 1180px; /* Guarantees horizontal breathing room for advisory details */
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
        .accent-danger::before { background-color: #dc3545; }
        .accent-secondary::before { background-color: #6c757d; }

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
        .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .bg-soft-secondary { background-color: rgba(108, 117, 125, 0.1); color: #6c757d; }

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

        /* Priority / Urgency Badges */
        .badge-priority-urgent {
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-block !important;
        }

        .badge-priority-normal {
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #d3d6d8 !important;
            display: inline-block !important;
        }

        /* Status Badges with Roomy Padding */
        .status-badge-published {
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

        .status-badge-urgent {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-draft {
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

        .status-badge-archived {
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

        /* Primary Action Button */
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
            <span class="small fw-bold text-secondary">COMMUNICATIONS & INFORMATION</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">OFFICIAL ADVISORIES</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Official Student Advisories</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Publish, broadcast, and monitor institutional announcements, student welfare alerts, policy updates, and emergency directives across campus channels.
        </p>
    </div>

    <!-- Modern Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Advisories -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Broadcasts</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">24</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-megaphone-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Active / Published -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Active Broadcasts</div>
                    <div class="fs-2 fw-bold text-success lh-1">8</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-broadcast-pin fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Urgent Safety Alerts -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-danger d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Urgent Alerts</div>
                    <div class="fs-2 fw-bold text-danger lh-1">2</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-danger ms-2">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Drafts & Scheduled -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-secondary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending / Drafts</div>
                    <div class="fs-2 fw-bold text-secondary lh-1">3</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-secondary ms-2">
                    <i class="bi bi-journal-text fs-4"></i>
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
                <input type="search" id="advisorySearch" class="search-pill-input" placeholder="Search headline, ref code, or category..." oninput="filterTable('advisorySearch','advisoryTable')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Primary Action Button -->
            <div class="d-flex flex-wrap gap-3 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                    <select class="form-select form-select-sm filter-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Academic Notice">Academic Notice</option>
                        <option value="Emergency Alert">Emergency Alert</option>
                        <option value="Student Welfare">Student Welfare</option>
                        <option value="Financial Aid">Financial Aid</option>
                        <option value="General Directive">General Directive</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="advisoryStatus" onchange="filterStatus('advisoryStatus','advisoryTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Published">Published</option>
                        <option value="Urgent Alert">Urgent Alert</option>
                        <option value="Draft">Draft</option>
                        <option value="Archived">Archived</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="openModal('modalCreateAdvisory')">
                    <i class="bi bi-plus-circle icon-shrink-0"></i> Post New Advisory
                </button>
            </div>
        </div>
    </div>

    <!-- Advisories Table with Increased Internal & External Spacing -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="advisoryTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 12%;">Advisory ID</th>
                    <th class="py-3.5" style="width: 22%;">Headline / Subject</th>
                    <th class="py-3.5" style="width: 15%;">Category</th>
                    <th class="py-3.5" style="width: 16%;">Target Audience</th>
                    <th class="py-3.5" style="width: 12%;">Date Posted</th>
                    <th class="py-3.5 text-center" style="width: 10%;">Priority</th>
                    <th class="py-3.5 text-center pe-4" style="width: 13%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">ADV-2026-042</td>
                    <td class="fw-semibold text-dark">Weather Disturbance Class Suspension Directive</td>
                    <td>
                        <span class="badge-category">Emergency Alert</span>
                    </td>
                    <td class="text-muted">All Students & Faculty</td>
                    <td class="text-muted text-nowrap">Oct 15, 2026</td>
                    <td class="text-center">
                        <span class="badge-priority-urgent">Urgent</span>
                    </td>
                    <td class="text-center pe-4">
                        <span class="status-badge-urgent">Urgent Alert</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">ADV-2026-041</td>
                    <td class="fw-semibold text-dark">Release of 1st Semester TDP-TES Grant Allowances</td>
                    <td>
                        <span class="badge-category">Financial Aid</span>
                    </td>
                    <td class="text-muted">UniFAST Beneficiaries</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center">
                        <span class="badge-priority-normal">Normal</span>
                    </td>
                    <td class="text-center pe-4">
                        <span class="status-badge-published">Published</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">ADV-2026-040</td>
                    <td class="fw-semibold text-dark">Schedule for Mandatory Health & Guidance Assessments</td>
                    <td>
                        <span class="badge-category">Student Welfare</span>
                    </td>
                    <td class="text-muted">1st Year & Transferees</td>
                    <td class="text-muted text-nowrap">Oct 08, 2026</td>
                    <td class="text-center">
                        <span class="badge-priority-normal">Normal</span>
                    </td>
                    <td class="text-center pe-4">
                        <span class="status-badge-published">Published</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">ADV-2026-039</td>
                    <td class="fw-semibold text-dark">Call for Applications: Student Assistantship Program</td>
                    <td>
                        <span class="badge-category">Academic Notice</span>
                    </td>
                    <td class="text-muted">Undergraduate Students</td>
                    <td class="text-muted text-nowrap">—</td>
                    <td class="text-center">
                        <span class="badge-priority-normal">Normal</span>
                    </td>
                    <td class="text-center pe-4">
                        <span class="status-badge-draft">Draft</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 24 advisory records</span>
        <span>Page 1 of 6</span>
    </div>

    <!-- Advisory Protocol & Broadcast Guidelines Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-bell-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Broadcast & Information Guidelines</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    All official advisories must receive formal clearance from OSAS or Executive Administration prior to public broadcast. Urgent emergency alerts are dispatched via SMS, email, and social media portals simultaneously. Ensure factual clarity, appropriate target scope, and clear contact links for student inquiries.
                </p>
            </div>
        </div>
    </div>

</div>