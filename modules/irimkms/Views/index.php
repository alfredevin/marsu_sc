<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Design System & Dashboard Custom Styles -->
    <style>
        :root {
            --rmis-maroon: #800020;
            --rmis-maroon-dark: #5c0018;
            --rmis-gold: #FFD700;
            --rmis-gold-dark: #d4af37;
            --rmis-bg-light: #f8f9fc;
        }

        /* Remove SB Admin 2 default CSS arrow */
        .nav-link[data-toggle="collapse"]::after {
            display: none !important;
        }

        /* Sidebar styling overrides */
        .sidebar-brand {
            text-align: left !important;
            justify-content: flex-start !important;
            cursor: default !important;
            pointer-events: none !important;
        }

        #collapseTwo .collapse-item:hover,
        #collapseTwo .collapse-item:focus,
        #collapseTwo .collapse-item.active {
            background-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }

        #collapseTwo .collapse-item {
            border-radius: 6px;
        }

        /* Hero Welcome Banner */
        .hero-banner {
            background: linear-gradient(135deg, var(--rmis-maroon) 0%, var(--rmis-maroon-dark) 100%);
            border-radius: 16px;
            color: #ffffff;
            padding: 2rem 2.2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(128, 0, 32, 0.25);
            margin-bottom: 1.8rem;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 220px;
            height: 220px;
            background: rgba(255, 215, 0, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-badge {
            background: rgba(255, 215, 0, 0.2);
            color: var(--rmis-gold);
            border: 1px solid rgba(255, 215, 0, 0.4);
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.3rem 0.85rem;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Metric KPI Cards */
        .kpi-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e6f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            padding: 1.4rem 1.5rem;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(128, 0, 32, 0.12);
            border-color: rgba(128, 0, 32, 0.2);
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
        }

        .kpi-maroon::before {
            background: var(--rmis-maroon);
        }

        .kpi-gold::before {
            background: var(--rmis-gold-dark);
        }

        .kpi-warning::before {
            background: #f6c23e;
        }

        .kpi-success::before {
            background: #1cc88a;
        }

        .kpi-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .icon-maroon {
            background: rgba(128, 0, 32, 0.08);
            color: var(--rmis-maroon);
        }

        .icon-gold {
            background: rgba(255, 215, 0, 0.18);
            color: #b8860b;
        }

        .icon-warning {
            background: rgba(246, 194, 62, 0.12);
            color: #d69e2e;
        }

        .icon-success {
            background: rgba(28, 200, 138, 0.1);
            color: #1cc88a;
        }

        .kpi-value {
            font-size: 1.85rem;
            font-weight: 800;
            color: #2e384d;
            line-height: 1.1;
        }

        .kpi-title {
            font-size: 0.78rem;
            font-weight: 800;
            color: #858796;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .kpi-trend {
            font-size: 0.76rem;
            font-weight: 700;
            margin-top: 0.35rem;
        }

        /* Section Cards */
        .dashboard-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e6f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 1.8rem;
            overflow: hidden;
        }

        .dashboard-card-header {
            background: #ffffff;
            border-bottom: 1px solid #eaecf4;
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-card-header h6 {
            margin: 0;
            font-weight: 800;
            font-size: 0.95rem;
            color: var(--rmis-maroon);
        }

        /* Quick Module Access Buttons */
        .module-shortcut {
            background: #f8f9fc;
            border: 1.5px solid #e3e6f0;
            border-radius: 12px;
            padding: 1.1rem;
            text-align: center;
            transition: all 0.2s ease;
            text-decoration: none !important;
            display: block;
            color: #4a5568;
            height: 100%;
        }

        .module-shortcut:hover {
            background: #ffffff;
            border-color: var(--rmis-maroon);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(128, 0, 32, 0.1);
            color: var(--rmis-maroon);
        }

        .module-shortcut-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(128, 0, 32, 0.08);
            color: var(--rmis-maroon);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin: 0 auto 0.65rem auto;
            transition: all 0.2s ease;
        }

        .module-shortcut:hover .module-shortcut-icon {
            background: var(--rmis-maroon);
            color: #ffffff;
        }

        .module-shortcut-title {
            font-weight: 800;
            font-size: 0.85rem;
            line-height: 1.25;
        }

        /* Activity Timeline */
        .activity-item {
            position: relative;
            padding-left: 1.8rem;
            padding-bottom: 1.1rem;
            border-left: 2px solid #e3e6f0;
        }

        .activity-item:last-child {
            border-left-color: transparent;
            padding-bottom: 0;
        }

        .activity-dot {
            position: absolute;
            left: -7px;
            top: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--rmis-maroon);
            border: 2px solid #ffffff;
        }

        .activity-dot.dot-gold {
            background: var(--rmis-gold-dark);
        }

        .activity-dot.dot-success {
            background: #1cc88a;
        }

        .activity-time {
            font-size: 0.73rem;
            color: #858796;
            font-weight: 600;
        }

        .activity-desc {
            font-size: 0.84rem;
            color: #2e384d;
            font-weight: 700;
            margin-bottom: 0.1rem;
        }

        /* Table Filter Pills */
        .filter-pill {
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.35rem 0.85rem;
            border-radius: 50px;
            border: 1px solid #d1d3e2;
            background: #ffffff;
            color: #6e707e;
            cursor: pointer;
            transition: all 0.18s ease;
        }

        .filter-pill:hover,
        .filter-pill.active {
            background: var(--rmis-maroon);
            color: #ffffff;
            border-color: var(--rmis-maroon);
        }

        /* Buttons */
        .btn-maroon {
            background-color: var(--rmis-maroon);
            border-color: var(--rmis-maroon);
            color: #ffffff;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-maroon:hover {
            background-color: var(--rmis-maroon-dark);
            border-color: var(--rmis-maroon-dark);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.25);
        }

        .btn-gold {
            background-color: var(--rmis-gold);
            border-color: var(--rmis-gold);
            color: var(--rmis-maroon);
            font-weight: 800;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-gold:hover {
            background-color: #e6c200;
            border-color: #e6c200;
            color: var(--rmis-maroon-dark);
        }
    </style>

<div class="container-fluid px-4">

                    <!-- HERO WELCOME BANNER -->
                    <div class="hero-banner d-flex align-items-center justify-content-between flex-wrap">
                        <div style="z-index: 1;">
                            <span class="hero-badge">
                                <i class="fas fa-university mr-1"></i> Marinduque State University RMIS
                            </span>
                            <h2 style="font-weight: 900; font-size: 1.75rem; margin-bottom: 0.35rem; color: #ffffff;">
                                Welcome Back, <?= e($user['full_name'] ?? 'Researcher') ?>
                            </h2>
                            <p
                                style="font-size: 0.92rem; color: rgba(255, 255, 255, 0.88); margin-bottom: 0; max-width: 650px;">
                                Oversee ongoing university research projects, approve pending proposals,
                                and access institutional repository documents in real-time.
                            </p>
                        </div>
                        <div class="mt-3 mt-lg-0 d-flex gap-2" style="z-index: 1;">
                            <a href="proposalsandapprovals.html#submit" class="btn btn-gold btn-sm px-3 py-2 shadow-sm mr-2">
                                <i class="fas fa-plus-circle mr-1"></i> Submit Proposal
                            </a>
                            <button class="btn btn-light text-dark font-weight-bold btn-sm px-3 py-2 shadow-sm"
                                data-toggle="modal" data-target="#exportModal">
                                <i class="fas fa-download mr-1"></i> Export Report
                            </button>
                        </div>
                    </div>

                    <!-- EXECUTIVE KPI STATS ROW -->
                    <div class="row mb-4">

                        <!-- Active Projects Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="kpi-card kpi-maroon d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="kpi-title">Active Projects</div>
                                    <div class="kpi-value mt-1"><?= (int)($stats['active_projects'] ?? 0) ?></div>
                                    <div class="kpi-trend text-success">
                                        <i class="fas fa-arrow-up mr-1"></i>+12% vs last quarter
                                    </div>
                                </div>
                                <div class="kpi-icon icon-maroon">
                                    <i class="fas fa-flask"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Total Research Grants Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="kpi-card kpi-gold d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="kpi-title">Total Research Funding</div>
                                    <div class="kpi-value mt-1">₱<?= number_format(($stats['total_funding'] ?? 0) / 1000000, 1) ?>M</div>
                                    <div class="kpi-trend text-muted">
                                        <i class="fas fa-chart-line mr-1"></i>84% Funding Allocated
                                    </div>
                                </div>
                                <div class="kpi-icon icon-gold">
                                    <i class="fas fa-coins"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Approvals Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="kpi-card kpi-warning d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="kpi-title">Pending Approvals</div>
                                    <div class="kpi-value mt-1"><?= (int)($stats['pending_proposals'] ?? 0) ?></div>
                                    <div class="kpi-trend text-warning font-weight-bold">
                                        <i class="fas fa-exclamation-circle mr-1"></i>Action Required
                                    </div>
                                </div>
                                <div class="kpi-icon icon-warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Published Papers Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="kpi-card kpi-success d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="kpi-title">Publications & IP Assets</div>
                                    <div class="kpi-value mt-1"><?= (int)($stats['total_faculty'] ?? 0) ?></div>
                                    <div class="kpi-trend text-success">
                                        <i class="fas fa-check-double mr-1"></i>Scopus & CHED Accredited
                                    </div>
                                </div>
                                <div class="kpi-icon icon-success">
                                    <i class="fas fa-award"></i>
                                </div>
                            </div>
                        </div>

                    </div>



                    <!-- CHARTS & VISUAL ANALYTICS SECTION -->
                    <div class="row">

                        <!-- Main Area Chart: Funding & Proposals Trend -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="dashboard-card mb-4">
                                <div
                                    class="dashboard-card-header d-flex flex-row align-items-center justify-content-between">
                                    <h6><i class="fas fa-chart-area mr-2"></i>University Funding Allocation Trend (2026)
                                    </h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Export Options:</div>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-file-pdf text-danger mr-2"></i>Download PDF</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-file-excel text-success mr-2"></i>Export CSV</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area" style="height: 310px;">
                                        <canvas id="myAreaChartCustom"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row text-center small mt-2">
                                        <div class="col-4">
                                            <span class="font-weight-bold text-dark">Agriculture & Fisheries</span>
                                            <div class="text-maroon font-weight-bold">₱18.4M</div>
                                        </div>
                                        <div class="col-4">
                                            <span class="font-weight-bold text-dark">Engineering & ICT</span>
                                            <div class="text-info font-weight-bold">₱14.8M</div>
                                        </div>
                                        <div class="col-4">
                                            <span class="font-weight-bold text-dark">Health & Social Sciences</span>
                                            <div class="text-success font-weight-bold">₱15.3M</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart: Proposal Status Distribution -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="dashboard-card mb-4">
                                <div
                                    class="dashboard-card-header d-flex flex-row align-items-center justify-content-between">
                                    <h6><i class="fas fa-chart-pie mr-2"></i>Proposals Breakdown</h6>
                                    <span class="badge badge-light text-dark font-weight-bold">Q3 Status</span>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-2 pb-2" style="height: 250px;">
                                        <canvas id="myPieChartCustom"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <?php
                                            $approvedCount = 0; $underReviewCount = 0; $revisionCount = 0;
                                            foreach ($proposals as $_p) {
                                                if ($_p['status'] === 'Approved') $approvedCount++;
                                                elseif ($_p['status'] === 'Under Review') $underReviewCount++;
                                                elseif ($_p['status'] === 'Revision Needed') $revisionCount++;
                                            }
                                        ?>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color: #800020;"></i> Approved (<?= $approvedCount ?>)
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color: #f6c23e;"></i> Under Review (<?= $underReviewCount ?>)
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color: #e74a3b;"></i> Revision (<?= $revisionCount ?>)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- LOWER DATA GRID: RECENT PROPOSALS & LIVE ACTIVITY STREAM -->
                    <div class="row">

                        <!-- Recent Research Proposals Table -->
                        <div class="col-xl-8 col-lg-7 mb-4">
                            <div class="dashboard-card h-100">
                                <div
                                    class="dashboard-card-header d-flex align-items-center justify-content-between flex-wrap">
                                    <h6><i class="fas fa-clipboard-list mr-2"></i>Recent Research Submissions & Status
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-items-center mb-0"
                                            style="font-size: 0.86rem;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="border-top:none;">Project ID</th>
                                                    <th style="border-top:none;">Research Title</th>
                                                    <th style="border-top:none;">Lead Researcher</th>
                                                    <th style="border-top:none;">Status</th>
                                                    <th style="border-top:none; text-align:right;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $statusBadge = [
                                                    'Approved'       => 'badge-success',
                                                    'Under Review'   => 'badge-warning text-dark',
                                                    'Revision Needed'=> 'badge-danger',
                                                    'Rejected'       => 'badge-secondary',
                                                ];
                                                $recentProposals = array_slice($proposals, 0, 5);
                                                if (empty($recentProposals)): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted py-4">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        No research submissions found.
                                                    </td>
                                                </tr>
                                                <?php else: foreach ($recentProposals as $_prop): ?>
                                                <tr>
                                                    <td class="font-weight-bold text-dark"><?= e($_prop['code']) ?></td>
                                                    <td>
                                                        <div class="font-weight-bold text-dark"><?= e($_prop['title']) ?></div>
                                                        <span class="text-muted small"><?= e($_prop['college'] ?? '') ?></span>
                                                    </td>
                                                    <td><?= e($_prop['pi_name']) ?></td>
                                                    <td>
                                                        <span class="badge <?= $statusBadge[$_prop['status']] ?? 'badge-secondary' ?> px-2 py-1">
                                                            <?= e($_prop['status']) ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="<?= url('irimkms/proposalsandapprovals') ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top text-center py-3">
                                    <a href="ResearchDatabase.html"
                                        class="text-maroon font-weight-bold small text-decoration-none">
                                        View Full Research Database <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- System Activity Stream & Upcoming Deadlines -->
                        <div class="col-xl-4 col-lg-5 mb-4">

                            <!-- Upcoming Milestones Widget -->
                            <div class="dashboard-card mb-4">
                                <div class="dashboard-card-header">
                                    <h6><i class="fas fa-calendar-alt mr-2"></i>Upcoming Milestones Due</h6>
                                    <span class="badge badge-warning px-2 py-1">3 This Week</span>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="font-weight-bold small text-dark">Q3 Financial Audit
                                                Reports</span>
                                            <span class="badge badge-danger">Oct 5</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 85%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="font-weight-bold small text-dark">CHED Institutional Grant
                                                Evaluation</span>
                                            <span class="badge badge-warning text-dark">Oct 12</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="font-weight-bold small text-dark">Annual Research Presentation
                                                Forum</span>
                                            <span class="badge badge-info">Oct 28</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 35%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Live Activity Log -->
                            <div class="dashboard-card">
                                <div class="dashboard-card-header">
                                    <h6><i class="fas fa-history mr-2"></i>Recent System Activity</h6>
                                    <span class="text-muted small">Real-time</span>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <div class="activity-dot"></div>
                                        <div class="activity-time">10 minutes ago</div>
                                        <div class="activity-desc">Dr. Juan dela Cruz submitted Quarter 3 Progress
                                            Report for RES-2026-089.</div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-dot dot-gold"></div>
                                        <div class="activity-time">1 hour ago</div>
                                        <div class="activity-desc">Evaluation Committee assigned 3 peer reviewers to
                                            RES-2026-092.</div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-dot dot-success"></div>
                                        <div class="activity-time">3 hours ago</div>
                                        <div class="activity-desc">₱1.45M Research Grant disbursed for Smart
                                            Agriculture Project.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Chart.js v4 from local vendor -->
    <script src="<?= asset('vendor/chart.js/chart.umd.min.js') ?>"></script>

    <!-- Custom Dashboard Charts Initialization Script (Chart.js v4) -->
    <script>
        // ── Area Chart: University Funding Allocation Trend 2026 ──────────────
        (function () {
            var ctxArea = document.getElementById('myAreaChartCustom');
            if (!ctxArea) return;

            new Chart(ctxArea, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    datasets: [
                        {
                            label: 'Agriculture & Fisheries (₱M)',
                            tension: 0.4,
                            fill: true,
                            backgroundColor: 'rgba(128, 0, 32, 0.08)',
                            borderColor: '#800020',
                            borderWidth: 2.5,
                            pointRadius: 4,
                            pointBackgroundColor: '#800020',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#FFD700',
                            data: [1.8, 2.4, 2.9, 3.5, 3.2, 4.1, 3.8, 4.6, 3.9]
                        },
                        {
                            label: 'Engineering & ICT (₱M)',
                            tension: 0.4,
                            fill: true,
                            backgroundColor: 'rgba(54, 162, 235, 0.07)',
                            borderColor: '#3b82f6',
                            borderWidth: 2.5,
                            pointRadius: 4,
                            pointBackgroundColor: '#3b82f6',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#FFD700',
                            data: [1.2, 1.8, 2.2, 2.6, 3.0, 2.8, 3.4, 3.1, 3.7]
                        },
                        {
                            label: 'Health & Social Sciences (₱M)',
                            tension: 0.4,
                            fill: true,
                            backgroundColor: 'rgba(28, 200, 138, 0.07)',
                            borderColor: '#1cc88a',
                            borderWidth: 2.5,
                            pointRadius: 4,
                            pointBackgroundColor: '#1cc88a',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#FFD700',
                            data: [1.5, 1.9, 2.3, 2.1, 2.7, 2.4, 3.1, 2.8, 3.5]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    layout: { padding: { left: 8, right: 20, top: 20, bottom: 0 } },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 16,
                                font: { size: 11, weight: '700' },
                                color: '#4a5568'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#800020',
                            bodyColor: '#858796',
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 14,
                            callbacks: {
                                label: function (ctx) {
                                    return ' ' + ctx.dataset.label + ': ₱' + ctx.parsed.y.toFixed(1) + 'M';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#858796', font: { size: 11 } }
                        },
                        y: {
                            grid: { color: 'rgba(234,236,244,0.8)', drawBorder: false },
                            ticks: {
                                maxTicksLimit: 6,
                                padding: 10,
                                color: '#858796',
                                font: { size: 11 },
                                callback: function (v) { return '₱' + v.toFixed(1) + 'M'; }
                            }
                        }
                    }
                }
            });
        })();

        // ── Donut Chart: Proposals Breakdown ─────────────────────────────────
        (function () {
            var ctxPie = document.getElementById('myPieChartCustom');
            if (!ctxPie) return;

            var approved    = <?= (int)($approvedCount    ?? 0) ?>;
            var underReview = <?= (int)($underReviewCount ?? 0) ?>;
            var revision    = <?= (int)($revisionCount    ?? 0) ?>;

            // If all zero, show placeholder data so chart isn't blank
            if (approved + underReview + revision === 0) {
                approved = 0; underReview = 0; revision = 0;
            }

            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: ['Approved', 'Under Review', 'Revision Needed'],
                    datasets: [{
                        data: [approved, underReview, revision],
                        backgroundColor: ['#800020', '#f6c23e', '#e74a3b'],
                        hoverBackgroundColor: ['#5c0018', '#dfa824', '#be2617'],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverBorderColor: '#ffffff'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#800020',
                            bodyColor: '#858796',
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 14,
                            callbacks: {
                                label: function (ctx) {
                                    var total = ctx.dataset.data.reduce(function(a,b){return a+b;},0);
                                    var pct = total > 0 ? Math.round(ctx.parsed / total * 100) : 0;
                                    return ' ' + ctx.label + ': ' + ctx.parsed + ' (' + pct + '%)';
                                }
                            }
                        }
                    }
                }
            });
        })();
    </script>