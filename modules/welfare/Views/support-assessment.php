
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
            min-width: 130px;
            max-width: 150px;
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
        .status-badge-referral {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-block !important;
        }

        .status-badge-progress {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffc107 !important;
            display: inline-block !important;
        }

        .status-badge-review {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
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

    <!-- Breadcrumb Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-house me-1"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">SUPPORT ASSESSMENT</span>
        </div>
    </div>

    <!-- Page Header Title -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Support Assessment</h4>
        <p class="text-muted small mb-0">Document identified needs, urgency levels, and recommended student support services.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper" style="width: 320px;">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="assessmentSearch" class="search-pill-input" placeholder="Search student, need, or status..." oninput="filterTable('assessmentSearch','assessmentTable')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Actions -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Priority:</label>
                    <select class="form-select form-select-sm filter-select" id="priorityFilter">
                        <option value="">All Priorities</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="For referral">For referral</option>
                        <option value="In progress">In progress</option>
                        <option value="Under review">Under review</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary ms-1" onclick="showToast('Demo only: assessment form can be connected to the database.')">
                    <i class="bi bi-plus-circle me-1"></i> New Assessment
                </button>
            </div>
        </div>
    </div>

    <!-- Support Assessment Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 fixed-table" id="assessmentTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 15%;">Assessment ID</th>
                    <th class="py-3" style="width: 20%;">Student Name</th>
                    <th class="py-3" style="width: 16%;">Support Need</th>
                    <th class="py-3 text-center" style="width: 10%;">Priority</th>
                    <th class="py-3" style="width: 20%;">Recommended Action</th>
                    <th class="py-3" style="width: 13%;">Assessment Date</th>
                    <th class="py-3 text-center" style="width: 16%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">SA-2026-001</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td class="text-muted truncate-cell">Financial assistance</td>
                    <td class="text-center">
                        <span class="priority-badge-high">High</span>
                    </td>
                    <td class="text-muted truncate-cell">Refer to financial aid office</td>
                    <td class="text-muted">Oct 06, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-referral">For referral</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">SA-2026-002</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td class="text-muted truncate-cell">Academic adjustment</td>
                    <td class="text-center">
                        <span class="priority-badge-medium">Medium</span>
                    </td>
                    <td class="text-muted truncate-cell">Schedule guidance consultation</td>
                    <td class="text-muted">Oct 08, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-progress">In progress</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">SA-2026-003</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td class="text-muted truncate-cell">Transportation support</td>
                    <td class="text-center">
                        <span class="priority-badge-medium">Medium</span>
                    </td>
                    <td class="text-muted truncate-cell">Review student support programs</td>
                    <td class="text-muted">Oct 10, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-review">Under review</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Assessment Checklist Notice Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-clipboard-check-fill marsu-maroon-text fs-4 flex-shrink-0"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Assessment Checklist & Guidelines</h6>
                <p class="text-muted small mb-0">
                    Reason for assessment • Student-stated concern • Academic or personal impact • Urgency level • Recommended service • Referral or assigned staff • Follow-up date • Outcome. Follow the university's approved safeguarding and referral procedures for urgent concerns.
                </p>
            </div>
        </div>
    </div>

</div>