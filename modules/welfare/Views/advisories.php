<!-- Advisories & Announcements Management (MarSU OSAS Standard) -->
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

        /* Uncompressed Table Layout */
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

        /* Priority Badges */
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

        /* Status Badges */
        .status-badge-published {
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

        .status-badge-urgent {
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

        .status-badge-draft {
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

        .status-badge-archived {
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
            <span class="small fw-bold text-secondary">COMMUNICATIONS & INFORMATION</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">OFFICIAL ADVISORIES</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Official Student Advisories</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Publish, broadcast, and monitor institutional announcements, student welfare alerts, UniFAST financial aid notices, and emergency directives across MarSU campuses.
        </p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Broadcasts</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalBroadcasts">4</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Recorded Bulletins</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-megaphone-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Active Broadcasts</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricActiveBroadcasts">2</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Currently Published</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-broadcast-pin fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-danger d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Urgent Alerts</div>
                    <div class="fs-2 fw-bold text-danger lh-1" id="metricUrgentAlerts">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">High Priority Notice</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-danger ms-2">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-secondary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending / Drafts</div>
                    <div class="fs-2 fw-bold text-secondary lh-1" id="metricDrafts">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Under Review</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-secondary ms-2">
                    <i class="bi bi-journal-text fs-4"></i>
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
                <input type="search" id="advisorySearch" class="search-pill-input" placeholder="Search headline, ID, or officer..." oninput="applyAdvisoryFilters()" autocomplete="off">
            </div>

            <!-- 2. Category Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                <select class="form-select form-select-sm filter-select" id="advisoryCategoryFilter" onchange="applyAdvisoryFilters()">
                    <option value="">All Categories</option>
                    <option value="Academic Notice">Academic Notice</option>
                    <option value="Emergency Alert">Emergency Alert</option>
                    <option value="Student Welfare">Student Welfare</option>
                    <option value="Financial Aid">Financial Aid</option>
                    <option value="General Directive">General Directive</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="advisoryStatusFilter" onchange="applyAdvisoryFilters()">
                    <option value="">All Statuses</option>
                    <option value="Published">Published</option>
                    <option value="Urgent Alert">Urgent Alert</option>
                    <option value="Draft">Draft</option>
                    <option value="Archived">Archived</option>
                </select>
            </div>

            <!-- 4. Post New Advisory Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openCreateAdvisoryModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Post New Advisory
            </button>

        </div>
    </div>

    <!-- Advisories Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="advisoryTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 11%;">Advisory ID</th>
                    <th class="py-3" style="width: 20%;">Headline / Subject</th>
                    <th class="py-3" style="width: 14%;">Category</th>
                    <th class="py-3" style="width: 14%;">Issuing Officer / Unit</th>
                    <th class="py-3" style="width: 13%;">Target Audience</th>
                    <th class="py-3 text-center" style="width: 10%;">Date Posted</th>
                    <th class="py-3 text-center" style="width: 9%;">Priority</th>
                    <th class="py-3 text-center" style="width: 10%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="advisoryTableBody">
                <tr class="advisory-row" id="row-adv-2026-042" data-id="adv-2026-042" data-headline="weather disturbance class suspension directive" data-category="Emergency Alert" data-status="Urgent Alert">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">ADV-2026-042</td>
                    <td class="fw-semibold text-dark truncate-cell">Weather Disturbance Class Suspension Directive</td>
                    <td><span class="badge-category">Emergency Alert</span></td>
                    <td class="text-muted truncate-cell">OSAS Director / DRRM Unit</td>
                    <td class="text-muted truncate-cell">All Students & Faculty</td>
                    <td class="text-center text-muted text-nowrap">Oct 15, 2026</td>
                    <td class="text-center"><span class="badge-priority-urgent">Urgent</span></td>
                    <td class="text-center status-cell">
                        <span class="status-badge-urgent">Urgent Alert</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAdvisoryModal('ADV-2026-042', 'Weather Disturbance Class Suspension Directive', 'Emergency Alert', 'OSAS Director / DRRM Unit', 'All Students & Faculty', 'Oct 15, 2026', 'Urgent Alert', 'Urgent', 'In view of Typhoon Signal No. 2 over Marinduque, all face-to-face classes and campus activities are suspended immediately.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="advisory-row" id="row-adv-2026-041" data-id="adv-2026-041" data-headline="release of 1st semester tdp-tes grant allowances" data-category="Financial Aid" data-status="Published">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">ADV-2026-041</td>
                    <td class="fw-semibold text-dark truncate-cell">Release of 1st Semester TDP-TES Grant Allowances</td>
                    <td><span class="badge-category">Financial Aid</span></td>
                    <td class="text-muted truncate-cell">Ms. E. Rodelas (Scholarship Lead)</td>
                    <td class="text-muted truncate-cell">UniFAST Beneficiaries</td>
                    <td class="text-center text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center"><span class="badge-priority-normal">Normal</span></td>
                    <td class="text-center status-cell">
                        <span class="status-badge-published">Published</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAdvisoryModal('ADV-2026-041', 'Release of 1st Semester TDP-TES Grant Allowances', 'Financial Aid', 'Ms. E. Rodelas (Scholarship Lead)', 'UniFAST Beneficiaries', 'Oct 12, 2026', 'Published', 'Normal', 'Payout for TDP-TES grantees will commence on Oct 18, 2026 at the MarSU Cashier Office. Present validated Student ID.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="advisory-row" id="row-adv-2026-040" data-id="adv-2026-040" data-headline="schedule for mandatory health & guidance assessments" data-category="Student Welfare" data-status="Published">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">ADV-2026-040</td>
                    <td class="fw-semibold text-dark truncate-cell">Schedule for Mandatory Health & Guidance Assessments</td>
                    <td><span class="badge-category">Student Welfare</span></td>
                    <td class="text-muted truncate-cell">G. Panganiban / Clinic Nurse D. Ilagan</td>
                    <td class="text-muted truncate-cell">1st Year & Transferees</td>
                    <td class="text-center text-muted text-nowrap">Oct 08, 2026</td>
                    <td class="text-center"><span class="badge-priority-normal">Normal</span></td>
                    <td class="text-center status-cell">
                        <span class="status-badge-published">Published</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAdvisoryModal('ADV-2026-040', 'Schedule for Mandatory Health & Guidance Assessments', 'Student Welfare', 'G. Panganiban / Clinic Nurse D. Ilagan', '1st Year & Transferees', 'Oct 08, 2026', 'Published', 'Normal', 'All newly enrolled students are instructed to report to the Guidance Office for mental health profiling and clinic physical check-ups.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="advisory-row" id="row-adv-2026-039" data-id="adv-2026-039" data-headline="call for applications: student assistantship program" data-category="Academic Notice" data-status="Draft">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">ADV-2026-039</td>
                    <td class="fw-semibold text-dark truncate-cell">Call for Applications: Student Assistantship Program</td>
                    <td><span class="badge-category">Academic Notice</span></td>
                    <td class="text-muted truncate-cell">J. Marasigan (Student Org Lead)</td>
                    <td class="text-muted truncate-cell">Undergraduate Students</td>
                    <td class="text-center text-muted text-nowrap">—</td>
                    <td class="text-center"><span class="badge-priority-normal">Normal</span></td>
                    <td class="text-center status-cell">
                        <span class="status-badge-draft">Draft</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAdvisoryModal('ADV-2026-039', 'Call for Applications: Student Assistantship Program', 'Academic Notice', 'J. Marasigan (Student Org Lead)', 'Undergraduate Students', '—', 'Draft', 'Normal', 'Draft guidelines for the 2nd Semester Student Assistantship deployment across campus administrative offices.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noAdvisoryRecordsRow" style="display: none;">
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No advisories found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 advisory records</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Advisory Protocol Guidelines Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-bell-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Broadcast & Communication Protocol</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    All official student advisories require formal review by assigned unit leads (Guidance, Welfare, Financial Aid) and executive clearance from the OSAS Director prior to campus-wide broadcast[cite: 1]. Urgent alerts are dispatched simultaneously through portal banners, institutional email, and official MarSU social media channels[cite: 1].
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (ADVISORY FOCUS)                 -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialAdvisoryModal" tabindex="-1" aria-labelledby="essentialAdvisoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">OFFICIAL ADVISORY DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vAdvisoryId">ADV-2026-042</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeAdvisoryId" value="">

                <!-- 1. Headline Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Headline / Subject</span>
                        <span class="status-badge-urgent" id="vStatusBadge">Urgent Alert</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vHeadline">Weather Disturbance Class Suspension Directive</h5>
                </div>

                <!-- 2. Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Category</div>
                            <div class="essential-value marsu-maroon-text" id="vCategory">Emergency Alert</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Date Posted</div>
                            <div class="essential-value text-dark" id="vDatePosted">Oct 15, 2026</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Issuing Officer / Unit</div>
                            <div class="essential-value text-dark" id="vIssuingOfficer">OSAS Director / DRRM Unit</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Target Audience</div>
                            <div class="essential-value text-dark" id="vTargetAudience">All Students & Faculty</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Broadcast Lifecycle Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="advst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Draft</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="advst2"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Approved</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="advst3">3</div>
                            <span class="compact-step-label text-dark fw-bold">Broadcasted</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Directive Text -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Official Directive / Content</div>
                    <div class="small text-dark fw-semibold" id="vDirectiveText">In view of Typhoon Signal No. 2 over Marinduque, all face-to-face classes and campus activities are suspended immediately.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Broadcast Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                            <option value="Urgent Alert">Urgent Alert</option>
                            <option value="Archived">Archived</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialAdvisoryStatus()">Save Status</button>
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
<!-- MODAL 2: POST NEW ADVISORY ENTRY                                      -->
<!-- ===================================================================== -->
<div class="modal fade" id="createAdvisoryModal" tabindex="-1" aria-labelledby="createAdvisoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="createAdvisoryModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Post New Advisory
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createAdvisoryForm" onsubmit="saveNewAdvisory(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Advisory ID</label>
                            <input type="text" class="form-control form-control-sm" id="newAdvisoryId" placeholder="e.g. ADV-2026-043" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Category</label>
                            <select class="form-select form-select-sm" id="newCategory" required>
                                <option value="Academic Notice">Academic Notice</option>
                                <option value="Emergency Alert">Emergency Alert</option>
                                <option value="Student Welfare">Student Welfare</option>
                                <option value="Financial Aid">Financial Aid</option>
                                <option value="General Directive">General Directive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Headline / Subject</label>
                        <input type="text" class="form-control form-control-sm" id="newHeadline" placeholder="e.g. Schedule for 2nd Semester Registration" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Issuing Officer / Unit</label>
                            <input type="text" class="form-control form-control-sm" id="newIssuingOfficer" placeholder="e.g. Ms. E. Rodelas (Scholarship Lead)" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Target Audience</label>
                            <input type="text" class="form-control form-control-sm" id="newTargetAudience" placeholder="e.g. All Students" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Date Posted</label>
                            <input type="date" class="form-control form-control-sm" id="newPostDate">
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Priority</label>
                            <select class="form-select form-select-sm" id="newPriority" required>
                                <option value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Initial Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Draft">Draft</option>
                                <option value="Published">Published</option>
                                <option value="Urgent Alert">Urgent Alert</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Directive Content</label>
                        <textarea class="form-control form-control-sm" id="newDirectiveText" rows="3" placeholder="Full announcement or directive details..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Post Advisory</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyAdvisoryFilters() {
        const searchInput = document.getElementById('advisorySearch').value.toLowerCase().trim();
        const categoryFilter = document.getElementById('advisoryCategoryFilter').value;
        const statusFilter = document.getElementById('advisoryStatusFilter').value;

        const rows = document.querySelectorAll('.advisory-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const headline = row.getAttribute('data-headline');
            const category = row.getAttribute('data-category');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || headline.includes(searchInput);
            const matchesCategory = !categoryFilter || category.toLowerCase() === categoryFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noAdvisoryRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} advisory records`;
        }
    }

    function openEssentialAdvisoryModal(advId, headline, category, issuingOfficer, targetAudience, datePosted, status, priority, directiveText) {
        document.getElementById('activeAdvisoryId').value = advId.toLowerCase();
        document.getElementById('vAdvisoryId').innerText = advId;
        document.getElementById('vHeadline').innerText = headline;
        document.getElementById('vCategory').innerText = category;
        document.getElementById('vIssuingOfficer').innerText = issuingOfficer;
        document.getElementById('vTargetAudience').innerText = targetAudience;
        document.getElementById('vDatePosted').innerText = datePosted || '—';
        document.getElementById('vDirectiveText').innerText = directiveText || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'urgent alert') badgeElem.className = 'status-badge-urgent';
        else if (lower === 'published') badgeElem.className = 'status-badge-published';
        else if (lower === 'draft') badgeElem.className = 'status-badge-draft';
        else badgeElem.className = 'status-badge-archived';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('advst1');
        const st2 = document.getElementById('advst2');
        const st3 = document.getElementById('advst3');

        st1.className = 'compact-step-circle completed';

        if (lower === 'published' || lower === 'urgent alert') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle active';
            st3.innerText = '3';
        } else {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialAdvisoryModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Advisory Details: ' + advId);
        }
    }

    function saveEssentialAdvisoryStatus() {
        const activeAdvisoryId = document.getElementById('activeAdvisoryId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeAdvisoryId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-draft';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'urgent alert') newBadgeClass = 'status-badge-urgent';
            else if (lowerStatus === 'published') newBadgeClass = 'status-badge-published';
            else if (lowerStatus === 'archived') newBadgeClass = 'status-badge-archived';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const headlineText = targetRow.cells[1].innerText;
                const categoryText = targetRow.cells[2].innerText.trim();
                const officerText = targetRow.cells[3].innerText;
                const audienceText = targetRow.cells[4].innerText;
                const dateText = targetRow.cells[5].innerText;
                const priorityText = targetRow.cells[6].innerText.trim();
                const directiveText = document.getElementById('vDirectiveText').innerText;

                viewBtn.setAttribute('onclick', `openEssentialAdvisoryModal('${idText}', '${headlineText}', '${categoryText}', '${officerText}', '${audienceText}', '${dateText}', '${newStatus}', '${priorityText}', '${directiveText}')`);
            }
        }

        const modalElem = document.getElementById('essentialAdvisoryModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyAdvisoryFilters();
        alert('Advisory status successfully updated!');
    }

    function openCreateAdvisoryModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('createAdvisoryModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Post New Advisory Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.advisory-row');
        let totalBroadcasts = rows.length;
        let activeCount = 0;
        let urgentCount = 0;
        let draftCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();

            if (status === 'published') {
                activeCount++;
            } else if (status === 'urgent alert') {
                urgentCount++;
            } else if (status === 'draft') {
                draftCount++;
            }
        });

        document.getElementById('metricTotalBroadcasts').innerText = totalBroadcasts;
        document.getElementById('metricActiveBroadcasts').innerText = activeCount;
        document.getElementById('metricUrgentAlerts').innerText = urgentCount;
        document.getElementById('metricDrafts').innerText = draftCount;
    }

    function saveNewAdvisory(e) {
        e.preventDefault();

        const advId = document.getElementById('newAdvisoryId').value.trim();
        const category = document.getElementById('newCategory').value;
        const headline = document.getElementById('newHeadline').value.trim();
        const issuingOfficer = document.getElementById('newIssuingOfficer').value.trim();
        const targetAudience = document.getElementById('newTargetAudience').value.trim();
        const rawDate = document.getElementById('newPostDate').value;
        const priority = document.getElementById('newPriority').value;
        const status = document.getElementById('newStatus').value;
        const directiveText = document.getElementById('newDirectiveText').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-draft';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'urgent alert') badgeClass = 'status-badge-urgent';
        else if (lowerStatus === 'published') badgeClass = 'status-badge-published';

        const priorityBadgeClass = (priority.toLowerCase() === 'urgent') ? 'badge-priority-urgent' : 'badge-priority-normal';

        const rowId = 'row-' + advId.toLowerCase();
        const tbody = document.getElementById('advisoryTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'advisory-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', advId.toLowerCase());
        newTr.setAttribute('data-headline', headline.toLowerCase());
        newTr.setAttribute('data-category', category);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${advId}</td>
            <td class="fw-semibold text-dark truncate-cell">${headline}</td>
            <td><span class="badge-category">${category}</span></td>
            <td class="text-muted truncate-cell">${issuingOfficer}</td>
            <td class="text-muted truncate-cell">${targetAudience}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center"><span class="${priorityBadgeClass}">${priority}</span></td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAdvisoryModal('${advId}', '${headline}', '${category}', '${issuingOfficer}', '${targetAudience}', '${formattedDate}', '${status}', '${priority}', '${directiveText}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('createAdvisoryModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('createAdvisoryForm').reset();

        recalculateMetrics();
        applyAdvisoryFilters();
    }
</script>