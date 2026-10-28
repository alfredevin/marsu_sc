<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: AUDIT TRAIL & ACTIVITY LOGS          -->
<!-- ==================================================================== -->

<!-- RA 10173 MANDATORY AUDIT BANNER -->
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert" style="border-radius: 8px;">
    <i class="bi bi-shield-shaded fs-3 text-warning"></i>
    <div>
        <strong class="d-block text-dark">Data Privacy Act (RA 10173) Continuous Security Audit Trail</strong>
        <span class="small text-muted">All system events, user authentications, record modifications, and clinical dossier accesses are cryptographically timestamped and logged for non-repudiation. In compliance with strict privacy standards, passwords, session tokens, and clinical session narratives are never stored in audit payloads.</span>
    </div>
</div>

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 15px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 500;">
                    Guidance & Counseling Services
                </a>
            </li>
            <li class="breadcrumb-item">
                <span style="color: #800020; text-decoration: none; font-weight: 500;">User Management</span>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Activity Logs
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Security Audit Trail & System Activity Logs
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Review chronological audit events, monitor access to counseling files, and inspect operator authorization trails in compliance with RA 10173.
            </p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn text-white px-3 shadow-none d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#modal-export-audit-log"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14.5px; border-radius: 4px; height: 38px;">
                <i class="bi bi-download me-1.5"></i>Export Audit Log
            </button>
        </div>
    </div>
</div>

<!-- 4 KPI SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #800020 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        LOGGED EVENTS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">1,428</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #FDF2F4; color: #800020;">
                    <i class="bi bi-journal-text"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14px; color: #718096;">Total chronological trail events</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #28a745 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        SUCCESSFUL ACTIONS
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">1,398</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #f4fbf6; color: #28a745; border: 1px solid #c8e6c9;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14px; color: #718096;">97.9% authorized completion rate</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #c53030 !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        SECURITY ALERTS & DENIED
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">14</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #fff5f5; color: #c53030; border: 1px solid #feb2b2;">
                    <i class="bi bi-shield-slash-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14px; color: #718096;">Auth failures & gate violations</div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="card shadow-sm p-3.5 h-100 d-flex flex-column justify-content-between"
            style="border: 1px solid #E2E8F0; border-left: 4px solid #3182ce !important; border-radius: 8px; background-color: #ffffff; min-height: 110px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; text-transform: uppercase;">
                        CLINICAL DOSSIER ACCESSED
                    </div>
                    <div class="mt-1" style="font-size: 26px; font-weight: 700; color: #1A202C; line-height: 1.1;">22</div>
                </div>
                <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #ebf8ff; color: #3182ce; border: 1px solid #bee3f8;">
                    <i class="bi bi-eye-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size: 14px; color: #718096;">Verified licensed counselor reads</div>
        </div>
    </div>
</div>

<!-- SEARCH & FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-3.5 px-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-5 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white" style="border-color: #ced4da; font-size: 15px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="auditSearchInput" class="form-control border-start-0 shadow-none"
                        placeholder="Search by Event ID, User ID, Action, or Resource Reference..."
                        style="font-size: 15px; height: 40px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-12">
                <select id="actionCategoryFilter" class="form-select shadow-none" style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>All Event Categories</option>
                    <option value="Authentication">Authentication (Logins)</option>
                    <option value="Account Management">Account & Role Management</option>
                    <option value="Appointments">Appointments & Schedules</option>
                    <option value="Referrals">Referrals & Endorsements</option>
                    <option value="Cases & Clinical">Cases, Sessions & Plans</option>
                    <option value="Assessments">Psychological Assessments</option>
                    <option value="Data Export">Data Exports & Security</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-4 col-12">
                <select id="outcomeFilter" class="form-select shadow-none" style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>All Outcomes</option>
                    <option value="Success">Success</option>
                    <option value="Failed">Failed</option>
                    <option value="Access Denied">Access Denied</option>
                    <option value="Security Flagged">Security Flagged</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-4 col-12">
                <select id="dateRangeFilter" class="form-select shadow-none" style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="today" selected>Today</option>
                    <option value="7days">Last 7 Days</option>
                    <option value="30days">Last 30 Days</option>
                    <option value="all">Full History</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- AUDIT TRAIL LOG TABLE -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-3 px-md-4" style="border-bottom: 1px solid #E2E8F0 !important; background-color: #ffffff;">
        <div>
            <h6 class="m-0 fw-bold" style="font-size: 16px; color: #800020;">
                <i class="bi bi-shield-check me-2" style="color: #D4A017;"></i>System Security Audit Ledger
            </h6>
            <div class="text-muted small mt-0.5">Immutable audit event records with non-repudiation correlation IDs and minimal non-sensitive metadata.</div>
        </div>
        <span class="badge text-dark bg-light border px-2.5 py-1.5" style="font-size: 13px; font-weight: 500;">
            Showing 12 Comprehensive Audit Records
        </span>
    </div>

    <div class="card-body p-0" style="background-color: #ffffff;">
        <div class="table-responsive" style="background-color: #ffffff;">
            <table class="table table-hover align-middle mb-0" id="auditTrailTable" style="background-color: #ffffff;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-3 ps-md-4" style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 140px; color: #2D3748;">
                            Event ID
                        </th>
                        <th style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 160px; color: #2D3748;">
                            Timestamp
                        </th>
                        <th style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 190px; color: #2D3748;">
                            User & Role
                        </th>
                        <th style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 200px; color: #2D3748;">
                            Action Executed
                        </th>
                        <th style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 140px; color: #2D3748;">
                            Resource Type
                        </th>
                        <th style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 140px; color: #2D3748;">
                            Reference
                        </th>
                        <th class="text-center" style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 120px; color: #2D3748;">
                            Outcome
                        </th>
                        <th style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; min-width: 150px; color: #2D3748;">
                            Correlation ID
                        </th>
                        <th class="text-center" style="font-size: 14.5px; font-weight: 600; padding: 14px 16px; vertical-align: middle; width: 110px; color: #2D3748;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Event 1: Case Session Note Update -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1049</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 24, 2026 &bull; 09:30 AM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Dr. Maria Ramos</span>
                            <small class="text-muted">Guidance Counselor (RGC)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Update Session Clinical Progress</span>
                            <small class="text-muted">Documented session intervention goals</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Counseling Case</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>CS-2026-002</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_9f2a81b0</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-1"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 2: Authorization Failure -->
                    <tr style="background-color: #fffafb;">
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1048</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 24, 2026 &bull; 09:12 AM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Mark Joseph Navarro</span>
                            <small class="text-muted">Guidance Office Staff</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-danger">Unauthorized Clinical Note Read</span>
                            <small class="text-muted">Attempted access to restricted clinical note</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Case Note</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>CS-2026-002</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #dc3545; background-color: #fff5f5; color: #721c24; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Access Denied</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_4c1e7d82</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-2"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 3: Successful Login -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1047</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 24, 2026 &bull; 08:30 AM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Alex Reyes</span>
                            <small class="text-muted">Guidance Counselor (RGC)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">User Authentication (Login)</span>
                            <small class="text-muted">Multi-factor institutional login verified</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Authentication</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>EMP-GCO-002</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_1a7b9c3e</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-3"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 4: Failed Login -->
                    <tr style="background-color: #fffafb;">
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1046</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 24, 2026 &bull; 08:24 AM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Unknown / Guest</span>
                            <small class="text-muted">IP: 192.168.10.88</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-danger">Failed Login Attempt</span>
                            <small class="text-muted">Invalid credentials supplied (3rd retry)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Authentication</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="text-muted">username: admin_sec</span></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #dc3545; background-color: #fff5f5; color: #721c24; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Failed</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_6e2b4f10</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-4"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 5: Appointment Rescheduling -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1045</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 23, 2026 &bull; 03:45 PM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Mark Joseph Navarro</span>
                            <small class="text-muted">Guidance Office Staff</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Reschedule Appointment Booking</span>
                            <small class="text-muted">Adjusted slot due to midterm schedule conflict</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Appointment</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>APT-2026-004</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_3b8a1c9d</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-5"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 6: Referral Endorsement Issued -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1044</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 23, 2026 &bull; 02:15 PM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Dr. Maria Ramos</span>
                            <small class="text-muted">Head Guidance Counselor (RGC)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Issue External Agency Referral</span>
                            <small class="text-muted">Endorsed to Provincial Health Office (PHO)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Referral</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>REF-EXT-2026-001</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_7d1e9f02</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-6"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 7: Case Closure -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1043</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 23, 2026 &bull; 11:30 AM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Alex Reyes</span>
                            <small class="text-muted">Guidance Counselor (RGC)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Close Counseling Case (Resolved)</span>
                            <small class="text-muted">Client goals reached & exit interview done</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Counseling Case</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>CS-2026-001</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_5a4c2e8b</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-7"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 8: Assessment Battery Scored -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1042</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 22, 2026 &bull; 04:10 PM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Elena Bautista</span>
                            <small class="text-muted">Guidance Psychometrician (RPm)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Score Standardized Assessment Battery</span>
                            <small class="text-muted">DASS-21 score computed and normalized</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Assessment</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>GDA-2026-001</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_8b3d6f1a</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-8"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 9: Counseling Plan Updated -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1041</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 22, 2026 &bull; 02:45 PM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Cristina Valderrama</span>
                            <small class="text-muted">Guidance Counselor (RGC)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Update Counseling Intervention Plan</span>
                            <small class="text-muted">Revision 2: Added coping strategies</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Counseling Plan</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>CLP-2026-001</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_2f9c4a80</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-9"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 10: Role / Permission Change -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1040</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 22, 2026 &bull; 10:15 AM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Engr. Alan Torres</span>
                            <small class="text-muted">System Administrator</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Modify RBAC Role Permissions</span>
                            <small class="text-muted">Updated permissions for Guidance Staff role</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">RBAC Matrix</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>ROLE-STAFF</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_0e7a1b4d</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-10"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 11: Data Export Execution -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1039</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 21, 2026 &bull; 04:30 PM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Dr. Maria Ramos</span>
                            <small class="text-muted">Head Guidance Counselor (RGC)</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Export Service Utilization Report</span>
                            <small class="text-muted">Generated anonymized quarterly statistics</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">Report Export</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>REP-2026-Q1</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_4d8e2c9f</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-11"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <!-- Event 12: Account Deactivation -->
                    <tr>
                        <td class="ps-3 ps-md-4 fw-semibold" style="padding: 14px 16px; vertical-align: middle; color: #800020;">EVT-2026-1038</td>
                        <td style="padding: 14px 16px; vertical-align: middle;" class="text-muted">Oct 21, 2026 &bull; 01:20 PM</td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Engr. Alan Torres</span>
                            <small class="text-muted">System Administrator</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;">
                            <span class="d-block fw-semibold text-dark">Deactivate User Account</span>
                            <small class="text-muted">Terminated access for separating employee</small>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><span class="badge bg-light text-dark border">User Account</span></td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code>EMP-GCO-005</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <span class="badge" style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 90px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12.5px;">Success</span>
                        </td>
                        <td style="padding: 14px 16px; vertical-align: middle;"><code class="text-muted">req_9c1b3f7e</code></td>
                        <td class="text-center" style="padding: 14px 16px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modal-view-audit-12"
                                style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;">
                                <i class="bi bi-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: VIEW AUDIT LOG DETAILS (SNAPSHOT)                          -->
<!-- ==================================================================== -->

<!-- Modal: Event 1 (Case Note Update) -->
<div class="modal fade" id="modal-view-audit-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Audit Event Detail: EVT-2026-1049
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 14.5px;">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Authenticated Operator</label>
                        <div class="p-2 border rounded bg-light">Dr. Maria Ramos (EMP-GCO-001)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Role & Clinical License</label>
                        <div class="p-2 border rounded bg-light">Guidance Counselor &bull; RGC-001248 (Valid)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Action Executed</label>
                        <div class="p-2 border rounded bg-light fw-bold text-dark">Update Session Clinical Progress</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Target Resource & Key</label>
                        <div class="p-2 border rounded bg-light">Counseling Case <code>CS-2026-002</code></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Client IP & Workstation</label>
                        <div class="p-2 border rounded bg-light">192.168.10.42 (GCO-CON-01)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Correlation ID</label>
                        <div class="p-2 border rounded bg-light font-monospace">req_9f2a81b0</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Non-Sensitive Structured Metadata (RA 10173 Sanitized)</label>
                    <pre class="p-2.5 border rounded bg-light text-dark font-monospace small mb-0" style="white-space: pre-wrap;">{"event_type": "case_session_update", "case_id": "CS-2026-002", "session_number": 2, "action": "goals_reviewed", "clinical_narrative": "[REDACTED - RA 9258 SEC 27]", "status": "In Progress"}</pre>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Cryptographic Integrity Hash</label>
                    <div class="p-2 border rounded bg-dark text-warning font-monospace small">
                        SHA256: 7f8a3b2c1d4e5f6a9b8c7d6e5f4a3b2c1d0e9f8a7b6c5d4e3f2a1b0c9d8e7f6a
                    </div>
                </div>

                <div class="alert alert-success border small mb-0">
                    <i class="bi bi-check-circle-fill text-success me-1"></i>Cryptographic signature valid. Immutable log record preserved in permanent university security ledger.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-light border-top d-flex justify-content-end">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 14px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Event 2 (Authorization Failure) -->
<div class="modal fade" id="modal-view-audit-2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-slash-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Security Incident Snapshot: EVT-2026-1048
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 14.5px;">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Operator Involved</label>
                        <div class="p-2 border rounded bg-light">Mark Joseph Navarro (EMP-GCO-005)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Role Assigned</label>
                        <div class="p-2 border rounded bg-light">Guidance Office Staff (Administrative)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Violation Attempted</label>
                        <div class="p-2 border rounded bg-light text-danger fw-bold">Read Clinical Case Note (Access Denied)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Enforced Security Gate</label>
                        <div class="p-2 border rounded bg-light"><code>guidance.case.clinical_note</code> (Blocked)</div>
                    </div>
                </div>

                <div class="alert alert-danger border small mb-3">
                    <i class="bi bi-exclamation-octagon-fill me-1"></i><strong>RBAC Security Interception:</strong> User role lacks PRC Guidance Counselor license required under RA 9258 Section 27. Access blocked automatically at middleware gate.
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Cryptographic Incident Signature</label>
                    <div class="p-2 border rounded bg-dark text-danger font-monospace small">
                        SHA256: 3c2b1a0f9e8d7c6b5a4f3e2d1c0b9a8f7e6d5c4b3a2f1e0d9c8b7a6f5e4d3c2b
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-light border-top d-flex justify-content-end">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 14px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Event 3 (Login Success) -->
<div class="modal fade" id="modal-view-audit-3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title fs-6 fw-bold">Audit Event Detail: EVT-2026-1047 (Authentication)</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 14.5px;">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Authenticated User</label>
                        <div class="p-2 border rounded bg-light">Alex Reyes (a.reyes@marsu.edu.ph)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Authentication Method</label>
                        <div class="p-2 border rounded bg-light">Institutional SSO + Password Hash (Argon2id)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">IP Address & Location</label>
                        <div class="p-2 border rounded bg-light">192.168.10.45 &bull; CAS Faculty Hall</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Session Token Nonce</label>
                        <div class="p-2 border rounded bg-light font-monospace text-muted">sess_nonce_829104</div>
                    </div>
                </div>
                <div class="alert alert-light border small text-muted mb-0">
                    <i class="bi bi-shield-check text-success me-1"></i>Password secrets and plaintext tokens are never recorded in audit payloads per RA 10173 standards.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-light border-top d-flex justify-content-end">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 14px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Generic View Modals for Remaining Events (4 to 12) -->
<?php for ($i = 4; $i <= 12; $i++): ?>
<div class="modal fade" id="modal-view-audit-<?= $i ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Audit Event Detail: EVT-2026-10<?= (50 - $i) ?>
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 14.5px;">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Event Reference ID</label>
                        <div class="p-2 border rounded bg-light font-monospace">EVT-2026-10<?= (50 - $i) ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Timestamp (UTC+8)</label>
                        <div class="p-2 border rounded bg-light text-muted">October 2026 &bull; Verified Timestamp</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Security Gate Verified</label>
                        <div class="p-2 border rounded bg-light"><code>guidance.audit.verified</code></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Payload Protection Status</label>
                        <div class="p-2 border rounded bg-light text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i>RA 10173 Sanitized</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Cryptographic Integrity Hash</label>
                    <div class="p-2 border rounded bg-dark text-warning font-monospace small">
                        SHA256: <?= hash('sha256', 'evt_seed_' . $i) ?>
                    </div>
                </div>
                <div class="alert alert-light border small text-muted mb-0">
                    <i class="bi bi-info-circle me-1"></i>Audit records are write-once, append-only, and permanently locked against manual deletion or tampering.
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-light border-top d-flex justify-content-end">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 14px; height: 34px;">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endfor; ?>

<!-- ==================================================================== -->
<!--   MODAL: EXPORT AUDIT LOG                                            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-export-audit-log" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-download text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Export Security Audit Trail
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 14.5px;">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Audit Date Scope</label>
                        <select class="form-select" style="font-size: 14px;">
                            <option value="today">Today's Transactions</option>
                            <option value="7days">Past 7 Days</option>
                            <option value="30days" selected>Past 30 Days (A.Y. 2026-2027)</option>
                            <option value="semester">Entire Semester</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Export Format</label>
                        <select class="form-select" style="font-size: 14px;">
                            <option value="csv" selected>CSV (Encrypted Spreadsheet)</option>
                            <option value="pdf">PDF (Official Institutional Report)</option>
                        </select>
                    </div>
                    <div class="alert alert-warning border small mb-0">
                        <i class="bi bi-shield-shaded me-1"></i>Exporting audit ledgers is logged as an autonomous security event under <code>guidance.data.export</code>.
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 14px; height: 34px;">Cancel</button>
                    <button type="submit" class="btn text-white px-3 shadow-none" style="background-color: #800020; border: 1px solid #800020; font-size: 14px; height: 34px;">
                        <i class="bi bi-file-earmark-arrow-down me-1"></i>Generate Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
