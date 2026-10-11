<div class="container-fluid py-3" id="researchProjectsRoot">

    <!-- Custom CSS Safeguards & Styling -->
    <style>
        #researchProjectsRoot, #researchProjectsRoot * {
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

        .btn-outline-maroon {
            border-color: var(--maroon-main);
            color: var(--maroon-main);
            font-weight: 600;
        }
        .btn-outline-maroon:hover {
            background-color: var(--maroon-main);
            color: #fff;
        }

        .badge-gold {
            background-color: var(--gold-accent);
            color: #212529;
            font-weight: 700;
        }

        /* View Toggle Pill Buttons */
        .view-toggle-btn {
            border: 1px solid #d1d3e2;
            background: #f8f9fc;
            color: #5a5c69;
            font-weight: 600;
            padding: 6px 14px;
            transition: all 0.2s;
        }
        .view-toggle-btn.active {
            background: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 2px 6px rgba(128, 0, 32, 0.25);
        }

        /* Project Card Styling (Grid View) */
        .project-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.75rem 1.5rem rgba(128, 0, 32, 0.12) !important;
            border-color: rgba(128, 0, 32, 0.3);
        }

        .project-card-header {
            padding: 16px;
            border-bottom: 1px solid #f1f3f9;
            background: #fafbfc;
            border-radius: 12px 12px 0 0;
        }

        .project-thrust-badge {
            background: var(--maroon-light);
            color: var(--maroon-main);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-block;
        }

        .project-budget-chip {
            background: #f8f9fc;
            border: 1px solid #eaecf4;
            border-radius: 8px;
            padding: 8px 12px;
        }

        /* Status Tab Pills */
        .db-tab-pill {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #d1d3e2;
            background: #f8f9fc;
            color: #5a5c69;
            transition: all 0.2s;
            margin-right: 4px;
            margin-bottom: 4px;
        }
        .db-tab-pill:hover {
            background: #eaecf4;
            color: var(--maroon-main);
        }
        .db-tab-pill.active {
            background: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 2px 6px rgba(128, 0, 32, 0.25);
        }

        /* Dossier Cover */
        .dossier-header-cover {
            background: linear-gradient(135deg, #800020 0%, #3d000f 100%);
            color: #ffffff;
            padding: 24px;
            border-radius: 12px 12px 0 0;
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
    </style>

    <!-- Uniform MarSU Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="fas fa-microscope me-1"></i> Active Research Projects</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-flask me-2 text-warning"></i>University Research Projects Registry
            </h1>
            <p class="page-hero-subtitle">
                Centralized tracking of institutional, national (DOST/CHED), and externally-funded research initiatives, project leads, budgets, and milestones.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" onclick="openAddProjectModal()">
                <i class="fas fa-plus-circle me-1"></i> Register Project
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="exportCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Report
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill active"><i class="bi bi-journal-code text-white me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill"><i class="bi bi-search text-maroon me-1"></i> Discovery Engine</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- View Mode Controls & Summary Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="font-weight-bold text-maroon m-0"><i class="fas fa-list-alt me-1"></i> Active Projects Portfolio</h6>
        <div class="btn-group role-group" role="group">
            <button type="button" class="btn btn-sm view-toggle-btn active" id="btnGridView" onclick="switchViewMode('grid')">
                <i class="fas fa-th-large me-1"></i> Cards Grid
            </button>
            <button type="button" class="btn btn-sm view-toggle-btn" id="btnTableView" onclick="switchViewMode('table')">
                <i class="fas fa-list me-1"></i> Data Table
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= e($_SESSION['flash_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= e($_SESSION['flash_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- Top Metric Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Total Registered Projects</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['total'] ?? count($projects ?? [])) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ongoing Active Projects</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['ongoing'] ?? 0) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-primary"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed & Finalized</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['completed'] ?? 0) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-double fa-2x text-success"></i>
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
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Cumulative Grants Value</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">₱ <?= number_format((float)($stats['cumulative_grants'] ?? 0), 2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Multi-Parametric Filter Toolbar -->
    <div class="card shadow mb-4">
        <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <!-- Status Filter Tabs -->
                    <div class="d-flex flex-wrap align-items-center">
                        <span class="small font-weight-bold text-muted me-2 mb-1">Status:</span>
                        <span class="db-tab-pill active" onclick="filterStatus('all', this)">All (<?= count($projects ?? []) ?>)</span>
                        <span class="db-tab-pill" onclick="filterStatus('ongoing', this)"><i class="fas fa-sync me-1 text-primary"></i> Ongoing (<?= (int)($stats['ongoing'] ?? 0) ?>)</span>
                        <span class="db-tab-pill" onclick="filterStatus('completed', this)"><i class="fas fa-check me-1 text-success"></i> Completed (<?= (int)($stats['completed'] ?? 0) ?>)</span>
                        <span class="db-tab-pill" onclick="filterStatus('suspended', this)"><i class="fas fa-pause me-1 text-danger"></i> Suspended</span>
                        <span class="db-tab-pill" onclick="filterStatus('planned', this)"><i class="fas fa-clock me-1 text-warning"></i> Planned</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <select class="form-select form-select-sm" id="thrustFilter" onchange="filterDatabase()">
                                <option value="all" selected>All Research Thrusts</option>
                                <option value="IT & AI">IT & AI Innovation</option>
                                <option value="Agriculture">Agriculture & Food</option>
                                <option value="Environment">Environment & Climate</option>
                                <option value="Energy">Renewable Energy</option>
                                <option value="Health">Health Sciences</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select form-select-sm" id="collegeFilter" onchange="filterDatabase()">
                                <option value="all" selected>All Colleges</option>
                                <option value="CIT">College of Info Tech (CIT)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CSM">College of Science (CSM)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CHS">College of Health (CHS)</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search projects..." id="mainSearchInput" oninput="filterDatabase()">
                                <button type="button" class="btn bg-maroon text-white"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== -->
    <!-- VIEW 1: GRID VIEW (VISUAL CARDS)                                                     -->
    <!-- ==================================================================================== -->
    <div class="row" id="projectsGridView">
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $proj): ?>
                <?php
                    $pct = (int)($proj['progress_percent'] ?? 0);
                    $barBg = $pct >= 100 ? 'bg-success' : ($pct >= 50 ? 'bg-primary' : 'bg-warning');
                    $pst = $proj['status'] ?? 'Ongoing';
                    $badgeSt = match($pst) {
                        'Completed' => 'bg-success text-white',
                        'Ongoing' => 'bg-primary text-white',
                        'Suspended' => 'bg-danger text-white',
                        'Planned' => 'bg-warning text-dark',
                        default => 'bg-secondary text-white'
                    };
                    $jsonAttr = htmlspecialchars(json_encode($proj), ENT_QUOTES, 'UTF-8');
                    $searchData = strtolower(e($proj['project_code'] . ' ' . $proj['title'] . ' ' . $proj['lead_pi'] . ' ' . $proj['college'] . ' ' . $proj['research_thrust'] . ' ' . $proj['funding_source'] . ' ' . $proj['description']));
                ?>
                <div class="col-xl-4 col-md-6 mb-4 project-item-wrapper"
                     data-status="<?= e(strtolower($pst)) ?>"
                     data-college="<?= e($proj['college'] ?? '') ?>"
                     data-thrust="<?= e($proj['research_thrust'] ?? '') ?>"
                     data-search="<?= $searchData ?>">
                    <div class="project-card shadow-sm">
                        <div class="project-card-header d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-maroon text-white me-1"><?= e($proj['project_code']) ?></span>
                                <span class="badge bg-light text-dark border"><?= e($proj['college'] ?? 'N/A') ?></span>
                            </div>
                            <span class="badge <?= $badgeSt ?> px-2 py-1"><?= e($pst) ?></span>
                        </div>

                        <div class="card-body p-3">
                            <div class="mb-2">
                                <span class="project-thrust-badge">
                                    <i class="fas fa-lightbulb me-1"></i><?= e($proj['research_thrust'] ?? 'General Thrust') ?>
                                </span>
                            </div>

                            <h5 class="font-weight-bold text-dark mb-2" style="font-size: 1.05rem; line-height: 1.3; min-height: 2.6rem;">
                                <?= e($proj['title']) ?>
                            </h5>

                            <p class="text-muted small mb-3">
                                <i class="fas fa-user-circle text-maroon me-1"></i> Lead PI: 
                                <strong class="text-dark"><?= e($proj['lead_pi']) ?></strong>
                            </p>

                            <!-- Milestone progress -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center small mb-1">
                                    <span class="font-weight-bold text-muted">Execution Progress:</span>
                                    <span class="font-weight-bold text-dark"><?= $pct ?>%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar <?= $barBg ?>" role="progressbar" style="width: <?= $pct ?>%;"></div>
                                </div>
                            </div>

                            <!-- Budget Chip -->
                            <div class="project-budget-chip d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.72rem; text-transform: uppercase; font-weight:700;">Approved Grant</small>
                                    <strong class="text-maroon fs-6">₱ <?= number_format((float)($proj['total_budget'] ?? 0), 2) ?></strong>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-white text-dark border small"><?= e($proj['funding_source'] ?? 'IRF') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light p-3 text-end border-top-0">
                            <button class="btn btn-sm btn-maroon w-100" onclick="openProjectDossier(<?= $jsonAttr ?>)">
                                <i class="fas fa-folder-open me-1"></i> View Project Dossier
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="card shadow-sm border-0 py-5">
                    <div class="card-body">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h4 class="text-gray-800 font-weight-bold">No Research Projects Registered</h4>
                        <p class="text-muted mb-3">There are no institutional projects filed in the database yet.</p>
                        <button class="btn btn-maroon btn-sm" onclick="openAddProjectModal()">
                            <i class="fas fa-plus-circle me-1"></i> Register Approved Project
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- ==================================================================================== -->
    <!-- VIEW 2: DATA TABLE VIEW (TABULAR)                                                    -->
    <!-- ==================================================================================== -->
    <div class="card shadow mb-4 d-none" id="projectsTableView">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="projectTable">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>Project Code</th>
                            <th>Research Title & Lead PI</th>
                            <th>College</th>
                            <th>Research Thrust</th>
                            <th>Budget & Source</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($projects)): ?>
                            <?php foreach ($projects as $proj): ?>
                                <?php
                                    $pct = (int)($proj['progress_percent'] ?? 0);
                                    $barBg = $pct >= 100 ? 'bg-success' : ($pct >= 50 ? 'bg-primary' : 'bg-warning');
                                    $pst = $proj['status'] ?? 'Ongoing';
                                    $badgeSt = match($pst) {
                                        'Completed' => 'bg-success text-white',
                                        'Ongoing' => 'bg-primary text-white',
                                        'Suspended' => 'bg-danger text-white',
                                        'Planned' => 'bg-warning text-dark',
                                        default => 'bg-secondary text-white'
                                    };
                                    $jsonAttr = htmlspecialchars(json_encode($proj), ENT_QUOTES, 'UTF-8');
                                    $searchData = strtolower(e($proj['project_code'] . ' ' . $proj['title'] . ' ' . $proj['lead_pi'] . ' ' . $proj['college'] . ' ' . $proj['research_thrust'] . ' ' . $proj['funding_source'] . ' ' . $proj['description']));
                                ?>
                                <tr class="project-table-row" 
                                    data-status="<?= e(strtolower($pst)) ?>" 
                                    data-college="<?= e($proj['college'] ?? '') ?>"
                                    data-thrust="<?= e($proj['research_thrust'] ?? '') ?>"
                                    data-search="<?= $searchData ?>">
                                    <td>
                                        <span class="badge bg-maroon text-white px-2 py-1"><?= e($proj['project_code']) ?></span>
                                    </td>
                                    <td>
                                        <strong class="text-dark d-block"><?= e($proj['title']) ?></strong>
                                        <small class="text-muted"><i class="fas fa-user-circle text-maroon me-1"></i> <?= e($proj['lead_pi']) ?> (Lead PI)</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?= e($proj['college'] ?? 'N/A') ?></span></td>
                                    <td>
                                        <small class="d-block text-dark font-weight-bold"><?= e($proj['research_thrust'] ?? 'General') ?></small>
                                    </td>
                                    <td>
                                        <strong class="text-maroon">₱ <?= number_format((float)($proj['total_budget'] ?? 0), 2) ?></strong>
                                        <small class="d-block text-muted"><?= e($proj['funding_source'] ?? 'IRF') ?></small>
                                    </td>
                                    <td style="width: 140px;">
                                        <div class="progress mb-1" style="height: 10px;">
                                            <div class="progress-bar <?= $barBg ?>" style="width: <?= $pct ?>%;"><?= $pct ?>%</div>
                                        </div>
                                        <small class="text-muted font-weight-bold"><?= $pct >= 100 ? 'Finalized' : "{$pct}% Completed" ?></small>
                                    </td>
                                    <td>
                                        <span class="badge <?= $badgeSt ?> px-2 py-1"><?= e($pst) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-maroon" onclick="openProjectDossier(<?= $jsonAttr ?>)">
                                            <i class="fas fa-folder-open me-1"></i> Dossier
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

    <!-- Empty Search State Placeholder -->
    <div class="row d-none" id="emptySearchNotice">
        <div class="col-12 py-4 text-center">
            <div class="card shadow-sm border-0 py-4">
                <div class="card-body">
                    <i class="fas fa-search fa-2x text-muted mb-2"></i>
                    <h5 class="text-dark font-weight-bold mb-1">No Matching Projects Found</h5>
                    <p class="text-muted small mb-0">Try clearing your status, college, or research thrust filters.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: REGISTER APPROVED RESEARCH PROJECT                                         -->
<!-- ==================================================================================== -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form method="POST" action="<?= url('irimkms/projects/store') ?>" id="addProjectForm">
                <?= csrf_field() ?>
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title font-weight-bold" id="addProjectModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>Register Approved Research Project
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="fas fa-info-circle me-1 text-maroon"></i> Register approved research proposals to activate university grant tracking, milestone monitoring, and financial allocation records.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Project Code</label>
                            <input type="text" class="form-control" name="project_code" placeholder="e.g. PRJ-2026-005 (Auto if blank)">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label font-weight-bold text-dark">Project Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Full research project title" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Lead Principal Investigator (PI) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lead_pi" placeholder="e.g. Dr. Juan Dela Cruz" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Implementing College / Institute <span class="text-danger">*</span></label>
                            <select class="form-select" name="college" required>
                                <option value="CIT" selected>College of Information Technology (CIT)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CSM">College of Science and Mathematics (CSM)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CHS">College of Health Sciences (CHS)</option>
                                <option value="CED">College of Education (CED)</option>
                                <option value="CBA">College of Business & Accountancy (CBA)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Research Agenda Thrust <span class="text-danger">*</span></label>
                            <select class="form-select" name="research_thrust" required>
                                <option value="IT & AI Innovation" selected>IT & AI Innovation</option>
                                <option value="Agriculture & Food">Agriculture & Food</option>
                                <option value="Environment & Climate">Environment & Climate</option>
                                <option value="Renewable Energy">Renewable Energy</option>
                                <option value="Health Sciences">Health Sciences</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Funding Agency / Source <span class="text-danger">*</span></label>
                            <select class="form-select" name="funding_source">
                                <option value="Institutional IRF" selected>Institutional IRF</option>
                                <option value="DOST-GIA Grant">DOST-GIA Grant</option>
                                <option value="CHED Grant">CHED Grant</option>
                                <option value="External Partner">External Partner / Private Sector</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Approved Budget (₱)</label>
                            <input type="number" step="0.01" class="form-control" name="total_budget" placeholder="0.00" value="350000.00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Milestone Progress (%)</label>
                            <input type="number" min="0" max="100" class="form-control" name="progress_percent" value="15">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Project Status</label>
                            <select class="form-select" name="status">
                                <option value="Ongoing" selected>Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Planned">Planned</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Target Start Date</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Expected Completion Date</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Project Summary / Scope Statement</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Overview of project objectives, target deliverables, and methodology..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm shadow-sm">
                        <i class="fas fa-save me-1"></i> Register Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: PROJECT DOSSIER VIEW MODAL                                                  -->
<!-- ==================================================================================== -->
<div class="modal fade" id="projectDossierModal" tabindex="-1" aria-labelledby="projectDossierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="dossier-header-cover">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="badge bg-gold text-dark mb-2" id="dossierCodeTag">PRJ-2026-001</span>
                        <h4 class="font-weight-bold mb-1" id="dossierTitle">Project Title</h4>
                        <div class="small text-white-50" id="dossierCollegeThrust">
                            <i class="fas fa-university me-1"></i> College of Information Technology | IT & AI Innovation
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded border h-100">
                            <div class="small text-muted font-weight-bold text-uppercase mb-1">Principal Investigator</div>
                            <div class="h6 font-weight-bold text-dark mb-0" id="dossierPI">Dr. Researcher</div>
                            <small class="text-maroon font-weight-bold d-block" id="dossierCollegeTag">College of Information Technology</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded border h-100">
                            <div class="small text-muted font-weight-bold text-uppercase mb-1">Project Status</div>
                            <div class="h6 font-weight-bold text-maroon mb-0" id="dossierStatusText">Ongoing</div>
                            <small class="text-muted d-block" id="dossierDates">2026-01-15 to 2026-12-15</small>
                        </div>
                    </div>
                </div>

                <!-- Milestone Execution Progress -->
                <div class="p-3 bg-light rounded border mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-chart-line text-maroon me-1"></i> Milestone Execution Progress
                        </h6>
                        <span class="font-weight-bold text-maroon fs-6" id="dossierPctText">0%</span>
                    </div>
                    <div class="progress mb-2" style="height: 14px;">
                        <div class="progress-bar bg-success" id="dossierProgressBar" role="progressbar" style="width: 0%;">0%</div>
                    </div>
                </div>

                <!-- Financial Breakdown -->
                <div class="p-3 bg-light rounded border mb-4">
                    <h6 class="font-weight-bold text-dark mb-3">
                        <i class="fas fa-coins text-maroon me-1"></i> Financial Grant & Budget Breakdown
                    </h6>
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.75rem;">Funding Agency</small>
                            <strong class="text-dark fs-6" id="dossierFunding">Institutional IRF</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.75rem;">Total Approved Budget</small>
                            <strong class="text-maroon fs-5 font-weight-bold" id="dossierBudget">₱ 0.00</strong>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <h6 class="font-weight-bold text-dark mb-2">
                        <i class="fas fa-align-left text-maroon me-1"></i> Project Overview & Scope
                    </h6>
                    <p class="text-muted small leading-relaxed mb-0" id="dossierDescription">
                        No description available.
                    </p>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm" onclick="exportSingleProjectDossier()">
                    <i class="fas fa-download me-1"></i> Export Summary
                </button>
            </div>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- INTERACTIVE JAVASCRIPT (NO JQUERY DEPENDENCY)                                        -->
<!-- ==================================================================================== -->
<script>
    let activeStatusFilter = 'all';
    let currentDossierData = null;

    function switchViewMode(mode) {
        const gridView = document.getElementById('projectsGridView');
        const tableView = document.getElementById('projectsTableView');
        const btnGrid = document.getElementById('btnGridView');
        const btnTable = document.getElementById('btnTableView');

        if (mode === 'grid') {
            gridView.classList.remove('d-none');
            tableView.classList.add('d-none');
            btnGrid.classList.add('active');
            btnTable.classList.remove('active');
        } else {
            gridView.classList.add('d-none');
            tableView.classList.remove('d-none');
            btnGrid.classList.remove('active');
            btnTable.classList.add('active');
        }
    }

    function filterStatus(statusKey, element) {
        activeStatusFilter = statusKey;

        document.querySelectorAll('.db-tab-pill').forEach(pill => {
            pill.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }

        filterDatabase();
    }

    function filterDatabase() {
        const query = (document.getElementById('mainSearchInput')?.value || '').toLowerCase().trim();
        const selectedCollege = document.getElementById('collegeFilter')?.value || 'all';
        const selectedThrust = document.getElementById('thrustFilter')?.value || 'all';

        // Filter grid items
        const gridItems = document.querySelectorAll('#projectsGridView .project-item-wrapper');
        let visibleGridCount = 0;

        gridItems.forEach(item => {
            const itemSearch = item.getAttribute('data-search') || '';
            const itemCollege = item.getAttribute('data-college') || '';
            const itemThrust = item.getAttribute('data-thrust') || '';
            const itemStatus = item.getAttribute('data-status') || '';

            const matchesQuery = !query || itemSearch.includes(query);
            const matchesCollege = (selectedCollege === 'all') || (itemCollege.toUpperCase() === selectedCollege.toUpperCase());
            const matchesThrust = (selectedThrust === 'all') || (itemThrust.toLowerCase().includes(selectedThrust.toLowerCase()));
            const matchesStatus = (activeStatusFilter === 'all') || (itemStatus === activeStatusFilter.toLowerCase());

            if (matchesQuery && matchesCollege && matchesThrust && matchesStatus) {
                item.style.display = 'block';
                visibleGridCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Filter table rows
        const tableRows = document.querySelectorAll('#projectTable tbody tr.project-table-row');
        tableRows.forEach(row => {
            const rowSearch = row.getAttribute('data-search') || '';
            const rowCollege = row.getAttribute('data-college') || '';
            const rowThrust = row.getAttribute('data-thrust') || '';
            const rowStatus = row.getAttribute('data-status') || '';

            const matchesQuery = !query || rowSearch.includes(query);
            const matchesCollege = (selectedCollege === 'all') || (rowCollege.toUpperCase() === selectedCollege.toUpperCase());
            const matchesThrust = (selectedThrust === 'all') || (rowThrust.toLowerCase().includes(selectedThrust.toLowerCase()));
            const matchesStatus = (activeStatusFilter === 'all') || (rowStatus === activeStatusFilter.toLowerCase());

            if (matchesQuery && matchesCollege && matchesThrust && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Toggle empty notice
        const emptyNotice = document.getElementById('emptySearchNotice');
        if (emptyNotice) {
            if (visibleGridCount === 0 && (gridItems.length > 0 || tableRows.length > 0)) {
                emptyNotice.classList.remove('d-none');
            } else {
                emptyNotice.classList.add('d-none');
            }
        }
    }

    function openAddProjectModal() {
        const modalEl = document.getElementById('addProjectModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function openProjectDossier(proj) {
        if (!proj) return;
        currentDossierData = proj;

        document.getElementById('dossierCodeTag').textContent = proj.project_code || 'PRJ';
        document.getElementById('dossierTitle').textContent = proj.title || 'Untitled Project';
        document.getElementById('dossierCollegeThrust').innerHTML = `<i class="fas fa-university me-1"></i> ${proj.college || 'N/A'} | ${proj.research_thrust || 'General Research'}`;

        document.getElementById('dossierPI').textContent = proj.lead_pi || 'Not Assigned';
        document.getElementById('dossierCollegeTag').textContent = proj.college ? `Implementing College: ${proj.college}` : '';

        document.getElementById('dossierStatusText').textContent = proj.status || 'Ongoing';

        const dateStr = (proj.start_date || 'TBD') + ' to ' + (proj.end_date || 'TBD');
        document.getElementById('dossierDates').textContent = 'Timeline: ' + dateStr;

        const pct = parseInt(proj.progress_percent) || 0;
        document.getElementById('dossierPctText').textContent = pct + '%';
        const bar = document.getElementById('dossierProgressBar');
        bar.style.width = pct + '%';
        bar.textContent = pct + '%';

        document.getElementById('dossierFunding').textContent = proj.funding_source || 'Institutional IRF';

        const budgetVal = parseFloat(proj.total_budget) || 0;
        document.getElementById('dossierBudget').textContent = '₱ ' + budgetVal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});

        document.getElementById('dossierDescription').textContent = proj.description || 'No detailed overview description filed for this research project.';

        const modalEl = document.getElementById('projectDossierModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function exportSingleProjectDossier() {
        if (!currentDossierData) return;
        const text = `PROJECT DOSSIER SUMMARY\n-------------------------\nCode: ${currentDossierData.project_code}\nTitle: ${currentDossierData.title}\nLead PI: ${currentDossierData.lead_pi}\nCollege: ${currentDossierData.college}\nBudget: P ${currentDossierData.total_budget}\nStatus: ${currentDossierData.status}\nProgress: ${currentDossierData.progress_percent}%\n`;

        const blob = new Blob([text], { type: 'text/plain;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', `${currentDossierData.project_code}_Summary.txt`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportCSV() {
        const rows = [["Project Code", "Title", "Lead PI", "College", "Research Thrust", "Budget", "Progress (%)", "Status"]];

        document.querySelectorAll('#projectTable tbody tr.project-table-row').forEach(row => {
            if (row.style.display !== 'none') {
                const cols = row.querySelectorAll('td');
                if (cols.length >= 7) {
                    const code = cols[0].innerText.trim();
                    const titlePi = cols[1].innerText.replace(/\n/g, ' - ').trim();
                    const college = cols[2].innerText.trim();
                    const thrust = cols[3].innerText.trim();
                    const budget = cols[4].innerText.replace(/\n/g, ' ').trim();
                    const progress = cols[5].innerText.replace(/\n/g, ' ').trim();
                    const status = cols[6].innerText.trim();

                    rows.push([`"${code}"`, `"${titlePi}"`, `"${college}"`, `"${thrust}"`, `"${budget}"`, `"${progress}"`, `"${status}"`]);
                }
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `University_Research_Projects_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>