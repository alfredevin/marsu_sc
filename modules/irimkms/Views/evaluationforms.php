<div class="container-fluid px-4 py-3" id="evaluationFormsRoot">

    <!-- CSS Safeguards & Custom Design System Tokens -->
    <style>
        #evaluationFormsRoot, #evaluationFormsRoot * {
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

        /* Filter Pills */
        .eval-tab-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 20px;
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.84rem;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 6px;
            cursor: pointer;
            border: 1px solid #d1d3e2;
            transition: all 0.2s ease;
        }
        .eval-tab-pill:hover {
            background-color: #eaecf4;
            color: var(--maroon-main);
        }
        .eval-tab-pill.active {
            background-color: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
        }

        /* Tool Cards Grid */
        .evaluation-tool-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.28s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }
        .evaluation-tool-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.85rem 1.6rem rgba(128, 0, 32, 0.14) !important;
            border-color: rgba(128, 0, 32, 0.35);
        }

        /* Criteria Badges */
        .criteria-badge {
            display: inline-block;
            background-color: #f1f3f9;
            color: #2e49a4;
            font-size: 0.76rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 14px;
            margin: 3px 2px;
            border: 1px solid #dbe1f4;
        }

        /* Score Gauge SVG Container */
        .score-gauge-box {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto;
        }

        /* Presets Buttons */
        .preset-btn {
            font-size: 0.78rem;
            padding: 4px 12px;
            border-radius: 16px;
            font-weight: 600;
        }

        /* Feedback Generator Chips */
        .feedback-chip {
            display: inline-block;
            background: #eef2ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
            font-size: 0.78rem;
            padding: 5px 12px;
            border-radius: 16px;
            margin: 3px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .feedback-chip:hover {
            background: #e0e7ff;
            transform: scale(1.02);
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
            <span class="hero-badge-tag"><i class="fas fa-clipboard-check me-1"></i> Interactive Assessment Hub</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-clipboard-list me-2 text-warning"></i>Evaluation Forms & Assessment Tools
            </h1>
            <p class="page-hero-subtitle">
                Standardized peer review rubrics, technical panel scorecards, interactive ethics clearance assessors, and live evaluation analytics workspace.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" onclick="switchMainTab('scorecard')">
                <i class="fas fa-calculator me-1"></i> Interactive Scorecard Workspace
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="switchMainTab('ethics')">
                <i class="fas fa-shield-alt me-1"></i> Ethics Risk Calculator
            </button>
            <button class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportEvaluationRubricsCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Rubrics Matrix
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
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill active"><i class="bi bi-clipboard-data text-white me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- KPI Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Assessment Toolkits</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['toolkits'] ?? 18) ?></div>
                            <div class="small text-muted mt-1"><i class="fas fa-shield-alt me-1 text-maroon"></i>100% Council Endorsed</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pending Peer Reviews</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['pending'] ?? count($proposals ?? [])) ?></div>
                            <div class="small text-warning font-weight-bold mt-1"><i class="fas fa-user-clock me-1"></i>Evaluator Assigned</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed Reviews</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['completed'] ?? count($evaluations ?? [])) ?></div>
                            <div class="small text-success font-weight-bold mt-1">
                                <i class="fas fa-star me-1"></i>Avg Score: <?= number_format($stats['avg_score'] ?? 87.4, 1) ?>/100
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ethics & IRB Tools</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['ethics_count'] ?? 6) ?></div>
                            <div class="small text-info font-weight-bold mt-1"><i class="fas fa-user-shield me-1"></i>IRB Compliance</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shield-alt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Navigation Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button type="button" class="main-nav-pill active" id="tabNavRubrics" onclick="switchMainTab('rubrics')">
            <i class="fas fa-th-list text-maroon"></i> Rubrics & Forms Library
        </button>
        <button type="button" class="main-nav-pill" id="tabNavScorecard" onclick="switchMainTab('scorecard')">
            <i class="fas fa-calculator text-warning"></i> Interactive Scorecard Workspace
        </button>
        <button type="button" class="main-nav-pill" id="tabNavEthics" onclick="switchMainTab('ethics')">
            <i class="fas fa-shield-alt text-info"></i> Ethics & IRB Compliance Assessor
        </button>
        <button type="button" class="main-nav-pill" id="tabNavHistory" onclick="switchMainTab('history')">
            <i class="fas fa-history text-success"></i> Completed Reviews Audit (<?= count($evaluations ?? []) ?>)
        </button>
    </div>

    <!-- ==================================================================================== -->
    <!-- TAB 1: RUBRICS & ASSESSMENT FORMS LIBRARY                                            -->
    <!-- ==================================================================================== -->
    <div id="viewSectionRubrics" class="main-tab-view">

        <!-- Filter & Search Toolbar -->
        <div class="card shadow-sm mb-4">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-2 mb-lg-0">
                        <div class="d-flex flex-wrap align-items-center">
                            <span class="small font-weight-bold text-muted me-2 mb-1"><i class="fas fa-filter me-1 text-maroon"></i>Category:</span>
                            <span class="eval-tab-pill active" onclick="filterCategory('all', this)">All Tools (18)</span>
                            <span class="eval-tab-pill" onclick="filterCategory('proposal', this)"><i class="fas fa-file-alt me-1"></i>Proposal Review (6)</span>
                            <span class="eval-tab-pill" onclick="filterCategory('implementation', this)"><i class="fas fa-tasks me-1"></i>Implementation M&E (4)</span>
                            <span class="eval-tab-pill" onclick="filterCategory('terminal', this)"><i class="fas fa-trophy me-1"></i>Terminal & IP (3)</span>
                            <span class="eval-tab-pill" onclick="filterCategory('ethics', this)"><i class="fas fa-shield-alt me-1"></i>Ethics & IRB (5)</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group input-group-sm">
                            <input type="text" id="mainSearchInput" class="form-control" placeholder="Search rubric code or keyword..." oninput="filterTools()">
                            <span class="input-group-text bg-maroon text-white"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tool Cards Grid -->
        <div id="toolsGridContainer" class="row mb-4">

            <!-- Tool 1 -->
            <div class="col-lg-6 mb-4 tool-card-item" data-category="proposal"
                 data-search="form-rev-2026-a1 proposal peer review scoring matrix feasibility originality methodology budget">
                <div class="card evaluation-tool-card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <span class="badge bg-maroon text-white font-weight-bold px-2 py-1 me-2">Form-REV-2026-A1</span>
                            <span class="badge bg-success text-white font-weight-bold px-2 py-1"><i class="fas fa-check-circle me-1"></i>ACTIVE STANDARD</span>
                        </div>
                        <span class="small text-muted font-weight-bold"><i class="fas fa-star me-1 text-warning"></i>Max 100 Pts</span>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="font-weight-bold text-dark mb-2">Proposal Peer Review Scoring Matrix & Feasibility Rubric</h5>
                        <p class="small text-muted mb-3">Standard rubric for evaluating new research grant proposals submitted for internal GAA or external institutional funding.</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="font-weight-bold text-dark small text-uppercase mb-0">Weighted Criteria Breakdown</h6>
                            <button type="button" class="btn btn-link btn-sm p-0 text-maroon text-decoration-none small"
                                    onclick="toggleCriteriaAccordion('criteria1')">
                                <i class="fas fa-chevron-down me-1"></i>Details
                            </button>
                        </div>
                        
                        <div class="mb-3">
                            <span class="criteria-badge">Methodology (30%)</span>
                            <span class="criteria-badge">Originality (25%)</span>
                            <span class="criteria-badge">Budget (20%)</span>
                            <span class="criteria-badge">Capability (25%)</span>
                        </div>

                        <!-- Collapsible Detailed Spec -->
                        <div id="criteria1" class="d-none bg-light p-2 rounded border mb-3 small">
                            <ul class="mb-0 ps-3 text-muted">
                                <li><strong>Methodology (30%):</strong> Soundness of experimental design, data collection tools, statistical model.</li>
                                <li><strong>Originality (25%):</strong> Novelty, contribution to discipline, potential for high-impact publishing.</li>
                                <li><strong>Budget (20%):</strong> Itemized PS, MOOE, and CO justification vs market rates.</li>
                                <li><strong>Capability (25%):</strong> PI track record, institutional readiness, realistic timeline.</li>
                            </ul>
                        </div>

                        <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-muted">Target: External Reviewers & Technical Panel</span>
                            <span class="badge bg-maroon text-white">Rev 4.2</span>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-3 border-top-0">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-maroon flex-fill me-1 font-weight-bold"
                                    onclick="launchEvaluatorWithForm('Form-REV-2026-A1', 'Proposal Peer Review Scoring Matrix')">
                                <i class="fas fa-pen-nib me-1"></i> Launch Scorecard
                            </button>
                            <button class="btn btn-sm btn-outline-secondary me-1"
                                    onclick="openRubricMatrixModal('Form-REV-2026-A1', 'Proposal Peer Review Scoring Matrix')">
                                <i class="fas fa-eye me-1"></i> Rubric
                            </button>
                            <button class="btn btn-sm btn-gold font-weight-bold"
                                    onclick="downloadToolPdf('Form-REV-2026-A1')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tool 2 -->
            <div class="col-lg-6 mb-4 tool-card-item" data-category="implementation"
                 data-search="form-mne-2026-b2 mid-term research implementation progress deliverables audit physical financial">
                <div class="card evaluation-tool-card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <span class="badge bg-maroon text-white font-weight-bold px-2 py-1 me-2">Form-MNE-2026-B2</span>
                            <span class="badge bg-success text-white font-weight-bold px-2 py-1"><i class="fas fa-check-circle me-1"></i>ACTIVE STANDARD</span>
                        </div>
                        <span class="small text-muted font-weight-bold"><i class="fas fa-tasks me-1 text-primary"></i>M&E Audit Score</span>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="font-weight-bold text-dark mb-2">Mid-Term Research Implementation & Deliverables Audit Sheet</h5>
                        <p class="small text-muted mb-3">Comprehensive M&E audit sheet assessing physical accomplishment vs target timeline, financial burn accuracy, and field activity evidence.</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="font-weight-bold text-dark small text-uppercase mb-0">Weighted Criteria Breakdown</h6>
                            <button type="button" class="btn btn-link btn-sm p-0 text-maroon text-decoration-none small"
                                    onclick="toggleCriteriaAccordion('criteria2')">
                                <i class="fas fa-chevron-down me-1"></i>Details
                            </button>
                        </div>

                        <div class="mb-3">
                            <span class="criteria-badge">Milestones (35%)</span>
                            <span class="criteria-badge">Financial Burn (25%)</span>
                            <span class="criteria-badge">Physical Output (20%)</span>
                            <span class="criteria-badge">Risk Control (20%)</span>
                        </div>

                        <div id="criteria2" class="d-none bg-light p-2 rounded border mb-3 small">
                            <ul class="mb-0 ps-3 text-muted">
                                <li><strong>Milestone Compliance (35%):</strong> Percentage of planned deliverables completed on schedule.</li>
                                <li><strong>Financial Liquidation (25%):</strong> Adherence to approved LIB and timely liquidation documentation.</li>
                                <li><strong>Physical Output (20%):</strong> Verification of field data, equipment purchases, or lab prototypes.</li>
                                <li><strong>Risk Mitigation (20%):</strong> Proactive handling of delays, bio-hazards, or supply shortages.</li>
                            </ul>
                        </div>

                        <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-muted">Target: M&E Audit Team & Research Directorate</span>
                            <span class="badge bg-info text-white">Rev 2.1</span>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-3 border-top-0">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-maroon flex-fill me-1 font-weight-bold"
                                    onclick="launchEvaluatorWithForm('Form-MNE-2026-B2', 'Mid-Term Research Implementation Audit Sheet')">
                                <i class="fas fa-pen-nib me-1"></i> Launch Scorecard
                            </button>
                            <button class="btn btn-sm btn-outline-secondary me-1"
                                    onclick="openRubricMatrixModal('Form-MNE-2026-B2', 'Mid-Term Research Implementation Audit Sheet')">
                                <i class="fas fa-eye me-1"></i> Rubric
                            </button>
                            <button class="btn btn-sm btn-gold font-weight-bold"
                                    onclick="downloadToolPdf('Form-MNE-2026-B2')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tool 3 -->
            <div class="col-lg-6 mb-4 tool-card-item" data-category="ethics"
                 data-search="form-eth-2026-c1 ethics biosafety clearance human subject consent privacy irb">
                <div class="card evaluation-tool-card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <span class="badge bg-maroon text-white font-weight-bold px-2 py-1 me-2">Form-ETH-2026-C1</span>
                            <span class="badge bg-gold text-dark font-weight-bold px-2 py-1"><i class="fas fa-shield-alt me-1"></i>MANDATORY ETHICS</span>
                        </div>
                        <span class="small text-muted font-weight-bold"><i class="fas fa-user-shield me-1 text-info"></i>IRB Approved</span>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="font-weight-bold text-dark mb-2">Human Subject & Biosafety Ethics Clearance Assessment</h5>
                        <p class="small text-muted mb-3">Mandatory compliance review form evaluating informed consent protocols, biohazard containment, and Data Privacy Act compliance.</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="font-weight-bold text-dark small text-uppercase mb-0">Mandatory Checkpoints</h6>
                            <button type="button" class="btn btn-link btn-sm p-0 text-maroon text-decoration-none small"
                                    onclick="toggleCriteriaAccordion('criteria3')">
                                <i class="fas fa-chevron-down me-1"></i>Details
                            </button>
                        </div>

                        <div class="mb-3">
                            <span class="criteria-badge">Informed Consent</span>
                            <span class="criteria-badge">Biohazard Risk</span>
                            <span class="criteria-badge">Data Privacy (RA 10173)</span>
                            <span class="criteria-badge">Animal Welfare</span>
                        </div>

                        <div id="criteria3" class="d-none bg-light p-2 rounded border mb-3 small">
                            <ul class="mb-0 ps-3 text-muted">
                                <li><strong>Informed Consent:</strong> Clear protocol for vulnerable participants and vernacular translation.</li>
                                <li><strong>Data Privacy Act (RA 10173):</strong> Anonymization of sensitive survey respondent data.</li>
                                <li><strong>Biohazard Safety:</strong> Disposal procedures for biological samples or hazardous waste.</li>
                                <li><strong>IACUC Clearance:</strong> Proper housing and humane handling protocols for animal research.</li>
                            </ul>
                        </div>

                        <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-muted">Target: Institutional Ethics Review Board (IERB)</span>
                            <span class="badge bg-warning text-dark font-weight-bold">Rev 5.0</span>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-3 border-top-0">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-maroon flex-fill me-1 font-weight-bold"
                                    onclick="switchMainTab('ethics')">
                                <i class="fas fa-shield-alt me-1"></i> Assess Ethics Risk
                            </button>
                            <button class="btn btn-sm btn-outline-secondary me-1"
                                    onclick="openRubricMatrixModal('Form-ETH-2026-C1', 'Ethics & Biosafety Assessment Checklist')">
                                <i class="fas fa-eye me-1"></i> Rubric
                            </button>
                            <button class="btn btn-sm btn-gold font-weight-bold"
                                    onclick="downloadToolPdf('Form-ETH-2026-C1')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tool 4 -->
            <div class="col-lg-6 mb-4 tool-card-item" data-category="terminal"
                 data-search="form-trm-2026-d4 terminal accomplishment intellectual property patent publication commercialization">
                <div class="card evaluation-tool-card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <span class="badge bg-maroon text-white font-weight-bold px-2 py-1 me-2">Form-TRM-2026-D4</span>
                            <span class="badge bg-success text-white font-weight-bold px-2 py-1"><i class="fas fa-check-circle me-1"></i>ACTIVE STANDARD</span>
                        </div>
                        <span class="small text-muted font-weight-bold"><i class="fas fa-trophy me-1 text-success"></i>Final Evaluation</span>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="font-weight-bold text-dark mb-2">Terminal Accomplishment & Intellectual Property Assessment Tool</h5>
                        <p class="small text-muted mb-3">Final project evaluation toolkit scoring target output realization, publication quality, patent applicability, and financial liquidation.</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="font-weight-bold text-dark small text-uppercase mb-0">Weighted Criteria Breakdown</h6>
                            <button type="button" class="btn btn-link btn-sm p-0 text-maroon text-decoration-none small"
                                    onclick="toggleCriteriaAccordion('criteria4')">
                                <i class="fas fa-chevron-down me-1"></i>Details
                            </button>
                        </div>

                        <div class="mb-3">
                            <span class="criteria-badge">Output Realization (40%)</span>
                            <span class="criteria-badge">Patent/IP Potential (30%)</span>
                            <span class="criteria-badge">Commercial Viability (20%)</span>
                            <span class="criteria-badge">Liquidation (10%)</span>
                        </div>

                        <div id="criteria4" class="d-none bg-light p-2 rounded border mb-3 small">
                            <ul class="mb-0 ps-3 text-muted">
                                <li><strong>Output Realization (40%):</strong> Actual deliverable vs original research proposal commitments.</li>
                                <li><strong>Patent & IP Potential (30%):</strong> Copyrightable software, utility models, or patent filings.</li>
                                <li><strong>Scopus/CHED Publication (20%):</strong> Submission to high-impact peer-reviewed journals.</li>
                                <li><strong>Financial Liquidation (10%):</strong> 100% completed university accounting clearance.</li>
                            </ul>
                        </div>

                        <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-muted">Target: University Research Council & IP TTO</span>
                            <span class="badge bg-success text-white">Rev 3.0</span>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-3 border-top-0">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-maroon flex-fill me-1 font-weight-bold"
                                    onclick="launchEvaluatorWithForm('Form-TRM-2026-D4', 'Terminal Accomplishment & IP Tool')">
                                <i class="fas fa-pen-nib me-1"></i> Launch Scorecard
                            </button>
                            <button class="btn btn-sm btn-outline-secondary me-1"
                                    onclick="openRubricMatrixModal('Form-TRM-2026-D4', 'Terminal Accomplishment Tool Rubric')">
                                <i class="fas fa-eye me-1"></i> Rubric
                            </button>
                            <button class="btn btn-sm btn-gold font-weight-bold"
                                    onclick="downloadToolPdf('Form-TRM-2026-D4')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pending Peer Reviews Queue Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 bg-maroon text-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-clock me-2"></i>Pending Peer Reviews Queue (Evaluator Workspace)</h6>
                <span class="badge bg-gold text-dark font-weight-bold px-3 py-1"><?= count($proposals ?? []) ?> Proposals Assigned</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="pendingReviewsTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Proposal / Project Code</th>
                                <th>Research Title</th>
                                <th>Lead PI</th>
                                <th>Assigned Rubric</th>
                                <th>Review Deadline</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proposals)): ?>
                                <?php foreach ($proposals as $pr): ?>
                                    <tr>
                                        <td><span class="badge bg-maroon text-white"><?= e($pr['code']) ?></span></td>
                                        <td>
                                            <strong class="text-dark d-block"><?= e($pr['title']) ?></strong>
                                            <small class="text-muted"><?= e($pr['college'] ?? 'N/A') ?> • <?= e($pr['agenda_thrust'] ?? 'General Thrust') ?></small>
                                        </td>
                                        <td><?= e($pr['pi_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border">Form-REV-2026-A1</span></td>
                                        <td class="text-danger font-weight-bold">Nov 15, 2026</td>
                                        <td><span class="badge bg-warning text-dark font-weight-bold">Pending Review</span></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-maroon font-weight-bold"
                                                    onclick="launchEvaluatorWithProposal('<?= e($pr['code']) ?>', '<?= e(addslashes($pr['title'])) ?>', '<?= e(addslashes($pr['pi_name'])) ?>')">
                                                <i class="fas fa-pen-nib me-1"></i> Evaluate
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><span class="badge bg-maroon text-white">PROP-2026-089</span></td>
                                    <td>AI-Based Smart Irrigation & Soil Salinity Monitoring</td>
                                    <td>Dr. Samuel Tan</td>
                                    <td><span class="badge bg-light text-dark border">Form-REV-2026-A1</span></td>
                                    <td class="text-danger font-weight-bold">Oct 30, 2026</td>
                                    <td><span class="badge bg-warning text-dark font-weight-bold">Pending Review</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-maroon font-weight-bold"
                                                onclick="launchEvaluatorWithProposal('PROP-2026-089', 'AI-Based Smart Irrigation', 'Dr. Samuel Tan')">
                                            <i class="fas fa-pen-nib me-1"></i> Evaluate
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
    <!-- /#viewSectionRubrics -->


    <!-- ==================================================================================== -->
    <!-- TAB 2: INTERACTIVE SCORECARD WORKSPACE & CALCULATOR                                   -->
    <!-- ==================================================================================== -->
    <div id="viewSectionScorecard" class="main-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-maroon">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-maroon">
                    <i class="fas fa-calculator me-2"></i>Interactive Evaluator Workspace & Score Calculator
                </h5>
                <div>
                    <span class="badge bg-light text-dark border me-2"><i class="fas fa-user-check me-1 text-success"></i>Logged Evaluator: <?= e($user['name'] ?? 'Faculty Evaluator') ?></span>
                    <button class="btn btn-outline-secondary btn-sm" onclick="resetScorecardWorkspace()"><i class="fas fa-undo me-1"></i>Reset Workspace</button>
                </div>
            </div>
            <div class="card-body p-4">

                <form action="<?= url('irimkms/evaluations/store') ?>" method="POST" id="mainScorecardForm" onsubmit="return validateScorecardForm()">
                    <?= csrf_field() ?>
                    <input type="hidden" name="rubric_code" id="formInputRubricCode" value="Form-REV-2026-A1">
                    <input type="hidden" name="rubric_title" id="formInputRubricTitle" value="Proposal Peer Review Scoring Matrix">
                    <input type="hidden" name="evaluator_name" value="<?= e($user['name'] ?? 'Faculty Evaluator') ?>">
                    <input type="hidden" name="recommendation" id="formInputRecommendation" value="Recommended for Approval">

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Select Evaluation Rubric</label>
                            <select class="form-select" id="scorecardRubricSelect" onchange="updateRubricPreset(this.value)">
                                <option value="Form-REV-2026-A1" selected>Form-REV-2026-A1 (Proposal Peer Review)</option>
                                <option value="Form-MNE-2026-B2">Form-MNE-2026-B2 (Mid-Term Audit Sheet)</option>
                                <option value="Form-ETH-2026-C1">Form-ETH-2026-C1 (Ethics & Biosafety Review)</option>
                                <option value="Form-TRM-2026-D4">Form-TRM-2026-D4 (Terminal IP & Output Tool)</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label font-weight-bold text-dark">Target Proposal or Research Project <span class="text-danger">*</span></label>
                            <select class="form-select" id="scorecardTargetSelect" onchange="autoFillTargetInfo(this)">
                                <option value="">-- Choose Assigned Proposal / Project --</option>
                                <?php if (!empty($proposals)): ?>
                                    <?php foreach ($proposals as $pr): ?>
                                        <option value="<?= e($pr['code']) ?>" data-title="<?= e($pr['title']) ?>" data-pi="<?= e($pr['pi_name']) ?>">
                                            [PROPOSAL] <?= e($pr['code']) ?> - <?= e(mb_strimwidth($pr['title'], 0, 45, '...')) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (!empty($projects)): ?>
                                    <?php foreach ($projects as $pj): ?>
                                        <option value="<?= e($pj['project_code']) ?>" data-title="<?= e($pj['title']) ?>" data-pi="<?= e($pj['lead_pi']) ?>">
                                            [PROJECT] <?= e($pj['project_code']) ?> - <?= e(mb_strimwidth($pj['title'], 0, 45, '...')) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold text-dark">Target Code (Manual Input)</label>
                            <input type="text" class="form-control" name="target_code" id="scorecardTargetCode" placeholder="e.g. PROP-2026-001" required>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="target_title" id="scorecardTargetTitle" value="">
                            <div class="p-2 bg-light rounded border d-flex justify-content-between align-items-center" id="targetInfoBox">
                                <small class="text-muted"><i class="fas fa-info-circle me-1 text-maroon"></i>Target Details: Select a proposal above or type a code.</small>
                                <span class="badge bg-maroon text-white" id="targetPILabel">Unspecified PI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Preset Buttons -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="small font-weight-bold text-muted me-1"><i class="fas fa-magic text-warning me-1"></i>Score Presets:</span>
                        <button type="button" class="btn btn-outline-success preset-btn" onclick="applyScorePreset(94, 92, 88, 90)">
                            <i class="fas fa-star me-1"></i>High Honor (91 Pts)
                        </button>
                        <button type="button" class="btn btn-outline-primary preset-btn" onclick="applyScorePreset(82, 85, 80, 84)">
                            <i class="fas fa-check me-1"></i>Standard Approval (83 Pts)
                        </button>
                        <button type="button" class="btn btn-outline-warning preset-btn text-dark" onclick="applyScorePreset(74, 72, 70, 75)">
                            <i class="fas fa-exclamation me-1"></i>Conditional (73 Pts)
                        </button>
                        <button type="button" class="btn btn-outline-danger preset-btn" onclick="applyScorePreset(58, 62, 55, 60)">
                            <i class="fas fa-times me-1"></i>Needs Major Revision (59 Pts)
                        </button>
                    </div>

                    <div class="row g-4">

                        <!-- Left Column: Interactive Sliders -->
                        <div class="col-lg-7">
                            <div class="p-3 bg-light rounded border">
                                <h6 class="font-weight-bold text-maroon mb-3"><i class="fas fa-sliders-h me-2"></i>Scoring Criteria Sliders</h6>

                                <!-- Criteria 1 -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label font-weight-bold text-dark mb-0" id="critLabel1">1. Technical Methodology & Rigor (Weight: 30%)</label>
                                        <span class="badge bg-maroon text-white font-weight-bold fs-6" id="critDisplayVal1">85 / 100</span>
                                    </div>
                                    <input type="range" class="form-range" name="score_methodology" id="critSlider1" min="0" max="100" value="85" oninput="recomputeScorecard()">
                                    <small class="text-muted d-block" id="critDesc1">Evaluates soundness of research design, sample sizing, data collection, and analytical rigor.</small>
                                </div>

                                <!-- Criteria 2 -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label font-weight-bold text-dark mb-0" id="critLabel2">2. Originality & Innovation (Weight: 25%)</label>
                                        <span class="badge bg-maroon text-white font-weight-bold fs-6" id="critDisplayVal2">90 / 100</span>
                                    </div>
                                    <input type="range" class="form-range" name="score_originality" id="critSlider2" min="0" max="100" value="90" oninput="recomputeScorecard()">
                                    <small class="text-muted d-block" id="critDesc2">Evaluates novelty, discipline contribution, and potential for high-impact publication/patent.</small>
                                </div>

                                <!-- Criteria 3 -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label font-weight-bold text-dark mb-0" id="critLabel3">3. Budget Justification & LIB (Weight: 20%)</label>
                                        <span class="badge bg-maroon text-white font-weight-bold fs-6" id="critDisplayVal3">80 / 100</span>
                                    </div>
                                    <input type="range" class="form-range" name="score_budget" id="critSlider3" min="0" max="100" value="80" oninput="recomputeScorecard()">
                                    <small class="text-muted d-block" id="critDesc3">Evaluates line item budget efficiency, PS/MOOE/CO breakdown, and market price alignment.</small>
                                </div>

                                <!-- Criteria 4 -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label font-weight-bold text-dark mb-0" id="critLabel4">4. Researcher Capability & Feasibility (Weight: 25%)</label>
                                        <span class="badge bg-maroon text-white font-weight-bold fs-6" id="critDisplayVal4">88 / 100</span>
                                    </div>
                                    <input type="range" class="form-range" name="score_capability" id="critSlider4" min="0" max="100" value="88" oninput="recomputeScorecard()">
                                    <small class="text-muted d-block" id="critDesc4">Evaluates principal investigator qualifications, lab facilities, and proposed timeline feasibility.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Visual SVG Score Meter & Recommendation Badge -->
                        <div class="col-lg-5">
                            <div class="p-4 bg-white rounded border border-maroon text-center h-100 d-flex flex-direction-column justify-content-between">
                                <div>
                                    <small class="text-uppercase font-weight-bold text-muted d-block mb-2">Overall Weighted Scorecard Grade</small>

                                    <!-- Interactive SVG Radial Gauge -->
                                    <div class="score-gauge-box mb-3">
                                        <svg width="140" height="140" viewBox="0 0 140 140">
                                            <circle cx="70" cy="70" r="58" stroke="#e9ecef" stroke-width="12" fill="none" />
                                            <circle id="scoreGaugeArc" cx="70" cy="70" r="58" stroke="#800020" stroke-width="12" fill="none"
                                                    stroke-dasharray="364.4" stroke-dashoffset="50" stroke-linecap="round"
                                                    transform="rotate(-90 70 70)" style="transition: stroke-dashoffset 0.35s ease, stroke 0.35s ease;" />
                                        </svg>
                                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                            <span class="h2 font-weight-bold text-dark mb-0" id="liveScoreNum">86.1</span>
                                            <small class="text-muted font-weight-bold" style="font-size: 0.7rem;">OUT OF 100</small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <span class="badge bg-success px-3 py-2 fs-6 font-weight-bold text-uppercase" id="liveRecommendationBadge">
                                            RECOMMENDED FOR APPROVAL
                                        </span>
                                    </div>

                                    <div class="p-2 bg-light rounded text-start small mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-muted">Approval Cutoff:</span>
                                            <strong class="text-success">&ge; 85.0 Pts</strong>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-muted">Revision Threshold:</span>
                                            <strong class="text-warning">70.0 - 84.9 Pts</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Disapproval Threshold:</span>
                                            <strong class="text-danger">&lt; 70.0 Pts</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Feedback Generator Chips -->
                                <div class="text-start">
                                    <label class="form-label font-weight-bold text-dark small mb-1">Feedback Snippet Assistant:</label>
                                    <div>
                                        <span class="feedback-chip" onclick="appendFeedbackSnippet('Research methodology is sound and technically robust.')">+ Rigorous Methodology</span>
                                        <span class="feedback-chip" onclick="appendFeedbackSnippet('Line Item Budget (LIB) requires additional breakdown for MOOE.')">+ Detailed MOOE Needed</span>
                                        <span class="feedback-chip" onclick="appendFeedbackSnippet('Clear SDG alignment and direct community impact.')">+ High SDG Alignment</span>
                                        <span class="feedback-chip" onclick="appendFeedbackSnippet('Recommend IRB ethics clearance before field sampling.')">+ Request Ethics Pre-clearance</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Qualitative Notes -->
                    <div class="mt-4">
                        <label class="form-label font-weight-bold text-dark">Technical Reviewer Feedback & Evaluation Remarks <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="feedback" id="scorecardFeedbackNotes" rows="3"
                                  placeholder="Type detailed qualitative evaluation remarks, recommended modifications, or required ethical conditions..." required>The proposed research demonstrates high technical feasibility and well-defined objectives. Recommended for approval subject to standard institutional monitoring.</textarea>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="switchMainTab('rubrics')">Cancel</button>
                        <button type="submit" class="btn btn-maroon px-4 font-weight-bold shadow-sm">
                            <i class="fas fa-check-circle me-1"></i> Submit Scorecard to Database
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- /#viewSectionScorecard -->


    <!-- ==================================================================================== -->
    <!-- TAB 3: ETHICS & IRB COMPLIANCE ASSESSOR                                              -->
    <!-- ==================================================================================== -->
    <div id="viewSectionEthics" class="main-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-info">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-shield-alt me-2"></i>Institutional Ethics Review Board (IRB) Compliance Assessor
                </h5>
                <button class="btn btn-info btn-sm text-white font-weight-bold" onclick="openEthicsCertModal()">
                    <i class="fas fa-certificate me-1"></i> Preview IRB Certificate Template
                </button>
            </div>
            <div class="card-body p-4">
                <p class="text-muted small mb-4">
                    Mandatory statutory screening tool for research involving human participants, vulnerable groups, biological specimens, or animal subjects under RA 10173 (Data Privacy Act of 2012) and university IRB protocols.
                </p>

                <div class="row g-4">

                    <!-- Interactive Ethics Checklist -->
                    <div class="col-lg-8">
                        <div class="p-3 bg-light rounded border mb-3">
                            <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-tasks me-2 text-info"></i>IRB Ethics Checkpoints</h6>

                            <div class="form-check p-3 bg-white rounded border mb-2">
                                <input class="form-check-input" type="checkbox" id="ethCheck1" onchange="recomputeEthicsRisk()" checked>
                                <label class="form-check-label font-weight-bold text-dark" for="ethCheck1">
                                    1. Informed Consent Protocol & Vernacular Translation
                                </label>
                                <small class="text-muted d-block">Written consent form provided in Tagalog or local dialect for human survey respondents.</small>
                            </div>

                            <div class="form-check p-3 bg-white rounded border mb-2">
                                <input class="form-check-input" type="checkbox" id="ethCheck2" onchange="recomputeEthicsRisk()" checked>
                                <label class="form-check-label font-weight-bold text-dark" for="ethCheck2">
                                    2. Data Privacy Act (RA 10173) Anonymization Guarantee
                                </label>
                                <small class="text-muted d-block">Personal identifiable information (PII) is encrypted or stripped prior to public repository archiving.</small>
                            </div>

                            <div class="form-check p-3 bg-white rounded border mb-2">
                                <input class="form-check-input" type="checkbox" id="ethCheck3" onchange="recomputeEthicsRisk()">
                                <label class="form-check-label font-weight-bold text-dark" for="ethCheck3">
                                    3. Vulnerable Subjects Safeguard (Minors, Indigenous Communities)
                                </label>
                                <small class="text-muted d-block">Requires parental consent or tribal council endorsement if research involves vulnerable demographics.</small>
                            </div>

                            <div class="form-check p-3 bg-white rounded border mb-2">
                                <input class="form-check-input" type="checkbox" id="ethCheck4" onchange="recomputeEthicsRisk()">
                                <label class="form-check-label font-weight-bold text-dark" for="ethCheck4">
                                    4. Biohazard & Recombinant DNA Safety Protocols
                                </label>
                                <small class="text-muted d-block">Assessment of biological agent handling, biosafety level 2 laboratory containment, and waste management.</small>
                            </div>

                            <div class="form-check p-3 bg-white rounded border mb-2">
                                <input class="form-check-input" type="checkbox" id="ethCheck5" onchange="recomputeEthicsRisk()">
                                <label class="form-check-label font-weight-bold text-dark" for="ethCheck5">
                                    5. Animal Subject Ethical Handling (IACUC Clearance)
                                </label>
                                <small class="text-muted d-block">Compliance with humane animal handling standards and university IACUC oversight.</small>
                            </div>

                            <div class="form-check p-3 bg-white rounded border">
                                <input class="form-check-input" type="checkbox" id="ethCheck6" onchange="recomputeEthicsRisk()" checked>
                                <label class="form-check-label font-weight-bold text-dark" for="ethCheck6">
                                    6. Financial Conflict of Interest (COI) Declaration
                                </label>
                                <small class="text-muted d-block">No financial or personal conflict of interest declared by the Principal Investigator.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Calculated Ethics Risk Meter -->
                    <div class="col-lg-4">
                        <div class="p-4 bg-white rounded border border-info text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <small class="text-uppercase font-weight-bold text-muted d-block mb-2">Ethics Compliance Risk Gauge</small>
                                
                                <div class="my-4">
                                    <div class="h1 font-weight-bold text-success mb-1" id="ethicsRiskLevelText">LOW RISK</div>
                                    <span class="badge bg-success text-white px-3 py-2" id="ethicsRiskCategoryBadge">Category A: Exempt / Expedited Review</span>
                                </div>

                                <div class="p-3 bg-light rounded text-start small mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Checked Points:</span>
                                        <strong id="ethicsCheckedCount">3 / 6 Checked</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Risk Category:</span>
                                        <strong id="ethicsLevelCode">Category A (Exempt)</strong>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">IRB Review Track:</span>
                                        <strong id="ethicsTrackText">Expedited Clearance</strong>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="button" class="btn btn-info w-100 text-white font-weight-bold shadow-sm"
                                        onclick="showToast('Ethics Assessment Saved', 'IRB compliance risk score logged for proposal review.')">
                                    <i class="fas fa-save me-1"></i> Log Ethics Assessment
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /#viewSectionEthics -->


    <!-- ==================================================================================== -->
    <!-- TAB 4: COMPLETED REVIEWS AUDIT TRAIL                                                  -->
    <!-- ==================================================================================== -->
    <div id="viewSectionHistory" class="main-tab-view d-none">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-maroon text-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-history me-2"></i>Completed Review Scorecards Audit Trail</h6>
                <div>
                    <button class="btn btn-gold btn-sm font-weight-bold" onclick="exportCompletedEvaluationsCSV()">
                        <i class="fas fa-download me-1"></i> Export Scorecards Log (CSV)
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="completedEvaluationsTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Rubric Code</th>
                                <th>Target Code & Title</th>
                                <th>Evaluator</th>
                                <th class="text-center">Methodology</th>
                                <th class="text-center">Originality</th>
                                <th class="text-center">Budget</th>
                                <th class="text-center">Overall Score</th>
                                <th>Recommendation</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($evaluations)): ?>
                                <?php foreach ($evaluations as $ev): ?>
                                    <?php 
                                        $sc = (float)($ev['total_score'] ?? 0);
                                        $badgeClass = $sc >= 85 ? 'bg-success text-white' : ($sc >= 70 ? 'bg-warning text-dark' : 'bg-danger text-white');
                                    ?>
                                    <tr>
                                        <td><span class="badge bg-maroon text-white"><?= e($ev['rubric_code']) ?></span></td>
                                        <td>
                                            <strong class="text-dark d-block"><?= e($ev['target_code']) ?></strong>
                                            <small class="text-muted"><?= e(mb_strimwidth($ev['target_title'] ?? 'Research Proposal', 0, 40, '...')) ?></small>
                                        </td>
                                        <td><?= e($ev['evaluator_name'] ?? 'Faculty Reviewer') ?></td>
                                        <td class="text-center"><?= number_format((float)($ev['score_methodology'] ?? 0), 0) ?></td>
                                        <td class="text-center"><?= number_format((float)($ev['score_originality'] ?? 0), 0) ?></td>
                                        <td class="text-center"><?= number_format((float)($ev['score_budget'] ?? 0), 0) ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $badgeClass ?> font-weight-bold fs-6 px-2 py-1">
                                                <?= number_format($sc, 1) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="font-weight-bold"><?= e($ev['recommendation'] ?? 'Pending') ?></small>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary"
                                                    onclick="viewEvaluationDetailModal('<?= e($ev['rubric_code']) ?>', '<?= e($ev['target_code']) ?>', '<?= e(addslashes($ev['evaluator_name'] ?? 'Evaluator')) ?>', '<?= number_format($sc, 1) ?>', '<?= e(addslashes($ev['recommendation'] ?? '')) ?>', '<?= e(addslashes($ev['feedback'] ?? 'No feedback specified')) ?>')">
                                                <i class="fas fa-eye me-1"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block text-gray-400"></i>
                                        No completed evaluation scorecards found. Launch the evaluator to submit your first scorecard!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#viewSectionHistory -->

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: INTERACTIVE EVALUATOR MODAL                                                 -->
<!-- ==================================================================================== -->
<div class="modal fade" id="interactiveEvaluatorModal" tabindex="-1" aria-labelledby="interactiveEvaluatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="evaluatorModalTitle">
                    <i class="fas fa-pen-nib me-2"></i>Peer Review Evaluation Workspace
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-light border-left-maroon small mb-3">
                    <i class="fas fa-info-circle me-1 text-maroon"></i> Directing to full interactive scorecard calculator with real-time score meter...
                </div>
                <p class="text-dark">Click launch below to load this proposal into the Scorecard Workspace.</p>
                <div class="p-3 bg-light rounded border">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Target Code:</span>
                        <strong id="modalTargetCodeText">PROP-2026-001</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Rubric Tool:</span>
                        <strong id="modalFormCodeText">Form-REV-2026-A1</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm font-weight-bold" onclick="confirmModalLaunchScorecard()">
                    <i class="fas fa-arrow-right me-1"></i> Open in Scorecard Workspace
                </button>
            </div>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: RUBRIC SPECIFICATIONS VIEWER                                                -->
<!-- ==================================================================================== -->
<div class="modal fade" id="rubricMatrixModal" tabindex="-1" aria-labelledby="rubricMatrixModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="matrixModalCode">Form Rubric Specifications</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <h5 class="font-weight-bold text-dark mb-3" id="matrixModalTitle">Rubric Title</h5>
                <p class="text-muted small mb-3">Standard university evaluation criteria adopted by the Research Council for institutional quality assurance.</p>

                <div class="list-group mb-3" id="matrixCriteriaList">
                    <!-- Dynamic criteria items -->
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 3: EVALUATION DETAIL VIEWER                                                   -->
<!-- ==================================================================================== -->
<div class="modal fade" id="evaluationDetailModal" tabindex="-1" aria-labelledby="evaluationDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-file-alt me-2"></i>Completed Scorecard Report</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="badge bg-maroon text-white me-2" id="detailModalRubricCode">Form-REV-2026-A1</span>
                        <span class="badge bg-secondary text-white" id="detailModalTargetCode">PROP-2026-001</span>
                    </div>
                    <div class="h4 font-weight-bold text-maroon mb-0" id="detailModalScore">88.0 / 100</div>
                </div>

                <div class="p-3 bg-light rounded border mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Evaluator:</span>
                        <strong id="detailModalEvaluator">Dr. Reviewer</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Recommendation:</span>
                        <strong class="text-success" id="detailModalRec">Recommended for Approval</strong>
                    </div>
                </div>

                <h6 class="font-weight-bold text-dark small text-uppercase">Technical Evaluator Remarks</h6>
                <div class="p-3 bg-white border rounded text-dark small" id="detailModalFeedback">
                    Feedback remarks...
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 4: IRB ETHICS CERTIFICATE PREVIEW                                              -->
<!-- ==================================================================================== -->
<div class="modal fade" id="ethicsCertModal" tabindex="-1" aria-labelledby="ethicsCertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-certificate me-2"></i>Institutional Ethics Review Board Certificate</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="p-4 border border-2 border-info rounded bg-white">
                    <h5 class="text-maroon font-weight-bold mb-1">MARINDUQUE STATE UNIVERSITY</h5>
                    <small class="text-muted font-weight-bold text-uppercase d-block mb-3">Institutional Ethics Review Board (IERB)</small>

                    <h4 class="font-weight-bold text-dark mb-3">CERTIFICATE OF ETHICS CLEARANCE</h4>
                    <p class="small text-muted mb-3">This certifies that the research protocol specified below has undergone institutional ethics evaluation and is granted clearance under Risk Category A / Expedited Review.</p>

                    <div class="p-2 bg-light rounded text-start small mb-3">
                        <div><strong>Protocol Clearance Code:</strong> IRB-2026-ETH-0941</div>
                        <div><strong>Date Issued:</strong> <?= date('F d, Y') ?></div>
                        <div><strong>Data Privacy Act (RA 10173):</strong> Compliant</div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-around small text-muted">
                        <div>
                            ________________________<br>
                            <strong>IERB Chair</strong>
                        </div>
                        <div>
                            ________________________<br>
                            <strong>Director, Research & Dev</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info btn-sm text-white font-weight-bold" onclick="showToast('Certificate Exported', 'IRB Certificate template ready for printing.')">
                    <i class="fas fa-print me-1"></i> Print Certificate
                </button>
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
    let activeCategoryFilter = 'all';

    function switchMainTab(tabKey) {
        document.querySelectorAll('.main-tab-view').forEach(view => {
            view.classList.add('d-none');
        });
        document.querySelectorAll('.main-nav-pill').forEach(pill => {
            pill.classList.remove('active');
        });

        if (tabKey === 'rubrics') {
            document.getElementById('viewSectionRubrics')?.classList.remove('d-none');
            document.getElementById('tabNavRubrics')?.classList.add('active');
        } else if (tabKey === 'scorecard') {
            document.getElementById('viewSectionScorecard')?.classList.remove('d-none');
            document.getElementById('tabNavScorecard')?.classList.add('active');
        } else if (tabKey === 'ethics') {
            document.getElementById('viewSectionEthics')?.classList.remove('d-none');
            document.getElementById('tabNavEthics')?.classList.add('active');
        } else if (tabKey === 'history') {
            document.getElementById('viewSectionHistory')?.classList.remove('d-none');
            document.getElementById('tabNavHistory')?.classList.add('active');
        }
    }

    function filterCategory(categoryKey, element) {
        activeCategoryFilter = categoryKey;
        document.querySelectorAll('.eval-tab-pill').forEach(pill => {
            pill.classList.remove('active');
        });
        if (element) element.classList.add('active');
        filterTools();
    }

    function filterTools() {
        const query = (document.getElementById('mainSearchInput')?.value || '').toLowerCase().trim();
        const toolItems = document.querySelectorAll('#toolsGridContainer .tool-card-item');

        toolItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category') || '';
            const itemSearch = item.getAttribute('data-search') || '';

            const matchesQuery = !query || itemSearch.includes(query);
            const matchesCategory = (activeCategoryFilter === 'all') || (itemCategory.toLowerCase() === activeCategoryFilter.toLowerCase());

            item.style.display = (matchesQuery && matchesCategory) ? 'block' : 'none';
        });
    }

    function toggleCriteriaAccordion(targetId) {
        const accordionEl = document.getElementById(targetId);
        if (accordionEl) {
            accordionEl.classList.toggle('d-none');
        }
    }

    function launchEvaluatorWithForm(formCode, formTitle) {
        document.getElementById('formInputRubricCode').value = formCode;
        document.getElementById('formInputRubricTitle').value = formTitle;
        document.getElementById('scorecardRubricSelect').value = formCode;
        switchMainTab('scorecard');
        showToast('Rubric Selected', `${formCode} loaded into scorecard calculator.`);
    }

    function launchEvaluatorWithProposal(code, title, pi) {
        document.getElementById('scorecardTargetCode').value = code;
        document.getElementById('scorecardTargetTitle').value = title;
        document.getElementById('targetPILabel').textContent = `PI: ${pi}`;

        const modalTarget = document.getElementById('modalTargetCodeText');
        if (modalTarget) modalTarget.textContent = `${code} (${pi})`;

        const modalEl = document.getElementById('interactiveEvaluatorModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function confirmModalLaunchScorecard() {
        const modalEl = document.getElementById('interactiveEvaluatorModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();
        switchMainTab('scorecard');
    }

    function autoFillTargetInfo(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        if (selectedOption && selectedOption.value) {
            const code = selectedOption.value;
            const title = selectedOption.getAttribute('data-title') || '';
            const pi = selectedOption.getAttribute('data-pi') || 'Unspecified PI';

            document.getElementById('scorecardTargetCode').value = code;
            document.getElementById('scorecardTargetTitle').value = title;
            document.getElementById('targetPILabel').textContent = `PI: ${pi}`;
        }
    }

    function applyScorePreset(s1, s2, s3, s4) {
        document.getElementById('critSlider1').value = s1;
        document.getElementById('critSlider2').value = s2;
        document.getElementById('critSlider3').value = s3;
        document.getElementById('critSlider4').value = s4;
        recomputeScorecard();
    }

    function recomputeScorecard() {
        const s1 = parseFloat(document.getElementById('critSlider1').value) || 0;
        const s2 = parseFloat(document.getElementById('critSlider2').value) || 0;
        const s3 = parseFloat(document.getElementById('critSlider3').value) || 0;
        const s4 = parseFloat(document.getElementById('critSlider4').value) || 0;

        document.getElementById('critDisplayVal1').textContent = `${s1} / 100`;
        document.getElementById('critDisplayVal2').textContent = `${s2} / 100`;
        document.getElementById('critDisplayVal3').textContent = `${s3} / 100`;
        document.getElementById('critDisplayVal4').textContent = `${s4} / 100`;

        // Weighted computation: 30%, 25%, 20%, 25%
        const weighted = (s1 * 0.30) + (s2 * 0.25) + (s3 * 0.20) + (s4 * 0.25);
        document.getElementById('liveScoreNum').textContent = weighted.toFixed(1);

        // Update SVG Radial Arc
        // Circumference for r=58 is ~364.4. Dashoffset = 364.4 * (1 - weighted/100)
        const circumference = 364.4;
        const dashOffset = circumference * (1 - (weighted / 100));
        const gaugeArc = document.getElementById('scoreGaugeArc');
        
        if (gaugeArc) {
            gaugeArc.style.strokeDashoffset = dashOffset;
            if (weighted >= 85) {
                gaugeArc.style.stroke = '#198754';
            } else if (weighted >= 70) {
                gaugeArc.style.stroke = '#ffc107';
            } else {
                gaugeArc.style.stroke = '#dc3545';
            }
        }

        const badge = document.getElementById('liveRecommendationBadge');
        const hiddenRec = document.getElementById('formInputRecommendation');

        if (weighted >= 85) {
            badge.textContent = 'RECOMMENDED FOR APPROVAL';
            badge.className = 'badge bg-success px-3 py-2 fs-6 font-weight-bold text-uppercase';
            if (hiddenRec) hiddenRec.value = 'Recommended for Approval';
        } else if (weighted >= 70) {
            badge.textContent = 'APPROVED WITH REVISIONS';
            badge.className = 'badge bg-warning text-dark px-3 py-2 fs-6 font-weight-bold text-uppercase';
            if (hiddenRec) hiddenRec.value = 'Approved with Revisions';
        } else {
            badge.textContent = 'NOT RECOMMENDED';
            badge.className = 'badge bg-danger px-3 py-2 fs-6 font-weight-bold text-uppercase';
            if (hiddenRec) hiddenRec.value = 'Not Recommended';
        }
    }

    function appendFeedbackSnippet(snippetText) {
        const area = document.getElementById('scorecardFeedbackNotes');
        if (area) {
            if (area.value.trim().length > 0) {
                area.value += ' ' + snippetText;
            } else {
                area.value = snippetText;
            }
        }
    }

    function validateScorecardForm() {
        const targetCode = document.getElementById('scorecardTargetCode').value.trim();
        if (!targetCode) {
            showToast('Validation Error', 'Target Proposal or Project Code is required.');
            return false;
        }
        return true;
    }

    function resetScorecardWorkspace() {
        document.getElementById('mainScorecardForm')?.reset();
        applyScorePreset(85, 90, 80, 88);
        showToast('Workspace Reset', 'Scorecard sliders restored to defaults.');
    }

    function recomputeEthicsRisk() {
        let count = 0;
        for (let i = 1; i <= 6; i++) {
            if (document.getElementById(`ethCheck${i}`)?.checked) count++;
        }

        document.getElementById('ethicsCheckedCount').textContent = `${count} / 6 Checked`;

        const levelText = document.getElementById('ethicsRiskLevelText');
        const catBadge = document.getElementById('ethicsRiskCategoryBadge');
        const levelCode = document.getElementById('ethicsLevelCode');
        const trackText = document.getElementById('ethicsTrackText');

        if (count >= 5) {
            levelText.textContent = 'LOW RISK';
            levelText.className = 'h1 font-weight-bold text-success mb-1';
            catBadge.textContent = 'Category A: Exempt / Expedited Clearance';
            catBadge.className = 'badge bg-success text-white px-3 py-2';
            levelCode.textContent = 'Category A (Exempt)';
            trackText.textContent = 'Expedited Clearance';
        } else if (count >= 3) {
            levelText.textContent = 'MODERATE RISK';
            levelText.className = 'h1 font-weight-bold text-warning mb-1';
            catBadge.textContent = 'Category B: Conditional IRB Review';
            catBadge.className = 'badge bg-warning text-dark px-3 py-2';
            levelCode.textContent = 'Category B (Conditional)';
            trackText.textContent = 'Standard IRB Review';
        } else {
            levelText.textContent = 'HIGH RISK';
            levelText.className = 'h1 font-weight-bold text-danger mb-1';
            catBadge.textContent = 'Category C: Full Board IRB Review Required';
            catBadge.className = 'badge bg-danger text-white px-3 py-2';
            levelCode.textContent = 'Category C (High Risk)';
            trackText.textContent = 'Full Board Review';
        }
    }

    function openRubricMatrixModal(formCode, formTitle) {
        document.getElementById('matrixModalCode').textContent = formCode + ' Specifications';
        document.getElementById('matrixModalTitle').textContent = formTitle || 'Evaluation Rubric';

        const container = document.getElementById('matrixCriteriaList');
        container.innerHTML = `
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div><strong>Technical Methodology & Rigor</strong><br><small class="text-muted">Soundness of research design and data collection</small></div>
                <span class="badge bg-maroon text-white fs-6">30%</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div><strong>Originality & Innovation</strong><br><small class="text-muted">Novelty of solution and contribution to field</small></div>
                <span class="badge bg-maroon text-white fs-6">25%</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div><strong>Budget Justification (LIB)</strong><br><small class="text-muted">Itemized cost efficiency and line item alignment</small></div>
                <span class="badge bg-maroon text-white fs-6">20%</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div><strong>Researcher Capability & Track Record</strong><br><small class="text-muted">PI qualifications and institutional readiness</small></div>
                <span class="badge bg-maroon text-white fs-6">25%</span>
            </div>
        `;

        const modalEl = document.getElementById('rubricMatrixModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function viewEvaluationDetailModal(rubricCode, targetCode, evaluator, score, recommendation, feedback) {
        document.getElementById('detailModalRubricCode').textContent = rubricCode;
        document.getElementById('detailModalTargetCode').textContent = targetCode;
        document.getElementById('detailModalEvaluator').textContent = evaluator;
        document.getElementById('detailModalScore').textContent = `${score} / 100`;
        document.getElementById('detailModalRec').textContent = recommendation;
        document.getElementById('detailModalFeedback').textContent = feedback;

        const modalEl = document.getElementById('evaluationDetailModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function openEthicsCertModal() {
        const modalEl = document.getElementById('ethicsCertModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function downloadToolPdf(formCode) {
        const text = `MARINDUQUE STATE UNIVERSITY\nOFFICIAL EVALUATION FORM RUBRIC\nCode: ${formCode}\nApproved: Research Council\nTimestamp: ${new Date().toLocaleString()}\n`;
        const blob = new Blob([text], { type: 'text/plain;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', `${formCode}_Rubric.txt`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Rubric Downloaded', `${formCode} rubric scorecard downloaded.`);
    }

    function exportEvaluationRubricsCSV() {
        const rows = [["Form Code", "Tool Title", "Target", "Revision"]];
        document.querySelectorAll('#toolsGridContainer .tool-card-item').forEach(item => {
            const code = item.querySelector('.badge.bg-maroon')?.innerText || '';
            const title = item.querySelector('h5')?.innerText || '';
            const target = item.querySelector('.p-2.bg-light .small')?.innerText || '';
            rows.push([`"${code}"`, `"${title}"`, `"${target}"`, `"Current"`]);
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Evaluation_Rubrics_Matrix_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'Rubric scorecards matrix exported to CSV.');
    }

    function exportCompletedEvaluationsCSV() {
        const rows = [["Rubric Code", "Target Code", "Evaluator", "Overall Score", "Recommendation"]];
        document.querySelectorAll('#completedEvaluationsTable tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 8) {
                const rubric = cells[0]?.innerText.trim() || '';
                const target = cells[1]?.innerText.replace(/\n/g, ' ').trim() || '';
                const evaluator = cells[2]?.innerText.trim() || '';
                const score = cells[6]?.innerText.trim() || '';
                const rec = cells[7]?.innerText.trim() || '';
                rows.push([`"${rubric}"`, `"${target}"`, `"${evaluator}"`, `"${score}"`, `"${rec}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Completed_Evaluations_Log_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Log Exported', 'Completed scorecards audit trail exported to CSV.');
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

    // Initialize scorecard computation on load
    document.addEventListener('DOMContentLoaded', () => {
        recomputeScorecard();
    });
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>