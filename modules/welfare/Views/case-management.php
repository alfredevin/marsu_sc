<!-- Student Case Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Uncompressed Responsive Table Container with Continuous Bottom Lines */
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

        /* Case Type Badges */
        .badge-case-type {
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
        .priority-badge-urgent {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-block !important;
        }

        .priority-badge-moderate {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            display: inline-block !important;
        }

        .priority-badge-low {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #d3d6d8 !important;
            display: inline-block !important;
        }

        /* Status Badges */
        .status-badge-intake {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-block !important;
        }

        .status-badge-investigation {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffc107 !important;
            display: inline-block !important;
        }

        .status-badge-hearing {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
            display: inline-block !important;
        }

        .status-badge-resolved {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1px solid #198754 !important;
            display: inline-block !important;
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

        /* Manage Case Button With Arrow Icon */
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

        /* Stepper Styling for Case Tracker */
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 1rem;
        }

        .stepper-wrapper::before {
            content: '';
            position: absolute;
            top: 14px;
            left: 8%;
            right: 8%;
            height: 2px;
            background-color: #e0e0e0;
            z-index: 1;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            z-index: 2;
        }

        .stepper-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            margin-bottom: 4px;
            border: 2px solid #fff;
        }

        .stepper-item.completed .stepper-circle {
            background-color: #198754;
            color: #ffffff;
        }

        .stepper-item.active .stepper-circle {
            background-color: #58111a;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(88, 17, 26, 0.2);
        }

        .stepper-title {
            font-size: 0.725rem;
            font-weight: 600;
            color: #6c757d;
            text-align: center;
        }

        .stepper-item.completed .stepper-title,
        .stepper-item.active .stepper-title {
            color: #212529;
            font-weight: 700;
        }
    </style>

    <!-- Breadcrumb Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-house me-1 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">CASE MANAGEMENT</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-3">
        <h4 class="fw-bold marsu-maroon-text mb-1">Student Case Management</h4>
        <p class="text-muted small mb-0">Track, investigate, and resolve disciplinary, academic integrity, and student welfare cases systematically.</p>
    </div>

    <!-- Filter and Search Toolbar (Single Row Aligned) -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="caseSearch" class="search-pill-input" placeholder="Search case ID, student..." oninput="applyCaseFilters()" autocomplete="off">
            </div>

            <!-- 2. Case Type Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Case Type:</label>
                <select class="form-select form-select-sm filter-select" id="caseTypeFilter" onchange="applyCaseFilters()">
                    <option value="">All Types</option>
                    <option value="Disciplinary">Disciplinary</option>
                    <option value="Academic Integrity">Academic Integrity</option>
                    <option value="Grievance">Grievance</option>
                    <option value="Welfare Intervention">Welfare Intervention</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="statusFilter" onchange="applyCaseFilters()">
                    <option value="">All Statuses</option>
                    <option value="Initial Intake">Initial Intake</option>
                    <option value="Under Investigation">Under Investigation</option>
                    <option value="Hearing Scheduled">Hearing Scheduled</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>

            <!-- 4. Open New Case Button -->
            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="openNewCaseModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Open New Case
            </button>

        </div>
    </div>

    <!-- Case Management Table -->
    <div class="table-responsive-custom bg-white shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="tblCases">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 13%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Involved</th>
                    <th class="py-3" style="width: 16%;">Case Type</th>
                    <th class="py-3" style="width: 22%;">Subject / Offense</th>
                    <th class="py-3 text-center" style="width: 10%;">Priority</th>
                    <th class="py-3 text-center" style="width: 11%;">Status</th>
                    <th class="py-3 text-center pe-4" style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="tblCasesBody">
                <tr class="case-row" data-id="cs-2026-042" data-name="reyes, mark anthony b." data-type="Academic Integrity" data-status="Under Investigation">
                    <td class="ps-4 fw-semibold text-secondary">CS-2026-042</td>
                    <td class="fw-semibold text-dark truncate-cell">Reyes, Mark Anthony B.</td>
                    <td>
                        <span class="badge-case-type">Academic Integrity</span>
                    </td>
                    <td class="text-muted truncate-cell">Alleged examination misconduct</td>
                    <td class="text-center">
                        <span class="priority-badge-urgent">Urgent</span>
                    </td>
                    <td class="text-center">
                        <span class="status-badge-investigation">Under Investigation</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageCaseModal('CS-2026-042', 'Reyes, Mark Anthony B.', 'Academic Integrity', 'Alleged examination misconduct', 'Urgent Priority', 'Under Investigation', '2')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="case-row" data-id="cs-2026-041" data-name="villanueva, sarah g." data-type="Disciplinary" data-status="Hearing Scheduled">
                    <td class="ps-4 fw-semibold text-secondary">CS-2026-041</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Sarah G.</td>
                    <td>
                        <span class="badge-case-type">Disciplinary</span>
                    </td>
                    <td class="text-muted truncate-cell">Campus property damage dispute</td>
                    <td class="text-center">
                        <span class="priority-badge-moderate">Moderate</span>
                    </td>
                    <td class="text-center">
                        <span class="status-badge-hearing">Hearing Scheduled</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageCaseModal('CS-2026-041', 'Villanueva, Sarah G.', 'Disciplinary', 'Campus property damage dispute', 'Moderate Priority', 'Hearing Scheduled', '3')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="case-row" data-id="cs-2026-040" data-name="dela cruz, juan p." data-type="Welfare Intervention" data-status="Initial Intake">
                    <td class="ps-4 fw-semibold text-secondary">CS-2026-040</td>
                    <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Juan P.</td>
                    <td>
                        <span class="badge-case-type">Welfare Intervention</span>
                    </td>
                    <td class="text-muted truncate-cell">Repeated unexcused absences</td>
                    <td class="text-center">
                        <span class="priority-badge-low">Low</span>
                    </td>
                    <td class="text-center">
                        <span class="status-badge-intake">Initial Intake</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageCaseModal('CS-2026-040', 'Dela Cruz, Juan P.', 'Welfare Intervention', 'Repeated unexcused absences', 'Low Priority', 'Initial Intake', '1')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="case-row" data-id="cs-2026-039" data-name="bautista, chloe marie t." data-type="Grievance" data-status="Resolved">
                    <td class="ps-4 fw-semibold text-secondary">CS-2026-039</td>
                    <td class="fw-semibold text-dark truncate-cell">Bautista, Chloe Marie T.</td>
                    <td>
                        <span class="badge-case-type">Grievance</span>
                    </td>
                    <td class="text-muted truncate-cell">Student organization funds audit</td>
                    <td class="text-center">
                        <span class="priority-badge-moderate">Moderate</span>
                    </td>
                    <td class="text-center">
                        <span class="status-badge-resolved">Resolved</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageCaseModal('CS-2026-039', 'Bautista, Chloe Marie T.', 'Grievance', 'Student organization funds audit', 'Moderate Priority', 'Resolved', '4')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noCaseRecordsRow" style="display: none;">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No case records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination Metadata -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 18 active cases</span>
        <span>Page 1 of 5</span>
    </div>

    <!-- Due Process & Governance Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-folder-symlink-fill marsu-maroon-text fs-4 flex-shrink-0"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Due Process & Governance Protocol</h6>
                <p class="text-muted small mb-0">
                    Ensure all case files contain sworn statements, documented notices, hearing minutes, and formal committee resolutions. Adhere to institutional regulations, student rights to due process, and strict confidentiality guidelines.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: MANAGE CASE STATUS (ESSENTIAL INFO ONLY)                     -->
<!-- ===================================================================== -->
<div class="modal fade" id="manageCaseModal" tabindex="-1" aria-labelledby="manageCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="manageCaseModalLabel">
                    <i class="bi bi-sliders me-1"></i> Manage Case Status & Progress
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                
                <!-- Student & Case Context Header Card -->
                <div class="card border rounded-3 p-3 mb-3 bg-light-subtle">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block" id="modalCaseNo">CS-2026-042</span>
                            <h5 class="fw-bold text-dark mb-0" id="modalStudentInvolved">Reyes, Mark Anthony B.</h5>
                        </div>
                        <span class="priority-badge-urgent" id="modalPriorityBadge">Urgent Priority</span>
                    </div>

                    <div class="row g-2 text-muted small mt-1">
                        <div class="col-12">
                            <i class="bi bi-tag me-1"></i> Case Type: <strong class="text-dark" id="modalCaseType">Academic Integrity</strong>
                        </div>
                    </div>
                </div>

                <!-- Subject / Offense Details -->
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Subject / Alleged Offense</label>
                    <div class="p-2.5 border rounded bg-white text-dark fw-semibold" id="modalSubjectText">
                        Alleged examination misconduct
                    </div>
                </div>

                <!-- 5-Step Case Progress Stepper -->
                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Case Lifecycle Stage</label>
                <div class="stepper-wrapper mb-3 px-1" id="modalStepper">
                    <div class="stepper-item" id="step1">
                        <div class="stepper-circle">1</div>
                        <div class="stepper-title">Intake</div>
                    </div>
                    <div class="stepper-item" id="step2">
                        <div class="stepper-circle">2</div>
                        <div class="stepper-title">Investigation</div>
                    </div>
                    <div class="stepper-item" id="step3">
                        <div class="stepper-circle">3</div>
                        <div class="stepper-title">Hearing</div>
                    </div>
                    <div class="stepper-item" id="step4">
                        <div class="stepper-circle">4</div>
                        <div class="stepper-title">Resolution</div>
                    </div>
                    <div class="stepper-item" id="step5">
                        <div class="stepper-circle">5</div>
                        <div class="stepper-title">Closed</div>
                    </div>
                </div>

                <!-- Status Update Form -->
                <div class="border-top pt-3">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square me-1"></i> Update Case Progress</h6>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Update Status</label>
                            <select class="form-select form-select-sm" id="modalStatusSelect" onchange="updateModalStepper(this.value)">
                                <option value="Initial Intake">Initial Intake</option>
                                <option value="Under Investigation">Under Investigation</option>
                                <option value="Hearing Scheduled">Hearing Scheduled</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Case Notes & Findings</label>
                            <textarea class="form-control form-control-sm" id="modalCaseNotes" rows="3" placeholder="Enter investigation progress, witness statements, or committee findings..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-maroon-primary" onclick="saveCaseStatus()">Save Status Changes</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL 2: OPEN NEW CASE                                                -->
<!-- ===================================================================== -->
<div class="modal fade" id="newCaseModal" tabindex="-1" aria-labelledby="newCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newCaseModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Open New Case File
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newCaseForm" onsubmit="saveNewCase(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Case Number</label>
                        <input type="text" class="form-control form-control-sm" id="newCaseNo" placeholder="e.g. CS-2026-043" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Involved</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentInvolved" placeholder="e.g. Santos, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Case Type</label>
                            <select class="form-select form-select-sm" id="newCaseType" required>
                                <option value="Academic Integrity">Academic Integrity</option>
                                <option value="Disciplinary">Disciplinary</option>
                                <option value="Grievance">Grievance</option>
                                <option value="Welfare Intervention">Welfare Intervention</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Priority Level</label>
                            <select class="form-select form-select-sm" id="newPriority" required>
                                <option value="Urgent">Urgent</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Subject / Alleged Offense</label>
                        <input type="text" class="form-control form-control-sm" id="newSubject" placeholder="Brief statement of concern..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Initial Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Initial Intake">Initial Intake</option>
                            <option value="Under Investigation">Under Investigation</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Create Case File</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyCaseFilters() {
        const searchInput = document.getElementById('caseSearch').value.toLowerCase().trim();
        const caseTypeFilter = document.getElementById('caseTypeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('.case-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const type = row.getAttribute('data-type');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || name.includes(searchInput);
            const matchesType = !caseTypeFilter || type.toLowerCase() === caseTypeFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesType && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noCaseRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} active cases`;
        }
    }

    function updateModalStepper(status) {
        const s1 = document.getElementById('step1');
        const s2 = document.getElementById('step2');
        const s3 = document.getElementById('step3');
        const s4 = document.getElementById('step4');
        const s5 = document.getElementById('step5');

        [s1, s2, s3, s4, s5].forEach(step => {
            if (step) step.className = 'stepper-item';
        });

        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'initial intake') {
            s1.className = 'stepper-item active';
        } else if (lowerStatus === 'under investigation') {
            s1.className = 'stepper-item completed';
            s2.className = 'stepper-item active';
        } else if (lowerStatus === 'hearing scheduled') {
            s1.className = 'stepper-item completed';
            s2.className = 'stepper-item completed';
            s3.className = 'stepper-item active';
        } else if (lowerStatus === 'resolved') {
            s1.className = 'stepper-item completed';
            s2.className = 'stepper-item completed';
            s3.className = 'stepper-item completed';
            s4.className = 'stepper-item active';
            s5.className = 'stepper-item completed';
        }
    }

    function openManageCaseModal(caseNo, student, type, subject, priority, status, stepNum) {
        document.getElementById('modalCaseNo').innerText = caseNo;
        document.getElementById('modalStudentInvolved').innerText = student;
        document.getElementById('modalCaseType').innerText = type;
        document.getElementById('modalSubjectText').innerText = subject;
        document.getElementById('modalPriorityBadge').innerText = priority;

        const statusSelect = document.getElementById('modalStatusSelect');
        if (statusSelect) statusSelect.value = status;

        updateModalStepper(status);

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('manageCaseModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Manage Case: ' + caseNo);
        }
    }

    function saveCaseStatus() {
        alert('Case status updated successfully!');
        const modalElem = document.getElementById('manageCaseModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }
    }

    function openNewCaseModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newCaseModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Open New Case Form');
        }
    }

    function saveNewCase(e) {
        e.preventDefault();

        const caseNo = document.getElementById('newCaseNo').value.trim();
        const student = document.getElementById('newStudentInvolved').value.trim();
        const type = document.getElementById('newCaseType').value;
        const priority = document.getElementById('newPriority').value;
        const subject = document.getElementById('newSubject').value.trim();
        const status = document.getElementById('newStatus').value;

        // Badge styling
        let priorityClass = 'priority-badge-urgent';
        if (priority.toLowerCase() === 'moderate') priorityClass = 'priority-badge-moderate';
        else if (priority.toLowerCase() === 'low') priorityClass = 'priority-badge-low';

        let statusClass = 'status-badge-intake';
        if (status.toLowerCase() === 'under investigation') statusClass = 'status-badge-investigation';

        const tbody = document.getElementById('tblCasesBody');
        const newTr = document.createElement('tr');
        newTr.className = 'case-row';
        newTr.setAttribute('data-id', caseNo.toLowerCase());
        newTr.setAttribute('data-name', student.toLowerCase());
        newTr.setAttribute('data-type', type);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-4 fw-semibold text-secondary">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="badge-case-type">${type}</span></td>
            <td class="text-muted truncate-cell">${subject}</td>
            <td class="text-center"><span class="${priorityClass}">${priority}</span></td>
            <td class="text-center"><span class="${statusClass}">${status}</span></td>
            <td class="text-center pe-4">
                <button type="button" class="btn btn-manage-status" onclick="openManageCaseModal('${caseNo}', '${student}', '${type}', '${subject}', '${priority} Priority', '${status}', '1')">
                    Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        // Hide Modal & Reset Form
        const modalElem = document.getElementById('newCaseModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newCaseForm').reset();

        applyCaseFilters();
    }
</script>