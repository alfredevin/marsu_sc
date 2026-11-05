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

        /* Uncompressed Responsive Table Container */
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .uncompressed-table {
            width: 100% !important;
            min-width: 1180px;
            border-collapse: collapse !important;
        }

        .uncompressed-table th, 
        .uncompressed-table td {
            vertical-align: middle !important;
            padding: 14px 16px !important;
            border-bottom: 1px solid #dee2e6 !important;
            white-space: nowrap;
        }

        .uncompressed-table td.truncate-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Single-Row Compact Search Pill Input */
        .search-pill-wrapper-short {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 5px 14px;
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
            min-width: 135px;
            max-width: 165px;
            font-size: 0.85rem !important;
            padding: 5px 8px !important;
            border-radius: 6px !important;
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

        /* Action Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 14px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .btn-manage-status {
            color: #58111a !important;
            border: 1.5px solid #58111a !important;
            background-color: #ffffff !important;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.825rem;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-manage-status:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        .btn-manage-status:hover .bi-arrow-right-short {
            transform: translateX(3px);
            transition: transform 0.2s ease-in-out;
        }

        .table-hover tbody tr:hover {
            background-color: #fcfcfd;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
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

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Cases Tracked</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotal">4</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-folder-check fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Review</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricPending">1</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-info d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">In Progress</div>
                    <div class="fs-2 fw-bold text-info lh-1" id="metricProgress">1</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-info ms-2">
                    <i class="bi bi-gear-wide-connected fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Resolved / Closed</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricResolvedClosed">2</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check2-all fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="resolutionSearch" class="search-pill-input" placeholder="Search case number, student..." oninput="applyResolutionFilters()" autocomplete="off">
            </div>

            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="resolutionStatus" onchange="applyResolutionFilters()">
                    <option value="">All Statuses</option>
                    <option value="Pending Review">Pending Review</option>
                    <option value="Action in Progress">Action in Progress</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>

            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="openAddResolutionModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Record Resolution
            </button>

        </div>
    </div>

    <!-- Case Resolution Table -->
    <div class="table-responsive-custom bg-white shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="resolutionTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 12%;">Case No.</th>
                    <th class="py-3" style="width: 16%;">Student</th>
                    <th class="py-3" style="width: 15%;">Concern Category</th>
                    <th class="py-3" style="width: 18%;">Resolution Action</th>
                    <th class="py-3" style="width: 11%;">Resolution Date</th>
                    <th class="py-3" style="width: 12%;">Verified By</th>
                    <th class="py-3 text-center" style="width: 10%;">Status</th>
                    <th class="py-3 text-center pe-4" style="width: 6%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="resolutionTableBody">
                <tr class="resolution-row" id="row-cm-2026-0248" data-case="cm-2026-0248" data-name="adamos, mariedhen l." data-status="Pending Review">
                    <td class="ps-4 fw-semibold text-secondary">CM-2026-0248</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td><span class="badge-category">Financial assistance</span></td>
                    <td class="text-muted truncate-cell">Referred to financial aid office</td>
                    <td class="text-muted">—</td>
                    <td class="text-muted">Pending</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-pending">Pending Review</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageResolutionModal('CM-2026-0248', 'Adamos, Mariedhen L.', 'Financial assistance', 'Referred to financial aid office', '—', 'Pending', 'Awaiting eligibility review', 'Pending Review')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="resolution-row" id="row-cm-2026-0241" data-case="cm-2026-0241" data-name="ali, kyla diane m." data-status="Action in Progress">
                    <td class="ps-4 fw-semibold text-secondary">CM-2026-0241</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td><span class="badge-category">Academic adjustment</span></td>
                    <td class="text-muted truncate-cell">Guidance consultation and action plan</td>
                    <td class="text-muted">Oct 12, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-progress">Action in Progress</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageResolutionModal('CM-2026-0241', 'Ali, Kyla Diane M.', 'Academic adjustment', 'Guidance consultation and action plan', 'Oct 12, 2026', 'Guidance Counselor', 'Check progress at next follow-up', 'Action in Progress')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="resolution-row" id="row-cm-2026-0239" data-case="cm-2026-0239" data-name="almonte, hanz andrei r." data-status="Resolved">
                    <td class="ps-4 fw-semibold text-secondary">CM-2026-0239</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td><span class="badge-category">Transportation support</span></td>
                    <td class="text-muted truncate-cell">Connected with student support program</td>
                    <td class="text-muted">Oct 10, 2026</td>
                    <td class="text-muted">Student Affairs Staff</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-resolved">Resolved</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageResolutionModal('CM-2026-0239', 'Almonte, Hanz Andrei R.', 'Transportation support', 'Connected with student support program', 'Oct 10, 2026', 'Student Affairs Staff', 'Support received; student confirmed', 'Resolved')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="resolution-row" id="row-cm-2026-0227" data-case="cm-2026-0227" data-name="andaya, patricia m." data-status="Closed">
                    <td class="ps-4 fw-semibold text-secondary">CM-2026-0227</td>
                    <td class="fw-semibold text-dark truncate-cell">Andaya, Patricia M.</td>
                    <td><span class="badge-category">Personal welfare concern</span></td>
                    <td class="text-muted truncate-cell">Referral and agreed support plan completed</td>
                    <td class="text-muted">Oct 07, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-closed">Closed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageResolutionModal('CM-2026-0227', 'Andaya, Patricia M.', 'Personal welfare concern', 'Referral and agreed support plan completed', 'Oct 07, 2026', 'Guidance Counselor', 'Outcome documented and closure reviewed', 'Closed')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noResolutionRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No resolution records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
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

<!-- MODAL 1: MANAGE RESOLUTION STATUS -->
<div class="modal fade" id="manageResolutionModal" tabindex="-1" aria-labelledby="manageResolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="manageResolutionModalLabel">
                    <i class="bi bi-sliders me-1"></i> Manage Resolution Status
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                
                <!-- Active Case No. -->
                <input type="hidden" id="activeCaseNo" value="">

                <!-- Student & Case Header Card -->
                <div class="card border rounded-3 p-3 mb-3 bg-light-subtle">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block" id="modalCaseNo">CM-2026-0248</span>
                            <h5 class="fw-bold text-dark mb-0" id="modalStudentName">Adamos, Mariedhen L.</h5>
                        </div>
                        <span class="status-badge-pending" id="modalStatusBadge">Pending Review</span>
                    </div>

                    <div class="row g-2 text-muted small mt-1">
                        <div class="col-12 col-md-6">
                            <i class="bi bi-tag me-1"></i> Category: <strong class="text-dark" id="modalCategory">Financial assistance</strong>
                        </div>
                        <div class="col-12 col-md-6">
                            <i class="bi bi-person-check me-1"></i> Verified By: <strong class="text-dark" id="modalVerifiedBy">Pending</strong>
                        </div>
                    </div>
                </div>

                <!-- Action Details -->
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Resolution Action Taken</label>
                    <div class="p-2.5 border rounded bg-white text-dark fw-semibold" id="modalActionText">
                        Referred to financial aid office
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="border-top pt-3">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square me-1"></i> Update Case Resolution</h6>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Resolution Status</label>
                            <select class="form-select form-select-sm" id="modalStatusSelect" onchange="updateModalBadgePreview(this.value)">
                                <option value="Pending Review">Pending Review</option>
                                <option value="Action in Progress">Action in Progress</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Outcome Notes & Remarks</label>
                            <textarea class="form-control form-control-sm" id="modalOutcomeText" rows="3" placeholder="Enter findings, verification notes, or closure summary..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-maroon-primary" onclick="saveResolutionStatus()">Save Status Changes</button>
            </div>

        </div>
    </div>
</div>

<!-- MODAL 2: RECORD RESOLUTION -->
<div class="modal fade" id="addResolutionModal" tabindex="-1" aria-labelledby="addResolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addResolutionModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Record Case Resolution
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addResolutionForm" onsubmit="saveNewResolution(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Case Number</label>
                            <input type="text" class="form-control form-control-sm" id="newCaseNo" placeholder="e.g. CM-2026-0250" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Resolution Date</label>
                            <input type="date" class="form-control form-control-sm" id="newDate" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Dela Cruz, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Concern Category</label>
                            <input type="text" class="form-control form-control-sm" id="newCategory" placeholder="e.g. Financial assistance" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Verified By</label>
                            <input type="text" class="form-control form-control-sm" id="newVerifiedBy" placeholder="e.g. Guidance Counselor" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Resolution Action Taken</label>
                        <input type="text" class="form-control form-control-sm" id="newAction" placeholder="Brief statement of action taken..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Resolution Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Pending Review">Pending Review</option>
                            <option value="Action in Progress">Action in Progress</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Resolution</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    function applyResolutionFilters() {
        const searchInput = document.getElementById('resolutionSearch').value.toLowerCase().trim();
        const statusFilter = document.getElementById('resolutionStatus').value;

        const rows = document.querySelectorAll('.resolution-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const caseNo = row.getAttribute('data-case');
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || caseNo.includes(searchInput) || name.includes(searchInput);
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noResolutionRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    function updateModalBadgePreview(status) {
        const badgeElem = document.getElementById('modalStatusBadge');
        if (!badgeElem) return;

        badgeElem.innerText = status;
        badgeElem.className = '';

        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'pending review') badgeElem.className = 'status-badge-pending';
        else if (lowerStatus === 'action in progress') badgeElem.className = 'status-badge-progress';
        else if (lowerStatus === 'resolved') badgeElem.className = 'status-badge-resolved';
        else if (lowerStatus === 'closed') badgeElem.className = 'status-badge-closed';
    }

    function openManageResolutionModal(caseNo, student, category, action, date, verifiedBy, outcome, status) {
        document.getElementById('activeCaseNo').value = caseNo.toLowerCase();
        document.getElementById('modalCaseNo').innerText = caseNo;
        document.getElementById('modalStudentName').innerText = student;
        document.getElementById('modalCategory').innerText = category;
        document.getElementById('modalActionText').innerText = action;
        document.getElementById('modalVerifiedBy').innerText = verifiedBy;
        document.getElementById('modalOutcomeText').value = outcome !== '—' ? outcome : '';

        const statusSelect = document.getElementById('modalStatusSelect');
        if (statusSelect) statusSelect.value = status;

        updateModalBadgePreview(status);

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('manageResolutionModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Manage Resolution: ' + caseNo);
        }
    }

    function saveResolutionStatus() {
        const activeCaseNo = document.getElementById('activeCaseNo').value;
        const newStatus = document.getElementById('modalStatusSelect').value;

        // Hanapin ang kaukulang row sa talahanayan
        const targetRow = document.getElementById('row-' + activeCaseNo);

        if (targetRow) {
            // Update attribute
            targetRow.setAttribute('data-status', newStatus);

            // Alamin ang bagong klase ng badge
            let newBadgeClass = 'status-badge-pending';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'action in progress') newBadgeClass = 'status-badge-progress';
            else if (lowerStatus === 'resolved') newBadgeClass = 'status-badge-resolved';
            else if (lowerStatus === 'closed') newBadgeClass = 'status-badge-closed';

            // I-update ang Status cell
            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            // I-update ang onclick para sa susunod na pagpindot
            const manageBtn = targetRow.querySelector('.btn-manage-status');
            if (manageBtn) {
                const caseNoText = targetRow.cells[0].innerText;
                const nameText = targetRow.cells[1].innerText;
                const categoryText = targetRow.cells[2].innerText;
                const actionText = targetRow.cells[3].innerText;
                const dateText = targetRow.cells[4].innerText;
                const verifiedByText = targetRow.cells[5].innerText;
                const outcomeText = document.getElementById('modalOutcomeText').value || '—';

                manageBtn.setAttribute('onclick', `openManageResolutionModal('${caseNoText}', '${nameText}', '${categoryText}', '${actionText}', '${dateText}', '${verifiedByText}', '${outcomeText}', '${newStatus}')`);
            }
        }

        // Isara ang modal
        const modalElem = document.getElementById('manageResolutionModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        // I-recalculate ang metrics at i-filter
        recalculateMetrics();
        applyResolutionFilters();

        alert('Case resolution status successfully updated!');
    }

    function openAddResolutionModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addResolutionModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add Resolution Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.resolution-row');
        let total = rows.length;
        let pending = 0;
        let progress = 0;
        let resolvedClosed = 0;

        rows.forEach(row => {
            const st = row.getAttribute('data-status').toLowerCase();
            if (st === 'pending review') pending++;
            else if (st === 'action in progress') progress++;
            else if (st === 'resolved' || st === 'closed') resolvedClosed++;
        });

        document.getElementById('metricTotal').innerText = total;
        document.getElementById('metricPending').innerText = pending;
        document.getElementById('metricProgress').innerText = progress;
        document.getElementById('metricResolvedClosed').innerText = resolvedClosed;
    }

    function saveNewResolution(e) {
        e.preventDefault();

        const caseNo = document.getElementById('newCaseNo').value.trim();
        const name = document.getElementById('newStudentName').value.trim();
        const category = document.getElementById('newCategory').value.trim();
        const verifiedBy = document.getElementById('newVerifiedBy').value.trim();
        const action = document.getElementById('newAction').value.trim();
        const rawDate = document.getElementById('newDate').value;
        const status = document.getElementById('newStatus').value;

        const dateObj = new Date(rawDate);
        const formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });

        let badgeClass = 'status-badge-pending';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'action in progress') badgeClass = 'status-badge-progress';
        else if (lowerStatus === 'resolved') badgeClass = 'status-badge-resolved';
        else if (lowerStatus === 'closed') badgeClass = 'status-badge-closed';

        const rowId = 'row-' + caseNo.toLowerCase();
        const tbody = document.getElementById('resolutionTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'resolution-row';
        newTr.id = rowId;
        newTr.setAttribute('data-case', caseNo.toLowerCase());
        newTr.setAttribute('data-name', name.toLowerCase());
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-4 fw-semibold text-secondary">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${name}</td>
            <td><span class="badge-category">${category}</span></td>
            <td class="text-muted truncate-cell">${action}</td>
            <td class="text-muted">${formattedDate}</td>
            <td class="text-muted">${verifiedBy}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-4">
                <button type="button" class="btn btn-manage-status" onclick="openManageResolutionModal('${caseNo}', '${name}', '${category}', '${action}', '${formattedDate}', '${verifiedBy}', '—', '${status}')">
                    Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('addResolutionModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('addResolutionForm').reset();

        recalculateMetrics();
        applyResolutionFilters();
    }
</script>