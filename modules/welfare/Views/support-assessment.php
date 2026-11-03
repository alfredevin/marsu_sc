<!-- Support Assessment Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Uncompressed Table with Continuous Bottom Lines & Smooth Scroll */
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
            max-width: 180px;
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

        /* Priority Badges */
        .priority-badge-high {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-block !important;
        }

        .priority-badge-medium {
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            display: inline-block !important;
        }

        /* Primary Action Buttons */
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

        /* Manage Status Button With Arrow Icon */
        .btn-manage-status {
            color: #58111a !important;
            border: 1.5px solid #58111a !important;
            background-color: #ffffff !important;
            font-weight: 600;
            padding: 5px 14px;
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

        /* Clean Stepper Styling for Modal */
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

    <!-- Breadcrumb Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-house me-1 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">SUPPORT ASSESSMENT</span>
        </div>
    </div>

    <!-- Page Header Title -->
    <div class="mb-3">
        <h4 class="fw-bold marsu-maroon-text mb-1">Support Assessment</h4>
        <p class="text-muted small mb-0">Document identified needs, urgency levels, and recommended student support services.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- Search Input -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="assessmentSearch" class="search-pill-input" placeholder="Search student, need..." oninput="applyAssessmentFilters()" autocomplete="off">
            </div>

            <!-- Priority Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Priority:</label>
                <select class="form-select form-select-sm filter-select" id="priorityFilter" onchange="applyAssessmentFilters()">
                    <option value="">All Priorities</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>

            <!-- Assessment Status Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Assessment Status:</label>
                <select class="form-select form-select-sm filter-select" id="statusFilter" onchange="applyAssessmentFilters()">
                    <option value="">All Statuses</option>
                    <option value="For referral">For referral</option>
                    <option value="In progress">In progress</option>
                    <option value="Under review">Under review</option>
                </select>
            </div>

            <!-- New Assessment Button -->
            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="alert('New Assessment form can be connected to backend.')">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> New Assessment
            </button>

        </div>
    </div>

    <!-- Support Assessment Table -->
    <div class="table-responsive-custom bg-white shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="assessmentTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 15%;">Assessment ID</th>
                    <th class="py-3" style="width: 20%;">Student Name</th>
                    <th class="py-3" style="width: 18%;">Support Need</th>
                    <th class="py-3 text-center" style="width: 11%;">Priority</th>
                    <th class="py-3" style="width: 20%;">Recommended Action</th>
                    <th class="py-3" style="width: 12%;">Assessment Date</th>
                    <th class="py-3 text-center pe-4" style="width: 14%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="assessmentTableBody">
                <tr class="assessment-row" data-id="sa-2026-001" data-name="adamos, mariedhen l." data-priority="High" data-status="For referral">
                    <td class="ps-4 fw-semibold text-secondary">SA-2026-001</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td class="text-muted truncate-cell">Financial assistance</td>
                    <td class="text-center">
                        <span class="priority-badge-high">High</span>
                    </td>
                    <td class="text-muted truncate-cell">Refer to financial aid office</td>
                    <td class="text-muted">Oct 06, 2026</td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageStatusModal('SA-2026-001', 'Adamos, Mariedhen L.', 'High Priority', 'Financial Assistance', 'Refer to financial aid office', 'College of Information and Communications Technology', 'BS Information Systems', '3rd Year', 'For referral')">
                            Manage Status <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="assessment-row" data-id="sa-2026-002" data-name="ali, kyla diane m." data-priority="Medium" data-status="In progress">
                    <td class="ps-4 fw-semibold text-secondary">SA-2026-002</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td class="text-muted truncate-cell">Academic adjustment</td>
                    <td class="text-center">
                        <span class="priority-badge-medium">Medium</span>
                    </td>
                    <td class="text-muted truncate-cell">Schedule guidance consultation</td>
                    <td class="text-muted">Oct 08, 2026</td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageStatusModal('SA-2026-002', 'Ali, Kyla Diane M.', 'Medium Priority', 'Academic Burnout', 'Schedule guidance consultation', 'College of Education', 'BEED', '2nd Year', 'In progress')">
                            Manage Status <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="assessment-row" data-id="case-2026-0003" data-name="almonte, jake louis p." data-priority="High" data-status="In progress">
                    <td class="ps-4 fw-semibold text-secondary">CASE-2026-0003</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Jake Louis P.</td>
                    <td class="text-muted truncate-cell">Severe Academic Burnout</td>
                    <td class="text-center">
                        <span class="priority-badge-high">High</span>
                    </td>
                    <td class="text-muted truncate-cell">Immediate crisis stabilization</td>
                    <td class="text-muted">Sep 19, 2026</td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageStatusModal('CASE-2026-0003', 'Jake Louis P. Almonte', 'Urgent Priority', 'Severe Academic Burnout', 'Immediate crisis stabilization and guardian notification', 'College of Information and Communications Technology', 'BS Information Systems', '1st Year', 'In progress')">
                            Manage Status <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noAssessmentRecordsRow" style="display: none;">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No assessment records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL: MANAGE STATUS (SIMPLIFIED & IMPORTANT INFO ONLY)               -->
<!-- ===================================================================== -->
<div class="modal fade" id="manageStatusModal" tabindex="-1" aria-labelledby="manageStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="manageStatusModalLabel">
                    <i class="bi bi-sliders me-1"></i> Manage Case Status & Assessment
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body (Mahahalagang Impormasyon Lamang) -->
            <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                
                <!-- 1. Student Context Card -->
                <div class="card border rounded-3 p-3 mb-3 bg-light-subtle">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block" id="modalStudentId">CASE-2026-0003</span>
                            <h5 class="fw-bold text-dark mb-0" id="modalStudentName">Jake Louis P. Almonte</h5>
                        </div>
                        <span class="badge bg-danger text-white fw-bold px-2.5 py-1.5" id="modalPriorityBadge">High Priority</span>
                    </div>

                    <div class="row g-2 text-muted small mt-1">
                        <div class="col-12 col-md-6">
                            <i class="bi bi-building me-1"></i> <span id="modalCollege">College of Information and Communications Technology</span>
                        </div>
                        <div class="col-12 col-md-6">
                            <i class="bi bi-book me-1"></i> <span id="modalProgramYear">BS Information Systems • 1st Year</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Support Need & Recommended Action -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="p-3 border rounded bg-white h-100">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Identified Support Need</label>
                            <span class="fw-bold text-dark fs-6" id="modalSupportNeed">Severe Academic Burnout</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-3 border rounded bg-white h-100">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Recommended Action</label>
                            <span class="fw-semibold text-secondary" id="modalRecAction">Immediate crisis stabilization and guardian notification</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stepper -->
                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Assessment Stage Tracker</label>
                <div class="stepper-wrapper mb-4 px-1">
                    <div class="stepper-item completed">
                        <div class="stepper-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="stepper-title">1. Intake</div>
                    </div>
                    <div class="stepper-item completed">
                        <div class="stepper-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="stepper-title">2. Assessment</div>
                    </div>
                    <div class="stepper-item active">
                        <div class="stepper-circle">3</div>
                        <div class="stepper-title">3. Action / Referral</div>
                    </div>
                    <div class="stepper-item">
                        <div class="stepper-circle">4</div>
                        <div class="stepper-title">4. Monitoring</div>
                    </div>
                    <div class="stepper-item">
                        <div class="stepper-circle">5</div>
                        <div class="stepper-title">5. Resolved</div>
                    </div>
                </div>

                <!-- 4. Update Status Form -->
                <div class="border-top pt-3">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square me-1"></i> Update Assessment Status</h6>
                    
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted small">Current Assessment Status</label>
                            <select class="form-select form-select-sm" id="modalStatusSelect">
                                <option value="For referral">For referral</option>
                                <option value="In progress">In progress</option>
                                <option value="Under review">Under review</option>
                                <option value="Completed / Resolved">Completed / Resolved</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted small">Assigned Officer / Counselor</label>
                            <input type="text" class="form-control form-control-sm" value="Guidance Counselor" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Counselor Remarks / Action Notes</label>
                            <textarea class="form-control form-control-sm" rows="2" placeholder="Add brief notes regarding the current progress or referral..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-maroon-primary" onclick="saveStatusUpdate()">Save Changes</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyAssessmentFilters() {
        const searchInput = document.getElementById('assessmentSearch').value.toLowerCase().trim();
        const priorityFilter = document.getElementById('priorityFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('.assessment-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const priority = row.getAttribute('data-priority');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || name.includes(searchInput);
            const matchesPriority = !priorityFilter || priority.toLowerCase() === priorityFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesPriority && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noAssessmentRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    function openManageStatusModal(id, name, priority, need, action, college, program, year, status) {
        document.getElementById('modalStudentId').innerText = id;
        document.getElementById('modalStudentName').innerText = name;
        document.getElementById('modalPriorityBadge').innerText = priority;
        document.getElementById('modalSupportNeed').innerText = need;
        document.getElementById('modalRecAction').innerText = action;
        document.getElementById('modalCollege').innerText = college;
        document.getElementById('modalProgramYear').innerText = program + ' • ' + year;
        
        // Set dropdown value
        const statusSelect = document.getElementById('modalStatusSelect');
        if (statusSelect) {
            statusSelect.value = status;
        }

        // Open Modal
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('manageStatusModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Manage Status for: ' + name);
        }
    }

    function saveStatusUpdate() {
        alert('Assessment status successfully updated!');
        const modalElem = document.getElementById('manageStatusModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }
    }
</script>