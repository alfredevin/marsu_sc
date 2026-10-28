<!-- Residency History View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clock-history me-2 text-gold"></i>Tenant Residency History & Clearance
        </h1>
        <p class="text-muted small mb-0">Historical registry of student stay records, checkout clearance, and past boarding house tenancies across academic years.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/tenants') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-people me-1"></i>Active Tenants
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newHistoryModal">
            <i class="bi bi-plus-lg me-1"></i>Log Clearance / Checkout
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-people-fill me-1"></i>Current Tenants
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/residencyhistory') ?>">
                <i class="bi bi-clock-history me-1"></i>Residency History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-door-open me-1"></i>Room & Inventory
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Total Past Stays</div>
                    <div class="kpi-value text-marsu-burgundy">
                        148
                        <span class="kpi-unit">Records</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Archived Records">
                    <i class="bi bi-journal-check"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-archive-fill text-marsu-burgundy"></i>
                <span>Archived tenancy records</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Cleared Residents</div>
                    <div class="kpi-value text-success">
                        142
                        <span class="kpi-unit">Cleared</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Cleared Tenancies">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-check-circle-fill text-success"></i>
                <span>Complete clearance signed</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-warning h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Pending Clearance</div>
                    <div class="kpi-value text-warning">
                        6
                        <span class="kpi-unit">Accounts</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Pending Clearance">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <span>Unsettled damages / dues</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Avg. Stay Duration</div>
                    <div class="kpi-value text-gold">
                        9.4
                        <span class="kpi-unit">Months</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Tenure Duration">
                    <i class="bi bi-calendar3"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-clock-history text-gold-dark"></i>
                <span>Standard academic tenure</span>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" id="historySearchInput" class="form-control border-start-0" placeholder="Search by student ID, name, or boarding house...">
                </div>
            </div>
            <div class="col-md-3">
                <select id="termFilter" class="form-select form-select-sm">
                    <option value="">All Academic Years</option>
                    <option value="2025-2026 2nd Sem">A.Y. 2025-2026 (2nd Sem)</option>
                    <option value="2025-2026 1st Sem">A.Y. 2025-2026 (1st Sem)</option>
                    <option value="2024-2025">A.Y. 2024-2025</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="statusFilter" class="form-select form-select-sm">
                    <option value="">All Clearance Status</option>
                    <option value="Cleared">Cleared</option>
                    <option value="Key Returned">Pending / Dues</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" id="resetFilterBtn" class="btn btn-outline-secondary btn-sm w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-bookmark me-2 text-gold"></i>Historical Tenancy Registry
        </h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
            <i class="bi bi-download me-1"></i>Export History
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="historyTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Student Resident</th>
                        <th>Boarding House & Room</th>
                        <th>Academic Term</th>
                        <th>Period of Stay</th>
                        <th>Clearance Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody id="historyTableBody">
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Christian Paul Mercene</div>
                            <div class="small text-muted">ID: 22-0189 • BSIT 4A</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-secondary">Villa Marinduque Student Dorm</div>
                            <div class="small text-muted">Room 201 • Bed B</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">A.Y. 2025-2026 2nd Sem</span></td>
                        <td>
                            <div class="small fw-medium">Jan 15, 2026 — Jun 20, 2026</div>
                            <div class="small text-muted">5 Months Stay</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Cleared</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm btn-view-history" 
                                title="View Tenancy & Clearance Details"
                                data-bs-toggle="modal" 
                                data-bs-target="#viewTenancyModal"
                                data-name="Christian Paul Mercene"
                                data-student-id="22-0189"
                                data-program="BS in Information Technology (BSIT 4A)"
                                data-college="College of Information and Computing Sciences (CICS)"
                                data-email="22-0189@marsu.edu.ph"
                                data-contact="0917-882-1492"
                                data-gender="Male"
                                data-house="Villa Marinduque Student Dormitory"
                                data-room="Room 201 (Double Occupancy)"
                                data-bed="Bed Space B (Upper Deck)"
                                data-accreditation="Boac Campus Certified (Accreditation #MARSU-BH-2025-014)"
                                data-rent="₱1,500.00 / month"
                                data-address="Purok 3, Panfilo M. Manguera Sr. Rd, Brgy. Santol, Boac (350m from Gate 2)"
                                data-landlord="Engr. Rogelio Maglacas (0917-882-1402)"
                                data-term="A.Y. 2025-2026 2nd Sem"
                                data-period="Jan 15, 2026 — Jun 20, 2026"
                                data-duration="5 Months Stay"
                                data-status="Cleared"
                                data-status-type="success"
                                data-dues="₱0.00 (Fully Settled)"
                                data-key="Returned & Key Cabinet Tag Logged"
                                data-inspection="Passed (No damages found; room cleaned & inspected)"
                                data-remarks="Tenant completed 2nd Semester with exemplary conduct. Room inspected and left clean. Official checkout clearance certified for registrar release."
                                data-emergency="Elena Mercene (Mother) • 0919-876-5432 (Brgy. Balimbing, Boac)"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Kyla Mae De Luna</div>
                            <div class="small text-muted">ID: 23-0412 • BSCS 3B</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-secondary">Greenview Boarding House</div>
                            <div class="small text-muted">Room 104 • Bed A</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">A.Y. 2025-2026 1st Sem</span></td>
                        <td>
                            <div class="small fw-medium">Aug 10, 2025 — Dec 22, 2025</div>
                            <div class="small text-muted">4.5 Months Stay</div>
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Cleared</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm btn-view-history" 
                                title="View Tenancy & Clearance Details"
                                data-bs-toggle="modal" 
                                data-bs-target="#viewTenancyModal"
                                data-name="Kyla Mae De Luna"
                                data-student-id="23-0412"
                                data-program="BS in Computer Science (BSCS 3B)"
                                data-college="College of Information and Computing Sciences (CICS)"
                                data-email="23-0412@marsu.edu.ph"
                                data-contact="0928-334-9011"
                                data-gender="Female"
                                data-house="Greenview Residence & Bed Space"
                                data-room="Room 104 (Double Occupancy)"
                                data-bed="Bed Space A (Lower Deck)"
                                data-accreditation="Boac Campus Certified (Accreditation #MARSU-BH-2025-008)"
                                data-rent="₱1,300.00 / month"
                                data-address="Sitio Riverside, Near MarSU East Gate, Brgy. Tanza, Boac"
                                data-landlord="Mrs. Remedios Montemar (0928-334-9011)"
                                data-term="A.Y. 2025-2026 1st Sem"
                                data-period="Aug 10, 2025 — Dec 22, 2025"
                                data-duration="4.5 Months Stay"
                                data-status="Cleared"
                                data-status-type="success"
                                data-dues="₱0.00 (Fully Settled)"
                                data-key="Returned & Key Cabinet Tag Logged"
                                data-inspection="Passed (Complete furnishings accounted for; zero wall marks)"
                                data-remarks="Checkout clearance issued on Dec 22, 2025. All monthly boarding dues and utilities verified paid in full with receipts attached."
                                data-emergency="Ronaldo De Luna (Father) • 0920-112-3344 (Gasan, Marinduque)"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Joshua Emmanuel Tan</div>
                            <div class="small text-muted">ID: 21-0984 • BSIS 4B</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-secondary">Sunrise Ladies & Mens Dorm</div>
                            <div class="small text-muted">Room 302 • Bed C</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">A.Y. 2025-2026 2nd Sem</span></td>
                        <td>
                            <div class="small fw-medium">Feb 01, 2026 — Jun 15, 2026</div>
                            <div class="small text-muted">4.5 Months Stay</div>
                        </td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning"><i class="bi bi-hourglass-split me-1"></i>Key Returned / Dues Pending</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-outline-secondary btn-sm btn-view-history" 
                                title="View Tenancy & Clearance Details"
                                data-bs-toggle="modal" 
                                data-bs-target="#viewTenancyModal"
                                data-name="Joshua Emmanuel Tan"
                                data-student-id="21-0984"
                                data-program="BS in Information Systems (BSIS 4B)"
                                data-college="College of Information and Computing Sciences (CICS)"
                                data-email="21-0984@marsu.edu.ph"
                                data-contact="0919-672-4455"
                                data-gender="Male"
                                data-house="Sunrise Ladies & Mens Dormitory"
                                data-room="Room 302 (Triple Room)"
                                data-bed="Bed Space C"
                                data-accreditation="Boac Campus Certified (Accreditation #MARSU-BH-2025-021)"
                                data-rent="₱1,800.00 / month"
                                data-address="Cor. Mabini & Rizal Streets, Brgy. Murallon, Boac"
                                data-landlord="Dr. Carmela Villaster (0919-672-4455)"
                                data-term="A.Y. 2025-2026 2nd Sem"
                                data-period="Feb 01, 2026 — Jun 15, 2026"
                                data-duration="4.5 Months Stay"
                                data-status="Key Returned / Dues Pending"
                                data-status-type="warning"
                                data-dues="₱900.00 (Unsettled Utility Sub-meter)"
                                data-key="Returned & Surrendered to Dorm Matron"
                                data-inspection="Passed Room Physical Condition; Pending Sub-meter Settlement"
                                data-remarks="Room vacated and key returned on June 15, 2026. Pending settlement of May-June electricity sub-meter balance (₱900.00) before final clearance stamp."
                                data-emergency="Norma Tan (Mother) • 0918-334-5566 (Sta. Cruz, Marinduque)"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <?php if (!empty($history)): ?>
                        <?php foreach ($history as $h): ?>
                            <?php 
                                $hName   = !empty($h['first_name']) ? ($h['first_name'] . ' ' . $h['last_name']) : ($h['name'] ?? 'Student');
                                $hId     = $h['student_no'] ?? ($h['student_id'] ?? 'N/A');
                                $hHouse  = $h['house_name'] ?? 'Villa Marinduque Student Dorm';
                                $hRoom   = !empty($h['room_number']) ? ('Room ' . $h['room_number'] . ' • ' . ($h['bed_number'] ?? 'Bed A')) : 'Standard Bed Space';
                                $hRent   = is_numeric($h['monthly_rent'] ?? null) ? ('₱' . number_format($h['monthly_rent'], 2) . ' / month') : '₱1,500.00 / month';
                                $hMoveIn = !empty($h['move_in_date']) ? date('M d, Y', strtotime($h['move_in_date'])) : 'Aug 15, 2025';
                            ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark"><?= e($hName) ?></div>
                                    <div class="small text-muted">ID: <?= e($hId) ?> • <?= e($h['program'] ?? 'BSIT') ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-secondary"><?= e($hHouse) ?></div>
                                    <div class="small text-muted"><?= e($hRoom) ?></div>
                                </td>
                                <td><span class="badge bg-light text-dark border">A.Y. 2025-2026</span></td>
                                <td>
                                    <div class="small fw-medium"><?= e($hMoveIn) ?> — Active</div>
                                    <div class="small text-muted">Current Resident</div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success">
                                        <i class="bi bi-check-circle me-1"></i>Active In Good Standing
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-outline-secondary btn-sm btn-view-history" 
                                        title="View Tenancy & Clearance Details"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewTenancyModal"
                                        data-name="<?= e($hName) ?>"
                                        data-student-id="<?= e($hId) ?>"
                                        data-program="<?= e(($h['program'] ?? 'BSIT') . ' (' . ($h['year_level'] ?? 'Student') . ')') ?>"
                                        data-college="<?= e($h['college'] ?? 'CICS') ?>"
                                        data-email="<?= e($h['email'] ?? ($hId . '@marsu.edu.ph')) ?>"
                                        data-contact="<?= e($h['contact_number'] ?? 'N/A') ?>"
                                        data-gender="<?= e($h['gender'] ?? 'Not Specified') ?>"
                                        data-house="<?= e($hHouse) ?>"
                                        data-room="<?= e($hRoom) ?>"
                                        data-bed="<?= e($h['bed_number'] ?? 'Bed A') ?>"
                                        data-accreditation="Boac Campus Certified"
                                        data-rent="<?= e($hRent) ?>"
                                        data-address="Boac, Marinduque"
                                        data-landlord="Certified Dorm Caretaker"
                                        data-term="A.Y. 2025-2026"
                                        data-period="<?= e($hMoveIn) ?> — Present"
                                        data-duration="Active Tenancy"
                                        data-status="Active / In Good Standing"
                                        data-status-type="success"
                                        data-dues="₱0.00 (No Outstanding Balance)"
                                        data-key="Assigned to Resident"
                                        data-inspection="Regular Tenancy Status"
                                        data-remarks="Resident enrolled and currently residing under accredited housing contract."
                                        data-emergency="<?= e(($h['emergency_contact_name'] ?? 'Emergency Contact') . ' • ' . ($h['emergency_contact_phone'] ?? 'N/A')) ?>"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL: VIEW TENANCY & CLEARANCE DETAILS DOSSIER
     ========================================================================= -->
<div class="modal fade" id="viewTenancyModal" tabindex="-1" aria-labelledby="viewTenancyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <!-- Modal Header -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #800020 0%, #4a0011 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-person-vcard fs-5 text-white"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0 text-white" id="viewTenancyModalLabel">Student Tenancy & Clearance Dossier</h5>
                        <small class="text-white-50" id="viewModalRecordRef">Historical Tenancy Record • MarSU ISHAMIS</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <!-- Student Header Summary Card -->
                <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px; background: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div id="viewModalAvatar" class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 54px; height: 54px; font-size: 1.25rem; background: linear-gradient(135deg, #800020, #b8922a);">
                                    ST
                                </div>
                                <div>
                                    <h5 class="fw-bolder mb-1 text-dark" id="viewModalStudentName">Student Resident</h5>
                                    <div class="d-flex flex-wrap align-items-center gap-2 small text-muted">
                                        <span class="badge bg-light text-dark border"><i class="bi bi-person-badge me-1"></i><span id="viewModalStudentId">N/A</span></span>
                                        <span class="badge bg-burgundy-subtle text-marsu-burgundy border border-burgundy-subtle" id="viewModalProgram">BSIT</span>
                                        <span class="text-secondary"><i class="bi bi-mortarboard me-1"></i><span id="viewModalCollege">CICS</span></span>
                                    </div>
                                </div>
                            </div>
                            <div id="viewModalStatusBadge">
                                <span class="badge bg-success-subtle text-success border border-success px-3 py-2 fs-7 fw-bold">
                                    <i class="bi bi-check-circle-fill me-1"></i>Cleared
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2-Column Info Grid -->
                <div class="row g-3">
                    <!-- Left Column: Accommodation Details -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                            <div class="card-header bg-transparent py-2 border-bottom fw-bold text-marsu-burgundy small text-uppercase">
                                <i class="bi bi-building me-1 text-gold-dark"></i> Boarding Accommodation
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-unstyled mb-0 small">
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Facility:</span>
                                        <span class="fw-bold text-dark text-end" id="viewModalHouse">Villa Marinduque</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Room & Bed:</span>
                                        <span class="fw-semibold text-dark text-end" id="viewModalRoom">Room 201 • Bed B</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Accreditation:</span>
                                        <span class="text-success fw-semibold text-end" id="viewModalAccreditation"><i class="bi bi-shield-check me-1"></i>Boac Certified</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Monthly Rent:</span>
                                        <span class="fw-bold text-marsu-burgundy text-end" id="viewModalRent">₱1,500.00 / mo</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Dorm Manager:</span>
                                        <span class="fw-medium text-dark text-end" id="viewModalLandlord">Engr. Rogelio Maglacas</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-start">
                                        <span class="text-muted me-2">Location:</span>
                                        <span class="text-muted text-end" id="viewModalAddress">Brgy. Santol, Boac</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Stay Timeline & Student Info -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                            <div class="card-header bg-transparent py-2 border-bottom fw-bold text-marsu-burgundy small text-uppercase">
                                <i class="bi bi-calendar-range me-1 text-gold-dark"></i> Tenancy Timeline & Contact
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-unstyled mb-0 small">
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Academic Term:</span>
                                        <span class="fw-semibold text-dark text-end" id="viewModalTerm">A.Y. 2025-2026 2nd Sem</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Period of Stay:</span>
                                        <span class="fw-bold text-dark text-end" id="viewModalPeriod">Jan 15, 2026 — Jun 20, 2026</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Duration:</span>
                                        <span class="badge bg-light text-dark border text-end" id="viewModalDuration">5 Months Stay</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Gender:</span>
                                        <span class="fw-medium text-dark text-end" id="viewModalGender">Male</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Student Mobile:</span>
                                        <span class="fw-medium text-dark text-end" id="viewModalContact">0917-882-1492</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Institutional Email:</span>
                                        <span class="text-primary text-end text-truncate" style="max-width: 60%;" id="viewModalEmail">student@marsu.edu.ph</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Full Width: Clearance & Account Audit -->
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                            <div class="card-header bg-transparent py-2 border-bottom fw-bold text-marsu-burgundy small text-uppercase">
                                <i class="bi bi-clipboard-check me-1 text-gold-dark"></i> Clearance Checklist & Account Audit
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-2 small">
                                    <div class="col-md-4">
                                        <div class="p-2 border rounded bg-light h-100">
                                            <div class="text-muted" style="font-size: 11px;">OUTSTANDING DUES</div>
                                            <div class="fw-bold fs-6 mt-1" id="viewModalDues">₱0.00 (Fully Paid)</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-2 border rounded bg-light h-100">
                                            <div class="text-muted" style="font-size: 11px;">ROOM KEY SURRENDER</div>
                                            <div class="fw-bold fs-6 text-dark mt-1" id="viewModalKey"><i class="bi bi-key-fill text-gold-dark me-1"></i>Returned</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-2 border rounded bg-light h-100">
                                            <div class="text-muted" style="font-size: 11px;">ROOM & FURNITURE INSPECTION</div>
                                            <div class="fw-bold fs-6 mt-1" id="viewModalInspection"><i class="bi bi-check2-all text-success me-1"></i>Passed</div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="p-2 border rounded bg-light">
                                            <div class="text-muted" style="font-size: 11px;">INSPECTOR NOTES & REMARKS</div>
                                            <div class="fst-italic text-dark mt-1" id="viewModalRemarks">Room inspected in good condition. Bed and mattress accounted for without stains. Clearance signed for academic year-end.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statutory & Emergency Contact Notice -->
                    <div class="col-12">
                        <div class="p-2 px-3 rounded-2 bg-light border d-flex justify-content-between align-items-center flex-wrap gap-2 small">
                            <div>
                                <i class="bi bi-telephone-inbound text-marsu-burgundy me-1"></i>
                                <span class="fw-semibold">Emergency Contact:</span>
                                <span class="text-muted" id="viewModalEmergency">Contact on file with OSAS</span>
                            </div>
                            <div class="text-muted" style="font-size: 11px;">
                                <i class="bi bi-shield-lock-fill text-secondary me-1"></i>RA 10173 Data Privacy Act Protected
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer bg-white py-2 px-3 border-top d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print Tenancy Dossier
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Log Clearance -->
<div class="modal fade" id="newHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Log Tenant Checkout / Clearance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Resident Student</label>
                        <select class="form-select" required>
                            <option selected disabled value="">Choose student resident...</option>
                            <option>Christian Paul Mercene (Villa Marinduque - Rm 201)</option>
                            <option>Kyla Mae De Luna (Greenview - Rm 104)</option>
                            <option>Joshua Emmanuel Tan (Sunrise Dorm - Rm 302)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Checkout Date</label>
                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Clearance Status</label>
                        <select class="form-select">
                            <option value="cleared">Fully Cleared (No Damages, Dues Paid)</option>
                            <option value="pending">Pending Inspection</option>
                            <option value="with_dues">With Outstanding Balance</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Remarks / Condition Notes</label>
                        <textarea class="form-control" rows="2" placeholder="Keys surrendered, room cleanliness inspected..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Interactive Modal & Live Search/Filter Script (Native JS - Zero jQuery) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewModal = document.getElementById('viewTenancyModal');
    if (!viewModal) return;

    // Delegate click on eye buttons
    document.querySelectorAll('.btn-view-history').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const d = this.dataset;

            // Student identity
            const studentName = d.name || 'Student Resident';
            document.getElementById('viewModalStudentName').textContent = studentName;
            document.getElementById('viewModalStudentId').textContent = d.studentId || 'N/A';
            document.getElementById('viewModalProgram').textContent = d.program || 'BSIT';
            document.getElementById('viewModalCollege').textContent = d.college || 'CICS';
            document.getElementById('viewModalContact').textContent = d.contact || 'N/A';
            document.getElementById('viewModalEmail').textContent = d.email || 'N/A';
            document.getElementById('viewModalGender').textContent = d.gender || 'Not specified';
            
            // Avatar Initials
            const initials = studentName.split(' ').map(function(n) { return n[0]; }).slice(0, 2).join('').toUpperCase();
            document.getElementById('viewModalAvatar').textContent = initials;

            // Accommodation
            document.getElementById('viewModalHouse').textContent = d.house || 'Accredited Boarding House';
            document.getElementById('viewModalRoom').textContent = d.room || 'Standard Room';
            document.getElementById('viewModalAccreditation').innerHTML = '<i class="bi bi-shield-check me-1"></i>' + (d.accreditation || 'Boac Campus Certified');
            document.getElementById('viewModalRent').textContent = d.rent || '₱1,500.00 / mo';
            document.getElementById('viewModalLandlord').textContent = d.landlord || 'Certified Dorm Caretaker';
            document.getElementById('viewModalAddress').textContent = d.address || 'Boac, Marinduque';

            // Timeline
            document.getElementById('viewModalTerm').textContent = d.term || 'A.Y. 2025-2026';
            document.getElementById('viewModalPeriod').textContent = d.period || 'Full Term';
            document.getElementById('viewModalDuration').textContent = d.duration || 'Semester Stay';

            // Clearance Status Badge
            const isCleared = (d.statusType === 'success' || (d.status && d.status.toLowerCase().includes('cleared')));
            const statusBadge = document.getElementById('viewModalStatusBadge');
            const duesEl = document.getElementById('viewModalDues');
            const inspectionEl = document.getElementById('viewModalInspection');

            if (isCleared) {
                statusBadge.innerHTML = '<span class="badge bg-success-subtle text-success border border-success px-3 py-2 fs-7 fw-bold"><i class="bi bi-check-circle-fill me-1"></i>' + (d.status || 'Cleared') + '</span>';
                duesEl.className = 'fw-bold fs-6 mt-1 text-success';
                duesEl.textContent = d.dues || '₱0.00 (Fully Settled)';
                inspectionEl.className = 'fw-bold fs-6 mt-1 text-success';
                inspectionEl.innerHTML = '<i class="bi bi-check2-all text-success me-1"></i>' + (d.inspection || 'Passed');
            } else {
                statusBadge.innerHTML = '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning px-3 py-2 fs-7 fw-bold"><i class="bi bi-hourglass-split me-1"></i>' + (d.status || 'Key Returned / Dues Pending') + '</span>';
                duesEl.className = 'fw-bold fs-6 mt-1 text-danger';
                duesEl.textContent = d.dues || '₱900.00 (Outstanding Balance)';
                inspectionEl.className = 'fw-bold fs-6 mt-1 text-warning';
                inspectionEl.innerHTML = '<i class="bi bi-exclamation-circle text-warning me-1"></i>' + (d.inspection || 'Pending Final Verification');
            }

            document.getElementById('viewModalKey').innerHTML = '<i class="bi bi-key-fill text-gold-dark me-1"></i>' + (d.key || 'Returned');
            document.getElementById('viewModalRemarks').textContent = d.remarks || 'No recorded discrepancies.';
            document.getElementById('viewModalEmergency').textContent = d.emergency || 'Contact on file with OSAS';

            // Record Reference
            document.getElementById('viewModalRecordRef').textContent = 'Historical Tenancy Record • ID: ' + (d.studentId || '2026') + ' • ' + (d.term || 'A.Y. 2025-2026');
        });
    });

    // Live search and dropdown filtering
    const searchInput = document.getElementById('historySearchInput');
    const termFilter = document.getElementById('termFilter');
    const statusFilter = document.getElementById('statusFilter');
    const resetBtn = document.getElementById('resetFilterBtn');
    const rows = document.querySelectorAll('#historyTableBody tr');

    function filterTable() {
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const term = (termFilter ? termFilter.value : '').toLowerCase().trim();
        const status = (statusFilter ? statusFilter.value : '').toLowerCase().trim();

        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            const matchesQuery = !query || text.includes(query);
            const matchesTerm = !term || text.includes(term);
            const matchesStatus = !status || text.includes(status);

            if (matchesQuery && matchesTerm && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (termFilter) termFilter.addEventListener('change', filterTable);
    if (statusFilter) statusFilter.addEventListener('change', filterTable);
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            if (searchInput) searchInput.value = '';
            if (termFilter) termFilter.value = '';
            if (statusFilter) statusFilter.value = '';
            filterTable();
        });
    }
});
</script>
