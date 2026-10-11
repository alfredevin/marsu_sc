<div class="container-fluid py-3" id="projectMilestoneRoot">

    <!-- Custom CSS Safeguards & Styling -->
    <style>
        #projectMilestoneRoot, #projectMilestoneRoot * {
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

        /* Filter Tab Pills */
        .ms-tab-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 20px;
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.85rem;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 6px;
            cursor: pointer;
            border: 1px solid #d1d3e2;
            transition: all 0.2s ease;
        }
        .ms-tab-pill:hover {
            background-color: #eaecf4;
            color: var(--maroon-main);
        }
        .ms-tab-pill.active {
            background-color: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
        }

        /* Milestone Card & Timeline Row */
        .project-milestone-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .milestone-item-row {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f3f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background 0.2s;
        }
        .milestone-item-row:hover {
            background-color: #fcfdfe;
        }
        .milestone-item-row:last-child {
            border-bottom: none;
        }

        .milestone-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-right: 16px;
            flex-shrink: 0;
        }
        .milestone-icon-box.completed {
            background-color: #e8f8f0;
            color: #1cc88a;
            border: 1px solid #c3e6cb;
        }
        .milestone-icon-box.progress {
            background-color: #fff9e6;
            color: #f6c23e;
            border: 1px solid #ffeba8;
        }
        .milestone-icon-box.overdue {
            background-color: #fde8e8;
            color: #e74a3b;
            border: 1px solid #f5c6cb;
        }
        .milestone-icon-box.pending {
            background-color: #f1f3f9;
            color: #858796;
            border: 1px solid #d1d3e2;
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
    </style>

    <!-- Uniform MarSU Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="fas fa-flag me-1"></i> Deliverable Timelines & Milestones</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-tasks me-2 text-warning"></i>Project Milestones & Accomplishment Tracker
            </h1>
            <p class="page-hero-subtitle">
                Monitor target deadlines, upload milestone accomplishment proof, conduct peer verification, and track quarterly research output status.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" onclick="openSubmitDeliverableModal()">
                <i class="fas fa-upload me-1"></i> Submit Deliverable
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="exportMilestoneReportCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Report
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill active"><i class="bi bi-flag text-white me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
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
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Total Milestones Tracked</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['total_milestones'] ?? 128) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed & Verified</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['completed'] ?? 84) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Active In Progress</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['in_progress'] ?? 32) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Overdue / Action Needed</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['overdue'] ?? 12) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="card shadow mb-4">
        <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="d-flex flex-wrap align-items-center">
                        <span class="small font-weight-bold text-muted me-2 mb-1">Status:</span>
                        <span class="ms-tab-pill active" onclick="filterStatus('all', this)">All (<?= (int)($stats['total_milestones'] ?? 128) ?>)</span>
                        <span class="ms-tab-pill" onclick="filterStatus('progress', this)"><i class="fas fa-clock text-warning me-1"></i> In Progress (<?= (int)($stats['in_progress'] ?? 32) ?>)</span>
                        <span class="ms-tab-pill" onclick="filterStatus('completed', this)"><i class="fas fa-check text-success me-1"></i> Completed (<?= (int)($stats['completed'] ?? 84) ?>)</span>
                        <span class="ms-tab-pill" onclick="filterStatus('overdue', this)"><i class="fas fa-exclamation text-danger me-1"></i> Overdue (<?= (int)($stats['overdue'] ?? 12) ?>)</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <select class="form-select form-select-sm" id="projectFilter" onchange="filterMilestones()">
                                <option value="all" selected>All Research Projects</option>
                                <?php if (!empty($projects)): ?>
                                    <?php foreach ($projects as $pj): ?>
                                        <option value="<?= e($pj['project_code']) ?>"><?= e($pj['project_code']) ?> (<?= e(mb_strimwidth($pj['title'], 0, 25, '...')) ?>)</option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="PRJ-2026-001">PRJ-2026-001 (AI Water Quality)</option>
                                    <option value="PRJ-2024-112">PRJ-2024-112 (Solar Cell)</option>
                                    <option value="PRJ-2025-084">PRJ-2025-084 (Pest Drone)</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search milestone..." id="mainSearchInput" oninput="filterMilestones()">
                                <button type="button" class="btn bg-maroon text-white"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Milestone Timeline Container -->
    <div id="milestonesContainer">

        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $pj): ?>
                <?php
                    $code = e($pj['project_code']);
                    $pct = (int)($pj['progress_percent'] ?? 0);
                    $pi = e($pj['lead_pi'] ?? 'Principal Investigator');
                    $title = e($pj['title']);
                    $college = e($pj['college'] ?? 'CIT');
                ?>
                <div class="card project-milestone-card shadow mb-4 milestone-project-card" data-project="<?= $code ?>">
                    <div class="card-header py-3 bg-light d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-maroon text-white font-weight-bold me-2"><?= $code ?></span>
                            <strong class="text-dark h6 font-weight-bold mb-0"><?= $title ?></strong>
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-user-circle text-maroon me-1"></i> Lead PI: <strong><?= $pi ?></strong> (<?= $college ?>)
                            </small>
                        </div>
                        <div class="text-md-end mt-2 mt-md-0" style="min-width: 180px;">
                            <small class="text-muted font-weight-bold text-xs uppercase d-block">Milestone Completion</small>
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-maroon" style="width: <?= $pct ?>%;"></div>
                                </div>
                                <span class="font-weight-bold text-maroon small"><?= $pct ?>%</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <!-- ITEM 1: Q1 -->
                        <div class="milestone-item-row milestone-row" data-status="<?= $pct >= 25 ? 'completed' : 'progress' ?>"
                             data-search="<?= strtolower($code . ' Q1 Milestone 1.1 Architecture Design Component Selection ' . $pi . ' ' . $college) ?>">
                            <div class="d-flex align-items-center">
                                <div class="milestone-icon-box <?= $pct >= 25 ? 'completed' : 'progress' ?>">
                                    <i class="fas <?= $pct >= 25 ? 'fa-check' : 'fa-sync-alt' ?>"></i>
                                </div>
                                <div>
                                    <span class="badge bg-light border text-muted font-weight-bold mb-1">Q1 Deliverable</span>
                                    <h6 class="font-weight-bold text-dark mb-0">Milestone 1.1: Architecture Specification & Component Selection</h6>
                                    <small class="text-muted">Target Deadline: Q1 2026 • Verified by Research M&E Office</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <?php if ($pct >= 25): ?>
                                    <span class="badge bg-success text-white py-1 px-3 mb-1 d-block"><i class="fas fa-check-circle me-1"></i> Verified Deliverable</span>
                                    <button class="btn btn-sm btn-link text-maroon p-0 font-weight-bold small text-decoration-none"
                                            onclick="openAuditModal('<?= $code ?>', 'Milestone 1.1: Architecture Specification', 'Component_Selection_Report.pdf')">
                                        View Evidence PDF
                                    </button>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark py-1 px-3 mb-1 d-block font-weight-bold"><i class="fas fa-spinner fa-spin me-1"></i> In Progress</span>
                                    <button class="btn btn-sm btn-gold" onclick="openSubmitDeliverableModal('<?= $code ?>', 'Milestone 1.1: Architecture Specification')">
                                        Upload Deliverable
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ITEM 2: Q2 -->
                        <div class="milestone-item-row milestone-row" data-status="<?= $pct >= 50 ? 'completed' : ($pct >= 25 ? 'progress' : 'pending') ?>"
                             data-search="<?= strtolower($code . ' Q2 Milestone 1.2 Prototype Model Training Data ' . $pi . ' ' . $college) ?>">
                            <div class="d-flex align-items-center">
                                <div class="milestone-icon-box <?= $pct >= 50 ? 'completed' : ($pct >= 25 ? 'progress' : 'pending') ?>">
                                    <i class="fas <?= $pct >= 50 ? 'fa-check' : ($pct >= 25 ? 'fa-sync-alt' : 'fa-calendar-alt') ?>"></i>
                                </div>
                                <div>
                                    <span class="badge bg-light border text-muted font-weight-bold mb-1">Q2 Deliverable</span>
                                    <h6 class="font-weight-bold text-dark mb-0">Milestone 1.2: System Prototype & Initial Data Validation</h6>
                                    <small class="text-muted">Target Deadline: Q2 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <?php if ($pct >= 50): ?>
                                    <span class="badge bg-success text-white py-1 px-3 mb-1 d-block"><i class="fas fa-check-circle me-1"></i> Verified Deliverable</span>
                                    <button class="btn btn-sm btn-link text-maroon p-0 font-weight-bold small text-decoration-none"
                                            onclick="openAuditModal('<?= $code ?>', 'Milestone 1.2: Prototype Validation', 'Prototype_Validation_Matrix.pdf')">
                                        View Evidence PDF
                                    </button>
                                <?php elseif ($pct >= 25): ?>
                                    <span class="badge bg-warning text-dark py-1 px-3 mb-1 d-block font-weight-bold"><i class="fas fa-spinner me-1"></i> In Progress</span>
                                    <button class="btn btn-sm btn-gold" onclick="openSubmitDeliverableModal('<?= $code ?>', 'Milestone 1.2: Prototype Validation')">
                                        Upload Deliverable
                                    </button>
                                <?php else: ?>
                                    <span class="badge bg-light border py-1 px-3 mb-1 d-block text-muted">Pending Scheduled Date</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ITEM 3: Q3 -->
                        <div class="milestone-item-row milestone-row" data-status="<?= $pct >= 75 ? 'completed' : ($pct >= 50 ? 'overdue' : 'pending') ?>"
                             data-search="<?= strtolower($code . ' Q3 Milestone 1.3 Field Testing Experimental Trials ' . $pi . ' ' . $college) ?>">
                            <div class="d-flex align-items-center">
                                <div class="milestone-icon-box <?= $pct >= 75 ? 'completed' : ($pct >= 50 ? 'overdue' : 'pending') ?>">
                                    <i class="fas <?= $pct >= 75 ? 'fa-check' : ($pct >= 50 ? 'fa-exclamation' : 'fa-calendar-alt') ?>"></i>
                                </div>
                                <div>
                                    <span class="badge <?= $pct >= 50 && $pct < 75 ? 'bg-danger text-white' : 'bg-light border text-muted' ?> font-weight-bold mb-1">
                                        <?= $pct >= 50 && $pct < 75 ? 'Overdue Action Needed' : 'Q3 Deliverable' ?>
                                    </span>
                                    <h6 class="font-weight-bold text-dark mb-0">Milestone 1.3: Field Deployment & Experimental Trials</h6>
                                    <small class="<?= $pct >= 50 && $pct < 75 ? 'text-danger font-weight-bold' : 'text-muted' ?>">
                                        Target Deadline: <?= $pct >= 50 && $pct < 75 ? 'Sept 30, 2026 (Action Required)' : 'Q3 2026' ?>
                                    </small>
                                </div>
                            </div>
                            <div class="text-end">
                                <?php if ($pct >= 75): ?>
                                    <span class="badge bg-success text-white py-1 px-3 mb-1 d-block"><i class="fas fa-check-circle me-1"></i> Verified Deliverable</span>
                                    <button class="btn btn-sm btn-link text-maroon p-0 font-weight-bold small text-decoration-none"
                                            onclick="openAuditModal('<?= $code ?>', 'Milestone 1.3: Field Deployment', 'Field_Deployment_Report.pdf')">
                                        View Evidence PDF
                                    </button>
                                <?php elseif ($pct >= 50): ?>
                                    <span class="badge bg-danger text-white py-1 px-3 mb-1 d-block font-weight-bold"><i class="fas fa-exclamation-triangle me-1"></i> Overdue Evidence</span>
                                    <button class="btn btn-sm btn-danger" onclick="openSubmitDeliverableModal('<?= $code ?>', 'Milestone 1.3: Field Deployment')">
                                        Submit Now
                                    </button>
                                <?php else: ?>
                                    <span class="badge bg-light border py-1 px-3 mb-1 d-block text-muted">Pending Scheduled Date</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ITEM 4: Q4 -->
                        <div class="milestone-item-row milestone-row" data-status="<?= $pct >= 100 ? 'completed' : 'pending' ?>"
                             data-search="<?= strtolower($code . ' Q4 Milestone 1.4 Dissemination Workshop Terminal Report ' . $pi . ' ' . $college) ?>">
                            <div class="d-flex align-items-center">
                                <div class="milestone-icon-box <?= $pct >= 100 ? 'completed' : 'pending' ?>">
                                    <i class="fas <?= $pct >= 100 ? 'fa-check' : 'fa-calendar-alt' ?>"></i>
                                </div>
                                <div>
                                    <span class="badge bg-light border text-muted font-weight-bold mb-1">Q4 Deliverable</span>
                                    <h6 class="font-weight-bold text-dark mb-0">Milestone 1.4: Dissemination Workshop & Terminal Report</h6>
                                    <small class="text-muted">Target Deadline: Q4 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <?php if ($pct >= 100): ?>
                                    <span class="badge bg-success text-white py-1 px-3 mb-1 d-block"><i class="fas fa-check-circle me-1"></i> Verified Deliverable</span>
                                    <button class="btn btn-sm btn-link text-maroon p-0 font-weight-bold small text-decoration-none"
                                            onclick="openAuditModal('<?= $code ?>', 'Milestone 1.4: Terminal Report', 'Terminal_Project_Report.pdf')">
                                        View Evidence PDF
                                    </button>
                                <?php else: ?>
                                    <span class="badge bg-light border py-1 px-3 mb-1 d-block text-muted">Pending Scheduled Date</span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Fallback static groups if database table is empty -->
            <div class="card project-milestone-card shadow mb-4 milestone-project-card" data-project="PRJ-2026-001">
                <div class="card-header py-3 bg-light d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-maroon text-white font-weight-bold me-2">PRJ-2026-001</span>
                        <strong class="text-dark h6 font-weight-bold mb-0">Artificial Intelligence-Driven Water Quality Monitoring System</strong>
                        <small class="text-muted d-block mt-1"><i class="fas fa-user-circle text-maroon me-1"></i> Lead PI: <strong>Mhica Bianca Rodelas</strong> (CIT)</small>
                    </div>
                    <div class="text-end" style="min-width: 180px;">
                        <small class="text-muted font-weight-bold text-xs uppercase d-block">Milestone Completion</small>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                <div class="progress-bar bg-maroon" style="width: 65%;"></div>
                            </div>
                            <span class="font-weight-bold text-maroon small">65%</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="milestone-item-row milestone-row" data-status="completed" data-search="prj-2026-001 system architecture sensor node component selection">
                        <div class="d-flex align-items-center">
                            <div class="milestone-icon-box completed"><i class="fas fa-check"></i></div>
                            <div>
                                <span class="badge bg-light border text-muted font-weight-bold mb-1">Q1 Deliverable</span>
                                <h6 class="font-weight-bold text-dark mb-0">Milestone 1.1: System Architecture & Sensor Selection</h6>
                                <small class="text-muted">Target Deadline: Q1 2026 • Verified on Sept 15, 2026 by Research M&E Office</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success text-white py-1 px-3 mb-1 d-block"><i class="fas fa-check-circle me-1"></i> Verified Deliverable</span>
                            <button class="btn btn-sm btn-link text-maroon p-0 font-weight-bold small text-decoration-none" onclick="openAuditModal('PRJ-2026-001', 'Milestone 1.1', 'Hardware_Selection_Report.pdf')">View Evidence PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <!-- End of Milestones Container -->

    <!-- Empty Search State Placeholder -->
    <div class="row d-none" id="emptySearchNotice">
        <div class="col-12 py-4 text-center">
            <div class="card shadow-sm border-0 py-4">
                <div class="card-body">
                    <i class="fas fa-search fa-2x text-muted mb-2"></i>
                    <h5 class="text-dark font-weight-bold mb-1">No Matching Milestones Found</h5>
                    <p class="text-muted small mb-0">Try clearing your project selection or search keywords.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: SUBMIT MILESTONE DELIVERABLE                                                -->
<!-- ==================================================================================== -->
<div class="modal fade" id="submitDeliverableModal" tabindex="-1" aria-labelledby="submitDeliverableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="submitDeliverableModalLabel">
                    <i class="fas fa-upload me-2"></i>Submit Milestone Accomplishment Evidence
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deliverableForm" onsubmit="handleDeliverableSubmit(event)">
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="fas fa-info-circle me-1 text-maroon"></i> Upload verified research documentation, technical reports, data matrices, or publication acceptances to satisfy quarterly project milestones.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Research Project Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modalProjectCode" placeholder="e.g. PRJ-2026-001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Milestone Quarter / Stage</label>
                            <select class="form-select" id="modalMilestoneStage">
                                <option value="Milestone Q1: Design & Architecture">Milestone Q1: Design & Architecture</option>
                                <option value="Milestone Q2: Prototype Validation" selected>Milestone Q2: Prototype Validation</option>
                                <option value="Milestone Q3: Field Deployment & Trials">Milestone Q3: Field Deployment & Trials</option>
                                <option value="Milestone Q4: Terminal Report & Dissemination">Milestone Q4: Terminal Report & Dissemination</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Deliverable Title & Description <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modalDeliverableTitle" placeholder="e.g. Milestone 1.3 Field Testing Verification Matrix" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Accomplishment Evidence File (.pdf, .docx, .zip) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="modalDeliverableFile" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">PI Remarks & Accomplishment Notes</label>
                        <textarea class="form-control" id="modalDeliverableNotes" rows="3" placeholder="Describe key achievements, experimental findings, or compliance details..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Submit Deliverable for Verification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: AUDIT & EVIDENCE VERIFICATION DETAILS                                       -->
<!-- ==================================================================================== -->
<div class="modal fade" id="auditEvidenceModal" tabindex="-1" aria-labelledby="auditEvidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="auditModalTitle">
                    <i class="fas fa-file-check me-2"></i>Milestone Verification Audit
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-success text-white px-3 py-1 font-weight-bold fs-6">
                        <i class="fas fa-check-circle me-1"></i> Verified & Approved
                    </span>
                    <span class="badge bg-maroon text-white" id="auditModalCode">PRJ-2026-001</span>
                </div>

                <h6 class="font-weight-bold text-dark mb-1" id="auditModalMilestone">Milestone Title</h6>
                <small class="text-muted d-block mb-3">Verified by: <strong>University Research M&E Office</strong></small>

                <div class="p-3 bg-light rounded border mb-3">
                    <div class="small text-muted font-weight-bold text-uppercase mb-1">Attached Evidence File</div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-file-pdf text-danger fa-2x me-2"></i>
                            <strong class="text-dark small" id="auditModalFileName">Hardware_Selection_Report.pdf</strong>
                        </div>
                        <button class="btn btn-sm btn-outline-maroon" onclick="downloadEvidenceFile()">
                            <i class="fas fa-download me-1"></i> Download
                        </button>
                    </div>
                </div>

                <div class="small text-muted">
                    <i class="fas fa-shield-alt text-maroon me-1"></i> Verified against MarSU ERP Institutional Research Compliance Guidelines.
                </div>
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
<!-- INTERACTIVE JAVASCRIPT (NO JQUERY DEPENDENCY)                                        -->
<!-- ==================================================================================== -->
<script>
    let activeStatusFilter = 'all';

    function filterStatus(statusKey, element) {
        activeStatusFilter = statusKey;

        document.querySelectorAll('.ms-tab-pill').forEach(pill => {
            pill.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }

        filterMilestones();
    }

    function filterMilestones() {
        const query = (document.getElementById('mainSearchInput')?.value || '').toLowerCase().trim();
        const selectedProject = document.getElementById('projectFilter')?.value || 'all';

        const projectCards = document.querySelectorAll('.milestone-project-card');
        let totalVisibleRows = 0;

        projectCards.forEach(card => {
            const cardProject = card.getAttribute('data-project') || '';
            const matchesProject = (selectedProject === 'all') || (cardProject.toUpperCase() === selectedProject.toUpperCase());

            const rows = card.querySelectorAll('.milestone-row');
            let visibleRowsInCard = 0;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status') || '';
                const rowSearch = row.getAttribute('data-search') || '';

                const matchesQuery = !query || rowSearch.includes(query);
                const matchesStatus = (activeStatusFilter === 'all') || (rowStatus === activeStatusFilter);

                if (matchesQuery && matchesStatus && matchesProject) {
                    row.style.display = 'flex';
                    visibleRowsInCard++;
                    totalVisibleRows++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (visibleRowsInCard > 0 && matchesProject) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        const emptyNotice = document.getElementById('emptySearchNotice');
        if (emptyNotice) {
            if (totalVisibleRows === 0 && projectCards.length > 0) {
                emptyNotice.classList.remove('d-none');
            } else {
                emptyNotice.classList.add('d-none');
            }
        }
    }

    function openSubmitDeliverableModal(projectCode, milestoneTitle) {
        if (projectCode) {
            document.getElementById('modalProjectCode').value = projectCode;
        }
        if (milestoneTitle) {
            document.getElementById('modalDeliverableTitle').value = milestoneTitle;
        }

        const modalEl = document.getElementById('submitDeliverableModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function handleDeliverableSubmit(event) {
        event.preventDefault();
        const code = document.getElementById('modalProjectCode').value;
        const title = document.getElementById('modalDeliverableTitle').value;

        const modalEl = document.getElementById('submitDeliverableModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        showToast('Deliverable Submitted', `Milestone evidence for ${code} (${title}) uploaded and submitted for M&E review!`);
    }

    let currentEvidenceFile = 'Evidence_Document.pdf';
    function openAuditModal(projectCode, milestoneTitle, fileName) {
        document.getElementById('auditModalCode').textContent = projectCode;
        document.getElementById('auditModalMilestone').textContent = milestoneTitle;
        currentEvidenceFile = fileName || 'Evidence_Document.pdf';
        document.getElementById('auditModalFileName').textContent = currentEvidenceFile;

        const modalEl = document.getElementById('auditEvidenceModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function downloadEvidenceFile() {
        const text = `MARSU RESEARCH MONITORING & EVALUATION OFFICE\nVERIFIED EVIDENCE DOCUMENT\nFile: ${currentEvidenceFile}\nStatus: Approved & Verified\nTimestamp: ${new Date().toLocaleString()}\n`;
        const blob = new Blob([text], { type: 'text/plain;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', currentEvidenceFile);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Download Started', `Downloading ${currentEvidenceFile}...`);
    }

    function exportMilestoneReportCSV() {
        const rows = [["Project Code", "Milestone Deliverable", "Target Deadline / Verified Date", "Status"]];

        document.querySelectorAll('.milestone-row').forEach(row => {
            if (row.style.display !== 'none') {
                const titleEl = row.querySelector('h6');
                const titleText = titleEl ? titleEl.innerText.trim() : '';
                const smallEl = row.querySelector('small');
                const smallText = smallEl ? smallEl.innerText.trim() : '';
                const badgeEl = row.querySelector('.badge');
                const statusText = badgeEl ? badgeEl.innerText.trim() : '';

                rows.push([`"PRJ-MILESTONE"`, `"${titleText}"`, `"${smallText}"`, `"${statusText}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Milestones_Accomplishment_Report_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'Milestone progress report downloaded as CSV.');
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