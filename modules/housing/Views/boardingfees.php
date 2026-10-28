<!-- Boarding Fees Tracking View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-cash-coin me-2 text-gold"></i>Boarding House Fee Schedule & Rates
        </h1>
        <p class="text-muted small mb-0">Standardized rental price ceilings, utility bills (water & electricity submetering), and university-accredited rate schedules.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Rate Sheet
        </button>
        <a href="<?= url('housing/paymentrecords') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-receipt me-1"></i>Payment Records
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newFeeModal">
            <i class="bi bi-plus-lg me-1"></i>Add Fee Rate
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/boardingfees') ?>">
                <i class="bi bi-cash-coin me-1"></i>Fee Schedule
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/paymentrecords') ?>">
                <i class="bi bi-wallet2 me-1"></i>Payment Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/balancemonitoring') ?>">
                <i class="bi bi-exclamation-diamond me-1"></i>Balance Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/receiptgeneration') ?>">
                <i class="bi bi-printer me-1"></i>Receipt Generation
            </a>
        </li>
    </ul>
</div>

<!-- Executive KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Lowest Entry Rate</div>
                    <div class="kpi-value text-success" id="kpiLowestRate">
                        ₱1,500.00
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Affordable Student Entry Rate">
                    <i class="bi bi-tag-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-check-circle-fill text-success"></i>
                <span>Villa Marinduque (Fan Room)</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Solo / Studio Ceiling</div>
                    <div class="kpi-value text-marsu-burgundy" id="kpiHighestRate">
                        ₱3,000.00
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Approved Solo Accommodation Cap">
                    <i class="bi bi-door-closed-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-shield-lock-fill text-danger"></i>
                <span>Sunrise Ladies (Single Solo)</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Average Monthly Rent</div>
                    <div class="kpi-value text-dark" id="kpiAvgRate">
                        ₱2,125.00
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Weighted Campus Average">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-people-fill text-gold-dark"></i>
                <span>Per Head (Accredited Units)</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Accredited Rate Cap</div>
                    <div class="kpi-value text-success" id="kpiActiveConfigs">
                        4 Active
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Compliant with OSAS Housing Guidelines">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-check2-all text-success"></i>
                <span>100% Rate Cap Compliance</span>
            </div>
        </div>
    </div>
</div>

<!-- Alert Placeholder for Live Updates -->
<div id="rateAlertPlaceholder"></div>

<!-- Search & Filtering Toolbar -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="feeSearchInput" class="form-control border-start-0 ps-0" placeholder="Search boarding house, room config, or utilities...">
                </div>
            </div>
            <div class="col-md-3">
                <select id="facilityFilter" class="form-select form-select-sm">
                    <option value="">All Boarding Houses</option>
                    <option value="Villa Marinduque Dorm">Villa Marinduque Dorm</option>
                    <option value="Greenview Boarding House">Greenview Boarding House</option>
                    <option value="Sunrise Ladies Dormitory">Sunrise Ladies Dormitory</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="utilityFilter" class="form-select form-select-sm">
                    <option value="">All Utility Conditions</option>
                    <option value="Free Fiber Wi-Fi">Free Fiber Wi-Fi Included</option>
                    <option value="Submetered">Submetered Electricity</option>
                    <option value="Free">Free Water Utility</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" id="resetFeeFilterBtn" class="btn btn-outline-secondary btn-sm w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Fee Rate Cards by Facility Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Accredited Monthly Rental Rates & Utility Caps
        </h6>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-download me-1"></i>Download Rate Sheet
            </button>
            <button class="btn btn-sm btn-marsu" data-bs-toggle="modal" data-bs-target="#newFeeModal">
                <i class="bi bi-plus-circle me-1"></i>New Rate
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="ratesTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Boarding House</th>
                        <th>Room Configuration</th>
                        <th>Monthly Rent (Per Head)</th>
                        <th>Water Utility</th>
                        <th>Electricity Submeter</th>
                        <th>Wi-Fi / Internet</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody id="ratesTableBody">
                    <tr id="rate-row-1" data-id="1">
                        <td class="ps-3 fw-bold text-dark col-facility">Villa Marinduque Dorm</td>
                        <td class="col-config">4-Pax Bed Space (Aircon)</td>
                        <td class="col-rent"><span class="fw-bold text-success">₱1,800.00</span></td>
                        <td class="col-water">Free (Deep Well + Filtered)</td>
                        <td class="col-electric">Submetered (₱18/kWh)</td>
                        <td class="col-wifi"><span class="badge bg-success-subtle text-success">Free Fiber Wi-Fi</span></td>
                        <td class="text-end pe-3">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-fee" 
                                    title="Edit Rate Structure & Utility Caps"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editFeeModal"
                                    data-id="1"
                                    data-facility="Villa Marinduque Dorm"
                                    data-config="4-Pax Bed Space (Aircon)"
                                    data-rent="1800.00"
                                    data-water="Free (Deep Well + Filtered)"
                                    data-electric="Submetered (₱18/kWh)"
                                    data-wifi="Free Fiber Wi-Fi"
                                    data-status="Accredited & Capped"
                                    data-notes="Official approved rate for Airconditioned 4-bed spaces. Submeter read on 25th of every month. Free filtered drinking water provided in dorm lobby."
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-view-fee" 
                                    title="View Rate Breakdown & Utility Terms"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewFeeModal"
                                    data-id="1"
                                    data-facility="Villa Marinduque Dorm"
                                    data-config="4-Pax Bed Space (Aircon)"
                                    data-rent="1800.00"
                                    data-water="Free (Deep Well + Filtered)"
                                    data-electric="Submetered (₱18/kWh)"
                                    data-wifi="Free Fiber Wi-Fi"
                                    data-status="Accredited & Capped"
                                    data-notes="Official approved rate for Airconditioned 4-bed spaces. Submeter read on 25th of every month. Free filtered drinking water provided in dorm lobby."
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="rate-row-2" data-id="2">
                        <td class="ps-3 fw-bold text-dark col-facility">Villa Marinduque Dorm</td>
                        <td class="col-config">4-Pax Bed Space (Fan Room)</td>
                        <td class="col-rent"><span class="fw-bold text-success">₱1,500.00</span></td>
                        <td class="col-water">Free</td>
                        <td class="col-electric">Inclusive (Standard Load)</td>
                        <td class="col-wifi"><span class="badge bg-success-subtle text-success">Free Fiber Wi-Fi</span></td>
                        <td class="text-end pe-3">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-fee" 
                                    title="Edit Rate Structure & Utility Caps"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editFeeModal"
                                    data-id="2"
                                    data-facility="Villa Marinduque Dorm"
                                    data-config="4-Pax Bed Space (Fan Room)"
                                    data-rent="1500.00"
                                    data-water="Free"
                                    data-electric="Inclusive (Standard Load)"
                                    data-wifi="Free Fiber Wi-Fi"
                                    data-status="Accredited & Capped"
                                    data-notes="Standard ceiling for fan room quadruple sharing. Includes lighting, ceiling fans, and phone chargers."
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-view-fee" 
                                    title="View Rate Breakdown & Utility Terms"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewFeeModal"
                                    data-id="2"
                                    data-facility="Villa Marinduque Dorm"
                                    data-config="4-Pax Bed Space (Fan Room)"
                                    data-rent="1500.00"
                                    data-water="Free"
                                    data-electric="Inclusive (Standard Load)"
                                    data-wifi="Free Fiber Wi-Fi"
                                    data-status="Accredited & Capped"
                                    data-notes="Standard ceiling for fan room quadruple sharing. Includes lighting, ceiling fans, and phone chargers."
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="rate-row-3" data-id="3">
                        <td class="ps-3 fw-bold text-dark col-facility">Greenview Boarding House</td>
                        <td class="col-config">2-Pax Room Studio</td>
                        <td class="col-rent"><span class="fw-bold text-success">₱2,200.00</span></td>
                        <td class="col-water">₱100/mo flat fee</td>
                        <td class="col-electric">Submetered</td>
                        <td class="col-wifi"><span class="badge bg-secondary">₱150/mo add-on</span></td>
                        <td class="text-end pe-3">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-fee" 
                                    title="Edit Rate Structure & Utility Caps"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editFeeModal"
                                    data-id="3"
                                    data-facility="Greenview Boarding House"
                                    data-config="2-Pax Room Studio"
                                    data-rent="2200.00"
                                    data-water="₱100/mo flat fee"
                                    data-electric="Submetered"
                                    data-wifi="₱150/mo add-on"
                                    data-status="Accredited & Capped"
                                    data-notes="Double occupancy studio with private sink. Dedicated electricity submeter billed at MARELCO municipal cost."
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-view-fee" 
                                    title="View Rate Breakdown & Utility Terms"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewFeeModal"
                                    data-id="3"
                                    data-facility="Greenview Boarding House"
                                    data-config="2-Pax Room Studio"
                                    data-rent="2200.00"
                                    data-water="₱100/mo flat fee"
                                    data-electric="Submetered"
                                    data-wifi="₱150/mo add-on"
                                    data-status="Accredited & Capped"
                                    data-notes="Double occupancy studio with private sink. Dedicated electricity submeter billed at MARELCO municipal cost."
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="rate-row-4" data-id="4">
                        <td class="ps-3 fw-bold text-dark col-facility">Sunrise Ladies Dormitory</td>
                        <td class="col-config">Single Solo Room</td>
                        <td class="col-rent"><span class="fw-bold text-success">₱3,000.00</span></td>
                        <td class="col-water">Inclusive</td>
                        <td class="col-electric">Inclusive (Max 50kWh)</td>
                        <td class="col-wifi"><span class="badge bg-success-subtle text-success">Free Wi-Fi</span></td>
                        <td class="text-end pe-3">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-fee" 
                                    title="Edit Rate Structure & Utility Caps"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editFeeModal"
                                    data-id="4"
                                    data-facility="Sunrise Ladies Dormitory"
                                    data-config="Single Solo Room"
                                    data-rent="3000.00"
                                    data-water="Inclusive"
                                    data-electric="Inclusive (Max 50kWh)"
                                    data-wifi="Free Wi-Fi"
                                    data-status="Accredited & Capped"
                                    data-notes="Premium solo room for upperclassmen/graduating students. Electricity capped at 50kWh/mo with overage at ₱18/kWh."
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-view-fee" 
                                    title="View Rate Breakdown & Utility Terms"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewFeeModal"
                                    data-id="4"
                                    data-facility="Sunrise Ladies Dormitory"
                                    data-config="Single Solo Room"
                                    data-rent="3000.00"
                                    data-water="Inclusive"
                                    data-electric="Inclusive (Max 50kWh)"
                                    data-wifi="Free Wi-Fi"
                                    data-status="Accredited & Capped"
                                    data-notes="Premium solo room for upperclassmen/graduating students. Electricity capped at 50kWh/mo with overage at ₱18/kWh."
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- Modal 1: Edit Rate Structure & Utility Caps (Action Trigger)               -->
<!-- ========================================================================= -->
<div class="modal fade" id="editFeeModal" tabindex="-1" aria-labelledby="editFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white py-3">
                <div>
                    <h5 class="modal-title font-weight-bold mb-0" id="editFeeModalLabel">
                        <i class="bi bi-pencil-square text-gold me-2"></i>Edit Rate Structure & Utility Caps
                    </h5>
                    <small class="text-white-50" id="editModalSubtitle">Configure accredited pricing, utility limits, and room ceilings</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFeeForm">
                <?= csrf_field() ?>
                <input type="hidden" id="editRateId" name="rate_id" value="">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Facility Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-building me-1 text-marsu-burgundy"></i>Boarding House Facility
                            </label>
                            <input type="text" class="form-control" id="editFacilityName" name="facility_name" required placeholder="e.g. Villa Marinduque Dorm">
                        </div>

                        <!-- Room Configuration -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-door-open me-1 text-marsu-burgundy"></i>Room Configuration / Type
                            </label>
                            <input type="text" class="form-control" id="editRoomConfig" name="room_config" required placeholder="e.g. 4-Pax Bed Space (Aircon)">
                        </div>

                        <!-- Monthly Rent -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-currency-dollar me-1 text-marsu-burgundy"></i>Monthly Rent per Head (₱)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-success">₱</span>
                                <input type="number" step="0.01" min="0" class="form-control fw-bold text-success fs-6" id="editMonthlyRent" name="monthly_rent" required placeholder="1800.00">
                            </div>
                            <small class="text-muted" style="font-size: 11px;">Must comply with accredited ceiling of ₱3,500/mo per student</small>
                        </div>

                        <!-- Accreditation Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-patch-check me-1 text-marsu-burgundy"></i>Accreditation & Ceiling Status
                            </label>
                            <select class="form-select" id="editStatus" name="status">
                                <option value="Accredited & Capped">Accredited & Capped (Standard OSAS)</option>
                                <option value="Pending OSAS Review">Pending OSAS Rate Review</option>
                                <option value="Grandfathered Rate">Grandfathered Approved Rate</option>
                                <option value="Subsidized Student Rate">Subsidized Student Rate</option>
                            </select>
                        </div>

                        <!-- Utility Policies Header -->
                        <div class="col-12 mt-3 pt-2 border-top">
                            <h6 class="fw-bold text-marsu-burgundy small text-uppercase mb-2">
                                <i class="bi bi-lightning-charge me-1 text-gold-dark"></i>Utility Inclusions & Submetering Policies
                            </h6>
                        </div>

                        <!-- Water Utility -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark small">
                                <i class="bi bi-droplet-half me-1 text-primary"></i>Water Utility Terms
                            </label>
                            <input type="text" class="form-control form-control-sm" id="editWaterUtility" name="water_utility" required placeholder="e.g. Free (Deep Well) or ₱100/mo">
                        </div>

                        <!-- Electricity Submeter -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark small">
                                <i class="bi bi-plug-fill me-1 text-warning"></i>Electricity Submeter Policy
                            </label>
                            <input type="text" class="form-control form-control-sm" id="editElectricSubmeter" name="electric_submeter" required placeholder="e.g. Submetered (₱18/kWh)">
                        </div>

                        <!-- Wi-Fi / Internet -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark small">
                                <i class="bi bi-wifi me-1 text-success"></i>Wi-Fi / Internet
                            </label>
                            <input type="text" class="form-control form-control-sm" id="editWifiInternet" name="wifi_internet" required placeholder="e.g. Free Fiber Wi-Fi or ₱150/mo add-on">
                        </div>

                        <!-- Notes & Justifications -->
                        <div class="col-12">
                            <label class="form-label fw-semibold text-dark small">
                                <i class="bi bi-sticky me-1 text-marsu-burgundy"></i>Special Terms, Meter Reading Notes & Remarks
                            </label>
                            <textarea class="form-control form-control-sm" id="editNotes" name="notes" rows="2" placeholder="Submeter reading schedule, drinking water filter logs, or rate ceiling justifications..."></textarea>
                        </div>

                        <!-- Compliance Badge Notice -->
                        <div class="col-12">
                            <div class="p-2 px-3 rounded bg-light border d-flex justify-content-between align-items-center flex-wrap gap-2 small">
                                <div>
                                    <i class="bi bi-shield-check text-success me-1"></i>
                                    <span class="fw-semibold">Enforces MarSU Student Housing Price Ceiling Policy (CHED-aligned)</span>
                                </div>
                                <span class="badge bg-gold-subtle text-dark border">
                                    <i class="bi bi-award-fill me-1 text-gold-dark"></i>OSAS Accredited
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-sm" id="btnDeleteRate">
                        <i class="bi bi-trash me-1"></i>Deactivate Rate
                    </button>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-marsu btn-sm px-3 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- Modal 2: View Accredited Rate Dossier & Utility Breakdown                   -->
<!-- ========================================================================= -->
<div class="modal fade" id="viewFeeModal" tabindex="-1" aria-labelledby="viewFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-primary py-3">
                <div>
                    <h5 class="modal-title font-weight-bold mb-0" id="viewFeeModalLabel">
                        <i class="bi bi-file-earmark-text text-gold me-2"></i>Accredited Rate & Utility Dossier
                    </h5>
                    <small class="text-white-50" id="viewModalRecordRef">Official MarSU Housing Price Ceiling Schedule</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <!-- Top Overview Banner -->
                    <div class="col-12">
                        <div class="p-3 rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="background: linear-gradient(135deg, #fff9e6 0%, #ffffff 100%); border-left: 5px solid #800020 !important;">
                            <div>
                                <span class="badge bg-gold text-dark mb-1 fw-bold" id="viewModalStatus">Accredited & Capped</span>
                                <h4 class="fw-bold text-marsu-burgundy mb-0" id="viewModalFacility">Villa Marinduque Dorm</h4>
                                <div class="text-muted small" id="viewModalConfig">4-Pax Bed Space (Aircon)</div>
                            </div>
                            <div class="text-end">
                                <div class="small text-uppercase text-muted fw-bold" style="font-size: 11px;">MONTHLY RENT / HEAD</div>
                                <div class="h2 fw-bold text-success mb-0" id="viewModalRent">₱1,800.00</div>
                                <span class="badge bg-success-subtle text-success">CHED Cap Compliant</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3 Utility Cards -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="p-2 rounded bg-primary-subtle text-primary me-2">
                                    <i class="bi bi-droplet-half fs-5"></i>
                                </div>
                                <span class="fw-bold text-dark small text-uppercase">Water Utility</span>
                            </div>
                            <div class="fw-semibold text-dark fs-6" id="viewModalWater">Free (Deep Well + Filtered)</div>
                            <small class="text-muted d-block mt-1">Safe drinking water certified</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="p-2 rounded bg-warning-subtle text-warning me-2">
                                    <i class="bi bi-plug-fill fs-5"></i>
                                </div>
                                <span class="fw-bold text-dark small text-uppercase">Electricity</span>
                            </div>
                            <div class="fw-semibold text-dark fs-6" id="viewModalElectric">Submetered (₱18/kWh)</div>
                            <small class="text-muted d-block mt-1">Readings every 25th of month</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="p-2 rounded bg-success-subtle text-success me-2">
                                    <i class="bi bi-wifi fs-5"></i>
                                </div>
                                <span class="fw-bold text-dark small text-uppercase">Internet Connectivity</span>
                            </div>
                            <div class="fw-semibold text-dark fs-6" id="viewModalWifi">Free Fiber Wi-Fi</div>
                            <small class="text-muted d-block mt-1">Guaranteed study bandwidth</small>
                        </div>
                    </div>

                    <!-- Inspector Remarks & Notes -->
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
                            <div class="card-header bg-transparent py-2 border-bottom fw-bold text-marsu-burgundy small text-uppercase">
                                <i class="bi bi-clipboard-check me-1 text-gold-dark"></i> Accreditation Notes & Housing Policy Inclusions
                            </div>
                            <div class="card-body p-3">
                                <p class="mb-0 text-dark" id="viewModalNotes">Official approved rate for Airconditioned 4-bed spaces. Submeter read on 25th of every month. Free filtered drinking water provided in dorm lobby.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2 px-3 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print Rate Sheet
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-marsu btn-sm" id="btnEditFromView">
                        <i class="bi bi-pencil me-1"></i>Edit This Rate
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- Modal 3: Add Fee Rate (Enhanced with All Parameters)                       -->
<!-- ========================================================================= -->
<div class="modal fade" id="newFeeModal" tabindex="-1" aria-labelledby="newFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form id="newFeeForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-header bg-marsu text-primary py-3">
                    <h5 class="modal-title font-weight-bold mb-0" id="newFeeModalLabel">
                        <i class="bi bi-plus-circle text-gold me-2"></i>Configure New Fee Rate Structure
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-building me-1 text-marsu-burgundy"></i>Facility Name
                            </label>
                            <input type="text" class="form-control" id="newFacilityName" name="facility_name" placeholder="e.g. Villa Marinduque Dorm" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-door-open me-1 text-marsu-burgundy"></i>Room Configuration
                            </label>
                            <input type="text" class="form-control" id="newRoomConfig" name="room_config" placeholder="e.g. 4-Pax Aircon Room" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-currency-dollar me-1 text-marsu-burgundy"></i>Monthly Rent per Student (₱)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-success">₱</span>
                                <input type="number" step="0.01" min="0" class="form-control fw-bold text-success" id="newMonthlyRent" name="monthly_rent" placeholder="1800.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-patch-check me-1 text-marsu-burgundy"></i>Accreditation Status
                            </label>
                            <select class="form-select" id="newStatus" name="status">
                                <option value="Accredited & Capped">Accredited & Capped (Standard OSAS)</option>
                                <option value="Pending OSAS Review">Pending OSAS Rate Review</option>
                                <option value="Grandfathered Rate">Grandfathered Approved Rate</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark small">Water Utility</label>
                            <input type="text" class="form-control form-control-sm" id="newWaterUtility" name="water_utility" placeholder="e.g. Free (Deep Well)" value="Free">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark small">Electricity Submeter</label>
                            <input type="text" class="form-control form-control-sm" id="newElectricSubmeter" name="electric_submeter" placeholder="e.g. Submetered (₱18/kWh)" value="Submetered (₱18/kWh)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark small">Wi-Fi / Internet</label>
                            <input type="text" class="form-control form-control-sm" id="newWifiInternet" name="wifi_internet" placeholder="e.g. Free Fiber Wi-Fi" value="Free Fiber Wi-Fi">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-dark small">Special Inclusions / Notes</label>
                            <textarea class="form-control form-control-sm" id="newNotes" name="notes" rows="2" placeholder="Inspection terms, submetering specs, etc."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm px-3 shadow-sm">
                        <i class="bi bi-plus-lg me-1"></i>Save Rate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- Interactive JavaScript Logic (Pure Native JS - Zero jQuery)               -->
<!-- ========================================================================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModalEl = document.getElementById('editFeeModal');
    const viewModalEl = document.getElementById('viewFeeModal');
    const newModalEl = document.getElementById('newFeeModal');

    const editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
    const viewModal = viewModalEl ? new bootstrap.Modal(viewModalEl) : null;
    const newModal = newModalEl ? new bootstrap.Modal(newModalEl) : null;

    const alertPlaceholder = document.getElementById('rateAlertPlaceholder');

    // Show temporary dismissible feedback banner
    function showAlert(message, type = 'success') {
        if (!alertPlaceholder) return;
        const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
        alertPlaceholder.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show shadow-sm mb-3" role="alert">
                <i class="bi ${icon} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        // Scroll slightly into view if needed
        alertPlaceholder.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Format currency to ₱X,XXX.00
    function formatCurrency(amount) {
        const num = parseFloat(amount) || 0;
        return '₱' + num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Attach click events to all Edit buttons (.btn-edit-fee)
    function bindEditButtons() {
        document.querySelectorAll('.btn-edit-fee').forEach(function (btn) {
            btn.onclick = function () {
                const d = this.dataset;

                // Populate Edit Modal Inputs
                document.getElementById('editRateId').value = d.id || '';
                document.getElementById('editFacilityName').value = d.facility || '';
                document.getElementById('editRoomConfig').value = d.config || '';
                document.getElementById('editMonthlyRent').value = d.rent || '';
                document.getElementById('editWaterUtility').value = d.water || '';
                document.getElementById('editElectricSubmeter').value = d.electric || '';
                document.getElementById('editWifiInternet').value = d.wifi || '';
                document.getElementById('editStatus').value = d.status || 'Accredited & Capped';
                document.getElementById('editNotes').value = d.notes || '';

                // Header Subtitle
                document.getElementById('editModalSubtitle').textContent = (d.facility || 'Facility') + ' • ' + (d.config || 'Configuration');
            };
        });
    }

    // Attach click events to all View buttons (.btn-view-fee)
    function bindViewButtons() {
        document.querySelectorAll('.btn-view-fee').forEach(function (btn) {
            btn.onclick = function () {
                const d = this.dataset;

                document.getElementById('viewModalFacility').textContent = d.facility || 'Boarding House';
                document.getElementById('viewModalConfig').textContent = d.config || 'Room Configuration';
                document.getElementById('viewModalRent').textContent = formatCurrency(d.rent);
                document.getElementById('viewModalWater').textContent = d.water || 'Free';
                document.getElementById('viewModalElectric').textContent = d.electric || 'Submetered';
                document.getElementById('viewModalWifi').textContent = d.wifi || 'Free Fiber Wi-Fi';
                document.getElementById('viewModalStatus').textContent = d.status || 'Accredited & Capped';
                document.getElementById('viewModalNotes').textContent = d.notes || 'No notes specified.';
                document.getElementById('viewModalRecordRef').textContent = 'Accredited Rate Schedule • ID #' + (d.id || '1') + ' • ' + (d.facility || '');

                // Wire up "Edit This Rate" button inside the view modal
                const btnEditFromView = document.getElementById('btnEditFromView');
                if (btnEditFromView) {
                    btnEditFromView.onclick = function () {
                        if (viewModal) viewModal.hide();
                        // Trigger edit modal with same dataset
                        const targetEditBtn = document.querySelector(`.btn-edit-fee[data-id="${d.id}"]`);
                        if (targetEditBtn) {
                            targetEditBtn.click();
                        }
                    };
                }
            };
        });
    }

    // Recalculate KPI stats across active table rows
    function updateKPIs() {
        const rows = document.querySelectorAll('#ratesTableBody tr:not(#noRatesRow)');
        if (!rows.length) {
            document.getElementById('kpiLowestRate').textContent = '₱0.00';
            document.getElementById('kpiHighestRate').textContent = '₱0.00';
            document.getElementById('kpiAvgRate').textContent = '₱0.00';
            document.getElementById('kpiActiveConfigs').textContent = '0 Active';
            return;
        }

        let min = Infinity;
        let max = -Infinity;
        let total = 0;
        let count = 0;

        rows.forEach(function (row) {
            const editBtn = row.querySelector('.btn-edit-fee');
            if (editBtn && editBtn.dataset.rent) {
                const rent = parseFloat(editBtn.dataset.rent);
                if (!isNaN(rent)) {
                    if (rent < min) min = rent;
                    if (rent > max) max = rent;
                    total += rent;
                    count++;
                }
            }
        });

        if (count > 0) {
            document.getElementById('kpiLowestRate').textContent = formatCurrency(min);
            document.getElementById('kpiHighestRate').textContent = formatCurrency(max);
            document.getElementById('kpiAvgRate').textContent = formatCurrency(total / count);
            document.getElementById('kpiActiveConfigs').textContent = count + ' Active';
        }
    }

    // Handle Edit Form Submission
    const editFeeForm = document.getElementById('editFeeForm');
    if (editFeeForm) {
        editFeeForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const rateId = document.getElementById('editRateId').value;
            const facility = document.getElementById('editFacilityName').value.trim();
            const config = document.getElementById('editRoomConfig').value.trim();
            const rent = parseFloat(document.getElementById('editMonthlyRent').value) || 0;
            const water = document.getElementById('editWaterUtility').value.trim();
            const electric = document.getElementById('editElectricSubmeter').value.trim();
            const wifi = document.getElementById('editWifiInternet').value.trim();
            const status = document.getElementById('editStatus').value;
            const notes = document.getElementById('editNotes').value.trim();

            const row = document.getElementById('rate-row-' + rateId);
            if (row) {
                // Update table cells
                const colFacility = row.querySelector('.col-facility');
                const colConfig = row.querySelector('.col-config');
                const colRent = row.querySelector('.col-rent');
                const colWater = row.querySelector('.col-water');
                const colElectric = row.querySelector('.col-electric');
                const colWifi = row.querySelector('.col-wifi');

                if (colFacility) colFacility.textContent = facility;
                if (colConfig) colConfig.textContent = config;
                if (colRent) colRent.innerHTML = `<span class="fw-bold text-success">${formatCurrency(rent)}</span>`;
                if (colWater) colWater.textContent = water;
                if (colElectric) colElectric.textContent = electric;
                if (colWifi) {
                    const isFree = wifi.toLowerCase().includes('free');
                    colWifi.innerHTML = `<span class="badge ${isFree ? 'bg-success-subtle text-success' : 'bg-secondary'}">${wifi}</span>`;
                }

                // Update data attributes on edit and view buttons
                const editBtn = row.querySelector('.btn-edit-fee');
                const viewBtn = row.querySelector('.btn-view-fee');

                [editBtn, viewBtn].forEach(function (btn) {
                    if (btn) {
                        btn.dataset.facility = facility;
                        btn.dataset.config = config;
                        btn.dataset.rent = rent;
                        btn.dataset.water = water;
                        btn.dataset.electric = electric;
                        btn.dataset.wifi = wifi;
                        btn.dataset.status = status;
                        btn.dataset.notes = notes;
                    }
                });

                // Row flash visual feedback
                row.classList.add('table-warning');
                setTimeout(function () {
                    row.classList.remove('table-warning');
                }, 1500);

                // Update KPI metrics
                updateKPIs();

                // Close modal and show success feedback
                if (editModal) editModal.hide();
                showAlert(`Rate schedule for <strong>${facility}</strong> (${config}) updated successfully!`, 'success');
            }
        });
    }

    // Handle Rate Deactivation / Deletion
    const btnDeleteRate = document.getElementById('btnDeleteRate');
    if (btnDeleteRate) {
        btnDeleteRate.addEventListener('click', function () {
            const rateId = document.getElementById('editRateId').value;
            const facility = document.getElementById('editFacilityName').value;
            const config = document.getElementById('editRoomConfig').value;

            if (confirm(`Are you sure you want to deactivate the accredited rate schedule for ${facility} (${config})?`)) {
                const row = document.getElementById('rate-row-' + rateId);
                if (row) {
                    row.style.transition = 'opacity 0.4s ease';
                    row.style.opacity = '0';
                    setTimeout(function () {
                        row.remove();
                        updateKPIs();
                    }, 400);

                    if (editModal) editModal.hide();
                    showAlert(`Rate schedule for <strong>${facility}</strong> has been deactivated from active ceilings.`, 'warning');
                }
            }
        });
    }

    // Handle New Fee Rate Addition
    const newFeeForm = document.getElementById('newFeeForm');
    if (newFeeForm) {
        newFeeForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const facility = document.getElementById('newFacilityName').value.trim();
            const config = document.getElementById('newRoomConfig').value.trim();
            const rent = parseFloat(document.getElementById('newMonthlyRent').value) || 0;
            const water = document.getElementById('newWaterUtility').value.trim() || 'Free';
            const electric = document.getElementById('newElectricSubmeter').value.trim() || 'Submetered (₱18/kWh)';
            const wifi = document.getElementById('newWifiInternet').value.trim() || 'Free Fiber Wi-Fi';
            const status = document.getElementById('newStatus').value;
            const notes = document.getElementById('newNotes').value.trim() || 'Newly registered rate schedule.';

            const newId = Date.now();
            const isFree = wifi.toLowerCase().includes('free');

            const tbody = document.getElementById('ratesTableBody');
            const newRow = document.createElement('tr');
            newRow.id = 'rate-row-' + newId;
            newRow.dataset.id = newId;

            newRow.innerHTML = `
                <td class="ps-3 fw-bold text-dark col-facility">${facility}</td>
                <td class="col-config">${config}</td>
                <td class="col-rent"><span class="fw-bold text-success">${formatCurrency(rent)}</span></td>
                <td class="col-water">${water}</td>
                <td class="col-electric">${electric}</td>
                <td class="col-wifi"><span class="badge ${isFree ? 'bg-success-subtle text-success' : 'bg-secondary'}">${wifi}</span></td>
                <td class="text-end pe-3">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-fee" 
                            title="Edit Rate Structure & Utility Caps"
                            data-bs-toggle="modal"
                            data-bs-target="#editFeeModal"
                            data-id="${newId}"
                            data-facility="${facility}"
                            data-config="${config}"
                            data-rent="${rent}"
                            data-water="${water}"
                            data-electric="${electric}"
                            data-wifi="${wifi}"
                            data-status="${status}"
                            data-notes="${notes}"
                        >
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-view-fee" 
                            title="View Rate Breakdown & Utility Terms"
                            data-bs-toggle="modal"
                            data-bs-target="#viewFeeModal"
                            data-id="${newId}"
                            data-facility="${facility}"
                            data-config="${config}"
                            data-rent="${rent}"
                            data-water="${water}"
                            data-electric="${electric}"
                            data-wifi="${wifi}"
                            data-status="${status}"
                            data-notes="${notes}"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </td>
            `;

            tbody.appendChild(newRow);

            // Re-bind click handlers for the new row
            bindEditButtons();
            bindViewButtons();
            updateKPIs();

            // Flash the newly added row
            newRow.classList.add('table-success');
            setTimeout(function () {
                newRow.classList.remove('table-success');
            }, 1500);

            // Reset form and close modal
            newFeeForm.reset();
            if (newModal) newModal.hide();
            showAlert(`New accredited rate for <strong>${facility}</strong> successfully registered!`, 'success');
        });
    }

    // Live search and filter
    const searchInput = document.getElementById('feeSearchInput');
    const facilityFilter = document.getElementById('facilityFilter');
    const utilityFilter = document.getElementById('utilityFilter');
    const resetFilterBtn = document.getElementById('resetFeeFilterBtn');

    function filterRates() {
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const facilityVal = (facilityFilter ? facilityFilter.value : '').toLowerCase().trim();
        const utilityVal = (utilityFilter ? utilityFilter.value : '').toLowerCase().trim();

        const rows = document.querySelectorAll('#ratesTableBody tr:not(#noRatesRow)');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            const matchesQuery = !query || text.includes(query);
            const matchesFacility = !facilityVal || text.includes(facilityVal);
            const matchesUtility = !utilityVal || text.includes(utilityVal);

            if (matchesQuery && matchesFacility && matchesUtility) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Handle empty state row
        let noRatesRow = document.getElementById('noRatesRow');
        if (visibleCount === 0) {
            if (!noRatesRow) {
                noRatesRow = document.createElement('tr');
                noRatesRow.id = 'noRatesRow';
                noRatesRow.innerHTML = `
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="bi bi-search fs-3 d-block mb-2 text-gold"></i>
                        No accredited fee schedules match your search filters.
                    </td>
                `;
                document.getElementById('ratesTableBody').appendChild(noRatesRow);
            }
            noRatesRow.style.display = '';
        } else if (noRatesRow) {
            noRatesRow.style.display = 'none';
        }
    }

    if (searchInput) searchInput.addEventListener('input', filterRates);
    if (facilityFilter) facilityFilter.addEventListener('change', filterRates);
    if (utilityFilter) utilityFilter.addEventListener('change', filterRates);
    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', function () {
            if (searchInput) searchInput.value = '';
            if (facilityFilter) facilityFilter.value = '';
            if (utilityFilter) utilityFilter.value = '';
            filterRates();
        });
    }

    // Initialize bindings and calculations
    bindEditButtons();
    bindViewButtons();
    updateKPIs();
});
</script>
