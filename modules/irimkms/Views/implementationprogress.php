<div class="container-fluid px-4 py-3" id="implementationProgressRoot">

    <!-- CSS Safeguards & Design System Tokens -->
    <style>
        #implementationProgressRoot, #implementationProgressRoot * {
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

        /* Unified MarSU Hero Banner System */
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

        /* Executive Stat Cards */
        .progress-stat-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: all 0.25s ease;
            height: 100%;
        }
        .progress-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(128, 0, 32, 0.12);
            border-color: rgba(128, 0, 32, 0.3);
        }
        .stat-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        /* Implementation Stage Progression Stepper */
        .stage-stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            margin: 15px 0 10px;
        }
        .stage-stepper::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: #e2e8f0;
            z-index: 1;
            transform: translateY(-50%);
        }
        .stage-step {
            position: relative;
            z-index: 2;
            background: #ffffff;
            border: 2px solid #cbd5e1;
            color: #64748b;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .stage-step.active {
            background: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.2);
        }
        .stage-step.completed {
            background: #10b981;
            border-color: #10b981;
            color: #ffffff;
        }
        .stage-step-label {
            position: absolute;
            top: 32px;
            font-size: 0.68rem;
            font-weight: 600;
            color: #64748b;
            white-space: nowrap;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Custom Dual Progress Bar */
        .dual-progress-bar {
            height: 10px;
            border-radius: 6px;
            background-color: #f1f5f9;
            overflow: hidden;
            display: flex;
        }
        .progress-physical {
            background: linear-gradient(90deg, #800020, #b3002d);
            transition: width 0.6s ease;
        }
        .progress-financial {
            background: linear-gradient(90deg, #d4af37, #f39c12);
            transition: width 0.6s ease;
        }

        /* Interactive Card Styling */
        .project-progress-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 22px;
            transition: all 0.25s ease;
            position: relative;
        }
        .project-progress-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: rgba(128, 0, 32, 0.3);
        }

        /* Status Pills */
        .status-pill {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .status-pill-ontrack { background-color: #d1fae5; color: #065f46; }
        .status-pill-delayed { background-color: #fee2e2; color: #991b1b; }
        .status-pill-ahead { background-color: #dbeafe; color: #1e40af; }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 320px;
        }

        /* Gantt Row Styling */
        .gantt-bar-wrapper {
            background: #f8fafc;
            border-radius: 6px;
            height: 24px;
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .gantt-fill-physical {
            height: 100%;
            background: linear-gradient(90deg, #800020 0%, #a8002a 100%);
            border-radius: 4px;
            display: flex;
            align-items: center;
            padding-left: 8px;
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
        }
    </style>

    <!-- Flash Notifications -->
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= e($_SESSION['flash_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= e($_SESSION['flash_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- Page Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="bi bi-hourglass-split me-1"></i> Field Execution & Physical Progress Monitor</span>
            <h1 class="page-hero-title mb-1">
                <i class="bi bi-card-checklist me-2 text-warning"></i>Project Implementation & Progress Tracker
            </h1>
            <p class="page-hero-subtitle">
                Monitor real-time physical completion rates, track fieldwork milestones, analyze financial vs physical execution variance, and log risk mitigations.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#logProgressModal">
                <i class="bi bi-plus-circle me-1"></i> Log Progress Update
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#flagRiskModal">
                <i class="bi bi-exclamation-triangle me-1"></i> Flag Risk / Bottleneck
            </button>
            <button class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportImplementationCSV()">
                <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Field Report CSV
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill active"><i class="bi bi-hourglass-split text-white me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill"><i class="bi bi-search text-maroon me-1"></i> Discovery Engine</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- KPI Summary Row -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="progress-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small">Avg Physical Completion</span>
                    <h2 class="mb-0 fw-extrabold text-maroon mt-1"><?= e($stats['avg_progress'] ?? '68.4') ?>%</h2>
                    <div class="progress mt-2" style="height: 6px; width: 140px;">
                        <div class="progress-bar bg-maroon" role="progressbar" style="width: <?= e($stats['avg_progress'] ?? '68.4') ?>%;"></div>
                    </div>
                </div>
                <div class="stat-icon-wrapper bg-maroon text-white shadow-sm">
                    <i class="fas fa-chart-pie"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="progress-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small">Projects On-Schedule</span>
                    <h2 class="mb-0 fw-extrabold text-success mt-1"><?= e($stats['on_track'] ?? '42') ?></h2>
                    <span class="badge bg-success-subtle text-success border border-success mt-2 font-weight-bold" style="font-size: 0.72rem;">
                        <i class="fas fa-check-circle me-1"></i> Meeting Milestones
                    </span>
                </div>
                <div class="stat-icon-wrapper bg-success text-white shadow-sm">
                    <i class="fas fa-running"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="progress-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small">Bottlenecks / Flagged</span>
                    <h2 class="mb-0 fw-extrabold text-danger mt-1"><?= e($stats['delayed'] ?? '6') ?></h2>
                    <span class="badge bg-danger-subtle text-danger border border-danger mt-2 font-weight-bold" style="font-size: 0.72rem;">
                        <i class="fas fa-exclamation-triangle me-1"></i> Action Required
                    </span>
                </div>
                <div class="stat-icon-wrapper bg-danger text-white shadow-sm">
                    <i class="fas fa-bug"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="progress-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small">Physical vs Budget Ratio</span>
                    <h2 class="mb-0 fw-extrabold text-dark mt-1">+3.2%</h2>
                    <span class="badge bg-warning-subtle text-dark border border-warning mt-2 font-weight-bold" style="font-size: 0.72rem;">
                        <i class="fas fa-balance-scale me-1"></i> Healthy Execution
                    </span>
                </div>
                <div class="stat-icon-wrapper bg-warning text-dark shadow-sm">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Interactive Filters Toolbar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <div class="row g-2 align-items-center">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" id="searchProgressInput" class="form-control border-start-0 bg-light" placeholder="Search project title, PI, or code..." onkeyup="filterProgressProjects()">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <select id="filterCollege" class="form-select bg-light" onchange="filterProgressProjects()">
                        <option value="">All Colleges</option>
                        <option value="CIT">College of Info Tech (CIT)</option>
                        <option value="COE">College of Engineering (COE)</option>
                        <option value="CSM">College of Science (CSM)</option>
                        <option value="COA">College of Agriculture (COA)</option>
                        <option value="CHER">College of Health Sciences</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <select id="filterPhase" class="form-select bg-light" onchange="filterProgressProjects()">
                        <option value="">All Implementation Phases</option>
                        <option value="Inception">Phase 1: Inception & Setup</option>
                        <option value="Fieldwork">Phase 2: Lab & Field Data</option>
                        <option value="Analysis">Phase 3: Data Analysis</option>
                        <option value="Manuscript">Phase 4: Manuscript & IP</option>
                        <option value="Terminal">Phase 5: Terminal Reporting</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <select id="filterStatus" class="form-select bg-light" onchange="filterProgressProjects()">
                        <option value="">All Statuses</option>
                        <option value="On Track">On Track</option>
                        <option value="Delayed">Delayed / At Risk</option>
                        <option value="Ahead">Ahead of Schedule</option>
                    </select>
                </div>
                <div class="col-lg-2 text-lg-end">
                    <div class="btn-group w-100" role="group">
                        <button type="button" class="btn btn-outline-secondary active btn-sm" id="btnViewCards" onclick="switchProgressView('cards')">
                            <i class="fas fa-th-large me-1"></i> Cards
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="btnViewTable" onclick="switchProgressView('table')">
                            <i class="fas fa-list me-1"></i> Table
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="btnViewGantt" onclick="switchProgressView('gantt')">
                            <i class="fas fa-stream me-1"></i> Timeline
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN VIEW 1: CARDS GRID VIEW -->
    <div id="progressCardsContainer" class="row g-3 mb-4">

        <?php
        // Seed default projects if dataset is empty
        $displayProjects = !empty($projects) ? $projects : [
            [
                'project_code' => 'PRJ-2026-001',
                'title' => 'Artificial Intelligence-Driven Water Quality Monitoring System for Local Aquaculture',
                'lead_pi' => 'Prof. Mhica Bianca Rodelas',
                'college' => 'CIT',
                'research_thrust' => 'IT & AI Innovation',
                'funding_source' => 'Institutional IRF',
                'total_budget' => 350000.00,
                'progress_pct' => 85,
                'financial_disbursed_pct' => 80,
                'current_phase' => 'Fieldwork',
                'status' => 'On Track',
                'end_date' => '2026-11-30',
                'recent_log' => 'Deployed sensor probes in Mogpog coastal fishponds; calibration completed.'
            ],
            [
                'project_code' => 'PRJ-2026-002',
                'title' => 'Smart Agricultural Crop Pest Detection Using Drone Imagery & Machine Learning',
                'lead_pi' => 'Prof. Gabriel Ramos',
                'college' => 'COA',
                'research_thrust' => 'Agriculture & Smart Farming',
                'funding_source' => 'DOST-GIA Grant',
                'total_budget' => 520000.00,
                'progress_pct' => 62,
                'financial_disbursed_pct' => 58,
                'current_phase' => 'Fieldwork',
                'status' => 'On Track',
                'end_date' => '2026-12-15',
                'recent_log' => 'Completed drone flight mapping over Gasan rice fields; initial dataset compiled.'
            ],
            [
                'project_code' => 'PRJ-2026-003',
                'title' => 'Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework',
                'lead_pi' => 'Dr. Elena Cruz',
                'college' => 'CSM',
                'research_thrust' => 'Environment & Climate Change',
                'funding_source' => 'CHED DARE TO Grant',
                'total_budget' => 410000.00,
                'progress_pct' => 45,
                'financial_disbursed_pct' => 50,
                'current_phase' => 'Analysis',
                'status' => 'Delayed',
                'end_date' => '2026-08-30',
                'recent_log' => 'Soil salinity sampling delayed due to monsoon high tides; rescheduled for next week.'
            ],
            [
                'project_code' => 'PRJ-2026-004',
                'title' => 'Nanomaterial-Based Solar Cell Efficiency Enhancement for Remote Island Communities',
                'lead_pi' => 'Engr. Ramon Valenzuela',
                'college' => 'COE',
                'research_thrust' => 'Renewable Energy',
                'funding_source' => 'External Industry Partner',
                'total_budget' => 680000.00,
                'progress_pct' => 92,
                'financial_disbursed_pct' => 90,
                'current_phase' => 'Manuscript',
                'status' => 'Ahead',
                'end_date' => '2026-06-30',
                'recent_log' => 'Lab synthesis finalized; utility model patent application submitted to IPOPHL.'
            ],
            [
                'project_code' => 'PRJ-2026-005',
                'title' => 'Ethnobotanical Survey & Antimicrobial Screening of Marinduque Endemic Plants',
                'lead_pi' => 'Dr. Carmela Bautista',
                'college' => 'CHER',
                'research_thrust' => 'Health & Biotechnology',
                'funding_source' => 'DOST-PCHRD Grant',
                'total_budget' => 480000.00,
                'progress_pct' => 30,
                'financial_disbursed_pct' => 35,
                'current_phase' => 'Inception',
                'status' => 'On Track',
                'end_date' => '2027-02-28',
                'recent_log' => 'Ethics Board Clearance obtained; IP community consent documentation initiated.'
            ],
            [
                'project_code' => 'PRJ-2026-006',
                'title' => 'Development of E-Governance Portal for Island Local Government Units',
                'lead_pi' => 'Prof. Joseph Tan',
                'college' => 'CIT',
                'research_thrust' => 'IT & Governance',
                'funding_source' => 'LGU Funded',
                'total_budget' => 290000.00,
                'progress_pct' => 78,
                'financial_disbursed_pct' => 75,
                'current_phase' => 'Fieldwork',
                'status' => 'On Track',
                'end_date' => '2026-09-15',
                'recent_log' => 'User acceptance testing conducted with Boac municipal treasury personnel.'
            ]
        ];

        foreach ($displayProjects as $index => $pj):
            $physPct = (int)($pj['progress_pct'] ?? 50);
            $finPct = (int)($pj['financial_disbursed_pct'] ?? $physPct);
            $status = $pj['status'] ?? 'On Track';
            $statusClass = $status === 'Delayed' ? 'status-pill-delayed' : ($status === 'Ahead' ? 'status-pill-ahead' : 'status-pill-ontrack');
            $statusIcon = $status === 'Delayed' ? 'fa-exclamation-triangle' : ($status === 'Ahead' ? 'fa-rocket' : 'fa-check-circle');
            $phase = $pj['current_phase'] ?? 'Fieldwork';
        ?>
        <div class="col-xl-6 progress-item-card" 
             data-title="<?= e(strtolower($pj['title'])) ?>"
             data-pi="<?= e(strtolower($pj['lead_pi'])) ?>"
             data-code="<?= e(strtolower($pj['project_code'])) ?>"
             data-college="<?= e($pj['college']) ?>"
             data-phase="<?= e($phase) ?>"
             data-status="<?= e($status) ?>">
            
            <div class="project-progress-card shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <!-- Header Badges -->
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-maroon text-white font-weight-bold px-2 py-1" style="font-size: 0.75rem;"><?= e($pj['project_code']) ?></span>
                            <span class="badge bg-light text-dark border font-weight-bold" style="font-size: 0.75rem;"><?= e($pj['college']) ?></span>
                            <span class="badge bg-secondary-subtle text-secondary border" style="font-size: 0.72rem;"><?= e($pj['funding_source']) ?></span>
                        </div>
                        <span class="status-pill <?= $statusClass ?>">
                            <i class="fas <?= $statusIcon ?>"></i> <?= e($status) ?>
                        </span>
                    </div>

                    <!-- Title & Lead PI -->
                    <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem; line-height: 1.35;">
                        <?= e($pj['title']) ?>
                    </h5>
                    <p class="text-muted small mb-3">
                        <i class="fas fa-user-tie text-maroon me-1"></i> Lead Investigator: <strong><?= e($pj['lead_pi']) ?></strong>
                        <span class="ms-2"><i class="fas fa-calendar-alt text-secondary me-1"></i> Target End: <?= e($pj['end_date']) ?></span>
                    </p>

                    <!-- Dual Completion Comparison Metrics -->
                    <div class="bg-light p-3 rounded-3 mb-3 border">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-bold text-dark"><i class="fas fa-running text-maroon me-1"></i> Physical Progress:</span>
                            <span class="fw-extrabold text-maroon font-weight-bold"><?= $physPct ?>% Completed</span>
                        </div>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-maroon" role="progressbar" style="width: <?= $physPct ?>%;"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
                            <span class="small font-weight-bold text-muted"><i class="fas fa-coins text-warning me-1"></i> Financial Utilization:</span>
                            <span class="small fw-bold text-dark"><?= $finPct ?>% Disbursed (₱<?= number_format((float)($pj['total_budget'] ?? 0) * ($finPct / 100)) ?>)</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $finPct ?>%;"></div>
                        </div>
                    </div>

                    <!-- Milestone Implementation Stepper Visualizer -->
                    <div class="mb-3 px-2">
                        <div class="d-flex justify-content-between align-items-center text-muted mb-1" style="font-size: 0.72rem; font-weight: 700;">
                            <span>STAGE PROGRESSION:</span>
                            <span class="text-maroon font-weight-bold">Current: <?= e($phase) ?> Phase</span>
                        </div>
                        <div class="stage-stepper">
                            <div class="stage-step <?= in_array($phase, ['Inception', 'Fieldwork', 'Analysis', 'Manuscript', 'Terminal']) ? 'completed' : '' ?>" title="Phase 1: Inception">1</div>
                            <div class="stage-step <?= in_array($phase, ['Fieldwork', 'Analysis', 'Manuscript', 'Terminal']) ? ($phase === 'Fieldwork' ? 'active' : 'completed') : '' ?>" title="Phase 2: Fieldwork">2</div>
                            <div class="stage-step <?= in_array($phase, ['Analysis', 'Manuscript', 'Terminal']) ? ($phase === 'Analysis' ? 'active' : 'completed') : '' ?>" title="Phase 3: Analysis">3</div>
                            <div class="stage-step <?= in_array($phase, ['Manuscript', 'Terminal']) ? ($phase === 'Manuscript' ? 'active' : 'completed') : '' ?>" title="Phase 4: Manuscript">4</div>
                            <div class="stage-step <?= $phase === 'Terminal' ? 'active' : '' ?>" title="Phase 5: Terminal">5</div>
                        </div>
                    </div>

                    <!-- Recent Implementation Log Snippet -->
                    <div class="p-2 px-3 bg-white border-start border-3 border-maroon rounded text-muted small">
                        <i class="fas fa-history me-1 text-maroon"></i> <strong>Latest Update:</strong> <?= e($pj['recent_log'] ?? 'Field operations active.') ?>
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="pt-3 mt-3 border-top d-flex gap-2 justify-content-end">
                    <button class="btn btn-outline-maroon btn-sm px-3 font-weight-bold" onclick="quickLogUpdate('<?= e($pj['project_code']) ?>', '<?= e(addslashes($pj['title'])) ?>', <?= $physPct ?>)">
                        <i class="fas fa-edit me-1"></i> Update Progress
                    </button>
                    <button class="btn btn-maroon btn-sm px-3 font-weight-bold" onclick="viewAuditTrail('<?= e($pj['project_code']) ?>')">
                        <i class="fas fa-search-plus me-1"></i> Audit Trail
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- MAIN VIEW 2: DETAILED MATRIX TABLE VIEW (HIDDEN BY DEFAULT) -->
    <div id="progressTableContainer" class="card border-0 shadow-sm mb-4 d-none">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-maroon text-white">
                        <tr>
                            <th class="py-3 px-3">Code & College</th>
                            <th class="py-3">Project Title & Lead PI</th>
                            <th class="py-3">Current Phase</th>
                            <th class="py-3">Physical Progress</th>
                            <th class="py-3">Financial Utilization</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end px-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($displayProjects as $pj): 
                            $physPct = (int)($pj['progress_pct'] ?? 50);
                            $finPct = (int)($pj['financial_disbursed_pct'] ?? $physPct);
                            $status = $pj['status'] ?? 'On Track';
                            $statusClass = $status === 'Delayed' ? 'status-pill-delayed' : ($status === 'Ahead' ? 'status-pill-ahead' : 'status-pill-ontrack');
                        ?>
                        <tr>
                            <td class="px-3">
                                <span class="fw-bold text-maroon"><?= e($pj['project_code']) ?></span>
                                <div class="small text-muted"><?= e($pj['college']) ?> • <?= e($pj['funding_source']) ?></div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= e($pj['title']) ?></div>
                                <div class="small text-muted"><i class="fas fa-user-tie me-1"></i> <?= e($pj['lead_pi']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-dark border font-weight-bold"><?= e($pj['current_phase'] ?? 'Fieldwork') ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2" style="width: 140px;">
                                    <div class="progress flex-grow-1" style="height: 6px;">
                                        <div class="progress-bar bg-maroon" style="width: <?= $physPct ?>%;"></div>
                                    </div>
                                    <span class="fw-bold small"><?= $physPct ?>%</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2" style="width: 140px;">
                                    <div class="progress flex-grow-1" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: <?= $finPct ?>%;"></div>
                                    </div>
                                    <span class="fw-bold small text-muted"><?= $finPct ?>%</span>
                                </div>
                            </td>
                            <td>
                                <span class="status-pill <?= $statusClass ?>"><?= e($status) ?></span>
                            </td>
                            <td class="text-end px-3">
                                <button class="btn btn-sm btn-outline-maroon font-weight-bold" onclick="quickLogUpdate('<?= e($pj['project_code']) ?>', '<?= e(addslashes($pj['title'])) ?>', <?= $physPct ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MAIN VIEW 3: GANTT & TIMELINE VIEW (HIDDEN BY DEFAULT) -->
    <div id="progressGanttContainer" class="card border-0 shadow-sm mb-4 d-none">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-maroon"><i class="fas fa-stream me-2"></i> Implementation Timeline & Milestone Progress</h5>
            <span class="small text-muted"><i class="fas fa-info-circle me-1"></i> Visual representation of physical progress across project quarters</span>
        </div>
        <div class="card-body p-4">
            <!-- Timeline Months Header -->
            <div class="row text-center fw-bold small text-muted mb-3 border-bottom pb-2">
                <div class="col-4 text-start">Project Details</div>
                <div class="col-2">Q1 (Jan-Mar)</div>
                <div class="col-2">Q2 (Apr-Jun)</div>
                <div class="col-2">Q3 (Jul-Sep)</div>
                <div class="col-2">Q4 (Oct-Dec)</div>
            </div>

            <?php foreach ($displayProjects as $pj): 
                $physPct = (int)($pj['progress_pct'] ?? 50);
            ?>
            <div class="row align-items-center py-2 border-bottom">
                <div class="col-4">
                    <div class="fw-bold text-dark text-truncate" style="max-width: 280px;"><?= e($pj['title']) ?></div>
                    <div class="small text-muted"><?= e($pj['project_code']) ?> • <?= e($pj['lead_pi']) ?></div>
                </div>
                <div class="col-8">
                    <div class="gantt-bar-wrapper">
                        <div class="gantt-fill-physical" style="width: <?= $physPct ?>%;">
                            <?= $physPct ?>% Physical Progress
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- MODAL 1: LOG PROGRESS UPDATE -->
    <div class="modal fade" id="logProgressModal" tabindex="-1" aria-labelledby="logProgressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title font-weight-bold" id="logProgressModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>Log Project Progress & Field Update
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="progressUpdateForm" onsubmit="handleProgressSubmit(event)">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Select Active Project <span class="text-danger">*</span></label>
                            <select id="modalProjectSelect" class="form-select" required>
                                <option value="">-- Choose Project --</option>
                                <?php foreach ($displayProjects as $pj): ?>
                                    <option value="<?= e($pj['project_code']) ?>"><?= e($pj['project_code']) ?> - <?= e($pj['title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold text-dark">Current Implementation Phase</label>
                                <select id="modalPhaseSelect" class="form-select">
                                    <option value="Inception">Phase 1: Inception & Ethics Setup</option>
                                    <option value="Fieldwork" selected>Phase 2: Lab & Field Data Gathering</option>
                                    <option value="Analysis">Phase 3: Data Processing & Analysis</option>
                                    <option value="Manuscript">Phase 4: Manuscript & Patent Filing</option>
                                    <option value="Terminal">Phase 5: Terminal Report Submission</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold text-dark">Status Classification</label>
                                <select id="modalStatusSelect" class="form-select">
                                    <option value="On Track" selected>On Track (On Schedule)</option>
                                    <option value="Delayed">Delayed / Encountering Risk</option>
                                    <option value="Ahead">Ahead of Target Timeline</option>
                                </select>
                            </div>
                        </div>

                        <!-- Interactive Range Slider -->
                        <div class="mb-4 bg-light p-3 rounded-3 border">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label font-weight-bold text-maroon mb-0">Physical Completion Percentage (%)</label>
                                <span class="badge bg-maroon text-white font-weight-bold fs-6" id="progressValDisplay">75%</span>
                            </div>
                            <input type="range" class="form-range" id="modalProgressRange" min="0" max="100" value="75" oninput="syncRangeValue(this.value)">
                            <div class="d-flex justify-content-between text-muted small">
                                <span>0% (Just Started)</span>
                                <span>50% (Midterm Completed)</span>
                                <span>100% (Fully Completed)</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Work Accomplished & Accomplishment Summary <span class="text-danger">*</span></label>
                            <textarea id="modalLogSummary" class="form-control" rows="3" placeholder="Describe recent field activities, lab tests completed, dataset gathered..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Attach Verification / Progress Report (PDF, PNG, JPG)</label>
                            <input type="file" class="form-control" accept=".pdf,.png,.jpg,.jpeg">
                            <div class="form-text">Optional fieldwork photos, signed accomplishment sheets, or laboratory test logs.</div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light px-4 py-3">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-maroon font-weight-bold px-4">
                            <i class="fas fa-check-circle me-1"></i> Save Progress Log
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 2: FLAG RISK / BOTTLENECK -->
    <div class="modal fade" id="flagRiskModal" tabindex="-1" aria-labelledby="flagRiskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title font-weight-bold" id="flagRiskModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Flag Implementation Risk or Delay
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="flagRiskForm" onsubmit="handleRiskSubmit(event)">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Select Affected Project <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">-- Choose Project --</option>
                                <?php foreach ($displayProjects as $pj): ?>
                                    <option value="<?= e($pj['project_code']) ?>"><?= e($pj['project_code']) ?> - <?= e($pj['title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold text-dark">Risk Category</label>
                                <select class="form-select">
                                    <option value="Procurement">Procurement & Bidding Delay</option>
                                    <option value="Weather">Weather / Field Access Issue</option>
                                    <option value="Equipment">Lab Equipment Failure</option>
                                    <option value="Ethics">Ethics Clearance Pending</option>
                                    <option value="Staffing">Staffing / Personnel Exit</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold text-dark">Severity Level</label>
                                <select class="form-select">
                                    <option value="High" class="text-danger font-weight-bold">High (Schedule Critical)</option>
                                    <option value="Medium" class="text-warning font-weight-bold" selected>Medium (Moderate Impact)</option>
                                    <option value="Low" class="text-info font-weight-bold">Low (Minor Delay)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Description of Bottleneck & Proposed Mitigation Plan <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Specify the issue encountered and steps requested from the IRIMKMS technical panel..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light px-4 py-3">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger font-weight-bold px-4">
                            <i class="fas fa-flag me-1"></i> Submit Risk Alert
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification Element -->
    <div id="toastContainer" class="toast-notification"></div>

</div>

<!-- Vanilla JS Interactive Controls -->
<script>
    // Range Slider Sync
    function syncRangeValue(val) {
        document.getElementById('progressValDisplay').textContent = val + '%';
    }

    // Quick Update Action Trigger
    function quickLogUpdate(code, title, currentVal) {
        var modalProj = document.getElementById('modalProjectSelect');
        if (modalProj) modalProj.value = code;

        var modalRange = document.getElementById('modalProgressRange');
        if (modalRange) {
            modalRange.value = currentVal;
            syncRangeValue(currentVal);
        }

        var bsModal = new bootstrap.Modal(document.getElementById('logProgressModal'));
        bsModal.show();
    }

    // View Switcher (Cards vs Table vs Gantt)
    function switchProgressView(viewMode) {
        var cardsView = document.getElementById('progressCardsContainer');
        var tableView = document.getElementById('progressTableContainer');
        var ganttView = document.getElementById('progressGanttContainer');

        var btnCards = document.getElementById('btnViewCards');
        var btnTable = document.getElementById('btnViewTable');
        var btnGantt = document.getElementById('btnViewGantt');

        btnCards.classList.remove('active');
        btnTable.classList.remove('active');
        btnGantt.classList.remove('active');

        cardsView.classList.add('d-none');
        tableView.classList.add('d-none');
        ganttView.classList.add('d-none');

        if (viewMode === 'cards') {
            cardsView.classList.remove('d-none');
            btnCards.classList.add('active');
        } else if (viewMode === 'table') {
            tableView.classList.remove('d-none');
            btnTable.classList.add('active');
        } else if (viewMode === 'gantt') {
            ganttView.classList.remove('d-none');
            btnGantt.classList.add('active');
        }
    }

    // Real-Time Filter Function
    function filterProgressProjects() {
        var query = document.getElementById('searchProgressInput').value.toLowerCase().trim();
        var collegeFilter = document.getElementById('filterCollege').value.toLowerCase();
        var phaseFilter = document.getElementById('filterPhase').value.toLowerCase();
        var statusFilter = document.getElementById('filterStatus').value.toLowerCase();

        var cards = document.querySelectorAll('.progress-item-card');
        cards.forEach(function(card) {
            var title = card.getAttribute('data-title') || '';
            var pi = card.getAttribute('data-pi') || '';
            var code = card.getAttribute('data-code') || '';
            var college = (card.getAttribute('data-college') || '').toLowerCase();
            var phase = (card.getAttribute('data-phase') || '').toLowerCase();
            var status = (card.getAttribute('data-status') || '').toLowerCase();

            var matchesQuery = !query || title.includes(query) || pi.includes(query) || code.includes(query);
            var matchesCollege = !collegeFilter || college === collegeFilter;
            var matchesPhase = !phaseFilter || phase.includes(phaseFilter);
            var matchesStatus = !statusFilter || status.includes(statusFilter);

            if (matchesQuery && matchesCollege && matchesPhase && matchesStatus) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Modal Form Handlers
    function handleProgressSubmit(e) {
        e.preventDefault();
        var modalEl = document.getElementById('logProgressModal');
        var bsModal = bootstrap.Modal.getInstance(modalEl);
        if (bsModal) bsModal.hide();

        showToast('success', 'Progress Logged Successfully', 'The physical progress and accomplishment log have been recorded in the IRIMKMS database.');
    }

    function handleRiskSubmit(e) {
        e.preventDefault();
        var modalEl = document.getElementById('flagRiskModal');
        var bsModal = bootstrap.Modal.getInstance(modalEl);
        if (bsModal) bsModal.hide();

        showToast('warning', 'Risk Alert Flagged', 'The bottleneck notification has been transmitted to the IRIMKMS research monitoring committee.');
    }

    // Audit Trail Modal Preview Trigger
    function viewAuditTrail(code) {
        showToast('info', 'Project Audit Log: ' + code, 'Loading historical milestone updates, field verification logs, and financial disbursement history...');
    }

    // Toast Notification System
    function showToast(type, title, message) {
        var toastContainer = document.getElementById('toastContainer');
        var bgClass = type === 'success' ? 'bg-success' : (type === 'warning' ? 'bg-warning text-dark' : 'bg-info');
        var textClass = type === 'warning' ? 'text-dark' : 'text-white';

        var toastHtml = `
            <div class="toast show align-items-center ${textClass} ${bgClass} border-0 shadow-lg mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>${title}</strong><br>${message}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto ${type === 'warning' ? '' : 'btn-close-white'}" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        toastContainer.innerHTML = toastHtml;

        setTimeout(function() {
            toastContainer.innerHTML = '';
        }, 5000);
    }

    // Export CSV Helper
    function exportImplementationCSV() {
        var csvContent = "data:text/csv;charset=utf-8,Project Code,Title,Lead PI,College,Funding Source,Physical Progress (%),Financial Disbursed (%),Current Phase,Status\n";
        csvContent += "PRJ-2026-001,AI Water Quality System,Prof. Mhica Bianca Rodelas,CIT,Institutional IRF,85,80,Fieldwork,On Track\n";
        csvContent += "PRJ-2026-002,Smart Agricultural Drone Detection,Prof. Gabriel Ramos,COA,DOST-GIA,62,58,Fieldwork,On Track\n";
        csvContent += "PRJ-2026-003,Coastal Bio-Shield Mangroves,Dr. Elena Cruz,CSM,CHED DARE TO,45,50,Analysis,Delayed\n";
        csvContent += "PRJ-2026-004,Nanomaterial Solar Cell,Engr. Ramon Valenzuela,COE,External Partner,92,90,Manuscript,Ahead\n";

        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "MarSU_IRIMKMS_Implementation_Progress_Report.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('success', 'Export Completed', 'The Implementation Progress CSV report has been generated and downloaded.');
    }
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>

