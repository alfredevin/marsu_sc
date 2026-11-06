<!-- Condition Reports View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>

<style>
/* ==========================================================================
   FACILITY & ROOM CONDITION REPORTS - ENHANCED VISUALS & CHECKLIST STYLES
   ========================================================================== */
.bg-marsu {
    background-color: #800020 !important;
    color: #ffffff !important;
}
.text-marsu-burgundy {
    color: #800020 !important;
}

/* Modal Header - High Contrast Burgundy & Gold */
.modal-header-marsu {
    background: linear-gradient(135deg, #800020 0%, #4e0013 100%) !important;
    color: #ffffff !important;
    border-bottom: 3.5px solid #D4AF37 !important;
    padding: 1.15rem 1.5rem !important;
}
.modal-header-marsu .modal-title {
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 1.15rem;
    letter-spacing: -0.01em;
}
.modal-header-marsu .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: 0.85;
}
.modal-header-marsu .btn-close:hover {
    opacity: 1;
}

/* Overview Dossier Card */
.audit-overview-card {
    background: linear-gradient(135deg, #fffcf5 0%, #fbf3e4 100%);
    border: 1.5px solid #e8d7b0;
    border-left: 5px solid #800020;
    border-radius: 12px;
    padding: 1.15rem 1.25rem;
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.05);
}
[data-bs-theme="dark"] .audit-overview-card {
    background: linear-gradient(135deg, #24050c 0%, #1a0308 100%);
    border-color: #5c1825;
    border-left-color: #D4AF37;
}

/* Checklist Domain Category Box */
.checklist-category-card {
    background: #ffffff;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    margin-bottom: 1rem;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
}
[data-bs-theme="dark"] .checklist-category-card {
    background: #1c060b;
    border-color: #4a1420;
}
.checklist-category-header {
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    padding: 0.65rem 1rem;
    font-size: 0.86rem;
    font-weight: 700;
    color: #800020;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
[data-bs-theme="dark"] .checklist-category-header {
    background: #24080e;
    border-color: #4a1420;
    color: #fce89e;
}

/* Checklist Item Row */
.checklist-item-row {
    padding: 0.6rem 1rem;
    border-bottom: 1px solid #f1f3f5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.83rem;
}
.checklist-item-row:last-child {
    border-bottom: none;
}
[data-bs-theme="dark"] .checklist-item-row {
    border-color: #2a0b12;
}

/* Action button in table */
.btn-view-checklist {
    background: #ffffff;
    color: #800020;
    border: 1.5px solid #800020;
    font-weight: 600;
    font-size: 0.78rem;
    padding: 0.3rem 0.75rem;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    transition: all 0.18s ease;
    cursor: pointer;
    text-decoration: none;
}
.btn-view-checklist:hover {
    background: #800020;
    color: #ffffff !important;
    border-color: #800020;
    box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
    transform: translateY(-1px);
}
.btn-view-checklist:hover i {
    color: #ffffff !important;
}

/* Utility Submeter Badge */
.meter-reading-box {
    background: #ffffff;
    border: 1px dashed #d1d5db;
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
}
[data-bs-theme="dark"] .meter-reading-box {
    background: #20060b;
    border-color: #5c1825;
}

/* Print Specific Rules */
@media print {
    body * {
        visibility: hidden;
    }
    #viewChecklistModal, #viewChecklistModal * {
        visibility: visible;
    }
    #viewChecklistModal {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .modal-footer, .btn-close {
        display: none !important;
    }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clipboard2-check-fill me-2 text-gold"></i>Facility & Room Condition Reports
        </h1>
        <p class="text-muted small mb-0">Pre-occupancy and post-checkout room condition checklists, inventory handover inspections, and safety audits.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/servicehistory') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-clock-history me-1"></i>Service History
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newConditionModal">
            <i class="bi bi-plus-lg me-1"></i>New Inspection Checklist
        </button>
    </div>
</div>

<!-- Flash alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/maintenancerequest') ?>">
                <i class="bi bi-tools me-1"></i>Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/repairmonitoring') ?>">
                <i class="bi bi-speedometer2 me-1"></i>Repair Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/conditionreports') ?>">
                <i class="bi bi-clipboard2-check me-1"></i>Condition Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/servicehistory') ?>">
                <i class="bi bi-clock-history me-1"></i>Service History
            </a>
        </li>
    </ul>
</div>

<!-- Inspections Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-card-checklist me-2 text-gold"></i>Recorded Room Condition Audits
        </h6>
        <div class="d-flex align-items-center gap-2">
            <span id="auditSearchCount" class="badge bg-light text-muted border small" style="display: none;"></span>
            <div class="input-group input-group-sm" style="width: 250px;">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-search"></i></span>
                <input type="text" id="auditSearchInput" class="form-control form-control-sm" placeholder="Search audits...">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="auditTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Audit Reference</th>
                        <th>Facility & Room</th>
                        <th>Inspection Stage</th>
                        <th>Inspector</th>
                        <th>Score / Rating</th>
                        <th>Date Conducted</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($reports)): ?>
                        <!-- Fallback Static Seed Rows if DB empty -->
                        <tr>
                            <td class="ps-3 fw-bold text-dark">AUD-2026-081</td>
                            <td>Villa Marinduque Dorm (Rm 102)</td>
                            <td><span class="badge badge-gold">Pre-Move-in Intake</span></td>
                            <td>Engr. R. Santos (Landlord)</td>
                            <td><span class="badge bg-success-subtle text-success border border-success">98% Pristine</span></td>
                            <td>Aug 15, 2026</td>
                            <td class="text-end pe-3">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-marsu btn-view-checklist"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewChecklistModal"
                                        data-report='{"audit_ref":"AUD-2026-081","facility_name":"Villa Marinduque Dorm","room_unit":"Room 102","inspection_stage":"Pre-Move-in Intake","inspector_name":"Engr. R. Santos (Landlord)","score_rating":"98% Pristine","inspection_date":"2026-08-15","submeter_electric":"00214.8 kWh","submeter_water":"0068.3 m³","key_surrender_status":"2 Keys Issued to Tenant","remarks":"Pre-move-in comprehensive condition audit for incoming semester resident. All furniture, electrical outlets, plumbing fixtures, and smoke alarms verified in pristine condition. Keys handed over.","status":"Completed"}'>
                                    <i class="bi bi-file-earmark-check text-gold"></i><span>View Checklist</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3 fw-bold text-dark">AUD-2026-082</td>
                            <td>Greenview Boarding House (Rm 204)</td>
                            <td><span class="badge bg-info text-dark">Midterm Safety Audit</span></td>
                            <td>MarSU OSAS Safety Inspector</td>
                            <td><span class="badge bg-success-subtle text-success border border-success">92% Satisfactory</span></td>
                            <td>Sep 20, 2026</td>
                            <td class="text-end pe-3">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-marsu btn-view-checklist"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewChecklistModal"
                                        data-report='{"audit_ref":"AUD-2026-082","facility_name":"Greenview Boarding House","room_unit":"Room 204","inspection_stage":"Midterm Safety Audit","inspector_name":"MarSU OSAS Safety Inspector","score_rating":"92% Satisfactory","inspection_date":"2026-09-20","submeter_electric":"00482.1 kWh","submeter_water":"0142.9 m³","key_surrender_status":"Keys Accounted & Active","remarks":"Midterm campus safety and sanitary audit conducted by OSAS. Extension cords properly routed with surge protectors. BFP fire exit signs clearly illuminated. Room condition satisfactory.","status":"Completed"}'>
                                    <i class="bi bi-file-earmark-check text-gold"></i><span>View Checklist</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3 fw-bold text-dark">AUD-2026-083</td>
                            <td>Sunrise Ladies Dorm (Rm 104)</td>
                            <td><span class="badge bg-secondary">Checkout Clearance</span></td>
                            <td>Mrs. A. Ramos</td>
                            <td><span class="badge bg-warning-subtle text-warning border border-warning">Minor Window Screen Tear</span></td>
                            <td>Sep 30, 2026</td>
                            <td class="text-end pe-3">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-marsu btn-view-checklist"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewChecklistModal"
                                        data-report='{"audit_ref":"AUD-2026-083","facility_name":"Sunrise Ladies Dorm","room_unit":"Room 104","inspection_stage":"Checkout Clearance","inspector_name":"Mrs. A. Ramos","score_rating":"Minor Window Screen Tear","inspection_date":"2026-09-30","submeter_electric":"00790.4 kWh","submeter_water":"0210.0 m³","key_surrender_status":"2 Keys Surrendered & Returned","remarks":"Post-tenancy checkout clearance. Student surrendered room keys. Sub-meters read and settled. Minor 2-inch tear observed on window insect screen; landlord notified for screen replacement under normal wear-and-tear.","status":"Completed"}'>
                                    <i class="bi bi-file-earmark-check text-gold"></i><span>View Checklist</span>
                                </button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($reports as $r): ?>
                            <?php 
                                $stage = $r['inspection_stage'] ?? 'Pre-Move-in Intake';
                                $stageBadgeClass = match($stage) {
                                    'Pre-Move-in Intake'   => 'badge-gold',
                                    'Midterm Safety Audit' => 'bg-info text-dark',
                                    'Checkout Clearance'   => 'bg-secondary text-white',
                                    default                => 'bg-light text-dark border'
                                };

                                $rating = $r['score_rating'] ?? '95% Satisfactory';
                                $ratingBadgeClass = (strpos($rating, 'Tear') !== false || strpos($rating, 'Damage') !== false || strpos($rating, 'Failed') !== false)
                                    ? 'bg-warning-subtle text-warning border border-warning'
                                    : 'bg-success-subtle text-success border border-success';
                                
                                $dateDisp = !empty($r['inspection_date']) ? date('M d, Y', strtotime($r['inspection_date'])) : date('M d, Y');
                                $facilityRoom = e($r['facility_name']) . ' (' . e($r['room_unit']) . ')';
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark"><?= e($r['audit_ref']) ?></td>
                                <td><?= $facilityRoom ?></td>
                                <td><span class="badge <?= $stageBadgeClass ?>"><?= e($stage) ?></span></td>
                                <td><?= e($r['inspector_name']) ?></td>
                                <td><span class="badge <?= $ratingBadgeClass ?>"><?= e($rating) ?></span></td>
                                <td><?= $dateDisp ?></td>
                                <td class="text-end pe-3">
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-marsu btn-view-checklist"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewChecklistModal"
                                            data-report='<?= htmlspecialchars(json_encode($r), ENT_QUOTES, 'UTF-8') ?>'>
                                        <i class="bi bi-file-earmark-check text-gold"></i><span>View Checklist</span>
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

<!-- ========================================================================
     MODAL: VIEW INSPECTION CHECKLIST (The Core Requested Feature)
     ======================================================================== -->
<div class="modal fade" id="viewChecklistModal" tabindex="-1" aria-labelledby="viewChecklistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <!-- Modal Header in High-Contrast MarSU Burgundy & Gold -->
            <div class="modal-header modal-header-marsu">
                <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-gold text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px; font-size: 1.05rem;">
                            <i class="bi bi-clipboard2-check-fill"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="viewChecklistModalLabel">
                                Room Condition Inspection Checklist
                            </h5>
                            <small class="text-white-50" style="font-size: 0.78rem;">ISHAMIS Facility Handover & Safety Compliance Dossier</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-gold text-dark px-2 py-1 fw-bold fs-8 border border-warning shadow-sm font-monospace" id="modalAuditRefBadge">
                            AUD-2026-000
                        </span>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <div class="modal-body p-4">
                <!-- Top Inspection Overview Dossier Card -->
                <div class="audit-overview-card mb-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                <h4 class="fw-bold text-dark mb-0" id="modalFacilityRoomTitle">Villa Marinduque Dorm (Rm 102)</h4>
                                <span class="badge badge-gold" id="modalStageBadge">Pre-Move-in Intake</span>
                                <span class="badge bg-success-subtle text-success border border-success" id="modalRatingBadge">98% Pristine</span>
                            </div>
                            <div class="small text-muted">
                                <i class="bi bi-person-badge text-gold me-1"></i>Inspector: <strong class="text-dark" id="modalInspectorName">Engr. R. Santos</strong>
                                <span class="mx-2">•</span>
                                <i class="bi bi-calendar-event text-gold me-1"></i>Date Conducted: <span class="text-dark" id="modalDateConducted">Aug 15, 2026</span>
                            </div>
                        </div>

                        <!-- Utility Submeters & Key Account Status -->
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="meter-reading-box">
                                <small class="text-muted d-block" style="font-size: 10px; font-weight: 700; text-transform: uppercase;">⚡ Electric Submeter</small>
                                <span class="fw-bold font-monospace text-dark" id="modalElectricMeter">00214.8 kWh</span>
                            </div>
                            <div class="meter-reading-box">
                                <small class="text-muted d-block" style="font-size: 10px; font-weight: 700; text-transform: uppercase;">💧 Water Submeter</small>
                                <span class="fw-bold font-monospace text-dark" id="modalWaterMeter">0068.3 m³</span>
                            </div>
                            <div class="meter-reading-box">
                                <small class="text-muted d-block" style="font-size: 10px; font-weight: 700; text-transform: uppercase;">🔑 Key Status</small>
                                <span class="fw-bold text-dark small" id="modalKeyStatus"><i class="bi bi-check2 text-success me-1"></i>Issued</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Itemized Checklist Domains -->
                <h6 class="fw-bold text-marsu-burgundy border-bottom pb-2 mb-3">
                    <i class="bi bi-ui-checks-grid me-2 text-gold"></i>Itemized Physical Condition & Inventory Inspection
                </h6>

                <!-- Container where detailed items are rendered dynamically -->
                <div id="checklistItemsContainer">
                    <!-- Category 1: Electrical & Lighting -->
                    <div class="checklist-category-card">
                        <div class="checklist-category-header">
                            <span><i class="bi bi-lightning-charge-fill me-2 text-gold"></i>1. Electrical, Lighting & Power Fixtures</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Inspected</span>
                        </div>
                        <div id="domainElectrical"></div>
                    </div>

                    <!-- Category 2: Doors, Windows & Latches -->
                    <div class="checklist-category-card">
                        <div class="checklist-category-header">
                            <span><i class="bi bi-door-closed-fill me-2 text-gold"></i>2. Doors, Locks, Windows & Screen Meshes</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Inspected</span>
                        </div>
                        <div id="domainDoors"></div>
                    </div>

                    <!-- Category 3: Walls, Ceiling & Floors -->
                    <div class="checklist-category-card">
                        <div class="checklist-category-header">
                            <span><i class="bi bi-border-style me-2 text-gold"></i>3. Walls, Ceiling Finishes & Tile Flooring</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Inspected</span>
                        </div>
                        <div id="domainWalls"></div>
                    </div>

                    <!-- Category 4: Furniture & Inventory Handover -->
                    <div class="checklist-category-card">
                        <div class="checklist-category-header">
                            <span><i class="bi bi-lamp-fill me-2 text-gold"></i>4. Bed, Mattress & Study Furniture Inventory</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Inspected</span>
                        </div>
                        <div id="domainFurniture"></div>
                    </div>

                    <!-- Category 5: Plumbing & Sanitation -->
                    <div class="checklist-category-card">
                        <div class="checklist-category-header">
                            <span><i class="bi bi-droplet-half me-2 text-gold"></i>5. Bathroom, Faucet, Toilet & Drainage Flow</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Inspected</span>
                        </div>
                        <div id="domainPlumbing"></div>
                    </div>

                    <!-- Category 6: Fire Protection & Emergency Safety -->
                    <div class="checklist-category-card">
                        <div class="checklist-category-header">
                            <span><i class="bi bi-fire me-2 text-danger"></i>6. Fire Protection & Life Safety Compliance (BFP)</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Compliant</span>
                        </div>
                        <div id="domainSafety"></div>
                    </div>
                </div>

                <!-- Inspector Remarks & Verified Sign-off -->
                <div class="card border-0 bg-light p-3 rounded-3 mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-chat-left-quote-fill me-1 text-gold"></i>Inspector Field Observations & Settlement Notes
                        </h6>
                        <span class="badge bg-white text-muted border">Official Record</span>
                    </div>
                    <p class="fst-italic text-dark small mb-3" id="modalRemarksText">
                        Pre-move-in comprehensive condition audit for incoming semester resident. All furniture, electrical outlets, plumbing fixtures, and smoke alarms verified in pristine condition. Keys handed over.
                    </p>

                    <!-- Sign-off signatures -->
                    <div class="row g-2 pt-2 border-top small text-muted">
                        <div class="col-md-6">
                            <div><i class="bi bi-check-circle-fill text-success me-1"></i>Verified by: <strong class="text-dark" id="modalSignInspector">Engr. R. Santos (Landlord)</strong></div>
                            <small class="text-muted">Inspector Digital Signature Timestamp On-File</small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div><i class="bi bi-shield-check text-primary me-1"></i>MarSU Housing Services (ISHAMIS)</div>
                            <small class="text-muted">Accredited Boarding House Compliance Certified</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light py-2 px-3 border-top d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print Official Checklist
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================
     MODAL: LOG NEW CONDITION CHECKLIST
     ======================================================================== -->
<div class="modal fade" id="newConditionModal" tabindex="-1" aria-labelledby="newConditionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header modal-header-marsu">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-gold text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; font-size: 1rem;">
                        <i class="bi bi-clipboard2-plus-fill"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0" id="newConditionModalLabel">Log New Room Condition Checklist</h5>
                        <small class="text-white-50" style="font-size: 0.78rem;">Pre-occupancy, Midterm Safety, or Checkout Clearance</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?= url('housing/conditionreports/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                            <select name="boarding_house_id" id="new_house_select" class="form-select form-select-sm" required>
                                <option value="">-- Select Boarding House --</option>
                                <?php foreach ($houses ?? [] as $bh): ?>
                                    <option value="<?= (int)$bh['id'] ?>" data-name="<?= e($bh['name']) ?>"><?= e($bh['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="facility_name" id="new_facility_name" value="Villa Marinduque Dorm">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Room Unit <span class="text-danger">*</span></label>
                            <input type="text" name="room_unit" class="form-control form-control-sm" placeholder="e.g. Room 102" required value="Room 101">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Inspection Stage</label>
                            <select name="inspection_stage" class="form-select form-select-sm">
                                <option value="Pre-Move-in Intake" selected>Pre-Move-in Intake</option>
                                <option value="Midterm Safety Audit">Midterm Safety Audit</option>
                                <option value="Checkout Clearance">Checkout Clearance</option>
                                <option value="Sanitary Inspection">Sanitary Inspection</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Inspector Name <span class="text-danger">*</span></label>
                            <input type="text" name="inspector_name" class="form-control form-control-sm" value="Engr. R. Santos (Landlord)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Overall Rating / Score</label>
                            <select name="score_rating" class="form-select form-select-sm">
                                <option value="98% Pristine" selected>98% Pristine (Zero Defects)</option>
                                <option value="92% Satisfactory">92% Satisfactory (Acceptable Wear)</option>
                                <option value="Minor Window Screen Tear">Minor Window Screen Tear</option>
                                <option value="Minor Wall Scuff">Minor Wall Scuff / Needs Touchup</option>
                                <option value="Needs Maintenance">Needs Maintenance / Repair Required</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Inspection Date</label>
                            <input type="date" name="inspection_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Electricity Submeter (kWh)</label>
                            <input type="text" name="submeter_electric" class="form-control form-control-sm" value="00125.0 kWh">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Water Submeter (m³)</label>
                            <input type="text" name="submeter_water" class="form-control form-control-sm" value="0045.0 m³">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Room Keys Status</label>
                            <input type="text" name="key_surrender_status" class="form-control form-control-sm" value="2 Keys Issued & Tested">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Inspector Notes & Handover Remarks</label>
                        <textarea name="remarks" class="form-control form-control-sm" rows="3" placeholder="Condition of furniture, locks tested, meter readings verified, clearance signed..."></textarea>
                    </div>

                    <div class="alert alert-light border small text-muted py-2 px-3 mb-0">
                        <i class="bi bi-info-circle-fill text-gold me-1"></i>
                        Standard 6-domain checklist items (Electrical, Doors, Walls, Furniture, Plumbing, Fire Safety) will be automatically generated upon saving.
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-check2-circle me-1"></i>Save Checklist Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Live search filter on recorded audits table
    const searchInput = document.getElementById('auditSearchInput');
    const searchCountBadge = document.getElementById('auditSearchCount');
    const table = document.getElementById('auditTable');

    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            let visible = 0;
            let total = 0;

            rows.forEach(row => {
                total++;
                const text = row.textContent.toLowerCase();
                const matches = text.includes(term);
                row.style.display = matches ? '' : 'none';
                if (matches) visible++;
            });

            if (searchCountBadge) {
                if (term) {
                    searchCountBadge.style.display = '';
                    searchCountBadge.textContent = visible + ' of ' + total + ' audits';
                } else {
                    searchCountBadge.style.display = 'none';
                }
            }
        });
    }

    // 2. Helper to auto-update facility_name hidden input in New Checklist modal
    const houseSelect = document.getElementById('new_house_select');
    const hiddenFacilityName = document.getElementById('new_facility_name');
    if (houseSelect && hiddenFacilityName) {
        houseSelect.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            if (opt && opt.getAttribute('data-name')) {
                hiddenFacilityName.value = opt.getAttribute('data-name');
            }
        });
    }

    // 3. Fallback Checklist Generator if checklist_data is empty
    function getFallbackChecklist(rating) {
        const hasTear = (rating && rating.toLowerCase().includes('tear'));
        const hasDeskScratch = (rating && rating.toLowerCase().includes('92%'));

        return {
            electrical: [
                { item: 'Light switches and ceiling fixtures', status: 'Passed', notes: 'Tested and functional, clean LED diffusers' },
                { item: 'Power convenience outlets', status: 'Passed', notes: 'Ground pin intact, safe 220V voltage' },
                { item: 'Ceiling fan & speed controller', status: 'Passed', notes: 'All 3 speed levels operating quietly' },
                { item: 'Main sub-breaker switch', status: 'Passed', notes: 'Proper 20A breaker label, dry panel' }
            ],
            doors_windows: [
                { item: 'Main entrance door & heavy deadbolt', status: 'Passed', notes: 'Deadbolt aligns smoothly, 2 keys tested' },
                { item: 'Window glass, frames & security grilles', status: 'Passed', notes: 'Glass clean, steel grilles firmly anchored' },
                { item: 'Insect screen mesh', status: hasTear ? 'Needs Attention' : 'Passed', notes: hasTear ? 'Minor 2-inch tear near bottom left latch. Scheduled for patch repair.' : 'Tear-free, tight weather-seal' }
            ],
            walls_floors: [
                { item: 'Interior wall paint & surface finish', status: 'Passed', notes: 'Freshly painted beige, no scuff marks' },
                { item: 'Floor tiles & grout', status: 'Passed', notes: 'No broken tiles, grout intact, non-slip' },
                { item: 'Ceiling panels & water leak check', status: 'Passed', notes: 'Dry surface, zero water marks or stains' }
            ],
            furniture: [
                { item: 'Bed frame & structural foundation', status: 'Passed', notes: 'Solid hardwood/steel frame, sturdy legs' },
                { item: 'Upholstered foam mattress', status: 'Passed', notes: 'Sanitized with protective zippered cover' },
                { item: 'Study desk and chair', status: hasDeskScratch ? 'Minor Wear' : 'Passed', notes: hasDeskScratch ? 'Minor surface scratch on desk edge from laptop; structurally 100% stable.' : 'Level surface, varnish in good order' },
                { item: 'Clothing wardrobe cabinet & lock', status: 'Passed', notes: 'Smooth hinges, lock with key functional' }
            ],
            plumbing: [
                { item: 'Bathroom sink & stainless faucet', status: 'Passed', notes: 'Steady water pressure, no leak at P-trap' },
                { item: 'Water closet & flush tank', status: 'Passed', notes: 'Dual-flush system rapid refill, no running water' },
                { item: 'Shower fixture & drainage flow', status: 'Passed', notes: 'Immediate drain flow, hair strainer clean' }
            ],
            safety: [
                { item: 'Room photoelectric smoke detector', status: 'Passed', notes: 'Test button chirps, green standby LED' },
                { item: 'Corridor fire extinguisher proximity', status: 'Passed', notes: '10 lbs ABC dry chemical unit within 5 meters' },
                { item: 'Emergency evacuation route signage', status: 'Passed', notes: 'Laminated floor plan posted on door rear' }
            ]
        };
    }

    // Helper to render items inside category div
    function renderDomainItems(containerId, items) {
        const el = document.getElementById(containerId);
        if (!el) return;
        el.innerHTML = '';
        if (!items || !items.length) {
            el.innerHTML = '<div class="p-2 text-muted small fst-italic">No specific items logged.</div>';
            return;
        }

        items.forEach(it => {
            const st = it.status || 'Passed';
            let badgeClass = 'bg-success-subtle text-success border border-success-subtle';
            let iconClass = 'bi-check2-circle text-success';

            if (st === 'Needs Attention' || st === 'Failed') {
                badgeClass = 'bg-danger-subtle text-danger border border-danger-subtle';
                iconClass = 'bi-exclamation-triangle-fill text-danger';
            } else if (st === 'Minor Wear') {
                badgeClass = 'bg-warning-subtle text-warning-emphasis border border-warning-subtle';
                iconClass = 'bi-exclamation-circle-fill text-warning';
            }

            const row = document.createElement('div');
            row.className = 'checklist-item-row';
            row.innerHTML = `
                <div>
                    <i class="bi ${iconClass} me-2"></i>
                    <strong>${it.item}</strong>
                    ${it.notes ? `<div class="text-muted small ps-4 mt-1" style="font-size: 0.77rem;"><i class="bi bi-arrow-return-right me-1 text-gold"></i>${it.notes}</div>` : ''}
                </div>
                <div class="text-end ps-2">
                    <span class="badge ${badgeClass} small">${st}</span>
                </div>
            `;
            el.appendChild(row);
        });
    }

    // 4. Populate Checklist View Modal on button click
    document.querySelectorAll('.btn-view-checklist').forEach(btn => {
        btn.addEventListener('click', function() {
            const raw = this.getAttribute('data-report');
            if (!raw) return;

            try {
                const rep = JSON.parse(raw);

                // Populate Header & Overview
                document.getElementById('modalAuditRefBadge').textContent = rep.audit_ref || 'AUD-2026-000';
                document.getElementById('modalFacilityRoomTitle').textContent = (rep.facility_name || 'Accredited Dormitory') + ' (' + (rep.room_unit || 'Room Unit') + ')';
                
                const stageBadge = document.getElementById('modalStageBadge');
                if (stageBadge) {
                    const st = rep.inspection_stage || 'Pre-Move-in Intake';
                    stageBadge.textContent = st;
                    stageBadge.className = 'badge ' + (st === 'Pre-Move-in Intake' ? 'badge-gold' : (st === 'Midterm Safety Audit' ? 'bg-info text-dark' : 'bg-secondary text-white'));
                }

                const ratingBadge = document.getElementById('modalRatingBadge');
                if (ratingBadge) {
                    const rate = rep.score_rating || '95% Satisfactory';
                    ratingBadge.textContent = rate;
                    if (rate.toLowerCase().includes('tear') || rate.toLowerCase().includes('damage') || rate.toLowerCase().includes('needs')) {
                        ratingBadge.className = 'badge bg-warning-subtle text-warning-emphasis border border-warning-subtle';
                    } else {
                        ratingBadge.className = 'badge bg-success-subtle text-success border border-success';
                    }
                }

                document.getElementById('modalInspectorName').textContent = rep.inspector_name || 'Engr. R. Santos (Landlord)';
                
                // Format Date
                let dateStr = rep.inspection_date || 'Aug 15, 2026';
                if (dateStr.includes('-')) {
                    const d = new Date(dateStr);
                    if (!isNaN(d.getTime())) {
                        dateStr = d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    }
                }
                document.getElementById('modalDateConducted').textContent = dateStr;

                // Submeters & Key
                document.getElementById('modalElectricMeter').textContent = rep.submeter_electric || '00125.0 kWh';
                document.getElementById('modalWaterMeter').textContent = rep.submeter_water || '0045.0 m³';
                document.getElementById('modalKeyStatus').textContent = rep.key_surrender_status || 'Keys Accounted';

                // Remarks & Sign-off
                document.getElementById('modalRemarksText').textContent = rep.remarks || 'Standard room condition audit completed successfully with zero major structural or electrical defects found.';
                document.getElementById('modalSignInspector').textContent = rep.inspector_name || 'Engr. R. Santos (Landlord)';

                // Parse Checklist Data or use Fallback
                let checklist = null;
                if (rep.checklist_data) {
                    try {
                        checklist = (typeof rep.checklist_data === 'string') ? JSON.parse(rep.checklist_data) : rep.checklist_data;
                    } catch(e) {
                        checklist = null;
                    }
                }
                if (!checklist || typeof checklist !== 'object') {
                    checklist = getFallbackChecklist(rep.score_rating || '');
                }

                // Render into the 6 domain containers
                renderDomainItems('domainElectrical', checklist.electrical || []);
                renderDomainItems('domainDoors', checklist.doors_windows || []);
                renderDomainItems('domainWalls', checklist.walls_floors || []);
                renderDomainItems('domainFurniture', checklist.furniture || []);
                renderDomainItems('domainPlumbing', checklist.plumbing || []);
                renderDomainItems('domainSafety', checklist.safety || []);

            } catch(err) {
                console.error('Failed to parse audit report data:', err);
            }
        });
    });
});
</script>
