<!-- ==================================================================== -->
<!--   MARINDUQUE STATE UNIVERSITY - GUIDANCE & COUNSELING SERVICES       -->
<!--   ROLE-BASED DASHBOARD: ADMIN | COUNSELOR | STAFF | STUDENT          -->
<!-- ==================================================================== -->

<!-- DATA PRIVACY ACT COMPLIANCE BANNER -->
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert" style="border-radius: 8px;">
    <i class="bi bi-shield-lock-fill fs-3 text-warning"></i>
    <div style="font-size: 14.5px;">
        <strong class="d-block text-dark" style="font-size: 15px;">Confidentiality Protected under Republic Act 9258 (Guidance and Counseling Act) & RA 10173 (Data Privacy Act of 2012)</strong>
        <span class="text-muted">All records in this module are strictly confidential. Sensitive counseling notes, diagnostic intake records, and student disclosures are restricted to authorized personnel. Telemetry is anonymized in accordance with university policy.</span>
    </div>
</div>

<!-- PAGE HEADER & ROLE DASHBOARD SWITCHER -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pb-3 border-bottom">
            <div>
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb mb-0" style="font-size: 14.5px;">
                        <li class="breadcrumb-item"><a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;"><i class="bi bi-house-door-fill me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active text-muted" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Guidance & Counseling Central Dashboard
                </h4>
                <p class="text-muted mb-0" style="font-size: 14.5px;">
                    Integrated role-specific workspace for Administrators, Guidance Counselors, Staff, and Students.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center justify-content-center"
                    data-bs-toggle="modal" data-bs-target="#newRecordModal"
                    style="background-color: #800020; border: 1px solid #800020; font-size: 15px; font-weight: 500; height: 38px; border-radius: 6px; padding: 0 16px;">
                    <i class="bi bi-plus-lg me-1.5"></i>New Record Entry
                </button>
            </div>
        </div>

        <!-- ROLE NAVIGATION TABS -->
        <div class="pt-3">
            <div class="text-muted small fw-semibold text-uppercase mb-2" style="letter-spacing: 0.5px;">Select Active Dashboard View</div>
            <ul class="nav nav-pills gap-2 flex-wrap" id="dashboardRoleTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold d-inline-flex align-items-center gap-2" id="pill-admin-tab"
                        data-bs-toggle="pill" data-bs-target="#pill-admin" type="button" role="tab"
                        style="border: 1px solid #800020; background-color: #800020; color: #ffffff; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                        <i class="bi bi-shield-shaded"></i>Administrator Dashboard
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold d-inline-flex align-items-center gap-2" id="pill-counselor-tab"
                        data-bs-toggle="pill" data-bs-target="#pill-counselor" type="button" role="tab"
                        style="border: 1px solid #E2E8F0; background-color: #F8FAFC; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                        <i class="bi bi-person-heart text-danger"></i>Counselor Dashboard
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold d-inline-flex align-items-center gap-2" id="pill-staff-tab"
                        data-bs-toggle="pill" data-bs-target="#pill-staff" type="button" role="tab"
                        style="border: 1px solid #E2E8F0; background-color: #F8FAFC; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                        <i class="bi bi-briefcase-fill text-primary"></i>Guidance Staff Dashboard
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold d-inline-flex align-items-center gap-2" id="pill-student-tab"
                        data-bs-toggle="pill" data-bs-target="#pill-student" type="button" role="tab"
                        style="border: 1px solid #E2E8F0; background-color: #F8FAFC; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                        <i class="bi bi-mortarboard-fill text-success"></i>Student Portal Dashboard
                    </button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   TAB CONTENT CONTAINER                                              -->
<!-- ==================================================================== -->
<div class="tab-content" id="dashboardRoleTabContent">

    <!-- ================================================================ -->
    <!--   1. ADMINISTRATOR DASHBOARD                                     -->
    <!-- ================================================================ -->
    <div class="tab-pane fade show active" id="pill-admin" role="tabpanel">
        <!-- 4 KPI Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">REGISTERED STUDENTS</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">1,248</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Total enrolled student profiles</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #2b6cb0 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">ACTIVE USER ACCOUNTS</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">28</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8;">
                            <i class="bi bi-person-badge"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">12 Counselors &bull; 16 Staff & Personnel</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #d4a017 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">APPOINTMENTS THIS MONTH</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">42</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e;">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">39 Completed &bull; 3 Pending Review</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">ACTIVE COUNSELING CASES</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">14</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Aggregate metric &bull; Zero identifying data</div>
                </div>
            </div>
        </div>

        <!-- 2 Column Admin Grid -->
        <div class="row g-4 mb-4">
            <!-- Left: Guidance Programs Statistics & Quick Shortcuts -->
            <div class="col-lg-7 col-12">
                <div class="card shadow-sm border-0 h-100" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                            <i class="bi bi-bar-chart-fill me-2 text-warning"></i>Guidance Program Reach & Participation
                        </h6>
                        <a href="<?= url('guidance/guidance_program_reports') ?>" class="text-decoration-none small fw-semibold" style="color: #800020;">View Full Report &rarr;</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>Mental Health Awareness Week (4Seminars)</span>
                                <span class="text-dark">485 / 500 Attendees (97%)</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar" style="width: 97%; background-color: #800020;"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>Freshmen Adjustment & Academic Orientation</span>
                                <span class="text-dark">340 / 350 Students (97%)</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar" style="width: 97%; background-color: #2b6cb0;"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>RIASEC Career Guidance Workshop for Graduating Seniors</span>
                                <span class="text-dark">210 / 250 Students (84%)</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar" style="width: 84%; background-color: #28a745;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between small fw-semibold mb-1">
                                <span>Peer Facilitators Leadership Training</span>
                                <span class="text-dark">42 / 45 Facilitators (93%)</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar" style="width: 93%; background-color: #d4a017;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: System Activity Summary & Security Alerts -->
            <div class="col-lg-5 col-12">
                <div class="card shadow-sm border-0 h-100" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                            <i class="bi bi-shield-exclamation me-2 text-danger"></i>Security & System Alerts
                        </h6>
                        <span class="badge bg-light text-secondary border">Audited</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-light border d-flex gap-2.5 mb-3 p-2.5 rounded" style="font-size: 13.5px;">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <strong class="d-block text-dark">Data Privacy Audit Compliant</strong>
                                <span class="text-muted">Quarterly access logs verified for RA 10173 statutory compliance.</span>
                            </div>
                        </div>
                        <div class="alert alert-light border d-flex gap-2.5 mb-3 p-2.5 rounded" style="font-size: 13.5px;">
                            <i class="bi bi-info-circle-fill text-primary fs-5"></i>
                            <div>
                                <strong class="d-block text-dark">Automatic Session Expiry Active</strong>
                                <span class="text-muted">Counselor workstation idle timer configured to 30 minutes.</span>
                            </div>
                        </div>
                        <div class="alert alert-light border d-flex gap-2.5 mb-0 p-2.5 rounded" style="font-size: 13.5px;">
                            <i class="bi bi-bell-fill text-warning fs-5"></i>
                            <div>
                                <strong class="d-block text-dark">3 Intake Requests Awaiting Assignment</strong>
                                <span class="text-muted">Action required by Lead Counselor / Office Admin.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!--   2. COUNSELOR DASHBOARD                                         -->
    <!-- ================================================================ -->
    <div class="tab-pane fade" id="pill-counselor" role="tabpanel">
        <!-- 4 KPI Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">TODAY'S APPOINTMENTS</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">2</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">10:00 AM &bull; 02:30 PM Scheduled</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #3182ce !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">UPCOMING SESSIONS</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">5</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #ebf8ff; color: #3182ce; border: 1px solid #bee3f8;">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Sessions within next 7 days</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">ASSIGNED ACTIVE CASES</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">6</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                            <i class="bi bi-journal-check"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Ongoing individual counseling cases</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #c53030 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">FOLLOW-UPS DUE / OVERDUE</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">2</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fff5f5; color: #c53030; border: 1px solid #feb2b2;">
                            <i class="bi bi-bell-fill"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">1 Due Today &bull; 1 Overdue Checkpoint</div>
                </div>
            </div>
        </div>

        <!-- Counselor Schedule & Case Activity Tables -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 h-100" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                            <i class="bi bi-calendar-event me-2 text-primary"></i>Counselor's Scheduled Consultations
                        </h6>
                        <a href="<?= url('guidance/session_calendar') ?>" class="text-decoration-none small fw-semibold" style="color: #800020;">Calendar View &rarr;</a>
                    </div>
                    <div class="table-responsive" style="background-color: #ffffff;">
                        <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th class="ps-4" style="font-size: 14px; padding: 12px 16px;">Time</th>
                                    <th style="font-size: 14px; padding: 12px 16px;">Student Name</th>
                                    <th style="font-size: 14px; padding: 12px 16px;">Type & Mode</th>
                                    <th class="text-center" style="font-size: 14px; padding: 12px 16px;">Status</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px;">
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark">10:00 AM</td>
                                    <td class="fw-bold text-dark">RAMOS, CARLOS M.</td>
                                    <td>Academic Burnout <span class="badge bg-light text-secondary border ms-1">In-Person</span></td>
                                    <td class="text-center"><span class="badge" style="background-color: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8;">Confirmed</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark">02:30 PM</td>
                                    <td class="fw-bold text-dark">SANTOS, MARIA C.</td>
                                    <td>Career Goal Setting <span class="badge bg-light text-secondary border ms-1">Online</span></td>
                                    <td class="text-center"><span class="badge" style="background-color: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8;">Confirmed</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 fw-semibold text-muted">Tomorrow 09:00 AM</td>
                                    <td class="fw-bold text-dark">DELA CRUZ, BEA L.</td>
                                    <td>Routine Intake <span class="badge bg-light text-secondary border ms-1">In-Person</span></td>
                                    <td class="text-center"><span class="badge" style="background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e;">Scheduled</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 h-100" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                            <i class="bi bi-clock-history me-2 text-warning"></i>Cases Awaiting Review & Follow-Ups
                        </h6>
                        <a href="<?= url('guidance/case_progress') ?>" class="text-decoration-none small fw-semibold" style="color: #800020;">Case Progress &rarr;</a>
                    </div>
                    <div class="card-body p-3">
                        <div class="p-3 border rounded mb-2.5 bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-danger-subtle text-danger mb-1">Overdue Follow-Up</span>
                                <div class="fw-bold text-dark" style="font-size: 14.5px;">MENDOZA, JUAN B. (CAS-2026-042)</div>
                                <div class="text-muted small">Midterm attendance checkpoint was due Oct 20, 2026.</div>
                            </div>
                            <a href="<?= url('guidance/follow_up') ?>" class="btn btn-sm btn-outline-danger shadow-none" style="font-size: 12.5px; height: 32px; padding: 0 12px; display: inline-flex; align-items: center;">Contact</a>
                        </div>
                        <div class="p-3 border rounded bg-white d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-warning-subtle text-warning mb-1">Case Review Scheduled</span>
                                <div class="fw-bold text-dark" style="font-size: 14.5px;">RAMOS, CARLOS M. (CAS-2026-081)</div>
                                <div class="text-muted small">Counseling plan evaluation checkpoint scheduled for Nov 03, 2026.</div>
                            </div>
                            <a href="<?= url('guidance/counseling_plans') ?>" class="btn btn-sm btn-outline-secondary shadow-none" style="font-size: 12.5px; height: 32px; padding: 0 12px; display: inline-flex; align-items: center;">Review</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!--   3. GUIDANCE STAFF DASHBOARD                                    -->
    <!-- ================================================================ -->
    <div class="tab-pane fade" id="pill-staff" role="tabpanel">
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">REQUESTS FOR ACTION</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">3</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                            <i class="bi bi-inbox-fill"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Appointment requests to approve/assign</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">SCHEDULE CONFLICTS</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">0</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                            <i class="bi bi-check-all"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">All counselor calendars synchronized</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #3182ce !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">ADMIN TASK QUEUE</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">4</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #ebf8ff; color: #3182ce; border: 1px solid #bee3f8;">
                            <i class="bi bi-list-task"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Profile verifications & document archiving</div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="card shadow-sm p-3 h-100 d-flex flex-column justify-content-between"
                    style="border: 1px solid #E2E8F0; border-left: 4px solid #d4a017 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">ROOM AVAILABILITY</div>
                            <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">3 / 3</div>
                        </div>
                        <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e;">
                            <i class="bi bi-door-open-fill"></i>
                        </div>
                    </div>
                    <div class="mt-2" style="font-size: 14.5px; color: #718096;">Consultation Rooms 101, 102, 103 open</div>
                </div>
            </div>
        </div>

        <!-- Staff Action Queue Table -->
        <div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                    <i class="bi bi-clipboard2-check me-2 text-primary"></i>Appointment Requests Requiring Action
                </h6>
                <a href="<?= url('guidance/appointment_requests') ?>" class="text-decoration-none small fw-semibold" style="color: #800020;">Process All Requests &rarr;</a>
            </div>
            <div class="table-responsive" style="background-color: #ffffff;">
                <table class="table table-hover align-middle mb-0" style="background-color: #ffffff;">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="ps-4" style="font-size: 14px; padding: 12px 16px;">Request ID</th>
                            <th style="font-size: 14px; padding: 12px 16px;">Student Name</th>
                            <th style="font-size: 14px; padding: 12px 16px;">Requested Date & Time</th>
                            <th style="font-size: 14px; padding: 12px 16px;">Assigned Counselor</th>
                            <th class="text-center" style="font-size: 14px; padding: 12px 16px;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        <tr>
                            <td class="ps-4 fw-semibold text-marsu-burgundy" style="color: #800020;">REQ-2026-081</td>
                            <td class="fw-bold text-dark">DELA CRUZ, BEA L. (2024-03115)</td>
                            <td>Oct 24, 2026 &bull; 09:30 AM</td>
                            <td><span class="badge bg-light text-dark border">Unassigned</span></td>
                            <td class="text-center">
                                <a href="<?= url('guidance/appointment_requests') ?>" class="btn btn-sm btn-outline-secondary" style="font-size: 13px; height: 32px; padding: 0 12px; display: inline-flex; align-items: center;">Assign</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-semibold text-marsu-burgundy" style="color: #800020;">REQ-2026-079</td>
                            <td class="fw-bold text-dark">SANTOS, MARIA C. (2023-01042)</td>
                            <td>Oct 25, 2026 &bull; 02:00 PM</td>
                            <td>Dr. Maria Corazon Ramos, RGC</td>
                            <td class="text-center">
                                <a href="<?= url('guidance/appointment_requests') ?>" class="btn btn-sm btn-outline-secondary" style="font-size: 13px; height: 32px; padding: 0 12px; display: inline-flex; align-items: center;">Review</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!--   4. STUDENT PORTAL DASHBOARD                                    -->
    <!-- ================================================================ -->
    <div class="tab-pane fade" id="pill-student" role="tabpanel">
        <!-- Friendly Welcome Banner -->
        <div class="card shadow-sm border-0 mb-4 text-white" style="background: linear-gradient(135deg, #800020 0%, #4A0012 100%); border-radius: 10px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge mb-2" style="background-color: rgba(255, 255, 255, 0.2); font-size: 12px; font-weight: 500;">MarSU Student Counseling Support</span>
                        <h4 class="fw-bold mb-1" style="font-size: 22px;">Welcome back, RAMOS, CARLOS M.!</h4>
                        <p class="mb-0 text-white-50" style="font-size: 15px; max-width: 650px;">
                            The Guidance and Counseling Center provides confidential consultation, academic coaching, and mental wellness support. We are here to support your holistic student growth.
                        </p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-light shadow-sm d-inline-flex align-items-center justify-content-center"
                            data-bs-toggle="modal" data-bs-target="#modal-student-request-appointment"
                            style="color: #800020; font-weight: 600; font-size: 15px; height: 40px; border-radius: 6px; padding: 0 18px;">
                            <i class="bi bi-calendar-plus me-2"></i>Request an Appointment
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student 3 KPI Overview Cards -->
        <div class="row g-3 mb-4">
            <div class="col-lg-4 col-12">
                <div class="card shadow-sm p-3 h-100" style="border: 1px solid #E2E8F0; border-radius: 8px; background-color: #ffffff;">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; background-color: #800020;">
                            <i class="bi bi-person-badge fs-5"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Student Profile</div>
                            <div class="fw-bold text-dark" style="font-size: 15px;">2023-01089 &bull; BSIS 2nd Year</div>
                        </div>
                    </div>
                    <div class="text-muted small">Assigned Counselor: <strong>Dr. Maria Corazon Ramos, RGC</strong></div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="card shadow-sm p-3 h-100" style="border: 1px solid #E2E8F0; border-radius: 8px; background-color: #ffffff;">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; background-color: #28a745;">
                            <i class="bi bi-calendar-check fs-5"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Next Consultation</div>
                            <div class="fw-bold text-dark" style="font-size: 15px;">Oct 28, 2026 &bull; 10:00 AM</div>
                        </div>
                    </div>
                    <div class="text-muted small">Status: <span class="badge" style="background-color: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8;">Confirmed (In-Person)</span></div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="card shadow-sm p-3 h-100" style="border: 1px solid #E2E8F0; border-radius: 8px; background-color: #ffffff;">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; background-color: #3182ce;">
                            <i class="bi bi-clipboard2-check fs-5"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Assigned Assessments</div>
                            <div class="fw-bold text-dark" style="font-size: 15px;">1 Pending &bull; 1 Completed</div>
                        </div>
                    </div>
                    <div class="text-muted small">RIASEC Career Questionnaire due Oct 30, 2026</div>
                </div>
            </div>
        </div>

        <!-- Student Instructions & Announcements -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 h-100" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                            <i class="bi bi-info-circle me-2 text-primary"></i>Counselor Guidance Instructions for You
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light border rounded mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-check2-circle text-success fs-5"></i>
                                <span class="fw-bold text-dark" style="font-size: 14.5px;">Follow-Up Checkpoint Instructions</span>
                            </div>
                            <p class="text-muted small mb-0">
                                Please bring your weekly study schedule and completed midterm self-reflection log to your upcoming session on October 28 at Room 102.
                            </p>
                        </div>
                        <div class="p-3 bg-light border rounded">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-shield-check text-primary fs-5"></i>
                                <span class="fw-bold text-dark" style="font-size: 14.5px;">Student Privacy Notice</span>
                            </div>
                            <p class="text-muted small mb-0">
                                In full compliance with RA 10173 and RA 9258, your consultation details and session discussion remain completely confidential and are not shared with teachers or other students.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 h-100" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h6 class="m-0 fw-bold" style="color: #800020; font-size: 16px;">
                            <i class="bi bi-megaphone me-2 text-warning"></i>Guidance Office Announcements
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                            <div class="text-center p-2 rounded text-white" style="background-color: #800020; min-width: 50px; height: 55px;">
                                <div class="fw-bold" style="font-size: 16px;">28</div>
                                <div style="font-size: 11px;">OCT</div>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14.5px;">Mental Wellness & Stress Coping Webinar</h6>
                                <p class="text-muted small mb-0">Join our online interactive session on managing university workloads and stress reduction techniques.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="text-center p-2 rounded text-white" style="background-color: #3182ce; min-width: 50px; height: 55px;">
                                <div class="fw-bold" style="font-size: 16px;">05</div>
                                <div style="font-size: 11px;">NOV</div>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14.5px;">University Career & Internship Fair 2026</h6>
                                <p class="text-muted small mb-0">Meet industry partners, explore internship paths, and participate in walk-in resume polishing booths.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ==================================================================== -->
<!--   MODAL: NEW RECORD ENTRY (Standard Core Helper)                     -->
<!-- ==================================================================== -->
<div class="modal fade" id="newRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 m-0 fw-semibold"><i class="bi bi-plus-circle me-2"></i>Create New Guidance Entry</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('guidance/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Title / Designation <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm bg-white" required placeholder="e.g. Assessment Report / Transaction / Case Reference">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Description / Observations</label>
                        <textarea name="description" class="form-control form-control-sm bg-white" rows="3" placeholder="Enter specific details, remarks, or notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal" style="font-size: 13.5px; height: 34px;">Cancel</button>
                    <button type="submit" class="btn text-white btn-sm px-4 shadow-none" style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px;"><i class="bi bi-check-lg me-1"></i>Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL: STUDENT REQUEST APPOINTMENT (Student Portal)                -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-student-request-appointment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-plus text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Request a Guidance Consultation Appointment
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <!-- Auto-populated Student Info -->
                    <div class="p-3 bg-white border rounded mb-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <span class="text-muted d-block small">Student Name & ID</span>
                                <span class="fw-bold text-dark">RAMOS, CARLOS M. (2023-01089)</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted d-block small">Academic Program</span>
                                <span class="fw-bold text-dark">BS Information Systems &bull; 2nd Year</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Preferred Appointment Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm bg-white" required value="2026-10-28">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Preferred Time Slot <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required>
                                <option value="09:00 AM - 10:00 AM">09:00 AM - 10:00 AM</option>
                                <option value="10:00 AM - 11:00 AM" selected>10:00 AM - 11:00 AM</option>
                                <option value="01:30 PM - 02:30 PM">01:30 PM - 02:30 PM</option>
                                <option value="02:30 PM - 03:30 PM">02:30 PM - 03:30 PM</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Consultation Type <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required>
                                <option value="Academic Concerns">Academic Concerns & Study Coaching</option>
                                <option value="Career Guidance">Career Guidance & Pathway Planning</option>
                                <option value="Personal Concerns">Personal Well-Being & Adjustment</option>
                                <option value="Social Interpersonal">Social or Interpersonal Concerns</option>
                                <option value="Other Concerns">Other Guidance Concerns</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Preferred Consultation Mode <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required>
                                <option value="In-Person">In-Person (Guidance Office Room 102)</option>
                                <option value="Online">Online Video Consultation (Google Meet)</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Preferred Counselor (Optional)</label>
                            <select class="form-select form-select-sm bg-white">
                                <option value="">No preference (Any available registered counselor)</option>
                                <option value="Dr. Maria Corazon Ramos, RGC">Dr. Maria Corazon Ramos, RGC</option>
                                <option value="Alex Reyes, RGC">Alex Reyes, RGC</option>
                                <option value="Cristina Valderrama, RGC">Cristina Valderrama, RGC</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Brief Description of Concern <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm bg-white" rows="3" required placeholder="Briefly describe what you would like to discuss with the guidance counselor..."></textarea>
                    </div>

                    <div class="p-2.5 rounded bg-white border text-muted small d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-success fs-5"></i>
                        <span>Your request is kept confidential under Republic Act 10173 and will only be reviewed by registered guidance personnel.</span>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal" style="font-size: 13.5px; height: 34px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-4 shadow-none" data-bs-dismiss="modal" style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px;">
                        <i class="bi bi-send me-1"></i>Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>