<!-- Student Complaints Management -->
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

        /* Office Badges */
        .badge-office {
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
        .status-badge-open {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-block !important;
        }

        .status-badge-ongoing {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffc107 !important;
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

        .status-badge-closed {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
            display: inline-block !important;
        }

        .status-badge-urgent {
            font-size: 0.825rem !important;
            font-weight: 700 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
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

        /* Manage Complaint Button With Arrow Icon */
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
            <span class="small fw-bold marsu-maroon-text">STUDENT COMPLAINTS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-3">
        <h4 class="fw-bold marsu-maroon-text mb-1">Student Complaints Log</h4>
        <p class="text-muted small mb-0">Record and monitor formal concerns and complaints raised by students regarding institutional policies, services, or personnel.</p>
    </div>

    <!-- Filter and Search Toolbar (Single Row Aligned) -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Pill Search Input -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="searchComplaints" class="search-pill-input" placeholder="Search complainant or CP no..." oninput="applyComplaintFilters()" autocomplete="off">
            </div>

            <!-- 2. Office Concerned Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Office Concerned:</label>
                <select class="form-select form-select-sm filter-select" id="officeFilter" onchange="applyComplaintFilters()">
                    <option value="">All Offices</option>
                    <option value="College Faculty">College Faculty</option>
                    <option value="Student Housing">Student Housing</option>
                    <option value="Registrar's Office">Registrar's Office</option>
                    <option value="Canteen Services">Canteen Services</option>
                    <option value="Guidance Office">Guidance Office</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="statusFilter" onchange="applyComplaintFilters()">
                    <option value="">All Statuses</option>
                    <option value="Open">Open</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                    <option value="Urgent">Urgent</option>
                </select>
            </div>

            <!-- 4. File Complaint Button -->
            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="openFileComplaintModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> File Complaint
            </button>

        </div>
    </div>

    <!-- Student Complaints Table (Uncompressed with Arrow Action Column) -->
    <div class="table-responsive-custom bg-white shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="tblComplaints">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 13%;">Complaint No.</th>
                    <th class="py-3" style="width: 18%;">Complainant</th>
                    <th class="py-3" style="width: 22%;">Nature of Complaint</th>
                    <th class="py-3" style="width: 17%;">Office Concerned</th>
                    <th class="py-3" style="width: 11%;">Date Filed</th>
                    <th class="py-3 text-center" style="width: 10%;">Status</th>
                    <th class="py-3 text-center pe-4" style="width: 12%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="tblComplaintsBody">
                <tr class="complaint-row" data-id="cp-0091" data-name="fernandez, joy l." data-office="College Faculty" data-status="Open">
                    <td class="ps-4 fw-semibold text-secondary">CP-0091</td>
                    <td class="fw-semibold text-dark truncate-cell">Fernandez, Joy L.</td>
                    <td class="text-muted truncate-cell">Alleged unfair grading practice</td>
                    <td>
                        <span class="badge-office">College Faculty</span>
                    </td>
                    <td class="text-muted">Sep 11, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-open">Open</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageComplaintModal('CP-0091', 'Fernandez, Joy L.', 'Alleged unfair grading practice', 'College Faculty', 'Sep 11, 2026', 'Open')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="complaint-row" data-id="cp-0090" data-name="aquino, ronald p." data-office="Student Housing" data-status="Ongoing">
                    <td class="ps-4 fw-semibold text-secondary">CP-0090</td>
                    <td class="fw-semibold text-dark truncate-cell">Aquino, Ronald P.</td>
                    <td class="text-muted truncate-cell">Dormitory curfew dispute</td>
                    <td>
                        <span class="badge-office">Student Housing</span>
                    </td>
                    <td class="text-muted">Sep 06, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-ongoing">Ongoing</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageComplaintModal('CP-0090', 'Aquino, Ronald P.', 'Dormitory curfew dispute', 'Student Housing', 'Sep 06, 2026', 'Ongoing')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="complaint-row" data-id="cp-0089" data-name="mendoza, grace a." data-office="Registrar's Office" data-status="Resolved">
                    <td class="ps-4 fw-semibold text-secondary">CP-0089</td>
                    <td class="fw-semibold text-dark truncate-cell">Mendoza, Grace A.</td>
                    <td class="text-muted truncate-cell">Delayed release of TOR</td>
                    <td>
                        <span class="badge-office">Registrar's Office</span>
                    </td>
                    <td class="text-muted">Aug 30, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-resolved">Resolved</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageComplaintModal('CP-0089', 'Mendoza, Grace A.', 'Delayed release of TOR', 'Registrar\'s Office', 'Aug 30, 2026', 'Resolved')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="complaint-row" data-id="cp-0088" data-name="cruz, nathaniel v." data-office="Canteen Services" data-status="Closed">
                    <td class="ps-4 fw-semibold text-secondary">CP-0088</td>
                    <td class="fw-semibold text-dark truncate-cell">Cruz, Nathaniel V.</td>
                    <td class="text-muted truncate-cell">Canteen food safety concern</td>
                    <td>
                        <span class="badge-office">Canteen Services</span>
                    </td>
                    <td class="text-muted">Aug 24, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-closed">Closed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageComplaintModal('CP-0088', 'Cruz, Nathaniel V.', 'Canteen food safety concern', 'Canteen Services', 'Aug 24, 2026', 'Closed')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="complaint-row" data-id="cp-0087" data-name="lim, andrea f." data-office="Guidance Office" data-status="Urgent">
                    <td class="ps-4 fw-semibold text-secondary">CP-0087</td>
                    <td class="fw-semibold text-dark truncate-cell">Lim, Andrea F.</td>
                    <td class="text-muted truncate-cell">Peer harassment complaint</td>
                    <td>
                        <span class="badge-office">Guidance Office</span>
                    </td>
                    <td class="text-muted">Aug 19, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-urgent">Urgent</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-manage-status" onclick="openManageComplaintModal('CP-0087', 'Lim, Andrea F.', 'Peer harassment complaint', 'Guidance Office', 'Aug 19, 2026', 'Urgent')">
                            Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noComplaintRecordsRow" style="display: none;">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No complaint records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Footer / Pagination Metadata -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 5 of 21 complaints</span>
        <span>Page 1 of 5</span>
    </div>

    <!-- Confidentiality & Escalation Notice Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-exclamation-triangle-fill marsu-maroon-text fs-4 flex-shrink-0"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Grievance Handling Protocol</h6>
                <p class="text-muted small mb-0">
                    All formal complaints must be handled in strict confidentiality. Ensure proceedings follow university due process, objective fact-finding, and prompt resolution. Escalate urgent or sensitive safety concerns immediately to OSAS administration.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: MANAGE COMPLAINT STATUS (IMPORTANT INFO ONLY)                -->
<!-- ===================================================================== -->
<div class="modal fade" id="manageComplaintModal" tabindex="-1" aria-labelledby="manageComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="manageComplaintModalLabel">
                    <i class="bi bi-sliders me-1"></i> Manage Complaint Status
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                
                <!-- Complainant & Case Summary Card -->
                <div class="card border rounded-3 p-3 mb-3 bg-light-subtle">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block" id="modalComplaintNo">CP-0091</span>
                            <h5 class="fw-bold text-dark mb-0" id="modalComplainantName">Fernandez, Joy L.</h5>
                        </div>
                        <span class="status-badge-open" id="modalStatusBadge">Open</span>
                    </div>

                    <div class="row g-2 text-muted small mt-1">
                        <div class="col-12 col-md-6">
                            <i class="bi bi-building me-1"></i> <span id="modalOfficeConcerned">College Faculty</span>
                        </div>
                        <div class="col-12 col-md-6">
                            <i class="bi bi-calendar3 me-1"></i> <span id="modalDateFiled">Sep 11, 2026</span>
                        </div>
                    </div>
                </div>

                <!-- Nature of Complaint -->
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Nature / Details of Complaint</label>
                    <div class="p-3 border rounded bg-white text-dark fw-semibold" id="modalNatureText">
                        Alleged unfair grading practice
                    </div>
                </div>

                <!-- Update Status Controls -->
                <div class="border-top pt-3">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square me-1"></i> Update Complaint Status</h6>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Update Status</label>
                            <select class="form-select form-select-sm" id="modalStatusSelect">
                                <option value="Open">Open</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Closed">Closed</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Action Taken / Remarks</label>
                            <textarea class="form-control form-control-sm" id="modalRemarksText" rows="3" placeholder="Enter OSAS investigation notes, hearing schedule, or resolution summary..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-maroon-primary" onclick="saveComplaintStatus()">Save Status Changes</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL 2: FILE NEW COMPLAINT                                           -->
<!-- ===================================================================== -->
<div class="modal fade" id="fileComplaintModal" tabindex="-1" aria-labelledby="fileComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="fileComplaintModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> File Student Complaint
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="fileComplaintForm" onsubmit="saveNewComplaint(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Complaint Number</label>
                        <input type="text" class="form-control form-control-sm" id="newComplaintNo" placeholder="e.g. CP-0092" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Complainant Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newComplainantName" placeholder="e.g. Dela Cruz, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Date Filed</label>
                            <input type="date" class="form-control form-control-sm" id="newDateFiled" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Office Concerned</label>
                            <select class="form-select form-select-sm" id="newOfficeConcerned" required>
                                <option value="College Faculty">College Faculty</option>
                                <option value="Student Housing">Student Housing</option>
                                <option value="Registrar's Office">Registrar's Office</option>
                                <option value="Canteen Services">Canteen Services</option>
                                <option value="Guidance Office">Guidance Office</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Nature of Complaint</label>
                        <textarea class="form-control form-control-sm" id="newNature" rows="2" placeholder="Brief explanation of the grievance..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Initial Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Open">Open</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Submit Complaint</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyComplaintFilters() {
        const searchInput = document.getElementById('searchComplaints').value.toLowerCase().trim();
        const officeFilter = document.getElementById('officeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('.complaint-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const office = row.getAttribute('data-office');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || name.includes(searchInput);
            const matchesOffice = !officeFilter || office.toLowerCase() === officeFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesOffice && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noComplaintRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} complaints`;
        }
    }

    function openManageComplaintModal(cpNo, complainant, nature, office, dateFiled, status) {
        document.getElementById('modalComplaintNo').innerText = cpNo;
        document.getElementById('modalComplainantName').innerText = complainant;
        document.getElementById('modalNatureText').innerText = nature;
        document.getElementById('modalOfficeConcerned').innerText = office;
        document.getElementById('modalDateFiled').innerText = dateFiled;

        const statusSelect = document.getElementById('modalStatusSelect');
        if (statusSelect) statusSelect.value = status;

        const badgeElem = document.getElementById('modalStatusBadge');
        badgeElem.innerText = status;
        
        // Status badge dynamic class
        badgeElem.className = '';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'open') badgeElem.className = 'status-badge-open';
        else if (lowerStatus === 'ongoing') badgeElem.className = 'status-badge-ongoing';
        else if (lowerStatus === 'resolved') badgeElem.className = 'status-badge-resolved';
        else if (lowerStatus === 'closed') badgeElem.className = 'status-badge-closed';
        else if (lowerStatus === 'urgent') badgeElem.className = 'status-badge-urgent';

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('manageComplaintModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Manage Complaint: ' + cpNo);
        }
    }

    function saveComplaintStatus() {
        alert('Complaint status updated successfully!');
        const modalElem = document.getElementById('manageComplaintModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }
    }

    function openFileComplaintModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('fileComplaintModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('File Complaint Form');
        }
    }

    function saveNewComplaint(e) {
        e.preventDefault();

        const cpNo = document.getElementById('newComplaintNo').value.trim();
        const complainant = document.getElementById('newComplainantName').value.trim();
        const rawDate = document.getElementById('newDateFiled').value;
        const office = document.getElementById('newOfficeConcerned').value;
        const nature = document.getElementById('newNature').value.trim();
        const status = document.getElementById('newStatus').value;

        // Date formatting
        const dateObj = new Date(rawDate);
        const formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });

        // Badge class determination
        let badgeClass = 'status-badge-open';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'ongoing') badgeClass = 'status-badge-ongoing';
        else if (lowerStatus === 'urgent') badgeClass = 'status-badge-urgent';

        const tbody = document.getElementById('tblComplaintsBody');
        const newTr = document.createElement('tr');
        newTr.className = 'complaint-row';
        newTr.setAttribute('data-id', cpNo.toLowerCase());
        newTr.setAttribute('data-name', complainant.toLowerCase());
        newTr.setAttribute('data-office', office);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-4 fw-semibold text-secondary">${cpNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${complainant}</td>
            <td class="text-muted truncate-cell">${nature}</td>
            <td><span class="badge-office">${office}</span></td>
            <td class="text-muted">${formattedDate}</td>
            <td class="text-center"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-4">
                <button type="button" class="btn btn-manage-status" onclick="openManageComplaintModal('${cpNo}', '${complainant}', '${nature}', '${office}', '${formattedDate}', '${status}')">
                    Manage <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        // Hide Modal & Reset Form
        const modalElem = document.getElementById('fileComplaintModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('fileComplaintForm').reset();

        applyComplaintFilters();
    }
</script>