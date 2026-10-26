<!-- Progress Tracking Management -->
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

        /* Flexible Table Columns - Uncompressed Layout */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px; /* Guarantees comfortable breathing room for all 7 columns */
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

        /* Status Badges - Flexible & Wrap-Protected */
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

        /* Action Buttons */
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
            <span class="small fw-bold marsu-maroon-text">PROGRESS TRACKING</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Progress Tracking</h4>
        <p class="text-muted small mb-0">Monitor intervention milestones, completed actions, and next steps for each student case.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="progressSearch" class="search-pill-input" placeholder="Search case, student, or milestone..." oninput="filterTable('progressSearch','progressTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="progressStatus" onchange="filterStatus('progressStatus','progressTable',5)">
                        <option value="">All Statuses</option>
                        <option value="Not Started">Not Started</option>
                        <option value="In Progress">In Progress</option>
                        <option value="On Track">On Track</option>
                        <option value="Needs Attention">Needs Attention</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1" onclick="addInterventionProgress()">
                    <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Log Progress
                </button>
            </div>
        </div>
    </div>

    <!-- Progress Tracking Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="progressTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 13%;">Progress ID</th>
                    <th class="py-3" style="width: 13%;">Case No.</th>
                    <th class="py-3" style="width: 20%;">Student</th>
                    <th class="py-3" style="width: 22%;">Milestone / Action</th>
                    <th class="py-3" style="width: 12%;">Last Update</th>
                    <th class="py-3 text-center" style="width: 10%;">Status</th>
                    <th class="py-3 pe-3" style="width: 9%;">Next Step</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">PG-2026-021</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark">Dela Cruz, Angelo M.</td>
                    <td class="text-muted">Academic coaching session 1</td>
                    <td class="text-muted text-nowrap">Oct 12, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-progress">In Progress</span>
                    </td>
                    <td class="text-muted">Review attendance</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">PG-2026-020</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0246</td>
                    <td class="fw-semibold text-dark">Villanueva, Kim D.</td>
                    <td class="text-muted">Scheduled counselor check-in</td>
                    <td class="text-muted text-nowrap">Oct 11, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-ontrack">On Track</span>
                    </td>
                    <td class="text-muted">Follow-up Oct 19</td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">PG-2026-019</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0245</td>
                    <td class="fw-semibold text-dark">Santos, Paolo R.</td>
                    <td class="text-muted">Family consultation</td>
                    <td class="text-muted text-nowrap">Oct 09, 2026</td>
                    <td class="text-center">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-muted">Evaluate outcome</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Progress Review Guide Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-journal-check marsu-maroon-text fs-3 icon-shrink-0 mt-1"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Progress Review Guide</h6>
                <p class="text-muted small mb-0">
                    Record observable progress, date of update, evidence or feedback, barriers encountered, next action, and the responsible person. Escalate urgent safety concerns through approved university procedures.
                </p>
            </div>
        </div>
    </div>

</div>