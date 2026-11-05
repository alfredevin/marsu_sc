<!-- Assigned Personnel Management (MarSU OSAS Standard) -->
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

        /* Flexible Uncompressed Table Columns */
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

        /* Role Badges */
        .badge-role {
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
        .status-badge-active {
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

        .status-badge-completed {
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
            <span class="small fw-bold marsu-maroon-text">ASSIGNED PERSONNEL</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Assigned Personnel Management</h4>
        <p class="text-muted small mb-0">View and manage staff members, guidance counselors, and faculty advisers responsible for student intervention plans and case follow-ups.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="personnelSearch" class="search-pill-input" placeholder="Search staff, student, or ID..." oninput="applyPersonnelFilters()" autocomplete="off">
            </div>

            <!-- 2. Role Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Role:</label>
                <select class="form-select form-select-sm filter-select" id="personnelRoleFilter" onchange="applyPersonnelFilters()">
                    <option value="">All Roles</option>
                    <option value="Guidance Counselor">Guidance Counselor</option>
                    <option value="Case Worker">Case Worker</option>
                    <option value="Faculty Adviser">Faculty Adviser</option>
                    <option value="Support Staff">Support Staff</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="personnelStatusFilter" onchange="applyPersonnelFilters()">
                    <option value="">All Statuses</option>
                    <option value="Active">Active</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <!-- 4. Assign Personnel Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openNewPersonnelModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Assign Personnel
            </button>

        </div>
    </div>

    <!-- Assigned Personnel Table -->
    <div class="table-responsive-custom bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="personnelTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 13%;">Assignment ID</th>
                    <th class="py-3" style="width: 13%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 16%;">Role</th>
                    <th class="py-3" style="width: 17%;">Assigned Personnel</th>
                    <th class="py-3 text-center" style="width: 12%;">Assigned Date</th>
                    <th class="py-3 text-center" style="width: 11%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="personnelTableBody">
                <tr class="personnel-row" id="row-as-2026-014" data-id="as-2026-014" data-case="cm-2026-0248" data-student="dela cruz, angelo m." data-role="Guidance Counselor" data-status="Active">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">AS-2026-014</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Angelo M.</td>
                    <td><span class="badge-role">Guidance Counselor</span></td>
                    <td class="text-muted truncate-cell">G. Panganiban</td>
                    <td class="text-center text-muted text-nowrap">Oct 08, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">Active</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialPersonnelModal('AS-2026-014', 'CM-2026-0248', 'Dela Cruz, Angelo M.', 'Guidance Counselor', 'G. Panganiban', 'Oct 08, 2026', 'Active', 'Conducting weekly academic counseling and attendance tracking.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="personnel-row" id="row-as-2026-013" data-id="as-2026-013" data-case="cm-2026-0246" data-student="villanueva, kim d." data-role="Case Worker" data-status="Active">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">AS-2026-013</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0246</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                    <td><span class="badge-role">Case Worker</span></td>
                    <td class="text-muted truncate-cell">J. Marasigan</td>
                    <td class="text-center text-muted text-nowrap">Oct 07, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-active">Active</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialPersonnelModal('AS-2026-013', 'CM-2026-0246', 'Villanueva, Kim D.', 'Case Worker', 'J. Marasigan', 'Oct 07, 2026', 'Active', 'Coordinating financial emergency assistance and meal coupon distribution.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="personnel-row" id="row-as-2026-012" data-id="as-2026-012" data-case="cm-2026-0247" data-student="reyes, maricel s." data-role="Support Staff" data-status="Completed">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">AS-2026-012</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0247</td>
                    <td class="fw-semibold text-dark truncate-cell">Reyes, Maricel S.</td>
                    <td><span class="badge-role">Support Staff</span></td>
                    <td class="text-muted truncate-cell">E. Rodelas</td>
                    <td class="text-center text-muted text-nowrap">Oct 03, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialPersonnelModal('AS-2026-012', 'CM-2026-0247', 'Reyes, Maricel S.', 'Support Staff', 'E. Rodelas', 'Oct 03, 2026', 'Completed', 'Document collection and clearance processing finalized.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noPersonnelRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No assigned personnel records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 3 of 3 personnel assignments</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Assignment Protocol Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-person-check-fill marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">MarSU OSAS Assignment & Confidentiality Protocol</h6>
                <p class="text-muted small mb-0">
                    Confirm staff availability, authorization level, assigned case parameters, and scheduled review dates. Access to confidential student information must remain restricted to authorized MarSU OSAS personnel and case handlers in compliance with Republic Act 10173 (Data Privacy Act of 2012).
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (PERSONNEL ASSIGNMENT FOCUS)     -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialPersonnelModal" tabindex="-1" aria-labelledby="essentialPersonnelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">STAFF ASSIGNMENT DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vAssignId">AS-2026-014</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeAssignId" value="">

                <!-- 1. Student Beneficiary Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student / Case No.</span>
                        <span class="status-badge-active" id="vStatusBadge">Active</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Dela Cruz, Angelo M.</h5>
                    <div class="small text-muted fw-semibold" id="vCaseNo">Case No: CM-2026-0248</div>
                </div>

                <!-- 2. Staff Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Assigned Role</div>
                            <div class="essential-value marsu-maroon-text" id="vRole">Guidance Counselor</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Assigned Date</div>
                            <div class="essential-value text-dark" id="vAssignDate">Oct 08, 2026</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Assigned Personnel</div>
                            <div class="essential-value text-dark" id="vPersonnelName">G. Panganiban</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Assignment Workflow Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="pst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Assigned</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="pst2">2</div>
                            <span class="compact-step-label text-dark fw-bold">Active Case</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="pst3">3</div>
                            <span class="compact-step-label">Completed</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Notes & Responsibilities -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Responsibilities / Case Notes</div>
                    <div class="small text-dark fw-semibold" id="vNotesText">Conducting weekly academic counseling and attendance tracking.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Assignment Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Active">Active</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialPersonnelStatus()">Save Status</button>
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
<!-- MODAL 2: ASSIGN NEW PERSONNEL ENTRY                                   -->
<!-- ===================================================================== -->
<div class="modal fade" id="newPersonnelModal" tabindex="-1" aria-labelledby="newPersonnelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newPersonnelModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Assign Personnel to Case
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newPersonnelForm" onsubmit="saveNewPersonnelAssignment(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assignment ID</label>
                            <input type="text" class="form-control form-control-sm" id="newAssignId" placeholder="e.g. AS-2026-015" required>
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

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Role</label>
                            <select class="form-select form-select-sm" id="newRole" required>
                                <option value="Guidance Counselor">Guidance Counselor</option>
                                <option value="Case Worker">Case Worker</option>
                                <option value="Faculty Adviser">Faculty Adviser</option>
                                <option value="Support Staff">Support Staff</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Staff Personnel</label>
                            <input type="text" class="form-control form-control-sm" id="newPersonnelName" placeholder="e.g. G. Panganiban" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Date</label>
                            <input type="date" class="form-control form-control-sm" id="newAssignDate" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assignment Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Active">Active</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Responsibilities / Case Notes</label>
                        <textarea class="form-control form-control-sm" id="newNotes" rows="3" placeholder="Brief details regarding staff tasks and expectations..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Assignment</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyPersonnelFilters() {
        const searchInput = document.getElementById('personnelSearch').value.toLowerCase().trim();
        const roleFilter = document.getElementById('personnelRoleFilter').value;
        const statusFilter = document.getElementById('personnelStatusFilter').value;

        const rows = document.querySelectorAll('.personnel-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const caseNo = row.getAttribute('data-case');
            const student = row.getAttribute('data-student');
            const role = row.getAttribute('data-role');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || caseNo.includes(searchInput) || student.includes(searchInput);
            const matchesRole = !roleFilter || role.toLowerCase() === roleFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesRole && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noPersonnelRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} personnel assignments`;
        }
    }

    function openEssentialPersonnelModal(assignId, caseNo, student, role, personnel, date, status, notes) {
        document.getElementById('activeAssignId').value = assignId.toLowerCase();
        document.getElementById('vAssignId').innerText = assignId;
        document.getElementById('vCaseNo').innerText = 'Case No: ' + caseNo;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vRole').innerText = role;
        document.getElementById('vPersonnelName').innerText = personnel;
        document.getElementById('vAssignDate').innerText = date;
        document.getElementById('vNotesText').innerText = notes || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        badgeElem.className = (status.toLowerCase() === 'active') ? 'status-badge-active' : 'status-badge-completed';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('pst1');
        const st2 = document.getElementById('pst2');
        const st3 = document.getElementById('pst3');

        st1.className = 'compact-step-circle completed';

        if (status.toLowerCase() === 'completed') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st3.innerHTML = '<i class="bi bi-check"></i>';
        } else {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialPersonnelModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Assignment Details: ' + assignId);
        }
    }

    function saveEssentialPersonnelStatus() {
        const activeAssignId = document.getElementById('activeAssignId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeAssignId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            const newBadgeClass = (newStatus.toLowerCase() === 'active') ? 'status-badge-active' : 'status-badge-completed';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const caseText = targetRow.cells[1].innerText;
                const studentText = targetRow.cells[2].innerText;
                const roleText = targetRow.cells[3].innerText.trim();
                const personnelText = targetRow.cells[4].innerText;
                const dateText = targetRow.cells[5].innerText;
                const notesText = document.getElementById('vNotesText').innerText;

                viewBtn.setAttribute('onclick', `openEssentialPersonnelModal('${idText}', '${caseText}', '${studentText}', '${roleText}', '${personnelText}', '${dateText}', '${newStatus}', '${notesText}')`);
            }
        }

        const modalElem = document.getElementById('essentialPersonnelModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        applyPersonnelFilters();
        alert('Personnel assignment status successfully updated!');
    }

    function openNewPersonnelModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newPersonnelModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Assign Personnel Form');
        }
    }

    function saveNewPersonnelAssignment(e) {
        e.preventDefault();

        const assignId = document.getElementById('newAssignId').value.trim();
        const caseNo = document.getElementById('newCaseNo').value.trim();
        const student = document.getElementById('newStudentName').value.trim();
        const role = document.getElementById('newRole').value;
        const personnel = document.getElementById('newPersonnelName').value.trim();
        const rawDate = document.getElementById('newAssignDate').value;
        const status = document.getElementById('newStatus').value;
        const notes = document.getElementById('newNotes').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        const badgeClass = (status.toLowerCase() === 'active') ? 'status-badge-active' : 'status-badge-completed';

        const rowId = 'row-' + assignId.toLowerCase();
        const tbody = document.getElementById('personnelTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'personnel-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', assignId.toLowerCase());
        newTr.setAttribute('data-case', caseNo.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-role', role);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${assignId}</td>
            <td class="fw-semibold text-dark text-nowrap">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="badge-role">${role}</span></td>
            <td class="text-muted truncate-cell">${personnel}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialPersonnelModal('${assignId}', '${caseNo}', '${student}', '${role}', '${personnel}', '${formattedDate}', '${status}', '${notes}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newPersonnelModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newPersonnelForm').reset();

        applyPersonnelFilters();
    }
</script>