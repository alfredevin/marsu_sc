<!-- Assigned Personnel Management -->
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
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Flexible Table Columns - No Hard Compression */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px; /* Guarantees horizontal breathing room for all columns */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important; /* Allows natural text wrapping without line clipping */
            word-break: break-word;
            padding: 12px 14px !important;
            line-height: 1.45;
        }

        /* Search Pill Input Styling */
        .search-pill-wrapper {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 6px 18px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            min-width: 280px;
            flex-grow: 1;
            max-width: 380px;
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
            min-width: 160px;
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

        /* Status Badges - Uncompressed & Wrap-Protected */
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

        /* Action Button */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 7px 18px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
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
        <h4 class="fw-bold marsu-maroon-text mb-1">Assigned Personnel</h4>
        <p class="text-muted small mb-0">View and manage staff members responsible for student intervention plans and case follow-ups.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="personnelSearch" class="search-pill-input" placeholder="Search staff, student, or case..." oninput="filterTable('personnelSearch','personnelTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Role:</label>
                    <select class="form-select form-select-sm filter-select" id="personnelRole" onchange="filterStatus('personnelRole','personnelTable',3)">
                        <option value="">All Roles</option>
                        <option value="Guidance Counselor">Guidance Counselor</option>
                        <option value="Case Worker">Case Worker</option>
                        <option value="Faculty Adviser">Faculty Adviser</option>
                        <option value="Support Staff">Support Staff</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="addInterventionPersonnel()">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Assign Personnel
                </button>
            </div>
        </div>
    </div>

    <!-- Assigned Personnel Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="personnelTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 14%;">Assignment ID</th>
                    <th class="py-3" style="width: 14%;">Case No.</th>
                    <th class="py-3" style="width: 20%;">Student</th>
                    <th class="py-3" style="width: 18%;">Role</th>
                    <th class="py-3" style="width: 18%;">Assigned Personnel</th>
                    <th class="py-3" style="width: 12%;">Assigned Date</th>
                    <th class="py-3 text-center pe-3" style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">AS-2026-014</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark">Dela Cruz, Angelo M.</td>
                    <td>
                        <span class="badge-role">Guidance Counselor</span>
                    </td>
                    <td class="text-muted">G. Panganiban</td>
                    <td class="text-muted text-nowrap">Oct 08, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-active">Active</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">AS-2026-013</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0246</td>
                    <td class="fw-semibold text-dark">Villanueva, Kim D.</td>
                    <td>
                        <span class="badge-role">Case Worker</span>
                    </td>
                    <td class="text-muted">J. Marasigan</td>
                    <td class="text-muted text-nowrap">Oct 07, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-active">Active</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">AS-2026-012</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0247</td>
                    <td class="fw-semibold text-dark">Reyes, Maricel S.</td>
                    <td>
                        <span class="badge-role">Support Staff</span>
                    </td>
                    <td class="text-muted">E. Rodelas</td>
                    <td class="text-muted text-nowrap">Oct 03, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Assignment Checklist Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-person-check-fill marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Assignment Checklist</h6>
                <p class="text-muted small mb-0">
                    Confirm staff availability, role and authorization, assigned case, expected tasks, assignment date, and next review date. Limit access to confidential student information to authorized personnel.
                </p>
            </div>
        </div>
    </div>

</div>