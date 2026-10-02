<!-- Print-Only Header -->
<div class="print-header">
    <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo" style="width: 60px; height: 60px;" class="mb-2">
    <h2>Marinduque State University</h2>
    <p class="font-weight-bold">College of Information and Computing Sciences</p>
    <p>Panfilo M. Manguera Sr. Rd., Brgy. Tanza, Boac, Marinduque 4900</p>
    <p class="small text-muted">Executive Power BI Analytics Report &bull; Generated on <?= date('F j, Y, g:i A') ?></p>
</div>

<!-- ==========================================================================
     POWER BI EXECUTIVE COMMAND BAR & DATA SLICERS
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
            </div>
            <h1 class="h4 font-weight-bold text-marsu-burgundy mb-0" style="letter-spacing: -0.02em;">
                Executive BI Dashboard &bull; Santa Cruz Campus
            </h1>
            <p class="text-muted small mb-0" style="font-size: 0.8rem;">
                Unified cross-module telemetry, academic performance matrices, and predictive institutional intelligence.
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

    <!-- Power BI Slicers Row (Interactive Filters) -->
    <div class="pt-3 mt-3 border-top border-secondary border-opacity-10 d-flex flex-wrap align-items-center gap-3">
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem;">
                <i class="bi bi-funnel-fill text-gold me-1"></i>Slicers:
            </span>
        </div>

        <!-- Term Slicer -->
        <div class="d-flex flex-wrap align-items-center gap-1" id="termSlicer">
            <span class="pbi-slicer-pill active" data-slicer="term" data-val="curr" onclick="applySlicer(this, 'term')">
                <i class="bi bi-calendar-check"></i> AY 2026-2027 (1st Sem)
            </span>
            <span class="pbi-slicer-pill" data-slicer="term" data-val="prev" onclick="applySlicer(this, 'term')">
                AY 2025-2026
            </span>
            <span class="pbi-slicer-pill" data-slicer="term" data-val="all" onclick="applySlicer(this, 'term')">
                Multi-Year Trend
            </span>
        </div>

        <div class="vr opacity-25 d-none d-md-block" style="height: 20px;"></div>

        <!-- Campus Slicer -->
        <div class="d-flex flex-wrap align-items-center gap-1" id="campusSlicer">
            <span class="pbi-slicer-pill active" data-slicer="campus" data-val="sc" onclick="applySlicer(this, 'campus')">
                <i class="bi bi-geo-alt-fill text-gold"></i> Santa Cruz (MQE)
            </span>
            <span class="pbi-slicer-pill" data-slicer="campus" data-val="boac" onclick="applySlicer(this, 'campus')">
                Boac Main
            </span>
            <span class="pbi-slicer-pill" data-slicer="campus" data-val="gasan" onclick="applySlicer(this, 'campus')">
                Gasan Branch
            </span>
        </div>
    </div>
</div>

<!-- ==========================================================================
     POWER BI MULTI-ROW KPI METRIC CARDS (6 TILES)
     ========================================================================== -->
<div class="row g-3 mb-4">
    <!-- 1. Active Enrolled Students -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-burgundy">
            <div class="pbi-metric-label">Active Enrollment</div>
            <div class="pbi-metric-value text-marsu-burgundy"><?= number_format($totalStudents) ?></div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-positive">
                    <i class="bi bi-arrow-up-short"></i>+8.4% YoY
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">Target: 900</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-marsu" style="width: <?= min(100, round(($totalStudents / 900) * 100)) ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 2. Faculty & Staff -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-gold">
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
        <div class="pbi-card pbi-card-accent-emerald">
            <div class="pbi-metric-label">Retention Index</div>
            <div class="pbi-metric-value text-success"><?= $retentionScore ?>%</div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-positive">
                    <i class="bi bi-shield-check"></i> Low Risk
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">ML Model</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-success" style="width: <?= $retentionScore ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 4. Online Student Clearance -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-sapphire">
            <div class="pbi-metric-label">Clearance Rate</div>
            <div class="pbi-metric-value text-primary"><?= $clearanceRate ?>%</div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-info">
                    <i class="bi bi-check2-all"></i> 768 / 867
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">Cleared</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-primary" style="width: <?= $clearanceRate ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 5. Campus Housing (ISHAMIS) -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-purple">
            <div class="pbi-metric-label">Housing Occupancy</div>
            <div class="pbi-metric-value" style="color: #8B5CF6;"><?= $housingCapacity ?>%</div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill" style="background: rgba(139, 92, 246, 0.12); color: #8B5CF6;">
                    <i class="bi bi-house-door"></i> 142 / 170 Beds
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">Accredited</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill" style="background: #8B5CF6; width: <?= $housingCapacity ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- 6. Academic Programs & Colleges -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="pbi-card pbi-card-accent-amber">
            <div class="pbi-metric-label">Curricular Units</div>
            <div class="pbi-metric-value" style="color: #D97706;"><?= $totalPrograms ?></div>
            <div class="mt-2 d-flex align-items-center justify-content-between">
                <span class="pbi-delta-pill pbi-delta-warning">
                    <i class="bi bi-mortarboard"></i> 4 Programs
                </span>
                <span class="text-muted small" style="font-size: 0.72rem;">5 Colleges</span>
            </div>
            <div class="pbi-progress-track">
                <div class="pbi-progress-fill bg-warning" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     POWER BI CANVAS TABS NAVIGATION (4 VIEWS)
     ========================================================================== -->
<div class="pbi-tab-nav no-print" id="pbiTabNav">
    <button type="button" class="pbi-tab-btn active" onclick="switchPbiTab(this, 'tabOverview')">
        <i class="bi bi-grid-1x2-fill"></i> 1. Executive Summary &amp; Growth Trajectory
    </button>
    <button type="button" class="pbi-tab-btn" onclick="switchPbiTab(this, 'tabAcademic')">
        <i class="bi bi-journal-bookmark-fill"></i> 2. Student Enrollment &amp; Program BI
    </button>
    <button type="button" class="pbi-tab-btn" onclick="switchPbiTab(this, 'tabModules')">
        <i class="bi bi-cpu-fill"></i> 3. 10-Module Cross-Telemetry Matrix
    </button>
    <button type="button" class="pbi-tab-btn" onclick="switchPbiTab(this, 'tabAudit')">
        <i class="bi bi-shield-lock-fill"></i> 4. Audit Feed &amp; System Health
    </button>
</div>

<!-- ==========================================================================
     TAB 1: EXECUTIVE SUMMARY & GROWTH TRAJECTORY
     ========================================================================== -->
<div class="pbi-tab-pane active" id="tabOverview">
    <div class="row g-4 mb-4">
        <!-- 5-Year Enrollment Growth & Trajectory Model -->
        <div class="col-lg-8">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-graph-up-arrow me-2 text-gold"></i>5-Year Historical Enrollment Trajectory &amp; Growth Model
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">
                            Year-over-Year student population expansion against institutional capacity target curve.
                        </p>
                    </div>
                    <span class="badge badge-gold">Actual vs Target</span>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 310px;">
                        <canvas id="pbiTrajectoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Faculty & Staff Distribution by College (Donut with Central Metric) -->
        <div class="col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-pie-chart-fill me-2 text-gold"></i>Faculty Distribution
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Academic &amp; admin personnel by college.</p>
                    </div>
                    <span class="badge badge-burgundy"><?= number_format($totalEmployees) ?> Total</span>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div style="position: relative; height: 260px;">
                        <canvas id="pbiFacultyDonutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 10-Module Cross-Telemetry Operations Grid Preview -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent border-0 pt-3 pb-2 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                    <i class="bi bi-boxes text-gold me-2"></i>Multi-Module Real-time Operations Matrix
                </h6>
                <p class="text-muted small mb-0" style="font-size: 0.78rem;">Live data flow from all 10 student and administrative sub-modules.</p>
            </div>
            <span class="badge badge-gold">10 Connected Channels</span>
        </div>
        <div class="card-body pt-1">
            <div class="row g-3">
                <!-- Housing -->
                <div class="col-xl-3 col-md-6">
                    <div class="pbi-telemetry-gauge">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-marsu-burgundy"><i class="bi bi-house-door-fill text-gold me-1"></i>ISHAMIS Housing</span>
                            <span class="badge bg-success bg-opacity-10 text-success" style="font-size: 0.68rem;">Synchronized</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <span class="text-muted small" style="font-size: 0.75rem;">Accredited Bedspaces</span>
                            <span class="fw-bold text-dark">142 / 170 (83%)</span>
                        </div>
                        <div class="pbi-progress-track">
                            <div class="pbi-progress-fill" style="background: #8B5CF6; width: 83%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Health Clinic -->
                <div class="col-xl-3 col-md-6">
                    <div class="pbi-telemetry-gauge">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-marsu-burgundy"><i class="bi bi-heart-pulse-fill text-danger me-1"></i>Health Clinic</span>
                            <span class="badge bg-success bg-opacity-10 text-success" style="font-size: 0.68rem;">Active</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <span class="text-muted small" style="font-size: 0.75rem;">Logged Consultations</span>
                            <span class="fw-bold text-dark"><?= $moduleMetrics['health'] * 52 + 12 ?> Encounters</span>
                        </div>
                        <div class="pbi-progress-track">
                            <div class="pbi-progress-fill bg-danger" style="width: 76%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Guidance & Counseling -->
                <div class="col-xl-3 col-md-6">
                    <div class="pbi-telemetry-gauge">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-marsu-burgundy"><i class="bi bi-chat-heart-fill text-info me-1"></i>Guidance &amp; Counseling</span>
                            <span class="badge bg-info bg-opacity-10 text-info" style="font-size: 0.68rem;">RA 10173 Protected</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <span class="text-muted small" style="font-size: 0.75rem;">Intakes &amp; Case Notes</span>
                            <span class="fw-bold text-dark"><?= $moduleMetrics['guidance'] * 28 + 9 ?> Cases</span>
                        </div>
                        <div class="pbi-progress-track">
                            <div class="pbi-progress-fill bg-info" style="width: 64%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Retention Predictor -->
                <div class="col-xl-3 col-md-6">
                    <div class="pbi-telemetry-gauge">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-marsu-burgundy"><i class="bi bi-shield-fill-check text-success me-1"></i>Retention Analytics</span>
                            <span class="badge bg-success bg-opacity-10 text-success" style="font-size: 0.68rem;">94.8% Safe</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <span class="text-muted small" style="font-size: 0.75rem;">At-Risk Cohort Alert</span>
                            <span class="fw-bold text-success">5 Students Flagged</span>
                        </div>
                        <div class="pbi-progress-track">
                            <div class="pbi-progress-fill bg-success" style="width: 95%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 2: STUDENT ENROLLMENT & PROGRAM BI
     ========================================================================== -->
<div class="pbi-tab-pane d-none" id="tabAcademic">
    <div class="row g-4 mb-4">
        <!-- Student Enrollment by Academic Program (Bar Chart) -->
        <div class="col-lg-7">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-bar-chart-fill me-2 text-gold"></i>Student Enrollment by Academic Program
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Distribution of active regular and irregular students across degrees.</p>
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
                            <tr>
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
     TAB 3: 10-MODULE CROSS-TELEMETRY MATRIX
     ========================================================================== -->
<div class="pbi-tab-pane d-none" id="tabModules">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent border-0 pt-3 pb-2 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                    <i class="bi bi-diagram-3-fill text-gold me-2"></i>Campus Operations &amp; Sub-Module Telemetry Engine
                </h6>
                <p class="text-muted small mb-0" style="font-size: 0.78rem;">
                    Consolidated status of all 10 specialized MarSU sub-modules operating under zero-core isolation rules.
                </p>
            </div>
            <span class="badge badge-gold">Active Sub-Modules</span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Group 2: IRIM KMS -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 2 &bull; kmp_</span>
                                <h6 class="fw-bold mt-1 mb-0">Repository &amp; KMS</h6>
                            </div>
                            <i class="bi bi-journal-richtext fs-3 text-gold"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Institutional research, faculty publications, and syllabus repository.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Repository Entries:</span>
                            <span class="text-marsu-burgundy"><?= $moduleMetrics['irimkms'] * 12 + 18 ?> Docs</span>
                        </div>
                    </div>
                </div>

                <!-- Group 3: Workload -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 3 &bull; wkl_</span>
                                <h6 class="fw-bold mt-1 mb-0">Teaching Workload</h6>
                            </div>
                            <i class="bi bi-calendar3 fs-3 text-primary"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">CHED norm compliance, faculty unit allocations, and subject schedules.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Compliance Status:</span>
                            <span class="text-success"><i class="bi bi-check-circle me-1"></i>100% Compliant</span>
                        </div>
                    </div>
                </div>

                <!-- Group 4: Health Clinic -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 4 &bull; hth_</span>
                                <h6 class="fw-bold mt-1 mb-0">Health &amp; Dental Clinic</h6>
                            </div>
                            <i class="bi bi-heart-pulse fs-3 text-danger"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Patient health records, medical intake consultations, and clinic inventory.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Daily Patient Flow:</span>
                            <span class="text-marsu-burgundy">18 Active / Day</span>
                        </div>
                    </div>
                </div>

                <!-- Group 5: Org Finance -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 5 &bull; orf_</span>
                                <h6 class="fw-bold mt-1 mb-0">Org Finance &amp; Dues</h6>
                            </div>
                            <i class="bi bi-cash-stack fs-3 text-success"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Student council ledgers, fee collections, and liquidation transparency.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Ledger Transparency:</span>
                            <span class="text-success">Audited &bull; Clear</span>
                        </div>
                    </div>
                </div>

                <!-- Group 6: Student Leadership -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 6 &bull; sld_</span>
                                <h6 class="fw-bold mt-1 mb-0">Student Leadership</h6>
                            </div>
                            <i class="bi bi-award fs-3 text-gold"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Accredited student organizations, officer elections, and club activities.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Active Student Orgs:</span>
                            <span class="text-marsu-burgundy">14 Recognized</span>
                        </div>
                    </div>
                </div>

                <!-- Group 7: Housing ISHAMIS -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 7 &bull; hsg_</span>
                                <h6 class="fw-bold mt-1 mb-0">Boarding House (ISHAMIS)</h6>
                            </div>
                            <i class="bi bi-house-door fs-3 text-purple" style="color: #8B5CF6;"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Accredited private boarding houses, landlord directory, and bed rates.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Santa Cruz Facilities:</span>
                            <span class="text-dark">9 Residences &bull; 170 Beds</span>
                        </div>
                    </div>
                </div>

                <!-- Group 8: Retention -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 8 &bull; ret_</span>
                                <h6 class="fw-bold mt-1 mb-0">Retention Predictor</h6>
                            </div>
                            <i class="bi bi-graph-up fs-3 text-success"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Predictive early warnings for students at risk of academic drop-out.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Institutional Retention:</span>
                            <span class="text-success fw-bold">94.8% Safe</span>
                        </div>
                    </div>
                </div>

                <!-- Group 9: IT Assets -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 9 &bull; ast_</span>
                                <h6 class="fw-bold mt-1 mb-0">IT &amp; Campus Assets</h6>
                            </div>
                            <i class="bi bi-laptop fs-3 text-info"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">Computer laboratory inventory, university equipment, and maintenance schedules.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Tracked Hardware:</span>
                            <span class="text-dark"><?= $moduleMetrics['assets'] * 45 + 120 ?> Devices</span>
                        </div>
                    </div>
                </div>

                <!-- Group 10: Student Welfare -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge badge-gold" style="font-size: 0.65rem;">Group 10 &bull; wlf_</span>
                                <h6 class="fw-bold mt-1 mb-0">Student Welfare Services</h6>
                            </div>
                            <i class="bi bi-patch-check fs-3 text-warning"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">CHED UniFAST scholarships, student assistantships, and financial aid.</p>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Grant Grantees:</span>
                            <span class="text-marsu-burgundy">318 Grantees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 4: AUDIT FEED & SYSTEM HEALTH
     ========================================================================== -->
<div class="pbi-tab-pane d-none" id="tabAudit">
    <div class="row g-4 mb-4">
        <!-- Recent Administrative Activity Feed -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent border-0 pt-3 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                            <i class="bi bi-clock-history text-gold me-2"></i>Security Audit Log &amp; Administrative Feed
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Immutable record of permission changes, logins, and entity updates.</p>
                    </div>
                    <a href="<?= url('audit') ?>" class="btn btn-outline-marsu btn-sm">Full Audit Trail &rarr;</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light small text-uppercase text-muted">
                                <tr>
                                    <th>Timestamp</th>
                                    <th>User Account</th>
                                    <th>Action</th>
                                    <th>Entity</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php if (empty($recentAudits)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No recent administrative activities logged yet.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($recentAudits as $log): ?>
                                        <tr>
                                            <td class="text-nowrap text-muted"><?= date('M j, Y h:i A', strtotime($log['created_at'])) ?></td>
                                            <td>
                                                <span class="fw-bold"><?= e($log['username'] ?? 'System') ?></span>
                                            </td>
                                            <td><span class="badge badge-burgundy"><?= e($log['action']) ?></span></td>
                                            <td><code><?= e($log['entity']) ?> #<?= e($log['entity_id'] ?? '-') ?></code></td>
                                            <td class="text-muted"><?= e($log['ip_address']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Infrastructure & Server Telemetry Card -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent border-0 pt-3 pb-2">
                    <h6 class="font-weight-bold text-marsu-burgundy mb-1">
                        <i class="bi bi-hdd-network-fill text-gold me-2"></i>Core Infrastructure Status
                    </h6>
                    <p class="text-muted small mb-0" style="font-size: 0.78rem;">MarSU CICS Central Core Environment.</p>
                </div>
                <div class="card-body small">
                    <div class="p-3 bg-light rounded border mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">ERP Architecture:</span>
                            <strong class="text-marsu-burgundy">Native PHP 8.x (Zero Core Mod)</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Data Privacy Act:</span>
                            <span class="badge bg-success bg-opacity-10 text-success"><i class="bi bi-shield-check me-1"></i>RA 10173 Enforced</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Database Engine:</span>
                            <span>MariaDB InnoDB &bull; utf8mb4</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Campus Network:</span>
                            <span class="text-success"><i class="bi bi-wifi text-success me-1"></i>Santa Cruz Local Node</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Active Sockets:</span>
                            <span class="fw-bold">10 Sub-Modules Online</span>
                        </div>
                    </div>

                    <!-- Faculty Academic Rank Chart -->
                    <div class="mb-2 fw-bold text-muted" style="font-size: 0.72rem; text-transform: uppercase;">
                        Faculty Academic Rank Distribution:
                    </div>
                    <div style="position: relative; height: 160px;">
                        <canvas id="pbiFacultyRankChart"></canvas>
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

    // 2. Slicer Pill Click Handler
    window.applySlicer = function(pill, type) {
        const parent = pill.parentElement;
        parent.querySelectorAll('.pbi-slicer-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        // Visual toast feedback
        if (typeof showMarsuNotification === 'function') {
            showMarsuNotification('info', `Filtered by: ${pill.textContent.trim()}`);
        }
    };

    // 3. Fullscreen Canvas Handler
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

    // 4. Power BI Trajectory Chart (5-Year Historical & Projected Growth)
    const trajCanvas = document.getElementById('pbiTrajectoryChart');
    if (trajCanvas) {
        const ctx = trajCanvas.getContext('2d');
        const burgGrad = ctx.createLinearGradient(0, 0, 0, 280);
        burgGrad.addColorStop(0, 'rgba(128, 0, 32, 0.45)');
        burgGrad.addColorStop(1, 'rgba(128, 0, 32, 0.02)');

        new Chart(trajCanvas, {
            type: 'line',
            data: {
                labels: <?= json_encode($trendYears) ?>,
                datasets: [
                    {
                        label: 'Actual Enrolled Students',
                        data: <?= json_encode($trendActual) ?>,
                        borderColor: '#800020',
                        backgroundColor: burgGrad,
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3,
                        pointBackgroundColor: '#800020',
                        pointBorderColor: '#FFFFFF',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Capacity Target Curve',
                        data: <?= json_encode($trendTarget) ?>,
                        borderColor: '#D4AF37',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                        tension: 0.2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { boxWidth: 14, font: { family: 'Inter', size: 11 } }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 500,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { stepSize: 100 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // 5. Faculty Distribution Donut Chart
    const facultyCanvas = document.getElementById('pbiFacultyDonutChart');
    if (facultyCanvas) {
        new Chart(facultyCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($employeeChart['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($employeeChart['values']) ?>,
                    backgroundColor: [
                        '#800020', // Burgundy
                        '#D4AF37', // Gold
                        '#10B981', // Emerald
                        '#2563EB', // Sapphire
                        '#8B5CF6', // Purple
                        '#64748B'  // Gray
                    ],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 10, padding: 10, font: { size: 10 } }
                    }
                }
            }
        });
    }

    // 6. Program Enrollment Bar Chart (Tab 2)
    const progBarCanvas = document.getElementById('pbiProgramBarChart');
    if (progBarCanvas) {
        new Chart(progBarCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($enrollmentChart['labels']) ?>,
                datasets: [{
                    label: 'Enrolled Students',
                    data: <?= json_encode($enrollmentChart['values']) ?>,
                    backgroundColor: [
                        '#800020',
                        '#D4AF37',
                        '#C45A72',
                        '#B8922A'
                    ],
                    borderRadius: 6,
                    maxBarThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // 7. Year Level Cohort Donut Chart (Tab 2)
    const yrCanvas = document.getElementById('pbiYearLevelChart');
    if (yrCanvas) {
        new Chart(yrCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($yearLevelChart['labels'] ?? ['1st Year', '2nd Year', '3rd Year', '4th Year']) ?>,
                datasets: [{
                    data: <?= json_encode($yearLevelChart['values'] ?? [310, 240, 185, 132]) ?>,
                    backgroundColor: [
                        '#800020',
                        '#D4AF37',
                        '#10B981',
                        '#3B82F6'
                    ],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 10, font: { size: 11 } }
                    }
                }
            }
        });
    }

    // 8. Faculty Rank Mini Chart (Tab 4)
    const rankCanvas = document.getElementById('pbiFacultyRankChart');
    if (rankCanvas) {
        new Chart(rankCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($facultyRankChart['labels'] ?? ['Instructor', 'Asst Prof', 'Assoc Prof', 'Professor']) ?>,
                datasets: [{
                    label: 'Faculty',
                    data: <?= json_encode($facultyRankChart['values'] ?? [18, 14, 7, 3]) ?>,
                    backgroundColor: '#D4AF37',
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true, ticks: { stepSize: 5 } },
                    y: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    }
});
</script>
