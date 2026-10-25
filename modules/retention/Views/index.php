<!-- Local Chart.js Vendor Asset for Module Dashboard -->
<script src="<?= asset('assets/vendor/chart.js/chart.umd.min.js') ?>"></script>

<style>
    .marsu-maroon-bg {
        background-color: #58111a !important;
        color: #fff !important;
    }

    .marsu-maroon-text {
        color: #58111a !important;
    }

    .kpi-border-success {
        border-left: 4px solid #198754 !important;
    }

    .kpi-border-primary {
        border-left: 4px solid #0d6efd !important;
    }

    .kpi-border-bottleneck,
    .kpi-border-danger {
        border-left: 4px solid #dc3545 !important;
    }

    .kpi-border-warning {
        border-left: 4px solid #ffc107 !important;
    }

    .kpi-border-info {
        border-left: 4px solid #0dcaf0 !important;
    }

    .kpi-border-gold {
        border-left: 4px solid #D4AF37 !important;
    }

    .launch-card {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
        border: 1px solid rgba(0, 0, 0, 0.08);
        text-decoration: none !important;
    }

    .launch-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }
</style>

<!-- 1. EXECUTIVE DASHBOARD HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-marsu text-white px-2 py-1 small fw-bold">
                <i class="bi bi-shield-check me-1"></i> EWS COMMAND CENTER
            </span>
            <span class="badge bg-light text-secondary border px-2 py-1 small">
                A.Y. 2026-2027 &bull; 1st Semester
            </span>
        </div>
        <h1 class="h4 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-speedometer2 me-2 text-gold"></i><?= e($moduleName) ?>
        </h1>
        <p class="text-muted small mb-0">
            Institutional predictive analytics, cohort retention monitoring, academic risk early warning alerts, and
            intervention workflows.
        </p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="<?= url('retention/atriskstudents') ?>" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>At-Risk Roster (<?= $highRiskCount ?? 18 ?>)
        </a>
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Telemetry
        </button>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRecordModal">
            <i class="bi bi-plus-lg me-1"></i>New Entry
        </button>
    </div>
</div>

<!-- 2. HIGH-LEVEL INSTITUTIONAL KPI COMMAND METRICS -->
<div class="row g-3 mb-4">
    <!-- Institutional Retention Rate -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
            <span class="text-muted small fw-semibold text-uppercase">Retention Rate</span>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <h3 class="fw-bold mb-0 text-success">
                    <?= htmlspecialchars((string) ($overallRetentionRate ?? '96.2')) ?>%</h3>
                <span class="badge bg-success-subtle text-success border border-success"
                    style="font-size: 10px;">Target: &ge;85%</span>
            </div>
            <small class="text-muted mt-2 d-block">Overall cohort persistence</small>
        </div>
    </div>

    <!-- Cohort Passing Rate -->
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
            <span class="text-muted small fw-semibold text-uppercase">Cohort Passing Rate</span>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($overallPassingRate ?? '86.5')) ?>%
                </h3>
                <span class="badge bg-success-subtle text-success border border-success"
                    style="font-size: 10px;">Target: 85%</span>
            </div>
            <small class="text-muted mt-2 d-block">Students passing active subjects</small>
        </div>
    </div>

    <!-- Average Grade (GPA) -->
    <div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
            <span class="text-muted small fw-semibold text-uppercase">Average Grade (GPA)</span>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <h3 class="fw-bold mb-0 text-dark"><?= number_format($overallMeanGpa ?? 2.29, 2) ?></h3>
                <span class="badge bg-light text-secondary border" style="font-size: 10px;">Passing: &le; 3.00</span>
            </div>
            <small class="text-muted mt-2 d-block">Calculated across <?= $totalCourses ?? 80 ?> active subjects</small>
        </div>
    </div>

    <!-- Subjects Needing Help -->
    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-bottleneck">
            <span class="text-muted small fw-semibold text-uppercase">Subjects Needing Help</span>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($bottleneckCount ?? 31)) ?></h3>
                <span class="badge bg-danger-subtle text-danger border border-danger" style="font-size: 10px;">Action
                    Needed</span>
            </div>
            <small class="text-muted mt-2 d-block">Passing rate &lt; 85% or high failure rates</small>
        </div>
    </div>

    <!-- High-Risk Students -->
    <div class="col-xl-2 col-md-6 col-sm-6">
        <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
            <span class="text-muted small fw-semibold text-uppercase">High-Risk Flagged</span>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($highRiskCount ?? 18)) ?></h3>
                <span class="badge bg-danger text-white" style="font-size: 10px;">Critical</span>
            </div>
            <small class="text-muted mt-2 d-block"><?= htmlspecialchars((string) ($activeInterventions ?? 42)) ?> active
                interventions</small>
        </div>
    </div>
</div>

<!-- 3. CENTRAL VISUAL ANALYTICS, GRAPHS & CHARTS SECTION -->
<div class="row g-3 mb-4">
    <!-- Chart 1: Course & Subject Passing Rate vs Target Benchmark -->
    <div class="col-lg-8">
        <div class="card border rounded-3 shadow-sm bg-white h-100">
            <div
                class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-bar-chart-fill me-1 text-primary"></i> Subject Passing Rate vs University
                        Benchmark (85%)
                    </h6>
                    <small class="text-muted">Target threshold line at 85.0% &bull; Red denotes subjects needing faculty
                        remediation</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-secondary border">Active Semester</span>
                    <a href="<?= url('retention/subjectperformance') ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                        style="font-size: 11px;">
                        <i class="bi bi-table me-1"></i>Subject Ledger &rarr;
                    </a>
                </div>
            </div>
            <div class="card-body p-3">
                <div style="height: 290px; position: relative;">
                    <canvas id="dashboardSubjectPassingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart 2: Institutional Grade Breakdown Distribution -->
    <div class="col-lg-4">
        <div class="card border rounded-3 shadow-sm bg-white h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark">
                    <i class="bi bi-pie-chart-fill me-1 text-primary"></i> Grade Breakdown
                </h6>
                <a href="<?= url('retention/gradestracking') ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                    style="font-size: 11px;">
                    <i class="bi bi-pencil-square me-1"></i>Grades
                </a>
            </div>
            <div class="card-body p-3 d-flex flex-column justify-content-center align-items-center">
                <div style="height: 200px; width: 100%; position: relative;">
                    <canvas id="dashboardGradePieChart"></canvas>
                </div>
                <div class="mt-3 text-center small text-muted d-flex justify-content-around w-100 border-top pt-2">
                    <span><i class="bi bi-circle-fill text-success me-1"></i> Honor (&le; 1.75):
                        <strong><?= number_format($gradeDistribution['honor'] ?? 785) ?></strong></span>
                    <span><i class="bi bi-circle-fill text-primary me-1"></i> Pass (2.00 - 3.00):
                        <strong><?= number_format($gradeDistribution['pass'] ?? 1512) ?></strong></span>
                    <span><i class="bi bi-circle-fill text-danger me-1"></i> Deficient:
                        <strong><?= number_format($gradeDistribution['deficient'] ?? 387) ?></strong></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <!-- Chart 3: Longitudinal Retention vs Attrition Trajectory -->
    <div class="col-lg-6">
        <div class="card border rounded-3 shadow-sm bg-white h-100">
            <div
                class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-graph-up-arrow me-1 text-success"></i> Longitudinal Retention vs. Attrition
                        Trajectory
                    </h6>
                    <small class="text-muted">3-Year institutional persistence comparison across academic
                        cohorts</small>
                </div>
                <a href="<?= url('retention/trendsovertime') ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                    style="font-size: 11px;">
                    <i class="bi bi-clock-history me-1"></i>Multi-Year Ledger &rarr;
                </a>
            </div>
            <div class="card-body p-3">
                <div style="height: 260px; position: relative;">
                    <canvas id="dashboardRetentionTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart 4: Degree Program Academic Risk Distribution -->
    <div class="col-lg-6">
        <div class="card border rounded-3 shadow-sm bg-white h-100">
            <div
                class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-bar-chart-steps me-1 text-warning"></i> Program-Level Academic Risk Distribution
                    </h6>
                    <small class="text-muted">Distribution of Low, Moderate, and High Risk cohorts across academic
                        degree programs</small>
                </div>
                <a href="<?= url('retention/riskoverview') ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                    style="font-size: 11px;">
                    <i class="bi bi-layers me-1"></i>Risk Overview &rarr;
                </a>
            </div>
            <div class="card-body p-3">
                <div style="height: 260px; position: relative;">
                    <canvas id="dashboardProgramRiskChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. MODULAR WORKSPACE QUICK LAUNCHPAD -->
<div class="card border rounded-3 shadow-sm bg-white mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="m-0 fw-bold marsu-maroon-text">
            <i class="bi bi-grid-3x3-gap-fill me-2 text-gold"></i>Early Warning System Operational Pillars
        </h6>
    </div>
    <div class="card-body p-3">
        <div class="row g-3">
            <!-- Pillar 1: Student Information -->
            <div class="col-lg col-md-4 col-sm-6">
                <div class="card h-100 launch-card p-3 bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <div class="p-2 rounded bg-white text-marsu-burgundy shadow-sm me-2">
                            <i class="bi bi-people fs-5"></i>
                        </div>
                        <h6 class="mb-0 fw-bold small text-dark">Student Information</h6>
                    </div>
                    <p class="text-muted" style="font-size: 11px; min-height: 32px;">Student profiles, academic history
                        transcripts, and demographics.</p>
                    <div class="d-flex flex-column gap-1 mt-auto">
                        <a href="<?= url('retention/profile') ?>" class="btn btn-sm btn-outline-dark py-1 text-start"
                            style="font-size: 11px;">
                            <i class="bi bi-person-circle me-1"></i>Student Profiles
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pillar 2: Academic Monitoring -->
            <div class="col-lg col-md-4 col-sm-6">
                <div class="card h-100 launch-card p-3 bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <div class="p-2 rounded bg-white text-primary shadow-sm me-2">
                            <i class="bi bi-journal-bookmark fs-5"></i>
                        </div>
                        <h6 class="mb-0 fw-bold small text-dark">Academic Monitoring</h6>
                    </div>
                    <p class="text-muted" style="font-size: 11px; min-height: 32px;">Grades tracking, subject
                        performance ledger, progress, and INC/failed lists.</p>
                    <div class="d-flex flex-column gap-1 mt-auto">
                        <a href="<?= url('retention/subjectperformance') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-bar-chart-line me-1"></i>Subject Performance
                        </a>
                        <a href="<?= url('retention/gradestracking') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-pencil-square me-1"></i>Grades Tracking
                        </a>
                        <a href="<?= url('retention/failedincompletemonitoring') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-exclamation-triangle me-1"></i>Failed / INC
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pillar 3: Attendance & Engagement -->
            <div class="col-lg col-md-4 col-sm-6">
                <div class="card h-100 launch-card p-3 bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <div class="p-2 rounded bg-white text-info shadow-sm me-2">
                            <i class="bi bi-calendar-check fs-5"></i>
                        </div>
                        <h6 class="mb-0 fw-bold small text-dark">Attendance & Conduct</h6>
                    </div>
                    <p class="text-muted" style="font-size: 11px; min-height: 32px;">Roll-call records, class
                        participation tracking, and student conduct logs.</p>
                    <div class="d-flex flex-column gap-1 mt-auto">
                        <a href="<?= url('retention/attendancerecords') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-person-check me-1"></i>Attendance Records
                        </a>
                        <a href="<?= url('retention/participationtracking') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-chat-dots me-1"></i>Participation
                        </a>
                        <a href="<?= url('retention/behaviorrecords') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-clipboard-check me-1"></i>Behavior Records
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pillar 4: Early Warning System -->
            <div class="col-lg col-md-6 col-sm-6">
                <div class="card h-100 launch-card p-3 bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <div class="p-2 rounded bg-white text-danger shadow-sm me-2">
                            <i class="bi bi-shield-exclamation fs-5"></i>
                        </div>
                        <h6 class="mb-0 fw-bold small text-dark">Early Warning Roster</h6>
                    </div>
                    <p class="text-muted" style="font-size: 11px; min-height: 32px;">At-risk student classifications,
                        automated early alerts, and risk level matrix.</p>
                    <div class="d-flex flex-column gap-1 mt-auto">
                        <a href="<?= url('retention/atriskstudents') ?>"
                            class="btn btn-sm btn-outline-danger py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-search me-1"></i>At-Risk Students
                        </a>
                        <a href="<?= url('retention/risklevelclassification') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-layers me-1"></i>Risk Classification
                        </a>
                        <a href="<?= url('retention/systemalerts') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-bell me-1"></i>System Alerts
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pillar 5: Interventions & Support -->
            <div class="col-lg col-md-6 col-sm-12">
                <div class="card h-100 launch-card p-3 bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <div class="p-2 rounded bg-white text-success shadow-sm me-2">
                            <i class="bi bi-heart-pulse fs-5"></i>
                        </div>
                        <h6 class="mb-0 fw-bold small text-dark">Interventions</h6>
                    </div>
                    <p class="text-muted" style="font-size: 11px; min-height: 32px;">Advising records, guidance
                        referrals, and peer mentoring clinics.</p>
                    <div class="d-flex flex-column gap-1 mt-auto">
                        <a href="<?= url('retention/advisingrecords') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-chat-square-text me-1"></i>Advising Records
                        </a>
                        <a href="<?= url('retention/guidancereferrals') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-send-check me-1"></i>Guidance Referrals
                        </a>
                        <a href="<?= url('retention/academicsupportprograms') ?>"
                            class="btn btn-sm btn-outline-dark py-1 text-start" style="font-size: 11px;">
                            <i class="bi bi-mortarboard me-1"></i>Academic Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 5. RECENT ACTIVITY & MODULE RECORDS DIRECTORY -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-table me-2"></i><?= e($moduleName) ?> Records Directory
        </h6>
        <div class="input-group input-group-sm w-auto">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" id="tableFilterInput"
                placeholder="Quick search records...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="moduleDataTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Title / Subject</th>
                        <th>Description / Remarks</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-1 text-gold"></i>
                                No records found in <code>ret_records</code>. Click "New Entry" to add one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-bold text-marsu-burgundy"><?= e($r['title']) ?></td>
                                <td class="small text-muted"><?= e($r['description'] ?? 'No description') ?></td>
                                <td>
                                    <?php if (($r['status'] ?? '') === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= e(ucfirst($r['status'] ?? 'pending')) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted"><?= e(date('M d, Y h:i A', strtotime($r['created_at']))) ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary"
                                        onclick="alert('Viewing entry #<?= $r['id'] ?>')">
                                        <i class="bi bi-eye"></i>
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

<!-- Modal: New Entry -->
<div class="modal fade" id="newRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Create New <?= e($moduleName) ?>
                    Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title / Designation <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" required
                            placeholder="e.g. Assessment Report / Transaction / Case Reference">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description / Observations</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3"
                            placeholder="Enter specific details, remarks, or notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-check-lg me-1"></i>Save
                        Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 6. DASHBOARD CHART INITIALIZATION SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Table Quick Filter
        const filterInput = document.getElementById('tableFilterInput');
        const table = document.getElementById('moduleDataTable');
        if (filterInput && table) {
            filterInput.addEventListener('keyup', function () {
                const query = this.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });
            });
        }

        // Safety check for Chart.js
        if (typeof Chart === 'undefined') {
            console.warn('Chart.js library is not loaded');
            return;
        }

        // CHART 1: Subject Passing Rate vs Target Benchmark (85%)
        const subjectList = <?= json_encode($dashboardChartSubjects ?? []) ?>;
        const ctxPassing = document.getElementById('dashboardSubjectPassingChart');
        if (ctxPassing && subjectList.length > 0) {
            const labels = subjectList.map(item => item.code);
            const rates = subjectList.map(item => item.rate);

            new Chart(ctxPassing.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Passing Rate (%)',
                            data: rates,
                            backgroundColor: rates.map(r => r < 85.0 ? 'rgba(220, 53, 69, 0.75)' : 'rgba(25, 135, 84, 0.75)'),
                            borderColor: rates.map(r => r < 85.0 ? '#dc3545' : '#198754'),
                            borderWidth: 1.5,
                            borderRadius: 4
                        },
                        {
                            type: 'line',
                            label: 'Target Goal (85%)',
                            data: labels.map(() => 85.0),
                            borderColor: '#800020',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            pointRadius: 0,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function (val) { return val + '%'; }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { boxWidth: 12, font: { size: 11 } }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ' + context.parsed.y + '%';
                                }
                            }
                        }
                    }
                }
            });
        }

        // CHART 2: Student Grade Breakdown Distribution
        const dist = <?= json_encode($gradeDistribution ?? ['honor' => 785, 'pass' => 1512, 'deficient' => 387]) ?>;
        const ctxGrade = document.getElementById('dashboardGradePieChart');
        if (ctxGrade) {
            new Chart(ctxGrade.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Honor (≤ 1.75)', 'Regular Pass (2.00 - 3.00)', 'Deficient (Fail / INC)'],
                    datasets: [{
                        data: [dist.honor || 0, dist.pass || 0, dist.deficient || 0],
                        backgroundColor: ['#198754', '#0d6efd', '#dc3545'],
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    cutout: '65%'
                }
            });
        }

        // CHART 3: Longitudinal Retention vs Attrition Trajectory
        const trendData = <?= json_encode($longitudinalTrends ?? [
            'years' => ['A.Y. 2024-2025', 'A.Y. 2025-2026', 'A.Y. 2026-2027'],
            'retention' => [94.1, 95.4, 96.2],
            'attrition' => [5.9, 4.6, 3.8]
        ]) ?>;
        const ctxTrend = document.getElementById('dashboardRetentionTrendChart');
        if (ctxTrend && trendData.years) {
            new Chart(ctxTrend.getContext('2d'), {
                type: 'line',
                data: {
                    labels: trendData.years,
                    datasets: [
                        {
                            label: 'Retention Rate (%)',
                            data: trendData.retention,
                            borderColor: '#198754',
                            backgroundColor: 'rgba(25, 135, 84, 0.1)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: '#198754',
                            pointRadius: 4
                        },
                        {
                            label: 'Attrition Rate (%)',
                            data: trendData.attrition,
                            borderColor: '#dc3545',
                            backgroundColor: 'rgba(220, 53, 69, 0.05)',
                            borderWidth: 2,
                            borderDash: [4, 4],
                            fill: false,
                            tension: 0.3,
                            pointBackgroundColor: '#dc3545',
                            pointRadius: 3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function (val) { return val + '%'; }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { boxWidth: 12, font: { size: 11 } }
                        }
                    }
                }
            });
        }

        // CHART 4: Program-Level Risk Distribution
        const progData = <?= json_encode($programRiskDistribution ?? [
            'labels' => ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSIT', 'BSCS'],
            'low' => [295, 258, 292, 174, 185, 160],
            'moderate' => [18, 16, 13, 11, 14, 12],
            'high' => [7, 6, 5, 5, 6, 4]
        ]) ?>;
        const ctxProg = document.getElementById('dashboardProgramRiskChart');
        if (ctxProg && progData.labels) {
            new Chart(ctxProg.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: progData.labels,
                    datasets: [
                        {
                            label: 'Low Risk',
                            data: progData.low,
                            backgroundColor: 'rgba(25, 135, 84, 0.75)',
                            borderColor: '#198754',
                            borderWidth: 1,
                            borderRadius: 3
                        },
                        {
                            label: 'Moderate Risk',
                            data: progData.moderate,
                            backgroundColor: 'rgba(255, 193, 7, 0.75)',
                            borderColor: '#ffc107',
                            borderWidth: 1,
                            borderRadius: 3
                        },
                        {
                            label: 'High Risk',
                            data: progData.high,
                            backgroundColor: 'rgba(220, 53, 69, 0.75)',
                            borderColor: '#dc3545',
                            borderWidth: 1,
                            borderRadius: 3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: true },
                        y: {
                            stacked: true,
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { boxWidth: 12, font: { size: 11 } }
                        }
                    }
                }
            });
        }
    });
</script>