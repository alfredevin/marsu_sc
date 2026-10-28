<!-- Student Concerns & Health Records Management (MarSU OSAS Standard) -->
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
            border: 1px solid #dee2e6;
        }

        /* Flexible Uncompressed Table Layout */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1220px;
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

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        /* Concern Category Badges */
        .badge-category-mental {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e3f2fd !important;
            color: #0d47a1 !important;
            border: 1px solid #bbdefb !important;
            display: inline-block !important;
        }

        .badge-category-physical {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #e8f5e9 !important;
            color: #1b5e20 !important;
            border: 1px solid #c8e6c9 !important;
            display: inline-block !important;
        }

        .badge-category-injury {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #fff3e0 !important;
            color: #e65100 !important;
            border: 1px solid #ffe0b2 !important;
            display: inline-block !important;
        }

        .badge-category-stress {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f3e5f5 !important;
            color: #4a148c !important;
            border: 1px solid #e1bee7 !important;
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

        .status-badge-monitoring {
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

        .status-badge-cleared {
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

        .status-badge-none {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        /* Primary Action Buttons */
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
            <span class="small fw-bold text-secondary">UNIVERSITY HEALTH SERVICES</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">HEALTH & CONCERN RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Student Health & Concern Records</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Track clinic consultations, categorize physical illnesses, mental health concerns, sports injuries, and stress-related episodes, and manage inter-office follow-up referrals[cite: 1].
        </p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Clinic Visits</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1" id="metricTotalVisits">4</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Recorded Consultations</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-hospital-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Under Monitoring</div>
                    <div class="fs-2 fw-bold text-dark lh-1" id="metricMonitoring">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Active Care & Observation</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-activity fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Psych / Scheduled</div>
                    <div class="fs-2 fw-bold text-primary lh-1" id="metricScheduled">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Guidance Referrals</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-person-heart fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Cleared / Resolved</div>
                    <div class="fs-2 fw-bold text-success lh-1" id="metricCleared">1</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Fit for Academic Duty</div>
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
                <input type="search" id="searchHealth" class="search-pill-input" placeholder="Search student or diagnosis..." oninput="applyHealthFilters()" autocomplete="off">
            </div>

            <!-- 2. Concern Category Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                <select class="form-select form-select-sm filter-select" id="healthCategoryFilter" onchange="applyHealthFilters()">
                    <option value="">All Concern Categories</option>
                    <option value="Mental Health">Mental Health & Psychological</option>
                    <option value="Physical Illness">Physical Illness & Fever</option>
                    <option value="Injury / Trauma">Sports & Physical Injury</option>
                    <option value="Stress & Wellness">Stress & Somatic Conditions</option>
                </select>
            </div>

            <!-- 3. Follow-up Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Follow-up:</label>
                <select class="form-select form-select-sm filter-select" id="healthStatusFilter" onchange="applyHealthFilters()">
                    <option value="">All Statuses</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Monitoring">Monitoring</option>
                    <option value="Cleared">Cleared</option>
                    <option value="None needed">None needed</option>
                </select>
            </div>

            <!-- 4. Add Health Record Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openAddHealthModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add Health Record
            </button>

        </div>
    </div>

    <!-- Student Health & Categorized Concern Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="tblHealth">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 10%;">Health No.</th>
                    <th class="py-3" style="width: 17%;">Student Name</th>
                    <th class="py-3" style="width: 15%;">Concern Category</th>
                    <th class="py-3" style="width: 17%;">Concern / Diagnosis</th>
                    <th class="py-3" style="width: 17%;">Service Provided</th>
                    <th class="py-3 text-center" style="width: 10%;">Visit Date</th>
                    <th class="py-3" style="width: 13%;">Attending Staff</th>
                    <th class="py-3 text-center" style="width: 11%;">Follow-up</th>
                    <th class="py-3 text-center pe-3" style="width: 8%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="healthTableBody">
                <tr class="health-row" id="row-hs-0364" data-id="hs-0364" data-student="villanueva, kim d." data-category="Mental Health" data-status="Scheduled">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">HS-0364</td>
                    <td class="fw-semibold text-dark truncate-cell">Villanueva, Kim D.</td>
                    <td><span class="badge-category-mental">Mental Health</span></td>
                    <td class="text-muted truncate-cell">Anxiety episode</td>
                    <td class="text-muted truncate-cell">First aid, psych referral</td>
                    <td class="text-center text-muted text-nowrap">Sep 12, 2026</td>
                    <td class="text-muted truncate-cell">Nurse D. Ilagan</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-scheduled">Scheduled</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialHealthModal('HS-0364', 'Villanueva, Kim D.', 'Mental Health', 'Anxiety episode', 'First aid, psych referral', 'Sep 12, 2026', 'Nurse D. Ilagan', 'Scheduled', 'Referred to Guidance Counselor G. Panganiban for follow-up cognitive stress evaluation.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="health-row" id="row-hs-0363" data-id="hs-0363" data-student="torres, miguel a." data-category="Physical Illness" data-status="None needed">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">HS-0363</td>
                    <td class="fw-semibold text-dark truncate-cell">Torres, Miguel A.</td>
                    <td><span class="badge-category-physical">Physical Illness</span></td>
                    <td class="text-muted truncate-cell">Mild fever, flu-like symptoms</td>
                    <td class="text-muted truncate-cell">Consultation, medication</td>
                    <td class="text-center text-muted text-nowrap">Sep 10, 2026</td>
                    <td class="text-muted truncate-cell">Dr. R. Salcedo</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-none">None needed</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialHealthModal('HS-0363', 'Torres, Miguel A.', 'Physical Illness', 'Mild fever, flu-like symptoms', 'Consultation, medication', 'Sep 10, 2026', 'Dr. R. Salcedo', 'None needed', 'Prescribed antipyretics and advised 2 days bed rest. No further clinic visit required.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="health-row" id="row-hs-0362" data-id="hs-0362" data-student="aquino, ronald p." data-category="Injury / Trauma" data-status="Cleared">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">HS-0362</td>
                    <td class="fw-semibold text-dark truncate-cell">Aquino, Ronald P.</td>
                    <td><span class="badge-category-injury">Injury / Trauma</span></td>
                    <td class="text-muted truncate-cell">Sports-related sprain</td>
                    <td class="text-muted truncate-cell">First aid, rest advisory</td>
                    <td class="text-center text-muted text-nowrap">Sep 04, 2026</td>
                    <td class="text-muted truncate-cell">Nurse D. Ilagan</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-cleared">Cleared</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialHealthModal('HS-0362', 'Aquino, Ronald P.', 'Injury / Trauma', 'Sports-related sprain', 'First aid, rest advisory', 'Sep 04, 2026', 'Nurse D. Ilagan', 'Cleared', 'Ankle inflammation resolved after cold compress and elastic bandage application. Medical clearance issued.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="health-row" id="row-hs-0361" data-id="hs-0361" data-student="bautista, hazel m." data-category="Stress & Wellness" data-status="Monitoring">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">HS-0361</td>
                    <td class="fw-semibold text-dark truncate-cell">Bautista, Hazel M.</td>
                    <td><span class="badge-category-stress">Stress & Wellness</span></td>
                    <td class="text-muted truncate-cell">Migraine, stress-related</td>
                    <td class="text-muted truncate-cell">Medication, guidance referral</td>
                    <td class="text-center text-muted text-nowrap">Aug 27, 2026</td>
                    <td class="text-muted truncate-cell">Dr. R. Salcedo</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-monitoring">Monitoring</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialHealthModal('HS-0361', 'Bautista, Hazel M.', 'Stress & Wellness', 'Migraine, stress-related', 'Medication, guidance referral', 'Aug 27, 2026', 'Dr. R. Salcedo', 'Monitoring', 'Somatic headache related to academic midterm stress. Scheduled for weekly blood pressure check.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noHealthRecordsRow" style="display: none;">
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No health records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 4 of 4 health records</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Health Record Governance & Data Confidentiality Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-file-earmark-medical-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Medical Confidentiality & Referral Governance</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Student medical records and psychological evaluations are strictly confidential under the Data Privacy Act and healthcare ethics standards[cite: 1]. Referrals between the Health Services Unit, Guidance Office, and OSAS case officers require documented student consent except in emergency safeguarding interventions[cite: 1].
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (HEALTH RECORD FOCUS)            -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialHealthModal" tabindex="-1" aria-labelledby="essentialHealthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">HEALTH RECORD DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vHealthNo">HS-0364</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeHealthNo" value="">

                <!-- 1. Student Name Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student Name</span>
                        <span class="status-badge-scheduled" id="vStatusBadge">Scheduled</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Villanueva, Kim D.</h5>
                </div>

                <!-- 2. Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Concern Category</div>
                            <div class="essential-value marsu-maroon-text" id="vCategory">Mental Health</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Visit Date</div>
                            <div class="essential-value text-dark" id="vVisitDate">Sep 12, 2026</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Concern / Diagnosis</div>
                            <div class="essential-value text-dark" id="vDiagnosis">Anxiety episode</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Service Provided</div>
                            <div class="essential-value text-dark" id="vServiceProvided">First aid, psych referral</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Attending Staff</div>
                            <div class="essential-value text-dark" id="vAttendingStaff">Nurse D. Ilagan</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Clinic Care Lifecycle Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="hst1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Consulted</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="hst2">2</div>
                            <span class="compact-step-label text-dark fw-bold">Monitoring</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="hst3">3</div>
                            <span class="compact-step-label">Cleared</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Clinical / Guidance Notes -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Clinical & Referral Notes</div>
                    <div class="small text-dark fw-semibold" id="vHealthNotes">Referred to Guidance Counselor G. Panganiban for follow-up cognitive stress evaluation.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Follow-up Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Scheduled">Scheduled</option>
                            <option value="Monitoring">Monitoring</option>
                            <option value="Cleared">Cleared</option>
                            <option value="None needed">None needed</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialHealthStatus()">Save Status</button>
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
<!-- MODAL 2: ADD NEW HEALTH RECORD ENTRY                                  -->
<!-- ===================================================================== -->
<div class="modal fade" id="addHealthModal" tabindex="-1" aria-labelledby="addHealthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addHealthModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Add Health Record
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addHealthForm" onsubmit="saveNewHealthRecord(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Health No.</label>
                            <input type="text" class="form-control form-control-sm" id="newHealthNo" placeholder="e.g. HS-0365" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Concern Category</label>
                            <select class="form-select form-select-sm" id="newCategory" required>
                                <option value="Mental Health">Mental Health</option>
                                <option value="Physical Illness">Physical Illness</option>
                                <option value="Injury / Trauma">Injury / Trauma</option>
                                <option value="Stress & Wellness">Stress & Wellness</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. De Cruz, Angela R." required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Concern / Diagnosis</label>
                            <input type="text" class="form-control form-control-sm" id="newDiagnosis" placeholder="e.g. Acute gastritis" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Service Provided</label>
                            <input type="text" class="form-control form-control-sm" id="newServiceProvided" placeholder="e.g. Antacids given, rest" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Visit Date</label>
                            <input type="date" class="form-control form-control-sm" id="newVisitDate" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Attending Staff</label>
                            <input type="text" class="form-control form-control-sm" id="newAttendingStaff" placeholder="e.g. Nurse D. Ilagan" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Follow-up</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Monitoring">Monitoring</option>
                                <option value="Cleared">Cleared</option>
                                <option value="None needed">None needed</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Clinical / Referral Notes</label>
                        <textarea class="form-control form-control-sm" id="newHealthNotes" rows="3" placeholder="Additional treatment details or guidance referrals..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Record</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyHealthFilters() {
        const searchInput = document.getElementById('searchHealth').value.toLowerCase().trim();
        const categoryFilter = document.getElementById('healthCategoryFilter').value;
        const statusFilter = document.getElementById('healthStatusFilter').value;

        const rows = document.querySelectorAll('.health-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const student = row.getAttribute('data-student');
            const category = row.getAttribute('data-category');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || student.includes(searchInput);
            const matchesCategory = !categoryFilter || category.toLowerCase() === categoryFilter.toLowerCase();
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noHealthRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} health records`;
        }
    }

    function openEssentialHealthModal(healthNo, student, category, diagnosis, service, date, staff, status, notes) {
        document.getElementById('activeHealthNo').value = healthNo.toLowerCase();
        document.getElementById('vHealthNo').innerText = healthNo;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vCategory').innerText = category;
        document.getElementById('vDiagnosis').innerText = diagnosis;
        document.getElementById('vServiceProvided').innerText = service;
        document.getElementById('vVisitDate').innerText = date || '—';
        document.getElementById('vAttendingStaff').innerText = staff;
        document.getElementById('vHealthNotes').innerText = notes || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'scheduled') badgeElem.className = 'status-badge-scheduled';
        else if (lower === 'monitoring') badgeElem.className = 'status-badge-monitoring';
        else if (lower === 'cleared') badgeElem.className = 'status-badge-cleared';
        else badgeElem.className = 'status-badge-none';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('hst1');
        const st2 = document.getElementById('hst2');
        const st3 = document.getElementById('hst3');

        st1.className = 'compact-step-circle completed';

        if (lower === 'cleared' || lower === 'none needed') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st3.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'monitoring' || lower === 'scheduled') {
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
            const modalElem = document.getElementById('essentialHealthModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Health Record Details: ' + healthNo);
        }
    }

    function saveEssentialHealthStatus() {
        const activeHealthNo = document.getElementById('activeHealthNo').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeHealthNo);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-none';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'scheduled') newBadgeClass = 'status-badge-scheduled';
            else if (lowerStatus === 'monitoring') newBadgeClass = 'status-badge-monitoring';
            else if (lowerStatus === 'cleared') newBadgeClass = 'status-badge-cleared';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const studentText = targetRow.cells[1].innerText;
                const categoryText = targetRow.cells[2].innerText.trim();
                const diagnosisText = targetRow.cells[3].innerText;
                const serviceText = targetRow.cells[4].innerText;
                const dateText = targetRow.cells[5].innerText;
                const staffText = targetRow.cells[6].innerText;
                const notesText = document.getElementById('vHealthNotes').innerText;

                viewBtn.setAttribute('onclick', `openEssentialHealthModal('${idText}', '${studentText}', '${categoryText}', '${diagnosisText}', '${serviceText}', '${dateText}', '${staffText}', '${newStatus}', '${notesText}')`);
            }
        }

        const modalElem = document.getElementById('essentialHealthModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        recalculateMetrics();
        applyHealthFilters();
        alert('Health record follow-up status successfully updated!');
    }

    function openAddHealthModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addHealthModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add Health Record Form');
        }
    }

    function recalculateMetrics() {
        const rows = document.querySelectorAll('.health-row');
        let totalVisits = rows.length;
        let monitoringCount = 0;
        let scheduledCount = 0;
        let clearedCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();

            if (status === 'monitoring') {
                monitoringCount++;
            } else if (status === 'scheduled') {
                scheduledCount++;
            } else if (status === 'cleared' || status === 'none needed') {
                clearedCount++;
            }
        });

        document.getElementById('metricTotalVisits').innerText = totalVisits;
        document.getElementById('metricMonitoring').innerText = monitoringCount;
        document.getElementById('metricScheduled').innerText = scheduledCount;
        document.getElementById('metricCleared').innerText = clearedCount;
    }

    function saveNewHealthRecord(e) {
        e.preventDefault();

        const healthNo = document.getElementById('newHealthNo').value.trim();
        const category = document.getElementById('newCategory').value;
        const student = document.getElementById('newStudentName').value.trim();
        const diagnosis = document.getElementById('newDiagnosis').value.trim();
        const service = document.getElementById('newServiceProvided').value.trim();
        const rawDate = document.getElementById('newVisitDate').value;
        const staff = document.getElementById('newAttendingStaff').value.trim();
        const status = document.getElementById('newStatus').value;
        const notes = document.getElementById('newHealthNotes').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-none';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'scheduled') badgeClass = 'status-badge-scheduled';
        else if (lowerStatus === 'monitoring') badgeClass = 'status-badge-monitoring';
        else if (lowerStatus === 'cleared') badgeClass = 'status-badge-cleared';

        let categoryBadgeClass = 'badge-category-physical';
        const lowerCat = category.toLowerCase();
        if (lowerCat.includes('mental')) categoryBadgeClass = 'badge-category-mental';
        else if (lowerCat.includes('injury')) categoryBadgeClass = 'badge-category-injury';
        else if (lowerCat.includes('stress')) categoryBadgeClass = 'badge-category-stress';

        const rowId = 'row-' + healthNo.toLowerCase();
        const tbody = document.getElementById('healthTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'health-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', healthNo.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-category', category);
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${healthNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td><span class="${categoryBadgeClass}">${category}</span></td>
            <td class="text-muted truncate-cell">${diagnosis}</td>
            <td class="text-muted truncate-cell">${service}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-muted truncate-cell">${staff}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialHealthModal('${healthNo}', '${student}', '${category}', '${diagnosis}', '${service}', '${formattedDate}', '${staff}', '${status}', '${notes}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('addHealthModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('addHealthForm').reset();

        recalculateMetrics();
        applyHealthFilters();
    }
</script>