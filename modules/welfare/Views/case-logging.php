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
            <span class="small fw-bold marsu-maroon-text">STUDENT COMPLAINTS</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Student Complaints Log</h4>
        <p class="text-muted small mb-0">Record and monitor formal concerns and complaints raised by students regarding institutional policies, services, or personnel.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper" style="width: 320px;">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="searchComplaints" class="search-pill-input" placeholder="Search complainant name or complaint no..." oninput="filterTable('searchComplaints','tblComplaints')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Office Concerned:</label>
                    <select class="form-select form-select-sm filter-select" id="officeFilter">
                        <option value="">All Offices</option>
                        <option value="College Faculty">College Faculty</option>
                        <option value="Student Housing">Student Housing</option>
                        <option value="Registrar's Office">Registrar's Office</option>
                        <option value="Canteen Services">Canteen Services</option>
                        <option value="Guidance Office">Guidance Office</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="Open">Open</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary ms-1" onclick="openModal('modalComplaint')">
                    <i class="bi bi-plus-circle me-1"></i> File Complaint
                </button>
            </div>
        </div>
    </div>

    <!-- Student Complaints Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-3">
        <table class="table table-hover align-middle mb-0 fixed-table" id="tblComplaints">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Complaint No.</th>
                    <th class="py-3" style="width: 18%;">Complainant</th>
                    <th class="py-3" style="width: 25%;">Nature of Complaint</th>
                    <th class="py-3" style="width: 18%;">Office Concerned</th>
                    <th class="py-3" style="width: 12%;">Date Filed</th>
                    <th class="py-3 text-center pe-3" style="width: 15%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CP-0091</td>
                    <td class="fw-semibold text-dark truncate-cell">Fernandez, Joy L.</td>
                    <td class="text-muted truncate-cell">Alleged unfair grading practice</td>
                    <td>
                        <span class="badge-office">College Faculty</span>
                    </td>
                    <td class="text-muted">Sep 11, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-open">Open</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CP-0090</td>
                    <td class="fw-semibold text-dark truncate-cell">Aquino, Ronald P.</td>
                    <td class="text-muted truncate-cell">Dormitory curfew dispute</td>
                    <td>
                        <span class="badge-office">Student Housing</span>
                    </td>
                    <td class="text-muted">Sep 06, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-ongoing">Ongoing</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CP-0089</td>
                    <td class="fw-semibold text-dark truncate-cell">Mendoza, Grace A.</td>
                    <td class="text-muted truncate-cell">Delayed release of TOR</td>
                    <td>
                        <span class="badge-office">Registrar's Office</span>
                    </td>
                    <td class="text-muted">Aug 30, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-resolved">Resolved</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CP-0088</td>
                    <td class="fw-semibold text-dark truncate-cell">Cruz, Nathaniel V.</td>
                    <td class="text-muted truncate-cell">Canteen food safety concern</td>
                    <td>
                        <span class="badge-office">Canteen Services</span>
                    </td>
                    <td class="text-muted">Aug 24, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-closed">Closed</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-3 fw-semibold text-secondary">CP-0087</td>
                    <td class="fw-semibold text-dark truncate-cell">Lim, Andrea F.</td>
                    <td class="text-muted truncate-cell">Peer harassment complaint</td>
                    <td>
                        <span class="badge-office">Guidance Office</span>
                    </td>
                    <td class="text-muted">Aug 19, 2026</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-urgent">Urgent</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Footer / Pagination Metadata -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 5 of 21 complaints</span>
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