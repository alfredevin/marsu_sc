<!-- Welfare History Records Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Uncompressed Responsive Table Container with Continuous Borders */
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
            min-width: 140px;
            max-width: 165px;
            font-size: 0.85rem !important;
            padding: 5px 8px !important;
            border-radius: 6px !important;
        }

        /* Record Type Badges */
        .badge-record-type {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8f9fa !important;
            color: #495057 !important;
            border: 1px solid #dcdcdc !important;
            display: inline-block !important;
        }

        /* Follow-up Status Badges */
        .status-badge-pending {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 14px !important;
            border-radius: 50rem !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-block !important;
        }

        .status-badge-scheduled {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 14px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-block !important;
        }

        .status-badge-progress {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 14px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            display: inline-block !important;
        }

        .status-badge-completed {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 14px !important;
            border-radius: 50rem !important;
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
            border: 1px solid #badbcc !important;
            display: inline-block !important;
        }

        /* Primary Action Button */
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

        /* View Details Button with Arrow */
        .btn-view-details {
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

        .btn-view-details:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        .btn-view-details:hover .bi-arrow-right-short {
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
            <span class="small fw-bold marsu-maroon-text">WELFARE HISTORY RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-3">
        <h4 class="fw-bold marsu-maroon-text mb-1">Welfare History Records</h4>
        <p class="text-muted small mb-0">View a chronological record of student concerns, referrals, support actions, and follow-up outcomes.</p>
    </div>

    <!-- Filter and Search Toolbar (Single Row Aligned) -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Pill Search Input -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="historySearch" class="search-pill-input" placeholder="Search student or record..." oninput="applyHistoryFilters()" autocomplete="off">
            </div>

            <!-- 2. Record Type Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Record Type:</label>
                <select class="form-select form-select-sm filter-select text-center" id="recordTypeFilter" onchange="applyHistoryFilters()">
                    <option value="">All Types</option>
                    <option value="Support assessment">Support assessment</option>
                    <option value="Guidance consultation">Guidance consultation</option>
                    <option value="Student referral">Student referral</option>
                </select>
            </div>

            <!-- 3. Follow-Up Status Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select text-center" id="statusFilter" onchange="applyHistoryFilters()">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="In progress">In progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <!-- 4. Add History Entry Button -->
            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="openAddHistoryModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add History Entry
            </button>

        </div>
    </div>

    <!-- Welfare History Table -->
    <div class="table-responsive-custom bg-white shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="historyTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 12%;">Record ID</th>
                    <th class="py-3" style="width: 10%;">Date</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 16%;">Record Type</th>
                    <th class="py-3" style="width: 20%;">Summary</th>
                    <th class="py-3 text-center" style="width: 12%;">Follow-Up Status</th>
                    <th class="py-3 text-center pe-4" style="width: 12%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="historyTableBody">
                <tr class="history-row" data-id="wh-2026-014" data-name="adamos, mariedhen l." data-type="Support assessment" data-status="Pending">
                    <td class="ps-4 fw-semibold text-secondary">WH-2026-014</td>
                    <td class="text-muted">Oct 10, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td>
                        <span class="badge-record-type">Support assessment</span>
                    </td>
                    <td class="text-muted truncate-cell">Financial support need identified</td>
                    <td class="text-center">
                        <span class="status-badge-pending">Pending</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-details" onclick="viewHistoryDetails('WH-2026-014', 'Adamos, Mariedhen L.', 'Oct 10, 2026', 'Support assessment', 'Financial support need identified', 'Referral for assistance review', 'Pending')">
                            Details <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="history-row" data-id="wh-2026-013" data-name="ali, kyla diane m." data-type="Guidance consultation" data-status="Scheduled">
                    <td class="ps-4 fw-semibold text-secondary">WH-2026-013</td>
                    <td class="text-muted">Oct 08, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td>
                        <span class="badge-record-type">Guidance consultation</span>
                    </td>
                    <td class="text-muted truncate-cell">Requested academic adjustment support</td>
                    <td class="text-center">
                        <span class="status-badge-scheduled">Scheduled</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-details" onclick="viewHistoryDetails('WH-2026-013', 'Ali, Kyla Diane M.', 'Oct 08, 2026', 'Guidance consultation', 'Requested academic adjustment support', 'Consultation scheduled', 'Scheduled')">
                            Details <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="history-row" data-id="wh-2026-012" data-name="almonte, hanz andrei r." data-type="Student referral" data-status="In progress">
                    <td class="ps-4 fw-semibold text-secondary">WH-2026-012</td>
                    <td class="text-muted">Oct 02, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td>
                        <span class="badge-record-type">Student referral</span>
                    </td>
                    <td class="text-muted truncate-cell">Transportation assistance inquiry</td>
                    <td class="text-center">
                        <span class="status-badge-progress">In progress</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-details" onclick="viewHistoryDetails('WH-2026-012', 'Almonte, Hanz Andrei R.', 'Oct 02, 2026', 'Student referral', 'Transportation assistance inquiry', 'Program eligibility to be checked', 'In progress')">
                            Details <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>
                <tr class="history-row" data-id="wh-2026-011" data-name="bautista, maria c." data-type="Guidance consultation" data-status="Completed">
                    <td class="ps-4 fw-semibold text-secondary">WH-2026-011</td>
                    <td class="text-muted">Sep 28, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Bautista, Maria C.</td>
                    <td>
                        <span class="badge-record-type">Guidance consultation</span>
                    </td>
                    <td class="text-muted truncate-cell">Completed academic counseling session</td>
                    <td class="text-center">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-center pe-4">
                        <button type="button" class="btn btn-view-details" onclick="viewHistoryDetails('WH-2026-011', 'Bautista, Maria C.', 'Sep 28, 2026', 'Guidance consultation', 'Completed academic counseling session', 'Resolved / Follow-up closed', 'Completed')">
                            Details <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noHistoryRecordsRow" style="display: none;">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No welfare history records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Record Handling & Compliance Notice Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-clock-history marsu-maroon-text fs-4 flex-shrink-0"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Record Handling Guidelines</h6>
                <p class="text-muted small mb-0">
                    Each entry should include date, concern or service type, brief factual summary, responsible personnel, referral/intervention, next follow-up date, and outcome. Avoid unnecessary sensitive details and maintain role-based access and confidentiality.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL: WELFARE RECORD DETAILS                                         -->
<!-- ===================================================================== -->
<div class="modal fade" id="historyDetailModal" tabindex="-1" aria-labelledby="historyDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="historyDetailModalLabel">
                    <i class="bi bi-clock-history me-1"></i> Welfare Record Details
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                
                <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-3">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase d-block" id="modalRecordId">WH-2026-014</span>
                        <h5 class="fw-bold text-dark mb-0" id="modalStudentName">Adamos, Mariedhen L.</h5>
                    </div>
                    <span class="badge bg-light text-dark border" id="modalDate">Oct 10, 2026</span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Record Type</label>
                    <span class="badge-record-type" id="modalRecordType">Support assessment</span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Summary of Concern / Support</label>
                    <div class="bg-light p-2.5 rounded border text-dark" id="modalSummary">
                        Financial support need identified
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Action / Intervention Taken</label>
                    <div class="bg-light p-2.5 rounded border text-dark" id="modalAction">
                        Referral for assistance review
                    </div>
                </div>

                <div>
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Follow-Up Status</label>
                    <span class="status-badge-pending" id="modalStatus">Pending</span>
                </div>

            </div>

            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL: ADD HISTORY ENTRY                                              -->
<!-- ===================================================================== -->
<div class="modal fade" id="addHistoryModal" tabindex="-1" aria-labelledby="addHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addHistoryModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Add Welfare History Entry
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addHistoryForm" onsubmit="saveHistoryEntry(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Record ID</label>
                        <input type="text" class="form-control form-control-sm" id="newRecordId" placeholder="e.g. WH-2026-015" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Santos, Juan P." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Date</label>
                            <input type="date" class="form-control form-control-sm" id="newRecordDate" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Record Type</label>
                            <select class="form-select form-select-sm" id="newRecordType" required>
                                <option value="Support assessment">Support assessment</option>
                                <option value="Guidance consultation">Guidance consultation</option>
                                <option value="Student referral">Student referral</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Summary</label>
                        <input type="text" class="form-control form-control-sm" id="newSummary" placeholder="Brief summary of concern..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Follow-Up Status</label>
                        <select class="form-select form-select-sm" id="newStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="In progress">In progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Entry</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyHistoryFilters() {
        const searchInput = document.getElementById('historySearch').value.toLowerCase().trim();
        const recordTypeFilter = document.getElementById('recordTypeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('.history-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const type = row.getAttribute('data-type');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || name.includes(searchInput);
            const matchesType = !recordTypeFilter || type.toLowerCase() === recordTypeFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesType && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noHistoryRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    function viewHistoryDetails(id, name, date, type, summary, action, status) {
        document.getElementById('modalRecordId').innerText = id;
        document.getElementById('modalStudentName').innerText = name;
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modalRecordType').innerText = type;
        document.getElementById('modalSummary').innerText = summary;
        document.getElementById('modalAction').innerText = action;

        const statusElem = document.getElementById('modalStatus');
        statusElem.innerText = status;
        
        // Dynamic status badge styling inside modal
        statusElem.className = '';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'pending') statusElem.className = 'status-badge-pending';
        else if (lowerStatus === 'scheduled') statusElem.className = 'status-badge-scheduled';
        else if (lowerStatus === 'in progress') statusElem.className = 'status-badge-progress';
        else if (lowerStatus === 'completed') statusElem.className = 'status-badge-completed';

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('historyDetailModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Details for: ' + name);
        }
    }

    function openAddHistoryModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addHistoryModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add History Entry form');
        }
    }

    function saveHistoryEntry(e) {
        e.preventDefault();

        const id = document.getElementById('newRecordId').value.trim();
        const name = document.getElementById('newStudentName').value.trim();
        const rawDate = document.getElementById('newRecordDate').value;
        const type = document.getElementById('newRecordType').value;
        const summary = document.getElementById('newSummary').value.trim();
        const status = document.getElementById('newStatus').value;

        // Format Date
        const dateObj = new Date(rawDate);
        const formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });

        // Status Badge Class
        let badgeClass = 'status-badge-pending';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'scheduled') badgeClass = 'status-badge-scheduled';
        else if (lowerStatus === 'in progress') badgeClass = 'status-badge-progress';
        else if (lowerStatus === 'completed') badgeClass = 'status-badge-completed';

        const tbody = document.getElementById('historyTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'history-row';
        newTr.setAttribute('data-id', id.toLowerCase());
        newTr.setAttribute('data-name', name.toLowerCase());
        newTr.setAttribute('data-type', type);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-4 fw-semibold text-secondary">${id}</td>
            <td class="text-muted">${formattedDate}</td>
            <td class="fw-semibold text-dark truncate-cell">${name}</td>
            <td><span class="badge-record-type">${type}</span></td>
            <td class="text-muted truncate-cell">${summary}</td>
            <td class="text-center"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-4">
                <button type="button" class="btn btn-view-details" onclick="viewHistoryDetails('${id}', '${name}', '${formattedDate}', '${type}', '${summary}', 'Initial entry recorded', '${status}')">
                    Details <i class="bi bi-arrow-right-short fs-5 lh-1 ms-0.5"></i>
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        // Hide Modal & Reset Form
        const modalElem = document.getElementById('addHistoryModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('addHistoryForm').reset();

        applyHistoryFilters();
    }
</script>