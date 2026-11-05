<!-- Progress Tracking Management (MarSU OSAS Standard) -->
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
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
        }

        /* Flexible Uncompressed Table Layout */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px;
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

        /* Status Badges */
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

        .status-badge-ontrack {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
            border: 1px solid #badbcc !important;
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

        .status-badge-attention {
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

        .status-badge-notstarted {
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
            background-color: #fcfcfd;
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
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center">
                <i class="bi bi-house me-1 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">INTERVENTION MONITORING</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">PROGRESS TRACKING</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Progress Tracking</h4>
        <p class="text-muted small mb-0">Monitor intervention milestones, completed actions, and next steps for each student case under MarSU OSAS guidelines.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="progressSearch" class="search-pill-input" placeholder="Search case or student..." oninput="applyProgressFilters()" autocomplete="off">
            </div>

            <!-- 2. Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="progressStatusFilter" onchange="applyProgressFilters()">
                    <option value="">All Statuses</option>
                    <option value="Not Started">Not Started</option>
                    <option value="In Progress">In Progress</option>
                    <option value="On Track">On Track</option>
                    <option value="Needs Attention">Needs Attention</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <!-- 3. Log Progress Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openNewProgressModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Log Progress
            </button>

        </div>
    </div>

    <!-- Progress Tracking Table -->
    <div class="table-responsive-custom bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="progressTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Progress ID</th>
                    <th class="py-3" style="width: 12%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 22%;">Milestone / Action</th>
                    <th class="py-3 text-center" style="width: 11%;">Last Update</th>
                    <th class="py-3 text-center" style="width: 11%;">Status</th>
                    <th class="py-3" style="width: 14%;">Next Step</th>
                    <th class="py-3 text-center pe-3" style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="progressTableBody">
                <tr class="progress-row" id="row-pg-2026-021" data-id="pg-2026-021" data-case="cm-2026-0248" data-student="dela cruz, angelo m." data-status="In Progress">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">PG-2026-021</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Angelo M.</td>
                    <td class="text-muted truncate-cell">Academic coaching session 1 completed</td>
                    <td class="text-center text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-progress">In Progress</span>
                    </td>
                    <td class="text-muted truncate-cell">Review attendance</td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgressModal('PG-2026-021', 'CM-2026-0248', 'Dela Cruz, Angelo M.', 'Academic coaching session 1 completed', 'Oct 12, 2026', 'In Progress', 'Review attendance log with department chairman.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="progress-row" id="row-pg-2026-020" data-id="pg-2026-020" data-case="cm-2026-0246" data-student="villanueva, kim d." data-status="On Track">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">PG-2026-020</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0246</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                    <td class="text-muted truncate-cell">Scheduled counselor check-in conducted</td>
                    <td class="text-center text-muted text-nowrap">Oct 11, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-ontrack">On Track</span>
                    </td>
                    <td class="text-muted truncate-cell">Follow-up Oct 19</td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgressModal('PG-2026-020', 'CM-2026-0246', 'Villanueva, Kim D.', 'Scheduled counselor check-in conducted', 'Oct 11, 2026', 'On Track', 'Follow-up consultation scheduled on Oct 19.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="progress-row" id="row-pg-2026-019" data-id="pg-2026-019" data-case="cm-2026-0245" data-student="santos, paolo r." data-status="Completed">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">PG-2026-019</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0245</td>
                    <td class="fw-semibold text-dark truncate-cell">Santos, Paolo R.</td>
                    <td class="text-muted truncate-cell">Family consultation and clearance signed</td>
                    <td class="text-center text-muted text-nowrap">Oct 09, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-muted truncate-cell">Evaluate outcome</td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgressModal('PG-2026-019', 'CM-2026-0245', 'Santos, Paolo R.', 'Family consultation and clearance signed', 'Oct 09, 2026', 'Completed', 'Evaluate semester end outcome and archive file.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noProgressRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No progress tracking records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 3 of 3 progress entries</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Progress Review Guide Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-journal-check marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">MarSU OSAS Progress Review Protocol</h6>
                <p class="text-muted small mb-0">
                    Record observable progress, date of update, evidence or feedback, barriers encountered, next action, and assigned case personnel. Escalate urgent safety or behavioral concerns through official university protocol.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (PROGRESS TRACKING FOCUS)       -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialProgressModal" tabindex="-1" aria-labelledby="essentialProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">PROGRESS MILESTONE DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vProgressId">PG-2026-021</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeProgressId" value="">

                <!-- 1. Student / Case Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student / Case Reference</span>
                        <span class="status-badge-progress" id="vStatusBadge">In Progress</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Dela Cruz, Angelo M.</h5>
                    <div class="small text-muted fw-semibold" id="vCaseNo">Case No: CM-2026-0248</div>
                </div>

                <!-- 2. Milestone Details Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-7">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Milestone / Action Taken</div>
                            <div class="essential-value marsu-maroon-text" id="vMilestone">Academic coaching session 1 completed</div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Last Update</div>
                            <div class="essential-value text-dark" id="vLastUpdate">Oct 12, 2026</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Intervention Progress Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="pst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Initiated</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="pst2">2</div>
                            <span class="compact-step-label text-dark fw-bold">In Progress</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="pst3">3</div>
                            <span class="compact-step-label">On Track</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="pst4">4</div>
                            <span class="compact-step-label">Completed</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Next Step & Recommendations -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Next Step & Directives</div>
                    <div class="small text-dark fw-semibold" id="vNextStepText">Review attendance log with department chairman.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Progress Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="On Track">On Track</option>
                            <option value="Needs Attention">Needs Attention</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialProgressStatus()">Save Status</button>
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
<!-- MODAL 2: LOG NEW PROGRESS ENTRY                                       -->
<!-- ===================================================================== -->
<div class="modal fade" id="newProgressModal" tabindex="-1" aria-labelledby="newProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newProgressModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Log Intervention Progress
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newProgressForm" onsubmit="saveNewProgressLog(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Progress ID</label>
                            <input type="text" class="form-control form-control-sm" id="newProgressId" placeholder="e.g. PG-2026-022" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Case Number</label>
                            <input type="text" class="form-control form-control-sm" id="newCaseNo" placeholder="e.g. CM-2026-0249" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Santos, Maria A." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Milestone / Action Taken</label>
                        <input type="text" class="form-control form-control-sm" id="newMilestone" placeholder="e.g. Remedial tutoring attendance verified" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Date Updated</label>
                            <input type="date" class="form-control form-control-sm" id="newUpdateDate" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="On Track">On Track</option>
                                <option value="Needs Attention">Needs Attention</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Next Step & Recommendations</label>
                        <textarea class="form-control form-control-sm" id="newNextStep" rows="3" placeholder="Detail scheduled follow-ups or next required actions..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Progress Log</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyProgressFilters() {
        const searchInput = document.getElementById('progressSearch').value.toLowerCase().trim();
        const statusFilter = document.getElementById('progressStatusFilter').value;

        const rows = document.querySelectorAll('.progress-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const caseNo = row.getAttribute('data-case');
            const student = row.getAttribute('data-student');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || caseNo.includes(searchInput) || student.includes(searchInput);
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noProgressRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} progress entries`;
        }
    }

    function openEssentialProgressModal(progressId, caseNo, student, milestone, lastUpdate, status, nextStep) {
        document.getElementById('activeProgressId').value = progressId.toLowerCase();
        document.getElementById('vProgressId').innerText = progressId;
        document.getElementById('vCaseNo').innerText = 'Case No: ' + caseNo;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vMilestone').innerText = milestone;
        document.getElementById('vLastUpdate').innerText = lastUpdate;
        document.getElementById('vNextStepText').innerText = nextStep || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'in progress') badgeElem.className = 'status-badge-progress';
        else if (lower === 'on track') badgeElem.className = 'status-badge-ontrack';
        else if (lower === 'completed') badgeElem.className = 'status-badge-completed';
        else if (lower === 'needs attention') badgeElem.className = 'status-badge-attention';
        else badgeElem.className = 'status-badge-notstarted';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('pst1');
        const st2 = document.getElementById('pst2');
        const st3 = document.getElementById('pst3');
        const st4 = document.getElementById('pst4');

        st1.className = 'compact-step-circle completed';

        if (lower === 'completed') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st4.className = 'compact-step-circle completed';
            st4.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'on track') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle active';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else if (lower === 'in progress') {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        } else {
            st1.className = 'compact-step-circle active';
            st1.innerText = '1';
            st2.className = 'compact-step-circle';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
            st4.className = 'compact-step-circle';
            st4.innerText = '4';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialProgressModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Progress Details: ' + progressId);
        }
    }

    function saveEssentialProgressStatus() {
        const activeProgressId = document.getElementById('activeProgressId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeProgressId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-notstarted';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'in progress') newBadgeClass = 'status-badge-progress';
            else if (lowerStatus === 'on track') newBadgeClass = 'status-badge-ontrack';
            else if (lowerStatus === 'completed') newBadgeClass = 'status-badge-completed';
            else if (lowerStatus === 'needs attention') newBadgeClass = 'status-badge-attention';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const caseText = targetRow.cells[1].innerText;
                const studentText = targetRow.cells[2].innerText;
                const milestoneText = targetRow.cells[3].innerText;
                const dateText = targetRow.cells[4].innerText;
                const nextStepText = targetRow.cells[6].innerText;

                viewBtn.setAttribute('onclick', `openEssentialProgressModal('${idText}', '${caseText}', '${studentText}', '${milestoneText}', '${dateText}', '${newStatus}', '${nextStepText}')`);
            }
        }

        const modalElem = document.getElementById('essentialProgressModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        applyProgressFilters();
        alert('Progress status successfully updated!');
    }

    function openNewProgressModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newProgressModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Log Progress Form');
        }
    }

    function saveNewProgressLog(e) {
        e.preventDefault();

        const progressId = document.getElementById('newProgressId').value.trim();
        const caseNo = document.getElementById('newCaseNo').value.trim();
        const student = document.getElementById('newStudentName').value.trim();
        const milestone = document.getElementById('newMilestone').value.trim();
        const rawDate = document.getElementById('newUpdateDate').value;
        const status = document.getElementById('newStatus').value;
        const nextStep = document.getElementById('newNextStep').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-notstarted';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'in progress') badgeClass = 'status-badge-progress';
        else if (lowerStatus === 'on track') badgeClass = 'status-badge-ontrack';
        else if (lowerStatus === 'completed') badgeClass = 'status-badge-completed';
        else if (lowerStatus === 'needs attention') badgeClass = 'status-badge-attention';

        const rowId = 'row-' + progressId.toLowerCase();
        const tbody = document.getElementById('progressTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'progress-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', progressId.toLowerCase());
        newTr.setAttribute('data-case', caseNo.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${progressId}</td>
            <td class="fw-semibold text-dark text-nowrap">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td class="text-muted truncate-cell">${milestone}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-muted truncate-cell">${nextStep}</td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialProgressModal('${progressId}', '${caseNo}', '${student}', '${milestone}', '${formattedDate}', '${status}', '${nextStep}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newProgressModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newProgressForm').reset();

        applyProgressFilters();
    }
</script>