<!-- Begin Page Content -->
<div class="container-fluid py-4" id="researchPortalRoot">

    <!-- CSS Fix & Theme Styling -->
    <style>
        /* =========================================================
           1. RESET & OVERLAY SAFEGUARDS (Pangontra sa namumulang screen)
           ========================================================= */
        #researchPortalRoot, 
        #researchPortalRoot * {
            box-sizing: border-box;
        }
        /* Tinitiyak na walang stray overlay o backdrop na tatakip sa content */
        .modal-backdrop:not(.show) {
            display: none !important;
        }
        .portal-section {
            position: relative;
            z-index: 1;
        }

        /* =========================================================
           2. COLOR PALETTE & BUTTONS
           ========================================================= */
        :root {
            --maroon-main: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #fff0f3;
            --gold-accent: #d4af37;
        }
        .text-maroon { color: var(--maroon-main) !important; }
        .bg-maroon { background-color: var(--maroon-main) !important; color: #fff !important; }
        .border-left-maroon { border-left: 0.25rem solid var(--maroon-main) !important; }
        .badge-maroon { background-color: var(--maroon-main); color: #fff; }

        .btn-maroon {
            background-color: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #fff;
            transition: all 0.2s ease-in-out;
        }
        .btn-maroon:hover {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #fff;
        }
        .btn-gold {
            background-color: var(--gold-accent);
            border-color: var(--gold-accent);
            color: #212529;
            font-weight: 600;
        }
        .btn-gold:hover {
            background-color: #bfa02e;
            color: #111;
        }

        /* =========================================================
           3. PORTAL NAVIGATION PILLS
           ========================================================= */
        .portal-nav-pills {
            display: flex;
            gap: 12px;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e3e6f0;
            padding-bottom: 0.75rem;
        }
        .nav-link-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            background: #f8f9fc;
            color: #4e73df;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid #e3e6f0;
            transition: all 0.2s;
        }
        .nav-link-pill:hover {
            background: #eaecf4;
            color: #224abe;
            text-decoration: none;
        }
        .nav-link-pill.active {
            background: var(--maroon-main);
            color: #fff;
            border-color: var(--maroon-main);
            box-shadow: 0 4px 10px rgba(128, 0, 32, 0.25);
        }

        /* =========================================================
           4. STEPPER & WIZARD STYLES
           ========================================================= */
        .wizard-steps-container {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        .wizard-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-top: 10px;
        }
        .wizard-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
            cursor: pointer;
            flex: 1;
        }
        .wizard-step-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 6px;
            transition: all 0.3s;
        }
        .wizard-step-title {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 600;
            text-align: center;
        }
        .wizard-step.active .wizard-step-circle {
            background: var(--maroon-main);
            color: #fff;
            box-shadow: 0 0 0 4px var(--maroon-light);
        }
        .wizard-step.active .wizard-step-title {
            color: var(--maroon-main);
            font-weight: 700;
        }
        .wizard-step.completed .wizard-step-circle {
            background: #1cc88a;
            color: #fff;
        }

        /* Form Sections */
        .form-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #eaecf4;
        }
        .form-section-icon {
            width: 40px;
            height: 40px;
            background: var(--maroon-light);
            color: var(--maroon-main);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Type Cards */
        .type-selector-card {
            border: 2px solid #e3e6f0;
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            background: #fff;
            height: 100%;
        }
        .type-selector-card input[type="radio"] {
            display: none;
        }
        .type-selector-card:hover {
            border-color: var(--maroon-main);
            background: #fffdfd;
        }
        .type-selector-card.selected {
            border-color: var(--maroon-main);
            background: var(--maroon-light);
        }

        /* File Dropzone */
        .file-dropzone {
            border: 2px dashed #d1d3e2;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            background: #f8f9fc;
            transition: all 0.2s;
        }
        .file-dropzone:hover {
            border-color: var(--maroon-main);
            background: var(--maroon-light);
        }
        .uploaded-file-item {
            background: #fff;
            border: 1px solid #e3e6f0;
            padding: 12px 16px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        /* Callout */
        .help-callout {
            background: #fff;
            border-left: 4px solid #f6c23e;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 1.5rem;
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

        /* Main Navigation Tab Pills */
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
            <span class="hero-badge-tag"><i class="fas fa-file-signature me-1"></i> Research Proposals & Approvals</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-tasks me-2 text-warning"></i>Proposal Submission & Peer Review Lifecycle
            </h1>
            <p class="page-hero-subtitle">
                Submit new research proposals, monitor multi-stage ethics and technical review workflows, track revisions, and access official endorsement letters.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" onclick="switchPortalTab('submit')">
                <i class="fas fa-plus-circle me-1"></i> Submit Proposal
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill active"><i class="bi bi-file-earmark-check text-white me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill"><i class="bi bi-search text-maroon me-1"></i> Discovery Engine</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- Portal Inner Sub-Tabs -->
    <div class="portal-nav-pills">
        <a class="nav-link-pill active" id="tabBtnApprovals" onclick="switchPortalTab('approvals')">
            <i class="fas fa-tasks"></i> Proposal Tracking & Approval Status
        </a>
        <a class="nav-link-pill" id="tabBtnSubmit" onclick="switchPortalTab('submit')">
            <i class="fas fa-file-signature"></i> Submit New Research Proposal
        </a>
    </div>

    <!-- Dynamic Flash Messages -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= e($_SESSION['flash_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= e($_SESSION['flash_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- ==================================================================================== -->
    <!-- SECTION 1: PROPOSAL TRACKING & APPROVAL STATUS PORTAL                                -->
    <!-- ==================================================================================== -->
    <div id="portalSectionApprovals" class="portal-section">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h4 mb-1 text-gray-800 font-weight-bold">
                    <i class="fas fa-tasks text-maroon me-2"></i>Proposal Approval & Review Status
                </h2>
                <p class="text-muted small mb-0">Track real-time evaluation stages, reviewer feedback, ethical clearance, and institutional decision status.</p>
            </div>
        </div>

        <!-- Top KPI Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-maroon shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Total Proposals Tracked</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['total'] ?? 0) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Under Active Review</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['under_review'] ?? 0) ?></div>
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
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved for Granting</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['approved'] ?? 0) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Action / Revision Needed</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= (int)($stats['revision'] ?? 0) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proposals Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-light">
                <h6 class="m-0 font-weight-bold text-maroon"><i class="fas fa-list mr-2"></i>Institutional Proposal Tracking Database</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Code</th>
                                <th>Title & Lead Proponent</th>
                                <th>College & Thrust</th>
                                <th>Type & Funding</th>
                                <th>Requested Budget</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($proposals)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No research proposals submitted yet. Click "Submit New Proposal" to get started.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($proposals as $prop): ?>
                                    <tr>
                                        <td><span class="badge bg-maroon text-white px-2 py-1"><?= e($prop['code']) ?></span></td>
                                        <td>
                                            <strong class="text-dark d-block"><?= e($prop['title']) ?></strong>
                                            <small class="text-muted"><i class="fas fa-user-circle text-maroon mr-1"></i> <?= e($prop['pi_name']) ?> (<?= e($prop['college'] ?? 'N/A') ?>)</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= e($prop['college'] ?? 'N/A') ?></span>
                                            <small class="d-block text-muted"><?= e($prop['agenda_thrust'] ?? 'N/A') ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary"><?= e($prop['research_type'] ?? 'N/A') ?></span>
                                            <small class="d-block text-muted"><?= e($prop['funding_source'] ?? 'IRF') ?></small>
                                        </td>
                                        <td>
                                            <strong class="text-maroon">₱ <?= number_format((float)($prop['budget_total'] ?? 0), 2) ?></strong>
                                        </td>
                                        <td>
                                            <?php
                                            $st = $prop['status'] ?? 'Under Review';
                                            $badgeClass = match($st) {
                                                'Approved' => 'bg-success text-white',
                                                'Under Review' => 'bg-warning text-dark',
                                                'Revision Needed' => 'bg-danger text-white',
                                                'Rejected' => 'bg-secondary text-white',
                                                default => 'bg-info text-white'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?> px-2 py-1"><?= e($st) ?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                                    <li>
                                                        <button class="dropdown-item" type="button" onclick="viewProposalModal(<?= e(json_encode($prop)) ?>)">
                                                            <i class="fas fa-eye text-primary mr-2"></i> View Details
                                                        </button>
                                                    </li>
                                                    <?php if ($st !== 'Approved'): ?>
                                                    <li>
                                                        <form method="POST" action="<?= url('irimkms/proposals/status') ?>" class="d-inline">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="proposal_id" value="<?= e($prop['id']) ?>">
                                                            <input type="hidden" name="status" value="Approved">
                                                            <button type="submit" class="dropdown-item text-success">
                                                                <i class="fas fa-check-circle mr-2"></i> Approve & Register Project
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php if ($st !== 'Revision Needed'): ?>
                                                    <li>
                                                        <form method="POST" action="<?= url('irimkms/proposals/status') ?>" class="d-inline">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="proposal_id" value="<?= e($prop['id']) ?>">
                                                            <input type="hidden" name="status" value="Revision Needed">
                                                            <button type="submit" class="dropdown-item text-warning">
                                                                <i class="fas fa-exclamation-triangle mr-2"></i> Request Revision
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== -->
    <!-- SECTION 2: PROPOSAL SUBMISSION WIZARD FORM PORTAL (Visible)                          -->
    <!-- ==================================================================================== -->
    <div id="portalSectionSubmit" class="portal-section">

        <!-- Page Header & Action Bar -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                    <i class="fas fa-file-signature text-maroon mr-2"></i>Submit Research Proposal
                </h1>
                <p class="text-muted small mb-0">Fill in the required research details, budget requirements, and document attachments for institutional review.</p>
            </div>
            <div class="mt-3 mt-sm-0">
                <button class="btn btn-sm btn-outline-primary shadow-sm" onclick="switchPortalTab('approvals')">
                    <i class="fas fa-tasks mr-1"></i> Track Approvals
                </button>
            </div>
        </div>

        <!-- Guidance Banner Callout -->
        <div class="help-callout shadow-sm d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fas fa-lightbulb fa-2x text-warning mr-3"></i>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">Institutional Research Grant Cycle 2026-2027</h6>
                    <p class="mb-0 text-muted small">Ensure your proposal aligns with the University Research Agenda (URA) and Sustainable Development Goals (SDGs) for prioritized funding review.</p>
                </div>
            </div>
            <span class="badge badge-warning px-3 py-2 text-dark font-weight-bold d-none d-md-inline-block">Deadline: Oct 30, 2026</span>
        </div>

        <!-- Multi-Step Wizard Progress Bar -->
        <div class="wizard-steps-container">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-xs font-weight-bold text-uppercase text-maroon" id="stepProgressLabel">Step 1 of 5: General Information</span>
                <span class="text-xs font-weight-bold text-muted" id="stepPercentage">20% Completed</span>
            </div>
            <div class="progress mb-3" style="height: 6px;">
                <div class="progress-bar bg-maroon" id="mainProgressBar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="wizard-steps">
                <div class="wizard-step active" id="stepIndicator1" onclick="goToStep(1)">
                    <div class="wizard-step-circle"><i class="fas fa-info"></i></div>
                    <div class="wizard-step-title">General Info</div>
                </div>
                <div class="wizard-step" id="stepIndicator2" onclick="goToStep(2)">
                    <div class="wizard-step-circle"><i class="fas fa-users"></i></div>
                    <div class="wizard-step-title">Proponents</div>
                </div>
                <div class="wizard-step" id="stepIndicator3" onclick="goToStep(3)">
                    <div class="wizard-step-circle"><i class="fas fa-align-left"></i></div>
                    <div class="wizard-step-title">Abstract & Details</div>
                </div>
                <div class="wizard-step" id="stepIndicator4" onclick="goToStep(4)">
                    <div class="wizard-step-circle"><i class="fas fa-coins"></i></div>
                    <div class="wizard-step-title">Budget & Plan</div>
                </div>
                <div class="wizard-step" id="stepIndicator5" onclick="goToStep(5)">
                    <div class="wizard-step-circle"><i class="fas fa-file-upload"></i></div>
                    <div class="wizard-step-title">Attachments</div>
                </div>
            </div>
        </div>

        <!-- Proposal Form Container -->
        <form id="proposalForm" method="POST" action="<?= url('irimkms/proposals/store') ?>">
            <?= csrf_field() ?>

            <!-- ==================== STEP 1: GENERAL INFORMATION ==================== -->
            <div class="wizard-pane" id="paneStep1">
                <div class="card shadow mb-4 border-left-maroon">
                    <div class="card-body">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="fas fa-book"></i></div>
                            <div>
                                <h5 class="m-0 font-weight-bold text-dark">Step 1: General Project Information</h5>
                                <small class="text-muted">Specify basic metadata, research type, and institutional alignment.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Research Proposal Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="proposalTitle" name="title" placeholder="e.g., Artificial Intelligence-Driven Water Quality Monitoring System for Local Basins" required>
                            <small class="form-text text-muted d-flex justify-content-between">
                                <span>Make the title descriptive, concise, and reflective of the core research objective.</span>
                                <span id="titleCharCount">0 / 200 characters</span>
                            </small>
                        </div>

                        <div class="form-group mt-4">
                            <label class="font-weight-bold text-dark">Classification / Type of Research <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="type-selector-card selected" onclick="selectType(this, 'Basic Research')">
                                        <input type="radio" name="researchType" value="Basic Research" checked>
                                        <div class="type-card-content text-center">
                                            <i class="fas fa-microscope fa-2x mb-2 text-maroon"></i>
                                            <h6 class="font-weight-bold mb-1">Basic Research</h6>
                                            <small class="text-muted d-block">Fundamental scientific inquiry</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="type-selector-card" onclick="selectType(this, 'Applied Research')">
                                        <input type="radio" name="researchType" value="Applied Research">
                                        <div class="type-card-content text-center">
                                            <i class="fas fa-cogs fa-2x mb-2 text-maroon"></i>
                                            <h6 class="font-weight-bold mb-1">Applied Research</h6>
                                            <small class="text-muted d-block">Practical technology creation</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="type-selector-card" onclick="selectType(this, 'Extension Project')">
                                        <input type="radio" name="researchType" value="Extension Project">
                                        <div class="type-card-content text-center">
                                            <i class="fas fa-hands-helping fa-2x mb-2 text-maroon"></i>
                                            <h6 class="font-weight-bold mb-1">Extension / Outreach</h6>
                                            <small class="text-muted d-block">Community engagement</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="type-selector-card" onclick="selectType(this, 'Commercialization')">
                                        <input type="radio" name="researchType" value="Commercialization">
                                        <div class="type-card-content text-center">
                                            <i class="fas fa-chart-line fa-2x mb-2 text-maroon"></i>
                                            <h6 class="font-weight-bold mb-1">Commercialization</h6>
                                            <small class="text-muted d-block">IP generation & prototyping</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold text-dark">University Research Agenda Thrust <span class="text-danger">*</span></label>
                                <select class="custom-select" id="researchAgenda" name="agenda_thrust" required>
                                    <option value="" selected disabled>-- Select Priority Thrust --</option>
                                    <option value="IT & AI">Information Technology, AI & Digital Innovation</option>
                                    <option value="Agriculture">Agriculture, Food Security & Aquatic Resources</option>
                                    <option value="Health">Health Sciences & Smart Healthcare Systems</option>
                                    <option value="Environment">Environmental Sustainability & Climate Resilience</option>
                                    <option value="Education">Social Development, Governance & Education</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold text-dark">Lead Implementing College / Institute <span class="text-danger">*</span></label>
                                <select class="custom-select" id="leadCollege" name="college" required>
                                    <option value="" selected disabled>-- Select College / Department --</option>
                                    <option value="CIT">College of Information Technology</option>
                                    <option value="COE">College of Engineering</option>
                                    <option value="CSM">College of Science and Mathematics</option>
                                    <option value="COA">College of Agriculture</option>
                                    <option value="CHS">College of Health Sciences</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4 form-group">
                                <label class="font-weight-bold text-dark">Target Start Date <span class="text-danger">*</span></label>
                                <input type="month" class="form-control" id="startDate" name="start_date" value="2026-11" onchange="calcDuration()">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="font-weight-bold text-dark">Target End Date <span class="text-danger">*</span></label>
                                <input type="month" class="form-control" id="endDate" name="end_date" value="2027-10" onchange="calcDuration()">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="font-weight-bold text-dark">Total Duration</label>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light font-weight-bold text-maroon" id="durationText" name="duration" value="12 Months" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-muted"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== STEP 2: PROPONENTS ==================== -->
            <div class="wizard-pane d-none" id="paneStep2">
                <div class="card shadow mb-4 border-left-maroon">
                    <div class="card-body">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="fas fa-user-tie"></i></div>
                            <div>
                                <h5 class="m-0 font-weight-bold text-dark">Step 2: Principal Investigator & Research Team</h5>
                                <small class="text-muted">Specify the primary researcher details and co-investigators.</small>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded mb-4 border">
                            <h6 class="font-weight-bold text-maroon mb-3"><i class="fas fa-id-badge mr-1"></i> Principal Investigator (Lead Proponent)</h6>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="small font-weight-bold text-muted">Full Name</label>
                                    <input type="text" class="form-control" id="piName" name="pi_name" value="Mhica Bianca Rodelas" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="small font-weight-bold text-muted">Employee / Faculty ID</label>
                                    <input type="text" class="form-control" id="piId" name="pi_id" value="EMP-2021-0492" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="small font-weight-bold text-muted">Academic Rank / Title</label>
                                    <select class="custom-select" id="piRank" name="pi_rank">
                                        <option selected>Associate Professor II</option>
                                        <option>Professor I</option>
                                        <option>Professor V</option>
                                        <option>Assistant Professor IV</option>
                                        <option>Senior Researcher</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold text-muted">Institutional Email</label>
                                    <input type="email" class="form-control" id="piEmail" name="pi_email" value="mhica.rodelas@msu.edu.ph" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold text-muted">Contact Mobile Number</label>
                                    <input type="tel" class="form-control" id="piPhone" name="pi_phone" value="+63 917 890 1234">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="font-weight-bold text-dark m-0"><i class="fas fa-users-cog text-maroon mr-1"></i> Co-Investigators & Research Staff</h6>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCoInvestigator()">
                                <i class="fas fa-plus mr-1"></i> Add Co-Investigator
                            </button>
                        </div>

                        <div id="coInvestigatorsList">
                            <div class="row align-items-center mb-2 co-inv-row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="co_investigators" placeholder="Co-Investigator Name" value="Engr. Juan Dela Cruz, MSc">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Department / Institution" value="Dept. of Computer Engineering">
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select">
                                        <option selected>Co-Principal Investigator</option>
                                        <option>Project Manager</option>
                                        <option>Data Analyst</option>
                                        <option>Research Assistant</option>
                                    </select>
                                </div>
                                <div class="col-md-1 text-center">
                                    <button type="button" class="btn btn-sm btn-circle btn-outline-danger" onclick="removeCoInvRow(this)"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== STEP 3: ABSTRACT & DETAILS ==================== -->
            <div class="wizard-pane d-none" id="paneStep3">
                <div class="card shadow mb-4 border-left-maroon">
                    <div class="card-body">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="fas fa-file-alt"></i></div>
                            <div>
                                <h5 class="m-0 font-weight-bold text-dark">Step 3: Executive Summary & Technical Proposal</h5>
                                <small class="text-muted">Provide the project abstract, problem statement, objectives, and methodology.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Executive Summary / Abstract <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="proposalAbstract" name="abstract" rows="5" placeholder="Provide a concise summary of the research background, main objectives, proposed methodology, and anticipated impact..." required></textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label class="font-weight-bold text-dark">Specific Research Objectives <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="proposalObjectives" name="objectives" rows="4" placeholder="1. Design prototype sensor architecture.&#10;2. Evaluate real-time data accuracy.&#10;3. Conduct stakeholder workshops." required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== STEP 4: BUDGET & PLAN ==================== -->
            <div class="wizard-pane d-none" id="paneStep4">
                <div class="card shadow mb-4 border-left-maroon">
                    <div class="card-body">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="fas fa-calculator"></i></div>
                            <div>
                                <h5 class="m-0 font-weight-bold text-dark">Step 4: Budget Breakdown & Funding Source</h5>
                                <small class="text-muted">Itemize your estimated expenditures across standard accounting categories.</small>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold text-dark">Funding Agency / Grant Source <span class="text-danger">*</span></label>
                                <select class="custom-select" id="fundingSource" name="funding_source">
                                    <option selected>University Institutional Research Fund (IRF)</option>
                                    <option>DOST-GIA Grant</option>
                                    <option>CHED Discovery & Applied Research Grant</option>
                                    <option>External / International Industry Sponsorship</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold text-dark">Total Requested Budget</label>
                                <div class="p-3 bg-maroon rounded text-center text-white shadow-sm">
                                    <span class="small font-weight-bold text-warning d-block text-uppercase">Estimated Total Budget</span>
                                    <h3 class="m-0 font-weight-bold text-warning" id="totalBudgetDisplay">₱ 350,000.00</h3>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Expense Category</th>
                                        <th>Item Description</th>
                                        <th style="width: 220px;">Amount (PHP ₱)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Personnel Services (PS)</strong></td>
                                        <td><input type="text" class="form-control form-control-sm" value="Research Assistant honoraria"></td>
                                        <td><input type="number" class="form-control form-control-sm budget-input" id="psAmount" name="budget_ps" value="120000" oninput="calcTotalBudget()"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Maintenance & Other Operating (MOOE)</strong></td>
                                        <td><input type="text" class="form-control form-control-sm" value="Lab supplies & sample collection"></td>
                                        <td><input type="number" class="form-control form-control-sm budget-input" id="mooeAmount" name="budget_mooe" value="150000" oninput="calcTotalBudget()"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Capital Outlay / Equipment (CO)</strong></td>
                                        <td><input type="text" class="form-control form-control-sm" value="Sensors & computing micro-controllers"></td>
                                        <td><input type="number" class="form-control form-control-sm budget-input" id="coAmount" name="budget_co" value="80000" oninput="calcTotalBudget()"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== STEP 5: ATTACHMENTS & DECLARATION ==================== -->
            <div class="wizard-pane d-none" id="paneStep5">
                <div class="card shadow mb-4 border-left-maroon">
                    <div class="card-body">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="fas fa-folder-open"></i></div>
                            <div>
                                <h5 class="m-0 font-weight-bold text-dark">Step 5: File Attachments & Final Declaration</h5>
                                <small class="text-muted">Upload full proposal PDF, detailed budget files, and complete declaration.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Upload Proposal Documents <span class="text-danger">*</span></label>
                            <div class="file-dropzone" onclick="document.getElementById('fileInput').click()">
                                <i class="fas fa-cloud-upload-alt fa-3x text-maroon mb-2"></i>
                                <h6 class="font-weight-bold text-dark mb-1">Click or Drag & Drop Files Here</h6>
                                <small class="text-muted d-block">Supported formats: PDF, DOCX, XLSX (Max 25MB per file)</small>
                                <input type="file" id="fileInput" multiple style="display: none;">
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded mt-4 border">
                            <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-shield-alt text-maroon mr-1"></i> Researcher Declaration</h6>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="checkPlagiarism" checked required>
                                <label class="custom-control-label text-muted small" for="checkPlagiarism">
                                    I certify that this proposal is original work and free of plagiarism.
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkEthics" checked required>
                                <label class="custom-control-label text-muted small" for="checkEthics">
                                    I agree to abide by the University Ethics Guidelines.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <!-- Sticky Bottom Action Toolbar -->
        <div class="sticky-form-nav mb-5">
            <button class="btn btn-outline-secondary px-4" id="btnPrevStep" onclick="changeStep(-1)" disabled>
                <i class="fas fa-arrow-left mr-2"></i> Previous Step
            </button>
            <div>
                <button class="btn btn-outline-primary px-3 mr-2" onclick="saveDraftNotification()">
                    <i class="fas fa-save mr-1"></i> Save Draft
                </button>
                <button class="btn btn-maroon px-4" id="btnNextStep" onclick="changeStep(1)">
                    Next Step <i class="fas fa-arrow-right ml-2"></i>
                </button>
                <button class="btn btn-gold px-4 d-none" id="btnSubmitFinal" onclick="submitProposal()">
                    <i class="fas fa-paper-plane mr-2"></i> Submit Proposal
                </button>
            </div>
        </div>

    </div>

    <!-- JavaScript Controller -->
    <script>
        let currentStep = 1;
        const totalSteps = 5;

        // Switch main portal tabs
        function switchPortalTab(tabName) {
            const approvalsSec = document.getElementById('portalSectionApprovals');
            const submitSec = document.getElementById('portalSectionSubmit');
            const tabBtnApprovals = document.getElementById('tabBtnApprovals');
            const tabBtnSubmit = document.getElementById('tabBtnSubmit');

            if (tabName === 'approvals') {
                approvalsSec.classList.remove('d-none');
                submitSec.classList.add('d-none');
                tabBtnApprovals.classList.add('active');
                tabBtnSubmit.classList.remove('active');
            } else {
                submitSec.classList.remove('d-none');
                approvalsSec.classList.add('d-none');
                tabBtnSubmit.classList.add('active');
                tabBtnApprovals.classList.remove('active');
            }
        }

        // Navigate step wizard
        function goToStep(step) {
            if (step < 1 || step > totalSteps) return;

            // Hide all step panes
            for (let i = 1; i <= totalSteps; i++) {
                const pane = document.getElementById(`paneStep${i}`);
                const indicator = document.getElementById(`stepIndicator${i}`);
                if (pane) pane.classList.add('d-none');
                if (indicator) {
                    indicator.classList.remove('active');
                    if (i < step) indicator.classList.add('completed');
                    else indicator.classList.remove('completed');
                }
            }

            // Show selected pane
            const targetPane = document.getElementById(`paneStep${step}`);
            const targetIndicator = document.getElementById(`stepIndicator${step}`);
            if (targetPane) targetPane.classList.remove('d-none');
            if (targetIndicator) targetIndicator.classList.add('active');

            currentStep = step;

            // Update Progress Bar & Labels
            const pct = (step / totalSteps) * 100;
            document.getElementById('mainProgressBar').style.width = pct + '%';
            document.getElementById('stepPercentage').innerText = pct + '% Completed';

            const stepNames = [
                'General Information',
                'Proponents & Research Team',
                'Abstract & Objectives',
                'Budget & Work Plan',
                'Attachments & Submission'
            ];
            document.getElementById('stepProgressLabel').innerText = `Step ${step} of 5: ${stepNames[step - 1]}`;

            // Button visibility
            document.getElementById('btnPrevStep').disabled = (step === 1);
            if (step === totalSteps) {
                document.getElementById('btnNextStep').classList.add('d-none');
                document.getElementById('btnSubmitFinal').classList.remove('d-none');
            } else {
                document.getElementById('btnNextStep').classList.remove('d-none');
                document.getElementById('btnSubmitFinal').classList.add('d-none');
            }

            window.scrollTo({ top: 120, behavior: 'smooth' });
        }

        function changeStep(delta) {
            goToStep(currentStep + delta);
        }

        // Calculation Helpers
        function calcTotalBudget() {
            const ps = parseFloat(document.getElementById('psAmount').value) || 0;
            const mooe = parseFloat(document.getElementById('mooeAmount').value) || 0;
            const co = parseFloat(document.getElementById('coAmount').value) || 0;
            const total = ps + mooe + co;
            document.getElementById('totalBudgetDisplay').innerText = '₱ ' + total.toLocaleString('en-US', { minimumFractionDigits: 2 });
        }

        function calcDuration() {
            const start = document.getElementById('startDate').value;
            const end = document.getElementById('endDate').value;
            if (start && end) {
                const s = new Date(start + "-01");
                const e = new Date(end + "-01");
                let months = (e.getFullYear() - s.getFullYear()) * 12 + (e.getMonth() - s.getMonth());
                if (months > 0) {
                    document.getElementById('durationText').value = months + " Months";
                }
            }
        }

        function selectType(card, typeVal) {
            document.querySelectorAll('.type-selector-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            const radio = card.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
        }

        function addCoInvestigator() {
            const container = document.getElementById('coInvestigatorsList');
            const div = document.createElement('div');
            div.className = 'row align-items-center mb-2 co-inv-row';
            div.innerHTML = `
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Co-Investigator Name">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Department / Institution">
                </div>
                <div class="col-md-3">
                    <select class="custom-select">
                        <option>Co-Principal Investigator</option>
                        <option>Project Manager</option>
                        <option>Data Analyst</option>
                        <option>Research Assistant</option>
                    </select>
                </div>
                <div class="col-md-1 text-center">
                    <button type="button" class="btn btn-sm btn-circle btn-outline-danger" onclick="removeCoInvRow(this)"><i class="fas fa-times"></i></button>
                </div>
            `;
            container.appendChild(div);
        }

        function removeCoInvRow(btn) {
            btn.closest('.co-inv-row').remove();
        }

        function saveDraftNotification() {
            alert('Proposal draft saved locally.');
        }

        function submitProposal() {
            const form = document.getElementById('proposalForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            form.submit();
        }

        function viewProposalModal(prop) {
            document.getElementById('propDetailCodeTitle').innerText = prop.code + ' - Proposal Dossier';
            document.getElementById('propDetailTitle').innerText = prop.title || '';
            document.getElementById('propDetailType').innerText = prop.research_type || 'N/A';
            document.getElementById('propDetailCollege').innerText = prop.college || 'N/A';
            document.getElementById('propDetailThrust').innerText = prop.agenda_thrust || 'N/A';
            document.getElementById('propDetailStatus').innerText = prop.status || 'Under Review';
            document.getElementById('propDetailPI').innerText = (prop.pi_name || '') + (prop.pi_rank ? ' (' + prop.pi_rank + ')' : '');
            document.getElementById('propDetailPIEmail').innerText = prop.pi_email || '';
            document.getElementById('propDetailAbstract').innerText = prop.abstract || 'No abstract provided.';
            document.getElementById('propDetailObjectives').innerText = prop.objectives || 'No specific objectives set.';
            document.getElementById('propDetailFunding').innerText = prop.funding_source || 'IRF';
            document.getElementById('propDetailBudget').innerText = '₱ ' + (parseFloat(prop.budget_total) || 0).toLocaleString('en-US', {minimumFractionDigits: 2});
            document.getElementById('propDetailDuration').innerText = prop.duration || 'N/A';

            const modalEl = document.getElementById('proposalDetailModal');
            const bsModal = new bootstrap.Modal(modalEl);
            bsModal.show();
        }
    </script>

    <!-- Proposal Detail Modal -->
    <div class="modal fade" id="proposalDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-maroon text-white py-3">
                    <h5 class="modal-title font-weight-bold" id="propDetailCodeTitle">Proposal Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h5 class="font-weight-bold text-dark" id="propDetailTitle"></h5>
                            <span class="badge bg-secondary mb-1" id="propDetailType"></span>
                            <span class="badge bg-light text-dark border mb-1" id="propDetailCollege"></span>
                            <span class="badge bg-info text-white mb-1" id="propDetailThrust"></span>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="small text-muted font-weight-bold">STATUS</div>
                            <h5 class="text-maroon font-weight-bold" id="propDetailStatus"></h5>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded mb-3 border">
                        <h6 class="font-weight-bold text-maroon mb-2"><i class="fas fa-user-circle mr-1"></i> Principal Investigator</h6>
                        <div class="row">
                            <div class="col-md-6"><strong class="text-dark" id="propDetailPI"></strong></div>
                            <div class="col-md-6"><span class="text-muted" id="propDetailPIEmail"></span></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="font-weight-bold text-dark"><i class="fas fa-file-alt text-maroon mr-1"></i> Executive Summary / Abstract</h6>
                        <p class="text-muted small mb-0" id="propDetailAbstract"></p>
                    </div>

                    <div class="mb-3">
                        <h6 class="font-weight-bold text-dark"><i class="fas fa-bullseye text-maroon mr-1"></i> Specific Research Objectives</h6>
                        <p class="text-muted small mb-0" id="propDetailObjectives"></p>
                    </div>

                    <div class="p-3 bg-light rounded border">
                        <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-coins text-maroon mr-1"></i> Budget & Funding Breakdown</h6>
                        <div class="row">
                            <div class="col-md-4"><small class="text-muted d-block">Funding Source:</small> <strong id="propDetailFunding"></strong></div>
                            <div class="col-md-4"><small class="text-muted d-block">Total Budget:</small> <strong class="text-maroon fs-5" id="propDetailBudget"></strong></div>
                            <div class="col-md-4"><small class="text-muted d-block">Duration:</small> <strong id="propDetailDuration"></strong></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->
<?php include __DIR__ . '/sidebar_icons.php'; ?>