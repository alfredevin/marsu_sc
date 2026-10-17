<!-- Appointments & Consultations Management -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll & Spacing */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
        }

        /* Uncompressed Table with Generous Cell Padding */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1200px; /* Guarantees horizontal breathing room for appointment details */
            border-collapse: separate;
            border-spacing: 0;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle;
            white-space: normal !important;
            word-break: break-word;
            padding: 14px 18px !important;
            line-height: 1.5;
        }

        /* Enhanced Metric Cards Styling */
        .metric-card-enhanced {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem 1.25rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .metric-card-enhanced:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
        }

        /* Status Accent Left Bars */
        .metric-card-enhanced::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .accent-maroon::before { background-color: #58111a; }
        .accent-warning::before { background-color: #ffc107; }
        .accent-primary::before { background-color: #0d6efd; }
        .accent-success::before { background-color: #198754; }

        /* Soft Background Badges for Metric Icons */
        .icon-wrapper-soft {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bg-soft-maroon { background-color: rgba(88, 17, 26, 0.08); color: #58111a; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

        .metric-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        /* Spacious Toolbar Controls */
        .toolbar-card {
            border: 1px solid #eaeaea !important;
            background-color: #fdfdfd !important;
            border-radius: 12px !important;
            padding: 1.25rem !important;
            margin-bottom: 1.75rem !important;
        }

        /* Pill Search Input with Generous Internal Cushioning */
        .search-pill-wrapper {
            background-color: #ffffff;
            border: 1.5px solid #e2d8d8;
            border-radius: 50rem !important;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            min-width: 300px;
            flex-grow: 1;
            max-width: 420px;
        }

        .search-pill-wrapper:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.2rem rgba(88, 17, 26, 0.12);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.9rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 170px;
            padding: 6px 12px !important;
            font-size: 0.875rem !important;
            border-radius: 8px !important;
        }

        /* Service / Category Badges */
        .badge-service {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8f9fa !important;
            color: #495057 !important;
            border: 1px solid #dcdcdc !important;
            display: inline-block !important;
        }

        /* Status Badges with Roomy Padding */
        .status-badge-scheduled {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-completed {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1px solid #198754 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-pending {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-cancelled {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        /* Primary Action Button */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fafbfc;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }
    </style>

    <!-- Breadcrumb Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-3 py-1.5">
                <i class="bi bi-house me-1.5 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT SERVICES & GUIDANCE</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">APPOINTMENTS & CONSULTATIONS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Appointments & Consultations</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Schedule, manage, and monitor student guidance sessions, staff consultation requests, and formal office visits with OSAS personnel.
        </p>
    </div>

    <!-- Modern Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Scheduled Appointments -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Appointments</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">16</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-calendar-check-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Approval</div>
                    <div class="fs-2 fw-bold text-dark lh-1">3</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Confirmed Today -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Confirmed Today</div>
                    <div class="fs-2 fw-bold text-primary lh-1">5</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Completed Sessions -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Completed Sessions</div>
                    <div class="fs-2 fw-bold text-success lh-1">28</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card toolbar-card shadow-sm">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
            
            <!-- Pill Search Input -->
            <div class="search-pill-wrapper">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="appointmentSearch" class="search-pill-input" placeholder="Search student, counselor, or service type..." oninput="filterTable('appointmentSearch','appointmentTable')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Primary Action Button -->
            <div class="d-flex flex-wrap gap-3 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Service Type:</label>
                    <select class="form-select form-select-sm filter-select" id="serviceFilter">
                        <option value="">All Services</option>
                        <option value="Guidance Counseling">Guidance Counseling</option>
                        <option value="Financial Aid Inquiry">Financial Aid Inquiry</option>
                        <option value="Grievance Consultation">Grievance Consultation</option>
                        <option value="Student Org Clearance">Student Org Clearance</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="appointmentStatus" onchange="filterStatus('appointmentStatus','appointmentTable',6)">
                        <option value="">All Statuses</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Pending Approval">Pending Approval</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="openModal('modalBookAppointment')">
                    <i class="bi bi-calendar-plus icon-shrink-0"></i> Book Appointment
                </button>
            </div>
        </div>
    </div>

    <!-- Appointments Table with Increased Internal & External Spacing -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="appointmentTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 12%;">Appt. ID</th>
                    <th class="py-3.5" style="width: 18%;">Student Name</th>
                    <th class="py-3.5" style="width: 16%;">Service Requested</th>
                    <th class="py-3.5" style="width: 14%;">Assigned Staff</th>
                    <th class="py-3.5" style="width: 14%;">Schedule Date & Time</th>
                    <th class="py-3.5" style="width: 12%;">Venue / Mode</th>
                    <th class="py-3.5 text-center pe-4" style="width: 14%;">Status</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">APT-2026-089</td>
                    <td class="fw-semibold text-dark">Adamos, Mariedhen L.</td>
                    <td>
                        <span class="badge-service">Financial Aid Inquiry</span>
                    </td>
                    <td class="text-muted">Ms. Rodelas</td>
                    <td class="text-muted text-nowrap">Oct 16, 2026 • 10:00 AM</td>
                    <td class="text-muted">OSAS Office (Room 102)</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-scheduled">Confirmed</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">APT-2026-088</td>
                    <td class="fw-semibold text-dark">Ali, Kyla Diane M.</td>
                    <td>
                        <span class="badge-service">Guidance Counseling</span>
                    </td>
                    <td class="text-muted">G. Panganiban</td>
                    <td class="text-muted text-nowrap">Oct 16, 2026 • 02:00 PM</td>
                    <td class="text-muted">Counseling Room A</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-pending">Pending Approval</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">APT-2026-087</td>
                    <td class="fw-semibold text-dark">Almonte, Hanz Andrei R.</td>
                    <td>
                        <span class="badge-service">Grievance Consultation</span>
                    </td>
                    <td class="text-muted">Atty. Santos</td>
                    <td class="text-muted text-nowrap">Oct 15, 2026 • 09:30 AM</td>
                    <td class="text-muted">Virtual (Google Meet)</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">APT-2026-086</td>
                    <td class="fw-semibold text-dark">Andaya, Patricia M.</td>
                    <td>
                        <span class="badge-service">Student Org Clearance</span>
                    </td>
                    <td class="text-muted">J. Marasigan</td>
                    <td class="text-muted text-nowrap">Oct 14, 2026 • 03:30 PM</td>
                    <td class="text-muted">Student Activity Center</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-cancelled">Cancelled</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 16 active appointment records</span>
        <span>Page 1 of 4</span>
    </div>

    <!-- Appointment Policy Guidelines Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-calendar-event-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Appointment Scheduling Guidelines</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Students are advised to arrive or log in 10 minutes prior to their confirmed schedule. Rescheduling or cancellations must be logged at least 24 hours in advance to optimize staff availability. All confidential counseling sessions are subject to privacy and university safeguarding policies.
                </p>
            </div>
        </div>
    </div>

</div>