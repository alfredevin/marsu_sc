<div class="container-fluid px-4 py-3" id="completionReportingRoot">

    <!-- CSS Safeguards & Custom Design System Tokens -->
    <style>
        #completionReportingRoot, #completionReportingRoot * {
            box-sizing: border-box;
        }

        .modal-backdrop:not(.show) {
            display: none !important;
        }

        :root {
            --maroon-main: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #fff0f3;
            --gold-accent: #d4af37;
            --gold-light: #fffdf0;
        }

        .text-maroon { color: var(--maroon-main) !important; }
        .bg-maroon { background-color: var(--maroon-main) !important; color: #fff !important; }

        .btn-maroon {
            background-color: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #fff;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-maroon:hover, .btn-maroon:focus {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #fff;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.25);
        }

        .btn-gold {
            background-color: var(--gold-accent);
            border-color: var(--gold-accent);
            color: #212529;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-gold:hover, .btn-gold:focus {
            background-color: #c09e2e;
            border-color: #c09e2e;
            color: #111;
        }

        /* Page Hero Banner */
        .page-hero {
            background: linear-gradient(135deg, #800020 0%, #4a0013 50%, #29000a 100%);
            color: #ffffff;
            border-radius: 14px;
            padding: 26px 30px;
            margin-bottom: 24px;
            box-shadow: 0 6px 20px rgba(128, 0, 32, 0.22);
            position: relative;
            overflow: hidden;
        }
        .page-hero::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.18) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-badge-tag, .hero-badge {
            background: rgba(212, 175, 55, 0.25);
            color: #d4af37;
            border: 1px solid rgba(212, 175, 55, 0.45);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .page-hero-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
            letter-spacing: -0.01em;
            line-height: 1.25;
        }

        .page-hero-subtitle {
            font-size: 0.94rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            max-width: 720px;
            line-height: 1.5;
        }

        /* Nav Pills Header */
        .main-nav-pill {
            padding: 10px 22px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            color: #495057;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            transition: all 0.25s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .main-nav-pill:hover {
            background-color: var(--maroon-light);
            color: var(--maroon-main);
            border-color: rgba(128, 0, 32, 0.3);
        }
        .main-nav-pill.active {
            background: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 4px 14px rgba(128, 0, 32, 0.3);
        }

        /* Status Pills */
        .status-pill {
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .status-pill-verified { background-color: #d1fae5; color: #065f46; }
        .status-pill-pending { background-color: #fef3c7; color: #92400e; }
        .status-pill-audit { background-color: #e0f2fe; color: #075985; }

        /* Certificate Preview Widget Card */
        .certificate-preview-box {
            background: linear-gradient(135deg, #ffffff 0%, #fffdf0 100%);
            border: 2px dashed var(--gold-accent);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        /* Timeline Items */
        .timeline-item {
            position: relative;
            padding-left: 24px;
            margin-bottom: 18px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 14px;
            bottom: -20px;
            width: 2px;
            background: #e2e8f0;
        }
        .timeline-item:last-child::before { display: none; }
        .timeline-dot {
            position: absolute;
            left: 0;
            top: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background-color: var(--maroon-main);
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 2px rgba(128, 0, 32, 0.2);
        }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 300px;
        }
    </style>

    <!-- Page Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="fas fa-certificate me-1"></i> Official Clearance & Certification Module</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-flag-checkered me-2 text-warning"></i>Completion & Accomplishment Reporting
            </h1>
            <p class="page-hero-subtitle">
                Submit final research terminal reports, verify financial & IP clearances, and generate official MSU Certificates of Research Accomplishment.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#submitReportModal">
                <i class="fas fa-plus-circle me-1"></i> Submit Terminal Report
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="switchReportTab('certgen')">
                <i class="fas fa-award me-1"></i> Certificate Generator
            </button>
            <button class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportAccomplishmentCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Summary CSV
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill active"><i class="bi bi-award text-white me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Completed Projects</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['completed'] ?? 74) ?></div>
                            <div class="small text-success font-weight-bold mt-1"><i class="fas fa-arrow-up me-1"></i>+12 projects this AY</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flag-checkered fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Certified & Cleared</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['certified'] ?? 58) ?></div>
                            <div class="small text-muted font-weight-bold mt-1">78.3% total clearance rate</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-award fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Under Review / Audit</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['pending'] ?? 16) ?></div>
                            <div class="small text-warning font-weight-bold mt-1"><i class="fas fa-clock me-1"></i>Requires Director Action</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">On-Time Submission Rate</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['ontime_rate'] ?? 94.2, 1) ?>%</div>
                            <div class="small text-info font-weight-bold mt-1"><i class="fas fa-shield-alt me-1"></i>High Compliance Score</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation View Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button type="button" class="main-nav-pill active" id="tabNavRegistry" onclick="switchReportTab('registry')">
            <i class="fas fa-list-alt text-maroon"></i> Accomplishment Reports Registry
        </button>
        <button type="button" class="main-nav-pill" id="tabNavCertgen" onclick="switchReportTab('certgen')">
            <i class="fas fa-award text-warning"></i> Certificate & Clearance Generator
        </button>
        <button type="button" class="main-nav-pill" id="tabNavColleges" onclick="switchReportTab('colleges')">
            <i class="fas fa-university text-info"></i> Completion Rate by College
        </button>
        <button type="button" class="main-nav-pill" id="tabNavFeed" onclick="switchReportTab('feed')">
            <i class="fas fa-history text-success"></i> Clearance Activity Feed
        </button>
    </div>


    <!-- ==================================================================================== -->
    <!-- TAB 1: ACCOMPLISHMENT REPORTS REGISTRY                                              -->
    <!-- ==================================================================================== -->
    <div id="reportSectionRegistry" class="report-tab-view">
        <div class="row">

            <!-- Left Column: Table & Filters (8 Cols) -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm mb-4">

                    <!-- Header & Search Toolbar -->
                    <div class="card-header bg-white py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div>
                                <h6 class="font-weight-bold text-maroon mb-1"><i class="fas fa-list-alt me-2 text-warning"></i>Terminal Reports Registry</h6>
                                <p class="text-muted small mb-0">Browse, review, and verify final research terminal reports.</p>
                            </div>

                            <!-- Search Input -->
                            <div class="input-group input-group-sm" style="max-width: 260px;">
                                <input type="text" id="reportSearchInput" class="form-control" placeholder="Search project or lead..." oninput="filterReportsTable()">
                                <span class="input-group-text bg-maroon text-white"><i class="fas fa-search"></i></span>
                            </div>
                        </div>

                        <!-- Status Filter Buttons -->
                        <div class="btn-group btn-group-sm mt-3">
                            <button type="button" class="btn btn-outline-secondary active" onclick="filterReportStatus('all', this)">All Reports (74)</button>
                            <button type="button" class="btn btn-outline-success" onclick="filterReportStatus('cleared', this)"><i class="fas fa-check-circle me-1"></i>Certified Clearance (58)</button>
                            <button type="button" class="btn btn-outline-warning text-dark" onclick="filterReportStatus('pending', this)"><i class="fas fa-clock me-1"></i>Under Review (16)</button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle small mb-0" id="reportsTable">
                                <thead class="bg-light text-dark">
                                    <tr>
                                        <th>Project ID & Title</th>
                                        <th>Lead Researcher</th>
                                        <th>Completion Date</th>
                                        <th>Clearance Status</th>
                                        <th class="text-center">Certificate</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Row 1 -->
                                    <tr data-status="cleared" data-search="rmis-2025-088 smart agriculture monitoring system mhica bianca rodelas ece engineering">
                                        <td>
                                            <strong class="text-dark d-block">RMIS-2025-088</strong>
                                            <div class="text-muted small text-truncate" style="max-width: 240px;">Smart Agriculture Monitoring System for Crop Health</div>
                                            <span class="badge bg-light text-dark border text-xs mt-1">College of Engineering</span>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Mhica Bianca Rodelas</strong>
                                            <small class="text-muted">Dept. of Information Tech</small>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Sep 15, 2026</strong>
                                            <small class="text-success font-weight-bold">On Schedule</small>
                                        </td>
                                        <td>
                                            <span class="status-pill status-pill-verified">
                                                <i class="fas fa-check-circle"></i> Certified & Cleared
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-success font-weight-bold rounded-pill"
                                                    onclick="openCertPreviewModal('RMIS-2025-088', 'Smart Agriculture Monitoring System', 'Mhica Bianca Rodelas', 'College of Engineering')">
                                                <i class="fas fa-award me-1"></i> View Cert
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary font-weight-bold"
                                                    onclick="openReportDetailsModal('RMIS-2025-088', 'Smart Agriculture Monitoring System', 'Mhica Bianca Rodelas', 'Sep 15, 2026', 'Certified & Cleared', '100% Financial Liquidation completed. Scopus-indexed paper published.')">
                                                <i class="fas fa-eye me-1"></i> Details
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Row 2 -->
                                    <tr data-status="pending" data-search="rmis-2025-074 renewable biomass conversion roberto cruz agri agriculture">
                                        <td>
                                            <strong class="text-dark d-block">RMIS-2025-074</strong>
                                            <div class="text-muted small text-truncate" style="max-width: 240px;">Renewable Biomass Conversion for Rural Micro-Grids</div>
                                            <span class="badge bg-light text-dark border text-xs mt-1">College of Agriculture</span>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Prof. Gabriel Ramos</strong>
                                            <small class="text-muted">Agri-Biosystems Dept</small>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Aug 28, 2026</strong>
                                            <small class="text-muted">Submitted</small>
                                        </td>
                                        <td>
                                            <span class="status-pill status-pill-pending">
                                                <i class="fas fa-clock"></i> Financial Audit Review
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-muted small"><i class="fas fa-lock me-1"></i>Pending Audit</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary font-weight-bold"
                                                    onclick="openReportDetailsModal('RMIS-2025-074', 'Renewable Biomass Conversion', 'Prof. Gabriel Ramos', 'Aug 28, 2026', 'Under Financial Audit Review', 'Final terminal report submitted. Pending accounting audit verification.')">
                                                <i class="fas fa-eye me-1"></i> Details
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr data-status="cleared" data-search="rmis-2025-061 indigenous botanical extracts elena reyes biology science">
                                        <td>
                                            <strong class="text-dark d-block">RMIS-2025-061</strong>
                                            <div class="text-muted small text-truncate" style="max-width: 240px;">Indigenous Botanical Extracts as Natural Antimicrobials</div>
                                            <span class="badge bg-light text-dark border text-xs mt-1">College of Science</span>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Dr. Elena Cruz</strong>
                                            <small class="text-muted">Department of Biology</small>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Aug 10, 2026</strong>
                                            <small class="text-success font-weight-bold">Completed</small>
                                        </td>
                                        <td>
                                            <span class="status-pill status-pill-verified">
                                                <i class="fas fa-check-circle"></i> Certified & Cleared
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-success font-weight-bold rounded-pill"
                                                    onclick="openCertPreviewModal('RMIS-2025-061', 'Indigenous Botanical Extracts', 'Dr. Elena Cruz', 'College of Science')">
                                                <i class="fas fa-award me-1"></i> View Cert
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary font-weight-bold"
                                                    onclick="openReportDetailsModal('RMIS-2025-061', 'Indigenous Botanical Extracts', 'Dr. Elena Cruz', 'Aug 10, 2026', 'Certified & Cleared', 'Patent disclosure filed with IPOPHL. Final report approved by Research Directorate.')">
                                                <i class="fas fa-eye me-1"></i> Details
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Row 4 -->
                                    <tr data-status="pending" data-search="rmis-2025-052 socio economic impact e governance juan dela cruz political social">
                                        <td>
                                            <strong class="text-dark d-block">RMIS-2025-052</strong>
                                            <div class="text-muted small text-truncate" style="max-width: 240px;">Socio-Economic Impact of E-Governance in Marinduque</div>
                                            <span class="badge bg-light text-dark border text-xs mt-1">College of Social Sciences</span>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Dr. Arthur Pendelton</strong>
                                            <small class="text-muted">Dept of Political Science</small>
                                        </td>
                                        <td>
                                            <strong class="d-block text-dark">Jul 30, 2026</strong>
                                            <small class="text-muted">Completed</small>
                                        </td>
                                        <td>
                                            <span class="status-pill status-pill-audit">
                                                <i class="fas fa-file-signature"></i> IP & Output Clearance
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-muted small"><i class="fas fa-spinner fa-spin me-1"></i>Processing</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary font-weight-bold"
                                                    onclick="openReportDetailsModal('RMIS-2025-052', 'Socio-Economic Impact of E-Governance', 'Dr. Arthur Pendelton', 'Jul 30, 2026', 'IP & Output Clearance', 'IP clearance pending verification by University TTO.')">
                                                <i class="fas fa-eye me-1"></i> Details
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Verification & Widgets (4 Cols) -->
            <div class="col-lg-4">

                <!-- Certificate Generator Box -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="font-weight-bold text-maroon mb-0">
                            <i class="fas fa-certificate text-warning me-2"></i>Certificate Verification
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="certificate-preview-box mb-3">
                            <i class="fas fa-university text-maroon fa-2x mb-2"></i>
                            <div class="text-xs font-weight-bold text-uppercase text-muted" style="letter-spacing:0.08em;">Marinduque State University</div>
                            <div class="font-weight-bold text-dark mt-1" style="font-size: 0.92rem;">
                                CERTIFICATE OF RESEARCH ACCOMPLISHMENT
                            </div>
                            <div class="text-muted text-xs mt-1">Official Digital Badge & Security Clearance</div>
                            <div class="mt-3">
                                <span class="badge bg-success px-3 py-1 font-weight-bold"><i class="fas fa-shield-alt me-1"></i>QR Verified</span>
                            </div>
                        </div>
                        <button class="btn btn-maroon w-100 font-weight-bold shadow-sm" onclick="switchReportTab('certgen')">
                            <i class="fas fa-award me-1"></i> Generate Official Certificate
                        </button>
                    </div>
                </div>

                <!-- Recent Activity Feed -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="font-weight-bold text-maroon mb-0">
                            <i class="fas fa-history text-warning me-2"></i>Clearance Activity Feed
                        </h6>
                    </div>
                    <div class="card-body pt-3">
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="text-xs font-weight-bold text-dark">Certificate Approved</div>
                            <div class="text-muted text-xs">Project RMIS-2025-088 clearance granted by Director.</div>
                            <div class="text-muted text-xs mt-1"><i class="far fa-clock me-1"></i>2 hours ago</div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-dot bg-warning"></div>
                            <div class="text-xs font-weight-bold text-dark">Terminal Report Submitted</div>
                            <div class="text-muted text-xs">Prof. Gabriel Ramos submitted final report package for RMIS-2025-074.</div>
                            <div class="text-muted text-xs mt-1"><i class="far fa-clock me-1"></i>Yesterday at 4:15 PM</div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-dot bg-info"></div>
                            <div class="text-xs font-weight-bold text-dark">IP Declaration Uploaded</div>
                            <div class="text-muted text-xs">Dr. Elena Cruz filed Patent Disclosure for RMIS-2025-061.</div>
                            <div class="text-muted text-xs mt-1"><i class="far fa-clock me-1"></i>3 days ago</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- /#reportSectionRegistry -->


    <!-- ==================================================================================== -->
    <!-- TAB 2: DIGITAL CERTIFICATE & CLEARANCE GENERATOR                                    -->
    <!-- ==================================================================================== -->
    <div id="reportSectionCertgen" class="report-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-maroon">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-maroon">
                    <i class="fas fa-award me-2"></i>Digital Clearance Certificate Generator Workspace
                </h5>
                <span class="badge bg-gold text-dark font-weight-bold px-3 py-1">Official Research Clearance</span>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <!-- Form Control -->
                    <div class="col-lg-5">
                        <div class="p-3 bg-light rounded border mb-3">
                            <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-cog me-2 text-maroon"></i>Certificate Parameters</h6>

                            <div class="mb-3">
                                <label class="form-label font-weight-bold text-dark">Select Project Code</label>
                                <select class="form-select" id="certGenProjectSelect" onchange="updateCertPreviewLive(this)">
                                    <option value="RMIS-2025-088" data-title="Smart Agriculture Monitoring System" data-pi="Mhica Bianca Rodelas" data-college="College of Engineering" selected>
                                        RMIS-2025-088 (Smart Agriculture Monitoring System)
                                    </option>
                                    <option value="RMIS-2025-061" data-title="Indigenous Botanical Extracts" data-pi="Dr. Elena Cruz" data-college="College of Science">
                                        RMIS-2025-061 (Indigenous Botanical Extracts)
                                    </option>
                                    <option value="PRJ-2026-001" data-title="AI-Driven Water Quality Monitoring" data-pi="Mhica Bianca Rodelas" data-college="College of Info Tech">
                                        PRJ-2026-001 (AI-Driven Water Quality Monitoring)
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-weight-bold text-dark">Clearance Type</label>
                                <select class="form-select" id="certGenTypeSelect">
                                    <option value="Full Clearance" selected>Full Institutional Clearance & Terminal Endorsement</option>
                                    <option value="IP Clearance">Intellectual Property & Output Clearance</option>
                                    <option value="Financial Clearance">Financial Liquidation & Accounting Clearance</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-weight-bold text-dark">Issuing Director Signatory</label>
                                <input type="text" class="form-control" id="certGenSignatory" value="Dr. Vicente Tan, PhD (Director of Research)">
                            </div>

                            <button type="button" class="btn btn-maroon w-100 font-weight-bold shadow-sm" onclick="printCertLive()">
                                <i class="fas fa-print me-1"></i> Print / Download Certificate PDF
                            </button>
                        </div>
                    </div>

                    <!-- Certificate Live Preview -->
                    <div class="col-lg-7">
                        <div class="p-4 border border-2 border-warning rounded bg-white text-center shadow-sm" id="liveCertPaper">
                            <div class="mb-2">
                                <h5 class="text-maroon font-weight-bold mb-0" style="letter-spacing:1px;">MARINDUQUE STATE UNIVERSITY</h5>
                                <small class="text-muted font-weight-bold text-uppercase">Office of the Vice President for Research & Extension</small>
                            </div>

                            <div class="my-4">
                                <h3 class="font-weight-bold text-dark text-uppercase mb-1" style="font-family: serif;">CERTIFICATE OF ACCOMPLISHMENT</h3>
                                <small class="text-muted font-weight-bold text-uppercase d-block" style="letter-spacing:2px;">AND FINAL RESEARCH CLEARANCE</small>
                            </div>

                            <p class="small text-muted mb-2">This is to certify that the research project titled</p>
                            <h5 class="font-weight-bold text-maroon mb-3" id="previewCertProjectTitle">"Smart Agriculture Monitoring System for Crop Health"</h5>

                            <p class="small text-muted mb-1">submitted by Principal Investigator</p>
                            <h6 class="font-weight-bold text-dark mb-3" id="previewCertPiName">Mhica Bianca Rodelas</h6>
                            <p class="small text-muted mb-4" id="previewCertCollege">College of Engineering</p>

                            <p class="small text-muted mb-4 px-3">
                                has satisfactorily fulfilled all terminal reporting requirements, financial liquidation audits, and intellectual property declarations required under University Research Guidelines.
                            </p>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top px-3 text-start small">
                                <div>
                                    <div class="text-muted">Clearance ID: <strong id="previewCertCode">RMIS-2025-088</strong></div>
                                    <div class="text-muted">Issued: <strong><?= date('F d, Y') ?></strong></div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success px-3 py-1 font-weight-bold"><i class="fas fa-qrcode me-1"></i>QR SECURITY VERIFIED</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#reportSectionCertgen -->


    <!-- ==================================================================================== -->
    <!-- TAB 3: COLLEGE COMPLETION RATE TRACKER                                               -->
    <!-- ==================================================================================== -->
    <div id="reportSectionColleges" class="report-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-info">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-university me-2"></i>Completion Rate by College & Department
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="p-3 bg-light rounded border mb-3">
                            <div class="d-flex justify-content-between text-sm font-weight-bold mb-1">
                                <span class="text-dark">College of Engineering</span>
                                <span class="text-maroon font-weight-bold">92%</span>
                            </div>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar bg-maroon" role="progressbar" style="width: 92%;"></div>
                            </div>

                            <div class="d-flex justify-content-between text-sm font-weight-bold mb-1">
                                <span class="text-dark">College of Agriculture</span>
                                <span class="text-success font-weight-bold">88%</span>
                            </div>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 88%;"></div>
                            </div>

                            <div class="d-flex justify-content-between text-sm font-weight-bold mb-1">
                                <span class="text-dark">College of Science & Math</span>
                                <span class="text-info font-weight-bold">84%</span>
                            </div>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 84%;"></div>
                            </div>

                            <div class="d-flex justify-content-between text-sm font-weight-bold mb-1">
                                <span class="text-dark">College of Social Sciences</span>
                                <span class="text-warning font-weight-bold">76%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 76%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="p-3 bg-white rounded border text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="font-weight-bold text-dark mb-2">Institutional Completion Summary</h6>
                                <p class="small text-muted mb-3">78.3% of terminal reports submitted across all university units have been granted final clearance status.</p>
                                <div class="h2 font-weight-bold text-success mb-1">58 / 74</div>
                                <span class="badge bg-success px-3 py-1 font-weight-bold">Clearence Threshold Exceeded</span>
                            </div>
                            <div>
                                <button class="btn btn-outline-info btn-sm w-100 font-weight-bold" onclick="showToast('Report Exported', 'College completion rates exported.')">
                                    <i class="fas fa-download me-1"></i> Export College Rates CSV
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#reportSectionColleges -->


    <!-- ==================================================================================== -->
    <!-- TAB 4: CLEARANCE ACTIVITY FEED                                                       -->
    <!-- ==================================================================================== -->
    <div id="reportSectionFeed" class="report-tab-view d-none">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-maroon">
                    <i class="fas fa-history me-2"></i>Full Clearance Audit & Activity Feed
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="text-sm font-weight-bold text-dark">Certificate Approved</div>
                    <div class="text-muted small">Project RMIS-2025-088 clearance granted by Director of Research.</div>
                    <div class="text-muted text-xs mt-1"><i class="far fa-clock me-1"></i>2 hours ago</div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot bg-warning"></div>
                    <div class="text-sm font-weight-bold text-dark">Terminal Report Submitted</div>
                    <div class="text-muted small">Prof. Gabriel Ramos submitted final report package for RMIS-2025-074.</div>
                    <div class="text-muted text-xs mt-1"><i class="far fa-clock me-1"></i>Yesterday at 4:15 PM</div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot bg-info"></div>
                    <div class="text-sm font-weight-bold text-dark">IP Declaration Uploaded</div>
                    <div class="text-muted small">Dr. Elena Cruz filed Patent Disclosure for RMIS-2025-061.</div>
                    <div class="text-muted text-xs mt-1"><i class="far fa-clock me-1"></i>3 days ago</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#reportSectionFeed -->

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: SUBMIT TERMINAL REPORT MODAL                                               -->
<!-- ==================================================================================== -->
<div class="modal fade" id="submitReportModal" tabindex="-1" aria-labelledby="submitReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle me-2"></i>Submit Terminal Accomplishment Report</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="handleSubmitTerminalReport(event)">
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Project Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modalProjectCode" placeholder="e.g. RMIS-2026-099" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Lead Principal Investigator <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modalPiName" placeholder="e.g. Mhica Bianca Rodelas" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label font-weight-bold text-dark">Research Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modalProjectTitle" placeholder="e.g. AI-Based Telemetry for River Basin Quality" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">College / Unit</label>
                            <select class="form-select" id="modalCollege">
                                <option value="College of Engineering">College of Engineering</option>
                                <option value="College of Agriculture">College of Agriculture</option>
                                <option value="College of Science">College of Science</option>
                                <option value="College of Information Tech" selected>College of Information Tech</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Completion Date</label>
                            <input type="date" class="form-control" id="modalCompletionDate" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Executive Summary & Accomplishment Highlights <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="modalExecutiveSummary" rows="3" placeholder="Provide abstract of completed deliverables, field data, and project outcomes..." required></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Published Paper DOI / Link (Optional)</label>
                            <input type="text" class="form-control" placeholder="https://doi.org/10.1016/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">IP Disclosure Reference (Optional)</label>
                            <input type="text" class="form-control" placeholder="IPOPHL Ref # 2026-UM-...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm font-weight-bold">
                        <i class="fas fa-check me-1"></i> Submit Report Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: REPORT DETAILS INSPECTOR MODAL                                             -->
<!-- ==================================================================================== -->
<div class="modal fade" id="reportDetailsModal" tabindex="-1" aria-labelledby="reportDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-file-alt me-2"></i>Terminal Report Dossier</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-maroon text-white fs-6" id="modalDetailCode">RMIS-2025-088</span>
                    <span class="badge bg-success" id="modalDetailStatus">Certified & Cleared</span>
                </div>
                <h5 class="font-weight-bold text-dark mb-3" id="modalDetailTitle">Research Title</h5>

                <div class="p-3 bg-light rounded border mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Lead Investigator:</span>
                        <strong id="modalDetailPi">Mhica Bianca Rodelas</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Completion Date:</span>
                        <strong id="modalDetailDate">Sep 15, 2026</strong>
                    </div>
                </div>

                <h6 class="font-weight-bold text-dark small text-uppercase">Accomplishment Remarks</h6>
                <p class="small text-muted mb-0" id="modalDetailNotes">
                    Remarks text...
                </p>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- TOAST NOTIFICATION BANNER -->
<div class="toast-notification d-none" id="actionToast">
    <div class="card shadow-lg border-left-maroon bg-white">
        <div class="card-body p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                <div>
                    <strong class="text-dark d-block" id="toastTitle">Success</strong>
                    <small class="text-muted" id="toastMessage">Action performed successfully.</small>
                </div>
            </div>
            <button type="button" class="btn-close ms-3" onclick="hideToast()"></button>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- INTERACTIVE JAVASCRIPT (ZERO JQUERY DEPENDENCY)                                      -->
<!-- ==================================================================================== -->
<script>
    let activeReportStatusFilter = 'all';

    function switchReportTab(tabKey) {
        document.querySelectorAll('.report-tab-view').forEach(view => {
            view.classList.add('d-none');
        });
        document.querySelectorAll('.main-nav-pill').forEach(pill => {
            pill.classList.remove('active');
        });

        if (tabKey === 'registry') {
            document.getElementById('reportSectionRegistry')?.classList.remove('d-none');
            document.getElementById('tabNavRegistry')?.classList.add('active');
        } else if (tabKey === 'certgen') {
            document.getElementById('reportSectionCertgen')?.classList.remove('d-none');
            document.getElementById('tabNavCertgen')?.classList.add('active');
        } else if (tabKey === 'colleges') {
            document.getElementById('reportSectionColleges')?.classList.remove('d-none');
            document.getElementById('tabNavColleges')?.classList.add('active');
        } else if (tabKey === 'feed') {
            document.getElementById('reportSectionFeed')?.classList.remove('d-none');
            document.getElementById('tabNavFeed')?.classList.add('active');
        }
    }

    function filterReportStatus(statusKey, element) {
        activeReportStatusFilter = statusKey;

        const buttons = element.parentElement.querySelectorAll('.btn');
        buttons.forEach(b => b.classList.remove('active'));
        element.classList.add('active');

        filterReportsTable();
    }

    function filterReportsTable() {
        const query = (document.getElementById('reportSearchInput')?.value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#reportsTable tbody tr');

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status') || '';
            const rowSearch = row.getAttribute('data-search') || '';

            const matchesQuery = !query || rowSearch.includes(query);
            const matchesStatus = (activeReportStatusFilter === 'all') || (rowStatus.toLowerCase() === activeReportStatusFilter.toLowerCase());

            row.style.display = (matchesQuery && matchesStatus) ? '' : 'none';
        });
    }

    function updateCertPreviewLive(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        if (selectedOption) {
            const code = selectedOption.value;
            const title = selectedOption.getAttribute('data-title') || '';
            const pi = selectedOption.getAttribute('data-pi') || '';
            const college = selectedOption.getAttribute('data-college') || '';

            document.getElementById('previewCertProjectTitle').textContent = `"${title}"`;
            document.getElementById('previewCertPiName').textContent = pi;
            document.getElementById('previewCertCollege').textContent = college;
            document.getElementById('previewCertCode').textContent = code;
        }
    }

    function printCertLive() {
        showToast('Certificate Ready', 'Preparing certificate for printing...');
        window.print();
    }

    function openCertPreviewModal(code, title, pi, college) {
        document.getElementById('certGenProjectSelect').value = code;
        document.getElementById('previewCertProjectTitle').textContent = `"${title}"`;
        document.getElementById('previewCertPiName').textContent = pi;
        document.getElementById('previewCertCollege').textContent = college;
        document.getElementById('previewCertCode').textContent = code;

        switchReportTab('certgen');
    }

    function openReportDetailsModal(code, title, pi, date, status, notes) {
        document.getElementById('modalDetailCode').textContent = code;
        document.getElementById('modalDetailTitle').textContent = title;
        document.getElementById('modalDetailPi').textContent = pi;
        document.getElementById('modalDetailDate').textContent = date;
        document.getElementById('modalDetailStatus').textContent = status;
        document.getElementById('modalDetailNotes').textContent = notes;

        const modalEl = document.getElementById('reportDetailsModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function handleSubmitTerminalReport(event) {
        event.preventDefault();
        const code = document.getElementById('modalProjectCode').value.trim();
        const pi = document.getElementById('modalPiName').value.trim();
        const title = document.getElementById('modalProjectTitle').value.trim();
        const college = document.getElementById('modalCollege').value;

        const tbody = document.querySelector('#reportsTable tbody');
        if (tbody) {
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-status', 'pending');
            newRow.setAttribute('data-search', `${code} ${title} ${pi} ${college}`.toLowerCase());
            newRow.innerHTML = `
                <td>
                    <strong class="text-dark d-block">${code}</strong>
                    <div class="text-muted small text-truncate" style="max-width: 240px;">${title}</div>
                    <span class="badge bg-light text-dark border text-xs mt-1">${college}</span>
                </td>
                <td>
                    <strong class="d-block text-dark">${pi}</strong>
                    <small class="text-muted">Faculty Researcher</small>
                </td>
                <td>
                    <strong class="d-block text-dark">${new Date().toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric'})}</strong>
                    <small class="text-muted">Submitted</small>
                </td>
                <td>
                    <span class="status-pill status-pill-pending">
                        <i class="fas fa-clock"></i> Financial Audit Review
                    </span>
                </td>
                <td class="text-center">
                    <span class="text-muted small"><i class="fas fa-lock me-1"></i>Pending Audit</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-outline-secondary font-weight-bold"
                            onclick="openReportDetailsModal('${code}', '${title}', '${pi}', 'Today', 'Submitted - Pending Audit', 'Terminal report package submitted during active session.')">
                        <i class="fas fa-eye me-1"></i> Details
                    </button>
                </td>
            `;
            tbody.insertBefore(newRow, tbody.firstChild);
        }

        const modalEl = document.getElementById('submitReportModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        showToast('Terminal Report Submitted', `${code} report package submitted for institutional audit.`);
    }

    function exportAccomplishmentCSV() {
        const rows = [["Project ID", "Title", "Lead Researcher", "Completion Date", "Status"]];
        document.querySelectorAll('#reportsTable tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 5) {
                const id = cells[0]?.querySelector('strong')?.innerText || '';
                const title = cells[0]?.querySelector('.text-muted')?.innerText || '';
                const pi = cells[1]?.querySelector('strong')?.innerText || '';
                const date = cells[2]?.querySelector('strong')?.innerText || '';
                const status = cells[3]?.innerText.trim() || '';
                rows.push([`"${id}"`, `"${title}"`, `"${pi}"`, `"${date}"`, `"${status}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Terminal_Reports_Registry_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'Terminal reports summary exported to CSV.');
    }

    function showToast(title, message) {
        document.getElementById('toastTitle').textContent = title;
        document.getElementById('toastMessage').textContent = message;
        const toast = document.getElementById('actionToast');
        toast.classList.remove('d-none');
        setTimeout(() => {
            toast.classList.add('d-none');
        }, 4000);
    }

    function hideToast() {
        document.getElementById('actionToast').classList.add('d-none');
    }
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>