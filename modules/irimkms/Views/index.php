<?php
/**
 * IRIMKMS Module Dashboard View
 * Institutional Repository & Knowledge Management System
 */
?>
<div class="container-fluid px-4 py-3" id="moduleDashboardRoot">

    <!-- ============================================================ -->
    <!-- CUSTOM CSS: MarSU Theme Tokens & Component Styles            -->
    <!-- ============================================================ -->
    <style>
        #moduleDashboardRoot, #moduleDashboardRoot * {
            box-sizing: border-box;
        }

        /* ── Theme Tokens ── */
        :root {
            --maroon-main:  #800020;
            --maroon-dark:  #5c0017;
            --maroon-light: #fff0f3;
            --gold-accent:  #d4af37;
            --gold-light:   #fffdf0;
        }

        /* ── Utility helpers ── */
        .text-maroon  { color: var(--maroon-main) !important; }
        .bg-maroon    { background-color: var(--maroon-main) !important; color: #fff !important; }
        .border-left-maroon { border-left: 4px solid var(--maroon-main) !important; }

        /* ── Buttons ── */
        .btn-maroon {
            background-color: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #fff;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-maroon:hover,
        .btn-maroon:focus {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #fff;
            box-shadow: 0 4px 12px rgba(128,0,32,0.25);
        }
        .btn-gold {
            background-color: var(--gold-accent);
            border-color: var(--gold-accent);
            color: #212529;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-gold:hover,
        .btn-gold:focus {
            background-color: #c09e2e;
            border-color: #c09e2e;
            color: #111;
        }

        /* ── Hero Banner ── */
        .hero-banner {
            background: linear-gradient(135deg, #800020 0%, #4a0013 50%, #29000a 100%);
            color: #fff;
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 28px;
            box-shadow: 0 8px 24px rgba(128,0,32,0.22);
            position: relative;
            overflow: hidden;
        }
        .hero-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -8%;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(212,175,55,0.22) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-badge {
            background: rgba(212,175,55,0.25);
            color: #d4af37;
            border: 1px solid rgba(212,175,55,0.45);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── KPI Cards ── */
        .kpi-card {
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            transition: all 0.25s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0,0,0,0.10);
        }
        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
        }

        .kpi-maroon  { background: #fff; border: 1px solid #e3e6f0; }
        .kpi-maroon::before  { background: var(--maroon-main); }
        .kpi-gold    { background: #fff; border: 1px solid #e3e6f0; }
        .kpi-gold::before    { background: var(--gold-accent); }
        .kpi-warning { background: #fff; border: 1px solid #e3e6f0; }
        .kpi-warning::before { background: #f39c12; }
        .kpi-success { background: #fff; border: 1px solid #e3e6f0; }
        .kpi-success::before { background: #1abc9c; }

        .kpi-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #6c757d;
            margin-bottom: 4px;
        }
        .kpi-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.1;
        }
        .kpi-trend {
            font-size: 0.79rem;
            margin-top: 6px;
        }

        .kpi-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .icon-maroon  { background: var(--maroon-light); color: var(--maroon-main); }
        .icon-gold    { background: var(--gold-light);   color: #b89315; }
        .icon-warning { background: #fff8ec;             color: #d68910; }
        .icon-success { background: #e8faf3;             color: #17a589; }

        /* ── Dashboard Cards ── */
        .dashboard-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e3e6f0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .dashboard-card-header {
            padding: 16px 22px;
            background: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }
        .dashboard-card-header h6 {
            margin: 0;
            font-weight: 700;
            color: var(--maroon-main);
            font-size: 0.92rem;
        }

        /* ── Activity Timeline ── */
        .activity-item {
            display: flex;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f3f7;
            position: relative;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: var(--maroon-main);
            flex-shrink: 0;
            margin-top: 5px;
        }
        .dot-gold    { background: var(--gold-accent) !important; }
        .dot-success { background: #1abc9c !important; }
        .activity-time {
            font-size: 0.75rem;
            color: #94a3b8;
            white-space: nowrap;
            min-width: 90px;
        }
        .activity-desc {
            font-size: 0.83rem;
            color: #374151;
            line-height: 1.45;
        }

        /* ── Toast ── */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 320px;
        }

        /* ── Modal backdrop fix ── */
        .modal-backdrop:not(.show) { display: none !important; }

        /* ── Suppress old BS4 badge colours that Bootstrap 5 renamed ── */
        .badge-maroon {
            background-color: var(--maroon-main) !important;
            color: #fff !important;
        }
    </style>

    <!-- ============================================================ -->
    <!-- FLASH NOTIFICATIONS                                          -->
    <!-- ============================================================ -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= e($_SESSION['flash_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= e($_SESSION['flash_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- ============================================================ -->
    <!-- HERO WELCOME BANNER                                          -->
    <!-- ============================================================ -->
    <div class="hero-banner d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div style="z-index:1;">
            <span class="hero-badge">
                <i class="bi bi-building me-1"></i> Marinduque State University — RMIS
            </span>
            <h2 style="font-weight:900; font-size:1.75rem; margin-bottom:0.35rem; color:#fff;">
                Welcome Back, <?= e($user['name'] ?? 'Researcher') ?>
            </h2>
            <p style="font-size:0.92rem; color:rgba(255,255,255,0.88); margin-bottom:0; max-width:650px;">
                Oversee ongoing university research projects, approve pending proposals,
                and access institutional repository documents in real-time.
            </p>
        </div>
        <div class="d-flex gap-2" style="z-index:1; flex-wrap:wrap;">
            <button class="btn btn-gold btn-sm px-3 py-2 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#quickSubmitProposalModal">
                <i class="bi bi-plus-circle me-1"></i> Submit Proposal
            </button>
            <button class="btn btn-light text-dark fw-bold btn-sm px-3 py-2 shadow-sm"
                    onclick="exportDashboardSummaryCSV()">
                <i class="bi bi-download me-1"></i> Export Report
            </button>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- EXECUTIVE KPI STATS ROW                                      -->
    <!-- ============================================================ -->
    <div class="row g-4 mb-4">

        <!-- Active Projects -->
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card kpi-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="kpi-title">Active Projects</div>
                    <div class="kpi-value mt-1"><?= e($stats['active_projects'] ?? 0) ?></div>
                    <div class="kpi-trend text-success">
                        <i class="bi bi-arrow-up me-1"></i>+12% vs last quarter
                    </div>
                </div>
                <div class="kpi-icon icon-maroon">
                    <i class="bi bi-flask"></i>
                </div>
            </div>
        </div>

        <!-- Total Research Funding -->
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card kpi-gold d-flex align-items-center justify-content-between">
                <div>
                    <div class="kpi-title">Total Research Funding</div>
                    <div class="kpi-value mt-1">₱<?= number_format(($stats['total_funding'] ?? 0) / 1000000, 1) ?>M</div>
                    <div class="kpi-trend text-muted">
                        <i class="bi bi-graph-up me-1"></i>84% Funding Allocated
                    </div>
                </div>
                <div class="kpi-icon icon-gold">
                    <i class="bi bi-coin"></i>
                </div>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card kpi-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="kpi-title">Pending Approvals</div>
                    <div class="kpi-value mt-1"><?= e($stats['pending_proposals'] ?? 0) ?></div>
                    <div class="kpi-trend text-warning fw-bold">
                        <i class="bi bi-exclamation-circle me-1"></i>Action Required
                    </div>
                </div>
                <div class="kpi-icon icon-warning">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
        </div>

        <!-- Publications & IP Assets -->
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card kpi-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="kpi-title">Registered Researchers</div>
                    <div class="kpi-value mt-1"><?= e($stats['total_faculty'] ?? 0) ?></div>
                    <div class="kpi-trend text-success">
                        <i class="bi bi-check2-all me-1"></i>Scopus &amp; CHED Registered
                    </div>
                </div>
                <div class="kpi-icon icon-success">
                    <i class="bi bi-award"></i>
                </div>
            </div>
        </div>

    </div><!-- /KPI row -->

    <!-- ============================================================ -->
    <!-- CHARTS & VISUAL ANALYTICS                                    -->
    <!-- ============================================================ -->
    <div class="row g-4 mb-4">

        <!-- Area Chart: Funding Trend -->
        <div class="col-xl-8 col-lg-7">
            <div class="dashboard-card h-100">
                <div class="dashboard-card-header">
                    <h6><i class="bi bi-bar-chart-line me-2"></i>University Funding Allocation Trend (2026)</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><h6 class="dropdown-header">Export Options</h6></li>
                            <li><a class="dropdown-item" href="#" onclick="exportDashboardSummaryCSV();return false;">
                                <i class="bi bi-file-earmark-spreadsheet text-success me-2"></i>Export CSV</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div style="height:310px; position:relative;">
                        <canvas id="myAreaChartCustom"></canvas>
                    </div>
                    <hr class="my-3">
                    <div class="row text-center small">
                        <div class="col-4">
                            <span class="fw-bold text-dark">Agriculture &amp; Fisheries</span>
                            <div class="text-maroon fw-bold">₱18.4M</div>
                        </div>
                        <div class="col-4">
                            <span class="fw-bold text-dark">Engineering &amp; ICT</span>
                            <div class="text-info fw-bold">₱14.8M</div>
                        </div>
                        <div class="col-4">
                            <span class="fw-bold text-dark">Health &amp; Social Sciences</span>
                            <div class="text-success fw-bold">₱15.3M</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart: Proposal Status -->
        <div class="col-xl-4 col-lg-5">
            <div class="dashboard-card h-100">
                <div class="dashboard-card-header">
                    <h6><i class="bi bi-pie-chart me-2"></i>Proposals Breakdown</h6>
                    <span class="badge bg-light text-dark fw-bold border">Q3 Status</span>
                </div>
                <div class="card-body p-3">
                    <div style="height:250px; position:relative;">
                        <canvas id="myPieChartCustom"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php
                            $approved  = 0; $underReview = 0; $revision = 0;
                            foreach ($proposals as $pr) {
                                if ($pr['status'] === 'Approved')       $approved++;
                                elseif ($pr['status'] === 'Under Review') $underReview++;
                                else $revision++;
                            }
                        ?>
                        <span class="me-2">
                            <i class="bi bi-circle-fill" style="color:#800020;"></i> Approved (<?= $approved ?>)
                        </span>
                        <span class="me-2">
                            <i class="bi bi-circle-fill" style="color:#f6c23e;"></i> Under Review (<?= $underReview ?>)
                        </span>
                        <span>
                            <i class="bi bi-circle-fill" style="color:#e74a3b;"></i> Revision (<?= $revision ?>)
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /Charts row -->

    <!-- ============================================================ -->
    <!-- LOWER GRID: RECENT PROPOSALS TABLE + ACTIVITY/MILESTONES     -->
    <!-- ============================================================ -->
    <div class="row g-4">

        <!-- Recent Research Proposals Table -->
        <div class="col-xl-8 col-lg-7">
            <div class="dashboard-card h-100">
                <div class="dashboard-card-header">
                    <h6><i class="bi bi-clipboard-data me-2"></i>Recent Research Submissions &amp; Status</h6>
                    <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-maroon">
                        View All
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size:0.86rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Code</th>
                                <th class="border-0">Research Title</th>
                                <th class="border-0">Lead PI</th>
                                <th class="border-0">Status</th>
                                <th class="border-0 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proposals)): ?>
                                <?php foreach (array_slice($proposals, 0, 5) as $pr): ?>
                                    <tr>
                                        <td class="fw-bold text-dark"><?= e($pr['code'] ?? '—') ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($pr['title'] ?? '') ?></div>
                                            <span class="text-muted small"><?= e($pr['college'] ?? '') ?></span>
                                        </td>
                                        <td><?= e($pr['pi_name'] ?? '—') ?></td>
                                        <td>
                                            <?php
                                                $s = $pr['status'] ?? '';
                                                $bc = match($s) {
                                                    'Approved'       => 'success',
                                                    'Under Review'   => 'warning',
                                                    'Revision Needed'=> 'danger',
                                                    default          => 'secondary'
                                                };
                                                $tc = ($s === 'Under Review') ? 'text-dark' : '';
                                            ?>
                                            <span class="badge bg-<?= $bc ?> <?= $tc ?> px-2 py-1"><?= e($s) ?></span>
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-secondary"
                                                    onclick="quickViewProposal(
                                                        '<?= e($pr['code'] ?? '') ?>',
                                                        '<?= e(addslashes($pr['title'] ?? '')) ?>',
                                                        '<?= e(addslashes($pr['pi_name'] ?? '')) ?>',
                                                        '<?= e($pr['college'] ?? '') ?>',
                                                        '₱<?= number_format((float)($pr['budget_total'] ?? 0), 2) ?>',
                                                        '<?= e($pr['status'] ?? '') ?>'
                                                    )" title="Quick View">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        No proposals submitted yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 bg-light border-top text-center">
                    <a href="<?= url('irimkms/proposalsandapprovals') ?>"
                       class="text-decoration-none fw-bold small text-maroon">
                        View Full Research Database <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column: Milestones + Activity -->
        <div class="col-xl-4 col-lg-5">

            <!-- Upcoming Milestones -->
            <div class="dashboard-card mb-4">
                <div class="dashboard-card-header">
                    <h6><i class="bi bi-calendar-event me-2"></i>Upcoming Milestones Due</h6>
                    <span class="badge bg-warning text-dark px-2 py-1">3 This Week</span>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-dark">Q3 Financial Audit Reports</span>
                            <span class="badge bg-danger">Oct 5</span>
                        </div>
                        <div class="progress" style="height:6px; border-radius:10px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width:85%;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-dark">CHED Institutional Grant Evaluation</span>
                            <span class="badge bg-warning text-dark">Oct 12</span>
                        </div>
                        <div class="progress" style="height:6px; border-radius:10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width:60%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-dark">Annual Research Presentation Forum</span>
                            <span class="badge bg-info">Oct 28</span>
                        </div>
                        <div class="progress" style="height:6px; border-radius:10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width:35%;"></div>
                        </div>
                    </div>
                </div>
            </div><!-- /Milestones -->

            <!-- Live Activity Log -->
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6><i class="bi bi-activity me-2"></i>Recent System Activity</h6>
                    <span class="text-muted small">Real-time</span>
                </div>
                <div class="card-body p-3">
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div>
                            <div class="activity-time">10 min ago</div>
                            <div class="activity-desc">Dr. Juan dela Cruz submitted Quarter 3 Progress Report for RES-2026-089.</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot dot-gold"></div>
                        <div>
                            <div class="activity-time">1 hour ago</div>
                            <div class="activity-desc">Evaluation Committee assigned 3 peer reviewers to RES-2026-092.</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot dot-success"></div>
                        <div>
                            <div class="activity-time">3 hours ago</div>
                            <div class="activity-desc">₱1.45M Research Grant disbursed for Smart Agriculture Project.</div>
                        </div>
                    </div>
                </div>
            </div><!-- /Activity -->

        </div><!-- /Right col -->

    </div><!-- /Lower grid -->

</div><!-- /#moduleDashboardRoot -->


<!-- ================================================================ -->
<!-- MODAL: QUICK PROPOSAL SUBMISSION                                  -->
<!-- ================================================================ -->
<div class="modal fade" id="quickSubmitProposalModal" tabindex="-1"
     aria-labelledby="quickSubmitProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title fw-bold" id="quickSubmitProposalModalLabel">
                    <i class="bi bi-file-earmark-plus me-2"></i>Submit Research Proposal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('irimkms/proposals/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="alert alert-light border-start border-maroon-main border-3 small mb-3">
                        <i class="bi bi-info-circle me-1 text-maroon"></i>
                        Submit a research proposal for peer evaluation and institutional grant allocation.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark">
                                Research Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control"
                                   placeholder="e.g. AI-Driven Water Quality Monitoring System" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">
                                Principal Investigator (PI) <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pi_name" class="form-control"
                                   value="<?= e($user['name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">
                                College / Unit <span class="text-danger">*</span>
                            </label>
                            <select name="college" class="form-select" required>
                                <option value="CIT">College of Information Technology (CIT)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CSM">College of Sciences &amp; Mathematics (CSM)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CHS">College of Health Sciences (CHS)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark">Agenda Thrust</label>
                            <select name="agenda_thrust" class="form-select">
                                <option value="IT &amp; AI">IT &amp; AI Innovation</option>
                                <option value="Agriculture">Agriculture &amp; Food Safety</option>
                                <option value="Environment">Environment &amp; Climate Change</option>
                                <option value="Renewable Energy">Renewable Energy</option>
                                <option value="Health">Public Health &amp; Medical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark">Funding Source</label>
                            <input type="text" name="funding_source" class="form-control"
                                   value="University Institutional Research Fund (IRF)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark">Requested Budget (₱)</label>
                            <input type="number" step="0.01" name="budget_total" class="form-control"
                                   placeholder="350000.00" value="350000.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Executive Abstract</label>
                        <textarea name="abstract" class="form-control" rows="3"
                                  placeholder="Brief summary of research methodology, deliverables, and societal impact..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm px-4 fw-bold">
                        <i class="bi bi-send-fill me-1"></i> Submit Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ================================================================ -->
<!-- MODAL: QUICK PROPOSAL VIEW DETAIL                                 -->
<!-- ================================================================ -->
<div class="modal fade" id="quickViewProposalModal" tabindex="-1"
     aria-labelledby="quickViewProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title fw-bold" id="quickViewProposalModalLabel">
                    <i class="bi bi-file-earmark-text me-2"></i>Proposal Quick Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-maroon fs-6" id="qvModalCode">PROP-2026-001</span>
                    <span class="badge bg-warning text-dark px-3 py-1" id="qvModalStatus">Under Review</span>
                </div>
                <h6 class="fw-bold text-dark mb-2" id="qvModalTitle">Research Proposal Title</h6>
                <div class="p-3 bg-light rounded border mb-3">
                    <div class="row g-2 small">
                        <div class="col-6">
                            <span class="text-muted d-block">Lead PI:</span>
                            <strong id="qvModalPI">Dr. Faculty</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block">College:</span>
                            <strong id="qvModalCollege">CIT</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block">Budget Allocation:</span>
                            <strong class="text-maroon fs-6" id="qvModalBudget">₱ 350,000.00</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Close</button>
                <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="btn btn-maroon btn-sm px-3 fw-bold">
                    Open Proposals Portal <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================ -->
<!-- TOAST NOTIFICATION                                                -->
<!-- ================================================================ -->
<div class="toast-notification d-none" id="actionToast">
    <div class="card shadow-lg border-start border-maroon-main bg-white" style="border-left:4px solid var(--maroon-main)!important;">
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


<!-- ================================================================ -->
<!-- SCRIPTS                                                           -->
<!-- ================================================================ -->
<script>
    /* ── Quick View Proposal Modal ── */
    function quickViewProposal(code, title, pi, college, budget, status) {
        document.getElementById('qvModalCode').textContent    = code;
        document.getElementById('qvModalTitle').textContent   = title;
        document.getElementById('qvModalPI').textContent      = pi;
        document.getElementById('qvModalCollege').textContent = college;
        document.getElementById('qvModalBudget').textContent  = budget;
        document.getElementById('qvModalStatus').textContent  = status;

        const modalEl = document.getElementById('quickViewProposalModal');
        if (modalEl && typeof bootstrap !== 'undefined') {
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }
    }

    /* ── Export CSV ── */
    function exportDashboardSummaryCSV() {
        const rows = [
            ["Executive Metric", "Value"],
            ["Active Research Projects",     "<?= $stats['active_projects']   ?? 0 ?>"],
            ["Total Research Funding (₱)",   "<?= number_format($stats['total_funding'] ?? 0, 2) ?>"],
            ["Pending Proposal Approvals",    "<?= $stats['pending_proposals'] ?? 0 ?>"],
            ["Registered Faculty Researchers","<?= $stats['total_faculty']     ?? 0 ?>"]
        ];
        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const link = document.createElement("a");
        link.setAttribute("href", encodeURI(csvContent));
        link.setAttribute("download", `Executive_Research_Summary_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showToast('Report Exported', 'Executive research summary downloaded to CSV.');
    }

    /* ── Toast ── */
    function showToast(title, message) {
        document.getElementById('toastTitle').textContent   = title;
        document.getElementById('toastMessage').textContent = message;
        const toast = document.getElementById('actionToast');
        toast.classList.remove('d-none');
        setTimeout(() => toast.classList.add('d-none'), 4000);
    }
    function hideToast() {
        document.getElementById('actionToast').classList.add('d-none');
    }

    /* ── Chart.js: Area Chart (Funding Trend) ── */
    document.addEventListener('DOMContentLoaded', function () {
        const areaCtx = document.getElementById('myAreaChartCustom');
        if (areaCtx && typeof Chart !== 'undefined') {
            new Chart(areaCtx, {
                type: 'line',
                data: {
                    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                    datasets: [
                        {
                            label: 'Agriculture & Fisheries',
                            data: [1.2,1.4,1.8,2.1,2.0,1.9,2.3,2.5,2.4,2.8,3.0,3.2],
                            borderColor: '#800020',
                            backgroundColor: 'rgba(128,0,32,0.10)',
                            borderWidth: 2.5,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 3,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Engineering & ICT',
                            data: [0.8,1.0,1.1,1.3,1.5,1.6,1.4,1.7,1.9,2.0,2.2,2.3],
                            borderColor: '#0ea5e9',
                            backgroundColor: 'rgba(14,165,233,0.08)',
                            borderWidth: 2.5,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 3,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Health & Social Sciences',
                            data: [1.0,1.1,1.3,1.5,1.6,1.7,1.9,2.0,2.1,2.3,2.4,2.6],
                            borderColor: '#1abc9c',
                            backgroundColor: 'rgba(26,188,156,0.08)',
                            borderWidth: 2.5,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 3,
                            pointHoverRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'top', labels: { font: { size: 12 }, usePointStyle: true } },
                        tooltip: {
                            callbacks: {
                                label: ctx => ` ₱${ctx.parsed.y.toFixed(1)}M`
                            }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            ticks: { callback: v => '₱' + v + 'M' },
                            grid: { color: 'rgba(0,0,0,0.04)' }
                        }
                    }
                }
            });
        }

        /* ── Chart.js: Doughnut Chart (Proposals Status) ── */
        const pieCtx = document.getElementById('myPieChartCustom');
        if (pieCtx && typeof Chart !== 'undefined') {
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Approved', 'Under Review', 'Revision Needed'],
                    datasets: [{
                        data: [<?= $approved ?>, <?= $underReview ?>, <?= $revision ?>],
                        backgroundColor: ['#800020','#f6c23e','#e74a3b'],
                        hoverBackgroundColor: ['#5c0017','#e0a800','#c0392b'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => ` ${ctx.label}: ${ctx.parsed}`
                            }
                        }
                    }
                }
            });
        }
    });
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>
