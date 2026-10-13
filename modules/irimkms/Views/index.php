<div class="container-fluid px-4 py-3" id="moduleDashboardRoot">

    <!-- Custom CSS Safeguards & Theme Tokens -->
    <style>
        #moduleDashboardRoot, #moduleDashboardRoot * {
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
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            box-shadow: 0 8px 24px rgba(128, 0, 32, 0.22);
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
            background: radial-gradient(circle, rgba(212, 175, 55, 0.22) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-badge-tag {
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
            font-size: 1.85rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
            letter-spacing: -0.01em;
            line-height: 1.25;
        }

        .page-hero-subtitle {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            max-width: 760px;
            line-height: 1.5;
        }

        /* Executive Stat Cards */
        .exec-stat-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e6f0;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
            height: 100%;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .exec-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(128, 0, 32, 0.12);
            border-color: rgba(128, 0, 32, 0.3);
        }
        .exec-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--maroon-main);
        }
        .exec-stat-card.gold-card::before { background: var(--gold-accent); }
        .exec-stat-card.warning-card::before { background: #f39c12; }
        .exec-stat-card.info-card::before { background: #0ea5e9; }

        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background: var(--maroon-light);
            color: var(--maroon-main);
            flex-shrink: 0;
        }
        .gold-card .stat-icon-box { background: var(--gold-light); color: #b89315; }
        .warning-card .stat-icon-box { background: #fff8ec; color: #d68910; }
        .info-card .stat-icon-box { background: #e0f2fe; color: #0284c7; }

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
            text-decoration: none;
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

        /* Quick Portal Nav Card */
        .portal-nav-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            background: #ffffff;
            padding: 18px;
            transition: all 0.22s ease;
            text-decoration: none !important;
            display: flex;
            align-items: center;
            height: 100%;
            position: relative;
        }
        .portal-nav-card:hover {
            transform: translateY(-4px);
            border-color: var(--maroon-main);
            box-shadow: 0 8px 20px rgba(128, 0, 32, 0.14);
        }
        .portal-nav-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--maroon-light);
            color: var(--maroon-main);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-right: 14px;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .portal-nav-card:hover .portal-nav-icon {
            background: var(--maroon-main);
            color: #ffffff;
        }

        .category-group-header {
            border-bottom: 2px solid var(--maroon-light);
            padding-bottom: 8px;
            margin-bottom: 16px;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e6f0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }
        .dashboard-card-header {
            padding: 18px 22px;
            background: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }
        .dashboard-card-header h6 {
            margin: 0;
            font-weight: 700;
            color: var(--maroon-main);
        }

        /* Search Filter Box */
        .module-search-box {
            position: relative;
            max-width: 380px;
        }
        .module-search-box input {
            padding-left: 40px;
            border-radius: 25px;
            border: 1px solid #cbd5e1;
            box-shadow: none !important;
        }
        .module-search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        /* Progress Bar Enhancements */
        .progress-thin {
            height: 8px;
            border-radius: 10px;
            background: #e2e8f0;
        }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 320px;
        }
    </style>

    <!-- Flash Notifications -->
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= e($_SESSION['flash_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= e($_SESSION['flash_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- HERO WELCOME BANNER -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <span class="hero-badge-tag"><i class="bi bi-bank me-1"></i> Marinduque State University IRIMKMS</span>
            <h1 class="page-hero-title mb-1">
                Welcome Back, <?= e($user['name'] ?? 'Faculty Researcher') ?>
            </h1>
            <p class="page-hero-subtitle">
                Oversee university research projects, track grant proposals, manage institutional repositories, evaluate deliverables, and view real-time research telemetry.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#quickSubmitProposalModal">
                <i class="bi bi-plus-circle-fill me-1"></i> Submit New Proposal
            </button>
            <a href="<?= url('irimkms/searchableresearch') ?>" class="btn btn-outline-light btn-sm px-3 py-2 font-weight-bold">
                <i class="bi bi-search me-1"></i> Discovery Engine
            </a>
            <button type="button" class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportDashboardSummaryCSV()">
                <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Executive Log
            </button>
        </div>
    </div>

    <!-- EXECUTIVE KPI STATS ROW -->
    <div class="row g-3 mb-4">
        <!-- Active Projects Card -->
        <div class="col-xl-3 col-md-6">
            <div class="exec-stat-card d-flex align-items-center justify-content-between" onclick="location.href='<?= url('irimkms/researchprojects') ?>'">
                <div>
                    <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Active Research Projects</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['active_projects'] ?? 142) ?></div>
                    <div class="small text-success font-weight-bold mt-1"><i class="bi bi-graph-up-arrow me-1"></i>+12% vs last quarter</div>
                </div>
                <div class="stat-icon-box">
                    <i class="bi bi-journal-code"></i>
                </div>
            </div>
        </div>

        <!-- Total Funding Card -->
        <div class="col-xl-3 col-md-6">
            <div class="exec-stat-card gold-card d-flex align-items-center justify-content-between" onclick="location.href='<?= url('irimkms/fundingandresources') ?>'">
                <div>
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Research Funding</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">₱ <?= number_format(($stats['total_funding'] ?? 48500000) / 1000000, 1) ?>M</div>
                    <div class="small text-muted font-weight-bold mt-1"><i class="bi bi-pie-chart-fill me-1"></i>84% Disbursed</div>
                </div>
                <div class="stat-icon-box">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
        </div>

        <!-- Pending Approvals Card -->
        <div class="col-xl-3 col-md-6">
            <div class="exec-stat-card warning-card d-flex align-items-center justify-content-between" onclick="location.href='<?= url('irimkms/proposalsandapprovals') ?>'">
                <div>
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Approvals</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['pending_proposals'] ?? 18) ?></div>
                    <div class="small text-warning font-weight-bold mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>Action Required</div>
                </div>
                <div class="stat-icon-box">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>

        <!-- Registered Faculty Card -->
        <div class="col-xl-3 col-md-6">
            <div class="exec-stat-card info-card d-flex align-items-center justify-content-between" onclick="location.href='<?= url('irimkms/researchprofiles') ?>'">
                <div>
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Faculty Researchers</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['total_faculty'] ?? 142) ?></div>
                    <div class="small text-info font-weight-bold mt-1"><i class="bi bi-person-check-fill me-1"></i>Active PIs & Fellows</div>
                </div>
                <div class="stat-icon-box">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVIGATION VIEW TABS & QUICK FILTER BAR -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="main-nav-pill active" id="tabNavHome" onclick="switchIndexTab('home')">
                <i class="bi bi-grid-3x3-gap-fill text-maroon"></i> Sub-Modules Directory
            </button>
            <button type="button" class="main-nav-pill" id="tabNavActivity" onclick="switchIndexTab('activity')">
                <i class="bi bi-journal-text text-warning"></i> Recent Proposals & Submissions
            </button>
            <button type="button" class="main-nav-pill" id="tabNavMilestones" onclick="switchIndexTab('milestones')">
                <i class="bi bi-flag-fill text-info"></i> Milestones & Live Telemetry
            </button>
            <button type="button" class="main-nav-pill" id="tabNavAnalytics" onclick="switchIndexTab('analytics')">
                <i class="bi bi-graph-up-arrow text-success"></i> College Performance Matrix
            </button>
        </div>

        <!-- Quick Sub-Module Filter Input -->
        <div class="module-search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="subModuleSearchInput" class="form-control form-control-sm" placeholder="Filter 13 sub-modules..." onkeyup="filterSubModules()">
        </div>
    </div>


    <!-- ==================================================================================== -->
    <!-- TAB 1: QUICK MODULE ACCESS PORTAL GRID (CATEGORIZED & FILTERABLE)                    -->
    <!-- ==================================================================================== -->
    <div id="indexSectionHome" class="index-tab-view">
        
        <!-- SECTION 1: RESEARCH MANAGEMENT -->
        <div class="category-group-wrapper mb-4" data-category="research-management">
            <div class="category-group-header d-flex align-items-center justify-content-between">
                <h6 class="font-weight-bold text-maroon m-0">
                    <i class="bi bi-journal-text me-2"></i>1. Research Management Sub-Modules
                </h6>
                <span class="badge bg-maroon text-white font-weight-bold">4 Modules</span>
            </div>
            <div class="row g-3">
                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="proposals approvals submissions review grant">
                    <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-file-earmark-check"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Proposals & Approvals</strong>
                            <small class="text-muted">Track & review submissions</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="research profiles faculty directory h-index principal investigator">
                    <a href="<?= url('irimkms/researchprofiles') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-person-badge"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Research Profiles</strong>
                            <small class="text-muted">Faculty directory & h-index</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="research projects portfolio active central database">
                    <a href="<?= url('irimkms/researchprojects') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-journal-code"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Research Projects</strong>
                            <small class="text-muted">Central project database</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="funding resources grants lab booking budget allocation">
                    <a href="<?= url('irimkms/fundingandresources') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-cash-coin"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Funding & Resources</strong>
                            <small class="text-muted">Open grants & lab booking</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- SECTION 2: MONITORING & EVALUATION -->
        <div class="category-group-wrapper mb-4" data-category="monitoring-evaluation">
            <div class="category-group-header d-flex align-items-center justify-content-between">
                <h6 class="font-weight-bold text-dark m-0">
                    <i class="bi bi-speedometer2 text-warning me-2"></i>2. Monitoring & Evaluation (M&E) Sub-Modules
                </h6>
                <span class="badge bg-warning text-dark font-weight-bold">5 Modules</span>
            </div>
            <div class="row g-3">
                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="project milestones quarterly deliverable target schedule">
                    <a href="<?= url('irimkms/projectmilestone') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-flag"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Project Milestones</strong>
                            <small class="text-muted">Quarterly M&E deliverables</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="implementation progress field operations physical financial tracker">
                    <a href="<?= url('irimkms/implementationprogress') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-hourglass-split"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Implementation Progress</strong>
                            <small class="text-muted">Field operations & tracker</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="evaluation forms assessment tools peer review scorecard ethics">
                    <a href="<?= url('irimkms/evaluationforms') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-clipboard-data"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Evaluation Forms</strong>
                            <small class="text-muted">Peer review & scorecards</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="performance indicators analytics kpis citations breakdown chart">
                    <a href="<?= url('irimkms/performanceindicators') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Performance Analytics</strong>
                            <small class="text-muted">KPIs & citations breakdown</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="completion reporting accomplishment clearance certificates terminal report">
                    <a href="<?= url('irimkms/completionreporting') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-award"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Completion Reporting</strong>
                            <small class="text-muted">Clearance & certificates</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- SECTION 3: REPOSITORY & KNOWLEDGE MANAGEMENT -->
        <div class="category-group-wrapper mb-4" data-category="repository-knowledge">
            <div class="category-group-header d-flex align-items-center justify-content-between">
                <h6 class="font-weight-bold text-dark m-0">
                    <i class="bi bi-archive text-info me-2"></i>3. Repository & Knowledge Management Sub-Modules
                </h6>
                <span class="badge bg-info text-white font-weight-bold">4 Modules</span>
            </div>
            <div class="row g-3">
                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="digital research storage institutional dataset archive cloud">
                    <a href="<?= url('irimkms/researchstorage') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-hdd-network"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Research Storage</strong>
                            <small class="text-muted">Institutional data archive</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="document file management contracts moas agreements hub">
                    <a href="<?= url('irimkms/filemanagement') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-folder-symlink"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">File Management</strong>
                            <small class="text-muted">Contracts & MOAs hub</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="knowledge library publications journals datasets books">
                    <a href="<?= url('irimkms/knowledgemanagement') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-book-half"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Knowledge Library</strong>
                            <small class="text-muted">Publications & datasets</small>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-4 col-sm-6 sub-module-item" data-keywords="searchable research discovery engine search patents fulltext index">
                    <a href="<?= url('irimkms/searchableresearch') ?>" class="portal-nav-card shadow-sm">
                        <div class="portal-nav-icon"><i class="bi bi-search"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-0">Discovery Engine</strong>
                            <small class="text-muted">Search research & patents</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /#indexSectionHome -->


    <!-- ==================================================================================== -->
    <!-- TAB 2: RECENT PROPOSALS & LIVE SUBMISSIONS TABLE                                    -->
    <!-- ==================================================================================== -->
    <div id="indexSectionActivity" class="index-tab-view d-none">
        <div class="dashboard-card mb-4">
            <div class="dashboard-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h6 class="m-0"><i class="bi bi-clipboard-list me-2"></i>Recent Research Proposals & Active Submissions</h6>
                <div class="d-flex gap-2">
                    <select id="proposalFilterStatus" class="form-select form-select-sm" style="width: auto;" onchange="filterProposalTable()">
                        <option value="ALL">All Statuses</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Approved">Approved</option>
                        <option value="Revision Needed">Revision Needed</option>
                    </select>
                    <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-outline-maroon font-weight-bold">
                        View Full Portal <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;" id="dashboardProposalsTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Proposal Code</th>
                                <th>Research Title & Agenda</th>
                                <th>Principal Investigator</th>
                                <th>College</th>
                                <th>Funding Budget</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proposals)): ?>
                                <?php foreach (array_slice($proposals, 0, 8) as $pr): ?>
                                    <tr data-status="<?= e($pr['status'] ?? 'Under Review') ?>">
                                        <td><span class="badge bg-maroon text-white"><?= e($pr['code']) ?></span></td>
                                        <td>
                                            <strong class="text-dark d-block mb-0"><?= e($pr['title']) ?></strong>
                                            <small class="text-muted"><?= e($pr['agenda_thrust'] ?? 'General') ?> • <?= e($pr['research_type'] ?? 'Basic Research') ?></small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark d-block"><?= e($pr['pi_name']) ?></span>
                                            <small class="text-muted"><?= e($pr['pi_rank'] ?? 'Faculty PI') ?></small>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?= e($pr['college'] ?? 'CIT') ?></span></td>
                                        <td><strong class="text-maroon">₱ <?= number_format($pr['budget_total'] ?? 350000, 2) ?></strong></td>
                                        <td>
                                            <?php
                                                $st = $pr['status'] ?? 'Under Review';
                                                $badgeBg = match($st) {
                                                    'Approved' => 'bg-success text-white',
                                                    'Under Review' => 'bg-warning text-dark',
                                                    'Revision Needed' => 'bg-danger text-white',
                                                    default => 'bg-secondary text-white'
                                                };
                                            ?>
                                            <span class="badge <?= $badgeBg ?> px-2 py-1"><?= e($st) ?></span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-maroon px-2 py-1" onclick="quickViewProposal('<?= e($pr['code']) ?>', '<?= e(addslashes($pr['title'])) ?>', '<?= e(addslashes($pr['pi_name'])) ?>', '<?= e($pr['college'] ?? 'CIT') ?>', '₱ <?= number_format($pr['budget_total'] ?? 0, 2) ?>', '<?= e($pr['status']) ?>')">
                                                <i class="bi bi-eye"></i> Quick View
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><span class="badge bg-maroon text-white">PROP-2026-001</span></td>
                                    <td>
                                        <strong class="text-dark d-block mb-0">AI-Driven Water Quality Monitoring System</strong>
                                        <small class="text-muted">IT & AI Innovation • Basic Research</small>
                                    </td>
                                    <td>Mhica Bianca Rodelas</td>
                                    <td><span class="badge bg-light text-dark border">CIT</span></td>
                                    <td><strong class="text-maroon">₱ 350,000.00</strong></td>
                                    <td><span class="badge bg-warning text-dark px-2 py-1">Under Review</span></td>
                                    <td class="text-center">
                                        <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-outline-maroon"><i class="bi bi-eye"></i> Quick View</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#indexSectionActivity -->


    <!-- ==================================================================================== -->
    <!-- TAB 3: UPCOMING MILESTONES & LIVE SYSTEM TELEMETRY                                   -->
    <!-- ==================================================================================== -->
    <div id="indexSectionMilestones" class="index-tab-view d-none">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                        <h6><i class="bi bi-calendar-event me-2"></i>Upcoming Milestones & Audit Deliverables</h6>
                        <span class="badge bg-warning text-dark px-2 py-1 font-weight-bold">3 Deliverables Due</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">Q3 Financial Audit & Disbursal Reports</span>
                                <span class="badge bg-danger text-white">Oct 15</span>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar bg-danger" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">DOST-GIA Mid-Term Physical Evaluation</span>
                                <span class="badge bg-warning text-dark">Oct 22</span>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar bg-warning" style="width: 60%;"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">Annual Research Presentation Forum</span>
                                <span class="badge bg-info text-white">Oct 30</span>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar bg-info" style="width: 35%;"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">Terminal Accomplishment Clearance Submissions</span>
                                <span class="badge bg-success text-white">Nov 12</span>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar bg-success" style="width: 20%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                        <h6><i class="bi bi-activity me-2"></i>Live System Activity & Audit Trail</h6>
                        <span class="text-muted small">Real-time Telemetry</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3 border-bottom pb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                            <div class="small">
                                <strong class="text-dark d-block mb-0">Proposal Status Updated to Approved</strong>
                                <span class="text-muted">Smart Agriculture Crop Pest Detection (PROP-2026-002) approved & assigned code PRJ-2025-084.</span>
                                <div class="text-xs text-muted mt-1"><i class="bi bi-clock me-1"></i>10 mins ago</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3 border-bottom pb-3">
                            <i class="bi bi-file-earmark-arrow-up-fill text-maroon fs-5 me-3 mt-1"></i>
                            <div class="small">
                                <strong class="text-dark d-block mb-0">Physical Deliverable Uploaded</strong>
                                <span class="text-muted">Prof. Mhica Bianca Rodelas uploaded Q1 Hardware Selection Matrix.</span>
                                <div class="text-xs text-muted mt-1"><i class="bi bi-clock me-1"></i>42 mins ago</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="bi bi-person-plus-fill text-info fs-5 me-3 mt-1"></i>
                            <div class="small">
                                <strong class="text-dark d-block mb-0">New Faculty PI Profile Created</strong>
                                <span class="text-muted">Dr. Vicente Tan registered under College of Health Sciences directory.</span>
                                <div class="text-xs text-muted mt-1"><i class="bi bi-clock me-1"></i>2 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#indexSectionMilestones -->


    <!-- ==================================================================================== -->
    <!-- TAB 4: COLLEGE PERFORMANCE & FUNDING DISTRIBUTION MATRIX                             -->
    <!-- ==================================================================================== -->
    <div id="indexSectionAnalytics" class="index-tab-view d-none">
        <div class="row g-3">
            <div class="col-lg-7">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header d-flex align-items-center justify-content-between">
                        <h6><i class="bi bi-bar-chart-line me-2"></i>Institutional Research Productivity by College</h6>
                        <span class="badge bg-maroon text-white">Academic Year 2026</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">College of Information Technology (CIT)</span>
                                <span class="fw-bold text-maroon">42 Active Projects (₱18.5M)</span>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-maroon" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">College of Agriculture (COA)</span>
                                <span class="fw-bold text-warning">34 Active Projects (₱12.2M)</span>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-warning" style="width: 70%;"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">College of Engineering (COE)</span>
                                <span class="fw-bold text-info">28 Active Projects (₱10.8M)</span>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-info" style="width: 58%;"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="font-weight-bold text-dark">College of Sciences & Mathematics (CSM)</span>
                                <span class="fw-bold text-success">22 Active Projects (₱7.0M)</span>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-success" style="width: 45%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header">
                        <h6><i class="bi bi-pie-chart-fill me-2"></i>Funding Sources Breakdown</h6>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <i class="bi bi-circle-fill text-maroon me-2"></i>Institutional IRF Fund
                                </div>
                                <strong>₱ 24,500,000.00 (50.5%)</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <i class="bi bi-circle-fill text-warning me-2"></i>DOST-GIA Grants
                                </div>
                                <strong>₱ 14,200,000.00 (29.3%)</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <i class="bi bi-circle-fill text-info me-2"></i>CHED DARE TO / Grants
                                </div>
                                <strong>₱ 6,800,000.00 (14.0%)</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <i class="bi bi-circle-fill text-success me-2"></i>External / Industry Spons.
                                </div>
                                <strong>₱ 3,000,000.00 (6.2%)</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#indexSectionAnalytics -->

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL: QUICK PROPOSAL SUBMISSION                                                     -->
<!-- ==================================================================================== -->
<div class="modal fade" id="quickSubmitProposalModal" tabindex="-1" aria-labelledby="quickSubmitProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="quickSubmitProposalModalLabel">
                    <i class="bi bi-file-earmark-plus me-2"></i>Submit Research Proposal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('irimkms/proposalsandapprovals/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="bi bi-info-circle me-1 text-maroon"></i> Submit a research proposal for peer evaluation and institutional grant allocation.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold text-dark">Research Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. AI-Driven Water Quality Monitoring System" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Principal Investigator (PI) <span class="text-danger">*</span></label>
                            <input type="text" name="pi_name" class="form-control" value="<?= e($user['name'] ?? 'Faculty PI') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">College / Unit <span class="text-danger">*</span></label>
                            <select name="college" class="form-select" required>
                                <option value="CIT">College of Information Technology (CIT)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CSM">College of Sciences & Mathematics (CSM)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CHS">College of Health Sciences (CHS)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Agenda Thrust</label>
                            <select name="agenda_thrust" class="form-select">
                                <option value="IT & AI">IT & AI Innovation</option>
                                <option value="Agriculture">Agriculture & Food Safety</option>
                                <option value="Environment">Environment & Climate Change</option>
                                <option value="Renewable Energy">Renewable Energy</option>
                                <option value="Health">Public Health & Medical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Funding Source</label>
                            <input type="text" name="funding_source" class="form-control" value="University Institutional Research Fund (IRF)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Requested Budget (₱)</label>
                            <input type="number" step="0.01" name="budget_total" class="form-control" placeholder="350000.00" value="350000.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Executive Abstract</label>
                        <textarea name="abstract" class="form-control" rows="3" placeholder="Brief summary of research methodology, deliverables, and societal impact..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm px-4 font-weight-bold">
                        <i class="bi bi-send-fill me-1"></i> Submit Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL: QUICK PROPOSAL VIEW DETAIL                                                    -->
<!-- ==================================================================================== -->
<div class="modal fade" id="quickViewProposalModal" tabindex="-1" aria-labelledby="quickViewProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="quickViewProposalModalLabel">
                    <i class="bi bi-file-earmark-text me-2"></i>Proposal Quick Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-maroon fs-6" id="qvModalCode">PROP-2026-001</span>
                    <span class="badge bg-warning text-dark px-3 py-1" id="qvModalStatus">Under Review</span>
                </div>
                <h6 class="font-weight-bold text-dark mb-2" id="qvModalTitle">Research Proposal Title</h6>
                <div class="p-3 bg-light rounded border mb-3">
                    <div class="row g-2 small">
                        <div class="col-6"><span class="text-muted d-block">Lead PI:</span> <strong id="qvModalPI">Dr. Faculty</strong></div>
                        <div class="col-6"><span class="text-muted d-block">College:</span> <strong id="qvModalCollege">CIT</strong></div>
                        <div class="col-12 mt-2"><span class="text-muted d-block">Budget Allocation:</span> <strong class="text-maroon fs-6" id="qvModalBudget">₱ 350,000.00</strong></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Close</button>
                <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="btn btn-maroon btn-sm px-3 font-weight-bold">
                    Open Proposals Portal <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- TOAST NOTIFICATION BANNER -->
<div class="toast-notification d-none" id="actionToast">
    <div class="card shadow-lg border-left-maroon bg-white">
        <div class="card-body p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-3 text-success me-3"></i>
                <div>
                    <strong class="text-dark d-block" id="toastTitle">Success</strong>
                    <small class="text-muted" id="toastMessage">Action performed successfully.</small>
                </div>
            </div>
            <button type="button" class="btn-close ms-3" onclick="hideToast()"></button>
        </div>
    </div>
</div>


<script>
    // Tab Switcher Logic
    function switchIndexTab(tabKey) {
        document.querySelectorAll('.index-tab-view').forEach(view => {
            view.classList.add('d-none');
        });
        document.querySelectorAll('.main-nav-pill').forEach(pill => {
            pill.classList.remove('active');
        });

        if (tabKey === 'home') {
            document.getElementById('indexSectionHome')?.classList.remove('d-none');
            document.getElementById('tabNavHome')?.classList.add('active');
        } else if (tabKey === 'activity') {
            document.getElementById('indexSectionActivity')?.classList.remove('d-none');
            document.getElementById('tabNavActivity')?.classList.add('active');
        } else if (tabKey === 'milestones') {
            document.getElementById('indexSectionMilestones')?.classList.remove('d-none');
            document.getElementById('tabNavMilestones')?.classList.add('active');
        } else if (tabKey === 'analytics') {
            document.getElementById('indexSectionAnalytics')?.classList.remove('d-none');
            document.getElementById('tabNavAnalytics')?.classList.add('active');
        }
    }

    // Filter Sub-Modules Function
    function filterSubModules() {
        const query = (document.getElementById('subModuleSearchInput')?.value || '').toLowerCase().trim();
        const items = document.querySelectorAll('.sub-module-item');
        const groups = document.querySelectorAll('.category-group-wrapper');

        items.forEach(item => {
            const text = (item.innerText + ' ' + (item.getAttribute('data-keywords') || '')).toLowerCase();
            if (text.includes(query)) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });

        // Hide category wrapper if all items inside are hidden
        groups.forEach(group => {
            const visibleItems = group.querySelectorAll('.sub-module-item:not(.d-none)');
            if (visibleItems.length === 0) {
                group.classList.add('d-none');
            } else {
                group.classList.remove('d-none');
            }
        });
    }

    // Filter Proposal Table in Tab 2
    function filterProposalTable() {
        const selectedStatus = document.getElementById('proposalFilterStatus')?.value || 'ALL';
        const rows = document.querySelectorAll('#dashboardProposalsTable tbody tr');

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status') || '';
            if (selectedStatus === 'ALL' || rowStatus === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Quick View Proposal Modal Trigger
    function quickViewProposal(code, title, pi, college, budget, status) {
        document.getElementById('qvModalCode').textContent = code;
        document.getElementById('qvModalTitle').textContent = title;
        document.getElementById('qvModalPI').textContent = pi;
        document.getElementById('qvModalCollege').textContent = college;
        document.getElementById('qvModalBudget').textContent = budget;
        document.getElementById('qvModalStatus').textContent = status;

        const modalEl = document.getElementById('quickViewProposalModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    // Export Executive Summary CSV
    function exportDashboardSummaryCSV() {
        const rows = [
            ["Executive Metric", "Value"],
            ["Active Research Projects", "<?= $stats['active_projects'] ?? 142 ?>"],
            ["Total Research Funding", "P <?= number_format($stats['total_funding'] ?? 48500000, 2) ?>"],
            ["Pending Proposal Approvals", "<?= $stats['pending_proposals'] ?? 18 ?>"],
            ["Registered Faculty Researchers", "<?= $stats['total_faculty'] ?? 142 ?>"]
        ];

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Executive_Research_Summary_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Report Exported', 'Executive research summary downloaded to CSV.');
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
