<!-- Case Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .fixed-table {
            table-layout: fixed !important;
            width: 100% !important;
        }

        .fixed-table td, .fixed-table th {
            vertical-align: middle;
            white-space: nowrap;
        }

        .fixed-table td.truncate-cell {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Search Pill Input Styling */
        .search-pill-wrapper {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 4px 16px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }

        .search-pill-wrapper:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.15rem rgba(88, 17, 26, 0.15);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.875rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Selects */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            max-width: 160px;
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

        /* Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 16px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fcfcfd;
        }
    </style>

    <!-- Breadcrumb Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-house me-1"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">CASE MANAGEMENT</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Student Case Management</h4>
        <p class="text-muted small mb-0">Track, investigate, and resolve disciplinary, academic integrity, and student welfare cases systematically.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper" style="width: 320px;">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="caseSearch" class="search-pill-input" placeholder="Search case ID, student, or subject..." oninput="filterTable('caseSearch','tblCases')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Case Type:</label>
                    <select class="form-select form-select-sm filter-select" id="caseTypeFilter">
                        <option value="">All Types</option>
                        <option value="Disciplinary">Disciplinary</option>
                        <option value="Academic Integrity">Academic Integrity</option>
                        <option value="Grievance">Grievance</option>
                        <option value="Welfare Intervention">Welfare Intervention</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="Initial Intake">Initial Intake</option>
                        <option value="Under Investigation">Under Investigation</option>
                        <option value="Hearing Scheduled">Hearing Scheduled</option>
                        <option value="Resolved">Resolved</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary ms-1" onclick="openModal('modalNewCase')">
                    <i class="bi bi-plus-circle me-1"></i> Open New Case
                </button>
            </div>
        </div>
    </div>

    <!-- Case Management Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 fixed-table" id="tblCases">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Involved</th>
                    <th class="py-3" style="width: 16%;">Case Type</th>
                    <th class="py-3" style="width: 22%;">Subject / Offense</th>
                    <th class="py-3 text-center" style="width: 10%;">Priority</th>
                    <th class="py-3" style="width: 15%;">Assigned Officer</th>
                    <th class="py-3 text-center pe-3" style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CS-2026-042</td>
                    <td class="fw-semibold text-dark truncate-cell">Reyes, Mark Anthony B.</td>
                    <td>
                        <span class="badge-case-type">Academic Integrity</span>
                    </td>
                    <td class="text-muted truncate-cell">Alleged examination misconduct</td>
                    <td class="text-center">
                        <span class="priority-badge-urgent">Urgent</span>
                    </td>
                    <td class="text-muted truncate-cell">Atty. Santos</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-investigation">Under Investigation</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CS-2026-041</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Sarah G.</td>
                    <td>
                        <span class="badge-case-type">Disciplinary</span>
                    </td>
                    <td class="text-muted truncate-cell">Campus property damage dispute</td>
                    <td class="text-center">
                        <span class="priority-badge-moderate">Moderate</span>
                    </td>
                    <td class="text-muted truncate-cell">Mr. Garcia</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-hearing">Hearing Scheduled</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CS-2026-040</td>
                    <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Juan P.</td>
                    <td>
                        <span class="badge-case-type">Welfare Intervention</span>
                    </td>
                    <td class="text-muted truncate-cell">Repeated unexcused absences</td>
                    <td class="text-center">
                        <span class="priority-badge-low">Low</span>
                    </td>
                    <td class="text-muted truncate-cell">Ms. Mendoza</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-intake">Initial Intake</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CS-2026-039</td>
                    <td class="fw-semibold text-dark truncate-cell">Bautista, Chloe Marie T.</td>
                    <td>
                        <span class="badge-case-type">Grievance</span>
                    </td>
                    <td class="text-muted truncate-cell">Student organization funds audit</td>
                    <td class="text-center">
                        <span class="priority-badge-moderate">Moderate</span>
                    </td>
                    <td class="text-muted truncate-cell">Atty. Santos</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-resolved">Resolved</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination / Metadata -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 18 active cases</span>
        <span>Page 1 of 5</span>
    </div>

    <!-- Due Process & Confidentiality Banner -->
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