<div class="container-fluid">

    <!-- Page Heading & Quick Actions -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">List of Appointments & Scheduling</h1>
            <p class="text-muted small mb-0">Interactive masterlist of clinic appointments, scheduling calendar, practitioner roster & patient booking management.</p>
        </div>
        <div class="d-flex mt-3 mt-sm-0">
            <button class="btn btn-sm btn-outline-secondary shadow-sm mr-2" onclick="exportAppointmentData()">
                <i class="fas fa-download fa-sm text-gray-600 mr-1"></i> Export Schedule
            </button>
            <button class="btn btn-sm text-white shadow-sm font-weight-bold" style="background-color: #800020;" data-toggle="modal" data-target="#newAppointmentModal">
                <i class="fas fa-calendar-plus fa-sm text-white-50 mr-1"></i> New Appointment
            </button>
        </div>
    </div>

    <!-- KPI Metric Summary Row (4 Cards) -->
    <div class="row mb-4">

        <!-- Total Appointments Today Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-calendar border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Today's Appointments
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statTodayAppts">28 Scheduled</div>
                            <div class="mt-1 small text-muted">
                                <i class="fas fa-sun text-warning mr-1"></i> 14 Morning / 14 Afternoon
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(78, 115, 223, 0.15);">
                                <i class="fas fa-calendar-day fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmed & Checked-In Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-calendar border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Checked-In / Completed
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statCompletedAppts">19 Patients</div>
                            <div class="mt-1 small text-success font-weight-bold">
                                <i class="fas fa-check-circle mr-1"></i> 68% Attendance on time
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(28, 200, 138, 0.15);">
                                <i class="fas fa-user-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Confirmation Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-calendar border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Confirmation
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statPendingAppts">6 Requests</div>
                            <div class="mt-1 small text-warning font-weight-bold">
                                <i class="fas fa-clock mr-1"></i> Slot review in progress
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(246, 194, 62, 0.15);">
                                <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Clinic Slots / Rescheduled Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-calendar border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Open Time Slots
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="statOpenSlots">12 Slots Open</div>
                            <div class="mt-1 small text-muted">
                                <i class="fas fa-door-open text-info mr-1"></i> Walk-in buffer available
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle p-3" style="background-color: rgba(54, 185, 204, 0.15);">
                                <i class="fas fa-clock fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Calendar & Timeline Area -->
    <div class="row">

        <!-- Left / Center: Interactive Monthly Calendar Hub (8 Cols) -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow">

                <!-- Calendar Header Toolbar -->
                <div class="card-header py-3 bg-white d-flex flex-wrap align-items-center justify-content-between">

                    <!-- Month Navigator -->
                    <div class="d-flex align-items-center mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm mr-2" role="group">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevMonth()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="goToToday()">
                                Today
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="nextMonth()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        <h5 class="mb-0 font-weight-bold text-gray-900" id="currentMonthYearDisplay">October 2026</h5>
                    </div>

                    <!-- View Switchers -->
                    <div class="d-flex align-items-center">
                        <div class="btn-group btn-group-sm mr-2" role="group">
                            <button type="button" class="btn btn-outline-secondary active" id="btnCalMonthView" onclick="switchCalendarView('month')">
                                <i class="fas fa-calendar-alt mr-1"></i> Month
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="btnCalTableView" onclick="switchCalendarView('table')">
                                <i class="fas fa-list mr-1"></i> Masterlist
                            </button>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" onclick="printCalendarSchedule()">
                            <i class="fas fa-print mr-1"></i> Print
                        </button>
                    </div>
                </div>

                <div class="card-body p-3">

                    <!-- Filters Bar -->
                    <div class="row mb-3 align-items-center">

                        <!-- Search Box -->
                        <div class="col-md-4 mb-2 mb-md-0">
                            <div class="position-relative">
                                <i class="fas fa-search search-icon-pos"></i>
                                <input type="text" id="calSearchInput" class="form-control form-control-sm search-box-custom" placeholder="Search by Student, LRN, Doctor..." onkeyup="filterCalendar()">
                            </div>
                        </div>

                        <!-- Specialty / Type Filter -->
                        <div class="col-md-3 col-6 mb-2 mb-md-0">
                            <select id="calTypeFilter" class="form-control form-control-sm" onchange="filterCalendar()">
                                <option value="ALL">All Appointment Types</option>
                                <option value="Annual Physical">Annual Physical Exam</option>
                                <option value="Dental Checkup">Dental Checkup</option>
                                <option value="Vaccination">Vaccination / Immunization</option>
                                <option value="Telehealth">Telehealth Video</option>
                                <option value="Guidance">Mental Health Guidance</option>
                                <option value="Vision Screening">Vision & Eye Exam</option>
                            </select>
                        </div>

                        <!-- Doctor Filter -->
                        <div class="col-md-3 col-6 mb-2 mb-md-0">
                            <select id="calDoctorFilter" class="form-control form-control-sm" onchange="filterCalendar()">
                                <option value="ALL">All Practitioners</option>
                                <option value="Dr. Alejandro Gomez, MD">Dr. Alejandro Gomez, MD</option>
                                <option value="Nurse Clarissa D., RN">Nurse Clarissa D., RN</option>
                                <option value="Dr. Patricia Lim, DMD">Dr. Patricia Lim, DMD</option>
                                <option value="Counselor Maria Santos, RGC">Counselor Maria Santos, RGC</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-2 col-12">
                            <select id="calStatusFilter" class="form-control form-control-sm" onchange="filterCalendar()">
                                <option value="ALL">All Status</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="In-Clinic">In-Clinic</option>
                                <option value="Completed">Completed</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>

                    </div>

                    <!-- Category Color Legend -->
                    <div class="d-flex flex-wrap align-items-center mb-3 p-2 bg-light rounded small">
                        <span class="mr-2 font-weight-bold text-muted">Legend:</span>
                        <span class="pill-type-physical mr-2 mb-1"><i class="fas fa-stethoscope mr-1"></i> Physical Exam</span>
                        <span class="pill-type-dental mr-2 mb-1"><i class="fas fa-tooth mr-1"></i> Dental</span>
                        <span class="pill-type-vaccine mr-2 mb-1"><i class="fas fa-syringe mr-1"></i> Vaccine</span>
                        <span class="pill-type-telehealth mr-2 mb-1"><i class="fas fa-video mr-1"></i> Telehealth</span>
                        <span class="pill-type-guidance mr-2 mb-1"><i class="fas fa-heart mr-1"></i> Guidance</span>
                        <span class="pill-type-vision mb-1"><i class="fas fa-eye mr-1"></i> Vision</span>
                    </div>

                    <!-- Interactive Month Grid -->
                    <div id="calendarMonthGridContainer">
                        <div class="table-responsive">
                            <table class="calendar-table">
                                <thead>
                                    <tr>
                                        <th>Sun</th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th>Sat</th>
                                    </tr>
                                </thead>
                                <tbody id="calendarGridBody">
                                    <!-- Dynamic Days Rendered via JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Masterlist Table View (Hidden by default) -->
                    <div id="calendarMasterlistContainer" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-primary text-uppercase small font-weight-bold">
                                    <tr>
                                        <th>Appt ID & Date</th>
                                        <th>Student Patient</th>
                                        <th>Type & Purpose</th>
                                        <th>Time & Bay</th>
                                        <th>Practitioner</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="masterlistTableBody">
                                    <!-- Dynamic Table Rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right: Day Schedule Timeline & Today's Appointments (4 Cols) -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100">

                <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock text-maroon mr-2 fa-lg" style="color: #800020;"></i>
                        <h6 class="m-0 font-weight-bold text-gray-800" id="selectedDateTitle">Schedule for Today (Oct 01, 2026)</h6>
                    </div>
                    <span class="badge badge-primary px-2 py-1" id="dayApptCountBadge">6 Bookings</span>
                </div>

                <div class="card-body p-3">

                    <!-- Quick Date Navigation inside Day Panel -->
                    <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mb-3">
                        <small class="text-muted"><i class="fas fa-calendar-check text-maroon mr-1" style="color: #800020;"></i> Active Day View</small>
                        <button class="btn btn-xs btn-outline-primary" onclick="goToToday()">Jump to Today</button>
                    </div>

                    <!-- Day Timeline List Container -->
                    <div class="timeline-container" id="dayTimelineContainer">
                        <!-- Dynamic Timeline Cards Rendered Here -->
                    </div>

                </div>

                <div class="card-footer bg-white text-center py-2">
                    <button class="btn btn-sm btn-block text-white font-weight-bold" style="background-color: #800020;" data-toggle="modal" data-target="#newAppointmentModal">
                        <i class="fas fa-plus-circle mr-1"></i> Book Slot for This Day
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="appointmentDetailModal" tabindex="-1" role="dialog" aria-labelledby="aptModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header text-white" style="background-color: #800020;">
                <div class="d-flex align-items-center">
                    <div class="mr-3 bg-white text-maroon rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fas fa-calendar-alt fa-lg" style="color: #800020;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="aptModalTitle">Appointment & Clinical Booking Record</h5>
                        <span class="small text-white-50" id="modalAptIdDisplay">#APT-2026-101 | Oct 01, 2026 - 09:00 AM</span>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4 bg-light">

                <!-- Patient & Appointment Quick Banner -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-md-auto text-center mb-3 mb-md-0">
                                <img id="apAvatar" src="img/undraw_profile_1.svg" class="rounded-circle border" width="70" height="70" alt="Avatar">
                            </div>
                            <div class="col-md">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div>
                                        <h5 class="font-weight-bold text-gray-900 mb-1" id="apStudentName">Maria Clara Santos</h5>
                                        <div class="text-muted small">
                                            <span>Student ID: <strong id="apStudentLrn">21S0011</strong></span> |
                                            <span>Course & Year: <span id="apStudentGradeStrand" class="badge badge-primary">BS Information System - 4th Year</span></span> |
                                            <span>Contact: <strong id="apContact">0917-889-2341</strong></span>
                                        </div>
                                    </div>
                                    <div class="mt-2 mt-md-0 text-right">
                                        <span id="apStatusBadge" class="badge badge-apt-confirmed">Confirmed</span>
                                        <div class="mt-1">
                                            <span id="apTypePill" class="pill-type-physical">Annual Physical Exam</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5-Tab Navigation -->
                <ul class="nav nav-pills nav-pills-custom mb-3 bg-white p-2 rounded shadow-sm" id="aptDetailTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-apt-overview-link" data-toggle="pill" href="#tab-apt-overview" role="tab">
                            <i class="fas fa-info-circle mr-1"></i> 1. Appointment Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-apt-prep-link" data-toggle="pill" href="#tab-apt-prep" role="tab">
                            <i class="fas fa-clipboard-check mr-1"></i> 2. Clinical Purpose & Preparation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-apt-checkin-link" data-toggle="pill" href="#tab-apt-checkin" role="tab">
                            <i class="fas fa-door-open mr-1"></i> 3. Arrival Check-In & Queue
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-apt-notes-link" data-toggle="pill" href="#tab-apt-notes" role="tab">
                            <i class="fas fa-user-md mr-1"></i> 4. Practitioner Clinical Findings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-apt-audit-link" data-toggle="pill" href="#tab-apt-audit" role="tab">
                            <i class="fas fa-history mr-1"></i> 5. Notification & Reschedule Log
                        </a>
                    </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content bg-white p-4 rounded shadow-sm" id="aptDetailTabsContent">

                    <!-- Tab 1: Overview -->
                    <div class="tab-pane fade show active" id="tab-apt-overview" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-calendar-day mr-2"></i> Booking Schedule & Location
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="apt-label">Scheduled Date</div>
                                <div class="apt-value" id="apDate">Oct 01, 2026</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Time Slot</div>
                                <div class="apt-value" id="apTime">09:00 AM - 09:30 AM</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Clinic Bay / Room</div>
                                <div class="apt-value" id="apRoom">Examination Room 1 (General Bay)</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Assigned Medical Officer</div>
                                <div class="apt-value" id="apPractitioner">Dr. Alejandro Gomez, MD</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Consultation Category</div>
                                <div class="apt-value" id="apCategory">Annual Physical Exam</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Guardian Consent Status</div>
                                <div class="apt-value text-success" id="apConsent">
                                    <i class="fas fa-check-circle mr-1"></i> On File (Parent: Elena Ramirez)
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Clinical Purpose & Preparation -->
                    <div class="tab-pane fade" id="tab-apt-prep" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-stethoscope mr-2"></i> Clinical Purpose & Pre-Visit Preparation
                        </h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="apt-label">Reason for Appointment / Chief Purpose</div>
                                <div class="p-3 bg-light rounded border text-dark font-weight-500" id="apPurpose">
                                    Annual mandatory Senior High School physical examination and cardiovascular fitness assessment for STEM laboratory and PE clearance.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="apt-label">Pre-Appointment Instructions for Student</div>
                                <div class="p-3 bg-light rounded border small text-dark" id="apPrepInstructions">
                                    Wear comfortable physical education attire. Bring updated vaccine card and previous eyeglasses prescription if applicable.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="apt-label">Required Health Documents</div>
                                <ul class="small text-dark mt-2" id="apDocsList">
                                    <li><i class="fas fa-check-circle text-success mr-1"></i> SHS Health Questionnaire Form</li>
                                    <li><i class="fas fa-check-circle text-success mr-1"></i> Parental Consent for Clinical Screening</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Arrival Check-In & Queue -->
                    <div class="tab-pane fade" id="tab-apt-checkin" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-user-clock mr-2"></i> Check-In Status & Queue Ticket
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="apt-label">Arrival Status</div>
                                <div class="apt-value" id="apCheckinStatus">Checked-In (On-Time)</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Check-In Timestamp</div>
                                <div class="apt-value" id="apCheckinTime">08:52 AM</div>
                            </div>
                            <div class="col-md-4">
                                <div class="apt-label">Queue Ticket Assigned</div>
                                <div class="apt-value font-weight-bold text-success" id="apQueueTicket">#Q-104 (Bay 1)</div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="p-3 bg-light rounded border d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="font-weight-bold text-gray-800 mb-1">Queue Action</h6>
                                        <span class="small text-muted">Mark patient as seated in waiting lounge or call patient to consultation bay.</span>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-success mr-2" onclick="quickCheckinAction()"><i class="fas fa-check mr-1"></i> Mark Arrived</button>
                                        <button class="btn btn-sm btn-primary" onclick="callQueueNumber()"><i class="fas fa-bullhorn mr-1"></i> Call Queue</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Practitioner Clinical Findings -->
                    <div class="tab-pane fade" id="tab-apt-notes" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-file-medical-alt mr-2"></i> Practitioner Clinical Documentation
                        </h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="apt-label">Clinical Observations & Findings</div>
                                <div class="p-3 bg-light rounded border text-dark" id="apClinicalNotes">
                                    Physical exam unremarkable. Blood pressure 110/70 mmHg, pulse 76 bpm regular. Vision 20/20 bilateral. Dental examination reveals good oral hygiene with no dental caries. Cleared for all academic and physical education curricula.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="apt-label">Clearance Outcome</div>
                                <div class="apt-value text-success" id="apOutcome">
                                    <i class="fas fa-check-double mr-1"></i> Fit for School Activities / PE Cleared
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="apt-label">Follow-Up Recommended</div>
                                <div class="apt-value" id="apFollowup">Routine Annual Follow-Up (October 2027)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5: Notification & Reschedule Log -->
                    <div class="tab-pane fade" id="tab-apt-audit" role="tabpanel">
                        <h6 class="font-weight-bold text-maroon mb-3 border-bottom pb-2" style="color: #800020;">
                            <i class="fas fa-bell mr-2"></i> Automated Reminders & Schedule Audit Trail
                        </h6>
                        <div class="timeline small pl-2">
                            <div class="border-left pl-3 pb-3 position-relative">
                                <i class="fas fa-check-circle text-success position-absolute" style="left: -7px; top: 0;"></i>
                                <strong class="text-dark">SMS & Email Confirmation Dispatched</strong>
                                <div class="text-muted">Sent to student (0917-889-2341) and guardian at Oct 01, 2026 - 08:00 AM</div>
                            </div>
                            <div class="border-left pl-3 pb-3 position-relative">
                                <i class="fas fa-bell text-primary position-absolute" style="left: -7px; top: 0;"></i>
                                <strong class="text-dark">24-Hour Prior Reminder Sent</strong>
                                <div class="text-muted">Automated push notification delivered successfully.</div>
                            </div>
                            <div class="border-left pl-3 position-relative">
                                <i class="fas fa-plus-circle text-info position-absolute" style="left: -7px; top: 0;"></i>
                                <strong class="text-dark">Appointment Created in System</strong>
                                <div class="text-muted">Booked by Nurse Clarissa D., RN via Online Clinic Scheduler.</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-warning btn-sm font-weight-bold" onclick="openRescheduleModalFromDetail()">
                    <i class="fas fa-clock mr-1"></i> Reschedule Slot
                </button>
                <button type="button" class="btn btn-success btn-sm font-weight-bold" onclick="markCompletedFromDetail()">
                    <i class="fas fa-check mr-1"></i> Mark Consultation Completed
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="newAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="newAptLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form id="formNewAppointment" onsubmit="saveNewAppointment(event)">

                <div class="modal-header text-white" style="background-color: #800020;">
                    <div class="d-flex align-items-center">
                        <div class="mr-3 bg-white text-maroon rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-calendar-plus" style="color: #800020;"></i>
                        </div>
                        <div>
                            <h5 class="modal-title font-weight-bold mb-0">Book Clinic Appointment</h5>
                            <span class="small text-white-50">Reserve time slot for physical examination, dental checkup, or consultation</span>
                        </div>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <div class="row">

                        <!-- Student Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Select Student / ID Number <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formAptStudent">
                                <option value="">-- Choose Student --</option>
                                <option value="Rex Mark Ricafranca|22B0023|BS Political Science - 3rd Year|0919-445-8812|img/undraw_profile_2.svg">Rex Mark Ricafranca (22B0023 - BS Political Science 3rd Year)</option>
                                <option value="Mica Santos|21S0011|BS Information System - 4th Year|0918-554-3210|img/undraw_profile_1.svg">Mica Santos (21S0011 - BS Information System 4th Year)</option>
                            </select>
                        </div>

                        <!-- Appointment Category -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Appointment Category <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formAptType">
                                <option value="Annual Physical">Annual Physical Exam</option>
                                <option value="Dental Checkup">Dental Examination / Cleaning</option>
                                <option value="Vaccination">Vaccination / Immunization</option>
                                <option value="Telehealth">Telehealth Online Video</option>
                                <option value="Guidance">Mental Health & Wellness Counseling</option>
                                <option value="Vision Screening">Vision & Visual Acuity Test</option>
                            </select>
                        </div>

                        <!-- Practitioner -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Practitioner / Clinician <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formAptDoctor">
                                <option value="Dr. Alejandro Gomez, MD">Dr. Alejandro Gomez, MD (School Physician)</option>
                                <option value="Nurse Clarissa D., RN">Nurse Clarissa D., RN (Lead Clinic Nurse)</option>
                                <option value="Dr. Patricia Lim, DMD">Dr. Patricia Lim, DMD (School Dentist)</option>
                                <option value="Counselor Maria Santos, RGC">Counselor Maria Santos, RGC (Guidance)</option>
                            </select>
                        </div>

                        <!-- Date Picker -->
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Appointment Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" required id="formAptDate" value="2026-10-01">
                        </div>

                        <!-- Time Slot -->
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Time Slot <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formAptTime">
                                <option value="08:30 AM - 09:00 AM">08:30 AM - 09:00 AM</option>
                                <option value="09:00 AM - 09:30 AM">09:00 AM - 09:30 AM</option>
                                <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                                <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                                <option value="01:30 PM - 02:00 PM">01:30 PM - 02:00 PM</option>
                                <option value="02:30 PM - 03:00 PM">02:30 PM - 03:00 PM</option>
                                <option value="03:30 PM - 04:00 PM">03:30 PM - 04:00 PM</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Initial Booking Status <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" required id="formAptStatus">
                                <option value="Confirmed">Confirmed (Verified Slot)</option>
                                <option value="Pending">Pending (Tentative Slot)</option>
                            </select>
                        </div>

                        <!-- Purpose / Notes -->
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-gray-700 small">Clinical Purpose / Special Notes <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" rows="2" required id="formAptPurpose" placeholder="State reason for visit, symptoms, or specific health screening requirements..."></textarea>
                        </div>

                        <!-- Notification check -->
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox bg-white p-3 border rounded">
                                <input type="checkbox" class="custom-control-input" id="notifyAptCheck" checked>
                                <label class="custom-control-label small text-muted" for="notifyAptCheck">
                                    Send automated SMS & Email confirmation with calendar invite to student and legal guardian.
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white font-weight-bold" style="background-color: #800020;">
                        <i class="fas fa-calendar-check mr-1"></i> Confirm & Book Slot
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<div id="toastNotification" class="toast-notification shadow-lg">
    <div class="card border-0 text-white" style="background-color: #800020; min-width: 300px;">
        <div class="card-body p-3 d-flex align-items-center">
            <i class="fas fa-check-circle fa-2x mr-3 text-success"></i>
            <div>
                <h6 class="font-weight-bold mb-0" id="toastTitle">Action Successful</h6>
                <small id="toastMessage" class="text-white-50">Operation executed successfully.</small>
            </div>
        </div>
    </div>
</div>

<script>
    // Current Calendar State
    let currentYear = 2026;
    let currentMonth = 9; // 0-indexed: 9 = October
    let selectedDateStr = "2026-10-01";
    let currentActiveRecord = null;

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    // Comprehensive Master Appointment Dataset
    let appointmentDataset = [{
            id: 1,
            aptId: '#APT-2026-001',
            date: '2026-10-08',
            time: '09:30 AM - 10:00 AM',
            lrn: '22B0023',
            fullName: 'Rex Mark Ricafranca',
            avatar: 'img/undraw_profile_2.svg',
            grade: '3rd Year',
            strand: 'BS Political Science',
            contact: '0919-445-8812',
            type: 'General Medical',
            typeLabel: 'General Medical Checkup',
            doctor: 'Dr. Maria Santos, MD',
            room: 'Examination Room 1 (General Bay)',
            status: 'Confirmed',
            checkin: 'Checked-In (09:25 AM)',
            queue: '#Q-101 (Bay 1)',
            purpose: 'Routine blood pressure monitoring and academic fatigue consultation.',
            instructions: 'Wear comfortable attire and hydrate well.',
            clinicalNotes: 'Blood pressure 130/85 mmHg, pulse 82 bpm. Cleared for all academic activities.',
            outcome: 'Fit for School Activities',
            followup: 'Quarterly Checkup (January 2027)'
        },
        {
            id: 2,
            aptId: '#APT-2026-002',
            date: '2026-10-09',
            time: '10:00 AM - 10:30 AM',
            lrn: '21S0011',
            fullName: 'Mica Santos',
            avatar: 'img/undraw_profile_1.svg',
            grade: '4th Year',
            strand: 'BS Information System',
            contact: '0918-554-3210',
            type: 'Follow-up',
            typeLabel: 'Asthma & Allergy Review',
            doctor: 'Dr. Maria Santos, MD',
            room: 'Examination Room 2',
            status: 'Confirmed',
            checkin: 'Scheduled',
            queue: '#Q-102 (Room 2)',
            purpose: 'Review of Salbutamol rescue inhaler technique and seasonal allergy status.',
            instructions: 'Bring personal inhaler and allergy tracking log.',
            clinicalNotes: 'Asthma well controlled on maintenance inhaler.',
            outcome: 'Fit for Academic Activities (Warm-up for PE)',
            followup: 'Routine Review (June 2027)'
        }
    ];

    // Type Pill Styling Helper
    function getTypePillClass(type) {
        if (type.includes('Physical')) return 'pill-type-physical';
        if (type.includes('Dental')) return 'pill-type-dental';
        if (type.includes('Vaccin')) return 'pill-type-vaccine';
        if (type.includes('Telehealth')) return 'pill-type-telehealth';
        if (type.includes('Guidance')) return 'pill-type-guidance';
        if (type.includes('Vision')) return 'pill-type-vision';
        return 'pill-type-physical';
    }

    // Format Date Helper
    function formatDateStr(year, month, day) {
        const m = String(month + 1).padStart(2, '0');
        const d = String(day).padStart(2, '0');
        return `${year}-${m}-${d}`;
    }

    // Render Interactive Month Calendar Grid
    function renderCalendarGrid() {
        const gridBody = document.getElementById('calendarGridBody');
        gridBody.innerHTML = '';

        document.getElementById('currentMonthYearDisplay').innerText = `${monthNames[currentMonth]} ${currentYear}`;

        const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

        let dateCounter = 1;
        let nextMonthCounter = 1;
        let rowsCount = Math.ceil((firstDayIndex + daysInMonth) / 7);

        for (let r = 0; r < rowsCount; r++) {
            const tr = document.createElement('tr');

            for (let c = 0; c < 7; c++) {
                const cellIndex = r * 7 + c;
                const td = document.createElement('td');
                td.className = 'calendar-day-cell';

                let cellDateStr = '';

                if (cellIndex < firstDayIndex) {
                    // Previous Month Days
                    const prevDay = prevMonthDays - (firstDayIndex - cellIndex - 1);
                    td.classList.add('other-month');
                    td.innerHTML = `<div class="day-header"><span class="day-number">${prevDay}</span></div>`;
                } else if (dateCounter <= daysInMonth) {
                    // Current Month Days
                    const thisDay = dateCounter;
                    cellDateStr = formatDateStr(currentYear, currentMonth, thisDay);

                    const isToday = (cellDateStr === "2026-10-01");
                    const isSelected = (cellDateStr === selectedDateStr);

                    if (isToday) td.classList.add('is-today');
                    if (isSelected) td.classList.add('is-selected');

                    td.onclick = function() {
                        selectCalendarDate(cellDateStr, thisDay);
                    };

                    // Find appointments for this day
                    const dayAppts = getFilteredAppointments().filter(a => a.date === cellDateStr);

                    let apptsHtml = '';
                    const displayLimit = 2;

                    dayAppts.slice(0, displayLimit).forEach(apt => {
                        const pillClass = getTypePillClass(apt.type);
                        apptsHtml += `
                                <div class="apt-pill-item ${pillClass}" onclick="event.stopPropagation(); openAppointmentDetailModal(${apt.id})" title="${apt.time} - ${apt.fullName} (${apt.typeLabel})">
                                    <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>${apt.time.split(' - ')[0]} ${apt.fullName.split(' ')[0]}
                                </div>
                            `;
                    });

                    if (dayAppts.length > displayLimit) {
                        apptsHtml += `<div class="apt-count-more">+${dayAppts.length - displayLimit} more</div>`;
                    }

                    td.innerHTML = `
                            <div class="day-header">
                                <span class="day-number">${thisDay}</span>
                                ${dayAppts.length > 0 ? `<span class="badge badge-pill badge-light border font-weight-bold">${dayAppts.length}</span>` : ''}
                            </div>
                            <div class="day-appts-container">
                                ${apptsHtml}
                            </div>
                        `;

                    dateCounter++;
                } else {
                    // Next Month Days
                    td.classList.add('other-month');
                    td.innerHTML = `<div class="day-header"><span class="day-number">${nextMonthCounter}</span></div>`;
                    nextMonthCounter++;
                }

                tr.appendChild(td);
            }

            gridBody.appendChild(tr);
        }

        renderDayTimeline(selectedDateStr);
        renderMasterlistTable();
    }

    // Select Date Handler
    function selectCalendarDate(dateStr, dayNum) {
        selectedDateStr = dateStr;
        renderCalendarGrid();
    }

    // Render Day Timeline in the Right Panel
    function renderDayTimeline(dateStr) {
        const container = document.getElementById('dayTimelineContainer');
        container.innerHTML = '';

        const parts = dateStr.split('-');
        const displayDate = `${monthNames[parseInt(parts[1]) - 1]} ${parseInt(parts[2])}, ${parts[0]}`;
        document.getElementById('selectedDateTitle').innerText = `Schedule for ${displayDate}`;

        const dayAppts = getFilteredAppointments().filter(a => a.date === dateStr);
        document.getElementById('dayApptCountBadge').innerText = `${dayAppts.length} Bookings`;

        if (dayAppts.length === 0) {
            container.innerHTML = `
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-calendar-day fa-3x mb-3 text-gray-300"></i>
                        <h6>No appointments scheduled</h6>
                        <p class="small text-muted mb-3">All practitioner bays are currently open for walk-ins on this date.</p>
                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#newAppointmentModal" onclick="prefillDate('${dateStr}')">
                            <i class="fas fa-plus mr-1"></i> Book Slot for ${displayDate}
                        </button>
                    </div>
                `;
            return;
        }

        dayAppts.forEach(apt => {
            const card = document.createElement('div');
            card.className = 'timeline-card-item';

            const pillClass = getTypePillClass(apt.type);

            let statusBadge = '<span class="badge badge-apt-confirmed">Confirmed</span>';
            if (apt.status === 'Completed') statusBadge = '<span class="badge badge-apt-completed">Completed</span>';
            else if (apt.status === 'In-Clinic') statusBadge = '<span class="badge badge-apt-inclinic">In-Clinic</span>';
            else if (apt.status === 'Pending') statusBadge = '<span class="badge badge-apt-pending">Pending</span>';

            card.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-weight-bold text-dark small"><i class="far fa-clock text-maroon mr-1" style="color: #800020;"></i>${apt.time}</span>
                        <div>
                            ${statusBadge}
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <img src="${apt.avatar}" class="rounded-circle mr-2 border" width="34" height="34" alt="Avatar">
                        <div>
                            <div class="font-weight-bold text-gray-900 small mb-0">${apt.fullName}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">${apt.grade} - ${apt.strand} | LRN: ${apt.lrn}</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span class="${pillClass} mr-1">${apt.typeLabel}</span>
                        <small class="text-muted"><i class="fas fa-user-md mr-1"></i>${apt.doctor}</small>
                    </div>
                    <div class="small text-muted text-truncate mb-2" title="${apt.purpose}">
                        <i class="fas fa-info-circle mr-1"></i>${apt.purpose}
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <small class="text-muted"><i class="fas fa-map-marker-alt text-danger mr-1"></i>${apt.room.split(' (')[0]}</small>
                        <div>
                            <button class="btn btn-xs btn-outline-primary mr-1" onclick="openAppointmentDetailModal(${apt.id})">Details</button>
                            <button class="btn btn-xs btn-outline-success" onclick="quickCheckin(${apt.id})">Check-In</button>
                        </div>
                    </div>
                `;
            container.appendChild(card);
        });
    }

    // Render Masterlist Table View
    function renderMasterlistTable() {
        const tbody = document.getElementById('masterlistTableBody');
        tbody.innerHTML = '';

        const dataset = getFilteredAppointments();

        if (dataset.length === 0) {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted"><i class="fas fa-search fa-2x mb-2 d-block"></i>No appointment records match current filters.</td></tr>`;
            return;
        }

        dataset.forEach(apt => {
            const tr = document.createElement('tr');
            const pillClass = getTypePillClass(apt.type);

            let statusBadge = '<span class="badge badge-apt-confirmed">Confirmed</span>';
            if (apt.status === 'Completed') statusBadge = '<span class="badge badge-apt-completed">Completed</span>';
            else if (apt.status === 'In-Clinic') statusBadge = '<span class="badge badge-apt-inclinic">In-Clinic</span>';
            else if (apt.status === 'Pending') statusBadge = '<span class="badge badge-apt-pending">Pending</span>';

            tr.innerHTML = `
                    <td>
                        <strong class="text-maroon font-weight-bold" style="color: #800020;">${apt.aptId}</strong>
                        <div class="small text-muted"><i class="far fa-calendar-alt mr-1"></i>${apt.date}</div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${apt.avatar}" class="rounded-circle mr-2 border" width="34" height="34" alt="Avatar">
                            <div>
                                <div class="font-weight-bold text-dark">${apt.fullName}</div>
                                <div class="small text-muted">${apt.grade} - ${apt.strand} | ${apt.contact}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="${pillClass} d-inline-block mb-1">${apt.typeLabel}</span>
                        <div class="small text-muted text-truncate" style="max-width: 200px;" title="${apt.purpose}">${apt.purpose}</div>
                    </td>
                    <td>
                        <div class="font-weight-bold text-dark small">${apt.time}</div>
                        <div class="small text-muted"><i class="fas fa-map-marker-alt text-danger mr-1"></i>${apt.room.split(' (')[0]}</div>
                    </td>
                    <td>
                        <div class="small font-weight-bold text-gray-800">${apt.doctor}</div>
                    </td>
                    <td>${statusBadge}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" title="View Full File" onclick="openAppointmentDetailModal(${apt.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-outline-success" title="Quick Check-In" onclick="quickCheckin(${apt.id})">
                                <i class="fas fa-user-check"></i>
                            </button>
                        </div>
                    </td>
                `;
            tbody.appendChild(tr);
        });
    }

    // Get Filtered Appointments
    function getFilteredAppointments() {
        const searchVal = document.getElementById('calSearchInput').value.toLowerCase().trim();
        const typeVal = document.getElementById('calTypeFilter').value;
        const docVal = document.getElementById('calDoctorFilter').value;
        const statusVal = document.getElementById('calStatusFilter').value;

        return appointmentDataset.filter(apt => {
            const matchSearch = !searchVal ||
                apt.fullName.toLowerCase().includes(searchVal) ||
                apt.lrn.includes(searchVal) ||
                apt.aptId.toLowerCase().includes(searchVal) ||
                apt.doctor.toLowerCase().includes(searchVal);

            const matchType = (typeVal === 'ALL') || (apt.type === typeVal);
            const matchDoctor = (docVal === 'ALL') || (apt.doctor === docVal);
            const matchStatus = (statusVal === 'ALL') || (apt.status === statusVal);

            return matchSearch && matchType && matchDoctor && matchStatus;
        });
    }

    // Filter Calendar Change Trigger
    function filterCalendar() {
        renderCalendarGrid();
    }

    // Month Navigation
    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendarGrid();
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendarGrid();
    }

    function goToToday() {
        currentYear = 2026;
        currentMonth = 9;
        selectedDateStr = "2026-10-01";
        renderCalendarGrid();
        showToast('Today Selected', 'Jumped to current clinic schedule for October 01, 2026.');
    }

    // Switch Month Grid / Masterlist View
    function switchCalendarView(viewMode) {
        if (viewMode === 'month') {
            document.getElementById('calendarMonthGridContainer').style.display = 'block';
            document.getElementById('calendarMasterlistContainer').style.display = 'none';
            document.getElementById('btnCalMonthView').classList.add('active');
            document.getElementById('btnCalTableView').classList.remove('active');
        } else {
            document.getElementById('calendarMonthGridContainer').style.display = 'none';
            document.getElementById('calendarMasterlistContainer').style.display = 'block';
            document.getElementById('btnCalTableView').classList.add('active');
            document.getElementById('btnCalMonthView').classList.remove('active');
        }
    }

    // Prefill Date when booking from empty slot
    function prefillDate(dateStr) {
        document.getElementById('formAptDate').value = dateStr;
    }

    // Open 5-Tab Detailed Appointment Modal
    function openAppointmentDetailModal(id) {
        const item = appointmentDataset.find(r => r.id === id);
        if (!item) return;

        currentActiveRecord = item;

        document.getElementById('modalAptIdDisplay').innerText = `${item.aptId} | ${item.date} - ${item.time}`;
        document.getElementById('apStudentName').innerText = item.fullName;
        document.getElementById('apStudentLrn').innerText = item.lrn;
        document.getElementById('apStudentGradeStrand').innerText = `${item.grade} - ${item.strand}`;
        document.getElementById('apContact').innerText = item.contact;
        document.getElementById('apAvatar').src = item.avatar;

        // Status Badge & Type Pill
        document.getElementById('apStatusBadge').className = item.status === 'Confirmed' ? 'badge badge-apt-confirmed' :
            (item.status === 'Completed' ? 'badge badge-apt-completed' :
                (item.status === 'In-Clinic' ? 'badge badge-apt-inclinic' : 'badge badge-apt-pending'));
        document.getElementById('apStatusBadge').innerText = item.status;

        document.getElementById('apTypePill').className = getTypePillClass(item.type);
        document.getElementById('apTypePill').innerText = item.typeLabel;

        // Tab 1
        document.getElementById('apDate').innerText = item.date;
        document.getElementById('apTime').innerText = item.time;
        document.getElementById('apRoom').innerText = item.room;
        document.getElementById('apPractitioner').innerText = item.doctor;
        document.getElementById('apCategory').innerText = item.typeLabel;

        // Tab 2
        document.getElementById('apPurpose').innerText = item.purpose;
        document.getElementById('apPrepInstructions').innerText = item.instructions;

        // Tab 3
        document.getElementById('apCheckinStatus').innerText = item.checkin;
        document.getElementById('apCheckinTime').innerText = item.checkin.includes('(') ? item.checkin.split('(')[1].replace(')', '') : 'Pending Arrival';
        document.getElementById('apQueueTicket').innerText = item.queue;

        // Tab 4
        document.getElementById('apClinicalNotes').innerText = item.clinicalNotes;
        document.getElementById('apOutcome').innerHTML = `<i class="fas fa-check-double mr-1"></i> ${item.outcome}`;
        document.getElementById('apFollowup').innerText = item.followup;

        // Reset tab to 1
        $('#aptDetailTabs a[href="#tab-apt-overview"]').tab('show');
        $('#appointmentDetailModal').modal('show');
    }

    // Quick Check-in
    function quickCheckin(id) {
        const item = appointmentDataset.find(r => r.id === id);
        if (item) {
            item.status = 'In-Clinic';
            item.checkin = `Checked-In (${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })})`;
            renderCalendarGrid();
            showToast('Student Checked-In', `${item.fullName} is marked In-Clinic. Queue ticket #${item.queue} active.`);
        }
    }

    function quickCheckinAction() {
        if (currentActiveRecord) {
            currentActiveRecord.status = 'In-Clinic';
            currentActiveRecord.checkin = `Checked-In (${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })})`;
            renderCalendarGrid();
            openAppointmentDetailModal(currentActiveRecord.id);
            showToast('Check-In Complete', `Arrival verified for ${currentActiveRecord.fullName}.`);
        }
    }

    function callQueueNumber() {
        if (currentActiveRecord) {
            showToast('Queue Broadcast', `Calling ticket ${currentActiveRecord.queue} to ${currentActiveRecord.room}...`);
        }
    }

    function markCompletedFromDetail() {
        if (currentActiveRecord) {
            currentActiveRecord.status = 'Completed';
            renderCalendarGrid();
            $('#appointmentDetailModal').modal('hide');
            showToast('Appointment Completed', `Consultation record #${currentActiveRecord.aptId} marked completed.`);
        }
    }

    function openRescheduleModalFromDetail() {
        $('#appointmentDetailModal').modal('hide');
        if (currentActiveRecord) {
            $('#newAppointmentModal').modal('show');
            showToast('Reschedule Slot', `Select new date/time slot for ${currentActiveRecord.fullName}.`);
        }
    }

    // Save New Appointment
    function saveNewAppointment(e) {
        e.preventDefault();
        const studentVal = document.getElementById('formAptStudent').value;
        if (!studentVal) return;

        const [fullName, lrn, gradeStrand, contact, avatar] = studentVal.split('|');
        const type = document.getElementById('formAptType').value;
        const doctor = document.getElementById('formAptDoctor').value;
        const date = document.getElementById('formAptDate').value;
        const time = document.getElementById('formAptTime').value;
        const room = document.getElementById('formAptRoom').value;
        const status = document.getElementById('formAptStatus').value;
        const purpose = document.getElementById('formAptPurpose').value;

        const newId = `#APT-2026-${110 + appointmentDataset.length}`;
        const newRecord = {
            id: appointmentDataset.length + 1,
            aptId: newId,
            date: date,
            time: time,
            lrn: lrn,
            fullName: fullName,
            avatar: avatar,
            grade: gradeStrand.split(' - ')[0],
            strand: gradeStrand.split(' - ')[1] || 'STEM',
            contact: contact,
            type: type,
            typeLabel: type,
            doctor: doctor,
            room: room,
            status: status,
            checkin: 'Scheduled',
            queue: `#Q-${100 + appointmentDataset.length}`,
            purpose: purpose,
            instructions: 'Wear comfortable attire. Arrive 10 minutes before the scheduled time slot.',
            clinicalNotes: 'Scheduled booking created in clinic calendar.',
            outcome: 'Pending Examination',
            followup: 'To be determined by attending clinician.'
        };

        appointmentDataset.push(newRecord);
        selectedDateStr = date;
        renderCalendarGrid();

        $('#newAppointmentModal').modal('hide');
        e.target.reset();

        showToast('Appointment Scheduled!', `Booking ${newRecord.aptId} reserved for ${newRecord.fullName} on ${date}.`);
    }

    // Toast Utility
    function showToast(title, msg) {
        document.getElementById('toastTitle').innerText = title;
        document.getElementById('toastMessage').innerText = msg;
        $('#toastNotification').fadeIn().delay(3500).fadeOut();
    }

    // Print & Export
    function exportAppointmentData() {
        showToast('Export Initiated', 'Exporting appointment roster (CSV format)...');
    }

    function printCalendarSchedule() {
        window.print();
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        renderCalendarGrid();
    });
</script>