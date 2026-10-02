<!-- Print-Only Header -->
<div class="print-header">
    <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo" style="width: 60px; height: 60px;" class="mb-2">
    <h2>Marinduque State University</h2>
    <p class="font-weight-bold">College of Information and Computing Sciences &bull; Santa Cruz Campus</p>
    <p>Brgy. Matalaba / Poblacion, Santa Cruz, Marinduque 4902</p>
    <p class="small text-muted">Executive Power BI Multi-Module Analytics Canvas &bull; Generated on <?= date('F j, Y, g:i A') ?></p>
</div>

<!-- ==========================================================================
     POWER BI EXECUTIVE COMMAND BAR & DATA SLICERS (SANTA CRUZ ONLY)
     ========================================================================== -->
<div class="pbi-command-bar no-print mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <!-- Title & Power BI Branding -->
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-warning text-dark fw-bold px-2 py-1" style="font-size: 0.7rem; letter-spacing: 0.03em;">
                    <i class="bi bi-bar-chart-steps me-1"></i> POWER BI INSIGHTS
                </span>
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1" style="font-size: 0.7rem;">
                    <i class="bi bi-broadcast me-1"></i> Live Stream &bull; Connected
                </span>
                <span class="badge bg-burgundy text-white px-2 py-1" style="font-size: 0.7rem;">
                    <i class="bi bi-geo-alt-fill text-gold me-1"></i>Santa Cruz Campus (MQE)
                </span>
            </div>
            <h1 class="h4 font-weight-bold text-marsu-burgundy mb-0" style="letter-spacing: -0.02em;">
                Executive BI Dashboard &bull; Santa Cruz Campus
            </h1>
            <p class="text-muted small mb-0" style="font-size: 0.8rem;">
                Unified 10-module institutional intelligence, predictive analytics, and academic KPIs for MarSU Santa Cruz.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1" onclick="toggleFullscreenCanvas()" id="fullscreenBtn" title="Toggle Fullscreen View">
                <i class="bi bi-arrows-fullscreen"></i>
                <span class="d-none d-sm-inline">Canvas Fullscreen</span>
            </button>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                <i class="bi bi-printer"></i>
                <span class="d-none d-sm-inline">Export PDF</span>
            </button>
            <a href="<?= url('dashboard') ?>" class="btn btn-marsu btn-sm d-flex align-items-center gap-1" title="Synchronize Live Telemetry">
                <i class="bi bi-arrow-clockwise"></i>
                <span>Sync Data</span>
            </a>
        </div>
    </div>

    <!-- Power BI Slicers Row (Interactive Filters - Santa Cruz & Academic Degrees Only) -->
    <div class="pt-3 mt-3 border-top border-secondary border-opacity-10 d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Term Slicer -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem;">
                <i class="bi bi-calendar-check text-gold me-1"></i>Term:
            </span>
            <div class="d-flex flex-wrap align-items-center gap-1" id="termSlicer">
                <span class="pbi-slicer-pill active" data-slicer="term" data-val="curr" onclick="applySlicer(this, 'term')">
                    AY 2026-2027 (1st Sem)
                </span>
                <span class="pbi-slicer-pill" data-slicer="term" data-val="prev" onclick="applySlicer(this, 'term')">
                    AY 2025-2026
                </span>
                <span class="pbi-slicer-pill" data-slicer="term" data-val="all" onclick="applySlicer(this, 'term')">
                    Multi-Year Trend
                </span>
            </div>
        </div>

        <!-- Academic Program Slicer (Santa Cruz Degrees) -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem;">
                <i class="bi bi-mortarboard-fill text-gold me-1"></i>Programs:
            </span>
            <div class="d-flex flex-wrap align-items-center gap-1" id="progSlicer">
                <span class="pbi-slicer-pill active" data-slicer="prog" data-val="ALL" onclick="filterByProgram(this, 'ALL')">
                    All (867)
                </span>
                <span class="pbi-slicer-pill" data-slicer="prog" data-val="BSTM" onclick="filterByProgram(this, 'BSTM')">
                    BSTM (398)
                </span>
                <span class="pbi-slicer-pill" data-slicer="prog" data-val="BSIS" onclick="filterByProgram(this, 'BSIS')">
                    BSIS (192)
                </span>
                <span class="pbi-slicer-pill" data-slicer="prog" data-val="BAPoS" onclick="filterByProgram(this, 'BAPoS')">
                    BAPoS (154)
                </span>
                <span class="pbi-slicer-pill" data-slicer="prog" data-val="BEED" onclick="filterByProgram(this, 'BEED')">
                    BEED (123)
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     POWER BI MULTI-ROW KPI METRIC CARDS (6 HIGH-DENSITY TILES)
     ========================================================================== -->
<div class="row g-3 mb-4">
    <!-- 1. Active Enrolled Students -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-burgundy" role="button" onclick="switchPbiTabByName('tabAcademic')" title="Click to view Academic BI">
            <div class="pbi-metric-label">Active Enrollment</div>
            <div class="pbi-metric-value text-marsu-burgundy" id="kpiActiveStudents"><?= number_format($totalStudents) ?></div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-positive">
                    <i class="bi bi-arrow-up-short"></i>+8.4% YoY
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">Target: 900</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-marsu" id="kpiEnrollmentProgress" style="width: <?= min(100, round(($totalStudents / 900) * 100)) ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 2. Faculty & Staff -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-gold" role="button" onclick="switchPbiTabByName('tabGovernance')" title="Click to view Faculty Workload">
            <div class="pbi-metric-label">Faculty &amp; Staff</div>
            <div class="pbi-metric-value text-gold"><?= number_format($totalEmployees) ?></div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-info">
                    <i class="bi bi-people"></i> Ratio <?= $studentFacultyRatio ?>:1
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">CHED Norm</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-gold" style="width: 88%;"></div>
            </div>
        </div>
    </div>

    <!-- 3. Student Retention Index -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-emerald" role="button" onclick="switchPbiTabByName('tabOverview')" title="Click to view Retention Analytics">
            <div class="pbi-metric-label">Retention Index</div>
            <div class="pbi-metric-value text-success"><?= $retentionScore ?>%</div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-positive">
                    <i class="bi bi-shield-check"></i> 822 Safe
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">9 Flagged</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-success" style="width: <?= $retentionScore ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 4. Online Student Clearance -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-sapphire" role="button" onclick="switchPbiTabByName('tabOverview')" title="Click to view Clearance Funnel">
            <div class="pbi-metric-label">Clearance Rate</div>
            <div class="pbi-metric-value text-primary"><?= $clearanceRate ?>%</div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-info">
                    <i class="bi bi-check2-all"></i> 768 / 867
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">6 Offices</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-primary" style="width: <?= $clearanceRate ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 5. Campus Housing (ISHAMIS) -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-purple" role="button" onclick="switchPbiTabByName('tabWelfare')" title="Click to view Housing Analytics">
            <div class="pbi-metric-label">Housing Occupancy</div>
            <div class="pbi-metric-value" style="color: #8B5CF6;"><?= $housingCapacity ?>%</div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill" style="background: rgba(139, 92, 246, 0.12); color: #8B5CF6;">
                    <i class="bi bi-house-door"></i> 142 / 170 Beds
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">9 Houses</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill" style="background: #8B5CF6; width: <?= $housingCapacity ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 6. Student Welfare Grantees -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-amber" role="button" onclick="switchPbiTabByName('tabWelfare')" title="Click to view Scholarships">
            <div class="pbi-metric-label">Welfare Grantees</div>
            <div class="pbi-metric-value" style="color: #D97706;"><?= array_sum($welfareStats['grantees']) ?></div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-warning">
                    <i class="bi bi-patch-check"></i> UniFAST / LGU
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;"><?= $welfareStats['total_disbursed'] ?></span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-warning" style="width: 92%;"></div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     POWER BI CANVAS TABS NAVIGATION (4 SPECIALIZED ANALYTICS PANES)
     ========================================================================== -->
<div class="pbi-tab-nav no-print" id="pbiTabNav">
    <button type="button" class="pbi-tab-btn active" id="btnTabOverview" onclick="switchPbiTab(this, 'tabOverview')">
        <i class="bi bi-grid-1x2-fill"></i> 1. Executive Intelligence &amp; Clearance Pipeline
    </button>
    <button type="button" class="pbi-tab-btn" id="btnTabAcademic" onclick="switchPbiTab(this, 'tabAcademic')">
        <i class="bi bi-journal-bookmark-fill"></i> 2. Curricular &amp; Student BI
    </button>
    <button type="button" class="pbi-tab-btn" id="btnTabWelfare" onclick="switchPbiTab(this, 'tabWelfare')">
        <i class="bi bi-heart-pulse-fill"></i> 3. Housing (ISHAMIS), Clinic &amp; Guidance
    </button>
    <button type="button" class="pbi-tab-btn" id="btnTabGovernance" onclick="switchPbiTab(this, 'tabGovernance')">
        <i class="bi bi-shield-check"></i> 4. Campus Governance, Workload &amp; IT Assets
    </button>
</div>

<!-- ==========================================================================
     TAB 1: EXECUTIVE INTELLIGENCE & CLEARANCE PIPELINE
     ========================================================================== -->
<div class="pbi-tab-pane active" id="tabOverview">
    <div class="row g-4 mb-4">
        <!-- 5-Year Enrollment Growth & Trajectory Model -->
        <div class="col-lg-7">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-graph-up-arrow me-2 text-gold"></i>5-Year Historical Enrollment Trajectory &amp; Growth Curve
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">
                            Year-over-Year student population expansion in Santa Cruz Campus vs institutional capacity.
                        </p>
                    </div>
                    <span class="badge badge-gold">Actual vs Target</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 290px;">
                        <canvas id="pbiTrajectoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Multi-Stage Online Student Clearance Pipeline Funnel (Chart) -->
        <div class="col-lg-5">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-filter-circle-fill me-2 text-primary"></i>Online Clearance Pipeline Funnel
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Validation progress across university signing offices.</p>
                    </div>
                    <span class="badge badge-burgundy">88.6% Cleared</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 290px;">
                        <canvas id="pbiClearanceFunnelChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Student Retention Risk Forecaster & Faculty Distribution -->
    <div class="row g-4 mb-4">
        <!-- Student Retention Predictor Model -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-shield-fill-check me-2 text-success"></i>Student Retention Forecaster &amp; Risk Tiers
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Predictive machine learning risk categorization for Santa Cruz students.</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">94.8% Safe</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 240px;">
                        <canvas id="pbiRetentionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Faculty & Staff Distribution by Academic College -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-pie-chart-fill me-2 text-gold"></i>Faculty Personnel Allocation by Department
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Instructional and academic staff deployment.</p>
                    </div>
                    <span class="badge badge-burgundy"><?= number_format($totalEmployees) ?> Faculty</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 240px;">
                        <canvas id="pbiFacultyDonutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Multi-Module Operational Telemetry Quick Switcher -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent border-0 pt-3 pb-2 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                    <i class="bi bi-boxes text-gold me-2"></i>Multi-Module Quick Jump Dashboard
                </h6>
                <p class="text-muted small mb-0" style="font-size: 0.78rem;">Explore detailed visual telemetry generated for all 10 specialized student sub-modules.</p>
            </div>
            <span class="badge badge-gold">10 Module Visuals Active</span>
        </div>
        <div class="card-body pt-1">
            <div class="row g-2">
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabWelfare')">
                        <i class="bi bi-house-door-fill text-purple me-1" style="color:#8B5CF6;"></i> <strong>Group 7: ISHAMIS Housing</strong>
                        <div class="small text-muted">9 houses &bull; 83.5% occupied</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabWelfare')">
                        <i class="bi bi-heart-pulse-fill text-danger me-1"></i> <strong>Group 4: Health Clinic</strong>
                        <div class="small text-muted">156 medical consultations</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabWelfare')">
                        <i class="bi bi-chat-heart-fill text-info me-1"></i> <strong>Group 11: Guidance Records</strong>
                        <div class="small text-muted">100% confidential intakes</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabGovernance')">
                        <i class="bi bi-calendar3 text-primary me-1"></i> <strong>Group 3: Faculty Workload</strong>
                        <div class="small text-muted">100% CHED norm compliant</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabGovernance')">
                        <i class="bi bi-cash-stack text-success me-1"></i> <strong>Group 5: Org Finance</strong>
                        <div class="small text-muted">₱184.5k transparent funds</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabGovernance')">
                        <i class="bi bi-laptop text-info me-1"></i> <strong>Group 9: IT &amp; Campus Assets</strong>
                        <div class="small text-muted">255 tracked lab machines</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabWelfare')">
                        <i class="bi bi-patch-check text-warning me-1"></i> <strong>Group 10: Student Welfare</strong>
                        <div class="small text-muted">318 scholarship grantees</div>
                    </button>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-outline-secondary btn-sm w-100 text-start py-2" onclick="switchPbiTabByName('tabGovernance')">
                        <i class="bi bi-journal-richtext text-gold me-1"></i> <strong>Group 2: IRIM KMS</strong>
                        <div class="small text-muted">124 research publications</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 2: CURRICULAR & STUDENT BI
     ========================================================================== -->
<div class="pbi-tab-pane d-none" id="tabAcademic">
    <div class="row g-4 mb-4">
        <!-- Student Enrollment by Academic Program (Bar Chart) -->
        <div class="col-lg-7">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-bar-chart-fill me-2 text-gold"></i>Student Enrollment by Academic Program vs Target Capacity
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Distribution of active regular and irregular students across degrees in Santa Cruz.</p>
                    </div>
                    <span class="badge badge-burgundy">Current AY</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 300px;">
                        <canvas id="pbiProgramBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Population by Year Level Cohort -->
        <div class="col-lg-5">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-people-fill me-2 text-gold"></i>Enrollment by Year Level
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Freshmen to Senior cohort balance.</p>
                    </div>
                    <span class="badge badge-gold">4 Cohorts</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 300px;">
                        <canvas id="pbiYearLevelChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Power BI Program Scorecard Matrix Table -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent border-0 pt-3 pb-2 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                    <i class="bi bi-table text-gold me-2"></i>Academic Program Performance &amp; Capacity Scorecard
                </h6>
                <p class="text-muted small mb-0" style="font-size: 0.78rem;">Comprehensive curricular utilization, clearance sign-off %, and retention index.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Filter program..." data-table-search="programScorecardTable" style="max-width: 180px;">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="programScorecardTable">
                    <thead class="table-marsu">
                        <tr>
                            <th>Program Code</th>
                            <th>Full Degree Title</th>
                            <th>Enrolled Headcount</th>
                            <th>Capacity Target</th>
                            <th>Clearance Status</th>
                            <th>Retention Score</th>
                            <th class="text-end">Curricular State</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php foreach ($programScorecard as $prog): ?>
                            <tr data-program-row="<?= e($prog['code']) ?>">
                                <td class="fw-bold text-marsu-burgundy"><?= e($prog['code']) ?></td>
                                <td><?= e($prog['name']) ?></td>
                                <td class="fw-bold"><?= number_format($prog['enrolled']) ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span><?= number_format($prog['capacity']) ?></span>
                                        <div class="pbi-progress-track flex-grow-1" style="max-width: 80px; margin-top: 0;">
                                            <div class="pbi-progress-fill bg-marsu" style="width: <?= round(($prog['enrolled'] / $prog['capacity']) * 100) ?>%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                        <i class="bi bi-check2-circle me-1"></i><?= $prog['clearance'] ?>%
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        <i class="bi bi-shield-check me-1"></i><?= $prog['retention'] ?>%
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-<?= $prog['badge'] ?> px-2 py-1"><?= $prog['status'] ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 3: HOUSING (ISHAMIS), HEALTH & GUIDANCE ANALYTICS
     ========================================================================== -->
<div class="pbi-tab-pane d-none" id="tabWelfare">
    <!-- Row 1: Housing & Health Clinic -->
    <div class="row g-4 mb-4">
        <!-- ISHAMIS Housing Analytics by Barangay in Santa Cruz -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-house-door-fill me-2" style="color: #8B5CF6;"></i>Group 7: ISHAMIS Housing Capacity by Barangay
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Accredited boarding house bed capacity vs occupancy in Santa Cruz.</p>
                    </div>
                    <span class="badge" style="background:#8B5CF6; color:#FFF;">₱1,350/mo Avg</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 260px;">
                        <canvas id="pbiHousingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Health Clinic & Dental Monthly Encounters -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-heart-pulse-fill me-2 text-danger"></i>Group 4: Health Clinic Monthly Consultations
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Medical intakes, dental examinations, and physical clearance flow.</p>
                    </div>
                    <span class="badge badge-burgundy">156 Encounters</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 260px;">
                        <canvas id="pbiClinicChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Guidance Counseling & Student Welfare Scholarships -->
    <div class="row g-4 mb-4">
        <!-- Guidance Counseling Intake Categories -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-chat-heart-fill me-2 text-info"></i>Group 11: Guidance Case Intake Breakdown
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Confidential counseling sessions under RA 10173 compliance.</p>
                    </div>
                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">96.2% Resolved</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 260px;">
                        <canvas id="pbiGuidanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Welfare & Scholarships (Group 10) -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-patch-check-fill me-2 text-warning"></i>Group 10: Student Welfare Grantee Beneficiaries
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Distribution of student scholarship &amp; financial aid recipients.</p>
                    </div>
                    <span class="badge badge-gold">318 Grantees</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 260px;">
                        <canvas id="pbiWelfareChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 4: CAMPUS GOVERNANCE, WORKLOAD & IT ASSETS
     ========================================================================== -->
<div class="pbi-tab-pane d-none" id="tabGovernance">
    <!-- Row 1: Faculty Teaching Workload & IT Asset Status -->
    <div class="row g-4 mb-4">
        <!-- Faculty Teaching Workload Compliance (Group 3) -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-calendar3 me-2 text-primary"></i>Group 3: Faculty Teaching Load &amp; CHED Compliance
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Regular teaching unit assignments vs CHED maximum workload limits.</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">100% Compliant</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 250px;">
                        <canvas id="pbiWorkloadChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- University IT Assets & Laboratory Hardware (Group 9) -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-laptop me-2 text-info"></i>Group 9: IT Equipment &amp; Lab Operational Health
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Serviceable units vs scheduled maintenance across computer laboratories.</p>
                    </div>
                    <span class="badge badge-gold">255 Hardware Units</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 250px;">
                        <canvas id="pbiAssetChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Org Finance & Security Audit Trail -->
    <div class="row g-4 mb-4">
        <!-- Student Organization Collections vs Disbursements (Group 5) -->
        <div class="col-lg-7">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-cash-stack me-2 text-success"></i>Group 5: Student Council &amp; Club Financial Transparency
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Collected student dues vs audited project disbursements per organization.</p>
                    </div>
                    <span class="badge badge-gold">₱184.5k Total Pool</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 260px;">
                        <canvas id="pbiOrgFinanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Audit Trail -->
        <div class="col-lg-5">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-clock-history me-2 text-gold"></i>Security Audit Log
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Immutable administrative activity feed.</p>
                    </div>
                    <a href="<?= url('audit') ?>" class="btn btn-outline-marsu btn-sm">Full Feed &rarr;</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0 small">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Entity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentAudits as $log): ?>
                                    <tr>
                                        <td class="text-nowrap text-muted"><?= date('h:i A', strtotime($log['created_at'])) ?></td>
                                        <td class="fw-bold"><?= e($log['username'] ?? 'System') ?></td>
                                        <td><span class="badge badge-burgundy"><?= e($log['action']) ?></span></td>
                                        <td><code><?= e($log['entity']) ?></code></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     INLINE POWER BI CLIENT INTERACTIVITY & CHART.JS INITIALIZATION
     ========================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Tab Switching Functionality
    window.switchPbiTab = function(btn, targetPaneId) {
        document.querySelectorAll('.pbi-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.pbi-tab-pane').forEach(p => {
            p.classList.add('d-none');
            p.classList.remove('active');
        });

        const targetPane = document.getElementById(targetPaneId);
        if (targetPane) {
            targetPane.classList.remove('d-none');
            targetPane.classList.add('active');
        }
    };

    window.switchPbiTabByName = function(targetPaneId) {
        const btnIdMap = {
            'tabOverview': 'btnTabOverview',
            'tabAcademic': 'btnTabAcademic',
            'tabWelfare': 'btnTabWelfare',
            'tabGovernance': 'btnTabGovernance'
        };
        const btn = document.getElementById(btnIdMap[targetPaneId]);
        if (btn) {
            window.switchPbiTab(btn, targetPaneId);
            window.scrollTo({ top: document.getElementById('pbiTabNav').offsetTop - 70, behavior: 'smooth' });
        }
    };

    // 2. Interactive Program Slicer (Filter Headcount, Cards & Tables)
    window.filterByProgram = function(pill, progCode) {
        const parent = pill.parentElement;
        parent.querySelectorAll('.pbi-slicer-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        const kpiStudents = document.getElementById('kpiActiveStudents');
        const kpiBar = document.getElementById('kpiEnrollmentProgress');

        const progCounts = {
            'ALL': 867,
            'BSTM': 398,
            'BSIS': 192,
            'BAPoS': 154,
            'BEED': 123
        };

        const count = progCounts[progCode] || 867;
        if (kpiStudents) kpiStudents.textContent = count.toLocaleString();
        if (kpiBar) kpiBar.style.width = Math.min(100, Math.round((count / (progCode === 'ALL' ? 900 : count * 1.1)) * 100)) + '%';

        // Filter scorecard table rows
        document.querySelectorAll('#programScorecardTable tbody tr').forEach(row => {
            const rowCode = row.getAttribute('data-program-row');
            if (progCode === 'ALL' || rowCode === progCode) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        if (typeof showMarsuNotification === 'function') {
            showMarsuNotification('info', `Filtered to: ${pill.textContent.trim()}`);
        }
    };

    // 3. Slicer Pill Click Handler
    window.applySlicer = function(pill, type) {
        const parent = pill.parentElement;
        parent.querySelectorAll('.pbi-slicer-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        if (typeof showMarsuNotification === 'function') {
            showMarsuNotification('info', `Slicer active: ${pill.textContent.trim()}`);
        }
    };

    // 4. Fullscreen Canvas Handler
    window.toggleFullscreenCanvas = function() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(() => {});
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen().catch(() => {});
            }
        }
    };

    if (!window.Chart) return;

    // --- CHART 1: 5-Year Trajectory Area Spline Chart ---
    const trajCanvas = document.getElementById('pbiTrajectoryChart');
    if (trajCanvas) {
        const ctx = trajCanvas.getContext('2d');
        const burgGrad = ctx.createLinearGradient(0, 0, 0, 270);
        burgGrad.addColorStop(0, 'rgba(128, 0, 32, 0.45)');
        burgGrad.addColorStop(1, 'rgba(128, 0, 32, 0.02)');

        new Chart(trajCanvas, {
            type: 'line',
            data: {
                labels: <?= json_encode($trendYears) ?>,
                datasets: [
                    {
                        label: 'Actual Students Enrolled',
                        data: <?= json_encode($trendActual) ?>,
                        borderColor: '#800020',
                        backgroundColor: burgGrad,
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3,
                        pointBackgroundColor: '#800020',
                        pointBorderColor: '#FFFFFF',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    },
                    {
                        label: 'Target Capacity Curve',
                        data: <?= json_encode($trendTarget) ?>,
                        borderColor: '#D4AF37',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11 } } }
                },
                scales: {
                    y: { min: 500, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 2: Online Clearance Pipeline Funnel ---
    const funnelCanvas = document.getElementById('pbiClearanceFunnelChart');
    if (funnelCanvas) {
        new Chart(funnelCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($clearanceFunnel['offices']) ?>,
                datasets: [{
                    label: 'Clearance Sign-off Rate (%)',
                    data: <?= json_encode($clearanceFunnel['rates']) ?>,
                    backgroundColor: [
                        '#10B981', '#3B82F6', '#8B5CF6', '#F59E0B', '#C45A72', '#800020'
                    ],
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: (ctx) => ` Sign-off: ${ctx.raw}%` } }
                },
                scales: {
                    x: { min: 70, max: 100, ticks: { stepSize: 10, callback: (v) => v + '%' } },
                    y: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 3: Student Retention Predictor Tiers ---
    const retCanvas = document.getElementById('pbiRetentionChart');
    if (retCanvas) {
        new Chart(retCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($retentionStats['tiers']) ?>,
                datasets: [{
                    label: 'Students Count',
                    data: <?= json_encode($retentionStats['counts']) ?>,
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 4: Faculty Personnel Allocation by Department ---
    const facultyCanvas = document.getElementById('pbiFacultyDonutChart');
    if (facultyCanvas) {
        new Chart(facultyCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($employeeChart['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($employeeChart['values']) ?>,
                    backgroundColor: ['#800020', '#D4AF37', '#10B981', '#2563EB', '#8B5CF6', '#64748B'],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } }
                }
            }
        });
    }

    // --- CHART 5: Program Enrollment Bar Chart (Tab 2) ---
    const progBarCanvas = document.getElementById('pbiProgramBarChart');
    if (progBarCanvas) {
        new Chart(progBarCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($enrollmentChart['labels']) ?>,
                datasets: [{
                    label: 'Enrolled Students',
                    data: <?= json_encode($enrollmentChart['values']) ?>,
                    backgroundColor: ['#800020', '#D4AF37', '#C45A72', '#B8922A'],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 6: Year Level Cohort Donut (Tab 2) ---
    const yrCanvas = document.getElementById('pbiYearLevelChart');
    if (yrCanvas) {
        new Chart(yrCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($yearLevelChart['labels'] ?? ['1st Year', '2nd Year', '3rd Year', '4th Year']) ?>,
                datasets: [{
                    data: <?= json_encode($yearLevelChart['values'] ?? [310, 240, 185, 132]) ?>,
                    backgroundColor: ['#800020', '#D4AF37', '#10B981', '#3B82F6'],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 } } } }
            }
        });
    }

    // --- CHART 7: ISHAMIS Housing Capacity & Occupancy by Barangay (Tab 3) ---
    const hsgCanvas = document.getElementById('pbiHousingChart');
    if (hsgCanvas) {
        new Chart(hsgCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($housingStats['zones']) ?>,
                datasets: [
                    {
                        label: 'Total Bed Capacity',
                        data: <?= json_encode($housingStats['capacity']) ?>,
                        backgroundColor: 'rgba(139, 92, 246, 0.35)',
                        borderColor: '#8B5CF6',
                        borderWidth: 1.5,
                        borderRadius: 4
                    },
                    {
                        label: 'Occupied Beds',
                        data: <?= json_encode($housingStats['occupied']) ?>,
                        backgroundColor: '#8B5CF6',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top', labels: { boxWidth: 12, font: { size: 10 } } } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 8: Health Clinic Monthly Encounters (Tab 3) ---
    const clinicCanvas = document.getElementById('pbiClinicChart');
    if (clinicCanvas) {
        new Chart(clinicCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($clinicStats['months']) ?>,
                datasets: [
                    { label: 'General Medicine', data: <?= json_encode($clinicStats['medical']) ?>, backgroundColor: '#EF4444', borderRadius: 4 },
                    { label: 'Dental Checks', data: <?= json_encode($clinicStats['dental']) ?>, backgroundColor: '#3B82F6', borderRadius: 4 },
                    { label: 'First Aid', data: <?= json_encode($clinicStats['firstaid']) ?>, backgroundColor: '#F59E0B', borderRadius: 4 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top', labels: { boxWidth: 10, font: { size: 10 } } } },
                scales: {
                    y: { beginAtZero: true, stacked: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { stacked: true, grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 9: Guidance Counseling Intakes by Category (Tab 3) ---
    const gdcCanvas = document.getElementById('pbiGuidanceChart');
    if (gdcCanvas) {
        new Chart(gdcCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($guidanceStats['categories']) ?>,
                datasets: [{
                    data: <?= json_encode($guidanceStats['counts']) ?>,
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899'],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } }
            }
        });
    }

    // --- CHART 10: Student Welfare Scholarship Grantees (Tab 3) ---
    const wlfCanvas = document.getElementById('pbiWelfareChart');
    if (wlfCanvas) {
        new Chart(wlfCanvas, {
            type: 'pie',
            data: {
                labels: <?= json_encode($welfareStats['programs']) ?>,
                datasets: [{
                    data: <?= json_encode($welfareStats['grantees']) ?>,
                    backgroundColor: ['#D4AF37', '#800020', '#10B981', '#3B82F6'],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } }
            }
        });
    }

    // --- CHART 11: Faculty Teaching Workload Compliance (Tab 4) ---
    const wklCanvas = document.getElementById('pbiWorkloadChart');
    if (wklCanvas) {
        new Chart(wklCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($workloadStats['tiers']) ?>,
                datasets: [{
                    label: 'Faculty Count',
                    data: <?= json_encode($workloadStats['counts']) ?>,
                    backgroundColor: ['#10B981', '#F59E0B', '#3B82F6'],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 12: IT Equipment Operational Status (Tab 4) ---
    const astCanvas = document.getElementById('pbiAssetChart');
    if (astCanvas) {
        new Chart(astCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($assetStats['categories']) ?>,
                datasets: [
                    { label: 'Serviceable Units', data: <?= json_encode($assetStats['serviceable']) ?>, backgroundColor: '#10B981', borderRadius: 4 },
                    { label: 'In Maintenance', data: <?= json_encode($assetStats['maintenance']) ?>, backgroundColor: '#EF4444', borderRadius: 4 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top', labels: { boxWidth: 10, font: { size: 10 } } } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // --- CHART 13: Org Finance Collections vs Disbursements (Tab 4) ---
    const orfCanvas = document.getElementById('pbiOrgFinanceChart');
    if (orfCanvas) {
        new Chart(orfCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($orgFinanceStats['orgs']) ?>,
                datasets: [
                    { label: 'Total Collections (₱)', data: <?= json_encode($orgFinanceStats['collections']) ?>, backgroundColor: '#D4AF37', borderRadius: 4 },
                    { label: 'Disbursed Projects (₱)', data: <?= json_encode($orgFinanceStats['disbursements']) ?>, backgroundColor: '#800020', borderRadius: 4 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11 } } },
                    tooltip: { callbacks: { label: (ctx) => ` ${ctx.dataset.label}: ₱${ctx.raw.toLocaleString()}` } }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { callback: (v) => '₱' + (v / 1000) + 'k' }, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }
});
</script>
