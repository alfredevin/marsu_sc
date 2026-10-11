<div class="container-fluid py-3" id="performanceIndicatorsRoot">

    <!-- CSS & Custom Styling -->
    <style>
        #performanceIndicatorsRoot, #performanceIndicatorsRoot * {
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

        .college-prod-row {
            padding: 12px 14px;
            border-radius: 8px;
            background: #fafbfc;
            border: 1px solid #f1f3f9;
            margin-bottom: 12px;
            transition: all 0.2s;
        }
        .college-prod-row:hover {
            background: #fff;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.08);
            border-color: rgba(128, 0, 32, 0.2);
        }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 300px;
        }

        /* Standard Uniform MarSU Design System */
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
            <span class="hero-badge-tag"><i class="fas fa-chart-line me-1"></i> SUC Leveling & Strategic Benchmarks</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-chart-bar me-2 text-warning"></i>Performance Indicators & Analytics Dashboard
            </h1>
            <p class="page-hero-subtitle">
                Monitor institutional research productivity, publication citations, grant budget utilization, patent filings, and UN SDG alignment metrics.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#kpiTargetModal">
                <i class="fas fa-bullseye me-1"></i> Configure Targets
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="exportAnalyticsCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Report
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
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill active"><i class="bi bi-graph-up-arrow text-white me-1"></i> Performance Analytics</a>
    </div>

    <!-- Top Executive KPI Metric Cards (Row 1) -->
    <div class="row mb-4">
        <!-- Card 1: Annual Research Budget Utilization -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                                Research Budget Utilization
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">₱ 13,053,600.00</div>
                            <div class="row no-gutters align-items-center mt-2">
                                <div class="col-auto me-2">
                                    <div class="text-xs font-weight-bold text-maroon">88.2% Spent</div>
                                </div>
                                <div class="col">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-maroon" role="progressbar" style="width: 88%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Indexed Publications -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Scopus / WoS Publications
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">142 Papers</div>
                            <div class="text-xs text-success font-weight-bold mt-1">
                                <i class="fas fa-arrow-up me-1"></i>+18.5% YoY (Target: 150)
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Patents & Utility Models -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-gold shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Patents & IP Filings
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">28 Filings</div>
                            <div class="text-xs text-muted mt-1">
                                <i class="fas fa-certificate text-warning me-1"></i>12 Granted by IPOPHL
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-award fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Active Projects -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Active Research Projects
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">64 Projects</div>
                            <div class="text-xs text-muted mt-1">
                                <i class="fas fa-university text-info me-1"></i>Across 8 Colleges
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Visual Cards (Row 2) -->
    <div class="row mb-4">
        <!-- Left: College Research Productivity & Index -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-maroon">
                        <i class="fas fa-university me-2"></i>College Research Productivity Ranking (FY 2026)
                    </h6>
                    <span class="badge bg-maroon text-white px-2 py-1">CHED SUC Leveling Index</span>
                </div>
                <div class="card-body">
                    <!-- College 1 -->
                    <div class="college-prod-row">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-gray-800">1. College of Science & Mathematics (CSM)</span>
                            <span class="badge bg-success font-weight-bold">92% Index (Rank 1)</span>
                        </div>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-maroon" role="progressbar" style="width: 92%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-xs text-muted">
                            <span>42 Scopus Papers</span>
                            <span>₱ 4,200,000 Utilized</span>
                            <span>12 IP Filings</span>
                        </div>
                    </div>

                    <!-- College 2 -->
                    <div class="college-prod-row">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-gray-800">2. College of Agriculture (COA)</span>
                            <span class="badge bg-success font-weight-bold">88% Index (Rank 2)</span>
                        </div>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-maroon" role="progressbar" style="width: 88%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-xs text-muted">
                            <span>34 Scopus Papers</span>
                            <span>₱ 3,850,000 Utilized</span>
                            <span>8 IP Filings</span>
                        </div>
                    </div>

                    <!-- College 3 -->
                    <div class="college-prod-row">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-gray-800">3. College of Engineering (COE)</span>
                            <span class="badge bg-info font-weight-bold">84% Index (Rank 3)</span>
                        </div>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 84%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-xs text-muted">
                            <span>28 Scopus Papers</span>
                            <span>₱ 2,900,000 Utilized</span>
                            <span>6 IP Filings</span>
                        </div>
                    </div>

                    <!-- College 4 -->
                    <div class="college-prod-row">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-gray-800">4. College of Health Sciences (CHS)</span>
                            <span class="badge bg-info font-weight-bold">79% Index (Rank 4)</span>
                        </div>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 79%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-xs text-muted">
                            <span>22 Scopus Papers</span>
                            <span>₱ 1,400,000 Utilized</span>
                            <span>2 IP Filings</span>
                        </div>
                    </div>

                    <!-- College 5 -->
                    <div class="college-prod-row mb-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-gray-800">5. College of Information Technology (CIT)</span>
                            <span class="badge bg-warning text-dark font-weight-bold">76% Index (Rank 5)</span>
                        </div>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 76%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-xs text-muted">
                            <span>16 Scopus Papers</span>
                            <span>₱ 703,600 Utilized</span>
                            <span>4 IP Filings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: UN SDG Alignment Breakdown -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-maroon">
                        <i class="fas fa-globe me-2"></i>UN SDG Alignment Breakdown
                    </h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-bold text-gray-800">SDG 2: Zero Hunger</span>
                            <span class="small font-weight-bold text-success">28% (18 Proj)</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 28%;"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-bold text-gray-800">SDG 3: Good Health & Wellbeing</span>
                            <span class="small font-weight-bold text-info">24% (15 Proj)</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 24%;"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-bold text-gray-800">SDG 9: Industry & Innovation</span>
                            <span class="small font-weight-bold text-maroon">22% (14 Proj)</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-maroon" role="progressbar" style="width: 22%;"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-bold text-gray-800">SDG 13: Climate Action</span>
                            <span class="small font-weight-bold text-secondary">16% (10 Proj)</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 16%;"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-bold text-gray-800">SDG 14/15: Life Below Water & Land</span>
                            <span class="small font-weight-bold text-warning">10% (7 Proj)</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded border border-maroon">
                        <div class="d-flex align-items-center mb-1 text-maroon">
                            <i class="fas fa-leaf me-2"></i>
                            <strong class="small">SDG Impact Benchmark</strong>
                        </div>
                        <p class="small text-muted mb-2">
                            100% of internal GAA research grants are tagged to specific UN Sustainable Development Goals for international ranking.
                        </p>
                        <button class="btn btn-sm btn-maroon w-100 font-weight-bold" onclick="showToast('SDG Report Exported', 'UN SDG Research Matrix downloaded.')">
                            Export SDG Analytics Matrix
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Strategic KPI Performance Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-maroon">
                <i class="fas fa-table me-2"></i>Institutional Strategic Key Performance Indicators (KPI Tracker)
            </h6>
            <span class="badge bg-warning text-dark px-2 py-1 font-weight-bold">SUC Leveling Compliance</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="kpiTable">
                    <thead class="bg-maroon text-white">
                        <tr>
                            <th>KPI Code</th>
                            <th>Indicator Description</th>
                            <th>Annual Target</th>
                            <th>Actual Accomplishment</th>
                            <th>Variance</th>
                            <th>Compliance Level</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold"><span class="badge bg-light text-dark border">KPI-PUB-01</span></td>
                            <td>Scopus & Web of Science Indexed Publications</td>
                            <td>140 Papers</td>
                            <td class="font-weight-bold text-success">142 Papers</td>
                            <td class="text-success font-weight-bold">+2 (+1.4%)</td>
                            <td><span class="badge bg-success text-white">EXCEEDED</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-maroon" onclick="openKpiDossierModal('KPI-PUB-01', 'Scopus & WoS Publications', '140 Papers', '142 Papers', '+2 (+1.4%)', 'EXCEEDED')">
                                    <i class="fas fa-eye me-1"></i> Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold"><span class="badge bg-light text-dark border">KPI-IP-02</span></td>
                            <td>Patents, Utility Models & Copyright Registrations</td>
                            <td>25 Filings</td>
                            <td class="font-weight-bold text-success">28 Filings</td>
                            <td class="text-success font-weight-bold">+3 (+12.0%)</td>
                            <td><span class="badge bg-success text-white">EXCEEDED</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-maroon" onclick="openKpiDossierModal('KPI-IP-02', 'Patents & IP Filings', '25 Filings', '28 Filings', '+3 (+12.0%)', 'EXCEEDED')">
                                    <i class="fas fa-eye me-1"></i> Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold"><span class="badge bg-light text-dark border">KPI-GAA-03</span></td>
                            <td>GAA Research Grant Financial Liquidation Rate</td>
                            <td>90.0%</td>
                            <td class="font-weight-bold text-info">88.2%</td>
                            <td class="text-danger font-weight-bold">-1.8%</td>
                            <td><span class="badge bg-info text-white">ON TARGET</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-maroon" onclick="openKpiDossierModal('KPI-GAA-03', 'GAA Financial Liquidation', '90.0%', '88.2%', '-1.8%', 'ON TARGET')">
                                    <i class="fas fa-eye me-1"></i> Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold"><span class="badge bg-light text-dark border">KPI-EXT-04</span></td>
                            <td>Technology Adoption & Community Extension Projects</td>
                            <td>15 Projects</td>
                            <td class="font-weight-bold text-success">16 Projects</td>
                            <td class="text-success font-weight-bold">+1 (+6.7%)</td>
                            <td><span class="badge bg-success text-white">EXCEEDED</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-maroon" onclick="openKpiDossierModal('KPI-EXT-04', 'Technology Adoption', '15 Projects', '16 Projects', '+1 (+6.7%)', 'EXCEEDED')">
                                    <i class="fas fa-eye me-1"></i> Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold"><span class="badge bg-light text-dark border">KPI-CIT-05</span></td>
                            <td>Citations per Faculty Member Index</td>
                            <td>4.50 Citations</td>
                            <td class="font-weight-bold text-warning">4.20 Citations</td>
                            <td class="text-danger font-weight-bold">-0.30</td>
                            <td><span class="badge bg-warning text-dark font-weight-bold">NEAR TARGET</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-maroon" onclick="openKpiDossierModal('KPI-CIT-05', 'Citations Index', '4.50 Citations', '4.20 Citations', '-0.30', 'NEAR TARGET')">
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
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: CONFIGURE TARGETS MODAL                                                     -->
<!-- ==================================================================================== -->
<div class="modal fade" id="kpiTargetModal" tabindex="-1" aria-labelledby="kpiTargetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="kpiTargetModalLabel">
                    <i class="fas fa-bullseye me-2"></i>Configure Strategic Institutional Targets
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="kpiTargetForm" onsubmit="handleTargetSubmit(event)">
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="fas fa-info-circle me-1 text-maroon"></i> Adjust baseline targets for CHED SUC Leveling, Scopus publication thresholds, and research budget utilization.
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Target Indicator</label>
                        <select class="form-select" id="targetIndicatorSelect">
                            <option value="Scopus & WoS Indexed Publications">Scopus & WoS Indexed Publications (KPI-PUB-01)</option>
                            <option value="Patents & IP Filings">Patents & IP Filings (KPI-IP-02)</option>
                            <option value="GAA Budget Liquidation Rate">GAA Budget Liquidation Rate (KPI-GAA-03)</option>
                            <option value="Technology Adoption Projects">Technology Adoption Projects (KPI-EXT-04)</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Current Target</label>
                            <input type="text" class="form-control" id="targetCurrentVal" value="140 Papers" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Proposed Target <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="targetNewVal" placeholder="e.g. 160 Papers" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Target Fiscal Year</label>
                        <select class="form-select" id="targetFY">
                            <option value="FY 2026" selected>FY 2026</option>
                            <option value="FY 2027">FY 2027</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm shadow-sm">
                        <i class="fas fa-save me-1"></i> Update Target
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: KPI DOSSIER INSPECTOR                                                      -->
<!-- ==================================================================================== -->
<div class="modal fade" id="kpiDossierModal" tabindex="-1" aria-labelledby="kpiDossierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="kpiDossierModalTitle">
                    <i class="fas fa-chart-pie me-2"></i>KPI Indicator Analysis
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-maroon text-white font-weight-bold fs-6" id="dossierKpiCode">KPI-01</span>
                    <span class="badge bg-success text-white px-3 py-1 font-weight-bold" id="dossierKpiStatus">EXCEEDED</span>
                </div>

                <h5 class="font-weight-bold text-dark mb-3" id="dossierKpiTitle">Indicator Title</h5>

                <div class="p-3 bg-light rounded border mb-4">
                    <div class="row text-center">
                        <div class="col-4 border-end">
                            <small class="text-muted d-block text-uppercase font-weight-bold text-xs">Annual Target</small>
                            <strong class="text-dark fs-6" id="dossierKpiTarget">140</strong>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted d-block text-uppercase font-weight-bold text-xs">Accomplishment</small>
                            <strong class="text-success fs-6" id="dossierKpiActual">142</strong>
                        </div>
                        <div class="col-4">
                            <small class="text-muted d-block text-uppercase font-weight-bold text-xs">Variance</small>
                            <strong class="text-maroon fs-6" id="dossierKpiVariance">+2</strong>
                        </div>
                    </div>
                </div>

                <div class="small text-muted">
                    <i class="fas fa-info-circle text-maroon me-1"></i> Measured against CHED State Universities & Colleges (SUC) Leveling Standard Metrics.
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
    function openKpiDossierModal(code, title, target, actual, variance, status) {
        document.getElementById('dossierKpiCode').textContent = code;
        document.getElementById('dossierKpiTitle').textContent = title;
        document.getElementById('dossierKpiTarget').textContent = target;
        document.getElementById('dossierKpiActual').textContent = actual;
        document.getElementById('dossierKpiVariance').textContent = variance;
        document.getElementById('dossierKpiStatus').textContent = status;

        const modalEl = document.getElementById('kpiDossierModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function handleTargetSubmit(event) {
        event.preventDefault();
        const indicator = document.getElementById('targetIndicatorSelect').value;
        const newVal = document.getElementById('targetNewVal').value;

        const modalEl = document.getElementById('kpiTargetModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        showToast('Target Configured', `Updated target for ${indicator} to ${newVal}!`);
    }

    function exportAnalyticsCSV() {
        const rows = [["KPI Code", "Indicator Description", "Annual Target", "Actual Accomplishment", "Variance", "Compliance Level"]];

        document.querySelectorAll('#kpiTable tbody tr').forEach(row => {
            const cols = row.querySelectorAll('td');
            if (cols.length >= 6) {
                const code = cols[0].innerText.trim();
                const desc = cols[1].innerText.trim();
                const target = cols[2].innerText.trim();
                const actual = cols[3].innerText.trim();
                const variance = cols[4].innerText.trim();
                const status = cols[5].innerText.trim();

                rows.push([`"${code}"`, `"${desc}"`, `"${target}"`, `"${actual}"`, `"${variance}"`, `"${status}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Institutional_KPI_Analytics_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Analytics Exported', 'Key Performance Indicators report downloaded as CSV.');
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