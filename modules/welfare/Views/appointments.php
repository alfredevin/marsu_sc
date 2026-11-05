<!-- Appointments & Consultations Management (MarSU OSAS Standard) -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
            border: 1px solid #dee2e6;
        }

        /* Flexible Uncompressed Table Layout */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1200px;
            border-collapse: collapse !important;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle !important;
            padding: 12px 16px !important;
            border-bottom: 1px solid #dee2e6 !important;
            white-space: nowrap;
        }

        .uncompressed-table td.truncate-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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

        /* Search Pill Input Styling */
        .search-pill-wrapper-short {
            background-color: #ffffff;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 6px 14px;
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
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        /* Service Badges */
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

        /* Status Badges */
        .status-badge-scheduled {
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

        .status-badge-pending {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
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
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        /* Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 7px 16px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .btn-view-maroon {
            color: #58111a !important;
            border: 1.5px solid #58111a !important;
            background-color: #ffffff !important;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 6px;
            font-size: 0.825rem;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-view-maroon:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fafbfc;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }

        /* Essential Details View Modal Styling */
        .essential-info-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .essential-label {
            font-size: 0.72rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .essential-value {
            font-size: 0.9rem;
            color: #0f172a;
            font-weight: 600;
        }

        /* Compact Stepper UI */
        .compact-stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 10px 0 4px 0;
        }

        .compact-step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        .compact-step-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.78rem;
            margin-bottom: 4px;
        }

        .compact-step-circle.completed {
            background-color: #10b981;
            color: #fff;
        }

        .compact-step-circle.active {
            background-color: #58111a;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(88, 17, 26, 0.15);
        }

        .compact-step-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #64748b;
        }

        .compact-step-line {
            position: absolute;
            top: 24px;
            left: 10%;
            right: 10%;
            height: 2px;
            background-color: #e2e8f0;
            z-index: 1;
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

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Appointments</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalAppts">4</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Recorded Bookings</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-calendar-check-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Pending Approval</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricPending">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Awaiting Review</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Confirmed</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricConfirmed">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Scheduled Sessions</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Completed Sessions</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricCompleted">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Finalized Meetings</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success ms-2">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="appointmentSearch" class="search-pill-input" placeholder="Search student or staff..." oninput="applyAppointmentFilters()" autocomplete="off">
            </div>

            <!-- 2. Service Type Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Service:</label>
                <select class="form-select form-select-sm filter-select" id="serviceFilter" onchange="applyAppointmentFilters()">
                    <option value="">All Services</option>
                    <option value="Guidance Counseling">Guidance Counseling</option>
                    <option value="Financial Aid Inquiry">Financial Aid Inquiry</option>
                    <option value="Grievance Consultation">Grievance Consultation</option>
                    <option value="Student Org Clearance">Student Org Clearance</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="appointmentStatusFilter" onchange="applyAppointmentFilters()">
                    <option value="">All Statuses</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Pending Approval">Pending Approval</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <!-- 4. Book Appointment Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openBookAppointmentModal()">
                <i class="bi bi-calendar-plus me-1 icon-shrink-0"></i> Book Appointment
            </button>

        </div>
    </div>

    <!-- Appointments Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="appointmentTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 11%;">Appt. ID</th>
                    <th class="py-3" style="width: 17%;">Student Name</th>
                    <th class="py-3" style="width: 16%;">Service Requested</th>
                    <th class="py-3" style="width: 14%;">Assigned Staff</th>
                    <th class="py-3 text-center" style="width: 16%;">Schedule Date & Time</th>
                    <th class="py-3" style="width: 13%;">Venue / Mode</th>
                    <th class="py-3 text-center" style="width: 12%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="appointmentTableBody">
                <tr class="appointment-row" id="row-apt-2026-089" data-id="apt-2026-089" data-student="adamos, mariedhen l." data-service="Financial Aid Inquiry" data-status="Confirmed">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">APT-2026-089</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td><span class="badge-service">Financial Aid Inquiry</span></td>
                    <td class="text-muted truncate-cell">Ms. Rodelas</td>
                    <td class="text-center text-muted text-nowrap">Oct 16, 2026 • 10:00 AM</td>
                    <td class="text-muted truncate-cell">OSAS Office (Room 102)</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-scheduled">Confirmed</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAppointmentModal('APT-2026-089', 'Adamos, Mariedhen L.', 'Financial Aid Inquiry', 'Ms. Rodelas', 'Oct 16, 2026 • 10:00 AM', 'OSAS Office (Room 102)', 'Confirmed', 'Consultation regarding TDP-TES grant requirements and document validation.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="appointment-row" id="row-apt-2026-088" data-id="apt-2026-088" data-student="ali, kyla diane m." data-service="Guidance Counseling" data-status="Pending Approval">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">APT-2026-088</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td><span class="badge-service">Guidance Counseling</span></td>
                    <td class="text-muted truncate-cell">G. Panganiban</td>
                    <td class="text-center text-muted text-nowrap">Oct 16, 2026 • 02:00 PM</td>
                    <td class="text-muted truncate-cell">Counseling Room A</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-pending">Pending Approval</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAppointmentModal('APT-2026-088', 'Ali, Kyla Diane M.', 'Guidance Counseling', 'G. Panganiban', 'Oct 16, 2026 • 02:00 PM', 'Counseling Room A', 'Pending Approval', 'Academic wellness and workload management intake consultation.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="appointment-row" id="row-apt-2026-087" data-id="apt-2026-087" data-student="almonte, hanz andrei r." data-service="Grievance Consultation" data-status="Completed">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">APT-2026-087</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td><span class="badge-service">Grievance Consultation</span></td>
                    <td class="text-muted truncate-cell">Atty. Santos</td>
                    <td class="text-center text-muted text-nowrap">Oct 15, 2026 • 09:30 AM</td>
                    <td class="text-muted truncate-cell">Virtual (Google Meet)</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-completed">Completed</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAppointmentModal('APT-2026-087', 'Almonte, Hanz Andrei R.', 'Grievance Consultation', 'Atty. Santos', 'Oct 15, 2026 • 09:30 AM', 'Virtual (Google Meet)', 'Completed', 'Formal grievance procedure orientation and dispute mediation completed.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="appointment-row" id="row-apt-2026-086" data-id="apt-2026-086" data-student="andaya, patricia m." data-service="Student Org Clearance" data-status="Cancelled">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">APT-2026-086</td>
                    <td class="fw-semibold text-dark truncate-cell">Andaya, Patricia M.</td>
                    <td><span class="badge-service">Student Org Clearance</span></td>
                    <td class="text-muted truncate-cell">J. Marasigan</td>
                    <td class="text-center text-muted text-nowrap">Oct 14, 2026 • 03:30 PM</td>
                    <td class="text-muted truncate-cell">Student Activity Center</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-cancelled">Cancelled</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAppointmentModal('APT-2026-086', 'Andaya, Patricia M.', 'Student Org Clearance', 'J. Marasigan', 'Oct 14, 2026 • 03:30 PM', 'Student Activity Center', 'Cancelled', 'Student cancelled appointment due to conflict in academic schedule.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noAppointmentRecordsRow" style="display: none;">
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No appointment records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 appointment records</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Appointment Policy Guidelines Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-calendar-event-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Appointment Guidelines</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Students are advised to arrive or log in 10 minutes prior to their confirmed schedule. Rescheduling or cancellations must be logged at least 24 hours in advance to optimize staff availability. All confidential counseling sessions are subject to privacy and university safeguarding policies.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (APPOINTMENT FOCUS)              -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialAppointmentModal" tabindex="-1" aria-labelledby="essentialAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">APPOINTMENT DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vApptId">APT-2026-089</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeApptId" value="">

                <!-- 1. Student Beneficiary Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student Name</span>
                        <span class="status-badge-scheduled" id="vStatusBadge">Confirmed</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Adamos, Mariedhen L.</h5>
                </div>

                <!-- 2. Appointment Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Service Requested</div>
                            <div class="essential-value marsu-maroon-text" id="vService">Financial Aid Inquiry</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Assigned Staff</div>
                            <div class="essential-value text-dark" id="vAssignedStaff">Ms. Rodelas</div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Schedule Date & Time</div>
                            <div class="essential-value text-dark" id="vSchedule">Oct 16, 2026 • 10:00 AM</div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Venue / Mode</div>
                            <div class="essential-value text-dark" id="vVenue">OSAS Office (Room 102)</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Appointment Workflow Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="ast1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Requested</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="ast2">2</div>
                            <span class="compact-step-label text-dark fw-bold">Confirmed</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="ast3">3</div>
                            <span class="compact-step-label">Completed</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Notes & Purpose -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Purpose / Notes</div>
                    <div class="small text-dark fw-semibold" id="vNotesText">Consultation regarding TDP-TES grant requirements and document validation.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Appointment Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Pending Approval">Pending Approval</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialAppointmentStatus()">Save Status</button>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2 px-4 justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL 2: BOOK NEW APPOINTMENT ENTRY                                   -->
<!-- ===================================================================== -->
<div class="modal fade" id="newAppointmentModal" tabindex="-1" aria-labelledby="newAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newAppointmentModalLabel">
                    <i class="bi bi-calendar-plus me-1"></i> Book Appointment
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newAppointmentForm" onsubmit="saveNewAppointment(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Appointment ID</label>
                            <input type="text" class="form-control form-control-sm" id="newApptId" placeholder="e.g. APT-2026-090" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Service Requested</label>
                            <select class="form-select form-select-sm" id="newService" required>
                                <option value="Guidance Counseling">Guidance Counseling</option>
                                <option value="Financial Aid Inquiry">Financial Aid Inquiry</option>
                                <option value="Grievance Consultation">Grievance Consultation</option>
                                <option value="Student Org Clearance">Student Org Clearance</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Santos, Maria A." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Assigned Staff</label>
                            <input type="text" class="form-control form-control-sm" id="newAssignedStaff" placeholder="e.g. G. Panganiban" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Venue / Mode</label>
                            <input type="text" class="form-control form-control-sm" id="newVenue" placeholder="e.g. OSAS Office (Room 102)" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Schedule Date & Time</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="newScheduleDateTime" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Initial Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Pending Approval">Pending Approval</option>
                                <option value="Confirmed">Confirmed</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Purpose / Notes</label>
                        <textarea class="form-control form-control-sm" id="newNotes" rows="3" placeholder="Brief explanation of consultation purpose..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Book Appointment</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyAppointmentFilters() {
        const searchInput = document.getElementById('appointmentSearch').value.toLowerCase().trim();
        const serviceFilter = document.getElementById('serviceFilter').value;
        const statusFilter = document.getElementById('appointmentStatusFilter').value;

        const rows = document.querySelectorAll('.appointment-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const student = row.getAttribute('data-student');
            const service = row.getAttribute('data-service');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || student.includes(searchInput);
            const matchesService = !serviceFilter || service.toLowerCase() === serviceFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesService && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noAppointmentRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} appointment records`;
        }
    }

    function openEssentialAppointmentModal(apptId, student, service, staff, schedule, venue, status, notes) {
        document.getElementById('activeApptId').value = apptId.toLowerCase();
        document.getElementById('vApptId').innerText = apptId;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vService').innerText = service;
        document.getElementById('vAssignedStaff').innerText = staff;
        document.getElementById('vSchedule').innerText = schedule;
        document.getElementById('vVenue').innerText = venue;
        document.getElementById('vNotesText').innerText = notes || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'confirmed') badgeElem.className = 'status-badge-scheduled';
        else if (lower === 'completed') badgeElem.className = 'status-badge-completed';
        else if (lower === 'cancelled') badgeElem.className = 'status-badge-cancelled';
        else badgeElem.className = 'status-badge-pending';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('ast1');
        const st2 = document.getElementById('ast2');
        const st3 = document.getElementById('ast3');

        st1.className = 'compact-step-circle completed';

        if (lower === 'completed') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st3.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'confirmed') {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        } else {
            st1.className = 'compact-step-circle active';
            st1.innerText = '1';
            st2.className = 'compact-step-circle';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialAppointmentModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Appointment Details: ' + apptId);
        }
    }

    function saveEssentialAppointmentStatus() {
        const activeApptId = document.getElementById('activeApptId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeApptId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-pending';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'confirmed') newBadgeClass = 'status-badge-scheduled';
            else if (lowerStatus === 'completed') newBadgeClass = 'status-badge-completed';
            else if (lowerStatus === 'cancelled') newBadgeClass = 'status-badge-cancelled';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const studentText = targetRow.cells[1].innerText;
                const serviceText = targetRow.cells[2].innerText.trim();
                const staffText = targetRow.cells[3].innerText;
                const scheduleText = targetRow.cells[4].innerText;
                const venueText = targetRow.cells[5].innerText;
                const notesText = document.getElementById('vNotesText').innerText;

                viewBtn.setAttribute('onclick', `openEssentialAppointmentModal('${idText}', '${studentText}', '${serviceText}', '${staffText}', '${scheduleText}', '${venueText}', '${newStatus}', '${notesText}')`);
            }
        }

        const modalElem = document.getElementById('essentialAppointmentModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyAppointmentFilters();
        alert('Appointment status successfully updated!');
    }

    function openBookAppointmentModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newAppointmentModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Book Appointment Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.appointment-row');
        let totalAppts = rows.length;
        let pendingCount = 0;
        let confirmedCount = 0;
        let completedCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();

            if (status === 'pending approval') {
                pendingCount++;
            } else if (status === 'confirmed') {
                confirmedCount++;
            } else if (status === 'completed') {
                completedCount++;
            }
        });

        document.getElementById('metricTotalAppts').innerText = totalAppts;
        document.getElementById('metricPending').innerText = pendingCount;
        document.getElementById('metricConfirmed').innerText = confirmedCount;
        document.getElementById('metricCompleted').innerText = completedCount;
    }

    function saveNewAppointment(e) {
        e.preventDefault();

        const apptId = document.getElementById('newApptId').value.trim();
        const service = document.getElementById('newService').value;
        const student = document.getElementById('newStudentName').value.trim();
        const staff = document.getElementById('newAssignedStaff').value.trim();
        const venue = document.getElementById('newVenue').value.trim();
        const rawDateTime = document.getElementById('newScheduleDateTime').value;
        const status = document.getElementById('newStatus').value;
        const notes = document.getElementById('newNotes').value.trim();

        let formattedDateTime = '—';
        if (rawDateTime) {
            const dateObj = new Date(rawDateTime);
            const dateStr = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
            const timeStr = dateObj.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            formattedDateTime = `${dateStr} • ${timeStr}`;
        }

        let badgeClass = (status.toLowerCase() === 'confirmed') ? 'status-badge-scheduled' : 'status-badge-pending';

        const rowId = 'row-' + apptId.toLowerCase();
        const tbody = document.getElementById('appointmentTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'appointment-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', apptId.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-service', service);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${apptId}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="badge-service">${service}</span></td>
            <td class="text-muted truncate-cell">${staff}</td>
            <td class="text-center text-muted text-nowrap">${formattedDateTime}</td>
            <td class="text-muted truncate-cell">${venue}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialAppointmentModal('${apptId}', '${student}', '${service}', '${staff}', '${formattedDateTime}', '${venue}', '${status}', '${notes}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newAppointmentModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newAppointmentForm').reset();

        recalculateMetrics();
        applyAppointmentFilters();
    }
</script>