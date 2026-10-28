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
            border: 1px solid #ffc107 !important;
            display: inline-block !important;
        }

        /* Green background for Completed */
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
            <span class="small fw-bold marsu-maroon-text">WELFARE HISTORY RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Welfare History Records</h4>
        <p class="text-muted small mb-0">View a chronological record of student concerns, referrals, support actions, and follow-up outcomes.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper" style="width: 320px;">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="historySearch" class="search-pill-input" placeholder="Search student or history record..." oninput="filterTable('historySearch','historyTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Record Type:</label>
                    <select class="form-select form-select-sm filter-select text-center" id="recordTypeFilter" style="text-align: center; text-align-last: center;">
                        <option value="" class="text-center">All Types</option>
                        <option value="Support assessment" class="text-center">Support assessment</option>
                        <option value="Guidance consultation" class="text-center">Guidance consultation</option>
                        <option value="Student referral" class="text-center">Student referral</option>
                    </select>
                </div>

                <!-- Centered Status Dropdown -->
                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Status:</label>
                    <select class="form-select form-select-sm filter-select text-center" id="statusFilter" style="text-align: center; text-align-last: center;">
                        <option value="" class="text-center">All Statuses</option>
                        <option value="Pending" class="text-center">Pending</option>
                        <option value="Scheduled" class="text-center">Scheduled</option>
                        <option value="In progress" class="text-center">In progress</option>
                        <option value="Completed" class="text-center">Completed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary ms-1" onclick="showToast('Demo only: welfare-history entry form can be connected to the database.')">
                    <i class="bi bi-plus-circle me-1"></i> Add History Entry
                </button>
            </div>
        </div>
    </div>

    <!-- Welfare History Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 fixed-table" id="historyTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Record ID</th>
                    <th class="py-3" style="width: 10%;">Date</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 16%;">Record Type</th>
                    <th class="py-3" style="width: 20%;">Summary</th>
                    <th class="py-3" style="width: 14%;">Action</th>
                    <th class="py-3 text-center" style="width: 10%;">Follow-Up Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">WH-2026-014</td>
                    <td class="text-muted">Oct 10, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td>
                        <span class="badge-record-type">Support assessment</span>
                    </td>
                    <td class="text-muted truncate-cell">Financial support need identified</td>
                    <td class="text-muted truncate-cell">Referral for assistance review</td>
                    <td class="text-center">
                        <span class="status-badge-pending">Pending</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">WH-2026-013</td>
                    <td class="text-muted">Oct 08, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td>
                        <span class="badge-record-type">Guidance consultation</span>
                    </td>
                    <td class="text-muted truncate-cell">Requested academic adjustment support</td>
                    <td class="text-muted truncate-cell">Consultation scheduled</td>
                    <td class="text-center">
                        <span class="status-badge-scheduled">Scheduled</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">WH-2026-012</td>
                    <td class="text-muted">Oct 02, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td>
                        <span class="badge-record-type">Student referral</span>
                    </td>
                    <td class="text-muted truncate-cell">Transportation assistance inquiry</td>
                    <td class="text-muted truncate-cell">Program eligibility to be checked</td>
                    <td class="text-center">
                        <span class="status-badge-progress">In progress</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">WH-2026-011</td>
                    <td class="text-muted">Sep 28, 2026</td>
                    <td class="fw-semibold text-dark truncate-cell">Bautista, Maria C.</td>
                    <td>
                        <span class="badge-record-type">Guidance consultation</span>
                    </td>
                    <td class="text-muted truncate-cell">Completed academic counseling session</td>
                    <td class="text-muted truncate-cell">Resolved / Follow-up closed</td>
                    <td class="text-center">
                        <span class="status-badge-completed">Completed</span>
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