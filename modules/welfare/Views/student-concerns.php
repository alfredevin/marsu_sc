<!-- Student Concerns & Health Records Management -->
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
            min-width: 1220px; /* Guarantees horizontal breathing room for all columns */
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

        .status-badge-monitoring {
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

        .status-badge-cleared {
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

        .status-badge-none {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
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
            <span class="small fw-bold text-secondary">UNIVERSITY HEALTH SERVICES</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">HEALTH & CONCERN RECORDS</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Student Health & Concern Records</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Track clinic consultations, categorize physical illnesses, mental health concerns, sports injuries, and stress-related episodes, and manage inter-office follow-up referrals.
        </p>
    </div>

    <!-- Summary Metrics Dashboard Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Visits -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Total Clinic Visits</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1">64</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon ms-2">
                    <i class="bi bi-hospital-fill fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Active Monitoring -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Under Monitoring</div>
                    <div class="fs-2 fw-bold text-dark lh-1">12</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning ms-2">
                    <i class="bi bi-activity fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Psych / Guidance Referrals -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-primary d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Psych / Guidance Referrals</div>
                    <div class="fs-2 fw-bold text-primary lh-1">8</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-primary ms-2">
                    <i class="bi bi-person-heart fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Cleared / Resolved -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="metric-label mb-1">Cleared / Resolved</div>
                    <div class="fs-2 fw-bold text-success lh-1">44</div>
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
                <input type="search" id="searchHealth" class="search-pill-input" placeholder="Search student name, diagnosis, or attending staff..." oninput="filterTable('searchHealth','tblHealth')" autocomplete="off">
            </div>

            <!-- Toolbar Filters & Primary Action Button -->
            <div class="d-flex flex-wrap gap-3 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Concern Category:</label>
                    <select class="form-select form-select-sm filter-select" id="categoryFilter">
                        <option value="">All Concern Categories</option>
                        <option value="Mental Health">Mental Health & Psychological</option>
                        <option value="Physical Illness">Physical Illness & Fever</option>
                        <option value="Injury / Trauma">Sports & Physical Injury</option>
                        <option value="Stress & Wellness">Stress & Somatic Conditions</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Follow-up Status:</label>
                    <select class="form-select form-select-sm filter-select" id="healthStatus" onchange="filterStatus('healthStatus','tblHealth',7)">
                        <option value="">All Statuses</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Monitoring">Monitoring</option>
                        <option value="Cleared">Cleared</option>
                        <option value="None needed">None needed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-2" onclick="openModal('modalHealth')">
                    <i class="bi bi-plus-circle icon-shrink-0"></i> Add Health Record
                </button>
            </div>
        </div>
    </div>

    <!-- Student Health & Categorized Concern Table with Enhanced Spacing -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="tblHealth">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4 py-3.5" style="width: 10%;">Health No.</th>
                    <th class="py-3.5" style="width: 16%;">Student Name</th>
                    <th class="py-3.5" style="width: 15%;">Concern Category</th>
                    <th class="py-3.5" style="width: 18%;">Concern / Diagnosis</th>
                    <th class="py-3.5" style="width: 17%;">Service Provided</th>
                    <th class="py-3.5" style="width: 11%;">Visit Date</th>
                    <th class="py-3.5" style="width: 13%;">Attending Staff</th>
                    <th class="py-3.5 text-center pe-4" style="width: 10%;">Follow-up</th>
                </tr>
            </thead>
            <tbody class="small">
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">HS-0364</td>
                    <td class="fw-semibold text-dark">Villanueva, Kim D.</td>
                    <td>
                        <span class="badge-category-mental">Mental Health</span>
                    </td>
                    <td class="text-muted">Anxiety episode</td>
                    <td class="text-muted">First aid, psych referral</td>
                    <td class="text-muted text-nowrap">Sep 12, 2026</td>
                    <td class="text-muted">Nurse D. Ilagan</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-scheduled">Scheduled</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">HS-0363</td>
                    <td class="fw-semibold text-dark">Torres, Miguel A.</td>
                    <td>
                        <span class="badge-category-physical">Physical Illness</span>
                    </td>
                    <td class="text-muted">Mild fever, flu-like symptoms</td>
                    <td class="text-muted">Consultation, medication</td>
                    <td class="text-muted text-nowrap">Sep 10, 2026</td>
                    <td class="text-muted">Dr. R. Salcedo</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-none">None needed</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">HS-0362</td>
                    <td class="fw-semibold text-dark">Aquino, Ronald P.</td>
                    <td>
                        <span class="badge-category-injury">Injury / Trauma</span>
                    </td>
                    <td class="text-muted">Sports-related sprain</td>
                    <td class="text-muted">First aid, rest advisory</td>
                    <td class="text-muted text-nowrap">Sep 04, 2026</td>
                    <td class="text-muted">Nurse D. Ilagan</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-cleared">Cleared</span>
                    </td>
                </tr>
                <tr>
                    <td class="ps-4 fw-semibold text-secondary text-nowrap">HS-0361</td>
                    <td class="fw-semibold text-dark">Bautista, Hazel M.</td>
                    <td>
                        <span class="badge-category-stress">Stress & Wellness</span>
                    </td>
                    <td class="text-muted">Migraine, stress-related</td>
                    <td class="text-muted">Medication, guidance referral</td>
                    <td class="text-muted text-nowrap">Aug 27, 2026</td>
                    <td class="text-muted">Dr. R. Salcedo</td>
                    <td class="text-center pe-4">
                        <span class="status-badge-monitoring">Monitoring</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span>Showing 4 of 64 health records</span>
        <span>Page 1 of 16</span>
    </div>

    <!-- Health Record Governance & Data Confidentiality Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-file-earmark-medical-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">Medical Confidentiality & Referral Governance</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Student medical records and psychological evaluations are strictly confidential under the Data Privacy Act and healthcare ethics standards. Referrals between the Health Services Unit, Guidance Office, and OSAS case officers require documented student consent except in emergency safeguarding interventions.
                </p>
            </div>
        </div>
    </div>

</div>