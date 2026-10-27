<div class="container-fluid py-3" id="fundingResourcesRoot">

    <!-- CSS & Custom Styling -->
    <style>
        #fundingResourcesRoot, #fundingResourcesRoot * {
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
        .border-left-maroon { border-left: 0.25rem solid var(--maroon-main) !important; }
        .border-left-gold { border-left: 0.25rem solid var(--gold-accent) !important; }

        .btn-maroon {
            background-color: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #fff;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-maroon:hover {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-gold {
            background-color: var(--gold-accent);
            border-color: var(--gold-accent);
            color: #212529;
            font-weight: 700;
        }
        .btn-gold:hover {
            background-color: #c09e2e;
            color: #111;
        }

        .btn-outline-maroon {
            border-color: var(--maroon-main);
            color: var(--maroon-main);
            font-weight: 600;
        }
        .btn-outline-maroon:hover {
            background-color: var(--maroon-main);
            color: #fff;
        }

        /* Navigation Tab Pills */
        .funding-tab-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 18px;
            border-radius: 20px;
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.88rem;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 8px;
            cursor: pointer;
            border: 1px solid #d1d3e2;
            transition: all 0.2s ease;
        }
        .funding-tab-pill:hover {
            background-color: #eaecf4;
            color: var(--maroon-main);
        }
        .funding-tab-pill.active {
            background-color: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
        }

        /* Grant Card Styling */
        .grant-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            transition: all 0.25s ease;
            background: #ffffff;
            height: 100%;
        }
        .grant-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.75rem 1.5rem rgba(128, 0, 32, 0.12) !important;
            border-color: rgba(128, 0, 32, 0.3);
        }

        .grant-agency-badge {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 12px;
        }

        /* Facility Cards */
        .facility-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.25s ease;
            background: #ffffff;
        }
        .facility-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }

        .facility-img-box {
            height: 140px;
            background: linear-gradient(135deg, #800020 0%, #4a0013 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 300px;
        }

        .btn-gold {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #212529;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-gold:hover, .btn-gold:focus {
            background-color: #c09e2e;
            border-color: #c09e2e;
            color: #111;
        }

        /* Standard Uniform MarSU Design System */
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
            width: 320px;
            height: 320px;
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

        .main-nav-pill {
            padding: 0.65rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            color: #495057;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .main-nav-pill:hover {
            background: #e9ecef;
            color: #800020;
        }
        .main-nav-pill.active {
            background: #800020;
            color: #ffffff;
            border-color: #800020;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.2);
        }

        /* Budget Allocator Simulator Card */
        .lib-alloc-card {
            background: #ffffff;
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>

    <!-- Uniform MarSU Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="fas fa-hand-holding-usd me-1"></i> Financial Grants & Shared Labs</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-coins me-2 text-warning"></i>Funding & Research Resources Hub
            </h1>
            <p class="page-hero-subtitle">
                Explore open grant calls, monitor active financial allocations, calculate Line-Item Budgets (LIB), reserve shared lab equipment, and download institutional proposal templates.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm">
                <i class="fas fa-paper-plane me-1"></i> Apply for Grant
            </a>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="openEquipmentBookingModal()">
                <i class="fas fa-microscope me-1"></i> Reserve Lab
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill active"><i class="bi bi-cash-coin text-white me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill"><i class="bi bi-search text-maroon me-1"></i> Discovery Engine</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- Top Metric Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Total Research Budget Pool</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">₱ <?= number_format((float)($stats['total_pool'] ?? 14800000), 2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Allocated & Disbursed Grants</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">₱ <?= number_format((float)($stats['total_allocated'] ?? 2850000), 2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-gold shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Open Calls for Proposals</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">5 Active Calls</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-warning"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Shared Equipment Hubs</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">12 Labs</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-microscope fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Navigation Filter Tabs -->
    <div class="mb-4 d-flex flex-wrap align-items-center">
        <span class="funding-tab-pill active" onclick="switchFundingTab('opportunities', this)">
            <i class="fas fa-bullhorn me-1"></i> Open Grant Opportunities (5)
        </span>
        <span class="funding-tab-pill" onclick="switchFundingTab('allocated', this)">
            <i class="fas fa-file-invoice-dollar me-1"></i> Active Financial Allocations
        </span>
        <span class="funding-tab-pill" onclick="switchFundingTab('simulator', this)">
            <i class="fas fa-calculator me-1"></i> LIB Budget Calculator
        </span>
        <span class="funding-tab-pill" onclick="switchFundingTab('facilities', this)">
            <i class="fas fa-laptop-code me-1"></i> Shared Labs & Equipment
        </span>
        <span class="funding-tab-pill" onclick="switchFundingTab('templates', this)">
            <i class="fas fa-file-download me-1"></i> Templates & Policy Downloads
        </span>
    </div>

    <!-- ==================================================================================== -->
    <!-- TAB 1: OPEN GRANT OPPORTUNITIES                                                      -->
    <!-- ==================================================================================== -->
    <div id="tabOpportunities" class="tab-pane-content">
        <!-- Search & Agency Filter Bar -->
        <div class="card shadow-sm mb-4">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search open grant calls by title, ceiling, or agency..." id="grantSearchInput" oninput="filterGrants()">
                            <button type="button" class="btn bg-maroon text-white"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="small font-weight-bold text-muted me-2">Agency:</span>
                        <select class="form-select form-select-sm d-inline-block" id="agencyFilter" onchange="filterGrants()" style="width: auto; max-width: 220px;">
                            <option value="all" selected>All Funding Agencies</option>
                            <option value="IRF">Institutional IRF</option>
                            <option value="DOST">DOST-GIA</option>
                            <option value="CHED">CHED DARP</option>
                            <option value="Commercialization">Commercialization Accelerator</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="grantsGrid">
            <!-- GRANT 1 -->
            <div class="col-lg-6 mb-4 grant-item" data-agency="IRF" data-search="university institutional research seed grant irf 500000 faculty pis">
                <div class="card grant-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="grant-agency-badge bg-maroon text-white">Institutional IRF</span>
                            <span class="badge bg-success text-white px-2 py-1 font-weight-bold"><i class="fas fa-door-open me-1"></i> Open Call</span>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-1">University Institutional Research Seed Grant 2026-2027</h5>
                        <p class="text-muted small mb-3">Seed funding for early-stage basic and applied research aligned with the University Priority Research Agenda (URA).</p>

                        <div class="p-3 bg-light rounded border mb-3">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Maximum Funding Ceiling</small>
                                    <strong class="text-maroon h5 font-weight-bold m-0">₱ 500,000.00</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Submission Deadline</small>
                                    <strong class="text-danger h6 font-weight-bold m-0"><i class="fas fa-calendar-alt me-1"></i> Oct 30, 2026</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fas fa-user-check me-1"></i> Eligible: Full-Time Faculty & PIs</small>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-1" onclick="openGrantModal('irf_2026')">Guidelines</button>
                                <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-gold">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRANT 2 -->
            <div class="col-lg-6 mb-4 grant-item" data-agency="DOST" data-search="dost gia grants in aid applied innovation program 2500000 commercialization agriculture iot">
                <div class="card grant-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="grant-agency-badge bg-primary text-white">DOST-GIA Grant</span>
                            <span class="badge bg-success text-white px-2 py-1 font-weight-bold"><i class="fas fa-door-open me-1"></i> Open Call</span>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-1">DOST Grants-in-Aid (GIA) Applied Innovation Program</h5>
                        <p class="text-muted small mb-3">External government funding targeted at technology commercialization, smart agriculture, and environmental IoT systems.</p>

                        <div class="p-3 bg-light rounded border mb-3">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Maximum Grant Award</small>
                                    <strong class="text-success h5 font-weight-bold m-0">₱ 2,500,000.00</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Submission Deadline</small>
                                    <strong class="text-dark h6 font-weight-bold m-0"><i class="fas fa-calendar-alt me-1"></i> Nov 15, 2026</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fas fa-industry me-1"></i> Academia-Industry Partnerships</small>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-1" onclick="openGrantModal('dost_gia')">Guidelines</button>
                                <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-gold">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRANT 3 -->
            <div class="col-lg-6 mb-4 grant-item" data-agency="CHED" data-search="ched discovery applied research program darp 1200000 health education social">
                <div class="card grant-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="grant-agency-badge bg-info text-white">CHED Grant</span>
                            <span class="badge bg-secondary text-white px-2 py-1 font-weight-bold"><i class="fas fa-clock me-1"></i> Upcoming</span>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-1">CHED Discovery & Applied Research Program</h5>
                        <p class="text-muted small mb-3">Supporting interdisciplinary higher education research projects in health sciences, education, and social sustainability.</p>

                        <div class="p-3 bg-light rounded border mb-3">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Maximum Funding Ceiling</small>
                                    <strong class="text-maroon h5 font-weight-bold m-0">₱ 1,200,000.00</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Target Opening</small>
                                    <strong class="text-info h6 font-weight-bold m-0"><i class="fas fa-calendar-alt me-1"></i> Dec 01, 2026</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i> Higher Ed Faculty</small>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-1" onclick="openGrantModal('ched_darp')">Guidelines</button>
                                <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-gold">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRANT 4 -->
            <div class="col-lg-6 mb-4 grant-item" data-agency="Commercialization" data-search="university commercialization prototyping accelerator trl 4 750000 patent market">
                <div class="card grant-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="grant-agency-badge bg-warning text-dark">Commercialization</span>
                            <span class="badge bg-danger text-white px-2 py-1 font-weight-bold"><i class="fas fa-exclamation-circle me-1"></i> Closing Soon</span>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-1">University Commercialization & Prototyping Accelerator</h5>
                        <p class="text-muted small mb-3">Targeted funding for research projects at Technology Readiness Level (TRL) 4+ seeking patent protection and market prototyping.</p>

                        <div class="p-3 bg-light rounded border mb-3">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Accelerator Budget</small>
                                    <strong class="text-maroon h5 font-weight-bold m-0">₱ 750,000.00</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted font-weight-bold uppercase d-block text-xs">Submission Deadline</small>
                                    <strong class="text-danger h6 font-weight-bold m-0"><i class="fas fa-calendar-alt me-1"></i> Oct 15, 2026</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fas fa-lightbulb me-1"></i> TRL 4+ Prototypes</small>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-1" onclick="openGrantModal('commercialization')">Guidelines</button>
                                <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-gold">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== -->
    <!-- TAB 2: ACTIVE FINANCIAL ALLOCATIONS                                                  -->
    <!-- ==================================================================================== -->
    <div id="tabAllocated" class="tab-pane-content d-none">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-maroon text-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-table me-2"></i> Active Institutional Grant Allocations & Financial Tracking</h6>
                <button class="btn btn-sm btn-gold font-weight-bold" onclick="exportFinancialLedgerCSV()">
                    <i class="fas fa-download me-1"></i> Export Financial Ledger
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="allocationsTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Project Code</th>
                                <th>Research Title & Lead PI</th>
                                <th>Total Approved Award</th>
                                <th>Disbursed Amount</th>
                                <th>Remaining Balance</th>
                                <th>Budget Utilization</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($projects)): ?>
                                <?php foreach ($projects as $pj): ?>
                                    <?php
                                        $budget = (float)($pj['total_budget'] ?? 0);
                                        $pct = (int)($pj['progress_percent'] ?? 0);
                                        $disbursed = round($budget * ($pct / 100), 2);
                                        $remaining = $budget - $disbursed;
                                        $barBg = $pct >= 100 ? 'bg-success' : ($pct >= 50 ? 'bg-info' : 'bg-warning');
                                    ?>
                                    <tr>
                                        <td><span class="badge bg-maroon text-white"><?= e($pj['project_code']) ?></span></td>
                                        <td>
                                            <strong class="text-dark d-block"><?= e($pj['title']) ?></strong>
                                            <small class="text-muted"><i class="fas fa-user-circle me-1"></i><?= e($pj['lead_pi']) ?> • <?= e($pj['college'] ?? 'N/A') ?></small>
                                        </td>
                                        <td class="font-weight-bold text-dark">₱ <?= number_format($budget, 2) ?></td>
                                        <td class="text-success font-weight-bold">₱ <?= number_format($disbursed, 2) ?></td>
                                        <td class="text-muted">₱ <?= number_format($remaining, 2) ?></td>
                                        <td style="min-width: 130px;">
                                            <div class="progress mb-1" style="height: 10px;">
                                                <div class="progress-bar <?= $barBg ?>" style="width: <?= $pct ?>%;"><?= $pct ?>%</div>
                                            </div>
                                            <small class="text-muted font-weight-bold"><?= $pct ?>% Utilized</small>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-maroon" onclick="openDisbursementModal('<?= e($pj['project_code']) ?>', '<?= e(addslashes($pj['title'])) ?>', <?= $remaining ?>)">
                                                Request Release
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><span class="badge bg-maroon text-white">PROP-2026-7721</span></td>
                                    <td>
                                        <strong class="text-dark">Smart Agricultural Crop Pest Detection</strong><br>
                                        <small class="text-muted">Prof. Gabriel Ramos • College of Agriculture</small>
                                    </td>
                                    <td class="font-weight-bold text-dark">₱ 520,000.00</td>
                                    <td class="text-success font-weight-bold">₱ 350,000.00</td>
                                    <td class="text-muted">₱ 170,000.00</td>
                                    <td style="min-width: 130px;">
                                        <div class="progress mb-1" style="height: 10px;">
                                            <div class="progress-bar bg-success" style="width: 67%;">67%</div>
                                        </div>
                                        <small class="text-muted font-weight-bold">67% Utilized</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-maroon" onclick="openDisbursementModal('PROP-2026-7721', 'Smart Agricultural Crop Pest Detection', 170000)">
                                            Request Release
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-maroon text-white">PROP-2026-5540</span></td>
                                    <td>
                                        <strong class="text-dark">Nanomaterial-Based Solar Cell Efficiency</strong><br>
                                        <small class="text-muted">Engr. Ramon Valenzuela • College of Engineering</small>
                                    </td>
                                    <td class="font-weight-bold text-dark">₱ 680,000.00</td>
                                    <td class="text-success font-weight-bold">₱ 510,000.00</td>
                                    <td class="text-muted">₱ 170,000.00</td>
                                    <td style="min-width: 130px;">
                                        <div class="progress mb-1" style="height: 10px;">
                                            <div class="progress-bar bg-info" style="width: 75%;">75%</div>
                                        </div>
                                        <small class="text-muted font-weight-bold">75% Utilized</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-maroon" onclick="openDisbursementModal('PROP-2026-5540', 'Nanomaterial-Based Solar Cell Efficiency', 170000)">
                                            Request Release
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== -->
    <!-- TAB 3: LINE-ITEM BUDGET (LIB) CALCULATOR & SIMULATOR                                 -->
    <!-- ==================================================================================== -->
    <div id="tabSimulator" class="tab-pane-content d-none">
        <div class="lib-alloc-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <div>
                    <h5 class="font-weight-bold text-maroon mb-1"><i class="fas fa-calculator me-2"></i>Line-Item Budget (LIB) Simulator</h5>
                    <p class="text-muted small mb-0">Interactively calculate Personal Services (PS), MOOE, and Capital Outlay (CO) breakdowns for grant applications.</p>
                </div>
                <span class="badge bg-gold text-dark font-weight-bold px-3 py-2">DBM / CHED Compliant Formula</span>
            </div>

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Target Grant Agency Preset</label>
                        <select class="form-select" id="simAgencySelect" onchange="updateLibSimulator()">
                            <option value="custom">Custom Breakdown</option>
                            <option value="irf" selected>IRF Seed Grant (40% PS, 40% MOOE, 20% CO)</option>
                            <option value="dost">DOST-GIA Standard (30% PS, 50% MOOE, 20% CO)</option>
                            <option value="ched">CHED DARP (35% PS, 45% MOOE, 20% CO)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-dark">Total Proposed Grant Budget (₱)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light font-weight-bold">₱</span>
                            <input type="number" class="form-control font-weight-bold fs-5 text-maroon" id="simTotalBudget" value="500000" step="10000" oninput="updateLibSimulator()">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark d-flex justify-content-between">
                            <span>Personal Services (PS %):</span>
                            <span class="text-maroon font-weight-bold" id="simPsPctLabel">40%</span>
                        </label>
                        <input type="range" class="form-range" id="simPsRange" min="10" max="60" value="40" oninput="onLibRangeChange('ps')">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark d-flex justify-content-between">
                            <span>MOOE (%):</span>
                            <span class="text-info font-weight-bold" id="simMooePctLabel">40%</span>
                        </label>
                        <input type="range" class="form-range" id="simMooeRange" min="10" max="70" value="40" oninput="onLibRangeChange('mooe')">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark d-flex justify-content-between">
                            <span>Capital Outlay (CO %):</span>
                            <span class="text-success font-weight-bold" id="simCoPctLabel">20%</span>
                        </label>
                        <input type="range" class="form-range" id="simCoRange" min="0" max="50" value="20" oninput="onLibRangeChange('co')">
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="p-4 bg-light rounded border h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-chart-pie text-maroon me-2"></i>Calculated Budget Allocation Summary</h6>

                            <div class="card mb-2 border-left-maroon shadow-sm">
                                <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="text-dark d-block">Personal Services (PS)</strong>
                                        <small class="text-muted">Research Assistants, Honoraria, Technical Field Helpers</small>
                                    </div>
                                    <span class="h5 font-weight-bold text-maroon m-0" id="simPsVal">₱ 200,000.00</span>
                                </div>
                            </div>

                            <div class="card mb-2 border-left-info shadow-sm">
                                <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="text-dark d-block">Maintenance & Other Operating Expenses (MOOE)</strong>
                                        <small class="text-muted">Reagents, Laboratory Supplies, Survey Travel, Field Logistics</small>
                                    </div>
                                    <span class="h5 font-weight-bold text-info m-0" id="simMooeVal">₱ 200,000.00</span>
                                </div>
                            </div>

                            <div class="card mb-3 border-left-success shadow-sm">
                                <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="text-dark d-block">Capital Outlay (CO)</strong>
                                        <small class="text-muted">Dedicated Lab Instruments, Specialized Hardware & Sensors</small>
                                    </div>
                                    <span class="h5 font-weight-bold text-success m-0" id="simCoVal">₱ 100,000.00</span>
                                </div>
                            </div>

                            <!-- Visual Stacked Bar -->
                            <div class="progress mb-2" style="height: 20px;">
                                <div class="progress-bar bg-maroon" id="barPs" style="width: 40%;">PS 40%</div>
                                <div class="progress-bar bg-info" id="barMooe" style="width: 40%;">MOOE 40%</div>
                                <div class="progress-bar bg-success" id="barCo" style="width: 20%;">CO 20%</div>
                            </div>
                        </div>

                        <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                            <span class="small text-muted"><i class="fas fa-info-circle me-1"></i> Export calculations directly into official proposal forms.</span>
                            <button class="btn btn-sm btn-maroon font-weight-bold" onclick="copyLibBreakdown()">
                                <i class="fas fa-copy me-1"></i> Copy LIB Summary
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== -->
    <!-- TAB 4: SHARED LABS & EQUIPMENT                                                       -->
    <!-- ==================================================================================== -->
    <div id="tabFacilities" class="tab-pane-content d-none">
        <div class="row">
            <!-- FACILITY 1 -->
            <div class="col-md-4 mb-4">
                <div class="card facility-card shadow-sm h-100">
                    <div class="facility-img-box">
                        <i class="fas fa-server fa-4x"></i>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-success text-white px-2 py-1">Available for Booking</span>
                                <small class="text-muted">CIT Bldg Rm 302</small>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">High-Performance Computing Cluster (AI Lab)</h5>
                            <p class="text-muted small">Dual NVIDIA A100 GPU workstation cluster dedicated for deep learning models, climate simulations, and big data analysis.</p>
                        </div>
                        <button class="btn btn-sm btn-maroon w-100 mt-3" onclick="openEquipmentBookingModal('High-Performance Computing Cluster (AI Lab)')">
                            <i class="fas fa-calendar-check me-1"></i> Reserve GPU Node
                        </button>
                    </div>
                </div>
            </div>

            <!-- FACILITY 2 -->
            <div class="col-md-4 mb-4">
                <div class="card facility-card shadow-sm h-100">
                    <div class="facility-img-box" style="background: linear-gradient(135deg, #1cc88a 0%, #137333 100%);">
                        <i class="fas fa-microscope fa-4x"></i>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-warning text-dark px-2 py-1">In Use (Slots Available)</span>
                                <small class="text-muted">CSM Science Complex</small>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">Atomic Force Microscopy Suite</h5>
                            <p class="text-muted small">Sub-nanometer resolution surface imaging and material property characterization suite for nanotechnology research.</p>
                        </div>
                        <button class="btn btn-sm btn-maroon w-100 mt-3" onclick="openEquipmentBookingModal('Atomic Force Microscopy Suite')">
                            <i class="fas fa-calendar-plus me-1"></i> Book Slot
                        </button>
                    </div>
                </div>
            </div>

            <!-- FACILITY 3 -->
            <div class="col-md-4 mb-4">
                <div class="card facility-card shadow-sm h-100">
                    <div class="facility-img-box" style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);">
                        <i class="fas fa-plane-departure fa-4x"></i>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-success text-white px-2 py-1">Available for Fieldwork</span>
                                <small class="text-muted">Agriculture Hangar</small>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">Aerial Drone Remote Sensing Fleet</h5>
                            <p class="text-muted small">Multispectral and LiDAR aerial drone survey fleet for crop monitoring, forestry mapping, and disaster assessments.</p>
                        </div>
                        <button class="btn btn-sm btn-maroon w-100 mt-3" onclick="openEquipmentBookingModal('Aerial Drone Remote Sensing Fleet')">
                            <i class="fas fa-calendar-check me-1"></i> Reserve Drone
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== -->
    <!-- TAB 5: TEMPLATES & DOWNLOADS                                                         -->
    <!-- ==================================================================================== -->
    <div id="tabTemplates" class="tab-pane-content d-none">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-left-maroon h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-excel fa-3x text-success me-3"></i>
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">Line-Item Budget (LIB) Standard Template</h6>
                                <small class="text-muted">Excel Spreadsheet (.xlsx) • Updated 2026 Edition</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-success" onclick="downloadTemplateFile('LIB_Template_2026.xlsx', 'Line-Item Budget Standard Template')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-left-maroon h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-3x text-danger me-3"></i>
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">Institutional Ethics Clearance Form Package</h6>
                                <small class="text-muted">PDF Document (.pdf) • Mandatory for Human/Field Studies</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-danger" onclick="downloadTemplateFile('Ethics_Application_Package.pdf', 'Institutional Ethics Clearance Form Package')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-left-maroon h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-word fa-3x text-primary me-3"></i>
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">Quarterly Research Progress Report Template</h6>
                                <small class="text-muted">Word Document (.docx) • For Awarded PIs</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" onclick="downloadTemplateFile('Quarterly_Report_Template.docx', 'Quarterly Research Progress Report Template')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-left-maroon h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-book fa-3x text-warning me-3"></i>
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">University Research Grants Policy Manual</h6>
                                <small class="text-muted">PDF Document (.pdf) • 2026 Edition</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-warning" onclick="downloadTemplateFile('Research_Policy_Manual_2026.pdf', 'University Research Grants Policy Manual')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: GRANT DETAILS & GUIDELINES                                                  -->
<!-- ==================================================================================== -->
<div class="modal fade" id="grantDetailsModal" tabindex="-1" aria-labelledby="grantDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="grantModalTitle">
                    <i class="fas fa-info-circle me-2"></i>Grant Call Details & Guidelines
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-warning text-dark fs-6" id="grantModalAgency">Agency</span>
                    <span class="text-danger font-weight-bold" id="grantModalDeadline">Deadline</span>
                </div>

                <h5 class="font-weight-bold text-dark mb-3" id="grantModalHeading">Grant Title</h5>
                <p class="text-muted small leading-relaxed mb-4" id="grantModalDescription">Grant description overview...</p>

                <div class="p-3 bg-light rounded border mb-4">
                    <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-coins text-maroon me-1"></i> Eligible Expense Items (LIB)</h6>
                    <div class="row small text-muted">
                        <div class="col-md-4"><strong>PS (Personal Services):</strong> Student assistants & honoraria.</div>
                        <div class="col-md-4"><strong>MOOE:</strong> Reagents, survey tools, travel expenses.</div>
                        <div class="col-md-4"><strong>CO (Capital Outlay):</strong> Dedicated lab sensors & hardware.</div>
                    </div>
                </div>

                <div class="alert alert-warning small">
                    <i class="fas fa-exclamation-triangle me-1"></i> Proposals must undergo institutional ethics clearance and department chair endorsement prior to final review.
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="btn btn-maroon btn-sm">
                    <i class="fas fa-paper-plane me-1"></i> Submit Proposal for this Grant
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: BOOK SHARED LAB FACILITY                                                   -->
<!-- ==================================================================================== -->
<div class="modal fade" id="equipmentBookingModal" tabindex="-1" aria-labelledby="equipmentBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="equipmentBookingModalLabel">
                    <i class="fas fa-microscope me-2"></i>Reserve Shared Lab Facility / Node
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="bookingForm" onsubmit="handleBookingSubmit(event)">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Target Facility / Hub <span class="text-danger">*</span></label>
                        <select class="form-select" id="bookingFacilitySelect" required>
                            <option value="High-Performance Computing Cluster (AI Lab)">High-Performance Computing Cluster (AI Lab)</option>
                            <option value="Atomic Force Microscopy Suite">Atomic Force Microscopy Suite</option>
                            <option value="Aerial Drone Remote Sensing Fleet">Aerial Drone Remote Sensing Fleet</option>
                            <option value="Genomics & Molecular Diagnostics Lab">Genomics & Molecular Diagnostics Lab</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Reservation Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="bookingDate" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Time Slot <span class="text-danger">*</span></label>
                            <select class="form-select" id="bookingTimeSlot">
                                <option value="Morning (08:00 - 12:00)">Morning (08:00 - 12:00)</option>
                                <option value="Afternoon (13:00 - 17:00)">Afternoon (13:00 - 17:00)</option>
                                <option value="Full Day (08:00 - 17:00)">Full Day (08:00 - 17:00)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Associated Project Code / Title</label>
                        <input type="text" class="form-control" id="bookingProject" placeholder="e.g. PRJ-2026-001 (Optional)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Research Purpose & Target Output</label>
                        <textarea class="form-control" id="bookingPurpose" rows="2" placeholder="Describe experimental procedures or compute workloads to run..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 3: REQUEST DISBURSEMENT RELEASE                                                -->
<!-- ==================================================================================== -->
<div class="modal fade" id="disbursementModal" tabindex="-1" aria-labelledby="disbursementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="disbursementModalLabel">
                    <i class="fas fa-paper-plane me-2"></i>Request Financial Tranche Release
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="disbursementForm" onsubmit="handleDisbursementSubmit(event)">
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="fas fa-info-circle me-1 text-maroon"></i> Financial releases require submitted progress reports and approved Line-Item Budget (LIB) liquidations.
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Project Code & Title</label>
                        <input type="text" class="form-control" id="disbursementProjectCode" readonly>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Release Tranche</label>
                            <select class="form-select" id="disbursementTranche">
                                <option value="Tranche 2 (50%)">Tranche 2 (50%)</option>
                                <option value="Final Release (Remaining)">Final Release (Remaining)</option>
                                <option value="Reimbursable Expense">Reimbursable Expense</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Requested Amount (₱)</label>
                            <input type="number" step="0.01" class="form-control" id="disbursementAmount" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Justification & Milestones Achieved</label>
                        <textarea class="form-control" id="disbursementJustification" rows="2" placeholder="Summarize milestone deliverables completed for this tranche request..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm shadow-sm">
                        <i class="fas fa-paper-plane me-1"></i> Submit Release Request
                    </button>
                </div>
            </form>
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
<!-- INTERACTIVE JAVASCRIPT (NO JQUERY DEPENDENCY)                                        -->
<!-- ==================================================================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        updateLibSimulator();
    });

    function switchFundingTab(tabKey, element) {
        document.querySelectorAll('.funding-tab-pill').forEach(pill => {
            pill.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }

        const tabMap = {
            'opportunities': 'tabOpportunities',
            'allocated': 'tabAllocated',
            'simulator': 'tabSimulator',
            'facilities': 'tabFacilities',
            'templates': 'tabTemplates'
        };

        Object.keys(tabMap).forEach(key => {
            const el = document.getElementById(tabMap[key]);
            if (el) {
                if (key === tabKey) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            }
        });
    }

    function filterGrants() {
        const query = (document.getElementById('grantSearchInput')?.value || '').toLowerCase().trim();
        const agency = document.getElementById('agencyFilter')?.value || 'all';

        const grantItems = document.querySelectorAll('#grantsGrid .grant-item');
        grantItems.forEach(item => {
            const itemSearch = item.getAttribute('data-search') || '';
            const itemAgency = item.getAttribute('data-agency') || '';

            const matchesQuery = !query || itemSearch.includes(query);
            const matchesAgency = (agency === 'all') || (itemAgency.toLowerCase().includes(agency.toLowerCase()));

            if (matchesQuery && matchesAgency) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function updateLibSimulator() {
        const agencyPreset = document.getElementById('simAgencySelect')?.value || 'irf';
        const psRange = document.getElementById('simPsRange');
        const mooeRange = document.getElementById('simMooeRange');
        const coRange = document.getElementById('simCoRange');

        if (agencyPreset === 'irf') {
            if (psRange) psRange.value = 40;
            if (mooeRange) mooeRange.value = 40;
            if (coRange) coRange.value = 20;
        } else if (agencyPreset === 'dost') {
            if (psRange) psRange.value = 30;
            if (mooeRange) mooeRange.value = 50;
            if (coRange) coRange.value = 20;
        } else if (agencyPreset === 'ched') {
            if (psRange) psRange.value = 35;
            if (mooeRange) mooeRange.value = 45;
            if (coRange) coRange.value = 20;
        }

        calculateLibValues();
    }

    function onLibRangeChange(changedType) {
        document.getElementById('simAgencySelect').value = 'custom';
        calculateLibValues();
    }

    function calculateLibValues() {
        const totalBudget = parseFloat(document.getElementById('simTotalBudget')?.value || 500000);
        let psPct = parseInt(document.getElementById('simPsRange')?.value || 40);
        let mooePct = parseInt(document.getElementById('simMooeRange')?.value || 40);
        let coPct = parseInt(document.getElementById('simCoRange')?.value || 20);

        // Normalize sum to 100%
        const sum = psPct + mooePct + coPct;
        if (sum > 0) {
            psPct = Math.round((psPct / sum) * 100);
            mooePct = Math.round((mooePct / sum) * 100);
            coPct = 100 - psPct - mooePct;
        }

        document.getElementById('simPsPctLabel').textContent = psPct + '%';
        document.getElementById('simMooePctLabel').textContent = mooePct + '%';
        document.getElementById('simCoPctLabel').textContent = coPct + '%';

        const psVal = totalBudget * (psPct / 100);
        const mooeVal = totalBudget * (mooePct / 100);
        const coVal = totalBudget * (coPct / 100);

        document.getElementById('simPsVal').textContent = '₱ ' + psVal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('simMooeVal').textContent = '₱ ' + mooeVal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('simCoVal').textContent = '₱ ' + coVal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        const barPs = document.getElementById('barPs');
        const barMooe = document.getElementById('barMooe');
        const barCo = document.getElementById('barCo');

        if (barPs) { barPs.style.width = psPct + '%'; barPs.textContent = `PS ${psPct}%`; }
        if (barMooe) { barMooe.style.width = mooePct + '%'; barMooe.textContent = `MOOE ${mooePct}%`; }
        if (barCo) { barCo.style.width = coPct + '%'; barCo.textContent = `CO ${coPct}%`; }
    }

    function copyLibBreakdown() {
        const total = document.getElementById('simTotalBudget').value;
        const ps = document.getElementById('simPsVal').textContent;
        const mooe = document.getElementById('simMooeVal').textContent;
        const co = document.getElementById('simCoVal').textContent;

        const summaryText = `MARSU IRIMKMS PROPOSED LINE-ITEM BUDGET (LIB):\nTotal Proposed Budget: ₱ ${parseFloat(total).toLocaleString()}\n- Personal Services (PS): ${ps}\n- Maintenance & Other Operating Expenses (MOOE): ${mooe}\n- Capital Outlay (CO): ${co}`;
        
        navigator.clipboard.writeText(summaryText).then(() => {
            showToast('LIB Summary Copied', 'Line-Item Budget breakdown copied to clipboard!');
        }).catch(() => {
            showToast('LIB Summary Calculated', 'Budget breakdown successfully calculated.');
        });
    }

    function openGrantModal(grantId) {
        const grantsData = {
            'irf_2026': {
                title: 'University Institutional Research Seed Grant 2026-2027',
                agency: 'Institutional IRF',
                deadline: 'Oct 30, 2026',
                description: 'Seed funding up to ₱ 500,000 for early-stage basic and applied research aligned with the University Priority Research Agenda (URA). Designed to support tenure-track faculty in establishing preliminary data for external grants.'
            },
            'dost_gia': {
                title: 'DOST Grants-in-Aid (GIA) Applied Innovation Program',
                agency: 'DOST-GIA',
                deadline: 'Nov 15, 2026',
                description: 'External government funding up to ₱ 2,500,000 targeted at technology commercialization, smart agriculture, environmental IoT systems, and local industry problem-solving.'
            },
            'ched_darp': {
                title: 'CHED Discovery & Applied Research Program',
                agency: 'CHED Grant',
                deadline: 'Dec 01, 2026',
                description: 'Supporting higher education research projects up to ₱ 1,200,000 in health sciences, education technology, biodiversity conservation, and social sustainability.'
            },
            'commercialization': {
                title: 'University Commercialization & Prototyping Accelerator',
                agency: 'Commercialization',
                deadline: 'Oct 15, 2026',
                description: 'Targeted funding up to ₱ 750,000 for research projects at Technology Readiness Level (TRL) 4+ seeking patent protection, prototype testing, and industry spin-off incubator support.'
            }
        };

        const data = grantsData[grantId] || grantsData['irf_2026'];
        document.getElementById('grantModalHeading').textContent = data.title;
        document.getElementById('grantModalAgency').textContent = data.agency;
        document.getElementById('grantModalDeadline').textContent = 'Deadline: ' + data.deadline;
        document.getElementById('grantModalDescription').textContent = data.description;

        const modalEl = document.getElementById('grantDetailsModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function openEquipmentBookingModal(facilityName) {
        if (facilityName) {
            const select = document.getElementById('bookingFacilitySelect');
            if (select) {
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].value.toLowerCase().includes(facilityName.toLowerCase())) {
                        select.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        const dateInput = document.getElementById('bookingDate');
        if (dateInput && !dateInput.value) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            dateInput.value = tomorrow.toISOString().split('T')[0];
        }

        const modalEl = document.getElementById('equipmentBookingModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function handleBookingSubmit(event) {
        event.preventDefault();
        const facility = document.getElementById('bookingFacilitySelect').value;
        const date = document.getElementById('bookingDate').value;

        const modalEl = document.getElementById('equipmentBookingModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        showToast('Reservation Submitted', `Booking request for ${facility} on ${date} has been placed!`);
    }

    function openDisbursementModal(code, title, remainingBalance) {
        document.getElementById('disbursementProjectCode').value = `${code} - ${title}`;
        document.getElementById('disbursementAmount').value = remainingBalance || 50000;

        const modalEl = document.getElementById('disbursementModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function handleDisbursementSubmit(event) {
        event.preventDefault();
        const amount = document.getElementById('disbursementAmount').value;

        const modalEl = document.getElementById('disbursementModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        showToast('Disbursement Requested', `Tranche release request of ₱ ${parseFloat(amount).toLocaleString()} submitted!`);
    }

    function downloadTemplateFile(filename, displayName) {
        showToast('Download Triggered', `Downloading ${displayName} (${filename})...`);

        const text = `MARSU RESEARCH OFFICE OFFICIAL DOCUMENT\nFile: ${filename}\nTitle: ${displayName}\nGenerated: ${new Date().toLocaleString()}\n`;
        const blob = new Blob([text], { type: 'text/plain;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportFinancialLedgerCSV() {
        const rows = [["Project Code", "Title & PI", "Approved Award (P)", "Disbursed Amount (P)", "Remaining Balance (P)", "Utilization (%)"]];

        document.querySelectorAll('#allocationsTable tbody tr').forEach(row => {
            const cols = row.querySelectorAll('td');
            if (cols.length >= 6) {
                const code = cols[0].innerText.trim();
                const titlePi = cols[1].innerText.replace(/\n/g, ' - ').trim();
                const award = cols[2].innerText.replace(/[^\d.]/g, '');
                const disbursed = cols[3].innerText.replace(/[^\d.]/g, '');
                const remaining = cols[4].innerText.replace(/[^\d.]/g, '');
                const utilization = cols[5].innerText.replace(/\n/g, ' ').trim();

                rows.push([`"${code}"`, `"${titlePi}"`, `"${award}"`, `"${disbursed}"`, `"${remaining}"`, `"${utilization}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Research_Financial_Ledger_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Ledger Exported', 'Active financial allocations downloaded to CSV.');
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