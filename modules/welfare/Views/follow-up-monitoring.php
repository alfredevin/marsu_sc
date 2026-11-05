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

        /* Responsive Table Container */
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px;
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

        /* Compact Search Pill Input */
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

        /* Status Badges */
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

        /* Metric Cards */
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
        .accent-danger::before { background-color: #dc3545; }
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

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Follow-ups</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotal">4</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-list-check fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Scheduled</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricScheduled">1</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-calendar-event fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-danger d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Due / Overdue</div>
                    <div class="fs-2 fw-bold text-danger lh-1" id="metricDueOverdue">2</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-danger ms-2">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Completed</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricCompleted">1</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="followupSearch" class="search-pill-input" placeholder="Search case, student..." oninput="applyFollowupFilters()" autocomplete="off">
            </div>

            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="followupStatus" onchange="applyFollowupFilters()">
                    <option value="">All Statuses</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Due">Due</option>
                    <option value="Completed">Completed</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>

            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="openAddFollowupModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add Follow-up
            </button>

        </div>
    </div>

    <!-- Follow-up Monitoring Table -->
    <div class="table-responsive-custom bg-white shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="followupTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 12%;">Follow-up ID</th>
                    <th class="py-3" style="width: 12%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 12%;">Follow-up Date</th>
                    <th class="py-3" style="width: 16%;">Assigned Personnel</th>
                    <th class="py-3" style="width: 20%;">Follow-up Notes</th>
                    <th class="py-3 text-center" style="width: 10%;">Status</th>
                    <th class="py-3 text-center pe-4" style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="followupTableBody">
                <tr class="followup-row" id="row-fu-2026-018" data-id="fu-2026-018" data-case="cm-2026-0248" data-name="adamos, mariedhen l." data-status="Scheduled">
                    <td class="ps-4 fw-semibold text-secondary">FU-2026-018</td>
                    <td class="fw-semibold text-dark">CM-2026-0248</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td class="text-muted">Oct 16, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-muted truncate-cell">Check status of financial assistance referral</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-scheduled">Scheduled</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageFollowupModal('FU-2026-018', 'CM-2026-0248', 'Adamos, Mariedhen L.', 'Oct 16, 2026', 'Guidance Counselor', 'Check status of financial assistance referral', 'Scheduled')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="followup-row" id="row-fu-2026-017" data-id="fu-2026-017" data-case="cm-2026-0241" data-name="ali, kyla diane m." data-status="Due">
                    <td class="ps-4 fw-semibold text-secondary">FU-2026-017</td>
                    <td class="fw-semibold text-dark">CM-2026-0241</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td class="text-muted">Oct 13, 2026</td>
                    <td class="text-muted">Student Affairs Staff</td>
                    <td class="text-muted truncate-cell">Review academic adjustment plan</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-due">Due</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageFollowupModal('FU-2026-017', 'CM-2026-0241', 'Ali, Kyla Diane M.', 'Oct 13, 2026', 'Student Affairs Staff', 'Review academic adjustment plan', 'Due')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="followup-row" id="row-fu-2026-016" data-id="fu-2026-016" data-case="cm-2026-0239" data-name="almonte, hanz andrei r." data-status="Completed">
                    <td class="ps-4 fw-semibold text-secondary">FU-2026-016</td>
                    <td class="fw-semibold text-dark">CM-2026-0239</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td class="text-muted">Oct 10, 2026</td>
                    <td class="text-muted">Assigned Case Officer</td>
                    <td class="text-muted truncate-cell">Confirm whether transport support was received</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageFollowupModal('FU-2026-016', 'CM-2026-0239', 'Almonte, Hanz Andrei R.', 'Oct 10, 2026', 'Assigned Case Officer', 'Confirm whether transport support was received', 'Completed')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="followup-row" id="row-fu-2026-015" data-id="fu-2026-015" data-case="cm-2026-0235" data-name="andaya, patricia m." data-status="Overdue">
                    <td class="ps-4 fw-semibold text-secondary">FU-2026-015</td>
                    <td class="fw-semibold text-dark">CM-2026-0235</td>
                    <td class="fw-semibold text-dark truncate-cell">Andaya, Patricia M.</td>
                    <td class="text-muted">Oct 09, 2026</td>
                    <td class="text-muted">Guidance Counselor</td>
                    <td class="text-muted truncate-cell">Student has not yet attended scheduled check-in</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-overdue">Overdue</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageFollowupModal('FU-2026-015', 'CM-2026-0235', 'Andaya, Patricia M.', 'Oct 09, 2026', 'Guidance Counselor', 'Student has not yet attended scheduled check-in', 'Overdue')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noFollowupRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No follow-up records found</p>
                        <small>No records matched your search query or selected filters.</small>
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

<!-- MODAL: MANAGE FOLLOW-UP STATUS -->
<div class="modal fade" id="manageFollowupModal" tabindex="-1" aria-labelledby="manageFollowupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="manageFollowupModalLabel">
                    <i class="bi bi-sliders me-1"></i> Manage Follow-up Status
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                
                <!-- Hidden Active ID -->
                <input type="hidden" id="activeFollowupId" value="">

                <!-- Student & Case Header Card -->
                <div class="card border rounded-3 p-3 mb-3 bg-light-subtle">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block">
                                <span id="modalFollowupId">FU-2026-018</span> • Case <span id="modalCaseNo">CM-2026-0248</span>
                            </span>
                            <h5 class="fw-bold text-dark mb-0" id="modalStudentName">Adamos, Mariedhen L.</h5>
                        </div>
                        <span class="status-badge-scheduled" id="modalStatusBadge">Scheduled</span>
                    </div>

                    <div class="row g-2 text-muted small mt-1">
                        <div class="col-12 col-md-6">
                            <i class="bi bi-person-badge me-1"></i> Staff: <strong class="text-dark" id="modalPersonnel">Guidance Counselor</strong>
                        </div>
                        <div class="col-12 col-md-6">
                            <i class="bi bi-calendar3 me-1"></i> Date: <strong class="text-dark" id="modalDate">Oct 16, 2026</strong>
                        </div>
                    </div>
                </div>

                <!-- Notes / Objective -->
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Follow-up Notes / Objectives</label>
                    <div class="p-2.5 border rounded bg-white text-dark fw-semibold" id="modalNotesText">
                        Check status of financial assistance referral
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="border-top pt-3">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square me-1"></i> Update Follow-up Status</h6>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Current Follow-up Status</label>
                            <select class="form-select form-select-sm" id="modalStatusSelect" onchange="updateModalBadgePreview(this.value)">
                                <option value="Scheduled">Scheduled</option>
                                <option value="Due">Due</option>
                                <option value="Completed">Completed</option>
                                <option value="Overdue">Overdue</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Update Remarks / Outcome Notes</label>
                            <textarea class="form-control form-control-sm" id="modalRemarksText" rows="3" placeholder="Enter notes from check-in session or next steps..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-maroon-primary" onclick="saveFollowupStatus()">Save Status Changes</button>
            </div>

        </div>
    </div>
</div>

<!-- MODAL: ADD FOLLOW-UP -->
<div class="modal fade" id="addFollowupModal" tabindex="-1" aria-labelledby="addFollowupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addFollowupModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Schedule Follow-up Check-in
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addFollowupForm" onsubmit="saveNewFollowup(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Follow-up ID</label>
                            <input type="text" class="form-control form-control-sm" id="newFollowupId" placeholder="e.g. FU-2026-019" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Case Number</label>
                            <input type="text" class="form-control form-control-sm" id="newCaseNo" placeholder="e.g. CM-2026-0250" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Dela Cruz, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Follow-up Date</label>
                            <input type="date" class="form-control form-control-sm" id="newDate" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Personnel</label>
                            <input type="text" class="form-control form-control-sm" id="newPersonnel" placeholder="e.g. Guidance Counselor" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Follow-up Notes / Goal</label>
                        <input type="text" class="form-control form-control-sm" id="newNotes" placeholder="Brief objective of follow-up..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Initial Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Due">Due</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Schedule Follow-up</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    function applyFollowupFilters() {
        const searchInput = document.getElementById('followupSearch').value.toLowerCase().trim();
        const statusFilter = document.getElementById('followupStatus').value;

        const rows = document.querySelectorAll('.followup-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const caseNo = row.getAttribute('data-case');
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || caseNo.includes(searchInput) || name.includes(searchInput);
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noFollowupRecordsRow');
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
        if (lowerStatus === 'scheduled') badgeElem.className = 'status-badge-scheduled';
        else if (lowerStatus === 'due') badgeElem.className = 'status-badge-due';
        else if (lowerStatus === 'completed') badgeElem.className = 'status-badge-completed';
        else if (lowerStatus === 'overdue') badgeElem.className = 'status-badge-overdue';
    }

    function openManageFollowupModal(fuId, caseNo, student, date, personnel, notes, status) {
        document.getElementById('activeFollowupId').value = fuId.toLowerCase();
        document.getElementById('modalFollowupId').innerText = fuId;
        document.getElementById('modalCaseNo').innerText = caseNo;
        document.getElementById('modalStudentName').innerText = student;
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modalPersonnel').innerText = personnel;
        document.getElementById('modalNotesText').innerText = notes;

        const statusSelect = document.getElementById('modalStatusSelect');
        if (statusSelect) statusSelect.value = status;

        updateModalBadgePreview(status);

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('manageFollowupModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Manage Follow-up: ' + fuId);
        }
    }

    function saveFollowupStatus() {
        const activeFuId = document.getElementById('activeFollowupId').value;
        const newStatus = document.getElementById('modalStatusSelect').value;

        // Kuhanin ang row sa talahanayan
        const targetRow = document.getElementById('row-' + activeFuId);

        if (targetRow) {
            // Update attribute
            targetRow.setAttribute('data-status', newStatus);

            // Alamin ang bagong klase ng badge
            let newBadgeClass = 'status-badge-scheduled';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'due') newBadgeClass = 'status-badge-due';
            else if (lowerStatus === 'completed') newBadgeClass = 'status-badge-completed';
            else if (lowerStatus === 'overdue') newBadgeClass = 'status-badge-overdue';

            // I-update ang HTML sa table cell
            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            // I-update ang onclick para sa susunod na pagpindot
            const manageBtn = targetRow.querySelector('.btn-manage-status');
            if (manageBtn) {
                const fuIdText = targetRow.cells[0].innerText;
                const caseNoText = targetRow.cells[1].innerText;
                const nameText = targetRow.cells[2].innerText;
                const dateText = targetRow.cells[3].innerText;
                const personnelText = targetRow.cells[4].innerText;
                const notesText = targetRow.cells[5].innerText;

                manageBtn.setAttribute('onclick', `openManageFollowupModal('${fuIdText}', '${caseNoText}', '${nameText}', '${dateText}', '${personnelText}', '${notesText}', '${newStatus}')`);
            }
        }

        // Isara ang modal
        const modalElem = document.getElementById('manageFollowupModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        // I-recalculate ang metrics at i-filter
        recalculateMetrics();
        applyFollowupFilters();

        alert('Follow-up status successfully updated!');
    }

    function openAddFollowupModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addFollowupModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add Follow-up Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.followup-row');
        let total = rows.length;
        let scheduled = 0;
        let dueOverdue = 0;
        let completed = 0;

        rows.forEach(row => {
            const st = row.getAttribute('data-status').toLowerCase();
            if (st === 'scheduled') scheduled++;
            else if (st === 'due' || st === 'overdue') dueOverdue++;
            else if (st === 'completed') completed++;
        });

        document.getElementById('metricTotal').innerText = total;
        document.getElementById('metricScheduled').innerText = scheduled;
        document.getElementById('metricDueOverdue').innerText = dueOverdue;
        document.getElementById('metricCompleted').innerText = completed;
    }

    function saveNewFollowup(e) {
        e.preventDefault();

        const fuId = document.getElementById('newFollowupId').value.trim();
        const caseNo = document.getElementById('newCaseNo').value.trim();
        const name = document.getElementById('newStudentName').value.trim();
        const rawDate = document.getElementById('newDate').value;
        const personnel = document.getElementById('newPersonnel').value.trim();
        const notes = document.getElementById('newNotes').value.trim();
        const status = document.getElementById('newStatus').value;

        const dateObj = new Date(rawDate);
        const formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });

        let badgeClass = 'status-badge-scheduled';
        if (status.toLowerCase() === 'due') badgeClass = 'status-badge-due';

        const rowId = 'row-' + fuId.toLowerCase();
        const tbody = document.getElementById('followupTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'followup-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', fuId.toLowerCase());
        newTr.setAttribute('data-case', caseNo.toLowerCase());
        newTr.setAttribute('data-name', name.toLowerCase());
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-4 fw-semibold text-secondary">${fuId}</td>
            <td class="fw-semibold text-dark">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${name}</td>
            <td class="text-muted">${formattedDate}</td>
            <td class="text-muted">${personnel}</td>
            <td class="text-muted truncate-cell">${notes}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-4">
                <button type="button" class="btn btn-manage-status" onclick="openManageFollowupModal('${fuId}', '${caseNo}', '${name}', '${formattedDate}', '${personnel}', '${notes}', '${status}')">
                    Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('addFollowupModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('addFollowupForm').reset();

        recalculateMetrics();
        applyFollowupFilters();
    }
</script>